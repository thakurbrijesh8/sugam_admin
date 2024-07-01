<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Eocs_site_plan_rural_model extends CI_Model {

    function get_all_eocs_site_plan_rural_list($start, $length, $search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_village = '', $s_qstatus = '', $search_status = '', $s_plan_status = '') {
        $this->db->select('r.*, sau.name AS actioner_user_name,q.query_id, q.query_by_name, q.query_datetime');

        $this->_bd_for_search_espr($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_village, $s_qstatus, $search_status, $s_plan_status);

        $this->db->limit($length, $start);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->from('eocs_site_plan_rural AS r');
        $this->db->join('query AS q', 'q.query_id = (SELECT max(query_id) FROM query WHERE module_type = ' . VALUE_TWENTYFIVE . ' AND module_id = r.eocs_site_plan_rural_id AND is_delete != ' . VALUE_ONE . ')', 'LEFT');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        if ($search_status == VALUE_FIVE || $search_status == VALUE_SIX) {
            $this->db->order_by('r.status_datetime', 'DESC');
        } else {
            $this->db->order_by('r.status, r.submitted_datetime', 'ASC');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _bd_for_search_espr($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_village, $s_qstatus, $search_status, $s_plan_status) {
        if ($search_district != '') {
            $this->db->where('r.district', $search_district);
        }
        if ($search_application_number != '') {
            $this->db->like('r.application_number', $search_application_number);
        }
        if ($search_application_date != '') {
            $this->db->like("DATE_FORMAT(r.submitted_datetime,'%d-%m-%Y %H:%i:%s')", $search_application_date);
        }
        if ($search_applicant_details != '') {
            $where = "(r.applicant_name LIKE '%$search_applicant_details%' OR "
                    . "r.father_name LIKE '%$search_applicant_details%' OR "
                    . "r.surname LIKE '%$search_applicant_details%' OR "
                    . "r.address LIKE '%$search_applicant_details%' OR "
                    . "r.mobile_number LIKE '%$search_applicant_details%')";
            $this->db->where($where);
        }
        if ($search_village != '') {
            $this->db->where('r.village', $search_village);
        }
        if ($s_qstatus != '') {
            $this->db->where('r.query_status', $s_qstatus);
        }
        if ($search_status != '' || $s_plan_status != '') {
            if ($search_status != VALUE_FIVE && $search_status != VALUE_SIX) {
                $this->db->where("(r.query_status='" . VALUE_ZERO . "' OR r.query_status='" . VALUE_THREE . "')");
            }
        }
        if ($search_status != '') {
            $this->db->where('r.status', $search_status);
        }
        if ($s_plan_status != '') {
            if ($s_plan_status == VALUE_ONE) {
                $this->db->where_in('r.plan_status', array(VALUE_ZERO, VALUE_ONE));
            } else {
                $this->db->where('r.plan_status', $s_plan_status);
            }
        }

        $this->_bd_for_session_id();
    }

    function _bd_for_session_id() {
        $status_array = array(VALUE_ZERO, VALUE_ONE);
        if (is_eocs_jfs_user()) {
            $status_array = array(VALUE_ZERO, VALUE_ONE, VALUE_TWO, VALUE_THREE);
        }
        $this->db->where_not_in('r.status', $status_array);
    }

    function get_total_count_of_records($search_district) {
        $this->db->select('COUNT(r.eocs_site_plan_rural_id) AS total_records');
        if ($search_district != '') {
            $this->db->where('r.district', $search_district);
        }

        $this->_bd_for_session_id();

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->from('eocs_site_plan_rural AS r');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_village = '', $s_qstatus = '', $search_status = '', $s_plan_status = '') {
        $this->db->select('COUNT(r.eocs_site_plan_rural_id) AS total_records');

        $this->_bd_for_search_espr($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_village, $s_qstatus, $search_status, $s_plan_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->from('eocs_site_plan_rural AS r');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

//    function get_pending_generate_copy_details($module_type, $module_id) {
//        $this->db->where('module_type', $module_type);
//        $this->db->where('module_id', $module_id);
//        $this->db->where('copies != total_copy_generated');
//        $this->db->where('is_delete !=' . IS_DELETE);
//        $this->db->from('form_land_details');
//        $resc = $this->db->get();
//        return $resc->result_array();
//    }

    function get_espr_data_with_land_details($module_type, $form_land_details_id, $is_full_data = false) {
        $sql = 'espr.eocs_site_plan_rural_id, espr.district, espr.application_number, espr.status, espr.plan_status, espr.land_details, '
                . 'espr.applicant_name, espr.father_name, espr.surname, espr.spouse_name, espr.mobile_number, espr.email, '
                . 'espr.address, espr.purpose, espr.total_copies, espr.total_amount, espr.village, '
                . 'fld.*';
        if ($is_full_data != false) {
            $sql .= ', pd.reference_id, pd.op_transaction_datetime';
        }
        $this->db->select($sql);
        $this->db->where('fld.module_type', $module_type);
        $this->db->where('fld.form_land_details_id', $form_land_details_id);
        $this->db->where('fld.is_delete !=' . IS_DELETE);
        $this->db->from('form_land_details AS fld');
        $this->db->join('eocs_site_plan_rural AS espr', 'fld.module_id=espr.eocs_site_plan_rural_id');
        if ($is_full_data != false) {
            $this->db->join('fees_payment AS pd', 'pd.reference_number=espr.last_op_reference_number');
        }
        $resc = $this->db->get();
        return $resc->row_array();
    }
}

/*
 * EOF: ./application/models/Eocs_site_plan_rural_model.php
 */