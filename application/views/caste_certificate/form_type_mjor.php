<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Caste Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application for issue of Caste Certificate</div>
            </div>
            <form role="form" id="caste_certificate_form" name="caste_certificate_form" onsubmit="return false;">

                <input type="hidden" id="caste_certificate_id" name="caste_certificate_id" value="{{caste_certificate_data.caste_certificate_id}}">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-caste-certificate f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>

                    <input type="hidden" id="constitution_artical" name="constitution_artical" value="1"> 
                    To,<br>
                    The Mamlatdar,

                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Basic Details</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>1. District<span class="color-nic-red">*</span></label>
                                    <select id="district" name="district" class="form-control select2"
                                            onchange="checkValidation('caste-certificate', 'district', selectDistrictValidationMessage); CasteCertificate.listview.districtChangeEvent($(this));"
                                            data-placeholder="Select District" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-district"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>1.1 Name of Village Panchayat/D.M.C <span class="color-nic-red">*</span></label>
                                    <select id="village_name_for_cc" name="village_name" class="form-control select2"
                                            onchange="checkValidation('caste-certificate', 'village_name_for_cc', oneOptionValidationMessage); CasteCertificate.listview.villageDMCChangeEvent($(this));"
                                            data-placeholder="Select Name of Village Panchayat/D.M.C" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-village_name_for_cc"></span>
                                </div>
                            </div>

                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="applicant_name_for_cc_div">2. Full Name of Applicant <span class="color-nic-red">*</span></label>

                                    <div class="input-group">
                                        <input type="text" id="applicant_name_for_cc" name="applicant_name" class="form-control" placeholder="Enter Full Name of Applicant !"
                                               maxlength="100" onblur="checkValidation('caste-certificate', 'applicant_name_for_cc', applicantNameValidationMessage);" value="{{caste_certificate_data.applicant_name}}">
                                    </div>
                                    <span class="error-message error-message-caste-certificate-applicant_name_for_cc"></span>
                                </div>
                            </div>
                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-body pt-1" style="background-color: aliceblue;">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>3. Applicant’s Communication Address</label><hr>
                                            </div>
                                        </div><br>
                                        <br>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>3.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_house_no_for_cc" name="com_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{caste_certificate_data.com_addr_house_no}}" onblur="checkValidation('caste-certificate', 'com_addr_house_no_for_cc', houseNoValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-com_addr_house_no_for_cc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.2 Building Name / House Name</label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_house_name_for_cc" name="com_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{caste_certificate_data.com_addr_house_name}}">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-com_addr_house_name_for_cc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>3.3 Street <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_street_for_cc" name="com_addr_street" class="form-control" placeholder="Enter Street !"
                                                           maxlength="100" onblur="checkValidation('caste-certificate', 'com_addr_street_for_cc', streetValidationMessage);" value="{{caste_certificate_data.com_addr_street}}">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-com_addr_street_for_cc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_village_dmc_ward_for_cc" name="com_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                           maxlength="100" onblur="checkValidation('caste-certificate', 'com_addr_village_dmc_ward_for_cc', villageNameValidationMessage);" value="{{caste_certificate_data.com_addr_village_dmc_ward}}" readonly="">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-com_addr_village_dmc_ward_for_cc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>3.5 Select City<span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <!-- <select class="form-control select2" id="com_addr_city_for_cc" name="com_addr_city"
                                                            data-placeholder="City !"  onblur="checkValidation('caste-certificate', 'com_addr_city_for_cc', selectCityValidationMessage);" onchange="CasteCertificate.listview.getPincode($(this));" disabled="">
                                                        <option value="">Select City</option>
                                                    </select> -->
                                                    <input type="text" id="com_addr_city_for_cc" name="com_addr_city" class="form-control" placeholder="Enter City !"
                                                           maxlength="100" onblur="checkValidation('caste-certificate', 'com_addr_city_for_cc', selectCityValidationMessage);" onchange="CasteCertificate.listview.getPincode($(this));" value="{{caste_certificate_data.com_addr_city}}" readonly="">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-com_addr_city_for_cc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.6 Pincode <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_pincode_for_cc" name="com_pincode" class="form-control" placeholder="Enter Pincode !"
                                                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('caste-certificate', 'com_pincode_for_cc', pincodeValidationMessage);" value="{{caste_certificate_data.com_pincode}}">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-com_pincode_for_cc"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body pt-1" style="background-color: aliceblue;">

                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label>Same as Communication Address</label>&nbsp;
                                                <input type="checkbox" id="billingtoo_for_cc" name="billingtoo" class="checkbox" value="{{is_checked}}"  onchange="CasteCertificate.listview.FillBilling($(this));">
                                                <span class="error-message error-message-obc-certificate-billingtoo"></span><br>
                                                <label>4. Applicant’s Permanent Address</label><hr> 
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="form-group col-sm-6">
                                                <label>4.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_house_no_for_cc" name="per_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{caste_certificate_data.per_addr_house_no}}" onblur="checkValidation('caste-certificate', 'per_addr_house_no_for_cc', houseNoValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-per_addr_house_no_for_cc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.2 Building Name / House Name</label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_house_name_for_cc" name="per_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{caste_certificate_data.per_addr_house_name}}">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-per_addr_house_name_for_cc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.3 Street <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_street_for_cc" name="per_addr_street" class="form-control" placeholder="Enter Street !"
                                                           maxlength="100" onblur="checkValidation('caste-certificate', 'per_addr_street_for_cc', streetValidationMessage);" value="{{caste_certificate_data.per_addr_street}}">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-per_addr_street_for_cc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_village_dmc_ward_for_cc" name="per_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                           maxlength="100" onblur="checkValidation('caste-certificate', 'per_addr_village_dmc_ward_for_cc', villageNameValidationMessage);" value="{{caste_certificate_data.per_addr_village_dmc_ward}}" >
                                                </div>
                                                <span class="error-message error-message-caste-certificate-per_addr_village_dmc_ward_for_cc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.5 Select City<span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_city_for_cc" name="per_addr_city" class="form-control" placeholder="Enter City !"
                                                           maxlength="100" onblur="checkValidation('caste-certificate', 'per_addr_city_for_cc', selectCityValidationMessage);" onchange="CasteCertificate.listview.getPincode($(this));" value="{{caste_certificate_data.per_addr_city}}" >
                                                </div>
                                                <span class="error-message error-message-caste-certificate-per_addr_city_for_cc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.6 Pincode <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_pincode_for_cc" name="per_pincode" class="form-control" placeholder="Enter Pincode !"
                                                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('caste-certificate', 'per_pincode_for_cc', pincodeValidationMessage);" value="{{caste_certificate_data.per_pincode}}">
                                                </div>
                                                <span class="error-message error-message-caste-certificate-per_pincode_for_cc"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>5. Applicant's Mobile Number<span class="color-nic-red">*</span></label>
                                    <input type="text" id="mobile_number_for_cc" name="mobile_number" class="form-control" placeholder="Enter Mobile Number !"
                                           maxlength="10" onkeyup="checkNumeric($(this));"
                                           onblur="checkValidationForMobileNumber('caste-certificate', 'mobile_number_for_cc');" value="{{caste_certificate_data.mobile_number}}">
                                    <span class="error-message error-message-caste-certificate-mobile_number_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>6. Applicant's Email Address </label>
                                    <input type="text" id="email_for_cc" name="email"
                                           class="form-control" placeholder="Enter Email !"  maxlength="100"
                                           onblur="checkValidationForEmail('caste-certificate', 'email_for_cc');" value="{{caste_certificate_data.email}}">
                                    <span class="error-message error-message-caste-certificate-email_for_cc"></span>
                                </div>
                            </div>
                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>7. Applicant's Aadhar Number</label>
                                    <div class="input-group">
                                        <input type="text" id="aadhaar_for_cc" name="aadhaar"
                                               class="form-control" placeholder="Enter Aadhar Number !"
                                               onblur="aadharNumberValidation('caste-certificate', 'aadhaar_for_cc');"
                                               maxlength="12" value="{{caste_certificate_data.aadhaar}}">
                                    </div>
                                    <span class="error-message error-message-caste-certificate-aadhaar_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>8. Applicant's Election Number</label>
                                    <div class="input-group">
                                        <input type="text" id="election_no_for_cc" name="election_no"
                                               class="form-control" placeholder="Enter Election Number !"
                                               maxlength="12" value="{{caste_certificate_data.election_no}}">
                                    </div>
                                    <span class="error-message error-message-caste-certificate-aadhaar_for_cc"></span>
                                </div>
                            </div>
                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>9.  Date of Birth<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applicant_dob" id="applicant_dob_for_cc" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value=""
                                               onblur="checkValidation('caste-certificate', 'applicant_dob_for_cc', birthDateValidationMessage); calculateAge('for_cc');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-caste-certificate-applicant_dob_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>9.1  Applicant Age<span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_age_for_cc" 
                                           name="applicant_age" class="form-control"
                                           placeholder="Enter Applicant Age !" maxlength="100" 
                                           onblur="checkValidation('caste-certificate', 'applicant_age_for_cc', applicantAgeValidationMessage);"
                                           value="{{caste_certificate_data.applicant_age}}" readonly="">
                                    <span class="error-message error-message-caste-certificate-applicant_age_for_cc"></span>
                                </div>
                            </div>

                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>10. Applicant Birth Place<span class="color-nic-red">*</span></label><br/>
                                    <label>10.1 State <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="born_place_state_for_cc" name="born_place_state" class="form-control select2"
                                                data-placeholder="Select State/UT"
                                                onchange="checkValidation('cc', 'born_place_state_for_cc', selectStateValidationMessage);
                                                        CasteCertificate.listview.getDistrictData($(this), 'cc', 'born_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-caste-certificate-born_place_state_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>10.2 District <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="born_place_district_for_cc" name="born_place_district" class="form-control select2"
                                                data-placeholder="Select District"
                                                onchange="checkValidation('cc', 'born_place_district_for_cc', selectDistrictValidationMessage);
                                                        CasteCertificate.listview.getVillageData($(this), 'cc', 'born_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-caste-certificate-born_place_district_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>10.3 Village <span class="color-nic-red">*</span></label>
                                    <select id="born_place_village_for_cc" name="born_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('cc', 'born_place_village_for_cc', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-born_place_village_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>10.4 Pincode <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="born_place_pincode_for_cc" name="born_place_pincode" class="form-control" placeholder="Enter Pincode !"
                                               maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('caste-certificate', 'born_place_pincode_for_cc', pincodeValidationMessage);" value="{{caste_certificate_data.born_place_pincode}}">
                                    </div>
                                    <span class="error-message error-message-caste-certificate-born_place_pincode_for_cc"></span>
                                </div>
                            </div>
                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>11 Original Native of<span class="color-nic-red">*</span></label><br/>

                                    <label>11.1 State <span class="color-nic-red">*</span></label>
                                    <div class="">
                                        <select class="form-control select2" id="native_place_state_for_cc" name="native_place_state"
                                                data-placeholder="State !"  onblur="checkValidation('caste-certificate', 'native_place_state_for_cc', selectCityValidationMessage);" >
                                            <option value="">Select State</option>
                                            <option value="1">Dadra And Nagar Haveli And Daman And Diu</option>
                                        </select>
                                    </div>

                                    <span class="error-message error-message-caste-certificate-native_place_state_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>11.2 District <span class="color-nic-red">*</span></label>
                                    <select id="native_place_district_for_cc" name="native_place_district" class="form-control select2"
                                            onchange="checkValidation('caste-certificate', 'native_place_district_for_cc', selectDistrictValidationMessage); CasteCertificate.listview.nativeDistrictChangeEvent($(this));"
                                            data-placeholder="Select District" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-native_place_district_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>11.3 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                    <select id="native_place_village_for_cc" name="native_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('cc', 'native_place_village_for_cc', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-native_place_village_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>11.4 Pincode <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="native_place_pincode_for_cc" name="native_place_pincode" class="form-control" placeholder="Enter Pincode !"
                                               maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('caste-certificate', 'native_place_pincode_for_cc', pincodeValidationMessage);" value="{{caste_certificate_data.native_place_pincode}}">
                                    </div>
                                    <span class="error-message error-message-caste-certificate-native_place_pincode_for_cc"></span>
                                </div>
                            </div> 
                            <!------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>12. Gender<span class="color-nic-red">*</span></label>
                                    <div id="gender_container_for_cc"></div>
                                    <span class="error-message error-message-caste-certificate-gender_for_cc"></span>
                                </div>
                            </div>
                            <div class="row marital_status_div_for_cc">
                                <div class="form-group col-sm-6">
                                    <label>13. Marital Status<span class="color-nic-red">*</span></label>
                                    <div id="marital_status_container_for_cc"></div>
                                    <span class="error-message error-message-caste-certificate-marital_status_for_cc"></span>
                                </div>
                            </div>
                            <!------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>14. Applicant Religion <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_religion_for_cc" name="applicant_religion_for_cc" class="form-control" placeholder="Enter Religion !" maxlength="100" value="{{caste_certificate_data.applicant_religion}}">
                                    <span class="error-message error-message-caste-certificate-applicant_religion_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>15. Applicant Caste<span class="color-nic-red">*</span></label>
                                    <div id="applicant_caste_container_for_caste_certificate"></div>
                                    <span class="error-message error-message-caste-certificate-applicant_caste_for_caste_certificate"></span>
                                </div>


                                <div class="form-group col-sm-3 applicant_caste_sc_item_container_for_caste_certificate" style="display: none;">
                                    <label>15.1 Caste. <span class="color-nic-red">*</span></label>
                                    <select id="apllicant_sc_subcaste_for_cc" name="apllicant_sc_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-apllicant_sc_subcaste_for_cc"></span>
                                </div>

                                <div class="form-group col-sm-3 applicant_caste_st_item_container_for_caste_certificate" style="display: none;">
                                    <label>15.2 Caste. <span class="color-nic-red">*</span></label>
                                    <select id="apllicant_st_subcaste_for_cc" name="apllicant_st_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-apllicant_st_subcaste_for_cc"></span>
                                </div>

                            </div>
                            <!------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>16.  Applicant Nationality <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_nationality_for_cc" name="applicant_nationality" class="form-control" placeholder="Enter Applicant Nationality!"
                                           maxlength="100" onblur="checkValidation('caste-certificate', 'applicant_nationality_for_cc', applicantNationalityValidationMessage);" value="{{caste_certificate_data.applicant_nationality}}">
                                    <span class="error-message error-message-caste-certificate-applicant_nationality_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>17. Nearest Police Station. <span class="color-nic-red">*</span></label>
                                    <select id="nearest_police_station_for_cc" name="nearest_police_station" class="form-control select2" data-placeholder="Select Police Station Area" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-nearest_police_station_for_cc"></span>
                                </div>

                            </div>  
                            <!--------------------------------------------------------->
                            <!-- <div class="row">
                               
                               <div class="form-group col-sm-6">
                                   <label>11. Applicant Education <span class="color-nic-red">*</span></label>
                                   <input type="text" id="applicant_education_for_cc" name="applicant_education" class="form-control" placeholder="Enter Applicant Education!"
                                          maxlength="100" onblur="checkValidation('caste-certificate', 'applicant_education_for_cc', applicantNationalityValidationMessage);" value="{{caste_certificate_data.applicant_education}}">
                                   <span class="error-message error-message-caste-certificate-applicant_education_for_cc"></span>
                               </div>
                           </div> -->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>18. Applicant Education. <span class="color-nic-red">*</span></label>
                                    <select id="applicant_education_for_cc" name="applicant_education" class="form-control select2" onchange="checkValidation('caste-certificate', 'applicant_education_for_cc', applicantEducationValidationMessage);" data-placeholder="Select Education" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-applicant_education_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>18.1 Name of School / Collage / Institute <span class="color-nic-red">*</span></label>
                                    <input type="text" id="name_of_school_for_cc" name="name_of_school"
                                           maxlength="100" class="form-control" value="{{caste_certificate_data.name_of_school}}" placeholder="Enter Name of School / Collage / Institute !" onblur="checkValidation('caste-certificate', 'name_of_school_for_cc', schoolNameValidationMessage);"
                                           >
                                    <span class="error-message error-message-caste-certificate-name_of_school_for_cc"></span>
                                </div>
                            </div>
                            <!------------------------------------------------->
                            <div class="row occupation_div_for_cc">
                                <div class="form-group col-sm-6">
                                    <label>19. Applicant Occupation. <span class="color-nic-red">*</span></label>
                                    <select id="occupation_for_cc" name="occupation" class="form-control select2" onchange="checkValidation('caste-certificate', 'occupation_for_cc', applicantOccupationValidationMessage);
                                            if (this.value == 12) {
                                                $('.other_occupation_div_for_cc').show();
                                            } else {
                                                $('.other_occupation_div_for_cc').hide();
                                            }" data-placeholder="Select Occupation" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-caste-certificate-occupation_for_cc"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <div class="other_occupation_div_for_cc" style="display: none;">
                                        <label>19.1 Other Occupation Detail</label>
                                        <input type="text" id="other_occupation_for_cc" name="other_occupation"
                                               maxlength="100" class="form-control" value="{{caste_certificate_data.other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('caste-certificate', 'other_occupation_text_for_cc', otherOccupationValidationMessage);"
                                               >
                                        <span class="error-message error-message-caste-certificate-other_occupation_text_for_cc"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1">
                                    <h3 class="card-title">20. Father Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--.card-header-->
                                <div class="card-body border-nic-blue pt-1 father_info_div" style="display: none;" >
                                    <div class="">
                                        <div class="p-1 flex-fill" style="overflow: hidden">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label>Did Your Father is Alive ? <span class="color-nic-red">*</span></label>
                                                            <div id="father_alive_container_for_caste_certificate"></div>
                                                            <span class="error-message error-message-caste-certificate-father_alive_for_caste_certificate"></span>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>20.1 Name of Father <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="father_name_for_cc" name="father_name"
                                                                   maxlength="100" class="form-control" value="{{father_data.father_name}}" placeholder="Enter Father Name !" onblur="checkValidation('caste-certificate', 'father_name_for_cc', fatherNameValidationMessage);"
                                                                   >
                                                            <span class="error-message error-message-caste-certificate-father_name_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>20.2 Father's Nationality <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="father_nationality_for_cc" name="father_nationality" class="form-control" placeholder="Enter Father's Nationality!"
                                                                   maxlength="100" onblur="checkValidation('caste-certificate', 'father_nationality_for_cc', nationalityValidationMessage);" value="{{father_data.father_nationality}}">
                                                            <span class="error-message error-message-caste-certificate-father_nationality_for_cc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>20.3 Father Birth Place<span class="color-nic-red">*</span></label><br/>
                                                            <label>20.3.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_born_place_state_for_cc" name="father_born_place_state" class="form-control select2"
                                                                        data-placeholder="Select State/UT"
                                                                        onchange="checkValidation('cc', 'father_born_place_state_for_cc', selectStateValidationMessage);
                                                                                CasteCertificate.listview.getDistrictData($(this), 'cc', 'father_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-father_born_place_state_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>20.3.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_born_place_district_for_cc" name="father_born_place_district" class="form-control select2"
                                                                        data-placeholder="Select District"
                                                                        onchange="checkValidation('cc', 'father_born_place_district_for_cc', selectDistrictValidationMessage);
                                                                                CasteCertificate.listview.getVillageData($(this), 'cc', 'father_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-father_born_place_district_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>20.3.3 Village <span class="color-nic-red">*</span></label>
                                                            <select id="father_born_place_village_for_cc" name="father_born_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('cc', 'father_born_place_village_for_cc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-father_born_place_village_for_cc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>20.4 Original Native of<span class="color-nic-red">*</span></label><br/>
                                                            <label>20.4.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_native_place_district_for_cc" name="father_native_place_district" class="form-control select2"
                                                                        onchange="checkValidation('caste-certificate', 'father_native_place_district_for_cc', selectDistrictValidationMessage); CasteCertificate.listview.nativeCityChangeEvent($(this));"
                                                                        data-placeholder="Select District" style="width: 100%;">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-father_native_place_district_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>20.2.4 Select City<span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_city_for_cc" name="father_city" class="form-control select2"
                                                                        data-placeholder="City !"  onblur="checkValidation('caste-certificate', 'father_city_for_cc', selectCityValidationMessage);" 
                                                                        onchange="CasteCertificate.listview.nativeFamilyVillageChangeEvent($(this), 'father_native_place_village_for_cc');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-father_city_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>20.4.3 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                            <select id="father_native_place_village_for_cc" name="father_native_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('cc', 'father_native_place_village_for_cc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-father_native_place_village_for_cc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>20.5 Father Religion <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="father_religion_for_cc" name="father_religion_for_cc" class="form-control" 
                                                                   onblur="checkValidation('caste-certificate', 'father_religion_for_cc', religionValidationMessage);"
                                                                   placeholder="Enter Religion !" maxlength="100" value="{{father_data.father_religion}}">
                                                            <span class="error-message error-message-caste-certificate-father_religion_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>20.6 Father Caste<span class="color-nic-red">*</span></label>
                                                            <div id="father_caste_container_for_caste_certificate"></div>
                                                            <span class="error-message error-message-caste-certificate-father_caste_for_caste_certificate"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 father_caste_sc_item_container_for_caste_certificate" style="display: none;">
                                                            <label>20.6.1 Caste. <span class="color-nic-red">*</span></label>
                                                            <select id="father_sc_subcaste_for_cc" name="father_sc_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-father_sc_subcaste_for_cc"></span>
                                                        </div>

                                                        <div class="form-group col-sm-4 father_caste_st_item_container_for_caste_certificate" style="display: none;">
                                                            <label>20.6.1 Caste. <span class="color-nic-red">*</span></label>
                                                            <select id="father_st_subcaste_for_cc" name="father_st_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-father_st_subcaste_for_cc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4 if_father_alive_item_container_for_caste_certificate">
                                                            <label>20.7 Father's Aadhar Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="father_aadhaar_for_cc" name="father_aadhaar" class="form-control" placeholder="Enter Aadhar Number"
                                                                       maxlength="15" onkeyup="checkNumeric($(this));" value="{{father_data.father_aadhaar}}">
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-father_aadhaar_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4 if_father_alive_item_container_for_caste_certificate">
                                                            <label>20.8 Father's Election Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="father_election_no_for_cc" name="father_election_no" class="form-control" placeholder="Enter Election Number"
                                                                       maxlength="15"  value="{{father_data.father_election_no}}">
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-father_election_no_for_cc"></span>
                                                        </div>

                                                        <div class="form-group col-sm-4 col-md-4 if_father_alive_item_container_for_caste_certificate">
                                                            <label>20.9 Father's Occupation. <span class="color-nic-red">*</span></label>
                                                            <select id="father_occupation_for_cc" name="father_occupation" class="form-control select2" onchange="checkValidation('caste-certificate', 'father_occupation_for_cc', applicantOccupationValidationMessage);
                                                                    if (this.value == 12) {
                                                                        $('.father_other_occupation_div_for_cc').show();
                                                                    } else {
                                                                        $('.father_other_occupation_div_for_cc').hide();
                                                                    }" data-placeholder="Select Occupation" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-father_occupation_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <div class="father_other_occupation_div_for_cc" style="display: none;">
                                                                <label>20.9.1 Other Occupation Detail</label>
                                                                <input type="text" id="father_other_occupation_for_cc" name="father_other_occupation"
                                                                       maxlength="100" class="form-control" value="{{father_data.father_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('caste-certificate', 'father_other_occupation_for_cc', otherOccupationValidationMessage);"
                                                                       >
                                                                <span class="error-message error-message-caste-certificate-father_other_occupation_for_cc"></span>
                                                            </div>
                                                        </div> 

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div> <!--.d-md-flex-->
                                </div>
                                <!--.card-body-->
                            </div>
                        </div>
                    </div>
                    <!----------------------------------------->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1">
                                    <h3 class="card-title">21. Mother Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body border-nic-blue pt-1 mother_info_div" style="display: none;">
                                    <div class="">
                                        <div class="p-1 flex-fill" style="overflow: hidden">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label>Did Your Mother is Alive ? <span class="color-nic-red">*</span></label>
                                                            <div id="mother_alive_container_for_caste_certificate"></div>
                                                            <span class="error-message error-message-caste-certificate-mother_alive_for_caste_certificate"></span>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>21.1 Name of Mother <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="mother_name_for_cc" name="mother_name"
                                                                   maxlength="100" class="form-control" value="{{mother_data.mother_name}}" placeholder="Enter Mother Name !" onblur="checkValidation('caste-certificate', 'mother_name_for_cc', motherNameValidationMessage);"
                                                                   >
                                                            <span class="error-message error-message-caste-certificate-mother_name_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>21.2 Mother's Nationality <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="mother_nationality_for_cc" name="mother_nationality" class="form-control" placeholder="Enter Mother's Nationality!"
                                                                   maxlength="100" onblur="checkValidation('caste-certificate', 'mother_nationality_for_cc', nationalityValidationMessages);" value="{{mother_data.mother_nationality}}">
                                                            <span class="error-message error-message-caste-certificate-mother_nationality_for_cc"></span>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>21.3 Mother Birth Place<span class="color-nic-red">*</span></label><br/>
                                                            <label>21.3.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="mother_born_place_state_for_cc" name="mother_born_place_state" class="form-control select2"
                                                                        data-placeholder="Select State/UT"
                                                                        onchange="checkValidation('cc', 'mother_born_place_state_for_cc', selectStateValidationMessage);
                                                                                CasteCertificate.listview.getDistrictData($(this), 'cc', 'mother_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-mother_born_place_state_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>21.3.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="mother_born_place_district_for_cc" name="mother_born_place_district" class="form-control select2"
                                                                        data-placeholder="Select District"
                                                                        onchange="checkValidation('cc', 'mother_born_place_district_for_cc', selectDistrictValidationMessage);
                                                                                CasteCertificate.listview.getVillageData($(this), 'cc', 'mother_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-mother_born_place_district_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>21.3.3 Village <span class="color-nic-red">*</span></label>
                                                            <select id="mother_born_place_village_for_cc" name="mother_born_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('cc', 'mother_born_place_village_for_cc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-mother_born_place_village_for_cc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>21.4 Original Native of<span class="color-nic-red">*</span></label><br/>
                                                            <label>21.4.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="mother_native_place_state_for_cc" name="mother_native_place_state" class="form-control select2"
                                                                        data-placeholder="Select State/UT"
                                                                        onchange="checkValidation('cc', 'mother_native_place_state_for_cc', selectStateValidationMessage);
                                                                                CasteCertificate.listview.getDistrictData($(this), 'cc', 'mother_native_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-mother_native_place_state_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>21.4.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="mother_native_place_district_for_cc" name="mother_native_place_district" class="form-control select2"
                                                                        data-placeholder="Select District"
                                                                        onchange="checkValidation('cc', 'mother_native_place_district_for_cc', selectDistrictValidationMessage);
                                                                                CasteCertificate.listview.getVillageData($(this), 'cc', 'mother_native_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-mother_native_place_district_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>21.4.3 Village <span class="color-nic-red">*</span></label>
                                                            <select id="mother_native_place_village_for_cc" name="mother_native_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('cc', 'mother_native_place_village_for_cc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-mother_native_place_village_for_cc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>21.5 Mother Religion <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="mother_religion_for_cc" name="mother_religion_for_cc" class="form-control" 
                                                                   onblur="checkValidation('caste-certificate', 'mother_religion_for_cc', religionValidationMessage);"
                                                                   placeholder="Enter Religion !" maxlength="100" value="{{mother_data.mother_religion}}">
                                                            <span class="error-message error-message-caste-certificate-mother_religion_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>21.6 Mother Caste<span class="color-nic-red">*</span></label>
                                                            <div id="mother_caste_container_for_caste_certificate"></div>
                                                            <span class="error-message error-message-caste-certificate-mother_caste_for_caste_certificate"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 mother_caste_sc_item_container_for_caste_certificate" style="display: none;">
                                                            <label>21.6.1 Caste. <span class="color-nic-red">*</span></label>
                                                            <select id="mother_sc_subcaste_for_cc" name="mother_sc_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-mother_sc_subcaste_for_cc"></span>
                                                        </div>

                                                        <div class="form-group col-sm-4 mother_caste_st_item_container_for_caste_certificate" style="display: none;">
                                                            <label>21.6.1 Caste. <span class="color-nic-red">*</span></label>
                                                            <select id="mother_st_subcaste_for_cc" name="mother_st_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-mother_st_subcaste_for_cc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4 if_mother_alive_item_container_for_caste_certificate">
                                                            <label>21.7 Mother's Aadhar Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="mother_aadhaar_for_cc" name="mother_aadhaar" class="form-control" placeholder="Enter Aadhar Number"
                                                                       maxlength="15" onkeyup="checkNumeric($(this));"  value="{{mother_data.mother_aadhaar}}">
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-mother_aadhaar_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4 if_mother_alive_item_container_for_caste_certificate">
                                                            <label>21.8 Mother's Election Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="mother_election_no_for_cc" name="mother_election_no" class="form-control" placeholder="Enter Election Number"
                                                                       maxlength="15" value="{{mother_data.mother_election_no}}">
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-mother_election_no_for_cc"></span>
                                                        </div>

                                                        <div class="form-group col-sm-4 col-md-4 if_mother_alive_item_container_for_caste_certificate">
                                                            <label>21.9 Mother's Occupation. <span class="color-nic-red">*</span></label>
                                                            <select id="mother_occupation_for_cc" name="mother_occupation" class="form-control select2" onchange="checkValidation('caste-certificate', 'mother_occupation_for_cc', applicantOccupationValidationMessage);
                                                                    if (this.value == 12) {
                                                                        $('.mother_other_occupation_div_for_cc').show();
                                                                    } else {
                                                                        $('.mother_other_occupation_div_for_cc').hide();
                                                                    }" data-placeholder="Select Occupation" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-mother_occupation_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <div class="mother_other_occupation_div_for_cc" style="display: none;">
                                                                <label>21.9.1 Other Occupation Detail</label>
                                                                <input type="text" id="mother_other_occupation_for_cc" name="mother_other_occupation"
                                                                       maxlength="100" class="form-control" value="{{mother_data.mother_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('caste-certificate', 'mother_other_occupation_for_cc', otherOccupationValidationMessage);"
                                                                       >
                                                                <span class="error-message error-message-caste-certificate-mother_other_occupation_for_cc"></span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div><!-- /.d-md-flex -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <!----------------------------------------------------------->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1">
                                    <h3 class="card-title">22. Grandfather Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body border-nic-blue pt-1 grandfather_info_div" style="display: none;" >
                                    <div class="">
                                        <div class="p-1 flex-fill" style="overflow: hidden">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label>Did Your Grandfather is Alive ? <span class="color-nic-red">*</span></label>
                                                            <div id="grandfather_alive_container_for_caste_certificate"></div>
                                                            <span class="error-message error-message-caste-certificate-grandfather_alive_for_caste_certificate"></span>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>22.1 Name of Grandfather <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="grandfather_name_for_cc" name="grandfather_name"
                                                                   maxlength="100" class="form-control" value="{{grandfather_data.grandfather_name}}" placeholder="Enter Grandfather Name !" onblur="checkValidation('caste-certificate', 'grandfather_name_for_cc', fatherNameValidationMessage);"
                                                                   >
                                                            <span class="error-message error-message-caste-certificate-grandfather_name_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>22.2 Grandfather's Nationality <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="grandfather_nationality_for_cc" name="grandfather_nationality" class="form-control" placeholder="Enter Grandfather's Nationality!"
                                                                   maxlength="100" onblur="checkValidation('caste-certificate', 'grandfather_nationality_for_cc', nationalityValidationMessages);" value="{{grandfather_data.grandfather_nationality}}">
                                                            <span class="error-message error-message-caste-certificate-grandfather_nationality_for_cc"></span>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>22.3 Grandfather Birth Place<span class="color-nic-red">*</span></label><br/>
                                                            <label>22.3.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="grandfather_born_place_state_for_cc" name="grandfather_born_place_state" class="form-control select2"
                                                                        data-placeholder="Select State/UT"
                                                                        onchange="checkValidation('cc', 'grandfather_born_place_state_for_cc', selectStateValidationMessage);
                                                                                CasteCertificate.listview.getDistrictData($(this), 'cc', 'grandfather_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-grandfather_born_place_state_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>22.3.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="grandfather_born_place_district_for_cc" name="grandfather_born_place_district" class="form-control select2"
                                                                        data-placeholder="Select District"
                                                                        onchange="checkValidation('cc', 'grandfather_born_place_district_for_cc', selectDistrictValidationMessage);
                                                                                CasteCertificate.listview.getVillageData($(this), 'cc', 'grandfather_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-grandfather_born_place_district_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>22.3.3 Village <span class="color-nic-red">*</span></label>
                                                            <select id="grandfather_born_place_village_for_cc" name="grandfather_born_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('cc', 'grandfather_born_place_village_for_cc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-grandfather_born_place_village_for_cc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>22.3 Original Native of<span class="color-nic-red">*</span></label><br/>
                                                            <label>22.4.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="grandfather_native_place_district_for_cc" name="grandfather_native_place_district" class="form-control select2"
                                                                        onchange="checkValidation('caste-certificate', 'grandfather_native_place_district_for_cc', selectDistrictValidationMessage); CasteCertificate.listview.grandfatherNativeCityChangeEvent($(this));"
                                                                        data-placeholder="Select District" style="width: 100%;">
                                                                </select>
                                                            </div>

                                                            <span class="error-message error-message-caste-certificate-grandfather_native_place_district_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>22.2.4 Select City<span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select class="form-control select2" id="grandfather_city_for_cc" name="grandfather_city"
                                                                        data-placeholder="City !"  onblur="checkValidation('caste-certificate', 'grandfather_city_for_cc', selectCityValidationMessage);" 
                                                                        onchange="CasteCertificate.listview.nativeFamilyVillageChangeEvent($(this), 'grandfather_native_place_village_for_cc');"></select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-grandfather_city_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>22.4.3 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                            <select id="grandfather_native_place_village_for_cc" name="grandfather_native_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('cc', 'grandfather_native_place_village_for_cc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-grandfather_native_place_village_for_cc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>22.5 Grandfather Religion <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="grandfather_religion_for_cc" name="grandfather_religion_for_cc" class="form-control" 
                                                                   onblur="checkValidation('caste-certificate', 'grandfather_religion_for_cc', religionValidationMessage);"
                                                                   placeholder="Enter Religion !" maxlength="100" value="{{grandfather_data.grandfather_religion}}">
                                                            <span class="error-message error-message-caste-certificate-grandfather_religion_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>22.6 Grandgrandfather Caste<span class="color-nic-red">*</span></label>
                                                            <div id="grandfather_caste_container_for_caste_certificate"></div>
                                                            <span class="error-message error-message-caste-certificate-grandfather_caste_for_caste_certificate"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 grandfather_caste_sc_item_container_for_caste_certificate" style="display: none;">
                                                            <label>22.6.1 Caste. <span class="color-nic-red">*</span></label>
                                                            <select id="grandfather_sc_subcaste_for_cc" name="grandfather_sc_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-grandfather_sc_subcaste_for_cc"></span>
                                                        </div>

                                                        <div class="form-group col-sm-4 grandfather_caste_st_item_container_for_caste_certificate" style="display: none;">
                                                            <label>22.6.1 Caste. <span class="color-nic-red">*</span></label>
                                                            <select id="grandfather_st_subcaste_for_cc" name="grandfather_st_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-grandfather_st_subcaste_for_cc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4 if_grandfather_alive_item_container_for_caste_certificate">
                                                            <label>22.7 Grandfather's Aadhar Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="grandfather_aadhaar_for_cc" name="grandfather_aadhaar" class="form-control" placeholder="Enter Aadhar Number"
                                                                       maxlength="15" onkeyup="checkNumeric($(this));"  value="{{grandfather_data.grandfather_aadhaar}}">
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-grandfather_aadhaar_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4 if_grandfather_alive_item_container_for_caste_certificate">
                                                            <label>22.8 Grandfather's Election Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="grandfather_election_no_for_cc" name="grandfather_election_no" class="form-control" placeholder="Enter Election Number"
                                                                       maxlength="15" value="{{grandfather_data.grandfather_election_no}}">
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-grandfather_election_no_for_cc"></span>
                                                        </div>

                                                        <div class="form-group col-sm-4 col-md-4 if_grandfather_alive_item_container_for_caste_certificate">
                                                            <label>22.9 Grandfather's Occupation. <span class="color-nic-red">*</span></label>
                                                            <select id="grandfather_occupation_for_cc" name="grandfather_occupation" class="form-control select2" onchange="checkValidation('caste-certificate', 'grandfather_occupation_for_cc', applicantOccupationValidationMessage);
                                                                    if (this.value == 12) {
                                                                        $('.grandfather_other_occupation_div_for_cc').show();
                                                                    } else {
                                                                        $('.grandfather_other_occupation_div_for_cc').hide();
                                                                    }" data-placeholder="Select Occupation" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-grandfather_occupation_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <div class="grandfather_other_occupation_div_for_cc" style="display: none;">
                                                                <label>22.9.1 Other Occupation Detail</label>
                                                                <input type="text" id="grandfather_other_occupation_for_cc" name="grandfather_other_occupation"
                                                                       maxlength="100" class="form-control" value="{{grandfather_data.grandfather_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('caste-certificate', 'grandfather_other_occupation_for_cc', otherOccupationValidationMessage);"
                                                                       >
                                                                <span class="error-message error-message-caste-certificate-grandfather_other_occupation_for_cc"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.d-md-flex -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------>
                    <div class="row spouse_info_item_container_for_cc" style="display: none;">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1">
                                    <h3 class="card-title">23. Spouse Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body border-nic-blue pt-1 spouse_info_div" style="display: none;">
                                    <div class="">
                                        <div class="p-1 flex-fill" style="overflow: hidden">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label>Did Your Spouse is Alive ? <span class="color-nic-red">*</span></label>
                                                            <div id="spouse_alive_container_for_caste_certificate"></div>
                                                            <span class="error-message error-message-caste-certificate-spouse_alive_for_caste_certificate"></span>
                                                        </div>


                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>23.1 Name of Spouse <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="spouse_name_for_cc" name="spouse_name"
                                                                   maxlength="100" class="form-control" value="{{spouse_data.spouse_name}}" placeholder="Enter Spouse Name !" onblur="checkValidation('caste-certificate', 'spouse_name_for_cc', spouseNameValidationMessage);"
                                                                   >
                                                            <span class="error-message error-message-caste-certificate-spouse_name_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>23.2 Spouse's Nationality <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="spouse_nationality_for_cc" name="spouse_nationality" class="form-control" placeholder="Enter Spouse's Nationality!"
                                                                   maxlength="100" onblur="checkValidation('caste-certificate', 'spouse_nationality_for_cc', nationalityValidationMessage);" value="{{spouse_data.spouse_nationality}}">
                                                            <span class="error-message error-message-caste-certificate-spouse_nationality_for_cc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>23.3 Spouse Birth Place<span class="color-nic-red">*</span></label><br/>
                                                            <label>23.3.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="spouse_born_place_state_for_cc" name="spouse_born_place_state" class="form-control select2"
                                                                        data-placeholder="Select State/UT"
                                                                        onchange="checkValidation('cc', 'spouse_born_place_state_for_cc', selectStateValidationMessage);
                                                                                CasteCertificate.listview.getDistrictData($(this), 'cc', 'spouse_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-spouse_born_place_state_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>23.3.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="spouse_born_place_district_for_cc" name="spouse_born_place_district" class="form-control select2"
                                                                        data-placeholder="Select District"
                                                                        onchange="checkValidation('cc', 'spouse_born_place_district_for_cc', selectDistrictValidationMessage);
                                                                                CasteCertificate.listview.getVillageData($(this), 'cc', 'spouse_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-spouse_born_place_district_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>23.3.3 Village <span class="color-nic-red">*</span></label>
                                                            <select id="spouse_born_place_village_for_cc" name="spouse_born_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('cc', 'spouse_born_place_village_for_cc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-spouse_born_place_village_for_cc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>23.4 Original Native of<span class="color-nic-red">*</span></label><br/>
                                                            <label>23.4.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="spouse_native_place_state_for_cc" name="spouse_native_place_state" class="form-control select2"
                                                                        data-placeholder="Select State/UT"
                                                                        onchange="checkValidation('cc', 'spouse_native_place_state_for_cc', selectStateValidationMessage);
                                                                                CasteCertificate.listview.getDistrictData($(this), 'cc', 'spouse_native_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-spouse_native_place_state_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>23.4.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="spouse_native_place_district_for_cc" name="spouse_native_place_district" class="form-control select2"
                                                                        data-placeholder="Select District"
                                                                        onchange="checkValidation('cc', 'spouse_native_place_district_for_cc', selectDistrictValidationMessage);
                                                                                CasteCertificate.listview.getVillageData($(this), 'cc', 'spouse_native_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-spouse_native_place_district_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>23.4.3 Village <span class="color-nic-red">*</span></label>
                                                            <select id="spouse_native_place_village_for_cc" name="spouse_native_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('cc', 'spouse_native_place_village_for_cc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-spouse_native_place_village_for_cc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>23.5 Spouse Religion <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="spouse_religion_for_cc" name="spouse_religion_for_cc" class="form-control" 
                                                                   onblur="checkValidation('caste-certificate', 'spouse_religion_for_cc', religionValidationMessage);"
                                                                   placeholder="Enter Religion !" maxlength="100" value="{{spouse_data.spouse_religion}}">
                                                            <span class="error-message error-message-caste-certificate-spouse_religion_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>23.6 Spouse Caste<span class="color-nic-red">*</span></label>
                                                            <div id="spouse_caste_container_for_caste_certificate"></div>
                                                            <span class="error-message error-message-caste-certificate-spouse_caste_for_caste_certificate"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 spouse_caste_sc_item_container_for_caste_certificate" style="display: none;">
                                                            <label>23.6.1 Caste. <span class="color-nic-red">*</span></label>
                                                            <select id="spouse_sc_subcaste_for_cc" name="spouse_sc_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-spouse_sc_subcaste_for_cc"></span>
                                                        </div>

                                                        <div class="form-group col-sm-4 spouse_caste_st_item_container_for_caste_certificate" style="display: none;">
                                                            <label>23.6.1 Caste. <span class="color-nic-red">*</span></label>
                                                            <select id="spouse_st_subcaste_for_cc" name="spouse_st_subcaste" class="form-control select2" data-placeholder="Select Subcaste" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-spouse_st_subcaste_for_cc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4 if_spouse_alive_item_container_for_caste_certificate">
                                                            <label>23.7 Spouse's Aadhar Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="spouse_aadhaar_for_cc" name="spouse_aadhaar" class="form-control" placeholder="Enter Aadhar Number"
                                                                       maxlength="15" onkeyup="checkNumeric($(this));"  value="{{spouse_data.spouse_aadhaar}}">
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-spouse_aadhaar_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4 if_spouse_alive_item_container_for_caste_certificate">
                                                            <label>23.8 Spouse's Election Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="spouse_election_no_for_cc" name="spouse_election_no" class="form-control" placeholder="Enter Election Number"
                                                                       maxlength="15" value="{{spouse_data.spouse_election_no}}">
                                                            </div>
                                                            <span class="error-message error-message-caste-certificate-spouse_election_no_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4 if_spouse_alive_item_container_for_caste_certificate">
                                                            <label>23.9 Spouse's Occupation. <span class="color-nic-red">*</span></label>
                                                            <select id="spouse_occupation_for_cc" name="spouse_occupation" class="form-control select2" onchange="checkValidation('caste-certificate', 'spouse_occupation_for_cc', applicantOccupationValidationMessage);
                                                                    if (this.value == 12) {
                                                                        $('.spouse_other_occupation_div_for_cc').show();
                                                                    } else {
                                                                        $('.spouse_other_occupation_div_for_cc').hide();
                                                                    }" data-placeholder="Select Occupation" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-caste-certificate-spouse_occupation_for_cc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <div class="spouse_other_occupation_div_for_cc" style="display: none;">
                                                                <label>23.9.1 Other Occupation Detail</label>
                                                                <input type="text" id="spouse_other_occupation_for_cc" name="spouse_other_occupation"
                                                                       maxlength="100" class="form-control" value="{{spouse_data.spouse_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('caste-certificate', 'spouse_other_occupation_for_cc', otherOccupationValidationMessage);"
                                                                       >
                                                                <span class="error-message error-message-caste-certificate-spouse_other_occupation_for_cc"></span>
                                                            </div>
                                                        </div> 

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- /.d-md-flex -->
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>

                    <!------------------------------------------------->
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">More Details</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>24. I am member of a Scheduled Caste/ tribe or community classified by Govt.<span class="color-nic-red">*</span></label>
                                    <div id="im_member_of_scst_container_for_caste_certificate"></div>
                                    <span class="error-message error-message-caste-certificate-im_member_of_scst_for_caste_certificate"></span>
                                </div>
                            </div>
                            <!------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6 im_member_of_scst_item_container_for_caste_certificate" style="display: none;">
                                    <label>24.1 Enter Detail <span class="color-nic-red"></span></label>
                                    <textarea id="detail_of_membership_scst_for_caste_certificate" name="detail_of_membership_scst_for_caste_certificate"
                                              class="form-control" placeholder="Enter Detail of membership!" 
                                              maxlength="100">{{caste_certificate_data.detail_of_membership_scst}}</textarea>
                                </div>
                                <span class="error-message error-message-caste-certificate-detail_of_membership_scst_for_caste_certificate"></span>
                            </div>
                            <!------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>25. For What Purpose is the Certificate of Caste Required. <span class="color-nic-red">*</span></label>
                                    <input type="text" id="purpose_of_caste_certificate_for_cc" name="purpose_of_caste_certificate_for_cc" class="form-control" placeholder="Enter Purpose of Certificate !"
                                           maxlength="100" onblur="checkValidation('caste-certificate', 'purpose_of_caste_certificate_for_cc', purposeOfIncomeCertyValidationMessage);" value="{{caste_certificate_data.purpose_of_caste_certificate}}">
                                    <span class="error-message error-message-caste-certificate-purpose_of_caste_certificate_for_cc"></span>
                                </div>
                            </div>
                            <!------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>26. Did you applied for a Caste/Tribe Certificate previously ? <span class="color-nic-red">*</span></label>
                                    <div id="applied_for_sc_st_certy_container_for_caste_certificate"></div>
                                    <span class="error-message error-message-caste-certificate-applied_for_sc_st_certy_for_caste_certificate"></span>
                                </div>

                            </div>

                            <!------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-3 applied_for_sc_st_certy_item_container_for_caste_certificate" style="display: none;">
                                    <label>26.1 Applied Date <span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applied_date_for_caste_certificate" id="applied_date_for_caste_certificate" class="form-control" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY" value="{{applied_date}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-caste-certificate-applied_date_for_caste_certificate"></span>
                                </div>

                                <div class="form-group col-sm-3 applied_for_sc_st_certy_item_container_for_caste_certificate" style="display: none;">
                                    <label>26.2 Certificate Number <span class="color-nic-red"></span></label>
                                    <input type="text" id="year_of_applied_certy_for_caste_certificate" name="year_of_applied_certy_for_caste_certificate" class="form-control" placeholder="Enter Certificate Number !" maxlength="100"  value="{{caste_certificate_data.year_of_applied_certy}}">
                                </div>
                                <span class="error-message error-message-caste-certificate-year_of_applied_certy_for_caste_certificate"></span>
                            </div>
                            <!------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>27. My father/ Husband/ Wife hold Caste/Tribe Certificate details of the same are as under<span class="color-nic-red">*</span></label>
                                    <div id="fath_hus_wif_hold_sc_st_certy_container_for_caste_certificate"></div>
                                    <span class="error-message error-message-caste-certificate-fath_hus_wif_hold_sc_st_certy_for_caste_certificate"></span>
                                </div>

                            </div>
                            <!------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-4 fath_hus_wif_hold_sc_st_certy_item_container_for_caste_certificate" style="display: none;">
                                    <label>27.1 Applied Date <span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applied_date_of_hold_certy_for_caste_certificate" id="applied_date_of_hold_certy_for_caste_certificate" class="form-control" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY" value="{{applied_date}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-caste-certificate-applied_date_of_hold_certy_for_caste_certificate"></span>
                                </div>

                                <div class="form-group col-sm-4 fath_hus_wif_hold_sc_st_certy_item_container_for_caste_certificate" style="display: none;">
                                    <label>27.2 Certificate Number <span class="color-nic-red"></span></label>
                                    <input type="text" id="year_of_applied_hold_certy_for_caste_certificate" name="year_of_applied_hold_certy_for_caste_certificate" class="form-control" placeholder="Enter Certificate Number !" maxlength="100"  value="{{caste_certificate_data.year_of_applied_certy}}">
                                </div>
                                <span class="error-message error-message-caste-certificate-year_of_applied_hold_certy_for_caste_certificate"></span>
                            </div>
                        </div>
                    </div>
                    </br>
                    <!------------------------------------------------->
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Enclosed as below</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <span style="color: red;font-weight: bold;">Note : Must upload pdf file with original scan documents <br></span>

                            <div class="row mb-2">
                                <div class="col-12" id="applicant_photo_doc_container_for_caste_certificate">
                                    <label>35. Upload Applicant Photo (Latest). <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-applicant_photo_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="applicant_photo_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>35. Upload Applicant Photo (Latest). <span style="color: red;">*</span></label><br>
                                    <a target="_blank" id="applicant_photo_doc_download">
                                        <img id="applicant_photo_doc_name_image_for_caste_certificate"
                                             style="width: 250px; height: 250px; border: 2px solid blue;"
                                             class="spinner_name_container_for_caste_certificate_{{VALUE_NINE}}">
                                    </a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="self_birth_certificate_doc_container_for_caste_certificate">
                                    <label>28. Applicant Original Birth Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-self_birth_certificate_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="self_birth_certificate_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>28. Applicant Original Birth Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="self_birth_certificate_doc_download"><label id="self_birth_certificate_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="father_certificate_doc_container_for_caste_certificate">
                                    <label class="father_proof_item_container_for_caste_certificate" ><span class="doc_no_for_caste_certificate"></span>29. Applicant's Father Original Birth Certificate / Leaving Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label>

                                    <label class="father_death_proof_item_container_for_caste_certificate" style="display:none" ><span class="doc_no_for_caste_certificate"></span> 29. Applicant's Father Original Death Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>

                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-father_certificate_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_certificate_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label class="father_proof_item_container_for_caste_certificate" ><span class="doc_no_for_caste_certificate"></span> Applicant's Father Original Birth Certificate / Leaving Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label>

                                    <label class="father_death_proof_item_container_for_caste_certificate" style="display:none" ><span class="doc_no_for_caste_certificate"></span> Applicant's Father Original Death Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>

                                    <a target="_blank" id="father_certificate_doc_download"><label id="father_certificate_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>30. Do You have Grand father's Birth Certificate ? <span class="color-nic-red">*</span></label>
                                    <div id="if_grandfather_having_document_container_for_caste_certificate"></div>
                                    <span class="error-message error-message-caste-certificate-if_grandfather_having_document_for_caste_certificate"></span>
                                </div>
                            </div>
                            <!-----------------Grandfather Birth Certy------->
                            <div class="row mb-2 if_grandfather_birth_document_item_container_for_caste_certificate" style="display: none;">
                                <div class="col-12" id="grandfather_birth_certificate_doc_container_for_caste_certificate">
                                    <label>30.1 Applicant's Grandfather Original Birth Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-grandfather_birth_certificate_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="grandfather_birth_certificate_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>30.1 Applicant's Grandfather Original Birth Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="grandfather_birth_certificate_doc_download"><label id="grandfather_birth_certificate_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <!---------------Grand Father Property Document------------------------->
                            <div class="row mb-2 if_grandfather_property_document_item_container_for_caste_certificate" style="display: none;">
                                <div class="col-12" id="grandfather_property_doc_container_for_caste_certificate">
                                    <label>30.1 Applicant's Grandfather Property Document <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-grandfather_property_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="grandfather_property_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>30.1 Applicant's Grandfather Property Document <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="grandfather_property_doc_download"><label id="grandfather_property_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="leaving_certificate_doc_container_for_caste_certificate">
                                    <label>31. Applicant Original Leaving Certificate / Bonofied Certificate Form <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-leaving_certificate_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="leaving_certificate_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>31. Applicant Original Leaving Certificate / Bonofied Certificate Form <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="leaving_certificate_doc_download"><label id="leaving_certificate_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="election_card_doc_container_for_caste_certificate">
                                    <label>32. Applicant Original Election Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-election_card_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="election_card_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>32. Applicant Original Election Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="election_card_doc_download"><label id="election_card_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="aadhar_card_doc_container_for_caste_certificate">
                                    <label>33. Applicant Original Aadhar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-aadhar_card_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="aadhar_card_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>33. Applicant Original Aadhar Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="aadhar_card_doc_download"><label id="aadhar_card_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="father_election_card_doc_container_for_caste_certificate">
                                    <label>32. Applicant Original Father Election Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-father_election_card_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_election_card_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>32. Applicant Original Father Election Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="father_election_card_doc_download"><label id="father_election_card_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_THIRTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="father_aadhar_card_doc_container_for_caste_certificate">
                                    <label>33. Applicant Original Father Aadhar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-father_aadhar_card_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_aadhar_card_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>33. Applicant Original Father Aadhar Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="father_aadhar_card_doc_download"><label id="father_aadhar_card_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_FOURTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="mother_election_card_doc_container_for_caste_certificate">
                                    <label>32. Applicant Original Mother Election Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-mother_election_card_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="mother_election_card_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>32. Applicant Original Mother Election Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="mother_election_card_doc_download"><label id="mother_election_card_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_FIFTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIFTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="mother_aadhar_card_doc_container_for_caste_certificate">
                                    <label>33. Applicant Original Mother Aadhar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-mother_aadhar_card_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="mother_aadhar_card_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>33. Applicant Original Mother Aadhar Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="mother_aadhar_card_doc_download"><label id="mother_aadhar_card_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_SIXTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="community_certificate_doc_container_for_caste_certificate">
                                    <label>34. Applicant Community Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-community_certificate_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="community_certificate_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>34. Applicant Community Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="community_certificate_doc_download"><label id="community_certificate_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-12" id="father_community_certificate_doc_container_for_caste_certificate">
                                    <label>35. Applicant Father Community Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-caste-certificate-father_community_certificate_doc_for_caste_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_community_certificate_doc_name_container_for_caste_certificate" style="display: none;">
                                    <label>35. Applicant Father Community Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="father_community_certificate_doc_download"><label id="father_community_certificate_doc_name_image_for_caste_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_caste_certificate_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            
                        </div>
                    </div>
                </div>
                <hr class="m-b-1rem"> 

                <!----------------------------------------->

                <div class="card-footer p-2">
                    <button type="button" id="submit_btn_for_caste_certificate" class="btn btn-sm btn-success" onclick="CasteCertificate.listview.submitCasteCertificate({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="CasteCertificate.listview.loadCasteCertificateData();">Close</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>