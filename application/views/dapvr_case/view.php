<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} DAPVR Case Entry 
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-income-certificate f-w-b"
                  style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Case Number</td>
                <td>{{case_no}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Register Date</td>
                <td>{{register_date}}</td>
            </tr>
            <tr>
                <td class="f-w-b">District</td>
                <td>{{district_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Case Response Type</td>
                <td>{{case_response_type_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Case Type</td>
                <td>{{case_type_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Case Year</td>
                <td>{{year_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Brief of matter </td>
                <td>{{brief_matter}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Rojnamu</td>
                <td>{{rojnamu}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Case Status</td>
                <td>{{case_status}}</td>
            </tr>

        </table>
    </div>
    <div class="f-w-b f-s-16px">Land Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 90px;">Village</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Survey</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 60px;">Subdiv</td>
                </tr>
            </thead>
            <tbody class="ld_container_for_dcview"></tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Petitioner Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 90px;">Petitioner Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Address</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 60px;">Advocate Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 60px;">Adv Mobile No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 60px;">Adv Email Id</td>
                </tr>
            </thead>
            <tbody class="pt_container_for_dcview"></tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Respondent Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 90px;">Respondent Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Address</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 60px;">Advocate Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 60px;">Adv Mobile No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 60px;">Adv Email Id</td>
                </tr>
            </thead>
            <tbody class="rs_container_for_dcview"></tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Hearing Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Hearing Date</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 100px;">Hearing Remarks</td>
                </tr>
            </thead>
            <tbody class="hr_container_for_dcview"></tbody>
        </table>
    </div>
     <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Last Hearing</td>
                <td>{{next_hearing_date}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Judgement</td>
                <td>{{judgement}}</td>
            </tr>
        </table>
    </div>
</div>
<div class="card-footer text-right">
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>