<div class="card">
    <div class="card-header">
        {{{s_display_text}}}
        <button type="button" class="btn btn-sm btn-success pull-right" style="padding: 2px 7px;"
                onclick="DeathCertificate.listview.downloadExcelForDC();">
            <i class="fas fa-file-excel" style="margin-right: 2px;"></i>&nbsp; Download Excel</button>
    </div>
    <div class="card-body" id="death_certificate_datatable_container">
        <div class="table-responsive">
            <table id="death_certificate_datatable" class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-light-gray">
                    <th class="text-center v-a-m" style="width: 30px;">No.</th>
                        <th class="text-center v-a-m" style="min-width: 120px;">Application Number<hr>Date & Time</th>
                        <th class="text-center v-a-m" style="width: 80px;">District</th>
                        <th class="text-center v-a-m" style="min-width: 180px;">Applicant Details</th>
                        <th class="text-center v-a-m" style="min-width: 180px;">Registration Details</th>
                        <th class="text-center v-a-m" style="width: 90px;">Query Status</th>
                        <th class="text-center v-a-m" style="width: 90px;">Status</th>
                        <th class="text-center" style="min-width: 130px;">Approve / Rejection Details</th>
                        <th class="text-center v-a-m" style="width: 50px;">Action</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <input type="text" id="app_no_for_death_certificate_list"
                                   class="form-control text-center" placeholder="Application Number"/>
                        </th>
                        <th></th>
                        <th><input type="text" id="app_details_for_birth_certificate_list"
                                   class="form-control text-center" placeholder="Applicat Details"/></th>
                        <th></th>
                        <th></th>
                        <th>
                            <select id="query_status_for_death_certificate_list" class="form-control">
                                <option value="">All</option>
                            </select>
                        </th>
                        <th>
                            <select id="status_for_death_certificate_list" class="form-control"
                                    data-placeholder="Status !">
                                <option value="">All</option>
                            </select>
                        </th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>