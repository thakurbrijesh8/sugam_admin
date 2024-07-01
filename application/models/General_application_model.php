<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_application_model extends CI_Model {

    function get_all_general_application_list($start, $length, $search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_vdw = '', $s_co_hand = '', $s_qstatus = '', $search_status = '') {
        $this->db->select('r.*, sau.name AS actioner_user_name,q.query_id, q.query_by_name, q.query_datetime, u.applicant_name as reg_user_name,u.mobile_number as reg_user_mobile_number,u.email as reg_user_email');

        $this->_bd_for_search_ga($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_vdw, $s_co_hand, $s_qstatus, $search_status);

        $this->db->limit($length, $start);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('general_application AS r');
        $this->db->join('sa_users as sau', 'sau.sa_user_id = r.updated_by', 'left');
        $this->db->join('query AS q', 'q.query_id = (SELECT max(query_id) FROM query WHERE module_type = ' . VALUE_THIRTY . ' AND module_id = r.general_application_id AND is_delete != ' . VALUE_ONE . ')', 'LEFT');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        if ($search_status == VALUE_FIVE || $search_status == VALUE_SIX) {
            $this->db->order_by('r.status_datetime', 'DESC');
        } else {
            $this->db->order_by('r.status, r.submitted_datetime', 'ASC');
        }
        $resc = $this->db->get();
//        print_r($this->db->last_query());
        return $resc->result_array();
    }

    function _bd_for_search_ga($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_vdw, $s_co_hand, $s_qstatus, $search_status) {
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
                    . "r.address LIKE '%$search_applicant_details%' OR "
                    . "r.mobile_number LIKE '%$search_applicant_details%' OR "
                    . "r.email LIKE '%$search_applicant_details%')";
            $this->db->where($where);
        }
        if ($search_vdw != '') {
            $this->db->where('r.village', $search_vdw);
        }
        if ($s_co_hand != '') {
            if (is_mamlatdar_user()) {
                $forwarded = VALUE_FOUR;
            } else if (is_ldc_user()) {
                $forwarded = VALUE_THREE;
            } else if (is_aci_user()) {
                $forwarded = VALUE_TWO;
            } else if (is_talathi_user()) {
                $forwarded = VALUE_ONE;
            }

            $where1 = '';
            if ($s_co_hand == VALUE_ONE) {
                if (is_mamlatdar_user()) {
                    $where1 = "(
                        r.status='" . VALUE_TWO . "' 
                        AND r.application_history = ''
                    )";
                }
                $where2 = "EXISTS (
                            SELECT *
                            FROM general_application_history ga_history
                            WHERE ga_history.general_application_id = r.general_application_id
                            AND ga_history.forwarded_to = '" . $forwarded . "' 
                            AND ga_history.is_forwarded = 2
                            AND ga_history.forwarded_datetime = (
                                SELECT MAX(inner_ga_history.forwarded_datetime)
                                FROM general_application_history inner_ga_history
                                WHERE inner_ga_history.general_application_id = ga_history.general_application_id
                            )
                        )";
                
                $where3 = "r.status NOT IN (5, 6)
                        AND r.query_status NOT IN (1, 2)";
                
                if ($where1 != '') {
                    $where = "((" . $where1 . " OR " . $where2 . ") AND " . $where3 . ")";
                } else {
                    $where = $where2;
                }
                $this->db->where($where);
            } else if ($s_co_hand == VALUE_TWO) {
                $this->db->where("
                EXISTS (
                        SELECT *
                        FROM general_application_history ga_history
                        WHERE ga_history.general_application_id = r.general_application_id
                        AND ga_history.forwarded_by = '" . $forwarded . "'
                        AND ga_history.is_forwarded = 2
                        AND ga_history.forwarded_datetime = (
                            SELECT MAX(inner_ga_history.forwarded_datetime)
                            FROM general_application_history inner_ga_history
                            WHERE inner_ga_history.general_application_id = ga_history.general_application_id
                        )
                        AND r.status NOT IN (5, 6)
                        AND r.query_status NOT IN (1, 2)
                    )
                ");
            }
        }
        if ($s_qstatus != '') {
            $this->db->where('r.query_status', $s_qstatus);
        }
        if ($search_status != '') {
            if ($search_status != VALUE_FIVE && $search_status != VALUE_SIX) {
                $this->db->where("(r.query_status='" . VALUE_ZERO . "' OR r.query_status='" . VALUE_THREE . "')");
            }
            $this->db->where('r.status', $search_status);
        }

        $this->_bd_for_session_id();
    }

    function _bd_for_session_id() {
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('village', explode(',', $av));
            }
            $this->db->where('r.is_talathi', VALUE_ONE);
        }
        if (is_ldc_user()) {
            $this->db->where("((r.is_ldc = " . VALUE_ONE . ") OR (r.status = " . VALUE_FIVE . "))");
        }
        if (is_aci_user()) {
            $this->db->where('r.is_aci', VALUE_ONE);
        }
    }

    function get_total_count_of_records($search_district) {
        $this->db->select('COUNT(r.general_application_id) AS total_records');
        if ($search_district != '') {
            $this->db->where('r.district', $search_district);
        }

        $this->_bd_for_session_id();

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('general_application AS r');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records($search_district = '', $search_application_number = '', $search_application_date = '', $search_applicant_details = '', $search_vdw = '', $s_co_hand = '', $s_qstatus = '', $search_status = '') {
        $this->db->select('COUNT(r.general_application_id) AS total_records');

        $this->_bd_for_search_ga($search_district, $search_application_number, $search_application_date, $search_applicant_details, $search_vdw, $s_co_hand, $s_qstatus, $search_status);

        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('general_application AS r');
        $this->db->join('users as u', 'u.user_id = r.user_id', 'left');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_history_data_for_ga($general_application_id) {
        $this->db->select('gah.*, sau.name AS forwarded_to_user_name, sauc.name AS forwarded_by_user_name');
        $this->db->where('gah.general_application_id', $general_application_id);
        $this->db->where('gah.is_delete !=', IS_DELETE);
        $this->db->where('gah.is_forwarded', VALUE_TWO);
        $this->db->from('general_application_history as gah');
        $this->db->join('sa_users as sau', 'gah.forwarded_to_user_id = sau.sa_user_id', 'left');
        $this->db->join('sa_users as sauc', 'gah.forwarded_by_user_id = sauc.sa_user_id', 'left');
        $this->db->order_by('gah.forwarded_datetime', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_current_forward_app_data_for_ga($general_application_id) {
        $this->db->select('gah.*, sau.name AS forwarded_to_user_name, sauc.name AS forwarded_by_user_name');
        $this->db->from('general_application_history as gah');
        $this->db->join('sa_users as sau', 'gah.forwarded_to_user_id = sau.sa_user_id', 'left');
        $this->db->join('sa_users as sauc', 'gah.forwarded_by_user_id = sauc.sa_user_id', 'left');
        $this->db->where('gah.general_application_id', $general_application_id);
        //$this->db->where('gah.forwarded_by', $forwarded_by);
        //$this->db->where('gah.is_forwarded', VALUE_ONE);
        $this->db->where('gah.is_delete !=', IS_DELETE);
        $this->db->order_by('gah.forwarded_datetime', 'DESC');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_basic_data_for_ga($general_application_id) {
        $this->db->select('r.*');
        $this->db->where('r.general_application_id', $general_application_id);
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.status != ' . VALUE_ZERO);
        $this->db->where('r.status != ' . VALUE_ONE);
        $this->db->from('general_application AS r');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_certificate_data($general_application_id) {
        $this->db->select('*');
        $this->db->where('general_application_id', $general_application_id);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('forwarded_by', VALUE_THREE);
        $this->db->from('general_application_history');
        $this->db->order_by('forwarded_datetime', 'DESC');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_ldc_report_doc_by_id($report_doc_ids) {
        $report_doc_ids_array = explode(',', $report_doc_ids);
        $this->db->select('*');
        if (!empty($report_doc_ids_array)) {
            $this->db->where_in('field_verification_document_id', $report_doc_ids_array);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('field_verification_document');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_is_forward_to_data($general_application_id, $user_id) {
        $this->db->select('COUNT(*) as count');
        $this->db->where('general_application_id', $general_application_id);
        $this->db->where('forwarded_to', $user_id);
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->from('general_application_history');
        $resc = $this->db->get();
        $result = $resc->row_array();

        return $result['count'] > VALUE_ONE ? VALUE_ONE : VALUE_ZERO;
    }

    function get_ldc_report_doc_ids_with_documents($general_application_id) {
        $this->db->select('fvd.*,gah.general_application_history_id,gah.ldc_report_doc_ids');
        $this->db->from('field_verification_document fvd');
        $this->db->join('general_application_history gah', 'FIND_IN_SET(fvd.field_verification_document_id, gah.ldc_report_doc_ids)');
        $this->db->where('gah.general_application_id', $general_application_id);
        $this->db->where('gah.is_delete !=', IS_DELETE);
        $this->db->where('fvd.is_delete !=', IS_DELETE);
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_ldc_report_data_for_ci($general_application_id) {
        $this->db->select('*');
        $this->db->where('general_application_id', $general_application_id);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('forwarded_by', VALUE_THREE);
        $this->db->from('general_application_history');
        $this->db->order_by('forwarded_datetime', 'DESC');
        $resc = $this->db->get();
        return $resc->row_array();
    }

}

/*
 * EOF: ./application/models/General_application_model.php
 */