<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Reject NCL (OBC Renewal) Certificate Form</h3>
</div>
<form role="form" id="reject_ncl_certificate_form" name="reject_ncl_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="ncl_certificate_id_for_ncl_certificate_reject" name="ncl_certificate_id_for_ncl_certificate_reject" value="{{ncl_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-ncl-reject f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Application Number</td>
                    <td>{{application_number}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">{{application_type_title}} Name</td>
                    <td>{{applicant_name}}</td>
                </tr>
                {{#if show_marital_status_data}}
                <tr>
                    <td class="f-w-b">Marital Status</td>
                    <td>{{marital_status}}</td>
                </tr>
                {{/if}}
                {{#if show_minor_detail}}
                <tr>
                    <td class="f-w-b">Name of Minor Child</td>
                    <td>{{minor_child_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Relation with {{application_type_title}}</td>
                    <td>{{relationship_of_applicant_text}}</td>
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
                    <td class="f-w-b">Applicant Caste</td>
                    <td>{{obccaste_text}}</td>
                </tr>
                {{#if show_applicant_data}}
                <tr>
                    <td class="f-w-b">Applicant Annual Income</td>
                    <td>{{annual_income}} /- ( {{annual_income_text}} )</td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Family Annual Income</td>
                    <td>{{family_annual_income}} /- ( {{family_annual_income_text}} )</td>
                </tr>
                {{#if show_applicant_data}}
                <tr>
                    <td class="f-w-b">Total Annual Income</td>
                    <td>{{total_annual_income}} /- ( {{total_annual_income_text}} )</td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Query Status</td>
                    <td >{{{status}}}</td>
                </tr>
            </table>
        </div>
        {{#if show_talathi_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Talathi Name</td>
                    <td>{{talathi_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Income as per Talathi</td>
                    <td>{{income_by_talathi}} ( {{income_by_talathi_text}} )</td>
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
        {{/if}}
        {{#if show_aci_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Awal Karkun / Circle Inspector Name</td>
                    <td>{{aci_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Certificate Type</td>
                    <td>&#x25CF; {{cert_type_text}}</td>
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
        {{/if}}
        {{#if show_ldc_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">LDC Name</td>
                    <td>{{ldc_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Name of {{application_type_title}}</td>
                    <td>{{ldc_applicant_name}}</td>
                </tr>
                {{#if show_ldc_updated_minor_child_details}}
                <tr>
                    <td class="f-w-b">Updated Minor Child Name</td>
                    <td>{{ldc_minor_child_name}}</td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Updated Name of Father</td>
                    <td>{{ldc_father_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Village / Town</td>
                    <td>{{ldc_vt_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Applicant's communication Address</td>
                    <td>{{ldc_commu_address}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Caste</td>
                    <td>{{obccaste_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">OBC Certificate No.</td>
                    <td>{{obc_certificate_no}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">OBC Certificate Date</td>
                    <td>{{obc_certificate_date_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Income Certificate No.</td>
                    <td>{{income_certificate_no}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Income Certificate Date</td>
                    <td>{{income_certificate_date_text}}</td>
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
                    <td class="f-w-b">Updated Income as per Talathi</td>
                    <td>{{income_by_talathi_reverify}} ( {{income_by_talathi_reverify_text}} )</td>
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
                    <td class="f-w-b">Certificate Type</td>
                    <td>&#x25CF; {{cert_type_reverify_text}}</td>
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
                    <td class="f-w-b">Updated Name of {{application_type_title}}</td>
                    <td>{{ldc_applicant_name}}</td>
                </tr>
                {{#if show_ldc_reverify_updated_minor_child_details}}
                <tr>
                    <td class="f-w-b">Updated Minor Child Name</td>
                    <td>{{ldc_minor_child_name}}</td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Updated Name of Father</td>
                    <td>{{ldc_father_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Village / Town</td>
                    <td>{{ldc_vt_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Applicant's communication Address</td>
                    <td>{{ldc_commu_address}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Caste</td>
                    <td>{{obccaste_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">OBC Certificate No.</td>
                    <td>{{obc_certificate_no}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">OBC Certificate Date</td>
                    <td>{{obc_certificate_date_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Income Certificate No.</td>
                    <td>{{income_certificate_no}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Income Certificate Date</td>
                    <td>{{income_certificate_date_text}}</td>
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
                <label>Remarks <span style="color: red;">*</span></label>
                <textarea id="remarks_for_ncl_certificate_reject" name="remarks_for_ncl_certificate_reject" class="form-control"
                          onblur="checkValidation('ncl-reject', 'remarks_for_ncl_certificate_reject', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="1500" rows="3"></textarea>
                <span class="error-message error-message-ncl-reject-remarks_for_ncl_certificate_reject"></span>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_ncl_certificate_reject" class="btn btn-sm btn-danger" onclick="NclCertificate.listview.rejectApplication();"
                    style="margin-right: 5px;">Reject</button>
            <button type="button" class="btn btn-sm btn-default" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>