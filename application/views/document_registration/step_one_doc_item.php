<tr id="drsone_document_row_{{cnt}}" class="drsone_document_row">
    <td style="width: 30px;" class="text-center drsone-document-cnt v-a-m f-w-b">{{cnt}}</td>
    <td>
        <input type="hidden" class="og_drsone_document_cnt" value="{{cnt}}" />
        <input type="hidden" id="dr_document_id_for_drsone_{{cnt}}" value="{{dr_document_id}}" />
        <input type="text" class="form-control" id="doc_name_for_drsone_{{cnt}}"
               onblur="checkValidation('drsone','doc_name_for_drsone_{{cnt}}', documentNameValidationMessage)"
               placeholder="Document Name !" maxlength="50" value="{{doc_name}}">
        <span class="error-message error-message-drsone-doc_name_for_drsone_{{cnt}}"></span>
    </td>
    <td class="text-center v-a-m">
        <div id="document_container_for_drsone_{{cnt}}">Document Not Uploaded</div>
        <div id="document_name_container_for_drsone_{{cnt}}" style="display: none;">
            <a id="document_name_href_for_drsone_{{cnt}}" target="_blank" class="cursor-pointer">
                <label id="document_name_for_drsone_{{cnt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer" style="padding: 2px 7px;"></label>
            </a>
        </div>
    </td>
</tr>