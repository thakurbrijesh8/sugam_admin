<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="notice_history_agriculture_datatable" class="table table-bordered table-padding table-hover vat-top">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center v-a-m" style="width: 50px;">Sr. No.</th>
                        <th class="text-center v-a-m" style="min-width: 80px;">Financial Year</th>
                        <th class="text-center v-a-m" style="min-width: 95px;">Notice Generated On</th>
                        <th class="text-center v-a-m" style="min-width: 125px;">Notice Number</th>
                        <th class="text-center v-a-m" style="min-width: 70px;">Khata Number</th>
                        <th class="text-center v-a-m" style="min-width: 90px;">Village</th>
                        <th class="text-center v-a-m" style="min-width: 80px;">Amount of Arrears</th>
                        <th class="text-center v-a-m" style="width: 50px;">Action</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>
                            <input type="text" class="form-control text-center" placeholder="Financial Year" maxlength="7" />
                        </th>
                        <th>
                            <input type="text" class="form-control text-center" placeholder="Notice Generated On" maxlength="20" />
                        </th>
                        <th>
                            <input type="text" class="form-control text-center" placeholder="Notice Number" maxlength="20" />
                        </th>
                        <th>
                            <input type="text" id="khata_number_for_nh_list" class="form-control text-center" placeholder="Khata Number" maxlength="5" />
                        </th>
                        <th>
                            <select id="village_for_nh_list" class="form-control">
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