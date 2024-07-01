<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ews_certificate extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('ews_certificate_model');
    }

    function get_ews_certificate_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['ews_certificate_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;

            $search_appno = get_from_post('app_no_for_ews_certificate_list');
            $search_appd = get_from_post('application_date_for_ews_certificate_list');
            $search_appdet = filter_var(get_from_post('app_details_for_ews_certificate_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_ews_certificate_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_ews_certificate_list');
            $search_cohand = get_from_post('currently_on_for_ews_certificate_list');
            $search_appostatus = get_from_post('appointment_status_for_ews_certificate_list');
            $search_qstatus = get_from_post('query_status_for_ews_certificate_list');
            $search_status = get_from_post('status_for_ews_certificate_list');

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
            $success_array['ews_certificate_data'] = $this->ews_certificate_model->get_all_ews_certificate_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->ews_certificate_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_appostatus != '' || $search_cohand != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->ews_certificate_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['ews_certificate_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['ews_certificate_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_ews_certificate_data_by_id() {
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
            $ews_certificate_id = get_from_post('ews_certificate_id');
            if (!$ews_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $is_edit_view = get_from_post('is_edit_view');
            $this->db->trans_start();
            $ews_certificate_data = $this->utility_model->get_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
            if (empty($ews_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['ews_certificate_data'] = $ews_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_ews_certificate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            $ews_certificate_id = get_from_post('ews_certificate_id');
            if (!is_post() || $user_id == NULL || !$user_id || $ews_certificate_id == NULL || !$ews_certificate_id ||
                    ($module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ews_certificate_data = $this->_get_post_data_for_ews_certificate();
            $validation_message = $this->_check_validation_for_ews_certificate($module_type, $ews_certificate_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $income_certy_details = $this->input->post('detail_of_income_asset_info');
            $ews_certificate_data['income_certy_details'] = json_encode($income_certy_details);

            $sibling_bro_details = $this->input->post('detail_of_sibling_bro_info');
            $ews_certificate_data['sibling_bro_details'] = json_encode($sibling_bro_details);

            $sibling_sis_details = $this->input->post('detail_of_sibling_sis_info');
            $ews_certificate_data['sibling_sis_details'] = json_encode($sibling_sis_details);

            $son_details = $this->input->post('detail_of_children_son_info');
            $ews_certificate_data['son_details'] = json_encode($son_details);

            $daughter_details = $this->input->post('detail_of_children_daughter_info');
            $ews_certificate_data['daughter_details'] = json_encode($daughter_details);

            $sibling_broincome_details = $this->input->post('detail_of_sibling_bro_income');
            $ews_certificate_data['sibling_broincome_details'] = json_encode($sibling_broincome_details);

            $sibling_sisincome_details = $this->input->post('detail_of_sibling_sis_income');
            $ews_certificate_data['sibling_sisincome_details'] = json_encode($sibling_sisincome_details);

            $sonincome_details = $this->input->post('detail_of_son_income');
            $ews_certificate_data['sonincome_details'] = json_encode($sonincome_details);

            $daughterincome_details = $this->input->post('detail_of_daughter_income');
            $ews_certificate_data['daughterincome_details'] = json_encode($daughterincome_details);

            $birth_stay_place_details = $this->input->post('detail_of_birth_stay_place_info');
            if (empty($birth_stay_place_details) && $module_type != VALUE_ONE) {
                echo json_encode(get_error_array(ONE_BIRTH_STAY_PLACE_MESSAGE));
                return false;
            }
            $ews_certificate_data['birth_stay_place_details'] = json_encode($birth_stay_place_details);

            $this->db->trans_start();
            $ews_certificate_data['applicant_dob'] = convert_to_mysql_date_format($ews_certificate_data['applicant_dob']);
            $ews_certificate_data['updated_by'] = $user_id;
            $ews_certificate_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('ews_certificate_id', $ews_certificate_id, 'ews_certificate', $ews_certificate_data);

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

    function _get_post_data_for_ews_certificate() {
        $ews_certificate_data = array();
        $ews_certificate_data['constitution_artical'] = get_from_post('constitution_artical');
        if (is_admin()) {
            $ews_certificate_data['district'] = get_from_post('district');
        }
        $ews_certificate_data['village_name'] = get_from_post('village_name');
        $ews_certificate_data['applicant_name'] = get_from_post('applicant_name');
        $ews_certificate_data['father_husbund_name'] = get_from_post('father_husbund_name');
        if ($ews_certificate_data['constitution_artical'] == VALUE_TWO) {
            $ews_certificate_data['relationship_of_applicant'] = get_from_post('relationship_of_applicant');
            $ews_certificate_data['guardian_address'] = get_from_post('guardian_address');
            $ews_certificate_data['guardian_mobile_no'] = get_from_post('guardian_mobile_no');
            $ews_certificate_data['guardian_aadhaar'] = get_from_post('guardian_aadhaar');
            $ews_certificate_data['minor_child_name'] = get_from_post('minor_child_name');
        }
        $ews_certificate_data['gender'] = get_from_post('gender_for_ec');
        if ($ews_certificate_data['constitution_artical'] == VALUE_ONE) {
            $ews_certificate_data['marital_status'] = get_from_post('marital_status_for_ec');
        }
        $ews_certificate_data['applicant_dob'] = get_from_post('applicant_dob');
        $ews_certificate_data['applicant_age'] = get_from_post('applicant_age');
        $ews_certificate_data['born_place'] = get_from_post('born_place');
        $ews_certificate_data['applicant_religion'] = get_from_post('applicant_religion');
        $ews_certificate_data['applicant_caste'] = get_from_post('applicant_caste');
        $ews_certificate_data['applicant_education'] = get_from_post('applicant_education');
        $ews_certificate_data['purpose_of_ews_certificate'] = get_from_post('purpose_of_ews_certificate');
        $ews_certificate_data['com_addr_house_no'] = get_from_post('com_addr_house_no');
        $ews_certificate_data['com_addr_house_name'] = get_from_post('com_addr_house_name');
        $ews_certificate_data['com_addr_street'] = get_from_post('com_addr_street');
        $ews_certificate_data['com_addr_village_dmc_ward'] = get_from_post('com_addr_village_dmc_ward');
        $ews_certificate_data['com_addr_city'] = get_from_post('com_addr_city');
        $ews_certificate_data['com_pincode'] = get_from_post('com_pincode');
        $ews_certificate_data['per_addr_house_no'] = get_from_post('per_addr_house_no');
        $ews_certificate_data['per_addr_house_name'] = get_from_post('per_addr_house_name');
        $ews_certificate_data['per_addr_street'] = get_from_post('per_addr_street');
        $ews_certificate_data['per_addr_village_dmc_ward'] = get_from_post('per_addr_village_dmc_ward');
        $ews_certificate_data['per_addr_city'] = get_from_post('per_addr_city');
        $ews_certificate_data['per_pincode'] = get_from_post('per_pincode');
        $ews_certificate_data['mobile_number'] = get_from_post('mobile_number');
        $ews_certificate_data['aadhaar'] = get_from_post('aadhaar');
        $ews_certificate_data['pancard'] = get_from_post('pancard');
        $ews_certificate_data['email'] = get_from_post('email');
        $ews_certificate_data['reservation_cast_list'] = get_from_post('reservation_cast_list_for_ews_certificate');
        $ews_certificate_data['father_name'] = get_from_post('father_name');
        $ews_certificate_data['mother_name'] = get_from_post('mother_name');
        $ews_certificate_data['father_age'] = get_from_post('father_age');
        $ews_certificate_data['father_occupation'] = get_from_post('father_occupation');
        $ews_certificate_data['father_remark'] = get_from_post('father_remark');
        $ews_certificate_data['mother_age'] = get_from_post('mother_age');
        $ews_certificate_data['mother_occupation'] = get_from_post('mother_occupation');
        $ews_certificate_data['mother_remark'] = get_from_post('mother_remark');
        $ews_certificate_data['present_police_station'] = get_from_post('present_police_station');
        $ews_certificate_data['present_post_office'] = get_from_post('present_post_office');
        $ews_certificate_data['billingtoo'] = get_from_post('billingtoo');
        if ($ews_certificate_data['constitution_artical'] == VALUE_ONE) {
            $ews_certificate_data['occupation'] = get_from_post('occupation');
            if ($ews_certificate_data['occupation'] == VALUE_FOUR) {
                $ews_certificate_data['other_occupation'] = get_from_post('other_occupation');
            }
        }
        $ews_certificate_data['total_income'] = get_from_post('total_income');
        $ews_certificate_data['father_salary_detail'] = get_from_post('father_salary_detail');
        $ews_certificate_data['father_business_detail'] = get_from_post('father_business_detail');
        $ews_certificate_data['father_agri_detail'] = get_from_post('father_agri_detail');
        $ews_certificate_data['father_profe_detail'] = get_from_post('father_profe_detail');
        $ews_certificate_data['father_other_detail'] = get_from_post('father_other_detail');
        $ews_certificate_data['father_total_income'] = get_from_post('father_total_income');
        $ews_certificate_data['mother_salary_detail'] = get_from_post('mother_salary_detail');
        $ews_certificate_data['mother_business_detail'] = get_from_post('mother_business_detail');
        $ews_certificate_data['mother_agri_detail'] = get_from_post('mother_agri_detail');
        $ews_certificate_data['mother_profe_detail'] = get_from_post('mother_profe_detail');
        $ews_certificate_data['mother_other_detail'] = get_from_post('mother_other_detail');
        $ews_certificate_data['mother_total_income'] = get_from_post('mother_total_income');
        if ($ews_certificate_data['constitution_artical'] == VALUE_ONE) {
            $ews_certificate_data['self_salary_detail'] = get_from_post('self_salary_detail');
            $ews_certificate_data['self_business_detail'] = get_from_post('self_business_detail');
            $ews_certificate_data['self_agri_detail'] = get_from_post('self_agri_detail');
            $ews_certificate_data['self_profe_detail'] = get_from_post('self_profe_detail');
            $ews_certificate_data['self_other_detail'] = get_from_post('self_other_detail');
            $ews_certificate_data['self_total_income'] = get_from_post('self_total_income');
        }
        $ews_certificate_data['sibling_bro_salary_detail'] = get_from_post('sibling_bro_salary_detail');
        $ews_certificate_data['sibling_bro_business_detail'] = get_from_post('sibling_bro_business_detail');
        $ews_certificate_data['sibling_bro_agri_detail'] = get_from_post('sibling_bro_agri_detail');
        $ews_certificate_data['sibling_bro_profe_detail'] = get_from_post('sibling_bro_profe_detail');
        $ews_certificate_data['sibling_bro_other_detail'] = get_from_post('sibling_bro_other_detail');
        $ews_certificate_data['sibling_bro_total_income'] = get_from_post('sibling_bro_total_income');
        $ews_certificate_data['sibling_sis_salary_detail'] = get_from_post('sibling_sis_salary_detail');
        $ews_certificate_data['sibling_sis_business_detail'] = get_from_post('sibling_sis_business_detail');
        $ews_certificate_data['sibling_sis_agri_detail'] = get_from_post('sibling_sis_agri_detail');
        $ews_certificate_data['sibling_sis_profe_detail'] = get_from_post('sibling_sis_profe_detail');
        $ews_certificate_data['sibling_sis_other_detail'] = get_from_post('sibling_sis_other_detail');
        $ews_certificate_data['sibling_sis_total_income'] = get_from_post('sibling_sis_total_income');
        $ews_certificate_data['son_salary_detail'] = get_from_post('son_salary_detail');
        $ews_certificate_data['son_business_detail'] = get_from_post('son_business_detail');
        $ews_certificate_data['son_agri_detail'] = get_from_post('son_agri_detail');
        $ews_certificate_data['son_profe_detail'] = get_from_post('son_profe_detail');
        $ews_certificate_data['son_other_detail'] = get_from_post('son_other_detail');
        $ews_certificate_data['son_total_income'] = get_from_post('son_total_income');
        $ews_certificate_data['daughter_salary_detail'] = get_from_post('daughter_salary_detail');
        $ews_certificate_data['daughter_business_detail'] = get_from_post('daughter_business_detail');
        $ews_certificate_data['daughter_agri_detail'] = get_from_post('daughter_agri_detail');
        $ews_certificate_data['daughter_profe_detail'] = get_from_post('daughter_profe_detail');
        $ews_certificate_data['daughter_other_detail'] = get_from_post('daughter_other_detail');
        $ews_certificate_data['daughter_total_income'] = get_from_post('daughter_total_income');
        $ews_certificate_data['agricultural_area'] = get_from_post('agricultural_area');
        $ews_certificate_data['agricultural_location'] = get_from_post('agricultural_location');
        $ews_certificate_data['residental_flat_area'] = get_from_post('residental_flat_area');
        $ews_certificate_data['residental_flat_location'] = get_from_post('residental_flat_location');
        $ews_certificate_data['residental_plot_urban_area'] = get_from_post('residental_plot_urban_area');
        $ews_certificate_data['residental_plot_urban_location'] = get_from_post('residental_plot_urban_location');
        $ews_certificate_data['residental_plot_rural_area'] = get_from_post('residental_plot_rural_area');
        $ews_certificate_data['residental_plot_rural_location'] = get_from_post('residental_plot_rural_location');
        $ews_certificate_data['if_having_domicile_certi'] = get_from_post('if_having_domicile_certi_for_ews_certificate');
        $ews_certificate_data['have_you_own_house'] = get_from_post('have_you_own_house_for_ews_certificate');
        return $ews_certificate_data;
    }

    function _check_validation_for_ews_certificate($module_type, $ews_certificate_data) {
        if (is_admin()) {
            if (!$ews_certificate_data['district']) {
                return DISTRICT_MESSAGE;
            }
        }
        if (!$ews_certificate_data['village_name']) {
            return VILLAGE_NAME_MESSAGE;
        }
        if (!$ews_certificate_data['applicant_name']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if ($ews_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$ews_certificate_data['father_husbund_name']) {
                return FATHER_HUSB_NAME_MESSAGE;
            }
        }
        if ($ews_certificate_data['constitution_artical'] == VALUE_TWO) {
            if (!$ews_certificate_data['relationship_of_applicant']) {
                return APPLICANT_RELATION_MESSAGE;
            }
            if (!$ews_certificate_data['guardian_address']) {
                return GUARDIAN_ADDRESS_MESSAGE;
            }
            if (!$ews_certificate_data['guardian_mobile_no']) {
                return MOBILE_NUMBER_MESSAGE;
            }
            if (!$ews_certificate_data['guardian_aadhaar']) {
                return INVALID_AADHAR_MESSAGE;
            }
            if (!$ews_certificate_data['minor_child_name']) {
                return MINOR_CHILD_NAME_MESSAGE;
            }
        }
        if (!$ews_certificate_data['gender']) {
            return GENDER_MESSAGE;
        }
        if ($ews_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$ews_certificate_data['marital_status']) {
                return MARRITIAL_STATUS_MESSAGE;
            }
        }
        if (!$ews_certificate_data['applicant_dob']) {
            return BIRTH_DATE_MESSAGE;
        }
        if (!$ews_certificate_data['applicant_age']) {
            return APPLICANT_AGE_MESSAGE;
        }
        if ($module_type == VALUE_ONE) {
            return '';
        }
        if (!$ews_certificate_data['born_place']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$ews_certificate_data['applicant_religion']) {
            return RELIGION_MESSAGE;
        }
        if (!$ews_certificate_data['applicant_caste']) {
            return CASTE_MESSAGE;
        }
        if ($ews_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$ews_certificate_data['mobile_number']) {
                return MOBILE_NUMBER_MESSAGE;
            }
        }
        if ($ews_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$ews_certificate_data['aadhaar']) {
                return AADHAR_MESSAGE;
            }
        }
        if (!$ews_certificate_data['present_police_station']) {
            return NEAREST_POLICE_STATION_MESSAGE;
        }
        if (!$ews_certificate_data['present_post_office']) {
            return NEAREST_POST_OFFICE_MESSAGE;
        }
        if (!$ews_certificate_data['applicant_education']) {
            return APPLICANT_EDUCATION_MESSAGE;
        }
        if (!$ews_certificate_data['purpose_of_ews_certificate']) {
            return PURPOSE_MESSAGE;
        }
        if (!$ews_certificate_data['reservation_cast_list']) {
            return ONE_OPTION_MESSAGE;
        }

        if (!$ews_certificate_data['com_addr_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$ews_certificate_data['com_addr_street']) {
            return STREET_MESSAGE;
        }
        if (!$ews_certificate_data['com_addr_village_dmc_ward']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$ews_certificate_data['com_addr_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if (!$ews_certificate_data['per_addr_house_no']) {
            return HOUSE_NO_MESSAGE;
        }
        if (!$ews_certificate_data['per_addr_street']) {
            return STREET_MESSAGE;
        }
        if (!$ews_certificate_data['per_addr_village_dmc_ward']) {
            return VILLAGE_WARD_MESSAGE;
        }
        if (!$ews_certificate_data['per_addr_city']) {
            return SELECT_CITY_MESSAGE;
        }
        if ($ews_certificate_data['constitution_artical'] == VALUE_ONE) {
            if (!$ews_certificate_data['occupation']) {
                return OCCUPATION_MESSAGE;
            }
            if (!$ews_certificate_data['occupation'] == VALUE_FOUR) {
                if (!$ews_certificate_data['other_occupation']) {
                    return OCCUPATION_MESSAGE;
                }
            }
        }
        if (!$ews_certificate_data['father_name']) {
            return NAME_MESSAGE;
        }
        if (!$ews_certificate_data['father_age']) {
            return AGE_MESSAGE;
        }
        if (!$ews_certificate_data['father_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if (!$ews_certificate_data['father_remark']) {
            return REMARK_MESSAGE;
        }
        if (!$ews_certificate_data['mother_name']) {
            return NAME_MESSAGE;
        }
        if (!$ews_certificate_data['mother_age']) {
            return AGE_MESSAGE;
        }
        if (!$ews_certificate_data['mother_occupation']) {
            return OCCUPATION_MESSAGE;
        }
        if (!$ews_certificate_data['mother_remark']) {
            return REMARK_MESSAGE;
        }
        if (!$ews_certificate_data['residental_flat_area']) {
            return AREA_MESSAGE;
        }
        if (!$ews_certificate_data['residental_flat_location']) {
            return LOCATION_MESSAGE;
        }
        return '';
    }

    function submit_ews_certificate_upload_document() {
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
            $ews_certificate_id = get_from_post('ews_certificate_id');
            $ews_certificate_data['have_you_own_house'] = get_from_post('have_you_own_house_for_ews_certificate');

            $this->db->trans_start();
            $ews_certificate_data['status'] = $module_type;
            if ($module_type == VALUE_TWO) {
                $ews_certificate_data['submitted_datetime'] = date('Y-m-d H:i:s');
            }
            if (!$ews_certificate_id || $ews_certificate_id == NULL) {
                $ews_certificate_data['user_id'] = $user_id;
                $ews_certificate_data['created_by'] = $user_id;
                $ews_certificate_data['created_time'] = date('Y-m-d H:i:s');
                $ews_certificate_data['declaration'] = VALUE_ONE;
                $ews_certificate_id = $this->utility_model->insert_data('ews_certificate', $ews_certificate_data);
            } else {
                $ews_certificate_data['updated_by'] = $user_id;
                $ews_certificate_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('ews_certificate_id', $ews_certificate_id, 'ews_certificate', $ews_certificate_data);
            }

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

    function approve_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $ews_certificate_id = get_from_post('ews_certificate_id_for_ews_certificate_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$ews_certificate_id || $ews_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_ews_certificate_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = get_days_in_dates($ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('ews_certificate_id', $ews_certificate_id, 'ews_certificate', $update_data);

            $ex_data['status'] = $update_data['status'];
            $ex_data['status_datetime'] = $update_data['status_datetime'];
            error_reporting(E_ERROR);
            $data = array('ews_certificate_data' => $ex_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($this->load->view('ews_certificate/certificate', $data, TRUE));
            $certificate_path = 'documents/temp/final_certificate_ews-' . $ews_certificate_id . rand(111111111, 99999999) . '_' . time() . '.pdf';
            $mpdf->Output($certificate_path, 'F');
            $cerificate_data = array();
            $cerificate_data['certificate'] = chunk_split(base64_encode(file_get_contents($certificate_path)));
            $cerificate_data['module_id'] = $ews_certificate_id;
            $cerificate_data['module_type'] = VALUE_SEVEN;
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
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_SEVEN, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_SEVEN, $ex_data);
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
            $ews_certificate_id = get_from_post('ews_certificate_id_for_ews_certificate_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$ews_certificate_id || $ews_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_ews_certificate_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = get_days_in_dates($ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('ews_certificate_id', $ews_certificate_id, 'ews_certificate', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_SEVEN, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_SEVEN, $ex_data);
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

    function get_ews_certificate_data_by_ews_certificate_id() {
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
            $ews_certificate_id = get_from_post('ews_certificate_id');
            if (!$ews_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ews_certificate_data = $this->ews_certificate_model->get_basic_data_for_ec($ews_certificate_id);
            if (empty($ews_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['ews_certificate_data'] = $ews_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $ews_certificate_id = get_from_post('ews_certificate_id_for_certificate');
            $mtype = get_from_post('mtype_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $ews_certificate_id == null || !$ews_certificate_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            if ($mtype == VALUE_TWO) {
                $module_type = VALUE_SEVEN;
                $temp_qm_data = $this->config->item('query_module_array');
                $qm_data = isset($temp_qm_data[$module_type]) ? $temp_qm_data[$module_type] : array();
                if (empty($qm_data)) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return;
                }
                $existing_ews_certificate_data = $this->utility_model->get_certificate_by_module_details($module_type, $ews_certificate_id, $qm_data['key_id_text'], $qm_data['tbl_text']);
            } else {
                $existing_ews_certificate_data = $this->utility_model->get_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($existing_ews_certificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($mtype == VALUE_TWO) {
                header('Content-type: application/pdf');
                header("Content-Transfer-Encoding: base64");
                $certificate = base64_decode($existing_ews_certificate_data['certificate']);
                print_r($certificate);
            } else {
                error_reporting(E_ERROR);
                $data = array('ews_certificate_data' => $existing_ews_certificate_data, 'mtype' => $mtype);
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
                $mpdf->showWatermarkText = true;
                $mpdf->WriteHTML($this->load->view('ews_certificate/certificate', $data, TRUE));
                $mpdf->Output('ews_certificate_' . time() . '.pdf', 'I');
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
            $search_district = is_admin() ? '' : $session_district;
            $search_appno = get_from_post('app_no_for_Ecge');
            $search_appd = get_from_post('app_date_for_Ecge');
            $search_appdet = get_from_post('app_details_for_Ecge');
            $search_vdw = get_from_post('vdw_for_Ecge');
            $search_appostatus = get_from_post('app_status_for_Ecge');
            $search_cohand = get_from_post('currently_on_for_Ecge');
            $search_qstatus = get_from_post('qstatus_for_Ecge');
            $search_status = get_from_post('status_for_Ecge');
            $this->db->trans_start();
            $excel_data = $this->ews_certificate_model->get_records_for_excel($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Ews_certificate_Report_' . date('Y-m-d H:i:s') . '.csv');
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

    function get_appointment_data_by_ews_certificate_id() {
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
            $ews_certificate_id = get_from_post('ews_certificate_id');
            if (!$ews_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $appointment_data = $this->utility_model->get_appointment_data_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
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
            $ews_certificate_id = get_from_post('ews_certificate_id_for_ews_certificate_set_appointment');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$ews_certificate_id || $ews_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_data = array();
            $this->db->trans_start();

            $ex_ap_data = $this->utility_model->get_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
            if (empty($ex_ap_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $appointment_date = get_from_post('appointment_date_for_ews_certificate');
            $appointment_data['appointment_date'] = convert_to_mysql_date_format($appointment_date);
            $appointment_data['appointment_time'] = get_from_post('appointment_time_for_ews_certificate');
            $appointment_data['appointment_by'] = $session_user_id;
            $appointment_data['appointment_by_name'] = get_from_session('name');
            $appointment_data['appointment_datetime'] = $appointment_data['appointment_date'] . ' ' . date("H:i:s", strtotime($appointment_data['appointment_time']));
            $appointment_data['online_statement'] = get_from_post('online_statement_for_ews_certificate');
            $appointment_data['visit_office'] = get_from_post('visit_office_for_ews_certificate');
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

            $this->utility_model->update_data('ews_certificate_id', $ews_certificate_id, 'ews_certificate', $appointment_data);
            //$ews_certificate_data = $this->utility_model->get_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
            $ews_certificate_data = $this->ews_certificate_model->get_basic_data_for_ec($ews_certificate_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            // Appointment Email & SMS
            $this->utility_lib->email_and_sms_for_certificate_appointment(VALUE_SEVEN, $ews_certificate_data);

            $success_array = get_success_array();
            $success_array['message'] = APPOINTMENT_SET_MESSAGE;
            $success_array['ews_certificate_data'] = $ews_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_update_basic_detail_data_by_ews_certificate_id() {
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
            $ews_certificate_id = get_from_post('ews_certificate_id');
            if (!$ews_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $basic_details = $this->ews_certificate_model->get_basic_data_for_ec($ews_certificate_id);
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

            $basic_details['field_documents'] = $this->utility_model->get_result_by_id('module_id', $ews_certificate_id, 'field_verification_document', 'verification_type', VALUE_ONE, 'module_type', VALUE_SEVEN);

            $basic_details['field_reverify_documents'] = $this->utility_model->get_result_by_id('module_id', $ews_certificate_id, 'field_verification_document', 'verification_type', VALUE_TWO, 'module_type', VALUE_SEVEN);

            if (is_talathi_user() && $basic_details['talathi_to_aci'] == VALUE_ZERO) {
                $aci_data = $this->utility_model->get_sa_user_data_by_type($basic_details['district'], TEMP_TYPE_ACI_USER);
            }
            if (is_aci_user() && ($basic_details['aci_rec'] == VALUE_ZERO || $basic_details['aci_rec'] == VALUE_TWO)) {
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

    function reverify_application() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $ews_certificate_id = get_from_post('ews_certificate_id_for_ews_certificate_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$ews_certificate_id || $ews_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if (!is_mamlatdar_user() && !is_talathi_user() && !is_aci_user()) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            if (is_mamlatdar_user()) {
                $update_data['to_type_reverify'] = get_from_post('to_type_reverify_for_ews_certificate');
                if (!$update_data['to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['mam_reverify_remarks'] = get_from_post('mam_reverify_remarks_for_ews_certificate');
                if (!$update_data['mam_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['mam_to_reverify_datetime'] = date('Y-m-d H:i:s');
                $update_data['status'] = VALUE_THREE;
            }
            if (is_talathi_user()) {
                $update_data['talathi_to_type_reverify'] = get_from_post('talathi_to_type_reverify_for_ews_certificate');
                if (!$update_data['talathi_to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['income_by_talathi_reverify'] = get_from_post('income_by_talathi_reverify_for_ews_certificate');
                $update_data['is_upload_reverification_doc'] = get_from_post('upload_reverification_document_for_ews_certificate');
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
                    $this->_update_field_doc_items($session_user_id, $ews_certificate_id, $exi_field_doc_items, $new_field_doc_items);
                }
                $update_data['talathi_reverify_remarks'] = get_from_post('talathi_reverify_remarks_for_ews_certificate');
                if (!$update_data['talathi_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['talathi_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_aci_user()) {
                $update_data['aci_rec_reverify'] = get_from_post('aci_rec_reverify_for_ews_certificate');
                if (!$update_data['aci_rec_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['aci_reverify_remarks'] = get_from_post('aci_reverify_remarks_for_ews_certificate');
                if (!$update_data['aci_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($update_data['aci_rec_reverify'] == VALUE_ONE) {
                    $update_data['aci_to_ldc'] = get_from_post('aci_to_ldc_reverify_for_ews_certificate');
                    if (!$update_data['aci_to_ldc']) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                    $update_data['aci_to_ldc_datetime'] = date('Y-m-d H:i:s');
                }
                $update_data['aci_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_admin() || is_ldc_user()) {
                $ldc_applicant_name = get_from_post('ldc_applicant_name_for_ews_certificate');
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
                $ldc_financial_year = get_from_post('ldc_financial_year_for_ews_certificate');
                if (!$ldc_financial_year) {
                    echo json_encode(get_error_array(FINANCIAL_YEAR_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar_remarks = get_from_post('ldc_to_mamlatdar_remarks_for_ews_certificate');
                if (!$ldc_to_mamlatdar_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar = get_from_post('ldc_to_mamlatdar_for_ews_certificate');
                if (!$ldc_to_mamlatdar) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('ews_certificate_id', $ews_certificate_id, 'ews_certificate', $update_data);
            $ews_certificate_data = $this->ews_certificate_model->get_basic_data_for_ec($ews_certificate_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = is_mamlatdar_user() ? APP_REVERIFY_MESSAGE : APP_FORWARDED_MESSSAGE;
            $success_array['ews_certificate_data'] = $ews_certificate_data;
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
            $ews_certificate_id = get_from_post('ews_certificate_id_for_ews_certificate_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$ews_certificate_id || $ews_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            if (is_admin() || is_talathi_user()) {
                $income_by_talathi = get_from_post('income_by_talathi_for_ews_certificate');

                $is_upload_verification_doc = get_from_post('upload_verification_document_for_ews_certificate');
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
                $talathi_remarks = get_from_post('talathi_remarks_for_ews_certificate');
                if (!$talathi_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $talathi_to_aci = get_from_post('talathi_to_aci_for_ews_certificate');
                if (!$talathi_to_aci) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if (is_admin() || is_aci_user()) {
                $aci_rec = get_from_post('aci_rec_for_ews_certificate');
                if (!$aci_rec) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $aci_remarks = get_from_post('aci_remarks_for_ews_certificate');
                if (!$aci_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($aci_rec == VALUE_ONE) {
                    $aci_to_ldc = get_from_post('aci_to_ldc_for_ews_certificate');
                    if (!$aci_to_ldc) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
                if ($aci_rec == VALUE_TWO) {
                    $aci_to_mamlatdar = get_from_post('aci_to_mamlatdar_for_ews_certificate');
                    if (!$aci_to_mamlatdar) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
            }
            if (is_admin() || is_ldc_user()) {
                $constitution_artical = $this->input->post('constitution_artical_for_ews_certificate');
                if ($constitution_artical != VALUE_ONE && $constitution_artical != VALUE_TWO) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                $ldc_applicant_name = get_from_post('ldc_applicant_name_for_ews_certificate');
                if (!$ldc_applicant_name) {
                    echo json_encode(get_error_array(APPLICANT_NAME_MESSAGE));
                    return false;
                }
                if ($constitution_artical == VALUE_TWO) {
                    $ldc_minor_child_name = get_from_post('ldc_minor_child_name_for_ews_certificate');
                    if (!$ldc_minor_child_name) {
                        echo json_encode(get_error_array(MINOR_CHILD_NAME_MESSAGE));
                        return false;
                    }
                }
                $ldc_pr = get_from_post('ldc_pr_for_ews_certificate');
                if (!$ldc_pr) {
                    echo json_encode(get_error_array(PERMANENT_RESIDENCE_MESSAGE));
                    return false;
                }
                $ldc_address = get_from_post('ldc_address_for_ews_certificate');
                if (!$ldc_address) {
                    echo json_encode(get_error_array(ADDRESS_MESSAGE));
                    return false;
                }
                $com_pincode = get_from_post('com_pincode');
                if (!$com_pincode) {
                    echo json_encode(get_error_array(PINCODE_MESSAGE));
                    return false;
                }
                $post_office = get_from_post('ldc_post_office_for_ews_certificate');
                if (!$post_office) {
                    echo json_encode(get_error_array(POST_OFFICE_MESSAGE));
                    return false;
                }
                $ldc_religion_caste = get_from_post('ldc_religion_caste_for_ews_certificate');
                if (!$ldc_religion_caste) {
                    echo json_encode(get_error_array(RELIGION_CAST_MESSAGE));
                    return false;
                }
                $ldc_financial_year = get_from_post('ldc_financial_year_for_ews_certificate');
                if (!$ldc_financial_year) {
                    echo json_encode(get_error_array(FINANCIAL_YEAR_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar_remarks = get_from_post('ldc_to_mamlatdar_remarks_for_ews_certificate');
                if (!$ldc_to_mamlatdar_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_ldc_mam_details = get_from_post('update_ldc_mam_details');
                if ($update_ldc_mam_details == VALUE_ONE) {
                    $ldc_to_mamlatdar = get_from_post('ldc_to_mamlatdar_for_ews_certificate');
                    if (!$ldc_to_mamlatdar) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
            }
            $this->db->trans_start();
            $temp_talathi_data = array();
            $temp_aci_data = array();
            $basic_detail_data = array();
            if (is_admin() || is_talathi_user()) {
                $temp_talathi_data = $this->utility_model->get_by_id('sa_user_id', $session_user_id, 'sa_users');
                $basic_detail_data['talathi'] = $session_user_id;
                $basic_detail_data['income_by_talathi'] = $income_by_talathi;
                $basic_detail_data['is_upload_verification_doc'] = $is_upload_verification_doc;
                $basic_detail_data['talathi_remarks'] = $talathi_remarks;
                $basic_detail_data['talathi_to_aci'] = $talathi_to_aci;
                $basic_detail_data['talathi_to_aci_datetime'] = date('Y-m-d H:i:s');

                if ($is_upload_verification_doc == VALUE_ONE) {
                    $this->_update_field_doc_items($session_user_id, $ews_certificate_id, $exi_field_doc_items, $new_field_doc_items);
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
                if ($constitution_artical == VALUE_TWO) {
                    $basic_detail_data['ldc_minor_child_name'] = $ldc_minor_child_name;
                }
                $basic_detail_data['ldc_pr'] = $ldc_pr;
                $basic_detail_data['ldc_address'] = $ldc_address;
                $basic_detail_data['com_pincode'] = $com_pincode;
                $basic_detail_data['present_post_office'] = $post_office;
                $basic_detail_data['ldc_religion_caste'] = $ldc_religion_caste;
                $basic_detail_data['ldc_financial_year'] = $ldc_financial_year;
                $basic_detail_data['ldc_to_mamlatdar_remarks'] = $ldc_to_mamlatdar_remarks;
                if ($update_ldc_mam_details == VALUE_ONE) {
                    $basic_detail_data['ldc_to_mamlatdar'] = $ldc_to_mamlatdar;
                    $basic_detail_data['ldc_to_mamlatdar_datetime'] = date('Y-m-d H:i:s');
                }
            }
            $basic_detail_data['updated_by'] = $session_user_id;
            $basic_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('ews_certificate_id', $ews_certificate_id, 'ews_certificate', $basic_detail_data);
            $dc_data = $this->ews_certificate_model->get_basic_data_for_ec($ews_certificate_id);
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
//            $success_array['message'] = APP_FORWARDED_MESSSAGE;
            $success_array['ews_certificate_id'] = $ews_certificate_id;
            $success_array['ews_certificate_data'] = $dc_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function document_for_scrutiny() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $ews_certificate_id = get_from_post('ews_certificate_id_for_scrutiny');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$ews_certificate_id || $ews_certificate_id == NULL) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ec_data = $this->ews_certificate_model->get_basic_data_for_ec($ews_certificate_id);
            if (empty($ec_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_data = $this->utility_model->query_data_for_scrutiny(VALUE_SEVEN, $ews_certificate_id);

            $field_verification_doc_data = $this->utility_model->field_verification_document_data_for_scrutiny(VALUE_SEVEN, $ews_certificate_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('ews_certificate/pdf', $ec_data, TRUE));

            $temp_filename = 'basic_ec_' . $ews_certificate_id . '_' . time() . '.pdf';
            $temp_filepath = 'documents/temp/' . $temp_filename;

            $temp_files_to_remove = array();
            $temp_files_to_merge = array();
            array_push($temp_files_to_remove, $temp_filepath);
            array_push($temp_files_to_merge, $temp_filepath);

            if ($ec_data['birth_certificate_doc'] != '') {
                $doc_one = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['birth_certificate_doc']);
                array_push($temp_files_to_remove, $doc_one);
                array_push($temp_files_to_merge, $doc_one);
            }
            if ($ec_data['address_proof_doc'] != '') {
                $doc_two = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['address_proof_doc']);
                array_push($temp_files_to_remove, $doc_two);
                array_push($temp_files_to_merge, $doc_two);
            }
            if ($ec_data['id_proof_doc'] != '') {
                $doc_three = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['id_proof_doc']);
                array_push($temp_files_to_remove, $doc_three);
                array_push($temp_files_to_merge, $doc_three);
            }
            if ($ec_data['incometax_return_doc'] != '') {
                $doc_four = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['incometax_return_doc']);
                array_push($temp_files_to_remove, $doc_four);
                array_push($temp_files_to_merge, $doc_four);
            }
            if ($ec_data['agricultural_detail_doc'] != '') {
                $doc_five = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['agricultural_detail_doc']);
                array_push($temp_files_to_remove, $doc_five);
                array_push($temp_files_to_merge, $doc_five);
            }
            if ($ec_data['immovable_property_doc'] != '') {
                $doc_six = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['immovable_property_doc']);
                array_push($temp_files_to_remove, $doc_six);
                array_push($temp_files_to_merge, $doc_six);
            }
            if ($ec_data['pancard_doc'] != '') {
                $doc_seven = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['pancard_doc']);
                array_push($temp_files_to_remove, $doc_seven);
                array_push($temp_files_to_merge, $doc_seven);
            }
            if ($ec_data['affidativet_immovable_property_doc'] != '') {
                $doc_eight = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['affidativet_immovable_property_doc']);
                array_push($temp_files_to_remove, $doc_eight);
                array_push($temp_files_to_merge, $doc_eight);
            }
            if ($ec_data['election_card_doc'] != '') {
                $doc_nine = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['election_card_doc']);
                array_push($temp_files_to_remove, $doc_nine);
                array_push($temp_files_to_merge, $doc_nine);
            }
            if ($ec_data['father_election_card_doc'] != '') {
                $father_election = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['father_election_card_doc']);
                array_push($temp_files_to_remove, $father_election);
                array_push($temp_files_to_merge, $father_election);
            }
            if ($ec_data['mother_election_card_doc'] != '') {
                $mother_election = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['mother_election_card_doc']);
                array_push($temp_files_to_remove, $mother_election);
                array_push($temp_files_to_merge, $mother_election);
            }
            if ($ec_data['aadhar_card_doc'] != '') {
                $doc_ten = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['aadhar_card_doc']);
                array_push($temp_files_to_remove, $doc_ten);
                array_push($temp_files_to_merge, $doc_ten);
            }
            if ($ec_data['father_aadhar_card_doc'] != '') {
                $father_aadhar = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['father_aadhar_card_doc']);
                array_push($temp_files_to_remove, $father_aadhar);
                array_push($temp_files_to_merge, $father_aadhar);
            }
            if ($ec_data['mother_aadhar_card_doc'] != '') {
                $mother_aadhar = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['mother_aadhar_card_doc']);
                array_push($temp_files_to_remove, $mother_aadhar);
                array_push($temp_files_to_merge, $mother_aadhar);
            }

            if ($ec_data['leaving_certificate_doc'] != '') {
                $doc_eleven = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['leaving_certificate_doc']);
                array_push($temp_files_to_remove, $doc_eleven);
                array_push($temp_files_to_merge, $doc_eleven);
            }
            if ($ec_data['community_certificate_doc'] != '') {
                $doc_twelve = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['community_certificate_doc']);
                array_push($temp_files_to_remove, $doc_twelve);
                array_push($temp_files_to_merge, $doc_twelve);
            }
            if ($ec_data['father_mother_community_certificate_doc'] != '') {
                $fm_community_cert = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['father_mother_community_certificate_doc']);
                array_push($temp_files_to_remove, $fm_community_cert);
                array_push($temp_files_to_merge, $fm_community_cert);
            }
            if ($ec_data['caste_certificate_doc'] != '') {
                $doc_therteen = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['caste_certificate_doc']);
                array_push($temp_files_to_remove, $doc_therteen);
                array_push($temp_files_to_merge, $doc_therteen);
            }
            if ($ec_data['father_mother_caste_certificate_doc'] != '') {
                $fm_caste_cert = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['father_mother_caste_certificate_doc']);
                array_push($temp_files_to_remove, $fm_caste_cert);
                array_push($temp_files_to_merge, $fm_caste_cert);
            }
            if ($ec_data['gazeted_copy_doc'] != '') {
                $doc_fourteen = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['gazeted_copy_doc']);
                array_push($temp_files_to_remove, $doc_fourteen);
                array_push($temp_files_to_merge, $doc_fourteen);
            }
            if ($ec_data['domicile_certificate_doc'] != '') {
                $domicile_cert = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['domicile_certificate_doc']);
                array_push($temp_files_to_remove, $domicile_cert);
                array_push($temp_files_to_merge, $domicile_cert);
            }
            if ($ec_data['father_mother_domicile_certificate_doc'] != '') {
                $fm_domicile_cert = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['father_mother_domicile_certificate_doc']);
                array_push($temp_files_to_remove, $fm_domicile_cert);
                array_push($temp_files_to_merge, $fm_domicile_cert);
            }
            if ($ec_data['house_tax_receipt'] != '') {
                $house_tax = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['house_tax_receipt']);
                array_push($temp_files_to_remove, $house_tax);
                array_push($temp_files_to_merge, $house_tax);
            }
            if ($ec_data['sale_deed_copy'] != '') {
                $sale_deed = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['sale_deed_copy']);
                array_push($temp_files_to_remove, $sale_deed);
                array_push($temp_files_to_merge, $sale_deed);
            }
            if ($ec_data['noc_with_notary'] != '') {
                $noc_with_notary = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['noc_with_notary']);
                array_push($temp_files_to_remove, $noc_with_notary);
                array_push($temp_files_to_merge, $noc_with_notary);
            }
            if ($ec_data['aggriment_with_notary'] != '') {
                $aggriment = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['aggriment_with_notary']);
                array_push($temp_files_to_remove, $aggriment);
                array_push($temp_files_to_merge, $aggriment);
            }
            if ($ec_data['other_doc'] != '') {
                $doc_fifteen = $this->_copy_file(EWS_CERTIFICATE_DOC_PATH, $ec_data['other_doc']);
                array_push($temp_files_to_remove, $doc_fifteen);
                array_push($temp_files_to_merge, $doc_fifteen);
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
                        $new_fvd_path = $this->_copy_file('documents/ews_certificate/', $fvd_data['document']);
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
            $final_filename = 'final_scrutiny_document_ec_' . rand(111111111, 99999999) . '_' . time() . '.pdf';
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

    function get_village_data_for_ews_certificate() {
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
//        if (!$state_code) {
//            echo json_encode(get_error_array(SELECT_STATE_MESSAGE));
//            return false;
//        }
            $district_code = get_from_post('district_code');
//        if (!$district_code) {
//            echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
//            return false;
//        }
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

    function get_name_data_for_ews_certificate() {
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

    function upload_field_verification_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $field_verification_document_id = get_from_post('field_document_id_for_field_verification');
            $verification_type = get_from_post('verification_type_for_field_verification');
            $ews_certificate_id = get_from_post('ews_certificate_id_for_ews_certificate_update_basic_detail');

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
            $main_path = $path . DIRECTORY_SEPARATOR . 'ews_certificate';
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
                $dr_data['module_type'] = VALUE_SEVEN;
                $dr_data['module_id'] = $ews_certificate_id;
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'ews_certificate' . DIRECTORY_SEPARATOR . $ex_data['document'];
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'ews_certificate' . DIRECTORY_SEPARATOR . $ex_data['document'];
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

    function _update_field_doc_items($session_user_id, $ews_certificate_id, $exi_field_doc_items, $new_field_doc_items) {
        if ($exi_field_doc_items != '') {
            if (!empty($exi_field_doc_items)) {
                foreach ($exi_field_doc_items as &$value) {
                    $value['module_id'] = $ews_certificate_id;
                    $value['updated_by'] = $session_user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->update_data_batch('field_verification_document_id', 'field_verification_document', $exi_field_doc_items);
            }
        }
        if ($new_field_doc_items != '') {
            if (!empty($new_field_doc_items)) {
                foreach ($new_field_doc_items as &$value) {
                    $value['module_id'] = $ews_certificate_id;
                    $value['created_by'] = $session_user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->insert_data_batch('field_verification_document', $new_field_doc_items);
            }
        }
    }

    function download_ec_declaration() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $ews_certificate_id = get_from_post('ews_certificate_id_for_ec_declaration');
            if ($user_id == null || !$user_id || $ews_certificate_id == null || !$ews_certificate_id) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $cc_data = $this->utility_model->get_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
            if (empty($cc_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view("ews_certificate/declaration", $cc_data, TRUE));
            $mpdf->Output('Declaration_' . $cc_data['application_number'] . '_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            $this->load->view('error', array('error_message' => $e->getMessage()));
            return;
        }
    }
}

/*
 * EOF: ./application/controller/ews_certificate.php
 */