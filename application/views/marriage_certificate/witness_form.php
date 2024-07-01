<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Witness</h3>
</div>
<form role="form" id="witness_marriage_certificate_form" name="witness_marriage_certificate_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="marriage_certificate_id_for_marriage_certificate_witness" name="marriage_certificate_id_for_marriage_certificate_witness" value="{{marriage_certificate_id}}">
    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-marriage-certificate-witness f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label>1. Application Number </label>
                <input type="text" name="application_number_for_marriage_certificate_witness"
                       id="application_number_for_marriage_certificate_witness" class="form-control" maxlength="11"
                       placeholder="Enter Application Number" value="{{application_number}}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12 col-md-6">
                <label>2. Witness Details</label>
                <div id="applicant_have_earning_member_container_for_witness_certificate"></div>
                <span class="error-message error-message-witness-certificate-applicant_have_earning_member_for_witness_certificate"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover-cells m-0 f-s">
                        <thead>
                            <tr class="bg-light-gray">
                                <th class="text-center p-1" style="width: 30px;">Sr.No.</th>
                                <th class="p-1" style="min-width: 150px;">Witness Name</th>
                                <th class="p-1" style="min-width: 80px;">Age</th>
                                <th class="p-1" style="width: 200px;">Occupation</th>
                                <th class="p-1" style="min-width: 150px;">Address</th>
                                <th class="text-center p-1" style="min-width: 60px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="witness_info_container_for_marriage_certificate">
                        </tbody>
                    </table>
                </div> 
                <div class="row">
                    <div class="col-12 f-w-b pt-2">
                        <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                onclick="MarriageCertificate.listview.addWitnessInfo({}, true);">
                            <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <hr class="m-b-1rem">
        <div class="form-group">
        {{#if show_witness_submit_btn}}
            <button type="button" class="btn btn-sm btn-success" id="submit_btn_for_marriage_certificate_witness"
                    onclick="MarriageCertificate.listview.submitWitnessForMarriageCertificate();"
                    style="margin-right: 5px;">Submit</button>
        {{/if}}
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>