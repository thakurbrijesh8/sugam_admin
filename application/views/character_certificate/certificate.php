<?php
$barcode_number = generate_barcode_number(VALUE_TEN, $character_certificate_data['character_certificate_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$character_certificate_data['district']]) ? $taluka_array[$character_certificate_data['district']] : '';

$sign_data = array();
$sign_data['status_datetime'] = $character_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? $character_certificate_data['status_datetime'] : '';

$header_array = array();
$header_array['title'] = 'Certificate';
$header_array['department_name'] = 'Office of the Mamlatdar';
$header_array['district'] = $taluka_name;
//Ex.  A4, Legal
$header_array['page_size'] = 'A4';
$header_array['sign_data'] = $sign_data;
$this->load->view('certificate/header', $header_array);

$mam_image_array = $this->config->item('mam_image_array');
$mam_image = isset($mam_image_array[$character_certificate_data['district']]) ? $mam_image_array[$character_certificate_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$character_certificate_data['district']]) ? $mam_image_array[$character_certificate_data['district']]['short_text'] : '';
$mam_name = isset($mam_image_array[$character_certificate_data['district']]) ? $mam_image_array[$character_certificate_data['district']]['mamlatdar_name'] : '';
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
<?php $this->load->view('certificate/contact_details', array('district' => $character_certificate_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $character_certificate_data['application_number']; ?>
    <div class="m-t-read" style="text-align: right;">Dated : <?php echo $character_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($character_certificate_data['status_datetime']) : ''; ?></div>
</div>
<hr>
<div class="f-s-14px">READ :</div>
<table class="f-s-14px read">
    <tr>
        <td>1. Application Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b">
            <?php echo $character_certificate_data['submitted_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($character_certificate_data['submitted_datetime']) : ''; ?>
            <br>
            Of
            <?php echo $character_certificate_data['applicant_name']; ?>
            <br>
            R / O <?php echo $character_certificate_data['com_addr_house_no'] . ',' . $character_certificate_data['com_addr_house_name'] . ',' . $character_certificate_data['com_addr_street'] . ',' . $character_certificate_data['com_addr_village_dmc_ward'] . ',' . $character_certificate_data['com_addr_city'] . ',' . $character_certificate_data['com_pincode']; ?> 
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;">2. Police Report  Number</td>
        <td style="vertical-align: top;">&nbsp;:&nbsp;</td>
        <td class="f-w-b"><?php //echo $character_certificate_data['communication_address'];        ?></td>
    </tr>
</table>
<br/>
<div style="font-size: 30px; text-align: center; margin-top: 10px;font-weight: bold;"><u>Character Certificate</u></div>
<br/>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 8px;margin-top: 20px; line-height: 25px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;Certified on the basis of the inquiries caused throught police in respect <b style="text-decoration: underline;"><?php echo $character_certificate_data['applicant_name']; ?></b> aged about <b style="text-decoration: underline;"><?php echo $character_certificate_data['applicant_age']; ?></b> years, Son / Daughter of <b style="text-decoration: underline;"><?php echo $character_certificate_data['father_name']; ?></b> and <b style="text-decoration: underline;"><?php echo $character_certificate_data['mother_name']; ?></b> Resident of <b style="text-decoration: underline;"><?php echo $character_certificate_data['com_addr_house_no'] . ',' . $character_certificate_data['com_addr_house_name'] . ',' . $character_certificate_data['com_addr_street'] . ',' . $character_certificate_data['com_addr_village_dmc_ward'] . ',' . $character_certificate_data['com_addr_city'] . ',' . $character_certificate_data['com_pincode']; ?></b> District <?php echo $taluka_name; ?> it is revealedthat as on today nothing adverse is registered against him / her 
</div>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 8px;margin-top: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;The said certificate is required for <b style="text-decoration: underline;"><?php echo $character_certificate_data['purpose']; ?></b> Purpose.</div>
<?php
$sign_data['extra_style'] = 'margin-left: 50px;';
$sign_data['district'] = $character_certificate_data['district'];
$sign_data['mam_image'] = $mam_image;
$sign_data['mam_name'] = $mam_name;
$sign_data['mtype'] = $mtype;
$sign_data['mam_district'] = (isset($mam_image_array[$character_certificate_data['district']]) ? $mam_image_array[$character_certificate_data['district']]['district'] : '');
$this->load->view('certificate/sign', $sign_data);
$this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype));
?>