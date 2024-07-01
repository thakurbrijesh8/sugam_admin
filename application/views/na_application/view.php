<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        {{title}} Change In Land Use (N.A.) Form
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
        </table>
    </div>
    <div class="f-w-b f-s-16px">Details of Applicant</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Full Name of the Applicant</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Occupation of the Applicant</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Postal Address of the Applicant</td>
                </tr>
            </thead>
            <tbody id="applicant_info_container_for_na_view"></tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding bg-beige">
            <tbody>
                <tr>
                    <td style="width: 60px;" class="f-w-b text-center v-a-m">1. (a)</td>
                    <td style="min-width: 190px;">Assessed or held for the purpose of agriculture for the non-agricultural purpose/purposes of</td>
                    <td class="v-a-m" style="min-width: 190px;">{{agri_purpose_a}}</td>
                </tr>
                <tr>
                    <td class="f-w-b text-center v-a-m">1. (b)</td>
                    <td>Assessed or held for the non-agricultural purpose of</td>
                    <td class="v-a-m">{{non_agri_purpose_b}}</td>
                </tr>
                <tr>
                    <td class="f-w-b text-center v-a-m">1. (c)</td>
                    <td>Assessed or held for the non-agricultural purpose of</td>
                    <td class="v-a-m">{{non_agri_purpose_c}}</td>
                </tr>
                <tr>
                    <td class="f-w-b text-center v-a-m"></td>
                    <td>For the same purpose but in relaxation of condition</td>
                    <td class="v-a-m">{{rel_condition_c}}</td>
                </tr>
                <tr>
                    <td class="f-w-b text-center v-a-m"></td>
                    <td>Imposed at the time of grant of land or permission for such non-agricultural use viz.</td>
                    <td class="v-a-m">{{pre_non_agri_c}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Annex to this Application</div>
    <div class="table-responsive">
        <table class="table table-bordered table-padding">
            <thead>
                <tr>
                    <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 190px;">Name of Document</td>
                    <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 120px;">Document</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="f-w-b text-center v-a-m">2. (a)</td>
                    <td class="v-a-m">A certified copy of record of rights in respect of the land as it existed at the time of application(R/RNakal, Form I & XIV and site plan).</td>
                    <td class="v-a-m text-center">
                        {{#if show_certified_copy}}
                        <a target="_blank" href="{{NA_APPLICATION_DOC_PATH}}{{certified_copy}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Download
                            </label>
                        </a>
                        {{/if}}
                    </td>
                </tr>s
                <tr>
                    <td class="f-w-b text-center v-a-m">2. (b)</td>
                    <td class="v-a-m">
                        A sketch or layout of the site in question showing the location of the proposed building or 
                        other works for which permission is sought and the nearest road or means of access. 
                        (h'revocable Declaration/Consent/ NOC in fbrm of affidavit of the holder of the plot 
                        from where access will be provided).
                    </td>
                    <td class="v-a-m text-center">
                        {{#if show_sketch_layout}}
                        <a target="_blank" href="{{NA_APPLICATION_DOC_PATH}}{{sketch_layout}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Download
                            </label>
                        </a>
                        {{/if}}
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b text-center v-a-m">2. (c)</td>
                    <td class="v-a-m">Written consent of the tenant/superior holder /occupant and an affidavit of the applicant stating that the access will be obtained from the land holder.</td>
                    <td class="v-a-m text-center">
                        {{#if show_written_consent}}
                        <a target="_blank" href="{{NA_APPLICATION_DOC_PATH}}{{written_consent}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Download
                            </label>
                        </a>
                        {{/if}}
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b text-center v-a-m">2. (d)</td>
                    <td class="v-a-m">Other Documents</td>
                    <td class="v-a-m text-center">
                        {{#if show_other_documents}}
                        <a target="_blank" href="{{NA_APPLICATION_DOC_PATH}}{{other_documents}}">
                            <label class="btn btn-sm btn-nic-blue f-w-n cursor-pointer mb-1">
                                <i class="fas fa-download"></i> &nbsp; Download
                            </label>
                        </a>
                        {{/if}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="f-w-b f-s-16px">Land Details</div>
    <div id="land_details_container_for_na_view"></div>
    <div style="text-align: justify; text-justify: inter-word;">
        <div class="checkbox" style="position: relative; display: block;">
            <label class="cursor-pointer">
                <input type="checkbox" id="declaration_for_na_view"> 
                I, hereby accept the declaration.
            </label>
        </div>
    </div>
</div>
<div class="card-footer text-right">
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>