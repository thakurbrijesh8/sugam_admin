<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Character_certificate_model extends CI_Model {

    function get_all_character_certificate_list($start, $length, $search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_qstatus = '', $search_status = '') {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        $this->db->select("r.*,date_format(r.created_time, '%d-%m-%Y %H:%i:%s') AS display_datetime, sam.name AS mamlatdar_name,sas.name AS sdpo_name,u.applicant_name as reg_user_name,u.mobile_number as reg_user_mobile_number,u.email as reg_user_email, q.query_id, q.query_by_name, q.query_datetime");
        
        $this->_bd_for_search_cc($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_qstatus, $search_status);
                
        $this->db->limit($length, $start);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('character_certificate AS r');
        $this->db->join('sa_users AS sam', 'sam.sa_user_id = r.ldc_to_mamlatdar AND r.ldc_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users AS sas', 'sas.sa_user_id = r.mamlatdar_to_sdpo AND r.mamlatdar_to_sdpo != 0', 'LEFT');
        $this->db->join('query AS q', 'q.query_id = (SELECT max(query_id) FROM query WHERE module_type = ' . VALUE_TEN . ' AND module_id = r.character_certificate_id AND is_delete != ' . VALUE_ONE . ')', 'LEFT');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        if ($search_status == VALUE_FIVE || $search_status == VALUE_SIX) {
            $this->db->order_by('r.status_datetime', 'DESC');
        } else {
            $this->db->order_by('r.status', 'ASC');
            $this->db->order_by('r.character_certificate_id', 'DESC');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_total_count_of_records($search_district) {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        $this->db->select('COUNT(character_certificate_id) AS total_records');
        
        if (!is_admin()) {
            $this->db->where('r.district', $search_district);
        }

        $this->_bd_for_session_id();
        
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('status != ' . VALUE_ZERO);
        $this->db->where('status != ' . VALUE_ONE);
        $this->db->from('character_certificate');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_qstatus = '', $search_status = '') {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        $this->db->select('COUNT(r.character_certificate_id) AS total_records');
        
        $this->_bd_for_search_cc($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_qstatus, $search_status);
                
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('character_certificate AS r');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_records_for_excel($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_qstatus, $search_status) {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        $this->db->select('r.application_number, r.submitted_datetime, r.applicant_name, r.district, r.status, r.query_status');
        
        $this->_bd_for_search_cc($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_qstatus, $search_status);
                
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('character_certificate AS r');
        $this->db->order_by('r.character_certificate_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_basic_data_for_cc($character_certificate_id) {
        $this->db->select('r.*, sat.name AS ldc_name');
        $this->db->select('r.*,sam.name AS mamlatdar_name,sas.name AS sdpo_name');
        $this->db->where('r.character_certificate_id', $character_certificate_id);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('character_certificate AS r');
        $this->db->join('sa_users AS sat', 'sat.sa_user_id = r.ldc AND r.ldc != 0', 'LEFT');
        $this->db->join('sa_users AS sam', 'sam.sa_user_id = r.ldc_to_mamlatdar AND r.ldc_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users AS sas', 'sas.sa_user_id = r.mamlatdar_to_sdpo AND r.mamlatdar_to_sdpo != 0', 'LEFT');
        $resc = $this->db->get();
        return $resc->row_array();
    }
    
    function _bd_for_search_cc($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_qstatus, $search_status) {
        if ($search_district != '') {
            $this->db->where('r.district', $search_district);
        }
        if ($search_application_number != '') {
            $where = "(r.application_number LIKE '%$search_application_number%' OR "
                    . "u.applicant_name LIKE '%$search_application_number%' OR "
                    . "u.mobile_number LIKE '%$search_application_number%' OR "
                    . "u.email LIKE '%$search_application_number%')";
            $this->db->where($where);
        }
        if ($search_application_date != '') {
            $this->db->like("DATE_FORMAT(r.submitted_datetime,'%d-%m-%Y %H:%i:%s')", $search_application_date);
        }
        if ($search_applicant_details != '') {
            $where = "(r.applicant_name LIKE '%$search_applicant_details%' OR "
                    . "r.com_addr_house_no LIKE '%$search_applicant_details%' OR "
                    . "r.com_addr_house_name LIKE '%$search_applicant_details%' OR "
                    . "r.com_addr_street LIKE '%$search_applicant_details%' OR "
                    . "r.com_addr_village_dmc_ward LIKE '%$search_applicant_details%' OR "
                    . "r.com_addr_city LIKE '%$search_applicant_details%' OR "
                    . "r.com_pincode LIKE '%$search_applicant_details%')";
            $this->db->where($where);
        }
        if ($search_qstatus != '') {
            $this->db->where('r.query_status', $search_qstatus);
        }
        if ($search_status != '') {
            $this->db->where('r.status', $search_status);
        }
        $this->_bd_for_session_id();
    }
    
    function _bd_for_session_id() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        if (is_aci_user()) {
            $aci_where = "(r.talathi_to_aci = $session_user_id OR r.status = " . VALUE_SIX . ")";
            $this->db->where($aci_where);
        }
        if (is_mamlatdar_user()) {
            $mam_where = "(r.aci_to_mamlatdar = $session_user_id OR r.ldc_to_mamlatdar = $session_user_id OR r.status = " . VALUE_SIX . ")";
            $this->db->where($mam_where);
        }
        if (is_ldc_user()) {
            $this->db->where('r.aci_to_ldc', $session_user_id);
        }
        if (is_sdpo_user()) {
            $this->db->where('mamlatdar_to_sdpo', $session_user_id);
        }
    }

}

/*
 * EOF: ./application/models/BOCW_model.php
 */