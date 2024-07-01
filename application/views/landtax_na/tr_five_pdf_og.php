<?php
$barcode_number = generate_barcode_number(VALUE_TWENTYSEVEN, $payment_data['rlp_land_tax_payment_id']);
$url = 'https://daman.nic.in/sugamverify?sv=' . $barcode_number;
?>
<style type="text/css">
    @page {
        margin: 40px;
    }
    .f-s-18px{
        font-size: 18px;
    }
    .f-s-16px{
        font-size: 16px;
    }
    .f-s-14px{
        font-size: 14px;
    }
    .f-s-12px{
        font-size: 12px;
    }
    .f-aum{
        font-family: arial_unicode_ms;
    }
    table {
        border-collapse: collapse;
        padding: 5px;
        width: 100%;
    }
    .f-w-b{
        font-weight: bold;
    }
    .t-a-c{
        text-align: center;
    }
    .t-a-r{
        text-align: right;
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
    .t-d-u{
        text-decoration: underline;
    }
    .outer-box {
        padding: 18px;
        margin: 18px;
        border: double;
    }
    .color-nic-blue{
        color: #0E4D92;
    }
    .footer-title{
        font-size: 10px;
    }
</style>
<div class="outer-box">
    <div class="f-s-16px t-a-c f-w-b t-d-u">Non - Agriculture Land Tax Receipt of <?php echo $payment_data['village_name']; ?></div><br>   
    <div class="f-s-14px f-w-b">T.R.5</div>
    <div class="f-s-14px">(Treasury Rule 83)</div><br>

    <div class="f-s-16px"><b>Receipt No. :</b> <?php echo $payment_data['application_number'] ?></div>
    <div class="f-s-16pxb"><b>Reference No. :</b> <?php echo $payment_data['reference_id'] . ' / ' . $payment_data['khata_number'] ?></div>

    <?php $optd_text = $payment_data['op_transaction_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_datetime_format($payment_data['op_transaction_datetime']) : ($payment_data['op_start_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_datetime_format($payment_data['op_start_datetime']) : ''); ?>
    <div class="f-s-16px t-a-r" style="margin-top: -43px;"><b>Dated :</b> <?php echo $optd_text; ?></div>


    <div class="l-s l-h" style="text-align:justify; line-height: 25px; margin-top: 40px;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Received from <span class="b-b-1px f-w-b f-aum"><?php echo $payment_data['occupant_details']; ?></span>, 
        the sum of Rupees ₹<span class="b-b-1px f-w-b"><?php echo $payment_data['total_amount']; ?></span>/- 
        on account of Non - Agriculture Land Tax of Survey / Sub Division Number 
        <span class="b-b-1px f-w-b f-aum">
            <?php
            foreach ($payment_ld_data as $index => $pld) {
                echo ($index != 0 ? ', ' : '') . $pld['survey'] . ' / ', $pld['subdiv'];
            }
            ?>
        </span> 
        in the Village <span class="b-b-1px f-w-b f-aum"><?php echo $payment_data['village_name']; ?></span>, 
        Nani Daman / Moti Daman, Daman of District Daman for the year of 
        <span class="b-b-1px f-w-b"><?php echo $payment_data['financial_year']; ?></span>.
    </div>
    <table class="table-header" style="margin-top: 30px;">
        <tr>
            <td style="vertical-align: bottom;">
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
<div class="f-s-12px t-a-c" style="margin-top: 10px;">Note : This receipt is computer generated and does not require the signature</div>
</div>