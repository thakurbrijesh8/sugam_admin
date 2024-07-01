<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rti extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('rti_model');
    }

    function get_rti_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['rti_data'] = array();
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
            
            $search_appno = get_from_post('app_no_for_rti_list');
            $search_appd = get_from_post('application_date_for_rti_list');
            $search_appdet = filter_var(get_from_post('app_details_for_rti_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_rti_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_rti_list');
            $search_qstatus = get_from_post('query_status_for_rti_list');
            $search_status = get_from_post('status_for_rti_list');
            $new_s_app_status = get_from_post('s_app_status');
            $new_search_appd = get_from_post('s_appd');
            $search_appd = $new_search_appd != '' ? $new_search_appd : $search_appd;
            
            $new_qstatus = get_from_post('s_qstatus');
            $search_qstatus = $new_qstatus != '' ? $new_qstatus : $search_qstatus;
            $new_status = get_from_post('s_status');
            $search_status = $new_status != '' ? $new_status : $search_status;
            
            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['rti_data'] = $this->rti_model->get_all_rti_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->rti_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->rti_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['rti_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['rti_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_rti_data_by_id() {
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
            $rti_id = get_from_post('rti_id');
            if (!$rti_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $rti_data = $this->utility_model->get_by_id('rti_id', $rti_id, 'rti');
            if (empty($rti_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['rti_data'] = $rti_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_rti() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            $rti_id = get_from_post('rti_id_for_rti');
            if (!is_post() || $user_id == NULL || !$user_id || $rti_id == NULL || !$rti_id ||
                    ($module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $rti_data = $this->_get_post_data_for_rti();
            $validation_message = $this->_check_validation_for_rti($rti_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $rti_data['applicant_dob'] = convert_to_mysql_date_format($rti_data['applicant_dob']);
            $rti_data['pertains_period_date'] = convert_to_mysql_date_format('01-' . $rti_data['pertains_period_date']);
            $rti_data['updated_by'] = $user_id;
            $rti_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('rti_id', $rti_id, 'rti', $rti_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_rti() {
        $rti_data = array();
        $rti_data['district'] = get_from_post('district_for_rti');
        $rti_data['village_name'] = get_from_post('village_name_for_rti');
        $rti_data['applicant_name'] = get_from_post('applicant_name_for_rti');
        $rti_data['applicant_profession'] = get_from_post('applicant_profession_for_rti');
        $rti_data['applicant_dob'] = get_from_post('applicant_dob_for_rti');
        $rti_data['applicant_age'] = get_from_post('applicant_age_for_rti');
        $rti_data['applicant_address'] = get_from_post('applicant_address_for_rti');
        $rti_data['mobile_number'] = get_from_post('mobile_number_for_rti');
        $rti_data['subject'] = get_from_post('subject_for_rti');
        $rti_data['pertains_period_date'] = get_from_post('pertains_period_date_for_rti');
        $rti_data['rti_type'] = get_from_post('rti_type_for_rti');
        $rti_data['pertains_inspection_record'] = get_from_post('pertains_inspection_record_for_rti');
        if ($rti_data['pertains_inspection_record'] == VALUE_ONE) {
            $rti_data['inspection_no_of_days'] = get_from_post('inspection_no_of_days_for_rti');
        } else {
            $rti_data['inspection_no_of_days'] = '';
        }

        return $rti_data;
    }

    function _check_validation_for_rti($rti_data) {
        if (!$rti_data['district']) {
            return SELECT_DISTRICT_MESSAGE;
        }
        if (!$rti_data['village_name']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$rti_data['applicant_name']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$rti_data['applicant_profession']) {
            return PROFESSION_OCCUPASSION_MESSAGE;
        }
        if (!$rti_data['applicant_dob']) {
            return DATE_MESSAGE;
        }
        if (!$rti_data['applicant_address']) {
            return ADDRESS_MESSAGE;
        }
        if (!$rti_data['mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$rti_data['subject']) {
            return DETAIL_MESSAGE;
        }
        if (!$rti_data['pertains_period_date']) {
            return DATE_MESSAGE;
        }
        if (!$rti_data['rti_type']) {
            return SELECT_ANY_MESSAGE;
        }
        if (!$rti_data['pertains_inspection_record']) {
            return SELECT_ANY_MESSAGE;
        }
        if ($rti_data['pertains_inspection_record'] == VALUE_ONE) {
            if (!$rti_data['inspection_no_of_days']) {
                return DETAIL_MESSAGE;
            }
        }

        return '';
    }

    function reverify_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $rti_id = get_from_post('rti_id_for_rti_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$rti_id || $rti_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if (!is_mamlatdar_user() && !is_talathi_user() && !is_aci_user()) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            if (is_mamlatdar_user()) {
                $update_data['to_type_reverify'] = get_from_post('to_type_reverify_for_rti');
                if (!$update_data['to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['mam_reverify_remarks'] = get_from_post('mam_reverify_remarks_for_rti');
                if (!$update_data['mam_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['mam_to_reverify_datetime'] = date('Y-m-d H:i:s');
                $update_data['status'] = VALUE_THREE;
            }
            if (is_talathi_user()) {
                $update_data['talathi_to_type_reverify'] = get_from_post('talathi_to_type_reverify_for_rti');
                if (!$update_data['talathi_to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['talathi_reverify_remarks'] = get_from_post('talathi_reverify_remarks_for_rti');
                if (!$update_data['talathi_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['talathi_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_aci_user()) {
                $update_data['aci_rec_reverify'] = get_from_post('aci_rec_reverify_for_rti');
                if (!$update_data['aci_rec_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['aci_reverify_remarks'] = get_from_post('aci_reverify_remarks_for_rti');
                if (!$update_data['aci_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($update_data['aci_rec_reverify'] == VALUE_ONE) {
                    $update_data['aci_to_ldc'] = get_from_post('aci_to_ldc_reverify_for_rti');
                    if (!$update_data['aci_to_ldc']) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                    $update_data['aci_to_ldc_datetime'] = date('Y-m-d H:i:s');
                }
                $update_data['aci_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_admin() || is_ldc_user()) {
                $ldc_applicant_name = get_from_post('ldc_applicant_name_for_rti');
                if (!$ldc_applicant_name) {
                    echo json_encode(get_error_array(APPLICANT_NAME_MESSAGE));
                    return false;
                }
                $pre_house_no = get_from_post('pre_house_no');
                if (!$pre_house_no) {
                    echo json_encode(get_error_array(HOUSE_NO_MESSAGE));
                    return false;
                }
                $pre_house_name = get_from_post('pre_house_name');
                if (!$pre_house_name) {
                    echo json_encode(get_error_array(HOUSE_NAME_MESSAGE));
                    return false;
                }
                $pre_street = get_from_post('pre_street');
                if (!$pre_street) {
                    echo json_encode(get_error_array(STREET_MESSAGE));
                    return false;
                }
                $pre_village = get_from_post('pre_village');
                if (!$pre_village) {
                    echo json_encode(get_error_array(VILLAGE_WARD_MESSAGE));
                    return false;
                }
                $pre_city = get_from_post('pre_city');
                if (!$pre_city) {
                    echo json_encode(get_error_array(SELECT_CITY_MESSAGE));
                    return false;
                }
                $pre_pincode = get_from_post('pre_pincode');
                if (!$pre_pincode) {
                    echo json_encode(get_error_array(PINCODE_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar_remarks = get_from_post('ldc_to_mamlatdar_remarks_for_rti');
                if (!$ldc_to_mamlatdar_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar = get_from_post('ldc_to_mamlatdar_for_rti');
                if (!$ldc_to_mamlatdar) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('rti_id', $rti_id, 'rti');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('rti_id', $rti_id, 'rti', $update_data);
            $rti_data = $this->rti_model->get_basic_data_for_hc($rti_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = is_mamlatdar_user() ? APP_REVERIFY_MESSAGE : APP_FORWARDED_MESSSAGE;
            $success_array['rti_data'] = $rti_data;
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
            $rti_id = get_from_post('rti_id_for_rti_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$rti_id || $rti_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_rti_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('rti_id', $rti_id, 'rti');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = get_days_in_dates($ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('rti_id', $rti_id, 'rti', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWELVE, $ex_data);

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
            $rti_id = get_from_post('rti_id_for_rti_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$rti_id || $rti_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_rti_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('rti_id', $rti_id, 'rti');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = get_days_in_dates($ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('rti_id', $rti_id, 'rti', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TWELVE, $ex_data);

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

    function get_rti_data_by_rti_id() {
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
            $rti_id = get_from_post('rti_id');
            if (!$rti_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $rti_data = $this->rti_model->get_basic_data_for_hc($rti_id);
            if (empty($rti_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            // $ti_bd = $this->_calculate_total_income_and_basic_details($rti_data);
            // $rti_data['total_income'] = $ti_bd['total_income'];
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['rti_data'] = $rti_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $rti_id = get_from_post('rti_id_for_certificate');
            $mtype = get_from_post('mtype_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $rti_id == null || !$rti_id ||
                    ($mtype != VALUE_ONE && $mtype != VALUE_TWO)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_rti_data = $this->utility_model->get_by_id('rti_id', $rti_id, 'rti');
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($existing_rti_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($mtype == VALUE_TWO) {
                if ($existing_rti_data['status'] != VALUE_FIVE) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return;
                }
            }
            error_reporting(E_ERROR);
            $data = array('rti_data' => $existing_rti_data, 'mtype' => $mtype);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            if ($mtype == VALUE_ONE) {
                $mpdf->showWatermarkText = true;
            } else {
                $mpdf->showWatermarkImage = true;
            }
            $mpdf->setFooter('{PAGENO} / {nb}');
            $mpdf->WriteHTML($this->load->view('rti/certificate', $data, TRUE));
            $mpdf->Output('rti_' . time() . '.pdf', 'I');
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
            $search_appno = get_from_post('app_no_for_rtige');
            $search_appd = get_from_post('app_date_for_rtige');
            $search_appdet = get_from_post('app_details_for_rtige');
            $search_vdw = get_from_post('vdw_for_rtige');
            $search_qstatus = get_from_post('qstatus_for_rtige');
            $search_status = get_from_post('status_for_rtige');
            
            $this->db->trans_start();
            $excel_data = $this->rti_model->get_records_for_excel($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_qstatus, $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=RTI_Report_' . date('Y-m-d H:i:s') . '.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('Application Number', 'District', 'Applicant Name', 'Mobile Number', 'Applicant Address', 'Submitted On', 'Status', 'Query Status'));
            if (!empty($excel_data)) {
                $taluka_array = $this->config->item('taluka_array');
                $app_status_text_array = $this->config->item('app_status_text_array');
                $query_status_text_array = $this->config->item('query_status_text_array');
                $prefix_module_array = $this->config->item('prefix_module_array');
                foreach ($excel_data as $list) {
                    $prefix = isset($prefix_module_array[VALUE_THREE]) ? $prefix_module_array[VALUE_THREE] : '';
//                    $list['rti_id'] = generate_registration_number($prefix, $list['rti_id']);
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

    function get_appointment_data_by_rti_id() {
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
            $rti_id = get_from_post('rti_id');
            if (!$rti_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $appointment_data = $this->utility_model->get_appointment_data_by_id('rti_id', $rti_id, 'rti');
            // if (empty($appointment_data)) {
            //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            //     return false;
            // }
            $success_array = get_success_array();
            $success_array['appointment_data'] = $appointment_data;
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
            $rti_id = get_from_post('rti_id_for_rti_set_appointment');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$rti_id || $rti_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_data = array();
            $this->db->trans_start();
            $appointment_date = get_from_post('appointment_date_for_rti');
            $appointment_data['appointment_date'] = convert_to_mysql_date_format($appointment_date);
            $appointment_data['appointment_time'] = get_from_post('appointment_time_for_rti');
            $appointment_data['appointment_by'] = $session_user_id;
            $appointment_data['appointment_by_name'] = get_from_session('name');
            $appointment_data['appointment_datetime'] = $appointment_data['appointment_date'] . ' ' . date("H:i:s", strtotime($appointment_data['appointment_time']));
            $appointment_data['online_statement'] = get_from_post('online_statement_for_rti');
            $appointment_data['visit_office'] = get_from_post('visit_office_for_rti');
            $appointment_data['updated_by'] = $session_user_id;
            $appointment_data['updated_time'] = date('Y-m-d H:i:s');
            $appointment_data['appointment_status'] = VALUE_ONE;
            $this->utility_model->update_data('rti_id', $rti_id, 'rti', $appointment_data);
            $rti_data = $this->rti_model->get_basic_data_for_hc($rti_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            // Appointment Email & SMS
            $this->utility_lib->email_and_sms_for_certificate_appointment(VALUE_TWELVE, $rti_data);

            $success_array = get_success_array();
            $success_array['message'] = APPOINTMENT_SET_MESSAGE;
            $success_array['rti_data'] = $rti_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_update_basic_detail_data_by_rti_id() {
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
            $rti_id = get_from_post('rti_id');
            if (!$rti_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $basic_details = $this->rti_model->get_basic_data_for_hc($rti_id);
            if (empty($basic_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $talathi_name = '';
            $aci_data = array();
            $mamlatdar_data = array();
            $ldc_data = array();
            if (is_talathi_user() && $basic_details['talathi_to_aci'] == VALUE_ZERO) {
                $aci_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_ACI_USER);
            }
            if (is_aci_user() && $basic_details['aci_rec'] == VALUE_ZERO) {
                $mamlatdar_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_MAMLATDAR_USER);
                $ldc_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_LDC_USER);
            }

            if (is_aci_user() && $basic_details['to_type_reverify'] != VALUE_ZERO && $basic_details['aci_rec_reverify'] == VALUE_ZERO) {
                $ldc_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_LDC_USER);
            }
            if (is_ldc_user() && $basic_details['ldc_to_mamlatdar'] == VALUE_ZERO) {
                $mamlatdar_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_MAMLATDAR_USER);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['update_basic_detail_data'] = $basic_details;
            $success_array['talathi_name'] = $talathi_name;
            $success_array['aci_data'] = $aci_data;
            $success_array['mamlatdar_data'] = $mamlatdar_data;
            $success_array['ldc_data'] = $ldc_data;
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
            $rti_id = get_from_post('rti_id_for_rti_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$rti_id || $rti_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            if (is_admin() || is_talathi_user()) {
                // $income_by_talathi = get_from_post('income_by_talathi_for_rti');
//            if (!$income_by_talathi) {
//                echo json_encode(get_error_array(AMOUNT_OF_INCOME_MESSAGE));
//                return false;
//            }
                $talathi_remarks = get_from_post('talathi_remarks_for_rti');
                if (!$talathi_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $talathi_to_aci = get_from_post('talathi_to_aci_for_rti');
                if (!$talathi_to_aci) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if (is_admin() || is_talathi_user()) {
                $talathi_remarks = get_from_post('talathi_remarks_for_rti');
                if (!$talathi_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $talathi_to_aci = get_from_post('talathi_to_aci_for_rti');
                if (!$talathi_to_aci) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if (is_admin() || is_aci_user()) {
                $aci_rec = get_from_post('aci_rec_for_rti');
                if (!$aci_rec) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $aci_remarks = get_from_post('aci_remarks_for_rti');
                if (!$aci_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($aci_rec == VALUE_ONE) {
                    $aci_to_ldc = get_from_post('aci_to_ldc_for_rti');
                    if (!$aci_to_ldc) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
                if ($aci_rec == VALUE_TWO) {
                    $aci_to_mamlatdar = get_from_post('aci_to_mamlatdar_for_rti');
                    if (!$aci_to_mamlatdar) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
            }
            if (is_admin() || is_ldc_user()) {
                $ldc_applicant_name = get_from_post('ldc_applicant_name_for_rti');
                if (!$ldc_applicant_name) {
                    echo json_encode(get_error_array(APPLICANT_NAME_MESSAGE));
                    return false;
                }
                $pre_house_no = get_from_post('pre_house_no');
                if (!$pre_house_no) {
                    echo json_encode(get_error_array(HOUSE_NO_MESSAGE));
                    return false;
                }
                $pre_house_name = get_from_post('pre_house_name');
                if (!$pre_house_name) {
                    echo json_encode(get_error_array(HOUSE_NAME_MESSAGE));
                    return false;
                }
                $pre_street = get_from_post('pre_street');
                if (!$pre_street) {
                    echo json_encode(get_error_array(STREET_MESSAGE));
                    return false;
                }
                $pre_village = get_from_post('pre_village');
                if (!$pre_village) {
                    echo json_encode(get_error_array(VILLAGE_WARD_MESSAGE));
                    return false;
                }
                $pre_city = get_from_post('pre_city');
                if (!$pre_city) {
                    echo json_encode(get_error_array(SELECT_CITY_MESSAGE));
                    return false;
                }
                $pre_pincode = get_from_post('pre_pincode');
                if (!$pre_pincode) {
                    echo json_encode(get_error_array(PINCODE_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar_remarks = get_from_post('ldc_to_mamlatdar_remarks_for_rti');
                if (!$ldc_to_mamlatdar_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar = get_from_post('ldc_to_mamlatdar_for_rti');
                if (!$ldc_to_mamlatdar) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('rti_id', $rti_id, 'rti');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_talathi_data = array();
            $temp_aci_data = array();
            $basic_detail_data = array();
            if (is_admin() || is_talathi_user()) {
                $temp_aci_data = $this->utility_model->get_by_id('sa_user_id', $talathi_to_aci, 'sa_users');
                if (empty($temp_aci_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                $temp_talathi_data = $this->utility_model->get_by_id('sa_user_id', $session_user_id, 'sa_users');
                $basic_detail_data['talathi'] = $session_user_id;
                //$basic_detail_data['income_by_talathi'] = $income_by_talathi;
                $basic_detail_data['talathi_remarks'] = $talathi_remarks;
                $basic_detail_data['talathi_to_aci'] = $talathi_to_aci;
                $basic_detail_data['talathi_to_aci_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_admin() || is_aci_user()) {
                $basic_detail_data['aci_rec'] = $aci_rec;
                $basic_detail_data['aci_remarks'] = $aci_remarks;
                if ($aci_rec == VALUE_ONE) {
                    $basic_detail_data['aci_to_ldc'] = $aci_to_ldc;
                    $basic_detail_data['aci_to_ldc_datetime'] = date('Y-m-d H:i:s');
                }
                if ($aci_rec == VALUE_TWO) {
                    $basic_detail_data['aci_to_mamlatdar'] = $aci_to_mamlatdar;
                    $basic_detail_data['aci_to_mamlatdar_datetime'] = date('Y-m-d H:i:s');
                }
            }
            if (is_admin() || is_ldc_user()) {
                $basic_detail_data['ldc_applicant_name'] = $ldc_applicant_name;
                $basic_detail_data['pre_house_no'] = $pre_house_no;
                $basic_detail_data['pre_house_name'] = $pre_house_name;
                $basic_detail_data['pre_street'] = $pre_street;
                $basic_detail_data['pre_village'] = $pre_village;
                $basic_detail_data['pre_city'] = $pre_city;
                $basic_detail_data['pre_pincode'] = $pre_pincode;
                $basic_detail_data['ldc_to_mamlatdar_remarks'] = $ldc_to_mamlatdar_remarks;
                $basic_detail_data['ldc_to_mamlatdar'] = $ldc_to_mamlatdar;
                $basic_detail_data['ldc_to_mamlatdar_datetime'] = date('Y-m-d H:i:s');
            }
            $basic_detail_data['updated_by'] = $session_user_id;
            $basic_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('rti_id', $rti_id, 'rti', $basic_detail_data);
            $ic_data = $this->rti_model->get_basic_data_for_hc($rti_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APP_FORWARDED_MESSSAGE;
            $success_array['rti_id'] = $rti_id;
            $success_array['rti_data'] = $ic_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function document_for_scrutiny() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $rti_id = get_from_post('rti_id_for_scrutiny');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$rti_id || $rti_id == NULL) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $hc_data = $this->rti_model->get_basic_data_for_hc($rti_id);
            if (empty($hc_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }

            $query_data = $this->utility_model->query_data_for_scrutiny(VALUE_TWELVE, $rti_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('rti/pdf', $hc_data, TRUE));

            $temp_filename = 'basic_hc_' . $rti_id . '_' . time() . '.pdf';
            $temp_filepath = 'documents/temp/' . $temp_filename;
            //$mpdf->Output($temp_filepath, 'F');

            $temp_files_to_remove = array();
            $temp_files_to_merge = array();
            array_push($temp_files_to_remove, $temp_filepath);
            array_push($temp_files_to_merge, $temp_filepath);

//        if ($hc_data['applicant_photo_doc'] != '') {
//            $new_applicant_photo_path = $this->_copy_file(RTI_DOC_PATH, $hc_data['applicant_photo_doc']);
//            $applicant_photo_page_count = $mpdf->SetSourceFile($new_applicant_photo_path);
//            unlink($new_applicant_photo_path);
//            $this->_merge_multiple_pdf($mpdf, $applicant_photo_page_count);
//        }
//        if ($hc_data['witness1_photo_doc'] != '') {
//            $new_witness1_photo_path = $this->_copy_file(RTI_DOC_PATH, $hc_data['witness1_photo_doc']);
//            $witness1_photo_page_count = $mpdf->SetSourceFile($new_witness1_photo_path);
//            unlink($new_witness1_photo_path);
//            $this->_merge_multiple_pdf($mpdf, $witness1_photo_page_count);
//        }
//        if ($hc_data['witness2_photo_doc'] != '') {
//            $new_witness2_photo_path = $this->_copy_file(RTI_DOC_PATH, $hc_data['witness2_photo_doc']);
//            $witness2_photo_page_count = $mpdf->SetSourceFile($new_witness2_photo_path);
//            unlink($new_witness2_photo_path);
//            $this->_merge_multiple_pdf($mpdf, $witness2_photo_page_count);
//        }
            if (!empty($query_data)) {
                foreach ($query_data as $q_data) {
                    if ($q_data['query_type'] == VALUE_TWO) {
                        if ($q_data['document'] != '') {
                            $new_qd_path = $this->_copy_file(QUERY_PATH, $q_data['document']);
                            array_push($temp_files_to_remove, $new_qd_path);

                            if (strpos($new_qd_path, '.pdf')) {
                                array_push($temp_files_to_merge, $new_qd_path);
                            } else {
                                $mpdf->WriteHTML($this->load->view('common/image_to_pdf', array('photo_doc' => $new_qd_path), TRUE));
                            }
                        }
                    } else {
                        if ($q_data['document'] != '') {
                            $new_aqd_path = 'documents/query/' . $q_data['document'];

                            if (strpos($new_aqd_path, '.pdf')) {
                                array_push($temp_files_to_merge, $new_aqd_path);
                            } else {
                                $mpdf->WriteHTML($this->load->view('common/image_to_pdf', array('photo_doc' => $new_aqd_path), TRUE));
                            }
                        }
                    }
                }
            }
            $mpdf->Output($temp_filepath, 'F');
            $final_filename = 'final_scrutiny_document_rti_' . rand(111111111, 99999999) . '_' . time() . '.pdf';
            $temp_ffp = 'documents/temp/' . $final_filename;
            $final_filepath = FCPATH . $temp_ffp;

            merge_pdf($final_filepath, $temp_files_to_merge);

            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=" . $final_filename);
            @readfile($temp_ffp);

            array_push($temp_files_to_remove, $temp_ffp);
            if (!empty($temp_files_to_remove)) {
                foreach ($temp_files_to_remove as $key => $file) {
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            }
            // $mpdf->Output($rti_id . '_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            $this->load->view('error', array('error_message' => $e->getMessage()));
            return;
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
                if (($i + 1) != $pagecount) {
                    $mpdf->addPage();
                }
            }
        }
    }
}

/*
 * EOF: ./application/controller/Heirship.php
 */
