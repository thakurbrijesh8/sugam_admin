<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> NCL (OBC Renewal) Certificate</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item">Certificates</li>
                    <li class="breadcrumb-item active">NCL (OBC Renewal) Certificate</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="ncl_certificate_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="ncl_certificate_pdf_form" action="ncl_certificate/download_certificate" method="post">
    <input type="hidden" id="ncl_certificate_id_for_certificate" name="ncl_certificate_id_for_certificate">
    <input type="hidden" id="mtype_for_certificate" name="mtype_for_certificate">
</form>
<form target="_blank" id="ncl_certificate_document_for_scrutiny" action="ncl_certificate/document_for_scrutiny" method="post">
    <input type="hidden" id="ncl_certificate_id_for_scrutiny" name="ncl_certificate_id_for_scrutiny">
</form>
<form target="_blank" id="generate_excel_for_ncl_certificate" action="ncl_certificate/generate_excel" method="post">
    <input type="hidden" id="app_no_for_ncge" name="app_no_for_ncge" class="ncge" />
    <input type="hidden" id="app_date_for_ncge" name="app_date_for_ncge" class="ncge" />
    <input type="hidden" id="app_details_for_ncge" name="app_details_for_ncge" class="ncge" />
    <input type="hidden" id="vdw_for_ncge" name="vdw_for_ncge" class="ncge" />
    <input type="hidden" id="status_for_ncge" name="status_for_ncge" class="ncge" />
    <input type="hidden" id="qstatus_for_ncge" name="qstatus_for_ncge" class="ncge" />
    <input type="hidden" id="currently_on_for_ncge" name="currently_on_for_ncge" class="ncge" />
    <input type="hidden" id="app_status_for_ncge" name="app_status_for_ncge" class="ncge" />
</form>

