<b style="font-size: 14px;">Details of Earning Family Members</b>
<?php $efm_cnt = 1; ?>
<table class="monthly-income" style="font-size: 13px; margin-top: 5px;">
    <tr>
        <td class="f-w-b t-a-c" style="width: 30px;">Sr. No</td>
        <td class="f-w-b t-a-c">Name</td>
        <td class="f-w-b t-a-c" style="width: 40px;">Age</td>
        <td class="f-w-b t-a-c" style="width: 90px; font-size: 12px;">Relation with Applicant</td>
        <td class="f-w-b t-a-c" style="width: 180px;">Profession</td>
        <td class="f-w-b t-a-c" style="width: 90px;">Yearly Income</td>
    </tr>
    <tr>
        <td class="t-a-c"><?php echo $efm_cnt; ?></td>
        <td><?php echo $applicant_name; ?></td>
        <td class="t-a-c"><?php echo $applicant_age; ?></td>
        <td class="t-a-c">Self</td>
        <td><?php echo $app_occupation; ?></td>
        <td style="text-align: right;"><?php echo indian_comma_income($applicant_yearly_income) . '/-'; ?></td>
    </tr>
    <?php
    if ($applicant_have_earning_member == VALUE_ONE) {
        $efm_cnt++;
        $temp_member_details = json_decode($member_details, true);
        foreach ($temp_member_details as $md) {
            $temp_profession = isset($md['profession']) ? $md['profession'] : VALUE_ZERO;
            $temp_oo = isset($md['other_occupation']) ? $md['other_occupation'] : '';
            ?>
            <tr>
                <td class="t-a-c"><?php echo $efm_cnt; ?></td>
                <td><?php echo isset($md['name_of_family_memb']) ? $md['name_of_family_memb'] : ''; ?></td>
                <td class="t-a-c"><?php echo isset($md['age_of_family_memb']) ? $md['age_of_family_memb'] : ''; ?></td>
                <td class="t-a-c"><?php echo isset($md['member_relation']) ? $md['member_relation'] : ''; ?></td>
                <td><?php echo (isset($profession_array[$temp_profession]) ? ($temp_profession == VALUE_TEN ? $temp_oo : $profession_array[$temp_profession]) : '-'); ?></td>
                <td style="text-align: right;"><?php echo (isset($md['yearly_income']) ? indian_comma_income($md['yearly_income']) : 0) . '/-'; ?></td>
            </tr>
            <?php
            $efm_cnt++;
        }
    }
    ?>
</table>