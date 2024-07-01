<tr id="heirship_family_member_info_{{per_cnt}}" class="heirship_family_member_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' id="temp_cnt" value="{{per_cnt}}">
        <span class="display-cnt f-w-b">{{per_cnt}}</span>
    </td>
    <td class="p-1">
        <input type="text" id="name_of_family_memb_for_heirship_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{member_name}}" placeholder="Enter Name of Member !">
        <span class="error-message error-message-heirship-name_of_family_memb_for_heirship_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <select id="member_remarks_for_heirship_{{per_cnt}}" name="member_remarks_for_heirship_{{per_cnt}}" class="form-control select2"  data-placeholder="Select Alive / Death" style="width: 100%;" 
                onchange="Heirship.listview.getRemarksStatusForAge({{per_cnt}}, 'heirship');">
        </select>
        <span class="error-message error-message-heirship-member_remarks_for_heirship_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="age_of_family_memb_for_heirship_{{per_cnt}}" name="age_of_family_memb_for_heirship_{{per_cnt}}"
               maxlength="2" class="form-control" value="{{member_age}}" placeholder="Enter Age !"
               onkeyup="checkNumeric($(this));">
        <span class="error-message error-message-heirship-age_of_family_memb_for_heirship_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <select id="member_relation_for_heirship_{{per_cnt}}" name="member_relation_for_heirship_{{per_cnt}}" class="form-control select2"  data-placeholder="Select Relation with Deceased Person" style="width: 100%;">
        </select>
        <span class="error-message error-message-heirship-member_relation_for_heirship_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <select id="member_marital_status_for_heirship_{{per_cnt}}" name="member_marital_status_for_heirship_{{per_cnt}}" class="form-control select2" data-placeholder="Select Marital Status" style="width: 100%;">
        </select>
        <span class="error-message error-message-heirship-member_marital_status_for_heirship_{{per_cnt}}"></span>
    </td>
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="Heirship.listview.removeFamilyMemberInfo({{per_cnt}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
