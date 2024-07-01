<tr id="land_details_for_dapvr_case_{{ld_cnt}}" class="land_details_for_dapvr_case" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_ld_cnt' id="temp_ld_cnt" value="{{ld_cnt}}">
        <span class="ld-display-cnt f-w-b">{{ld_cnt}}</span>
    </td>

    <td style="vertical-align: top !important;">
        <select id="village_for_dapvr_case_{{ld_cnt}}" name="village_for_dapvr_case_{{ld_cnt}}" class="form-control select2"  data-placeholder="Select Village" style="width: 100%;" 
                onchange="checkValidation('dapvr_case', 'village_for_dapvr_case_{{ld_cnt}}', selectVillageValidationMessage);
                                    villageChangeEvent($(this), 'dapvr_case_{{ld_cnt}}', true);"
                style="width: 100%;">
        </select>
        <span class="error-message error-message-dapvr_case-village_for_dapvr_case_{{ld_cnt}}"></span>
    </td>

    <td style="vertical-align: top !important;">
        <select id="survey_number_for_dapvr_case_{{ld_cnt}}" name="survey_number_for_dapvr_case_{{ld_cnt}}" class="form-control select2"  data-placeholder="Select Survey Number" 
                onchange="checkValidation('dapvr_case', 'survey_number_for_dapvr_case_{{ld_cnt}}', selectSurveyValidationMessage);
                                            surveyNumberChangeEvent($(this), 'dapvr_case_{{ld_cnt}}', true);" 
                style="width: 100%;">
        </select>
        <span class="error-message error-message-dapvr_case-survey_number_for_dapvr_case_{{ld_cnt}}"></span>
    </td>

    <td style="vertical-align: top !important;">
        <select id="subdivision_number_for_dapvr_case_{{ld_cnt}}" name="subdivision_number_for_dapvr_case_{{ld_cnt}}" class="form-control select2"  data-placeholder="Select Subdivision Number" style="width: 100%;" 
                onchange="checkValidation('dapvr_case', 'subdivision_number_for_dapvr_case_{{ld_cnt}}', selectSubdivValidationMessage);"

                style="width: 100%;">
        </select>
        <span class="error-message error-message-dapvr_case-subdivision_number_for_dapvr_case_{{ld_cnt}}"></span>
    </td>
 {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="DAPVRCase.listview.removeLandDetails({{ld_cnt}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
{{/if}}
</tr>




