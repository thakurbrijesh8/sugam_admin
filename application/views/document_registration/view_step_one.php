<div class="table-responsive">
    <table class="table table-bordered table-padding bg-beige">
        <tr>
            <td class="f-w-b" style="width: 40%;">Temp Application Number / Date & Time</td>
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
            <td class="f-w-b">Document Language</td>
            <td>{{doc_language_text}}</td>
        </tr>
        <tr>
            <td class="f-w-b">Document Type (Article)</td>
            <td>{{doc_type_text}}</td>
        </tr>
        {{#if show_lease_details}}
        <tr class="bg-white">
            <td colspan="2">
                <table class="table table-bordered f-w-b mb-0">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="text-center v-a-m">Lease Period</th>
                            <th class="text-center v-a-m">No. of Year For Lease</th>
                            <th class="text-center v-a-m">No. of Month For Lease</th>
                            <th class="text-center v-a-m">Deposit For Lease</th>
                            <th class="text-center v-a-m">Yearly Rent For Lease / Average Annual Rent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-primary">
                            <td class="v-a-m text-center">{{lease_period_text}}</td>
                            <td class="v-a-m text-center">{{noy_lease}} Year</td>
                            <td class="v-a-m text-center">{{nom_lease}} Month</td>
                            <td class="v-a-m text-right">{{deposit}}/-</td>
                            <td class="v-a-m text-right">{{yearly_rent}}/-</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        {{/if}}
        <tr>
            <td class="f-w-b">Consideration Amount (If Any)</td>
            <td>Rs. {{doc_consideration_amount}} /-</td>
        </tr>
        <tr>
            <td class="f-w-b">Registration Fee Exemption</td>
            <td>{{fee_exemption_text}}</td>
        </tr>
        <tr>
            <td class="f-w-b">Document Execution Date</td>
            <td>{{doc_execution_date_text}}</td>
        </tr>
        <tr>
            <td class="f-w-b">Documents Place of Execution</td>
            <td>{{dpe_type_text}}</td>
        </tr>
        {{#if show_within_india}}
        <tr>
            <td class="f-w-b">Documents Place of Execution : State / U.T.</td>
            <td>{{dpe_state_text}}</td>
        </tr>
        <tr>
            <td class="f-w-b">Documents Place of Execution : District</td>
            <td>{{dpe_district_text}}</td>
        </tr>
        {{/if}}
        {{#if show_outside_india}}
        <tr>
            <td class="f-w-b">Documents Place of Execution : Country Name</td>
            <td>{{dpe_country_name}}</td>
        </tr>
        <tr>
            <td class="f-w-b">Documents Place of Execution : Address</td>
            <td>{{dpe_address}}</td>
        </tr>
        {{/if}}
        <tr>
            <td class="f-w-b">Name of Advocate / Deed Writer</td>
            <td>{{adv_dw_name}}</td>
        </tr>
        <tr>
            <td class="f-w-b">Any Other Details / Remarks</td>
            <td>{{aod_remarks}}</td>
        </tr>
    </table>
</div>
<div class="f-w-b f-s-15px">Upload Scanned Copies of Documents to be Registered (Multiple Page Single File Documents)</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="bg-light-gray">
                <th class="text-center" style="width: 30px;">No.</th>
                <th class="text-center" style="min-width: 165px;">Document Name</th>
                <th class="text-center" style="min-width: 165px;">Document</th>
            </tr>
        </thead>
        <tbody id="document_item_container_for_drsone_view" class="bg-white"></tbody>
    </table>
</div>