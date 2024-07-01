<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> Character Certificate</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item">Certificates</li>
                    <li class="breadcrumb-item active">Character Certificate</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="character_certificate_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="character_certificate_pdf_form" action="character_certificate/download_certificate" method="post">
    <input type="hidden" id="character_certificate_id_for_certificate" name="character_certificate_id_for_certificate">
</form>
<form target="_blank" id="character_certificate_document_for_app_pdf" action="character_certificate/document_for_app_pdf" method="post">
    <input type="hidden" id="character_certificate_id_for_app_pdf" name="character_certificate_id_for_app_pdf">
</form>
<form target="_blank" id="character_certificate_document_for_issue_of_cc" action="character_certificate/document_for_issue_of_cc" method="post">
    <input type="hidden" id="character_certificate_id_for_issue_of_cc" name="character_certificate_id_for_issue_of_cc">
</form>
<form target="_blank" id="generate_excel_for_character_certificate" action="character_certificate/generate_excel" method="post">
    <input type="hidden" id="app_no_for_ccge" name="app_no_for_ccge" class="ccge" />
    <input type="hidden" id="app_date_for_ccge" name="app_date_for_ccge" class="ccge" />
    <input type="hidden" id="app_details_for_ccge" name="app_details_for_ccge" class="ccge" />
    <input type="hidden" id="vdw_for_ccge" name="vdw_for_ccge" class="ccge" />
    <input type="hidden" id="status_for_ccge" name="status_for_ccge" class="ccge" />
    <input type="hidden" id="qstatus_for_ccge" name="qstatus_for_ccge" class="ccge" />
    <input type="hidden" id="currently_on_for_ccge" name="currently_on_for_ccge" class="ccge" />
</form>