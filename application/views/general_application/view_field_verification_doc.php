<tr class="report_doc_info">
<input type="hidden" class= "temp_cnt" value="{{cnt}}">
    <td class="text-center">
        <input type="checkbox" name="report_doc" id="report_doc_{{cnt}}" value="{{field_verification_document_id}}">
    </td>
    <td style="width: 30px;" class="text-center v-a-m f-w-b">{{cnt}}</td>
    <td class="v-a-m">{{doc_name}}</td>
    <td class="text-center v-a-m">
        <div id="document_container_for_{{moduleId}}_view_{{cnt}}" class="text-center">Document Not Uploaded</div>
        <div id="document_name_container_for_{{moduleId}}_view_{{cnt}}" style="display: none;">
            <a id="document_name_href_for_{{moduleId}}_view_{{cnt}}" target="_blank" class="cursor-pointer">
                <label id="document_name_for_{{moduleId}}_view_{{cnt}}" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer"></label>
            </a>
        </div>
    </td>
</tr>