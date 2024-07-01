<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Application PDF</title>
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
        </style>
    </head>
    <body>
        <?php
            $taluka_array = $this->config->item('taluka_array');
            $taluka_name = isset($taluka_array[$character_certificate_data['district']]) ? $taluka_array[$character_certificate_data['district']] : '-';
        ?>
        <div style="font-family: arial_unicode_ms;">
            <div class="l-s" style="padding-left: 70%;"><span class="f-w-b">From&nbsp; :</span></div>
            <div class="l-s" style="padding-left: 70%;"><span class="f-w-b"><?php echo $character_certificate_data['applicant_name']; ?></span></div>
            <div class="l-s" style="padding-left: 70%;"><?php echo $character_certificate_data['com_addr_house_no']; ?>&nbsp;<?php echo $character_certificate_data['com_addr_house_name']; ?></div>
            <div class="l-s" style="padding-left: 70%;"><?php echo $character_certificate_data['com_addr_street']; ?>&nbsp;<?php echo $character_certificate_data['com_addr_village_dmc_ward']; ?></div>
            <div class="l-s" style="padding-left: 70%;"><?php echo $character_certificate_data['com_addr_city']; ?>&nbsp;-&nbsp;<?php echo $character_certificate_data['com_pincode']; ?></div>
            <div class="l-s" style="padding-left: 70%;">Dated :- <span class="f-w-b"><?php echo $character_certificate_data['submitted_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_date_format($character_certificate_data['submitted_datetime']) : '-'; ?></span></div>
            <br>
            <div class="l-s"><span class="f-w-b">To,&nbsp;</span></div>
            <div class="l-s">The Mamlatdar,</div>
            <div class="l-s">Daman.</div>
            <br><br>
            <div class="l-s" style="padding-left: 20%;"><span class="f-w-b">Sub&nbsp; :- &nbsp;</span>Request For Issue Of <span class="f-w-b">Character Certificate.</span></div>
            <br>
            <div class="l-s"><span class="f-w-b">Respected Sir,&nbsp;</span></div>
            <br/>
            <div class="l-s l-h" style="height: 90px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I, The Undersigned Above Mentioned Addressed, Kindly Request Your Good self That Please Issue Me <span class="f-w-b"> CHARACTER CERTIFICATE </span>. An Affidavit, Daman Is Enclosed Herewith For The Same. That I was Born On Dated <?php echo convert_to_new_date_format($character_certificate_data['applicant_dob']); ?>, At Daman And Residing In <?php echo $taluka_name; ?> Since Birth And There Is No Case Against Me In Any Court.
            </div>
            <br/>
            <div class="l-s l-h" style="height: 90px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                That Please Issue Me <span class="f-w-b"> CHARACTER CERTIFICATE </span> For My <?php echo $purpose; ?> Purpose.
            </div>
            <div class="l-s"><span class="f-w-b">Thanking You,</span></div>
            <div class="l-s" style="padding-left: 70%;"><span class="f-w-b">Yours Faithfully,</span></div>
            <div class="l-s" style="padding-left: 70%;"><span class="f-w-b"><?php echo $character_certificate_data['applicant_name']; ?></span></div>
        </div>
    </body>
</html>
