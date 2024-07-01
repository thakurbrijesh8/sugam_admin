<tr id="verification_document_row_{{cnt}}" class="verification_document_row">
    <td style="width: 30px;" class="text-center verification-document-cnt v-a-m f-w-b">{{cnt}}</td>
    <td>
        <input type="hidden" class="og_verification_document_cnt" value="{{cnt}}" />
        <input type="hidden" id="field_document_id_for_field_verification_{{cnt}}" value="{{field_verification_document_id}}" />
        <input type="hidden" id="verification_type_for_field_verification_{{cnt}}" value="{{verification_type}}" />
        <input type="text" class="form-control" id="doc_name_for_verification_document_{{cnt}}"
               onblur="checkValidation('verification','doc_name_for_verification_document_{{cnt}}', documentNameValidationMessage)"
               placeholder="Document Name !" maxlength="50" value="{{doc_name}}">
        <span class="error-message error-message-verification-doc_name_for_verification_document_{{cnt}}"></span>
    </td>
    <td class="text-center v-a-m">
        <div id="document_container_for_verification_document_{{cnt}}">
            <input type="file" id="document_for_verification_document_{{cnt}}"
                   onchange="ObcCertificate.listview.uploadDocForFieldVerification('{{cnt}}');"
                   accept="image/jpg,image/png,image/jpeg,image/jfif,application/pdf" style="width: 300px; display: none;">
            <button type="button" class="btn btn-sm btn-nic-blue" 
                    onclick="$('#document_for_verification_document_{{cnt}}').click();"
                    style="cursor: pointer;">
                Select File
            </button>
        </div>
        <div class="text-center color-nic-blue" id="spinner_template_for_verification_document_{{cnt}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
        <div id="document_name_container_for_verification_document_{{cnt}}" style="display: none;">
            <a id="document_name_href_for_verification_document_{{cnt}}" target="_blank" class="cursor-pointer">
                <label id="document_name_for_verification_document_{{cnt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer"></label>
            </a>
            <button type="button" id="document_remove_btn_for_verification_document_{{cnt}}" class="btn btn-sm btn-danger" style="vertical-align: top;">
                <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
        </div>
        <span class="error-message error-message-verification-document_for_verification_document_{{cnt}}"></span>
    </td>
    <td class="text-center v-a-m">
        <button type="button" class="btn btn-sm btn-danger"
                onclick="ObcCertificate.listview.askForRemoveDocItemForFieldVerification({{cnt}})" style="cursor: pointer;">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>