<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs_model extends CI_Model {

    function insert_log($table_name, $logs_data) {
        $this->db->insert($table_name, $logs_data);
        return $this->db->insert_id();
    }

    function update_log($table_name, $log_id_name, $log_id, $logs_data) {
        $this->db->where($log_id_name, $log_id);
        $this->db->update($table_name, $logs_data);
    }

    function _bd_for_search_admin_login_logs($s_ud) {
        if ($s_ud != '') {
            $where = "(u.name LIKE '%$s_ud%' OR "
                    . "u.username LIKE '%$s_ud%')";
            $this->db->where($where);
        }
    }

    function get_admin_login_logs($start, $length, $s_ud = '') {
        $this->db->select("lld.*,IF(lld.login_timestamp<=0, '', from_unixtime(lld.login_timestamp, '%d-%m-%Y %h:%i:%s')) AS login_time, IF(lld.logout_timestamp<=0, '', from_unixtime(lld.logout_timestamp, '%d-%m-%Y %h:%i:%s')) AS logout_time, u.name, u.username");

        $this->_bd_for_search_admin_login_logs($s_ud);

        $this->db->limit($length, $start);
        $this->db->from('sa_logs_login_details AS lld');
        $this->db->join('sa_users AS u', 'u.sa_user_id = lld.sa_user_id');
        $this->db->order_by('lld.sa_logs_login_details_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_admin_total_count_of_records() {
        $this->db->select('COUNT(sa_logs_login_details_id) AS total_records');
        $this->db->from('sa_logs_login_details');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_admin_filter_count_of_records($s_ud = '') {
        $this->db->select('COUNT(lld.sa_logs_login_details_id) AS total_records');

        $this->_bd_for_search_admin_login_logs($s_ud);

        $this->db->from('sa_logs_login_details AS lld');
        $this->db->join('sa_users AS u', 'u.sa_user_id = lld.sa_user_id');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function _bd_for_search_user_login_logs($s_ud) {
        if ($s_ud != '') {
            $where = "(u.applicant_name LIKE '%$s_ud%' OR "
                    . "u.mobile_number LIKE '%$s_ud%')";
            $this->db->where($where);
        }
    }

    function get_user_login_logs($start, $length, $s_ud = '') {
        $this->db->select("lld.*,IF(lld.login_timestamp<=0, '', from_unixtime(lld.login_timestamp, '%d-%m-%Y %h:%i:%s')) AS login_time, IF(lld.logout_timestamp<=0, '', from_unixtime(lld.logout_timestamp, '%d-%m-%Y %h:%i:%s')) AS logout_time, "
                . "u.applicant_name, u.mobile_number");

        $this->_bd_for_search_user_login_logs($s_ud);

        $this->db->limit($length, $start);
        $this->db->from('logs_login_details AS lld');
        $this->db->join('users AS u', 'u.user_id = lld.user_id');
        $this->db->order_by('lld.logs_login_details_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_user_total_count_of_records() {
        $this->db->select('COUNT(logs_login_details_id) AS total_records');
        $this->db->from('logs_login_details');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_user_filter_count_of_records($s_ud = '') {
        $this->db->select('COUNT(lld.logs_login_details_id) AS total_records');

        $this->_bd_for_search_user_login_logs($s_ud);

        $this->db->from('logs_login_details AS lld');
        $this->db->join('users AS u', 'u.user_id = lld.user_id');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function _bd_for_search_dgl_api_logs($s_dt, $s_dgld, $s_ya, $s_mb, $s_od) {
        if ($s_dt != '') {
            $where = "(document_type LIKE '%$s_dt%' OR "
                    . "DATE_FORMAT(created_time,'%d-%m-%Y %H:%i:%s') LIKE '%$s_dt%')";
            $this->db->where($where);
        }
        if ($s_dgld != '') {
            $where = "(uri LIKE '%$s_dgld%' OR "
                    . "digi_locker_id LIKE '%$s_dgld%' OR "
                    . "fullname LIKE '%$s_dgld%' OR "
                    . "date_of_birth LIKE '%$s_dgld%' OR "
                    . "gender LIKE '%$s_dgld%')";
            $this->db->where($where);
        }
        if ($s_ya != '') {
            $where = "(year_of_birth LIKE '%$s_ya%' OR "
                    . "application_number LIKE '%$s_ya%')";
            $this->db->where($where);
        }
        if ($s_mb != '') {
            $where = "(mobile_number LIKE '%$s_mb%' OR "
                    . "barcode_number LIKE '%$s_mb%')";
            $this->db->where($where);
        }
        if ($s_od != '') {
            $where = "(message LIKE '%$s_od%' OR "
                    . "ip_address LIKE '%$s_od%')";
            $this->db->where($where);
        }
    }

    function get_dgl_api_logs_data($start, $length, $s_dt = '', $s_dgld = '', $s_ya = '', $s_mb = '', $s_od = '') {
        $this->db->select('*');

        $this->_bd_for_search_dgl_api_logs($s_dt, $s_dgld, $s_ya, $s_mb, $s_od);

        $this->db->limit($length, $start);
        $this->db->from('logs_dg_locker_api');
        $this->db->order_by('logs_dg_locker_api_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_dgl_api_logs_total_count_of_records() {
        $this->db->select('COUNT(logs_dg_locker_api_id) AS total_records');
        $this->db->from('logs_dg_locker_api');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_dgl_api_logs_filter_count_of_records($s_dt = '', $s_dgld = '', $s_ya = '', $s_mb = '', $s_od = '') {
        $this->db->select('COUNT(logs_dg_locker_api_id) AS total_records');

        $this->_bd_for_search_dgl_api_logs($s_dt, $s_dgld, $s_ya, $s_mb, $s_od);

        $this->db->from('logs_dg_locker_api');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function _bd_for_search_email_logs($s_dt, $s_et, $s_email) {
        if ($s_dt != '') {
            $this->db->like("DATE_FORMAT(created_time,'%d-%m-%Y %H:%i:%s')", $s_dt);
        }
        if ($s_et != '') {
            $this->db->where('email_type', $s_et);
        }
        if ($s_email != '') {
            $this->db->like('email', $s_email);
        }
    }

    function get_email_logs_data($start, $length, $s_dt = '', $s_et = '', $s_email = '') {
        $this->db->select('*');

        $this->_bd_for_search_email_logs($s_dt, $s_et, $s_email);

        $this->db->limit($length, $start);
        $this->db->from('logs_email');
        $this->db->order_by('email_log_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_email_logs_total_count_of_records() {
        $this->db->select('COUNT(email_log_id) AS total_records');
        $this->db->from('logs_email');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_email_logs_filter_count_of_records($s_dt = '', $s_et = '', $s_email = '') {
        $this->db->select('COUNT(email_log_id) AS total_records');

        $this->_bd_for_search_email_logs($s_dt, $s_et, $s_email);

        $this->db->from('logs_email');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function _bd_for_search_ddd_api_logs($s_dt, $s_et, $s_oip, $s_ip) {
        if ($s_dt != '') {
            $this->db->like("DATE_FORMAT(created_time,'%d-%m-%Y %H:%i:%s')", $s_dt);
        }
        if ($s_et != '') {
            $this->db->where('api_type', $s_et);
        }
        if ($s_oip != '') {
            $this->db->like('is_other_ip_address', $s_oip);
        }
        if ($s_ip != '') {
            $this->db->like('ip_address', $s_ip);
        }
    }

    function get_ddd_api_logs_data($start, $length, $s_dt = '', $s_et = '', $s_oip = '', $s_ip = '') {
        $this->db->select('*');

        $this->_bd_for_search_ddd_api_logs($s_dt, $s_et, $s_oip, $s_ip);

        $this->db->limit($length, $start);
        $this->db->from('logs_api_ddd');
        $this->db->order_by('logs_api_ddd_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_ddd_api_logs_total_count_of_records() {
        $this->db->select('COUNT(logs_api_ddd_id) AS total_records');
        $this->db->from('logs_api_ddd');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_ddd_api_logs_filter_count_of_records($s_dt = '', $s_et = '', $s_oip = '', $s_ip = '') {
        $this->db->select('COUNT(logs_api_ddd_id) AS total_records');

        $this->_bd_for_search_ddd_api_logs($s_dt, $s_et, $s_oip, $s_ip);

        $this->db->from('logs_api_ddd');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }
    
     function _bd_for_search_sms_logs($s_at, $s_st, $s_mt, $s_mob) {
        if ($s_at != '') {
            $this->db->where('app_type', $s_at);
        }
        if ($s_st != '') {
            $this->db->where('sms_type', $s_st);
        }
        if ($s_mt != '') {
            $this->db->where('module_type', $s_mt);
        }
        if ($s_mob != '') {
            $this->db->like('mobile_number', $s_mob);
        }
    }

    function get_sms_logs_data($start, $length, $s_at = '', $s_st = '', $s_mt = '', $s_mob = '') {
        $this->db->select('*');

        $this->_bd_for_search_sms_logs($s_at, $s_st, $s_mt, $s_mob);

        $this->db->limit($length, $start);
        $this->db->from('logs_sms');
        $this->db->order_by('logs_sms_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_sms_logs_total_count_of_records() {
        $this->db->select('COUNT(logs_sms_id) AS total_records');
        $this->db->from('logs_sms');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_sms_logs_filter_count_of_records($s_at = '', $s_st = '', $s_mt = '', $s_mob = '') {
        $this->db->select('COUNT(logs_sms_id) AS total_records');

        $this->_bd_for_search_sms_logs($s_at, $s_st, $s_mt, $s_mob);

        $this->db->from('logs_sms');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

}

/*
 * EOF: ./application/models/Logs_model.php
 */
