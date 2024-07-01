<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        View Generated Svamitva RoR Details 
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Application Number</td>
                <td>{{application_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Full Name of Applicant</td>
                <td>{{applicant_name}} {{father_name}} {{surname}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Mobile Number</td>
                <td>{{mobile_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Email Address</td>
                <td>{{email}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Address</td>
                <td>{{address}}</td>
            </tr>
            <tr>
                <td class="f-w-b">District</td>
                <td>{{district_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Village / Survey / Subdiv</td>
                <td>
                    <span class="badge bg-info app-status">{{village_text}}</span> / 
                    <span class="badge bg-info app-status">{{survey}}</span> / 
                    <span class="badge bg-info app-status">{{subdiv}}</span>
                </td>
            </tr>
            <tr>
                <td class="f-w-b">No. of Copies</td>
                <td><span class="badge bg-nic-blue app-status">{{copies}}</span></td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 110px;">Barcode Number</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 90px;">Date & Time</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Action</td>
                </tr>
            </thead>
            <tbody id="cd_container_for_srorcd"></tbody>
        </table>
    </div>
</div>