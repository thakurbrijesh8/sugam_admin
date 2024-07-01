var landtaxNaListTemplate = Handlebars.compile($('#landtax_na_list_template').html());
var landtaxNaTableTemplate = Handlebars.compile($('#landtax_na_table_template').html());
var landtaxNaActionTemplate = Handlebars.compile($('#landtax_na_action_template').html());
var showNALandDetailTemplate = Handlebars.compile($('#landtax_na_show_land_template').html());
var landtaxNaNoticeHistoryListTemplate = Handlebars.compile($('#landtax_na_notice_history_list_template').html());
var landtaxNaPendingPaymentListTemplate = Handlebars.compile($('#landtax_na_pending_payment_list_template').html());
var landtaxNaPaymentHistoryListTemplate = Handlebars.compile($('#landtax_na_payment_history_list_template').html());
var landtaxNaPaymentHistoryItemTemplate = Handlebars.compile($('#landtax_na_payment_history_item_template').html());
var nhListTemplate = Handlebars.compile($('#nh_list_template').html());
var nhTableTemplate = Handlebars.compile($('#nh_table_template').html());
var nhActionTemplate = Handlebars.compile($('#nh_action_template').html());
var trFiveListTemplate = Handlebars.compile($('#tr_five_list_template').html());
var trFiveTableTemplate = Handlebars.compile($('#tr_five_table_template').html());
var trFiveActionTemplate = Handlebars.compile($('#tr_five_action_template').html());
var LandTaxNA = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
LandTaxNA.Router = Backbone.Router.extend({
    routes: {
        'landtax_na': 'renderList',
        'notice_history': 'renderListForNH',
        'tr_five_history': 'renderListForTRFive',
    },
    renderList: function () {
        LandTaxNA.listview.listPage();
    },
    renderListForNH: function () {
        LandTaxNA.listview.listPageForNH();
    },
    renderListForTRFive: function () {
        LandTaxNA.listview.listPageForTRFive();
    },
});
LandTaxNA.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (village = '', survey = '', subdiv = '') {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        var that = this;
        activeLink('menu_mamlatdar');
        addClass('landtax_na', 'active');
        LandTaxNA.router.navigate('landtax_na');
        var templateData = {};
        this.$el.html(landtaxNaListTemplate(templateData));
        this.loadLandTaxNAData();
        var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'village_for_landtax_na_list', 'village', 'village_name', 'devnagari');
        if (village != '' && survey != '' && subdiv != '') {
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor([{survey: survey}], 'survey_number_for_landtax_na_list', 'survey', 'survey', '', 'Survey Number');
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor([{subdiv: subdiv}], 'subdivision_number_for_landtax_na_list', 'subdiv', 'subdiv', '', 'Subdiv Number');
            $('#village_for_landtax_na_list').val(village);
            $('#survey_number_for_landtax_na_list').val(survey);
            $('#subdivision_number_for_landtax_na_list').val(subdiv);
            that.searchLandTaxNAData($('#search_btn_for_landtax_na_list'));
        }
        generateSelect2id('village_for_landtax_na_list');
        generateSelect2id('survey_number_for_landtax_na_list');
        generateSelect2id('subdivision_number_for_landtax_na_list');
        allowOnlyIntegerValue('khata_number_for_landtax_na_list');
    },
    checkboxSelectOptionNALand: function () {
        if ($("input[name='select_all_na_land']:checked").val()) {
            $(".checkbox_na_land").prop('checked', true);
        } else {
            $(".checkbox_na_land").prop('checked', false);
        }
        $(".checkbox_na_land").change(function () {
            if (!$(this).prop("checked")) {
                $("#select_all_na_land").prop("checked", false);
            }
            if ($('.checkbox_na_land:checked').length == $('.checkbox_na_land').length) {
                $("#select_all_na_land").prop('checked', true);
            }
        });
    },
    actionRenderer: function (rowData) {
        return landtaxNaActionTemplate(rowData);
    },
    showDatatableLandTaxNAData: function () {
        $('#landtax_na_form_container').html('');
        $('#landtax_na_form_container').hide();
        $('#landtax_na_datatable_main_container').show();
    },
    loadLandTaxNAData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        this.showDatatableLandTaxNAData();
        $('#landtax_na_datatable_container').html(landtaxNaTableTemplate);
        landtaxNaDataTable = $('#landtax_na_datatable').DataTable({
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            language: dataTableProcessingAndNoDataMsg,
        });
    },
    searchLandTaxNAData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = {};
        searchData.village = $('#village_for_landtax_na_list').val();
        searchData.survey_number = $('#survey_number_for_landtax_na_list').val();
        searchData.subdivision_number = $('#subdivision_number_for_landtax_na_list').val();
        searchData.khata_number = $('#khata_number_for_landtax_na_list').val();
        searchData.occupant_name = $('#occupant_name_for_landtax_na_list').val();

        if (!searchData.village && !searchData.survey_number && !searchData.subdivision_number &&
                !searchData.khata_number && !searchData.occupant_name) {
            showError(oneSearchValidationMessage);
            return false;
        }

        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');

        var that = this;
        var ltAARenderer = function (data, type, full, meta) {
            return '<div id="ltna_total_area_' + full.village + '_' + full.khata_number + '">' + (data ? data : 0) + '</div>';
        };
        var lTTArrearsRenderer = function (data, type, full, meta) {
            return '<div id="ltna_lt_total_arrears_' + full.village + '_' + full.khata_number + '">' + (data ? data : 0) + '/-</div>';
        };
        var lTCYDTRenderer = function (data, type, full, meta) {
            return '<div id="ltna_total_current_year_due_tax_' + full.village + '_' + full.khata_number + '">' + (data ? data : 0) + '/-</div>';
        };
        var lTPTRenderer = function (data, type, full, meta) {
            return '<div id="ltna_ltp_total_land_tax_payment_' + full.village + '_' + full.khata_number + '">' + (data ? data : 0) + '/-</div>';
        };
        var pendingTaxRenderer = function (data, type, full, meta) {
            var arrears = full.lt_total_arrears ? parseInt(full.lt_total_arrears) : 0;
            var paidTax = full.ltp_total_land_tax_payment ? parseInt(full.ltp_total_land_tax_payment) : 0;
            var pendingTax = (parseInt(data) + parseInt(arrears)) - parseInt(paidTax);
            return '<div id="ltna_ltp_total_pending_tax_payment_' + full.village + '_' + full.khata_number + '">' + pendingTax + '/-</div>';
        };
        var ltnaDataTable = function (settings, json) {
            btnObj.html(ogBtnHTML);
            btnObj.attr('onclick', ogBtnOnclick);
        };
        that.showDatatableLandTaxNAData();
        $('#landtax_na_datatable_container').html(landtaxNaTableTemplate);
        landtaxNaDataTable = $('#landtax_na_datatable').DataTable({
            ajax: {url: 'landtax_na/get_landtax_na_data', dataSrc: "landtax_na_data", type: "post", data: searchData},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'village_name', 'class': 'text-center'},
                {data: 'khata_number', 'class': 'text-center'},
                {data: 'total_area', 'class': 'text-right', 'render': ltAARenderer},
                {data: 'occupant_details', 'class': 'f-s-app-details'},
                {data: 'total_current_year_due_tax', 'class': 'text-right', 'render': lTCYDTRenderer},
                {data: 'lt_total_arrears', 'class': 'text-right', 'render': lTTArrearsRenderer},
                {data: 'ltp_total_land_tax_payment', 'class': 'text-right', 'render': lTPTRenderer},
                {data: 'total_current_year_due_tax', 'class': 'text-right', 'render': pendingTaxRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": ltnaDataTable
        });
        $('#landtax_na_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = landtaxNaDataTable.row(tr);
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(that.actionRenderer(row.data())).show();
                tr.addClass('shown');
            }
        });
    },
    showAllNALandsDetails: function (btnObj, khataNumber, village, mType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!khataNumber || !village || (mType != VALUE_ONE && mType != VALUE_TWO)) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'landtax_na/get_all_na_land_details_data',
            type: 'post',
            data: $.extend({}, {'khata_number_for_show_na_land': khataNumber, 'village_for_show_na_land': village}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
            },
            success: function (response) {
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (parseData.success === false) {
                    showError(parseData.message);
                    return false;
                }
                that.loadNALandDetails(khataNumber, village, parseData, mType);
            }
        });
    },
    loadNALandDetails: function (khataNumber, village, parseData, mType) {
        var landData = parseData.land_data;
        $('#landtax_na_datatable_main_container').hide();
        $('#landtax_na_form_container').show();
        $('#landtax_na_form_container').html(showNALandDetailTemplate({'district': parseData.s_district, 'khata_number': khataNumber, 'village': village}));
        var tCnt = 1;
        var totalArea = 0;
        var totalArrears = 0;
        var totalCurrentTax = 0;
        var totalPaidTax = 0;
        var totalPendingTax = 0;
        var arrears = 0;
        var currentYearDueTax = 0;
        var paidTax = '';
        var pendingTax = 0;
        $.each(landData, function (index, lnd) {
            arrears = lnd.arrears ? parseInt(lnd.arrears) : 0;
            currentYearDueTax = lnd.current_year_due_tax ? parseInt(lnd.current_year_due_tax) : 0;
            paidTax = lnd.total_land_tax_payment ? parseInt(lnd.total_land_tax_payment) : 0;
            pendingTax = (currentYearDueTax + arrears) - paidTax;

            totalArea += parseFloat(lnd.area);
            totalArrears += arrears;
            totalCurrentTax += currentYearDueTax;
            totalPaidTax += paidTax;
            totalPendingTax += pendingTax;
            var lndRow = '<tr id="ld_container_for_nald_' + lnd.occupant_id + '" class="ld_container_for_nald"><td class="text-center v-a-m">'
                    + '<input type="checkbox" id="hi_cb_for_nald_' + lnd.occupant_id + '" class="checkbox_na_land cursor-pointer" name="checkbox_na_land" value="' + lnd.occupant_id + '">'
                    + '<input type="hidden" id="hi_pt_for_nald_' + lnd.occupant_id + '" value="' + pendingTax + '">'
                    + '</td>'
                    + '<td class="text-center">' + tCnt + '</td>'
                    + '<td class="text-center">' + lnd.khata_number + '</td>'
                    + '<td class="text-center">' + lnd.village_name + '</td>'
                    + '<td class="text-center" id="survey_number_for_nald_' + tCnt + '">' + lnd.survey + '</td>'
                    + '<td class="text-center" id="subdiv_number_for_nald_' + tCnt + '">' + lnd.subdiv + '</td>'
                    + '<td class="text-right">' + lnd.area + '</td>'
                    + '<td class="f-s-12px">' + lnd.occupant_details + '</td>'
                    + '<td class="text-center">' + lnd.mutation_number + '</td>'
                    + '<td class="text-center">' + lnd.nature + '</td>'
                    + (ruAreaVillagesArray[lnd.village] ? '<td><label class="radio-inline form-title m-b-0px mr-1 cursor-pointer f-w-n">'
                            + '<input type="radio" class="mb-0" id="area_type_for_nald_' + lnd.occupant_id + '_' + VALUE_ZERO + '" '
                            + 'onchange="LandTaxNA.listview.areaTypeChangeEvent(' + lnd.occupant_id + ',' + VALUE_ZERO + ');"'
                            + 'name="area_type_for_nald_' + lnd.occupant_id + '" value="' + VALUE_ZERO + '">&nbsp;&nbsp;Rural</label><br>'
                            + '<label class="radio-inline form-title m-b-0px mr-1 cursor-pointer f-w-n">'
                            + '<input type="radio" class="mb-0" id="area_type_for_nald_' + lnd.occupant_id + '_' + VALUE_ONE + '" '
                            + 'onchange="LandTaxNA.listview.areaTypeChangeEvent(' + lnd.occupant_id + ',' + VALUE_ONE + ');"'
                            + 'name="area_type_for_nald_' + lnd.occupant_id + '" value="' + VALUE_ONE + '">&nbsp;&nbsp;Urban</label></td>' : '<td class="text-center">Rural</td>')
                    + '<td class="text-right" id="current_year_due_for_nald_' + tCnt + '">' + currentYearDueTax + '/-</td>'
                    + '<td class="text-right">' + (tempTypeInSession == TEMP_TYPE_A || paidTax == 0 ? '<input type="text" class="text-right form-control" style="width: 65%"'
                            + 'id="all_land_arrears_for_nald_' + tCnt + '" value="' + arrears + '">'
                            + '<button id="arrears_update_btn_' + tCnt + '" type="button" class="btn btn-xs btn-success float-right" '
                            + 'style="margin-top: -35px;" onclick="LandTaxNA.listview.updateLandArrears($(this),' + tCnt + ',\'for_nald\');">Update</button>' : arrears + '/-') + '</td>'
                    + '<td class="text-right" id="total_paid_amount_for_nald_' + tCnt + '">' + paidTax + '/-</td>'
                    + '<td class="text-right" id="total_pending_amount_for_nald_' + tCnt + '">' + pendingTax + '/-</td></tr>';
            $('#na_land_details_container_for_ltna').append(lndRow);
            $('#area_type_for_nald_' + lnd.occupant_id + '_' + lnd.area_type).prop('checked', true);
            allowOnlyIntegerValue('all_land_arrears_for_nald_' + tCnt);
            tCnt++;
        });
        var lndRowFooter = '<tr class="bg-light-gray"><td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td class="f-w-b text-center">' + totalArea + '</td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td class="f-w-b text-right">' + totalCurrentTax + '/-</td>' +
                '<td class="f-w-b text-right">' + totalArrears + '/-</td>' +
                '<td class="f-w-b text-right">' + totalPaidTax + '/-</td>' +
                '<td class="f-w-b text-right">' + totalPendingTax + '/-</td></tr>';
        $('#na_land_details_container_for_ltna').append(lndRowFooter);
        if (mType == VALUE_TWO) {
            $('#ltna_total_area_' + village + '_' + khataNumber).html(totalArea);
            $('#ltna_lt_total_arrears_' + village + '_' + khataNumber).html(totalArrears + '/-');
            $('#ltna_total_current_year_due_tax_' + village + '_' + khataNumber).html(totalCurrentTax + '/-');
            $('#ltna_ltp_total_land_tax_payment_' + village + '_' + khataNumber).html(totalPaidTax + '/-');
            $('#ltna_ltp_total_pending_tax_payment_' + village + '_' + khataNumber).html(totalPendingTax + '/-');
        }
    },
    areaTypeChangeEvent: function (occId, areaType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        var district = $('#district_for_nald').val();
        var that = this;
        if ((district != TALUKA_DAMAN && district != TALUKA_DIU) || !occId || (areaType != VALUE_ZERO && areaType != VALUE_ONE)) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        openFullPageOverlay();
        var formData = {};
        formData.district_for_atce = district;
        formData.occ_id_for_atce = occId;
        formData.area_type_for_atce = areaType;
        $.ajax({
            url: 'landtax_na/update_area_type',
            type: 'post',
            data: $.extend({}, formData, getTokenData()),
            error: function (textStatus, errorThrown) {
                closeFullPageOverlay();
                generateNewCSRFToken();
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                showError(textStatus.statusText);
            },
            success: function (response) {
                closeFullPageOverlay();
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                that.loadNALandDetails(parseData.khata_number, parseData.village, parseData, VALUE_TWO);
            }
        });
    },
    updateLandArrears: function (btnObj, ids, moduleIds) {
        var district = $('#district_for_nald').val();
        var village = $('#village_for_nald').val();
        var khataNumber = $('#khata_number_for_nald').val();
        var survey = $('#survey_number_' + moduleIds + '_' + ids).text();
        var subdiv = $('#subdiv_number_' + moduleIds + '_' + ids).text();
        var arrears = $('#all_land_arrears_' + moduleIds + '_' + ids).val();
        if ((district != TALUKA_DAMAN && district != TALUKA_DIU) || !village || !khataNumber || !survey || !subdiv || !arrears) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var formData = {};
        formData.module_type = VALUE_TWO;
        formData.district_for_land_arrears_update = district;
        formData.village_for_land_arrears_update = village;
        formData.khata_number_for_land_arrears_update = khataNumber;
        formData.survey_number_for_land_arrears_update = survey;
        formData.subdivision_number_for_land_arrears_update = subdiv;
        formData.all_land_arrears_for_land_arrears_update = arrears;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'utility/update_land_arrears',
            type: 'post',
            data: $.extend({}, formData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                that.loadNALandDetails(khataNumber, village, parseData, VALUE_TWO);
            }
        });
    },
    downloadExcelForLandTaxNA: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#village_for_ltge').val($('#village_for_landtax_na_list').val());
        $('#survey_number_for_ltge').val($('#survey_number_for_landtax_na_list').val());
        $('#subdivision_number_for_ltge').val($('#subdivision_number_for_landtax_na_list').val());
        $('#khata_number_for_ltge').val($('#khata_number_for_landtax_na_list').val());
        $('#occupant_name_for_ltge').val($('#occupant_name_for_landtax_na_list').val());
        $('#download_landtax_na_excel_form').submit();
        $('.ltge').val('');
    },
    generateExcelForNALandDetails: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#village_for_ltgeld').val($('#village_for_nald').val());
        $('#khata_number_for_ltgeld').val($('#khata_number_for_nald').val());
        $('#download_landtax_na_excel_form_for_land_details').submit();
        $('.ltgeld').val('');
    },
    generateNoticeForNALandDetails: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('.ld_container_for_nald').attr('class', 'ld_container_for_nald');
        var occupantIds = [];
        var isValidate = false;
        $("input:checkbox[name=checkbox_na_land]:checked").each(function () {
            var occId = $(this).val();
            if (!occId || occId == 0 || typeof occId == "undefined") {
                showError(invalidAccessValidationMessage);
                isValidate = true;
                return false;
            }
            var pTax = $('#hi_pt_for_nald_' + occId).val();
            if (!pTax || pTax == 0 || typeof pTax == "undefined") {
                $('#hi_cb_for_nald_' + occId).focus();
                $('#ld_container_for_nald_' + occId).attr('class', 'ld_container_for_nald bg-danger');
                showError(ldPTZeroValidationMessage);
                isValidate = true;
                return false;
            }
            occupantIds.push(occId);
        });
        if (isValidate) {
            return false;
        }
        if (occupantIds.length == 0) {
            showError(oneLDValidationMessage);
            return false;
        }
        $('#occupant_ids_for_gnnald').val(JSON.stringify(occupantIds));
        $('#generate_notice_pdf_form_for_land_details').submit();
        $('#occupant_ids_for_gnnald').val('');
    },
    getSSDetails: function (landDetails) {
        var tssDetails = landDetails ? JSON.parse(landDetails) : [];
        var ssDetails = '';
        $.each(tssDetails, function (ind, ssd) {
            ssDetails += '<span class="badge bg-info app-status mr-1 mb-1">' + ssd.survey + ' / ' + ssd.subdiv + '</span>';
        });
        return ssDetails;
    },
    showGeneratedNoticeHistory: function (btnObj, khataNumber, village) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!khataNumber || !village) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({url: 'landtax_na/get_generated_notice_history',
            type: 'post',
            data: $.extend({}, {'khata_number_for_gnh': khataNumber, 'village_for_gnh': village}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    return false;
                }
                var generatedNoticeHistory = parseData.generated_notice_history;
                showPopup();
                $('.swal2-popup').css('width', '60em');
                $('#popup_container').html(landtaxNaNoticeHistoryListTemplate);
                var lndRow = '';
                $.each(generatedNoticeHistory, function (index, gnd) {
                    lndRow = '<tr><td class="text-center">' + (index + 1) + '</td>'
                            + '<td class="text-center">' + dateTo_DD_MM_YYYY_HH_II_SS(gnd.created_time) + '</td>'
                            + '<td class="text-center">' + gnd.notice_number + '</td>'
                            + '<td class="text-center">' + gnd.khata_number + '</td>'
                            + '<td class="text-center">' + gnd.village_name + '</td>'
                            + '<td class="text-center">' + that.getSSDetails(gnd.land_details) + '</td>'
                            + '<td class="text-right">' + gnd.notice_amount + '/-</td>'
                            + '<td class="text-center"><button type="button" class="btn btn-sm btn btn-nic-blue" onclick="LandTaxNA.listview.downloadNoticeForNALand(' + gnd.rlp_notice_id + ');"><i class="fas fa-download"></i></button></td></tr>';
                    $('#landtax_na_generated_notice_history_container').append(lndRow);
                });
                if (generatedNoticeHistory.length == 0) {
                    $('#landtax_na_generated_notice_history_container').html(noRecordFoundTemplate({'colspan': 9, 'message': noRecordFoundMessage}));
                }
            }
        });
    },
    downloadNoticeForNALand: function (rlpNoticeId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#rlp_notice_id_for_dnnald').val(rlpNoticeId);
        $('#download_landtax_na_notice').submit();
        $('#rlp_notice_id_for_dnnald').val('');
    },
    askForPaymentForNALandDetails: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('.ld_container_for_nald').attr('class', 'ld_container_for_nald');
        var occupantIds = [];
        var isValidate = false;
        $("input:checkbox[name=checkbox_na_land]:checked").each(function () {
            var occId = $(this).val();
            if (!occId || occId == 0 || typeof occId == "undefined") {
                showError(invalidAccessValidationMessage);
                isValidate = true;
                return false;
            }
            var pTax = $('#hi_pt_for_nald_' + occId).val();
            if (!pTax || pTax == 0 || typeof pTax == "undefined") {
                $('#hi_cb_for_nald_' + occId).focus();
                $('#ld_container_for_nald_' + occId).attr('class', 'ld_container_for_nald bg-danger');
                showError(ldPTZeroValidationMessage);
                isValidate = true;
                return false;
            }
            occupantIds.push(occId);
        });
        if (isValidate) {
            return false;
        }
        if (occupantIds.length == 0) {
            showError(oneLDValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({url: 'landtax_na/get_pending_paymnt_details_by_occ_ids',
            type: 'post',
            data: $.extend({}, {'occ_ids_for_ppd': occupantIds}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    return false;
                }
                showPopup();
                $('.swal2-popup').css('width', '70em');
                $('#popup_container').html(landtaxNaPendingPaymentListTemplate);
                generateBoxes('radio', paymentTypeArray, 'payment_type', 'ppnald', VALUE_ONE, true);

                var ppDetails = parseData.pending_payment_details;
                var tCnt = 1;
                var totalArea = 0;
                var totalArrears = 0;
                var totalCurrentTax = 0;
                var totalPaidTax = 0;
                var totalPendingTax = 0;
                var arrears = 0;
                var currentYearDueTax = 0;
                var paidTax = '';
                var pendingTax = 0;
                $.each(ppDetails, function (index, ppd) {
                    arrears = ppd.arrears ? parseInt(ppd.arrears) : 0;
                    currentYearDueTax = ppd.current_year_due_tax ? parseInt(ppd.current_year_due_tax) : 0;
                    paidTax = ppd.total_land_tax_payment ? parseInt(ppd.total_land_tax_payment) : 0;
                    pendingTax = (currentYearDueTax + arrears) - paidTax;

                    totalArea += parseFloat(ppd.area);
                    totalArrears += arrears;
                    totalCurrentTax += currentYearDueTax;
                    totalPaidTax += paidTax;
                    totalPendingTax += pendingTax;
                    var lndRow = '<tr id="ld_container_for_ppnald_' + ppd.occupant_id + '" class="ld_container_for_ppnald">'
                            + '<td class="text-center">' + tCnt
                            + '<input type="hidden" class="hi_occ_id_for_ppnald" value="' + ppd.occupant_id + '">'
                            + '<input type="hidden" id="hi_pt_for_ppnald_' + ppd.occupant_id + '" value="' + pendingTax + '"></td>'
                            + '<td class="text-center">' + ppd.khata_number + '</td>'
                            + '<td class="text-center">' + ppd.village_name + '</td>'
                            + '<td class="text-center">' + ppd.survey + '</td>'
                            + '<td class="text-center">' + ppd.subdiv + '</td>'
                            + '<td class="text-right">' + ppd.area + '</td>'
                            + '<td class="f-s-12px">' + ppd.occupant_details + '</td>'
                            + '<td class="text-right">' + currentYearDueTax + '/-</td>'
                            + '<td class="text-right">' + arrears + '/-</td>'
                            + '<td class="text-right">' + paidTax + '/-</td>'
                            + '<td class="text-right">' + pendingTax + '/-</td></tr>';
                    $('#pending_payment_container_for_ppnald').append(lndRow);
                    tCnt++;
                });
                var isAdvanceTax = false;
                if (totalPendingTax <= 0) {
                    isAdvanceTax = true;
                    $('.pd_for_ppnald').remove();
                }
                var lndRowFooter = '<tr class="bg-light-gray"><td colspan="5"></td>' +
                        '<td class="f-w-b text-right">' + totalArea + '</td>' +
                        '<td></td>' +
                        '<td class="f-w-b text-right">' + totalCurrentTax + '/-</td>' +
                        '<td class="f-w-b text-right">' + totalArrears + '/-</td>' +
                        '<td class="f-w-b text-right">' + totalPaidTax + '/-</td>' +
                        '<td class="f-w-b text-right bg-' + (isAdvanceTax ? 'success' : 'danger') + '">' + totalPendingTax + '/-</td></tr>';
                $('#pending_payment_container_for_ppnald').append(lndRowFooter);
            }
        });
    },
    payPendingTax: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        $('.ld_container_for_ppnald').attr('class', 'ld_container_for_ppnald');
        var occupantIds = [];
        var isValidate = false;
        $('.hi_occ_id_for_ppnald').each(function () {
            var occId = $(this).val();
            if (!occId || occId == 0 || typeof occId == "undefined") {
                validationMessageShow('ppnald', invalidAccessValidationMessage);
                isValidate = true;
                return false;
            }
            var pTax = $('#hi_pt_for_ppnald_' + occId).val();
            if (!pTax || pTax == 0 || typeof pTax == "undefined") {
                $('#ld_container_for_ppnald_' + occId).attr('class', 'ld_container_for_ppnald bg-danger');
                validationMessageShow('ppnald', ldPTZeroValidationMessage);
                isValidate = true;
                return false;
            }
            occupantIds.push(occId);
        });
        if (isValidate) {
            return false;
        }
        if (occupantIds.length == 0) {
            showError(oneLDValidationMessage);
            return false;
        }
        var paymentType = $('input[name="payment_type_for_ppnald"]:checked').val();
        if (paymentType != VALUE_ONE) {
            $('#payment_type_for_ppnald_1').focus();
            validationMessageShow('ppnald-payment_type_for_ppnald', oneOptionValidationMessage);
            return false;
        }
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST', url: 'landtax_na/submit_pending_tax_details',
            data: $.extend({}, {'occ_ids_for_ppt': occupantIds, 'payment_type_for_ppt': paymentType}, getTokenData()),
            error: function (textStatus, errorThrown) {
                closeFullPageOverlay();
                generateNewCSRFToken();
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('ppnald', textStatus.statusText);
            },
            success: function (data) {
                closeFullPageOverlay();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    validationMessageShow('ppnald', parseData.message);
                    return false;
                }
                if (parseData.payment_type == VALUE_ONE) {
                    openFullPageOverlay();
                    submitPG(parseData);
                    return false;
                }
                Swal.close();
            }
        });
    },
    showNALTPaymentHistory: function (btnObj, khataNumber, village) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!khataNumber || !village) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({url: 'landtax_na/get_nalt_payment_history',
            type: 'post',
            data: $.extend({}, {'khata_number_for_naltph': khataNumber, 'village_for_naltph': village}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    return false;
                }
                $('#model_title').html('Land Tax (N.A.) Payment History');
                $('#model_body').html(landtaxNaPaymentHistoryListTemplate);
                var naltPaymentHistory = parseData.nalt_payment_history;
                $.each(naltPaymentHistory, function (index, ph) {
                    ph.temp_cnt = (index + 1);
                    ph.created_type_text = ph.created_type == VALUE_ONE ? 'Sugam Admin' : 'Sugam';
                    ph.payment_type_text = paymentTypeArray[ph.payment_type] ? paymentTypeArray[ph.payment_type] : '';
                    if (ph.payment_type == VALUE_ONE) {
                        ph.op_transaction_datetime_text = ph.op_transaction_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ph.op_transaction_datetime) : (ph.op_start_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ph.op_start_datetime) : '');
                        if (ph.fees_payment_id) {
                            ph.show_dvd_btn = true;
                        }
                        ph.op_message_text = ph.op_message ? pgMessage(ph.op_message, ph.fees_payment_id) : '';
                        ph.op_status_text = pgStatus(ph.op_status, ph.fees_payment_id);
                        if (ph.op_status == VALUE_TWO && ph.status == VALUE_FOUR) {
                            ph.show_dtrf_btn = true;
                        }
                    }
                    $('#landtax_na_payment_history_container').append(landtaxNaPaymentHistoryItemTemplate(ph));
                });
                if (naltPaymentHistory.length == 0) {
                    $('#landtax_na_payment_history_container').html(noRecordFoundTemplate({'colspan': 12, 'message': noRecordFoundMessage}));
                }
                $('#popup_modal').modal('show');
            }
        });
    },
    downloadTRFive: function (rlpLandTaxPaymentId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!rlpLandTaxPaymentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#rlp_land_tax_payment_id_for_dtrfnald').val(rlpLandTaxPaymentId);
        $('#download_tr_five_pdf_for_nald').submit();
        $('#rlp_land_tax_payment_id_for_dtrfnald').val('');
    },
    listPageForNH: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('notice_history', 'active');
        LandTaxNA.router.navigate('notice_history');
        var templateData = {};
        this.$el.html(nhListTemplate(templateData));
        this.loadNHData();
    },
    loadNHData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('#notice_history_datatable_container').html(nhTableTemplate);
        var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'village_for_nh_list', 'village', 'village_name', 'devnagari', false);
        allowOnlyIntegerValue('khata_number_for_nh_list');

        var actionRenderer = function (data, type, full, meta) {
            return nhActionTemplate({rlp_notice_id: data});
        };
        var ssRenderer = function (data, type, full, meta) {
            return that.getSSDetails(full.land_details);
        };
        var amountRenderer = function (data, type, full, meta) {
            return data + '/-';
        };
        nhDataTable = $('#notice_history_datatable').DataTable({
            ajax: {url: 'landtax_na/get_notice_history_data', dataSrc: "nh_data", type: "post"},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'notice_year', 'class': 'text-center'},
                {data: 'created_time', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'notice_number', 'class': 'text-center'},
                {data: 'khata_number', 'class': 'text-center'},
                {data: 'village_name', 'class': 'text-center'},
                {data: '', 'class': 'text-center', 'render': ssRenderer},
                {data: 'notice_amount', 'class': 'text-right', 'render': amountRenderer},
                {data: 'rlp_notice_id', 'class': 'text-center', 'render': actionRenderer},
            ],
            "initComplete": searchableDatatable
        });
        $('#notice_history_datatable_filter').remove();
    },
    listPageForTRFive: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('tr_five_history', 'active');
        LandTaxNA.router.navigate('tr_five_history');
        var templateData = {};
        this.$el.html(trFiveListTemplate(templateData));
        this.loadTRFiveData();
    },
    loadTRFiveData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('#tr_five_history_datatable_container').html(trFiveTableTemplate);

        var actionRenderer = function (data, type, full, meta) {
            return trFiveActionTemplate({rlp_land_tax_payment_id: data});
        };
        var paymentRenderer = function (data, type, full, meta) {
            return (full.created_type == VALUE_ONE ? 'Sugam Admin' : 'Sugam') + '<hr>' + (paymentTypeArray[data] ? paymentTypeArray[data] : '');
        };
        var appNumberTrascationRenderer = function (data, type, full, meta) {
            return (full.application_number) + '<hr>' + (full.op_transaction_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(full.op_transaction_datetime) : (full.op_start_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(full.op_start_datetime) : ''));
        };
        var khataNumberVillageRenderer = function (data, type, full, meta) {
            return full.khata_number + '<hr>' + full.village_name;
        };
        var amountRenderer = function (data, type, full, meta) {
            return data + '/-';
        };
        var paymentStatusRenderer = function (data, type, full, meta) {
            return pgStatus(full.op_status, full.fees_payment_id);
        };
        trFiveDataTable = $('#tr_five_history_datatable').DataTable({
            ajax: {url: 'landtax_na/get_tr_five_history_data', dataSrc: "tr_five_data", type: "post"},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'payment_type', 'class': 'text-center', 'render': paymentRenderer},
                {data: '', 'class': 'text-center', 'render': appNumberTrascationRenderer},
                {data: '', 'class': 'text-center', 'render': khataNumberVillageRenderer},
                {data: 'occupant_details', 'class': 'text-center'},
                {data: 'total_amount', 'class': 'text-right', 'render': amountRenderer},
                {data: 'reference_id', 'class': 'text-center'},
                {data: '', 'class': 'text-center', 'render': paymentStatusRenderer},
                {data: 'rlp_land_tax_payment_id', 'class': 'text-center', 'render': actionRenderer},
            ],
            "initComplete": searchableDatatable
        });
        $('#tr_five_history_datatable_filter').remove();
    }
});

