<div class="card">
    <div class="card-body pb-0">
        <form method="post" id="search_income_certificate_form" name="search_income_certificate_form" 
              onsubmit="return false;" autocomplete="off">
            <input type="hidden" name="is_full_for_income_certificate_list" id="is_full_for_income_certificate_list">
            <div class="row">
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Application Number</label>
                    <input type="text" class="form-control" id="app_no_for_income_certificate_list" 
                           name="app_no_for_income_certificate_list" placeholder="Application Number" maxlength="50"/>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Application Date</label>
                    <div class="input-group date">
                        <input type="text" id="application_date_for_income_certificate_list"
                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                               name="application_date_for_income_certificate_list" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Applicant Details</label>
                    <input type="text" class="form-control" id="app_details_for_income_certificate_list" 
                           name="app_details_for_income_certificate_list" placeholder="Applicant Details" maxlength="100"/>
                </div>
                <?php if (is_admin()) { ?>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <label>District</label>
                        <select id="district_for_income_certificate_list" name="district_for_income_certificate_list" class="form-control" onchange="districtChangeEventForList($(this), 'income_certificate_list');"
                                data-placeholder="District !">
                            <option value="">All</option>
                        </select>
                    </div>
                <?php } ?>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Village</label>
                    <select id="vdw_for_income_certificate_list" name="vdw_for_income_certificate_list" class="form-control">
                        <option value="">All</option>
                    </select>
                </div>
                <?php if (is_admin() || is_talathi_user()) { ?>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <label>Appointment Date & Time </label>
                        <select class="form-control" id="appointment_status_for_income_certificate_list" name="appointment_status_for_income_certificate_list">
                            <option value="">All</option>
                        </select>
                    </div>
                <?php } ?>
                <?php if (is_talathi_user() || is_aci_user() || is_ldc_user() || is_mamlatdar_user()) { ?>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <label>App. Movement Status </label>
                        <select id="currently_on_for_income_certificate_list" name="currently_on_for_income_certificate_list" class="form-control">
                            <option value="">All</option>
                        </select>
                    </div>
                <?php } ?>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Query Status</label>
                    <select id="query_status_for_income_certificate_list" name="query_status_for_income_certificate_list" class="form-control"
                            data-placeholder="Query Status!">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Status</label>
                    <select id="status_for_income_certificate_list" name="status_for_income_certificate_list" class="form-control"
                            data-placeholder="Status !">
                        <option value="">All</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-sm btn-success pull-right" style="padding: 2px 7px;"
                onclick="IncomeCertificate.listview.downloadExcelForIC();">
            <i class="fas fa-file-excel" style="margin-right: 2px;"></i>&nbsp; Download Excel</button>
        <button type="button" class="btn btn-sm btn-nic-blue pull-right mr-2" style="padding: 2px 7px;"
                id="search_btn_for_income_certificate_list"
                onclick="IncomeCertificate.listview.searchIncomeCertificateData($(this));">
            <i class="fas fa-search" style="margin-right: 2px;"></i>&nbsp; Search</button>                
    </div>
</div>
<div class="card">
    <div class="card-body" id="income_certificate_datatable_container">
    </div>
</div>