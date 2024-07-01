<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Approve Marriage Certificate</h3>
</div>
<form role="form" id="approve_marriage_certificate_form" name="approve_marriage_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="marriage_certificate_id_for_marriage_certificate_approve" name="marriage_certificate_id_for_marriage_certificate_approve" value="{{marriage_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-marriage-certificate-approve f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Application Number</td>
                    <td>{{application_number}}</td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Page No.  <span style="color: red;">*</span></label>
                <input type="text" id="page_no_for_marriage_certificate_approve" name="page_no_for_marriage_certificate_approve" class="form-control"
                          onblur="checkValidation('marriage-certificate-approve', 'page_no_for_marriage_certificate_approve', pageNoValidationMessage);"
                          placeholder="Enter Page No. !" maxlength="5">
                <span class="error-message error-message-marriage-certificate-approve-page_no_for_marriage_certificate_approve"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>2. Entry Number  <span style="color: red;">*</span></label>
                <input type="text" id="entry_number_for_marriage_certificate_approve" name="entry_number_for_marriage_certificate_approve" class="form-control"
                          onblur="checkValidation('marriage-certificate-approve', 'entry_number_for_marriage_certificate_approve', entryNumberValidationMessage);"
                          placeholder="Enter Entry Number !" maxlength="10">
                <span class="error-message error-message-marriage-certificate-approve-entry_number_for_marriage_certificate_approve"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>3. Registration Year  <span style="color: red;">*</span></label>
                <input type="text" id="registration_year_for_marriage_certificate_approve" name="registration_year_for_marriage_certificate_approve" class="form-control"
                          onblur="checkValidation('marriage-certificate-approve', 'registration_year_for_marriage_certificate_approve', registrationYearValidationMessage);"
                          placeholder="Enter Registration Year !" maxlength="4">
                <span class="error-message error-message-marriage-certificate-approve-registration_year_for_marriage_certificate_approve"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>4. Remarks  <span style="color: red;">*</span></label>
                <textarea id="remarks_for_marriage_certificate_approve" name="remarks_for_marriage_certificate_approve" class="form-control"
                          onblur="checkValidation('marriage-certificate-approve', 'remarks_for_marriage_certificate_approve', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-marriage-certificate-approve-remarks_for_marriage_certificate_approve"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_marriage_certificate_approve" class="btn btn-sm btn-success" onclick="MarriageCertificate.listview.approveApplication();"
                    style="margin-right: 5px;">Approve</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>