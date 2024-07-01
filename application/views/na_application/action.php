<div class="text-center">
    <button type="button" class="btn btn-sm btn-primary" onclick="NaApplication.listview.editOrViewNaApplication($(this),'{{na_application_id}}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    <?php if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user()) { ?>
        <button type="button" class="btn btn-sm btn-warning" id="query_btn_for_app_{{na_application_id}}"
                onclick="NaApplication.listview.getQueryData('{{na_application_id}}');"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-question" style="margin-right: 5px;"></i> Raise / View Query</button>
        <?php } ?>
</div>