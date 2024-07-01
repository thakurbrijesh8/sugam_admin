<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Declaration</title>
        <style type="text/css">
            body {
                font-size: 14px;
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
        </style>
    </head>
    <body>
        <?php
            $marital_status_array = $this->config->item('marital_status_array');
            $taluka_array = $this->config->item('taluka_array');
            $daman_villages_array = $this->config->item('daman_villages_array');
            $diu_villages_array = $this->config->item('diu_villages_array');
            $dnh_villages_array = $this->config->item('dnh_villages_array');
            
            $taluka_name_text = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
            $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');

            if($district == TALUKA_DAMAN){
                $village_name_text = (isset($daman_villages_array[$village_name]) ? $daman_villages_array[$village_name] : '');
            }
            else if($district == TALUKA_DIU){
                $village_name_text = (isset($diu_villages_array[$village_name]) ? $diu_villages_array[$village_name] : '');
            }
             else if($district == TALUKA_DNH){
                $village_name_text = (isset($dnh_villages_array[$village_name]) ? $dnh_villages_array[$village_name] : '');
            }
        ?>
        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I Shri/Miss/Mrs <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_name . '&nbsp;'; ?></span>
                <?php if($father_husbund_name != ''){ ?> Son of /  daughter of /  wife of <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_husbund_name . '&nbsp;'; ?></span><?php } ?>
                aged  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_age . '&nbsp;'; ?></span> 
                 of <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_place_state_text . $born_place_district_text. '&nbsp;,&nbsp;' . $born_place_village_text . '&nbsp;&nbsp;' ;?></span> of the Union Territory of Daman & Diu / Dadra & Nagar Haveli, do hereby declare that the information given by me in this application form and its attached enclosures is true to the best of my knowledge and that the information furnished is exhaustive and I have not suppressed any fact. That I am solely responsible for the accuracy of the declaration and information furnished and liable for action under section 199 and 200 of the Indian penal code in case of wrong declaration and information. Also I am well aware of the fact that the certificate shall be summarily cancelled and all the benefits availed by meshall be summarily cancelled and all the benefits availed by me shall be summarily withdrawn incase of wrong declaration and information <?php if($constitution_artical == VALUE_TWO){ ?> That I am applied for my Minor Child <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $minor_child_name . '&nbsp;'; ?></span><?php } ?>.</div>

            <table style="margin-top: 10px; width: 100%;">
                <tr>
                    <td style="vertical-align: top; width: 33%;">
                        <b>Place&nbsp; :-</b> <?php echo $taluka_name_text; ?><br>
                        <b>Dated :-</b> <?php echo $submitted_datetime == '0000-00-00 00:00:00' ? date('d-m-Y') : convert_to_new_date_format($submitted_datetime); ?>
                    </td>
                    <td class="t-a-c" style="width: 25%;">
                        <img src='<?php echo EWS_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'
                             style="width: 110px; height: 130px; border: 1px solid;" />
                    </td>
                    <td class="t-a-c" style="width: 42%;">
                        <div>
                            This Declaration is electronically generated and no signature is required.
                        </div>
                        <div style="border-bottom: 1px dashed;">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <br>
                        <div style="padding-top: 3px;">
                            DEPONENT
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>