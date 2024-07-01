<tr id="detail_of_children_daughter_info_{{per_cntdaughter}}" class="detail_of_children_daughter_info" style="background-color: #fff;">
    <!-- <td class="text-center v-a-m" style="padding: .75rem;"> -->
<input type="hidden" class='temp_cnt' value="{{per_cntdaughter}}">
<!-- <span class="display-cnt f-w-b">{{per_cntdaughter}}</span> -->
<!-- </td> -->
<td class="p-1">
    <input type="text" id="children_daughter_name_for_ec_{{per_cntdaughter}}"
           maxlength="100" class="form-control" value="{{children_daughter_name}}" placeholder="Enter Name !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-children_daughter_name_for_ec_{{per_cntdaughter}}"></span>
</td>
<td class="p-1">
    <input type="text" id="children_daughter_age_for_ec_{{per_cntdaughter}}"
           maxlength="2" class="form-control" value="{{children_daughter_age}}" placeholder="Enter Age !"
           {{readonly}} onkeyup="checkNumeric($(this));">
    <span class="error-message error-message-ews-certificate-children_daughter_age_for_ec_{{per_cntdaughter}}"></span>
</td>
<td class="p-1">
    <input type="text" id="children_daughter_occu_edu_for_ec_{{per_cntdaughter}}"
           maxlength="100" class="form-control" value="{{children_daughter_occu_edu}}" placeholder="Enter Occupation / Education !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-children_daughter_occu_edu_for_ec_{{per_cntdaughter}}"></span>
</td>
<td class="p-1">
    <input type="text" id="children_daughter_remark_for_ec_{{per_cntdaughter}}"
           maxlength="100" class="form-control" value="{{children_daughter_remark}}" placeholder="Enter Remark !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-children_daughter_remark_for_ec_{{per_cntdaughter}}"></span>
</td>

{{#if show_remove_btn}}
<td class="text-center p-1">
    <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
            onclick="EwsCertificate.listview.removeChildrenDaughterInfo({{per_cntdaughter}});">
        <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
    </button>
</td>
{{/if}}
</tr>
