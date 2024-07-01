<tr id="income_certificate_property_info_{{per_cnt_property}}" class="income_certificate_property_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt_property}}">
        <span class="display-cnt-property f-w-b">{{per_cnt_property}}</span>
    </td>
    <td class="p-1">
        <select id="property_type_for_income_certificate_{{per_cnt_property}}" name="property_type_for_income_certificate_{{per_cnt_property}}" class="form-control select2" data-placeholder="Select Property Type" style="width: 100%;" onchange="showOtherTypeOfPropertytext(this,'other_property_type_text','income_certificate_{{per_cnt_property}}');">
        </select>
        <span class="error-message error-message-income-certificate-property_type_for_income_certificate_{{per_cnt_property}}"></span>

        <input type="text" id="other_property_type_text_for_income_certificate_{{per_cnt_property}}" name="other_property_type_text_for_income_certificate_{{per_cnt_property}}"
               maxlength="100" class="form-control" value="{{other_property_type}}" placeholder="Enter Other Property Detail !"
               {{readonly}} style="display: none;">
        <span class="error-message error-message-income-certificate-other_property_type_text_for_income_certificate_{{per_cnt_property}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="description_of_property_for_income_certificate_{{per_cnt_property}}"
               maxlength="100" class="form-control" value="{{description_of_property}}" placeholder="Enter Description of Property !"
               {{readonly}}>
        <span class="error-message error-message-income-certificate-description_of_property_for_income_certificate_{{per_cnt_property}}"></span>
    </td>
    <!-- <td class="p-1">
        <input type="text" id="value_of_property_for_income_certificate_{{per_cnt_property}}"
               maxlength="100" class="form-control" value="{{value_of_property}}" placeholder="Enter Value of Property !"
               {{readonly}} onkeyup="checkNumeric($(this));">
        <span class="error-message error-message-income-certificate-value_of_property_for_income_certificate_{{per_cnt_property}}"></span>
    </td> -->
    <td class="p-1">
        <input type="text" id="income_for_income_certificate_{{per_cnt_property}}" maxlength="8"
               class="form-control" value="{{income_of_property}}" placeholder="Enter Income derive from th eproperty per year !"
                {{readonly}} onkeyup="checkNumeric($(this));" >
        <span class="error-message error-message-income-certificate-income_for_income_certificate_{{per_cnt_property}}"></span>
    </td>
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="IncomeCertificate.listview.removePropertyInfo({{per_cnt_property}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
