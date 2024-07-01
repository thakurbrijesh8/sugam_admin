<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Na_application extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('na_application_model');
    }

    function get_na_application_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = array();
            $success_array['na_application_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }

            $session_district = get_from_session('temp_district_for_sugam_admin');
            $columns = $this->input->post('columns');
            if (is_admin()) {
                $search_application_number = trim($columns[1]['search']['value']);
                $search_district = trim($columns[3]['search']['value']);
                $search_name_of_applicant = trim($columns[4]['search']['value']);
                $search_status = trim($columns[7]['search']['value']);
            } else {
                $search_district = $session_district;
                $search_application_number = trim($columns[1]['search']['value']);
                $search_name_of_applicant = trim($columns[3]['search']['value']);
                $search_status = trim($columns[6]['search']['value']);
            }
            $start = get_from_post('start');
            $length = get_from_post('length');
            $this->db->trans_start();

            $temp_na_data = $this->na_application_model->get_all_na_application_list($start, $length, $search_district, $search_application_number, $search_name_of_applicant, $search_status);
            $na_data = array();
            if (!empty($temp_na_data)) {
                foreach ($temp_na_data as $tna) {
                    if (!isset($na_data[$tna['na_application_id']])) {
                        $na_data[$tna['na_application_id']] = array();
                        $na_data[$tna['na_application_id']]['na_application_id'] = $tna['na_application_id'];
                        $na_data[$tna['na_application_id']]['application_number'] = $tna['application_number'];
                        $na_data[$tna['na_application_id']]['user_id'] = $tna['user_id'];
                        $na_data[$tna['na_application_id']]['district'] = $tna['district'];
                        $na_data[$tna['na_application_id']]['applicant_info'] = $tna['applicant_info'];
                        $na_data[$tna['na_application_id']]['submitted_datetime'] = $tna['submitted_datetime'];
                        $na_data[$tna['na_application_id']]['status'] = $tna['status'];
                        $na_data[$tna['na_application_id']]['status_datetime'] = $tna['status_datetime'];
                        $na_data[$tna['na_application_id']]['processing_days'] = $tna['processing_days'];
                        $na_data[$tna['na_application_id']]['query_status'] = $tna['query_status'];
                        $na_data[$tna['na_application_id']]['query_id'] = $tna['query_id'];
                        $na_data[$tna['na_application_id']]['query_by_name'] = $tna['query_by_name'];
                        $na_data[$tna['na_application_id']]['query_datetime'] = $tna['query_datetime'];
                        $na_data[$tna['na_application_id']]['land_details'] = array();
                    }
                    $temp_land_details = array();
                    $temp_land_details['na_application_ld_id'] = $tna['na_application_ld_id'];
                    $temp_land_details['village'] = $tna['village'];
                    $temp_land_details['survey'] = $tna['survey'];
                    $temp_land_details['subdiv'] = $tna['subdiv'];
                    $temp_land_details['total_area'] = $tna['total_area'];
                    $temp_land_details['area'] = $tna['area'];
                    array_push($na_data[$tna['na_application_id']]['land_details'], $temp_land_details);
                }
                rsort($na_data);
            }
            $success_array['na_application_data'] = $na_data;
            $success_array['recordsTotal'] = $this->na_application_model->get_total_count_of_records($search_district);
            if (($search_district != '' && is_admin()) || $search_application_number != '' || $search_name_of_applicant != '' || $search_status != '') {
                $success_array['recordsFiltered'] = $this->na_application_model->get_filter_count_of_records($search_district, $search_application_number, $search_name_of_applicant, $search_status);
            } else {
                $success_array['recordsFiltered'] = $success_array['recordsTotal'];
            }
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['na_application_data'] = array();
            echo json_encode($success_array);
        }
    }

    function get_na_data_by_id() {
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
            $na_application_id = get_from_post('na_application_id');
            if (!$na_application_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $na_data = $this->utility_model->get_by_id('na_application_id', $na_application_id, 'na_application');
            if (empty($na_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $na_ld_data = $this->utility_model->get_result_data_by_id('na_application_id', $na_application_id, 'na_application_ld', null, null, 'na_application_ld_id', 'DESC');
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['na_data'] = $na_data;
            $success_array['na_ld_data'] = $na_ld_data;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/WC.php
 */