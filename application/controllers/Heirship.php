<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Heirship extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('heirship_model');
    }

    function get_heirship_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['heirship_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;
            
            $search_appno = get_from_post('app_no_for_heirship_list');
            $search_appd = get_from_post('application_date_for_heirship_list');
            $search_appdet = filter_var(get_from_post('app_details_for_heirship_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_heirship_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_heirship_list');
            $search_cohand = get_from_post('currently_on_for_heirship_list');
            $search_appostatus = get_from_post('appointment_status_for_heirship_list');
            $search_qstatus = get_from_post('query_status_for_heirship_list');
            $search_status = get_from_post('status_for_heirship_list');

            $new_s_app_status = get_from_post('s_app_status');
            $search_appostatus = $new_s_app_status != '' ? $new_s_app_status : $search_appostatus;
            $new_search_appd = get_from_post('s_appd');
            $search_appd = $new_search_appd != '' ? $new_search_appd : $search_appd;
            $new_s_co_hand = get_from_post('s_co_hand');
            $search_cohand = $new_s_co_hand != '' ? $new_s_co_hand : $search_cohand;
            $new_qstatus = get_from_post('s_qstatus');
            $search_qstatus = $new_qstatus != '' ? $new_qstatus : $search_qstatus;
            $new_status = get_from_post('s_status');
            $search_status = $new_status != '' ? $new_status : $search_status;

            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['heirship_data'] = $this->heirship_model->get_all_heirship_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->heirship_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_appostatus != '' || $search_cohand != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->heirship_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['heirship_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['heirship_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_heirship_data_by_id() {
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
            $heirship_id = get_from_post('heirship_id');
            if (!$heirship_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $heirship_data = $this->utility_model->get_by_id('heirship_id', $heirship_id, 'heirship');
            if (empty($heirship_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['heirship_data'] = $heirship_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_heirship() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            $heirship_id = get_from_post('heirship_id_for_heirship');
            if (!is_post() || $user_id == NULL || !$user_id || $heirship_id == NULL || !$heirship_id ||
                    ($module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $heirship_data = $this->_get_post_data_for_heirship();
            $validation_message = $this->_check_validation_for_heirship($heirship_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $member_details = $this->input->post('family_member_info');
            if (empty($member_details)) {
                echo json_encode(get_error_array(ONE_LEGAL_HEIRS_MESSAGE));
                return false;
            }
            $heirship_data['legal_heirs_details'] = json_encode($member_details);

            $this->db->trans_start();
            $heirship_data['death_date'] = convert_to_mysql_date_format($heirship_data['death_date']);
            $heirship_data['applicant_dob'] = convert_to_mysql_date_format($heirship_data['applicant_dob']);
            $heirship_data['updated_by'] = $user_id;
            $heirship_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('heirship_id', $heirship_id, 'heirship', $heirship_data);
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

    function _get_post_data_for_heirship() {
        $heirship_data = array();
        if (is_admin()) {
            $heirship_data['district'] = get_from_post('district_for_heirship');
        }
        $heirship_data['village_name'] = get_from_post('village_name_for_heirship');
        $heirship_data['applicant_name'] = get_from_post('applicant_name_for_heirship');
        $heirship_data['applicant_father_name'] = get_from_post('father_name_for_heirship');
        $heirship_data['pre_house_no'] = get_from_post('pre_house_no_for_heirship');
        $heirship_data['pre_house_name'] = get_from_post('pre_house_name_for_heirship');
        $heirship_data['pre_street'] = get_from_post('pre_street_for_heirship');
        $heirship_data['pre_village'] = get_from_post('pre_village_for_heirship');
        $heirship_data['pre_city'] = get_from_post('pre_city_for_heirship');
        $heirship_data['pre_pincode'] = get_from_post('pre_pincode_for_heirship');
        $heirship_data['per_house_no'] = get_from_post('per_house_no_for_heirship');
        $heirship_data['per_house_name'] = get_from_post('per_house_name_for_heirship');
        $heirship_data['per_street'] = get_from_post('per_street_for_heirship');
        $heirship_data['per_village'] = get_from_post('per_village_for_heirship');
        $heirship_data['per_city'] = get_from_post('per_city_for_heirship');
        $heirship_data['per_pincode'] = get_from_post('per_pincode_for_heirship');
        $heirship_data['mobile_number'] = get_from_post('mobile_number_for_heirship');
        $heirship_data['email'] = get_from_post('email_for_heirship');
        $heirship_data['aadhar_number'] = get_from_post('aadhar_number_for_heirship');
        $heirship_data['election_number'] = get_from_post('election_number_for_heirship');
        $heirship_data['applicant_dob'] = get_from_post('applicant_dob_for_heirship');
        $heirship_data['applicant_age'] = get_from_post('applicant_age_for_heirship');
        $heirship_data['religion'] = get_from_post('applicant_religion_for_heirship');
        $heirship_data['gender'] = get_from_post('gender_for_heirship');
        $heirship_data['nationality'] = get_from_post('applicant_nationality_for_heirship');
        $heirship_data['marital_status'] = get_from_post('marital_status_for_heirship');
        $heirship_data['caste'] = get_from_post('caste_for_heirship');
        $heirship_data['occupation'] = get_from_post('applicant_occupation_for_heirship');
        if ($heirship_data['occupation'] == VALUE_TWELVE) {
            $heirship_data['occupation_other'] = get_from_post('applicant_occupation_other_for_heirship');
        } else {
            $heirship_data['occupation_other'] = '';
        }
        $heirship_data['relation_deceased_person'] = get_from_post('relation_deceased_person_for_heirship');
        $heirship_data['death_person_name'] = get_from_post('death_person_name_for_heirship');
        $heirship_data['relation_with_applicant'] = get_from_post('relation_with_applicant_for_heirship');
        $heirship_data['death_date'] = get_from_post('death_date_for_heirship');
        $heirship_data['death_place'] = get_from_post('death_place_for_heirship');
        $heirship_data['death_aadhar_number'] = get_from_post('death_aadhar_number_for_heirship');
        $heirship_data['death_marital_status'] = get_from_post('death_marital_status_for_heirship');
        $heirship_data['witness1_name'] = get_from_post('witness1_name_for_heirship');
        $heirship_data['witness1_age'] = get_from_post('witness1_age_for_heirship');
        $heirship_data['witness1_address'] = get_from_post('witness1_address_for_heirship');
        $heirship_data['witness1_occupation'] = get_from_post('witness1_occupation_for_heirship');
        if ($heirship_data['witness1_occupation'] == VALUE_TWELVE) {
            $heirship_data['witness1_occupation_other'] = get_from_post('witness1_occupation_other_for_heirship');
        } else {
            $heirship_data['witness1_occupation_other'] = '';
        }
        $heirship_data['witness2_name'] = get_from_post('witness2_name_for_heirship');
        $heirship_data['witness2_age'] = get_from_post('witness2_age_for_heirship');
        $heirship_data['witness2_address'] = get_from_post('witness2_address_for_heirship');
        $heirship_data['witness2_occupation'] = get_from_post('witness2_occupation_for_heirship');
        if ($heirship_data['witness2_occupation'] == VALUE_TWELVE) {
            $heirship_data['witness2_occupation_other'] = get_from_post('witness2_occupation_other_for_heirship');
        } else {
            $heirship_data['witness2_occupation_other'] = '';
        }
        $heirship_data['final_remarks'] = get_from_post('final_remarks_for_heirship');
        return $heirship_data;
    }

    function _check_validation_for_heirship($heirship_data) {
        if (is_admin()) {
            if (!$heirship_data['district']) {
                return SELECT_DISTRICT_MESSAGE;
            }
        }
        if (!$heirship_data['village_name']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$heirship_data['pre_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$heirship_data['pre_street']) {
            return STREET_MESSAGE;
        }
        if (!$heirship_data['pre_village']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$heirship_data['pre_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$heirship_data['pre_pincode']) {
            return PINCODE_MESSAGE;
        }
        if (!$heirship_data['per_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$heirship_data['per_street']) {
            return STREET_MESSAGE;
        }
        if (!$heirship_data['per_village']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$heirship_data['per_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$heirship_data['per_pincode']) {
            return PINCODE_MESSAGE;
        }
        if (!$heirship_data['mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$heirship_data['applicant_dob']) {
            return BIRTH_DATE_MESSAGE;
        }
        if (!$heirship_data['religion']) {
            return RELIGION_MESSAGE;
        }
        if (!$heirship_data['nationality']) {
            return APPLICANT_NATIONALITY_MESSAGE;
        }
        if (!$heirship_data['caste']) {
            return CASTE_MESSAGE;
        }
        if (!$heirship_data['occupation']) {
            return APPLICANT_OCCUPATION_MESSAGE;
        }
        if ($heirship_data['occupation'] == VALUE_TWELVE) {
            if (!$heirship_data['occupation_other']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }
        if (!$heirship_data['relation_deceased_person']) {
            return RELATION_WITH_DECEASED_PERSON_MESSAGE;
        }
        if (!$heirship_data['death_person_name']) {
            return DEATH_PERSON_NAME_MESSAGE;
        }
        if (!$heirship_data['relation_with_applicant']) {
            return APPLICANT_RELATION_MESSAGE;
        }
        if (!$heirship_data['death_date']) {
            return DATE_MESSAGE;
        }
        if (!$heirship_data['death_place']) {
            return DEATH_PLACE_MESSAGE;
        }
        if (!$heirship_data['witness1_name']) {
            return WITNESS_NAME_MESSAGE;
        }
        if (!$heirship_data['witness1_age']) {
            return WITNESS_AGE_MESSAGE;
        }
        if ($heirship_data['witness1_age'] < VALUE_THIRTYFIVE) {
            return WITNESS_AGE_LIMIT_MESSAGE;
        }
        if (!$heirship_data['witness1_address']) {
            return WITNESS_ADDRESS_MESSAGE;
        }
        if (!$heirship_data['witness1_occupation']) {
            return APPLICANT_OCCUPATION_MESSAGE;
        }
        if ($heirship_data['witness1_occupation'] == VALUE_TWELVE) {
            if (!$heirship_data['witness1_occupation_other']) {
                return APPLICANT_OCCUPATION_OTHER_MESSAGE;
            }
        }
        if (!$heirship_data['witness2_name']) {
            return WITNESS_NAME_MESSAGE;
        }
        if (!$heirship_data['witness2_age']) {
            return WITNESS_AGE_MESSAGE;
        }
        if ($heirship_data['witness2_age'] < VALUE_THIRTYFIVE) {
            return WITNESS_AGE_LIMIT_MESSAGE;
        }
        if (!$heirship_data['witness2_address']) {
            return WITNESS_ADDRESS_MESSAGE;
        }
        if (!$heirship_data['witness2_occupation']) {
            return APPLICANT_OCCUPATION_MESSAGE;
        }
        if ($heirship_data['witness2_occupation'] == VALUE_TWELVE) {
            if (!$heirship_data['witness2_occupation_other']) {
                return APPLICANT_OCCUPATION_OTHER_MESSAGE;
            }
        }
//        if (!$heirship_data['gender']) {
//            return GENDER_MESSAGE;
//        }
//        if (!$heirship_data['death_marital_status']) {
//            return MARRITIAL_STATUS_MESSAGE;
//        }
//        if (!$heirship_data['marital_status']) {
//            return MARRITIAL_STATUS_MESSAGE;
//        }
//        if (!$heirship_data['applicant_occupation']) {
//            return APPLICANT_OCCUPATION_MESSAGE;
//        }
        // if (!$heirship_data['earning_members_in_family']) {
        //     return FAMILY_MEMBER_MESSAGE;
        // }
//        if (!$heirship_data['purpose_of_heirship']) {
//            return PURPOSE_OF_INCOMECERTY_MESSAGE;
//        }
        // if (!$heirship_data['declaration_date']) {
        //     return DATE_MESSAGE;
        // }
        return '';
    }

    function reverify_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $heirship_id = get_from_post('heirship_id_for_heirship_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$heirship_id || $heirship_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if (!is_mamlatdar_user() && !is_talathi_user() && !is_aci_user()) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            if (is_mamlatdar_user()) {
                $update_data['to_type_reverify'] = get_from_post('to_type_reverify_for_heirship');
                if (!$update_data['to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['mam_reverify_remarks'] = get_from_post('mam_reverify_remarks_for_heirship');
                if (!$update_data['mam_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['mam_to_reverify_datetime'] = date('Y-m-d H:i:s');
                $update_data['status'] = VALUE_THREE;
            }
            if (is_talathi_user()) {
                $update_data['talathi_to_type_reverify'] = get_from_post('talathi_to_type_reverify_for_heirship');
                if (!$update_data['talathi_to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }

                $update_data['is_upload_reverification_doc'] = get_from_post('upload_reverification_document_for_heirship');
                if (!$update_data['is_upload_reverification_doc']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                if ($update_data['is_upload_reverification_doc'] == VALUE_ONE) {
                    $new_field_doc_items = $this->input->post('new_field_doc_items');
                    $exi_field_doc_items = $this->input->post('exi_field_doc_items');
                    if (empty($new_field_doc_items) && empty($exi_field_doc_items)) {
                        echo json_encode(get_error_array(ONE_FIELD_DOC_MESSAGE));
                        return false;
                    }
                    $this->_update_field_doc_items($session_user_id, $heirship_id, $exi_field_doc_items, $new_field_doc_items);
                }

                $update_data['talathi_reverify_remarks'] = get_from_post('talathi_reverify_remarks_for_heirship');
                if (!$update_data['talathi_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['talathi_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_aci_user()) {
                $update_data['aci_rec_reverify'] = get_from_post('aci_rec_reverify_for_heirship');
                if (!$update_data['aci_rec_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['aci_reverify_remarks'] = get_from_post('aci_reverify_remarks_for_heirship');
                if (!$update_data['aci_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($update_data['aci_rec_reverify'] == VALUE_ONE) {
                    $update_data['aci_to_ldc'] = get_from_post('aci_to_ldc_reverify_for_heirship');
                    if (!$update_data['aci_to_ldc']) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                    $update_data['aci_to_ldc_datetime'] = date('Y-m-d H:i:s');
                }
                $update_data['aci_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_admin() || is_ldc_user()) {
                $ldc_applicant_name = get_from_post('ldc_applicant_name_for_heirship');
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
                $ldc_to_mamlatdar_remarks = get_from_post('ldc_to_mamlatdar_remarks_for_heirship');
                if (!$ldc_to_mamlatdar_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar = get_from_post('ldc_to_mamlatdar_for_heirship');
                if (!$ldc_to_mamlatdar) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('heirship_id', $heirship_id, 'heirship');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('heirship_id', $heirship_id, 'heirship', $update_data);
            $heirship_data = $this->heirship_model->get_basic_data_for_hc($heirship_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = is_mamlatdar_user() ? APP_REVERIFY_MESSAGE : APP_FORWARDED_MESSSAGE;
            $success_array['heirship_data'] = $heirship_data;
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
            $heirship_id = get_from_post('heirship_id_for_heirship_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$heirship_id || $heirship_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_heirship_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('heirship_id', $heirship_id, 'heirship');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_THREE, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('heirship_id', $heirship_id, 'heirship', $update_data);

            $ex_data['status'] = $update_data['status'];
            $ex_data['status_datetime'] = $update_data['status_datetime'];
            error_reporting(E_ERROR);
            $data = array('heirship_data' => $ex_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($this->load->view('heirship/certificate', $data, TRUE));
            $certificate_path = 'documents/temp/final_certificate_hc-' . $heirship_id . rand(111111111, 99999999) . '_' . time() . '.pdf';
            $mpdf->Output($certificate_path, 'F');
            $cerificate_data = array();
            $cerificate_data['certificate'] = chunk_split(base64_encode(file_get_contents($certificate_path)));
            $cerificate_data['module_id'] = $heirship_id;
            $cerificate_data['module_type'] = VALUE_THREE;
            $cerificate_data['created_time'] = $update_data['status_datetime'];
            $this->utility_model->insert_data('certificate', $cerificate_data);
            if (file_exists($certificate_path)) {
                unlink($certificate_path);
            }

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_THREE, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_THREE, $ex_data);
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
            $heirship_id = get_from_post('heirship_id_for_heirship_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$heirship_id || $heirship_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_heirship_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('heirship_id', $heirship_id, 'heirship');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_THREE, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('heirship_id', $heirship_id, 'heirship', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_THREE, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_THREE, $ex_data);
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

    function get_heirship_data_by_heirship_id() {
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
            $heirship_id = get_from_post('heirship_id');
            if (!$heirship_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $heirship_data = $this->heirship_model->get_basic_data_for_hc($heirship_id);
            if (empty($heirship_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            // $ti_bd = $this->_calculate_total_income_and_basic_details($heirship_data);
            // $heirship_data['total_income'] = $ti_bd['total_income'];
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['heirship_data'] = $heirship_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $heirship_id = get_from_post('heirship_id_for_certificate');
            $mtype = get_from_post('mtype_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $heirship_id == null || !$heirship_id ||
                    ($mtype != VALUE_ONE && $mtype != VALUE_TWO)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            if ($mtype == VALUE_TWO) {
                $module_type = VALUE_THREE;
                $temp_qm_data = $this->config->item('query_module_array');
                $qm_data = isset($temp_qm_data[$module_type]) ? $temp_qm_data[$module_type] : array();
                if (empty($qm_data)) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return;
                }
                $existing_heirship_data = $this->utility_model->get_certificate_by_module_details($module_type, $heirship_id, $qm_data['key_id_text'], $qm_data['tbl_text']);
            } else {
                $existing_heirship_data = $this->utility_model->get_by_id('heirship_id', $heirship_id, 'heirship');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($existing_heirship_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($mtype == VALUE_TWO) {
                header('Content-type: application/pdf');
                header("Content-Transfer-Encoding: base64");
                $certificate = base64_decode($existing_heirship_data['certificate']);
                print_r($certificate);
            } else {
                error_reporting(E_ERROR);
                $data = array('heirship_data' => $existing_heirship_data, 'mtype' => $mtype);
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
                $mpdf->showWatermarkText = true;
                $mpdf->setFooter('{PAGENO} / {nb}');
                $mpdf->WriteHTML($this->load->view('heirship/certificate', $data, TRUE));
                $mpdf->Output('heirship_' . time() . '.pdf', 'I');
            }
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
            $s_app_no = get_from_post('app_no_for_hcge');
            $s_appd = get_from_post('app_date_for_hcge');
            $s_app_det = get_from_post('app_details_for_hcge');
            $s_vdw = get_from_post('vdw_for_hcge');
            $s_app_status = get_from_post('app_status_for_hcge');
            $s_co_hand = get_from_post('currently_on_for_hcge');
            $s_qstatus = get_from_post('qstatus_for_hcge');
            $s_status = get_from_post('status_for_hcge');
            $this->db->trans_start();
            $excel_data = $this->heirship_model->get_records_for_excel($s_district, $s_app_no, $s_appd, $s_app_det, $s_vdw, $s_app_status, $s_co_hand, $s_qstatus, $s_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Heirship_Report_' . date('Y-m-d H:i:s') . '.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('Application Number', 'Submitted On', 'Applicant Name', 'Mobile Number',
                'District', 'Village / DMC Ward / SMC Ward', 'Status', 'Query Status'));
            if (!empty($excel_data)) {
                $taluka_array = $this->config->item('taluka_array');
                $app_status_text_array = $this->config->item('app_status_text_array');
                $query_status_text_array = $this->config->item('query_status_text_array');
                $daman_villages_array = $this->config->item('daman_villages_array');
                $diu_villages_array = $this->config->item('diu_villages_array');
                $dnh_villages_array = $this->config->item('dnh_villages_array');
                foreach ($excel_data as $list) {
                    $villages_array = $list['district'] == TALUKA_DAMAN ? $daman_villages_array : ($list['district'] == TALUKA_DIU ? $diu_villages_array : ($list['district'] == TALUKA_DNH ? $dnh_villages_array : array()));
                    $list['village_name'] = isset($villages_array[$list['village_name']]) ? $villages_array[$list['village_name']] : '';
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

    function get_appointment_data_by_heirship_id() {
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
            $heirship_id = get_from_post('heirship_id');
            if (!$heirship_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $appointment_data = $this->utility_model->get_appointment_data_by_id('heirship_id', $heirship_id, 'heirship');
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
            $heirship_id = get_from_post('heirship_id_for_heirship_set_appointment');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$heirship_id || $heirship_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_data = array();
            $ex_ap_data = $this->utility_model->get_by_id('heirship_id', $heirship_id, 'heirship');
            if (empty($ex_ap_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_date = get_from_post('appointment_date_for_heirship');
            $appointment_data['appointment_date'] = convert_to_mysql_date_format($appointment_date);
            $appointment_data['appointment_time'] = get_from_post('appointment_time_for_heirship');
            $appointment_data['appointment_by'] = $session_user_id;
            $appointment_data['appointment_by_name'] = get_from_session('name');
            $appointment_data['appointment_datetime'] = $appointment_data['appointment_date'] . ' ' . date("H:i:s", strtotime($appointment_data['appointment_time']));
            $appointment_data['online_statement'] = get_from_post('online_statement_for_heirship');
            $appointment_data['visit_office'] = get_from_post('visit_office_for_heirship');
            $appointment_data['updated_by'] = $session_user_id;
            $appointment_data['updated_time'] = date('Y-m-d H:i:s');
            $appointment_data['appointment_status'] = VALUE_ONE;

            $ex_ap_data['appointment_type'] = $appointment_data['visit_office'] == VALUE_ONE ? VALUE_TWO : VALUE_ONE;
            if ($appointment_data['appointment_date'] != $ex_ap_data['appointment_date'] ||
                    $appointment_data['appointment_time'] != $ex_ap_data['appointment_time']) {
                $ah = $ex_ap_data['appointment_history'] != '' ? json_decode($ex_ap_data['appointment_history'], true) : array();
                array_push($ah, array('appointment_date' => $appointment_data['appointment_date'],
                    'appointment_time' => $appointment_data['appointment_time'],
                    'appointment_by' => $appointment_data['appointment_by'],
                    'appointment_by_name' => $appointment_data['appointment_by_name'],
                    'appointment_type' => $ex_ap_data['appointment_type'],
                    'appointment_datetime' => $appointment_data['appointment_datetime']));
                $appointment_data['appointment_history'] = json_encode($ah);
            }

            $this->db->trans_start();
            $this->utility_model->update_data('heirship_id', $heirship_id, 'heirship', $appointment_data);
            $heirship_data = $this->heirship_model->get_basic_data_for_hc($heirship_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            // Appointment Email & SMS
            $this->utility_lib->email_and_sms_for_certificate_appointment(VALUE_THREE, $heirship_data);

            $success_array = get_success_array();
            $success_array['message'] = APPOINTMENT_SET_MESSAGE;
            $success_array['heirship_data'] = $heirship_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_update_basic_detail_data_by_heirship_id() {
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
            $heirship_id = get_from_post('heirship_id');
            if (!$heirship_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $basic_details = $this->heirship_model->get_basic_data_for_hc($heirship_id);
            if (empty($basic_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($basic_details['query_status'] == VALUE_ONE || $basic_details['query_status'] == VALUE_TWO) {
                echo json_encode(get_error_array(APPLICATION_IN_QUERY_MESSAGE));
                return false;
            }
            $talathi_name = '';
            $aci_data = array();
            $mamlatdar_data = array();
            $ldc_data = array();

            $basic_details['field_documents'] = $this->utility_model->get_result_by_id('module_id', $heirship_id, 'field_verification_document', 'verification_type', VALUE_ONE, 'module_type', VALUE_THREE);

            $basic_details['field_reverify_documents'] = $this->utility_model->get_result_by_id('module_id', $heirship_id, 'field_verification_document', 'verification_type', VALUE_TWO, 'module_type', VALUE_THREE);

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
            $heirship_id = get_from_post('heirship_id_for_heirship_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$heirship_id || $heirship_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if (is_admin() || is_talathi_user()) {

                $is_upload_verification_doc = get_from_post('upload_verification_document_for_heirship');
                if (!$is_upload_verification_doc) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                if ($is_upload_verification_doc == VALUE_ONE) {
                    $new_field_doc_items = $this->input->post('new_field_doc_items');
                    $exi_field_doc_items = $this->input->post('exi_field_doc_items');
                    if (empty($new_field_doc_items) && empty($exi_field_doc_items)) {
                        echo json_encode(get_error_array(ONE_FIELD_DOC_MESSAGE));
                        return false;
                    }
                }

                $talathi_remarks = get_from_post('talathi_remarks_for_heirship');
                if (!$talathi_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $talathi_to_aci = get_from_post('talathi_to_aci_for_heirship');
                if (!$talathi_to_aci) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if (is_admin() || is_aci_user()) {
                $aci_rec = get_from_post('aci_rec_for_heirship');
                if (!$aci_rec) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $aci_remarks = get_from_post('aci_remarks_for_heirship');
                if (!$aci_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($aci_rec == VALUE_ONE) {
                    $aci_to_ldc = get_from_post('aci_to_ldc_for_heirship');
                    if (!$aci_to_ldc) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
                if ($aci_rec == VALUE_TWO) {
                    $aci_to_mamlatdar = get_from_post('aci_to_mamlatdar_for_heirship');
                    if (!$aci_to_mamlatdar) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
            }
            if (is_admin() || is_ldc_user()) {
                $ldc_applicant_name = get_from_post('ldc_applicant_name_for_heirship');
                if (!$ldc_applicant_name) {
                    echo json_encode(get_error_array(APPLICANT_NAME_MESSAGE));
                    return false;
                }
                $ldc_death_person_name = get_from_post('ldc_death_person_name_for_heirship');
                if (!$ldc_death_person_name) {
                    echo json_encode(get_error_array(DEATH_PERSON_NAME_MESSAGE));
                    return false;
                }
                $ldc_commu_address = get_from_post('ldc_commu_address_for_heirship');
                if (!$ldc_commu_address) {
                    echo json_encode(get_error_array(COMMUNICATION_ADDRESS_MESSAGE));
                    return false;
                }
                $ldc_death_person_address = get_from_post('ldc_death_person_address_for_heirship');
                if (!$ldc_death_person_address) {
                    echo json_encode(get_error_array(DEATH_PERSON_ADDRESS_MESSAGE));
                    return false;
                }
                $fmi = $this->input->post('family_member_info_for_heirship');
                if (empty($fmi)) {
                    echo json_encode(get_error_array(ONE_LEGAL_HEIRS_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar_remarks = get_from_post('ldc_to_mamlatdar_remarks_for_heirship');
                if (!$ldc_to_mamlatdar_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_ldc_mam_details = get_from_post('update_ldc_mam_details');
                if ($update_ldc_mam_details == VALUE_ONE) {
                    $ldc_to_mamlatdar = get_from_post('ldc_to_mamlatdar_for_heirship');
                    if (!$ldc_to_mamlatdar) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('heirship_id', $heirship_id, 'heirship');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $basic_detail_data = array();
            if (is_admin() || is_talathi_user()) {
                $basic_detail_data['talathi'] = $session_user_id;
                $basic_detail_data['is_upload_verification_doc'] = $is_upload_verification_doc;
                $basic_detail_data['talathi_remarks'] = $talathi_remarks;
                $basic_detail_data['talathi_to_aci'] = $talathi_to_aci;
                $basic_detail_data['talathi_to_aci_datetime'] = date('Y-m-d H:i:s');

                if ($is_upload_verification_doc == VALUE_ONE) {
                    $this->_update_field_doc_items($session_user_id, $heirship_id, $exi_field_doc_items, $new_field_doc_items);
                }
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
                $basic_detail_data['ldc_death_person_name'] = $ldc_death_person_name;
                $basic_detail_data['ldc_commu_address'] = $ldc_commu_address;
                $basic_detail_data['ldc_death_person_address'] = $ldc_death_person_address;
                $basic_detail_data['legal_heirs_details'] = json_encode($fmi);
                $basic_detail_data['ldc_to_mamlatdar_remarks'] = $ldc_to_mamlatdar_remarks;
                if ($update_ldc_mam_details == VALUE_ONE) {
                    $basic_detail_data['ldc_to_mamlatdar'] = $ldc_to_mamlatdar;
                    $basic_detail_data['ldc_to_mamlatdar_datetime'] = date('Y-m-d H:i:s');
                }
            }
            $basic_detail_data['updated_by'] = $session_user_id;
            $basic_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('heirship_id', $heirship_id, 'heirship', $basic_detail_data);
            $ic_data = $this->heirship_model->get_basic_data_for_hc($heirship_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            if (is_admin() || is_ldc_user()) {
                if (!$update_ldc_mam_details || $update_ldc_mam_details == VALUE_ZERO || $update_ldc_mam_details == null) {
                    $success_array['message'] = APP_DRAFT_MESSAGE;
                } else {
                    $success_array['message'] = APP_FORWARDED_MESSSAGE;
                }
            } else {
                $success_array['message'] = APP_FORWARDED_MESSSAGE;
            }
            $success_array['heirship_id'] = $heirship_id;
            $success_array['heirship_data'] = $ic_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function document_for_scrutiny() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $heirship_id = get_from_post('heirship_id_for_scrutiny');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$heirship_id || $heirship_id == NULL) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $hc_data = $this->heirship_model->get_basic_data_for_hc($heirship_id);
            if (empty($hc_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }

            $query_data = $this->utility_model->query_data_for_scrutiny(VALUE_THREE, $heirship_id);

            $field_verification_doc_data = $this->utility_model->field_verification_document_data_for_scrutiny(VALUE_THREE, $heirship_id);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('heirship/pdf', $hc_data, TRUE));

            $temp_filename = 'basic_hc_' . $heirship_id . '_' . time() . '.pdf';
            $temp_filepath = 'documents/temp/' . $temp_filename;
            //$mpdf->Output($temp_filepath, 'F');

            $temp_files_to_remove = array();
            $temp_files_to_merge = array();
            array_push($temp_files_to_remove, $temp_filepath);
            array_push($temp_files_to_merge, $temp_filepath);

            if ($hc_data['death_certificate_doc'] != '') {
                $new_death_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['death_certificate_doc']);
                array_push($temp_files_to_remove, $new_death_path);
                array_push($temp_files_to_merge, $new_death_path);
            }
            if ($hc_data['death_aadhar_card_doc'] != '') {
                $new_death_aadhar_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['death_aadhar_card_doc']);
                array_push($temp_files_to_remove, $new_death_aadhar_path);
                array_push($temp_files_to_merge, $new_death_aadhar_path);
            }
            if ($hc_data['marriage_certificate_doc'] != '') {
                $new_marriage_certificate_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['marriage_certificate_doc']);
                array_push($temp_files_to_remove, $new_marriage_certificate_path);
                array_push($temp_files_to_merge, $new_marriage_certificate_path);
            }
            if ($hc_data['aadhar_card_doc'] != '') {
                $new_aadhar_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['aadhar_card_doc']);
                array_push($temp_files_to_remove, $new_aadhar_path);
                array_push($temp_files_to_merge, $new_aadhar_path);
            }
            if ($hc_data['panchayat_certificate_doc'] != '') {
                $new_panchayat_certificate_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['panchayat_certificate_doc']);
                array_push($temp_files_to_remove, $new_panchayat_certificate_path);
                array_push($temp_files_to_merge, $new_panchayat_certificate_path);
            }
            if ($hc_data['community_certificate_doc'] != '') {
                $new_community_certificate_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['community_certificate_doc']);
                array_push($temp_files_to_remove, $new_community_certificate_path);
                array_push($temp_files_to_merge, $new_community_certificate_path);
            }
            if ($hc_data['witness1_aadhar_doc'] != '') {
                $new_witness1_aadhar_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['witness1_aadhar_doc']);
                array_push($temp_files_to_remove, $new_witness1_aadhar_path);
                array_push($temp_files_to_merge, $new_witness1_aadhar_path);
            }
            if ($hc_data['witness2_aadhar_doc'] != '') {
                $new_witness2_aadhar_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['witness2_aadhar_doc']);
                array_push($temp_files_to_remove, $new_witness2_aadhar_path);
                array_push($temp_files_to_merge, $new_witness2_aadhar_path);
            }
            if ($hc_data['applicant_witness_photo_notary_affidavit_doc'] != '') {
                $new_applicant_witness_photo_notary_affidavit_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['applicant_witness_photo_notary_affidavit_doc']);
                array_push($temp_files_to_remove, $new_applicant_witness_photo_notary_affidavit_path);
                array_push($temp_files_to_merge, $new_applicant_witness_photo_notary_affidavit_path);
            }
            if ($hc_data['property_documents_doc'] != '') {
                $new_property_documents_doc_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['property_documents_doc']);
                array_push($temp_files_to_remove, $new_property_documents_doc_path);
                array_push($temp_files_to_merge, $new_property_documents_doc_path);
            }

//        if ($hc_data['applicant_photo_doc'] != '') {
//            $new_applicant_photo_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['applicant_photo_doc']);
//            $applicant_photo_page_count = $mpdf->SetSourceFile($new_applicant_photo_path);
//            unlink($new_applicant_photo_path);
//            $this->_merge_multiple_pdf($mpdf, $applicant_photo_page_count);
//        }
//        if ($hc_data['witness1_photo_doc'] != '') {
//            $new_witness1_photo_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['witness1_photo_doc']);
//            $witness1_photo_page_count = $mpdf->SetSourceFile($new_witness1_photo_path);
//            unlink($new_witness1_photo_path);
//            $this->_merge_multiple_pdf($mpdf, $witness1_photo_page_count);
//        }
//        if ($hc_data['witness2_photo_doc'] != '') {
//            $new_witness2_photo_path = $this->_copy_file(HEIRSHIP_CERTIFICATE_DOC_PATH, $hc_data['witness2_photo_doc']);
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

            if (!empty($field_verification_doc_data)) {
                foreach ($field_verification_doc_data as $fvd_data) {
                    if ($fvd_data['document'] != '') {
                        $new_fvd_path = $this->_copy_file('documents/heirship/', $fvd_data['document']);
                        array_push($temp_files_to_remove, $new_fvd_path);

                        if (strpos($new_fvd_path, '.pdf')) {
                            array_push($temp_files_to_merge, $new_fvd_path);
                        } else {
                            $mpdf->WriteHTML($this->load->view('common/image_to_pdf', array('photo_doc' => $new_fvd_path), TRUE));
                        }
                    }
                }
            }
            $mpdf->Output($temp_filepath, 'F');
            $final_filename = 'final_scrutiny_document_hc_' . rand(111111111, 99999999) . '_' . time() . '.pdf';
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
            // $mpdf->Output($heirship_id . '_' . time() . '.pdf', 'I');
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

    function upload_field_verification_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $field_verification_document_id = get_from_post('field_document_id_for_field_verification');
            $verification_type = get_from_post('verification_type_for_field_verification');
            $heirship_id = get_from_post('heirship_id_for_heirship_update_basic_detail');

            if ($user_id == NULL || !$user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($_FILES['document_for_verification_document']['name'] == '') {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_DOC_MESSAGE));
                return;
            }
            $evidence_size = $_FILES['document_for_verification_document']['size'];
            if ($evidence_size == 0) {
                echo json_encode(array('success' => FALSE, 'message' => DOC_INVALID_SIZE_MESSAGE));
                return;
            }
//        $maxsize = '52428800';
//        if ($evidence_size >= $maxsize) {
//            echo json_encode(array('success' => FALSE, 'message' => UPLOAD_MAX_MB_MESSAGE));
//            return;
//        }
            $path = 'documents';
            if (!is_dir($path)) {
                mkdir($path);
                chmod("$path", 0755);
            }
            $main_path = $path . DIRECTORY_SEPARATOR . 'heirship';
            if (!is_dir($main_path)) {
                mkdir($main_path);
                chmod("$main_path", 0755);
            }
            $this->load->library('upload');
            $temp_qd_filename = str_replace('_', '', $_FILES['document_for_verification_document']['name']);
            $drd_filename = 'field_verification_doc_' . (rand(100000, 999999)) . time() . '.' . pathinfo($temp_qd_filename, PATHINFO_EXTENSION);
            //Change file name
            $qd_final_path = $main_path . DIRECTORY_SEPARATOR . $drd_filename;
            if (!move_uploaded_file($_FILES['document_for_verification_document']['tmp_name'], $qd_final_path)) {
                echo json_encode(array('success' => FALSE, 'message' => DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $dr_data = array();
            $dr_u_data = array();
            $dr_data['document'] = $drd_filename;
            if (!$field_verification_document_id || $field_verification_document_id == NULL) {
                $dr_data['user_id'] = $user_id;
                $dr_data['module_type'] = VALUE_THREE;
                $dr_data['module_id'] = $heirship_id;
                $dr_data['verification_type'] = $verification_type;
                $dr_data['created_by'] = $user_id;
                $dr_data['created_time'] = date('Y-m-d H:i:s');
                $field_verification_document_id = $this->utility_model->insert_data('field_verification_document', $dr_data);
            } else {
                $dr_data['updated_by'] = $user_id;
                $dr_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('field_verification_document_id', $field_verification_document_id, 'field_verification_document', $dr_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = array();
            $success_array['field_verification_document_id'] = $field_verification_document_id;
            $success_array['document_name'] = $drd_filename;

            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function remove_field_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $field_document_id = get_from_post('field_document_id');
            if ($user_id == NULL || !$user_id || !$field_document_id || $field_document_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('field_verification_document_id', $field_document_id, 'field_verification_document');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['document'] != '') {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'heirship' . DIRECTORY_SEPARATOR . $ex_data['document'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $update_data = array();
            $update_data['document'] = '';
            $update_data['updated_by'] = $user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('field_verification_document_id', $field_document_id, 'field_verification_document', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function remove_field_document_item() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $field_verification_document_id = get_from_post('field_verification_document_id');
            if ($user_id == NULL || !$user_id || !$field_verification_document_id || $field_verification_document_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('field_verification_document_id', $field_verification_document_id, 'field_verification_document');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['document'] != '') {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'heirship' . DIRECTORY_SEPARATOR . $ex_data['document'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $update_data = array();
            $update_data['is_delete'] = IS_DELETE;
            $update_data['updated_by'] = $user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('field_verification_document_id', $field_verification_document_id, 'field_verification_document', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DOCUMENT_ITEM_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _update_field_doc_items($session_user_id, $heirship_id, $exi_field_doc_items, $new_field_doc_items) {
        if ($exi_field_doc_items != '') {
            if (!empty($exi_field_doc_items)) {
                foreach ($exi_field_doc_items as &$value) {
                    $value['module_id'] = $heirship_id;
                    $value['updated_by'] = $session_user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->update_data_batch('field_verification_document_id', 'field_verification_document', $exi_field_doc_items);
            }
        }
        if ($new_field_doc_items != '') {
            if (!empty($new_field_doc_items)) {
                foreach ($new_field_doc_items as &$value) {
                    $value['module_id'] = $heirship_id;
                    $value['created_by'] = $session_user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->insert_data_batch('field_verification_document', $new_field_doc_items);
            }
        }
    }
}

/*
 * EOF: ./application/controller/Heirship.php
 */
