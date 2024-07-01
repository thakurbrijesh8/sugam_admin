<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" onclick="DeathCertificate.listview.editOrViewDeathCertificate($(this),'{{death_certificate_id}}', true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt" style="margin-right: 2px;"></i> Edit</button>
    {{/if}}
    {{#if show_pa_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="DeathCertificate.listview.editOrViewDeathCertificate($(this),'{{death_certificate_id}}', false, true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Print Application</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-primary" onclick="DeathCertificate.listview.editOrViewDeathCertificate($(this),'{{death_certificate_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    <?php if (is_admin() || is_subr_user() || is_subr_ver_user()) { ?>
    <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_app_{{death_certificate_id}}" onclick="DeathCertificate.listview.getQueryData('{{death_certificate_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-reply" style="margin-right: 5px;"></i> Raise / View Query</button>
    <?php } ?>
    <button type="button" class="btn btn-sm btn-success" id="approve_btn_for_app_{{death_certificate_id}}"
                onclick="DeathCertificate.listview.askForApproveApplication('{{death_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_approve_btn}}">
            <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Approve</button>
    <button type="button" class="btn btn-sm btn-danger" id="reject_btn_for_app_{{death_certificate_id}}"
                onclick="DeathCertificate.listview.askForRejectApplication('{{death_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_reject_btn}}">
            <i class="fas fa-times-circle" style="margin-right: 2px;"></i> Reject</button>
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="DeathCertificate.listview.downloadCertificate('{{death_certificate_id}}', VALUE_TWO);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{download_certificate_style}}">
        <i class="fas fa-certificate" style="margin-right: 2px;"></i> Download Certificate</button>
</div>