<?php
$barcode_number = generate_barcode_number(VALUE_TWENTYSEVEN, $fc_data['form_copy_id']);
$url = 'https://daman.nic.in/sugamverify?sv=' . $barcode_number;
?>
<table class="table-header">
    <tr>
        <td style="vertical-align: bottom;">
            <div class="color-nic-blue footer-title">
                For Fetching this Document on DigiLocker use Following Information
            </div>
            <div class="color-nic-blue footer-title">
                Barcode Number : "<b style="color: black;"><?php echo $barcode_number; ?></b>" and Mobile Number : "<b style="color: black;"><?php echo $sror_data['mobile_number']; ?></b>"
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