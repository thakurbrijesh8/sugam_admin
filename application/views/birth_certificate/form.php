<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Application for issue of Birth Certificate</h3>
            </div>
            <form role="form" id="birth_certificate_form" name="birth_certificate_form" onsubmit="return false;"
                  autocomplete="off">
                <input type="hidden" id="birth_certificate_id_for_birth_certificate" name="birth_certificate_id_for_birth_certificate" value="{{birth_certificate_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-birth-certificate f-w-b"
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
                                    <select id="district_for_birth_certificate" name="district_for_birth_certificate" class="form-control select2"
                                            onchange="checkValidation('birth-certificate', 'district_for_birth_certificate', selectDistrictValidationMessage);"
                                            data-placeholder="Select District" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-birth-certificate-district_for_birth_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>2. Name of Applicant <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_name_for_birth_certificate" name="applicant_name_for_birth_certificate" class="form-control" placeholder="Enter Name of Applicant !"
                                           maxlength="100" onblur="checkValidation('birth-certificate', 'applicant_name_for_birth_certificate', applicantNameValidationMessage);" value="{{applicant_name}}">
                                    <span class="error-message error-message-birth-certificate-applicant_name_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>3. Applicant's Mobile Number<span class="color-nic-red">*</span></label>
                                    <input type="text" id="mobile_number_for_birth_certificate" name="mobile_number_for_birth_certificate" class="form-control" placeholder="Enter Mobile Number !"
                                           maxlength="10" onkeyup="checkNumeric($(this));"
                                           onblur="checkValidationForMobileNumber('birth-certificate', 'mobile_number_for_birth_certificate');" value="{{mobile_number}}">
                                    <span class="error-message error-message-birth-certificate-mobile_number_for_birth_certificate"></span>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>4. Applicant's Aadhar Number</label>
                                    <input type="text" id="aadhar_number_for_birth_certificate" name="aadhar_number_for_birth_certificate"
                                           class="form-control" placeholder="Enter Aadhar Number !"
                                           onblur="aadharNumberValidation('birth-certificate', 'aadhar_number_for_birth_certificate');"
                                           maxlength="12" value="{{aadhar_number}}">
                                    <span class="error-message error-message-birth-certificate-aadhar_number_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>5. Applicant's Email Address </label>
                                    <input type="text" id="email_for_birth_certificate" name="email_for_birth_certificate"
                                           class="form-control" placeholder="Enter Email !"  maxlength="100"
                                           onblur="checkValidationForEmail('birth-certificate', 'email_for_birth_certificate');" value="{{email}}">
                                    <span class="error-message error-message-birth-certificate-email_for_birth_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>6. Applicant's Communication Address <span class="color-nic-red">*</span></label>
                                    <textarea id="communication_address_for_birth_certificate" name="communication_address_for_birth_certificate" class="form-control" placeholder="Enter Communication Address !"
                                              onblur="checkValidation('birth-certificate', 'communication_address_for_birth_certificate', communicationAddressValidationMessage);"
                                              maxlength="200" >{{communication_address}}</textarea>
                                    <span class="error-message error-message-birth-certificate-communication_address_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>7. Applicant's Permanent Address <span class="color-nic-red">*</span></label>
                                    <textarea id="applicant_address_for_birth_certificate" name="applicant_address_for_birth_certificate" class="form-control"
                                              onblur="checkValidation('birth-certificate', 'applicant_address_for_birth_certificate', communicationAddressValidationMessage);"
                                              placeholder="Enter Applicant's Permanent Address !" maxlength="200">{{applicant_address}}</textarea>
                                    <span class="error-message error-message-birth-certificate-applicant_address_for_birth_certificate"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">Required Details</div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>8. Date of Birth<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="applicant_dob_for_birth_certificate" id="applicant_dob_for_birth_certificate" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value=""
                                               onblur="checkValidation('birth-certificate', 'applicant_dob_for_birth_certificate', birthDateValidationMessage); calculateAge('for_birth_certificate');">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-birth-certificate-applicant_dob_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-3">
                                    <label>9. Applicant Age<span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_age_for_birth_certificate" 
                                           name="applicant_age_for_birth_certificate" class="form-control"
                                           placeholder="Enter Applicant Age !" maxlength="100" 
                                           onblur="checkValidation('birth-certificate', 'applicant_age_for_birth_certificate', applicantAgeValidationMessage);"
                                           value="{{applicant_age}}" readonly="">
                                    <span class="error-message error-message-birth-certificate-applicant_age_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>10. Place Of Birth <span class="color-nic-red">*</span></label>
                                    <input type="text" id="applicant_born_place_for_birth_certificate" 
                                           name="applicant_born_place_for_birth_certificate" class="form-control"
                                           placeholder="Enter Place Of Birth  !" maxlength="100" 
                                           onblur="checkValidation('birth-certificate', 'applicant_born_place_for_birth_certificate', applicantBornPlaceValidationMessage);"
                                           value="{{applicant_born_place}}">
                                    <span class="error-message error-message-birth-certificate-applicant_born_place_for_birth_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>11. Gender<span class="color-nic-red">*</span></label>
                                    <div id="gender_container_for_birth_certificate"></div>
                                    <span class="error-message error-message-birth-certificate-gender_for_birth_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>12. Mother Name <span class="color-nic-red">*</span></label>
                                    <input type="text" id="mother_name_for_birth_certificate" name="mother_name_for_birth_certificate" class="form-control" placeholder="Enter Mother Name!"
                                           maxlength="100" onblur="checkValidation('birth-certificate', 'mother_name_for_birth_certificate', motherNameValidationMessage);" value="{{mother_name}}">
                                    <span class="error-message error-message-birth-certificate-mother_name_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>13. Father Name<span class="color-nic-red">*</span></label>
                                    <input type="text" id="father_name_for_birth_certificate" name="father_name_for_birth_certificate" class="form-control" placeholder="Enter Father Name!"
                                           maxlength="100" onblur="checkValidation('birth-certificate', 'father_name_for_birth_certificate', fatherNameValidationMessage);" value="{{father_name}}">
                                    <span class="error-message error-message-birth-certificate-father_name_for_birth_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>14. Registration Number<span class="color-nic-red">*</span></label>
                                    <input type="text" id="registration_number_for_birth_certificate" 
                                           name="registration_number_for_birth_certificate" class="form-control"
                                           placeholder="Enter Registration Number !" maxlength="8" 
                                           onblur="checkValidation('birth-certificate', 'registration_number_for_birth_certificate', registrationNumberValidationMessage);"
                                           value="{{registration_number}}">
                                    <span class="error-message error-message-birth-certificate-registration_number_for_birth_certificate"></span>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label>15. Date / Year of Registration <span class="color-nic-red">*</span></label>
                                    <div id="date_year_container_for_birth_certificate"></div>
                                    <span class="error-message error-message-birth-certificate-date_year_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 date_item_container_for_birth_certificate" style="display: none;">
                                    <label>15.1 Date of Registration<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="registration_date_for_birth_certificate" id="registration_date_for_birth_certificate" class="form-control"
                                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                               value=""
                                               onblur="checkValidation('birth-certificate', 'registration_date_for_birth_certificate', registrationDateValidationMessage);" >
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                        </div>
                                    </div>
                                    <span class="error-message error-message-birth-certificate-registration_date_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-3 year_item_container_for_birth_certificate" style="display: none;">
                                    <label>15.1 Year of Registration<span style="color: red;">*</span></label>
                                    <div class="input-group date">
                                        <input type="text" name="registration_year_for_birth_certificate" id="registration_year_for_birth_certificate" class="form-control"
                                               placeholder="Year of Registration !"  value="{{registration_year}}" maxlength="4" onkeyup="checkNumeric($(this));"
                                               onblur="checkValidation('birth-certificate', 'registration_year_for_birth_certificate', registrationYearValidationMessage);" >
                                    </div>
                                    <span class="error-message error-message-birth-certificate-registration_year_for_birth_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label>16. Relationship With Applicant<span class="color-nic-red">*</span></label>
                                    <select id="relationship_with_applicant_for_birth_certificate" name="relationship_with_applicant_for_birth_certificate" class="form-control select2" onchange="checkValidation('death-certificate', 'relationship_with_applicant_for_birth_certificate', relationStatusValidationMessage); BirthCertificate.listview.relationshipChangeEvent($(this));" data-placeholder="Select Relationship With Applicant" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-birth-certificate-relationship_with_applicant_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6 other_relationship_with_applicant_div_for_birth_certificate" style="display: none;">
                                    <label>16.1 Other Relationship With Applicant <span class="color-nic-red">*</span></label>
                                    <input type="text" id="other_relationship_with_applicant_for_birth_certificate" name="other_relationship_with_applicant_for_birth_certificate" class="form-control" placeholder="Enter Other Relationship With Applicant !"
                                           onblur="checkValidation('birth-certificate', 'other_relationship_with_applicant_for_birth_certificate', otherRelationshipValidationMessage);"
                                           maxlength="100" value="{{other_relationship_with_applicant}}">
                                    <span class="error-message error-message-birth-certificate-other_relationship_with_applicant_for_birth_certificate"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label>17. Purpose <span class="color-nic-red">*</span></label>
                                    <input type="text" id="purpose_for_birth_certificate" name="purpose_for_birth_certificate" class="form-control" placeholder="Enter Purpose!"
                                           maxlength="100" onblur="checkValidation('birth-certificate', 'purpose_for_birth_certificate', purposeForBirthCertificateValidationMessage);" value="{{purpose}}">
                                    <span class="error-message error-message-birth-certificate-purpose_for_birth_certificate"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>18. Applying For <span class="color-nic-red">*</span></label>
                                    <select id="applying_for_birth_certificate" name="applying_for_birth_certificate" class="form-control select2" onchange="checkValidation('birth-certificate', 'applying_for_birth_certificate', applyingForValidationMessage);" data-placeholder="Select Applying For !" style="width: 100%;">
                                    </select>
                                    <span class="error-message error-message-birth-certificate-applying_for_birth_certificate"></span>
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
                                <div class="col-12" id="applicant_photo_doc_container_for_birth_certificate">
                                    <label>19.Applicant Photo. <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-birth-certificate-applicant_photo_doc_for_birth_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="applicant_photo_doc_name_container_for_birth_certificate" style="display: none;">
                                    <label>19.Applicant Photo. <span style="color: red;">*</span></label><br>
                                    <a target="_blank" id="applicant_photo_doc_download">
                                        <img id="applicant_photo_doc_name_image_for_birth_certificate"
                                             style="width: 250px; height: 250px; border: 2px solid blue;"
                                             class="spinner_name_container_for_birth_certificate_{{VALUE_ONE}}">
                                    </a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12" id="birth_certi_doc_container_for_birth_certificate">
                                    <label>20. Birth Certificate <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-birth-certificate-birth_certi_doc_for_birth_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="birth_certi_doc_name_container_for_birth_certificate" style="display: none;">
                                    <label>20. Birth Certificate <span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="birth_certi_doc_download"><label id="birth_certi_doc_name_image_for_birth_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_birth_certificate_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12" id="aadhar_card_doc_container_for_birth_certificate">
                                    <label>21. Aadhar Card <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-birth-certificate-aadhar_card_doc_for_birth_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="aadhar_card_doc_name_container_for_birth_certificate" style="display: none;">
                                    <label>21. Aadhar Card <span style="color: red;"> </span></label><br>
                                    <a target="_blank" id="aadhar_card_doc_download"><label id="aadhar_card_doc_name_image_for_birth_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_birth_certificate_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12" id="old_birth_certi_doc_container_for_birth_certificate">
                                    <label>22. Old Birth Certificate <span style="color: red;"> (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    <label class="f-w-n">Document Not Uploaded</label><br>
                                    <div class="error-message error-message-birth-certificate-old_birth_certi_doc_for_birth_certificate"></div>
                                </div>
                                <div class="col-sm-12" id="old_birth_certi_doc_name_container_for_birth_certificate" style="display: none;">
                                    <label>22. Old Birth Certificate <span style="color: red;"> </span></label><br>
                                    <a target="_blank" id="old_birth_certi_doc_download"><label id="old_birth_certi_doc_name_image_for_birth_certificate" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_birth_certificate_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <button type="button" id="submit_btn_for_birth_certificate" class="btn btn-sm btn-success" 
                                onclick="BirthCertificate.listview.askForSubmitBirthCertificate({{VALUE_TWO}});" 
                                style="margin-right: 5px;">Submit Application</button>
                        <button type="button" class="btn btn-sm btn-danger" 
                                onclick="BirthCertificate.listview.loadBirthCertificateData();">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#relationship_with_applicant_for_birth_certificate').on('select2:clear', function (e) {
    $('.other_relationship_with_applicant_div_for_birth_certificate').hide();
    });
</script>