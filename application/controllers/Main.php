<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
    }

    public function index() {
        $t_district = isset($_GET['d']) ? get_decrypt_id($_GET['d']) : '';
        $t_mt = isset($_GET['mt']) ? get_decrypt_id($_GET['mt']) : '';
        $t_ms = isset($_GET['ms']) ? get_decrypt_id($_GET['ms']) : '';
        $t_mi = isset($_GET['mi']) ? get_decrypt_id($_GET['mi']) : '';
        $query_module_array = $this->config->item('query_module_array');
        $temp_array = array();
        if (($t_district == TALUKA_DAMAN || $t_district == TALUKA_DIU || $t_district == TALUKA_DNH) &&
                isset($query_module_array[$t_mt]) && ($t_ms == VALUE_THREE || $t_ms == VALUE_FOUR) && ($t_mi != '' && $t_mi != 0)) {
            $temp_array['t_district'] = $t_district;
            $temp_array['t_mt'] = $t_mt;
            $temp_array['t_ms'] = $t_ms;
            $temp_array['t_mi'] = $t_mi;
        }
        $this->load->view('common/header', $temp_array);
        $this->load->view('main/main');
        $this->load->view('common/footer');
        $this->load->view('common/backbone_footer');
    }

    function page_not_found() {
        $this->load->view('404');
    }

    function _get_common_array_for_mam_office(&$success_array) {
        if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user()) {
            $success_array['total_cases'] = 0;
            $success_array['pending_cases'] = 0;
            $success_array['close_cases'] = 0;
            $success_array['today_hearing_cases'] = 0;
            $success_array['this_month_hearing_cases'] = 0;
            $success_array['next_month_hearing_cases'] = 0;
            $success_array['pass_cases'] = 0;
        }
        if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user() || is_aci_user() || is_ldc_user()) {
            $success_array['mam_certificate_details'] = array();
            $success_array['ga_status_details'] = array();
        }
        if (is_admin() || is_talathi_user() || is_aci_user() || is_mamlatdar_user() || is_mam_view_user() || is_eocs_fs_user() || is_eocs_hs_user() || is_eocs_head() || is_eocs_jfs_user()) {
            $success_array['fees_status_details'] = array();
        }
    }

    function _get_common_array_for_subr_office(&$success_array) {
        if (is_admin() || is_subr_user() || is_subr_ver_user()) {
            $success_array['total_application_submitted'] = 0;
            $success_array['total_doc_verify_appointment_pending'] = 0;
            $success_array['total_doc_verify_appointment_scheduled'] = 0;
            $success_array['total_document_register'] = 0;
            $success_array['total_rejected'] = 0;
            $success_array['total_doc_verify_appointment_approval_pending'] = 0;
            $success_array['todays_appointment'] = 0;
            $success_array['total_queried'] = 0;
            $success_array['total_response_received'] = 0;

//            $success_array['crsr_certificate_details'] = array();
        }
    }

    function _get_count_for_subr_office($session_user_id, $search_district, &$success_array) {
        if (is_admin() || is_subr_user() || is_subr_ver_user()) {
            $document_registration_status_wise_data = $this->dashboard_model->get_document_registration_dashboard_data($search_district);
            if (!empty($document_registration_status_wise_data)) {
                foreach ($document_registration_status_wise_data as $docregistartion) {
                    if ($docregistartion['status'] == VALUE_TWO) {
                        $success_array['total_application_submitted'] += $docregistartion['total_records'];
                    }
                    if ($docregistartion['status'] == VALUE_THREE) {
                        $success_array['total_doc_verify_appointment_pending'] += $docregistartion['total_records'];
                    }
                    if ($docregistartion['status'] == VALUE_FOUR) {
                        $success_array['total_doc_verify_appointment_scheduled'] += $docregistartion['total_records'];
                    }
                    if ($docregistartion['status'] == VALUE_FIVE) {
                        $success_array['total_document_register'] += $docregistartion['total_records'];
                    }
                    if ($docregistartion['status'] == VALUE_SIX) {
                        $success_array['total_rejected'] += $docregistartion['total_records'];
                    }
                    if ($docregistartion['status'] == VALUE_EIGHT) {
                        $success_array['total_doc_verify_appointment_approval_pending'] += $docregistartion['total_records'];
                    }
                    if ($docregistartion['appointment_date'] == date('Y-m-d')) {
                        $success_array['todays_appointment'] += $docregistartion['total_records'];
                    }
                    if ($docregistartion['query_status'] == VALUE_ONE) {
                        $success_array['total_queried'] += $docregistartion['total_records'];
                    }
                    if ($docregistartion['query_status'] == VALUE_TWO) {
                        $success_array['total_response_received'] += $docregistartion['total_records'];
                    }
                }
            }

//            $qm_array = $this->config->item('query_module_array');
//            $this->_d_wise_crsr_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_EIGHTEEN);
//            $this->_d_wise_crsr_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_NINETEEN);
//            $this->_d_wise_crsr_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_TWENTY);
        }
    }

    function _get_count_for_mam_office($session_user_id, $search_district, &$success_array) {
        if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user()) {
            $dapvr_status_wise_data = $this->dashboard_model->get_dapvr_dashboard_data($search_district);
            if (!empty($dapvr_status_wise_data)) {
                foreach ($dapvr_status_wise_data as $dapvr) {
                    if ($dapvr['status'] == VALUE_FOUR && $dapvr['order_doc'] == VALUE_ZERO) {
                        $success_array['close_cases'] += $dapvr['total_cases'];
                    }
                    if ($dapvr['status'] == VALUE_ZERO || $dapvr['status'] == VALUE_ONE ||
                            $dapvr['status'] == VALUE_TWO || $dapvr['status'] == VALUE_THREE) {
                        $success_array['pending_cases'] += $dapvr['total_cases'];
                    }
                    if ($dapvr['status'] == VALUE_THREE && $dapvr['next_hearing_date'] == date('Y-m-d')) {
                        $success_array['today_hearing_cases'] += $dapvr['total_cases'];
                    }
                    $hearing_date_obj = date('mY', strtotime($dapvr['next_hearing_date']));
                    if ($dapvr['status'] == VALUE_THREE && $hearing_date_obj == date('mY')) {
                        $success_array['this_month_hearing_cases'] += $dapvr['total_cases'];
                    }
                    if ($dapvr['status'] == VALUE_THREE && $hearing_date_obj == date('mY', strtotime('+1 month'))) {
                        $success_array['next_month_hearing_cases'] += $dapvr['total_cases'];
                    }
                    if ($dapvr['status'] == VALUE_FIVE && $dapvr['order_doc'] == VALUE_ONE) {
                        $success_array['pass_cases'] += $dapvr['total_cases'];
                    }
                    $success_array['total_cases'] += $dapvr['total_cases'];
                }
            }
        }

        if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user() || is_aci_user() || is_ldc_user()) {
            $qm_array = $this->config->item('query_module_array');
            $this->_d_wise_mamo_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_ONE);
            $this->_d_wise_mamo_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_TWO);
            $this->_d_wise_mamo_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_THREE);
            $this->_d_wise_mamo_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_FOUR);
            $this->_d_wise_mamo_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_FIVE);
            $this->_d_wise_mamo_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_SIX);
            $this->_d_wise_mamo_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_SEVEN);
            $this->_d_wise_ga_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_THIRTY);
        }
        if (is_admin() || is_talathi_user() || is_aci_user() || is_mamlatdar_user() || is_mam_view_user()) {
            $this->_d_wise_mamo_forms_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_THIRTEEN);
            $this->_d_wise_mamo_forms_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_FOURTEEN);
            $this->_d_wise_mamo_forms_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_FIFTEEN);
            $this->_d_wise_mamo_forms_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_SIXTEEN);
            $this->_d_wise_mamo_forms_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_NINE);
        }
        if (is_admin() || is_eocs_head() || is_eocs_fs_user() || is_eocs_hs_user() || is_eocs_jfs_user()) {
            if (is_eocs_fs_user() || is_eocs_hs_user() || is_eocs_head() || is_eocs_jfs_user()) {
                $qm_array = $this->config->item('query_module_array');
            }
            $this->_d_wise_mamo_forms_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_TWENTYTHREE);
            $this->_d_wise_mamo_forms_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_TWENTYFIVE);
            $this->_d_wise_mamo_forms_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_TWENTYFOUR);
