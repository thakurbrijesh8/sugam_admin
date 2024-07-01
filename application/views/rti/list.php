<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> RTI</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item">Certificates</li>
                    <li class="breadcrumb-item active">RTI</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="rti_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="rti_pdf_form" action="rti/download_certificate" method="post">
    <input type="hidden" id="rti_id_for_certificate" name="rti_id_for_certificate">
    <input type="hidden" id="mtype_for_certificate" name="mtype_for_certificate">
</form>
<form target="_blank" id="rti_document_for_scrutiny" action="rti/document_for_scrutiny" method="post">
    <input type="hidden" id="rti_id_for_scrutiny" name="rti_id_for_scrutiny">
</form>
<form target="_blank" id="generate_excel_for_rti" action="rti/generate_excel" method="post">
    <input type="hidden" id="app_no_for_rtige" name="app_no_for_rtige" class="rtige" />
    <input type="hidden" id="app_date_for_rtige" name="app_date_for_rtige" class="rtige" />
    <input type="hidden" id="app_details_for_rtige" name="app_details_for_rtige" class="rtige" />
    <input type="hidden" id="vdw_for_rtige" name="vdw_for_rtige" class="rtige" />
    <input type="hidden" id="status_for_rtige" name="status_for_rtige" class="rtige" />
    <input type="hidden" id="qstatus_for_rtige" name="qstatus_for_rtige" class="rtige" />
</form>