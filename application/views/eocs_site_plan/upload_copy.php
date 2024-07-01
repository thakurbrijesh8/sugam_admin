<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        Upload & Generate Site Plan (Urban Area) Nakal Details 
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Name of Applicant</td>
                <td>{{applicant_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Father Name</td>
                <td>{{father_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Surname</td>
                <td>{{surname}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Spouse Name (if any)</td>
                <td>{{spouse_name}}</td>
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
                <td class="f-w-b">Purpose</td>
                <td>{{purpose}}</td>
            </tr>
            <tr>
                <td class="f-w-b">District</td>
                <td>{{district_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Urban Area</td>
                <td>{{ld_area_type_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">{{vsc_title}} / {{spg_title}} / {{scp_title}}</td>
                <td>
                    <span class="badge bg-info app-status">{{village_text}}</span> / 
                    <span class="badge bg-info app-status">{{survey}}</span> / 
                    <span class="badge bg-info app-status">{{subdiv}}</span>
                </td>
            </tr>
            <tr>
                <td class="f-w-b">Property Status</td>
                <td>{{property_status_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Also Issue Copy of</td>
                <td>{{apply_with_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">No. of Copies</td>
                <td><span class="badge bg-nic-blue app-status">{{copies}}</span></td>
            </tr>
        </table>
    </div>
    <form role="form" id="espuc_form" name="espuc_form" onsubmit="return false;" style="font-size: 14px;">
        <div class="row mb-2">
            <div class="col-12">
                <label>Upload Plan Copy <span style="color: red;">* (Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                <input type="file" id="plan_copy_for_espuc" name="plan_copy_for_espuc" accept="application/pdf" >
                <div class="error-message error-message-espuc-plan_copy_for_espuc"></div>
            </div>
        </div>
    </form>
</div>
<div class="card-footer p-2 text-left">
    <button type="button" class="btn btn-sm btn-success" 
            onclick="EocsSitePlan.listview.requestForGenerateCopy($(this),'{{form_land_details_id}}');"><i class="fas fa-recycle"></i> Generate Copy</button>
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fas fa-times"></i> &nbsp; Close</button>
</div>