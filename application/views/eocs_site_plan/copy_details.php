<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        View Generated Site Plan (Urban Area) Nakal Details 
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
                <td>{{applicant_name}}</td>
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
                <td class="f-w-b">Communication Address</td>
                <td>{{address}}</td>
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
    {{#if show_regenerate_copy_details}}
    <div class="card property_details_for_drsfour fw-body">
        <div class="card-header pt-2 pb-1 bg-nic-blue">
            <h3 class="card-title f-w-b f-s-15px">Upload & Re-Generate Site Plan Copy</h3>
        </div>
        <div class="card-body border-nic-blue">
            <form role="form" id="espruc_form" name="espruc_form" onsubmit="return false;" style="font-size: 14px;">
                <div class="row mb-2">
                    <div class="col-12">
                        <label>Upload Plan Copy <span style="color: red;">* (Maximum File Size: 5MB) &nbsp; (Upload PDF Only)</span></label><br>
                        <input type="file" id="plan_copy_for_espruc" name="plan_copy_for_espruc" accept="application/pdf" >
                        <div class="error-message error-message-espruc-plan_copy_for_espruc"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-sm btn-success" 
                                onclick="EocsSitePlan.listview.requestForReGenerateCopy($(this),'{{form_land_details_id}}');">
                            <i class="fas fa-recycle"></i> &nbsp; Re-Generate Site Plan Copy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{#if show_regenerate_fdb_details}}
    <div class="card property_details_for_drsfour fw-body">
        <div class="card-header pt-2 pb-1 bg-nic-blue">
            <h3 class="card-title f-w-b f-s-15px">Re-Generate Form-D/B Copy</h3>
        </div>
        <div class="card-body border-nic-blue">
            <div class="row">
                <div class="col-12">
                    {{#if show_regenerate_fd_details}}
                    <button type="button" class="btn btn-sm btn-info" 
                            onclick="EocsSitePlan.listview.requestForReGenerateFormDB($(this),'{{form_land_details_id}}', VALUE_ONE);">
                        <i class="fas fa-recycle"></i> &nbsp; Re-Generate Form-D Copy</button>
                    {{/if}}
                    {{#if show_regenerate_fb_details}}
                    <button type="button" class="btn btn-sm btn-info" 
                            onclick="EocsSitePlan.listview.requestForReGenerateFormDB($(this),'{{form_land_details_id}}', VALUE_TWO);">
                        <i class="fas fa-recycle"></i> &nbsp; Re-Generate Form-B Copy</button>
                    {{/if}}
                </div>
            </div>
        </div>
    </div>
    {{/if}}
    {{/if}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 110px;">Form Type</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 110px;">Barcode Number</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 90px;">Date & Time</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Action</td>
                </tr>
            </thead>
            <tbody id="cd_container_for_espcd"></tbody>
        </table>
    </div>
</div>