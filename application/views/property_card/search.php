<div class="card">
    <div class="card-body pb-0">
        <form method="post" id="search_property_card_form" name="search_property_card_form" 
              onsubmit="return false;" autocomplete="off">
            <input type="hidden" name="is_full_for_property_card_list" id="is_full_for_property_card_list">
            <input type="hidden" name="is_plan_status_for_property_card_list" id="is_plan_status_for_property_card_list">
            <div class="row">
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Application Number</label>
                    <input type="text" class="form-control" id="app_no_for_property_card_list" 
                           name="app_no_for_property_card_list" placeholder="Application Number" maxlength="50"/>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Application Date</label>
                    <div class="input-group date">
                        <input type="text" id="application_date_for_property_card_list"
                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                               name="application_date_for_property_card_list" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Applicant Details</label>
                    <input type="text" class="form-control" id="app_details_for_property_card_list" 
                           name="app_details_for_property_card_list" placeholder="Applicant Details" maxlength="100"/>
                </div>
                <?php if (is_admin()) { ?>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <label>District</label>
                        <select id="district_for_property_card_list" name="district_for_property_card_list" class="form-control"
                                onchange="districtChangeEventForEocsList($(this), 'property_card_list');"
                                data-placeholder="District !">
                            <option value="">All</option>
                        </select>
                    </div>
                <?php } ?>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Area Type</label>
                    <select id="area_type_for_property_card_list" name="area_type_for_property_card_list" class="form-control"
                            onchange="areaTypeChangeEventForList($(this), 'property_card_list');">
                        <option value="">All</option>
                        <option value="1">P.T. Sheet Wise Area</option>
                        <option value="2">Gauthan Wise Area</option>
                    </select>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Village</label>
                    <select id="vdw_for_property_card_list" name="vdw_for_property_card_list" class="form-control">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Status</label>
                    <select id="status_for_property_card_list" name="status_for_property_card_list" class="form-control"
                            data-placeholder="Status !">
                        <option value="">All</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-sm btn-nic-blue pull-right mr-2" style="padding: 2px 7px;"
                id="search_btn_for_property_card_list"
                onclick="PropertyCard.listview.searchPropertyCardData($(this));">
            <i class="fas fa-search" style="margin-right: 2px;"></i>&nbsp; Search</button>                
    </div>
</div>
<div class="card">
    <div class="card-body" id="property_card_datatable_container">
    </div>
</div>