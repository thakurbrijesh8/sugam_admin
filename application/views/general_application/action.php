<div class="text-center">
    <button type="button" class="btn btn-sm btn-primary" onclick="GeneralApplication.listview.editOrViewGeneralApplication($(this),'{{general_application_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    {{#if show_pa_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="GeneralApplication.listview.editOrViewGeneralApplication($(this),'{{general_application_id}}', false, true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Print Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_app_{{general_application_id}}"
            onclick="GeneralApplication.listview.getQueryData('{{general_application_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-question" style="margin-right: 5px;"></i> Raise / View Query</button>
    {{#if show_fw_btn}}
    <button type="button" class="btn btn-sm bg-orange" onclick="GeneralApplication.listview.forwardApplication($(this), '{{general_application_id}}');"
            id="forward_application_btn_for_app_{{general_application_id}}"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-edit" style="margin-right: 2px;"></i> Forward</button>
    {{/if}}
    <button type="button" class="btn btn-sm bg-purple" onclick="GeneralApplication.listview.getReportData('{{general_application_id}}');"
            id="report_btn_for_app_{{general_application_id}}"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file" style="margin-right: 2px;"></i> Report</button>
    <?php if (is_admin() || is_talathi_user() || is_mamlatdar_user()) { ?>
        <button type="button" class="btn btn-sm btn-success" id="approve_btn_for_app_{{general_application_id}}"
                onclick="GeneralApplication.listview.askForApproveRejectApplication($(this), '{{general_application_id}}', {{VALUE_ONE}});"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_approve_btn}}">
            <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Approve</button>
    <?php } ?>
    <?php if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_aci_user() || is_ldc_user()) { ?>
        <button type="button" class="btn btn-sm btn-danger" id="reject_btn_for_app_{{general_application_id}}"
                onclick="GeneralApplication.listview.askForApproveRejectApplication($(this), '{{general_application_id}}', {{VALUE_TWO}});"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_reject_btn}}">
            <i class="fas fa-times-circle" style="margin-right: 2px;"></i> Reject</button>
    <?php } ?>
    {{#if show_dwn_btn}}
    <button type="button" class="btn btn-sm btn-nic-blue" id="download_certificate_btn_for_app_{{general_application_id}}"
            onclick="GeneralApplication.listview.downloadCertificate('{{general_application_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-certificate" style="margin-right: 2px;"></i> Download Certificate</button>
    {{/if}}
</div>