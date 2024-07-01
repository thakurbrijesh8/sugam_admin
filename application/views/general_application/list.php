<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fas fa-id-card"></i> General Application</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item">Mamlatdar Office</li>
                    <li class="breadcrumb-item active">General Application</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="general_application_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="download_general_application_history_report" action="general_application/general_application_report_pdf" method="post">
    <input type="hidden" name="general_application_history_id_for_gah" id="general_application_history_id_for_gah">
</form>
<form target="_blank" id="general_application_report_for_report" action="general_application/general_application_download_report" method="post">
    <input type="hidden" name="general_application_id_for_report" id="general_application_id_for_report">
</form>
<form target="_blank" id="general_application_pdf_form" action="general_application/general_application_download_certificate" method="post">
    <input type="hidden" name="general_application_id_for_certificate" id="general_application_id_for_certificate">
</form>