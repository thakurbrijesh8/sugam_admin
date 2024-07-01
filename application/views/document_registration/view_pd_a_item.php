<div class="card property_details_for_drsfour fw-body">
    <div class="card-header pt-2 pb-1 bg-nic-blue">
        <h3 class="card-title f-w-b f-s-15px">
            Property Detail : Sr. No. {{temp_cnt}}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus text-white"></i>
            </button>
        </div>
    </div>
    <div class="card-body border-nic-blue">
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Property Type</td>
                    <td>{{pd_type_text}}</td>
                </tr>
            </table>
        </div>
        {{#if show_ld}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-white">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Main Area</td>
                    <td>{{ol_main_area_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Sub Area</td>
                    <td>{{ol_sub_area_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Purpose</td>
                    <td>{{ol_purpose_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Sub Area</td>
                    <td>{{ol_land_area}}</td>
                </tr>
                {{#if show_ca}}
                <tr>
                    <td colspan="2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-center v-a-m f-w-b" colspan="2">Auto Calculated (Estimated)</th>
                                    </tr>
                                    <tr>
                                        <th class="v-a-m bg-light-gray" style="min-width: 120px;">Consideration Amount</th>
                                        <th class="text-right f-w-b v-a-m" id="land_dca_auto_for_drsfour_view_{{temp_cnt}}" style="min-width: 80px;">{{land_auto_con}}</th>
                                    </tr>
                                    <tr>
                                        <th class="v-a-m bg-light-gray">
                                            Stamp Duty (<span class="land_dsd_per_for_drsfour_view_{{temp_cnt}} f-w-b"></span>)
                                        </th>
                                        <th class="text-right f-w-b v-a-m" id="land_dsd_auto_for_drsfour_view_{{temp_cnt}}">{{land_auto_sd}}</th>
                                    </tr>
                                    <tr>
                                        <th class="v-a-m bg-light-gray">
                                            Registration Fee (<span class="land_drf_per_for_drsfour_view_{{temp_cnt}} f-w-b"></span>)
                                        </th>
                                        <th class="text-right f-w-b v-a-m" id="land_drf_auto_for_drsfour_view_{{temp_cnt}}">{{land_auto_rf}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </td>
                </tr>
                {{/if}}
            </table>
        </div>
        {{/if}}
        {{#if show_cp}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-white">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Property Type</td>
                    <td>{{cp_property_type_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Category of Construction</td>
                    <td>{{cp_cc_text}}</td>
                </tr>
                {{#if show_cp_height_above}}
                <tr>
                    <td class="f-w-b">Height Above 16 ft.</td>
                    <td>{{cp_height_above}}</td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Age of Construction for Depreciation</td>
                    <td>{{cp_age_cd_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Constructed Area in Sq. Foot</td>
                    <td>{{cp_constructed_area}}</td>
                </tr>
                {{#if show_ca}}
                <tr>
                    <td colspan="2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="bg-light-gray">
                                        <th class="text-center v-a-m f-w-b" colspan="2">Auto Calculated (Estimated)</th>
                                    </tr>
                                    <tr>
                                        <th class="v-a-m bg-light-gray" style="min-width: 120px;">Consideration Amount</th>
                                        <th class="text-right f-w-b v-a-m" id="cp_dca_auto_for_drsfour_view_{{temp_cnt}}" style="min-width: 80px;">{{cp_auto_co}}</th>
                                    </tr>
                                    <tr>
                                        <th class="v-a-m bg-light-gray">
                                            Stamp Duty (<span class="cp_dsd_per_for_drsfour_view_{{temp_cnt}} f-w-b"></span>)
                                        </th>
                                        <th class="text-right f-w-b v-a-m" id="cp_dsd_auto_for_drsfour_view_{{temp_cnt}}">{{cp_auto_sd}}</th>
                                    </tr>
                                    <tr>
                                        <th class="v-a-m bg-light-gray">
                                            Registration Fee (<span class="cp_drf_per_for_drsfour_view_{{temp_cnt}} f-w-b"></span>)
                                        </th>
                                        <th class="text-right f-w-b v-a-m" id="cp_drf_auto_for_drsfour_view_{{temp_cnt}}">{{cp_auto_rf}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </td>
                </tr>
                {{/if}}
            </table>
        </div>
        {{/if}}
        <div class="card bg-beige">
            <div class="card-header pt-2 pb-1">
                <h3 class="card-title f-w-b f-s-15px">Land Details (As per Land Records Data)</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-padding bg-white mb-0">
                        <tr>
                            <td class="f-w-b" style="width: 40%;">Rural / Urban</td>
                            <td>{{ld_type_text}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">{{ld_village_sc_title}} / {{ld_srv_pts_gtw_title}} / {{ld_sd_cl_pt_title}}</td>
                            <td>
                                <span class="badge bg-info app-status">{{ld_village_sc_text}}</span> / 
                                <span class="badge bg-info app-status">{{ld_srv_pts_gtw}}</span> / 
                                <span class="badge bg-info app-status">{{ld_sd_cl_pt}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Ownership Details</td>
                            <td>{{ld_ownership_details}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">ULPIN</td>
                            <td>{{ld_ulpin}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Latitude</td>
                            <td>{{ld_latitude}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Longitude</td>
                            <td>{{ld_longitude}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">North South East West Boundaries and Construction on the Property</td>
                            <td style="word-break: break-all;">{{ld_nsew_details}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Land Description / Land Schedule</td>
                            <td style="word-break: break-all;">{{ld_pds_details}}</td>
                        </tr>
                    </table>
                </div>
                {{#if show_ld_map}}
                <div class="row">
                    <div class="col-12">
                        <div id="ld_map_container_for_drsfour_view_{{temp_cnt}}" style="height: 250px;"></div>
                    </div>
                </div>
                {{/if}}
            </div>
        </div>
        {{#if show_cp}}
        <div class="card bg-beige">
            <div class="card-header pt-2 pb-1">
                <h3 class="card-title f-w-b f-s-15px">Property Description (If Applicable)</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-padding bg-white mb-0">
                        <tr>
                            <td class="f-w-b" style="width: 40%;">Property Number (House / DMC / Flat Number)</td>
                            <td>{{pd_property_number}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">ULPIN</td>
                            <td>{{pd_ulpin}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Latitude</td>
                            <td>{{pd_latitude}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Longitude</td>
                            <td>{{pd_longitude}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">North South East West Boundaries and Construction on the Property</td>
                            <td style="word-break: break-all;">{{pd_nsew_details}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Property Description / Property Schedule</td>
                            <td style="word-break: break-all;">{{pd_pds_details}}</td>
                        </tr>
                    </table>
                </div>
                {{#if show_pd_map}}
                <div class="row">
                    <div class="col-12">
                        <div id="pd_map_container_for_drsfour_view_{{temp_cnt}}" style="height: 250px;"></div>
                    </div>
                </div>
                {{/if}}
            </div>
        </div>
        {{/if}}
    </div>
</div>