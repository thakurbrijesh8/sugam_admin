<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Marriage Application Form for Registration of Marriage</h3>
            </div>
            <form role="form" id="marriage_certificate_form" name="marriage_certificate_form" onsubmit="return false;"
                  autocomplete="off">
                <input type="hidden" id="marriage_certificate_id_for_marriage_certificate" name="marriage_certificate_id_for_marriage_certificate" value="{{marriage_certificate_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-marriage-certificate f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>

                    <div class="card" style="margin-top: 13px;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Basic Details</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>District<span class="color-nic-red">*</span></label>
                                    <select id="district_for_marriage_certificate" name="district_for_marriage_certificate" class="form-control select2"
                                            onchange="checkValidation('marriage-certificate', 'district_for_marriage_certificate', selectDistrictValidationMessage);"
                                            data-placeholder="Select District" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-district_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>1. Name of Applicant <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_name_for_marriage_certificate" name="applicant_name_for_marriage_certificate" class="form-control" placeholder="Enter Name of Applicant !"
                                           maxlength="100" onblur="checkValidation('marriage-certificate', 'applicant_name_for_marriage_certificate', applicantNameValidationMessage);" value="{{applicant_name}}">
                                    <span class="error-message error-message-marriage-certificate-applicant_name_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2. Applicant's Mobile Number<span class="color-nic-red">*</span></label>
                                    <input type="text" id="mobile_number_for_marriage_certificate" name="mobile_number_for_marriage_certificate" class="form-control" placeholder="Enter Mobile Number !"
                                           maxlength="10" onkeyup="checkNumeric($(this));"
                                           onblur="checkValidationForMobileNumber('marriage-certificate', 'mobile_number_for_marriage_certificate');" value="{{mobile_number}}">
                                    <span class="error-message error-message-marriage-certificate-mobile_number_for_marriage_certificate"></span>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>3. Applicant's Communication Address <span class="color-nic-red">*</span></label>
                                    <textarea id="communication_address_for_marriage_certificate" name="communication_address_for_marriage_certificate" class="form-control" placeholder="Enter Communication Address !"
                                              onblur="checkValidation('marriage-certificate', 'communication_address_for_marriage_certificate', communicationAddressValidationMessage);"
                                              maxlength="200" >{{communication_address}}</textarea>
                                    <span class="error-message error-message-marriage-certificate-communication_address_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>4. Applicant's Permanent Address <span class="color-nic-red">*</span></label>
                                    <textarea id="permanent_address_for_marriage_certificate" name="permanent_address_for_marriage_certificate" class="form-control"
                                              onblur="checkValidation('marriage-certificate', 'permanent_address_for_marriage_certificate', communicationAddressValidationMessage);"
                                              placeholder="Enter Applicant's Permanent Address !" maxlength="200">{{permanent_address}}</textarea>
                                    <span class="error-message error-message-marriage-certificate-permanent_address_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>5. Applicant's Email Address </label>
                                    <input type="text" id="email_for_marriage_certificate" name="email_for_marriage_certificate"
                                           class="form-control" placeholder="Enter Email !"  maxlength="100"
                                           onblur="checkValidationForEmail('marriage-certificate', 'email_for_marriage_certificate'); checkValidation('marriage-certificate', 'email_for_marriage_certificate', emailValidationMessage);" value="{{applicant_email}}">
                                    <span class="error-message error-message-marriage-certificate-email_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>6. Date of Birth<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applicant_dob_for_marriage_certificate" id="applicant_dob_for_marriage_certificate" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value=""
                                               onblur="checkValidation('marriage-certificate', 'applicant_dob_for_marriage_certificate', birthDateValidationMessage); calculateAgeForDob('applicant_dob', 'applicant_age', 'marriage_certificate');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-marriage-certificate-applicant_dob_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>6.2 Applicant Age<span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_age_for_marriage_certificate" 
                                           name="applicant_age_for_marriage_certificate" class="form-control"
                                           placeholder="Enter Applicant Age !" maxlength="100" 
                                           onblur="checkValidation('marriage-certificate', 'applicant_age_for_marriage_certificate', ageValidationMessage);"
                                           value="{{applicant_age}}" readonly="">
                                    <span class="error-message error-message-marriage-certificate-applicant_age_for_marriage_certificate"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 13px;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Bridegroom Details (दूल्हे का विवरण)</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>7. Name of Bridegroom (दूल्हे का नाम)<span class="color-nic-red">*</span></label>
                                    <input type="text" id="bridegroom_name_for_marriage_certificate" name="bridegroom_name_for_marriage_certificate" class="form-control" placeholder="Enter Name of Bridegroom !"
                                           maxlength="100" onblur="checkValidation('marriage-certificate', 'bridegroom_name_for_marriage_certificate', nameValidationMessage);" value="{{bridegroom_name}}">
                                    <span class="error-message error-message-marriage-certificate-bridegroom_name_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>8.1 Place of Birth (जन्म स्थान का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_birthplace_state_for_marriage_certificate" name="bridegroom_birthplace_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Place of Birth"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bridegroom_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_birthplace_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>8.2 Taluka of Birth Place (जन्म स्थान का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_birthplace_district_for_marriage_certificate" name="bridegroom_birthplace_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
                                                MarriageCertificate.listview.getVillageData($(this), 'marriage_certificate', 'bridegroom_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_birthplace_district_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>8.3 City / Village of Birth Place (जन्म स्थान का शहर / गांव)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_birthplace_village_for_marriage_certificate" name="bridegroom_birthplace_village_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('marriage-certificate', 'bridegroom_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_birthplace_village_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>9.1 Place of Residence (निवास की जगह)<span class="color-nic-red">*</span></label>
                                    <textarea id="bridegroom_residence_for_marriage_certificate" name="bridegroom_residence_for_marriage_certificate" class="form-control" placeholder="Enter Place of Residence !"
                                              onblur="checkValidation('marriage-certificate', 'bridegroom_residence_for_marriage_certificate', residenceValidationMessage);"
                                              maxlength="200" >{{bridegroom_residence}}</textarea>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_residence_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>9.2 Taluka of Residence (निवास का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_residence_state_for_marriage_certificate" name="bridegroom_residence_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_residence_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bridegroom_residence');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_residence_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>9.3 District of Residence (निवास का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_residence_district_for_marriage_certificate" name="bridegroom_residence_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_residence_district_for_marriage_certificate', selectDistrictValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_residence_district_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>10. Date of Birth (जन्म की तारीख)<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="bridegroom_dob_for_marriage_certificate" id="bridegroom_dob_for_marriage_certificate" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value="{{bridegroom_dob}}"
                                               onblur="checkValidation('marriage-certificate', 'bridegroom_dob_for_marriage_certificate', birthDateValidationMessage); calculateAgeForDob('bridegroom_dob', 'bridegroom_age', 'marriage_certificate');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_dob_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>10.2 Age (उम्र) <span class="color-nic-red">*</span></label>
                                    <input type="text" id="bridegroom_age_for_marriage_certificate" 
                                           name="bridegroom_age_for_marriage_certificate" class="form-control"
                                           placeholder="Enter Age !" maxlength="100" 
                                           onblur="checkValidation('marriage-certificate', 'bridegroom_age_for_marriage_certificate', ageValidationMessage);"
                                           value="{{bridegroom_age}}" readonly="">
                                    <span class="error-message error-message-marriage-certificate-bridegroom_age_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>11. Occupation (व्यवसाय) <span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_occupation_for_marriage_certificate" name="bridegroom_occupation_for_marriage_certificate" class="form-control select2" onchange="checkValidation('marriage-certificate', 'bridegroom_occupation_for_marriage_certificate', occupationValidationMessage); if (this.value == 12){$('.bridegroom_other_occupation_div_for_marriage_certificate').show(); } else{$('.bridegroom_other_occupation_div_for_marriage_certificate').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_occupation_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3">
                                    <div class="bridegroom_other_occupation_div_for_marriage_certificate" style="display: none;">
                                        <label>11.2 Other Occupation Detail (अन्य व्यवसाय)<span class="color-nic-red">*</span> </label>
                                        <input type="text" id="bridegroom_other_occupation_for_marriage_certificate" name="bridegroom_other_occupation_for_marriage_certificate"
                                               maxlength="100" class="form-control" value="{{bridegroom_other_occupation}}" placeholder="Enter Other Occupation !" onblur="checkValidation('marriage-certificate', 'bridegroom_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);"
                                               >
                                        <span class="error-message error-message-marriage-certificate-bridegroom_other_occupation_for_marriage_certificate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Bridegroom Father's Details (दूल्हे के पिता का विवरण)</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>12. Name of Bridegroom's Father (दूल्हे के पिता का नाम)<span class="color-nic-red">*</span></label>
                                    <input type="text" id="bridegroom_father_name_for_marriage_certificate" name="bridegroom_father_name_for_marriage_certificate" class="form-control" placeholder="Enter Name of Bridegroom's Father !"
                                           maxlength="100" onblur="checkValidation('marriage-certificate', 'bridegroom_father_name_for_marriage_certificate', nameValidationMessage);" value="{{bridegroom_father_name}}">
                                    <span class="error-message error-message-marriage-certificate-bridegroom_father_name_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>13.1 Place of Birth  (जन्म स्थान का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_father_birthplace_state_for_marriage_certificate" name="bridegroom_father_birthplace_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Place of Birth"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_father_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bridegroom_father_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_father_birthplace_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>13.2 Taluka of Birth Place (जन्म स्थान का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_father_birthplace_district_for_marriage_certificate" name="bridegroom_father_birthplace_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_father_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
                                                MarriageCertificate.listview.getVillageData($(this), 'marriage_certificate', 'bridegroom_father_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_father_birthplace_district_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>13.3 City / Village of Birth Place (जन्म स्थान का शहर / गांव)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_father_birthplace_village_for_marriage_certificate" name="bridegroom_father_birthplace_village_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('marriage-certificate', 'bridegroom_father_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_father_birthplace_village_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>14.1 Place of Residence (निवास की जगह)<span class="color-nic-red">*</span></label>
                                    <textarea id="bridegroom_father_residence_for_marriage_certificate" name="bridegroom_father_residence_for_marriage_certificate" class="form-control" placeholder="Enter Place of Residence !"
                                              onblur="checkValidation('marriage-certificate', 'bridegroom_father_residence_for_marriage_certificate', residenceValidationMessage);"
                                              maxlength="200" >{{bridegroom_father_residence}}</textarea>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_father_residence_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>14.2 Taluka of Residence (निवास का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_father_residence_state_for_marriage_certificate" name="bridegroom_father_residence_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_father_residence_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bridegroom_father_residence');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_father_residence_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>14.3 District of Residence (निवास का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_father_residence_district_for_marriage_certificate" name="bridegroom_father_residence_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_father_residence_district_for_marriage_certificate', selectDistrictValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_father_residence_district_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>15. Occupation (व्यवसाय)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_father_occupation_for_marriage_certificate" name="bridegroom_father_occupation_for_marriage_certificate" class="form-control select2" onchange="checkValidation('marriage-certificate', 'bridegroom_father_occupation_for_marriage_certificate', occupationValidationMessage); if (this.value == 12){$('.bridegroom_father_other_occupation_div_for_marriage_certificate').show(); } else{$('.bridegroom_father_other_occupation_div_for_marriage_certificate').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_father_occupation_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <div class="bridegroom_father_other_occupation_div_for_marriage_certificate" style="display: none;">
                                        <label>15.2 Other Occupation Detail (अन्य व्यवसाय)<span class="color-nic-red">*</span></label>
                                        <input type="text" id="bridegroom_father_other_occupation_for_marriage_certificate" name="bridegroom_father_other_occupation_for_marriage_certificate"
                                               maxlength="100" class="form-control" value="{{bridegroom_father_other_occupation}}" placeholder="Enter Other Occupation !" onblur="checkValidation('marriage-certificate', 'bridegroom_father_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);"
                                               >
                                        <span class="error-message error-message-marriage-certificate-bridegroom_father_other_occupation_for_marriage_certificate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Bridegroom Mother's Details (दूल्हे की माँ का विवरण)</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>16. Name of Bridegroom's Mother (दूल्हे की माँ का नाम)<span class="color-nic-red">*</span></label>
                                    <input type="text" id="bridegroom_mother_name_for_marriage_certificate" name="bridegroom_mother_name_for_marriage_certificate" class="form-control" placeholder="Enter Name of Bridegroom's Mother !"
                                           maxlength="100" onblur="checkValidation('marriage-certificate', 'bridegroom_mother_name_for_marriage_certificate', nameValidationMessage);" value="{{bridegroom_mother_name}}">
                                    <span class="error-message error-message-marriage-certificate-bridegroom_mother_name_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>17.1 Place of Birth  (जन्म स्थान का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_mother_birthplace_state_for_marriage_certificate" name="bridegroom_mother_birthplace_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Place of Birth"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_mother_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bridegroom_mother_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_mother_birthplace_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>17.2 Taluka of Birth Place (जन्म स्थान का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_mother_birthplace_district_for_marriage_certificate" name="bridegroom_mother_birthplace_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_mother_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
                                                MarriageCertificate.listview.getVillageData($(this), 'marriage_certificate', 'bridegroom_mother_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_mother_birthplace_district_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>17.3 City / Village of Birth Place (जन्म स्थान का शहर / गांव)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_mother_birthplace_village_for_marriage_certificate" name="bridegroom_mother_birthplace_village_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('marriage-certificate', 'bridegroom_mother_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_mother_birthplace_village_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>18.1 Place of Residence (निवास की जगह)<span class="color-nic-red">*</span></label>
                                    <textarea id="bridegroom_mother_residence_for_marriage_certificate" name="bridegroom_mother_residence_for_marriage_certificate" class="form-control" placeholder="Enter Place of Residence !"
                                              onblur="checkValidation('marriage-certificate', 'bridegroom_mother_residence_for_marriage_certificate', residenceValidationMessage);"
                                              maxlength="200" >{{bridegroom_mother_residence}}</textarea>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_mother_residence_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>18.2 Taluka of Residence (निवास का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_mother_residence_state_for_marriage_certificate" name="bridegroom_mother_residence_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_mother_residence_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bridegroom_mother_residence');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_mother_residence_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>18.3 District of Residence (निवास का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_mother_residence_district_for_marriage_certificate" name="bridegroom_mother_residence_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('marriage-certificate', 'bridegroom_mother_residence_district_for_marriage_certificate', selectDistrictValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_mother_residence_district_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>19. Occupation (व्यवसाय)<span class="color-nic-red">*</span></label>
                                    <select id="bridegroom_mother_occupation_for_marriage_certificate" name="bridegroom_mother_occupation_for_marriage_certificate" class="form-control select2" onchange="checkValidation('marriage-certificate', 'bridegroom_mother_occupation_for_marriage_certificate', occupationValidationMessage); if (this.value == 12){$('.bridegroom_mother_other_occupation_div_for_marriage_certificate').show(); } else{$('.bridegroom_mother_other_occupation_div_for_marriage_certificate').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bridegroom_mother_occupation_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <div class="bridegroom_mother_other_occupation_div_for_marriage_certificate" style="display: none;">
                                        <label>19.2 Other Occupation Detail (अन्य व्यवसाय)<span class="color-nic-red">*</span></label>
                                        <input type="text" id="bridegroom_mother_other_occupation_for_marriage_certificate" name="bridegroom_mother_other_occupation_for_marriage_certificate"
                                               maxlength="100" class="form-control" value="{{bridegroom_mother_other_occupation}}" placeholder="Enter Other Occupation !" onblur="checkValidation('marriage-certificate', 'bridegroom_mother_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);"
                                               >
                                        <span class="error-message error-message-marriage-certificate-bridegroom_mother_other_occupation_for_marriage_certificate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Bride Details (दुल्हन का विवरण)</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>20. Name of Bride (दुल्हन का नाम)<span class="color-nic-red">*</span></label>
                                    <input type="text" id="bride_name_for_marriage_certificate" name="bride_name_for_marriage_certificate" class="form-control" placeholder="Enter Name of Bride !"
                                           maxlength="100" onblur="checkValidation('marriage-certificate', 'bride_name_for_marriage_certificate', nameValidationMessage);" value="{{bride_name}}">
                                    <span class="error-message error-message-marriage-certificate-bride_name_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>21.1 Place of Birth (जन्म स्थान का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bride_birthplace_state_for_marriage_certificate" name="bride_birthplace_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Place of Birth"
                                            onchange="checkValidation('marriage-certificate', 'bride_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bride_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_birthplace_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>21.2 Taluka of Birth Place (जन्म स्थान का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bride_birthplace_district_for_marriage_certificate" name="bride_birthplace_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bride_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
                                                MarriageCertificate.listview.getVillageData($(this), 'marriage_certificate', 'bride_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_birthplace_district_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>21.3 City / Village of Birth Place (जन्म स्थान का शहर / गांव)<span class="color-nic-red">*</span></label>
                                    <select id="bride_birthplace_village_for_marriage_certificate" name="bride_birthplace_village_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('marriage-certificate', 'bride_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_birthplace_village_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>22.1 Place of Residence (निवास की जगह)<span class="color-nic-red">*</span></label>
                                    <textarea id="bride_residence_for_marriage_certificate" name="bride_residence_for_marriage_certificate" class="form-control" placeholder="Enter Place of Residence !"
                                              onblur="checkValidation('marriage-certificate', 'bride_residence_for_marriage_certificate', residenceValidationMessage);"
                                              maxlength="200" >{{bride_residence}}</textarea>
                                    <span class="error-message error-message-marriage-certificate-bride_residence_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>22.2 Taluka of Residence (निवास का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bride_residence_state_for_marriage_certificate" name="bride_residence_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bride_residence_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bride_residence');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_residence_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>22.3 District of Residence (निवास का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bride_residence_district_for_marriage_certificate" name="bride_residence_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('marriage-certificate', 'bride_residence_district_for_marriage_certificate', selectDistrictValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_residence_district_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>23. Date of Birth (जन्म की तारीख)<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="bride_dob_for_marriage_certificate" id="bride_dob_for_marriage_certificate" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value="{{bride_dob}}"
                                               onblur="checkValidation('marriage-certificate', 'bride_dob_for_marriage_certificate', birthDateValidationMessage); calculateAgeForDob('bride_dob', 'bride_age', 'marriage_certificate');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-marriage-certificate-bride_dob_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>23.2 Age (उम्र)<span class="color-nic-red">*</span></label>
                                    <input type="text" id="bride_age_for_marriage_certificate" 
                                           name="bride_age_for_marriage_certificate" class="form-control"
                                           placeholder="Enter Age !" maxlength="100" 
                                           onblur="checkValidation('marriage-certificate', 'bride_age_for_marriage_certificate', ageValidationMessage);"
                                           value="{{bride_age}}" readonly="">
                                    <span class="error-message error-message-marriage-certificate-bride_age_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>24. Occupation (व्यवसाय)<span class="color-nic-red">*</span></label>
                                    <select id="bride_occupation_for_marriage_certificate" name="bride_occupation_for_marriage_certificate" class="form-control select2" onchange="checkValidation('marriage-certificate', 'bride_occupation_for_marriage_certificate', occupationValidationMessage); if (this.value == 12){$('.bride_other_occupation_div_for_marriage_certificate').show(); } else{$('.bride_other_occupation_div_for_marriage_certificate').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_occupation_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3">
                                    <div class="bride_other_occupation_div_for_marriage_certificate" style="display: none;">
                                        <label>24.2 Other Occupation Detail (अन्य व्यवसाय)<span class="color-nic-red">*</span></label>
                                        <input type="text" id="bride_other_occupation_for_marriage_certificate" name="bride_other_occupation_for_marriage_certificate"
                                               maxlength="100" class="form-control" value="{{bride_other_occupation}}" placeholder="Enter Other Occupation !" onblur="checkValidation('marriage-certificate', 'bride_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);"
                                               >
                                        <span class="error-message error-message-marriage-certificate-bride_other_occupation_for_marriage_certificate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Bride Father's Details (दुल्हन के पिता का विवरण)</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>25. Name of Bride's Father (दुल्हन के पिता का नाम)<span class="color-nic-red">*</span></label>
                                    <input type="text" id="bride_father_name_for_marriage_certificate" name="bride_father_name_for_marriage_certificate" class="form-control" placeholder="Enter Name of Bride's Father !"
                                           maxlength="100" onblur="checkValidation('marriage-certificate', 'bride_father_name_for_marriage_certificate', nameValidationMessage);" value="{{bride_father_name}}">
                                    <span class="error-message error-message-marriage-certificate-bride_father_name_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>26.1 Place of Birth (जन्म स्थान का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bride_father_birthplace_state_for_marriage_certificate" name="bride_father_birthplace_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Place of Birth"
                                            onchange="checkValidation('marriage-certificate', 'bride_father_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bride_father_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_father_birthplace_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>26.2 Taluka of Birth Place (जन्म स्थान का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bride_father_birthplace_district_for_marriage_certificate" name="bride_father_birthplace_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bride_father_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
                                                MarriageCertificate.listview.getVillageData($(this), 'marriage_certificate', 'bride_father_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_father_birthplace_district_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>26.3 City / Village of Birth Place (जन्म स्थान का शहर / गांव)<span class="color-nic-red">*</span></label>
                                    <select id="bride_father_birthplace_village_for_marriage_certificate" name="bride_father_birthplace_village_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('marriage-certificate', 'bride_father_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_father_birthplace_village_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>27.1 Place of Residence (निवास की जगह)<span class="color-nic-red">*</span></label>
                                    <textarea id="bride_father_residence_for_marriage_certificate" name="bride_father_residence_for_marriage_certificate" class="form-control" placeholder="Enter Place of Residence !"
                                              onblur="checkValidation('marriage-certificate', 'bride_father_residence_for_marriage_certificate', residenceValidationMessage);"
                                              maxlength="200" >{{bride_father_residence}}</textarea>
                                    <span class="error-message error-message-marriage-certificate-bride_father_residence_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>27.2 Taluka of Residence (निवास का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bride_father_residence_state_for_marriage_certificate" name="bride_father_residence_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bride_father_residence_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bride_father_residence');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_father_residence_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>27.3 District of Residence (निवास का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bride_father_residence_district_for_marriage_certificate" name="bride_father_residence_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('marriage-certificate', 'bride_father_residence_district_for_marriage_certificate', selectDistrictValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_father_residence_district_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>28. Occupation (व्यवसाय)<span class="color-nic-red">*</span></label>
                                    <select id="bride_father_occupation_for_marriage_certificate" name="bride_father_occupation_for_marriage_certificate" class="form-control select2" onchange="checkValidation('marriage-certificate', 'bride_father_occupation_for_marriage_certificate', occupationValidationMessage); if (this.value == 12){$('.bride_father_other_occupation_div_for_marriage_certificate').show(); } else{$('.bride_father_other_occupation_div_for_marriage_certificate').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_father_occupation_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <div class="bride_father_other_occupation_div_for_marriage_certificate" style="display: none;">
                                        <label>28.2 Other Occupation Detail (अन्य व्यवसाय)<span class="color-nic-red">*</span></label>
                                        <input type="text" id="bride_father_other_occupation_for_marriage_certificate" name="bride_father_other_occupation_for_marriage_certificate"
                                               maxlength="100" class="form-control" value="{{bride_father_other_occupation}}" placeholder="Enter Other Occupation !" onblur="checkValidation('marriage-certificate', 'bride_father_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);"
                                               >
                                        <span class="error-message error-message-marriage-certificate-bride_father_other_occupation_for_marriage_certificate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Bride Mother's Details (दुल्हन की माँ का विवरण)</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>29. Name of Bride's Mother (दुल्हन की माँ का नाम)<span class="color-nic-red">*</span></label>
                                    <input type="text" id="bride_mother_name_for_marriage_certificate" name="bride_mother_name_for_marriage_certificate" class="form-control" placeholder="Enter Name of Bride's Mother !"
                                           maxlength="100" onblur="checkValidation('marriage-certificate', 'bride_mother_name_for_marriage_certificate', nameValidationMessage);" value="{{bride_mother_name}}">
                                    <span class="error-message error-message-marriage-certificate-bride_mother_name_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>29.1 Place of Birth (जन्म स्थान का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bride_mother_birthplace_state_for_marriage_certificate" name="bride_mother_birthplace_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Place of Birth"
                                            onchange="checkValidation('marriage-certificate', 'bride_mother_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bride_mother_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_mother_birthplace_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>29.2 Taluka of Birth Place (जन्म स्थान का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bride_mother_birthplace_district_for_marriage_certificate" name="bride_mother_birthplace_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bride_mother_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
                                                MarriageCertificate.listview.getVillageData($(this), 'marriage_certificate', 'bride_mother_birthplace');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_mother_birthplace_district_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>29.3 City / Village of Birth Place (जन्म स्थान का शहर / गांव)<span class="color-nic-red">*</span></label>
                                    <select id="bride_mother_birthplace_village_for_marriage_certificate" name="bride_mother_birthplace_village_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('marriage-certificate', 'bride_mother_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_mother_birthplace_village_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>30.1 Place of Residence (निवास की जगह)<span class="color-nic-red">*</span></label>
                                    <textarea id="bride_mother_residence_for_marriage_certificate" name="bride_mother_residence_for_marriage_certificate" class="form-control" placeholder="Enter Place of Residence !"
                                              onblur="checkValidation('marriage-certificate', 'bride_mother_residence_for_marriage_certificate', residenceValidationMessage);"
                                              maxlength="200" >{{bride_mother_residence}}</textarea>
                                    <span class="error-message error-message-marriage-certificate-bride_mother_residence_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>30.2 Taluka of Residence (निवास का राज्य)<span class="color-nic-red">*</span></label>
                                    <select id="bride_mother_residence_state_for_marriage_certificate" name="bride_mother_residence_state_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select Taluka"
                                            onchange="checkValidation('marriage-certificate', 'bride_mother_residence_state_for_marriage_certificate', selectStateValidationMessage);
                                                MarriageCertificate.listview.getDistrictData($(this), 'marriage_certificate', 'bride_mother_residence');">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_mother_residence_state_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>30.3 District of Residence (निवास का जिला)<span class="color-nic-red">*</span></label>
                                    <select id="bride_mother_residence_district_for_marriage_certificate" name="bride_mother_residence_district_for_marriage_certificate" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('marriage-certificate', 'bride_mother_residence_district_for_marriage_certificate', selectDistrictValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_mother_residence_district_for_marriage_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>31. Occupation (व्यवसाय)<span class="color-nic-red">*</span></label>
                                    <select id="bride_mother_occupation_for_marriage_certificate" name="bride_mother_occupation_for_marriage_certificate" class="form-control select2" onchange="checkValidation('marriage-certificate', 'bride_mother_occupation_for_marriage_certificate', occupationValidationMessage); if (this.value == 12){$('.bride_mother_other_occupation_div_for_marriage_certificate').show(); } else{$('.bride_mother_other_occupation_div_for_marriage_certificate').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-marriage-certificate-bride_mother_occupation_for_marriage_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <div class="bride_mother_other_occupation_div_for_marriage_certificate" style="display: none;">
                                        <label>31.2 Other Occupation Detail (अन्य व्यवसाय)<span class="color-nic-red">*</span></label>
                                        <input type="text" id="bride_mother_other_occupation_for_marriage_certificate" name="bride_mother_other_occupation_for_marriage_certificate"
                                               maxlength="100" class="form-control" value="{{bride_mother_other_occupation}}" placeholder="Enter Other Occupation !" onblur="checkValidation('marriage-certificate', 'bride_mother_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);"
                                               >
                                        <span class="error-message error-message-marriage-certificate-bride_mother_other_occupation_for_marriage_certificate"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Enclosed as below</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <span style="color: red;font-weight: bold;">Note : Must upload pdf file with original scan documents <br></span><br/>
                            <div class="row">
                                <div class="col-12 mb-2" id="bridegroom_photo_container_for_marriage_certificate">
                                    <label>32. Bridegroom and Bride Joint Photo <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-marriage-certificate-bridegroom_photo_for_marriage_certificate"></div>
                                </div>
                                <div class="form-group col-sm-12" id="bridegroom_photo_name_container_for_marriage_certificate" style="display: none;">
                                    <label>32. Bridegroom and Bride Joint Photo <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="bridegroom_photo_download"><img id="bridegroom_photo_name_image_for_marriage_certificate" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_marriage_certificate_{{VALUE_ONE}}"></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div  class="bridegroom_birth_certi_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bridegroom_birth_certi_doc_container_for_marriage_certificate">
                                                <label>33. Bridegroom Birth Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bridegroom_birth_certi_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bridegroom_birth_certi_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>33. Bridegroom Birth Certificate<span style="color: red;">*</span></label><br>
                                                <a target="_blank" id="bridegroom_birth_certi_doc_download"><label id="bridegroom_birth_certi_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="bridegroom_domicile_certi_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bridegroom_domicile_certi_doc_container_for_marriage_certificate">
                                                <label>34. Bridegroom Domicile / Residence Certificate <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bridegroom_domicile_certi_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bridegroom_domicile_certi_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>34. Bridegroom Domicile / Residence Certificate</label><br>
                                                <a target="_blank" id="bridegroom_domicile_certi_doc_download"><label id="bridegroom_domicile_certi_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="bridegroom_aadhar_card_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bridegroom_aadhar_card_doc_container_for_marriage_certificate">
                                                <label>35. Bridegroom Aadhar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bridegroom_aadhar_card_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bridegroom_aadhar_card_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>35. Bridegroom Aadhar Card<span style="color: red;">*</span></label><br>
                                                <a target="_blank" id="bridegroom_aadhar_card_doc_download"><label id="bridegroom_aadhar_card_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="bridegroom_election_card_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bridegroom_election_card_doc_container_for_marriage_certificate">
                                                <label>36. Bridegroom Election Card <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bridegroom_election_card_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bridegroom_election_card_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>36. Bridegroom Election Card</label><br>
                                                <a target="_blank" id="bridegroom_election_card_doc_download"><label id="bridegroom_election_card_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div  class="bridegroom_passport_copy_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bridegroom_passport_copy_doc_container_for_marriage_certificate">
                                                <label>37. Bridegroom Passport Zerox Copy (if holding) <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bridegroom_passport_copy_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bridegroom_passport_copy_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>37. Bridegroom Passport Zerox Copy (if holding)</label><br>
                                                <a target="_blank" id="bridegroom_passport_copy_doc_download"><label id="bridegroom_passport_copy_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div  class="bridegroom_court_order_certi_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bridegroom_court_order_certi_doc_container_for_marriage_certificate">
                                                <label>38. Bridegroom Court Order Certificate (if Non-indian resident)<span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bridegroom_court_order_certi_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bridegroom_court_order_certi_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>38. Bridegroom Court Order Certificate (if Non-indian resident)</label><br>
                                                <a target="_blank" id="bridegroom_court_order_certi_doc_download"><label id="bridegroom_court_order_certi_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="samaj_marriage_certi_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="samaj_marriage_certi_doc_container_for_marriage_certificate">
                                                <label>39. Samaj Marriage Certificate (Purpose for marriage should be mention)<span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-samaj_marriage_certi_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="samaj_marriage_certi_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>39. Samaj Marriage Certificate (Purpose for marriage should be mention)</label><br>
                                                <a target="_blank" id="samaj_marriage_certi_doc_download"><label id="samaj_marriage_certi_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_FIFTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_FIFTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <div class="row">
                                        <div class="col-12 mb-2" id="bride_photo_container_for_marriage_certificate">
                                            <label>39. Bride Photo <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                            <div class="error-message error-message-marriage-certificate-bride_photo_for_marriage_certificate"></div>
                                        </div>
                                        <div class="form-group col-sm-12" id="bride_photo_name_container_for_marriage_certificate" style="display: none;">
                                            <label>39. Bride Photo <span style="color: red;">* </span></label><br>
                                            <a target="_blank" id="bride_photo_download"><img id="bride_photo_name_image_for_marriage_certificate" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_marriage_certificate_{{VALUE_TWO}}"></a>
                                        </div>
                                        <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                    </div> -->
                                    <div class="row">
                                        <div  class="bride_birth_certi_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bride_birth_certi_doc_container_for_marriage_certificate">
                                                <label>40. Bride Birth Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bride_birth_certi_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bride_birth_certi_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>40. Bride Birth Certificate<span style="color: red;">*</span></label><br>
                                                <a target="_blank" id="bride_birth_certi_doc_download"><label id="bride_birth_certi_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div  class="bride_domicile_certi_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bride_domicile_certi_doc_container_for_marriage_certificate">
                                                <label>41. Bride Domicile / Residence Certificate <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bride_domicile_certi_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bride_domicile_certi_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>41. Bride Domicile / Residence Certificate</label><br>
                                                <a target="_blank" id="bride_domicile_certi_doc_download"><label id="bride_domicile_certi_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="bride_aadhar_card_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bride_aadhar_card_doc_container_for_marriage_certificate">
                                                <label>42. Bride Aadhar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bride_aadhar_card_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bride_aadhar_card_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>42. Bride Aadhar Card<span style="color: red;">*</span></label><br>
                                                <a target="_blank" id="bride_aadhar_card_doc_download"><label id="bride_aadhar_card_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="bride_election_card_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bride_election_card_doc_container_for_marriage_certificate">
                                                <label>43. Bride Election Card <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bride_election_card_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bride_election_card_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>43. Bride Election Card</label><br>
                                                <a target="_blank" id="bride_election_card_doc_download"><label id="bride_election_card_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_THIRTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div  class="bride_passport_copy_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bride_passport_copy_doc_container_for_marriage_certificate">
                                                <label>44. Bride Passport Zerox Copy (if holding) <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bride_passport_copy_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bride_passport_copy_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>44. Bride Passport Zerox Copy (if holding)</label><br>
                                                <a target="_blank" id="bride_passport_copy_doc_download"><label id="bride_passport_copy_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="bride_court_order_certi_doc_item_container_for_marriage_certificate" > 
                                            <div class="col-12 mb-2" id="bride_court_order_certi_doc_container_for_marriage_certificate">
                                                <label>45. Bride Court Order Certificate (if Non-indian resident)<span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-marriage-certificate-bride_court_order_certi_doc_for_marriage_certificate"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="bride_court_order_certi_doc_name_container_for_marriage_certificate" style="display: none;">
                                                <label>45. Bride Court Order Certificate (if Non-indian resident)</label><br>
                                                <a target="_blank" id="bride_court_order_certi_doc_download"><label id="bride_court_order_certi_doc_name_image_for_marriage_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_marriage_certificate_{{VALUE_FOURTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 mb-2" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" id="submit_btn_for_marriage_certificate" class="btn btn-sm btn-success" 
                                onclick="MarriageCertificate.listview.askForSubmitMarriageCertificate({{VALUE_TWO}});" 
                                style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" 
                                onclick="MarriageCertificate.listview.loadMarriageCertificateData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>