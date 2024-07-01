<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Form_one_fourteen extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('form_one_fourteen_model');
        $this->load->model('utility_model');
    }

    function get_form_one_fourteen_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['form_one_fourteen_data'] = array();
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

            $search_appno = get_from_post('app_no_for_form_one_fourteen_list');
            $search_appd = get_from_post('application_date_for_form_one_fourteen_list');
            $search_appdet = filter_var(get_from_post('app_details_for_form_one_fourteen_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_form_one_fourteen_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_form_one_fourteen_list');
            $search_qstatus = get_from_post('query_status_for_form_one_fourteen_list');
            $search_status = get_from_post('status_for_form_one_fourteen_list');
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
            $form_one_fourteen_data = $this->form_one_fourteen_model->get_all_form_one_fourteen_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->form_one_fourteen_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->form_one_fourteen_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }

//        foreach ($form_one_fourteen_data as &$fof) {
//            $lds = json_decode($fof['land_details'], true);
//            if (!empty($lds)) {
//                foreach ($lds as &$fldd) {
//                    if ($fof['district'] != VALUE_ZERO && $fof['village'] != VALUE_ZERO && $fldd['survey'] != '' && $fldd['subdiv'] != '') {
//                        $total_pending_amount = $this->utility_lib->get_rural_pending_land_tax_by_dvssk($fof['district'], $fof['village'], $fldd['survey'], $fldd['subdiv']);
//                        if ($total_pending_amount >= 0) {
//                            $fldd['pending_landtax'] = $total_pending_amount;
//                        }
//                    }
//                }
//                $fof['land_details'] = json_encode($lds);
//            }
//        }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['form_one_fourteen_data'] = array();
                echo json_encode($success_array);
                return;
            }
            $success_array['form_one_fourteen_data'] = $form_one_fourteen_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['form_one_fourteen_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_form_one_fourteen_data_by_id() {
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
            $form_one_fourteen_id = get_from_post('form_one_fourteen_id');
            if (!$form_one_fourteen_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $form_one_fourteen_data = $this->utility_model->get_by_id('form_one_fourteen_id', $form_one_fourteen_id, 'form_one_fourteen');
            if (empty($form_one_fourteen_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->load->model('landtax_na_model');
            $this->db->trans_start();
            $form_land_details = $this->utility_model->get_result_data_by_id('module_id', $form_one_fourteen_id, 'form_land_details', 'module_type', VALUE_ONE, 'module_id', 'DESC');
            if (!empty($form_land_details)) {
                foreach ($form_land_details as &$fldd) {
                    if ($form_one_fourteen_data['district'] != VALUE_ZERO && $form_one_fourteen_data['village'] != VALUE_ZERO && $fldd['survey'] != '' && $fldd['subdiv'] != '') {
                        $total_pending_amount = $this->utility_lib->get_rural_pending_land_tax_by_dvssk($form_one_fourteen_data['district'], $form_one_fourteen_data['village'], $fldd['survey'], $fldd['subdiv']);
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
            $success_array['form_one_fourteen_data'] = $form_one_fourteen_data;
            $success_array['form_land_details'] = $form_land_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_data_by_form_one_fourteen_id() {
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
            $form_one_fourteen_id = get_from_post('form_one_fourteen_id');
            if (!$form_one_fourteen_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $form_one_fourteen_data = $this->utility_model->get_by_id('form_one_fourteen_id', $form_one_fourteen_id, 'form_one_fourteen');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($form_one_fourteen_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($module_type == VALUE_ONE) {
                $pending_details = $this->form_one_fourteen_model->get_pending_generate_copy_details(VALUE_ONE, $form_one_fourteen_id);
                if (!empty($pending_details)) {
                    echo json_encode(get_error_array(ROR_COPY_NOT_GENERATED_PGC_MESSAGE));
                    return false;
                }
            }
            $success_array = get_success_array();
            $success_array['form_one_fourteen_data'] = $form_one_fourteen_data;
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
            $form_one_fourteen_id = get_from_post('form_one_fourteen_id_for_form_one_fourteen_set_appointment');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$form_one_fourteen_id || $form_one_fourteen_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_data = array();
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('form_one_fourteen_id', $form_one_fourteen_id, 'form_one_fourteen');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_date = get_from_post('appointment_date_for_form_one_fourteen');
            $appointment_data['appointment_date'] = convert_to_mysql_date_format($appointment_date);
            $appointment_data['appointment_time'] = get_from_post('appointment_time_for_form_one_fourteen');
            $appointment_data['appointment_by'] = $session_user_id;
            $appointment_data['appointment_by_name'] = get_from_session('name');
            $appointment_data['appointment_datetime'] = $appointment_data['appointment_date'] . ' ' . date("H:i:s", strtotime($appointment_data['appointment_time']));
            $appointment_data['updated_by'] = $session_user_id;
            $appointment_data['updated_time'] = date('Y-m-d H:i:s');
            $appointment_data['appointment_status'] = VALUE_ONE;
            $this->utility_model->update_data('form_one_fourteen_id', $form_one_fourteen_id, 'form_one_fourteen', $appointment_data);
            $form_one_fourteen_data = $this->utility_model->get_by_id('form_one_fourteen_id', $form_one_fourteen_id, 'form_one_fourteen');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APPOINTMENT_SET_MESSAGE;
            $success_array['form_one_fourteen_data'] = $form_one_fourteen_data;
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
            $form_one_fourteen_id = get_from_post('form_one_fourteen_id_for_form_one_fourteen_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$form_one_fourteen_id || $form_one_fourteen_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_form_one_fourteen_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('form_one_fourteen_id', $form_one_fourteen_id, 'form_one_fourteen');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_THIRTEEN, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('form_one_fourteen_id', $form_one_fourteen_id, 'form_one_fourteen', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_THIRTEEN, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_THIRTEEN, $ex_data);
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
            $form_one_fourteen_id = get_from_post('form_one_fourteen_id_for_form_one_fourteen_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$form_one_fourteen_id || $form_one_fourteen_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_form_one_fourteen_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('form_one_fourteen_id', $form_one_fourteen_id, 'form_one_fourteen');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_THIRTEEN, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('form_one_fourteen_id', $form_one_fourteen_id, 'form_one_fourteen', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_THIRTEEN, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_THIRTEEN, $ex_data);
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
            $fofld_data = $this->form_one_fourteen_model->get_form_data_with_land_details(VALUE_ONE, $form_land_details_id, true);
            if (empty($fofld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($fofld_data['status'] != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($fofld_data['total_copy_generated'] == $fofld_data['copies']) {
                echo json_encode(get_error_array(COPY_ALREADY_GENERATED_MESSAGE));
                return false;
            }
//            if ($fofld_data['binary_nakal'] == '') {
                $pdf_data = $this->utility_lib->get_daman_rural_ror_data($fofld_data['village'], $fofld_data['survey'], $fofld_data['subdiv']);
                if (count($pdf_data) == 0) {
                    echo json_encode(get_error_array(ROR_NOT_FOUND_MESSAGE));
                    return false;
                }
                $binary_data = array();
                $binary_data['binary_nakal'] = $pdf_data[0]['IXIV'];
                $this->utility_model->update_data('form_land_details_id', $fofld_data['form_land_details_id'], 'form_land_details', $binary_data);

                $fofld_data['binary_nakal'] = $binary_data['binary_nakal'];
//            }
            error_reporting(E_ERROR);
            $nakal_path = 'documents/temp/fof-' . $form_land_details_id . '.pdf';
            file_put_contents($nakal_path, base64_decode($fofld_data['binary_nakal']));
            $this->db->trans_start();
            $total_copy_generated = $fofld_data['total_copy_generated'];
            for ($i = ($fofld_data['total_copy_generated'] + 1); $i <= $fofld_data['copies']; $i++) {
                $this->_generate_ror($fofld_data, $form_land_details_id, $i, $nakal_path, $session_user_id);
                $total_copy_generated++;
            }

            $land_details = $fofld_data['land_details'] != '' ? json_decode($fofld_data['land_details'], true) : array();
            if (!empty($land_details)) {
                foreach ($land_details as &$ld) {
                    if ($ld['form_land_details_id'] == $fofld_data['form_land_details_id']) {
                        $ld['total_copy_generated'] = $total_copy_generated;
                    }
                }
                $this->utility_model->update_data('form_one_fourteen_id', $fofld_data['form_one_fourteen_id'], 'form_one_fourteen', array('land_details' => json_encode($land_details)));
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (file_exists($nakal_path)) {
                unlink($nakal_path);
            }
            $fofld_data['land_details'] = json_encode($land_details);
            $success_array = get_success_array();
            $success_array['message'] = ROR_GENERATED_MESSAGE;
            $success_array['form_one_fourteen_data'] = $fofld_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _generate_ror($fofld_data, $form_land_details_id, $i, $nakal_path, $session_user_id) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $fc_data = array();
        $fc_data['module_type'] = $fofld_data['module_type'];
        $fc_data['module_id'] = $fofld_data['module_id'];
        $fc_data['form_land_details_id'] = $fofld_data['form_land_details_id'];
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
        $mpdf->SetFooter($this->load->view('form_one_fourteen/copy_footer', array('fof_data' => $fofld_data, 'fc_data' => $fc_data), TRUE));
        $final_filepath = 'documents/temp/fof-new-' . $form_land_details_id . '-' . $i . '.pdf';
        $mpdf->Output($final_filepath, 'F');
        $fcu_data = array();
        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
        $this->utility_model->update_data('form_copy_id', $fc_data['form_copy_id'], 'form_copy', $fcu_data);
        if (file_exists($final_filepath)) {
            unlink($final_filepath);
        }
        $this->utility_model->update_total_copy_generated($fofld_data['form_land_details_id']);
    }

    function _generate_ror_for_legal_page($fofld_data, $form_land_details_id, $i, $nakal_path, $session_user_id) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal', 'margin_left' => 10, 'margin_right' => 10]);
        $fc_data = array();
        $fc_data['module_type'] = $fofld_data['module_type'];
        $fc_data['module_id'] = $fofld_data['module_id'];
        $fc_data['form_land_details_id'] = $fofld_data['form_land_details_id'];
        $fc_data['reference_number'] = $form_land_details_id . '-' . $i;
        $fc_data['created_by'] = $session_user_id;
        $fc_data['created_time'] = date('Y-m-d H:i:s');
        $fc_data['form_copy_id'] = $this->utility_model->insert_data('form_copy', $fc_data);

        $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 13px;}.table-header {width: 100%; border-top:1px solid black; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
        $page_count = $mpdf->setSourceFile($nakal_path);
        for ($i = 1; $i <= $page_count; $i++) {
            $mpdf->UseTemplate($mpdf->importPage($i));
        }
        $unusedSpaceH = $mpdf->h - $mpdf->y - $mpdf->bMargin;
        $mpdf->WriteHTML($this->load->view('form_one_fourteen/copy_fd', array('fof_data' => $fofld_data, 'unused_space' => $unusedSpaceH), TRUE));
        $mpdf->defaultfooterline = 0;
        $mpdf->SetFooter($this->load->view('form_one_fourteen/copy_footer', array('fof_data' => $fofld_data), TRUE));
        $final_filepath = 'documents/temp/fof-new-' . $form_land_details_id . '-' . $i . '.pdf';
        $mpdf->Output($final_filepath, 'F');
        $fcu_data = array();
        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
        $this->utility_model->update_data('form_copy_id', $fc_data['form_copy_id'], 'form_copy', $fcu_data);
        if (file_exists($final_filepath)) {
            unlink($final_filepath);
        }
        $this->utility_model->update_total_copy_generated($fofld_data['form_land_details_id']);
    }

    function _generate_ror_with_nic_page($fofld_data, $form_land_details_id, $i, $nakal_path, $session_user_id) {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $fc_data = array();
        $fc_data['module_type'] = $fofld_data['module_type'];
        $fc_data['module_id'] = $fofld_data['module_id'];
        $fc_data['form_land_details_id'] = $fofld_data['form_land_details_id'];
        $fc_data['reference_number'] = $form_land_details_id . '-' . $i;
        $fc_data['created_by'] = $session_user_id;
        $fc_data['created_time'] = date('Y-m-d H:i:s');
        $fc_data['form_copy_id'] = $this->utility_model->insert_data('form_copy', $fc_data);
        $mpdf->WriteHTML($this->load->view('form_one_fourteen/qr_barcode', array('fof_data' => $fofld_data, 'fc_data' => $fc_data), TRUE));
        $qb_nakal_path = 'documents/temp/fof-qb-' . $form_land_details_id . '-' . $i . '.pdf';
        $final_filepath = FCPATH . 'documents/temp/fof-new-' . $form_land_details_id . '-' . $i . '.pdf';
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
        $this->utility_model->update_total_copy_generated($fofld_data['form_land_details_id']);
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
            $fofld_data = $this->form_one_fourteen_model->get_form_data_with_land_details(VALUE_ONE, $form_land_details_id);
            if (empty($fofld_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($fofld_data['total_copy_generated'] != $fofld_data['copies']) {
                echo json_encode(get_error_array(COPY_NOT_GENERATED_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $copy_details = $this->utility_model->get_result_data_by_id_multiple('module_type', VALUE_ONE, 'form_copy', 'module_id', $fofld_data['module_id'], 'form_land_details_id', $fofld_data['form_land_details_id']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['fofld_data'] = $fofld_data;
            $success_array['copy_details'] = $copy_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function office_copy_in_pdf() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                $this->load->view('404');
                return false;
            }
            $s_district = get_from_post('district_for_fofocp');
            if ($s_district != TALUKA_DAMAN && $s_district != TALUKA_DIU) {
                $this->load->view('404');
                return false;
            }
            $s_village = get_from_post('village_for_fofocp');
            if (!$s_village) {
                $this->load->view('404');
                return false;
            }
            $s_survey = get_from_post('survey_number_for_fofocp');
            $s_subdiv = get_from_post('subdivision_number_for_fofocp');
            if ($s_survey == '' || $s_subdiv == '') {
                $this->load->view('404');
                return false;
            }
            $ex_vilage_data = array();
            $pdf_data = array();
            $this->db->trans_start();
            if ($s_district == TALUKA_DAMAN) {
                $ex_vilage_data = $this->utility_model->get_by_id('village', $s_village, 'daman_rural_villages');
                $pdf_data = $this->utility_lib->get_daman_rural_ror_data($s_village, $s_survey, $s_subdiv);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->load->view('error', array('error_message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($ex_vilage_data)) {
                $this->load->view('404');
                return false;
            }
            if (count($pdf_data) == 0) {
                $this->load->view('error', array('error_message' => ROR_NOT_FOUND_MESSAGE));
                return false;
            }
            if (!isset($pdf_data[0]['IXIV'])) {
                $this->load->view('error', array('error_message' => ROR_NOT_FOUND_MESSAGE));
                return false;
            }
            if ($pdf_data[0]['IXIV'] == '') {
                $this->load->view('error', array('error_message' => ROR_NOT_FOUND_MESSAGE));
                return false;
            }


            $filename = 'fof-office-copy-' . $s_village . '-' . time() . '.pdf';
            error_reporting(E_ERROR);
            $nakal_path = 'documents/temp/' . $filename;
            file_put_contents($nakal_path, base64_decode($pdf_data[0]['IXIV']));

            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; border-top:1px solid black; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
            $page_count = $mpdf->setSourceFile($nakal_path);
            for ($i = 1; $i <= $page_count; $i++) {
                if ($i != 1) {
                    $mpdf->AddPage();
                }
                $mpdf->UseTemplate($mpdf->importPage($i));
            }

            $fc_data = array();
            $fc_data['generated_datetime'] = date('d-m-Y H:i:s');
            $fc_data['village_name'] = $ex_vilage_data['village_name'];
            if (is_admin() || is_mamlatdar_user()) {
                $fc_data['signature'] = 'mam_daman.png';
            }
            if (is_talathi_user()) {
                $fc_data['signature'] = $session_user_id . '-talathi.png';
            }
            if (is_aci_user()) {
                $fc_data['signature'] = '3-talathi.png';
            }
            $mpdf->WriteFixedPosHTML('<h3><b>OFFICE USE ONLY</b></h3>', 77, 24, 50, 90, 'auto');
            $mpdf->defaultfooterline = 0;
            $mpdf->SetFooter($this->load->view('form_one_fourteen/office_copy/copy_footer', array('fc_data' => $fc_data), TRUE));
            $mpdf->Output($filename, 'I');
            if (file_exists($nakal_path)) {
                unlink($nakal_path);
            }
        } catch (\Exception $e) {
            $this->load->view('error', array('error_message' => $e->getMessage()));
            return;
        }
    }
}

/*
 * EOF: ./application/controller/Form_one_fourteen.php
 */