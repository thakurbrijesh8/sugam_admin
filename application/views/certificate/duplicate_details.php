<div class="row">
    <div class="col-sm-6 col-md-3 m-b-5px">
        <label class="m-b-0px"><i class="fas fa-calendar-alt"></i> Application Number</label><br>
        <span>{{application_number}}</span>
    </div>
    <div class="col-sm-6 col-md-3 m-b-5px">
        <label class="m-b-0px"><i class="fas fa-file-signature"></i> Applicant Name</label><br>
        <span>{{applicant_name}}</span>
    </div>
    <div class="col-sm-6 col-md-3 m-b-5px">
        <label class="m-b-0px"><i class="fas fa-mobile"></i> Mobile Number</label><br>
        <span>{{mobile_number}}</span>
    </div>
    <div class="col-sm-6 col-md-3 m-b-5px">
        <label class="m-b-0px"><i class="fas fa-id-card"></i> Aadhar Number</label><br>
        <span>{{aadhar_number}}</span>
    </div>
</div>
<div class="table-responsive">
    <table id="duplicate_details_datatable" class="table table-bordered table-hover">
        <thead>
            <tr class="bg-light-gray">
                <th class="text-center v-a-m" style="width: 30px;">No.</th>
                <th class="text-center v-a-m" style="min-width: 120px;">Application Number</th>
                <th class="text-center v-a-m" style="min-width: 50px;">Application Date & Time</th>
                <th class="text-center v-a-m" style="min-width: 50px;">District</th>
                <th class="text-center v-a-m" style="min-width: 180px;">Applicant Name</th>
                <th class="text-center v-a-m" style="min-width: 180px;">Mobile Number</th>
                <th class="text-center v-a-m" style="min-width: 50px;">Aadhar Number</th>
                <th class="text-center v-a-m" style="width: 50px;">Action</th>
            </tr>
        </thead>
        <tbody id="duplicate_details_container_for_{{module_type}}"></tbody>
    </table>
</div>