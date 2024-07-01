<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Reject General Application</h3>
</div>
<form role="form" id="reject_general_application_form" name="reject_general_application_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="general_application_id_for_general_application_reject" name="general_application_id_for_general_application_reject" value="{{general_application_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-general-application-reject f-w-b" style="border-bottom: 2px solid red;"></span>
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
                <label>1. Remarks  <span style="color: red;">*</span></label>
                <textarea id="remarks_for_general_application_reject" name="remarks_for_general_application_reject" class="form-control"
                          onblur="checkValidation('general-application-reject', 'remarks_for_general_application_reject', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-general-application-reject-remarks_for_general_application_reject"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_general_application_reject" class="btn btn-sm btn-success" onclick="GeneralApplication.listview.rejectApplication();"
                    style="margin-right: 5px;"><i class="fas fa-times-circle" style="margin-right: 2px;"></i> Reject</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fa fa-times" style="padding-right: 4px;"></i>Close</button>
        </div>
    </div>
</form>