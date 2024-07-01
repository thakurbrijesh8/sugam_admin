<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> Land Tax (N.A.)</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Land Tax (N.A.)</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="landtax_na_datatable_main_container">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="village_for_landtax_na_list" class="form-control select2"
                                onchange="villageChangeEvent($(this), 'landtax_na_list', false, VALUE_TWO);"
                                data-placeholder="Select Village !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-landtax_na_list-village_for_landtax_na_list"></span>
                    </div>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="survey_number_for_landtax_na_list" class="form-control select2"
                                onchange="surveyNumberChangeEvent($(this), 'landtax_na_list', false, VALUE_TWO);"
                                data-placeholder="Select Survey !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-landtax_na_list-survey_number_for_landtax_na_list"></span>
                    </div>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="subdivision_number_for_landtax_na_list" class="form-control select2"
                                data-placeholder="Select Subdiv !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-landtax_na_list-subdivision_number_for_landtax_na_list"></span>
                    </div>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <input type="text" id="khata_number_for_landtax_na_list" 
                               class="form-control" placeholder="Khata Number" />
                    </div>
                    <div class="form-group col-12 col-sm-8 col-lg-4">
                        <input type="text" id="occupant_name_for_landtax_na_list" class="form-control" 
                               placeholder="Occupant Name / Aadhar Number / Mobile Number" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-success pull-right" style="padding: 2px 7px;"
                        onclick="LandTaxNA.listview.downloadExcelForLandTaxNA();">
                    <i class="fas fa-file-excel" style="margin-right: 2px;"></i>&nbsp; Download Excel</button>
                <button type="button" id="search_btn_for_landtax_na_list" class="btn btn-sm btn-nic-blue pull-right mr-2" style="padding: 2px 7px;"
                        onclick="LandTaxNA.listview.searchLandTaxNAData($(this));">
                    <i class="fas fa-search" style="margin-right: 2px;"></i>&nbsp; Search</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body" id="landtax_na_datatable_container">
            </div>
        </div>
    </div>
    <div class="container-fluid" id="landtax_na_form_container"></div>
</section>
<form target="_blank" id="download_landtax_na_excel_form" action="land_tax_na_download_excel" method="post">
    <input type="hidden" id="village_for_ltge" name="village_for_ltge" class="ltge" />
    <input type="hidden" id="survey_number_for_ltge" name="survey_number_for_ltge" class="ltge" />
    <input type="hidden" id="subdivision_number_for_ltge" name="subdivision_number_for_ltge" class="ltge" />
    <input type="hidden" id="khata_number_for_ltge" name="khata_number_for_ltge" class="ltge" />
    <input type="hidden" id="occupant_name_for_ltge" name="occupant_name_for_ltge" class="ltge" />
</form>
<form target="_blank" id="download_landtax_na_excel_form_for_land_details" action="land_tax_na_land_details_download_excel" method="post">
    <input type="hidden" id="village_for_ltgeld" name="village_for_ltgeld" class="ltgeld" />
    <input type="hidden" id="khata_number_for_ltgeld" name="khata_number_for_ltgeld" class="ltgeld" />
</form>
<form target="_blank" id="generate_notice_pdf_form_for_land_details" action="land_tax_na_generate_notice" method="post">
    <input type="hidden" name="occupant_ids_for_gnnald" id="occupant_ids_for_gnnald">
</form>
<form target="_blank" id="download_landtax_na_notice" action="land_tax_na_download_notice" method="post">
    <input type="hidden" name="rlp_notice_id_for_dnnald" id="rlp_notice_id_for_dnnald">
</form>
<form target="_blank" id="download_tr_five_pdf_for_nald" action="land_tax_na_download_tr_five" method="post">
    <input type="hidden" name="rlp_land_tax_payment_id_for_dtrfnald" id="rlp_land_tax_payment_id_for_dtrfnald">
</form>