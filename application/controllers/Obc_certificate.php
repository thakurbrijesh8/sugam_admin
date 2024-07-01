<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Obc_certificate extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('obc_certificate_model');
    }

    function get_obc_certificate_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['obc_certificate_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;
            
            $search_appno = get_from_post('app_no_for_obc_certificate_list');
            $search_appd = get_from_post('application_date_for_obc_certificate_list');
            $search_appdet = filter_var(get_from_post('app_details_for_obc_certificate_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_obc_certificate_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_obc_certificate_list');
            $search_cohand = get_from_post('currently_on_for_obc_certificate_list');
            $search_appostatus = get_from_post('appointment_status_for_obc_certificate_list');
            $search_qstatus = get_from_post('query_status_for_obc_certificate_list');
            $search_status = get_from_post('status_for_obc_certificate_list');

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
            $success_array['obc_certificate_data'] = $this->obc_certificate_model->get_all_obc_certificate_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->obc_certificate_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_appostatus != '' || $search_cohand != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->obc_certificate_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['obc_certificate_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['obc_certificate_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_obc_certificate_data_by_id() {
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
            $obc_certificate_id = get_from_post('obc_certificate_id');
            if (!$obc_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $is_edit_view = get_from_post('is_edit_view');
            $this->db->trans_start();
            $obc_certificate_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            if (empty($obc_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['obc_certificate_data'] = $obc_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_obc_certificate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            $obc_certificate_id = get_from_post('obc_certificate_id');
            if (!is_post() || $user_id == NULL || !$user_id || $obc_certificate_id == NULL || !$obc_certificate_id || ($module_type != VALUE_TWO)) {
                //echo $module_type != VALUE_TWO;
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $obc_certificate_data = $this->_get_post_data_for_obc_certificate();
            // $validation_message = $this->_check_validation_for_obc_certificate($obc_certificate_data);
            // if ($validation_message != '') {
            //     echo json_encode(get_error_array($validation_message));
            //     return false;
            // }


            $this->db->trans_start();
            $obc_certificate_data['applicant_dob'] = convert_to_mysql_date_format($obc_certificate_data['applicant_dob']);
            // $obc_certificate_data['applied_date'] = convert_to_mysql_date_format($obc_certificate_data['applied_date']);
            // $obc_certificate_data['applied_date_of_hold_certy'] = convert_to_mysql_date_format($obc_certificate_data['applied_date_of_hold_certy']);
            $obc_certificate_data['updated_by'] = $user_id;
            $obc_certificate_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $obc_certificate_data);

            // $new_obc_certificate_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);

            // $success_array = get_success_array();
            // $success_array['encrypt_id'] = get_encrypt_id($obc_certificate_id);
            // $new_obc_certificate_data['obc_certificate_id'] = $obc_certificate_id;
            // $new_obc_certificate_data['encrypt_id'] = $success_array['encrypt_id'];
            // $success_array['obc_certificate_data'] = $new_obc_certificate_data;
            // echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_obc_certificate() {
        $obc_certificate_data = array();
        $obc_certificate_data['constitution_artical'] = get_from_post('constitution_artical');
        $obc_certificate_data['district'] = get_from_post('district');
        $obc_certificate_data['village_name'] = get_from_post('village_name');
        $obc_certificate_data['applicant_name'] = get_from_post('applicant_name');
        if ($obc_certificate_data['constitution_artical'] == VALUE_TWO) {
            $obc_certificate_data['relationship_of_applicant'] = get_from_post('relationship_of_applicant');
            $obc_certificate_data['guardian_address'] = get_from_post('guardian_address');
            $obc_certificate_data['guardian_mobile_no'] = get_from_post('guardian_mobile_no');
            $obc_certificate_data['guardian_aadhaar'] = get_from_post('guardian_aadhaar');
            $obc_certificate_data['minor_child_name'] = get_from_post('minor_child_name');
        }
        $obc_certificate_data['com_addr_house_no'] = get_from_post('com_addr_house_no');
        $obc_certificate_data['com_addr_house_name'] = get_from_post('com_addr_house_name');
        $obc_certificate_data['com_addr_street'] = get_from_post('com_addr_street');
        $obc_certificate_data['com_addr_village_dmc_ward'] = get_from_post('com_addr_village_dmc_ward');
        $obc_certificate_data['com_addr_city'] = get_from_post('com_addr_city');
        $obc_certificate_data['com_pincode'] = get_from_post('com_pincode');
        $obc_certificate_data['billingtoo'] = get_from_post('billingtoo');
        $obc_certificate_data['per_addr_house_no'] = get_from_post('per_addr_house_no');
        $obc_certificate_data['per_addr_house_name'] = get_from_post('per_addr_house_name');
        $obc_certificate_data['per_addr_street'] = get_from_post('per_addr_street');
        $obc_certificate_data['per_addr_village_dmc_ward'] = get_from_post('per_addr_village_dmc_ward');
        $obc_certificate_data['per_addr_city'] = get_from_post('per_addr_city');
        $obc_certificate_data['per_pincode'] = get_from_post('per_pincode');
        ;
        $obc_certificate_data['mobile_number'] = get_from_post('mobile_number');
        $obc_certificate_data['email'] = get_from_post('email');
        if ($obc_certificate_data['constitution_artical'] == VALUE_ONE) {
            $obc_certificate_data['election_no'] = get_from_post('election_no');
        }
        $obc_certificate_data['marital_status'] = get_from_post('marital_status_for_oc');
        // $obc_certificate_data['occupation'] = get_from_post('occupation');
        // }
        // $obc_certificate_data['mobile_number'] = get_from_post('mobile_number');
        // $obc_certificate_data['email'] = get_from_post('email');
        $obc_certificate_data['applicant_nationality'] = get_from_post('applicant_nationality');
        $obc_certificate_data['aadhaar'] = get_from_post('aadhaar');
        //   $obc_certificate_data['election_no'] = get_from_post('election_no');
        $obc_certificate_data['applicant_dob'] = get_from_post('applicant_dob');
        $obc_certificate_data['applicant_age'] = get_from_post('applicant_age');
        // $obc_certificate_data['applicant_dob_major'] = get_from_post('applicant_dob_major');
        // $obc_certificate_data['applicant_age_major'] = get_from_post('applicant_age_major');
        $obc_certificate_data['born_place_state'] = get_from_post('born_place_state');
        $obc_certificate_data['born_place_state_text'] = get_from_post('born_place_state_text');
        $obc_certificate_data['born_place_district'] = get_from_post('born_place_district');
        $obc_certificate_data['born_place_district_text'] = get_from_post('born_place_district_text');
        $obc_certificate_data['born_place_village'] = get_from_post('born_place_village');
        $obc_certificate_data['born_place_village_text'] = get_from_post('born_place_village_text');
        $obc_certificate_data['born_place_pincode'] = get_from_post('born_place_pincode');
        $obc_certificate_data['native_place_state'] = get_from_post('native_place_state');
        $obc_certificate_data['native_place_state_text'] = get_from_post('native_place_state_text');
        $obc_certificate_data['native_place_district'] = get_from_post('native_place_district');
        $obc_certificate_data['native_place_district_text'] = get_from_post('native_place_district_text');
        $obc_certificate_data['native_place_village'] = get_from_post('native_place_village');
        $obc_certificate_data['native_place_village_text'] = get_from_post('native_place_village_text');
        $obc_certificate_data['native_place_pincode'] = get_from_post('native_place_pincode');
        $obc_certificate_data['gender'] = get_from_post('gender_for_oc');
        // $obc_certificate_data['marital_status'] = get_from_post('marital_status_for_oc');
        $obc_certificate_data['obccaste'] = get_from_post('obccaste');
        $obc_certificate_data['religion'] = get_from_post('religion');
        //  $obc_certificate_data['minor_education'] = get_from_post('minor_education');
        $obc_certificate_data['nearest_police_station'] = get_from_post('nearest_police_station');
        $obc_certificate_data['occupation'] = get_from_post('occupation');
        if ($obc_certificate_data['occupation'] == VALUE_TWELVE)
            $obc_certificate_data['other_occupation'] = get_from_post('other_occupation');
        if ($obc_certificate_data['constitution_artical'] == VALUE_ONE) {
            $obc_certificate_data['applicant_education'] = get_from_post('applicant_education');
            if ($obc_certificate_data['applicant_education'] == VALUE_FIVE)
                $obc_certificate_data['other_education'] = get_from_post('other_education');
            $obc_certificate_data['name_of_school'] = get_from_post('name_of_school');
        }
        if ($obc_certificate_data['constitution_artical'] == VALUE_TWO) {
            $obc_certificate_data['minor_education'] = get_from_post('minor_education');
        }


        // Father Details in json array
        $father_details = array('father_name' => get_from_post('father_name'),
            'father_nationality' => get_from_post('father_nationality'), 'father_born_place_state' => get_from_post('father_born_place_state'),
            'father_born_place_state_text' => get_from_post('father_born_place_state_text'),
            'father_born_place_district' => get_from_post('father_born_place_district'), 'father_born_place_district_text' => get_from_post('father_born_place_district_text'),
            'father_born_place_village' => get_from_post('father_born_place_village'), 'father_born_place_village_text' => get_from_post('father_born_place_village_text'),
            // 'father_born_pincode' => get_from_post('father_born_pincode'),
            'father_native_place_district' => get_from_post('father_native_place_district'), 'father_native_place_district_text' => get_from_post('father_native_place_district_text'),
            'father_city' => get_from_post('father_city'), 'father_city_text' => get_from_post('father_city_text'),
            'father_native_place_village' => get_from_post('father_native_place_village'), 'father_native_place_village_text' => get_from_post('father_native_place_village_text'),
            //'father_native_pincode' => get_from_post('father_native_pincode'),
            'father_religion' => get_from_post('father_religion'), 'father_caste' => get_from_post('father_caste'),
            'father_annual_income' => get_from_post('father_annual_income'),
            'father_occupation' => get_from_post('father_occupation'), 'father_other_occupation' => get_from_post('father_other_occupation'),
            'father_aadhaar' => get_from_post('father_aadhaar'), 'father_election_no' => get_from_post('father_election_no'),
            'father_alive' => get_from_post('father_alive_for_obc_certificate'));

        $obc_certificate_data['father_details'] = json_encode($father_details);
        // Mother Details in json array
        $mother_details = array('mother_name' => get_from_post('mother_name'),
            'mother_nationality' => get_from_post('mother_nationality'), 'mother_born_place_state' => get_from_post('mother_born_place_state'),
            'mother_born_place_state_text' => get_from_post('mother_born_place_state_text'),
            'mother_born_place_district' => get_from_post('mother_born_place_district'), 'mother_born_place_district_text' => get_from_post('mother_born_place_district_text'),
            'mother_born_place_village' => get_from_post('mother_born_place_village'), 'mother_born_place_village_text' => get_from_post('mother_born_place_village_text'),
            // 'mother_born_pincode' => get_from_post('mother_born_pincode'),
            'mother_native_place_state' => get_from_post('mother_native_place_state'), 'mother_native_place_state_text' => get_from_post('mother_native_place_state_text'),
            'mother_native_place_district' => get_from_post('mother_native_place_district'), 'mother_native_place_district_text' => get_from_post('mother_native_place_district_text'),
            'mother_native_place_village' => get_from_post('mother_native_place_village'), 'mother_native_place_village_text' => get_from_post('mother_native_place_village_text'),
            //'mother_native_pincode' => get_from_post('mother_native_pincode'),
            'mother_religion' => get_from_post('mother_religion'), 'mother_caste' => get_from_post('mother_caste'),
            'mother_annual_income' => get_from_post('mother_annual_income'),
            'mother_occupation' => get_from_post('mother_occupation'), 'mother_other_occupation' => get_from_post('mother_other_occupation'),
            'mother_aadhaar' => get_from_post('mother_aadhaar'), 'mother_election_no' => get_from_post('mother_election_no'),
            'mother_alive' => get_from_post('mother_alive_for_obc_certificate'));
        $obc_certificate_data['mother_details'] = json_encode($mother_details);

        // Grand Father Details
        $grandfather_details = array('grandfather_name' => get_from_post('grandfather_name'),
            'grandfather_nationality' => get_from_post('grandfather_nationality'), 'grandfather_born_place_state' => get_from_post('grandfather_born_place_state'),
            'grandfather_born_place_state_text' => get_from_post('grandfather_born_place_state_text'),
            'grandfather_born_place_district' => get_from_post('grandfather_born_place_district'), 'grandfather_born_place_district_text' => get_from_post('grandfather_born_place_district_text'),
            'grandfather_borncity' => get_from_post('grandfather_borncity'), 'grandfather_borncity_text' => get_from_post('grandfather_borncity_text'),
            'grandfather_born_place_village' => get_from_post('grandfather_born_place_village'), 'grandfather_born_place_village_text' => get_from_post('grandfather_born_place_village_text'),
            // 'grandfather_born_pincode' => get_from_post('grandfather_born_pincode'),
            'grandfather_native_place_district' => get_from_post('grandfather_native_place_district'), 'grandfather_native_place_district_text' => get_from_post('grandfather_native_place_district_text'),
            'grandfather_city' => get_from_post('grandfather_city'), 'grandfather_city_text' => get_from_post('grandfather_city_text'),
            'grandfather_native_place_village' => get_from_post('grandfather_native_place_village'), 'grandfather_native_place_village_text' => get_from_post('grandfather_native_place_village_text'),
            //'grandfather_native_pincode' => get_from_post('grandfather_native_pincode'),
            'grandfather_religion' => get_from_post('grandfather_religion'), 'grandfather_caste' => get_from_post('grandfather_caste'),
            'grandfather_annual_income' => get_from_post('grandfather_annual_income'),
            'grandfather_occupation' => get_from_post('grandfather_occupation'), 'grandfather_other_occupation' => get_from_post('grandfather_other_occupation'),
            'grandfather_aadhaar' => get_from_post('grandfather_aadhaar'), 'grandfather_election_no' => get_from_post('grandfather_election_no'),
            'grandfather_alive' => get_from_post('grandfather_alive_for_obc_certificate'));
        $obc_certificate_data['grandfather_details'] = json_encode($grandfather_details);
        // Spouse Details
        $spouse_details = array('spouse_name' => get_from_post('spouse_name'),
            'spouse_nationality' => get_from_post('spouse_nationality'), 'spouse_born_place_state' => get_from_post('spouse_born_place_state'),
            'spouse_born_place_state_text' => get_from_post('spouse_born_place_state_text'),
            'spouse_born_place_district' => get_from_post('spouse_born_place_district'), 'spouse_born_place_district_text' => get_from_post('spouse_born_place_district_text'),
            'spouse_born_place_village' => get_from_post('spouse_born_place_village'), 'spouse_born_place_village_text' => get_from_post('spouse_born_place_village_text'),
            // 'spouse_born_pincode' => get_from_post('spouse_born_pincode'),
            'spouse_native_place_state' => get_from_post('spouse_native_place_state'), 'spouse_native_place_state_text' => get_from_post('spouse_native_place_state_text'),
            'spouse_native_place_district' => get_from_post('spouse_native_place_district'), 'spouse_native_place_district_text' => get_from_post('spouse_native_place_district_text'),
            'spouse_native_place_village' => get_from_post('spouse_native_place_village'), 'spouse_native_place_village_text' => get_from_post('spouse_native_place_village_text'),
            //'spouse_native_pincode' => get_from_post('spouse_native_pincode'),
            'spouse_religion' => get_from_post('spouse_religion_for_oc'), 'spouse_caste' => get_from_post('spouse_caste'),
            'spouse_annual_income' => get_from_post('spouse_annual_income'),
            'spouse_occupation' => get_from_post('spouse_occupation'), 'spouse_other_occupation' => get_from_post('spouse_other_occupation'),
            'spouse_aadhaar' => get_from_post('spouse_aadhaar'), 'spouse_election_no' => get_from_post('spouse_election_no'),
            'spouse_alive' => get_from_post('spouse_alive_for_obc_certificate'));
        $obc_certificate_data['spouse_details'] = json_encode($spouse_details);
//        $obc_certificate_data['father_alive'] = get_from_post('father_alive_for_dc');
//        $obc_certificate_data['spouse_alive'] = get_from_post('spouse_alive_for_dc');
//        $obc_certificate_data['mother_alive'] = get_from_post('mother_alive_for_dc');

        $obc_certificate_data['father_alive'] = get_from_post('father_alive_for_obc_certificate');
        $obc_certificate_data['mother_alive'] = get_from_post('mother_alive_for_obc_certificate');
        $obc_certificate_data['spouse_alive'] = get_from_post('spouse_alive_for_obc_certificate');
        $obc_certificate_data['grandfather_alive'] = get_from_post('grandfather_alive_for_obc_certificate');
//        $obc_certificate_data['father_name'] = get_from_post('father_name');
//        // $obc_certificate_data['father_house_no'] = get_from_post('father_house_no');
//        // $obc_certificate_data['father_house_name'] = get_from_post('father_house_name');
//        // $obc_certificate_data['father_street'] = get_from_post('father_street');
//        // $obc_certificate_data['father_village_dmc_ward'] = get_from_post('father_village_dmc_ward');
//        $obc_certificate_data['father_city'] = get_from_post('father_city');
//        $obc_certificate_data['father_nationality'] = get_from_post('father_nationality');
//        $obc_certificate_data['father_born_place_state'] = get_from_post('father_born_place_state');
//        $obc_certificate_data['father_born_place_district'] = get_from_post('father_born_place_district');
//        $obc_certificate_data['father_born_place_village'] = get_from_post('father_born_place_village');
//        // $obc_certificate_data['father_native_place_state'] = get_from_post('father_native_place_state');
//        $obc_certificate_data['father_native_place_district'] = get_from_post('father_native_place_district');
//        $obc_certificate_data['father_native_place_village'] = get_from_post('father_native_place_village');
//        get_from_post('father_occupation') = get_from_post('father_occupation');
//        if (get_from_post('father_occupation') == VALUE_TWELVE)
//            $obc_certificate_data['father_other_occupation'] = get_from_post('father_other_occupation');
//        $obc_certificate_data['father_aadhaar'] = get_from_post('father_aadhaar');
//        $obc_certificate_data['father_election_no'] = get_from_post('father_election_no');
//        $obc_certificate_data['father_religion'] = get_from_post('father_religion');
//        $obc_certificate_data['father_caste'] = get_from_post('father_caste');
//        //    $obc_certificate_data['father_caste'] = get_from_post('father_caste');
//        $obc_certificate_data['father_annual_income'] = get_from_post('father_annual_income');
        // $obc_certificate_data['mother_house_no'] = get_from_post('mother_house_no');
        // $obc_certificate_data['mother_house_name'] = get_from_post('mother_house_name');
        // $obc_certificate_data['mother_street'] = get_from_post('mother_street');
        // $obc_certificate_data['mother_village_dmc_ward'] = get_from_post('mother_village_dmc_ward');
//        $obc_certificate_data['mother_alive'] = get_from_post('mother_alive_for_obc_certificate');
//        $obc_certificate_data['mother_name'] = get_from_post('mother_name');
//        $obc_certificate_data['mother_nationality'] = get_from_post('mother_nationality');
//        $obc_certificate_data['mother_born_place_state'] = get_from_post('mother_born_place_state');
//        $obc_certificate_data['mother_born_place_district'] = get_from_post('mother_born_place_district');
//        $obc_certificate_data['mother_born_place_village'] = get_from_post('mother_born_place_village');
//        $obc_certificate_data['mother_native_place_state'] = get_from_post('mother_native_place_state');
//        $obc_certificate_data['mother_native_place_district'] = get_from_post('mother_native_place_district');
//        $obc_certificate_data['mother_native_place_village'] = get_from_post('mother_native_place_village');
//        $obc_certificate_data['mother_occupation'] = get_from_post('mother_occupation');
//        if ($obc_certificate_data['mother_occupation'] == VALUE_TWELVE)
//            $obc_certificate_data['mother_other_occupation'] = get_from_post('mother_other_occupation');
//        $obc_certificate_data['mother_aadhaar'] = get_from_post('mother_aadhaar');
//        $obc_certificate_data['mother_election_no'] = get_from_post('mother_election_no');
//        $obc_certificate_data['mother_religion'] = get_from_post('mother_religion');
//        $obc_certificate_data['mother_caste'] = get_from_post('mother_caste');
//        $obc_certificate_data['mother_annual_income'] = get_from_post('mother_annual_income');
//
//        $obc_certificate_data['grandfather_alive'] = get_from_post('grandfather_alive_for_obc_certificate');
//        $obc_certificate_data['grandfather_name'] = get_from_post('grandfather_name');
//        // $obc_certificate_data['grandfather_house_no'] = get_from_post('grandfather_house_no');
//        // $obc_certificate_data['grandfather_house_name'] = get_from_post('grandfather_house_name');
//        // $obc_certificate_data['grandfather_street'] = get_from_post('grandfather_street');
//        //$obc_certificate_data['grandfather_village_dmc_ward'] = get_from_post('grandfather_village_dmc_ward');
//
//        $obc_certificate_data['grandfather_nationality'] = get_from_post('grandfather_nationality');
//        // $obc_certificate_data['grandfather_born_place_state'] = get_from_post('grandfather_born_place_state');
//
//        $obc_certificate_data['grandfather_born_place_district'] = get_from_post('grandfather_born_place_district');
//        $obc_certificate_data['grandfather_borncity'] = get_from_post('grandfather_borncity');
//        $obc_certificate_data['grandfather_born_place_village'] = get_from_post('grandfather_born_place_village');
//        // $obc_certificate_data['grandfather_native_place_state'] = get_from_post('grandfather_native_place_state');
//        $obc_certificate_data['grandfather_city'] = get_from_post('grandfather_city');
//        $obc_certificate_data['grandfather_native_place_district'] = get_from_post('grandfather_native_place_district');
//        $obc_certificate_data['grandfather_native_place_village'] = get_from_post('grandfather_native_place_village');
//        $obc_certificate_data['grandfather_occupation'] = get_from_post('grandfather_occupation');
//        if ($obc_certificate_data['grandfather_occupation'] == VALUE_TWELVE)
//            $obc_certificate_data['grandfather_other_occupation'] = get_from_post('grandfather_other_occupation');
//        $obc_certificate_data['grandfather_aadhaar'] = get_from_post('grandfather_aadhaar');
//        $obc_certificate_data['grandfather_election_no'] = get_from_post('grandfather_election_no');
//        $obc_certificate_data['grandfather_religion'] = get_from_post('grandfather_religion');
//        $obc_certificate_data['grandfather_caste'] = get_from_post('grandfather_caste');
//
//        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
//            $obc_certificate_data['spouse_alive'] = get_from_post('spouse_alive_for_obc_certificate');
//            $obc_certificate_data['spouse_name'] = get_from_post('spouse_name');
//            $obc_certificate_data['spouse_house_no'] = get_from_post('spouse_house_no');
//            $obc_certificate_data['spouse_house_name'] = get_from_post('spouse_house_name');
//            $obc_certificate_data['spouse_street'] = get_from_post('spouse_street');
//            $obc_certificate_data['spouse_village_dmc_ward'] = get_from_post('spouse_village_dmc_ward');
//            $obc_certificate_data['spouse_city'] = get_from_post('spouse_city');
//            $obc_certificate_data['spouse_nationality'] = get_from_post('spouse_nationality');
//            $obc_certificate_data['spouse_born_place_state'] = get_from_post('spouse_born_place_state');
//            $obc_certificate_data['spouse_born_place_district'] = get_from_post('spouse_born_place_district');
//            $obc_certificate_data['spouse_born_place_village'] = get_from_post('spouse_born_place_village');
//            $obc_certificate_data['spouse_native_place_state'] = get_from_post('spouse_native_place_state');
//            $obc_certificate_data['spouse_native_place_district'] = get_from_post('spouse_native_place_district');
//            $obc_certificate_data['spouse_native_place_village'] = get_from_post('spouse_native_place_village');
//            $obc_certificate_data['spouse_occupation'] = get_from_post('spouse_occupation');
//            if ($obc_certificate_data['spouse_occupation'] == VALUE_TWELVE)
//                $obc_certificate_data['spouse_other_occupation'] = get_from_post('spouse_other_occupation');
//            $obc_certificate_data['spouse_aadhaar'] = get_from_post('spouse_aadhaar');
//            $obc_certificate_data['spouse_election_no'] = get_from_post('spouse_election_no');
//            $obc_certificate_data['spouse_religion'] = get_from_post('spouse_religion_for_oc');
//            $obc_certificate_data['spouse_caste'] = get_from_post('spouse_caste');
//            $obc_certificate_data['spouse_annual_income'] = get_from_post('spouse_annual_income');
//        }

        $family_designation = array();
        if ($obc_certificate_data['father_alive'] == VALUE_ONE) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
                $family_designation['father_designation'] = get_from_post('father_designation_for_oc');
        }
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_designation['mother_designation'] = get_from_post('mother_designation_for_oc');
        $family_designation['spouce_designation'] = get_from_post('spouce_designation_for_oc');
        $obc_certificate_data['family_designation'] = json_encode($family_designation);

        $family_services = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_services['father_services'] = get_from_post('father_services_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_services['mother_services'] = get_from_post('mother_services_for_oc');
        $family_services['spouce_services'] = get_from_post('spouce_services_for_oc');
        $obc_certificate_data['family_services'] = json_encode($family_services);

        $family_designation_b = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_designation_b['father_designation_b'] = get_from_post('father_designation_b_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_designation_b['mother_designation_b'] = get_from_post('mother_designation_b_for_oc');
        $family_designation_b['spouce_designation_b'] = get_from_post('spouce_designation_b_for_oc');
        $obc_certificate_data['family_designation_b'] = json_encode($family_designation_b);

        $family_scale_of_pay = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_scale_of_pay['father_scale_of_pay'] = get_from_post('father_scale_of_pay_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_scale_of_pay['mother_scale_of_pay'] = get_from_post('mother_scale_of_pay_for_oc');
        $family_scale_of_pay['spouce_scale_of_pay'] = get_from_post('spouce_scale_of_pay_for_oc');
        $obc_certificate_data['family_scale_of_pay'] = json_encode($family_scale_of_pay);

        $family_appointment_date = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_appointment_date['father_appointment_date'] = get_from_post('father_appointment_date_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_appointment_date['mother_appointment_date'] = get_from_post('mother_appointment_date_for_oc');
        $family_appointment_date['spouce_appointment_date'] = get_from_post('spouce_appointment_date_for_oc');
        $obc_certificate_data['family_appointment_date'] = json_encode($family_appointment_date);

        $family_promotion_age = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_promotion_age['father_promotion_age'] = get_from_post('father_promotion_age_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_promotion_age['mother_promotion_age'] = get_from_post('mother_promotion_age_for_oc');
        $family_promotion_age['spouce_promotion_age'] = get_from_post('spouce_promotion_age_for_oc');
        $obc_certificate_data['family_promotion_age'] = json_encode($family_promotion_age);

        $family_organization_name = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_organization_name['father_organization_name'] = get_from_post('father_organization_name_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_organization_name['mother_organization_name'] = get_from_post('mother_organization_name_for_oc');
        $family_organization_name['spouce_organization_name'] = get_from_post('spouce_organization_name_for_oc');
        $obc_certificate_data['family_organization_name'] = json_encode($family_organization_name);

        $family_designation_b1 = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_designation_b1['father_designation_b1'] = get_from_post('father_designation_b1_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_designation_b1['mother_designation_b1'] = get_from_post('mother_designation_b1_for_oc');
        $family_designation_b1['spouce_designation_b1'] = get_from_post('spouce_designation_b1_for_oc');
        $obc_certificate_data['family_designation_b1'] = json_encode($family_designation_b1);

        $family_service_period = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_service_period['father_service_period'] = get_from_post('father_service_period_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_service_period['mother_service_period'] = get_from_post('mother_service_period_for_oc');
        $family_service_period['spouce_service_period'] = get_from_post('spouce_service_period_for_oc');
        $obc_certificate_data['family_service_period'] = json_encode($family_service_period);

        $family_permanent_incapacitation_service = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_permanent_incapacitation_service['father_permanent_incapacitation_service'] = get_from_post('father_permanent_incapacitation_service_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_permanent_incapacitation_service['mother_permanent_incapacitation_service'] = get_from_post('mother_permanent_incapacitation_service_for_oc');
        $family_permanent_incapacitation_service['spouce_permanent_incapacitation_service'] = get_from_post('spouce_permanent_incapacitation_service_for_oc');
        $obc_certificate_data['family_permanent_incapacitation_service'] = json_encode($family_permanent_incapacitation_service);

        $family_permanent_incapacitation = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_permanent_incapacitation['father_permanent_incapacitation'] = get_from_post('father_permanent_incapacitation_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_permanent_incapacitation['mother_permanent_incapacitation'] = get_from_post('mother_permanent_incapacitation_for_oc');
        $family_permanent_incapacitation['spouce_permanent_incapacitation'] = get_from_post('spouce_permanent_incapacitation_for_oc');
        $obc_certificate_data['family_permanent_incapacitation'] = json_encode($family_permanent_incapacitation);

        $family_organization_name_partc = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_organization_name_partc['father_organization_name_partc'] = get_from_post('father_organization_name_partc_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_organization_name_partc['mother_organization_name_partc'] = get_from_post('mother_organization_name_partc_for_oc');
        $family_organization_name_partc['spouce_organization_name_partc'] = get_from_post('spouce_organization_name_partc_for_oc');
        $obc_certificate_data['family_organization_name_partc'] = json_encode($family_organization_name_partc);

        $family_designation_partc = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_designation_partc['father_designation_partc'] = get_from_post('father_designation_partc_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_designation_partc['mother_designation_partc'] = get_from_post('mother_designation_partc_for_oc');
        $family_designation_partc['spouce_designation_partc'] = get_from_post('spouce_designation_partc_for_oc');
        $obc_certificate_data['family_designation_partc'] = json_encode($family_designation_partc);

        $family_date_of_appointmet_partc = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_date_of_appointmet_partc['father_date_of_appointmet_partc'] = get_from_post('father_date_of_appointmet_partc_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_date_of_appointmet_partc['mother_date_of_appointmet_partc'] = get_from_post('mother_date_of_appointmet_partc_for_oc');
        $family_date_of_appointmet_partc['spouce_date_of_appointmet_partc'] = get_from_post('spouce_date_of_appointmet_partc_for_oc');
        $obc_certificate_data['family_date_of_appointmet_partc'] = json_encode($family_date_of_appointmet_partc);

        $family_designation_partd = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_designation_partd['father_designation_partd'] = get_from_post('father_designation_partd_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_designation_partd['mother_designation_partd'] = get_from_post('mother_designation_partd_for_oc');
        $family_designation_partd['spouce_designation_partd'] = get_from_post('spouce_designation_partd_for_oc');
        $obc_certificate_data['family_designation_partd'] = json_encode($family_designation_partd);

        $family_scale_of_pay_partd = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_scale_of_pay_partd['father_scale_of_pay_partd'] = get_from_post('father_scale_of_pay_partd_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_scale_of_pay_partd['mother_scale_of_pay_partd'] = get_from_post('mother_scale_of_pay_partd_for_oc');
        $family_scale_of_pay_partd['spouce_scale_of_pay_partd'] = get_from_post('spouce_scale_of_pay_partd_for_oc');
        $obc_certificate_data['family_scale_of_pay_partd'] = json_encode($family_scale_of_pay_partd);

        $family_occupation = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_occupation['father_occupation_family'] = get_from_post('father_occupation_family_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_occupation['mother_occupation_family'] = get_from_post('mother_occupation_family_for_oc');
        $family_occupation['spouce_occupation_family'] = get_from_post('spouce_occupation_family_for_oc');
        $obc_certificate_data['family_occupation'] = json_encode($family_occupation);

        $family_agricultural_land = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_agricultural_land['father_agricultural_land'] = get_from_post('father_agricultural_land_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_agricultural_land['mother_agricultural_land'] = get_from_post('mother_agricultural_land_for_oc');
        $family_agricultural_land['spouce_agricultural_land'] = get_from_post('spouce_agricultural_land_for_oc');
        $obc_certificate_data['family_agricultural_land'] = json_encode($family_agricultural_land);

        $family_location = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_location['father_location'] = get_from_post('father_location_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_location['mother_location'] = get_from_post('mother_location_for_oc');
        $family_location['spouce_location'] = get_from_post('spouce_location_for_oc');
        $obc_certificate_data['family_location'] = json_encode($family_location);

        $family_size_of_holding = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_size_of_holding['father_size_of_holding'] = get_from_post('father_size_of_holding_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_size_of_holding['mother_size_of_holding'] = get_from_post('mother_size_of_holding_for_oc');
        $family_size_of_holding['spouce_size_of_holding'] = get_from_post('spouce_size_of_holding_for_oc');
        $obc_certificate_data['family_size_of_holding'] = json_encode($family_size_of_holding);

        $family_irrigated = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_irrigated['father_irrigated'] = get_from_post('father_irrigated_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_irrigated['mother_irrigated'] = get_from_post('mother_irrigated_for_oc');
        $family_irrigated['spouce_irrigated'] = get_from_post('spouce_irrigated_for_oc');
        $obc_certificate_data['family_irrigated'] = json_encode($family_irrigated);

        $family_perecentage_of_irrigated = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_perecentage_of_irrigated['father_perecentage_of_irrigated'] = get_from_post('father_perecentage_of_irrigated_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_perecentage_of_irrigated['mother_perecentage_of_irrigated'] = get_from_post('mother_perecentage_of_irrigated_for_oc');
        $family_perecentage_of_irrigated['spouce_perecentage_of_irrigated'] = get_from_post('spouce_perecentage_of_irrigated_for_oc');
        $obc_certificate_data['family_perecentage_of_irrigated'] = json_encode($family_perecentage_of_irrigated);

        $family_ceiling_low = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_ceiling_low['father_ceiling_low'] = get_from_post('father_ceiling_low_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_ceiling_low['mother_ceiling_low'] = get_from_post('mother_ceiling_low_for_oc');
        $family_ceiling_low['spouce_ceiling_low'] = get_from_post('spouce_ceiling_low_for_oc');
        $obc_certificate_data['family_ceiling_low'] = json_encode($family_ceiling_low);

        $family_total_percentage = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_total_percentage['father_total_percentage'] = get_from_post('father_total_percentage_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_total_percentage['mother_total_percentage'] = get_from_post('mother_total_percentage_for_oc');
        $family_total_percentage['spouce_total_percentage'] = get_from_post('spouce_total_percentage_for_oc');
        $obc_certificate_data['family_total_percentage'] = json_encode($family_total_percentage);

        $family_crops = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_crops['father_crops'] = get_from_post('father_crops_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_crops['mother_crops'] = get_from_post('mother_crops_for_oc');
        $family_crops['spouce_crops'] = get_from_post('spouce_crops_for_oc');
        $obc_certificate_data['family_crops'] = json_encode($family_crops);

        $family_location_partf = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_location_partf['father_location_partf'] = get_from_post('father_location_partf_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_location_partf['mother_location_partf'] = get_from_post('mother_location_partf_for_oc');
        $family_location_partf['spouce_location_partf'] = get_from_post('spouce_location_partf_for_oc');
        $obc_certificate_data['family_location_partf'] = json_encode($family_location_partf);

        $family_area_plantation = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_area_plantation['father_area_plantation'] = get_from_post('father_area_plantation_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_area_plantation['mother_area_plantation'] = get_from_post('mother_area_plantation_for_oc');
        $family_area_plantation['spouce_area_plantation'] = get_from_post('spouce_area_plantation_for_oc');
        $obc_certificate_data['family_area_plantation'] = json_encode($family_area_plantation);

        $family_location_property = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_location_property['father_location_property'] = get_from_post('father_location_property_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_location_property['mother_location_property'] = get_from_post('mother_location_property_for_oc');
        $family_location_property['spouce_location_property'] = get_from_post('spouce_location_property_for_oc');
        $obc_certificate_data['family_location_property'] = json_encode($family_location_property);

        $family_details = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_details['father_details'] = get_from_post('father_details_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_details['mother_details'] = get_from_post('mother_details_for_oc');
        $family_details['spouce_details'] = get_from_post('spouce_details_for_oc');
        $obc_certificate_data['family_details'] = json_encode($family_details);

        $family_use_to_which = array();
        if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_use_to_which['father_use_to_which'] = get_from_post('father_use_to_which_for_oc');
        if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN)
            $family_use_to_which['mother_use_to_which'] = get_from_post('mother_use_to_which_for_oc');
        $family_use_to_which['spouce_use_to_which'] = get_from_post('spouce_use_to_which_for_oc');
        $obc_certificate_data['family_use_to_which'] = json_encode($family_use_to_which);

        $obc_certificate_data['family_annual_income'] = get_from_post('family_annual_income');
        $obc_certificate_data['tax_payer'] = get_from_post('tax_payer_for_obc_certificate');
        //$obc_certificate_data['tax_payer_copy'] = get_from_post('tax_payer_copy');
        $obc_certificate_data['wealth_tax'] = get_from_post('wealth_tax_for_obc_certificate');

        $obc_certificate_data['furnished_detail'] = $obc_certificate_data['wealth_tax'] == VALUE_ONE ? get_from_post('furnished_detail') : '';

        // $obc_certificate_data['furnished_detail'] = get_from_post('furnished_detail');
        $obc_certificate_data['purpose_of_obc_certificate'] = get_from_post('purpose_of_obc_certificate');
        $obc_certificate_data['any_remarks'] = get_from_post('any_remarks');

        $obc_certificate_data['if_grandfather_having_document'] = get_from_post('if_grandfather_having_document_for_obc_certificate');

        return $obc_certificate_data;
    }

    function _check_validation_for_obc_certificate($obc_certificate_data) {
        if (!$obc_certificate_data['constitution_artical']) {
            return SELECT_APPLICATION_MESSAGE;
        }
        if (!$obc_certificate_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$obc_certificate_data['village_name']) {
            return VILLAGE_NAME_MESSAGE;
        }
        if (!$obc_certificate_data['applicant_name']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if ($obc_certificate_data['constitution_artical'] == VALUE_TWO) {
            if (!$obc_certificate_data['relationship_of_applicant']) {
                return RELATION_WITH_DECEASED_PERSON_MESSAGE;
            }
            if (!$obc_certificate_data['guardian_address']) {
                return GUARDIAN_ADDRESS_MESSAGE;
            }
            if (!$obc_certificate_data['guardian_mobile_no']) {
                return MOBILE_NUMBER_MESSAGE;
            }
            if (!$obc_certificate_data['guardian_aadhaar']) {
                return INVALID_AADHAR_MESSAGE;
            }
            if (!$obc_certificate_data['minor_child_name']) {
                return MINOR_CHILD_NAME_MESSAGE;
            }
        }

        if (!$obc_certificate_data['com_addr_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$obc_certificate_data['com_addr_street']) {
            return STREET_MESSAGE;
        }
        if (!$obc_certificate_data['com_addr_village_dmc_ward']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$obc_certificate_data['com_addr_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$obc_certificate_data['com_pincode']) {
            return PINCODE_MESSAGE;
        }
        if (!$obc_certificate_data['per_addr_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$obc_certificate_data['per_addr_street']) {
            return STREET_MESSAGE;
        }
        if (!$obc_certificate_data['per_addr_village_dmc_ward']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$obc_certificate_data['per_addr_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$obc_certificate_data['per_pincode']) {
            return PINCODE_MESSAGE;
        }
        if ($obc_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$obc_certificate_data['mobile_number']) {
                return MOBILE_NUMBER_MESSAGE;
            }
        }
        if (!$obc_certificate_data['applicant_nationality']) {
            return APPLICANT_NATIONALITY_MESSAGE;
        }
        if ($obc_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$obc_certificate_data['applicant_education']) {
                return APPLICANT_EDUCATION_MESSAGE;
            }
            if (!$obc_certificate_data['name_of_school']) {
                return SCHOOL_NAME_MESSAGE;
            }
        }
        if ($obc_certificate_data['constitution_artical'] == VALUE_TWO) {

            if (!$obc_certificate_data['minor_education']) {
                return APPLICANT_EDUCATION_MESSAGE;
            }
        }
        if (!$obc_certificate_data['applicant_age']) {
            return APPLICANT_AGE_MESSAGE;
        }
        if (!$obc_certificate_data['born_place_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$obc_certificate_data['born_place_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$obc_certificate_data['born_place_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$obc_certificate_data['native_place_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$obc_certificate_data['native_place_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$obc_certificate_data['native_place_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$obc_certificate_data['gender']) {
            return GENDER_MESSAGE;
        }
        if ($obc_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$obc_certificate_data['marital_status']) {
                return MARRITIAL_STATUS_MESSAGE;
            }
        }
        if (!$obc_certificate_data['obccaste']) {
            return CASTES_MESSAGE;
        }
        if (!$obc_certificate_data['religion']) {
            return RELIGION_MESSAGE;
        }
        if (!$obc_certificate_data['nearest_police_station']) {
            return NEAREST_POLICE_STATION_MESSAGE;
        }
        if ($obc_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$obc_certificate_data['occupation']) {
                return OCCUPATION_MESSAGE;
            }
            if ($obc_certificate_data['occupation'] == VALUE_TWELVE) {
                if (!$obc_certificate_data['other_occupation']) {
                    return OTHER_OCCUPATION_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$obc_certificate_data['applicant_education']) {
                return APPLICANT_EDUCATION_MESSAGE;
            }
            if ($obc_certificate_data['applicant_education'] == VALUE_FIVE) {
                if (!$obc_certificate_data['other_education']) {
                    return APPLICANT_EDUCATION_MESSAGE;
                }
            }
            if (!$obc_certificate_data['name_of_school']) {
                return SCHOOL_NAME_MESSAGE;
            }
        }


//        if (!$obc_certificate_data['father_name']) {
//            return FATHER_NAME_MESSAGE;
//        }
//        if (!$obc_certificate_data['father_nationality']) {
//            return APPLICANT_NATIONALITY_MESSAGE;
//        }
//        if (!$obc_certificate_data['father_born_place_state']) {
//            return SELECT_STATE_MESSAGE;
//        }
//        if (!$obc_certificate_data['father_born_place_district']) {
//            return DISTRICT_MESSAGE;
//        }
//        if (!$obc_certificate_data['father_born_place_village']) {
//            return SELECT_VILLAGE_MESSAGE;
//        }
//
//        if (!$obc_certificate_data['father_native_place_district']) {
//            return DISTRICT_MESSAGE;
//        }
//        if (!$obc_certificate_data['father_city']) {
//            return SELECT_CITY_MESSAGE;
//        }
//        if (!$obc_certificate_data['father_native_place_village']) {
//            return SELECT_VILLAGE_MESSAGE;
//        }
//        if (!$obc_certificate_data['father_religion']) {
//            return RELIGION_MESSAGE;
//        }
//        if (!$obc_certificate_data['father_caste']) {
//            return CASTES_MESSAGE;
//        }
//        if ($obc_certificate_data['father_alive'] == VALUE_ONE) {
//
//            if (!$obc_certificate_data['father_annual_income']) {
//                return ANNUAL_INCOME_MESSAGE;
//            }
//
//            if (!$obc_certificate_data['father_aadhaar']) {
//                return INVALID_AADHAR_MESSAGE;
//            }
//            if (!$obc_certificate_data['father_election_no']) {
//                return ELECTION_NUMBER_MESSAGE;
//            }
//
//            if (!$obc_certificate_data['father_occupation']) {
//                return OCCUPATION_MESSAGE;
//            }
//            if ($obc_certificate_data['father_occupation'] == VALUE_TWELVE) {
//                if (!$obc_certificate_data['father_other_occupation']) {
//                    return OTHER_OCCUPATION_MESSAGE;
//                }
//            }
//        }
//
//
//        if (!$obc_certificate_data['mother_name']) {
//            return FATHER_NAME_MESSAGE;
//        }
//        if (!$obc_certificate_data['mother_nationality']) {
//            return APPLICANT_NATIONALITY_MESSAGE;
//        }
//        if (!$obc_certificate_data['mother_born_place_state']) {
//            return SELECT_STATE_MESSAGE;
//        }
//        if (!$obc_certificate_data['mother_born_place_district']) {
//            return DISTRICT_MESSAGE;
//        }
//        if (!$obc_certificate_data['mother_born_place_village']) {
//            return SELECT_VILLAGE_MESSAGE;
//        }
//        if (!$obc_certificate_data['mother_native_place_state']) {
//            return SELECT_STATE_MESSAGE;
//        }
//        if (!$obc_certificate_data['mother_native_place_district']) {
//            return DISTRICT_MESSAGE;
//        }
//        if (!$obc_certificate_data['mother_native_place_village']) {
//            return SELECT_VILLAGE_MESSAGE;
//        }
//        if (!$obc_certificate_data['mother_religion']) {
//            return RELIGION_MESSAGE;
//        }
//        if (!$obc_certificate_data['mother_caste']) {
//            return CASTES_MESSAGE;
//        }
//        if ($obc_certificate_data['mother_alive'] == VALUE_ONE) {
//
//            if (!$obc_certificate_data['mother_annual_income']) {
//                return ANNUAL_INCOME_MESSAGE;
//            }
//            if (!$obc_certificate_data['mother_aadhaar']) {
//                return INVALID_AADHAR_MESSAGE;
//            }
//            if (!$obc_certificate_data['mother_election_no']) {
//                return ELECTION_NUMBER_MESSAGE;
//            }
//            if (!get_from_post('mother_occupation')) {
//                return OCCUPATION_MESSAGE;
//            }
//            if (get_from_post('mother_occupation') == VALUE_TWELVE) {
//                if (!$obc_certificate_data['mother_other_occupation']) {
//                    return OTHER_OCCUPATION_MESSAGE;
//                }
//            }
//        }
//
//        if (!$obc_certificate_data['grandfather_name']) {
//            return APPLICANT_NAME_MESSAGE;
//        }
//        if (!$obc_certificate_data['grandfather_nationality']) {
//            return APPLICANT_NATIONALITY_MESSAGE;
//        }
//        if (!$obc_certificate_data['grandfather_born_place_district']) {
//            return SELECT_STATE_MESSAGE;
//        }
//        if (!$obc_certificate_data['grandfather_borncity']) {
//            return SELECT_CITY_MESSAGE;
//        }
//        if (!$obc_certificate_data['grandfather_born_place_village']) {
//            return SELECT_VILLAGE_MESSAGE;
//        }
//        if (!$obc_certificate_data['grandfather_native_place_district']) {
//            return DISTRICT_MESSAGE;
//        }
//        if (!$obc_certificate_data['grandfather_city']) {
//            return SELECT_CITY_MESSAGE;
//        }
//        if (!$obc_certificate_data['grandfather_native_place_village']) {
//            return SELECT_VILLAGE_MESSAGE;
//        }
//        if (!$obc_certificate_data['grandfather_religion']) {
//            return RELIGION_MESSAGE;
//        }
//        if (!$obc_certificate_data['grandfather_caste']) {
//            return CASTES_MESSAGE;
//        }
//        if ($obc_certificate_data['grandfather_alive'] == VALUE_ONE) {
//
//            if (!$obc_certificate_data['grandfather_aadhaar']) {
//                return INVALID_AADHAR_MESSAGE;
//            }
//            if (!$obc_certificate_data['grandfather_election_no']) {
//                return ELECTION_NUMBER_MESSAGE;
//            }
//            if (!$obc_certificate_data['grandfather_occupation']) {
//                return OCCUPATION_MESSAGE;
//            }
//            if ($obc_certificate_data['grandfather_occupation'] == VALUE_TWELVE) {
//                if (!$obc_certificate_data['grandfather_other_occupation']) {
//                    return OTHER_OCCUPATION_MESSAGE;
//                }
//            }
//        }
//
//
//
//
//
//        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
//            if (!$obc_certificate_data['spouse_name']) {
//                return FATHER_NAME_MESSAGE;
//            }
//            if (!$obc_certificate_data['spouse_nationality']) {
//                return APPLICANT_NATIONALITY_MESSAGE;
//            }
//            if (!$obc_certificate_data['spouse_born_place_state']) {
//                return SELECT_STATE_MESSAGE;
//            }
//            if (!$obc_certificate_data['spouse_born_place_district']) {
//                return DISTRICT_MESSAGE;
//            }
//            if (!$obc_certificate_data['spouse_born_place_village']) {
//                return SELECT_VILLAGE_MESSAGE;
//            }
//            if (!$obc_certificate_data['spouse_native_place_state']) {
//                return SELECT_STATE_MESSAGE;
//            }
//            if (!$obc_certificate_data['spouse_native_place_district']) {
//                return DISTRICT_MESSAGE;
//            }
//            if (!$obc_certificate_data['spouse_native_place_village']) {
//                return SELECT_VILLAGE_MESSAGE;
//            }
//            if (!$obc_certificate_data['spouse_religion']) {
//                return RELIGION_MESSAGE;
//            }
//            if (!$obc_certificate_data['spouse_caste']) {
//                return CASTES_MESSAGE;
//            }
//            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE) {
//
//                if (!$obc_certificate_data['spouse_annual_income']) {
//                    return ANNUAL_INCOME_MESSAGE;
//                }
//                if (!$obc_certificate_data['spouse_aadhaar']) {
//                    return INVALID_AADHAR_MESSAGE;
//                }
//                if (!$obc_certificate_data['spouse_election_no']) {
//                    return ELECTION_NUMBER_MESSAGE;
//                }
//                if (!$obc_certificate_data['spouse_occupation']) {
//                    return OCCUPATION_MESSAGE;
//                }
//                if ($obc_certificate_data['spouse_occupation'] == VALUE_TWELVE) {
//                    if (!$obc_certificate_data['spouse_other_occupation']) {
//                        return OTHER_OCCUPATION_MESSAGE;
//                    }
//                }
//            }
//        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_designation_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_designation_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_designation_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_designation_b_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_designation_b_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_designation_b_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_scale_of_pay_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_scale_of_pay_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_scale_of_pay_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_appointment_date_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_appointment_date_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_appointment_date_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_promotion_age_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_promotion_age_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_promotion_age_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_organization_name_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_organization_name_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_organization_name_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_designation_b1_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_designation_b1_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_designation_b1_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_service_period_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_service_period_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_service_period_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_permanent_incapacitation_service_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_permanent_incapacitation_service_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_permanent_incapacitation_service_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_permanent_incapacitation_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_permanent_incapacitation_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_permanent_incapacitation_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_organization_name_partc_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_organization_name_partc_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_organization_name_partc_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_designation_partc_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_designation_partc_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_designation_partc_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_date_of_appointmet_partc_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_date_of_appointmet_partc_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_date_of_appointmet_partc_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_designation_partd_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_designation_partd_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_designation_partd_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_scale_of_pay_partd_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_scale_of_pay_partd_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_scale_of_pay_partd_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_occupation_family_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_occupation_family_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_occupation_family_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_location_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_location_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }


        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_location_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_size_of_holding_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_size_of_holding_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_size_of_holding_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_irrigated']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_irrigated']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_irrigated']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_perecentage_of_irrigated_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_perecentage_of_irrigated_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_perecentage_of_irrigated_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_ceiling_low_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_ceiling_low_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_ceiling_low_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_total_percentage_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_total_percentage_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_total_percentage_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_crops_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_crops_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_crops_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_location_partf_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_location_partf_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_location_partf_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }

        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_area_plantation_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_area_plantation_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_area_plantation_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_location_property_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_location_property_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_location_property_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_details_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_details_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_details_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if ($obc_certificate_data['father_alive'] == VALUE_ONE && $obc_certificate_data['father_alive'] == VALUE_TWO) {
            if (get_from_post('father_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['father_use_to_which_for_oc']) {
                    return FATHER_GOV_MESSAGE;
                }
            }
        }
        if ($obc_certificate_data['mother_alive'] == VALUE_ONE && $obc_certificate_data['mother_alive'] == VALUE_TWO) {
            if (get_from_post('mother_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!$obc_certificate_data['mother_use_to_which_for_oc']) {
                    return MOTHER_GOV_MESSAGE;
                }
            }
        }

        if ($obc_certificate_data['marital_status'] == VALUE_ONE) {
            if ($obc_certificate_data['spouse_alive'] == VALUE_ONE && $obc_certificate_data['spouse_alive'] == VALUE_TWO) {
                if (get_from_post('spouse_occupation') == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!$obc_certificate_data['spouce_use_to_which_for_oc']) {
                        return SPOUCE_GOV_MESSAGE;
                    }
                }
            }
        }
        if (!$obc_certificate_data['tax_payer']) {
            return SELECT_ANY_MESSAGE;
        }
        if (!$obc_certificate_data['wealth_tax']) {
            return SELECT_ANY_MESSAGE;
        }
        if ($obc_certificate_data['wealth_tax'] == VALUE_ONE) {
            if (!$obc_certificate_data['furnished_detail']) {
                return FURNISHED_DETAIL_MESSAGE;
            }
        }

        if (!$obc_certificate_data['purpose_of_obc_certificate']) {
            return PURPOSE_OF_OBC_MESSAGE;
        }
        if (!$obc_certificate_data['any_remarks']) {
            return REMARKS_MESSAGE;
        }

        return '';
    }

    function submit_obc_certificate_father_detail() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $obc_certificate_id = get_from_post('obc_certificate_id');
            $obc_certificate_father_detail_data = $this->_get_post_data_for_obc_certificate_father_detail();
            // $validation_message = $this->_check_validation_for_obc_certificate_father_detail($obc_certificate_father_detail_data);
            // if ($validation_message != '') {
            //     echo json_encode(get_error_array($validation_message));
            //     return false;
            // }

            $this->db->trans_start();
            $obc_certificate_father_detail_data['updated_by'] = $user_id;
            $obc_certificate_father_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $obc_certificate_father_detail_data);

            $new_obc_certificate_father_detail_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($obc_certificate_id);
            $new_obc_certificate_father_detail_data['obc_certificate_id'] = $obc_certificate_id;
            $new_obc_certificate_father_detail_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['obc_certificate_data'] = $new_obc_certificate_father_detail_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_obc_certificate_father_detail() {
        $obc_certificate_father_detail_data = array();

        $obc_certificate_father_detail_data['father_name'] = get_from_post('father_name');
        $obc_certificate_father_detail_data['father_house_no'] = get_from_post('father_house_no');
        $obc_certificate_father_detail_data['father_house_name'] = get_from_post('father_house_name');
        $obc_certificate_father_detail_data['father_street'] = get_from_post('father_street');
        $obc_certificate_father_detail_data['father_village_dmc_ward'] = get_from_post('father_village_dmc_ward');
        $obc_certificate_father_detail_data['father_city'] = get_from_post('father_city');
        $obc_certificate_father_detail_data['father_nationality'] = get_from_post('father_nationality');
        $obc_certificate_father_detail_data['father_born_place_state'] = get_from_post('father_born_place_state');
        $obc_certificate_father_detail_data['father_born_place_district'] = get_from_post('father_born_place_district');
        $obc_certificate_father_detail_data['father_born_place_village'] = get_from_post('father_born_place_village');
        $obc_certificate_father_detail_data['father_native_place_state'] = get_from_post('father_native_place_state');
        $obc_certificate_father_detail_data['father_native_place_district'] = get_from_post('father_native_place_district');
        $obc_certificate_father_detail_data['father_native_place_village'] = get_from_post('father_native_place_village');
        $obc_certificate_father_detail_data['father_occupation'] = get_from_post('father_occupation');
        if ($obc_certificate_father_detail_data['father_occupation'] == VALUE_TWELVE)
            $obc_certificate_father_detail_data['father_other_occupation'] = get_from_post('father_other_occupation');
        $obc_certificate_father_detail_data['father_aadhaar'] = get_from_post('father_aadhaar');
        $obc_certificate_father_detail_data['father_election_no'] = get_from_post('father_election_no');

        return $obc_certificate_father_detail_data;
    }

    function _check_validation_for_obc_certificate_father_detail($obc_certificate_father_detail_data) {

        if (!$obc_certificate_father_detail_data['father_name']) {
            return FATHER_NAME_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_house_name']) {
            return HOUSE_NAME_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_street']) {
            return STREET_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_village_dmc_ward']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_nationality']) {
            return APPLICANT_NATIONALITY_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_born_place_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_born_place_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_born_place_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_native_place_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_native_place_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_native_place_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$obc_certificate_father_detail_data['father_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if ($obc_certificate_father_detail_data['father_occupation'] == VALUE_TWELVE) {
            if (!$obc_certificate_father_detail_data['father_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }
        // if (!$obc_certificate_father_detail_data['father_aadhaar'] ) { 
        //     return INVALID_AADHAR_MESSAGE;
        // }
        // if (!$obc_certificate_father_detail_data['father_election_no'] ) { 
        //     return ELECTION_NUMBER_MESSAGE;
        // }
        return '';
    }

    function submit_obc_certificate_mother_detail() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $obc_certificate_id = get_from_post('obc_certificate_id');
            $obc_certificate_mother_detail_data = $this->_get_post_data_for_obc_certificate_mother_detail();
            // $validation_message = $this->_check_validation_for_obc_certificate_mother_detail($obc_certificate_mother_detail_data);
            // if ($validation_message != '') {
            //     echo json_encode(get_error_array($validation_message));
            //     return false;
            // }

            $this->db->trans_start();
            $obc_certificate_mother_detail_data['updated_by'] = $user_id;
            $obc_certificate_mother_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $obc_certificate_mother_detail_data);

            $new_obc_certificate_mother_detail_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($obc_certificate_id);
            $new_obc_certificate_mother_detail_data['obc_certificate_id'] = $obc_certificate_id;
            $new_obc_certificate_mother_detail_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['obc_certificate_data'] = $new_obc_certificate_mother_detail_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_obc_certificate_mother_detail() {
        $obc_certificate_mother_detail_data = array();

        $obc_certificate_mother_detail_data['mother_name'] = get_from_post('mother_name');
        $obc_certificate_mother_detail_data['mother_house_no'] = get_from_post('mother_house_no');
        $obc_certificate_mother_detail_data['mother_house_name'] = get_from_post('mother_house_name');
        $obc_certificate_mother_detail_data['mother_street'] = get_from_post('mother_street');
        $obc_certificate_mother_detail_data['mother_village_dmc_ward'] = get_from_post('mother_village_dmc_ward');
        $obc_certificate_mother_detail_data['mother_city'] = get_from_post('mother_city');
        $obc_certificate_mother_detail_data['mother_nationality'] = get_from_post('mother_nationality');
        $obc_certificate_mother_detail_data['mother_born_place_state'] = get_from_post('mother_born_place_state');
        $obc_certificate_mother_detail_data['mother_born_place_district'] = get_from_post('mother_born_place_district');
        $obc_certificate_mother_detail_data['mother_born_place_village'] = get_from_post('mother_born_place_village');
        $obc_certificate_mother_detail_data['mother_native_place_state'] = get_from_post('mother_native_place_state');
        $obc_certificate_mother_detail_data['mother_native_place_district'] = get_from_post('mother_native_place_district');
        $obc_certificate_mother_detail_data['mother_native_place_village'] = get_from_post('mother_native_place_village');
        $obc_certificate_mother_detail_data['mother_occupation'] = get_from_post('mother_occupation');
        if ($obc_certificate_mother_detail_data['mother_occupation'] == VALUE_TWELVE)
            $obc_certificate_mother_detail_data['mother_other_occupation'] = get_from_post('mother_other_occupation');
        $obc_certificate_mother_detail_data['mother_aadhaar'] = get_from_post('mother_aadhaar');
        $obc_certificate_mother_detail_data['mother_election_no'] = get_from_post('mother_election_no');

        return $obc_certificate_mother_detail_data;
    }

    function _check_validation_for_obc_certificate_mother_detail($obc_certificate_mother_detail_data) {

        if (!$obc_certificate_mother_detail_data['mother_name']) {
            return FATHER_NAME_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_house_name']) {
            return HOUSE_NAME_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_street']) {
            return STREET_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_village_dmc_ward']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_nationality']) {
            return APPLICANT_NATIONALITY_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_born_place_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_born_place_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_born_place_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_native_place_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_native_place_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_native_place_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$obc_certificate_mother_detail_data['mother_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if ($obc_certificate_mother_detail_data['mother_occupation'] == VALUE_TWELVE) {
            if (!$obc_certificate_mother_detail_data['mother_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }
        // if (!$obc_certificate_mother_detail_data['mother_aadhaar'] ) { 
        //     return INVALID_AADHAR_MESSAGE;
        // }
        // if (!$obc_certificate_mother_detail_data['mother_election_no'] ) { 
        //     return ELECTION_NUMBER_MESSAGE;
        // }
        return '';
    }

    function submit_obc_certificate_spouse_detail() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $obc_certificate_id = get_from_post('obc_certificate_id');
            $obc_certificate_spouse_detail_data = $this->_get_post_data_for_obc_certificate_spouse_detail();
            // $validation_message = $this->_check_validation_for_obc_certificate_spouse_detail($obc_certificate_spouse_detail_data);
            // if ($validation_message != '') {
            //     echo json_encode(get_error_array($validation_message));
            //     return false;
            // }

            $this->db->trans_start();
            $obc_certificate_spouse_detail_data['updated_by'] = $user_id;
            $obc_certificate_spouse_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $obc_certificate_spouse_detail_data);

            $new_obc_certificate_spouse_detail_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            $success_array = get_success_array();
            $success_array['encrypt_id'] = get_encrypt_id($obc_certificate_id);
            $new_obc_certificate_spouse_detail_data['obc_certificate_id'] = $obc_certificate_id;
            $new_obc_certificate_spouse_detail_data['encrypt_id'] = $success_array['encrypt_id'];
            $success_array['obc_certificate_data'] = $new_obc_certificate_spouse_detail_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_obc_certificate_spouse_detail() {
        $obc_certificate_spouse_detail_data = array();

        $obc_certificate_spouse_detail_data['spouse_name'] = get_from_post('spouse_name');
        $obc_certificate_spouse_detail_data['spouse_house_no'] = get_from_post('spouse_house_no');
        $obc_certificate_spouse_detail_data['spouse_house_name'] = get_from_post('spouse_house_name');
        $obc_certificate_spouse_detail_data['spouse_street'] = get_from_post('spouse_street');
        $obc_certificate_spouse_detail_data['spouse_village_dmc_ward'] = get_from_post('spouse_village_dmc_ward');
        $obc_certificate_spouse_detail_data['spouse_city'] = get_from_post('spouse_city');
        $obc_certificate_spouse_detail_data['spouse_nationality'] = get_from_post('spouse_nationality');
        $obc_certificate_spouse_detail_data['spouse_born_place_state'] = get_from_post('spouse_born_place_state');
        $obc_certificate_spouse_detail_data['spouse_born_place_district'] = get_from_post('spouse_born_place_district');
        $obc_certificate_spouse_detail_data['spouse_born_place_village'] = get_from_post('spouse_born_place_village');
        $obc_certificate_spouse_detail_data['spouse_native_place_state'] = get_from_post('spouse_native_place_state');
        $obc_certificate_spouse_detail_data['spouse_native_place_district'] = get_from_post('spouse_native_place_district');
        $obc_certificate_spouse_detail_data['spouse_native_place_village'] = get_from_post('spouse_native_place_village');
        $obc_certificate_spouse_detail_data['spouse_occupation'] = get_from_post('spouse_occupation');
        if ($obc_certificate_spouse_detail_data['spouse_occupation'] == VALUE_TWELVE)
            $obc_certificate_spouse_detail_data['spouse_other_occupation'] = get_from_post('spouse_other_occupation');
        $obc_certificate_spouse_detail_data['spouse_aadhaar'] = get_from_post('spouse_aadhaar');
        $obc_certificate_spouse_detail_data['spouse_election_no'] = get_from_post('spouse_election_no');

        return $obc_certificate_spouse_detail_data;
    }

    function _check_validation_for_obc_certificate_spouse_detail($obc_certificate_spouse_detail_data) {

        if (!$obc_certificate_spouse_detail_data['spouse_name']) {
            return FATHER_NAME_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_house_name']) {
            return HOUSE_NAME_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_street']) {
            return STREET_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_village_dmc_ward']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_nationality']) {
            return APPLICANT_NATIONALITY_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_born_place_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_born_place_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_born_place_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_native_place_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_native_place_district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_native_place_village']) {
            return SELECT_VILLAGE_MESSAGE;
        }
        if (!$obc_certificate_spouse_detail_data['spouse_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if ($obc_certificate_spouse_detail_data['spouse_occupation'] == VALUE_TWELVE) {
            if (!$obc_certificate_spouse_detail_data['spouse_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }
        // if (!$obc_certificate_spouse_detail_data['spouse_aadhaar'] ) { 
        //     return INVALID_AADHAR_MESSAGE;
        // }
        // if (!$obc_certificate_spouse_detail_data['spouse_election_no'] ) { 
        //     return ELECTION_NUMBER_MESSAGE;
        // }
        return '';
    }

    function submit_obc_certificate_upload_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            if (!is_post() || $user_id == NULL || !$user_id || ($module_type != VALUE_ONE && $module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $obc_certificate_id = get_from_post('obc_certificate_id');
            $obc_certificate_data['have_you_own_house'] = get_from_post('have_you_own_house_for_obc_certificate');

            $this->db->trans_start();
            $obc_certificate_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $obc_certificate_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$obc_certificate_id || $obc_certificate_id == NULL) {
                $obc_certificate_data['user_id'] = $user_id;
                $obc_certificate_data['created_by'] = $user_id;
                $obc_certificate_data['created_time'] = date('Y-m-d H:i:s');
                $obc_certificate_data['declaration'] = VALUE_ONE;
                $obc_certificate_id = $this->utility_model->insert_data('obc_certificate', $obc_certificate_data);
            } else {
                $obc_certificate_data['updated_by'] = $user_id;
                $obc_certificate_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $obc_certificate_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            //$success_array['message'] = $module_type == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_SUBMITTED_MESSAGE;
            $success_array['message'] = APP_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function reverify_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $obc_certificate_id = get_from_post('obc_certificate_id_for_obc_certificate_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$obc_certificate_id || $obc_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if (!is_mamlatdar_user() && !is_talathi_user() && !is_aci_user()) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            if (is_mamlatdar_user()) {
                $update_data['to_type_reverify'] = get_from_post('to_type_reverify_for_obc_certificate');
                if (!$update_data['to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['mam_reverify_remarks'] = get_from_post('mam_reverify_remarks_for_obc_certificate');
                if (!$update_data['mam_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['mam_to_reverify_datetime'] = date('Y-m-d H:i:s');
                $update_data['status'] = VALUE_THREE;
            }
            if (is_talathi_user()) {
                $update_data['talathi_to_type_reverify'] = get_from_post('talathi_to_type_reverify_for_obc_certificate');
                if (!$update_data['talathi_to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['residing_year_as_per_talathi_reverify'] = get_from_post('residing_year_as_per_talathi_reverify_for_obc_certificate');

                $update_data['is_upload_reverification_doc'] = get_from_post('upload_reverification_document_for_obc_certificate');
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
                    $this->_update_field_doc_items($session_user_id, $obc_certificate_id, $exi_field_doc_items, $new_field_doc_items);
                }
                $update_data['talathi_reverify_remarks'] = get_from_post('talathi_reverify_remarks_for_obc_certificate');
                if (!$update_data['talathi_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['talathi_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_aci_user()) {
                $update_data['cert_type_reverify'] = get_from_post('cert_type_reverify_for_obc_certificate');
                if (!$update_data['cert_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['aci_rec_reverify'] = get_from_post('aci_rec_reverify_for_obc_certificate');
                if (!$update_data['aci_rec_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['aci_reverify_remarks'] = get_from_post('aci_reverify_remarks_for_obc_certificate');
                if (!$update_data['aci_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($update_data['aci_rec_reverify'] == VALUE_ONE) {
                    $update_data['aci_to_ldc'] = get_from_post('aci_to_ldc_reverify_for_obc_certificate');
                    if (!$update_data['aci_to_ldc']) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                    $update_data['aci_to_ldc_datetime'] = date('Y-m-d H:i:s');
                }
                if ($update_data['aci_rec_reverify'] == VALUE_THREE) {
                    $update_data['aci_to_ldc'] = get_from_post('aci_to_ldc1_reverify_for_obc_certificate');
                    if (!$update_data['aci_to_ldc']) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                    $update_data['aci_to_ldc_datetime'] = date('Y-m-d H:i:s');
                }
                $update_data['aci_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $update_data);
            $obc_certificate_data = $this->obc_certificate_model->get_basic_data_for_cc($obc_certificate_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = is_mamlatdar_user() ? APP_REVERIFY_MESSAGE : APP_FORWARDED_MESSSAGE;
            $success_array['obc_certificate_data'] = $obc_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    // function approve_application() {
    //     $session_user_id = get_from_session('temp_id_for_sugam_admin');
    //     $obc_certificate_id = get_from_post('obc_certificate_id_for_obc_certificate_approve');
    //     if (!is_post() || $session_user_id == NULL || !$session_user_id || !$obc_certificate_id || $obc_certificate_id == NULL) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //     $update_data = array();
    //     $update_data['remarks'] = get_from_post('remarks_for_obc_certificate_approve');
    //     if (!$update_data['remarks']) {
    //         echo json_encode(get_error_array(REMARKS_MESSAGE));
    //         return false;
    //     }
    //     $this->db->trans_start();
    //     $ex_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
    //     if (empty($ex_data)) {
    //         echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
    //         return false;
    //     }
    //       $commu_add_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $ex_data['commu_add_state'], 'state', NULL, NULL);
    //     $commu_add_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $ex_data['commu_add_district'], 'district', NULL, NULL);
    //     $commu_add_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $ex_data['commu_add_village'], 'all_villages', NULL, NULL);
    //    $ex_data['commu_add_state_name'] = $commu_add_state_name_data['state_name'];
    //     $ex_data['commu_add_district_name'] = $commu_add_district_name_data['district_name'];
    //     $ex_data['commu_add_village_name'] = $commu_add_village_name_data['village_name'];
    //     $update_data['processing_days'] = get_days_in_dates($ex_data['submitted_datetime']);
    //     $update_data['status'] = VALUE_FIVE;
    //     $update_data['status_datetime'] = date('Y-m-d H:i:s');
    //     $update_data['updated_by'] = $session_user_id;
    //     $update_data['updated_time'] = date('Y-m-d H:i:s');
    //     $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $update_data);
    //     $this->db->trans_complete();
    //     if ($this->db->trans_status() === FALSE) {
    //         echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
    //         return;
    //     }
    //     $success_array = get_success_array();
    //     $success_array['message'] = APP_APPROVED_MESSAGE;
    //     echo json_encode($success_array);
    // }


    function approve_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $obc_certificate_id = get_from_post('obc_certificate_id_for_obc_certificate_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$obc_certificate_id || $obc_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_obc_certificate_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_FIVE, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $update_data);

            $ex_data['status'] = $update_data['status'];
            $ex_data['status_datetime'] = $update_data['status_datetime'];
            error_reporting(E_ERROR);
            $data = array('obc_certificate_data' => $ex_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->showWatermarkImage = true;
            if ($ex_data['aci_rec'] == VALUE_THREE) {
                $mpdf->WriteHTML($this->load->view('obc_certificate/migrant_certificate', $data, TRUE));
            } else if ($ex_data['aci_rec_reverify'] == VALUE_THREE) {
                $mpdf->WriteHTML($this->load->view('obc_certificate/migrant_certificate', $data, TRUE));
            } else {
                $mpdf->WriteHTML($this->load->view('obc_certificate/certificate', $data, TRUE));
            }
            $certificate_path = 'documents/temp/final_certificate_oc-' . $obc_certificate_id . rand(111111111, 99999999) . '_' . time() . '.pdf';
            $mpdf->Output($certificate_path, 'F');
            $cerificate_data = array();
            $cerificate_data['certificate'] = chunk_split(base64_encode(file_get_contents($certificate_path)));
            $cerificate_data['module_id'] = $obc_certificate_id;
            $cerificate_data['module_type'] = VALUE_FIVE;
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
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_FIVE, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_FIVE, $ex_data);
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
            $obc_certificate_id = get_from_post('obc_certificate_id_for_obc_certificate_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$obc_certificate_id || $obc_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_obc_certificate_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_FIVE, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_FIVE, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_FIVE, $ex_data);
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

    function get_obc_certificate_data_by_obc_certificate_id() {
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
            $obc_certificate_id = get_from_post('obc_certificate_id');
            if (!$obc_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            // $obc_certificate_data = $this->utility_model->get_by_id_with_applicant_name('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            // if (empty($obc_certificate_data)) {
            //     echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            //     return false;
            // }
            $obc_certificate_data = $this->obc_certificate_model->get_basic_data_for_cc($obc_certificate_id);
            if (empty($obc_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['obc_certificate_data'] = $obc_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    // function download_certificate() {
    //     $user_id = get_from_session('temp_id_for_sugam_admin');
    //     $obc_certificate_id = get_from_post('obc_certificate_id_for_certificate');
    //     if (!is_post() || $user_id == null || !$user_id || $obc_certificate_id == null || !$obc_certificate_id) {
    //         print_r(INVALID_ACCESS_MESSAGE);
    //         return false;
    //     }
    //     $this->db->trans_start();
    //     $existing_obc_certificate_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
    //     if (empty($existing_obc_certificate_data)) {
    //         print_r(INVALID_ACCESS_MESSAGE);
    //         return;
    //     }
    //     if ($existing_obc_certificate_data['status'] != VALUE_FIVE) {
    //         print_r(INVALID_ACCESS_MESSAGE);
    //         return;
    //     }
    //     $commu_add_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $existing_obc_certificate_data['commu_add_state'], 'state', NULL, NULL);
    //     $commu_add_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $existing_obc_certificate_data['commu_add_district'], 'district', NULL, NULL);
    //     $commu_add_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $existing_obc_certificate_data['commu_add_village'], 'all_villages', NULL, NULL);
    //     $existing_obc_certificate_data['commu_add_state_name'] = $commu_add_state_name_data['state_name'];
    //     $existing_obc_certificate_data['commu_add_district_name'] = $commu_add_district_name_data['district_name'];
    //     $existing_obc_certificate_data['commu_add_village_name'] = $commu_add_village_name_data['village_name'];
    //     $this->db->trans_complete();
    //     if ($this->db->trans_status() === false) {
    //         print_r(DATABASE_ERROR_MESSAGE);
    //         return;
    //     }
    //     error_reporting(E_ERROR);
    //     $data = array('obc_certificate_data' => $existing_obc_certificate_data);
    //     $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
    //     $mpdf->WriteHTML($this->load->view('obc_certificate/certificate', $data, TRUE));
    //     $mpdf->Output('obc_certificate_' . time() . '.pdf', 'I');
    // }

    function download_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $obc_certificate_id = get_from_post('obc_certificate_id_for_certificate');
            $mtype = get_from_post('mtype_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $obc_certificate_id == null || !$obc_certificate_id ||
                    ($mtype != VALUE_ONE && $mtype != VALUE_TWO)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            if ($mtype == VALUE_TWO) {
                $module_type = VALUE_FIVE;
                $temp_qm_data = $this->config->item('query_module_array');
                $qm_data = isset($temp_qm_data[$module_type]) ? $temp_qm_data[$module_type] : array();
                if (empty($qm_data)) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return;
                }
                $existing_obc_certificate_data = $this->utility_model->get_certificate_by_module_details($module_type, $obc_certificate_id, $qm_data['key_id_text'], $qm_data['tbl_text']);
            } else {
                $existing_obc_certificate_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($existing_obc_certificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($mtype == VALUE_TWO) {
                header('Content-type: application/pdf');
                header("Content-Transfer-Encoding: base64");
                $certificate = base64_decode($existing_obc_certificate_data['certificate']);
                print_r($certificate);
            } else {
                error_reporting(E_ERROR);
                $data = array('obc_certificate_data' => $existing_obc_certificate_data, 'mtype' => $mtype);
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
                $mpdf->showWatermarkText = true;
                $mpdf->WriteHTML($this->load->view('obc_certificate/certificate', $data, TRUE));
                $mpdf->Output('obc_migrant_certificate_' . time() . '.pdf', 'I');
            }
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function download_migrant_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $obc_certificate_id = get_from_post('obc_migrant_certificate_id_for_certificate');
            $mtype = get_from_post('mtype_migrant_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $obc_certificate_id == null || !$obc_certificate_id ||
                    ($mtype != VALUE_ONE && $mtype != VALUE_TWO)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            if ($mtype == VALUE_TWO) {
                $module_type = VALUE_FIVE;
                $temp_qm_data = $this->config->item('query_module_array');
                $qm_data = isset($temp_qm_data[$module_type]) ? $temp_qm_data[$module_type] : array();
                if (empty($qm_data)) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return;
                }
                $existing_obc_certificate_data = $this->utility_model->get_certificate_by_module_details($module_type, $obc_certificate_id, $qm_data['key_id_text'], $qm_data['tbl_text']);
            } else {
                $existing_obc_certificate_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($existing_obc_certificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($mtype == VALUE_TWO) {
                header('Content-type: application/pdf');
                header("Content-Transfer-Encoding: base64");
                $certificate = base64_decode($existing_obc_certificate_data['certificate']);
                print_r($certificate);
            } else {
                error_reporting(E_ERROR);
                $data = array('obc_certificate_data' => $existing_obc_certificate_data, 'mtype' => $mtype);
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
                $mpdf->showWatermarkText = true;
                $mpdf->WriteHTML($this->load->view('obc_certificate/migrant_certificate', $data, TRUE));
                $mpdf->Output('obc_migrant_certificate_' . time() . '.pdf', 'I');
            }
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return;
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
            $s_app_no = get_from_post('app_no_for_ocge');
            $s_appd = get_from_post('app_date_for_ocge');
            $s_app_det = get_from_post('app_details_for_ocge');
            $s_vdw = get_from_post('vdw_for_ocge');
            $s_app_status = get_from_post('app_status_for_ocge');
            $s_co_hand = get_from_post('currently_on_for_ocge');
            $s_qstatus = get_from_post('qstatus_for_ocge');
            $s_status = get_from_post('status_for_ocge');
            $this->db->trans_start();
            $excel_data = $this->obc_certificate_model->get_records_for_excel($s_district, $s_app_no, $s_appd, $s_app_det, $s_vdw, $s_app_status, $s_co_hand, $s_qstatus, $s_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Obc_Certificate_' . date('Y-m-d H:i:s') . '.csv');
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
            return;
        }
    }

    function get_appointment_data_by_obc_certificate_id() {
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
            $obc_certificate_id = get_from_post('obc_certificate_id');
            if (!$obc_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $appointment_data = $this->utility_model->get_appointment_data_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
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
            $obc_certificate_id = get_from_post('obc_certificate_id_for_obc_certificate_set_appointment');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$obc_certificate_id || $obc_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_data = array();
            $ex_ap_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            if (empty($ex_ap_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_date = get_from_post('appointment_date_for_obc_certificate');
            $appointment_data['appointment_date'] = convert_to_mysql_date_format($appointment_date);
            $appointment_data['appointment_time'] = get_from_post('appointment_time_for_obc_certificate');
            $appointment_data['appointment_by'] = $session_user_id;
            $appointment_data['appointment_by_name'] = get_from_session('name');
            $appointment_data['appointment_datetime'] = $appointment_data['appointment_date'] . ' ' . date("H:i:s", strtotime($appointment_data['appointment_time']));
            $appointment_data['online_statement'] = get_from_post('online_statement_for_obc_certificate');
            $appointment_data['visit_office'] = get_from_post('visit_office_for_obc_certificate');
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
            $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $appointment_data);
            $obc_certificate_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            // Appointment Email & SMS
            $this->utility_lib->email_and_sms_for_certificate_appointment(VALUE_FIVE, $obc_certificate_data);

            $success_array = get_success_array();
            $success_array['message'] = APPOINTMENT_SET_MESSAGE;
            $success_array['obc_certificate_data'] = $obc_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_update_basic_detail_data_by_obc_certificate_id() {
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
            $obc_certificate_id = get_from_post('obc_certificate_id');
            if (!$obc_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $basic_details = $this->obc_certificate_model->get_basic_data_for_cc($obc_certificate_id);
            // $basic_details = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            if (empty($basic_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($basic_details['query_status'] == VALUE_ONE || $basic_details['query_status'] == VALUE_TWO) {
                echo json_encode(get_error_array(APPLICATION_IN_QUERY_MESSAGE));
                return false;
            }
            $aci_data = array();
            $mamlatdar_data = array();
            $ldc_data = array();

            $basic_details['field_documents'] = $this->utility_model->get_result_by_id('module_id', $obc_certificate_id, 'field_verification_document', 'verification_type', VALUE_ONE, 'module_type', VALUE_FIVE);

            $basic_details['field_reverify_documents'] = $this->utility_model->get_result_by_id('module_id', $obc_certificate_id, 'field_verification_document', 'verification_type', VALUE_TWO, 'module_type', VALUE_FIVE);

            if (is_talathi_user() && $basic_details['talathi_to_aci'] == VALUE_ZERO) {
                $aci_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_ACI_USER);
            }
            //  if (is_aci_user() && $basic_details['aci_rec'] == VALUE_ZERO) {
            if (is_aci_user() && ($basic_details['aci_rec'] == VALUE_ZERO || $basic_details['aci_rec'] == VALUE_TWO || $basic_details['aci_rec'] == VALUE_THREE)) {
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
            $obc_certificate_id = get_from_post('obc_certificate_id_for_obc_certificate_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$obc_certificate_id || $obc_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            if (is_admin() || is_talathi_user()) {
                $residing_year_as_per_talathi = get_from_post('residing_year_as_per_talathi');

                $is_upload_verification_doc = get_from_post('upload_verification_document_for_obc_certificate');
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
                $talathi_remarks = get_from_post('talathi_remarks_for_obc_certificate');
                if (!$talathi_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $talathi_to_aci = get_from_post('talathi_to_aci_for_obc_certificate');
                if (!$talathi_to_aci) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if (is_admin() || is_aci_user()) {
                $cert_type = get_from_post('cert_type_for_obc_certificate');
                if (!$cert_type) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $aci_rec = get_from_post('aci_rec_for_obc_certificate');
                if (!$aci_rec) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $aci_remarks = get_from_post('aci_remarks_for_obc_certificate');
                if (!$aci_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($aci_rec == VALUE_ONE) {
                    $aci_to_ldc = get_from_post('aci_to_ldc_for_obc_certificate');
                    if (!$aci_to_ldc) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
                if ($aci_rec == VALUE_TWO) {
                    $aci_to_mamlatdar = get_from_post('aci_to_mamlatdar_for_obc_certificate');
                    if (!$aci_to_mamlatdar) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
                if ($aci_rec == VALUE_THREE) {
                    $aci_to_ldc1 = get_from_post('aci_to_ldc1_for_obc_certificate');
                    if (!$aci_to_ldc1) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
            }
            if (is_admin() || is_ldc_user()) {
                $constitution_artical = $this->input->post('constitution_artical_for_obc_certificate');
                if ($constitution_artical != VALUE_ONE && $constitution_artical != VALUE_TWO) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                $ldc_applicant_name = get_from_post('ldc_applicant_name_for_obc_certificate');
                if (!$ldc_applicant_name) {
                    echo json_encode(get_error_array(APPLICANT_NAME_MESSAGE));
                    return false;
                }
                if ($constitution_artical == VALUE_TWO) {
                    $ldc_minor_child_name = get_from_post('ldc_minor_child_name_for_obc_certificate');
                    if (!$ldc_minor_child_name) {
                        echo json_encode(get_error_array(MINOR_CHILD_NAME_MESSAGE));
                        return false;
                    }
                }
                $ldc_father_name = get_from_post('ldc_father_name_for_obc_certificate');
                if (!$ldc_father_name) {
                    echo json_encode(get_error_array(FATHER_NAME_MESSAGE));
                    return false;
                }
                $ldc_vt_name = get_from_post('ldc_vt_name_for_obc_certificate');
                if (!$ldc_vt_name) {
                    echo json_encode(get_error_array(DETAIL_MESSAGE));
                    return false;
                }
                $ldc_commu_address = get_from_post('ldc_commu_address_for_obc_certificate');
                if (!$ldc_commu_address) {
                    echo json_encode(get_error_array(COMMUNICATION_ADDRESS_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar_remarks = get_from_post('ldc_to_mamlatdar_remarks_for_obc_certificate');
                if (!$ldc_to_mamlatdar_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_ldc_mam_details = get_from_post('update_ldc_mam_details');
                if ($update_ldc_mam_details == VALUE_ONE) {
                    $ldc_to_mamlatdar = get_from_post('ldc_to_mamlatdar_for_obc_certificate');
                    if (!$ldc_to_mamlatdar) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
            }
            $this->db->trans_start();
            $basic_detail_data = array();
            if (is_admin() || is_talathi_user()) {
                $basic_detail_data['talathi'] = $session_user_id;
                $basic_detail_data['residing_year_as_per_talathi'] = $residing_year_as_per_talathi;
                $basic_detail_data['is_upload_verification_doc'] = $is_upload_verification_doc;
                $basic_detail_data['talathi_remarks'] = $talathi_remarks;
                $basic_detail_data['talathi_to_aci'] = $talathi_to_aci;
                $basic_detail_data['talathi_to_aci_datetime'] = date('Y-m-d H:i:s');

                if ($is_upload_verification_doc == VALUE_ONE) {
                    $this->_update_field_doc_items($session_user_id, $obc_certificate_id, $exi_field_doc_items, $new_field_doc_items);
                }
            }
            if (is_admin() || is_aci_user()) {
                $basic_detail_data['aci_rec'] = $aci_rec;
                $basic_detail_data['cert_type'] = $cert_type;
                $basic_detail_data['aci_remarks'] = $aci_remarks;
                if ($aci_rec == VALUE_ONE) {
                    $basic_detail_data['aci_to_ldc'] = $aci_to_ldc;
                    $basic_detail_data['aci_to_ldc_datetime'] = date('Y-m-d H:i:s');
                }
                if ($aci_rec == VALUE_TWO) {
                    $basic_detail_data['aci_to_mamlatdar'] = $aci_to_mamlatdar;
                    $basic_detail_data['aci_to_mamlatdar_datetime'] = date('Y-m-d H:i:s');
                }
                if ($aci_rec == VALUE_THREE) {
                    $basic_detail_data['aci_to_m_ldc'] = $aci_to_ldc1;
                    $basic_detail_data['aci_to_m_ldc_datetime'] = date('Y-m-d H:i:s');
                }
            }
            if (is_admin() || is_ldc_user()) {
                $basic_detail_data['ldc_applicant_name'] = $ldc_applicant_name;
                if ($constitution_artical == VALUE_TWO) {
                    $basic_detail_data['ldc_minor_child_name'] = $ldc_minor_child_name;
                }
                $basic_detail_data['ldc_father_name'] = $ldc_father_name;
                $basic_detail_data['ldc_vt_name'] = $ldc_vt_name;
                $basic_detail_data['ldc_commu_address'] = $ldc_commu_address;
                $basic_detail_data['ldc_to_mamlatdar_remarks'] = $ldc_to_mamlatdar_remarks;
                if ($update_ldc_mam_details == VALUE_ONE) {
                    $basic_detail_data['ldc_to_mamlatdar'] = $ldc_to_mamlatdar;
                    $basic_detail_data['ldc_to_mamlatdar_datetime'] = date('Y-m-d H:i:s');
                }
            }
            $basic_detail_data['updated_by'] = $session_user_id;
            $basic_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('obc_certificate_id', $obc_certificate_id, 'obc_certificate', $basic_detail_data);
            $ic_data = $this->obc_certificate_model->get_basic_data_for_cc($obc_certificate_id);
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
            $success_array['obc_certificate_id'] = $obc_certificate_id;
            $success_array['obc_certificate_data'] = $ic_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function document_for_scrutiny() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $obc_certificate_id = get_from_post('obc_certificate_id_for_scrutiny');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$obc_certificate_id || $obc_certificate_id == NULL) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $oc_data = $this->obc_certificate_model->get_basic_data_for_cc($obc_certificate_id);
            if (empty($oc_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }

//        $commu_add_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $oc_data['commu_add_state'], 'state', NULL, NULL);
//        $commu_add_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $oc_data['commu_add_district'], 'district', NULL, NULL);
//        $commu_add_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $oc_data['commu_add_village'], 'all_villages', NULL, NULL);
//        $born_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $oc_data['born_place_state'], 'state', NULL, NULL);
//        $born_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $oc_data['born_place_district'], 'district', NULL, NULL);
//        $born_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $oc_data['born_place_village'], 'all_villages', NULL, NULL);
//
//        $native_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $oc_data['native_place_state'], 'state', NULL, NULL);
//        $native_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $oc_data['native_place_district'], 'district', NULL, NULL);
//        $native_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $oc_data['native_place_village'], 'all_villages', NULL, NULL);
//
//        $father_born_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $oc_data['father_born_place_state'], 'state', NULL, NULL);
//        $father_born_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $oc_data['father_born_place_district'], 'district', NULL, NULL);
//        $father_born_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $oc_data['father_born_place_village'], 'all_villages', NULL, NULL);
            // $father_native_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $oc_data['father_native_place_state'], 'state', NULL, NULL);
            // $father_native_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $oc_data['father_native_place_district'], 'district', NULL, NULL);
            // $father_native_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $oc_data['father_native_place_village'], 'all_villages', NULL, NULL);
//        $mother_born_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $oc_data['mother_born_place_state'], 'state', NULL, NULL);
//        $mother_born_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $oc_data['mother_born_place_district'], 'district', NULL, NULL);
//        $mother_born_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $oc_data['mother_born_place_village'], 'all_villages', NULL, NULL);
//
//        $mother_native_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $oc_data['mother_native_place_state'], 'state', NULL, NULL);
//        $mother_native_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $oc_data['mother_native_place_district'], 'district', NULL, NULL);
//        $mother_native_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $oc_data['mother_native_place_village'], 'all_villages', NULL, NULL);
//
//        $spouse_born_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $oc_data['spouse_born_place_state'], 'state', NULL, NULL);
//        $spouse_born_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $oc_data['spouse_born_place_district'], 'district', NULL, NULL);
//        $spouse_born_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $oc_data['spouse_born_place_village'], 'all_villages', NULL, NULL);
//
//        $spouse_native_state_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('state_code', $oc_data['spouse_native_place_state'], 'state', NULL, NULL);
//        $spouse_native_district_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('district_code', $oc_data['spouse_native_place_district'], 'district', NULL, NULL);
//        $spouse_native_village_name_data = $this->obc_certificate_model->get_name_result_data_for_cc('village_code', $oc_data['spouse_native_place_village'], 'all_villages', NULL, NULL);
//
//        $oc_data['commu_add_state_name'] = $commu_add_state_name_data['state_name'];
//        $oc_data['commu_add_district_name'] = $commu_add_district_name_data['district_name'];
//        $oc_data['commu_add_village_name'] = $commu_add_village_name_data['village_name'];
//
//
//        $oc_data['born_state_name'] = $born_state_name_data['state_name'];
//        $oc_data['born_district_name'] = $born_district_name_data['district_name'];
//        $oc_data['born_village_name'] = $born_village_name_data['village_name'];
//
//        $oc_data['native_state_name'] = $native_state_name_data['state_name'];
//        $oc_data['native_district_name'] = $native_district_name_data['district_name'];
//        $oc_data['native_village_name'] = $native_village_name_data['village_name'];
//
//        $oc_data['father_born_state_name'] = $father_born_state_name_data['state_name'];
//        $oc_data['father_born_district_name'] = $father_born_district_name_data['district_name'];
//        $oc_data['father_born_village_name'] = $father_born_village_name_data['village_name'];
            // $oc_data['father_native_state_name'] = $father_native_state_name_data['state_name'];
            // $oc_data['father_native_district_name'] = $father_native_district_name_data['district_name'];
            // $oc_data['father_native_village_name'] = $father_native_village_name_data['village_name'];
//        $oc_data['mother_born_state_name'] = $mother_born_state_name_data['state_name'];
//        $oc_data['mother_born_district_name'] = $mother_born_district_name_data['district_name'];
//        $oc_data['mother_born_village_name'] = $mother_born_village_name_data['village_name'];
//
//        $oc_data['mother_native_state_name'] = $mother_native_state_name_data['state_name'];
//        $oc_data['mother_native_district_name'] = $mother_native_district_name_data['district_name'];
//        $oc_data['mother_native_village_name'] = $mother_native_village_name_data['village_name'];
//
//        if ($oc_data['constitution_artical'] == VALUE_ONE && ($oc_data['marital_status'] == VALUE_ONE)) {
//            $oc_data['spouse_born_state_name'] = $spouse_born_state_name_data['state_name'];
//            $oc_data['spouse_born_district_name'] = $spouse_born_district_name_data['district_name'];
//            $oc_data['spouse_born_village_name'] = $spouse_born_village_name_data['village_name'];
//
//            $oc_data['spouse_native_state_name'] = $spouse_native_state_name_data['state_name'];
//            $oc_data['spouse_native_district_name'] = $spouse_native_district_name_data['district_name'];
//            $oc_data['spouse_native_village_name'] = $spouse_native_village_name_data['village_name'];
//        }


            $query_data = $this->utility_model->query_data_for_scrutiny(VALUE_FIVE, $obc_certificate_id);

            $field_verification_doc_data = $this->utility_model->field_verification_document_data_for_scrutiny(VALUE_FIVE, $obc_certificate_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            //$ti_bd = $this->_calculate_total_obc_certificate_and_basic_details($oc_data);
            // $oc_data['total_obc_certificate'] = $ti_bd['total_obc_certificate'];
            // $oc_data['total_members'] = $ti_bd['total_members'];
            // $oc_data['total_earning_members'] = $ti_bd['total_earning_members'];
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('obc_certificate/pdf', $oc_data, TRUE));

            $temp_filename = 'basic_obc_' . $obc_certificate_id . '_' . time() . '.pdf';
            $temp_filepath = 'documents/temp/' . $temp_filename;

            $temp_files_to_remove = array();
            $temp_files_to_merge = array();
            array_push($temp_files_to_remove, $temp_filepath);
            array_push($temp_files_to_merge, $temp_filepath);

            if ($oc_data['tax_payer_copy'] != '') {
                $new_tax_payer_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['tax_payer_copy']);
                array_push($temp_files_to_remove, $new_tax_payer_path);
                array_push($temp_files_to_merge, $new_tax_payer_path);
            }
            if ($oc_data['self_birth_certificate_doc'] != '') {
                $new_self_cd_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['self_birth_certificate_doc']);
                array_push($temp_files_to_remove, $new_self_cd_path);
                array_push($temp_files_to_merge, $new_self_cd_path);
            }
            if ($oc_data['father_certificate_doc'] != '') {
                $new_fc_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['father_certificate_doc']);
                array_push($temp_files_to_remove, $new_fc_path);
                array_push($temp_files_to_merge, $new_fc_path);
            }
            if ($oc_data['father_election_card_doc'] != '') {
                $new_fec_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['father_election_card_doc']);
                array_push($temp_files_to_remove, $new_fec_path);
                array_push($temp_files_to_merge, $new_fec_path);
            }
            if ($oc_data['father_aadhar_card_doc'] != '') {
                $new_fac_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['father_aadhar_card_doc']);
                array_push($temp_files_to_remove, $new_fac_path);
                array_push($temp_files_to_merge, $new_fac_path);
            }
            if ($oc_data['mother_election_card'] != '') {
                $new_fec_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['mother_election_card']);
                array_push($temp_files_to_remove, $new_fec_path);
                array_push($temp_files_to_merge, $new_fec_path);
            }
            if ($oc_data['mother_election_card_doc'] != '') {
                $new_mec_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['mother_election_card_doc']);
                array_push($temp_files_to_remove, $new_mec_path);
                array_push($temp_files_to_merge, $new_mec_path);
            }
            if ($oc_data['mother_aadhar_card'] != '') {
                $new_fac_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['mother_aadhar_card']);
                array_push($temp_files_to_remove, $new_fac_path);
                array_push($temp_files_to_merge, $new_fac_path);
            }
            if ($oc_data['mother_aadhar_card_doc'] != '') {
                $new_mac_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['mother_aadhar_card_doc']);
                array_push($temp_files_to_remove, $new_mac_path);
                array_push($temp_files_to_merge, $new_mac_path);
            }
            if ($oc_data['grandfather_birth_certificate_doc'] != '') {
                $new_gfbc_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['grandfather_birth_certificate_doc']);
                array_push($temp_files_to_remove, $new_gfbc_path);
                array_push($temp_files_to_merge, $new_gfbc_path);
            }
            if ($oc_data['grandfather_property_doc'] != '') {
                $new_gfpd_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['grandfather_property_doc']);
                array_push($temp_files_to_remove, $new_gfpd_path);
                array_push($temp_files_to_merge, $new_gfpd_path);
            }
            if ($oc_data['father_community_death_doc'] != '') {
                $new_lc_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['father_community_death_doc']);
                array_push($temp_files_to_remove, $new_lc_path);
                array_push($temp_files_to_merge, $new_lc_path);
            }
//        if ($oc_data['election_card_doc'] != '') {
//            $new_ec_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['election_card_doc']);
//            array_push($temp_files_to_remove, $new_ec_path);
//            array_push($temp_files_to_merge, $new_ec_path);
//        }
            if ($oc_data['aadhar_card_doc'] != '') {
                $new_ac_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['aadhar_card_doc']);
                array_push($temp_files_to_remove, $new_ac_path);
                array_push($temp_files_to_merge, $new_ac_path);
            }
            if ($oc_data['community_certificate_doc'] != '') {
                $new_ccd_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['community_certificate_doc']);
                array_push($temp_files_to_remove, $new_ccd_path);
                array_push($temp_files_to_merge, $new_ccd_path);
            }
            if ($oc_data['income_certificate'] != '') {
                $new_ic_path = $this->_copy_file(OBC_CERTIFICATE_DOC_PATH, $oc_data['income_certificate']);
                array_push($temp_files_to_remove, $new_ic_path);
                array_push($temp_files_to_merge, $new_ic_path);
            }

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
                        $new_fvd_path = $this->_copy_file('documents/obc_certificate/', $fvd_data['document']);
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
            $final_filename = 'final_scrutiny_document_obc_' . rand(111111111, 99999999) . '_' . time() . '.pdf';
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

    function get_village_data_for_obc_certificate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $state_code = get_from_post('state_code');
            if (!$state_code) {
                echo json_encode(get_error_array(SELECT_STATE_MESSAGE));
                return false;
            }
            $district_code = get_from_post('district_code');
            if (!$district_code) {
                echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $village_data = $this->utility_model->get_result_by_id('state_code', $state_code, 'all_villages', 'district_code', $district_code, NULL, NULL, 'village_name');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['village_data'] = $village_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_name_data_for_obc_certificate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $state_code = get_from_post('state_code');
            if (!$state_code) {
                echo json_encode(get_error_array(SELECT_STATE_MESSAGE));
                return false;
            }
            $district_code = get_from_post('district_code');
            if (!$district_code) {
                echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $village_code = get_from_post('village_code');
            if (!$village_code) {
                echo json_encode(get_error_array(VILLAGE_NAME_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $state_data = $this->utility_model->get_name_result_data('state_code', $state_code, 'state', NULL, NULL);
            $district_data = $this->utility_model->get_name_result_data('district_code', $district_code, 'district', NULL, NULL);
            $village_data = $this->utility_model->get_name_result_data('village_code', $village_code, 'all_villages', NULL, NULL);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['state_data'] = $state_data;
            $success_array['district_data'] = $district_data;
            $success_array['village_data'] = $village_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_oc_declaration() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $obc_certificate_id = get_from_post('obc_certificate_id_for_oc_declaration');
            if ($user_id == null || !$user_id || $obc_certificate_id == null || !$obc_certificate_id) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $ic_data = $this->utility_model->get_by_id('obc_certificate_id', $obc_certificate_id, 'obc_certificate');
            if (empty($ic_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            // $ti_bd = $this->_calculate_total_caste_and_basic_details($ic_data);
            // $ic_data['total_caste'] = indian_comma_caste($ti_bd['total_caste']);
            $village_data = $this->utility_model->get_by_id('all_village_id', $ic_data['village_name'], 'all_villages');
            $ic_data['village_name'] = isset($village_data['village_name']) ? $village_data['village_name'] : '';

            //$ic_data['commu_add_village'] = $village_data['village_name'];
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view("obc_certificate/declaration", $ic_data, TRUE));
            $mpdf->Output('Declaration_' . $ic_data['application_number'] . '_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            $this->load->view('error', array('error_message' => $e->getMessage()));
            return;
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
            $obc_certificate_id = get_from_post('obc_certificate_id_for_obc_certificate_update_basic_detail');

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
            $main_path = $path . DIRECTORY_SEPARATOR . 'obc_certificate';
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
                $dr_data['module_type'] = VALUE_FIVE;
                $dr_data['module_id'] = $obc_certificate_id;
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
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'obc_certificate' . DIRECTORY_SEPARATOR . $ex_data['document'];
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'obc_certificate' . DIRECTORY_SEPARATOR . $ex_data['document'];
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

    function _update_field_doc_items($session_user_id, $obc_certificate_id, $exi_field_doc_items, $new_field_doc_items) {
        if ($exi_field_doc_items != '') {
            if (!empty($exi_field_doc_items)) {
                foreach ($exi_field_doc_items as &$value) {
                    $value['module_id'] = $obc_certificate_id;
                    $value['updated_by'] = $session_user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->update_data_batch('field_verification_document_id', 'field_verification_document', $exi_field_doc_items);
            }
        }
        if ($new_field_doc_items != '') {
            if (!empty($new_field_doc_items)) {
                foreach ($new_field_doc_items as &$value) {
                    $value['module_id'] = $obc_certificate_id;
                    $value['created_by'] = $session_user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->insert_data_batch('field_verification_document', $new_field_doc_items);
            }
        }
    }
}

/*
 * EOF: ./application/controller/OBC_certificate.php
 */