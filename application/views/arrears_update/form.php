<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Assign Khata Number</h3>
            </div>
            <form role="form" id="arrears_update_form" name="arrears_update_form" onsubmit="return false;"
                  autocomplete="off">
                <input type="hidden" id="arrears_update_id_for_arrears_update" name="arrears_update_id_for_arrears_update" value="{{arrears_update_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-arrears-update f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4 col-md-4">
                            <label>District<span class="color-nic-red">*</span></label>
                            <select id="district_for_arrears_update" name="district_for_arrears_update"
                                    data-placeholder="Select District !"
                                    class="form-control select2" style="width: 100%;" onchange="ArrearsUpdate.listview.districtChangeEvent($(this));">
                            </select>
                            <span class="error-message error-message-arrears-update-district_for_arrears_update"></span>
                        </div>
                        <div class="form-group col-sm-4 col-md-4">
                            <label>Type<span class="color-nic-red">*</span></label>
                            <select id="urban_rural_type_for_arrears_update" name="urban_rural_type_for_arrears_update" class="form-control select2" style="width: 100%;" disabled>
                                <option value="{{VALUE_ONE}}" selected="">Rural</option>
                            </select>
                            <span class="error-message error-message-arrears-update-urban_rural_type_for_arrears_update"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4 col-md-4">
                            <label>Village<span class="color-nic-red">*</span></label>
                            <select id="village_for_arrears_update" name="village_for_arrears_update" 
                                    class="form-control select2" style="width: 100%;" onchange="villageChangeEvent($(this), 'arrears_update', false, VALUE_ONE);"
                                    data-placeholder="Select Village">
                            </select>
                            <span class="error-message error-message-arrears-update-village_for_arrears_update"></span>
                        </div>
                        <div class="form-group col-sm-4 col-md-4">
                            <label>Survey Number<span class="color-nic-red">*</span></label>
                            <select id="survey_number_for_arrears_update" name="survey_number_for_arrears_update" 
                                    class="form-control select2" style="width: 100%;" onchange="surveyNumberChangeEvent($(this), 'arrears_update', false, VALUE_ONE);"
                                    data-placeholder="Select Survey Number">
                            </select>
                            <span class="error-message error-message-arrears-update-survey_number_for_arrears_update"></span>
                        </div>
                        <div class="form-group col-sm-4 col-md-4">
                            <label>Sub Division Number<span class="color-nic-red">*</span></label>
                            <select id="subdivision_number_for_arrears_update" name="subdivision_number_for_arrears_update"
                                    class="form-control select2" style="width: 100%;" onchange="ArrearsUpdate.listview.getOccupantDetails();"
                                    data-placeholder="Select Sub Division Number">
                            </select>
                            <span class="error-message error-message-arrears-update-subdivision_number_for_arrears_update"></span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    Occupants Details
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
                                    <tbody id="occupant_detail_info_container">
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>

                    <section id="tabs" class="project-tab land_details" style="display: none;">
                        <div class="row">
                            <div class="col-sm-12" style="margin-bottom: 10px;">
                                <button type="button" class="btn btn-sm btn btn-success float-right" id="merge_btn" 
                                        onclick="ArrearsUpdate.listview.mergeLandForKhataNumber($(this));">
                                    <i class="fas fa-recycle"></i>&nbsp; Merge Selected Row(s)</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header pt-1 pb-1 bg-nic-blue">
                                <div class="row">
                                    <div class="col-12 f-w-b">
                                        Individual / Joint Land Ownership (<span id="ij_land_count"></span>)
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-nic-blue">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered vat-top" cellspacing="0" id="individual_table">
                                        <thead>
                                            <tr>
                                                <th class="text-center v-a-m" style="width: 30px;">
                                                    <input type="checkbox" name="select_all_individual"
                                                           class="cursor-pointer" id="select_all_individual" />
                                                </th>
                                                <th class="text-center v-a-m" style="width: 40px;">No</th>
                                                <th class="text-center v-a-m" style="min-width: 320px;">Name</th>
                                                <th class="text-center v-a-m" style="width: 100px;">Mutation Number</th>
                                                <th class="text-center v-a-m" style="width: 80px;">Type Of Ownership</th>
                                                <th class="text-center v-a-m" style="width: 80px;">Nature</th>
                                                <th class="text-center v-a-m" style="width: 100px;">Survey</th>
                                                <th class="text-center v-a-m" style="width: 100px;">Sub Division</th>
                                                <th class="text-center v-a-m" style="width: 100px;">Area</th>
                                                <th class="text-center v-a-m" style="min-width: 70px;">Current Tax<br>(<?php echo get_financial_year(); ?>)</th>
                                                <th class="text-center v-a-m" style="min-width: 150px;">Arrears<br>(<?php echo get_financial_year(1); ?>)</th>
                                                <th class="text-center v-a-m" style="min-width: 70px;">Total Paid Tax</th>
                                                <th class="text-center v-a-m" style="min-width: 70px;">Total Pending Tax</th>
                                                <th style="display:none;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="ij_land_ownership">
                                        </tbody>
                                        <tfoot id="ij_land_ownership_footer">
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>