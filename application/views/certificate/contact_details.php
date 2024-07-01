<?php
$io_cd_array = $this->config->item('io_cd_array');
$cd_array = isset($io_cd_array[$district]) ? $io_cd_array[$district] : $io_cd_array[TALUKA_DAMAN];
?>
<div class="f-s-14px" style="margin-top: <?php echo isset($mt_email) ? $mt_email : '-10px' ?>;">Email - <?php echo $cd_array['email']; ?></div>
<div class="f-s-14px" style="margin-top: <?php echo isset($mt_tele) ? $mt_tele : '-18px' ?>; text-align: right;">Telephone No. - <?php echo $cd_array['tele']; ?></div>
<hr>