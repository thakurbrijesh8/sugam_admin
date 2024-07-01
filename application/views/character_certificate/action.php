<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" id="edit_btn_for_app_{{character_certificate_id}}"
            onclick="CharacterCertificate.listview.editOrViewCharacterCertificate($(this),'{{character_certificate_id}}', true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt" style="margin-right: 2px;"></i> Edit</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-primary" onclick="CharacterCertificate.listview.editOrViewCharacterCertificate($(this),'{{character_certificate_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    <button type="button" class="btn btn-sm bg-purple" id="app_pdf_btn_for_app_{{character_certificate_id}}"
            onclick="CharacterCertificate.listview.applicationPDF('{{character_certificate_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 5px;"></i> Application PDF</button>
    <?php if (is_admin() || is_ldc_user() || is_mamlatdar_user() || is_mam_view_user()) { ?>
        <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_app_{{character_certificate_id}}"
                onclick="CharacterCertificate.listview.getQueryData('{{character_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-question" style="margin-right: 5px;"></i> Raise / View Query</button>
    <?php } ?>
     <?php if (is_admin() || is_mamlatdar_user() || is_sdpo_user()) { ?>
            <button type="button" class="btn btn-sm bg-olive" id="cc_btn_for_app_{{character_certificate_id}}"
            onclick="CharacterCertificate.listview.issueOfCharacterCertificate('{{character_certificate_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 5px;"></i> Issue Of Character Certificate</button>
        <?php } ?>
    <?php if (is_admin() || is_ldc_user() || is_mamlatdar_user() || is_sdpo_user()) { ?>
        {{#if show_forward_btn}}
        <button type="button" class="btn btn-sm bg-orange" onclick="CharacterCertificate.listview.updateBasicDetails($(this), '{{character_certificate_id}}');"
                id="update_basic_detail_btn_for_app_{{character_certificate_id}}"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-edit" style="margin-right: 2px;"></i> Forward
        </button>
        {{/if}}

    <?php } if (is_admin() || is_mamlatdar_user()) { ?>
        <button type="button" class="btn btn-success-sm btn-success" id="approve_btn_for_app_{{character_certificate_id}}"
                onclick="CharacterCertificate.listview.askForApproveApplication('{{character_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_approve_btn}}">
            <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Approve</button>
        <button type="button" class="btn btn-sm btn-danger" id="reject_btn_for_app_{{character_certificate_id}}"
                onclick="CharacterCertificate.listview.askForRejectApplication('{{character_certificate_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_reject_btn}}">
            <i class="fas fa-times-circle" style="margin-right: 2px;"></i> Reject</button>
    <?php } ?>
    <?php if (is_admin() || is_mamlatdar_user() || is_ldc_user()) { ?>
    <button type="button" class="btn btn-sm bg-orange"
            onclick="CharacterCertificate.listview.updateBasicDetails($(this), '{{character_certificate_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_movement_btn}}">
        <i class="fas fa-sync" style="margin-right: 2px;"></i> Movement Details</button>
    <button type="button" class="btn btn-sm btn-nic-blue" id="download_certificate_btn_for_app_{{character_certificate_id}}"
            onclick="CharacterCertificate.listview.downloadCertificate('{{character_certificate_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{download_certificate_style}}">
        <i class="fas fa-certificate" style="margin-right: 2px;"></i> Download Certificate</button>
    <?php } ?>
</div>