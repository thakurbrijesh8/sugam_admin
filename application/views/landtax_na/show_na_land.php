<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Land Tax (N.A.) Land Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <span class="error-message error-message-landtax-na f-w-b"
                              style="border-bottom: 2px solid red;"></span>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" name="district_for_nald" id="district_for_nald" value="{{district}}">
                    <input type="hidden" name="village_for_nald" id="village_for_nald" value="{{village}}">
                    <input type="hidden" name="khata_number_for_nald" id="khata_number_for_nald" value="{{khata_number}}">
                    <div class="col-sm-12" style="margin-bottom: 5px;">
                        <button type="button" class="btn btn-sm btn-danger float-right mr-1" style="padding: 2px 7px;"
                                onclick="LandTaxNA.listview.showDatatableLandTaxNAData();">
                            <i class="fas fa-arrow-left"></i>&nbsp; Back</button>
                        <button type="button" class="btn btn-sm btn-info float-right mr-1" style="padding: 2px 7px;"
                                onclick="LandTaxNA.listview.showNALTPaymentHistory($(this),'{{khata_number}}','{{village}}');">
                            <i class="fas fa-history"></i>&nbsp; Payment History</button>
                        <button type="button" class="btn btn-sm btn-nic-blue float-right mr-1" style="padding: 2px 7px;"
                                onclick="LandTaxNA.listview.askForPaymentForNALandDetails($(this));">
                            <i class="fas fa-rupee-sign"></i>&nbsp; Payment</button>
                        <button type="button" class="btn btn-sm btn-primary float-right mr-1" style="padding: 2px 7px;"
                                onclick="LandTaxNA.listview.showGeneratedNoticeHistory($(this),'{{khata_number}}','{{village}}');">
                            <i class="fas fa-history"></i>&nbsp; Notice History (PDF)</button>
                        <?php if (is_admin() || is_talathi_user()) { ?>
                            <button type="button" class="btn btn-sm btn-warning float-right mr-1" style="padding: 2px 7px;"
                                    onclick="LandTaxNA.listview.generateNoticeForNALandDetails();">
                                <i class="fas fa-file-pdf"></i>&nbsp; Generate Notice (PDF)</button>
                        <?php } ?>
                        <button type="button" class="btn btn-sm btn-success float-right mr-1" style="padding: 2px 7px;"
                                onclick="LandTaxNA.listview.generateExcelForNALandDetails();">
                            <i class="fas fa-file-excel"></i>&nbsp; Download Excel</button>
                        <button type="button" class="btn btn-sm btn-nic-blue float-right mr-1" style="padding: 2px 7px;"
                                id="knd_btn_for_ltna"
                                onclick="KhataNumber.listview.showLandsDetails($(this),'{{khata_number}}','{{village}}', VALUE_TWO);"
                                style="padding: 2px 7px;"><i class="fas fa-eye"></i>&nbsp; Khata Number Details</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-padding table-hover vat-top mb-0" id="na_land_table">
                        <thead>
                            <tr class="bg-light-gray">
                                <th class="text-center v-a-m" style="width: 30px;">
                                    <input type="checkbox" name="select_all_na_land" id="select_all_na_land" 
                                           onclick="LandTaxNA.listview.checkboxSelectOptionNALand();" class="cursor-pointer" />
                                </th>
                                <th class="text-center v-a-m" style="width: 30px;">Sr. No.</th>
                                <th class="text-center v-a-m" style="width: 50px;">Khata Number</th>
                                <th class="text-center v-a-m" style="width: 80px;">Village Name</th>
                                <th class="text-center v-a-m" style="width: 80px;">Survey Number</th>
                                <th class="text-center v-a-m" style="width: 80px;">Sub Division Number</th>
                                <th class="text-center v-a-m" style="width: 50px;">Area</th>
                                <th class="text-center v-a-m" style="min-width: 280px;">Occupant Name</th>
                                <th class="text-center v-a-m" style="width: 50px;">Mutation Number</th>
                                <th class="text-center v-a-m" style="width: 80px;">Nature</th>
                                <th class="text-center v-a-m" style="min-width: 80px;">Area Type</th>
                                <th class="text-center" style="min-width: 80px;">
                                    Current Tax<br>(<?php echo get_financial_year(); ?>)
                                </th>
                                <th class="text-center" style="min-width: 150px;">
                                    Arrears<br>(<?php echo get_financial_year(1); ?>)
                                </th>
                                <th class="text-center" style="min-width: 80px;">Total Paid Tax</th>
                                <th class="text-center" style="min-width: 80px;">Total Pending Tax</th>
                            </tr>
                        </thead>
                        <tbody id="na_land_details_container_for_ltna">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>