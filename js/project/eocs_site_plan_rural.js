var eocsSitePlanRuralListTemplate = Handlebars.compile($('#eocs_site_plan_rural_list_template').html());
var eocsSitePlanRuralSearchTemplate = Handlebars.compile($('#eocs_site_plan_rural_search_template').html());
var eocsSitePlanRuralTableTemplate = Handlebars.compile($('#eocs_site_plan_rural_table_template').html());
var eocsSitePlanRuralActionTemplate = Handlebars.compile($('#eocs_site_plan_rural_action_template').html());
var eocsSitePlanRuralViewTemplate = Handlebars.compile($('#eocs_site_plan_rural_view_template').html());
var eocsSitePlanRuralApproveTemplate = Handlebars.compile($('#eocs_site_plan_rural_approve_template').html());
var eocsSitePlanRuralRejectTemplate = Handlebars.compile($('#eocs_site_plan_rural_reject_template').html());
var eocsSitePlanRuralCopyDetailsTemplate = Handlebars.compile($('#eocs_site_plan_rural_copy_details_template').html());
var eocsSitePlanRuralCopyDetailsItemTemplate = Handlebars.compile($('#eocs_site_plan_rural_copy_details_item_template').html());
var eocsSitePlanRuralUploadCopyTemplate = Handlebars.compile($('#eocs_site_plan_rural_upload_copy_template').html());

var searchSRF = {};

