<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Heir Ship Certificate Form
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-heirship f-w-b"
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
                <td class="f-w-b">Applicant's Father Name</td>
                <td>{{applicant_father_name}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Mobile Number</td>
                <td>{{mobile_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Aadhar Number / Applicant's Election Number</td>
                <td>{{aadhar_number}} / {{election_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's DOB / Applicant's Age</td>
                <td>{{applicant_dob_text}} / {{applicant_age}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Present Address</td>
                <td>{{pre_house_no}},{{pre_house_name}}{{pre_street}},{{pre_village}},{{pre_city_text}},{{pre_pincode}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Permanent Address</td>
                <td>{{per_house_no}},{{per_house_name}}{{per_street}},{{per_village}},{{per_city_text}},{{per_pincode}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Village / DMC Ward / SMC Ward</td>
                <td>{{village_dmc_ward_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Gender </td>
                <td>{{gender_text}} </td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Religion</td>
                <td>{{religion}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Occupation</td>
                <td>{{occupation_text}} - {{occupation_other}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Nationality</td>
                <td>{{nationality}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Marital Status</td>
                <td>{{marital_status_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Relation with Deceased Person / Name of Deceased Person / Date of Death / Place of Death </td>
                <td>{{relation_with_applicant_text}} / {{death_person_name}} / {{death_date_text}} / {{death_place}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Deceased Person relation with Applicant </td>
                <td> {{relation_deceased_person_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Death Person Aadhar Number / Deceased Person Marital Status</td>
                <td>{{death_aadhar_number}} / {{death_marital_status_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Purpose of Certificate</td>
                <td>{{final_remarks}}</td>
            </tr>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Details of family members </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Family members Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Age</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 50px;">Relation With Deceased Person</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Marital Status</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 100px;">Remarks</td>
                </tr>
            </thead>
            <tbody id="efm_container_for_icview"></tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Witness Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center bg-beige" style="width: 260px;">Name</td>
                    <td class="f-w-b text-center bg-beige" style="width: 60px;">Age</td>
                    <td class="f-w-b text-center bg-beige" style="width: 250px;">Address</td>
                    <td class="f-w-b text-center bg-beige" style="width: 200px;">Occupation</td>
                </tr>
                <tr>
                    <td class="t-a-c" style="width: 60px;">1</td>
                    <td class="t-a-c">{{witness1_name}}</td>
                    <td class="t-a-c" style="width: 60px;">{{witness1_age}}</td>
                    <td class="t-a-c" style="width: 250px;">{{witness1_address}}</td>
                    <td class="t-a-c" style="width: 150px;">{{witness1_occupation_text}} - {{witness1_occupation_other}}</td>
                </tr>
                <tr>
                    <td class="t-a-c" style="width: 60px;">2</td>
                    <td class="t-a-c">{{witness2_name}}</td>
                    <td class="t-a-c" style="width: 60px;">{{witness2_age}}</td>
                    <td class="t-a-c" style="width: 250px;">{{witness2_address}}</td>
                    <td class="t-a-c" style="width: 150px;">{{witness2_occupation_text}} - {{witness2_occupation_other}}</td>
                </tr>
            </thead>
            <!--<tbody id="witness_container_for_icview"></tbody>-->
        </table>
    </div>

    <div class="f-w-b f-s-16px">Enclosed as below :-</div>
    <div class="table-responsive">
        <table class="table mb-0">
            <tr>
                <td>
                    <div>
                        {{#if show_death_certificate_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{death_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Death Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_death_aadhar_card_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{death_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Death Person Aadhar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_marriage_certificate_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{marriage_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Marriage Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aadhar_card_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; All Members Aadhar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_panchayat_certificate_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{panchayat_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Panchayat Legal Heir Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_community_certificate_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{community_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Community Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_applicant_photo_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{applicant_photo_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Applicant Photo
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_witness1_photo_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{witness1_photo_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Witness 1 Photo
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_witness2_photo_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{witness2_photo_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Witness 2 Photo
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_witness1_aadhar_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{witness1_aadhar_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Witness 1 Aadhar
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_witness2_aadhar_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{witness2_aadhar_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Witness 2 Aadhar
                            </label>
                        </a>
                        {{/if}}
                           {{#if show_applicant_witness_photo_notary_affidavit_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{applicant_witness_photo_notary_affidavit_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Applicant and Two Witness Photo Notary Affidavit
                            </label>
                        </a>
                        {{/if}}
                           {{#if show_property_documents_doc}}
                        <a target="_blank" href="{{HEIRSHIP_CERTIFICATE_DOC_PATH}}{{property_documents_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Property Documents 
                            </label>
                        </a>
                        {{/if}}
                        <!--                        {{#if show_declaration_btn}}
                                                <button type="button" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1"
                                                        onclick='Heirship.listview.downloadDeclaration();'>
                                                    <i class="fas fa-download"></i> &nbsp; Declaration
                                                </button>
                                                {{/if}}-->
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <form target="_blank" id="ic_declaration_pdf" action="heirship/download_ic_declaration" method="post">
        <input type="hidden" id="heirship_id_for_ic_declaration" name="heirship_id_for_ic_declaration" value="{{heirship_id}}">
    </form>
    <div class="f-w-b text-center f-s-18px"><span class="b-b-1px">DECLARATION</span></div>
    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        I the undersigned <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_name}}&nbsp;&nbsp;&nbsp;</span>
        Resident of <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{pre_house_no}},&nbsp;{{pre_house_name}}&nbsp;{{pre_street}},&nbsp;{{pre_village_text}},&nbsp;{{pre_city_text}} &nbsp;{{pre_pincode}}&nbsp;&nbsp;</span>,
        <!--Age <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_age}}&nbsp;&nbsp;&nbsp;</span>,-->
        Marital Status :- <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{marital_status_text}}&nbsp;&nbsp;&nbsp;</span>,
        Occupation <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{occupation_text}}&nbsp;&nbsp;&nbsp;</span>
        Nationality <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{nationality}}&nbsp;&nbsp;&nbsp;</span>
        declaring are as under :-
    </div>
    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        1. That my <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{relation_with_applicant_text}}&nbsp;({{death_person_name}})&nbsp;&nbsp;&nbsp;</span> was expired on <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{death_date_text}}&nbsp;&nbsp;&nbsp;</span>
        at <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{death_place}} &nbsp;&nbsp;&nbsp;</span>, and leaving behind following family members only. 
    </div>
    <div class="f-w-b f-s-16px" style="margin-top: 5px;">Details of family members</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Family members Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Age</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 50px;">Relation With Deceased Person</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Marital Status</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 100px;">Remarks</td>
                </tr>
            </thead>
            <tbody id="efm_container_for_icview_declaration"></tbody>
        </table>
    </div>
    <!--    <div class="f-w-b f-s-16px">Witness Details</div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding">
                <thead>
                    <tr>
                        <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center bg-beige">Name</td>
                        <td class="f-w-b text-center bg-beige" style="width: 60px;">Age</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Address</td>
                    </tr>
                </thead>
                <tbody id="witness_container_for_icview_declaration"></tbody>
            </table>
        </div>-->
    <div style="margin-top: 10px;text-align: justify; text-justify: inter-word;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        2. That after the death of my <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{relation_with_applicant_text}}&nbsp;({{death_person_name}})&nbsp;&nbsp;&nbsp;</span>, I/We
        <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<span id='efm_container_for_icview_declaration_name'></span>&nbsp;&nbsp;&nbsp;</span>only the family members of deceased person. 
    </div>
    <div style="margin-top: 10px; text-align: justify; text-justify: inter-word;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        3. That except above no other family members is having of deceased person. 
    </div>
    <div style="margin-top: 10px; text-align: justify; text-justify: inter-word;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        This declaration is required to be produced before the Mamlatdar, {{district_text}} for {{final_remarks}} Purpose.
    </div>
    <div class="f-w-b" style="margin-top: 20px; text-align: justify; text-justify: inter-word;">
        I, hereby declare that the above information is true to the best of 
        my knowledge and belief and nothing has been concealed therein. 
        I am well aware of the fact that if the information given by me is proved false /not true, 
        I will have to face the punishment as per the law and that the benefits availed by me shall be summarily withdrawn”.
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
                <input type="checkbox" id="declaration_for_heirship"> 
                I, hereby accept the declaration.
            </label>
        </div>
        <span class="error-message error-message-heirship-declaration_for_heirship"></span>
    </div>
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_hview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    {{#if show_submit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="fsubmit_btn_for_heirship"
            onclick="Heirship.listview.submitHeirship({{VALUE_THREE}});">Submit Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>