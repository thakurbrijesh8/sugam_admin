<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Caste Certificate Form
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-caste-certificate f-w-b"
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
                <td class="f-w-b">Application Type</td>
                <td>{{application_type_text}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">{{application_type_title}}</td>
                <td>{{applicant_name}}</td>
            </tr>
            {{#if show_gaudian_data }}
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
                <td class="f-w-b">Guardian’s Aadhar Number</td>
                <td>{{guardian_aadhaar}}</td>
            </tr>
            {{/if}}

            {{#if show_applicant_data }}
            <tr>
                <td class="f-w-b">Applicant's Mobile Number</td>
                <td>{{mobile_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Occupation</td>
                <td>{{occupation_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Election Number</td>
                <td>{{election_no}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Email Address</td>
                <td>{{email}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Marital Status</td>
                <td>{{marital_status_text}}</td>
            </tr>
            {{/if}}


            <tr>
                <td class="f-w-b">Applicant's Aadhar Number</td>
                <td>{{aadhaar}}</td>
            </tr>

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
                <td>{{per_addr_house_no}},
                    {{per_addr_house_name}}
                    {{per_addr_street}},
                    {{per_addr_village_dmc_ward}},
                    {{per_addr_city}},
                    {{per_pincode}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">Village / DMC Ward / SMC Ward</td>
                <td>{{village_name_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Gender / Date of Birth / Age</td>
                <td>{{gender_text}} /{{applicant_dob_text}} / {{applicant_age}} Years</td>
            </tr>
            <tr>
                <td class="f-w-b">Birth Place <br/> Native Place</td>
                <td>{{born_place_state_text}} / {{born_place_district_text}} / {{born_place_village_text}} / {{born_place_pincode}} <br/>{{native_place_state_text}} / {{native_place_district_text}} / {{native_place_village_text}} / {{native_place_pincode}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Religion / Cast / Sub Cast</td>
                <td>{{applicant_religion}} / {{applicant_caste_text}} / {{apllicant_subcaste_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Nationality</td>
                <td>{{applicant_nationality}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Nearest Police Station</td>
                <td>{{nearest_police_station_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Education</td>
                <td>{{applicant_education}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Name of School / Collage / Institute</td>
                <td>{{name_of_school}}</td>
            </tr>
            <!-- <tr>
                <td class="f-w-b">Father Name / Occupation</td>
                <td>{{father_name}} / {{father_occupation_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Mother Name / Occupation</td>
                <td>{{mother_name}} / {{mother_occupation_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Grandfather Name / Occupation</td>
                <td>{{grandfather_name}} / {{grandfather_occupation_text}}</td>
            </tr>
            {{#if show_spouse}}
            <tr>
                <td class="f-w-b">Spouse Name / Occupation</td>
                <td>{{spouse_name}} / {{spouse_occupation_text}}</td>
            </tr>
            {{/if}} -->
        </table>
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
                        <td>{{father_born_place_state_text}} , {{father_born_place_district_text}} , {{father_born_place_village_text}}
                        </td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Original Native Of</td>
                        <td>
                            {{father_native_place_district_text}} , {{father_native_place_city_text}} , {{father_native_place_village_text}}
                        </td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Father Religion / Cast / Sub Cast</td>
                        <td>{{father_religion_text}} / {{father_caste_text}} / {{father_subcaste_text}}</td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Occupation</td>
                        <td>{{father_occupation_text}}</td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Aadhaar Number</td>
                        <td>{{father_aadhaar}}</td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Election Number</td>
                        <td>{{father_election_no}}</td>
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
                            {{mother_born_place_state_text}} , {{mother_born_place_district_text}} , {{mother_born_place_village_text}}
                        </td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Original Native Of</td>
                        <td>
                            {{mother_native_place_state_text}} , {{mother_native_place_district_text}} , {{mother_native_place_village_text}}
                        </td>
                    </tr>
                    <td class="f-w-b">Mother Religion / Cast / Sub Cast</td>
                        <td>{{mother_religion_text}} / {{mother_caste_text}} / {{mother_subcaste_text}}</td>
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
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>
                        {{grandfather_born_place_state_text}} , {{grandfather_born_place_district_text}} , {{grandfather_born_place_village_text}}
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Original Native Of</td>
                    <td>
                        {{grandfather_native_place_district_text}} , {{grandfather_native_place_city_text}} , {{grandfather_native_place_village_text}}
                    </td>
                </tr>
                <td class="f-w-b">Grandfather Religion / Cast / Sub Cast</td>
                    <td>{{grandfather_religion_text}} / {{grandfather_caste_text}} / {{grandfather_subcaste_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{grandfather_occupation_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Aadhaar Number</td>
                    <td>{{grandfather_aadhaar}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Election Number</td>
                    <td>{{grandfather_election_no}}</td>
                </tr>
            </table>
        </div>
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
                    <td class="f-w-b">Spouse Religion / Cast / Sub Cast</td>
                        <td>{{spouse_religion_text}} / {{spouse_caste_text}} / {{spouse_subcaste_text}}</td>
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
                </table>
            </div>
            {{/if}}
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">I am member of a Scheduled Caste/ tribe or community classified by Govt.</td>
                <td>{{detail_of_membership_scst}}</td>
            </tr>
            <tr>
                <td class="f-w-b" style="width: 40%;">For What Purpose is the Certificate of Caste Required</td>
                <td>{{purpose_of_caste_certificate}}</td>
            </tr>
            <tr>
                <td class="f-w-b" style="width: 40%;">Did you applied for a Caste/Tribe Certificate previously ?</td>
                <td>{{applied_date_text}} / {{year_of_applied_certy}}</td>
            </tr>
            <tr>
                <td class="f-w-b" style="width: 40%;">My father/ Husband/ Wife hold Caste/Tribe Certificate details of the same are as under</td>
                <td>{{applied_date_of_hold_certy_text}} / {{year_of_applied_hold_certy}}</td>
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
                         src="{{CASTE_CERTIFICATE_DOC_PATH}}{{applicant_photo_doc}}">
                </td>
                {{/if}}
                {{#if show_minor_child_photo_doc}}
                <td style="width: 180px;">
                    <img style="border: 2px solid blue; width: 160px; height: 180px;"
                         src="{{CASTE_CERTIFICATE_DOC_PATH}}{{minor_child_photo_doc}}">
                </td>
                {{/if}}
                <td>
                    <div>
                        {{#if show_self_birth_certificate_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{self_birth_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_certificate_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{father_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_grandfather_birth_certificate_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{grandfather_birth_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Grandfather Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_grandfather_property_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{grandfather_property_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Grandfather Property Document
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_leaving_certificate_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{leaving_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Leaving / Bonofied Certificate Form
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_election_card_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aadhar_card_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Aadhar Card
                        </a>
                        {{/if}}
                        {{#if show_father_election_card_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{father_election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_aadhar_card_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{father_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father Aadhar Card
                        </a>
                        {{/if}}
                        {{#if show_mother_election_card_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{mother_election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_mother_aadhar_card_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{mother_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother Aadhar Card
                        </a>
                        {{/if}}
                        {{#if show_parents_aadhar_card_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{parents_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father / Mother / Guardian Aadhar Card
                        </a>
                        {{/if}}
                        {{#if show_community_certificate_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{community_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Community Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_community_certificate_doc}}
                        <a target="_blank" href="{{CASTE_CERTIFICATE_DOC_PATH}}{{father_community_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father Community Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_declaration_btn}}
                        <button type="button" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1"
                                onclick='CasteCertificate.listview.downloadDeclaration();'>
                            <i class="fas fa-download"></i> &nbsp; Declaration
                        </button>
                        {{/if}}

                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <form target="_blank" id="cc_declaration_pdf" action="caste_certificate/download_cc_declaration" method="post">
        <input type="hidden" id="caste_certificate_id_for_cc_declaration" name="caste_certificate_id_for_cc_declaration" value="{{caste_certificate_id}}">
    </form>
    <div class="f-w-b text-center f-s-18px"><span class="b-b-1px">DECLARATION</span></div>
    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        &nbsp;&nbsp;&nbsp;
        <!-- I the undersigned Shri / Smt. / Kum. <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_name}}&nbsp;&nbsp;</span> aged about <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_age}}&nbsp;&nbsp;&nbsp;</span>,Years,  -->
        I the undersigned Shri / Smt. / Kum. <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_name}}&nbsp;&nbsp;</span>
        {{#if show_gaudian_data}}
         aged
         {{else}}
         aged about <span class="b-b-1px f-w-b t-d-u">&nbsp;&nbsp;&nbsp;{{applicant_age}}&nbsp;&nbsp;&nbsp;</span>Years.
         {{/if}}
        {{#if show_marital_status}}, Marital Status <span class="b-b-1px f-w-b"> {{marital_status_text}}</span> {{/if}} resident of :-<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{com_addr_house_no}}&nbsp;&nbsp;&nbsp;,&nbsp;{{com_addr_house_name}}&nbsp;{{com_addr_street}},&nbsp;</span>&nbsp;<span class="b-b-1px f-w-b">{{com_addr_village_dmc_ward}}</span>,&nbsp;<span class="b-b-1px f-w-b">{{com_addr_city}}</span>,&nbsp;<span class="b-b-1px f-w-b">{{com_pincode}}</span>&nbsp;of {{district_text}} District. {{#if show_minor_child_name}}, That I am applied for my Minor Child <span class="b-b-1px f-w-b">{{minor_child_name}} {{/if}}</span></br>

        1. {{#if show_applicant_name}} That my name is <span class="b-b-1px f-w-b">{{applicant_name}}</span>{{/if}} {{#if show_minor_child_name}} That my Child name is <span class="b-b-1px f-w-b"> {{minor_child_name}}</span> {{/if}} <br/>

        2.   That I was born at Village <span class="b-b-1px f-w-b">{{born_place_village_text}}</span>,&nbsp; District&nbsp;<span class="b-b-1px f-w-b">{{born_place_district_text}}</span>,&nbsp; State &nbsp;<span class="b-b-1px f-w-b">{{born_place_state_text}}</span>&nbsp;on&nbsp;<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_dob_text}}&nbsp;&nbsp;&nbsp;</span>and permanent resident at <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{per_addr_house_no}}&nbsp;&nbsp;&nbsp;,&nbsp;{{per_addr_house_name}}&nbsp;{{per_addr_street}},&nbsp;</span>,&nbsp;<span class="b-b-1px f-w-b">{{per_addr_village_dmc_ward}}</span>,&nbsp;<span class="b-b-1px f-w-b">{{per_addr_city}}</span>,&nbsp;<span class="b-b-1px f-w-b">{{per_pincode}}</span>&nbsp;Since.</br>

        3. That my Original Native is Village &nbsp;<span class="b-b-1px f-w-b">{{native_place_village_text}}</span>,&nbsp; District&nbsp;<span class="b-b-1px f-w-b">{{native_place_district_text}}</span>,&nbsp; State &nbsp;<span class="b-b-1px f-w-b">{{native_place_state_text}}</span> <br/>

        4.  That I am <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_nationality}}&nbsp;&nbsp;&nbsp;</span>That I am belongs to <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{apllicant_subcaste_text}}&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;Caste and Religion<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_religion}}</span>.</br>

        5.  {{#if show_election}} That I am holding Electoral Card i.e. PJG No.<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{election_no}}&nbsp;&nbsp;&nbsp;</span>{{/if}} & Aadhar Card No.<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{aadhaar}}&nbsp;&nbsp;&nbsp;</span>.</br>

        6.  That I was studied in the School / College / Education <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_education}}&nbsp;&nbsp;&nbsp;</span>at {{district_text}} District.</br>

        7.  That my profession is<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{occupation_text}}&nbsp;&nbsp;&nbsp;</span>.</br>

        8.  That my Father name is <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_name}}&nbsp;&nbsp;
            &nbsp;</span>.</br>
        He was born at Village <span class="b-b-1px f-w-b">{{father_born_place_village_text}}</span>, District <span class="b-b-1px f-w-b">{{father_born_place_district_text}}</span>, State <span class="b-b-1px f-w-b">{{father_born_place_state_text}}</span>,&nbsp;Since.</br>

        9.   His Original Native is Village <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_native_place_village_text}}&nbsp;&nbsp;&nbsp;</span>District<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_native_place_district_text}}&nbsp;&nbsp;&nbsp;</span>City<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_city_text}}&nbsp;&nbsp;&nbsp;</span>.</br>

        10. He is<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_nationality}}&nbsp;&nbsp;&nbsp;</span>National. {{#if show_father_alive}} He is holding Election Card No. <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_election_no}}&nbsp;&nbsp;&nbsp;</span>& Aadhar Card No.<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_aadhaar}}&nbsp;&nbsp;&nbsp;</span>of {{district_text}} District. That his profession is<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_occupation_text}}&nbsp;&nbsp;&nbsp;</span>and {{/if}} he is belongs to <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_subcaste_text}}</span>&nbsp;&nbsp;&nbsp;Caste and Religion<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_religion_text}}</span>.</br>

        11.  That my Mother name is <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{mother_name}}&nbsp;&nbsp;
            &nbsp;</span>.</br>
        She was born at Village <span class="b-b-1px f-w-b">{{mother_born_place_village_text}}</span>, District <span class="b-b-1px f-w-b">{{mother_born_place_district_text}}</span>, State <span class="b-b-1px f-w-b">{{mother_born_place_state_text}}</span>&nbsp;Since.</br>

        12. She is  Original Native of Village <span class="b-b-1px f-w-b">{{mother_native_place_village_text}}</span>, District <span class="b-b-1px f-w-b">{{mother_native_place_district_text}}</span>, State <span class="b-b-1px f-w-b">{{mother_native_place_state_text}}</span>.</br>

        13. She is<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{mother_nationality}}&nbsp;&nbsp;&nbsp;</span>National.{{#if show_mother_alive}} She is holding Election Card No. <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{mother_election_no}}&nbsp;&nbsp;&nbsp;</span>& Aadhar Card No.<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{mother_aadhaar}}&nbsp;&nbsp;&nbsp;</span>of {{district_text}} District. That his profession is<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{mother_occupation_text}}&nbsp;&nbsp;&nbsp;</span>and {{/if}} she is belongs to <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{mother_subcaste_text}}</span>&nbsp;&nbsp;&nbsp;Caste and Religion<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{mother_religion_text}}</span>.</br>

        14.  That my Grandfather name is <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_name}}&nbsp;&nbsp;
            &nbsp;</span>.</br>
        He was born at Village <span class="b-b-1px f-w-b">{{grandfather_born_place_village_text}}</span>, District <span class="b-b-1px f-w-b">{{grandfather_born_place_district_text}}</span>, State <span class="b-b-1px f-w-b">{{grandfather_born_place_state_text}}</span>,&nbsp;Since.</br>

        15.   His Original Native is Village <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_native_place_village_text}}&nbsp;&nbsp;&nbsp;</span>District<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_native_place_district_text}}&nbsp;&nbsp;&nbsp;</span>City<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_city_text}}&nbsp;&nbsp;&nbsp;</span>.</br>

        16. He is<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_nationality}}&nbsp;&nbsp;&nbsp;</span>National.{{#if show_grandfather_alive}} He is holding Election Card No. <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_election_no}}&nbsp;&nbsp;&nbsp;</span>& Aadhar Card No.<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_aadhaar}}&nbsp;&nbsp;&nbsp;</span>of {{district_text}} District. That his profession is<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_occupation_text}}&nbsp;&nbsp;&nbsp;</span>and {{/if}} he is belongs to <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_subcaste_text}}</span>&nbsp;&nbsp;&nbsp;Caste and Religion<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{grandfather_religion_text}}</span>.</br>

        17. That myself and my parents / my family are ordinarily resident of <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{village_name_text}}&nbsp;&nbsp;&nbsp;</span>of Taluka <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{district_text}}&nbsp;&nbsp;&nbsp;</span>of District in section 20 of the representation of the people Act,1950.</br>

        18. Except above resident, we do not have own any other permanent residential address anywhere in India.</br>

        19. That I did not applied for a Certificate of Caste here before.</br>

        20. That the Cast Certificate is required for <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{purpose_of_caste_certificate}}&nbsp;&nbsp;&nbsp;</span>Purpose.</br>

        &nbsp;&nbsp;&nbsp;I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein. I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the punishment as per the law and that the benefits availed by me shall be summarily withdrawn”. </br>


        &nbsp;&nbsp;&nbsp;This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian Penal Code which state as follows:-</br>

        &nbsp;&nbsp;&nbsp;<b>Section 199</b>. False statement made in declaration which is by law receivable as evidence:- Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or any Public Servant or other person, is bound or authorized by law to receive as evidence of any fact, makes any statement which is false, and which he either knows or believes to be false or does not believe to be true, touching any point material to the object for which the declaration is made or used, shall be punished in the same manner as if he gave false evidence.</br>

        &nbsp;&nbsp;&nbsp;<b>Section 200</b>. Using as true such declaration knowing it to be false:-Whoever corruptly uses or attempts to use as true any such declaration, knowing the same to be false in any material point, shall be punished in the same manner as if he gave false evidence.</br>

        &nbsp;&nbsp;&nbsp;Explanation: A declaration which is inadmissible merely upon the ground of some informality is a declaration within the meaning of Sections 199 and 200.

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
                <input type="checkbox" id="declaration_for_caste_certificate"> 
                I, hereby accept the declaration.
            </label>
        </div>
        <span class="error-message error-message-caste-certificate-declaration_for_caste_certificate"></span>
    </div>
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_ccview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    {{#if show_submit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="fsubmit_btn_for_caste_certificate"
            onclick="CasteCertificate.listview.submitCasteCertificate({{VALUE_THREE}});">Submit Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>