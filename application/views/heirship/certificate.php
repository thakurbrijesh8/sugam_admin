<?php
$barcode_number = generate_barcode_number(VALUE_THREE, $heirship_data['heirship_id']);

$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$heirship_data['district']]) ? $taluka_array[$heirship_data['district']] : '';

$sign_data = array();
$sign_data['status_datetime'] = $heirship_data['status_datetime'] != '0000-00-00 00:00:00' ? $heirship_data['status_datetime'] : '';

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
$mam_image = isset($mam_image_array[$heirship_data['district']]) ? $mam_image_array[$heirship_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$heirship_data['district']]) ? $mam_image_array[$heirship_data['district']]['short_text'] : '';
$mam_name = isset($mam_image_array[$heirship_data['district']]) ? $mam_image_array[$heirship_data['district']]['mamlatdar_name'] : '';

$relation_deceased_person_array = $this->config->item('relation_deceased_person_array');
$member_remarks_array = $this->config->item('alive_death_status_array');

$pre_city_text = $heirship_data['pre_city'];
$daman_villages_array = $this->config->item('daman_villages_array');
$diu_villages_array = $this->config->item('diu_villages_array');
$dnh_villages_array = $this->config->item('dnh_villages_array');
$village_array = $heirship_data['district'] == TALUKA_DAMAN ? $daman_villages_array : ($heirship_data['district'] == TALUKA_DIU ? $diu_villages_array : ($heirship_data['district'] == TALUKA_DNH ? $dnh_villages_array : array()));
$village_name = isset($village_array[$village_name]) ? $village_array[$village_name] : '';
$pre_village_text = isset($heirship_data['pre_village']) ? $heirship_data['pre_village'] : '';
?>
<style type="text/css">
    .f-s-14px{
        font-size: 14px;
    }
    .read{
        margin-left: 50px;
        margin-bottom: 5px;
        word-spacing: 3px;
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
<?php $this->load->view('certificate/contact_details', array('district' => $heirship_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $heirship_data['application_number']; ?>
    <div class="m-t-read" style="text-align: right;">Dated : <?php echo $heirship_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($heirship_data['status_datetime']) : ''; ?></div>
</div>
<hr>
<?php
$commu_address = $heirship_data['ldc_commu_address'] != '' ? $heirship_data['ldc_commu_address'] :
        (($heirship_data['pre_house_no'] != '' ? ($heirship_data['pre_house_no'] . ', ') : '')
        . ($heirship_data['pre_house_name'] != '' ? ($heirship_data['pre_house_name'] . ', ') : '')
        . ($heirship_data['pre_street'] != '' ? ($heirship_data['pre_street'] . ', ') : '')
        . ($heirship_data['pre_village'] != '' ? ($heirship_data['pre_village'] . ', ') : '')
        . ($heirship_data['pre_city'] != '' ? ($heirship_data['pre_city']) : ''));
?>
<div class="f-s-14px">READ :</div>
<table class="f-s-14px read">
    <tr>
        <td style="width: 25px; vertical-align: top;">1.</td>
        <td style="text-align: justify;">
            Application dated <b><?php echo $heirship_data['submitted_datetime'] != '0000-00-00' ? convert_to_new_date_format($heirship_data['submitted_datetime']) : ''; ?></b>,
            received from <b style="text-transform: capitalize;"><?php echo $heirship_data['applicant_name']; ?>,
                R/o. <?php echo $commu_address; ?></b>
        </td>
    </tr>
</table>
<table class="f-s-14px read">
    <tr>
        <td style="width: 25px; vertical-align: top;">2.</td>
        <td>
            Affidavit Dated : <b><?php echo $heirship_data['submitted_datetime'] != '0000-00-00' ? convert_to_new_date_format($heirship_data['submitted_datetime']) : ''; ?></b>
        </td>
    </tr>
</table>
<table class="f-s-14px read">
    <tr>
        <td style="width: 25px; vertical-align: top;">3.</td>
        <td>
            Enquiry Report No. : <b><?php echo $heirship_data['application_number']; ?></b>, received from Talathi
        </td>
    </tr>
</table>
<br/>
<div style="font-size: 25px; text-align: center; margin-top: 5px;font-weight: bold;"><u>Heirship Certificate</u></div>
<br/>
<?php $ldc_dp_name = ldc_app_details($heirship_data, 'death_person_name', 'ldc_death_person_name'); ?> 
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 5px;word-spacing: 5px;margin-top: 0px; line-height: 20px;
     text-align: justify;">
    &nbsp;&nbsp;&nbsp;&nbsp;This is to certify that an enquiry was carried out and it is revealed that the
    following are family members of <b>Late. <span style="border-bottom: 1px solid black; text-transform: capitalize;">
            <?php echo $ldc_dp_name; ?></span></b> 
    resident of <b style="border-bottom: 1px solid black; text-transform: capitalize;">
        <?php echo $heirship_data['ldc_death_person_address'] != '' ? $heirship_data['ldc_death_person_address'] : $commu_address; ?></b>,
    District <b style="border-bottom: 1px solid black;"><?php echo $taluka_name; ?></b>.
</div>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 5px;word-spacing: 8px;margin-top: 3px; line-height: 15px;">
    <div class="table-responsive">
        <table class="table table-bordered table-padding" style="width: 100%;border-collapse: collapse;">
            <thead>
                <tr style="border: 1px solid black;">
                    <td class="f-w-b t-a-c v-a-m bg-beige" style="width: 60px;border: 1px solid black;">Sr. No</td>
                    <td class="f-w-b t-a-c v-a-m bg-beige" style="min-width: 190px;border: 1px solid black;"> Name</td>
                    <td class="f-w-b t-a-c v-a-m bg-beige" style="width: 60px;border: 1px solid black;">Age</td>
                    <td class="f-w-b t-a-c v-a-m bg-beige" style="min-width: 50px;border: 1px solid black; text-transform: capitalize;">Relation With Late <?php echo $ldc_dp_name; ?></td>
                </tr>
            </thead>
            <?php
            $efm_cnt = VALUE_ONE;
            $temp_member_details = json_decode($heirship_data['legal_heirs_details'], true);
            $marital_status_array = $this->config->item('marital_status_array');
            foreach ($temp_member_details as $md) {
                $temp_ms = isset($md['member_marital_status']) ? $md['member_marital_status'] : VALUE_ZERO;
                $temp_relation = isset($md['member_relation']) ? $md['member_relation'] : VALUE_ZERO;
                $temp_remarks = isset($md['member_remarks']) ? $md['member_remarks'] : VALUE_ZERO;
                ?>
                <tr style="border: 1px solid black;">
                    <td class="t-a-c" style="border: 1px solid black;"><?php echo $efm_cnt; ?></td>
                    <td style="border: 1px solid black; text-transform: capitalize;"><?php echo isset($md['member_name']) ? $md['member_name'] : ''; ?></td>
                    <td class="t-a-c" style="border: 1px solid black;"><?php echo isset($md['member_age']) ? $md['member_age'] : '--'; ?></td>
                    <td style="border: 1px solid black;">
                        <?php
                        echo isset($relation_deceased_person_array[$temp_relation]) ? $relation_deceased_person_array[$temp_relation]
                                . ($temp_remarks == VALUE_TWO ? ' (Expired)' : '')
                                . (($temp_relation == VALUE_TWELVE) ? (isset($marital_status_array[$temp_ms]) ? ' (' . $marital_status_array[$temp_ms] . ')' : '') : '') : '';
                        ?>
                    </td>
                </tr>
                <?php
                $efm_cnt++;
            }
            ?>
        </table>
    </div>
</div>
<?php if ($efm_cnt > 10) { ?>
    <div style="margin-left: 530px;margin-top: 250px;color: red;"><b>Page {PAGENO} of {nbpg}</b></div>
    <pagebreak></pagebreak>
<?php } ?>
<div class="f-s-14px" style="margin-left: 50px; margin-bottom: 0px;word-spacing: 8px;margin-top: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;This Certificate is issued at the request of the applicant, which is to be produced</div>
<div class="f-s-14px" style="margin-left: 20px; margin-bottom: 0px;word-spacing: 8px;margin-top: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;before the competent authority in the Govt, Semi Govt, Banks, etc.</div>
<?php
$sign_data['extra_style'] = 'margin-left: 50px;';
$sign_data['is_em'] = true;
$sign_data['applicant_photo_doc_path'] = HEIRSHIP_CERTIFICATE_DOC_PATH . $heirship_data['applicant_photo_doc'];
$sign_data['district'] = $heirship_data['district'];
$sign_data['mam_image'] = $mam_image;
$sign_data['mam_name'] = $mam_name;
$sign_data['mtype'] = $mtype;
$sign_data['mam_district'] = (isset($mam_image_array[$heirship_data['district']]) ? $mam_image_array[$heirship_data['district']]['district'] : '');
$this->load->view('certificate/sign', $sign_data);
?>
<div style="margin-top: 10px; text-transform: capitalize;">
    To,<br>
    <?php echo ldc_app_details($heirship_data, 'applicant_name', 'ldc_applicant_name'); ?>
    <br>
    <?php echo 'R/o. ' . $commu_address; ?>
</div>
<div style="margin-top: 10px"><b>Note :</b> This certificate is not succession certificate.</div>
<?php if ($efm_cnt > 10) { ?>
    <table style="margin-top: 600px;margin-left: 530px;">
        <tr>
            <td>
                <span style="color: red;"><b>Page {PAGENO} of {nbpg}</b></span>
            </td>
        </tr>
    </table>
<?php } ?>
<?php $this->load->view('certificate/footer', array('barcode_number' => $barcode_number, 'mtype' => $mtype)); ?>