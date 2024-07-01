<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="float: none; text-align: center;">IN THE COURT OF MAMLATDAR</h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;"></div>
                <!--                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">THE DAMAN (ABOLITION OF PROPRIETORSHIP OF VILLAGES) REGULATION, 1962  </div>-->
                <!--<div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">THE GOA, DAMAN AND DIU LAND REVENUE CODE - 1968. </div>-->
            </div>
            <form role="form" id="dapvr_case_form" name="na_form" onsubmit="return false;">
                <input type="hidden" id="case_id_for_dapvr_case" name="case_id_for_dapvr_case" value="{{case_id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-na f-w-b" style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>District <span class="color-nic-red">*</span></label>
                            <select id="district_for_dapvr_case" name="district_for_dapvr_case" class="form-control select2"
                                    onchange="checkValidation('dapvr_case', 'district_for_dapvr_case', selectDistrictValidationMessage);"
                                    data-placeholder="Select District" style="width: 100%;">  
                            </select>
                            <span class="error-message error-message-dapvr_case-district_for_dapvr_case"></span>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Case Year <span class="color-nic-red">*</span></label>
                            <select id="case_year_for_dapvr_case" name="case_year_for_dapvr_case" class="form-control select2"
                                    onblur="checkValidation('dapvr_case', 'case_year_for_dapvr_case', selectcaseyearValidationMessage);"
                                    onchange="DAPVRCase.listview.caseyearChangeEvent($(this));" 
                                    data-placeholder="Select Case Year !" style="width: 100%;">  
                            </select>
                            <span class="error-message error-message-dapvr_case-case_year_for_dapvr_case"></span>
                        </div>
                        <div class="form-group col-sm-4" id="div_case_no_for_dapvr_case">
                            <label>Case No. <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <input type="text" id="case_no_for_dapvr_case" name="case_no_for_dapvr_case" class="form-control" placeholder="Enter Case Number !"
                                       maxlength="50" value="{{case_no}}" onblur="checkValidation('dapvr_case', 'case_no_for_dapvr_case', CaseNoValidationMessage);">
                            </div>
                            <span class="error-message error-message-dapvr_case-case_no_for_dapvr_case"></span>
                        </div>
                        <!--                        <div class="form-group col-sm-4">
                                                    <label>Department <span class="color-nic-red">*</span></label>
                                                    <input type="text" id="department_for_dapvr_case" name="department_for_dapvr_case" class="form-control"
                                                           maxlength="200" value="Mamlatdar Department" readonly>  
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label>Court <span class="color-nic-red">*</span></label>
                                                    <input type="text" id="court_for_dapvr_case" name="court_for_dapvr_case" class="form-control"
                                                           maxlength="200" value="Mamlatdar Court" readonly>  
                                                </div>-->
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>Case Response Type <span class="color-nic-red">*</span></label>
                            <select id="response_type_for_dapvr_case" name="response_type_for_dapvr_case" class="form-control select2"
                                    onblur="checkValidation('dapvr_case', 'response_type_for_dapvr_case', selectcaseresponsetypeValidationMessage);"
                                    data-placeholder="Select Case Response Type" style="width: 100%;">  
                            </select>
                            <span class="error-message error-message-dapvr_case-response_type_for_dapvr_case"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Case Type <span class="color-nic-red">*</span></label>
                            <select id="case_type_for_dapvr_case" name="case_type_for_dapvr_case" class="form-control select2"
                                    onblur="checkValidation('dapvr_case', 'case_type_for_dapvr_case', selectcasetypeValidationMessage);"
                                    data-placeholder="Select Case Type !" style="width: 100%;">  
                            </select>
                            <span class="error-message error-message-dapvr_case-case_type_for_dapvr_case"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Register Date<span style="color: red;">*</span></label>
                            <div class="input-group date">
                                <input type="text" name="register_date_for_dapvr_case" id="register_date_for_dapvr_case" class="form-control"
                                       placeholder="dd-mm-yyyy" data-date-format="DD-MM-YYYY" value="{{register_date_text}}" >

                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                </div>
                            </div>
                            <span class="error-message error-message-dapvr_case-register_date_for_dapvr_case"></span>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Case Status <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <select id="case_status_for_dapvr_case" name="case_status_for_dapvr_case" class="form-control select2"
                                        onblur="checkValidation('dapvr_case', 'case_status_for_dapvr_case', selectcasestatusValidationMessage);"
                                        data-placeholder="Select Case Status !" style="width: 100%;">  
                                </select>
                            </div>
                            <span class="error-message error-message-dapvr_case-case_status_for_dapvr_case"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>Brief of matter <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea type="text" id="matter_for_dapvr_case" name="matter_for_dapvr_case" class="form-control" placeholder="Enter Brief of matter !"
                                          onblur="checkValidation('dapvr_case', 'matter_for_dapvr_case', matterValidationMessage);">{{brief_matter}}</textarea>
                            </div>
                            <span class="error-message error-message-dapvr_case-matter_for_dapvr_case"></span>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>Rojnamu <span class="color-nic-red">*</span></label>
                            <div class="input-group">
                                <textarea type="text" id="rojnamu_for_dapvr_case" name="rojnamu_for_dapvr_case" class="form-control" placeholder="Enter Rojnamu !"
                                          onblur="checkValidation('dapvr_case', 'rojnamu_for_dapvr_case', rojnamuValidationMessage);">{{rojnamu}}</textarea>
                            </div>
                            <span class="error-message error-message-dapvr_case-rojnamu_for_dapvr_case"></span>
                        </div>
                    </div>
                    <div class="card applicant_have_earning_member_item_container_for_heirship">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    1. Land Details
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-dapvr_case-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 30px;">Sr.No.</th>

                                            <th class="p-1" style="min-width: 80px;">Village<span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 50px;">Survey <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 50px;">Subdiv <span class="color-nic-red">*</span></th>
                                            <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="land_details_container_for_dapvr_case">
                                    </tbody>
                                </table>
                            </div> 
                            <div class="row">
                                <div class="col-6 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="DAPVRCase.listview.addMoreLandDetails({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card applicant_have_earning_member_item_container_for_heirship">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    2. Petitioner Details
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-dapvr_case-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 20px;">Sr.No.</th>                                            
                                            <th class="p-1" style="min-width: 80px;">Name<span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 90px;">Address <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 200px;">Advocate Name
                                                <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                                        onclick="DAPVRCase.listview.AddAdvocate();" id="add_adv_btn_for_dapvr_case">
                                                    <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add
                                                </button></th>
                                            <th class="p-1" style="min-width: 40px;">Adv. Mob No. </th>
                                            <th class="p-1" style="min-width: 40px;">Adv. Email Id </th>
                                            <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="petitioner_info_container_for_dapvr_case">
                                    </tbody>
                                </table>
                            </div> 
                            <div class="row">
                                <div class="col-6 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="DAPVRCase.listview.addMorepetitioner({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card applicant_have_earning_member_item_container_for_heirship">
                        <div class="card-header pt-1 pb-1 bg-nic-blue">
                            <div class="row">
                                <div class="col-12 f-w-b">
                                    3. Respondent Details
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-nic-blue">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <span class="error-message error-message-dapvr_case-mi f-w-b"
                                          style="border-bottom: 2px solid red;"></span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover-cells m-0 f-s">
                                    <thead>
                                        <tr class="bg-light-gray">
                                            <th class="text-center p-1" style="width: 20px;">Sr.No.</th>                                            
                                            <th class="p-1" style="min-width: 80px;">Name<span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 90px;">Address <span class="color-nic-red">*</span></th>
                                            <th class="p-1" style="min-width: 200px;">Advocate Name
                                                <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                                        onclick="DAPVRCase.listview.AddAdvocate();" id="add_adv_btn_for_dapvr_case">
                                                    <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add
                                                </button>
                                            </th>
                                            <th class="p-1" style="min-width: 40px;">Adv. Mob No.</th>
                                            <th class="p-1" style="min-width: 40px;">Adv. Email Id</th>
                                            <th class="text-center p-1" style="min-width: 60px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="respondent_info_container_for_dapvr_case">
                                    </tbody>
                                </table>
                            </div> 
                            <div class="row">
                                <div class="col-6 f-w-b pt-2">
                                </div>
                                <div class="col-3 f-w-b pt-2">
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12 f-w-b pt-2">
                                    <button type="button" class="btn btn-sm btn-nic-blue float-right"
                                            onclick="DAPVRCase.listview.addMoreRespondent({}, true);">
                                        <i class="fas fa-plus-circle" style="margin-right: 5px;"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="m-b-1rem"> 
                    <div>
                        <button type="button" id="draft_btn_for_dapvr_case" class="btn btn-sm btn-success" onclick="DAPVRCase.listview.submitdapvrCase({{VALUE_ONE}});">Submit</button>
                        <!--<button type="button" id="submit_btn_for_dapvr_case" class="btn btn-sm btn-success" onclick="DAPVRCase.listview.askForsubmitdapvrCase({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>-->
                        <button type="button" class="btn btn-sm btn-danger" onclick="DAPVRCase.listview.loadDapvrCaseData();">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>