<tr id="service_info_{{per_cnt_ser}}" class="service_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt_ser}}">
        <span class="display-cnt-ser f-w-b">{{per_cnt_ser}}</span>
    </td>
    <td>
        <input type="text" id="company_name_{{per_cnt_ser}}"
               maxlength="100" class="form-control" value="{{company_name}}" placeholder="Enter Name of Company !">
               
        <span class="error-message error-message-domicile-company_name_{{per_cnt_ser}}"></span>
    </td>
    <td class="p-1">
        <textarea id="company_address_{{per_cnt_ser}}"
               maxlength="100" class="form-control" placeholder="Enter Address of Company !">{{company_address}}</textarea>
               
        <span class="error-message error-message-domicile-company_address_{{per_cnt_ser}}"></span>
    </td>
    <td>
        <div class="input-group date" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{joining_date}}"  id="joining_date_{{per_cnt_ser}}" onblur="Domicile.listview.calculateAutoPeriod('service_total_period','{{per_cnt_ser}}','joining_date_','reliving_date_');Domicile.listview.getServiceTotalPeriod();">
            <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-domicile-joining_date_{{per_cnt_ser}}"></span>
    </td>
    <td>
        <div class="input-group date" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{reliving_date}}"  id="reliving_date_{{per_cnt_ser}}" onblur="Domicile.listview.calculateAutoPeriod('service_total_period','{{per_cnt_ser}}','joining_date_','reliving_date_');Domicile.listview.getServiceTotalPeriod();">
            <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-domicile-reliving_date_{{per_cnt_ser}}"></span>
    </td>
    <!-- <td>
        <input type="text" id="service_total_period_{{per_cnt_ser}}"
               maxlength="100" class="form-control" value="{{service_total_period}}" placeholder="Enter Total Period !" onblur="Domicile.listview.getServiceTotalPeriod();">
               
        <span class="error-message error-message-domicile-service_total_period_{{per_cnt_ser}}"></span>
    </td> -->
    <td>
        <input type="text" id="service_total_period_in_year_{{per_cnt_ser}}"
               maxlength="100" class="form-control" value="{{service_total_period_in_year}}" placeholder="Year !" onblur="Domicile.listview.getServiceTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-service_total_period_in_year_{{per_cnt_ser}}"></span>
    </td>
    <td>
        <input type="text" id="service_total_period_in_month_{{per_cnt_ser}}"
               maxlength="100" class="form-control" value="{{service_total_period_in_month}}" placeholder="Month !" onblur="Domicile.listview.getServiceTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-service_total_period_in_month_{{per_cnt_ser}}"></span>
    </td>
    <td>
        <input type="text" id="service_total_period_in_days_{{per_cnt_ser}}"
               maxlength="100" class="form-control" value="{{service_total_period_in_days}}" placeholder="Days !" onblur="Domicile.listview.getServiceTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-service_total_period_in_days_{{per_cnt_ser}}"></span>
    </td>
    <td>
        <input type="text" id="service_remarks_{{per_cnt_ser}}"
               maxlength="100" class="form-control" value="{{service_remarks}}" placeholder="Enter Remarks !">
               
        <span class="error-message error-message-domicile-service_remarks_{{per_cnt_ser}}"></span>
    </td>
    
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="Domicile.listview.removeServiceInfo({{per_cnt_ser}});Domicile.listview.getServiceTotalPeriod();">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
