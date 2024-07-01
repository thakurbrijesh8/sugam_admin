<input type="hidden" id="document_registration_id_for_dr" name="document_registration_id_for_dr" value="{{document_registration_id}}" />
<input type="hidden" id="district_for_dr" name="district_for_dr" value="{{district}}" />
<input type="hidden" id="doc_consideration_amount_for_dr" name="doc_consideration_amount_for_dr" value="{{doc_consideration_amount}}" />
<input type="hidden" id="doc_type_for_dr" name="doc_type_for_dr" value="{{doc_type}}" />
<input type="hidden" id="noy_lease_for_dr" name="noy_lease_for_dr" value="{{noy_lease}}" />
<input type="hidden" id="nom_lease_for_dr" name="nom_lease_for_dr" value="{{nom_lease}}" />
<input type="hidden" id="deposit_for_dr" name="deposit_for_dr" value="{{deposit}}" />
<input type="hidden" id="yearly_rent_for_dr" name="yearly_rent_for_dr" value="{{yearly_rent}}" />
<input type="hidden" id="lease_period_for_dr" name="lease_period_for_dr" value="{{lease_period}}" />
<div class="row">
    <div class="col-sm-12 text-center">
        <span class="error-message error-message-drsfour f-w-b"
              style="border-bottom: 2px solid red;"></span>
    </div>
</div>
<div class="row mt-3">
    <div class="col-sm-6">
        <h3 class="card-title f-w-b pt-1"><span class="text-primary">Temp Application Number : </span><span id="temp_application_number_container_for_drsfour">{{temp_application_number}}</span></h3>
    </div>
    <div class="col-sm-6 text-right">
        <button type="button" class="btn btn-sm btn-success prev_btn_for_drsfour" style="padding: 2px 7px;"
                onclick="DocumentRegistration.listview.loadStepWiseForm($('.prev_btn_for_drsfour'), VALUE_THREE);"><i class="fas fa-arrow-left"></i>&nbsp; Previous</button>
        <button type="button" class="btn btn-sm btn-success submit_btn_for_drsfour" style="padding: 2px 7px;"
                onclick="DocumentRegistration.listview.submitDRSFour(VALUE_THREE);"><i class="fas fa-cloud-upload-alt"></i>&nbsp; Submit Application</button>
        <button type="button" class="btn btn-sm btn-danger" style="padding: 2px 7px;"
                onclick="DocumentRegistration.listview.loadDocumentRegistrationData();"><i class="fas fa-times"></i>&nbsp; Cancel</button>
    </div>
    <div class="col-12">
        <h3 class="card-title f-w-b pt-1"><span class="text-primary">Document Type (Article) : </span>{{doc_type_text}}</h3>
    </div>
    <div class="col-12">
        <h3 class="card-title f-w-b pt-2"><span class="text-primary">Consideration Amount (Entered by User) : </span>{{doc_consideration_amount}}</h3>
    </div>
    <div class="col-sm-12"><hr class="mt-3"></div>
