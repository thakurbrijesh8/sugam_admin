<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;"></h3>
</div>
<form role="form" id="dr_sd_form" name="dr_sd_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="document_registration_id_for_dr_sd" name="document_registration_id_for_dr_sd" value="{{document_registration_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Document Number</td>
                    <td><span class="badge badge-primary app-status">{{application_number}}</span></td>
                </tr>
                <tr>
                    <td class="f-w-b">Document Upload Status</td>
                    <td id="dr_sd_status_for_dr_sd">{{{doc_upload_status_text}}}</td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center mb-3">
                <span class="error-message error-message-dr-sd f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                {{#if show_scanned_doc_btn}}
                <div id="final_document_container_for_dr_sd">
                    <label>Upload Scanned Document <span style="color: red;">* (Maximum File Size: 20MB) &nbsp; (Upload PDF Only)</span></label><br>
                    <input type="file" id="final_document_for_dr_sd"
                           onchange="DocumentRegistration.listview.uploadScannedDoc();"
                           accept="application/pdf" style="width: 200px; display: none;">
                    <button type="button" class="btn btn-sm btn-nic-blue" onclick="$('#final_document_for_dr_sd').click();"
                            style="cursor: pointer;">
                        Select File
                    </button>
                </div>
                <div class="text-center color-nic-blue" id="spinner_template_final_document_for_dr_sd" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-2x"></i></div>
                {{/if}}
                <div id="final_document_name_container_for_dr_sd" style="display: none;">
                    <label>Scanned Document <span style="color: red;">*</span></label><br>
                    <a id="final_document_name_href_for_dr_sd" target="_blank" class="cursor-pointer">
                        <label id="final_document_name_for_dr_sd" class="btn btn-sm btn-nic-blue f-w-n cursor-pointer"></label>
                    </a>
                    {{#if show_scanned_doc_btn}}
                    <button type="button" id="final_document_remove_btn_for_dr_sd" class="btn btn-sm btn-danger" style="vertical-align: top;">
                        <i class="fas fa-trash" style="padding-right: 4px;"></i> Remove</button>
                    {{/if}}
                </div>
            </div>
        </div>
    </div>
</form>
<div class="card-footer text-right">
    {{#if show_scanned_doc_btn}}
    <button type="button" class="btn btn-sm btn-nic-blue"
            onclick="DocumentRegistration.listview.updateSDStatus($(this), VALUE_ONE);">Submit & No Lock Document</button>
    <button type="button" class="btn btn-sm btn-success"
            onclick="DocumentRegistration.listview.updateSDStatus($(this), VALUE_TWO);">Submit & Lock Document</button>
    {{/if}}
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>