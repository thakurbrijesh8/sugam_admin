<tr id="marriage_certificate_witness_info_{{per_cnt}}" class="marriage_certificate_witness_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt}}">
        <span class="display-cnt f-w-b">{{per_cnt}}</span>
    </td>
    <td class="p-1">
        <input type="text" id="witness_name_for_marriage_certificate_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{witness_name}}" placeholder="Enter Witness Name !"
               {{readonly}} onblur="checkValidation('marriage-certificate', 'witness_name_for_marriage_certificate_{{per_cnt}}', witnessNameValidationMessage);">
        <span class="error-message error-message-marriage-certificate-witness_name_for_marriage_certificate_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="age_for_marriage_certificate_{{per_cnt}}"
               maxlength="3" class="form-control" value="{{witness_age}}" placeholder="Enter Age !"
               {{readonly}} onblur="checkValidation('marriage-certificate', 'age_for_marriage_certificate_{{per_cnt}}', ageValidationMessage);">
        <span class="error-message error-message-marriage-certificate-age_for_marriage_certificate_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <select id="occupation_for_marriage_certificate_{{per_cnt}}" name="occupation_for_marriage_certificate_{{per_cnt}}" class="form-control select2" data-placeholder="Select Occupation" style="width: 100%;" onChange="checkValidation('marriage-certificate', 'occupation_for_marriage_certificate_{{per_cnt}}', oneOptionValidationMessage);">
        </select>
        <span class="error-message error-message-marriage-certificate-occupation_for_marriage_certificate_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <textarea name="witness_address_for_marriage_certificate_{{per_cnt}}"
                id="witness_address_for_marriage_certificate_{{per_cnt}}" class="form-control" maxlength="100"
                placeholder="Enter Address" onblur="checkValidation('marriage-certificate', 'witness_address_for_marriage_certificate_{{per_cnt}}', addressValidationMessage);">{{witness_address}}</textarea>
        <span class="error-message error-message-marriage-certificate-witness_address_for_marriage_certificate_{{per_cnt}}"></span>
    </td>
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="MarriageCertificate.listview.removeWitnessInfo({{per_cnt}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
