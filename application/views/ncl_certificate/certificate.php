<?php
$barcode_number = generate_barcode_number(VALUE_SIX, $ncl_certificate_data['ncl_certificate_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$ncl_certificate_data['district']]) ? $taluka_array[$ncl_certificate_data['district']] : '';

$sign_data = array();
$sign_data['status_datetime'] = $ncl_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? $ncl_certificate_data['status_datetime'] : '';

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
$mam_image = isset($mam_image_array[$ncl_certificate_data['district']]) ? $mam_image_array[$ncl_certificate_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$ncl_certificate_data['district']]) ? $mam_image_array[$ncl_certificate_data['district']]['short_text'] : '';
$mam_name = isset($mam_image_array[$ncl_certificate_data['district']]) ? $mam_image_array[$ncl_certificate_data['district']]['mamlatdar_name'] : '';

$applicant_obccaste_array = $this->config->item('applicant_obc_caste_array');

$t_certi_type = $ncl_certificate_data['cert_type_reverify'] != VALUE_ZERO ? $ncl_certificate_data['cert_type_reverify'] : $ncl_certificate_data['cert_type'];
?>
<style type="text/css">
    .f-s-14px{
        font-size: 14px;
    }
    .read{
        margin-left: 50px;
        margin-bottom: 5px;
        word-spacing: 5px;
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
<?php $this->load->view('certificate/contact_details', array('district' => $ncl_certificate_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $ncl_certificate_data['application_number']; ?>
    <div class="m-t-read" style="text-align: right;">Dated : <?php echo $ncl_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($ncl_certificate_data['status_datetime']) : ''; ?></div>
</div>
<hr>
<div class="f-s-14px">READ :</div>
<table class="f-s-14px read">
    <tr>
        <td>1. O.B.C. Certificate No. <b> <?php echo $ncl_certificate_data['obc_certificate_no']; ?> </b></td>
    </tr>
    <tr>
        <td> &nbsp; dated <b><?php echo $ncl_certificate_data['obc_certificate_date'] != '0000-00-00' ? convert_to_new_date_format($ncl_certificate_data['obc_certificate_date']) : ''; ?></b>, issued by this office.</td>
    </tr>
    <tr>
        <td>2. Income  Certificate No <b> <?php echo $ncl_certificate_data['income_certificate_no']; ?> </td>
    </tr>
    <tr>
        <td> &nbsp; dated <b><?php echo $ncl_certificate_data['income_certificate_date'] != '0000-00-00' ? convert_to_new_date_format($ncl_certificate_data['income_certificate_date']) : ''; ?></b>.</td>
    </tr>
    <tr>
        <td>3. Report of the Talathi dated : <b> 
                <?php
                if ($ncl_certificate_data['aci_rec'] == VALUE_TWO && $ncl_certificate_data['talathi_to_reverify_datetime'] != '0000-00-00 00:00:00') {
                    echo convert_to_new_date_format($ncl_certificate_data['talathi_to_reverify_datetime']);
                } else {
                    echo $ncl_certificate_data['talathi_to_aci_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($ncl_certificate_data['talathi_to_aci_datetime']) : '';
                }
                ?></b>
        </td>
    </tr>
    <tr>
        <td>4. Report of  the Circle Inspector dated : <b> 
                <?php
                if ($ncl_certificate_data['aci_rec'] == VALUE_ONE) {
                    echo $ncl_certificate_data['aci_to_ldc_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($ncl_certificate_data['aci_to_ldc_datetime']) : '';
                }
                if ($ncl_certificate_data['aci_rec'] == VALUE_TWO) {
                    echo $ncl_certificate_data['aci_to_mamlatdar_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($ncl_certificate_data['aci_to_mamlatdar_datetime']) : '';
                }
                ?></b>
        </td>
    </tr>
</table>
<br/>
<?php
$commu_address = $ncl_certificate_data['ldc_commu_address'] != '' ? $ncl_certificate_data['ldc_commu_address'] :
        (($ncl_certificate_data['com_addr_house_no'] != '' ? ($ncl_certificate_data['com_addr_house_no'] . ', ') : '')
        . ($ncl_certificate_data['com_addr_house_name'] != '' ? ($ncl_certificate_data['com_addr_house_name'] . ', ') : '')
        . ($ncl_certificate_data['com_addr_street'] != '' ? ($ncl_certificate_data['com_addr_street'] . ', ') : '')
        . ($ncl_certificate_data['com_addr_village_dmc_ward'] != '' ? ($ncl_certificate_data['com_addr_village_dmc_ward'] . ', ') : '')
        . ($ncl_certificate_data['com_addr_city'] != '' ? ($ncl_certificate_data['com_addr_city']) : ''));

$ldc_f_name = ldc_app_details($ncl_certificate_data, 'father_name', 'ldc_father_name');

$ncl_certificate_data['t_ldv_vt'] = $ncl_certificate_data['com_addr_village_dmc_ward'] . ', ' . $ncl_certificate_data['com_addr_city'];
$ldv_vt = ldc_app_details($ncl_certificate_data, 't_ldv_vt', 'ldc_vt_name');
?>
<div style="font-size: 23px; text-align: center; margin-top: 10px;font-weight: bold;"><u> CERTIFICATE </u></div>
<div style="font-size: 23px; text-align: center; margin-top: 10px;font-weight: bold;"><u> <?php echo $t_certi_type == VALUE_TWO ? '' : 'Non'; ?> Creamy Layer Status</u></div>
<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 6px;margin-top: 20px; line-height: 25px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <b style="text-decoration: underline;">
        <span class="b-b-1px f-w-b" style="text-transform: capitalize;"><?php
            if ($ncl_certificate_data['constitution_artical'] == VALUE_ONE) {
                echo ldc_app_details($ncl_certificate_data, 'applicant_name', 'ldc_applicant_name');
            } else {
                echo ldc_app_details($ncl_certificate_data, 'minor_child_name', 'ldc_minor_child_name');
            }
            ?></span></b>,
    Son / Daughter of <b style="text-decoration: underline; text-transform: capitalize;"><?php echo $ldc_f_name; ?></b>
    of Village/Town  <b style="text-decoration: underline;  text-transform: capitalize;"><?php echo $ldv_vt; ?></b>, 
    District <?php echo $taluka_name; ?> in the Union Territory of Dadra & Nagar Haveli and Daman & Diu belongs to <b style="text-decoration: underline;"><?php echo $applicant_obccaste_array[$ncl_certificate_data ['obccaste']]; ?></b> Community which is recognized as Backward class.</div>
<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 6px;margin-top: 20px; line-height: 25px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;This is also to certify that he/She does not belong to the person / sections (<?php echo $t_certi_type == VALUE_TWO ? 'Non ' : ''; ?>Creamy Layer) mentioned in the column 3 of the schedule to the Government of India, Department of personnel and training
    <?php
    if ($ncl_certificate_data['obccaste'] == VALUE_THIRTYFIVE || $ncl_certificate_data['obccaste'] == VALUE_THIRTYSIX ||
            $ncl_certificate_data['obccaste'] == VALUE_FIFTYFOUR) {
        echo 'O.M. No. AS/SW/519(2)/02-03/260 dated:-31/01/2003.';
    } else {
        echo 'O.M. No. DC/10/201/92/2490 dated:- 27/01/1994.';
    }
    ?>
</div>
<?php
$sign_data['extra_style'] = 'margin-left: 30px;';
$sign_data['is_em'] = true;
$sign_data['applicant_photo_doc_path'] = NCL_CERTIFICATE_DOC_PATH . $ncl_certificate_data['applicant_photo_doc'];
$sign_data['district'] = $ncl_certificate_data['district'];
$sign_data['mam_image'] = $mam_image;
$sign_data['mam_name'] = $mam_name;
$sign_data['mtype'] = $mtype;
$sign_data['mam_district'] = (isset($mam_image_array[$ncl_certificate_data['district']]) ? $mam_image_array[$ncl_certificate_data['district']]['district'] : '');
$this->load->view('certificate/sign', $sign_data);
?>
<div class="f-s-14px" style="margin-left: 30px; margin-right: 30px; margin-bottom: 10px;word-spacing: 2px;margin-top: 20px; line-height: 25px;
     text-align: justify; text-justify: inter-word;">
    <b>To,</b><br/> 
    <b style="text-transform: capitalize;"><?php echo ldc_app_details($ncl_certificate_data, 'applicant_name', 'ldc_applicant_name'); ?></b>,<br/> 
    <b>R/O - <span style="text-transform: capitalize;"><?php echo $commu_address; ?>,</span>
        District <?php echo $taluka_name; ?></b>.
</div>
<?php $this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype)); ?>