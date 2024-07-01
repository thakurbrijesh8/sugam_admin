<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Approve General Application</h3>
</div>
<form role="form" id="approve_general_application_form" name="approve_general_application_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="general_application_id_for_general_application_approve" name="general_application_id_for_general_application_approve" value="{{general_application_id}}">
    <input type="hidden" id="general_application_history_id_for_general_application_approve" name="general_application_history_id_for_general_application_approve" value="{{general_application_history_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-general-application-approve f-w-b" style="border-bottom: 2px solid red;"></span>
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
            </table>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label><span class="index_no_for_approve"></span> Subject<span class="color-nic-red">*</span></label>
                <textarea id="ldc_subject_for_general_application_approve" name="ldc_subject_for_general_application_approve" class="form-control"
                          maxlength="100" placeholder="Enter Subject" onchange="checkValidation('general-application', 'ldc_subject_for_general_application_approve', subjectValidationMessage);">{{subject_text}}</textarea>
                <span class="error-message error-message-general-application-approve-ldc_subject_for_general_application_approve"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label><span class="index_no_for_approve"></span> Authority<span class="color-nic-red">*</span></label>
                <textarea id="authority_for_general_application_approve" name="authority_for_general_application_approve" class="form-control"
                          maxlength="100" placeholder="Enter Authority" onchange="checkValidation('general-application', 'authority_for_general_application_approve', authorityValidationMessage);" >{{authority}}</textarea>
                <span class="error-message error-message-general-application-approve-authority_for_general_application_approve"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label><span class="index_no_for_approve"></span> Reference<span class="color-nic-red">*</span></label>
                <textarea id="reference_for_general_application_approve" name="reference_for_general_application_approve" class="form-control"
                          placeholder="Enter Reference" onchange="checkValidation('general-application', 'reference_for_general_application_approve', referenceValidationMessage);">{{reference}}</textarea>
                <span class="error-message error-message-general-application-approve-reference_for_general_application_approve"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-12">
                <label><span class="index_no_for_approve"></span> Report <span class="color-nic-red">*</span></label>
                <textarea class="form-control" id="report_for_general_application_approve" 
                          onchange="checkValidation('general-application', 'report_for_general_application_approve', reportValidationMessage);"
                          name="report_for_general_application_approve">{{report}}</textarea>
                <span class="error-message error-message-general-application-approve-report_for_general_application_approve"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label><span class="index_no_for_approve"></span> Copy To<span class="color-nic-red">*</span></label>
                <textarea id="copy_to_for_general_application_approve" name="copy_to_for_general_application_approve" class="form-control"
                          placeholder="Enter Copy To" onchange="checkValidation('general-application', 'copy_to_for_general_application_approve', copytoValidationMessage);">{{copy_to}}</textarea>
                <span class="error-message error-message-general-application-approve-copy_to_for_general_application_approve"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label><span class="index_no_for_approve"></span> Field Verification Documents</label></div>
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
                <tbody id="document_item_container_for_field_verification_view_{{VALUE_TWO}}"></tbody>
            </table>
        </div>
        <br>
        <div class="row">
            <div class="form-group col-sm-12">
                <label><span class="index_no_for_approve"></span> Remarks  <span style="color: red;">*</span></label>
                <textarea id="remarks_for_general_application_approve" name="remarks_for_general_application_approve" class="form-control"
                          onblur="checkValidation('general-application-approve', 'remarks_for_general_application_approve', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-general-application-approve-remarks_for_general_application_approve"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_general_application_approve" class="btn btn-sm btn-success" onclick="GeneralApplication.listview.approveApplication();"
                    style="margin-right: 5px;"><i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Approve</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fa fa-times" style="padding-right: 4px;"></i>Close</button>
        </div>
    </div>
</form>