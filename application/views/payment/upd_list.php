<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">Update Pages Details</h3>
</div>
<div class="card-body p-b-0px text-left">
    <form role="form" id="upd_form" name="upd_form" onsubmit="return false;" style="font-size: 14px;">
        <input type="hidden" id="module_id_for_upd" name="module_id_for_upd" value="{{module_id}}">
        <input type="hidden" id="module_type_for_upd" name="module_type_for_upd" value="{{module_type}}">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-upd f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Application Number <span style="color: red;">*</span></label>
                <input type="text" class="form-control" placeholder="Application Number !"
                       value="{{application_number}}" readonly="">
            </div>
        </div>
        <div class="f-w-b mt-1 mb-1">Details of Land (<span class="color-nic-blue">Note : Rs. <?php echo PER_COPY_PRICE; ?> Per Page</span>)</div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-beige">
                        <td class="f-w-b text-center v-a-m" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center v-a-m" style="width: 60px;">Village</td>
                        <td class="f-w-b text-center v-a-m" style="width: 60px;">Survey</td>
                        <td class="f-w-b text-center v-a-m" style="width: 60px;">Subdiv</td>
                        {{#if show_mte}}
                        <td class="f-w-b text-center v-a-m" style="width: 85px;">Mutation Entry No.</td>
                        {{/if}}
                        {{#if show_dr}}
                        <td class="f-w-b text-center v-a-m" style="width: 85px;">Document Required</td>
                        {{/if}}
                        <td class="f-w-b text-center v-a-m" style="width: 85px;">No. of Copies</td>
                        <td class="f-w-b text-center v-a-m" style="width: 85px;">Pages as Per Copy</td>
                        <td class="f-w-b text-center v-a-m" style="width: 80px;">Amount</td>
                        {{#if show_na}}
                        <td class="f-w-b text-center v-a-m" style="width: 80px;"></td>
                        {{/if}}
                    </tr>
                </thead>
                <tbody id="ld_item_container_for_upd_{{module_type}}"></tbody>
                <tfoot>
                    <tr class="bg-beige">
                        <td class="f-w-b text-right text-success v-a-m" colspan="{{show_colspan}}">Rupees To Be Paid : </td>
                        <td class="f-w-b text-right text-success v-a-m">Copies : {{total_copies}}</td>
                        <td class="f-w-b text-right text-success v-a-m pr-3">Pages : <span id="total_pages_for_upd">{{total_pages}}</span></td>
                        <td class="f-w-b text-right text-success v-a-m">Rs : <span id="total_amount_for_upd">{{total_amount}}</span>/-</td>
                        {{#if show_na}}
                        <td class="f-w-b text-center v-a-m"></td>
                        {{/if}}
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Remarks <span style="color: red;">*</span></label>
                <textarea id="sfp_remarks_for_upd" name="sfp_remarks_for_upd"
                          class="form-control" placeholder="Remarks !"
                          onblur="checkValidation('upd', 'sfp_remarks_for_upd', remarksValidationMessage);">{{sfp_remarks}}</textarea>
                <span class="error-message error-message-upd-sfp_remarks_for_upd"></span>
            </div>
        </div>
    </form>
</div>
<div class="card-footer text-right p-2">
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="updatePageDetails($(this), VALUE_ONE);">
        <i class="fas fa-download"></i> &nbsp; Save as Draft
    </button>
    <button type="button" class="btn btn-sm btn-success" onclick="updatePageDetails($(this), VALUE_TWO);">
        <i class="fas fa-save"></i> &nbsp; Submit and Send for Payment
    </button>
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">
        <i class="fas fa-times"></i> &nbsp; Close
    </button>
</div>