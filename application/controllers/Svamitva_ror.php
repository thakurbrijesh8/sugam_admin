<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Svamitva_Ror extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('svamitva_ror_model');
        $this->load->model('utility_model');
    }

    function get_svamitva_ror_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['svamitva_ror_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;
            
            $search_appno = get_from_post('app_no_for_svamitva_ror_list');
            $search_appd = get_from_post('application_date_for_svamitva_ror_list');
            $search_appdet = filter_var(get_from_post('app_details_for_svamitva_ror_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_svamitva_ror_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_svamitva_ror_list');
            $search_status = get_from_post('status_for_svamitva_ror_list');
            $s_plan_status = get_from_post('is_plan_status_for_svamitva_ror_list');
            $search_svamitva_ror_id = get_from_post('svamitva_ror_id');

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['svamitva_ror_data'] = $this->svamitva_ror_model->get_all_svamitva_ror_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_status, $s_plan_status, $search_svamitva_ror_id);
            $success_array['recordsTotal'] = $this->svamitva_ror_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_status != '' || $s_plan_status || $search_svamitva_ror_id) {
                $success_array['recordsFiltered'] = $this->svamitva_ror_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_status, $s_plan_status, $search_svamitva_ror_id);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['svamitva_ror_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['svamitva_ror_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_svamitva_ror_data_by_id() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array('INVALID_ACCESS_MESSAGE 23'));
                return false;
            }
            $svamitva_ror_id = get_from_post('svamitva_ror_id');
            if (!$svamitva_ror_id) {
                echo json_encode(get_error_array('INVALID_ACCESS_MESSAGE 1'));
                return false;
            }
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE &&
                    $module_type != VALUE_FIVE) {
                echo json_encode(get_error_array('INVALID_ACCESS_MESSAGE 2'));
                return false;
            }
            $this->db->trans_start();
            $svamitva_ror_data = $this->utility_model->get_by_id('svamitva_ror_id', $svamitva_ror_id, 'svamitva_ror');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($svamitva_ror_data)) {
                echo json_encode(get_error_array('INVALID_ACCESS_MESSAGE 3'));
                return false;
            }
            $form_land_details = $this->utility_model->get_result_data_by_id('module_id', $svamitva_ror_id, 'form_land_details', 'module_type', VALUE_SIX, 'module_id', 'DESC');
            $success_array = get_success_array();
            $success_array['svamitva_ror_data'] = $svamitva_ror_data;
            $success_array['form_land_details'] = $form_land_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_data_by_svamitva_ror_id() {
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
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $svamitva_ror_id = get_from_post('svamitva_ror_id');
            if (!$svamitva_ror_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $svamitva_ror_data = $this->utility_model->get_by_id('svamitva_ror_id', $svamitva_ror_id, 'svamitva_ror');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($svamitva_ror_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['svamitva_ror_data'] = $svamitva_ror_data;
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
            $svamitva_ror_id = get_from_post('svamitva_ror_id_for_svamitva_ror_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$svamitva_ror_id || $svamitva_ror_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_svamitva_ror_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('svamitva_ror_id', $svamitva_ror_id, 'svamitva_ror');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_data['status'] != VALUE_TWO || $ex_data['plan_status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_TWENTYTWO, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('svamitva_ror_id', $svamitva_ror_id, 'svamitva_ror', $update_data);

            $this->utility_lib->update_au_sign_in_eocs_copy($session_user_id, $ex_data['district'], VALUE_SIX, VALUE_FOUR, $svamitva_ror_id);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWENTYTWO, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWENTYTWO, $ex_data);
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
            $svamitva_ror_id = get_from_post('svamitva_ror_id_for_svamitva_ror_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$svamitva_ror_id || $svamitva_ror_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_svamitva_ror_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('svamitva_ror_id', $svamitva_ror_id, 'svamitva_ror');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_TWENTYTWO, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('svamitva_ror_id', $svamitva_ror_id, 'svamitva_ror', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_SIX, VALUE_TWENTYTWO, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_SIX, VALUE_TWENTYTWO, $ex_data);
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

    function request_for_view_copy() {
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
            $form_land_details_id = get_from_post('form_land_details_id');
            if (!$form_land_details_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $srorld_data = $this->svamitva_ror_model->get_form_data_with_land_details(VALUE_SIX, $form_land_details_id);
            if (empty($srorld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($srorld_data['total_copy_generated'] != $srorld_data['copies']) {
                echo json_encode(get_error_array(COPY_NOT_GENERATED_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $copy_details = $this->utility_model->get_result_data_by_id_multiple('module_type', VALUE_SIX, 'form_copy', 'module_id', $srorld_data['module_id'], 'form_land_details_id', $srorld_data['form_land_details_id']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['srorld_data'] = $srorld_data;
            $success_array['copy_details'] = $copy_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_status_for_sror() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $svamitva_ror_id = get_from_post('sror_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $svamitva_ror_id == NULL || !$svamitva_ror_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_THREE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $remarks = get_from_post('remarks');
            if (!$remarks) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $ex_sror_data = $this->utility_model->get_by_id('svamitva_ror_id', $svamitva_ror_id, 'svamitva_ror');
            if (empty($ex_sror_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $sror_data = array();
            $success_mesage = array();
            if ($module_type == VALUE_THREE) {
                if ($ex_sror_data['is_checked'] == VALUE_ONE) {
                    echo json_encode(get_error_array(SROR_DETAILS_AL_CHECKED_MESSAGE));
                    return false;
                }
                $sror_data['plan_status'] = VALUE_FOUR;
                $sror_data['is_checked'] = VALUE_ONE;
                $sror_data['checked_details'] = json_encode(array('checked_remarks' => $remarks, 'checked_by' => $session_user_id,
                    'checked_name' => get_from_session('name'), 'checked_datetime' => date('Y-m-d H:i:s')));
                $success_mesage = SROR_DETAILS_CHECKED_MESSAGE;
            }
            $this->db->trans_start();
            if (!empty($sror_data)) {
                $this->utility_model->update_data('svamitva_ror_id', $svamitva_ror_id, 'svamitva_ror', $sror_data);
            }
            if ($module_type == VALUE_THREE) {
                $this->utility_lib->update_au_sign_in_eocs_copy($session_user_id, $ex_sror_data['district'], VALUE_SIX, $module_type, $svamitva_ror_id);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = $success_mesage;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function request_for_generate_copy() {
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
            $form_land_details_id = get_from_post('form_land_details_id');
            if (!$form_land_details_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $srorld_data = $this->svamitva_ror_model->get_form_data_with_land_details(VALUE_SIX, $form_land_details_id, true);
            if (empty($srorld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($srorld_data['status'] != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($srorld_data['total_copy_generated'] == $srorld_data['copies']) {
                echo json_encode(get_error_array(COPY_ALREADY_GENERATED_MESSAGE));
                return false;
            }
            if ($srorld_data['binary_nakal'] == '') {
                $pdf_data = $this->svamitva_ror_model->get_daman_urban_ror_data($srorld_data['village'], $srorld_data['survey'], $srorld_data['subdiv']);
                if (count($pdf_data) == 0) {
                    echo json_encode(get_error_array(ROR_NOT_FOUND_MESSAGE));
                    return false;
                }
                $binary_data = array();
                $binary_data['binary_nakal'] = $pdf_data['property_card'];
                $this->utility_model->update_data('form_land_details_id', $srorld_data['form_land_details_id'], 'form_land_details', $binary_data);

                $srorld_data['binary_nakal'] = $binary_data['binary_nakal'];
            }
            error_reporting(E_ERROR);
            $nakal_path = 'documents/temp/sror-' . $form_land_details_id . '.pdf';
            file_put_contents($nakal_path, base64_decode($srorld_data['binary_nakal']));
            $this->db->trans_start();
            $total_copy_generated = $srorld_data['total_copy_generated'];
            for ($i = ($srorld_data['total_copy_generated'] + 1); $i <= $srorld_data['copies']; $i++) {
                $this->_generate_ror($srorld_data, $form_land_details_id, $i, $nakal_path, $session_user_id);
                $total_copy_generated++;
            }
            $is_fc_generated = true;
            $land_details = $srorld_data['land_details'] != '' ? json_decode($srorld_data['land_details'], true) : array();
            if (!empty($land_details)) {
                foreach ($land_details as &$ld) {
                    if ($ld['form_land_details_id'] == $srorld_data['form_land_details_id']) {
                        $ld['total_copy_generated'] = $total_copy_generated;
                    }

                    if ($ld['total_copy_generated'] != $ld['copies']) {
                        $is_fc_generated = false;
                    }
                }
                $u_array = array();
                $u_array['land_details'] = json_encode($land_details);
                $u_array['plan_status'] = VALUE_TWO;
                if (!$is_fc_generated) {
                    $u_array['plan_status'] = VALUE_ONE;
                }
                $this->utility_model->update_data('svamitva_ror_id', $srorld_data['svamitva_ror_id'], 'svamitva_ror', $u_array);
                $srorld_data['plan_status'] = $u_array['plan_status'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                unlink($nakal_path);
            }
            $srorld_data['land_details'] = json_encode($land_details);
            $success_array = get_success_array();
            $success_array['message'] = ROR_GENERATED_MESSAGE;
            $success_array['svamitva_ror_data'] = $srorld_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _generate_ror($srorld_data, $form_land_details_id, $i, $nakal_path, $session_user_id) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $fc_data = array();
        $fc_data['module_type'] = $srorld_data['module_type'];
        $fc_data['module_id'] = $srorld_data['module_id'];
        $fc_data['form_land_details_id'] = $srorld_data['form_land_details_id'];
        $fc_data['reference_number'] = $form_land_details_id . '-' . $i;
        $fc_data['created_by'] = $session_user_id;
        $fc_data['created_time'] = date('Y-m-d H:i:s');
        $fc_data['form_copy_id'] = $this->utility_model->insert_data('form_copy', $fc_data);

        $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; border-top:1px solid black; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
        $page_count = $mpdf->setSourceFile($nakal_path);
        for ($i = 1; $i <= $page_count; $i++) {
            if ($i != 1) {
                $mpdf->AddPage();
            }
            $mpdf->UseTemplate($mpdf->importPage($i));
        }
        $mpdf->defaultfooterline = 0;
        $mpdf->SetFooter($this->load->view('svamitva_ror/copy_footer', array('sror_data' => $srorld_data, 'fc_data' => $fc_data), TRUE));
        $final_filepath = 'documents/temp/sror-new-' . $form_land_details_id . '-' . $i . '.pdf';
        $mpdf->Output($final_filepath, 'F');
        $fcu_data = array();
        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
        $this->utility_model->update_data('form_copy_id', $fc_data['form_copy_id'], 'form_copy', $fcu_data);
        if (file_exists($final_filepath)) {
            unlink($final_filepath);
        }
        $this->utility_model->update_total_copy_generated($srorld_data['form_land_details_id']);
    }
}

/*
 * EOF: ./application/controller/Svamitva_Ror.php
 */