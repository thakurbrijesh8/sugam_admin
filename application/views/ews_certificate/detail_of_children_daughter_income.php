<tr id="detail_of_daughter_income_{{per_cntdaughterincome}}" class="detail_of_daughter_income" style="background-color: #fff;">
    <!-- <td class="text-center v-a-m" style="padding: .75rem;"> -->
<input type="hidden" class='temp_cnt' value="{{per_cntdaughterincome}}">
<!-- <span class="display-cnt f-w-b">{{per_cntdaughterincome}}</span> -->
<!-- </td> -->
<td class="p-1">
    <input type="text" id="daughter_salary_detail_for_ec_{{per_cntdaughterincome}}"
           maxlength="100" class="form-control" value="{{daughter_sallary}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('daughter','daughter_income_for_ec_{{per_cntdaughterincome}}',{{per_cntdaughterincome}});" placeholder="Enter Income of Salary !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-daughter_salary_detail_for_ec_{{per_cntdaughterincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="daughter_business_detail_for_ec_{{per_cntdaughterincome}}"
           maxlength="100" class="form-control" value="{{daughter_business}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('daughter','daughter_income_for_ec_{{per_cntdaughterincome}}',{{per_cntdaughterincome}});" placeholder="Enter Income of Business !"
           {{readonly}} onkeyup="checkNumeric($(this));">
    <span class="error-message error-message-ews-certificate-daughter_business_detail_for_ec_{{per_cntdaughterincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="daughter_agri_detail_for_ec_{{per_cntdaughterincome}}"
           maxlength="100" class="form-control" value="{{daughter_agri}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('daughter','daughter_income_for_ec_{{per_cntdaughterincome}}',{{per_cntdaughterincome}});" placeholder="Enter Income of Agriculture !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-daughter_agri_detail_for_ec_{{per_cntdaughterincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="daughter_profe_detail_for_ec_{{per_cntdaughterincome}}"
           maxlength="100" class="form-control" value="{{daughter_proffe}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('daughter','daughter_income_for_ec_{{per_cntdaughterincome}}',{{per_cntdaughterincome}});" placeholder="Enter Income of Profession !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-daughter_profe_detail_for_ec_{{per_cntdaughterincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="daughter_other_detail_for_ec_{{per_cntdaughterincome}}"
           maxlength="100" class="form-control" value="{{daughter_other_sour}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('daughter','daughter_income_for_ec_{{per_cntdaughterincome}}',{{per_cntdaughterincome}}); EwsCertificate.listview.getGrandIncomeTotal();" placeholder="Enter Other Source !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-daughter_other_detail_for_ec_{{per_cntdaughterincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="daughter_income_for_ec_{{per_cntdaughterincome}}"
           maxlength="100" class="form-control txtCal" onblur="EwsCertificate.listview.getGrandIncomeTotal();" value="{{daughter_income}}" placeholder="Total Income !" readonly>
</td>


</tr>