</div>
<div class="row mt-3">
    {{#if show_lease_details}}
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-bordered f-w-b">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center v-a-m">Lease Period</th>
                        <th class="text-center v-a-m">No. of Year For Lease</th>
                        <th class="text-center v-a-m">No. of Month For Lease</th>
                        <th class="text-center v-a-m">Deposit For Lease</th>
                        <th class="text-center v-a-m">Yearly Rent For Lease / Average Annual Rent</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-primary">
                        <td class="v-a-m text-center">{{lease_period_text}}</td>
                        <td class="v-a-m text-center">{{noy_lease}} Year</td>
                        <td class="v-a-m text-center">{{nom_lease}} Month</td>
                        <td class="v-a-m text-right">{{deposit}}/-</td>
                        <td class="v-a-m text-right">{{yearly_rent}}/-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{/if}}
    <div class="col-md-6">
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Land / Property Details<span class="color-nic-red">*</span></label>
                <div>
                    <label class="radio-inline form-title m-b-0px m-r-10px cursor-pointer f-w-n">
                        <input type="radio" class="mb-0" id="property_details_status_for_drsfour_{{VALUE_ONE}}" 
                               onchange="DocumentRegistration.listview.pdsChangeEventForCal({{VALUE_ONE}});"
                               name="property_details_status_for_drsfour" value="{{VALUE_ONE}}">&nbsp;&nbsp;Applicable
                    </label>
                    <label class="radio-inline form-title m-b-0px m-r-10px cursor-pointer f-w-n">
                        <input type="radio" class="mb-0" id="is_available_pd_for_drsfour_{{VALUE_TWO}}"
                               onchange="DocumentRegistration.listview.pdsChangeEventForCal({{VALUE_TWO}});"
                               name="property_details_status_for_drsfour" value="{{VALUE_TWO}}">&nbsp;&nbsp;Not Applicable
                    </label>
                </div>
                <span class="error-message error-message-drsfour-property_details_status_for_drsfour"></span>
            </div>
            <div class="form-group col-sm-6">
                <label>Ownership / Applicant Type<span class="color-nic-red">*</span></label>
                <select id="ownership_type_for_drsfour" name="ownership_type_for_drsfour" class="form-control select2"
                        onchange="checkValidation('drsfour', 'ownership_type_for_drsfour', oneOptionValidationMessage);
                            DocumentRegistration.listview.mainChangeEventForCal();"
                        data-placeholder="Select Ownership / Applicant Type" style="width: 100%;">
                </select>
                <span class="error-message error-message-drsfour-ownership_type_for_drsfour"></span>
            </div>
        </div>
        <div class="row pd_a_container_for_drsfour" style="display: none;">
            <div class="col-12">
                <div class="card bg-beige">
                    <div class="card-header pt-1 pb-1">
                        <div class="row">
                            <div class="col-12 f-w-b">Exemption (If Applicable)</div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Market Value Exemption</label>
                                <select id="mv_exemption_for_drsfour" name="mv_exemption_for_drsfour"
                                        class="form-control select2 select2-drsfour"
                                        data-placeholder="Select Market Value Exemption" style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Market Value Amount</label>
                                <input type="text" id="mv_exemption_amount_for_drsfour" name="mv_exemption_amount_for_drsfour"
                                       class="form-control text-right"
                                       onblur="checkNumeric($(this)); roundOff($(this));" onkeyup="checkNumeric($(this));"
                                       placeholder="Enter Market Value Amount !" maxlength="10" value="{{mv_exemption_amount}}">
                            </div>
                            {{#if show_sd_exe}}
                            <div class="form-group col-sm-6">
                                <label>Stamp Duty Exemption</label>
                                <select id="sd_exemption_for_drsfour" name="sd_exemption_for_drsfour"
                                        onchange="DocumentRegistration.listview.mainChangeEventForCal();"
                                        class="form-control select2 select2-drsfour"
                                        data-placeholder="Select Stamp Duty Exemption" style="width: 100%;">
                                </select>
                            </div>
                            {{/if}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 pd_a_container_for_drsfour" style="display: none;">
        <input type="hidden" id='total_auto_ca_amount_drsfour' class="null-hidden-amount-total" value="{{total_consideration_amount}}">
        <input type="hidden" id='total_auto_sd_amount_drsfour' class="null-hidden-amount-total" value="{{total_stamp_duty}}">
        <input type="hidden" id='total_auto_rf_amount_drsfour' class="null-hidden-amount-total" value="{{total_registration_fee}}">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-beige">
                        <th class="text-center v-a-m f-w-b" colspan="2">Auto Calculated (Estimated)</th>
                    </tr>
                    {{#if show_ca}}
                    <tr>
                        <th class="v-a-m bg-beige" style="min-width: 120px;">Total Consideration Amount</th>
                        <th class="text-right f-w-b v-a-m null-amount-total" id="total_dca_auto_for_drsfour" style="min-width: 80px;">{{total_consideration_amount}}</th>
                    </tr>
                    {{/if}}
                    <tr>
                        <th class="v-a-m bg-beige">Total Stamp Duty</th>
                        <th class="text-right f-w-b v-a-m null-amount-total" id="total_dsd_auto_for_drsfour">{{total_stamp_duty}}</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">Total Registration Fee</th>
                        <th class="text-right f-w-b v-a-m null-amount-total" id="total_drf_auto_for_drsfour">{{total_registration_fee}}</th>
                    </tr>
                </thead>
            </table>
        </div>
        {{#if show_total_of_entered_ca}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-beige">
                        <th class="text-center v-a-m f-w-b" colspan="2">Consideration Amount (Entered by User) : Calculated (Estimated)</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige" style="min-width: 120px;">Consideration Amount</th>
                        <th class="text-right f-w-b v-a-m" style="min-width: 80px;">{{doc_consideration_amount}}</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">
                            Stamp Duty (<span class="total_dsd_per_for_drsfour_eca f-w-b"></span>)
                        </th>
                        <th class="text-right f-w-b v-a-m null-eca-total-cal" id="total_dsd_auto_for_drsfour_eca">0</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">
                            Registration Fee (<span class="total_drf_per_for_drsfour_eca f-w-b"></span>)
                        </th>
                        <th class="text-right f-w-b v-a-m null-eca-total-cal" id="total_drf_auto_for_drsfour_eca">0</th>
                    </tr>
                </thead>
            </table>
        </div>
        {{/if}}
    </div>
</div>
<div class="pd_a_container_for_drsfour" style="display: none;">
    <div id="property_details_main_container_for_drsfour"></div>
    <div class="row mt-3">
        <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-nic-blue btn-sm"
                    onclick="DocumentRegistration.listview.addMorePropertyDetails({});">Add More Property Details</button>
        </div>
    </div>
</div>
<div class="pd_na_container_for_drsfour" style="display: none;">
    <form role="form" id="drsfour_form" name="drsfour_form" onsubmit="return false;" autocomplete="off">
        <input type="hidden" id='other_auto_sd_amount_drsfour_oth' class="null-hidden-amount-oth" value="0">
        <input type="hidden" id='other_auto_rf_amount_drsfour_oth' class="null-hidden-amount-oth" value="0">
        <div class="card">
            <div class="card-header pt-1 pb-1 bg-beige">
                <div class="row">
                    <div class="col-12 f-w-b">Stamp Duty Calculation Details</div>
                    <div class="col-12 f-w-b text-danger">
                        Note : Stamp Duty & Registration Fee are Calculated as per<br>
                        1. Gazette Notification Number : CRSR/DMN/VALUATION/6-201S/4146, Dated : 10/12/2015
                        <a target="_blank" href="https://daman.nic.in/websites/Civil-Registrar/2020/49-14-01-2020.pdf">(Click Here to Download)</a>.<br>
                        2. Gazette Notification Number : COL/DMN/LND/REVENUE/2012/308, Dated : 16/04/2015
                        <a target="_blank" href="https://daman.nic.in/websites/Civil-Registrar/2020/11-14-01-2020.pdf">(Click Here to Download)</a>.
                    </div>
                </div>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    <div class="form-group col-12 col-sm-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-center v-a-m f-w-b" colspan="2">Auto Calculated (Estimated)</th>
                                    </tr>
                                    <tr>
                                        <th class="v-a-m bg-light-gray" style="min-width: 120px;">
                                            Stamp Duty (<span class="other_dsd_per_for_drsfour_oth f-w-b null-all-cal-per"></span>)
                                        </th>
                                        <th class="text-right f-w-b v-a-m null-all-cal null-oth-cal" style="min-width: 80px;"
                                            id="other_dsd_auto_for_drsfour_oth">0</th>
                                    </tr>
                                    <tr>
                                        <th class="v-a-m bg-light-gray">
                                            Registration Fee (<span class="other_drf_per_for_drsfour_oth f-w-b null-all-cal-per"></span>)
                                        </th>
                                        <th class="text-right f-w-b v-a-m null-all-cal null-oth-cal" id="other_drf_auto_for_drsfour_oth">0</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="row"><div class="mt-3 col-12"><hr></div></div>
<div class="row">
    <div class="mt-3 col-12 text-right">
        <button type="button" class="btn btn-sm btn-success prev_btn_for_drsfour" style="padding: 2px 7px;"
                onclick="DocumentRegistration.listview.loadStepWiseForm($('.prev_btn_for_drsfour'), VALUE_THREE);"><i class="fas fa-arrow-left"></i>&nbsp; Previous</button>
        <button type="button" class="btn btn-sm btn-success submit_btn_for_drsfour" style="padding: 2px 7px;"
                onclick="DocumentRegistration.listview.submitDRSFour(VALUE_THREE);"><i class="fas fa-cloud-upload-alt"></i>&nbsp; Submit Application</button>
        <button type="button" class="btn btn-sm btn-danger" style="padding: 2px 7px;"
                onclick="DocumentRegistration.listview.loadDocumentRegistrationData();"><i class="fas fa-times"></i>&nbsp; Cancel</button>
    </div>
</div>