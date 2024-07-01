var naApplicationListTemplate = Handlebars.compile($('#na_application_list_template').html());
var naApplicationTableTemplate = Handlebars.compile($('#na_application_table_template').html());
var naApplicationActionTemplate = Handlebars.compile($('#na_application_action_template').html());
var naApplicationViewTemplate = Handlebars.compile($('#na_application_view_template').html());
var naApplicationLDViewTemplate = Handlebars.compile($('#na_application_ld_view_template').html());
var tempApplicantCnt = 1;
var tempLDCnt = 1;
var NaApplication = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
NaApplication.Router = Backbone.Router.extend({
    routes: {
        'na_application': 'renderList',
        'na_application_form': 'renderList',
    },
    renderList: function () {
        NaApplication.listview.listPage();
    },
});
NaApplication.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_collector');
        addClass('coll_na_application', 'active');
        NaApplication.router.navigate('na_application');
        var templateData = {};
        this.$el.html(naApplicationListTemplate(templateData));
        this.loadNaData();

    },
    actionRenderer: function (rowData) {
        return naApplicationActionTemplate(rowData);
    },
    loadNaData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        var appNameRenderer = function (data, type, full, meta) {
            var tempName = '';
            if (full.applicant_info != '') {
                var appInfo = JSON.parse(full.applicant_info);
                $.each(appInfo, function (index, sAppInfo) {
                    if (index != VALUE_ZERO) {
                        tempName += ', ';
                    }
                    tempName += sAppInfo['name'];
                });
            }
            return tempName;
        };
        var VSSRenderer = function (data, type, full, meta) {
            var tempLd = '';
            var villageName = '';
            $.each(data, function (index, ld) {
                if (index != VALUE_ZERO) {
                    tempLd += '<hr>';
                }
                villageName = tempVillageData[ld.village] ? tempVillageData[ld.village]['village_name'] : '';
                if (villageName) {
                    tempLd += (index + 1) + ') ' + villageName + ' / ' + ld.survey + ' / ' + ld.subdiv + ' / ' + ld.total_area + '(' + ld.area + ')';
                }
            });
            return tempLd;
        };
        NaApplication.router.navigate('na_application');
        $('#na_application_form_and_datatable_container').html(naApplicationTableTemplate);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_na_list', false);
        if (tempTypeInSession == TEMP_TYPE_A) {
            renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_na_list', false);
            $("#district_for_na_list option[value='" + VALUE_TWO + "']").remove();
            $("#district_for_na_list option[value='" + VALUE_THREE + "']").remove();
            naApplicationDataTable = $('#na_application_datatable').DataTable({
                ajax: {url: 'na_application/get_na_application_data', dataSrc: "na_application_data", type: "post"},
                bAutoWidth: false,
                ordering: false,
                processing: true,
                language: dataTableProcessingAndNoDataMsg,
                serverSide: true,
                columns: [
                    {data: '', 'render': serialNumberRenderer, 'class': 'v-a-m text-center'},
                    {data: 'application_number', 'class': 'v-a-m text-center f-w-b'},
                    {data: 'submitted_datetime', 'class': 'v-a-m text-center', 'render': dateTimeRenderer},
                    {data: 'district', 'class': 'v-a-m text-center', 'render': districtRenderer},
                    {data: '', 'class': 'v-a-m', 'render': appNameRenderer},
                    {data: 'land_details', 'class': 'v-a-m', 'render': VSSRenderer},
                    {data: 'na_application_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                    {data: 'na_application_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                    {'class': 'v-a-m details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
                ],
                "initComplete": searchableDatatable
            });
        } else if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            naApplicationDataTable = $('#na_application_datatable').DataTable({
                ajax: {url: 'na_application/get_na_application_data', dataSrc: "na_application_data", type: "post"},
                bAutoWidth: false,
                ordering: false,
                processing: true,
                language: dataTableProcessingAndNoDataMsg,
                serverSide: true,
                columns: [
                    {data: '', 'render': serialNumberRenderer, 'class': 'v-a-m text-center'},
                    {data: 'application_number', 'class': 'v-a-m text-center f-w-b'},
                    {data: 'submitted_datetime', 'class': 'v-a-m text-center', 'render': dateTimeRenderer},
                    {data: '', 'class': 'v-a-m', 'render': appNameRenderer},
                    {data: 'land_details', 'class': 'v-a-m', 'render': VSSRenderer},
                    {data: 'na_application_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                    {data: 'na_application_id', 'class': 'v-a-m text-center', 'render': newAppStatusRenderer},
                    {'class': 'v-a-m details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
                ],
                "initComplete": searchableDatatable
            });
        }
        $('#na_application_datatable_filter').remove();
        $('#na_application_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = naApplicationDataTable.row(tr);

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
    editOrViewNaApplication: function (btnObj, naId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!naId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'na_application/get_na_data_by_id',
            type: 'post',
            data: $.extend({}, {'na_application_id': naId, 'is_edit': isEdit ? VALUE_ONE : VALUE_TWO}, getTokenData()),
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
                if (isEdit) {
                } else {
                    that.viewNaForm(parseData);
                }
            }
        });
    },
    viewNaForm: function (parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var naData = parseData.na_data;
        naData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        naData.NA_APPLICATION_DOC_PATH = NA_APPLICATION_DOC_PATH;
        naData.title = 'View';
        naData.district_text = talukaArray[naData.district] ? talukaArray[naData.district] : '';
        naData.show_certified_copy = naData.certified_copy != '' ? true : false;
        naData.show_sketch_layout = naData.sketch_layout != '' ? true : false;
        naData.show_written_consent = naData.written_consent != '' ? true : false;
        naData.show_other_documents = naData.other_documents != '' ? true : false;
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(naApplicationViewTemplate(naData));
        if (naData.applicant_info != '') {
            var applicantInfo = JSON.parse(naData.applicant_info);
            $.each(applicantInfo, function (index, aiData) {
                var aiHtml = '<tr><td class="text-center">' + (index + 1) + '</td><td>' + aiData.name + '</td><td>' +
                        aiData.occupation + '</td><td>' + aiData.address + '</td></tr>';
                $('#applicant_info_container_for_na_view').append(aiHtml);
            });
        }
        $.each(parseData.na_ld_data, function (index, ldData) {
            ldData.serial_number = (index + 1);
            ldData.village_name = tempVillageData[ldData.village] ? tempVillageData[ldData.village]['village_name'] : '';
            ldData.site_proposed_text = siteProposedArray[ldData.site_proposed] ? siteProposedArray[ldData.site_proposed] : '';
            ldData.occupant_type_text = occupantTypeArray[ldData.occupant_type] ? occupantTypeArray[ldData.occupant_type] : '';
            ldData.is_eht_text = yesNoArray[ldData.is_eht] ? yesNoArray[ldData.is_eht] : '';
            ldData.is_land_acquisition_text = yesNoArray[ldData.is_land_acquisition] ? yesNoArray[ldData.is_land_acquisition] : '';
            ldData.is_road_avail_text = yesNoArray[ldData.is_road_avail] ? yesNoArray[ldData.is_road_avail] : '';
            ldData.is_can_access_site_text = yesNoArray[ldData.is_can_access_site] ? yesNoArray[ldData.is_can_access_site] : '';
            $('#land_details_container_for_na_view').append(naApplicationLDViewTemplate(ldData));
        });
        if (naData.declaration == VALUE_ONE) {
            $('#declaration_for_na_view').click();
        }
    },
    getQueryData: function (naApplicationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!naApplicationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_EIGHT;
        templateData.module_id = naApplicationId;
        var btnObj = $('#query_btn_for_app_' + naApplicationId);
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
                tmpData.applicant_name = moduleData.applicant_names;
                tmpData.title = 'Name of Applicant';
                tmpData.module_type = VALUE_EIGHT;
                tmpData.module_id = naApplicationId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
});
