<tr id="detail_of_birth_stay_period_info_{{per_cnt}}" class="detail_of_birth_stay_period_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt_bsp' value="{{per_cnt}}">
        <span class="display-cnt f-w-b">{{per_cnt}}</span>
    </td>
    <td class="p-1">
        <select id="born_place_state_for_ec_{{per_cnt}}" name="born_place_state" class="form-control select2" data-placeholder="Select State/UT" onchange="checkValidation('ews-certificate', 'born_place_state_for_ec_{{per_cnt}}', selectStateValidationMessage);EwsCertificate.listview.getDistrictData($(this), 'ec_{{per_cnt}}', 'born_place');" style="width: 100%">
        </select>
        <span class="error-message error-message-ews-certificate-born_place_state_for_ec_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <select id="born_place_district_for_ec_{{per_cnt}}" name="born_place_district" class="form-control select2"data-placeholder="Select District" onchange="checkValidation('ews-certificate', 'born_place_district_for_ec_{{per_cnt}}', selectDistrictValidationMessage);EwsCertificate.listview.getVillageData($(this), 'ec_{{per_cnt}}', 'born_place');" style="width: 100%">
        </select>
        <span class="error-message error-message-ews-certificate-born_place_district_for_ec_{{per_cnt}}"></span>
    </td>
    <td>
        <select id="born_place_village_for_ec_{{per_cnt}}" name="born_place_village" class="form-control select2"data-placeholder="Select Village" onchange="checkValidation('ews-certificate', 'born_place_village_for_ec_{{per_cnt}}', selectVillageValidationMessage);" style="width: 100%">
        </select>
        <span class="error-message error-message-ews-certificate-born_place_village_for_ec_{{per_cnt}}"></span>
    </td>
    <td>
        <input type="text" id="born_tehsil_for_ec_{{per_cnt}}" name="born_tehsil" class="form-control" placeholder="Enter Tehsil !" maxlength="20" onblur="checkValidation('ews-certificate', 'born_tehsil_for_ec_{{per_cnt}}', tehsilValidationMessage);" value="{{born_place_tehsil}}" style="width: 100%">
        <span class="error-message error-message-ews-certificate-born_tehsil_for_ec_{{per_cnt}}"></span>
    </td>
    <td>
        <input type="text" id="born_period_for_ec_{{per_cnt}}" name="born_period" class="form-control" placeholder="Enter Stay Period !" maxlength="6" onblur="checkValidation('ews-certificate', 'born_period_for_ec_{{per_cnt}}', bornPeriodValidationMessage);" value="{{born_period}}" style="width: 100%">
        <span class="error-message error-message-ews-certificate-born_period_for_ec_{{per_cnt}}"></span>
    </td>

    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="EwsCertificate.listview.removeBirthStayPeriodInfo({{per_cnt}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
