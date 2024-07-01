<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> Domicile Certificate</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item">Certificates</li>
                    <li class="breadcrumb-item active">Domicile Certificate</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="domicile_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="domicile_certificate_pdf_form" action="domicile/download_certificate" method="post">
    <input type="hidden" id="domicile_certificate_id_for_certificate" name="domicile_certificate_id_for_certificate">
    <input type="hidden" id="mtype_for_certificate" name="mtype_for_certificate">
</form>
<form target="_blank" id="domicile_certificate_document_for_scrutiny" action="domicile/document_for_scrutiny" method="post">
    <input type="hidden" id="domicile_certificate_id_for_scrutiny" name="domicile_certificate_id_for_scrutiny">
</form>
<form target="_blank" id="generate_excel_for_domicile" action="domicile/generate_excel" method="post">
    <input type="hidden" id="app_no_for_dcge" name="app_no_for_dcge" class="dcge" />
    <input type="hidden" id="app_date_for_dcge" name="app_date_for_dcge" class="dcge" />
    <input type="hidden" id="app_details_for_dcge" name="app_details_for_dcge" class="dcge" />
    <input type="hidden" id="vdw_for_dcge" name="vdw_for_dcge" class="dcge" />
    <input type="hidden" id="status_for_dcge" name="status_for_dcge" class="dcge" />
    <input type="hidden" id="qstatus_for_dcge" name="qstatus_for_dcge" class="dcge" />
    <input type="hidden" id="currently_on_for_dcge" name="currently_on_for_dcge" class="dcge" />
    <input type="hidden" id="app_status_for_dcge" name="app_status_for_dcge" class="dcge" />
</form>

