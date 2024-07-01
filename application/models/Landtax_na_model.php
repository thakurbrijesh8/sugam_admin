<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Landtax_na_model extends CI_Model {

    function get_all_landtax_na_list($session_district = '', $search_village = '', $search_survey = '', $search_subdiv = '', $search_khata_number = '', $search_occupant_name = '') {
        $this->db->select('r.khata_number, r.village, r.village_name, r.devnagari, SUM(r.area) AS total_area, r.occupant_details, '
                . 'SUM(lt.arrears) AS lt_total_arrears, SUM(r.current_year_due_tax) AS total_current_year_due_tax, SUM(ltp.total_land_tax_payment) AS ltp_total_land_tax_payment');
        $this->_from_land_tax_na($session_district, $search_village, $search_survey, $search_subdiv, $search_khata_number, $search_occupant_name);
        $this->_ltna_arrears_payment($session_district);
        $this->db->group_by('r.village, r.khata_number');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _ltna_arrears_payment($session_district) {
        $t_district = TALUKA_DAMAN;
        if ($session_district == TALUKA_DIU) {
            $t_district = $session_district;
        }
        $this->db->join('rlp_land_tax AS lt', 'lt.district=' . $t_district . ' AND r.village=lt.village AND r.survey=lt.survey AND r.subdiv=lt.subdiv AND lt.financial_year="' . get_financial_year() . '" AND lt.is_delete!=' . IS_DELETE, 'LEFT');
        $this->db->join('view_get_rlp_wise_land_tax_payment_details AS ltp', 'ltp.district=' . $t_district . ' AND r.village=ltp.village AND r.survey=ltp.survey AND r.subdiv=ltp.subdiv AND ltp.financial_year="' . get_financial_year() . '"', 'LEFT');
    }

    function _from_land_tax_na($session_district, $search_village = '', $search_survey = '', $search_subdiv = '', $search_khata_number = '', $search_occupant_name = '', $search_occ_ids = array()) {
        $ex = '';
        if ($session_district == TALUKA_DIU) {
            $ex = '_diu';
        }
        $av = '';
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
        }
        $this->db->from('(SELECT occupant_id, khata_number, village, village_name, devnagari, survey, subdiv, nature, area, area_type, '
                . 'IF(area_type=1 ,CEIL(((1*area)/100)*' . RLP_UA_PRICE_PER_GUNTHA . '), CEIL(((1*area)/100)*' . RLP_RA_PRICE_PER_GUNTHA . ')) AS current_year_due_tax,'
                . 'mutation_number, IF(owner_type=1, occupant_name, joint_occupants) AS occupant_details '
                . 'FROM rural_land_parcels' . $ex . ' WHERE is_delete!=' . IS_DELETE . ' '
                . 'AND (nature LIKE "%' . NA_NATURE_CODE . '%" OR is_na=' . VALUE_ONE . ') '
//                . 'AND is_assign_kn=' . VALUE_ONE . ' AND (nature LIKE "%' . NA_NATURE_CODE . '%" OR is_na=' . VALUE_ONE . ') '
                . (!empty($search_occ_ids) ? 'AND occupant_id IN (' . implode(',', $search_occ_ids) . ') ' : '')
                . ($av != '' ? 'AND village IN (' . $av . ') ' : '')
                . ($search_village != '' ? 'AND village=' . $search_village . ' ' : '')
                . ($search_survey != '' ? 'AND survey="' . $search_survey . '" ' : '')
                . ($search_subdiv != '' ? 'AND subdiv="' . $search_subdiv . '" ' : '')
                . ($search_khata_number != '' ? 'AND khata_number=' . $search_khata_number . ' ' : '')
                . ($search_occupant_name != '' ? ('AND (occupant_name LIKE "%' . $search_occupant_name . '%" '
                        . 'OR aadhar_card_number LIKE "%' . $search_occupant_name . '%" '
                        . 'OR mobile_number LIKE "%' . $search_occupant_name . '%")') : '')
                . 'GROUP BY village,survey,subdiv) AS r');
    }

    function get_all_na_land_detail_by_khata_number($session_district, $search_village, $search_khata_number) {
        $this->db->select('r.*, lt.arrears, ltp.total_land_tax_payment');
        $this->_from_land_tax_na($session_district, $search_village, '', '', $search_khata_number);
        $this->_ltna_arrears_payment($session_district);
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_all_na_land_detail_by_vssk($search_district, $search_village, $search_survey, $search_subdiv, $search_khata_number = '') {
        $this->db->select('r.village, r.village_name, r.khata_number, r.survey, r.subdiv, r.occupant_details, r.area, '
                . 'lt.arrears, r.current_year_due_tax, ltp.total_land_tax_payment');
        $this->_from_land_tax_na($search_district, $search_village, $search_survey, $search_subdiv, $search_khata_number);
        $this->_ltna_arrears_payment($search_district);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_records_for_excel_for_landtax_na($session_district, $search_village = '', $search_survey = '', $search_subdiv = '', $search_khata_number = '', $search_occupant_name = '') {
        $this->db->select('r.village_name, r.khata_number, r.survey, r.subdiv, r.occupant_details, r.area, '
                . 'lt.arrears, r.current_year_due_tax, ltp.total_land_tax_payment');
        $this->_from_land_tax_na($session_district, $search_village, $search_survey, $search_subdiv, $search_khata_number, $search_occupant_name);
        $this->_ltna_arrears_payment($session_district);
        $this->db->group_by('r.village, r.khata_number, r.survey, r.subdiv');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_land_details_by_occ_ids($session_district, $occ_ids) {
        $this->db->select('r.*, lt.arrears, ltp.total_land_tax_payment');
        $this->_from_land_tax_na($session_district, '', '', '', '', '', $occ_ids);
        $this->_ltna_arrears_payment($session_district);
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_payment_history($t_district, $village, $khata_number) {
        $this->db->select('ltp.*, fp.fees_payment_id, fp.reference_id, fp.op_status, fp.op_message, fp.op_transaction_datetime, fp.op_start_datetime');
        $this->db->where('ltp.district', $t_district);
        $this->db->where('ltp.village', $village);
        $this->db->where('ltp.khata_number', $khata_number);
        $this->db->where('ltp.is_delete !=' . IS_DELETE);
        $this->db->from('rlp_land_tax_payment AS ltp');
        $this->db->join('fees_payment AS fp', 'ltp.last_op_reference_number=fp.reference_number AND fp.is_delete!=' . IS_DELETE, 'LEFT');
        $this->db->order_by('rlp_land_tax_payment_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_payment_history_for_tr_five($rlpltp_id) {
        $this->db->select('ltp.*, fp.fees_payment_id, fp.reference_id, fp.op_status, fp.op_message, fp.op_transaction_datetime, fp.op_start_datetime');
        $this->db->where('ltp.rlp_land_tax_payment_id', $rlpltp_id);
        $this->db->where('ltp.is_delete !=' . IS_DELETE);
        $this->db->from('rlp_land_tax_payment AS ltp');
        $this->db->join('fees_payment AS fp', 'ltp.last_op_reference_number=fp.reference_number AND fp.is_delete!=' . IS_DELETE, 'LEFT');
        $this->db->order_by('rlp_land_tax_payment_id', 'DESC');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function update_rlp_in_vss($t_name, $village, $survey, $subdiv, $update_data) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('(village=' . $village . ' AND survey="' . $survey . '" AND subdiv="' . $subdiv . '")');
        $this->db->update($t_name, $update_data);
    }

    function get_all_nh_list($start, $length, $search_district = '', $search_ny = '', $search_ngo = '', $search_nn = '', $search_kn = '', $search_village = '') {
        $this->db->select('rlp_notice_id, notice_date, notice_number, notice_year, temp_notice_number, district, village, '
                . 'village_name, khata_number, occupant_details, land_details, notice_amount, created_by, created_time, '
                . 'updated_by, updated_time, is_delete');

        $this->_bd_for_search_nh($search_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village);

        $this->db->limit($length, $start);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('rlp_notice');
        $this->db->order_by('rlp_notice_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _bd_for_search_nh($search_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village) {
        if ($search_district != '') {
            $this->db->where('district', $search_district);
        }
        if ($search_ny != '') {
            $this->db->like('notice_year', $search_ny);
        }
        if ($search_ngo != '') {
            $this->db->like("DATE_FORMAT(created_time,'%d-%m-%Y %H:%i:%s')", $search_ngo);
        }
        if ($search_nn != '') {
            $this->db->like('notice_number', $search_nn);
        }
        if ($search_kn != '') {
            $this->db->like('khata_number', $search_kn);
        }
        if ($search_village != '') {
            $this->db->where('village', $search_village);
        }
        $this->_bd_for_session_id_nh();
    }

    function _bd_for_session_id_nh() {
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('village', explode(',', $av));
            }
        }
    }

    function get_total_count_of_records_for_nh($search_district) {
        $this->db->select('COUNT(rlp_notice_id) AS total_records');
        if ($search_district != '') {
            $this->db->where('district', $search_district);
        }

        $this->_bd_for_session_id_nh();

        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('rlp_notice');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records_for_nh($search_district = '', $search_ny = '', $search_ngo = '', $search_nn = '', $search_kn = '', $search_village = '') {
        $this->db->select('COUNT(rlp_notice_id) AS total_records');

        $this->_bd_for_search_nh($search_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village);

        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('rlp_notice');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_all_tr_five_list($start, $length, $search_district = '', $search_app_number = '', $search_kn = '', $search_occupant_name = '', $search_tp = '', $search_pd = '') {
        $this->db->select('ltp.*, fp.fees_payment_id, fp.reference_id, fp.op_status, fp.op_message, fp.op_transaction_datetime, fp.op_start_datetime');

        $this->_bd_for_search_tr_five($search_district, $search_app_number, $search_kn, $search_occupant_name, $search_tp, $search_pd);

        $this->db->limit($length, $start);
        $this->db->where('ltp.is_delete !=' . IS_DELETE);
        $this->db->where('ltp.status =' . VALUE_FOUR);
        $this->db->from('rlp_land_tax_payment AS ltp');
        $this->db->join('fees_payment AS fp', 'ltp.last_op_reference_number=fp.reference_number AND fp.is_delete!=' . IS_DELETE, 'LEFT');
        $this->db->order_by('ltp.rlp_land_tax_payment_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _bd_for_search_tr_five($search_district, $search_app_number, $search_kn, $search_occupant_name, $search_tp, $search_pd) {
        if ($search_district != '') {
            $this->db->where('ltp.district', $search_district);
        }
        if ($search_app_number != '') {
            $where = "(ltp.application_number LIKE '%$search_app_number%' OR "
                    . "DATE_FORMAT(fp.op_transaction_datetime,'%d-%m-%Y %H:%i:%s') LIKE '%$search_app_number%')";
            $this->db->where($where);
        }
        if ($search_kn != '') {
            $where = "(ltp.khata_number LIKE '%$search_kn%' OR "
                    . "ltp.village_name LIKE '%$search_kn%')";
            $this->db->where($where);
        }
        if ($search_occupant_name != '') {
            $this->db->like('ltp.occupant_details', $search_occupant_name);
        }
        if ($search_tp != '') {
            $where = "(fp.total_fees LIKE '%$search_tp%')";
            $this->db->where($where);
        }
        if ($search_pd != '') {
            $where = "(fp.reference_id LIKE '%$search_pd%')";
            $this->db->where($where);
        }
        $this->_bd_for_session_id_tr_five();
    }

    function _bd_for_session_id_tr_five() {
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('ltp.village', explode(',', $av));
            }
        }
    }

    function get_total_count_of_records_for_tr_five($search_district) {
        $this->db->select('COUNT(ltp.rlp_land_tax_payment_id) AS total_records');
        if ($search_district != '') {
            $this->db->where('ltp.district', $search_district);
        }

        $this->_bd_for_session_id_tr_five();

        $this->db->where('ltp.is_delete !=' . IS_DELETE);
        $this->db->where('ltp.status =' . VALUE_FOUR);
        $this->db->from('rlp_land_tax_payment AS ltp');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records_for_tr_five($search_district = '', $search_app_number = '', $search_kn = '', $search_occupant_name = '', $search_tp = '', $search_pd = '') {
        $this->db->select('COUNT(ltp.rlp_land_tax_payment_id) AS total_records');

        $this->_bd_for_search_tr_five($search_district, $search_app_number, $search_kn, $search_occupant_name, $search_tp, $search_pd);

        $this->db->where('ltp.is_delete !=' . IS_DELETE);
        $this->db->where('ltp.status =' . VALUE_FOUR);
        $this->db->from('rlp_land_tax_payment AS ltp');
        $this->db->join('fees_payment AS fp', 'ltp.last_op_reference_number=fp.reference_number');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }
}

/*
 * EOF: ./application/models/Landtax_na_model.php
 */