<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Income & Asset Certificate Form
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-ews-certificate f-w-b"
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
                <td class="f-w-b">Village / DMC Ward / SMC Ward</td>
                <td>{{village_name_text}}</td>
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
            {{#if show_fathername }}
            <tr>
                <td class="f-w-b">Father's / Husband's Name </td>
                <td>{{father_husbund_name}}</td>
            </tr>
            {{/if}}
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
                <td class="f-w-b">Minor child Adhar Number</td>
                <td>{{guardian_aadhaar}}</td>
            </tr>
            {{/if}}
            <tr>
                <td class="f-w-b">Gender / Date of Birth / Age</td>
                <td>{{gender_text}} /{{applicant_dob_text}} / {{applicant_age_text}} Years</td>
            </tr>
            <tr>
                <td class="f-w-b">Birth Place</td>
                <td>{{born_place}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Religion / Caste</td>
                <td>{{applicant_religion}} / {{applicant_caste}} </td>
            </tr>
            {{#if show_applicant_data }}
            <tr>
                <td class="f-w-b">Applicant's Mobile Number</td>
                <td>{{mobile_no}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Pancard Number</td>
                <td>{{pancard}}</td>
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

            {{#if show_adhar }}
            <tr>
                <td class="f-w-b">Applicant's Aadhar Number</td>
                <td>{{aadhaar}}</td>
            </tr>
            {{/if}}

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
                <td class="f-w-b">Original Native Place</td>
                <td>{{per_addr_house_no}},
                    {{per_addr_house_name}},
                    {{per_addr_street}},
                    {{per_addr_village_dmc_ward}},
                    {{per_addr_city}},
                    {{per_pincode}}
                </td>
            </tr>
            <!-- <tr>
                <td class="f-w-b">Places of Stay since Birth</td>
                <td>{{born_place_state_text}} , {{born_place_district_text}} , {{born_place_village_text}}</td>
            </tr> -->
            <tr>
                <td class="f-w-b">Education</td>
                <td>{{applicant_education}}</td>
            </tr>
            <tr>
                <td class="f-w-b">For What Purpose is the Certificate of EWS Required</td>
                <td>{{purpose_of_ews_certificate}}</td>
            </tr>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Places of Stay since Birth</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">State</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">District</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 50px;">Village / Town</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 190px;">Tehsil</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 190px;">Period</td>
                </tr>
            </thead>
            <tbody id="birth_stay_period_info_container_for_view_ews">

            </tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Family Details</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Family Member Detail</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Name</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 50px;">Age</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 190px;">Occupation/Education</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 190px;">Remark</td>
                </tr>
            </thead>
            <tbody id="sibling_info_container_for_view_ews">
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">Father</td>
                    <td class="text-center">{{father_name}}</td>
                    <td class="text-center">{{father_age}}</td>
                    <td class="text-center">{{father_occupation}}</td>
                    <td class="text-center">{{father_remark}}</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td class="text-center">Mother</td>
                    <td class="text-center">{{mother_name}}</td>
                    <td class="text-center">{{mother_age}}</td>
                    <td class="text-center">{{mother_occupation}}</td>
                    <td class="text-center">{{mother_remark}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Details of Income & Asset Certificate/s issued earlier</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Issuing Authority</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Certificate.No.</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 50px;">Issued Date</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Valid up to</td>
                </tr>
            </thead>
            <tbody id="efm_container_for_icview_ews"></tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Gross annual income of the Family</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 30px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 100px;">Source of Income Member</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Salary</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Business</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Agriculture</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Profession</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Other Source</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 30px;">Total Income</td>
                </tr>
            <tbody id="sibling_income_container_for_view_ews">
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-center">Father</td>
                    <td class="text-center">{{father_salary_detail}}</td>
                    <td class="text-center">{{father_business_detail}}</td>
                    <td class="text-center">{{father_agri_detail}}</td>
                    <td class="text-center">{{father_profe_detail}}</td>
                    <td class="text-center">{{father_other_detail}}</td>
                    <td class="text-center">{{father_total_income}}</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td class="text-center">Mother</td>
                    <td class="text-center">{{mother_salary_detail}}</td>
                    <td class="text-center">{{mother_business_detail}}</td>
                    <td class="text-center">{{mother_agri_detail}}</td>
                    <td class="text-center">{{mother_profe_detail}}</td>
                    <td class="text-center">{{mother_other_detail}}</td>
                    <td class="text-center">{{mother_total_income}}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="f-w-b"  colspan="7">Total</td>
                    <td class="text-right f-w-b">{{total_income}}/-</td>
                </tr>
            </tfoot>
            </thead>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Asset Details of the Family</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 30px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 130px;">Asset</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Area (in sq.yd/sq.ft)</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Locationtd</td>
                </tr>
                <tr>
                    <td class="text-center">1</td>
                    <td>Agricultural</td>
                    <td class="text-center">{{agricultural_area}}</td>
                    <td class="text-center">{{agricultural_location}}</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Residental Flat</td>
                    <td class="text-center">{{residental_flat_area}}</td>
                    <td class="text-center">{{residental_flat_location}}</td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Residental plot in urban areas i.e.notified Municipality/Municipal Corporation/Municipality etc.anywhere in the Country</td>
                    <td class="text-center">{{residental_plot_urban_area}}</td>
                    <td class="text-center">{{residental_plot_urban_location}}</td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>Residential plot in areas other than the urban areas i.e.Rural Areas anywhere in the Country</td>
                    <td class="text-center">{{residental_plot_rural_area}}</td>
                    <td class="text-center">{{residental_plot_rural_location}}</td>
                </tr>

            </thead>
        </table>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Whether the caste/ sub-caste is included in SCs/ STs/ OBCs (Central/ UT/ States List) List notified for reservation in any of States/ UTs/ CentralGovt.</td>
                <td>{{list_text}}</td>
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
                         src="{{EWS_CERTIFICATE_DOC_PATH}}{{applicant_photo_doc}}">
                </td>
                {{/if}}
                {{#if show_minor_child_photo}}
                <td style="width: 180px;">
                    <img style="border: 2px solid blue; width: 160px; height: 180px;"
                         src="{{EWS_CERTIFICATE_DOC_PATH}}{{minor_child_photo}}">
                </td>
                {{/if}}
                <td>
                    <div>
                        {{#if show_birth_certificate_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{birth_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_leaving_certificate_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{leaving_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Leaving Certificate / Bonofied Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_election_card_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_election_card_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{father_election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_mother_election_card_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{mother_election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aadhar_card_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father / Mother / Guardian Aadhaar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_aadhar_card_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{father_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father Aadhaar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_mother_aadhar_card_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{mother_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother Aadhaar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_child_aadhar_card_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{child_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Minor Child Aadhaar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_community_certificate_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{community_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Community certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_mother_community_certificate_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{father_mother_community_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father / Mother Community certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_caste_certificate_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{caste_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Caste Certificate
                        </a>
                        {{/if}}
                        {{#if show_father_mother_caste_certificate_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{father_mother_caste_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father / Mother Caste Certificate
                        </a>
                        {{/if}}
                        {{#if show_affidativet_immovable_property_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{affidativet_immovable_property_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Notarized Affidavit
                        </a>
                        {{/if}}
                        {{#if show_gazeted_copy_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{gazeted_copy_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Gazette Copy
                        </a>
                        {{/if}}
                        {{#if show_agricultural_detail_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{agricultural_detail_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Agricultural property
                        </a>
                        {{/if}}
                        {{#if show_domicile_certificate_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{domicile_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Domicile Certificate
                        </a>
                        {{/if}}
                        {{#if show_father_mother_domicile_certificate_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{father_mother_domicile_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father / Mother Domicile Certificate
                        </a>
                        {{/if}}
                        {{#if show_incometax_return_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{incometax_return_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Income Tax Return
                        </a>
                        {{/if}}
                        {{#if show_noc_with_notary_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{noc_with_notary}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Rent House NOC With Notary
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aggriment_with_notary_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{aggriment_with_notary}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Aggriment With Notary
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_house_tax_receipt_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{house_tax_receipt}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; House Tax Receipts
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_sale_deed_copy_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{sale_deed_copy}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Sale Deed Copy
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_other_doc}}
                        <a target="_blank" href="{{EWS_CERTIFICATE_DOC_PATH}}{{other_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Other Documents
                        </a>
                        {{/if}}

                        {{#if show_declaration_btn}}
                        <button type="button" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1"
                                onclick='EwsCertificate.listview.downloadDeclaration();'>
                            <i class="fas fa-download"></i> &nbsp; Declaration
                        </button>
                        {{/if}}

                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <form target="_blank" id="ec_declaration_pdf" action="ews_certificate/download_ec_declaration" method="post">
        <input type="hidden" id="ews_certificate_id_for_ec_declaration" name="ews_certificate_id_for_ec_declaration" value="{{ews_certificate_id}}">
    </form>
    <div class="f-w-b text-center f-s-18px"><span class="b-b-1px">DECLARATION</span></div>
    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        &nbsp;&nbsp;&nbsp;I Shri/Miss/Mrs <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_name}}&nbsp;&nbsp;</span>{{#if show_fathername}} Son of / daughter of / wife of <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{father_husbund_name}}&nbsp;&nbsp;&nbsp;</span>{{/if}} age <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_age}}&nbsp;&nbsp;&nbsp;</span> of ,&nbsp;<span class="b-b-1px f-w-b">{{born_place_state_text}}</span>,&nbsp;<span class="b-b-1px f-w-b">{{born_place_district_text}}</span>,&nbsp;<span class="b-b-1px f-w-b">{{born_place_village_text}}</span></span>&nbsp;of the Union Territory of Daman & Diu / Dadra & Nagar Haveli, do hereby declare that the information given by me in this application form and its attached enclosures is true to the best of my knowledge and that the information furnished is exhaustive and I have not suppressed any fact. That I am solely responsible for the accuracy of the declaration and information furnished and liable for action under section 199 and 200 of the Indian penal code in case of wrong declaration and information. Also I am well aware of the fact that the certificate shall be summarily cancelled and all the benefits availed by meshall be summarily cancelled and all the benefits availed by me shall be summarily withdrawn incase of wrong declaration and information {{#if show_minor_child_name}}, That I am applied for my Minor Child <span class="b-b-1px f-w-b">{{minor_child_name}} {{/if}} .</span></br>
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
                <input type="checkbox" id="declaration_for_ews_certificate"> 
                I, hereby accept the declaration.
            </label>
        </div>
        <span class="error-message error-message-ews-certificate-declaration_for_ews_certificate"></span>
    </div>
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_ewsview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    {{#if show_submit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="fsubmit_btn_for_ews_certificate"
            onclick="EwsCertificate.listview.submitEwsCertificate({{VALUE_THREE}});">Submit Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>