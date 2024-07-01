<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Certified_copy_model extends CI_Model {

    function get_all_certified_copy_list($start, $length, $search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_vdw = '', $s_qstatus = '', $search_status = '') {
        $this->db->select('r.*, sau.name AS actioner_user_name,u.applicant_name as reg_user_name,u.mobile_number as reg_user_mobile_number,u.email as reg_user_email, q.query_id, q.query_by_name, q.query_datetime');

        $this->_bd_for_search_certi_c($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_vdw, $s_qstatus, $search_status);

        $this->db->limit($length, $start);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('certified_copy AS r');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        $this->db->join('query AS q', 'q.query_id = (SELECT max(query_id) FROM query WHERE module_type = ' . VALUE_NINE . ' AND module_id = r.certified_copy_id AND is_delete != ' . VALUE_ONE . ')', 'LEFT');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        if ($search_status == VALUE_FIVE || $search_status == VALUE_SIX) {
            $this->db->order_by('r.status_datetime', 'DESC');
        } else {
            $this->db->order_by('r.status', 'ASC');
            $this->db->order_by('r.certified_copy_id', 'DESC');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _bd_for_search_certi_c($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_vdw, $s_qstatus, $search_status) {
        if ($search_district != '') {
            $this->db->where('r.district', $search_district);
        }
        if ($search_application_number != '') {
            $this->db->like('r.application_number', $search_application_number);
        }
        if ($search_application_date != '') {
            $this->db->like("DATE_FORMAT(r.submitted_datetime,'%d-%m-%Y %H:%i:%s')", $search_application_date);
        }
        if ($search_vdw != '') {
            $this->db->where('r.village', $search_vdw);
        }
        if ($search_applicant_details != '') {
            $where = "(r.applicant_name LIKE '%$search_applicant_details%' OR "
                    . "r.father_name LIKE '%$search_applicant_details%' OR "
                    . "r.surname LIKE '%$search_applicant_details%' OR "
                    . "r.address LIKE '%$search_applicant_details%' OR "
                    . "r.mobile_number LIKE '%$search_applicant_details%' OR "
                    . "r.email LIKE '%$search_applicant_details%')";
            $this->db->where($where);
        }
        if ($s_qstatus != '') {
            $this->db->where('r.query_status', $s_qstatus);
        }
        if ($search_status != '') {
            if ($search_status != VALUE_FIVE && $search_status != VALUE_SIX) {
                $this->db->where("(r.query_status='" . VALUE_ZERO . "' OR r.query_status='" . VALUE_THREE . "')");
            }
            $this->db->where('r.status', $search_status);
        }

        $this->_bd_for_session_id();
    }

    function _bd_for_session_id() {
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('r.village', explode(',', $av));
            }
        }
    }

    function get_total_count_of_records($search_district) {
        $this->db->select('COUNT(r.certified_copy_id) AS total_records');
        if ($search_district != '') {
            $this->db->where('r.district', $search_district);
        }

        $this->_bd_for_session_id();

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('certified_copy AS r');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_vdw = '', $s_qstatus = '', $search_status = '') {
        $this->db->select('COUNT(r.certified_copy_id) AS total_records');

        $this->_bd_for_search_certi_c($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_vdw, $s_qstatus, $search_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('certified_copy AS r');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

}

/*
 * EOF: ./application/models/BOCW_model.php
 */