<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Na_application_model extends CI_Model {

    function get_all_na_application_list($start, $length, $search_district = '', $search_application_number = '', $search_applicant_name = '', $search_status = '') {
        $this->db->select('n.na_application_id, n.application_number, n.user_id, n.district, n.applicant_info, '
                . 'n.submitted_datetime, n.status, n.status_datetime, n.processing_days, n.query_status, '
                . 'nld.na_application_ld_id, nld.village, nld.survey, nld.subdiv, nld.total_area, nld.area, '
                . 'q.query_id, q.query_by_name, q.query_datetime');
        if ($search_district != '') {
            $this->db->where('n.district', $search_district);
        }
        if ($search_application_number != '') {
            $this->db->like('n.application_number', $search_application_number);
        }
        if ($search_applicant_name != '') {
            $this->db->like('n.applicant_names', $search_applicant_name);
        }
        if ($search_status != '') {
            $this->db->where('n.status', $search_status);
        }
        $this->db->limit($length, $start);
        $this->db->where('n.is_delete !=' . IS_DELETE);
        $this->db->where('n.status != ' . VALUE_ZERO);
        $this->db->where('n.status != ' . VALUE_ONE);
        $this->db->from('na_application AS n');
        $this->db->join('na_application_ld AS nld', 'nld.na_application_id = n.na_application_id AND nld.is_delete !=' . IS_DELETE, 'LEFT');
        $this->db->join('query AS q', 'q.query_id = (SELECT max(query_id) FROM query WHERE module_type = ' . VALUE_EIGHT . ' AND module_id = n.na_application_id AND is_delete != ' . VALUE_ONE . ')', 'LEFT');
        $this->db->order_by('n.status', 'ASC');
        $this->db->order_by('n.na_application_id', 'DESC');
//        print_r($this->db->last_query());
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_total_count_of_records($search_district) {
        $this->db->select('COUNT(na_application_id) AS total_records');
        if (!is_admin()) {
            $this->db->where('district', $search_district);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('status != ' . VALUE_ZERO);
        $this->db->where('status != ' . VALUE_ONE);
        $this->db->from('na_application');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($search_district = '', $search_application_number = '', $search_applicant_name = '', $search_status = '') {
        $this->db->select('COUNT(n.na_application_id) AS total_records');
        if ($search_district != '') {
            $this->db->where('n.district', $search_district);
        }
        if ($search_application_number != '') {
            $this->db->like('n.application_number', $search_application_number);
        }
        if ($search_applicant_name != '') {
            $this->db->like('n.applicant_names', $search_applicant_name);
        }
        if ($search_status != '') {
            $this->db->where('n.status', $search_status);
        }
        $this->db->where('n.is_delete !=' . IS_DELETE);
        $this->db->where('n.status != ' . VALUE_ZERO);
        $this->db->where('n.status != ' . VALUE_ONE);
        $this->db->from('na_application AS n');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }
}

/*
 * EOF: ./application/models/Na_application_model.php
 */