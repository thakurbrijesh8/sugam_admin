<tr id="applicant_education_info_{{per_cnt}}" class="applicant_education_info" style="background-color: #fff;">
    <td class="text-center v-a-m" style="padding: .75rem;">
        <input type="hidden" class='temp_cnt' value="{{per_cnt}}">
        <span class="display-cnt f-w-b">{{per_cnt}}</span>
    </td>
    <td class="p-1">
        <input type="text" id="name_of_school_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{name_of_school}}" placeholder="Enter Name of School !">
               
        <span class="error-message error-message-domicile-name_of_school_{{per_cnt}}"></span>
    </td>
    <td>
        <input type="text" id="class_standard_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{class_standard}}" placeholder="Enter Class !">
               
        <span class="error-message error-message-domicile-class_standard_{{per_cnt}}"></span>
    </td>
    <td>
        <div class="input-group date" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{admission_date}}"  id="admission_date_{{per_cnt}}" onblur="Domicile.listview.calculateAutoPeriod('total_period','{{per_cnt}}','admission_date_','leaving_date_');Domicile.listview.getTotalPeriod();">
            <div class="input-group-append" >
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-domicile-admission_date_{{per_cnt}}"></span>
    </td>
    <td>
        <div class="input-group date calendar" style="position: unset !important;">
            <input type="text" class= "form-control date_picker" placeholder="dd-mm-yyyy"
                   value="{{leaving_date}}"  id="leaving_date_{{per_cnt}}" onblur="Domicile.listview.calculateAutoPeriod('total_period','{{per_cnt}}','admission_date_','leaving_date_');Domicile.listview.getTotalPeriod();">
            <div class="input-group-append">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
        </div>
        <span class="error-message error-message-domicile-leaving_date_{{per_cnt}}"></span>
    </td>
    <td>
        <input type="text" id="total_period_in_year_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{total_period_in_year}}" placeholder="Year !" onblur="Domicile.listview.getTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-total_period_in_year_{{per_cnt}}"></span>
    </td>
    <td>
        <input type="text" id="total_period_in_month_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{total_period_in_month}}" placeholder="Month !" onblur="Domicile.listview.getTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-total_period_in_month_{{per_cnt}}"></span>
    </td>
    <td>
        <input type="text" id="total_period_in_days_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{total_period_in_days}}" placeholder="Days !" onblur="Domicile.listview.getTotalPeriod();" width="15px">
               
        <span class="error-message error-message-domicile-total_period_in_days_{{per_cnt}}"></span>
    </td>
    <td>
        <input type="text" id="edu_remarks_{{per_cnt}}"
               maxlength="100" class="form-control" value="{{edu_remarks}}" placeholder="Enter Remarks !">
               
        <span class="error-message error-message-domicile-edu_remarks_{{per_cnt}}"></span>
    </td>
    
    {{#if show_remove_btn}}
    <td class="text-center p-1">
        <button type="button" class="btn btn-sm btn-danger cursor-pointer" style="margin-top: 2px;"
                onclick="Domicile.listview.removeEducationInfo({{per_cnt}});Domicile.listview.getTotalPeriod();">
            <label class="fa fa-trash label-btn-icon cursor-pointer"></label>
        </button>
    </td>
    {{/if}}
</tr>
