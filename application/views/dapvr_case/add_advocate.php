<div class="card-header">
    <h3 class="card-title" style="float: none; text-align: center;">Add Advocate</h3>
</div>
<form role="form" id="add_advocate_dapvr_case_form" name="add_advocate_dapvr_case_form" onsubmit="return false;" style="font-size: 14px;">

    <div class="card-body p-b-0px text-left">
        <div class="row">
            <div class="col-sm-12 text-center">
                <span class="error-message error-message-dapvr_case-add_advocate f-w-b" style="border-bottom: 2px solid red;"></span>
            </div>
        </div>     
        <div class="row">
            <div class="form-group col-sm-12 col-md-12">
                <label>Advocate Name <span style="color: red;">*</span></label>
                <input type="text" id="advocate_name_for_dapvr_case" name="advocate_name_for_dapvr_case" maxlength="100"  class="form-control" 
                       onblur="checkValidation('dapvr_case-add_advocate', 'advocate_name_for_dapvr_case', advnameValidationMessage);" placeholder="Enter Name of Advocate !" value="{{advocate_name}}">
                <span class="error-message error-message-dapvr_case-add_advocate-advocate_name_for_dapvr_case"></span>
            </div>
            <div class="form-group col-sm-12 col-md-12">
                <label>Mobile No. <span style="color: red;">*</span></label>
                <input type="text" id="advocate_mobile_number_for_dapvr_case" name="advocate_mobile_number_for_dapvr_case" class="form-control" placeholder="Enter Mobile Number !"
                       maxlength="10" onkeyup="checkNumeric($(this));"  
                      value="{{advocate_mobile_number}}">
                <span class="error-message error-message-dapvr_case-add_advocate-advocate_mobile_number_for_dapvr_case"></span>
            </div> 
            <!--onblur="checkValidationForMobileNumber('dapvr_case-add_advocate', 'advocate_mobile_number_for_dapvr_case');"-->
            <div class="form-group col-sm-12 col-md-12">
                <label>Email Id <span style="color: red;">*</span></label>
                <input type="text" id="advocate_email_for_dapvr_case" name="advocate_email_for_dapvr_case"
                       class="form-control" placeholder="Enter Email Address !"  maxlength="50"                       
                <span class="error-message error-message-dapvr_case-add_advocate-advocate_email_for_dapvr_case"></span>
            </div> 
            <!--onblur="checkValidationForEmail('dapvr_case-add_advocate', 'advocate_email_for_dapvr_case');" value="{{advocate_email}}">-->
            <div class="form-group col-sm-12 ">
                <button type="button" id="submit_btn_for_add_advocate_dapvr_case" class="btn btn-sm btn-success" onclick="DAPVRCase.listview.submitAdvocate();"
                        style="margin-right: 5px;">Submit</button>

                <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
            </div>
        </div>
    </div>
</form>