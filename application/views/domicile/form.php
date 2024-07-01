<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                 <h3 class="card-title f-w-b" style="float: none; text-align: center;">Domicile Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application form for issue of  Domicile Certificate </div>
            </div>
            <form role="form" id="domicile_form" name="domicile_form" onsubmit="return false;">

                <input type="hidden" id="domicile_certificate_id" name="domicile_certificate_id" value="{{domicile_certificate_id}}">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-domicile f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3"></div>
                        <div class="form-group col-sm-6">
                            <label>Select type of Application<span class="color-nic-red">*</span></label>
                             <div class="input-group">
                                <select class="form-control select2" id="constitution_artical" name="constitution_artical"
                                        data-placeholder="Type Of Application !" onchange="Domicile.listview.getConstitution(this);"  onblur="checkValidation('domicile', 'constitution_artical', selectApplicationValidationMessage);" >
                                    <option value="">Select type of Application</option>
                                    <option value="1">A Person who is permanently residing in the Union Territory of Daman and Diu</option>
                                    <option value="2">A Person either of whose parents were born in the Territory</option>
                                    <option value="3">A Spouse/Children of persons mentioned in (a) above</option>
                                    <option value="4">A person who has/had a minimum of 10 year continuous education in Union Territory of Daman and Diu</option>
                                    <option value="5">A Person who is residing in the Union territory of Daman and Diu continuously for 10 years.</option>
                                    <option value="6">A Minor Person either of whose parents where born in the Territory</option>
                                </select>
                            </div>
                            <span class="error-message error-message-domicile-constitution_artical"></span>
                        </div></br>  
                    </div>
                    To,<br>
                    The Mamlatdar,
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>1. District<span class="color-nic-red">*</span></label>
                            <select id="district" name="district" class="form-control select2"
                                    onchange="checkValidation('domicile', 'district', selectDistrictValidationMessage);Domicile.listview.districtChangeEvent($(this));"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-domicile-district"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.1 Name of Village Panchayat/D.M.C <span class="color-nic-red">*</span></label>
                            <select id="village_name_for_dc" name="village_name" class="form-control select2"
                                    onchange="checkValidation('domicile', 'village_name_for_dc', oneOptionValidationMessage);"
                                    data-placeholder="Select Name of Village Panchayat/D.M.C" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-domicile-village_name_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="applicant_name_for_dc_div">2. Full Name of Applicant <span class="color-nic-red">*</span></label>
                            <label class="gurdian_name_for_dc_div" style="display: none">2. Full Name of Applicant  / Guardian Name <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="name_of_applicant_for_dc" name="name_of_applicant" class="form-control" placeholder="Enter Full Name of Applicant !"
                                       maxlength="100" onblur="checkValidation('domicile', 'name_of_applicant_for_dc', applicantNameValidationMessage);" value="{{name_of_applicant}}">
                            </div>
                            <span class="error-message error-message-domicile-name_of_applicant_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6 guardian_div_one" style="display: none">
                            <label>2.1 Relationship of Applicant <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="relationship_of_applicant_for_dc" name="relationship_of_applicant" class="form-control" placeholder="Enter Relationship of Applicant !"
                                       maxlength="100" onblur="checkValidation('domicile', 'relationship_of_applicant_for_dc', applicantRelationshipValidationMessage);" value="{{relationship_of_applicant}}">
                            </div>
                            <span class="error-message error-message-domicile-relationship_of_applicant_for_dc"></span>
                        </div>
                    </div>
                    <div class="row guardian_div_two" style="display: none">
                        <div class="form-group col-sm-6">
                            <label>2.2 Guardian's Address <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea id="guardian_address_for_dc" name="guardian_address" class="form-control" placeholder="Enter Guardian's Address !"
                                       maxlength="100" onblur="checkValidation('domicile', 'guardian_address_for_dc', guardianAddressValidationMessage);" >{{guardian_address}}</textarea>
                            </div>
                            <span class="error-message error-message-domicile-guardian_address_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>2.3 Guardian’s Mobile Number <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <input type="text" id="guardian_mobile_no_for_dc" name="guardian_mobile_no" class="form-control" placeholder="Enter Mobile Number !"
                                       maxlength="100" onkeyup="checkNumeric($(this));"  onblur="checkValidationForMobileNumber('domicile', 'guardian_mobile_no_for_dc', mobileValidationMessage);" value="{{guardian_mobile_no}}">
                            </div>
                            <span class="error-message error-message-domicile-guardian_mobile_no_for_dc"></span>
                        </div>
                    </div>
                    <div class="row guardian_div_three" style="display: none">
                        <div class="form-group col-sm-6">
                            <label>2.4 Guardian’s Aadhaar Number<span class="color-nic-red">*</span> </label>
                            <div class="input-group">
                                <input type="text" id="guardian_aadhaar_for_dc" name="guardian_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                       maxlength="15" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'guardian_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{guardian_aadhaar}}">
                            </div>
                            <span class="error-message error-message-domicile-guardian_aadhaar_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>2.5 Name of Minor Child<span class="color-nic-red">*</span> </label>
                            <div class="input-group">
                                <input type="text" id="minor_child_name_for_dc" name="minor_child_name" class="form-control" placeholder="Enter Name of Minor Child"
                                       maxlength="100" onblur="checkValidation('domicile', 'minor_child_name_for_dc', minorChildNameValidationMessage);" value="{{minor_child_name}}">
                            </div>
                            <span class="error-message error-message-domicile-minor_child_name_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-body pt-1" style="background-color: aliceblue;">
                                
                                <div class="row">
                                       <div class="form-group col-sm-6" style="margin-top: 25px;">
                                        <label>3. Applicant’s Communication Address</label><br/>
                                        <label>3.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="com_addr_house_no_for_dc" name="com_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{com_addr_house_no}}" onblur="checkValidation('domicile', 'com_addr_house_no_for_dc', houseNoValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-domicile-com_addr_house_no_for_dc"></span>
                                    </div>
                                    <div class="form-group col-sm-6" style="margin-top: 47px;">
                                        <label>3.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="com_addr_house_name_for_dc" name="com_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{com_addr_house_name}}" onblur="checkValidation('domicile', 'com_addr_house_name_for_dc', houseNameValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-domicile-com_addr_house_name_for_dc"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>3.3 Street <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="com_addr_street_for_dc" name="com_addr_street" class="form-control" placeholder="Enter Street !"
                                                   maxlength="100" onblur="checkValidation('domicile', 'com_addr_street_for_dc', streetValidationMessage);" value="{{com_addr_street}}">
                                        </div>
                                        <span class="error-message error-message-domicile-com_addr_street_for_dc"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>3.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="com_addr_village_dmc_ward_for_dc" name="com_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                   maxlength="100" onblur="checkValidation('domicile', 'com_addr_village_dmc_ward_for_dc', villageNameValidationMessage);" value="{{com_addr_village_dmc_ward}}">
                                        </div>
                                        <span class="error-message error-message-domicile-com_addr_village_dmc_ward_for_dc"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>3.5 Select City<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="com_addr_city_for_dc" name="com_addr_city"
                                                    data-placeholder="City !"  onblur="checkValidation('domicile', 'com_addr_city_for_dc', selectCityValidationMessage);" >
                                                <option value="">Select City</option>
                                                <option value="1">Nani Daman</option>
                                                <option value="2">Moti Daman</option>
                                            </select>
                                        </div>
                                        <span class="error-message error-message-domicile-com_addr_city_for_dc"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-body pt-1" style="background-color: aliceblue;">
                                
                                <div class="row">
                                       <div class="form-group col-sm-6">
                                        <label>Same as Communication Address</label>&nbsp;
                                            <input type="checkbox" id="billingtoo_for_dc" name="billingtoo" class="checkbox" value="{{is_checked}}"  onchange="Domicile.listview.FillBilling($(this));">
                                            <span class="error-message error-message-domicile-billingtoo"></span><br/>
                                        <label>4. Applicant’s Permanent Address</label><br/>   
                                        <label>4.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_addr_house_no_for_dc" name="per_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{per_addr_house_no}}" onblur="checkValidation('domicile', 'per_addr_house_no_for_dc', houseNoValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-domicile-per_addr_house_no_for_dc"></span>
                                    </div>
                                    <div class="form-group col-sm-6" style="margin-top: 45px;">
                                        <label>4.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <input type="text" id="per_addr_house_name_for_dc" name="per_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{per_addr_house_name}}" onblur="checkValidation('domicile', 'per_addr_house_name_for_dc', houseNameValidationMessage);">
                                        </div>
                                        <span class="error-message error-message-domicile-per_addr_house_name_for_dc"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>4.3 Street <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="per_addr_street_for_dc" name="per_addr_street" class="form-control" placeholder="Enter Street !"
                                                   maxlength="100" onblur="checkValidation('domicile', 'per_addr_street_for_dc', streetValidationMessage);" value="{{per_addr_street}}">
                                        </div>
                                        <span class="error-message error-message-domicile-per_addr_street_for_dc"></span>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>4.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                             <input type="text" id="per_addr_village_dmc_ward_for_dc" name="per_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                   maxlength="100" onblur="checkValidation('domicile', 'per_addr_village_dmc_ward_for_dc', villageNameValidationMessage);" value="{{per_addr_village_dmc_ward}}">
                                        </div>
                                        <span class="error-message error-message-domicile-per_addr_village_dmc_ward_for_dc"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>4.5 Select City<span class="color-nic-red">*</span></label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="per_addr_city_for_dc" name="per_addr_city"
                                                    data-placeholder="City !"  onblur="checkValidation('domicile', 'per_addr_city_for_dc', selectCityValidationMessage);" >
                                                <option value="">Select City</option>
                                                <option value="1">Nani Daman</option>
                                                <option value="2">Moti Daman</option>
                                            </select>
                                        </div>
                                        <span class="error-message error-message-domicile-per_addr_city_for_dc"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>5. Applicant’s Mobile Number <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <input type="text" id="mobile_number_for_dc" name="mobile_number" class="form-control" placeholder="Enter Mobile Number !"
                                       maxlength="100" onkeyup="checkNumeric($(this));"  onblur="checkValidationForMobileNumber('domicile', 'mobile_number_for_dc', mobileValidationMessage);" value="{{mobile_number}}">
                            </div>
                            <span class="error-message error-message-domicile-mobile_number_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>6 Applicant Nationality <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_nationality_for_dc" name="applicant_nationality" class="form-control" placeholder="Enter Applicant Nationality!"
                                   maxlength="100" onblur="checkValidation('domicile', 'applicant_nationality_for_dc', applicantNationalityValidationMessage);" value="{{applicant_nationality}}">
                            <span class="error-message error-message-domicile-applicant_nationality_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7. Applicant’s Aadhaar Number<span class="color-nic-red">*</span> </label>
                            <div class="input-group">
                                <input type="text" id="aadhaar_for_dc" name="aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                       maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{aadhaar}}">
                            </div>
                            <span class="error-message error-message-domicile-aadhaar_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8. Applicant’s Election Number </label>
                            <div class="input-group">
                                <input type="text" id="election_no_for_dc" name="election_no" class="form-control" placeholder="Enter Election Number"
                                       maxlength="12" onblur="checkValidation('domicile', 'election_no_for_dc', electionNumberValidationMessage);" value="{{election_no}}">
                            </div>
                            <span class="error-message error-message-domicile-election_no_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>9. Applicant Date of Birth<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="applicant_dob" id="applicant_dob_for_dc" class="form-control"
                                       placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value=""
                                       onblur="checkValidation('domicile', 'applicant_dob_for_dc', birthDateValidationMessage);calculateAge('for_dc');">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-domicile-applicant_dob_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>9.1 Applicant Age<span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_age_for_dc" 
                                   name="applicant_age" class="form-control"
                                   placeholder="Enter Applicant Age !" maxlength="100" 
                                   onblur="checkValidation('domicile', 'applicant_age_for_dc', applicantAgeValidationMessage);"
                                   value="{{applicant_age}}" readonly="">
                            <span class="error-message error-message-domicile-applicant_age_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-sm-4 col-md-4">
                                <label>10. Applicant Birth Place<span class="color-nic-red">*</span></label><br/>
                                <label>10.1 State <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="born_place_state_for_dc" name="born_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('dc', 'born_place_state_for_dc', selectStateValidationMessage);
                                                Domicile.listview.getDistrictData($(this), 'dc', 'born_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-domicile-born_place_state_for_dc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>10.2 District <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="born_place_district_for_dc" name="born_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('dc', 'born_place_district_for_dc', selectDistrictValidationMessage);
                                                Domicile.listview.getVillageData($(this), 'dc', 'born_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-domicile-born_place_district_for_dc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>10.3 Village <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="born_place_village_for_dc" name="born_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('dc', 'born_place_village_for_dc', selectVillageValidationMessage);">
                                    </select>
                                </div>
                                <span class="error-message error-message-domicile-born_place_village_for_dc"></span>
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-sm-4 col-md-4">
                                <label>11. Original Native of<span class="color-nic-red">*</span></label><br/>
                                <label>11.1 State <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="native_place_state_for_dc" name="native_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('dc', 'native_place_state_for_dc', selectStateValidationMessage);
                                                Domicile.listview.getDistrictData($(this), 'dc', 'native_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-domicile-native_place_state_for_dc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>11.2 District <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="native_place_district_for_dc" name="native_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('dc', 'native_place_district_for_dc', selectDistrictValidationMessage);
                                                Domicile.listview.getVillageData($(this), 'dc', 'native_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-domicile-native_place_district_for_dc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>11.3 Village <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="native_place_village_for_dc" name="native_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('dc', 'native_place_village_for_dc', selectVillageValidationMessage);">
                                    </select>
                                </div>
                                <span class="error-message error-message-domicile-native_place_village_for_dc"></span>
                            </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>12. Gender<span class="color-nic-red">*</span></label>
                            <div id="gender_container_for_dc"></div>
                            <span class="error-message error-message-domicile-gender_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>13 Marital Status<span class="color-nic-red">*</span></label>
                            <div id="marital_status_container_for_dc"></div>
                            <span class="error-message error-message-domicile-marital_status_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>14. Nearest Police Station. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="nearest_police_station_for_dc" name="nearest_police_station" class="form-control" placeholder="Enter Nearest Police Station !" maxlength="100" value="{{nearest_police_station}}" onblur="checkValidation('domicile', 'nearest_police_station_for_dc', nearestPoliceStationValidationMessage);">
                            </div>
                            <span class="error-message error-message-domicile-nearest_police_station_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>15. Nearest Post Office. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="nearest_post_office_for_dc" name="nearest_post_office" class="form-control" placeholder="Enter Nearest Post Office !" maxlength="100" value="{{nearest_post_office}}" onblur="checkValidation('domicile', 'nearest_post_office_for_dc', nearestPostOfficeValidationMessage);">
                            </div>
                            <span class="error-message error-message-domicile-nearest_post_office_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>16. Applicant Occupation. <span class="color-nic-red">*</span></label>
                            <!-- <div class="input-group">
                                <input type="text" id="occupation_for_dc" name="occupation" class="form-control" placeholder="Enter Applicant Occupation !" maxlength="100" value="{{occupation}}" onblur="checkValidation('domicile', 'occupation_for_dc', occupationValidationMessage);">
                            </div>
                            <span class="error-message error-message-domicile-occupation_for_dc"></span> -->
                            <select id="occupation_for_dc" name="occupation" class="form-control select2" onchange="checkValidation('domicile', 'occupation_for_dc', applicantOccupationValidationMessage);if(this.value == 12){$('.other_occupation_div_for_dc').show();}" data-placeholder="Select Occupation" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-domicile-occupation_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <div class="other_occupation_div_for_dc" style="display: none;">
                                <label>16.1 Other Occupation Detail</label>
                                <input type="text" id="other_occupation_for_dc" name="other_occupation"
                                       maxlength="100" class="form-control" value="{{other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('domicile', 'other_occupation_text_for_dc', otherOccupationValidationMessage);"
                                       >
                                <span class="error-message error-message-domicile-other_occupation_text_for_dc"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>17. Applicant Education. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="applicant_education_for_dc" name="applicant_education" class="form-control" placeholder="Enter Applicant Education !" maxlength="100" value="{{applicant_education}}" onblur="checkValidation('domicile', 'applicant_education_for_dc', applicantEducationValidationMessage);">
                            </div>
                            <span class="error-message error-message-domicile-applicant_education_for_dc"></span>
                        </div>
                    </div>

    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                              <div class="card-header" style="background-color: lavenderblush;">
                                <h3 class="card-title">18. (a) Father Information</h3>

                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body p-0 father_info_div" style="display: none;" >
                                <div class="">
                                  <div class="p-1 flex-fill" style="overflow: hidden">
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label>1. Name of Father <span class="color-nic-red">*</span></label>
                                                    <input type="text" id="father_name_for_dc" name="father_name"
                                                           maxlength="100" class="form-control" value="{{father_name}}" placeholder="Enter Father Name !" onblur="checkValidation('domicile', 'father_name_for_dc', fatherNameValidationMessage);"
                                                           >
                                                    <span class="error-message error-message-domicile-father_name_for_dc"></span>
                                                </div>
                                            </div>
                                            <div class="" style="background-color: aliceblue;">
                                                
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label>2. Father's Address</label><br/>
                                                        <label>2.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" id="father_house_no_for_dc" name="father_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{father_house_no}}" onblur="checkValidation('domicile', 'father_house_no_for_dc', houseNoValidationMessage);">
                                                        </div>
                                                        <span class="error-message error-message-domicile-father_house_no_for_dc"></span>
                                                    </div>
                                                    <div class="form-group col-sm-6" style="margin-top: 22px;">
                                                        <label>2.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" id="father_house_name_for_dc" name="father_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{father_house_name}}" onblur="checkValidation('domicile', 'father_house_name_for_dc', houseNameValidationMessage);">
                                                        </div>
                                                        <span class="error-message error-message-domicile-father_house_name_for_dc"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label>2.3 Street <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                             <input type="text" id="father_street_for_dc" name="father_street" class="form-control" placeholder="Enter Street !"
                                                                   maxlength="100" onblur="checkValidation('domicile', 'father_street_for_dc', streetValidationMessage);" value="{{father_street}}">
                                                        </div>
                                                        <span class="error-message error-message-domicile-father_street_for_dc"></span>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label>2.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                             <input type="text" id="father_village_dmc_ward_for_dc" name="father_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                                   maxlength="100" onblur="checkValidation('domicile', 'father_village_dmc_ward_for_dc', villageNameValidationMessage);" value="{{father_village_dmc_ward}}">
                                                        </div>
                                                        <span class="error-message error-message-domicile-father_village_dmc_ward_for_dc"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label>2.5 Select City<span class="color-nic-red">*</span></label>
                                                        <div class="">
                                                            <select class="form-control select2" id="father_city_for_dc" name="father_city"
                                                                    data-placeholder="City !"  onblur="checkValidation('domicile', 'father_city_for_dc', selectCityValidationMessage);" >
                                                                <option value="">Select City</option>
                                                                <option value="1">Nani Daman</option>
                                                                <option value="2">Moti Daman</option>
                                                            </select>
                                                        </div>
                                                        <span class="error-message error-message-domicile-father_city_for_dc"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>3. Father's Nationality <span class="color-nic-red">*</span></label>
                                                    <input type="text" id="father_nationality_for_dc" name="father_nationality" class="form-control" placeholder="Enter Father's Nationality!"
                                                           maxlength="100" onblur="checkValidation('domicile', 'father_nationality_for_dc', applicantNationalityValidationMessage);" value="{{father_nationality}}">
                                                    <span class="error-message error-message-domicile-father_nationality_for_dc"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="form-group col-sm-4 col-md-4">
                                                    <label>4. Applicant Birth Place<span class="color-nic-red">*</span></label><br/>
                                                    <label>4.1 State <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="father_born_place_state_for_dc" name="father_born_place_state" class="form-control select2"
                                                                data-placeholder="Select State/UT"
                                                                onchange="checkValidation('dc', 'father_born_place_state_for_dc', selectStateValidationMessage);
                                                                    Domicile.listview.getDistrictData($(this), 'dc', 'father_born_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-father_born_place_state_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>4.2 District <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="father_born_place_district_for_dc" name="father_born_place_district" class="form-control select2"
                                                                data-placeholder="Select District"
                                                                onchange="checkValidation('dc', 'father_born_place_district_for_dc', selectDistrictValidationMessage);
                                                                    Domicile.listview.getVillageData($(this), 'dc', 'father_born_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-father_born_place_district_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>4.3 Village <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="father_born_place_village_for_dc" name="father_born_place_village" class="form-control select2"
                                                                data-placeholder="Select Village" onchange="checkValidation('dc', 'father_born_place_village_for_dc', selectVillageValidationMessage);">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-father_born_place_village_for_dc"></span>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="form-group col-sm-4 col-md-4">
                                                    <label>5. Original Native of<span class="color-nic-red">*</span></label><br/>
                                                    <label>5.1 State <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="father_native_place_state_for_dc" name="father_native_place_state" class="form-control select2"
                                                                data-placeholder="Select State/UT"
                                                                onchange="checkValidation('dc', 'father_native_place_state_for_dc', selectStateValidationMessage);
                                                                    Domicile.listview.getDistrictData($(this), 'dc', 'father_native_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-father_native_place_state_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>5.2 District <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="father_native_place_district_for_dc" name="father_native_place_district" class="form-control select2"
                                                                data-placeholder="Select District"
                                                                onchange="checkValidation('dc', 'father_native_place_district_for_dc', selectDistrictValidationMessage);
                                                                    Domicile.listview.getVillageData($(this), 'dc', 'father_native_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-father_native_place_district_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>5.3 Village <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="father_native_place_village_for_dc" name="father_native_place_village" class="form-control select2"
                                                                data-placeholder="Select Village" onchange="checkValidation('dc', 'father_native_place_village_for_dc', selectVillageValidationMessage);">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-father_native_place_village_for_dc"></span>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>6. Father's Occupation. <span class="color-nic-red">*</span></label>
                                                <select id="father_occupation_for_dc" name="father_occupation" class="form-control select2" onchange="checkValidation('domicile', 'father_occupation_for_dc', applicantOccupationValidationMessage);if(this.value == 12){$('.father_other_occupation_div_for_dc').show();}" data-placeholder="Select Occupation" style="width: 100%;">
                                                </select>
                                                <span class="error-message error-message-domicile-father_occupation_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6 col-md-6">
                                                <div class="father_other_occupation_div_for_dc" style="display: none;">
                                                    <label>6.1 Other Occupation Detail</label>
                                                    <input type="text" id="father_other_occupation_for_dc" name="father_other_occupation"
                                                           maxlength="100" class="form-control" value="{{father_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('domicile', 'father_other_occupation_for_dc', otherOccupationValidationMessage);"
                                                           >
                                                    <span class="error-message error-message-domicile-father_other_occupation_for_dc"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>7. Father's Aadhaar Number </label>
                                                <div class="input-group">
                                                    <input type="text" id="father_aadhaar_for_dc" name="father_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                           maxlength="15" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'father_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{father_aadhaar}}">
                                                </div>
                                                <span class="error-message error-message-domicile-father_aadhaar_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>8. Father's Election Number </label>
                                                <div class="input-group">
                                                    <input type="text" id="father_election_no_for_dc" name="father_election_no" class="form-control" placeholder="Enter Election Number"
                                                           maxlength="15" onblur="checkValidation('domicile', 'father_election_no_for_dc', electionNumberValidationMessage);" value="{{father_election_no}}">
                                                </div>
                                                <span class="error-message error-message-domicile-father_election_no_for_dc"></span>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                              <div class="card-header" style="background-color: lavenderblush;">
                                <h3 class="card-title">18. (b) Mother Information</h3>

                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body p-0 mother_info_div" style="display: none;">
                                <div class="">
                                  <div class="p-1 flex-fill" style="overflow: hidden">
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label>1. Name of Mother <span class="color-nic-red">*</span></label>
                                                    <input type="text" id="mother_name_for_dc" name="mother_name"
                                                           maxlength="100" class="form-control" value="{{mother_name}}" placeholder="Enter Mother Name !" onblur="checkValidation('domicile', 'mother_name_for_dc', motherNameValidationMessage);"
                                                           >
                                                    <span class="error-message error-message-domicile-mother_name_for_dc"></span>
                                                </div>
                                            </div>
                                            <div class="" style="background-color: aliceblue;">
                                                
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label>2. Mother's Address</label><br/>
                                                        <label>2.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" id="mother_house_no_for_dc" name="mother_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{mother_house_no}}" onblur="checkValidation('domicile', 'mother_house_no_for_dc', houseNoValidationMessage);">
                                                        </div>
                                                        <span class="error-message error-message-domicile-mother_house_no_for_dc"></span>
                                                    </div>
                                                    <div class="form-group col-sm-6" style="margin-top: 22px;">
                                                        <label>2.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" id="mother_house_name_for_dc" name="mother_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{mother_house_name}}" onblur="checkValidation('domicile', 'mother_house_name_for_dc', houseNameValidationMessage);">
                                                        </div>
                                                        <span class="error-message error-message-domicile-mother_house_name_for_dc"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label>2.3 Street <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                             <input type="text" id="mother_street_for_dc" name="mother_street" class="form-control" placeholder="Enter Street !"
                                                                   maxlength="100" onblur="checkValidation('domicile', 'mother_street_for_dc', streetValidationMessage);" value="{{mother_street}}">
                                                        </div>
                                                        <span class="error-message error-message-domicile-mother_street_for_dc"></span>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label>2.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                             <input type="text" id="mother_village_dmc_ward_for_dc" name="mother_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                                   maxlength="100" onblur="checkValidation('domicile', 'mother_village_dmc_ward_for_dc', villageNameValidationMessage);" value="{{mother_village_dmc_ward}}">
                                                        </div>
                                                        <span class="error-message error-message-domicile-mother_village_dmc_ward_for_dc"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label>2.5 Select City<span class="color-nic-red">*</span></label>
                                                        <div class="">
                                                            <select class="form-control select2" id="mother_city_for_dc" name="mother_city"
                                                                    data-placeholder="City !"  onblur="checkValidation('domicile', 'mother_city_for_dc', selectCityValidationMessage);" >
                                                                <option value="">Select City</option>
                                                                <option value="1">Nani Daman</option>
                                                                <option value="2">Moti Daman</option>
                                                            </select>
                                                        </div>
                                                        <span class="error-message error-message-domicile-mother_city_for_dc"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>3. Mother's Nationality <span class="color-nic-red">*</span></label>
                                                    <input type="text" id="mother_nationality_for_dc" name="mother_nationality" class="form-control" placeholder="Enter Mother's Nationality!"
                                                           maxlength="100" onblur="checkValidation('domicile', 'mother_nationality_for_dc', applicantNationalityValidationMessage);" value="{{mother_nationality}}">
                                                    <span class="error-message error-message-domicile-mother_nationality_for_dc"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="form-group col-sm-4 col-md-4">
                                                    <label>4. Applicant Birth Place<span class="color-nic-red">*</span></label><br/>
                                                    <label>4.1 State <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="mother_born_place_state_for_dc" name="mother_born_place_state" class="form-control select2"
                                                                data-placeholder="Select State/UT"
                                                                onchange="checkValidation('dc', 'mother_born_place_state_for_dc', selectStateValidationMessage);
                                                                    Domicile.listview.getDistrictData($(this), 'dc', 'mother_born_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-mother_born_place_state_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>4.2 District <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="mother_born_place_district_for_dc" name="mother_born_place_district" class="form-control select2"
                                                                data-placeholder="Select District"
                                                                onchange="checkValidation('dc', 'mother_born_place_district_for_dc', selectDistrictValidationMessage);
                                                                    Domicile.listview.getVillageData($(this), 'dc', 'mother_born_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-mother_born_place_district_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>4.3 Village <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="mother_born_place_village_for_dc" name="mother_born_place_village" class="form-control select2"
                                                                data-placeholder="Select Village" onchange="checkValidation('dc', 'mother_born_place_village_for_dc', selectVillageValidationMessage);">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-mother_born_place_village_for_dc"></span>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="form-group col-sm-4 col-md-4">
                                                    <label>5. Original Native of<span class="color-nic-red">*</span></label><br/>
                                                    <label>5.1 State <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="mother_native_place_state_for_dc" name="mother_native_place_state" class="form-control select2"
                                                                data-placeholder="Select State/UT"
                                                                onchange="checkValidation('dc', 'mother_native_place_state_for_dc', selectStateValidationMessage);
                                                                    Domicile.listview.getDistrictData($(this), 'dc', 'mother_native_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-mother_native_place_state_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>5.2 District <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="mother_native_place_district_for_dc" name="mother_native_place_district" class="form-control select2"
                                                                data-placeholder="Select District"
                                                                onchange="checkValidation('dc', 'mother_native_place_district_for_dc', selectDistrictValidationMessage);
                                                                    Domicile.listview.getVillageData($(this), 'dc', 'mother_native_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-mother_native_place_district_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>5.3 Village <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="mother_native_place_village_for_dc" name="mother_native_place_village" class="form-control select2"
                                                                data-placeholder="Select Village" onchange="checkValidation('dc', 'mother_native_place_village_for_dc', selectVillageValidationMessage);">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-mother_native_place_village_for_dc"></span>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>6. Mother's Occupation. <span class="color-nic-red">*</span></label>
                                                <select id="mother_occupation_for_dc" name="mother_occupation" class="form-control select2" onchange="checkValidation('domicile', 'mother_occupation_for_dc', applicantOccupationValidationMessage);if(this.value == 12){$('.mother_other_occupation_div_for_dc').show();}" data-placeholder="Select Occupation" style="width: 100%;">
                                                </select>
                                                <span class="error-message error-message-domicile-mother_occupation_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6 col-md-6">
                                                <div class="mother_other_occupation_div_for_dc" style="display: none;">
                                                    <label>6.1 Other Occupation Detail</label>
                                                    <input type="text" id="mother_other_occupation_for_dc" name="mother_other_occupation"
                                                           maxlength="100" class="form-control" value="{{mother_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('domicile', 'mother_other_occupation_for_dc', otherOccupationValidationMessage);"
                                                           >
                                                    <span class="error-message error-message-domicile-mother_other_occupation_for_dc"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>7. Mother's Aadhaar Number </label>
                                                <div class="input-group">
                                                    <input type="text" id="mother_aadhaar_for_dc" name="mother_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                           maxlength="15" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'mother_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{mother_aadhaar}}">
                                                </div>
                                                <span class="error-message error-message-domicile-mother_aadhaar_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>8. Mother's Election Number </label>
                                                <div class="input-group">
                                                    <input type="text" id="mother_election_no_for_dc" name="mother_election_no" class="form-control" placeholder="Enter Election Number"
                                                           maxlength="15" onblur="checkValidation('domicile', 'mother_election_no_for_dc', electionNumberValidationMessage);" value="{{mother_election_no}}">
                                                </div>
                                                <span class="error-message error-message-domicile-mother_election_no_for_dc"></span>
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
                    <div class="row marital_status_item_container_for_dc" style="display: none;">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                              <div class="card-header" style="background-color: lavenderblush;">
                                <h3 class="card-title">18. (c) Spouse Information</h3>

                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body p-0 spouse_info_div" style="display: none;">
                                <div class="">
                                  <div class="p-1 flex-fill" style="overflow: hidden">
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label>1. Name of Spouse <span class="color-nic-red">*</span></label>
                                                    <input type="text" id="spouse_name_for_dc" name="spouse_name"
                                                           maxlength="100" class="form-control" value="{{spouse_name}}" placeholder="Enter Spouse Name !" onblur="checkValidation('domicile', 'spouse_name_for_dc', spouseNameValidationMessage);"
                                                           >
                                                    <span class="error-message error-message-domicile-spouse_name_for_dc"></span>
                                                </div>
                                            </div>
                                            <div class="" style="background-color: aliceblue;">
                                                
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label>2. Spouse's Address</label><br/>
                                                        <label>2.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" id="spouse_house_no_for_dc" name="spouse_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{spouse_house_no}}" onblur="checkValidation('domicile', 'spouse_house_no_for_dc', houseNoValidationMessage);">
                                                        </div>
                                                        <span class="error-message error-message-domicile-spouse_house_no_for_dc"></span>
                                                    </div>
                                                    <div class="form-group col-sm-6" style="margin-top: 22px;">
                                                        <label>2.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" id="spouse_house_name_for_dc" name="spouse_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{spouse_house_name}}" onblur="checkValidation('domicile', 'spouse_house_name_for_dc', houseNameValidationMessage);">
                                                        </div>
                                                        <span class="error-message error-message-domicile-spouse_house_name_for_dc"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label>2.3 Street <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                             <input type="text" id="spouse_street_for_dc" name="spouse_street" class="form-control" placeholder="Enter Street !"
                                                                   maxlength="100" onblur="checkValidation('domicile', 'spouse_street_for_dc', streetValidationMessage);" value="{{spouse_street}}">
                                                        </div>
                                                        <span class="error-message error-message-domicile-spouse_street_for_dc"></span>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label>2.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                        <div class="input-group">
                                                             <input type="text" id="spouse_village_dmc_ward_for_dc" name="spouse_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                                   maxlength="100" onblur="checkValidation('domicile', 'spouse_village_dmc_ward_for_dc', villageNameValidationMessage);" value="{{spouse_village_dmc_ward}}">
                                                        </div>
                                                        <span class="error-message error-message-domicile-spouse_village_dmc_ward_for_dc"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label>2.5 Select City<span class="color-nic-red">*</span></label>
                                                        <div class="">
                                                            <select class="form-control select2" id="spouse_city_for_dc" name="spouse_city"
                                                                    data-placeholder="City !"  onblur="checkValidation('domicile', 'spouse_city_for_dc', selectCityValidationMessage);" >
                                                                <option value="">Select City</option>
                                                                <option value="1">Nani Daman</option>
                                                                <option value="2">Moti Daman</option>
                                                            </select>
                                                        </div>
                                                        <span class="error-message error-message-domicile-spouse_city_for_dc"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>3. Spouse's Nationality <span class="color-nic-red">*</span></label>
                                                    <input type="text" id="spouse_nationality_for_dc" name="spouse_nationality" class="form-control" placeholder="Enter Spouse's Nationality!"
                                                           maxlength="100" onblur="checkValidation('domicile', 'spouse_nationality_for_dc', applicantNationalityValidationMessage);" value="{{spouse_nationality}}">
                                                    <span class="error-message error-message-domicile-spouse_nationality_for_dc"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="form-group col-sm-4 col-md-4">
                                                    <label>4. Applicant Birth Place<span class="color-nic-red">*</span></label><br/>
                                                    <label>4.1 State <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="spouse_born_place_state_for_dc" name="spouse_born_place_state" class="form-control select2"
                                                                data-placeholder="Select State/UT"
                                                                onchange="checkValidation('dc', 'spouse_born_place_state_for_dc', selectStateValidationMessage);
                                                                    Domicile.listview.getDistrictData($(this), 'dc', 'spouse_born_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-spouse_born_place_state_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>4.2 District <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="spouse_born_place_district_for_dc" name="spouse_born_place_district" class="form-control select2"
                                                                data-placeholder="Select District"
                                                                onchange="checkValidation('dc', 'spouse_born_place_district_for_dc', selectDistrictValidationMessage);
                                                                    Domicile.listview.getVillageData($(this), 'dc', 'spouse_born_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-spouse_born_place_district_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>4.3 Village <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="spouse_born_place_village_for_dc" name="spouse_born_place_village" class="form-control select2"
                                                                data-placeholder="Select Village" onchange="checkValidation('dc', 'spouse_born_place_village_for_dc', selectVillageValidationMessage);">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-spouse_born_place_village_for_dc"></span>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="form-group col-sm-4 col-md-4">
                                                    <label>5. Original Native of<span class="color-nic-red">*</span></label><br/>
                                                    <label>5.1 State <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="spouse_native_place_state_for_dc" name="spouse_native_place_state" class="form-control select2"
                                                                data-placeholder="Select State/UT"
                                                                onchange="checkValidation('dc', 'spouse_native_place_state_for_dc', selectStateValidationMessage);
                                                                    Domicile.listview.getDistrictData($(this), 'dc', 'spouse_native_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-spouse_native_place_state_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>5.2 District <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="spouse_native_place_district_for_dc" name="spouse_native_place_district" class="form-control select2"
                                                                data-placeholder="Select District"
                                                                onchange="checkValidation('dc', 'spouse_native_place_district_for_dc', selectDistrictValidationMessage);
                                                                    Domicile.listview.getVillageData($(this), 'dc', 'spouse_native_place');">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-spouse_native_place_district_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                                    <label>5.3 Village <span class="color-nic-red">*</span></label>
                                                    <div class="">
                                                        <select id="spouse_native_place_village_for_dc" name="spouse_native_place_village" class="form-control select2"
                                                                data-placeholder="Select Village" onchange="checkValidation('dc', 'spouse_native_place_village_for_dc', selectVillageValidationMessage);">
                                                        </select>
                                                    </div>
                                                    <span class="error-message error-message-domicile-spouse_native_place_village_for_dc"></span>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>6. Spouse's Occupation. <span class="color-nic-red">*</span></label>
                                                <select id="spouse_occupation_for_dc" name="spouse_occupation" class="form-control select2" onchange="checkValidation('domicile', 'spouse_occupation_for_dc', applicantOccupationValidationMessage);if(this.value == 12){$('.spouse_other_occupation_div_for_dc').show();}" data-placeholder="Select Occupation" style="width: 100%;">
                                                </select>
                                                <span class="error-message error-message-domicile-spouse_occupation_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6 col-md-6">
                                                <div class="spouse_other_occupation_div_for_dc" style="display: none;">
                                                    <label>6.1 Other Occupation Detail</label>
                                                    <input type="text" id="spouse_other_occupation_for_dc" name="spouse_other_occupation"
                                                           maxlength="100" class="form-control" value="{{spouse_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('domicile', 'spouse_other_occupation_for_dc', otherOccupationValidationMessage);"
                                                           >
                                                    <span class="error-message error-message-domicile-spouse_other_occupation_for_dc"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>7. Spouse's Aadhaar Number </label>
                                                <div class="input-group">
                                                    <input type="text" id="spouse_aadhaar_for_dc" name="spouse_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                           maxlength="15" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'spouse_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{spouse_aadhaar}}">
                                                </div>
                                                <span class="error-message error-message-domicile-spouse_aadhaar_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>8. Spouse's Election Number </label>
                                                <div class="input-group">
                                                    <input type="text" id="spouse_election_no_for_dc" name="spouse_election_no" class="form-control" placeholder="Enter Election Number"
                                                           maxlength="15" onblur="checkValidation('domicile', 'spouse_election_no_for_dc', electionNumberValidationMessage);" value="{{spouse_election_no}}">
                                                </div>
                                                <span class="error-message error-message-domicile-spouse_election_no_for_dc"></span>
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
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>19. The Year from which he/she is residing in the U.T. Of Daman & Diu. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="residing_year_for_dc" name="residing_year" class="form-control" placeholder="Enter The Year from which he/she is residing in the U.T. Of Daman & Diu !" maxlength="100" value="{{residing_year}}" onblur="checkValidation('domicile', 'residing_year_for_dc', residingYearValidationMessage);">
                            </div>
                            <span class="error-message error-message-domicile-residing_year_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 required_purpose_for_dc_div" style="display: none">
                            <label>20. Purpose for which the Domicile Certificate is required. And before whom it is to be produced. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="required_purpose_for_dc" name="required_purpose" class="form-control" placeholder="Enter Purpose for which the Domicile Certificate is required !" maxlength="100" value="{{required_purpose}}" onblur="checkValidation('domicile', 'required_purpose_for_dc', purposeofDomicileValidationMessage);">
                            </div>
                            <span class="error-message error-message-domicile-required_purpose_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 select_required_purpose_for_dc">
                            <label>20. Purpose for which the Domicile Certificate is required. And before whom it is to be produced<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control select2" id="select_required_purpose_for_dc" name="select_required_purpose"
                                        data-placeholder="Purpose for which the Domicile Certificate is required !"  onblur="checkValidation('domicile', 'select_required_purpose_for_dc', purposeofDomicileValidationMessage);" onchange="if(this.value == 2){$('.other_required_purpose_for_dc_div').show();}">
                                    <option value="">Select Purpose for which the Domicile Certificate is required</option>
                                    <option value="1">Old Age Pension</option>
                                    <option value="2">Other</option>
                                </select>
                            </div>
                            <span class="error-message error-message-domicile-select_required_purpose_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6 other_required_purpose_for_dc_div" style="display: none">
                            <label>20.1 Other Detail of Purpose for which the Domicile Certificate is required. And before whom it is to be produced. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="other_required_purpose_for_dc" name="other_required_purpose" class="form-control" placeholder="Enter Other Detail of Purpose for which the Domicile Certificate is required !" maxlength="100" value="{{required_purpose}}" onblur="checkValidation('domicile', 'other_required_purpose_for_dc', purposeofDomicileValidationMessage);">
                            </div>
                            <span class="error-message error-message-domicile-other_required_purpose_for_dc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 name_of_school_for_dc_div" style="display: none">
                            <label>21. If Student, the place of study during the last 10 years (Name of school).</label>
                            <div class="input-group">
                                <input type="text" id="name_of_school_for_dc" name="name_of_school" class="form-control" placeholder="Enter If Student, the place of study during the last 10 years (Name of school) !" maxlength="100" value="{{name_of_school}}">
                            </div>
                            <span class="error-message error-message-domicile-name_of_school_for_dc"></span>
                        </div>
                    </div>
                    <div class="row during_last_10year_div" style="display: none">
                        <div class="form-group col-sm-6">
                            <label>21. If in business, the place of business during the last 10 years.</label>
                            <div class="input-group">
                                <input type="text" id="place_of_business_for_dc" name="place_of_business" class="form-control" placeholder="Enter If in business, the place of business during the last 10 years !" maxlength="100" value="{{place_of_business}}" >
                            </div>
                            <span class="error-message error-message-domicile-place_of_business_for_dc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>22. If employed, where employed during the last 10 years. </label>
                            <div class="input-group">
                                <input type="text" id="employed_during_years_for_dc" name="employed_during_years" class="form-control" placeholder="Enter If employed, where employed during the last 10 years !" maxlength="100" value="{{employed_during_years}}">
                            </div>
                            <span class="error-message error-message-domicile-employed_during_years_for_dc"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Upload Required Documents</h3>

                    <div class="row">
                        <div class="col-12 m-b-5px" id="applicant_photo_container_for_domicile">
                            <label>1. Applicant Photo (Latest) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-domicile-applicant_photo_for_domicile"></div>
                        </div>
                        <div class="form-group col-sm-12" id="applicant_photo_name_container_for_domicile" style="display: none;">
                            <label>1.. Applicant Photo (Latest)<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="applicant_photo_download"><img id="applicant_photo_name_image_for_domicile" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_domicile_{{VALUE_ONE}}"></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <!-- <div class="row">
                        <div class="form-group col-sm-6">
                            <label>21. Document Required to be Uploaded with the Application.<span class="color-nic-red">*</span></label>
                            <div id="document_upload_container_for_domicile_certificate"></div>
                            <span class="error-message error-message-domicile-certificate-document_upload_for_domicile_certificate"></span>
                        </div>
                    </div> -->

                    <div class="row">
                            <div  class="birth_certificate_item_container_for_domicile_certificate" style="display: none;"> 
                                <div class="col-12 m-b-5px" id="birth_certi_container_for_domicile">
                                <label>2. Birth Certificate <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-domicile-birth_certi_for_domicile"></div>
                                </div>
                                <div class="form-group col-sm-12" id="birth_certi_name_container_for_domicile" style="display: none;">
                                    <label>2. Birth Certificate<span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="birth_certi_download"><label id="birth_certi_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                    </div>        
                     
                    <div class="row">
                        <div  class="election_card_item_container_for_domicile_certificate" style="display: none;">
                            <div class="col-12 m-b-5px" id="election_card_container_for_domicile">
                                <label>3. Election Card <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-domicile-election_card_for_domicile"></div>
                            </div>
                            <div class="form-group col-sm-12" id="election_card_name_container_for_domicile" style="display: none;">
                                <label>3. Election Card <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="election_card_download"><label id="election_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>  
                    </div> 
                       
                    <div class="row">
                        <div  class="aadhar_card_item_container_for_domicile_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="aadhaar_card_container_for_domicile">
                                <label>4. Aadhaar Card<span style="color: red;">* <br>(Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-domicile-aadhaar_card_for_domicile"></div>
                            </div>
                            <div class="form-group col-sm-12" id="aadhaar_card_name_container_for_domicile" style="display: none;">
                                <label>4. Aadhaar Card <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="aadhaar_card_download"><label id="aadhaar_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div> 
                    </div>
                       
                    <div class="row">
                        <div  class="leaving_certificate_item_container_for_domicile_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="leaving_certi_container_for_domicile">
                            <label>5. Leaving Certificate <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-domicile-leaving_certi_for_domicile"></div>
                            </div>
                            <div class="form-group col-sm-12" id="leaving_certi_name_container_for_domicile" style="display: none;">
                                <label>5. Leaving Certificate<span style="color: red;">* </span></label><br>
                                <a target="_blank" id="leaving_certi_download"><label id="leaving_certi_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>   


                    <div class="row">
                        <div  class="marriage_certificate_item_container_for_domicile_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="marriage_certi_container_for_domicile">
                            <label>6. Marriage Certificate (if married or widow woman applied) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-domicile-marriage_certi_for_domicile"></div>
                            </div>
                            <div class="form-group col-sm-12" id="marriage_certi_name_container_for_domicile" style="display: none;">
                                <label>6. Marriage Certificate <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="marriage_certi_download"><label id="marriage_certi_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>     

                    <div class="row">
                        <div  class="proof_document_item_container_for_domicile_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="last_10year_proof_container_for_domicile">
                            <label>6. Last 10 years Proof Documents (i.e. Gas Book, Bank Book, House tax, Rent Receipts, Sale Deed, Agreement Copy, Children Birth and leaving Certificate) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-domicile-last_10year_proof_for_domicile"></div>
                            </div>
                            <div class="form-group col-sm-12" id="last_10year_proof_name_container_for_domicile" style="display: none;">
                                <label>6. Last 10 years Proof Documents <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="last_10year_proof_download"><label id="last_10year_proof_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row">
                        <div  class="income_proof_item_container_for_domicile_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="income_proof_container_for_domicile">
                            <label>5. Income Proof<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-domicile-income_proof_for_domicile"></div>
                            </div>
                            <div class="form-group col-sm-12" id="income_proof_name_container_for_domicile" style="display: none;">
                                <label>5. Income Proof <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="income_proof_download"><label id="income_proof_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row">
                        <div  class="gas_book_item_container_for_domicile_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="gas_book_container_for_domicile">
                            <label>7. Gas Book<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-domicile-gas_book_for_domicile"></div>
                            </div>
                            <div class="form-group col-sm-12" id="gas_book_name_container_for_domicile" style="display: none;">
                                <label>7. Gas Book <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="gas_book_download"><label id="gas_book_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div> 
                    <div class="row">
                        <div  class="bank_book_item_container_for_domicile_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="bank_book_container_for_domicile">
                            <label>8. Bank Book<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-domicile-bank_book_for_domicile"></div>
                            </div>
                            <div class="form-group col-sm-12" id="bank_book_name_container_for_domicile" style="display: none;">
                                <label>8. Bank Book <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="bank_book_download"><label id="bank_book_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div> 
                    <div class="row mb-2 have_you_own_house_container_div" style="display: none;">
                        <div class="col-sm-6">
                            <label>9. Do You have Your Own House ? <span class="color-nic-red">*</span></label>
                            <div id="have_you_own_house_container_for_domicile"></div>
                            <span class="error-message error-message-income-certificate-have_you_own_house_for_domicile"></span>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="house_tax_receipt_item_container_for_domicile col-sm-6" style="display: none;">
                            <div id="house_tax_receipt_container_for_domicile">
                                <label>9.1 House Tax Receipt <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-income-certificate-house_tax_receipt_for_domicile"></div>
                            </div>
                            <div class="form-group" id="house_tax_receipt_name_container_for_domicile" style="display: none;">
                                <label>8.1 House Tax Receipt <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="house_tax_receipt_download"><label id="house_tax_receipt_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="noc_with_notary_item_container_for_domicile col-sm-6" style="display: none;">
                            <div id="noc_with_notary_container_for_domicile">
                                <label>9.1 NOC With Notary alongwith Photo Attached <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-income-certificate-noc_with_notary_for_domicile"></div>
                            </div>
                            <div class="form-group" id="noc_with_notary_name_container_for_domicile" style="display: none;">
                                <label>8.1 NOC With Notary alongwith Photo Attached <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="noc_with_notary_download"><label id="noc_with_notary_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <br/>

                    <hr class="m-b-1rem"> 
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Declaration </h3>
                    <hr class="m-b-5px">
                    <div class="form-group col-md-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="declaration1" name="declaration1" value="{{IS_CHECKED_YES}}">&nbsp;I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein. I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the punishment as per the law and that the benefits availed by me shall be summarily withdrawn.
                            </label>
                        </div>
                        <div class="error-message error-message-dc-declaration1"></div>
                    </div>
                    <div class="form-group col-md-12">
                         This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian
                    </div>
                    <div class="form-group col-md-12">
                        Penal Code which state as follows :-
                    </div>
                    <div class="form-group col-md-12">
                        Section 199. False statement made in declaration which is by law receivable as evidence:-
                        Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or any Public Servant or other person, is bound or authorized bylaw to receive as evidence of any fact, makes any statement which is false, and which he either knows or believes to be false or does not believe to be true, touching any point material to the object for which the declaration is made or used, shall be punished in the same manner as if he gave false evidence.
                    </div>
                    <div class="form-group col-md-12">
                        Section 200. Using as true such declaration knowing it to be false:- Whoever corruptly uses or attempts to use as true any such declaration, knowing the same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
                    </div>
                    <div class="form-group col-md-12">
                        Explanation :- A declaration which is inadmissible merely upon the ground of some informality, is a declaration within the meaning of Sections 199 and 200.
                    </div>
                    <!-- <div class="form-group">
                        <button type="button" id="draft_btn_for_domicile" class="btn btn-sm btn-success pull-right" onclick="Domicile.listview.submitDomicile({{VALUE_TWO}});" style="margin-right: 5px;">Next  <span class="fas fa-hand-point-right"></span></button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Domicile.listview.loadDomicileData();">Cancel</button>
                    </div> -->
                    <div class="form-group">
                        <button type="button" id="submit_btn_for_domicile" class="btn btn-sm btn-success" onclick="Domicile.listview.askForSubmitDomicile({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="Domicile.listview.loadDomicileData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>