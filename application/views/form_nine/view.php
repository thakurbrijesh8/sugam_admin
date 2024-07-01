<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Application for issue of Form No. 9
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
                <td class="f-w-b">Communication Address</td>
                <td>{{address}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Purpose</td>
                <td>{{purpose}}</td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="f-w-b f-s-16px">Details of Land :- (Form No. 3 Required)</div>
    <div class="table-responsive mt-1">
        <table class="table table-bordered table-padding bg-beige mb-1">
            <tr>
                <td class="f-w-b">District</td>
                <td>{{district_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b" style="width: 40%;">Village</td>
                <td>{{village_text}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Survey</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Subdiv</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 150px;">Occupant Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 80px;">Area in Square Meter</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 80px;">Pending Land Tax (If any)</td>
                    <th class="f-w-b text-center v-a-m bg-beige" style="width: 95px;">Mutation Entry No.</th>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 85px;">No. of Copies</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 85px;">Pages as Per Copy</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 80px;">Amount</td>
                </tr>
            </thead>
            <tbody id="fld_container_for_fnview"></tbody>
            <tfoot>
                <tr>
                    <td class="f-w-b text-right text-success v-a-m bg-beige" colspan="7">Rupees To Be Paid : </td>
                    <th class="f-w-b text-right text-success v-a-m bg-beige">Copies : <span id="total_copies_for_fnview"></span></th>
                    <th class="f-w-b text-right text-success v-a-m bg-beige">Pages : <span id="total_pages_for_fnview"></span></th>
                    <th class="f-w-b text-right text-success v-a-m bg-beige">Rs. : <span id="total_amount_for_fnview"></span></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <hr>
    <div class="f-w-b f-s-16px">Enclosed as below :-</div>
    <div class="table-responsive mt-1">
        <table class="table table-bordered table-padding bg-beige mb-1">
            <tr>
                <td class="f-w-b" style="width: 40%;">I.D. Proof Number (Aadhar/PAN/Other Gov.Id)</td>
                <td>{{id_proof_number}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <tr>
                {{#if show_applicant_photo}}
                <td style="width: 180px; border-top: none;">
                    <img style="border: 2px solid blue; width: 160px; height: 180px;"
                         src="{{FORM_NINE_DOC_PATH}}{{applicant_photo}}">
                </td>
                {{/if}}
                <td style="border-top: none; vertical-align: top !important;">
                    <div>
                        {{#if show_id_proof}}
                        <a target="_blank" href="{{FORM_NINE_DOC_PATH}}{{id_proof}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; I.D. Proof (Aadhar / PAN / Other Gov.Id)
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_other_document}}
                        <a target="_blank" href="{{FORM_NINE_DOC_PATH}}{{other_document}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Other Document
                            </label>
                        </a>
                        {{/if}}
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_fnview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>