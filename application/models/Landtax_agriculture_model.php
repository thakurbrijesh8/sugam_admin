<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Landtax_agriculture_model extends CI_Model {

    function get_all_landtax_agriculture_list($session_district = '', $search_village = '', $search_khata_number = '', $search_occupant_name = '') {
        $this->db->select('
            l.landtax_agriculture_id,
            l.village_name,
            l.village,
            l.khata_number,
            l.occupant_name,
            l.address,
            y.arrears as arreas_of_revenue,
            altp.total_land_tax_payment AS altp_total_land_tax_payment,
            MAX(CASE WHEN y.notice_year = "2022-23" THEN y.amount END) AS amount_of_2022_23,
            MAX(CASE WHEN y.notice_year = "2023-24" THEN y.amount END) AS amount_of_2023_24,
            MAX(CASE WHEN y.notice_year = "2024-25" THEN y.amount END) AS amount_of_2024_25
        ');
        if ($search_village != '') {
            $this->db->where('l.village', $search_village);
        }
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('l.village', explode(',', $av));
            }
        }
        if ($search_khata_number != '') {
            $this->db->where('l.khata_number', $search_khata_number);
        }
        if ($search_occupant_name != '') {
            $this->db->like('l.occupant_name', $search_occupant_name);
        }
        $this->db->from('landtax_agriculture as l');
        $this->db->join('landtax_agriculture_year as y', 'l.landtax_agriculture_id = y.landtax_agriculture_id', 'inner');
        $this->db->join('view_get_landtax_agriculture_wise_payment_details AS altp', 'l.khata_number=altp.khata_number AND l.village=altp.village', 'LEFT');
        $this->db->group_by('l.landtax_agriculture_id, l.village, l.khata_number, l.occupant_name');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_records_for_excel_for_landtax_agriculture($session_district, $search_village = '', $search_khata_number = '', $search_occupant_name = '') {
        $this->db->select('
            l.landtax_agriculture_id,l.village_name,l.village,l.khata_number, l.occupant_name,l.status,l.address,l.mobile_number,l.email,l.ref_survey_number,l.remark,l.dlt_hut,l.dlt_itar,l.dlt_rokad,
            l.dlt_kada,l.dlt_dangi,l.dlt_kolam,l.dlt_arad,y.arrears as arreas_of_revenue,
            MAX(CASE WHEN y.notice_year = "2022-23" THEN y.amount END) AS amount_of_2022_23,
            MAX(CASE WHEN y.notice_year = "2023-24" THEN y.amount END) AS amount_of_2023_24,
            MAX(CASE WHEN y.notice_year = "2024-25" THEN y.amount END) AS amount_of_2024_25
        ');
        if ($search_village != '') {
            $this->db->where('l.village', $search_village);
        }
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('l.village', explode(',', $av));
            }
        }
        if ($search_khata_number != '') {
            $this->db->where('l.khata_number', $search_khata_number);
        }

        if ($search_occupant_name != '') {
            $this->db->like('l.occupant_name', $search_occupant_name);
        }
        $this->db->from('landtax_agriculture as l');
        $this->db->join('landtax_agriculture_year as y', 'l.landtax_agriculture_id = y.landtax_agriculture_id', 'inner');
        $this->db->group_by('l.landtax_agriculture_id, l.village, l.khata_number, l.occupant_name');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_landtax_agriculture_by_id($landtax_agriculture_id) {
        $this->db->select('l.*,y.notice_year,y.arrears,y.amount,sum(amount) AS total_amount,altp.total_land_tax_payment AS altp_total_land_tax_payment');
        $this->db->where('l.is_delete !=' . IS_DELETE);
        $this->db->where('l.landtax_agriculture_id', $landtax_agriculture_id);
        $this->db->from('landtax_agriculture AS l');
        $this->db->join('landtax_agriculture_year AS y', 'y.landtax_agriculture_id = l.landtax_agriculture_id AND y.is_delete != ' . IS_DELETE, 'LEFT');
        $this->db->join('view_get_landtax_agriculture_wise_payment_details AS altp', 'l.khata_number=altp.khata_number AND l.village=altp.village', 'LEFT');
        $this->db->group_by('l.village, l.khata_number');
        $this->db->order_by('l.landtax_agriculture_id', 'ASC');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_pending_notice_year($landtax_agriculture_id) {
        $this->db->select('y.notice_year AS notice_year,y.amount AS amount');
        $this->db->where('y.is_delete !=' . IS_DELETE);
        $this->db->where('y.landtax_agriculture_id', $landtax_agriculture_id);
        $this->db->where('y.amount', VALUE_ZERO);
        $this->db->where('y.updated_by', VALUE_ZERO);
        $this->db->from('landtax_agriculture_year AS y');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_last_notice_year($landtax_agriculture_id) {
        $this->db->select('y.notice_year AS notice_year, y.amount AS amount');
        $this->db->where('y.is_delete != ' . IS_DELETE);
        $this->db->where('y.landtax_agriculture_id', $landtax_agriculture_id);
        $this->db->where('y.amount', '0.00');
        $this->db->from('landtax_agriculture_year AS y');
        $this->db->order_by('y.notice_year', 'ASC'); // Order by financial year in descending order
        $this->db->limit(1); // Limit the result to one row (the last one)
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_total_notice_year($landtax_agriculture_id) {
        $this->db->select('y.notice_year AS notice_year, y.amount AS amount');
        $this->db->where('y.is_delete != ' . IS_DELETE);
        $this->db->where('y.landtax_agriculture_id', $landtax_agriculture_id);
        $this->db->where('y.amount !=', '0.00');
        $this->db->from('landtax_agriculture_year AS y');
        $this->db->group_by('y.notice_year'); // Order by financial year in descending order
        $this->db->order_by('y.notice_year', 'ASC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_land_details_by_landtax_agriculture_id($session_district, $landtax_agriculture_id) {
        $this->db->select('l.*,y.notice_year,y.arrears,y.amount,sum(amount) AS total_amount,altp.total_land_tax_payment AS altp_total_land_tax_payment');
        $this->db->where('l.is_delete !=' . IS_DELETE);
        $this->db->where('l.landtax_agriculture_id', $landtax_agriculture_id);
        $this->db->from('landtax_agriculture AS l');
        $this->db->join('landtax_agriculture_year AS y', 'y.landtax_agriculture_id = l.landtax_agriculture_id AND y.is_delete != ' . IS_DELETE, 'LEFT');
        $this->db->join('view_get_landtax_agriculture_wise_payment_details AS altp', 'l.khata_number=altp.khata_number AND l.village=altp.village', 'LEFT');
        $this->db->group_by('l.village, l.khata_number');
        $this->db->order_by('l.landtax_agriculture_id', 'ASC');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_payment_history($t_district, $village, $khata_number) {
        $this->db->select('ltp.*, fp.fees_payment_id, fp.reference_id, fp.op_status, fp.op_message, fp.op_transaction_datetime, fp.op_start_datetime');
        $this->db->where('ltp.district', $t_district);
        $this->db->where('ltp.village', $village);
        $this->db->where('ltp.khata_number', $khata_number);
        $this->db->where('ltp.is_delete !=' . IS_DELETE);
        $this->db->from('landtax_agriculture_payment AS ltp');
        $this->db->join('fees_payment AS fp', 'ltp.last_op_reference_number=fp.reference_number AND fp.is_delete!=' . IS_DELETE, 'LEFT');
        $this->db->order_by('landtax_agriculture_payment_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_payment_history_for_tr_five($agriltp_id) {
        $this->db->select('ltp.*, fp.fees_payment_id, fp.reference_id, fp.op_status, fp.op_message, fp.op_transaction_datetime, fp.op_start_datetime');
        $this->db->where('ltp.landtax_agriculture_payment_id', $agriltp_id);
        $this->db->where('ltp.is_delete !=' . IS_DELETE);
        $this->db->from('landtax_agriculture_payment AS ltp');
        $this->db->join('fees_payment AS fp', 'ltp.last_op_reference_number=fp.reference_number AND fp.is_delete!=' . IS_DELETE, 'LEFT');
        $this->db->order_by('landtax_agriculture_payment_id', 'DESC');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_all_nh_agriculture_list($start, $length, $search_district = '', $search_ny = '', $search_ngo = '', $search_nn = '', $search_kn = '', $search_village = '') {
        $this->db->select('*');

        $this->_bd_for_search_nh_agriculture($search_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village);

        $this->db->limit($length, $start);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('landtax_agriculture_notice');
        $this->db->order_by('landtax_agriculture_notice_id', 'DESC');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function _bd_for_search_nh_agriculture($search_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village) {
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
        $this->_bd_for_session_id_nh_agriculture();
    }

    function _bd_for_session_id_nh_agriculture() {
        if (is_talathi_user()) {
            $av = get_from_session('temp_av_for_sugam_admin');
            if ($av != '') {
                $this->db->where_in('village', explode(',', $av));
            }
        }
    }

    function get_total_count_of_records_for_nh_agriculture($search_district) {
        $this->db->select('COUNT(landtax_agriculture_notice_id) AS total_records');
        if ($search_district != '') {
            $this->db->where('district', $search_district);
        }

        $this->_bd_for_session_id_nh_agriculture();

        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('landtax_agriculture_notice');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records_for_nh_agriculture($search_district = '', $search_ny = '', $search_ngo = '', $search_nn = '', $search_kn = '', $search_village = '') {
        $this->db->select('COUNT(landtax_agriculture_notice_id) AS total_records');

        $this->_bd_for_search_nh_agriculture($search_district, $search_ny, $search_ngo, $search_nn, $search_kn, $search_village);

        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('landtax_agriculture_notice');
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
        $this->db->from('landtax_agriculture_payment AS ltp');
        $this->db->join('fees_payment AS fp', 'ltp.last_op_reference_number=fp.reference_number AND fp.is_delete!=' . IS_DELETE, 'LEFT');
        $this->db->order_by('ltp.landtax_agriculture_payment_id', 'DESC');
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
            $this->db->like('ltp.occupant_name', $search_occupant_name);
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
        $this->db->select('COUNT(ltp.landtax_agriculture_payment_id) AS total_records');
        if ($search_district != '') {
            $this->db->where('ltp.district', $search_district);
        }

        $this->_bd_for_session_id_tr_five();

        $this->db->where('ltp.is_delete !=' . IS_DELETE);
        $this->db->where('ltp.status =' . VALUE_FOUR);
        $this->db->from('landtax_agriculture_payment AS ltp');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_filter_count_of_records_for_tr_five($search_district = '', $search_app_number = '', $search_kn = '', $search_occupant_name = '', $search_tp = '', $search_pd = '') {
        $this->db->select('COUNT(ltp.landtax_agriculture_payment_id) AS total_records');

        $this->_bd_for_search_tr_five($search_district, $search_app_number, $search_kn, $search_occupant_name, $search_tp, $search_pd);

        $this->db->where('ltp.is_delete !=' . IS_DELETE);
        $this->db->where('ltp.status =' . VALUE_FOUR);
        $this->db->from('landtax_agriculture_payment AS ltp');
        $this->db->join('fees_payment AS fp', 'ltp.last_op_reference_number=fp.reference_number');
        $resc = $this->db->get();
        $record = $resc->row_array();
        return $record['total_records'];
    }

    function get_landtax_paid_amount_data($khata_number, $village) {
        $this->db->select('total_land_tax_payment AS total_land_tax_payment');
        $this->db->where('khata_number', $khata_number);
        $this->db->where('village', $village);
        $this->db->from('view_get_landtax_agriculture_wise_payment_details');
        $resc = $this->db->get();
        $record = $resc->row_array();
        if (!empty($record)) {
            return $record['total_land_tax_payment'];
        } else {
            return VALUE_ZERO;
        }
    }

    function get_updated_landtax_amount_data($landtax_agriculture_id) {
        $this->db->select('notice_year, arrears, amount');
        $this->db->from('landtax_agriculture_year');
        $this->db->where('landtax_agriculture_id', $landtax_agriculture_id);
        $this->db->order_by('notice_year', 'ASC');
        $resc = $this->db->get();
        return $resc->result_array();
    }
}

/*
 * EOF: ./application/models/Landtax_agriculture_model.php
 */