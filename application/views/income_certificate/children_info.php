<tr id="income_certificate_children_info_{{per_cnt_child}}" class="income_certificate_children_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt_child}}">
        <span class="display-cnt-child f-w-b">{{per_cnt_child}}</span>
    </td>
    <td class="p-1">
        <input type="text" id="name_of_children_for_income_certificate_{{per_cnt_child}}"
               maxlength="100" class="form-control" value="{{name_of_children}}" placeholder="Enter Name of Children !"
               {{readonly}}>
        <span class="error-message error-message-income-certificate-name_of_children_for_income_certificate_{{per_cnt_child}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="age_of_children_for_income_certificate_{{per_cnt_child}}"
               maxlength="100" class="form-control" value="{{age_of_children}}" placeholder="Enter Age of Children !"
               {{readonly}} onkeyup="checkNumeric($(this));">
        <span class="error-message error-message-income-certificate-age_of_children_for_income_certificate_{{per_cnt_child}}"></span>
    </td>
    <td class="p-1">
        <!-- <input type="text" id="profession_for_children_for_income_certificate_{{per_cnt_child}}"
               class="form-control" value="{{profession}}" placeholder="Enter Profession of Children !"
                {{readonly}}> -->
        <select id="profession_for_children_for_income_certificate_{{per_cnt_child}}" name="profession_for_children_for_income_certificate_{{per_cnt_child}}" class="form-control select2" data-placeholder="Select Profession" style="width: 100%;" onchange="showOtherOccupationforChildrentext(this,'children_other_occupation_text','income_certificate_{{per_cnt_child}}');">
        </select>
        <span class="error-message error-message-income-certificate-profession_for_children_for_income_certificate_{{per_cnt_child}}"></span>

        <input type="text" id="children_other_occupation_text_for_income_certificate_{{per_cnt_child}}" name="children_other_occupation_text_for_income_certificate_{{per_cnt_child}}"
               maxlength="100" class="form-control" value="{{children_other_occupation}}" placeholder="Enter Other Occupation !"
               {{readonly}} style="display: none;">
        <span class="error-message error-message-income-certificate-children_other_occupation_text_for_income_certificate_{{per_cnt_child}}"></span>
    </td>
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="IncomeCertificate.listview.removeChildrenInfo({{per_cnt_child}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
