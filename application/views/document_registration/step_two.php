<form role="form" id="drstwo_form" name="drstwo_form" onsubmit="return false;" autocomplete="off">
    <input type="hidden" id="document_registration_id_for_dr" name="document_registration_id_for_dr" value="{{document_registration_id}}" />
    <input type="hidden" id="doc_consideration_amount_for_dr" name="doc_consideration_amount_for_dr" value="{{doc_consideration_amount}}" />
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-drstwo f-w-b"
                  style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6 text-center">
            <h3 class="card-title f-w-b pt-1 fs-1rem"><span class="text-primary">Temp Application Number : </span><span id="temp_application_number_container_for_drstwo">{{temp_application_number}}</span></h3>
        </div>
        <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-sm btn-success prev_btn_for_dratwo" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.loadStepWiseForm($('.prev_btn_for_dratwo'), VALUE_ONE);"><i class="fas fa-arrow-left"></i>&nbsp; Previous</button>
            <button type="button" class="btn btn-sm btn-success next_btn_for_drstwo" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.submitDRSTwo($('.next_btn_for_drstwo'));"><i class="fas fa-arrow-right"></i>&nbsp; Save & Continue</button>
            <button type="button" class="btn btn-sm btn-danger" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.loadDocumentRegistrationData();"><i class="fas fa-times"></i>&nbsp; Cancel</button>
        </div>
        <div class="col-sm-12"><hr class="mt-3"></div>
    </div>
    <div id="party_details_main_container_for_drstwo"></div>
    <div class="row"><div class="mt-3 col-12"><hr></div></div>
    <div class="row">
        <div class="mt-3 col-12 text-right">
            <button type="button" class="btn btn-sm btn-success prev_btn_for_dratwo" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.loadStepWiseForm($('.prev_btn_for_dratwo'), VALUE_ONE);"><i class="fas fa-arrow-left"></i>&nbsp; Previous</button>
            <button type="button" class="btn btn-sm btn-success next_btn_for_drstwo" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.submitDRSTwo($('.next_btn_for_drstwo'));"><i class="fas fa-arrow-right"></i>&nbsp; Save & Continue</button>
            <button type="button" class="btn btn-sm btn-danger" style="padding: 2px 7px;"
                    onclick="DocumentRegistration.listview.loadDocumentRegistrationData();"><i class="fas fa-times"></i>&nbsp; Cancel</button>
        </div>
    </div>
</form>