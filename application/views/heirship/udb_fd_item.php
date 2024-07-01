<tr class="fd_for_ubd" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{temp_cnt}}">
        <input type="hidden" id="member_marital_status_for_udb_{{temp_cnt}}" value="{{member_marital_status}}">
        <span class="display-cnt f-w-b">{{temp_cnt}}</span>
    </td>
    <td class="p-1">
        <input type="text" id="name_of_family_memb_for_ubd_{{temp_cnt}}"
               maxlength="100" class="form-control" value="{{member_name}}" placeholder="Enter Name of Member !">
        <span class="error-message error-message-ubd-name_of_family_memb_for_ubd_{{temp_cnt}}"></span>
    </td>
    <td class="p-1">
        <select id="member_remarks_for_ubd_{{temp_cnt}}" name="member_remarks_for_ubd_{{temp_cnt}}" class="form-control"
                onchange="Heirship.listview.getRemarksStatusForAge({{temp_cnt}}, 'ubd');">
            <option value="">Select Alive / Death</option>
        </select>
        <span class="error-message error-message-ubd-member_remarks_for_ubd_{{temp_cnt}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="age_of_family_memb_for_ubd_{{temp_cnt}}" name="age_of_family_memb_for_ubd_{{temp_cnt}}"
               maxlength="2" class="form-control" value="{{member_age}}" placeholder="Enter Age !"
               onblur="checkNumeric($(this));" onkeyup="checkNumeric($(this));">
        <span class="error-message error-message-ubd-age_of_family_memb_for_ubd_{{temp_cnt}}"></span>
    </td>
    <td class="p-1">
        <select id="member_relation_for_ubd_{{temp_cnt}}" name="member_relation_for_ubd_{{temp_cnt}}" class="form-control">
            <option value="">Select Relation with Deceased Person</option>
        </select>
        <span class="error-message error-message-ubd-member_relation_for_ubd_{{temp_cnt}}"></span>
    </td>
</tr>