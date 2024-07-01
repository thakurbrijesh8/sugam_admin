var landtaxAgricultureListTemplate = Handlebars.compile($('#landtax_agriculture_list_template').html());
var landtaxAgricultureTableTemplate = Handlebars.compile($('#landtax_agriculture_table_template').html());
var landtaxAgricultureActionTemplate = Handlebars.compile($('#landtax_agriculture_action_template').html());
var landtaxAgricultureFormTemplate = Handlebars.compile($('#landtax_agriculture_form_template').html());

var landtaxAgricultureNoticeHistoryListTemplate = Handlebars.compile($('#landtax_agriculture_notice_history_list_template').html());
var landtaxAgriculturePendingPaymentListTemplate = Handlebars.compile($('#landtax_agriculture_pending_payment_list_template').html());
var landtaxAgriculturePaymentHistoryListTemplate = Handlebars.compile($('#landtax_agriculture_payment_history_list_template').html());
var landtaxAgriculturePaymentHistoryItemTemplate = Handlebars.compile($('#landtax_agriculture_payment_history_item_template').html());
var nhAgricultureListTemplate = Handlebars.compile($('#nh_agriculture_list_template').html());
var nhAgricultureTableTemplate = Handlebars.compile($('#nh_agriculture_table_template').html());
var nhAgricultureActionTemplate = Handlebars.compile($('#nh_agriculture_action_template').html());
var trFiveAgricultureListTemplate = Handlebars.compile($('#tr_five_agriculture_list_template').html());
var trFiveAgricultureTableTemplate = Handlebars.compile($('#tr_five_agriculture_table_template').html());
var trFiveAgricultureActionTemplate = Handlebars.compile($('#tr_five_agriculture_action_template').html());
var amountOfYearForLandtaxAgricultureTemplate = Handlebars.compile($('#amount_of_year_for_landtax_agriculture_template').html());

