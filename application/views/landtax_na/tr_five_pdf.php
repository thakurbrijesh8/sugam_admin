<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Land Revenue Receipt</title>
        <?php
        $barcode_number = generate_barcode_number(VALUE_TWENTYSEVEN, $payment_data['rlp_land_tax_payment_id']);
        $url = 'https://daman.nic.in/sugamverify?sv=' . $barcode_number;

        $taluka_array = $this->config->item('taluka_array');
        $taluka_name = isset($taluka_array[$payment_data['district']]) ? $taluka_array[$payment_data['district']] : '';
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
            .table-header {
                border-collapse: collapse;
                padding: 5px;
                width: 100%;
            }
            .header-title {
                font-weight: bold;
                font-size: 16px;
            }
            .table-border, .table-border tr, .table-border td {
                border: 1px solid black;
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
    </head>
    <body>
        <div class="outer-box">
            <table class="table-header">
                <tr>
                    <td style="width: 60px;">
                        <img src="images/emblem-dark.png" style="width: 50px;"> 
                    </td>
                    <td style="vertical-align: top;">
                        <div class="header-title">U.T. Administration of</div>
                        <div class="header-title">Dadra & Nagar Haveli and Daman & Diu</div>
                        <div class="header-title"><?php echo 'Office of the Mamlatdar'; ?></div>
                        <div class="header-title"><?php echo isset($taluka_name) ? $taluka_name : ''; ?></div>
                    </td>
                    <td style="text-align: right;">
                        <img src="images/ddd.png" style="width: 90px;"> 
                    </td>
                </tr>
            </table>
            <hr style="color: black;">
            <div class="f-s-16px t-a-c f-w-b t-d-u">Land Revenue Receipt</div><br>   
            <div class="f-s-14px f-w-b">T.R.5</div>
            <div class="f-s-14px">(Treasury Rule 83)</div><br>

            <?php $optd_text = $payment_data['op_transaction_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_datetime_format($payment_data['op_transaction_datetime']) : ($payment_data['op_start_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_datetime_format($payment_data['op_start_datetime']) : ''); ?>
            <div class="f-s-16px" style="margin-left: 65%;"><b>Dated :</b> <?php echo $optd_text; ?></div>

            <div class="f-s-16px" style="margin-top: -20px; margin-bottom: 2px;"><b>Receipt No. :</b> <?php echo $payment_data['application_number']; ?></div>
            <div class="f-s-16px"><b>Reference No. :</b> <?php echo $payment_data['khata_number']; ?></div>
            <div class="f-s-16px"><b>Tran. Ref. No. :</b> <?php echo $payment_data['reference_id']; ?></div>

            <div class="l-s l-h" style="text-align:justify; line-height: 25px; margin-top: 20px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Received from <span class="b-b-1px f-w-b f-aum"><?php echo $payment_data['occupant_details']; ?></span>, 
                the sum of <span class="b-b-1px f-w-b"><?php echo '₹' . $payment_data['total_amount'] . '/- (' . (convert_to_indian_currency($payment_data['total_amount'])) . ')'; ?></span>
                on account of <span class="b-b-1px f-w-b">Non - Agriculture</span> Land Revenue 
                for the year <span class="b-b-1px f-w-b"><?php echo $payment_data['financial_year']; ?></span>.
            </div>
            <table class="table-header table-border f-s-12px" style="margin-top: 28px;">
                <tr>
                    <td class="t-a-c f-w-b" style="width: 50px;">Sr. No</td>
                    <td class="t-a-c f-w-b" style="width: 100px;">Village</td>
                    <td class="t-a-c f-w-b" style="width: 100px;">Survey Number</td>
                    <td class="t-a-c f-w-b" style="width: 100px;">Sub Division Number</td>
                    <td class="t-a-c f-w-b" style="width: 100px;">Amount</td>
                </tr>
                <?php
                foreach ($payment_ld_data as $index => $pld) {
                    echo ($index != 0 ? ', ' : '') . $pld['survey'] . ' / ', $pld['subdiv'];
                    ?>
                    <tr>
                        <td class="t-a-c"><?php echo $index + 1; ?></td>
                        <td class="f-aum t-a-c"><?php echo $payment_data['village_name']; ?></td>
                        <td class="f-aum t-a-c"><?php echo $pld['survey']; ?></td>
                        <td class="f-aum t-a-c"><?php echo $pld['subdiv']; ?></td>
                        <td class="t-a-r"><?php echo $pld['ld_tax_payment']; ?>/-</td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="t-a-r f-w-b" colspan="4" style="padding-right: 5px;">Grand Total</td>
                    <td class="t-a-r f-w-b"><?php echo $payment_data['total_amount']; ?>/-</td>
                </tr>
            </table>
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
                    <table class="table-header" style="width: 100%;">
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
<div class="f-s-12px" style="margin-top: 10px;">Note : This receipt is computer generated and does not require the signature and stamp.</div>
</div>
</body>
</html>