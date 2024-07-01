<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utility_lib {

    var $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('utility_model');
    }

    function login_log($user_id) {
        $logs_data = array();
        $logs_data['sa_user_id'] = $user_id;
        $logs_data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $logs_data['login_timestamp'] = time();
        $logs_data['logs_data'] = json_encode($this->_get_client_info());
        $logs_data['created_time'] = date('Y-m-d H:i:s');
        return $this->CI->logs_model->insert_log(TBL_LOGS_LOGIN_LOGOUT, $logs_data);
    }

    function logout_log($log_id) {
        $logs_data = array();
        $logs_data['logout_timestamp'] = time();
        $logs_data['updated_time'] = date('Y-m-d H:i:s');
        return $this->CI->logs_model->update_log(TBL_LOGS_LOGIN_LOGOUT, TBL_LOGS_LOGIN_LOGOUT_PRIMARY_KEY, $log_id, $logs_data);
    }

    function _get_client_info() {
        return array(
            'HTTP_USER_AGENT' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR']
        );
    }

    function get_basic_delete_array($user_id) {
        $update_data = array();
        $update_data['is_delete'] = IS_DELETE;
        $update_data['updated_by'] = $user_id;
        $update_data['updated_time'] = date('Y-m-d H:i:s');
        return $update_data;
    }

    function email_and_sms_for_certificate_appointment($module_type, $module_data) {
//        return false;
        $all_qm_array = $this->CI->config->item('query_module_array');
        $m_data = isset($all_qm_array[$module_type]) ? $all_qm_array[$module_type] : array();
        if (empty($m_data)) {
            return false;
        }

        $app_datetime = convert_to_new_date_format($module_data['appointment_date']) . ' ' . $module_data['appointment_time'];
        //Note: Temporary Solution For Mobile Number
        if (isset($m_data['mob_no'])) {
            $mob_no = isset($module_data[$m_data['mob_no']]) ? $module_data[$m_data['mob_no']] : '';
            $module_id = isset($module_data[$m_data['key_id_text']]) ? $module_data[$m_data['key_id_text']] : VALUE_ZERO;
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $this->CI->load->helper('sms_helper');
            send_SMS($this->CI, $session_user_id, $mob_no, VALUE_NINE, $module_type, $module_id, VALUE_ZERO, $module_data['application_number'], $app_datetime);
        }

        $this->CI->load->model('user_model');
        $ex_u_data = $this->CI->user_model->get_basic_user_data($module_data['user_id']);
        if (empty($ex_u_data)) {
            return false;
        }
        $io_cd = $this->CI->config->item('io_cd_array');
        $registration_message = '<b style="text-decoration: underline;">Application For : ' . $m_data['title'] . '</b><br>'
                . '<b>Application Number : </b>' . $module_data['application_number'] . '<br>'
                . '<b>Appointment Date & Time : </b>' . $app_datetime . '<br>'
                . '<b>Contact Person Name : </b>' . $module_data['appointment_by_name'] . ', Mamlatdar Office, ' . (isset($io_cd[$module_data['district']]) ? $io_cd[$module_data['district']]['address'] : '') . '<br>'
                . '<b>Remarks : </b> Your Appointment is Scheduled. Please Arrive 5 Minutes Before your Appointment.';
        $this->CI->load->library('email_lib');
        $this->CI->email_lib->send_email($ex_u_data, '<b>' . $module_data["application_number"] . '</b> : Appointment Scheduled', $registration_message, VALUE_TWELVE, $module_type, $module_data[$m_data['key_id_text']]);
        if (isset($module_data['email'])) {
            if ($module_data['email'] != '') {
                $ex_u_data['email'] = $module_data['email'];
                $this->CI->email_lib->send_email($ex_u_data, $module_data["application_number"] . ' : Appointment Scheduled', $registration_message, VALUE_TWELVE, $module_type, $module_data[$m_data['key_id_text']]);
            }
        }
    }

    function get_daman_rural_ror_data($village, $survey_number, $subdiv_number) {
        $ror_data = array();
        error_reporting(0);
        try {
            $obj = new SoapClient(DAMAN_API_URL . '/webservice.asmx?WSDL', array('exceptions' => true));
            $get_pdf_list = $obj->GetForm1n14pdf(array('token' => daman_api_encryption(time() . DAMAN_API_ACCESS_KEY), 'village' => $village, 'survey' => $survey_number, 'subdiv' => $subdiv_number));
            $final_result = $get_pdf_list->GetForm1n14pdfResult;
            $return_obj = json_decode($final_result, TRUE);
            if ($return_obj == null) {
                return $ror_data;
            }
            return $return_obj;
        } catch (SoapFault $e) {
            return $ror_data;
        }
    }

    function get_daman_urban_form_d_data($village, $survey_number, $subdiv_number, $area_type) {
        $ror_data = array();
        error_reporting(0);
        try {
            $obj = new SoapClient(DAMAN_API_URL . '/webservice.asmx?WSDL', array('exceptions' => true));
            $get_pdf_list = $obj->GetFormDpdf(array('token' => daman_api_encryption(time() . DAMAN_API_ACCESS_KEY), 'village_id' => $village, 'ptsheet' => $survey_number, 'chaltano' => $subdiv_number, 'ptsheet_gauthan_flag' => $area_type));
            $final_result = $get_pdf_list->GetFormDpdfResult;
            $return_obj = json_decode($final_result, TRUE);
            if ($return_obj == null) {
                return $ror_data;
            }
            return $return_obj;
        } catch (SoapFault $e) {
            return $ror_data;
        }
    }

    function get_daman_urban_form_b_data($village, $survey_number, $subdiv_number, $area_type) {
        $ror_data = array();
        error_reporting(0);
        try {
            $obj = new SoapClient(DAMAN_API_URL . '/webservice.asmx?WSDL', array('exceptions' => true));
            $get_pdf_list = $obj->GetFormBpdf(array('token' => daman_api_encryption(time() . DAMAN_API_ACCESS_KEY), 'village' => $village, 'ptsheet' => $survey_number, 'chaltano' => $subdiv_number, 'ptsheet_gauthan_flag' => $area_type));
            $final_result = $get_pdf_list->GetFormBpdfResult;
            $return_obj = json_decode($final_result, TRUE);
            if ($return_obj == null) {
                return $ror_data;
            }
            return $return_obj;
        } catch (SoapFault $e) {
            return $ror_data;
        }
    }

    function send_fp_email_for_eocs($session_user_id, $module_type, $ex_data) {
        $user_data = $this->CI->utility_model->get_by_id('user_id', $ex_data['user_id'], 'users');
        if (!empty($user_data)) {
            $mt_array = $this->CI->config->item('query_module_array');
            if (isset($mt_array[$module_type])) {
                $mt_data = $mt_array[$module_type];

                $ex_user_data = array('email' => $ex_data['email'], 'user_id' => $session_user_id);
                $this->send_email_for_fees_pending($ex_user_data, VALUE_THIRTEEN, $module_type, $ex_data, $mt_data);

                if ($ex_data['email'] != $user_data['email']) {
                    $ex_user_data = array('email' => $user_data['email'], 'user_id' => $session_user_id);
                    $this->send_email_for_fees_pending($ex_user_data, VALUE_THIRTEEN, $module_type, $ex_data, $mt_data);
                }
            }
        }
    }

    function send_email_for_fees_pending($ex_user_data, $sms_email_type, $module_type, $module_data, $mt_data) {
        if ($ex_user_data['email'] != '') {
            $registration_message = '<b style="text-decoration: underline;">Pay Your Application Fees</b><br>'
                    . '<b>Application Number : </b>' . $module_data["application_number"] . '<br>'
                    . '<b>Remarks : </b> Please Pay Your Application Fees.' . '<br>'
                    . 'Please Login and Pay Your Fees <a href="' . PROJECT_PATH . 'login" target="_blank">' . PROJECT_PATH . 'login</a>';
            $this->CI->load->library('email_lib');
            $this->CI->email_lib->send_email($ex_user_data, 'Application Fees Pending', $registration_message, $sms_email_type, $module_type, $module_data[$mt_data['key_id_text']]);
        }
        //Note: Temporary Solution For Mobile Number
        if (isset($mt_data['mob_no']) && isset($ex_user_data['send_sms'])) {
            $mob_no = isset($module_data[$mt_data['mob_no']]) ? $module_data[$mt_data['mob_no']] : '';
            $module_id = isset($module_data[$mt_data['key_id_text']]) ? $module_data[$mt_data['key_id_text']] : VALUE_ZERO;
            $this->CI->load->helper('sms_helper');
            send_SMS($this->CI, $ex_user_data['user_id'], $mob_no, VALUE_EIGHT, $module_type, $module_id, VALUE_ZERO, $module_data['application_number']);
        }
    }

    function send_sms_and_email_for_app_approve($ex_user_data, $sms_email_type, $module_type, $module_data) {
        $query_module_array = $this->CI->config->item('query_module_array');
        $qm_data = $query_module_array[$module_type] ? $query_module_array[$module_type] : array();
        if (empty($qm_data)) {
            return false;
        }

        if ($ex_user_data['email'] != '') {
            $registration_message = 'Your Application Number : ' . $module_data["application_number"] . ' is Approved !';
            $this->CI->load->library('email_lib');
            $this->CI->email_lib->send_email($ex_user_data, 'Application Approved', $registration_message, $sms_email_type, $module_type, $qm_data['key_id_text']);
        }

        //Note: Temporary Solution For Mobile Number
        if (isset($qm_data['mob_no']) && isset($ex_user_data['send_sms'])) {
            $mob_no = isset($module_data[$qm_data['mob_no']]) ? $module_data[$qm_data['mob_no']] : '';
            $module_id = isset($module_data[$qm_data['key_id_text']]) ? $module_data[$qm_data['key_id_text']] : VALUE_ZERO;
            $this->CI->load->helper('sms_helper');
            send_SMS($this->CI, $ex_user_data['user_id'], $mob_no, VALUE_TEN, $module_type, $module_id, VALUE_ZERO, $module_data['application_number']);
        }
    }

    function send_sms_and_email_for_app_reject($ex_user_data, $sms_email_type, $module_type, $module_data) {
        $query_module_array = $this->CI->config->item('query_module_array');
        $qm_data = $query_module_array[$module_type] ? $query_module_array[$module_type] : array();
        if (empty($qm_data)) {
            return false;
        }

        if ($ex_user_data['email'] != '') {
            $registration_message = 'Your Application Number : ' . $module_data["application_number"] . ' is Rejected !';
            $this->CI->load->library('email_lib');
            $this->CI->email_lib->send_email($ex_user_data, 'Application Rejected', $registration_message, $sms_email_type, $module_type, $qm_data['key_id_text']);
        }

        //Note: Temporary Solution For Mobile Number
        if (isset($qm_data['mob_no']) && isset($ex_user_data['send_sms'])) {
            $mob_no = isset($module_data[$qm_data['mob_no']]) ? $module_data[$qm_data['mob_no']] : '';
            $module_id = isset($module_data[$qm_data['key_id_text']]) ? $module_data[$qm_data['key_id_text']] : VALUE_ZERO;
            $this->CI->load->helper('sms_helper');
            send_SMS($this->CI, $ex_user_data['user_id'], $mob_no, VALUE_ELEVEN, $module_type, $module_id, VALUE_ZERO, $module_data['application_number']);
        }
    }

    function calculate_processing_days($module_type, $submitted_datetime) {
        $module_array = $this->CI->config->item('query_module_array');
        $working_days = 'fdw';
        if (isset($module_array[$module_type])) {
            $working_days = isset($module_array[$module_type]['working_days']) ? $module_array[$module_type]['working_days'] : $working_days;
        }
        $temp_hdl = $this->CI->utility_model->get_result_data_by_id($working_days, VALUE_ONE, 'holiday_list');
        $hdl_array = array();
        foreach ($temp_hdl as $hdl) {
            $hdl_ts = strtotime($hdl['holiday_date']);
            if (!isset($hdl_array[$hdl_ts])) {
                $hdl_array[$hdl_ts] = $hdl_ts;
            }
        }
        if ($submitted_datetime == '0000-00-00 00:00:00' || $submitted_datetime == '1999-01-01 00:00:00') {
            return VALUE_ZERO;
        }
        $total_holiday = 0;
        $total_working_days = 0;
        $startDate = new DateTime($submitted_datetime);

        $endDate = new DateTime(date('d-m-Y'));
        while ($startDate <= $endDate) {
            $timestamp = strtotime($startDate->format('d-m-Y'));
            if (isset($hdl_array[$working_days][$timestamp])) {
                $total_holiday += 1;
            } else {
                $total_working_days += 1;
            }
            $startDate->modify('+1 day');
        }
        return $total_working_days == 0 ? 1 : $total_working_days;
    }

    function update_au_sign_in_eocs_copy($session_user_id, $district, $module_type, $m_type, $module_id) {
        $fc_data = array();
        $this->set_sign_in_eocs_copy($session_user_id, $district, $module_type, $m_type, $module_id, $fc_data);
        if (!empty($fc_data)) {
            $this->CI->utility_model->update_data_batch('form_copy_id', 'form_copy', $fc_data);
        }
    }

    function set_sign_in_eocs_copy($session_user_id, $district, $module_type, $m_type, $module_id, &$fc_data) {
        $t_id = is_admin() ? VALUE_TWENTYFOUR : $session_user_id;
        if ($m_type == VALUE_THREE || $m_type == VALUE_FOUR) {
            $copy_details = $this->CI->utility_model->get_result_data_by_id_multiple('module_type', $module_type, 'form_copy', 'module_id', $module_id);
        } else {
            $copy_details = $this->CI->utility_model->get_result_data_by_id_multiple('module_type', $module_type, 'form_copy', 'module_id', $module_id, 'form_type', VALUE_ZERO);
        }
        if (empty($copy_details)) {
            return false;
        }

        $au_sign_array = array();
        $au_sign_array['m_type'] = $m_type;
        $au_sign_array['t_id'] = $t_id;
        $au_sign_array['s_name'] = strtoupper(get_from_session('name'));
        $au_sign_array['s_type_name'] = strtoupper(get_from_session('temp_type_name_for_sugam_admin'));
        if ($t_id == VALUE_TWENTYFOUR) {
            $au_sign_array['is_eocs'] = true;
            $taluka_array = $this->CI->config->item('taluka_array');
            $district_text = $taluka_array[$district] ? $taluka_array[$district] : '';
            if ($district_text != '') {
                $au_sign_array['s_type_name'] .= ', ' . strtoupper($district_text);
            }
        }

        error_reporting(E_ERROR);
        foreach ($copy_details as $cd) {
            if ($cd['form_nakal'] != '') {
                $nakal_path = 'documents/temp/' . $module_type . '-au-sign-' . $cd['form_copy_id'] . '.pdf';
                file_put_contents($nakal_path, base64_decode($cd['form_nakal']));
                if ($module_type == VALUE_SIX) {
                    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
                } else {
                    if ($cd['form_type'] == VALUE_ZERO) {
                        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
                    } else if ($cd['form_type'] == VALUE_ONE) {
                        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Letter']);
                    } else if ($cd['form_type'] == VALUE_TWO) {
                        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A3', 'orientation' => 'L']);
                    }
                }
                $page_count = $mpdf->setSourceFile($nakal_path);
                for ($i = 1; $i <= $page_count; $i++) {
                    if ($i != 1) {
                        $mpdf->AddPage();
                    }
                    if ($module_type == VALUE_SIX) {
                        if (($m_type == VALUE_THREE || $m_type == VALUE_FOUR) && ($i == $page_count && $cd['form_type'] == VALUE_ZERO)) {
                            $mpdf->WriteHTML($this->CI->load->view('eocs_site_plan/au_sign_fc', $au_sign_array, TRUE));
                        }
                    } else {
                        if ($i == $page_count && $cd['form_type'] == VALUE_ZERO) {
                            $mpdf->WriteHTML($this->CI->load->view('eocs_site_plan/au_sign', $au_sign_array, TRUE));
                        }
                        if (($m_type == VALUE_THREE || $m_type == VALUE_FOUR) && $i == $page_count && $cd['form_type'] == VALUE_ONE) {
                            $mpdf->WriteHTML($this->CI->load->view('eocs_site_plan/au_sign_fd', $au_sign_array, TRUE));
                        }
                        if (($m_type == VALUE_THREE || $m_type == VALUE_FOUR) && $i == $page_count && $cd['form_type'] == VALUE_TWO) {
                            $mpdf->WriteHTML($this->CI->load->view('eocs_site_plan/au_sign_fb', $au_sign_array, TRUE));
                        }
                    }

                    $mpdf->UseTemplate($mpdf->importPage($i));
                }
                $final_filepath = 'documents/temp/' . $module_type . '-au-sign-new-' . $cd['form_copy_id'] . '.pdf';
                $mpdf->Output($final_filepath, 'F');

                $fcu_data = array();
                $fcu_data['form_copy_id'] = $cd['form_copy_id'];
                $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
                array_push($fc_data, $fcu_data);

                if (file_exists($final_filepath)) {
                    unlink($final_filepath);
                }
                if (file_exists($nakal_path)) {
                    unlink($nakal_path);
                }
            }
        }
    }

    function insert_fb_details($session_user_id, $module_type, $module_id, $dept_fd_id, $description, $total_amount) {
        $insert_data = array();
        $insert_data['module_type'] = $module_type;
        $insert_data['module_id'] = $module_id;
        $insert_data['dept_fd_id'] = $dept_fd_id;
        $insert_data['fee_description'] = $description;
        $insert_data['fee'] = $total_amount;
        $insert_data['created_by'] = $session_user_id;
        $insert_data['created_time'] = date('Y-m-d H:i:s');
        $this->CI->utility_model->insert_data('fees_bifurcation', $insert_data);
    }

    function get_rural_pending_land_tax_by_dvssk($district, $village, $survey, $subdiv, $khata_number = '') {
        $plt_details = $this->CI->landtax_na_model->get_all_na_land_detail_by_vssk($district, $village, $survey, $subdiv, $khata_number);
        $arrears = isset($plt_details['arrears']) ? $plt_details['arrears'] : 0;
        $current_year_due_tax = isset($plt_details['current_year_due_tax']) ? $plt_details['current_year_due_tax'] : 0;
        $total_land_tax_payment = isset($plt_details['total_land_tax_payment']) ? $plt_details['total_land_tax_payment'] : 0;
        return ($arrears + $current_year_due_tax) - $total_land_tax_payment;
    }
}

/**
     * EOF: ./application/libraries/Email_lib.php
     */
    