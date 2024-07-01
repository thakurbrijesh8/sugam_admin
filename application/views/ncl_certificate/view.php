<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} NCL (OBC Renewal) Certificate Form
    </h3>
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
                <td class="f-w-b">Name of Minor Child</td>
                <td>{{minor_child_name}}</td>
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
                <td class="f-w-b">Caste / Religion</td>
                <td>{{applicant_caste_text}} / {{religion}}  {{other_religion_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Aadhaar Number</td>
                <td>{{aadhaar}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Communication Address</td>
                <td>{{com_addr_house_no}}
                    {{com_addr_house_name}}
                    {{com_addr_street}}
                    {{com_addr_village_dmc_ward}}
                    {{com_addr_city}}
                    {{com_pincode}}
                </td>
            </tr>
            <tr>
                <td class="f-w-b">Permanent Address</td>
                <td>{{per_addr_house_no}}
                    {{per_addr_house_name}}
                    {{per_addr_street}}
                    {{per_addr_village_dmc_ward}}
                    {{per_addr_city}}
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
                <td>{{born_place_state_text}} , {{born_place_district_text}} , {{born_place_village_text}} , {{born_place_pincode}}<br/>{{native_place_state_text}} , {{native_place_district_text}} , {{native_place_village_text}} , {{native_place_pincode}}</td> 
            </tr>
            <tr>
                <td class="f-w-b">Applicant Nationality</td>
                <td>{{applicant_nationality}}</td>
            </tr>
            {{#if show_applicant_data }}
            <tr>
                <td class="f-w-b">Applicant Education / Name of School / Collage / Institute</td>
                <td>{{applicant_education}} / {{name_of_school}}</td>
            </tr>
            {{/if}}
            <tr>
                <td class="f-w-b">Nearest Police Station</td>
                <td>{{nearest_police_station_text}}</td>
            </tr>
            {{#if show_applicant_data }}
            <tr>
                <td class="f-w-b">Applicant Occupation</td>
                <td>{{occupation_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Annual Income</td>
                <td>{{annual_income}} /-</td>
            </tr>
            {{/if}}
            <tr>
                <td class="f-w-b">Family Annual Income</td>
                <td>{{family_annual_income}} /-</td>
            </tr>
            {{#if show_applicant_data }}
            <tr>
                <td class="f-w-b">Total Annual Income</td>
                <td>{{total_annual_income}} /-</td>
            </tr>
            {{/if}}
            <tr>
                <td class="f-w-b">Father Name / Occupation</td>
                <td>{{father_name}} / {{father_occupation_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Mother Name / Occupation</td>
                <td>{{mother_name}} / {{mother_occupation_text}}</td>
            </tr>
           <!--  <tr>
                <td class="f-w-b">Grandfather Name / Occupation</td>
                <td>{{grandfather_name}} / {{grandfather_occupation_text}}</td>
            </tr> -->
            {{#if show_spouse}}
            <tr>
                <td class="f-w-b">Spouse Name / Occupation</td>
                <td>{{spouse_name}} / {{spouse_occupation_text}}</td>
            </tr>
            {{/if}}
        </table>
    </div>


    <div style="margin-top: 15px;" class="table-responsive">
        <b style="font-size: 14px;">Members Details</b>
        <table class="table table-bordered table-padding bg-beige">
            <thead>
                <tr>
                    <th class="text-center p-1" style="width: 60px;">Sr.No.</th>
                    <th class="text-center p-1" style="width: 250px;">Source of Income</th>
                    <th class="text-center p-1" style="width: 250px;">Name</th>
                    <th class="text-center p-1" style="width: 250px;">Type of Org. (Govt/Pvt) Profession/Trae/Business/<br>Agriculture</th>
                    <th class="text-center p-1" style="width: 250px;">Name of Organization/ Department</th>
                    <th class="text-center p-1" style="width: 250px;">Designation/Post Held</th>
                    <th class="text-center p-1" style="width: 250px;">Scale of Pay</th>
                    <th class="text-center p-1" style="width: 250px;">Date of Appointment</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Father</td>
                    <td>{{father_name}}</td>
                    <td>{{father_organization_type}}</td>
                    <td>{{father_organization_name}}</td>
                    <td>{{father_designation}}</td>
                    <td>{{father_scale_pay}}</td>
                    <td>{{father_appointment_date}}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mother</td>
                    <td>{{mother_name}}</td>
                    <td>{{mother_organization_type}}</td>
                    <td>{{mother_organization_name}}</td>
                    <td>{{mother_designation}}</td>
                    <td>{{mother_scale_pay}}</td>
                    <td>{{mother_appointment_date}}</td>
                </tr>
                {{#if showSpouseDataForMajor}}
                <tr>
                    <td>3</td>
                    <td>Spouse</td>
                    <td>{{spouse_name}}</td>
                    <td>{{spouse_organization_type}}</td>
                    <td>{{spouse_organization_name}}</td>
                    <td>{{spouse_designation}}</td>
                    <td>{{spouse_scale_pay}}</td>
                    <td>{{spouse_appointment_date}}</td>
                </tr>
                {{/if}}
            </tbody>
        </table>
    </div>

    <div style="margin-top: 15px;" class="table-responsive">
        <b style="font-size: 14px;">Details</b>
        <table class="table table-bordered table-padding bg-beige">
            <thead>
                <tr>
                    <th class="text-center p-1" style="width: 60px;">Sr.No.</th>
                    <th class="text-center p-1" style="width: 250px;">Source of Income</th>
                    <th class="text-center p-1" style="width: 250px;">Occupation</th>
                    <th class="text-center p-1" style="width: 250px;">Gross annual Salary / Amount </th>
                    <th class="text-center p-1" style="width: 250px;">Income from other sources </th>
                    <th class="text-center p-1" style="width: 250px;">Total </th>
                    <th class="text-center p-1" style="width: 250px;">Remarks </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Father</td>
                    <td>{{father_occupation_text}}</td>
                    <td class="t-a-r">{{father_annual_salary}} /-</td>
                    <td class="t-a-r">{{father_other_income_sources}} /-</td>
                    <td class="t-a-r">{{father_total}} /-</td>
                    <td>{{father_remarks}}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mother</td>
                    <td>{{mother_occupation_text}}</td>
                    <td class="t-a-r">{{mother_annual_salary}} /-</td>
                    <td class="t-a-r">{{mother_other_income_sources}} /-</td>
                    <td class="t-a-r">{{mother_total}} /-</td>
                    <td>{{mother_remarks}}</td>
                </tr>
                {{#if showSpouseDataForMajor}}
                <tr>
                    <td>3</td>
                    <td>Spouse</td>
                    <td>{{spouse_occupation_text}}</td>
                    <td class="t-a-r">{{spouse_annual_salary}} /-</td>
                    <td class="t-a-r">{{spouse_other_income_sources}} /-</td>
                    <td class="t-a-r">{{spouse_total}} /-</td>
                    <td>{{spouse_remarks}}</td>
                </tr>
                {{/if}}
            </tbody>
        </table>
    </div>

    <div style="margin-top: 15px;" class="table-responsive">
        <b style="font-size: 14px;">Details</b>
        <table class="table table-bordered table-padding bg-beige">
            <thead>
                <tr>
                    <th class="text-center p-1" style="width: 60px;">Sr.No.</th>
                    <th class="text-center p-1" style="width: 150px;">Relation With Applicant</th>
                    <th class="text-center p-1" style="width: 150px;">Father</th>
                    <th class="text-center p-1" style="width: 150px;">Mother</th>
                    <th class="text-center p-1" style="width: 150px;">Spouse</th>
                    <th class="text-center p-1" style="width: 150px;">Minor Child</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Agriculture land holding</td>
                    <td>{{father_land}}</td>
                    <td>{{mother_land}}</td>
                    <td>{{spouse_land}}</td>
                    <td>{{minorchild_land}}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Location</td>
                    <td>{{father_location}}</td>
                    <td>{{mother_location}}</td>
                    <td>{{spouse_location}}</td>
                    <td>{{minorchild_location}}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Size of holding</td>
                    <td>{{father_sizeofholding}}</td>
                    <td>{{mother_sizeofholding}}</td>
                    <td>{{spouse_sizeofholding}}</td>
                    <td>{{minorchild_sizeofholding}}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Type of irrigated Land</td>
                    <td>{{father_typeofirrigated}}</td>
                    <td>{{mother_typeofirrigated}}</td>
                    <td>{{spouse_typeofirrigated}}</td>
                    <td>{{minorchild_typeofirrigated}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 15px;" class="table-responsive">
        <b style="font-size: 14px;">More Details</b>
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td style="width: 85%;">Percentage of irrigated land holding to statutory ceiling limit under state and ceiling laws</td>
                <td>{{percentageofland}}</td>
            </tr>
            <tr>
                <td style="width: 85%;">If land holding is both irrigated and un-irrigated land holding on the basis of conversion formula in state land ceiling law</td>
                <td>{{landceiling}}</td>
            </tr>
            <tr>
                <td style="width: 85%;">Percentage of total irrigated land holding to statutory ceiling limit as Per(V)</td>
                <td>{{landceilinglimit}}</td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 15px;" class="table-responsive">
        <b style="font-size: 14px;">Plantation</b>
        <table class="table table-bordered table-padding bg-beige">
            <tbody>
                <tr>
                    <td>a</td>
                    <td style="width: 50%;">Crops / Fruit</td>
                    <td style="width: 50%;">{{cropsfruit}}</td>
                </tr>
                <tr>
                    <td>b</td>
                    <td>Location</td>
                    <td>{{location}}</td>
                </tr>
                <tr>
                    <td>c</td>
                    <td>Area of Plantation</td>
                    <td>{{areaofplantation}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 15px;" class="table-responsive">
        <b style="font-size: 14px;">More Details </b>
        <table class="table table-bordered table-padding bg-beige">
            <tbody>
                <tr>
                    <td>a</td>
                    <td style="width: 50%;">Location of Property</td>
                    <td style="width: 50%;">{{locationpoperty}}</td>
                </tr>
                <tr>
                    <td>b</td>
                    <td>Details of Property</td>
                    <td>{{detailproperty}}</td>
                </tr>
                <tr>
                    <td>c</td>
                    <td>Use to which it is put</td>
                    <td>{{usetowhich}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tr>
                <td class="f-w-b" style="width: 40%;">Weather Tax Payer</td>
                <td>{{tax_payer_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Weather covered in wealth Tax Act</td>
                <td>{{wealth_tax_text}}</td>
            </tr>
            <tr>
                <td class="f-w-b"> If so Furnished Details</td>
                <td>{{furnished_detail}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant First OBC Certificate No.</td>
                <td>{{obc_certificate_no}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant First OBC Certificate Date</td>
                <td>{{obc_certificate_date}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Income Certificate No.</td>
                <td>{{income_certificate_no}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Income Certificate Date</td>
                <td>{{income_certificate_date}}</td>
            </tr>
        </table>
    </div>

    <div class="f-w-b f-s-16px">Enclosed as below :-</div>
    <div class="table-responsive">

        <table class="table mb-0">
            <tr>
                {{#if show_parents_photo_doc}}
                <td style="width: 180px;">
                    <img style="border: 2px solid blue; width: 160px; height: 180px;"
                         src="{{NCL_CERTIFICATE_DOC_PATH}}{{parents_photo_doc}}">
                </td>
                {{/if}}
                {{#if show_applicant_photo_doc}}
                <td style="width: 180px;">
                    <img style="border: 2px solid blue; width: 160px; height: 180px;"
                         src="{{NCL_CERTIFICATE_DOC_PATH}}{{applicant_photo_doc}}">
                </td>
                {{/if}}
                <td>
                    <div>
                        {{#if show_tax_payer_copy}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{tax_payer_copy}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Tax Payer Copy  
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_self_birth_certificate_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{self_birth_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Birth Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_leaving_certificate_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{leaving_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Leaving / Bonofied Certificate Form
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_aadhar_card_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Aadhaar Card
                        </a>
                        {{/if}}
                        {{#if show_father_aadhar_card_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{father_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father Aadhaar Card
                        </a>
                        {{/if}}
                        {{#if show_mother_aadhar_card_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{mother_aadhar_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother Aadhaar Card
                        </a>
                        {{/if}}
                        {{#if show_election_card_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Election Card
                        </a>
                        {{/if}}
                        {{#if show_father_election_card_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{father_election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Father Election Card
                        </a>
                        {{/if}}
                        {{#if show_mother_election_card_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{mother_election_card_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Mother Election Card
                        </a>
                        {{/if}}
                        {{#if obc_certificate_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{obc_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; OBC Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_income_certificate}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{income_certificate}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp;Income Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_father_certificate_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{father_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp;Father Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_community_certificate_doc}}
                        <a target="_blank" href="{{NCL_CERTIFICATE_DOC_PATH}}{{community_certificate_doc}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp;Community Certificate
                            </label>
                        </a>
                        {{/if}}
                        {{#if show_declaration_btn}}
                        <button type="button" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1"
                                onclick='NclCertificate.listview.downloadDeclaration();'>
                            <i class="fas fa-download"></i> &nbsp; Declaration
                        </button>
                        {{/if}}
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <form target="_blank" id="nc_declaration_pdf" action="ncl_certificate/download_nc_declaration" method="post">
        <input type="hidden" id="ncl_certificate_id_for_nc_declaration" name="ncl_certificate_id_for_nc_declaration" value="{{ncl_certificate_id}}">
    </form>
    <div class="f-w-b text-center f-s-18px"><span class="b-b-1px">DECLARATION</span></div>
    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
        &nbsp;&nbsp;&nbsp;I, <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_name}},&nbsp;&nbsp;</span>
        {{#if show_gaudian_data}}
        Major age
        {{else}}
        aged about <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_age}}&nbsp;&nbsp;&nbsp;</span> <b> years,</b>
        {{/if}}
        Resident at <span class="b-b-1px f-w-b">{{com_addr_house_no}},&nbsp;&nbsp;{{com_addr_house_name_text}}&nbsp;{{com_addr_street}},
            {{com_addr_village_dmc_ward}}, {{com_addr_city}}, {{com_pincode}}</span>&nbsp;
        {{district_text}} District of U.T. DNH & Daman & Diu, {{#if show_gaudian_data}}That my minor child <span class="b-b-1px f-w-b">{{minor_child_name}}</span>{{/if}}
        hereby declare that the above/following information is true to the bet of my knowledge 
        and belief and nothing has been concealed therein. I am well aware of the face that if the information given by 
        me is proved false/not true, I will have to face the punishment as per the law and the benefits availed by me 
        shall be summarily withdrawn.<br><br>

        I have applied to the Mamlatdar, {{district_text}}, to issue me a <b> Non Creamy Layer Certificate </b>in respect of 
        {{#if show_gaudian_data}}
        my minor child {{minor_child_name}}
        {{else}}
        myself
        {{/if}}, I hereby declare and state that 

        {{#if show_gaudian_data}}
        my minor child {{minor_child_name}}
        {{else}}
        I am
        {{/if}}
        holding an OBC bearing No. <span class="b-b-1px f-w-b">{{obc_certificate_no}}</span> and date <span class="b-b-1px f-w-b">{{obc_certificate_date}}</span><br><br>

        I hereby declared that 
        {{#if show_gaudian_data}}
        my minor child {{minor_child_name}} 
        {{else}}
        I am
        {{/if}} belongs to <b>{{religion}}&nbsp;{{other_religion_text}}</b><span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_caste_text}}</span>&nbsp;&nbsp;&nbsp;Community which is recognized as an Other Backward Class by the Government of India.<br><br>

        Further, I sate that this academic year, our annual family income form, all source is Approximately ₹.<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{family_annual_income}} only</span>&nbsp;&nbsp;&nbsp;hence, 

        {{#if show_gaudian_data}}
        my minor child {{minor_child_name}} is not
        {{else}}
        I do not
        {{/if}}
        belongs to the Creamy Layer.<br><br>

        This declaration is required to b e submitted to the Mamlatdar, {{district_text}} to get <b> Non Creamy Layer </b> Renew Certificate in respect of 
        {{#if show_gaudian_data}}
        my minor child {{minor_child_name}}
        {{else}}
        my Self
        {{/if}}.<br><br>

        This is to certify that I have read and understood the provision of section 199 and 200 of the Indian Penal Code.
        <br>
        <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px;">
            <b>Section 199. False statement made in declaration which is by law receivable as evidence:-  </b>
            <div>
                Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or any Public Servant or other person, is bound or authorized bylaw to receive as evidence of any fact, makes any statement which is false, and which he either knows or believes to be false or does not believe to be true, touching any point material to the object for which the declaration is made or used, shall be punished in the same manner as if he gave false evidence.
            </div>
        </div>
        <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px;">
            <b>Section 200. Using as true such declaration knowing it to be false:- </b>
            Whoever corruptly uses or attempts to use as true any such declaration, knowing the same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
        </div>
        <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px;">
            <b>Explanation :- </b>
            A declaration which is inadmissible merely upon the ground of some informality, is a declaration within the meaning of Sections 199 and 200.
        </div>
    </div>

    <div style="margin-top: 5px;">
        Place: {{district_text}}
    </div>
    <div style="margin-top: 5px;">
        Date: {{application_date}}
    </div>

    <div style="margin-top: 20px; text-align: justify; text-justify: inter-word;">
        <div class="checkbox" style="position: relative; display: block;">
            <label class="cursor-pointer">
                <input type="checkbox" id="declaration_for_ncl_cerfificate"> 
                I, hereby accept the declaration.
            </label>
        </div>
        <span class="error-message error-message-ncl-certificate-declaration_for_ncl_cerfificate"></span>
    </div>
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_nclview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    {{#if show_submit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="fsubmit_btn_for_ncl_cerfificate"
            onclick="NclCertificate.listview.submitNclCertificate({{VALUE_THREE}});">Submit Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>