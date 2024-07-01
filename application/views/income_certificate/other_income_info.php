<tr id="income_certificate_other_income_info_{{per_cnt_other_income}}" class="income_certificate_other_income_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt_other_income}}">
        <span class="display-cnt-other-income f-w-b">{{per_cnt_other_income}}</span>
    </td>
    <td class="p-1">
        <select id="source_of_income_for_income_certificate_{{per_cnt_other_income}}" name="source_of_income_for_income_certificate_{{per_cnt_other_income}}" class="form-control select2" data-placeholder="Select Source of Income" style="width: 100%;" onchange="showOtherSourceOfIncometext(this,'other_income_source_text','income_certificate_{{per_cnt_other_income}}');">
        </select>
        <span class="error-message error-message-income-certificate-source_of_income_for_income_certificate_{{per_cnt_other_income}}"></span>

        <input type="text" id="other_income_source_text_for_income_certificate_{{per_cnt_other_income}}" name="other_income_source_text_for_income_certificate_{{per_cnt_other_income}}"
               maxlength="100" class="form-control" value="{{other_income_source}}" placeholder="Enter Other Source of Income Detail !"
               {{readonly}} style="display: none;">
        <span class="error-message error-message-income-certificate-other_income_source_text_for_income_certificate_{{per_cnt_other_income}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="description_of_source_of_property_for_income_certificate_{{per_cnt_other_income}}"
               maxlength="100" class="form-control" value="{{description_of_source_of_property}}" placeholder="Enter Description of Source of Income !"
               {{readonly}}>
        <span class="error-message error-message-income-certificate-description_of_source_of_property_for_income_certificate_{{per_cnt_other_income}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="amount_of_income_for_income_certificate_{{per_cnt_other_income}}"
               maxlength="8" class="form-control" value="{{amount_of_income}}" placeholder="Enter Amount of Income !"
               {{readonly}} onkeyup="checkNumeric($(this));">
        <span class="error-message error-message-income-certificate-amount_of_income_for_income_certificate_{{per_cnt_other_income}}"></span>
    </td>
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="IncomeCertificate.listview.removeOtherIncomeInfo({{per_cnt_other_income}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
