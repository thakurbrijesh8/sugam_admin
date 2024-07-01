<table class="table-header" style="border: none;">
    <tr>
        <td style="width: 70%;"></td>
        <td class="t-a-c" style="vertical-align: bottom; width: 30%;">
            <img src="images/<?php echo $fc_data['signature'] ?>" width="65" /><br>
            <div class="t-a-c footer-title" style="text-transform: uppercase;"><b><?php echo get_from_session('name'); ?></b></div>
            <div class="t-a-c footer-title" style="text-transform: uppercase;"><b><?php echo $fc_data['village_name']; ?> SAZA</b></div>
            <div class="t-a-c footer-title">
                <span class="f-aum">दि.</span> / Dt. <b> : <?php echo $fc_data['generated_datetime'] != '0000-00-00 00:00:00' ? convert_to_new_datetime_format($fc_data['generated_datetime']) : ''; ?></b>
            </div>
        </td>
    </tr>
</table>