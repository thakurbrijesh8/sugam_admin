<tr id="detail_of_income_asset_info_{{per_cnt}}" class="detail_of_income_asset_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt}}">
        <span class="display-cnt f-w-b">{{per_cnt}}</span>
    </td>
    <td class="p-1">
        <input type="text" id="issuing_authority_for_ec_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{issuing_authority}}" placeholder="Enter Detail of Issuing Authority !"
               {{readonly}}>
        <span class="error-message error-message-ews-certificate-issuing_authority_for_ec_{{per_cnt}}"></span>
    </td>
    <td class="p-1">
        <input type="text" id="certificate_no_for_ec_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{certificate_no}}" placeholder="Enter Certificate No. !"
               {{readonly}} onkeyup="checkNumeric($(this));">
        <span class="error-message error-message-ews-certificate-certificate_no_for_ec_{{per_cnt}}"></span>
    </td>
    <td>
        <div class="input-group date" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{issue_date}}"  id="issue_date_{{per_cnt}}">
            <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-ews-certificate-issue_date_{{per_cnt}}"></span>
    </td>
    <td>
        <div class="input-group date" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{valid_up_to_date}}"  id="valid_up_to_date_{{per_cnt}}">
            <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-ews-certificate-valid_up_to_date_{{per_cnt}}"></span>
    </td>
    
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="EwsCertificate.listview.removeIncomeCerty({{per_cnt}});">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
