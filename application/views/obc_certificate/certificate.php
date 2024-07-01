<?php
$barcode_number = generate_barcode_number(VALUE_FIVE, $obc_certificate_data['obc_certificate_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$obc_certificate_data['district']]) ? $taluka_array[$obc_certificate_data['district']] : '';

$sign_data = array();
$sign_data['status_datetime'] = $obc_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? $obc_certificate_data['status_datetime'] : '';

$header_array = array();
$header_array['title'] = 'Certificate';
$header_array['department_name'] = 'Office of the Mamlatdar';
$header_array['district'] = $taluka_name;
$mtype = isset($mtype) ? $mtype : VALUE_TWO;
$header_array['mtype'] = $mtype;
//Ex.  A4, Legal
$header_array['page_size'] = 'Legal';
$header_array['sign_data'] = $sign_data;
$this->load->view('certificate/header', $header_array);

$mam_image_array = $this->config->item('mam_image_array');
$mam_image = isset($mam_image_array[$obc_certificate_data['district']]) ? $mam_image_array[$obc_certificate_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$obc_certificate_data['district']]) ? $mam_image_array[$obc_certificate_data['district']]['short_text'] : '';
$mam_name = isset($mam_image_array[$obc_certificate_data['district']]) ? $mam_image_array[$obc_certificate_data['district']]['mamlatdar_name'] : '';

$aobc_caste_array = $this->config->item('applicant_obc_caste_array');
$aobc_caste_array_one = $this->config->item('applicant_obc_caste_arrayOne');
$aobc_caste_array_two = $this->config->item('applicant_obc_caste_arrayTwo');
$aobc_caste_array_three = $this->config->item('applicant_obc_caste_arrayThree');

$t_certi_type = $obc_certificate_data['cert_type_reverify'] != VALUE_ZERO ? $obc_certificate_data['cert_type_reverify'] : $obc_certificate_data['cert_type'];
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

    .check {
        display: inline-block;
        transform: rotate(45deg);
        height: var(--height);
        width: var(--width);
        border-bottom: var(--borderWidth) solid var(--borderColor);
        border-right: var(--borderWidth) solid var(--borderColor);
    }

</style>
<?php $this->load->view('certificate/contact_details', array('district' => $obc_certificate_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $obc_certificate_data['application_number']; ?>
    <div class="m-t-read" style="text-align: right;">Dated : <?php echo $obc_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($obc_certificate_data['status_datetime']) : ''; ?></div>
</div>
<hr>
<?php
$commu_address = $obc_certificate_data['ldc_commu_address'] != '' ? $obc_certificate_data['ldc_commu_address'] :
        (($obc_certificate_data['com_addr_house_no'] != '' ? ($obc_certificate_data['com_addr_house_no'] . ', ') : '')
        . ($obc_certificate_data['com_addr_house_name'] != '' ? ($obc_certificate_data['com_addr_house_name'] . ', ') : '')
        . ($obc_certificate_data['com_addr_street'] != '' ? ($obc_certificate_data['com_addr_street'] . ', ') : '')
        . ($obc_certificate_data['com_addr_village_dmc_ward'] != '' ? ($obc_certificate_data['com_addr_village_dmc_ward'] . ', ') : '')
        . ($obc_certificate_data['com_addr_city'] != '' ? ($obc_certificate_data['com_addr_city']) : ''));

$father_details = $obc_certificate_data['father_details'] != '' ? json_decode($obc_certificate_data['father_details'], true) : array();

$app_f_name = ldc_app_details($obc_certificate_data, 'applicant_name', 'ldc_applicant_name');
if ($obc_certificate_data['constitution_artical'] == VALUE_ONE) {
    $app_name = $app_f_name;
} else {
    $app_name = ldc_app_details($obc_certificate_data, 'minor_child_name', 'ldc_minor_child_name');
}

$obc_certificate_data['f_name'] = isset($father_details['father_name']) ? $father_details['father_name'] : '';
$ldc_f_name = ldc_app_details($obc_certificate_data, 'f_name', 'ldc_father_name');

$obc_certificate_data['t_ldv_vt'] = $obc_certificate_data['com_addr_village_dmc_ward'] . ', ' . $obc_certificate_data['com_addr_city'];
$ldv_vt = ldc_app_details($obc_certificate_data, 't_ldv_vt', 'ldc_vt_name');
?>
<div style="font-size: 25px; text-align: center; margin-top: 5px;font-weight: bold;"><u> CERTIFICATE FOR OTHER BACKWARD CLASS</u></div>
<?php if ($t_certi_type == VALUE_TWO) { ?>
    <div style="font-size: 20px; text-align: center; margin-top: 5px;font-weight: bold;"><u>(Creamy Layer)</u></div>
<?php } ?>
<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 6px;margin-top: 20px; line-height: 25px;
     text-align: justify;">
    &nbsp;&nbsp;&nbsp;&nbsp;This is to certify that Shri/Smt./Kum. <b style="text-decoration: underline;">
        <span class="b-b-1px f-w-b" style="text-transform: capitalize;"><?php echo $app_name; ?></span></b>,
    Son/Daughter of <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ldc_f_name; ?></b>,
    of Village/Town <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ldv_vt; ?></b>,
    District <?php echo $taluka_name; ?> in the Union Territory of Dadra & Nagar Haveli and Daman & Diu, belongs to the "
    <b style="text-decoration: underline; text-transform: capitalize;"><?php echo isset($aobc_caste_array[$obc_certificate_data['obccaste']]) ? $aobc_caste_array[$obc_certificate_data['obccaste']] : ''; ?></b>
    " community, which is recognized as a Backward Class Vide -
</div>

<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 6px;margin-top: 10px; line-height: 25px;
     text-align: justify;">
    <b style="font-family: arial_unicode_ms;"><?php echo isset($aobc_caste_array_one[$obc_certificate_data['obccaste']]) ? '&#10003;' : '&#10005;'; ?></b>
    I. Resolution No. 12011/9/94-BCC dated 19th October, 1994 published in the Gazette of India Extraordinary Part – I, Section – 1 No. 163 dated 20th October, 1994
</div>


<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px;margin-bottom: 10px;word-spacing: 6px;margin-top: 15px; line-height: 25px;
     text-align: justify;">
    <b style="font-family: arial_unicode_ms;"><?php echo isset($aobc_caste_array_two[$obc_certificate_data['obccaste']]) ? '&#10003;' : '&#10005;'; ?></b>
    II. Resolution No. 12011/14/2004-BCC dated 12th March, 2007 published in the Gazette of India Extraordinary Part – I, Section – 1 No. 67 dated 12th March 2007
</div>

<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 6px;margin-top: 15px; line-height: 25px;
     text-align: justify;">
    <b style="font-family: arial_unicode_ms;"><?php echo isset($aobc_caste_array_three[$obc_certificate_data['obccaste']]) ? '&#10003;' : '&#10005;'; ?></b>
    III. Resolution No. 12015/2/2007-BCC dated 18th August, 2010 published in the Gazette of India Extraordinary Part – I, Section – 1, No. 232 dated 18th August, 2010.
</div>

<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 6px;margin-top: 20px;
     text-align: justify;">&nbsp;&nbsp; <b>(   <b style="font-family: arial_unicode_ms;"> &#10003;</b> The one applicable and strike out the Inapplicable ones )</b>
</div>

<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 6px;margin-top: 20px; line-height: 25px;
     text-align: justify;">
    &nbsp;&nbsp;&nbsp;&nbsp;2.  Shri/Smt./Kum. <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $app_name; ?></b>
    and/or/his/her family ordinarily reside(s) in Village
    <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ldv_vt; ?></b>
    of <?php echo $taluka_name; ?>. District of the Union Territory of Dadra & Nagar Haveli and Daman & Diu.
</div>

<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 6px;margin-top: 20px; line-height: 25px;
     text-align: justify;">
    &nbsp;&nbsp;&nbsp;&nbsp;3. This is also to certify that he/she does not belongs to the person / sections (<?php echo $t_certi_type == VALUE_TWO ? 'Non ' : ''; ?>Creamy Layer) 
    mentioned in Column 3 of the Schedule to the Government of Indian, Department of Personnel and Training 
    O. M.  No. 36012/22/93-EST (SCT) dated 08/09/1993, as amended from time to time.
</div>
<?php
$sign_data['extra_style'] = 'margin-left: 30px;';
$app_photo_doc = $obc_certificate_data['applicant_photo_doc'];
if ($obc_certificate_data['constitution_artical'] == VALUE_TWO && $obc_certificate_data['minor_child_photo_doc'] != '') {
    $app_photo_doc = $obc_certificate_data['minor_child_photo_doc'];
}
$sign_data['applicant_photo_doc_path'] = OBC_CERTIFICATE_DOC_PATH . $app_photo_doc;
$sign_data['district'] = $obc_certificate_data['district'];
$sign_data['mam_image'] = $mam_image;
$sign_data['mam_name'] = $mam_name;
$sign_data['mtype'] = $mtype;
$sign_data['mam_district'] = (isset($mam_image_array[$obc_certificate_data['district']]) ? $mam_image_array[$obc_certificate_data['district']]['district'] : '');
$this->load->view('certificate/sign', $sign_data);
?>
<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 3px;margin-top: 20px; line-height: 25px;
     text-align: justify;">
    Note :- The term “Ordinarily” used here will have the same meaning as in Section 20 of the Representation of the People Act, 1950.</div>

<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 6px;margin-top: 10px; line-height: 25px;
     text-align: justify;">
    <b>To,</b><br/>
    <b style="text-transform: capitalize;"><?php echo $app_f_name; ?></b><br>
    <b style="text-transform: capitalize;">R/O - <?php echo $commu_address; ?></b>
</div>
<?php $this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype)); ?>