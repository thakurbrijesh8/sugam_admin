<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">{{title}}</h3>
</div>
<form role="form" id="update_basic_detail_dapvr_case_form" name="update_basic_detail_dapvr_case_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="case_id_for_dapvr_case_update_basic_detail" name="case_id_for_dapvr_case_update_basic_detail" value="{{case_id}}">
    <input type="hidden" id="talathi_name_for_dapvr_case_update_basic_detail" name="talathi_name_for_dapvr_case_update_basic_detail" value="{{talathi_name}}">
    <input type="hidden" id="mamlatdar_name_for_dapvr_case_update_basic_detail" name="mamlatdar_name_for_dapvr_case_update_basic_detail" value="{{mamlatdar_name}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-dapvr_case-update-basic-detail f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Case Number</td>
                    <td>{{case_no}}</td>
                </tr>
            </table>
        </div>
        {{#if show_talathi_enter_basic_details}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Remarks <span style="color: red;">*</span></label>
                <textarea id="talathi_remarks_for_dapvr_case" name="talathi_remarks_for_dapvr_case" class="form-control"
                          onblur="checkValidation('dapvr_case-update-basic-detail', 'talathi_remarks_for_dapvr_case', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{talathi_remarks}}</textarea>
                <span class="error-message error-message-dapvr_case-update-basic-detail-talathi_remarks_for_dapvr_case"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>4. Forward to Mamlatdar <span style="color: red;">*</span></label>
                <select id="talathi_to_mamlatdar_for_dapvr_case" name="talathi_to_mamlatdar_for_dapvr_case"
                        onchange="checkValidation('dapvr_case-update-basic-detail', 'talathi_to_mamlatdar_for_dapvr_case', oneOptionValidationMessage);"
                        class="form-control" data-placeholder="Select Forward to Mamlatdar">
                    <option value="">Select Any Mamlatdar</option>
                </select>
                <span class="error-message error-message-dapvr_case-update-basic-detail-talathi_to_mamlatdar_for_dapvr_case"></span>
            </div>
        </div>
        {{/if}}
        {{#if show_talathi_updated_basic_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Talathi Name</td>
                    <td>{{talathi_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks by Talathi</td>
                    <td>{{talathi_remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{talathi_to_mamlatdar_datetime_text}}<br>
                        <b>To :</b> {{mamlatdar_name}}
                    </td>
                </tr>
            </table>
        </div>
        {{/if}} 
        {{#if show_approve_reject_details}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Mamlatdar Name</td>
                    <td>{{mamlatdar_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Remarks by Mamlatdar</td>
                    <td>{{remarks}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Date Time :</b> {{status_datetime_text}}<br>
                    </td>
                </tr>
            </table>
        </div>
        {{/if}}
        <hr class="m-b-1rem">
        <div class="form-group">
            {{#if show_submit_btn}}
            <button type="button" class="btn btn-sm btn-success"
                    onclick="DAPVRCase.listview.submitBasicDetail($(this));"
                    style="margin-right: 5px;">
                        <?php echo is_admin() ? 'Submit' : 'Forward'; ?>
            </button>
            {{/if}}
            {{#if show_reverify_submit_btn}}
            <button type="button" class="btn btn-sm btn-success" onclick="DAPVRCase.listview.reverifyApplication($(this));"
                    style="margin-right: 5px;">Forward</button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>