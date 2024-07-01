<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Income Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application for issue of Income Certificate </div>
            </div>
            <form role="form" id="income_certificate_form" name="income_certificate_form" onsubmit="return false;"
                  autocomplete="off">
                <input type="hidden" id="income_certificate_id_for_income_certificate" name="income_certificate_id_for_income_certificate" value="{{income_certificate_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-income-certificate f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    To,<br>
                    The Mamlatdar,
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-3">
                            <label>District<span class="color-nic-red">*</span></label>
                            <select id="district_for_income_certificate" name="district_for_income_certificate" class="form-control select2"
                                    onchange="checkValidation('income-certificate', 'district_for_income_certificate', selectDistrictValidationMessage);
                                            IncomeCertificate.listview.districtChangeEvent($(this));"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-income-certificate-district_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Name of Applicant <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_name_for_income_certificate" name="applicant_name_for_income_certificate" class="form-control" placeholder="Enter Name of Applicant !"
                                   maxlength="100" onblur="checkValidation('income-certificate', 'applicant_name_for_income_certificate', applicantNameValidationMessage);" value="{{applicant_name}}">
                            <span class="error-message error-message-income-certificate-applicant_name_for_income_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Applicant's Mobile Number<span class="color-nic-red">*</span></label>
                            <input type="text" id="mobile_number_for_income_certificate" name="mobile_number_for_income_certificate" class="form-control" placeholder="Enter Mobile Number !"
                                   maxlength="10" onkeyup="checkNumeric($(this));"
                                   onblur="checkValidationForMobileNumber('income-certificate', 'mobile_number_for_income_certificate');" value="{{mobile_number}}">
                            <span class="error-message error-message-income-certificate-mobile_number_for_income_certificate"></span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>Applicant's Aadhar Number</label>
                            <div class="input-group">
                                <input type="text" id="aadhar_number_for_income_certificate" name="aadhar_number_for_income_certificate"
                                       class="form-control" placeholder="Enter Aadhar Number !"
                                       onblur="aadharNumberValidation('income-certificate', 'aadhar_number_for_income_certificate');"
                                       maxlength="12" value="{{aadhar_number}}">
                            </div>
                            <span class="error-message error-message-income-certificate-aadhar_number_for_income_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>Applicant's Email Address </label>
                            <input type="text" id="email_for_income_certificate" name="email_for_income_certificate"
                                   class="form-control" placeholder="Enter Email !"  maxlength="100"
                                   onblur="checkValidationForEmail('income-certificate', 'email_for_income_certificate');" value="{{email}}">
                            <span class="error-message error-message-income-certificate-email_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1.1 Applicant's Communication Address <span class="color-nic-red">*</span></label>
                            <textarea id="communication_address_for_income_certificate" name="communication_address_for_income_certificate" class="form-control" placeholder="Enter Communication Address !"
                                      onblur="checkValidation('income-certificate', 'communication_address_for_income_certificate', communicationAddressValidationMessage);"
                                      maxlength="200" >{{communication_address}}</textarea>
                            <span class="error-message error-message-income-certificate-communication_address_for_income_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.2 Applicant's Permanent Address <span class="color-nic-red">*</span></label>
                            <textarea id="applicant_address_for_income_certificate" name="applicant_address_for_income_certificate" class="form-control"
                                      onblur="checkValidation('income-certificate', 'applicant_address_for_income_certificate', communicationAddressValidationMessage);"
                                      placeholder="Enter Applicant's Permanent Address !" maxlength="200">{{applicant_address}}</textarea>
                            <span class="error-message error-message-income-certificate-applicant_address_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>1.3 Village / DMC Ward / SMC Ward<span class="color-nic-red">*</span></label>
                            <select id="village_dmc_ward_for_income_certificate" name="village_dmc_ward_for_income_certificate" class="form-control select2"
                                    onchange="checkValidation('income-certificate', 'village_dmc_ward_for_income_certificate', oneOptionValidationMessage);"
                                    data-placeholder="Select Village / DMC Ward / SMC Ward" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-income-certificate-village_dmc_ward_for_income_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label>2.1 Date of Birth<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="applicant_dob_for_income_certificate" id="applicant_dob_for_income_certificate" class="form-control"
                                       placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                       value="{{applicant_dob_text}}"
                                       onblur="checkValidation('income-certificate', 'applicant_dob_for_income_certificate', birthDateValidationMessage); calculateAge('for_income_certificate');">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-income-certificate-applicant_dob_for_income_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label>2.2 Applicant Age<span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_age_for_income_certificate" 
                                   name="applicant_age_for_income_certificate" class="form-control"
                                   placeholder="Enter Applicant Age !" maxlength="100" 
                                   onblur="checkValidation('income-certificate', 'applicant_age_for_income_certificate', applicantAgeValidationMessage);"
                                   value="{{applicant_age}}" readonly="">
                            <span class="error-message error-message-income-certificate-applicant_age_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>2.3 Applicant Birth Place<span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_born_place_for_income_certificate" 
                                   name="applicant_born_place_for_income_certificate" class="form-control"
                                   placeholder="Enter Birth Place !" maxlength="100" 
                                   onblur="checkValidation('income-certificate', 'applicant_born_place_for_income_certificate', applicantBornPlaceValidationMessage);"
                                   value="{{applicant_born_place}}">
                            <span class="error-message error-message-income-certificate-applicant_born_place_for_income_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>2.4 Applicant Nationality <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_nationality_for_income_certificate" name="applicant_nationality_for_income_certificate" class="form-control" placeholder="Enter Applicant Nationality!"
                                   maxlength="100" onblur="checkValidation('income-certificate', 'applicant_nationality_for_income_certificate', applicantNationalityValidationMessage);" value="{{applicant_nationality}}">
                            <span class="error-message error-message-income-certificate-applicant_nationality_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>2.5 Applicant Occupation<span class="color-nic-red">*</span></label>
                            <select id="applicant_occupation_for_income_certificate" name="applicant_occupation_for_income_certificate" class="form-control select2" onchange="checkValidation('income-certificate', 'applicant_occupation_for_income_certificate', applicantOccupationValidationMessage); showOtherapplicantOccupationtext(this, 'applicant_other_occupation_div', 'income_certificate');" data-placeholder="Select Occupation" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-income-certificate-applicant_occupation_for_income_certificate"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <div id="applicant_other_occupation_div_for_income_certificate" style="display: none;">
                                <label>Other Occupation Detail</label>
                                <input type="text" id="applicant_other_occupation_text_for_income_certificate" name="applicant_other_occupation_text_for_income_certificate"
                                       maxlength="100" class="form-control" value="{{applicant_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('income-certificate', 'applicant_other_occupation_text_for_income_certificate', otherOccupationValidationMessage);"
                                       >
                                <span class="error-message error-message-income-certificate-applicant_other_occupation_text_for_income_certificate"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>2.6 Applicant Yearly Income<span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_yearly_income_for_income_certificate" 
                                   name="applicant_yearly_income_for_income_certificate" class="form-control"
                                   placeholder="Enter Applicant Yearly Income !" maxlength="8" 
                                   onblur="checkValidation('income-certificate', 'applicant_yearly_income_for_income_certificate', applicantYearlyIncomeValidationMessage);"
                                   value="{{applicant_yearly_income}}">
                            <span class="error-message error-message-income-certificate-applicant_yearly_income_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>3. Gender<span class="color-nic-red">*</span></label>
                            <div id="gender_container_for_income_certificate"></div>
                            <span class="error-message error-message-income-certificate-gender_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4. Marital Status<span class="color-nic-red">*</span></label>
                            <div id="marital_status_container_for_income_certificate"></div>
                            <span class="error-message error-message-income-certificate-marital_status_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    5.(a) Please Give Details of Members.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-income-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 150px;">Relation With Applicant</th>
                                            <th class="p-1" style="min-width: 150px;">Name</th>
                                            <th class="p-1" style="min-width: 150px;">Occupation</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <tr class="p-1">
                                            <td class="text-center v-a-m"><b>1</b></td>
                                            <td class="v-a-m">Father</td>
                                            <td>
                                                <input type="text" id="father_name_for_income_certificate" name="father_name_for_income_certificate"
                                                       maxlength="100" class="form-control" value="{{father_name}}" placeholder="Enter Father Name !"
                                                       >
                                                <span class="error-message error-message-income-certificate-father_name_for_income_certificate"></span>
                                            </td>
                                            <td>
                                                <select id="father_occupation_for_income_certificate" name="father_occupation_for_income_certificate" class="form-control select2" onchange="checkValidation('income-certificate', 'father_occupation_for_income_certificate', fatherOccupationValidationMessage); showParentOtherOccupationtext(this, 'father_other_occupation_text', 'income_certificate');" data-placeholder="Select Occupation" style="width: 100%;">
                                                </select>
                                                <span class="error-message error-message-income-certificate-father_occupation_for_income_certificate"></span>

                                                <input type="text" id="father_other_occupation_text_for_income_certificate" name="father_other_occupation_text_for_income_certificate"
                                                       maxlength="100" class="form-control" value="{{father_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('income-certificate', 'father_other_occupation_text_for_income_certificate', otherOccupationValidationMessage);"
                                                       style="display: none;">
                                                <span class="error-message error-message-income-certificate-father_other_occupation_text_for_income_certificate"></span>
                                            </td>
                                        </tr>
                                        <tr class="p-1">
                                            <td class="text-center v-a-m"><b>2</b></td>
                                            <td class="v-a-m">Mother</td>
                                            <td>
                                                <input type="text" id="mother_name_for_income_certificate" name="mother_name_for_income_certificate"
                                                       maxlength="100" class="form-control" value="{{mother_name}}" placeholder="Enter Mother Name !"
                                                       >
                                                <span class="error-message error-message-income-certificate-mother_name_for_income_certificate"></span>
                                            </td>
                                            <td>
                                                <select id="mother_occupation_for_income_certificate" name="mother_occupation_for_income_certificate" class="form-control select2" onchange="checkValidation('income-certificate', 'mother_occupation_for_income_certificate', motherOccupationValidationMessage); showParentOtherOccupationtext(this, 'mother_other_occupation_text', 'income_certificate');" data-placeholder="Select Occupation" style="width: 100%;">
                                                </select>
                                                <span class="error-message error-message-income-certificate-mother_occupation_for_income_certificate"></span>

                                                <input type="text" id="mother_other_occupation_text_for_income_certificate" name="mother_other_occupation_text_for_income_certificate"
                                                       maxlength="100" class="form-control" value="{{mother_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('income-certificate', 'mother_other_occupation_text_for_income_certificate', otherOccupationValidationMessage);"
                                                       style="display: none;">
                                                <span class="error-message error-message-income-certificate-mother_other_occupation_text_for_income_certificate"></span>
                                            </td>
                                        </tr>
                                        <tr class="p-1 marital_status_item_container_for_income_certificate" style="display: none;">
                                            <td class="text-center v-a-m"><b>3</b></td>
                                            <td class="v-a-m">Spouse</td>
                                            <td>
                                                <input type="text" id="spouse_name_for_income_certificate" name="spouse_name_for_income_certificate"
                                                       maxlength="100" class="form-control" value="{{spouse_name}}" placeholder="Enter Spouse Name !"
                                                       >
                                                <span class="error-message error-message-income-certificate-spouse_name_for_income_certificate"></span>
                                            </td>
                                            <td>
                                                <select id="spouse_occupation_for_income_certificate" name="spouse_occupation_for_income_certificate" class="form-control select2" onchange="checkValidation('income-certificate', 'spouse_occupation_for_income_certificate', spouseOccupationValidationMessage); showParentOtherOccupationtext(this, 'spouse_other_occupation_text', 'income_certificate');" data-placeholder="Select Occupation" style="width: 100%;">
                                                </select>
                                                <span class="error-message error-message-income-certificate-spouse_occupation_for_income_certificate"></span>

                                                <input type="text" id="spouse_other_occupation_text_for_income_certificate" name="spouse_other_occupation_text_for_income_certificate"
                                                       maxlength="100" class="form-control" value="{{spouse_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('income-certificate', 'spouse_other_occupation_text_for_income_certificate', otherOccupationValidationMessage);"
                                                       style="display: none;">
                                                <span class="error-message error-message-income-certificate-spouse_other_occupation_text_for_income_certificate"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label>5. Do You Have any other Earning Family Member ?</label>
                            <div id="applicant_have_earning_member_container_for_income_certificate"></div>
                            <span class="error-message error-message-income-certificate-applicant_have_earning_member_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="card applicant_have_earning_member_item_container_for_income_certificate" style="display: none;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    5.(b) Please Give Details of Other Earning Family Members.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-income-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 150px;">Name</th>
                                            <th class="p-1" style="min-width: 150px;">Relation With Applicant</th>
                                            <th class="p-1" style="min-width: 80px;">Age</th>
                                            <th class="p-1" style="min-width: 150px;">Profession</th>
                                            <th class="p-1" style="min-width: 80px;">Yearly Income</th>
                                            <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="family_member_info_container_for_income_certificate">
                                    </tbody>
                                </table>
                            </div> 
                            <div class="row">
                                <div class="col-6 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                    <label>Total Yearly Income</label>
                                    <input type="text" id="total_income_for_income_certificate"
                                           class="form-control" placeholder="Total Yearly Income !"
                                           readonly>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="IncomeCertificate.listview.addFamilyMemberInfo({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label>6. Do You Have Children ?</label>
                            <div id="if_applicant_have_children_container_for_income_certificate"></div>
                            <span class="error-message error-message-income-certificate-if_applicant_have_children_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="card if_applicant_have_children_item_container_for_income_certificate" style="display: none;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    6.(a) Please Give Details of Children.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-income-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 150px;">Name</th>
                                            <th class="p-1" style="min-width: 150px;">Age</th>
                                            <th class="p-1" style="min-width: 80px;">Profession/Occupation</th>
                                            <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="children_info_container_for_income_certificate">
                                    </tbody>
                                </table>
                            </div>  
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="IncomeCertifi cate.listview.addChildrenInfo({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label>7. Have You or Your Spouse have any immovable property ?<span class="color-nic-red">*</span></label>
                            <div id="if_wife_husband_have_property_container_for_income_certificate"></div>
                            <span class="error-message error-message-income-certificate-if_wife_husband_have_property_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="card if_wife_husband_have_property_item_container_for_income_certificate" style="display: none;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    7.(a) Please Give Details of immovable property.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-income-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 150px;">Type of immovable property</th>
                                            <th class="p-1" style="min-width: 150px;">Description of immovable property</th>
                                            <!-- <th class="p-1" style="min-width: 150px;">It’s Value</th> -->
                                            <th class="p-1" style="min-width: 150px;">Income derived from the property per year</th>
                                            <th class="p-1" style="min-width: 10px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="property_info_container_for_income_certificate">
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="IncomeCertifi cate.listview.addPropertyInfo({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>8. Have you or any other member of your Family having any income from other source such as Interest of Bank deposit etc. if so, Provide Details. </label>
                            <div id="have_you_any_member_income_otherside_container_for_income_certificate"></div>
                            <span class="error-message error-message-income-certificate-have_you_any_member_income_otherside_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="card have_you_any_member_income_otherside_item_container_for_income_certificate" style="display: none;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    8.(a) Please Give Details of Other Source of Income.
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-income-certificate-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                            <th class="p-1" style="min-width: 150px;">Source of Income</th>
                                            <th class="p-1" style="min-width: 150px;">Description Source of Income</th>
                                            <th class="p-1" style="min-width: 150px;">Yearly Income from Source</th>
                                            <th class="p-1" style="min-width: 10px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="other_income_info_container_for_income_certificate">
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="IncomeCertificat e.listview.addOtherIncomeInfo({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>9. For What Purpose is the Certificate of Income Required. <span class="color-nic-red">*</span></label>
                            <input type="text" id="purpose_of_income_certificate_for_income_certificate" name="purpose_of_income_certificate_for_income_certificate" class="form-control" placeholder="Enter Purpose of Certificate !"
                                   maxlength="100" onblur="checkValidation('income-certificate', 'purpose_of_income_certificate_for_income_certificate', purposeOfIncomeCertyValidationMessage);" value="{{purpose_of_income_certificate}}">
                            <span class="error-message error-message-income-certificate-purpose_of_income_certificate_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>10. Did you applied for a Certificate of Income at any time before and if so, when ?<span class="color-nic-red">*</span></label>
                            <div id="did_you_apply_income_certificate_before_container_for_income_certificate"></div>
                            <span class="error-message error-message-income-certificate-did_you_apply_income_certificate_before_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 did_you_apply_income_certificate_before_item_container_for_income_certificate"style="display: none;">
                            <label>10.1 Enter Detail of Certificate of Income which applied before. <span class="color-nic-red"></span></label>
                            <textarea id="when_you_apply_income_certificate_for_income_certificate" name="when_you_apply_income_certificate_for_income_certificate"
                                      class="form-control" placeholder="Enter Detail of Income Property!" 
                                      maxlength="100">{{when_you_apply_income_certificate}}</textarea>
                        </div>
                        <span class="error-message error-message-income-certificate-when_you_apply_income_certificate_for_income_certificate"></span>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="applicant_photo_doc_container_for_income_certificate">
                            <label>11. Upload Applicant Photo (Latest). <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-income-certificate-applicant_photo_doc_for_income_certificate"></div>
                        </div>
                        <div class="col-sm-12" id="applicant_photo_doc_name_container_for_income_certificate" style="display: none;">
                            <label>11. Upload Applicant Photo (Latest). <span style="color: red;">*</span></label><br>
                            <a target="_blank" id="applicant_photo_doc_download">
                                <img id="applicant_photo_doc_name_image_for_income_certificate"
                                     style="width: 250px; height: 250px; border: 2px solid blue;"
                                     class="spinner_name_container_for_income_certificate_{{VALUE_ONE}}">
                            </a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="birth_leaving_certy_doc_container_for_income_certificate">
                            <label>12. Applicant Original Birth Certificate / Leaving Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-income-certificate-birth_leaving_certy_doc_for_income_certificate"></div>
                        </div>
                        <div class="col-sm-12" id="birth_leaving_certy_doc_name_container_for_income_certificate" style="display: none;">
                            <label>12. Applicant Original Birth Certificate / Leaving Certificate <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="birth_leaving_certy_doc_download"><label id="birth_leaving_certy_doc_name_image_for_income_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_income_certificate_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="aadhar_card_doc_container_for_income_certificate">
                            <label>13. Applicant Original Aadhar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-income-certificate-aadhar_card_doc_for_income_certificate"></div>
                        </div>
                        <div class="col-sm-12" id="aadhar_card_doc_name_container_for_income_certificate" style="display: none;">
                            <label>13. Applicant Original Aadhar Card <span style="color: red;">* </span></label><br>
                            <a target="_blank" id="aadhar_card_doc_download"><label id="aadhar_card_doc_name_image_for_income_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_income_certificate_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12" id="election_card_doc_container_for_income_certificate">
                            <label>14. Applicant Original Election Card (Both Side)<span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                            <label class="f-w-n">Document Not Uploaded</label><br>
                            <div class="error-message error-message-income-certificate-election_card_doc_for_income_certificate"></div>
                        </div>
                        <div class="col-sm-12" id="election_card_doc_name_container_for_income_certificate" style="display: none;">
                            <label>14. Applicant Original Election Card (Both Side)<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="election_card_doc_download"><label id="election_card_doc_name_image_for_income_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_income_certificate_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <label>15. Do You have Income Proof ? <span class="color-nic-red">*</span></label>
                            <div id="have_you_income_proof_container_for_income_certificate"></div>
                            <span class="error-message error-message-income-certificate-have_you_income_proof_for_income_certificate"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div>
                            <div class="col-12" id="income_proof_doc_container_for_income_certificate">
                                <label class="income_proof_doc_upload_item_container_for_income_certificate" style="display: none;">15.1 Income Proof Form <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label>
                                <label class="self_declaration_doc_upload_item_container_for_income_certificate" style="display: none;">15.1 Self Declaration <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-income-certificate-income_proof_doc_for_income_certificate"></div>
                            </div>
                            <div class="form-group col-12" id="income_proof_doc_name_container_for_income_certificate" style="display: none;">
                                <label class="income_proof_doc_upload_item_container_for_income_certificate" style="display: none;">15.1 Income Proof Form <span style="color: red;">* </span></label>
                                <label class="self_declaration_doc_upload_item_container_for_income_certificate" style="display: none;">15.1 Self Declaration <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="income_proof_doc_download"><label id="income_proof_doc_name_image_for_income_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_income_certificate_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div id="marriage_certificate_doc_container_for_income_certificate">
                                <label>16. Marriage Certificate (if applicable) <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-income-certificate-marriage_certificate_doc_for_income_certificate"></div>
                            </div>
                            <div class="form-group" id="marriage_certificate_doc_name_container_for_income_certificate" style="display: none;">
                                <label>16. Marriage Certificate (if applicable)</label><br>
                                <a target="_blank" id="marriage_certificate_doc_download"><label id="marriage_certificate_doc_name_image_for_income_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_income_certificate_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div id="death_certificate_doc_container_for_income_certificate">
                                <label>17. Death Certificate (if applicable) <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-income-certificate-death_certificate_doc_for_income_certificate"></div>
                            </div>
                            <div class="form-group" id="death_certificate_doc_name_container_for_income_certificate" style="display: none;">
                                <label>17. Death Certificate (if applicable)</label><br>
                                <a target="_blank" id="death_certificate_doc_download"><label id="death_certificate_doc_name_image_for_income_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_income_certificate_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row mb-2 spouse_document_item_container_for_income_certificate" style="display: none;">
                        <div class="col-sm-12">
                            <div id="spouse_aadhar_card_doc_container_for_income_certificate">
                                <label>18. Spouse Original Aadhar Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                <label class="f-w-n">Document Not Uploaded</label><br>
                                <div class="error-message error-message-income-certificate-spouse_aadhar_card_doc_for_income_certificate"></div>
                            </div>
                            <div class="form-group" id="spouse_aadhar_card_doc_name_container_for_income_certificate" style="display: none;">
                                <label>18. Spouse Original Aadhar Card <span style="color: red;"> *</span></label><br>
                                <a target="_blank" id="spouse_aadhar_card_doc_download"><label id="spouse_aadhar_card_doc_name_image_for_income_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_income_certificate_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                            <div class="col-sm-12">
                                <div id="spouse_election_card_doc_container_for_income_certificate">
                                    <label>19. Spouse Original Election Card <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-income-certificate-spouse_election_card_doc_for_income_certificate"></div>
                                </div>
                                <div class="form-group" id="spouse_election_card_doc_name_container_for_income_certificate" style="display: none;">
                                    <label>19. Spouse Original Election Card <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="spouse_election_card_doc_download"><label id="spouse_election_card_doc_name_image_for_income_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_income_certificate_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                    </div>
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-4">
                                <label>Dated : <span style="color: red;">*</span></label>
                                <div class="input-group">
                                    <input type="text" class= "form-control" placeholder="dd-mm-yyyy"
                                           value="{{date_text}}" readonly="" id="date_for_income_certificate">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                    </div>
                                </div>
                                <span class="error-message error-message-income-certificate-date"></span>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="form-group col-sm-12"> 
                                <strong> Declaration <span class="color-nic-red">*</span></strong><br/>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <input type="checkbox" name="declaration_for_income_certificate" id="declaration_for_income_certificate" autocomplete="true" value="{{VALUE_ONE}}" >&nbsp;
                                        I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein.
                                        I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the 
                                        punishment as per the law and that the benefits availed by me shall be summarily withdrawn.
                                        <span style="color: red;">*</span>
                                    </span>
                                </div>
                                <span class="error-message error-message-income-certificate-declaration_for_income_certificate"></span>
                            </div>
                        </div> 
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" id="submit_btn_for_income_certificate" class="btn btn-sm btn-success" onclick="IncomeCertificate.listview.askForSubmitIncomeCertificate({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="IncomeCertificate.listview.loadIncomeCertificateData();">Close</button>
                    </div>
            </form>
        </div>
    </div>
</div>