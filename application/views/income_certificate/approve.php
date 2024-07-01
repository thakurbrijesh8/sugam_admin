<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Approve Income Certificate Form</h3>
</div>
<form role="form" id="approve_income_certificate_form" name="approve_income_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="income_certificate_id_for_income_certificate_approve" name="income_certificate_id_for_income_certificate_approve" value="{{income_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-income-certificate-approve f-w-b" style="border-bottom: 2px solid red;"></span>
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
                    <td>{{communication_address}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Total Income Entered by User</td>
                    <td>{{total_income}} ( {{total_income_by_user_text}} )</td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Talathi Name</td>
                    <td>{{talathi_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Income by Talathi</td>
                    <td>{{income_by_talathi}} ( {{total_income_by_talathi_text}} )</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks by Talathi</td>
                    <td>{{talathi_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{talathi_to_aci_datetime_text}}<br>
                        <b>To :</b> {{aci_name}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Awal Karkun / Circle Inspector Name</td>
                    <td>{{aci_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Recommendation</td>
                    <td>&#x25CF; {{aci_rec_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks by Awal Karkun / Circle Inspector</td>
                    <td>{{aci_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{act_to_mamlatdar_ldc_datetime_text}}<br>
                        <b>To :</b> {{act_to_mamlatdar_ldc_name_text}}
                    </td>
                </tr>
            </table>
        </div>
        {{#if show_ldc_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">LDC Name</td>
                    <td>{{ldc_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Name of Applicant</td>
                    <td>{{ldc_applicant_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Applicant's communication Address</td>
                    <td>{{communication_address}}</td>
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
        {{/if}}
        {{#if show_mam_reverify_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b text-orange" colspan="2">Reverification</td>
                </tr>
                <tr>
                    <td class="f-w-b" style="width: 40%;">Mamlatdar Name</td>
                    <td>{{mamlatdar_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks by Mamlatdar</td>
                    <td>{{mam_reverify_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{mam_to_reverify_datetime_text}}<br>
                        <b>To :</b> {{mam_reverification}}
                    </td>
                </tr>
            </table>
        </div>
        {{/if}}
        {{#if show_talathi_reverify_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b text-orange" colspan="2">Reverification</td>
                </tr>
                <tr>
                    <td class="f-w-b" style="width: 40%;">Talathi Name</td>
                    <td>{{talathi_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Income by Talathi</td>
                    <td>{{income_by_talathi_reverify}} ( {{total_income_by_talathi_reverify_text}} )</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks by Talathi</td>
                    <td>{{talathi_reverify_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{talathi_to_reverify_datetime_text}}<br>
                        <b>To :</b> {{talathi_reverification}}
                    </td>
                </tr>
            </table>
        </div>
        {{/if}}
        {{#if show_aci_reverify_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b text-orange" colspan="2">Reverification</td>
                </tr>
                <tr>
                    <td class="f-w-b" style="width: 40%;">Awal Karkun / Circle Inspector Name</td>
                    <td>{{aci_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Recommendation</td>
                    <td>&#x25CF; {{aci_rec_reverify_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks by Awal Karkun / Circle Inspector</td>
                    <td>{{aci_reverify_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{act_to_mamlatdar_ldc_reverify_datetime_text}}<br>
                        <b>To :</b> {{act_to_mamlatdar_ldc_reverify_name_text}}
                    </td>
                </tr>
            </table>
        </div>
        {{/if}}
        {{#if show_ldc_reverify_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b text-orange" colspan="2">Reverification</td>
                </tr>
                <tr>
                    <td class="f-w-b" style="width: 40%;">LDC Name</td>
                    <td>{{ldc_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Name of Applicant</td>
                    <td>{{ldc_applicant_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Applicant's communication Address</td>
                    <td>{{communication_address}}</td>
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
        {{/if}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Remarks  <span style="color: red;">*</span></label>
                <textarea id="remarks_for_income_certificate_approve" name="remarks_for_income_certificate_approve" class="form-control"
                          onblur="checkValidation('income-certificate-approve', 'remarks_for_income_certificate_approve', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-income-certificate-approve-remarks_for_income_certificate_approve"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_income_certificate_approve" class="btn btn-sm btn-success" onclick="IncomeCertificate.listview.approveApplication();"
                    style="margin-right: 5px;">Approve</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>