<tr id="residential_info_{{per_cnt_res}}" class="residential_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt_res}}">
        <span class="display-cnt-res f-w-b">{{per_cnt_res}}</span>
    </td>
    <td class="p-1">
        <textarea id="resident_address_{{per_cnt_res}}"
               maxlength="100" class="form-control" placeholder="Enter Residental Address !">{{resident_address}}</textarea>
               
        <span class="error-message error-message-domicile-resident_address_{{per_cnt_res}}"></span>
    </td>
    <td>
        <select id="type_of_resident_{{per_cnt_res}}" class="form-control select2"
                data-placeholder="Select Type of Resident" style="width: 100%;">
        </select>
        <span class="error-message error-message-domicile-type_of_resident_{{per_cnt_res}}"></span>
    </td>
    <td>
        <div class="input-group date" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{resident_date}}"  id="resident_date_{{per_cnt_res}}" onblur="Domicile.listview.calculateAutoPeriod('resident_total_period','{{per_cnt_res}}','resident_date_','resident_leaving_date_');Domicile.listview.getResidentialTotalPeriod();">
            <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-domicile-resident_date_{{per_cnt_res}}"></span>
    </td>
    <td>
        <div class="input-group date" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{resident_leaving_date}}"  id="resident_leaving_date_{{per_cnt_res}}" onblur="Domicile.listview.calculateAutoPeriod('resident_total_period','{{per_cnt_res}}','resident_date_','resident_leaving_date_');Domicile.listview.getResidentialTotalPeriod();">
            <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-domicile-resident_leaving_date_{{per_cnt_res}}"></span>
    </td>
    <!-- <td>
        <input type="text" id="resident_total_period_{{per_cnt_res}}"
               maxlength="100" class="form-control" value="{{resident_total_period}}" placeholder="Enter Total Period !" onblur="Domicile.listview.getResidentialTotalPeriod();">
               
        <span class="error-message error-message-domicile-resident_total_period_{{per_cnt_res}}"></span>
    </td> -->
    <td>
        <input type="text" id="resident_total_period_in_year_{{per_cnt_res}}"
               maxlength="100" class="form-control" value="{{resident_total_period_in_year}}" placeholder="Year !" onblur="Domicile.listview.getResidentialTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-resident_total_period_in_year_{{per_cnt_res}}"></span>
    </td>
    <td>
        <input type="text" id="resident_total_period_in_month_{{per_cnt_res}}"
               maxlength="100" class="form-control" value="{{resident_total_period_in_month}}" placeholder="Month !" onblur="Domicile.listview.getResidentialTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-resident_total_period_in_month_{{per_cnt_res}}"></span>
    </td>
    <td>
        <input type="text" id="resident_total_period_in_days_{{per_cnt_res}}"
               maxlength="100" class="form-control" value="{{resident_total_period_in_days}}" placeholder="Days !" onblur="Domicile.listview.getResidentialTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-resident_total_period_in_days_{{per_cnt_res}}"></span>
    </td>
    <td>
        <input type="text" id="resident_remarks_{{per_cnt_res}}"
               maxlength="100" class="form-control" value="{{resident_remarks}}" placeholder="Enter Remarks !">
               
        <span class="error-message error-message-domicile-resident_remarks_{{per_cnt_res}}"></span>
    </td>
    
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="Domicile.listview.removeResidentialInfo({{per_cnt_res}});Domicile.listview.getResidentialTotalPeriod();">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
