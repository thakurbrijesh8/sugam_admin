<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">{{title}}</h3>
</div>
<form role="form" id="update_basic_detail_character_certificate_form" name="update_basic_detail_character_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="character_certificate_id_for_character_certificate_update_basic_detail" name="character_certificate_id_for_character_certificate_update_basic_detail" value="{{character_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-character-certificate-update-basic-detail f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 45%;">Application Number</td>
                    <td>{{application_number}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Name of Applicant</td>
                    <td>{{applicant_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Applicant's Communication Address</td>
                    <td>{{com_addr_house_no}}, {{com_addr_house_name}}, {{com_addr_street}}, {{com_addr_village_dmc_ward}}, {{com_addr_city}}, {{com_pincode}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Applicant Permanent Address</td>
                    <td>{{per_addr_house_no}}, {{per_addr_house_name}}, {{per_addr_street}}, {{per_addr_village_dmc_ward}}, {{per_addr_city}}, {{per_pincode}}</td>
                </tr>
            </table>
        </div>
        {{#if show_ldc_enter_basic_details}}
            <div class="row">
                <div class="form-group col-sm-12">
                    <label>1. Remarks <span style="color: red;">*</span></label>
                    <textarea id="ldc_to_mamlatdar_remarks_for_character_certificate" name="ldc_to_mamlatdar_remarks_for_character_certificate" class="form-control"
                              onblur="checkValidation('character-certificate-update-basic-detail', 'ldc_to_mamlatdar_remarks_for_character_certificate', remarksValidationMessage);"
                              placeholder="Remarks !" maxlength="300">{{ldc_to_mamlatdar_remarks}}</textarea>
                    <span class="error-message error-message-character-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_character_certificate"></span>
                </div>
                <div class="form-group col-sm-12">
                    <label>2. Forward to Mamlatdar <span style="color: red;">*</span></label>
                    <select id="ldc_to_mamlatdar_for_character_certificate" name="ldc_to_mamlatdar_for_character_certificate"
                            onchange="checkValidation('character-certificate-update-basic-detail', 'ldc_to_mamlatdar_for_character_certificate', oneOptionValidationMessage);"
                            class="form-control" data-placeholder="Select Forward to Mamlatdar">
                        <option value="">Select Any Mamlatdar</option>
                    </select>
                    <span class="error-message error-message-character-certificate-update-basic-detail-ldc_to_mamlatdar_for_character_certificate"></span>
                </div>
            </div>
        {{/if}}
        {{#if show_ldc_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 45%;">Remarks by LDC</td>
                    <td>{{ldc_to_mamlatdar_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{ldc_to_mamlatdar_datetime_text}}<br>
                        <b>To :</b> {{mamlatdar_name}}
                    </td>
                </tr>
            </table>
        </div>
        {{/if}}
        {{#if show_mamlatdar_enter_basic_details}}
            <div class="row">
                <div class="form-group col-sm-12">
                    <label>1. Remarks <span style="color: red;">*</span></label>
                    <textarea id="mamlatdar_to_sdpo_remarks_for_character_certificate" name="mamlatdar_to_sdpo_remarks_for_character_certificate" class="form-control"
                              onblur="checkValidation('character-certificate-update-basic-detail', 'mamlatdar_to_sdpo_remarks_for_character_certificate', remarksValidationMessage);"
                              placeholder="Remarks !" maxlength="300">{{mamlatdar_to_sdpo_remarks}}</textarea>
                    <span class="error-message error-message-character-certificate-update-basic-detail-mamlatdar_to_sdpo_remarks_for_character_certificate"></span>
                </div>
                <div class="form-group col-sm-12">
                    <label>2. Forward to SDPO <span style="color: red;">*</span></label>
                    <select id="mamlatdar_to_sdpo_for_character_certificate" name="mamlatdar_to_sdpo_for_character_certificate"
                            onchange="checkValidation('character-certificate-update-basic-detail', 'mamlatdar_to_sdpo_for_character_certificate', oneOptionValidationMessage);"
                            class="form-control" data-placeholder="Select Forward to Mamlatdar">
                        <option value="">Select Any SDPO</option>
                    </select>
                    <span class="error-message error-message-character-certificate-update-basic-detail-mamlatdar_to_sdpo_for_character_certificate"></span>
                </div>
            </div>
        {{/if}}
        {{#if show_mamlatdar_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 45%;">Remarks by Mamlatdar</td>
                    <td>{{mamlatdar_to_sdpo_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{mamlatdar_to_sdpo_datetime_text}}<br>
                        <b>To :</b> {{sdpo_name}}
                    </td>
                </tr>
            </table>
        </div>
        {{/if}}
        {{#if show_sdpo_enter_basic_details}}
            <div class="row" id="uc_container_for_sdpo">
                <div class="col-12 m-b-5px" id="inquiry_copy_container_for_sdpo">
                    <label>1. Upload <span style="color: red;">* (Maximum File Size: 2MB)</span></label><br>
                    <input type="file" id="inquiry_copy_for_sdpo" name="inquiry_copy_for_sdpo"
                           accept="image/jpg,image/png,image/jpeg,image/jfif,application/pdf">
                    <div class="error-message error-message-character-certificate-uc-inquiry_copy_for_sdpo"></div>
                </div>
            </div><!-- 
            <br/>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label>2. Forward to LDC <span style="color: red;">*</span></label>
                    <select id="sdpo_to_ldc_for_character_certificate" name="sdpo_to_ldc_for_character_certificate"
                            onchange="checkValidation('character-certificate-update-basic-detail', 'sdpo_to_ldc_for_character_certificate', oneOptionValidationMessage);"
                            class="form-control" data-placeholder="Select Forward to LDC">
                        <option value="">Select Any LDC</option>
                    </select>
                    <span class="error-message error-message-character-certificate-update-basic-detail-sdpo_to_ldc_for_character_certificate"></span>
                </div>
            </div> -->
        {{/if}}
        {{#if show_sdpo_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 45%;">Uploaded Document by SDPO</td>
                    <td>
                        <div class="form-group col-sm-12" id="inquiry_copy_name_container_for_sdpo" style="display: none;">
                            <a id="inquiry_copy_name_href_for_sdpo" target="_blank">
                                <i class="fas fa-cloud-download-alt" style="margin-right: 3px;"></i><span id="inquiry_copy_name_for_sdpo"></span>
                            </a>
                            {{#if show_remove_upload_btn}}
                            <span class="fas fa-times" style="color: red; cursor: pointer; margin-left: 3px;" id="inquiry_copy_remove_btn_for_sdpo"></span><br>
                            {{/if}}
                            <span class="error-message error-message-character-certificate-uc-inquiry_copy_name_for_sdpo"></span>
                        </div>
                    </td>
                </tr><!-- 
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{sdpo_to_ldc_datetime_text}}<br>
                        <b>To :</b> {{ldc_name}}
                    </td>
                </tr> -->
            </table>
        </div>
        {{/if}}
        <hr class="m-b-1rem">
        <div class="form-group">
            {{#if show_submit_btn}}
            <button type="button" class="btn btn-sm btn-success"
                    onclick="CharacterCertificate.listview.submitBasicDetail($(this));"
                    style="margin-right: 5px;">
                        <?php echo is_admin() ? 'Submit' : 'Forward'; ?>
            </button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>