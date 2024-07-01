<?php
$barcode_number = generate_barcode_number(VALUE_EIGHTEEN, $marriage_certificate_data['marriage_certificate_id']);
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Marriage Certificate</title>
        <style type="text/css">
            @page {
                margin: 60px;
                margin-top: 40px;
                margin-bottom: 40px;
            }
            body {
                font-family: meiryo;
                font-size: 13.5px;
                width: 100%;
                border: 1px solid red;
                line-height: 17px;
            }
            hr {
                margin-top: 0px;
                margin-bottom: 0px;
                color: black;
            }
            table{
                width: 100%;
            }
            .p-l-5{
                padding-left: 3px;
            }
            .p-r-5{
                padding-right: 5px;
            }
            .p-r-0{
                padding-right: 0px;
            }
            .m-t{
                margin-top: 10px;
            }
            .v-a-b{
                vertical-align: bottom;
            }
            .ff-timesnewroman{
                font-family: timesnewroman;
                font-size: 14px;
                line-height: 14px;
            }
        </style>
    </head>
    <body>
        <?php
            $taluka_array = $this->config->item('taluka_array');
            $taluka_name_text = isset($taluka_array[$marriage_certificate_data['district']]) ? $taluka_array[$marriage_certificate_data['district']] : '-';
        ?>
        <div style="border: 3px solid red; padding: 1px;">
            <div style="border: 1.5px solid red; padding: 8px; height: 100%;">
                <table>
                    <tr><td></td><td rowspan="5" style="vertical-align: bottom;"><img src="images/emblem-dark.png" width="50px"></td></tr>
                    <tr><td></td><td rowspan="5" style="text-align: right; padding-right: 10px;">
                    <!--<barcode code="<?php //echo MARRIAGE_QR_LINK . '?bqer=' . generate_random_string(3) . base64_encode($marriage_certificate_data['access_code']) . generate_random_string(3); ?>" type="QR"/>-->
                    </td></tr>
                    <tr>
                        <td style="height: 25px; font-weight: bold; width: 46%; vertical-align: bottom;">Certificate Outward No.___________</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; vertical-align: bottom;"> Fee Receipt No._________________</td>
                    </tr>
                    <tr><td></td></tr>
                </table>
                <div style="text-align: center; font-weight: bold; margin-top: 30px; font-size: 17px;">Civil Registration Services of Daman and Diu</div>
                <div class="ff-timesnewroman" style="font-size: 15px; margin-top: 25px; margin-left: 140px;"><?php echo $marriage_certificate_data['authorized_person_name']; ?></div>
                <div style="margin-top: -17px; text-align: right; font-style: italic; margin-right: 30px;">Civil Registrar, Daman</div>
                <hr>
                <div style="margin-left: 40px;">(Name and Designation of the issuing authority)</div>
                <div style="margin-top: 30px;">
                    I do hereby certify that on Page No.*
                    <div class="ff-timesnewroman" style="margin-top: -16px; width: 130px; border-bottom: 1px solid black; margin-left: 250px; text-align: center;"><?php echo $marriage_certificate_data['page_no']; ?></div>
                    <div style="margin-top: -18px; margin-left: 385px; padding-right: 5px;">against entry No.*</div>
                    <div class="ff-timesnewroman" style="margin-top: -16px; width: 170px; border-bottom: 1px solid black; margin-left: 510px; text-align: center;"><?php echo $marriage_certificate_data['entry_number']; ?></div>
                </div>
                <?php
                $string_for_registration_year = ucfirst(convert_to_indian_currency($marriage_certificate_data['registration_year']));
                if ($marriage_certificate_data['registration_year']) {
                    $array_for_registration_year = get_exploded_string_in_two_variable($string_for_registration_year, 32);
                } else {
                    $array_for_registration_year['first_string'] = '--------';
                    $array_for_registration_year['second_string'] = '--------';
                }
                ?>
                <div class="m-t">
                    <div>of the Marriage Registration/Transcription Book for the year</div>
                    <div class="p-l-5 ff-timesnewroman" style="margin-top: -16px; width: 250px; border-bottom: 1px solid black; margin-left: 400px;">
                        <?php echo $array_for_registration_year['first_string']; ?>
                    </div>
                </div>
                <?php
                $array_for_applicant_name = get_exploded_string_in_two_variable($marriage_certificate_data['bridegroom_name'], 36);
                ?>
                <div class="m-t">
                    <div class="p-l-5 ff-timesnewroman" style="width: 160px; border-bottom: 1px solid black;"><?php echo $array_for_registration_year['second_string']; ?></div>
                    <div style="margin-top: -18.5px; margin-left: 170px;">is registered the marriage of</div>
                    <div class="p-l-5 ff-timesnewroman" style="margin-top: -16px; width: 310px; border-bottom: 1px solid black; margin-left: 363px;">
                        <?php echo $array_for_applicant_name['first_string']; ?>
                    </div>
                </div>
                <div class="m-t">
                    <div class="p-l-5 ff-timesnewroman" style="width: 100%; border-bottom: 1px solid black;"><?php echo $array_for_applicant_name['second_string']; ?></div>
                </div>
                <table>
                    <tr>
                        <td class="p-l-0" style="width: 55px; height: 30px; vertical-align: bottom;">born at</td>
                        <td class="p-l-5 p-r-5 ff-timesnewroman" style="width: 36%; border-bottom: 1px solid black; vertical-align: bottom;
                        <?php
                        $total_cnt_for_place_of_birth = strlen($marriage_certificate_data['bridegroom_birthplace_village_text']);
                        if ($total_cnt_for_place_of_birth > 29) {
                            echo 'font-size: 10px; line-height: 12px;';
                        }
                        ?>
                            "><?php echo $marriage_certificate_data['bridegroom_birthplace_village_text']; ?></td>
                        <td style="width: 75px; vertical-align: bottom;">residing at</td>
                        <td class="p-l-5 p-r-0 ff-timesnewroman" style="border-bottom: 1px solid black; vertical-align: bottom;
                        <?php
                        $total_cnt_for_address = strlen($marriage_certificate_data['bridegroom_residence']);
                        if ($total_cnt_for_address > 35) {
                            echo 'font-size: 10px; line-height: 12px;';
                        }
                        ?>
                            "><?php echo $marriage_certificate_data['bridegroom_residence']; ?></td>
                    </tr>
                </table>
                <div class="m-t">
                    <div class="v-a-b">Legitimate son of</div>
                    <div class="p-l-5 ff-timesnewroman" style="margin-top: -16px; border-bottom: 1px solid black; margin-left: 120px;">
                        <?php echo $marriage_certificate_data['bridegroom_father_name']; ?>
                    </div>
                </div>
                <div class="m-t">
                    <div class="v-a-b">and of</div>
                    <div class="p-l-5 ff-timesnewroman" style="margin-top: -16px; border-bottom: 1px solid black; margin-left: 45px;">
                        <?php echo $marriage_certificate_data['bridegroom_mother_name']; ?>
                    </div>
                </div>
                <div class="m-t">
                    <div class="v-a-b">Conferred by : to : </div>
                    <div class="p-l-5 ff-timesnewroman" style="margin-top: -16px; border-bottom: 1px solid black; margin-left: 130px;">
                        <?php echo $marriage_certificate_data['bride_name']; ?>
                    </div>
                </div>
                <table class="p-l-0 p-r-0">
                    <tr>
                        <td style="border-bottom: 1px solid black; width: 30%; vertical-align: bottom; text-align: center">------</td>
                        <td style="width: 55px; vertical-align: bottom; height: 30px;">born at</td>
                        <td class="p-l-5 ff-timesnewroman" style="border-bottom: 1px solid black; vertical-align: bottom;
                        <?php
                        $total_cnt_for_c_pob = strlen($marriage_certificate_data['bride_birthplace_village_text']);
                        if ($total_cnt_for_c_pob > 45 && $total_cnt_for_c_pob < 54) {
                            echo 'font-size: 12px; line-height: 12px;';
                        } else if ($total_cnt_for_c_pob > 54) {
                            echo 'font-size: 10px; line-height: 12px;';
                        }
                        ?>
                            ">
                                <?php echo $marriage_certificate_data['bride_birthplace_village_text']; ?>
                        </td>
                        <td class="p-r-0" style="width: 15px; vertical-align: bottom;">and</td>
                    </tr>
                </table>
                <table class="p-l-0 p-r-0">
                    <tr>
                        <td style="width: 75px; vertical-align: bottom; height: 30px;">residing at</td>
                        <td class="p-l-5 p-r-5 ff-timesnewroman" style="width: 40%; border-bottom: 1px solid black; vertical-align: bottom;
                        <?php
                        $total_cnt_for_ca = strlen($marriage_certificate_data['bride_residence']);
                        if ($total_cnt_for_ca > 35) {
                            echo 'font-size: 10px; line-height: 12px;';
                        }
                        ?>
                            ">
                                <?php echo $marriage_certificate_data['bride_residence']; ?>
                        </td>
                        <td style="width: 152px; vertical-align: bottom;">legitimate daughter of</td>
                        <?php
                        $array_for_legitimate_daughter_of = get_exploded_string_in_two_variable($marriage_certificate_data['bride_father_name'], 21);
                        ?>
                        <td class="p-l-5 ff-timesnewroman" style="width: 25%; border-bottom: 1px solid black; vertical-align: bottom;">
                            <?php echo trim($array_for_legitimate_daughter_of['first_string']); ?>
                        </td>
                    </tr>
                </table>
                <table class="p-l-0 p-r-0">
                    <tr>
                        <td class="p-l-5 p-r-5 ff-timesnewroman" style="width: 40%; border-bottom: 1px solid black; vertical-align: bottom;">
                            <?php echo trim($array_for_legitimate_daughter_of['second_string']); ?>
                        </td>
                        <td style="width: 48px; vertical-align: bottom; height: 30px;">and of</td>
                        <?php
                        $array_for_legitimate_daughter_of_and_of = get_exploded_string_in_two_variable($marriage_certificate_data['bride_mother_name'], 48);
                        ?>
                        <td class="p-l-5 p-r-5 ff-timesnewroman" style="border-bottom: 1px solid black; vertical-align: bottom;">
                            <?php echo $array_for_legitimate_daughter_of_and_of['first_string']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-l-5 ff-timesnewroman" colspan="3" style="border-bottom: 1px solid black; height: 30px; vertical-align: bottom;"><?php echo $array_for_legitimate_daughter_of_and_of['second_string']; ?></td>
                    </tr>
                </table>
                <table class="p-l-0 p-r-0">
                    <tr>
                        <td style="width: 100px; vertical-align: bottom; height: 30px;">solemnized on</td>
                        <td class="ff-timesnewroman" style="text-align: center; border-bottom: 1px solid black; vertical-align: bottom;">
                            <?php echo get_day($marriage_certificate_data['declaration_date']); ?>
                        </td>
                        <td style="width: 20px; vertical-align: bottom;">of</td>
                        <td class="ff-timesnewroman" style="width: 200px; text-align: center; border-bottom: 1px solid black; vertical-align: bottom;">
                            <?php echo get_month_name($marriage_certificate_data['declaration_date']); ?> 
                        </td>
                    </tr>
                </table>
                <div class="m-t">
                    <div class="v-a-b">of year </div>
                    <div class="p-l-5 ff-timesnewroman" style="margin-top: -16px; border-bottom: 1px solid black; margin-left: 50px;">
                        <?php echo get_year($marriage_certificate_data['declaration_date']); ?>
                    </div>
                </div>
                <div class="m-t">
                    <div class="v-a-b">in the </div>
                    <div class="p-l-5 ff-timesnewroman" style="margin-top: -16px; border-bottom: 1px solid black; margin-left: 45px;">
                        <?php echo $taluka_name_text; ?>
                    </div>
                </div>
                <div class="m-t">
                    <div class="v-a-b">Paid </div>
                    <div class="p-l-5 ff-timesnewroman" style="margin-top: -16px; border-bottom: 1px solid black; margin-left: 35px;">
                        Fees of Rupees <?php echo ucwords(convert_to_indian_currency($marriage_certificate_data['paid_money'])); ?> Only
                    </div>
                </div>
                <div class="m-t">
                    <div class="v-a-b">Civil Registration Office Daman </div>
                    <div style="margin-top: -16px; border-bottom: 1px solid black; margin-left: 210px;">&nbsp;</div>
                </div>
                <div class="m-t">
                    <div class="v-a-b">Dated of issue : </div>
                    <div style="margin-top: -16px; border-bottom: 1px solid black; margin-left: 110px;">&nbsp;</div>
                </div>
                <table class="p-l-0 p-r-0" style="margin-top: 100px;">
                    <tr>
                        <td style="width: 50%;"></td>
                        <td style="width: 40%; text-align: center; font-weight: bold; font-size: 17px; padding-bottom: 10px; border-bottom: 1px solid black;">The Civil Registrar, Daman</td>
                        <td style="width: 10%;"></td>
                    </tr>
                </table>
                <div style="margin-top: 10px;">
                    * In numerals
                </div>
                <div style="margin-top: 20px;">
                    <barcode code="<?php echo $barcode_number.'841'; ?>" type="EAN13" height="0.50" />
                </div>
            </div>
        </div>
    </body>
</html>