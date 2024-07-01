<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} RTI Form
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-rti f-w-b"
                  style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Application Number</td>
                <td>{{application_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">District</td>
                <td>{{district_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Name of Applicant</td>
                <td>{{applicant_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Profession</td>
                <td>{{applicant_profession}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Mobile Number</td>
                <td>{{mobile_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Date of Birth</td>
                <td>{{applicant_dob_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Address</td>
                <td>{{applicant_address}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Subject matter/file/record etc.</td>
                <td>{{subject}}</td>
            </tr>
            <tr>
                <td class="f-w-b">The period of which the information pertains</td>
                <td>{{pertains_period_date_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b"> Photo Copy / Floppy; etc</td>
                <td>{{rti_type_text}} </td>
            </tr>
            <tr>
                <td class="f-w-b">Dose the request pertain to inspection of records ?</td>
                <td>{{pertains_inspection_record_text}} - {{inspection_no_of_days_text}}</td>
            </tr>
        </table>
    </div>
<!--    <div style="margin-top: 20px; text-align: justify; text-justify: inter-word;">
        <div class="checkbox" style="position: relative; display: block;">
            <label class="cursor-pointer">
                <input type="checkbox" id="declaration_for_heirship"> 
                I, hereby accept the declaration.
            </label>
        </div>
        <span class="error-message error-message-heirship-declaration_for_heirship"></span>
    </div>-->
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_rtiview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
<!--    {{#if show_submit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="fsubmit_btn_for_rti"
            onclick="Rti.listview.submitRti({{VALUE_THREE}});">Submit Application</button>-->
    <!--{{/if}}-->
    
</div>