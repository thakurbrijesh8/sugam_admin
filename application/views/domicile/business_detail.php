<tr id="business_info_{{per_cnt_bus}}" class="business_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt_bus}}">
        <span class="display-cnt-bus f-w-b">{{per_cnt_bus}}</span>
    </td>
    <td>
        <input type="text" id="business_name_{{per_cnt_bus}}"
               maxlength="100" class="form-control" value="{{business_name}}" placeholder="Enter Name of Business !">
               
        <span class="error-message error-message-domicile-business_name_{{per_cnt_bus}}"></span>
    </td>
    <td class="p-1">
        <textarea id="business_address_{{per_cnt_bus}}"
               maxlength="100" class="form-control" placeholder="Enter Address of Business !">{{business_address}}</textarea>
               
        <span class="error-message error-message-domicile-business_address_{{per_cnt_bus}}"></span>
    </td>
    <td>
        <input type="text" id="business_type_{{per_cnt_bus}}"
               maxlength="100" class="form-control" value="{{business_type}}" placeholder="Enter Type of Business !">
               
        <span class="error-message error-message-domicile-business_type_{{per_cnt_bus}}"></span>
    </td>
    <td>
        <div class="input-group date" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{start_business_date}}"  id="start_business_date_{{per_cnt_bus}}" onblur="Domicile.listview.calculateAutoPeriod('business_total_period','{{per_cnt_bus}}','start_business_date_','end_business_date_');Domicile.listview.getBusinessTotalPeriod();">
            <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-domicile-start_business_date_{{per_cnt_bus}}"></span>
    </td>
    <td>
        <div class="input-group date" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{end_business_date}}"  id="end_business_date_{{per_cnt_bus}}" onblur="Domicile.listview.calculateAutoPeriod('business_total_period','{{per_cnt_bus}}','start_business_date_','end_business_date_');Domicile.listview.getBusinessTotalPeriod();">
            <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-domicile-end_business_date_{{per_cnt_bus}}"></span>
    </td>
    <!-- <td>
        <input type="text" id="business_total_period_{{per_cnt_bus}}"
               maxlength="100" class="form-control" value="{{business_total_period}}" placeholder="Enter Total Period !" onblur="Domicile.listview.getBusinessTotalPeriod();">
               
        <span class="error-message error-message-domicile-business_total_period_{{per_cnt_bus}}"></span>
    </td> -->
    <td>
        <input type="text" id="business_total_period_in_year_{{per_cnt_bus}}"
               maxlength="100" class="form-control" value="{{business_total_period_in_year}}" placeholder="Year !" onblur="Domicile.listview.getBusinessTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-business_total_period_in_year_{{per_cnt_bus}}"></span>
    </td>
    <td>
        <input type="text" id="business_total_period_in_month_{{per_cnt_bus}}"
               maxlength="100" class="form-control" value="{{business_total_period_in_month}}" placeholder="Month !" onblur="Domicile.listview.getBusinessTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-business_total_period_in_month_{{per_cnt_bus}}"></span>
    </td>
    <td>
        <input type="text" id="business_total_period_in_days_{{per_cnt_bus}}"
               maxlength="100" class="form-control" value="{{business_total_period_in_days}}" placeholder="Days !" onblur="Domicile.listview.getBusinessTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-business_total_period_in_days_{{per_cnt_bus}}"></span>
    </td>
    <td>
        <input type="text" id="business_remarks_{{per_cnt_bus}}"
               maxlength="100" class="form-control" value="{{business_remarks}}" placeholder="Enter Remarks !">
               
        <span class="error-message error-message-domicile-business_remarks_{{per_cnt_bus}}"></span>
    </td>
    
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="Domicile.listview.removeBusinessInfo({{per_cnt_bus}});Domicile.listview.getBusinessTotalPeriod();">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
