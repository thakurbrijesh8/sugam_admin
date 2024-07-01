<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="na_application_datatable" class="table table-bordered table-hover vat-top">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center" style="width: 30px;">No.</th>
                        <th class="text-center" style="min-width: 120px;">Application Number</th>
                        <th class="text-center v-a-m" style="min-width: 80px;">Application <br>Date & Time</th>
                        <?php if (is_admin()) { ?>
                            <th class="text-center" style="min-width: 80px;">District</th>
                        <?php } ?>
                        <th class="text-center" style="min-width: 120px;">Applicant Name</th>
                        <th class="text-center v-a-m" style="min-width: 250px;">
                            Village / Survey / Sub Division / Total Area (Area Applied for N.A.)
                        </th>
                        <th class="text-center" style="width: 90px;">Query Status</th>
                        <th class="text-center" style="width: 90px;">Status</th>
                        <th class="text-center" style="width: 50px;">Action</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th><input type="text" class="form-control text-center" placeholder="Application Number"/></th>
                        <th></th>
                        <?php if (is_admin()) { ?>
                            <th>
                                <select id="district_for_na_list" class="form-control"
                                        data-placeholder="District !">
                                    <option value="">All</option>
                                </select>
                            </th>
                        <?php } ?>
                        <th>
                            <input type="text" class="form-control" placeholder="Applicant Name" />
                        </th>
                        <th colspan="2"></th>
                        <th>
                            <select id="status_for_na_list" class="form-control"
                                    data-placeholder="Status !">
                                <option value="">All</option>
                            </select>
                        </th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>