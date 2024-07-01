<?php if ($m_type == VALUE_TWO) { ?>
    <div style="position: absolute; bottom: 155px; left: 180px; text-align: center; font-family: arial_unicode_ms; <?php echo isset($is_eocs) ? 'width: 170px;' : ''; ?>">
        <div style="font-weight: bold;">PREPARED BY</div>
        <img src="images/<?php echo $t_id; ?>-eocs.png" height="50">
        <div style="font-weight: bold;">(<?php echo $s_name; ?>)</div>
        <div style="font-weight: bold;"><?php echo $s_type_name; ?></div>
    </div>
<?php } else if ($m_type == VALUE_THREE) { ?>
    <div style="position: absolute; bottom: 155px; left: 350px; text-align: center; font-family: arial_unicode_ms; <?php echo isset($is_eocs) ? 'width: 170px;' : ''; ?>">
        <div style="font-weight: bold;">CHECKED BY</div>
        <img src="images/<?php echo $t_id; ?>-eocs.png" height="50">
        <div style="font-weight: bold;">(<?php echo $s_name; ?>)</div>
        <div style="font-weight: bold;"><?php echo $s_type_name; ?></div>
    </div>
<?php } else if ($m_type == VALUE_FOUR) { ?>
    <div style="position: absolute; bottom: 155px; right: 100px; text-align: center; font-family: arial_unicode_ms; <?php echo isset($is_eocs) ? 'width: 170px;' : ''; ?>">
        <img src="images/<?php echo $t_id; ?>-eocs.png" height="50">
        <div style="font-weight: bold;">(<?php echo $s_name; ?>)</div>
        <div style="font-weight: bold;"><?php echo $s_type_name; ?></div>
    </div>
<?php } ?>
