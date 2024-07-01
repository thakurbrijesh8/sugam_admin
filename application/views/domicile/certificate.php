<?php
$barcode_number = generate_barcode_number(VALUE_ONE, $domicile_data['domicile_certificate_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$domicile_data['district']]) ? $taluka_array[$domicile_data['district']] : '';

$sign_data = array();
$sign_data['status_datetime'] = $domicile_data['status_datetime'] != '0000-00-00 00:00:00' ? $domicile_data['status_datetime'] : '';

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

$damanCityArray = $this->config->item('daman_city_array');
$mam_image_array = $this->config->item('mam_image_array');
$mam_image = isset($mam_image_array[$domicile_data['district']]) ? $mam_image_array[$domicile_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$domicile_data['district']]) ? $mam_image_array[$domicile_data['district']]['short_text'] : '';
$mam_name = isset($mam_image_array[$domicile_data['district']]) ? $mam_image_array[$domicile_data['district']]['mamlatdar_name'] : '';
$father_data = $domicile_data['father_details'] ? json_decode($domicile_data['father_details'], true) : array();
$mother_data = $domicile_data['mother_details'] ? json_decode($domicile_data['mother_details'], true) : array();
$spouse_data = $domicile_data['spouse_details'] ? json_decode($domicile_data['spouse_details'], true) : array();
?>
<style type="text/css">
    .f-s-14px{
        font-size: 14px;
    }
    .read{
        margin-left: 50px;
        margin-bottom: 5px;
        word-spacing: 2px;
    }
    .m-t-read{
        margin-top: -18px;
    }
    .f-aum{
        font-family: arial_unicode_ms;
    }
    .f-w-b{
        font-weight: bold;
    }
    .b-b-1px{
        border-bottom: 1px solid;
    }
</style>
<?php $this->load->view('certificate/contact_details', array('district' => $domicile_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $domicile_data['application_number']; ?> 
    <?php if ($mtype == VALUE_TWO) { ?>
        <div class="m-t-read" style="text-align: right;">Dated : <?php echo $domicile_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($domicile_data['status_datetime']) : ''; ?></div>
    <?php } else { ?>
        <div class="m-t-read" style="text-align: right; margin-right: 138px;">Dated : </div>
    <?php } ?>
</div>
<hr>
<div class="f-s-14px">READ :</div>
<table class="f-s-14px read">
    <tr>
        <td>1. Name of Applicant</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b" style="text-transform: capitalize;">
            <?php
            echo ldc_app_details($domicile_data, 'name_of_applicant', 'ldc_applicant_name');
            ?>
        </td>
    </tr>
    <tr>
        <td>2. Application Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b"><?php echo $domicile_data['submitted_datetime'] != '0000-00-00' ? convert_to_new_date_format($domicile_data['submitted_datetime']) : ''; ?></td>
    </tr>
    <tr>
        <td>3. Affidavit Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b"><?php echo $domicile_data['submitted_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($domicile_data['submitted_datetime']) : ''; ?></td>
    </tr>
    <tr>
        <td>4. Statement of Applicant and Panchas Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b"><?php echo $domicile_data['appointment_date'] != '0000-00-00' ? convert_to_new_date_format($domicile_data['appointment_date']) : ''; ?></td>
    </tr>
    <tr>
        <td>5. Report of the Talathi Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b">
            <?php
            if ($domicile_data['aci_rec'] == VALUE_TWO && $domicile_data['talathi_to_reverify_datetime'] != '0000-00-00 00:00:00') {
                echo convert_to_new_date_format($domicile_data['talathi_to_reverify_datetime']);
            } else {
                echo $domicile_data['talathi_to_aci_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($domicile_data['talathi_to_aci_datetime']) : '';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>6. Report of the C.I. Dated</td>
        <td>&nbsp;:&nbsp;</td>
        <td class="f-w-b">
            <?php
            if ($domicile_data['aci_rec'] == VALUE_ONE) {
                echo $domicile_data['aci_to_ldc_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($domicile_data['aci_to_ldc_datetime']) : '';
            }
            if ($domicile_data['aci_rec'] == VALUE_TWO) {
                echo $domicile_data['aci_to_mamlatdar_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($domicile_data['aci_to_mamlatdar_datetime']) : '';
            }
            ?>
        </td>
    </tr>
</table>
<br/>
<div style="font-size: 30px; text-align: center; margin-top: 10px;font-weight: bold;"><u>Domicile Certificate</u></div>
<br/>
<?php
$commu_address = $domicile_data['ldc_commu_address'] != '' ? $domicile_data['ldc_commu_address'] :
        (($domicile_data['com_addr_house_no'] != '' ? ($domicile_data['com_addr_house_no'] . ', ') : '')
        . ($domicile_data['com_addr_house_name'] != '' ? ($domicile_data['com_addr_house_name'] . ', ') : '')
        . ($domicile_data['com_addr_street'] != '' ? ($domicile_data['com_addr_street'] . ', ') : '')
        . ($domicile_data['com_addr_village_dmc_ward'] != '' ? ($domicile_data['com_addr_village_dmc_ward'] . ', ') : '')
        . ($domicile_data['com_addr_city'] != '' ? ($domicile_data['com_addr_city']) : ''));
?>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 8px;margin-top: 20px; line-height: 25px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <span class="b-b-1px f-w-b" style="text-transform: capitalize;">
        <?php
        $constitution_artical = intval($domicile_data['constitution_artical']);
        if ($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE) {
            echo ldc_app_details($domicile_data, 'minor_child_name', 'ldc_minor_child_name');
        } else {
            echo ldc_app_details($domicile_data, 'name_of_applicant', 'ldc_applicant_name');
        }
        ?></span>, Son / Daughter / wife of <span class="b-b-1px f-w-b" style="text-transform: capitalize;">
        <?php
        $domicile_data['ldc_fname'] = ($father_data['father_name'] == '' ? $spouse_data['spouse_name'] : $father_data['father_name']);
        echo ldc_app_details($domicile_data, 'ldc_fname', 'ldc_father_name');
        ?></span>, resident of <span class="b-b-1px f-w-b" style="text-transform: capitalize;"><?php echo $commu_address; ?></span>
    District <?php echo $taluka_name; ?> is a domicile of U.T. of Dadra & Nagar Haveli and Daman & Diu.
</div>
<?php
$sign_data['extra_style'] = 'margin-left: 50px;';
if ($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE) {
    $sign_data['applicant_photo_doc_path'] = DOMICILE_CERTIFICATE_DOC_PATH . $domicile_data['minor_child_photo'];
} else {
    $sign_data['applicant_photo_doc_path'] = DOMICILE_CERTIFICATE_DOC_PATH . $domicile_data['applicant_photo'];
}
$sign_data['district'] = $domicile_data['district'];
$sign_data['mam_image'] = $mam_image;
$sign_data['mam_name'] = $mam_name;
$sign_data['mtype'] = $mtype;
$sign_data['mam_district'] = (isset($mam_image_array[$domicile_data['district']]) ? $mam_image_array[$domicile_data['district']]['district'] : '');
$this->load->view('certificate/sign', $sign_data);
$this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype));
?>