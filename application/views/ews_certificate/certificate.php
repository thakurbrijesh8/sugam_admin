<?php
$barcode_number = generate_barcode_number(VALUE_SEVEN, $ews_certificate_data['ews_certificate_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$ews_certificate_data['district']]) ? $taluka_array[$ews_certificate_data['district']] : '';

$sign_data = array();
$sign_data['status_datetime'] = $ews_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? $ews_certificate_data['status_datetime'] : '';

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
$mam_image = isset($mam_image_array[$ews_certificate_data['district']]) ? $mam_image_array[$ews_certificate_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$ews_certificate_data['district']]) ? $mam_image_array[$ews_certificate_data['district']]['short_text'] : '';
$mam_name = isset($mam_image_array[$ews_certificate_data['district']]) ? $mam_image_array[$ews_certificate_data['district']]['mamlatdar_name'] : '';

$comma_income = indian_comma_income($ews_certificate_data['income_by_talathi']);

$taluka_name_text = $taluka_name ? $taluka_name : '-';

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
<?php $this->load->view('certificate/contact_details', array('district' => $ews_certificate_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $ews_certificate_data['application_number']; ?>
    <div class="m-t-read" style="text-align: right;">Dated : <?php echo $ews_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($ews_certificate_data['status_datetime']) : ''; ?></div>
</div>
<hr>
<div style="font-size: 16px; text-align: center; margin-top: 5px;font-weight: bold;"><u>INCOME & ASSEST CERTIFICATE TO BE PRODUCED BY ECONOMICALLY WEAKER SECTIONS.<br>

        VALID FOR THE YEAR <?php echo $ews_certificate_data['application_year']; ?>
    </u></div>
<br/>
<?php
$app_f_name = ldc_app_details($ews_certificate_data, 'applicant_name', 'ldc_applicant_name');
if ($ews_certificate_data['constitution_artical'] == VALUE_ONE) {
    $app_name = $app_f_name;
} else {
    $app_name = ldc_app_details($ews_certificate_data, 'minor_child_name', 'ldc_minor_child_name');
}
?>
<?php
if ($ews_certificate_data['ldc_pr'] == '') {
    $full_pr = $ews_certificate_data['com_addr_village_dmc_ward'] . ', ' . $ews_certificate_data['com_addr_city'];
} else {
    $full_pr = $ews_certificate_data['ldc_pr'];
}
?>
<?php
if ($ews_certificate_data['ldc_address'] == '') {
    $full_address = $ews_certificate_data['com_addr_house_no'] . ', ' . $ews_certificate_data['com_addr_house_name'] . ', ' . $ews_certificate_data['com_addr_street'];
} else {
    $full_address = $ews_certificate_data['ldc_address'];
}
?>
<?php
if ($ews_certificate_data['ldc_religion_caste'] == '') {
    $religion_caste = $ews_certificate_data['applicant_religion'] . ' / ' . $ews_certificate_data['applicant_caste'];
} else {
    $religion_caste = $ews_certificate_data['ldc_religion_caste'];
}
?>
<?php $ldc_fin_yr = ldc_app_details($ews_certificate_data, 'application_year', 'ldc_financial_year'); ?>
<div class="f-s-14px" style="margin-left: 30px; margin-bottom: 5px;word-spacing: 8px;margin-top: 10px; line-height: 25px;text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;This is to certify that, Shri/Smt./Kumari <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $app_name; ?></b> Son / Daughter/ Wife of <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ews_certificate_data['father_name']; ?></b> permanent resident of <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $full_pr; ?></b> Village/Street <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $full_address; ?></b> Post Office <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ews_certificate_data['present_post_office']; ?></b> District <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $taluka_name_text; ?></b> in the Union Territory Dadra & Nagar Haveli and Daman & Diu Pin Code <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ews_certificate_data['com_pincode']; ?></b> whose photograph is attested below belongs to Economically Weaker Sections, since the gross annual income* of his/her family** <b>is below Rs. 8 lakh (Rupees Eight Lakh only) for the financial year <?php echo $ldc_fin_yr ?></b> His/her family does not own or possess any of the following assets***
</div>
<div class="f-s-14px" style="margin-left: 100px; margin-bottom: 5px;word-spacing: 8px;line-height: 25px;text-align: justify; text-justify: inter-word;">
    I. 5 acres of agricultural land and above.<br/>
    II. Residential flat of 1000 sq. ft. and above.<br/>
    III.    Residential plot of 100 sq. yards and above in notified municipalities.<br/>
    IV. Residential plot of 200 sq. yards and above in areas other than the notified municipalities.<br/>
</div>
<div class="f-s-14px" style="margin-left: 30px; margin-bottom: 10px;word-spacing: 8px;line-height: 25px;text-align: justify; text-justify: inter-word;">
    Shri/Smt/Kumari <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $app_name; ?></b> belongs to the <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $religion_caste; ?></b> caste which is not recognized as a Scheduled Caste, Scheduled Tribe and Other Backward Classes (Central List).
</div>
<?php
$sign_data['extra_style'] = 'margin-left: 50px;';
if ($ews_certificate_data['constitution_artical'] == VALUE_TWO) {
    $sign_data['applicant_photo_doc_path'] = EWS_CERTIFICATE_DOC_PATH . $ews_certificate_data['minor_child_photo'];
} else {
    $sign_data['applicant_photo_doc_path'] = EWS_CERTIFICATE_DOC_PATH . $ews_certificate_data['applicant_photo_doc'];
}

$sign_data['district'] = $ews_certificate_data['district'];
$sign_data['mam_image'] = $mam_image;
$sign_data['mam_name'] = $mam_name;
$sign_data['mtype'] = $mtype;
$sign_data['mam_district'] = (isset($mam_image_array[$ews_certificate_data['district']]) ? $mam_image_array[$ews_certificate_data['district']]['district'] : '');
$this->load->view('certificate/sign', $sign_data);
?>
<div class="f-s-14px" style="margin-top: 10px; font-size: 12px;margin-left: 30px; margin-bottom: 10px;word-spacing: 5px;line-height: 18px;text-align: justify; text-justify: inter-word;">
    <b>Note 1:</b> Income covered all sources i.e. salary, agriculture, business, profession, etc.<br/>
    <b>**Note 2:</b>  The term “Family” for this purpose include the person, who seeks benefit of reservation, his/her parents and siblings below the age of 18 years as also his/her spouse and children below the age of 18 years.<br/>
    <b>***Note 3:</b> The property held by a “Family” in different locations or different places/cities have been clubbed while applying the land or property holding test to determine EWS status
</div>
<?php $this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype)); ?>