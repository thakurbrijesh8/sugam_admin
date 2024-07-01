<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Khata_number_model extends CI_Model {

    function get_all_khata_number_list($session_district = '', $search_village = '', $search_survey = '', $search_subdiv = '', $search_khata_number = '', $search_occupant_name = '') {
        $this->db->select('occupant_id, khata_number, village, village_name, devnagari, IF(owner_type=1, occupant_name, joint_occupants) AS occupant_details');
        $this->_from_khata_number($session_district, $search_village, $search_survey, $search_subdiv, $search_khata_number, $search_occupant_name);
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _from_khata_number($session_district, $search_village = '', $search_survey = '', $search_subdiv = '', $search_khata_number = '', $search_occupant_name = '', $is_excel = false) {
        if ($search_village != '') {
            $this->db->where('village', $search_village);
        }
        if ($search_survey != '') {
            $this->db->where('survey', $search_survey);
        }
        if ($search_subdiv != '') {
            $this->db->where('subdiv', $search_subdiv);
        }
        if ($search_khata_number != '') {
            $this->db->where('khata_number', $search_khata_number);
        }
        if ($search_occupant_name != '') {
            $where = "(occupant_name LIKE '%$search_occupant_name%' OR "
                    . "aadhar_card_number LIKE '%$search_occupant_name%' OR "
                    . "mobile_number LIKE '%$search_occupant_name%')";
            $this->db->where($where);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('is_assign_kn', VALUE_ONE);
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('village', explode(',', $av));
            }
        }
        if (is_admin() || $session_district == TALUKA_DAMAN) {
            $this->db->from('rural_land_parcels');
        } else if ($session_district == TALUKA_DIU) {
            $this->db->from('rural_land_parcels_diu');
        }
        if ($is_excel) {
            $this->db->order_by('village, khata_number');
        } else {
            $this->db->group_by('village, khata_number');
        }
    }

    function get_all_land_detail_by_khata_id($session_district, $khata_number, $village) {
        $this->db->where('khata_number', $khata_number);
        $this->db->where('village', $village);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('is_assign_kn', VALUE_ONE);
        if (is_admin() || $session_district == TALUKA_DAMAN) {
            $this->db->from('rural_land_parcels');
        } else if ($session_district == TALUKA_DIU) {
            $this->db->from('rural_land_parcels_diu');
        }
        $this->db->order_by('nature, survey, subdiv');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_records_for_excel_for_khata_number($session_district = '', $search_village = '', $search_survey = '', $search_subdiv = '', $search_khata_number = '', $search_occupant_name = '') {
        $this->db->select('village_name, khata_number, survey, subdiv, area, owner_type, occupant_name, joint_occupants, aadhar_card_number, mobile_number');

        $this->_from_khata_number($session_district, $search_village, $search_survey, $search_subdiv, $search_khata_number, $search_occupant_name, true);

        $resc = $this->db->get();
        return $resc->result_array();
    }

}

/*
 * EOF: ./application/models/Khata_number_model.php
 */