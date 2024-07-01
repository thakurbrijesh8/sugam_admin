<?php
$barcode_number = generate_barcode_number(VALUE_TWO, $income_certificate_data['income_certificate_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$income_certificate_data['district']]) ? $taluka_array[$income_certificate_data['district']] : '';

$sign_data = array();
$sign_data['status_datetime'] = $income_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? $income_certificate_data['status_datetime'] : '';

$header_array = array();
$header_array['title'] = 'Certificate';
$header_array['department_name'] = 'Office of the Mamlatdar';
$header_array['district'] = $taluka_name;
$mtype = isset($mtype) ? $mtype : VALUE_TWO;
$header_array['mtype'] = $mtype;
//Ex.  A4, Legal
$header_array['page_size'] = 'A4';
$header_array['sign_data'] = $sign_data;
$this->load->view('certificate/header', $header_array);

$mam_image_array = $this->config->item('mam_image_array');
$mam_image = isset($mam_image_array[$income_certificate_data['district']]) ? $mam_image_array[$income_certificate_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$income_certificate_data['district']]) ? $mam_image_array[$income_certificate_data['district']]['short_text'] : '';
$mam_name = isset($mam_image_array[$income_certificate_data['district']]) ? $mam_image_array[$income_certificate_data['district']]['mamlatdar_name'] : '';

$temp_income = $income_certificate_data['income_by_talathi_reverify'] != 0 ? $income_certificate_data['income_by_talathi_reverify'] : $income_certificate_data['income_by_talathi'];
$comma_income = indian_comma_income($temp_income);
?>
<style type="text/css">
    .f-s-14px{
        font-size: 14px;
    }
    .read{
        margin-left: 50px;
        margin-bottom: 5px;
        word-spacing: 8px;
    }
    .m-t-read{
        margin-top: -18px;
    }
    .f-aum{
        font-family: arial_unicode_ms;
    }
</style>
<?php $this->load->view('certificate/contact_details', array('district' => $income_certificate_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $income_certificate_data['application_number']; ?>
    <div class="m-t-read" style="text-align: right;">Dated : <?php echo $income_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($income_certificate_data['status_datetime']) : ''; ?></div>
</div>
<hr>
<?php $ldc_app_name = ldc_app_details($income_certificate_data, 'applicant_name', 'ldc_applicant_name'); ?>
<div class="f-s-14px">READ :</div>
<table class="f-s-14px read">
    <tr>
        <td>1. Name of Applicant</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b" style="text-transform: capitalize;"><?php echo $ldc_app_name; ?></td>
    </tr>
    <tr>
        <td style="vertical-align: top;">2. Communication Address of Applicant</td>
        <td style="vertical-align: top;">&nbsp;:&nbsp;</td>
        <td class="f-w-b" style="text-transform: capitalize;"><?php echo $income_certificate_data['communication_address']; ?></td>
    </tr>
    <tr>
        <td>3. Application Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b"><?php echo $income_certificate_data['date'] != '0000-00-00' ? convert_to_new_date_format($income_certificate_data['date']) : ''; ?></td>
    </tr>
    <tr>
        <td>4. Declaration Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b"><?php echo $income_certificate_data['submitted_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($income_certificate_data['submitted_datetime']) : ''; ?></td>
    </tr>
    <tr>
        <td>5. Statement of Applicant Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b"><?php echo $income_certificate_data['appointment_date'] != '0000-00-00' ? convert_to_new_date_format($income_certificate_data['appointment_date']) : ''; ?></td>
    </tr>
    <tr>
        <td>6. Report of the Talathi Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b">
            <?php
            if ($income_certificate_data['aci_rec'] == VALUE_TWO && $income_certificate_data['talathi_to_reverify_datetime'] != '0000-00-00 00:00:00') {
                echo convert_to_new_date_format($income_certificate_data['talathi_to_reverify_datetime']);
            } else {
                echo $income_certificate_data['talathi_to_aci_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($income_certificate_data['talathi_to_aci_datetime']) : '';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>7. Verification Report of the C.I. Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b">
            <?php
            if ($income_certificate_data['aci_rec'] == VALUE_ONE) {
                echo $income_certificate_data['aci_to_ldc_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($income_certificate_data['aci_to_ldc_datetime']) : '';
            }
            if ($income_certificate_data['aci_rec'] == VALUE_TWO) {
                echo $income_certificate_data['aci_to_mamlatdar_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($income_certificate_data['aci_to_mamlatdar_datetime']) : '';
            }
            ?>
        </td>
    </tr>
</table>
<br/>
<div style="font-size: 30px; text-align: center; margin-top: 10px;font-weight: bold;"><u>Income Certificate</u></div>
<br/>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 8px;margin-top: 20px; line-height: 25px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;This is to certify that on inquiry, it is revealed that the Annual Income from all sources <?php echo ($sign_data['status_datetime'] == '' || $sign_data['status_datetime'] >= INC_AMD_DT) ? '(including the Applicant and the other family member) ' : ''; ?>of
    <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ldc_app_name; ?></b> 
    resident of <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $income_certificate_data['communication_address']; ?></b> 
    District <b style="text-decoration: underline;"><?php echo $taluka_name; ?></b> is <b style="text-decoration: underline;">&#8377;<?php echo $comma_income . '/- (' . convert_to_indian_currency($temp_income) . ')'; ?></b> 
    approximately.</div>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 8px;margin-top: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;This Certificate is issued on the request of the applicant.</div>
<?php
$sign_data['extra_style'] = 'margin-left: 50px;';
$sign_data['applicant_photo_doc_path'] = INCOME_CERTIFICATE_DOC_PATH . $income_certificate_data['applicant_photo_doc'];
$sign_data['district'] = $income_certificate_data['district'];
$sign_data['mam_image'] = $mam_image;
$sign_data['mam_name'] = $mam_name;
$sign_data['mtype'] = $mtype;
$sign_data['mam_district'] = (isset($mam_image_array[$income_certificate_data['district']]) ? $mam_image_array[$income_certificate_data['district']]['district'] : '');
$this->load->view('certificate/sign', $sign_data);
$this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype));
?>