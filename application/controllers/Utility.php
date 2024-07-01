<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('utility_model');
        $this->load->model('payment_model');
    }

    function generate_new_token() {
        if (!is_post()) {
            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
            return false;
        }
        echo json_encode(get_success_array());
    }

    function get_common_data() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        $success_array = get_success_array();
        $success_array['village_data'] = array();
        $success_array['urban_village_data'] = array();
        $success_array['state_data'] = array();
        $success_array['district_data'] = array();
        $success_array['department_data'] = array();
        if ($session_user_id == NULL || !$session_user_id) {
            echo json_encode($success_array);
            return false;
        }
        $this->load->model('utility_model');
        $this->db->trans_start();
        if (is_admin()) {
            $department_data = $this->utility_model->get_result_data('department', 'department_name', 'ASC');
            $success_array['department_data'] = generate_array_for_id_indisde_id_object($department_data, 'district', 'department_id');
        }
        $success_array['village_data'] = generate_array_for_id_object($this->utility_model->get_villages_data('daman_rural_villages'), 'village');
        $success_array['diu_village_data'] = generate_array_for_id_object($this->utility_model->get_villages_data('diu_rural_villages'), 'village');
        $success_array['urban_village_data'] = generate_array_for_id_object($this->utility_model->get_urban_villages_data(), 'village');
        $success_array['state_data'] = generate_array_for_id_object($this->utility_model->get_result_data('state'), 'state_code');
        $temp_district_data = $this->utility_model->get_result_data('district');
        $district_data = array();
        foreach ($temp_district_data as $data) {
            if (!isset($district_data[$data['state_code']])) {
                $district_data[$data['state_code']] = array();
            }
            if (!isset($district_data[$data['state_code']][$data['district_code']])) {
                $district_data[$data['state_code']][$data['district_code']] = $data;
            }
        }
        $success_array['district_data'] = $district_data;

        $module_type_array = $this->config->item('query_module_array');
        $pending_app_for_dv = $this->payment_model->get_pending_dv_data($session_user_id);
        if (!empty($pending_app_for_dv)) {
            foreach ($pending_app_for_dv as $fp) {
                $this->payment_lib->check_payment_dv($module_type_array, $fp);
            }
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode($success_array);
            return;
        }
        echo json_encode($success_array);
    }

    function get_survey_data_by_district() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $district = get_from_post('district_for_ror');
            if ($district != VALUE_ONE && $district != VALUE_TWO && $district != VALUE_THREE) {
                echo json_encode(array('success' => false, 'message' => SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $type = get_from_post('type_for_ror');
            if ($type != VALUE_ONE && $type != VALUE_TWO && $type != VALUE_THREE) {
                echo json_encode(array('success' => false, 'message' => SELECT_TYPE_MESSAGE));
                return false;
            }
            if ($type == VALUE_TWO) {
                $area_type = get_from_post('area_type_for_ror');
                if (!$area_type) {
                    echo json_encode(array('success' => false, 'message' => SELECT_URBAN_AREA_MESSAGE));
                    return false;
                }
                if ($area_type != VALUE_ONE && $area_type != VALUE_TWO) {
                    echo json_encode(array('success' => false, 'message' => SELECT_URBAN_AREA_MESSAGE));
                    return false;
                }
            }
            $village = get_from_post('village_for_ror');
            if (!$village) {
                echo json_encode(array('success' => false, 'message' => SELECT_VILLAGE_MESSAGE));
                return false;
            }
            $success_array = array();
            $success_array['success'] = true;
            $success_array['survey_data'] = array();
            $this->db->trans_start();
            if ($district == VALUE_ONE && $type == VALUE_ONE) {
                $success_array['survey_data'] = $this->utility_model->get_survey_list('rural_land_parcels', $village);
            }
            if ($district == VALUE_ONE && $type == VALUE_TWO) {
                if ($area_type == VALUE_ONE) {
                    $temp_ptsheet_data = $this->utility_model->get_ptg_list($area_type);
                    if (!empty($temp_ptsheet_data)) {
                        $success_array['survey_data'] = generate_pt_sheet_number_array($temp_ptsheet_data, $village);
                    }
                } else if ($area_type == VALUE_TWO) {
                    $success_array['survey_data'] = $this->utility_model->get_ptg_list($area_type, $village);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => false, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_subdiv_data_by_district() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $district = get_from_post('district_for_ror');
            if ($district != VALUE_ONE && $district != VALUE_TWO && $district != VALUE_THREE) {
                echo json_encode(array('success' => false, 'message' => SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $type = get_from_post('type_for_ror');
            if ($type != VALUE_ONE && $type != VALUE_TWO && $type != VALUE_THREE) {
                echo json_encode(array('success' => false, 'message' => SELECT_TYPE_MESSAGE));
                return false;
            }
            if ($type == VALUE_TWO) {
                $area_type = get_from_post('area_type_for_ror');
                if (!$area_type) {
                    echo json_encode(array('success' => false, 'message' => SELECT_URBAN_AREA_MESSAGE));
                    return false;
                }
                if ($area_type != VALUE_ONE && $area_type != VALUE_TWO) {
                    echo json_encode(array('success' => false, 'message' => SELECT_URBAN_AREA_MESSAGE));
                    return false;
                }
            }
            $village = get_from_post('village_for_ror');
            if (!$village) {
                echo json_encode(array('success' => false, 'message' => SELECT_VILLAGE_MESSAGE));
                return false;
            }
            $survey = get_from_post('survey_for_ror');
            if (!$survey && $survey != 0) {
                echo json_encode(array('success' => false, 'message' => SELECT_SURVEY_MESSAGE));
                return false;
            }
            $success_array = array();
            $success_array['success'] = true;
            $success_array['subdiv_data'] = array();
            $this->db->trans_start();
            if ($district == VALUE_ONE && $type == VALUE_ONE) {
                $success_array['subdiv_data'] = $this->utility_model->get_subdiv_list('rural_land_parcels', $village, $survey);
            }
            if ($district == VALUE_ONE && $type == VALUE_TWO) {
                if ($area_type == VALUE_ONE) {
                    $success_array['subdiv_data'] = $this->utility_model->get_clp_list($area_type, $survey);
                } else if ($area_type == VALUE_TWO) {
                    $success_array['subdiv_data'] = $this->utility_model->get_clp_list($area_type, $survey, $village);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => false, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_query_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if (!$module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type_array = $this->config->item('query_module_array');
            if (!isset($module_type_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_access_data = $module_type_array[$module_type];
            if (empty($temp_access_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $module_data = $this->utility_model->get_by_id($temp_access_data['key_id_text'], $module_id, $temp_access_data['tbl_text']);
            if (empty($module_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_query_data = $this->utility_model->query_data_by_type_id($module_type, $module_id);
            $query_data = array();
            foreach ($temp_query_data as $qd_data) {
                if (!isset($query_data[$qd_data['query_id']])) {
                    $query_data[$qd_data['query_id']] = array();
                    $query_data[$qd_data['query_id']]['query_id'] = $qd_data['query_id'];
                    $query_data[$qd_data['query_id']]['module_type'] = $qd_data['module_type'];
                    $query_data[$qd_data['query_id']]['module_id'] = $qd_data['module_id'];
                    $query_data[$qd_data['query_id']]['query_type'] = $qd_data['query_type'];
                    $query_data[$qd_data['query_id']]['user_id'] = $qd_data['user_id'];
                    $query_data[$qd_data['query_id']]['query_by_name'] = $qd_data['query_by_name'];
                    $query_data[$qd_data['query_id']]['query_by_mobile_number'] = $qd_data['query_by_mobile_number'];
                    $query_data[$qd_data['query_id']]['remarks'] = $qd_data['remarks'];
                    $query_data[$qd_data['query_id']]['display_datetime'] = $qd_data['display_datetime'];
                    $query_data[$qd_data['query_id']]['status'] = $qd_data['status'];
                    $query_data[$qd_data['query_id']]['query_documents'] = array();
                }
                if ($qd_data['query_document_id']) {
                    $tmp_doc = array();
                    $tmp_doc['query_document_id'] = $qd_data['query_document_id'];
                    $tmp_doc['doc_name'] = $qd_data['doc_name'];
                    $tmp_doc['document'] = $qd_data['document'];
                    array_push($query_data[$qd_data['query_id']]['query_documents'], $tmp_doc);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['module_data'] = $module_data;
            $success_array['query_data'] = $query_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function raise_a_query() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type_for_query');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE &&
                    $module_type != VALUE_FOUR && $module_type != VALUE_FIVE && $module_type != VALUE_SIX &&
                    $module_type != VALUE_SEVEN && $module_type != VALUE_EIGHT && $module_type != VALUE_NINE && $module_type != VALUE_TEN &&
                    $module_type != VALUE_ELEVEN && $module_type != VALUE_TWELVE && $module_type != VALUE_THIRTEEN &&
                    $module_type != VALUE_FOURTEEN && $module_type != VALUE_FIFTEEN && $module_type != VALUE_SIXTEEN && $module_type != VALUE_EIGHTEEN &&
                    $module_type != VALUE_NINETEEN && $module_type != VALUE_TWENTY &&
                    $module_type != VALUE_TWENTYTHREE && $module_type != VALUE_TWENTYFIVE && $module_type != VALUE_THIRTY) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type_array = $this->config->item('query_module_array');
            if (!isset($module_type_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_access_data = $module_type_array[$module_type];
            if (empty($temp_access_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id_for_query');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_type = get_from_post('query_type_for_query');
            if ($query_type != VALUE_ONE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $remarks = get_from_post('remarks_for_query');
            if (!$remarks) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_id = get_from_post('query_id_for_query');
            $this->db->trans_start();
            $insert_data = array();
            $insert_data['remarks'] = $remarks;
            $insert_data['status'] = VALUE_ONE;
            $insert_data['query_by_name'] = get_from_session('name');
            if (!$query_id || $query_id == NULL) {
                $insert_data['module_type'] = $module_type;
                $insert_data['module_id'] = $module_id;
                $insert_data['query_type'] = $query_type;
                $insert_data['user_id'] = $session_user_id;
                $insert_data['created_by'] = $session_user_id;
                $insert_data['created_time'] = date('Y-m-d H:i:s');
                $insert_data['query_datetime'] = $insert_data['created_time'];
                $query_id = $this->utility_model->insert_data('query', $insert_data);
                $insert_data['query_id'] = $query_id;
            } else {
                $insert_data['updated_by'] = $session_user_id;
                $insert_data['updated_time'] = date('Y-m-d H:i:s');
                $insert_data['query_datetime'] = $insert_data['updated_time'];
                $this->utility_model->update_data('query_id', $query_id, 'query', $insert_data);
                $insert_data['query_id'] = $query_id;
            }

            $this->_update_qd_items($session_user_id, $query_id);

            $update_data = array();
            $update_data['query_status'] = VALUE_ONE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data($temp_access_data['key_id_text'], $module_id, $temp_access_data['tbl_text'], $update_data);

            $qd_data = $this->utility_model->get_result_data_by_id('query_id', $query_id, 'query_document');

            $ex_data = $this->utility_model->get_user_data_for_query_management($temp_access_data, $module_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if ($module_type == VALUE_ELEVEN) {
                $registration_message = 'Query Raised for your Application Number : ' . $ex_data['temp_application_number'];
            } else {
                $registration_message = 'Query Raised for your Application Number : ' . $ex_data['application_number'];
                //Note: Temporary Solution For Mobile Number
                if (isset($temp_access_data['mob_no'])) {
                    $mob_no = isset($ex_data[$temp_access_data['mob_no']]) ? $ex_data[$temp_access_data['mob_no']] : '';
                    $this->load->helper('sms_helper');
                    send_SMS($this, $session_user_id, $mob_no, VALUE_SIX, $module_type, $module_id, $query_id, $ex_data['application_number']);
                }
            }
            $this->load->library('email_lib');
            $this->email_lib->send_email($ex_data, 'Query Raised', $registration_message, VALUE_FIVE);

            $success_array = get_success_array();
            $success_array['message'] = QUERY_RAISED_MESSAGE;
            $success_array['query_status'] = VALUE_ONE;
            $success_array['query_datetime'] = convert_to_new_datetime_format($insert_data['query_datetime']);
            $success_array['query_by_name'] = $insert_data['query_by_name'];
            $success_array['query_document_data'] = $qd_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _update_qd_items($user_id, $query_id) {
        $exi_qd_items = $this->input->post('exi_qd_items');
        if ($exi_qd_items != '') {
            if (!empty($exi_qd_items)) {
                foreach ($exi_qd_items as &$value) {
                    $value['query_id'] = $query_id;
                    $value['updated_by'] = $user_id;
                    $value['updated_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->update_data_batch('query_document_id', 'query_document', $exi_qd_items);
            }
        }
        $new_qd_items = $this->input->post('new_qd_items');
        if ($new_qd_items != '') {
            if (!empty($new_qd_items)) {
                foreach ($new_qd_items as &$value) {
                    $value['query_id'] = $query_id;
                    $value['created_by'] = $user_id;
                    $value['created_time'] = date('Y-m-d H:i:s');
                }
                $this->utility_model->insert_data_batch('query_document', $new_qd_items);
            }
        }
    }

    function resolved_query() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE &&
                    $module_type != VALUE_FOUR && $module_type != VALUE_FIVE && $module_type != VALUE_SIX &&
                    $module_type != VALUE_SEVEN && $module_type != VALUE_EIGHT && $module_type != VALUE_NINE && $module_type != VALUE_TEN &&
                    $module_type != VALUE_ELEVEN && $module_type != VALUE_TWELVE && $module_type != VALUE_THIRTEEN &&
                    $module_type != VALUE_FOURTEEN && $module_type != VALUE_FIFTEEN && $module_type != VALUE_SIXTEEN && $module_type != VALUE_EIGHTEEN &&
                    $module_type != VALUE_NINETEEN && $module_type != VALUE_TWENTY &&
                    $module_type != VALUE_TWENTYTHREE && $module_type != VALUE_TWENTYFIVE && $module_type != VALUE_THIRTY) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type_array = $this->config->item('query_module_array');
            if (!isset($module_type_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_access_data = $module_type_array[$module_type];
            if (empty($temp_access_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $remarks = get_from_post('remarks');
            if (!$remarks) {
                echo json_encode(get_error_array(REMARKS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $insert_data = array();
            $insert_data['remarks'] = $remarks;
            $insert_data['status'] = VALUE_ONE;
            $insert_data['query_by_name'] = get_from_session('name');
            $insert_data['module_type'] = $module_type;
            $insert_data['module_id'] = $module_id;
            $insert_data['query_type'] = VALUE_THREE;
            $insert_data['user_id'] = $session_user_id;
            $insert_data['created_by'] = $session_user_id;
            $insert_data['created_time'] = date('Y-m-d H:i:s');
            $insert_data['query_datetime'] = $insert_data['created_time'];
            $insert_data['query_id'] = $this->utility_model->insert_data('query', $insert_data);

            $update_data = array();
            $update_data['query_status'] = VALUE_THREE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data($temp_access_data['key_id_text'], $module_id, $temp_access_data['tbl_text'], $update_data);
            $ex_module_data = $this->utility_model->get_by_id($temp_access_data['key_id_text'], $module_id, $temp_access_data['tbl_text']);

            $ex_data = $this->utility_model->get_user_data_for_query_management($temp_access_data, $module_id);
            if ($module_type == VALUE_ELEVEN) {
                $registration_message = 'Query has been Resolved for your Application Number : ' . $ex_data['temp_application_number'];
            } else {
                $registration_message = 'Query has been Resolved for your Application Number : ' . $ex_data['application_number'];
                //Note: Temporary Solution For Mobile Number
                if (isset($temp_access_data['mob_no'])) {
                    $mob_no = isset($ex_data[$temp_access_data['mob_no']]) ? $ex_data[$temp_access_data['mob_no']] : '';
                    $this->load->helper('sms_helper');
                    send_SMS($this, $session_user_id, $mob_no, VALUE_SEVEN, $module_type, $module_id, $insert_data['query_id'], $ex_data['application_number']);
                }
            }
            $this->load->library('email_lib');
            $this->email_lib->send_email($ex_data, 'Query Resolved', $registration_message, VALUE_NINE);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = QUERY_RESOLVED_MESSAGE;
            $success_array['query_status'] = VALUE_THREE;
            $success_array['status'] = $ex_module_data['status'];
            $success_array['query_datetime'] = convert_to_new_datetime_format($insert_data['query_datetime']);
            $success_array['query_by_name'] = $insert_data['query_by_name'];
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function upload_query_document() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $query_id = get_from_post('query_id_for_query');
            $query_document_id = get_from_post('query_document_id_for_query');
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type_for_query');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO && $module_type != VALUE_THREE &&
                    $module_type != VALUE_FOUR && $module_type != VALUE_FIVE && $module_type != VALUE_SIX &&
                    $module_type != VALUE_SEVEN && $module_type != VALUE_EIGHT && $module_type != VALUE_NINE && $module_type != VALUE_TEN &&
                    $module_type != VALUE_ELEVEN && $module_type != VALUE_TWELVE && $module_type != VALUE_THIRTEEN &&
                    $module_type != VALUE_FOURTEEN && $module_type != VALUE_FIFTEEN && $module_type != VALUE_SIXTEEN && $module_type != VALUE_EIGHTEEN &&
                    $module_type != VALUE_NINETEEN && $module_type != VALUE_TWENTY &&
                    $module_type != VALUE_TWENTYTHREE && $module_type != VALUE_TWENTYFIVE && $module_type != VALUE_THIRTY) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type_array = $this->config->item('query_module_array');
            if (!isset($module_type_array[$module_type])) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_access_data = $module_type_array[$module_type];
            if (empty($temp_access_data)) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id_for_query');
            if (!$module_id) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }
            $query_type = get_from_post('query_type_for_query');
            if ($query_type != VALUE_ONE && $query_type != VALUE_TWO) {
                echo json_encode(array('success' => FALSE, 'message' => INVALID_ACCESS_MESSAGE));
                return false;
            }

            if ($_FILES['document_for_query']['name'] == '') {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_DOC_MESSAGE));
                return;
            }
            $evidence_size = $_FILES['document_for_query']['size'];
            if ($evidence_size == 0) {
                echo json_encode(array('success' => FALSE, 'message' => DOC_INVALID_SIZE_MESSAGE));
                return;
            }
            $maxsize = '20971520';
            if ($evidence_size >= $maxsize) {
                echo json_encode(array('success' => FALSE, 'message' => UPLOAD_MAX_ONE_MB_MESSAGE));
                return;
            }
            $path = 'documents';
            if (!is_dir($path)) {
                mkdir($path);
                chmod("$path", 0755);
            }
            $main_path = $path . DIRECTORY_SEPARATOR . 'query';
            if (!is_dir($main_path)) {
                mkdir($main_path);
                chmod("$main_path", 0755);
            }
            $this->load->library('upload');
            $temp_qd_filename = str_replace('_', '', $_FILES['document_for_query']['name']);
            $qd_filename = 'query_doc_' . (rand(10000, 99999)) . time() . '.' . pathinfo($temp_qd_filename, PATHINFO_EXTENSION);
            //Change file name
            $qd_final_path = $main_path . DIRECTORY_SEPARATOR . $qd_filename;
            if (!move_uploaded_file($_FILES['document_for_query']['tmp_name'], $qd_final_path)) {
                echo json_encode(array('success' => FALSE, 'message' => DOCUMENT_NOT_UPLOAD_MESSAGE));
                return;
            }
            $this->db->trans_start();
            $qdata = array();
            if (!$query_id || $query_id == NULL) {
                $qdata['module_type'] = $module_type;
                $qdata['module_id'] = $module_id;
                $qdata['query_type'] = $query_type;
                $qdata['user_id'] = $session_user_id;
                $qdata['created_by'] = $session_user_id;
                $qdata['created_time'] = date('Y-m-d H:i:s');
                $query_id = $this->utility_model->insert_data('query', $qdata);
            }

            $qd_data = array();
            $qd_data['document'] = $qd_filename;
            if (!$query_document_id || $query_document_id == NULL) {
                $qd_data['query_id'] = $query_id;
                $qd_data['created_by'] = $session_user_id;
                $qd_data['created_time'] = date('Y-m-d H:i:s');
                $query_document_id = $this->utility_model->insert_data('query_document', $qd_data);
            } else {
                $qd_data['updated_by'] = $session_user_id;
                $qd_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_data('query_document_id', $query_document_id, 'query_document', $qd_data);
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(array('success' => FALSE, 'message' => DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = array();
            $success_array['query_id'] = $query_id;
            $success_array['query_document_id'] = $query_document_id;
            $success_array['document_name'] = $qd_filename;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(array('success' => FALSE, 'message' => $e->getMessage()));
            return;
        }
    }

    function remove_query_document_item() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $query_document_id = get_from_post('query_document_id');
            if ($session_user_id == NULL || !$session_user_id || !$query_document_id || $query_document_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id('query_document_id', $query_document_id, 'query_document');
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return;
            }
            if ($ex_data['document'] != '') {
                $file_path = 'documents' . DIRECTORY_SEPARATOR . 'query' . DIRECTORY_SEPARATOR . $ex_data['document'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $update_data = array();
            $update_data['is_delete'] = IS_DELETE;
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('query_document_id', $query_document_id, 'query_document', $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = QUERY_DOCUMENT_ITEM_REMOVED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_survey_number_list() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $user_id == NULL || !$user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $district = get_from_post('district');
            if ($district != TALUKA_DAMAN && $district != TALUKA_DIU) {
                echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $village = get_from_post('village');
            if (!$village) {
                echo json_encode(get_error_array(SELECT_VILLAGE_MESSAGE));
                return false;
            }
            $module_flag = get_from_post('module_flag');
            $this->db->trans_start();
            if ($district == VALUE_ONE) {
                $survey_data = $this->utility_model->get_survey_list('rural_land_parcels', $village, $module_flag);
            } else if ($district == VALUE_TWO) {
                $survey_data = $this->utility_model->get_survey_list('rural_land_parcels_diu', $village, $module_flag);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['survey_number_data'] = $survey_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_subdivision_number_list() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $user_id == NULL || !$user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $district = get_from_post('district');
            if ($district != TALUKA_DAMAN && $district != TALUKA_DIU) {
                echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $village = get_from_post('village');
            if (!$village) {
                echo json_encode(get_error_array(SELECT_VILLAGE_MESSAGE));
                return false;
            }
            $survey_number = get_from_post('survey_number');
            if (!$survey_number && $survey_number != 0) {
                echo json_encode(get_error_array(SELECT_SURVEY_MESSAGE));
                return false;
            }
            $module_flag = get_from_post('module_flag');
            $this->db->trans_start();
            if ($district == VALUE_ONE) {
                $subdiv_data = generate_array_for_id_object_for_string($this->utility_model->get_subdiv_list('rural_land_parcels', $village, $survey_number, $module_flag), 'subdiv');
            } else if ($district == VALUE_TWO) {
                $subdiv_data = generate_array_for_id_object_for_string($this->utility_model->get_subdiv_list('rural_land_parcels_diu', $village, $survey_number, $module_flag), 'subdiv');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['subdivision_number_data'] = $subdiv_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_occupant_details_by_village() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $user_id == NULL || !$user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $district = get_from_post('district_for_arrears_update');
            if ($district != TALUKA_DAMAN && $district != TALUKA_DIU) {
                echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $village = get_from_post('village_for_arrears_update');
            if (!$village) {
                echo json_encode(get_error_array(SELECT_VILLAGE_MESSAGE));
                return false;
            }
            $survey_number = get_from_post('survey_number_for_arrears_update');
            if (!$survey_number && $survey_number != 0) {
                echo json_encode(get_error_array(SELECT_SURVEY_MESSAGE));
                return false;
            }
            $subdiv_number = get_from_post('subdivision_number_for_arrears_update');
            if (!$subdiv_number) {
                echo json_encode(get_error_array(SELECT_SUBDIV_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            if ($district == VALUE_ONE) {
                $occupant_data = $this->utility_model->get_occupant_data($village, $survey_number, $subdiv_number, 'rural_land_parcels');
            } else if ($district == VALUE_TWO) {
                $occupant_data = $this->utility_model->get_occupant_data($village, $survey_number, $subdiv_number, 'rural_land_parcels_diu');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['occupant_data'] = $occupant_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_land_details_by_occupants() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $user_id == NULL || !$user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $district = get_from_post('district_for_arrears_update');
            if ($district != TALUKA_DAMAN && $district != TALUKA_DIU) {
                echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $village = get_from_post('village_for_arrears_update');
            if (!$village) {
                echo json_encode(get_error_array(SELECT_VILLAGE_MESSAGE));
                return false;
            }
            $occupant_name = get_from_post('occupant_name_for_arrears_update');
            if (!$occupant_name) {
                echo json_encode(get_error_array(OCCUPANT_NAME_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            if ($district == VALUE_ONE) {
                $land_data = $this->utility_model->get_all_land_data($district, $village, $occupant_name, 'rural_land_parcels');
            } else if ($district == VALUE_TWO) {
                $land_data = $this->utility_model->get_all_land_data($district, $village, $occupant_name, 'rural_land_parcels_diu');
            }

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['land_data'] = $land_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_land_arrears() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if ($module_type != VALUE_ONE && $module_type != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $district = get_from_post('district_for_land_arrears_update');
            if ($district != TALUKA_DAMAN && $district != TALUKA_DIU) {
                echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $village = get_from_post('village_for_land_arrears_update');
            if (!$village) {
                echo json_encode(get_error_array(SELECT_VILLAGE_MESSAGE));
                return false;
            }
            if ($module_type == VALUE_TWO) {
                $khata_number = get_from_post('khata_number_for_land_arrears_update');
                if (!$khata_number) {
                    echo json_encode(get_error_array(SELECT_KHATA_NUMBER_MESSAGE));
                    return false;
                }
            }
            $survey_number = get_from_post('survey_number_for_land_arrears_update');
            if (!$survey_number && $survey_number != 0) {
                echo json_encode(get_error_array(SELECT_SURVEY_MESSAGE));
                return false;
            }
            $subdiv_number = get_from_post('subdivision_number_for_land_arrears_update');
            if (!$subdiv_number) {
                echo json_encode(get_error_array(SELECT_SUBDIV_MESSAGE));
                return false;
            }
            $arrears = get_from_post('all_land_arrears_for_land_arrears_update');
            if (!$arrears && $arrears != 0) {
                echo json_encode(get_error_array(ARREARS_MESSAGE));
                return false;
            }
            if ($district == VALUE_ONE) {
                $ex_rlp = $this->utility_model->get_by_id_multiple('village', $village, 'rural_land_parcels', 'survey', $survey_number, 'subdiv', $subdiv_number);
            } else if ($district == VALUE_TWO) {
                $ex_rlp = $this->utility_model->get_by_id_multiple('village', $village, 'rural_land_parcels_diu', 'survey', $survey_number, 'subdiv', $subdiv_number);
            }
            if (empty($ex_rlp)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $cfy = get_financial_year();
            $this->db->trans_start();
            $au_data = array();
            $au_data['arrears'] = $arrears;
            $au_data['area'] = $ex_rlp['area'];
            $au_data['per_guntha_price'] = $ex_rlp['area_type'] == VALUE_ONE ? RLP_UA_PRICE_PER_GUNTHA : RLP_RA_PRICE_PER_GUNTHA;
            $ex_data = $this->utility_model->get_cfy_land_tax_details($cfy, $village, $survey_number, $subdiv_number);
            if (empty($ex_data)) {
                $au_data['financial_year'] = $cfy;
                $au_data['district'] = $district;
                $au_data['village'] = $village;
                $au_data['survey'] = $survey_number;
                $au_data['subdiv'] = $subdiv_number;
                $au_data['created_by'] = $session_user_id;
                $au_data['created_time'] = date('Y-m-d H:i:s');
                $this->utility_model->insert_data('rlp_land_tax', $au_data);
            } else {
                $au_data['updated_by'] = $session_user_id;
                $au_data['updated_time'] = date('Y-m-d H:i:s');
                $this->utility_model->update_land_tax_arrears_data($cfy, $district, $village, $survey_number, $subdiv_number, $au_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = ARREARS_UPDATE_MESSAGE;
            if ($module_type == VALUE_ONE) {
                $success_array['total_land_tax_payment'] = $this->utility_model->get_total_paid_land_tax($cfy, $district, $village, $survey_number, $subdiv_number);
            } else if ($module_type == VALUE_TWO) {
                $this->load->model('landtax_na_model');
                $success_array['land_data'] = $this->landtax_na_model->get_all_na_land_detail_by_khata_number($district, $village, $khata_number);
                $success_array['s_district'] = $district;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_khata_number() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $khata_number_data = $this->input->post('khata_number_detail');
            $district = $this->input->post('district');
            $village = $this->input->post('village');
            if (!is_post() || $user_id == NULL || !$user_id || ($district != TALUKA_DAMAN && $district != TALUKA_DIU) ||
                    empty($khata_number_data) || !$village) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            foreach ($khata_number_data as $row) {
                $t_array = array('khata_number' => $row['khata_number'], 'aadhar_card_number' => $row['aadhar_card_number'],
                    'mobile_number' => $row['mobile_number'], 'is_assign_kn' => VALUE_ONE);
                if ($district == VALUE_ONE) {
                    $this->utility_model->update_data('village', $village, 'rural_land_parcels', $t_array, 'survey', $row['survey'], 'subdiv', $row['subdiv']);
                } else if ($district == VALUE_TWO) {
                    $this->utility_model->update_data('village', $village, 'rural_land_parcels_diu', $t_array, 'survey', $row['survey'], 'subdiv', $row['subdiv']);
                }
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = KHATA_NUMBER_UPDATE_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_khata_number_by_village() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $user_id == NULL || !$user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $village = get_from_post('village_for_arrears_update');
            if (!$village) {
                echo json_encode(get_error_array(SELECT_VILLAGE_MESSAGE));
                return false;
            }
            $district = get_from_post('district_for_arrears_update');
            if (!$district) {
                echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            if ($district == VALUE_ONE) {
                $khata_number_data = $this->utility_model->get_khata_number_by_village($village, 'rural_land_parcels');
            } else if ($district == VALUE_TWO) {
                $khata_number_data = $this->utility_model->get_khata_number_by_village($village, 'rural_land_parcels_diu');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['khata_number_data'] = $khata_number_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_f_payment_details() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if (!$module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_array = $this->config->item('query_module_array');
            if (!isset($mt_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_data = $mt_array[$module_type];
            if (empty($mt_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_data = $this->utility_model->get_by_id($mt_data['key_id_text'], $module_id, $mt_data['tbl_text']);
            if (empty($module_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $this->payment_lib->get_payment_history_data($module_type, $module_id, $module_data);
            $module_data['fb_data'] = $this->utility_model->get_result_data_by_id('module_type', $module_type, 'fees_bifurcation', 'module_id', $module_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['module_data'] = $module_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_pages_details() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ld_module_type = get_from_post('ld_module_type');
            if (!$ld_module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $ldm_array = $this->config->item('form_land_details_module_array');
            if (!isset($ldm_array[$ld_module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if (!$module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_array = $this->config->item('query_module_array');
            if (!isset($mt_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_data = $mt_array[$module_type];
            if (empty($mt_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_data = $this->utility_model->get_by_id($mt_data['key_id_text'], $module_id, $mt_data['tbl_text']);
            if (empty($module_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($module_data['status'] != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $fl_data = $this->utility_model->get_result_data_by_id('module_id', $module_id, 'form_land_details', 'module_type', $ld_module_type, 'module_id', 'DESC');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $module_data['fl_data'] = $fl_data;
            $success_array['module_data'] = $module_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_pages_details() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $s_type = get_from_post('s_type');
            if ($s_type != VALUE_ONE && $s_type != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if (!$module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_array = $this->config->item('query_module_array');
            if (!isset($mt_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_data = $mt_array[$module_type];
            if (empty($mt_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_data = $this->utility_model->get_by_id($mt_data['key_id_text'], $module_id, $mt_data['tbl_text']);
            if (empty($module_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($module_data['status'] != VALUE_TWO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $land_detail_items = $this->input->post('land_detail_items');
            if ((!$land_detail_items || empty($land_detail_items)) && $s_type == VALUE_TWO) {
                echo json_encode(get_error_array(ONE_LD_MESSAGE));
                return false;
            }
            $tld = array();
            $total_copies = 0;
            $total_pages = 0;
            $total_amount = 0;
            if (!empty($land_detail_items)) {
                foreach ($land_detail_items as &$ldi) {
                    $copies = intval($ldi['copies']);
                    $pages = intval($ldi['pages']);
                    $ldi['amount'] = (($copies * $pages) * PER_COPY_PRICE);
                    $total_copies += $copies;
                    $total_pages += $pages;
                    $total_amount += $ldi['amount'];
                    if ($ldi['survey'] != '' || $ldi['survey'] != '') {
                        $tmp_array = array();
                        $tmp_array['survey'] = $ldi['survey'];
                        $tmp_array['subdiv'] = $ldi['subdiv'];
                        if ($module_type == VALUE_SIXTEEN || $module_type == VALUE_NINE) {
                            $tmp_array['mutation_entry_no'] = $ldi['mutation_entry_no'];
                            if ($module_type == VALUE_NINE) {
                                $tmp_array['document_required'] = $ldi['document_required'];
                            }
                        }
                        $tmp_array['copies'] = $copies;
                        $tmp_array['pages'] = $pages;
                        $tmp_array['amount'] = $ldi['amount'];
                        if ($module_type == VALUE_NINE || $module_type == VALUE_FOURTEEN || $module_type == VALUE_FIFTEEN || $module_type == VALUE_SIXTEEN) {
                            $tmp_array['is_na'] = $ldi['is_na'];
                        }
                        array_push($tld, $tmp_array);
                    }
                }
            }
            $sfp_remarks = get_from_post('sfp_remarks');
            $update_data = array();
            if ($s_type == VALUE_TWO) {
                if (!$sfp_remarks) {
                    echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                    return false;
                }
                $update_data['status'] = VALUE_THREE;
                $update_data['sfp_by'] = $session_user_id;
                $update_data['sfp_datetime'] = date('Y-m-d H:i:s');

                // Notes : Insert / Update Fees Bifurcation details
                $dept_fd = $this->utility_model->get_by_id('module_type', $module_type, 'dept_fd', 'district', $module_data['district']);
                if (empty($dept_fd)) {
                    echo json_encode(get_error_array(CONTACT_NIC_MESSAGE));
                    return false;
                }
            }
            $update_data['sfp_remarks'] = $sfp_remarks;
            $update_data['land_details'] = json_encode($tld);
            $update_data['total_copies'] = $total_copies;
            $update_data['total_pages'] = $total_pages;
            $update_data['total_amount'] = $total_amount;
            $this->db->trans_start();
            $this->utility_model->update_data($mt_data['key_id_text'], $module_id, $mt_data['tbl_text'], $update_data);

            if (!empty($land_detail_items)) {
                $this->utility_model->update_data_batch('form_land_details_id', 'form_land_details', $land_detail_items);
            }
            if ($s_type == VALUE_TWO) {
                $this->_update_basic_fb_details($module_type, $module_id, $update_data, $dept_fd, $session_user_id);

                $ex_user_data = array('email' => $module_data['email'], 'user_id' => $session_user_id, 'send_sms' => true);
                $this->utility_lib->send_email_for_fees_pending($ex_user_data, VALUE_THIRTEEN, $module_type, $module_data, $mt_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = $s_type == VALUE_ONE ? PG_DRAFT_MESSAGE : PG_SUBMITTED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _update_basic_fb_details($module_type, $module_id, $m_data, $dept_fd, $session_user_id) {
        $ex_data = $this->utility_model->get_by_id_multiple('module_id', $module_id, 'fees_bifurcation', 'module_type', $module_type, 'dept_fd_id', $dept_fd['dept_fd_id']);
        if (!empty($ex_data)) {
            $update_data = array();
            $update_data['fee'] = $m_data['total_amount'];
            $update_data['updated_by'] = $session_user_id;
            $update_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('fees_bifurcation_id', $ex_data['fees_bifurcation_id'], 'fees_bifurcation', $update_data);
            return false;
        }
        $this->utility_lib->insert_fb_details($session_user_id, $module_type, $module_id, $dept_fd['dept_fd_id'], $dept_fd['description'], $m_data['total_amount']);
    }

    function get_all_payment_history() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        $success_array = array();
        $success_array['payment_history'] = array();
        if ($session_user_id == NULL || !$session_user_id) {
            echo json_encode($success_array);
            return false;
        }
        $session_district = get_from_session('temp_district_for_sugam_admin');
        $columns = $this->input->post('columns');
        $assing_modules = array();
        $search_dept = '';
        if (is_admin()) {
            $search_district = trim($columns[1]['search']['value']);
            $search_dept = trim($columns[2]['search']['value']);
        } else {
            $search_district = $session_district;
            $search_dept = get_from_session('temp_type_for_sugam_admin');
        }
        $search_an = trim($columns[4]['search']['value']);
        $search_prn = trim($columns[7]['search']['value']);
        $search_ps = trim($columns[8]['search']['value']);
        $start = get_from_post('start');
        $length = get_from_post('length');

        $dept_module_array = $this->config->item('dept_module_array');
        if ($search_dept != '') {
            $t_array = array(VALUE_HUNDRED);
            $ta_modules = isset($dept_module_array[$search_dept]) ? $dept_module_array[$search_dept] : $t_array;
            $assing_modules = empty($ta_modules) ? $t_array : $ta_modules;
        }

        $this->load->model('payment_model');
        $this->db->trans_start();
        $success_array['payment_history'] = $this->payment_model->get_all_payment_history($start, $length, $search_district, $assing_modules, $search_ps, $search_prn, $search_an);
        $success_array['recordsTotal'] = $this->payment_model->get_total_count_of_records($search_district, $assing_modules);
        if (($search_district != '' && (is_admin())) || !empty($assing_modules) || $search_ps != '' || $search_prn != '' || $search_an != '') {
            $success_array['recordsFiltered'] = $this->payment_model->get_filter_count_of_records($search_district, $assing_modules, $search_ps, $search_prn, $search_an);
        } else {
            $success_array['recordsFiltered'] = $success_array['recordsTotal'];
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode($success_array);
            return false;
        }
        echo json_encode($success_array);
    }

    function get_oph_data_by_id() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $fees_payment_id = get_from_post('fees_payment_id');
            if ($session_user_id == NULL || !$session_user_id || !$fees_payment_id || $fees_payment_id == NULL) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->load->model('payment_model');
            $this->db->trans_start();
            $fp_data = $this->utility_model->get_by_id('fees_payment_id', $fees_payment_id, 'fees_payment');
            if (empty($fp_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $dv_data = $this->payment_model->get_dv_details($fees_payment_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['fp_data'] = $fp_data;
            $success_array['dv_data'] = $dv_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_head_wise_report_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $t_from_date = get_from_post('from_date_for_hwr');
            $t_to_date = get_from_post('to_date_for_hwr');
            if (!$t_from_date && !$t_to_date) {
                echo json_encode(get_error_array(FROM_TO_DATE_MESSAGE));
                return false;
            }
            $from_date = $t_from_date ? convert_to_mysql_date_format($t_from_date) : '';
            $to_date = $t_to_date ? convert_to_mysql_date_format($t_to_date) : '';

            $assing_modules = array();
            $search_district = '';
            $search_dept = '';
            if (!is_admin()) {
                $search_district = get_from_session('temp_district_for_sugam_admin');
                $search_dept = get_from_session('temp_type_for_sugam_admin');
            }
            $dept_module_array = $this->config->item('dept_module_array');
            if ($search_dept != '') {
                $t_array = array(VALUE_HUNDRED);
                $ta_modules = isset($dept_module_array[$search_dept]) ? $dept_module_array[$search_dept] : $t_array;
                $assing_modules = empty($ta_modules) ? $t_array : $ta_modules;
            }
            $this->load->model('payment_model');
            $this->db->trans_start();
            $t_hwr_details = $this->payment_model->get_hwr_details($search_district, $assing_modules, $from_date, $to_date);
            $dept_fd = generate_array_for_id_object($this->utility_model->get_result_data_or_ids('module_type', $assing_modules, 'dept_fd'), 'dept_fd_id');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return false;
            }
            $mt_array = $this->config->item('query_module_array');
            $district_array = $this->config->item('taluka_array');
            $hwr_array = array();
            foreach ($t_hwr_details as $value) {
                if (!isset($hwr_array[$value['module_type']])) {
                    $hwr_array[$value['module_type']] = array();
                    $hwr_array[$value['module_type']]['module_type'] = $value['module_type'];
                    $hwr_array[$value['module_type']]['department_name'] = isset($mt_array[$value['module_type']]['department_name']) ? $mt_array[$value['module_type']]['department_name'] : '';
                    $hwr_array[$value['module_type']]['service_name'] = isset($mt_array[$value['module_type']]['title']) ? $mt_array[$value['module_type']]['title'] : '';
                    $hwr_array[$value['module_type']]['fp_total'] = VALUE_ZERO;
                    $hwr_array[$value['module_type']]['fb_total'] = VALUE_ZERO;
                    $hwr_array[$value['module_type']]['dwise'] = array();
                }
                if (!isset($hwr_array[$value['module_type']]['dwise'][$value['district']])) {
                    $hwr_array[$value['module_type']]['dwise'][$value['district']]['district'] = $value['district'];
                    $hwr_array[$value['module_type']]['dwise'][$value['district']]['district_name'] = $district_array[$value['district']] ? $district_array[$value['district']] : '';
                    $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'] = array();
                    $hwr_array[$value['module_type']]['fp_total'] += $value['fp_total_fees'];
                }

                if (isset($dept_fd[$value['dept_fd_id']])) {
                    $t_fd = $dept_fd[$value['dept_fd_id']];
                    $full_head = $t_fd['full_head'];
                    if (!isset($hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head])) {
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head] = array();
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['dept_fd_id'] = $value['dept_fd_id'];
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['hw_total_fees'] = VALUE_ZERO;
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['pao_code'] = isset($t_fd['pao_code']) ? $t_fd['pao_code'] : '';
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['ddo_code'] = isset($t_fd['ddo_code']) ? $t_fd['ddo_code'] : '';
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['grant_number'] = isset($t_fd['grant_number']) ? $t_fd['grant_number'] : '';
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['major_head'] = isset($t_fd['major_head']) ? $t_fd['major_head'] : '';
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['sub_major_head'] = isset($t_fd['sub_major_head']) ? $t_fd['sub_major_head'] : '';
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['minor_head'] = isset($t_fd['minor_head']) ? $t_fd['minor_head'] : '';
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['sub_head'] = isset($t_fd['sub_head']) ? $t_fd['sub_head'] : '';
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['detailed_head'] = isset($t_fd['detailed_head']) ? $t_fd['detailed_head'] : '';
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['object'] = isset($t_fd['object']) ? $t_fd['object'] : '';
                        $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['category'] = isset($t_fd['category']) ? $t_fd['category'] : '';
                    }
                    $hwr_array[$value['module_type']]['dwise'][$value['district']]['head_wise'][$full_head]['hw_total_fees'] += $value['fb_total_fees'];
                }
            }
            $success_array = get_success_array();
            $success_array['hwr_data'] = $hwr_array;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_module_district_hwr_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            $mt_array = $this->config->item('query_module_array');
            if (!isset($mt_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $district = get_from_post('district');
            if ($district != VALUE_ONE && $district != VALUE_TWO && $district != VALUE_THREE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $full_head = get_from_post('full_head');
            if (!$full_head) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $t_from_date = get_from_post('from_date');
            $t_to_date = get_from_post('to_date');
            if (!$t_from_date && !$t_to_date) {
                echo json_encode(get_error_array(FROM_TO_DATE_MESSAGE));
                return false;
            }
            $from_date = $t_from_date ? convert_to_mysql_date_format($t_from_date) : '';
            $to_date = $t_to_date ? convert_to_mysql_date_format($t_to_date) : '';
            $search_district = '';
            $search_dept = '';
            if (is_admin()) {
                $search_district = $district;
            } else {
                $search_district = get_from_session('temp_district_for_sugam_admin');
                $search_dept = get_from_session('temp_type_for_sugam_admin');
            }
            $this->load->model('payment_model');
            $this->db->trans_start();
            $md_hwr_data = $this->payment_model->get_md_hwr_details($module_type, $search_district, $full_head, $from_date, $to_date);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['md_hwr_data'] = $md_hwr_data;
            $success_array['mt_data'] = $mt_array[$module_type];
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_copy() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        if (!is_post() || $session_user_id == NULL || !$session_user_id) {
            $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        $form_copy_id = get_from_post('form_copy_id_forcd');
        if (!$form_copy_id) {
            $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        $vd_type = get_from_post('vd_type_forcd');
        if ($vd_type != VALUE_ONE && $vd_type != VALUE_TWO) {
            $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        $form_copy_data = $this->utility_model->get_by_id('form_copy_id', $form_copy_id, 'form_copy');
        if (empty($form_copy_data)) {
            $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
            return false;
        }
        if (!$form_copy_data['form_nakal']) {
            $this->load->view('error', array('error_message' => COPY_NOT_GENERATED_MESSAGE));
            return false;
        }
        header('Content-type: application/pdf');
        header("Content-Transfer-Encoding: base64");
        if ($vd_type == VALUE_ONE) {
            header('Content-Disposition: inline; filename="' . $form_copy_data['reference_number'] . '-' . time() . '.pdf"');
        } else {
            header('Content-Disposition: attachment; filename="' . $form_copy_data['reference_number'] . '-' . time() . '.pdf"');
        }
        $binary = base64_decode($form_copy_data['form_nakal']);
        print_r($binary);
    }

    function submit_fee_details() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $module_id = get_from_post('module_id_for_pfd');
            $payment_type = get_from_post('payment_type_for_pfd');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $module_id == NULL || !$module_id ||
                    $payment_type == NULL || !$payment_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type_for_pfd');
            if (!$module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_array = $this->config->item('query_module_array');
            if (!isset($mt_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_data = $mt_array[$module_type];
            if (empty($mt_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_data = $this->utility_model->get_by_id($mt_data['key_id_text'], $module_id, $mt_data['tbl_text']);
            if (empty($module_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($module_data['status'] != VALUE_THREE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $pay_data = array();
            $pay_data['status'] = VALUE_THREE;
            $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($session_user_id, $module_data['user_id'], $module_type, $module_id, $module_data['application_number'], $module_data['district'], $module_data['total_amount'], $pay_data);
            if ($enc_pg_data['success'] == false) {
                echo json_encode(get_error_array($enc_pg_data['message']));
                return;
            }
            $pay_data['payment_type'] = $payment_type;
            $pay_data['updated_by'] = $session_user_id;
            $pay_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data($mt_data['key_id_text'], $module_id, $mt_data['tbl_text'], $pay_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['status'] = isset($pay_data['status']) ? $pay_data['status'] : $module_data['status'];
            $success_array['payment_type'] = $pay_data['payment_type'];
            if ($success_array['payment_type'] == VALUE_ONE) {
                $success_array['op_mmptd'] = $enc_pg_data['op_mmptd'];
                $success_array['op_enct'] = $enc_pg_data['op_enct'];
                $success_array['op_mt'] = $enc_pg_data['op_mt'];
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_fp_mail_history() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id_for_fp');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type_for_fp');
            if (!$module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_array = $this->config->item('query_module_array');
            if (!isset($mt_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_data = $mt_array[$module_type];
            if (empty($mt_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $t_module_data = $this->utility_model->get_by_id($mt_data['key_id_text'], $module_id, $mt_data['tbl_text']);
            if (empty($t_module_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $mail_history_data = $this->utility_model->get_result_data_by_id_multiple('module_id', $module_id, 'logs_email', 'module_type', $module_type, 'email_type', VALUE_THIRTEEN);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $module_data = array();
            $module_data['module_id'] = $module_id;
            $module_data['module_type'] = $module_type;
            $module_data['application_number'] = $t_module_data['application_number'];
            $module_data['status'] = $t_module_data['status'];

            $success_array = get_success_array();
            $success_array['mail_history_data'] = $mail_history_data;
            $success_array['module_data'] = $module_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function send_fp_email() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id_for_fpmh');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type_for_fpmh');
            if (!$module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_array = $this->config->item('query_module_array');
            if (!isset($mt_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $mt_data = $mt_array[$module_type];
            if (empty($mt_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $t_module_data = $this->utility_model->get_by_id($mt_data['key_id_text'], $module_id, $mt_data['tbl_text']);
            if (empty($t_module_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $user_data = $this->utility_model->get_by_id('user_id', $t_module_data['user_id'], 'users');
            if (empty($user_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $ex_user_data = array('email' => $t_module_data['email'], 'user_id' => $session_user_id, 'send_sms' => true);
            $this->utility_lib->send_email_for_fees_pending($ex_user_data, VALUE_THIRTEEN, $module_type, $t_module_data, $mt_data);
            if ($t_module_data['email'] != $user_data['email']) {
                $ex_user_data = array('email' => $user_data['email'], 'user_id' => $session_user_id);
                $this->utility_lib->send_email_for_fees_pending($ex_user_data, VALUE_THIRTEEN, $module_type, $t_module_data, $mt_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = FEES_PENDING_EMAIL_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_duplicate_details_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            if (!is_authenticated()) {
                echo json_encode(get_logout_array());
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type = get_from_post('module_type');
            if (!$module_type) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_type_array = $this->config->item('query_module_array');
            if (!isset($module_type_array[$module_type])) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $temp_access_data = $module_type_array[$module_type];
            if (empty($temp_access_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $module_id = get_from_post('module_id');
            if (!$module_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $this->db->trans_start();
            $ex_data = $this->utility_model->get_by_id($temp_access_data['key_id_text'], $module_id, $temp_access_data['tbl_text']);
            if (empty($ex_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            if ($module_type == VALUE_ONE) {
                $module_data = $this->utility_model->get_duplicate_details_by_id($module_id, 'name_of_applicant', $ex_data['name_of_applicant'], $temp_access_data['tbl_text'], 'mobile_number', $ex_data['mobile_number'], 'aadhaar', $ex_data['aadhaar'], $temp_access_data['key_id_text'], 'ASC');
            } elseif ($module_type == VALUE_FOUR || $module_type == VALUE_FIVE || $module_type == VALUE_SIX || $module_type == VALUE_SEVEN) {
                $module_data = $this->utility_model->get_duplicate_details_by_id($module_id, 'applicant_name', $ex_data['applicant_name'], $temp_access_data['tbl_text'], 'mobile_number', $ex_data['mobile_number'], 'aadhaar', $ex_data['aadhaar'], $temp_access_data['key_id_text'], 'ASC');
            } else {
                $module_data = $this->utility_model->get_duplicate_details_by_id($module_id, 'applicant_name', $ex_data['applicant_name'], $temp_access_data['tbl_text'], 'mobile_number', $ex_data['mobile_number'], 'aadhar_number', $ex_data['aadhar_number'], $temp_access_data['key_id_text'], 'ASC');
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['applicant_data'] = $ex_data;
            $success_array['module_data'] = $module_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
     * EOF: ./application/controller/Utility.php
     */    