<html>
    <head>
        <title>Marraige Application</title>
        <style type="text/css">
            @page {
                /*margin: 60px;*/
                sheet-size:A4;
                margin-top: 15px;
                margin-bottom: 15px;
                margin-right: 20px;
            }
            body {
                font-family: arial_unicode_ms;
                font-size: 12px;
            }
            hr {
                margin: 0px;
            }
            .first-column{
                width: 18%;
            }
            .font-timesnewroman{
                font-family: timesnewroman;
            }
            .m-t{
                margin-top: 7px;
            }
            .blank-line{
                width: 673px;
                margin-top: 15px;
                text-align: center;
                border-bottom: 1px solid black;
            }
            .t-a-c{
                text-align: center;
            }
            .border-bottom{
                border-bottom: 1px solid black;
            }
            .w-100{
                width: 100%;
            }
            .w-80{
                width: 80px;
            }
            .page-m-r{
                margin-right: 20px;
            }
            .h-25{
                height: 25px;
            }
            .h-20{
                height: 22px;
            }
            .l-h{
                line-height: 10px;
            }
            .f-s{
                font-size: 12px;
            }
            .w-17{
                width: 17%;
                padding-right: 10px;
            }
            .w-170{
                width: 170px;
            }
            .w-150{
                width: 150px;
            }
            .w-105{
                width: 105px;
            }
            .w-70{
                width: 70px;
            }
            .font-timesnewroman{
                font-weight: bold;
            }
            .w-130{
                width: 130px;
            }
            .w-60{
                width: 60px;
            }
            .v-a-b{
                vertical-align: bottom;
            }
            .w-23{
                width: 23%; 
            }
            .f-w-b{
                font-weight: bold;
            }
            /* .witness-table tr th, td{
                border: 1px solid black;
                padding: 5px;
            } */
            /* .l-h-20{
                line-height: 20px;
            } */
        </style>
    </head>
    <body>
        <?php
            $applicant_occupation_array = $this->config->item('applicant_occupation_array');
            $taluka_array = $this->config->item('taluka_array');

            $bridegroom_occupation_text = (isset($applicant_occupation_array[$marriage_application_data['bridegroom_occupation']]) ? ($marriage_application_data['bridegroom_occupation'] == VALUE_TWELVE ? $marriage_application_data['$bridegroom_other_occupation'] : $applicant_occupation_array[$marriage_application_data['bridegroom_occupation']]) : '-');
            $bridegroom_father_occupation_text = (isset($applicant_occupation_array[$marriage_application_data['bridegroom_father_occupation']]) ? ($marriage_application_data['bridegroom_father_occupation'] == VALUE_TWELVE ? $marriage_application_data['$bridegroom_father_other_occupation'] : $applicant_occupation_array[$marriage_application_data['bridegroom_father_occupation']]) : '-');
            $bridegroom_mother_occupation_text = (isset($applicant_occupation_array[$marriage_application_data['bridegroom_mother_occupation']]) ? ($marriage_application_data['bridegroom_mother_occupation'] == VALUE_TWELVE ? $marriage_application_data['$bridegroom_mother_other_occupation'] : $applicant_occupation_array[$marriage_application_data['bridegroom_mother_occupation']]) : '-');

            $bride_occupation_text = (isset($applicant_occupation_array[$marriage_application_data['bride_occupation']]) ? ($marriage_application_data['bride_occupation'] == VALUE_TWELVE ? $marriage_application_data['$bride_other_occupation'] : $applicant_occupation_array[$marriage_application_data['bride_occupation']]) : '-');
            $bride_father_occupation_text = (isset($applicant_occupation_array[$marriage_application_data['bride_father_occupation']]) ? ($marriage_application_data['bride_father_occupation'] == VALUE_TWELVE ? $marriage_application_data['$bride_father_other_occupation'] : $applicant_occupation_array[$marriage_application_data['bride_father_occupation']]) : '-');
            $bride_mother_occupation_text = (isset($applicant_occupation_array[$marriage_application_data['bride_mother_occupation']]) ? ($marriage_application_data['bride_mother_occupation'] == VALUE_TWELVE ? $marriage_application_data['$bride_mother_other_occupation'] : $applicant_occupation_array[$marriage_application_data['bride_mother_occupation']]) : '-');

            $taluka_name_text = isset($taluka_array[$marriage_application_data['district']]) ? $taluka_array[$marriage_application_data['district']] : '-';
        ?>
        <!-- Form -->

        <div style="padding-top: 20px;font-size: 16px; text-align: center;"><u class="f-w-b">Details of Bridegroom & his Parents (BOY)</u></div>
        <div class="f-w-b" style="font-size: 14px; text-align: center;"><u class="f-w-b">दूल्हे और उसके माता-पिता का विवरण (लड़का)</u></div>
        <table style="margin-top: 5px; width: 100%;">
            <tr>
                <td class="first-column f-w-b">Name of Bridegroom <br> दूल्हे का नाम</td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $marriage_application_data['bridegroom_name']; ?><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Place of Birth <br> जन्म स्थान </td>
                <td class="font-timesnewroman v-a-b"><?php echo $marriage_application_data['bridegroom_birthplace_state_text']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">City/Village :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bridegroom_birthplace_village_text']; ?></span><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bridegroom_birthplace_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Place of Residence <br> निवास की जगह </td>
                <td class="font-timesnewroman v-a-b" colspan="2"><?php echo $marriage_application_data['bridegroom_residence']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bridegroom_residence_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Occupation <br> व्यवसाय </td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $bridegroom_occupation_text; ?><hr></td>
            </tr>
        </table>
        <table style="margin-top: 10px; width: 100%;">
            <tr>
                <td class="f-w-b" style="width: 23%;">Name of Bridegroom's Father <br> दूल्हे के पिता का नाम</td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $marriage_application_data['bridegroom_father_name']; ?><hr></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td class="first-column f-w-b">Place of Birth <br> जन्म स्थान </td>
                <td class="font-timesnewroman v-a-b"><?php echo $marriage_application_data['bridegroom_father_birthplace_state_text']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">City/Village :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bridegroom_father_birthplace_village_text']; ?></span><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bridegroom_father_birthplace_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Place of Residence <br> निवास की जगह </td>
                <td class="font-timesnewroman v-a-b" colspan="2"><?php echo $marriage_application_data['bridegroom_father_residence']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bridegroom_father_residence_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Occupation <br> व्यवसाय </td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $bridegroom_father_occupation_text; ?><hr></td>
            </tr>
        </table>
        <table style="margin-top: 10px; width: 100%;">
            <tr>
                <td class="f-w-b" style="width: 23%;">Name of Bridegroom's Mother <br> दूल्हे के माता का नाम</td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $marriage_application_data['bridegroom_mother_name']; ?><hr></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td class="first-column f-w-b">Place of Birth <br> जन्म स्थान </td>
                <td class="font-timesnewroman v-a-b"><?php echo $marriage_application_data['bridegroom_mother_birthplace_state_text']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">City/Village :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bridegroom_mother_birthplace_village_text']; ?></span><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bridegroom_mother_birthplace_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Place of Residence <br> निवास की जगह </td>
                <td class="font-timesnewroman v-a-b" colspan="2"><?php echo $marriage_application_data['bridegroom_mother_residence']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bridegroom_mother_residence_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Occupation <br> व्यवसाय </td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $bridegroom_mother_occupation_text; ?><hr></td>
            </tr>
        </table>
        <div style="font-size: 16px; text-align: center; margin-top: 5px;"><u class="f-w-b">Details of Bride & her Parents (GIRL)</u></div>
        <div style="font-size: 14px; text-align: center;"><u class="f-w-b">दुल्हन और उसके माता-पिता का विवरण (लड़की)</u></div>
        <table style="margin-top: 5px; width: 100%;">
            <tr>
                <td class="first-column f-w-b">Name of Bride <br> दुल्हन का नाम</td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $marriage_application_data['bride_name']; ?><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Place of Birth <br> जन्म स्थान </td>
                <td class="font-timesnewroman v-a-b"><?php echo $marriage_application_data['bride_birthplace_state_text']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">City/Village :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bride_birthplace_village_text']; ?></span><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bride_birthplace_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Place of Residence <br> निवास की जगह </td>
                <td class="font-timesnewroman v-a-b" colspan="2"><?php echo $marriage_application_data['bride_residence']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bride_residence_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Occupation <br> व्यवसाय </td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $bride_occupation_text; ?><hr></td>
            </tr>
        </table>
        <table style="margin-top: 10px; width: 100%;">
            <tr>
                <td class="first-column f-w-b">Name of Bride's Father <br> दुल्हन के पिता का नाम</td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $marriage_application_data['bride_father_name']; ?><hr></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td class="first-column f-w-b">Place of Birth <br> जन्म स्थान </td>
                <td class="font-timesnewroman v-a-b"><?php echo $marriage_application_data['bride_father_birthplace_state_text']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">City/Village :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bride_father_birthplace_village_text']; ?></span><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bride_father_birthplace_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Place of Residence <br> निवास की जगह </td>
                <td class="font-timesnewroman v-a-b" colspan="2"><?php echo $marriage_application_data['bride_father_residence']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bride_father_residence_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Occupation <br> व्यवसाय </td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $bride_father_occupation_text; ?><hr></td>
            </tr>
        </table>
        <table style="margin-top: 10px; width: 100%;">
            <tr>
                <td class="f-w-b" style="width: 19%;">Name of Bride's Mother <br> दुल्हन के माता का नाम</td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $marriage_application_data['bride_mother_name']; ?><hr></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td class="first-column f-w-b">Place of Birth <br> जन्म स्थान </td>
                <td class="font-timesnewroman v-a-b"><?php echo $marriage_application_data['bride_mother_birthplace_state_text']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">City/Village :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bride_mother_birthplace_village_text']; ?></span><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bride_mother_birthplace_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Place of Residence <br> निवास की जगह </td>
                <td class="font-timesnewroman v-a-b" colspan="2"><?php echo $marriage_application_data['bride_mother_residence']; ?><hr></td>
                <td class="v-a-b w-23"><span class="f-w-b">Taluka :- </span><span class="font-timesnewroman"><?php echo $marriage_application_data['bride_mother_residence_district_text']; ?></span><hr></td>
            </tr>
            <tr>
                <td class="first-column f-w-b">Occupation <br> व्यवसाय </td>
                <td class="font-timesnewroman v-a-b" colspan="3"><?php echo $bride_mother_occupation_text; ?><hr></td>
            </tr>
        </table>
        <div style="font-size: 14px; text-align: center; margin-bottom: 10px;"></div>
        <table>
            <tr>
                <td><span class="f-w-b">Note :- </span><u>The Details should be in accordance with birth certificate. (विवरण जन्म प्रमाण पत्र के अनुसार होना चाहिए|)</u></td>
            </tr>
        </table>
        <div style="font-size: 14px; text-align: center; margin-bottom: 30px;"></div>
        <div class="f-w-b" style="text-align: right; margin-right: 50px;">Signature (हस्ताक्षर)</div>
        <pagebreak></pagebreak>
        <!-- Declaration -->
        <div style="margin-left: 85%;">
            <div>Paid Rs. 50/-</div>
            <div>on &emsp;/&emsp;/</div>
        </div>
        <div style="font-size: 14px; text-align: center;">ADMINISTRATION OF DAMAN AND DIU (U.T.)</div>
        <div style="font-size: 20px; text-align: center; margin-top: 0px;font-weight: bold; ">CIVIL REGISTRATION OFFICE AT DAMAN </div>
        <div style="font-size: 14px; text-align: center; margin-bottom: 10px;"></div>
        <div>
            <div style="margin-left:330px;">DECLARATION FOR MARRIAGE NO.</div>
            <div class="t-a-c border-bottom font-timesnewroman page-m-r" style="margin-top: -20px; margin-left: 550px;"><?php echo $marriage_application_data['marriage_no']; ?></div>
        </div>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-17" style="text-align: right; w">We</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h"><?php echo $marriage_application_data['bridegroom_name']; ?></td>
                <td class="t-a-c w-80 v-a-b">of</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-170">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $marriage_application_data['bridegroom_age']; ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;years of age,</td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-17" style="text-align: right;">in the marital status</td>
                <td class="border-bottom font-timesnewroman v-a-b l-h f-s t-a-c w-150"><?php echo $marriage_application_data['bridegroom_marital_status']; ?></td>
                <td class="t-a-c w-80 v-a-b">Profession</td>
                <td class="border-bottom v-a-b t-a-c l-h h-20 f-s font-timesnewroman"><?php echo $bridegroom_occupation_text; ?></td>
                <td class="border-bottom v-a-b w-105"> born at ward</td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">or quarter</td>
                <td class="border-bottom font-timesnewroman l-h v-a-b f-s"><?php echo $marriage_application_data['bridegroom_birthplace_state_text']; ?></td>
                <td class="t-a-c v-a-b w-80">city/village of</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman" style="width: 220px;"><?php echo $marriage_application_data['bridegroom_birthplace_village_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">Taluka of</td>
                <td class="border-bottom font-timesnewroman l-h v-a-b f-s" style="width: 120px;"><?php echo $marriage_application_data['bridegroom_birthplace_district_text']; ?></td>
                <td class="t-a-c v-a-b" style="width: 100px;">and residing at</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman"><?php echo $marriage_application_data['bridegroom_residence']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">Taluka of</td>
                <td class="border-bottom font-timesnewroman l-h v-a-b f-s w-80"><?php echo $marriage_application_data['bridegroom_residence_district_text']; ?></td>
                <td class="t-a-c v-a-b" style="width: 40px;">son of</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman"><?php echo $marriage_application_data['bridegroom_father_name']; ?></td>
                <td class="v-a-b w-60">profession</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $bridegroom_father_occupation_text; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-130">born at ward or quarter</td>
                <td class="border-bottom font-timesnewroman l-h v-a-b f-s"><?php echo $marriage_application_data['bridegroom_father_birthplace_state_text']; ?></td>
                <td class="v-a-b w-60">city/village</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $marriage_application_data['bridegroom_father_birthplace_village_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-130">and residing at</td>
                <td class="border-bottom font-timesnewroman l-h v-a-b f-s"><?php echo $marriage_application_data['bridegroom_father_residence']; ?></td>
                <td class="v-a-b w-60">Taluka of</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $marriage_application_data['bridegroom_father_residence_district_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">and of </td>
                <td class="border-bottom font-timesnewroman l-h v-a-b f-s"><?php echo $marriage_application_data['bridegroom_mother_name']; ?></td>
                <td class="v-a-b w-60">profession</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $bridegroom_mother_occupation_text; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-130">born at ward or quarter</td>
                <td class="border-bottom font-timesnewroman l-h v-a-b f-s"><?php echo $marriage_application_data['bridegroom_mother_birthplace_state_text']; ?></td>
                <td class="v-a-b w-60">city/village</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $marriage_application_data['bridegroom_mother_birthplace_village_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-130">and residing at</td>
                <td class="border-bottom font-timesnewroman l-h v-a-b f-s"><?php echo $marriage_application_data['bridegroom_mother_residence']; ?></td>
                <td class="v-a-b w-60">Taluka of</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $marriage_application_data['bridegroom_mother_residence_district_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">AND</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h"><?php echo $marriage_application_data['bride_name']; ?></td>
                <td class="v-a-b w-60 t-a-c">of</td>
                <td class="border-bottom v-a-b t-a-c f-s font-timesnewroman w-150"><?php echo $marriage_application_data['bride_age']; ?></td>
                <td class="v-a-b l-h h-20 t-a-c w-80">years of age,</td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-130">in the marital status</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h w-150 t-a-c"><?php echo $marriage_application_data['bride_marital_status']; ?></td>
                <td class="v-a-b w-60 t-a-c">profession</td>
                <td class="border-bottom v-a-b t-a-c f-s font-timesnewroman"><?php echo $bride_occupation_text; ?></td>
                <td class="v-a-b l-h h-20 w-80 t-a-c">born at ward</td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">or quarter</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h"><?php echo $marriage_application_data['bride_birthplace_state_text']; ?></td>
                <td class="t-a-c v-a-b w-80">city/village of</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman" style="width: 220px;"><?php echo $marriage_application_data['bride_birthplace_village_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">Taluka of</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h" style="width: 120px;"><?php echo $marriage_application_data['bride_birthplace_district_text']; ?></td>
                <td class="t-a-c v-a-b" style="width: 100px;">and residing at</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman"><?php echo $marriage_application_data['bride_residence']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">Taluka of</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h w-80"><?php echo $marriage_application_data['bride_residence_district_text']; ?></td>
                <td class="t-a-c v-a-b" style="width: 68px;">daughter of</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman"><?php echo $marriage_application_data['bride_father_name']; ?></td>
                <td class="v-a-b w-60">profession</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-130" s><?php echo $bride_father_occupation_text; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-130">born at ward or quarter</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h"><?php echo $marriage_application_data['bride_father_birthplace_state_text']; ?></td>
                <td class="v-a-b w-60">city/village</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $marriage_application_data['bride_father_birthplace_village_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-130">and residing at</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h"><?php echo $marriage_application_data['bride_father_residence']; ?></td>
                <td class="v-a-b w-60">Taluka of</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $marriage_application_data['bride_father_residence_district_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">and of </td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h"><?php echo $marriage_application_data['bride_mother_name']; ?></td>
                <td class="v-a-b w-60">profession</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $bride_mother_occupation_text; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-130">born at ward or quarter</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h"><?php echo $marriage_application_data['bride_mother_birthplace_state_text']; ?></td>
                <td class="v-a-b w-60">city/village</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $marriage_application_data['bride_mother_birthplace_village_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-130">and residing at</td>
                <td class=" border-bottom font-timesnewroman v-a-b f-s l-h"><?php echo $marriage_application_data['bride_mother_residence']; ?></td>
                <td class="v-a-b w-60">Taluka of</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman w-150"><?php echo $marriage_application_data['bride_mother_residence_district_text']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b">do hereby declare that we wish to solemnize our marriage connonical / civil</td>
                <td class="border-bottom v-a-b l-h h-20 f-s font-timesnewroman" style="width: 285px"></td>
            </tr>
        </table>
        <table class="w-100 page-m-r" style="margin-top: 10px;">
            <tr>
                <td class="v-a-b" style="text-align: right;">Annexed are hereto a certificate of residence of</td>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman" style="width: 320px"><?php echo $marriage_application_data['residence_of']; ?></td>
                <td class="v-a-b" style="width: 20px;">and</td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman"><?php echo $marriage_application_data['applicant_certificate_details']; ?></td>
                <td class="v-a-b w-60 t-a-c">certificate</td>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman" style="width: 320px"><?php echo $marriage_application_data['certificate']; ?></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-80">annexed, for</td>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman"></td>
                <td class="v-a-b w-80 t-a-c">registration</td>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman"></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b">found registered in the book of this Office in the year</td>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman w-170"></td>
                <td class="v-a-b w-70 t-a-c">under No.</td>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman w-170"></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman"></td>
                <td class="v-a-b w-60 t-a-c">under No.</td>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman"></td>
            </tr>
        </table>
        <table class="w-100 page-m-r">
            <tr>
                <td class="v-a-b w-70">respectively</td>
                <td class="border-bottom t-a-c v-a-b l-h h-20 f-s font-timesnewroman"></td>
            </tr>
        </table>
        <div>
            <div style="margin-left:50px;margin-top: 10px;">The consent for the groom/bride/is given/will be given by</div>
            <div style="width: 230px;margin-top: 0px; margin-left: 360px;text-align: center;border-bottom: 1px solid black;"></div>
            <div style="margin-left:600px;margin-top: -20px;">parents.</div>
        </div>
        <div>
            <div style="margin-left:50px;margin-top: 5px;">For</div>
            <div style="width: 320px;margin-top: 0px; margin-left: 70px;text-align: center;border-bottom: 1px solid black;"></div>
            <div style="margin-left:400px;margin-top: -20px;">not knowing to sign on</div>
            <div style="width: 150px;margin-top: 0px; margin-left: 525px;text-align: center;border-bottom: 1px solid black;"></div>
        </div>
        <div>
            <div style="margin-top: 5px;">behalf sign</div>
            <div style="width: 605px;margin-top: 0px; margin-left: 70px;text-align: center;border-bottom: 1px solid black;"></div>
        </div>
        <div>
            <div class="blank-line"></div>
            <div class="blank-line"></div>
            <div class="blank-line"></div>
            <div class="blank-line"></div>
            <div class="blank-line"></div>
        </div>
        <div>
            <div style="margin-left:30px;margin-top: 10px;">Whereas the legal formalities relating to the notice of marriage which the declaration on the pre-page refers to have been</div>
            <div>compiled with, I do hereby certify that no impediment for the solemnization of the said marriage has been brought to our notice </div>
            <div>within the legal time limit. </div>
            <div class="font-timesnewroman" style="width: 100px;margin-top: -8px; margin-left: 340px;text-align: center;border-bottom: 1px solid black;"><?php echo date_format(date_create($marriage_application_data['declaration_date']), 'jS'); ?></div>
            <div style="margin-left:450px;margin-top: -20px;">day of</div>
            <div class="font-timesnewroman" style="width: 180px;margin-top: -18px; margin-left: 490px;text-align: center;border-bottom: 1px solid black; text-transform: uppercase;"><?php echo date_format(date_create($marriage_application_data['declaration_date']), 'F   Y'); ?></div>
            <div style="width: 250px;margin-top: 24px; margin-left: 380px;text-align: center;font-size: 13px;font-weight: bold;letter-spacing: 1px;">The Civil Registrar, Daman</div>
        </div>
        <pagebreak></pagebreak>

        <!-- witness -->

        <div style="padding-top: 40px;font-size: 14px; text-align: center;">ADMINISTRATION OF DAMAN AND DIU (U.T.)</div>
        <div style="font-size: 20px; text-align: center; margin-top: 0px;font-weight: bold; ">CIVIL REGISTRATION SERVICE OF DAMAN AND DIU </div>
        <div style="font-size: 14px; text-align: center; margin-bottom: 10px;">Act referred to in section 17 of Order No. 190 of 2nd May, 1914</div>

        <div>
            <div style="margin-left:50px;margin-top: 25px;">Office of the Civil Registrar of</div>
            <div class="font-timesnewroman l-h-20" style="width: 445px;margin-top: -20px; margin-left: 225px;text-align: center;border-bottom: 1px solid black;"><?php echo $taluka_name_text; ?></div>
        </div>
        <div>
            <div style="margin-left:50px;margin-top: 10px;">On the</div>
            <div class="font-timesnewroman l-h-20" style="width: 105px;margin-top: -20px; margin-left: 105px;text-align: center;border-bottom: 1px solid black;"><?php echo date_format(date_create($marriage_application_data['declaration_date']), 'jS'); ?></div>
            <div style="width: 105px;margin-top: -20px; margin-left: 185px;text-align: center;">day of</div>
            <div class="font-timesnewroman l-h-20" style="width: 165px;margin-top: -20px; margin-left: 265px;text-align: center;border-bottom: 1px solid black;"><?php echo date_format(date_create($marriage_application_data['declaration_date']), 'F'); ?></div>
            <div style="width: 105px;margin-top: -20px; margin-left: 415px;text-align: center;">of the year</div>
            <div class="font-timesnewroman l-h-20" style="width: 169px;margin-top: -20px; margin-left: 500px;text-align: center;border-bottom: 1px solid black;"><?php echo date_format(date_create($marriage_application_data['declaration_date']), 'Y'); ?></div>
        </div>
        <div>
            <div style="margin-top: 10px;">in the Civil Registration office of</div>
            <div class="font-timesnewroman l-h-20" style="width: 355px;margin-top: -20px; margin-left: 185px;text-align: center;border-bottom: 1px solid black;"><?php echo $taluka_name_text; ?></div>
            <div style="margin-top: -20px; margin-left: 555px;">appeared before me</div>
        </div>
        <div>
            <div class="font-timesnewroman l-h-20" style="width: 300px;margin-top: 10px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['authorized_person_name']; ?></div>
            <div style="margin-left:310px;margin-top: -20px;"> individual named</div>
            <div style="width: 245px;margin-top: 0px; margin-left: 425px;text-align: center;border-bottom: 1px solid black;"></div>
        </div>
        <table class="witness-table" style="width: 100%; margin-top: 20px;border-collapse: collapse; margin-right: 45px;">
            <tr>
                <th style="width: 20px;"> No.</th>
                <th class="t-a-c" style="width: 250px;">Name</th>
                <th style="width: 30px;">Age</th>
                <th style="letter-spacing: 1px; width: 100px;">Occupation</th>
                <th style="letter-spacing: 1px;">Address</th>
            </tr>
            <?php
            $i = 1;
            $witness_details = json_decode($marriage_application_data['witness_details'], true);
            foreach ($witness_details as $wd) {
                ?>
                <tr>
                    <td class="font-timesnewroman t-a-c" style="font-weight: normal;"><?php echo $i++; ?></td>
                    <td class="font-timesnewroman" style="font-weight: normal;"><?php echo $wd['witness_name']; ?></td>
                    <td class="font-timesnewroman t-a-c" style="font-weight: normal;"><?php echo $wd['witness_age']; ?></td>
                    <td class="font-timesnewroman t-a-c" style="font-weight: normal;"><?php echo $applicant_occupation_array[$wd['witness_occupation']]; ?></td>
                    <td class="font-timesnewroman" style="font-weight: normal;"><?php echo $wd['witness_address']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <div>
            <div style="margin-top: 10px;">and each one for himself / herself and all " In Solidum " warranted to me that</div>
        </div>
        <div>
            <div class="font-timesnewroman l-h-20" style="width: 430px;margin-top: 5px; margin-left: 0px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_name']; ?></div>
            <div style="margin-left:440px;margin-top: -20px;">of</div>
            <div class="font-timesnewroman l-h-20" style="width: 120px;margin-top: -18px; margin-left: 465px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_age']; ?></div>
            <div style="margin-left:600px;margin-top: -20px;">years of age,</div>
        </div>
        <div>
            <div style="margin-top: 7px;">profession</div>
            <div class="font-timesnewroman l-h-20" style="width: 200px;margin-top: -20px; margin-left: 65px;text-align: center;border-bottom: 1px solid black;"><?php echo $bridegroom_occupation_text; ?></div>
            <div style="margin-left:270px;margin-top: -20px;">born at</div>
            <div class="font-timesnewroman l-h-20" style="width: 355px;margin-top: -18px; margin-left: 315px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_birthplace_state_text']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">tauka of</div>
            <div class="font-timesnewroman l-h-20" style="width: 180px;margin-top: -20px; margin-left: 50px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_birthplace_district_text']; ?></div>
            <div style="margin-left:240px;margin-top: -20px;">and residing at</div>
            <div class="font-timesnewroman l-h-20" style="width: 345px;margin-top: -18px; margin-left: 325px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_residence']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">tauka of</div>
            <div class="font-timesnewroman l-h-20" style="width: 320px;margin-top: -20px; margin-left: 50px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_residence_district_text']; ?></div>
            <div style="margin-left:380px;margin-top: -20px;">for the last twelve months, legitimate son / daughter of</div>
        </div>
        <div>
            <div class="font-timesnewroman l-h-20" style="width: 320px;margin-top: 5px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_father_name']; ?></div>
            <div style="margin-left:325px;margin-top: -20px;"> and</div>
            <div class="font-timesnewroman l-h-20" style="width: 315px;margin-top: -20px; margin-left: 355px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_mother_name']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">is marital status</div>
            <div class="font-timesnewroman l-h-20" style="width: 320px;margin-top: -20px; margin-left: 90px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_marital_status']; ?></div>
            <div style="margin-left:420px;margin-top: -20px;">and he/she is the same person who wishes to</div>
        </div>
        <div>
            <div style="margin-top: 7px;">solemnize his/her marriage to</div>
            <div class="font-timesnewroman l-h-20" style="width: 480px;margin-top: -20px; margin-left: 190px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_name']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">marital status</div>
            <div class="font-timesnewroman l-h-20" style="width: 250px;margin-top: -18px; margin-left: 100px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_marital_status']; ?></div>
            <div style="margin-left:360px;margin-top: -20px;">of</div>
            <div class="font-timesnewroman l-h-20" style="width: 140px;margin-top: -18px; margin-left: 385px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_age']; ?></div>
            <div style="margin-left:545px;margin-top: -20px;">years of age, born at</div>
        </div>
        <div>
            <div class="font-timesnewroman l-h-20" style="width: 420px;margin-top: 7px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_birthplace_state_text']; ?></div>
            <div style="margin-left:430px;margin-top: -20px;"> taluka of</div>
            <div class="font-timesnewroman l-h-20" style="width: 165px;margin-top: -20px; margin-left: 505px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_birthplace_district_text']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">and residing at </div>
            <div class="font-timesnewroman l-h-20" style="width: 570px;margin-top: -20px; margin-left: 100px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_residence']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">tauka of</div>
            <div class="font-timesnewroman l-h-20" style="width: 175px;margin-top: -20px; margin-left: 50px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_residence_district_text']; ?></div>
            <div style="margin-left:230px;margin-top: -20px;">legitimate son/daughter of</div>
            <div class="font-timesnewroman l-h-20" style="width: 295px;margin-top: -18px; margin-left: 375px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_father_name']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">and </div>
            <div class="font-timesnewroman l-h-20" style="width: 622px;margin-top: -20px; margin-left: 48px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_mother_name']; ?></div>
        </div>
        <div>
            <div style="margin-top: 15px;margin-left: 50px;">In witness whereof, this Act is going to be signed by all those present and by me. </div>
        </div>
        <div>
            <?php
            $i = 1;
            $witness_details = json_decode($marriage_application_data['witness_details'], true);
            foreach ($witness_details as $wd) {
                ?>
                <div class="font-timesnewroman l-h-20" style="margin-top: 20px;"><?php echo $i++; ?>)</div>
                <div class="font-timesnewroman l-h-20" style="width: 175px;margin-top: -20px; margin-left: 50px;text-align: center;"><?php echo $wd['witness_name']; ?></div>
            <?php } ?>
        </div>
        <pagebreak></pagebreak>
        <!-- notice -->
        <div style="padding-top: 40px;font-size: 14px; text-align: center;">ADMINISTRATION OF DAMAN AND DIU (U.T.)</div>
        <div style="font-size: 20px; text-align: center; margin-top: 0px;">CIVIL REGISTRATION OFFICE AT DAMAN </div>
        <div style="font-size: 16px; text-align: center; margin-bottom: 10px;font-weight: bold;text-decoration: underline;letter-spacing: 2px;">Notice of Marriage</div>

        <div>
            <div style="margin-left:50px;margin-top: 25px;">Office of the Civil Registrar of</div>
            <div class="font-timesnewroman" style="width: 445px;margin-top: -20px; margin-left: 225px;text-align: left;border-bottom: 1px solid black;"><?php echo $taluka_name_text; ?></div>
        </div>
        <div>
            <div style="margin-top: 10px;">Notice is hereby given that a declaration of marriage is</div>
            <div class="font-timesnewroman" style="width: 375px;margin-top: -18px; margin-left: 295px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_name']; ?></div>
        </div>
        <div>
            <div class="font-timesnewroman" style="width: 230px;margin-top: 5px; margin-left: 0px;text-align: center;border-bottom: 1px solid black;">--</div>
            <div style="margin-left:240px;margin-top: -18px;">of</div>
            <div class="font-timesnewroman" style="width: 80px;margin-top: -18px; margin-left: 255px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_age']; ?></div>
            <div style="margin-left:340px;margin-top: -18px;">years of age,marital status</div>
            <div class="font-timesnewroman" style="width: 185px;margin-top: -18px; margin-left: 485px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_marital_status']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">born at</div>
            <div class="font-timesnewroman" style="width: 575px;margin-top: -18px; margin-left: 45px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_birthplace_state_text']; ?></div>
            <div style="margin-top: -18px;margin-left: 635px;">and</div>
        </div>
        <div>
            <div style="margin-top: 7px;">residing at</div>
            <div class="font-timesnewroman" style="width: 605px;margin-top: -18px; margin-left: 65px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_residence']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">legitimate son of</div>
            <div class="font-timesnewroman" style="width: 310px;margin-top: -20px; margin-left: 95px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_father_name']; ?></div>
            <div style="margin-left:415px;margin-top: -20px;">profession</div>
            <div class="font-timesnewroman" style="width: 200px;margin-top: -18px; margin-left: 475px;text-align: center;border-bottom: 1px solid black;"><?php echo $bridegroom_father_occupation_text; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">born at</div>
            <div class="font-timesnewroman" style="width: 525px;margin-top: -18px; margin-left: 45px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_father_birthplace_state_text']; ?></div>
            <div style="margin-top: -18px;margin-left: 590px;">and residing at</div>
        </div>
        <div>
            <div class="font-timesnewroman" style="width: 620px;margin-top: 5px; margin-left: 0px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_father_residence']; ?></div>
            <div style="margin-left:630px;margin-top: -18px;">and of</div>
        </div>
        <div>
            <div class="font-timesnewroman" style="width: 340px;margin-top: 5px; margin-left: 0px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_mother_name']; ?></div>
            <div style="margin-left:350px;margin-top: -18px;">born at</div>
            <div class="font-timesnewroman" style="width: 270px;margin-top: -18px; margin-left: 398px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_mother_birthplace_state_text']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">and residing at</div>
            <div class="font-timesnewroman" style="width: 545px;margin-top: -18px; margin-left: 85px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bridegroom_mother_residence']; ?></div>
            <div style="margin-top: -18px;margin-left: 645px;">and</div>
        </div>
        <div>
            <div class="font-timesnewroman" style="width: 490px;margin-top: 5px; margin-left: 0px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_name']; ?></div>
            <div style="margin-left:500px;margin-top: -18px;">of</div>
            <div class="font-timesnewroman" style="width: 80px;margin-top: -18px; margin-left: 525px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_age']; ?></div>
            <div style="margin-left:620px;margin-top: -18px;">years of</div>
        </div>
        <div>
            <div style="margin-top: 7px;">age marital status</div>
            <div class="font-timesnewroman" style="width: 180px;margin-top: -18px; margin-left: 105px;text-align: center;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_marital_status']; ?></div>
            <div style="margin-left:295px;margin-top: -18px;">born at</div>
            <div class="font-timesnewroman" style="width: 330px;margin-top: -20px; margin-left: 338px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_birthplace_state_text']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">residing at</div>
            <div class="font-timesnewroman" style="width: 605px;margin-top: -18px; margin-left: 65px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_residence']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">legitimate daughter </div>
            <div class="font-timesnewroman" style="width: 562px;margin-top: -18px; margin-left: 108px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_father_name']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">born at</div>
            <div class="font-timesnewroman" style="width: 525px;margin-top: -18px; margin-left: 45px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_father_birthplace_state_text']; ?></div>
            <div style="margin-top: -18px;margin-left: 590px;">and residing at</div>
        </div>
        <div>
            <div class="font-timesnewroman" style="width: 320px;margin-top: 7px; margin-left: 0px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_father_residence']; ?></div>
            <div style="margin-left:330px;margin-top: -18px;">and of</div>
            <div class="font-timesnewroman" style="width: 298px;margin-top: -18px; margin-left: 368px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_mother_name']; ?></div>
        </div>
        <div>
            <div style="margin-top: 7px;">born at</div>
            <div class="font-timesnewroman" style="width: 525px;margin-top: -18px; margin-left: 45px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_mother_birthplace_state_text']; ?></div>
            <div style="margin-top: -18px;margin-left: 590px;">and residing at</div>
        </div>
        <div>
            <div class="font-timesnewroman" style="width: 668px;margin-top: 5px; margin-left: 0px;text-align: left;border-bottom: 1px solid black;"><?php echo $marriage_application_data['bride_mother_residence']; ?></div>
        </div>
        <div>
            <div style="margin-top: 20px;">stating that they wish to solemnize their marriage. Therefore, whosoever may be aware of nay legal impediments existing to </div>
            <div>the above mentioned in Sections 4 to 10 of Decree No.1, dated the 25th December, 1910, is hereby invited to lodge his</div>
            <div>objections (either orally or in writing) within 10 days from the date of his notice, in compliance with the provisions of section  </div>
            <div>193 of the Civil Registration Code.</div>
        </div>
        <div>
            <div style="margin-top: 20px;margin-left: 20px;">The notice and such others shall be affixed to other places as required by law.</div>
            <div style="margin-top: 10px;margin-left: 20px;">Office of the Civil Registrar of</div>
            <div class="font-timesnewroman" style="width: 360px;margin-top: -18px; margin-left: 185px;text-align: left;border-bottom: 1px solid black;"><?php echo $taluka_name_text; ?></div>
            <div style="margin-top: -18px;margin-left: 550px;">dated</div>
            <div class="font-timesnewroman" style="width: 80px;margin-top: -20px; margin-left: 585px;text-align: center;border-bottom: 1px solid black;"><?php echo date_format(date_create($marriage_application_data['declaration_date']),'jS'); ?></div>
        </div>
        <div>
            <div style="margin-top: 10px;">of</div>
            <div class="font-timesnewroman" style="text-transform: uppercase; width: 635px;margin-top: -18px; margin-left: 30px;text-align: left;border-bottom: 1px solid black;"><?php echo date_format(date_create($marriage_application_data['declaration_date']),'F   Y'); ?></div>
        </div>
        <div>
            <div style="margin-top: 60px;font-weight: bold;letter-spacing: 1px;">1)</div>
            <div class="font-timesnewroman" style="margin-top: 20px;font-weight: bold;letter-spacing: 1px;"><?php echo $marriage_application_data['bridegroom_name']; ?></div>
            <div style="margin-top: 40px;font-weight: bold;letter-spacing: 1px;">2)</div>
            <div class="font-timesnewroman" style="margin-top: 20px;font-weight: bold;letter-spacing: 1px;"><?php echo $marriage_application_data['bride_name']; ?></div>
            <div style="margin-top: -90px;margin-left: 480px;font-weight: bold;letter-spacing: 1px;">The Civil Registrar, Daman</div>
            <div style="margin-top: 30px;margin-left: 450px;border-bottom: 1px solid black;"></div>
        </div>
    </body>
</html>