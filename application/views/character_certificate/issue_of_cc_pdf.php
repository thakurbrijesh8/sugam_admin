<?php
$taluka_array = $this->config->item('taluka_array');
$taluka_name = isset($taluka_array[$character_certificate_data['district']]) ? $taluka_array[$character_certificate_data['district']] : '';
$header_array = array();
$header_array['title'] = 'Certificate';
$header_array['department_name'] = 'Office of the Mamlatdar';
$header_array['district'] = $taluka_name;
//Ex.  A4, Legal
$header_array['page_size'] = 'A4';
$this->load->view('certificate/header', $header_array);

$mam_image_array = $this->config->item('mam_image_array');
$mam_image = isset($mam_image_array[$character_certificate_data['district']]) ? $mam_image_array[$character_certificate_data['district']]['image_path'] : '';
$mam_short = isset($mam_image_array[$character_certificate_data['district']]) ? $mam_image_array[$character_certificate_data['district']]['short_text'] : '';
?>
<style type="text/css">
    body {
        font-size: 16px;
    }
    .f-w-b{
        font-weight: bold;
    }
    .f-s-title{
        font-size: 25px;
        letter-spacing: 1px;
    }
    .t-a-c{
        text-align: center;
    }
    .b-b-1px{
        border-bottom: 1px solid;
    }
    .l-s{
        letter-spacing: 0.5px;
    }
    .l-h{
        line-height: 25px;
    }
    .monthly-income, .app-form-income{
        width: 100%;
        border-collapse: collapse;
    }
    .monthly-income tr td{
        border: 1px solid black;
        padding: 3px;
    }
    .app-form-income tr td{
        border: 1px solid black;
        padding: 5px;
    }
    .f-aum{
        font-family: arial_unicode_ms;
    }
</style>
<?php $this->load->view('certificate/contact_details', array('district' => $character_certificate_data['district'])); ?>
<div class="f-s-14px">No :- MAM/<?php echo ($mam_short != '' ? $mam_short . '/' : '') . $character_certificate_data['application_number']; ?> 
    <div class="f-s-14px" style="text-align: right;">Dated : <?php echo $character_certificate_data['status_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($character_certificate_data['status_datetime']) : ''; ?></div>
</div>
<hr>
<br/>
<div class="f-s">To,</div>
<div class="f-s">The Sub-Divisional Police Office,</div>
<div class="f-s">Daman.</div>
<br/>
<div class="l-s" style="padding-left: 20%;"><span class="f-w-b">Sub&nbsp; :- &nbsp;</span>Issue Of Character Certificate</div>

<div class="f-s">Sir,</div>
<br/>
<div class="l-s">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    It is inform you that, Shri resident of has applied for issue of Character Certificate which is required for his/her Purpose.
</div>
<br/>
<div class="l-s">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Therefore it is requested to please cause enquiry and report on the following point :-
</div>
<br/>
<div class="f-s">1. Name, age, occupation/profession & residential address of the applicant.</div>
<br/>
<div class="f-s">2. Full name of parents and their residential address.</div>
<br/>
<div class="f-s">3. Date & place of birth of applicant.</div>
<br/>
<div class="f-s">4. Whether the applicant is member of organization banned by the GOI.</div>
<br/>
<div class="f-s">5. Whether registered as foreigner.</div>
<br/>
<div class="f-s">6. Whether involved in any case, and presence is required in any Court of Law in india.</div>
<br/>
<div class="f-s">7. Whether bears good moral character and has any antecedents which could render unsuitable for the purpose for which character certificate is applied.</div>
<br/>
<div class="f-s">8. Any other relevant information.</div>
<table style="margin-top: 20px;">
    <tr>
        <td class="f-s-14px" style="vertical-align: bottom; text-align: right; width: 72%; font-weight: bold; padding-left: 300px;">
            <?php
            echo '<span class="f-aum">Yours faithfully,</span><br>';
            if ($mam_image != '') {
                ?>
                <img src="<?php echo $mam_image; ?>" style="width: 200px;" /><br>
                <?php
            }
            echo (isset($mam_image_array[$character_certificate_data['district']]) ? $mam_image_array[$character_certificate_data['district']]['mamlatdar_name'] : '') . '<br>';
            echo '<span class="f-aum">मामलतदार</span> / Mamlatdar<br>';
            echo (isset($mam_image_array[$character_certificate_data['district']]) ? $mam_image_array[$character_certificate_data['district']]['district'] : '') . '<br>';
            ?>
        </td>
    </tr> 
</table>

