<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" onclick="DocumentRegistration.listview.editOrViewDocumentRegistration($(this),'{{document_registration_id}}', VALUE_ONE);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt" style="margin-right: 2px;"></i> Edit</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-primary" onclick="DocumentRegistration.listview.editOrViewDocumentRegistration($(this),'{{document_registration_id}}', VALUE_FOUR);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_app_{{document_registration_id}}"
            onclick="DocumentRegistration.listview.getQueryData('{{document_registration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-question" style="margin-right: 5px;"></i> Raise / View Query</button>
    {{#if show_cpo_btn}}
    <button type="button" class="btn btn-sm bg-orange" id="cpo_btn_for_app_{{document_registration_id}}"
            onclick="DocumentRegistration.listview.editOrViewDocumentRegistration($(this),'{{document_registration_id}}', VALUE_ELEVEN);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-sort" style="margin-right: 5px;"></i> Change Party Order</button>
    {{/if}}
    {{#if show_verify_btn}}
    <button type="button" class="btn btn-sm btn-nic-blue" id="verify_btn_for_app_{{document_registration_id}}"
            onclick="DocumentRegistration.listview.editOrViewDocumentRegistration($(this),'{{document_registration_id}}', VALUE_FIVE);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-clipboard-check" style="margin-right: 5px;"></i> Verify</button>
    {{/if}}
    {{#if show_verify_app_btn}}
    <button type="button" class="btn btn-sm btn-nic-blue" id="verify_app_btn_for_app_{{document_registration_id}}"
            onclick="DocumentRegistration.listview.editOrViewDocumentRegistration($(this),'{{document_registration_id}}', VALUE_SEVEN);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-clipboard-check" style="margin-right: 5px;"></i> Verify & Send</button>
    {{/if}}
    {{#if show_doc_verified_btns}}
    <button type="button" class="btn btn-sm btn-nic-blue" id="ud_btn_for_app_{{document_registration_id}}"
            onclick="DocumentRegistration.listview.editOrViewDocumentRegistration($(this),'{{document_registration_id}}', VALUE_SIX);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-upload" style="margin-right: 5px;"></i> Photo & Biometrics</button>

    <button type="button" class="btn btn-sm btn-success" onclick="DocumentRegistration.listview.showFeesDetails($(this),'{{document_registration_id}}');"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-money-check" style="margin-right: 2px;"></i> Fees Details</button>
    <button type="button" class="btn btn-sm btn-primary" onclick="DocumentRegistration.listview.generateFeeReceipt('{{document_registration_id}}');"
            id="dr_fee_receipt_btn_for_app_{{document_registration_id}}"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{fee_receipt_btn}}">
        <i class="fas fa-receipt" style="margin-right: 2px;"></i> Fee Receipt</button>
    <button type="button" class="btn btn-sm btn-nic-blue" onclick="DocumentRegistration.listview.askForGenerateEndorsement($(this),'{{document_registration_id}}');"
            id="dr_endorsement_btn_for_app_{{document_registration_id}}"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{fee_receipt_btn}}">
        <i class="fas fa-receipt" style="margin-right: 2px;"></i> Endorsement</button>
    {{/if}}
    <?php if (is_admin() || is_subr_user()) { ?>
        <!--        <button type="button" class="btn btn-sm btn-success" id="approve_btn_for_app_{{document_registration_id}}"
                        onclick="DocumentRegistration.listview.editOrViewDocumentRegistration($(this),'{{document_registration_id}}', VALUE_EIGHT);"
                        style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_approve_btn}}">
                    <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Approve</button>-->
        <button type="button" class="btn btn-sm btn-danger" id="reject_btn_for_app_{{document_registration_id}}"
                onclick="DocumentRegistration.listview.editOrViewDocumentRegistration($(this),'{{document_registration_id}}', VALUE_NINE);"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_reject_btn}}">
            <i class="fas fa-times-circle" style="margin-right: 2px;"></i> Reject</button>
    <?php } ?>
    {{#if show_scanned_doc_btn}}
    <button type="button" class="btn btn-sm btn-warning"
            onclick="DocumentRegistration.listview.editOrViewDocumentRegistration($(this),'{{document_registration_id}}', VALUE_TEN);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-upload" style="margin-right: 5px;"></i> Scanned Document</button>
    {{/if}}
</div>