<tr id="detail_of_son_income_{{per_cntsonincome}}" class="detail_of_son_income" style="background-color: #fff;">
    <!-- <td class="text-center v-a-m" style="padding: .75rem;"> -->
<input type="hidden" class='temp_cnt' value="{{per_cntsonincome}}">
<!-- <span class="display-cnt f-w-b">{{per_cntsonincome}}</span> -->
<!-- </td> -->
<td class="p-1">
    <input type="text" id="son_salary_detail_for_ec_{{per_cntsonincome}}"
           maxlength="100" class="form-control" value="{{son_sallary}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('son','son_income_for_ec_{{per_cntsonincome}}',{{per_cntsonincome}});" placeholder="Enter Income of Salary !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-son_salary_detail_for_ec_{{per_cntsonincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="son_business_detail_for_ec_{{per_cntsonincome}}"
           maxlength="100" class="form-control" value="{{son_business}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('son','son_income_for_ec_{{per_cntsonincome}}',{{per_cntsonincome}});" placeholder="Enter Income of Business !"
           {{readonly}} onkeyup="checkNumeric($(this));">
    <span class="error-message error-message-ews-certificate-son_business_detail_for_ec_{{per_cntsonincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="son_agri_detail_for_ec_{{per_cntsonincome}}"
           maxlength="100" class="form-control" value="{{son_agri}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('son','son_income_for_ec_{{per_cntsonincome}}',{{per_cntsonincome}});" placeholder="Enter Enter Income of Agriculture !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-son_agri_detail_for_ec_{{per_cntsonincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="son_profe_detail_for_ec_{{per_cntsonincome}}"
           maxlength="100" class="form-control" value="{{son_proffe}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('son','son_income_for_ec_{{per_cntsonincome}}',{{per_cntsonincome}});" placeholder="Enter Income of Profession !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-son_profe_detail_for_ec_{{per_cntsonincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="son_other_detail_for_ec_{{per_cntsonincome}}"
           maxlength="100" class="form-control" value="{{son_other_sour}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('son','son_income_for_ec_{{per_cntsonincome}}',{{per_cntsonincome}}); EwsCertificate.listview.getGrandIncomeTotal();" placeholder="Enter Enter Other Source !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-son_other_detail_for_ec_{{per_cntsonincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="son_income_for_ec_{{per_cntsonincome}}"
           maxlength="100" class="form-control txtCal" onblur="EwsCertificate.listview.getGrandIncomeTotal();" value="{{son_income}}" placeholder="Enter Total Income !" readonly>
</td>


</tr>
