<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">View Mail History</h3>
</div>
<div class="card-body p-b-0px text-left">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-fpmh f-w-b" style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12">
            <label>Application Number <span style="color: red;">*</span></label>
            <input type="text" class="form-control" placeholder="Application Number !"
                   value="{{application_number}}" readonly="">
        </div>
    </div>
    <div class="f-w-b mt-1 mb-1">
        Mail History <span style="color: red;">*</span>
    </div>
    <div class="table-responsive mb-3">
        <table class="table table-bordered table-hover mb-1">
            <thead>
                <tr class="bg-beige">
                    <th class="text-center" style="width: 30px;">No.</th>
                    <th class="text-center" style="min-width: 80px;">Email Id</th>
                    <th class="text-center" style="min-width: 180px;">Status</th>
                    <th class="text-center" style="min-width: 130px;">Message</th>
                    <th class="text-center" style="min-width: 160px;">Mail Send Date & Time</th>
                </tr>
            </thead>
            <tbody id="mail_history_container_for_fpmh"></tbody>
        </table>
    </div>
</div>
<div class="card-footer text-right p-2">
    {{#if show_send_email}}
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="sendFPEmail($(this),'{{module_type}}','{{module_id}}');">
        <i class="fas fa-envelope" style="margin-right: 2px;"></i> Mail for Fees Payment</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();" >
        <i class="fas fa-times"></i> &nbsp; Close
    </button>
</div>