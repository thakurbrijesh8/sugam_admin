<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Landtax Agriculture Form</h3>
</div>
<form role="form" id="landtax_agriculture_form" name="landtax_agriculture_form" onsubmit="return false;" style="font-size: 14px;">
    <input type="hidden" id="landtax_agriculture_id_for_landtax_agriculture" name="landtax_agriculture_id_for_landtax_agriculture" value="{{landtax_agriculture_id}}">

    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-landtax-agriculture f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>1. Village  <span style="color: red;">*</span></label>
                <input type="text" id="village_for_landtax_agriculture" name="village" class="form-control" placeholder="Enter Village" value="{{village_name}}" readonly="">
                <input type="hidden" id="village_code_for_landtax_agriculture" name="village_code_for_landtax_agriculture" value="{{village}}">
            </div>
            <div class="form-group col-sm-6">
                <label>2. Khata Number  <span style="color: red;">*</span></label>
                <input type="text" id="khata_number_for_landtax_agriculture" name="khata_number_for_landtax_agriculture" class="form-control" placeholder="Enter Khata Number" value="{{khata_number}}" readonly="">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>3. Occupant Name  <span style="color: red;">*</span></label>
                <input type="text" id="occupant_name_for_landtax_agriculture" name="occupant_name_for_landtax_agriculture" class="form-control" placeholder="Enter Occupant Name" value="{{occupant_name}}" onblur="checkValidation('landtax-agriculture', 'occupant_name_for_landtax_agriculture', nameValidationMessage);">
                <span class="error-message error-message-landtax-agriculture-occupant_name_for_landtax_agriculture"></span>
            </div>
            <div class="form-group col-sm-6">
                <label>4. Address </label>
                <textarea id="address_for_landtax_agriculture" name="address_for_landtax_agriculture" class="form-control" placeholder="Enter Address!" maxlength="100">{{address}}</textarea>
                <span class="error-message error-message-landtax-agriculture-address_for_landtax_agriculture"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>5. Mobile Number </label>
                <input type="text" id="mobile_number_for_landtax_agriculture" name="mobile_number_for_landtax_agriculture" class="form-control" placeholder="Enter Mobile Number" maxlength="10" value="{{mobile_number}}">
                <span class="error-message error-message-landtax-agriculture-mobile_number_for_landtax_agriculture"></span>
            </div>
            <div class="form-group col-sm-6">
                <label>6. Email </label>
                <input type="text" id="email_for_landtax_agriculture" name="email_for_landtax_agriculture" class="form-control" placeholder="Enter Email" value="{{email}}">
                <span class="error-message error-message-landtax-agriculture-email_for_landtax_agriculture"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>7. Reference Survey Number </label>
                <input type="text" id="ref_survey_number_for_landtax_agriculture" name="ref_survey_number_for_landtax_agriculture" class="form-control" placeholder="Enter Reference Survey Number" value="{{ref_survey_number}}">
                <span class="error-message error-message-landtax-agriculture-ref_survey_number_for_landtax_agriculture"></span>
            </div>
            <div class="form-group col-sm-6">
                <label>8. Remark</label>
                <textarea id="remark_for_landtax_agriculture" name="remark_for_landtax_agriculture" class="form-control" placeholder="Enter Remark!" maxlength="100" >{{remark}}</textarea>
                <span class="error-message error-message-landtax-agriculture-remark_for_landtax_agriculture"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>9. Hut ઝુપડી  </label>
                <input type="text" id="dlt_hut_for_landtax_agriculture" name="dlt_hut_for_landtax_agriculture" class="form-control" placeholder="Enter Hut ઝુપડી" value="{{dlt_hut}}">
                <span class="error-message error-message-landtax-agriculture-dlt_hut_for_landtax_agriculture"></span>
            </div>
            <div class="form-group col-sm-6">
                <label>10. Itar ઈતર  </label>
                <input type="text" id="dlt_itar_for_landtax_agriculture" name="dlt_itar_for_landtax_agriculture" class="form-control" placeholder="Enter Itar ઈતર" value="{{dlt_itar}}">
                <span class="error-message error-message-landtax-agriculture-dlt_itar_for_landtax_agriculture"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>11. Rokad રોકડ રુ. પૈ  </label>
                <input type="text" id="dlt_rokad_for_landtax_agriculture" name="dlt_rokad_for_landtax_agriculture" class="form-control" placeholder="Enter Rokad રોકડ રુ. પૈ" value="{{dlt_rokad}}">
                <span class="error-message error-message-landtax-agriculture-dlt_rokad_for_landtax_agriculture"></span>
            </div>
            <div class="form-group col-sm-6">
                <label>12. Kada કડા  </label>
                <input type="text" id="dlt_kad_for_landtax_agriculture" name="dlt_kad_for_landtax_agriculture" class="form-control" placeholder="Enter Kada કડા" value="{{dlt_kada}}">
                <span class="error-message error-message-landtax-agriculture-dlt_kad_for_landtax_agriculture"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-4">
                <label>13. Dangi ડાંગી  </label>
                <input type="text" id="dlt_dangi_for_landtax_agriculture" name="dlt_dangi_for_landtax_agriculture" class="form-control" placeholder="Enter Dangi ડાંગી" value="{{dlt_dangi}}">
                <span class="error-message error-message-landtax-agriculture-dlt_dangi_for_landtax_agriculture"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>14. Kolam કોલમ  </label>
                <input type="text" id="dlt_kolam_for_landtax_agriculture" name="dlt_kolam_for_landtax_agriculture" class="form-control" placeholder="Enter Kolam કોલમ" value="{{dlt_kolam}}">
                <span class="error-message error-message-landtax-agriculture-dlt_kolam_for_landtax_agriculture"></span>
            </div>
            <div class="form-group col-sm-4">
                <label>15. Arad અળદ  </label>
                <input type="text" id="dlt_arad_for_landtax_agriculture" name="dlt_arad_for_landtax_agriculture" class="form-control" placeholder="Enter Arad અળદ" value="{{dlt_arad}}">
                <span class="error-message error-message-landtax-agriculture-dlt_arad_for_landtax_agriculture"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label>16. Arreas of Revenue  <span style="color: red;">*</span></label>
                <input type="text" id="arrears_for_landtax_agriculture" name="arrears_for_landtax_agriculture" class="form-control" placeholder="Enter Arreas of Revenue" value="{{arrears}}" onblur="checkValidation('landtax-agriculture', 'arrears_for_landtax_agriculture', arreasValidationMessage);">
                <span class="error-message error-message-landtax-agriculture-arrears_for_landtax_agriculture"></span>
            </div>
        </div>
        <div class="row" id="amount_of_year_for_landtax_agriculture">
        </div>

        <hr class="m-b-1rem">
        <div class="form-group">
            <button type="button" id="submit_btn_for_landtax_agriculture" class="btn btn-sm btn-success" onclick="LandTaxAgriculture.listview.submitLandTaxAgriculture($(this));"
                    style="margin-right: 5px;">Submit</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
        </div>
    </div>
</form>