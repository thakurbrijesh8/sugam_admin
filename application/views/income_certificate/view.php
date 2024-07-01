<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Income Certificate Form
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
                <td class="f-w-b">Applicant's Mobile Number</td>
                <td>{{mobile_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Aadhar Number</td>
                <td>{{aadhar_number}}</td>
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
                <td class="f-w-b">Village / DMC Ward / SMC Ward</td>
                <td>{{village_dmc_ward_text}}</td>
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
                <td class="f-w-b">Applicant Occupation</td>
                <td>{{applicant_occupation_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Nationality</td>
                <td>{{applicant_nationality}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Marital Status</td>
                <td>{{marital_status_text}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Relation With Applicant</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Occupation</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">Father Name</td>
                    <td>{{father_name}}</td>
                    <td>{{father_occupation_text}}</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td class="text-center">Mother Name</td>
                    <td>{{mother_name}}</td>
                    <td>{{mother_occupation_text}}</td>
                </tr>
                {{#if show_spouse}}
                <tr>
                    <td class="text-center">3</td>
                    <td class="text-center">Spouse Name</td>
                    <td>{{spouse_name}}</td>
                    <td>{{spouse_occupation_text}}</td>
                </tr>
                {{/if}}
            </tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Details of Earning Family Members</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Age</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 50px;">Relation with Applicant</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Profession</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 100px;">Yearly Income</td>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td>{{applicant_name}}</td>
                    <td class="text-center">{{applicant_age}}</td>
                    <td class="text-center">Self</td>
                    <td>{{applicant_occupation_text}}</td>
                    <td class="text-right">{{applicant_yearly_income}}</td>
                </tr>
            </thead>
            <tbody class="efm_container_for_icview"></tbody>
        </table>
    </div>
    {{#if show_children}}
    <div class="f-w-b f-s-16px">Children Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center bg-beige">Name</td>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Age</td>
                    <td class="f-w-b text-center bg-beige" style="width: 250px;">Profession</td>
                </tr>
            </thead>
            <tbody class="child_container_for_icview"></tbody>
        </table>
    </div>
    {{/if}}
    {{#if show_imm}}
    <div class="f-w-b f-s-16px">Immovable Property Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center bg-beige">Type of Immovable Property</td>
                    <td class="f-w-b text-center bg-beige">Description</td>
                    <td class="f-w-b text-center bg-beige" style="width: 130px;">Yearly Income</td>
                </tr>
            </thead>
            <tbody class="imm_container_for_icview"></tbody>
        </table>
    </div>
    {{/if}}
    {{#if show_mio}}
    <div class="f-w-b f-s-16px">Other Source of Income Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center bg-beige">Source of Income</td>
                    <td class="f-w-b text-center bg-beige">Description</td>
                    <td class="f-w-b text-center bg-beige" style="width: 130px;">Yearly Income</td>
                </tr>
            </thead>
            <tbody class="mio_container_for_icview"></tbody>
        </table>
    </div>
    {{/if}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">For What Purpose is the Certificate of Income Required</td>
                <td>{{purpose_of_income_certificate}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Did you applied for a Certificate of Income at any time before and if so, when ?</td>
                <td>{{icb_text}}</td>
            </tr>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Total Income</td>
                <td class="text-right f-w-b">{{total_income}}/-</td>
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
                         src="{{INCOME_CERTIFICATE_DOC_PATH}}{{applicant_photo_doc}}">
                </td>
                {{/if}}
                <td>
                    <div>
                        {{#if show_birth_leaving_certy_doc}}
                        <a target="_blank" href="{{INCOME_CERTIFICATE_DOC_PATH}}{{birth_leaving_certy_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aadhar_card_doc}}
                        <a target="_blank" href="{{INCOME_CERTIFICATE_DOC_PATH}}{{aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Aadhar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_election_card_doc}}
                        <a target="_blank" href="{{INCOME_CERTIFICATE_DOC_PATH}}{{election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_income_proof_doc}}
                        <a target="_blank" href="{{INCOME_CERTIFICATE_DOC_PATH}}{{income_proof_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Income Proof / Self Declaration
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_marriage_certificate_doc}}
                        <a target="_blank" href="{{INCOME_CERTIFICATE_DOC_PATH}}{{marriage_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Marriage Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_death_certificate_doc}}
                        <a target="_blank" href="{{INCOME_CERTIFICATE_DOC_PATH}}{{death_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Death Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_spouse_aadhar_card_doc}}
                        <a target="_blank" href="{{INCOME_CERTIFICATE_DOC_PATH}}{{spouse_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Spouse Aadhar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_spouse_election_card_doc}}
                        <a target="_blank" href="{{INCOME_CERTIFICATE_DOC_PATH}}{{spouse_election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Spouse Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_declaration_btn}}
                        <button type="button" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1"
                                onclick='IncomeCertificate.listview.downloadDeclaration();'>
                            <i class="fas fa-download"></i> &nbsp; Declaration
                        </button>
                        {{/if}}
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <form target="_blank" id="ic_declaration_pdf" action="income_certificate/download_ic_declaration" method="post">
        <input type="hidden" id="income_certificate_id_for_ic_declaration" name="income_certificate_id_for_ic_declaration" value="{{income_certificate_id}}">
    </form>
    <div class="f-w-b text-center f-s-18px"><span class="b-b-1px">DECLARATION</span></div>
    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        I <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_name}}&nbsp;&nbsp;&nbsp;</span>
        Son/Daughter of Shri <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_name}}&nbsp;&nbsp;&nbsp;</span>,
        Age <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_age}}&nbsp;&nbsp;&nbsp;</span>,
        Year, Marital Status :- <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{marital_status_text}}&nbsp;&nbsp;&nbsp;</span>,
        Nationality <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_nationality}}&nbsp;&nbsp;&nbsp;</span>,
        Resident of <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_address}}&nbsp;&nbsp;&nbsp;</span>,
        {{district_text}} of {{district_text}} District.
    </div>
    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word; margin-bottom: 5px;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        That my family annual income from all sources was Rs. <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{total_income}}/-&nbsp;&nbsp;&nbsp;</span>
        during the year <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{start_year}}-{{end_year}}&nbsp;&nbsp;&nbsp;</span>. 
        That details of my family annual income as are under :- 
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Relation With Applicant</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Occupation</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">Father Name</td>
                    <td>{{father_name}}</td>
                    <td>{{father_occupation_text}}</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td class="text-center">Mother Name</td>
                    <td>{{mother_name}}</td>
                    <td>{{mother_occupation_text}}</td>
                </tr>
                {{#if show_spouse}}
                <tr>
                    <td class="text-center">3</td>
                    <td class="text-center">Spouse Name</td>
                    <td>{{spouse_name}}</td>
                    <td>{{spouse_occupation_text}}</td>
                </tr>
                {{/if}}
            </tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Details of Earning Family Members</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Age</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 50px;">Relation with Applicant</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Profession</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 100px;">Yearly Income</td>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td>{{applicant_name}}</td>
                    <td class="text-center">{{applicant_age}}</td>
                    <td class="text-center">Self</td>
                    <td>{{applicant_occupation_text}}</td>
                    <td class="text-right">{{applicant_yearly_income}}</td>
                </tr>
            </thead>
            <tbody class="efm_container_for_icview"></tbody>
        </table>
    </div>
    {{#if show_children}}
    <div class="f-w-b f-s-16px">Children Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center bg-beige">Name</td>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Age</td>
                    <td class="f-w-b text-center bg-beige" style="width: 250px;">Profession</td>
                </tr>
            </thead>
            <tbody class="child_container_for_icview"></tbody>
        </table>
    </div>
    {{/if}}
    {{#if show_imm}}
    <div class="f-w-b f-s-16px">Immovable Property Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center bg-beige">Type of Immovable Property</td>
                    <td class="f-w-b text-center bg-beige">Description</td>
                    <td class="f-w-b text-center bg-beige" style="width: 130px;">Yearly Income</td>
                </tr>
            </thead>
            <tbody class="imm_container_for_icview"></tbody>
        </table>
    </div>
    {{/if}}
    {{#if show_mio}}
    <div class="f-w-b f-s-16px">Other Source of Income Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center bg-beige">Source of Income</td>
                    <td class="f-w-b text-center bg-beige">Description</td>
                    <td class="f-w-b text-center bg-beige" style="width: 130px;">Yearly Income</td>
                </tr>
            </thead>
            <tbody class="mio_container_for_icview"></tbody>
        </table>
    </div>
    {{/if}}
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Total Income</td>
                <td class="text-right f-w-b">{{total_income}}/-</td>
            </tr>
        </table>
    </div>
    <div style="margin-top: 5px;">
        That I have neither other except as shown above nor any income from bank interest, etc.
    </div>
    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word;">
        This declaration, I have to submit before the Mamlatdar, {{district_text}} to obtain the Income Certificate for 
        <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{purpose_of_income_certificate}}&nbsp;&nbsp;&nbsp;</span> purpose.
    </div>
    <div class="f-w-b" style="margin-top: 20px; text-align: justify; text-justify: inter-word;">
        I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein.
        I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the 
        punishment as per the law and that the benefits availed by me shall be summarily withdrawn.
    </div>
    <div style="margin-top: 10px; text-align: justify; text-justify: inter-word;">
        This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian
        Penal Code which state as follows:-
    </div>
    <div style="margin-top: 10px; text-align: justify; text-justify: inter-word;">
        <b>Section 199. False statement made in declaration which is by law receivable as evidence:- </b>
        <div>
            Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or 
            any Public Servant or other person, is bound or authorized bylaw to receive as evidence of any fact, 
            makes any statement which is false, and which he either knows or believes to be false or does not 
            believe to be true, touching any point material to the object for which the declaration is made or 
            used, shall be punished in the same manner as if he gave false evidence.
        </div>
    </div>
    <div style="margin-top: 10px; text-align: justify; text-justify: inter-word;">
        <b>Section 200. Using as true such declaration knowing it to be false:- </b>
        Whoever corruptly uses or attempts to use as true any such declaration, knowing the 
        same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
    </div>
    <div style="margin-top: 10px; text-align: justify; text-justify: inter-word;">
        <b>Explanation :- </b>
        A declaration which is inadmissible merely upon the ground of some informality, is a declaration within the meaning of Sections 199 and 200.
    </div>
    <div style="margin-top: 20px; text-align: justify; text-justify: inter-word;">
        <div class="checkbox" style="position: relative; display: block;">
            <label class="cursor-pointer">
                <input type="checkbox" id="declaration_for_income_certificate"> 
                I, hereby accept the declaration.
            </label>
        </div>
        <span class="error-message error-message-income-certificate-declaration_for_income_certificate"></span>
    </div>
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_icview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    {{#if show_submit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="fsubmit_btn_for_income_certificate"
            onclick="IncomeCertificate.listview.submitIncomeCertificate({{VALUE_THREE}});">Submit Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>