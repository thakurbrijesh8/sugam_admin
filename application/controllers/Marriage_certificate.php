<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marriage_certificate extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('marriage_certificate_model');
    }

    function get_marriage_certificate_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['marriage_certificate_data'] = array();
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
            $success_array['marriage_certificate_data'] = $this->marriage_certificate_model->get_all_marriage_certificate_list($start, $length, $s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status);
            $success_array['recordsTotal'] = $this->marriage_certificate_model->get_total_count_of_records($s_district);
            if (($s_district != '' && is_admin()) || $s_app_no != '' || $s_app_det != '' || $s_app_status != '' || $s_qstatus != '' || $s_status != '') {
                $success_array['recordsFiltered'] = $this->marriage_certificate_model->get_filter_count_of_records($s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['marriage_certificate_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['marriage_certificate_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_marriage_certificate_data_by_id() {
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
            $marriage_certificate_id = get_from_post('marriage_certificate_id');
            if (!$marriage_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $marriage_certificate_data = $this->utility_model->get_by_id('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate');
            if (empty($marriage_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['marriage_certificate_data'] = $marriage_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_marriage_certificate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            $marriage_certificate_id = get_from_post('marriage_certificate_id_for_marriage_certificate');
            if (!is_post() || $user_id == NULL || !$user_id || $marriage_certificate_id == NULL || !$marriage_certificate_id ||
                    ($module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $mc_data = $this->_get_post_data_for_marriage_certificate();
            $validation_message = $this->_check_validation_for_marriage_certificate($module_type, $mc_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            if ($module_type == VALUE_FIVE) {
                $ex_mc_data = $this->utility_model->get_by_id('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate', 'user_id', $session_user_id);
                if (empty($ex_mc_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                if ($ex_mc_data['status'] == VALUE_FIVE || $ex_mc_data['status'] == VALUE_SIX) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                if ($ex_mc_data['query_status'] == VALUE_ONE) {
                    $qrremarks = get_from_post('qr_remarks');
                    if (!$qrremarks) {
                        echo json_encode(get_error_array(REMARKS_MESSAGE));
                        return false;
                    }
                    $ex_query = $this->utility_model->get_by_id_multiple('module_type', VALUE_EIGHTEEN, 'query', 'module_id', $marriage_certificate_id, 'query_type', VALUE_TWO, 'status', VALUE_ZERO);
                    $iu_data = array();
                    $iu_data['remarks'] = $qrremarks;
                    $iu_data['status'] = VALUE_ONE;
                    $iu_data['query_by_name'] = get_from_session('name');
                    if (empty($ex_query)) {
                        $iu_data['module_type'] = VALUE_EIGHTEEN;
                        $iu_data['module_id'] = $marriage_certificate_id;
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
                    $mc_data['query_status'] = VALUE_TWO;
                }
            } else {
                $mc_data['status'] = $module_type;
                if ($module_type == VALUE_THREE) {
                    $mc_data['status'] = VALUE_TWO;
                    $mc_data['submitted_datetime'] = date('Y-m-d H:i:s');
                }
            }
            $this->db->trans_start();
            $mc_data['applicant_dob'] = convert_to_mysql_date_format($mc_data['applicant_dob']);
            $mc_data['bridegroom_dob'] = convert_to_mysql_date_format($mc_data['bridegroom_dob']);
            $mc_data['bride_dob'] = convert_to_mysql_date_format($mc_data['bride_dob']);

            $mc_data['updated_by'] = $user_id;
            $mc_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate', $mc_data);

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

    function _get_application_number(&$marriage_certificate_data) {
        $marriage_certificate_data['application_year'] = get_financial_year();
        $marriage_certificate_data['temp_application_number'] = VALUE_ONE;
        $ex_app_num_data = $this->utility_model->get_by_id('application_year', $marriage_certificate_data['application_year'], 'marriage_certificate', '', '', 'temp_application_number', 'DESC');
        if (!empty($ex_app_num_data)) {
            $marriage_certificate_data['temp_application_number'] = ($ex_app_num_data['temp_application_number'] + 1);
        }
        $marriage_certificate_data['application_number'] = 'MC/' . $marriage_certificate_data['application_year'] . '/' . get_application_number($marriage_certificate_data['temp_application_number']);
    }

    function _get_post_data_for_marriage_certificate() {
        $marriage_certificate_data = array();
        $marriage_certificate_data['district'] = get_from_post('district_for_marriage_certificate');

        $marriage_certificate_data['applicant_name'] = get_from_post('applicant_name_for_marriage_certificate');
        $marriage_certificate_data['mobile_number'] = get_from_post('mobile_number_for_marriage_certificate');
        $marriage_certificate_data['communication_address'] = get_from_post('communication_address_for_marriage_certificate');
        $marriage_certificate_data['permanent_address'] = get_from_post('permanent_address_for_marriage_certificate');
        $marriage_certificate_data['applicant_email'] = get_from_post('email_for_marriage_certificate');
        $marriage_certificate_data['applicant_dob'] = get_from_post('applicant_dob_for_marriage_certificate');
        $marriage_certificate_data['applicant_age'] = get_from_post('applicant_age_for_marriage_certificate');

        $marriage_certificate_data['bridegroom_name'] = get_from_post('bridegroom_name_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_birthplace_state'] = get_from_post('bridegroom_birthplace_state_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_birthplace_state_text'] = get_from_post('bridegroom_birthplace_state_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_birthplace_district'] = get_from_post('bridegroom_birthplace_district_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_birthplace_district_text'] = get_from_post('bridegroom_birthplace_district_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_birthplace_village'] = get_from_post('bridegroom_birthplace_village_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_birthplace_village_text'] = get_from_post('bridegroom_birthplace_village_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_residence'] = get_from_post('bridegroom_residence_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_residence_state'] = get_from_post('bridegroom_residence_state_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_residence_state_text'] = get_from_post('bridegroom_residence_state_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_residence_district'] = get_from_post('bridegroom_residence_district_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_residence_district_text'] = get_from_post('bridegroom_residence_district_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_occupation'] = get_from_post('bridegroom_occupation_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_other_occupation'] = get_from_post('bridegroom_other_occupation_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_dob'] = get_from_post('bridegroom_dob_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_age'] = get_from_post('bridegroom_age_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_marital_status'] = 'Unmarried';

        $marriage_certificate_data['bridegroom_father_name'] = get_from_post('bridegroom_father_name_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_birthplace_state'] = get_from_post('bridegroom_father_birthplace_state_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_birthplace_state_text'] = get_from_post('bridegroom_father_birthplace_state_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_birthplace_district'] = get_from_post('bridegroom_father_birthplace_district_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_birthplace_district_text'] = get_from_post('bridegroom_father_birthplace_district_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_birthplace_village'] = get_from_post('bridegroom_father_birthplace_village_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_birthplace_village_text'] = get_from_post('bridegroom_father_birthplace_village_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_residence'] = get_from_post('bridegroom_father_residence_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_residence_state'] = get_from_post('bridegroom_father_residence_state_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_residence_state_text'] = get_from_post('bridegroom_father_residence_state_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_residence_district'] = get_from_post('bridegroom_father_residence_district_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_residence_district_text'] = get_from_post('bridegroom_father_residence_district_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_occupation'] = get_from_post('bridegroom_father_occupation_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_father_other_occupation'] = get_from_post('bridegroom_father_other_occupation_for_marriage_certificate');

        $marriage_certificate_data['bridegroom_mother_name'] = get_from_post('bridegroom_mother_name_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_birthplace_state'] = get_from_post('bridegroom_mother_birthplace_state_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_birthplace_state_text'] = get_from_post('bridegroom_mother_birthplace_state_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_birthplace_district'] = get_from_post('bridegroom_mother_birthplace_district_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_birthplace_district_text'] = get_from_post('bridegroom_mother_birthplace_district_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_birthplace_village'] = get_from_post('bridegroom_mother_birthplace_village_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_birthplace_village_text'] = get_from_post('bridegroom_mother_birthplace_village_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_residence'] = get_from_post('bridegroom_mother_residence_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_residence_state'] = get_from_post('bridegroom_mother_residence_state_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_residence_state_text'] = get_from_post('bridegroom_mother_residence_state_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_residence_district'] = get_from_post('bridegroom_mother_residence_district_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_residence_district_text'] = get_from_post('bridegroom_mother_residence_district_text_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_occupation'] = get_from_post('bridegroom_mother_occupation_for_marriage_certificate');
        $marriage_certificate_data['bridegroom_mother_other_occupation'] = get_from_post('bridegroom_mother_other_occupation_for_marriage_certificate');

        $marriage_certificate_data['bride_name'] = get_from_post('bride_name_for_marriage_certificate');
        $marriage_certificate_data['bride_birthplace_state'] = get_from_post('bride_birthplace_state_for_marriage_certificate');
        $marriage_certificate_data['bride_birthplace_state_text'] = get_from_post('bride_birthplace_state_text_for_marriage_certificate');
        $marriage_certificate_data['bride_birthplace_district'] = get_from_post('bride_birthplace_district_for_marriage_certificate');
        $marriage_certificate_data['bride_birthplace_district_text'] = get_from_post('bride_birthplace_district_text_for_marriage_certificate');
        $marriage_certificate_data['bride_birthplace_village'] = get_from_post('bride_birthplace_village_for_marriage_certificate');
        $marriage_certificate_data['bride_birthplace_village_text'] = get_from_post('bride_birthplace_village_text_for_marriage_certificate');
        $marriage_certificate_data['bride_residence'] = get_from_post('bride_residence_for_marriage_certificate');
        $marriage_certificate_data['bride_residence_state'] = get_from_post('bride_residence_state_for_marriage_certificate');
        $marriage_certificate_data['bride_residence_state_text'] = get_from_post('bride_residence_state_text_for_marriage_certificate');
        $marriage_certificate_data['bride_residence_district'] = get_from_post('bride_residence_district_for_marriage_certificate');
        $marriage_certificate_data['bride_residence_district_text'] = get_from_post('bride_residence_district_text_for_marriage_certificate');
        $marriage_certificate_data['bride_occupation'] = get_from_post('bride_occupation_for_marriage_certificate');
        $marriage_certificate_data['bride_other_occupation'] = get_from_post('bride_other_occupation_for_marriage_certificate');
        $marriage_certificate_data['bride_dob'] = get_from_post('bride_dob_for_marriage_certificate');
        $marriage_certificate_data['bride_age'] = get_from_post('bride_age_for_marriage_certificate');
        $marriage_certificate_data['bride_marital_status'] = 'Unmarried';

        $marriage_certificate_data['bride_father_name'] = get_from_post('bride_father_name_for_marriage_certificate');
        $marriage_certificate_data['bride_father_birthplace_state'] = get_from_post('bride_father_birthplace_state_for_marriage_certificate');
        $marriage_certificate_data['bride_father_birthplace_state_text'] = get_from_post('bride_father_birthplace_state_text_for_marriage_certificate');
        $marriage_certificate_data['bride_father_birthplace_district'] = get_from_post('bride_father_birthplace_district_for_marriage_certificate');
        $marriage_certificate_data['bride_father_birthplace_district_text'] = get_from_post('bride_father_birthplace_district_text_for_marriage_certificate');
        $marriage_certificate_data['bride_father_birthplace_village'] = get_from_post('bride_father_birthplace_village_for_marriage_certificate');
        $marriage_certificate_data['bride_father_birthplace_village_text'] = get_from_post('bride_father_birthplace_village_text_for_marriage_certificate');
        $marriage_certificate_data['bride_father_residence'] = get_from_post('bride_father_residence_for_marriage_certificate');
        $marriage_certificate_data['bride_father_residence_state'] = get_from_post('bride_father_residence_state_for_marriage_certificate');
        $marriage_certificate_data['bride_father_residence_state_text'] = get_from_post('bride_father_residence_state_text_for_marriage_certificate');
        $marriage_certificate_data['bride_father_residence_district'] = get_from_post('bride_father_residence_district_for_marriage_certificate');
        $marriage_certificate_data['bride_father_residence_district_text'] = get_from_post('bride_father_residence_district_text_for_marriage_certificate');
        $marriage_certificate_data['bride_father_occupation'] = get_from_post('bride_father_occupation_for_marriage_certificate');
        $marriage_certificate_data['bride_father_other_occupation'] = get_from_post('bride_father_other_occupation_for_marriage_certificate');

        $marriage_certificate_data['bride_mother_name'] = get_from_post('bride_mother_name_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_birthplace_state'] = get_from_post('bride_mother_birthplace_state_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_birthplace_state_text'] = get_from_post('bride_mother_birthplace_state_text_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_birthplace_district'] = get_from_post('bride_mother_birthplace_district_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_birthplace_district_text'] = get_from_post('bride_mother_birthplace_district_text_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_birthplace_village'] = get_from_post('bride_mother_birthplace_village_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_birthplace_village_text'] = get_from_post('bride_mother_birthplace_village_text_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_residence'] = get_from_post('bride_mother_residence_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_residence_state'] = get_from_post('bride_mother_residence_state_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_residence_state_text'] = get_from_post('bride_mother_residence_state_text_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_residence_district'] = get_from_post('bride_mother_residence_district_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_residence_district_text'] = get_from_post('bride_mother_residence_district_text_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_occupation'] = get_from_post('bride_mother_occupation_for_marriage_certificate');
        $marriage_certificate_data['bride_mother_other_occupation'] = get_from_post('bride_mother_other_occupation_for_marriage_certificate');
        $marriage_certificate_data['authorized_person_name'] = AUTHORIZED_PERSON_NAME;

        return $marriage_certificate_data;
    }

    function _check_validation_for_marriage_certificate($module_type, $marriage_certificate_data) {
        if (!$marriage_certificate_data['district']) {
            return SELECT_DISTRICT;
        }
        if (!$marriage_certificate_data['applicant_name']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$marriage_certificate_data['mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$marriage_certificate_data['communication_address']) {
            return COMMUNICATION_ADDRESS_MESSAGE;
        }
        if (!$marriage_certificate_data['permanent_address']) {
            return COMMUNICATION_ADDRESS_MESSAGE;
        }
        if (!$marriage_certificate_data['applicant_dob']) {
            return BIRTH_DATE_MESSAGE;
        }
        if (!$marriage_certificate_data['applicant_age']) {
            return AGE_MESSAGE;
        }
        if ($module_type == VALUE_ONE) {
            return '';
        }
        if (!$marriage_certificate_data['bridegroom_name']) {
            return NAME_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_birthplace_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_birthplace_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_birthplace_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_residence']) {
            return RESIDENCE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_residence_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_residence_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_dob']) {
            return BIRTH_DATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_age']) {
            return AGE_MESSAGE;
        }
        if ($marriage_certificate_data['bridegroom_occupation'] == VALUE_TWELVE) {
            if (!$marriage_certificate_data['bridegroom_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }


        if (!$marriage_certificate_data['bridegroom_father_name']) {
            return NAME_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_father_birthplace_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_father_birthplace_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_father_birthplace_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_father_residence']) {
            return RESIDENCE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_father_residence_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_father_residence_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_father_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if ($marriage_certificate_data['bridegroom_father_occupation'] == VALUE_TWELVE) {
            if (!$marriage_certificate_data['bridegroom_father_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }

        if (!$marriage_certificate_data['bridegroom_mother_name']) {
            return NAME_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_mother_birthplace_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_mother_birthplace_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_mother_birthplace_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_mother_residence']) {
            return RESIDENCE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_mother_residence_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_mother_residence_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bridegroom_mother_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if ($marriage_certificate_data['bridegroom_mother_occupation'] == VALUE_TWELVE) {
            if (!$marriage_certificate_data['bridegroom_mother_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }

        if (!$marriage_certificate_data['bride_name']) {
            return NAME_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_birthplace_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_birthplace_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_birthplace_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_residence']) {
            return RESIDENCE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_residence_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_residence_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_dob']) {
            return BIRTH_DATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_age']) {
            return AGE_MESSAGE;
        }
        if ($marriage_certificate_data['bride_occupation'] == VALUE_TWELVE) {
            if (!$marriage_certificate_data['bride_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }


        if (!$marriage_certificate_data['bride_father_name']) {
            return NAME_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_father_birthplace_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_father_birthplace_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_father_birthplace_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_father_residence']) {
            return RESIDENCE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_father_residence_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_father_residence_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_father_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if ($marriage_certificate_data['bride_father_occupation'] == VALUE_TWELVE) {
            if (!$marriage_certificate_data['bride_father_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }

        if (!$marriage_certificate_data['bride_mother_name']) {
            return NAME_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_mother_birthplace_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_mother_birthplace_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_mother_birthplace_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_mother_residence']) {
            return RESIDENCE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_mother_residence_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_mother_residence_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$marriage_certificate_data['bride_mother_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if ($marriage_certificate_data['bride_mother_occupation'] == VALUE_TWELVE) {
            if (!$marriage_certificate_data['bride_mother_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }

        return '';
    }

    function get_village_data_for_marriage_certificate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $state_code = get_from_post('state_code');
            if (!$state_code && $state_code != 0) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $district_code = get_from_post('district_code');
            if (!$district_code && $district_code != 0) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $village_data = $this->utility_model->get_result_by_id('state_code', $state_code, 'all_villages', 'district_code', $district_code, NULL, NULL, 'village_name');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = array();
            $success_array['success'] = true;
            $success_array['village_data'] = $village_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

    function download_mc_declaration() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $marriage_certificate_id = get_from_post('marriage_certificate_id_for_mc_declaration');
            if ($user_id == null || !$user_id || $marriage_certificate_id == null || !$marriage_certificate_id) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $mc_data = $this->utility_model->get_by_id('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate');
            if (empty($mc_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            error_reporting(E_ERROR);
            $data = array('marriage_application_data' => $mc_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view("marriage_certificate/declaration", $data, TRUE));
            $mpdf->Output('Declaration_' . $mc_data['application_number'] . '_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            $this->load->view('error', array('error_message' => $e->getMessage()));
            return;
        }
    }

    function submit_declaration() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $marriage_certificate_id = get_from_post('marriage_certificate_id_for_marriage_certificate_declaration');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$marriage_certificate_id || $marriage_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['marriage_no'] = get_from_post('marriage_no_for_marriage_certificate_declaration');
            if (!$update_data['marriage_no']) {
                echo json_encode(get_error_array(MARRIAGE_NO_MESSAGE));
                return false;
            }
            $update_data['residence_of'] = get_from_post('residence_of_for_marriage_certificate_declaration');
            if (!$update_data['residence_of']) {
                echo json_encode(get_error_array(RESIDENCE_OF_MESSAGE));
                return false;
            }
            $update_data['declaration_date'] = get_from_post('declaration_date_for_marriage_certificate_declaration');
            if (!$update_data['declaration_date']) {
                echo json_encode(get_error_array(DATE_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['declaration_date'] = convert_to_mysql_date_format($update_data['declaration_date']);
            $update_data['declaration_status'] = VALUE_ONE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate', $update_data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DECLARATION_SAVE_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_witness() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $marriage_certificate_id = get_from_post('marriage_certificate_id_for_marriage_certificate_witness');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$marriage_certificate_id || $marriage_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $witness_details = $this->input->post('witness_info');
            if (empty($witness_details)) {
                echo json_encode(get_error_array(ONE_WITNESS_MESSAGE));
                return false;
            }
            $witness_cnt = $this->input->post('rc');
            if ($witness_cnt < VALUE_THREE) {
                echo json_encode(get_error_array(TWO_WITNESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['witness_details'] = json_encode($witness_details);
            $update_data['witness_status'] = VALUE_ONE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate', $update_data);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = WITNESS_SAVE_MESSAGE;
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
            $marriage_certificate_id = get_from_post('marriage_certificate_id_for_marriage_certificate_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$marriage_certificate_id || $marriage_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['page_no'] = get_from_post('page_no_for_marriage_certificate_approve');
            if (!$update_data['page_no']) {
                echo json_encode(get_error_array(PAGE_NO_MESSAGE));
                return false;
            }
            $update_data['entry_number'] = get_from_post('entry_number_for_marriage_certificate_approve');
            if (!$update_data['entry_number']) {
                echo json_encode(get_error_array(ENTRY_NUMBER_MESSAGE));
                return false;
            }
            $update_data['registration_year'] = get_from_post('registration_year_for_marriage_certificate_approve');
            if (!$update_data['registration_year']) {
                echo json_encode(get_error_array(REGISTRATION_YEAR_MESSAGE));
                return false;
            }
            $update_data['remarks'] = get_from_post('remarks_for_marriage_certificate_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_EIGHTEEN, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate', $update_data);

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
            $marriage_certificate_id = get_from_post('marriage_certificate_id_for_marriage_certificate_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$marriage_certificate_id || $marriage_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_marriage_certificate_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_EIGHTEEN, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate', $update_data);

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

    function get_marriage_certificate_data_by_marriage_certificate_id() {
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
            $marriage_certificate_id = get_from_post('marriage_certificate_id');
            if (!$marriage_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $marriage_certificate_data = $this->marriage_certificate_model->get_basic_data_for_ic($marriage_certificate_id);
            if (empty($marriage_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['marriage_certificate_data'] = $marriage_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $marriage_certificate_id = get_from_post('marriage_certificate_id_for_certificate');
            $mtype = get_from_post('mtype_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $marriage_certificate_id == null || !$marriage_certificate_id ||
                    ($mtype != VALUE_ONE && $mtype != VALUE_TWO)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $existing_marriage_certificate_data = $this->utility_model->get_by_id('marriage_certificate_id', $marriage_certificate_id, 'marriage_certificate');
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($existing_marriage_certificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($mtype == VALUE_TWO) {
                if ($existing_marriage_certificate_data['status'] != VALUE_FIVE) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return;
                }
            }
            error_reporting(E_ERROR);
            $data = array('marriage_certificate_data' => $existing_marriage_certificate_data, 'mtype' => $mtype);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            if ($mtype == VALUE_ONE) {
                $mpdf->showWatermarkText = true;
            } else {
                $mpdf->showWatermarkImage = true;
            }
            $mpdf->WriteHTML($this->load->view('marriage_certificate/certificate', $data, TRUE));
            $mpdf->Output('marriage_certificate_' . time() . '.pdf', 'I');
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
            $s_app_no = get_from_post('app_no_for_mcge');
            $s_app_det = get_from_post('app_details_for_mcge');
            $s_app_status = get_from_post('app_status_for_mcge');
            $s_qstatus = get_from_post('qstatus_for_mcge');
            $s_status = get_from_post('status_for_mcge');
            $this->db->trans_start();
            $excel_data = $this->marriage_certificate_model->get_records_for_excel($s_district, $s_app_no, $s_app_det, $s_app_status, $s_qstatus, $s_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Marriage_certificate_Report_' . date('Y-m-d H:i:s') . '.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('Application Number', 'Submitted On', 'Applicant Name', 'Applicant Address', 'Mobile Number',
                'District', 'Bridegroom Name', 'Bridegroom Father Name', 'Bridegroom Mother Name', 'Bride Name', 'Bride Father Name', 'Bride Mother Name', 'Status', 'Query Status'));
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
}

/*
 * EOF: ./application/controller/Marriage_certificate.php
 */