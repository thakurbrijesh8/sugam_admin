var khataNumberListTemplate = Handlebars.compile($('#khata_number_list_template').html());
var khataNumberTableTemplate = Handlebars.compile($('#khata_number_table_template').html());
var khataNumberActionTemplate = Handlebars.compile($('#khata_number_action_template').html());
var showLandDetailTemplate = Handlebars.compile($('#show_land_detail_template').html());


var KhataNumber = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
KhataNumber.Router = Backbone.Router.extend({
    routes: {
        'khata_number': 'renderList',
    },
    renderList: function () {
        KhataNumber.listview.listPage();
    },
});
KhataNumber.listView = Backbone.View.extend({
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
        addClass('khata_number', 'active');
        KhataNumber.router.navigate('khata_number');
        var templateData = {};
        this.$el.html(khataNumberListTemplate(templateData));
        var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'village_for_khata_number_list', 'village', 'village_name', 'devnagari');
        generateSelect2id('village_for_khata_number_list');
        generateSelect2id('survey_number_for_khata_number_list');
        generateSelect2id('subdivision_number_for_khata_number_list');
        allowOnlyIntegerValue('khata_number_for_khata_number_list');
        this.loadKhataNumberData();
    },
    loadKhataNumberData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#khata_number_form_and_datatable_container').html(khataNumberTableTemplate);
        khataNumberDataTable = $('#khata_number_datatable').DataTable({
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            language: dataTableProcessingAndNoDataMsg,
        });
    },
    searchKhataNumberData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = {};
        searchData.village = $('#village_for_khata_number_list').val();
        searchData.survey_number = $('#survey_number_for_khata_number_list').val();
        searchData.subdivision_number = $('#subdivision_number_for_khata_number_list').val();
        searchData.khata_number = $('#khata_number_for_khata_number_list').val();
        searchData.occupant_name = $('#occupant_name_for_khata_number_list').val();

        if (!searchData.village && !searchData.survey_number && !searchData.subdivision_number &&
                !searchData.khata_number && !searchData.occupant_name) {
            showError(oneSearchValidationMessage);
            return false;
        }

        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');

        var khataNumberActionRenderer = function (data, type, full, meta) {
            return khataNumberActionTemplate({'khata_number': data, 'village': full.village});
        };
        var knDatatable = function (settings, json) {
            btnObj.html(ogBtnHTML);
            btnObj.attr('onclick', ogBtnOnclick);
        };

        $('#khata_number_form_and_datatable_container').html(khataNumberTableTemplate);
        khataNumberDataTable = $('#khata_number_datatable').DataTable({
            ajax: {url: 'khata_number/get_khata_number_data', dataSrc: "khata_number_data", type: "post", data: searchData},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'village_name', 'class': 'text-center'},
                {data: 'khata_number', 'class': 'text-center'},
                {data: 'occupant_details', 'class': 'f-s-app-details'},
                {
                    "orderable": false,
                    "data": 'khata_number',
                    "render": khataNumberActionRenderer,
                    'class': 'text-center'
                }
            ],
            "initComplete": knDatatable
        });
    },
    showLandsDetails: function (btnObj, khataNumber, village, mType) {
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
            url: 'khata_number/get_all_land_details_data',
            type: 'post',
            data: $.extend({}, {'khata_number_for_show_land': khataNumber, 'village_for_show_land': village}, getTokenData()),
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
                if (parseData.success === false) {
                    btnObj.html(ogBtnHTML);
                    btnObj.attr('onclick', ogBtnOnclick);
                    showError(parseData.message);
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var landData = parseData.land_data;
                showPopup();
                $('.swal2-popup').css('width', '80em');
                that.loadLandDetails(khataNumber, village, landData, mType);
            }
        });
    },
    loadLandDetails: function (khataNumber, village, landData, mType) {
        $('#popup_container').html(showLandDetailTemplate({'khata_number': khataNumber, 'village': village}));
        var detailCnt = 1;
        $.each(landData, function (index, lnd) {
            if (lnd.owner_type == VALUE_TWO) {
                var occName = '<span style="font-weight: bold;">(' + lnd.occupant_name + ')</span><br/>' + lnd.joint_occupants
            } else {
                var occName = lnd.occupant_name;
            }
            var lndRow = '<tr><td class="text-center">' + detailCnt + '</td>'
                    + '<td class="text-center">'
                    + '<input type="hidden" id="hkn_for_kn_' + detailCnt + '" value="' + lnd.khata_number + '" />'
                    + '<input type="hidden" id="village_for_kn_' + detailCnt + '" value="' + lnd.village + '" />'
                    + lnd.khata_number + '</td>'
                    + '<td class="text-center">' + lnd.village_name + '</td>'
                    + '<td class="text-center">' + lnd.survey + '</td>'
                    + '<td class="text-center">' + lnd.subdiv + '</td>'
                    + '<td class="text-right">' + lnd.area + '</td>'
                    + '<td class="f-s-12px">' + occName + '</td>'
                    + '<td class="text-center">' + lnd.mutation_number + '</td>'
                    + '<td class="text-center">' + lnd.nature + '</td>'
                    + '<td>' + (lnd['nature'].indexOf(NA_NATURE_CODE) == -1 ? '<label class="form-title m-b-0px cursor-pointer f-w-n">'
                            + '<input type="checkbox" class="mb-0" id="area_type_for_kn_' + lnd.occupant_id + '" '
                            + 'onchange="KhataNumber.listview.isNAChangeEvent(' + lnd.occupant_id + ',' + mType + ');">&nbsp;&nbsp;N.A Land</label>' : '')
                    + '</td>'
                    + '<td class="text-center"><input type="text" class="form-control aadhar_card_number_kn" id="aadhar_card_number_' + detailCnt + '" onblur="aadharNumberValidation(\'ldkn\',\'aadhar_card_number_' + detailCnt + '\');" maxlength="12" placeholder="Enter Aadhar Number" value="' + lnd.aadhar_card_number + '"><span class="error-message error-message-ldkn-aadhar_card_number_' + detailCnt + '"></span></td>'
                    + '<td class="text-center"><input type="text" class="form-control mobile_number_kn" id="mobile_number_' + detailCnt + '" onblur="checkValidationForMobileNumberForOnlyEnter(\'ldkn\',\'mobile_number_' + detailCnt + '\');" maxlength="10" placeholder="Enter Mobile Number" value="' + lnd.mobile_number + '"><span class="error-message error-message-ldkn-mobile_number_' + detailCnt + '"></span></td>'
                    + '<td class="text-center"><input type="text" class="form-control" id="khata_number_' + detailCnt + '" maxlength="10" placeholder="Enter Khata Number" value="' + lnd.khata_number + '"><span class="error-message error-message-ldkn-khata_number_' + detailCnt + '"></span><button id="khata_number_update_btn_' + detailCnt + '" type="button" class="btn btn-xs btn-success float-right" onclick="KhataNumber.listview.updateKhataNumber($(this),' + detailCnt + ',' + lnd.occupant_id + ',' + mType + ');">Update</button></td><td style="display:none">' + lnd.occupant_id + '</td></tr>';
            $('#land_detail_container_for_kn').append(lndRow);
            if (lnd.is_na == VALUE_ONE) {
                $('#area_type_for_kn_' + lnd.occupant_id).prop('checked', true);
            }
            allowOnlyIntegerValue('khata_number_' + detailCnt);
            allowOnlyIntegerValue('aadhar_card_number');
            allowOnlyIntegerValue('mobile_number');
            detailCnt++;
        });
    },
    isNAChangeEvent: function (occId, mType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        if (!occId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (mType != VALUE_ONE && mType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        openFullPageOverlay();
        var formData = {};
        formData.occ_id_for_isna = occId;
        formData.is_na_for_isna = VALUE_ZERO;
        if ($('#area_type_for_kn_' + occId).is(':checked')) {
            formData.is_na_for_isna = VALUE_ONE;
        }
        $.ajax({
            url: 'khata_number/update_is_na',
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
                $('.success-message-kn').html(parseData.message);
                that.loadLandDetails(parseData.khata_number, parseData.village, parseData.land_data, mType);
                setTimeout(function () {
                    $('.success-message-kn').html('');
                }, 5000);
                if (mType == VALUE_TWO) {
                    LandTaxNA.listview.showAllNALandsDetails($('#knd_btn_for_ltna'), parseData.khata_number, parseData.village, VALUE_TWO);
                }
            }
        });
    },
    getAadharcarNumber: function () {
        var x = $('#aadhar_card_number_for_kn').val();
        $('.aadhar_card_number_kn').val(x);
    },
    getMobileNumber: function () {
        var x = $('#mobile_number_for_kn').val();
        $('.mobile_number_kn').val(x);
    },
    updateKhataNumber: function (btnObj, detailCnt, occupantId, mType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!occupantId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        $('.success-message-kn').html('');
        var khataNumber = $('#khata_number_' + detailCnt).val();
        if (!khataNumber || khataNumber == 0) {
            $('#khata_number_' + detailCnt).focus();
            validationMessageShow('ldkn-khata_number_' + detailCnt, khataNumberValidationMessage);
            return false;
        }
        var formData = {};
        formData.occupant_id_for_khata_number_update = occupantId;
        formData.khata_number_for_khata_number_update = khataNumber;
        formData.hkn_for_khata_number_update = $('#hkn_for_kn_' + detailCnt).val();
        formData.village_for_khata_number_update = $('#village_for_kn_' + detailCnt).val();
        var aadharNumber = $('#aadhar_card_number_' + detailCnt).val();
        if (aadharNumber != '') {
            var aaMessage = checkUID(aadharNumber);
            if (aaMessage != '') {
                $('#aadhar_card_number_' + detailCnt).focus();
                validationMessageShow('ldkn-aadhar_card_number_' + detailCnt, aaMessage);
                return false;
            }
        }
        formData.aadhar_card_number_for_khata_number_update = aadharNumber;
        var mobileNumber = $('#mobile_number_' + detailCnt).val();
        if (mobileNumber != '') {
            var mobMessage = mobileNumberValidation(mobileNumber);
            if (mobMessage != '') {
                $('#mobile_number_' + detailCnt).focus();
                validationMessageShow('ldkn-mobile_number_' + detailCnt, mobMessage);
                return false;
            }
        }
        formData.mobile_number_for_khata_number_update = mobileNumber;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'khata_number/update_khata_number',
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
                if (parseData.land_data) {
                    that.loadLandDetails(formData.hkn_for_khata_number_update, formData.village_for_khata_number_update, parseData.land_data, mType);
                }
                $('.success-message-kn').html(parseData.message);
                setTimeout(function () {
                    $('.success-message-kn').html('');
                }, 3000);
            }
        });
    },
    downloadDetailsOfKhataNumber: function (tempType, village, khataNumber) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if ((tempType != VALUE_ONE && tempType != VALUE_TWO) || !village || !khataNumber) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#temp_type_for_kndl').val(tempType);
        $('#village_for_kndl').val(village);
        $('#khata_number_for_kndl').val(khataNumber);
        $('#download_land_details_of_kndl').submit();
        $('.kndl').val('');
    },
    downloadExcelForKhataNumber: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#village_for_knge').val($('#village_for_khata_number_list').val());
        $('#survey_number_for_knge').val($('#survey_number_for_khata_number_list').val());
        $('#subdivision_number_for_knge').val($('#subdivision_number_for_khata_number_list').val());
        $('#khata_number_for_knge').val($('#khata_number_for_khata_number_list').val());
        $('#occupant_name_for_knge').val($('#occupant_name_for_khata_number_list').val());
        $('#download_khata_number_excel_form').submit();
        $('.knge').val('');
    },
    updateAadharCardNumber: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var aadharCardNumberData = $('#land_detail_form_for_kn').serializeFormJSON();
        validationMessageHide();
        if (!aadharCardNumberData.aadhar_card_number_for_kn) {
            $('#aadhar_card_number_for_kn').focus();
            validationMessageShow('land-detail-kn-aadhar_card_number_for_kn', aadharValidationMessage);
            return false;
        }
        var aaMessage = checkUID(aadharCardNumberData.aadhar_card_number_for_kn);
        if (aaMessage != '') {
            $('#aadhar_card_number_for_kn').focus();
            validationMessageShow('land-detail-kn-aadhar_card_number_for_kn', aaMessage);
            return false;
        }
        var aadharCardNumberItem = [];
        var isACValidation = false;
        $("#khata_number_table_for_kn tr:not(:first):not(:last)").each(function () {
            var aadharNumberInfo = {};
            aadharNumberInfo.occupant_id = $(this).find("td:eq(13)").text();
            var aadharId = $(this).find("td:eq(10) input[type='text']").attr('id');
            aadharNumberInfo.aadhar_card_number = $('#' + aadharId).val();
            if (aadharNumberInfo.aadhar_card_number != '') {
                var aadharMessage = checkUID(aadharNumberInfo.aadhar_card_number);
                if (aadharMessage != '') {
                    $('#' + aadharId).focus();
                    validationMessageShow('ldkn-' + aadharId, aadharMessage);
                    isACValidation = true;
                    return false;

                }
            }
            aadharCardNumberItem.push(aadharNumberInfo);
        });
        if (!isACValidation || aadharCardNumberItem.length === VALUE_ZERO) {
            return;
        }
        aadharCardNumberData.aadhar_card_number_detail = aadharCardNumberItem;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'khata_number/update_aadhar_card_number',
            data: $.extend({}, aadharCardNumberData, getTokenData()),
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
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                KhataNumber.listview.loadKhataNumberData();
            }
        });
    },
    updateMobileNumber: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var mobileNumberData = $('#land_detail_form_for_kn').serializeFormJSON();
        validationMessageHide();
        if (!mobileNumberData.mobile_number) {
            $('#mobile_number_for_kn').focus();
            validationMessageShow('land-detail-kn-mobile_number_for_kn', mobileValidationMessage);
            return false;
        }
        var mobMessage = mobileNumberValidation(mobileNumberData.mobile_number_for_kn);
        if (mobMessage != '') {
            $('#mobile_number_for_kn').focus();
            validationMessageShow('land-detail-kn-mobile_number_for_kn', mobMessage);
            return false;
        }
        var mobileNumberItem = [];
        var isMNValidation = false;
        $("#khata_number_table_for_kn tr:not(:first):not(:last)").each(function () {
            var mobileNumberInfo = {};
            mobileNumberInfo.occupant_id = $(this).find("td:eq(13)").text();
            var mobileId = $(this).find("td:eq(11) input[type='text']").attr('id');
            mobileNumberInfo.mobile_number = $('#' + mobileId).val();
            if (mobileNumberInfo.mobile_number != '') {
                var mobileMessage = mobileNumberValidation(mobileNumberInfo.mobile_number);
                if (mobileMessage != '') {
                    $('#' + mobileId).focus();
                    validationMessageShow('ldkn-' + mobileId, mobileMessage);
                    isMNValidation = true;
                    return false;

                }
            }
            mobileNumberItem.push(mobileNumberInfo);
        });
        if (!isMNValidation || mobileNumberItem.length === VALUE_ZERO) {
            return;
        }
        mobileNumberData.mobile_number_detail = mobileNumberItem;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'khata_number/update_mobile_number',
            data: $.extend({}, mobileNumberData, getTokenData()),
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
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                KhataNumber.listview.loadKhataNumberData();
            }
        });
    }
});
