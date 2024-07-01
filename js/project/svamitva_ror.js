var svamitvaRorListTemplate = Handlebars.compile($('#svamitva_ror_list_template').html());
var svamitvaRorSearchTemplate = Handlebars.compile($('#svamitva_ror_search_template').html());
var svamitvaRorTableTemplate = Handlebars.compile($('#svamitva_ror_table_template').html());
var svamitvaRorActionTemplate = Handlebars.compile($('#svamitva_ror_action_template').html());
var svamitvaRorViewTemplate = Handlebars.compile($('#svamitva_ror_view_template').html());
var svamitvaRorApproveTemplate = Handlebars.compile($('#svamitva_ror_approve_template').html());
var svamitvaRorRejectTemplate = Handlebars.compile($('#svamitva_ror_reject_template').html());
var svamitvaRorCopyDetailsTemplate = Handlebars.compile($('#svamitva_ror_copy_details_template').html());
var svamitvaRorCopyDetailsItemTemplate = Handlebars.compile($('#svamitva_ror_copy_details_item_template').html());

var searchSRORF = {};

var SvamitvaRor = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
SvamitvaRor.Router = Backbone.Router.extend({
    routes: {
        'svamitva_ror': 'renderList',
    },
    renderList: function () {
        SvamitvaRor.listview.listPage();
    },
});
SvamitvaRor.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sType, pgpcType, sSRId) {
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
        addClass('svamitva_ror', 'active');
        SvamitvaRor.router.navigate('svamitva_ror');
        var templateData = {};
        searchSRORF = {};
        this.$el.html(svamitvaRorListTemplate(templateData));
        this.loadSvamitvaRorData(sDistrict, sType, sSRId, pgpcType);
    },
    actionRenderer: function (rowData) {
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_FS ||
                tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                (rowData.status == VALUE_TWO)) {
            rowData.show_reject_btn = '';
        } else {
            rowData.show_reject_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                (rowData.plan_status == VALUE_FOUR && rowData.status == VALUE_TWO)) {
            rowData.show_approve_btn = '';
        } else {
            rowData.show_approve_btn = 'display: none;';
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_pa_btn = true;
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_FS ||
                tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                rowData.plan_status == VALUE_TWO && rowData.status == VALUE_TWO) {
            rowData.show_check_btn = true;
        }
        rowData.VALUE_ONE = VALUE_ONE;
        rowData.VALUE_TWO = VALUE_TWO;
        rowData.module_type = VALUE_TWENTYTWO;
        return svamitvaRorActionTemplate(rowData);
    },
    loadSvamitvaRorData: function (sDistrict, sType, sSRId, pgpcType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;

        SvamitvaRor.router.navigate('svamitva_ror');
        var searchData = dtomFeesStatus(sDistrict, sType, 'SvamitvaRor.listview.loadSvamitvaRorData();', pgpcType);
        if (typeof sSRId == "undefined") {
            sSRId = '';
        }
        searchData.svamitva_ror_id = sSRId;
        $('#svamitva_ror_form_and_datatable_container').html(svamitvaRorSearchTemplate(searchData));

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_svamitva_ror_list', false);

        renderOptionsForTwoDimensionalArray(fAppStatusTextArray, 'status_for_svamitva_ror_list', false);
        datePickerId('application_date_for_svamitva_ror_list');

        if (tempTypeInSession == TEMP_TYPE_A) {
            if (typeof searchSRORF.district_for_eocs_site_plan_rural_list != "undefined" && searchSRORF.district_for_eocs_site_plan_rural_list != '') {
                var villageData = (searchSRORF.district_for_eocs_site_plan_rural_list == VALUE_ONE ? tempUVillageData : (searchSRORF.district_for_eocs_site_plan_rural_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_svamitva_ror_list', 'village', 'village_name', false, false);
            }
        } else {
            var villageData = (tempDistrictInSession == VALUE_ONE ? tempUVillageData : (tempDistrictInSession == VALUE_TWO ? diuVillagesArray : (tempDistrictInSession == VALUE_THREE ? dnhVillagesArray : [])));
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_svamitva_ror_list', 'village', 'village_name', false, false);
        }

        $('#app_no_for_svamitva_ror_list').val((typeof searchSRORF.app_no_for_svamitva_ror_list != "undefined" && searchSRORF.app_no_for_svamitva_ror_list != '') ? searchSRORF.app_no_for_svamitva_ror_list : '');
        $('#application_date_for_svamitva_ror_list').val((typeof searchSRORF.application_date_for_svamitva_ror_list != "undefined" && searchSRORF.application_date_for_svamitva_ror_list != '') ? searchSRORF.application_date_for_svamitva_ror_list : searchData.s_appd);
        $('#app_details_for_svamitva_ror_list').val((typeof searchSRORF.app_details_for_svamitva_ror_list != "undefined" && searchSRORF.app_details_for_svamitva_ror_list != '') ? searchSRORF.app_details_for_svamitva_ror_list : '');
        $('#status_for_svamitva_ror_list').val((typeof searchSRORF.status_for_svamitva_ror_list != "undefined" && searchSRORF.status_for_svamitva_ror_list != '') ? searchSRORF.status_for_svamitva_ror_list : searchData.s_status);
        $('#district_for_svamitva_ror_list').val((typeof searchSRORF.district_for_svamitva_ror_list != "undefined" && searchSRORF.district_for_svamitva_ror_list != '') ? searchSRORF.district_for_svamitva_ror_list : searchData.search_district);
        $('#vdw_for_svamitva_ror_list').val((typeof searchSRORF.vdw_for_svamitva_ror_list != "undefined" && searchSRORF.vdw_for_svamitva_ror_list != '') ? searchSRORF.vdw_for_svamitva_ror_list : '');
        $('#is_full_for_svamitva_ror_list').val((typeof searchSRORF.is_full_for_svamitva_ror_list != "undefined" && searchSRORF.is_full_for_svamitva_ror_list != '') ? searchSRORF.is_full_for_svamitva_ror_list : searchData.s_is_full);
        $('#is_plan_status_for_svamitva_ror_list').val((typeof searchSUF.is_plan_status_for_svamitva_ror_list != "undefined" && searchSUF.is_plan_status_for_svamitva_ror_list != '') ? searchSUF.is_plan_status_for_svamitva_ror_list : searchData.s_plan_status);

        this.searchSvamitvaRorData();
    },
    searchSvamitvaRorData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#svamitva_ror_datatable_container').html(svamitvaRorTableTemplate);
        var searchData = $('#search_svamitva_ror_form').serializeFormJSON();

        searchSRORF = searchData;

        if (typeof btnObj == "undefined" && (searchSRORF.app_details_for_svamitva_ror_list == ''
                && searchSRORF.app_no_for_svamitva_ror_list == ''
                && searchSRORF.application_date_for_svamitva_ror_list == ''
                && searchSRORF.status_for_svamitva_ror_list == ''
                && searchSRORF.is_full_for_svamitva_ror_list == ''
                && searchSRORF.is_plan_status_for_svamitva_ror_list == ''
                && (searchSRORF.district_for_svamitva_ror_list == '' || typeof searchSRORF.district_for_svamitva_ror_list == "undefined")
                && (searchSRORF.vdw_for_svamitva_ror_list == '' || typeof searchSRORF.vdw_for_svamitva_ror_list == "undefined"))) {
            svamitvaRorDataTable = $('#svamitva_ror_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#svamitva_ror_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + ' ' + full.father_name + ' ' + full.surname
                    + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.address + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? tempUVillageData : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village] ? villageData[full.village]['village_name'] : '');
        };
        var basicDetailsRenderer = function (data, type, full, meta) {
            return that.getSSCADetails(full);
        };
        $('#svamitva_ror_datatable_container').html(svamitvaRorTableTemplate);
        svamitvaRorDataTable = $('#svamitva_ror_datatable').DataTable({
            ajax: {url: 'svamitva_ror/get_svamitva_ror_data', dataSrc: "svamitva_ror_data", type: "post", data: searchData},
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
                {data: 'svamitva_ror_id', 'class': 'text-center', 'render': formsSRORAppStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#svamitva_ror_datatable_filter').remove();
        $('#svamitva_ror_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = svamitvaRorDataTable.row(tr);

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
        var tempData = '<table class="table table-bordered mb-0 bg-beige f-s-12px" id="ssca_details_container_for_srorlist_' + full.svamitva_ror_id + '">';
        var landDetails = full.land_details != '' ? JSON.parse(full.land_details) : [];
        if (landDetails.length == VALUE_ZERO) {
            return '';
        }
        var colspan = '3';
        $.each(landDetails, function (index, ld) {
            tempData += '<tr><td class="text-center">' + ld.survey + '</td><td class="text-center">' + ld.subdiv + '</td>'
                    + '<td class="text-right">' + ld.copies + '</td>'
                    + (typeof ld.total_copy_generated == "undefined" ? '' : (ld.total_copy_generated == ld.copies ? '<td class="text-center" style="width: 30px;"><button class="btn btn-xs btn-info" title="View Copy Details" '
                            + 'onclick="SvamitvaRor.listview.requestForViewCopy($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-eye"></i></button></td>' :
                            ((full.status == VALUE_TWO) ? ('<td class="text-center" style="width: 30px;"><button class="btn btn-xs btn-nic-blue" title="Generate Copy" '
                                    + 'onclick="SvamitvaRor.listview.requestForGenerateCopy($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-recycle"></i></button></td>') : '')))
                    + '</tr>';
        });
        tempData += '<tr><td class="text-right f-w-b" colspan="' + colspan + '">Copies : '
                + full.total_copies + '</td></tr></table>';
        return tempData;
    },
    requestForSvamitvaRor: function (btnObj, svamitvaRorId, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!svamitvaRorId || (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FIVE)) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'svamitva_ror/get_svamitva_ror_data_by_id', type: 'post',
            data: $.extend({}, {'svamitva_ror_id': svamitvaRorId, 'module_type': moduleType}, getTokenData()),
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
                that.viewSvamitvaRor(moduleType, parseData);
            }
        });
    },
    setBasicDetailsforView: function (svamitvaRorData) {
        svamitvaRorData.district_text = talukaArray[svamitvaRorData.district] ? talukaArray[svamitvaRorData.district] : '';
        var district = svamitvaRorData.district;
        var tempURVillageData = district == VALUE_ONE ? tempUVillageData : (district == VALUE_TWO ? [] : []);
        svamitvaRorData.ld_area_type_text = areaTypeArray[svamitvaRorData.ld_area_type] ? areaTypeArray[svamitvaRorData.ld_area_type] : '';
//        var villageData = svamitvaRorData.district == TALUKA_DAMAN ? (svamitvaRorData.ld_area_type == VALUE_ONE ? damanCityArray : (svamitvaRorData.ld_area_type == VALUE_TWO ? tempUVillageData : [])) : [];
        svamitvaRorData.village_text = tempURVillageData[svamitvaRorData.village] ? tempURVillageData[svamitvaRorData.village]['village_name'] : '';
        return svamitvaRorData;
    },
    viewSvamitvaRor: function (moduleType, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FIVE) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var svamitvaRorData = parseData.svamitva_ror_data;
        svamitvaRorData.title = 'View';
        svamitvaRorData.VALUE_THREE = VALUE_THREE;
        svamitvaRorData = this.setBasicDetailsforView(svamitvaRorData);
        svamitvaRorData.show_id_proof = svamitvaRorData.id_proof != '' ? true : false;
        if (moduleType == VALUE_TWO) {
            svamitvaRorData.show_print_btn = true;
        }
        if (moduleType == VALUE_FIVE && svamitvaRorData.is_checked != VALUE_ONE && svamitvaRorData.plan_status == VALUE_TWO) {
            svamitvaRorData.show_enter_remarks = true;
            svamitvaRorData.show_check_btn = true;
        }
        if (svamitvaRorData.is_checked == VALUE_ONE && svamitvaRorData.checked_details != '') {
            var checkedDetails = JSON.parse(svamitvaRorData.checked_details);
            svamitvaRorData.show_checked_details = true;
            checkedDetails.checked_datetime_text = checkedDetails.checked_datetime ? dateTo_DD_MM_YYYY_HH_II_SS(checkedDetails.checked_datetime) : '';
            svamitvaRorData.n_checked_details = checkedDetails;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        svamitvaRorData.SVAMITVA_ROR_DOC_PATH = SVAMITVA_ROR_DOC_PATH;
        $('#popup_container').html(svamitvaRorViewTemplate(svamitvaRorData));
        var ldCnt = 1;
        var totalCopies = 0;
        $.each(parseData.form_land_details, function (index, fld) {
            var ldRow = '<tr><td class="text-center">' + ldCnt + '</td><td class="text-center">' + fld.survey + '</td>' + '<td class="text-center">' + fld.subdiv + '</td><td class="text-right">'
                    + fld.copies + '</td></tr>';
            $('#fld_container_for_srorview').append(ldRow);
            totalCopies += parseInt(fld.copies) ? parseInt(fld.copies) : VALUE_ZERO;
            ldCnt++;
        });
        $('#total_copies_for_srorview').html(totalCopies);
        if (moduleType == VALUE_TWO) {
            setTimeout(function () {
                $('#pa_btn_for_srorview').click();
            }, 500);
        }
    },
    askForApproveRejectApplication: function (btnObj, svamitvaRorId, moduleType) {
        if (!svamitvaRorId) {
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
            url: 'svamitva_ror/get_data_by_svamitva_ror_id',
            type: 'post',
            data: $.extend({}, {'svamitva_ror_id': svamitvaRorId, 'module_type': moduleType}, getTokenData()),
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
                var svamitvaRorData = parseData.svamitva_ror_data;
                showPopup();
                if (moduleType == VALUE_ONE) {
                    $('#popup_container').html(svamitvaRorApproveTemplate(svamitvaRorData));
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(svamitvaRorRejectTemplate(svamitvaRorData));
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
        var formData = $('#approve_svamitva_ror_form').serializeFormJSON();
        if (!formData.svamitva_ror_id_for_svamitva_ror_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_svamitva_ror_approve) {
            $('#remarks_for_svamitva_ror_approve').focus();
            validationMessageShow('svamitva-ror-approve-remarks_for_svamitva_ror_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_svamitva_ror_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'svamitva_ror/approve_application',
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
                validationMessageShow('svamitva-ror-approve', textStatus.statusText);
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
                    validationMessageShow('svamitva-ror-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                SvamitvaRor.listview.loadSvamitvaRorData();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_svamitva_ror_form').serializeFormJSON();
        if (!formData.svamitva_ror_id_for_svamitva_ror_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_svamitva_ror_reject) {
            $('#remarks_for_svamitva_ror_reject').focus();
            validationMessageShow('svamitva-ror-reject-remarks_for_svamitva_ror_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_svamitva_ror_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'svamitva_ror/reject_application',
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
                validationMessageShow('svamitva-ror-reject', textStatus.statusText);
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
                    validationMessageShow('svamitva-ror-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                SvamitvaRor.listview.loadSvamitvaRorData();
            }
        });
    },
    updateApplicationStatus: function (btnObj, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_THREE) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var srorId = $('#svamitva_ror_id_for_srorview').val();
        if (!srorId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var remarks = $('#remarks_for_srorview').val();
        if (!remarks) {
            $('#remarks_for_srorview').focus();
            validationMessageShow('srorview-remarks_for_srorview', remarksValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'svamitva_ror/update_status_for_sror',
            type: 'post',
            data: $.extend({}, {'sror_id': srorId, 'remarks': remarks, 'module_type': moduleType}, getTokenData()),
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
                SvamitvaRor.listview.listPage();
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
        var that = this;
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'svamitva_ror/request_for_generate_copy',
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
                var srorData = parseData.svamitva_ror_data;
                if (srorData.plan_status == VALUE_TWO) {
                    SvamitvaRor.listview.listPage('', '', '', srorData.svamitva_ror_id);
                } else {
                    $('#ssca_details_container_for_srorlist_' + srorData.svamitva_ror_id).parent().html(that.getSSCADetails(srorData));
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
            url: 'svamitva_ror/request_for_view_copy',
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
        var srorldData = parseData.srorld_data;
        var district = srorldData.district;
        srorldData.district_text = talukaArray[district] ? talukaArray[district] : '';
        var villageData = district == VALUE_ONE ? tempUVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        srorldData.village_text = villageData[srorldData.village] ? villageData[srorldData.village]['village_name'] : '';
        $('#popup_container').html(svamitvaRorCopyDetailsTemplate(srorldData));
        $.each(parseData.copy_details, function (index, cd) {
            cd.temp_cnt = (index + 1);
            cd.barcode_number = VALUE_TWENTYTWO + ('0000000' + cd.form_copy_id).slice(-7);
            cd.generated_datetime_text = cd.created_time != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(cd.created_time) : '';
            $('#cd_container_for_srorcd').append(svamitvaRorCopyDetailsItemTemplate(cd));
        });
    },
    districtChangeEvent: function (dObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var district = dObj.val();

        if (typeof district == "undefined") {
            district = tempDistrictInSession;
        }
        var tempURVillageData = district == VALUE_ONE ? tempUVillageData : (district == VALUE_TWO ? [] : []);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempURVillageData, 'vdw_for_svamitva_ror_list', 'village', 'village_name', false, false);
    },

});
