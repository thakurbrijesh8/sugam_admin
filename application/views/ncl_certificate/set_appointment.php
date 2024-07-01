<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Set Appointment Form</h3>
</div>
<form role="form" id="set_appointment_ncl_certificate_form" name="set_appointment_ncl_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="ncl_certificate_id_for_ncl_certificate_set_appointment" name="ncl_certificate_id_for_ncl_certificate_set_appointment" value="{{ncl_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-ncl-certificate-set-appointment f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Application Number</td>
                    <td>{{application_number}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Applicant Name</td>
                    <td>{{applicant_name}}</td>
                </tr>
            </table>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding">
                <thead>
                    <tr>
                        <td class="f-w-b text-center v-a-m bg-beige" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Appointment Date</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Appointment Time</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Appointment Type</td>
                        <td class="f-w-b text-center v-a-m bg-beige" style="min-width: 100px;">Appointment By</td>
                    </tr>
                </thead>
                <tbody id="appointment_history_container_for_ncl_certificate">
                </tbody>
            </table>
        </div>
        {{#if show_submit_btn}}
        <div class="row">
            <div class="form-group col-sm-12 col-md-6">
                <label>1.1 Appointment Date<span style="color: red;">*</span></label>
                <div class="input-group date">
                    <input type="text" name="appointment_date_for_ncl_certificate" id="appointment_date_for_ncl_certificate" class="form-control appointment_date_picker"
                           placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY"
                           value="{{appointment_date}}"
                           onblur="checkValidation('ncl-certificate', 'appointment_date_for_ncl_certificate', appointmentDateValidationMessage);">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar"></i></span>
                    </div>
                </div>
                <span class="error-message error-message-ncl_certificate-appointment_date_for_ncl_certificate"></span>
            </div>
            <div class="form-group col-sm-12 col-md-6">
                <label>1.2 Appointment Time<span style="color: red;">*</span></label>
                <div class="input-group">
                    <input type="text" id="appointment_time_for_ncl_certificate" name="appointment_time_for_ncl_certificate" 
                           onblur="checkValidation('ncl-certificate', 'appointment_time_for_ncl_certificate', timeValidationMessage);"
                           class="form-control appointment_time_picker" data-date-format="LT" placeholder="ex. 00:00 AM/PM"
                           value="{{appointment_time}}">
                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                    </div>
                </div>
                <span class="error-message error-message-ncl_certificate-appointment_time_for_ncl_certificate"></span>
            </div>
        </div>
        {{/if}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label>2. Type <span class="color-nic-red">*</span></label><br/>
                <div>
                    <!-- <label class="checkbox-inline f-w-n m-b-0px m-r-10px cursor-pointer">
                        <input type="checkbox" id="online_statement_for_ncl_certificate" 
                               name="online_statement_for_ncl_certificate" value="{{VALUE_ONE}}"
                               >&nbsp;&nbsp;Online Statement</label><br> -->
                    <label class="checkbox-inline f-w-n m-b-0px m-r-10px cursor-pointer">
                        <input type="checkbox" id="visit_office_for_ncl_certificate" 
                               name="visit_office_for_ncl_certificate" value="{{VALUE_ONE}}"
                               >&nbsp;&nbsp;Visit Office</label>
                </div>
            </div>
            <span class="error-message error-message-ncl_certificate-visit_office_for_ncl_certificate"></span>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
            {{#if show_submit_btn}}
            <button type="button" id="submit_btn_for_ncl_certificate_set_appointment" class="btn btn-sm btn-success" onclick="NclCertificate.listview.submitSetAppointment();"
                    style="margin-right: 5px;">Submit</button>
            {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>