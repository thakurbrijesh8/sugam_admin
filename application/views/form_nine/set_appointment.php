<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Set Appointment Form</h3>
</div>
<form role="form" id="set_appointment_form_nine_form" name="set_appointment_form_nine_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="form_nine_id_for_form_nine_set_appointment" name="form_nine_id_for_form_nine_set_appointment" value="{{form_nine_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-form-nine-set-appointment f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Application Number</td>
                    <td>{{application_number}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Full Name of Applicant</td>
                    <td>{{applicant_name}} {{father_name}} {{surname}}</td>
                </tr>
            </table>
        </div>
        {{#if show_submit_btn}}
        <div class="row">
            <div class="form-group col-sm-12 col-md-6">
                <label>1.1 Appointment Date<span style="color: red;">*</span></label>
                <div class="input-group date">
                    <input type="text" name="appointment_date_for_form_nine" id="appointment_date_for_form_nine" class="form-control appointment_date_picker"
                           placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                           value="{{appointment_date}}"
                           onblur="checkValidation('form-nine', 'appointment_date_for_form_nine', appointmentDateValidationMessage);">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                </div>
                <span class="error-message error-message-form-nine-appointment_date_for_form_nine"></span>
            </div>
            <div class="form-group col-sm-12 col-md-6">
                <label>1.2 Appointment Time<span style="color: red;">*</span></label>
                <div class="input-group">
                    <input type="text" id="appointment_time_for_form_nine" name="appointment_time_for_form_nine" 
                           onblur="checkValidation('form-nine', 'appointment_time_for_form_nine', timeValidationMessage);"
                           class="form-control appointment_time_picker" data-date-format="LT" placeholder="ex. 00:00 AM/PM"
                           value="{{appointment_time}}">
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                </div>
                <span class="error-message error-message-form-nine-appointment_time_for_form_nine"></span>
            </div>
        </div>
        {{else}}
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Appointment Date & Time</td>
                    <td>{{appointment_date}} {{appointment_time}}</td>
                </tr>
            </table>
        </div>
        {{/if}}
        <hr class="m-b-1rem">
        <div class="form-group">
            {{#if show_submit_btn}}
            <button type="button" id="submit_btn_for_form_nine_set_appointment" class="btn btn-sm btn-success" onclick="FormNine.listview.submitSetAppointment();"
                    style="margin-right: 5px;">Submit</button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>