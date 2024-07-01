<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> Caste Certificate</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item">Certificates</li>
                    <li class="breadcrumb-item active">Caste Certificate</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="caste_certificate_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="caste_certificate_pdf_form" action="caste_certificate/download_certificate" method="post">
    <input type="hidden" id="caste_certificate_id_for_certificate" name="caste_certificate_id_for_certificate">
    <input type="hidden" id="mtype_for_certificate" name="mtype_for_certificate">
</form>
<!-- <form target="_blank" id="generate_excel_for_caste_certificate" action="caste_certificate/generate_excel" method="post">
</form> -->
<form target="_blank" id="caste_migrant_certificate_pdf_form" action="caste_certificate/download_migrant_certificate" method="post">
    <input type="hidden" id="caste_migrant_certificate_id_for_certificate" name="caste_migrant_certificate_id_for_certificate">
    <input type="hidden" id="mtype_migrant_for_caste_certificate" name="mtype_migrant_for_caste_certificate">
</form>

<form target="_blank" id="caste_certificate_document_for_scrutiny" action="caste_certificate/document_for_scrutiny" method="post">
    <input type="hidden" id="caste_certificate_id_for_scrutiny" name="caste_certificate_id_for_scrutiny">
</form>
<form target="_blank" id="generate_excel_for_caste_certificate" action="caste_certificate/generate_excel" method="post">
    <input type="hidden" id="app_no_for_ccge" name="app_no_for_ccge" class="ccge" />
    <input type="hidden" id="app_date_for_ccge" name="app_date_for_ccge" class="ccge" />
    <input type="hidden" id="app_details_for_ccge" name="app_details_for_ccge" class="ccge" />
    <input type="hidden" id="vdw_for_ccge" name="vdw_for_ccge" class="ccge" />
    <input type="hidden" id="status_for_ccge" name="status_for_ccge" class="ccge" />
    <input type="hidden" id="qstatus_for_ccge" name="qstatus_for_ccge" class="ccge" />
    <input type="hidden" id="currently_on_for_ccge" name="currently_on_for_ccge" class="ccge" />
    <input type="hidden" id="app_status_for_ccge" name="app_status_for_ccge" class="ccge" />
</form>