var EocsSitePlanRural = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
EocsSitePlanRural.Router = Backbone.Router.extend({
    routes: {
        'eocs_site_plan_rural': 'renderList',
    },
    renderList: function () {
        EocsSitePlanRural.listview.listPage();
    },
});
EocsSitePlanRural.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sType, pgpcType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_EOCS_FS && tempTypeInSession != TEMP_TYPE_EOCS_HEAD
                && tempTypeInSession != TEMP_TYPE_EOCS_HS && tempTypeInSession != TEMP_TYPE_EOCS_JFS) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_eocs');
        addClass('eocs_site_plan_rural', 'active');
        EocsSitePlanRural.router.navigate('eocs_site_plan_rural');
        var templateData = {};
        searchSRF = {};
        this.$el.html(eocsSitePlanRuralListTemplate(templateData));
        this.loadEocsSitePlanRuralData(sDistrict, sType, pgpcType);
    },
    actionRenderer: function (rowData) {
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_FS ||
                tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                (rowData.status == VALUE_TWO) &&
                (rowData.query_status == VALUE_ZERO || rowData.query_status == VALUE_THREE)) {
            rowData.show_reject_btn = '';
        } else {
            rowData.show_reject_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                (rowData.plan_status == VALUE_FOUR && rowData.status == VALUE_FOUR) &&
                (rowData.query_status == VALUE_ZERO || rowData.query_status == VALUE_THREE)) {
            rowData.show_approve_btn = '';
        } else {
            rowData.show_approve_btn = 'display: none;';
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_pa_btn = true;
        }
        if (rowData.status == VALUE_TWO && rowData.is_verified != VALUE_ONE) {
            rowData.show_verify_btn = true;
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_FS ||
                tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                rowData.plan_status == VALUE_TWO && rowData.status == VALUE_FOUR) {
            rowData.show_prepare_btn = true;
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_FS ||
                tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                rowData.plan_status == VALUE_THREE && rowData.status == VALUE_FOUR) {
            rowData.show_check_btn = true;
        }
        rowData.VALUE_ONE = VALUE_ONE;
        rowData.VALUE_TWO = VALUE_TWO;
        rowData.module_type = VALUE_TWENTYFIVE;
        return eocsSitePlanRuralActionTemplate(rowData);
    },
    loadEocsSitePlanRuralData: function (sDistrict, sType, pgpcType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;

        EocsSitePlanRural.router.navigate('eocs_site_plan_rural');
        var searchData = dtomFeesStatus(sDistrict, sType, 'EocsSitePlanRural.listview.loadEocsSitePlanRuralData();', pgpcType);
        $('#eocs_site_plan_rural_form_and_datatable_container').html(eocsSitePlanRuralSearchTemplate(searchData));

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_eocs_site_plan_rural_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_eocs_site_plan_rural_list', false);
        renderOptionsForTwoDimensionalArray(fAppStatusTextArray, 'status_for_eocs_site_plan_rural_list', false);
        datePickerId('application_date_for_eocs_site_plan_rural_list');

        if (tempTypeInSession == TEMP_TYPE_A) {
            var villageData = (sDistrict == VALUE_ONE ? tempVillageData : (sDistrict == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_eocs_site_plan_rural_list', 'village', 'village_name', false, false);
        } else if (typeof searchSRF.district_for_eocs_site_plan_rural_list != "undefined" && searchSRF.district_for_eocs_site_plan_rural_list != '')
        {
            var villageData = (searchSRF.district_for_eocs_site_plan_rural_list == VALUE_ONE ? tempVillageData : (searchSRF.district_for_eocs_site_plan_rural_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_eocs_site_plan_rural_list', 'village', 'village_name', false, false);
        }

        $('#app_no_for_eocs_site_plan_rural_list').val((typeof searchSRF.app_no_for_eocs_site_plan_rural_list != "undefined" && searchSRF.app_no_for_eocs_site_plan_rural_list != '') ? searchSRF.app_no_for_eocs_site_plan_rural_list : '');
        $('#application_date_for_eocs_site_plan_rural_list').val((typeof searchSRF.application_date_for_eocs_site_plan_rural_list != "undefined" && searchSRF.application_date_for_eocs_site_plan_rural_list != '') ? searchSRF.application_date_for_eocs_site_plan_rural_list : searchData.s_appd);
        $('#app_details_for_eocs_site_plan_rural_list').val((typeof searchSRF.app_details_for_eocs_site_plan_rural_list != "undefined" && searchSRF.app_details_for_eocs_site_plan_rural_list != '') ? searchSRF.app_details_for_eocs_site_plan_rural_list : '');
        $('#query_status_for_eocs_site_plan_rural_list').val((typeof searchSRF.query_status_for_eocs_site_plan_rural_list != "undefined" && searchSRF.query_status_for_eocs_site_plan_rural_list != '') ? searchSRF.query_status_for_eocs_site_plan_rural_list : searchData.s_qstatus);
        $('#status_for_eocs_site_plan_rural_list').val((typeof searchSRF.status_for_eocs_site_plan_rural_list != "undefined" && searchSRF.status_for_eocs_site_plan_rural_list != '') ? searchSRF.status_for_eocs_site_plan_rural_list : searchData.s_status);
        $('#district_for_eocs_site_plan_rural_list').val((typeof searchSRF.district_for_eocs_site_plan_rural_list != "undefined" && searchSRF.district_for_eocs_site_plan_rural_list != '') ? searchSRF.district_for_eocs_site_plan_rural_list : searchData.search_district);
        $('#vdw_for_eocs_site_plan_rural_list').val((typeof searchSRF.vdw_for_eocs_site_plan_rural_list != "undefined" && searchSRF.vdw_for_eocs_site_plan_rural_list != '') ? searchSRF.vdw_for_eocs_site_plan_rural_list : '');
        $('#is_full_for_eocs_site_plan_rural_list').val((typeof searchSRF.is_full_for_eocs_site_plan_rural_list != "undefined" && searchSRF.is_full_for_eocs_site_plan_rural_list != '') ? searchSRF.is_full_for_eocs_site_plan_rural_list : searchData.s_is_full);
        $('#is_plan_status_for_eocs_site_plan_rural_list').val((typeof searchSUF.is_plan_status_for_eocs_site_plan_rural_list != "undefined" && searchSUF.is_plan_status_for_eocs_site_plan_rural_list != '') ? searchSUF.is_plan_status_rural_for_eocs_site_plan_list : searchData.s_plan_status);

        this.searchEocsSitePlanRuralData();
    },
    searchEocsSitePlanRuralData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#eocs_site_plan_rural_datatable_container').html(eocsSitePlanRuralTableTemplate);
        var searchData = $('#search_eocs_site_plan_rural_form').serializeFormJSON();

        searchSRF = searchData;

        if (typeof btnObj == "undefined" && (searchSRF.app_details_for_eocs_site_plan_rural_list == ''
                && searchSRF.app_no_for_eocs_site_plan_rural_list == ''
                && searchSRF.application_date_for_eocs_site_plan_rural_list == ''
                && searchSRF.query_status_for_eocs_site_plan_rural_list == ''
                && searchSRF.status_for_eocs_site_plan_rural_list == ''
                && searchSRF.is_full_for_eocs_site_plan_rural_list == ''
                && searchSRF.is_plan_status_for_eocs_site_plan_rural_list == ''
                && (searchSRF.district_for_eocs_site_plan_rural_list == '' || typeof searchSRF.district_for_eocs_site_plan_rural_list == "undefined")
                && (searchSRF.vdw_for_eocs_site_plan_rural_list == '' || typeof searchSRF.vdw_for_eocs_site_plan_rural_list == "undefined"))) {
            eocsSitePlanRuralDataTable = $('#eocs_site_plan_rural_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#eocs_site_plan_rural_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + ' ' + full.father_name + ' ' + full.surname
                    + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.address + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? tempVillageData : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village] ? villageData[full.village]['village_name'] : '');
        };
        var basicDetailsRenderer = function (data, type, full, meta) {
            return that.getSSCADetails(full);
        };
        $('#eocs_site_plan_rural_datatable_container').html(eocsSitePlanRuralTableTemplate);
        eocsSitePlanRuralDataTable = $('#eocs_site_plan_rural_datatable').DataTable({
            ajax: {url: 'eocs_site_plan_rural/get_eocs_site_plan_rural_data', dataSrc: "eocs_site_plan_rural_data", type: "post", data: searchData},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'application_number', 'class': 'text-center f-w-b', 'render': appNumberRenderer},
                {data: '', 'class': 'f-s-app-details', 'render': appDetailsRenderer},
                {data: 'district', 'class': 'text-center f-s-app-details', 'render': distVillRenderer},
                {data: '', 'class': 'text-center', 'render': basicDetailsRenderer},
                {data: 'eocs_site_plan_rural_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'eocs_site_plan_rural_id', 'class': 'text-center', 'render': formsAppStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#eocs_site_plan_rural_datatable_filter').remove();
        $('#eocs_site_plan_rural_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = eocsSitePlanRuralDataTable.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(that.actionRenderer(row.data())).show();
                tr.addClass('shown');
            }
        });
    },
    getSSCADetails: function (full) {
        var tempData = (full.status == VALUE_FIVE ? '<div class="f-w-b text-danger"><u>Note : Please Collect Your Site Plan Copies from Office in Office Hours.</u></div>' : '');
        tempData += '<table class="table table-bordered mb-0 bg-beige f-s-12px" id="ssca_details_container_for_esprlist_' + full.eocs_site_plan_rural_id + '">';
        var landDetails = full.land_details != '' ? JSON.parse(full.land_details) : [];
        if (landDetails.length == VALUE_ZERO) {
            return '';
        }
        $.each(landDetails, function (index, ld) {
            tempData += '<tr><td class="text-center">' + ld.survey + '</td><td class="text-center">' + ld.subdiv + '</td>'
                    + '<td class="text-right">' + ld.copies + '</td><td class="text-right">' + ld.amount + '</td>'
                    + '</tr>';
//            tempData += '<tr><td class="text-center">' + ld.survey + '</td><td class="text-center">' + ld.subdiv + '</td>'
//                    + '<td class="text-right">' + ld.copies + '</td><td class="text-right">' + ld.amount + '</td>'
//                    + (typeof ld.total_copy_generated == "undefined" ? '' : (ld.total_copy_generated == ld.copies ? '<td class="text-center"><button class="btn btn-xs btn-info" title="View Copy Details" '
//                            + 'onclick="EocsSitePlanRural.listview.requestForViewCopy($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-eye"></i></button></td>' :
//                            (full.status == VALUE_FOUR ? ('<td class="text-center"><button class="btn btn-xs btn-nic-blue" title="Upload Plan & Generate Copy" '
//                                    + 'onclick="EocsSitePlanRural.listview.openUploadPlanForm($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-recycle"></i></button></td>') : '')))
//                    + '</tr>';
        });
        tempData += '<tr><td class="text-right text-success f-w-b" colspan="2">Rupees To Be Paid : </td><td class="text-right f-w-b">Copies : ' +
                full.total_copies + '</td><td class="text-right f-w-b">Rs. : ' + full.total_amount + '</td></tr></table>';
        return tempData;
    },
    requestForEocsSitePlanRuralData: function (btnObj, eocsSitePlanRuralId, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!eocsSitePlanRuralId || (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FOUR && moduleType != VALUE_FIVE)) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'eocs_site_plan_rural/get_eocs_site_plan_rural_data_by_id',
            type: 'post',
            data: $.extend({}, {'eocs_site_plan_rural_id': eocsSitePlanRuralId, 'module_type': moduleType}, getTokenData()),
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
                that.viewEocsSitePlanRural(moduleType, parseData);
            }
        });
    },
    setBasicDetailsforView: function (eocsSitePlanRuralData) {
        eocsSitePlanRuralData.district_text = talukaArray[eocsSitePlanRuralData.district] ? talukaArray[eocsSitePlanRuralData.district] : '';
        var district = eocsSitePlanRuralData.district;
        var villageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        eocsSitePlanRuralData.village_text = villageData[eocsSitePlanRuralData.village] ? villageData[eocsSitePlanRuralData.village]['village_name'] : '';
        return eocsSitePlanRuralData;
    },
    viewEocsSitePlanRural: function (moduleType, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FOUR && moduleType != VALUE_FIVE) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var eocsSitePlanRuralData = parseData.eocs_site_plan_rural_data;
        eocsSitePlanRuralData.title = 'View';
        eocsSitePlanRuralData.VALUE_THREE = VALUE_THREE;
        eocsSitePlanRuralData = this.setBasicDetailsforView(eocsSitePlanRuralData);
