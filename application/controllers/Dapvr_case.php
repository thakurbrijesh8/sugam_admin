<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dapvr_case extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('dapvr_case_model');
    }

    function get_dapvr_case_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = get_success_array();
            $success_array['dapvr_case_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $search_status = get_from_post('search_status') ? get_from_post('search_status') : null;
            $search_month_status = get_from_post('search_month_status') ? get_from_post('search_month_status') : null;
            $this->db->trans_start();
            $dapvr_case_data = $this->dapvr_case_model->get_dapvr_case_data($search_status, $search_month_status);

            $success_array['dapvr_case_data'] = $dapvr_case_data;
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['dapvr_case_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_basic_data_for_form() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        $this->db->trans_start();
        $village_data = generate_array_for_id_object($this->utility_model->get_villages_data('daman_rural_villages'), 'village');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
            return;
        }
        $success_array = get_success_array();
        $success_array['village_data'] = $village_data;
        echo json_encode($success_array);
    }

    function get_dapvr_case_data_by_id() {
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
            $case_id = get_from_post('case_id');
            if (!$case_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $this->db->trans_start();
            $dapvr_case_data = $this->utility_model->get_by_id('case_id', $case_id, 'dapvr_case');
            if (empty($dapvr_case_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $is_edit = get_from_post('is_edit');
            $ld_details = json_decode($dapvr_case_data['land_details'], TRUE);
            if ($is_edit == VALUE_ONE) {

                if (!empty($ld_details)) {
                    foreach ($ld_details as &$ldd) {
                        $ldd['survey_data'] = $ldd['village'] != '' ? $this->utility_model->get_survey_list('rural_land_parcels', $ldd['village']) : array();

                        $ldd['subdiv_data'] = array();
                        if ($ldd['village'] != '' && $ldd['survey'] != '') {
                            $ldd['subdiv_data'] = $this->utility_model->get_subdiv_list('rural_land_parcels', $ldd['village'], $ldd['survey']);
                        }
                    }
                }
            }
            $advocate_list_data = $this->dapvr_case_model->get_advocate_list_for_dapvr_case(TRUE);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['dapvr_case_data'] = $dapvr_case_data;
            $success_array['ld_details'] = $ld_details;
            $success_array['advocate_list_data'] = $advocate_list_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_dapvr_case() {
        $dapvr_case_data = array();
        $dapvr_case_data['district'] = get_from_post('district_for_dapvr_case');
        $dapvr_case_data['department'] = get_from_post('department_for_dapvr_case');
        $dapvr_case_data['court'] = get_from_post('court_for_dapvr_case');
        $dapvr_case_data['case_response_type'] = get_from_post('response_type_for_dapvr_case');
        $dapvr_case_data['case_type'] = get_from_post('case_type_for_dapvr_case');
        $dapvr_case_data['year'] = get_from_post('case_year_for_dapvr_case');
        $dapvr_case_data['brief_matter'] = get_from_post('matter_for_dapvr_case');
        $dapvr_case_data['register_date'] = get_from_post('register_date_for_dapvr_case');
        $dapvr_case_data['rojnamu'] = get_from_post('rojnamu_for_dapvr_case');
        $dapvr_case_data['case_status'] = get_from_post('case_status_for_dapvr_case');
        return $dapvr_case_data;
    }

    function _get_case_number(&$dapvr_case_data) {
        $dapvr_case_data['application_year'] = date('Y');
        $dapvr_case_data['temp_case_no'] = VALUE_ONE;
        $ex_case_num_data = $this->utility_model->get_by_id2('application_year', $dapvr_case_data['application_year'], 'dapvr_case', '', '', 'temp_case_no', 'DESC');
        if (!empty($ex_case_num_data)) {
            $dapvr_case_data['temp_case_no'] = ($ex_case_num_data['temp_case_no'] + 1);
        }
        $dapvr_case_data['case_no'] = get_case_number($dapvr_case_data['temp_case_no']) . '/' . $dapvr_case_data['application_year'];
    }

    function submit_dapvr_case() {
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
            $case_id = get_from_post('case_id_for_dapvr_case');
            $dapvr_case_data = $this->_get_post_data_for_dapvr_case();
            $validation_message = $this->_check_validation_for_dapvr_case($dapvr_case_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $land_details = $this->input->post('land_details');
            if ((empty($land_details))) {
                echo json_encode(get_error_array(ONE_LAND_MESSAGE));
                return false;
            }
            $dapvr_case_data['land_details'] = json_encode($land_details);

            $petitioner_info = $this->input->post('petitioner_info');
            if (empty($petitioner_info)) {
                echo json_encode(get_error_array(ONE_PETITIONER_MESSAGE));
                return false;
            }
            $dapvr_case_data['petitioner_details'] = json_encode($petitioner_info);

            $respondent_info = $this->input->post('respondent_info');
            if (empty($respondent_info)) {
                echo json_encode(get_error_array(ONE_RESPONDENT_MESSAGE));
                return false;
            }
            $dapvr_case_data['respondent_details'] = json_encode($respondent_info);

            $this->db->trans_start();
            $dapvr_case_data['register_date'] = convert_to_mysql_date_format($dapvr_case_data['register_date']);
            if (!$case_id || $case_id == NULL) {
                $dapvr_case_data['user_id'] = $user_id;
                $dapvr_case_data['talathi'] = $user_id;
                $dapvr_case_data['created_by'] = $user_id;
                $dapvr_case_data['created_time'] = date('Y-m-d H:i:s');
                $dapvr_case_data['status'] = VALUE_ONE;
                $case_year = get_from_post('case_year_for_dapvr_case');
//            echo $case_year;
//            exit;
                if ($case_year == '42' || $case_year == '43' || $case_year == '44' || $case_year == '45') {
                    $this->_get_case_number($dapvr_case_data);
                } else {
                    $dapvr_case_data['case_no'] = get_from_post('case_no_for_dapvr_case');
                }
                $case_id = $this->utility_model->insert_data('dapvr_case', $dapvr_case_data);
            } else {
                $dapvr_case_data['updated_by'] = $user_id;
                $dapvr_case_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('case_id', $case_id, 'dapvr_case', $dapvr_case_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _check_validation_for_dapvr_case($dapvr_case_data) {
        if (!$dapvr_case_data['district']) {
            return SELECT_DISTRICT_MESSAGE;
        }
        if (!$dapvr_case_data['case_response_type']) {
            return SELECT_CASE_RESPONSE_TYPE;
        }
        if (!$dapvr_case_data['case_type']) {
            return SELECT_CASE_TYPE;
        }
        if (!$dapvr_case_data['year']) {
            return SELECT_CASE_YEAR;
        }
        if (!$dapvr_case_data['brief_matter']) {
            return BRIEF_MATTER_MESSAGE;
        }
        if (!$dapvr_case_data['rojnamu']) {
            return ROJNAMU_MESSAGE;
        }
        if (!$dapvr_case_data['case_status']) {
            return CASE_STATUS;
        }
        return '';
    }

    function get_hearing_data_by_case_id() {
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
            $case_id = get_from_post('case_id');
            if (!$case_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $hearing_data = $this->utility_model->get_appointment_data_by_id('case_id', $case_id, 'dapvr_case');

            $success_array = get_success_array();
            $success_array['hearing_data'] = $hearing_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_set_hearing_date() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $case_id = get_from_post('case_id_for_dapvr_case_set_hearing_date');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$case_id || $case_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $hearing_data = array();
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('case_id', $case_id, 'dapvr_case');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $hearing_details = $this->input->post('hearing_details');
            $hearing_date = get_from_post('hearing_date_for_dapvr_case');
            $next_hearing = get_from_post('next_hearing');

            if ($ex_data['previous_hearing_date'] == '') {
                $hearing_data['previous_hearing_date'] = json_encode($hearing_details);
            } else {
                $hearing_data['previous_hearing_date'] = json_encode(array_merge(json_decode($ex_data['previous_hearing_date'], true), json_decode(json_encode($hearing_details), true)));
            }
            $hearing_data['next_hearing_date'] = convert_to_mysql_date_format($hearing_date);
            $hearing_data['hearing_time'] = get_from_post('hearing_time_for_dapvr_case');
            $hearing_data['hearing_remarks'] = get_from_post('hearing_remarks_for_dapvr_case');
            $hearing_data['updated_by'] = $session_user_id;
            $hearing_data['updated_time'] = date('Y-m-d H:i:s');
            $hearing_data['status'] = VALUE_THREE;
            $hearing_data['next_hearing'] = get_from_post('next_hearing');
            $this->utility_model->update_data('case_id', $case_id, 'dapvr_case', $hearing_data);
            $dapvr_case_data = $this->dapvr_case_model->get_dapvr_case_data($case_id, '');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = HEARING_DATE_SET_MESSAGE;
            $success_array['dapvr_case_data'] = $dapvr_case_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_judgement() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $case_id = get_from_post('case_id_for_dapvr_case_judgement');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$case_id || $case_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $hearing_data = array();
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('case_id', $case_id, 'dapvr_case');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $hearing_data['updated_by'] = $session_user_id;
            $hearing_data['updated_time'] = date('Y-m-d H:i:s');
            $hearing_data['status'] = VALUE_FOUR;
            $hearing_data['judgement'] = get_from_post('judgement_remarks_for_dapvr_case');
            $this->utility_model->update_data('case_id', $case_id, 'dapvr_case', $hearing_data);
            $dapvr_case_data = $this->dapvr_case_model->get_dapvr_case_data($case_id, '');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = JUDGEMENT_SAVE_SUCCESSFULLY;
            $success_array['dapvr_case_data'] = $dapvr_case_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_order() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $case_id = get_from_post('case_id_for_dapvr_case_order');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$case_id || $case_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $order_data = array();
            if ($_FILES['upload_order_for_dc']['name'] != '') {
                $main_path = 'documents/dapvr_case_order';
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'dapvr_case_order';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['upload_order_for_dc']['name']);
                $filename = 'case_order_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $main_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['upload_order_for_dc']['tmp_name'], $final_path)) {
                    echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $order_data['order_doc'] = $filename;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('case_id', $case_id, 'dapvr_case');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $order_data['updated_by'] = $session_user_id;
            $order_data['updated_time'] = date('Y-m-d H:i:s');
            $order_data['status'] = VALUE_FIVE;
            $this->utility_model->update_data('case_id', $case_id, 'dapvr_case', $order_data);
            $dapvr_case_data = $this->dapvr_case_model->get_dapvr_case_data($case_id, '');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = ORDER_UPLOADED_SUCCESSFULLY;
            $success_array['dapvr_case_data'] = $dapvr_case_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_update_basic_detail_data_by_case_id() {
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
            $case_id = get_from_post('case_id');
            if (!$case_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $basic_details = $this->dapvr_case_model->get_basic_data_for_dc($case_id);
            if (empty($basic_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mamlatdar_data = array();
            if (is_talathi_user() && $basic_details['talathi_to_mamlatdar'] == VALUE_ZERO) {
                $mamlatdar_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_MAMLATDAR_USER);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['update_basic_detail_data'] = $basic_details;
            $success_array['mamlatdar_data'] = $mamlatdar_data;
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
            $case_id = get_from_post('case_id_for_dapvr_case_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$case_id || $case_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            if (is_admin() || is_talathi_user()) {

                $talathi_remarks = get_from_post('talathi_remarks_for_dapvr_case');
                if (!$talathi_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $talathi_to_mam = get_from_post('talathi_to_mamlatdar_for_dapvr_case');
                if (!$talathi_to_mam) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            $this->db->trans_start();
            $temp_talathi_data = array();
            $basic_detail_data = array();
            if (is_admin() || is_talathi_user()) {
                $temp_talathi_data = $this->utility_model->get_by_id('sa_user_id', $session_user_id, 'sa_users');
                $basic_detail_data['talathi'] = $session_user_id;
                $basic_detail_data['talathi_remarks'] = $talathi_remarks;
                $basic_detail_data['talathi_to_mamlatdar'] = $talathi_to_mam;
                $basic_detail_data['talathi_to_mamlatdar_datetime'] = date('Y-m-d H:i:s');
            }
            $basic_detail_data['updated_by'] = $session_user_id;
            $basic_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $basic_detail_data['status'] = VALUE_TWO;
            $this->utility_model->update_data('case_id', $case_id, 'dapvr_case', $basic_detail_data);
            $dc_data = $this->dapvr_case_model->get_basic_data_for_dc($case_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APP_FORWARDED_MESSSAGE;
            $success_array['case_id'] = $case_id;
            $success_array['dapvr_case_data'] = $dc_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_dashboard_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = get_success_array();
            $success_array['total_cases'] = 0;
            $success_array['pending_cases'] = 0;
            $success_array['close_cases'] = 0;
            $success_array['today_hearing_cases'] = 0;
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $this->db->trans_start();
            $dapvr_status_wise_data = $this->utility_model->get_dapvr_dashboard_data();
            if (!empty($dapvr_status_wise_data)) {
                foreach ($dapvr_status_wise_data as $dapvr) {
                    if ($dapvr['status'] == VALUE_FOUR) {
                        $success_array['close_cases'] += $dapvr['total_cases'];
                    }
                    if ($dapvr['status'] == VALUE_ZERO || $dapvr['status'] == VALUE_ONE ||
                            $dapvr['status'] == VALUE_TWO || $dapvr['status'] == VALUE_THREE) {
                        $success_array['pending_cases'] += $dapvr['total_cases'];
                    }
                    if ($dapvr['next_hearing_date'] == date('Y-m-d')) {
                        $success_array['today_hearing_cases'] += $dapvr['total_cases'];
                    }
                    $success_array['total_cases'] += $dapvr['total_cases'];
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
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
            $this->db->trans_start();
            $excel_data = $this->dapvr_case_model->get_records_for_excel();
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $elist = array();
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Dapvr_Case_Report_' . date('Y-m-d H:i:s') . '.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('Case No', 'Register Date', 'Case Type', 'Case Year', 'Name of Petitioner',
                'Name of Respondent', 'Hearing Date', 'Case Status'));
            if (!empty($excel_data)) {
                $case_type_array = $this->config->item('case_type_array');
                $case_year_array = $this->config->item('case_year_array');
                $case_status_array = $this->config->item('case_status2_array');
                foreach ($excel_data as $list) {
                    $elist['case_no'] = get_text_formatted($list['case_no']);
                    $elist['register_date'] = $list['register_date'];
                    $elist['case_type'] = isset($case_type_array[$list['case_type']]) ? $case_type_array[$list['case_type']] : '';
                    $elist['year'] = isset($case_year_array[$list['year']]) ? $case_year_array[$list['year']] : '';
                    $petitioner_details_json = json_decode($list['petitioner_details']);
                    $elist['petitioner_details'] = '';
                    foreach ($petitioner_details_json as $index => $petd) {
                        $elist['petitioner_details'] .= ($index != 0 ? ',' : '') . $petd->pet_name;
                    }
                    $respondent_details_json = json_decode($list['respondent_details']);
                    $elist['respondent_details'] = '';
                    foreach ($respondent_details_json as $index => $resd) {
                        $elist['respondent_details'] .= ($index != 0 ? ',' : '') . $resd->res_name;
                    }
                    $elist['next_hearing_date'] = $list['next_hearing_date'];
                    $elist['case_status'] = isset($case_status_array[$list['case_status']]) ? $case_status_array[$list['case_status']] : '';
                    fputcsv($output, $elist);
                }
            }
            fclose($output);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function submit_advocate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
//        $case_id = get_from_post('case_id_for_dapvr_case_judgement');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $advocate_data = array();
            $this->db->trans_start();
//        $ex_data = $this->utility_model->get_by_id('case_id', $case_id, 'dapvr_case');
//        if (empty($ex_data)) {
//            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
//            return false;
//        }
            $advocate_data['user_id'] = $session_user_id;
            $advocate_data['created_by'] = $session_user_id;
            $advocate_data['created_time'] = date('Y-m-d H:i:s');
            $advocate_data['advocate_name'] = get_from_post('advocate_name_for_dapvr_case');
            $advocate_data['advocate_mobile_number'] = get_from_post('advocate_mobile_number_for_dapvr_case');
            $advocate_data['advocate_email'] = get_from_post('advocate_email_for_dapvr_case');
            $advocate_data['advocate_detail_id'] = $this->utility_model->insert_data('advocate_detail', $advocate_data);
            //$dapvr_case_data = $this->dapvr_case_model->get_dapvr_case_data($case_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = ADVOCATE_SAVE_SUCCESSFULLY;
            //$success_array['dapvr_case_data'] = $dapvr_case_data;
            $success_array['advocate_data'] = $advocate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_advocate_list_for_dapvr_case() {
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
            $success_array = get_success_array();
            $success_array['advocate_list_data'] = array();
            $this->load->model('utility_model');
            $this->db->trans_start();
            $success_array['advocate_list_data'] = $this->dapvr_case_model->get_advocate_list_for_dapvr_case(TRUE);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}
