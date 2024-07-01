<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Eocs_site_plan extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('eocs_site_plan_model');
        $this->load->model('utility_model');
    }

    function get_eocs_site_plan_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['eocs_site_plan_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;
            
            $search_appno = get_from_post('app_no_for_eocs_site_plan_list');
            $search_appd = get_from_post('application_date_for_eocs_site_plan_list');
            $search_appdet = filter_var(get_from_post('app_details_for_eocs_site_plan_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_eocs_site_plan_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_area_type = get_from_post('area_type_for_eocs_site_plan_list');
            $search_vdw = get_from_post('vdw_for_eocs_site_plan_list');
            $search_qstatus = get_from_post('query_status_for_eocs_site_plan_list');
            $search_status = get_from_post('status_for_eocs_site_plan_list');
            $s_plan_status = get_from_post('is_plan_status_for_eocs_site_plan_list');

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['eocs_site_plan_data'] = $this->eocs_site_plan_model->get_all_eocs_site_plan_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_area_type, $search_vdw, $search_qstatus, $search_status, $s_plan_status);
            $success_array['recordsTotal'] = $this->eocs_site_plan_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_area_type != '' || $search_vdw != '' || $search_qstatus != '' || $search_status != '' || $s_plan_status) {
                $success_array['recordsFiltered'] = $this->eocs_site_plan_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_area_type, $search_vdw, $search_qstatus, $search_status, $s_plan_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['eocs_site_plan_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['eocs_site_plan_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_eocs_site_plan_data_by_id() {
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
            $eocs_site_plan_id = get_from_post('eocs_site_plan_id');
            if (!$eocs_site_plan_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE &&
                    $module_type != VALUE_FOUR && $module_type != VALUE_FIVE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $eocs_site_plan_data = $this->utility_model->get_by_id('eocs_site_plan_id', $eocs_site_plan_id, 'eocs_site_plan');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($eocs_site_plan_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $form_land_details = $this->utility_model->get_result_data_by_id('module_id', $eocs_site_plan_id, 'form_land_details', 'module_type', VALUE_SEVEN, 'module_id', 'DESC');
            if ($module_type == VALUE_FOUR || $module_type == VALUE_FIVE) {
//            $total_generated_copies = VALUE_ZERO;
                $total_copies = VALUE_ZERO;
                $total_fd_generated_copies = VALUE_ZERO;
                $total_fd_copies = VALUE_ZERO;
                $total_fb_generated_copies = VALUE_ZERO;
                $total_fb_copies = VALUE_ZERO;
                foreach ($form_land_details as $fld) {
//                $total_generated_copies += $fld['total_copy_generated'];
                    $total_copies += $fld['copies'];
                    if (isset($ld['apply_with'])) {
                        $aw = $ld['apply_with'] != '' ? explode(',', $ld['apply_with']) : array();
                        if (in_array(VALUE_ONE, $aw)) {
                            $total_fd_generated_copies += $fld['total_fd_copy_generated'];
                            $total_fd_copies += $fld['copies'];
                        }
                        if (in_array(VALUE_TWO, $aw)) {
                            $total_fb_generated_copies += $fld['total_fb_generated_copies'];
                            $total_fb_copies += $fld['copies'];
                        }
                    }
                }
//            if ($total_generated_copies != $total_copies && $total_copies != VALUE_ZERO) {
//                echo json_encode(get_error_array(SP_COPY_NOT_GENERATED_PGC_MESSAGE));
//                return false;
//            }
                if ($total_fd_generated_copies != $total_fd_copies && $total_fd_copies != VALUE_ZERO) {
                    echo json_encode(get_error_array('Form-D' . SP_FDB_COPY_NOT_GENERATED_MESSAGE));
                    return false;
                }
                if ($total_fb_generated_copies != $total_fb_copies && $total_fb_copies != VALUE_ZERO) {
                    echo json_encode(get_error_array('Form-B' . SP_FDB_COPY_NOT_GENERATED_MESSAGE));
                    return false;
                }
            }
            if ($module_type == VALUE_FIVE) {
                if ($eocs_site_plan_data['is_prepared'] != VALUE_ONE) {
                    echo json_encode(get_error_array(SP_DETAILS_NOT_PREPARED_MESSAGE));
                    return false;
                }
            }
            $success_array = get_success_array();
            $success_array['eocs_site_plan_data'] = $eocs_site_plan_data;
            $success_array['form_land_details'] = $form_land_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_data_by_eocs_site_plan_id() {
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
            $eocs_site_plan_id = get_from_post('eocs_site_plan_id');
            if (!$eocs_site_plan_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $eocs_site_plan_data = $this->utility_model->get_by_id('eocs_site_plan_id', $eocs_site_plan_id, 'eocs_site_plan');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($eocs_site_plan_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
//        if ($module_type == VALUE_ONE) {
//            $pending_details = $this->eocs_site_plan_model->get_pending_generate_copy_details(VALUE_SEVEN, $eocs_site_plan_id);
//            if (!empty($pending_details)) {
//                echo json_encode(get_error_array(SP_COPY_NOT_GENERATED_PGC_MESSAGE));
//                return false;
//            }
//        }
            $success_array = get_success_array();
            $success_array['eocs_site_plan_data'] = $eocs_site_plan_data;
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
            $eocs_site_plan_id = get_from_post('eocs_site_plan_id_for_eocs_site_plan_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$eocs_site_plan_id || $eocs_site_plan_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_eocs_site_plan_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('eocs_site_plan_id', $eocs_site_plan_id, 'eocs_site_plan');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_data['status'] != VALUE_FOUR || $ex_data['plan_status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_TWENTYTHREE, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('eocs_site_plan_id', $eocs_site_plan_id, 'eocs_site_plan', $update_data);

            $this->utility_lib->update_au_sign_in_eocs_copy($session_user_id, $ex_data['district'], VALUE_SEVEN, VALUE_FOUR, $eocs_site_plan_id);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWENTYTHREE, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWENTYTHREE, $ex_data);
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
            $eocs_site_plan_id = get_from_post('eocs_site_plan_id_for_eocs_site_plan_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$eocs_site_plan_id || $eocs_site_plan_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_eocs_site_plan_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('eocs_site_plan_id', $eocs_site_plan_id, 'eocs_site_plan');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_TWENTYTHREE, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('eocs_site_plan_id', $eocs_site_plan_id, 'eocs_site_plan', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TWENTYTHREE, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TWENTYTHREE, $ex_data);
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

    function request_for_upload_plan_copy() {
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
            $this->db->trans_start();
            $espld_data = $this->eocs_site_plan_model->get_esp_data_with_land_details(VALUE_SEVEN, $form_land_details_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($espld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($espld_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($espld_data['total_copy_generated'] == $espld_data['copies']) {
                echo json_encode(get_error_array(SP_COPY_ALREADY_GENERATED_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['eocs_site_plan_data'] = $espld_data;
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
            $espld_data = $this->eocs_site_plan_model->get_esp_data_with_land_details(VALUE_SEVEN, $form_land_details_id, true);
            if (empty($espld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($espld_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($espld_data['total_copy_generated'] == $espld_data['copies']) {
                echo json_encode(get_error_array(SP_COPY_ALREADY_GENERATED_MESSAGE));
                return false;
            }
            if ($_FILES['plan_copy_for_espuc']['name'] == '') {
                echo json_encode(get_error_array(UPLOAD_DOC_MESSAGE));
                return;
            }
            $pdf_size = $_FILES['plan_copy_for_espuc']['size'];
            if ($pdf_size == 0) {
                echo json_encode(get_error_array(DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $nakal_path = 'documents/temp/esp-pc_' . $form_land_details_id . '.pdf';
            $this->load->library('upload');
            if (!move_uploaded_file($_FILES['plan_copy_for_espuc']['tmp_name'], $nakal_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                $binary_data = array();
                $binary_data['binary_nakal'] = chunk_split(base64_encode(file_get_contents($nakal_path)));
                $this->utility_model->update_data('form_land_details_id', $espld_data['form_land_details_id'], 'form_land_details', $binary_data);

                $espld_data['binary_nakal'] = $binary_data['binary_nakal'];
            }

            error_reporting(E_ERROR);
            $this->db->trans_start();
            $total_copy_generated = $espld_data['total_copy_generated'];
            for ($i = ($espld_data['total_copy_generated'] + 1); $i <= $espld_data['copies']; $i++) {
                $this->_generate_esp($espld_data, $form_land_details_id, $i, $nakal_path, $session_user_id);
                $total_copy_generated++;
            }

            $is_fdc_generated = true;
            $is_fbc_generated = true;
            $land_details = $espld_data['land_details'] != '' ? json_decode($espld_data['land_details'], true) : array();
            if (!empty($land_details)) {
                foreach ($land_details as &$ld) {
                    if ($ld['form_land_details_id'] == $espld_data['form_land_details_id']) {
                        $ld['total_copy_generated'] = $total_copy_generated;
                    }
                    if (isset($ld['apply_with'])) {
                        $aw = $ld['apply_with'] != '' ? explode(',', $ld['apply_with']) : array();
                        if (!empty($aw)) {
                            if (in_array(VALUE_ONE, $aw) && $ld['total_fd_copy_generated'] != $ld['copies']) {
                                $is_fdc_generated = false;
                            }
                            if (in_array(VALUE_TWO, $aw) && $ld['total_fb_copy_generated'] != $ld['copies']) {
                                $is_fbc_generated = false;
                            }
                        }
                    }
                }
                $u_array = array();
                $u_array['land_details'] = json_encode($land_details);
                $u_array['plan_status'] = VALUE_TWO;
//            $pending_details = $this->eocs_site_plan_model->get_pending_generate_copy_details(VALUE_SEVEN, $espld_data['eocs_site_plan_id']);
//            if (!empty($pending_details) || !$is_fdc_generated || !$is_fbc_generated) {
//                $u_array['plan_status'] = VALUE_ONE;
//            }
                if (!$is_fdc_generated || !$is_fbc_generated) {
                    $u_array['plan_status'] = VALUE_ONE;
                }
                $this->utility_model->update_data('eocs_site_plan_id', $espld_data['eocs_site_plan_id'], 'eocs_site_plan', $u_array);
                $espld_data['plan_status'] = $u_array['plan_status'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                unlink($nakal_path);
            }
            $espld_data['land_details'] = json_encode($land_details);
            $success_array = get_success_array();
            $success_array['message'] = SP_COPY_GENERATED_MESSAGE;
            $success_array['eocs_site_plan_data'] = $espld_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _generate_esp($espld_data, $form_land_details_id, $i, $nakal_path, $session_user_id) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
        $fc_data = array();
        $fc_data['module_type'] = $espld_data['module_type'];
        $fc_data['module_id'] = $espld_data['module_id'];
        $fc_data['form_land_details_id'] = $espld_data['form_land_details_id'];
        $fc_data['reference_number'] = $form_land_details_id . '-' . $i;
        $fc_data['created_by'] = $session_user_id;
        $fc_data['created_time'] = date('Y-m-d H:i:s');
        $fc_data['form_copy_id'] = $this->utility_model->insert_data('form_copy', $fc_data);

        $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
        $page_count = $mpdf->setSourceFile($nakal_path);
        for ($i = 1; $i <= $page_count; $i++) {
            if ($i != 1) {
                $mpdf->AddPage();
            }
            $mpdf->UseTemplate($mpdf->importPage($i));
        }
        $mpdf->WriteHTML($this->load->view('eocs_site_plan/copy_footer', array('espld_data' => $espld_data, 'fc_data' => $fc_data), TRUE));
        $final_filepath = FCPATH . 'documents/temp/esp-new-' . $form_land_details_id . '-' . $i . '.pdf';
        $mpdf->Output($final_filepath, 'F');
        $fcu_data = array();
        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
        $this->utility_model->update_data('form_copy_id', $fc_data['form_copy_id'], 'form_copy', $fcu_data);
        if (file_exists($final_filepath)) {
            unlink($final_filepath);
        }
        $this->utility_model->update_total_copy_generated($espld_data['form_land_details_id']);
    }

    function _generate_esp_with_nic_page($espld_data, $form_land_details_id, $i, $nakal_path, $session_user_id) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $fc_data = array();
        $fc_data['module_type'] = $espld_data['module_type'];
        $fc_data['module_id'] = $espld_data['module_id'];
        $fc_data['form_land_details_id'] = $espld_data['form_land_details_id'];
        $fc_data['reference_number'] = $form_land_details_id . '-' . $i;
        $fc_data['created_by'] = $session_user_id;
        $fc_data['created_time'] = date('Y-m-d H:i:s');
        $fc_data['form_copy_id'] = $this->utility_model->insert_data('form_copy', $fc_data);
        $mpdf->WriteHTML($this->load->view('eocs_site_plan/qr_barcode', array('espld_data' => $espld_data, 'fc_data' => $fc_data), TRUE));
        $qb_nakal_path = 'documents/temp/esp-qb-' . $form_land_details_id . '-' . $i . '.pdf';
        $final_filepath = FCPATH . 'documents/temp/esp-new-' . $form_land_details_id . '-' . $i . '.pdf';
        $mpdf->Output($qb_nakal_path, 'F');
        merge_pdf($final_filepath, array($qb_nakal_path, $nakal_path));
        $fcu_data = array();
        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
        $this->utility_model->update_data('form_copy_id', $fc_data['form_copy_id'], 'form_copy', $fcu_data);
        if (file_exists($qb_nakal_path)) {
            unlink($qb_nakal_path);
        }
        if (file_exists($final_filepath)) {
            unlink($final_filepath);
        }
        $this->utility_model->update_total_copy_generated($espld_data['form_land_details_id']);
    }

    function request_for_regenerate_copy() {
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
            $espld_data = $this->eocs_site_plan_model->get_esp_data_with_land_details(VALUE_SEVEN, $form_land_details_id, true);
            if (empty($espld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($espld_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($espld_data['total_copy_generated'] != $espld_data['copies']) {
                echo json_encode(get_error_array(SP_COPY_NOT_GENERATED_MESSAGE));
                return false;
            }
            if ($_FILES['plan_copy_for_espruc']['name'] == '') {
                echo json_encode(get_error_array(UPLOAD_DOC_MESSAGE));
                return;
            }
            $pdf_size = $_FILES['plan_copy_for_espruc']['size'];
            if ($pdf_size == 0) {
                echo json_encode(get_error_array(DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $nakal_path = 'documents/temp/esp-rpc_' . $form_land_details_id . '.pdf';
            $this->load->library('upload');
            if (!move_uploaded_file($_FILES['plan_copy_for_espruc']['tmp_name'], $nakal_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                $binary_data = array();
                $binary_data['binary_nakal'] = chunk_split(base64_encode(file_get_contents($nakal_path)));
                $this->utility_model->update_data('form_land_details_id', $espld_data['form_land_details_id'], 'form_land_details', $binary_data);

                $espld_data['binary_nakal'] = $binary_data['binary_nakal'];
            }
            error_reporting(E_ERROR);
            $this->db->trans_start();
            $ex_copy_details = $this->utility_model->get_result_data_by_id_multiple('module_type', VALUE_SEVEN, 'form_copy', 'module_id', $espld_data['module_id'], 'form_land_details_id', $espld_data['form_land_details_id'], 'form_type', VALUE_ZERO);
            foreach ($ex_copy_details as $fc_data) {
                $this->_regenerate_esp($espld_data, $form_land_details_id, $i, $nakal_path, $fc_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                unlink($nakal_path);
            }
            $success_array = get_success_array();
            $success_array['message'] = SP_COPY_REGENERATED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _regenerate_esp($espld_data, $form_land_details_id, $i, $nakal_path, $fc_data) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
        $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
        $page_count = $mpdf->setSourceFile($nakal_path);
        for ($i = 1; $i <= $page_count; $i++) {
            if ($i != 1) {
                $mpdf->AddPage();
            }
            $mpdf->UseTemplate($mpdf->importPage($i));
        }
        $mpdf->WriteHTML($this->load->view('eocs_site_plan/copy_footer', array('espld_data' => $espld_data, 'fc_data' => $fc_data), TRUE));
        $final_filepath = FCPATH . 'documents/temp/esp-rnew-' . $form_land_details_id . '-' . $i . '.pdf';
        $mpdf->Output($final_filepath, 'F');
        $fcu_data = array();
        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
        $this->utility_model->update_data('form_copy_id', $fc_data['form_copy_id'], 'form_copy', $fcu_data);
        if (file_exists($final_filepath)) {
            unlink($final_filepath);
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
            $espld_data = $this->eocs_site_plan_model->get_esp_data_with_land_details(VALUE_SEVEN, $form_land_details_id);
            if (empty($espld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
//        if ($espld_data['total_copy_generated'] != $espld_data['copies']) {
//            echo json_encode(get_error_array(SP_COPY_NOT_GENERATED_MESSAGE));
//            return false;
//        }
            $this->db->trans_start();
            $copy_details = $this->utility_model->get_result_data_by_id_multiple('module_type', VALUE_SEVEN, 'form_copy', 'module_id', $espld_data['module_id'], 'form_land_details_id', $espld_data['form_land_details_id']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['espld_data'] = $espld_data;
            $success_array['copy_details'] = $copy_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_status_for_esp() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $eocs_site_plan_id = get_from_post('esp_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $eocs_site_plan_id == NULL || !$eocs_site_plan_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $remarks = get_from_post('remarks');
            if (!$remarks) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $ex_esp_data = $this->utility_model->get_by_id('eocs_site_plan_id', $eocs_site_plan_id, 'eocs_site_plan');
            if (empty($ex_esp_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $esp_data = array();
            $success_mesage = array();
            if ($module_type == VALUE_ONE) {
                if ($ex_esp_data['is_verified'] == VALUE_ONE) {
                    echo json_encode(get_error_array(SP_DETAILS_AL_VERIFIED_MESSAGE));
                    return false;
                }
                $esp_data['status'] = VALUE_THREE;
                $esp_data['is_verified'] = VALUE_ONE;
                $esp_data['verified_details'] = json_encode(array('verified_remarks' => $remarks, 'verified_by' => $session_user_id,
                    'verified_name' => get_from_session('name'), 'verified_datetime' => date('Y-m-d H:i:s')));
                $success_mesage = SP_APP_VERIFIED_TO_USER_MESSAGE;
            }
            if ($module_type == VALUE_TWO) {
                if ($ex_esp_data['is_prepared'] == VALUE_ONE) {
                    echo json_encode(get_error_array(SP_DETAILS_AL_PREPARED_MESSAGE));
                    return false;
                }
                $esp_data['plan_status'] = VALUE_THREE;
                $esp_data['is_prepared'] = VALUE_ONE;
                $esp_data['prepared_details'] = json_encode(array('prepared_remarks' => $remarks, 'prepared_by' => $session_user_id,
                    'prepared_name' => get_from_session('name'), 'prepared_datetime' => date('Y-m-d H:i:s')));
                $success_mesage = SP_DETAILS_PREPARED_MESSAGE;
            }
            if ($module_type == VALUE_THREE) {
                if ($ex_esp_data['is_checked'] == VALUE_ONE) {
                    echo json_encode(get_error_array(SP_DETAILS_AL_CHECKED_MESSAGE));
                    return false;
                }
                $esp_data['plan_status'] = VALUE_FOUR;
                $esp_data['is_checked'] = VALUE_ONE;
                $esp_data['checked_details'] = json_encode(array('checked_remarks' => $remarks, 'checked_by' => $session_user_id,
                    'checked_name' => get_from_session('name'), 'checked_datetime' => date('Y-m-d H:i:s')));
                $success_mesage = SP_DETAILS_CHECKED_MESSAGE;
            }
            $this->db->trans_start();
            if (!empty($esp_data)) {
                $this->utility_model->update_data('eocs_site_plan_id', $eocs_site_plan_id, 'eocs_site_plan', $esp_data);
            }
            if ($module_type == VALUE_TWO || $module_type == VALUE_THREE) {
                $this->utility_lib->update_au_sign_in_eocs_copy($session_user_id, $ex_esp_data['district'], VALUE_SEVEN, $module_type, $eocs_site_plan_id);
            }
            if ($module_type == VALUE_ONE) {
                $this->utility_lib->send_fp_email_for_eocs($session_user_id, VALUE_TWENTYTHREE, $ex_esp_data);
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

    function request_for_generate_form_db() {
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
            $form_type = get_from_post('form_type');
            if ($form_type != VALUE_ONE && $form_type != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $espld_data = $this->eocs_site_plan_model->get_esp_data_with_land_details(VALUE_SEVEN, $form_land_details_id, true);
            if (empty($espld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($espld_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($form_type == VALUE_ONE && $espld_data['total_fd_copy_generated'] == $espld_data['copies']) {
                echo json_encode(get_error_array(SP_COPY_ALREADY_GENERATED_MESSAGE));
                return false;
            }
            if ($form_type == VALUE_TWO && $espld_data['total_fb_copy_generated'] == $espld_data['copies']) {
                echo json_encode(get_error_array(SP_COPY_ALREADY_GENERATED_MESSAGE));
                return false;
            }
            $ld_village_sc = $espld_data['ld_area_type'] == VALUE_ONE ? VALUE_ZERO : $espld_data['ld_village_sc'];
            if ($form_type == VALUE_ONE && $espld_data['binary_nakal_fd'] == '') {
                $is_fdb = 'fd';
                $pdf_data = $this->utility_lib->get_daman_urban_form_d_data($ld_village_sc, $espld_data['survey'], $espld_data['subdiv'], $espld_data['ld_area_type']);
                if (count($pdf_data) == 0) {
                    echo json_encode(get_error_array('Form-D' . SP_FDB_NOT_FOUND_MESSAGE));
                    return false;
                }
                $binary_data = array();
                $binary_data['binary_nakal_' . $is_fdb] = $pdf_data[0]['property_card'];
                $this->utility_model->update_data('form_land_details_id', $espld_data['form_land_details_id'], 'form_land_details', $binary_data);
                $espld_data['binary_nakal_' . $is_fdb] = $binary_data['binary_nakal_' . $is_fdb];
            }
            if ($form_type == VALUE_TWO && $espld_data['binary_nakal_fb'] == '') {
                $is_fdb = 'fb';
                $pdf_data = $this->utility_lib->get_daman_urban_form_b_data($ld_village_sc, $espld_data['survey'], $espld_data['subdiv'], $espld_data['ld_area_type']);
                if (count($pdf_data) == 0) {
                    echo json_encode(get_error_array('Form-B' . SP_FDB_NOT_FOUND_MESSAGE));
                    return false;
                }
                $binary_data = array();
                $binary_data['binary_nakal_' . $is_fdb] = $pdf_data[0]['property_card'];
                $this->utility_model->update_data('form_land_details_id', $espld_data['form_land_details_id'], 'form_land_details', $binary_data);
                $espld_data['binary_nakal_' . $is_fdb] = $binary_data['binary_nakal_' . $is_fdb];
            }
            error_reporting(E_ERROR);
            $nakal_path = 'documents/temp/' . $is_fdb . '-' . $form_land_details_id . '.pdf';
            file_put_contents($nakal_path, base64_decode($espld_data['binary_nakal_' . $is_fdb]));
            $this->db->trans_start();
            $total_copy_generated = $espld_data['total_' . $is_fdb . '_copy_generated'];
            for ($i = ($espld_data['total_' . $is_fdb . '_copy_generated'] + 1); $i <= $espld_data['copies']; $i++) {
                $this->_generate_fdb($form_type, $is_fdb, $espld_data, $form_land_details_id, $i, $nakal_path, $session_user_id);
                $total_copy_generated++;
            }
            $is_fdc_generated = true;
            $is_fbc_generated = true;
            $land_details = $espld_data['land_details'] != '' ? json_decode($espld_data['land_details'], true) : array();
            if (!empty($land_details)) {
                foreach ($land_details as &$ld) {
                    if ($ld['form_land_details_id'] == $espld_data['form_land_details_id']) {
                        $ld['total_' . $is_fdb . '_copy_generated'] = $total_copy_generated;
                    }
                    if (isset($ld['apply_with'])) {
                        $aw = $ld['apply_with'] != '' ? explode(',', $ld['apply_with']) : array();
                        if (!empty($aw)) {
                            if (in_array(VALUE_ONE, $aw) && $ld['total_fd_copy_generated'] != $ld['copies']) {
                                $is_fdc_generated = false;
                            }
                            if (in_array(VALUE_TWO, $aw) && $ld['total_fb_copy_generated'] != $ld['copies']) {
                                $is_fbc_generated = false;
                            }
                        }
                    }
                }
                $u_array = array();
                $u_array['land_details'] = json_encode($land_details);
                $u_array['plan_status'] = VALUE_TWO;
//            $pending_details = $this->eocs_site_plan_model->get_pending_generate_copy_details(VALUE_SEVEN, $espld_data['eocs_site_plan_id']);
//            if (!empty($pending_details) || !$is_fdc_generated || !$is_fbc_generated) {
//                $u_array['plan_status'] = VALUE_ONE;
//            }
                if (!$is_fdc_generated || !$is_fbc_generated) {
                    $u_array['plan_status'] = VALUE_ONE;
                }
                $this->utility_model->update_data('eocs_site_plan_id', $espld_data['eocs_site_plan_id'], 'eocs_site_plan', $u_array);
                $espld_data['plan_status'] = $u_array['plan_status'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                unlink($nakal_path);
            }
            $espld_data['land_details'] = json_encode($land_details);
            $success_array = get_success_array();
            $success_array['message'] = ($form_type == VALUE_ONE ? 'Form-D' : 'Form-B') . SP_FDB_GENERATED_MESSAGE;
            $success_array['eocs_site_plan_data'] = $espld_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _generate_fdb($form_type, $is_fdb, $espld_data, $form_land_details_id, $i, $nakal_path, $session_user_id) {
        if ($form_type == VALUE_ONE) {
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Letter']);
        } else {
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A3', 'orientation' => 'L']);
        }
        $fc_data = array();
        $fc_data['module_type'] = $espld_data['module_type'];
        $fc_data['module_id'] = $espld_data['module_id'];
        $fc_data['form_type'] = $form_type;
        $fc_data['form_land_details_id'] = $espld_data['form_land_details_id'];
        $fc_data['reference_number'] = $form_land_details_id . '-' . $i;
        $fc_data['created_by'] = $session_user_id;
        $fc_data['created_time'] = date('Y-m-d H:i:s');
        $fc_data['form_copy_id'] = $this->utility_model->insert_data('form_copy', $fc_data);
        if ($form_type == VALUE_ONE) {
            $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 13px;}.table-header {width: 100%; border-top:1px solid black; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
        } else {
            $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; border-top:1px solid black; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 12px;}.t-a-c{text-align: center;}</style>');
        }
        $page_count = $mpdf->setSourceFile($nakal_path);
        for ($i = 1; $i <= $page_count; $i++) {
            if ($i != 1) {
                $mpdf->AddPage();
            }
            $mpdf->UseTemplate($mpdf->importPage($i));
        }
        $mpdf->defaultfooterline = 0;
        if ($form_type == VALUE_ONE) {
            $mpdf->SetFooter($this->load->view('eocs_site_plan/copy_fd_footer', array('espld_data' => $espld_data, 'fc_data' => $fc_data), TRUE));
        } else {
            $mpdf->SetFooter($this->load->view('eocs_site_plan/copy_fb_footer', array('espld_data' => $espld_data, 'fc_data' => $fc_data), TRUE));
        }
        $final_filepath = 'documents/temp/' . $is_fdb . '-new-' . $form_land_details_id . '-' . $i . '.pdf';
        $mpdf->Output($final_filepath, 'F');
        $fcu_data = array();
        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
        $this->utility_model->update_data('form_copy_id', $fc_data['form_copy_id'], 'form_copy', $fcu_data);
        if (file_exists($final_filepath)) {
            unlink($final_filepath);
        }
        $this->utility_model->update_total_copy_generated($espld_data['form_land_details_id'], $is_fdb . '_');
    }

    function request_for_regenerate_form_db() {
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
            $form_type = get_from_post('form_type');
            if ($form_type != VALUE_ONE && $form_type != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $espld_data = $this->eocs_site_plan_model->get_esp_data_with_land_details(VALUE_SEVEN, $form_land_details_id, true);
            if (empty($espld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($espld_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($form_type == VALUE_ONE && $espld_data['total_fd_copy_generated'] != $espld_data['copies']) {
                echo json_encode(get_error_array('Form-D' . SP_FDB_COPY_NOT_GENERATED_MESSAGE));
                return false;
            }
            if ($form_type == VALUE_TWO && $espld_data['total_fb_copy_generated'] != $espld_data['copies']) {
                echo json_encode(get_error_array('Form-B' . SP_FDB_COPY_NOT_GENERATED_MESSAGE));
                return false;
            }
            $ld_village_sc = $espld_data['ld_area_type'] == VALUE_ONE ? VALUE_ZERO : $espld_data['ld_village_sc'];
            if ($form_type == VALUE_ONE) {
                $is_fdb = 'fd';
                $pdf_data = $this->utility_lib->get_daman_urban_form_d_data($ld_village_sc, $espld_data['survey'], $espld_data['subdiv'], $espld_data['ld_area_type']);
                if (count($pdf_data) == 0) {
                    echo json_encode(get_error_array('Form-D' . SP_FDB_NOT_FOUND_MESSAGE));
                    return false;
                }
                $binary_data = array();
                $binary_data['binary_nakal_' . $is_fdb] = $pdf_data[0]['property_card'];
                $this->utility_model->update_data('form_land_details_id', $espld_data['form_land_details_id'], 'form_land_details', $binary_data);
                $espld_data['binary_nakal_' . $is_fdb] = $binary_data['binary_nakal_' . $is_fdb];
            }
            if ($form_type == VALUE_TWO) {
                $is_fdb = 'fb';
                $pdf_data = $this->utility_lib->get_daman_urban_form_b_data($ld_village_sc, $espld_data['survey'], $espld_data['subdiv'], $espld_data['ld_area_type']);
                if (count($pdf_data) == 0) {
                    echo json_encode(get_error_array('Form-B' . SP_FDB_NOT_FOUND_MESSAGE));
                    return false;
                }
                $binary_data = array();
                $binary_data['binary_nakal_' . $is_fdb] = $pdf_data[0]['property_card'];
                $this->utility_model->update_data('form_land_details_id', $espld_data['form_land_details_id'], 'form_land_details', $binary_data);
                $espld_data['binary_nakal_' . $is_fdb] = $binary_data['binary_nakal_' . $is_fdb];
            }
            error_reporting(E_ERROR);
            $nakal_path = 'documents/temp/' . $is_fdb . '-r-' . $form_land_details_id . '.pdf';
            file_put_contents($nakal_path, base64_decode($espld_data['binary_nakal_' . $is_fdb]));
            $this->db->trans_start();
            $ex_copy_details = $this->utility_model->get_result_data_by_id_multiple('module_type', VALUE_SEVEN, 'form_copy', 'module_id', $espld_data['module_id'], 'form_land_details_id', $espld_data['form_land_details_id'], 'form_type', $form_type);
            foreach ($ex_copy_details as $fc_data) {
                $this->_regenerate_fdb($form_type, $is_fdb, $espld_data, $form_land_details_id, $i, $nakal_path, $fc_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                unlink($nakal_path);
            }
            $success_array = get_success_array();
            $success_array['message'] = ($form_type == VALUE_ONE ? 'Form-D' : 'Form-B') . SP_FDB_REGENERATED_MESSAGE;
            $success_array['eocs_site_plan_data'] = $espld_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _regenerate_fdb($form_type, $is_fdb, $espld_data, $form_land_details_id, $i, $nakal_path, $fc_data) {
        if ($form_type == VALUE_ONE) {
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Letter']);
            $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 13px;}.table-header {width: 100%; border-top:1px solid black; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
        } else {
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A3', 'orientation' => 'L']);
            $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; border-top:1px solid black; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 12px;}.t-a-c{text-align: center;}</style>');
        }
        $page_count = $mpdf->setSourceFile($nakal_path);
        for ($i = 1; $i <= $page_count; $i++) {
            if ($i != 1) {
                $mpdf->AddPage();
            }
            $mpdf->UseTemplate($mpdf->importPage($i));
        }
        $mpdf->defaultfooterline = 0;
        if ($form_type == VALUE_ONE) {
            $mpdf->SetFooter($this->load->view('eocs_site_plan/copy_fd_footer', array('espld_data' => $espld_data, 'fc_data' => $fc_data), TRUE));
        } else {
            $mpdf->SetFooter($this->load->view('eocs_site_plan/copy_fb_footer', array('espld_data' => $espld_data, 'fc_data' => $fc_data), TRUE));
        }
        $final_filepath = 'documents/temp/' . $is_fdb . '-rnew-' . $form_land_details_id . '-' . $i . '.pdf';
        $mpdf->Output($final_filepath, 'F');
        $fcu_data = array();
        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
        $this->utility_model->update_data('form_copy_id', $fc_data['form_copy_id'], 'form_copy', $fcu_data);
        if (file_exists($final_filepath)) {
            unlink($final_filepath);
        }
    }
}

/*
 * EOF: ./application/controller/Eocs_site_plan.php
 */