<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-id-card"></i> Assign Khata Number V2</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item">Mamlatdar Office</li>
                    <li class="breadcrumb-item active">Assign Khata Number V2</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="assign_khata_number_v2_datatable_main_container">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="village_for_assign_khata_number_v2_list" class="form-control select2"
                                onchange="villageChangeEvent($(this), 'assign_khata_number_v2_list', false, VALUE_ONE);"
                                data-placeholder="Select Village !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-assign_khata_number_v2_list-village_for_assign_khata_number_v2_list"></span>
                    </div>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="survey_number_for_assign_khata_number_v2_list" class="form-control select2"
                                onchange="surveyNumberChangeEvent($(this), 'assign_khata_number_v2_list', false, VALUE_ONE);"
                                data-placeholder="Select Survey !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-assign_khata_number_v2_list-survey_number_for_assign_khata_number_v2_list"></span>
                    </div>
                    <div class="form-group col-6 col-sm-4 col-lg-2">
                        <select id="subdivision_number_for_assign_khata_number_v2_list" class="form-control select2"
                                data-placeholder="Select Subdiv !" style="width: 100%;">
                        </select>
                        <span class="error-message error-message-assign_khata_number_v2_list-subdivision_number_for_assign_khata_number_v2_list"></span>
                    </div>
                    <div class="form-group col-12 col-sm-8 col-lg-4">
                        <input type="text" id="occupant_name_for_assign_khata_number_v2_list" class="form-control" 
                               placeholder="Occupant Name" />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-success pull-right" style="padding: 2px 7px;"
                        onclick="ArrearsUpdate.listview.downloadExcelForAssignKhataNumberV2();">
                    <i class="fas fa-file-excel" style="margin-right: 2px;"></i>&nbsp; Download Excel</button>
                <button type="button" id="search_btn_for_assign_khata_number_v2_list" class="btn btn-sm btn-nic-blue pull-right mr-2" style="padding: 2px 7px;"
                        onclick="ArrearsUpdate.listview.searchAssignKhataNumberVTwoData($(this));">
                    <i class="fas fa-search" style="margin-right: 2px;"></i>&nbsp; Search</button>
            </div>
        </div>
        <!--        <div class="card">
                    <div class="card-body" id="assign_khata_number_v2_datatable_container">
                    </div>
                </div>-->
    </div>
    <div class="container-fluid" id="assign_khata_number_v2_form_and_datatable_container"></div>
</section>
<!--<section class="content">
    <div class="container-fluid" id="assign_khata_number_v2_form_and_datatable_container">
    </div>
</section>-->
<form target="_blank" id="download_assign_khata_number_v2_excel_form" action="assign_khata_number_v2/download_excel_for_assign_khata_number_v2" method="post">
    <input type="hidden" id="village_for_aknv2ge" name="village_for_aknv2ge" class="aknv2ge" />
    <input type="hidden" id="survey_number_for_aknv2ge" name="survey_number_for_aknv2ge" class="aknv2ge" />
    <input type="hidden" id="subdivision_number_for_aknv2ge" name="subdivision_number_for_aknv2ge" class="aknv2ge" />
    <input type="hidden" id="occupant_name_for_aknv2ge" name="occupant_name_for_aknv2ge" class="aknv2ge" />
</form>