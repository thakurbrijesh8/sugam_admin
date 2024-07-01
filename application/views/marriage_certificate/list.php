<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fas fa-id-card"></i> Application for issue of Marriage Certificate</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item active">Marriage Certificate</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="marriage_certificate_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="marriage_certificate_pdf_form" action="marriage_certificate/download_certificate" method="post">
    <input type="hidden" id="marriage_certificate_id_for_certificate" name="marriage_certificate_id_for_certificate">
    <input type="hidden" id="mtype_for_certificate" name="mtype_for_certificate">
</form>
<form target="_blank" id="mc_declaration_pdf" action="marriage_certificate/download_mc_declaration" method="post">
    <input type="hidden" id="marriage_certificate_id_for_mc_declaration" name="marriage_certificate_id_for_mc_declaration" value="{{marriage_certificate_id}}">
</form>
<form target="_blank" id="generate_excel_for_marriage_certificate" action="marriage_certificate/generate_excel" method="post">
    <input type="hidden" id="app_no_for_mcge" name="app_no_for_mcge" class="mcge" />
    <input type="hidden" id="app_details_for_mcge" name="app_details_for_mcge" class="mcge" />
    <input type="hidden" id="status_for_mcge" name="status_for_mcge" class="mcge" />
    <input type="hidden" id="qstatus_for_mcge" name="qstatus_for_mcge" class="mcge" />
</form>