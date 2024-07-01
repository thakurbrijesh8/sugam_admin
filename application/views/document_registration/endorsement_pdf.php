<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Endorsement Details</title>
        <style type="text/css">
            @page {
                margin: 40px;
            }
            body {
                font-family: arial_unicode_ms;
                font-size: 12px;
            }
            .page-border{
                padding: 10px;
                height: 100%;
            }
            .f-w-b{
                font-weight: bold;
            }
            .color-nic-blue{
                color: #0E4D92;
            }
            .t-a-c{
                text-align: center;
            }
            .t-a-r{
                text-align: right;
            }
            .v-a-t{
                vertical-align: top;
            }
            .b-table tr td{
                border: 1px solid black;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <?php
        $taluka_array = $this->config->item('taluka_array');
        $sub_registrar_array = $this->config->item('sub_registrar_array');
        $party_description_array = $this->config->item('party_description_array');
        $dr_occupation_array = $this->config->item('dr_occupation_array');
        $taluka_name = isset($taluka_array[$dr_data['district']]) ? strtoupper($taluka_array[$dr_data['district']]) : '';
        $pp_photo = $dr_data['party_photo'] ? ('documents/document_registration/' . $dr_data['party_photo']) : IMAGE_NA_PATH;
        $pp_thumb = $dr_data['party_thumb'] ? ('documents/document_registration/' . $dr_data['party_thumb']) : THUMB_NA_PATH;

        $subr_name = get_sub_registrar_name($sub_registrar_array, $dr_data);
        ?>
        <div class="page-border">
            <div style="margin-top: 10px; <?php echo $page_size == 'A4' ? 'height: 79.8%' : ($page_size == 'Legal' ? 'height: 83.2%' : ''); ?>">
                <table class="b-table" style="margin-left: 50%; margin-top: 10px; width: 100%; border-collapse: collapse;">
                    <tr>
                        <td class="t-a-c f-w-b" colspan="2"><?php echo $taluka_name; ?></td>
                    </tr>
                    <tr>
                        <td class="t-a-c f-w-b" style="width: 50%;"><?php echo $dr_data['temp_application_number']; ?></td>
                        <td class="t-a-c f-w-b"><?php echo $dr_data['application_year']; ?></td>
                    </tr>
                </table>
                <table class="b-table" style="margin-top: 10px; width: 100%; border-collapse: collapse;">
                    <tr>
                        <td class="v-a-t" style="width: 50%; height:260px; padding-top: 10px; border-left: 0px; line-height: 20px;">
                            <div>Presented at the Office of the Sub-Registrar of</div>
                            <div class="f-w-b"><?php echo $taluka_name; ?></div>
                            <div>In the Hour of <b><?php echo convert_to_ampm_time_format($dr_data['party_photo_datetime']); ?></b> on <b><?php echo convert_to_new_date_format($dr_data['party_photo_datetime'], '/'); ?></b></div>
                            <div>
                                <img src="<?php echo $pp_photo; ?>" height="80px" style="padding-top: 15px; padding-left: 60px;" />
                                <img src="<?php echo $pp_thumb; ?>" height="80px" style="padding-top: 15px; padding-left: 10px;" />
                            </div>
                            <hr>
                            <table style="width: 100%; padding-top: -5px;">
                                <tr>
                                    <td class="t-a-c v-a-t" style="border: 0px; line-height: 15px;"><?php echo $dr_data['party_name']; ?></td>
                                </tr>
                                <tr>
                                    <td class="t-a-c v-a-t" style="border: 0px; line-height: 15px;">
                                        <?php echo $dr_data['party_address'] . ', ' . $dr_data['party_district_name'] . ', ' . $dr_data['party_state_name'] . ', ' . $dr_data['party_pincode']; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="v-a-t" style="border-right: 0px; padding-top: 10px;">
                            <div>Receipt No. : <b><?php echo $dr_data['fee_receipt_number']; ?></b></div>
                            <table class="b-table" style="margin-top: 10px; width: 100%; border-collapse: collapse;">
                                <?php
                                $total_fees = 0;
                                $temp_cnt = 1;
                                foreach ($fees_details as $index => $fd) {
                                    if ($fd['fee'] != 0) {
                                        $total_fees += $fd['fee'];
                                        ?>
                                        <tr>
                                            <td><?php echo $fd['fee_description']; ?></td>
                                            <td class="f-w-b t-a-r" style="width: 25%;"><?php echo $fd['fee']; ?> /-</td>
                                        </tr>
                                        <?php
                                        $temp_cnt++;
                                    }
                                }
                                ?>
                                <tr>
                                    <td class="f-w-b t-a-r">Total Amount : </td>
                                    <td class="f-w-b t-a-r"><?php echo $total_fees; ?> /-</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="t-a-c" style="border-left: 0px; padding-top: 25px;">
                            <div><?php echo $subr_name; ?></div>
                            <div>SUB REGISTRAR</div>
                            <div style="text-transform: uppercase;"><?php echo $taluka_name; ?></div>
                        </td>
                        <td class="t-a-c" style="border-right: 0px; padding-top: 30px;">
                            <div><?php echo $subr_name; ?></div>
                            <div>SUB REGISTRAR</div>
                            <div style="text-transform: uppercase;"><?php echo $taluka_name; ?></div>
                        </td>
                    </tr>
                </table>
                <table class="b-table" style="margin-top: 20px; width: 100%; border-collapse: collapse;">
                    <tr>
                        <td class="t-a-c f-w-b" style="width: 50px;">Sr. No.</td>
                        <td class="f-w-b">Party Name</td>
                        <td class="t-a-c f-w-b" style="width: 120px;">Photograph</td>
                        <td class="t-a-c f-w-b" style="width: 115px;">Thumb Impression</td>
                        <td class="t-a-c f-w-b" style="width: 130px;">Signature</td>
                    </tr>
                    <?php
                    $page_break = VALUE_FIVE;
                    $apd_cnt = 0;
                    foreach ($party_details as $index => $pd) {
                        $apd_cnt++;
                        if ($apd_cnt == $page_break) {
                            echo '</table><pagebreak></pagebreak><table class="b-table" style="margin-top: 20px; width: 100%; border-collapse: collapse;">';
                        }
                        $app_photo = $pd['party_photo'] ? ('documents/document_registration/' . $pd['party_photo']) : IMAGE_NA_PATH;
                        $app_thumb = $pd['party_thumb'] ? ('documents/document_registration/' . $pd['party_thumb']) : THUMB_NA_PATH;
                        ?>
                        <tr>
                            <td class="t-a-c f-w-b v-a-t" style="width: 50px;"><?php echo $apd_cnt; ?></td>
                            <td class="v-a-t" style="font-size: 11px;">
                                <?php
                                echo $pd['party_name'] . ' ' . (isset($party_description_array[$pd['party_description']]) ? $party_description_array[$pd['party_description']] : '')
                                . (($pd["party_birth_type"] == VALUE_ONE || $pd["party_birth_type"] == VALUE_THREE) ? ' Age ' . ($pd["party_birth_type"] == VALUE_ONE ? calculate_age($pd["party_dob"]) : $pd["party_age"] ) . ' Years' : '')
                                . ' Occupation ' . (isset($dr_occupation_array[$pd['party_occupation']]) ? $dr_occupation_array[$pd['party_occupation']] : '')
                                . ' Resident at ' . $pd['party_address'] . ' ' . $pd['party_district_name'] . ' ' . $pd['party_state_name']
                                . ' - ' . $pd['party_pincode']
                                . ' The Executant(S) Admin Execution';
                                ?></td>
                            <td class="t-a-c v-a-t" style="width: 120px;"><img src="<?php echo $app_photo; ?>" height="80px" /></td>
                            <td class="t-a-c v-a-t" style="width: 115px;"><img src="<?php echo $app_thumb; ?>" height="80px" /></td>
                            <td style="width: 130px;"></td>
                        </tr>
                    <?php } ?>
                </table>
                <table class="b-table" style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 33%; border: 0px;"></td>
                        <td class="t-a-c">
                            <?php echo $subr_name; ?>
                        </td>
                        <td style="width: 33%; border: 0px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 33%; border: 0px;"></td>
                        <td class="t-a-c">SUB REGISTRAR</td>
                        <td style="width: 33%; border: 0px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 33%; border: 0px;"></td>
                        <td class="t-a-c">
                            <div style="text-transform: uppercase;"><?php echo $taluka_name; ?></div>
                        </td>
                        <td style="width: 33%; border: 0px;"></td>
                    </tr>
                </table>
                <?php
                if ($apd_cnt < $page_break) {
                    echo '<pagebreak></pagebreak>';
                }
                ?>
                <table class="b-table" style="margin-top: 10px; width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 20%; border: 0px;"></td>
                        <td class="v-a-t" style="height:100px; padding-top: 10px; line-height: 20px;">
                            <table class="b-table" style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="width: 10%; border: 0px;"></td>
                                    <td>Registered Number</td>
                                    <td class="t-a-c f-w-b"><?php echo $dr_data['application_number']; ?></td>
                                    <td class="t-a-c">At Page</td>
                                    <td style="width: 10%; border: 0px;"></td>
                                </tr>
                                <tr>
                                    <td style="border: 0px;"></td>
                                    <td colspan="2">Volume of Book No.</td>
                                    <td class="t-a-c"></td>
                                    <td style="width: 10%; border: 0px;"></td>
                                </tr>
                                <tr>
                                    <td style="border: 0px;"></td>
                                    <td>Date</td>
                                    <td class="t-a-c"><?php echo convert_to_new_date_format($dr_data['status_datetime'], '/'); ?></td>
                                    <td class="t-a-c"></td>
                                    <td style="width: 10%; border: 0px;"></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 20%; border: 0px;"></td>
                    </tr>
                    <tr>
                        <td style="border: 0px;"></td>
                        <td class="t-a-c" style="height:100px; padding-top: 10px; vertical-align: bottom;">
                            <div><?php echo $subr_name; ?></div>
                            <div>SUB REGISTRAR</div>
                            <div style="text-transform: uppercase;"><?php echo $taluka_name; ?></div>
                        </td>
                        <td style="border: 0px;"></td>
                    </tr>
                </table>
                <table class="b-table" style="margin-top: 50px; width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 20%; border: 0px;"></td>
                        <td colspan="2">Verified PAN No/GIR No as per Income Tax Rules 1962.</td>
                        <td style="width: 20%; border: 0px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 20%; border: 0px;"></td>
                        <td style="width: 120px;">Executant No.</td>
                        <td></td>
                        <td style="width: 20%; border: 0px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 20%; border: 0px;"></td>
                        <td style="width: 120px;">Claimant No.</td>
                        <td></td>
                        <td style="width: 20%; border: 0px;"></td>
                    </tr>
                    <tr>
                        <td style="width: 20%; border: 0px;"></td>
                        <td style="width: 120px;">Confirmer No.</td>
                        <td></td>
                        <td style="width: 20%; border: 0px;"></td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>