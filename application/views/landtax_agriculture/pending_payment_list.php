<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Land Tax (Agriculture) Pending Payment Details</h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 14px;">
    <div class="table-responsive">
        <table class="table table-bordered table-padding table-hover vat-top">
            <thead>
                <tr class="bg-light-gray">
                    <th class="text-center v-a-m" style="width: 30px;">Sr. No.</th>
                    <th class="text-center v-a-m" style="width: 150px;">Village</th>
                    <th class="text-center v-a-m" style="width: 150px;">Khata Number</th>
                    <th class="text-center v-a-m" style="min-width: 280px;">Occupant Name</th>
                    <th class="text-center v-a-m" style="min-width: 80px;">Amount Pending</th>
                </tr>
            </thead>
            <tbody id="pending_payment_container_for_ppagrild"></tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-ppagrild f-w-b" style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    <div class="row pd_for_ppagrild">
        <div class="form-group col-sm-6">
            <label>Payment Type <span class="color-nic-red">*</span></label>
            <div id="payment_type_container_for_ppagrild"></div>
            <span class="error-message error-message-ppagrild-payment_type_for_ppagrild"></span>
        </div>
    </div>
</div>
<div class="card-footer text-right pr-2">
    <button type="button" class="btn btn-sm btn-success pd_for_ppagrild mr-1" onclick="LandTaxAgriculture.listview.payPendingTax($(this),'{{landtax_agriculture_id}}');">
        <i class="fas fa-rupee-sign"></i> &nbsp; Pay</button>
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">
        <i class="fas fa-times"></i>&nbsp; Close</button>
</div>