<?php if ($m_type == VALUE_THREE) { ?>
    <div style="position: absolute; bottom: 140px; left: 150px; text-align: center; font-family: arial_unicode_ms; font-size: 12px; <?php echo isset($is_eocs) ? 'width: 170px;' : ''; ?>">
        <div style="font-weight: bold;">CHECKED BY</div>
        <img src="images/<?php echo $t_id; ?>-eocs.png" height="50">
        <div style="font-weight: bold;">(<?php echo $s_name; ?>)</div>
        <div style="font-weight: bold;"><?php echo $s_type_name; ?></div>
    </div>
<?php } else if ($m_type == VALUE_FOUR) { ?>
    <div style="position: absolute; bottom: 140px; right: 150px; text-align: center; font-family: arial_unicode_ms; font-size: 12px; <?php echo isset($is_eocs) ? 'width: 170px;' : ''; ?>">
        <img src="images/<?php echo $t_id; ?>-eocs.png" height="50">
        <div style="font-weight: bold;">(<?php echo $s_name; ?>)</div>
        <div style="font-weight: bold;"><?php echo $s_type_name; ?></div>
    </div>
<?php } ?>
