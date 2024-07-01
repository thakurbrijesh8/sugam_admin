    <b style="font-size: 14px;">Children Details</b>
    <?php $child_cnt = 1; ?>
    <table class="monthly-income" style="font-size: 13px; margin-top: 5px;">
        <tr>
            <td class="f-w-b t-a-c" style="width: 60px;">Sr. No</td>
            <td class="f-w-b t-a-c">Name</td>
            <td class="f-w-b t-a-c" style="width: 60px;">Age</td>
            <td class="f-w-b t-a-c" style="width: 250px;">Profession</td>
        </tr>
        <?php
        $temp_child_details = json_decode($children_details, true);
        foreach ($temp_child_details as $cd) {
            $temp_profession = isset($cd['profession']) ? $cd['profession'] : VALUE_ZERO;
            $temp_oo = isset($cd['children_other_occupation']) ? $cd['children_other_occupation'] : '';
            ?>
            <tr>
                <td class="t-a-c"><?php echo $child_cnt; ?></td>
                <td><?php echo isset($cd['name_of_children']) ? $cd['name_of_children'] : ''; ?></td>
                <td class="t-a-c"><?php echo isset($cd['age_of_children']) ? $cd['age_of_children'] : ''; ?></td>
                <td><?php echo (isset($child_profession_array[$temp_profession]) ? ($temp_profession == VALUE_EIGHT ? $temp_oo : $child_profession_array[$temp_profession]) : '-'); ?></td>
            </tr>
            <?php
            $child_cnt++;
        }
        ?>
    </table>