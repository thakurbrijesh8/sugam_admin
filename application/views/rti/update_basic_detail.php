<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">{{title}}</h3>
</div>
<form role="form" id="update_basic_detail_rti_form" name="update_basic_detail_rti_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="rti_id_for_rti_update_basic_detail" name="rti_id_for_rti_update_basic_detail" value="{{rti_id}}">
    <input type="hidden" id="talathi_name_for_rti_update_basic_detail" name="talathi_name_for_rti_update_basic_detail" value="{{talathi_name}}">
    <input type="hidden" id="aci_name_for_rti_update_basic_detail" name="aci_name_for_rti_update_basic_detail" value="{{aci_name}}">
    <input type="hidden" id="mamlatdar_name_for_rti_update_basic_detail" name="mamlatdar_name_for_rti_update_basic_detail" value="{{mamlatdar_name}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-rti-update-basic-detail f-w-b" style="border-bottom: 2px solid red;"></span>
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
                    <td>{{applicant_address}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Query Status</td>
                    <td >{{{status}}}</td>
                </tr>
            </table>
        </div>
        {{#if show_talathi_enter_basic_details}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Remarks <span style="color: red;">*</span></label>
                <textarea id="talathi_remarks_for_rti" name="talathi_remarks_for_rti" class="form-control"
                          onblur="checkValidation('rti-update-basic-detail', 'talathi_remarks_for_rti', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{talathi_remarks}}</textarea>
                <span class="error-message error-message-rti-update-basic-detail-talathi_remarks_for_rti"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>2. Forwarded to Awal Karkun / Circle Inspector  <span style="color: red;">*</span></label>
                <select id="talathi_to_aci_for_rti" name="talathi_to_aci_for_rti"
                        onchange="checkValidation('rti-update-basic-detail', 'talathi_to_aci_for_rti', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forwarded to Awal Karkun / Circle Inspector">
                    <option value="">Select Any Awal Karkun / Circle Inspector</option>
                </select>
                <span class="error-message error-message-rti-update-basic-detail-talathi_to_aci_for_rti"></span>
            </div>
        </div>
        {{/if}}
        {{#if show_talathi_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Talathi Name</td>
                    <td>{{aci_name}}</td>
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
                <label>1. Recommendation of Awal Karkun / Circle Inspector <span style="color: red;">*</span></label>
                <div id="aci_rec_container_for_rti"></div>
                <span class="error-message error-message-rti-update-basic-detail-aci_rec_for_rti"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>2 Remarks <span style="color: red;">*</span></label>
                <textarea id="aci_remarks_for_rti" name="aci_remarks_for_rti" class="form-control"
                          onblur="checkValidation('rti-update-basic-detail', 'aci_remarks_for_rti', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{aci_remarks}}</textarea>
                <span class="error-message error-message-rti-update-basic-detail-aci_remarks_for_rti"></span>
            </div>
            <div class="form-group col-sm-12" id="aci_to_mamlatdar_container_for_rti" style="display: none;">
                <label>3. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <select id="aci_to_mamlatdar_for_rti" name="aci_to_mamlatdar_for_rti"
                        onchange="checkValidation('rti-update-basic-detail', 'aci_to_mamlatdar_for_rti', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to Mamlatdar">
                    <option value="">Select Any Mamlatdar</option>
                </select>
                <span class="error-message error-message-rti-update-basic-detail-aci_to_mamlatdar_for_rti"></span>
            </div>
            <div class="form-group col-sm-12" id="aci_to_ldc_container_for_rti" style="display: none;">
                <label>3. Forward to LDC <span style="color: red;">*</span></label>
                <select id="aci_to_ldc_for_rti" name="aci_to_ldc_for_rti"
                        onchange="checkValidation('rti-update-basic-detail', 'aci_to_ldc_for_rti', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to LDC">
                    <option value="">Select Any LDC</option>
                </select>
                <span class="error-message error-message-rti-update-basic-detail-aci_to_ldc_for_rti"></span>
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
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Update Name of Applicant (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_applicant_name_for_rti" name="ldc_applicant_name_for_rti" class="form-control" placeholder="Update Name of Applicant !"
                       maxlength="100" onblur="checkValidation('rti-update-basic-detail', 'ldc_applicant_name_for_rti', applicantNameValidationMessage);" value="{{applicant_name}}">
                <span class="error-message error-message-rti-update-basic-detail-ldc_applicant_name_for_rti"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>2. Update Applicant's Communication Address (If Required) <span class="color-nic-red">*</span></label>
            </div>
            <div class="form-group col-sm-4">
                <label>2.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_house_no_for_rti" name="pre_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{pre_house_no}}" onblur="checkValidation('rti', 'pre_house_no_for_rti', houseNoValidationMessage);" style="margin-top: 18px;">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_house_no_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_house_name_for_rti" name="pre_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{pre_house_name}}" onblur="checkValidation('rti', 'pre_house_name_for_rti', houseNameValidationMessage);">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_house_name_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.3 Street <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_street_for_rti" name="pre_street" class="form-control" placeholder="Enter Street !"
                           maxlength="100" onblur="checkValidation('rti', 'pre_street_for_rti', streetValidationMessage);" value="{{pre_street}}" style="margin-top: 18px;">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_street_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_village_for_rti" name="pre_village" class="form-control" placeholder="Enter Village / DMC Ward !"
                           maxlength="100" onblur="checkValidation('rti', 'pre_village_for_rti', villagewardValidationMessage);" value="{{pre_village}}">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_village_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.5 Select City<span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control select2" id="pre_city_for_rti" name="pre_city"
                           placeholder="Enter City !"  onblur="checkValidation('rti', 'pre_city_for_rti', selectCityValidationMessage);" value="{{pre_city}}">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_city_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.6 Pincode <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_pincode_for_rti" name="pre_pincode" class="form-control" placeholder="Enter Pincode !"
                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('rti', 'pre_pincode_for_rti', pincodeValidationMessage);" value="{{pre_pincode}}" >
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_pincode_for_rti"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>3. Remarks <span style="color: red;">*</span></label>
                <textarea id="ldc_to_mamlatdar_remarks_for_rti" name="ldc_to_mamlatdar_remarks_for_rti" class="form-control"
                          onblur="checkValidation('rti-update-basic-detail', 'ldc_to_mamlatdar_remarks_for_rti', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{ldc_to_mamlatdar_remarks}}</textarea>
                <span class="error-message error-message-rti-update-basic-detail-ldc_to_mamlatdar_remarks_for_rti"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>4. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <select id="ldc_to_mamlatdar_for_rti" name="ldc_to_mamlatdar_for_rti"
                        onchange="checkValidation('rti-update-basic-detail', 'ldc_to_mamlatdar_for_rti', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to Mamlatdar">
                    <option value="">Select Any Mamlatdar</option>
                </select>
                <span class="error-message error-message-rti-update-basic-detail-ldc_to_mamlatdar_for_rti"></span>
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
                    <td class="f-w-b">Updated Name of Applicant</td>
                    <td>{{ldc_applicant_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Applicant's Communication Address</td>
                    <td>{{pre_house_no}}, {{pre_house_name}}, {{pre_street}}, {{pre_village_text}}, {{pre_city_text}}, {{pre_pincode}}</td>
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
            <div class="form-group col-sm-12">
                <label>1. Forward for Reverification <span style="color: red;">*</span></label>
                <div id="to_type_reverify_container_for_rti"></div>
                <span class="error-message error-message-rti-update-basic-detail-to_type_reverify_for_rti"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>2. Remarks <span style="color: red;">*</span></label>
                <textarea id="mam_reverify_remarks_for_rti" name="mam_reverify_remarks_for_rti" class="form-control"
                          onblur="checkValidation('rti-update-basic-detail', 'mam_reverify_remarks_for_rti', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="200"></textarea>
                <span class="error-message error-message-rti-update-basic-detail-mam_reverify_remarks_for_rti"></span>
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
            <div class="form-group col-sm-12">
                <label>1. Forward for Reverification <span style="color: red;">*</span></label>
                <div id="talathi_to_type_reverify_container_for_rti"></div>
                <span class="error-message error-message-rti-update-basic-detail-talathi_to_type_reverify_for_rti"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>2. Remarks <span style="color: red;">*</span></label>
                <textarea id="talathi_reverify_remarks_for_rti" name="talathi_reverify_remarks_for_rti" class="form-control"
                          onblur="checkValidation('rti-update-basic-detail', 'talathi_reverify_remarks_for_rti', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="200"></textarea>
                <span class="error-message error-message-rti-update-basic-detail-talathi_reverify_remarks_for_rti"></span>
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
                <label>1. Recommendation of Awal Karkun / Circle Inspector <span style="color: red;">*</span></label>
                <div id="aci_rec_reverify_container_for_rti"></div>
                <span class="error-message error-message-rti-update-basic-detail-aci_rec_reverify_for_rti"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>2. Remarks <span style="color: red;">*</span></label>
                <textarea id="aci_reverify_remarks_for_rti" name="aci_reverify_remarks_for_rti" class="form-control"
                          onblur="checkValidation('rti-update-basic-detail', 'aci_reverify_remarks_for_rti', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="200"></textarea>
                <span class="error-message error-message-rti-update-basic-detail-aci_reverify_remarks_for_rti"></span>
            </div>
            <div class="form-group col-sm-12" id="aci_to_mamlatdar_reverify_container_for_rti" style="display: none;">
                <label>3. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <div id="aci_to_type_reverify_container_for_rti"></div>
                <span class="error-message error-message-rti-update-basic-aci_to_type_reverify_for_rti"></span>
            </div>
            <div class="form-group col-sm-12" id="aci_to_ldc_reverify_container_for_rti" style="display: none;">
                <label>3. Forward to LDC <span style="color: red;">*</span></label>
                <select id="aci_to_ldc_reverify_for_rti" name="aci_to_ldc_reverify_for_rti"
                        onchange="checkValidation('rti-update-basic-detail', 'aci_to_ldc_reverify_for_rti', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to LDC">
                    <option value="">Select Any LDC</option>
                </select>
                <span class="error-message error-message-rti-update-basic-detail-aci_to_ldc_reverify_for_rti"></span>
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
        {{#if show_ldc_reverify_enter_basic_details}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Update Name of Applicant (If Required) <span class="color-nic-red">*</span></label>
                <input type="text" id="ldc_applicant_name_for_rti" name="ldc_applicant_name_for_rti" class="form-control" placeholder="Update Name of Applicant !"
                       maxlength="100" onblur="checkValidation('rti-update-basic-detail', 'ldc_applicant_name_for_rti', applicantNameValidationMessage);" value="{{applicant_name}}">
                <span class="error-message error-message-rti-update-basic-detail-ldc_applicant_name_for_rti"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>2. Update Applicant's Communication Address (If Required) <span class="color-nic-red">*</span></label>
            </div>
            <div class="form-group col-sm-4">
                <label>2.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_house_no_for_rti" name="pre_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{pre_house_no}}" onblur="checkValidation('rti', 'pre_house_no_for_rti', houseNoValidationMessage);" style="margin-top: 18px;">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_house_no_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_house_name_for_rti" name="pre_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{pre_house_name}}" onblur="checkValidation('rti', 'pre_house_name_for_rti', houseNameValidationMessage);">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_house_name_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.3 Street <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_street_for_rti" name="pre_street" class="form-control" placeholder="Enter Street !"
                           maxlength="100" onblur="checkValidation('rti', 'pre_street_for_rti', streetValidationMessage);" value="{{pre_street}}" style="margin-top: 18px;">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_street_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_village_for_rti" name="pre_village" class="form-control" placeholder="Enter Village / DMC Ward !"
                           maxlength="100" onblur="checkValidation('rti', 'pre_village_for_rti', villagewardValidationMessage);" value="{{pre_village}}">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_village_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.5 Select City<span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control select2" id="pre_city_for_rti" name="pre_city"
                           placeholder="Enter City !"  onblur="checkValidation('rti', 'pre_city_for_rti', selectCityValidationMessage);" value="{{pre_city}}">
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_city_for_rti"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>2.6 Pincode <span class="color-nic-red">*</span></label>
                <div class="input-group">
                    <input type="text" id="pre_pincode_for_rti" name="pre_pincode" class="form-control" placeholder="Enter Pincode !"
                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('rti', 'pre_pincode_for_rti', pincodeValidationMessage);" value="{{pre_pincode}}" >
                </div>
                <span class="error-message error-message-rti-update-basic-detail-pre_pincode_for_rti"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>3. Remarks <span style="color: red;">*</span></label>
                <textarea id="ldc_to_mamlatdar_remarks_for_rti" name="ldc_to_mamlatdar_remarks_for_rti" class="form-control"
                          onblur="checkValidation('rti-update-basic-detail', 'ldc_to_mamlatdar_remarks_for_rti', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{ldc_to_mamlatdar_remarks}}</textarea>
                <span class="error-message error-message-rti-update-basic-detail-ldc_to_mamlatdar_remarks_for_rti"></span>
            </div>
            <div class="form-group col-sm-12">
                <label>4. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <select id="ldc_to_mamlatdar_for_rti" name="ldc_to_mamlatdar_for_rti"
                        onchange="checkValidation('rti-update-basic-detail', 'ldc_to_mamlatdar_for_rti', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to Mamlatdar">
                    <option value="">Select Any Mamlatdar</option>
                </select>
                <span class="error-message error-message-rti-update-basic-detail-ldc_to_mamlatdar_for_rti"></span>
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
                    <td class="f-w-b">Updated Name of Applicant</td>
                    <td>{{ldc_applicant_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Updated Applicant's communication Address</td>
                    <td>{{pre_house_no}}, {{pre_house_name}}, {{pre_street}}, {{pre_village_text}}, {{pre_city_text}}, {{pre_pincode}}</td>
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
            {{#if show_submit_btn}}
            <button type="button" class="btn btn-sm btn-success"
                    onclick="Rti.listview.submitBasicDetail($(this));"
                    style="margin-right: 5px;">
                        <?php echo is_admin() ? 'Submit' : 'Forward'; ?>
            </button>
            {{/if}}
            {{#if show_reverify_submit_btn}}
            <button type="button" class="btn btn-sm btn-success" onclick="Rti.listview.reverifyApplication($(this));"
                    style="margin-right: 5px;">Forward</button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>