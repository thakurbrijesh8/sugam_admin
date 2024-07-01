<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Character Certificate Form
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
                <td class="f-w-b">Communication Address</td>
                <td>{{com_addr_house_no}},
                    {{com_addr_house_name}},
                    {{com_addr_street}},
                    {{com_addr_village_dmc_ward}},
                    {{com_addr_city}},
                    {{com_pincode}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">Permanent Address</td>
                <td>{{per_addr_house_no}},
                    {{per_addr_house_name}},
                    {{per_addr_street}},
                    {{per_addr_village_dmc_ward}},
                    {{per_addr_city}},
                    {{per_pincode}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">Date of Birth / Age</td>
                <td>
                   {{applicant_dob_text}} / {{applicant_age}} Years
                </td>
            </tr>
            <tr>
                <td class="f-w-b t-d-w">Father Name</td>
                <td>{{father_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b t-d-w">Mother Name</td>
                <td>{{mother_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b" style="width: 50%;">Purpose For required Character Certificate required</td>
                <td style="vertical-align: top;">{{purpose}}</td>
            </tr>
        </table>
    </div>
   
    <div class="f-w-b f-s-16px">Enclosed as below :-</div>
    <div class="table-responsive">
        <table class="table mb-0">
            <tr>
                <td>
                    <div>
                        {{#if show_birth_leaving_certy_doc}}
                        <a target="_blank" href="{{CHARACTER_CERTIFICATE_DOC_PATH}}{{birth_leaving_certy_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aadhar_card_doc}}
                        <a target="_blank" href="{{CHARACTER_CERTIFICATE_DOC_PATH}}{{aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Aadhar Card
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
<div class="card-footer text-right">
    {{#if show_submit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="fsubmit_btn_for_character_certificate"
            onclick="CharacterCertificate.listview.submitCharacterCertificate({{VALUE_THREE}});">Submit Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>