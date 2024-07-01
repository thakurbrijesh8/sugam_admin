<tr id="petitioner_info_for_dapvr_case_{{pet_cnt}}" class="petitioner_info_for_dapvr_case" style="background-color: #fff;">
    <td style="width: 5px;" class="text-center">
        <input type="hidden" class='temp_pet_cnt' value="{{pet_cnt}}"><span class="pet-display-cnt f-w-b">{{pet_cnt}}</span>
    </td>
    <td style="vertical-align: top !important;">
        <input type="text" id="name_of_petitioner_for_dapvr_case_{{pet_cnt}}" maxlength="100" class="form-control" 
               onblur="checkValidation('dapvr_case', 'name_of_petitioner_for_dapvr_case_{{pet_cnt}}', nameValidationMessage);" 
               placeholder="Name of the Petitioner" value="{{pet_name}}">
        <span class="error-message error-message-dapvr_case-name_of_petitioner_for_dapvr_case_{{pet_cnt}}"></span> 
    </td >
    <td style="vertical-align: top !important;">
        <textarea id="address_of_petitioner_for_dapvr_case_{{pet_cnt}}" maxlength="200" class="form-control" 
                  onblur="checkValidation('dapvr_case', 'address_of_petitioner_for_dapvr_case_{{pet_cnt}}', addressValidationMessage);"
                  placeholder="Address of Petitioner">{{pet_address}}</textarea>
        <span class="error-message error-message-dapvr_case-address_of_petitioner_for_dapvr_case_{{pet_cnt}}"></span> 
    </td>
    <td style="vertical-align: top !important;">
        <select id="pet_adv_name_for_dapvr_case_{{pet_cnt}}" name="pet_adv_name_for_dapvr_case_{{pet_cnt}}"
                class="form-control select2 temp-advocate-list" 
                data-placeholder="Select Advocate" style="width: 100%;" >
        </select>
<!--        <input type="text" id="pet_adv_name_for_dapvr_case_{{pet_cnt}}" maxlength="50" class="form-control"                
               placeholder="Name of Advocate" value="{{pet_adv_name}}">-->
        <span class="error-message error-message-dapvr_case-pet_adv_name_for_dapvr_case_{{pet_cnt}}"></span> 
    </td>
    <!--onblur="checkValidation('dapvr_case', 'pet_adv_name_for_dapvr_case_{{pet_cnt}}', advnameValidationMessage);"--> 
    <td style="vertical-align: top !important;">
        <input type="text" id="pet_adv_mobno_for_dapvr_case_{{pet_cnt}}" class="form-control"
               onblur="checkValidationForMobileNumberForOnlyEnter('dapvr_case', 'pet_adv_mobno_for_dapvr_case_{{pet_cnt}}')" 
               placeholder="Mobile Number" maxlength="10"  onkeyup="checkNumeric($(this));"               
               value="{{pet_adv_mobno}}">
        <span class="error-message error-message-dapvr_case-pet_adv_mobno_for_dapvr_case_{{pet_cnt}}"></span> 
    </td>
    <!--checkValidationForMobileNumber('dapvr_case', 'pet_adv_mobno_for_dapvr_case_{{pet_cnt}}');checkValidation('dapvr_case', 'pet_adv_mobno_for_dapvr_case_{{pet_cnt}}', mobileValidationMessage);-->
    <td style="vertical-align: top !important;">
        <input type="text" id="pet_adv_email_for_dapvr_case_{{pet_cnt}}" maxlength="50" class="form-control" 
               onblur="checkValidationForEmail('dapvr_case', 'pet_adv_email_for_dapvr_case_{{pet_cnt}}');" 
               placeholder="Email Id" value="{{pet_adv_email}}">
        <span class="error-message error-message-dapvr_case-pet_adv_email_for_dapvr_case_{{pet_cnt}}"></span> 
    </td>
    <!--checkValidation('dapvr_case', 'pet_adv_email_for_dapvr_case_{{pet_cnt}}', emailValidationMessage);-->
    {{#if show_remove_btn}}
    <td class="text-center v-a-m" class="p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="DAPVRCase.listview.removePetitionerInfo({{pet_cnt}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
