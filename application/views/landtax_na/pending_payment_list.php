<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Land Tax (N.A.) Pending Payment Details</h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 14px;">
    <div class="table-responsive">
        <table class="table table-bordered table-padding table-hover vat-top">
            <thead>
                <tr class="bg-light-gray">
                    <th class="text-center v-a-m" style="width: 30px;">Sr. No.</th>
                    <th class="text-center v-a-m" style="width: 50px;">Khata Number</th>
                    <th class="text-center v-a-m" style="width: 80px;">Village Name</th>
                    <th class="text-center v-a-m" style="width: 80px;">Survey Number</th>
                    <th class="text-center v-a-m" style="width: 80px;">Sub Division Number</th>
                    <th class="text-center v-a-m" style="width: 50px;">Area</th>
                    <th class="text-center v-a-m" style="min-width: 280px;">Occupant Name</th>
                    <th class="text-center" style="min-width: 83px;">
                        Current Tax<br>(<?php echo get_financial_year(); ?>)
                    </th>
                    <th class="text-center" style="min-width: 150px;">
                        Arrears<br>(<?php echo get_financial_year(1); ?>)
                    </th>
                    <th class="text-center" style="min-width: 83px;">Total Paid Tax</th>
                    <th class="text-center" style="min-width: 80px;">Total Pending Tax</th>
                </tr>
            </thead>
            <tbody id="pending_payment_container_for_ppnald"></tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-ppnald f-w-b" style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    <div class="row pd_for_ppnald">
        <div class="form-group col-sm-6">
            <label>Payment Type <span class="color-nic-red">*</span></label>
            <div id="payment_type_container_for_ppnald"></div>
            <span class="error-message error-message-ppnald-payment_type_for_ppnald"></span>
        </div>
    </div>
</div>
<div class="card-footer text-right pr-2">
    <button type="button" class="btn btn-sm btn-success pd_for_ppnald mr-1" onclick="LandTaxNA.listview.payPendingTax($(this));">
        <i class="fas fa-rupee-sign"></i> &nbsp; Pay</button>
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">
        <i class="fas fa-times"></i>&nbsp; Close</button>
</div>