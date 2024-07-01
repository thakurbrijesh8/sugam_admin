<form role="form" id="drsone_form" name="drsone_form" onsubmit="return false;" autocomplete="off">
    <input type="hidden" id="document_registration_id_for_dr" name="document_registration_id_for_dr" value="{{document_registration_id}}" />
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-drsone f-w-b"
                  style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6 text-center">
            <h3 class="card-title f-w-b pt-1 fs-1rem"><span class="text-primary">Temp Application Number : </span><span id="temp_application_number_container_for_drstwo">{{temp_application_number}}</span></h3>
        </div>
        <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-sm btn-success next_btn_for_drsone" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.submitDRSOne($('.next_btn_for_drsone'));"><i class="fas fa-arrow-right"></i>&nbsp; Save & Continue</button>
            <button type="button" class="btn btn-sm btn-danger" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.loadDocumentRegistrationData();"><i class="fas fa-times"></i>&nbsp; Cancel</button>
        </div>
        <div class="col-sm-12"><hr class="mt-3"></div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label><span class="drsone-cnt"></span>. Application Date & Time<span style="color: red;">*</span></label>
                    <div class="input-group date">
                        <input type="text" name="application_datetime_for_drsone" id="application_datetime_for_drsone" class="form-control"
                               value="{{application_datetime_text}}" readonly="">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label><span class="drsone-cnt"></span>. District of Application <span class="color-nic-red">*</span></label>
                    <select id="district_for_drsone" name="district_for_drsone" class="form-control select2"
                            onchange="checkValidation('drsone', 'district_for_drsone', selectDistrictValidationMessage);"
                            data-placeholder="Select District of Application" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-drsone-district_for_drsone"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label><span class="drsone-cnt"></span>. Document Language <span class="color-nic-red">*</span></label>
                    <select id="doc_language_for_drsone" name="doc_language_for_drsone" class="form-control select2"
                            onchange="checkValidation('drsone', 'doc_language_for_drsone', oneOptionValidationMessage);"
                            data-placeholder="Select Document Language" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-drsone-doc_language_for_drsone"></span>
                </div>
                <div class="form-group col-sm-6"">
                    <label><span class="drsone-cnt"></span>. Document Type (Article) <span class="color-nic-red">*</span></label>
                    <select id="doc_type_for_drsone" name="doc_type_for_drsone" class="form-control select2"
                            onchange="checkValidation('drsone', 'doc_type_for_drsone', oneOptionValidationMessage);
                                    DocumentRegistration.listview.drDocTypeChangeEvent($(this));"
                            data-placeholder="Select Document Type" style="width: 100%;">
                    </select>
                    <span class="error-message error-message-drsone-doc_type_for_drsone"></span>
                </div>
            </div>
            <div class="card bg-beige" id="doc_type_ld_lla_tl_for_drsone" style="display: none;">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4.1 No. of Year For Lease <span class="color-nic-red">*</span></label>
                            <select id="noy_lease_for_drsone" name="noy_lease_for_drsone" class="form-control select2"
                                    data-placeholder="Select No. of Year For Lease" style="width: 100%;"
                                    onchange="checkValidation('drsone', 'noy_lease_for_drsone', oneOptionValidationMessage);
                                            DocumentRegistration.listview.noyLeaseChangeEvent($(this));">
                            </select>
                            <span class="error-message error-message-drsone-noy_lease_for_drsone"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4.2 No. of Month For Lease <span class="color-nic-red">*</span></label>
                            <select id="nom_lease_for_drsone" name="nom_lease_for_drsone" class="form-control select2"
                                    data-placeholder="Select No. of Month For Lease" style="width: 100%;"
                                    onchange="checkValidation('drsone', 'nom_lease_for_drsone', oneOptionValidationMessage);
                                            DocumentRegistration.listview.nomLeaseChangeEvent($(this));">
                            </select>
                            <span class="error-message error-message-drsone-nom_lease_for_drsone"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>4.3 Deposit For Lease <span class="color-nic-red">*</span></label>
                            <input type="text" id="deposit_for_drsone" name="deposit_for_drsone" class="form-control text-right"
                                   onblur="checkNumeric($(this)); checkValidation('drsone', 'deposit_for_drsone', depositValidationMessage);" 
                                   onkeyup="checkNumeric($(this));"
                                   placeholder="Enter Deposit For Lease !" maxlength="10" value="{{deposit}}">
                            <span class="error-message error-message-drsone-deposit_for_drsone"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>4.4 Yearly Rent For Lease / Average Annual Rent <span class="color-nic-red">*</span></label>
                            <input type="text" id="yearly_rent_for_drsone" name="yearly_rent_for_drsone" class="form-control text-right"
                                   onblur="checkNumeric($(this)); checkValidation('drsone', 'yearly_rent_for_drsone', rentValidationMessage);" 
                                   onkeyup="checkNumeric($(this));"
                                   placeholder="Enter Yearly Rent For Lease / Average Annual Rent !" maxlength="10" value="{{yearly_rent}}">
                            <span class="error-message error-message-drsone-yearly_rent_for_drsone"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label><span class="drsone-cnt"></span>. Consideration Amount (If Any)</label>
                    <input type="text" id="doc_consideration_amount_for_drsone" name="doc_consideration_amount_for_drsone" class="form-control text-right"
                           onblur="checkNumeric($(this));" onkeyup="checkNumeric($(this));"
                           placeholder="Enter Consideration Amount !" maxlength="10" value="{{doc_consideration_amount}}">
                    <span class="error-message error-message-drsone-doc_consideration_amount_for_drsone"></span>
                </div>
                <div class="form-group col-sm-6">
                    <label><span class="drsone-cnt"></span>. Registration Fee Exemption <span class="color-nic-red">*</span></label>
                    <div id="fee_exemption_container_for_drsone"></div>
                    <span class="error-message error-message-drsone-fee_exemption_for_drsone"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label><span class="drsone-cnt"></span>. Document Execution Date<span style="color: red;">*</span></label>
                    <div class="input-group date">
                        <input type="text" name="doc_execution_date_for_drsone" id="doc_execution_date_for_drsone" class="form-control"
                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                               value="{{doc_execution_date_text}}"
                               onblur="checkValidation('drsone', 'doc_execution_date_for_drsone', dateValidationMessage);">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                    </div>
                    <span class="error-message error-message-drsone-doc_execution_date_for_drsone"></span>
                </div>
            </div>
            <div class="card bg-beige">
                <div class="card-header">
                    <h3 class="card-title f-w-b f-s-16px">
                        <span class="drsone-cnt"></span>. Documents Place of Execution<span style="color: red;">*</span>
                    </h3>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="mb-1 col-12">
                            <div id="dpe_type_container_for_drsone"></div>
                            <span class="error-message error-message-drsone-dpe_type_for_drsone"></span>
                        </div>
                    </div>
                    <div class="row" id="within_india_container_for_drsone" style="display: none;">
                        <div class="form-group col-sm-6">
                            <label>8.1 State / U.T. <span class="color-nic-red">*</span></label>
                            <select id="dpe_state_for_drsone" name="dpe_state_for_drsone" class="form-control select2"
                                    data-placeholder="Select State / U.T." style="width: 100%;"
                                    onchange="checkValidation('drsone', 'dpe_state_for_drsone', selectStateValidationMessage);
                                            DocumentRegistration.listview.stateChangeEvent($(this), 'dpe', 'drsone');">
                            </select>
                            <span class="error-message error-message-drsone-dpe_state_for_drsone"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8.2 District <span class="color-nic-red">*</span></label>
                            <select id="dpe_district_for_drsone" name="dpe_district_for_drsone" class="form-control select2"
                                    data-placeholder="Select District" style="width: 100%;"
                                    onchange="checkValidation('drsone', 'dpe_district_for_drsone', selectDistrictValidationMessage);">
                            </select>
                            <span class="error-message error-message-drsone-dpe_district_for_drsone"></span>
                        </div>
                    </div>
                    <div class="row" id="outside_india_container_for_drsone" style="display: none;">
                        <div class="form-group col-sm-6">
                            <label>8.1 Country Name <span class="color-nic-red">*</span></label>
                            <input type="text" id="dpe_country_name_for_drsone" name="dpe_country_name_for_drsone" class="form-control"
                                   placeholder="Enter Country Name !"
                                   onblur="checkValidation('drsone', 'dpe_country_name_for_drsone', nameValidationMessage);"
                                   maxlength="50" value="{{dpe_country_name}}" />
                            <span class="error-message error-message-drsone-dpe_country_name_for_drsone"></span>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>8.2 Address <span class="color-nic-red">*</span></label>
                            <textarea id="dpe_address_for_drsone" name="dpe_address_for_drsone" class="form-control" 
                                      placeholder="Enter Address !"
                                      onblur="checkValidation('drsone', 'dpe_address_for_drsone', addressValidationMessage);"
                                      maxlength="200" >{{dpe_address}}</textarea>
                            <span class="error-message error-message-drsone-dpe_address_for_drsone"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label><span class="drsone-cnt"></span>. Name of Advocate / Deed Writer <span class="color-nic-red">*</span></label>
                    <input type="text" id="adv_dw_name_for_drsone" name="adv_dw_name_for_drsone" class="form-control"
                           placeholder="Enter Name of Advocate / Deed Writer !"
                           onblur="checkValidation('drsone', 'adv_dw_name_for_drsone', nameValidationMessage);"
                           maxlength="200" value="{{adv_dw_name}}" />
                    <span class="error-message error-message-drsone-adv_dw_name_for_drsone"></span>
                </div>
                <div class="form-group col-sm-6">
                    <label><span class="drsone-cnt"></span>. Any Other Details / Remarks</label>
                    <textarea id="aod_remarks_for_drsone" name="aod_remarks_for_drsone" class="form-control" placeholder="Enter Any Other Details / Remarks !"
                              maxlength="200" >{{aod_remarks}}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-beige">
                <div class="card-header">
                    <h3 class="card-title f-w-b f-s-14px">
                        <span class="drsone-cnt"></span>. Upload Scanned Copies of Documents to be Registered<br>(Multiple Page Single File Documents)<span style="color: red;">* <br>(Maximum File Size: 20MB) (Upload JPG, JPEG, PNG, PDF Only)</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-light-gray">
                                    <th class="text-center" style="width: 30px;">No.</th>
                                    <th class="text-center" style="min-width: 165px;">Document Name</th>
                                    <th class="text-center" style="min-width: 165px;">Document</th>
                                </tr>
                            </thead>
                            <tbody id="document_item_container_for_drsone" class="bg-white"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><div class="mt-3 col-12"><hr></div></div>
    <div class="row">
        <div class="mt-3 col-12 text-right">
            <button type="button" class="btn btn-sm btn-success next_btn_for_drsone" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.submitDRSOne($('.next_btn_for_drsone'));"><i class="fas fa-arrow-right"></i>&nbsp; Save & Continue</button>
            <button type="button" class="btn btn-sm btn-danger" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.loadDocumentRegistrationData();"><i class="fas fa-times"></i>&nbsp; Cancel</button>
        </div>
    </div>
</form>