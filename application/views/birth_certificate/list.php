<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fas fa-id-card"></i> Application for issue of Birth Certificate</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item active">Birth Certificate</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="birth_certificate_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="birth_certificate_pdf_form" action="birth_certificate/download_certificate" method="post">
    <input type="hidden" id="birth_certificate_id_for_certificate" name="birth_certificate_id_for_certificate">
    <input type="hidden" id="mtype_for_certificate" name="mtype_for_certificate">
</form>
<form target="_blank" id="generate_excel_for_birth_certificate" action="birth_certificate/generate_excel" method="post">
    <input type="hidden" id="app_no_for_bcge" name="app_no_for_bcge" class="bcge" />
    <input type="hidden" id="app_details_for_bcge" name="app_details_for_bcge" class="bcge" />
    <input type="hidden" id="status_for_bcge" name="status_for_bcge" class="bcge" />
    <input type="hidden" id="qstatus_for_bcge" name="qstatus_for_bcge" class="bcge" />
</form>