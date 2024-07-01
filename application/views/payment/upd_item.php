<tr class="update_page_details_for_upd">
    <td style="width: 30px;" class="text-center v-a-m f-w-b">{{temp_cnt}}</td>
    <td class="text-center">{{village_text}}</td>
    <td class="text-center">{{survey}}</td>
    <td class="text-center">{{subdiv}}</td>
    {{#if show_mte}}
    <td class="text-center">{{mutation_entry_no}}</td>
    {{/if}}
    {{#if show_dr}}
    <td>{{document_required}}</td>
    {{/if}}
    <td class="text-right f-w-b">{{copies}}</td>
    <td>
        <input type="hidden" id="form_land_details_id_for_upg_{{form_land_details_id}}" class="form_land_details_id_for_upg" value="{{form_land_details_id}}" />
        <input type="hidden" id="module_type_for_upg_{{form_land_details_id}}" value="{{module_type}}" />
        <input type="hidden" id="module_id_for_upg_{{form_land_details_id}}" value="{{module_id}}" />
        <input type="hidden" id="survey_for_upd_{{form_land_details_id}}" value="{{survey}}" />
        <input type="hidden" id="subdiv_for_upd_{{form_land_details_id}}" value="{{subdiv}}" />
        {{#if show_mte}}
        <input type="hidden" id="mutation_entry_no_for_upd_{{form_land_details_id}}" value="{{mutation_entry_no}}" />
        {{/if}}
        {{#if show_dr}}
        <input type="hidden" id="document_required_for_upd_{{form_land_details_id}}" value="{{document_required}}" />
        {{/if}}
        <input type="hidden" id="copies_for_upd_{{form_land_details_id}}" value="{{copies}}" />
        <input type="hidden" id="amount_for_upg_{{form_land_details_id}}" class="input-null-upd-{{form_land_details_id}}" value="{{amount}}" />
        <input type="text" name="pages_for_upd_{{form_land_details_id}}" id="pages_for_upd_{{form_land_details_id}}" 
               class="form-control text-right allow-int-value input-null-upd-{{form_land_details_id}}" maxlength="3"
               onkeyup="checkNumeric($(this)); calculatePagesWithCopyAmount({{form_land_details_id}});"
               onblur="checkNumeric($(this)); checkValidation('upd', 'pages_for_upd_{{form_land_details_id}}', detailValidationMessage);
                           calculatePagesWithCopyAmount({{form_land_details_id}});"
               {{readonly_upd}} placeholder="Enter Pages" value="{{pages}}">
        <span class="error-message error-message-upd-pages_for_upd_{{form_land_details_id}}"></span>
    </td>
    <td class="text-right"><span id="d_amount_for_upg_{{form_land_details_id}}" class="html-null-upd-{{form_land_details_id}}">{{amount}}</span>/-</td>
    {{#if show_na}}
    <td class="text-center">
        <label class="radio-inline f-w-n cursor-pointer">
            <input type="checkbox" name="is_na_for_upd_{{form_land_details_id}}" id="is_na_for_upd_{{form_land_details_id}}"
                   {{is_na_checked_upd}}
                   onchange="isNotAvailableUPD({{form_land_details_id}});" class="cursor-pointer" /> Not Available
        </label>
    </td>
    {{/if}}
</tr>