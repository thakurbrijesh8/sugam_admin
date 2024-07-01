<?php
$barcode_number = generate_barcode_number(VALUE_THIRTEEN, $fc_data['form_copy_id']);
$url = 'https://daman.nic.in/sugamverify?sv=' . $barcode_number;
?>
<table class="table-header" style="border: none;">
    <tr>
        <td style="width: 35%;">
            <table>
                <tr>
                    <td class="footer-title f-aum" colspan="2">राशि बरामद हुई</td>
                </tr>
                <tr>
                    <td class="footer-title" colspan="2">RECOVERED THE AMOUNT OF</td>
                </tr>
                <tr>
                    <td class="footer-title f-aum"><span class="f-aum">कॉपी शुल्क</span> / COPYING FEES</td>
                    <td class="footer-title"><b><?php echo ' : Rs.' . $fof_data['total_amount'] / $fof_data['total_copies'] . '/-'; ?></b></td>
                </tr>
                <tr>
                    <td class="footer-title f-aum"><span class="f-aum">पेपर शुल्क</span> / PAPER FEES</td>
                    <td class="footer-title"><b><?php echo ' : Rs. -/-'; ?></b></td>
                </tr>
                <tr>
                    <td class="footer-title f-aum"><span class="f-aum">कुल</span> / TOTAL</td>
                    <td class="footer-title"><b><?php echo ' : Rs.' . $fof_data['total_amount'] / $fof_data['total_copies'] . '/-'; ?></b></td>
                </tr>
            </table>
        </td>
        <td style="vertical-align: bottom; width: 35%;">
            <table>
                <tr>
                    <td class="footer-title f-aum"><span class="f-aum">रसीद सं</span> / Invoice No.</td>
                    <td class="footer-title"><b> : <?php echo $fof_data['reference_id']; ?></b></td>
                </tr>
                <tr>
                    <td class="footer-title f-aum"><span class="f-aum">दि.</span> / Dt.</td>
                    <td class="footer-title"><b> : <?php echo $fc_data['created_time'] != '0000-00-00 00:00:00' ? convert_to_new_datetime_format($fc_data['created_time']) : ''; ?></b></td>
                </tr>
            </table>
        </td>
        <td class="t-a-c" style="vertical-align: bottom; width: 30%;">
            <img src="images/<?php echo get_from_session('temp_id_for_sugam_admin') ?>-talathi.png" width="65" /><br>
            <div class="t-a-c footer-title" style="text-transform: uppercase;"><b><?php echo get_from_session('name'); ?></b></div>
            <div class="t-a-c footer-title" style="text-transform: uppercase;"><b><?php echo $fof_data['village_name']; ?> SAZA</b></div>
        </td>
    </tr>
</table>
<table class="table-header">
    <tr>
        <td style="vertical-align: bottom;">
            <div class="color-nic-blue footer-title">
                For Fetching this Document on DigiLocker use Following Information
            </div>
            <div class="color-nic-blue footer-title">
                Barcode Number : "<b style="color: black;"><?php echo $barcode_number; ?></b>" and Mobile Number : "<b style="color: black;"><?php echo $fof_data['mobile_number']; ?></b>"
            </div>
            <br>
            <div class="color-nic-blue footer-title">
                For Authenticity Verification of this Document.
            </div>
            <div class="color-nic-blue footer-title">
                Scan QR or Enter Barcode at https://daman.nic.in/sugamverify or
            </div>
            <div class="color-nic-blue footer-title">
                Visit <?php echo $url; ?>
            </div>
        </td>
        <td style="width: 50px;">
    <barcode disableborder="1" code="<?php echo $url; ?>" type="QR" size="0.7"/>
</td>
<td style="width: 100px;">
    <table style="width: 100%;">
        <tr>
            <td style="padding-left: 14px;">
                <img src="images/nic-logo-new.png" style="height: 20px;"> 
            </td>
        </tr>
        <tr>
            <td>
        <barcode code="<?php echo $barcode_number; ?>" type="I25" size="0.9" height="0.6"/>
</td>
</tr>
<tr>
    <td class="t-a-c footer-title">
        <div style="letter-spacing: 5px;"><?php echo $barcode_number; ?></div>
    </td>
</tr>
</table>
</td>
</tr>
</table>