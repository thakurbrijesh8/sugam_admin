{{#if show_bd_drsthree}}
<div class="card other_party_details_for_drsthree fw-body" id="other_party_main_details_for_drsthree_{{temp_mt_cnt}}">
    <div class="card-header pt-2 pb-1 bg-nic-blue">
        <input type="hidden" class='temp_opd_drsthree_cnt' value="{{temp_mt_cnt}}">
        <input type="hidden" class='temp_opd_drsthree_temp_mt' value="{{temp_mt}}">
        <input type="hidden" class='temp_opd_drsthree_temp_class' value="{{temp_mt_class}}">
        <h3 class="card-title f-w-b f-s-15px">
            Other Party Detail : Sr. No. <span class="opd-drsthree-display-cnt">{{temp_mt_cnt}}</span> -
            <span id="acc_party_category_for_{{temp_mt}}" class="badge bg-white app-status">Party Category</span> -
            <span id="acc_party_description_for_{{temp_mt}}" class="badge bg-white app-status">Party Description</span> - 
            <span id="acc_party_name_for_{{temp_mt}}" class="badge bg-white app-status">Party Full Name</span>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    id="other_party_main_details_hs_btn_for_drsthree_{{temp_mt_cnt}}">
                <i class="fas fa-minus text-white"></i>
            </button>
            <button type="button" class="btn btn-tool"
                    onclick="DocumentRegistration.listview.removePartyDetails({{temp_mt_cnt}});">
                <i class="fas fa-times text-white"></i>
            </button>
        </div>
    </div>
    <div class="card-body border-nic-blue">
        <form role="form" id="drsthree_form_{{temp_mt}}" name="drsthree_form_{{temp_mt}}" onsubmit="return false;" autocomplete="off">
            {{/if}}
            <input type="hidden" id='dr_party_details_id_for_{{temp_mt}}' name='dr_party_details_id_for_{{temp_mt}}' value="{{dr_party_details_id}}">
            <div class="row mt-3">
                <div class="form-group {{#if show_bd_drstwo}}col-sm-4{{else}}col-sm-6{{/if}}">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Category <span class="color-nic-red">*</span></label>
                    <select id="party_category_for_{{temp_mt}}" name="party_category_for_{{temp_mt}}" class="form-control select2"
                            onchange="checkValidation('{{temp_mt_class}}', 'party_category_for_{{temp_mt}}', oneOptionValidationMessage);
                            DocumentRegistration.listview.pcChangeEvent('{{temp_mt}}');"
                            data-placeholder="Select Party Category" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-{{temp_mt_class}}-party_category_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group {{#if show_bd_drstwo}}col-sm-4{{else}}col-sm-6{{/if}}">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Description <span class="color-nic-red">*</span></label>
                    <select id="party_description_for_{{temp_mt}}" name="party_description_for_{{temp_mt}}" class="form-control select2"
                            onchange="checkValidation('{{temp_mt_class}}', 'party_description_for_{{temp_mt}}', oneOptionValidationMessage);"
                            data-placeholder="Select Party Description" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-{{temp_mt_class}}-party_description_for_{{temp_mt}}"></span>
                </div>
                {{#if show_bd_drstwo}}
                <div class="form-group col-sm-4">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Whether Power of Attorney Holder <span class="color-nic-red">*</span></label>
                    <div id="is_poa_holder_container_for_{{temp_mt}}"></div>
                    <span class="error-message error-message-{{temp_mt_class}}-is_poa_holder_for_{{temp_mt}}"></span>
                </div>
                {{/if}}
            </div>
            {{#if show_bd_drstwo}}
            <div class="card bg-beige" id="poa_details_main_container_for_{{temp_mt}}" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title f-w-b f-s-16px">
                        Power of Attorney Details<span style="color: red;">*</span>
                    </h3>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label>3.1 Name of Principal <span class="color-nic-red">*</span></label>
                            <input type="text" id="poa_principal_name_for_{{temp_mt}}" name="poa_principal_name_for_{{temp_mt}}" class="form-control" placeholder="Enter Name of Principal !"
                                   maxlength="200" onblur="checkValidation('{{temp_mt_class}}', 'poa_principal_name_for_{{temp_mt}}', nameValidationMessage);" value="{{poa_principal_name}}">
                            <span class="error-message error-message-{{temp_mt_class}}-poa_principal_name_for_{{temp_mt}}"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label>3.2 POA Type <span class="color-nic-red">*</span></label>
                            <div id="poa_type_container_for_{{temp_mt}}"></div>
                            <span class="error-message error-message-{{temp_mt_class}}-poa_type_for_{{temp_mt}}"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label>3.3 POA Description <span class="color-nic-red">*</span></label>
                            <textarea id="poa_description_for_{{temp_mt}}" name="poa_description_for_{{temp_mt}}" class="form-control" placeholder="Enter POA Description !"
                                      onblur="checkValidation('{{temp_mt_class}}', 'poa_description_for_{{temp_mt}}', descriptionValidationMessage);"
                                      maxlength="500" >{{poa_description}}</textarea>
                            <span class="error-message error-message-{{temp_mt_class}}-poa_description_for_{{temp_mt}}"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <div id="poa_doc_container_for_{{temp_mt}}">
                                <label>3.4 Upload POA <span style="color: red;">* (Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label>
                            </div>
                            <div id="poa_doc_name_container_for_{{temp_mt}}" style="display: none;">
                                <label>3.4 POA Document <span style="color: red;">*</span></label><br>
                                <a id="poa_doc_name_href_for_{{temp_mt}}" target="_blank" class="cursor-pointer">
                                    <label id="poa_doc_name_for_{{temp_mt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer" style="padding: 2px 7px;"></label>
                                </a>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label>3.5 Personal Details of Principal <span class="color-nic-red">*</span></label>
                            <input type="text" id="poa_principal_pd_for_{{temp_mt}}" name="poa_principal_pd_for_{{temp_mt}}" class="form-control" placeholder="Enter Personal Details of Principal !"
                                   maxlength="200" onblur="checkValidation('{{temp_mt_class}}', 'poa_principal_pd_for_{{temp_mt}}', pdPrincipalValidationMessage);" value="{{poa_principal_pd}}">
                            <span class="error-message error-message-{{temp_mt_class}}-poa_principal_pd_for_{{temp_mt}}"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-3">
                            <label>3.6 POA Execution Date <span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="poa_execution_date_for_{{temp_mt}}" id="poa_execution_date_for_{{temp_mt}}" class="form-control"
                                       placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY" value="{{poa_execution_date_text}}"
                                       onblur="checkValidation('{{temp_mt_class}}', 'poa_execution_date_for_{{temp_mt}}', dateValidationMessage);">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-{{temp_mt_class}}-poa_execution_date_for_{{temp_mt}}"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label>3.7 POA Place of Execution <span class="color-nic-red">*</span></label>
                            <input type="text" id="poa_execution_place_for_{{temp_mt}}" name="poa_execution_place_for_{{temp_mt}}" class="form-control" placeholder="Enter Place of Execution !"
                                   maxlength="50" onblur="checkValidation('{{temp_mt_class}}', 'poa_execution_place_for_{{temp_mt}}', placeValidationMessage);" value="{{poa_execution_place}}">
                            <span class="error-message error-message-{{temp_mt_class}}-poa_execution_place_for_{{temp_mt}}"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label>3.8 POA Witnesses <span class="color-nic-red">*</span></label>
                            <textarea id="poa_witnesses_for_{{temp_mt}}" name="poa_witnesses_for_{{temp_mt}}" class="form-control" placeholder="Enter POA Witnesses !"
                                      onblur="checkValidation('{{temp_mt_class}}', 'poa_witnesses_for_{{temp_mt}}', witnessNameValidationMessage);"
                                      maxlength="500">{{poa_witnesses}}</textarea>
                            <span class="error-message error-message-{{temp_mt_class}}-poa_witnesses_for_{{temp_mt}}"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label>3.9 Notarised Advocate <span class="color-nic-red">*</span></label>
                            <input type="text" id="poa_notarised_advocate_for_{{temp_mt}}" name="poa_notarised_advocate_for_{{temp_mt}}" class="form-control" placeholder="Enter Notarised Advocate !"
                                   maxlength="50" onblur="checkValidation('{{temp_mt_class}}', 'poa_notarised_advocate_for_{{temp_mt}}', notADVValidationMessage);" value="{{poa_notarised_advocate}}">
                            <span class="error-message error-message-{{temp_mt_class}}-poa_notarised_advocate_for_{{temp_mt}}"></span>
                        </div>
                    </div>
                </div>
            </div>
            {{/if}}
            <div class="row">
                <div class="form-group col-sm-6">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Full Name <span class="color-nic-red">*</span></label>
                    <input type="text" id="party_name_for_{{temp_mt}}" name="party_name_for_{{temp_mt}}" class="form-control" placeholder="Enter Party Name !"
                           maxlength="500" onblur="checkValidation('{{temp_mt_class}}', 'party_name_for_{{temp_mt}}', partyNameValidationMessage);" value="{{party_name}}">
                    <span class="error-message error-message-{{temp_mt_class}}-party_name_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Address <span class="color-nic-red">*</span></label>
                    <textarea id="party_address_for_{{temp_mt}}" name="party_address_for_{{temp_mt}}" class="form-control" placeholder="Enter Party Address !"
                              onblur="checkValidation('{{temp_mt_class}}', 'party_address_for_{{temp_mt}}', addressValidationMessage);"
                              maxlength="500" >{{party_address}}</textarea>
                    <span class="error-message error-message-{{temp_mt_class}}-party_address_for_{{temp_mt}}"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4 col-md-3">
                    <label>{{#if show_bd_drstwo}}5.1{{else}}4.1{{/if}} Pincode <span class="color-nic-red">*</span></label>
                    <input type="text" id="party_pincode_for_{{temp_mt}}" name="party_pincode_for_{{temp_mt}}"
                           class="form-control" placeholder="Enter Pincode !" maxlength="6" onkeyup="checkNumeric($(this));" 
                           onblur="checkValidationForPincode('{{temp_mt_class}}', 'party_pincode_for_{{temp_mt}}');"
                           value="{{party_pincode}}">
                    <span class="error-message error-message-{{temp_mt_class}}-party_pincode_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <label>{{#if show_bd_drstwo}}5.2{{else}}4.2{{/if}} State / U.T. <span class="color-nic-red">*</span></label>
                    <select id="party_state_for_{{temp_mt}}" name="party_state_for_{{temp_mt}}" class="form-control select2"
                            data-placeholder="Select State / U.T."
                            onchange="checkValidation('{{temp_mt_class}}', 'party_state_for_{{temp_mt}}', selectStateValidationMessage);
                                DocumentRegistration.listview.stateChangeEvent ($(this), 'party', '{{temp_mt}}');">
                    </select>
                    <span class="error-message error-message-{{temp_mt_class}}-party_state_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-4 col-md-3">
                    <label>{{#if show_bd_drstwo}}5.3{{else}}4.3{{/if}} District <span class="color-nic-red">*</span></label>
                    <select id="party_district_for_{{temp_mt}}" name="party_district_for_{{temp_mt}}" class="form-control select2"
                            data-placeholder="Select District"
                            onchange="checkValidation('drsone', 'party_district_for_{{temp_mt}}', selectDistrictValidationMessage);">
                    </select>
                    <span class="error-message error-message-{{temp_mt_class}}-party_district_for_{{temp_mt}}"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Date of Birth / Year of Birth / Age <span class="color-nic-red">*</span></label>
                    <div id="party_birth_type_container_for_{{temp_mt}}"></div>
                    <span class="error-message error-message-{{temp_mt_class}}-party_birth_type_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3" id="date_of_birth_container_for_{{temp_mt}}" style="display: none;">
                    <label>{{#if show_bd_drstwo}}6.1{{else}}5.1{{/if}} Date of Birth<span style="color: red;">*</span></label>
                    <div class="input-group date">
                        <input type="text" name="party_dob_for_{{temp_mt}}" id="party_dob_for_{{temp_mt}}" class="form-control"
                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY" value="{{party_dob_text}}"
                               onblur="checkValidation('{{temp_mt_class}}', 'party_dob_for_{{temp_mt}}', dateValidationMessage);">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                    </div>
                    <span class="error-message error-message-{{temp_mt_class}}-party_dob_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3" id="year_of_birth_container_for_{{temp_mt}}" style="display: none;">
                    <label>{{#if show_bd_drstwo}}6.1{{else}}5.1{{/if}} Year of Birth <span style="color: red;">*</span></label>
                    <input type="text" id="party_dob_year_for_{{temp_mt}}" name="party_dob_year_for_{{temp_mt}}" 
                           onblur="checkValidation('{{temp_mt_class}}', 'party_dob_year_for_{{temp_mt}}', yearValidationMessage); checkNumeric($(this));"
                           class="form-control" placeholder="Enter Year"
                           value="{{party_dob_year}}" maxlength="4"  onkeypress="checkNumeric($(this));" />
                    <span class="error-message error-message-{{temp_mt_class}}-party_dob_year_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3" id="age_container_for_{{temp_mt}}" style="display: none;">
                    <label>{{#if show_bd_drstwo}}6.1{{else}}5.1{{/if}} Age <span style="color: red;">*</span></label>
                    <input type="text" id="party_age_for_{{temp_mt}}" name="party_age_for_{{temp_mt}}" 
                           onblur="checkValidation('{{temp_mt_class}}', 'party_age_for_{{temp_mt}}', ageValidationMessage); checkNumeric($(this));"
                           class="form-control" placeholder="Enter Age"
                           value="{{party_age}}" maxlength="3"  onkeypress="checkNumeric($(this));" />
                    <span class="error-message error-message-{{temp_mt_class}}-party_age_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Gender <span class="color-nic-red">*</span></label>
                    <div id="party_gender_container_for_{{temp_mt}}"></div>
                    <span class="error-message error-message-{{temp_mt_class}}-party_gender_for_{{temp_mt}}"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Religion <span class="color-nic-red">*</span></label>
                    <select id="party_religion_for_{{temp_mt}}" name="party_religion_for_{{temp_mt}}" class="form-control select2"
                            onchange="checkValidation('{{temp_mt_class}}', 'party_religion_for_{{temp_mt}}', oneOptionValidationMessage);"
                            data-placeholder="Select Party Religion" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-{{temp_mt_class}}-party_religion_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Mobile Number <span class="color-nic-red">*</span></label>
                    <input type="text" id="party_mobile_number_for_{{temp_mt}}" name="party_mobile_number_for_{{temp_mt}}" class="form-control" placeholder="Enter Party Mobile Number !"
                           maxlength="10" onkeyup="checkNumeric($(this));"
                           onblur="checkValidationForMobileNumber('{{temp_mt_class}}', 'party_mobile_number_for_{{temp_mt}}');" value="{{party_mobile_number}}">
                    <span class="error-message error-message-{{temp_mt_class}}-party_mobile_number_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Email Address </label>
                    <input type="text" id="party_email_address_for_{{temp_mt}}" name="party_email_address_for_{{temp_mt}}"
                           class="form-control" placeholder="Enter Party Email Address !"  maxlength="50"
                           onblur="checkValidationForEmail('{{temp_mt_class}}', 'party_email_address_for_{{temp_mt}}');" value="{{party_email_address}}">
                    <span class="error-message error-message-{{temp_mt_class}}-party_email_address_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Occupation <span class="color-nic-red">*</span></label>
                    <select id="party_occupation_for_{{temp_mt}}" name="party_occupation_for_{{temp_mt}}" class="form-control select2"
                            onchange="checkValidation('{{temp_mt_class}}', 'party_occupation_for_{{temp_mt}}', oneOptionValidationMessage);"
                            data-placeholder="Select Party Occupation" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-{{temp_mt_class}}-party_occupation_for_{{temp_mt}}"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-danger">
                    <hr>
                    <b>Note :</b> PAN / Form 60 is Compulsory for Party Category is (Executant, Claimant and Executant & Claimant) & Consideration Amount is 5,00,000 or Above.
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12 col-md-3">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. PAN / Form 60</label>
                    <div id="party_pan_type_container_for_{{temp_mt}}"></div>
                    <span class="error-message error-message-{{temp_mt_class}}-party_pan_type_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6 col-md-3 party_pan_details_container_for_{{temp_mt}}" style="display: none;">
                    <label>{{#if show_bd_drstwo}}12.1{{else}}11.1{{/if}} Party PAN Number </label>
                    <input type="text" id="party_pan_number_for_{{temp_mt}}" name="party_pan_number_for_{{temp_mt}}"
                           class="form-control" placeholder="Enter Party PAN Number"
                           onblur="checkValidationForPAN('{{temp_mt_class}}', 'party_pan_number_for_{{temp_mt}}');"
                           value="{{party_pan_number}}" maxlength="10" style="text-transform: uppercase;"/>
                    <span class="error-message error-message-{{temp_mt_class}}-party_pan_number_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6 party_pan_details_container_for_{{temp_mt}}" style="display: none;">
                    <div id="party_pan_doc_container_for_{{temp_mt}}">
                        <label>{{#if show_bd_drstwo}}12.2{{else}}11.2{{/if}} Upload PAN Card<span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                        <label class="f-w-n">Document Not Uploaded</label>
                    </div>
                    <div id="party_pan_doc_name_container_for_{{temp_mt}}" style="display: none;">
                        <label>{{#if show_bd_drstwo}}12.2{{else}}11.2{{/if}} PAN Card Document</label><br>
                        <a id="party_pan_doc_name_href_for_{{temp_mt}}" target="_blank" class="cursor-pointer">
                            <label id="party_pan_doc_name_for_{{temp_mt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer" style="padding: 2px 7px;"></label>
                        </a>
                    </div>
                </div>
                <div class="form-group col-sm-6 party_form_sixteen_details_container_for_{{temp_mt}}" style="display: none;">
                    <div id="party_form_sixteen_container_for_{{temp_mt}}">
                        <label>{{#if show_bd_drstwo}}12.1{{else}}11.1{{/if}} Upload Form 60<span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                        <label class="f-w-n">Document Not Uploaded</label>
                    </div>
                    <div id="party_form_sixteen_name_container_for_{{temp_mt}}" style="display: none;">
                        <label>{{#if show_bd_drstwo}}12.1{{else}}11.1{{/if}} Form 60 Document</label><br>
                        <a id="party_form_sixteen_name_href_for_{{temp_mt}}" target="_blank" class="cursor-pointer">
                            <label id="party_form_sixteen_name_for_{{temp_mt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer" style="padding: 2px 7px;"></label>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6 col-md-3">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Party Aadhar Number</label>
                    <input type="text" id="party_aadhar_number_for_{{temp_mt}}" name="party_aadhar_number_for_{{temp_mt}}"
                           class="form-control" placeholder="Enter Party Aadhar Number !"
                           onblur="aadharNumberValidation('{{temp_mt_class}}', 'party_aadhar_number_for_{{temp_mt}}');"
                           maxlength="12" value="{{party_aadhar_number}}">
                    <span class="error-message error-message-{{temp_mt_class}}-party_aadhar_number_for_{{temp_mt}}"></span>
                </div>
                <div class="form-group col-sm-6">
                    <div id="party_aadhar_doc_container_for_{{temp_mt}}">
                        <label>{{#if show_bd_drstwo}}13.1{{else}}12.1{{/if}} Upload Aadhar Card<span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                        <label class="f-w-n">Document Not Uploaded</label>
                    </div>
                    <div id="party_aadhar_doc_name_container_for_{{temp_mt}}" style="display: none;">
                        <label>{{#if show_bd_drstwo}}13.1{{else}}12.1{{/if}} Aadhar Card Document</label><br>
                        <a id="party_aadhar_doc_name_href_for_{{temp_mt}}" target="_blank" class="cursor-pointer">
                            <label id="party_aadhar_doc_name_for_{{temp_mt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer" style="padding: 2px 7px;"></label>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label><span class="{{temp_mt_class}}-cnt"></span>. Any Other Details / Remarks</label>
                    <textarea id="party_remarks_for_{{temp_mt}}" name="party_remarks_for_{{temp_mt}}" class="form-control" placeholder="Enter Any Other Details / Remarks !"
                              maxlength="500" >{{party_remarks}}</textarea>
                    <span class="error-message error-message-income-certificate-party_remarks_for_{{temp_mt}}"></span>
                </div>
            </div>
            {{#if show_bd_drsthree}}
        </form>
    </div>
</div>
{{/if}}