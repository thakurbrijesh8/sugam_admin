<?php
$barcode_number = generate_barcode_number(VALUE_FIVE, $obc_certificate_data['obc_certificate_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$obc_certificate_data['district']]) ? $taluka_array[$obc_certificate_data['district']] : '';

$header_array = array();
$header_array['title'] = 'Certificate';
$header_array['department_name'] = 'Office of the Mamlatdar';
$header_array['district'] = $taluka_name;
$mtype = isset($mtype) ? $mtype : VALUE_TWO;
$header_array['mtype'] = $mtype;
//Ex.  A4, Legal
$header_array['page_size'] = 'Legal';
$this->load->view('certificate/header', $header_array);

$mam_image_array = $this->config->item('mam_image_array');
$mam_image = isset($mam_image_array[$obc_certificate_data['district']]) ? $mam_image_array[$obc_certificate_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$obc_certificate_data['district']]) ? $mam_image_array[$obc_certificate_data['district']]['short_text'] : '';
$mam_name = isset($mam_image_array[$obc_certificate_data['district']]) ? $mam_image_array[$obc_certificate_data['district']]['mamlatdar_name'] : '';

$comma_income = indian_comma_income($obc_certificate_data['income_by_talathi']);
$applicant_obccaste_array = $this->config->item('applicant_obc_caste_array');
$applicant_obccaste_arrayOne = $this->config->item('applicant_obc_caste_arrayOne');
$applicant_obccaste_arrayTwo = $this->config->item('applicant_obc_caste_arrayTwo');
$applicant_obccaste_arrayThree = $this->config->item('applicant_obc_caste_arrayThree');
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
<div class="f-s-14px">READ :</div>
<table class="f-s-14px read">

    <tr>
        <td>1. Application dated <?php echo $obc_certificate_data['submitted_datetime'] != '0000-00-00' ? convert_to_new_date_format($obc_certificate_data['submitted_datetime']) : ''; ?>,  by Shri. <b><?php echo $obc_certificate_data['father_name']; ?></b> R/o H.No. <b><?php echo $obc_certificate_data['com_addr_house_no']; ?> , <b><?php echo $obc_certificate_data['com_addr_street']; ?>, <?php echo $obc_certificate_data['com_addr_village_dmc_ward']; ?>, </b> Diu. </td>

    </tr>
    <tr>
        <td>2. Report from the Talathi, Diu under No. Talathi/DMC/2020-21/ Dated:- ------</td>

    </tr>
    <tr>
        <td>3. Certificate No. TP/JSK/Reg No. ------- Dated: ------- issued by The Taluka Development Office, Taluka Panchayat, Kodinar. </td>

    </tr>
    <tr>
        <td>4. This office Letter No. MAM/GEN/2020-21/1970 Dated :- -------- to The Taluka Devlopment Officer, Talka Panchayat. Kodinar. </td>
    </tr>
</tr>
<tr>
    <td>5. Letter No. T.P./Jan Seva/ Certificate-Verification/1747/2020, Dated:08/10/2020 issued by The Taluka Development Office, Taluka Panchayat, Kodinar. </td>

</tr>
</table>
<br/>

<div style="font-size: 23px; text-align: center; margin-top: 2px;font-weight: bold;"><u> CERTIFICATE FOR OTHER BACKWARD CLASS</u></div>


<!-- <div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 6px;margin-top: 20px; line-height: 25px;
     text-align: justify; text-justify: inter-word;"> -->


<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 2px;word-spacing: 5px;margin-top: 10px; line-height: 20px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;A.  This is to certify that Shri/Smt./Kum. <!-- <b> <?php echo $obc_certificate_data['applicant_name']; ?>,</b>  -->
    <span class="b-b-1px f-w-b"> <?php
        $ldc_applicant_name = trim($obc_certificate_data['ldc_applicant_name']);
        if ($obc_certificate_data['aci_to_ldc'] != VALUE_ZERO && $ldc_applicant_name != '' &&
                trim($obc_certificate_data['applicant_name']) != $ldc_applicant_name) {
            $app_name = $obc_certificate_data['ldc_applicant_name'];
        } else {
            $app_name = $obc_certificate_data['applicant_name'];
        }
        echo trim($app_name);
        ?>, </span> 
    Son/Daughter of <b><?php echo $obc_certificate_data['father_name']; ?></b>,resident of Diu District of the  Union Territory of Dadra & Nagar Haveli and Daman & Diu, belongs to the "<b><?php echo $applicant_obccaste_array[$obc_certificate_data ['obccaste']]; ?></b>" community, which is recognized as a Backward Class Under:</div>


<!--  <div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 8px;margin-top: 20px; line-height: 25px;
  text-align: justify; text-justify: inter-word;">&nbsp;&nbsp;&nbsp;&nbsp;The Certificate is issued on the request of the applicant.</div> -->


<div class="f-s-14px" style="margin-left: 20px; margin-right: 20px; margin-bottom: 5px;word-spacing: 5px;margin-top: 15px; line-height: 20px;
     text-align: justify; text-justify: inter-word;">
     <?php
     $obccastetext = $applicant_obccaste_arrayOne[$obc_certificate_data['obccaste']];
     if (in_array($obccastetext, $applicant_obccaste_arrayOne)) {
         ?>
        <b style="font-family: arial_unicode_ms;"> &#10003;</b>
    <?php }
    ?>
    I. Resolution No. 12011/9/94-BCC dated 19th October, 1994 published in the Gazette of India Extraordinary Part – I, Section – 41 No. 163 dated 20th October, 1994
</div>


<div class="f-s-14px" style="margin-left: 20px; margin-right: 20px;margin-bottom: 5px;word-spacing: 5px;margin-top: 5px; line-height: 20px;
     text-align: justify; text-justify: inter-word;">

    <?php
    $obccastetext = $applicant_obccaste_arrayTwo[$obc_certificate_data['obccaste']];
    if (in_array($obccastetext, $applicant_obccaste_arrayTwo)) {
        ?>
        <b style="font-family: arial_unicode_ms;"> &#10003;</b>
    <?php }
    ?>


    II. Resolution No. 12011/14/2004-BCC dated 12th March, 2007 published in the Gazette of India Extraordinary Part – I, Section – 1 No. 67 dated 12th March 2007 </div>

<div class="f-s-14px" style="margin-left: 20px; margin-right: 20px; margin-bottom: 5px;word-spacing: 5px;margin-top: 5px; line-height: 20px;
     text-align: justify; text-justify: inter-word;">
     <?php
     $obccastetext = $applicant_obccaste_arrayThree[$obc_certificate_data['obccaste']];
     if (in_array($obccastetext, $applicant_obccaste_arrayThree)) {
         ?>
        <b style="font-family: arial_unicode_ms;"> &#10003;</b>
    <?php }
    ?>
    III. Resolution No. 12015/2/2007-BCC dated 18th August, 2010 published in the Gazette of India Extraordinary Part – I, Section – 1, No. 232 dated 18th August, 2010.</div>


<div class="f-s-14px" style="margin-left: 20px; margin-right: 20px; margin-bottom: 3px;word-spacing: 5px;margin-top: 5px; line-height: 25px;
     text-align: justify; text-justify: inter-word;">&nbsp;&nbsp; <b>(   <b style="font-family: arial_unicode_ms;"> &#10003;</b> The one applicable and strike out the Inapplicable ones ) </b></div>

<!--      <div class="f-s-14px" style="margin-left: 20px; margin-right: 20px; margin-bottom: 5px;word-spacing: 6px;margin-top: 10px; line-height: 20px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;2.  Shri/Smt./Kum. <b> <?php echo $obc_certificate_data['applicant_name']; ?></b> 
    and/or/his/her family ordinarily reside(s) in Village  <b><?php echo $obc_certificate_data['com_addr_house_no']; ?>, <?php echo $obc_certificate_data['com_addr_house_name']; ?>, <?php echo $obc_certificate_data['com_addr_street']; ?>, <?php echo $obc_certificate_data['com_addr_village_dmc_ward']; ?>, <?php echo $obc_certificate_data['com_addr_city']; ?></b>
    of Daman. District of the Union Territory of Dadra & Nagar Haveli and Daman & Diu.</div> -->


<div class="f-s-14px" style="margin-left: 20px; margin-right: 20px; margin-bottom: 5px;word-spacing: 5px;margin-top: 10px; line-height: 20px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;B. This certificate is issued on the basis of the Other Backward Classed Certificate issued to Shri./Smt./Kum. <b><?php echo $obc_certificate_data['father_name']; ?> </b>, father of Shri./Kum.  
    <span class="b-b-1px f-w-b"> <?php
        $ldc_applicant_name = trim($obc_certificate_data['ldc_applicant_name']);
        if ($obc_certificate_data['aci_to_ldc'] != VALUE_ZERO && $ldc_applicant_name != '' &&
                trim($obc_certificate_data['applicant_name']) != $ldc_applicant_name) {
            $app_name = $obc_certificate_data['ldc_applicant_name'];
        } else {
            $app_name = $obc_certificate_data['applicant_name'];
        }
        echo trim($app_name);
        ?>, </span>  in District/Division Gire-Somnath of the State Gujarat who belons to the  <b><?php echo $applicant_obccaste_array[$obc_certificate_data ['obccaste']]; ?></b>" Caste which is recognized as a Backward Class in the State Gujarat issued by The Taluka Development Office, Taluka Panchayat, Kodinar. vide their No. TP/JSK/Reg No. 7411/2016, Dated: 16/05/2016.</div>

<div class="f-s-14px" style="margin-left: 20px; margin-right: 20px; margin-bottom: 5px;word-spacing: 5px;margin-top: 10px; line-height: 20px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;C. Shri/Smt.  <span class="b-b-1px f-w-b"> <?php
        $ldc_applicant_name = trim($obc_certificate_data['ldc_applicant_name']);
        if ($obc_certificate_data['aci_to_ldc'] != VALUE_ZERO && $ldc_applicant_name != '' &&
                trim($obc_certificate_data['applicant_name']) != $ldc_applicant_name) {
            $app_name = $obc_certificate_data['ldc_applicant_name'];
        } else {
            $app_name = $obc_certificate_data['applicant_name'];
        }
        echo trim($app_name);
        ?>, </span>  and his/her family ordinarily reside(s) in Diu District of the Union Territory Daman & Diu.</div>

<div class="f-s-14px" style="margin-left: 20px; margin-right: 20px; margin-bottom: 5px;word-spacing: 5px;margin-top: 10px; line-height: 20px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;D. This is also certify that he/she does not not belong to the person / Sections (creamy Layer) mentioned in column 3 of the schedule to the Govt. of India, Department of Personnel & Training O.M. No. 36012/22/93-Estt. dated 08/.09.1993.</div>
<?php
$sign_data['extra_style'] = 'margin-left: 20px;';
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
<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 5px;margin-top: 10px; line-height: 15px;
     text-align: justify; text-justify: inter-word;">
    Note :- The term “Ordinarily” used here will have the same meaning as in Section 20 of the Representation of the People Act, 1950.</div>

<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 5px;margin-top: 15px; line-height: 15px;
     text-align: justify; text-justify: inter-word;">
    <b>To,</b>
    <b><?php echo $obc_certificate_data['applicant_name']; ?>,</b>
    <b>R/O - <?php echo $obc_certificate_data['com_addr_house_no']; ?>, <?php echo $obc_certificate_data['com_addr_house_name']; ?>, <?php echo $obc_certificate_data['com_addr_street']; ?> <?php echo $obc_certificate_data['commu_add_state_text']; ?> 
        <?php echo $obc_certificate_data['commu_add_state_name']; ?> <?php echo $obc_certificate_data['commu_add_district_name']; ?> <?php echo $obc_certificate_data['commu_add_village_name']; ?> 
</div>
<?php $this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype)); ?>

<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $com_addr_house_no . '&nbsp;' . $com_addr_house_name . '&nbsp;' . $com_addr_street . '&nbsp;' . $com_addr_city . '&nbsp;' . $commu_add_state_name . '&nbsp;,&nbsp;' . $commu_add_district_name . '&nbsp;,&nbsp;' . $commu_add_village_name; ?></span>, of Daman District.