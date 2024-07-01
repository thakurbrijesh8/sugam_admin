<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Application for issue of Death Certificate</h3>
            </div>
            <form role="form" id="death_certificate_form" name="death_certificate_form" onsubmit="return false;"
                  autocomplete="off">
                <input type="hidden" id="death_certificate_id_for_death_certificate" name="death_certificate_id_for_death_certificate" value="{{death_certificate_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-death-certificate f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>

                    <div class="card" style="margin-top: 13px;">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Basic Details</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>1. District<span class="color-nic-red">*</span></label>
                                    <select id="district_for_death_certificate" name="district_for_death_certificate" class="form-control select2"
                                            onchange="checkValidation('death-certificate', 'district_for_death_certificate', selectDistrictValidationMessage);"
                                            data-placeholder="Select District" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-death-certificate-district_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2. Name of Applicant <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_name_for_death_certificate" name="applicant_name_for_death_certificate" class="form-control" placeholder="Enter Name of Applicant !"
                                           maxlength="100" onblur="checkValidation('death-certificate', 'applicant_name_for_death_certificate', applicantNameValidationMessage);" value="{{applicant_name}}">
                                    <span class="error-message error-message-death-certificate-applicant_name_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>3. Applicant's Mobile Number<span class="color-nic-red">*</span></label>
                                    <input type="text" id="mobile_number_for_death_certificate" name="mobile_number_for_death_certificate" class="form-control" placeholder="Enter Mobile Number !"
                                           maxlength="10" onkeyup="checkNumeric($(this));"
                                           onblur="checkValidationForMobileNumber('death-certificate', 'mobile_number_for_death_certificate');" value="{{mobile_number}}">
                                    <span class="error-message error-message-death-certificate-mobile_number_for_death_certificate"></span>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>4. Applicant's Aadhar Number</label>
                                    <div class="input-group">
                                        <input type="text" id="aadhar_number_for_death_certificate" name="aadhar_number_for_death_certificate"
                                               class="form-control" placeholder="Enter Aadhar Number !"
                                               onblur="aadharNumberValidation('death-certificate', 'aadhar_number_for_death_certificate');"
                                               maxlength="12" value="{{aadhar_number}}">
                                    </div>
                                    <span class="error-message error-message-death-certificate-aadhar_number_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>5. Applicant's Email Address </label>
                                    <input type="text" id="email_for_death_certificate" name="email_for_death_certificate"
                                           class="form-control" placeholder="Enter Email !"  maxlength="100"
                                           onblur="checkValidationForEmail('death-certificate', 'email_for_death_certificate');" value="{{email}}">
                                    <span class="error-message error-message-death-certificate-email_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>6. Applicant's Communication Address <span class="color-nic-red">*</span></label>
                                    <textarea id="communication_address_for_death_certificate" name="communication_address_for_death_certificate" class="form-control" placeholder="Enter Communication Address !"
                                              onblur="checkValidation('death-certificate', 'communication_address_for_death_certificate', communicationAddressValidationMessage);"
                                              maxlength="200" >{{communication_address}}</textarea>
                                    <span class="error-message error-message-death-certificate-communication_address_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>7. Applicant's Permanent Address <span class="color-nic-red">*</span></label>
                                    <textarea id="applicant_address_for_death_certificate" name="applicant_address_for_death_certificate" class="form-control"
                                              onblur="checkValidation('death-certificate', 'applicant_address_for_death_certificate', communicationAddressValidationMessage);"
                                              placeholder="Enter Applicant's Permanent Address !" maxlength="200">{{applicant_address}}</textarea>
                                    <span class="error-message error-message-death-certificate-applicant_address_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>8. Date of Birth<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applicant_dob_for_death_certificate" id="applicant_dob_for_death_certificate" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value=""
                                               onblur="checkValidation('death-certificate', 'applicant_dob_for_death_certificate', birthDateValidationMessage); calculateAge('for_death_certificate');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-death-certificate-applicant_dob_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>9. Applicant Age<span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_age_for_death_certificate" 
                                           name="applicant_age_for_death_certificate" class="form-control"
                                           placeholder="Enter Applicant Age !" maxlength="100" 
                                           onblur="checkValidation('death-certificate', 'applicant_age_for_death_certificate', applicantAgeValidationMessage);"
                                           value="{{applicant_age}}" readonly="">
                                    <span class="error-message error-message-death-certificate-applicant_age_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>10. Relationship With Applicant <span class="color-nic-red">*</span></label>
                                    <select id="relation_status_for_death_certificate" name="relation_status_for_death_certificate" class="form-control select2" onchange="checkValidation('death-certificate', 'relation_status_for_death_certificate', relationStatusValidationMessage); DeathCertificate.listview.relationshipChangeEvent($(this));" data-placeholder="Select Relationship With Applicant !" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-death-certificate-relation_status_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 other_relationship_with_applicant_div_for_death_certificate" style="display: none;">
                                    <label>10.1 Other Relationship With Applicant <span class="color-nic-red">*</span></label>
                                    <input type="text" id="other_relationship_with_applicant_for_death_certificate" name="other_relationship_with_applicant_for_death_certificate" class="form-control" placeholder="Enter Other Relationship With Applicant !"
                                           onblur="checkValidation('death-certificate', 'other_relationship_with_applicant_for_death_certificate', otherRelationshipValidationMessage);"
                                           maxlength="100" value="{{other_relationship_with_applicant}}">
                                    <span class="error-message error-message-death-certificate-other_relationship_with_applicant_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>11. Purpose <span class="color-nic-red">*</span></label>
                                    <input type="text" id="purpose_for_death_certificate" name="purpose_for_death_certificate" class="form-control" placeholder="Enter Purpose!"
                                           maxlength="100" onblur="checkValidation('death-certificate', 'purpose_for_death_certificate', purposeForDeathCertificateValidationMessage);" value="{{purpose}}">
                                    <span class="error-message error-message-death-certificate-purpose_for_death_certificate"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Death Person Details</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>12. Death Person Name<span class="color-nic-red">*</span></label>
                                    <input type="text" id="death_person_name_for_death_certificate" 
                                           name="death_person_name_for_death_certificate" class="form-control"
                                           placeholder="Enter Death Person Name !" maxlength="100" 
                                           onblur="checkValidation('death-certificate', 'death_person_name_for_death_certificate', deathPersonNameValidationMessage);"
                                           value="{{death_person_name}}">
                                    <span class="error-message error-message-death-certificate-death_person_name_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>13. Gender<span class="color-nic-red">*</span></label>
                                    <div id="gender_container_for_death_certificate"></div>
                                    <span class="error-message error-message-death-certificate-gender_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>14. Date of Death<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="death_person_dod_for_death_certificate" id="death_person_dod_for_death_certificate" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value=""
                                               onblur="checkValidation('death-certificate', 'death_person_dod_for_death_certificate', deathDateValidationMessage); calculateAge('for_death_certificate');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-death-certificate-death_person_dod_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>15. Place of Death<span class="color-nic-red">*</span></label>
                                    <input type="text" id="death_place_for_death_certificate" 
                                           name="death_place_for_death_certificate" class="form-control"
                                           placeholder="Enter Place of Death !" maxlength="100" 
                                           onblur="checkValidation('death-certificate', 'death_place_for_death_certificate', deathOfPlaceValidationMessage);"
                                           value="{{death_place}}">
                                    <span class="error-message error-message-death-certificate-death_place_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>16. Name Of Mother <span class="color-nic-red">*</span></label>
                                    <input type="text" id="mother_name_for_death_certificate" name="mother_name_for_death_certificate" class="form-control" placeholder="Enter Name Of Mother !"
                                           maxlength="100" onblur="checkValidation('death-certificate', 'mother_name_for_death_certificate', motherNameValidationMessage);" value="{{mother_name}}">
                                    <span class="error-message error-message-death-certificate-mother_name_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>17. Name Of Father<span class="color-nic-red">*</span></label>
                                    <input type="text" id="father_name_for_death_certificate" name="father_name_for_death_certificate" class="form-control" placeholder="Enter Name Of Father !"
                                           maxlength="100" onblur="checkValidation('death-certificate', 'father_name_for_death_certificate', fatherNameValidationMessage);" value="{{father_name}}">
                                    <span class="error-message error-message-death-certificate-father_name_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>18. Name Of Husband/Wife </label>
                                    <input type="text" id="husband_wife_name_for_death_certificate" name="husband_wife_name_for_death_certificate" class="form-control" placeholder="Enter Name Of Husband/Wife !"
                                           maxlength="100" value="{{husband_wife_name}}">
                                    <span class="error-message error-message-death-certificate-husband_wife_name_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>19. Address Of The Deceased at The Time Of Death <span class="color-nic-red">*</span></label>
                                    <textarea id="dp_communication_address_for_death_certificate" name="dp_communication_address_for_death_certificate" class="form-control" placeholder="Enter Address Of The Deceased At The Time Of Birth !"
                                              onblur="checkValidation('death-certificate', 'dp_communication_address_for_death_certificate', communicationAddressValidationMessage);"
                                              maxlength="200" >{{dp_communication_address}}</textarea>
                                    <span class="error-message error-message-death-certificate-dp_communication_address_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>20. Permanent Address Of The Deceased<span class="color-nic-red">*</span></label>
                                    <textarea id="dp_permanent_address_for_death_certificate" name="dp_permanent_address_for_death_certificate" class="form-control"
                                              onblur="checkValidation('death-certificate', 'dp_permanent_address_for_death_certificate', communicationAddressValidationMessage);"
                                              placeholder="Enter Permanent Address Of The Deceased !" maxlength="200">{{dp_permanent_address}}</textarea>
                                    <span class="error-message error-message-death-certificate-dp_permanent_address_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>21. Registration Number<span class="color-nic-red">*</span></label>
                                    <input type="text" id="registration_number_for_death_certificate" 
                                           name="registration_number_for_death_certificate" class="form-control"
                                           placeholder="Enter Registration Number !" maxlength="8" 
                                           onblur="checkValidation('death-certificate', 'registration_number_for_death_certificate', registrationNumberValidationMessage);"
                                           value="{{registration_number}}">
                                    <span class="error-message error-message-death-certificate-registration_number_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>22. Date / Year of Registration <span class="color-nic-red">*</span></label>
                                    <div id="date_year_container_for_death_certificate"></div>
                                    <span class="error-message error-message-death-certificate-date_year_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 date_item_container_for_death_certificate" style="display: none;">
                                    <label>22.1 Date of Registration<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="registration_date_for_death_certificate" id="registration_date_for_death_certificate" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value=""
                                               onblur="checkValidation('death-certificate', 'registration_date_for_death_certificate', registrationDateValidationMessage);" >
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-death-certificate-registration_date_for_death_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 year_item_container_for_death_certificate" style="display: none;">
                                    <label>22.1 Year of Registration<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="registration_year_for_death_certificate" id="registration_year_for_death_certificate" class="form-control"
                                               placeholder="Year of Registration !"  value="{{registration_year}}" maxlength="4" onkeyup="checkNumeric($(this));"
                                               onblur="checkValidation('death-certificate', 'registration_year_for_death_certificate', registrationYearValidationMessage);" >
                                    </div>
                                    <span class="error-message error-message-death-certificate-registration_year_for_death_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>23. Applying For <span class="color-nic-red">*</span></label>
                                    <select id="applying_for_death_certificate" name="applying_for_death_certificate" class="form-control select2" onchange="checkValidation('death-certificate', 'applying_for_death_certificate', applyingForValidationMessage);" data-placeholder="Select Applying For !" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-death-certificate-applying_for_death_certificate"></span>
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
                            <span style="color: red;font-weight: bold;">Note : Must upload pdf file with original scan documents <br></span><br/>
                            <div class="row mb-2">
                                <div class="col-12" id="applicant_photo_doc_container_for_death_certificate">
                                    <label>19.Applicant Photo. <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-death-certificate-applicant_photo_doc_for_death_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="applicant_photo_doc_name_container_for_death_certificate" style="display: none;">
                                    <label>19.Applicant Photo. <span style="color: red;">*</span></label><br>
                                    <a target="_blank" id="applicant_photo_doc_download">
                                        <img id="applicant_photo_doc_name_image_for_death_certificate"
                                             style="width: 250px; height: 250px; border: 2px solid blue;"
                                             class="spinner_name_container_for_death_certificate_{{VALUE_ONE}}">
                                    </a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12" id="birth_certi_doc_container_for_death_certificate">
                                    <label>20. Birth Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-death-certificate-birth_certi_doc_for_death_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="birth_certi_doc_name_container_for_death_certificate" style="display: none;">
                                    <label>20. Birth Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="birth_certi_doc_download"><label id="birth_certi_doc_name_image_for_death_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_death_certificate_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12" id="aadhar_card_doc_container_for_death_certificate">
                                    <label>21. Aadhar Card <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-death-certificate-aadhar_card_doc_for_death_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="aadhar_card_doc_name_container_for_death_certificate" style="display: none;">
                                    <label>21. Aadhar Card <span style="color: red;"> </span></label><br>
                                    <a target="_blank" id="aadhar_card_doc_download"><label id="aadhar_card_doc_name_image_for_death_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_death_certificate_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12" id="old_death_certi_doc_container_for_death_certificate">
                                    <label>22. Old Death Certificate <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-death-certificate-old_death_certi_doc_for_death_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="old_death_certi_doc_name_container_for_death_certificate" style="display: none;">
                                    <label>22. Old Death Certificate <span style="color: red;"> </span></label><br>
                                    <a target="_blank" id="old_death_certi_doc_download"><label id="old_death_certi_doc_name_image_for_death_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_death_certificate_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" id="submit_btn_for_death_certificate" class="btn btn-sm btn-success" 
                                onclick="DeathCertificate.listview.askForSubmitDeathCertificate({{VALUE_TWO}});" 
                                style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" 
                                onclick="DeathCertificate.listview.loadDeathCertificateData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#relation_status_for_death_certificate').on('select2:clear', function (e) {
    $('.other_relationship_with_applicant_div_for_death_certificate').hide();
    });
</script>