<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Report</title>
        <style type="text/css">
            .f-s-14px{
                font-size: 14px;
            }
            .f-s-12px{
                font-size: 12px;
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
            body {
                font-family: serif;
                font-size: 14px;
            }
            .page-border{
                border: 2px solid red;
                padding: 10px;
                height: 100%;
            }
            .table-header {
                width: 100%;
            }
            .header-title {
                font-weight: bold;
                font-size: 14px;
            }
            .f-w-b{
                font-weight: bold;
            }
            .color-nic-blue{
                color: #0E4D92;
            }
            .footer-title{
                font-size: 10px;
            }
            .t-a-c{
                text-align: center;
            }
            .t-a-r{
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="">
            <table class="table-header">
                <tr>
                    <td style="width: 60px;">
                        <img src="images/ddd.png" style="width: 90px;"> 
                    </td>
                    <td style="vertical-align: top;text-align: center;" >
                        <div class="header-title" style="text-align: justify;"><img src="images/emblem-dark.png" style="width: 30px;"> </div>
                        <div class="header-title f-aum" style="text-align: justify;">संध प्रशासन / U.T. Administration</div>
                        <div class="header-title f-aum" style="text-align: justify;">दादरा एवं नगर हवेली और दमण एवं दीव</div>
                        <div class="header-title" style="text-align: justify;">Dadra & Nagar Haveli and Daman & Diu</div>
                        <div class="header-title" style="text-align: justify;">Office of the Mamlatdar & Executive Magistrate,</div>
                        <div class="header-title f-aum" style="text-align: justify;">मामलतदार एवं कार्यपालक मजिस्ट्रेट का कार्यालय</div>
                        <div class="header-title f-aum" style="text-align: justify;"> दमन / Daman</div>
                        <div class="header-title f-aum" style="margin-top: -10px">ईमेल / e-Mail - mdar-dmn-dd@nic.in - दुरभाष / Telephone : 0260 2230861</div>
                    </td>
                    <td style="text-align: right;">
                        <img src="images/ddd.png" style="width: 90px;"> 
                    </td>
                </tr>
            </table>
            <hr>
            <div class="f-s-14px f-aum">सं. / No. MAM/DMN/EST/<?php echo $report_data['application_year']; ?>/	
                <div class="m-t-read f-aum" style="text-align: right;">तिथि / Dated : <?php echo date("d-m-Y"); ?></div>
            </div>
            <hr>

            <div class="f-s-14px"><?php echo nl2br($report_data['authority']); ?></div>
            <br/>
            <div class="f-s-14px" style="margin-left:50px;">Sub. : <?php echo $report_data['subject']; ?></div>
            <div class="f-s-14px" style="margin-left:50px;">Ref. : <?php echo $report_data['reference']; ?></div>
            <br/>
            <div class="f-s-14px">Sir,</div>
            <div class="f-s-14px f-aum" style="margin-bottom: 10px;word-spacing: 8px;line-height: 20px;
                 text-align: justify; text-justify: inter-word;"><?php echo $report_data['report']; ?></div>
            <br/>
            <table class="table-header" style="border: none;">
                <tr>
<!--                    <td style="width: 38%;">
                        <table>
                            <tr>
                                <td class="footer-title f-s-14px " colspan="2">Encl :- As above.</td>
                            </tr>
                        </table>
                    </td>-->
                    <td class="t-a-c" style="vertical-align: bottom; width: 24%;text-align: right;">
                        <img src="images/<?php echo $report_data['forwarded_by']; ?>-talathi.png" width="60" /><br>
                        <div class="t-a-c footer-title" style="text-align: justify;"><b></b></div>
                        <div class="t-a-c footer-title f-aum" style="text-align: justify;"><b>मामलतदार / Mamlatdar</b></div>
                        <div class="t-a-c footer-title f-aum" style="text-transform: uppercase;text-align: justify;"><b>दमन / Daman</b></div>
                    </td>
                </tr>
            </table>
            <div class="f-s-14px">Copy to</div>
            <div class="f-s-14px"><?php echo $report_data['copy_to']; ?></div>
        </div>
    </body>
</html>

