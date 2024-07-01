<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * generate array index as key value as object
 * @param type $result_set
 * @param type $index_field
 * @return type
 */
function generate_array_for_id_object($result_set, $index_field) {
    $main_array = array();
    foreach ($result_set as $record) {
        $main_array[intval(trim($record[$index_field]))] = $record;
    }
    return $main_array;
}

function generate_array_for_id_objects($temp_data, $id) {
    $all_data = array();
    foreach ($temp_data as $temp_op) {
        if (!isset($all_data[$temp_op[$id]])) {
            $all_data[$temp_op[$id]] = array();
        }
        array_push($all_data[$temp_op[$id]], $temp_op);
    }
    return $all_data;
}

function generate_array_for_id_indisde_id_object($temp_data, $id, $inside_id) {
    $all_data = array();
    foreach ($temp_data as $temp_op) {
        if (!isset($all_data[$temp_op[$id]])) {
            $all_data[$temp_op[$id]] = array();
        }
        if (!isset($all_data[$temp_op[$id]][$temp_op[$inside_id]])) {
            $all_data[$temp_op[$id]][$temp_op[$inside_id]] = $temp_op;
        }
    }
    return $all_data;
}

function crypto_rand_secure($min, $max) {
    $range = $max - $min;
    if ($range < 1)
        return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

/**
 * Generate Random Token.
 * @param type $length
 * @param type $is_special_character_allow
 * @return string
 */
function generate_token($length = 20, $is_special_character_allow = FALSE) {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    if ($is_special_character_allow) {
        $codeAlphabet .= "!#$%-_+<>=";
    }
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
    }

    return $token;
}

function convert_to_mysql_date_format($dt) {
    $date_time_object = new DateTime($dt);
    return $date_time_object->format('Y-m-d');
}

function convert_to_new_date_format($dt, $separator = '') {
    $separator = $separator != '' ? $separator : '-';
    $date_time_object = new DateTime($dt);
    return $date_time_object->format("d" . $separator . "m" . $separator . "Y");
}

function convert_to_new_datetime_format($dt) {
    $date_time_object = new DateTime($dt);
    return $date_time_object->format("d-m-Y H:i:s");
}

function convert_to_ampm_time_format($dt) {
    $date_time_object = new DateTime($dt);
    return $date_time_object->format("h:i A");
}

function encrypt($message) {
    $iv = random_bytes(16);
    $key = getKey(ENCRYPTION_KEY);
    $result = sign(openssl_encrypt($message, 'aes-256-ctr', $key, OPENSSL_RAW_DATA, $iv), $key);
    return bin2hex($iv) . bin2hex($result);
}

function decrypt($hash) {
    $iv = hex2bin(substr($hash, 0, 32));
    $data = hex2bin(substr($hash, 32));
    $key = getKey(ENCRYPTION_KEY);
    if (!verify($data, $key)) {
        return null;
    }
    return openssl_decrypt(mb_substr($data, 64, null, '8bit'), 'aes-256-ctr', $key, OPENSSL_RAW_DATA, $iv);
}

function sign($message, $key) {
    return hash_hmac('sha256', $message, $key) . $message;
}

function verify($bundle, $key) {
    return hash_equals(
            hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key), mb_substr($bundle, 0, 64, '8bit')
    );
}

function getKey($password, $keysize = 16) {
    return hash_pbkdf2('sha256', $password, 'some_token', 100000, $keysize, true);
}

function generate_random_string($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function generate_registration_number($type, $id) {
    return $type . sprintf("%05d", $id);
}

function get_string($data_array, $value_array) {
    $string = '';
    $cnt = 1;
    if (strpos($value_array, ',')) {
        $array = explode(",", $value_array);
        foreach ($array as $index => $value) {
            if ($cnt != 1) {
                $string .= ' , ';
            }
            $string .= $data_array[$value] ? $data_array[$value] : '';
            $cnt++;
        }
    } else {
        if ($value_array) {
            $string .= $data_array[$value_array] ? $data_array[$value_array] : '';
        }
    }
    return $string;
}

function get_encrypt_id($id) {
    return generate_random_string(3) . base64_encode($id) . generate_random_string(3);
}

function get_decrypt_id($temp_access_token) {
    $removed_first_three_character = substr($temp_access_token, 3);
    $final_token = substr($removed_first_three_character, 0, -3);
    return base64_decode($final_token);
}

function get_days_in_dates($end_date) {
    $date1 = new DateTime($end_date);
    $date2 = new DateTime();
    return $date2->diff($date1)->format('%a') + 1;
}

function generate_barcode_number($type, $id) {
    return sprintf("%02d", $type) . sprintf("%07d", $id);
}

function indian_comma_income($income) {
    return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $income);
}

function merge_pdf($target_path, $files) {
    $new_files = implode(' ', $files);
    shell_exec('"' . GS_PATH . '" -dNOPAUSE -sDEVICE=pdfwrite -sOUTPUTFILE=' . $target_path . ' -dBATCH ' . $new_files);
}

