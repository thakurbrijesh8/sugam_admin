<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assign_khata_number_v2_model extends CI_Model {

    function get_assign_khata_number_v2_data($session_district = '', $search_village = '', $search_survey = '', $search_subdiv = '', $search_occupant_name = '') {
        $this->db->select('*');

        $this->_from_assign_khata_number_v2($session_district, $search_village, $search_survey, $search_subdiv, $search_occupant_name);

        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _from_assign_khata_number_v2($session_district, $search_village = '', $search_survey = '', $search_subdiv = '', $search_occupant_name = '') {
        if ($search_village != '') {
            $this->db->where('village', $search_village);
        }
        if ($search_survey != '') {
            $this->db->where('survey', $search_survey);
        }
        if ($search_subdiv != '') {
            $this->db->where('subdiv', $search_subdiv);
        }
        if ($search_occupant_name != '') {
            $this->db->like('joint_occupants', $search_occupant_name);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('is_assign_kn', VALUE_ZERO);
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('village', explode(',', $av));
            }
        }
        $this->db->from('rural_land_parcels');
        $this->db->order_by('village, joint_occupants');
        $this->db->group_by('village, survey, subdiv');
    }

    function get_records_for_excel_for_assign_khata_number_v2($session_district = '', $search_village = '', $search_survey = '', $search_subdiv = '', $search_occupant_name = '') {
        $this->db->select('village_name, survey, subdiv, area, owner_type, joint_occupants, mutation_number, nature, khata_number');

        $this->_from_assign_khata_number_v2($session_district, $search_village, $search_survey, $search_subdiv, $search_occupant_name);

        $resc = $this->db->get();
        return $resc->result_array();
    }
}

/*
 * EOF: ./application/models/Assign_khata_number_v2_model.php
 */
