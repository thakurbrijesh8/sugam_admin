<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Approve Character Certificate Form</h3>
</div>
<form role="form" id="approve_character_certificate_form" name="approve_character_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="character_certificate_id_for_character_certificate_approve" name="character_certificate_id_for_character_certificate_approve" value="{{character_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-character-certificate-approve f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 45%;">Application Number</td>
                    <td>{{application_number}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Name of Applicant</td>
                    <td>{{applicant_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Applicant's Communication Address</td>
                    <td>{{com_addr_house_no}}, {{com_addr_house_name}}, {{com_addr_street}}, {{com_addr_village_dmc_ward}}, {{com_addr_city}}, {{com_pincode}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Applicant Permanent Address</td>
                    <td>{{per_addr_house_no}}, {{per_addr_house_name}}, {{per_addr_street}}, {{per_addr_village_dmc_ward}}, {{per_addr_city}}, {{per_pincode}}</td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">LDC Name</td>
                    <td>{{ldc_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks by LDC</td>
                    <td>{{ldc_to_mamlatdar_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{ldc_to_mamlatdar_datetime_text}}<br>
                        <b>To :</b> {{mamlatdar_name}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Mamlatdar Name</td>
                    <td>{{mamlatdar_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks by Mamlatdar</td>
                    <td>{{mamlatdar_to_sdpo_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{mamlatdar_to_sdpo_datetime_text}}<br>
                        <b>To :</b> {{sdpo_name}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">SDPO Name</td>
                    <td>{{sdpo_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Uploaded Document by SDPO</td>
                    <td>
                        <div class="form-group col-sm-12" id="inquiry_copy_name_container_for_sdpo" style="display: none;">
                            <a id="inquiry_copy_name_href_for_sdpo" target="_blank">
                                <i class="fas fa-cloud-download-alt" style="margin-right: 3px;"></i><span id="inquiry_copy_name_for_sdpo"></span>
                            </a>
                            {{#if show_remove_upload_btn}}
                            <span class="fas fa-times" style="color: red; cursor: pointer; margin-left: 3px;" id="inquiry_copy_remove_btn_for_sdpo"></span><br>
                            {{/if}}
                            <span class="error-message error-message-character-certificate-uc-inquiry_copy_name_for_sdpo"></span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Remarks  <span style="color: red;">*</span></label>
                <textarea id="remarks_for_character_certificate_approve" name="remarks_for_character_certificate_approve" class="form-control"
                          onblur="checkValidation('character-certificate-approve', 'remarks_for_character_certificate_approve', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-character-certificate-approve-remarks_for_character_certificate_approve"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_character_certificate_approve" class="btn btn-sm btn-success" onclick="CharacterCertificate.listview.approveApplication();"
                    style="margin-right: 5px;">Approve</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>