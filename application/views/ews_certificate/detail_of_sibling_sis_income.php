<tr id="detail_of_sibling_sis_income_{{per_cntsisincome}}" class="detail_of_sibling_sis_income" style="background-color: #fff;">
    <!-- <td class="text-center v-a-m" style="padding: .75rem;"> -->
<input type="hidden" class='temp_cnt' value="{{per_cntsisincome}}">
<!-- <span class="display-cnt f-w-b">{{per_cntsisincome}}</span> -->
<!-- </td> -->
<td class="p-1">
    <input type="text" id="sibling_sis_salary_detail_for_ec_{{per_cntsisincome}}"
           maxlength="100" class="form-control" value="{{sibling_sis_sallary}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_sis','sibling_sis_income_for_ec_{{per_cntsisincome}}',{{per_cntsisincome}});" placeholder="Enter Income of Salary !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_sis_salary_detail_for_ec_{{per_cntsisincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_sis_business_detail_for_ec_{{per_cntsisincome}}"
           maxlength="100" class="form-control" value="{{sibling_sis_business}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_sis','sibling_sis_income_for_ec_{{per_cntsisincome}}',{{per_cntsisincome}});" placeholder="Enter Income of Business !"
           {{readonly}} onkeyup="checkNumeric($(this));">
    <span class="error-message error-message-ews-certificate-sibling_sis_business_detail_for_ec_{{per_cntsisincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_sis_agri_detail_for_ec_{{per_cntsisincome}}"
           maxlength="100" class="form-control" value="{{sibling_sis_agri}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_sis','sibling_sis_income_for_ec_{{per_cntsisincome}}',{{per_cntsisincome}});" placeholder="Enter Enter Income of Agriculture !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_sis_agri_detail_for_ec_{{per_cntsisincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_sis_profe_detail_for_ec_{{per_cntsisincome}}"
           maxlength="100" class="form-control" value="{{sibling_sis_proffe}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_sis','sibling_sis_income_for_ec_{{per_cntsisincome}}',{{per_cntsisincome}});" placeholder="Enter Income of Profession !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_sis_profe_detail_for_ec_{{per_cntsisincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_sis_other_detail_for_ec_{{per_cntsisincome}}"
           maxlength="100" class="form-control" value="{{sibling_sis_other_sour}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_sis','sibling_sis_income_for_ec_{{per_cntsisincome}}',{{per_cntsisincome}}); EwsCertificate.listview.getGrandIncomeTotal();" placeholder="Enter Enter Other Source !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_sis_other_detail_for_ec_{{per_cntsisincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_sis_income_for_ec_{{per_cntsisincome}}"
           maxlength="100" class="form-control txtCal" onblur="EwsCertificate.listview.getGrandIncomeTotal();" value="{{sibling_sis_income}}" placeholder="Enter Total Income !" readonly>
</td>


</tr>
