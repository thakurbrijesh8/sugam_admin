<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Report</title>
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
            .app-form{
                width: 100%;
                border-collapse: collapse;
            }
            .app-form tr td{
                border: 1px solid black;
                padding: 5px;
            }
            .t-d-w{
                width: 230px;
            }
        </style>
    </head>
    <body>
        <?php
        $taluka_array = $this->config->item('taluka_array');
        $district_text = $taluka_array[$ga_data['district']] ? $taluka_array[$ga_data['district']] : '';
        ?>
        <div style="font-family: arial_unicode_ms;">

            <div style="font-size: 13px;">
                <div class="f-s-title t-a-c l-s"><span class="f-w-b">Application For General Application</span></div>
                <table class="app-form" style="font-size: 13px; margin-top: 10px;">
                    <tr>
                        <td class="f-w-b t-d-w">Application Number</td>
                        <td><?php echo $ga_data['application_number']; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Full Name of Applicant</td>
                        <td><?php echo $ga_data['applicant_name']; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Mobile Number</td>
                        <td><?php echo $ga_data['mobile_number']; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Email Address</td>
                        <td><?php echo $ga_data['email']; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Communication Address</td>
                        <td><?php echo $ga_data['address']; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Purpose</td>
                        <td><?php echo $ga_data['purpose']; ?></td>
                    </tr>
                </table>

                <div style = "margin-top: 20px;">
                    <b style = "font-size: 14px;">Details of Description</b>
                    <table class = "app-form" style = "font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class = "f-w-b t-d-w">Subject</td>
                            <td><?php echo $ga_data['subject']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">District</td>
                            <td style="vertical-align: top;"><?php echo $district_text; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Village</td>
                            <td><?php echo $ga_data['village_name_text']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Details Of Description</td>
                            <td><?php echo $ga_data['description_details']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="f-w-b">I.D. Proof Number (Aadhar/PAN/Other Gov.Id)</td>
                            <td><?php echo $ga_data['id_proof_number']; ?></td>
                        </tr>
                    </table>
                </div>           
            </div>
        </div>
    </body>
</html>
