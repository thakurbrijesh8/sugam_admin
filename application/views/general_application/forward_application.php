<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Forward General Application</h3>
</div>
<form role="form" id="forward_application_general_application_form" name="forward_application_general_application_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="general_application_id_for_general_application_forward_application" name="general_application_id_for_general_application_forward_application" value="{{general_application_id}}">
    <input type="hidden" id="general_application_history_id_for_general_application_forward_application" name="general_application_history_id_for_general_application_forward_application" value="{{general_application_history_id}}">

    <div class="card-body p-b-0px text-left">

        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-general-application-forward-application f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Application Number</td>
                    <td>{{application_number}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Name of Applicant</td>
                    <td>{{applicant_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Applicant's Communication Address</td>
                    <td>{{address}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Applicant Mobile Number</td>
                    <td>{{mobile_number}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Purpose</td>
                    <td>{{purpose}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Subject</td>
                    <td>{{subject_text}}</td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding">
                <thead>
                    <tr>
                        <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Forwarded By</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Forwarded To</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Forwarded Date Time</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Remarks</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Field Verification <br>Documents</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Report</td>
                    </tr>
                </thead>
                <tbody id="application_movment_history_container_for_general_application">
                </tbody>
            </table>
        </div>
        {{#if show_mamlatdar_enter_forward_to}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Forward to <span style="color: red;">*</span></label>
                <div id="forward_to_container_for_general_application"></div>
                <span class="error-message error-message-general-application-forward-application-forward_to_for_general_application"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12" id="mam_to_talathi_container_for_general_application" style="display: none;">
                <label>1.1. Forward to Talathi <span style="color: red;">*</span></label>
                <select id="mam_to_talathi_for_general_application" name="mam_to_talathi_for_general_application"
                        onchange="checkValidation('general-application-forward-application', 'mam_to_talathi_for_general_application', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to LDC">
                    <option value="">Select Any Talathi</option>
                </select>
                <span class="error-message error-message-general-application-forward-application-mam_to_talathi_for_general_application"></span>
            </div>
        </div><div class="row">
            <div class="form-group col-sm-12" id="mam_to_ci_container_for_general_application" style="display: none;">
                <label>1.1. Forward to Awal Karkun / Circle Inspector <span style="color: red;">*</span></label>
                <select id="mam_to_ci_for_general_application" name="mam_to_ci_for_general_application"
                        onchange="checkValidation('general-application-forward-application', 'mam_to_ci_for_general_application', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to LDC">
                    <option value="">Select Any Awal Karkun / Circle Inspector</option>
                </select>
                <span class="error-message error-message-general-application-forward-application-mam_to_ci_for_general_application"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12" id="mam_to_ldc_container_for_general_application" style="display: none;">
                <label>1.1. Forward to LDC <span style="color: red;">*</span></label>
                <select id="mam_to_ldc_for_general_application" name="mam_to_ldc_for_general_application"
                        onchange="checkValidation('general-application-forward-application', 'mam_to_ldc_for_general_application', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to LDC">
                    <option value="">Select Any LDC</option>
                </select>
                <span class="error-message error-message-general-application-forward-application-mam_to_ldc_for_general_application"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12" id="forward_to_mam_container_for_general_application" style="display: none;">
                <label>1.1. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <select id="forward_to_mam_for_general_application" name="forward_to_mam_for_general_application"
                        onchange="checkValidation('general-application-forward-application', 'forward_to_mam_for_general_application', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to Mamlatdar">
                    <option value="">Select Any Mamlatdar</option>
                </select>
                <span class="error-message error-message-general-application-forward-application-forward_to_mam_for_general_application"></span>
            </div>
        </div>
        <!--<div class="report_info_for_general_application" style="display: none">-->
        <div class="report_info_for_general_application">
            {{#if show_ldc_enter_forward_to}}
            <div class="row">
                <div class="form-group col-sm-12">
                    <label><span class="index_no_for_ga"></span> Subject<span class="color-nic-red">*</span></label>
                    <textarea id="ldc_subject_for_general_application" name="ldc_subject_for_general_application" class="form-control"
                              maxlength="100" placeholder="Enter Subject" onchange="checkValidation('general-application', 'ldc_subject_for_general_application', subjectValidationMessage);">{{subject_text}}</textarea>
                    <span class="error-message error-message-general-application-forward-application-ldc_subject_for_general_application"></span>
                </div>
            </div>
            {{/if}}
            {{#if show_ldc_ci_enter_forward_to}}
            <div class="row">
                <div class="form-group col-sm-12">
                    <label><span class="index_no_for_ga"></span> Authority<span class="color-nic-red">*</span></label>
                    <textarea id="authority_for_general_application" name="authority_for_general_application" class="form-control"
                              maxlength="100" placeholder="Enter Authority" onchange="checkValidation('general-application', 'authority_for_general_application', authorityValidationMessage);" >{{authority}}</textarea>
                    <span class="error-message error-message-general-application-forward-application-authority_for_general_application"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label><span class="index_no_for_ga"></span> Reference<span class="color-nic-red">*</span></label>
                    <textarea id="reference_for_general_application" name="reference_for_general_application" class="form-control"
                              placeholder="Enter Reference" onchange="checkValidation('general-application', 'reference_for_general_application', referenceValidationMessage);">{{reference}}</textarea>
                    <span class="error-message error-message-general-application-forward-application-reference_for_general_application"></span>
                </div>
            </div>
            {{/if}}
        </div>
        <!--<div class="report_info_for_general_application" style="display: none">-->
        <div class="report_info_for_report_for_general_application">
            {{#if show_report_enter}}
            <div class="row">
                <div class="form-group col-12">
                    <label><span class="index_no_for_ga"></span> Report <span class="color-nic-red">*</span></label>
                    <textarea class="form-control" id="report_for_general_application" 
                              onchange="checkValidation('general-application', 'report_for_general_application', reportValidationMessage);"
                              name="report_for_general_application">{{report}}</textarea>
                    <span class="error-message error-message-general-application-forward-application-report_for_general_application"></span>
                </div>
            </div>
            {{/if}}
        </div>
        <div class="report_info_for_general_application">
        <!--<div class="report_info_for_general_application" style="display: none">-->
            {{#if show_ldc_ci_enter_forward_to}}
            <div class="row">
                <div class="form-group col-sm-12">
                    <label><span class="index_no_for_ga"></span> Copy To<span class="color-nic-red">*</span></label>
                    <textarea id="copy_to_for_general_application" name="copy_to_for_general_application" class="form-control"
                              placeholder="Enter Copy To" onchange="checkValidation('general-application', 'copy_to_for_general_application', copytoValidationMessage);">{{copy_to}}</textarea>
                    <span class="error-message error-message-general-application-forward-application-copy_to_for_general_application"></span>
                </div>
            </div>
            {{/if}}
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label><span class="index_no_for_ga"></span> Remarks <span style="color: red;">*</span></label>
                <textarea id="remarks_for_general_application" name="remarks_for_general_application" class="form-control"
                          onblur="checkValidation('general-application-forward-application', 'remarks_for_general_application', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{remarks}}</textarea>
                <span class="error-message error-message-general-application-forward-application-remarks_for_general_application"></span>
            </div>
        </div>
        {{/if}}
        {{#if show_field_documents_forward_to}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label><span class="index_no_for_ga"></span> Upload Field Verification Document <span style="color: red;">*</span></label>
                <div id="upload_verification_document_container_for_general_application"></div>
                <span class="error-message error-message-general-application-forward-application-upload_verification_document_for_general_application"></span>
            </div>
        </div>
        <div class="row" id="field_verification_document_uploads_container_for_general_application" style="display: none">
            <div class="col-md-12">
                <div class="card bg-beige">
                    <div class="card-header">
                        <h3 class="card-title f-w-b f-s-14px">
                            <span class="drsone-cnt"></span><span style="color: red;">*(Maximum File Size: 2MB) (Upload JPG, JPEG, PNG, PDF Only)</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-center" style="width: 30px;">No.</th>
                                        <th class="text-center" style="min-width: 165px;">Document Name</th>
                                        <th class="text-center" style="min-width: 165px;">Document</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="upload_verification_doc_item_container_for_general_application_{{VALUE_ONE}}" class="bg-white"></tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-nic-blue btn-sm pull-right"
                                onclick="GeneralApplication.listview.addVerificationDocItem({},{{VALUE_ONE}});"><i class="fas fa-plus" style="margin-right: 5px;"></i>Add More Documents</button>
                    </div>
                </div>
            </div>
        </div>
        {{/if}}
        {{#if show_report_doc_for_ldc}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label><span class="index_no_for_ga"></span> Field Verification Documents</label></div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding mb-0">
                <thead>
                    <tr class="bg-light-gray">
                        <th></th>
                        <th class="f-w-b text-center" style="width: 10%;">Sr. No.</th>
                        <th class="f-w-b text-center">Document Name</th>
                        <th class="f-w-b text-center">Document</th>
                    </tr>
                </thead>
                <tbody id="document_item_container_for_field_verification_view_{{VALUE_ONE}}"></tbody>
            </table>
        </div>
        {{/if}}
        <hr class="m-b-1rem">
        <div class="form-group">
            {{#if show_frd_btn}}
            <button type="button" class="btn btn-sm btn-nic-blue"
                    onclick="GeneralApplication.listview.submitForwardApplication($(this), {{VALUE_ONE}});"
                    style="margin-right: 5px;"><i class="fas fa-download" style="padding-right: 4px;"></i>Draft</button>
            <button type="button" class="btn btn-sm btn-success"
                    onclick="GeneralApplication.listview.submitForwardApplication($(this), {{VALUE_TWO}});"
                    style="margin-right: 5px;"><i class="fas fa-edit" style="padding-right: 4px;"></i>Forward </button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fa fa-times" style="padding-right: 4px;"></i>Close</button>
        </div>
    </div>
</form>