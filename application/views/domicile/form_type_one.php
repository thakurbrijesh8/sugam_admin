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
                                    <select id="district" name="district"  class="form-control select2"
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
                                    <label>2. Full Name of Applicant <span class="color-nic-red">*</span></label>
                                    <input type="text" id="name_of_applicant_for_dc" name="name_of_applicant" class="form-control" placeholder="Enter Full Name of Applicant !"
                                           maxlength="100" onblur="checkValidation('domicile', 'name_of_applicant_for_dc', applicantNameValidationMessage);" value="{{domicile_data.name_of_applicant}}">
                                    <span class="error-message error-message-domicile-name_of_applicant_for_dc"></span>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>3. Applicant’s Communication Address</label><br/>
                                    <label>3.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                    <input type="text" id="com_addr_house_no_for_dc" name="com_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{domicile_data.com_addr_house_no}}" onblur="checkValidation('domicile', 'com_addr_house_no_for_dc', houseNoValidationMessage);">
                                    <span class="error-message error-message-domicile-com_addr_house_no_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4" style="margin-top: 22px;">
                                    <label>3.2 Building Name / House Name</label>
                                    <input type="text" id="com_addr_house_name_for_dc" name="com_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{domicile_data.com_addr_house_name}}">
                                    <span class="error-message error-message-domicile-com_addr_house_name_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4" style="margin-top: 22px;">
                                    <label>3.3 Street <span class="color-nic-red">*</span></label>
                                    <input type="text" id="com_addr_street_for_dc" name="com_addr_street" class="form-control" placeholder="Enter Street !"
                                           maxlength="100" onblur="checkValidation('domicile', 'com_addr_street_for_dc', streetValidationMessage);" value="{{domicile_data.com_addr_street}}">
                                    <span class="error-message error-message-domicile-com_addr_street_for_dc"></span>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>3.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                    <input type="text" id="com_addr_village_dmc_ward_for_dc" name="com_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                           maxlength="100" onblur="checkValidation('domicile', 'com_addr_village_dmc_ward_for_dc', villageNameValidationMessage);" value="{{domicile_data.com_addr_village_dmc_ward}}" readonly="">
                                    <span class="error-message error-message-domicile-com_addr_village_dmc_ward_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>3.5 Select City<span class="color-nic-red">*</span></label>
                                    <input type="text" id="com_addr_city_for_dc" name="com_addr_city" class="form-control" placeholder="Enter City !"
                                           maxlength="100" onblur="checkValidation('domicile', 'com_addr_city_for_dc', selectCityValidationMessage);" onchange="Domicile.listview.getPincode($(this));" value="{{domicile_data.com_addr_city}}" readonly="">
                                    <span class="error-message error-message-domicile-com_addr_city_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>3.6 Pincode <span class="color-nic-red">*</span></label>
                                    <input type="text" id="pincode_for_dc" name="pincode" class="form-control" placeholder="Enter Pincode !"
                                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('domicile', 'pincode_for_dc', pincodeValidationMessage);" value="{{domicile_data.pincode}}" >
                                    <span class="error-message error-message-domicile-pincode_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>5. Applicant’s Mobile Number <span class="color-nic-red">*</span></label>
                                    <input type="text" id="mobile_number_for_dc" name="mobile_number" class="form-control" placeholder="Enter Mobile Number !"
                                           maxlength="10" onkeyup="checkNumeric($(this));"  onblur="checkValidationForMobileNumber('domicile', 'mobile_number_for_dc', mobileValidationMessage);" value="{{domicile_data.mobile_number}}">
                                    <span class="error-message error-message-domicile-mobile_number_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>6. Applicant Nationality <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_nationality_for_dc" name="applicant_nationality" class="form-control" placeholder="Enter Applicant Nationality!"
                                           maxlength="100" onblur="checkValidation('domicile', 'applicant_nationality_for_dc', applicantNationalityValidationMessage);" value="{{domicile_data.applicant_nationality}}">
                                    <span class="error-message error-message-domicile-applicant_nationality_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>7. Applicant’s Aadhaar Number<span class="color-nic-red">*</span> </label>
                                    <input type="text" id="aadhaar_for_dc" name="aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                           maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{domicile_data.aadhaar}}">
                                    <span class="error-message error-message-domicile-aadhaar_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>8. Applicant’s Election Number </label>
                                    <input type="text" id="election_no_for_dc" name="election_no" class="form-control" placeholder="Enter Election Number"
                                           maxlength="15" value="{{domicile_data.election_no}}">
                                    <span class="error-message error-message-domicile-election_no_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>9. Applicant Date of Birth<span style="color: red;">*</span></label>
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
                                    <label>9.1 Applicant Age<span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_age_for_dc" 
                                           name="applicant_age" class="form-control"
                                           placeholder="Enter Applicant Age !" maxlength="100" 
                                           onblur="checkValidation('domicile', 'applicant_age_for_dc', applicantAgeValidationMessage);"
                                           value="{{domicile_data.applicant_age}}" readonly="">
                                    <span class="error-message error-message-domicile-applicant_age_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>10. Applicant Birth Place<span class="color-nic-red">*</span></label><br/>
                                    <label>10.1 State <span class="color-nic-red">*</span></label>
                                    <select id="born_place_state_for_dc" name="born_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('dc', 'born_place_state_for_dc', selectStateValidationMessage);
                                                Domicile.listview.getDistrictData($(this), 'dc', 'born_place');">
                                    </select>
                                    <span class="error-message error-message-domicile-born_place_state_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                    <label>10.2 District <span class="color-nic-red">*</span></label>
                                    <select id="born_place_district_for_dc" name="born_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('dc', 'born_place_district_for_dc', selectDistrictValidationMessage);
                                                Domicile.listview.getVillageData($(this), 'dc', 'born_place');">
                                    </select>
                                    <span class="error-message error-message-domicile-born_place_district_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                    <label>10.3 Village <span class="color-nic-red">*</span></label>
                                    <select id="born_place_village_for_dc" name="born_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('dc', 'born_place_village_for_dc', selectVillageValidationMessage);">
                                    </select>
                                    <span class="error-message error-message-domicile-born_place_village_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>11. Original Native of Applicant<span class="color-nic-red">*</span></label><br/>
                                    <label>11.1 State <span class="color-nic-red">*</span></label>
                                    <select id="native_place_state_for_dc" name="native_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('dc', 'native_place_state_for_dc', selectStateValidationMessage);
                                                Domicile.listview.getDistrictFornDataForNative($(this), 'native_place');">
                                    </select>
                                    <span class="error-message error-message-domicile-native_place_state_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                    <label>11.2 District <span class="color-nic-red">*</span></label>
                                    <select id="native_place_district_for_dc" name="native_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('dc', 'native_place_district_for_dc', selectDistrictValidationMessage);
                                                Domicile.listview.getVillageDataForNative($(this), 'native_place');">
                                    </select>
                                    <span class="error-message error-message-domicile-native_place_district_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                    <label>11.3 Village <span class="color-nic-red">*</span></label>
                                    <select id="native_place_village_for_dc" name="native_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('dc', 'native_place_village_for_dc', selectVillageValidationMessage);">
                                    </select>
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
                            <div class="row marital_status_item_container_for_dc">
                                <div class="form-group col-sm-6">
                                    <label>13. Marital Status<span class="color-nic-red">*</span></label>
                                    <div id="marital_status_container_for_dc"></div>
                                    <span class="error-message error-message-domicile-marital_status_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>14. Nearest Police Station. <span class="color-nic-red">*</span></label>
                                    <input type="text" id="nearest_police_station_for_dc" name="nearest_police_station" class="form-control" placeholder="Enter Nearest Police Station !" maxlength="100" value="{{domicile_data.nearest_police_station}}" onblur="checkValidation('domicile', 'nearest_police_station_for_dc', nearestPoliceStationValidationMessage);">
                                    <span class="error-message error-message-domicile-nearest_police_station_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>15. Nearest Post Office. <span class="color-nic-red">*</span></label>
                                    <input type="text" id="nearest_post_office_for_dc" name="nearest_post_office" class="form-control" placeholder="Enter Nearest Post Office !" maxlength="100" value="{{domicile_data.nearest_post_office}}" onblur="checkValidation('domicile', 'nearest_post_office_for_dc', nearestPostOfficeValidationMessage);">
                                    <span class="error-message error-message-domicile-nearest_post_office_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>16. Applicant Occupation. <span class="color-nic-red">*</span></label>
                                    <select id="occupation_for_dc" name="occupation" class="form-control select2" onchange="checkValidation('domicile', 'occupation_for_dc', applicantOccupationValidationMessage); if (this.value == 12){$('.other_occupation_div_for_dc').show(); } else{$('.other_occupation_div_for_dc').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-domicile-occupation_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <div class="other_occupation_div_for_dc" style="display: none;">
                                        <label>16.1 Other Occupation Detail</label>
                                        <input type="text" id="other_occupation_for_dc" name="other_occupation"
                                               maxlength="100" class="form-control" value="{{domicile_data.other_occupation}}" placeholder="Enter Other Occupation !" onblur="checkValidation('domicile', 'other_occupation_for_dc', otherOccupationValidationMessage);"
                                               >
                                        <span class="error-message error-message-domicile-other_occupation_for_dc"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>17. Applicant Education. <span class="color-nic-red">*</span></label>
                                    <select id="applicant_education_for_dc" name="applicant_education" class="form-control select2" onchange="checkValidation('domicile', 'applicant_education_for_dc', applicantEducationValidationMessage);if (this.value == 5){$('.other_education_div_for_dc').show(); } else{$('.other_education_div_for_dc').hide(); }" data-placeholder="Select Education" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-domicile-applicant_education_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 other_education_div_for_dc" style="display: none">
                                    <label>Other Education Details <span class="color-nic-red">*</span></label>
                                    <input type="text" id="other_education_detail_for_dc" name="other_education_detail"
                                           maxlength="50" class="form-control" value="{{domicile_data.other_education_detail}}" placeholder="Other Education Details !" onblur="checkValidation('domicile', 'other_education_detail_for_dc', applicantEducationValidationMessage);"
                                           >
                                    <span class="error-message error-message-domicile-other_education_detail_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>17.1 Name of School / Collage / Institute <span class="color-nic-red">*</span></label>
                                    <input type="text" id="name_of_school_for_dc" name="name_of_school"
                                           maxlength="100" class="form-control" value="{{domicile_data.name_of_school}}" placeholder="Enter Name of School / Collage / Institute !" onblur="checkValidation('domicile', 'name_of_school_for_dc', schoolNameValidationMessage);"
                                           >
                                    <span class="error-message error-message-domicile-name_of_school_for_dc"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row father_info_item_container_for_dc">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1">
                                    <h3 class="card-title">18. (a) Father Information</h3>

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
                                                <label>Did Your Father is Alive ? <span class="color-nic-red">*</span></label>
                                                <div id="father_alive_container_for_dc"></div>
                                                <span class="error-message error-message-caste-certificate-father_alive_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>1. Name of Father <span class="color-nic-red">*</span></label>
                                                <input type="text" id="father_name_for_dc" name="father_name"
                                                       maxlength="100" class="form-control" value="{{father_data.father_name}}" placeholder="Enter Father Name !" onblur="checkValidation('domicile', 'father_name_for_dc', fatherNameValidationMessage);"
                                                       >
                                                <span class="error-message error-message-domicile-father_name_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>1.1 Father's Nationality <span class="color-nic-red">*</span></label>
                                                <input type="text" id="father_nationality_for_dc" name="father_nationality" class="form-control" placeholder="Enter Father's Nationality!"
                                                       maxlength="100" onblur="checkValidation('domicile', 'father_nationality_for_dc', applicantNationalityValidationMessage);" value="{{father_data.father_nationality}}">
                                                <span class="error-message error-message-domicile-father_nationality_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label>2. Father's Birth Place<span class="color-nic-red">*</span></label><br/>
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
                                            </div>
                                            <span class="error-message error-message-domicile-father_born_pincode_for_dc"></span>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label>3. Original Native of Father<span class="color-nic-red">*</span></label><br/>
                                                <label>3.1 State <span class="color-nic-red">*</span></label>
                                                <select id="father_native_place_state_for_dc" name="father_native_place_state" class="form-control select2"
                                                        data-placeholder="Select State/UT"
                                                        onchange="checkValidation('dc', 'father_native_place_state_for_dc', selectStateValidationMessage);
                                                            Domicile.listview.getDistrictFornDataForNative($(this), 'father_native_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-father_native_place_state_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.2 District <span class="color-nic-red">*</span></label>
                                                <select id="father_native_place_district_for_dc" name="father_native_place_district" class="form-control select2"
                                                        data-placeholder="Select District"
                                                        onchange="checkValidation('dc', 'father_native_place_district_for_dc', selectDistrictValidationMessage);
                                                            Domicile.listview.getVillageDataForNative($(this), 'father_native_place');">
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
                                                    <label>4.1 Father's Aadhaar Number </label>
                                                    <input type="text" id="father_aadhaar_for_dc" name="father_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                           maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'father_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{father_data.father_aadhaar}}">
                                                    <span class="error-message error-message-domicile-father_aadhaar_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>4.2 Father's Election Number </label>
                                                    <input type="text" id="father_election_no_for_dc" name="father_election_no" class="form-control" placeholder="Enter Election Number"
                                                           maxlength="15" value="{{father_data.father_election_no}}">
                                                    <span class="error-message error-message-domicile-father_election_no_for_dc"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>5. Father's Occupation. </label>
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
                                </div><!-- /.d-md-flex -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="row mother_info_item_container_for_dc">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1">
                                    <h3 class="card-title">18. (b) Mother Information</h3>

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
                                                <label>Did Your Mother is Alive ? <span class="color-nic-red">*</span></label>
                                                <div id="mother_alive_container_for_dc"></div>
                                                <span class="error-message error-message-caste-certificate-mother_alive_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>1. Name of Mother <span class="color-nic-red">*</span></label>
                                                <input type="text" id="mother_name_for_dc" name="mother_name"
                                                       maxlength="100" class="form-control" value="{{mother_data.mother_name}}" placeholder="Enter Mother Name !" onblur="checkValidation('domicile', 'mother_name_for_dc', motherNameValidationMessage);"
                                                       >
                                                <span class="error-message error-message-domicile-mother_name_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>1.1 Mother's Nationality <span class="color-nic-red">*</span></label>
                                                <input type="text" id="mother_nationality_for_dc" name="mother_nationality" class="form-control" placeholder="Enter Mother's Nationality!"
                                                       maxlength="100" onblur="checkValidation('domicile', 'mother_nationality_for_dc', applicantNationalityValidationMessage);" value="{{mother_data.mother_nationality}}">
                                                <span class="error-message error-message-domicile-mother_nationality_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label>2. Mother's Birth Place<span class="color-nic-red">*</span></label><br/>
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
                                                <label>3. Original Native of Mother<span class="color-nic-red">*</span></label><br/>
                                                <label>3.1 State <span class="color-nic-red">*</span></label>
                                                <select id="mother_native_place_state_for_dc" name="mother_native_place_state" class="form-control select2"
                                                        data-placeholder="Select State/UT"
                                                        onchange="checkValidation('dc', 'mother_native_place_state_for_dc', selectStateValidationMessage);
                                                            Domicile.listview.getDistrictFornDataForNative($(this), 'mother_native_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-mother_native_place_state_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.2 District <span class="color-nic-red">*</span></label>
                                                <select id="mother_native_place_district_for_dc" name="mother_native_place_district" class="form-control select2"
                                                        data-placeholder="Select District"
                                                        onchange="checkValidation('dc', 'mother_native_place_district_for_dc', selectDistrictValidationMessage);
                                                            Domicile.listview.getVillageDataForNative($(this), 'mother_native_place');">
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
                                                    <label>4.1 Mother's Aadhaar Number </label>
                                                    <input type="text" id="mother_aadhaar_for_dc" name="mother_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                           maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'mother_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{mother_data.mother_aadhaar}}">
                                                    <span class="error-message error-message-domicile-mother_aadhaar_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>4.2 Mother's Election Number </label>
                                                    <input type="text" id="mother_election_no_for_dc" name="mother_election_no" class="form-control" placeholder="Enter Election Number"
                                                           maxlength="15" value="{{mother_data.mother_election_no}}">
                                                    <span class="error-message error-message-domicile-mother_election_no_for_dc"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>5. Mother's Occupation. </label>
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
                    <div class="row spouse_info_item_container_for_dc" style="display: none;">
                        <div class="col-sm-12">
                            <div class="card collapsed-card">
                                <div class="card-header bg-nic-blue pt-1">
                                    <h3 class="card-title">18. (c) Spouse Information</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0 spouse_info_div border-nic-blue" style="display: none;">
                                    <div class="p-1 flex-fill" style="overflow: hidden">
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>Did Your Spouse is Alive ? <span class="color-nic-red">*</span></label>
                                                <div id="spouse_alive_container_for_dc"></div>
                                                <span class="error-message error-message-domicile-spouse_alive_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>1. Name of Spouse <span class="color-nic-red">*</span></label>
                                                <input type="text" id="spouse_name_for_dc" name="spouse_name"
                                                       maxlength="100" class="form-control" value="{{spouse_data.spouse_name}}" placeholder="Enter Spouse Name !" onblur="checkValidation('domicile', 'spouse_name_for_dc', spouseNameValidationMessage);"
                                                       >
                                                <span class="error-message error-message-domicile-spouse_name_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>1.1 Spouse's Nationality <span class="color-nic-red">*</span></label>
                                                <input type="text" id="spouse_nationality_for_dc" name="spouse_nationality" class="form-control" placeholder="Enter Spouse's Nationality!"
                                                       maxlength="100" onblur="checkValidation('domicile', 'spouse_nationality_for_dc', applicantNationalityValidationMessage);" value="{{spouse_data.spouse_nationality}}">
                                                <span class="error-message error-message-domicile-spouse_nationality_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label>2. Spouse's Birth Place<span class="color-nic-red">*</span></label><br/>
                                                <label>2.1 State <span class="color-nic-red">*</span></label>
                                                <select id="spouse_born_place_state_for_dc" name="spouse_born_place_state" class="form-control select2"
                                                        data-placeholder="Select State/UT"
                                                        onchange="checkValidation('dc', 'spouse_born_place_state_for_dc', selectStateValidationMessage);
                                                            Domicile.listview.getDistrictData($(this), 'dc', 'spouse_born_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-spouse_born_place_state_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>2.2 District <span class="color-nic-red">*</span></label>
                                                <select id="spouse_born_place_district_for_dc" name="spouse_born_place_district" class="form-control select2"
                                                        data-placeholder="Select District"
                                                        onchange="checkValidation('dc', 'spouse_born_place_district_for_dc', selectDistrictValidationMessage);
                                                            Domicile.listview.getVillageData($(this), 'dc', 'spouse_born_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-spouse_born_place_district_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>2.3 Village <span class="color-nic-red">*</span></label>
                                                <select id="spouse_born_place_village_for_dc" name="spouse_born_place_village" class="form-control select2"
                                                        data-placeholder="Select Village" onchange="checkValidation('dc', 'spouse_born_place_village_for_dc', selectVillageValidationMessage);">
                                                </select>
                                                <span class="error-message error-message-domicile-spouse_born_place_village_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>2.4 Pincode <span class="color-nic-red">*</span></label>
                                                <input type="text" id="spouse_born_pincode_for_dc" name="spouse_born_pincode" class="form-control" placeholder="Enter Pincode !"
                                                       maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('domicile', 'spouse_born_pincode_for_dc', pincodeValidationMessage);" value="{{spouse_data.spouse_born_pincode}}">
                                                <span class="error-message error-message-domicile-spouse_born_pincode_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-3 col-md-3">
                                                <label>3. Original Native of Spouse<span class="color-nic-red">*</span></label><br/>
                                                <label>3.1 State <span class="color-nic-red">*</span></label>
                                                <select id="spouse_native_place_state_for_dc" name="spouse_native_place_state" class="form-control select2"
                                                        data-placeholder="Select State/UT"
                                                        onchange="checkValidation('dc', 'spouse_native_place_state_for_dc', selectStateValidationMessage);
                                                            Domicile.listview.getDistrictFornDataForNative($(this), 'spouse_native_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-spouse_native_place_state_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.2 District <span class="color-nic-red">*</span></label>
                                                <select id="spouse_native_place_district_for_dc" name="spouse_native_place_district" class="form-control select2"
                                                        data-placeholder="Select District"
                                                        onchange="checkValidation('dc', 'spouse_native_place_district_for_dc', selectDistrictValidationMessage);
                                                            Domicile.listview.getVillageDataForNative($(this), 'spouse_native_place');">
                                                </select>
                                                <span class="error-message error-message-domicile-spouse_native_place_district_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.3 Village <span class="color-nic-red">*</span></label>
                                                <select id="spouse_native_place_village_for_dc" name="spouse_native_place_village" class="form-control select2"
                                                        data-placeholder="Select Village" onchange="checkValidation('dc', 'spouse_native_place_village_for_dc', selectVillageValidationMessage);">
                                                </select>
                                                <span class="error-message error-message-domicile-spouse_native_place_village_for_dc"></span>
                                            </div>
                                            <div class="form-group col-sm-3 col-md-3" style="margin-top:22px">
                                                <label>3.4 Pincode <span class="color-nic-red">*</span></label>
                                                <input type="text" id="spouse_native_pincode_for_dc" name="spouse_native_pincode" class="form-control" placeholder="Enter Pincode !"
                                                       maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('domicile', 'spouse_native_pincode_for_dc', pincodeValidationMessage);" value="{{spouse_data.spouse_native_pincode}}">
                                                <span class="error-message error-message-domicile-spouse_native_pincode_for_dc"></span>
                                            </div>
                                        </div>
                                        <div class="is_spouse_alive_container_for_dc">
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>4.1 Spouse's Aadhaar Number </label>
                                                    <input type="text" id="spouse_aadhaar_for_dc" name="spouse_aadhaar" class="form-control" placeholder="Enter Aadhaar Number"
                                                           maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('domicile', 'spouse_aadhaar_for_dc', invalidAadharNumberValidationMessage);" value="{{spouse_data.spouse_aadhaar}}">
                                                    <span class="error-message error-message-domicile-spouse_aadhaar_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>4.2 Spouse's Election Number </label>
                                                    <input type="text" id="spouse_election_no_for_dc" name="spouse_election_no" class="form-control" placeholder="Enter Election Number"
                                                           maxlength="15" value="{{spouse_data.spouse_election_no}}">
                                                    <span class="error-message error-message-domicile-spouse_election_no_for_dc"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label>5. Spouse's Occupation. </label>
                                                    <select id="spouse_occupation_for_dc" name="spouse_occupation" class="form-control select2" onchange="checkValidation('domicile', 'spouse_occupation_for_dc', applicantOccupationValidationMessage); if (this.value == 12){$('.spouse_other_occupation_div_for_dc').show(); } else{$('.spouse_other_occupation_div_for_dc').hide(); }" data-placeholder="Select Occupation" style="width: 100%;">
                                                    </select>
                                                    <span class="error-message error-message-domicile-spouse_occupation_for_dc"></span>
                                                </div>
                                                <div class="form-group col-sm-6 col-md-6">
                                                    <div class="spouse_other_occupation_div_for_dc" style="display: none;">
                                                        <label>5.1 Other Occupation Detail</label>
                                                        <input type="text" id="spouse_other_occupation_for_dc" name="spouse_other_occupation"
                                                               maxlength="100" class="form-control" value="{{spouse_data.spouse_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('domicile', 'spouse_other_occupation_for_dc', otherOccupationValidationMessage);"
                                                               >
                                                        <span class="error-message error-message-domicile-spouse_other_occupation_for_dc"></span>
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
                                <div class="col-12 f-w-b">More Details</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <label>19. The Year from which he/she is residing in the U.T. Of Daman & Diu. <span class="color-nic-red">*</span></label>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>19.1 Years <span class="color-nic-red">*</span></label>
                                    <select id="residing_year_for_dc" name="residing_year" class="form-control select2 year" onchange="checkValidation('domicile', 'residing_year_for_dc', residingYearValidationMessage);" data-placeholder="Year" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-domicile-residing_year_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>19.2 Months <span class="color-nic-red">*</span></label>
                                    <select id="residing_month_for_dc" name="residing_month" class="form-control select2 month" onchange="checkValidation('domicile', 'residing_month_for_dc', residingMonthValidationMessage);" data-placeholder="Months" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-domicile-residing_month_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-4 col-md-4">
                                    <label>19.3 Days <span class="color-nic-red">*</span></label>
                                    <select id="residing_days_for_dc" name="residing_days" class="form-control select2 days" onchange="checkValidation('domicile', 'residing_days_for_dc', residingDaysValidationMessage);" data-placeholder="Days" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-domicile-residing_days_for_dc"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 select_required_purpose_for_dc">
                                    <label>20. Purpose for which the Domicile Certificate is required. And before whom it is to be produced<span class="color-nic-red">*</span></label>
                                    <select class="form-control select2" id="select_required_purpose_for_dc" name="select_required_purpose"
                                            data-placeholder="Purpose for which the Domicile Certificate is required !"  onblur="checkValidation('domicile', 'select_required_purpose_for_dc', purposeofDomicileValidationMessage);" onchange="if (this.value == 5){$('.other_required_purpose_for_dc_div').show(); } else{$('.other_required_purpose_for_dc_div').hide(); }">
                                        <option value="">Select Purpose for which the Domicile Certificate is required</option>
                                    </select>
                                    <span class="error-message error-message-domicile-select_required_purpose_for_dc"></span>
                                </div>
                                <div class="form-group col-sm-6 other_required_purpose_for_dc_div" style="display: none">
                                    <label>20.1 Other Detail of Purpose for which the Domicile Certificate is required. And before whom it is to be produced. <span class="color-nic-red">*</span></label>
                                    <input type="text" id="other_required_purpose_for_dc" name="other_required_purpose" class="form-control" placeholder="Enter Other Detail of Purpose for which the Domicile Certificate is required !" maxlength="100" value="{{domicile_data.required_purpose}}" onblur="checkValidation('domicile', 'other_required_purpose_for_dc', purposeofDomicileValidationMessage);">
                                    <span class="error-message error-message-domicile-other_required_purpose_for_dc"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Upload Required Documents</h3> -->

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
                                    <label>1. Applicant Photo (Latest) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-domicile-applicant_photo_for_domicile"></div>
                                </div>
                                <div class="form-group col-sm-12" id="applicant_photo_name_container_for_domicile" style="display: none;">
                                    <label>1. Applicant Photo (Latest)<span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="applicant_photo_download"><img id="applicant_photo_name_image_for_domicile" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_domicile_{{VALUE_ONE}}"></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row">
                                <div  class="birth_certificate_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="birth_certi_container_for_domicile">
                                        <label>2. Applicant Original Birth Certificate / Leaving Certificate <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-birth_certi_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="birth_certi_name_container_for_domicile" style="display: none;">
                                        <label>2. Applicant Original Birth Certificate / Leaving Certificate<span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="birth_certi_download"><label id="birth_certi_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>        

                            <div class="row">
                                <div  class="election_card_item_container_for_domicile_certificate" >
                                    <div class="col-12 m-b-5px" id="election_card_container_for_domicile">
                                        <label>3. Applicant Original Election Card <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-election_card_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="election_card_name_container_for_domicile" style="display: none;">
                                        <label>3. Applicant Original Election Card <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="election_card_download"><label id="election_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>  
                            </div> 

                            <div class="row">
                                <div  class="aadhar_card_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="aadhaar_card_container_for_domicile">
                                        <label>4. Applicant Original Aadhaar Card<span style="color: red;">* <br>(Maximum File Size: 1MB)(Upload pdf Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-aadhaar_card_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="aadhaar_card_name_container_for_domicile" style="display: none;">
                                        <label>4. Applicant Original Aadhaar Card <span style="color: red;">* </span></label><br>
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
                                                <label>5. Applicant Father Birth Certificate/Leaving Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-father_birth_certificate_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="father_birth_certificate_name_container_for_domicile" style="display: none;">
                                                <label>5. Applicant Father Birth Certificate/Leaving Certificate <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="father_birth_certificate_download"><label id="father_birth_certificate_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYTHREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYTHREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="father_election_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="father_election_card_container_for_dc">
                                                <label>6. Applicant Father Election Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-father_election_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="father_election_card_name_container_for_domicile" style="display: none;">
                                                <label>6. Applicant Father Election Card <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="father_election_card_download"><label id="father_election_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYFOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYFOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="father_aadhar_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="father_aadhar_card_container_for_dc">
                                                <label>7. Applicant Father Aadhar Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-father_aadhar_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="father_aadhar_card_name_container_for_domicile" style="display: none;">
                                                <label>7. Applicant Father Aadhar Card <span style="color: red;">* </span></label><br>
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
                                                <label>8. Applicant Father Death Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-father_death_proof_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="father_death_proof_name_container_for_domicile" style="display: none;">
                                                <label>8. Applicant Father Death Certificate <span style="color: red;">* </span></label><br>
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
                                                <label>9. Applicant Mother Birth Certificate/Leaving Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-mother_birth_certificate_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="mother_birth_certificate_name_container_for_domicile" style="display: none;">
                                                <label>9. Applicant Mother Birth Certificate/Leaving Certificate <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="mother_birth_certificate_download"><label id="mother_birth_certificate_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYSEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYSEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="mother_election_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="mother_election_card_container_for_dc">
                                                <label>10. Applicant Mother Election Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-mother_election_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="mother_election_card_name_container_for_domicile" style="display: none;">
                                                <label>10. Applicant Mother Election Card <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="mother_election_card_download"><label id="mother_election_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_TWENTYEIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYEIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="mother_aadhar_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="mother_aadhar_card_container_for_dc">
                                                <label>11. Applicant Mother Aadhar Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-mother_aadhar_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="mother_aadhar_card_name_container_for_domicile" style="display: none;">
                                                <label>11. Applicant Mother Aadhar Card <span style="color: red;">* </span></label><br>
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
                                                <label>12. Applicant Mother Death Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-mother_death_proof_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="mother_death_proof_name_container_for_domicile" style="display: none;">
                                                <label>12. Applicant Mother Death Certificate <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="mother_death_proof_download"><label id="mother_death_proof_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_THIRTY}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTY}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="spouse_proof_file_container_for_dc">
                                <div class="spouse_proof_item_container_for_dc" style="display: none;">
                                    <div class="row">
                                        <div  class="spouse_birth_certificate_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="spouse_birth_certificate_container_for_dc">
                                                <label>13. Applicant Spouse Birth Certificate/Leaving Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-spouse_birth_certificate_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="spouse_birth_certificate_name_container_for_domicile" style="display: none;">
                                                <label>13. Applicant Spouse Birth Certificate/Leaving Certificate <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="spouse_birth_certificate_download"><label id="spouse_birth_certificate_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_THIRTYONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTYONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="spouse_election_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="spouse_election_card_container_for_dc">
                                                <label>14. Applicant Spouse Election Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-spouse_election_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="spouse_election_card_name_container_for_domicile" style="display: none;">
                                                <label>14. Applicant Spouse Election Card <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="spouse_election_card_download"><label id="spouse_election_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_THIRTYTWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTYTWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div  class="spouse_aadhar_card_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="spouse_aadhar_card_container_for_dc">
                                                <label>15. Applicant Spouse Aadhar Card <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-spouse_aadhar_card_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="spouse_aadhar_card_name_container_for_domicile" style="display: none;">
                                                <label>15. Applicant Spouse Aadhar Card <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="spouse_aadhar_card_download"><label id="spouse_aadhar_card_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_THIRTYTHREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTYTHREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="spouse_death_proof_item_container_for_dc" style="display: none;">
                                    <div class="row">
                                        <div  class="spouse_death_proof_file_container_for_dc"> 
                                            <div class="col-12 m-b-5px" id="spouse_death_proof_container_for_dc">
                                                <label>16. Applicant Spouse Death Certificate <span style="color: red;"> *<br> (Maximum File Size: 1MB) &nbsp; </span></label><br>
                                                <label class="f-w-n">Document Not Uploaded</label><br>
                                                <div class="error-message error-message-domicile-spouse_death_proof_for_domicile"></div>
                                            </div>
                                            <div class="form-group col-sm-12" id="spouse_death_proof_name_container_for_domicile" style="display: none;">
                                                <label>16. Applicant Spouse Death Certificate <span style="color: red;">* </span></label><br>
                                                <a target="_blank" id="spouse_death_proof_download"><label id="spouse_death_proof_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_THIRTYFOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                            </div>
                                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTYFOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div  class="other_document_item_container_for_domicile_certificate" > 
                                    <div class="col-12 m-b-5px" id="other_document_container_for_domicile">
                                        <label>17. Other Document<span style="color: red;"> <br>(Maximum File Size: 5MB)(Upload pdf Only & Multiple PDF selection allow)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-domicile-other_document_for_domicile"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="other_document_name_container_for_domicile" style="display: none;">
                                        <label>17. Other Document <span style="color: red;"> </span></label><br>
                                        <a target="_blank" id="other_document_download"><label id="other_document_name_image_for_domicile" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_domicile_{{VALUE_SIXTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div> 
                            </div>
                        </div>
                    </div>
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