<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

//    function regenerate_ews_certificate() {
//        $this->load->model('utility_model');
//
//        $ews_certificate_id = 25;
//
//        $ex_data = $this->utility_model->get_by_id('ews_certificate_id', $ews_certificate_id, 'ews_certificate');
//        if (empty($ex_data)) {
//            echo INVALID_ACCESS_MESSAGE;
//            return false;
//        }
//
//        echo '<pre>';
//        print_r($ex_data);
//        return false;
//        error_reporting(E_ERROR);
//        $data = array('ews_certificate_data' => $ex_data);
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
//        $mpdf->showWatermarkImage = true;
//        $mpdf->WriteHTML($this->load->view('ews_certificate/certificate', $data, TRUE));
//        $certificate_path = 'documents/temp/final_certificate_ews-' . $ews_certificate_id . rand(111111111, 99999999) . '_' . time() . '.pdf';
//        $mpdf->Output($certificate_path, 'F');
//
//        $cerificate_data = array();
//        $cerificate_data['certificate'] = chunk_split(base64_encode(file_get_contents($certificate_path)));
//
//        $this->utility_model->update_data('module_id', $ews_certificate_id, 'certificate', $cerificate_data, 'module_type', VALUE_SEVEN);
//        if (file_exists($certificate_path)) {
//            unlink($certificate_path);
//        }
//    }

