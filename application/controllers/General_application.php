<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General_application extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('general_application_model');
        $this->load->model('utility_model');
    }

    function get_general_application_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['general_application_data'] = array();
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

            $search_appno = get_from_post('app_no_for_general_application_list');
            $search_appd = get_from_post('application_date_for_general_application_list');
            $search_appdet = filter_var(get_from_post('app_details_for_general_application_list'), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_new_district = get_from_post('district_for_general_application_list');
            $search_district = $search_new_district != '' ? $search_new_district : $search_district;
            $search_vdw = get_from_post('vdw_for_general_application_list');
            $search_cohand = get_from_post('currently_on_for_general_application_list');
            $search_qstatus = get_from_post('query_status_for_general_application_list');
            $search_status = get_from_post('status_for_general_application_list');
            $new_s_app_status = get_from_post('s_app_status');
            $new_search_appd = get_from_post('s_appd');
            $search_appd = $new_search_appd != '' ? $new_search_appd : $search_appd;

            $new_qstatus = get_from_post('s_qstatus');
            $search_qstatus = $new_qstatus != '' ? $new_qstatus : $search_qstatus;
            $new_status = get_from_post('s_status');
            $search_status = $new_status != '' ? $new_status : $search_status;
            $new_s_co_hand = get_from_post('s_co_hand');
            $search_cohand = $new_s_co_hand != '' ? $new_s_co_hand : $search_cohand;

            $start = get_from_post('start');
            $length = get_from_post('length');

            $this->db->trans_start();
            $general_application_data = $this->general_application_model->get_all_general_application_list($start, $length, $search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_cohand, $search_qstatus, $search_status);
            $success_array['recordsTotal'] = $this->general_application_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_appno != '' || $search_appd != '' || $search_appdet != '' || $search_vdw != '' || $search_cohand != '' || $search_qstatus != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->general_application_model->get_filter_count_of_records($search_district, $search_appno, $search_appd, $search_appdet, $search_vdw, $search_cohand, $search_qstatus, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['general_application_data'] = array();
                echo json_encode($success_array);
                return;
            }
            $success_array['general_application_data'] = $general_application_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['general_application_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_general_application_data_by_id() {
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
            $general_application_id = get_from_post('general_application_id');
            if (!$general_application_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $general_application_data = $this->utility_model->get_by_id('general_application_id', $general_application_id, 'general_application');
            if (empty($general_application_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['general_application_data'] = $general_application_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_data_by_general_application_id() {
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
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $general_application_id = get_from_post('general_application_id');
            if (!$general_application_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $general_application_data = $this->utility_model->get_by_id('general_application_id', $general_application_id, 'general_application');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($general_application_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($module_type == VALUE_ONE) {
                $gah_data = $this->general_application_model->get_certificate_data($general_application_id);
                //$field_documents = $this->general_application_model->get_ldc_report_doc_ids_with_documents($general_application_id);
                $field_documents = $this->utility_model->get_result_by_id('module_id', $general_application_id, 'field_verification_document', 'module_type', VALUE_THIRTY, 'sub_module_id', $gah_data['general_application_history_id']);

                $ldc_field_documents = $this->general_application_model->get_ldc_report_doc_by_id($gah_data['ldc_report_doc_ids']);
                $general_application_data['all_field_documents'] = array_merge($field_documents, $ldc_field_documents);
            }

            $success_array = get_success_array();
            $success_array['general_application_data'] = $general_application_data;
            if ($module_type == VALUE_ONE) {
                $success_array['gah_data'] = $gah_data;
            }
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
            $general_application_id = get_from_post('general_application_id_for_general_application_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$general_application_id || $general_application_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $general_application_history_id = get_from_post('general_application_history_id_for_general_application_approve');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$general_application_history_id || $general_application_history_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_history_data = array();

            $ldc_subject = get_from_post('ldc_subject_for_general_application_approve');
            if (!$ldc_subject) {
                echo json_encode(get_error_array(SUBJECT_MESSAGE));
                return false;
            }

            $report_doc = $this->input->post('report_doc_item');
            $report_doc_ids = '';
//                if (!$report_doc) {
//                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
//                    return false;
//                } else {
            if (!empty($report_doc)) {
                foreach ($report_doc as $rd) {
                    $report_doc_ids .= $rd['report_doc'] . ',';
                }
                $report_doc_ids = rtrim($report_doc_ids, ',');
            }

            $authority = get_from_post('authority_for_general_application_approve');
            if (!$authority) {
                echo json_encode(get_error_array(AUTHORITY_MESSAGE));
                return false;
            }
            $reference = get_from_post('reference_for_general_application_approve');
            if (!$reference) {
                echo json_encode(get_error_array(REFERENCE_MESSAGE));
                return false;
            }
            $copy_to = get_from_post('copy_to_for_general_application_approve');
            if (!$copy_to) {
                echo json_encode(get_error_array(COPYTO_MESSAGE));
                return false;
            }

            $report = get_from_post('report_for_general_application_approve');
            if (!$report) {
                echo json_encode(get_error_array(REPORT_MESSAGE));
                return false;
            }

            $update_history_data['authority'] = $authority;
            $update_history_data['reference'] = $reference;
            $update_history_data['copy_to'] = $copy_to;
            $update_history_data['report'] = $report;
            $this->utility_model->update_data('general_application_history_id', $general_application_history_id, 'general_application_history', $update_history_data);

            $update_data['remarks'] = get_from_post('remarks_for_general_application_approve');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $ex_data = $this->utility_model->get_by_id('general_application_id', $general_application_id, 'general_application');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data['ldc_subject'] = $ldc_subject;
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_THIRTY, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_FIVE;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('general_application_id', $general_application_id, 'general_application', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_THIRTY, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_approve($ex_user_data, VALUE_SEVEN, VALUE_THIRTY, $ex_data);
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
            $general_application_id = get_from_post('general_application_id_for_general_application_reject');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$general_application_id || $general_application_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data = array();
            $update_data['remarks'] = get_from_post('remarks_for_general_application_reject');
            if (!$update_data['remarks']) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('general_application_id', $general_application_id, 'general_application');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $update_data['processing_days'] = $this->utility_lib->calculate_processing_days(VALUE_THIRTY, $ex_data['submitted_datetime']);
            $update_data['status'] = VALUE_SIX;
            $update_data['status_datetime'] = date('Y-m-d H:i:s');
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('general_application_id', $general_application_id, 'general_application', $update_data);

            $user_data = $this->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $ex_user_data = array('email' => $ex_data["email"], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_THIRTY, $ex_data);
            if ($ex_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data["email"], 'user_id' => $session_user_id);
                $this->utility_lib->send_sms_and_email_for_app_reject($ex_user_data, VALUE_EIGHT, VALUE_THIRTY, $ex_data);
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

    function get_general_application_details_by_general_application_id() {
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
            $general_application_id = get_from_post('general_application_id');
            if (!$general_application_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ldc_report_data = array();
            $general_application_data = $this->utility_model->get_by_id('general_application_id', $general_application_id, 'general_application');
            if (empty($general_application_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $general_application_history_data = $this->general_application_model->get_history_data_for_ga($general_application_id);

            $current_general_application_data = $this->general_application_model->get_current_forward_app_data_for_ga($general_application_id);

            if ($general_application_data['query_status'] == VALUE_ONE || $general_application_data['query_status'] == VALUE_TWO) {
                echo json_encode(get_error_array(APPLICATION_IN_QUERY_MESSAGE));
                return false;
            }

            if (!empty($current_general_application_data) && $current_general_application_data['is_forwarded'] == VALUE_ONE) {
                $general_application_data['new_field_documents'] = $this->utility_model->get_result_by_id('module_id', $general_application_id, 'field_verification_document', 'module_type', VALUE_THIRTY, 'sub_module_id', $current_general_application_data['general_application_history_id']);
                if (empty($general_application_data['new_field_documents'])) {
                    $general_application_data['new_field_documents'] = $this->utility_model->get_result_by_id('module_id', $general_application_id, 'field_verification_document', 'module_type', VALUE_THIRTY, 'sub_module_id', VALUE_ZERO);
                }
            } else {
                $general_application_data['new_field_documents'] = $this->utility_model->get_result_by_id('module_id', $general_application_id, 'field_verification_document', 'module_type', VALUE_THIRTY, 'sub_module_id', VALUE_ZERO);
            }

            if (is_ldc_user()) {
                $check_is_aci_forward_to = $this->general_application_model->get_is_forward_to_data($general_application_id, VALUE_TWO);
            } else if (is_aci_user()) {
                $check_is_ldc_forward_to = $this->general_application_model->get_is_forward_to_data($general_application_id, VALUE_THREE);
                if ($general_application_data['is_report_generated'] == VALUE_ONE && empty($current_general_application_data)) {
//                get ldc data for ci if ldc generate report 
                    $ldc_report_data = $this->general_application_model->get_ldc_report_data_for_ci($general_application_id);
                }
            }
            $check_is_talathi_forward_to = $this->general_application_model->get_is_forward_to_data($general_application_id, VALUE_ONE);

            $all_field_documents = $this->utility_model->get_result_by_id('module_id', $general_application_id, 'field_verification_document', 'module_type', VALUE_THIRTY);
            $ldc_field_documents = $this->general_application_model->get_ldc_report_doc_ids_with_documents($general_application_id);
            foreach ($ldc_field_documents as &$rids) {
                $rids['sub_module_id'] = $rids['general_application_history_id'];
                unset($rids['general_application_history_id']); // Remove the old key
            }
            $field_documents = array_merge($all_field_documents, $ldc_field_documents);

            $ldc_data = $this->utility_model->get_sa_user_data_by_type_for_ga($general_application_data['district'], TEMP_TYPE_LDC_USER);
            $aci_data = $this->utility_model->get_sa_user_data_by_type_for_ga($general_application_data['district'], TEMP_TYPE_ACI_USER);
            $talathi_data = $this->utility_model->get_sa_user_data_by_type_for_ga($general_application_data['district'], TEMP_TYPE_TALATHI_USER, $general_application_data['village']);
            $mamlatdar_data = $this->utility_model->get_sa_user_data_by_type_for_ga($general_application_data['district'], TEMP_TYPE_MAMLATDAR_USER);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }

            $success_array = get_success_array();
            $success_array['general_application_detail_data'] = $general_application_data;
            $success_array['general_application_history_data'] = $general_application_history_data;
            $success_array['current_general_application_data'] = $current_general_application_data;
            $success_array['field_documents'] = $field_documents;
            $success_array['all_field_documents'] = $all_field_documents;
            $success_array['ldc_data'] = $ldc_data;
            $success_array['aci_data'] = $aci_data;
            $success_array['talathi_data'] = $talathi_data;
            $success_array['mamlatdar_data'] = $mamlatdar_data;
            $success_array['ldc_report_data'] = $ldc_report_data;

            if (is_mamlatdar_user()) {
                $success_array['forward_to_data'] = array(VALUE_ONE, VALUE_TWO, VALUE_THREE);
            } else if (is_aci_user() && ($check_is_talathi_forward_to == VALUE_ZERO || $check_is_ldc_forward_to == VALUE_ZERO)) {
                if ($general_application_data['is_talathi'] == VALUE_ONE && $general_application_data['is_ldc'] == VALUE_ONE) {
                    $success_array['forward_to_data'] = array(VALUE_FOUR);
                } else if ($general_application_data['is_talathi'] == VALUE_ZERO && $general_application_data['is_ldc'] == VALUE_ONE) {
                    $success_array['forward_to_data'] = array(VALUE_ONE, VALUE_FOUR);
                } elseif ($general_application_data['is_talathi'] == VALUE_ONE && $general_application_data['is_ldc'] == VALUE_ZERO) {
                    $success_array['forward_to_data'] = array(VALUE_THREE, VALUE_FOUR);
                } elseif ($general_application_data['is_talathi'] == VALUE_ZERO && $general_application_data['is_ldc'] == VALUE_ZERO) {
                    $success_array['forward_to_data'] = array(VALUE_ONE, VALUE_THREE, VALUE_FOUR);
                } else {
                    $success_array['forward_to_data'] = array(VALUE_FOUR);
                }
            } else if (is_ldc_user() && ($check_is_talathi_forward_to == VALUE_ZERO || $check_is_aci_forward_to == VALUE_ZERO)) {
                if ($general_application_data['is_talathi'] == VALUE_ONE && $general_application_data['is_aci'] == VALUE_ONE) {
                    $success_array['forward_to_data'] = array(VALUE_FOUR);
                } else if ($general_application_data['is_talathi'] == VALUE_ZERO && $general_application_data['is_aci'] == VALUE_ONE) {
                    $success_array['forward_to_data'] = array(VALUE_ONE, VALUE_FOUR);
                } elseif ($general_application_data['is_talathi'] == VALUE_ONE && $general_application_data['is_aci'] == VALUE_ZERO) {
                    $success_array['forward_to_data'] = array(VALUE_TWO, VALUE_FOUR);
                } elseif ($general_application_data['is_talathi'] == VALUE_ZERO && $general_application_data['is_aci'] == VALUE_ZERO) {
                    $success_array['forward_to_data'] = array(VALUE_ONE, VALUE_TWO, VALUE_FOUR);
                } else {
                    $success_array['forward_to_data'] = array(VALUE_FOUR);
                }
            } else {
                $success_array['forward_to_data'] = array(VALUE_FOUR);
            }

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
            $general_application_id = get_from_post('general_application_id_for_general_application_forward_application');
            $general_application_history_id = get_from_post('general_application_history_id_for_general_application_forward_application');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || !$general_application_id || $general_application_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $is_upload_verification_doc = get_from_post('upload_verification_document_for_general_application');
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
            $forward_to = get_from_post('forward_to_for_general_application');
            if (!$forward_to) {
                echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                return false;
            }
            if ($forward_to == VALUE_ONE) {
                $forward_to_user = get_from_post('mam_to_talathi_for_general_application');
                if (!$forward_to_user) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if ($forward_to == VALUE_TWO) {
                $forward_to_user = get_from_post('mam_to_ci_for_general_application');
                if (!$forward_to_user) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if ($forward_to == VALUE_THREE) {
                $forward_to_user = get_from_post('mam_to_ldc_for_general_application');
                if (!$forward_to_user) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }
            if ($forward_to == VALUE_FOUR) {
                $forward_to_user = get_from_post('forward_to_mam_for_general_application');
                if (!$forward_to_user) {
                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
                    return false;
                }
            }

            if (is_ldc_user()) {
                $ldc_subject = get_from_post('ldc_subject_for_general_application');
                if (!$ldc_subject) {
                    echo json_encode(get_error_array(SUBJECT_MESSAGE));
                    return false;
                }

                $report_doc = $this->input->post('report_doc_item');
                $report_doc_ids = '';
//                if (!$report_doc) {
//                    echo json_encode(get_error_array(ONE_OPTION_MESSAGE));
//                    return false;
//                } else {
                if (!empty($report_doc)) {
                    foreach ($report_doc as $rd) {
                        $report_doc_ids .= $rd['report_doc'] . ',';
                    }
                    $report_doc_ids = rtrim($report_doc_ids, ',');
                }
//                }
            }
            if ((is_ldc_user() || is_aci_user()) && $forward_to == VALUE_FOUR) {
                $authority = get_from_post('authority_for_general_application');
                if (!$authority) {
                    echo json_encode(get_error_array(AUTHORITY_MESSAGE));
                    return false;
                }
                $reference = get_from_post('reference_for_general_application');
                if (!$reference) {
                    echo json_encode(get_error_array(REFERENCE_MESSAGE));
                    return false;
                }
                $copy_to = get_from_post('copy_to_for_general_application');
                if (!$copy_to) {
                    echo json_encode(get_error_array(COPYTO_MESSAGE));
                    return false;
                }
            }

            $report = '';
            if (!is_mamlatdar_user()) {
                $report = get_from_post('report_for_general_application');
//                if (!$report) {
//                    echo json_encode(get_error_array(REPORT_MESSAGE));
//                    return false;
//                }
            }

            $remarks = get_from_post('remarks_for_general_application');
            if (!$remarks) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $forwarded_to_user_name = get_from_post('forwarded_to_user_name');
            $module_status = get_from_post('module_status');

            $basic_detail_data = array();

            if ($module_status == VALUE_TWO) {
                $ex_ap_data = $this->utility_model->get_by_id('general_application_id', $general_application_id, 'general_application');
                if (empty($ex_ap_data)) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }

                $ah = $ex_ap_data['application_history'] != '' ? json_decode($ex_ap_data['application_history'], true) : array();
                array_push($ah, array('forwarded_to_user_id' => $forward_to_user,
                    'forwarded_to_user_name' => $forwarded_to_user_name,
                    'forwarded_to' => $forward_to,
                    'forwarded_datetime' => date('Y-m-d H:i:s')));
                $basic_detail_data['application_history'] = json_encode($ah);

                if ($forward_to == VALUE_ONE) {
                    $basic_detail_data['is_talathi'] = VALUE_ONE;
                } else if ($forward_to == VALUE_TWO) {
                    $basic_detail_data['is_aci'] = VALUE_ONE;
                } else if ($forward_to == VALUE_THREE) {
                    $basic_detail_data['is_ldc'] = VALUE_ONE;
                }
            }

            if (is_talathi_user()) {
                $forward_by = VALUE_ONE;
            } else if (is_aci_user()) {
                $forward_by = VALUE_TWO;
            } else if (is_ldc_user()) {
                $forward_by = VALUE_THREE;
            } else {
                $forward_by = VALUE_FOUR;
            }

            $this->db->trans_start();
            if (is_ldc_user()) {
                $basic_detail_data['ldc_subject'] = $ldc_subject;
            }
            if (($forward_by == VALUE_ONE || $forward_by == VALUE_TWO ||
                    $forward_by == VALUE_THREE) && $forward_to == VALUE_FOUR) {
                $basic_detail_data['is_report_generated'] = VALUE_ONE;
            }
            $basic_detail_data['updated_by'] = $session_user_id;
            $basic_detail_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('general_application_id', $general_application_id, 'general_application', $basic_detail_data);
            $ga_data = $this->general_application_model->get_basic_data_for_ga($general_application_id);

            $forward_to_data = array();
            $forward_to_data['general_application_id'] = $general_application_id;
            $forward_to_data['is_forwarded'] = $module_status;
            $forward_to_data['forwarded_to'] = $forward_to;
            $forward_to_data['forwarded_by'] = $forward_by;
            $forward_to_data['forwarded_to_user_id'] = $forward_to_user;
            $forward_to_data['forwarded_by_user_id'] = $session_user_id;
            if (is_ldc_user()) {
                $forward_to_data['ldc_report_doc_ids'] = $report_doc_ids;
            }
            if ((is_ldc_user() || is_aci_user()) && $forward_to == VALUE_FOUR) {
                $forward_to_data['authority'] = $authority;
                $forward_to_data['reference'] = $reference;
                $forward_to_data['copy_to'] = $copy_to;
            }
            $forward_to_data['report'] = $report;
            $forward_to_data['remarks'] = $remarks;
            $forward_to_data['forwarded_datetime'] = date('Y-m-d H:i:s');
            $forward_to_data['is_upload_verification_doc'] = $is_upload_verification_doc;
            //$forward_to_data['status'] = $module_status;
            $forward_to_data['created_by'] = $session_user_id;
            $forward_to_data['created_time'] = date('Y-m-d H:i:s');

            if (!$general_application_history_id || $general_application_history_id == NULL) {
                $general_application_history_id = $this->utility_model->insert_data('general_application_history', $forward_to_data);
            } else {
                $forward_to_data['updated_by'] = $session_user_id;
                $forward_to_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('general_application_history_id', $general_application_history_id, 'general_application_history', $forward_to_data);
            }
            if ($is_upload_verification_doc == VALUE_ONE) {
                $this->_update_field_doc_items($session_user_id, $general_application_id, $general_application_history_id, $exi_field_doc_items, $new_field_doc_items);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = $module_status == VALUE_ONE ? APP_DRAFT_MESSAGE : APP_FORWARDED_MESSSAGE;
            $success_array['general_application_id'] = $general_application_id;
            $success_array['general_application_data'] = $ga_data;
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
            $general_application_id = get_from_post('general_application_id_for_general_application_forward_application');

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
            $path = 'documents';
            if (!is_dir($path)) {
                mkdir($path);
                chmod("$path", 0755);
            }
            $main_path = $path . DIRECTORY_SEPARATOR . 'general_application';
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
                $dr_data['module_type'] = VALUE_THIRTY;
                $dr_data['module_id'] = $general_application_id;
                //$dr_data['verification_type'] = $verification_type;
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'general_application' . DIRECTORY_SEPARATOR . $ex_data['document'];
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
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'general_application' . DIRECTORY_SEPARATOR . $ex_data['document'];
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

    function _update_field_doc_items($session_user_id, $general_application_id, $general_application_history_id, $exi_field_doc_items, $new_field_doc_items) {
        if ($exi_field_doc_items != '') {
            if (!empty($exi_field_doc_items)) {
                foreach ($exi_field_doc_items as &$value) {
                    $value['module_id'] = $general_application_id;
                    $value['sub_module_id'] = $general_application_history_id;
                    $value['updated_by'] = $session_user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->update_data_batch('field_verification_document_id', 'field_verification_document', $exi_field_doc_items);
            }
        }
        if ($new_field_doc_items != '') {
            if (!empty($new_field_doc_items)) {
                foreach ($new_field_doc_items as &$value) {
                    $value['module_id'] = $general_application_id;
                    $value['sub_module_id'] = $general_application_history_id;
                    $value['created_by'] = $session_user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->insert_data_batch('field_verification_document', $new_field_doc_items);
            }
        }
    }

    function general_application_report_pdf() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if ($session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $general_application_history_id = get_from_post('general_application_history_id_for_gah');
            if ($general_application_history_id == null || !$general_application_history_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $report_data = $this->utility_model->get_by_id('general_application_history_id', $general_application_history_id, 'general_application_history');
            $general_application = $this->utility_model->get_by_id('general_application_id', $report_data['general_application_id'], 'general_application');
            $report_data['subject'] = $general_application['ldc_subject'] != '' ? $general_application['ldc_subject'] : $general_application['subject'];
            $report_data['village'] = $general_application['village_name_text'];
            $report_data['application_year'] = $general_application['application_year'];

            $sa_user_data = $this->utility_model->get_by_id('sa_user_id', $report_data['forwarded_by_user_id'], 'sa_users');
            $report_data['created_by_name'] = $sa_user_data['name'];
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($report_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            error_reporting(E_ERROR);
            $data = array('report_data' => $report_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

            if ($report_data['forwarded_by'] == VALUE_ONE) {
                $mpdf->WriteHTML($this->load->view('general_application/report_pdf', $data, TRUE));
            } else if ($report_data['forwarded_by'] == VALUE_TWO) {
                $mpdf->WriteHTML($this->load->view('general_application/ci_report_pdf', $data, TRUE));
            } else if ($report_data['forwarded_by'] == VALUE_THREE) {
                $mpdf->WriteHTML($this->load->view('general_application/ldc_report_pdf', $data, TRUE));
            }

            //$mpdf->Output('report-' . time() . '.pdf', 'I');

            $temp_filename = 'ga_report_' . $report_data['general_application_id'] . '_' . time() . '.pdf';
            $temp_filepath = 'documents/temp/' . $temp_filename;

            $temp_files_to_remove = array();
            $temp_files_to_merge = array();
            array_push($temp_files_to_remove, $temp_filepath);
            array_push($temp_files_to_merge, $temp_filepath);
            $all_field_documents = $this->utility_model->get_result_by_id('module_id', $report_data['general_application_id'], 'field_verification_document', 'module_type', VALUE_THIRTY, 'sub_module_id', $general_application_history_id);

            $ldc_field_documents = $this->general_application_model->get_ldc_report_doc_by_id($report_data['ldc_report_doc_ids']);

            $field_documents = array_merge($all_field_documents, $ldc_field_documents);

            if (!empty($field_documents)) {
                foreach ($field_documents as $d_data) {
                    $new_doc_path = $this->_copy_file('documents/general_application/', $d_data['document']);
                    array_push($temp_files_to_remove, $new_doc_path);
                    if (strpos($new_doc_path, '.pdf')) {
                        array_push($temp_files_to_merge, $new_doc_path);
                    } else {
                        $mpdf->WriteHTML($this->load->view('common/image_to_pdf', array('photo_doc' => $new_doc_path), TRUE));
                    }
                }
            }
            $mpdf->Output($temp_filepath, 'F');
            $final_filename = 'Report_' . rand(111111111, 99999999) . '_' . time() . '.pdf';
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
            print_r($e->getMessage());
            return;
        }
    }

    function general_application_download_report() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if ($session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $general_application_id = get_from_post('general_application_id_for_report');
            if ($general_application_id == null || !$general_application_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $ga_data = $this->utility_model->get_by_id('general_application_id', $general_application_id, 'general_application');

            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
//            if (empty($ga_data)) {
//                print_r(INVALID_ACCESS_MESSAGE);
//                return;
//            }

            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $data = array('ga_data' => $ga_data);
            $mpdf->WriteHTML($this->load->view('general_application/pdf', $data, TRUE));

            $temp_filename = 'ga_report_' . $general_application_id . '_' . time() . '.pdf';
            $temp_filepath = 'documents/temp/' . $temp_filename;

            $temp_files_to_remove = array();
            $temp_files_to_merge = array();
            array_push($temp_files_to_remove, $temp_filepath);
            array_push($temp_files_to_merge, $temp_filepath);

            $report_data = $this->utility_model->get_result_by_id('general_application_id', $general_application_id, 'general_application_history', '', '', '', '', 'general_application_history_id DESC');

            if (!empty($report_data)) {
                $all_fds = generate_array_for_id_objects($this->utility_model->get_result_by_id('module_id', $general_application_id, 'field_verification_document', 'module_type', VALUE_THIRTY), 'sub_module_id');

                $total_rd = count($report_data);
                foreach ($report_data as $index => $r_data) {
                    if ($r_data['report'] != '') {
                        $r_data['subject'] = $ga_data['ldc_subject'] != '' ? $ga_data['ldc_subject'] : $ga_data['subject'];
                        $r_data['village'] = $ga_data['village_name_text'];
                        $r_data['application_year'] = $ga_data['application_year'];
                        $sa_user_data = $this->utility_model->get_by_id('sa_user_id', $r_data['forwarded_by_user_id'], 'sa_users');
                        $r_data['created_by_name'] = $sa_user_data['name'];
                        if ($index != $total_rd) {
                            $mpdf->WriteHTML('<pagebreak></pagebreak>');
                        }
                        $data = array('report_data' => $r_data);
                        // $mpdf->WriteHTML($this->load->view('general_application/report_pdf', $data, TRUE));
                        if ($r_data['forwarded_by'] == VALUE_ONE) {
                            $mpdf->WriteHTML($this->load->view('general_application/report_pdf', $data, TRUE));
                        } else if ($r_data['forwarded_by'] == VALUE_TWO) {
                            $mpdf->WriteHTML($this->load->view('general_application/ci_report_pdf', $data, TRUE));
                        } else if ($r_data['forwarded_by'] == VALUE_THREE) {
                            $mpdf->WriteHTML($this->load->view('general_application/ldc_report_pdf', $data, TRUE));
                        }
                    }
                    $field_documents = isset($all_fds[$r_data['general_application_history_id']]) ? $all_fds[$r_data['general_application_history_id']] : array();
                    if (!empty($field_documents)) {
                        foreach ($field_documents as $d_data) {
                            $new_doc_path = $this->_copy_file('documents/general_application/', $d_data['document']);
                            array_push($temp_files_to_remove, $new_doc_path);
                            if (strpos($new_doc_path, '.pdf')) {
                                array_push($temp_files_to_merge, $new_doc_path);
                            } else {
                                $mpdf->WriteHTML($this->load->view('common/image_to_pdf', array('photo_doc' => $new_doc_path), TRUE));
                            }
                        }
                    }
                }
            }
            $mpdf->Output($temp_filepath, 'F');
            $final_filename = 'ga_final_report_' . rand(111111111, 99999999) . '_' . time() . '.pdf';
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
            print_r($e->getMessage());
            return;
        }
    }

    function general_application_download_certificate() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if ($session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $general_application_id = get_from_post('general_application_id_for_certificate');
            if ($general_application_id == null || !$general_application_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $general_application = $this->utility_model->get_by_id('general_application_id', $general_application_id, 'general_application');

            $report_data = $this->general_application_model->get_certificate_data($general_application_id);

            $report_data['subject'] = $general_application['ldc_subject'] != '' ? $general_application['ldc_subject'] : $general_application['subject'];
            $report_data['village'] = $general_application['village_name_text'];
            $report_data['application_year'] = $general_application['application_year'];

            $sa_user_data = $this->utility_model->get_by_id('sa_user_id', $report_data['forwarded_by_user_id'], 'sa_users');
            $report_data['created_by_name'] = $sa_user_data['name'];

            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($report_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }

            error_reporting(E_ERROR);
            $data = array('report_data' => $report_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('general_application/ldc_report_pdf', $data, TRUE));

            $temp_filename = 'ga_certificate_' . $general_application_id . '_' . time() . '.pdf';
            $temp_filepath = 'documents/temp/' . $temp_filename;

            $temp_files_to_remove = array();
            $temp_files_to_merge = array();
            array_push($temp_files_to_remove, $temp_filepath);
            array_push($temp_files_to_merge, $temp_filepath);
            $all_field_documents = $this->utility_model->get_result_by_id('module_id', $general_application_id, 'field_verification_document', 'module_type', VALUE_THIRTY, 'sub_module_id', $report_data['general_application_history_id']);

            $ldc_field_documents = $this->general_application_model->get_ldc_report_doc_by_id($report_data['ldc_report_doc_ids']);

            $field_documents = array_merge($all_field_documents, $ldc_field_documents);

            if (!empty($field_documents)) {
                foreach ($field_documents as $d_data) {
                    $new_doc_path = $this->_copy_file('documents/general_application/', $d_data['document']);
                    array_push($temp_files_to_remove, $new_doc_path);
                    if (strpos($new_doc_path, '.pdf')) {
                        array_push($temp_files_to_merge, $new_doc_path);
                    } else {
                        $mpdf->WriteHTML($this->load->view('common/image_to_pdf', array('photo_doc' => $new_doc_path), TRUE));
                    }
                }
            }
            $mpdf->Output($temp_filepath, 'F');
            $final_filename = 'certitifcate_' . rand(111111111, 99999999) . '_' . time() . '.pdf';
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
            print_r($e->getMessage());
            return;
        }
    }

    function _copy_file($doc_path, $ex_file_name) {
        $old = $doc_path . $ex_file_name;
        $new = 'documents/temp/' . $ex_file_name;
        copy($old, $new);
        return $new;
    }

}

/*
 * EOF: ./application/controller/General_application.php
 */