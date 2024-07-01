<div class="row">
    <div class="col-sm-12 col-md-3 col-lg-4"></div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title f-w-b" style="float: none; text-align: center;">Form No. I & XIV (Office Copy)</h3>
            </div>
            <div class="card-body">
                <form role="form" id="fofoc_form" name="fofoc_form" onsubmit="return false;" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-fofoc f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4 col-md-12">
                            <label>District<span class="color-nic-red">*</span></label>
                            <select id="district_for_fofoc" name="district_for_fofoc"
                                    data-placeholder="Select District !"
                                    class="form-control select2" style="width: 100%;" onchange="districtChangeEvent($(this), 'fofoc');">
                            </select>
                            <span class="error-message error-message-fofoc-district_for_fofoc"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4 col-md-12">
                            <label>Village<span class="color-nic-red">*</span></label>
                            <select id="village_for_fofoc" name="village_for_fofoc" 
                                    class="form-control select2" style="width: 100%;" onchange="villageChangeEvent($(this), 'fofoc');"
                                    data-placeholder="Select Village">
                            </select>
                            <span class="error-message error-message-fofoc-village_for_fofoc"></span>
                        </div>
                        <div class="form-group col-sm-4 col-md-12">
                            <label>Survey Number<span class="color-nic-red">*</span></label>
                            <select id="survey_number_for_fofoc" name="survey_number_for_fofoc" 
                                    class="form-control select2" style="width: 100%;" onchange="surveyNumberChangeEvent($(this), 'fofoc');"
                                    data-placeholder="Select Survey Number">
                            </select>
                            <span class="error-message error-message-fofoc-survey_number_for_fofoc"></span>
                        </div>
                        <div class="form-group col-sm-4 col-md-12">
                            <label>Sub Division Number<span class="color-nic-red">*</span></label>
                            <select id="subdivision_number_for_fofoc" name="subdivision_number_for_fofoc"
                                    class="form-control select2" style="width: 100%;"
                                    data-placeholder="Select Sub Division Number">
                            </select>
                            <span class="error-message error-message-fofoc-subdivision_number_for_fofoc"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-nic-blue" onclick="FormOneFourteen.listview.viewOfficeCopy($(this));">
                    <i class="fas fa-eye mr-1"></i> View Office Copy
                </button>
            </div>
        </div>
    </div>
</div>