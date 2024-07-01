<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('logs_model');
    }

    function get_admin_login_logs_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['admin_login_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($user_id == NULL || !$user_id) {
                echo json_encode($success_array);
                return false;
            }
            $columns = $this->input->post('columns');
            $s_ud = trim($columns[1]['search']['value']);

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['admin_login_data'] = $this->logs_model->get_admin_login_logs($start, $length, $s_ud);
            $success_array['recordsTotal'] = $this->logs_model->get_admin_total_count_of_records();
            if ($s_ud != '') {
                $success_array['recordsFiltered'] = $this->logs_model->get_admin_filter_count_of_records($s_ud);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['admin_login_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['admin_login_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_user_login_logs_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['user_login_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($user_id == NULL || !$user_id) {
                echo json_encode($success_array);
                return false;
            }
            $columns = $this->input->post('columns');
            $s_ud = trim($columns[1]['search']['value']);

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['user_login_data'] = $this->logs_model->get_user_login_logs($start, $length, $s_ud);
            $success_array['recordsTotal'] = $this->logs_model->get_user_total_count_of_records();
            if ($s_ud != '') {
                $success_array['recordsFiltered'] = $this->logs_model->get_user_filter_count_of_records($s_ud);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['user_login_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['user_login_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_dg_locker_api_logs_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['dgl_api_logs_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($user_id == NULL || !$user_id) {
                echo json_encode($success_array);
                return false;
            }
            $columns = $this->input->post('columns');
            $s_dt = trim($columns[2]['search']['value']);
            $s_dgld = trim($columns[3]['search']['value']);
            $s_ya = trim($columns[4]['search']['value']);
            $s_mb = trim($columns[5]['search']['value']);
            $s_od = trim($columns[6]['search']['value']);

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['dgl_api_logs_data'] = $this->logs_model->get_dgl_api_logs_data($start, $length, $s_dt, $s_dgld, $s_ya, $s_mb, $s_od);
            $success_array['recordsTotal'] = $this->logs_model->get_dgl_api_logs_total_count_of_records();
            if ($s_dt != '' || $s_dgld != '' || $s_ya != '' || $s_mb != '' || $s_od != '') {
                $success_array['recordsFiltered'] = $this->logs_model->get_dgl_api_logs_filter_count_of_records($s_dt, $s_dgld, $s_ya, $s_mb, $s_od);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['dgl_api_logs_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['dgl_api_logs_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_email_logs_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['email_logs_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($user_id == NULL || !$user_id) {
                echo json_encode($success_array);
                return false;
            }
            $columns = $this->input->post('columns');
            $s_dt = trim($columns[1]['search']['value']);
            $s_et = trim($columns[2]['search']['value']);
            $s_email = trim($columns[4]['search']['value']);

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['email_logs_data'] = $this->logs_model->get_email_logs_data($start, $length, $s_dt, $s_et, $s_email);
            $success_array['recordsTotal'] = $this->logs_model->get_email_logs_total_count_of_records();
            if ($s_dt != '' || $s_et != '' || $s_email != '') {
                $success_array['recordsFiltered'] = $this->logs_model->get_email_logs_filter_count_of_records($s_dt, $s_et, $s_email);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['email_logs_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['email_logs_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_ddd_api_logs_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['ddd_api_logs_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($user_id == NULL || !$user_id) {
                echo json_encode($success_array);
                return false;
            }
            $columns = $this->input->post('columns');
            $s_dt = trim($columns[1]['search']['value']);
            $s_et = trim($columns[2]['search']['value']);
            $s_oip = trim($columns[3]['search']['value']);
            $s_ip = trim($columns[4]['search']['value']);

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['ddd_api_logs_data'] = $this->logs_model->get_ddd_api_logs_data($start, $length, $s_dt, $s_et, $s_oip, $s_ip);
            $success_array['recordsTotal'] = $this->logs_model->get_ddd_api_logs_total_count_of_records();
            if ($s_dt != '' || $s_et != '' || $s_oip != '' || $s_ip != '') {
                $success_array['recordsFiltered'] = $this->logs_model->get_ddd_api_logs_filter_count_of_records($s_dt, $s_et, $s_oip, $s_ip);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['ddd_api_logs_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['ddd_api_logs_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_sms_logs_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['sms_logs_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($user_id == NULL || !$user_id) {
                echo json_encode($success_array);
                return false;
            }
            $columns = $this->input->post('columns');
            $s_at = trim($columns[2]['search']['value']);
            $s_st = trim($columns[3]['search']['value']);
            $s_mt = trim($columns[4]['search']['value']);
            $s_mob = trim($columns[5]['search']['value']);

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['sms_logs_data'] = $this->logs_model->get_sms_logs_data($start, $length, $s_at, $s_st, $s_mt, $s_mob);
            $success_array['recordsTotal'] = $this->logs_model->get_sms_logs_total_count_of_records();
            if ($s_at != '' || $s_st != '' || $s_mt != '' || $s_mob != '') {
                $success_array['recordsFiltered'] = $this->logs_model->get_sms_logs_filter_count_of_records($s_at, $s_st, $s_mt, $s_mob);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['sms_logs_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['sms_logs_data'] = array();
            echo json_encode($success_array);
        }
    }
}

/*
 * EOF: ./application/controller/Logs.php
 */