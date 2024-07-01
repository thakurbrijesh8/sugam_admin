<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Marriage Certificate Form
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-marriage-certificate f-w-b"
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
                <td class="f-w-b">Applicant's Communication Address</td>
                <td>{{communication_address}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant's Permanent Address</td>
                <td>{{permanent_address}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Email</td>
                <td>{{applicant_email}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Date of Birth</td>
                <td>{{applicant_dob}}</td>
            </tr>
            <tr>
                <td class="f-w-b">Applicant Age</td>
                <td>{{applicant_age}}</td>
            </tr>
        </table>
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Bridegroom Details</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b">Name of Bridegroom</td>
                    <td>{{bridegroom_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>{{bridegroom_birthplace_state_text}}, {{bridegroom_birthplace_district_text}}, {{bridegroom_birthplace_village_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Place of Residence</td>
                    <td>{{bridegroom_residence}}, {{bridegroom_residence_state_text}}, {{bridegroom_residence_district_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Date of Birth / Age</td>
                    <td>{{bridegroom_dob}} / {{bridegroom_age}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{bridegroom_occupation}}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Bridegroom's Father Details</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b">Name of Bridegroom Father</td>
                    <td>{{bridegroom_father_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>{{bridegroom_father_birthplace_state_text}}, {{bridegroom_father_birthplace_district_text}}, {{bridegroom_father_birthplace_village_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Place of Residence</td>
                    <td>{{bridegroom_father_residence}}, {{bridegroom_father_residence_state_text}}, {{bridegroom_father_residence_district_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{bridegroom_father_occupation}}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Bridegroom's Mother Details</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b">Name of Bridegroom Mother</td>
                    <td>{{bridegroom_mother_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>{{bridegroom_mother_birthplace_state_text}}, {{bridegroom_mother_birthplace_district_text}}, {{bridegroom_mother_birthplace_village_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Place of Residence</td>
                    <td>{{bridegroom_mother_residence}}, {{bridegroom_mother_residence_state_text}}, {{bridegroom_mother_residence_district_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{bridegroom_mother_occupation}}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Bride Details</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b">Name of Bride</td>
                    <td>{{bride_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>{{bride_birthplace_state_text}}, {{bride_birthplace_district_text}}, {{bride_birthplace_village_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Place of Residence</td>
                    <td>{{bride_residence}}, {{bride_residence_state_text}}, {{bride_residence_district_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Date of Birth / Age</td>
                    <td>{{bride_dob}} / {{bride_age}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{bride_occupation}}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Bride's Father Details</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b">Name of Bride Father</td>
                    <td>{{bride_father_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>{{bride_father_birthplace_state_text}}, {{bride_father_birthplace_district_text}}, {{bride_father_birthplace_village_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Place of Residence</td>
                    <td>{{bride_father_residence}}, {{bride_father_residence_state_text}}, {{bride_father_residence_district_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{bride_father_occupation}}</td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 20px;">
            <b style="font-size: 14px;">Bride's Mother Details</b>
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b">Name of Bride Mother</td>
                    <td>{{bride_mother_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Birth Place</td>
                    <td>{{bride_mother_birthplace_state_text}}, {{bride_mother_birthplace_district_text}}, {{bride_mother_birthplace_village_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Place of Residence</td>
                    <td>{{bride_mother_residence}}, {{bride_mother_residence_state_text}}, {{bride_mother_residence_district_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td>{{bride_mother_occupation}}</td>
                </tr>
            </table>
        </div>
        <div class="f-w-b f-s-16px">Enclosed as below :-</div>
        <div class="table-responsive">
            <table class="table mb-0">
                <tr>
                    {{#if show_bridegroom_photo}}
                    <td style="width: 180px;">
                        <img style="border: 2px solid blue; width: 160px; height: 180px;"
                             src="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bridegroom_photo}}">
                    </td>
                    {{/if}}
                    <!-- {{#if show_bride_photo}}
                    <td style="width: 180px;">
                        <img style="border: 2px solid blue; width: 160px; height: 180px;"
                             src="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bride_photo}}">
                    </td>
                    {{/if}} -->
                    <td>
                        <div>
                            {{#if show_bridegroom_birth_certi_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bridegroom_birth_certi_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bridegroom Birth Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bridegroom_leaving_certi_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bridegroom_leaving_certi_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bridegroom Leaving Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bridegroom_domicile_certi_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bridegroom_domicile_certi_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bridegroom Domicile Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bridegroom_aadhar_card_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bridegroom_aadhar_card_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bridegroom Aadhar Card
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bridegroom_election_card_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bridegroom_election_card_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bridegroom Election Card
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bridegroom_court_order_certi_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bridegroom_court_order_certi_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bridegroom Court Order Certificate
                                </label>
                            </a>
                            {{/if}}


                            {{#if show_bride_birth_certi_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bride_birth_certi_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bride Birth Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bride_leaving_certi_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bride_leaving_certi_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bride Leaving Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bride_domicile_certi_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bride_domicile_certi_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bride Domicile Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bride_aadhar_card_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bride_aadhar_card_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bride Aadhar Card
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bride_election_card_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bride_election_card_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bride Election Card
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_bride_court_order_certi_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{bride_court_order_certi_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Bride Court Order Certificate
                                </label>
                            </a>
                            {{/if}}
                            {{#if show_samaj_marriage_certi_doc}}
                            <a target="_blank" href="{{MARRIAGE_CERTIFICATE_DOC_PATH}}{{samaj_marriage_certi_doc}}">
                                <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                    <i class="fas fa-download"></i> &nbsp; Samaj Marriage Certificate
                                </label>
                            </a>
                            {{/if}}
                            <!-- {{#if show_declaration_btn}}
                            <button type="button" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1"
                                    onclick='MarriageCertificate.listview.downloadDeclaration();'>
                                <i class="fas fa-download"></i> &nbsp; Declaration
                            </button>
                            {{/if}} -->
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <!-- <form target="_blank" id="mc_declaration_pdf" action="marriage_certificate/download_mc_declaration" method="post">
            <input type="hidden" id="marriage_certificate_id_for_mc_declaration" name="marriage_certificate_id_for_mc_declaration" value="{{marriage_certificate_id}}">
        </form> -->
    </div> 
</div>
<div class="card-footer text-right">
    {{#if show_print_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="window.print();" id="pa_btn_for_icview">
        <i class="fas fa-file-pdf mr-1"></i> Print Application
    </button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>