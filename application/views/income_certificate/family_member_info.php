<tr id="income_certificate_family_member_info_{{per_cnt}}" class="income_certificate_family_member_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt}}">
        <span class="display-cnt f-w-b">{{per_cnt}}</span>
    </td>
    <td class="p-1">
        <input type="text" id="name_of_family_memb_for_income_certificate_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{name_of_family_memb}}" placeholder="Enter Name of Member !"
               {{readonly}}>
        <span class="error-message error-message-income-certificate-name_of_family_memb_for_income_certificate_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="member_relation_for_income_certificate_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{member_relation}}" placeholder="Enter Relation with Applicant !"
               {{readonly}}>
        <span class="error-message error-message-income-certificate-member_relation_for_income_certificate_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="age_of_family_memb_for_income_certificate_{{per_cnt}}"
               maxlength="3" class="form-control" value="{{age_of_family_memb}}" placeholder="Enter Age of Member !"
               {{readonly}} onkeyup="checkNumeric($(this));">
        <span class="error-message error-message-income-certificate-age_of_family_memb_for_income_certificate_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <!-- <input type="text" id="profession_for_income_certificate_{{per_cnt}}"
               class="form-control" value="{{profession}}" placeholder="Enter Profession !"
                {{readonly}}> -->
        <select id="profession_for_income_certificate_{{per_cnt}}" name="profession_for_income_certificate_{{per_cnt}}" class="form-control select2" data-placeholder="Select Profession" style="width: 100%;" onchange="showOtherOccupationtext(this,'earning_member_other_occupation_text','income_certificate_{{per_cnt}}');">
        </select>
        <span class="error-message error-message-income-certificate-profession_for_income_certificate_{{per_cnt}}"></span>

        <input type="text" id="earning_member_other_occupation_text_for_income_certificate_{{per_cnt}}" name="earning_member_other_occupation_text_for_income_certificate_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{other_occupation}}" placeholder="Enter Other Occupation !"
               {{readonly}} style="display: none;">
        <span class="error-message error-message-income-certificate-earning_member_other_occupation_text_for_income_certificate_{{per_cnt}}"></span>

    </td>
    <td class="p-1">
        <input type="text" id="yearly_income_for_income_certificate_{{per_cnt}}" maxlength="8"
               class="form-control" value="{{yearly_income}}" placeholder="Enter Yearly Income !"
                {{readonly}} onkeyup="checkNumeric($(this));" onblur="IncomeCertificate.listview.getYearlyIncomeTotal('yearly_income_for_income_certificate_{{per_cnt}}');">
        <span class="error-message error-message-income-certificate-yearly_income_for_income_certificate_{{per_cnt}}"></span>
    </td>
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="IncomeCertificate.listview.removeFamilyMemberInfo({{per_cnt}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
