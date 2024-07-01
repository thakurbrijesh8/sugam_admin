<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Upload Order</h3>
</div>
<form role="form" id="order_dapvr_case_form" name="order_dapvr_case_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="case_id_for_dapvr_case_order" name="case_id_for_dapvr_case_order" value="{{case_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-dapvr_case-order f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Case Number</td>
                    <td>{{case_no}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Register Date</td>
                    <td>{{register_date}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Case Year</td>
                    <td>{{CaseYearData}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Case Type</td>
                    <td>{{CaseTypeData}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Judgement</td>
                    <td>{{judgement}}</td>
                </tr>
            </table>
        </div>
        <div class="f-w-b f-s-16px">Previous Hearing Details</div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding">
                <thead>
                    <tr>
                        <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Hearing Date</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="width: 100px;">Hearing Remarks</td>
                    </tr>
                </thead>
                <tbody class="order_hr_container_for_dcview"></tbody>
            </table>
        </div>
        {{#if show_submit_btn}}
        <div class="row" id="upload_order_container_for_dc">
            <div class="col-12 m-b-5px" id="upload_order_dv_for_dc">
                <label>1. Upload Order<span style="color: red;">* (Maximum File Size: 2MB)</span></label><br>
                <input type="file" id="upload_order_for_dc" name="upload_order_for_dc"
                       accept="image/jpg,image/png,image/jpeg,image/jfif,application/pdf">
                <div class="error-message error-message-dapvr_case-upload_order_for_dc"></div>
            </div>
        </div>
        {{else}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 45%;">Uploaded Order by Talathi</td>
                    <td>
                        <div class="form-group col-sm-12" id="upload_order_name_container_for_dc" style="display: none;">
                            <a id="upload_order_href_for_dc" target="_blank">
                                <i class="fas fa-cloud-download-alt" style="margin-right: 3px;"></i><span id="upload_order_name_for_dc"></span>
                            </a>
                            {{#if show_remove_upload_btn}}
                            <span class="fas fa-times" style="color: red; cursor: pointer; margin-left: 3px;" id="upload_order_remove_btn_for_dc"></span><br>
                            {{/if}}
                            <span class="error-message error-message-dapvr_case-upload_order_for_dc"></span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        {{/if}}
        <hr class="m-b-1rem">
        {{#if show_submit_btn}}           
        <div class="form-group col-sm-12 ">
            <button type="button" id="submit_btn_for_dapvr_case_order" class="btn btn-sm btn-success" onclick="DAPVRCase.listview.submitOrder();"
                    style="margin-right: 5px;">Submit</button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>          

</form>