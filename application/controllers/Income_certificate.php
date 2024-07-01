<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Income_certificate extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('income_certificate_model');
    }

    function get_income_certificate_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['income_certificate_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;

            $search_appno = get_from_post('app_no_for_income_certificate_list');
            $search_appd = get_from_post('application_date_for_income_certificate_list');
            $search_appdet = filter_var(get_from_post('app_details_for_income_certificate_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_income_certificate_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_income_certificate_list');
            $search_cohand = get_from_post('currently_on_for_income_certificate_list');
            $search_appostatus = get_from_post('appointment_status_for_income_certificate_list');
            $search_qstatus = get_from_post('query_status_for_income_certificate_list');
            $search_status = get_from_post('status_for_income_certificate_list');

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
            $success_array['income_certificate_data'] = $this->income_certificate_model->get_all_income_certificate_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->income_certificate_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_appostatus != '' || $search_cohand != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->income_certificate_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['income_certificate_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['income_certificate_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_income_certificate_data_by_id() {
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
            $income_certificate_id = get_from_post('income_certificate_id');
            if (!$income_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $income_certificate_data = $this->utility_model->get_by_id('income_certificate_id', $income_certificate_id, 'income_certificate');
            if (empty($income_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ti_bd = $this->_calculate_total_income_and_basic_details($income_certificate_data);
            $income_certificate_data['total_income'] = indian_comma_income($ti_bd['total_income']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['income_certificate_data'] = $income_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_income_certificate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $module_type = get_from_post('module_type');
            $income_certificate_id = get_from_post('income_certificate_id_for_income_certificate');
            if (!is_post() || $user_id == NULL || !$user_id || $income_certificate_id == NULL || !$income_certificate_id ||
                    ($module_type != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $income_certificate_data = $this->_get_post_data_for_income_certificate();
            $validation_message = $this->_check_validation_for_income_certificate($income_certificate_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            if ($income_certificate_data['applicant_have_earning_member'] == VALUE_ONE) {
                $member_details = $this->input->post('family_member_info');
                if (empty($member_details)) {
                    echo json_encode(get_error_array(ONE_FAMILY_MEMBER_MESSAGE));
                    return false;
                }
            }
            if ($income_certificate_data['if_applicant_have_children'] == VALUE_ONE)
                $children_details = $this->input->post('children_info');
            // if (empty($children_details)) {
            //     echo json_encode(get_error_array(ONE_CHILDREN_DETAIL_MESSAGE));
            //     return false;
            // }
            if ($income_certificate_data['if_wife_husband_have_property'] == VALUE_ONE)
                $property_details = $this->input->post('property_info');
            // if (empty($children_details)) {
            //     echo json_encode(get_error_array(ONE_CHILDREN_DETAIL_MESSAGE));
            //     return false;
            // }
            if ($income_certificate_data['have_you_any_member_income_otherside'] == VALUE_ONE)
                $other_income_details = $this->input->post('other_income_info');
            // if (empty($children_details)) {
            //     echo json_encode(get_error_array(ONE_CHILDREN_DETAIL_MESSAGE));
            //     return false;
            // }
            $this->db->trans_start();
            if ($income_certificate_data['applicant_have_earning_member'] == VALUE_ONE)
                $income_certificate_data['member_details'] = json_encode($member_details);
            if ($income_certificate_data['if_applicant_have_children'] == VALUE_ONE)
                $income_certificate_data['children_details'] = json_encode($children_details);
            if ($income_certificate_data['if_wife_husband_have_property'] == VALUE_ONE)
                $income_certificate_data['property_details'] = json_encode($property_details);
            if ($income_certificate_data['have_you_any_member_income_otherside'] == VALUE_ONE)
                $income_certificate_data['other_income_details'] = json_encode($other_income_details);
            $income_certificate_data['applicant_dob'] = convert_to_mysql_date_format($income_certificate_data['applicant_dob']);
            //$income_certificate_data['declaration_date'] = convert_to_mysql_date_format($income_certificate_data['declaration_date']);
            $income_certificate_data['updated_by'] = $user_id;
            $income_certificate_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('income_certificate_id', $income_certificate_id, 'income_certificate', $income_certificate_data);
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

    function _get_post_data_for_income_certificate() {
        $income_certificate_data = array();
        if (is_admin()) {
            $income_certificate_data['district'] = get_from_post('district_for_income_certificate');
        }
        $income_certificate_data['communication_address'] = get_from_post('communication_address_for_income_certificate');
        $income_certificate_data['mobile_number'] = get_from_post('mobile_number_for_income_certificate');
        $income_certificate_data['applicant_name'] = get_from_post('applicant_name_for_income_certificate');
        $income_certificate_data['applicant_nationality'] = get_from_post('applicant_nationality_for_income_certificate');
        $income_certificate_data['applicant_address'] = get_from_post('applicant_address_for_income_certificate');
        $income_certificate_data['village_dmc_ward'] = get_from_post('village_dmc_ward_for_income_certificate');
        $income_certificate_data['applicant_dob'] = get_from_post('applicant_dob_for_income_certificate');
        $income_certificate_data['applicant_age'] = get_from_post('applicant_age_for_income_certificate');
        $income_certificate_data['applicant_born_place'] = get_from_post('applicant_born_place_for_income_certificate');
        $income_certificate_data['gender'] = get_from_post('gender_for_income_certificate');
        $income_certificate_data['marital_status'] = get_from_post('marital_status_for_income_certificate');
        $income_certificate_data['applicant_occupation'] = get_from_post('applicant_occupation_for_income_certificate');
        if ($income_certificate_data['applicant_occupation'] == VALUE_TWELVE)
            $income_certificate_data['applicant_other_occupation'] = get_from_post('applicant_other_occupation_text_for_income_certificate');
        $income_certificate_data['applicant_yearly_income'] = get_from_post('applicant_yearly_income_for_income_certificate');
        $income_certificate_data['father_name'] = get_from_post('father_name_for_income_certificate');
        $income_certificate_data['father_occupation'] = get_from_post('father_occupation_for_income_certificate');
        if ($income_certificate_data['father_occupation'] == VALUE_NINE)
            $income_certificate_data['father_other_occupation'] = get_from_post('father_other_occupation_text_for_income_certificate');
        $income_certificate_data['mother_name'] = get_from_post('mother_name_for_income_certificate');
        $income_certificate_data['mother_occupation'] = get_from_post('mother_occupation_for_income_certificate');
        if ($income_certificate_data['mother_occupation'] == VALUE_NINE)
            $income_certificate_data['mother_other_occupation'] = get_from_post('mother_other_occupation_text_for_income_certificate');
        if ($income_certificate_data['marital_status'] == 1 || $income_certificate_data['marital_status'] == 3) {
            $income_certificate_data['spouse_name'] = get_from_post('spouse_name_for_income_certificate');
            $income_certificate_data['spouse_occupation'] = get_from_post('spouse_occupation_for_income_certificate');
            if ($income_certificate_data['spouse_occupation'] == VALUE_NINE)
                $income_certificate_data['spouse_other_occupation'] = get_from_post('spouse_other_occupation_text_for_income_certificate');
        }
        $income_certificate_data['if_wife_husband_have_property'] = get_from_post('if_wife_husband_have_property_for_income_certificate');
        $income_certificate_data['applicant_have_earning_member'] = get_from_post('applicant_have_earning_member_for_income_certificate');
        $income_certificate_data['have_you_any_member_income_otherside'] = get_from_post('have_you_any_member_income_otherside_for_income_certificate');
        $income_certificate_data['if_applicant_have_children'] = get_from_post('if_applicant_have_children_for_income_certificate');
        $income_certificate_data['purpose_of_income_certificate'] = get_from_post('purpose_of_income_certificate_for_income_certificate');
        $income_certificate_data['did_you_apply_income_certificate_before'] = get_from_post('did_you_apply_income_certificate_before_for_income_certificate');
        $income_certificate_data['when_you_apply_income_certificate'] = $income_certificate_data['did_you_apply_income_certificate_before'] == VALUE_ONE ? get_from_post('when_you_apply_income_certificate_for_income_certificate') : '';
        $income_certificate_data['aadhar_number'] = get_from_post('aadhar_number_for_income_certificate');
        $income_certificate_data['email'] = get_from_post('email_for_income_certificate');
        $income_certificate_data['have_you_income_proof'] = get_from_post('have_you_income_proof_for_income_certificate');
        return $income_certificate_data;
    }

    function _check_validation_for_income_certificate($income_certificate_data) {
        if (is_admin()) {
            if (!$income_certificate_data['district']) {
                return SELECT_DISTRICT_MESSAGE;
            }
        }
        if (!$income_certificate_data['communication_address']) {
            return COMMUNICATION_ADDRESS_MESSAGE;
        }
        if (!$income_certificate_data['mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!$income_certificate_data['applicant_name']) {
            return APPLICANT_NAME_MESSAGE;
        }
        if (!$income_certificate_data['applicant_address']) {
            return COMMUNICATION_ADDRESS_MESSAGE;
        }
        if (!$income_certificate_data['applicant_dob']) {
            return BIRTH_DATE_MESSAGE;
        }
        if (!$income_certificate_data['applicant_born_place']) {
            return BORN_PLACE_MESSAGE;
        }
        // if (!$income_certificate_data['applicant_profession']) {
        //     return ONE_OPTION_MESSAGE;
        // }
        if (!$income_certificate_data['gender']) {
            return GENDER_MESSAGE;
        }
        if (!$income_certificate_data['marital_status']) {
            return MARRITIAL_STATUS_MESSAGE;
        }
        if (!$income_certificate_data['applicant_occupation']) {
            return APPLICANT_OCCUPATION_MESSAGE;
        }
        if ($income_certificate_data['applicant_occupation'] == VALUE_TWELVE) {
            if (!$income_certificate_data['applicant_other_occupation']) {
                return OTHER_OCCUPATION_MESSAGE;
            }
        }
        if (!$income_certificate_data['applicant_yearly_income'] && $income_certificate_data['applicant_yearly_income'] != 0) {
            return APPLICANT_YEARLY_INCOME_MESSAGE;
        }
        if (!$income_certificate_data['father_name']) {
            return FATHER_NAME_MESSAGE;
        }
        if (!$income_certificate_data['father_occupation']) {
            return FATHER_OCCUPATION_MESSAGE;
        }
        if (!$income_certificate_data['mother_name']) {
            return MOTHER_NAME_MESSAGE;
        }
        if (!$income_certificate_data['mother_occupation']) {
            return MOTHER_OCCUPATION_MESSAGE;
        }
        if ($income_certificate_data['marital_status'] == 1 || $income_certificate_data['marital_status'] == 3) {
            if (!$income_certificate_data['spouse_name']) {
                return SPOUSE_NAME_MESSAGE;
            }
            if (!$income_certificate_data['spouse_occupation']) {
                return SPOUSE_OCCUPATION_MESSAGE;
            }
        }

        // if (!$income_certificate_data['earning_members_in_family']) {
        //     return FAMILY_MEMBER_MESSAGE;
        // }
        if (!$income_certificate_data['purpose_of_income_certificate']) {
            return PURPOSE_OF_INCOMECERTY_MESSAGE;
        }
        // if (!$income_certificate_data['declaration_date']) {
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
            $income_certificate_id = get_from_post('income_certificate_id_for_income_certificate_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$income_certificate_id || $income_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if (!is_mamlatdar_user() && !is_talathi_user() && !is_aci_user()) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            if (is_mamlatdar_user()) {
                $update_data['to_type_reverify'] = get_from_post('to_type_reverify_for_income_certificate');
                if (!$update_data['to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['mam_reverify_remarks'] = get_from_post('mam_reverify_remarks_for_income_certificate');
                if (!$update_data['mam_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['mam_to_reverify_datetime'] = date('Y-m-d H:i:s');
                $update_data['status'] = VALUE_THREE;
            }
            if (is_talathi_user()) {
                $update_data['talathi_to_type_reverify'] = get_from_post('talathi_to_type_reverify_for_income_certificate');
                if (!$update_data['talathi_to_type_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['income_by_talathi_reverify'] = get_from_post('income_by_talathi_reverify_for_income_certificate');
                $update_data['is_upload_reverification_doc'] = get_from_post('upload_reverification_document_for_income_certificate');
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
                    $this->_update_field_doc_items($session_user_id, $income_certificate_id, $exi_field_doc_items, $new_field_doc_items);
                }
                $update_data['talathi_reverify_remarks'] = get_from_post('talathi_reverify_remarks_for_income_certificate');
                if (!$update_data['talathi_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_data['talathi_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            if (is_aci_user()) {
                $update_data['aci_rec_reverify'] = get_from_post('aci_rec_reverify_for_income_certificate');
                if (!$update_data['aci_rec_reverify']) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $update_data['aci_reverify_remarks'] = get_from_post('aci_reverify_remarks_for_income_certificate');
                if (!$update_data['aci_reverify_remarks']) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($update_data['aci_rec_reverify'] == VALUE_ONE) {
                    $update_data['aci_to_ldc'] = get_from_post('aci_to_ldc_reverify_for_income_certificate');
                    if (!$update_data['aci_to_ldc']) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                    $update_data['aci_to_ldc_datetime'] = date('Y-m-d H:i:s');
                }
                $update_data['aci_to_reverify_datetime'] = date('Y-m-d H:i:s');
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('income_certificate_id', $income_certificate_id, 'income_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('income_certificate_id', $income_certificate_id, 'income_certificate', $update_data);
            $income_certificate_data = $this->income_certificate_model->get_basic_data_for_ic($income_certificate_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = is_mamlatdar_user() ? APP_REVERIFY_MESSAGE : APP_FORWARDED_MESSSAGE;
            $success_array['income_certificate_data'] = $income_certificate_data;
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
            $income_certificate_id = get_from_post('income_certificate_id_for_income_certificate_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$income_certificate_id || $income_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_income_certificate_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('income_certificate_id', $income_certificate_id, 'income_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_TWO, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('income_certificate_id', $income_certificate_id, 'income_certificate', $update_data);

            $ex_data['status'] = $update_data['status'];
            $ex_data['status_datetime'] = $update_data['status_datetime'];
            error_reporting(E_ERROR);
            $data = array('income_certificate_data' => $ex_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($this->load->view('income_certificate/certificate', $data, TRUE));
            $certificate_path = 'documents/temp/final_certificate_ic-' . $income_certificate_id . rand(111111111, 99999999) . '_' . time() . '.pdf';
            $mpdf->Output($certificate_path, 'F');
            $cerificate_data = array();
            $cerificate_data['certificate'] = chunk_split(base64_encode(file_get_contents($certificate_path)));
            $cerificate_data['module_id'] = $income_certificate_id;
            $cerificate_data['module_type'] = VALUE_TWO;
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
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWO, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_TWO, $ex_data);
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
            $income_certificate_id = get_from_post('income_certificate_id_for_income_certificate_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$income_certificate_id || $income_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_income_certificate_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('income_certificate_id', $income_certificate_id, 'income_certificate');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_TWO, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('income_certificate_id', $income_certificate_id, 'income_certificate', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TWO, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_TWO, $ex_data);
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

    function get_income_certificate_data_by_income_certificate_id() {
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
            $income_certificate_id = get_from_post('income_certificate_id');
            if (!$income_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $income_certificate_data = $this->income_certificate_model->get_basic_data_for_ic($income_certificate_id);
            if (empty($income_certificate_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ti_bd = $this->_calculate_total_income_and_basic_details($income_certificate_data);
            $income_certificate_data['total_income'] = $ti_bd['total_income'];
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['income_certificate_data'] = $income_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_certificate() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $income_certificate_id = get_from_post('income_certificate_id_for_certificate');
            $mtype = get_from_post('mtype_for_certificate');
            if (!is_post() || $user_id == null || !$user_id || $income_certificate_id == null || !$income_certificate_id ||
                    ($mtype != VALUE_ONE && $mtype != VALUE_TWO)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            if ($mtype == VALUE_TWO) {
                $module_type = VALUE_TWO;
                $temp_qm_data = $this->config->item('query_module_array');
                $qm_data = isset($temp_qm_data[$module_type]) ? $temp_qm_data[$module_type] : array();
                if (empty($qm_data)) {
                    print_r(INVALID_ACCESS_MESSAGE);
                    return;
                }
                $existing_income_certificate_data = $this->utility_model->get_certificate_by_module_details($module_type, $income_certificate_id, $qm_data['key_id_text'], $qm_data['tbl_text']);
            } else {
                $existing_income_certificate_data = $this->utility_model->get_by_id('income_certificate_id', $income_certificate_id, 'income_certificate');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($existing_income_certificate_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if ($mtype == VALUE_TWO) {
                header('Content-type: application/pdf');
                header("Content-Transfer-Encoding: base64");
                $certificate = base64_decode($existing_income_certificate_data['certificate']);
                print_r($certificate);
            } else {
                error_reporting(E_ERROR);
                $data = array('income_certificate_data' => $existing_income_certificate_data, 'mtype' => $mtype);
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
                $mpdf->showWatermarkText = true;
                $mpdf->WriteHTML($this->load->view('income_certificate/certificate', $data, TRUE));
                $mpdf->Output('income_certificate_' . time() . '.pdf', 'I');
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
            $search_appno = get_from_post('app_no_for_icge');
            $search_appd = get_from_post('app_date_for_icge');
            $search_appdet = get_from_post('app_details_for_icge');
            $search_vdw = get_from_post('vdw_for_icge');
            $search_appostatus = get_from_post('app_status_for_icge');
            $search_cohand = get_from_post('currently_on_for_icge');
            $search_qstatus = get_from_post('qstatus_for_icge');
            $search_status = get_from_post('status_for_icge');
            $this->db->trans_start();
            $excel_data = $this->income_certificate_model->get_records_for_excel($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_appostatus, $search_cohand, $search_qstatus, $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Income_certificate_Report_' . date('Y-m-d H:i:s') . '.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('Application Number', 'Submitted On', 'Applicant Name', 'Applicant Address', 'Mobile Number',
                'District', 'Village / DMC Ward / SMC Ward', 'Income', 'Status', 'Query Status'));
            if (!empty($excel_data)) {
                $taluka_array = $this->config->item('taluka_array');
                $app_status_text_array = $this->config->item('app_status_text_array');
                $query_status_text_array = $this->config->item('query_status_text_array');
                $daman_villages_array = $this->config->item('daman_villages_array');
                $diu_villages_array = $this->config->item('diu_villages_array');
                $dnh_villages_array = $this->config->item('dnh_villages_array');
                foreach ($excel_data as $list) {
                    $villages_array = $list['district'] == TALUKA_DAMAN ? $daman_villages_array : ($list['district'] == TALUKA_DIU ? $diu_villages_array : ($list['district'] == TALUKA_DNH ? $dnh_villages_array : array()));
                    $list['village_dmc_ward'] = isset($villages_array[$list['village_dmc_ward']]) ? $villages_array[$list['village_dmc_ward']] : '';
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

    function get_appointment_data_by_income_certificate_id() {
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
            $income_certificate_id = get_from_post('income_certificate_id');
            if (!$income_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $appointment_data = $this->utility_model->get_appointment_data_by_id('income_certificate_id', $income_certificate_id, 'income_certificate');
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
            $income_certificate_id = get_from_post('income_certificate_id_for_income_certificate_set_appointment');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$income_certificate_id || $income_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_data = array();
            $ex_ap_data = $this->utility_model->get_by_id('income_certificate_id', $income_certificate_id, 'income_certificate');
            if (empty($ex_ap_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $appointment_date = get_from_post('appointment_date_for_income_certificate');
            $appointment_data['appointment_date'] = convert_to_mysql_date_format($appointment_date);
            $appointment_data['appointment_time'] = get_from_post('appointment_time_for_income_certificate');
            $appointment_data['appointment_by'] = $session_user_id;
            $appointment_data['appointment_by_name'] = get_from_session('name');
            $appointment_data['appointment_datetime'] = $appointment_data['appointment_date'] . ' ' . date("H:i:s", strtotime($appointment_data['appointment_time']));
            $appointment_data['online_statement'] = get_from_post('online_statement_for_income_certificate');
            $appointment_data['visit_office'] = get_from_post('visit_office_for_income_certificate');
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
            $this->utility_model->update_data('income_certificate_id', $income_certificate_id, 'income_certificate', $appointment_data);
            $income_certificate_data = $this->income_certificate_model->get_basic_data_for_ic($income_certificate_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            // Appointment Email & SMS
            $this->utility_lib->email_and_sms_for_certificate_appointment(VALUE_TWO, $income_certificate_data);

            $success_array = get_success_array();
            $success_array['message'] = APPOINTMENT_SET_MESSAGE;
            $success_array['income_certificate_data'] = $income_certificate_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_update_basic_detail_data_by_income_certificate_id() {
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
            $income_certificate_id = get_from_post('income_certificate_id');
            if (!$income_certificate_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $basic_details = $this->income_certificate_model->get_basic_data_for_ic($income_certificate_id);
            if (empty($basic_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($basic_details['query_status'] == VALUE_ONE || $basic_details['query_status'] == VALUE_TWO) {
                echo json_encode(get_error_array(APPLICATION_IN_QUERY_MESSAGE));
                return false;
            }
            $ti_bd = $this->_calculate_total_income_and_basic_details($basic_details);
            $basic_details['total_income'] = $ti_bd['total_income'];
            $aci_data = array();
            $mamlatdar_data = array();
            $ldc_data = array();

            $basic_details['field_documents'] = $this->utility_model->get_result_by_id('module_id', $income_certificate_id, 'field_verification_document', 'verification_type', VALUE_ONE, 'module_type', VALUE_TWO);

            $basic_details['field_reverify_documents'] = $this->utility_model->get_result_by_id('module_id', $income_certificate_id, 'field_verification_document', 'verification_type', VALUE_TWO, 'module_type', VALUE_TWO);

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
            $income_certificate_id = get_from_post('income_certificate_id_for_income_certificate_update_basic_detail');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$income_certificate_id || $income_certificate_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            if (is_admin() || is_talathi_user()) {
                $income_by_talathi = get_from_post('income_by_talathi_for_income_certificate');

                $is_upload_verification_doc = get_from_post('upload_verification_document_for_income_certificate');
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
                $talathi_remarks = get_from_post('talathi_remarks_for_income_certificate');
                if (!$talathi_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $talathi_to_aci = get_from_post('talathi_to_aci_for_income_certificate');
                if (!$talathi_to_aci) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if (is_admin() || is_aci_user()) {
                $aci_rec = get_from_post('aci_rec_for_income_certificate');
                if (!$aci_rec) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
                $aci_remarks = get_from_post('aci_remarks_for_income_certificate');
                if (!$aci_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                if ($aci_rec == VALUE_ONE) {
                    $aci_to_ldc = get_from_post('aci_to_ldc_for_income_certificate');
                    if (!$aci_to_ldc) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
                if ($aci_rec == VALUE_TWO) {
                    $aci_to_mamlatdar = get_from_post('aci_to_mamlatdar_for_income_certificate');
                    if (!$aci_to_mamlatdar) {
                        echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                        return false;
                    }
                }
            }
            if (is_admin() || is_ldc_user()) {
                $ldc_applicant_name = get_from_post('ldc_applicant_name_for_income_certificate');
                if (!$ldc_applicant_name) {
                    echo json_encode(get_error_array(APPLICANT_NAME_MESSAGE));
                    return false;
                }
                $communication_address = get_from_post('communication_address_for_income_certificate');
                if (!$communication_address) {
                    echo json_encode(get_error_array(COMMUNICATION_ADDRESS_MESSAGE));
                    return false;
                }
                $ldc_to_mamlatdar_remarks = get_from_post('ldc_to_mamlatdar_remarks_for_income_certificate');
                if (!$ldc_to_mamlatdar_remarks) {
                    echo json_encode(get_error_array(REMARKS_MESSAGE));
                    return false;
                }
                $update_ldc_mam_details = get_from_post('update_ldc_mam_details');
                if ($update_ldc_mam_details == VALUE_ONE) {
                    $ldc_to_mamlatdar = get_from_post('ldc_to_mamlatdar_for_income_certificate');
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
                $basic_detail_data['income_by_talathi'] = $income_by_talathi;
                $basic_detail_data['is_upload_verification_doc'] = $is_upload_verification_doc;
                $basic_detail_data['talathi_remarks'] = $talathi_remarks;
                $basic_detail_data['talathi_to_aci'] = $talathi_to_aci;
                $basic_detail_data['talathi_to_aci_datetime'] = date('Y-m-d H:i:s');

                if ($is_upload_verification_doc == VALUE_ONE) {
                    $this->_update_field_doc_items($session_user_id, $income_certificate_id, $exi_field_doc_items, $new_field_doc_items);
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
                $basic_detail_data['communication_address'] = $communication_address;
                $basic_detail_data['ldc_to_mamlatdar_remarks'] = $ldc_to_mamlatdar_remarks;
                if ($update_ldc_mam_details == VALUE_ONE) {
                    $basic_detail_data['ldc_to_mamlatdar'] = $ldc_to_mamlatdar;
                    $basic_detail_data['ldc_to_mamlatdar_datetime'] = date('Y-m-d H:i:s');
                }
            }
            $basic_detail_data['updated_by'] = $session_user_id;
            $basic_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('income_certificate_id', $income_certificate_id, 'income_certificate', $basic_detail_data);
            $ic_data = $this->income_certificate_model->get_basic_data_for_ic($income_certificate_id);
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
            $success_array['income_certificate_id'] = $income_certificate_id;
            $success_array['income_certificate_data'] = $ic_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _calculate_total_income_and_basic_details($ic_data) {
        $temp = array();
        $temp['total_income'] = $ic_data['applicant_yearly_income'];
        $total_members_cnt = 1;
        if ($ic_data['father_occupation'] != VALUE_EIGHT) {
            $total_members_cnt++;
        }
        if ($ic_data['mother_occupation'] != VALUE_EIGHT) {
            $total_members_cnt++;
        }
        if ($ic_data['spouse_occupation'] != VALUE_EIGHT) {
            $total_members_cnt++;
        }
        $temp['total_members'] = $total_members_cnt;
        $temp['total_earning_members'] = $ic_data['applicant_yearly_income'] == VALUE_ZERO ? VALUE_ZERO : VALUE_ONE;
        if ($ic_data['applicant_have_earning_member'] == VALUE_ONE) {
            $em_details = json_decode($ic_data['member_details'], TRUE);
            if (!empty($em_details)) {
                foreach ($em_details as $emd) {
                    $temp['total_income'] += (intval($emd['yearly_income']) ? intval($emd['yearly_income']) : 0);
                    $temp['total_earning_members'] += VALUE_ONE;
                }
            }
        }
        if ($ic_data['if_wife_husband_have_property'] == VALUE_ONE) {
            $p_details = json_decode($ic_data['property_details'], TRUE);
            if (!empty($p_details)) {
                foreach ($p_details as $pd) {
                    $temp['total_income'] += (intval($pd['income_of_property']) ? intval($pd['income_of_property']) : 0);
                }
            }
        }
        if ($ic_data['have_you_any_member_income_otherside'] == VALUE_ONE) {
            $oi_details = json_decode($ic_data['other_income_details'], TRUE);
            if (!empty($oi_details)) {
                foreach ($oi_details as $oid) {
                    $temp['total_income'] += (intval($oid['amount_of_income']) ? intval($oid['amount_of_income']) : 0);
                }
            }
        }
        if ($ic_data['if_applicant_have_children'] == VALUE_ONE) {
            $cd_details = json_decode($ic_data['children_details'], TRUE);
            if (!empty($cd_details)) {
                $temp['total_members'] += count($cd_details);
            }
        }
        return $temp;
    }

    function document_for_scrutiny() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $income_certificate_id = get_from_post('income_certificate_id_for_scrutiny');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$income_certificate_id || $income_certificate_id == NULL) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ic_data = $this->income_certificate_model->get_basic_data_for_ic($income_certificate_id);
            if (empty($ic_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }

            $query_data = $this->utility_model->query_data_for_scrutiny(VALUE_TWO, $income_certificate_id);

            $field_verification_doc_data = $this->utility_model->field_verification_document_data_for_scrutiny(VALUE_TWO, $income_certificate_id);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }

            $ti_bd = $this->_calculate_total_income_and_basic_details($ic_data);
            $ic_data['total_income'] = $ti_bd['total_income'];
            $ic_data['total_members'] = $ti_bd['total_members'];
            $ic_data['total_earning_members'] = $ti_bd['total_earning_members'];
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('income_certificate/pdf', $ic_data, TRUE));

            $temp_filename = 'basic_ic_' . $income_certificate_id . '_' . time() . '.pdf';
            $temp_filepath = 'documents/temp/' . $temp_filename;
            //$mpdf->Output($temp_filepath, 'F');

            $temp_files_to_remove = array();
            $temp_files_to_merge = array();
            array_push($temp_files_to_remove, $temp_filepath);
            array_push($temp_files_to_merge, $temp_filepath);
            if ($ic_data['birth_leaving_certy_doc'] != '') {
                $new_bc_path = $this->_copy_file(INCOME_CERTIFICATE_DOC_PATH, $ic_data['birth_leaving_certy_doc']);
                array_push($temp_files_to_remove, $new_bc_path);
                array_push($temp_files_to_merge, $new_bc_path);
            }
            if ($ic_data['aadhar_card_doc'] != '') {
                $new_aadhar_path = $this->_copy_file(INCOME_CERTIFICATE_DOC_PATH, $ic_data['aadhar_card_doc']);
                array_push($temp_files_to_remove, $new_aadhar_path);
                array_push($temp_files_to_merge, $new_aadhar_path);
            }
            if ($ic_data['election_card_doc'] != '') {
                $new_ec_path = $this->_copy_file(INCOME_CERTIFICATE_DOC_PATH, $ic_data['election_card_doc']);
                array_push($temp_files_to_remove, $new_ec_path);
                array_push($temp_files_to_merge, $new_ec_path);
            }
            if ($ic_data['income_proof_doc'] != '') {
                $new_ip_path = $this->_copy_file(INCOME_CERTIFICATE_DOC_PATH, $ic_data['income_proof_doc']);
                array_push($temp_files_to_remove, $new_ip_path);
                array_push($temp_files_to_merge, $new_ip_path);
            }
            if ($ic_data['marriage_certificate_doc'] != '') {
                $new_mc_path = $this->_copy_file(INCOME_CERTIFICATE_DOC_PATH, $ic_data['marriage_certificate_doc']);
                array_push($temp_files_to_remove, $new_mc_path);
                array_push($temp_files_to_merge, $new_mc_path);
            }
            if ($ic_data['death_certificate_doc'] != '') {
                $new_dc_path = $this->_copy_file(INCOME_CERTIFICATE_DOC_PATH, $ic_data['death_certificate_doc']);
                array_push($temp_files_to_remove, $new_dc_path);
                array_push($temp_files_to_merge, $new_dc_path);
            }
            if ($ic_data['marital_status'] == VALUE_ONE) {
                if ($ic_data['spouse_aadhar_card_doc'] != '') {
                    $new_aadhar_path = $this->_copy_file(INCOME_CERTIFICATE_DOC_PATH, $ic_data['spouse_aadhar_card_doc']);
                    array_push($temp_files_to_remove, $new_aadhar_path);
                    array_push($temp_files_to_merge, $new_aadhar_path);
                }
                if ($ic_data['spouse_election_card_doc'] != '') {
                    $new_ec_path = $this->_copy_file(INCOME_CERTIFICATE_DOC_PATH, $ic_data['spouse_election_card_doc']);
                    array_push($temp_files_to_remove, $new_ec_path);
                    array_push($temp_files_to_merge, $new_ec_path);
                }
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
                        $new_fvd_path = $this->_copy_file('documents/income_certificate/', $fvd_data['document']);
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
            $final_filename = 'final_scrutiny_document_ic_' . rand(111111111, 99999999) . '_' . time() . '.pdf';
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
                if (($i + 1 ) != $pagecount) {
                    $mpdf->addPage();
                }
            }
        }
    }

    function download_ic_declaration() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $income_certificate_id = get_from_post('income_certificate_id_for_ic_declaration');
            if ($user_id == null || !$user_id || $income_certificate_id == null || !$income_certificate_id) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $ic_data = $this->utility_model->get_by_id('income_certificate_id', $income_certificate_id, 'income_certificate');
            if (empty($ic_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            $ti_bd = $this->_calculate_total_income_and_basic_details($ic_data);
            $ic_data['total_income'] = indian_comma_income($ti_bd['total_income']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return;
            }
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view("income_certificate/declaration", $ic_data, TRUE));
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
            $income_certificate_id = get_from_post('income_certificate_id_for_income_certificate_update_basic_detail');

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
            $main_path = $path . DIRECTORY_SEPARATOR . 'income_certificate';
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
                $dr_data['module_type'] = VALUE_TWO;
                $dr_data['module_id'] = $income_certificate_id;
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'income_certificate' . DIRECTORY_SEPARATOR . $ex_data['document'];
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'income_certificate' . DIRECTORY_SEPARATOR . $ex_data['document'];
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

    function _update_field_doc_items($session_user_id, $income_certificate_id, $exi_field_doc_items, $new_field_doc_items) {
        if ($exi_field_doc_items != '') {
            if (!empty($exi_field_doc_items)) {
                foreach ($exi_field_doc_items as &$value) {
                    $value['module_id'] = $income_certificate_id;
                    $value['updated_by'] = $session_user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->update_data_batch('field_verification_document_id', 'field_verification_document', $exi_field_doc_items);
            }
        }
        if ($new_field_doc_items != '') {
            if (!empty($new_field_doc_items)) {
                foreach ($new_field_doc_items as &$value) {
                    $value['module_id'] = $income_certificate_id;
                    $value['created_by'] = $session_user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->insert_data_batch('field_verification_document', $new_field_doc_items);
            }
        }
    }

}

/*
 * EOF: ./application/controller/Income_certificate.php
 */