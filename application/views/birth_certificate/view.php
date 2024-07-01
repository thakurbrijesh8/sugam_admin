<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Birth Certificate Form
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-birth-certificate f-w-b"
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
                <td class="f-w-b">Applicant's Mobile Number</td>
                <td>{{mobile_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Aadhar Number</td>
                <td>{{aadhar_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Email Address</td>
                <td>{{email}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Communication Address</td>
                <td>{{communication_address}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Permanent Address</td>
                <td>{{applicant_address}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Gender / Date of Birth / Age</td>
                <td>{{gender_text}} /{{applicant_dob_text}} / {{applicant_age}} Years</td>
            </tr>
            <tr>
                <td class="f-w-b">Birth Place</td>
                <td>{{applicant_born_place}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Mother Name</td>
                <td>{{mother_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Father Name</td>
                <td>{{father_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Registration Number</td>
                <td>{{registration_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Registration Details</td>
                <td>{{registration_details_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Relationship With Applicant</td>
                <td>{{relationship_with_applicant_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Purpose</td>
                <td>{{purpose}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applying For</td>
                <td>{{applying_for_text}}</td>
            </tr>
        </table>
    </div>
        <div class="f-w-b f-s-16px">Enclosed as below :-</div>
        <div class="table-responsive">
            <table class="table mb-0">
                <tr>
                    {{#if show_applicant_photo_doc}}
                <td style="width: 180px;">
                    <img style="border: 2px solid blue; width: 160px; height: 180px;"
                         src="{{BIRTH_CERTIFICATE_DOC_PATH}}/{{applicant_photo_doc}}">
                </td>
                {{/if}}
                <td>
                    <div>
                        {{#if show_birth_certi_doc}}
                        <a target="_blank" href="{{BIRTH_CERTIFICATE_DOC_PATH}}{{birth_certi_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aadhar_card_doc}}
                        <a target="_blank" href="{{BIRTH_CERTIFICATE_DOC_PATH}}{{aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Aadhar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_old_birth_certi_doc}}
                        <a target="_blank" href="{{BIRTH_CERTIFICATE_DOC_PATH}}{{old_birth_certi_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Old Birth Certificate
                            </label>
                        </a>
                        {{/if}}

                    </div>
                </td>
                </tr>
            </table>
        </div>
        <hr>
    </div> 
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_bcview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>