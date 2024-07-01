<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                 <h3 class="card-title f-w-b" style="float: none; text-align: center;">OBC Certificate Form </h3>
                <div style="font-size: 16px; text-align: center; margin-top: 0px;font-weight: bold;">Application form for issue of  OBC Certificate </div>
            </div>
            <form role="form" id="obc_upload_document_form" name="obc_upload_document_form" onsubmit="return false;">

                <input type="hidden" id="obc_certificate_id" name="obc_certificate_id" value="{{obc_certificate_id}}">

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <span class="error-message error-message-obc f-w-b"
                                  style="border-bottom: 2px solid red;"></span>
                        </div>
                    </div>
                    <h3 class="box-title f-w-b page-header color-nic-blue f-s-20px m-b-0">Upload Required Documents</h3>

                    <div class="row">
                        <div class="col-12 m-b-5px" id="applicant_photo_container_for_obc">
                            <label>1.. Applicant Photo (Latest) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload JPG | PNG | JPEG | JFIF Only)</span></label><br>
                            
                        </div>
                        <div class="form-group col-sm-12" id="applicant_photo_name_container_for_obc" style="display: none;">
                            <label>1.. Applicant Photo (Latest)<span style="color: red;">* </span></label><br>
                            <a target="_blank" id="applicant_photo_download"><img id="applicant_photo_name_image_for_obc" style="width: 250px; height: 250px; border: 2px solid blue;" class="spinner_name_container_for_obc_{{VALUE_ONE}}"></a>
                           
                        </div>
                        <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ONE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                    </div>
                    <!-- <div class="row">
                        <div class="form-group col-sm-6">
                            <label>21. Document Required to be Uploaded with the Application.<span class="color-nic-red">*</span></label>
                            <div id="document_upload_container_for_obc_certificate"></div>
                            <span class="error-message error-message-obc-certificate-document_upload_for_obc_certificate"></span>
                        </div>
                    </div> -->

                    <div class="row">
                            <div  class="birth_certificate_item_container_for_obc_certificate" style="display: none;"> 
                                <div class="col-12 m-b-5px" id="birth_certi_container_for_obc">
                                <label>2. Birth Certificate <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                    
                                </div>
                                <div class="form-group col-sm-12" id="birth_certi_name_container_for_obc" style="display: none;">
                                    <label>2. Birth Certificate<span style="color: red;">* </span></label><br>
                                    <a target="_blank" id="birth_certi_download"><label id="birth_certi_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_TWO}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                    
                                </div>
                                <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWO}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                            </div>
                    </div>        
                     
                    <div class="row">
                        <div  class="election_card_item_container_for_obc_certificate" style="display: none;">
                            <div class="col-12 m-b-5px" id="election_card_container_for_obc">
                                <label>3. Election Card <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                               
                            </div>
                            <div class="form-group col-sm-12" id="election_card_name_container_for_obc" style="display: none;">
                                <label>3. Election Card <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="election_card_download"><label id="election_card_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_THREE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_THREE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>  
                    </div> 
                       
                    <div class="row">
                        <div  class="aadhar_card_item_container_for_obc_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="aadhaar_card_container_for_obc">
                                <label>4. Aadhaar Card<span style="color: red;">* <br>(Maximum File Size: 2MB)(Upload pdf Only)</span></label><br>
                                
                            </div>
                            <div class="form-group col-sm-12" id="aadhaar_card_name_container_for_obc" style="display: none;">
                                <label>4. Aadhaar Card <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="aadhaar_card_download"><label id="aadhaar_card_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_FOUR}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FOUR}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div> 
                    </div>
                       
                    <div class="row">
                        <div  class="leaving_certificate_item_container_for_obc_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="leaving_certi_container_for_obc">
                            <label>5. Leaving Certificate <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                
                            </div>
                            <div class="form-group col-sm-12" id="leaving_certi_name_container_for_obc" style="display: none;">
                                <label>5. Leaving Certificate<span style="color: red;">* </span></label><br>
                                <a target="_blank" id="leaving_certi_download"><label id="leaving_certi_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_FIVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_FIVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>   


                    <div class="row">
                        <div  class="marriage_certificate_item_container_for_obc_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="marriage_certi_container_for_obc">
                            <label>6. Marriage Certificate (if married or widow woman applied) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                
                            </div>
                            <div class="form-group col-sm-12" id="marriage_certi_name_container_for_obc" style="display: none;">
                                <label>6. Marriage Certificate <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="marriage_certi_download"><label id="marriage_certi_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_SIX}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SIX}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>     

                    <div class="row">
                        <div  class="proof_document_item_container_for_obc_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="last_10year_proof_container_for_obc">
                            <label>7. Last 10 years Proof Documents (i.e. Gas Book, Bank Book, House tax, Rent Receipts, Sale Deed, Agreement Copy, Children Birth and leaving Certificate) <span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                
                            </div>
                            <div class="form-group col-sm-12" id="last_10year_proof_name_container_for_obc" style="display: none;">
                                <label>7. Last 10 years Proof Documents <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="last_10year_proof_download"><label id="last_10year_proof_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_SEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_SEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row">
                        <div  class="income_proof_item_container_for_obc_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="income_proof_container_for_obc">
                            <label>5. Income Proof<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                
                            </div>
                            <div class="form-group col-sm-12" id="income_proof_name_container_for_obc" style="display: none;">
                                <label>5. Income Proof <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="income_proof_download"><label id="income_proof_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_EIGHT}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_EIGHT}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row">
                        <div  class="gas_book_item_container_for_obc_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="gas_book_container_for_obc">
                            <label>6. Gas Book<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                
                            </div>
                            <div class="form-group col-sm-12" id="gas_book_name_container_for_obc" style="display: none;">
                                <label>6. Gas Book <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="gas_book_download"><label id="gas_book_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_NINE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_NINE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div> 
                    <div class="row">
                        <div  class="bank_book_item_container_for_obc_certificate" style="display: none;"> 
                            <div class="col-12 m-b-5px" id="bank_book_container_for_obc">
                            <label>7. Bank Book<span style="color: red;">* <br>(Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                
                            </div>
                            <div class="form-group col-sm-12" id="bank_book_name_container_for_obc" style="display: none;">
                                <label>7. Bank Book <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="bank_book_download"><label id="bank_book_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_TEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div> 
                    <div class="row mb-2 have_you_own_house_container_div" style="display: none;">
                        <div class="col-sm-6">
                            <label>8. Do You have Your Own House ? <span class="color-nic-red">*</span></label>
                            <div id="have_you_own_house_container_for_obc"></div>
                            <span class="error-message error-message-income-certificate-have_you_own_house_for_obc"></span>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="house_tax_receipt_item_container_for_obc col-sm-6" style="display: none;">
                            <div id="house_tax_receipt_container_for_obc">
                                <label>8.1 House Tax Receipt <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                
                            </div>
                            <div class="form-group" id="house_tax_receipt_name_container_for_obc" style="display: none;">
                                <label>8.1 House Tax Receipt <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="house_tax_receipt_download"><label id="house_tax_receipt_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_ELEVEN}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_ELEVEN}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="noc_with_notary_item_container_for_obc col-sm-6" style="display: none;">
                            <div id="noc_with_notary_container_for_obc">
                                <label>8.1 NOC With Notary alongwith Photo Attached <span style="color: red;">* (Maximum File Size: 1MB) &nbsp; (Upload PDF Only)</span></label><br>
                                
                            </div>
                            <div class="form-group" id="noc_with_notary_name_container_for_obc" style="display: none;">
                                <label>8.1 NOC With Notary alongwith Photo Attached <span style="color: red;">* </span></label><br>
                                <a target="_blank" id="noc_with_notary_download"><label id="noc_with_notary_name_image_for_obc" class="btn btn-sm btn-nic-blue f-w-n spinner_name_container_for_obc_{{VALUE_TWELVE}}">{{VIEW_UPLODED_DOCUMENT}}</label></a>
                                
                            </div>
                            <div class="text-center color-nic-blue col-3 m-b-5px" id="spinner_template_{{VALUE_TWELVE}}" style="display: none;"><i class="fas fa-sync-alt fa-spin fa-1x"></i></div>
                        </div>
                    </div>
                    <br/>

                    <div class="form-group">
                            <button type="button" id="previous_btn_for_spouse_details" class="btn btn-sm btn-success pull-right" onclick="Obc.listview.editOrViewObc($('#previous_btn_for_obc'), '{{obc_certificate_id}}', true, {{VALUE_THREE}});" style="margin-right: 5px;"><span class="fas fa-hand-point-left"></span> Previous</button>
                            <!-- <button type="button" id="draft_btn_for_obc" class="btn btn-sm btn-success pull-right" onclick="Obc.listview.submitSpouseDetails({{VALUE_ONE}});" style="margin-right: 5px;">Next <span class="fas fa-hand-point-right"></span></button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="Obc.listview.loadObcData();">Cancel</button> -->
                            <!-- <button type="button" id="draft_btn_for_obc" class="btn btn-sm btn-nic-blue" onclick="Obc.listview.submitUploadDocuments({{VALUE_ONE}});" style="margin-right: 5px;">Save as a Draft</button> -->
                            <button type="button" id="submit_btn_for_obc" class="btn btn-sm btn-success" onclick="Obc.listview.askForSubmitObc({{VALUE_TWO}});" style="margin-right: 5px;">Submit Application</button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="Obc.listview.loadObcData();">Close</button>
                            
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>