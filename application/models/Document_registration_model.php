<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document_registration_model extends CI_Model {

    function get_all_document_registration_list($start, $length, $search_district = '', $search_docno = '', $search_tappno = '', $search_ppdetails = '', $search_doctype = '', $search_appd = '', $search_qstatus = '', $search_status = '') {
        $this->db->select("r.*, pd.dr_party_details_id, pd.party_type, pd.party_category, pd.party_description, pd.party_name, pd.party_address, "
                . "pd.party_state, pd.party_district, pd.party_mobile_number, q.query_id, q.query_by_name, q.query_datetime");

        $this->_bd_for_search_dr($search_district, $search_docno, $search_tappno, $search_ppdetails, $search_doctype, $search_appd, $search_qstatus, $search_status);

        $this->db->limit($length, $start);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('document_registration AS r');
        $this->db->join('dr_party_details AS pd', 'pd.document_registration_id = r.document_registration_id '
                . 'AND pd.party_type=' . VALUE_ONE . ' AND pd.is_delete!=' . IS_DELETE);
        $this->db->join('query AS q', 'q.query_id = (SELECT max(query_id) FROM query WHERE module_type = ' . VALUE_ELEVEN . ' AND module_id = r.document_registration_id AND is_delete != ' . VALUE_ONE . ')', 'LEFT');
        if ($search_appd != '') {
            $this->db->order_by("STR_TO_DATE(r.appointment_time, '%l:%i %p')");
        } else {
            $this->db->order_by('r.submitted_datetime', 'ASC');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _bd_for_search_dr($search_district, $search_docno, $search_tappno, $search_ppdetails, $search_doctype, $search_appd, $search_qstatus, $search_status) {
        if ($search_district != '') {
            $this->db->where('r.district', $search_district);
        }
        if ($search_docno != '') {
            $this->db->like('r.application_number', $search_docno);
        }
        if ($search_tappno != '') {
            $where = "(r.temp_application_number LIKE '%$search_tappno%' OR "
                    . "DATE_FORMAT(r.application_datetime,'%d-%m-%Y %H:%i:%s') LIKE '%$search_tappno%' OR "
                    . "DATE_FORMAT(r.submitted_datetime,'%d-%m-%Y %H:%i:%s') LIKE '%$search_tappno%')";
            $this->db->where($where);
        }
        if ($search_ppdetails != '') {
            $where = "(pd.party_name LIKE '%$search_ppdetails%' OR "
                    . "pd.party_address LIKE '%$search_ppdetails%' OR "
                    . "pd.party_mobile_number LIKE '%$search_ppdetails%') OR "
                    . "EXISTS(SELECT opd.dr_party_details_id, opd.party_name FROM dr_party_details AS opd "
                    . "WHERE r.document_registration_id = opd.document_registration_id "
                    . "AND opd.party_type=" . VALUE_TWO . " AND opd.is_delete!=" . IS_DELETE . " AND "
                    . "opd.party_name LIKE '%$search_ppdetails%')";
            $this->db->where($where);
        }
        if ($search_doctype != '') {
            $this->db->where('r.doc_type', $search_doctype);
        }
        if ($search_appd != '') {
            $this->db->where('r.appointment_date', $search_appd);
        }
        if ($search_qstatus != '') {
            $this->db->where('r.query_status', $search_qstatus);
        }
        if ($search_status != '') {
            $this->db->where('r.status', $search_status);
        }
    }

    function get_total_count_of_records($search_district) {
        $this->db->select('COUNT(document_registration_id) AS total_records');
        if (!is_admin()) {
            $this->db->where('district', $search_district);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('status != ' . VALUE_ZERO);
        $this->db->where('status != ' . VALUE_ONE);
        $this->db->from('document_registration');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($search_district = '', $search_docno = '', $search_tappno = '', $search_ppdetails = '', $search_doctype = '', $search_appd = '', $search_qstatus = '', $search_status = '') {
        $this->db->select('COUNT(r.document_registration_id) AS total_records');

        $this->_bd_for_search_dr($search_district, $search_docno, $search_tappno, $search_ppdetails, $search_doctype, $search_appd, $search_qstatus, $search_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('document_registration AS r');
        $this->db->join('dr_party_details AS pd', 'pd.document_registration_id = r.document_registration_id '
                . 'AND pd.party_type=' . VALUE_ONE . ' AND pd.is_delete!=' . IS_DELETE);
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_step_one_dr_pd_details($document_registration_id) {
        $this->db->select('r.status, r.temp_application_number, r.doc_consideration_amount, pd.*');
        $this->db->where('r.document_registration_id', $document_registration_id);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->from('document_registration AS r');
        $this->db->join('dr_party_details AS pd', 'pd.document_registration_id=r.document_registration_id AND pd.party_type=' . VALUE_ONE . ' AND pd.is_delete!=' . VALUE_ONE);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_basic_dr_details($document_registration_id) {
        $this->db->select('document_registration_id, temp_application_number, application_datetime, district, doc_type, '
                . 'is_verified_app, status, is_changed_po');
        $this->db->where('document_registration_id', $document_registration_id);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('document_registration');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_dr_details_for_fee_receipt($dr_id) {
        $this->db->select('dr.document_registration_id, dr.temp_application_number, dr.district, dr.doc_type, dr.fee_receipt_number, '
                . 'dr.total_fees, dr.status, '
                . 'dr.fee_receipt_datetime, pd.dr_party_details_id, pd.party_category, pd.party_name, pd.party_address');
        $this->db->where('dr.document_registration_id', $dr_id);
        $this->db->where('dr.is_delete !=' . IS_DELETE);
        $this->db->from('document_registration AS dr');
        $this->db->join('dr_party_details AS pd',
                'pd.document_registration_id = dr.document_registration_id AND pd.is_delete !=' . IS_DELETE . ' AND pd.party_type=' . VALUE_ONE);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_dr_details_for_endorsement($dr_id) {
        $this->db->select('dr.document_registration_id, dr.temp_application_number, dr.application_number, '
                . 'dr.district, dr.doc_type, dr.fee_receipt_number, dr.total_fees, dr.application_year, '
                . 'dr.appointment_date, dr.appointment_time, dr.status, dr.status_datetime, dr.is_changed_po, '
                . 'dr.fee_receipt_datetime, pd.dr_party_details_id, pd.party_category, pd.party_name, pd.party_address, '
                . 'pd.party_photo, pd.party_photo_datetime, pd.party_pincode, pd.party_state, s.state_name AS party_state_name, '
                . 'pd.party_district, d.district_name AS party_district_name');
        $this->db->where('dr.document_registration_id', $dr_id);
        $this->db->where('dr.is_delete !=' . IS_DELETE);
        $this->db->from('document_registration AS dr');
        $this->db->join('dr_party_details AS pd',
                'pd.document_registration_id = dr.document_registration_id AND pd.is_delete !=' . IS_DELETE . ' AND pd.party_type=' . VALUE_ONE);
        $this->db->join('state AS s', 's.state_code = pd.party_state');
        $this->db->join('district AS d', 'd.district_code = pd.party_district');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_dr_party_details_for_endorsement($dr_id, $is_changed_po) {
        $this->db->select('pd.*, s.state_name AS party_state_name, pd.party_district, d.district_name AS party_district_name');
        $this->db->where('pd.document_registration_id', $dr_id);
        $this->db->where('pd.is_delete !=' . IS_DELETE);
        $this->db->from('dr_party_details AS pd');
        $this->db->join('state AS s', 's.state_code = pd.party_state');
        $this->db->join('district AS d', 'd.district_code = pd.party_district');
        if ($is_changed_po == VALUE_ONE) {
            $this->db->order_by('pd.order', 'ASC');
        } else {
            $this->db->order_by('pd.party_category', 'ASC');
            $this->db->order_by('pd.dr_party_details_id', 'ASC');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_records_for_excel($search_district = '', $search_docno = '', $search_tappno = '', $search_ppdetails = '', $search_doctype = '', $search_appd = '', $search_qstatus = '', $search_status = '') {
        $this->db->select("r.*, pd.dr_party_details_id, pd.party_type, pd.party_description, pd.party_name, pd.party_address, "
                . "pd.party_state, pd.party_district, pd.party_mobile_number");

        $this->_bd_for_search_dr($search_district, $search_docno, $search_tappno, $search_ppdetails, $search_doctype, $search_appd, $search_qstatus, $search_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('document_registration AS r');
        $this->db->join('dr_party_details AS pd', 'pd.document_registration_id = r.document_registration_id '
                . 'AND pd.party_type=' . VALUE_ONE . ' AND pd.is_delete!=' . IS_DELETE);
        $this->db->order_by('r.submitted_datetime', 'ASC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_dr_data_with_user_details($document_registration_id) {
        $this->db->select('dr.*, su.username AS verified_uname');
        $this->db->where('dr.is_delete !=' . IS_DELETE);
        $this->db->where('dr.document_registration_id', $document_registration_id);
        $this->db->from('document_registration AS dr');
        $this->db->join('sa_users AS su', 'su.sa_user_id=dr.verified_by', 'LEFT');
        $resc = $this->db->get();
        return $resc->row_array();
    }
}

/*
 * EOF: ./application/models/BOCW_model.php
 */