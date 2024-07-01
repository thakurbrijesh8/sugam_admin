<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">RTI Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application Form for Information </div>
            </div>
            <form role="form" id="rti_form" name="rti_form" onsubmit="return false;"
                  autocomplete="off">
                <input type="hidden" id="rti_id_for_rti" name="rti_id_for_rti" value="{{rti_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-rti f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    To,<br>
                    The Mamlatdar,
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>1. District<span class="color-nic-red">*</span></label>
                            <select id="district_for_rti" name="district_for_rti" class="form-control select2"
                                    onchange="checkValidation('rti', 'district_for_rti', selectDistrictValidationMessage);
                                            Rti.listview.districtChangeEvent($(this));"
                                    data-placeholder="Select District" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-rti-district_for_rti"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>1.1 Name of Village Panchayat/D.M.C<span class="color-nic-red">*</span></label>
                            <select id="village_name_for_rti" name="village_name_for_rti" class="form-control select2"
                                    onchange="checkValidation('rti', 'village_name_for_rti', oneOptionValidationMessage); Rti.listview.villageDMCChangeEvent($(this));"
                                    data-placeholder="Select Name of Village Panchayat/D.M.C" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-rti-village_name_for_rti"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2. Applicant full Name <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_name_for_rti" name="applicant_name_for_rti" class="form-control" placeholder="Enter Name of Applicant !"
                                   maxlength="100" onblur="checkValidation('rti', 'applicant_name_for_rti', applicantNameValidationMessage);" value="{{applicant_name}}">
                            <span class="error-message error-message-rti-applicant_name_for_rti"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>3. Applicant Profession <span class="color-nic-red">*</span></label>
                            <input type="text" id="applicant_profession_for_rti" name="applicant_profession_for_rti"
                                   maxlength="100" class="form-control" value="{{applicant_profession}}" placeholder="Enter Applicant Profession !" onblur="checkValidation('rti', 'applicant_profession_for_rti', professionValidationMessage);">
                            <span class="error-message error-message-rti-applicant_profession_for_rti"></span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>4. Applicant Date of Birth <span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"     
                                       value="{{applicant_dob_text}}" id="applicant_dob_for_rti" name="applicant_dob_for_rti" onblur="checkValidation('rti', 'applicant_dob_for_rti', dateValidationMessage);">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-rti-applicant_dob_for_rti"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-6">
                            <label>5. Applicant Address <span class="color-nic-red">*</span></label>
                            <textarea type="text" id="applicant_address_for_rti" 
                                      name="applicant_address_for_rti" class="form-control"
                                      placeholder="Enter Applicant Address !" maxlength="200" 
                                      onblur="checkValidation('rti', 'applicant_address_for_rti', addressValidationMessage);">{{applicant_address}}</textarea>
                            <span class="error-message error-message-rti-applicant_address_for_rti"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>6. Applicant's Mobile Number <span class="color-nic-red">*</span></label>
                            <input type="text" id="mobile_number_for_rti" name="mobile_number_for_rti" class="form-control" placeholder="Enter Mobile Number !"
                                   maxlength="10" onkeyup="checkNumeric($(this));"
                                   onblur="checkValidationForMobileNumber('rti', 'mobile_number_for_rti');" value="{{mobile_number}}">
                            <span class="error-message error-message-rti-mobile_number_for_rti"></span>
                        </div>
                    </div>
                    <div class="row"><label>&nbsp;&nbsp;(b) Details of information Sought </label></div><hr style="margin-bottom: 15px;"/>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label>7. Please indicate the subject matter/file/record etc. <span class="color-nic-red">*</span></label>
                            <textarea type="text" id="subject_for_rti" 
                                      name="subject_for_rti" class="form-control"
                                      placeholder="Please indicate the subject matter/file/record etc. !" maxlength="500" 
                                      onblur="checkValidation('rti', 'subject_for_rti', addressValidationMessage);">{{subject}}</textarea>
                            <span class="error-message error-message-rti-subject_for_rti"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8. The period of which the information pertains<span style="color: red;font-size: 16px;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="pertains_period_date_for_rti" id="pertains_period_date_for_rti" class="form-control date_picker"
                                       placeholder="MM-YYYY" data-date-format="MM-YYYY"
                                       value="{{pertains_period_date_text}}"
                                       onblur="checkValidation('rti', 'pertains_period_date_for_rti', dateValidationMessage);">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-rti-pertains_period_date_for_rti"></span>
                        </div>
                    </div>
                    <div class="row"><label>&nbsp;&nbsp;(c) Form/Format in which the information sought </label></div><hr style="margin-bottom: 15px;"/>
                    <div class="row rti_type_div_for_rti">
                        <div class="form-group col-sm-6">
                            <label>9. Photo Copy / Floppy; etc<span class="color-nic-red">*</span></label>
                            <div id="rti_type_container_for_rti"></div>
                            <span class="error-message error-message-rti-rti_type_for_rti"></span>
                        </div>
                    </div>
                    <div class="row"><label>&nbsp;&nbsp;(d) Inspection of Records </label></div><hr style="margin-bottom: 15px;"/>
                    <div class="row pertains_inspection_record_div_for_rti">
                        <div class="form-group col-sm-6">
                            <label>10. Dose the request pertain to inspection of records ?<span class="color-nic-red">*</span></label>
                            <div id="pertains_inspection_record_container_for_rti"></div>
                            <span class="error-message error-message-rti-pertains_inspection_record_for_rti"></span>
                        </div>
                    </div>
                    <div class="row is_pertains_inspection_record_details_div" style="display: none;">
                        <div class="form-group col-sm-6">
                            <label>10.1 The number of days the applicant may take in inspecting the relevant record <span class="color-nic-red">*</span></label>
                            <input type="text" id="inspection_no_of_days_for_rti" name="inspection_no_of_days_for_rti" class="form-control" placeholder="Enter The number of days the applicant may take in inspecting the relevant record !"
                                   maxlength="3" onkeyup="checkNumeric($(this));"
                                   onblur="checkValidation('rti', 'inspection_no_of_days_for_rti', detailValidationMessage);" value="{{inspection_no_of_days}}">
                            <span class="error-message error-message-rti-inspection_no_of_days_for_rti"></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <button type="button" id="submit_btn_for_rti" class="btn btn-sm btn-success" onclick="Rti.listview.submitRti({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="Rti.listview.loadRtiData();">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>