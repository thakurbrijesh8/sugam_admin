<table class="monthly-income" style="font-size: 13px; margin-top: 5px;">
    <tr>
        <td class="f-w-b t-a-c" style="width: 30px;">Sr. No</td>
        <td class="f-w-b t-a-c">Relation With Applicant</td>
        <td class="f-w-b t-a-c">Name</td>
        <td class="f-w-b t-a-c">Occupation</td>
    </tr>
    <tr>
        <td class="t-a-c">1</td>
        <td class="t-a-c">Father Name</td>
        <td><?php echo $father_name; ?></td>
        <td><?php echo ((isset($parent_profession_array[$father_occupation]) ? ($father_occupation == VALUE_NINE ? $father_other_occupation : $parent_profession_array[$father_occupation]) : '-')); ?></td>
    </tr>
    <tr>
        <td class="t-a-c">2</td>
        <td class="t-a-c">Mother Name</td>
        <td><?php echo $mother_name; ?></td>
        <td><?php echo ((isset($parent_profession_array[$mother_occupation]) ? ($mother_occupation == VALUE_NINE ? $mother_other_occupation : $parent_profession_array[$mother_occupation]) : '-')); ?></td>
    </tr>
    <?php if ($marital_status == VALUE_ONE || $marital_status == VALUE_THREE) { ?>
        <tr>
            <td class="t-a-c">3</td>
            <td class="t-a-c">Spouse Name</td>
            <td><?php echo $spouse_name; ?></td>
            <td><?php echo ((isset($parent_profession_array[$spouse_occupation]) ? ($spouse_occupation == VALUE_NINE ? $spouse_other_occupation : $parent_profession_array[$spouse_occupation]) : '-')); ?></td>
        </tr>
    <?php } ?>
</table>