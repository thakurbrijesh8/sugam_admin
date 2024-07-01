<?php $efm_cnt = 1; ?>
<table class="monthly-income" style="font-size: 13px; margin-top: 5px;">
    <tr>
        <td class="f-w-b t-a-c" style="width: 30px;">Sr. No</td>
        <td class="f-w-b t-a-c">Details of family members Name</td>
        <td class="f-w-b t-a-c" style="width: 40px;">Age</td>
        <td class="f-w-b t-a-c" style="width: 90px; font-size: 12px;">Relation With Deceased Person</td>
        <td class="f-w-b t-a-c" style="width: 180px;">Marital Status</td>
        <td class="f-w-b t-a-c" style="width: 90px;">Remarks</td>
    </tr>
    <?php
//    $efm_cnt++;
    $temp_member_details = json_decode($legal_heirs_details, true);
    foreach ($temp_member_details as $md) {
        $temp_marital_status = isset($md['member_marital_status']) ? $md['member_marital_status'] : VALUE_ZERO;
        $temp_relation = isset($md['member_relation']) ? $md['member_relation'] : VALUE_ZERO;
        $temp_remarks = isset($md['member_remarks']) ? $md['member_remarks'] : VALUE_ZERO;
        if ($temp_remarks == VALUE_TWO) {
            $late = 'Late.';
            $memAge = '-';
        } else {
            $late = '';
            $memAge = isset($md['member_age']) ? $md['member_age'] : '-';
        }
        ?>
        <tr>
            <td class="t-a-c"><?php echo $efm_cnt; ?></td>
            <td><?php echo $late . '&nbsp;';echo isset($md['member_name']) ? $md['member_name'] : ''; ?></td>
            <td class="t-a-c"><?php echo $memAge; ?></td>
            <td class="t-a-c"><?php echo isset($relation_deceased_person_array[$temp_relation]) ? $relation_deceased_person_array[$temp_relation] : '-'; ?></td>
            <td><?php echo (isset($marital_status_array[$temp_marital_status]) ? $marital_status_array[$temp_marital_status] : '-'); ?></td>
            <td class="t-a-c"><?php echo isset($member_remarks_array[$temp_remarks]) ? $member_remarks_array[$temp_remarks] : '-'; ?></td>
        </tr>
        <?php
        $efm_cnt++;
    }
    ?>
</table>