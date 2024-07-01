<tr id="detail_of_sibling_bro_income_{{per_cntbroincome}}" class="detail_of_sibling_bro_income" style="background-color: #fff;">
    <!-- <td class="text-center v-a-m" style="padding: .75rem;"> -->
<input type="hidden" class='temp_cnt' value="{{per_cntbroincome}}">
<!-- <span class="display-cnt f-w-b">{{per_cntbroincome}}</span> -->
<!-- </td> -->
<td class="p-1">
    <input type="text" id="sibling_bro_salary_detail_for_ec_{{per_cntbroincome}}"
           maxlength="100" class="form-control" value="{{sibling_bro_sallary}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_bro','sibling_bro_income_for_ec_{{per_cntbroincome}}',{{per_cntbroincome}});" placeholder="Enter Income of Salary !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_bro_salary_detail_for_ec_{{per_cntbroincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_bro_business_detail_for_ec_{{per_cntbroincome}}"
           maxlength="100" class="form-control" value="{{sibling_bro_business}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_bro','sibling_bro_income_for_ec_{{per_cntbroincome}}',{{per_cntbroincome}});" placeholder="Enter Income of Business !"
           {{readonly}} onkeyup="checkNumeric($(this));">
    <span class="error-message error-message-ews-certificate-sibling_bro_business_detail_for_ec_{{per_cntbroincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_bro_agri_detail_for_ec_{{per_cntbroincome}}"
           maxlength="100" class="form-control" value="{{sibling_bro_agri}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_bro','sibling_bro_income_for_ec_{{per_cntbroincome}}',{{per_cntbroincome}});" placeholder="Enter Enter Income of Agriculture !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_bro_agri_detail_for_ec_{{per_cntbroincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_bro_profe_detail_for_ec_{{per_cntbroincome}}"
           maxlength="100" class="form-control" value="{{sibling_bro_proffe}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_bro','sibling_bro_income_for_ec_{{per_cntbroincome}}',{{per_cntbroincome}});" placeholder="Enter Income of Profession !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_bro_profe_detail_for_ec_{{per_cntbroincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_bro_other_detail_for_ec_{{per_cntbroincome}}"
           maxlength="100" class="form-control" value="{{sibling_bro_other_sour}}" onblur="EwsCertificate.listview.getYearlyIncomeTotal('sibling_bro','sibling_bro_income_for_ec_{{per_cntbroincome}}',{{per_cntbroincome}}); EwsCertificate.listview.getGrandIncomeTotal();" placeholder="Enter Enter Other Source !"
           {{readonly}}>
    <span class="error-message error-message-ews-certificate-sibling_bro_other_detail_for_ec_{{per_cntbroincome}}"></span>
</td>
<td class="p-1">
    <input type="text" id="sibling_bro_income_for_ec_{{per_cntbroincome}}"
           maxlength="100" class="form-control txtCal" value="{{sibling_bro_income}}" placeholder="Enter Total Income !" readonly onblur="EwsCertificate.listview.getGrandIncomeTotal();">
</td>


</tr>
