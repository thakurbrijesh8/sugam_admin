<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Character_certificate extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('character_certificate_model');
    }

    function get_character_certificate_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['character_certificate_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;
            
            $search_appno = get_from_post('app_no_for_character_certificate_list');
            $search_appd = get_from_post('application_date_for_character_certificate_list');
            $search_appdet = filter_var(get_from_post('app_details_for_character_certificate_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_character_certificate_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_qstatus = get_from_post('query_status_for_character_certificate_list');
            $search_status = get_from_post('status_for_character_certificate_list');
            
            $new_search_appd = get_from_post('s_appd');
            $search_appd = $new_search_appd != '' ? $new_search_appd : $search_appd;
            $new_qstatus = get_from_post('s_qstatus');
            $search_qstatus = $new_qstatus != '' ? $new_qstatus : $search_qstatus;
            $new_status = get_from_post('s_status');
            $search_status = $new_status != '' ? $new_status : $search_status;
            
            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['character_certificate_data'] = $this->character_certificate_model->get_all_character_certificate_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->character_certificate_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->character_certificate_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['character_certificate_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['character_certificate_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_character_certificate_data_by_id() {
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
            $character_certificate_id = get_from_post('character_certificate_id');
            if (!$character_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $character_certificate_data = $this->utility_model->get_by_id('character_certificate_id', $character_certificate_id, 'character_certificate');
            if (empty($character_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['character_certificate_data'] = $character_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_character_certificate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $character_certificate_id = get_from_post('character_certificate_id_for_character_certificate');
            $character_certificate_data = $this->_get_post_data_for_character_certificate();
            $validation_message = $this->_check_validation_for_character_certificate($character_certificate_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $character_certificate_data['applicant_dob'] = convert_to_mysql_date_format($character_certificate_data['applicant_dob']);
            $character_certificate_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $character_certificate_data['status'] = VALUE_ONE;
            }
            if ($module_type == VALUE_THREE) {
                $character_certificate_data['status'] = VALUE_TWO;
                $character_certificate_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$character_certificate_id || $character_certificate_id == NULL) {
                $character_certificate_data['user_id'] = $user_id;
                $character_certificate_data['created_by'] = $user_id;
                $character_certificate_data['created_time'] = date('Y-m-d H:i:s');
                $this->_get_application_number($character_certificate_data);
                $character_certificate_id = $this->utility_model->insert_data('character_certificate', $character_certificate_data);
            } else {
                $character_certificate_data['updated_by'] = $user_id;
                $character_certificate_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('character_certificate_id', $character_certificate_id, 'character_certificate', $character_certificate_data);
            }
            $new_cc_data = array();
            if ($module_type == VALUE_TWO) {
                $new_cc_data = $this->utility_model->get_by_id('character_certificate_id', $character_certificate_id, 'character_certificate');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            $success_array['new_cc_data'] = $new_cc_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_application_number(&$character_certificate_data) {
        $character_certificate_data['application_year'] = get_financial_year();
        $character_certificate_data['temp_application_number'] = VALUE_ONE;
        $ex_app_num_data = $this->utility_model->get_by_id('application_year', $character_certificate_data['application_year'], 'character_certificate', '', '', 'temp_application_number', 'DESC');
        if (!empty($ex_app_num_data)) {
            $character_certificate_data['temp_application_number'] = ($ex_app_num_data['temp_application_number'] + 1);
        }
        $character_certificate_data['application_number'] = 'CC/' . $character_certificate_data['application_year'] . '/' . get_application_number($character_certificate_data['temp_application_number']);
    }

    function _get_post_data_for_character_certificate() {
        $character_certificate_data = array();
        $character_certificate_data['district'] = get_from_post('district_for_character_certificate');
        $character_certificate_data['applicant_name'] = get_from_post('applicant_name');
        $character_certificate_data['com_addr_house_no'] = get_from_post('com_addr_house_no');
        $character_certificate_data['com_addr_house_name'] = get_from_post('com_addr_house_name');
        $character_certificate_data['com_addr_street'] = get_from_post('com_addr_street');
        $character_certificate_data['com_addr_village_dmc_ward'] = get_from_post('com_addr_village_dmc_ward');
        $character_certificate_data['com_addr_city'] = get_from_post('com_addr_city');
        $character_certificate_data['com_pincode'] = get_from_post('com_pincode');
        $character_certificate_data['billingtoo'] = get_from_post('billingtoo');
        $character_certificate_data['per_addr_house_no'] = get_from_post('per_addr_house_no');
        $character_certificate_data['per_addr_house_name'] = get_from_post('per_addr_house_name');
        $character_certificate_data['per_addr_street'] = get_from_post('per_addr_street');
        $character_certificate_data['per_addr_village_dmc_ward'] = get_from_post('per_addr_village_dmc_ward');
        $character_certificate_data['per_addr_city'] = get_from_post('per_addr_city');
        $character_certificate_data['per_pincode'] = get_from_post('per_pincode');
        $character_certificate_data['applicant_dob'] = get_from_post('applicant_dob');
        $character_certificate_data['applicant_age'] = get_from_post('applicant_age');
        $character_certificate_data['father_name'] = get_from_post('father_name');
        $character_certificate_data['mother_name'] = get_from_post('mother_name');
        $character_certificate_data['purpose'] = get_from_post('purpose');

        return $character_certificate_data;
    }

    function _check_validation_for_character_certificate($character_certificate_data) {
        if (!$character_certificate_data['district']) {
            return SELECT_DISTRICT_MESSAGE;
        }
        if (!$character_certificate_data['applicant_name']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$character_certificate_data['com_addr_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$character_certificate_data['com_addr_house_name']) {
            return HOUSE_NAME_MESSAGE;
        }
        if (!$character_certificate_data['com_addr_street']) {
            return STREET_MESSAGE;
        }
        if (!$character_certificate_data['com_addr_village_dmc_ward']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$character_certificate_data['com_addr_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$character_certificate_data['com_pincode']) {
            return PINCODE_MESSAGE;
        }
        if (!$character_certificate_data['per_addr_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$character_certificate_data['per_addr_house_name']) {
            return HOUSE_NAME_MESSAGE;
        }
        if (!$character_certificate_data['per_addr_street']) {
            return STREET_MESSAGE;
        }
        if (!$character_certificate_data['per_addr_village_dmc_ward']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$character_certificate_data['per_addr_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$character_certificate_data['per_pincode']) {
            return PINCODE_MESSAGE;
        }
        if (!$character_certificate_data['applicant_dob']) {
            return BIRTH_DATE_MESSAGE;
        }
        if (!$character_certificate_data['father_name']) {
            return FATHER_NAME_MESSAGE;
        }
        if (!$character_certificate_data['mother_name']) {
            return MOTHER_NAME_MESSAGE;
        }
        if (!$character_certificate_data['purpose']) {
            return PURPOSE_OF_DOMICILE_MESSAGE;
        }
        return '';
    }

    function approve_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $character_certificate_id = get_from_post('character_certificate_id_for_character_certificate_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$character_certificate_id || $character_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_character_certificate_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('character_certificate_id', $character_certificate_id, 'character_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = get_days_in_dates($ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('character_certificate_id', $character_certificate_id, 'character_certificate', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TEN, $ex_data);

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
            $character_certificate_id = get_from_post('character_certificate_id_for_character_certificate_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$character_certificate_id || $character_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_character_certificate_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('character_certificate_id', $character_certificate_id, 'character_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = get_days_in_dates($ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('character_certificate_id', $character_certificate_id, 'character_certificate', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TEN, $ex_data);

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

    function get_character_certificate_data_by_character_certificate_id() {
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
            $character_certificate_id = get_from_post('character_certificate_id');
            if (!$character_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $character_certificate_data = $this->character_certificate_model->get_basic_data_for_cc($character_certificate_id);
            if (empty($character_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['character_certificate_data'] = $character_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $character_certificate_id = get_from_post('character_certificate_id_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $character_certificate_id == null || !$character_certificate_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_character_certificate_data = $this->utility_model->get_by_id('character_certificate_id', $character_certificate_id, 'character_certificate');
            if (empty($existing_character_certificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if (!is_ldc_user()) {
                if ($existing_character_certificate_data['status'] != VALUE_FIVE) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return;
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('character_certificate_data' => $existing_character_certificate_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            if (is_ldc_user()) {
                $mpdf->showWatermarkText = true;
            } else {
                $mpdf->showWatermarkImage = true;
            }
            $mpdf->WriteHTML($this->load->view('character_certificate/certificate', $data, TRUE));
            $mpdf->Output('character_certificate_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function generate_excel() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $user_id == null || !$user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $search_district = is_admin() ? '' : $session_district;
            $search_appno = get_from_post('app_no_for_ccge');
            $search_appd = get_from_post('app_date_for_ccge');
            $search_appdet = get_from_post('app_details_for_ccge');
            $search_vdw = get_from_post('vdw_for_ccge');
            $search_cohand = get_from_post('currently_on_for_ccge');
            $search_qstatus = get_from_post('qstatus_for_ccge');
            $search_status = get_from_post('status_for_ccge');
            
            $this->db->trans_start();
            $excel_data = $this->character_certificate_model->get_records_for_excel($session_district, $search_appno, $search_appd, $search_appdet, $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Character_certificate_Report_' . date('Y-m-d H:i:s') . '.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('Application Number', 'Submitted On', 'Applicant Name', 'District', 'Status', 'Query Status'));
            if (!empty($excel_data)) {
                $taluka_array = $this->config->item('taluka_array');
                $app_status_text_array = $this->config->item('app_status_text_array');
                $query_status_text_array = $this->config->item('query_status_text_array');
                $daman_villages_array = $this->config->item('daman_villages_array');
                $diu_villages_array = $this->config->item('diu_villages_array');
                $dnh_villages_array = $this->config->item('dnh_villages_array');
                foreach ($excel_data as $list) {
                    $villages_array = $list['district'] == TALUKA_DAMAN ? $daman_villages_array : ($list['district'] == TALUKA_DIU ? $diu_villages_array : ($list['district'] == TALUKA_DNH ? $dnh_villages_array : array()));
                    $list['district'] = isset($taluka_array[$list['district']]) ? $taluka_array[$list['district']] : '-';
                    $list['submitted_datetime'] = convert_to_new_datetime_format($list['submitted_datetime']);
                    $list['status'] = isset($app_status_text_array[$list['status']]) ? $app_status_text_array[$list['status']] : '-';
                    $list['query_status'] = isset($query_status_text_array[$list['query_status']]) ? $query_status_text_array[$list['query_status']] : '-';
                    fputcsv($output, $list);
                }
            }
            fclose($output);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_update_basic_detail_data_by_character_certificate_id() {
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
            $character_certificate_id = get_from_post('character_certificate_id');
            if (!$character_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $basic_details = $this->character_certificate_model->get_basic_data_for_cc($character_certificate_id);
            if (empty($basic_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mamlatdar_data = array();
            $sdpo_data = array();
            // $ldc_data = array();
            if (is_ldc_user() && $basic_details['ldc_to_mamlatdar'] == VALUE_ZERO) {
                $mamlatdar_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_MAMLATDAR_USER);
            }
            if (is_mamlatdar_user() && $basic_details['mamlatdar_to_sdpo'] == VALUE_ZERO) {
                $sdpo_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_SDPO_USER);
            }
            // if (is_sdpo_user() && $basic_details['sdpo_to_ldc'] == VALUE_ZERO) {
            //     $ldc_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_LDC_USER);
            // }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['update_basic_detail_data'] = $basic_details;
            $success_array['mamlatdar_data'] = $mamlatdar_data;
            $success_array['sdpo_data'] = $sdpo_data;
            // $success_array['ldc_data'] = $ldc_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function forward_to() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $character_certificate_id = get_from_post('character_certificate_id_for_character_certificate_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$character_certificate_id || $character_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if (is_admin() || is_ldc_user()) {
                $ldc_to_mamlatdar_remarks = get_from_post('ldc_to_mamlatdar_remarks_for_character_certificate');
                if (!$ldc_to_mamlatdar_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar = get_from_post('ldc_to_mamlatdar_for_character_certificate');
                if (!$ldc_to_mamlatdar) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if (is_admin() || is_mamlatdar_user()) {
                $mamlatdar_to_sdpo_remarks = get_from_post('mamlatdar_to_sdpo_remarks_for_character_certificate');
                if (!$mamlatdar_to_sdpo_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $mamlatdar_to_sdpo = get_from_post('mamlatdar_to_sdpo_for_character_certificate');
                if (!$mamlatdar_to_sdpo) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if (is_admin() || is_sdpo_user()) {
                if ($_FILES['inquiry_copy_for_sdpo']['name'] != '') {
                    $main_path = 'documents/character_certificate';
                    $documents_path = 'documents';
                    if (!is_dir($documents_path)) {
                        mkdir($documents_path);
                        chmod($documents_path, 0777);
                    }
                    $module_path = $documents_path . DIRECTORY_SEPARATOR . 'character_certificate';
                    if (!is_dir($module_path)) {
                        mkdir($module_path);
                        chmod($module_path, 0777);
                    }
                    $this->load->library('upload');
                    $temp_filename = str_replace('_', '', $_FILES['inquiry_copy_for_sdpo']['name']);
                    $filename = 'inquiry_copy_sdpo_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                    //Change file name
                    $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                    if (!move_uploaded_file($_FILES['inquiry_copy_for_sdpo']['tmp_name'], $final_path)) {
                        echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                        return;
                    }
                    $inquiry_copy = $filename;
                }
                // $sdpo_to_ldc = get_from_post('sdpo_to_ldc_for_character_certificate');
                // if (!$sdpo_to_ldc) {
                //     echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                //     return false;
                // }
            }
            $this->db->trans_start();
            $temp_talathi_data = array();
            $basic_detail_data = array();
            if (is_admin() || is_ldc_user()) {
                $basic_detail_data['ldc'] = $session_user_id;
                $basic_detail_data['ldc_to_mamlatdar_remarks'] = $ldc_to_mamlatdar_remarks;
                $basic_detail_data['ldc_to_mamlatdar'] = $ldc_to_mamlatdar;
                $basic_detail_data['ldc_to_mamlatdar_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_admin() || is_mamlatdar_user()) {
                $basic_detail_data['mamlatdar_to_sdpo_remarks'] = $mamlatdar_to_sdpo_remarks;
                $basic_detail_data['mamlatdar_to_sdpo'] = $mamlatdar_to_sdpo;
                $basic_detail_data['mamlatdar_to_sdpo_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_admin() || is_sdpo_user()) {
                $basic_detail_data['inquiry_copy'] = $inquiry_copy;
                $basic_detail_data['sdpo_status'] = VALUE_ONE;
                $basic_detail_data['sdpo_status_datetime'] = date('Y-m-d H:i:s');
            }
            $basic_detail_data['updated_by'] = $session_user_id;
            $basic_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('character_certificate_id', $character_certificate_id, 'character_certificate', $basic_detail_data);
            $ic_data = $this->character_certificate_model->get_basic_data_for_cc($character_certificate_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APP_FORWARDED_MESSSAGE;
            $success_array['character_certificate_id'] = $character_certificate_id;
            $success_array['character_certificate_data'] = $ic_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function document_for_app_pdf() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $character_certificate_id = get_from_post('character_certificate_id_for_app_pdf');
            if (!is_post() || $user_id == null || !$user_id || $character_certificate_id == null || !$character_certificate_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_character_certificate_data = $this->utility_model->get_by_id('character_certificate_id', $character_certificate_id, 'character_certificate');
            if (empty($existing_character_certificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('character_certificate_data' => $existing_character_certificate_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            if (is_ldc_user()) {
                $mpdf->showWatermarkText = true;
            } else {
                $mpdf->showWatermarkImage = true;
            }
            $mpdf->WriteHTML($this->load->view('character_certificate/application_pdf', $data, TRUE));
            $mpdf->Output('application_pdf_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function _copy_file($doc_path, $ex_file_name) {
        $old = $doc_path . $ex_file_name;
        $new = 'documents/temp/' . $ex_file_name;
        copy($old, $new);
        return $new;
    }

    function _merge_multiple_pdf(&$mpdf, $pagecount) {
        if ($pagecount != 0) {
            $mpdf->addPage();
            for ($i = 0; $i < $pagecount; $i++) {
                $tplId = $mpdf->importPage($i + 1);
                $mpdf->useTemplate($tplId);
                if (($i + 1 ) != $pagecount) {
                    $mpdf->addPage();
                }
            }
        }
    }

    function document_for_issue_of_cc() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $character_certificate_id = get_from_post('character_certificate_id_for_issue_of_cc');
            if (!is_post() || $user_id == null || !$user_id || $character_certificate_id == null || !$character_certificate_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_character_certificate_data = $this->utility_model->get_by_id('character_certificate_id', $character_certificate_id, 'character_certificate');
            if (empty($existing_character_certificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('character_certificate_data' => $existing_character_certificate_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            if (is_ldc_user()) {
                $mpdf->showWatermarkText = true;
            } else {
                $mpdf->showWatermarkImage = true;
            }
            $mpdf->WriteHTML($this->load->view('character_certificate/issue_of_cc_pdf', $data, TRUE));
            $mpdf->Output('issue_of_cc_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/Character_certificate.php
 */