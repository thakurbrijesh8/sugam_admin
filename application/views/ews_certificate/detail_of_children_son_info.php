<tr id="detail_of_children_son_info_{{per_cntson}}" class="detail_of_children_son_info" style="background-color: #fff;">
    <!-- <td class="text-center v-a-m" style="padding: .75rem;"> -->
<input type="hidden" class='temp_cnt' value="{{per_cntson}}">
<!-- <span class="display-cnt f-w-b">{{per_cntson}}</span> -->
<!-- </td> -->
<td class="p-1">
    <input type="text" id="children_son_name_for_ec_{{per_cntson}}"
           maxlength="100" class="form-control" value="{{children_son_name}}" placeholder="Enter Name !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-children_son_name_for_ec_{{per_cntson}}"></span>
</td>
<td class="p-1">
    <input type="text" id="children_son_age_for_ec_{{per_cntson}}"
           maxlength="2" class="form-control" value="{{children_son_age}}" placeholder="Enter Age !"
           {{readonly}} onkeyup="checkNumeric($(this));">
    <span class="error-message error-message-ews-certificate-children_son_age_for_ec_{{per_cntson}}"></span>
</td>
<td class="p-1">
    <input type="text" id="children_son_occu_edu_for_ec_{{per_cntson}}"
           maxlength="100" class="form-control" value="{{children_son_occu_edu}}" placeholder="Enter Occupation / Education !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-children_son_occu_edu_for_ec_{{per_cntson}}"></span>
</td>
<td class="p-1">
    <input type="text" id="children_son_remark_for_ec_{{per_cntson}}"
           maxlength="100" class="form-control" value="{{children_son_remark}}" placeholder="Enter Remark !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-children_son_remark_for_ec_{{per_cntson}}"></span>
</td>

{{#if show_remove_btn}}
<td class="text-center p-1">
    <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
            onclick="EwsCertificate.listview.removeChildrenSonInfo({{per_cntson}});">
        <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
    </button>
</td>
{{/if}}
</tr>
