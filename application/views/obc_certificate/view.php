<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">{{title}} OBC Certificate Form</h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-obc-certificate f-w-b"
                  style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    <div class="table-responsive">

         <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b t-d-w">Application Number</td>
                <td>{{application_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">District</td>
                <td>{{district_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Application Type</td>
                <td>{{application_type_text}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">{{application_type_title}}</td>
                <td>{{applicant_name}}</td>
            </tr>
            {{#if show_gaudian_data}}
            <tr>
                <td class="f-w-b">Relationship of Applicant</td>
                <td>{{relationship_of_applicant_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Guardian's Address</td>
                <td>{{guardian_address}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Guardian’s Mobile Number</td>
                <td>{{guardian_mobile_no}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Guardian’s Aadhaar Number</td>
                <td>{{guardian_aadhaar}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Minor Child Name</td>
                <td>{{minor_child_name}}</td>
            </tr>

            {{/if}}
            <tr>
                <td class="f-w-b">Communication Address</td>
                <td>{{com_addr_house_no}},
                    {{com_addr_house_name}}
                    {{com_addr_street}},
                    {{com_addr_village_dmc_ward}},
                    {{com_addr_city}},
                    {{com_pincode}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">Permanent Address</td>
                <td>{{per_addr_house_no}}
                    {{per_addr_house_name}}
                    {{per_addr_street}},
                    {{per_addr_village_dmc_ward}},
                    {{per_addr_city}},
                    {{per_pincode}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">{{#if show_hide_info}} Mobile Number / {{/if}} Aadhaar Number</td>
                <td>{{#if show_hide_info}} {{mobile_number}} / {{/if}} {{aadhaar}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Gender / Date of Birth / Age <br> Birth Place </td>
                <td>
                    {{gender_text}} /{{applicant_dob_text}} / {{applicant_age}} Years <br> {{born_place_state_text}} , {{born_place_district_text}} , {{born_place_village_text}}
                </td>
            </tr>
            {{#if show_hide_info}}
            <tr>
                <td class="f-w-b">Email Address</td>
                <td>{{email}}</td>
            </tr>
            {{/if}}
            {{#if show_marital_status_data }}
            <tr>
                <td class="f-w-b">Marital Status</td>
                <td>{{marital_status_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Occupation</td>
                <td>{{occupation_text}}</td>
            </tr>
            {{/if}}
            <tr>
                <td class="f-w-b">Nationality</td>
                <td style="vertical-align: top;">{{applicant_nationality}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Caste</td>
                <td>{{applicant_caste_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Religion</td>
                <td>{{religion}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Annual Income</td>
                <td>{{family_annual_income}}</td>
            </tr>
            {{#if show_education}}
            <tr>
                <td class="f-w-b">Education</td>
                <td>{{applicant_education}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Name of School / Collage / Institute</td>
                <td>{{name_of_school}}</td>
            </tr>
            {{/if}}
            {{#if show_education_tbl}}
            <tr>
                <td class="f-w-b">Education</td>
                <td>{{minor_education}}</td>
            </tr>
            {{/if}}
        </table>

        {{#if show_father_mother_info}}
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Father Information</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b t-d-w">Father Name</td>
                    <td>{{father_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Nationality</td>
                    <td style="vertical-align: top;">{{father_nationality}}</td>
                </tr>
                <tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>{{father_born_place_village_text}} , {{father_born_place_district_text}} , {{father_born_place_state_text}} 
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Original Native Of</td>
                    <td>
                        {{father_native_place_village_data}} , {{father_native_place_district_text}} , {{father_city_text}}
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{father_occupation_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Aadhaar Number</td>
                    <td>{{father_aadhaar_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Election Number</td>
                    <td>{{father_election_no}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Caste / Religion</td>
                    <td>{{father_caste}} / {{father_religion}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Father Annual Income (Excluding Salary & Agriculture Income)</td>
                    <td>{{father_annual_income}}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Mother Information</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b t-d-w">Mother Name</td>
                    <td>{{mother_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Nationality</td>
                    <td style="vertical-align: top;">{{mother_nationality}}</td>
                </tr>
                <tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>
                        {{mother_born_place_village_text}} , {{mother_born_place_district_text}} , {{mother_born_place_state_text}}
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Original Native Of</td>
                    <td>
                        {{mother_native_place_village_text}} , {{mother_native_place_district_text}} , {{mother_native_place_state_text}}
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{mother_occupation_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Aadhaar Number</td>
                    <td>{{mother_aadhaar}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Election Number</td>
                    <td>{{mother_election_no}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Caste / Religion</td>
                    <td>{{mother_caste}} / {{mother_religion}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Mother Annual Income (Excluding Salary & Agriculture Income)</td>
                    <td>{{mother_annual_income}}</td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Grandfather Information</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b t-d-w">Grandfather Name</td>
                    <td>{{grandfather_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Nationality</td>
                    <td style="vertical-align: top;">{{grandfather_nationality}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td style="vertical-align: top;">{{grandfather_born_place_village_data}},{{grandfather_borncity_text}},{{grandfather_born_place_district_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Original Native Of</td>
                    <td style="vertical-align: top;">{{grandfather_native_place_village_data}},{{grandfather_city_text}},{{grandfather_native_place_district_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Aadhar Number / Election Number</td>
                    <td>{{grandfather_aadhaar_text}} / {{grandfather_election_no}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Caste / Religion</td>
                    <td>{{grandfather_caste}} / {{grandfather_religion}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{grandfather_occupation_text}}</td>
                </tr>
            </table>
        </div>

        {{/if}}
        {{#if show_spouse}}
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Spouse Information</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b t-d-w">Spouse Name</td>
                    <td>{{spouse_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Nationality</td>
                    <td style="vertical-align: top;">{{spouse_nationality}}</td>
                </tr>
                <tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>
                        {{spouse_born_place_state_text}} , {{spouse_born_place_district_text}} , {{spouse_born_place_village_text}} 
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Original Native Of</td>
                    <td>
                        {{spouse_native_place_state_text}} , {{spouse_native_place_district_text}} , {{spouse_native_place_village_text}} 
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{spouse_occupation_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Aadhaar Number</td>
                    <td>{{spouse_aadhaar}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Election Number</td>
                    <td>{{spouse_election_no}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Caste / Religion</td>
                    <td>{{spouse_caste}} / {{spouse_religion}}</td>
                </tr>
            </table>
        </div>
        {{/if}}

        <div class="f-w-b f-s-16px">Enclosed as below :-</div>
        <div class="table-responsive">
            <table class="table mb-0">
                <tr>
                    {{#if show_applicant_photo_doc}}
                    <td style="width: 180px;">
                        <img style="border: 2px solid blue; width: 160px; height: 180px;"
                             src="{{OBC_CERTIFICATE_DOC_PATH}}{{applicant_photo_doc}}">
                    </td>
                    {{/if}}
                    {{#if show_minor_child_photo_doc}}
                    <td style="width: 180px;">
                        <img style="border: 2px solid blue; width: 160px; height: 180px;"
                             src="{{OBC_CERTIFICATE_DOC_PATH}}{{minor_child_photo_doc}}">
                    </td>
                    {{/if}}
                    <td>
                        <div>
                            {{#if show_tax_payer_copy}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{tax_payer_copy}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Tax Payer Copy  
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_self_birth_certificate_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{self_birth_certificate_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Birth Certificate
                                </label>
                            </a>
                            {{/if}}


                            {{#if show_father_certificate_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{father_certificate_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Father Birth Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_father_election_card_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{father_election_card_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Father Election Card
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_father_aadhar_card_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{father_aadhar_card_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Father Aadhar
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_mother_election_card_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{mother_election_card_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Mother Election Card
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_mother_aadhar_card_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{mother_aadhar_card_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Mother Aadhar
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_grandfather_birth_certificate_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{grandfather_birth_certificate_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Grandfather Birth Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_grandfather_property_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{grandfather_property_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Grandfather Property Document
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_father_community_death_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{father_community_death_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Father Community Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_aadhar_card_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{aadhar_card_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Aadhaar Card
                            </a>
                            {{/if}}
                            {{#if show_community_certificate_doc}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{community_certificate_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Community Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_income_certificate}}
                            <a target="_blank" href="{{OBC_CERTIFICATE_DOC_PATH}}{{income_certificate}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp;Income Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_declaration_btn}}
                            <button type="button" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1"
                                    onclick='ObcCertificate.listview.downloadDeclaration();'>
                                <i class="fas fa-download"></i> &nbsp; Declaration
                            </button>
                            {{/if}}
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <hr>
        <form target="_blank" id="oc_declaration_pdf" action="obc_certificate/download_oc_declaration" method="post">
            <input type="hidden" id="obc_certificate_id_for_oc_declaration" name="obc_certificate_id_for_oc_declaration" value="{{obc_certificate_id}}">
        </form>

        <div class="f-w-b text-center f-s-18px"><span class="b-b-1px">DECLARATION</span></div>
        <div style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
            &nbsp;&nbsp;&nbsp;I the undersigned Shri / Smt. / Kum. <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_name}}&nbsp;&nbsp;</span> 
             {{#if show_gaudian_data}}
             aged,
             {{else}}
             aged about <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{applicant_age}}&nbsp;&nbsp;&nbsp;</span>Years.
             {{/if}} {{#if show_marital_status}} Marital Status <span class="b-b-1px f-w-b t-d-u"> {{marital_status_text}}</span> {{/if}} Indian National  Resident of <span class="b-b-1px f-w-b t-d-u">{{com_addr_house_no}},  {{com_addr_house_name}} {{com_addr_street}},  {{com_addr_village_dmc_ward}}, {{com_addr_city}}, {{com_pincode}}</span>of {{district_text}} District. {{#if show_minor_child_name}}, That I am applied for my Minor Child <span class="b-b-1px f-w-b t-d-u">{{minor_child_name}} {{/if}}</span></br></br>

            1. {{#if show_applicant_name}} That my name is <span class="b-b-1px f-w-b t-d-u">{{applicant_name}}.</span>{{/if}} {{#if show_minor_child_name}} That my Child name is <span class="b-b-1px f-w-b t-d-u"> {{minor_child_name}}</span> {{/if}}  That I was born at Village <span class="b-b-1px f-w-b t-d-u">{{born_place_village_text}}</span>,&nbsp; District&nbsp;<span class="b-b-1px f-w-b t-d-u">{{born_place_district_text}}</span>,&nbsp; State &nbsp;<span class="b-b-1px f-w-b t-d-u">{{born_place_state_text}}</span>.&nbsp;on&nbsp;<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{applicant_dob_text}}&nbsp;&nbsp;&nbsp;</span>and Original Native Place is Village &nbsp;<span class="b-b-1px f-w-b t-d-u">{{native_place_village_text}}</span>,&nbsp; District&nbsp;<span class="b-b-1px f-w-b t-d-u">{{native_place_district_text}}</span>,&nbsp; State &nbsp;<span class="b-b-1px f-w-b t-d-u">{{native_place_state_text}}</span>. Resident of <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{applicant_nationality}}&nbsp;&nbsp;&nbsp;</span>since. That I am an <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{applicant_nationality}}&nbsp;&nbsp;&nbsp;</span>National.  {{#if show_election}} That my name has been included in Electoral Roll of {{district_text}} and my Photo ID Card No<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{election_no}}&nbsp;&nbsp;&nbsp;</span>{{/if}} & Aadhar Card No.<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{aadhaar}}&nbsp;&nbsp;&nbsp;</span>. That I have studied at  <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{#if show_minor_data}} {{minor_education}}{{/if}} {{applicant_education}}&nbsp;&nbsp;&nbsp;</span> {{district_text}}. That my profession is<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{occupation_text}}&nbsp;&nbsp;&nbsp;</span>. My gross annual income is<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{family_annual_income}}&nbsp;&nbsp;&nbsp;</span>/- for the year 20-21. That I do not possess wealth above the exemption limit as prescribed in the wealth Tax Act.</br></br>

            2. That I belong to  <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{obccaste_text}}&nbsp;&nbsp;
                &nbsp;</span>Caste which is recognized as other Backward Class as per Government Notification No.DC/10/201/92/2440 dated 27.01.1994 issued by the Assistant Secretary, Administrator’s Secretariat, Moti Daman/No.AS/SW/519(2)/02-03/260 dated 31.01.2003 issued by the Assistant Secretary, (S.W.), Secretariat, Moti Daman.</br></br>

            3.  That name of my Father is <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_name}}&nbsp;&nbsp;&nbsp;</span>. That he was born at Village <span class="b-b-1px f-w-b t-d-u">{{father_born_place_village_text}}</span>, District <span class="b-b-1px f-w-b t-d-u">{{father_born_place_district_text}}</span>, State <span class="b-b-1px f-w-b t-d-u">{{father_born_place_state_text}}</span>.&nbsp;on and Original Native Place is village <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_native_place_village_data}}&nbsp;&nbsp;&nbsp;</span>District<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_native_place_district_text}}&nbsp;&nbsp;&nbsp;</span>State<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_city_text}}&nbsp;&nbsp;&nbsp;</span>.   Resident of <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_city_text}}&nbsp;&nbsp;&nbsp;</span>since. That he is an <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_nationality}}&nbsp;&nbsp;&nbsp;</span>National. That his name has been included in Electoral Roll of {{district_text}} and His Photo ID Card No.  <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_election_no}}&nbsp;&nbsp;&nbsp;</span> & Aadhar card No<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_aadhaar}}&nbsp;&nbsp;&nbsp;</span>. That his profession is<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_occupation_text}}&nbsp;&nbsp;&nbsp;</span>. His gross annual income is Rs. <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{father_annual_income}}</span>&nbsp;&nbsp;&nbsp;/-for the year 20-2021. That he does not possess wealth above the exemption limit as prescribed in the wealth Tax Act.</br></br>

            4. That name of my mother is  <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{mother_name}}&nbsp;&nbsp;&nbsp;</span>. That she was born at Village <span class="b-b-1px f-w-b t-d-u">{{mother_born_place_village_text}}</span>, District <span class="b-b-1px f-w-b t-d-u">{{mother_born_place_district_text}}</span>, State <span class="b-b-1px f-w-b t-d-u">{{mother_born_place_state_text}}</span>.&nbsp;on and Original Native Place is <span class="b-b-1px f-w-b t-d-u">{{mother_native_place_village_text}}</span>, District <span class="b-b-1px f-w-b t-d-u">{{mother_native_place_district_text}}</span>, State <span class="b-b-1px f-w-b t-d-u">{{mother_native_place_state_text}}</span>. Resident of <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{mother_native_place_state_text}}&nbsp;&nbsp;&nbsp;</span>Since. That She is an <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{mother_nationality}}&nbsp;&nbsp;&nbsp;</span>National. That her name has been included in Electoral Roll of {{district_text}} and Her Photo ID Card No <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{mother_election_no}}&nbsp;&nbsp;&nbsp;</span>& Aadhar Card No.<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{mother_aadhaar}}&nbsp;&nbsp;&nbsp;</span>of {{district_text}} District. That her profession is<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{mother_occupation_text}}&nbsp;&nbsp;&nbsp;</span>. Her gross annual income is Rs.<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{mother_annual_income}}</span>&nbsp;&nbsp;&nbsp;for the year 20-2021. That she does not possess wealth above the exemption limit as prescribed in the wealth Tax Act.</br></br>

            {{#if show_spouse}} 5.  That name of my spouse is  <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{spouse_name}}&nbsp;&nbsp;&nbsp;</span>. That He/she was born at  <span class="b-b-1px f-w-b t-d-u" i>{{spouse_born_place_village_text}}</span>,&nbsp;District&nbsp;<span class="b-b-1px f-w-b t-d-u" >{{spouse_born_place_district_text}}</span>,&nbsp;State&nbsp;<span class="b-b-1px f-w-b t-d-u" >{{spouse_born_place_state_text}}</span>,&nbsp;Since. and Original Native Place is  <span class="b-b-1px f-w-b t-d-u">{{spouse_native_place_village_text}}</span>,&nbsp;District&nbsp;<span class="b-b-1px f-w-b t-d-u" >{{spouse_native_place_district_text}}</span>,&nbsp;State&nbsp;<span class="b-b-1px f-w-b t-d-u">{{spouse_native_place_state_text}}</span>. Resident of<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{spouse_native_place_village_text}}&nbsp;&nbsp;&nbsp;</span> Since.That He is an<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{spouse_nationality}}&nbsp;&nbsp;&nbsp;</span>National. That his/her name has been included in Electoral Roll of {{district_text}} and His/her Photo ID Card No.<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{spouse_election_no}}&nbsp;&nbsp;&nbsp;</span>& Aadhar Card No.<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{spouse_aadhaar}}&nbsp;&nbsp;&nbsp;</span>of {{district_text}} District. That his profession is<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{spouse_occupation_text}}&nbsp;&nbsp;&nbsp;</span>and His/her gross annual income is Rs<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{spouse_annual_income}}</span>&nbsp;&nbsp;&nbsp;/-for the year 20-2021. That he/she does not possess wealth above the exemption limit as prescribed in the wealth Tax Act.</br></br> {{/if}}


            6.  That name of my Grandfather is <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_name}}&nbsp;&nbsp;&nbsp;</span>. That he was born at Village <span class="b-b-1px f-w-b t-d-u">{{grandfather_born_place_village_data}}</span>, District <span class="b-b-1px f-w-b t-d-u">{{grandfather_born_place_district_text}}</span>, State <span class="b-b-1px f-w-b t-d-u">{{grandfather_born_place_state_text}}</span>.&nbsp;on and Original Native Place is village <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_native_place_village_data}}&nbsp;&nbsp;&nbsp;</span>District<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_native_place_district_text}}&nbsp;&nbsp;&nbsp;</span>State<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_city_text}}&nbsp;&nbsp;&nbsp;</span>.   Resident of <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_city_text}}&nbsp;&nbsp;&nbsp;</span>since. That he is an <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_nationality}}&nbsp;&nbsp;&nbsp;</span>National. That his name has been included in Electoral Roll of {{district_text}} and His Photo ID Card No.  <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_election_no}}&nbsp;&nbsp;&nbsp;</span> & Aadhar card No<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_aadhaar}}&nbsp;&nbsp;&nbsp;</span>. That his profession is<span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_occupation_text}}&nbsp;&nbsp;&nbsp;</span>. His gross annual income is Rs. <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{grandfather_annual_income}}</span>&nbsp;&nbsp;&nbsp;/-for the year 20-2021. That he does not possess wealth above the exemption limit as prescribed in the wealth Tax Act.</br></br>

            7. That myself and my parents / my family are ordinarily resident of <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{village_name_text}}&nbsp;&nbsp;&nbsp;</span>of Taluka <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{district_text}}&nbsp;&nbsp;&nbsp;</span>of District in section 20 of the representation of the people Act,1950.</br></br>

            8. That rule of exclusion as mentioned in Office Memorandum no.36012/22/93-Estt(SCT) date 08.09.1993 issued by the ministry of Personnel, public Grievances of Pensions (department of Personnel 7 training), New Delhi, will not apply in my case. My case does not fall in category of persona/sections mentioned in Col.3 of the Schedule to the Office Memorandum as stated above. I am entitled for getting benefit of reservation for other backward Class in Civil Posts and Services under the Government of India.</br></br>

            9. That I do not belong to the creamy layer of other backward Class and I am eligible to the considered for posts reserved for other Backward Class.</br></br>

            10. That I, my father, my mother or family members including minor children do not hold any agricultural land anywhere, if they hold an agricultural land following particulars are to be mentioned. That my father / mother / minor children possess vacant land and / or building in urban areas or urban agglomeration. Details are as under.</br></br>

            A. Location of Property.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B. Details of Property.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C. Use to which it is put.</br></br>

            Except above property we do not own any property anywhere.</br></br>

            I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein. I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the punishment as per the law and that the benefits availed by me shall be summarily withdrawn”. </br></br>

            This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian Penal Code which state as follows:-</br></br>

            Section 199. False statement made in declaration which is by law receivable as evidence:- Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or any Public Servant or other person, is bound or authorized by law to receive as evidence of any fact, makes any statement which is false, and which he either knows or believes to be false or does not believe to be true, touching any point material to the object for which the declaration is made or used, shall be punished in the same manner as if he gave false evidence.</br></br>

            Section 200. Using as true such declaration knowing it to be false:-Whoever
            corruptly uses or attempts to use as true any such declaration, knowing the same to be false in any material point, shall be punished in the same manner as if he gave false evidence.</br></br>

            Explanation: A declaration which is inadmissible merely upon the ground of some informality is a declaration within the meaning of Sections 199 and 200.</br></br>
        </div>

        <div style="margin-top: 5px;">
            Place: <b>{{district_text}}</b>
        </div>

        <div style="margin-top: 5px;">
            Date: <b>{{submitted_datetime_text}}</b>
        </div>


        <div style="margin-top: 20px; text-align: justify; text-justify: inter-word;">
            <div class="checkbox" style="position: relative; display: block;">
                <label class="cursor-pointer">
                    <input type="checkbox" id="declaration_for_obc_certificate"> 
                    I, hereby accept the declaration.
                </label>
            </div>
            <span class="error-message error-message-obc-certificate-declaration_for_obc_certificate"></span>
        </div>
    </div>
    <div class="card-footer text-right">
        {{#if show_print_btn}}
        <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_ocview">
            <i class="fas fa-file-pdf mr-1"></i> Print Application
        </button>
        {{/if}}
        {{#if show_submit_btn}}
        <button type="button" class="btn btn-sm btn-success" id="fsubmit_btn_for_obc_certificate"
                onclick="ObcCertificate.listview.submitObcCertificate({{VALUE_THREE}});">Submit Application</button>
        {{/if}}
        <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
    </div>