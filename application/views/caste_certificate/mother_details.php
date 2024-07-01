<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                 <h3 class="card-title f-w-b" style="float: none; text-align: center;">CasteCertificate Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application form for issue of  CasteCertificate Certificate </div>
            </div>
            <form role="form" id="caste_certificate_mother_form" name="caste_certificate_mother_form" onsubmit="return false;">

                <input type="hidden" id="caste_certificate_id" name="caste_certificate_id" value="{{caste_certificate_id}}">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-caste-certificate f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Mother Information</h3>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. Name of Mother <span class="color-nic-red">*</span></label>
                            <input type="text" id="mother_name_for_cc" name="mother_name"
                                   maxlength="100" class="form-control" value="{{mother_name}}" placeholder="Enter Mother Name !" onblur="checkValidation('caste_certificate', 'mother_name_for_cc', motherNameValidationMessage);"
                                   >
                            <span class="error-message error-message-caste-certificate-mother_name_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Address</label><br/>
                            <label>2.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="mother_house_no_for_cc" name="mother_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{mother_house_no}}" onblur="checkValidation('caste_certificate', 'mother_house_no_for_cc', houseNoValidationMessage);">
                            </div>
                            <span class="error-message error-message-caste-certificate-mother_house_no_for_cc"></span>
                        </div>
                        <div class="form-group col-sm-6" style="margin-top:22px;">
                            <label>2.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="mother_house_name_for_cc" name="mother_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{mother_house_name}}" onblur="checkValidation('caste_certificate', 'mother_house_name_for_cc', houseNameValidationMessage);">
                            </div>
                            <span class="error-message error-message-caste-certificate-mother_house_name_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2.3 Street <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <input type="text" id="mother_street_for_cc" name="mother_street" class="form-control" placeholder="Enter Street !"
                                       maxlength="10" onblur="checkValidation('caste_certificate', 'mother_street_for_cc', streetValidationMessage);" value="{{mother_street}}">
                            </div>
                            <span class="error-message error-message-caste-certificate-mother_street_for_cc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>2.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <input type="text" id="mother_village_dmc_ward_for_cc" name="mother_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                       maxlength="10" onblur="checkValidation('caste_certificate', 'mother_village_dmc_ward_for_cc', villageNameValidationMessage);" value="{{mother_village_dmc_ward}}">
                            </div>
                            <span class="error-message error-message-caste-certificate-mother_village_dmc_ward_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2.5 Select City<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control select2" id="mother_city_for_cc" name="mother_city"
                                        data-placeholder="City !"  onblur="checkValidation('caste_certificate', 'mother_city_for_cc', selectCityValidationMessage);" >
                                    <option value="">Select City</option>
                                    <option value="1">Nani Daman</option>
                                    <option value="2">Moti Daman</option>
                                </select>
                            </div>
                            <span class="error-message error-message-caste-certificate-mother_city_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>3. Mother's Nationality <span class="color-nic-red">*</span></label>
                            <input type="text" id="mother_nationality_for_cc" name="mother_nationality" class="form-control" placeholder="Enter Mother's Nationality!"
                                   maxlength="100" onblur="checkValidation('caste_certificate', 'mother_nationality_for_cc', applicantNationalityValidationMessage);" value="{{mother_nationality}}">
                            <span class="error-message error-message-caste-certificate-mother_nationality_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-sm-4 col-md-4">
                                <label>4. Applicant Birth Place<span class="color-nic-red">*</span></label><br/>
                                <label>4.1 State <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="mother_born_place_state_for_cc" name="mother_born_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('cc', 'mother_born_place_state_for_cc', selectStateValidationMessage);
                                                CasteCertificate.listview.getDistrictData($(this), 'cc', 'mother_born_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-caste-certificate-mother_born_place_state_for_cc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>4.2 District <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="mother_born_place_district_for_cc" name="mother_born_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('cc', 'mother_born_place_district_for_cc', selectDistrictValidationMessage);
                                                CasteCertificate.listview.getVillageData($(this), 'cc', 'mother_born_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-caste-certificate-mother_born_place_district_for_cc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>4.3 Village <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="mother_born_place_village_for_cc" name="mother_born_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('cc', 'mother_born_place_village_for_cc', selectVillageValidationMessage);">
                                    </select>
                                </div>
                                <span class="error-message error-message-caste-certificate-mother_born_place_village_for_cc"></span>
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-sm-4 col-md-4">
                                <label>5. Original Native of<span class="color-nic-red">*</span></label><br/>
                                <label>5.1 State <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="mother_native_place_state_for_cc" name="mother_native_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('cc', 'mother_native_place_state_for_cc', selectStateValidationMessage);
                                                CasteCertificate.listview.getDistrictData($(this), 'cc', 'mother_native_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-caste-certificate-mother_native_place_state_for_cc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>5.2 District <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="mother_native_place_district_for_cc" name="mother_native_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('cc', 'mother_native_place_district_for_cc', selectDistrictValidationMessage);
                                                CasteCertificate.listview.getVillageData($(this), 'cc', 'mother_native_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-caste-certificate-mother_native_place_district_for_cc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>5.3 Village <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="mother_native_place_village_for_cc" name="mother_native_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('cc', 'mother_native_place_village_for_cc', selectVillageValidationMessage);">
                                    </select>
                                </div>
                                <span class="error-message error-message-caste-certificate-mother_native_place_village_for_cc"></span>
                            </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Mother's Occupation. <span class="color-nic-red">*</span></label>
                            <select id="mother_occupation_for_cc" name="mother_occupation" class="form-control select2" onchange="checkValidation('caste_certificate', 'mother_occupation_for_cc', applicantOccupationValidationMessage);if(this.value == 12){$('.mother_other_occupation_div_for_cc').show();}" data-placeholder="Select Occupation" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-caste-certificate-mother_occupation_for_cc"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <div class="mother_other_occupation_div_for_cc" style="display: none;">
                                <label>6.1 Other Occupation Detail</label>
                                <input type="text" id="mother_other_occupation_for_cc" name="mother_other_occupation"
                                       maxlength="100" class="form-control" value="{{mother_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('caste_certificate', 'mother_other_occupation_for_cc', otherOccupationValidationMessage);"
                                       >
                                <span class="error-message error-message-caste-certificate-mother_other_occupation_for_cc"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7. Mother's Aadhar Number </label>
                            <div class="input-group">
                                <input type="text" id="mother_aadhaar_for_cc" name="mother_aadhaar" class="form-control" placeholder="Enter Aadhar Number"
                                       maxlength="15" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('caste_certificate', 'mother_aadhaar_for_cc', invalidAadharNumberValidationMessage);" value="{{mother_aadhaar}}">
                            </div>
                            <span class="error-message error-message-caste-certificate-mother_aadhaar_for_cc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8. Mother's Election Number </label>
                            <div class="input-group">
                                <input type="text" id="mother_election_no_for_cc" name="mother_election_no" class="form-control" placeholder="Enter Election Number"
                                       maxlength="15" onblur="aadharNumberValidation('caste_certificate', 'mother_election_no_for_cc', electionNumberValidationMessage);" value="{{mother_election_no}}">
                            </div>
                            <span class="error-message error-message-caste-certificate-mother_election_no_for_cc"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" id="draft_btn_for_caste_certificate" class="btn btn-sm btn-success float-right" onclick="CasteCertificate.listview.submitMotherDetails({{VALUE_ONE}});" style="margin-right: 5px;">Next <span class="fas fa-hand-point-right"></span></button>
                        <button type="button" id="previous_btn_for_mother_details" class="btn btn-sm btn-success float-right" onclick="CasteCertificate.listview.editOrViewCasteCertificate($('#previous_btn_for_caste_certificate'), '{{caste_certificate_id}}', true, {{VALUE_ONE}});" style="margin-right: 5px;"><span class="fas fa-hand-point-left"></span> Previous</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="CasteCertificate.listview.loadCasteCertificateData();">Cancel</button>
                        
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>