<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="edit_btn_for_app_{{obc_certificate_id}}"
            onclick="ObcCertificate.listview.editOrViewObcCertificate($(this),'{{obc_certificate_id}}', true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt" style="margin-right: 2px;"></i> Edit</button>
    {{/if}}
    {{#if show_pa_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="ObcCertificate.listview.editOrViewObcCertificate($(this),'{{obc_certificate_id}}', false, true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Print Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-primary" onclick="ObcCertificate.listview.editOrViewObcCertificate($(this),'{{obc_certificate_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    <button type="button" class="btn btn-sm btn-nic-blue" id="duplicate_details_btn_for_app_{{obc_certificate_id}}"
            onclick="duplicateDetailsOfApplicant(VALUE_FIVE,'{{obc_certificate_id}}', 'ObcCertificate.listview.editOrViewObcCertificate');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-clone" style="margin-right: 2px;"></i> Duplicate Details</button>
    <?php if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user() || is_aci_user() || is_ldc_user()) { ?>
        <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_app_{{obc_certificate_id}}"
                onclick="ObcCertificate.listview.getQueryData('{{obc_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-question" style="margin-right: 5px;"></i> Raise / View Query</button>
    <?php } ?>
    <button type="button" class="btn btn-sm bg-purple" id="scrutiny_btn_for_app_{{obc_certificate_id}}"
            onclick="ObcCertificate.listview.getDocumentData('{{obc_certificate_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 5px;"></i> Scrutiny</button>
    <?php if (is_admin() || is_talathi_user() || is_mamlatdar_user()) { ?>
        <button type="button" class="btn btn-sm btn-primary" onclick="ObcCertificate.listview.setAppointment('{{obc_certificate_id}}');" id="appointment_btn_for_app_{{obc_certificate_id}}"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-calendar" style="margin-right: 2px;"></i> Appointment</button>
    <?php } if (is_admin() || is_talathi_user() || is_aci_user() || is_ldc_user()) { ?>
        {{#if show_forward_btn}}
        <button type="button" class="btn btn-sm bg-orange" onclick="ObcCertificate.listview.updateBasicDetails($(this), '{{obc_certificate_id}}');"
                id="update_basic_detail_btn_for_app_{{obc_certificate_id}}"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-edit" style="margin-right: 2px;"></i>
            <?php
            if (is_admin()) {
                echo 'Forward';
            } else if (is_talathi_user()) {
                echo 'Forward / Update Income';
            } else if (is_aci_user()) {
                echo 'Forward for Approval';
            } else if (is_ldc_user()) {
                echo 'Forward / Correction';
            }
            ?>
        </button>
        {{/if}}
    <?php } if (is_admin() || is_mamlatdar_user()) { ?>
        <button type="button" class="btn btn-sm bg-orange text-white" id="reverification_btn_for_app_{{obc_certificate_id}}"
                onclick="ObcCertificate.listview.updateBasicDetails($(this), '{{obc_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_reverification_btn}}">
            <i class="fas fa-sync" style="margin-right: 2px;"></i> Reverification</button>
        <button type="button" class="btn btn-sm btn-success" id="approve_btn_for_app_{{obc_certificate_id}}"
                onclick="ObcCertificate.listview.askForApproveApplication('{{obc_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_approve_btn}}">
            <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Approve</button>
        <button type="button" class="btn btn-sm btn-success" id="approve_btn_for_app_{{obc_certificate_id}}"
                onclick="ObcCertificate.listview.askForApproveApplication('{{obc_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_migration_btn}}">
            <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Migrant Approve</button>
    <?php } if (is_admin() || is_mamlatdar_user() || is_aci_user() || is_talathi_user()) { ?>
        <button type="button" class="btn btn-sm btn-danger" id="reject_btn_for_app_{{obc_certificate_id}}"
                onclick="ObcCertificate.listview.askForRejectApplication('{{obc_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_reject_btn}}">
            <i class="fas fa-times-circle" style="margin-right: 2px;"></i> Reject</button>
    <?php } ?>
    <button type="button" class="btn btn-sm bg-orange"
            onclick="ObcCertificate.listview.updateBasicDetails($(this), '{{obc_certificate_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_movement_btn}}">
        <i class="fas fa-sync" style="margin-right: 2px;"></i> Movement Details</button>
    <button type="button" class="btn btn-sm btn-nic-blue" id="verify_certificate_btn_for_app_{{obc_certificate_id}}"
            onclick="ObcCertificate.listview.migrantCertificate('{{obc_certificate_id}}', VALUE_ONE);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{download_verify_certificate_migrant_style}}">
        <i class="fas fa-user-check" style="margin-right: 2px;"></i> Verify Migrant Certificate</button>
    <button type="button" class="btn btn-sm btn-nic-blue" id="download_certificate_btn_for_app1_{{obc_certificate_id}}"
            onclick="ObcCertificate.listview.migrantCertificate('{{obc_certificate_id}}', VALUE_TWO);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{download_certificate_migrant_style}}">
        <i class="fas fa-certificate" style="margin-right: 2px;"></i> Download Migrant Certificate</button>
    <button type="button" class="btn btn-sm btn-nic-blue" id="verify_certificate_btn_for_app_{{obc_certificate_id}}"
            onclick="ObcCertificate.listview.downloadCertificate('{{obc_certificate_id}}', VALUE_ONE);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{download_verify_certificate_style}}">
        <i class="fas fa-user-check" style="margin-right: 2px;"></i> Verify Certificate</button>
    <button type="button" class="btn btn-sm btn-nic-blue" id="download_certificate_btn_for_app_{{obc_certificate_id}}"
            onclick="ObcCertificate.listview.downloadCertificate('{{obc_certificate_id}}', VALUE_TWO);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{download_certificate_style}}">
        <i class="fas fa-certificate" style="margin-right: 2px;"></i> Download Certificate</button>
</div>