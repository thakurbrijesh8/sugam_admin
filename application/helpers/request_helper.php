<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function check_authenticated() {
    if (!is_authenticated()) {
        header("Location:" . base_url() . "login");
    }
}

function is_authenticated() {
    $CI = & get_instance();
    $user_id = $CI->session->userdata('temp_id_for_sugam_admin');
    if (is_null($user_id) || $user_id == '') {
        return false;
    }
    return true;
}

/**
 * Fetch the value from SESSION
 * @param type $key
 * @return type
 */
function get_from_session($key) {
    $CI = & get_instance();
    $value = $CI->session->userdata($key);
    return $value;
}

/**
 * Check Method is POST Or Not.
 * @return boolean
 */
function is_post() {
    return TRUE;
    if (!(filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST')) {
        return FALSE;
    }
    return TRUE;
}

/**
 * Fetch the value from POST. Will be trim() by default.
 * @param type $key - key to fetch from POST
 * @param type $trim - Optional. Default is TRUE
 * @return type
 */
function get_from_post($key, $trim = TRUE) {
    $CI = & get_instance();
    return $trim ? trim($CI->input->post($key)) : $CI->input->post($key);
}

function get_new_token() {
    $CI = & get_instance();
    return $CI->security->get_csrf_hash();
}

function get_success_array() {
    $CI = & get_instance();
    $return_array = array();
    $return_array['success'] = TRUE;
    $return_array['temp_token'] = $CI->security->get_csrf_hash();
    return $return_array;
}

function get_error_array($message = INVALID_ACCESS_MESSAGE) {
    $CI = & get_instance();
    $return_array = array();
    $return_array['success'] = FALSE;
    $return_array['temp_token'] = $CI->security->get_csrf_hash();
    $return_array['message'] = $message;
    return $return_array;
}

function api_encryption($access_token) {
    $method = 'aes-256-cbc';
    $password = substr(hash('sha256', API_ENCRYPTION_KEY, true), 0, 32);
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    return base64_encode(openssl_encrypt($access_token, $method, $password, OPENSSL_RAW_DATA, $iv));
}

function api_decryption($access_token) {
    $method = 'aes-256-cbc';
    $password = substr(hash('sha256', API_ENCRYPTION_KEY, true), 0, 32);
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    return openssl_decrypt(base64_decode($access_token), $method, $password, OPENSSL_RAW_DATA, $iv);
}

function daman_api_encryption($access_token) {
    $method = 'aes-256-cbc';
    $password = substr(hash('sha256', DAMAN_API_ENCRYPTION_KEY, true), 0, 32);
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    return base64_encode(openssl_encrypt($access_token, $method, $password, OPENSSL_RAW_DATA, $iv));
}

function is_admin() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_A;
}

function is_talathi_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_TALATHI_USER;
}

function is_aci_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_ACI_USER;
}

function is_mamlatdar_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_MAMLATDAR_USER;
}

function is_ldc_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_LDC_USER;
}

function is_sdpo_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_SDPO_USER;
}

function is_mam_view_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_MAM_VIEW_USER;
}

function is_subr_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_SUBR_USER;
}

function is_subr_ver_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_SUBR_VER_USER;
}

function is_user_acc_ver() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_USER_ACC_VER;
}

function is_eocs_fs_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_EOCS_FS;
}

function is_eocs_head() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_EOCS_HEAD;
}

function is_eocs_hs_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_EOCS_HS;
}

function is_eocs_jfs_user() {
    $CI = & get_instance();
    $user_type = $CI->session->userdata('temp_type_for_sugam_admin');
    return $user_type == TEMP_TYPE_EOCS_JFS;
}

function convert_to_indian_currency($number) {
    $no = round($number);
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        0 => '',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? '' : null;
//            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter];
        } else {
            $str [] = null;
        }
    }

    $Rupees = implode(' ', array_reverse($str));
    $paise = ($decimal) ? "And Paise " . ($words[$decimal - $decimal % 10]) . " " . ($words[$decimal % 10]) : '';
    return ($Rupees ? 'Rupees ' . $Rupees : '') . $paise . " Only";
}

function check_pg_status() {
    $wait = 1;
    $host = PG_FULL_URL;
//    $ports = ['http' => 80, 'https' => 443];
    $ports = ['https' => 443];
    $return_data = VALUE_ONE;
    foreach ($ports as $key => $port) {
        $fp = @fsockopen($host, $port, $errCode, $errStr, $wait);
        if ($fp) {
            fclose($fp);
        } else {
            $main_path = "other_logs";
            if (!is_dir($main_path)) {
                mkdir($main_path);
                chmod($main_path, 0777);
                copy('images' . DIRECTORY_SEPARATOR . 'index.html', $main_path . DIRECTORY_SEPARATOR . 'index.html');
            }
            $sbi_path = $main_path . DIRECTORY_SEPARATOR . "sbi";
            if (!is_dir($sbi_path)) {
                mkdir($sbi_path);
                chmod($sbi_path, 0777);
                copy($main_path . DIRECTORY_SEPARATOR . 'index.html', $sbi_path . DIRECTORY_SEPARATOR . 'index.html');
            }
            $file_path = $sbi_path . DIRECTORY_SEPARATOR . 'log-' . date('Y-m-d') . '.php';
            if (!file_exists($file_path)) {
                $n_file = fopen($file_path, "w");
                fwrite($n_file, "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n");
                fclose($n_file);
            }
            $e_file = fopen($file_path, "a");
            fwrite($e_file, 'ERROR - ' . date('Y-m-d H:i:s') . " --> $host:$port ($key) --> $errCode - $errStr \n");
            fclose($e_file);
            $return_data = VALUE_ZERO;
            break;
        }
    }
    return $return_data;
}

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function get_logout_array() {
    $return_array = get_error_array();
    $return_array['is_logout'] = true;
    return $return_array;
}

/**
 * EOF: ./application/helpers/request_helper.php
 */