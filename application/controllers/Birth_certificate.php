<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Birth_certificate extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('birth_certificate_model');
    }

    function get_birth_certificate_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['birth_certificate_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            if (is_admin()) {
                $new_s_district = get_from_post('search_district');
                $s_district = $new_s_district != '' ? $new_s_district : '';
            } else {
                $s_district = $session_district;
            }
            $s_app_no = filter_var(trim($columns[1]['search']['value']), FILTER_SANITIZE_SPECIAL_CHARS);
            $s_app_det = filter_var(trim($columns[3]['search']['value']), FILTER_SANITIZE_SPECIAL_CHARS);
            $s_app_status = trim($columns[4]['search']['value']);
            $s_qstatus = trim($columns[6]['search']['value']);
            $s_status = trim($columns[7]['search']['value']);

            $new_s_app_status = get_from_post('s_app_status');
            $s_app_status = $new_s_app_status != '' ? $new_s_app_status : $s_app_status;
            $new_qstatus = get_from_post('s_qstatus');
            $s_qstatus = $new_qstatus != '' ? $new_qstatus : $s_qstatus;
            $new_status = get_from_post('s_status');
            $s_status = $new_status != '' ? $new_status : $s_status;

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['birth_certificate_data'] = $this->birth_certificate_model->get_all_birth_certificate_list($start, $length, $s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status);
            $success_array['recordsTotal'] = $this->birth_certificate_model->get_total_count_of_records($s_district);
            if (($s_district != '' && is_admin()) || $s_app_no != '' || $s_app_det != '' || $s_app_status != '' || $s_qstatus != '' || $s_status != '') {
                $success_array['recordsFiltered'] = $this->birth_certificate_model->get_filter_count_of_records($s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['birth_certificate_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['birth_certificate_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_birth_certificate_data_by_id() {
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
            $birth_certificate_id = get_from_post('birth_certificate_id');
            if (!$birth_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $birth_certificate_data = $this->utility_model->get_by_id('birth_certificate_id', $birth_certificate_id, 'birth_certificate');
            if (empty($birth_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['birth_certificate_data'] = $birth_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_birth_certificate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            $birth_certificate_id = get_from_post('birth_certificate_id_for_birth_certificate');
            if (!is_post() || $user_id == NULL || !$user_id || $birth_certificate_id == NULL || !$birth_certificate_id ||
                    ($module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $bc_data = $this->_get_post_data_for_birth_certificate();
            $validation_message = $this->_check_validation_for_birth_certificate($module_type, $bc_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            if ($module_type == VALUE_FIVE) {
                $ex_bc_data = $this->utility_model->get_by_id('birth_certificate_id', $birth_certificate_id, 'birth_certificate', 'user_id', $session_user_id);
                if (empty($ex_bc_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                if ($ex_bc_data['status'] == VALUE_FIVE || $ex_bc_data['status'] == VALUE_SIX) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                if ($ex_bc_data['query_status'] == VALUE_ONE) {
                    $qrremarks = get_from_post('qr_remarks');
                    if (!$qrremarks) {
                        echo json_encode(get_error_array(REMARKS_MESSAGE));
                        return false;
                    }
                    $ex_query = $this->utility_model->get_by_id_multiple('module_type', VALUE_NINETEEN, 'query', 'module_id', $birth_certificate_id, 'query_type', VALUE_TWO, 'status', VALUE_ZERO);
                    $iu_data = array();
                    $iu_data['remarks'] = $qrremarks;
                    $iu_data['status'] = VALUE_ONE;
                    $iu_data['query_by_name'] = get_from_session('name');
                    if (empty($ex_query)) {
                        $iu_data['module_type'] = VALUE_NINETEEN;
                        $iu_data['module_id'] = $birth_certificate_id;
                        $iu_data['query_type'] = VALUE_TWO;
                        $iu_data['user_id'] = $session_user_id;
                        $iu_data['created_by'] = $session_user_id;
                        $iu_data['created_time'] = date('Y-m-d H:i:s');
                        $iu_data['query_datetime'] = $iu_data['created_time'];
                        $this->utility_model->insert_data('query', $iu_data);
                    } else {
                        $iu_data['updated_by'] = $session_user_id;
                        $iu_data['updated_time'] = date('Y-m-d H:i:s');
                        $iu_data['query_datetime'] = $iu_data['updated_time'];
                        $this->utility_model->update_data('query_id', $ex_query['query_id'], 'query', $iu_data);

                        $this->utility_model->update_data('query_id', $ex_query['query_id'], 'query_document', array('doc_name' => 'Document'));
                    }
                    $bc_data['query_status'] = VALUE_TWO;
                }
            } else {
                $bc_data['status'] = $module_type;
                if ($module_type == VALUE_THREE) {
                    $bc_data['status'] = VALUE_TWO;
                    $bc_data['submitted_datetime'] = date('Y-m-d H:i:s');
                }
            }
            $this->db->trans_start();
            $bc_data['applicant_dob'] = convert_to_mysql_date_format($bc_data['applicant_dob']);
            if ($bc_data['is_date_or_year'] == VALUE_ONE) {
                $bc_data['registration_date'] = convert_to_mysql_date_format($bc_data['registration_date']);
            }
            $bc_data['updated_by'] = $user_id;
            $bc_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('birth_certificate_id', $birth_certificate_id, 'birth_certificate', $bc_data);

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

    function _get_application_number(&$birth_certificate_data) {
        $birth_certificate_data['application_year'] = get_financial_year();
        $birth_certificate_data['temp_application_number'] = VALUE_ONE;
        $ex_app_num_data = $this->utility_model->get_by_id('application_year', $birth_certificate_data['application_year'], 'birth_certificate', '', '', 'temp_application_number', 'DESC');
        if (!empty($ex_app_num_data)) {
            $birth_certificate_data['temp_application_number'] = ($ex_app_num_data['temp_application_number'] + 1);
        }
        $birth_certificate_data['application_number'] = 'BC/' . $birth_certificate_data['application_year'] . '/' . get_application_number($birth_certificate_data['temp_application_number']);
    }

    function _get_post_data_for_birth_certificate() {
        $birth_certificate_data = array();
        $birth_certificate_data['district'] = get_from_post('district_for_birth_certificate');
        $birth_certificate_data['applicant_name'] = get_from_post('applicant_name_for_birth_certificate');
        $birth_certificate_data['mobile_number'] = get_from_post('mobile_number_for_birth_certificate');
        $birth_certificate_data['aadhar_number'] = get_from_post('aadhar_number_for_birth_certificate');
        $birth_certificate_data['email'] = get_from_post('email_for_birth_certificate');
        $birth_certificate_data['communication_address'] = get_from_post('communication_address_for_birth_certificate');
        $birth_certificate_data['applicant_address'] = get_from_post('applicant_address_for_birth_certificate');
        $birth_certificate_data['applicant_dob'] = get_from_post('applicant_dob_for_birth_certificate');
        $birth_certificate_data['applicant_age'] = get_from_post('applicant_age_for_birth_certificate');
        $birth_certificate_data['applicant_born_place'] = get_from_post('applicant_born_place_for_birth_certificate');
        $birth_certificate_data['gender'] = get_from_post('gender_for_birth_certificate');
        $birth_certificate_data['mother_name'] = get_from_post('mother_name_for_birth_certificate');
        $birth_certificate_data['father_name'] = get_from_post('father_name_for_birth_certificate');
        $birth_certificate_data['registration_number'] = get_from_post('registration_number_for_birth_certificate');
        $birth_certificate_data['is_date_or_year'] = get_from_post('date_year_for_birth_certificate');
        if ($birth_certificate_data['is_date_or_year'] == VALUE_ONE) {
            $birth_certificate_data['registration_date'] = get_from_post('registration_date_for_birth_certificate');
        }
        if ($birth_certificate_data['is_date_or_year'] == VALUE_TWO) {
            $birth_certificate_data['registration_year'] = get_from_post('registration_year_for_birth_certificate');
        }
        $birth_certificate_data['relationship_with_applicant'] = get_from_post('relationship_with_applicant_for_birth_certificate');
        $birth_certificate_data['other_relationship_with_applicant'] = get_from_post('other_relationship_with_applicant_for_birth_certificate');
        $birth_certificate_data['purpose'] = get_from_post('purpose_for_birth_certificate');
        $birth_certificate_data['applying_for'] = get_from_post('applying_for_birth_certificate');
        return $birth_certificate_data;
    }

    function _check_validation_for_birth_certificate($module_type, $birth_certificate_data) {
        if (!$birth_certificate_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$birth_certificate_data['applicant_name']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$birth_certificate_data['mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$birth_certificate_data['communication_address']) {
            return COMMUNICATION_ADDRESS_MESSAGE;
        }
        if (!$birth_certificate_data['applicant_address']) {
            return COMMUNICATION_ADDRESS_MESSAGE;
        }
        if (!$birth_certificate_data['applicant_dob']) {
            return BIRTH_DATE_MESSAGE;
        }
        if ($module_type == VALUE_ONE) {
            return '';
        }
        if (!$birth_certificate_data['applicant_born_place']) {
            return BORN_PLACE_MESSAGE;
        }
        if (!$birth_certificate_data['gender']) {
            return GENDER_MESSAGE;
        }
        if (!$birth_certificate_data['mother_name']) {
            return MOTHER_NAME_MESSAGE;
        }
        if (!$birth_certificate_data['father_name']) {
            return FATHER_NAME_MESSAGE;
        }
        if (!$birth_certificate_data['registration_number']) {
            return REGISTRATION_NUMBER_MESSAGE;
        }
        if (!$birth_certificate_data['is_date_or_year']) {
            return DATE_YEAR_MESSAGE;
        }
        if ($birth_certificate_data['is_date_or_year'] == VALUE_ONE) {
            if (!$birth_certificate_data['registration_date']) {
                return REGISTRATION_DATE_MESSAGE;
            }
        }
        if ($birth_certificate_data['is_date_or_year'] == VALUE_TWO) {
            if (!$birth_certificate_data['registration_year']) {
                return REGISTRATION_YEAR_MESSAGE;
            }
        }
        if (!$birth_certificate_data['relationship_with_applicant']) {
            return RELATION_STATUS_MESSAGE;
        }
        if ($birth_certificate_data['relationship_with_applicant'] == VALUE_FIVE) {
            if (!$birth_certificate_data['other_relationship_with_applicant']) {
                return OTHER_RELATIONSHIP_MESSAGE;
            }
        }
        if (!$birth_certificate_data['purpose']) {
            return PURPOSE_FOR_BIRTH_CERTIFICATE_MESSAGE;
        }
        if (!$birth_certificate_data['applying_for']) {
            return APPLYING_FOR_CERTIFICATE_MESSAGE;
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
            $birth_certificate_id = get_from_post('birth_certificate_id_for_birth_certificate_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$birth_certificate_id || $birth_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_birth_certificate_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('birth_certificate_id', $birth_certificate_id, 'birth_certificate', $update_data);

            // $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            // if (empty($user_data)) {
            //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            //     return false;
            // }
            // $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id);
            // $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWO, $ex_data);
            // if ($ex_data['email'] != $user_data['email']) {
            //     $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
            //     $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWO, $ex_data);
            // }

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
            $birth_certificate_id = get_from_post('birth_certificate_id_for_birth_certificate_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$birth_certificate_id || $birth_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_birth_certificate_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('birth_certificate_id', $birth_certificate_id, 'birth_certificate', $update_data);

            // $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            // if (empty($user_data)) {
            //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            //     return false;
            // }
            // $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id);
            // $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TWO, $ex_data);
            // if ($ex_data['email'] != $user_data['email']) {
            //     $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
            //     $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TWO, $ex_data);
            // }

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

    function get_birth_certificate_data_by_birth_certificate_id() {
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
            $birth_certificate_id = get_from_post('birth_certificate_id');
            if (!$birth_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $birth_certificate_data = $this->birth_certificate_model->get_basic_data_for_bc($birth_certificate_id);
            if (empty($birth_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['birth_certificate_data'] = $birth_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $birth_certificate_id = get_from_post('birth_certificate_id_for_certificate');
            $mtype = get_from_post('mtype_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $birth_certificate_id == null || !$birth_certificate_id ||
                    ($mtype != VALUE_ONE && $mtype != VALUE_TWO)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_birth_certificate_data = $this->utility_model->get_by_id('birth_certificate_id', $birth_certificate_id, 'birth_certificate');
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($existing_birth_certificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($mtype == VALUE_TWO) {
                if ($existing_birth_certificate_data['status'] != VALUE_FIVE) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return;
                }
            }
            error_reporting(E_ERROR);
            $data = array('birth_certificate_data' => $existing_birth_certificate_data, 'mtype' => $mtype);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            if ($mtype == VALUE_ONE) {
                $mpdf->showWatermarkText = true;
            } else {
                $mpdf->showWatermarkImage = true;
            }
            $mpdf->WriteHTML($this->load->view('birth_certificate/certificate', $data, TRUE));
            $mpdf->Output('birth_certificate_' . time() . '.pdf', 'I');
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
            $s_district = is_admin() ? '' : $session_district;
            $s_app_no = get_from_post('app_no_for_bcge');
            $s_app_det = get_from_post('app_details_for_bcge');
            $s_app_status = get_from_post('app_status_for_bcge');
            $s_qstatus = get_from_post('qstatus_for_bcge');
            $s_status = get_from_post('status_for_bcge');
            $this->db->trans_start();
            $excel_data = $this->birth_certificate_model->get_records_for_excel($s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Birth_certificate_Report_' . date('Y-m-d H:i:s') . '.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('Application Number', 'Submitted On', 'Applicant Name', 'Applicant Address', 'Mobile Number',
                'District', 'Date Of Birth', 'Place Of Birth', 'Registration Number', 'Status', 'Query Status'));
            if (!empty($excel_data)) {
                $taluka_array = $this->config->item('taluka_array');
                $app_status_text_array = $this->config->item('app_status_text_array');
                $query_status_text_array = $this->config->item('query_status_text_array');
                $daman_villages_array = $this->config->item('daman_villages_array');
                $diu_villages_array = $this->config->item('diu_villages_array');
                $dnh_villages_array = $this->config->item('dnh_villages_array');
                foreach ($excel_data as $list) {
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
}

/*
 * EOF: ./application/controller/Birth_certificate.php
 */