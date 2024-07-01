{{#if show_card}}
<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">{{title}}</h3>
</div>
{{/if}}
<form role="form" id="update_basic_detail_ncl_certificate_form" name="update_basic_detail_ncl_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="ncl_certificate_id_for_ncl_certificate_update_basic_detail" name="ncl_certificate_id_for_ncl_certificate_update_basic_detail" value="{{ncl_certificate_id}}">
    <input type="hidden" id="talathi_name_for_ncl_certificate_update_basic_detail" name="talathi_name_for_ncl_certificate_update_basic_detail" value="{{talathi_name}}">
    <input type="hidden" id="aci_name_for_ncl_certificate_update_basic_detail" name="aci_name_for_ncl_update_basic_detail" value="{{aci_name}}">
    <input type="hidden" id="mamlatdar_name_for_ncl_certificate_update_basic_detail" name="mamlatdar_name_for_ncl_certificate_update_basic_detail" value="{{mamlatdar_name}}">
    {{#if show_card}}
    <div class="card-body p-b-0px text-left">
        {{/if}}
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-ncl-certificate-update-basic-detail f-w-b" style="border-bottom: 2px solid red;"></span>
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
            </table>
        </div>
        {{#if show_talathi_enter_basic_details}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Enter Family Income by Talathi</label>
                <input type="hidden" id="income_by_user_for_ncl_certificate" value="{{family_annual_income}}" />
                <input type="text" name="income_by_talathi_for_ncl_certificate" id="income_by_talathi_for_ncl_certificate" class="form-control"
                       onkeyup="numberToWord('income_by_talathi_for_ncl_certificate', 'income_into_word_for_ncl_certificate'); checkNumeric($(this)); changeBorderColor('income_by_talathi', 'ncl_certificate', 'income_by_user');" maxlength="11" onblur="checkNumeric($(this));"
                       placeholder="Enter Year !" value="{{income_by_talathi}}">
                <span id="income_into_word_for_ncl_certificate" class="f-w-b color-nic-blue text-capitalize"></span>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-income_by_talathi_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>2. Upload Field Verification Document <span style="color: red;">*</span></label>
                <div id="upload_verification_document_container_for_ncl_certificate"></div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-upload_verification_document_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row" id="field_verification_document_uploads_container_for_ncl_certificate" style="display: none">
            <div class="col-md-12">
                <div class="card bg-beige">
                    <div class="card-header">
                        <h3 class="card-title f-w-b f-s-14px">
                            <span class="drsone-cnt"></span><span style="color: red;">*(Maximum File Size: 2MB) (Upload JPG, JPEG, PNG, PDF Only)</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-center" style="width: 30px;">No.</th>
                                        <th class="text-center" style="min-width: 165px;">Document Name</th>
                                        <th class="text-center" style="min-width: 165px;">Document</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="upload_verification_doc_item_container_for_ncl_certificate_{{VALUE_ONE}}" class="bg-white"></tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-nic-blue btn-sm pull-right"
                                onclick="NclCertificate.listview.addVerificationDocItem({},{{VALUE_ONE}});">Add More Documents</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>3. Remarks <span style="color: red;">*</span></label>
                <textarea id="talathi_remarks_for_ncl_certificate" name="talathi_remarks_for_ncl_certificate" class="form-control"
                          onblur="checkValidation('ncl-certificate-update-basic-detail', 'talathi_remarks_for_ncl_certificate', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{talathi_remarks}}</textarea>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-talathi_remarks_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>4. Forwarded to Awal Karkun / Circle Inspector  <span style="color: red;">*</span></label>
                <select id="talathi_to_aci_for_ncl_certificate" name="talathi_to_aci_for_ncl_certificate"
                        onchange="checkValidation('ncl-certificate-update-basic-detail', 'talathi_to_aci_for_ncl_certificate', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forwarded to Awal Karkun / Circle Inspector">
                    <option value="">Select Any Awal Karkun / Circle Inspector</option>
                </select>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-talathi_to_aci_for_ncl_certificate"></span>
            </div>
        </div>
        {{/if}}
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
                <tr class="field_varification_doc_title">
                    <td colspan="2" class="f-w-b">Field Verification Documents</td>
                </tr>
                <tr class="bg-white field_varification_doc_tbl">
                    <td colspan="2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-padding mb-0">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="f-w-b text-center" style="width: 10%;">Sr. No.</th>
                                        <th class="f-w-b text-center">Document Name</th>
                                        <th class="f-w-b text-center">Document</th>
                                    </tr>
                                </thead>
                                <tbody id="document_item_container_for_field_verification_view_{{VALUE_ONE}}"></tbody>
                            </table>
                        </div>
                    </td>
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
        {{#if show_aci_enter_basic_details}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Certificate Type <span style="color: red;">*</span></label>
                <div id="cert_type_container_for_ncl_certificate"></div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-cert_type_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>2. Recommendation of Awal Karkun / Circle Inspector <span style="color: red;">*</span></label>
                <div id="aci_rec_container_for_ncl_certificate"></div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-aci_rec_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>3. Remarks <span style="color: red;">*</span></label>
                <textarea id="aci_remarks_for_ncl_certificate" name="aci_remarks_for_ncl_certificate" class="form-control"
                          onblur="checkValidation('ncl-certificate-update-basic-detail', 'aci_remarks_for_ncl_certificate', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{aci_remarks}}</textarea>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-aci_remarks_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12" id="aci_to_mamlatdar_container_for_ncl_certificate" style="display: none;">
                <label>4. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <select id="aci_to_mamlatdar_for_ncl_certificate" name="aci_to_mamlatdar_for_ncl_certificate"
                        onchange="checkValidation('ncl-certificate-update-basic-detail', 'aci_to_mamlatdar_for_ncl_certificate', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to Mamlatdar">
                    <option value="">Select Any Mamlatdar</option>
                </select>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-aci_to_mamlatdar_for_ncl_certificate"></span>
            </div>

            <div class="form-group col-sm-12" id="aci_to_ldc_container_for_ncl_certificate" style="display: none;">
                <label>4. Forward to LDC<span style="color: red;">*</span></label>
                <select id="aci_to_ldc_for_ncl_certificate" name="aci_to_ldc_for_ncl_certificate"
                        onchange="checkValidation('ncl-certificate-update-basic-detail', 'aci_to_ldc_for_ncl_certificate', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to LDC">
                    <option value="">Select Any LDC</option>
                </select>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-aci_to_ldc_for_ncl_certificate"></span>
            </div>
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
        {{#if show_ldc_enter_basic_details}}
        <input type="hidden" id="constitution_artical_for_ncl_certificate" name="constitution_artical_for_ncl_certificate" value="{{constitution_artical}}"/>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Update Name of {{application_type_title}} (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_applicant_name_for_ncl_certificate" name="ldc_applicant_name_for_ncl_certificate" class="form-control" placeholder="Update Name of {{application_type_title}} !"
                       maxlength="100" onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_applicant_name_for_ncl_certificate', applicantNameValidationMessage);" value="{{ldc_app_name}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_applicant_name_for_ncl_certificate"></span>
            </div>
            {{#if show_ldc_enter_minor_child_details}}
            <div class="form-group col-sm-12">
                <label>1.1 Update Name of Minor Child (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_minor_child_name_for_ncl_certificate" name="ldc_minor_child_name_for_ncl_certificate" class="form-control" placeholder="Update Name of Minor Child !"
                       maxlength="100" onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_minor_child_name_for_ncl_certificate', minorChildNameValidationMessage);" value="{{ldc_mc_name}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_minor_child_name_for_ncl_certificate"></span>
            </div>
            {{/if}}
            <div class="form-group col-sm-12">
                <label>2. Update Name of Father (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_father_name_for_ncl_certificate" name="ldc_father_name_for_ncl_certificate" class="form-control" placeholder="Update Name of Father !"
                       maxlength="100" onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_father_name_for_ncl_certificate', fatherNameValidationMessage);" value="{{ldc_fname}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_father_name_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>3.1 Update Village / Town (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_vt_name_for_ncl_certificate" name="ldc_vt_name_for_ncl_certificate" class="form-control" placeholder="Update Village / Town !"
                       maxlength="100" onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_vt_name_for_ncl_certificate', detailValidationMessage);" value="{{ldc_vt}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_vt_name_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>3.2 Update Applicant's Communication Address (If Required) <span class="color-nic-red">*</span></label>
                <textarea id="ldc_commu_address_for_ncl_certificate" name="ldc_commu_address_for_ncl_certificate" class="form-control"
                          placeholder="Enter Communication Address !"
                          onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_commu_address_for_ncl_certificate', communicationAddressValidationMessage);"
                          maxlength="300">{{ldc_commu_address}}</textarea>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_commu_address_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>4.Select Caste <span class="color-nic-red">*</span></label>
                <select id="obccaste_for_ncl_certificate" name="obccaste_for_ncl_certificate" class="form-control" 
                        onchange="checkValidation('ncl-certificate-update-basic-detail', 'obccaste_for_ncl_certificate', oneOptionValidationMessage);">
                    <option value="">Select Caste</option>
                </select>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-obccaste_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 ">
                <label>5.1 OBC Certificate No. <span class="color-nic-red">*</span></label>
                <input type="text" id="obc_certificate_no_for_ncl_certificate" name="obc_certificate_no_for_ncl_certificate" class="form-control"
                       onblur="checkValidation('ncl-certificate-update-basic-detail', 'obc_certificate_no_for_ncl_certificate', numberValidationMessage);"
                       placeholder="OBC Certificate No. !" maxlength="100" value="{{obc_certificate_no}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-obc_certificate_no_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-6">
                <label>5.2 OBC Certificate Date <span class="color-nic-red">*</span></label>
                <div class="input-group date date_picker">
                    <input type="text" class="form-control date_picker" name="obc_certificate_date_for_ncl_certificate" 
                           id="obc_certificate_date_for_ncl_certificate" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY"
                           onblur="checkValidation('ncl-certificate-update-basic-detail', 'obc_certificate_no_for_ncl_certificate', dateValidationMessage);"
                           value="{{obc_certificate_date_text}}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                </div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-obc_certificate_date_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 ">
                <label>6.1 Income Certificate No.<span class="color-nic-red">*</span></label>
                <input type="text" id="income_certificate_no_for_ncl_certificate" name="income_certificate_no_for_ncl_certificate" class="form-control"
                       onblur="checkValidation('ncl-certificate-update-basic-detail', 'obc_certificate_no_for_ncl_certificate', numberValidationMessage);"
                       placeholder="Income Certificate No. !" maxlength="100" value="{{income_certificate_no}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-income_certificate_no_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-6 ">
                <label>6.2 Income Certificate Date<span class="color-nic-red">*</span></label>
                <div class="input-group date date_picker">
                    <input type="text" class="form-control date_picker" name="income_certificate_date_for_ncl_certificate" 
                           id="income_certificate_date_for_ncl_certificate" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY"
                           onblur="checkValidation('ncl-certificate-update-basic-detail', 'obc_certificate_no_for_ncl_certificate', dateValidationMessage);"
                           value="{{income_certificate_date_text}}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                </div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-income_certificate_date_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>7. Remarks <span style="color: red;">*</span></label>
                <textarea id="ldc_to_mamlatdar_remarks_for_ncl_certificate" name="ldc_to_mamlatdar_remarks_for_ncl_certificate" class="form-control"
                          onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_to_mamlatdar_remarks_for_ncl_certificate', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{ldc_to_mamlatdar_remarks}}</textarea>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>8. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <select id="ldc_to_mamlatdar_for_ncl_certificate" name="ldc_to_mamlatdar_for_ncl_certificate"
                        onchange="checkValidation('ncl-certificate-update-basic-detail', 'ldc_to_mamlatdar_for_ncl_certificate', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to Mamlatdar">
                    <option value="">Select Any Mamlatdar</option>
                </select>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_to_mamlatdar_for_ncl_certificate"></span>
            </div>
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
        {{#if show_mam_reverify_enter_basic_details}}
        <div class="row">
            <div class="form-group col-sm-12 col-md-6">
                <label>1. Forward for Reverification <span style="color: red;">*</span></label>
                <div id="to_type_reverify_container_for_ncl_certificate"></div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-to_type_reverify_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>2. Remarks <span style="color: red;">*</span></label>
                <textarea id="mam_reverify_remarks_for_ncl_certificate" name="mam_reverify_remarks_for_ncl_certificate" class="form-control"
                          onblur="checkValidation('ncl-certificate-update-basic-detail', 'mam_reverify_remarks_for_ncl_certificate', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="200"></textarea>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-mam_reverify_remarks_for_ncl_certificate"></span>
            </div>
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
        {{#if show_talathi_reverify_enter_basic_details}}
        <div class="row">
            <div class="form-group col-sm-12 col-md-6">
                <label>1. Forward for Reverification <span style="color: red;">*</span></label>
                <div id="talathi_to_type_reverify_container_for_ncl_certificate"></div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-talathi_to_type_reverify_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>2. Update Income as per Talathi </label>
                <input type="hidden" id="income_by_user_for_ncl_certificate" value="{{family_annual_income}}" />
                <input type="text" name="income_by_talathi_reverify_for_ncl_certificate"
                       id="income_by_talathi_reverify_for_ncl_certificate" class="form-control" maxlength="11"
                       onkeyup="checkNumeric($(this)); changeBorderColor('income_by_talathi_reverify', 'ncl_certificate', 'income_by_user');" onblur="checkNumeric($(this));"
                       placeholder="Update Income" value="{{income_by_talathi_reverify}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-income_by_talathi_reverify_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>3. Upload Field Verification Document <span style="color: red;">*</span></label>
                <div id="upload_reverification_document_container_for_ncl_certificate"></div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-upload_reverification_document_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row" id="field_reverification_document_uploads_container_for_ncl_certificate" style="display: none">
            <div class="col-md-12">
                <div class="card bg-beige">
                    <div class="card-header">
                        <h3 class="card-title f-w-b f-s-14px">
                            <span class="drsone-cnt"></span><span style="color: red;">*(Maximum File Size: 2MB) (Upload JPG, JPEG, PNG, PDF Only)</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-center" style="width: 30px;">No.</th>
                                        <th class="text-center" style="min-width: 165px;">Document Name</th>
                                        <th class="text-center" style="min-width: 165px;">Document</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="upload_verification_doc_item_container_for_ncl_certificate_{{VALUE_TWO}}" class="bg-white"></tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-nic-blue btn-sm pull-right"
                                onclick="NclCertificate.listview.addVerificationDocItem({},{{VALUE_TWO}});">Add More Documents</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>4. Remarks <span style="color: red;">*</span></label>
                <textarea id="talathi_reverify_remarks_for_ncl_certificate" name="talathi_reverify_remarks_for_ncl_certificate" class="form-control"
                          onblur="checkValidation('ncl-certificate-update-basic-detail', 'talathi_reverify_remarks_for_ncl_certificate', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="200"></textarea>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-talathi_reverify_remarks_for_ncl_certificate"></span>
            </div>
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
                <tr class="field_revarification_doc_title">
                    <td colspan="2" class="f-w-b">Field Verification Documents</td>
                </tr>
                <tr class="bg-white field_revarification_doc_tbl">
                    <td colspan="2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-padding mb-0">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="f-w-b text-center" style="width: 10%;">Sr. No.</th>
                                        <th class="f-w-b text-center">Document Name</th>
                                        <th class="f-w-b text-center">Document</th>
                                    </tr>
                                </thead>
                                <tbody id="document_item_container_for_field_verification_view_{{VALUE_TWO}}"></tbody>
                            </table>
                        </div>
                    </td>
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
        {{#if show_aci_reverify_enter_basic_details}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Certificate Type <span style="color: red;">*</span></label>
                <div id="cert_type_reverify_container_for_ncl_certificate"></div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-cert_type_reverify_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>2. Recommendation of Awal Karkun / Circle Inspector <span style="color: red;">*</span></label>
                <div id="aci_rec_reverify_container_for_ncl_certificate"></div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-aci_rec_reverify_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>3. Remarks <span style="color: red;">*</span></label>
                <textarea id="aci_reverify_remarks_for_ncl_certificate" name="aci_reverify_remarks_for_ncl_certificate" class="form-control"
                          onblur="checkValidation('ncl-certificate-update-basic-detail', 'aci_reverify_remarks_for_ncl_certificate', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="200"></textarea>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-aci_reverify_remarks_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12" id="aci_to_mamlatdar_reverify_container_for_ncl_certificate" style="display: none;">
                <label>4. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <div id="aci_to_type_reverify_container_for_ncl_certificate"></div>
                <span class="error-message error-message-ncl-certificate-update-basic-aci_to_type_reverify_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12" id="aci_to_ldc_reverify_container_for_ncl_certificate" style="display: none;">
                <label>4. Forward to LDC <span style="color: red;">*</span></label>
                <select id="aci_to_ldc_reverify_for_ncl_certificate" name="aci_to_ldc_reverify_for_ncl_certificate"
                        onchange="checkValidation('ncl-certificate-update-basic-detail', 'aci_to_ldc_reverify_for_ncl_certificate', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to LDC">
                    <option value="">Select Any LDC</option>
                </select>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-aci_to_ldc_reverify_for_ncl_certificate"></span>
            </div>
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
                        <b>Date Time :</b> {{aci_to_reverify_datetime_text}}<br>
                        <b>To :</b> {{mamlatdar_name}}
                    </td>
                </tr>
            </table>
        </div>
        {{/if}}
        {{#if show_ldc_reverify_enter_basic_details}}
        <input type="hidden" id="constitution_artical_for_ncl_certificate" name="constitution_artical_for_ncl_certificate" value="{{constitution_artical}}"/>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Update Name of {{application_type_title}} (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_applicant_name_for_ncl_certificate" name="ldc_applicant_name_for_ncl_certificate" class="form-control" placeholder="Update Name of {{application_type_title}} !"
                       maxlength="100" onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_applicant_name_for_ncl_certificate', applicantNameValidationMessage);" value="{{ldc_app_name}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_applicant_name_for_ncl_certificate"></span>
            </div>
            {{#if show_ldc_reverify_enter_minor_child_details}}
            <div class="form-group col-sm-12">
                <label>1.1 Update Name of Minor Child (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_minor_child_name_for_ncl_certificate" name="ldc_minor_child_name_for_ncl_certificate" class="form-control" placeholder="Update Name of Minor Child !"
                       maxlength="100" onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_minor_child_name_for_ncl_certificate', minorChildNameValidationMessage);" value="{{ldc_mc_name}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_minor_child_name_for_ncl_certificate"></span>
            </div>
            {{/if}}
            <div class="form-group col-sm-12">
                <label>2. Update Name of Father (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_father_name_for_ncl_certificate" name="ldc_father_name_for_ncl_certificate" class="form-control" placeholder="Update Name of Father !"
                       maxlength="100" onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_father_name_for_ncl_certificate', fatherNameValidationMessage);" value="{{ldc_fname}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_father_name_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>3.1 Update Village / Town (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_vt_name_for_ncl_certificate" name="ldc_vt_name_for_ncl_certificate" class="form-control" placeholder="Update Village / Town !"
                       maxlength="100" onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_vt_name_for_ncl_certificate', detailValidationMessage);" value="{{ldc_vt}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_vt_name_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>3.2 Update Applicant's Communication Address (If Required) <span class="color-nic-red">*</span></label>
                <textarea id="ldc_commu_address_for_ncl_certificate" name="ldc_commu_address_for_ncl_certificate" class="form-control"
                          placeholder="Enter Communication Address !"
                          onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_commu_address_for_ncl_certificate', communicationAddressValidationMessage);"
                          maxlength="300">{{ldc_commu_address}}</textarea>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_commu_address_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>4.Select Caste <span class="color-nic-red">*</span></label>
                <select id="obccaste_for_ncl_certificate" name="obccaste_for_ncl_certificate" class="form-control" 
                        onchange="checkValidation('ncl-certificate-update-basic-detail', 'obccaste_for_ncl_certificate', oneOptionValidationMessage);">
                    <option value="">Select Caste</option>
                </select>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-obccaste_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 ">
                <label>5.1 OBC Certificate No. <span class="color-nic-red">*</span></label>
                <input type="text" id="obc_certificate_no_for_ncl_certificate" name="obc_certificate_no_for_ncl_certificate" class="form-control"
                       onblur="checkValidation('ncl-certificate-update-basic-detail', 'obc_certificate_no_for_ncl_certificate', numberValidationMessage);"
                       placeholder="OBC Certificate No. !" maxlength="100" value="{{obc_certificate_no}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-obc_certificate_no_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-6">
                <label>5.2 OBC Certificate Date <span class="color-nic-red">*</span></label>
                <div class="input-group date date_picker">
                    <input type="text" class="form-control date_picker" name="obc_certificate_date_for_ncl_certificate" 
                           id="obc_certificate_date_for_ncl_certificate" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY"
                           onblur="checkValidation('ncl-certificate-update-basic-detail', 'obc_certificate_no_for_ncl_certificate', dateValidationMessage);"
                           value="{{obc_certificate_date_text}}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                </div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-obc_certificate_date_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 ">
                <label>6.1 Income Certificate No.<span class="color-nic-red">*</span></label>
                <input type="text" id="income_certificate_no_for_ncl_certificate" name="income_certificate_no_for_ncl_certificate" class="form-control"
                       onblur="checkValidation('ncl-certificate-update-basic-detail', 'obc_certificate_no_for_ncl_certificate', numberValidationMessage);"
                       placeholder="Income Certificate No. !" maxlength="100" value="{{income_certificate_no}}">
                <span class="error-message error-message-ncl-certificate-update-basic-detail-income_certificate_no_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-6 ">
                <label>6.2 Income Certificate Date<span class="color-nic-red">*</span></label>
                <div class="input-group date date_picker">
                    <input type="text" class="form-control date_picker" name="income_certificate_date_for_ncl_certificate" 
                           id="income_certificate_date_for_ncl_certificate" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY"
                           onblur="checkValidation('ncl-certificate-update-basic-detail', 'obc_certificate_no_for_ncl_certificate', dateValidationMessage);"
                           value="{{income_certificate_date_text}}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                </div>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-income_certificate_date_for_ncl_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>7. Remarks <span style="color: red;">*</span></label>
                <textarea id="ldc_to_mamlatdar_remarks_for_ncl_certificate" name="ldc_to_mamlatdar_remarks_for_ncl_certificate" class="form-control"
                          onblur="checkValidation('ncl-certificate-update-basic-detail', 'ldc_to_mamlatdar_remarks_for_ncl_certificate', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{ldc_to_mamlatdar_remarks}}</textarea>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>8. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <select id="ldc_to_mamlatdar_for_ncl_certificate" name="ldc_to_mamlatdar_for_ncl_certificate"
                        onchange="checkValidation('ncl-certificate-update-basic-detail', 'ldc_to_mamlatdar_for_ncl_certificate', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to Mamlatdar">
                    <option value="">Select Any Mamlatdar</option>
                </select>
                <span class="error-message error-message-ncl-certificate-update-basic-detail-ldc_to_mamlatdar_for_ncl_certificate"></span>
            </div>
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
        {{#if show_approve_reject_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Action By</td>
                    <td>{{actioner_user_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Action</td>
                    <td>{{{status_text}}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks</td>
                    <td>{{remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Action Date Time :</b> {{status_datetime_text}}<br>
                    </td>
                </tr>
            </table>
        </div>
        {{/if}}
        <hr class="m-b-1rem">
        <div class="form-group">
            {{#if show_ldc_draft_btn}}
            <button type="button" class="btn btn-sm btn-nic-blue"
                    onclick="NclCertificate.listview.submitBasicDetail($(this), true);"
                    style="margin-right: 5px;">Draft</button>
            {{/if}}
            {{#if show_submit_btn}}
            <button type="button" class="btn btn-sm btn-success"
                    onclick="NclCertificate.listview.submitBasicDetail($(this));"
                    style="margin-right: 5px;">
                        <?php echo is_admin() ? 'Submit' : 'Forward'; ?>
            </button>
            {{/if}}
            {{#if show_reverify_submit_btn}}
            <button type="button" class="btn btn-sm btn-success" onclick="NclCertificate.listview.reverifyApplication($(this));"
                    style="margin-right: 5px;">Forward</button>
            {{/if}}
            {{#if show_card}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
            {{else}}
            <button type="button" class="btn btn-sm btn-danger" onclick="resetModelMD()">Close</button>
            {{/if}}
        </div>
        {{#if show_card}}
    </div>
    {{/if}}
</form>