var tempYearCnt = 1;
var LandTaxAgriculture = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
LandTaxAgriculture.Router = Backbone.Router.extend({
    routes: {
        'landtax_agriculture': 'renderList',
        'notice_history_agriculture': 'renderListForNHAgriculture',
        'tr_five_history_agriculture': 'renderListForTRFiveAgriculture',
    },
    renderList: function () {
        LandTaxAgriculture.listview.listPage();
    },
    renderListForNHAgriculture: function () {
        LandTaxAgriculture.listview.listPageForNHAgriculture();
    },
    renderListForTRFiveAgriculture: function () {
        LandTaxAgriculture.listview.listPageForTRFiveAgriculture();
    },
});
LandTaxAgriculture.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('landtax_agriculture', 'active');
        LandTaxAgriculture.router.navigate('landtax_agriculture');
        var templateData = {};
        this.$el.html(landtaxAgricultureListTemplate(templateData));
        var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'village_for_landtax_agriculture_list', 'village', 'village_name', 'devnagari');
        generateSelect2id('village_for_landtax_agriculture_list');
        allowOnlyIntegerValue('khata_number_for_landtax_agriculture_list');
        this.loadLandTaxAgricultureData();
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
        return landtaxAgricultureActionTemplate(rowData);
    },
    showDatatableLandTaxAgricultureData: function () {
        $('#landtax_agriculture_form_container').html('');
        $('#landtax_agriculture_form_container').hide();
        $('#landtax_agriculture_datatable_main_container').show();
    },
    loadLandTaxAgricultureData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        this.showDatatableLandTaxAgricultureData();
        $('#landtax_agriculture_datatable_container').html(landtaxAgricultureTableTemplate);
        landtaxAgricultureDataTable = $('#landtax_agriculture_datatable').DataTable({
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            language: dataTableProcessingAndNoDataMsg,
        });
    },
    searchLandTaxAgricultureData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = {};
        searchData.village = $('#village_for_landtax_agriculture_list').val();
        searchData.khata_number = $('#khata_number_for_landtax_agriculture_list').val();
        searchData.occupant_name = $('#occupant_name_for_landtax_agriculture_list').val();

        if (!searchData.village && !searchData.khata_number && !searchData.occupant_name) {
            showError(oneSearchValidationMessage);
            return false;
        }

        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');

        var that = this;
        var ltnaDataTable = function (settings, json) {
            btnObj.html(ogBtnHTML);
            btnObj.attr('onclick', ogBtnOnclick);
        };
        var totalAmountPrevYear = function (data, type, full, meta) {
            var amountOfPrevYear = full.amount_of_2022_23 ? full.amount_of_2022_23 : 0.00;
            return  '<div id="total_amount_land_tax_agriculture_payment_prev_year_' + full.landtax_agriculture_id + '">' + amountOfPrevYear + '/-</div>';
        };
        var totalAmountCurrYear = function (data, type, full, meta) {
            var amountOfCurrYear = full.amount_of_2023_24 ? full.amount_of_2023_24 : 0.00;
            return  '<div id="total_amount_land_tax_agriculture_payment_curr_year_' + full.landtax_agriculture_id + '">' + amountOfCurrYear + '/-</div>';
        };
        var totalAmountNextYear = function (data, type, full, meta) {
            var amountOfNextYear = full.amount_of_2024_25 ? full.amount_of_2024_25 : 0.00;
            return  '<div id="total_amount_land_tax_agriculture_payment_next_year_' + full.landtax_agriculture_id + '">' + amountOfNextYear + '/-</div>';
        };
        var totalPaidAmount = function (data, type, full, meta) {
            var totalPaidAmount = full.altp_total_land_tax_payment != null ? full.altp_total_land_tax_payment : 0;
            return  '<div id="total_paid_amount_land_tax_agriculture_payment_' + full.landtax_agriculture_id + '">' + totalPaidAmount + '/-</div>';
        };
        var totalAmountPending = function (data, type, full, meta) {
            var totalAmount = ((parseFloat(full.amount_of_2022_23) + parseFloat(full.amount_of_2023_24) + parseFloat(full.amount_of_2024_25)) + parseFloat(full.arreas_of_revenue)) - parseFloat(full.altp_total_land_tax_payment != null ? full.altp_total_land_tax_payment : 0);
            return  '<div id="total_amount_land_tax_agriculture_payment_' + full.landtax_agriculture_id + '">' + totalAmount + '/-</div>';
        };
        that.showDatatableLandTaxAgricultureData();
        $('#landtax_agriculture_datatable_container').html(landtaxAgricultureTableTemplate);
        landtaxAgricultureDataTable = $('#landtax_agriculture_datatable').DataTable({
            ajax: {url: 'landtax_agriculture/get_landtax_agriculture_data', dataSrc: "landtax_agriculture_data", type: "post", data: searchData},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'village_name', 'class': 'text-center'},
                {data: 'khata_number', 'class': 'text-center'},
                {data: 'occupant_name', 'class': 'f-s-app-details'},
                {data: 'address', 'class': 'f-s-app-details'},
                {data: 'arreas_of_revenue', 'class': 'text-right'},
                {data: 'amount_of_2022_23', 'class': 'text-right', 'render': totalAmountPrevYear},
                {data: 'amount_of_2023_24', 'class': 'text-right', 'render': totalAmountCurrYear},
                {data: 'amount_of_2024_25', 'class': 'text-right', 'render': totalAmountNextYear},
                {data: '', 'class': 'text-right', 'render': totalPaidAmount},
                {data: '', 'class': 'text-right', 'render': totalAmountPending},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": ltnaDataTable
        });
        $('#landtax_agriculture_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = landtaxAgricultureDataTable.row(tr);
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(that.actionRenderer(row.data())).show();
                tr.addClass('shown');
            }
        });
    },
    editAgricultureLandsDetails: function (btnObj, landtaxAgricultureId) {
        if (!landtaxAgricultureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'landtax_agriculture/get_landtax_agriculture_details_by_id',
            type: 'post',
            data: $.extend({}, {'landtax_agriculture_id': landtaxAgricultureId}, getTokenData()),
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
                $('html, body').animate({scrollTop: '0px'}, 0);
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
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                var landtaxAgricultureData = parseData.landtax_agriculture_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                $('#popup_container').html(landtaxAgricultureFormTemplate(landtaxAgricultureData));
                var display_index = VALUE_SEVENTEEN;
                if (parseData.landtax_agriculture_total_notice_year != '') {
                    var totalNoticeYear = parseData.landtax_agriculture_total_notice_year;
                    $.each(totalNoticeYear, function (key, value) {
                        that.addAmountOfYear(value, display_index);
                        display_index++;
                    });
                }
                datePicker();
                allowOnlyDecimalValue('dlt_hut_for_landtax_agriculture');
                allowOnlyDecimalValue('dlt_itar_for_landtax_agriculture');
                allowOnlyDecimalValue('dlt_rokad_for_landtax_agriculture');
                allowOnlyDecimalValue('amount_of_2022_23_for_landtax_agriculture');
                allowOnlyDecimalValue('amount_of_2023_24_for_landtax_agriculture');
                allowOnlyDecimalValue('arreas_of_revenue_for_landtax_agriculture');
                allowOnlyDecimalValue('amount_pending_for_landtax_agriculture');
                allowOnlyIntegerValue('mobile_number_for_landtax_agriculture');
            }
        });
    },
    addAmountOfYear: function (templateData, displayIndex) {
        templateData.per_cnt = tempYearCnt;
        templateData.display_index = displayIndex
        if (templateData.amount != '0.00') {
            templateData.read_only = 'readonly';
        } else {
            templateData.current_year = templateData.notice_year;
        }
        $('#amount_of_year_for_landtax_agriculture').append(amountOfYearForLandtaxAgricultureTemplate(templateData));
        tempYearCnt++;
        resetCounter('display-cnt');
    },
    checkValidationForLandTaxAgriculture: function (landtaxAgricultureData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!landtaxAgricultureData.khata_number_for_landtax_agriculture) {
            return getBasicMessageAndFieldJSONArray('khata_number_for_landtax_agriculture', khataNumberValidationMessage);
        }
        if (!landtaxAgricultureData.occupant_name_for_landtax_agriculture) {
            return getBasicMessageAndFieldJSONArray('occupant_name_for_landtax_agriculture', nameValidationMessage);
        }
        if (landtaxAgricultureData.mobile_number_for_landtax_agriculture != '') {
            var mobileMessage = mobileNumberValidation(landtaxAgricultureData.mobile_number_for_landtax_agriculture);
            if (mobileMessage != '') {
                return getBasicMessageAndFieldJSONArray('mobile_number_for_landtax_agriculture', mobileMessage);
            }
        }
        if (landtaxAgricultureData.email_for_landtax_agriculture != '') {
            var emailIdValidationMessage = emailIdValidation(landtaxAgricultureData.email_for_landtax_agriculture);
            if (emailIdValidationMessage != '') {
                return getBasicMessageAndFieldJSONArray('email_for_landtax_agriculture', emailIdValidationMessage);
            }
        }
        // if (!landtaxAgricultureData.address_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('address_for_landtax_agriculture', addressValidationMessage);
        // }
        // if (!landtaxAgricultureData.mobile_number_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('mobile_number_for_landtax_agriculture', mobileValidationMessage);
        // }
        // if (!landtaxAgricultureData.email_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('email_for_landtax_agriculture', emailValidationMessage);
        // }
        // if (!landtaxAgricultureData.ref_survey_number_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('ref_survey_number_for_landtax_agriculture', surveyNumberValidationMessage);
        // }
        // if (!landtaxAgricultureData.remark_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('remark_for_landtax_agriculture', remarkValidationMessage);
        // }
        // if (!landtaxAgricultureData.dlt_hut_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('dlt_hut_for_landtax_agriculture', khataNumberValidationMessage);
        // }
        // if (!landtaxAgricultureData.dlt_itar_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('dlt_itar_for_landtax_agriculture', khataNumberValidationMessage);
        // }
        // if (!landtaxAgricultureData.dlt_rokad_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('dlt_rokad_for_landtax_agriculture', khataNumberValidationMessage);
        // }
        // if (!landtaxAgricultureData.dlt_kad_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('dlt_kad_for_landtax_agriculture', khataNumberValidationMessage);
        // }
        // if (!landtaxAgricultureData.dlt_dangi_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('dlt_dangi_for_landtax_agriculture', khataNumberValidationMessage);
        // }
        // if (!landtaxAgricultureData.dlt_kolam_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('dlt_kolam_for_landtax_agriculture', khataNumberValidationMessage);
        // }
        // if (!landtaxAgricultureData.dlt_arad_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('dlt_arad_for_landtax_agriculture', khataNumberValidationMessage);
        // }
        // if (!landtaxAgricultureData.amount_of_2022_23_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('amount_of_2022_23_for_landtax_agriculture', amountValidationMessage);
        // }
        // if (!landtaxAgricultureData.amount_of_2023_24_for_landtax_agriculture) {
        //     return getBasicMessageAndFieldJSONArray('amount_of_2023_24_for_landtax_agriculture', amountValidationMessage);
        // }
        if (!landtaxAgricultureData.arrears_for_landtax_agriculture) {
            return getBasicMessageAndFieldJSONArray('arrears_for_landtax_agriculture', arreasValidationMessage);
        }
