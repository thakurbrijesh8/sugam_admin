<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_lib {

    private static $OPENSSL_CIPHER_NAME = "AES-128-CBC"; //Name of OpenSSL Cipher
    private static $CIPHER_KEY_LEN = 16; //128 bits
    var $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    function encrypt($key, $iv, $data) {
        if (strlen($key) < Payment_lib::$CIPHER_KEY_LEN) {
            $key = str_pad("$key", Payment_lib::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > Payment_lib::$CIPHER_KEY_LEN) {
            $key = $key;
        }

        $encodedEncryptedData = base64_encode(openssl_encrypt($data, Payment_lib::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
        $encryptedPayload = $encodedEncryptedData;

        return $encryptedPayload;
    }

    function decrypt($key, $data, $iv) {
        if (strlen($key) < Payment_lib::$CIPHER_KEY_LEN) {
            $key = str_pad("$key", Payment_lib::$CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > Payment_lib::$CIPHER_KEY_LEN) {
            $key = $key;
        }

        $decryptedData = openssl_decrypt(base64_decode($data), Payment_lib::$OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);

        return $decryptedData;
    }

    function generate_iv() {
        return substr(PG_KEY, 0, 16);
    }

    function get_encrypted_details_for_pg($session_user_id, $user_id, $module_type, $module_id, $application_number, $district, $total_fees, &$module_data) {
        $reference_number = $module_type . generate_token(5) . time() . $module_id . $application_number;
        $module_data['last_op_reference_number'] = $reference_number;

        if (check_pg_status() != VALUE_ONE) {
            return array('success' => false, 'message' => PG_DOWN_AVAILABLE_MESSAGE);
        }

        // Account Number Details
        $uban_array = $this->CI->config->item('uban_array');
        $dw_uban_array = isset($uban_array[$module_type]) ? $uban_array[$module_type] : array();
        if (empty($dw_uban_array)) {
            return array('success' => false, 'message' => PG_NOT_AVAILABLE_MESSAGE);
        }
        $uban_number = isset($dw_uban_array[$district]) ? $dw_uban_array[$district] : '';
        if (!$uban_number) {
            return array('success' => false, 'message' => PG_NOT_AVAILABLE_MESSAGE);
        }

        //Taluka Short Code
        $taluka_sc_array = $this->CI->config->item('taluka_sc_array');
        $district_sc = $taluka_sc_array[$district] ? $taluka_sc_array[$district] : $taluka_sc_array[TALUKA_DAMAN];

        //Department Name
        $query_module_array = $this->CI->config->item('query_module_array');
        $qm_array = $query_module_array[$module_type] ? $query_module_array[$module_type] : array();
        if (empty($qm_array)) {
            return array('success' => false, 'message' => PG_NOT_AVAILABLE_MESSAGE);
        }

        $temp_od = $district . '-' . $module_type . '-' . $module_id . '-' . $application_number;
        $od = api_encryption($temp_od);
        $on = PG_PSOURCE . $district_sc . '-' . $reference_number;

        $pg_rp = PG_MID . '|' . PG_OM . '|' . PG_COUNTRY . '|' . PG_CURRENCY . '|' . $total_fees . '|'
                . $od . '|' . PG_SUCCESS_URL . '|' . PG_FAIL_URL . '|' . PG_AGG_ID . '|' . $on . '|'
                . $temp_od . '|' . PG_PM . '|' . PG_ACC . '|' . PG_TS;
        $iv = $this->generate_iv();
        $enc_transaction = $this->encrypt(PG_KEY, $iv, $pg_rp);
        $enc_multi = $this->encrypt(PG_KEY, $iv, $total_fees . '|' . PG_CURRENCY . '|' . $uban_number);

        $fp = array();
        $fp['reference_number'] = $reference_number;
        $fp['sa_user_id'] = $session_user_id;
        $fp['user_id'] = $user_id;
        $fp['district'] = $district;
        $fp['module_type'] = $module_type;
        $fp['module_id'] = $module_id;
        $fp['application_number'] = $application_number;
        $fp['total_fees'] = $total_fees;
        $fp['op_other_details'] = $od;
        $fp['op_order_number'] = $on;
        $fp['op_enct'] = $enc_transaction;
        $fp['op_mt'] = $enc_multi;
        $fp['op_status'] = VALUE_ONE;
        $fp['op_og_status'] = $fp['op_status'];
        $fp['op_start_datetime'] = date('Y-m-d H:i:s');

        $this->CI->load->model('utility_model');
        $this->CI->utility_model->insert_data('fees_payment', $fp);

        $return_data = array();
        $return_data['success'] = true;
        $return_data['op_mmptd'] = PG_MID;
        $return_data['op_enct'] = $enc_transaction;
        $return_data['op_mt'] = $enc_multi;
        return $return_data;
    }

    function get_payment_history_data($module_type, $module_id, &$module_data) {
        $module_data['hide_submit_btn'] = false;
        $this->CI->load->model('payment_model');
        $ph_data = $this->CI->payment_model->get_payment_history($module_type, $module_id);
        if ($module_data['last_op_reference_number'] != '') {
            foreach ($ph_data as $ph) {
                if ($ph['reference_number'] == $module_data['last_op_reference_number'] &&
                        ($ph['op_status'] == VALUE_TWO || $ph['op_status'] == VALUE_FOUR || $ph['op_status'] == VALUE_FIVE || $ph['op_status'] == VALUE_SIX)) {
                    $module_data['hide_submit_btn'] = true;
                    break;
                }
            }
        }
        $module_data['ph_data'] = $ph_data;
    }

    function check_payment_dv($module_type_array, $check_payment_fp) {
        if (!isset($module_type_array[$check_payment_fp['module_type']])) {
            return false;
        }
        $temp_access_data = $module_type_array[$check_payment_fp['module_type']];
        if (empty($temp_access_data)) {
            return false;
        }

        $dv_data = array();
        $update_fp = false;
        $fp_update = array();
        $md_update = array();
        $module_data = array();
        $this->cp_dv($dv_data, $update_fp, $fp_update, $md_update, $check_payment_fp['user_id'], VALUE_ONE, $check_payment_fp['fees_payment_id'], $check_payment_fp, $module_data, $temp_access_data);
    }

    function cp_dv(&$dv_data, &$update_fp, &$fp_update, &$md_update, $user_id, $dv_type, $fees_payment_id, $check_payment_fp, $module_data, $temp_access_data) {
        $update_fp = false;
        $dv_data = array();
        $dv_data['dv_type'] = $dv_type;
        $dv_data['fees_payment_id'] = $fees_payment_id;
        $dv_data['dv_start_datetime'] = date('Y-m-d H:i:s');
        $dv_data['created_by'] = $user_id;
        $dv_data['created_time'] = $dv_data['dv_start_datetime'];
        $dv_data['dv_status'] = VALUE_ONE;

        $dv_request_params = "|" . PG_MID . "|" . $check_payment_fp['op_order_number'] . "|" . $check_payment_fp['total_fees'];
        $query_request = http_build_query(array('queryRequest' => $dv_request_params, "aggregatorId" => PG_AGG_ID, "merchantId" => PG_MID));

        $ch = curl_init(PG_DV_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50000);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_request);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $dv_data['dv_status'] = VALUE_THREE;
            $dv_data['dv_message'] = curl_error($ch);
        }
        curl_close($ch);
        if ($dv_data['dv_status'] == VALUE_ONE) {
            $dv_data['dv_status'] = VALUE_THREE;
            $dv_data['dv_message'] = RES_NOT_REC_MESSAGE;
            if ($response) {
                $return_data = explode('|', $response);
                if (!empty($return_data)) {
                    $status = isset($return_data[2]) ? $return_data[2] : '';
                    if ($status == 'No Records Found') {
                        $status = 'FAIL';
                    }
                    if ($status == 'FAIL' || $status == 'ABORT' || $status == 'PENDING' || $status == 'BOOKED' || $status == 'INPROGRESS' || $status == 'SUCCESS' || $status == 'REFUND' || $status == 'EXPIRED' || $status == 'CANCELLED') {
                        $dv_data['dv_status'] = VALUE_TWO;
                        $dv_data['dv_return'] = $response;
                        $dv_data['dv_reference_id'] = isset($return_data[1]) ? $return_data[1] : '';
                        $dv_data['dv_pg_status'] = ($status == 'FAIL' || $status == 'ABORT' || $status == 'REFUND' || $status == 'EXPIRED' || $status == 'CANCELLED') ? VALUE_THREE : ($status == 'PENDING' ? VALUE_FOUR : ($status == 'BOOKED' ? VALUE_FIVE : ($status == 'INPROGRESS' ? VALUE_SIX : ($status == 'SUCCESS' ? VALUE_TWO : VALUE_THREE))));
                        $dv_data['dv_order_number'] = isset($return_data[6]) ? $return_data[6] : '';
                        $dv_data['dv_amount'] = isset($return_data[7]) ? $return_data[7] : '';
                        $dv_data['dv_message'] = isset($return_data[8]) ? $return_data[8] : '';
                        $dv_data['dv_bank_code'] = isset($return_data[9]) ? $return_data[9] : '';
                        $dv_data['dv_bank_ref_number'] = isset($return_data[10]) ? $return_data[10] : '';
                        $update_fp = true;
                    }
                }
            }
        }

        $dv_data['dv_end_datetime'] = date('Y-m-d H:i:s');
        $fp_dv_id = $this->CI->utility_model->insert_data('fees_payment_dv', $dv_data);
        $fp_update = array();
        if ($update_fp) {
            $update_fp = false;
            $this->_update_fp_data_status($fp_update, $fp_dv_id, $dv_data, $check_payment_fp, $update_fp, $fees_payment_id);
        }
        $md_update = array();
        if ($update_fp) {
            $this->_update_module_data_status($dv_data, $md_update, $module_data, $fp_update, $temp_access_data, $check_payment_fp);
        }
    }

    function _update_fp_data_status(&$fp_update, $fp_dv_id, $dv_data, $check_payment_fp, &$update_fp, $fees_payment_id) {
        $fp_update = array();
        $fp_update['fees_payment_dv_id'] = $fp_dv_id;

        if ($dv_data['dv_pg_status'] == VALUE_TWO || $dv_data['dv_pg_status'] == VALUE_THREE || $dv_data['dv_pg_status'] == VALUE_FOUR || $dv_data['dv_pg_status'] == VALUE_FIVE || $dv_data['dv_pg_status'] == VALUE_SIX) {
            if ($check_payment_fp['is_auto_dv_done'] == VALUE_ZERO) {
                $fp_update['is_auto_dv_done'] = VALUE_ONE;
            }
            if ($check_payment_fp['op_status'] != $dv_data['dv_pg_status']) {
                if (isset($dv_data['dv_return'])) {
                    $return_data = explode('|', $dv_data['dv_return']);
                    if (!empty($return_data)) {
                        $fp_update['reference_id'] = isset($return_data[13]) ? $return_data[13] : '';
                        $fp_update['op_end_datetime'] = isset($return_data[11]) ? $return_data[11] : '';
                        $fp_update['op_bank_code'] = isset($return_data[9]) ? $return_data[9] : '';
                        $fp_update['op_bank_reference_number'] = isset($return_data[10]) ? $return_data[10] : '';
                        $fp_update['op_transaction_datetime'] = $fp_update['op_end_datetime'];
                        $fp_update['op_mid'] = isset($return_data[0]) ? $return_data[0] : '';
                    }
                }
                $fp_update['op_status'] = $dv_data['dv_pg_status'];
                $fp_update['op_message'] = $dv_data['dv_message'];
                $update_fp = true;
            }
        }
        $this->CI->utility_model->update_data('fees_payment_id', $fees_payment_id, 'fees_payment', $fp_update);
    }

    function _update_module_data_status($dv_data, &$md_update, $module_data, $fp_update, $temp_access_data, $check_payment_fp) {
        if ($dv_data['dv_type'] == VALUE_ONE) {
            $module_data = $this->CI->utility_model->get_by_id($temp_access_data['key_id_text'], $check_payment_fp['module_id'], $temp_access_data['tbl_text']);
            if (empty($module_data)) {
                return false;
            }
        }
        if ($module_data['status'] == VALUE_THREE && $fp_update['op_status'] == VALUE_TWO) {
            $md_update = array();
            $md_update['status'] = VALUE_FOUR;
            $this->CI->utility_model->update_data($temp_access_data['key_id_text'], $check_payment_fp['module_id'], $temp_access_data['tbl_text'], $md_update);
        }
//        if ($module_data['status'] == VALUE_FOUR && $fp_update['op_status'] == VALUE_THREE) {
//            $md_update = array();
//            $md_update['status'] = VALUE_THREE;
//            $this->CI->utility_model->update_data($temp_access_data['key_id_text'], $check_payment_fp['module_id'], $temp_access_data['tbl_text'], $md_update);
//        }
    }
}
