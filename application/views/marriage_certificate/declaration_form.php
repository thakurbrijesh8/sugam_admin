<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Declaration</h3>
</div>
<form role="form" id="declaration_marriage_certificate_form" name="declaration_marriage_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="marriage_certificate_id_for_marriage_certificate_declaration" name="marriage_certificate_id_for_marriage_certificate_declaration" value="{{marriage_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-marriage-certificate-declaration f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Application Number </label>
                <input type="text" name="application_number_for_marriage_certificate_declaration"
                       id="application_number_for_marriage_certificate_declaration" class="form-control" maxlength="11"
                       placeholder="Enter Application Number" value="{{application_number}}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>2. Declaration for Marriage No. </label>
                <input type="text" name="marriage_no_for_marriage_certificate_declaration"
                       id="marriage_no_for_marriage_certificate_declaration" class="form-control" maxlength="20"
                       placeholder="Enter Declaration for Marriage No." value="{{marriage_no}}" onblur="checkValidation('marriage-certificate-declaration', 'marriage_no_for_marriage_certificate_declaration', marriageNoValidationMessage);">
                <span class="error-message error-message-marriage-certificate-declaration-marriage_no_for_marriage_certificate_declaration"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>3. Annexed hereto a certificate of residence of </label>
                <textarea name="residence_of_for_marriage_certificate_declaration"
                       id="residence_of_for_marriage_certificate_declaration" class="form-control" maxlength="100"
                       placeholder="Enter Annexed hereto a certificate of residence of" onblur="checkValidation('marriage-certificate-declaration', 'residence_of_for_marriage_certificate_declaration', residenceOfValidationMessage);">{{residence_of}}</textarea>
                <span class="error-message error-message-marriage-certificate-declaration-residence_of_for_marriage_certificate_declaration"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label>4. Declaration Date<span style="color: red;">*</span></label>
                <div class="input-group date">
                    <input type="text" name="declaration_date_for_marriage_certificate_declaration" id="declaration_date_for_marriage_certificate_declaration" class="form-control date_picker"
                            placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                            value="{{declaration_date}}"
                            onblur="checkValidation('marriage-certificate-declaration', 'declaration_date_for_marriage_certificate_declaration', dateValidationMessage);">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                </div>
                <span class="error-message error-message-marriage-certificate-declaration-declaration_date_for_marriage_certificate_declaration"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
        {{#if show_declaration_submit_btn}}
            <button type="button" class="btn btn-sm btn-success" id="submit_btn_for_marriage_certificate_declaration"
                    onclick="MarriageCertificate.listview.submitDeclarationForMarriageCertificate();"
                    style="margin-right: 5px;">Submit</button>
        {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>