//        if (!landtaxAgricultureData.tax_amount_for_landtax_agriculture) {
//            return getBasicMessageAndFieldJSONArray('tax_amount_for_landtax_agriculture', amountValidationMessage);
//        }
        return '';
    },
    submitLandTaxAgriculture: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var landtaxAgricultureData = $('#landtax_agriculture_form').serializeFormJSON();
        var validationDataOne = that.checkValidationForLandTaxAgriculture(landtaxAgricultureData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('landtax-agriculture-' + validationDataOne.field, validationDataOne.message);
            return false;
        }

        var isAmountYearValidation = false;
        $('.amount_of_year_for_ld_info').each(function () {
            console.log('ok');
            var cnt = $(this).find('.temp_cnt').val();

            var taxAmount = $('#tax_amount_for_landtax_agriculture_' + cnt).val();
            if (taxAmount == '' || taxAmount == null || taxAmount == '0.00') {
                $('#tax_amount_for_landtax_agriculture_' + cnt).focus();
                validationMessageShow('landtax-agriculture-tax_amount_for_landtax_agriculture_' + cnt, amountValidationMessage);
                isAmountYearValidation = true;
                return false;
            }
        });
        if (isAmountYearValidation) {
            return false;
        }
        var btnObj = $('#submit_btn_for_landtax_agriculture');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'landtax_agriculture/submit_landtax_agriculture',
            data: $.extend({}, landtaxAgricultureData, getTokenData()),
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
                validationMessageShow('landtax-agriculture', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (data) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    validationMessageShow('landtax-agriculture', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                var landtaxPrevYearAmount = parseData.landtax_prev_year_amount != '0.00' ? parseData.landtax_prev_year_amount : 0;
                var landtaxCurrYearAmount = parseData.landtax_curr_year_amount != '0.00' ? parseData.landtax_curr_year_amount : 0;
                var landtaxNextYearAmount = parseData.landtax_next_year_amount != '0.00' ? parseData.landtax_next_year_amount : 0;
                var ldArrears = parseData.ld_arrears;

                var totalLandTaxPayment = parseData.total_land_tax_payment;
                var finalTotalLandTaxPayment = totalLandTaxPayment != null ? totalLandTaxPayment : 0;

                var totalAgriPendingAmount = (parseFloat(landtaxPrevYearAmount) + parseFloat(landtaxCurrYearAmount) + parseFloat(landtaxNextYearAmount) + parseFloat(landtaxAgricultureData.arrears_for_landtax_agriculture)) - finalTotalLandTaxPayment;

                $('#total_amount_land_tax_agriculture_payment_prev_year_' + landtaxAgricultureData.landtax_agriculture_id_for_landtax_agriculture).html(landtaxPrevYearAmount + '/-');
                $('#total_amount_land_tax_agriculture_payment_curr_year_' + landtaxAgricultureData.landtax_agriculture_id_for_landtax_agriculture).html(landtaxCurrYearAmount + '/-');
                $('#total_amount_land_tax_agriculture_payment_next_year_' + landtaxAgricultureData.landtax_agriculture_id_for_landtax_agriculture).html(landtaxNextYearAmount + '/-');
                $('#total_amount_land_tax_agriculture_payment_' + landtaxAgricultureData.landtax_agriculture_id_for_landtax_agriculture).html(totalAgriPendingAmount + '/-');
                showSuccess(parseData.message);
            }
        });
    },
    downloadExcelForLandTaxAgriculture: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#village_for_landtax_agriculture').val($('#village_for_landtax_agriculture_list').val());
        $('#khata_number_for_landtax_agriculture').val($('#khata_number_for_landtax_agriculture_list').val());
        $('#occupant_name_for_landtax_agriculture').val($('#occupant_name_for_landtax_agriculture_list').val());
        $('#download_landtax_agriculture_excel_form').submit();
        $('.ltagri').val('');
    },
    generateNoticeForAgricultureLandDetails: function (landtaxAgricultureId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!landtaxAgricultureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }

        $('#landtax_agriculture_id_for_landtax_agriculture').val(landtaxAgricultureId);
        $('#generate_notice_pdf_form_for_landtax_agriculture').submit();
        $('#landtax_agriculture_id_for_landtax_agriculture').val('');
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
        $.ajax({url: 'landtax_agriculture/get_generated_notice_history_agriculture',
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
                var generatedNoticeHistory = parseData.generated_notice_history_agriculture;
                showPopup();
                $('.swal2-popup').css('width', '60em');
                $('#popup_container').html(landtaxAgricultureNoticeHistoryListTemplate);
                var lndRow = '';
                $.each(generatedNoticeHistory, function (index, gnd) {
                    lndRow = '<tr><td class="text-center">' + (index + 1) + '</td>'
                            + '<td class="text-center">' + dateTo_DD_MM_YYYY_HH_II_SS(gnd.created_time) + '</td>'
                            + '<td class="text-center">' + gnd.notice_number + '</td>'
                            + '<td class="text-center">' + gnd.khata_number + '</td>'
                            + '<td class="text-center">' + gnd.village_name + '</td>'
                            + '<td class="text-center">' + gnd.occupant_name + '</td>'
                            + '<td class="text-right">' + gnd.notice_amount + '/-</td>'
                            + '<td class="text-center"><button type="button" class="btn btn-sm btn btn-nic-blue" onclick="LandTaxAgriculture.listview.downloadNoticeForAgricultureLand(' + gnd.landtax_agriculture_notice_id + ');"><i class="fas fa-download"></i></button></td></tr>';
                    $('#landtax_na_generated_notice_history_container').append(lndRow);
                });
                if (generatedNoticeHistory.length == 0) {
                    $('#landtax_na_generated_notice_history_container').html(noRecordFoundTemplate({'colspan': 9, 'message': noRecordFoundMessage}));
                }
            }
        });
    },
    downloadNoticeForAgricultureLand: function (ltaNoticeId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#landtax_agriculture_notice_id_for_ltag').val(ltaNoticeId);
        $('#download_landtax_agriculture_notice').submit();
        $('#landtax_agriculture_notice_id_for_ltag').val('');
    },
    askForPaymentForAgricultureLandDetails: function (btnObj, landtaxAgricultureId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!landtaxAgricultureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({url: 'landtax_agriculture/get_pending_paymnt_details_by_id',
            type: 'post',
            data: $.extend({}, {'landtax_agriculture_id': landtaxAgricultureId}, getTokenData()),
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
                templateData = {};
                templateData.landtax_agriculture_id = landtaxAgricultureId;
                showPopup();
                $('.swal2-popup').css('width', '70em');
                $('#popup_container').html(landtaxAgriculturePendingPaymentListTemplate(templateData));
                generateBoxes('radio', paymentTypeArray, 'payment_type', 'ppagrild', VALUE_ONE, true);

                var ppDetails = parseData.pending_payment_details;
                var tCnt = 1;
                // var totalArea = 0;
                var totalArrears = 0;
                var totalPendingTax = 0;
                var arrears = 0;
                var pendingTax = 0;
                //$.each(ppDetails, function (index, ppd) {
                arrears = ppDetails.arrears ? parseFloat(ppDetails.arrears) : 0;
                pendingTax = (parseFloat(ppDetails.total_amount) + parseFloat(arrears)) - parseFloat((ppDetails.altp_total_land_tax_payment != null ? ppDetails.altp_total_land_tax_payment : '0'));

                totalArrears = arrears;
                totalPendingTax = pendingTax;
                var lndRow = '<tr>'
                        + '<td class="text-center">' + tCnt
                        + '<td class="text-center">' + ppDetails.village_name + '</td>'
                        + '<td class="text-center">' + ppDetails.khata_number + '</td>'
                        + '<td class="f-s-12px">' + ppDetails.occupant_name + '</td>'
                        + '<td class="text-right">' + pendingTax + '/-</td></tr>';
                $('#pending_payment_container_for_ppagrild').append(lndRow);
                tCnt++;
                //});
                var isAdvanceTax = false;
                if (totalPendingTax <= 0) {
                    isAdvanceTax = true;
                    $('.pd_for_ppagrild').remove();
                }
                var lndRowFooter = '<tr class="bg-light-gray"><td colspan="4"></td>' +
                        '<td class="f-w-b text-right bg-' + (isAdvanceTax ? 'success' : 'danger') + '">' + totalPendingTax + '/-</td></tr>';
                $('#pending_payment_container_for_ppagrild').append(lndRowFooter);
            }
        });
    },
    payPendingTax: function (btnObj, landtaxAgricultureId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!landtaxAgricultureId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();

        var paymentType = $('input[name="payment_type_for_ppagrild"]:checked').val();
        if (paymentType != VALUE_ONE) {
            $('#payment_type_for_ppagrild_1').focus();
            validationMessageShow('ppagrild-payment_type_for_ppagrild', oneOptionValidationMessage);
            return false;
        }
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST', url: 'landtax_agriculture/submit_pending_tax_details',
            data: $.extend({}, {'landtax_agriculture_id': landtaxAgricultureId, 'payment_type_for_ppt': paymentType}, getTokenData()),
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
                validationMessageShow('ppagrild', textStatus.statusText);
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
                    validationMessageShow('ppagrild', parseData.message);
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
    showAgricultureLTPaymentHistory: function (btnObj, khataNumber, village) {
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
        $.ajax({url: 'landtax_agriculture/get_agrilt_payment_history',
            type: 'post',
            data: $.extend({}, {'khata_number_for_agriltph': khataNumber, 'village_for_agriltph': village}, getTokenData()),
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
                $('#model_title').html('Land Tax (Agriculture) Payment History');
                $('#model_body').html(landtaxAgriculturePaymentHistoryListTemplate);
                var agriltPaymentHistory = parseData.agrilt_payment_history;
                $.each(agriltPaymentHistory, function (index, ph) {
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
                    $('#landtax_agriculture_payment_history_container').append(landtaxAgriculturePaymentHistoryItemTemplate(ph));
                });
                if (agriltPaymentHistory.length == 0) {
                    $('#landtax_agriculture_payment_history_container').html(noRecordFoundTemplate({'colspan': 12, 'message': noRecordFoundMessage}));
                }
                $('#popup_modal').modal('show');
            }
        });
    },
    downloadTRFive: function (agriLandTaxPaymentId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!agriLandTaxPaymentId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#agri_land_tax_payment_id_for_dtrfagrild').val(agriLandTaxPaymentId);
        $('#download_tr_five_pdf_for_agrild').submit();
        $('#agri_land_tax_payment_id_for_dtrfagrild').val('');
    },
    listPageForNHAgriculture: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('notice_history_agriculture', 'active');
        LandTaxAgriculture.router.navigate('notice_history_agriculture');
        var templateData = {};
        this.$el.html(nhAgricultureListTemplate(templateData));
        this.loadNHAgricultureData();
    },
    loadNHAgricultureData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('#notice_history_agriculture_datatable_container').html(nhAgricultureTableTemplate);
        var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'village_for_nh_list', 'village', 'village_name', 'devnagari', false);
        allowOnlyIntegerValue('khata_number_for_nh_agriculture_list');

        var actionRenderer = function (data, type, full, meta) {
            return nhAgricultureActionTemplate({landtax_agriculture_notice_id: data});
        };
        var amountRenderer = function (data, type, full, meta) {
            return data + '/-';
        };
        nhDataTable = $('#notice_history_agriculture_datatable').DataTable({
            ajax: {url: 'landtax_agriculture/get_notice_history_agriculture_data', dataSrc: "agriculture_nh_data", type: "post"},
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
                {data: 'notice_amount', 'class': 'text-right', 'render': amountRenderer},
                {data: 'landtax_agriculture_notice_id', 'class': 'text-center', 'render': actionRenderer},
            ],
            "initComplete": searchableDatatable
        });
        $('#notice_history_agriculture_datatable_filter').remove();
    },
    listPageForTRFiveAgriculture: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('tr_five_history_agriculture', 'active');
        LandTaxAgriculture.router.navigate('tr_five_history_agriculture');
        var templateData = {};
        this.$el.html(trFiveAgricultureListTemplate(templateData));
        this.loadTRFiveData();
    },
    loadTRFiveData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        $('#tr_five_history_agriculture_datatable_container').html(trFiveAgricultureTableTemplate);

        var actionRenderer = function (data, type, full, meta) {
            return trFiveAgricultureActionTemplate({landtax_agriculture_payment_id: data});
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
        trFiveDataTable = $('#tr_five_history_agriculture_datatable').DataTable({
            ajax: {url: 'landtax_agriculture/get_tr_five_history_data', dataSrc: "tr_five_data", type: "post"},
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
                {data: 'occupant_name', 'class': 'text-center'},
                {data: 'total_amount', 'class': 'text-right', 'render': amountRenderer},
                {data: 'reference_id', 'class': 'text-center'},
                {data: '', 'class': 'text-center', 'render': paymentStatusRenderer},
                {data: 'landtax_agriculture_payment_id', 'class': 'text-center', 'render': actionRenderer},
            ],
            "initComplete": searchableDatatable
        });
        $('#tr_five_history_agriculture_datatable_filter').remove();
    }
});
