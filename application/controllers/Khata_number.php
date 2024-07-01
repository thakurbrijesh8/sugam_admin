<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Khata_number extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('khata_number_model');
    }

    function get_khata_number_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['khata_number_data'] = array();
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
            $success_array['khata_number_data'] = $this->khata_number_model->get_all_khata_number_list($session_district, $search_village, $search_survey, $search_subdiv, $search_khata_number, $search_occupant_name);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['khata_number_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['khata_number_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_all_land_details_data() {
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
            $khata_number = get_from_post('khata_number_for_show_land');
//        if (!$khata_number) {
//            echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
//            return false;
//        }
            $village = get_from_post('village_for_show_land');
            if (!$village) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $land_data = $this->khata_number_model->get_all_land_detail_by_khata_id($session_district, $khata_number, $village);
            if (empty($land_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
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

    function update_khata_number() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $occupant_id = get_from_post('occupant_id_for_khata_number_update');
            if (!$occupant_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $hkn = get_from_post('hkn_for_khata_number_update');
            $village = get_from_post('village_for_khata_number_update');
            $khata_number = get_from_post('khata_number_for_khata_number_update');
            if (!$khata_number) {
                echo json_encode(get_error_array(KHATA_NUMBER_MESSAGE));
                return false;
            }
            $update_data = array();
            if ($khata_number != '') {
                $update_data['khata_number'] = $khata_number;
            }
            $update_data['aadhar_card_number'] = get_from_post('aadhar_card_number_for_khata_number_update');
            $update_data['mobile_number'] = get_from_post('mobile_number_for_khata_number_update');
            $this->db->trans_start();
            if (is_admin() || $session_district == TALUKA_DAMAN) {
                $this->utility_model->update_data('occupant_id', $occupant_id, 'rural_land_parcels', $update_data);
            } else if ($session_district == TALUKA_DIU) {
                $this->utility_model->update_data('occupant_id', $occupant_id, 'rural_land_parcels_diu', $update_data);
            }
            if ($hkn != $khata_number) {
                $land_data = $this->khata_number_model->get_all_land_detail_by_khata_id($session_district, $hkn, $village);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = KHATA_NUMBER_UPDATE_MESSAGE;
            if ($hkn != $khata_number) {
                $success_array['land_data'] = $land_data;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function download_land_details_of_khata_number() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $temp_type = get_from_post('temp_type_for_kndl');
            $village = get_from_post('village_for_kndl');
            if (!is_post() || $user_id == null || !$user_id || ($temp_type != VALUE_ONE && $temp_type != VALUE_TWO) || !$village) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $khata_number = get_from_post('khata_number_for_kndl');
            $this->db->trans_start();
            $land_details = $this->khata_number_model->get_all_land_detail_by_khata_id($session_district, $khata_number, $village);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            if (empty($land_details)) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            if ($temp_type == VALUE_ONE) {
                error_reporting(E_ERROR);
                $data = array('land_details' => $land_details);
                $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'L']);
                $mpdf->WriteHTML($this->load->view('khata_number/knld_pdf', $data, TRUE));
                $mpdf->Output($khata_number . '_land_details_' . time() . '.pdf', 'I');
            }
            if ($temp_type == VALUE_TWO) {
                header('Content-Description: Khata Number Wise Land Details');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=khata_number_wise_land_details_excel_' . date('Y-m-d H:i:s') . '.csv');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                echo "\xEF\xBB\xBF"; // UTF-8 BOM
                $output = fopen("php://output", "w");
                fputcsv($output, array('Khata Number', 'Village Name', 'Survey Number', 'Sub Division Number', 'Area',
                    'Occupant Name', 'Mutation Number', 'Nature', 'Aadhar Card Number', 'Mobile Number'));
                foreach ($land_details as $ld) {
                    fputcsv($output, array('khata_number' => $ld['khata_number'], 'village_name' => $ld['village_name'],
                        'survey' => $ld['survey'], 'subdiv' => get_text_formatted($ld['subdiv']), 'area' => $ld['area'],
                        'occupant_name' => $ld['occupant_name'], 'mutation_number' => $ld['mutation_number'],
                        'nature' => $ld['nature'], 'aadhar_card_number' => $ld['aadhar_card_number'], 'mobile_number' => $ld['mobile_number']));
                }
                fclose($output);
            }
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function download_excel_for_khata_number() {
        try {
            ini_set('memory_limit', '-1');
            $user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $user_id == null || !$user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $search_village = get_from_post('village_for_knge');
            $search_survey = get_from_post('survey_number_for_knge');
            $search_subdiv = get_from_post('subdivision_number_for_knge');
            $search_khata_number = get_from_post('khata_number_for_knge');
            $search_occupant_name = get_from_post('occupant_name_for_knge');
            $this->db->trans_start();
            $excel_data = $this->khata_number_model->get_records_for_excel_for_khata_number($session_district, $search_village, $search_survey, $search_subdiv, $search_khata_number, $search_occupant_name);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=khata_number_excel_' . date('Y-m-d H:i:s') . '.csv');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            $output = fopen("php://output", "w");
            fputcsv($output, array('Village Name', 'Khata Number', 'Survey', 'Subdiv', 'Area', 'Owner Type', 'Occupant Name', 'Joint Occupant Details', 'Aadhar Card Number', 'Mobile Number'));
            if (!empty($excel_data)) {
                $land_owner_type_array = $this->config->item('land_owner_type_array');
                foreach ($excel_data as $list) {
                    $list['subdiv'] = get_text_formatted($list['subdiv']);
                    $list['joint_occupants'] = $list['owner_type'] == VALUE_TWO ? $list['joint_occupants'] : '';
                    $list['owner_type'] = isset($land_owner_type_array[$list['owner_type']]) ? $land_owner_type_array[$list['owner_type']] : '';
                    fputcsv($output, $list);
                }
            }
            fclose($output);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return false;
        }
    }

    function update_aadhar_card_number() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $aadhar_card_data = $this->input->post('aadhar_card_number_detail');
            if (!is_post() || $user_id == NULL || !$user_id || empty($aadhar_card_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $this->db->trans_start();
            if (is_admin() || $session_district == TALUKA_DAMAN) {
                $this->utility_model->update_data_batch('occupant_id', 'rural_land_parcels', $aadhar_card_data);
            } else if ($session_district == TALUKA_DIU) {
                $this->utility_model->update_data_batch('occupant_id', 'rural_land_parcels_diu', $aadhar_card_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = AADHAR_CARD_UPDATE_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_mobile_number() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $mobile_numbar_data = $this->input->post('mobile_number_detail');
            if (!is_post() || $user_id == NULL || !$user_id || empty($mobile_numbar_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $this->db->trans_start();
            if (is_admin() || $session_district == TALUKA_DAMAN) {
                $this->utility_model->update_data_batch('occupant_id', 'rural_land_parcels', $mobile_numbar_data);
            } else if ($session_district == TALUKA_DIU) {
                $this->utility_model->update_data_batch('occupant_id', 'rural_land_parcels_diu', $mobile_numbar_data);
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = MOBILE_UPDATE_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }

    function update_is_na() {
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
            $occ_id = get_from_post('occ_id_for_isna');
            if (!$occ_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $is_na = get_from_post('is_na_for_isna');
            if ($is_na != VALUE_ZERO && $is_na != VALUE_ONE) {
                echo json_encode(get_error_array(ARREARS_MESSAGE));
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $t_name = 'rural_land_parcels';
            if ($session_district == TALUKA_DIU) {
                $t_name = 'rural_land_parcels_diu';
            }
            $ex_rlp = $this->utility_model->get_by_id('occupant_id', $occ_id, $t_name);
            if (empty($ex_rlp)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $update_data = array();
            $update_data['is_na'] = $is_na;
            $this->load->model('landtax_na_model');
            $this->landtax_na_model->update_rlp_in_vss($t_name, $ex_rlp['village'], $ex_rlp['survey'], $ex_rlp['subdiv'], $update_data);
            $land_data = $this->khata_number_model->get_all_land_detail_by_khata_id($session_district, $ex_rlp['khata_number'], $ex_rlp['village']);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = LD_UPDATE_MESSAGE;
            $success_array['khata_number'] = $ex_rlp['khata_number'];
            $success_array['village'] = $ex_rlp['village'];
            $success_array['land_data'] = $land_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/Khata_number.php
 */