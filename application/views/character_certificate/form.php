<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Character Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application for issue of Character Certificate </div>
            </div>
            <form role="form" id="character_certificate_form" name="character_certificate_form" onsubmit="return false;"
                  autocomplete="off">
                <input type="hidden" id="character_certificate_id_for_character_certificate" name="character_certificate_id_for_character_certificate" value="{{character_certificate_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-character-certificate f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    To,<br>
                    The Mamlatdar,
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-3">
                            <label>District<span class="color-nic-red">*</span></label>
                            <select id="district_for_character_certificate" name="district_for_character_certificate" class="form-control select2"
                                    onchange="checkValidation('character-certificate', 'district_for_character_certificate', selectDistrictValidationMessage);"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-character-certificate-district_for_character_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1.Name of Applicant <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_name_for_character_certificate" name="applicant_name" class="form-control" placeholder="Enter Name of Applicant !"
                                   maxlength="100" onblur="checkValidation('character-certificate', 'applicant_name_for_character_certificate', applicantNameValidationMessage);" value="{{applicant_name}}">
                            <span class="error-message error-message-character-certificate-applicant_name_for_character_certificate"></span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-body pt-1" style="background-color: aliceblue;">
                                
                                <div class="row">
                                       <div class="form-group col-sm-6" style="margin-top: 25px;">
                                        <label>2. Applicant’s Communication Address</label><br/>
                                        <label>2.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="com_addr_house_no_for_character_certificate" name="com_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{com_addr_house_no}}" onblur="checkValidation('character', 'com_addr_house_no_for_character_certificate', houseNoValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-character-com_addr_house_no_for_character_certificate"></span>
                                    </div>
                                    <div class="form-group col-sm-6" style="margin-top: 47px;">
                                        <label>2.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="com_addr_house_name_for_character_certificate" name="com_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{com_addr_house_name}}" onblur="checkValidation('character', 'com_addr_house_name_for_character_certificate', houseNameValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-character-com_addr_house_name_for_character_certificate"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>2.3 Street <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="com_addr_street_for_character_certificate" name="com_addr_street" class="form-control" placeholder="Enter Street !"
                                                   maxlength="100" onblur="checkValidation('character', 'com_addr_street_for_character_certificate', streetValidationMessage);" value="{{com_addr_street}}">
                                        </div>
                                        <span class="error-message error-message-character-com_addr_street_for_character_certificate"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>2.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="com_addr_village_dmc_ward_for_character_certificate" name="com_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                   maxlength="100" onblur="checkValidation('character', 'com_addr_village_dmc_ward_for_character_certificate', villageNameValidationMessage);" value="{{com_addr_village_dmc_ward}}" >
                                        </div>
                                        <span class="error-message error-message-character-com_addr_village_dmc_ward_for_character_certificate"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>2.5 Select City<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="com_addr_city_for_character_certificate" name="com_addr_city" class="form-control" placeholder="Enter City !"
                                       maxlength="100" onblur="checkValidation('character', 'com_addr_city_for_character_certificate', selectCityValidationMessage);" value="{{com_addr_city}}" >
                                        </div>
                                        <span class="error-message error-message-character-com_addr_city_for_character_certificate"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>2.6 Pincode <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="com_pincode_for_character_certificate" name="com_pincode" class="form-control" placeholder="Enter Pincode !"
                                                   maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('character', 'com_pincode_for_character_certificate', pincodeValidationMessage);" value="{{com_pincode}}" >
                                        </div>
                                        <span class="error-message error-message-character-com_pincode_for_character_certificate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-body pt-1" style="background-color: aliceblue;">
                                
                                <div class="row">
                                       <div class="form-group col-sm-6">
                                        <label>Same as Communication Address</label>&nbsp;
                                            <input type="checkbox" id="billingtoo_for_character_certificate" name="billingtoo" class="checkbox" value="{{is_checked}}"  onchange="CharacterCertificate.listview.FillBilling($(this));">
                                            <span class="error-message error-message-character-billingtoo"></span><br/>
                                        <label>3. Applicant’s Permanent Address</label><br/>   
                                        <label>3.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_addr_house_no_for_character_certificate" name="per_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{per_addr_house_no}}" onblur="checkValidation('character', 'per_addr_house_no_for_character_certificate', houseNoValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-character-per_addr_house_no_for_character_certificate"></span>
                                    </div>
                                    <div class="form-group col-sm-6" style="margin-top: 45px;">
                                        <label>3.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_addr_house_name_for_character_certificate" name="per_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{per_addr_house_name}}" onblur="checkValidation('character', 'per_addr_house_name_for_character_certificate', houseNameValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-character-per_addr_house_name_for_character_certificate"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>3.3 Street <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="per_addr_street_for_character_certificate" name="per_addr_street" class="form-control" placeholder="Enter Street !"
                                                   maxlength="100" onblur="checkValidation('character', 'per_addr_street_for_character_certificate', streetValidationMessage);" value="{{per_addr_street}}">
                                        </div>
                                        <span class="error-message error-message-character-per_addr_street_for_character_certificate"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>3.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="per_addr_village_dmc_ward_for_character_certificate" name="per_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                   maxlength="100" onblur="checkValidation('character', 'per_addr_village_dmc_ward_for_character_certificate', villageNameValidationMessage);" value="{{per_addr_village_dmc_ward}}">
                                        </div>
                                        <span class="error-message error-message-character-per_addr_village_dmc_ward_for_character_certificate"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>3.5 Select City<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_addr_city_for_character_certificate" name="per_addr_city" class="form-control" placeholder="Enter City !"
                                       maxlength="100" onblur="checkValidation('character', 'per_addr_city_for_character_certificate', selectCityValidationMessage);" value="{{per_addr_city}}">
                                        </div>
                                        <span class="error-message error-message-character-per_addr_city_for_character_certificate"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>3.6 Pincode <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="per_pincode_for_character_certificate" name="per_pincode" class="form-control" placeholder="Enter Pincode !"
                                                   maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('character', 'per_pincode_for_character_certificate', pincodeValidationMessage);" value="{{per_pincode}}" >
                                        </div>
                                        <span class="error-message error-message-character-per_pincode_for_character_certificate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4.1 Date of Birth<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="applicant_dob" id="applicant_dob_for_character_certificate" class="form-control "
                                       placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{applicant_dob}}"
                                       onblur="checkValidation('character-certificate', 'applicant_dob_for_character_certificate', birthDateValidationMessage); calculateAge('for_character_certificate');">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-character-certificate-applicant_dob_for_character_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4.2 Applicant Age<span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_age_for_character_certificate" 
                                   name="applicant_age" class="form-control"
                                   placeholder="Enter Applicant Age !" maxlength="100" 
                                   onblur="checkValidation('character-certificate', 'applicant_age_for_character_certificate', applicantAgeValidationMessage);"
                                   value="{{applicant_age}}" readonly="">
                            <span class="error-message error-message-character-certificate-applicant_age_for_character_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Name of Father <span class="color-nic-red">*</span></label>
                            <input type="text" id="father_name_for_character_certificate" name="father_name" class="form-control" placeholder="Enter Name of Father !"
                                   maxlength="100" onblur="checkValidation('character-certificate', 'father_name_for_character_certificate', fatherNameValidationMessage);" value="{{father_name}}">
                            <span class="error-message error-message-character-certificate-father_name_for_character_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>6. Name of Mother <span class="color-nic-red">*</span></label>
                            <input type="text" id="mother_name_for_character_certificate" name="mother_name" class="form-control" placeholder="Enter Name of Mother !"
                                   maxlength="100" onblur="checkValidation('character-certificate', 'mother_name_for_character_certificate', motherNameValidationMessage);" value="{{mother_name}}">
                            <span class="error-message error-message-character-certificate-mother_name_for_character_certificate"></span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7. Purpose For required Character Certificate  <span class="color-nic-red">*</span></label>
                            <input type="text" id="purpose_for_character_certificate" name="purpose" class="form-control" placeholder="Enter Purpose !"
                                   maxlength="50" onblur="checkValidation('character-certificate', 'purpose_for_character_certificate', purposeValidationMessage);" value="{{purpose}}">
                            <span class="error-message error-message-character-certificate-purpose_for_character_certificate"></span>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-12" id="birth_leaving_certy_doc_container_for_character_certificate">
                            <label>8. Birth Certificate / Leaving Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="birth_leaving_certy_doc_for_character_certificate" name="birth_leaving_certy_doc_for_character_certificate" class="spinner_container_for_character_certificate_{{VALUE_ONE}}"
                                   accept="application/pdf" onchange="CharacterCertificate.listview.uploadDocumentForCharacterCertificate({{VALUE_ONE}});">
                            <div class="error-message error-message-character-certificate-birth_leaving_certy_doc_for_character_certificate"></div>
                        </div>
                        <div class="col-sm-12" id="birth_leaving_certy_doc_name_container_for_character_certificate" style="display: none;">
                            <label>8. Birth Certificate / Leaving Certificate <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="birth_leaving_certy_doc_download"><label id="birth_leaving_certy_doc_name_image_for_character_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_character_certificate_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="birth_leaving_certy_doc" class="btn btn-sm btn-danger spinner_name_container_for_character_certificate_{{VALUE_ONE}}" style="vertical-align: top;"
                                    onclick="CharacterCertificate.listview.askForRemove('{{character_certificate_id}}', {{VALUE_ONE}});">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="aadhar_card_doc_container_for_character_certificate">
                            <label>9. Aadhar Card <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <input type="file" id="aadhar_card_doc_for_character_certificate" name="aadhar_card_doc_for_character_certificate" class="spinner_container_for_character_certificate_{{VALUE_TWO}}"
                                   accept="application/pdf" onchange="CharacterCertificate.listview.uploadDocumentForCharacterCertificate({{VALUE_TWO}});">
                            <div class="error-message error-message-character-certificate-aadhar_card_doc_for_character_certificate"></div>
                        </div>
                        <div class="col-sm-12" id="aadhar_card_doc_name_container_for_character_certificate" style="display: none;">
                            <label>9. Aadhar Card <span style="color: red;"> </span></label><br>
                            <a target="_blank" id="aadhar_card_doc_download"><label id="aadhar_card_doc_name_image_for_character_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_character_certificate_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            <button type="button" id="aadhar_card_doc" class="btn btn-sm btn-danger spinner_name_container_for_character_certificate_{{VALUE_TWO}}" style="vertical-align: top;"
                                    onclick="CharacterCertificate.listview.askForRemove('{{character_certificate_id}}', {{VALUE_TWO}});">
                                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    
                </div>
                <div class="card-footer p-2">
                    <button type="button" id="submit_btn_for_character_certificate" class="btn btn-sm btn-success" onclick="CharacterCertificate.listview.submitCharacterCertificate({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="CharacterCertificate.listview.loadCharacterCertificateData();">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>