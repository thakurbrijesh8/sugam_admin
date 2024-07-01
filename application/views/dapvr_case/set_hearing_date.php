<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Set Hearing Date Form</h3>
</div>
<form role="form" id="set_hearing_date_dapvr_case_form" name="set_hearing_date_dapvr_case_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="case_id_for_dapvr_case_set_hearing_date" name="case_id_for_dapvr_case_set_hearing_date" value="{{case_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-dapvr_case-set_hearing_date f-w-b" style="border-bottom: 2px solid red;"></span>
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
                <tbody class="hr_container_for_dcview"></tbody>
            </table>
        </div>
        <div class="row">
            <div class="form-group f-s-16px col-sm-12" id="next_hearing_div_for_dapvr_case" style="display: none;">
                <label> Do you want to set Next Hearing Date ? <span class="color-nic-red">*</span></label>
                <div id="next_hearing_container_for_dapvr_case"></div>
                <span class="error-message error-message-dapvr_case-next_hearing_for_dapvr_case"></span>
            </div>
        </div>
        {{#if show_submit_btn}}
        <div class="row">
            <div class="form-group col-sm-12 col-md-12 next_hearing_item_container_for_dapvr_case" id="set_hearing_date_div_for_dapvr_case" style="display: none;"> 
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Hearing Date<span style="color: red;">*</span></label>
                        <div class="input-group date">
                            <input type="text" name="hearing_date_for_dapvr_case" id="hearing_date_for_dapvr_case"
                                   class="form-control date_picker"
                                   placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                                   value="{{next_hearing_date}}"
                                   onblur="checkValidation('dapvr_case', 'hearing_date_for_dapvr_case', HearingDateValidationMessage);">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="far fa-calendar"></i></span>
                            </div>
                        </div>

                        <span class="error-message error-message-dapvr_case-hearing_date_for_dapvr_case"></span>
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label>Hearing Time<span style="color: red;">*</span></label>
                        <div class="input-group">
                            <input type="text" id="hearing_time_for_dapvr_case" name="hearing_time_for_dapvr_case" 
                                   onblur="checkValidation('dapvr_case', 'hearing_time_for_dapvr_case', timeValidationMessage);"
                                   class="form-control date_picker" data-date-format="LT" placeholder="ex. 00:00 AM/PM"
                                   value="{{hearing_time}}">
                            <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                            </div>
                        </div>
                        <span class="error-message error-message-dapvr_case-hearing_time_for_dapvr_case"></span>
                    </div>
                    <div class="form-group col-sm-12 col-md-12">
                        <label>Remarks <span style="color: red;">*</span></label>
                        <textarea id="hearing_remarks_for_dapvr_case" name="hearing_remarks_for_dapvr_case" class="form-control"
                                  onblur="checkValidation('dapvr_case-set_hearing_date', 'hearing_remarks_for_dapvr_case', remarksValidationMessage);"
                                  placeholder="Remarks !" maxlength="300">{{hearing_remarks}}</textarea>
                        <span class="error-message error-message-dapvr_case-update-basic-detail-hearing_remarks_for_dapvr_case"></span>
                    </div>

                </div>
                {{else}}
                <div class="table-responsive">
                    <table class="table table-bordered table-padding bg-beige">
                        <tr>
                            <td class="f-w-b" style="width: 40%;">Hearing Date</td>
                            <td>{{next_hearing_date}}</td>
                        </tr>
                        <tr>
                            <td class="f-w-b" style="width: 40%;">Remarks</td>
                            <td>{{hearing_remarks}}</td>
                        </tr>
                    </table>
                </div>
                {{/if}}

                <hr class="m-b-1rem">
                <div class="form-group col-sm-12 ">
                    {{#if show_submit_btn}}
                    <button type="button" id="submit_btn_for_dapvr_case_set_hearing_date" class="btn btn-sm btn-success" onclick="DAPVRCase.listview.submitsetHearingDate();"
                            style="margin-right: 5px;">Submit</button>
                    {{/if}}
                    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
                </div>
            </div>
            </form>