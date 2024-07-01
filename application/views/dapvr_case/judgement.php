<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Final Judgement</h3>
</div>
<form role="form" id="judgement_dapvr_case_form" name="judgement_dapvr_case_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="case_id_for_dapvr_case_judgement" name="case_id_for_dapvr_case_judgement" value="{{case_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-dapvr_case-judgement f-w-b" style="border-bottom: 2px solid red;"></span>
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
            </table>
        </div>
        <div class="f-w-b f-s-16px">Previous Hearing Details</div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding">
                <thead>
                    <tr>
                        <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Hearing Date</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Hearing Time</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="width: 100px;">Hearing Remarks</td>
                    </tr>
                </thead>
                <tbody class="judgement_hr_container_for_dcview"></tbody>
            </table>
        </div>
        {{#if show_submit_btn}}
        <div class="row">
            <div class="form-group col-sm-12 col-md-12">
                <label>Judgement Remarks <span style="color: red;">*</span></label>
                <textarea id="judgement_remarks_for_dapvr_case" name="judgement_remarks_for_dapvr_case" class="form-control"
                          onblur="checkValidation('dapvr_case-judgement', 'judgement_remarks_for_dapvr_case', remarksValidationMessage);"
                          placeholder="Remarks !" maxlength="300">{{judgement}}</textarea>
                <span class="error-message error-message-dapvr_case-judgement-judgement_remarks_for_dapvr_case"></span>
            </div>
            {{else}}
            <div class="table-responsive">
                <table class="table table-bordered table-padding bg-beige">
                    <tr>
                        <td class="f-w-b" style="width: 40%;">Judgement</td>
                        <td>{{judgement}}</td>
                    </tr>
                </table>
            </div>
            {{/if}}
            <hr class="m-b-1rem">
            {{#if show_submit_btn}}
            <div class="form-group col-sm-12 ">
                <button type="button" id="submit_btn_for_dapvr_case_judgement" class="btn btn-sm btn-success" onclick="DAPVRCase.listview.submitJudgement();"
                        style="margin-right: 5px;">Submit</button>
                {{/if}}
                <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
            </div>
        </div>
</form>