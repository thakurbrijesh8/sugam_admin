<div class="text-center">
    <button type="button" class="btn btn-sm btn-primary" onclick="FormThree.listview.editOrViewFormThree($(this),'{{form_three_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    {{#if show_pa_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="FormThree.listview.editOrViewFormThree($(this),'{{form_three_id}}', false, true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Print Application</button>
    {{/if}}
    <?php if (!is_aci_user()) { ?>
        <button type="button" class="btn btn-sm btn-nic-blue" 
                onclick="fpMailHistory($(this),'{{module_type}}','{{form_three_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-envelope" style="margin-right: 2px;"></i> Mail History</button>
    <?php } ?>
    <?php if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user()) { ?>
        <!--        <button type="button" class="btn btn-sm btn-primary" onclick="FormThree.listview.setAppointment('{{form_three_id}}');"
                        id="appointment_btn_for_app_{{form_three_id}}"
                        style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
                    <i class="fas fa-calendar" style="margin-right: 2px;"></i> Appointment</button>-->
        {{#if show_upd_btn}}
        <button type="button" class="btn btn-sm bg-warning" onclick="getPageDetails($(this),'{{ld_module_type}}','{{module_type}}','{{form_three_id}}');"
                id="upd_btn_for_app_{{form_three_id}}"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-file-upload" style="margin-right: 2px;"></i> Update Pages & Send for Payment</button>
        {{/if}}
        <button type="button" class="btn btn-sm bg-info" onclick="viewFPaymentDetails($(this),'{{module_type}}', '{{form_three_id}}');"
                id="vpd_btn_for_app_{{form_three_id}}"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-rupee-sign" style="margin-right: 2px;"></i> View Payment Details</button>
        <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_app_{{form_three_id}}"
                onclick="FormThree.listview.getQueryData('{{form_three_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-question" style="margin-right: 5px;"></i> Raise / View Query</button>
    <?php } if (is_admin() || is_talathi_user() || is_mamlatdar_user()) { ?>
        <button type="button" class="btn btn-sm btn-success" id="approve_btn_for_app_{{form_three_id}}"
                onclick="FormThree.listview.askForApproveRejectApplication($(this), '{{form_three_id}}', {{VALUE_ONE}});"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_approve_btn}}">
            <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Approve</button>
        <button type="button" class="btn btn-sm btn-danger" id="reject_btn_for_app_{{form_three_id}}"
                onclick="FormThree.listview.askForApproveRejectApplication($(this), '{{form_three_id}}', {{VALUE_TWO}});"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_reject_btn}}">
            <i class="fas fa-times-circle" style="margin-right: 2px;"></i> Reject</button>
        <?php } ?>
</div>