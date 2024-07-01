<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rti_model extends CI_Model {

    function get_all_rti_list($start, $length, $search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_vdw = '', $s_qstatus = '', $search_status = '') {
        $this->db->select("r.*,date_format(r.created_time, '%d-%m-%Y %H:%i:%s') AS display_datetime, "
                . "sat.name AS talathi_name, saa.name AS aci_name, IF(r.aci_rec=1,salm.name, sam.name) AS mamlatdar_name, "
                . "sal.name AS ldc_name, sau.name AS actioner_user_name,u.applicant_name as reg_user_name,u.mobile_number as reg_user_mobile_number,u.email as reg_user_email, "
                . "q.query_id, q.query_by_name, q.query_datetime");

        $this->_bd_for_search_rti($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_vdw, $s_qstatus, $search_status);

        $this->db->limit($length, $start);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('rti AS r');
        $this->db->join('sa_users AS sat', 'sat.sa_user_id = r.talathi AND r.talathi != 0', 'LEFT');
        $this->db->join('sa_users AS saa', 'saa.sa_user_id = r.talathi_to_aci AND r.talathi_to_aci != 0', 'LEFT');
        $this->db->join('sa_users AS sam', 'sam.sa_user_id = r.aci_to_mamlatdar AND r.aci_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users AS sal', 'sal.sa_user_id = r.aci_to_ldc AND r.aci_to_ldc != 0', 'LEFT');
        $this->db->join('sa_users AS salm', 'salm.sa_user_id = r.ldc_to_mamlatdar AND r.ldc_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        $this->db->join('query AS q', 'q.query_id = (SELECT max(query_id) FROM query WHERE module_type = ' . VALUE_TWELVE . ' AND module_id = r.rti_id AND is_delete != ' . VALUE_ONE . ')', 'LEFT');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        if ($search_status == VALUE_FIVE || $search_status == VALUE_SIX) {
            $this->db->order_by('r.status_datetime', 'DESC');
        } else {
            $this->db->order_by('r.status, r.submitted_datetime', 'ASC');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _bd_for_search_rti($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_vdw, $s_qstatus, $search_status) {
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
            $this->db->where('r.village_name', $search_vdw);
        }
        if ($search_applicant_details != '') {
            $where = "(r.applicant_name LIKE '%$search_applicant_details%' OR "
                    . "r.mobile_number LIKE '%$search_applicant_details%')";
            $this->db->where($where);
        }
        if ($search_status != '') {
            $this->db->where('r.status', $search_status);
        }

        $this->_bd_for_session_id();
    }

    function _bd_for_session_id() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        if (is_aci_user()) {
            $this->db->where('r.talathi_to_aci', get_from_session('temp_id_for_sugam_admin'));
        }
        if (is_mamlatdar_user()) {
            $mam_where = "(r.aci_to_mamlatdar = $session_user_id OR r.ldc_to_mamlatdar = $session_user_id)";
            $this->db->where($mam_where);
        }
        if (is_ldc_user()) {
            $this->db->where('r.aci_to_ldc', $session_user_id);
        }
    }

    function get_total_count_of_records($search_district) {
        $this->db->select('COUNT(r.rti_id) AS total_records');
        if (!is_admin()) {
            $this->db->where('r.district', $search_district);
        }

        $this->_bd_for_session_id();

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('rti AS r');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_vdw = '', $s_qstatus = '', $search_status = '') {
        $this->db->select('COUNT(r.rti_id) AS total_records');

        $this->_bd_for_search_rti($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_vdw, $s_qstatus, $search_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('rti AS r');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }
    
    function get_records_for_excel($s_district, $s_app_no, $s_app_date, $s_app_det, $s_vdw, $s_qstatus, $s_status) {
        $this->db->select('r.application_number, r.district, r.applicant_name, r.mobile_number, r.applicant_address, r.submitted_datetime, r.status, r.query_status');

        $this->_bd_for_search_rti($s_district, $s_app_no, $s_app_date, $s_app_det, $s_vdw, $s_qstatus, $s_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('rti AS r');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        $this->db->order_by('r.rti_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_basic_data_for_hc($rti_id) {
        $this->db->select('r.*, sat.name AS talathi_name, saa.name AS aci_name, IF(r.aci_rec=1,salm.name, sam.name) AS mamlatdar_name, '
                . 'sal.name AS ldc_name, sau.name AS actioner_user_name');
        $this->db->where('r.rti_id', $rti_id);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('rti AS r');
        $this->db->join('sa_users AS sat', 'sat.sa_user_id = r.talathi AND r.talathi != 0', 'LEFT');
        $this->db->join('sa_users AS saa', 'saa.sa_user_id = r.talathi_to_aci AND r.talathi_to_aci != 0', 'LEFT');
        $this->db->join('sa_users AS sam', 'sam.sa_user_id = r.aci_to_mamlatdar AND r.aci_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users AS sal', 'sal.sa_user_id = r.aci_to_ldc AND r.aci_to_ldc != 0', 'LEFT');
        $this->db->join('sa_users AS salm', 'salm.sa_user_id = r.ldc_to_mamlatdar AND r.ldc_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        $resc = $this->db->get();
        return $resc->row_array();
    }
}

/*
 * EOF: ./application/models/BOCW_model.php
 */