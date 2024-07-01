<div class="text-center">
    <button type="button" class="btn btn-sm btn-nic-blue" style="padding: 2px 7px;"
            onclick="LandTaxNA.listview.showAllNALandsDetails($(this),'{{khata_number}}','{{village}}', VALUE_ONE);">
        <i class="fas fa-eye"></i>&nbsp; Show All Lands</button>
    <button type="button" class="btn btn-sm btn-primary" style="padding: 2px 7px;"
            onclick="LandTaxNA.listview.showGeneratedNoticeHistory($(this),'{{khata_number}}','{{village}}');">
        <i class="fas fa-history"></i>&nbsp; Notice History (PDF)</button>
    <button type="button" class="btn btn-sm btn-info" style="padding: 2px 7px;"
            onclick="LandTaxNA.listview.showNALTPaymentHistory($(this),'{{khata_number}}','{{village}}');">
        <i class="fas fa-history"></i>&nbsp; Payment History</button>
</div>