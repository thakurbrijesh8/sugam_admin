<div class="text-center">
    <button type="button" class="btn btn-sm btn-primary" onclick="SvamitvaRor.listview.requestForSvamitvaRor($(this),'{{svamitva_ror_id}}', VALUE_ONE);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    {{#if show_pa_btn}}
    <button type="button" class="btn btn-sm btn-danger" onclick="SvamitvaRor.listview.requestForSvamitvaRor($(this),'{{svamitva_ror_id}}', VALUE_TWO);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Print Application</button>
    {{/if}}
    <?php if (is_admin() || is_eocs_fs_user() || is_eocs_hs_user() || is_eocs_head()) { ?>
        {{#if show_check_btn}}
        <button type="button" class="btn btn-sm btn-success" id="checked_btn_for_app_{{svamitva_ror_id}}"
                onclick="SvamitvaRor.listview.requestForSvamitvaRor($(this),'{{svamitva_ror_id}}', VALUE_FIVE);"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-clipboard-check" style="margin-right: 5px;"></i> Confirm Checked By</button>
        {{/if}}
    <?php } if (is_admin() || is_eocs_head()) { ?>
        <button type="button" class="btn btn-sm btn-success" id="approve_btn_for_app_{{svamitva_ror_id}}"
                onclick="SvamitvaRor.listview.askForApproveRejectApplication($(this), '{{svamitva_ror_id}}', {{VALUE_ONE}});"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_approve_btn}}">
            <i class="fas fa-file-pdf" style="margin-right: 2px;"></i> Approve</button>
    <?php } if (is_admin() || is_eocs_fs_user() || is_eocs_hs_user() || is_eocs_head()) { ?>
        <button type="button" class="btn btn-sm btn-danger" id="reject_btn_for_app_{{svamitva_ror_id}}"
                onclick="SvamitvaRor.listview.askForApproveRejectApplication($(this), '{{svamitva_ror_id}}', {{VALUE_TWO}});"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; {{show_reject_btn}}">
            <i class="fas fa-times-circle" style="margin-right: 2px;"></i> Reject</button>
        <?php } ?>
</div>