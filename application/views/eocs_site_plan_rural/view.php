<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Application for issue of Site Plan (Rural Area)
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Application Number</td>
                <td>{{application_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Full Name of Applicant</td>
                <td>{{applicant_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Mobile Number</td>
                <td>{{mobile_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Email Address</td>
                <td>{{email}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Communication Address</td>
                <td>{{address}}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="f-w-b f-s-16px">Details of Land</div>
    <div class="table-responsive mt-1">
        <table class="table table-bordered table-padding bg-beige mb-1">
            <tr>
                <td class="f-w-b">District</td>
                <td>{{district_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b" style="width: 40%;">Village</td>
                <td>{{village_text}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Survey</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Subdiv</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 80px;">Area in Square Meter</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 85px;">No. of Copies</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 80px;">Amount</td>
                </tr>
            </thead>
            <tbody id="fld_container_for_esprview"></tbody>
            <tfoot>
                <tr>
                    <td class="f-w-b text-right text-success v-a-m bg-beige" colspan="4">Rupees To Be Paid : </td>
                    <th class="f-w-b text-right text-success v-a-m bg-beige">Copies : <span id="total_copies_for_esprview"></span></th>
                    <th class="f-w-b text-right text-success v-a-m bg-beige">Rs. : <span id="total_amount_for_esprview"></span></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <hr>
    <div class="f-w-b f-s-16px">Enclosed as below :-</div>
    <div class="table-responsive mt-1">
        <table class="table table-bordered table-padding bg-beige mb-1">
            <tr>
                <td class="f-w-b" style="width: 40%;">I.D. Proof Number (Aadhar/PAN/Other Gov.Id)</td>
                <td>{{id_proof_number}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <tr>
                <!--                {{#if show_applicant_photo}}
                                <td style="width: 180px; border-top: none;">
                                    <img style="border: 2px solid blue; width: 160px; height: 180px;"
                                         src="{{EOCS_SITE_PLAN_RURAL_DOC_PATH}}{{applicant_photo}}">
                                </td>
                                {{/if}}-->
                <td style="border-top: none; vertical-align: top !important;">
                    <div>
                        {{#if show_nakal}}
                        <a target="_blank" href="{{EOCS_SITE_PLAN_RURAL_DOC_PATH}}{{nakal}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; I & XIV (Issued within 6 months)
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_id_proof}}
                        <a target="_blank" href="{{EOCS_SITE_PLAN_RURAL_DOC_PATH}}{{id_proof}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Aadhar / PAN / Other Gov.Id
                            </label>
                        </a>
                        {{/if}}
                    </div>
                </td>
            </tr>
        </table>
    </div>
    {{#if show_verification_details}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Verified By</td>
                <td>{{n_verified_details.verified_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Verification Date & Time</td>
                <td>{{n_verified_details.verified_datetime_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Verification Remarks</td>
                <td>{{n_verified_details.verified_remarks}}</td>
            </tr>
        </table>
    </div>
    {{/if}}
    {{#if show_prepared_details}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Prepared By</td>
                <td>{{n_prepared_details.prepared_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Prepared Date & Time</td>
                <td>{{n_prepared_details.prepared_datetime_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Prepared Remarks</td>
                <td>{{n_prepared_details.prepared_remarks}}</td>
            </tr>
        </table>
    </div>
    {{/if}}
    {{#if show_checked_details}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Checked By</td>
                <td>{{n_checked_details.checked_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Checked Date & Time</td>
                <td>{{n_checked_details.checked_datetime_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Checked Remarks</td>
                <td>{{n_checked_details.checked_remarks}}</td>
            </tr>
        </table>
    </div>
    {{/if}}
    {{#if show_enter_remarks}}
    <hr>
    <input type="hidden" id="eocs_site_plan_rural_id_for_esprview" name="eocs_site_plan_rural_id_for_esprview" value="{{eocs_site_plan_rural_id}}" />
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Remarks <span class="color-nic-red">*</span></label>
            <textarea id="remarks_for_esprview" name="remarks_for_esprview"
                      onblur="checkValidation('esprview', 'remarks_for_esprview', remarksValidationMessage);"
                      class="form-control" placeholder="Enter Remarks !" maxlength="200" ></textarea>
            <span class="error-message error-message-esprview-remarks_for_esprview"></span>
        </div>
    </div>
    {{/if}}
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_esprview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    {{#if show_verification_btn}}
    <button type="button" class="btn btn-sm btn-success"
            onclick="EocsSitePlanRural.listview.updateApplicationStatus($(this), VALUE_ONE);">
        <i class="fas fa-clipboard-check mr-1"></i> Verify & Send for Payment
    </button>
    {{/if}}
    {{#if show_prepare_btn}}
    <button type="button" class="btn btn-sm btn-success"
            onclick="EocsSitePlanRural.listview.updateApplicationStatus($(this), VALUE_TWO);">
        <i class="fas fa-clipboard-check mr-1"></i> Confirm Prepared By
    </button>
    {{/if}}
    {{#if show_check_btn}}
    <button type="button" class="btn btn-sm btn-success"
            onclick="EocsSitePlanRural.listview.updateApplicationStatus($(this), VALUE_THREE);">
        <i class="fas fa-clipboard-check mr-1"></i> Confirm Checked By
    </button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fas fa-times"></i> &nbsp; Close</button>
</div>