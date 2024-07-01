<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Eocs_site_plan_rural extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('eocs_site_plan_rural_model');
        $this->load->model('utility_model');
    }

    function get_eocs_site_plan_rural_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['eocs_site_plan_rural_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;
            
            $search_appno = get_from_post('app_no_for_eocs_site_plan_rural_list');
            $search_appd = get_from_post('application_date_for_eocs_site_plan_rural_list');
            $search_appdet = filter_var(get_from_post('app_details_for_eocs_site_plan_rural_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_eocs_site_plan_rural_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_eocs_site_plan_rural_list');
            $search_qstatus = get_from_post('query_status_for_eocs_site_plan_rural_list');
            $search_status = get_from_post('status_for_eocs_site_plan_rural_list');
            $s_plan_status = get_from_post('is_plan_status_for_eocs_site_plan_rural_list');

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['eocs_site_plan_rural_data'] = $this->eocs_site_plan_rural_model->get_all_eocs_site_plan_rural_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_qstatus, $search_status, $s_plan_status);
            $success_array['recordsTotal'] = $this->eocs_site_plan_rural_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_qstatus != '' || $search_status != '' || $s_plan_status) {
                $success_array['recordsFiltered'] = $this->eocs_site_plan_rural_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_qstatus, $search_status, $s_plan_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['eocs_site_plan_rural_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['eocs_site_plan_rural_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_eocs_site_plan_rural_data_by_id() {
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
            $eocs_site_plan_rural_id = get_from_post('eocs_site_plan_rural_id');
            if (!$eocs_site_plan_rural_id) {
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
            $eocs_site_plan_rural_data = $this->utility_model->get_by_id('eocs_site_plan_rural_id', $eocs_site_plan_rural_id, 'eocs_site_plan_rural');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($eocs_site_plan_rural_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $form_land_details = $this->utility_model->get_result_data_by_id('module_id', $eocs_site_plan_rural_id, 'form_land_details', 'module_type', VALUE_NINE, 'module_id', 'DESC');
//        if ($module_type == VALUE_FOUR || $module_type == VALUE_FIVE) {
//            $total_generated_copies = VALUE_ZERO;
//            $total_copies = VALUE_ZERO;
//            foreach ($form_land_details as $fld) {
//                $total_generated_copies += $fld['total_copy_generated'];
//                $total_copies += $fld['copies'];
//            }
//            if ($total_generated_copies != $total_copies && $total_copies != VALUE_ZERO) {
//                echo json_encode(get_error_array(SP_COPY_NOT_GENERATED_PGC_MESSAGE));
//                return false;
//            }
//        }
            if ($module_type == VALUE_FIVE) {
                if ($eocs_site_plan_rural_data['is_prepared'] != VALUE_ONE) {
                    echo json_encode(get_error_array(SP_DETAILS_NOT_PREPARED_MESSAGE));
                    return false;
                }
            }
            $success_array = get_success_array();
            $success_array['eocs_site_plan_rural_data'] = $eocs_site_plan_rural_data;
            $success_array['form_land_details'] = $form_land_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_data_by_eocs_site_plan_rural_id() {
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
            $eocs_site_plan_rural_id = get_from_post('eocs_site_plan_rural_id');
            if (!$eocs_site_plan_rural_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $eocs_site_plan_rural_data = $this->utility_model->get_by_id('eocs_site_plan_rural_id', $eocs_site_plan_rural_id, 'eocs_site_plan_rural');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($eocs_site_plan_rural_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
//        if ($module_type == VALUE_ONE) {
//            $pending_details = $this->eocs_site_plan_rural_model->get_pending_generate_copy_details(VALUE_NINE, $eocs_site_plan_rural_id);
//            if (!empty($pending_details)) {
//                echo json_encode(get_error_array(SP_COPY_NOT_GENERATED_PGC_MESSAGE));
//                return false;
//            }
//        }
            $success_array = get_success_array();
            $success_array['eocs_site_plan_rural_data'] = $eocs_site_plan_rural_data;
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
            $eocs_site_plan_rural_id = get_from_post('eocs_site_plan_rural_id_for_eocs_site_plan_rural_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$eocs_site_plan_rural_id || $eocs_site_plan_rural_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_eocs_site_plan_rural_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('eocs_site_plan_rural_id', $eocs_site_plan_rural_id, 'eocs_site_plan_rural');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_data['status'] != VALUE_FOUR || $ex_data['plan_status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_TWENTYFIVE, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('eocs_site_plan_rural_id', $eocs_site_plan_rural_id, 'eocs_site_plan_rural', $update_data);

//        $this->utility_lib->update_au_sign_in_eocs_copy($session_user_id, $ex_data['district'], VALUE_NINE, VALUE_FOUR, $eocs_site_plan_rural_id);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWENTYFIVE, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWENTYFIVE, $ex_data);
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
            $eocs_site_plan_rural_id = get_from_post('eocs_site_plan_rural_id_for_eocs_site_plan_rural_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$eocs_site_plan_rural_id || $eocs_site_plan_rural_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_eocs_site_plan_rural_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('eocs_site_plan_rural_id', $eocs_site_plan_rural_id, 'eocs_site_plan_rural');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_TWENTYFIVE, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('eocs_site_plan_rural_id', $eocs_site_plan_rural_id, 'eocs_site_plan_rural', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TWENTYFIVE, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TWENTYFIVE, $ex_data);
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
            $esprld_data = $this->eocs_site_plan_rural_model->get_espr_data_with_land_details(VALUE_NINE, $form_land_details_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($esprld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($esprld_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($esprld_data['total_copy_generated'] == $esprld_data['copies']) {
                echo json_encode(get_error_array(SP_COPY_ALREADY_GENERATED_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['eocs_site_plan_rural_data'] = $esprld_data;
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
            $esprld_data = $this->eocs_site_plan_rural_model->get_espr_data_with_land_details(VALUE_NINE, $form_land_details_id, true);
            if (empty($esprld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($esprld_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($esprld_data['total_copy_generated'] == $esprld_data['copies']) {
                echo json_encode(get_error_array(SP_COPY_ALREADY_GENERATED_MESSAGE));
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
            $nakal_path = 'documents/temp/espr-pc_' . $form_land_details_id . '.pdf';
            $this->load->library('upload');
            if (!move_uploaded_file($_FILES['plan_copy_for_espruc']['tmp_name'], $nakal_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                $binary_data = array();
                $binary_data['binary_nakal'] = chunk_split(base64_encode(file_get_contents($nakal_path)));
                $this->utility_model->update_data('form_land_details_id', $esprld_data['form_land_details_id'], 'form_land_details', $binary_data);

                $esprld_data['binary_nakal'] = $binary_data['binary_nakal'];
            }

            error_reporting(E_ERROR);
            $this->db->trans_start();
            $total_copy_generated = $esprld_data['total_copy_generated'];
            for ($i = ($esprld_data['total_copy_generated'] + 1); $i <= $esprld_data['copies']; $i++) {
                $this->_generate_esp($esprld_data, $form_land_details_id, $i, $nakal_path, $session_user_id);
                $total_copy_generated++;
            }

            $land_details = $esprld_data['land_details'] != '' ? json_decode($esprld_data['land_details'], true) : array();
            if (!empty($land_details)) {
                foreach ($land_details as &$ld) {
                    if ($ld['form_land_details_id'] == $esprld_data['form_land_details_id']) {
                        $ld['total_copy_generated'] = $total_copy_generated;
                    }
                }
                $u_array = array();
                $u_array['land_details'] = json_encode($land_details);
                $u_array['plan_status'] = VALUE_TWO;
                $pending_details = $this->eocs_site_plan_rural_model->get_pending_generate_copy_details(VALUE_NINE, $esprld_data['eocs_site_plan_rural_id']);
                if (!empty($pending_details)) {
                    $u_array['plan_status'] = VALUE_ONE;
                }
                $this->utility_model->update_data('eocs_site_plan_rural_id', $esprld_data['eocs_site_plan_rural_id'], 'eocs_site_plan_rural', $u_array);
                $esprld_data['plan_status'] = $u_array['plan_status'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                unlink($nakal_path);
            }
            $esprld_data['land_details'] = json_encode($land_details);
            $success_array = get_success_array();
            $success_array['message'] = SP_COPY_GENERATED_MESSAGE;
            $success_array['eocs_site_plan_rural_data'] = $esprld_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _generate_esp($esprld_data, $form_land_details_id, $i, $nakal_path, $session_user_id) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
        $fc_data = array();
        $fc_data['module_type'] = $esprld_data['module_type'];
        $fc_data['module_id'] = $esprld_data['module_id'];
        $fc_data['form_land_details_id'] = $esprld_data['form_land_details_id'];
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
        $mpdf->WriteHTML($this->load->view('eocs_site_plan_rural/copy_footer', array('esprld_data' => $esprld_data, 'fc_data' => $fc_data), TRUE));
        $final_filepath = FCPATH . 'documents/temp/espr-new-' . $form_land_details_id . '-' . $i . '.pdf';
        $mpdf->Output($final_filepath, 'F');
        $fcu_data = array();
        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
        $this->utility_model->update_data('form_copy_id', $fc_data['form_copy_id'], 'form_copy', $fcu_data);
        if (file_exists($final_filepath)) {
            unlink($final_filepath);
        }
        $this->utility_model->update_total_copy_generated($esprld_data['form_land_details_id']);
    }

    function _generate_esp_with_nic_page($esprld_data, $form_land_details_id, $i, $nakal_path, $session_user_id) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $fc_data = array();
        $fc_data['module_type'] = $esprld_data['module_type'];
        $fc_data['module_id'] = $esprld_data['module_id'];
        $fc_data['form_land_details_id'] = $esprld_data['form_land_details_id'];
        $fc_data['reference_number'] = $form_land_details_id . '-' . $i;
        $fc_data['created_by'] = $session_user_id;
        $fc_data['created_time'] = date('Y-m-d H:i:s');
        $fc_data['form_copy_id'] = $this->utility_model->insert_data('form_copy', $fc_data);
        $mpdf->WriteHTML($this->load->view('eocs_site_plan_rural/qr_barcode', array('esprld_data' => $esprld_data, 'fc_data' => $fc_data), TRUE));
        $qb_nakal_path = 'documents/temp/espr-qb-' . $form_land_details_id . '-' . $i . '.pdf';
        $final_filepath = FCPATH . 'documents/temp/espr-new-' . $form_land_details_id . '-' . $i . '.pdf';
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
        $this->utility_model->update_total_copy_generated($esprld_data['form_land_details_id']);
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
            $esprld_data = $this->eocs_site_plan_rural_model->get_espr_data_with_land_details(VALUE_NINE, $form_land_details_id, true);
            if (empty($esprld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($esprld_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($esprld_data['total_copy_generated'] != $esprld_data['copies']) {
                echo json_encode(get_error_array(COPY_NOT_GENERATED_MESSAGE));
                return false;
            }
            if ($_FILES['plan_copy_for_esprruc']['name'] == '') {
                echo json_encode(get_error_array(UPLOAD_DOC_MESSAGE));
                return;
            }
            $pdf_size = $_FILES['plan_copy_for_esprruc']['size'];
            if ($pdf_size == 0) {
                echo json_encode(get_error_array(DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $nakal_path = 'documents/temp/espr-rpc_' . $form_land_details_id . '.pdf';
            $this->load->library('upload');
            if (!move_uploaded_file($_FILES['plan_copy_for_esprruc']['tmp_name'], $nakal_path)) {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                $binary_data = array();
                $binary_data['binary_nakal'] = chunk_split(base64_encode(file_get_contents($nakal_path)));
                $this->utility_model->update_data('form_land_details_id', $esprld_data['form_land_details_id'], 'form_land_details', $binary_data);

                $esprld_data['binary_nakal'] = $binary_data['binary_nakal'];
            }
            error_reporting(E_ERROR);
            $this->db->trans_start();
            $ex_copy_details = $this->utility_model->get_result_data_by_id_multiple('module_type', VALUE_NINE, 'form_copy', 'module_id', $esprld_data['module_id'], 'form_land_details_id', $esprld_data['form_land_details_id']);
            foreach ($ex_copy_details as $fc_data) {
                $this->_regenerate_esp($esprld_data, $form_land_details_id, $i, $nakal_path, $fc_data);
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

    function _regenerate_esp($esprld_data, $form_land_details_id, $i, $nakal_path, $fc_data) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
        $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
        $page_count = $mpdf->setSourceFile($nakal_path);
        for ($i = 1; $i <= $page_count; $i++) {
            if ($i != 1) {
                $mpdf->AddPage();
            }
            $mpdf->UseTemplate($mpdf->importPage($i));
        }
        $mpdf->WriteHTML($this->load->view('eocs_site_plan_rural/copy_footer', array('esprld_data' => $esprld_data, 'fc_data' => $fc_data), TRUE));
        $final_filepath = FCPATH . 'documents/temp/espr-rnew-' . $form_land_details_id . '-' . $i . '.pdf';
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
            $esprld_data = $this->eocs_site_plan_rural_model->get_espr_data_with_land_details(VALUE_NINE, $form_land_details_id);
            if (empty($esprld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($esprld_data['total_copy_generated'] != $esprld_data['copies']) {
                echo json_encode(get_error_array(COPY_NOT_GENERATED_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $copy_details = $this->utility_model->get_result_data_by_id_multiple('module_type', VALUE_NINE, 'form_copy', 'module_id', $esprld_data['module_id'], 'form_land_details_id', $esprld_data['form_land_details_id']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['esprld_data'] = $esprld_data;
            $success_array['copy_details'] = $copy_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_status_for_espr() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $eocs_site_plan_rural_id = get_from_post('espr_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $eocs_site_plan_rural_id == NULL || !$eocs_site_plan_rural_id) {
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
            $ex_espr_data = $this->utility_model->get_by_id('eocs_site_plan_rural_id', $eocs_site_plan_rural_id, 'eocs_site_plan_rural');
            if (empty($ex_espr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $espr_data = array();
            $success_mesage = array();
            if ($module_type == VALUE_ONE) {
                if ($ex_espr_data['is_verified'] == VALUE_ONE) {
                    echo json_encode(get_error_array(SP_DETAILS_AL_VERIFIED_MESSAGE));
                    return false;
                }
                $espr_data['status'] = VALUE_THREE;
                $espr_data['is_verified'] = VALUE_ONE;
                $espr_data['verified_details'] = json_encode(array('verified_remarks' => $remarks, 'verified_by' => $session_user_id,
                    'verified_name' => get_from_session('name'), 'verified_datetime' => date('Y-m-d H:i:s')));
                $success_mesage = SP_APP_VERIFIED_TO_USER_MESSAGE;
            }
            if ($module_type == VALUE_TWO) {
                if ($ex_espr_data['is_prepared'] == VALUE_ONE) {
                    echo json_encode(get_error_array(SP_DETAILS_AL_PREPARED_MESSAGE));
                    return false;
                }
                $espr_data['plan_status'] = VALUE_THREE;
                $espr_data['is_prepared'] = VALUE_ONE;
                $espr_data['prepared_details'] = json_encode(array('prepared_remarks' => $remarks, 'prepared_by' => $session_user_id,
                    'prepared_name' => get_from_session('name'), 'prepared_datetime' => date('Y-m-d H:i:s')));
                $success_mesage = SP_DETAILS_PREPARED_MESSAGE;
            }
            if ($module_type == VALUE_THREE) {
                if ($ex_espr_data['is_checked'] == VALUE_ONE) {
                    echo json_encode(get_error_array(SP_DETAILS_AL_CHECKED_MESSAGE));
                    return false;
                }
                $espr_data['plan_status'] = VALUE_FOUR;
                $espr_data['is_checked'] = VALUE_ONE;
                $espr_data['checked_details'] = json_encode(array('checked_remarks' => $remarks, 'checked_by' => $session_user_id,
                    'checked_name' => get_from_session('name'), 'checked_datetime' => date('Y-m-d H:i:s')));
                $success_mesage = SP_DETAILS_CHECKED_MESSAGE;
            }
            $this->db->trans_start();
            if (!empty($espr_data)) {
                $this->utility_model->update_data('eocs_site_plan_rural_id', $eocs_site_plan_rural_id, 'eocs_site_plan_rural', $espr_data);
            }
//        if ($module_type == VALUE_TWO || $module_type == VALUE_THREE) {
//            $this->utility_lib->update_au_sign_in_eocs_copy($session_user_id, $ex_espr_data['district'], VALUE_NINE, $module_type, $eocs_site_plan_rural_id);
//        }
            if ($module_type == VALUE_ONE) {
                $this->utility_lib->send_fp_email_for_eocs($session_user_id, VALUE_TWENTYFIVE, $ex_espr_data);
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
}

/*
 * EOF: ./application/controller/Eocs_site_plan_rural.php
 */