<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Report</title>
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
                        <div class="header-title" style="text-align: justify;">U.T. Administration of Dadra & Nagar Haveli and Daman & Diu</div>
                        <div class="header-title" style="text-align: justify;">Office of the Mamlatdar, Dholar, Moti Daman, Daman-396220</div>
                        <div class="header-title" style="text-align: justify;">Talathi of the <?php echo $report_data['village']; ?> - Seza</div>
                        <div class="header-title" style="text-align: justify;">Email : satish83.solanki@gov.in</div>
                    </td>
                    <td style="text-align: right;">
                        <img src="images/ddd.png" style="width: 90px;"> 
                    </td>
                </tr>
            </table>
            <hr>
            <div class="f-s-14px">No.TALATHI/<?php echo $report_data['village']; ?>/GENERAL/	
                <div class="m-t-read" style="text-align: right;">Dated : <?php echo date("d-m-Y"); ?></div>
            </div>
            <hr>

            <div class="f-s-14px">To :</div>
            <div class="f-s-14px">The Mamlatdar,</div>
            <div class="f-s-14px">Mamlatdar Office,</div>
            <div class="f-s-14px">Daman</div>
            <br/>
            <div class="f-s-14px f-w-b">Subject : <?php echo $report_data['subject']; ?></div>
            <br/>
            <div class="f-s-14px">Sir,</div>
            <div class="f-s-14px f-aum" style="margin-bottom: 10px;word-spacing: 8px;line-height: 20px;
                 text-align: justify; text-justify: inter-word;"><?php echo $report_data['report']; ?></div>
            <br/>
            <table class="table-header" style="border: none;">
                <tr>
                    <td style="width: 38%;">
                        <table>
                            <tr>
                                <td class="footer-title f-s-14px " colspan="2">Encl :- As above.</td>
                            </tr>
                        </table>
                    </td>
                    <td class="t-a-c" style="vertical-align: bottom; width: 24%;">
                        <img src="images/<?php echo $report_data['forwarded_by']; ?>-talathi.png" width="60" /><br>
                        <div class="t-a-c footer-title"><b><?php echo $report_data['created_by_name']; ?></b></div>
                        <div class="t-a-c footer-title"><b>Talathi</b></div>
                        <div class="t-a-c footer-title" style="text-transform: uppercase;"><b><?php echo $report_data['village']; ?> - Seza</b></div>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>

