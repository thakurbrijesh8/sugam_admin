<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">OBC Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application for issue of OBC Certificate</div>
            </div>
            <form role="form" id="obc_certificate_form" name="obc_certificate_form" onsubmit="return false;">

                <input type="hidden" id="obc_certificate_id" name="obc_certificate_id" value="{{obc_certificate_data.obc_certificate_id}}">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-obc-certificate f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <input type="hidden" id="constitution_artical" name="constitution_artical" value="2">The Mamlatdar,
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
                                            onchange="checkValidation('obc-certificate', 'district', selectDistrictValidationMessage); ObcCertificate.listview.districtChangeEvent($(this));"
                                            data-placeholder="Select District" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-obc-certificate-district"></span>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label>1.1 Name of Village Panchayat/D.M.C <span class="color-nic-red">*</span></label>
                                    <select id="village_name_for_oc" name="village_name" class="form-control select2"
                                            onchange="checkValidation('obc-certificate', 'village_name_for_oc', oneOptionValidationMessage); ObcCertificate.listview.villageDMCChangeEvent($(this));"
                                            data-placeholder="Select Name of Village Panchayat/D.M.C" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-obc-certificate-village_name_for_oc"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="applicant_name_for_oc_div">2. Full Name of Guardian / Applicant <span clocass="color-nic-red">*</span></label>

                                    <div class="input-group">
                                        <input type="text" id="applicant_name_for_oc" name="applicant_name" class="form-control" placeholder="Enter Full Name of Guardian !"
                                               maxlength="100" onblur="checkValidation('obc-certificate', 'applicant_name_for_oc', applicantNameValidationMessage);" value="{{obc_certificate_data.applicant_name}}">
                                    </div>
                                    <span class="error-message error-message-obc-certificate-applicant_name_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-6 guardian_div_one">
                                    <label>2.1 Applicant Relationship with Minor <span class="color-nic-red">*</span></label>

                                    <select id="relationship_of_applicant_for_oc" name="relationship_of_applicant" class="form-control select2" onchange="checkValidation('obc-certificate', 'relationship_of_applicant_for_oc', relationWithDeceasedPersonValidationMessage);" data-placeholder="Select Relation with Deceased Person" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-obc-certificate-relationship_of_applicant_for_oc"></span>
                                </div>
                            </div>

                            <div class="row guardian_div_two">
                                <div class="form-group col-sm-6">
                                    <label>2.2 Guardian's Address <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <textarea id="guardian_address_for_oc" name="guardian_address" class="form-control" placeholder="Enter Guardian's Address !"
                                                  maxlength="100" onblur="checkValidation('obc-certificate', 'guardian_address_for_oc', guardianAddressValidationMessage);" >{{obc_certificate_data.guardian_address}}</textarea>
                                    </div>
                                    <span class="error-message error-message-obc-certificate-guardian_address_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.3 Guardian’s Mobile Number <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="guardian_mobile_no_for_oc" name="guardian_mobile_no" class="form-control" placeholder="Enter Mobile Number !"
                                               maxlength="100" onkeyup="checkNumeric($(this));"  onblur="checkValidationForMobileNumber('obc-certificate', 'guardian_mobile_no_for_oc', mobileValidationMessage);" value="{{obc_certificate_data.guardian_mobile_no}}">
                                    </div>
                                    <span class="error-message error-message-obc-certificate-guardian_mobile_no_for_oc"></span>
                                </div>
                            </div>

                            <div class="row guardian_div_three">
                                <div class="form-group col-sm-6">
                                    <label>2.4 Guardian’s Aadhaar Number<span class="color-nic-red">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="guardian_aadhaar_for_oc" name="guardian_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                               maxlength="12" onkeyup="checkNumeric($(this));" value="{{obc_certificate_data.guardian_aadhaar}}">
                                    </div>
                                    <span class="error-message error-message-obc-certificate-guardian_aadhaar_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.5 Name of Minor Child<span class="color-nic-red">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="minor_child_name_for_oc" name="minor_child_name" class="form-control" placeholder="Enter Name of Minor Child"
                                               maxlength="100" onblur="checkValidation('obc-certificate', 'minor_child_name_for_oc', minorChildNameValidationMessage);" value="{{obc_certificate_data.minor_child_name}}">
                                    </div>
                                    <span class="error-message error-message-obc-certificate-minor_child_name_for_oc"></span>
                                </div>
                            </div>

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
                                                    <input type="text" id="com_addr_house_no_for_oc" name="com_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{obc_certificate_data.com_addr_house_no}}" onblur="checkValidation('obc-certificate', 'com_addr_house_no_for_oc', houseNoValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-com_addr_house_no_for_oc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.2 Building Name / House Name</label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_house_name_for_oc" name="com_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{obc_certificate_data.com_addr_house_name}}">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-com_addr_house_name_for_oc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>3.3 Street <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_street_for_oc" name="com_addr_street" class="form-control" placeholder="Enter Street !"
                                                           maxlength="100" onblur="checkValidation('obc-certificate', 'com_addr_street_for_oc', streetValidationMessage);" value="{{obc_certificate_data.com_addr_street}}">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-com_addr_street_for_oc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_village_dmc_ward_for_oc" name="com_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                           maxlength="100" onblur="checkValidation('obc-certificate', 'com_addr_village_dmc_ward_for_oc', villageNameValidationMessage);" value="{{obc_certificate_data.com_addr_village_dmc_ward}}" readonly="">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-com_addr_village_dmc_ward_for_oc"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>3.5 Select City<span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_city_for_oc" name="com_addr_city" class="form-control" placeholder="Enter City !"
                                                           maxlength="100" onblur="checkValidation('obc-certificate', 'com_addr_city_for_oc', selectCityValidationMessage);" onchange="ObcCertificate.listview.getPincode($(this));" value="{{obc_certificate_data.com_addr_city}}" readonly="">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-com_addr_city_for_oc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.6 Pincode <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_pincode_for_oc" name="com_pincode" class="form-control" placeholder="Enter Pincode !"
                                                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('obc-certificate', 'com_pincode_for_oc', pincodeValidationMessage);" value="{{obc_certificate_data.com_pincode}}">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-com_pincode_for_oc"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="card-body pt-1" style="background-color: aliceblue;">

                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label>Same as Communication Address</label>&nbsp;
                                                <input type="checkbox" id="billingtoo_for_oc" name="billingtoo" class="checkbox" value="{{is_checked}}"  onchange="ObcCertificate.listview.FillBilling($(this));">
                                                <span class="error-message error-message-obc-certificate-billingtoo"></span><br>
                                                <label>4. Applicant’s Permanent Address</label><hr> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.1 House No./Flat No. <span class="color-nic-red">*</span></label>

                                                <div class="input-group">
                                                    <input type="text" id="per_addr_house_no_for_oc" name="per_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{obc_certificate_data.per_addr_house_no}}" onblur="checkValidation('obc-certificate', 'per_addr_house_no_for_oc', houseNoValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-per_addr_house_no_for_oc"></span>
                                            </div>
                                            <div class="form-group col-sm-6" >
                                                <label>4.2 Building Name / House Name</label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_house_name_for_oc" name="per_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{obc_certificate_data.per_addr_house_name}}">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-per_addr_house_name_for_oc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.3 Street <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_street_for_oc" name="per_addr_street" class="form-control" placeholder="Enter Street !"
                                                           maxlength="100" onblur="checkValidation('obc-certificate', 'per_addr_street_for_oc', streetValidationMessage);" value="{{obc_certificate_data.per_addr_street}}">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-per_addr_street_for_oc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_village_dmc_ward_for_oc" name="per_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                           maxlength="100" onblur="checkValidation('obc-certificate', 'per_addr_village_dmc_ward_for_oc', villageNameValidationMessage);" value="{{obc_certificate_data.per_addr_village_dmc_ward}}" >
                                                </div>
                                                <span class="error-message error-message-obc-certificate-per_addr_village_dmc_ward_for_oc"></span>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.5 Select City<span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_city_for_oc" name="per_addr_city" class="form-control" placeholder="Enter City !"
                                                           maxlength="100" onblur="checkValidation('obc-certificate', 'per_addr_city_for_oc', selectCityValidationMessage);" onchange="ObcCertificate.listview.getPincode($(this));" value="{{obc_certificate_data.per_addr_city}}" >
                                                </div>
                                                <span class="error-message error-message-obc-certificate-per_addr_city_for_oc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.6 Pincode <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_pincode_for_oc" name="per_pincode" class="form-control" placeholder="Enter Pincode !"
                                                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('obc-certificate', 'per_pincode_for_oc', pincodeValidationMessage);" value="{{obc_certificate_data.per_pincode}}">
                                                </div>
                                                <span class="error-message error-message-obc-certificate-per_pincode_for_oc"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>5. Minor Applicant's Aadhaar Number</label>
                                    <div class="input-group">
                                        <input type="text" id="aadhaar_for_oc" name="aadhaar"
                                               class="form-control" placeholder="Enter Aadhaar Number !"
                                               maxlength="12" value="{{obc_certificate_data.aadhaar}}">
                                    </div>
                                    <span class="error-message error-message-obc-certificate-aadhaar_for_oc"></span>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>6.  Date of Birth<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applicant_dob" id="applicant_dob_for_oc" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value="{{applicant_dob_text}}"
                                               onblur="checkValidation('obc-certificate', 'applicant_dob_for_oc', birthDateValidationMessage); calculateAge('for_oc');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-obc-certificate-applicant_dob_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>6.1 Minor Age<span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_age_for_oc" 
                                           name="applicant_age" class="form-control"
                                           placeholder="Enter Minor Age !" maxlength="100" 
                                           onblur="checkValidation('obc-certificate', 'applicant_age_for_oc', applicantAgeValidationMessage);"
                                           value="{{obc_certificate_data.applicant_age}}" readonly="">
                                    <span class="error-message error-message-obc-certificate-applicant_age_for_oc"></span>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>7.  Minor Nationality <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_nationality_for_oc" name="applicant_nationality" class="form-control" placeholder="Enter Minor Nationality!"
                                           maxlength="100" onblur="checkValidation('obc-certificate', 'applicant_nationality_for_oc', applicantNationalityValidationMessage);" value="{{obc_certificate_data.applicant_nationality}}">
                                    <span class="error-message error-message-obc-certificate-applicant_nationality_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>8. Minor Education <span class="color-nic-red">*</span></label>
                                    <input type="text" id="minor_education_for_oc" name="minor_education" class="form-control" placeholder="Enter Minor Education!"
                                           maxlength="100" onblur="checkValidation('obc-certificate', 'minor_education_for_oc', applicantEducationValidationMessage);" value="{{obc_certificate_data.minor_education}}">
                                    <span class="error-message error-message-obc-certificate-minor_education_for_oc"></span>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>9. Minor Birth Place<span class="color-nic-red">*</span></label><br/>
                                    <label>9.1 State <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="born_place_state_for_oc" name="born_place_state" class="form-control select2"
                                                data-placeholder="Select State/UT"
                                                onchange="checkValidation('oc', 'born_place_state_for_oc', selectStateValidationMessage);
                                                    ObcCertificate.listview.getDistrictData($(this), 'oc', 'born_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-obc-certificate-born_place_state_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>9.2 District <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="born_place_district_for_oc" name="born_place_district" class="form-control select2"
                                                data-placeholder="Select District"
                                                onchange="checkValidation('oc', 'born_place_district_for_oc', selectDistrictValidationMessage);
                                                    ObcCertificate.listview.getVillageData($(this), 'oc', 'born_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-obc-certificate-born_place_district_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>9.3 Village <span class="color-nic-red">*</span></label>
                                    <!--<div class="input-group">-->
                                    <select id="born_place_village_for_oc" name="born_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('oc', 'born_place_village_for_oc', selectVillageValidationMessage);">
                                    </select>
                                    <!--</div>-->
                                    <span class="error-message error-message-obc-certificate-born_place_village_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>9.4 Pincode <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="born_place_pincode_for_oc" name="born_place_pincode" class="form-control" placeholder="Enter Pincode !"
                                               maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('obc-certificate', 'born_place_pincode_for_oc', pincodeValidationMessage);" value="{{obc_certificate_data.born_place_pincode}}">
                                    </div>
                                    <span class="error-message error-message-obc-certificate-born_place_pincode_for_oc"></span>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>10. Original Native of<span class="color-nic-red">*</span></label><br/>
                                    <label>10.1 State <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="native_place_state_for_oc" name="native_place_state" class="form-control select2"
                                                data-placeholder="Select State/UT"
                                                onchange="checkValidation('oc', 'native_place_state_for_oc', selectStateValidationMessage);
                                                    ObcCertificate.listview.getDistrictFornDataForNative($(this), 'native_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-obc-certificate-native_place_state_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>10.2 District <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="native_place_district_for_oc" name="native_place_district" class="form-control select2"
                                                data-placeholder="Select District"
                                                onchange="checkValidation('oc', 'native_place_district_for_oc', selectDistrictValidationMessage);
                                                    ObcCertificate.listview.getVillageDataForNative($(this), 'native_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-obc-certificate-native_place_district_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>10.3 Village <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="native_place_village_for_oc" name="native_place_village" class="form-control select2"
                                                data-placeholder="Select Village" onchange="checkValidation('oc', 'native_place_village_for_oc', selectVillageValidationMessage);">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-obc-certificate-native_place_village_for_oc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>10.4 Pincode <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="native_place_pincode_for_oc" name="native_place_pincode" class="form-control" placeholder="Enter Pincode !"
                                               maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('obc-certificate', 'native_place_pincode_for_oc', pincodeValidationMessage);" value="{{obc_certificate_data.native_place_pincode}}">
                                    </div>
                                    <span class="error-message error-message-obc-certificate-native_place_pincode_for_oc"></span>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>11. Gender<span class="color-nic-red">*</span></label>
                                    <div id="gender_container_for_oc"></div>
                                    <span class="error-message error-message-obc-certificate-gender_for_oc"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>12. Select Caste <span class="color-nic-red">*</span></label>
                                    <select id="obccaste_for_oc" name="obccaste" class="form-control select2" onchange="checkValidation('obc-certificate', 'obccaste_for_oc', castesValidationMessage);" data-placeholder="Select Caste" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-obc-certificate-obccaste_for_oc"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6 ">
                                    <label>13. Applicant Religion.<span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="religion_for_oc" name="religion" class="form-control" onchange="checkValidation('obc-certificate', 'religion_for_oc', religionValidationMessage);" placeholder="Enter Religion !" maxlength="100" value="{{obc_certificate_data.religion}}">
                                    </div>
                                    <span class="error-message error-message-obc-certificate-religion_for_oc"></span>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label>14. Nearest Police Station. <span class="color-nic-red">*</span></label>
                                    <select id="nearest_police_station_for_oc" name="nearest_police_station" class="form-control select2" data-placeholder="Select Police Station Area" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-obc-certificate-nearest_police_station_for_oc"></span>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1" >
                                    <h3 class="card-title">15. Father Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
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
                                                            <div id="father_alive_container_for_obc_certificate"></div>
                                                            <span class="error-message error-message-obc-certificate-father_alive_for_obc_certificate"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>15.1 Name of Father <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="father_name_for_oc" name="father_name"
                                                                   maxlength="100" class="form-control" value="{{father_data.father_name}}" placeholder="Enter Father Name !" onblur="checkValidation('obc-certificate', 'father_name_for_oc', fatherNameValidationMessage);"
                                                                   >
                                                            <span class="error-message error-message-obc-certificate-father_name_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>15.2 Father's Nationality <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="father_nationality_for_oc" name="father_nationality" class="form-control" placeholder="Enter Father's Nationality!"
                                                                   maxlength="100" onblur="checkValidation('obc-certificate', 'father_nationality_for_oc', applicantNationalityValidationMessage);" value="{{father_data.father_nationality}}">
                                                            <span class="error-message error-message-obc-certificate-father_nationality_for_oc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>15.3 Father Birth Place<span class="color-nic-red">*</span></label><br/>
                                                            <label>15.3.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_born_place_state_for_oc" name="father_born_place_state" class="form-control select2"
                                                                        data-placeholder="Select State/UT"
                                                                        onchange="checkValidation('oc', 'father_born_place_state_for_oc', selectStateValidationMessage);
                                                                            ObcCertificate.listview.getDistrictData($(this), 'oc', 'father_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-father_born_place_state_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>15.3.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_born_place_district_for_oc" name="father_born_place_district" class="form-control select2"
                                                                        data-placeholder="Select District"
                                                                        onchange="checkValidation('oc', 'father_born_place_district_for_oc', selectDistrictValidationMessage);
                                                                            ObcCertificate.listview.getVillageData($(this), 'oc', 'father_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-father_born_place_district_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>15.3.3 Village <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_born_place_village_for_oc" name="father_born_place_village" class="form-control select2"
                                                                        data-placeholder="Select Village" onchange="checkValidation('oc', 'father_born_place_village_for_oc', selectVillageValidationMessage);">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-father_born_place_village_for_oc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>15.4 Original Native of<span class="color-nic-red">*</span></label><br/>

                                                            <label>15.4.1 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_native_place_district_for_oc" name="father_native_place_district" class="form-control select2"
                                                                        onchange="checkValidation('obc-certificate', 'father_native_place_district_for_oc', selectDistrictValidationMessage); ObcCertificate.listview.nativeCityChangeEvent($(this));"
                                                                        data-placeholder="Select District" style="width: 100%;">
                                                                </select>
                                                            </div>

                                                            <span class="error-message error-message-obc-certificate-father_native_place_district_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>15.4.2 Select City<span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_city_for_oc" name="father_city" class="form-control select2"
                                                                        data-placeholder="City !"  onblur="checkValidation('obc-certificate', 'father_city_for_oc', selectCityValidationMessage);" 
                                                                        onchange="ObcCertificate.listview.nativeFamilyVillageChangeEvent($(this), 'father_native_place_village_for_oc');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-father_city_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>15.4.3 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="father_native_place_village_for_oc" name="father_native_place_village" class="form-control select2"
                                                                        data-placeholder="Select Village" onchange="checkValidation('cc', 'father_native_place_village_for_oc', selectVillageValidationMessage);">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-father_native_place_village_for_oc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>15.5 Father Religion <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="father_religion_for_oc" name="father_religion" class="form-control" placeholder="Enter Religion !" maxlength="100"  onchange="checkValidation('obc-certificate', 'father_religion_for_oc', religionValidationMessage);" value="{{father_data.father_religion}}">
                                                            <span class="error-message error-message-obc-certificate-father_religion_for_oc"></span>
                                                        </div>

                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>15.6 Father Caste<span class="color-nic-red">*</span></label>
                                                            <select id="father_caste_for_oc" name="father_caste" class="form-control select2"  data-placeholder="Select Caste" style="width: 100%;" onchange="checkValidation('obc-certificate', 'father_caste_for_oc', casteValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-obc-certificate-father_caste_for_oc"></span>

                                                        </div>

                                                        <div class="form-group col-sm-4 col-md-4 if_father_alive_item_container_for_obc_certificate">
                                                            <label>15.7 Father Annual Income (Excluding Salary & Agriculture Income)<span class="color-nic-red">*</span></label>
                                                            <input type="checkNumeric" id="father_annual_income_for_oc" name="father_annual_income" class="form-control" placeholder="Enter Annual Income !" maxlength="100" onkeyup="checkNumeric($(this));" onblur="checkValidation('obc-certificate', 'father_annual_income_for_oc', annualIncomeValidationMessage); ObcCertificate.listview.getYearlyIncomeTotalforMinor($(this));" value="{{father_data.father_annual_income}}">
                                                            <span class="error-message error-message-obc-certificate-father_annual_income_for_oc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6 if_father_alive_item_container_for_obc_certificate">
                                                            <label>15.8 Father's Aadhaar Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="father_aadhaar_for_oc" name="father_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                                       maxlength="15" onkeyup="checkNumeric($(this));" value="{{father_data.father_aadhaar}}">
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-father_aadhaar_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6 if_father_alive_item_container_for_obc_certificate">
                                                            <label>15.9 Father's Election Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="father_election_no_for_oc" name="father_election_no" class="form-control" placeholder="Enter Election Number"
                                                                       maxlength="15" value="{{father_data.father_election_no}}">
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-father_election_no_for_oc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6 if_father_alive_item_container_for_obc_certificate">
                                                            <label>15.10 Father's occupation. <span class="color-nic-red">*</span></label>
                                                            <select id="father_occupation_for_oc" name="father_occupation" class="form-control select2" onchange="checkValidation('obc-certificate', 'father_occupation_for_oc', applicantOccupationValidationMessage); ObcCertificate.listview.partAFChangeEvent($(this))" data-placeholder="Select Occupation" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-obc-certificate-father_occupation_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <div class="father_other_occupation_div_for_oc" style="display: none;">
                                                                <label>15.10.1 Other Occupation Detail</label>
                                                                <input type="text" id="father_other_occupation_for_oc" name="father_other_occupation"
                                                                       maxlength="100" class="form-control" value="{{father_data.father_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('obc-certificate', 'father_other_occupation_for_oc', otherOccupationValidationMessage);"
                                                                       >
                                                                <span class="error-message error-message-obc-certificate-father_other_occupation_for_oc"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1" >
                                    <h3 class="card-title">21. Mother Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body border-nic-blue pt-1 mother_info_div" style="display: none;">
                                    <div class="">
                                        <div class="p-1 flex-fill" style="overflow: hidden">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label>Did Your Mother is Alive ? <span class="color-nic-red">*</span></label>
                                                            <div id="mother_alive_container_for_obc_certificate"></div>
                                                            <span class="error-message error-message-obc-certificate-mother_alive_for_obc_certificate"></span>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>21.1 Name of Mother <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="mother_name_for_oc" name="mother_name"
                                                                   maxlength="100" class="form-control" value="{{mother_data.mother_name}}" placeholder="Enter Mother Name !" onblur="checkValidation('obc-certificate', 'mother_name_for_oc', motherNameValidationMessage);"
                                                                   >
                                                            <span class="error-message error-message-obc-certificate-mother_name_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>21.2 Mother's Nationality <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="mother_nationality_for_oc" name="mother_nationality" class="form-control" placeholder="Enter Mother's Nationality!"
                                                                   maxlength="100" onblur="checkValidation('obc-certificate', 'mother_nationality_for_oc', applicantNationalityValidationMessage);" value="{{mother_data.mother_nationality}}">
                                                            <span class="error-message error-message-obc-certificate-mother_nationality_for_oc"></span>
                                                        </div>


                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>21.3 Mother Birth Place<span class="color-nic-red">*</span></label><br/>
                                                            <label>21.3.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="mother_born_place_state_for_oc" name="mother_born_place_state" class="form-control select2"
                                                                        data-placeholder="Select State/UT"
                                                                        onchange="checkValidation('oc', 'mother_born_place_state_for_oc', selectStateValidationMessage);
                                                                            ObcCertificate.listview.getDistrictData($(this), 'oc', 'mother_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-mother_born_place_state_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>21.3.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="mother_born_place_district_for_oc" name="mother_born_place_district" class="form-control select2"
                                                                        data-placeholder="Select District"
                                                                        onchange="checkValidation('oc', 'mother_born_place_district_for_oc', selectDistrictValidationMessage);
                                                                            ObcCertificate.listview.getVillageData($(this), 'oc', 'mother_born_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-mother_born_place_district_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>21.3.3 Village <span class="color-nic-red">*</span></label>
                                                            <select id="mother_born_place_village_for_oc" name="mother_born_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('oc', 'mother_born_place_village_for_oc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-obc-certificate-mother_born_place_village_for_oc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>21.4 Original Native of<span class="color-nic-red">*</span></label><br/>
                                                            <label>21.4.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="mother_native_place_state_for_oc" name="mother_native_place_state" class="form-control select2"
                                                                        data-placeholder="Select State/UT"
                                                                        onchange="checkValidation('oc', 'mother_native_place_state_for_oc', selectStateValidationMessage);
                                                                            ObcCertificate.listview.getDistrictData($(this), 'oc', 'mother_native_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-mother_native_place_state_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>21.4.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="mother_native_place_district_for_oc" name="mother_native_place_district" class="form-control select2"
                                                                        data-placeholder="Select District"
                                                                        onchange="checkValidation('oc', 'mother_native_place_district_for_oc', selectDistrictValidationMessage);
                                                                            ObcCertificate.listview.getVillageData($(this), 'oc', 'mother_native_place');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-mother_native_place_district_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                            <label>21.4.3 Village <span class="color-nic-red">*</span></label>
                                                            <select id="mother_native_place_village_for_oc" name="mother_native_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('oc', 'mother_native_place_village_for_oc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-obc-certificate-mother_native_place_village_for_oc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>21.5 Mother Religion <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="mother_religion_for_oc" name="mother_religion" class="form-control" placeholder="Enter Religion !" maxlength="100" onchange="checkValidation('obc-certificate', 'mother_religion_for_oc', religionValidationMessage);" value="{{mother_data.mother_religion}}">
                                                            <span class="error-message error-message-obc-certificate-mother_religion_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>21.6 Mother Caste<span class="color-nic-red">*</span></label>
                                                            <input type="text" id="mother_caste" name="mother_caste" class="form-control" placeholder="Enter Mother Caste !"
                                                                   maxlength="100" onblur="checkValidation('obc-certificate', 'mother_caste', castesValidationMessage);" value="{{mother_data.mother_caste}}">
                                                            <span class="error-message error-message-obc-certificate-mother_caste"></span>
                                                        </div>

                                                        <div class="form-group col-sm-4 col-md-4 if_mother_alive_item_container_for_obc_certificate">
                                                            <div class="mother_seaman_annual_income_div_for_oc" >
                                                                <label>21.7 Mother Annual Income (Excluding Salary & Agriculture Income)<span class="color-nic-red">*</span></label>
                                                                <input type="checkNumeric" id="mother_annual_income_for_oc" name="mother_annual_income" class="form-control" placeholder="Enter Annual Income !" maxlength="100" onkeyup="checkNumeric($(this));" onblur="checkValidation('obc-certificate', 'mother_annual_income_for_oc', annualIncomeValidationMessage); ObcCertificate.listview.getYearlyIncomeTotalforMinor($(this));"  value="{{mother_data.mother_annual_income}}">
                                                                <span class="error-message error-message-obc-certificate-mother_annual_income_for_oc"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6 if_mother_alive_item_container_for_obc_certificate">
                                                            <label>21.8 Mother's Aadhaar Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="mother_aadhaar_for_oc" name="mother_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                                       maxlength="15" onkeyup="checkNumeric($(this));"  value="{{mother_data.mother_aadhaar}}">
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-mother_aadhaar_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6 if_mother_alive_item_container_for_obc_certificate">
                                                            <label>21.9 Mother's Election Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="mother_election_no_for_oc" name="mother_election_no" class="form-control" placeholder="Enter Election Number"
                                                                       maxlength="15" value="{{mother_data.mother_election_no}}">
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-mother_election_no_for_oc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6 if_mother_alive_item_container_for_obc_certificate">
                                                            <label>21.10 Mother's Occupation. <span class="color-nic-red">*</span></label>
                                                            <select id="mother_occupation_for_oc" name="mother_occupation" class="form-control select2" onchange="checkValidation('obc-certificate', 'mother_occupation_for_oc', applicantOccupationValidationMessage); ObcCertificate.listview.partAMChangeEvent($(this))" data-placeholder="Select Occupation" style="width: 100%;">
                                                            </select>
                                                            <span class="error-message error-message-obc-certificate-mother_occupation_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <div class="mother_other_occupation_div_for_oc" style="display: none;">
                                                                <label>21.10.1 Other Occupation Detail</label>
                                                                <input type="text" id="mother_other_occupation_for_oc" name="mother_other_occupation"
                                                                       maxlength="100" class="form-control" value="{{mother_data.mother_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('obc-certificate', 'mother_other_occupation_for_oc', otherOccupationValidationMessage);"
                                                                       >
                                                                <span class="error-message error-message-obc-certificate-mother_other_occupation_for_oc"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1" >
                                    <h3 class="card-title">17. Grandfather Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body border-nic-blue pt-1 grandfather_info_div" style="display: none;" >
                                    <div class="">
                                        <div class="p-1 flex-fill" style="overflow: hidden">


                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label>Did Your Grandfather is Alive ? <span class="color-nic-red">*</span></label>
                                                            <div id="grandfather_alive_container_for_obc_certificate"></div>
                                                            <span class="error-message error-message-obc-certificate-grandfather_alive_for_obc_certificate"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>17.1 Name of Grandfather <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="grandfather_name_for_oc" name="grandfather_name"
                                                                   maxlength="100" class="form-control" value="{{grandfather_data.grandfather_name}}" placeholder="Enter Grandfather Name !" onblur="checkValidation('obc-certificate', 'grandfather_name_for_oc', fatherNameValidationMessage);"
                                                                   >
                                                            <span class="error-message error-message-obc-certificate-grandfather_name_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-6 col-md-6">
                                                            <label>17.2 Grandfather's Nationality <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="grandfather_nationality_for_oc" name="grandfather_nationality" class="form-control" placeholder="Enter Grandfather's Nationality!"
                                                                   maxlength="100" onblur="checkValidation('obc-certificate', 'grandfather_nationality_for_oc', applicantNationalityValidationMessage);" value="{{grandfather_data.grandfather_nationality}}">
                                                            <span class="error-message error-message-obc-certificate-grandfather_nationality_for_oc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>17.3 Grandfather Birth Place<span class="color-nic-red">*</span></label><br/>
                                                            <label>17.3.1 State <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select class="form-control select2" id="grandfather_born_place_district_for_oc" name="grandfather_born_place_district"
                                                                        data-placeholder="District !"  onblur="checkValidation('obc-certificate', 'grandfather_born_place_district_for_oc', selectCityValidationMessage);" 
                                                                        onchange="ObcCertificate.listview.grandfatherBornCityChangeEvent($(this));">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-grandfather_born_place_district_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:17px">
                                                            <label>17.3.2 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select class="form-control select2" id="grandfather_borncity_for_oc" name="grandfather_borncity"
                                                                        data-placeholder="City !"  onblur="checkValidation('obc-certificate', 'grandfather_borncity_for_oc', selectCityValidationMessage);" 
                                                                        onchange="ObcCertificate.listview.nativeFamilyVillageChangeEvent($(this), 'grandfather_born_place_village_for_oc');">>
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-grandfather_borncity_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:17px">
                                                            <label>17.3.3 Village <span class="color-nic-red">*</span></label>
                                                            <select id="grandfather_born_place_village_for_oc" name="grandfather_born_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('oc', 'grandfather_born_place_village_for_oc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-obc-certificate-grandfather_born_place_village_for_oc"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>17.4 Original Native of<span class="color-nic-red">*</span></label><br/>
                                                            <label>17.4.1 District <span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select id="grandfather_native_place_district_for_oc" name="grandfather_native_place_district" class="form-control select2"
                                                                        onchange="checkValidation('obc-certificate', 'grandfather_native_place_district_for_oc', selectDistrictValidationMessage); ObcCertificate.listview.grandfatherNativeCityChangeEvent($(this));"
                                                                        data-placeholder="Select District" style="width: 100%;">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-grandfather_native_place_district_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:17px">
                                                            <label>17.4.2 Select City<span class="color-nic-red">*</span></label>
                                                            <div class="">
                                                                <select class="form-control select2" id="grandfather_city_for_oc" name="grandfather_city"
                                                                        data-placeholder="City !"  onblur="checkValidation('obc-certificate', 'grandfather_city_for_oc', selectCityValidationMessage);" 
                                                                        onchange="ObcCertificate.listview.nativeFamilyVillageChangeEvent($(this), 'grandfather_native_place_village_for_oc');">
                                                                </select>
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-grandfather_city_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4" style="margin-top:17px">
                                                            <label>17.4.3 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                            <select id="grandfather_native_place_village_for_oc" name="grandfather_native_place_village" class="form-control select2"
                                                                    data-placeholder="Select Village" onchange="checkValidation('cc', 'grandfather_native_place_village_for_oc', selectVillageValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-obc-certificate-grandfather_native_place_village_for_oc"></span>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>17.5 Grandfather Religion <span class="color-nic-red">*</span></label>
                                                            <input type="text" id="grandfather_religion_for_oc" name="grandfather_religion" class="form-control" placeholder="Enter Religion !" maxlength="100" onchange="checkValidation('obc-certificate', 'grandfather_religion_for_oc', religionValidationMessage);" value="{{grandfather_data.grandfather_religion}}">
                                                            <span class="error-message error-message-obc-certificate-grandfather_religion_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4">
                                                            <label>17.6 Grandgrandfather Caste<span class="color-nic-red">*</span></label>
                                                            <select id="grandfather_caste_for_oc" name="grandfather_caste" class="form-control select2"  data-placeholder="Select Caste" style="width: 100%;" onchange="checkValidation('obc-certificate', 'grandfather_religion_for_oc', castesValidationMessage);">
                                                            </select>
                                                            <span class="error-message error-message-obc-certificate-grandfather_caste_for_oc"></span>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-4 col-md-4 if_grandfather_alive_item_container_for_obc_certificate">
                                                            <label>17.7 Grandfather's Aadhaar Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="grandfather_aadhaar_for_oc" name="grandfather_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                                       maxlength="15" onkeyup="checkNumeric($(this));" value="{{grandfather_data.grandfather_aadhaar}}">
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-grandfather_aadhaar_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4 if_grandfather_alive_item_container_for_obc_certificate">
                                                            <label>17.8 Grandfather's Election Number </label>
                                                            <div class="input-group">
                                                                <input type="text" id="grandfather_election_no_for_oc" name="grandfather_election_no" class="form-control" placeholder="Enter Election Number"
                                                                       maxlength="15" value="{{grandfather_data.grandfather_election_no}}">
                                                            </div>
                                                            <span class="error-message error-message-obc-certificate-grandfather_election_no_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4 if_grandfather_alive_item_container_for_obc_certificate">
                                                            <label>17.9 Grandfather's Occupation. <span class="color-nic-red">*</span></label>
                                                            <select id="grandfather_occupation_for_oc" name="grandfather_occupation" class="form-control select2" onchange="checkValidation('obc-certificate', 'grandfather_occupation_for_oc', applicantOccupationValidationMessage); showOtherapplicantOccupationtext(this, 'grandfather_other_occupation_div', 'obc_certificate');" data-placeholder="Select Occupation" style="width: 100%;">
                                                            </select>

                                                            <span class="error-message error-message-obc-certificate-grandfather_occupation_for_oc"></span>
                                                        </div>
                                                        <div class="form-group col-sm-4 col-md-4"  id="grandfather_other_occupation_div_for_obc_certificate" style="display: none;">
                                                            <label>17.9.1 Other Occupation Detail</label>
                                                            <input type="text" id="grandfather_other_occupation_for_oc" name="grandfather_other_occupation"
                                                                   maxlength="100" class="form-control" value="{{grandfather_data.grandfather_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('obc-certificate', 'grandfather_other_occupation_for_oc', otherOccupationValidationMessage);"
                                                                   >
                                                            <span class="error-message error-message-obc-certificate-grandfather_other_occupation_for_oc"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- PART - A  -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card part_a_div" style="display: none;">
                                <div class="card-header bg-nic-blue pt-1" >
                                    <h3 class="card-title">18. PART A - Constitutional Post</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body border-nic-blue pt-1 part_a_div" style="display: none;">
                                    <div class="">
                                        <div class="p-1 flex-fill">
                                            <div class="card" style="background-color: #F8F8F8;">
                                                <div class="table-responsive" >
                                                    <table class="table table-bordered table-hover-cells m-0 f-s">
                                                        <thead>
                                                            <tr class="bg-light-gray">
                                                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                <th class="p-1" style="min-width: 150px;">Details</th>
                                                                <th class="p-1 f-gov-job d-none"  style="min-width: 150px;">Father Details </th>
                                                                <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                            <tr class="p-1">
                                                                <td><b>1</b></td>
                                                                <td>Designation</td>
                                                                <td class="f-gov-job d-none">
                                                                    <input type="text" id="father_designation_for_oc" name="father_designation_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_designation.father_designation}}" placeholder="Enter Designation !" onblur="checkValidation('obc-certificate', 'father_designation_for_oc', fathergovDetailsValidationMessage);" >
                                                                    <span class="error-message error-message-obc-certificate-father_designation_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_designation_for_oc" name="mother_designation_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_designation.mother_designation}}" placeholder="Enter Designation !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_designation_for_oc', mothergovDetailsValidationMessage);" >
                                                                    <span class="error-message error-message-obc-certificate-mother_designation_for_oc"></span>
                                                                </td>        
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PART - B -->


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card part_b_div" style="display: none;">
                                <div class="card-header bg-nic-blue pt-1" >
                                    <h3 class="card-title">19. PART B - Government Services </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body border-nic-blue pt-1 part_b_div">
                                    <div class="">
                                        <div class="p-1 flex-fill">

                                            <div class="card" style="background-color: #F8F8F8;">
                                                <div class="card-header bg-nic-blue pt-1" >
                                                    <div class="row">
                                                        <div class="col-12 f-w-b">
                                                            <h6 style="font-weight: bold; ">19.1. Government Services </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <span class="error-message error-message-obc-certificate-mi f-w-b"
                                                              style="border-bottom: 2px solid red;"></span>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover-cells m-0 f-s">
                                                        <thead>
                                                            <tr class="bg-light-gray">
                                                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                <th class="p-1" style="min-width: 150px;">Details</th>
                                                                <th class="p-1 f-gov-job d-none"  style="min-width: 150px;">Father Details </th>
                                                                <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                            <tr class="p-1">
                                                                <td><b>1</b></td>
                                                                <td>Services(Central/State)</td>
                                                                <td class="f-gov-job d-none">
                                                                    <input type="text" id="father_services_for_oc" name="father_services_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_services.father_services}}" placeholder="Enter Services !"
                                                                           onblur="checkValidation('obc-certificate', 'father_services_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_services_for_oc"></span>
                                                                </td>
                                                                <td class="m-gov-job d-none">
                                                                    <input type="text" id="mother_services_for_oc" name="mother_services_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_services.mother_services}}" placeholder="Enter Services !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_services_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_services_for_oc"></span>
                                                                </td>
                                                            </tr>
                                                            <tr class="p-1">
                                                                <td><b>2</b></td>
                                                                <td>Designation</td>
                                                                <td class="f-gov-job d-none">
                                                                    <input type="text" id="father_designation_b_for_oc" name="father_designation_b_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_designation_b.father_designation_b}}" placeholder="Enter Designation !" onblur="checkValidation('obc-certificate', 'father_designation_b_for_oc', fathergovDetailsValidationMessage);" >
                                                                    <span class="error-message error-message-obc-certificate-father_designation_b_for_oc"></span>
                                                                </td>
                                                                <td class="m-gov-job d-none">
                                                                    <input type="text" id="mother_designation_b_for_oc" name="mother_designation_b_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_designation_b.mother_designation_b}}" placeholder="Enter Designation !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_designation_b_for_oc', mothergovDetailsValidationMessage);" >
                                                                    <span class="error-message error-message-obc-certificate-mother_designation_b_for_oc"></span>
                                                                </td>
                                                            </tr>
                                                            <tr class="p-1">
                                                                <td><b>3</b></td>
                                                                <td>Scale of Pay, including Classification, if any.</td>
                                                                <td class="f-gov-job d-none">
                                                                    <input type="text" id="father_scale_of_pay_for_oc" name="father_scale_of_pay_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_scale_of_pay.father_scale_of_pay}}" placeholder="Enter Scale of Pay !"
                                                                           onblur="checkValidation('obc-certificate', 'father_scale_of_pay_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_scale_of_pay_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_scale_of_pay_for_oc" name="mother_scale_of_pay_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_scale_of_pay.mother_scale_of_pay}}" placeholder="Enter Scale of Pay !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_scale_of_pay_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_scale_of_pay_for_oc"></span>
                                                                </td>

                                                            </tr>
                                                            <tr class="p-1">
                                                                <td><b>4</b></td>
                                                                <td>Date of the Appointment to the post</td>
                                                                <td class="f-gov-job d-none">
                                                                    <input type="text" id="father_appointment_date_for_oc" name="father_appointment_date_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_appointment_date.father_appointment_date}}" placeholder="Enter Date of the Appointment !"
                                                                           onblur="checkValidation('obc-certificate', 'father_appointment_date_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_appointment_date_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_appointment_date_for_oc" name="mother_appointment_date_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_appointment_date.mother_appointment_date}}" placeholder="Enter Date of the Appointment !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_appointment_date_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_appointment_date_for_oc"></span>
                                                                </td>

                                                            </tr>
                                                            <tr class="p-1">
                                                                <td><b>5</b></td>
                                                                <td>Age at the time of promotion to Class Post (if applicable)</td>
                                                                <td class="f-gov-job d-none">
                                                                    <input type="text" id="father_promotion_age_for_oc" name="father_promotion_age_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_promotion_age.father_promotion_age}}" placeholder="Enter Age at the time of Promotion !"
                                                                           onblur="checkValidation('obc-certificate', 'father_promotion_age_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_promotion_age_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_promotion_age_for_oc" name="mother_promotion_age_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_promotion_age.mother_promotion_age}}" placeholder="Enter Age at the time of Promotion !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_promotion_age_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_promotion_age_for_oc"></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> 
                                            </div>

                                            <div class="card" style="background-color: #F8F8F8;">
                                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                                    <div class="row">
                                                        <div class="col-12 f-w-b">
                                                            <h6 style="font-weight: bold; ">19.2. Employment in International Organization e.g, UN, NICEF, WHO,</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <span class="error-message error-message-obc-certificate-mi f-w-b"
                                                              style="border-bottom: 2px solid red;"></span>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover-cells m-0 f-s">
                                                        <thead>
                                                            <tr class="bg-light-gray">
                                                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                <th class="p-1" style="min-width: 150px;">Details</th>
                                                                <th class="p-1 f-gov-job d-none" style="min-width: 150px;">Father Details </th>
                                                                <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                            <tr class="p-1">
                                                                <td><b>1</b></td>
                                                                <td>Name of orgnization</td>
                                                                <td class="p-1 f-gov-job d-none">
                                                                    <input type="text" id="father_organization_name_for_oc" name="father_organization_name_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_organization_name.father_organization_name}}" placeholder="Enter Name of orgnization !"
                                                                           onblur="checkValidation('obc-certificate', 'father_organization_name_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_organization_name_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_organization_name_for_oc" name="mother_organization_name_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_organization_name.mother_organization_name}}" placeholder="Enter Name of orgnization !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_organization_name_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_organization_name_for_oc"></span>
                                                                </td>

                                                            </tr>
                                                            <tr class="p-1">
                                                                <td><b>2</b></td>
                                                                <td>Designation</td>
                                                                <td class="p-1 f-gov-job d-none">
                                                                    <input type="text" id="father_designation_b1_for_oc" name="father_designation_b1_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_designation_b1.father_designation_b1}}" placeholder="Enter Designation !"
                                                                           onblur="checkValidation('obc-certificate', 'father_designation_b1', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_designation_b1_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_designation_b1_for_oc" name="mother_designation_b1_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_designation_b1.mother_designation_b1}}" placeholder="Enter Designation !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_designation_b1_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_designation_b1_for_oc"></span>
                                                                </td>

                                                            </tr>
                                                            <tr class="p-1">
                                                                <td><b>3</b></td>
                                                                <td>Period of Sevice (Indicate date from)</td>
                                                                <td class="p-1 f-gov-job d-none">
                                                                    <input type="text" id="father_service_period_for_oc" name="father_service_period_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_service_period.father_service_period}}" placeholder="Enter Period of Sevice !"
                                                                           onblur="checkValidation('obc-certificate', 'father_service_period', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_service_period_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_service_period_for_oc" name="mother_service_period_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_service_period.mother_service_period}}" placeholder="Enter Period of Sevice !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_service_period', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_service_period_for_oc"></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> 
                                            </div>


                                            <div class="card" style="background-color: #F8F8F8;">
                                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                                    <div class="row">
                                                        <div class="col-12 f-w-b">
                                                            <h6 style="font-weight: bold; ">19.3. Death/Permanent Incapacitation (Omit if not applicable)</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <span class="error-message error-message-obc-certificate-mi f-w-b"
                                                              style="border-bottom: 2px solid red;"></span>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover-cells m-0 f-s">
                                                        <thead>
                                                            <tr class="bg-light-gray">
                                                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                <th class="p-1" style="min-width: 150px;">Relation With Applicant</th>
                                                                <th class="p-1 f-gov-job d-none" style="min-width: 150px;">Father Details </th>
                                                                <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                            <tr class="p-1">
                                                                <td><b>1</b></td>
                                                                <td>Date of Death/Permanent incapacitation putting an officer out of service.</td>
                                                                <td class="p-1 f-gov-job d-none">
                                                                    <input type="text" id="father_permanent_incapacitation_service_for_oc" name="father_permanent_incapacitation_service_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_permanent_incapacitation_service.father_permanent_incapacitation_service}}" placeholder="Enter Date !"
                                                                           onblur="checkValidation('obc-certificate', 'father_permanent_incapacitation_service_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_permanent_incapacitation_service_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_permanent_incapacitation_service_for_oc" name="mother_permanent_incapacitation_service_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_permanent_incapacitation_service.mother_permanent_incapacitation_service}}" placeholder="Enter Date !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_permanent_incapacitation_service_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_permanent_incapacitation_service_for_oc"></span>
                                                                </td>

                                                            </tr>
                                                            <tr class="p-1">
                                                                <td><b>2</b></td>
                                                                <td>Details of Permanent Incapacitation</td>
                                                                <td class="p-1 f-gov-job d-none">
                                                                    <input type="text" id="father_permanent_incapacitation_for_oc" name="father_permanent_incapacitation_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_permanent_incapacitation.father_permanent_incapacitation}}" placeholder="Enter Detailss of Incapacitation!"
                                                                           onblur="checkValidation('obc-certificate', 'father_permanent_incapacitation_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_permanent_incapacitation_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_permanent_incapacitation_for_oc" name="mother_permanent_incapacitation_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_permanent_incapacitation.mother_permanent_incapacitation}}" placeholder="Enter Detailss of Incapacitation !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_permanent_incapacitation_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_permanent_incapacitation_for_oc"></span>
                                                                </td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PART - C -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card part_c_div" style="display: none;">
                                <div class="card-header bg-nic-blue pt-1" >
                                    <h3 class="card-title">20. PART C - Employment in Public Sector Undertaking etc.</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body border-nic-blue pt-1 part_c_div">
                                    <div class="">
                                        <div class="p-1 flex-fill">

                                            <div class="card" style="background-color: #F8F8F8;">
                                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                                    <div class="row">
                                                        <div class="col-12 f-w-b">
                                                            <h6 style="font-weight: bold; ">20. Employment in Public Sector Undertaking etc. </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <span class="error-message error-message-obc-certificate-mi f-w-b"
                                                              style="border-bottom: 2px solid red;"></span>
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover-cells m-0 f-s">
                                                        <thead>
                                                            <tr class="bg-light-gray">
                                                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                <th class="p-1" style="min-width: 150px;">Details</th>
                                                                <th class="p-1 f-gov-job d-none" style="min-width: 150px;">Father Details </th>
                                                                <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                            <tr class="p-1">
                                                                <td><b>1</b></td>
                                                                <td>Name of Organization</td>
                                                                <td class="p-1 f-gov-job d-none">
                                                                    <input type="text" id="father_organization_name_partc_for_oc" name="father_organization_name_partc_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_organization_name_partc.father_organization_name_partc}}" placeholder="Enter Name of Organization !"
                                                                           onblur="checkValidation('obc-certificate', 'father_organization_name_partc_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_organization_name_partc_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_organization_name_partc_for_oc" name="mother_organization_name_partc_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_organization_name_partc.mother_organization_name_partc}}" placeholder="Enter Name of Organization !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_organization_name_partc_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_organization_name_partc_for_oc"></span>
                                                                </td>
                                                            </tr>
                                                            <tr class="p-1">
                                                                <td><b>2</b></td>
                                                                <td>Designation</td>
                                                                <td class="p-1 f-gov-job d-none">
                                                                    <input type="text" id="father_designation_partc_for_oc" name="father_designation_partc_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_designation_partc.father_designation_partc}}" placeholder="Enter Designation !"
                                                                           onblur="checkValidation('obc-certificate', 'father_designation_partc_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_designation_partc_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_designation_partc_for_oc" name="mother_designation_partc_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_designation_partc.mother_designation_partc}}" placeholder="Enter Designation !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_designation_partc_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_designation_partc_for_oc"></span>
                                                                </td>
                                                            </tr>
                                                            <tr class="p-1">
                                                                <td><b>3</b></td>
                                                                <td>Date of Appintment to the post</td>
                                                                <td class="p-1 f-gov-job d-none">
                                                                    <input type="text" id="father_date_of_appointmet_partc_for_oc" name="father_date_of_appointmet_partc_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_date_of_appointmet_partc.father_date_of_appointmet_partc}}" placeholder="Enter Date of Appintment !"
                                                                           onblur="checkValidation('obc-certificate', 'father_date_of_appointmet_partc_for_oc', fathergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-father_date_of_appointmet_partc_for_oc"></span>
                                                                </td>
                                                                <td class="p-1 m-gov-job d-none">
                                                                    <input type="text" id="mother_date_of_appointmet_partc_for_oc" name="mother_date_of_appointmet_partc_for_oc"
                                                                           maxlength="100" class="form-control" value="{{f_date_of_appointmet_partc.mother_date_of_appointmet_partc}}" placeholder="Enter Date of Appintment !"
                                                                           onblur="checkValidation('obc-certificate', 'mother_date_of_appointmet_partc_for_oc', mothergovDetailsValidationMessage);">
                                                                    <span class="error-message error-message-obc-certificate-mother_date_of_appointmet_partc_for_oc"></span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PART - D -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card collapsed-card part_d_div" style="display: none;">
                                        <div class="card-header bg-nic-blue pt-1" >
                                            <h3 class="card-title">21. PART D - Armed Forces including Para-military Forces </h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body border-nic-blue pt-1 part_d_div">
                                            <div class="">
                                                <div class="p-1 flex-fill">

                                                    <div class="card" style="background-color: #F8F8F8;">
                                                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                                                            <div class="row">
                                                                <div class="col-12 f-w-b">
                                                                    <h6 style="font-weight: bold; ">21. Armed Forces including Para-military Forces(This will no include persons holing Civil posts)</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 text-center">
                                                                <span class="error-message error-message-obc-certificate-mi f-w-b"
                                                                      style="border-bottom: 2px solid red;"></span>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-hover-cells m-0 f-s">
                                                                <thead>
                                                                    <tr class="bg-light-gray">
                                                                        <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                        <th class="p-1" style="min-width: 150px;">Details</th>
                                                                        <th class="p-1 f-gov-job d-none" style="min-width: 150px;">Father Details </th>
                                                                        <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody id="">
                                                                    <tr class="p-1">
                                                                        <td><b>1</b></td>
                                                                        <td>Designation</td>
                                                                        <td class="p-1 f-gov-job d-none">
                                                                            <input type="text" id="father_designation_partd_for_oc" name="father_designation_partd_for_oc"
                                                                                   maxlength="100" class="form-control" value="{{f_designation_partd.father_designation_partd}}" placeholder="Enter Designation !"
                                                                                   onblur="checkValidation('obc-certificate', 'father_designation_partd_for_oc', fathergovDetailsValidationMessage);">
                                                                            <span class="error-message error-message-obc-certificate-father_designation_partd_for_oc"></span>
                                                                        </td>
                                                                        <td class="p-1 m-gov-job d-none">
                                                                            <input type="text" id="mother_designation_partd_for_oc" name="mother_designation_partd_for_oc"
                                                                                   maxlength="100" class="form-control" value="{{f_designation_partd.mother_designation_partd}}" placeholder="Enter Designation !"
                                                                                   onblur="checkValidation('obc-certificate', 'mother_designation_partd_for_oc', mothergovDetailsValidationMessage);">
                                                                            <span class="error-message error-message-obc-certificate-mother_designation_partd_for_oc"></span>
                                                                        </td>

                                                                    </tr>
                                                                    <tr class="p-1">
                                                                        <td><b>2</b></td>
                                                                        <td>Scale of Pay</td>
                                                                        <td class="p-1 f-gov-job d-none">
                                                                            <input type="text" id="father_scale_of_pay_partd_for_oc" name="father_scale_of_pay_partd_for_oc"
                                                                                   maxlength="100" class="form-control" value="{{f_scale_of_pay_partd.father_scale_of_pay_partd}}" placeholder="Enter Scale of Pay !"
                                                                                   onblur="checkValidation('obc-certificate', 'father_scale_of_pay_partd_for_oc', fathergovDetailsValidationMessage);">
                                                                            <span class="error-message error-message-obc-certificate-father_scale_of_pay_partd_for_oc"></span>
                                                                        </td>
                                                                        <td class="p-1 m-gov-job d-none">
                                                                            <input type="text" id="mother_scale_of_pay_partd_for_oc" name="mother_scale_of_pay_partd_for_oc"
                                                                                   maxlength="100" class="form-control" value="{{f_scale_of_pay_partd.mother_scale_of_pay_partd}}" placeholder="Enter Scale of Pay !"
                                                                                   onblur="checkValidation('obc-certificate', 'mother_scale_of_pay_partd_for_oc', mothergovDetailsValidationMessage);">
                                                                            <span class="error-message error-message-obc-certificate-mother_scale_of_pay_partd_for_oc"></span>
                                                                        </td>

                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div> 
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- PART E  -->

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card collapsed-card part_e_div" style="display: none;">
                                                <div class="card-header bg-nic-blue pt-1" >
                                                    <h3 class="card-title">22. PART E - Professional Class</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body border-nic-blue pt-1 part_e_div">
                                                    <div class="">
                                                        <div class="p-1 flex-fill">

                                                            <div class="card" style="background-color: #F8F8F8;">
                                                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                                                    <div class="row">
                                                                        <div class="col-12 f-w-b">
                                                                            <h6 style="font-weight: bold; ">22. Professional Class (Other then these covered in item No. B & C) and those engaged in trade,  Business and Industry.</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span class="error-message error-message-obc-certificate-mi f-w-b"
                                                                              style="border-bottom: 2px solid red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-hover-cells m-0 f-s">
                                                                        <thead>
                                                                            <tr class="bg-light-gray">
                                                                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                                <th class="p-1" style="min-width: 150px;">Details</th>
                                                                                <th class="p-1 f-gov-job d-none" style="min-width: 150px;">Father Details </th>
                                                                                <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="">
                                                                            <tr class="p-1">
                                                                                <td><b>1</b></td>
                                                                                <td>Occupation/Profession</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_occupation_family_for_oc" name="father_occupation_family_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_occupation.father_occupation_family}}" placeholder="Enter Occupation/Profession !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_occupation_family_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_occupation_family_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_occupation_family_for_oc" name="mother_occupation_family_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_occupation.mother_occupation_family}}" placeholder="Enter Occupation/Profession !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_occupation_family_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_occupation_family_for_oc"></span>
                                                                                </td>

                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div> 
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- PART - F -->


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card collapsed-card part_f_div" style="display: none;">
                                                <div class="card-header bg-nic-blue pt-1" >
                                                    <h3 class="card-title">23. PART F - PROPERTY- OWNERS</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body border-nic-blue pt-1 part_f_div">
                                                    <div class="">
                                                        <div class="p-1 flex-fill">

                                                            <div class="card" style="background-color: #F8F8F8;">
                                                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                                                    <div class="row">
                                                                        <div class="col-12 f-w-b">
                                                                            <h6 style="font-weight: bold; ">23.1. Agricultural Land Holding: Owned  by mother, Father & Minor children </h6>          
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span class="error-message error-message-obc-certificate-mi f-w-b"
                                                                              style="border-bottom: 2px solid red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-hover-cells m-0 f-s">
                                                                        <thead>
                                                                            <tr class="bg-light-gray">
                                                                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                                <th class="p-1" style="min-width: 150px;">Details</th>
                                                                                <th class="p-1 f-gov-job d-none" style="min-width: 150px;">Father Details </th>
                                                                                <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="">
                                                                            <tr class="p-1">
                                                                                <td><b>1</b></td>
                                                                                <td>Location</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_location_for_oc" name="father_location_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_location.father_location}}" placeholder="Enter Location !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_location_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_location_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_location_for_oc" name="mother_location_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_location.mother_location}}" placeholder="Enter Location !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_location_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_location_for_oc"></span>
                                                                                </td>

                                                                            </tr>
                                                                            <tr class="p-1">
                                                                                <td><b>2</b></td>
                                                                                <td>Size of holding</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_size_of_holding_for_oc" name="father_size_of_holding_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_size_of_holding.father_size_of_holding}}" placeholder="Enter Size of holding !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_size_of_holding_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_size_of_holding_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_size_of_holding_for_oc" name="mother_size_of_holding_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_size_of_holding.mother_size_of_holding}}" placeholder="Enter Size of holding !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_size_of_holding_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_size_of_holding_for_oc"></span>
                                                                                </td>

                                                                            </tr>

                                                                            <tr class="p-1">
                                                                                <td><b>3</b></td>
                                                                                <td>Irrigated (Type of Irrigated Land)</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_irrigated_for_oc" name="father_irrigated_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_irrigated.father_irrigated}}" placeholder="Enter Size of holding !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_irrigated_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_irrigated_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_irrigated_for_oc" name="mother_irrigated_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_irrigated.mother_irrigated}}" placeholder="Enter Size of holding !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_irrigated_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_irrigated_for_oc"></span>
                                                                                </td>
                                                                            </tr>

                                                                            <tr class="p-1">
                                                                                <td><b>4</b></td>
                                                                                <td>Percentage of Irrigated land holding to statutory ceiling limit under State land Ceiling laws.</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_perecentage_of_irrigated_for_oc" name="father_perecentage_of_irrigated_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_perecentage_of_irrigated.father_perecentage_of_irrigated}}" placeholder="Enter Details !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_perecentage_of_irrigated_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_perecentage_of_irrigated_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_perecentage_of_irrigated_for_oc" name="mother_perecentage_of_irrigated_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_perecentage_of_irrigated.mother_perecentage_of_irrigated}}" placeholder="Enter Details !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_perecentage_of_irrigated_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_perecentage_of_irrigated_for_oc"></span>
                                                                                </td>

                                                                            </tr>

                                                                            <tr class="p-1">
                                                                                <td><b>5</b></td>
                                                                                <td>If land holding is both irrigated/un irrigated total irrigated land holdings on the basis of conversion formula in state land Ceiling law</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_ceiling_low_for_oc" name="father_ceiling_low_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_ceiling_low.father_ceiling_low}}" placeholder="Enter Details !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_ceiling_low_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_ceiling_low_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_ceiling_low_for_oc" name="mother_ceiling_low_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_ceiling_low.mother_ceiling_low}}" placeholder="Enter Details !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_ceiling_low_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_ceiling_low_for_oc"></span>
                                                                                </td>

                                                                            </tr>

                                                                        <td><b>6</b></td>
                                                                        <td>Percentage of total irrigated land holing to statutory ceiling limit as per(IV)</td>
                                                                        <td class="p-1 f-gov-job d-none">
                                                                            <input type="text" id="father_total_percentage_for_oc" name="father_total_percentage_for_oc"
                                                                                   maxlength="100" class="form-control" value="{{f_total_percentage.father_total_percentage}}" placeholder="Enter Percentage !"
                                                                                   onblur="checkValidation('obc-certificate', 'father_total_percentage_for_oc', fathergovDetailsValidationMessage);">
                                                                            <span class="error-message error-message-obc-certificate-father_total_percentage_for_oc"></span>
                                                                        </td>
                                                                        <td class="p-1 m-gov-job d-none">
                                                                            <input type="text" id="mother_total_percentage_for_oc" name="mother_total_percentage_for_oc"
                                                                                   maxlength="100" class="form-control" value="{{f_total_percentage.mother_total_percentage}}" placeholder="Enter Percentage !"
                                                                                   onblur="checkValidation('obc-certificate', 'mother_total_percentage_for_oc', mothergovDetailsValidationMessage);">
                                                                            <span class="error-message error-message-obc-certificate-mother_total_percentage_for_oc"></span>
                                                                        </td>

                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div> 
                                                            </div>



                                                            <div class="card" style="background-color: #F8F8F8;">
                                                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                                                    <div class="row">
                                                                        <div class="col-12 f-w-b">
                                                                            <h6 style="font-weight: bold; ">23.2. Plantation</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span class="error-message error-message-obc-certificate-mi f-w-b"
                                                                              style="border-bottom: 2px solid red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-hover-cells m-0 f-s">
                                                                        <thead>
                                                                            <tr class="bg-light-gray">
                                                                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                                <th class="p-1" style="min-width: 150px;">Details</th>
                                                                                <th class="p-1 f-gov-job d-none" style="min-width: 150px;">Father Details </th>
                                                                                <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="">
                                                                            <tr class="p-1">
                                                                                <td><b>1</b></td>
                                                                                <td>Crops/Fruit</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_crops_for_oc" name="father_crops_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_crops.father_crops}}" placeholder="Enter Crops/Fruit !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_crops_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_crops_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_crops_for_oc" name="mother_crops_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_crops.mother_crops}}" placeholder="Enter Crops/Fruit !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_crops_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_crops_for_oc"></span>
                                                                                </td>

                                                                            </tr>
                                                                            <tr class="p-1">
                                                                                <td><b>2</b></td>
                                                                                <td>Location</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_location_partf_for_oc" name="father_location_partf_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_location_partf.father_location_partf}}" placeholder="Enter Location !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_location_partf_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_location_partf_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_location_partf_for_oc" name="mother_location_partf_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_location_partf.mother_location_partf}}" placeholder="Enter Location !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_location_partf_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_location_partf_for_oc"></span>
                                                                                </td>

                                                                            </tr>
                                                                            <tr class="p-1">
                                                                                <td><b>3</b></td>
                                                                                <td>Area of Plantation</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_area_plantation_for_oc" name="father_area_plantation_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_area_plantation.father_area_plantation}}" placeholder="Enter Area of Plantation !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_area_plantation_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_area_plantation_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_area_plantation_for_oc" name="mother_area_plantation_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_area_plantation.mother_area_plantation}}" placeholder="Enter Area of Plantation !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_area_plantation_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_area_plantation_for_oc"></span>
                                                                                </td>

                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div> 
                                                            </div>



                                                            <div class="card" style="background-color: #F8F8F8;">
                                                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                                                    <div class="row">
                                                                        <div class="col-12 f-w-b">
                                                                            <h6 style="font-weight: bold; ">23.3. Vacant land and/ or building in urban areas or urban agglomeration</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span class="error-message error-message-obc-certificate-mi f-w-b"
                                                                              style="border-bottom: 2px solid red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-hover-cells m-0 f-s">
                                                                        <thead>
                                                                            <tr class="bg-light-gray">
                                                                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                                                <th class="p-1" style="min-width: 150px;">Details</th>
                                                                                <th class="p-1 f-gov-job d-none" style="min-width: 150px;">Father Details </th>
                                                                                <th class="p-1 m-gov-job d-none" style="min-width: 150px;">Mother Details </th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="">
                                                                            <tr class="p-1">
                                                                                <td><b>1</b></td>
                                                                                <td>Location of Property</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_location_property_for_oc" name="father_location_property_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_location_property.father_location_property}}" placeholder="Enter Location of Property !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_location_property_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_location_property_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_location_property_for_oc" name="mother_location_property_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_location_property.mother_location_property}}" placeholder="Enter Location of Property !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_location_property_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_location_property_for_oc"></span>
                                                                                </td>

                                                                            </tr>
                                                                            <tr class="p-1">
                                                                                <td><b>2</b></td>
                                                                                <td>Details of Property</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_details_for_oc" name="father_details_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_details.father_details}}" placeholder="Enter Detailss of Property !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_details_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_details_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_details_for_oc" name="mother_details_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_details.mother_details}}" placeholder="Enter Detailss of Property !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_details_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_details_for_oc"></span>
                                                                                </td>

                                                                            </tr>
                                                                            <tr class="p-1">
                                                                                <td><b>3</b></td>
                                                                                <td>Use to which it is put.</td>
                                                                                <td class="p-1 f-gov-job d-none">
                                                                                    <input type="text" id="father_use_to_which_for_oc" name="father_use_to_which_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_use_to_which.father_use_to_which}}" placeholder="Enter Details !"
                                                                                           onblur="checkValidation('obc-certificate', 'father_use_to_which_for_oc', fathergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-father_use_to_which_for_oc"></span>
                                                                                </td>
                                                                                <td class="p-1 m-gov-job d-none">
                                                                                    <input type="text" id="mother_use_to_which_for_oc" name="mother_use_to_which_for_oc"
                                                                                           maxlength="100" class="form-control" value="{{f_use_to_which.mother_use_to_which}}" placeholder="Enter Details !"
                                                                                           onblur="checkValidation('obc-certificate', 'mother_use_to_which_for_oc', mothergovDetailsValidationMessage);">
                                                                                    <span class="error-message error-message-obc-certificate-mother_use_to_which_for_oc"></span>
                                                                                </td>

                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- PART - G -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card collapsed-card">
                                                <div class="card-header bg-nic-blue pt-1" >
                                                    <h3 class="card-title">24. PART G - Income/ Wealth</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body border-nic-blue pt-1 part_g_div" style="display: none;">
                                                    <div class="">
                                                        <div class="p-1 flex-fill">


                                                            <div class="row">
                                                                <div class="form-group col-sm-6">
                                                                    <label>24.1. Annual Family Income from all Sources. </label><br/>
                                                                    <label>(Excluding salaries & income from agricultural land). <span class="color-nic-red">*</span></label> 
                                                                    <input type="text" id="family_annual_income" name="family_annual_income"
                                                                           class="form-control" placeholder="Enter Yearly Income !"
                                                                           value="{{obc_certificate_data.family_annual_income}}" readonly>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="form-group col-sm-6">
                                                                    <label>24.2. Weather Tax Payer(<span class="color-nic-red">*</span></label>
                                                                    <div id="tax_payer_container_for_obc_certificate"></div>
                                                                    <span class="error-message error-message-obc-certificate-tax_payer_for_obc_certificate"></span>
                                                                </div>
                                                            </div>


                                                            <div class="row mb-2 tax_payer_item_container_for_obc_certificate" style="display: none;">
                                                                <div class="col-12" id="tax_payer_copy_container_for_obc_certificate">
                                                                    <label>24.2.1. Copy of the last three years return be furnished (attahced First Page Only) <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                                                    <div class="error-message error-message-obc-certificate-tax_payer_copy_for_obc_certificate"></div>
                                                                </div>
                                                                <div class="col-sm-12" id="tax_payer_copy_name_container_for_obc_certificate" style="display: none;">
                                                                    <label>24.2.1. Copy of the last three years return be furnished (attahced First Page Only) <span style="color: red;">* </span></label><br>
                                                                    <a target="_blank" id="tax_payer_copy_download"><label id="tax_payer_copy_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                                                </div>
                                                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                                            </div>
                                                        </div> 

                                                        <div class="row">
                                                            <div class="form-group col-sm-6">
                                                                <label>24.3 Weather covered in wealth Tax Act. (<span class="color-nic-red">*</span></label>
                                                                <div id="wealth_tax_container_for_obc_certificate"></div>
                                                                <span class="error-message error-message-obc-certificate-wealth_tax_for_obc_certificate"></span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="form-group col-sm-6 wealth_tax_item_container_for_obc_certificate" style="display: none;">
                                                                <label>24.3.1. If so Furnished Details <span class="color-nic-red"></span></label>
                                                                <div class="input-group">
                                                                    <input type="text" id="furnished_detail" name="furnished_detail" class="form-control" placeholder="Enter  Furnished Details !"
                                                                           maxlength="100" value="{{obc_certificate_data.furnished_detail}}"  onblur="checkValidation('obc-certificate', 'furnished_detail', furnishedDetailValidationMessage);">
                                                                </div>
                                                                <span class="error-message error-message-obc-certificate-furnished_detail"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                    <div class="row">
                                        <div class="col-12 f-w-b">More Details</div>
                                    </div>
                                </div>
                                <div class="card-body border-nic-blue pt-1">

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>25. For What Purpose is the Certificate of OBC Required. <span class="color-nic-red">*</span></label>
                                            <input type="text" id="purpose_of_obc_certificate" name="purpose_of_obc_certificate" class="form-control" placeholder="Enter Purpose of Certificate !"
                                                   maxlength="100"value="{{obc_certificate_data.purpose_of_obc_certificate}}" onchange="checkValidation('obc-certificate', 'purpose_of_obc_certificate', purposeofobcCertificateValidationMessage);">
                                            <span class="error-message error-message-obc-certificate-purpose_of_obc_certificate"></span>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label>26. Any other Remarks<span class="color-nic-red">*</span></label>
                                            <input type="text" id="any_remarks" name="any_remarks" class="form-control" placeholder="Enter Remarks !"
                                                   maxlength="100" value="{{obc_certificate_data.any_remarks}}" onchange="checkValidation('obc-certificate', 'any_remarks', remarksValidationMessage);">
                                            <span class="error-message error-message-obc-certificate-any_remarks">
                                            </span>
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
                            <span style="color: red;font-weight: bold;">Note : Must upload pdf file with original scan documents <br></span>

                            <div class="row mb-2">
                                <div class="col-12" id="applicant_photo_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Upload Father / Mother / Guardian Photo (Latest) <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-applicant_photo_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="applicant_photo_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Upload Father / Mother / Guardian Photo (Latest) <span style="color: red;">*</span></label><br>
                                    <a target="_blank" id="applicant_photo_doc_download">
                                        <img id="applicant_photo_doc_name_image_for_obc_certificate"
                                             style="width: 250px; height: 250px; border: 2px solid blue;"
                                             class="spinner_name_container_for_obc_certificate_{{VALUE_THIRTEEN}}">
                                    </a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="minor_child_photo_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Upload Minor Child Photo (Latest) <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-minor_child_photo_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="minor_child_photo_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Upload Minor Child Photo (Latest) <span style="color: red;">*</span></label><br>
                                    <a target="_blank" id="minor_child_photo_doc_download">
                                        <img id="minor_child_photo_doc_name_image_for_obc_certificate"
                                             style="width: 250px; height: 250px; border: 2px solid blue;"
                                             class="spinner_name_container_for_obc_certificate_{{VALUE_FOURTEEN}}">
                                    </a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="self_birth_certificate_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Original Birth Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-self_birth_certificate_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="self_birth_certificate_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Original Birth Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="self_birth_certificate_doc_download"><label id="self_birth_certificate_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="father_certificate_doc_container_for_obc_certificate">
                                    <label class="father_proof_item_container_for_obc_certificate" ><span class="doc_no_for_obc_certificate"></span> Minor Child Father Original Birth Certificate / Leaving Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label>

                                    <label class="father_death_proof_item_container_for_obc_certificate" style="display:none" ><span class="doc_no_for_obc_certificate"></span> Minor Child Father Original Death Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>

                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-father_certificate_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_certificate_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label class="father_proof_item_container_for_obc_certificate" ><span class="doc_no_for_obc_certificate"></span> Minor Child Father Original Birth Certificate / Leaving Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label>

                                    <label class="father_death_proof_item_container_for_obc_certificate" style="display:none" ><span class="doc_no_for_obc_certificate"></span> Minor Child Father Original Death Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>

                                    <a target="_blank" id="father_certificate_doc_download"><label id="father_certificate_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>      

                            <div class="row mb-2">
                                <div class="col-12" id="aadhar_card_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Original Aadhaar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-aadhar_card_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="aadhar_card_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Original Aadhaar Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="aadhar_card_doc_download"><label id="aadhar_card_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2 if_father_alive_item_container_for_obc_certificate">               
                                <!--  <div class="row mb-2"> -->
                                <div class="col-12" id="father_aadhar_card_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Father Original Aadhaar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-father_aadhar_card_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_aadhar_card_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Father Original Aadhaar Card <span style="color: red;"> *</span></label><br>
                                    <a target="_blank" id="father_aadhar_card_doc_download"><label id="father_aadhar_card_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                <!--   </div> -->
                            </div>

                            <div class="row mb-2 if_mother_alive_item_container_for_obc_certificate">               
                                <!--  <div class="row mb-2"> -->
                                <div class="col-12" id="mother_aadhar_card_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Mother Original Aadhaar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-mother_aadhar_card_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="mother_aadhar_card_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Mother Original Aadhaar Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="mother_aadhar_card_doc_download"><label id="mother_aadhar_card_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_FIFTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIFTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                <!--   </div> -->
                            </div>

                            <div class="row mb-2 if_father_alive_item_container_for_obc_certificate">  
                                <div class="col-12" id="father_election_card_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Father Original Election Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-father_election_card_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_election_card_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Father Original Election Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="father_election_card_doc_download"><label id="father_election_card_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_SIXTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2 if_mother_alive_item_container_for_obc_certificate">  
                                <div class="col-12" id="mother_election_card_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Mother Original Election Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-mother_election_card_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="mother_election_card_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Mother Original Election Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="mother_election_card_doc_download"><label id="mother_election_card_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_SEVENTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVENTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label><span class="doc_no_for_obc_certificate"></span> Do You have Grand father's Birth or Property documents? <span class="color-nic-red">*</span></label>
                                    <div id="if_grandfather_having_document_container_for_obc_certificate"></div>
                                    <span class="error-message error-message-obc-certificate-if_grandfather_having_document_for_obc_certificate"></span>
                                </div>
                            </div>

                            <div class="row mb-2 if_grandfather_birth_document_item_container_for_obc_certificate" style="display: none;">
                                <div class="col-12" id="grandfather_birth_certificate_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Applicant's Grandfather Birth Certificate <span style="color: red;">* (Maximum File Size: 10MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-grandfather_birth_certificate_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="grandfather_birth_certificate_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Applicant's Grandfather Birth Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="grandfather_birth_certificate_doc_download"><label id="grandfather_birth_certificate_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div> 

                            <div class="row mb-2 if_grandfather_property_document_item_container_for_obc_certificate" style="display: none;">
                                <div class="col-12" id="grandfather_property_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Applicant's Grandfather Property Document <span style="color: red;">* (Maximum File Size: 10MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-grandfather_property_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="grandfather_property_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Applicant's Grandfather Property Document <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="grandfather_property_doc_download"><label id="grandfather_property_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="father_community_death_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Father Community Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-father_community_death_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_community_death_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Father Community Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="father_community_death_doc_download"><label id="father_community_death_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div> 

                            <div class="row mb-2">
                                <div class="col-12" id="community_certificate_doc_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Community Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-community_certificate_doc_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="community_certificate_doc_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Minor Child Community Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="community_certificate_doc_download"><label id="community_certificate_doc_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>


                            <div class="row mb-2">
                                <div class="col-12" id="income_certificate_container_for_obc_certificate">
                                    <label><span class="doc_no_for_obc_certificate"></span> Income Certificate / Salary Certificate/ Form-16 Certificate (Any One) <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-obc-certificate-income_certificate_for_obc_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="income_certificate_name_container_for_obc_certificate" style="display: none;">
                                    <label><span class="doc_no_for_obc_certificate"></span> Income Certificate / Salary Certificate/ Form-16 Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="income_certificate_download"><label id="income_certificate_name_image_for_obc_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_certificate_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                        </div>
                    </div>
                        </div>
                        <hr class="m-b-1rem">

                        <div class="card-footer p-2">
                            <button type="button" id="submit_btn_for_obc_certificate" class="btn btn-sm btn-success" onclick="ObcCertificate.listview.askForSubmitObcCertificate({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="ObcCertificate.listview.loadObcCertificateData();">Close</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>