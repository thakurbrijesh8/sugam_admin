<b style="font-size: 14px;">Immovable Property Details</b>
<?php $im_cnt = 1; ?>
<table class="monthly-income" style="font-size: 13px; margin-top: 5px;">
    <tr>
        <td class="f-w-b t-a-c" style="width: 60px;">Sr. No</td>
        <td class="f-w-b t-a-c">Type of Immovable Property</td>
        <td class="f-w-b t-a-c">Description</td>
        <td class="f-w-b t-a-c" style="width: 130px;">Yearly Income</td>
    </tr>
    <?php
    $temp_property_details = json_decode($property_details, true);
    foreach ($temp_property_details as $pd) {
        $temp_pt = isset($pd['property_type']) ? $pd['property_type'] : VALUE_ZERO;
        $temp_opt = isset($pd['other_property_type']) ? $pd['other_property_type'] : '';
        ?>
        <tr>
            <td class="t-a-c"><?php echo $im_cnt; ?></td>
            <td><?php echo isset($property_type_array[$temp_pt]) ? ($temp_pt == VALUE_THREE ? $temp_opt : $property_type_array[$temp_pt]) : ''; ?></td>
            <td><?php echo isset($pd['description_of_property']) ? $pd['description_of_property'] : ''; ?></td>
            <td style="text-align: right;"><?php echo (isset($pd['income_of_property']) ? indian_comma_income($pd['income_of_property']) : '') . '/-'; ?></td>
        </tr>
        <?php
        $im_cnt++;
    }
    ?>
</table>