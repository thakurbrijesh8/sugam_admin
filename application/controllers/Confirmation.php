<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Confirmation extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $temp_access_token = $this->input->get('q');
        if (!$temp_access_token) {
            $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
            return;
        }
        header("Location: " . PROJECT_PATH . "confirmation?q=" . $temp_access_token);
    }

}

/*
 * EOF: ./application/controllers/Confirmation.php
 */