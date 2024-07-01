<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Reject Death Certificate Form</h3>
</div>
<form role="form" id="reject_death_certificate_form" name="reject_death_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="death_certificate_id_for_death_certificate_reject" name="death_certificate_id_for_death_certificate_reject" value="{{death_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-death-certificate-reject f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>Remarks <span style="color: red;">*</span></label>
                <textarea id="remarks_for_death_certificate_reject" name="remarks_for_death_certificate_reject" class="form-control"
                          onblur="checkValidation('death-certificate-reject', 'remarks_for_death_certificate_reject', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-death-certificate-reject-remarks_for_death_certificate_reject"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_death_certificate_reject" class="btn btn-sm btn-danger" onclick="DeathCertificate.listview.rejectApplication();"
                    style="margin-right: 5px;">Reject</button>
            <button type="button" class="btn btn-sm btn-default" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>