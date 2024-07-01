<?php
$barcode_number = generate_barcode_number(VALUE_TWELVE, $rti_data['rti_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$rti_data['district']]) ? $taluka_array[$rti_data['district']] : '';

$header_array = array();
$header_array['title'] = 'Certificate';
$header_array['department_name'] = 'Office of the Mamlatdar';
$header_array['district'] = $taluka_name;
$mtype = isset($mtype) ? $mtype : VALUE_TWO;
$header_array['mtype'] = $mtype;
//Ex.  A4, Legal
$header_array['page_size'] = 'A4';
$this->load->view('certificate/header', $header_array);

$mam_image_array = $this->config->item('mam_image_array');
$mam_image = isset($mam_image_array[$rti_data['district']]) ? $mam_image_array[$rti_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$rti_data['district']]) ? $mam_image_array[$rti_data['district']]['short_text'] : '';

$relation_deceased_person_array = $this->config->item('relation_deceased_person_array');
$member_remarks_array = $this->config->item('alive_death_status_array');

$pre_city_text = $rti_data['pre_city'];
$daman_villages_array = $this->config->item('daman_villages_array');
$diu_villages_array = $this->config->item('diu_villages_array');
$dnh_villages_array = $this->config->item('dnh_villages_array');
$village_array = $rti_data['district'] == TALUKA_DAMAN ? $daman_villages_array : ($rti_data['district'] == TALUKA_DIU ? $diu_villages_array : ($rti_data['district'] == TALUKA_DNH ? $dnh_villages_array : array()));
$village_name = isset($village_array[$village_name]) ? $village_array[$village_name] : '';
$pre_village_text = isset($rti_data['pre_village']) ? $rti_data['pre_village'] : '';
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
    /*    table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }*/

    /*    td, th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }*/
</style>
<?php $this->load->view('certificate/contact_details', array('district' => $rti_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $rti_data['application_number']; ?>
    <div class="m-t-read" style="text-align: right;">Dated : <?php echo $rti_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($rti_data['status_datetime']) : ''; ?></div>
</div>
<hr>
<div class="f-s-14px">READ :</div>
<table class="f-s-14px read">
    <tr>
        <td>(1). Application dated <?php echo $rti_data['submitted_datetime'] != '0000-00-00' ? convert_to_new_date_format($rti_data['submitted_datetime']) : ''; ?>, received from <?php echo $rti_data['applicant_name']; ?></td>
    </tr>
    <tr>
        <td>&emsp;&emsp;&emsp;<?php echo $rti_data['pre_house_no'] . ',&nbsp;' . $rti_data['pre_house_name'] . ',&nbsp;' . $rti_data['pre_street'] . ',&nbsp;' . $pre_village_text . ',&nbsp;' . $pre_city_text; ?></td>
    </tr>
    <tr>
        <td>(2). Affidavit Dated <?php echo $rti_data['submitted_datetime'] != '0000-00-00' ? convert_to_new_date_format($rti_data['submitted_datetime']) : ''; ?><!-- , received from <?php //echo $rti_data['applicant_name'];          ?> --></td>
    </tr>
    <!-- <tr>
        <td>&emsp;&emsp;&emsp;<?php //echo $rti_data['pre_house_no'] . ',&nbsp;' . $rti_data['pre_house_name'] . ',&nbsp;' . $rti_data['pre_street'] . ',&nbsp;' . $pre_village_text . ',&nbsp;' . $pre_city_text;          ?></td>
    </tr> -->
    <tr>
        <td>(3). Enquiry Report No. <?php echo $rti_data['application_number']; ?>, received from Talathi </td>
    </tr>
    <tr>
        <td>&emsp;&emsp;&emsp;<?php echo $header_array['district']; ?> Saza</td>
    </tr>
</table>
<br/>
<div style="font-size: 25px; text-align: center; margin-top: 5px;font-weight: bold;"><u>Certificate</u></div>
<br/>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 5px;word-spacing: 8px;margin-top: 0px; line-height: 20px;
     text-align: justify; text-justify: inter-word;">
    &nbsp;&nbsp;&nbsp;&nbsp;This is to certify that an enquiry was carried out and it is revealed that the<br> 
    following are family members of <b>Late. <span style="border-bottom: 1px solid black;"><?php echo $rti_data['death_person_name']; ?></span></b> 
    resident of <b><?php echo $rti_data['pre_house_no'] . ',&nbsp;' . $rti_data['pre_house_name'] . ',&nbsp;' . $rti_data['pre_street'] . ',&nbsp;' . $pre_village_text . ',&nbsp;' . $pre_city_text; ?></b> 
    District <?php echo $taluka_name; ?> </div>
<!--<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 10px;word-spacing: 8px;margin-top: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;This Certificate is issued on the request of the applicant.</div>-->

<div  class="f-s-14px" style="margin-left: 50px; margin-bottom: 5px;word-spacing: 8px;margin-top: 3px; line-height: 15px;
      text-align: justify; text-justify: inter-word;">
    <div class="table-responsive">
        <table class="table table-bordered table-padding" style="width: 100%;border-collapse: collapse;">
            <thead>
                <tr style="border: 1px solid black;">
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;border: 1px solid black;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;border: 1px solid black;"> Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;border: 1px solid black;">Age</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 50px;border: 1px solid black;">Relation With Late <?php echo $rti_data['death_person_name']; ?></td>
                </tr>
            </thead>
            <?php
            $efm_cnt = VALUE_ONE;
            $temp_member_details = json_decode($rti_data['legal_heirs_details'], true);
            foreach ($temp_member_details as $md) {
                $temp_marital_status = isset($md['member_marital_status']) ? $md['member_marital_status'] : VALUE_ZERO;
                $temp_relation = isset($md['member_relation']) ? $md['member_relation'] : VALUE_ZERO;
                $temp_remarks = isset($md['member_remarks']) ? $md['member_remarks'] : VALUE_ZERO;
                ?>
                <tr style="border: 1px solid black;">
                    <td class="t-a-c" style="border: 1px solid black;"><?php echo $efm_cnt; ?></td>
                    <td class="t-a-c" style="border: 1px solid black;"><?php echo isset($md['member_name']) ? $md['member_name'] : ''; ?></td>
                    <td class="t-a-c" style="border: 1px solid black;"><?php echo isset($md['member_age']) ? $md['member_age'] : '-'; ?></td>
                    <td class="t-a-c" style="border: 1px solid black;"><?php echo isset($relation_deceased_person_array[$temp_relation]) ? $relation_deceased_person_array[$temp_relation] : '-'; ?></td>
                </tr>
                <?php
                $efm_cnt++;
            }
            ?>
        </table>
    </div>
</div>
<?php if ($efm_cnt > 8) { ?>
    <div style="margin-left: 530px;margin-top: 350px;color: red;"><b>Page {PAGENO} of {nbpg}</b></div>
    <p style="page-break-after: always;">&nbsp;</p>
<?php } ?>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 0px;word-spacing: 8px;margin-top: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;This Certificate is issued at the request of the applicant, which is to be produced</div>
<div class="f-s-14px" style="margin-left: 20px; margin-bottom: 0px;word-spacing: 8px;margin-top: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;before the competent authority in the Govt, Semi Govt, Banks, etc.</div>

<table style="margin-top: 20px;">
    <tr>
        <td style="width: 30%;">
            <img src="<?php echo HEIRSHIP_CERTIFICATE_DOC_PATH; ?><?php echo $rti_data['applicant_photo_doc']; ?>" height="150px" width="150px">
        </td>
        <td class="f-s-14px" style="vertical-align: bottom; text-align: center; width: 72%; font-weight: bold; padding-right: 0px;">
            <?php if ($mam_image != '' && $mtype == VALUE_TWO) { ?>
                <img src="<?php echo $mam_image; ?>" style="width: 480px;" /><br>
                <?php
            }
            echo (isset($mam_image_array[$rti_data['district']]) ? $mam_image_array[$rti_data['district']]['mamlatdar_name'] : '') . '<br>';
            echo '<span class="f-aum">मामलतदार</span> / Mamlatdar<br>';
            echo '<span class="f-aum">कार्यकारी मजिस्ट्रेट</span> / Executive Magistrate<br>';
            echo (isset($mam_image_array[$rti_data['district']]) ? $mam_image_array[$rti_data['district']]['district'] : '') . '<br>';
            ?>
        </td>
    </tr> 
    <tr>
        <td style="width: 30%;">
            To,<br>
            <?php
            $ldc_applicant_name = trim($rti_data['ldc_applicant_name']);
            if ($rti_data['aci_to_ldc'] != VALUE_ZERO && $ldc_applicant_name != '' &&
                    trim($rti_data['applicant_name']) != $ldc_applicant_name) {
                $app_name = $rti_data['ldc_applicant_name'];
            } else {
                $app_name = $rti_data['applicant_name'];
            }
            echo trim($app_name);
            ?><br>
            <?php echo $rti_data['pre_house_no'] . ',&nbsp;' . $rti_data['pre_house_name'] . ',&nbsp;' . $rti_data['pre_street'] . ',&nbsp;' . $pre_village_text . ',&nbsp;<br>' . $pre_city_text; ?>
        </td>
    </tr>
</table>
<?php if ($efm_cnt > 8) { ?>
    <table style="margin-top: 600px;margin-left: 530px;">
        <tr>
            <td>
                <span style="color: red;"><b>Page {PAGENO} of {nbpg}</b></span>
            </td>
        </tr>
    </table>
<?php } ?>
<?php $this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype)); ?>