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
        $applicant_occupation_array = $this->config->item('applicant_occupation_array');
        $profession_array = $this->config->item('profession_array');
        $marital_status_array = $this->config->item('marital_status_array');
        $taluka_array = $this->config->item('taluka_array');
        $taluka_name = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        $year_array = explode('-', $application_year);
        $app_occupation = (isset($applicant_occupation_array[$applicant_occupation]) ? ($applicant_occupation == VALUE_TWELVE ? $applicant_other_occupation : $applicant_occupation_array[$applicant_occupation]) : '-');
        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');
        ?>
        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>
                Son/Daughter of Shri <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                Age <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_age . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                Year, Marital Status :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $marital_status_text . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                Nationality <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_nationality . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                Resident of <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_address . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                <?php echo $taluka_name; ?> of <?php echo $taluka_name; ?> District.
            </div>
            <div class="l-s l-h" style="text-align: justify; text-justify: inter-word; margin-top: 5px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                That my family annual income from all sources was Rs. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . (indian_comma_income($total_income) . '/-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                during the year <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . (($year_array[0] - 1) . '-' . ($year_array[1] - 1)) . '&nbsp;&nbsp;&nbsp;'; ?></span>. 
                That details of my family annual income as are under :- 
            </div>
            <?php $this->load->view('income_certificate/pdf_mi', array('profession_array' => $profession_array, 'app_occupation' => $app_occupation)); ?>
            <div class="l-s l-h" style="margin-top: 10px;">
                That I have neither other except as shown above nor any income from bank interest, etc.
            </div>
            <div class="l-s l-h" style="text-align: justify; text-justify: inter-word;">
                This declaration, I have to submit before the Mamlatdar, <?php $talathi_name; ?> to obtain the Income Certificate for 
                <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $purpose_of_income_certificate . '&nbsp;&nbsp;&nbsp;'; ?></span> purspose.
            </div>
            <div class="l-s f-w-b" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein.
                I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the 
                punishment as per the law and that the benefits availed by me shall be summarily withdrawn.
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian Penal Code which state as follows:-
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                <b>Section 199. False statement made in declaration which is by law receivable as evidence:- </b>
                <div>
                    Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or 
                    any Public Servant or other person, is bound or authorized bylaw to receive as evidence of any fact, 
                    makes any statement which is false, and which he either knows or believes to be false or does not 
                    believe to be true, touching any point material to the object for which the declaration is made or 
                    used, shall be punished in the same manner as if he gave false evidence.
                </div>
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                <b>Section 200. Using as true such declaration knowing it to be false:- </b>
                Whoever corruptly uses or attempts to use as true any such declaration, knowing the 
                same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                <b>Explanation :- </b>
                A declaration which is inadmissible merely upon the ground of some informality, is a declaration within the meaning of Sections 199 and 200.
            </div>
            <table style="margin-top: 10px; width: 100%;">
                <tr>
                    <td style="vertical-align: top; width: 33%;">
                        <b>Place&nbsp; :-</b> <?php echo $taluka_name; ?><br>
                        <b>Dated :-</b> <?php echo $submitted_datetime == '0000-00-00 00:00:00' ? date('d-m-Y') : convert_to_new_date_format($submitted_datetime); ?>
                    </td>
                    <td class="t-a-c" style="width: 25%;">
                        <img src='<?php echo INCOME_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'
                             style="width: 110px; height: 130px; border: 1px solid;" />
                    </td>
                    <td class="t-a-c" style="width: 42%;">
                        <div>
                            This Declaration is electronically generated and no signature is required.
                        </div>
                        <div style="border-bottom: 1px dashed;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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