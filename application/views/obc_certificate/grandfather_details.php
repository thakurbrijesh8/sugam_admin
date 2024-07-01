<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                 <h3 class="card-title f-w-b" style="float: none; text-align: center;">ObcCertificate Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application form for issue of  ObcCertificate Certificate </div>
            </div>
            <form role="form" id="obc_certificate_grandfather_form" name="obc_certificate_grandfather_form" onsubmit="return false;">

                <input type="hidden" id="obc_certificate_id" name="obc_certificate_id" value="{{obc_certificate_id}}">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-obc-certificate f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Grandgrandfather Information</h3>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1. Name of Grandgrandfather <span class="color-nic-red">*</span></label>
                            <input type="text" id="grandfather_name_for_cc" name="grandfather_name"
                                   maxlength="100" class="form-control" value="{{grandfather_name}}" placeholder="Enter Grandgrandfather Name !" onblur="checkValidation('obc_certificate', 'grandfather_name_for_cc', grandfatherNameValidationMessage);"
                                   >
                            <span class="error-message error-message-obc-certificate-grandfather_name_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Address</label><br/>
                            <label>2.1 House No./Flat No. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="grandfather_house_no_for_cc" name="grandfather_house_no" class="form-control" placeholder="Enter House No./Flat No. !" maxlength="100" value="{{grandfather_house_no}}" onblur="checkValidation('obc_certificate', 'grandfather_house_no_for_cc', houseNoValidationMessage);">
                            </div>
                            <span class="error-message error-message-obc-certificate-grandfather_house_no_for_cc"></span>
                        </div>
                        <div class="form-group col-sm-6" style="margin-top:22px;">
                            <label>2.2 Building Name / House Name <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="grandfather_house_name_for_cc" name="grandfather_house_name" class="form-control" placeholder="Enter Building Name / House Name !" maxlength="100" value="{{grandfather_house_name}}" onblur="checkValidation('obc_certificate', 'grandfather_house_name_for_cc', houseNameValidationMessage);">
                            </div>
                            <span class="error-message error-message-obc-certificate-grandfather_house_name_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2.3 Street <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <input type="text" id="grandfather_street_for_cc" name="grandfather_street" class="form-control" placeholder="Enter Street !"
                                       maxlength="10" onblur="checkValidation('obc_certificate', 'grandfather_street_for_cc', streetValidationMessage);" value="{{grandfather_street}}">
                            </div>
                            <span class="error-message error-message-obc-certificate-grandfather_street_for_cc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>2.4 Village / DMC Ward <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                 <input type="text" id="grandfather_village_dmc_ward_for_cc" name="grandfather_village_dmc_ward" class="form-control" placeholder="Enter Village / DMC Ward !"
                                       maxlength="10" onblur="checkValidation('obc_certificate', 'grandfather_village_dmc_ward_for_cc', villageNameValidationMessage);" value="{{grandfather_village_dmc_ward}}">
                            </div>
                            <span class="error-message error-message-obc-certificate-grandfather_village_dmc_ward_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2.5 Select City<span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select class="form-control select2" id="grandfather_city_for_cc" name="grandfather_city"
                                        data-placeholder="City !"  onblur="checkValidation('obc_certificate', 'grandfather_city_for_cc', selectCityValidationMessage);" >
                                    <option value="">Select City</option>
                                    <option value="1">Nani Daman</option>
                                    <option value="2">Moti Daman</option>
                                </select>
                            </div>
                            <span class="error-message error-message-obc-certificate-grandfather_city_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>3. Grandgrandfather's Nationality <span class="color-nic-red">*</span></label>
                            <input type="text" id="grandfather_nationality_for_cc" name="grandfather_nationality" class="form-control" placeholder="Enter Grandgrandfather's Nationality!"
                                   maxlength="100" onblur="checkValidation('obc_certificate', 'grandfather_nationality_for_cc', applicantNationalityValidationMessage);" value="{{grandfather_nationality}}">
                            <span class="error-message error-message-obc-certificate-grandfather_nationality_for_cc"></span>
                        </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-sm-4 col-md-4">
                                <label>4. Applicant Birth Place<span class="color-nic-red">*</span></label><br/>
                                <label>4.1 State <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="grandfather_born_place_state_for_cc" name="grandfather_born_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('cc', 'grandfather_born_place_state_for_cc', selectStateValidationMessage);
                                                ObcCertificate.listview.getDistrictData($(this), 'cc', 'grandfather_born_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-obc-certificate-grandfather_born_place_state_for_cc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>4.2 District <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="grandfather_born_place_district_for_cc" name="grandfather_born_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('cc', 'grandfather_born_place_district_for_cc', selectDistrictValidationMessage);
                                                ObcCertificate.listview.getVillageData($(this), 'cc', 'grandfather_born_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-obc-certificate-grandfather_born_place_district_for_cc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>4.3 Village <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="grandfather_born_place_village_for_cc" name="grandfather_born_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('cc', 'grandfather_born_place_village_for_cc', selectVillageValidationMessage);">
                                    </select>
                                </div>
                                <span class="error-message error-message-obc-certificate-grandfather_born_place_village_for_cc"></span>
                            </div>
                    </div>
                    <div class="row">
                            <div class="form-group col-sm-4 col-md-4">
                                <label>5. Original Native of<span class="color-nic-red">*</span></label><br/>
                                <label>5.1 State <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="grandfather_native_place_state_for_cc" name="grandfather_native_place_state" class="form-control select2"
                                            data-placeholder="Select State/UT"
                                            onchange="checkValidation('cc', 'grandfather_native_place_state_for_cc', selectStateValidationMessage);
                                                ObcCertificate.listview.getDistrictData($(this), 'cc', 'grandfather_native_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-obc-certificate-grandfather_native_place_state_for_cc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>5.2 District <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="grandfather_native_place_district_for_cc" name="grandfather_native_place_district" class="form-control select2"
                                            data-placeholder="Select District"
                                            onchange="checkValidation('cc', 'grandfather_native_place_district_for_cc', selectDistrictValidationMessage);
                                                ObcCertificate.listview.getVillageData($(this), 'cc', 'grandfather_native_place');">
                                    </select>
                                </div>
                                <span class="error-message error-message-obc-certificate-grandfather_native_place_district_for_cc"></span>
                            </div>
                            <div class="form-group col-sm-4 col-md-4" style="margin-top:22px">
                                <label>5.3 Village <span class="color-nic-red">*</span></label>
                                <div class="input-group">
                                    <select id="grandfather_native_place_village_for_cc" name="grandfather_native_place_village" class="form-control select2"
                                            data-placeholder="Select Village" onchange="checkValidation('cc', 'grandfather_native_place_village_for_cc', selectVillageValidationMessage);">
                                    </select>
                                </div>
                                <span class="error-message error-message-obc-certificate-grandfather_native_place_village_for_cc"></span>
                            </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Grandgrandfather's Occupation. <span class="color-nic-red">*</span></label>
                            <select id="grandfather_occupation_for_cc" name="grandfather_occupation" class="form-control select2" onchange="checkValidation('obc_certificate', 'grandfather_occupation_for_cc', applicantOccupationValidationMessage);if(this.value == 12){$('.grandfather_other_occupation_div_for_cc').show();}" data-placeholder="Select Occupation" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-obc-certificate-grandfather_occupation_for_cc"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <div class="grandfather_other_occupation_div_for_cc" style="display: none;">
                                <label>6.1 Other Occupation Detail</label>
                                <input type="text" id="grandfather_other_occupation_for_cc" name="grandfather_other_occupation"
                                       maxlength="100" class="form-control" value="{{grandfather_other_occupation}}" placeholder="Enter Other Occupation !" onchange="checkValidation('obc_certificate', 'grandfather_other_occupation_for_cc', otherOccupationValidationMessage);"
                                       >
                                <span class="error-message error-message-obc-certificate-grandfather_other_occupation_for_cc"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>7. Grandgrandfather's Aadhar Number </label>
                            <div class="input-group">
                                <input type="text" id="grandfather_aadhaar_for_cc" name="grandfather_aadhaar" class="form-control" placeholder="Enter Aadhar Number"
                                       maxlength="15" onkeyup="checkNumeric($(this));" onblur="aadharNumberValidation('obc_certificate', 'grandfather_aadhaar_for_cc', invalidAadharNumberValidationMessage);" value="{{grandfather_aadhaar}}">
                            </div>
                            <span class="error-message error-message-obc-certificate-grandfather_aadhaar_for_cc"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8. Grandgrandfather's Election Number </label>
                            <div class="input-group">
                                <input type="text" id="grandfather_election_no_for_cc" name="grandfather_election_no" class="form-control" placeholder="Enter Election Number"
                                       maxlength="15" onblur="aadharNumberValidation('obc_certificate', 'grandfather_election_no_for_cc', electionNumberValidationMessage);" value="{{grandfather_election_no}}">
                            </div>
                            <span class="error-message error-message-obc-certificate-grandfather_election_no_for_cc"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" id="draft_btn_for_obc_certificate" class="btn btn-sm btn-success float-right" onclick="ObcCertificate.listview.submitGrandgrandfatherDetails({{VALUE_ONE}});" style="margin-right: 5px;">Next <span class="fas fa-hand-point-right"></span></button>
                        <button type="button" id="previous_btn_for_grandfather_details" class="btn btn-sm btn-success float-right" onclick="ObcCertificate.listview.editOrViewObcCertificate($('#previous_btn_for_obc_certificate'), '{{obc_certificate_id}}', true);" style="margin-right: 5px;"><span class="fas fa-hand-point-left"></span> Previous</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="ObcCertificate.listview.loadObcCertificateData();">Cancel</button>
                        
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>