//
//    function check_for_return_response() {
//
//        $dv_request_params = PG_AGG_ID . "|" . PG_MID . "|eRqa7w|4507725892336|" . 5 . '|INR|DMN-13HiKY117183814524597I&XIV/2023/03430';
//        $refund_request = http_build_query(array('refundRequest' => $dv_request_params, "aggregatorId" => PG_AGG_ID, "merchantId" => PG_MID));
////        echo $dv_request_params .'<br>';
////        echo $refund_request;
////        return;
//        $ch = curl_init('https://www.sbiepay.sbi/payagg/orderRefundCancellation/bookRefundCancellation');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50000);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
//        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
//        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $refund_request);
//        $response = curl_exec($ch);
//        if (curl_errno($ch)) {
//            $dv_data['dv_status'] = VALUE_THREE;
//            $dv_data['dv_message'] = curl_error($ch);
//        }
//        curl_close($ch);
//        echo '<pre>';
//        $return_data = explode('|', $response);
//        print_r($return_data);
//
//        $iv = $this->payment_lib->generate_iv();
//        $decrypted_string = $this->payment_lib->decrypt(PG_KEY, $response, $iv);
//        if (!$decrypted_string) {
////            $this->load->view('error', array('error_message' => INVALID_ACCESS_MESSAGE));
////            return;
//        }
//
//        print_r(explode('|', $decrypted_string));
//    }
//    function check_dv_response() {
//        $dv_request_params = "|" . PG_MID . "|DMN-13HiKY117183814524597I&XIV/2023/03430|" . 5;
//        $query_request = http_build_query(array('queryRequest' => $dv_request_params, "aggregatorId" => PG_AGG_ID, "merchantId" => PG_MID));
//
//        $ch = curl_init(PG_DV_URL);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50000);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
//        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
//        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_request);
//        $response = curl_exec($ch);
//        if (curl_errno($ch)) {
//            $dv_data['dv_status'] = VALUE_THREE;
//            $dv_data['dv_message'] = curl_error($ch);
//        }
//        curl_close($ch);
//        $return_data = explode('|', $response);
//        print_r($return_data);
//    }
//    function print_query() {
//        for ($i = 600; $i <= 625; $i++) {
//            echo "SELECT * FROM `rural_land_parcels` WHERE `village` = '524929' AND `survey` = '" . $i . "' AND `area_type` = '0';<br>";
//        }
//    }
//    function get_vss_wise_previous_year_details() {
//        $this->load->model('landtax_na_model');
//        $this->load->model('utility_model');
//        $district = TALUKA_DAMAN;
////        $village = 524924; //Thana Pardi
////        $village = 524925; //Zari
////        $village = 524927; //Kadaiya
////        $village = 524928; //Bhimpore
////        $village = 524912; //Janivankad
////        $village = 524915; //Magarwada
////        $village = 524914; //Ringanwada
////        $village = 524930; //Dabhel(CT)
////        $village = 802638; //Juprim
////        $village = 923609; //Kathiriya
////        $village = 524911; //Devka
////        $village = 524913; //Varkund
////        $village = 524931; //Kachigam
////        $village = 524916; //Damanwada(Dama  0-De-Cima)
////        $village = 524917; //Palhit
////        $village = 524918; //Bhamati
////        $village = 524919; //Dholar
////        $village = 524920; //Jampore
////        $village = 524921; //Pariyari
////        $village = 524922; //Deva Pardi
////        $village = 524923; //Naila Pardi
////        $village = 524926; //Marwad
////        $village = 524929; //Dunetha(CT)
//        $village = 10000;
//        $prev_fy = '2023-24';
//        $next_fy = '2024-25';
//        $ld_details = $this->landtax_na_model->get_all_na_land_detail_by_khata_number($district, $village, '');
//        echo '<pre>';
//        print_r(count($ld_details));
//        return;
//        foreach ($ld_details as $ldd) {
//            $ldd['arrears'] = $ldd['arrears'] ? $ldd['arrears'] : 0;
//            $ldd['total_land_tax_payment'] = $ldd['total_land_tax_payment'] ? $ldd['total_land_tax_payment'] : 0;
//            $ldd['current_year_due_tax'] = $ldd['current_year_due_tax'] ? $ldd['current_year_due_tax'] : 0;
//            $exd = $this->utility_model->get_by_id_multiple('village', $ldd['village'], 'rlp_land_tax', 'survey', $ldd['survey'], 'subdiv', $ldd['subdiv'], 'financial_year', $prev_fy);
//            if (empty($exd)) {
//                $i_rlplt = array();
//                $i_rlplt['financial_year'] = $prev_fy;
//                $i_rlplt['district'] = $district;
//                $i_rlplt['village'] = $ldd['village'];
//                $i_rlplt['survey'] = $ldd['survey'];
//                $i_rlplt['subdiv'] = $ldd['subdiv'];
//                $i_rlplt['area'] = $ldd['area'];
//                $i_rlplt['per_guntha_price'] = $ldd['area_type'] == VALUE_ONE ? RLP_UA_PRICE_PER_GUNTHA : RLP_RA_PRICE_PER_GUNTHA;
//                $i_rlplt['arrears'] = VALUE_ZERO;
//                $i_rlplt['land_tax'] = $ldd['current_year_due_tax'];
//                $i_rlplt['created_time'] = '2024-04-01 00:00:00';
//                $this->utility_model->insert_data('rlp_land_tax', $i_rlplt);
//            } else {
//                $u_rlplt = array();
//                $u_rlplt['rlp_land_tax_id'] = $exd['rlp_land_tax_id'];
//                $u_rlplt['land_tax'] = $ldd['current_year_due_tax'];
//                $u_rlplt['updated_by'] = VALUE_ZERO;
//                $u_rlplt['updated_time'] = '2024-04-01 00:00:00';
//                $this->utility_model->update_data('rlp_land_tax_id', $exd['rlp_land_tax_id'], 'rlp_land_tax', $u_rlplt);
//            }
//            $pending_tax = $ldd['current_year_due_tax'] + $ldd['arrears'] - $ldd['total_land_tax_payment'];
//            $i_new_rlplt = array();
//            $i_new_rlplt['financial_year'] = $next_fy;
//            $i_new_rlplt['district'] = $district;
//            $i_new_rlplt['village'] = $ldd['village'];
//            $i_new_rlplt['survey'] = $ldd['survey'];
//            $i_new_rlplt['subdiv'] = $ldd['subdiv'];
//            $i_new_rlplt['area'] = $ldd['area'];
//            $i_new_rlplt['per_guntha_price'] = $ldd['area_type'] == VALUE_ONE ? RLP_UA_PRICE_PER_GUNTHA : RLP_RA_PRICE_PER_GUNTHA;
//            $i_new_rlplt['arrears'] = $pending_tax;
//            $i_new_rlplt['created_time'] = '2024-04-01 00:00:00';
//            $this->utility_model->insert_data('rlp_land_tax', $i_new_rlplt);
//        }
//    }
    //    function update_is_na() {
