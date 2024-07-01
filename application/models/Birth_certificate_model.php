<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Birth_certificate_model extends CI_Model {

    function get_all_birth_certificate_list($start, $length, $s_district = '', $s_app_no = '', $s_app_det = '', $s_app_status = '', $s_qstatus = '', $s_status = '') {
        $this->db->select("r.*,date_format(r.created_time, '%d-%m-%Y %H:%i:%s') AS display_datetime, "
                . "sau.name AS actioner_user_name, u.applicant_name as reg_user_name,u.mobile_number as reg_user_mobile_number,u.email as reg_user_email, "
                . "q.query_id, q.query_by_name, q.query_datetime");

        $this->_bd_for_search_bc($s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status);

        $this->db->limit($length, $start);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('birth_certificate AS r');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        $this->db->join('query AS q', 'q.query_id = (SELECT max(query_id) FROM query WHERE module_type = ' . VALUE_NINETEEN . ' AND module_id = r.birth_certificate_id AND is_delete != ' . VALUE_ONE . ')', 'LEFT');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        if ($s_status == VALUE_FIVE || $s_status == VALUE_SIX) {
            $this->db->order_by('r.status_datetime', 'DESC');
        } else {
            $this->db->order_by('r.status, r.submitted_datetime', 'ASC');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_total_count_of_records($search_district) {
        $this->db->select('COUNT(r.birth_certificate_id) AS total_records');
        if (!is_admin()) {
            $this->db->where('r.district', $search_district);
        }

        $this->_bd_for_session_id();

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('birth_certificate AS r');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($s_district = '', $s_app_no = '', $s_app_det = '', $s_app_status = '', $s_qstatus = '', $s_status = '') {
        $this->db->select('COUNT(r.birth_certificate_id) AS total_records');

        $this->_bd_for_search_bc($s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('birth_certificate AS r');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function _bd_for_search_bc($s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status) {
        if ($s_district != '') {
            $this->db->where('r.district', $s_district);
        }
        if ($s_app_no != '') {
            $where = "(r.application_number LIKE '%$s_app_no%' OR "
                    . "u.applicant_name LIKE '%$s_app_no%' OR "
                    . "u.mobile_number LIKE '%$s_app_no%' OR "
                    . "u.email LIKE '%$s_app_no%' OR "
                    . "DATE_FORMAT(r.submitted_datetime,'%d-%m-%Y %H:%i:%s') LIKE '%$s_app_no%')";
            $this->db->where($where);
        }
        if ($s_app_det != '') {
            $where = "(r.applicant_name LIKE '%$s_app_det%' OR "
                    . "r.communication_address LIKE '%$s_app_det%' OR "
                    . "r.mobile_number LIKE '%$s_app_det%')";
            $this->db->where($where);
        }
        if ($s_app_status != '') {
            if ($s_app_status == VALUE_ONE || $s_app_status == VALUE_TWO || $s_app_status == VALUE_THREE) {
                if ($s_app_status == VALUE_ONE) {
                    $ad = date('Y-m-d', strtotime("-1 days"));
                }
                if ($s_app_status == VALUE_TWO) {
                    $ad = date('Y-m-d');
                }
                if ($s_app_status == VALUE_THREE) {
                    $ad = date('Y-m-d', strtotime("+1 days"));
                }
                $this->db->where('r.appointment_date', $ad);
            }
            if ($s_app_status == VALUE_FOUR) {
                $this->db->where('r.appointment_status', VALUE_ZERO);
            }
            if ($s_app_status == VALUE_FIVE) {
                $this->db->where('r.appointment_status', VALUE_ONE);
            }
            if ($s_app_status == VALUE_FOUR || $s_app_status == VALUE_FIVE) {
                $this->db->where('r.query_status !=' . VALUE_ONE);
                $this->db->where('r.query_status !=' . VALUE_TWO);
                $this->db->where('r.status != ' . VALUE_THREE);
                $this->db->where('r.status != ' . VALUE_FIVE);
                $this->db->where('r.status != ' . VALUE_SIX);
            }
        }
        if ($s_qstatus != '') {
            $this->db->where('r.query_status', $s_qstatus);
        }
        if ($s_status != '') {
            $this->db->where('r.status', $s_status);
        }
        $this->_bd_for_session_id();
    }

    function _bd_for_session_id() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
    }

    function get_records_for_excel($s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status) {
        $this->db->select('r.application_number, r.submitted_datetime, r.applicant_name, r.communication_address, r.mobile_number, '
                . 'r.district, r.applicant_dob,r.applicant_born_place,r.registration_number, r.status, r.query_status');

        $this->_bd_for_search_bc($s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('birth_certificate AS r');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        $this->db->order_by('r.birth_certificate_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_basic_data_for_bc($birth_certificate_id) {
        $this->db->select('r.*, sau.name AS actioner_user_name');
        $this->db->where('r.birth_certificate_id', $birth_certificate_id);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('birth_certificate AS r');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        $resc = $this->db->get();
        return $resc->row_array();
    }
}

/*
 * EOF: ./application/models/Birth_Certificate_model.php
 */