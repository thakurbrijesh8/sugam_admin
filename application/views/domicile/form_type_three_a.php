<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Domicile Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application form for issue of  Domicile Certificate </div>
            </div>
            <form role="form" id="domicile_form" name="domicile_form" onsubmit="return false;">

                <input type="hidden" id="domicile_certificate_id" name="domicile_certificate_id" value="{{domicile_data.domicile_certificate_id}}">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-domicile f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <input type="hidden" id="constitution_artical" name="constitution_artical" value="5">
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
                                            onchange="checkValidation('domicile', 'district', selectDistrictValidationMessage); Domicile.listview.districtChangeEvent($(this));"
                                            data-placeholder="Select District" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-domicile-district"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>1.1 Name of Village Panchayat/D.M.C <span class="color-nic-red">*</span></label>
                                    <select id="village_name_for_dc" name="village_name" class="form-control select2"
                                            onchange="checkValidation('domicile', 'village_name_for_dc', oneOptionValidationMessage); Domicile.listview.villageDMCChangeEvent($(this));"
                                            data-placeholder="Select Name of Village Panchayat/D.M.C" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-domicile-village_name_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2. Name of Guardian<span class="color-nic-red">*</span></label>
                                    <input type="text" id="name_of_applicant_for_dc" name="name_of_applicant" class="form-control" placeholder="Enter Name of Guardian !"
                                           maxlength="100" onblur="checkValidation('domicile', 'name_of_applicant_for_dc', applicantNameValidationMessage);" value="{{domicile_data.name_of_applicant}}">
                                    <span class="error-message error-message-domicile-name_of_applicant_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.1 Guardian Relation with Child <span class="color-nic-red">*</span></label>
                                    <input type="text" id="relationship_of_applicant_for_dc" name="relationship_of_applicant" class="form-control" placeholder="Enter Guardian Relation with Child !"
                                           maxlength="100" onblur="checkValidation('domicile', 'relationship_of_applicant_for_dc', applicantRelationshipValidationMessage);" value="{{domicile_data.relationship_of_applicant}}">
                                    <span class="error-message error-message-domicile-relationship_of_applicant_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2.2 Guardian's Address <span class="color-nic-red">*</span></label>
                                    <textarea id="guardian_address_for_dc" name="guardian_address" class="form-control" placeholder="Enter Guardian's Address !"
                                              maxlength="100" onblur="checkValidation('domicile', 'guardian_address_for_dc', guardianAddressValidationMessage);" >{{domicile_data.guardian_address}}</textarea>
                                    <span class="error-message error-message-domicile-guardian_address_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.3 Guardian’s Mobile Number <span class="color-nic-red">*</span></label>
                                    <input type="text" id="guardian_mobile_no_for_dc" name="guardian_mobile_no" class="form-control" placeholder="Enter Mobile Number !"
                                           maxlength="100" onkeyup="checkNumeric($(this));"  onblur="checkValidationForMobileNumber('domicile', 'guardian_mobile_no_for_dc', mobileValidationMessage);" value="{{domicile_data.guardian_mobile_no}}">
                                    <span class="error-message error-message-domicile-guardian_mobile_no_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2.4 Guardian’s Aadhaar Number<span class="color-nic-red">*</span> </label>
                                    <input type="text" id="guardian_aadhaar_for_dc" name="guardian_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                           maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'guardian_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{domicile_data.guardian_aadhaar}}">
                                    <span class="error-message error-message-domicile-guardian_aadhaar_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.5Name of Minor Child (Who's Certificate Required)<span class="color-nic-red">*</span> </label>
                                    <input type="text" id="minor_child_name_for_dc" name="minor_child_name" class="form-control" placeholder="Enter Name of Minor Child"
                                           maxlength="100" onblur="checkValidation('domicile', 'minor_child_name_for_dc', minorChildNameValidationMessage);" value="{{domicile_data.minor_child_name}}">
                                    <span class="error-message error-message-domicile-minor_child_name_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-body pt-1" style="background-color: aliceblue;">

                                        <div class="row">
                                            <div class="form-group col-sm-6" >
                                                <label>3. Minor Child's Communication Address</label><br/>
                                                <label>3.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                <input type="text" id="com_addr_house_no_for_dc" name="com_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{domicile_data.com_addr_house_no}}" onblur="checkValidation('domicile', 'com_addr_house_no_for_dc', houseNoValidationMessage);">
                                                <span class="error-message error-message-domicile-com_addr_house_no_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6" style="margin-top: 22px;">
                                                <label>3.2 Building Name / House Name</label>
                                                <input type="text" id="com_addr_house_name_for_dc" name="com_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{domicile_data.com_addr_house_name}}">
                                                <span class="error-message error-message-domicile-com_addr_house_name_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>3.3 Street <span class="color-nic-red">*</span></label>
                                                <input type="text" id="com_addr_street_for_dc" name="com_addr_street" class="form-control" placeholder="Enter Street !"
                                                       maxlength="100" onblur="checkValidation('domicile', 'com_addr_street_for_dc', streetValidationMessage);" value="{{domicile_data.com_addr_street}}">
                                                <span class="error-message error-message-domicile-com_addr_street_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <input type="text" id="com_addr_village_dmc_ward_for_dc" name="com_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                       maxlength="100" onblur="checkValidation('domicile', 'com_addr_village_dmc_ward_for_dc', villageNameValidationMessage);" value="{{domicile_data.com_addr_village_dmc_ward}}" readonly="">
                                                <span class="error-message error-message-domicile-com_addr_village_dmc_ward_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>3.5 Select City<span class="color-nic-red">*</span></label>
                                                <input type="text" id="com_addr_city_for_dc" name="com_addr_city" class="form-control" placeholder="Enter City !"
                                                       onblur="checkValidation('domicile', 'com_addr_city_for_dc', selectCityValidationMessage);" value="{{domicile_data.com_addr_city}}" readonly="">
                                                <span class="error-message error-message-domicile-com_addr_city_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>3.6 Pincode <span class="color-nic-red">*</span></label>
                                                <input type="text" id="com_pincode_for_dc" name="com_pincode" class="form-control" placeholder="Enter Pincode !"
                                                       maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('domicile', 'com_pincode_for_dc', pincodeValidationMessage);" value="{{domicile_data.com_pincode}}">
                                                <span class="error-message error-message-domicile-com_pincode_for_dc"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body pt-1" style="background-color: aliceblue;">

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4. Minor Child's Permanent Address</label><br/>   
                                                <label>4.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                <input type="text" id="per_addr_house_no_for_dc" name="per_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{domicile_data.per_addr_house_no}}" onblur="checkValidation('domicile', 'per_addr_house_no_for_dc', houseNoValidationMessage);">
                                                <span class="error-message error-message-domicile-per_addr_house_no_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6" style="margin-top: 22px;">
                                                <label>4.2 Building Name / House Name</label>
                                                <input type="text" id="per_addr_house_name_for_dc" name="per_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{domicile_data.per_addr_house_name}}">
                                                <span class="error-message error-message-domicile-per_addr_house_name_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.3 Street <span class="color-nic-red">*</span></label>
                                                <input type="text" id="per_addr_street_for_dc" name="per_addr_street" class="form-control" placeholder="Enter Street !"
                                                       maxlength="100" onblur="checkValidation('domicile', 'per_addr_street_for_dc', streetValidationMessage);" value="{{domicile_data.per_addr_street}}">
                                                <span class="error-message error-message-domicile-per_addr_street_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <input type="text" id="per_addr_village_dmc_ward_for_dc" name="per_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                       maxlength="100" onblur="checkValidation('domicile', 'per_addr_village_dmc_ward_for_dc', villageNameValidationMessage);" value="{{domicile_data.per_addr_village_dmc_ward}}" >
                                                <span class="error-message error-message-domicile-per_addr_village_dmc_ward_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.5 Select City<span class="color-nic-red">*</span></label>
                                                <input type="text" id="per_addr_city_for_dc" name="per_addr_city" class="form-control" placeholder="Enter City !"
                                                       onblur="checkValidation('domicile', 'per_addr_city_for_dc', selectCityValidationMessage);" value="{{domicile_data.per_addr_city}}">
                                                <span class="error-message error-message-domicile-per_addr_city_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.6 Pincode <span class="color-nic-red">*</span></label>
                                                <input type="text" id="per_pincode_for_dc" name="per_pincode" class="form-control" placeholder="Enter Pincode !"
                                                       maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('domicile', 'per_pincode_for_dc', pincodeValidationMessage);" value="{{domicile_data.per_pincode}}">
                                                <span class="error-message error-message-domicile-per_pincode_for_dc"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px;">
                                <div class="form-group col-sm-6">
                                    <label>5. Minor Child's Mobile Number <span class="color-nic-red">*</span></label>
                                    <input type="text" id="mobile_number_for_dc" name="mobile_number" class="form-control" placeholder="Enter Mobile Number !"
                                           maxlength="10" onkeyup="checkNumeric($(this));"  onblur="checkValidationForMobileNumber('domicile', 'mobile_number_for_dc', mobileValidationMessage);" value="{{domicile_data.mobile_number}}">
                                    <span class="error-message error-message-domicile-mobile_number_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>6. Minor Child Nationality <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_nationality_for_dc" name="applicant_nationality" class="form-control" placeholder="Enter Minor Child Nationality!"
                                           maxlength="100" onblur="checkValidation('domicile', 'applicant_nationality_for_dc', applicantNationalityValidationMessage);" value="{{domicile_data.applicant_nationality}}">
                                    <span class="error-message error-message-domicile-applicant_nationality_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>7. Minor Child's Aadhaar Number<span class="color-nic-red">*</span> </label>
                                    <input type="text" id="aadhaar_for_dc" name="aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                           maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{domicile_data.aadhaar}}">
                                    <span class="error-message error-message-domicile-aadhaar_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>8. Minor Child Date of Birth<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applicant_dob" id="applicant_dob_for_dc" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value="{{applicant_dob}}"
                                               onblur="checkValidation('domicile', 'applicant_dob_for_dc', birthDateValidationMessage); calculateAge('for_dc');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-domicile-applicant_dob_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>8.1 Minor Child Age<span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_age_for_dc" 
                                           name="applicant_age" class="form-control"
                                           placeholder="Enter Minor Child Age !" maxlength="100" 
                                           onblur="checkValidation('domicile', 'applicant_age_for_dc', applicantAgeValidationMessage);"
                                           value="{{domicile_data.applicant_age}}" readonly="">
                                    <span class="error-message error-message-domicile-applicant_age_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>9. Minor Child Birth Place<span class="color-nic-red">*</span></label><br/>
                                    <label>9.1 State <span class="color-nic-red">*</span></label>
                                    <select id="born_place_state_for_dc" name="born_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('dc', 'born_place_state_for_dc', selectStateValidationMessage);
                                                    Domicile.listview.getDistrictData($(this), 'dc', 'born_place');">
                                    </select>
                                    <span class="error-message error-message-domicile-born_place_state_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                    <label>9.2 District <span class="color-nic-red">*</span></label>
                                    <select id="born_place_district_for_dc" name="born_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('dc', 'born_place_district_for_dc', selectDistrictValidationMessage);
                                                    Domicile.listview.getVillageData($(this), 'dc', 'born_place');">
                                    </select>
                                    <span class="error-message error-message-domicile-born_place_district_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                    <label>9.3 Village <span class="color-nic-red">*</span></label>
                                    <select id="born_place_village_for_dc" name="born_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('dc', 'born_place_village_for_dc', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-domicile-born_place_village_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>10. Original Native of Minor Child<span class="color-nic-red">*</span></label><br/>
                                    <label>10.1 State <span class="color-nic-red">*</span></label>
                                    <select id="native_place_state_for_dc" name="native_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('dc', 'native_place_state_for_dc', selectStateValidationMessage);
                                                    Domicile.listview.getDistrictData($(this), 'dc', 'native_place');">
                                    </select>
                                    <span class="error-message error-message-domicile-native_place_state_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                    <label>10.2 District <span class="color-nic-red">*</span></label>
                                    <select id="native_place_district_for_dc" name="native_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('dc', 'native_place_district_for_dc', selectDistrictValidationMessage);
                                                    Domicile.listview.getVillageData($(this), 'dc', 'native_place');">
                                    </select>
                                    <span class="error-message error-message-domicile-native_place_district_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                    <label>10.3 Village <span class="color-nic-red">*</span></label>
                                    <select id="native_place_village_for_dc" name="native_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('dc', 'native_place_village_for_dc', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-domicile-native_place_village_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>11. Gender<span class="color-nic-red">*</span></label>
                                    <div id="gender_container_for_dc"></div>
                                    <span class="error-message error-message-domicile-gender_for_dc"></span>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>13. Marital Status<span class="color-nic-red">*</span></label>
                                    <div id="marital_status_container_for_dc"></div>
                                    <span class="error-message error-message-domicile-marital_status_for_dc"></span>
                                </div>
                            </div> -->
                            <input type="hidden" name="marital_status_for_dc" id="marital_status_for_dc_1" value="2">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>12. Nearest Police Station. <span class="color-nic-red">*</span></label>
                                    <input type="text" id="nearest_police_station_for_dc" name="nearest_police_station" class="form-control" placeholder="Enter Nearest Police Station !" maxlength="100" value="{{domicile_data.nearest_police_station}}" onblur="checkValidation('domicile', 'nearest_police_station_for_dc', nearestPoliceStationValidationMessage);">
                                    <span class="error-message error-message-domicile-nearest_police_station_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>13. Nearest Post Office. <span class="color-nic-red">*</span></label>
                                    <input type="text" id="nearest_post_office_for_dc" name="nearest_post_office" class="form-control" placeholder="Enter Nearest Post Office !" maxlength="100" value="{{domicile_data.nearest_post_office}}" onblur="checkValidation('domicile', 'nearest_post_office_for_dc', nearestPostOfficeValidationMessage);">
                                    <span class="error-message error-message-domicile-nearest_post_office_for_dc"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    14. Minor Child Education Details.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-domicile-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="text-center p-1" style="min-width: 150px;">Name of School / Institute</th>
                                            <th class="text-center p-1" style="min-width: 150px;">Class / Standard</th>
                                            <th class="text-center p-1" style="min-width: 80px;">Date of Admission</th>
                                            <th class="text-center p-1" style="min-width: 150px;">Date of Leaving School</th>
                                            <th class="text-center p-1" style="min-width: 80px;text-align: center;" colspan="3">Total Period</th>
                                            <th class="text-center p-1" style="min-width: 80px;">Remarks</th>
                                            <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-center p-1">Year</th>
                                            <th class="text-center p-1">Month</th>
                                            <th class="text-center p-1">Days</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="applicant_education_info_container">
                                    </tbody>
                                </table>
                            </div> 
                            <div class="row">
                                <div class="col-6 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                    <label>Total Period</label>
                                    <input type="text" id="total_period_for_dc" name="total_period"
                                           class="form-control" placeholder="Total Period !" value="{{domicile_data.total_period}}" 
                                           readonly>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="Domicile.listview.addEducationInfo({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row father_info_item_container_for_dc">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1">
                                    <h3 class="card-title">15. (a) Minor Child's Father Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0 father_info_div border-nic-blue" style="display: none;" >
                                    <div class="p-1 flex-fill" style="overflow: hidden">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>Did Minor Child's Father is Alive ? <span class="color-nic-red">*</span></label>
                                                <div id="father_alive_container_for_dc"></div>
                                                <span class="error-message error-message-caste-certificate-father_alive_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>1. Minor Child's Father Name <span class="color-nic-red">*</span></label>
                                                <input type="text" id="father_name_for_dc" name="father_name"
                                                       maxlength="100" class="form-control" value="{{father_data.father_name}}" placeholder="Enter Minor Child's Father Name !" onblur="checkValidation('domicile', 'father_name_for_dc', fatherNameValidationMessage);"
                                                       >
                                                <span class="error-message error-message-domicile-father_name_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>1.1 Minor Child's Father Nationality <span class="color-nic-red">*</span></label>
                                                <input type="text" id="father_nationality_for_dc" name="father_nationality" class="form-control" placeholder="Enter Minor Child's Father Nationality!"
                                                       maxlength="100" onblur="checkValidation('domicile', 'father_nationality_for_dc', applicantNationalityValidationMessage);" value="{{father_data.father_nationality}}">
                                                <span class="error-message error-message-domicile-father_nationality_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label>2. Minor Child's Father Birth Place<span class="color-nic-red">*</span></label><br/>
                                                <label>2.1 State <span class="color-nic-red">*</span></label>
                                                <select id="father_born_place_state_for_dc" name="father_born_place_state" class="form-control select2"
                                                        data-placeholder="Select State/UT"
                                                        onchange="checkValidation('dc', 'father_born_place_state_for_dc', selectStateValidationMessage);
                                                            Domicile.listview.getDistrictData($(this), 'dc', 'father_born_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-father_born_place_state_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>2.2 District <span class="color-nic-red">*</span></label>
                                                <select id="father_born_place_district_for_dc" name="father_born_place_district" class="form-control select2"
                                                        data-placeholder="Select District"
                                                        onchange="checkValidation('dc', 'father_born_place_district_for_dc', selectDistrictValidationMessage);
                                                            Domicile.listview.getVillageData($(this), 'dc', 'father_born_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-father_born_place_district_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>2.3 Village <span class="color-nic-red">*</span></label>
                                                <select id="father_born_place_village_for_dc" name="father_born_place_village" class="form-control select2"
                                                        data-placeholder="Select Village" onchange="checkValidation('dc', 'father_born_place_village_for_dc', selectVillageValidationMessage);">
                                                </select>
                                                <span class="error-message error-message-domicile-father_born_place_village_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>2.4 Pincode <span class="color-nic-red">*</span></label>
                                                <input type="text" id="father_born_pincode_for_dc" name="father_born_pincode" class="form-control" placeholder="Enter Pincode !"
                                                       maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('domicile', 'father_born_pincode_for_dc', pincodeValidationMessage);" value="{{father_data.father_born_pincode}}">
                                                <span class="error-message error-message-domicile-father_born_pincode_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label>3. Original Native of Minor Child's Father<span class="color-nic-red">*</span></label><br/>
                                                <label>3.1 State <span class="color-nic-red">*</span></label>
                                                <select id="father_native_place_state_for_dc" name="father_native_place_state" class="form-control select2"
                                                        data-placeholder="Select State/UT"
                                                        onchange="checkValidation('dc', 'father_native_place_state_for_dc', selectStateValidationMessage);
                                                            Domicile.listview.getDistrictData($(this), 'dc', 'father_native_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-father_native_place_state_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.2 District <span class="color-nic-red">*</span></label>
                                                <select id="father_native_place_district_for_dc" name="father_native_place_district" class="form-control select2"
                                                        data-placeholder="Select District"
                                                        onchange="checkValidation('dc', 'father_native_place_district_for_dc', selectDistrictValidationMessage);
                                                            Domicile.listview.getVillageData($(this), 'dc', 'father_native_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-father_native_place_district_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.3 Village <span class="color-nic-red">*</span></label>
                                                <select id="father_native_place_village_for_dc" name="father_native_place_village" class="form-control select2"
                                                        data-placeholder="Select Village" onchange="checkValidation('dc', 'father_native_place_village_for_dc', selectVillageValidationMessage);">
                                                </select>
                                                <span class="error-message error-message-domicile-father_native_place_village_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.4 Pincode <span class="color-nic-red">*</span></label>
                                                <input type="text" id="father_native_pincode_for_dc" name="father_native_pincode" class="form-control" placeholder="Enter Pincode !"
                                                       maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('domicile', 'father_native_pincode_for_dc', pincodeValidationMessage);" value="{{father_data.father_native_pincode}}">
                                                <span class="error-message error-message-domicile-father_native_pincode_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="is_father_alive_container_for_dc">
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>4.1 Minor Child's Father Aadhaar Number </label>
                                                    <input type="text" id="father_aadhaar_for_dc" name="father_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                           maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'father_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{father_data.father_aadhaar}}">
                                                    <span class="error-message error-message-domicile-father_aadhaar_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>4.2 Minor Child's Father Election Number </label>
                                                    <input type="text" id="father_election_no_for_dc" name="father_election_no" class="form-control" placeholder="Enter Election Number"
                                                           maxlength="15" value="{{father_data.father_election_no}}">
                                                    <span class="error-message error-message-domicile-father_election_no_for_dc"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>5. Minor Child's Father Occupation. </label>
                                                    <select id="father_occupation_for_dc" name="father_occupation" class="form-control select2" onchange="checkValidation('domicile', 'father_occupation_for_dc', applicantOccupationValidationMessage); if (this.value == 12){$('.father_other_occupation_div_for_dc').show(); } else{$('.father_other_occupation_div_for_dc').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                                    </select>
                                                    <span class="error-message error-message-domicile-father_occupation_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-6 col-md-6">
                                                    <div class="father_other_occupation_div_for_dc" style="display: none;">
                                                        <label>5.1 Other Occupation Detail</label>
                                                        <input type="text" id="father_other_occupation_for_dc" name="father_other_occupation"
                                                               maxlength="100" class="form-control" value="{{father_data.father_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('domicile', 'father_other_occupation_for_dc', otherOccupationValidationMessage);"
                                                               >
                                                        <span class="error-message error-message-domicile-father_other_occupation_for_dc"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="row mother_info_item_container_for_dc">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1">
                                    <h3 class="card-title">15. (b) Minor Child's Mother Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0 mother_info_div border-nic-blue" style="display: none;">
                                    <div class="p-1 flex-fill" style="overflow: hidden">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>Did Minor Child's Mother is Alive ? <span class="color-nic-red">*</span></label>
                                                <div id="mother_alive_container_for_dc"></div>
                                                <span class="error-message error-message-caste-certificate-mother_alive_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>1. Minor Child's Mother Name <span class="color-nic-red">*</span></label>
                                                <input type="text" id="mother_name_for_dc" name="mother_name"
                                                       maxlength="100" class="form-control" value="{{mother_data.mother_name}}" placeholder="Enter Minor Child's Mother Name !" onblur="checkValidation('domicile', 'mother_name_for_dc', motherNameValidationMessage);"
                                                       >
                                                <span class="error-message error-message-domicile-mother_name_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>1.1 Minor Child's Mother Nationality <span class="color-nic-red">*</span></label>
                                                <input type="text" id="mother_nationality_for_dc" name="mother_nationality" class="form-control" placeholder="Enter Minor Child's Mother Nationality!"
                                                       maxlength="100" onblur="checkValidation('domicile', 'mother_nationality_for_dc', applicantNationalityValidationMessage);" value="{{mother_data.mother_nationality}}">
                                                <span class="error-message error-message-domicile-mother_nationality_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label>2. Minor Child's Mother Birth Place<span class="color-nic-red">*</span></label><br/>
                                                <label>2.1 State <span class="color-nic-red">*</span></label>
                                                <select id="mother_born_place_state_for_dc" name="mother_born_place_state" class="form-control select2"
                                                        data-placeholder="Select State/UT"
                                                        onchange="checkValidation('dc', 'mother_born_place_state_for_dc', selectStateValidationMessage);
                                                            Domicile.listview.getDistrictData($(this), 'dc', 'mother_born_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-mother_born_place_state_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>2.2 District <span class="color-nic-red">*</span></label>
                                                <select id="mother_born_place_district_for_dc" name="mother_born_place_district" class="form-control select2"
                                                        data-placeholder="Select District"
                                                        onchange="checkValidation('dc', 'mother_born_place_district_for_dc', selectDistrictValidationMessage);
                                                            Domicile.listview.getVillageData($(this), 'dc', 'mother_born_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-mother_born_place_district_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>2.3 Village <span class="color-nic-red">*</span></label>
                                                <select id="mother_born_place_village_for_dc" name="mother_born_place_village" class="form-control select2"
                                                        data-placeholder="Select Village" onchange="checkValidation('dc', 'mother_born_place_village_for_dc', selectVillageValidationMessage);">
                                                </select>
                                                <span class="error-message error-message-domicile-mother_born_place_village_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>2.4 Pincode <span class="color-nic-red">*</span></label>
                                                <input type="text" id="mother_born_pincode_for_dc" name="mother_born_pincode" class="form-control" placeholder="Enter Pincode !"
                                                       maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('domicile', 'mother_born_pincode_for_dc', pincodeValidationMessage);" value="{{mother_data.mother_born_pincode}}">
                                                <span class="error-message error-message-domicile-mother_born_pincode_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label>3. Original Native of Minor Child's Mother<span class="color-nic-red">*</span></label><br/>
                                                <label>3.1 State <span class="color-nic-red">*</span></label>
                                                <select id="mother_native_place_state_for_dc" name="mother_native_place_state" class="form-control select2"
                                                        data-placeholder="Select State/UT"
                                                        onchange="checkValidation('dc', 'mother_native_place_state_for_dc', selectStateValidationMessage);
                                                            Domicile.listview.getDistrictData($(this), 'dc', 'mother_native_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-mother_native_place_state_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.2 District <span class="color-nic-red">*</span></label>
                                                <select id="mother_native_place_district_for_dc" name="mother_native_place_district" class="form-control select2"
                                                        data-placeholder="Select District"
                                                        onchange="checkValidation('dc', 'mother_native_place_district_for_dc', selectDistrictValidationMessage);
                                                            Domicile.listview.getVillageData($(this), 'dc', 'mother_native_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-mother_native_place_district_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.3 Village <span class="color-nic-red">*</span></label>
                                                <select id="mother_native_place_village_for_dc" name="mother_native_place_village" class="form-control select2"
                                                        data-placeholder="Select Village" onchange="checkValidation('dc', 'mother_native_place_village_for_dc', selectVillageValidationMessage);">
                                                </select>
                                                <span class="error-message error-message-domicile-mother_native_place_village_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.4 Pincode <span class="color-nic-red">*</span></label>
                                                <input type="text" id="mother_native_pincode_for_dc" name="mother_native_pincode" class="form-control" placeholder="Enter Pincode !"
                                                       maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('domicile', 'mother_native_pincode_for_dc', pincodeValidationMessage);" value="{{mother_data.mother_native_pincode}}">
                                                <span class="error-message error-message-domicile-mother_native_pincode_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="is_mother_alive_container_for_dc">
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>4.1 Minor Child's Mother Aadhaar Number </label>
                                                    <input type="text" id="mother_aadhaar_for_dc" name="mother_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                           maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'mother_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{mother_data.mother_aadhaar}}">
                                                    <span class="error-message error-message-domicile-mother_aadhaar_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>4.2 Minor Child's Mother Election Number </label>
                                                    <input type="text" id="mother_election_no_for_dc" name="mother_election_no" class="form-control" placeholder="Enter Election Number"
                                                           maxlength="15" value="{{mother_data.mother_election_no}}">
                                                    <span class="error-message error-message-domicile-mother_election_no_for_dc"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>5. Minor Child's Mother Occupation. </label>
                                                    <select id="mother_occupation_for_dc" name="mother_occupation" class="form-control select2" onchange="checkValidation('domicile', 'mother_occupation_for_dc', applicantOccupationValidationMessage); if (this.value == 12){$('.mother_other_occupation_div_for_dc').show(); } else{$('.mother_other_occupation_div_for_dc').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                                    </select>
                                                    <span class="error-message error-message-domicile-mother_occupation_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-6 col-md-6">
                                                    <div class="mother_other_occupation_div_for_dc" style="display: none;">
                                                        <label>5.1 Other Occupation Detail</label>
                                                        <input type="text" id="mother_other_occupation_for_dc" name="mother_other_occupation"
                                                               maxlength="100" class="form-control" value="{{mother_data.mother_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('domicile', 'mother_other_occupation_for_dc', otherOccupationValidationMessage);"
                                                               >
                                                        <span class="error-message error-message-domicile-mother_other_occupation_for_dc"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    16. Residential details of last 10 year in the U.T. Of Daman & Diu.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-domicile-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="text-center p-1" style="min-width: 150px;">Details / Address of Residential Place</th>
                                            <th class="text-center p-1" style="min-width: 150px;">Type of Resident</th>
                                            <th class="text-center p-1" style="min-width: 80px;">Date of Resident</th>
                                            <th class="text-center p-1" style="min-width: 150px;">Date of Leaving</th>
                                            <th class="text-center p-1" style="min-width: 80px;" colspan="3">Total Period</th>
                                            <th class="text-center p-1" style="min-width: 80px;">Remarks</th>
                                            <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-center p-1">Year</th>
                                            <th class="text-center p-1">Month</th>
                                            <th class="text-center p-1">Days</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="residential_info_container">
                                    </tbody>
                                </table>
                            </div> 
                            <div class="row">
                                <div class="col-6 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                    <label>Total Period</label>
                                    <input type="text" id="resident_total_period_for_dc" name="resident_total_period"
                                           class="form-control" placeholder="Total Period !" value="{{domicile_data.resident_total_period}}" 
                                           readonly>
                                    <span class="error-message error-message-domicile-resident_total_period_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="Domicile.listview.addResidentialInfo({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
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
                                <div class="form-group col-sm-6 required_purpose_for_dc_div">
                                    <label>17. Purpose for which the Domicile Certificate is required. And before whom it is to be produced. <span class="color-nic-red">*</span></label>
                                    <input type="text" id="required_purpose_for_dc" name="required_purpose" class="form-control" placeholder="Enter Purpose for which the Domicile Certificate is required !" maxlength="100" value="{{domicile_data.required_purpose}}" onblur="checkValidation('domicile', 'required_purpose_for_dc', purposeofDomicileValidationMessage);">
                                    <span class="error-message error-message-domicile-required_purpose_for_dc"></span>
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
                            <div class="row">
                                <div class="col-12 m-b-5px" id="applicant_photo_container_for_domicile">
                                    <label>1. Father / Mother / Guardian Photo (Latest) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-domicile-applicant_photo_for_domicile"></div>
                                </div>
                                <div class="form-group col-sm-12" id="applicant_photo_name_container_for_domicile" style="display: none;">
                                    <label>1. Father / Mother / Guardian Photo (Latest)<span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="applicant_photo_download"><img id="applicant_photo_name_image_for_domicile" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_domicile_{{VALUE_ONE}}"></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row">
                                <div class="col-12 m-b-5px" id="minor_child_photo_container_for_domicile">
                                    <label>2. Minor Child Photo (Latest) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-domicile-minor_child_photo_for_domicile"></div>
                                </div>
                                <div class="form-group col-sm-12" id="minor_child_photo_name_container_for_domicile" style="display: none;">
                                    <label>2. Minor Child Photo (Latest)<span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="minor_child_photo_download"><img id="minor_child_photo_name_image_for_domicile" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_domicile_{{VALUE_THIRTEEN}}"></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row">
                                <div  class="birth_certificate_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="birth_certi_container_for_domicile">
                                        <label>3. Minor Child Original Birth Certificate <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-birth_certi_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="birth_certi_name_container_for_domicile" style="display: none;">
                                        <label>3. Minor Child Original Birth Certificate<span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="birth_certi_download"><label id="birth_certi_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>  

                            <div class="row">
                                <div  class="leaving_certificate_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="leaving_certi_container_for_domicile">
                                        <label>4. Minor Child Original Leaving / Bonified Certificate / Marksheets  <span style="color: red;">* <br>Since K.G. to till date education bonofied certificate or leaving or marksheet must be uploaded in file.<br/>(Maximum File Size: 10MB) &nbsp; (Upload PDF Only & Multiple PDF selection allow)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-leaving_certi_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="leaving_certi_name_container_for_domicile" style="display: none;">
                                        <label>4. Minor Child Original Leaving / Bonified Certificate / Marksheets<span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="leaving_certi_download"><label id="leaving_certi_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_EIGHTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>

                            <div class="row">
                                <div  class="aadhar_card_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="aadhaar_card_container_for_domicile">
                                        <label>5. Minor Child Original Aadhaar Card<span style="color: red;">* <br>(Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-aadhaar_card_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="aadhaar_card_name_container_for_domicile" style="display: none;">
                                        <label>5. Minor Child Original Aadhaar Card <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="aadhaar_card_download"><label id="aadhaar_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div> 
                            </div>

                            <div  class="father_proof_file_container_for_dc"> 
                                <div class="father_proof_item_container_for_dc">
                                    <div class="row">
                                        <div  class="father_birth_certificate_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="father_birth_certificate_container_for_dc">
                                                <label>6. Applicant Father Birth Certificate/Leaving Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-father_birth_certificate_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="father_birth_certificate_name_container_for_domicile" style="display: none;">
                                                <label>6. Applicant Father Birth Certificate/Leaving Certificateeeeee <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="father_birth_certificate_download"><label id="father_birth_certificate_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYTHREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYTHREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="father_election_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="father_election_card_container_for_dc">
                                                <label>7. Applicant Father Election Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-father_election_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="father_election_card_name_container_for_domicile" style="display: none;">
                                                <label>7. Applicant Father Election Card <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="father_election_card_download"><label id="father_election_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYFOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYFOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="father_aadhar_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="father_aadhar_card_container_for_dc">
                                                <label>8. Applicant Father Aadhar Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-father_aadhar_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="father_aadhar_card_name_container_for_domicile" style="display: none;">
                                                <label>8. Applicant Father Aadhar Card <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="father_aadhar_card_download"><label id="father_aadhar_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYFIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYFIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="father_death_proof_item_container_for_dc" style="display: none;">
                                    <div class="row">
                                        <div  class="father_death_proof_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="father_death_proof_container_for_dc">
                                                <label>9. Applicant Father Death Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-father_death_proof_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="father_death_proof_name_container_for_domicile" style="display: none;">
                                                <label>9. Applicant Father Death Certificate <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="father_death_proof_download"><label id="father_death_proof_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYSIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYSIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div  class="mother_proof_file_container_for_dc">
                                <div class="mother_proof_item_container_for_dc">
                                    <div class="row">
                                        <div  class="mother_birth_certificate_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="mother_birth_certificate_container_for_dc">
                                                <label>10. Applicant Mother Birth Certificate/Leaving Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-mother_birth_certificate_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="mother_birth_certificate_name_container_for_domicile" style="display: none;">
                                                <label>10. Applicant Mother Birth Certificate/Leaving Certificate <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="mother_birth_certificate_download"><label id="mother_birth_certificate_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYSEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYSEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="mother_election_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="mother_election_card_container_for_dc">
                                                <label>11. Applicant Mother Election Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-mother_election_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="mother_election_card_name_container_for_domicile" style="display: none;">
                                                <label>11. Applicant Mother Election Card <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="mother_election_card_download"><label id="mother_election_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYEIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYEIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="mother_aadhar_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="mother_aadhar_card_container_for_dc">
                                                <label>12. Applicant Mother Aadhar Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-mother_aadhar_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="mother_aadhar_card_name_container_for_domicile" style="display: none;">
                                                <label>12. Applicant Mother Aadhar Card <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="mother_aadhar_card_download"><label id="mother_aadhar_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYNINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYNINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mother_death_proof_item_container_for_dc" style="display: none;">
                                    <div class="row">
                                        <div  class="mother_death_proof_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="mother_death_proof_container_for_dc">
                                                <label>13. Applicant Mother Death Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-mother_death_proof_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="mother_death_proof_name_container_for_domicile" style="display: none;">
                                                <label>13. Applicant Mother Death Certificate <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="mother_death_proof_download"><label id="mother_death_proof_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_THIRTY}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTY}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div  class="gas_book_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="gas_book_container_for_domicile">
                                        <label>14. Gas Book<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-gas_book_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="gas_book_name_container_for_domicile" style="display: none;">
                                        <label>14. Gas Book <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="gas_book_download"><label id="gas_book_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div> 

                            <div class="row">
                                <div  class="bank_book_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="bank_book_container_for_domicile">
                                        <label>15. Minor Child Father Bank Pass Book Xerox Copy<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-bank_book_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="bank_book_name_container_for_domicile" style="display: none;">
                                        <label>15. Minor Child Father Bank Pass Book Xerox Copy <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="bank_book_download"><label id="bank_book_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>
                            <div class="row">
                                <div  class="mother_bank_book_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="mother_bank_book_container_for_domicile">
                                        <label>16. Minor Child Mother Bank Pass Book Xerox Copy<span style="color: red;"> <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-mother_bank_book_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="mother_bank_book_name_container_for_domicile" style="display: none;">
                                        <label>16. Minor Child Mother Bank Pass Book Xerox Copy <span style="color: red;"> </span></label><br>
                                        <a target="_blank" id="mother_bank_book_download"><label id="mother_bank_book_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>
                            <div class="row">
                                <div  class="minor_child_bank_book_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="minor_child_bank_book_container_for_domicile">
                                        <label>17. Minor Child Bank Pass Book Xerox Copy<span style="color: red;"> <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-minor_child_bank_book_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="minor_child_bank_book_name_container_for_domicile" style="display: none;">
                                        <label>17. Minor Child Bank Pass Book Xerox Copy <span style="color: red;"></span></label><br>
                                        <a target="_blank" id="minor_child_bank_book_download"><label id="minor_child_bank_book_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYTWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYTWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>

                            <div class="row mb-2 have_you_own_house_container_div">
                                <div class="col-sm-6">
                                    <label>18. Do You have Your Own House ? <span class="color-nic-red">*</span></label>
                                    <div id="have_you_own_house_container_for_domicile"></div>
                                    <span class="error-message error-message-dc-have_you_own_house_for_domicile"></span>
                                </div>
                            </div>
                            <div class="house_tax_receipt_item_container_for_domicile" style="display: none;">
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="house_tax_receipt_container_for_domicile">
                                        <label>18.1 House Tax Receipt <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-house_tax_receipt_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="house_tax_receipt_name_container_for_domicile" style="display: none;">
                                        <label>18.1 House Tax Receipt <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="house_tax_receipt_download"><label id="house_tax_receipt_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="sale_deed_copy_container_for_domicile">
                                        <label>18.2 Saledeed Copy <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-sale_deed_copy_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="sale_deed_copy_name_container_for_domicile" style="display: none;">
                                        <label>18.2 Saledeed Copy <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="sale_deed_copy_download"><label id="sale_deed_copy_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_NINETEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINETEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>
                            <div class="noc_with_notary_item_container_for_domicile " style="display: none;">
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="noc_with_notary_container_for_domicile">
                                        <label>18.1 NOC With Notary alongwith Photo Attached <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-noc_with_notary_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="noc_with_notary_name_container_for_domicile" style="display: none;">
                                        <label>18.1 NOC With Notary alongwith Photo Attached <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="noc_with_notary_download"><label id="noc_with_notary_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="aggriment_with_notary_container_for_domicile">
                                        <label>18.2 Aggriment With Notary alongwith Photo Attached <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-aggriment_with_notary_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="aggriment_with_notary_name_container_for_domicile" style="display: none;">
                                        <label>18.2 Aggriment With Notary alongwith Photo Attached <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="aggriment_with_notary_download"><label id="aggriment_with_notary_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTY}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTY}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>

                            <div class="row">
                                <div  class="proof_document_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="last_10year_proof_container_for_domicile">
                                        <label>19. Last 10 years Proof Documents <span style="color: red;"> <br>(Maximum File Size: 5MB) &nbsp; (Upload PDF Only & Multiple PDF selection allow)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-last_10year_proof_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="last_10year_proof_name_container_for_domicile" style="display: none;">
                                        <label>19. Last 10 years Proof Documents <span style="color: red;"> </span></label><br>
                                        <a target="_blank" id="last_10year_proof_download"><label id="last_10year_proof_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>
                            <div class="row">
                                <div  class="other_document_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="other_document_container_for_domicile">
                                        <label>20. Other Document<span style="color: red;"> <br>(Maximum File Size: 5MB)(Upload pdf Only & Multiple PDF selection allow)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-other_document_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="other_document_name_container_for_domicile" style="display: none;">
                                        <label>20. Other Document <span style="color: red;"> </span></label><br>
                                        <a target="_blank" id="other_document_download"><label id="other_document_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_SIXTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <br/>

                    <hr class="m-b-1rem"> 

                    <div class="form-group">
                        <button type="button" id="submit_btn_for_domicile" class="btn btn-sm btn-success" onclick="Domicile.listview.submitDomicile({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Domicile.listview.loadDomicileData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>