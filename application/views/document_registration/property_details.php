<div class="card property_details_for_drsfour fw-body" id="property_main_details_for_drsfour_{{temp_cnt}}">
    <div class="card-header pt-2 pb-1 bg-nic-blue">
        <input type="hidden" class='temp_opd_drsfour_cnt' value="{{temp_cnt}}">
        <input type="hidden" id='land_auto_con_amount_drsfour_{{temp_cnt}}' class="null-hidden-amount-{{temp_cnt}}" value="{{land_auto_con}}">
        <input type="hidden" id='land_auto_sd_amount_drsfour_{{temp_cnt}}' class="null-hidden-amount-{{temp_cnt}}" value="{{land_auto_sd}}">
        <input type="hidden" id='land_auto_rf_amount_drsfour_{{temp_cnt}}' class="null-hidden-amount-{{temp_cnt}}" value="{{land_auto_rf}}">
        <input type="hidden" id='cp_auto_con_amount_drsfour_{{temp_cnt}}' class="null-hidden-amount-{{temp_cnt}}" value="{{cp_auto_co}}">
        <input type="hidden" id='cp_auto_sd_amount_drsfour_{{temp_cnt}}' class="null-hidden-amount-{{temp_cnt}}" value="{{cp_auto_sd}}">
        <input type="hidden" id='cp_auto_rf_amount_drsfour_{{temp_cnt}}' class= "null-hidden-amount-{{temp_cnt}}" value="{{cp_auto_rf}}">
        <h3 class="card-title f-w-b f-s-15px">
            Property Detail : Sr. No. <span class="opd-drsfour-display-cnt">{{temp_cnt}}</span>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    id="property_main_details_hs_btn_for_drsfour_{{temp_cnt}}">
                <i class="fas fa-minus text-white"></i>
            </button>
            <button type="button" class="btn btn-tool"
                    onclick="DocumentRegistration.listview.removePropertyDetails({{temp_cnt}});">
                <i class="fas fa-times text-white"></i>
            </button>
        </div>
    </div>
    <div class="card-body border-nic-blue">
        <form role="form" id="drsfour_form_{{temp_cnt}}" name="drsfour_form_{{temp_cnt}}" onsubmit="return false;" autocomplete="off">
            <input type="hidden" name="dr_property_details_id_for_drsfour_{{temp_cnt}}" value="{{dr_property_details_id}}" />
            <div class="card bg-beige">
                <div class="card-header pt-1 pb-1">
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
                        <div class="form-group col-12">
                            <div>
                                <label class="radio-inline form-title m-b-0px m-r-10px cursor-pointer">
                                    <input type="radio" class="mb-0" id="pd_type_for_drsfour_{{VALUE_ONE}}_{{temp_cnt}}" 
                                           onchange="DocumentRegistration.listview.pdTypeChangeEvent({{VALUE_ONE}},{{temp_cnt}});"
                                           name="pd_type_for_drsfour_{{temp_cnt}}" value="{{VALUE_ONE}}">&nbsp;&nbsp;For Open Land Only
                                </label>
                                <label class="radio-inline form-title m-b-0px m-r-10px cursor-pointer">
                                    <input type="radio" class="mb-0" id="pd_type_for_drsfour_{{VALUE_TWO}}_{{temp_cnt}}"
                                           onchange="DocumentRegistration.listview.pdTypeChangeEvent({{VALUE_TWO}},{{temp_cnt}});"
                                           name="pd_type_for_drsfour_{{temp_cnt}}" value="{{VALUE_TWO}}">&nbsp;&nbsp;For Constructed Property Only
                                </label>
                                <label class="radio-inline form-title m-b-0px m-r-10px cursor-pointer">
                                    <input type="radio" class="mb-0" id="pd_type_for_drsfour_{{VALUE_THREE}}_{{temp_cnt}}"
                                           onchange="DocumentRegistration.listview.pdTypeChangeEvent({{VALUE_THREE}},{{temp_cnt}});"
                                           name="pd_type_for_drsfour_{{temp_cnt}}" value="{{VALUE_THREE}}">&nbsp;&nbsp;Constructed Property with Land
                                </label>
                            </div>
                            <span class="error-message error-message-drsfour-pd_type_for_drsfour_{{temp_cnt}}"></span>
                        </div>
                    </div>
                    <div class="card bg-white pd-type-open-land-{{temp_cnt}}" style="display: none;">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>Main Area <span class="color-nic-red">*</span></label>
                                            <select id="ol_main_area_for_drsfour_{{temp_cnt}}" name="ol_main_area_for_drsfour_{{temp_cnt}}"
                                                    onchange="checkValidation('drsfour','ol_main_area_for_drsfour_{{temp_cnt}}', oneOptionValidationMessage);
                                                        DocumentRegistration.listview.mainAreaChangeEvent($(this),'{{temp_cnt}}');
                                                                    DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                    class="form-control select2 select2-drsfour-{{temp_cnt}}" data-placeholder="Select Main Area" style="width: 100%;">
                                            </select>
                                            <span class="error-message error-message-drsfour-ol_main_area_for_drsfour_{{temp_cnt}}"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Sub Area <span class="color-nic-red">*</span></label>
                                            <select id="ol_sub_area_for_drsfour_{{temp_cnt}}" name="ol_sub_area_for_drsfour_{{temp_cnt}}"
                                                    onchange="checkValidation('drsfour','ol_sub_area_for_drsfour_{{temp_cnt}}', oneOptionValidationMessage);
                                                                DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                    class="form-control select2 select2-drsfour-{{temp_cnt}}" data-placeholder="Select Sub Area" style="width: 100%;">
                                            </select>
                                            <span class="error-message error-message-drsfour-ol_sub_area_for_drsfour_{{temp_cnt}}"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>Purpose <span class="color-nic-red">*</span></label>
                                            <select id="ol_purpose_for_drsfour_{{temp_cnt}}" name="ol_purpose_for_drsfour_{{temp_cnt}}"
                                                    onchange="checkValidation('drsfour','ol_purpose_for_drsfour_{{temp_cnt}}', oneOptionValidationMessage);
                                                                DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                    class="form-control select2 select2-drsfour-{{temp_cnt}}" data-placeholder="Select Purpose" style="width: 100%;">
                                            </select>
                                            <span class="error-message error-message-drsfour-ol_purpose_for_drsfour_{{temp_cnt}}"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Land Area in Sq. Meter <span class="color-nic-red">*</span></label>
                                            <input type="text" id="ol_land_area_for_drsfour_{{temp_cnt}}" name="ol_land_area_for_drsfour_{{temp_cnt}}"
                                                   class="form-control text-right"
                                                   onkeyup="checkNumeric($(this)); DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                   onblur="checkNumeric($(this)); roundOff($(this));
                                                               checkValidation('drsfour', 'ol_land_area_for_drsfour_{{temp_cnt}}', landAreaValidationMessage);
                                                                           DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                   placeholder="Land Area in Sq. Meter !" maxlength="8" value="{{ol_land_area}}">
                                            <span class="error-message error-message-drsfour-ol_land_area_for_drsfour_{{temp_cnt}}"></span>
                                        </div>
                                    </div>
                                </div>
                                {{#if show_ca}}
                                <div class="col-sm-12 col-md-6 mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr class="bg-light-gray">
                                                    <th class="text-center v-a-m f-w-b" colspan="2">Auto Calculated (Estimated)</th>
                                                </tr>
                                                <tr>
                                                    <th class="v-a-m bg-light-gray" style="min-width: 120px;">Consideration Amount</th>
                                                    <th class="text-right f-w-b v-a-m null-{{temp_cnt}}-cal" id="land_dca_auto_for_drsfour_{{temp_cnt}}" style="min-width: 80px;">{{land_auto_con}}</th>
                                                </tr>
                                                <tr>
                                                    <th class="v-a-m bg-light-gray">
                                                        Stamp Duty (<span class="land_dsd_per_for_drsfour_{{temp_cnt}} f-w-b"></span>)
                                                    </th>
                                                    <th class="text-right f-w-b v-a-m null-{{temp_cnt}}-cal" id="land_dsd_auto_for_drsfour_{{temp_cnt}}">{{land_auto_sd}}</th>
                                                </tr>
                                                <tr>
                                                    <th class="v-a-m bg-light-gray">
                                                        Registration Fee (<span class="land_drf_per_for_drsfour_{{temp_cnt}} f-w-b"></span>)
                                                    </th>
                                                    <th class="text-right f-w-b v-a-m null-{{temp_cnt}}-cal" id="land_drf_auto_for_drsfour_{{temp_cnt}}">{{land_auto_rf}}</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                {{/if}}
                            </div>
                        </div>
                    </div>
                    <div class="card bg-white pd-type-constructed-property-{{temp_cnt}}" style="display: none;">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>Property Type <span class="color-nic-red">*</span></label>
                                            <select id="cp_property_type_for_drsfour_{{temp_cnt}}" name="cp_property_type_for_drsfour_{{temp_cnt}}"
                                                    onchange="checkValidation('drsfour','cp_property_type_for_drsfour_{{temp_cnt}}', oneOptionValidationMessage);
                                                        DocumentRegistration.listview.ptChangeEvent($(this),'{{temp_cnt}}');
                                                                    DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                    class="form-control select2 select2-drsfour-{{temp_cnt}}" data-placeholder="Select Property Type" style="width: 100%;">
                                            </select>
                                            <span class="error-message error-message-drsfour-cp_property_type_for_drsfour_{{temp_cnt}}"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Category of Construction <span class="color-nic-red">*</span></label>
                                            <select id="cp_cc_for_drsfour_{{temp_cnt}}" name="cp_cc_for_drsfour_{{temp_cnt}}"
                                                    onchange="checkValidation('drsfour','cp_cc_for_drsfour_{{temp_cnt}}', oneOptionValidationMessage);
                                                                DocumentRegistration.listview.ccChangeEvent({{temp_cnt}});
                                                                    DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                    class="form-control select2 select2-drsfour-{{temp_cnt}}" data-placeholder="Select Category of Construction" style="width: 100%;">
                                            </select>
                                            <span class="error-message error-message-drsfour-cp_cc_for_drsfour_{{temp_cnt}}"></span>
                                        </div>
                                    </div>
                                    <div class="row" id="height_above_sqft_container_for_drsfour_{{temp_cnt}}" style="display: none;">
                                        <div class="form-group col-sm-6">
                                            <label>Height Above 16 ft <span class="color-nic-red">*</span></label>
                                            <input type="text" id="cp_height_above_for_drsfour_{{temp_cnt}}" name="cp_height_above_for_drsfour_{{temp_cnt}}"
                                                   class="form-control"
                                                   onkeyup="checkNumeric($(this)); DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                   onblur="checkNumeric($(this)); roundOff($(this));
                                                               checkValidation('drsfour', 'cp_height_above_for_drsfour_{{temp_cnt}}', heightValidationMessage);
                                                                           DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                   placeholder="Height Above 16 ft !" maxlength="5" value="{{cp_height_above}}">
                                            <span class="error-message error-message-drsfour-cp_height_above_for_drsfour_{{temp_cnt}}"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>Age of Construction for Depreciation <span class="color-nic-red">*</span></label>
                                            <select id="cp_age_cd_for_drsfour_{{temp_cnt}}" name="cp_age_cd_for_drsfour_{{temp_cnt}}"
                                                    onchange="checkValidation('drsfour','cp_age_cd_for_drsfour_{{temp_cnt}}', oneOptionValidationMessage);
                                                                DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                    class="form-control select2 select2-drsfour-{{temp_cnt}}" data-placeholder="Select Age of Construction for Depreciation" style="width: 100%;">
                                            </select>
                                            <span class="error-message error-message-drsfour-cp_age_cd_for_drsfour_{{temp_cnt}}"></span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Constructed Area in Sq. Foot <span class="color-nic-red">*</span></label>
                                            <input type="text" id="cp_constructed_area_for_drsfour_{{temp_cnt}}" name="cp_constructed_area_for_drsfour_{{temp_cnt}}"
                                                   class="form-control text-right"
                                                   onkeyup="checkNumeric($(this)); DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                   onblur="checkNumeric($(this)); roundOff($(this));
                                                               checkValidation('drsfour', 'cp_constructed_area_for_drsfour_{{temp_cnt}}', landAreaValidationMessage);
                                                                           DocumentRegistration.listview.calculationForSDRF({{temp_cnt}});"
                                                   placeholder="Land Area in Sq. Foot !" maxlength="8" value="{{cp_constructed_area}}">
                                            <span class="error-message error-message-drsfour-cp_constructed_area_for_drsfour_{{temp_cnt}}"></span>
                                        </div>
                                    </div>
                                </div>
                                {{#if show_ca}}
                                <div class="col-sm-12 col-md-6 mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover mb-0">
                                            <thead>
                                                <tr class="bg-light-gray">
                                                    <th class="text-center v-a-m f-w-b" colspan="2">Auto Calculated (Estimated)</th>
                                                </tr>
                                                <tr>
                                                    <th class="v-a-m bg-light-gray" style="min-width: 120px;">Consideration Amount</th>
                                                    <th class="text-right f-w-b v-a-m null-{{temp_cnt}}-cal" id="cp_dca_auto_for_drsfour_{{temp_cnt}}" style="min-width: 80px;">{{cp_auto_co}}</th>
                                                </tr>
                                                <tr>
                                                    <th class="v-a-m bg-light-gray">
                                                        Stamp Duty (<span class="cp_dsd_per_for_drsfour_{{temp_cnt}} f-w-b"></span>)
                                                    </th>
                                                    <th class="text-right f-w-b v-a-m null-{{temp_cnt}}-cal" id="cp_dsd_auto_for_drsfour_{{temp_cnt}}">{{cp_auto_sd}}</th>
                                                </tr>
                                                <tr>
                                                    <th class="v-a-m bg-light-gray">
                                                        Registration Fee (<span class="cp_drf_per_for_drsfour_{{temp_cnt}} f-w-b"></span>)
                                                    </th>
                                                    <th class="text-right f-w-b v-a-m null-{{temp_cnt}}-cal" id="cp_drf_auto_for_drsfour_{{temp_cnt}}">{{cp_auto_rf}}</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                {{/if}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-beige pd-type-both-{{temp_cnt}}" style="display: none;">
                <div class="card-header pt-1 pb-1">
                    <div class="row">
                        <div class="col-12 f-w-b">Land Details (As per Land Records Data)</div>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-3">
                            <label>1 Rural / Urban <span class="color-nic-red">*</span></label>
                            <div>
                                <label class="radio-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                    <input type="radio" class="mb-0" id="ld_type_for_drsfour_{{VALUE_ONE}}_{{temp_cnt}}" 
                                           onchange="DocumentRegistration.listview.ldTypeChangeEvent({{VALUE_ONE}},{{temp_cnt}});"
                                           name="ld_type_for_drsfour_{{temp_cnt}}" value="{{VALUE_ONE}}" checked="">&nbsp;&nbsp;Rural
                                </label>
                                <label class="radio-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                    <input type="radio" class="mb-0" id="ld_type_for_drsfour_{{VALUE_TWO}}_{{temp_cnt}}"
                                           onchange="DocumentRegistration.listview.ldTypeChangeEvent({{VALUE_TWO}},{{temp_cnt}});"
                                           name="ld_type_for_drsfour_{{temp_cnt}}" value="{{VALUE_TWO}}">&nbsp;&nbsp;Urban
                                </label>
                            </div>
                            <span class="error-message error-message-drsfour-ld_type_for_drsfour_{{temp_cnt}}"></span>
                        </div>
                        <div class="form-group col-sm-6" id="ld_area_type_container_for_drsfour_{{temp_cnt}}" style="display: none;">
                            <label>1.1 Select Urban Area <span class="color-nic-red">*</span></label>
                            <div>
                                <label class="radio-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                    <input type="radio" class="mb-0" id="ld_area_type_for_drsfour_{{VALUE_ONE}}_{{temp_cnt}}" 
                                           onchange="DocumentRegistration.listview.ldAreaTypeChangeEvent({{VALUE_ONE}},{{temp_cnt}});"
                                           name="ld_area_type_for_drsfour_{{temp_cnt}}" value="{{VALUE_ONE}}" checked="">&nbsp;&nbsp;P.T. Sheet Wise Area
                                </label>
                                <label class="radio-inline form-title f-w-n m-b-0px m-r-10px cursor-pointer">
                                    <input type="radio" class="mb-0" id="ld_area_type_for_drsfour_{{VALUE_TWO}}_{{temp_cnt}}"
                                           onchange="DocumentRegistration.listview.ldAreaTypeChangeEvent({{VALUE_TWO}},{{temp_cnt}});"
                                           name="ld_area_type_for_drsfour_{{temp_cnt}}" value="{{VALUE_TWO}}">&nbsp;&nbsp;Gauthan Wise Area
                                </label>
                            </div>
                            <span class="error-message error-message-drsfour-ld_area_type_for_drsfour_{{temp_cnt}}"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-3">
                            <label id="ld_village_sc_title_for_drsfour_{{temp_cnt}}">1.1 Village <span class="color-nic-red">*</span></label>
                            <select id="ld_village_sc_for_drsfour_{{temp_cnt}}" name="ld_village_sc_for_drsfour_{{temp_cnt}}" 
                                    onchange="checkValidation('drsfour', 'ld_village_sc_for_drsfour_{{temp_cnt}}', oneOptionValidationMessage);
                                        DocumentRegistration.listview.villSCChangeEvent($(this),'{{temp_cnt}}');"
                                    class="form-control select2 select2-drsfour-{{temp_cnt}}"
                                    data-placeholder="Select !" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-drsfour-ld_village_sc_for_drsfour_{{temp_cnt}}"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label id="ld_srv_pts_gtw_title_for_drsfour_{{temp_cnt}}">1.2 Survey Number <span class="color-nic-red">*</span></label>
                            <select id="ld_srv_pts_gtw_for_drsfour_{{temp_cnt}}" name="ld_srv_pts_gtw_for_drsfour_{{temp_cnt}}" 
                                    onchange="checkValidation('drsfour', 'ld_srv_pts_gtw_for_drsfour_{{temp_cnt}}', oneOptionValidationMessage);
                                        DocumentRegistration.listview.srvPtsGtwChangeEvent($(this),'{{temp_cnt}}');"
                                    class="form-control select2 select2-drsfour-{{temp_cnt}}"
                                    data-placeholder="Select !" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-drsfour-ld_srv_pts_gtw_for_drsfour_{{temp_cnt}}"></span>
                        </div>
                        <div class="form-group col-sm-6 col-md-3">
                            <label id="ld_sd_cl_pt_title_for_drsfour_{{temp_cnt}}">1.3 Subdivision Number <span class="color-nic-red">*</span></label>
                            <select id="ld_sd_cl_pt_for_drsfour_{{temp_cnt}}" name="ld_sd_cl_pt_for_drsfour_{{temp_cnt}}" 
                                    onchange="checkValidation('drsfour', 'ld_sd_cl_pt_for_drsfour_{{temp_cnt}}', oneOptionValidationMessage);"
                                    class="form-control select2 select2-drsfour-{{temp_cnt}}"
                                    data-placeholder="Select !" style="width: 100%;">
                            </select>
                            <span class="error-message error-message-drsfour-ld_sd_cl_pt_for_drsfour_{{temp_cnt}}"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>1.4 Ownership Details</label>
                            <textarea id="ld_ownership_details_for_drsfour_{{temp_cnt}}" name="ld_ownership_details_for_drsfour_{{temp_cnt}}"
                                      class="form-control" placeholder="Ownership Details !" readonly="">{{ld_ownership_details}}</textarea>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>1.5 ULPIN</label>
                            <input type="text" id="ld_ulpin_for_drsfour_{{temp_cnt}}" name="ld_ulpin_for_drsfour_{{temp_cnt}}"
                                   class="form-control" placeholder="Enter ULPIN !" maxlength="30" value="{{pd_ulpin}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="row">
                                <div class="form-group col-sm-4 text-center">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                onclick="DocumentRegistration.listview.openMapForDRSFour('ld',{{temp_cnt}});">
                                            <i class="fas fa-map-marker-alt"></i>&nbsp; Locate on Map
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>1.6 Latitude</label>
                                    <input type="text" id="ld_latitude_for_drsfour_{{temp_cnt}}" name="ld_latitude_for_drsfour_{{temp_cnt}}"
                                           class="form-control ld_latitude_for_drsfour_{{temp_cnt}}"
                                           placeholder="Enter Latitude !" maxlength="30" value="{{ld_latitude}}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>1.7 Longitude</label>
                                    <input type="text" id="ld_longitude_for_drsfour_{{temp_cnt}}" name="ld_longitude_for_drsfour_{{temp_cnt}}"
                                           class="form-control ld_longitude_for_drsfour_{{temp_cnt}}"
                                           placeholder="Enter Longitude !" maxlength="30" value="{{ld_longitude}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label>1.8 North South East West Boundaries and Construction on the Property</label>
                            <textarea id="ld_nsew_details_for_drsfour_{{temp_cnt}}" name="ld_nsew_details_for_drsfour_{{temp_cnt}}" class="form-control"
                                      placeholder="Enter Details !" maxlength="200">{{ld_nsew_details}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>1.9 Land Description / Land Schedule</label>
                            <textarea id="ld_pds_details_for_drsfour_{{temp_cnt}}" name="ld_pds_details_for_drsfour_{{temp_cnt}}" class="form-control"
                                      placeholder="Enter Land Description / Land Schedule !" maxlength="10000" rows="3">{{ld_pds_details}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-beige pd-type-constructed-property-{{temp_cnt}}" style="display: none;">
                <div class="card-header pt-1 pb-1">
                    <div class="row">
                        <div class="col-12 f-w-b">Property Description (If Applicable)</div>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>2.1 Property Number (House / DMC / Flat Number)</label>
                            <input type="text" id="pd_property_number_for_drsfour_{{temp_cnt}}" name="pd_property_number_for_drsfour_{{temp_cnt}}" class="form-control"
                                   placeholder="Enter Property Number (House / DMC / Flat Number) !" maxlength="60" value="{{pd_property_number}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>2.2 ULPIN</label>
                            <input type="text" id="pd_ulpin_for_drsfour_{{temp_cnt}}" name="pd_ulpin_for_drsfour_{{temp_cnt}}" class="form-control"
                                   placeholder="Enter ULPIN !" maxlength="30" value="{{pd_ulpin}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="row">
                                <div class="form-group col-sm-4 text-center">
                                    <label>&nbsp;</label>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                onclick="DocumentRegistration.listview.openMapForDRSFour('pd',{{temp_cnt}});">
                                            <i class="fas fa-map-marker-alt"></i>&nbsp; Locate on Map
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>2.3 Latitude</label>
                                    <input type="text" id="pd_latitude_for_drsfour_{{temp_cnt}}" name="pd_latitude_for_drsfour_{{temp_cnt}}"
                                           class="form-control pd_latitude_for_drsfour_{{temp_cnt}}"
                                           placeholder="Enter Latitude !" maxlength="30" value="{{pd_latitude}}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>2.4 Longitude</label>
                                    <input type="text" id="pd_longitude_for_drsfour_{{temp_cnt}}" name="pd_longitude_for_drsfour_{{temp_cnt}}"
                                           class="form-control pd_longitude_for_drsfour_{{temp_cnt}}"
                                           placeholder="Enter Longitude !" maxlength="30" value="{{pd_longitude}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label>2.5 North South East West Boundaries and Construction on the Property</label>
                            <textarea id="pd_nsew_details_for_drsfour_{{temp_cnt}}" name="pd_nsew_details_for_drsfour_{{temp_cnt}}" class="form-control"
                                      placeholder="Enter Details !" maxlength="200">{{pd_nsew_details}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>2.6 Property Description / Property Schedule</label>
                            <textarea id="pd_pds_details_for_drsfour_{{temp_cnt}}" name="pd_pds_details_for_drsfour_{{temp_cnt}}" class="form-control"
                                      placeholder="Enter Property Description / Property Schedule !" maxlength="10000" rows="3">{{pd_pds_details}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>