//            $this->_d_wise_mamo_forms_array($session_user_id, $search_district, $success_array, $qm_array, VALUE_TWENTYTWO);
        }
    }

    function _get_common_type_wise_mamo_array() {
        $bd_mamo_array = array();
        $bd_mamo_array['total_app'] = 0;
        $bd_mamo_array['new_app'] = 0;
        $bd_mamo_array['queried_app'] = 0;
        $bd_mamo_array['response_received_app'] = 0;
        $bd_mamo_array['app_scheduled_app'] = 0;
        if (is_talathi_user() || (is_aci_user() || is_ldc_user())) {
            $bd_mamo_array['forwarded_app'] = 0;
        }
        $bd_mamo_array['reverification_app'] = 0;
        $bd_mamo_array['new_reverification_app'] = 0;
        $bd_mamo_array['forwarded_reverification_app'] = 0;
        $bd_mamo_array['received_reverification_app'] = 0;
        $bd_mamo_array['approved_app'] = 0;
        $bd_mamo_array['rejected_app'] = 0;
        return $bd_mamo_array;
    }

    function _d_wise_mamo_array($session_user_id, $search_district, &$success_array, $qm_array, $module_type) {
        $mamo_array = array();
        $mamo_array[VALUE_ZERO] = $this->_get_common_type_wise_mamo_array();
        $mamo_array[TALUKA_DAMAN] = $this->_get_common_type_wise_mamo_array();
        $mamo_array[TALUKA_DIU] = $this->_get_common_type_wise_mamo_array();
        $mamo_array[TALUKA_DNH] = $this->_get_common_type_wise_mamo_array();
        $mamo_array['module_type'] = $module_type;
        $ta_data = isset($qm_array[$module_type]) ? $qm_array[$module_type] : array();
        if (empty($ta_data)) {
            array_push($success_array['mam_certificate_details'], $mamo_array);
            return;
        }
        $mamo_array['service_name'] = $ta_data['title'];
        $m_data = $this->dashboard_model->get_cert_count_for_dashboard($session_user_id, $search_district, $ta_data['key_id_text'], $ta_data['tbl_text'], $ta_data['village_field'], $module_type);
        foreach ($m_data as $t_array) {
            if ($t_array['district'] != VALUE_ZERO) {
                if ($t_array['status'] == VALUE_FIVE) {
                    $mamo_array[$t_array['district']]['approved_app'] += $t_array['total_app'];
                } else if ($t_array['status'] == VALUE_SIX) {
                    $mamo_array[$t_array['district']]['rejected_app'] += $t_array['total_app'];
                } else {
                    if ($t_array['query_status'] == VALUE_ONE) {
                        $mamo_array[$t_array['district']]['queried_app'] += $t_array['total_app'];
                    } else if ($t_array['query_status'] == VALUE_TWO) {
                        $mamo_array[$t_array['district']]['response_received_app'] += $t_array['total_app'];
                    } else {

                        if (is_talathi_user()) {
                            if (($t_array['talathi'] != VALUE_ZERO && $t_array['talathi_to_aci'] != VALUE_ZERO) &&
                                    ($t_array['to_type_reverify'] == VALUE_ZERO || $t_array['to_type_reverify'] == VALUE_TWO) && $t_array['talathi_to_type_reverify'] == VALUE_ZERO) {
                                $mamo_array[$t_array['district']]['forwarded_app'] += $t_array['total_app'];
                            } else {
                                $this->_rev_new_app_schedule($t_array, $mamo_array);
                            }
                        } else if (is_aci_user()) {
                            if (((($t_array['aci_rec'] == VALUE_TWO && $t_array['aci_to_mamlatdar'] != VALUE_ZERO) ||
                                    ($t_array['aci_rec'] == VALUE_ONE && $t_array['aci_to_ldc'] != VALUE_ZERO) ||
                                    ($t_array['aci_rec'] == VALUE_THREE && $t_array['aci_to_m_ldc'] != VALUE_ZERO)) &&
                                    ($t_array['to_type_reverify'] == VALUE_ZERO || $t_array['to_type_reverify'] == VALUE_ONE) &&
                                    ($t_array['talathi_to_type_reverify'] == VALUE_ZERO || $t_array['talathi_to_type_reverify'] == VALUE_TWO))) {
                                $mamo_array[$t_array['district']]['forwarded_app'] += $t_array['total_app'];
                            } else {
                                $this->_rev_new_app_schedule($t_array, $mamo_array);
                            }
                        } else if (is_ldc_user()) {
                            if ($t_array['ldc_to_mamlatdar'] != VALUE_ZERO && $t_array['to_type_reverify'] == VALUE_ZERO) {
                                $mamo_array[$t_array['district']]['forwarded_app'] += $t_array['total_app'];
                            } else {
                                $this->_rev_new_app_schedule($t_array, $mamo_array);
                            }
                        } else {
                            $this->_rev_new_app_schedule($t_array, $mamo_array);
                        }
                    }
                }
                $mamo_array[$t_array['district']]['total_app'] += $t_array['total_app'];
            }
        }
        array_push($success_array['mam_certificate_details'], $mamo_array);
    }

    function _rev_new_app_schedule($t_array, &$mamo_array) {
        if ($t_array['status'] == VALUE_THREE) {
            if (is_talathi_user()) {
                if ($t_array['to_type_reverify'] == VALUE_ONE && $t_array['talathi_to_type_reverify'] == VALUE_ZERO) {
                    $mamo_array[$t_array['district']]['new_reverification_app'] += $t_array['total_app'];
                } else if ($t_array['talathi_to_type_reverify'] == VALUE_ONE || $t_array['talathi_to_type_reverify'] == VALUE_TWO) {
                    $mamo_array[$t_array['district']]['forwarded_reverification_app'] += $t_array['total_app'];
                }
            } else if (is_aci_user()) {
                if ((($t_array['to_type_reverify'] == VALUE_TWO) || ($t_array['to_type_reverify'] == VALUE_ONE && $t_array['talathi_to_type_reverify'] == VALUE_ONE)) && ($t_array['aci_rec_reverify'] == VALUE_ZERO)) {
                    $mamo_array[$t_array['district']]['new_reverification_app'] += $t_array['total_app'];
                } else if (($t_array['aci_rec_reverify'] == VALUE_ONE || $t_array['aci_rec_reverify'] == VALUE_TWO || $t_array['aci_rec_reverify'] == VALUE_THREE) && ($t_array['talathi_to_type_reverify'] == VALUE_ZERO || $t_array['talathi_to_type_reverify'] == VALUE_ONE)) {
                    $mamo_array[$t_array['district']]['forwarded_reverification_app'] += $t_array['total_app'];
                }
            } else if (is_ldc_user()) {
                if (($t_array['aci_to_ldc'] != VALUE_ZERO && $t_array['aci_rec_reverify'] == VALUE_ONE) &&
                        ($t_array['to_type_reverify'] == VALUE_ONE || $t_array['to_type_reverify'] == VALUE_TWO) &&
                        $t_array['ldc_to_mamlatdar'] == VALUE_ZERO) {
                    $mamo_array[$t_array['district']]['new_reverification_app'] += $t_array['total_app'];
                } else if ($t_array['ldc_to_mamlatdar'] != VALUE_ZERO && ($t_array['to_type_reverify'] == VALUE_ONE || $t_array['to_type_reverify'] == VALUE_TWO)) {
                    $mamo_array[$t_array['district']]['forwarded_reverification_app'] += $t_array['total_app'];
                }
            } else if (is_mamlatdar_user()) {
                if ($t_array['to_type_reverify'] == VALUE_ONE || $t_array['to_type_reverify'] == VALUE_TWO) {
                    if ($t_array['talathi_to_type_reverify'] == VALUE_TWO || $t_array['aci_rec_reverify'] == VALUE_TWO ||
                            (($t_array['aci_rec_reverify'] == VALUE_ONE || $t_array['aci_rec_reverify'] == VALUE_THREE) && $t_array['ldc_to_mamlatdar'] != VALUE_ZERO)) {
                        $mamo_array[$t_array['district']]['received_reverification_app'] += $t_array['total_app'];
                    } else if ((($t_array['talathi_to_type_reverify'] == VALUE_ZERO || $t_array['talathi_to_type_reverify'] == VALUE_ONE) && $t_array['aci_rec_reverify'] == VALUE_ZERO)) {
                        $mamo_array[$t_array['district']]['forwarded_reverification_app'] += $t_array['total_app'];
                    }
                }
            } else {
                $mamo_array[$t_array['district']]['reverification_app'] += $t_array['total_app'];
            }
        } else {
            if ((is_admin() || is_talathi_user()) && $t_array['appointment_status'] == VALUE_ONE) {
                $mamo_array[$t_array['district']]['app_scheduled_app'] += $t_array['total_app'];
            } else {
                $mamo_array[$t_array['district']]['new_app'] += $t_array['total_app'];
            }
        }
    }

    function _get_common_type_wise_mamo_forms_array() {
        $bd_mamo_forms_array = array();
        $bd_mamo_forms_array['total_app'] = 0;
        $bd_mamo_forms_array['submitted_app'] = 0;
        $bd_mamo_forms_array['queried_app'] = 0;
        $bd_mamo_forms_array['response_received_app'] = 0;
        $bd_mamo_forms_array['fees_paid'] = 0;
        $bd_mamo_forms_array['fees_paid_generated'] = 0;
        $bd_mamo_forms_array['fees_paid_prepared'] = 0;
        $bd_mamo_forms_array['fees_paid_checked'] = 0;
        $bd_mamo_forms_array['fees_pending'] = 0;
        $bd_mamo_forms_array['approved_app'] = 0;
        $bd_mamo_forms_array['rejected_app'] = 0;
        return $bd_mamo_forms_array;
    }

    function _d_wise_mamo_forms_array($session_user_id, $search_district, &$success_array, $qm_array, $module_type) {
        $mamo_forms_array = array();
        $mamo_forms_array[VALUE_ZERO] = $this->_get_common_type_wise_mamo_forms_array();
        $mamo_forms_array[TALUKA_DAMAN] = $this->_get_common_type_wise_mamo_forms_array();
        $mamo_forms_array[TALUKA_DIU] = $this->_get_common_type_wise_mamo_forms_array();
        $mamo_forms_array[TALUKA_DNH] = $this->_get_common_type_wise_mamo_forms_array();
        $mamo_forms_array['module_type'] = $module_type;
        $ta_data = isset($qm_array[$module_type]) ? $qm_array[$module_type] : array();
        if (empty($ta_data)) {
            array_push($success_array['fees_status_details'], $mamo_forms_array);
            return;
        }
        $mamo_forms_array['service_name'] = $ta_data['title'];
        $m_data = $this->dashboard_model->get_fees_status_count_for_dashboard($session_user_id, $search_district, $ta_data['key_id_text'], $ta_data['tbl_text'], $ta_data['village_field'], $module_type);
        foreach ($m_data as $t_array) {
            if ($t_array['district'] != VALUE_ZERO) {
                if ($t_array['status'] == VALUE_FIVE) {
                    $mamo_forms_array[$t_array['district']]['approved_app'] += $t_array['total_app'];
                } else if ($t_array['status'] == VALUE_SIX) {
                    $mamo_forms_array[$t_array['district']]['rejected_app'] += $t_array['total_app'];
                } else {
                    if (isset($t_array['query_status'])) {
                        if ($t_array['query_status'] == VALUE_ONE) {
                            $mamo_forms_array[$t_array['district']]['queried_app'] += $t_array['total_app'];
                        } else if ($t_array['query_status'] == VALUE_TWO) {
                            $mamo_forms_array[$t_array['district']]['response_received_app'] += $t_array['total_app'];
                        } else {
                            $this->_get_sfp_app($t_array, $mamo_forms_array, $module_type);
                        }
                    } else {
                        $this->_get_sfp_app($t_array, $mamo_forms_array, $module_type);
                    }
                }
                $mamo_forms_array[$t_array['district']]['total_app'] += $t_array['total_app'];
            }
        }
        array_push($success_array['fees_status_details'], $mamo_forms_array);
    }

    function _get_common_type_wise_ga_array() {
        $bd_mamo_forms_array = array();
        $bd_mamo_forms_array['total_app'] = 0;
        $bd_mamo_forms_array['new_app'] = 0;
        $bd_mamo_forms_array['queried_app'] = 0;
        $bd_mamo_forms_array['response_received_app'] = 0;
        $bd_mamo_forms_array['forwarded_app'] = 0;
        $bd_mamo_forms_array['approved_app'] = 0;
        $bd_mamo_forms_array['rejected_app'] = 0;
        return $bd_mamo_forms_array;
    }

    function _d_wise_ga_array($session_user_id, $search_district, &$success_array, $qm_array, $module_type) {
        $ga_array = array();
        $ga_array[VALUE_ZERO] = $this->_get_common_type_wise_ga_array();
        $ga_array[TALUKA_DAMAN] = $this->_get_common_type_wise_ga_array();
        $ga_array[TALUKA_DIU] = $this->_get_common_type_wise_ga_array();
        $ga_array[TALUKA_DNH] = $this->_get_common_type_wise_ga_array();
        $ga_array['module_type'] = $module_type;
        $ta_data = isset($qm_array[$module_type]) ? $qm_array[$module_type] : array();
        if (empty($ta_data)) {
            $success_array['ga_status_details'] = $ga_array;
            return false;
        }
        $ga_array['service_name'] = $ta_data['title'];
        $m_data = $this->dashboard_model->get_general_application_status_count_for_dashboard($session_user_id, $search_district, $ta_data['key_id_text'], $ta_data['tbl_text'], $ta_data['village_field'], $module_type);
        foreach ($m_data as $t_array) {
            if ($t_array['district'] != VALUE_ZERO) {
                if ($t_array['status'] == VALUE_FIVE) {
                    $ga_array[$t_array['district']]['approved_app'] += $t_array['total_app'];
                } else if ($t_array['status'] == VALUE_SIX) {
                    $ga_array[$t_array['district']]['rejected_app'] += $t_array['total_app'];
                } else {
                    if (isset($t_array['query_status'])) {
                        if ($t_array['query_status'] == VALUE_ONE) {
                            $ga_array[$t_array['district']]['queried_app'] += $t_array['total_app'];
                        } else if ($t_array['query_status'] == VALUE_TWO) {
                            $ga_array[$t_array['district']]['response_received_app'] += $t_array['total_app'];
                        } else {
                            $this->_get_nfga_app($t_array, $ga_array, $module_type);
                        }
                    } else {
                        $this->_get_nfga_app($t_array, $ga_array, $module_type);
                    }
                }
                $ga_array[$t_array['district']]['total_app'] += $t_array['total_app'];
            }
        }
        $success_array['ga_status_details'] = $ga_array;
    }

    function _get_nfga_app($t_array, &$ga_array) {
        $ga_array[$t_array['district']]['new_app'] += $t_array['new_app'];
        $ga_array[$t_array['district']]['forwarded_app'] += $t_array['forwarded_app'];
    }

