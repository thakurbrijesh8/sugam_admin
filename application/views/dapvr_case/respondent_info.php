<tr id="respondent_info_for_dapvr_case_{{res_cnt}}" class="respondent_info_for_dapvr_case" style="background-color: #fff;">
    <td style="width: 5px;" class="text-center">
        <input type="hidden" class='temp_res_cnt' value="{{res_cnt}}"><span class="res-display-cnt f-w-b">{{res_cnt}}</span>
    </td>
    <td style="vertical-align: top !important;">
        <input type="text" id="name_of_respondent_for_dapvr_case_{{res_cnt}}" maxlength="100" class="form-control" 
               onblur="checkValidation('dapvr_case', 'name_of_respondent_for_dapvr_case_{{res_cnt}}', nameValidationMessage);" 
               placeholder="Name of the Respondent" value="{{res_name}}">
        <span class="error-message error-message-dapvr_case-name_of_respondent_for_dapvr_case_{{res_cnt}}"></span> 
    </td>
    <td style="vertical-align: top !important;">
        <textarea id="address_of_respondent_for_dapvr_case_{{res_cnt}}" maxlength="200" class="form-control" 
                  onblur="checkValidation('dapvr_case', 'address_of_respondent_for_dapvr_case_{{res_cnt}}', addressValidationMessage);"
                  placeholder="Address of Respondent">{{res_address}}</textarea>
        <span class="error-message error-message-dapvr_case-address_of_respondent_for_dapvr_case_{{res_cnt}}"></span> 
    </td>
    <td style="vertical-align: top !important;"> 
        <select id="res_adv_name_for_dapvr_case_{{res_cnt}}" name="res_adv_name_for_dapvr_case_{{res_cnt}}"
                class="form-control select2 temp-advocate-list" 
                data-placeholder="Select Advocate" style="width: 100%;" >
        </select>
        <span class="error-message error-message-dapvr_case-res_adv_name_for_dapvr_case_{{res_cnt}}"></span> 
    </td>
    <!--onblur="checkValidation('dapvr_case', 'res_adv_name_for_dapvr_case_{{res_cnt}}', advnameValidationMessage);"--> 
    <td style="vertical-align: top !important;">
        <input type="text" id="res_adv_mobno_for_dapvr_case_{{res_cnt}}" class="form-control" 
               placeholder="Mobile Number" maxlength="10" onkeyup="checkNumeric($(this));"
               onblur="checkValidationForMobileNumberForOnlyEnter('dapvr_case', 'res_adv_mobno_for_dapvr_case_{{res_cnt}}');" 
             value="{{res_adv_mobno}}">
        <span class="error-message error-message-dapvr_case-res_adv_mobno_for_dapvr_case_{{res_cnt}}"></span> 
    </td>
    <!--checkValidation('dapvr_case', 'res_adv_mobno_for_dapvr_case_{{res_cnt}}', mobileValidationMessage);--> 
    <td style="vertical-align: top !important;">
        <input type="text" id="res_adv_email_for_dapvr_case_{{res_cnt}}" maxlength="50" class="form-control" 
               onblur="checkValidationForEmail('dapvr_case', 'res_adv_email_for_dapvr_case_{{res_cnt}}');"  
               placeholder="Email Id" value="{{res_adv_email}}">
        <span class="error-message error-message-dapvr_case-res_adv_email_for_dapvr_case_{{res_cnt}}"></span> 
    </td>
    <!--checkValidation('dapvr_case', 'res_adv_email_for_dapvr_case_{{res_cnt}}', emailValidationMessage);-->
    {{#if show_remove_btn}}
    <td class="text-center v-a-m">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="DAPVRCase.listview.removeRespondentInfo({{res_cnt}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
