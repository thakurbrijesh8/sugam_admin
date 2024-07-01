<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Svamitva_ror_model extends CI_Model {

    function get_all_svamitva_ror_list($start, $length, $search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_village = '', $search_status = '', $s_plan_status = '', $search_svamitva_ror_id = '') {
        $this->db->select('r.*, sau.name AS actioner_user_name');

        $this->_bd_for_search_sror($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_village, $search_status, $s_plan_status, $search_svamitva_ror_id);

        $this->db->limit($length, $start);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('svamitva_ror AS r');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        if ($search_status == VALUE_FIVE || $search_status == VALUE_SIX) {
            $this->db->order_by('r.status_datetime', 'DESC');
        } else {
            $this->db->order_by('r.status, r.submitted_datetime', 'ASC');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _bd_for_search_sror($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_village, $search_status, $s_plan_status, $search_svamitva_ror_id) {
        if ($search_district != '') {
            $this->db->where('r.district', $search_district);
        }
        if ($search_application_number != '') {
            $this->db->like('r.application_number', $search_application_number);
        }
        if ($search_application_date != '') {
            $this->db->like("DATE_FORMAT(r.submitted_datetime,'%d-%m-%Y %H:%i:%s')", $search_application_date);
        }
        if ($search_applicant_details != '') {
            $where = "(r.applicant_name LIKE '%$search_applicant_details%' OR "
                    . "r.father_name LIKE '%$search_applicant_details%' OR "
                    . "r.surname LIKE '%$search_applicant_details%' OR "
                    . "r.address LIKE '%$search_applicant_details%' OR "
                    . "r.mobile_number LIKE '%$search_applicant_details%')";
            $this->db->where($where);
        }
        if ($search_village != '') {
            $this->db->where('r.village', $search_village);
        }
        if ($search_status != '') {
            if ($search_status == VALUE_TWO && $s_plan_status == '') {
                $this->db->where('r.plan_status', VALUE_ZERO);
            } else if ($search_status == VALUE_TWO && $s_plan_status == VALUE_ONE) {
                $this->db->where('r.plan_status', VALUE_ONE);
            } else {
                $this->db->where('r.status', $search_status);
            }
        }
        if ($search_svamitva_ror_id != '') {
            $this->db->where('r.svamitva_ror_id', $search_svamitva_ror_id);
        }
        if ($s_plan_status != '') {
            if ($s_plan_status == VALUE_ONE) {
                $this->db->where_in('r.plan_status', array(VALUE_ZERO, VALUE_ONE));
            } else {
                $this->db->where('r.plan_status', $s_plan_status);
            }
        }

        $this->_bd_for_session_id();
    }

    function _bd_for_session_id() {
        $status_array = array(VALUE_ZERO, VALUE_ONE);
        if (is_eocs_jfs_user()) {
            $status_array = array(VALUE_ZERO, VALUE_ONE);
        }
        $this->db->where_not_in('r.status', $status_array);
    }

    function get_total_count_of_records($search_district) {
        $this->db->select('COUNT(r.svamitva_ror_id) AS total_records');
        if ($search_district != '') {
            $this->db->where('r.district', $search_district);
        }

        $this->_bd_for_session_id();

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('svamitva_ror AS r');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_village = '', $search_status = '', $s_plan_status = '', $search_svamitva_ror_id = '') {
        $this->db->select('COUNT(r.svamitva_ror_id) AS total_records');

        $this->_bd_for_search_sror($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_village, $search_status, $s_plan_status, $search_svamitva_ror_id);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('svamitva_ror AS r');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_pending_generate_copy_details($module_type, $module_id) {
        $this->db->where('module_type', $module_type);
        $this->db->where('module_id', $module_id);
        $this->db->where('copies != total_copy_generated');
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('form_land_details');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_pc_data_with_land_details($module_type, $form_land_details_id, $is_full_data = false) {
        $sql = 'pc.svamitva_ror_id, pc.district, pc.application_number, pc.status, pc.plan_status, pc.land_details, '
                . 'pc.applicant_name, pc.father_name, pc.surname, pc.spouse_name, pc.mobile_number, pc.email, '
                . 'pc.address, pc.purpose, pc.total_copies, pc.total_amount, pc.ld_area_type, pc.ld_village_sc, '
                . 'fld.*';
        if ($is_full_data != false) {
            $sql .= ', pd.reference_id, pd.op_transaction_datetime';
        }
        $this->db->select($sql);
        $this->db->where('fld.module_type', $module_type);
        $this->db->where('fld.form_land_details_id', $form_land_details_id);
        $this->db->where('fld.is_delete !=' . IS_DELETE);
        $this->db->from('form_land_details AS fld');
        $this->db->join('svamitva_ror AS pc', 'fld.module_id=pc.svamitva_ror_id');
        if ($is_full_data != false) {
            $this->db->join('fees_payment AS pd', 'pd.reference_number=pc.last_op_reference_number');
        }
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_form_data_with_land_details($module_type, $form_land_details_id, $is_full_data = false) {
        $sql = 'sror.svamitva_ror_id, sror.district, sror.application_number, sror.status, sror.land_details, '
                . 'sror.applicant_name, sror.father_name, sror.surname, sror.spouse_name, sror.mobile_number, sror.email, '
                . 'sror.address, sror.purpose, sror.total_copies,sror.village, fld.*';
        if ($is_full_data != false) {
            $sql .= ', duv.village_name';
        }
        $this->db->select($sql);
        $this->db->where('fld.module_type', $module_type);
        $this->db->where('fld.form_land_details_id', $form_land_details_id);
        $this->db->where('fld.is_delete !=' . IS_DELETE);
        $this->db->from('form_land_details AS fld');
        $this->db->join('svamitva_ror AS sror', 'fld.module_id=sror.svamitva_ror_id');
        if ($is_full_data != false) {
            $this->db->join('daman_urban_villages AS duv', 'sror.village=duv.village');
        }
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_daman_urban_ror_data($village, $survey_number, $subdiv_number) {
        $this->db->select('fld.*');
        $this->db->where('fld.village', $village);
        $this->db->where('fld.pts_gtw', $survey_number);
        $this->db->where('fld.cl_pt', $subdiv_number);
        $this->db->where('fld.is_svamitva =' . IS_SVAMITVA);
        $this->db->where('fld.is_delete !=' . IS_DELETE);
        $this->db->from('urban_land_parcels AS fld');
        $resc = $this->db->get();
        return $resc->row_array();
    }

}

/*
 * EOF: ./application/models/Svamitva_ror_model.php
 */