<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Landtax_agriculture extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('landtax_agriculture_model');
    }

    function get_landtax_agriculture_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $landtax_agriculture_data = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }

            $session_district = get_from_session('temp_district_for_sugam_admin');
            $search_village = get_from_post('village');
            $search_khata_number = get_from_post('khata_number');
            $search_occupant_name = filter_var(get_from_post('occupant_name'), FILTER_SANITIZE_SPECIAL_CHARS);

            $this->db->trans_start();
            $landtax_agriculture_data = $this->landtax_agriculture_model->get_all_landtax_agriculture_list($session_district, $search_village, $search_khata_number, $search_occupant_name);

            $success_array['landtax_agriculture_data'] = $landtax_agriculture_data;
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $success_array['landtax_agriculture_data'] = array();
            }

            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['landtax_agriculture_data'] = array();
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
            if (!$khata_number) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $land_data = $this->landtax_agriculture_model->get_all_na_land_detail_by_khata_number($session_district, $village, $khata_number);
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

    function get_landtax_agriculture_details_by_id() {
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
            $landtax_agriculture_id = get_from_post('landtax_agriculture_id');
            if (!$landtax_agriculture_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $landtax_agriculture_data = $this->landtax_agriculture_model->get_landtax_agriculture_by_id($landtax_agriculture_id);

            //$landtax_agriculture_pending_notice_year = $this->landtax_agriculture_model->get_pending_notice_year($landtax_agriculture_id);
            //if (empty($landtax_agriculture_pending_notice_year)) {
            $landtax_agriculture_pending_notice_year = $this->landtax_agriculture_model->get_last_notice_year($landtax_agriculture_id);
            //}

            $landtax_agriculture_total_notice_year = $this->landtax_agriculture_model->get_total_notice_year($landtax_agriculture_id);
            $merged_notice_years = array_merge($landtax_agriculture_total_notice_year, $landtax_agriculture_pending_notice_year);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            if (empty($landtax_agriculture_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $success_array = get_success_array();
            $success_array['landtax_agriculture_data'] = $landtax_agriculture_data;
            $success_array['landtax_agriculture_notice_year'] = $landtax_agriculture_pending_notice_year;
            $success_array['landtax_agriculture_total_notice_year'] = $merged_notice_years;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function submit_landtax_agriculture() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $landtax_agriculture_id = get_from_post('landtax_agriculture_id_for_landtax_agriculture');
            $notice_year = get_from_post('notice_year_for_landtax_agriculture');

            if (!is_post() || $user_id == NULL || !$user_id || $landtax_agriculture_id == NULL || !$landtax_agriculture_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $landtax_agriculture_data = $this->_get_post_data_for_landtax_agriculture();
            $validation_message = $this->_check_validation_for_landtax_agriculture($landtax_agriculture_data);

            if ($validation_message != '') {
                echo json_encode(get_error_array($validation_message));
                return false;
            }

            $this->db->trans_start();
            $landtax_agriculture_year = array();
            $landtax_agriculture_year['arrears'] = $landtax_agriculture_data['arrears'];
            $landtax_agriculture_year['amount'] = get_from_post('tax_amount_for_landtax_agriculture_' . $notice_year);
            $landtax_agriculture_year['updated_by'] = $user_id;
            $landtax_agriculture_year['updated_time'] = date('Y-m-d H:i:s');

            unset($landtax_agriculture_data['arrears']);
            unset($landtax_agriculture_data['amount']);

            $landtax_agriculture_data['updated_by'] = $user_id;
            $landtax_agriculture_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('landtax_agriculture_id', $landtax_agriculture_id, 'landtax_agriculture', $landtax_agriculture_data);
            $this->utility_model->update_data('landtax_agriculture_id', $landtax_agriculture_id, 'landtax_agriculture_year', $landtax_agriculture_year, 'notice_year', $notice_year);

            $village_code = get_from_post('village_code_for_landtax_agriculture');
            $total_land_tax_payment = $this->landtax_agriculture_model->get_landtax_paid_amount_data($landtax_agriculture_data['khata_number'], $village_code);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();

            $landtax_agriculture_result_data = $this->landtax_agriculture_model->get_updated_landtax_amount_data($landtax_agriculture_id);

            foreach ($landtax_agriculture_result_data as $ld) {
                $notice_year = $ld['notice_year'];
                $success_array['ld_arrears'] = $ld['arrears'];

                if ($notice_year == '2022-23') {
                    $success_array['landtax_prev_year'] = $ld['notice_year'];
                    $success_array['landtax_prev_year_amount'] = $ld['amount'];
                }
                if ($notice_year == '2023-24') {
                    $success_array['landtax_curr_year'] = $ld['notice_year'];
                    $success_array['landtax_curr_year_amount'] = $ld['amount'];
                }
                if ($notice_year == '2024-25') {
                    $success_array['landtax_next_year'] = $ld['notice_year'];
                    $success_array['landtax_next_year_amount'] = $ld['amount'];
                }
            }

            $success_array['message'] = DATA_UPDATE_MESSAGE;
            $success_array['total_land_tax_payment'] = $total_land_tax_payment;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function _get_post_data_for_landtax_agriculture() {
        $landtax_agriculture_data = array();
        $landtax_agriculture_data['khata_number'] = get_from_post('khata_number_for_landtax_agriculture');
        $landtax_agriculture_data['occupant_name'] = get_from_post('occupant_name_for_landtax_agriculture');
        $landtax_agriculture_data['address'] = get_from_post('address_for_landtax_agriculture');
        $landtax_agriculture_data['mobile_number'] = get_from_post('mobile_number_for_landtax_agriculture');
        $landtax_agriculture_data['email'] = get_from_post('email_for_landtax_agriculture');
        $landtax_agriculture_data['ref_survey_number'] = get_from_post('ref_survey_number_for_landtax_agriculture');
        $landtax_agriculture_data['remark'] = get_from_post('remark_for_landtax_agriculture');
        $landtax_agriculture_data['dlt_hut'] = get_from_post('dlt_hut_for_landtax_agriculture');
        $landtax_agriculture_data['dlt_itar'] = get_from_post('dlt_itar_for_landtax_agriculture');
        $landtax_agriculture_data['dlt_rokad'] = get_from_post('dlt_rokad_for_landtax_agriculture');
        $landtax_agriculture_data['dlt_kada'] = get_from_post('dlt_kad_for_landtax_agriculture');
        $landtax_agriculture_data['dlt_dangi'] = get_from_post('dlt_dangi_for_landtax_agriculture');
        $landtax_agriculture_data['dlt_kolam'] = get_from_post('dlt_kolam_for_landtax_agriculture');
        $landtax_agriculture_data['dlt_arad'] = get_from_post('dlt_arad_for_landtax_agriculture');
        // $landtax_agriculture_data['amount_of_2022_23'] = get_from_post('amount_of_2022_23_for_landtax_agriculture');
        // $landtax_agriculture_data['amount_of_2023_24'] = get_from_post('amount_of_2023_24_for_landtax_agriculture');
        $landtax_agriculture_data['arrears'] = get_from_post('arrears_for_landtax_agriculture');
        //$landtax_agriculture_data['amount'] = get_from_post('tax_amount_for_landtax_agriculture');
        return $landtax_agriculture_data;
    }

    function _check_validation_for_landtax_agriculture($landtax_agriculture_data) {
        if (!$landtax_agriculture_data['khata_number']) {
            return KHATA_NUMBER_MESSAGE;
        }
        if (!$landtax_agriculture_data['occupant_name']) {
            return NAME_MESSAGE;
        }

        if (!$landtax_agriculture_data['arrears']) {
            return ARREAS_MESSAGE;
        }
//        if (!$landtax_agriculture_data['amount']) {
//            return AMOUNT_MESSAGE;
//        }
        return '';
    }

    function download_excel_for_landtax_agriculture() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $search_village = get_from_post('village_for_landtax_agriculture');
            $search_khata_number = get_from_post('khata_number_for_landtax_agriculture');
            $search_occupant_name = get_from_post('occupant_name_for_landtax_agriculture');
            $this->db->trans_start();
            $land_details = $this->landtax_agriculture_model->get_records_for_excel_for_landtax_agriculture($session_district, $search_village, $search_khata_number, $search_occupant_name);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Description: Khata Number Wise Agriculture Land Details');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=khata_number_wise_agriculture_land_details_excel_' . date('Y-m-d H:i:s') . '.csv');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            $output = fopen("php://output", "w");
            fputcsv($output, array('Sr. No. અનુક્રમ નંબર', 'Village Name', 'Khata No. ખાતા નંબર', 'Name of Occupant ખાતેદારનું નામ', 'Active/Deactive', 'Address', 'Mobile No.', 'E-Mail Address', 'Reference Survey No if any', 'Remarks', 'Hut ઝુપડી', 'Itar ઈતર', 'Rokad રોકડ રુ. પૈ', 'Kada કડા', 'Dangi ડાંગી', 'Kolam કોલમ', 'Arad અળદ', 'Amount of 2022-23', 'Amount of 2023-2024', 'Amount of 2024-2025', 'Arreas of Revenue ', 'Total Amount Pending as on today'));
            if (!empty($land_details)) {
                $active_deactive_array = $this->config->item('active_deactive_array');
                foreach ($land_details as $ld) {
                    $total_amount = $ld['amount_of_2022_23'] + $ld['amount_of_2023_24'] + $ld['amount_of_2024_25'] + $ld['arreas_of_revenue'];
                    fputcsv($output, array('landtax_agriculture_id' => $ld['landtax_agriculture_id'], 'village_name' => $ld['village_name'], 'khata_number' => $ld['khata_number'], 'occupant_name' => $ld['occupant_name'], 'active/deactive' => $active_deactive_array[$ld['status']], 'address' => $ld['address'], 'mobile_number' => $ld['mobile_number'], 'email' => $ld['email'], 'ref_survey_number' => $ld['ref_survey_number'], 'remark' => $ld['remark'], 'dlt_hut' => $ld['dlt_hut'], 'dlt_itar' => $ld['dlt_itar'], 'dlt_rokad' => $ld['dlt_rokad'], 'dlt_kada' => $ld['dlt_kada'], 'dlt_dangi' => $ld['dlt_dangi'], 'dlt_kolam' => $ld['dlt_kolam'], 'dlt_arad' => $ld['dlt_arad'], 'amount_of_2022_23' => $ld['amount_of_2022_23'], 'amount_of_2023_24' => $ld['amount_of_2023_24'], 'amount_of_2024_25' => $ld['amount_of_2024_25'], 'arreas_of_revenue' => $ld['arreas_of_revenue'], 'amount_pending' => $total_amount));
                }
            }
            fclose($output);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return;
        }
    }

    function generate_notice_for_lt_agriculture_in_pdf() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $landtax_agriculture_id = get_from_post('landtax_agriculture_id_for_landtax_agriculture');
            if (!is_post() || $session_user_id == null || !$session_user_id || $landtax_agriculture_id == null || !$landtax_agriculture_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');

            $this->db->trans_start();
            $ex_land_details = $this->landtax_agriculture_model->get_landtax_agriculture_by_id($landtax_agriculture_id);
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
            $notice_data['occupant_name'] = '';
            $notice_data['notice_amount'] = 0;

            $arrears = $ex_land_details['arrears'] ? $ex_land_details['arrears'] : 0;
            $total_land_tax_payment = $ex_land_details['total_amount'] ? $ex_land_details['total_amount'] : 0;
            $total_pending_amount = (($arrears + $total_land_tax_payment)) - $ex_land_details['altp_total_land_tax_payment'];
            $notice_data['notice_amount'] += $total_pending_amount;

            $notice_data['village'] = $ex_land_details['village'];
            $notice_data['village_name'] = $ex_land_details['village_name'];
            $notice_data['khata_number'] = $ex_land_details['khata_number'];
            $notice_data['occupant_name'] = $ex_land_details['occupant_name'];
            $notice_data['created_by'] = $session_user_id;
            $notice_data['created_time'] = date('Y-m-d H:i:s');
            $this->_get_notice_number($notice_data);

            if ($notice_data['notice_amount'] == VALUE_ZERO) {
                print_r(LD_PT_ZERO_MESSAGE);
                return;
            }

            $notice_data['landtax_agriculture_notice_id'] = $this->utility_model->insert_data('landtax_agriculture_notice', $notice_data);

            $district_array = $this->config->item('taluka_array');
            $district_name = isset($district_array[$notice_data['district']]) ? $district_array[$notice_data['district']] : '';
            $final_filepath = 'documents/temp/agriculture-land-tax-notice-' . $notice_data['village'] . '-' . $notice_data['khata_number'] . '-' . time() . '.pdf';
            error_reporting(E_ERROR);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('landtax_agriculture/notice_pdf', array('notice_data' => $notice_data, 'land_details' => $land_details, 'district_name' => $district_name), TRUE));
            $mpdf->defaultfooterline = 0;
            $mpdf->SetFooter($this->load->view('landtax_agriculture/notice_pdf_footer', array('notice_data' => $notice_data), TRUE));
            $mpdf->Output($final_filepath, 'F');

            $nbn_data = array();
            $nbn_data['binary_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
            $this->utility_model->update_data('landtax_agriculture_notice_id', $notice_data['landtax_agriculture_notice_id'], 'landtax_agriculture_notice', $nbn_data);

            if (file_exists($final_filepath)) {
                unlink($final_filepath);
            }

            header("Location: " . base_url() . 'land_tax_agriculture_download_notice' . DIRECTORY_SEPARATOR . encrypt($notice_data['landtax_agriculture_notice_id']));
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return;
        }
    }

    function download_notice_for_lt_in_pdf($temp_landtax_agriculture_notice_id = '') {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if ($session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $landtax_agriculture_notice_id = $temp_landtax_agriculture_notice_id ? decrypt($temp_landtax_agriculture_notice_id) : get_from_post('landtax_agriculture_notice_id_for_ltag');
            if ($landtax_agriculture_notice_id == null || !$landtax_agriculture_notice_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $notice_data = $this->utility_model->get_by_id('landtax_agriculture_notice_id', $landtax_agriculture_notice_id, 'landtax_agriculture_notice');
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
            header('Content-Disposition: inline; filename="agriculture-land-tax-notice-' . $notice_data['village'] . '-' . $notice_data['khata_number'] . '-' . time() . '.pdf"');
            $binary = base64_decode($notice_data['binary_nakal']);
            print_r($binary);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return;
        }
    }

    function _get_notice_number(&$notice_data) {
        $notice_data['notice_year'] = get_financial_year();
        $notice_data['temp_notice_number'] = VALUE_ONE;
        $ex_app_num_data = $this->utility_model->get_by_id_number('notice_year', $notice_data['notice_year'], 'landtax_agriculture_notice', 'village', $notice_data['village'], 'temp_notice_number', 'DESC');
        if (!empty($ex_app_num_data)) {
            $notice_data['temp_notice_number'] = ($ex_app_num_data['temp_notice_number'] + 1 );
        }
        $notice_data['notice_number'] = 'A' . strtoupper(substr($notice_data['village_name'], 0, 3)) . '/' . $notice_data['notice_year'] . '/' . get_five_digit_application_number($notice_data['temp_notice_number']);
    }

    function get_generated_notice_history_agriculture() {
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
            if (!$khata_number) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $village = get_from_post('village_for_gnh');
            if (!$village) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $generated_notice_history_agriculture = $this->utility_model->get_result_data_by_id_multiple('district', $t_district, 'landtax_agriculture_notice', 'village', $village, 'khata_number', $khata_number, '', '', 'landtax_agriculture_notice_id', 'DESC');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['generated_notice_history_agriculture'] = $generated_notice_history_agriculture;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function get_pending_paymnt_details_by_id() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $landtax_agriculture_id = $this->input->post('landtax_agriculture_id');
            if (!is_post() || $session_user_id == null || !$session_user_id || $landtax_agriculture_id == null || !$landtax_agriculture_id || empty($landtax_agriculture_id)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $this->db->trans_start();
            $pending_payment_details = $this->landtax_agriculture_model->get_land_details_by_landtax_agriculture_id($session_district, $landtax_agriculture_id);
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
            $landtax_agriculture_id = $this->input->post('landtax_agriculture_id');
            if (!is_post() || $session_user_id == null || !$session_user_id || $landtax_agriculture_id == null || !$landtax_agriculture_id || empty($landtax_agriculture_id)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $payment_type = get_from_post('payment_type_for_ppt');
            if ($payment_type != VALUE_ONE) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $pending_payment_details = $this->landtax_agriculture_model->get_land_details_by_landtax_agriculture_id($session_district, $landtax_agriculture_id);
            if (empty($pending_payment_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $t_district = $session_district == TALUKA_DIU ? TALUKA_DIU : TALUKA_DAMAN;
            $ltagri_data = array();
            $ltagri_data['notice_year'] = get_financial_year();
            $ltagri_data['district'] = $t_district;
            $ltagri_data['total_amount'] = 0;
            $ltagri_data['status'] = VALUE_THREE;
            $ltagri_data['payment_type'] = $payment_type;
            $ltagri_data['created_type'] = VALUE_ONE;
            $ltagri_data['created_by'] = $session_user_id;
            $ltagri_data['created_time'] = date('Y-m-d H:i:s');

            $rlpltpd_data = array();
            //foreach ($pending_payment_details as $ppd_index => $ppd) {
            //if ($ppd_index == VALUE_ZERO) {
            $ltagri_data['village'] = $pending_payment_details['village'];
            $ltagri_data['village_name'] = $pending_payment_details['village_name'];
            $ltagri_data['khata_number'] = $pending_payment_details['khata_number'];
            $ltagri_data['occupant_name'] = $pending_payment_details['occupant_name'];
            //}

            $arrears = $pending_payment_details['arrears'] ? $pending_payment_details['arrears'] : 0;
            $total_pending_amount = ($arrears + $pending_payment_details['total_amount']) - $pending_payment_details['altp_total_land_tax_payment'];

            array_push($rlpltpd_data, array('ld_tax_payment' => $total_pending_amount, 'created_by' => $ltagri_data['created_by'], 'created_time' => $ltagri_data['created_time']));

            $ltagri_data['total_amount'] += $total_pending_amount;
            // }
            if ($ltagri_data['total_amount'] == VALUE_ZERO) {
                echo json_encode(get_error_array(LD_PT_ZERO_MESSAGE));
                return false;
            }
            $this->_get_payment_application_number($ltagri_data);
            $this->db->trans_start();
            $ltagri_id = $this->utility_model->insert_data('landtax_agriculture_payment', $ltagri_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            foreach ($rlpltpd_data as &$rlpltpdd) {
                $rlpltpdd['landtax_agriculture_payment_id'] = $ltagri_id;
            }
            // Notes : Insert / Update Fees Bifurcation details
            $dept_fd = $this->utility_model->get_by_id('module_type', VALUE_TWENTYNINE, 'dept_fd', 'district', $t_district);
            if (empty($dept_fd)) {
                echo json_encode(get_error_array(CONTACT_NIC_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            if (!empty($rlpltpd_data)) {
                $this->utility_model->insert_data_batch('landtax_agriculture_payment_details', $rlpltpd_data);
            }
            $this->utility_lib->insert_fb_details($session_user_id, VALUE_TWENTYNINE, $ltagri_id, $dept_fd['dept_fd_id'], $dept_fd['description'], $ltagri_data['total_amount']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $pay_data = array();
            $enc_pg_data = $this->payment_lib->get_encrypted_details_for_pg($session_user_id, VALUE_ZERO, VALUE_TWENTYNINE, $ltagri_id, $ltagri_data['application_number'], $ltagri_data['district'], $ltagri_data['total_amount'], $pay_data);
            if ($enc_pg_data['success'] == false) {
                echo json_encode(get_error_array($enc_pg_data['message']));
                return;
            }
            $pay_data['updated_by'] = $session_user_id;
            $pay_data['updated_time'] = date('Y-m-d H:i:s');
            $this->db->trans_start();
            $this->utility_model->update_data('landtax_agriculture_payment_id', $ltagri_id, 'landtax_agriculture_payment', $pay_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['payment_type'] = $ltagri_data['payment_type'];
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

    function _get_payment_application_number(&$ltagri_data) {
        $ltagri_data['notice_year'] = get_financial_year();
        $ltagri_data['temp_application_number'] = VALUE_ONE;
        $ex_app_num_data = $this->utility_model->get_by_id('notice_year', $ltagri_data['notice_year'], 'landtax_agriculture_payment', '', '', 'temp_application_number', 'DESC');
        if (!empty($ex_app_num_data)) {
            $ltagri_data['temp_application_number'] = ($ex_app_num_data['temp_application_number'] + 1);
        }
        $ltagri_data['application_number'] = 'ALRT/' . $ltagri_data['notice_year'] . '/' . get_five_digit_application_number($ltagri_data['temp_application_number']);
    }

    function get_agrilt_payment_history() {
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
            $khata_number = get_from_post('khata_number_for_agriltph');
            if (!$khata_number) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $village = get_from_post('village_for_agriltph');
            if (!$village) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $agrilt_payment_history = $this->landtax_agriculture_model->get_payment_history($t_district, $village, $khata_number);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['agrilt_payment_history'] = $agrilt_payment_history;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_agriculture_tr_five_in_pdf() {
        try {
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $session_user_id == null || !$session_user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $agriltp_id = get_from_post('agri_land_tax_payment_id_for_dtrfagrild');
            if ($agriltp_id == null || !$agriltp_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $this->db->trans_start();
            $payment_data = $this->landtax_agriculture_model->get_payment_history_for_tr_five($agriltp_id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                print_r(DATABASE_ERROR_MESSAGE);
                return;
            }
            if (empty($payment_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $payment_ld_data = $this->utility_model->get_result_data_by_id('landtax_agriculture_payment_id', $agriltp_id, 'landtax_agriculture_payment_details');
            error_reporting(E_ERROR);
            $data = array('payment_data' => $payment_data, 'payment_ld_data' => $payment_ld_data);
            $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
            $mpdf->WriteHTML($this->load->view('landtax_agriculture/tr_five_pdf', $data, TRUE));
            $mpdf->Output('tr-five-' . $payment_data['village'] . '-' . $payment_data['khata_number'] . '-' . time() . '.pdf', 'I');
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return;
        }
    }

    function get_notice_history_agriculture_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['agriculture_nh_data'] = array();
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
            $agriculture_nh_data = $this->landtax_agriculture_model->get_all_nh_agriculture_list($start, $length, $session_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village);
            $success_array['recordsTotal'] = $this->landtax_agriculture_model->get_total_count_of_records_for_nh_agriculture($session_district);
            if ($search_ny != '' || $search_ngo != '' || $search_nn != '' || $search_kn != '' || $search_village != '') {
                $success_array['recordsFiltered'] = $this->landtax_agriculture_model->get_filter_count_of_records_for_nh_agriculture($session_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['agriculture_nh_data'] = array();
                echo json_encode($success_array);
                return;
            }
            $success_array['agriculture_nh_data'] = $agriculture_nh_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['agriculture_nh_data'] = array();
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
            $tr_five_data = $this->landtax_agriculture_model->get_all_tr_five_list($start, $length, $session_district, $search_app_number, $search_kn, $search_occupant_name, $search_tp, $search_pd);
            $success_array['recordsTotal'] = $this->landtax_agriculture_model->get_total_count_of_records_for_tr_five($session_district);
            if ($search_app_number != '' || $search_kn != '' || $search_occupant_name != '' || $search_tp != '' || $search_pd != '') {
                $success_array['recordsFiltered'] = $this->landtax_agriculture_model->get_filter_count_of_records_for_tr_five($session_district, $search_app_number, $search_kn, $search_occupant_name, $search_tp, $search_pd);
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

//    function read_db_for_Landtax_agriculture() {
//        ini_set('memory_limit', '-1');
//  
//        $this->db->select('*');
//        $this->db->where('is_delete !=' . IS_DELETE);
//        $this->db->from('landtax_agriculture');
//        $resc = $this->db->get();
//        $data_from_db = $resc->result_array();
//  
////        echo '<pre>';
////        var_dump($data_from_db);
////        echo '<pre>';
//        
//        if ($data_from_db) {
//            $data_array = array(); 
//            
//
//            foreach ($data_from_db as $row) {
//                $data = array();
//                $data['landtax_agriculture_id'] = $row['landtax_agriculture_id'];
//                $data['notice_year'] = '2024-25';
//                $data['arrears'] = '0.00';
//                $data['amount'] = '0.00';
//                $data['created_by'] = 1;
//                $data['created_time'] = date('Y-m-d H:i:s');
//                array_push($data_array, $data);
//
//                // Insert data into the landtax_agriculture_year table
//                $this->utility_model->insert_data('landtax_agriculture_year', $data);
//            }
////            echo '<pre>';
////            var_dump($data_array);
////            echo '<pre>';
//        }
//    }
}

/*
         * EOF: ./application/controller/Landtax_agriculture.php
         */                