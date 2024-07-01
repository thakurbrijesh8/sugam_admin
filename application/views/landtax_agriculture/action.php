<div class="text-center">
	<button type="button" class="btn btn-sm btn-success" style="padding: 2px 7px;"
            onclick="LandTaxAgriculture.listview.editAgricultureLandsDetails($(this),'{{landtax_agriculture_id}}');"><i class="fas fa-eye"></i>&nbsp; Edit</button>
    <?php if (is_admin() || is_talathi_user()) { ?>
        <button type="button" class="btn btn-sm btn-warning" style="padding: 2px 7px;"
                onclick="LandTaxAgriculture.listview.generateNoticeForAgricultureLandDetails('{{landtax_agriculture_id}}');">
            <i class="fas fa-file-pdf"></i>&nbsp; Generate Notice (PDF)</button>
        <button type="button" class="btn btn-sm btn-primary" style="padding: 2px 7px;"
            onclick="LandTaxAgriculture.listview.showGeneratedNoticeHistory($(this),'{{khata_number}}','{{village}}');">
        <i class="fas fa-history"></i>&nbsp; Notice History (PDF)</button>
    <?php } ?>
    <button type="button" class="btn btn-sm btn-nic-blue" style="padding: 2px 7px;"
        onclick="LandTaxAgriculture.listview.askForPaymentForAgricultureLandDetails($(this), '{{landtax_agriculture_id}}');">
    <i class="fas fa-rupee-sign"></i>&nbsp; Payment</button>
    <button type="button" class="btn btn-sm btn-info" style="padding: 2px 7px;"
            onclick="LandTaxAgriculture.listview.showAgricultureLTPaymentHistory($(this),'{{khata_number}}','{{village}}');">
        <i class="fas fa-history"></i>&nbsp; Payment History</button>
    <!-- <button type="button" class="btn btn-sm btn-nic-blue" style="padding: 2px 7px;"
            onclick="LandTaxAgriculture.listview.showAllNALandsDetails($(this),'{{khata_number}}','{{village}}', VALUE_ONE);">
        <i class="fas fa-eye"></i>&nbsp; Show All Lands</button>
    
     -->
</div>