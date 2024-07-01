<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Khata Number Wise Land Details</h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 14px;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" class="btn btn-sm btn btn-danger float-right" style="padding: 2px 7px;"
                    onclick="KhataNumber.listview.downloadDetailsOfKhataNumber(VALUE_ONE,{{village}},{{khata_number}});">
                <i class="fas fa-file-pdf"></i>&nbsp; Download PDF</button>
            <button type="button" class="btn btn-sm btn btn-success float-right mr-1" style="padding: 2px 7px;"
                    onclick="KhataNumber.listview.downloadDetailsOfKhataNumber(VALUE_TWO,{{village}},{{khata_number}});">
                <i class="fas fa-file-excel"></i>&nbsp; Download Excel</button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center" style="margin-bottom: 10px;">
            <span class="success-message-kn f-w-b" style="border-bottom: 2px solid green; color: green;"></span>
        </div>
    </div>
    <div class="table-responsive">
        <form role="form" id="land_detail_form_for_kn" name="land_detail_form_for_kn" onsubmit="return false;" style="font-size: 14px;">
            <table class="table table-bordered table-padding bg-beige vat-top" id="khata_number_table_for_kn">
                <thead>
                    <tr>
                        <th class="text-center v-a-m" style="width: 30px;">Sr. No.</th>
                        <th class="text-center v-a-m" style="width: 50px;">Khata Number</th>
                        <th class="text-center v-a-m" style="width: 80px;">Village Name</th>
                        <th class="text-center v-a-m" style="width: 80px;">Survey Number</th>
                        <th class="text-center v-a-m" style="width: 80px;">Sub Division Number</th>
                        <th class="text-center v-a-m" style="width: 50px;">Area</th>
                        <th class="text-center v-a-m" style="min-width: 280px;">Occupant Name</th>
                        <th class="text-center v-a-m" style="width: 50px;">Mutation Number</th>
                        <th class="text-center v-a-m" style="width: 80px;">Nature</th>
                        <th class="text-center v-a-m" style="min-width: 85px;">Assign is N.A Land</th>
                        <th class="text-center v-a-m" style="min-width: 120px;">Aadhar Card Number<hr>
                            <input type="text" class="form-control" id="aadhar_card_number_for_kn" name="aadhar_card_number_for_kn" 
                                   onblur="aadharNumberValidation('land-detail-kn', 'aadhar_card_number_for_kn');"
                                   onkeyup="KhataNumber.listview.getAadharcarNumber()" maxlength="12" placeholder="Enter Aadhar Number">
                            <span class="error-message f-w-n error-message-land-detail-kn-aadhar_card_number_for_kn"></span>
                            <button id="aadhar_update_btn" type="button" class="btn btn-xs btn-success float-right" onclick="KhataNumber.listview.updateAadharCardNumber($(this));">Update</button><br>
                        </th>
                        <th class="text-center v-a-m" style="min-width: 140px;">Mobile Number<hr>
                            <input type="text" class="form-control" id="mobile_number_for_kn" name="mobile_number_for_kn" 
                                   onblur="checkValidationForMobileNumberForOnlyEnter('land-detail-kn', 'mobile_number_for_kn');"
                                   onkeyup="KhataNumber.listview.getMobileNumber()" maxlength="10" placeholder = "Enter Mobile Number">
                            <span class="error-message f-w-n error-message-land-detail-kn-mobile_number_for_kn"></span>
                            <button id="mobile_number_update_btn" type="button" class="btn btn-xs btn-success float-right" onclick="KhataNumber.listview.updateMobileNumber($(this));">Update</button><br>
                        </th>
                        <th class="text-center v-a-m" style="min-width: 110px;">Khata Number<br>(if Updation Required)</th>
                    </tr>
                </thead>
                <tbody id="land_detail_container_for_kn"></tbody>
            </table>
        </form>
    </div>
</div>
<div class="card-footer text-right pr-2">
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">
        <i class="fas fa-times"></i>&nbsp; Close</button>
</div>