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
        //$profession_array = $this->config->item('profession_array');
        $marital_status_array = $this->config->item('marital_status_array');
        $taluka_array = $this->config->item('taluka_array');
        $taluka_name = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        //$year_array = explode('-', $application_year);
        $app_occupation = (isset($applicant_occupation_array[$applicant_occupation]) ? ($applicant_occupation == VALUE_TWELVE ? $applicant_other_occupation : $applicant_occupation_array[$applicant_occupation]) : '-');
        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');
        $religion_array = $this->config->item('religion_array');
        $religion = isset($religion_array[$religion]) ? $religion_array[$religion] : '';
        $applicant_obccaste_array = $this->config->item('applicant_obc_caste_array');
        $obccaste_text = isset($applicant_obccaste_array[$obccaste]) ? $applicant_obccaste_array[$obccaste] : '';
        ?>
        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I, <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $applicant_name; ?>,&nbsp;&nbsp;</span> 
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        aged about <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $applicant_age; ?>&nbsp;&nbsp;&nbsp;</span><b> years,</b>
                    <?php } else { ?>
                        Major age
                    <?php } ?>
                    Resident at <span class="b-b-1px f-w-b">&nbsp;&nbsp;<?php echo $com_addr_house_no; ?>,&nbsp;&nbsp;
                        <?php echo $com_addr_house_name == '' ? '' : $com_addr_house_name .','; ?>&nbsp;<?php echo $com_addr_street; ?>,
                        <span class="b-b-1px f-w-b"><?php echo $com_addr_village_dmc_ward; ?>, <?php echo $com_addr_city; ?>, 
                            <?php echo $com_pincode; ?></span></span>&nbsp;<?php echo $taluka_name; ?> District of U.T. DNH & Daman & Diu,
                    <?php if ($constitution_artical == VALUE_TWO) { ?>
                        That my minor child <?php echo $minor_child_name; ?>
                    <?php } ?>

                    hereby declare that the above/following information is true to the bet of my knowledge and belief and nothing 
                    has been concealed therein. I am well aware of the face that if the information given by me is proved 
                    false/not true, I will have to face the punishment as per the law and the benefits availed by me shall 
                    be summarily withdrawn.
                    <br>

                    <div class="l-s" style="margin-top: 10px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I have applied to the Mamlatdar, <?php echo $taluka_name; ?>, to issue me a <b> Non Creamy Layer Certificate </b>in respect of 
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        myself
                        <?php }else{ ?>
                            my minor child <?php echo $minor_child_name; ?>
                            <?php } ?>, I hereby declare and state that I am holding an OBC Certificate bearing No. 
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; line-height: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I hereby declared that 
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        I am
                        <?php }else{ ?>
                            my minor child <?php echo $minor_child_name; ?>
                            <?php } ?> belongs to <b> <?php echo $religion; ?><?php echo $other_religion; ?></b><span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $obccaste_text; ?></span>&nbsp;&nbsp;&nbsp;Community which is recognized as an Other Backward Class by the Government of India.
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; line-height: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Further, I sate that this academic year, our annual family income form, all source is Approximately ₹.<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $family_annual_income; ?> only </span>&nbsp;&nbsp;&nbsp;hence, 
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        I do not
                        <?php }else{ ?>
                            my minor child <?php echo $minor_child_name; ?> is not
                            <?php } ?>  belongs to the Creamy Layer.
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; line-height: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This declaration is required to b e submitted to the Mamlatdar, <?php echo $taluka_name; ?> to getting <b> Non Creamy Layer  </b> Renew Certificate in respect of 
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        my Self
                        <?php }else{ ?>
                            my minor child <?php echo $minor_child_name; ?>
                            <?php } ?>.
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; line-height: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that I have read and understood the provision of section 199 and 200 of the Indian Penal Code.
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 5px;">
                        <b>Section 199. False statement made in declaration which is by law receivable as evidence:-  </b>
                        <div>
                            Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or any Public Servant or other person, is bound or authorized bylaw to receive as evidence of any fact, makes any statement which is false, and which he either knows or believes to be false or does not believe to be true, touching any point material to the object for which the declaration is made or used, shall be punished in the same manner as if he gave false evidence.
                        </div>
                    </div>
                    <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px;">
                        <b>Section 200. Using as true such declaration knowing it to be false:- </b>
                        Whoever corruptly uses or attempts to use as true any such declaration, knowing the same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
                    </div>
                    <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px;">
                        <b>Explanation :- </b>
                        A declaration which is inadmissible merely upon the ground of some informality, is a declaration within the meaning of Sections 199 and 200.
                    </div>
                </div>
        </div>
        <table style="margin-top: 10px; width: 100%; font-size: 13px;">
            <tr>
                <td style="vertical-align: top; width: 33%;">
                    <b>Place&nbsp; :-</b> <?php echo $taluka_name; ?><br>
                    <b>Dated :-</b> <?php echo $submitted_datetime == '0000-00-00 00:00:00' ? date('d-m-Y') : convert_to_new_date_format($submitted_datetime); ?>
                </td>
                <td class="t-a-c" style="width: 25%;">
                    <img src='<?php echo NCL_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'
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