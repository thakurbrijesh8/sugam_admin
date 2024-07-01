<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Form_three extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('form_three_model');
        $this->load->model('utility_model');
    }

    function get_form_three_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['form_three_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;
            
            $daman_cv_array = $this->config->item('daman_cv_array');
            
            $search_appno = get_from_post('app_no_for_form_three_list');
            $search_appd = get_from_post('application_date_for_form_three_list');
            $search_appdet = filter_var(get_from_post('app_details_for_form_three_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_form_three_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_form_three_list');
            $search_qstatus = get_from_post('query_status_for_form_three_list');
            $search_status = get_from_post('status_for_form_three_list');
            $new_s_app_status = get_from_post('s_app_status');
            $new_search_appd = get_from_post('s_appd');
            $search_appd = $new_search_appd != '' ? $new_search_appd : $search_appd;
            
            $new_qstatus = get_from_post('s_qstatus');
            $search_qstatus = $new_qstatus != '' ? $new_qstatus : $search_qstatus;
            $new_status = get_from_post('s_status');
            $search_status = $new_status != '' ? $new_status : $search_status;
            
            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->load->model('landtax_na_model');
            $this->db->trans_start();
            $form_three_data = $this->form_three_model->get_all_form_three_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->form_three_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->form_three_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }

//        foreach ($form_three_data as &$ft) {
//            $lds = json_decode($ft['land_details'], true);
//            if (!empty($lds)) {
//                foreach ($lds as &$fldd) {
//                    if ($ft['district'] != VALUE_ZERO && $ft['village'] != VALUE_ZERO && $fldd['survey'] != '' && $fldd['subdiv'] != '') {
//                        $total_pending_amount = $this->utility_lib->get_rural_pending_land_tax_by_dvssk($ft['district'], $ft['village'], $fldd['survey'], $fldd['subdiv']);
//                        if ($total_pending_amount >= 0) {
//                            $fldd['pending_landtax'] = $total_pending_amount;
//                        }
//                    }
//                }
//                $ft['land_details'] = json_encode($lds);
//            }
//        }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['form_three_data'] = array();
                echo json_encode($success_array);
                return;
            }
            $success_array['form_three_data'] = $form_three_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['form_three_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_form_three_data_by_id() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $form_three_id = get_from_post('form_three_id');
            if (!$form_three_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $form_three_data = $this->utility_model->get_by_id('form_three_id', $form_three_id, 'form_three');
            if (empty($form_three_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->load->model('landtax_na_model');
            $this->db->trans_start();
            $form_land_details = $this->utility_model->get_result_data_by_id('module_id', $form_three_id, 'form_land_details', 'module_type', VALUE_TWO, 'module_id', 'DESC');
            if (!empty($form_land_details)) {
                foreach ($form_land_details as &$fldd) {
                    if ($form_three_data['district'] != VALUE_ZERO && $form_three_data['village'] != VALUE_ZERO && $fldd['survey'] != '' && $fldd['subdiv'] != '') {
                        $total_pending_amount = $this->utility_lib->get_rural_pending_land_tax_by_dvssk($form_three_data['district'], $form_three_data['village'], $fldd['survey'], $fldd['subdiv']);
                        if ($total_pending_amount >= 0) {
                            $fldd['pending_landtax'] = $total_pending_amount;
                        }
                    }
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['form_three_data'] = $form_three_data;
            $success_array['form_land_details'] = $form_land_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_data_by_form_three_id() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $form_three_id = get_from_post('form_three_id');
            if (!$form_three_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $form_three_data = $this->utility_model->get_by_id('form_three_id', $form_three_id, 'form_three');
            if (empty($form_three_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['form_three_data'] = $form_three_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_set_appointment() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $form_three_id = get_from_post('form_three_id_for_form_three_set_appointment');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$form_three_id || $form_three_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_data = array();
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('form_three_id', $form_three_id, 'form_three');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_date = get_from_post('appointment_date_for_form_three');
            $appointment_data['appointment_date'] = convert_to_mysql_date_format($appointment_date);
            $appointment_data['appointment_time'] = get_from_post('appointment_time_for_form_three');
            $appointment_data['appointment_by'] = $session_user_id;
            $appointment_data['appointment_by_name'] = get_from_session('name');
            $appointment_data['appointment_datetime'] = $appointment_data['appointment_date'] . ' ' . date("H:i:s", strtotime($appointment_data['appointment_time']));
            $appointment_data['updated_by'] = $session_user_id;
            $appointment_data['updated_time'] = date('Y-m-d H:i:s');
            $appointment_data['appointment_status'] = VALUE_ONE;
            $this->utility_model->update_data('form_three_id', $form_three_id, 'form_three', $appointment_data);
            $form_three_data = $this->utility_model->get_by_id('form_three_id', $form_three_id, 'form_three');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APPOINTMENT_SET_MESSAGE;
            $success_array['form_three_data'] = $form_three_data;
            $success_array['appointment_by_name'] = $appointment_data['appointment_by_name'];
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function approve_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $form_three_id = get_from_post('form_three_id_for_form_three_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$form_three_id || $form_three_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_form_three_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('form_three_id', $form_three_id, 'form_three');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_FOURTEEN, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('form_three_id', $form_three_id, 'form_three', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_FOURTEEN, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_FOURTEEN, $ex_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APP_APPROVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function reject_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $form_three_id = get_from_post('form_three_id_for_form_three_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$form_three_id || $form_three_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_form_three_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('form_three_id', $form_three_id, 'form_three');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_FOURTEEN, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('form_three_id', $form_three_id, 'form_three', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_FOURTEEN, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_FOURTEEN, $ex_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APP_REJECTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/WC.php
 */