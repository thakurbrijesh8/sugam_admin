<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Circle_rate extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_authenticated();
        $this->load->model('utility_model');
        $this->load->model('circle_rate_model');
    }

    function get_circle_rate_data() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $success_array = get_success_array();
            $success_array['circle_rate_data'] = array();
            if ($session_user_id == NULL || !$session_user_id) {
                echo json_encode($success_array);
                return false;
            }
            $this->db->trans_start();
            $success_array['circle_rate_data'] = $this->circle_rate_model->get_circle_rate_data();
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode($success_array);
                return;
            }
            echo json_encode($success_array);
        } catch (\Exception $e) {
            $success_array['circle_rate_data'] = array();
            echo json_encode($success_array);
        }
    }

    function update_circle_rate() {
        try {
            if (!is_ajax()) {
                header("Location:" . base_url() . "login");
                return false;
            }
            $session_user_id = get_from_session('temp_id_for_sugam_admin');
            $pmv_cr_id = get_from_post('pmv_cr_id');
            if (!is_post() || $session_user_id == NULL || !$session_user_id || $pmv_cr_id == NULL || !$pmv_cr_id) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $circle_rate = get_from_post('circle_rate');
            if (!$circle_rate) {
                echo json_encode(get_error_array(RATE_MESSAGE));
                return false;
            }
            $ex_pmv_cr_data = $this->utility_model->get_by_id('pmv_cr_id', $pmv_cr_id, 'pmv_cr');
            if (empty($ex_pmv_cr_data)) {
                echo json_encode(get_error_array(INVALID_ACCESS_MESSAGE));
                return false;
            }
            $this->db->trans_start();
            $step_one_data['pmv_rate'] = $circle_rate;
            $step_one_data['updated_by'] = $session_user_id;
            $step_one_data['updated_time'] = date('Y-m-d H:i:s');
            $this->utility_model->update_data('pmv_cr_id', $pmv_cr_id, 'pmv_cr', $step_one_data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(get_error_array(DATABASE_ERROR_MESSAGE));
                return;
            }
            $success_array = get_success_array();
            $success_array['message'] = RATE_UPDATED_MESSAGE;
            echo json_encode($success_array);
        } catch (\Exception $e) {
            echo json_encode(get_error_array($e->getMessage()));
            return false;
        }
    }
}

/*
 * EOF: ./application/controller/Circle_rate.php
 */