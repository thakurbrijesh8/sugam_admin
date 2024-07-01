
<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Approve Domicile Certificate Form</h3>
</div>
<form role="form" id="approve_domicile_form" name="approve_domicile_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="domicile_id_for_domicile_approve" name="domicile_id_for_domicile_approve" value="{{domicile_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-centre">
                <span class="error-message error-message-domicile-approve f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Application Number</td>
                    <td>{{application_number}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">{{applicant_name_title}}</td>
                    <td>{{name_of_applicant}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Marital Status</td>
                    <td>{{marital_status}}</td>
                </tr>
                {{#if show_minor_detail}}
                <tr>
                    <td class="f-w-b">Name of Minor Child</td>
                    <td>{{minor_child_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Relation with Applicant</td>
                    <td>{{relationship_of_applicant}}</td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Applicant Communication Address</td>
                    <td>{{com_addr_house_no}}, {{com_addr_house_name}}, {{com_addr_street}}, {{com_addr_village_dmc_ward}}, {{com_addr_city}}, {{com_pincode}}</td>
                </tr>
                {{#if show_permanent_adder}}
                <tr>
                    <td class="f-w-b">Applicant Permanent Address</td>
                    <td>{{per_addr_house_no}}, {{per_addr_house_name}}, {{per_addr_street}}, {{per_addr_village_dmc_ward}}, {{per_addr_city}}, {{per_pincode}}</td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Period of Resident</td>
                    <td>{{residing_year}}{{resident_total_period}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Purpose for Certificate</td>
                    <td>{{required_purpose}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Query Status</td>
                    <td >{{{status}}}</td>
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
                    <td class="f-w-b">Applicant Residing Since Year as per Talathi</td>
                    <td>{{residing_year_as_per_talathi}}</td>
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
                    <td class="f-w-b">Applicant Residing Since Year as per Awal Karkun / Circle Inspector</td>
                    <td>{{residing_year_as_per_ci}}</td>
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
                    <td class="f-w-b">Updated {{applicant_name_title}}</td>
                    <td>{{ldc_applicant_name}}</td>
                </tr>
                {{#if show_ldc_updated_minor_child_details}}
                <tr>
                    <td class="f-w-b">Updated Minor Child Name</td>
                    <td>{{ldc_minor_child_name}}</td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Updated Father Name</td>
                    <td>{{ldc_father_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Applicant's communication Address</td>
                    <td>{{ldc_commu_address}}</td>
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
                    <td class="f-w-b">Updated Residing Since Year as per Talathi<</td>
                    <td>{{residing_year_as_per_talathi}}</td>
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
                    <td class="f-w-b">Updated {{applicant_name_title}}</td>
                    <td>{{ldc_applicant_name}}</td>
                </tr>
                {{#if show_ldc_reverify_updated_minor_child_details}}
                <tr>
                    <td class="f-w-b">Updated Minor Child Name</td>
                    <td>{{ldc_minor_child_name}}</td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Updated Applicant's communication Address</td>
                    <td>{{ldc_commu_address}}</td>
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
                <textarea id="remarks_for_domicile_certificate_approve" name="remarks_for_domicile_certificate_approve" class="form-control"
                          onblur="checkValidation('domicile-approve', 'remarks_for_domicile_certificate_approve', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-domicile-approve-remarks_for_domicile_certificate_approve"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_domicile_certificate_approve" class="btn btn-sm btn-success" onclick="Domicile.listview.approveApplication();"
                    style="margin-right: 5px;">Approve</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>