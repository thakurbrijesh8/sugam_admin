<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">View Payment Details</h3>
</div>
<div class="card-body p-b-0px text-left">
    <form role="form" id="pfd_form" name="pfd_form" onsubmit="return false;" style="font-size: 14px;">
        <input type="hidden" id="module_id_for_pfd" name="module_id_for_pfd" value="{{module_id}}">
        <input type="hidden" id="module_type_for_pfd" name="module_type_for_pfd" value="{{module_type}}">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-pfd f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Application Number <span style="color: red;">*</span></label>
                <input type="text" class="form-control" placeholder="Application Number !"
                       value="{{application_number}}" readonly="">
            </div>
        </div>
        <div class="f-w-b mt-1 mb-1">Details of Land</div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-beige">
                        <td class="f-w-b text-center v-a-m" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center v-a-m" style="width: 60px;">{{s_title}}</td>
                        <td class="f-w-b text-center v-a-m" style="width: 60px;">{{sd_title}}</td>
                        {{#if show_psaw}}
                        <td class="f-w-b text-center v-a-m" style="width: 85px;">Property Status</td>
                        <td class="f-w-b text-center v-a-m" style="width: 85px;">Also Issue Copy of</td>
                        {{/if}}
                        <td class="f-w-b text-center v-a-m" style="width: 85px;">No. of Copies</td>
                        {{#if show_pd}}
                        <td class="f-w-b text-center v-a-m" style="width: 85px;">Pages as Per Copy</td>
                        {{/if}}
                        <td class="f-w-b text-center v-a-m" style="width: 80px;">Amount</td>
                    </tr>
                </thead>
                <tbody id="ld_item_container_for_{{module_type}}"></tbody>
                <tfoot>
                    <tr class="bg-beige">
                        <td class="f-w-b text-right text-success v-a-m" colspan="{{#if show_psaw}}5{{else}}3{{/if}}">Rupees To Be Paid : </td>
                        <td class="f-w-b text-right text-success v-a-m">Copies : {{total_copies}}</td>
                        {{#if show_pd}}
                        <td class="f-w-b text-right text-success v-a-m">Pages : {{total_pages}}</td>
                        {{/if}}
                        <td class="f-w-b text-right text-success v-a-m">Rs. : {{total_amount}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div id="fb_container_for_{{module_type}}" style="display: none;"></div> 
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Payment Type <span class="color-nic-red">*</span></label>
                <div id="payment_type_container_for_pfd"></div>
                <span class="error-message error-message-pfd-payment_type_for_pfd"></span>
            </div>
        </div>
        <div id="ph_container_for_{{module_type}}"></div> 
    </form>
</div>
<div class="card-footer text-right p-2">
    {{#if show_fees_paid}}
    <button type="button" class="btn btn-sm btn-success" 
            onclick="payFormFees($(this));"><i class="fas fa-rupee-sign"></i> &nbsp; Pay</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">
        <i class="fas fa-times"></i> &nbsp; Close
    </button>
</div>