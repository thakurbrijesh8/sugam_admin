<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Circle_rate_model extends CI_Model {

    function get_circle_rate_data() {
        $this->db->select('cr.*,r.district, r.city, r.panchayat_name');
        $this->db->where('cr.is_delete !=' . IS_DELETE);
        $this->db->from('pmv_cr AS cr');
        $this->db->join('pmv_relation AS r', 'r.pmv_relation_id = cr.pmv_relation_id', 'LEFT');
        $resc = $this->db->get();
        return $resc->result_array();
    }

}

/*
 * EOF: ./application/models/Circle_rate_model.php
 */