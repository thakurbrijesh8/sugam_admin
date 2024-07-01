<input type="text" id="circle_rate_for_ucr_{{pmv_cr_id}}" class="form-control text-right"
       onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this)); roundOff($(this)); 
                   checkValidation('ucr', 'circle_rate_for_ucr_{{pmv_cr_id}}', rateValidationMessage);"
       placeholder="Circle Rate !" maxlength="7" value="{{pmv_rate}}">
<span class="error-message error-message-ucr-circle_rate_for_ucr_{{pmv_cr_id}}"></span>