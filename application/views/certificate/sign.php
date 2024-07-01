<?php if ($district == TALUKA_DAMAN && (($status_datetime != '' && $status_datetime >= MAM_PM_FIRST_SIGN_LDT) || $mtype == VALUE_ONE)) { ?>
    <table style="<?php echo isset($extra_style) ? $extra_style : 'margin-top: 20px;' ?>">
        <tr>
            <?php if (isset($applicant_photo_doc_path)) { ?>
                <td style="width: 33%;">
                    <img src="<?php echo $applicant_photo_doc_path; ?>" height="200px" width="200px">
                </td>
            <?php } ?>
            <td style="vertical-align: bottom;">
                <table style="width: 100%;">
                    <tr>
                        <td style="vertical-align: bottom; text-align: right; <?php echo isset($is_em) ? 'width: 40%;' : 'width: 50%;' ?>">
                            <?php if ($mtype == VALUE_TWO) { ?>
                                <img src="images/mam_daman_stamp.jpg" width="150" />
                            <?php } ?>
                        </td>
                        <td class="f-s-14px" style="vertical-align: bottom; text-align: center; <?php echo isset($is_em) ? 'width: 60%;' : 'width: 50%;' ?> font-weight: bold;">
                            <?php
                            echo ($mam_image != '' && $mtype == VALUE_TWO) ? '<img src="' . $mam_image . '" style="width: 120px;" /><br>' : '';
                            echo $mam_name . '<br>';
                            echo '<span class="f-aum">मामलतदार</span> / Mamlatdar<br>';
                            if (isset($is_em)) {
                                echo '<span class="f-aum">कार्यकारी मजिस्ट्रेट</span> / Executive Magistrate<br>';
                            }
                            echo $mam_district . '<br>';
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php } else { ?>
    <table style="<?php isset($extra_style) ? $extra_style : 'margin-top: 20px;' ?>">
        <tr>
            <?php if (isset($applicant_photo_doc_path)) { ?>
                <td style="width: 30%;">
                    <img src="<?php echo $applicant_photo_doc_path; ?>" height="200px" width="200px">
                </td>
            <?php } ?>
            <td class="f-s-14px" style="vertical-align: bottom; text-align: <?php echo isset($applicant_photo_doc_path) ? 'center' : 'right'; ?>; width: 72%; font-weight: bold; padding-right: 0px;">
                <?php
                if ($district == TALUKA_DAMAN && ($status_datetime != '' && $status_datetime < OLD_MAM_LDT)) {
                    echo ($mam_image != '' && $mtype == VALUE_TWO) ? '<img src="' . OLD_MAM_IP . '" style="width: 480px;" /><br>' : '';
                    echo OLD_MAM_NAME . '<br>';
                } else if ($district == TALUKA_DAMAN && ($status_datetime != '' && $status_datetime > OLD_MAM_LDT && $status_datetime < MAM_PM_FIRST_SIGN_LDT)) {
                    echo ($mam_image != '' && $mtype == VALUE_TWO) ? '<img src="' . MAM_PM_FIRST_SIGN . '" style="width: 120px;" /><br>' : '';
                    echo $mam_name . '<br>';
                } else if ($district == TALUKA_DIU) {
                    echo ($mam_image != '' && $mtype == VALUE_TWO) ? '<img src="' . $mam_image . '" style="width: 230px;" /><br>' : '';
                    echo $mam_name . '<br>';
                } else {
                    echo ($mam_image != '' && $mtype == VALUE_TWO) ? '<img src="' . $mam_image . '" style="width: 120px;" /><br>' : '';
                    echo $mam_name . '<br>';
                }
                echo '<span class="f-aum">मामलतदार</span> / Mamlatdar<br>';
                if (isset($is_em)) {
                    echo '<span class="f-aum">कार्यकारी मजिस्ट्रेट</span> / Executive Magistrate<br>';
                }
                echo $mam_district . '<br>';
                ?>
            </td>
        </tr> 
    </table>
<?php } ?>