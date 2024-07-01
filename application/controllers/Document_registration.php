<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Document_registration extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('document_registration_model');
    }

    function get_document_registration_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['document_registration_data'] = array();
            $success_array['recordsTotal'] = 0;
            $success_array['recordsFiltered'] = 0;
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            $search_district = is_admin() ? '' : $session_district;

            $search_docno = filter_var(get_from_post('doc_number_for_document_registration_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_tappno = filter_var(get_from_post('temp_application_number_for_document_registration_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_ppdetails = filter_var(get_from_post('party_details_for_document_registration_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_doctype = get_from_post('doc_type_for_document_registration_list');
            $search_appd = get_from_post('appointment_date_for_document_registration_list');
            $search_appd = $search_appd != '' ? convert_to_mysql_date_format($search_appd) : '';
            $search_qstatus = get_from_post('query_status_for_document_registration_list');
            $search_status = get_from_post('status_for_document_registration_list');
            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $success_array['document_registration_data'] = $this->document_registration_model->get_all_document_registration_list($start, $length, $search_district, $search_docno, $search_tappno, $search_ppdetails, $search_doctype, $search_appd, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->document_registration_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_docno != '' || $search_tappno != '' || $search_ppdetails != '' ||
                    $search_doctype != '' || $search_appd != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->document_registration_model->get_filter_count_of_records($search_district, $search_docno, $search_tappno, $search_ppdetails, $search_doctype, $search_appd, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['document_registration_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array = array();
            $success_array['document_registration_data'] = array();
            echo json_encode($success_array);
        }
    }

    function _get_post_data_for_step_one() {
        $step_one_data = array();
        $step_one_data['district'] = get_from_post('district_for_drsone');
        $step_one_data['doc_language'] = get_from_post('doc_language_for_drsone');
        $step_one_data['doc_type'] = get_from_post('doc_type_for_drsone');
        if ($step_one_data['doc_type'] == VALUE_TWENTYSEVEN) {
            $step_one_data['noy_lease'] = get_from_post('noy_lease_for_drsone');
            $step_one_data['nom_lease'] = get_from_post('nom_lease_for_drsone');
            $step_one_data['deposit'] = get_from_post('deposit_for_drsone');
            $step_one_data['yearly_rent'] = get_from_post('yearly_rent_for_drsone');
            $step_one_data['lease_period'] = get_from_post('lease_period');
        }
        $step_one_data['doc_consideration_amount'] = get_from_post('doc_consideration_amount_for_drsone');
        $step_one_data['fee_exemption'] = get_from_post('fee_exemption_for_drsone');
        $step_one_data['doc_execution_date'] = get_from_post('doc_execution_date_for_drsone');
        $step_one_data['dpe_type'] = get_from_post('dpe_type_for_drsone');
        if ($step_one_data['dpe_type'] == VALUE_ONE) {
            $step_one_data['dpe_state'] = get_from_post('dpe_state_for_drsone');
            $step_one_data['dpe_district'] = get_from_post('dpe_district_for_drsone');
        }
        if ($step_one_data['dpe_type'] == VALUE_TWO) {
            $step_one_data['dpe_country_name'] = get_from_post('dpe_country_name_for_drsone');
            $step_one_data['dpe_address'] = get_from_post('dpe_address_for_drsone');
        }
        $step_one_data['adv_dw_name'] = get_from_post('adv_dw_name_for_drsone');
        $step_one_data['aod_remarks'] = get_from_post('aod_remarks_for_drsone');
        return $step_one_data;
    }

    function _check_validation_for_step_one($step_one_data) {
        if (!$step_one_data['district']) {
            return DISTRICT_MESSAGE;
        }
        if (!$step_one_data['doc_language'] || !$step_one_data['doc_type'] ||
                !$step_one_data['fee_exemption']) {
            return ONE_OPTION_MESSAGE;
        }
        if ($step_one_data['doc_type'] == VALUE_TWENTYSEVEN) {
            if ($step_one_data['noy_lease'] == '' || $step_one_data['nom_lease'] == '') {
                return ONE_OPTION_MESSAGE;
            }
            if (!$step_one_data['yearly_rent']) {
                return RENT_MESSAGE;
            }
            if (!$step_one_data['lease_period']) {
                return LYLM_MESSAGE;
            }
        }
        if (!$step_one_data['doc_execution_date']) {
            return DATE_MESSAGE;
        }
        if (!$step_one_data['dpe_type']) {
            return ONE_OPTION_MESSAGE;
        }
        if ($step_one_data['dpe_type'] == VALUE_ONE) {
            if (!$step_one_data['dpe_state']) {
                return SELECT_STATE_MESSAGE;
            }
            if (!$step_one_data['dpe_district']) {
                return SELECT_DISTRICT_MESSAGE;
            }
        }
        if ($step_one_data['dpe_type'] == VALUE_TWO) {
            if (!$step_one_data['dpe_country_name']) {
                return NAME_MESSAGE;
            }
            if (!$step_one_data['dpe_address']) {
                return ADDRESS_MESSAGE;
            }
        }
        if (!$step_one_data['adv_dw_name']) {
            return NAME_MESSAGE;
        }
        return '';
    }

    function submit_step_one() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $document_registration_id = get_from_post('document_registration_id_for_dr');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $document_registration_id == NULL || !$document_registration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $step_one_data = $this->_get_post_data_for_step_one();
            $validation_message = $this->_check_validation_for_step_one($step_one_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $exi_drd_items = $this->input->post('exi_drd_items');
            if (empty($exi_drd_items)) {
                echo json_encode(get_error_array(ONE_USCDR_MESSAGE));
                return false;
            }
            $ex_dr_data = $this->document_registration_model->get_step_one_dr_pd_details($document_registration_id);
            if (empty($ex_dr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $step_one_data['doc_execution_date'] = convert_to_mysql_date_format($step_one_data['doc_execution_date']);
            $step_one_data['updated_by'] = $session_user_id;
            $step_one_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('document_registration_id', $document_registration_id, 'document_registration', $step_one_data);

            $this->_update_drd_items($session_user_id, $document_registration_id, $exi_drd_items);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $ex_dr_data['doc_consideration_amount'] = $step_one_data['doc_consideration_amount'];
            $success_array = get_success_array();
            $success_array['message'] = DR_BD_SAVED_MESSAGE;
            $success_array['new_pd_data'] = $ex_dr_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _update_drd_items($session_user_id, $document_registration_id, $exi_drd_items) {
        if ($exi_drd_items != '') {
            if (!empty($exi_drd_items)) {
                foreach ($exi_drd_items as &$edrdi) {
                    $edrdi['document_registration_id'] = $document_registration_id;
                    $edrdi['updated_by'] = $session_user_id;
                    $edrdi['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->update_data_batch('dr_document_id', 'dr_document', $exi_drd_items);
            }
        }
    }

    function get_document_registration_data_by_id() {
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
            $document_registration_id = get_from_post('document_registration_id');
            if (!$document_registration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE &&
                    $module_type != VALUE_FOUR && $module_type != VALUE_FIVE && $module_type != VALUE_SIX &&
                    $module_type != VALUE_SEVEN && $module_type != VALUE_EIGHT && $module_type != VALUE_NINE &&
                    $module_type != VALUE_TEN && $module_type != VALUE_ELEVEN) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $document_registration_data = array();
            if ($module_type == VALUE_ONE) {
                $document_registration_data = $this->utility_model->get_by_id('document_registration_id', $document_registration_id, 'document_registration');
                if (empty($document_registration_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                $document_registration_data['dr_documents'] = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_document');
            }
            if ($module_type == VALUE_TWO) {
                $document_registration_data = $this->document_registration_model->get_step_one_dr_pd_details($document_registration_id);
                if (empty($document_registration_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            if ($module_type == VALUE_THREE) {
                $temp_dr_data = $this->utility_model->get_by_id('document_registration_id', $document_registration_id, 'document_registration');
                if (empty($temp_dr_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                $document_registration_data = array();
                $document_registration_data['document_registration_id'] = $document_registration_id;
                $document_registration_data['temp_application_number'] = $temp_dr_data['temp_application_number'];
                $document_registration_data['doc_consideration_amount'] = $temp_dr_data['doc_consideration_amount'];
                $document_registration_data['new_opd_data'] = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_party_details', 'party_type', VALUE_TWO);
            }
            if ($module_type == VALUE_FOUR || $module_type == VALUE_FIVE || $module_type == VALUE_SEVEN ||
                    $module_type == VALUE_EIGHT || $module_type == VALUE_NINE) {
                $document_registration_data = $this->document_registration_model->get_dr_data_with_user_details($document_registration_id);
                if (empty($document_registration_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                if ($module_type == VALUE_FIVE) {
                    if ($document_registration_data['is_verified_app'] != VALUE_ZERO) {
                        echo json_encode(get_error_array(DR_AL_FORWARDED_MESSAGE));
                        return false;
                    }
                }
                $document_registration_data['dr_documents'] = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_document');
                $document_registration_data['dr_party_details'] = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_party_details');
                if ($document_registration_data['property_details_status'] == VALUE_ONE) {
                    $document_registration_data['dr_property_details'] = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_property_details');
                    $document_registration_data['pmv_relation'] = generate_array_for_id_object($this->utility_model->get_result_data_by_id('district', $document_registration_data['district'], 'pmv_relation'), 'pmv_relation_id');
                }
            }
            if ($module_type == VALUE_SIX || $module_type == VALUE_ELEVEN) {
                $document_registration_data = $this->document_registration_model->get_basic_dr_details($document_registration_id);
                if (empty($document_registration_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                if ($module_type == VALUE_ELEVEN) {
                    if ($document_registration_data['status'] == VALUE_FIVE || $document_registration_data['status'] == VALUE_SIX) {
                        echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                        return false;
                    }
                }
                if ($document_registration_data['is_changed_po'] == VALUE_ONE) {
                    $document_registration_data['dr_party_details'] = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_party_details', null, null, 'order', 'ASC');
                } else {
                    $document_registration_data['dr_party_details'] = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_party_details', null, null, 'party_category', 'ASC');
                }
            }
            if ($module_type == VALUE_TEN) {
                $document_registration_data = $this->utility_model->get_by_id('document_registration_id', $document_registration_id, 'document_registration');
                if (empty($document_registration_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
            }
            $success_array = get_success_array();
            $success_array['document_registration_data'] = $document_registration_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function check_details_for_endorsement() {
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
            $document_registration_id = get_from_post('dr_id');
            if (!$document_registration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $document_registration_data = $this->utility_model->get_by_id('document_registration_id', $document_registration_id, 'document_registration');
            if (empty($document_registration_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($document_registration_data['query_status'] == VALUE_ONE || $document_registration_data['query_status'] == VALUE_TWO) {
                echo json_encode(get_error_array(DR_RQ_AGE_MESSAGE));
                return false;
            }
            if ($document_registration_data['fee_receipt_number'] == VALUE_ZERO) {
                echo json_encode(get_error_array(DR_FEES_PENDING_MESSAGE));
                return false;
            }
            $dr_party_details = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_party_details');
            if (empty($dr_party_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            foreach ($dr_party_details as $drpd) {
                if ($drpd['party_photo'] == '') {
                    echo json_encode(get_error_array(DR_PHOTO_BIO_PENDING_MESSAGE));
                    return false;
                }
            }
            $success_array = get_success_array();
            $success_array['status'] = $document_registration_data['status'];
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_step_two() {
        $step_two_data = array();
        $step_two_data['party_category'] = get_from_post('party_category_for_drstwo');
        $step_two_data['party_description'] = get_from_post('party_description_for_drstwo');
        $step_two_data['is_poa_holder'] = get_from_post('is_poa_holder_for_drstwo');
        if ($step_two_data['is_poa_holder'] == VALUE_ONE) {
            $step_two_data['poa_principal_name'] = get_from_post('poa_principal_name_for_drstwo');
            $step_two_data['poa_type'] = get_from_post('poa_type_for_drstwo');
            $step_two_data['poa_description'] = get_from_post('poa_description_for_drstwo');
            $step_two_data['poa_principal_pd'] = get_from_post('poa_principal_pd_for_drstwo');
            $step_two_data['poa_execution_date'] = get_from_post('poa_execution_date_for_drstwo');
            $step_two_data['poa_execution_place'] = get_from_post('poa_execution_place_for_drstwo');
            $step_two_data['poa_witnesses'] = get_from_post('poa_witnesses_for_drstwo');
            $step_two_data['poa_notarised_advocate'] = get_from_post('poa_notarised_advocate_for_drstwo');
        }
        $step_two_data['party_name'] = get_from_post('party_name_for_drstwo');
        $step_two_data['party_address'] = get_from_post('party_address_for_drstwo');
        $step_two_data['party_pincode'] = get_from_post('party_pincode_for_drstwo');
        $step_two_data['party_state'] = get_from_post('party_state_for_drstwo');
        $step_two_data['party_district'] = get_from_post('party_district_for_drstwo');
        $step_two_data['party_birth_type'] = get_from_post('party_birth_type_for_drstwo');
        if ($step_two_data['party_birth_type'] == VALUE_ONE) {
            $step_two_data['party_dob'] = get_from_post('party_dob_for_drstwo');
        }
        if ($step_two_data['party_birth_type'] == VALUE_TWO) {
            $step_two_data['party_dob_year'] = get_from_post('party_dob_year_for_drstwo');
        }
        if ($step_two_data['party_birth_type'] == VALUE_THREE) {
            $step_two_data['party_age'] = get_from_post('party_age_for_drstwo');
        }
        $step_two_data['party_gender'] = get_from_post('party_gender_for_drstwo');
        $step_two_data['party_religion'] = get_from_post('party_religion_for_drstwo');
        $step_two_data['party_mobile_number'] = get_from_post('party_mobile_number_for_drstwo');
        $step_two_data['party_email_address'] = get_from_post('party_email_address_for_drstwo');
        $step_two_data['party_occupation'] = get_from_post('party_occupation_for_drstwo');
        $step_two_data['party_pan_type'] = get_from_post('party_pan_type_for_drstwo');
        if ($step_two_data['party_pan_type'] == VALUE_ONE) {
            $step_two_data['party_pan_number'] = strtoupper(get_from_post('party_pan_number_for_drstwo'));
        }
        $step_two_data['party_aadhar_number'] = get_from_post('party_aadhar_number_for_drstwo');
        $step_two_data['party_remarks'] = get_from_post('party_remarks_for_drstwo');
        return $step_two_data;
    }

    function _check_validation_for_pd($module_type, $party_data) {
        if (!$party_data['party_category']) {
            return ONE_OPTION_MESSAGE;
        }
        if (!$party_data['party_description']) {
            return ONE_OPTION_MESSAGE;
        }
        if ($module_type == VALUE_ONE) {
            if (!$party_data['is_poa_holder']) {
                return ONE_OPTION_MESSAGE;
            }
            if ($party_data['is_poa_holder'] == VALUE_ONE) {
                if (!$party_data['poa_principal_name']) {
                    return NAME_MESSAGE;
                }
                if (!$party_data['poa_type']) {
                    return ONE_OPTION_MESSAGE;
                }
                if (!$party_data['poa_description']) {
                    return DESCRIPTION_MESSAGE;
                }
                if (!$party_data['poa_principal_pd']) {
                    return PD_PRINCIPAL_MESSAGE;
                }
                if (!$party_data['poa_execution_date']) {
                    return DATE_MESSAGE;
                }
                if (!$party_data['poa_execution_place']) {
                    return PLACE_MESSAGE;
                }
                if (!$party_data['poa_witnesses']) {
                    return WITNESS_NAME_MESSAGE;
                }
                if (!$party_data['poa_notarised_advocate']) {
                    return NOT_ADV_MESSAGE;
                }
            }
        }
        if (!$party_data['party_name']) {
            return PARTY_NAME_MESSAGE;
        }
        if (!$party_data['party_address']) {
            return ADDRESS_MESSAGE;
        }
        if (!$party_data['party_pincode']) {
            return PINCODE_MESSAGE;
        }
        if (!$party_data['party_state']) {
            return SELECT_STATE_MESSAGE;
        }
        if (!$party_data['party_district']) {
            return SELECT_DISTRICT_MESSAGE;
        }
        if (!$party_data['party_birth_type']) {
            return ONE_OPTION_MESSAGE;
        }
        if ($party_data['party_birth_type'] == VALUE_ONE && !$party_data['party_dob']) {
            return DATE_MESSAGE;
        }
        if ($party_data['party_birth_type'] == VALUE_TWO && !$party_data['party_dob_year']) {
            return YEAR_MESSAGE;
        }
        if ($party_data['party_birth_type'] == VALUE_THREE && !$party_data['party_age']) {
            return AGE_MESSAGE;
        }
        if (!$party_data['party_gender'] || !$party_data['party_religion']) {
            return ONE_OPTION_MESSAGE;
        }
        if (!$party_data['party_mobile_number']) {
            return MOBILE_NUMBER_MESSAGE;
        }
        if (!preg_match('/^[0-9]{10}+$/', $party_data['party_mobile_number'])) {
            return INVALID_MOBILE_NUMBER_MESSAGE;
        }
        if ($party_data['party_email_address'] != '') {
            if (!filter_var($party_data['party_email_address'], FILTER_VALIDATE_EMAIL)) {
                return INVALID_EMAIL_MESSAGE;
            }
        }
        if (!$party_data['party_occupation']) {
            return ONE_OPTION_MESSAGE;
        }
        return '';
    }

    function submit_step_two() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $document_registration_id = get_from_post('document_registration_id_for_dr');
            $dr_pd_id = get_from_post('dr_party_details_id_for_drstwo');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $document_registration_id == NULL ||
                    !$document_registration_id || $dr_pd_id == null || !$dr_pd_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $step_two_data = $this->_get_post_data_for_step_two();
            $validation_message = $this->_check_validation_for_pd(VALUE_ONE, $step_two_data);
            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }
            $ex_dr2_data = $this->document_registration_model->get_step_one_dr_pd_details($document_registration_id);
            if (empty($ex_dr2_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_dr2_data['dr_party_details_id'] != $dr_pd_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($step_two_data['is_poa_holder'] == VALUE_ONE) {
                $step_two_data['poa_execution_date'] = convert_to_mysql_date_format($step_two_data['poa_execution_date']);
            }
            if ($step_two_data['party_birth_type'] == VALUE_ONE) {
                $step_two_data['party_dob'] = convert_to_mysql_date_format($step_two_data['party_dob']);
            }
            $this->db->trans_start();
            $step_two_data['updated_by'] = $session_user_id;
            $step_two_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('dr_party_details_id', $dr_pd_id, 'dr_party_details', $step_two_data);

            $dr_data = array();
            $dr_data['new_opd_data'] = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_party_details', 'party_type', VALUE_TWO);
            $dr_data['document_registration_id'] = $document_registration_id;
            $dr_data['temp_application_number'] = $ex_dr2_data['temp_application_number'];
            $dr_data['doc_consideration_amount'] = $ex_dr2_data['doc_consideration_amount'];
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = PPD_SAVED_MESSAGE;
            $success_array['dr_data'] = $dr_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_step_three() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $document_registration_id = get_from_post('document_registration_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $document_registration_id == NULL || !$document_registration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $new_dr_opd_items = $this->input->post('new_dr_opd_items');
            $exi_dr_opd_items = $this->input->post('exi_dr_opd_items');
            if (empty($new_dr_opd_items) && empty($exi_dr_opd_items)) {
                echo json_encode(get_error_array(ONE_OPD_MESSAGE));
                return false;
            }
            $ex_ids = array();
            $is_validate = false;
            if ($exi_dr_opd_items != '') {
                if (!empty($exi_dr_opd_items)) {
                    foreach ($exi_dr_opd_items as &$edroi) {
                        $validation_message = $this->_check_validation_for_pd(VALUE_TWO, $edroi);
                        if ($validation_message != '') {
                            $is_validate = true;
                            echo json_encode(get_error_array($validation_message));
                            break;
                        }
                        if ($edroi['party_birth_type'] == VALUE_ONE) {
                            $edroi['party_dob'] = convert_to_mysql_date_format($edroi['party_dob']);
                        }
                        $edroi['updated_by'] = $session_user_id;
                        $edroi['updated_time'] = date('Y-m-d H:i:s');

                        array_push($ex_ids, $edroi['dr_party_details_id']);
                    }
                    if ($is_validate) {
                        return false;
                    }
                }
            }
            if ($new_dr_opd_items != '') {
                if (!empty($new_dr_opd_items)) {
                    foreach ($new_dr_opd_items as &$ndroi) {
                        $validation_message = $this->_check_validation_for_pd(VALUE_TWO, $ndroi);
                        if ($validation_message != '') {
                            $is_validate = true;
                            echo json_encode(get_error_array($validation_message));
                            break;
                        }
                        if ($ndroi['party_birth_type'] == VALUE_ONE) {
                            $ndroi['party_dob'] = convert_to_mysql_date_format($ndroi['party_dob']);
                        }
                        $ndroi['document_registration_id'] = $document_registration_id;
                        $ndroi['party_type'] = VALUE_TWO;
                        $ndroi['updated_by'] = $session_user_id;
                        $ndroi['updated_time'] = date('Y-m-d H:i:s');
                    }
                    if ($is_validate) {
                        return false;
                    }
                }
            }
            $ex_dr_data = $this->utility_model->get_by_id('document_registration_id', $document_registration_id, 'document_registration');
            if (empty($ex_dr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data = array();
            $update_data['is_delete'] = IS_DELETE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data_not_in('document_registration_id', $document_registration_id, 'dr_party_details_id', $ex_ids, 'dr_party_details', $update_data, 'party_type', VALUE_TWO);

            if (!empty($exi_dr_opd_items)) {
                $this->utility_model->update_data_batch('dr_party_details_id', 'dr_party_details', $exi_dr_opd_items);
            }
            if (!empty($new_dr_opd_items)) {
                $this->utility_model->insert_data_batch('dr_party_details', $new_dr_opd_items);
//            foreach ($new_dr_opd_items as $ndropdi) {
//                $this->utility_model->insert_data('dr_party_details', $ndropdi);
//            }
            }
            $pmv_relation = generate_array_for_id_indisde_id_object($this->utility_model->get_result_data_by_id('district', $ex_dr_data['district'], 'pmv_relation'), 'city', 'pmv_relation_id');

            $temp_pmv_cr = $this->utility_model->get_result_data('pmv_cr');
            $pmv_cr = array();
            foreach ($temp_pmv_cr as $tpmvcr) {
                if (!isset($pmv_cr[$tpmvcr['pmv_type']])) {
                    $pmv_cr[$tpmvcr['pmv_type']] = array();
                }
                if ($tpmvcr['pmv_type'] == VALUE_ONE) {
                    if (!isset($pmv_cr[$tpmvcr['pmv_type']][$tpmvcr['pmv_relation_id']])) {
                        $pmv_cr[$tpmvcr['pmv_type']][$tpmvcr['pmv_relation_id']] = array();
                    }
                    if (!isset($pmv_cr[$tpmvcr['pmv_type']][$tpmvcr['pmv_relation_id']][$tpmvcr['pmv_land_property_type']])) {
                        $pmv_cr[$tpmvcr['pmv_type']][$tpmvcr['pmv_relation_id']][$tpmvcr['pmv_land_property_type']] = $tpmvcr['pmv_rate'];
                    }
                }
                if ($tpmvcr['pmv_type'] == VALUE_TWO) {
                    if (!isset($pmv_cr[$tpmvcr['pmv_type']][$tpmvcr['pmv_land_property_type']])) {
                        $pmv_cr[$tpmvcr['pmv_type']][$tpmvcr['pmv_land_property_type']] = array();
                    }
                    if (!isset($pmv_cr[$tpmvcr['pmv_type']][$tpmvcr['pmv_land_property_type']][$tpmvcr['pmv_category']])) {
                        $pmv_cr[$tpmvcr['pmv_type']][$tpmvcr['pmv_land_property_type']][$tpmvcr['pmv_category']] = $tpmvcr['pmv_rate'];
                    }
                }
            }
            if ($ex_dr_data['property_details_status'] == VALUE_ONE) {
                $pd_data = $this->utility_model->get_result_data_by_id('document_registration_id', $document_registration_id, 'dr_property_details');
                $land_details = $this->_get_basic_land_details_for_lds_one($pd_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $ex_pd_data = array();
            $ex_pd_data['document_registration_id'] = $document_registration_id;
            $ex_pd_data['temp_application_number'] = $ex_dr_data['temp_application_number'];
            $ex_pd_data['doc_type'] = $ex_dr_data['doc_type'];
            $ex_pd_data['property_details_status'] = $ex_dr_data['property_details_status'];
            $ex_pd_data['doc_consideration_amount'] = $ex_dr_data['doc_consideration_amount'];
            $ex_pd_data['district'] = $ex_dr_data['district'];
            $ex_pd_data['ownership_type'] = $ex_dr_data['ownership_type'];
            $ex_pd_data['total_consideration_amount'] = $ex_dr_data['total_consideration_amount'];
            $ex_pd_data['total_stamp_duty'] = $ex_dr_data['total_stamp_duty'];
            $ex_pd_data['total_registration_fee'] = $ex_dr_data['total_registration_fee'];
            $ex_pd_data['total_calculation'] = $ex_dr_data['total_calculation'];

            if ($ex_dr_data['property_details_status'] == VALUE_ONE) {
                $ex_pd_data['new_pd_data'] = $pd_data;
                $ex_pd_data['temp_ld_data'] = $land_details;
            }
            if ($ex_dr_data['doc_type'] == VALUE_TWENTYSEVEN) {
                $ex_pd_data['noy_lease'] = $ex_dr_data['noy_lease'];
                $ex_pd_data['nom_lease'] = $ex_dr_data['nom_lease'];
                $ex_pd_data['deposit'] = $ex_dr_data['deposit'];
                $ex_pd_data['yearly_rent'] = $ex_dr_data['yearly_rent'];
                $ex_pd_data['lease_period'] = $ex_dr_data['lease_period'];
            }
            $success_array = get_success_array();
            $success_array['message'] = OPD_SAVED_MESSAGE;
            $success_array['dr_data'] = $ex_pd_data;
            $success_array['pmv_relation_data'] = $pmv_relation;
            $success_array['pmv_cr'] = $pmv_cr;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_basic_land_details_for_lds_one($pd_data) {
        $land_details = array();
        foreach ($pd_data as $pd) {
            if (!isset($land_details[$pd['ld_type']])) {
                $land_details[$pd['ld_type']] = array();
            }
            if ($pd['ld_type'] == VALUE_ONE) {
                if (!isset($land_details[$pd['ld_type']][$pd['ld_village_sc']])) {
                    $land_details[$pd['ld_type']][$pd['ld_village_sc']] = array();
                    $land_details[$pd['ld_type']][$pd['ld_village_sc']]['ld_srv_pts_gtw_data'] = $this->utility_model->get_survey_list('rural_land_parcels', $pd['ld_village_sc']);
                }
                if (!isset($land_details[$pd['ld_type']][$pd['ld_village_sc']][$pd['ld_srv_pts_gtw']])) {
                    $land_details[$pd['ld_type']][$pd['ld_village_sc']][$pd['ld_srv_pts_gtw']] = $this->utility_model->get_subdiv_list('rural_land_parcels', $pd['ld_village_sc'], $pd['ld_srv_pts_gtw']);
                }
            }
            if ($pd['ld_type'] == VALUE_TWO) {
                if (!isset($land_details[$pd['ld_type']][$pd['ld_area_type']])) {
                    $land_details[$pd['ld_type']][$pd['ld_area_type']] = array();
                }
                if (!isset($land_details[$pd['ld_type']][$pd['ld_area_type']][$pd['ld_village_sc']])) {
                    if ($pd['ld_area_type'] == VALUE_ONE) {
                        $land_details[$pd['ld_type']][$pd['ld_area_type']][$pd['ld_village_sc']]['ld_srv_pts_gtw_data'] = generate_pt_sheet_number_array($this->utility_model->get_ptg_list($pd['ld_area_type']), $pd['ld_village_sc']);
                    } else if ($pd['ld_area_type'] == VALUE_TWO) {
                        $land_details[$pd['ld_type']][$pd['ld_area_type']][$pd['ld_village_sc']]['ld_srv_pts_gtw_data'] = $this->utility_model->get_ptg_list($pd['ld_area_type'], $pd['ld_village_sc']);
                    }
                }
                if (!isset($land_details[$pd['ld_type']][$pd['ld_area_type']][$pd['ld_village_sc']][$pd['ld_srv_pts_gtw']])) {
                    if ($pd['ld_area_type'] == VALUE_ONE) {
                        $land_details[$pd['ld_type']][$pd['ld_area_type']][$pd['ld_village_sc']][$pd['ld_srv_pts_gtw']] = $this->utility_model->get_clp_list($pd['ld_area_type'], $pd['ld_srv_pts_gtw']);
                    } else if ($pd['ld_area_type'] == VALUE_TWO) {
                        $land_details[$pd['ld_type']][$pd['ld_area_type']][$pd['ld_village_sc']][$pd['ld_srv_pts_gtw']] = $this->utility_model->get_clp_list($pd['ld_area_type'], $pd['ld_srv_pts_gtw'], $pd['ld_village_sc']);
                    }
                }
            }
        }
        return $land_details;
    }

    function _get_post_data_for_step_four($property_details_status, &$dr_data) {
        $dr_data['ownership_type'] = get_from_post('ownership_type');
        $dr_data['total_consideration_amount'] = $property_details_status == VALUE_ONE ? get_from_post('total_consideration_amount') : VALUE_ZERO;
        $dr_data['total_stamp_duty'] = get_from_post('total_stamp_duty');
        $dr_data['total_registration_fee'] = get_from_post('total_registration_fee');
        $dr_data['total_calculation'] = $this->input->post('total_calculation');
    }

    function _check_validation_for_step_four($dr_data) {
        if (!$dr_data['ownership_type']) {
            return ONE_OPTION_MESSAGE;
        }
        return '';
    }

    function _check_validation_for_step_four_lds_one($dr_data) {
        if (!$dr_data['pd_type']) {
            return ONE_OPTION_MESSAGE;
        }
        if ($dr_data['pd_type'] == VALUE_ONE && (!$dr_data['ol_main_area'] || !$dr_data['ol_sub_area'] || !$dr_data['ol_purpose'])) {
            return ONE_OPTION_MESSAGE;
        }
        if ($dr_data['pd_type'] == VALUE_ONE && (!$dr_data['ol_land_area'])) {
            return LAND_AREA_MESSAGE;
        }
        if ($dr_data['pd_type'] == VALUE_TWO && (!$dr_data['cp_property_type'] || !$dr_data['cp_cc'] || !$dr_data['cp_age_cd'])) {
            return ONE_OPTION_MESSAGE;
        }
        if ($dr_data['pd_type'] == VALUE_TWO && (!$dr_data['cp_constructed_area'])) {
            return LAND_AREA_MESSAGE;
        }
        if (!$dr_data['ld_type']) {
            return ONE_OPTION_MESSAGE;
        }
        if ($dr_data['ld_type'] == VALUE_TWO && !$dr_data['ld_area_type']) {
            return ONE_OPTION_MESSAGE;
        }
        if (!$dr_data['ld_village_sc'] || $dr_data['ld_srv_pts_gtw'] == '' || !$dr_data['ld_sd_cl_pt']) {
            return ONE_OPTION_MESSAGE;
        }
        return '';
    }

    function submit_step_four() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $document_registration_id = get_from_post('document_registration_id');
            $module_type = get_from_post('module_type');
            $property_details_status = get_from_post('property_details_status');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $document_registration_id == NULL ||
                    !$document_registration_id || ($module_type != VALUE_TWO) ||
                    ($property_details_status != VALUE_ONE && $property_details_status != VALUE_TWO)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_dr_data = $this->utility_model->get_by_id('document_registration_id', $document_registration_id, 'document_registration');
            if (empty($ex_dr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_dr_data['status'] == VALUE_FIVE || $ex_dr_data['status'] == VALUE_SIX) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $dr_data = array();
            $dr_data['property_details_status'] = $property_details_status;
            $this->_get_post_data_for_step_four($property_details_status, $dr_data);
            $vm_pds_one = $this->_check_validation_for_step_four($dr_data);
            if ($vm_pds_one != '') {
                echo json_encode(get_error_array($vm_pds_one));
                return false;
            }
            if (is_array($dr_data['total_calculation'])) {
                $dr_data['total_calculation'] = json_encode($dr_data['total_calculation']);
            }
            if ($ex_dr_data['ownership_type'] != VALUE_ZERO && $ex_dr_data['ownership_type'] == $dr_data['ownership_type']) {
                if ($ex_dr_data['doc_type'] != VALUE_TWENTYSEVEN) {
                    unset($dr_data['total_calculation']);
                }
            }
            if ($property_details_status == VALUE_ONE) {
                $new_dr_pd_items = $this->input->post('new_dr_pd_items');
                $exi_dr_pd_items = $this->input->post('exi_dr_pd_items');
                if (empty($new_dr_pd_items) && empty($exi_dr_pd_items)) {
                    echo json_encode(get_error_array(ONE_PD_MESSAGE));
                    return false;
                }
                $ex_ids = array();
                $is_validate = false;
                if ($exi_dr_pd_items != '') {
                    if (!empty($exi_dr_pd_items)) {
                        foreach ($exi_dr_pd_items as &$edrpdi) {
                            $validation_message = $this->_check_validation_for_step_four_lds_one($edrpdi);
                            if ($validation_message != '') {
                                $is_validate = true;
                                echo json_encode(get_error_array($validation_message));
                                break;
                            }
                            $edrpdi['updated_by'] = $session_user_id;
                            $edrpdi['updated_time'] = date('Y-m-d H:i:s');
                            array_push($ex_ids, $edrpdi['dr_property_details_id']);
                        }
                        if ($is_validate) {
                            return false;
                        }
                    }
                }
                if ($new_dr_pd_items != '') {
                    if (!empty($new_dr_pd_items)) {
                        foreach ($new_dr_pd_items as &$ndrpdi) {
                            $validation_message = $this->_check_validation_for_step_four_lds_one($ndrpdi);
                            if ($validation_message != '') {
                                $is_validate = true;
                                echo json_encode(get_error_array($validation_message));
                                break;
                            }
                            $ndrpdi['document_registration_id'] = $document_registration_id;
                            $ndrpdi['created_by'] = $session_user_id;
                            $ndrpdi['created_time'] = date('Y-m-d H:i:s');
                        }
                        if ($is_validate) {
                            return false;
                        }
                    }
                }
            }
            $this->db->trans_start();
            $this->utility_model->update_data('document_registration_id', $document_registration_id, 'document_registration', $dr_data);
            $update_data = array();
            $update_data['is_delete'] = IS_DELETE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            if ($property_details_status == VALUE_TWO) {
                $this->utility_model->update_data('document_registration_id', $document_registration_id, 'dr_property_details', $update_data);
            }
            if ($property_details_status == VALUE_ONE) {
                $this->utility_model->update_data_not_in('document_registration_id', $document_registration_id, 'dr_property_details_id', $ex_ids, 'dr_property_details', $update_data);

                if (!empty($exi_dr_pd_items)) {
                    $this->utility_model->update_data_batch('dr_property_details_id', 'dr_property_details', $exi_dr_pd_items);
                }
                if (!empty($new_dr_pd_items)) {
                    $this->utility_model->insert_data_batch('dr_property_details', $new_dr_pd_items);
//                foreach ($new_dr_pd_items as $ndrpdi) {
//                    $this->utility_model->insert_data('dr_property_details', $ndrpdi);
//                }
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = DR_DETAILS_UPDATED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_party_photo() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $dr_party_details_id = get_from_post('dr_party_details_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $dr_party_details_id == NULL || !$dr_party_details_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_dr_data = $this->utility_model->get_by_id('dr_party_details_id', $dr_party_details_id, 'dr_party_details');
            if (empty($ex_dr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $party_photo = $this->input->post('party_photo');
            if (!$party_photo) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $image_parts = explode(";base64,", $party_photo);
            if (!isset($image_parts[0]) || !isset($image_parts[1])) {
                echo json_encode(get_error_array(INVALID_PHOTO_MESSAGE));
                return false;
            }
            $image_type_aux = explode("image/", $image_parts[0]);
            if (!isset($image_type_aux[1])) {
                echo json_encode(get_error_array(INVALID_PHOTO_MESSAGE));
                return false;
            }
            $path = 'documents';
            if (!is_dir($path)) {
                mkdir($path);
                chmod("$path", 0755);
            }
            $main_path = $path . DIRECTORY_SEPARATOR . 'document_registration';
            if (!is_dir($main_path)) {
                mkdir($main_path);
                chmod("$main_path", 0755);
            }
            $photo_filename = 'dr_photo_' . (rand(100000, 999999)) . time() . '.' . $image_type_aux[1];
            $filepath = $main_path . DIRECTORY_SEPARATOR . $photo_filename;

            $image_base64 = base64_decode($image_parts[1]);
            file_put_contents($filepath, $image_base64);

            if ($ex_dr_data['party_photo'] != '') {
                if (file_exists($main_path . DIRECTORY_SEPARATOR . $ex_dr_data['party_photo'])) {
                    unlink($main_path . DIRECTORY_SEPARATOR . $ex_dr_data['party_photo']);
                }
            }

            $this->db->trans_start();
            $dr_data = array();
            $dr_data['party_photo'] = $photo_filename;
            $dr_data['party_photo_datetime'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('dr_party_details_id', $dr_party_details_id, 'dr_party_details', $dr_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['photo_file_path'] = $filepath;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_fees_details() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $dr_id = get_from_post('dr_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $dr_id == NULL || !$dr_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $dr_data = $this->utility_model->get_by_id('document_registration_id', $dr_id, 'document_registration');
            if (empty($dr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $fees_details = $this->utility_model->get_result_data_by_id('module_type', VALUE_ELEVEN, 'fees_bifurcation', 'module_id', $dr_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['dr_data'] = $dr_data;
            $success_array['fees_details'] = $fees_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_fees_details() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $dr_id = get_from_post('dr_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $dr_id == NULL || !$dr_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_dr_data = $this->utility_model->get_by_id('document_registration_id', $dr_id, 'document_registration');
            if (empty($ex_dr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $new_fd_details = $this->input->post('new_fd_items');
            $ex_fd_details = $this->input->post('exi_fd_items');
            $total_fees = get_from_post('total_fees');
            $sd_details = $this->input->post('sd_details');
            $sd_amount = get_from_post('sd_amount');
            if (empty($new_fd_details) && empty($ex_fd_details)) {
                echo json_encode(get_error_array(ONE_FEE_MESSAGE));
                return false;
            }
            $module_type = VALUE_ELEVEN;
            $new_total_fee = VALUE_ZERO;
            if (!empty($new_fd_details)) {
                foreach ($new_fd_details as &$nfb) {
                    $nfb['module_type'] = $module_type;
                    $nfb['module_id'] = $dr_id;
                    $nfb['created_by'] = $session_user_id;
                    $nfb['created_time'] = date('Y-m-d H:i:s');
                    $new_total_fee += intval($nfb['fee']) ? intval($nfb['fee']) : VALUE_ZERO;
                }
            }
            $ex_fbids = array();
            if (!empty($ex_fd_details)) {
                foreach ($ex_fd_details as &$efb) {
                    $nfb['module_type'] = $module_type;
                    $nfb['module_id'] = $dr_id;
                    $nfb['updated_by'] = $session_user_id;
                    $efb['updated_time'] = date('Y-m-d H:i:s');
                    $new_total_fee += intval($efb['fee']) ? intval($efb['fee']) : VALUE_ZERO;
                    array_push($ex_fbids, $efb['fees_bifurcation_id']);
                }
            }
            if ($new_total_fee != $total_fees) {
                echo json_encode(get_error_array(ONE_FEE_MESSAGE));
                return false;
            }
            $module_data = array();
            $module_data['total_fees'] = $new_total_fee;
            $module_data['sd_details'] = json_encode($sd_details);
            $module_data['sd_amount'] = $sd_amount;
            $module_data['updated_by'] = $session_user_id;
            $module_data['updated_time'] = date('Y-m-d H:i:s');
            if ($ex_dr_data['fee_receipt_number'] == VALUE_ZERO) {
                $module_data['fee_receipt_number'] = $this->_generate_new_no($ex_dr_data, 'fee_receipt_number', 'application_year');
                $module_data['fee_receipt_datetime'] = date('Y-m-d H:i:s');
            }
            $this->db->trans_start();
            $update_data = $this->utility_lib->get_basic_delete_array($session_user_id);
            $this->utility_model->update_data_not_in('module_type', $module_type, 'fees_bifurcation_id', $ex_fbids, 'fees_bifurcation', $update_data, 'module_id', $dr_id);
            if (!empty($new_fd_details)) {
                $this->utility_model->insert_data_batch('fees_bifurcation', $new_fd_details);
            }
            if (!empty($ex_fd_details)) {
                $this->utility_model->update_data_batch('fees_bifurcation_id', 'fees_bifurcation', $ex_fd_details);
            }
            $this->utility_model->update_data('document_registration_id', $dr_id, 'document_registration', $module_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = FEES_UPDATED_MESSAGE;
            $success_array['total_fees'] = $module_data['total_fees'];
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _generate_new_no($ex_dr_data, $field_id, $year_id) {
        $temp_an = VALUE_ONE;
        $ex_app_num_data = $this->utility_model->get_by_id($year_id, $ex_dr_data[$year_id], 'document_registration', '', '', $field_id, 'DESC');
        if (!empty($ex_app_num_data)) {
            $temp_an = $ex_app_num_data[$field_id] + 1;
        }
        return $temp_an;
    }

    function generate_fee_receipt() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $dr_id = get_from_post('dr_id_for_dr_list_gfr');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $dr_id == NULL || !$dr_id) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_dr_data = $this->document_registration_model->get_dr_details_for_fee_receipt($dr_id);
            if (empty($ex_dr_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_dr_data['fee_receipt_number'] == VALUE_ZERO) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $fees_details = $this->utility_model->get_result_data_by_id('module_type', VALUE_ELEVEN, 'fees_bifurcation', 'module_id', $dr_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            error_reporting(E_ERROR);
            $data = array('dr_data' => $ex_dr_data, 'fees_details' => $fees_details);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->showWatermarkImage = true;
            $mpdf->WriteHTML($this->load->view('document_registration/fd_pdf', $data, TRUE));
            $mpdf->Output('dr_fee_receipt_' . rand(100000, 999999) . '_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            $this->load->view('error', array('error_message' => $e->getMessage()));
            return;
        }
    }

    function generate_endorsement() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $dr_id = get_from_post('dr_id_for_dr_list_gend');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $dr_id == NULL || !$dr_id) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_dr_data = $this->document_registration_model->get_dr_details_for_endorsement($dr_id);
            if (empty($ex_dr_data)) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_dr_data['fee_receipt_number'] == VALUE_ZERO) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($ex_dr_data['status'] != VALUE_FIVE) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $fees_details = $this->utility_model->get_result_data_by_id('module_type', VALUE_ELEVEN, 'fees_bifurcation', 'module_id', $dr_id);
            $party_details = $this->document_registration_model->get_dr_party_details_for_endorsement($dr_id, $ex_dr_data['is_changed_po']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            error_reporting(E_ERROR);
            $data = array('dr_data' => $ex_dr_data, 'fees_details' => $fees_details, 'party_details' => $party_details, 'page_size' => 'Legal');
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
            $mpdf->WriteHTML($this->load->view('document_registration/endorsement_pdf', $data, TRUE));
            $mpdf->Output('dr_endorsement_' . rand(100000, 999999) . '_' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            $this->load->view('error', array('error_message' => $e->getMessage()));
            return;
        }
    }

    function update_status_for_dr() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $document_registration_id = get_from_post('dr_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $document_registration_id == NULL || !$document_registration_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE && $module_type != VALUE_FOUR) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $remarks = get_from_post('remarks');
            if (!$remarks) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $ex_dr_data = $this->utility_model->get_by_id('document_registration_id', $document_registration_id, 'document_registration');
            if (empty($ex_dr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $dr_data = array();
            $success_mesage = '';
            if ($module_type == VALUE_ONE) {
                if ($ex_dr_data['status'] != VALUE_TWO) {
                    echo json_encode(get_error_array(DR_AL_VERIFIED_MESSAGE));
                    return false;
                }
                $dr_data['status'] = VALUE_EIGHT;
                $dr_data['is_verified_doc'] = VALUE_ONE;
                $dr_data['verified_remarks'] = $remarks;
                $dr_data['verified_by'] = $session_user_id;
                $dr_data['verified_name'] = get_from_session('name');
                $dr_data['verified_datetime'] = date('Y-m-d H:i:s');
                $success_mesage = DR_APP_VERIFIED_TO_AASUBR_MESSAGE;
            }
            if ($module_type == VALUE_TWO) {
                if ($ex_dr_data['is_verified_app'] == VALUE_ONE) {
                    echo json_encode(get_error_array(DR_AL_FORWARDED_MESSAGE));
                    return false;
                }
                $dr_data['status'] = VALUE_THREE;
                $dr_data['is_verified_app'] = VALUE_ONE;
                $dr_data['verified_app_remarks'] = $remarks;
                $dr_data['verified_app_by'] = $session_user_id;
                $dr_data['verified_app_name'] = get_from_session('name');
                $dr_data['verified_app_datetime'] = date('Y-m-d H:i:s');
                $success_mesage = DR_APP_VERIFIED_TO_USER_MESSAGE;
                $this->load->model('user_model');
                $ex_u_data = $this->user_model->get_basic_user_data($ex_dr_data['user_id']);
            }
            if ($module_type == VALUE_THREE) {
                $dr_data['temp_ay'] = date('Y');
                $ex_dr_data['temp_ay'] = $dr_data['temp_ay'];
                $dr_data['temp_an'] = $this->_generate_new_no($ex_dr_data, 'temp_an', 'temp_ay');
                $dr_data['application_number'] = $dr_data['temp_ay'] . '/' . get_five_digit_application_number($dr_data['temp_an']);
                $dr_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_ELEVEN, $ex_dr_data['submitted_datetime']);
                $dr_data['status'] = VALUE_FIVE;
                $dr_data['remarks'] = $remarks;
                $dr_data['status_datetime'] = date('Y-m-d H:i:s');
                $success_mesage = DR_APP_LOCKED_MESSAGE;
            }
            if ($module_type == VALUE_FOUR) {
                $dr_data['temp_ay'] = date('Y');
                $dr_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_ELEVEN, $ex_dr_data['submitted_datetime']);
                $dr_data['status'] = VALUE_SIX;
                $dr_data['remarks'] = $remarks;
                $dr_data['status_datetime'] = date('Y-m-d H:i:s');
                $success_mesage = DR_APP_REJECTED_MESSAGE;
            }
            $this->db->trans_start();
            $this->utility_model->update_data('document_registration_id', $document_registration_id, 'document_registration', $dr_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if ($module_type == VALUE_TWO) {
                if (!empty($ex_u_data)) {
                    $registration_message = '<b>Application Number : <b>' . $ex_dr_data['temp_application_number'] . '<br>'
                            . '<b>Remarks :</b> Your Document Has Been Verified. Please Take the Appointment.<br>'
                            . '<b style="color: red;">Attention : Applicant is required to be present 15 Minutes before the Scheduled Time.</b>';
                    $this->load->library('email_lib');
                    $this->email_lib->send_email($ex_u_data, '<b>' . $ex_dr_data["temp_application_number"] . '</b> : Document Verified & Take Appointment', $registration_message, VALUE_ELEVEN);
                }
            }
            $success_array = get_success_array();
            $success_array['message'] = $success_mesage;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_scanned_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $dr_id = get_from_post('document_registration_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $dr_id == NULL || !$dr_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('document_registration_id', $dr_id, 'document_registration');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['status'] != VALUE_FIVE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['doc_upload_status'] == VALUE_TWO) {
                echo json_encode(get_error_array(DOCUMENT_LOCKED_MESSAGE));
                return;
            }
            $document_data = array();
            if ($_FILES['document_file']['name'] != '') {
                $documents_path = 'documents';
                if (!is_dir($documents_path)) {
                    mkdir($documents_path);
                    chmod($documents_path, 0777);
                }
                $module_path = $documents_path . DIRECTORY_SEPARATOR . 'dr_scanned_document';
                if (!is_dir($module_path)) {
                    mkdir($module_path);
                    chmod($module_path, 0777);
                }
                $this->load->library('upload');
                $temp_filename = str_replace('_', '', $_FILES['document_file']['name']);
                $filename = 'dr_' . $dr_id . '_' . (rand(100000000, 999999999)) . time() . '.' . pathinfo($temp_filename, PATHINFO_EXTENSION);
                //Change file name
                $final_path = $module_path . DIRECTORY_SEPARATOR . $filename;
                if (!move_uploaded_file($_FILES['document_file']['tmp_name'], $final_path)) {
                    echo json_encode(array('success' => FALSE, 'message' => DOCUMENT_NOT_UPLOAD_MESSAGE));
                    return;
                }
                $document_data['final_document'] = $filename;
                $document_data['doc_upload_status'] = VALUE_ONE;
            }
            $this->db->trans_start();
            $document_data['updated_by'] = $session_user_id;
            $document_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('document_registration_id', $dr_id, 'document_registration', $document_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $document_data['document_registration_id'] = $dr_id;
            $success_array = array();
            $success_array['success'] = TRUE;
            $success_array['document_data'] = $document_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return false;
        }
    }

    function remove_scanned_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $dr_id = get_from_post('document_registration_id');
            if ($session_user_id == NULL || !$session_user_id || !$dr_id || $dr_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('document_registration_id', $dr_id, 'document_registration');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['status'] != VALUE_FIVE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['doc_upload_status'] == VALUE_TWO) {
                echo json_encode(get_error_array(DOCUMENT_LOCKED_MESSAGE));
                return;
            }
            if ($ex_data['final_document'] != '') {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'dr_scanned_document' . DIRECTORY_SEPARATOR . $ex_data['final_document'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $update_data = array();
            $update_data['doc_upload_status'] = VALUE_ZERO;
            $update_data['final_document'] = '';
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('document_registration_id', $dr_id, 'document_registration', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['doc_upload_status'] = $update_data['doc_upload_status'];
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_scanned_document_status() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $dr_id = get_from_post('document_registration_id');
            if ($session_user_id == NULL || !$session_user_id || !$dr_id || $dr_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('document_registration_id', $dr_id, 'document_registration');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['status'] != VALUE_FIVE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['doc_upload_status'] == VALUE_TWO) {
                echo json_encode(get_error_array(DOCUMENT_LOCKED_MESSAGE));
                return;
            }
            if ($ex_data['final_document'] == '') {
                echo json_encode(get_error_array(DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $update_data = array();
            $update_data['doc_upload_status'] = $module_type;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('document_registration_id', $dr_id, 'document_registration', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = $module_type == VALUE_ONE ? DOCUMENT_UPLOAD_MESSAGE : DOCUMENT_UPLOAD_LOCKED_MESSAGE;
            $success_array['doc_upload_status'] = $update_data['doc_upload_status'];
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function change_party_order() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $dr_id = get_from_post('document_registration_id');
            if ($session_user_id == NULL || !$session_user_id || !$dr_id || $dr_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('document_registration_id', $dr_id, 'document_registration');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['status'] == VALUE_FIVE || $ex_data['status'] == VALUE_SIX) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $pd_details = $this->input->post('pd_items');
            if (empty($pd_details) || !$pd_details) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            $this->db->trans_start();
            if ($ex_data['is_changed_po'] == VALUE_ZERO) {
                $update_data = array();
                $update_data['is_changed_po'] = VALUE_ONE;
                $this->utility_model->update_data('document_registration_id', $dr_id, 'document_registration', $update_data);
            }
            $this->utility_model->update_data_batch('dr_party_details_id', 'dr_party_details', $pd_details);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = PO_CHANGED_MESSAGE;
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
            $search_district = VALUE_ONE;
            $search_appd = get_from_post('appointment_status_for_document_registration_excel');
            $search_docno = get_from_post('doc_number_for_document_registration_excel');
            $search_tappno = get_from_post('temp_application_number_for_document_registration_excel');
            $search_ppdetails = get_from_post('party_details_for_document_registration_excel');
            $search_doctype = get_from_post('doc_type_for_document_registration_excel');
            $search_qstatus = get_from_post('query_status_for_document_registration_excel');
            $search_status = get_from_post('status_for_document_registration_excel');
            $this->db->trans_start();
            $excel_data = $this->document_registration_model->get_records_for_excel($search_district, $search_docno, $search_tappno, $search_ppdetails, $search_doctype, $search_appd, $search_qstatus, $search_status);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            $elist = array();
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=document_registration_' . date('Y-m-d H:i:s') . '.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('District', 'Doc. Number', 'Temp Application Number', 'App. Date & Time', 'Submitted Date & Time', 'Party Name', 'Party Address', 'Party Mobile Number', 'Document Type (Article)', 'Consideration Amount', 'Appointment Date & Time', 'Query Status', 'Status', 'Fees Details', 'Doc. Upload Status'));
            if (!empty($excel_data)) {
                $taluka_array = $this->config->item('taluka_array');
                $doc_type_array = $this->config->item('doc_type_array');
                $query_status_text_array = $this->config->item('query_status_text_array');
                $dr_app_status_text_array = $this->config->item('dr_app_status_text_array');
                $dr_upload_doc_status_text_array = $this->config->item('dr_upload_doc_status_text_array');
                foreach ($excel_data as $list) {
                    $elist['district'] = isset($taluka_array[$list['district']]) ? $taluka_array[$list['district']] : '-';
                    $elist['application_number'] = $list['application_number'];
                    $elist['temp_application_number'] = $list['temp_application_number'];
                    $elist['app_submitted_datetime'] = $list['submitted_datetime'];
                    $elist['submitted_datetime'] = $list['submitted_datetime'];
                    $elist['party_name'] = $list['party_name'];
                    $elist['party_address'] = $list['party_address'];
                    $elist['party_mobile_number'] = $list['party_mobile_number'];
                    $elist['doc_type'] = isset($doc_type_array[$list['doc_type']]) ? $doc_type_array[$list['doc_type']] : '';
                    $elist['doc_consideration_amount'] = $list['doc_consideration_amount'];
                    $elist['appointment_date'] = $list['appointment_date'] . ' ' . $list['appointment_time'];
                    $elist['query_status'] = isset($query_status_text_array[$list['query_status']]) ? $query_status_text_array[$list['query_status']] : '-';
                    $elist['status'] = isset($dr_app_status_text_array[$list['status']]) ? $dr_app_status_text_array[$list['status']] : '';
                    $elist['fees'] = $list['fee_receipt_number'] != VALUE_ZERO ? $list['total_fees'] . '/-' : '';
                    $elist['doc_upload_status'] = isset($dr_upload_doc_status_text_array[$list['doc_upload_status']]) ? $dr_upload_doc_status_text_array[$list['doc_upload_status']] : '';
                    fputcsv($output, $elist);
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
 * EOF: ./application/controller/Document_registration.php
 */