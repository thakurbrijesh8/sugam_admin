<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dapvr_case_model extends CI_Model {

    function get_dapvr_case_data($case_status, $search_month_status) {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        $this->db->select("r.*,date_format(r.created_time, '%d-%m-%Y %H:%i:%s') AS display_datetime, "
                . "sat.name AS talathi_name, salm.name AS mamlatdar_name");
        if ($case_status != NULL) {
            if ($case_status == VALUE_TWO) {
                $this->db->where_in('r.status', array(VALUE_ONE, VALUE_TWO, VALUE_THREE));
            } else {
                if ($case_status == VALUE_THREE) {
                    if ($search_month_status == VALUE_ONE) {
                        $this->db->where('DATE_FORMAT(r.next_hearing_date,"%m%Y")', date('mY'));
                    } else if ($search_month_status == VALUE_TWO) {
                        $this->db->where('DATE_FORMAT(r.next_hearing_date,"%m%Y")', date('mY', strtotime('+1 month')));
                    } else {
                        $this->db->where('r.next_hearing_date', date('Y-m-d'));
                    }
                }
                $this->db->where('r.status', $case_status);
            }
        }
        if (is_mamlatdar_user()) {
            $mam_where = "(r.talathi_to_mamlatdar = $session_user_id)";
            $this->db->where($mam_where);
        }
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->from('dapvr_case AS r');
        $this->db->join('sa_users AS sat', 'sat.sa_user_id = r.talathi AND r.talathi != 0', 'LEFT');
        $this->db->join('sa_users AS salm', 'salm.sa_user_id = r.talathi_to_mamlatdar AND r.talathi_to_mamlatdar != 0', 'LEFT');
        $this->db->order_by('r.year', 'ASC');
        //$this->db->order_by('r.case_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_basic_data_for_dc($case_id) {
        $this->db->select('r.*, sat.name AS talathi_name, salm.name AS mamlatdar_name ');
        $this->db->where('r.case_id', $case_id);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->from('dapvr_case AS r');
        $this->db->join('sa_users AS sat', 'sat.sa_user_id = r.user_id AND r.user_id != 0', 'LEFT');
        $this->db->join('sa_users AS salm', 'salm.sa_user_id = r.talathi_to_mamlatdar AND r.talathi_to_mamlatdar != 0', 'LEFT');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_dashboard_data_for_dc($case_id) {
        $this->db->select('r.*, sat.name AS talathi_name, salm.name AS mamlatdar_name ');
        $this->db->where('r.case_id', $case_id);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->from('dapvr_case AS r');
        $this->db->join('sa_users AS sat', 'sat.sa_user_id = r.user_id AND r.user_id != 0', 'LEFT');
        $this->db->join('sa_users AS salm', 'salm.sa_user_id = r.talathi_to_mamlatdar AND r.talathi_to_mamlatdar != 0', 'LEFT');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_records_for_excel() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        $this->db->select('r.case_no, r.register_date, r.case_type, r.year, '
                . 'r.petitioner_details, r.respondent_details, r.next_hearing_date, r.case_status');

//        if (is_aci_user()) {
//            $this->db->where('r.talathi_to_aci', $session_user_id);
//        }
//        if (is_mamlatdar_user()) {
//            $mam_where = "(r.aci_to_mamlatdar = $session_user_id OR r.ldc_to_mamlatdar = $session_user_id)";
//            $this->db->where($mam_where);
//        }
//        if (is_ldc_user()) {
//            $this->db->where('r.aci_to_ldc', $session_user_id);
//        }
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->from('dapvr_case AS r');
        $this->db->order_by('r.year', 'ASC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_advocate_list_for_dapvr_case($not_super_admin = FALSE) {
        $this->db->where('is_delete !=', IS_DELETE);
//        if ($not_super_admin == TRUE) {
//            $this->db->where('type != "Super Admin"');
//        }
        $this->db->from('advocate_detail');
        $resc = $this->db->get();
        return $resc->result_array();
    }

}
