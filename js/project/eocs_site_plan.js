var eocsSitePlanListTemplate = Handlebars.compile($('#eocs_site_plan_list_template').html());
var eocsSitePlanSearchTemplate = Handlebars.compile($('#eocs_site_plan_search_template').html());
var eocsSitePlanTableTemplate = Handlebars.compile($('#eocs_site_plan_table_template').html());
var eocsSitePlanActionTemplate = Handlebars.compile($('#eocs_site_plan_action_template').html());
var eocsSitePlanViewTemplate = Handlebars.compile($('#eocs_site_plan_view_template').html());
var eocsSitePlanApproveTemplate = Handlebars.compile($('#eocs_site_plan_approve_template').html());
var eocsSitePlanRejectTemplate = Handlebars.compile($('#eocs_site_plan_reject_template').html());
var eocsSitePlanCopyDetailsTemplate = Handlebars.compile($('#eocs_site_plan_copy_details_template').html());
var eocsSitePlanCopyDetailsItemTemplate = Handlebars.compile($('#eocs_site_plan_copy_details_item_template').html());
var eocsSitePlanUploadCopyTemplate = Handlebars.compile($('#eocs_site_plan_upload_copy_template').html());

var searchSUF = {};

var EocsSitePlan = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
EocsSitePlan.Router = Backbone.Router.extend({
    routes: {
        'eocs_site_plan': 'renderList',
    },
    renderList: function () {
        EocsSitePlan.listview.listPage();
    },
});
EocsSitePlan.listView = Backbone.View.extend({
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
        addClass('eocs_site_plan', 'active');
        EocsSitePlan.router.navigate('eocs_site_plan');
        var templateData = {};
        searchSUF = {};
        this.$el.html(eocsSitePlanListTemplate(templateData));
        this.loadEocsSitePlanData(sDistrict, sType, pgpcType);
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
        rowData.module_type = VALUE_TWENTYTHREE;
        return eocsSitePlanActionTemplate(rowData);
    },
    loadEocsSitePlanData: function (sDistrict, sType, pgpcType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;

        EocsSitePlan.router.navigate('eocs_site_plan');
        var searchData = dtomFeesStatus(sDistrict, sType, 'EocsSitePlan.listview.loadEocsSitePlanData();', pgpcType);
        $('#eocs_site_plan_form_and_datatable_container').html(eocsSitePlanSearchTemplate(searchData));

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_eocs_site_plan_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_eocs_site_plan_list', false);
        renderOptionsForTwoDimensionalArray(fAppStatusTextArray, 'status_for_eocs_site_plan_list', false);
        datePickerId('application_date_for_eocs_site_plan_list');

        if (typeof searchSUF.district_for_eocs_site_plan_list != "undefined" && searchSUF.district_for_eocs_site_plan_list != '' && searchSUF.area_type_for_eocs_site_plan_list && searchSUF.village_for_eocs_site_plan_list != '') {
            if (searchSUF.area_type_for_eocs_site_plan_list == VALUE_ONE) {
                var villageData = (searchSUF.district_for_eocs_site_plan_list == VALUE_ONE ? damanCityArray : (searchSUF.district_for_eocs_site_plan_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_eocs_site_plan_list', false);
            } else if (searchSUF.area_type_for_eocs_site_plan_list == VALUE_TWO) {
                var villageData = (searchSUF.district_for_eocs_site_plan_list == VALUE_ONE ? tempUVillageData : (searchSUF.district_for_eocs_site_plan_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_eocs_site_plan_list', 'village', 'village_name', false, false);
            }
        }

        $('#app_no_for_eocs_site_plan_list').val((typeof searchSUF.app_no_for_eocs_site_plan_list != "undefined" && searchSUF.app_no_for_eocs_site_plan_list != '') ? searchSUF.app_no_for_eocs_site_plan_list : '');
        $('#application_date_for_eocs_site_plan_list').val((typeof searchSUF.application_date_for_eocs_site_plan_list != "undefined" && searchSUF.application_date_for_eocs_site_plan_list != '') ? searchSUF.application_date_for_eocs_site_plan_list : searchData.s_appd);
        $('#app_details_for_eocs_site_plan_list').val((typeof searchSUF.app_details_for_eocs_site_plan_list != "undefined" && searchSUF.app_details_for_eocs_site_plan_list != '') ? searchSUF.app_details_for_eocs_site_plan_list : '');
        $('#query_status_for_eocs_site_plan_list').val((typeof searchSUF.query_status_for_eocs_site_plan_list != "undefined" && searchSUF.query_status_for_eocs_site_plan_list != '') ? searchSUF.query_status_for_eocs_site_plan_list : searchData.s_qstatus);
        $('#status_for_eocs_site_plan_list').val((typeof searchSUF.status_for_eocs_site_plan_list != "undefined" && searchSUF.status_for_eocs_site_plan_list != '') ? searchSUF.status_for_eocs_site_plan_list : searchData.s_status);
        $('#district_for_eocs_site_plan_list').val((typeof searchSUF.district_for_eocs_site_plan_list != "undefined" && searchSUF.district_for_eocs_site_plan_list != '') ? searchSUF.district_for_eocs_site_plan_list : searchData.search_district);
        $('#area_type_for_eocs_site_plan_list').val((typeof searchSUF.area_type_for_eocs_site_plan_list != "undefined" && searchSUF.area_type_for_eocs_site_plan_list != '') ? searchSUF.area_type_for_eocs_site_plan_list : '');
        $('#vdw_for_eocs_site_plan_list').val((typeof searchSUF.vdw_for_eocs_site_plan_list != "undefined" && searchSUF.vdw_for_eocs_site_plan_list != '') ? searchSUF.vdw_for_eocs_site_plan_list : '');
        $('#is_full_for_eocs_site_plan_list').val((typeof searchSUF.is_full_for_eocs_site_plan_list != "undefined" && searchSUF.is_full_for_eocs_site_plan_list != '') ? searchSUF.is_full_for_eocs_site_plan_list : searchData.s_is_full);
        $('#is_plan_status_for_eocs_site_plan_list').val((typeof searchSUF.is_plan_status_for_eocs_site_plan_list != "undefined" && searchSUF.is_plan_status_for_eocs_site_plan_list != '') ? searchSUF.is_plan_status_for_eocs_site_plan_list : searchData.s_plan_status);

        this.searchEocsSitePlanData();

    },
    searchEocsSitePlanData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#eocs_site_plan_datatable_container').html(eocsSitePlanTableTemplate);
        var searchData = $('#search_eocs_site_plan_form').serializeFormJSON();

        searchSUF = searchData;

        if (typeof btnObj == "undefined" && (searchSUF.app_details_for_eocs_site_plan_list == ''
                && searchSUF.app_no_for_eocs_site_plan_list == ''
                && searchSUF.application_date_for_eocs_site_plan_list == ''
                && searchSUF.query_status_for_eocs_site_plan_list == ''
                && searchSUF.status_for_eocs_site_plan_list == ''
                && searchSUF.is_full_for_eocs_site_plan_list == ''
                && searchSUF.is_plan_status_for_eocs_site_plan_list == ''
                && (searchSUF.district_for_eocs_site_plan_list == '' || typeof searchSUF.district_for_eocs_site_plan_list == "undefined")
                && (searchSUF.area_type_for_eocs_site_plan_list == '' || typeof searchSUF.area_type_for_eocs_site_plan_list == "undefined")
                && (searchSUF.vdw_for_eocs_site_plan_list == '' || typeof searchSUF.vdw_for_eocs_site_plan_list == "undefined"))) {
            eocsSitePlanDataTable = $('#eocs_site_plan_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#eocs_site_plan_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + ' ' + full.father_name + ' ' + full.surname
                    + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.address + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = full.district == TALUKA_DAMAN ? (full.ld_area_type == VALUE_ONE ? damanCityArray : (full.ld_area_type == VALUE_TWO ? tempUVillageData : [])) : [];
            var villageName = '';
            if (full.ld_area_type == VALUE_ONE) {
                villageName = villageData[full.ld_village_sc] ? villageData[full.ld_village_sc] : '';
            } else if (full.ld_area_type == VALUE_TWO) {
                villageName = villageData[full.ld_village_sc] ? villageData[full.ld_village_sc]['village_name'] : '';
            }
            return (talukaArray[data] ? talukaArray[data] : '') + ((data != 0 && full.ld_area_type != 0) ? (areaTypeArray[full.ld_area_type] ? ('<br><b>(' + areaTypeArray[full.ld_area_type] + ')</b>') : '') : '') +
                    ((data != 0 && full.village != '') ? '<hr>' : '') + villageName;
        };
        var basicDetailsRenderer = function (data, type, full, meta) {
            return that.getSSCADetails(full);
        };
        $('#eocs_site_plan_datatable_container').html(eocsSitePlanTableTemplate);
        eocsSitePlanDataTable = $('#eocs_site_plan_datatable').DataTable({
            ajax: {url: 'eocs_site_plan/get_eocs_site_plan_data', dataSrc: "eocs_site_plan_data", type: "post", data: searchData},
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
                {data: 'eocs_site_plan_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'eocs_site_plan_id', 'class': 'text-center', 'render': formsAppStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#eocs_site_plan_datatable_filter').remove();
        $('#eocs_site_plan_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = eocsSitePlanDataTable.row(tr);

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
        tempData += '<table class="table table-bordered mb-0 bg-beige f-s-12px" id="ssca_details_container_for_esplist_' + full.eocs_site_plan_id + '">';
        var landDetails = full.land_details != '' ? JSON.parse(full.land_details) : [];
        if (landDetails.length == VALUE_ZERO) {
            return '';
        }
        var colspan = '2';
        $.each(landDetails, function (index, ld) {
            var eLD = '';
            var fdbBtn = '';
            if (ld.property_status) {
                var psFormData = psFormArray[ld.property_status] ? psFormArray[ld.property_status] : [];
                eLD = '<td class="text-center">' + (propertyStatusTextArray[ld.property_status] ? propertyStatusTextArray[ld.property_status] : '') + '</td>'
                        + '<td class="text-center">' + (ld.apply_with ? getCheckboxValue(ld.apply_with, psFormData) : '') + '</td>';
                colspan = '4';

                var aw = ld.apply_with != '' ? ld['apply_with'].split(',') : [];
                if (aw.length != VALUE_ZERO) {
                    if ($.inArray('1', aw) != -1 && ld['total_fd_copy_generated'] != ld['copies'] && full.status == VALUE_FOUR) {
                        fdbBtn += '<td class="text-center"><button class="btn btn-xs btn-nic-blue" title="Generate Form D" '
                                + 'onclick="EocsSitePlan.listview.requestForGenerateFormDB($(this),\'' + ld.form_land_details_id + '\',\'' + VALUE_ONE + '\')">FD</button></td>';
                    }
                    if ($.inArray('2', aw) != -1 && ld['total_fb_copy_generated'] != ld['copies'] && full.status == VALUE_FOUR) {
                        fdbBtn += '<td class="text-center"><button class="btn btn-xs btn-nic-blue" title="Generate Form B" '
                                + 'onclick="EocsSitePlan.listview.requestForGenerateFormDB($(this),\'' + ld.form_land_details_id + '\',\'' + VALUE_TWO + '\')">FB</button></td>';
                    }
                }
            }
            tempData += '<tr><td class="text-center">' + ld.survey + '</td><td class="text-center">' + ld.subdiv + '</td>'
                    + eLD
                    + '<td class="text-right">' + ld.copies + '</td><td class="text-right">' + ld.amount + '</td>'
                    + ((typeof ld.total_fb_copy_generated == "undefined" || typeof ld.total_fd_copy_generated == "undefined") ? '' :
                            ((ld.total_fb_copy_generated == ld.copies || ld.total_fd_copy_generated == ld.copies) ? '<td class="text-center"><button class="btn btn-xs btn-info" title="View Copy Details" '
                                    + 'onclick="EocsSitePlan.listview.requestForViewCopy($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-eye"></i></button></td>' : ''))
                    + fdbBtn
                    + '</tr>';
//            tempData += '<tr><td class="text-center">' + ld.survey + '</td><td class="text-center">' + ld.subdiv + '</td>'
//                    + eLD
//                    + '<td class="text-right">' + ld.copies + '</td><td class="text-right">' + ld.amount + '</td>'
//                    + ((typeof ld.total_fb_copy_generated == "undefined" || typeof ld.total_fd_copy_generated == "undefined") ? '' :
//                            ((ld.total_fb_copy_generated == ld.copies || ld.total_fd_copy_generated == ld.copies) ? '<td class="text-center"><button class="btn btn-xs btn-info" title="View Copy Details" '
//                                    + 'onclick="EocsSitePlan.listview.requestForViewCopy($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-eye"></i></button></td>' :
//                                    (full.status == VALUE_FOUR ? ('<td class="text-center"><button class="btn btn-xs btn-nic-blue" title="Upload Plan & Generate Copy" '
//                                            + 'onclick="EocsSitePlan.listview.openUploadPlanForm($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-recycle"></i></button></td>') : '')))
//                    + fdbBtn
//                    + '</tr>';
        });
        tempData += '<tr><td class="text-right text-success f-w-b" colspan="' + colspan + '">Rupees To Be Paid : </td><td class="text-right f-w-b">Copies : '
                + full.total_copies + '</td><td class="text-right f-w-b">Rs. : ' + full.total_amount + '</td></tr></table>';
        return tempData;
    },
    requestForEocsSitePlanData: function (btnObj, eocsSitePlanId, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!eocsSitePlanId || (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
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
            url: 'eocs_site_plan/get_eocs_site_plan_data_by_id',
            type: 'post',
            data: $.extend({}, {'eocs_site_plan_id': eocsSitePlanId, 'module_type': moduleType}, getTokenData()),
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
                that.viewEocsSitePlan(moduleType, parseData);
            }
        });
    },
    setBasicDetailsforView: function (eocsSitePlanData) {
        eocsSitePlanData.district_text = talukaArray[eocsSitePlanData.district] ? talukaArray[eocsSitePlanData.district] : '';
        eocsSitePlanData.ld_area_type_text = areaTypeArray[eocsSitePlanData.ld_area_type] ? areaTypeArray[eocsSitePlanData.ld_area_type] : '';
        var villageData = eocsSitePlanData.district == TALUKA_DAMAN ? (eocsSitePlanData.ld_area_type == VALUE_ONE ? damanCityArray : (eocsSitePlanData.ld_area_type == VALUE_TWO ? tempUVillageData : [])) : [];
        if (eocsSitePlanData.ld_area_type == VALUE_ONE) {
            eocsSitePlanData.village_text = villageData[eocsSitePlanData.ld_village_sc] ? villageData[eocsSitePlanData.ld_village_sc] : '';
            eocsSitePlanData.vsc_title = 'Sub City';
            eocsSitePlanData.spg_title = 'P.T. Sheet Number';
            eocsSitePlanData.scp_title = 'Chalta Number';
        } else if (eocsSitePlanData.ld_area_type == VALUE_TWO) {
            eocsSitePlanData.vsc_title = 'Village';
            eocsSitePlanData.spg_title = 'Gauthan Wise Number';
            eocsSitePlanData.scp_title = 'Plot Number';
            eocsSitePlanData.village_text = villageData[eocsSitePlanData.ld_village_sc] ? villageData[eocsSitePlanData.ld_village_sc]['village_name'] : '';
        }
        return eocsSitePlanData;
    },
    viewEocsSitePlan: function (moduleType, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FOUR && moduleType != VALUE_FIVE) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var eocsSitePlanData = parseData.eocs_site_plan_data;
        eocsSitePlanData.title = 'View';
        eocsSitePlanData.VALUE_THREE = VALUE_THREE;
        eocsSitePlanData = this.setBasicDetailsforView(eocsSitePlanData);
//        eocsSitePlanData.show_applicant_photo = eocsSitePlanData.applicant_photo != '' ? true : false;
        eocsSitePlanData.show_nakal = eocsSitePlanData.nakal != '' ? true : false;
        eocsSitePlanData.show_id_proof = eocsSitePlanData.id_proof != '' ? true : false;
        if (moduleType == VALUE_TWO) {
            eocsSitePlanData.show_print_btn = true;
        }
        if (moduleType == VALUE_THREE && eocsSitePlanData.is_verified != VALUE_ONE) {
            eocsSitePlanData.show_enter_remarks = true;
            eocsSitePlanData.show_verification_btn = true;
        }
        if (eocsSitePlanData.is_verified == VALUE_ONE && eocsSitePlanData.verified_details != '') {
            var verifiedDetails = JSON.parse(eocsSitePlanData.verified_details);
            eocsSitePlanData.show_verification_details = true;
            verifiedDetails.verified_datetime_text = verifiedDetails.verified_datetime ? dateTo_DD_MM_YYYY_HH_II_SS(verifiedDetails.verified_datetime) : '';
            eocsSitePlanData.n_verified_details = verifiedDetails;
        }
        if (moduleType == VALUE_FOUR && eocsSitePlanData.is_prepared != VALUE_ONE && eocsSitePlanData.plan_status == VALUE_TWO) {
            eocsSitePlanData.show_enter_remarks = true;
            eocsSitePlanData.show_prepare_btn = true;
        }
        if (eocsSitePlanData.is_prepared == VALUE_ONE && eocsSitePlanData.prepared_details != '') {
            var preparedDetails = JSON.parse(eocsSitePlanData.prepared_details);
            eocsSitePlanData.show_prepared_details = true;
            preparedDetails.prepared_datetime_text = preparedDetails.prepared_datetime ? dateTo_DD_MM_YYYY_HH_II_SS(preparedDetails.prepared_datetime) : '';
            eocsSitePlanData.n_prepared_details = preparedDetails;
        }
        if (moduleType == VALUE_FIVE && eocsSitePlanData.is_checked != VALUE_ONE && eocsSitePlanData.plan_status == VALUE_THREE) {
            eocsSitePlanData.show_enter_remarks = true;
            eocsSitePlanData.show_check_btn = true;
        }
        if (eocsSitePlanData.is_checked == VALUE_ONE && eocsSitePlanData.checked_details != '') {
            var checkedDetails = JSON.parse(eocsSitePlanData.checked_details);
            eocsSitePlanData.show_checked_details = true;
            checkedDetails.checked_datetime_text = checkedDetails.checked_datetime ? dateTo_DD_MM_YYYY_HH_II_SS(checkedDetails.checked_datetime) : '';
            eocsSitePlanData.n_checked_details = checkedDetails;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        eocsSitePlanData.EOCS_SITE_PLAN_DOC_PATH = EOCS_SITE_PLAN_DOC_PATH;
        $('#popup_container').html(eocsSitePlanViewTemplate(eocsSitePlanData));
        var ldCnt = 1;
        var totalCopies = 0;
        var totalAmount = 0;
        $.each(parseData.form_land_details, function (index, fld) {
            var psFormData = psFormArray[fld.property_status] ? psFormArray[fld.property_status] : [];
            var ldRow = '<tr><td class="text-center">' + ldCnt + '</td><td class="text-center">' + fld.survey + '</td>' + '<td class="text-center">' + fld.subdiv + '</td>'
                    + '<td class="text-center">' + (propertyStatusTextArray[fld.property_status] ? propertyStatusTextArray[fld.property_status] : '') + '</td>'
                    + '<td class="text-center">' + (fld.apply_with ? getCheckboxValue(fld.apply_with, psFormData) : '') + '</td>'
                    + '<td class="text-center">' + fld.total_area + '</td><td class="text-right">' + fld.copies + '</td><td class="text-right">' + fld.amount + '</td></tr>';
            $('#fld_container_for_espview').append(ldRow);
            totalCopies += parseInt(fld.copies) ? parseInt(fld.copies) : VALUE_ZERO;
            totalAmount += parseInt(fld.amount) ? parseInt(fld.amount) : VALUE_ZERO;
            ldCnt++;
        });
        $('#total_copies_for_espview').html(totalCopies);
        $('#total_amount_for_espview').html(totalAmount);
        if (moduleType == VALUE_TWO) {
            setTimeout(function () {
                $('#pa_btn_for_espview').click();
            }, 500);
        }
    },
    askForApproveRejectApplication: function (btnObj, eocsSitePlanId, moduleType) {
        if (!eocsSitePlanId) {
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
            url: 'eocs_site_plan/get_data_by_eocs_site_plan_id',
            type: 'post',
            data: $.extend({}, {'eocs_site_plan_id': eocsSitePlanId, 'module_type': moduleType}, getTokenData()),
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
                var eocsSitePlanData = parseData.eocs_site_plan_data;
                showPopup();
                if (moduleType == VALUE_ONE) {
                    $('#popup_container').html(eocsSitePlanApproveTemplate(eocsSitePlanData));
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(eocsSitePlanRejectTemplate(eocsSitePlanData));
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
        var formData = $('#approve_eocs_site_plan_form').serializeFormJSON();
        if (!formData.eocs_site_plan_id_for_eocs_site_plan_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_eocs_site_plan_approve) {
            $('#remarks_for_eocs_site_plan_approve').focus();
            validationMessageShow('eocs-site-plan-approve-remarks_for_eocs_site_plan_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_eocs_site_plan_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'eocs_site_plan/approve_application',
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
                validationMessageShow('eocs-site-plan-approve', textStatus.statusText);
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
                    validationMessageShow('eocs-site-plan-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                EocsSitePlan.listview.loadEocsSitePlanData();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_eocs_site_plan_form').serializeFormJSON();
        if (!formData.eocs_site_plan_id_for_eocs_site_plan_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_eocs_site_plan_reject) {
            $('#remarks_for_eocs_site_plan_reject').focus();
            validationMessageShow('eocs-site-plan-reject-remarks_for_eocs_site_plan_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_eocs_site_plan_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'eocs_site_plan/reject_application',
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
                validationMessageShow('eocs-site-plan-reject', textStatus.statusText);
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
                    validationMessageShow('eocs-site-plan-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                EocsSitePlan.listview.loadEocsSitePlanData();
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
            url: 'eocs_site_plan/request_for_upload_plan_copy',
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
                var eocsSitePlanData = that.setBasicDetailsforView(parseData.eocs_site_plan_data);
                eocsSitePlanData = that.basicPSData(eocsSitePlanData);
                $('#popup_container').html(eocsSitePlanUploadCopyTemplate(eocsSitePlanData));
            }
        });
    },
    basicPSData: function (psData) {
        if (psData.property_status) {
            var psFormData = psFormArray[psData.property_status] ? psFormArray[psData.property_status] : [];
            psData.property_status_text = (propertyStatusTextArray[psData.property_status] ? propertyStatusTextArray[psData.property_status] : '');
            psData.apply_with_text = (psData.apply_with ? getCheckboxValue(psData.apply_with, psFormData) : '');
        }
        return psData;
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
        var pcMessage = fileUploadValidationForPDF('plan_copy_for_espuc', 5120);
        if (pcMessage != '') {
            $('#plan_copy_for_espuc').focus();
            validationMessageShow('espuc-plan_copy_for_espuc', pcMessage);
            return false;
        }
        var that = this;
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var newFormData = new FormData($('#espuc_form')[0]);
        newFormData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        newFormData.append("form_land_details_id", formLandDetailsId);
        $.ajax({
            url: 'eocs_site_plan/request_for_generate_copy',
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
                var espData = parseData.eocs_site_plan_data;
                if (espData.plan_status == VALUE_TWO) {
                    EocsSitePlan.listview.listPage();
                } else {
                    $('#ssca_details_container_for_esplist_' + espData.eocs_site_plan_id).parent().html(that.getSSCADetails(espData));
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
        var pcMessage = fileUploadValidationForPDF('plan_copy_for_espruc', 5120);
        if (pcMessage != '') {
            $('#plan_copy_for_espruc').focus();
            validationMessageShow('espruc-plan_copy_for_espruc', pcMessage);
            return false;
        }
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var newFormData = new FormData($('#espruc_form')[0]);
        newFormData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        newFormData.append("form_land_details_id", formLandDetailsId);
        $.ajax({
            url: 'eocs_site_plan/request_for_regenerate_copy',
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
            url: 'eocs_site_plan/request_for_view_copy',
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
        var espldData = this.setBasicDetailsforView(parseData.espld_data);
        espldData = this.basicPSData(espldData);
        if (espldData.status == VALUE_FOUR && (espldData.plan_status == VALUE_ONE || espldData.plan_status == VALUE_TWO)) {
//            espldData.show_regenerate_copy_details = true;
            if (espldData.copies == espldData.total_fd_copy_generated) {
                espldData.show_regenerate_fd_details = true;
                espldData.show_regenerate_fdb_details = true;
            }
            if (espldData.copies == espldData.total_fb_copy_generated) {
                espldData.show_regenerate_fb_details = true;
                espldData.show_regenerate_fdb_details = true;
            }
        }
        $('#popup_container').html(eocsSitePlanCopyDetailsTemplate(espldData));
        $.each(parseData.copy_details, function (index, cd) {
            cd.temp_cnt = (index + 1);
            cd.barcode_number = VALUE_TWENTYTHREE + ('0000000' + cd.form_copy_id).slice(-7);
            cd.generated_datetime_text = cd.created_time != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(cd.created_time) : '';
            cd.form_type_text = formTypeArray[cd.form_type] ? formTypeArray[cd.form_type] : '';
            $('#cd_container_for_espcd').append(eocsSitePlanCopyDetailsItemTemplate(cd));
        });
    },
    getQueryData: function (eocsSitePlanId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!eocsSitePlanId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var templateData = {};
        templateData.module_type = VALUE_TWENTYTHREE;
        templateData.module_id = eocsSitePlanId;
        var btnObj = $('#query_btn_for_app_' + eocsSitePlanId);
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
                tmpData.module_type = VALUE_TWENTYTHREE;
                tmpData.module_id = eocsSitePlanId;
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
        var espId = $('#eocs_site_plan_id_for_espview').val();
        if (!espId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var remarks = $('#remarks_for_espview').val();
        if (!remarks) {
            $('#remarks_for_espview').focus();
            validationMessageShow('espview-remarks_for_espview', remarksValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'eocs_site_plan/update_status_for_esp',
            type: 'post',
            data: $.extend({}, {'esp_id': espId, 'remarks': remarks, 'module_type': moduleType}, getTokenData()),
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
                EocsSitePlan.listview.listPage();
            }
        });
    },
    requestForGenerateFormDB: function (btnObj, formLandDetailsId, formType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId || (formType != VALUE_ONE && formType != VALUE_TWO)) {
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
            url: 'eocs_site_plan/request_for_generate_form_db',
            type: 'post',
            data: $.extend({}, {'form_land_details_id': formLandDetailsId, 'form_type': formType}, getTokenData()),
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
                var espData = parseData.eocs_site_plan_data;
                if (espData.plan_status == VALUE_TWO) {
                    EocsSitePlan.listview.listPage();
                } else {
                    $('#ssca_details_container_for_esplist_' + espData.eocs_site_plan_id).parent().html(that.getSSCADetails(espData));
                }
                showSuccess(parseData.message);
            }
        });
    },
    requestForReGenerateFormDB: function (btnObj, formLandDetailsId, formType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId || (formType != VALUE_ONE && formType != VALUE_TWO)) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'eocs_site_plan/request_for_regenerate_form_db',
            type: 'post',
            data: $.extend({}, {'form_land_details_id': formLandDetailsId, 'form_type': formType}, getTokenData()),
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
                showSuccess(parseData.message);
            }
        });
    },
});
