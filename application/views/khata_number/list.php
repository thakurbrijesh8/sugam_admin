<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> Khata Number</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Khata Number</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="village_for_khata_number_list" class="form-control select2"
                                onchange="villageChangeEvent($(this), 'khata_number_list');"
                                data-placeholder="Select Village !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-khata_number_list-village_for_khata_number_list"></span>
                    </div>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="survey_number_for_khata_number_list" class="form-control select2"
                                onchange="surveyNumberChangeEvent($(this), 'khata_number_list');"
                                data-placeholder="Select Survey !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-khata_number_list-survey_number_for_khata_number_list"></span>
                    </div>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="subdivision_number_for_khata_number_list" class="form-control select2"
                                data-placeholder="Select Subdiv !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-khata_number_list-subdivision_number_for_khata_number_list"></span>
                    </div>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <input type="text" id="khata_number_for_khata_number_list" 
                               class="form-control" placeholder="Khata Number" />
                    </div>
                    <div class="form-group col-12 col-sm-8 col-lg-4">
                        <input type="text" id="occupant_name_for_khata_number_list" class="form-control" 
                               placeholder="Occupant Name / Aadhar Number / Mobile Number" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-success pull-right" style="padding: 2px 7px;"
                        onclick="KhataNumber.listview.downloadExcelForKhataNumber();">
                    <i class="fas fa-file-excel" style="margin-right: 2px;"></i>&nbsp; Download Excel</button>
                <button type="button" class="btn btn-sm btn-nic-blue pull-right mr-2" style="padding: 2px 7px;"
                        onclick="KhataNumber.listview.searchKhataNumberData($(this));">
                    <i class="fas fa-search" style="margin-right: 2px;"></i>&nbsp; Search</button>                
            </div>
        </div>
        <div class="card">
            <div class="card-body" id="khata_number_form_and_datatable_container">
            </div>
        </div>
    </div>
</section>
<form target="_blank" id="download_land_details_of_kndl" action="khata_number/download_land_details_of_khata_number" method="post">
    <input type="hidden" name="temp_type_for_kndl" id="temp_type_for_kndl" class="kndl">
    <input type="hidden" name="village_for_kndl" id="village_for_kndl" class="kndl">
    <input type="hidden" name="khata_number_for_kndl" id="khata_number_for_kndl" class="kndl">
</form>
<form target="_blank" id="download_khata_number_excel_form" action="khata_number/download_excel_for_khata_number" method="post">
    <input type="hidden" id="village_for_knge" name="village_for_knge" class="knge" />
    <input type="hidden" id="survey_number_for_knge" name="survey_number_for_knge" class="knge" />
    <input type="hidden" id="subdivision_number_for_knge" name="subdivision_number_for_knge" class="knge" />
    <input type="hidden" id="khata_number_for_knge" name="khata_number_for_knge" class="knge" />
    <input type="hidden" id="occupant_name_for_knge" name="occupant_name_for_knge" class="knge" />
</form>