//        $sql = "SELECT *
//FROM `rural_land_parcels`
//WHERE `village` = '923609' and area_type = 0";
//
//        $query = $this->db->query($sql);
//        $result = $query->result_array();
//        echo '<pre>';
//        print_r($result);
//        $cnt = '';
//        foreach ($result as $value) {
//            $value['survey'] = intval($value['survey']);
//            if ($value['survey'] < 342 || $value['survey'] > 405) {
//                $cnt .= $value['occupant_id'] . ',';
//            }
//        }
//        echo $cnt;
//    }
//
//    function api_for_get_submitted_app_prev_financial_year() {
//        $module_type_array = $this->config->item('query_module_array');
//        echo '<table>';
//        echo '<tr><td>Service Name</td><td>Department Name</td><td>Total</td></tr>';
//        foreach ($module_type_array as $mt_array) {
//            if (isset($mt_array['day'])) {
//                $this->db->select(' count(' . $mt_array['key_id_text'] . ') AS total_records');
//                $this->db->where('is_delete != ' . VALUE_ONE);
//                $this->db->where("submitted_datetime >= '2023-04-01 00:00:00'");
//                $this->db->where("submitted_datetime < '2024-04-01 00:00:00'");
//                $this->db->from($mt_array['tbl_text']);
//                $resc = $this->db->get();
//                $result = $resc->result_array();
//
//                foreach ($result as $rd) {
//                    echo '<tr><td>' . $mt_array['title'] . '</td><td>' . $mt_array['department_name'] . '</td>'
//                    . '<td>' . $rd['total_records'] . '</td>'
//                    . '</tr>';
//                }
//            }
//        }
//        echo '</table>';
//    }
//
//    function registered_document_report() {
//        $this->db->select('r.application_number, r.temp_application_number, r.doc_type, r.submitted_datetime, r.status_datetime, '
//                . 'r.doc_consideration_amount, r.sd_amount, pd.party_type, pd.party_description, pd.party_name, pd.party_address, pd.party_mobile_number');
//        $this->db->where('r.status', 5);
//        $this->db->from('document_registration AS r');
//        $this->db->join('dr_party_details AS pd', 'pd.document_registration_id = r.document_registration_id AND pd.party_type=1 AND pd.is_delete!=1');
//        $this->db->order_by('r.document_registration_id', 'ASC');
//        $resc = $this->db->get();
//        $rd_list = $resc->result_array();
//        header('Content-Type: text/csv; charset=utf-8');
//        header('Content-Disposition: attachment; filename=registered_document_list_' . date('Y-m-d H:i:s') . '.csv');
//        $output = fopen("php://output", "w");
//        fputcsv($output, array('Temp Application Number', 'Doc. Number', 'Document Type', 'Application Submission Date',
//            'Document Registration Date', 'Consideration Amount', 'Entered by User', 'Stamp Duty Amount',
//            'Party Type', 'Party Description', 'Party Name', 'Party Address', 'Party Mobile Number'));
//        if (!empty($rd_list)) {
//            $doc_type_array = $this->config->item('doc_type_array');
//            $party_category_array = $this->config->item('party_category_array');
//            $party_description_array = $this->config->item('party_description_array');
//            foreach ($rd_list as $list) {
//                $list['doc_type'] = isset($doc_type_array[$list['doc_type']]) ? $doc_type_array[$list['doc_type']] : '';
//                $list['party_type'] = isset($party_category_array[$list['party_type']]) ? $party_category_array[$list['party_type']] : '';
//                $list['party_description'] = isset($party_description_array[$list['party_description']]) ? $party_description_array[$list['party_description']] : '';
//                $list['submitted_datetime'] = $list['submitted_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_datetime_format($list['submitted_datetime']) : '';
//                $list['status_datetime'] = $list['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_datetime_format($list['status_datetime']) : '';
//                fputcsv($output, $list);
//            }
//        }
//        fclose($output);
//    }
//    function pdf_report() {
//        $private_key = openssl_pkey_new();
//        $csr = openssl_csr_new(array(), $private_key);
//        $x509 = openssl_csr_sign($csr, null, $private_key, 365);
//        openssl_x509_export($x509, $public_cert);
//        $pdf_data = file_get_contents('path/to/document.pdf');
//        openssl_pkcs7_sign($pdf_data, $signed_pdf, $public_cert, $private_key, array(), PKCS7_BINARY | PKCS7_DETACHED);
//        file_put_contents('path/to/signed_document.pdf', $signed_pdf);
//    }
//    function pdf_report() {
//        $pdf = new TCPDF();
//        $pdf->AddPage();
//        $pdf->SetFont('helvetica', '', 12);
//        $pdf->Write(0, 'This document has been signed with a DSC.');
//        $pdf->setSignature('file://path/to/private.key', 'file://path/to/public.crt', '', '', 2, 'dsdsd');
//        $pdf->setSignatureAppearance(100, 40, 15, 15);
//        $pdf->Output('signed_document.pdf', 'I');
//    }
//    function get_pending_ror() {
//        $this->db->select('fof.form_one_fourteen_id, fof.district, fof.application_number, fof.status, fof.land_details, '
//                . 'fof.applicant_name, fof.father_name, fof.surname, fof.spouse_name, fof.mobile_number, fof.email, '
//                . 'fof.address, fof.purpose, fof.total_copies, fof.total_amount, fof.village, drv.village_name, '
//                . 'pd.reference_id, pd.op_transaction_datetime, fld.*, fc.created_time AS copy_created_time, fc.form_copy_id');
//        $this->db->where('fc.form_nakal', '');
//        $this->db->where('fc.form_copy_id', 5043);
//        $this->db->from('form_copy AS fc');
//        $this->db->join('form_land_details AS fld', 'fc.form_land_details_id=fld.form_land_details_id');
//        $this->db->join('form_one_fourteen AS fof', 'fof.form_one_fourteen_id=fld.module_id');
//        $this->db->join('daman_rural_villages AS drv', 'fof.village=drv.village');
//        $this->db->join('fees_payment AS pd', 'pd.reference_number=fof.last_op_reference_number');
//        $resc = $this->db->get();
//        $fofld_data = $resc->row_array();
////        echo '<pre>';
////        print_r($fofld_data);
////        return;
//        if (empty($fofld_data)) {
//            echo 'RoR Already Generated';
//            return;
//        }
//
////        if ($fofld_data['binary_nakal'] == '') {
//        $pdf_data = $this->utility_lib->get_daman_rural_ror_data($fofld_data['village'], $fofld_data['survey'], $fofld_data['subdiv']);
//        if (count($pdf_data) == 0) {
//            echo json_encode(get_error_array(ROR_NOT_FOUND_MESSAGE));
//            return false;
//        }
//        $binary_data = array();
//        $binary_data['binary_nakal'] = $pdf_data[0]['IXIV'];
//        $this->utility_model->update_data('form_land_details_id', $fofld_data['form_land_details_id'], 'form_land_details', $binary_data);
//
//        $fofld_data['binary_nakal'] = $binary_data['binary_nakal'];
////        }
//
//        error_reporting(E_ERROR);
//        $nakal_path = 'documents/temp/fof-' . $fofld_data['form_land_details_id'] . '.pdf';
//        file_put_contents($nakal_path, base64_decode($fofld_data['binary_nakal']));
//
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
//        $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; border-top:1px solid black; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
//        $page_count = $mpdf->setSourceFile($nakal_path);
//        for ($i = 1; $i <= $page_count; $i++) {
//            if ($i != 1) {
//                $mpdf->AddPage();
//            }
//            $mpdf->UseTemplate($mpdf->importPage($i));
//        }
//        $mpdf->defaultfooterline = 0;
//        $mpdf->SetFooter($this->load->view('form_one_fourteen/copy_footer_pending_ror', array('fof_data' => $fofld_data), TRUE));
//        $final_filepath = 'documents/temp/fof-new-' . $fofld_data['form_land_details_id'] . '-' . $i . '.pdf';
//        $mpdf->Output($final_filepath, 'F');
//        $fcu_data = array();
//        $fcu_data['form_nakal'] = chunk_split(base64_encode(file_get_contents($final_filepath)));
//        $this->utility_model->update_data('form_copy_id', $fofld_data['form_copy_id'], 'form_copy', $fcu_data);
//        if (file_exists($final_filepath)) {
//            unlink($final_filepath);
//        }
//        if (file_exists($nakal_path)) {
//            unlink($nakal_path);
//        }
//    }
//    function check_ror_nakal() {
//        $this->db->select('fof.form_one_fourteen_id, fof.district, fof.application_number, fof.status, fof.land_details, '
//                . 'fof.applicant_name, fof.father_name, fof.surname, fof.spouse_name, fof.mobile_number, fof.email, '
//                . 'fof.address, fof.purpose, fof.total_copies, fof.total_amount, fof.village, fld.*, fc.form_copy_id');
//        $this->db->where('fld.form_land_details_id', 74);
//        $this->db->from('form_land_details AS fld');
//        $this->db->join('form_one_fourteen AS fof', 'fof.form_one_fourteen_id=fld.module_id');
//        $this->db->join('form_copy AS fc', 'fc.form_land_details_id=fld.form_land_details_id');
//        $resc = $this->db->get();
//        $fofld_data = $resc->row_array();
////
//
//        $nakal_path = 'documents/temp/test_for_ror.pdf';
//        file_put_contents($nakal_path, base64_decode(''));
////return;
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => 10, 'margin_right' => 10]);
//        $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; border-top:1px solid black; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
//        $page_count = $mpdf->setSourceFile($nakal_path);
//        for ($i = 1; $i <= $page_count; $i++) {
//            $mpdf->UseTemplate($mpdf->importPage($i));
//        }
//        echo $mpdf->x . '<br>';
////        echo $mpdf->y . '<br>';
//        return;
//        $unusedSpaceW = $mpdf->w - $mpdf->lMargin - $mpdf->rMargin;
////
////        $mpdf->Rect($mpdf->x, $mpdf->y, $unusedSpaceW, $unusedSpaceH);
//
//        $mpdf->WriteHTML($this->load->view('form_one_fourteen/copy_fd', array('fof_data' => $fofld_data, 'unused_space' => $unusedSpaceH), TRUE));
//        $mpdf->defaultfooterline = 0;
//        $mpdf->SetFooter($this->load->view('form_one_fourteen/copy_footer', array('fof_data' => $fofld_data), TRUE));
//        $new_nakal_path = 'documents/temp/new.pdf';
//        $mpdf->Output($new_nakal_path, 'I');
//    }
//    
//    function check_esp_nakal() {
//        $nakal_path = 'documents/temp/Gauthan_area_1.pdf';
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal', 'margin_left' => 10, 'margin_right' => 10]);
//        $mpdf->WriteHTML('<style>@page{margin: 25px;}body {font-family: serif;}.f-aum{font-family: arial_unicode_ms; font-size: 12px;}.table-header {width: 100%; padding-top: 5px; padding-bottom: 5px;}.color-nic-blue{color: #0E4D92;}.footer-title{font-size: 10px;}.t-a-c{text-align: center;}</style>');
//        $page_count = $mpdf->setSourceFile($nakal_path);
//        for ($i = 1; $i <= $page_count; $i++) {
//            if ($i != 1) {
//                $mpdf->AddPage();
//            }
//            $mpdf->UseTemplate($mpdf->importPage($i));
//        }
//        $mpdf->WriteHTML($this->load->view('eocs_site_plan/copy_footer', array('fc_data' => array('form_copy_id' => 3),
//                    'espld_data' => array('mobile_number' => 7878447897)), TRUE));
//        $new_nakal_path = 'documents/temp/new.pdf';
//        $mpdf->Output($new_nakal_path, 'I');
//    }
//
//    function update_land_details_for_form() {
//        $this->db->select('fof.form_one_fourteen_id, fof.total_amount, fld.*');
//        $this->db->where('fof.form_one_fourteen_id', 377);
//        $this->db->where('fof.district', TALUKA_DAMAN);
//        $this->db->where('fof.status', VALUE_TWO);
//        $this->db->where('fof.land_details != ""');
//        $this->db->where('fof.is_delete != ' . VALUE_ONE);
//        $this->db->from('form_one_fourteen AS fof');
//        $this->db->join('form_land_details AS fld', 'fof.form_one_fourteen_id=fld.module_id AND fld.reference_number = "" AND '
//                . 'fld.module_type=' . VALUE_ONE . ' AND fld.is_delete != 1');
//        $resc = $this->db->get();
//        $result = $resc->result_array();
//        echo '<pre>';
//        print_r($result);
//        return false;
//        $temp_fof_array = array();
//        $fld_array = array();
//        $t_cnt = 1;
//        $fb_array = array();
//        foreach ($result as $sd) {
//            if (!isset($temp_fof_array[$sd['form_one_fourteen_id']])) {
//                $temp_fof_array[$sd['form_one_fourteen_id']] = array();
//                $temp_fof_array[$sd['form_one_fourteen_id']]['form_one_fourteen_id'] = $sd['form_one_fourteen_id'];
//                $temp_fof_array[$sd['form_one_fourteen_id']]['land_details'] = array();
//
//
//                $insert_data = array();
//                $insert_data['module_type'] = VALUE_THIRTEEN;
//                $insert_data['module_id'] = $sd['form_one_fourteen_id'];
//                $insert_data['dept_fd_id'] = 1;
//                $insert_data['fee_description'] = 'I&XIV Nakal Issuing Fee';
//                $insert_data['fee'] = $sd['total_amount'];
//                $insert_data['created_by'] = 0;
//                $insert_data['created_time'] = date('Y-m-d H:i:s');
//                array_push($fb_array, $insert_data);
//            }
//            $reference_number = $sd['module_type'] . '-' . $sd['module_id'] . '-' . $t_cnt . '-' . time() . '-' . generate_token(20);
//            array_push($fld_array, array('form_land_details_id' => $sd['form_land_details_id'], 'reference_number' => $reference_number));
//            array_push($temp_fof_array[$sd['form_one_fourteen_id']]['land_details'],
//                    array('reference_number' => $reference_number, 'survey' => $sd['survey'], 'subdiv' => $sd['subdiv'],
//                        'copies' => $sd['copies'], 'total_copy_generated' => VALUE_ZERO, 'amount' => $sd['amount']));
//            $t_cnt++;
//        }
//        $fof_array = array();
//        foreach ($temp_fof_array as $value) {
//            array_push($fof_array, array('form_one_fourteen_id' => $value['form_one_fourteen_id'], 'status' => VALUE_THREE,
//                'land_details' => json_encode($value['land_details'])));
//        }
//        if (!empty($fb_array)) {
//            $this->db->insert_batch('fees_bifurcation', $fb_array);
//        }
//        if (!empty($fof_array)) {
//            $this->db->update_batch('form_one_fourteen', $fof_array, 'form_one_fourteen_id');
//        }
//        if (!empty($fld_array)) {
//            $this->db->update_batch('form_land_details', $fld_array, 'form_land_details_id');
//        }
//    }
//    function update_land_details_for_form_in_all_modules() {
//        $this->_update_land_details_for_form(VALUE_ONE, 'form_one_fourteen');
////        $this->_update_land_details_for_form(VALUE_SEVEN, 'eocs_site_plan');
////        $this->_update_land_details_for_form(VALUE_EIGHT, 'property_card');
////        $this->_update_land_details_for_form(VALUE_NINE, 'eocs_site_plan_rural');
//    }
//
//    function _update_land_details_for_form($module_type, $m_name) {
//        ini_set('max_execution_time', 500);
//        ini_set('memory_limit', '-1');
//        $this->db->where('module_type', $module_type);
//        $this->db->where('is_delete != ' . VALUE_ONE);
//        $this->db->from('form_land_details');
//        $resc = $this->db->get();
//        $result = $resc->result_array();
//        $t_array = array();
//        foreach ($result as $sd) {
//            if (!isset($t_array[$sd['module_id']])) {
//                $t_array[$sd['module_id']] = array();
//                $t_array[$sd['module_id']][$m_name . '_id'] = $sd['module_id'];
//                $t_array[$sd['module_id']]['land_details'] = array();
//            }
//            array_push($t_array[$sd['module_id']]['land_details'],
//                    array('form_land_details_id' => $sd['form_land_details_id'], 'survey' => $sd['survey'], 'subdiv' => $sd['subdiv'],
//                        'copies' => $sd['copies'], 'total_copy_generated' => $sd['total_copy_generated'], 'amount' => $sd['amount']));
//        }
//        $u_data = array_values($t_array);
////        echo '<pre>';
////        print_r($u_data);
////        return;
//        foreach ($u_data as &$tu_data) {
//            $tu_data['land_details'] = json_encode($tu_data['land_details']);
//        }
//        if (!empty($u_data)) {
//            $this->db->update_batch($m_name, $u_data, $m_name . '_id');
//        }
//    }
//    function update_appointment_details_in_all_modules() {
//        $this->_update_appointment_details(VALUE_ONE);
//        $this->_update_appointment_details(VALUE_TWO);
//        $this->_update_appointment_details(VALUE_THREE);
//        $this->_update_appointment_details(VALUE_FOUR);
//        $this->_update_appointment_details(VALUE_FIVE);
//        $this->_update_appointment_details(VALUE_SIX);
//    }
//
//    function _update_appointment_details($module_type) {
//        $all_qm_data = $this->config->item('query_module_array');
//        $qm_data = $all_qm_data[$module_type];
//
//        $this->db->where('is_delete != ' . VALUE_ONE);
//        $this->db->where('appointment_status', VALUE_ONE);
//        $this->db->from($qm_data['tbl_text']);
//        $resc = $this->db->get();
//        $result = $resc->result_array();
//        $update_array = array();
//        foreach ($result as $sd) {
//            array_push($update_array, array($qm_data['key_id_text'] => $sd[$qm_data['key_id_text']], 'appointment_history' =>
//                json_encode(array(array('appointment_date' => $sd['appointment_date'], 'appointment_time' => $sd['appointment_time'],
//                        'appointment_by' => $sd['appointment_by'], 'appointment_by_name' => $sd['appointment_by_name'],
//                        'appointment_type' => 2, 'appointment_datetime' => $sd['appointment_datetime'])))));
//        }
//        if (!empty($update_array)) {
//            $this->db->update_batch($qm_data['tbl_text'], $update_array, $qm_data['key_id_text']);
//        }
//    }
//    function update_sd_details() {
//        $this->db->where('sd_paper_number!=""');
//        $this->db->from('document_registration');
//        $resc = $this->db->get();
//        $result = $resc->result_array();
//        echo '<pre>';
//        $update_array = array();
//        foreach ($result as $sd) {
//            array_push($update_array, array('document_registration_id' => $sd['document_registration_id'], 'sd_details' => json_encode(array(array('sd_paper_number' => $sd['sd_paper_number'], 'sd_amount' => $sd['sd_amount'])))));
//        }
//        if (!empty($update_array)) {
//            $this->db->update_batch('document_registration', $update_array, 'document_registration_id');
//        }
//    }
//    function send_email() {
//        $email = 'solanki.vishal@supportgov.in';
//        $config = array();
//        $config['protocol'] = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
//        $config['smtp_host'] = "smtp.googlemail.com"; // you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
//        $config['smtp_user'] = "noreply.dddgov@gmail.com"; // client email gmail id
//        $config['smtp_pass'] = "vdpjhqynoxeeqnio"; // client password
//        $config['smtp_port'] = 465;
//        $config['smtp_crypto'] = 'ssl';
//        $config['mailtype'] = "html";
//        $config['charset'] = "iso-8859-1";
//        $config['newline'] = "\r\n";
//        $config['wordwrap'] = TRUE;
//        $config['validate'] = FALSE;
//        $this->load->library('email', $config);
////        $this->load->library('encrypt');
//        $this->email->to(trim($email));
//        $this->email->from(FROM_EMAIL, FROM_NAME);
//        $this->email->subject('Test');
//        $this->email->message('Test MSG Check For SPAM or Not');
//        $this->email->set_mailtype("html");
//        $email_log = array();
//        if (!$this->email->send()) {
//            $email_log['status'] = 'fail';
//            $email_log['message'] = $this->email->print_debugger();
//        } else {
//            $email_log['status'] = 'success';
//        }
//        $email_log['email'] = trim($email);
//        $email_log['email_type'] = 0;
//        $email_log['created_by'] = 0;
//        $email_log['created_time'] = date('Y-m-d H:i:s');
//        $this->load->model('logs_model');
//        $this->logs_model->insert_log('logs_email', $email_log);
//    }
//    function update_other_village() {
//        $this->db->from('district');
//        $resc = $this->db->get();
//        $all_dist = $resc->result_array();
//
//        $temp_dist_array = array();
//        $t_vcode = 999001;
//        foreach ($all_dist as $dist) {
//            array_push($temp_dist_array, array('state_code' => $dist['state_code'], 'state_code' => $dist['state_code'],
//                'district_code' => $dist['district_code'], 'village_code' => $t_vcode, 'village_name' => 'Other',
//                'created_time' => date('Y-m-d H:i:s')));
//            $t_vcode++;
//        }
//        if (!empty($t_vcode)) {
//            $this->db->insert_batch('all_villages', $temp_dist_array);
//        }
//    }
//    function eocs_site_plan_dynamic_sign() {
//        $nakal_path = 'documents/temp/FORMATOFSITEPLANWS.pdf';
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
//        $page_count = $mpdf->setSourceFile($nakal_path);
//        for ($i = 1; $i <= $page_count; $i++) {
//            if ($i == 1) {
//                $mpdf->WriteHTML($this->load->view('eocs_site_plan/au_sign', array('m_type' => VALUE_TWO, 't_id' => 25, 's_name' => 'M.M. VANKAR', 's_type_name' => 'FIELD SURVEYOR'), TRUE));
//                $mpdf->WriteHTML($this->load->view('eocs_site_plan/au_sign', array('m_type' => VALUE_THREE, 't_id' => 27, 's_name' => 'J.P. PATEL', 's_type_name' => 'I/C HEAD SURVEYOR'), TRUE));
//                $mpdf->WriteHTML($this->load->view('eocs_site_plan/au_sign', array('m_type' => VALUE_FOUR, 't_id' => 24, 's_name' => 'PREMJI MAKVANA', 's_type_name' => 'ENQUIRY OFFICER CITY SURVEY, DAMAN.'), TRUE));
//            } else {
//                $mpdf->AddPage();
//            }
//            $mpdf->UseTemplate($mpdf->importPage($i));
//        }
//        $mpdf->Output('output.pdf', 'I');
//    }
//    function form_d_dynamic_sign() {
//        $nakal_path = 'documents/temp/289-1-1679913707.pdf';
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Letter']);
//        $page_count = $mpdf->setSourceFile($nakal_path);
//        for ($i = 1; $i <= $page_count; $i++) {
//            if ($i == 1) {
//                $mpdf->WriteHTML($this->load->view('eocs_site_plan/au_sign_fd', array('m_type' => VALUE_TWO, 't_id' => 25, 's_name' => 'M.M. VANKAR', 's_type_name' => 'FIELD SURVEYOR'), TRUE));
//                $mpdf->WriteHTML($this->load->view('eocs_site_plan/au_sign_fd', array('m_type' => VALUE_THREE, 't_id' => 27, 's_name' => 'J.P. PATEL', 's_type_name' => 'I/C HEAD SURVEYOR'), TRUE));
//                $mpdf->WriteHTML($this->load->view('eocs_site_plan/au_sign_fd', array('m_type' => VALUE_FOUR, 't_id' => 24, 's_name' => 'PREMJI MAKVANA', 's_type_name' => 'ENQUIRY OFFICER CITY SURVEY', 'district_text' => 'DAMAN.'), TRUE));
//            } else {
//                $mpdf->AddPage();
//            }
//            $mpdf->UseTemplate($mpdf->importPage($i));
//        }
//        $mpdf->Output('output.pdf', 'I');
//    }
//    function form_b_dynamic_sign() {
//        $nakal_path = 'documents/temp/289-1-1679913708.pdf';
//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A3', 'orientation' => 'L']);
//        $page_count = $mpdf->setSourceFile($nakal_path);
//        for ($i = 1; $i <= $page_count; $i++) {
//            if ($i == 1) {
//                $mpdf->WriteHTML($this->load->view('eocs_site_plan/au_sign_fb', array('m_type' => VALUE_TWO, 't_id' => 25, 's_name' => 'M.M. VANKAR', 's_type_name' => 'FIELD SURVEYOR'), TRUE));
//                $mpdf->WriteHTML($this->load->view('eocs_site_plan/au_sign_fb', array('m_type' => VALUE_THREE, 't_id' => 27, 's_name' => 'J.P. PATEL', 's_type_name' => 'I/C HEAD SURVEYOR'), TRUE));
//                $mpdf->WriteHTML($this->load->view('eocs_site_plan/au_sign_fb', array('m_type' => VALUE_FOUR, 't_id' => 24, 's_name' => 'PREMJI MAKVANA', 's_type_name' => 'ENQUIRY OFFICER CITY SURVEY', 'district_text' => 'DAMAN.'), TRUE));
//            } else {
//                $mpdf->AddPage();
//            }
//            $mpdf->UseTemplate($mpdf->importPage($i));
//        }
//        $mpdf->Output('output.pdf', 'I');
//    }
}

/*
     * EOF: ./application/controller/Api.php
     */    

