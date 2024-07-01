<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    function get_dapvr_dashboard_data($search_district) {
        if ($search_district != '') {
            $this->db->where('district', $search_district);
        }
        $this->db->from('view_get_dapve_status_wise_cases');

        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_document_registration_dashboard_data($search_district) {
        $this->db->select('count(document_registration_id) as total_records, status, query_status, appointment_date');
        $this->db->where('is_delete !=' . IS_DELETE);
        if ($search_district != '') {
            $this->db->where('district', $search_district);
        }
        $this->db->from('document_registration');
        $this->db->group_by('status,query_status,appointment_date');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_cert_count_for_dashboard($session_user_id, $search_district, $m_id, $m_name, $m_vf, $m_type) {
        if (is_talathi_user()) {
            $this->db->select("count($m_id) AS total_app, district, status, query_status, appointment_status, talathi, "
                    . "talathi_to_aci, to_type_reverify, talathi_to_type_reverify");
        } else if (is_aci_user()) {
            if ($m_type == VALUE_FOUR || $m_type == VALUE_FIVE) {
                $this->db->select("count($m_id) AS total_app, district, status, query_status, appointment_status, "
                        . "to_type_reverify, aci_to_mamlatdar, aci_to_ldc, aci_rec, talathi_to_type_reverify, aci_rec_reverify, "
                        . "aci_to_m_ldc");
            } else {
                $this->db->select("count($m_id) AS total_app, district, status, query_status,appointment_status, "
                        . "to_type_reverify, aci_to_mamlatdar, aci_to_ldc, aci_rec, talathi_to_type_reverify,aci_rec_reverify");
            }
        } else if (is_ldc_user()) {
            $this->db->select("count($m_id) AS total_app, district, status, query_status, appointment_status, "
                    . "ldc_to_mamlatdar,aci_to_ldc, aci_rec_reverify, to_type_reverify, talathi_to_type_reverify");
        } else if (is_mamlatdar_user()) {
            $this->db->select("count($m_id) AS total_app, district, status, query_status, appointment_status, "
                    . "to_type_reverify, aci_rec_reverify, ldc_to_mamlatdar, talathi_to_type_reverify ");
        } else {
            $this->db->select("count($m_id) AS total_app, district, status, query_status, appointment_status");
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        if ($search_district != '') {
            $this->db->where('district', $search_district);
        }
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in($m_vf, explode(',', $av));
            }
        }
        if (is_aci_user()) {
            $aci_where = "(talathi_to_aci = $session_user_id OR status = " . VALUE_SIX . ")";
            $this->db->where($aci_where);
        }
        if (is_mamlatdar_user()) {
            $mam_where = "(aci_to_mamlatdar = $session_user_id OR ldc_to_mamlatdar = $session_user_id OR status = " . VALUE_SIX . ")";
            $this->db->where($mam_where);
        }
        if (is_ldc_user()) {
            if ($m_type == VALUE_FOUR || $m_type == VALUE_FIVE) {
                $this->db->where("(aci_to_ldc = $session_user_id OR aci_to_m_ldc = $session_user_id)");
            } else {
                $this->db->where('aci_to_ldc', $session_user_id);
            }
        }
        $this->db->where('status != ' . VALUE_ZERO);
        $this->db->where('status != ' . VALUE_ONE);
        $this->db->from($m_name);
        if (is_talathi_user()) {
            $this->db->group_by('district, status, query_status, appointment_status, talathi, to_type_reverify, '
                    . 'talathi_to_aci, talathi_to_type_reverify');
        } else if (is_aci_user()) {
            $this->db->group_by('district, status, query_status, to_type_reverify,appointment_status, '
                    . 'aci_to_mamlatdar, aci_to_ldc, aci_rec, talathi_to_type_reverify, aci_rec_reverify');
        } else if (is_ldc_user()) {
            $this->db->group_by('district, status, query_status, appointment_status, '
                    . 'ldc_to_mamlatdar, aci_to_ldc, aci_rec_reverify, to_type_reverify, talathi_to_type_reverify');
        } else if (is_mamlatdar_user()) {
            $this->db->group_by('district, status, query_status, appointment_status, '
                    . 'to_type_reverify, aci_rec_reverify, ldc_to_mamlatdar, talathi_to_type_reverify');
        } else {
            $this->db->group_by('district, status, query_status, appointment_status');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_crsr_cert_count_for_dashboard($session_user_id, $search_district, $m_id, $m_name) {
        if ($search_district != '') {
            $this->db->where('district', $search_district);
        }
        $this->db->from('view_status_wise_' . $m_name);
        $this->db->group_by('district, status, query_status');
        $resc = $this->db->get();
        //print_r($this->db->last_query());   
        return $resc->result_array();
    }

    function get_fees_status_count_for_dashboard($session_user_id, $search_district, $m_id, $m_name, $m_vf, $m_type) {
        if ($search_district != '') {
            $this->db->where('district', $search_district);
        }
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in($m_vf, explode(',', $av));
            }
        }
        $this->db->from('view_status_wise_' . $m_name);
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_general_application_status_count_for_dashboard($session_user_id, $search_district, $m_id, $m_name, $m_vf, $m_type) {
        $t_type = get_from_session('temp_type_for_sugam_admin');
        if (!is_admin()) {
            $this->db->select($t_type . '_total_app AS total_app, ' . $t_type . '_new AS new_app, '
                    . $t_type . '_forwarded AS forwarded_app, village, district, status, query_status');
        } else {
            $this->db->select('(4_total_app) AS total_app, (4_new + 2_new + 3_new + 6_new) AS new_app, (4_forwarded + 2_forwarded + 3_forwarded + 6_forwarded) AS forwarded_app, village, district, '
                    . 'status, query_status');
        }
        if ($search_district != '') {
            $this->db->where('district', $search_district);
        }
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in($m_vf, explode(',', $av));
            }
        }
        $this->db->from('view_status_wise_general_application');
        $resc = $this->db->get();
        return $resc->result_array();
    }

}

/*
 * EOF: ./application/models/Dashboard_model.php
 */