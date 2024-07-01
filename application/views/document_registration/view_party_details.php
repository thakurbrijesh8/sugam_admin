{{#if show_bd_drsthree}}
<div class="card property_details_for_drsfour fw-body collapsed-card">
    <div class="card-header pt-2 pb-1 bg-nic-blue">
        <h3 class="card-title f-w-b f-s-15px">
            Other Party Detail : Sr. No. {{opd_cnt}} -
            <span class="badge bg-white app-status">{{party_category_text}}</span> -
            <span class="badge bg-white app-status">{{party_description_text}}</span> - 
            <span class="badge bg-white app-status">{{party_name}}</span>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus text-white"></i>
            </button>
        </div>
    </div>
    <div class="card-body border-nic-blue">
        {{/if}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Party Category</td>
                    <td>{{party_category_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b" style="width: 40%;">Party Description</td>
                    <td>{{party_description_text}}</td>
                </tr>
                {{#if show_bd_drstwo}}
                <tr>
                    <td class="f-w-b">Whether Power of Attorney Holder</td>
                    <td>{{is_poa_holder_text}}</td>
                </tr>
                {{#if show_poa_details}}
                <tr>
                    <td class="f-w-b">POA Name of Principal</td>
                    <td>{{poa_principal_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">POA Type</td>
                    <td>{{poa_type_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">POA Description</td>
                    <td>{{poa_description}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">POA Document</td>
                    <td>
                        <div id="poa_doc_container_for_{{mt_type}}_view_{{mt_cnt}}">Document Not Uploaded</div>
                        <div id="poa_doc_name_container_for_{{mt_type}}_view_{{mt_cnt}}" style="display: none;">
                            <a id="poa_doc_name_href_for_{{mt_type}}_view_{{mt_cnt}}" target="_blank" class="cursor-pointer">
                                <label id="poa_doc_name_for_{{mt_type}}_view_{{mt_cnt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer" style="padding: 2px 7px;"></label>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">POA Personal Details of Principal</td>
                    <td>{{poa_principal_pd}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">POA Execution Date</td>
                    <td>{{poa_execution_date_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">POA Place of Execution</td>
                    <td>{{poa_execution_place}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">POA Witnesses</td>
                    <td>{{poa_witnesses}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">POA Notarised Advocate</td>
                    <td>{{poa_notarised_advocate}}</td>
                </tr>
                {{/if}}
                {{/if}}
                <tr>
                    <td class="f-w-b">Party Full Name</td>
                    <td>{{party_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Address</td>
                    <td>{{party_address}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Pincode</td>
                    <td>{{party_pincode}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party State / U.T.</td>
                    <td>{{party_state_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party District</td>
                    <td>{{party_district_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Date of Birth / Year of Birth / Age</td>
                    <td>{{party_dob_year_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Gender</td>
                    <td>{{party_gender_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Religion</td>
                    <td>{{party_religion_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Mobile Number</td>
                    <td>{{party_mobile_number}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Email Address</td>
                    <td>{{party_email_address}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Occupation</td>
                    <td>{{party_occupation_text}}</td>
                </tr>
                {{#if show_pan_details}}
                <tr>
                    <td class="f-w-b">PAN Details</td>
                    <td>
                        <b>PAN Number :</b> <span style="text-transform: uppercase;">{{party_pan_number}}</span>
                        <div id="party_pan_doc_name_container_for_{{mt_type}}_view_{{mt_cnt}}" style="display: none; margin-top: 5px;">
                            <a id="party_pan_doc_name_href_for_{{mt_type}}_view_{{mt_cnt}}" target="_blank" class="cursor-pointer">
                                <label id="party_pan_doc_name_for_{{mt_type}}_view_{{mt_cnt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer" style="padding: 2px 7px;"></label>
                            </a>
                        </div>
                    </td>
                </tr>
                {{/if}}
                {{#if show_form60_details}}
                <tr>
                    <td class="f-w-b">Form 60 Document</td>
                    <td>
                        <div id="party_form_sixteen_name_container_for_{{mt_type}}_view_{{mt_cnt}}" style="display: none;">
                            <a id="party_form_sixteen_name_href_for_{{mt_type}}_view_{{mt_cnt}}" target="_blank" class="cursor-pointer">
                                <label id="party_form_sixteen_name_for_{{mt_type}}_view_{{mt_cnt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer" style="padding: 2px 7px;"></label>
                            </a>
                        </div>
                    </td>
                </tr>
                {{/if}}
                <tr>
                    <td class="f-w-b">Party Aadhar Details</td>
                    <td>
                        <b>Aadhar Number :</b> {{party_aadhar_number}}
                        <div id="party_aadhar_doc_name_container_for_{{mt_type}}_view_{{mt_cnt}}" style="display: none; margin-top: 5px;">
                            <a id="party_aadhar_doc_name_href_for_{{mt_type}}_view_{{mt_cnt}}" target="_blank" class="cursor-pointer">
                                <label id="party_aadhar_doc_name_for_{{mt_type}}_view_{{mt_cnt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer" style="padding: 2px 7px;"></label>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Any Other Details / Remarks</td>
                    <td>{{party_remarks}}</td>
                </tr>
            </table>
        </div>
        {{#if show_bd_drsthree}}
    </div>
</div>
{{/if}}