<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Approve Application for issue of Form No. I & XIV</h3>
</div>
<form role="form" id="approve_form_one_fourteen_form" name="approve_form_one_fourteen_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="form_one_fourteen_id_for_form_one_fourteen_approve" name="form_one_fourteen_id_for_form_one_fourteen_approve" value="{{form_one_fourteen_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-form-one-fourteen-approve f-w-b" style="border-bottom: 2px solid red;"></span>
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
                    <td>{{applicant_name}} {{father_name}} {{surname}}</td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Remarks  <span style="color: red;">*</span></label>
                <textarea id="remarks_for_form_one_fourteen_approve" name="remarks_for_form_one_fourteen_approve" class="form-control"
                          onblur="checkValidation('form-one-fourteen-approve', 'remarks_for_form_one_fourteen_approve', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-form-one-fourteen-approve-remarks_for_form_one_fourteen_approve"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_form_one_fourteen_approve" class="btn btn-sm btn-success" onclick="FormOneFourteen.listview.approveApplication();"
                    style="margin-right: 5px;">Approve</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>