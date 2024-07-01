<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Income & Asset Certificate Form</h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application Form For Issuance of Income & Asset Certificate</div>
            </div>
            <form role="form" id="ews_certificate_form" name="ews_certificate_form" onsubmit="return false;">

                <input type="hidden" id="ews_certificate_id" name="ews_certificate_id" value="{{ews_certificate_data.ews_certificate_id}}">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-ews-certificate f-w-b"
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
                                            onchange="checkValidation('ews-certificate', 'district', selectDistrictValidationMessage); EwsCertificate.listview.districtChangeEvent($(this));"
                                            data-placeholder="Select District" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-ews-certificate-district"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>1.1 Name of Village Panchayat/D.M.C <span class="color-nic-red">*</span></label>
                                    <select id="village_name_for_ec" name="village_name" class="form-control select2"
                                            onchange="checkValidation('ews-certificate', 'village_name_for_ec', oneOptionValidationMessage); EwsCertificate.listview.villageDMCChangeEvent($(this));"
                                            data-placeholder="Select Name of Village Panchayat/D.M.C" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-ews-certificate-village_name_for_ec"></span>
                                </div>
                            </div>


                            <!--------------------------------------------------------->
                            <div class="row"><label>2.Personal Details </label></div><hr/>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="applicant_name_for_ec_div">2.1 Full Name of Guardian <span class="color-nic-red">*</span></label>

                                    <div class="input-group">
                                        <input type="text" id="applicant_name_for_ec" name="applicant_name" class="form-control" placeholder="Enter Full Name of Guardian !"
                                               maxlength="100" onblur="checkValidation('ews-certificate', 'applicant_name_for_ec', applicantNameValidationMessage);" value="{{ews_certificate_data.applicant_name}}">
                                    </div>
                                    <span class="error-message error-message-ews-certificate-applicant_name_for_ec"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>2.2 Relationship with Minor<span class="color-nic-red">*</span></label>
                                    <select id="relationship_of_applicant_for_ec" name="relationship_of_applicant" class="form-control select2" onchange="checkValidation('ews-certificate', 'relationship_of_applicant_for_ec', relationWithDeceasedPersonValidationMessage);" data-placeholder="Select Relation with Minor" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-ews-certificate-relationship_of_applicant_for_ec"></span>
                                </div>
                            </div>
                            <!--------------------------------------------------------->
                            <div class="row guardian_div_two">
                                <div class="form-group col-sm-6">
                                    <label>2.3 Guardian's Address <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <textarea id="guardian_address_for_ec" name="guardian_address" class="form-control" placeholder="Enter Guardian's Address !"
                                                  maxlength="100" onblur="checkValidation('ews-certificate', 'guardian_address_for_ec', guardianAddressValidationMessage);" >{{ews_certificate_data.guardian_address}}</textarea>
                                    </div>
                                    <span class="error-message error-message-ews-certificate-guardian_address_for_ec"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.4 Guardian’s Mobile Number <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="guardian_mobile_no_for_ec" name="guardian_mobile_no" class="form-control" placeholder="Enter Mobile Number !"
                                               maxlength="10" onkeyup="checkNumeric($(this));"  onblur="checkValidationForMobileNumber('ews-certificate', 'guardian_mobile_no_for_ec', mobileValidationMessage);" value="{{ews_certificate_data.guardian_mobile_no}}">
                                    </div>
                                    <span class="error-message error-message-ews-certificate-guardian_mobile_no_for_ec"></span>
                                </div>
                            </div>
                            <!--------------------------------------------------------->
                            <div class="row guardian_div_three">
                                <div class="form-group col-sm-6">
                                    <label>2.5 Minor child Adhar Number<span class="color-nic-red">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="guardian_aadhaar_for_ec" name="guardian_aadhaar" class="form-control" placeholder="Enter Aadhar Number"
                                               maxlength="12" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('ews-certificate', 'guardian_aadhaar_for_ec', invalidAadharNumberValidationMessage);" value="{{ews_certificate_data.guardian_aadhaar}}">
                                    </div>
                                    <span class="error-message error-message-ews-certificate-guardian_aadhaar_for_ec"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.6 Name of Minor Child<span class="color-nic-red">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="minor_child_name_for_ec" name="minor_child_name" class="form-control" placeholder="Enter Name of Minor Child"
                                               maxlength="50" onblur="checkValidation('ews-certificate', 'minor_child_name_for_ec', minorChildNameValidationMessage);" value="{{ews_certificate_data.minor_child_name}}">
                                    </div>
                                    <span class="error-message error-message-ews-certificate-minor_child_name_for_ec"></span>
                                </div>
                            </div>

                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2.7 Gender<span class="color-nic-red">*</span></label>
                                    <div id="gender_container_for_ec"></div>
                                    <span class="error-message error-message-ews-certificate-gender_for_ec"></span>
                                </div>

                            </div>
                            <!----------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>2.8  Date of Birth<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applicant_dob" id="applicant_dob_for_ec" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value=""
                                               onblur="checkValidation('ews-certificate', 'applicant_dob_for_ec', birthDateValidationMessage); calculateAge('for_ec');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-ews-certificate-applicant_dob_for_ec"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>2.9 Minor Age<span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_age_for_ec" 
                                           name="applicant_age" class="form-control"
                                           placeholder="Enter Minor Age !" maxlength="2" 
                                           onblur="checkValidation('ews-certificate', 'applicant_age_for_ec', applicantAgeValidationMessage);"
                                           value="{{ews_certificate_data.applicant_age}}" readonly="">
                                    <span class="error-message error-message-ews-certificate-applicant_age_for_ec"></span>
                                </div>
                            </div>


                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2.10 Birth Place <span class="color-nic-red">*</span></label>
                                    <input type="text" id="born_place_for_ec" name="born_place" class="form-control" placeholder="Enter Birth Place !" maxlength="50" value="{{ews_certificate_data.born_place}}">
                                    <span class="error-message error-message-ews-certificate-born_place_for_ec"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.11 Applicant Religion <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_religion_for_ec" name="applicant_religion" class="form-control" placeholder="Enter Religion !" maxlength="50" value="{{ews_certificate_data.applicant_religion}}">
                                    <span class="error-message error-message-ews-certificate-applicant_religion_for_ec"></span>
                                </div>
                            </div>

                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2.12 Applicant Caste <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_caste_for_ec" name="applicant_caste" class="form-control" placeholder="Enter Caste !" maxlength="50" value="{{ews_certificate_data.applicant_caste}}">
                                    <span class="error-message error-message-ews-certificate-applicant_caste_for_ec"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2.13 Police Station <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="present_police_station_for_ec" name="present_police_station" class="form-control" placeholder="Enter Police Station !" maxlength="50" value="{{ews_certificate_data.present_police_station}}" onblur="checkValidation('ews-certificate', 'present_police_station_for_ec', houseNameValidationMessage);">
                                    </div>
                                    <span class="error-message error-message-ews-certificate-present_police_station_for_ec"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.14 Post Office <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="present_post_office_for_ec" name="present_post_office" class="form-control" placeholder="Enter Street !"
                                               maxlength="50" onblur="checkValidation('ews-certificate', 'present_post_office_for_ec', streetValidationMessage);" value="{{ews_certificate_data.present_post_office}}">
                                    </div>
                                    <span class="error-message error-message-ews-certificate-present_post_office_for_ec"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2.15 Applicant Education <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="applicant_education_for_ec" name="applicant_education" class="form-control" placeholder="Enter Applicant Education !"
                                               maxlength="50" onblur="checkValidation('ews-certificate', 'applicant_education_for_ec', applicantEducationValidationMessage);" value="{{ews_certificate_data.applicant_education}}">
                                    </div>
                                    <span class="error-message error-message-ews-certificate-applicant_education_for_ec"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>2.16 For What Purpose is the Certificate of EWS Required <span class="color-nic-red">*</span></label>
                                    <div class="input-group">
                                        <input type="text" id="purpose_of_ews_certificate_for_ec" name="purpose_of_ews_certificate" class="form-control" placeholder="Enter Purpose !"
                                               maxlength="100" onblur="checkValidation('ews-certificate', 'purpose_of_ews_certificate_for_ec', purposeValidationMessage);" value="{{ews_certificate_data.purpose_of_ews_certificate}}">
                                    </div>
                                    <span class="error-message error-message-ews-certificate-purpose_of_ews_certificate_for_ec"></span>
                                </div>
                            </div>
                            <!--------------------------------------------------------->
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>3. Whether the caste/ sub-caste is included in SCs/ STs/ OBCs (Central/ UT/ States List) List notified for reservation in any of States/ UTs/ CentralGovt.<span class="color-nic-red">*</span></label>
                                    <div id="reservation_cast_list_container_for_ews_certificate"></div>
                                    <span class="error-message error-message-ews-certificate-reservation_cast_list_for_ews_certificate"></span>
                                </div>
                            </div>
                            <!--------------------------------------------------------------------->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card-body pt-1" style="background-color: aliceblue;">

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4. Applicant’s Communication Address</label><br/>
                                                <label>4.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_house_no_for_ec" name="com_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="50" value="{{ews_certificate_data.com_addr_house_no}}" onblur="checkValidation('ews-certificate', 'com_addr_house_no_for_ec', houseNoValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-com_addr_house_no_for_ec"></span>
                                            </div>
                                            <div class="form-group col-sm-6" style="margin-top: 23px;">
                                                <label>4.2 Building Name / House Name <span class="color-nic-red"></span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_house_name_for_ec" name="com_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="50" value="{{ews_certificate_data.com_addr_house_name}}" onblur="checkValidation('ews-certificate', 'com_addr_house_name_for_ec', houseNameValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-com_addr_house_name_for_ec"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.3 Street <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_street_for_ec" name="com_addr_street" class="form-control" placeholder="Enter Street !"
                                                           maxlength="50" onblur="checkValidation('ews-certificate', 'com_addr_street_for_ec', streetValidationMessage);" value="{{ews_certificate_data.com_addr_street}}">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-com_addr_street_for_ec"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_village_dmc_ward_for_ec" name="com_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                           maxlength="50" onblur="checkValidation('ews-certificate', 'com_addr_village_dmc_ward_for_ec', villageNameValidationMessage);" value="{{ews_certificate_data.com_addr_village_dmc_ward}}" readonly="">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-com_addr_village_dmc_ward_for_ec"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>4.5 Select City<span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_addr_city_for_ec" name="com_addr_city" class="form-control" placeholder="Enter City !"
                                                           maxlength="50" onblur="checkValidation('ews-certificate', 'com_addr_city_for_ec', selectCityValidationMessage);" onchange="EwsCertificate.listview.getPincode($(this));" value="{{ews_certificate_data.com_addr_city}}" readonly="">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-com_addr_city_for_ec"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>4.6 Pincode <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="com_pincode_for_ec" name="com_pincode" class="form-control" placeholder="Enter Pincode !"
                                                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('ews-certificate', 'com_pincode_for_ec', pincodeValidationMessage);" value="{{ews_certificate_data.com_pincode}}">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-com_pincode_for_ec"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card-body pt-1" style="background-color: aliceblue;">

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>5. Applicant’s Original Native Place</label><br/>   
                                                <label>5.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_house_no_for_ec" name="per_addr_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="50" value="{{ews_certificate_data.per_addr_house_no}}" onblur="checkValidation('ews-certificate', 'per_addr_house_no_for_ec', houseNoValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-per_addr_house_no_for_ec"></span>
                                            </div>
                                            <div class="form-group col-sm-6" style="margin-top: 22px;">
                                                <label>5.2 Building Name / House Name <span class="color-nic-red"></span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_house_name_for_ec" name="per_addr_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="50" value="{{ews_certificate_data.per_addr_house_name}}" onblur="checkValidation('ews-certificate', 'per_addr_house_name_for_ec', houseNameValidationMessage);">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-per_addr_house_name_for_ec"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>5.3 Street <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_street_for_ec" name="per_addr_street" class="form-control" placeholder="Enter Street !"
                                                           maxlength="50" onblur="checkValidation('ews-certificate', 'per_addr_street_for_ec', streetValidationMessage);" value="{{ews_certificate_data.per_addr_street}}">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-per_addr_street_for_ec"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>5.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_addr_village_dmc_ward_for_ec" name="per_addr_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                                           maxlength="50" onblur="checkValidation('ews-certificate', 'per_addr_village_dmc_ward_for_ec', villageNameValidationMessage);" value="{{ews_certificate_data.per_addr_village_dmc_ward}}" >
                                                </div>
                                                <span class="error-message error-message-ews-certificate-per_addr_village_dmc_ward_for_ec"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label>5.5 Select City<span class="color-nic-red">*</span></label>
                                                <div class="input-group">

                                                    <input type="text" id="per_addr_city_for_ec" name="per_addr_city" class="form-control" placeholder="Enter City !"
                                                           maxlength="50" onblur="checkValidation('ews-certificate', 'per_addr_city_for_ec', selectCityValidationMessage);" onchange="EwsCertificate.listview.getPincode($(this));" value="{{ews_certificate_data.per_addr_city}}" >
                                                </div>
                                                <span class="error-message error-message-ews-certificate-per_addr_city_for_ec"></span>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>5.6 Pincode <span class="color-nic-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" id="per_pincode_for_ec" name="per_pincode" class="form-control" placeholder="Enter Pincode !"
                                                           maxlength="6" onkeyup="checkNumeric($(this));" onblur="checkValidation('ews-certificate', 'per_pincode_for_ec', pincodeValidationMessage);" value="{{ews_certificate_data.per_pincode}}">
                                                </div>
                                                <span class="error-message error-message-ews-certificate-per_pincode_for_ec"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card detail_of_income_asset_item_container_for_ec">
                                <div class="card-header pt-1 pb-1 bg-nic-blue">
                                    <div class="row">
                                        <div class="col-12 f-w-b">
                                            6. Places of Stay since Birth.
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-nic-blue">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <span class="error-message error-message-ews-certificate-mi f-w-b"
                                                  style="border-bottom: 2px solid red;"></span>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover-cells m-0 f-s">
                                            <thead>
                                                <tr class="bg-light-gray">
                                                    <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                                    <th class="p-1" style="min-width: 100px;">State</th>
                                                    <th class="p-1" style="min-width: 100px;">District</th>
                                                    <th class="p-1" style="min-width: 100px;">Village / Town</th>
                                                    <th class="p-1" style="min-width: 100px;">Tehsil</th>
                                                    <th class="p-1" style="min-width: 100px;">Period</th>
                                                    <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detail_of_birth_stay_period_info_container_for_ec">
                                            </tbody>
                                        </table>
                                    </div>  
                                    <div class="row">
                                        <div class="col-12 f-w-b pt-2">
                                            <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                                    onclick="EwsCertificate.listview.addBirthStayPeriodInfo({}, true);">
                                                <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------------------------->
                    <div class="card gross_annual_income_family_item_container_for_ec">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    7. Family Details of Minor Child
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-ews-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 150px;">Family Member Detail</th>
                                            <th class="p-1" style="min-width: 150px;">Name</th>
                                            <th class="p-1" style="min-width: 150px;">Age</th>
                                            <th class="p-1" style="min-width: 150px;">Occupation/Education</th>
                                            <th class="p-1" style="min-width: 150px;">Remark</th>

                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr class="p-1">
                                            <td><b>1</b></td>
                                            <td>Father</td>
                                            <td colspan="4">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <td>
                                                            <input type="text" id="father_name_for_ec" name="father_name" onblur="checkValidation('ews-certificate', 'father_name_for_ec', nameValidationMessage);"
                                                                   maxlength="50" class="form-control" value="{{ews_certificate_data.father_name}}"  placeholder="Enter Name !"
                                                                   >
                                                            <span class="error-message error-message-ews-certificate-father_name_for_ec"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="father_age_for_ec" name="father_age"
                                                                   maxlength="2" class="form-control" onblur="checkValidation('ews-certificate', 'father_age_for_ec', ageValidationMessage);" value="{{ews_certificate_data.father_age}}"  placeholder="Enter Age !"
                                                                   >
                                                            <span class="error-message error-message-ews-certificate-father_age_for_ec"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="father_occupation_for_ec" name="father_occupation"
                                                                   maxlength="50" class="form-control" onblur="checkValidation('ews-certificate', 'father_occupation_for_ec', occupationValidationMessage);" value="{{ews_certificate_data.father_occupation}}" placeholder="Enter Occupation !"
                                                                   >
                                                            <span class="error-message error-message-ews-certificate-father_occupation_for_ec"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="father_remark_for_ec" name="father_remark"
                                                                   maxlength="50" class="form-control" onblur="checkValidation('ews-certificate', 'father_remark_for_ec', remarkValidationMessage);" value="{{ews_certificate_data.father_remark}}" placeholder="Enter Remark !"
                                                                   >
                                                            <span class="error-message error-message-ews-certificate-father_remark_for_ec"></span>
                                                        </td>
                                                        <td style="width: 47px;"><span class="color-nic-red">*</span></td>
                                                        </td>
                                                    </table></div>

                                        </tr>
                                        <tr class="p-1">
                                            <td><b>2</b></td>
                                            <td>Mother</td>
                                            <td colspan="4">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <td>
                                                            <input type="text" id="mother_name_for_ec" name="mother_name"
                                                                   maxlength="50" onblur="checkValidation('ews-certificate', 'mother_name_for_ec', nameValidationMessage);" class="form-control" value="{{ews_certificate_data.mother_name}}"  placeholder="Enter Name !"
                                                                   >
                                                            <span class="error-message error-message-ews-certificate-mother_name_for_ec"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="mother_age_for_ec" name="mother_age"
                                                                   maxlength="2" onblur="checkValidation('ews-certificate', 'mother_age_for_ec', ageValidationMessage);" class="form-control" value="{{ews_certificate_data.mother_age}}"placeholder="Enter Age !"
                                                                   >
                                                            <span class="error-message error-message-ews-certificate-mother_age_for_ec"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="mother_occupation_for_ec" name="mother_occupation"
                                                                   maxlength="50" class="form-control" value="{{ews_certificate_data.mother_occupation}}" onblur="checkValidation('ews-certificate', 'mother_occupation_for_ec', occupationValidationMessage);"  placeholder="Enter Occupation !">
                                                            <span class="error-message error-message-ews-certificate-mother_occupation_for_ec"></span>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="mother_remark_for_ec" name="mother_remark"
                                                                   maxlength="50" onblur="checkValidation('ews-certificate', 'mother_remark_for_ec', remarkValidationMessage);" class="form-control" value="{{ews_certificate_data.mother_remark}}" placeholder="Enter Remark !"
                                                                   >
                                                            <span class="error-message error-message-ews-certificate-mother_remark_for_ec"></span>
                                                        </td>
                                                        <td style="width: 47px;"><span class="color-nic-red">*</span></td>
                                                    </table></div>
                                            </td>


                                        </tr>
                                        <tr class="p-1">
                                            <td><b>3</b></td>

                                            <td>Sibling Brother Details.</td>
                                            <td colspan="4">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody id="detail_of_sibling_bro_info_container_for_ec">
                                                        </tbody>
                                                    </table>
                                                </div>  
                                                <div class="row">
                                                    <div class="col-12 f-w-b pt-2">
                                                        <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                                                onclick="EwsCertificate.listview.addSiblingBroInfo({}, true); EwsCertificate.listview.addSiblingBroIncome({}, true);">
                                                            <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr class="p-1">
                                            <td><b>4</b></td>

                                            <td>Sibling Sister Details.</td>
                                            <td colspan="4">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody id="detail_of_sibling_sis_info_container_for_ec">
                                                        </tbody>
                                                    </table>
                                                </div>  
                                                <div class="row">
                                                    <div class="col-12 f-w-b pt-2">
                                                        <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                                                onclick="EwsCertificate.listview.addSiblingSisInfo({}, true); EwsCertificate.listview.addSiblingSisIncome({}, true);">
                                                            <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div> 


                        </div>
                    </div>




                    <!--------------------------------------------------------->
                    <div class="card detail_of_income_asset_item_container_for_ec">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    8. Details of Income & Asset Certificate/s issued earlier.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-ews-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 150px;">Issuing Authority</th>
                                            <th class="p-1" style="min-width: 150px;">Certificate.No.</th>
                                            <th class="p-1" style="min-width: 80px;">Issued Date</th>
                                            <th class="p-1" style="min-width: 80px;">Valid up to</th>
                                            <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_of_income_asset_info_container_for_ec">
                                    </tbody>
                                </table>
                            </div>  
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="EwsCertificate.listview.addIncomeCertyInfo({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------------------------->
                    <div class="card gross_annual_income_family_item_container_for_ec">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    9. Gross annual income of the Family
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-ews-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s" id="myTable">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 120px;">Source of Income Member</th>
                                            <th class="p-1" style="min-width: 120px;">Salary</th>
                                            <th class="p-1" style="min-width: 120px;">Business</th>
                                            <th class="p-1" style="min-width: 120px;">Agriculture</th>
                                            <th class="p-1" style="min-width: 120px;">Profession</th>
                                            <th class="p-1" style="min-width: 130px;">Other Source(please specify)</th>
                                            <th class="p-1" style="min-width: 120px;">Total Income</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr class="p-1">
                                            <td><b>1</b></td>
                                            <td>Father</td>
                                            <td>
                                                <input type="text" id="father_salary_detail_for_ec" name="father_salary_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.father_salary_detail}}" onblur="checkValidation('ews-certificate', 'father_salary_detail_for_ec', salaryIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('father', 'father_total_income_for_ec');" placeholder="Enter Annual Income of Salary !">
                                                <span class="error-message error-message-ews-certificate-father_salary_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="father_business_detail_for_ec" name="father_business_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.father_business_detail}}" onblur="checkValidation('ews-certificate', 'father_business_detail_for_ec', businessIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('father', 'father_total_income_for_ec');" placeholder="Enter Annual Income of Business !">
                                                <span class="error-message error-message-ews-certificate-father_business_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="father_agri_detail_for_ec" name="father_agri_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.father_agri_detail}}" onblur="checkValidation('ews-certificate', 'father_agri_detail_for_ec', agriIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('father', 'father_total_income_for_ec');" placeholder="Enter Annual Income of Agriculture !">
                                                <span class="error-message error-message-ews-certificate-father_agri_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="father_profe_detail_for_ec" name="father_profe_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.father_profe_detail}}" onblur="checkValidation('ews-certificate', 'father_profe_detail_for_ec', professionalIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('father', 'father_total_income_for_ec');" placeholder="Enter Annual Income of Profession !">
                                                <span class="error-message error-message-ews-certificate-father_profe_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="father_other_detail_for_ec" name="father_other_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.father_other_detail}}" onblur="checkValidation('ews-certificate', 'father_other_detail_for_ec', otherIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('father', 'father_total_income_for_ec');" placeholder="Enter Annual Income of Salary !">
                                                <span class="error-message error-message-ews-certificate-father_other_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="father_total_income_for_ec" name="father_total_income" value="{{ews_certificate_data.father_total_income}}" class="form-control txtCal" placeholder="Total Income !" readonly onblur="EwsCertificate.listview.getGrandIncomeTotal();">

                                            </td>

                                        </tr>
                                        <tr class="p-1">
                                            <td><b>2</b></td>
                                            <td>Mother</td>
                                            <td>
                                                <input type="text" id="mother_salary_detail_for_ec" name="mother_salary_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.mother_salary_detail}}" onblur="checkValidation('ews-certificate', 'mother_salary_detail_for_ec', salaryIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('mother', 'mother_total_income_for_ec');" placeholder="Enter Annual Income of Salary !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-mother_salary_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="mother_business_detail_for_ec" name="mother_business_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.mother_business_detail}}" onblur="checkValidation('ews-certificate', 'mother_business_detail_for_ec', businessIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('mother', 'mother_total_income_for_ec');" placeholder="Enter Annual Income of Business !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-mother_business_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="mother_agri_detail_for_ec" name="mother_agri_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.mother_agri_detail}}" onblur="checkValidation('ews-certificate', 'mother_agri_detail_for_ec', agriIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('mother', 'mother_total_income_for_ec');" placeholder="Enter Annual Income of Agriculture !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-mother_agri_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="mother_profe_detail_for_ec" name="mother_profe_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.mother_profe_detail}}" onblur="checkValidation('ews-certificate', 'mother_profe_detail_for_ec', professionalIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('mother', 'mother_total_income_for_ec');" placeholder="Enter Annual Income of Profession !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-mother_profe_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="mother_other_detail_for_ec" name="mother_other_detail"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.mother_other_detail}}" onblur="checkValidation('ews-certificate', 'mother_other_detail_for_ec', otherIncomeValidationMessage); EwsCertificate.listview.getGrandIncomeTotal();" onChange="EwsCertificate.listview.getYearlyIncomeTotal('mother', 'mother_total_income_for_ec');" placeholder="Enter Annual Income of Salary !" >
                                                <span class="error-message error-message-ews-certificate-mother_other_detail_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="mother_total_income_for_ec" name="mother_total_income" value="{{ews_certificate_data.mother_total_income}}" class="form-control txtCal" placeholder="Total Income !" readonly onblur="EwsCertificate.listview.getGrandIncomeTotal();">

                                            </td>

                                        </tr>

                                        <tr class="p-1">

                                            <td><b>3</b></td>
                                            <td>Sibling Brother</td>
                                            <td colspan="6">
                                                <table>
                                                    <tbody id="detail_of_sibling_bro_income_container_for_ec"></tbody>

                                                </table>
                                            </td>




                                        </tr>
                                        <tr class="p-1">
                                            <td><b>4</b></td>
                                            <td>Sibling Sister</td>
                                            <td colspan="6">
                                                <table>
                                                    <tbody id="detail_of_sibling_sis_income_container_for_ec"></tbody>

                                                </table>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-6 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                    <label>Total</label>
                                    <input type="text" id="total_income_for_ec" value="{{ews_certificate_data.total_income}}" name="total_income"
                                           class="form-control" placeholder="Total Income !"
                                           readonly>
                                </div>
                            </div> 

                        </div>
                    </div>
                    <!--------------------------------------------------------->
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    10. Asset Details of the Family.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-ews-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 150px;">Asset</th>
                                            <th class="p-1" style="min-width: 150px;">Area (in sq.yd/sq.ft)</th>
                                            <th class="p-1" style="min-width: 150px;">Location</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr class="p-1">
                                            <td><b>1</b></td>
                                            <td>Agricultural</td>
                                            <td>
                                                <input type="text" id="agricultural_area_for_ec" name="agricultural_area"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.agricultural_area}}" placeholder="Enter Agricultural Area !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-agricultural_area_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="agricultural_location_for_ec" name="agricultural_location"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.agricultural_location}}" placeholder="Enter Agricultural Location !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-agricultural_location_for_ec"></span>
                                            </td>
                                        </tr>
                                        <tr class="p-1">
                                            <td><b>2</b></td>
                                            <td>Residental Flat<span style="color: red;">* </span></td>
                                            <td>
                                                <input type="text" id="residental_flat_area_for_ec" name="residental_flat_area"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.residental_flat_area}}" placeholder="Enter Residental Area !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-residental_flat_area_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="residental_flat_location_for_ec" name="residental_flat_location"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.residental_flat_location}}" placeholder="Enter Residental Location !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-residental_flat_location_for_ec"></span>
                                            </td>
                                        </tr>
                                        <tr class="p-1">
                                            <td><b>3</b></td>
                                            <td>Residental plot in urban areas i.e.notified Municipality/Municipal Corporation/Municipality etc.anywhere in the Country</td>
                                            <td>
                                                <input type="text" id="residental_plot_urban_area_for_ec" name="residental_plot_urban_area"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.residental_plot_urban_area}}" placeholder="Enter Urban Area !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-residental_plot_urban_area_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="residental_plot_urban_location_for_ec" name="residental_plot_urban_location"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.residental_plot_urban_location}}" placeholder="Enter Urban Location !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-residental_plot_urban_location_for_ec"></span>
                                            </td>
                                        </tr>
                                        <tr class="p-1">
                                            <td><b>4</b></td>
                                            <td>Residential plot in areas other than the urban areas i.e.Rural Areas anywhere in the Country</td>
                                            <td>
                                                <input type="text" id="residental_plot_rural_area_for_ec" name="residental_plot_rural_area"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.residental_plot_rural_area}}" placeholder="Enter Rural Area !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-residental_plot_rural_area_for_ec"></span>
                                            </td>
                                            <td>
                                                <input type="text" id="residental_plot_rural_location_for_ec" name="residental_plot_rural_location"
                                                       maxlength="100" class="form-control" value="{{ews_certificate_data.residental_plot_rural_location}}" placeholder="Enter Rural Location !"
                                                       >
                                                <span class="error-message error-message-ews-certificate-residental_plot_rural_location_for_ec"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    <!--------------------------------------------------------->
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Enclosed as below</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <span style="color: red;font-weight: bold;">Note : Must upload pdf file with original scan documents <br></span>


                            <div class="row mb-2">
                                <div class="col-12" id="applicant_photo_doc_container_for_ews_certificate">
                                    <label>11. Applicant Minor child Father / Mother / Guardian Photo (Latest). <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-applicant_photo_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="applicant_photo_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>11. Applicant Minor child Father / Mother / Guardian Photo (Latest). <span style="color: red;">*</span></label><br>
                                    <a target="_blank" id="applicant_photo_doc_download">
                                        <img id="applicant_photo_doc_name_image_for_ews_certificate"
                                             style="width: 250px; height: 250px; border: 2px solid blue;"
                                             class="spinner_name_container_for_ews_certificate_{{VALUE_ONE}}">
                                    </a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="minor_child_photo_container_for_ews_certificate">
                                    <label>12. Minor child Photo (Latest). <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-minor_child_photo_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="minor_child_photo_name_container_for_ews_certificate" style="display: none;">
                                    <label>12. Minor child Photo (Latest). <span style="color: red;">*</span></label><br>
                                    <a target="_blank" id="minor_child_photo_download">
                                        <img id="minor_child_photo_name_image_for_ews_certificate"
                                             style="width: 250px; height: 250px; border: 2px solid blue;"
                                             class="spinner_name_container_for_ews_certificate_{{VALUE_THIRTEEN}}">
                                    </a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THIRTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="birth_certificate_doc_container_for_ews_certificate">
                                    <label>13. Applicant Birth Certificate. <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-birth_certificate_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="birth_certificate_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>13. Applicant Birth Certificate. <span style="color: red;"> </span></label><br>
                                    <a target="_blank" id="birth_certificate_doc_download"><label id="birth_certificate_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="leaving_certificate_doc_container_for_ews_certificate">
                                    <label>14. Applicant Leaving Certificate / Bonofied Certificate Form. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-leaving_certificate_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="leaving_certificate_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>14. Applicant Leaving Certificate / Bonofied Certificate Form. <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="leaving_certificate_doc_download"><label id="leaving_certificate_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="election_card_doc_container_for_ews_certificate">
                                    <label>15. Minor Child Father Election Card. <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-election_card_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="election_card_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>15. Minor Child Father Election Card. <span style="color: red;"> </span></label><br>
                                    <a target="_blank" id="election_card_doc_download"><label id="election_card_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="mother_election_card_doc_container_for_ews_certificate">
                                    <label>16. Minor Child Mother Election Card. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-mother_election_card_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="mother_election_card_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>16. Minor Child Mother Election Card. <span style="color: red;"> *</span></label><br>
                                    <a target="_blank" id="mother_election_card_doc_download"><label id="mother_election_card_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_TWENTYONE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="aadhar_card_doc_container_for_ews_certificate">
                                    <label>17. Minor child Father Aadhaar Card. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-aadhar_card_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="aadhar_card_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>17. Minor child Father Aadhaar Card. <span style="color: red;"> *</span></label><br>
                                    <a target="_blank" id="aadhar_card_doc_download"><label id="aadhar_card_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="mother_aadhar_card_doc_container_for_ews_certificate">
                                    <label>18. Minor Child Mother Aadhaar Card. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-mother_aadhar_card_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="mother_aadhar_card_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>18. Minor Child Mother Aadhaar Card. <span style="color: red;"> *</span></label><br>
                                    <a target="_blank" id="mother_aadhar_card_doc_download"><label id="mother_aadhar_card_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_TWENTYTHREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYTHREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="child_aadhar_card_doc_container_for_ews_certificate">
                                    <label>19. Minor child Aadhaar Card. <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-child_aadhar_card_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="child_aadhar_card_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>19. Minor child Aadhaar Card. <span style="color: red;"> </span></label><br>
                                    <a target="_blank" id="child_aadhar_card_doc_download"><label id="child_aadhar_card_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_FOURTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a> 
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOURTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="community_certificate_doc_container_for_ews_certificate">
                                    <label>20. Applicant Community certificate with orignal stamp. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-community_certificate_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="community_certificate_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>20. Applicant Community certificate with orignal stamp. <span style="color: red;"> *</span></label><br>
                                    <a target="_blank" id="community_certificate_doc_download"><label id="community_certificate_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="father_mother_community_certificate_doc_container_for_ews_certificate">
                                    <label>21. Minor Child Father / Mother / Guardian Community certificate with orignal stamp. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-father_mother_community_certificate_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_mother_community_certificate_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>21. Minor Child Minor Child Father / Mother / Guardian Community certificate with orignal stamp. <span style="color: red;"> *</span></label><br>
                                    <a target="_blank" id="father_mother_community_certificate_doc_download"><label id="father_mother_community_certificate_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_SIXTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIXTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="caste_certificate_doc_container_for_ews_certificate">
                                    <label>22. Caste Certy Issue by Sarpanch / Panchayat Secretary from Original Place. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-caste_certificate_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="caste_certificate_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>22. Caste Certy Issue by Sarpanch / Panchayat Secretary from Original Place. <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="caste_certificate_doc_download"><label id="caste_certificate_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-12" id="father_mother_caste_certificate_doc_container_for_ews_certificate">
                                    <label>23. Minor Child Father / Mother Caste Certificate Issue by Sarpanch / Panchayat Secretary from Original Place. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-father_mother_caste_certificate_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="father_mother_caste_certificate_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>23. Minor Child Father / Mother Caste Certificate Issue by Sarpanch / Panchayat Secretary from Original Place. <span style="color: red;"> *</span></label><br>
                                    <a target="_blank" id="father_mother_caste_certificate_doc_download"><label id="father_mother_caste_certificate_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_SEVENTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVENTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="affidativet_immovable_property_doc_container_for_ews_certificate">
                                    <label>24. Photo Notary Affidavit (Self & Father) by the applicant citing immovable property/Income details etc. Inter-alia containing following contents. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-affidativet_immovable_property_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="affidativet_immovable_property_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>24. Photo Notary Affidavit (Self & Father) by the applicant citing immovable property/Income details etc. Inter-alia containing following contents. <span style="color: red;"> *</span></label><br>
                                    <a target="_blank" id="affidativet_immovable_property_doc_download"><label id="affidativet_immovable_property_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="gazeted_copy_doc_container_for_ews_certificate">
                                    <label>25. Gazette Copy (Original State). <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-gazeted_copy_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="gazeted_copy_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>25. Gazette Copy (Original State). <span style="color: red;"> </span></label><br>
                                    <a target="_blank" id="gazeted_copy_doc_download"><label id="gazeted_copy_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="agricultural_detail_doc_container_for_ews_certificate">
                                    <label>26. Agricultural property Documents Grand Father / Father / Mother / Sibling of any immovable property. <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-agricultural_detail_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="agricultural_detail_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>26. Agricultural property Documents Grand Father / Father / Mother / Sibling of any immovable property. <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="agricultural_detail_doc_download"><label id="agricultural_detail_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12" id="incometax_return_doc_container_for_ews_certificate">
                                    <label>27. Income Certificate or Income Tax Return for last 3 Assessment years. <span style="color: red;"> *(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-incometax_return_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="incometax_return_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>27. Income Certificate or Income Tax Return for last 3 Assessment years. <span style="color: red;"> *</span></label><br>
                                    <a target="_blank" id="incometax_return_doc_download"><label id="incometax_return_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>

                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>28. Do you have domicile Certificate ? <span class="color-nic-red">*</span></label>
                                    <div id="if_having_domicile_certi_container_for_ews_certificate"></div>
                                    <span class="error-message error-message-ews-certificate-if_having_domicile_certi_for_ews_certificate"></span>
                                </div>
                            </div>
                            
                            <div class="mb-2 if_domicile_certificate_item_container_for_ews_certificate" style="display: none;">
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="domicile_certificate_doc_container_for_ews_certificate">
                                        <label>28.1 Minor Child domicile Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-ews-certificate-domicile_certificate_doc_for_ews_certificate"></div>
                                    </div>
                                    <div class="col-sm-12 m-b-5px" id="domicile_certificate_doc_name_container_for_ews_certificate" style="display: none;">
                                        <label>28.1 Minor Child domicile Certificate <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="domicile_certificate_doc_download"><label id="domicile_certificate_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_FIFTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIFTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="father_mother_domicile_certificate_doc_container_for_ews_certificate">
                                        <label>28.2 Minor Child Father / Mother/ Guardian domicile Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-ews-certificate-father_mother_domicile_certificate_doc_for_ews_certificate"></div>
                                    </div>
                                    <div class="col-sm-12 m-b-5px" id="father_mother_domicile_certificate_doc_name_container_for_ews_certificate" style="display: none;">
                                        <label>28.2 Minor Child Father / Mother/ Guardian domicile Certificate <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="father_mother_domicile_certificate_doc_download"><label id="father_mother_domicile_certificate_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_TWENTYFOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYFOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>
                            <div class="row mb-2 have_you_own_house_container_div">
                                <div class="col-sm-6">
                                    <label>29. Do You have Your Own House ? <span class="color-nic-red">*</span></label>
                                    <div id="have_you_own_house_container_for_ews_certificate"></div>
                                    <span class="error-message error-message-ews-certificate-have_you_own_house_for_ews_certificate"></span>
                                </div>
                            </div>
                            <div class="house_tax_receipt_item_container_for_ews_certificate" style="display: none;">
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="house_tax_receipt_container_for_ews_certificate">
                                        <label>29.1 House Tax Receipt <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-ews-certificate-house_tax_receipt_for_ews_certificate"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="house_tax_receipt_name_container_for_ews_certificate" style="display: none;">
                                        <label>29.1 House Tax Receipt <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="house_tax_receipt_download"><label id="house_tax_receipt_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_EIGHTEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHTEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="sale_deed_copy_container_for_ews_certificate">
                                        <label>29.2 Saledeed Copy <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-ews-certificate-sale_deed_copy_for_ews_certificate"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="sale_deed_copy_name_container_for_ews_certificate" style="display: none;">
                                        <label>29.2 Saledeed Copy <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="sale_deed_copy_download"><label id="sale_deed_copy_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_NINETEEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINETEEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>
                            <div class="noc_with_notary_item_container_for_ews_certificate " style="display: none;">
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="noc_with_notary_container_for_ews_certificate">
                                        <label>29.1 NOC With Notary alongwith Photo Attached <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-ews-certificate-noc_with_notary_for_ews_certificate"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="noc_with_notary_name_container_for_ews_certificate" style="display: none;">
                                        <label>29.1 NOC With Notary alongwith Photo Attached <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="noc_with_notary_download"><label id="noc_with_notary_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_TWENTYFIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYFIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-b-5px" id="aggriment_with_notary_container_for_ews_certificate">
                                        <label>29.2 Aggriment With Notary alongwith Photo Attached <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                        <label class="f-w-n">Document Not Uploaded</label><br>
                                        <div class="error-message error-message-ews-certificate-aggriment_with_notary_for_ews_certificate"></div>
                                    </div>
                                    <div class="form-group col-sm-12" id="aggriment_with_notary_name_container_for_ews_certificate" style="display: none;">
                                        <label>29.2 Aggriment With Notary alongwith Photo Attached <span style="color: red;">* </span></label><br>
                                        <a target="_blank" id="aggriment_with_notary_download"><label id="aggriment_with_notary_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_TWENTYSIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                        
                                    </div>
                                    <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWENTYSIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12" id="other_doc_container_for_ews_certificate">
                                    <label>30. Other Documents, if any. <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-ews-certificate-other_doc_for_ews_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="other_doc_name_container_for_ews_certificate" style="display: none;">
                                    <label>30. Other Documents, if any. <span style="color: red;"> </span></label><br>
                                    <a target="_blank" id="other_doc_download"><label id="other_doc_name_image_for_ews_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_ews_certificate_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                        </div>
                    </div>
                    <hr class="m-b-1rem">


                    <!----------------------------------------->

                    <div class="card-footer p-2">
                        <!--<button type="button" id="draft_btn_for_obc_certificate" class="btn btn-sm btn-nic-blue" onclick="EwsCertificate.listview.submitEwsCertificate({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button>-->
                        <button type="button" id="submit_btn_for_certificate" class="btn btn-sm btn-success" onclick="EwsCertificate.listview.askForSubmitEwsCertificate({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="EwsCertificate.listview.loadEwsCertificateData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>