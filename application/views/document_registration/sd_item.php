<tr id="sd_row_{{sd_cnt}}" class="sd_row">
    <td style="width: 30px;" class="text-center sd-cnt v-a-m f-w-b"></td>
    <td style="vertical-align: top !important;">
        <input type="hidden" class="og_sd_cnt" value="{{sd_cnt}}" />
        <input type="text" class="form-control" id="sd_paper_number_for_sdd_{{sd_cnt}}"
               onblur="checkValidation('sdd','sd_paper_number_for_sdd_{{sd_cnt}}', sdPaperValidationMessage)"
               placeholder="Stamp Paper Number !" maxlength="50" value="{{sd_paper_number}}" 
               {{#if is_allow_changes}}{{else}}disabled{{/if}}>
        <span class="error-message error-message-sdd-sd_paper_number_for_sdd_{{sd_cnt}}"></span>
    </td>
    <td style="vertical-align: top !important;">
        <input type="text" class="form-control text-right sd_amount_for_sdd" id="sd_amount_for_sdd_{{sd_cnt}}"
               onblur="checkValidation('sdd','sd_amount_for_sdd_{{sd_cnt}}', sdValidationMessage);"
               onkeyup="DocumentRegistration.listview.sdCalculation();" placeholder="Stamp Duty Amount !"
               maxlength="10" value="{{sd_amount}}"
               {{#if is_allow_changes}}{{else}}disabled{{/if}}>
        <span class="error-message error-message-sdd-sd_amount_for_sdd_{{sd_cnt}}"></span>
    </td>
    {{#if is_allow_changes}}
    <td class="text-center">
        <button type="button" class="btn btn-sm btn-danger"
                onclick="DocumentRegistration.listview.removeSDRow({{sd_cnt}});" style="cursor: pointer;">
            <i class="fa fa-trash"></i>
        </button>
    </td>
    {{/if}}
</tr>