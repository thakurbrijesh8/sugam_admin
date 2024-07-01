<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utility_model extends CI_Model {

    function get_by_id($id, $compare_id, $table_name, $second_id = NULL, $second_value = NULL, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where($id, $compare_id);
        if ($second_id != NULL && $second_value != NULL) {
            $this->db->where($second_id, $second_value);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_by_id_multiple($id, $compare_id, $table_name, $second_id = NULL, $second_value = NULL, $third_id = NULL, $third_value = NULL, $fourth_id = NULL, $fourth_value = '') {
        $this->db->where($id, $compare_id);
        if ($second_id != NULL && $second_value != NULL) {
            $this->db->where($second_id, $second_value);
        }
        if ($third_id != NULL && $third_value != NULL) {
            $this->db->where($third_id, $third_value);
        }
        if ($fourth_id != NULL && $fourth_value != '') {
            $this->db->where($fourth_id, $fourth_value);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_by_id2($id, $compare_id, $table_name, $second_id = NULL, $second_value = NULL, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where($id, $compare_id);
        if ($second_id != NULL && $second_value != NULL) {
            $this->db->where($second_id, $second_value);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_by_id_with_applicant_name($id, $compare_id, $table_name) {
        $this->db->select('t.*, u.applicant_name');
        $this->db->where("t.$id", $compare_id);
        $this->db->where('t.is_delete !=' . IS_DELETE);
        $this->db->from("$table_name AS t");
        $this->db->join('users as u', 'u.user_id = t.user_id');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function insert_data($table_name, $table_data) {
        $this->db->insert($table_name, $table_data);
        return $this->db->insert_id();
    }

    function insert_data_batch($table_name, $table_data) {
        $this->db->insert_batch($table_name, $table_data);
    }

    function update_data($id, $id_value, $table_name, $table_data, $second_id = NULL, $second_value = NULL, $third_id = NULL, $third_value = NULL, $fourth_id = NULL, $fourth_value = NULL) {
        $this->db->where($id, $id_value);
        if ($second_id != NULL && ($second_value != NULL || $second_value == VALUE_ZERO)) {
            $this->db->where($second_id, $second_value);
        }
        if ($third_id != NULL && ($third_value != NULL || $third_value == VALUE_ZERO)) {
            $this->db->where($third_id, $third_value);
        }
        if ($fourth_id != NULL && $fourth_value != '') {
            $this->db->where($fourth_id, $fourth_value);
        }
        $this->db->update($table_name, $table_data);
    }

    function update_data_not_in($id, $id_value, $id2, $ids2, $table_name, $table_data, $where_id = NULL, $where_id_text = NULL) {
        $this->db->where($id, $id_value);
        if (!empty($ids2)) {
            $this->db->where_not_in($id2, $ids2);
        }
        if ($where_id != NULL && $where_id_text != NULL) {
            $this->db->where($where_id, $where_id_text);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->update($table_name, $table_data);
    }

    function update_data_batch($id, $table_name, $table_data) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->update_batch($table_name, $table_data, $id);
    }

    function get_result_data($table_name, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_result_data_by_id($id_text, $id, $table_name, $id_text2 = NULL, $id2 = NULL, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where($id_text, $id);
        if ($id_text2 != NULL && $id2 != NULL) {
            $this->db->where($id_text2, $id2);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_result_data_by_id_multiple($id_text, $id, $table_name, $second_id = NULL, $second_value = NULL, $third_id = NULL, $third_value = NULL, $fourth_id = NULL, $fourth_value = '', $order_by_id = NULL, $order_by = NULL) {
        $this->db->where($id_text, $id);
        if ($second_id != NULL && ($second_value != NULL || $second_value == VALUE_ZERO)) {
            $this->db->where($second_id, $second_value);
        }
        if ($third_id != NULL && ($third_value != NULL || $third_value == VALUE_ZERO)) {
            $this->db->where($third_id, $third_value);
        }
        if ($fourth_id != NULL && $fourth_value != '') {
            $this->db->where($fourth_id, $fourth_value);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function check_field_value_exists_or_not($field_name, $field_value, $table_name, $id = NULL, $id_value = NULL, $field_name2 = NULL, $field_value2 = NULL) {
        $this->db->where('is_delete !=', IS_DELETE);
        $this->db->where($field_name, $field_value);
        if ($field_name2 != NULL && $field_value2 != NULL) {
            $this->db->where($field_name2, $field_value2);
        }
        if ($id != NULL && $id_value != NULL) {
            $this->db->where("$id != $id_value");
        }
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function is_valid_post_data($key_post_id, $post_id, $table_name) {
        $this->db->where($key_post_id, $post_id);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function query_data_by_type_id($module_type, $module_id) {
        $this->db->select("q.*, date_format(q.query_datetime, '%d-%m-%Y %H:%i:%s') AS display_datetime, "
                . "qd.query_document_id, qd.doc_name, qd.document, u.mobile_number AS query_by_mobile_number");
        $this->db->where('q.module_type', $module_type);
        $this->db->where('q.module_id', $module_id);
        $this->db->where('q.is_delete != ' . IS_DELETE);
        $this->db->from('query AS q');
        $this->db->join('query_document AS qd', 'qd.query_id = q.query_id AND qd.is_delete != ' . IS_DELETE, 'LEFT');
        $this->db->join('users As u', '(u.user_id = q.user_id AND q.query_type = '. VALUE_TWO . ')' , 'LEFT');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function query_data_for_scrutiny($module_type, $module_id) {
        $this->db->select("q.*, date_format(q.query_datetime, '%d-%m-%Y %H:%i:%s') AS display_datetime, "
                . "qd.query_document_id, qd.doc_name, qd.document");
        $this->db->where('q.module_type', $module_type);
        $this->db->where('q.module_id', $module_id);
        $this->db->where('q.status', VALUE_ONE);
        $this->db->where('q.is_delete != ' . IS_DELETE);
        $this->db->from('query AS q');
        $this->db->join('query_document AS qd', 'qd.query_id = q.query_id AND qd.is_delete != ' . IS_DELETE);
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_plot_result_data($table_name, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('is_vacant =' . VALUE_ONE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_user_data_for_query_management($temp_access_data, $id) {
        $id_mob_no = isset($temp_access_data['mob_no']) ? $temp_access_data['mob_no'] : '';
        if ($temp_access_data['tbl_text'] == 'document_registration') {
            $this->db->select('u.email, u.user_id, m.temp_application_number' . ($id_mob_no != '' ? ', m.' . $id_mob_no : ''));
        } else {
            $this->db->select('u.email, u.user_id, m.application_number' . ($id_mob_no != '' ? ', m.' . $id_mob_no : ''));
        }
        $this->db->where('m.' . $temp_access_data['key_id_text'], $id);
        $this->db->where('m.is_delete !=' . IS_DELETE);
        $this->db->from($temp_access_data['tbl_text'] . ' AS m');
        $this->db->join('users AS u', 'u.user_id = m.user_id');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function check_registration_number($field_name, $field_value, $table_name) {
        $this->db->select($field_name);
        $this->db->where($field_name, $field_value);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_result_by_id($column, $column_value, $table_name, $sec_column = NULL, $sec_value = NULL, $third_column = NULL, $third_value = NULL, $is_sort_field = NULL) {
        $this->db->where($column, $column_value);
        if ($sec_column != NULL && $sec_value != NULL) {
            $this->db->where($sec_column, $sec_value);
        }
        if ($third_column != NULL && ($third_value != NULL || $third_value == VALUE_ZERO)) {
            $this->db->where($third_column, $third_value);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($is_sort_field != NULL) {
            $this->db->order_by($is_sort_field);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_appointment_data_by_id($id, $compare_id, $table_name) {
        $this->db->select('*');
        $this->db->where("t.$id", $compare_id);
        $this->db->from("$table_name AS t");
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_sa_user_data_by_type($district, $type) {
        $this->db->select('sa_user_id, name');
        $this->db->where('district', $district);
        $this->db->where('user_type', $type);
        $this->db->where('is_deactive', VALUE_ZERO);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('sa_users');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_sa_user_data_by_type_for_ga($district, $type, $village = NULL) {
        $this->db->select('sa_user_id, name');
        if ($type == TEMP_TYPE_TALATHI_USER && $village != NULL) {
            $this->db->where("FIND_IN_SET('$village', assign_villages) >", 0);
        }
        $this->db->where('district', $district);
        $this->db->where('user_type', $type);
        $this->db->where('is_deactive', VALUE_ZERO);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('sa_users');
        $resc = $this->db->get();
        //print_r($this->db->last_query());
        return $resc->result_array();
    }

    function get_name_result_data($field_name, $field_value, $table_name, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where($field_name, $field_value);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_villages_data($table_name) {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->result_array();
    }

    // NOTE : Temporary Solution for Get Survey Numbers
    function get_survey_list($table_name, $village, $module_flag = VALUE_ZERO) {
        $result = $this->_survey_list($table_name, $village, $module_flag);
        $s_array = array();
        foreach ($result as $r_survey) {
            if (!isset($s_array[$r_survey['survey']])) {
                $s_array[$r_survey['survey']] = array();
                $s_array[$r_survey['survey']]['survey'] = $r_survey['survey'];
            }
        }
        return array_values($s_array);
    }

    function _survey_list($table_name, $village, $module_flag = VALUE_ZERO) {
        $this->db->select('survey');
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('village', $village);
        if ($module_flag == VALUE_ONE) {
            $this->db->where('is_assign_kn !=' . VALUE_ONE);
        }
        if ($module_flag == VALUE_TWO) {
            $this->db->where('is_assign_kn', VALUE_ONE);
            $this->db->where('(nature LIKE "%' . NA_NATURE_CODE . '%" OR is_na=' . VALUE_ONE . ')');
        }
        $this->db->from($table_name);
//        $this->db->group_by('survey');
        $this->db->order_by('survey');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_subdiv_list($table_name, $village, $survey, $module_flag = VALUE_ZERO) {
        $this->db->select('subdiv, area');
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('survey', $survey);
        $this->db->where('village', $village);
        if ($module_flag == VALUE_ONE) {
            $this->db->where('is_assign_kn !=' . VALUE_ONE);
        }
        if ($module_flag == VALUE_TWO) {
            $this->db->where('is_assign_kn', VALUE_ONE);
            $this->db->where('(nature LIKE "%' . NA_NATURE_CODE . '%" OR is_na=' . VALUE_ONE . ')');
        }
        $this->db->from($table_name);
        $this->db->group_by('subdiv');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_urban_villages_data() {
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from('daman_urban_villages');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_ptg_list($area_type, $village = VALUE_ZERO, $status = VALUE_ONE) {
        $this->db->select('pts_gtw');
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('area_type', $area_type);
        $this->db->where('status', $status);
        if ($village != VALUE_ZERO) {
            $this->db->where('village', $village);
        }
        $this->db->from('urban_land_parcels');
        $this->db->group_by('pts_gtw');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_clp_list($area_type, $pts_gtw, $village = VALUE_ZERO, $status = VALUE_ONE) {
        $this->db->select('cl_pt');
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('area_type', $area_type);
        $this->db->where('status', $status);
        $this->db->where('pts_gtw', $pts_gtw);
        if ($village != VALUE_ZERO) {
            $this->db->where('village', $village);
        }
        $this->db->from('urban_land_parcels');
        $this->db->group_by('cl_pt');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_occupant_data($village, $survey, $subdiv, $table_name) {
        $this->db->select('occupant_name,joint_occupants,owner_type');
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('is_assign_kn !=' . VALUE_ONE);
        $this->db->where('subdiv', $subdiv);
        $this->db->where('survey', $survey);
        $this->db->where('village', $village);
        $this->db->from($table_name);
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_all_land_data($district, $village, $occupant_name, $table_name) {
        $this->db->select('r.*, lt.arrears, lt.land_tax, sum(ltp.total_land_tax_payment) AS total_land_tax_payment');
        $this->db->where('r.is_delete !=' . IS_DELETE);
        $this->db->where('r.village', $village);
        $this->db->where('r.is_assign_kn !=' . VALUE_ONE);
        $this->db->like('r.occupant_name', $occupant_name);
        $this->db->from("$table_name AS r");
        $this->db->join('rlp_land_tax AS lt', 'lt.district=' . $district . ' AND r.village=lt.village AND r.survey=lt.survey AND r.subdiv=lt.subdiv AND lt.financial_year="' . get_financial_year() . '" AND lt.is_delete !=' . VALUE_ONE, 'LEFT');
        $this->db->join('view_get_rlp_wise_land_tax_payment_details AS ltp', 'ltp.district=' . $district . ' AND r.village=ltp.village AND r.survey=ltp.survey AND r.subdiv=ltp.subdiv AND ltp.financial_year="' . get_financial_year() . '"', 'LEFT');
        $this->db->group_by('r.survey, r.subdiv');
        $this->db->order_by('r.owner_type, r.survey', 'r.subdiv');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_cfy_land_tax_details($cfy, $village, $survey, $subdiv) {
        $this->db->where('financial_year', $cfy);
        $this->db->where('subdiv', $subdiv);
        $this->db->where('survey', $survey);
        $this->db->where('village', $village);
        $this->db->from('rlp_land_tax');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function update_land_tax_arrears_data($cfy, $district, $village, $survey, $subdiv, $au_data) {
        $this->db->where('financial_year', $cfy);
        $this->db->where('district', $district);
        $this->db->where('subdiv', $subdiv);
        $this->db->where('survey', $survey);
        $this->db->where('village', $village);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->update('rlp_land_tax', $au_data);
    }

    function get_total_paid_land_tax($cfy, $district, $village, $survey, $subdiv) {
        $this->db->select('SUM(total_land_tax_payment) AS total_land_tax_payment');
        $this->db->where('financial_year', $cfy);
        $this->db->where('district', $district);
        $this->db->where('village', $village);
        $this->db->where('subdiv', $subdiv);
        $this->db->where('survey', $survey);
        $this->db->from('view_get_rlp_wise_land_tax_payment_details as ltp');
        $resc = $this->db->get();
        $result = $resc->row_array();
        if (empty($result)) {
            return VALUE_ZERO;
        }
        return $result['total_land_tax_payment'];
    }

    function get_khata_number_by_village($village, $table_name) {
        $this->db->select('khata_number');
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('village', $village);
        $this->db->from($table_name);
        $this->db->group_by('khata_number');
        $this->db->order_by('khata_number', 'DESC');
        $resc = $this->db->get();
        //print_r($this->db->last_query());
        return $resc->row_array();
    }

    function get_by_id_number($id, $compare_id, $table_name, $second_id = NULL, $second_value = NULL, $order_by_id = NULL, $order_by = NULL) {
        $this->db->where($id, $compare_id);
        if ($second_id != NULL && $second_value != NULL) {
            $this->db->where($second_id, $second_value);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function field_verification_document_data_for_scrutiny($module_type, $module_id) {
        $this->db->select("f.field_verification_document_id, f.doc_name, f.document");
        $this->db->where('f.module_type', $module_type);
        $this->db->where('f.module_id', $module_id);
        $this->db->where('f.is_delete != ' . IS_DELETE);
        $this->db->from('field_verification_document AS f');
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function get_result_data_or_ids($id_text, $ids, $table_name, $id_text2 = NULL, $id2 = NULL, $order_by_id = NULL, $order_by = NULL) {
        if (!empty($ids)) {
            $this->db->where_in($id_text, $ids);
        }
        if ($id_text2 != NULL && $id2 != NULL) {
            $this->db->where($id_text2, $id2);
        }
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

    function update_total_copy_generated($form_land_details_id, $extra_id = '') {
        $this->db->where('form_land_details_id', $form_land_details_id);
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->set('total_' . $extra_id . 'copy_generated', 'total_' . $extra_id . 'copy_generated+1', FALSE);
        $this->db->update('form_land_details');
    }

    function get_certificate_by_module_details($module_type, $module_id, $module_id_text, $table_name_text) {
        $this->db->select('c.*');
        $this->db->where('m.' . $module_id_text, $module_id);
        $this->db->where('m.is_delete !=' . IS_DELETE);
        $this->db->from($table_name_text . ' AS m');
        $this->db->join('certificate AS c', "m.$module_id_text = c.module_id AND c.module_type = $module_type AND c.is_delete != " . VALUE_ONE);
        $this->db->order_by('c.certificate_id', 'DESC');
        $resc = $this->db->get();
        return $resc->row_array();
    }

    function get_duplicate_details_by_id($module_id, $id_text, $id, $table_name, $second_id = NULL, $second_value = NULL, $third_id = NULL, $third_value = NULL, $order_by_id = NULL, $order_by = NULL) {
        $this->db->select("*, $order_by_id AS m_id");
        $this->db->where("$order_by_id != $module_id");
        $this->db->where('is_delete !=' . IS_DELETE);
        $this->db->where('application_year', get_financial_year());
        $this->db->where_not_in('status', array(VALUE_ZERO, VALUE_ONE));

        $where = "$id_text LIKE '%$id%'";
        if ($second_value != '') {
            $where .= " OR $second_id = $second_value";
        }
        if ($third_value != '') {
            $where .= " OR $third_id = $third_value";
        }

        $this->db->where('(' . $where . ')');

        $this->db->from($table_name);
        if ($order_by_id != NULL && $order_by != NULL) {
            $this->db->order_by($order_by_id, $order_by);
        }
        $resc = $this->db->get();
        return $resc->result_array();
    }

}

/*
 * EOF: ./application/models/Utility_model.php
 */