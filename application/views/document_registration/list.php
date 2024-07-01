<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h1 class="m-0 text-dark"><i class="nav-icon fas fa-id-card"></i> Application for Document Registration</h1>
            </div>
            <div class="col-sm-12 col-md-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item">Sub-Registrar Office</li>
                    <li class="breadcrumb-item active">Document Registration</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="document_registration_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="dr_fee_receipt_form" action="document_registration/generate_fee_receipt" method="post">
    <input type="hidden" id="dr_id_for_dr_list_gfr" name="dr_id_for_dr_list_gfr" value="">
</form>
<form target="_blank" id="dr_endorsement_form" action="document_registration/generate_endorsement" method="post">
    <input type="hidden" id="dr_id_for_dr_list_gend" name="dr_id_for_dr_list_gend" value="">
</form>
<form target="_blank" id="generate_excel_for_document_registration" action="document_registration/generate_excel" method="post">
    <input type="hidden" id="doc_number_for_document_registration_excel" name="doc_number_for_document_registration_excel">
    <input type="hidden" id="temp_application_number_for_document_registration_excel" name="temp_application_number_for_document_registration_excel">
    <input type="hidden" id="party_details_for_document_registration_excel" name="party_details_for_document_registration_excel">
    <input type="hidden" id="doc_type_for_document_registration_excel" name="doc_type_for_document_registration_excel">
    <input type="hidden" id="appointment_status_for_document_registration_excel" name="appointment_status_for_document_registration_excel">
    <input type="hidden" id="query_status_for_document_registration_excel" name="query_status_for_document_registration_excel">
    <input type="hidden" id="status_for_document_registration_excel" name="status_for_document_registration_excel">
</form>