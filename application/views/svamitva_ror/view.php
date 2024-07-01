<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Svamitva (RoR)
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
                <td>{{applicant_name}} {{father_name}} {{surname}}</td>
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
    <div class="f-w-b f-s-16px">Details of Land :- (Svamitva RoR Required)</div>
    <div class="table-responsive mt-1">
        <table class="table table-bordered table-padding bg-beige mb-1">
            <tr>
                <td class="f-w-b">District</td>
                <td>{{district_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Village</td>
                <td>{{village_text}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr class="bg-light-gray">
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Guathan Number</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Plot Number</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 85px;">No. of Copies</td>
                </tr>
            </thead>
            <tbody id="fld_container_for_srorview"></tbody>
            <tfoot>
                <tr>
                    <th class="f-w-b text-right text-success v-a-m bg-beige" colspan="6">Copies : <span id="total_copies_for_srorview"></span></th>
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
                <td style="border-top: none; vertical-align: top !important;">
                    <div>
                        {{#if show_id_proof}}
                        <a target="_blank" href="{{SVAMITVA_ROR_DOC_PATH}}{{id_proof}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; I.D. Proof (Aadhar / PAN / Other Gov.Id)
                            </label>
                        </a>
                        {{/if}}
                    </div>
                </td>
            </tr>
        </table>
    </div>
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
    <input type="hidden" id="svamitva_ror_id_for_srorview" name="svamitva_ror_id_for_srorview" value="{{svamitva_ror_id}}" />
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Remarks <span class="color-nic-red">*</span></label>
            <textarea id="remarks_for_srorview" name="remarks_for_srorview"
                      onblur="checkValidation('srorview', 'remarks_for_srorview', remarksValidationMessage);"
                      class="form-control" placeholder="Enter Remarks !" maxlength="200" ></textarea>
            <span class="error-message error-message-srorview-remarks_for_srorview"></span>
        </div>
    </div>
    {{/if}}
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_srorview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    {{#if show_check_btn}}
    <button type="button" class="btn btn-sm btn-success"
            onclick="SvamitvaRor.listview.updateApplicationStatus($(this), VALUE_THREE);">
        <i class="fas fa-clipboard-check mr-1"></i> Confirm Checked By
    </button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fas fa-times"></i> &nbsp; Close</button>
</div>