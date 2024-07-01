
<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Assign Khata Number</h3>
</div>
<form role="form" id="update_khata_number_form" name="update_khata_number_form" onsubmit="return false;" style="font-size: 14px;">

    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-domicile-update-basic-detail f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige vat-top" id="khata_number_table_for_arrears_update">
                <thead>
                    <tr>
                        <th class="text-center v-a-m" style="width: 10px;">No</th>
                        <th class="text-center v-a-m" style="min-width: 250px;">Name</th>
                        <th class="text-center v-a-m" style="width: 70px;">Mutation Number</th>
                        <th class="text-center v-a-m" style="width: 70px;">Type Of Ownership</th>
                        <th class="text-center v-a-m" style="width: 70px;">Nature</th>
                        <th class="text-center v-a-m" style="width: 50px;">Survey</th>
                        <th class="text-center v-a-m" style="width: 50px;">Sub Division</th>
                        <th class="text-center v-a-m" style="width: 50px;">Area</th>
                        <th class="text-center v-a-m" style="width: 70px;">System Generated Khata Number</th>
                        <th class="text-center v-a-m" style="min-width: 80px;">New Khata Number</th>
                        <th class="text-center v-a-m" style="min-width: 120px;">Aadhar Card Number</th>
                        <th class="text-center v-a-m" style="min-width: 120px;">Mobile Number</th>
                    </tr>
                </thead>
                <tbody id="merge_container_for_kn_arrears_update"></tbody>
            </table>

        </div>

        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" style="display: none;" id="khata_update_btn" class="btn btn-sm btn-success mr-1"
                    onclick="ArrearsUpdate.listview.updateKhataNumber($(this));">
                <i class="fas fa-save"></i>&nbsp; Update</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fas fa-times"></i>&nbsp; Close</button>
        </div>
    </div>
</form>