function generate_array_for_id_object_for_string($result_set, $index_field) {
    $main_array = array();
    foreach ($result_set as $record) {
        $main_array[trim($record[$index_field])] = $record;
    }
    return $main_array;
}

function get_case_number($id) {
    return sprintf("%03d", $id);
}

function get_five_digit_application_number($id) {
    return sprintf("%05d", $id);
}

function generate_pt_sheet_number_array($temp_ptsheet_data, $village) {
    $ptsheet_data = array();
    foreach ($temp_ptsheet_data as $value) {
        $pts_gtw_no = preg_replace('/[^0-9]/', '', $value['pts_gtw']);
        $temp_array = array();
        $temp_array['pts_gtw'] = $pts_gtw_no;
        if ($village == VALUE_ONE && $pts_gtw_no <= 57) {
            array_push($ptsheet_data, $temp_array);
        }
        if ($village == VALUE_TWO && $pts_gtw_no > 57) {
            array_push($ptsheet_data, $temp_array);
        }
    }
    return $ptsheet_data;
}

function get_financial_year($m_year = 0) {
    $date = date_create(date('Y-m-d'));
    if (date_format($date, "m") >= 4) {
        $financial_year = (date_format($date, "Y") - $m_year) . '-' . (date_format($date, "y") + (1 - $m_year));
    } else {
        $financial_year = (date_format($date, "Y") - (1 + $m_year)) . '-' . date_format($date, "y") - $m_year;
    }
    return $financial_year;
}

function get_previous_financial_year() {
    $date = date_create(date('Y-m-d'));
    if (date_format($date, "m") >= 4) {
        $financial_year = (date_format($date, "Y") - 1) . '-' . (date_format($date, "y"));
    } else {
        $financial_year = (date_format($date, "Y") - 2) . '-' . date_format($date, "y") - 1;
    }
    return $financial_year;
}

function calculate_age($dob) {
    return (date('Y') - date('Y', strtotime($dob)));
}

function ldc_app_details($m_data, $app_field_name, $l_app_name_field) {
    $ldc_field_name = trim($m_data[$l_app_name_field]);
    if (isset($m_data['aci_to_m_ldc'])) {
        if (($m_data['aci_to_ldc'] != VALUE_ZERO || $m_data['aci_to_m_ldc'] != VALUE_ZERO) && $ldc_field_name != '' &&
                trim($m_data[$app_field_name]) != $ldc_field_name) {
            return $ldc_field_name;
        } else {
            return $m_data[$app_field_name];
        }
    } else {
        if ($m_data['aci_to_ldc'] != VALUE_ZERO && $ldc_field_name != '' &&
                trim($m_data[$app_field_name]) != $ldc_field_name) {
            return $ldc_field_name;
        } else {
            return $m_data[$app_field_name];
        }
    }
}

function get_exploded_string_in_two_variable($temp_name, $length) {
    $exploded_array = explode(' ', $temp_name);
    $first_string = '';
    $second_string = '';
    $is_first_string = TRUE;
    $temp_string = '';
    foreach ($exploded_array as $key => $value) {
        $temp_string .= ' ' . $value;
        if (strlen($temp_string) > $length) {
            $is_first_string = FALSE;
        }
        if ($is_first_string) {
            $first_string .= ' ' . $value;
        } else {
            $second_string .= ' ' . $value;
        }
    }
    if ($second_string == '') {
        $second_string = '-------';
    }
    return array('first_string' => $first_string, 'second_string' => $second_string);
}

function get_year($pdate) {
    $date_time_object = new DateTime($pdate);
    return $date_time_object->format('Y');
}

function get_month_name($pdate) {
    $date_time_object = new DateTime($pdate);
    return $date_time_object->format('F');
}

function get_day($pdate) {
    $date_time_object = new DateTime($pdate);
    return $date_time_object->format('jS');
}

function get_sub_registrar_name($sub_registrar_array, $dr_data) {
    $subr_name = isset($sub_registrar_array[$dr_data['district']]) ? $sub_registrar_array[$dr_data['district']] : '';
    if ($dr_data['status_datetime'] == '0000-00-00 00:00:00') {
        return $subr_name;
    }
    if ($dr_data['status_datetime'] <= OLD_SUBR_DAMAN_LDT) {
        $subr_name = OLD_SUBR_DAMAN_NAME;
    } else if ($dr_data['status_datetime'] > OLD_SUBR_DAMAN_LDT && $dr_data['status_datetime'] <= OLD_2_SUBR_DAMAN_LDT) {
        $subr_name = OLD_2_SUBR_DAMAN_NAME;
    }
    return $subr_name;
}

function get_text_formatted($f_data) {
    return '="' . $f_data . '"';
}

/**
 * EOF: ./application/helpers/utility_helper.php
 */
