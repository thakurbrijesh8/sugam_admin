<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Fees Details</h3>
</div>
<div class="card-body p-b-0px text-left f-s-14px">
    {{#if is_allow_changes}}
    <input type="hidden" id="document_registration_id_for_fd" name="document_registration_id_for_fd" value="{{document_registration_id}}" />
    {{/if}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 45%;">Temp Application Number / Date & Time</td>
                <td>{{temp_application_number}} <b>/</b> {{application_datetime_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Application Submitted Date & Time</td>
                <td>{{submitted_datetime_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">District of Application</td>
                <td>{{district_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Document Type (Article)</td>
                <td class="text-primary f-w-b">{{doc_type_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Consideration Amount (Entered by User)</td>
                <td class="text-primary f-w-b">{{doc_consideration_amount}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="bg-beige">
                    <th class="text-center">Estimated Calculation</th>
                    <th class="text-center v-a-m f-w-b">Auto</th>
                    {{#if show_total_of_entered_ca}}
                    <th class="text-center v-a-m f-w-b">Entered by User</th>
                    {{/if}}
                </tr>
                <tr>
                    <th class="v-a-m bg-beige" style="min-width: 120px;">Total Consideration Amount</th>
                    <th class="text-right f-w-b v-a-m" style="min-width: 80px;">{{total_consideration_amount}}</th>
                    {{#if show_total_of_entered_ca}}
                    <th class="text-right f-w-b v-a-m" style="width: 150px;">{{doc_consideration_amount}}</th>
                    {{/if}}
                </tr>
                <tr>
                    <th class="v-a-m bg-beige">Total Stamp Duty</th>
                    <th class="text-right f-w-b v-a-m">{{total_stamp_duty}}</th>
                    {{#if show_total_of_entered_ca}}
                    <th class="text-right f-w-b v-a-m null-eca-total-cal" id="total_dsd_auto_for_drsfour_fd">0</th>
                    {{/if}}
                </tr>
                <tr>
                    <th class="v-a-m bg-beige">Total Registration Fee</th>
                    <th class="text-right f-w-b v-a-m">{{total_registration_fee}}</th>
                    {{#if show_total_of_entered_ca}}
                    <th class="text-right f-w-b v-a-m null-eca-total-cal" id="total_drf_auto_for_drsfour_fd">0</th>
                    {{/if}}
                </tr>
            </thead>
        </table>
    </div>
    {{#if is_allow_changes}}
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-sdd f-w-b mb-2" style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    {{/if}}
    <div class="f-w-b">
        Stamp Paper / Duty Details <span style="color: red;">*</span>
    </div>
    <div class="table-responsive mb-2">
        <table class="table table-bordered table-hover m-b-5px">
            <thead>
                <tr class="bg-light-gray">
                    <th class="text-center" style="width: 30px;">No.</th>
                    <th class="text-center" style="min-width: 250px;">Stamp Paper Number</th>
                    <th class="text-center" style="min-width: 90px;">Stamp Duty Amount</th>
                    {{#if is_allow_changes}}
                    <th class="text-center" style="width: 50px;"></th>
                    {{/if}}
                </tr>
            </thead>
            <tbody id="sd_item_container_for_sdd"></tbody>
            <tfoot>
                <tr class="bg-light-gray">
                    <th class="text-right" colspan="2">Total Stamp Duty Amount : </th>
                    <th id="total_sd_for_sdd" class="text-right">0 /-</th>
                    {{#if is_allow_changes}}
                    <th class="text-center"></th>
                    {{/if}}
                </tr>
            </tfoot>
        </table>
        {{#if is_allow_changes}}
        <button type="button" class="btn btn-sm btn-nic-blue"
                onclick="DocumentRegistration.listview.addSDRow({'is_allow_changes': true});" style="margin-right: 5px;">Add More</button>
        {{/if}}
    </div>
    
    {{#if is_allow_changes}}
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-fd f-w-b mb-2" style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    {{/if}}
    <div class="f-w-b">
        Total Fees Details <span style="color: red;">*</span>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover m-b-5px">
            <thead>
                <tr class="bg-light-gray">
                    <th class="text-center" style="width: 30px;">No.</th>
                    <th class="text-center" style="min-width: 250px;">Fee Description</th>
                    <th class="text-center" style="min-width: 90px;">Fee</th>
                    {{#if is_allow_changes}}
                    <th class="text-center" style="width: 50px;"></th>
                    {{/if}}
                </tr>
            </thead>
            <tbody id="fd_item_container_for_fd"></tbody>
            <tfoot>
                <tr class="bg-light-gray">
                    <th class="text-right" colspan="2">Total Fees Payment : </th>
                    <th id="total_fees_for_fd" class="text-right">0 /-</th>
                    {{#if is_allow_changes}}
                    <th class="text-center"></th>
                    {{/if}}
                </tr>
            </tfoot>
        </table>
        {{#if is_allow_changes}}
        <button type="button" class="btn btn-sm btn-nic-blue"
                onclick="DocumentRegistration.listview.addFDRow({'is_allow_changes': true});" style="margin-right: 5px;">Add More</button>
        {{/if}}
    </div>
</div>
<div class="card-footer text-right">
    {{#if is_allow_changes}}
    <button type="button" class="btn btn-sm btn-success" onclick="DocumentRegistration.listview.updateFeesDetails($(this));"\n\
            >Submit & Generate / Update Fee Receipt</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>