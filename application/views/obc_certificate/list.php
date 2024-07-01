<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> OBC Certificate</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item">Certificates</li>
                    <li class="breadcrumb-item active">OBC Certificate</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="obc_certificate_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="obc_certificate_pdf_form" action="obc_certificate/download_certificate" method="post">
    <input type="hidden" id="obc_certificate_id_for_certificate" name="obc_certificate_id_for_certificate">
    <input type="hidden" id="mtype_for_certificate" name="mtype_for_certificate">
</form>
<form target="_blank" id="obc_migrant_certificate_pdf_form" action="obc_certificate/download_migrant_certificate" method="post">
    <input type="hidden" id="obc_migrant_certificate_id_for_certificate" name="obc_migrant_certificate_id_for_certificate">
    <input type="hidden" id="mtype_migrant_for_certificate" name="mtype_migrant_for_certificate">
</form>
<form target="_blank" id="obc_certificate_document_for_scrutiny" action="obc_certificate/document_for_scrutiny" method="post">
    <input type="hidden" id="obc_certificate_id_for_scrutiny" name="obc_certificate_id_for_scrutiny">
</form>
<form target="_blank" id="generate_excel_for_obc_certificate" action="obc_certificate/generate_excel" method="post">
    <input type="hidden" id="app_no_for_ocge" name="app_no_for_ocge" class="ocge" />
    <input type="hidden" id="app_date_for_ocge" name="app_date_for_ocge" class="ocge" />
    <input type="hidden" id="app_details_for_ocge" name="app_details_for_ocge" class="ocge" />
    <input type="hidden" id="vdw_for_ocge" name="vdw_for_ocge" class="ocge" />
    <input type="hidden" id="status_for_ocge" name="status_for_ocge" class="ocge" />
    <input type="hidden" id="qstatus_for_ocge" name="qstatus_for_ocge" class="ocge" />
    <input type="hidden" id="currently_on_for_ocge" name="currently_on_for_ocge" class="ocge" />
    <input type="hidden" id="app_status_for_ocge" name="app_status_for_ocge" class="ocge" />
</form>

