<div style="position: absolute; bottom: <?php echo ($unused_space) ?>; background: white; font-size: 13px;">
    <table class="table-header" style="border: none;">
        <tr>
            <td style="width: 38%;">
                <table>
                    <tr>
                        <td class="footer-title f-aum" colspan="2">राशि बरामद हुई</td>
                    </tr>
                    <tr>
                        <td class="footer-title" colspan="2">RECOVERED THE AMOUNT OF</td>
                    </tr>
                    <tr>
                        <td class="footer-title f-aum"><span class="f-aum">कॉपी शुल्क</span> / COPYING FEES</td>
                        <td class="footer-title"><b><?php echo ' : Rs.' . ($fof_data['total_amount'] != 0 ? ($fof_data['total_amount'] / $fof_data['total_copies']) : '0') . '/-'; ?></b></td>
                    </tr>
                    <tr>
                        <td class="footer-title f-aum"><span class="f-aum">पेपर शुल्क</span> / PAPER FEES</td>
                        <td class="footer-title"><b><?php echo ' : Rs. -/-'; ?></b></td>
                    </tr>
                    <tr>
                        <td class="footer-title f-aum"><span class="f-aum">कुल</span> / TOTAL</td>
                        <td class="footer-title"><b><?php echo ' : Rs.' . ($fof_data['total_amount'] != 0 ? ($fof_data['total_amount'] / $fof_data['total_copies']) : '0') . '/-'; ?></b></td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: bottom; width: 38%;">
                <table>
                    <tr>
                        <td class="footer-title f-aum"><span class="f-aum">रसीद सं</span> / Invoice No.</td>
                        <td class="footer-title"><b> : <?php echo isset($fof_data['reference_id']) ? $fof_data['reference_id'] : ''; ?></b></td>
                    </tr>
                    <tr>
                        <td class="footer-title f-aum"><span class="f-aum">दि.</span> / Dt.</td>
                        <td class="footer-title"><b> : <?php echo isset($fof_data['op_transaction_datetime']) ? ($fof_data['op_transaction_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_datetime_format($fof_data['op_transaction_datetime']) : '') : ''; ?></b></td>
                    </tr>
                </table>
            </td>
            <td class="t-a-c" style="vertical-align: bottom; width: 24%;">
                <img src="images/<?php echo get_from_session('temp_id_for_sugam_admin') ?>-talathi.png" width="60" /><br>
                <div class="t-a-c footer-title"><b><?php echo $created_by_name; ?></b></div>
                <div class="t-a-c footer-title"><b>TALATHI</b></div>
                <div class="t-a-c footer-title" style="text-transform: uppercase;"><b><?php echo $fof_data['village_name']; ?> SAZA</b></div>
            </td>
        </tr>
    </table>
</div>