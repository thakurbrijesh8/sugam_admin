<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">{{title}} Domicile Certificate Form</h3>
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
                <td class="f-w-b t-d-w">Application Number</td>
                <td>{{application_number}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Application Type</td>
                <td>{{application_type_text}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">{{application_type_title}}</td>
                <td>{{name_of_applicant}}</td>
            </tr>
            {{#if show_gaudian_data }}
            <tr>
                <td class="f-w-b">Relationship of Applicant</td>
                <td>{{relationship_of_applicant}}</td>
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
                <td class="f-w-b">Name of Minor Child</td>
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
            {{#if show_constitution_artical_detail}}
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
            {{/if}}
            <tr>
                <td class="f-w-b">Mobile Number / Aadhaar Number {{#if showInfo }} / Election Number {{/if}}</td>
                <td>{{mobile_number}}  / {{aadhaar}} {{#if showInfo }} / {{election_no}} {{/if}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Gender / Date of Birth / Age <br> Birth Place <br> Native Place</td>
                <td>
                    {{gender_text}} /{{applicant_dob_text}} / {{applicant_age}} Years <br>{{born_place_state_text}} , {{born_place_district_text}} , {{born_place_village_text}} <br>{{native_place_state_text}} , {{native_place_district_text}} , {{native_place_village_text}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">Marital Status</td>
                <td>{{marital_status_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Nationality</td>
                <td style="vertical-align: top;">{{applicant_nationality}}</td>
            </tr>
            {{#if showInfo }}
            <tr>
                <td class="f-w-b">Occupation</td>
                <td>{{occupation_text}}</td>
            </tr>
            {{/if}}
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
            <tr>
                <td class="f-w-b">Nearest Police Station / Nearest Post Office</td>
                <td>{{nearest_police_station}} / {{nearest_post_office}}</td>
            </tr>
        </table>
        {{#if show_education_tbl}}
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Applicant Education</b>
            <table class="table table-bordered table-padding bg-beige">
                <thead>
                    <tr>
                        <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Name of School / Institute</td>
                        <td class="f-w-b text-center bg-beige" style="width: 60px;">Class / Standard</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Date of Admission</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Date of Leaving School</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Total Period</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Remarks</td>
                    </tr>
                </thead>
                <tbody id="education_container_for_dcview"></tbody>
            </table>
        </div>
        <div style="margin-top: 5px;">
            <table class="table table-bordered table-padding bg-beige">
                <thead>
                    <tr>
                        <td class="f-w-b text-right bg-beige" style="width: 60px;" colspan="4">Grand Total</td>
                        <td class="f-w-b text-center bg-beige" style="width: 150px;">{{total_period}}</td>
                    </tr>
                </thead>
            </table>
        </div>
        {{/if}}
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
                    <td>{{father_born_place_state_text}} , {{father_born_place_district_text}} , {{father_born_place_village_text}} , {{father_born_pincode}}
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Original Native Of</td>
                    <td>
                        {{father_native_place_state_text}} , {{father_native_place_district_text}} , {{father_native_place_village_text}} , {{father_native_pincode}}
                    </td>
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
                        {{mother_born_place_state_text}} , {{mother_born_place_district_text}} , {{mother_born_place_village_text}} , {{mother_born_pincode}}
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Original Native Of</td>
                    <td>
                        {{mother_native_place_state_text}} , {{mother_native_place_district_text}} , {{mother_native_place_village_text}} , {{mother_native_pincode}}
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
                        {{spouse_born_place_state_text}} , {{spouse_born_place_district_text}} , {{spouse_born_place_village_text}} , {{spouse_born_pincode}}
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Original Native Of</td>
                    <td>
                        {{spouse_native_place_state_text}} , {{spouse_native_place_district_text}} , {{spouse_native_place_village_text}} , {{spouse_native_pincode}}
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
            </table>
        </div>
        {{/if}}

        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 50%;">The Year from which he/she is residing in the U.T. Of Daman & Diu</td>
                <td style="vertical-align: top;">{{residing_year}} {{resident_total_period}}</td>
            </tr>
            <tr>
                <td class="f-w-b" style="width: 50%;">For What Purpose is the Certificate of Income Required</td>
                <td style="vertical-align: top;">{{required_purpose}}</td>
            </tr>
        </table>
        {{#if show_school_data}}
            <!-- <tr>
                <td class="f-w-b" style="width: 50%;">If Student, the place of study during the last 10 years (Name of school)</td>
                <td style="vertical-align: top;">{{name_of_school}}</td>
            </tr> -->

        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Residential details of last 10 year in the U.T. Of Daman & Diu</b>
            <table class="table table-bordered table-padding bg-beige">
                <thead>
                    <tr>
                        <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Details / Address of Residential Place</td>
                        <td class="f-w-b text-center bg-beige" style="width: 60px;">Type of Resident</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Date of Resident</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Date of Leaving</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Total Period</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Remarks</td>
                    </tr>
                </thead>
                <tbody id="residential_container_for_dcview"></tbody>
            </table>
        </div>
        <div style="margin-top: 5px;">
            <table class="table table-bordered table-padding bg-beige">
                <thead>
                    <tr>
                        <td class="f-w-b text-right bg-beige" style="width: 60px;" colspan="4">Total Period of Resident</td>
                        <td class="f-w-b text-center bg-beige" style="width: 150px;">{{resident_total_period}}</td>
                    </tr>
                </thead>
            </table>
        </div>
        {{/if}}
        {{#if show_business_data}}
            <!-- <tr>
                <td class="f-w-b" style="width: 50%;">If in business, the place of business during the last 10 years</td>
                <td style="vertical-align: top;">{{place_of_business}}</td>
            </tr>
            <tr>
                <td class="f-w-b" style="width: 50%;">If employed, where employed during the last 10 years</td>
                <td style="vertical-align: top;">{{employed_during_years}}</td>
            </tr> -->
        {{#if show_business_tbl}}
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">If in business, the place of business during the last 10 years</b>
            <table class="table table-bordered table-padding bg-beige">
                <thead>
                    <tr>
                        <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Name of Business</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Address of Business</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Type of Business</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Start of Business</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">End of Business</td>
                        <td class="f-w-b text-center bg-beige" style="width: 50px;">Total Period</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Remarks</td>
                    </tr>
                </thead>
                <tbody id="business_container_for_dcview"></tbody>
            </table>
        </div>
        <div style="margin-top: 5px;">
            <table class="table table-bordered table-padding bg-beige">
                <thead>
                    <tr>
                        <td class="f-w-b text-right bg-beige" style="width: 60px;" colspan="4">Total Period of Business</td>
                        <td class="f-w-b text-center bg-beige" style="width: 150px;">{{business_total_period}}</td>
                    </tr>
                </thead>
            </table>
        </div>
        {{/if}}

        {{#if show_service_tbl}}
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">If employed, where employed during the last 10 years</b>
            <table class="table table-bordered table-padding bg-beige">
                <thead>
                    <tr>
                        <td class="f-w-b text-center bg-beige" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Name of Company / Firm / Shop / Employer</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Address</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Date of Joining</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Date of reliving</td>
                        <td class="f-w-b text-center bg-beige" style="width: 50px;">Total Period</td>
                        <td class="f-w-b text-center bg-beige" style="width: 250px;">Remarks</td>
                    </tr>
                </thead>
                <tbody id="service_container_for_dcview"></tbody>
            </table>
        </div>
        <div style="margin-top: 5px;">
            <table class="table table-bordered table-padding bg-beige">
                <thead>
                    <tr>
                        <td class="f-w-b text-right bg-beige" style="width: 60px;" colspan="4">Total Period of Service</td>
                        <td class="f-w-b text-center bg-beige" style="width: 150px;">{{service_total_period}}</td>
                    </tr>
                </thead>
            </table>
        </div>
        {{/if}}
        {{/if}}
        </table>
    </div>
    <div class="f-w-b f-s-16px">Enclosed as below :-</div>
    <div class="table-responsive">
        <table class="table mb-0">
            <tr>
                {{#if show_applicant_photo_doc}}
                <td style="width: 180px;">
                    <img style="border: 2px solid blue; width: 160px; height: 180px;"
                         src="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{applicant_photo}}">
                </td>
                {{/if}}
                {{#if show_minor_child_photo_doc}}
                <td style="width: 180px;">
                    <img style="border: 2px solid blue; width: 160px; height: 180px;"
                         src="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{minor_child_photo}}">
                </td>
                {{/if}}
                <td>
                    <div>
                        {{#if show_birth_leaving_certy_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{birth_certi}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aadhar_card_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{aadhaar_card}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Aadhaar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_election_card_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{election_card}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_leaving_certi_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{leaving_certi}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Leaving Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_birth_certificate_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{father_birth_certificate}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father's Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_election_card_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{father_election_card}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father's Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_aadhar_card_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{father_aadhar_card}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father's Aadhar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_death_proof_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{father_death_proof}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father's Death Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_mother_birth_certificate_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{mother_birth_certificate}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother's Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_mother_election_card_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{mother_election_card}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother's Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_mother_aadhar_card_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{mother_aadhar_card}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother's Aadhar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_mother_death_proof_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{mother_death_proof}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother's Death Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_spouse_birth_certificate_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{spouse_birth_certificate}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Spouse's Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_spouse_election_card_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{spouse_election_card}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Spouse's Election Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_spouse_aadhar_card_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{spouse_aadhar_card}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Spouse's Aadhar Card
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_spouse_death_proof_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{spouse_death_proof}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Spouse's Death Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_gas_book_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{gas_book}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Gas Book
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_bank_book_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{bank_book}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Bank Book
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_mother_bank_book_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{mother_bank_book}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother Bank Book
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_minor_child_bank_book_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{minor_child_bank_book}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Minor Child Bank Book
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_noc_with_notary_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{noc_with_notary}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Rent House NOC
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aggriment_with_notary_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{aggriment_with_notary}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Aggriment With Notary
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_house_tax_receipt_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{house_tax_receipt}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; House Tax Receipts
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_sale_deed_copy_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{sale_deed_copy}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Sale Deed Copy
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_last_10year_proof_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{last_10year_proof}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp;  Last 10 years proof documents  
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_other_document_doc}}
                        <a target="_blank" href="{{DOMICILE_CERTIFICATE_DOC_PATH}}{{other_document}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Other Documents
                            </label>
                        </a>
                        {{/if}}
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <form target="_blank" id="dc_declaration_pdf" action="domicile/download_dc_declaration" method="post">
        <input type="hidden" id="domicile_certificate_id_for_dc_declaration" name="domicile_certificate_id_for_dc_declaration" value="{{domicile_certificate_id}}">
    </form>
    <div class="f-w-b text-center f-s-18px"><span class="b-b-1px">DECLARATION</span></div>
    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            I <span class="b-b-1px f-w-b">{{name_of_applicant}}</span>
            {{#if show_spouse_name}}
                Spouse of Shri <span class="b-b-1px f-w-b">{{spouse_name}}</span>,
            {{/if}}
            {{#if show_father_name}}
                Son/Daughter of Shri <span class="b-b-1px f-w-b">{{father_name}}</span>,
            {{/if}}
            {{#if showMinorInfo}}
                Aged, 
            {{/if}}
            {{#if showInfo }}
                Age <span class="b-b-1px f-w-b">{{applicant_age}}</span>,
                Years, Marital Status :- <span class="b-b-1px f-w-b">{{marital_status_text}}</span>,
            {{/if}}
            Resident of <span class="b-b-1px f-w-b">{{com_addr_house_no}},  {{com_addr_house_name}}  
                {{com_addr_street}},  {{com_addr_village_dmc_ward}}, {{com_addr_city}}, {{com_pincode}}</span>,
            {{taluka_name}} District of U.T. DNH & Daman & Diu,
            {{#if showMinorInfo}}
                for my minor child <span class="b-b-1px f-w-b">{{minor_child_name}}</span>
            {{/if}}
    </div>
    <div style="margin-top: 10px; text-align: justify; text-justify: inter-word; font-weight: bold; text-decoration: underline">
        That my family details are as under :-
    </div>
    {{#if showInfo }}
    <div style="margin-top: 10px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That my name is <span class="b-b-1px f-w-b t-d-u">{{name_of_applicant}}</span>, <br/>
        <span class="declaration-numbering"></span> That I was born at &nbsp; <span class="b-b-1px f-w-b t-d-u">{{born_place_village_text}}</span>, &nbsp; District :- <span class="b-b-1px f-w-b t-d-u">{{born_place_district_text}}</span>, &nbsp; State :- <span class="b-b-1px f-w-b t-d-u">{{born_place_state_text}}</span> <br/>
        <span class="declaration-numbering"></span> That I am original from &nbsp; <span class="b-b-1px f-w-b t-d-u">{{native_place_village_text}}</span>, &nbsp; District :- <span class="b-b-1px f-w-b t-d-u">{{native_place_district_text}}</span>, &nbsp; State :- <span class="b-b-1px f-w-b t-d-u">{{native_place_state_text}}</span><br/>
        <span class="declaration-numbering"></span> That I am presently resident at <span class="b-b-1px f-w-b t-d-u"> {{com_addr_house_no}},  {{com_addr_house_name}}  {{com_addr_street}},  {{com_addr_village_dmc_ward}}, {{com_addr_city}}, {{com_pincode}} </span>.<br>
        <span class="declaration-numbering"></span> That I am an <span class="b-b-1px f-w-b t-d-u">{{applicant_nationality}}</span> National.<br>
        <span class="declaration-numbering"></span> That My Election Card No. is <span class="b-b-1px f-w-b t-d-u" style="text-decoration: underline;"> {{election_no}} </span> <br/>
        <span class="declaration-numbering"></span> That my profession is <span class="b-b-1px f-w-b t-d-u">{{applicant_occupation_text}}</span>,<br>
        <span class="declaration-numbering"></span> That I am residing Since <span class="b-b-1px f-w-b t-d-u">{{residing_year}}{{resident_total_period}}</span> in  {{taluka_name}} District.
    </div>
    {{#if show_father_mother_info}}
    <div class="l-s" style="margin-top: 15px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That my father name is <span class="b-b-1px f-w-b t-d-u">{{father_name}}</span>, <br/>
        <span class="declaration-numbering"></span> That he is original from &nbsp; <span class="b-b-1px f-w-b t-d-u">{{father_native_place_village_text}}</span>, &nbsp; District :- <span class="b-b-1px f-w-b t-d-u">{{father_native_place_district_text}}</span>, &nbsp; State :- <span class="b-b-1px f-w-b t-d-u">{{father_native_place_state_text}}</span><br/>
        <span class="declaration-numbering"></span> That his Election Card No. is <span class="b-b-1px f-w-b t-d-u"> {{father_election_no}} </span><br>
        <span class="declaration-numbering"></span> That his profession is <span class="b-b-1px f-w-b t-d-u">{{father_occupation_text}}</span>,
    </div>
    <div class="l-s" style="margin-top: 15px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That my mother name is <span class="b-b-1px f-w-b t-d-u">{{mother_name}}</span>, <br/>
        <span class="declaration-numbering"></span> That she is original from &nbsp; <span class="b-b-1px f-w-b t-d-u">{{mother_native_place_village_text}}</span>, &nbsp; District :- <span class="b-b-1px f-w-b t-d-u">{{mother_native_place_district_text}}</span>, &nbsp; State :- <span class="b-b-1px f-w-b t-d-u">{{mother_native_place_state_text}}</span><br/>
        <span class="declaration-numbering"></span> That her Election Card No. is <span class="b-b-1px f-w-b t-d-u"> {{mother_election_no}}</span><br>
        <span class="declaration-numbering"></span> That her profession is <span class="b-b-1px f-w-b t-d-u">{{mother_occupation_text}}</span>,
    </div>
    {{/if}}
    {{/if}}
    {{#if showMinorInfo}}
        <div style="margin-top: 10px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That minor child name is <span class="b-b-1px f-w-b t-d-u">{{minor_child_name}}</span>, <br/>
        <span class="declaration-numbering"></span> That minor child was born at &nbsp; <span class="b-b-1px f-w-b t-d-u">{{born_place_village_text}}</span>, &nbsp; District :- <span class="b-b-1px f-w-b t-d-u">{{born_place_district_text}}</span>, &nbsp; State :- <span class="b-b-1px f-w-b t-d-u">{{born_place_state_text}}</span> <br/>
        <span class="declaration-numbering"></span> That minor child original from &nbsp; <span class="b-b-1px f-w-b t-d-u">{{native_place_village_text}}</span>, &nbsp; District :- <span class="b-b-1px f-w-b t-d-u">{{native_place_district_text}}</span>, &nbsp; State :- <span class="b-b-1px f-w-b t-d-u">{{native_place_state_text}}</span><br/>
        <span class="declaration-numbering"></span> That minor child presently resident at <span class="b-b-1px f-w-b t-d-u"> {{com_addr_house_no}},  {{com_addr_house_name}}  {{com_addr_street}},  {{com_addr_village_dmc_ward}}, {{com_addr_city}}, {{com_pincode}} </span>.<br>
        <span class="declaration-numbering"></span> That minor child <span class="b-b-1px f-w-b t-d-u">{{applicant_nationality}}</span> National.<br>
        <span class="declaration-numbering"></span> That minor child residing Since <span class="b-b-1px f-w-b t-d-u">{{residing_year}}{{resident_total_period}}</span> in  {{taluka_name}} District.
    </div>
    {{#if show_father_mother_info}}
    <div class="l-s" style="margin-top: 15px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That minor child father name is <span class="b-b-1px f-w-b t-d-u">{{father_name}}</span>, <br/>
        <span class="declaration-numbering"></span> That minor child's father is original from &nbsp; <span class="b-b-1px f-w-b t-d-u">{{father_native_place_village_text}}</span>, &nbsp; District :- <span class="b-b-1px f-w-b t-d-u">{{father_native_place_district_text}}</span>, &nbsp; State :- <span class="b-b-1px f-w-b t-d-u">{{father_native_place_state_text}}</span><br/>
        <span class="declaration-numbering"></span> That minor child's father Election Card No. is <span class="b-b-1px f-w-b t-d-u"> {{father_election_no}} </span><br>
        <span class="declaration-numbering"></span> That minor child's father profession is <span class="b-b-1px f-w-b t-d-u">{{father_occupation_text}}</span>,
    </div>
    <div class="l-s" style="margin-top: 15px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That minor child mother name is <span class="b-b-1px f-w-b t-d-u">{{mother_name}}</span>, <br/>
        <span class="declaration-numbering"></span> That minor child's mother is original from &nbsp; <span class="b-b-1px f-w-b t-d-u">{{mother_native_place_village_text}}</span>, &nbsp; District :- <span class="b-b-1px f-w-b t-d-u">{{mother_native_place_district_text}}</span>, &nbsp; State :- <span class="b-b-1px f-w-b t-d-u">{{mother_native_place_state_text}}</span><br/>
        <span class="declaration-numbering"></span> That minor child's mother Election Card No. is <span class="b-b-1px f-w-b t-d-u"> {{mother_election_no}}</span><br>
        <span class="declaration-numbering"></span> That minor child's mother profession is <span class="b-b-1px f-w-b t-d-u">{{mother_occupation_text}}</span>,
    </div>
    {{/if}}
    {{/if}}
    {{#if show_spouse}}
    <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That my spouse name is <span class="b-b-1px f-w-b t-d-u">{{spouse_name}}</span>, <br/>
        <span class="declaration-numbering"></span> That he / she is original from &nbsp; <span class="b-b-1px f-w-b t-d-u">{{spouse_native_place_village_text}}</span>, &nbsp; District :- <span class="b-b-1px f-w-b t-d-u">{{spouse_native_place_district_text}}</span>, &nbsp; State :- <span class="b-b-1px f-w-b t-d-u">{{spouse_native_place_state_text}}</span><br/>
        <span class="declaration-numbering"></span> That his / her Election Card No. is <span class="b-b-1px f-w-b t-d-u"> {{spouse_election_no}}</span><br>
        <span class="declaration-numbering"></span> That his / her profession is <span class="b-b-1px f-w-b t-d-u">{{spouse_occupation_text}}</span>,
    </div>
    {{/if}}
    <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That {{#if showInfo }} I am {{/if}} {{#if showMinorInfo}} minor child {{/if}} Domiciled in {{taluka_name}} of {{taluka_name}} District of U.T. DNH & Daman & Diu.
    </div>
    <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That my parents are residence since <span class="b-b-1px f-w-b">{{residing_year}}{{resident_total_period}}</span> in the {{taluka_name}} District and they are also domiciled in {{taluka_name}} of {{taluka_name}} District of U.T. DNH & Daman & Diu.
    </div>
    <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That myself and my parents/my family are ordinarily resident of  <span class="b-b-1px f-w-b"> {{com_addr_house_no}},  {{com_addr_house_name}} {{com_addr_street}},  {{com_addr_street}},  {{com_addr_village_dmc_ward}},  {{com_addr_city}}, {{com_pincode}} </span> of Taluka {{taluka_name}} of {{taluka_name}} District in section 20 of the representation of the people Act,1950.
    </div>
    <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> That I am not having OCI, Portuguese Passport or any other country nationality and I was not visited any country since my birth to till date.
    </div>
    <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        <span class="declaration-numbering"></span> This declaration I have to submit before the Mamlatdar, {{taluka_name}} to obtain the Domicile Certificate for <span class="b-b-1px f-w-b">{{required_purpose}}</span> purpose. 
    </div>
    <div class="f-w-b" style="margin-top: 20px; text-align: justify; text-justify: inter-word;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein. I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the punishment as per the law and that the benefits availed by me shall be summarily withdrawn”. 
    </div>
    <div style="margin-top: 10px; text-align: justify; text-justify: inter-word;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian Penal Code which state as follows:-
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
                <input type="checkbox" id="declaration_for_dc"> 
                I, hereby accept the declaration.
            </label>
        </div>
        <span class="error-message error-message-dc-declaration_for_dc"></span>
    </div>
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_dcview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    {{#if show_submit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="fsubmit_btn_for_domicile"
            onclick="Domicile.listview.submitDomicile({{VALUE_THREE}});">Submit Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>
