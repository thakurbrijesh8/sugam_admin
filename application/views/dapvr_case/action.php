<div class="text-center">
    {{#if show_edit_btn}}
    <button type="button" class="btn btn-sm btn-success" onclick="DAPVRCase.listview.editOrViewDapvrCaseEntry($(this),'{{case_id }}', true);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-pencil-alt" style="margin-right: 2px;"></i> Edit</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-primary" onclick="DAPVRCase.listview.editOrViewDapvrCaseEntry($(this),'{{case_id }}', false);"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-eye" style="margin-right: 2px;"></i> View</button>
    {{#if show_forward_btn}}
    <button type="button" class="btn btn-sm bg-orange" onclick="DAPVRCase.listview.updateBasicDetails($(this), '{{case_id}}');"
            id="update_basic_detail_btn_for_app_{{case_id}}"
            style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
        <i class="fas fa-edit" style="margin-right: 2px;"></i>
        <?php
        if (is_admin()) {
            echo 'Forward';
        } else if (is_talathi_user()) {
            echo 'Forward To Mamlatdar';
        } else if (is_mamlatdar_user()) {
            echo 'Forward Details';
        }
        ?>
    </button>
    {{/if}}
    {{#if show_hearing_btn}}
 
        <button type="button" class="btn btn-sm btn-nic-blue" onclick="DAPVRCase.listview.setHearingDate('{{case_id}}');" id="hearingdate_btn_for_case_{{case_id}}"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-calendar" style="margin-right: 2px;"></i> Set Next Hearing Date</button>       
  
    {{/if}}  
    {{#if show_judgement_btn}}
   
        <button type="button" class="btn btn-sm bg-gradient-red" onclick="DAPVRCase.listview.Judgement('{{case_id}}');" id="judgement_btn_for_case_{{case_id}}"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-calendar" style="margin-right: 2px;"></i>Judgement</button> 
       
    {{/if}} 
    {{#if show_order_btn}}
     <button type="button" class="btn btn-sm bg-purple" onclick="DAPVRCase.listview.UploadOrder('{{case_id}}');" id="order_btn_for_case_{{case_id}}"
                style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
            <i class="fas fa-calendar" style="margin-right: 2px;"></i>Upload Order</button> 
       {{/if}} 
</div>