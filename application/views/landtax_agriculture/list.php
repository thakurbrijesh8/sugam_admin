<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> Land Tax Agriculture</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Land Tax Agriculture</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="landtax_agriculture_datatable_main_container">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="village_for_landtax_agriculture_list" class="form-control select2"
                                onchange="villageChangeEvent($(this), 'landtax_agriculture_list', false, VALUE_TWO);"
                                data-placeholder="Select Village !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-landtax_agriculture_list-village_for_landtax_agriculture_list"></span>
                    </div>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <input type="text" id="khata_number_for_landtax_agriculture_list" 
                               class="form-control" placeholder="Khata Number" />
                    </div>
                    <div class="form-group col-12 col-sm-8 col-lg-4">
                        <input type="text" id="occupant_name_for_landtax_agriculture_list" class="form-control" 
                               placeholder="Occupant Name" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-success pull-right" style="padding: 2px 7px;"
                        onclick="LandTaxAgriculture.listview.downloadExcelForLandTaxAgriculture();">
                    <i class="fas fa-file-excel" style="margin-right: 2px;"></i>&nbsp; Download Excel</button>
                <button type="button" class="btn btn-sm btn-nic-blue pull-right mr-2" style="padding: 2px 7px;"
                        onclick="LandTaxAgriculture.listview.searchLandTaxAgricultureData($(this));">
                    <i class="fas fa-search" style="margin-right: 2px;"></i>&nbsp; Search</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body" id="landtax_agriculture_datatable_container">
            </div>
        </div>
    </div>
    <div class="container-fluid" id="landtax_agriculture_form_container"></div>
</section>
<form target="_blank" id="download_landtax_agriculture_excel_form" action="land_tax_agriculture_download_excel" method="post">
    <input type="hidden" id="village_for_landtax_agriculture" name="village_for_landtax_agriculture" class="ltagri" />
    <input type="hidden" id="survey_number_for_landtax_agriculture" name="survey_number_for_landtax_agriculture" class="ltagri" />
    <input type="hidden" id="subdivision_number_for_landtax_agriculture" name="subdivision_number_for_landtax_agriculture" class="ltagri" />
    <input type="hidden" id="khata_number_for_landtax_agriculture" name="khata_number_for_landtax_agriculture" class="ltagri" />
    <input type="hidden" id="occupant_name_for_landtax_agriculture" name="occupant_name_for_landtax_agriculture" class="ltagri" />
</form>
<!-- <form target="_blank" id="download_landtax_agriculture_excel_form_for_land_details" action="land_tax_na_land_details_download_excel" method="post">
    <input type="hidden" id="village_for_ltgeld" name="village_for_ltgeld" class="ltgeld" />
    <input type="hidden" id="khata_number_for_ltgeld" name="khata_number_for_ltgeld" class="ltgeld" />
</form> -->
<form target="_blank" id="generate_notice_pdf_form_for_landtax_agriculture" action="land_tax_agriculture_generate_notice" method="post">
    <input type="hidden" name="landtax_agriculture_id_for_landtax_agriculture" id="landtax_agriculture_id_for_landtax_agriculture">
</form>
<form target="_blank" id="download_landtax_agriculture_notice" action="land_tax_agriculture_download_notice" method="post">
    <input type="hidden" name="landtax_agriculture_notice_id_for_ltag" id="landtax_agriculture_notice_id_for_ltag">
</form>
<form target="_blank" id="download_tr_five_pdf_for_agrild" action="land_tax_agri_download_tr_five" method="post">
    <input type="hidden" name="agri_land_tax_payment_id_for_dtrfagrild" id="agri_land_tax_payment_id_for_dtrfagrild">
</form>