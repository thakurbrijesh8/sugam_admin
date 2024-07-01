<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landtax_na extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('landtax_na_model');
    }

    function get_landtax_na_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['landtax_na_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $search_village = get_from_post('village');
            $search_survey = get_from_post('survey_number');
            $search_subdiv = get_from_post('subdivision_number');
            $search_khata_number = get_from_post('khata_number');
            $search_occupant_name = filter_var(get_from_post('occupant_name'), FILTER_SANITIZE_SPECIAL_CHARS);
            $this->db->trans_start();
            $success_array['landtax_na_data'] = $this->landtax_na_model->get_all_landtax_na_list($session_district, $search_village, $search_survey, $search_subdiv, $search_khata_number, $search_occupant_name);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['landtax_na_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['landtax_na_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_all_na_land_details_data() {
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
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $village = get_from_post('village_for_show_na_land');
            if (!$village) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $khata_number = get_from_post('khata_number_for_show_na_land');
            if (!$khata_number && $khata_number != VALUE_ZERO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $land_data = $this->landtax_na_model->get_all_na_land_detail_by_khata_number($session_district, $village, $khata_number);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($land_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['land_data'] = $land_data;
            $success_array['s_district'] = $session_district == TALUKA_DIU ? TALUKA_DIU : TALUKA_DAMAN;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_excel_for_landtax_na() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $search_village = get_from_post('village_for_ltge');
            $search_survey = get_from_post('survey_number_for_ltge');
            $search_subdiv = get_from_post('subdivision_number_for_ltge');
            $search_khata_number = get_from_post('khata_number_for_ltge');
            $search_occupant_name = get_from_post('occupant_name_for_ltge');
            $this->db->trans_start();
            $land_details = $this->landtax_na_model->get_records_for_excel_for_landtax_na($session_district, $search_village, $search_survey, $search_subdiv, $search_khata_number, $search_occupant_name);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Description: Khata Number Wise NA Land Details');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=khata_number_wise_na_land_details_excel_' . date('Y-m-d H:i:s') . '.csv');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            $output = fopen("php://output", "w");
            fputcsv($output, array('Khata Number', 'Village Name', 'Survey Number', 'Sub Division Number', 'Area', 'Occupant Name',
                'Current Tax (' . get_financial_year() . ')', 'Arrears (' . get_financial_year(1) . ')',
                'Total Paid Tax', 'Total Pending Tax'));
            if (!empty($land_details)) {
                foreach ($land_details as $ld) {
                    $ld['subdiv'] = get_text_formatted($ld['subdiv']);
                    $ld['arrears'] = $ld['arrears'] ? $ld['arrears'] : 0;
                    $ld['total_land_tax_payment'] = $ld['total_land_tax_payment'] ? $ld['total_land_tax_payment'] : 0;
                    $ld['current_year_due_tax'] = $ld['current_year_due_tax'] ? $ld['current_year_due_tax'] : 0;
                    $pending_tax = $ld['current_year_due_tax'] + $ld['arrears'] - $ld['total_land_tax_payment'];
                    fputcsv($output, array('khata_number' => $ld['khata_number'], 'village_name' => $ld['village_name'],
                        'survey' => $ld['survey'], 'subdiv' => $ld['subdiv'], 'area' => $ld['area'],
                        'occupant_name' => $ld['occupant_details'], 'current_year_due_tax' => $ld['current_year_due_tax'], 'arrears' => $ld['arrears'],
                        'total_land_tax_payment' => $ld['total_land_tax_payment'], 'total_pending_tax' => $pending_tax));
                }
            }
            fclose($output);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function download_excel_for_landtax_na_land_details() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $search_village = get_from_post('village_for_ltgeld');
            $search_khata_number = get_from_post('khata_number_for_ltgeld');
            $this->db->trans_start();
            $land_data = $this->landtax_na_model->get_all_na_land_detail_by_khata_number($session_district, $search_village, $search_khata_number);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Description: Village Khata Number Wise NA Land Details');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=village_khata_number_wise_na_land_details_excel_' . date('Y-m-d H:i:s') . '.csv');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            $output = fopen("php://output", "w");
            fputcsv($output, array('Khata Number', 'Village Name', 'Survey Number', 'Sub Division Number', 'Area', 'Occupant Name',
                'Mutation Number', 'Nature', 'Current Tax (' . get_financial_year() . ')', 'Arrears (' . get_financial_year(1) . ')',
                'Total Paid Tax', 'Total Pending Tax'));
            if (!empty($land_data)) {
                foreach ($land_data as $ld) {
                    $ld['subdiv'] = get_text_formatted($ld['subdiv']);
                    $ld['arrears'] = $ld['arrears'] ? $ld['arrears'] : 0;
                    $ld['total_land_tax_payment'] = $ld['total_land_tax_payment'] ? $ld['total_land_tax_payment'] : 0;
                    $ld['current_year_due_tax'] = $ld['current_year_due_tax'] ? $ld['current_year_due_tax'] : 0;
                    $pending_tax = $ld['current_year_due_tax'] + $ld['arrears'] - $ld['total_land_tax_payment'];
                    fputcsv($output, array('khata_number' => $ld['khata_number'], 'village_name' => $ld['village_name'],
                        'survey' => $ld['survey'], 'subdiv' => $ld['subdiv'], 'area' => $ld['area'],
                        'occupant_name' => $ld['occupant_details'], 'mutation_number' => $ld['mutation_number'],
                        'nature' => $ld['nature'], 'current_year_due_tax' => $ld['current_year_due_tax'], 'arrears' => $ld['arrears'],
                        'total_land_tax_payment' => $ld['total_land_tax_payment'], 'total_pending_tax' => $pending_tax));
                }
            }
            fclose($output);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function generate_notice_in_pdf() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $t_occupant_ids = get_from_post('occupant_ids_for_gnnald');
            if (!is_post() || $session_user_id == null || !$session_user_id || $t_occupant_ids == null || !$t_occupant_ids) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $occ_ids = json_decode($t_occupant_ids, true);
            if (empty($occ_ids)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $ex_land_details = $this->landtax_na_model->get_land_details_by_occ_ids($session_district, $occ_ids);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($ex_land_details)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $notice_data = array();
            $notice_data['notice_date'] = date('Y-m-d');
            $notice_data['district'] = $session_district == TALUKA_DIU ? TALUKA_DIU : TALUKA_DAMAN;
            $notice_data['village'] = '';
            $notice_data['khata_number'] = '';
            $notice_data['village_name'] = '';
            $notice_data['occupant_details'] = '';
            $notice_data['notice_amount'] = 0;
            $land_details = array();
            foreach ($ex_land_details as $eld) {
                $arrears = $eld['arrears'] ? $eld['arrears'] : 0;
                $current_year_due_tax = $eld['current_year_due_tax'] ? $eld['current_year_due_tax'] : 0;
                $total_land_tax_payment = $eld['total_land_tax_payment'] ? $eld['total_land_tax_payment'] : 0;
                $total_pending_amount = ($arrears + $current_year_due_tax) - $total_land_tax_payment;
                $notice_data['notice_amount'] += $total_pending_amount;
                if ($total_pending_amount != 0) {
                    if ($notice_data['village'] == '') {
                        $notice_data['village'] = $eld['village'];
                        $notice_data['village_name'] = $eld['village_name'];
                        $notice_data['khata_number'] = $eld['khata_number'];
                        $notice_data['occupant_details'] = $eld['occupant_details'];
                    }
                    array_push($land_details, array('survey' => $eld['survey'], 'subdiv' => $eld['subdiv'], 'pending_amount' => $total_pending_amount));
                }
            }
            if (empty($land_details)) {
                print_r(LD_PT_ZERO_MESSAGE);
                return;
            }
            $notice_data['land_details'] = json_encode($land_details);
            $notice_data['created_by'] = $session_user_id;
            $notice_data['created_time'] = date('Y-m-d H:i:s');
            $this->_get_notice_number($notice_data);

            $notice_data['rlp_notice_id'] = $this->utility_model->insert_data('rlp_notice', $notice_data);

            $district_array = $this->config->item('taluka_array');
            $district_name = isset($district_array[$notice_data['district']]) ? $district_array[$notice_data['district']] : '';
            $final_filepath = 'documents/temp/na-land-tax-notice-' . $notice_data['village'] . '-' . $notice_data['khata_number'] . '-' . time() . '.pdf';
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('landtax_na/notice_pdf', array('notice_data' => $notice_data, 'land_details' => $land_details, 'district_name' => $district_name), TRUE));
            $mpdf->defaultfooterline = 0;
            $mpdf->SetFooter($this->load->view('landtax_na/notice_pdf_footer', array('notice_data' => $notice_data), TRUE));
            $mpdf->Output($final_filepath, 'F');

            $nbn_data = array();
            $nbn_data['binary_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
            $this->utility_model->update_data('rlp_notice_id', $notice_data['rlp_notice_id'], 'rlp_notice', $nbn_data);

            if (file_exists($final_filepath)) {
                unlink($final_filepath);
            }

            header("Location: " . base_url() . 'land_tax_na_download_notice' . DIRECTORY_SEPARATOR . encrypt($notice_data['rlp_notice_id']));
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function _get_notice_number(&$notice_data) {
        $notice_data['notice_year'] = get_financial_year();
        $notice_data['temp_notice_number'] = VALUE_ONE;
        $ex_app_num_data = $this->utility_model->get_by_id_number('notice_year', $notice_data['notice_year'], 'rlp_notice', 'village', $notice_data['village'], 'temp_notice_number', 'DESC');
        if (!empty($ex_app_num_data)) {
            $notice_data['temp_notice_number'] = ($ex_app_num_data['temp_notice_number'] + 1 );
        }
        $notice_data['notice_number'] = strtoupper(substr($notice_data['village_name'], 0, 3)) . '/' . $notice_data['notice_year'] . '/' . get_five_digit_application_number($notice_data['temp_notice_number']);
    }

    function download_notice_in_pdf($temp_rlp_notice_id = '') {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if ($session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $rlp_notice_id = $temp_rlp_notice_id ? decrypt($temp_rlp_notice_id) : get_from_post('rlp_notice_id_for_dnnald');
            if ($rlp_notice_id == null || !$rlp_notice_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $notice_data = $this->utility_model->get_by_id('rlp_notice_id', $rlp_notice_id, 'rlp_notice');
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($notice_data)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            if (!$notice_data['binary_nakal']) {
                print_r(NOTICE_NOT_GENERATED_MESSAGE);
                return false;
            }
            header('Content-type: application/pdf');
            header("Content-Transfer-Encoding: base64");
            header('Content-Disposition: inline; filename="na-land-tax-notice-' . $notice_data['village'] . '-' . $notice_data['khata_number'] . '-' . time() . '.pdf"');
            $binary = base64_decode($notice_data['binary_nakal']);
            print_r($binary);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function get_generated_notice_history() {
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
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $t_district = $session_district == TALUKA_DIU ? TALUKA_DIU : TALUKA_DAMAN;
            $khata_number = get_from_post('khata_number_for_gnh');
            if (!$khata_number && $khata_number != VALUE_ZERO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $village = get_from_post('village_for_gnh');
            if (!$village) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $generated_notice_history = $this->utility_model->get_result_data_by_id_multiple('district', $t_district, 'rlp_notice', 'village', $village, 'khata_number', $khata_number, '', '', 'rlp_notice_id', 'DESC');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['generated_notice_history'] = $generated_notice_history;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_pending_paymnt_details_by_occ_ids() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $occ_ids = $this->input->post('occ_ids_for_ppd');
            if (!is_post() || $session_user_id == null || !$session_user_id || $occ_ids == null || !$occ_ids || empty($occ_ids)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $this->db->trans_start();
            $pending_payment_details = $this->landtax_na_model->get_land_details_by_occ_ids($session_district, $occ_ids);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($pending_payment_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['pending_payment_details'] = $pending_payment_details;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_pending_tax_details() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $occ_ids = $this->input->post('occ_ids_for_ppt');
            if (!is_post() || $session_user_id == null || !$session_user_id || $occ_ids == null || !$occ_ids || empty($occ_ids)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $payment_type = get_from_post('payment_type_for_ppt');
            if ($payment_type != VALUE_ONE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $pending_payment_details = $this->landtax_na_model->get_land_details_by_occ_ids($session_district, $occ_ids);
            if (empty($pending_payment_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $t_district = $session_district == TALUKA_DIU ? TALUKA_DIU : TALUKA_DAMAN;
            $rlpltp_data = array();
            $rlpltp_data['financial_year'] = get_financial_year();
            $rlpltp_data['district'] = $t_district;
            $rlpltp_data['total_amount'] = 0;
            $rlpltp_data['status'] = VALUE_THREE;
            $rlpltp_data['payment_type'] = $payment_type;
            $rlpltp_data['created_type'] = VALUE_ONE;
            $rlpltp_data['created_by'] = $session_user_id;
            $rlpltp_data['created_time'] = date('Y-m-d H:i:s');

            $rlpltpd_data = array();
            foreach ($pending_payment_details as $ppd_index => $ppd) {
                if ($ppd_index == VALUE_ZERO) {
                    $rlpltp_data['village'] = $ppd['village'];
                    $rlpltp_data['village_name'] = $ppd['village_name'];
                    $rlpltp_data['khata_number'] = $ppd['khata_number'];
                    $rlpltp_data['occupant_details'] = $ppd['occupant_details'];
                }

                $arrears = $ppd['arrears'] ? $ppd['arrears'] : 0;
                $current_year_due_tax = $ppd['current_year_due_tax'] ? $ppd['current_year_due_tax'] : 0;
                $total_land_tax_payment = $ppd['total_land_tax_payment'] ? $ppd['total_land_tax_payment'] : 0;
                $total_pending_amount = ($arrears + $current_year_due_tax) - $total_land_tax_payment;

                array_push($rlpltpd_data, array('survey' => $ppd['survey'], 'subdiv' => $ppd['subdiv'],
                    'ld_tax_payment' => $total_pending_amount, 'created_by' => $rlpltp_data['created_by'],
                    'created_time' => $rlpltp_data['created_time']));

                $rlpltp_data['total_amount'] += $total_pending_amount;
            }
            if ($rlpltp_data['total_amount'] == VALUE_ZERO) {
                echo json_encode(get_error_array(LD_PT_ZERO_MESSAGE));
                return false;
            }
            $this->_get_payment_application_number($rlpltp_data);
            $this->db->trans_start();
            $rlpltp_id = $this->utility_model->insert_data('rlp_land_tax_payment', $rlpltp_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            foreach ($rlpltpd_data as &$rlpltpdd) {
                $rlpltpdd['rlp_land_tax_payment_id'] = $rlpltp_id;
            }
            // Notes : Insert / Update Fees Bifurcation details
            $dept_fd = $this->utility_model->get_by_id('module_type', VALUE_TWENTYSEVEN, 'dept_fd', 'district', $t_district);
            if (empty($dept_fd)) {
                echo json_encode(get_error_array(CONTACT_NIC_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            if (!empty($rlpltpd_data)) {
                $this->utility_model->insert_data_batch('rlp_land_tax_payment_details', $rlpltpd_data);
            }
            $this->utility_lib->insert_fb_details($session_user_id, VALUE_TWENTYSEVEN, $rlpltp_id, $dept_fd['dept_fd_id'], $dept_fd['description'], $rlpltp_data['total_amount']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $pay_data = array();
            $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($session_user_id, VALUE_ZERO, VALUE_TWENTYSEVEN, $rlpltp_id, $rlpltp_data['application_number'], $rlpltp_data['district'], $rlpltp_data['total_amount'], $pay_data);
            if ($enc_pg_data['success'] == false) {
                echo json_encode(get_error_array($enc_pg_data['message']));
                return;
            }
            $pay_data['updated_by'] = $session_user_id;
            $pay_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('rlp_land_tax_payment_id', $rlpltp_id, 'rlp_land_tax_payment', $pay_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['payment_type'] = $rlpltp_data['payment_type'];
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

    function _get_payment_application_number(&$rlpltp_data) {
        $rlpltp_data['financial_year'] = get_financial_year();
        $rlpltp_data['temp_application_number'] = VALUE_ONE;
        $ex_app_num_data = $this->utility_model->get_by_id('financial_year', $rlpltp_data['financial_year'], 'rlp_land_tax_payment', '', '', 'temp_application_number', 'DESC');
        if (!empty($ex_app_num_data)) {
            $rlpltp_data['temp_application_number'] = ($ex_app_num_data['temp_application_number'] + 1);
        }
        $rlpltp_data['application_number'] = 'LRT/' . $rlpltp_data['financial_year'] . '/' . get_five_digit_application_number($rlpltp_data['temp_application_number']);
    }

    function get_nalt_payment_history() {
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
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $t_district = $session_district == TALUKA_DIU ? TALUKA_DIU : TALUKA_DAMAN;
            $khata_number = get_from_post('khata_number_for_naltph');
            if (!$khata_number && $khata_number != VALUE_ZERO) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $village = get_from_post('village_for_naltph');
            if (!$village) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $nalt_payment_history = $this->landtax_na_model->get_payment_history($t_district, $village, $khata_number);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['nalt_payment_history'] = $nalt_payment_history;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_tr_five_in_pdf() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $rlpltp_id = get_from_post('rlp_land_tax_payment_id_for_dtrfnald');
            if ($rlpltp_id == null || !$rlpltp_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $payment_data = $this->landtax_na_model->get_payment_history_for_tr_five($rlpltp_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($payment_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $payment_ld_data = $this->utility_model->get_result_data_by_id('rlp_land_tax_payment_id', $rlpltp_id, 'rlp_land_tax_payment_details');
            error_reporting(E_ERROR);
            $data = array('payment_data' => $payment_data, 'payment_ld_data' => $payment_ld_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('landtax_na/tr_five_pdf', $data, TRUE));
            $mpdf->Output('tr-five-' . $payment_data['village'] . '-' . $payment_data['khata_number'] . '-' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function update_area_type() {
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
            $district = get_from_post('district_for_atce');
            if ($district != TALUKA_DAMAN && $district != TALUKA_DIU) {
                echo json_encode(get_error_array(SELECT_DISTRICT_MESSAGE));
                return false;
            }
            $occ_id = get_from_post('occ_id_for_atce');
            if (!$occ_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $area_type = get_from_post('area_type_for_atce');
            if ($area_type != VALUE_ZERO && $area_type != VALUE_ONE) {
                echo json_encode(get_error_array(ARREARS_MESSAGE));
                return false;
            }
            $t_name = 'rural_land_parcels';
            if ($district == VALUE_TWO) {
                $t_name = 'rural_land_parcels_diu';
            }
            $ex_rlp = $this->utility_model->get_by_id('occupant_id', $occ_id, $t_name);
            if (empty($ex_rlp)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data = array();
            $update_data['area_type'] = $area_type;
            $this->landtax_na_model->update_rlp_in_vss($t_name, $ex_rlp['village'], $ex_rlp['survey'], $ex_rlp['subdiv'], $update_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = AT_UPDATE_MESSAGE;
            $success_array['village'] = $ex_rlp['village'];
            $success_array['khata_number'] = $ex_rlp['khata_number'];
            $success_array['land_data'] = $this->landtax_na_model->get_all_na_land_detail_by_khata_number($district, $ex_rlp['village'], $ex_rlp['khata_number']);
            $success_array['s_district'] = $district;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_notice_history_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['nh_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $session_district = $session_district ? $session_district : '';
            $columns = $this->input->post('columns');
            $search_ny = trim($columns[1]['search']['value']);
            $search_ngo = trim($columns[2]['search']['value']);
            $search_nn = trim($columns[3]['search']['value']);
            $search_kn = trim($columns[4]['search']['value']);
            $search_village = trim($columns[5]['search']['value']);
            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $nh_data = $this->landtax_na_model->get_all_nh_list($start, $length, $session_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village);
            $success_array['recordsTotal'] = $this->landtax_na_model->get_total_count_of_records_for_nh($session_district);
            if ($search_ny != '' || $search_ngo != '' || $search_nn != '' || $search_kn != '' || $search_village != '') {
                $success_array['recordsFiltered'] = $this->landtax_na_model->get_filter_count_of_records_for_nh($session_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['nh_data'] = array();
                echo json_encode($success_array);
                return;
            }
            $success_array['nh_data'] = $nh_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['nh_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_tr_five_history_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['tr_five_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $session_district = $session_district ? $session_district : '';
            $columns = $this->input->post('columns');

            $search_app_number = filter_var(trim($columns[2]['search']['value']), FILTER_SANITIZE_SPECIAL_CHARS);
            $search_kn = trim($columns[3]['search']['value']);
            $search_occupant_name = trim($columns[4]['search']['value']);
            $search_tp = trim($columns[5]['search']['value']);
            $search_pd = trim($columns[6]['search']['value']);
            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();
            $tr_five_data = $this->landtax_na_model->get_all_tr_five_list($start, $length, $session_district, $search_app_number, $search_kn, $search_occupant_name, $search_tp, $search_pd);
            $success_array['recordsTotal'] = $this->landtax_na_model->get_total_count_of_records_for_tr_five($session_district);
            if ($search_app_number != '' || $search_kn != '' || $search_occupant_name != '' || $search_tp != '' || $search_pd != '') {
                $success_array['recordsFiltered'] = $this->landtax_na_model->get_filter_count_of_records_for_tr_five($session_district, $search_app_number, $search_kn, $search_occupant_name, $search_tp, $search_pd);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['tr_five_data'] = array();
                echo json_encode($success_array);
                return;
            }
            $success_array['tr_five_data'] = $tr_five_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['tr_five_data'] = array();
            echo json_encode($success_array);
        }
    }
}

/*
         * EOF: ./application/controller/Landtax_na.php
         */                