//        eocsSitePlanRuralData.show_applicant_photo = eocsSitePlanRuralData.applicant_photo != '' ? true : false;
        eocsSitePlanRuralData.show_nakal = eocsSitePlanRuralData.nakal != '' ? true : false;
        eocsSitePlanRuralData.show_id_proof = eocsSitePlanRuralData.id_proof != '' ? true : false;
        if (moduleType == VALUE_TWO) {
            eocsSitePlanRuralData.show_print_btn = true;
        }
        if (moduleType == VALUE_THREE && eocsSitePlanRuralData.is_verified != VALUE_ONE) {
            eocsSitePlanRuralData.show_enter_remarks = true;
            eocsSitePlanRuralData.show_verification_btn = true;
        }
        if (eocsSitePlanRuralData.is_verified == VALUE_ONE && eocsSitePlanRuralData.verified_details != '') {
            var verifiedDetails = JSON.parse(eocsSitePlanRuralData.verified_details);
            eocsSitePlanRuralData.show_verification_details = true;
            verifiedDetails.verified_datetime_text = verifiedDetails.verified_datetime ? dateTo_DD_MM_YYYY_HH_II_SS(verifiedDetails.verified_datetime) : '';
            eocsSitePlanRuralData.n_verified_details = verifiedDetails;
        }
        if (moduleType == VALUE_FOUR && eocsSitePlanRuralData.is_prepared != VALUE_ONE && eocsSitePlanRuralData.plan_status == VALUE_TWO) {
            eocsSitePlanRuralData.show_enter_remarks = true;
            eocsSitePlanRuralData.show_prepare_btn = true;
        }
        if (eocsSitePlanRuralData.is_prepared == VALUE_ONE && eocsSitePlanRuralData.prepared_details != '') {
            var preparedDetails = JSON.parse(eocsSitePlanRuralData.prepared_details);
            eocsSitePlanRuralData.show_prepared_details = true;
            preparedDetails.prepared_datetime_text = preparedDetails.prepared_datetime ? dateTo_DD_MM_YYYY_HH_II_SS(preparedDetails.prepared_datetime) : '';
            eocsSitePlanRuralData.n_prepared_details = preparedDetails;
        }
        if (moduleType == VALUE_FIVE && eocsSitePlanRuralData.is_checked != VALUE_ONE && eocsSitePlanRuralData.plan_status == VALUE_THREE) {
            eocsSitePlanRuralData.show_enter_remarks = true;
            eocsSitePlanRuralData.show_check_btn = true;
        }
        if (eocsSitePlanRuralData.is_checked == VALUE_ONE && eocsSitePlanRuralData.checked_details != '') {
            var checkedDetails = JSON.parse(eocsSitePlanRuralData.checked_details);
            eocsSitePlanRuralData.show_checked_details = true;
            checkedDetails.checked_datetime_text = checkedDetails.checked_datetime ? dateTo_DD_MM_YYYY_HH_II_SS(checkedDetails.checked_datetime) : '';
            eocsSitePlanRuralData.n_checked_details = checkedDetails;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        eocsSitePlanRuralData.EOCS_SITE_PLAN_RURAL_DOC_PATH = EOCS_SITE_PLAN_RURAL_DOC_PATH;
        $('#popup_container').html(eocsSitePlanRuralViewTemplate(eocsSitePlanRuralData));

        var ldCnt = 1;
        var totalCopies = 0;
        var totalAmount = 0;
        $.each(parseData.form_land_details, function (index, fld) {
            var ldRow = '<tr><td class="text-center">' + ldCnt + '</td><td class="text-center">' + fld.survey + '</td>' + '<td class="text-center">' + fld.subdiv + '</td>' +
                    '<td class="text-center">' + fld.total_area + '</td><td class="text-right">' + fld.copies + '</td><td class="text-right">' + fld.amount + '</td></tr>';
            $('#fld_container_for_esprview').append(ldRow);
            totalCopies += parseInt(fld.copies) ? parseInt(fld.copies) : VALUE_ZERO;
            totalAmount += parseInt(fld.amount) ? parseInt(fld.amount) : VALUE_ZERO;
            ldCnt++;
        });
        $('#total_copies_for_esprview').html(totalCopies);
        $('#total_amount_for_esprview').html(totalAmount);
        if (moduleType == VALUE_TWO) {
            setTimeout(function () {
                $('#pa_btn_for_esprview').click();
            }, 500);
        }
    },
    askForApproveRejectApplication: function (btnObj, eocsSitePlanRuralId, moduleType) {
        if (!eocsSitePlanRuralId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'eocs_site_plan_rural/get_data_by_eocs_site_plan_rural_id',
            type: 'post',
            data: $.extend({}, {'eocs_site_plan_rural_id': eocsSitePlanRuralId, 'module_type': moduleType}, getTokenData()),
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
                var eocsSitePlanRuralData = parseData.eocs_site_plan_rural_data;
                showPopup();
                if (moduleType == VALUE_ONE) {
                    $('#popup_container').html(eocsSitePlanRuralApproveTemplate(eocsSitePlanRuralData));
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(eocsSitePlanRuralRejectTemplate(eocsSitePlanRuralData));
                    return false;
                }

            }
        });
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_eocs_site_plan_rural_form').serializeFormJSON();
        if (!formData.eocs_site_plan_rural_id_for_eocs_site_plan_rural_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_eocs_site_plan_rural_approve) {
            $('#remarks_for_eocs_site_plan_rural_approve').focus();
            validationMessageShow('eocs-site-plan-rural-approve-remarks_for_eocs_site_plan_rural_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_eocs_site_plan_rural_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'eocs_site_plan_rural/approve_application',
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
                validationMessageShow('eocs-site-plan-rural-approve', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
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
                    validationMessageShow('eocs-site-plan-rural-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                EocsSitePlanRural.listview.loadEocsSitePlanRuralData();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_eocs_site_plan_rural_form').serializeFormJSON();
        if (!formData.eocs_site_plan_rural_id_for_eocs_site_plan_rural_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_eocs_site_plan_rural_reject) {
            $('#remarks_for_eocs_site_plan_rural_reject').focus();
            validationMessageShow('eocs-site-plan-rural-reject-remarks_for_eocs_site_plan_rural_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_eocs_site_plan_rural_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'eocs_site_plan_rural/reject_application',
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
                validationMessageShow('eocs-site-plan-rural-reject', textStatus.statusText);
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
                    validationMessageShow('eocs-site-plan-rural-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                EocsSitePlanRural.listview.loadEocsSitePlanRuralData();
            }
        });
    },
    openUploadPlanForm: function (btnObj, formLandDetailsId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'eocs_site_plan_rural/request_for_upload_plan_copy',
            type: 'post',
            data: $.extend({}, {'form_land_details_id': formLandDetailsId}, getTokenData()),
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
                $('.swal2-popup').css('width', '45em');
                var eocsSitePlanRuralData = that.setBasicDetailsforView(parseData.eocs_site_plan_rural_data);
                $('#popup_container').html(eocsSitePlanRuralUploadCopyTemplate(eocsSitePlanRuralData));
            }
        });
    },
    requestForGenerateCopy: function (btnObj, formLandDetailsId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var pcMessage = fileUploadValidationForPDF('plan_copy_for_espruc', 5120);
        if (pcMessage != '') {
            $('#plan_copy_for_espruc').focus();
            validationMessageShow('espruc-plan_copy_for_espruc', pcMessage);
            return false;
        }
        var that = this;
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var newFormData = new FormData($('#espruc_form')[0]);
        newFormData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        newFormData.append("form_land_details_id", formLandDetailsId);
        $.ajax({
            url: 'eocs_site_plan_rural/request_for_generate_copy',
            type: 'post',
            data: newFormData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
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
                closeFullPageOverlay();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
            },
            success: function (response) {
                closeFullPageOverlay();
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
                var esprData = parseData.eocs_site_plan_rural_data;
                if (esprData.plan_status == VALUE_TWO) {
                    EocsSitePlanRural.listview.listPage();
                } else {
                    $('#ssca_details_container_for_esprlist_' + esprData.eocs_site_plan_rural_id).parent().html(that.getSSCADetails(esprData));
                }
                showSuccess(parseData.message);
            }
        });
    },
    requestForReGenerateCopy: function (btnObj, formLandDetailsId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var pcMessage = fileUploadValidationForPDF('plan_copy_for_esprruc', 5120);
        if (pcMessage != '') {
            $('#plan_copy_for_esprruc').focus();
            validationMessageShow('esprruc-plan_copy_for_esprruc', pcMessage);
            return false;
        }
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var newFormData = new FormData($('#esprruc_form')[0]);
        newFormData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        newFormData.append("form_land_details_id", formLandDetailsId);
        $.ajax({
            url: 'eocs_site_plan_rural/request_for_regenerate_copy',
            type: 'post',
            data: newFormData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
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
                closeFullPageOverlay();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
            },
            success: function (response) {
                closeFullPageOverlay();
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
            }
        });
    },
    requestForViewCopy: function (btnObj, formLandDetailsId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'eocs_site_plan_rural/request_for_view_copy',
            type: 'post',
            data: $.extend({}, {'form_land_details_id': formLandDetailsId}, getTokenData()),
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
                that.viewCopyDetails(parseData);
            }
        });
    },
    viewCopyDetails: function (parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        var esprldData = this.setBasicDetailsforView(parseData.esprld_data);
//        if (esprldData.status == VALUE_FOUR && (esprldData.plan_status == VALUE_ONE || esprldData.plan_status == VALUE_TWO)) {
//            esprldData.show_regenerate_copy_details = true;
//        }
        $('#popup_container').html(eocsSitePlanRuralCopyDetailsTemplate(esprldData));
        $.each(parseData.copy_details, function (index, cd) {
            cd.temp_cnt = (index + 1);
            cd.barcode_number = VALUE_TWENTYFIVE + ('0000000' + cd.form_copy_id).slice(-7);
            cd.generated_datetime_text = cd.created_time != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(cd.created_time) : '';
            $('#cd_container_for_esprcd').append(eocsSitePlanRuralCopyDetailsItemTemplate(cd));
        });
    },
    getQueryData: function (eocsSitePlanRuralId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!eocsSitePlanRuralId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var templateData = {};
        templateData.module_type = VALUE_TWENTYFIVE;
        templateData.module_id = eocsSitePlanRuralId;
        var btnObj = $('#query_btn_for_app_' + eocsSitePlanRuralId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'utility/get_query_data',
            type: 'post',
            data: $.extend({}, templateData, getTokenData()),
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
                return false;
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(response);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                var moduleData = parseData.module_data;
                var tmpData = {};
                tmpData.application_number = moduleData.application_number;
                tmpData.applicant_name = moduleData.applicant_name;
                tmpData.title = 'Name of Applicant';
                tmpData.module_type = VALUE_TWENTYFIVE;
                tmpData.module_id = eocsSitePlanRuralId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    updateApplicationStatus: function (btnObj, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var esprId = $('#eocs_site_plan_rural_id_for_esprview').val();
        if (!esprId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var remarks = $('#remarks_for_esprview').val();
        if (!remarks) {
            $('#remarks_for_esprview').focus();
            validationMessageShow('esprview-remarks_for_esprview', remarksValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'eocs_site_plan_rural/update_status_for_espr',
            type: 'post',
            data: $.extend({}, {'espr_id': esprId, 'remarks': remarks, 'module_type': moduleType}, getTokenData()),
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
                return false;
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
                EocsSitePlanRural.listview.listPage();
            }
        });
    }
});
