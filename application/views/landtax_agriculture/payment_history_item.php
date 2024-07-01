<tr>
    <td class="text-center">{{temp_cnt}}</td>
    <td class="text-center">{{created_type_text}}<hr class="m-0">{{payment_type_text}}</td>
    <td class="text-center">{{application_number}}<hr class="m-0">{{op_transaction_datetime_text}}</td>
    <td class="text-center">{{khata_number}}<hr class="m-0">{{village_name}}</td>
    <td class="f-s-12px">{{occupant_name}}</td>
    <td class="text-right">{{total_amount}}/-</td>
    <td class="text-center">{{reference_id}}</td>
    <td class="text-center">{{{op_status_text}}}</td>
    <td>{{{op_message_text}}}</td>
    <td class="text-center">
        {{#if show_dvd_btn}}
        <button type="button" class="btn btn-sm btn-nic-blue" style="padding: 2px 7px;" title="View Payment / Double Verification Details"
                onclick="Dashboard.listview.getBasicOPHDetails($(this),'{{fees_payment_id}}');">
            <i class="fas fa-check-double"></i></button>
        {{/if}}
        
        <button type="button" class="btn btn-sm btn-danger" style="padding: 2px 7px;" title="T.R.5"
                onclick="LandTaxAgriculture.listview.downloadTRFive('{{landtax_agriculture_payment_id}}');">
            <i class="fas fa-file-pdf"></i></button>
     
    </td>
</tr>