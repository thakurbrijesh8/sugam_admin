<div class="form-group col-sm-6">
    <div class="amount_of_year_for_ld_info">
        <input type="hidden" class='temp_cnt' value="{{notice_year}}">
        <input type="hidden" id="notice_year_for_landtax_agriculture" name="notice_year_for_landtax_agriculture" value="{{current_year}}">
        <label>{{display_index}}. Amount of {{notice_year}} <span style = "color: red;">*</span></label>
        <input type = "text" id = "tax_amount_for_landtax_agriculture_{{notice_year}}" 
               name = "tax_amount_for_landtax_agriculture_{{notice_year}}" class = "form-control" placeholder = "Enter Amount" value = "{{amount}}" 
               onblur = "checkValidation('landtax-agriculture', 'tax_amount_for_landtax_agriculture_{{notice_year}}', amountValidationMessage);" {{read_only}}>
        <span class = "error-message error-message-landtax-agriculture-tax_amount_for_landtax_agriculture_{{notice_year}}"></span>
    </div>
</div>
