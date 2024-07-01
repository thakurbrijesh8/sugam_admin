<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_khata_number_v2 extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('assign_khata_number_v2_model');
    }

    function get_assign_khata_number_v2_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = get_success_array();
            $success_array['assign_khata_number_v2_data'] = array();
            if ($user_id == NULL || !$user_id) {
                echo json_encode($success_array);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $search_village = get_from_post('village');
            $search_survey = get_from_post('survey_number');
            $search_subdiv = get_from_post('subdivision_number');
            $search_occupant_name = filter_var(get_from_post('occupant_name'), FILTER_SANITIZE_SPECIAL_CHARS);
            $this->db->trans_start();
            $success_array['assign_khata_number_v2_data'] = $this->assign_khata_number_v2_model->get_assign_khata_number_v2_data($session_district, $search_village, $search_survey, $search_subdiv, $search_occupant_name);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $success_array['assign_khata_number_v2_data'] = array();
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['assign_khata_number_v2_data'] = array();
            echo json_encode($success_array);
        }
    }

    function update_assign_khata_number() {
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
            $occupant_id = get_from_post('occupant_id_for_assign_khata_number_update');
            if (!$occupant_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $khata_number = get_from_post('khata_number_for_assign_khata_number_update');
            if (!$khata_number) {
                echo json_encode(get_error_array(KHATA_NUMBER_MESSAGE));
                return false;
            }

            $ex_details = $this->utility_model->get_by_id('occupant_id', $occupant_id, 'rural_land_parcels');
            if (empty($ex_details)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }

            $this->db->trans_start();
            $t_array = array('khata_number' => $khata_number, 'is_assign_kn' => VALUE_ONE);
            if (is_admin() || $session_district == TALUKA_DAMAN) {
                $this->utility_model->update_data('village', $ex_details['village'], 'rural_land_parcels', $t_array, 'survey', $ex_details['survey'], 'subdiv', $ex_details['subdiv']);
            } else if ($session_district == TALUKA_DIU) {
                $this->utility_model->update_data('village', $ex_details['village'], 'rural_land_parcels_diu', $t_array, 'survey', $ex_details['survey'], 'subdiv', $ex_details['subdiv']);
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

    function download_excel_for_assign_khata_number_v2() {
        try {
            $user_id = get_from_session('temp_id_for_sugam_admin');
            if (!is_post() || $user_id == null || !$user_id) {
                print_r(INVALID_ACCESS_MESSAGE);
                return false;
            }
            $session_district = get_from_session('temp_district_for_sugam_admin');
            $search_village = get_from_post('village_for_aknv2ge');
            $search_survey = get_from_post('survey_number_for_aknv2ge');
            $search_subdiv = get_from_post('subdivision_number_for_aknv2ge');
            $search_occupant_name = get_from_post('occupant_name_for_aknv2ge');
            $this->db->trans_start();
            $excel_data = $this->assign_khata_number_v2_model->get_records_for_excel_for_assign_khata_number_v2($session_district, $search_village, $search_survey, $search_subdiv, $search_occupant_name);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                print_r(INVALID_ACCESS_MESSAGE);
                return;
            }
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=assign_khata_number_v2_excel_' . date('Y-m-d H:i:s') . '.csv');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            $output = fopen("php://output", "w");
            fputcsv($output, array('Village Name', 'Survey', 'Subdiv', 'Area', 'Owner Type', 'Occupant Name', 'Mutation Number', 'Nature', 'Khata Number'));
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
}

/*
 * EOF: ./application/controller/Assign_khata_number_v2.php
 */