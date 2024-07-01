<b style="font-size: 14px;">Other Source of Income Details</b>
<?php $osi_cnt = 1; ?>
<table class="monthly-income" style="font-size: 13px; margin-top: 5px;">
    <tr>
        <td class="f-w-b t-a-c" style="width: 60px;">Sr. No</td>
        <td class="f-w-b t-a-c">Source of Income</td>
        <td class="f-w-b t-a-c">Description</td>
        <td class="f-w-b t-a-c" style="width: 130px;">Yearly Income</td>
    </tr>
    <?php
    $temp_oi_details = json_decode($other_income_details, true);
    foreach ($temp_oi_details as $oid) {
        $temp_si = isset($oid['source_of_income']) ? $oid['source_of_income'] : VALUE_ZERO;
        $temp_osi = isset($oid['other_income_source']) ? $oid['other_income_source'] : '';
        ?>
        <tr>
            <td class="t-a-c"><?php echo $osi_cnt; ?></td>
            <td><?php echo isset($source_of_income_array[$temp_si]) ? ($temp_si == VALUE_TWO ? $temp_osi : $source_of_income_array[$temp_si]) : ''; ?></td>
            <td><?php echo isset($oid['description_of_source_of_property']) ? $oid['description_of_source_of_property'] : ''; ?></td>
            <td style="text-align: right;"><?php echo (isset($oid['amount_of_income']) ? indian_comma_income($oid['amount_of_income']) : '') . '/-'; ?></td>
        </tr>
        <?php
        $osi_cnt++;
    }
    ?>
</table>