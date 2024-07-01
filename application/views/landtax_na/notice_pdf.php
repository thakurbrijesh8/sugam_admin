<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Notice Demand to a Defaulter</title>
        <style type="text/css">
            body{
                font-size: 12px;
            }
            .f-s-22px{
                font-size: 22px;
            }
            .f-s-20px{
                font-size: 20px;
            }
            .f-s-14px{
                font-size: 14px;
            }
            .read{
                margin-bottom: 5px;
                word-spacing: 8px;
            }
            .m-t-read{
                margin-top: -18px;
            }
            .f-aum{
                font-family: arial_unicode_ms;
            }
            .table {
                border-collapse: collapse;
                padding: 5px;
                width: 100%;
            }

            .table, .table tr, .table td {
                border: 1px solid black;
                padding: 5px;
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
            .t-a-r{
                text-align: right;
            }
            .v-a-m{
                vertical-align: middle;
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
            .t-d-u{
                text-decoration: underline;
            }
            .color-nic-blue{
                color: #0E4D92;
            }
            .footer-title{
                font-size: 10px;
            }
        </style>
    </head>
    <body>
        <div class="f-s-22px t-a-c f-w-b" style="margin-top: -10px;"><u>Form - 1</u></div><br>
        <div class="f-s-14px t-a-c" style="margin-top: -15px;">(See rule 5)</div><br>
        <div class="f-s-20px t-a-c f-w-b" style="margin-top: -15px;"><u>Notice Demand to a Defaulter</u></div>
        <br><br>
        <div class="f-s-14px">To,</div>
        <div class="f-s-14px f-aum"><?php echo $notice_data['occupant_details']; ?></div>
        <div class="f-s-14px f-aum"><?php echo $notice_data['village_name']; ?></div>
        <br>
        <div class="f-s-14px l-s" style="text-align:justify; line-height: 25px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are hereby required to take notice that a sum of  ₹ 
            <span class="f-w-b t-d-u"><?php echo $notice_data['notice_amount']; ?></span>/- is due from you 
            an account of arrears of land revenue as per details given in the sub-joined statement, and that unless 
            it is paid within <span class="f-w-b t-d-u">07</span> days from the date of the service of this notice 
            compulsory proceedings will be taken against you according to law for the recovery of this dues.
        </div>
        <br>
        <table class="t-a-c table">
            <tr>
                <td class="f-w-b">Sr. No.</td>
                <td class="f-w-b">Village</td>
                <td class="f-w-b">Survey Number</td>
                <td class="f-w-b">Sub Division Number</td>
                <td class="f-w-b">Amount of Arrears</td>
                <td class="f-w-b">Date of Service</td>
            </tr>
            <?php
            $i = 1;
            foreach ($land_details as $index => $ld) {
                ?>
                <tr>
                    <td style="width: 55px;"><?php echo ($index + 1); ?></td>
                    <td class="f-aum v-a-m" style="width: 100px;"><?php echo $notice_data['village_name']; ?></td>
                    <td class="f-aum" style="width: 130px;"><?php echo $ld['survey']; ?></td>
                    <td class="f-aum" style="width: 150px;"><?php echo $ld['subdiv']; ?></td>
                    <td class="t-a-r" style="width: 130px;"><?php echo $ld['pending_amount']; ?>/-</td>
                    <td style="width: 130px;"><?php echo convert_to_new_date_format($notice_data['notice_date']); ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr>
                <td colspan="4" class="f-w-b t-a-r" style="margin-left: 10px;">Grand Total :</td>
                <td class="f-w-b t-a-r"><?php echo $notice_data['notice_amount']; ?>/-</td>
                <td></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td class="f-s-14px" colspan="2" style="padding-top: 10px;">Given under my hand.</td>
            </tr>
        </table>
        <div style="height: 100px; vertical-align: top;">
            <table style="width: 100%;">
                <tr>
                    <td style="vertical-align: bottom;">
                        <div class="f-s-14px">Place :- Mamlatdar Office, <?php echo $district_name; ?></div>
                        <div class="f-s-14px">Dated :- <?php echo convert_to_new_datetime_format($notice_data['created_time']); ?></div>
                        <div class="f-s-14px">Reference Number :- <?php echo $notice_data['khata_number']; ?></div>
                    </td>
                    <td class="t-a-c" style="vertical-align: bottom;">
                        <img src="images/<?php echo get_from_session('temp_id_for_sugam_admin') ?>-talathi.png" width="70" />
                        <div class="t-a-c" style="text-transform: uppercase;"><b><?php echo get_from_session('name'); ?></b></div>
                        <div class="t-a-c" style="text-transform: uppercase;"><b><?php echo $notice_data['village_name']; ?> SAZA</b></div>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>