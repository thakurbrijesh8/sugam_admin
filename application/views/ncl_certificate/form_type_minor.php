<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">NCL (OBC Renewal) Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application form for issue of  NCL (OBC Renewal) Certificate </div>
            </div>
            <form role="form" id="ncl_certificate_form" name="ncl_certificate_form" onsubmit="return false;">

                <input type="hidden" id="ncl_certificate_id" name="ncl_certificate_id" value="{{ncl_certificate_data.ncl_certificate_id}}">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-ncl-certificate f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <input type="hidden" id="constitution_artical" name="constitution_artical" value="2">
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
                                            onchange="checkValidation('ncl-certificate', 'district', selectDistrictValidationMessage); NclCertificate.listview.districtChangeEvent($(this));"
                                            data-placeholder="Select District" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-ncl-certificate-district"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>1.1 Name of Village Panchayat/D.M.C <span class="color-nic-red">*</span></label>
                                    <select id="village_name_for_nc" name="village_name" class="form-control select2"
                                            onchange="checkValidation('ncl-certificate', 'village_name_for_nc', oneOptionValidationMessage); NclCertificate.listview.villageDMCChangeEvent($(this));"
                                            data-placeholder="Select Name of Village Panchayat/D.M.C" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-ncl-certificate-village_name_for_nc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="applicant_name_for_nc_div">2. Name of Applicant <span clocass="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_name_for_nc" name="applicant_name" class="form-control" placeholder="Enter Name of Applicant !"
                                           maxlength="100" onblur="checkValidation('ncl-certificate', 'applicant_name_for_nc', applicantNameValidationMessage);" value="{{ncl_certificate_data.applicant_name}}">
                                    <span class="error-message error-message-ncl-certificate-applicant_name_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-6 guardian_div_one">
                                    <label>2.1 Applicant Relationship with Minor <span class="color-nic-red">*</span></label>
                                    <select id="relationship_of_applicant_for_nc" name="relationship_of_applicant" class="form-control select2" onchange="checkValidation('ncl-certificate', 'relationship_of_applicant_for_nc', relationWithDeceasedPersonValidationMessage);" data-placeholder="Select Relation with Deceased Person" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-ncl-certificate-relationship_of_applicant_for_nc"></span>
                                </div>
                            </div>

                            <div class="row guardian_div_two">
                                <div class="form-group col-sm-6">
                                    <label>2.2 Guardian's Address <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <textarea id="guardian_address_for_nc" name="guardian_address" class="form-control" placeholder="Enter Guardian's Address !"
                                                  maxlength="100" onblur="checkValidation('ncl-certificate', 'guardian_address_for_nc', guardianAddressValidationMessage);" >{{ncl_certificate_data.guardian_address}}</textarea>
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-guardian_address_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.3 Guardian’s Mobile Number <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="guardian_mobile_no_for_nc" name="guardian_mobile_no" class="form-control" placeholder="Enter Mobile Number !"
                                               maxlength="10" onkeyup="checkNumeric($(this));"  onblur="checkValidationForMobileNumber('ncl-certificate', 'guardian_mobile_no_for_nc', mobileValidationMessage);" value="{{ncl_certificate_data.guardian_mobile_no}}">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-guardian_mobile_no_for_nc"></span>
                                </div>
                            </div>
                            <div class="row guardian_div_three">
                                <div class="form-group col-sm-6">
                                    <label>2.4 Guardian’s Aadhaar Number<span class="color-nic-red">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="guardian_aadhaar_for_nc" name="guardian_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                               maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('ncl-certificate', 'guardian_aadhaar_for_nc', invalidAadharNumberValidationMessage);" value="{{ncl_certificate_data.guardian_aadhaar}}">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-guardian_aadhaar_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.5 Name of Minor Child<span class="color-nic-red">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="minor_child_name_for_nc" name="minor_child_name" class="form-control" placeholder="Enter Name of Minor Child"
                                               maxlength="50" onblur="checkValidation('ncl-certificate', 'minor_child_name_for_nc', minorChildNameValidationMessage);" value="{{ncl_certificate_data.minor_child_name}}">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-minor_child_name_for_nc"></span>
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
                                                    <input type="text" id="com_addr_house_no_for_nc" name="com_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="50" value="{{ncl_certificate_data.com_addr_house_no}}" onblur="checkValidation('ncl-certificate', 'com_addr_house_no_for_nc', houseNoValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-com_addr_house_no_for_nc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.2 Building Name / House Name</label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_house_name_for_nc" name="com_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="50" value="{{ncl_certificate_data.com_addr_house_name}}">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-com_addr_house_name_for_nc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>3.3 Street <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_street_for_nc" name="com_addr_street" class="form-control" placeholder="Enter Street !"
                                                           maxlength="50" onblur="checkValidation('ncl-certificate', 'com_addr_street_for_nc', streetValidationMessage);" value="{{ncl_certificate_data.com_addr_street}}">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-com_addr_street_for_nc"></span>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label>3.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_village_dmc_ward_for_nc" name="com_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                           maxlength="50" onblur="checkValidation('ncl-certificate', 'com_addr_village_dmc_ward_for_nc', villageNameValidationMessage);" value="{{ncl_certificate_data.com_addr_village_dmc_ward}}" readonly="">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-com_addr_village_dmc_ward_for_nc"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>3.5 Select City<span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_city_for_nc" name="com_addr_city" class="form-control" placeholder="Enter City !"
                                                           maxlength="50" onblur="checkValidation('ncl-certificate', 'com_addr_city_for_nc', selectCityValidationMessage);" onchange="NclCertificate.listview.getPincode($(this));" value="{{ncl_certificate_data.com_addr_city}}" readonly="">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-com_addr_city_for_nc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.6 Pincode <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_pincode_for_nc" name="com_pincode" class="form-control" placeholder="Enter Pincode !"
                                                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('ncl-certificate', 'com_pincode_for_nc', pincodeValidationMessage);" value="{{ncl_certificate_data.com_pincode}}">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-com_pincode_for_nc"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body pt-1" style="background-color: aliceblue;">

                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label>Same as Communication Address</label>&nbsp;
                                                <input type="checkbox" id="billingtoo_for_nc" name="billingtoo" class="checkbox" value="{{is_checked}}"  onchange="NclCertificate.listview.FillBilling($(this));">
                                                <span class="error-message error-message-ncl-certificate-billingtoo"></span><br>
                                                <label>4. Applicant’s Permanent Address</label><hr> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_house_no_for_nc" name="per_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="50" value="{{ncl_certificate_data.per_addr_house_no}}" onblur="checkValidation('ncl-certificate', 'per_addr_house_no_for_nc', houseNoValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-per_addr_house_no_for_nc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.2 Building Name / House Name</label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_house_name_for_nc" name="per_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="50" value="{{ncl_certificate_data.per_addr_house_name}}">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-per_addr_house_name_for_nc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.3 Street <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_street_for_nc" name="per_addr_street" class="form-control" placeholder="Enter Street !"
                                                           maxlength="50" onblur="checkValidation('ncl-certificate', 'per_addr_street_for_nc', streetValidationMessage);" value="{{ncl_certificate_data.per_addr_street}}">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-per_addr_street_for_nc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_village_dmc_ward_for_nc" name="per_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                           maxlength="50" onblur="checkValidation('ncl-certificate', 'per_addr_village_dmc_ward_for_nc', villageNameValidationMessage);" value="{{ncl_certificate_data.per_addr_village_dmc_ward}}" >
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-per_addr_village_dmc_ward_for_nc"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.5 Select City<span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_city_for_nc" name="per_addr_city" class="form-control" placeholder="Enter City !"
                                                           maxlength="50" onblur="checkValidation('ncl-certificate', 'per_addr_city_for_nc', selectCityValidationMessage);" onchange="NclCertificate.listview.getPincode($(this));" value="{{ncl_certificate_data.per_addr_city}}" >
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-per_addr_city_for_nc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.6 Pincode <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_pincode_for_nc" name="per_pincode" class="form-control" placeholder="Enter Pincode !"
                                                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('ncl-certificate', 'per_pincode_for_nc', pincodeValidationMessage);" value="{{ncl_certificate_data.per_pincode}}">
                                                </div>
                                                <span class="error-message error-message-ncl-certificate-per_pincode_for_nc"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>5. Minor Applicant's Aadhaar Number</label>
                                    <div class="input-group">
                                        <input type="text" id="aadhaar_for_nc" name="aadhaar"
                                               class="form-control" placeholder="Enter Aadhaar Number !"
                                               maxlength="12" value="{{ncl_certificate_data.aadhaar}}">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-aadhaar_for_nc"></span>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>6.  Date of Birth<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applicant_dob" id="applicant_dob_for_nc" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value=""
                                               onblur="checkValidation('ncl-certificate', 'applicant_dob_for_nc', birthDateValidationMessage); calculateAge('for_nc');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-applicant_dob_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>6.1 Minor Age<span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_age_for_nc" 
                                           name="applicant_age" class="form-control"
                                           placeholder="Enter Minor Age !" maxlength="3" 
                                           onblur="checkValidation('ncl-certificate', 'applicant_age_for_nc', applicantAgeValidationMessage);"
                                           value="{{ncl_certificate_data.applicant_age}}" readonly="">
                                    <span class="error-message error-message-ncl-certificate-applicant_age_for_nc"></span>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>7.  Minor Nationality <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_nationality_for_nc" name="applicant_nationality" class="form-control" placeholder="Enter Minor Nationality!"
                                           maxlength="50" onblur="checkValidation('ncl-certificate', 'applicant_nationality_for_nc', applicantNationalityValidationMessage);" value="{{ncl_certificate_data.applicant_nationality}}">
                                    <span class="error-message error-message-ncl-certificate-applicant_nationality_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>8. Minor Education <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_education_for_nc" name="applicant_education" class="form-control" placeholder="Enter Minor Education!"
                                           maxlength="50" onblur="checkValidation('ncl-certificate', 'applicant_education_for_nc', applicantNationalityValidationMessage);" value="{{ncl_certificate_data.applicant_education}}">
                                    <span class="error-message error-message-ncl-certificate-applicant_education_for_nc"></span>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>9. Minor Birth Place<span class="color-nic-red">*</span></label><br/>
                                    <label>9.1 State <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="born_place_state_for_nc" name="born_place_state" class="form-control select2"
                                                data-placeholder="Select State/UT"
                                                onchange="checkValidation('nc', 'born_place_state_for_nc', selectStateValidationMessage);
                                                    NclCertificate.listview.getDistrictData($(this), 'nc', 'born_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-born_place_state_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>9.2 District <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="born_place_district_for_nc" name="born_place_district" class="form-control select2"
                                                data-placeholder="Select District"
                                                onchange="checkValidation('nc', 'born_place_district_for_nc', selectDistrictValidationMessage);
                                                    NclCertificate.listview.getVillageData($(this), 'nc', 'born_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-born_place_district_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>9.3 Village <span class="color-nic-red">*</span></label>
                                    <!--<div class="input-group">-->
                                    <select id="born_place_village_for_nc" name="born_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('nc', 'born_place_village_for_nc', selectVillageValidationMessage);">
                                    </select>
                                    <!--</div>-->
                                    <span class="error-message error-message-ncl-certificate-born_place_village_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>9.4 Pincode <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="born_place_pincode_for_nc" name="born_place_pincode" class="form-control" placeholder="Enter Pincode !"
                                               maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('ncl-certificate', 'born_place_pincode_for_nc', pincodeValidationMessage);" value="{{ncl_certificate_data.born_place_pincode}}">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-born_place_pincode_for_nc"></span>
                                </div>
                            </div> 


                            <div class="row">
                                <div class="form-group col-sm-3 col-md-3">
                                    <label>13. Original Native of<span class="color-nic-red">*</span></label><br/>
                                    <label>13.1 State <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="native_place_state_for_nc" name="native_place_state" class="form-control select2"
                                                data-placeholder="Select State/UT"
                                                onchange="checkValidation('nc', 'native_place_state_for_nc', selectStateValidationMessage);
                                                    NclCertificate.listview.getDistrictFornDataForNative($(this), 'native_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-native_place_state_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>13.2 District <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="native_place_district_for_nc" name="native_place_district" class="form-control select2"
                                                data-placeholder="Select District"
                                                onchange="checkValidation('nc', 'native_place_district_for_nc', selectDistrictValidationMessage);
                                                    NclCertificate.listview.getVillageDataForNative($(this), 'native_place');">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-native_place_district_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>13.3 Village <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="native_place_village_for_nc" name="native_place_village" class="form-control select2"
                                                data-placeholder="Select Village" onchange="checkValidation('nc', 'native_place_village_for_nc', selectVillageValidationMessage);">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-native_place_village_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                    <label>13.4 Pincode <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="native_place_pincode_for_nc" name="native_place_pincode" class="form-control" placeholder="Enter Pincode !"
                                               maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('ncl-certificate', 'native_place_pincode_for_nc', pincodeValidationMessage);" value="{{ncl_certificate_data.native_place_pincode}}">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-native_place_pincode_for_nc"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>11. Gender<span class="color-nic-red">*</span></label>
                                    <div id="gender_container_for_nc"></div>
                                    <span class="error-message error-message-ncl-certificate-gender_for_nc"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>12. Select Applicant Religion.<span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <select id="religion_for_nc" name="religion" class="form-control select2" onchange="checkValidation('ncl-certificate', 'religion_for_nc', selectanyoneValidationMessage); showOtherReligionOfNCLtext(this, 'other_religion', 'ncl_certificate');"  data-placeholder="Select Religion" style="width: 100%;">
                                        </select>
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-religion_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-6" id="other_religion_for_ncl_certificate" style="display: none;">
                                    <label>12.1 Applicant Other Religion.<span class="color-nic-red">*</span></label>
                                    <div clas="input-group">
                                        <input type="text" id="other_religion_for_nc" name="other_religion" class="form-control" onchange="checkValidation('ncl-certificate', 'other_religion_for_nc', religionValidationMessage);" placeholder="Enter Other Religion !" maxlength="100" value="{{ncl_certificate_data.other_religion}}">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-other_religion_for_nc"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>13. Select Cast. <span class="color-nic-red">*</span></label>
                                    <select id="obccaste_for_nc" name="obccaste" class="form-control select2" onchange="checkValidation('ncl-certificate', 'obccaste_for_nc', castesValidationMessage);" data-placeholder="Select Caste" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-ncl-certificate-obccaste_for_nc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>14. Nearest Police Station. <span class="color-nic-red">*</span></label>
                                    <select id="nearest_police_station_for_nc" name="nearest_police_station" class="form-control select2" data-placeholder="Select Police Station Area" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-ncl-certificate-nearest_police_station_for_nc"></span>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="card" style="background-color: #F8F8F8;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    20, 21. Please Give Details 
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue ">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-ncl-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="card" style="background-color: #F8F8F8;">
                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                    <div class="row">
                                        <div class="col-12 f-w-b">
                                            20.(a) Father Details 
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-nic-blue ">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <span class="error-message error-message-ncl-certificate-mi f-w-b"
                                                  style="border-bottom: 2px solid red;"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-4">
                                            <label>1. Father Name <span class="color-nic-red">*</span></label>
                                            <input type="text" id="father_name_for_ncl_certificate" name="father_name_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.father_name}}" placeholder="Enter Father Name !"
                                                   onblur="checkValidation('ncl-certificate', 'father_name_for_ncl_certificate', fathergovDetailsValidationMessage);">
                                            <span class="error-message error-message-ncl-certificate-father_name_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4">
                                            <label>2. Type of Org. (Govt/Pvt) Profession/Trae/Business/Agriculture <span class="color-nic-red">*</span></label>
                                            <input type="text" id="father_organization_type_for_ncl_certificate" name="father_organization_type_for_ncl_certificate" organization_type="father_organization_type_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.father_organization_type}}" placeholder="Type of Organization !"
                                                   onblur="checkValidation('ncl-certificate', 'father_organization_type_for_ncl_certificate', fathergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-father_organization_type_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4">
                                            <label>3. Name of Organization/ Department <span class="color-nic-red">*</span></label>
                                            <input type="text" id="father_organization_name_for_ncl_certificate"  name="father_organization_name_for_ncl_certificate" organization_name="father_organization_name_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.father_organization_name}}" placeholder="Name of Organization !"
                                                   onblur="checkValidation('ncl-certificate', 'father_organization_name_for_ncl_certificate', fathergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-father_organization_name_for_ncl_certificate"></span>
                                        </div>  
                                        <div class="form-group col-sm-6 col-md-3">
                                            <label>4. Designation/Post Held <span class="color-nic-red">*</span></label>
                                            <input type="text" id="father_designation_for_ncl_certificate" name="father_designation_for_ncl_certificate" designation="father_designation_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.father_designation}}" placeholder="Enter Designation !"
                                                   onblur="checkValidation('ncl-certificate', 'father_designation_for_ncl_certificate', fathergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-father_designation_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>5. Scale of Pay <span class="color-nic-red">*</span> </label>
                                            <input type="text" id="father_scale_pay_for_ncl_certificate"  name="father_scale_pay_for_ncl_certificate" scale_pay="father_scale_pay_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.father_scale_pay}}" placeholder="Enter Scale of Pay !"
                                                   onblur="checkValidation('ncl-certificate', 'father_scale_pay_for_ncl_certificate', fathergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-father_scale_pay_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>6. Date of Appointment <span class="color-nic-red">*</span></label>
                                            <input type="text" id="father_appointment_date_for_ncl_certificate" name="father_appointment_date_for_ncl_certificate" appointment_date="father_appointment_date_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.father_appointment_date}}" placeholder="Date of Appointment !"
                                                   onblur="checkValidation('ncl-certificate', 'father_appointment_date_for_ncl_certificate', fathergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-father_appointment_date_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>7. Occupation <span class="color-nic-red">*</span></label>
                                            <select id="father_occupation_for_nc" name="father_occupation_for_nc" class="form-control select2" onchange="checkValidation('ncl-certificate', 'father_occupation_for_nc', applicantOccupationValidationMessage); showOtherapplicantOccupationtext(this, 'father_other_occupation_text', 'nc');"  data-placeholder="Select Occupation" style="width: 100%;" >


                                            </select>
                                            <span class="error-message error-message-ncl-certificate-father_occupation_for_nc"></span>

                                            <input type="text" id="father_other_occupation_text_for_nc" name="father_other_occupation_text_for_nc"
                                                   maxlength="50" class="form-control" value="{{ncl_certificate_data.father_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('ncl-certificate', 'father_other_occupation_text_for_nc', otherOccupationValidationMessage);"
                                                   style="display: none;">
                                            <span class="error-message error-message-ncl-certificate-father_other_occupation_text_for_nc"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>8. Gross annual Salary / Amount <span class="color-nic-red">*</span></label>
                                            <input type="text" id="father_annual_salary_for_nc" name="father_annual_salary_for_nc"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.father_annual_salary}}" placeholder="Enter Annual Salary !" onkeyup="checkNumeric($(this));"
                                                   onblur="NclCertificate.listview.getYearlyIncomeTotalofFather(); NclCertificate.listview.getYearlyIncomeTotalofAll(); checkValidation('ncl-certificate', 'father_annual_salary_for_nc', fathergovDetailsValidationMessage);">
                                            <span class="error-message error-message-ncl-certificate-father_annual_salary_for_nc"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>9. Income From other sources <span class="color-nic-red">*</span></label>
                                            <input type="text" id="father_other_income_sources_for_nc" name="father_other_income_sources_for_nc"
                                                   maxlength="100" class="form-control"  value="{{ncl_certificate_data.father_other_income_sources}}" placeholder="Enter Other Income !" onkeyup="checkNumeric($(this));"
                                                   onblur="NclCertificate.listview.getYearlyIncomeTotalofFather(); NclCertificate.listview.getYearlyIncomeTotalofAll(); checkValidation('ncl-certificate', 'father_other_income_sources_for_nc', fathergovDetailsValidationMessage);">
                                            <span class="error-message error-message-ncl-certificate-father_other_income_sources_for_nc"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>10. Total</label>
                                            <input type="text" id="father_total_for_nc" name="father_total_for_nc"
                                                   class="form-control" placeholder="Enter Total Income !"
                                                   onblur="NclCertificate.listview.getYearlyIncomeTotalofAll();" readonly>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>11. Remarks <span class="color-nic-red">*</span></label>
                                            <input type="text" id="father_remarks_for_ncl_certificate" name="father_remarks_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.father_remarks}}" placeholder="Enter Remarks !"
                                                   onblur="checkValidation('ncl-certificate', 'father_remarks_for_ncl_certificate', fathergovDetailsValidationMessage);">
                                            <span class="error-message error-message-ncl-certificate-father_remarks_for_ncl_certificate"></span>
                                        </div>  
                                    </div>
                                </div>
                            </div>

                            <div class="card" style="background-color: #F8F8F8;">
                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                    <div class="row">
                                        <div class="col-12 f-w-b">
                                            20.(b) Mother Details 
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-nic-blue ">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <span class="error-message error-message-ncl-certificate-mi f-w-b"
                                                  style="border-bottom: 2px solid red;"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-4">
                                            <label>1. Mother Name <span class="color-nic-red">*</span></label>
                                            <input type="text" id="mother_name_for_ncl_certificate" name="mother_name_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_name}}" placeholder="Enter Mother Name !"
                                                   onblur="checkValidation('ncl-certificate', 'mother_name_for_ncl_certificate', mothergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-mother_name_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4">
                                            <label>2. Type of Org. (Govt/Pvt) Profession/Trae/Business/Agriculture <span class="color-nic-red">*</span></label>
                                            <input type="text" id="mother_organization_type_for_ncl_certificate" name="mother_organization_type_for_ncl_certificate" organization_type="mother_organization_type_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_organization_type}}" placeholder="Type of Organization !"
                                                   onblur="checkValidation('ncl-certificate', 'mother_organization_type_for_ncl_certificate', mothergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-mother_organization_type_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4">
                                            <label>3. Name of Organization/ Department <span class="color-nic-red">*</span></label>
                                            <input type="text" id="mother_organization_name_for_ncl_certificate" name="mother_organization_name_for_ncl_certificate" organization_name="mother_organization_name_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_organization_name}}" placeholder="Name of Organization !"
                                                   onblur="checkValidation('ncl-certificate', 'mother_organization_name_for_ncl_certificate', mothergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-mother_organization_name_for_ncl_certificate"></span>
                                        </div>  
                                        <div class="form-group col-sm-6 col-md-3">
                                            <label>4. Designation/Post Held <span class="color-nic-red">*</span></label>
                                            <input type="text" id="mother_designation_for_ncl_certificate" name="mother_designation_for_ncl_certificate" designation="mother_designation_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_designation}}" placeholder="Enter Designation !"
                                                   onblur="checkValidation('ncl-certificate', 'mother_designation_for_ncl_certificate', mothergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-mother_designation_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>5. Scale of Pay <span class="color-nic-red">*</span></label>
                                            <input type="text" id="mother_scale_pay_for_ncl_certificate" name="mother_scale_pay_for_ncl_certificate" scale_pay="mother_scale_pay_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_scale_pay}}" placeholder="Enter Scale of Pay !"
                                                   onblur="checkValidation('ncl-certificate', 'mother_scale_pay_for_ncl_certificate', mothergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-mother_scale_pay_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>6. Date of Appointment <span class="color-nic-red">*</span></label>
                                            <input type="text" id="mother_appointment_date_for_ncl_certificate" name="mother_appointment_date_for_ncl_certificate" appointment_date="mother_appointment_date_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_appointment_date}}" placeholder="Date of Appointment !"
                                                   onblur="checkValidation('ncl-certificate', 'mother_appointment_date_for_ncl_certificate', mothergovDetailsValidationMessage);">

                                            <span class="error-message error-message-ncl-certificate-mother_appointment_date_for_ncl_certificate"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>7. Occupation <span class="color-nic-red">*</span></label>
                                            <select id="mother_occupation_for_nc" name="mother_occupation_for_nc" class="form-control select2" onchange="checkValidation('ncl-certificate', 'mother_occupation_for_nc', applicantOccupationValidationMessage); showOtherapplicantOccupationtext(this, 'mother_other_occupation_text', 'nc');"  data-placeholder="Select Occupation" style="width: 100%;">
                                            </select>
                                            <span class="error-message error-message-ncl-certificate-mother_occupation_for_nc"></span>

                                            <input type="text" id="mother_other_occupation_text_for_nc" name="mother_other_occupation_text_for_nc"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('ncl-certificate', 'mother_other_occupation_text_for_nc', otherOccupationValidationMessage);"
                                                   style="display: none;">
                                            <span class="error-message error-message-ncl-certificate-mother_other_occupation_text_for_nc"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>8. Gross annual Salary / Amount <span class="color-nic-red">*</span></label>
                                            <input type="text" id="mother_annual_salary_for_nc" name="mother_annual_salary_for_nc"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_annual_salary}}" placeholder="Enter Annual Salary !" onkeyup="checkNumeric($(this));"
                                                   onblur="NclCertificate.listview.getYearlyIncomeTotalofMother(); NclCertificate.listview.getYearlyIncomeTotalofAll(); checkValidation('ncl-certificate', 'mother_annual_salary_for_nc', mothergovDetailsValidationMessage);">
                                            <span class="error-message error-message-ncl-certificate-mother_annual_salary_for_nc"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>9. Income From other sources <span class="color-nic-red">*</span></label>
                                            <input type="text" id="mother_other_income_sources_for_nc" name="mother_other_income_sources_for_nc"
                                                   maxlength="100" class="form-control"  value="{{ncl_certificate_data.mother_other_income_sources}}" placeholder="Enter Other Income !"  onkeyup="checkNumeric($(this));"
                                                   onblur="NclCertificate.listview.getYearlyIncomeTotalofMother(); NclCertificate.listview.getYearlyIncomeTotalofAll(); checkValidation('ncl-certificate', 'mother_other_income_sources_for_nc', mothergovDetailsValidationMessage);">
                                            <span class="error-message error-message-ncl-certificate-mother_other_income_sources_for_nc"></span>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>10. Total</label>
                                            <input type="text" id="mother_total_for_nc" name="mother_total_for_nc"
                                                   class="form-control" placeholder="Enter Total Income !"
                                                   onblur="NclCertificate.listview.getYearlyIncomeTotalofAll();" readonly>
                                        </div>
                                        <div class="form-group col-sm-4 col-md-3">
                                            <label>11. Remarks <span class="color-nic-red">*</span></label>
                                            <input type="text" id="mother_remarks_for_ncl_certificate" name="mother_remarks_for_ncl_certificate"
                                                   maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_remarks}}" placeholder="Enter Remarks !"
                                                   onblur="checkValidation('ncl-certificate', 'mother_remarks_for_ncl_certificate', mothergovDetailsValidationMessage);">
                                            <span class="error-message error-message-ncl-certificate-mother_remarks_for_ncl_certificate"></span>
                                        </div>  
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                    <label>Total Family Income</label>
                                    <input type="text" id="family_annual_income_for_nc" name="family_annual_income_for_nc"
                                           class="form-control" placeholder="Enter Yearly Income !"
                                           readonly>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="card" style="background-color: #F8F8F8;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    22.(a) Please Give Details of Members.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-ncl-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 150px;">Relation With Applicant</th>
                                            <th class="p-1" style="min-width: 150px;">Father</th>
                                            <th class="p-1" style="min-width: 150px;">Mother</th>
                                            <th class="p-1" style="min-width: 150px;">Minor Child</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr class="p-1">
                                            <td><b>1</b></td>
                                            <td>Agriculture land holding</td>
                                            <td>
                                                <input type="text" id="father_land_for_ncl_certificate" name="father_land_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.father_land}}" placeholder="Enter Agriculture land !"
                                                       onblur="checkValidation('ncl-certificate', 'father_land_for_ncl_certificate', fathergovDetailsValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-father_land_for_ncl_certificate"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="mother_land_for_ncl_certificate" name="mother_land_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_land}}" placeholder="Enter Agriculture land !"
                                                       onblur="checkValidation('ncl-certificate', 'mother_land_for_ncl_certificate', mothergovDetailsValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-mother_land_for_ncl_certificate"></span>
                                            </td>

                                            <td>
                                                <input type="text" id="minorchild_land_for_ncl_certificate" name="minorchild_land_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.minorchild_land}}" placeholder="Enter Agriculture land !"
                                                       onblur="checkValidation('ncl-certificate', 'minorchild_land_for_ncl_certificate', minorDetailValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-minorchild_land_for_ncl_certificate"></span>
                                            </td>
                                        </tr>
                                        <tr class="p-1">
                                            <td><b>2</b></td>
                                            <td>Location</td>
                                            <td>
                                                <input type="text" id="father_location_for_ncl_certificate" name="father_location_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.father_location}}" placeholder="Enter Location !"
                                                       onblur="checkValidation('ncl-certificate', 'father_location_for_ncl_certificate', fathergovDetailsValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-father_location_for_ncl_certificate"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="mother_location_for_ncl_certificate" name="mother_location_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_location}}" placeholder="Enter Location !"
                                                       onblur="checkValidation('ncl-certificate', 'mother_location_for_ncl_certificate', mothergovDetailsValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-mother_location_for_ncl_certificate"></span>
                                            </td>

                                            <td>
                                                <input type="text" id="minorchild_location_for_ncl_certificate" name="minorchild_location_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.minorchild_location}}" placeholder="Enter Location !"
                                                       onblur="checkValidation('ncl-certificate', 'minorchild_location_for_ncl_certificate', minorDetailValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-minorchild_location_for_ncl_certificate"></span>
                                            </td>
                                        </tr>
                                        <tr class="p-1">
                                            <td><b>3</b></td>
                                            <td>Size of holding</td>
                                            <td>
                                                <input type="text" id="father_sizeofholding_for_ncl_certificate" name="father_sizeofholding_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.father_sizeofholding}}" placeholder="Enter Size of holding !"
                                                       onblur="checkValidation('ncl-certificate', 'father_sizeofholding_for_ncl_certificate', fathergovDetailsValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-father_sizeofholding_for_ncl_certificate"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="mother_sizeofholding_for_ncl_certificate" name="mother_sizeofholding_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_sizeofholding}}" placeholder="Enter Size of holding !"
                                                       onblur="checkValidation('ncl-certificate', 'mother_sizeofholding_for_ncl_certificate', mothergovDetailsValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-mother_sizeofholding_for_ncl_certificate"></span>
                                            </td>

                                            <td>
                                                <input type="text" id="minorchild_sizeofholding_for_ncl_certificate" name="minorchild_sizeofholding_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.minorchild_sizeofholding}}" placeholder="Enter Size of holding !"
                                                       onblur="checkValidation('ncl-certificate', 'minorchild_sizeofholding_for_ncl_certificate', minorDetailValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-minorchild_sizeofholding_for_ncl_certificate"></span>
                                            </td>

                                        </tr>
                                        <tr class="p-1">
                                            <td><b>4</b></td>
                                            <td>Type of irrigated Land</td>
                                            <td>
                                                <input type="text" id="father_typeofirrigated_for_ncl_certificate" name="father_typeofirrigated_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.father_typeofirrigated}}" placeholder="Type of irrigated !"
                                                       onblur="checkValidation('ncl-certificate', 'father_typeofirrigated_for_ncl_certificate', fathergovDetailsValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-father_typeofirrigated_for_ncl_certificate"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="mother_typeofirrigated_for_ncl_certificate" name="mother_typeofirrigated_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.mother_typeofirrigated}}" placeholder="Type of irrigated !"
                                                       onblur="checkValidation('ncl-certificate', 'mother_typeofirrigated_for_ncl_certificate', mothergovDetailsValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-mother_typeofirrigated_for_ncl_certificate"></span>
                                            </td>

                                            <td>
                                                <input type="text" id="minorchild_typeofirrigated_for_ncl_certificate" name="minorchild_typeofirrigated_for_ncl_certificate"
                                                       maxlength="100" class="form-control" value="{{ncl_certificate_data.minorchild_typeofirrigated}}" placeholder="Type of irrigated !"
                                                       onblur="checkValidation('ncl-certificate', 'minorchild_typeofirrigated_for_ncl_certificate', minorDetailValidationMessage);">
                                                <span class="error-message error-message-ncl-certificate-minorchild_typeofirrigated_for_ncl_certificate"></span>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>

                    <div class="card" style="background-color: #F8F8F8;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">More Details</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label>23. Percentage of irrigated land holding to statutory ceiling limit under state and ceiling laws.<span class="color-nic-red">*</span></label>
                                    <input type="text" id="percentageofland_for_ncl" name="percentageofland" class="form-control" placeholder="Enter  Percentage of irrigated land !"
                                           maxlength="100" onblur="checkValidation('ncl-certificate', 'percentageofland_for_ncl', percentageofirrigatedlandValidationMessage);" value="{{ncl_certificate_data.percentageofland}}">

                                    <span class="error-message error-message-ncl-certificate-percentageofland_for_ncl"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label>24. If land holding is both irrigated and un-irrigated land holding on the basis of conversion formula in state land ceiling law. </label>
                                    <input type="text" id="landceiling_for_ncl" name="landceiling"
                                           class="form-control" placeholder="Enter land holding is both irrigated and un-irrigated !"  maxlength="100" onblur="checkValidation('ncl-certificate', 'landceiling_for_ncl', irrigatedandunirrigatedlandValidationMessage);"
                                           value="{{ncl_certificate_data.landceiling}}">
                                    <span class="error-message error-message-ncl-certificate-landceiling_for_ncl"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label>25. Percentage of total irrigated land holding to statutory ceiling limit as Per(V)<span class="color-nic-red">*</span></label>
                                    <input type="text" id="landceilinglimit_for_ncl" name="landceilinglimit" class="form-control" placeholder="Enter Percentage of total irrigated land !"
                                           maxlength="100"  onblur="checkValidation('ncl-certificate', 'landceilinglimit_for_ncl', percentageoftotalirrigatedlandValidationMessage);" 
                                           value="{{ncl_certificate_data.landceilinglimit}}">
                                    <span class="error-message error-message-ncl-certificate-landceilinglimit_for_ncl"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card" style="background-color: #F8F8F8;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    26.(a) Plantation : 
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-ncl-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>a. Crops / Fruit <span class="color-nic-red">*</span></label>
                                    <input type="text" id="cropsfruit_for_ncl_certificate" name="cropsfruit_for_ncl_certificate"
                                           maxlength="100" class="form-control" value="{{ncl_certificate_data.cropsfruit}}" placeholder="Enter Crops / Fruit  Detail !">
                                    <span class="error-message error-message-ncl-certificate-cropsfruit_for_ncl_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>b. Location <span class="color-nic-red">*</span></label>
                                    <input type="text" id="location_for_ncl_certificate" name="location_for_ncl_certificate"
                                           maxlength="100" class="form-control" value="{{ncl_certificate_data.location}}" placeholder="Enter Location !">
                                    <span class="error-message error-message-ncl-certificate-location_for_ncl_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>c. Area of Plantation <span class="color-nic-red">*</span></label>
                                    <input type="text" id="areaofplantation_for_ncl_certificate" name="areaofplantation_for_ncl_certificate"
                                           maxlength="100" class="form-control" value="{{ncl_certificate_data.areaofplantation}}" placeholder="Enter Area of Plantation !">
                                    <span class="error-message error-message-ncl-certificate-areaofplantation_for_ncl_certificate"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="background-color: #F8F8F8;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    27.(a) Vacant land and/or building in urban areas or urban agglomeration : 
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-ncl-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>a. Location of Property <span class="color-nic-red">*</span></label>
                                    <input type="text" id="locationpoperty_for_ncl_certificate" name="locationpoperty_for_ncl_certificate"
                                           maxlength="100" class="form-control" value="{{ncl_certificate_data.locationpoperty}}" placeholder="Enter Location of Property !">
                                    <span class="error-message error-message-ncl-certificate-locationpoperty_for_ncl_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>b. Details of Property <span class="color-nic-red">*</span></label>
                                    <input type="text" id="detailproperty_for_ncl_certificate" name="detailproperty_for_ncl_certificate"
                                           maxlength="100" class="form-control" value="{{ncl_certificate_data.detailproperty}}" placeholder="Enter Details of Property !">
                                    <span class="error-message error-message-ncl-certificate-detailproperty_for_ncl_certificate"></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>c. Use to which it is put <span class="color-nic-red">*</span></label>
                                    <input type="text" id="usetowhich_for_ncl_certificate" name="usetowhich_for_ncl_certificate"
                                           maxlength="100" class="form-control" value="{{ncl_certificate_data.usetowhich}}" placeholder="Enter Use to which it is put !">
                                    <span class="error-message error-message-ncl-certificate-usetowhich_for_ncl_certificate"></span>
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
                                    <label>28.1. Weather Tax Payer(<span class="color-nic-red">*</span></label>

                                    <div id="tax_payer_container_for_ncl_certificate"></div>
                                    <span class="error-message error-message-ncl-certificate-tax_payer_for_ncl_certificate"></span>
                                </div>
                            </div>
                            <!--    </div> -->


                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>28.2. Weather covered in wealth Tax Act. (<span class="color-nic-red">*</span></label>
                                    <div id="wealth_tax_container_for_ncl_certificate"></div>
                                    <span class="error-message error-message-ncl-certificate-wealth_tax_for_ncl_certificate"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-6 wealth_tax_item_container_for_ncl_certificate" style="display: none;">
                                    <label>28.3.1. If so Furnished Details <span class="color-nic-red"></span></label>
                                    <div class="input-group">
                                        <input type="text" id="furnished_detail" name="furnished_detail" class="form-control" placeholder="Enter  Furnished Details !"
                                               maxlength="100" value="{{ncl_certificate_data.furnished_detail}}"  onblur="checkValidation('ncl-certificate', 'furnished_detail', furnishedDetailValidationMessage);">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-furnished_detail"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6 ">
                                    <label>29. Applicant First OBC Certificate No.<span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="obc_certificate_no" name="obc_certificate_no" class="form-control"  placeholder="Applicant First OBC Certificate No. !" maxlength="100" value="{{ncl_certificate_data.obc_certificate_no}}">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-obc_certificate_no"></span>
                                </div>
                                <div class="form-group col-sm-6 ">
                                    <label>30. Income Certificate No.<span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="income_certificate_no" name="income_certificate_no" class="form-control"  placeholder="Applicant First Income Certificate No. !" maxlength="100" value="{{ncl_certificate_data.income_certificate_no}}">
                                    </div>
                                    <span class="error-message error-message-ncl-certificate-income_certificate_no"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6 ">
                                    <label>29. Applicant First OBC Certificate Date<span class="color-nic-red">*</span></label>
                                    <div class="input-group date date_picker">
                                        <input type="text" class="form-control date_picker" name="obc_certificate_date" id="obc_certificate_date" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY"
                                               value="{{obc_certificate_date}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-construction-obc_certificate_date"></span>
                                </div>
                                <div class="form-group col-sm-6 ">
                                    <label>30. Income Certificate Date<span class="color-nic-red">*</span></label>
                                    <div class="input-group date date_picker">
                                        <input type="text" class="form-control date_picker" name="income_certificate_date" id="income_certificate_date" data-date-format="DD-MM-YYYY" placeholder="DD-MM-YYYY"
                                               value="{{income_certificate_date}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-construction-income_certificate_date"></span>
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
                                <div class="col-12" id="parents_photo_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Upload Father / Mother / Guardian Photo. <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-parents_photo_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="parents_photo_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Upload Father / Mother / Guardian Photo. <span style="color: red;">*</span></label><br>
                                    <a target="_blank" id="parents_photo_doc_download">
                                        <img id="parents_photo_doc_name_image_for_ncl_certificate"
                                             style="width: 250px; height: 250px; border: 2px solid blue;"
                                             class="spinner_name_container_for_ncl_certificate_{{VALUE_NINE}}">
                                    </a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12" id="applicant_photo_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Upload Minor Child Photo. <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-applicant_photo_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="applicant_photo_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Upload Minor Child Photo. <span style="color: red;">*</span></label><br>
                                    <a target="_blank" id="applicant_photo_doc_download">
                                        <img id="applicant_photo_doc_name_image_for_ncl_certificate"
                                             style="width: 250px; height: 250px; border: 2px solid blue;"
                                             class="spinner_name_container_for_ncl_certificate_{{VALUE_SEVEN}}">
                                    </a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div> 

                            <div class="row mb-2 tax_payer_item_container_for_ncl_certificate" style="display: none;">
                                <div class="col-12" id="tax_payer_copy_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Copy of the last three years return be furnished (attahced First Page Only) <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-tax_payer_copy_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="tax_payer_copy_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Copy of the last three years return be furnished (attahced First Page Only) <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="tax_payer_copy_download"><label id="tax_payer_copy_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_ONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>



                            <div class="row mb-2">
                                <div class="col-12" id="self_birth_certificate_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Birth Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-self_birth_certificate_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="self_birth_certificate_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Birth Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="self_birth_certificate_doc_download"><label id="self_birth_certificate_doc_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="leaving_certificate_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Leaving Certificate / Bonofied Certificate Form <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-leaving_certificate_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="leaving_certificate_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Leaving Certificate / Bonofied Certificate Form <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="leaving_certificate_doc_download"><label id="leaving_certificate_doc_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div> 

                            <div class="row mb-2">
                                <div class="col-12" id="aadhar_card_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Aadhaar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-aadhar_card_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="aadhar_card_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Aadhaar Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="aadhar_card_doc_download"><label id="aadhar_card_doc_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="father_aadhar_card_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Father Aadhaar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-father_aadhar_card_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_aadhar_card_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Father Aadhaar Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="father_aadhar_card_doc_download"><label id="father_aadhar_card_doc_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="mother_aadhar_card_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Mother Aadhaar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-mother_aadhar_card_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="mother_aadhar_card_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Mother Aadhaar Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="mother_aadhar_card_doc_download"><label id="mother_aadhar_card_doc_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="father_election_card_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Father Election Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-father_election_card_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_election_card_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Father Election Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="father_election_card_doc_download"><label id="father_election_card_doc_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="mother_election_card_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Mother Election Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-mother_election_card_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="mother_election_card_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child Mother Election Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="mother_election_card_doc_download"><label id="mother_election_card_doc_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_THIRTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="obc_certificate_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child OBC Certificate (First issued and Original copy upload)<span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-obc_certificate_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="obc_certificate_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Minor Child OBC Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="obc_certificate_doc_download"><label id="obc_certificate_doc_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="income_certificate_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Upload Income Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-income_certificate_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="income_certificate_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Upload Income Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="income_certificate_download"><label id="income_certificate_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="father_certificate_doc_container_for_ncl_certificate">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Upload Applicant Father Birth Certificate / Leaving Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ncl-certificate-father_certificate_doc_for_ncl_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_certificate_doc_name_container_for_ncl_certificate" style="display: none;">
                                    <label><span class="doc_no_for_ncl_certificate"></span> Upload Applicant Father Birth Certificate / Leaving Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="father_certificate_doc_download"><label id="father_certificate_doc_name_image_for_ncl_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ncl_certificate_{{VALUE_FOURTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                        </div>
                    </div>
                    <!--        </div>-->
                    <hr class="m-b-1rem">    
                    <div class="form-group">
                        <!-- <button type="button" id="draft_btn_for_domicile" class="btn btn-sm btn-nic-blue" onclick="NclCertificate.listview.submitNclCertificate({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button> -->
                        <button type="button" id="submit_btn_for_obc_certificate" class="btn btn-sm btn-success" onclick="NclCertificate.listview.askForSubmitNclCertificate({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="NclCertificate.listview.loadNclCertificateData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>