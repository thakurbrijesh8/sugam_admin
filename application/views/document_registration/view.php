<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Document Registration Details
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="card card-primary card-outline card-outline-tabs border-top-0">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link f-w-b" id="custom-tabs-drsone-tab" data-toggle="pill"
                       href="#custom-tabs-drsone" role="tab" aria-controls="custom-tabs-drsone"
                       style="border-bottom: 0px !important; font-size: 15px !important; color: #007bff !important;"
                       aria-selected="true">Basic Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link f-w-b" id="custom-tabs-drstwo-tab"data-toggle="pill"
                       href="#custom-tabs-drstwo" role="tab" aria-controls="custom-tabs-drstwo"
                       style="border-bottom: 0px !important; font-size: 15px !important; color: #007bff !important;"
                       aria-selected="false">Presenting Party Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link f-w-b" id="custom-tabs-drsthree-tab" data-toggle="pill"
                       href="#custom-tabs-drsthree" role="tab" aria-controls="custom-tabs-drsthree"
                       style="border-bottom: 0px !important; font-size: 15px !important; color: #007bff !important;"
                       aria-selected="false">Other Party Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active f-w-b" id="custom-tabs-drsfour-tab" data-toggle="pill"
                       href="#custom-tabs-drsfour" role="tab" aria-controls="custom-tabs-drsfour"
                       style="border-bottom: 0px !important; font-size: 15px !important; color: #007bff !important;"
                       aria-selected="false">Property / Other Details</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade" id="custom-tabs-drsone" role="tabpanel" aria-labelledby="custom-tabs-drsone-tab"></div>
                <div class="tab-pane fade" id="custom-tabs-drstwo" role="tabpanel" aria-labelledby="custom-tabs-drstwo-tab"></div>
                <div class="tab-pane fade" id="custom-tabs-drsthree" role="tabpanel" aria-labelledby="custom-tabs-drsthree-tab"></div>
                <div class="tab-pane fade show active" id="custom-tabs-drsfour" role="tabpanel" aria-labelledby="custom-tabs-drsfour-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered table-padding bg-beige">
                            <tr>
                                <td class="f-w-b" style="width: 40%;">Temp Application Number / Date & Time</td>
                                <td>{{temp_application_number}} <b>/</b> {{application_datetime_text}}</td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Document Type (Article)</td>
                                <td>{{doc_type_text}}</td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Consideration Amount (If Any)</td>
                                <td>Rs. {{doc_consideration_amount}} /-</td>
                            </tr>
                            <tr>
                                <td class="f-w-b" style="width: 40%;">Land / Property Details</td>
                                <td>{{property_details_status_text}}</td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Ownership / Applicant Type</td>
                                <td>{{ownership_type_text}}</td>
                            </tr>
                        </table>
                    </div>
                    <div id="drsfour_main_container_for_view"></div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
    {{#if show_verification_details}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Document Verified By</td>
                <td>{{verified_name}} (<b> {{verified_uname}} </b>)</td>
            </tr>
            <tr>
                <td class="f-w-b">Document Verification Date & Time</td>
                <td>{{verified_datetime_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Remarks</td>
                <td>{{verified_remarks}}</td>
            </tr>
        </table>
    </div>
    {{/if}}
    {{#if show_verified_app_details}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Document Verified By</td>
                <td>{{verified_app_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Document Verification Date & Time</td>
                <td>{{verified_app_datetime_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Remarks</td>
                <td>{{verified_app_remarks}}</td>
            </tr>
        </table>
    </div>
    {{/if}}
    {{#if show_approval_or_rejection_details}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Document Status</td>
                <td>{{{status_text}}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Document Status Date & Time</td>
                <td>{{status_datetime_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Remarks</td>
                <td>{{remarks}}</td>
            </tr>
        </table>
    </div>
    {{/if}}
    {{#if show_enter_remarks}}
    <input type="hidden" id="document_registration_id_for_view_dr" name="document_registration_id_for_view_dr" value="{{document_registration_id}}" />
    <div class="row">
        <div class="form-group col-sm-6">
            <label>Remarks <span class="color-nic-red">*</span></label>
            <textarea id="remarks_for_view_dr" name="remarks_for_view_dr"
                      onblur="checkValidation('view-dr', 'remarks_for_view_dr', remarksValidationMessage);"
                      class="form-control" placeholder="Enter Remarks !" maxlength="200" ></textarea>
            <span class="error-message error-message-view-dr-remarks_for_view_dr"></span>
        </div>
    </div>
    {{/if}}
    {{#if show_declaration}}
    <div class="row">
        <div class="col-12">
            <div style="margin-bottom: 10px; text-align: justify; text-justify: inter-word;">
                <div class="checkbox" style="position: relative; display: block;">
                    <label class="cursor-pointer">
                        <input type="checkbox" id="declaration_for_view_dr"> 
                        I have Verified the Application and 
                        {{#if show_approve_btn}}Approve it for Registration.{{/if}}
                        {{#if show_reject_btn}}Reject the Registration.{{/if}}
                    </label>
                </div>
                <span class="error-message error-message-view-dr-declaration_for_view_dr"></span>
            </div>
        </div>
    </div>
    {{/if}}
</div>
<div class="card-footer text-right">
    {{#if show_verify_btn}}
    <button type="button" class="btn btn-sm btn-success"
            onclick="DocumentRegistration.listview.updateStatusApplication($(this), VALUE_ONE);">Verify & Send for Appointment Approval</button>
    {{/if}}
    {{#if show_verify_app_btn}}
    <button type="button" class="btn btn-sm btn-success"
            onclick="DocumentRegistration.listview.updateStatusApplication($(this), VALUE_TWO);">Verify & Send for Appointment</button>
    {{/if}}
    {{#if show_reject_btn}}
    <button type="button" class="btn btn-sm btn-danger"
            onclick="DocumentRegistration.listview.updateStatusApplication($(this), VALUE_FOUR);">Reject Document</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-{{#if show_reject_btn}}default{{else}}danger{{/if}}" onclick="Swal.close();">Close</button>
</div>