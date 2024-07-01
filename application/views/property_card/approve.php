<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Approve Application for issue of Property Card</h3>
</div>
<form role="form" id="approve_property_card_form" name="approve_property_card_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="property_card_id_for_property_card_approve" name="property_card_id_for_property_card_approve" value="{{property_card_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-property-card-approve f-w-b" style="border-bottom: 2px solid red;"></span>
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
                <textarea id="remarks_for_property_card_approve" name="remarks_for_property_card_approve" class="form-control"
                          onblur="checkValidation('property-card-approve', 'remarks_for_property_card_approve', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-property-card-approve-remarks_for_property_card_approve"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_property_card_approve" class="btn btn-sm btn-success" onclick="PropertyCard.listview.approveApplication();"
                    style="margin-right: 5px;"><i class="fas fa-file-pdf"></i> Approve</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fas fa-times"></i> &nbsp; Close</button>
        </div>
    </div>
</form>