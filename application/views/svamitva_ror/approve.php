<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Approve Application for issue of Svamitva RoR</h3>
</div>
<form role="form" id="approve_svamitva_ror_form" name="approve_svamitva_ror_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="svamitva_ror_id_for_svamitva_ror_approve" name="svamitva_ror_id_for_svamitva_ror_approve" value="{{svamitva_ror_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-svamitva-ror-approve f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
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
            </table>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Remarks  <span style="color: red;">*</span></label>
                <textarea id="remarks_for_svamitva_ror_approve" name="remarks_for_svamitva_ror_approve" class="form-control"
                          onblur="checkValidation('svamitva-ror-approve', 'remarks_for_svamitva_ror_approve', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-svamitva-ror-approve-remarks_for_svamitva_ror_approve"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_svamitva_ror_approve" class="btn btn-sm btn-success" onclick="SvamitvaRor.listview.approveApplication();"
                    style="margin-right: 5px;"><i class="fas fa-file-pdf"></i> Approve</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fas fa-times"></i> &nbsp; Close</button>
        </div>
    </div>
</form>