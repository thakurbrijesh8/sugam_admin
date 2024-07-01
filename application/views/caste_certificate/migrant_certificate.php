<?php
$barcode_number = generate_barcode_number(VALUE_FOUR, $caste_certificate_data['caste_certificate_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$caste_certificate_data['district']]) ? $taluka_array[$caste_certificate_data['district']] : '';

$sign_data = array();
$sign_data['status_datetime'] = $caste_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? $caste_certificate_data['status_datetime'] : '';

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
$mam_image = isset($mam_image_array[$caste_certificate_data['district']]) ? $mam_image_array[$caste_certificate_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$caste_certificate_data['district']]) ? $mam_image_array[$caste_certificate_data['district']]['short_text'] : '';
$mam_name = isset($mam_image_array[$caste_certificate_data['district']]) ? $mam_image_array[$caste_certificate_data['district']]['mamlatdar_name'] : '';

$comma_income = indian_comma_income($caste_certificate_data['income_by_talathi']);

$applicant_caste_array = $this->config->item('caste_array');
$applicant_sc_subcaste_array = $this->config->item('applicant_sc_subcaste_array');
$applicant_st_subcaste_array = $this->config->item('applicant_st_subcaste_array');
if ($caste_certificate_data['applicant_caste'] == VALUE_ONE || $caste_certificate_data['applicant_caste'] == VALUE_TWO) {
    if ($caste_certificate_data['apllicant_sc_subcaste'] != '')
        $subcaste_text = $applicant_sc_subcaste_array[$caste_certificate_data['apllicant_sc_subcaste']];
    else
        $subcaste_text = $applicant_st_subcaste_array[$caste_certificate_data['apllicant_st_subcaste']];
}

$father_data = $caste_certificate_data['father_details'] ? json_decode($caste_certificate_data['father_details'], true) : array();
$mother_data = $caste_certificate_data['mother_details'] ? json_decode($caste_certificate_data['mother_details'], true) : array();

$app_caste = $caste_certificate_data['caste_by_aci_reverify'] != VALUE_ZERO ? $caste_certificate_data['caste_by_aci_reverify'] :
        ($caste_certificate_data['caste_by_aci'] != VALUE_ZERO ? $caste_certificate_data['caste_by_aci'] :
        ($caste_certificate_data['applicant_caste']));
$app_caste_text = $applicant_caste_array[$app_caste] ? $applicant_caste_array[$app_caste] : '';

$sc_st_ff = $app_caste == 1 ? 'Scheduled Caste' : ($app_caste == 2 ? 'Scheduled Tribe' : '');
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
<?php $this->load->view('certificate/contact_details', array('district' => $caste_certificate_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $app_caste_text . '/' . $caste_certificate_data['application_number']; ?>
    <div class="m-t-read" style="text-align: right;">Dated : <?php echo $caste_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($caste_certificate_data['status_datetime']) : ''; ?></div>
</div>
<hr>
<?php
$app_f_name = ldc_app_details($caste_certificate_data, 'applicant_name', 'ldc_applicant_name');
if ($caste_certificate_data['constitution_artical'] == VALUE_ONE) {
    $app_name = $app_f_name;
} else {
    $app_name = ldc_app_details($caste_certificate_data, 'minor_child_name', 'ldc_minor_child_name');
}

$caste_certificate_data['f_name'] = isset($father_details['father_name']) ? $father_details['father_name'] : '';
$ldc_f_name = ldc_app_details($caste_certificate_data, 'f_name', 'ldc_father_name');

$caste_certificate_data['t_ldv_vt'] = $caste_certificate_data['com_addr_village_dmc_ward'] . ', ' . $caste_certificate_data['com_addr_city'];
$ldv_vt = ldc_app_details($caste_certificate_data, 't_ldv_vt', 'ldc_vt_name');

$ldc_ar = ldc_app_details($caste_certificate_data, 'applicant_religion', 'ldc_applicant_religion');
?>
<div class="f-s-14px">READ :</div>
<table class="f-s-14px read">
    <tr>
        <td>1. Application Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b"><?php echo $caste_certificate_data['submitted_datetime'] != '0000-00-00' ? convert_to_new_date_format($caste_certificate_data['submitted_datetime']) : ''; ?></td>
    </tr>
    <tr>
        <td>2. Name of Applicant</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b" style="text-transform: capitalize;"><?php echo $app_f_name; ?></td>
    </tr>
    <tr>
        <td>3. Statement of Applicant and Panchas Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b"><?php echo $caste_certificate_data['appointment_date'] != '0000-00-00' ? convert_to_new_date_format($caste_certificate_data['appointment_date']) : ''; ?></td>
    </tr>
    <tr>
        <td>4. Report of the Talathi Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b">
            <?php
            if ($caste_certificate_data['aci_rec'] == VALUE_TWO && $caste_certificate_data['talathi_to_reverify_datetime'] != '0000-00-00 00:00:00') {
                echo convert_to_new_date_format($caste_certificate_data['talathi_to_reverify_datetime']);
            } else {
                echo $caste_certificate_data['talathi_to_aci_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($caste_certificate_data['talathi_to_aci_datetime']) : '';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>5. Verification Report of the C.I. Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td>
            <?php
            if ($caste_certificate_data['aci_rec'] == VALUE_ONE) {
                echo $caste_certificate_data['aci_to_ldc_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($caste_certificate_data['aci_to_ldc_datetime']) : '';
            }
            if ($caste_certificate_data['aci_rec'] == VALUE_TWO) {
                echo $caste_certificate_data['aci_to_mamlatdar_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($caste_certificate_data['aci_to_mamlatdar_datetime']) : '';
            }
            ?>
        </td>
    </tr>
</table>
<br/>
<div style="font-size: 30px; text-align: center; margin-top: 10px;font-weight: bold;"><u>Caste Certificate</u></div>
<br/>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 8px;margin-top: 20px; line-height: 25px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;This is to certify that Shri/Smt/Kum. <b style="text-decoration: underline; text-transform: capitalize;">
        <?php echo $app_name; ?></b>, Son / Daughter of Shri.
    <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ldc_f_name; ?></b>   
    and Smt. <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $mother_data['mother_name']; ?></b>
    and <b style="text-decoration: underline; text-transform: capitalize;">R/o. <?php echo $caste_certificate_data['com_addr_house_no']; ?>,
        <?php echo $caste_certificate_data['com_addr_house_name']; ?>, <?php echo $caste_certificate_data['com_addr_street']; ?></b>
    in District <?php echo $taluka_name; ?> of the Union Territory of Dadra & Nagar Haveli and Daman & Diu belongs to the Caste
    <b><u style="text-transform: capitalize;"><?php
            if ($app_caste == VALUE_ONE || ($app_caste == VALUE_TWO && $caste_certificate_data['status_datetime'] <= RELIGION_LAST_DATE_IN_CC && $mtype == VALUE_TWO)) {
                echo $ldc_ar . ' - ' . $subcaste_text;
            } else {
                echo $subcaste_text;
            }
            ?></u></b>
    which is recognized as a <b><u><?php echo $sc_st_ff; ?></u></b>
    under the Constitution (<b><u><?php echo $sc_st_ff; ?></u></b>)
    (Union Territories) Order, 1951 as amended under Goa, Daman and Diu Reorganization Act, 1987.</div>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 8px;margin-top: 20px; line-height: 25px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp; Shri/Smt/Kum.
    <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $app_name; ?></b>
    and/or his/her family ordinarily reside(s) in Village/Town
    <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ldv_vt; ?></b>
    of <?php echo $taluka_name; ?> District of the Union Territory of Dadra & Nagar Haveli, and Daman & Diu.
</div>
<?php
$sign_data['extra_style'] = 'margin-left: 50px;';
$sign_data['applicant_photo_doc_path'] = CASTE_CERTIFICATE_DOC_PATH . $caste_certificate_data['applicant_photo_doc'];
$sign_data['district'] = $caste_certificate_data['district'];
$sign_data['mam_image'] = $mam_image;
$sign_data['mam_name'] = $mam_name;
$sign_data['mtype'] = $mtype;
$sign_data['mam_district'] = (isset($mam_image_array[$caste_certificate_data['district']]) ? $mam_image_array[$caste_certificate_data['district']]['district'] : '');
$this->load->view('certificate/sign', $sign_data);
$this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype));
?>