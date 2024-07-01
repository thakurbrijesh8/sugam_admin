<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function get_basic_details_for_sms($sms_type, $param_one = '', $param_two = '') {
    switch ($sms_type) {
        case VALUE_ONE:
            return array('template_id' => 1407170377072982023, 'message' => "https://sugam.dddgov.in/confirmation?q=" . $param_one . " Click URL & Verify your Account - DDDGOV");
        case VALUE_SIX:
            return array('template_id' => 1407168372919434806, 'message' => "Query Raised on your Sugam Appl No : $param_one Login at https://sugam.dddgov.in/login and respond");
        case VALUE_SEVEN:
            return array('template_id' => 1407168372929678707, 'message' => "Query has been Resolved on your Appl No. $param_one Login at https://sugam.dddgov.in/login to view appl status");
        case VALUE_EIGHT:
            return array('template_id' => 1407168372907606496, 'message' => "Pay your Sugam Appl Fees. Login URL : https://sugam.dddgov.in/login Appl No : " . $param_one);
        case VALUE_NINE:
            return array('template_id' => 1407168372966395923, 'message' => "Appl No. $param_one Scheduled Appointment Date & Time :$param_two Login & View Status at https://sugam.dddgov.in/login");
        case VALUE_TEN:
            return array('template_id' => 1407168372940751711, 'message' => "Your application No. $param_one is Approved ! Login at https://sugam.dddgov.in/login to view Appl Status");
        case VALUE_ELEVEN:
            return array('template_id' => 1407168372950892278, 'message' => "Your Appl No : $param_one is Rejected! Login at https://sugam.dddgov.in/login to view Appl Status");
        default:
            return array();
    }
}

function send_SMS($ci_obj, $user_id, $mobile_number, $sms_type, $module_type = VALUE_ZERO, $module_id = VALUE_ZERO, $sub_module_id = VALUE_ZERO, $param_one = '', $param_two = '') {
    return;
    if (!trim($mobile_number)) {
        return;
    }
    if (strlen($mobile_number) != 10) {
        return;
    }
    $sms_details = get_basic_details_for_sms($sms_type, $param_one, $param_two);
    if (empty($sms_details)) {
        return;
    }
    $message = urlencode($sms_details['message']);
    $xml_data = 'user=' . API_USER_FOR_SMS . '&key=' . API_KEY_FOR_SMS . '&mobile=' . $mobile_number . '&message=' . $message . '&senderid=' . SENDER_ID_FOR_SMS . '&accusage=1&entityid=' . ENTITY_ID_FOR_SMS . '&tempid=' . $sms_details['template_id'];
    $url = "http://sms.smskiosk.in/submitsms.jsp?";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50000);
    $temp_output = curl_exec($ch);
    curl_close($ch);
    if (!strpos($temp_output, ',')) {
        return;
    }
    $output = explode(',', $temp_output);
    if (empty($output)) {
        return;
    }
    $logs_sms = array();
    $logs_sms['app_type'] = VALUE_TWO;
    $logs_sms['sms_type'] = $sms_type;
    $logs_sms['module_type'] = $module_type;
    $logs_sms['module_id'] = $module_id;
    $logs_sms['sub_module_id'] = $sub_module_id;
    $logs_sms['mobile_number'] = $mobile_number;
    $logs_sms['message'] = $sms_details['message'];
    $logs_sms['status'] = isset($output[0]) ? trim($output[0]) : '';
    $logs_sms['status_message'] = isset($output[1]) ? trim($output[1]) : '';
    $logs_sms['message_id'] = isset($output[2]) ? trim($output[2]) : '';
    $logs_sms['client_id'] = isset($output[3]) ? trim($output[3]) : '';
    $logs_sms['response'] = $temp_output ? trim($temp_output) : '';
    $ci_obj->load->model('utility_model');
    $logs_sms['created_by'] = $user_id;
    $logs_sms['created_time'] = date('Y-m-d H:i:s');
    $ci_obj->utility_model->insert_data('logs_sms', $logs_sms);
}