//    function _get_common_type_wise_crsr_array() {
//        $bd_crsr_array = array();
//        $bd_crsr_array['total_app'] = 0;
//        //$bd_crsr_array['new_app'] = 0;
//        $bd_crsr_array['queried_app'] = 0;
//        $bd_crsr_array['response_received_app'] = 0;
//        $bd_crsr_array['approved_app'] = 0;
//        $bd_crsr_array['rejected_app'] = 0;
//        return $bd_crsr_array;
//    }
//
//    function _d_wise_crsr_array($session_user_id, $search_district, &$success_array, $qm_array, $module_type) {
//        $crsr_array = array();
//        $crsr_array[VALUE_ZERO] = $this->_get_common_type_wise_crsr_array();
//        $crsr_array[TALUKA_DAMAN] = $this->_get_common_type_wise_crsr_array();
//        $crsr_array[TALUKA_DIU] = $this->_get_common_type_wise_crsr_array();
//        $crsr_array[TALUKA_DNH] = $this->_get_common_type_wise_crsr_array();
//        $crsr_array['module_type'] = $module_type;
//        $ta_data = isset($qm_array[$module_type]) ? $qm_array[$module_type] : array();
//        if (empty($ta_data)) {
//            array_push($success_array['crsr_certificate_details'], $crsr_array);
//            return;
//        }
//        $crsr_array['service_name'] = $ta_data['title'];
//        $m_data = $this->dashboard_model->get_crsr_cert_count_for_dashboard($session_user_id, $search_district, $ta_data['key_id_text'], $ta_data['tbl_text']);
//        foreach ($m_data as $t_array) {
//            if ($t_array['district'] != VALUE_ZERO) {
//                if ($t_array['status'] == VALUE_FIVE) {
//                    $crsr_array[$t_array['district']]['approved_app'] += $t_array['total_app'];
//                } else if ($t_array['status'] == VALUE_SIX) {
//                    $crsr_array[$t_array['district']]['rejected_app'] += $t_array['total_app'];
//                } else {
//                    if ($t_array['query_status'] == VALUE_ONE) {
//                        $crsr_array[$t_array['district']]['queried_app'] += $t_array['total_app'];
//                    } else if ($t_array['query_status'] == VALUE_TWO) {
//                        $crsr_array[$t_array['district']]['response_received_app'] += $t_array['total_app'];
//                    }
//                }
//                $crsr_array[$t_array['district']]['total_app'] += $t_array['total_app'];
//            }
//        }
//        array_push($success_array['crsr_certificate_details'], $crsr_array);
//    }

    function _get_sfp_app($t_array, &$mamo_forms_array, $module_type) {
        if ($t_array['status'] == VALUE_TWO) {
//            if ($module_type == VALUE_TWENTYTWO) {
//                if ($t_array['plan_status'] == VALUE_ONE) {
//                    $mamo_forms_array[$t_array['district']]['fees_paid'] += $t_array['total_app'];
//                } else if ($t_array['plan_status'] == VALUE_TWO) {
//                    $mamo_forms_array[$t_array['district']]['fees_paid_generated'] += $t_array['total_app'];
//                } else if ($t_array['plan_status'] == VALUE_THREE) {
//                    $mamo_forms_array[$t_array['district']]['fees_paid_prepared'] += $t_array['total_app'];
//                } else if ($t_array['plan_status'] == VALUE_FOUR) {
//                    $mamo_forms_array[$t_array['district']]['fees_paid_checked'] += $t_array['total_app'];
//                } else {
//                    $mamo_forms_array[$t_array['district']]['submitted_app'] += $t_array['total_app'];
//                }
//            } else {
            $mamo_forms_array[$t_array['district']]['submitted_app'] += $t_array['total_app'];
//            }
        } else if ($t_array['status'] == VALUE_THREE) {
            $mamo_forms_array[$t_array['district']]['fees_pending'] += $t_array['total_app'];
        } else if ($t_array['status'] == VALUE_FOUR) {
            if (isset($t_array['plan_status'])) {
                if ($t_array['plan_status'] == VALUE_TWO) {
                    $mamo_forms_array[$t_array['district']]['fees_paid_generated'] += $t_array['total_app'];
                } else if ($t_array['plan_status'] == VALUE_THREE) {
                    $mamo_forms_array[$t_array['district']]['fees_paid_prepared'] += $t_array['total_app'];
                } else if ($t_array['plan_status'] == VALUE_FOUR) {
                    $mamo_forms_array[$t_array['district']]['fees_paid_checked'] += $t_array['total_app'];
                } else {
                    $mamo_forms_array[$t_array['district']]['fees_paid'] += $t_array['total_app'];
                }
            } else {
                $mamo_forms_array[$t_array['district']]['fees_paid'] += $t_array['total_app'];
            }
        }
    }

    function get_dashboard_data() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        $session_district = get_from_session('temp_district_for_sugam_admin');
        $success_array = get_success_array();
        $search_district = is_admin() ? '' : $session_district;
        $this->_get_common_array_for_mam_office($success_array);
        $this->_get_common_array_for_subr_office($success_array);
        $this->load->model('dashboard_model');
        $this->db->trans_start();
        $this->_get_count_for_mam_office($session_user_id, $search_district, $success_array);
        $this->_get_count_for_subr_office($session_user_id, $search_district, $success_array);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode($success_array);
            return;
        }
        echo json_encode($success_array);
    }

}

/*
 * EOF: ./application/controller/Main.php
 */