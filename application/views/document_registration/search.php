<div class="card">
    <div class="card-body pb-0">
        <form method="post" id="search_document_registration_form" name="search_document_registration_form" 
              onsubmit="return false;" autocomplete="off">
            <div class="row">
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Document Number</label>
                    <input type="text" class="form-control" id="doc_number_for_document_registration_list" 
                           name="doc_number_for_document_registration_list" placeholder="Document Number" maxlength="10"/>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Temp Application Number</label>
                    <input type="text" class="form-control text-center" id="temp_application_number_for_document_registration_list" 
                           name="temp_application_number_for_document_registration_list" placeholder="Temp Application Number" maxlength="10"/>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Document Type</label>
                    <select id="doc_type_for_document_registration_list" 
                            name="doc_type_for_document_registration_list" class="form-control"
                            data-placeholder="Document Type !">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Appointment Date</label>
                    <div class="input-group date">
                        <input type="text" id="appointment_date_for_document_registration_list"
                               placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                               name="appointment_date_for_document_registration_list" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="far fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Query Status</label>
                    <select id="query_status_for_document_registration_list" name="query_status_for_document_registration_list" class="form-control"
                            data-placeholder="Query Status!">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="form-group col-6 col-sm-4 col-lg-2">
                    <label>Status</label>
                    <select id="status_for_document_registration_list" name="status_for_document_registration_list" class="form-control"
                            data-placeholder="Status !">
                        <option value="">All</option>
                    </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>Presenting Party Details</label>
                    <input type="text" class="form-control" id="party_details_for_document_registration_list"
                           name="party_details_for_document_registration_list" placeholder="Presenting Party Details" maxlength="50"/>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-sm btn-success pull-right" style="padding: 2px 7px;"
                onclick="DocumentRegistration.listview.downloadExcelForDocumentRegistration();">
            <i class="fas fa-file-excel" style="margin-right: 2px;"></i>&nbsp; Download Excel</button>
        <button type="button" class="btn btn-sm btn-nic-blue pull-right mr-2" style="padding: 2px 7px;"
                id="search_btn_for_document_registration_list"
                onclick="DocumentRegistration.listview.searchDocumentRegistrationData($(this));">
            <i class="fas fa-search" style="margin-right: 2px;"></i>&nbsp; Search</button>                
    </div>
</div>
<div class="card">
    <div class="card-body" id="document_registration_datatable_container">
    </div>
</div>