<?php
$taluka_array = $this->config->item('taluka_array');
$sub_registrar_array = $this->config->item('sub_registrar_array');
$taluka_name = isset($taluka_array[$dr_data['district']]) ? $taluka_array[$dr_data['district']] : '';

$header_array = array();
$header_array['title'] = 'Fee Receipt';
$header_array['department_name'] = 'Office of the Civil Registrar Cum Sub-Registrar';
$header_array['district'] = $taluka_name;
//Ex.  A4, Legal
$header_array['page_size'] = 'A4';
$this->load->view('certificate/header', $header_array);

$doc_type_array = $this->config->item('doc_type_array');
$party_category_array = $this->config->item('party_category_array');

$subr_name = get_sub_registrar_name($sub_registrar_array, $dr_data);
?>
<style type="text/css">
    .f-aum{
        font-family: arial_unicode_ms;
    }
    .v-a-t{
        vertical-align: top;
    }
    .b-table tr td{
        border: 1px solid black;
        padding: 3px;
    }
</style>
<div style="font-size: 30px; text-align: center; margin-top: 10px;font-weight: bold;"><u>FORM "T"</u></div>
<br/>
<table style="margin-top: 20px; width: 100%;">
    <tr>
        <td style="width: 33%;">Receipt No. : <b><?php echo $dr_data['fee_receipt_number']; ?></b></td>
        <td>Temp App. No. : <b><?php echo $dr_data['temp_application_number']; ?></b></td>
        <td>Receipt Date : <b><?php echo (new DateTime($dr_data['fee_receipt_datetime']))->format("d-F-Y"); ?></b>
        </td>
    </tr>
</table>
<table style="margin-top: 10px;">
    <tr>
        <td class="v-a-t">Nature of Document</td>
        <td class="v-a-t">&nbsp;:&nbsp;</td>
        <td class="f-w-b v-a-t" style="height: 30px;"><?php echo isset($doc_type_array[$dr_data['doc_type']]) ? $doc_type_array[$dr_data['doc_type']] : ''; ?></td>
    </tr>
    <tr>
        <td class="v-a-t">By Whom Presented</td>
        <td class="v-a-t">&nbsp;:&nbsp;</td>
        <td class="f-w-b v-a-t" style="height: 30px;"><?php echo (isset($party_category_array[$dr_data['party_category']]) ? ' (' . $party_category_array[$dr_data['party_category']] . ')' : '') . $dr_data['party_name']; ?></td>
    </tr>
    <tr>
        <td>Received Fees as Follows</td>
        <td colspan="2">&nbsp;:&nbsp;</td>
    </tr>
</table>
<div style="height: 570px;">
    <table class="b-table" style="margin-top: 10px; width: 100%; border-collapse: collapse;">
        <tr>
            <td class="t-a-c f-w-b" style="width: 10%;">Sr. No.</td>
            <td class="f-w-b">Description</td>
            <td class="t-a-c f-w-b" style="width: 15%;">Rs.</td>
        </tr>
        <?php
        $total_fees = 0;
        $temp_cnt = 1;
        $total_cnt = 12;
        foreach ($fees_details as $index => $fd) {
            $total_fees += $fd['fee'];
            ?>
            <tr>
                <td class="t-a-c f-w-b"><?php echo $temp_cnt; ?></td>
                <td><?php echo $fd['fee_description']; ?></td>
                <td class="f-w-b t-a-r"><?php echo $fd['fee']; ?> /-</td>
            </tr>
            <?php
            $temp_cnt++;
        }
        if ($temp_cnt <= $total_cnt) {
            for ($x = $temp_cnt; $x <= $total_cnt; $x++) {
                ?>
                <tr>
                    <td class="t-a-c">-</td>
                    <td class="t-a-c">
                        ------------ ------------ ------------ ------------ ------------ ------------ ------------ ------------ ------------
                    </td>
                    <td class="t-a-c">-</td>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td class="f-w-b t-a-r" colspan="2">Total Fees : </td>
            <td class="f-w-b t-a-r"><?php echo $total_fees; ?> /-</td>
        </tr>
    </table>
    <table style="margin-top: 15px;">
        <tr>
            <td>Total Amounts in Words :</td>
        </tr>
        <tr>
            <td class="f-w-b">
                <div style="border-bottom: 1px solid black;">
                    <?php echo convert_to_indian_currency($total_fees); ?> /-
                </div>
            </td>
        </tr>
    </table>
    <table style="margin-top: 15px;">
        <tr>
            <td>The Document will be ready on</td>
            <td style="width: 150px;"></td>
            <td>and will be delivered at this office to</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Document will be sent by registered post</td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="f-w-b" style="line-height: 20px;">
                <div style="border-bottom: 1px solid black;">
                    <?php echo $dr_data['party_address']; ?>
                </div>
            </td>
        </tr>
    </table>
</div>
<table style="margin-top: 15px;">
    <tr>
        <td style="width: 50%;">
            Please send the document by registered post hand it over to the person named below
            <br>
            <br>
            <br>
            Presenter ____________________________
        </td>
        <td class="t-a-c" style="vertical-align: bottom;">
            <div><?php echo $subr_name; ?></div>
            <div>SUB REGISTRAR</div>
            <div style="text-transform: uppercase;"><?php echo $taluka_name; ?></div>
        </td>
    </tr>
</table>
<div class="t-a-r" style="margin-top: 30px;">Print Date & Time : <b><?php echo date('d-F-Y H:i:s'); ?></b></div>
</div>
</div>
</body>
</html>