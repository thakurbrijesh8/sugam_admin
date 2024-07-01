<tr id="detail_of_sibling_bro_info_{{per_cntbro}}" class="detail_of_sibling_bro_info" style="background-color: #fff;">
    <!-- <td class="text-center v-a-m" style="padding: .75rem;"> -->
<input type="hidden" class='temp_cnt' value="{{per_cntbro}}">
<!-- <span class="display-cnt f-w-b">{{per_cntbro}}</span> -->
<!-- </td> -->
<td class="p-1">
    <input type="text" id="sibling_bro_name_for_ec_{{per_cntbro}}"
           maxlength="100" class="form-control" value="{{sibling_bro_name}}" placeholder="Enter Name !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_bro_name_for_ec_{{per_cntbro}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_bro_age_for_ec_{{per_cntbro}}"
           maxlength="2" class="form-control" value="{{sibling_bro_age}}" placeholder="Enter Age !"
           {{readonly}} onkeyup="checkNumeric($(this));">
    <span class="error-message error-message-ews-certificate-sibling_bro_age_for_ec_{{per_cntbro}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_bro_occu_edu_for_ec_{{per_cntbro}}"
           maxlength="100" class="form-control" value="{{sibling_bro_occu_edu}}" placeholder="Enter Occupation / Education !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_bro_occu_edu_for_ec_{{per_cntbro}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_bro_remark_for_ec_{{per_cntbro}}"
           maxlength="100" class="form-control" value="{{sibling_bro_remark}}" placeholder="Enter Remark !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_bro_remark_for_ec_{{per_cntbro}}"></span>
</td>

{{#if show_remove_btn}}
<td class="text-center p-1">
    <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
            onclick="EwsCertificate.listview.removeSiblingBroInfo({{per_cntbro}}); EwsCertificate.listview.removeSiblingBroIncome({{per_cntbro}});">
        <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
    </button>
</td>
{{/if}}
</tr>
