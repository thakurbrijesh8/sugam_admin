<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Heir Ship Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application for issue of Heir Ship Certificate </div>
            </div>
            <form role="form" id="heirship_form" name="heirship_form" onsubmit="return false;"
                  autocomplete="off">
                <input type="hidden" id="heirship_id_for_heirship" name="heirship_id_for_heirship" value="{{heirship_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-heirship f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    To,<br>
                    The Mamlatdar,
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>1. District<span class="color-nic-red">*</span></label>
                            <select id="district_for_heirship" name="district_for_heirship" class="form-control select2"
                                    onchange="checkValidation('heirship', 'district_for_heirship', selectDistrictValidationMessage);
                                            Heirship.listview.districtChangeEvent($(this));"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-heirship-district_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>1.1 Name of Village Panchayat/D.M.C<span class="color-nic-red">*</span></label>
                            <select id="village_name_for_heirship" name="village_name_for_heirship" class="form-control select2"
                                    onchange="checkValidation('heirship', 'village_name_for_heirship', oneOptionValidationMessage); Heirship.listview.villageDMCChangeEvent($(this));"
                                    data-placeholder="Select Name of Village Panchayat/D.M.C" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-heirship-village_name_for_heirship"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Applicant full Name <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_name_for_heirship" name="applicant_name_for_heirship" class="form-control" placeholder="Enter Name of Applicant !"
                                   maxlength="100" onblur="checkValidation('heirship', 'applicant_name_for_heirship', applicantNameValidationMessage);" value="{{applicant_name}}">
                            <span class="error-message error-message-heirship-applicant_name_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>2.1 Name of Father <span class="color-nic-red">*</span></label>
                            <input type="text" id="father_name_for_heirship" name="father_name_for_heirship"
                                   maxlength="100" class="form-control" value="{{applicant_father_name}}" placeholder="Enter Father Name !" onblur="checkValidation('heirship', 'father_name_for_heirship', fatherNameValidationMessage);"
                                   >
                            <span class="error-message error-message-heirship-father_name_for_heirship"></span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-body pt-1" style="background-color: aliceblue;">
                                <div class="row">
                                    <div class="form-group col-sm-6" style="margin-top: 25px;">
                                        <label>3. Applicant’s Present Address</label><br/>
                                        <label>3.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="pre_house_no_for_heirship" name="pre_house_no_for_heirship" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{pre_house_no}}" onblur="checkValidation('heirship', 'pre_house_no_for_heirship', houseNoValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-heirship-pre_house_no_for_heirship"></span>
                                    </div>
                                    <div class="form-group col-sm-6" style="margin-top: 47px;">
                                        <label>3.2 Building Name / House Name</label>
                                        <div class="input-group">
                                            <input type="text" id="pre_house_name_for_heirship" name="pre_house_name_for_heirship" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{pre_house_name}}">
                                        </div>
                                        <span class="error-message error-message-heirship-pre_house_name_for_heirship"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>3.3 Street <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="pre_street_for_heirship" name="pre_street_for_heirship" class="form-control" placeholder="Enter Street !"
                                                   maxlength="100" onblur="checkValidation('heirship', 'pre_street_for_heirship', streetValidationMessage);" value="{{pre_street}}">
                                        </div>
                                        <span class="error-message error-message-heirship-pre_street_for_heirship"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>3.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="pre_village_for_heirship" name="pre_village_for_heirship" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                   maxlength="100" onblur="checkValidation('heirship', 'pre_village_for_heirship', villageNameValidationMessage);" value="{{pre_village}}" readonly="">
                                        </div>
                                        <span class="error-message error-message-heirship-pre_village_for_heirship"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>3.5 Select City<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="pre_city_for_heirship" name="pre_city_for_heirship" class="form-control" placeholder="Enter City !"
                                                   maxlength="100" onblur="checkValidation('heirship', 'pre_city_for_heirship', selectCityValidationMessage);" value="{{pre_city}}" readonly="">
                                        </div>
                                        <span class="error-message error-message-heirship-pre_city_for_heirship"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>3.6 Pincode <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="pre_pincode_for_heirship" name="pre_pincode_for_heirship" class="form-control" placeholder="Enter Pincode !" maxlength="6" value="{{pre_pincode}}" onblur="checkValidation('heirship', 'pre_pincode_for_heirship', pincodeValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-heirship-pre_pincode_for_heirship"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-body pt-1" style="background-color: aliceblue;">

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>Same as Present Address</label>&nbsp;
                                        <input type="checkbox" id="same_as_present" name="same_as_present" class="checkbox" value="{{IS_CHEKED_YES}}"  onchange="Heirship.listview.getPresentAddress($(this));">
                                        <span class="error-message error-message-heirship-billingtoo"></span><br/>
                                        <label>4. Applicant’s Permanent Address</label><br/>   
                                        <label>4.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_house_no_for_heirship" name="per_house_no_for_heirship" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{per_house_no}}" onblur="checkValidation('heirship', 'per_house_no_for_heirship', houseNoValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-heirship-per_house_no_for_heirship"></span>
                                    </div>
                                    <div class="form-group col-sm-6" style="margin-top: 45px;">
                                        <label>4.2 Building Name / House Name</label>
                                        <div class="input-group">
                                            <input type="text" id="per_house_name_for_heirship" name="per_house_name_for_heirship" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{per_house_name}}">
                                        </div>
                                        <span class="error-message error-message-heirship-per_house_name_for_heirship"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>4.3 Street <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_street_for_heirship" name="per_street_for_heirship" class="form-control" placeholder="Enter Street !"
                                                   maxlength="100" onblur="checkValidation('heirship', 'per_street_for_heirship', streetValidationMessage);" value="{{per_street}}">
                                        </div>
                                        <span class="error-message error-message-heirship-per_street_for_heirship"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>4.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_village_for_heirship" name="per_village_for_heirship" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                   maxlength="100" onblur="checkValidation('heirship', 'per_village_for_heirship', villageNameValidationMessage);" value="{{per_village}}">
                                        </div>
                                        <span class="error-message error-message-heirship-per_village_for_heirship"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>4.5 Select City<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_city_for_heirship" name="per_city_for_heirship" class="form-control" placeholder="Enter City !"
                                                   maxlength="100" onblur="checkValidation('heirship', 'per_city_for_heirship', selectCityValidationMessage);" onchange="Heirship.listview.getPincode($(this));" value="{{per_city}}">
                                        </div>
                                        <span class="error-message error-message-heirship-per_city_for_heirship"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>4.6 Pincode <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_pincode_for_heirship" name="per_pincode_for_heirship" class="form-control" placeholder="Enter Pincode !" maxlength="6" value="{{per_pincode}}" onblur="checkValidation('heirship', 'per_pincode_for_heirship', pincodeValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-heirship-per_pincode_for_heirship"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                    <div class="">
                                            <div class="row"><label>&nbsp;&nbsp;3. Present Address</label></div><hr/>
                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <label>3.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" id="pre_house_no_for_heirship" name="pre_house_no_for_heirship" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{pre_house_no}}" onblur="checkValidation('heirship', 'pre_house_no_for_heirship', houseNoValidationMessage);">
                                                    </div>
                                                    <span class="error-message error-message-heirship-pre_house_no_for_heirship"></span>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label>3.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" id="pre_house_name_for_heirship" name="pre_house_name_for_heirship" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{pre_house_name}}" onblur="checkValidation('heirship', 'pre_house_name_for_heirship', houseNameValidationMessage);">
                                                    </div>
                                                    <span class="error-message error-message-heirship-pre_house_name_for_heirship"></span>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label>3.3 Street <span class="color-nic-red">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" id="pre_street_for_heirship" name="pre_street_for_heirship" class="form-control" placeholder="Enter Street !"
                                                               maxlength="100" onblur="checkValidation('heirship', 'pre_street_for_heirship', streetValidationMessage);" value="{{pre_street}}">
                                                    </div>
                                                    <span class="error-message error-message-heirship-pre_street_for_heirship"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <label>3.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" id="pre_village_for_heirship" name="pre_village_for_heirship" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                               maxlength="100" onblur="checkValidation('heirship', 'pre_village_for_heirship', villageNameValidationMessage);" value="{{pre_village}}">
                                                    </div>
                                                    <span class="error-message error-message-heirship-pre_village_for_heirship"></span>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label>3.5 Select City<span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select class="form-control select2" id="pre_city_for_heirship" name="pre_city_for_heirship"
                                                                data-placeholder="City !"  onblur="checkValidation('heirship', 'pre_city_for_heirship', selectCityValidationMessage);" >
                                                            <option value="">Select City</option>
                                                            <option value="1">Nani Daman</option>
                                                            <option value="2">Moti Daman</option>
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-heirship-pre_city_for_heirship"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="row"><label>&nbsp;&nbsp;4. Permanent Address &nbsp;<input type="checkbox" id="same_as_present" name="same_as_present" value="{{IS_CHECKED_YES}}" onclick="Heirship.listview.getPresentAddress(this);"> &nbsp;Same as Present Address</label></div><hr/>
                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <label>4.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" id="per_house_no_for_heirship" name="per_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{per_house_no}}" onblur="checkValidation('heirship', 'per_house_no_for_heirship', houseNoValidationMessage);">
                                                    </div>
                                                    <span class="error-message error-message-heirship-per_house_no_for_heirship"></span>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label>4.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" id="per_house_name_for_heirship" name="per_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{per_house_name}}" onblur="checkValidation('heirship', 'per_house_name_for_heirship', houseNameValidationMessage);">
                                                    </div>
                                                    <span class="error-message error-message-heirship-per_house_name_for_heirship"></span>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label>4.3 Street <span class="color-nic-red">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" id="per_street_for_heirship" name="per_street" class="form-control" placeholder="Enter Street !"
                                                               maxlength="100" onblur="checkValidation('heirship', 'per_street_for_heirship', streetValidationMessage);" value="{{per_street}}">
                                                    </div>
                                                    <span class="error-message error-message-heirship-per_street_for_heirship"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <label>4.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" id="per_village_for_heirship" name="per_village" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                               maxlength="100" onblur="checkValidation('heirship', 'per_village_for_heirship', villageNameValidationMessage);" value="{{per_village}}">
                                                    </div>
                                                    <span class="error-message error-message-heirship-per_village_for_heirship"></span>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label>4.5 Select City<span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select class="form-control select2" id="per_city_for_heirship" name="per_city_for_heirship"
                                                                data-placeholder="City !"  onblur="checkValidation('heirship', 'per_city_for_heirship', selectCityValidationMessage);" >
                                                            <option value="">Select City</option>
                                                            <option value="1">Nani Daman</option>
                                                            <option value="2">Moti Daman</option>
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-heirship-per_city_for_heirship"></span>
                                                </div>
                                            </div>
                                        </div>-->
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Applicant's Mobile Number <span class="color-nic-red">*</span></label>
                            <input type="text" id="mobile_number_for_heirship" name="mobile_number_for_heirship" class="form-control" placeholder="Enter Mobile Number !"
                                   maxlength="10" onkeyup="checkNumeric($(this));"
                                   onblur="checkValidationForMobileNumber('heirship', 'mobile_number_for_heirship');" value="{{mobile_number}}">
                            <span class="error-message error-message-heirship-mobile_number_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>5.1 Applicant's Email Address </label>
                            <input type="text" id="email_for_heirship" name="email_for_heirship"
                                   class="form-control" placeholder="Enter Email !"  maxlength="100"
                                   onblur="checkValidationForEmail('heirship', 'email_for_heirship');" value="{{email}}">
                            <span class="error-message error-message-heirship-email_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>6. Applicant's Aadhar Number</label>
                            <div class="input-group">
                                <input type="text" id="aadhar_number_for_heirship" name="aadhar_number_for_heirship"
                                       class="form-control" placeholder="Enter Aadhar Number !"
                                       onblur="aadharNumberValidation('heirship', 'aadhar_number_for_heirship');"
                                       maxlength="12" value="{{aadhar_number}}">
                            </div>
                            <span class="error-message error-message-heirship-aadhar_number_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>6.1 Applicant's Election Number</label>
                            <div class="input-group">
                                <input type="text" id="election_number_for_heirship" name="election_number_for_heirship"
                                       class="form-control" placeholder="Enter Election Number !"
                                       maxlength="50" value="{{election_number}}">
                            </div>
                            <span class="error-message error-message-heirship-election_number_for_heirship"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>7. Applicant Date of Birth<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="applicant_dob_for_heirship" id="applicant_dob_for_heirship" class="form-control date_picker"
                                       placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{applicant_dob_text}}"
                                       onblur="checkValidation('heirship', 'applicant_dob_for_heirship', birthDateValidationMessage); calculateAge('for_heirship');"
                                       onchange="calculateAge('for_heirship');">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-heirship-applicant_dob_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>7.1 Applicant Age<span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_age_for_heirship" 
                                   name="applicant_age_for_heirship" class="form-control"
                                   placeholder="Enter Applicant Age !" maxlength="3" 
                                   onblur="checkValidation('heirship', 'applicant_age_for_heirship', applicantAgeValidationMessage);"
                                   value="{{applicant_age}}" readonly="">
                            <span class="error-message error-message-heirship-applicant_age_for_heirship"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>8. Applicant Religion <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_religion_for_heirship" 
                                   name="applicant_religion_for_heirship" class="form-control"
                                   placeholder="Enter Religion !" maxlength="100" 
                                   onblur="checkValidation('heirship', 'applicant_religion_for_heirship', religionValidationMessage);"
                                   value="{{religion}}">
                            <span class="error-message error-message-heirship-applicant_religion_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8.1 Gender<span class="color-nic-red">*</span></label>
                            <div id="gender_container_for_heirship"></div>
                            <span class="error-message error-message-heirship-gender_for_heirship"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9. Applicant Nationality <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_nationality_for_heirship" name="applicant_nationality_for_heirship" class="form-control" placeholder="Enter Applicant Nationality!"
                                   maxlength="100" onblur="checkValidation('heirship', 'applicant_nationality_for_heirship', applicantNationalityValidationMessage);" value="{{nationality}}">
                            <span class="error-message error-message-heirship-applicant_nationality_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>9.1 Marital Status<span class="color-nic-red">*</span></label>
                            <div id="marital_status_container_for_heirship"></div>
                            <span class="error-message error-message-heirship-marital_status_for_heirship"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>10. Applicant Caste <span class="color-nic-red">*</span></label>
                            <input type="text" id="caste_for_heirship" name="caste_for_heirship" class="form-control" placeholder="Enter Applicant Caste !"
                                   maxlength="100" onblur="checkValidation('heirship', 'caste_for_heirship', casteValidationMessage);" value="{{caste}}">
                            <span class="error-message error-message-heirship-caste_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>10.1 Applicant Occupation<span class="color-nic-red">*</span></label>
                            <select id="applicant_occupation_for_heirship" name="applicant_occupation_for_heirship" class="form-control select2" onchange="checkValidation('heirship', 'applicant_occupation_for_heirship', applicantOccupationValidationMessage); showOtherapplicantOccupationtext(this, 'applicant_occupation_other_div', 'heirship');" data-placeholder="Select Occupation" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-heirship-applicant_occupation_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6" id="applicant_occupation_other_div_for_heirship" style="display: none;">
                            <label>10.2 Applicant Other Occupation<span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_occupation_other_for_heirship" name="applicant_occupation_other_for_heirship" class="form-control" placeholder="Enter Applicant Other Occupation !"
                                   maxlength="100" onblur="checkValidation('heirship', 'applicant_occupation_other_for_heirship', otherOccupationValidationMessage);" value="{{occupation_other}}">
                            <span class="error-message error-message-heirship-applicant_occupation_other_for_heirship"></span>
                        </div>
                    </div>
                    <div class="row"><label>10. Death Person Details </label></div><hr/>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>11.1 Applicant Relation with Deceased Person <span class="color-nic-red">*</span></label>
                            <select id="relation_deceased_person_for_heirship" name="relation_deceased_person_for_heirship" class="form-control select2" onchange="checkValidation('heirship', 'relation_deceased_person_for_heirship', relationWithDeceasedPersonValidationMessage);" data-placeholder="Select Relation with Deceased Person" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-heirship-relation_deceased_person_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>11.2 Name of Deceased Person <span class="color-nic-red">*</span></label>
                            <input type="text" id="death_person_name_for_heirship" name="death_person_name_for_heirship" class="form-control" placeholder="Enter Name of Deceased Person !"
                                   maxlength="100" onblur="checkValidation('heirship', 'death_person_name_for_heirship', deathPersonNameValidationMessage);" value="{{death_person_name}}">
                            <span class="error-message error-message-heirship-death_person_name_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>11.3 Deceased Person relation with Applicant <span class="color-nic-red">*</span></label>
                            <select id="relation_with_applicant_for_heirship" name="relation_with_applicant_for_heirship" class="form-control select2" onchange="checkValidation('heirship', 'relation_with_applicant_for_heirship', applicantRelationshipValidationMessage);" data-placeholder="Select Deceased Person relation with Applicant" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-heirship-relation_with_applicant_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>11.4 Date of Death <span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" class= "form-control" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"     
                                       value="{{death_date_text}}" id="death_date_for_heirship" name="death_date_for_heirship" onblur="checkValidation('heirship', 'death_date_for_heirship', dateValidationMessage);">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-heirship-death_date_for_heirship"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>11.5 Place of Death <span class="color-nic-red">*</span></label>
                            <input type="text" id="death_place_for_heirship" name="death_place_for_heirship" class="form-control" placeholder="Enter Place of Death !"
                                   maxlength="100" onblur="checkValidation('heirship', 'death_place_for_heirship', deathOfPlaceValidationMessage);" value="{{death_place}}">
                            <span class="error-message error-message-heirship-death_place_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>11.6 Death Person Aadhar Number</label>
                            <div class="input-group">
                                <input type="text" id="death_aadhar_number_for_heirship" name="death_aadhar_number_for_heirship"
                                       class="form-control" placeholder="Enter Death Aadhar Number !"
                                       onblur="aadharNumberValidation('heirship', 'death_aadhar_number_for_heirship');"
                                       maxlength="12" value="{{death_aadhar_number}}">
                            </div>
                            <span class="error-message error-message-heirship-death_aadhar_number_for_heirship"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>11.7 Deceased Person Marital Status<span class="color-nic-red">*</span></label>
                            <div id="death_marital_status_container_for_heirship"></div>
                            <span class="error-message error-message-heirship-death_marital_status_for_heirship"></span>
                        </div>
                    </div>
                    <div class="card applicant_have_earning_member_item_container_for_heirship">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    12. Please Give Details of family members.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-heirship-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 80px;">family members Name <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 80px;">Alive / Death <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 20px;">Age <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 150px;">Relation With Deceased Person <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 150px;">Marital Status <span class="color-nic-red">*</span></th>
                                            <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="family_member_info_container_for_heirship">
                                    </tbody>
                                </table>
                            </div> 
                            <div class="row">
                                <div class="col-6 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="Heirship.listview.addFamilyMemberInfo({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    13. Please Give Details of Witness.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-heirship-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <!-- <th class="p-1" style="min-width: 100px;">Relation With Applicant</th> -->
                                            <th class="p-1" style="min-width: 150px;">Name <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 150px;">Age <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 150px;">Address <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 150px;">Occupation <span class="color-nic-red">*</span></th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr class="p-1">
                                            <td><b>1</b></td>
                                            <td>
                                                <input type="text" id="witness1_name_for_heirship" name="witness1_name_for_heirship"
                                                       maxlength="200" class="form-control" value="{{witness1_name}}" placeholder="Enter Witness 1 Name !" onblur="checkValidation('heirship', 'witness1_name_for_heirship');">
                                                <span class="error-message error-message-heirship-witness1_name_for_heirship"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="witness1_age_for_heirship" name="witness1_age_for_heirship"
                                                       maxlength="2" class="form-control" value="{{witness1_age}}" placeholder="Enter Witness 1 Age !" onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this)); checkValidation('heirship', 'witness1_age_for_heirship');">
                                                <span class="error-message error-message-heirship-witness1_age_for_heirship"></span>
                                            </td>
                                            <td>
                                                <textarea type="text" id="witness1_address_for_heirship" name="witness1_address_for_heirship"
                                                          maxlength="300" class="form-control" placeholder="Enter Witness 1 Address !" onblur="checkValidation('heirship', 'witness1_address_for_heirship');">{{witness1_address}}</textarea>
                                                <span class="error-message error-message-heirship-witness1_address_for_heirship"></span>
                                            </td>
                                            <td>
                                                <select id="witness1_occupation_for_heirship" name="witness1_occupation_for_heirship" class="form-control select2" style="width: 100%;" data-placeholder="Select Occupation" onchange="showOtherapplicantOccupationtext(this, 'witness1_occupation_other', 'heirship');" onblur="showOtherapplicantOccupationtext(this, 'witness1_occupation_other', 'heirship'); checkValidation('heirship', 'witness1_occupation_for_heirship', applicantOccupationValidationMessage);">
                                                </select>
                                                <span class="error-message error-message-heirship-witness1_occupation_for_heirship"></span><hr>
                                                <input type="text" id="witness1_occupation_other_for_heirship" name="witness1_occupation_other_for_heirship" style="display: none;"
                                                       maxlength="100" class="form-control" value="{{witness1_occupation_other}}" placeholder="Enter Witness 1 Other Occupation !" onkeyup="checkValidation('heirship', 'witness1_occupation_other_for_heirship');" onblur="checkValidation('heirship', 'witness1_occupation_other_for_heirship', otherOccupationValidationMessage);">
                                                <span class="error-message error-message-heirship-witness1_occupation_other_for_heirship"></span>
                                            </td>
                                        </tr>
                                        <tr class="p-1">
                                            <td><b>2</b></td>
                                            <!-- <td>Witness 2</td> -->
                                            <td>
                                                <input type="text" id="witness2_name_for_heirship" name="witness2_name_for_heirship"
                                                       maxlength="200" class="form-control" value="{{witness2_name}}" placeholder="Enter Witness 2 Name !" onblur="checkValidation('heirship', 'witness2_name_for_heirship');">
                                                <span class="error-message error-message-heirship-witness2_name_for_heirship"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="witness2_age_for_heirship" name="witness2_age_for_heirship"
                                                       maxlength="2" class="form-control" value="{{witness2_age}}" placeholder="Enter Witness 2 Age !" onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this)); checkValidation('heirship', 'witness2_age_for_heirship');">
                                                <span class="error-message error-message-heirship-witness2_age_for_heirship"></span>
                                            </td>
                                            <td>
                                                <textarea type="text" id="witness2_address_for_heirship" name="witness2_address_for_heirship"
                                                          maxlength="300" class="form-control" placeholder="Enter Witness 2 Address !" onblur="checkValidation('heirship', 'witness2_address_for_heirship');">{{witness2_address}}</textarea>
                                                <span class="error-message error-message-heirship-witness2_address_for_heirship"></span>
                                            </td>
                                            <td>
                                                <select id="witness2_occupation_for_heirship" name="witness2_occupation_for_heirship" class="form-control select2" style="width: 100%;" data-placeholder="Select Occupation" onchange="showOtherapplicantOccupationtext(this, 'witness2_occupation_other', 'heirship');" onblur="showOtherapplicantOccupationtext(this, 'witness2_occupation_other', 'heirship'); checkValidation('heirship', 'witness2_occupation_for_heirship', applicantOccupationValidationMessage);">
                                                </select>
                                                <span class="error-message error-message-heirship-witness2_occupation_for_heirship"></span><hr>
                                                <input type="text" id="witness2_occupation_other_for_heirship" name="witness2_occupation_other_for_heirship" style="display: none;"
                                                       maxlength="100" class="form-control" value="{{witness2_occupation_other}}" placeholder="Enter Witness 2 Other Occupation !" onblur="checkValidation('heirship', 'witness2_occupation_other_for_heirship', otherOccupationValidationMessage);">
                                                <span class="error-message error-message-heirship-witness2_occupation_other_for_heirship"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>14. Purpose for Certificate. <span class="color-nic-red"></span></label>
                            <textarea id="final_remarks_for_heirship" name="final_remarks_for_heirship"
                                      class="form-control" placeholder="Enter Purpose for Certificate !" 
                                      maxlength="200">{{final_remarks}}</textarea>
                        </div>
                        <span class="error-message error-message-heirship-final_remarks_for_heirship"></span>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="death_certificate_doc_container_for_heirship">
                            <label>15. Death Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-death_certificate_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="death_certificate_doc_name_container_for_heirship" style="display: none;">
                            <label>15. Death Certificate <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="death_certificate_doc_download"><label id="death_certificate_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="death_aadhar_card_doc_container_for_heirship">
                            <label>16. Death Person Aadhar Card <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-death_aadhar_card_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="death_aadhar_card_doc_name_container_for_heirship" style="display: none;">
                            <label>16. Death Person Aadhar Card <span style="color: red;"> </span></label><br>
                            <a target="_blank" id="death_aadhar_card_doc_download"><label id="death_aadhar_card_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="marriage_certificate_doc_container_for_heirship">
                            <label>17. Marriage Certificate <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-marriage_certificate_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="marriage_certificate_doc_name_container_for_heirship" style="display: none;">
                            <label>17. Marriage Certificate <span style="color: red;"> </span></label><br>
                            <a target="_blank" id="marriage_certificate_doc_download"><label id="marriage_certificate_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="aadhar_card_doc_container_for_heirship">
                            <label>18. All Member Aadhar Card (Upload in One PDF File) <span style="color: red;">* (Maximum File Size: 10MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-aadhar_card_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="aadhar_card_doc_name_container_for_heirship" style="display: none;">
                            <label>18. All Member Aadhar Card <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="aadhar_card_doc_download"><label id="aadhar_card_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="panchayat_certificate_doc_container_for_heirship">
                            <label>19. Panchayat Legal Heir Certificate <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-panchayat_certificate_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="panchayat_certificate_doc_name_container_for_heirship" style="display: none;">
                            <label>19. Panchayat Legal Heir Certificate <span style="color: red;"> </span></label><br>
                            <a target="_blank" id="panchayat_certificate_doc_download"><label id="panchayat_certificate_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="community_certificate_doc_container_for_heirship">
                            <label>20. Community Certificate <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-community_certificate_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="community_certificate_doc_name_container_for_heirship" style="display: none;">
                            <label>20. Community Certificate <span style="color: red;"> </span></label><br>
                            <a target="_blank" id="community_certificate_doc_download"><label id="community_certificate_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="applicant_photo_doc_container_for_heirship">
                            <label>21. Upload Applicant Photo. <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-applicant_photo_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="applicant_photo_doc_name_container_for_heirship" style="display: none;">
                            <label>21. Upload Applicant Photo. <span style="color: red;">*</span></label><br>
                            <a target="_blank" id="applicant_photo_doc_download">
                                <img id="applicant_photo_doc_name_image_for_heirship"
                                     style="width: 250px; height: 250px; border: 2px solid blue;"
                                     class="spinner_name_container_for_heirship_{{VALUE_SEVEN}}">
                            </a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="witness1_photo_doc_container_for_heirship">
                            <label>22. Upload Witness 1 Photo. <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-witness1_photo_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="witness1_photo_doc_name_container_for_heirship" style="display: none;">
                            <label>22. Upload Witness 1 Photo. <span style="color: red;">*</span></label><br>
                            <a target="_blank" id="witness1_photo_doc_download">
                                <img id="witness1_photo_doc_name_image_for_heirship"
                                     style="width: 250px; height: 250px; border: 2px solid blue;"
                                     class="spinner_name_container_for_heirship_{{VALUE_EIGHT}}">
                            </a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="witness2_photo_doc_container_for_heirship">
                            <label>23. Upload Witness 2 Photo. <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-witness2_photo_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="witness2_photo_doc_name_container_for_heirship" style="display: none;">
                            <label>23. Upload Witness 2 Photo. <span style="color: red;">*</span></label><br>
                            <a target="_blank" id="witness2_photo_doc_download">
                                <img id="witness2_photo_doc_name_image_for_heirship"
                                     style="width: 250px; height: 250px; border: 2px solid blue;"
                                     class="spinner_name_container_for_heirship_{{VALUE_NINE}}">
                            </a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="witness1_aadhar_doc_container_for_heirship">
                            <label>24. Witness 1 Aadhar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-witness1_aadhar_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="witness1_aadhar_doc_name_container_for_heirship" style="display: none;">
                            <label>24. Witness 1 Aadhar Card <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="witness1_aadhar_doc_download"><label id="witness1_aadhar_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="witness2_aadhar_doc_container_for_heirship">
                            <label>25. Witness 2 Aadhar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-witness2_aadhar_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="witness2_aadhar_doc_name_container_for_heirship" style="display: none;">
                            <label>25. Witness 2 Aadhar Card <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="witness2_aadhar_doc_download"><label id="witness2_aadhar_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                     <div class="row mb-2">
                        <div class="col-12" id="applicant_witness_photo_notary_affidavit_doc_container_for_heirship">
                            <label>26. Applicant and Two Witness Photo Notary Affidavit <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-applicant_witness_photo_notary_affidavit_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="applicant_witness_photo_notary_affidavit_doc_name_container_for_heirship" style="display: none;">
                            <label>26. Applicant and Two Witness Photo Notary Affidavit <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="applicant_witness_photo_notary_affidavit_doc_download"><label id="applicant_witness_photo_notary_affidavit_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                     <div class="row mb-2">
                        <div class="col-12" id="property_documents_doc_container_for_heirship">
                            <label>27. Property Documents (if any) or if rented NOC and Agreement Copy <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-heirship-property_documents_doc_for_heirship"></div>
                        </div>
                        <div class="col-sm-12" id="property_documents_doc_name_container_for_heirship" style="display: none;">
                            <label>27. Property Documents (if any) or if rented NOC and Agreement Copy <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="property_documents_doc_download"><label id="property_documents_doc_name_image_for_heirship" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_heirship_{{VALUE_THIRTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <button type="button" id="submit_btn_for_heirship" class="btn btn-sm btn-success" onclick="Heirship.listview.askForSubmitHeirship({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="Heirship.listview.loadHeirshipData();">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>