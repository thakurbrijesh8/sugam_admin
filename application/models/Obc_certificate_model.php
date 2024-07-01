<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Obc_certificate_model extends CI_Model {

    function get_all_obc_certificate_list($start, $length, $s_district = '', $s_app_no = '', $s_app_date = '', $s_app_det = '', $s_vdw = '', $s_app_status = '', $s_co_hand = '', $s_qstatus = '', $s_status = '') {
        $this->db->select("r.*,date_format(r.created_time, '%d-%m-%Y %H:%i:%s') AS display_datetime, "
                . "sat.name AS talathi_name, saa.name AS aci_name, IF(r.aci_rec=1,salm.name, IF(r.aci_rec=2,sam.name, IF(r.aci_rec=3,salm.name,salm.name))) AS mamlatdar_name, "
                . "sal.name AS ldc_name,salmig.name AS ldc_name_m, sau.name AS actioner_user_name,u.applicant_name as reg_user_name,u.mobile_number as reg_user_mobile_number,u.email as reg_user_email, "
                . "q.query_id, q.query_by_name, q.query_datetime");

        $this->_bd_for_search_oc($s_district, $s_app_no, $s_app_date, $s_app_det, $s_vdw, $s_app_status, $s_co_hand, $s_qstatus, $s_status);

        $this->db->limit($length, $start);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('obc_certificate AS r');
        $this->db->join('sa_users AS sat', 'sat.sa_user_id = r.talathi AND r.talathi != 0', 'LEFT');
        $this->db->join('sa_users AS saa', 'saa.sa_user_id = r.talathi_to_aci AND r.talathi_to_aci != 0', 'LEFT');
        $this->db->join('sa_users AS sam', 'sam.sa_user_id = r.aci_to_mamlatdar AND r.aci_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users AS sal', 'sal.sa_user_id = r.aci_to_ldc AND r.aci_to_ldc != 0', 'LEFT');
        $this->db->join('sa_users AS salmig', 'salmig.sa_user_id = r.aci_to_m_ldc AND r.aci_to_m_ldc != 0', 'LEFT');
        $this->db->join('sa_users AS salm', 'salm.sa_user_id = r.ldc_to_mamlatdar AND r.ldc_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        $this->db->join('query AS q', 'q.query_id = (SELECT max(query_id) FROM query WHERE module_type = ' . VALUE_FIVE . ' AND module_id = r.obc_certificate_id AND is_delete != ' . VALUE_ONE . ')', 'LEFT');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        if ($s_status == VALUE_FIVE || $s_status == VALUE_SIX) {
            $this->db->order_by('r.status_datetime', 'DESC');
        } else {
            $this->db->order_by('r.status, r.submitted_datetime', 'ASC');
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_total_count_of_records($s_district) {
        $this->db->select('COUNT(r.obc_certificate_id) AS total_records');
        if (!is_admin()) {
            $this->db->where('r.district', $s_district);
        }

        $this->_bd_for_session_id();

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('obc_certificate AS r');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($s_district = '', $s_app_no = '', $s_app_date = '', $s_app_det = '', $s_vdw = '', $s_app_status = '', $s_co_hand = '', $s_qstatus = '', $s_status = '') {
        $this->db->select('COUNT(r.obc_certificate_id) AS total_records');

        $this->_bd_for_search_oc($s_district, $s_app_no, $s_app_date, $s_app_det, $s_vdw, $s_app_status, $s_co_hand, $s_qstatus, $s_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('obc_certificate AS r');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function _bd_for_search_oc($s_district, $s_app_no, $s_app_date, $s_app_det, $s_vdw, $s_app_status, $s_co_hand, $s_qstatus, $s_status) {
        if ($s_district != '') {
            $this->db->where('r.district', $s_district);
        }
        if ($s_app_no != '') {
            $this->db->like('r.application_number', $s_app_no);
        }
        if ($s_app_date != '') {
            $this->db->like("DATE_FORMAT(r.submitted_datetime,'%d-%m-%Y %H:%i:%s')", $s_app_date);
        }
        if ($s_app_det != '') {
            $where = "(r.applicant_name LIKE '%$s_app_det%' OR "
                    . "r.com_addr_house_no  LIKE '%$s_app_det%' OR "
                    . "r.com_addr_house_name  LIKE '%$s_app_det%' OR "
                    . "r.com_addr_street  LIKE '%$s_app_det%' OR "
                    . "r.com_addr_village_dmc_ward  LIKE '%$s_app_det%' OR "
                    . "r.com_pincode  LIKE '%$s_app_det%' OR "
                    . "r.mobile_number LIKE '%$s_app_det%')";
            $this->db->where($where);
        }
        if ($s_vdw != '') {
            $this->db->where('r.village_name', $s_vdw);
        }
        if ($s_app_status != '' && (is_admin() || is_talathi_user())) {
            if ($s_app_status == VALUE_ONE || $s_app_status == VALUE_TWO || $s_app_status == VALUE_THREE) {
                if ($s_app_status == VALUE_ONE) {
                    $ad = date('Y-m-d', strtotime("-1 days"));
                }
                if ($s_app_status == VALUE_TWO) {
                    $ad = date('Y-m-d');
                }
                if ($s_app_status == VALUE_THREE) {
                    $ad = date('Y-m-d', strtotime("+1 days"));
                }
                $this->db->where('r.appointment_date', $ad);
            }
            if ($s_app_status == VALUE_FOUR) {
                $this->db->where('r.appointment_status', VALUE_ZERO);
            }
            if ($s_app_status == VALUE_FIVE) {
                $this->db->where('r.appointment_status', VALUE_ONE);
            }
            if ($s_app_status == VALUE_FOUR || $s_app_status == VALUE_FIVE) {
                $this->db->where('r.query_status !=' . VALUE_ONE);
                $this->db->where('r.query_status !=' . VALUE_TWO);
                $this->db->where('r.status != ' . VALUE_THREE);
                $this->db->where('r.status != ' . VALUE_FIVE);
                $this->db->where('r.status != ' . VALUE_SIX);
            }
        }
        if ($s_co_hand != '') {
            if (is_talathi_user()) {
                if ($s_co_hand == VALUE_ONE) {
                    $this->db->where('(r.talathi=' . VALUE_ZERO . ' AND r.talathi_to_aci=' . VALUE_ZERO . ' AND r.to_type_reverify=' . VALUE_ZERO . ')');
                }
                if ($s_co_hand == VALUE_TWO) {
                    $this->db->where('((r.talathi!=' . VALUE_ZERO . ' AND r.talathi_to_aci!=' . VALUE_ZERO . ') AND (r.to_type_reverify=' . VALUE_ZERO . ' OR r.to_type_reverify=' . VALUE_TWO . ') AND (r.talathi_to_type_reverify=' . VALUE_ZERO . '))');
                }
                if ($s_co_hand == VALUE_THREE) {
                    $this->db->where('(r.to_type_reverify=' . VALUE_ONE . ' AND r.talathi_to_type_reverify=' . VALUE_ZERO . ')');
                }
                if ($s_co_hand == VALUE_FOUR) {
                    $this->db->where('(r.talathi_to_type_reverify=' . VALUE_ONE . ' OR r.talathi_to_type_reverify=' . VALUE_TWO . ')');
                }
            }

            if (is_aci_user()) {
                if ($s_co_hand == VALUE_ONE) {
                    $this->db->where('((r.aci_to_mamlatdar=' . VALUE_ZERO . ' AND r.aci_to_ldc=' . VALUE_ZERO . ' AND r.aci_to_m_ldc=' . VALUE_ZERO . ') AND r.to_type_reverify=' . VALUE_ZERO . ')');
                }
                if ($s_co_hand == VALUE_TWO) {
                    $this->db->where('(((r.aci_to_mamlatdar!=' . VALUE_ZERO . ' AND r.aci_rec=' . VALUE_TWO . ') '
                            . 'OR (r.aci_to_ldc!=' . VALUE_ZERO . ' AND r.aci_rec=' . VALUE_ONE . ') '
                            . 'OR (r.aci_to_m_ldc!=' . VALUE_ZERO . ' AND r.aci_rec=' . VALUE_THREE . ')) '
                            . 'AND (r.to_type_reverify=' . VALUE_ZERO . ' OR r.to_type_reverify=' . VALUE_ONE . ') '
                            . 'AND (r.talathi_to_type_reverify=' . VALUE_ZERO . ' OR r.talathi_to_type_reverify=' . VALUE_TWO . '))');
                }
                if ($s_co_hand == VALUE_THREE) {
                    $this->db->where('(((r.to_type_reverify=' . VALUE_TWO . ') OR (r.to_type_reverify=' . VALUE_ONE . ' AND r.talathi_to_type_reverify=' . VALUE_ONE . ' )) AND '
                            . '(r.aci_rec_reverify=' . VALUE_ZERO . '))');
                }
                if ($s_co_hand == VALUE_FOUR) {
                    $this->db->where('((r.aci_rec_reverify=' . VALUE_ONE . ' OR r.aci_rec_reverify=' . VALUE_TWO . ' OR r.aci_rec_reverify=' . VALUE_THREE . ') '
                            . 'AND (r.talathi_to_type_reverify=' . VALUE_ZERO . ' OR r.talathi_to_type_reverify=' . VALUE_ONE . '))');
                }
            }

            if (is_ldc_user()) {
                if ($s_co_hand == VALUE_ONE) {
                    $this->db->where('((r.aci_rec=' . VALUE_ONE . ' OR r.aci_rec=' . VALUE_THREE . ') AND r.ldc_to_mamlatdar=' . VALUE_ZERO . ' AND r.to_type_reverify=' . VALUE_ZERO . ')');
                }
                if ($s_co_hand == VALUE_TWO) {
                    $this->db->where('(r.ldc_to_mamlatdar!=' . VALUE_ZERO . ' AND r.to_type_reverify=' . VALUE_ZERO . ')');
                }
                if ($s_co_hand == VALUE_THREE) {
                    $this->db->where('((r.aci_to_ldc!=' . VALUE_ZERO . ' AND r.aci_rec_reverify=' . VALUE_ONE . ') '
                            . 'AND (r.to_type_reverify=' . VALUE_ONE . ' OR r.to_type_reverify=' . VALUE_TWO . ' OR r.to_type_reverify=' . VALUE_THREE . ') '
                            . 'AND r.ldc_to_mamlatdar=' . VALUE_ZERO . ')');
                }
                if ($s_co_hand == VALUE_FOUR) {
                    $this->db->where('(r.ldc_to_mamlatdar!=' . VALUE_ZERO . ' AND (r.to_type_reverify=' . VALUE_ONE . ' OR r.to_type_reverify=' . VALUE_TWO . '))');
                }
            }

            if (is_mamlatdar_user()) {
                if ($s_co_hand == VALUE_ONE) {
                    $this->db->where('((r.ldc_to_mamlatdar!=' . VALUE_ZERO . ' OR (r.aci_rec=' . VALUE_TWO . ' AND r.aci_to_mamlatdar!=' . VALUE_ZERO . ')) AND r.to_type_reverify=' . VALUE_ZERO . ')');
                }
                if ($s_co_hand == VALUE_THREE) {
                    $this->db->where('((r.to_type_reverify=' . VALUE_ONE . ' OR r.to_type_reverify=' . VALUE_TWO . ') AND '
                            . '(r.talathi_to_type_reverify=' . VALUE_TWO . ' OR r.aci_rec_reverify=' . VALUE_TWO . ' OR '
                            . '((r.aci_rec_reverify=' . VALUE_ONE . ' OR r.aci_rec_reverify=' . VALUE_THREE . ') AND r.ldc_to_mamlatdar!=' . VALUE_ZERO . ')))');
                }
                if ($s_co_hand == VALUE_FOUR) {
                    $this->db->where('((r.to_type_reverify=' . VALUE_ONE . ' OR r.to_type_reverify=' . VALUE_TWO . ') AND '
                            . '((r.talathi_to_type_reverify=' . VALUE_ZERO . ' OR r.talathi_to_type_reverify=' . VALUE_ONE . ') AND r.aci_rec_reverify=' . VALUE_ZERO . '))');
                }
            }

            $this->db->where('r.status != ' . VALUE_FIVE);
            $this->db->where('r.status != ' . VALUE_SIX);
            $this->db->where('r.query_status !=' . VALUE_ONE);
            $this->db->where('r.query_status !=' . VALUE_TWO);
        }
        if ($s_qstatus != '') {
            $this->db->where('r.query_status', $s_qstatus);
        }
        if ($s_status != '') {
            $this->db->where('r.status', $s_status);
        }
        $this->_bd_for_session_id();
    }

    function _bd_for_session_id() {
        $session_user_id = get_from_session('temp_id_for_sugam_admin');
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('village_name', explode(',', $av));
            }
        }
        if (is_aci_user()) {
            $aci_where = "(r.talathi_to_aci = $session_user_id OR r.status = " . VALUE_SIX . ")";
            $this->db->where($aci_where);
        }
        if (is_mamlatdar_user()) {
            $mam_where = "(r.aci_to_mamlatdar = $session_user_id OR r.ldc_to_mamlatdar = $session_user_id OR r.status = " . VALUE_SIX . ")";
            $this->db->where($mam_where);
        }
        if (is_ldc_user()) {
            $this->db->where("(r.aci_to_ldc = $session_user_id OR r.aci_to_m_ldc = $session_user_id)");
        }
    }

    function get_records_for_excel($s_district, $s_app_no, $s_app_date, $s_app_det, $s_vdw, $s_app_status, $s_co_hand, $s_qstatus, $s_status) {
        $this->db->select('r.application_number, r.submitted_datetime, r.applicant_name, r.mobile_number, '
                . 'r.district, r.village_name, r.status, r.query_status');

        $this->_bd_for_search_oc($s_district, $s_app_no, $s_app_date, $s_app_det, $s_vdw, $s_app_status, $s_co_hand, $s_qstatus, $s_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('obc_certificate AS r');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        $this->db->order_by('r.obc_certificate_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_basic_data_for_cc($obc_certificate_id) {
        $this->db->select('r.*, sat.name AS talathi_name, saa.name AS aci_name, IF(r.aci_rec=1,salm.name,IF(r.aci_rec=2,sam.name, IF(r.aci_rec=3,salm.name,salm.name))) AS mamlatdar_name, '
                . 'sal.name AS ldc_name,salmig.name AS ldc_name_m, sau.name AS actioner_user_name');
        $this->db->where('r.obc_certificate_id', $obc_certificate_id);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('obc_certificate AS r');
        $this->db->join('sa_users AS sat', 'sat.sa_user_id = r.talathi AND r.talathi != 0', 'LEFT');
        $this->db->join('sa_users AS saa', 'saa.sa_user_id = r.talathi_to_aci AND r.talathi_to_aci != 0', 'LEFT');
        $this->db->join('sa_users AS sam', 'sam.sa_user_id = r.aci_to_mamlatdar AND r.aci_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users AS sal', 'sal.sa_user_id = r.aci_to_ldc AND r.aci_to_ldc != 0', 'LEFT');
        $this->db->join('sa_users AS salmig', 'salmig.sa_user_id = r.aci_to_m_ldc AND r.aci_to_m_ldc != 0', 'LEFT');
        $this->db->join('sa_users AS salm', 'salm.sa_user_id = r.ldc_to_mamlatdar AND r.ldc_to_mamlatdar != 0', 'LEFT');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_name_result_data_for_cc($field_name, $field_value, $table_name, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where($field_name, $field_value);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->row_array();
    }
}

/*
 * EOF: ./application/models/Obc_certificate_model.php
 */