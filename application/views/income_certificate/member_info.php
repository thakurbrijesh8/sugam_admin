<tr id="income_certificate_member_info_{{per_cnt}}" class="income_certificate_member_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt}}">
        <span class="display-cnt f-w-b">{{per_cnt}}</span>
    </td>
    <td class="p-1">
        <input type="text" id="name_of_family_memb_for_income_certificate_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{name_of_family_memb}}" placeholder="Enter Name of Family Member !"
               {{readonly}}>
        <span class="error-message error-message-income-certificate-member_relation_for_income_certificate_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="member_relation_for_income_certificate_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{member_relation}}" placeholder="Enter Relation of Family Member !"
               {{readonly}}>
        <span class="error-message error-message-income-certificate-member_relation_for_income_certificate_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="member_income_for_income_certificate_{{per_cnt}}"
               class="form-control" value="{{member_income}}" placeholder="Enter Monthly Income !" maxlength="8"
                {{readonly}} onkeyup="checkNumeric($(this));">
        <span class="error-message error-message-income-certificate-member_income_for_income_certificate_{{per_cnt}}"></span>
    </td>
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="IncomeCertificate.listview.removeMemberInfo({{per_cnt}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
