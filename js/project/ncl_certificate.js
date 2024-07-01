var nclCertificateListTemplate = Handlebars.compile($('#ncl_certificate_list_template').html());
var nclCertificateSearchTemplate = Handlebars.compile($('#ncl_certificate_search_template').html());
var nclCertificateTableTemplate = Handlebars.compile($('#ncl_certificate_table_template').html());
var nclCertificateActionTemplate = Handlebars.compile($('#ncl_certificate_action_template').html());
var nclCertificateViewTemplate = Handlebars.compile($('#ncl_certificate_view_template').html());
var nclCertificateApproveTemplate = Handlebars.compile($('#ncl_certificate_approve_template').html());
var nclCertificateRejectTemplate = Handlebars.compile($('#ncl_certificate_reject_template').html());
var nclCertificateAppointmentTemplate = Handlebars.compile($('#ncl_certificate_set_appointment_template').html());
var nclCertificateBasicDetailTemplate = Handlebars.compile($('#ncl_certificate_update_basic_detail_template').html());

var typeMajorNclCertificateFormTemplate = Handlebars.compile($('#type_mjor_ncl_certificate_form_template').html());
var typeMinorNclCertificateFormTemplate = Handlebars.compile($('#type_minor_ncl_certificate_form_template').html());
var nclCertificateFieldVerificationDocItemTemplate = Handlebars.compile($('#ncl_certificate_field_verification_document_template').html());
var nclCertificateFieldVerificationViewDocItemTemplate = Handlebars.compile($('#ncl_certificate_field_verification_view_document_template').html());

var tempVillageDataForNCL = [];
var tempMemberCnt = 1;
var tempACIData = [];
var tempMamData = [];
var searchNCF = {};

var NclCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
NclCertificate.Router = Backbone.Router.extend({
    routes: {
        'ncl_certificate': 'renderList',
        'ncl_certificate_form': 'renderListForForm',
        'edit_ncl_certificate_form': 'renderList',
        'view_ncl_certificate_form': 'renderList',
        'type_mjor_ncl_certificate_form': 'renderListForTypeOne',
        'edit_type_mjor_ncl_certificate_form': 'renderList',
        'type_minor_ncl_certificate_form': 'renderListForTypeTwoA',
        'edit_type_minor_ncl_certificate_form': 'renderList',

    },
    renderList: function () {
        NclCertificate.listview.listPage();
    },
    renderListForForm: function () {
        NclCertificate.listview.listPageNclCertificateForm();
    },
    renderListForTypeOne: function () {
        NclCertificate.listview.listPageTypeMajorNclCertificateForm();
    },
    renderListForTypeTwoA: function () {
        NclCertificate.listview.listPageTypeMinorNclCertificateForm();
    },

});
NclCertificate.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="marital_status_for_nc"]': 'getYearlyIncomeTotalofAll',
    },
    listPage: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER &&
                tempTypeInSession != TEMP_TYPE_LDC_USER && tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_certificates');
        addClass('menu_ncl_certificate', 'active');
        NclCertificate.router.navigate('ncl_certificate');
        var templateData = {};
        searchNCF = {};
        this.$el.html(nclCertificateListTemplate(templateData));
        this.loadNclCertificateData(sDistrict, sType);

    },
    listPageTypeMajorNclCertificateForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER &&
                tempTypeInSession != TEMP_TYPE_LDC_USER && tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_certificates');
        addClass('menu_ncl_certificate', 'active');
        this.$el.html(nclCertificateListTemplate);
        this.typeMajorNclCertificateForm(false, {});
    },
    listPageTypeMinorNclCertificateForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER &&
                tempTypeInSession != TEMP_TYPE_LDC_USER && tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_certificates');
        addClass('menu_ncl_certificate', 'active');
        this.$el.html(nclCertificateListTemplate);
        this.typeMinorNclCertificateForm(false, {});
    },

    actionRenderer: function (rowData) {
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) && rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX) {
            rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_form_one_btn = true;
        }
        rowData.status = parseInt(rowData.status);
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER ||
                tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_TALATHI_USER) &&
                rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX &&
                (rowData.query_status == VALUE_ZERO || rowData.query_status == VALUE_THREE)) {
            rowData.show_reject_btn = '';
        } else {
            rowData.show_reject_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) &&
                (rowData.status == VALUE_TWO || rowData.status == VALUE_THREE) && (rowData.query_status == VALUE_ZERO ||
                rowData.query_status == VALUE_THREE)) {
//            if (rowData.appointment_status == VALUE_ZERO) {
//                rowData.show_approve_btn = 'display: none;';
//            } else {
            rowData.show_approve_btn = '';
//            }
        } else {
            rowData.show_approve_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) &&
                (rowData.status == VALUE_TWO || rowData.status == VALUE_THREE || rowData.status == VALUE_FIVE ||
                        rowData.status == VALUE_SIX) && (rowData.query_status == VALUE_ZERO ||
                rowData.query_status == VALUE_THREE)) {
//            if (rowData.appointment_status == VALUE_ZERO || rowData.aci_rec != VALUE_TWO) {
            if (rowData.aci_rec != VALUE_TWO) {
                rowData.show_reverification_btn = 'display: none;';
            } else {
                rowData.show_reverification_btn = '';
            }
        } else {
            rowData.show_reverification_btn = 'display: none;';
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.download_certificate_style = '';
        } else {
            rowData.download_certificate_style = 'display: none;';
        }
        rowData.download_verify_certificate_style = 'display: none;';
        if (rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX) {
            rowData.download_verify_certificate_style = '';
        }
        rowData.show_forward_btn = true;
        if (rowData.appointment_date != '0000-00-00') {
            var d1 = (dateTo_DD_MM_YYYY(rowData.appointment_date)).split("-");
            var d2 = (dateTo_DD_MM_YYYY()).split("-");
            d1 = d1[2].concat(d1[1], d1[0]);
            d2 = d2[2].concat(d2[1], d2[0]);
            if (parseInt(d2) >= parseInt(d1)) {
                rowData.show_forward_btn = true;
            }
        }
        rowData.show_movement_btn = 'display: none;';
        if (rowData.status == VALUE_FIVE || rowData.status == VALUE_SIX) {
            rowData.show_reverification_btn = 'display: none;';
            rowData.show_forward_btn = false;
            rowData.show_movement_btn = '';
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_pa_btn = true;
        }
        return nclCertificateActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        var onlineStatement = appointmentData.online_statement == VALUE_ONE ? 'Online Statement' : '';
        var visitOffice = appointmentData.visit_office == VALUE_ONE ? 'Visit Office' : '';
        if (appointmentData.appointment_date == '0000-00-00') {
            return '<span id="appointment_container_' + appointmentData.ncl_certificate_id + '" class="badge bg-warning app-status">Appointment Not Scheduled By Talathi</span>';
        }
        var returnString = '<span id="appointment_container_' + appointmentData.ncl_certificate_id + '"><span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">' + onlineStatement;
        if (onlineStatement != '' && visitOffice != '') {
            returnString += ',<br>';
        }
        returnString += (visitOffice + '</span>');
        return returnString;
    },
    loadNclCertificateData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        NclCertificate.router.navigate('ncl_certificate');
        var searchData = dtomMam(sDistrict, sType, 'NclCertificate.listview.loadNclCertificateData();');
        $('#ncl_certificate_form_and_datatable_container').html(nclCertificateSearchTemplate(searchData));
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            renderOptionsForTwoDimensionalArray(appointmentFilterArray, 'appointment_status_for_ncl_certificate_list', false);
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(currentlyOnTypeArray, 'currently_on_for_ncl_certificate_list', false);
        }

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_ncl_certificate_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_ncl_certificate_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_ncl_certificate_list', false);
        datePickerId('application_date_for_ncl_certificate_list');

        if (tempTypeInSession != TEMP_TYPE_A) {
            var dwVillagesData = (tempDistrictInSession == VALUE_ONE ? damanVillagesArray : (tempDistrictInSession == VALUE_TWO ? diuVillagesArray : (tempDistrictInSession == VALUE_THREE ? dnhVillagesArray : [])));
            if (tempAVInSession != '') {
                var avData = tempAVInSession.split(',');
                renderOptionsForAVArray(avData, dwVillagesData, 'vdw_for_ncl_certificate_list', false);
            } else {
                renderOptionsForTwoDimensionalArray(dwVillagesData, 'vdw_for_ncl_certificate_list', false);
            }
        } else {
            if (typeof searchNCF.district_for_ncl_certificate_list != "undefined" && searchNCF.district_for_ncl_certificate_list != '' && searchNCF.village_for_ncl_certificate_list != '') {
                var villageData = (searchNCF.district_for_ncl_certificate_list == VALUE_ONE ? damanVillagesArray : (searchNCF.district_for_ncl_certificate_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_ncl_certificate_list', false);
            }
        }

        $('#app_no_for_ncl_certificate_list').val((typeof searchNCF.app_no_for_ncl_certificate_list != "undefined" && searchNCF.app_no_for_ncl_certificate_list != '') ? searchNCF.app_no_for_ncl_certificate_list : '');
        $('#application_date_for_ncl_certificate_list').val((typeof searchNCF.application_date_for_ncl_certificate_list != "undefined" && searchNCF.application_date_for_ncl_certificate_list != '') ? searchNCF.application_date_for_ncl_certificate_list : searchData.s_appd);
        $('#app_details_for_ncl_certificate_list').val((typeof searchNCF.app_details_for_ncl_certificate_list != "undefined" && searchNCF.app_details_for_ncl_certificate_list != '') ? searchNCF.app_details_for_ncl_certificate_list : '');
        $('#appointment_status_for_ncl_certificate_list').val((typeof searchNCF.appointment_status_for_ncl_certificate_list != "undefined" && searchNCF.appointment_status_for_ncl_certificate_list != '') ? searchNCF.appointment_status_for_ncl_certificate_list : searchData.s_app_status);
        $('#query_status_for_ncl_certificate_list').val((typeof searchNCF.query_status_for_ncl_certificate_list != "undefined" && searchNCF.query_status_for_ncl_certificate_list != '') ? searchNCF.query_status_for_ncl_certificate_list : searchData.s_qstatus);
        $('#status_for_ncl_certificate_list').val((typeof searchNCF.status_for_ncl_certificate_list != "undefined" && searchNCF.status_for_ncl_certificate_list != '') ? searchNCF.status_for_ncl_certificate_list : searchData.s_status);
        $('#currently_on_for_ncl_certificate_list').val((typeof searchNCF.currently_on_for_ncl_certificate_list != "undefined" && searchNCF.currently_on_for_ncl_certificate_list != '') ? searchNCF.currently_on_for_ncl_certificate_list : searchData.s_co_hand);
        $('#district_for_ncl_certificate_list').val((typeof searchNCF.district_for_ncl_certificate_list != "undefined" && searchNCF.district_for_ncl_certificate_list != '') ? searchNCF.district_for_ncl_certificate_list : searchData.search_district);
        $('#vdw_for_ncl_certificate_list').val((typeof searchNCF.vdw_for_ncl_certificate_list != "undefined" && searchNCF.vdw_for_ncl_certificate_list != '') ? searchNCF.vdw_for_ncl_certificate_list : '');
        $('#is_full_for_ncl_certificate_list').val((typeof searchNCF.is_full_for_ncl_certificate_list != "undefined" && searchNCF.is_full_for_ncl_certificate_list != '') ? searchNCF.is_full_for_ncl_certificate_list : searchData.s_is_full);

        this.searchNclCertificateData();
    },
    searchNclCertificateData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#ncl_certificate_datatable_container').html(nclCertificateTableTemplate);
        var searchData = $('#search_ncl_certificate_form').serializeFormJSON();

        searchNCF = searchData;
        if (typeof btnObj == "undefined" && (searchNCF.app_details_for_ncl_certificate_list == ''
                && searchNCF.app_no_for_ncl_certificate_list == ''
                && searchNCF.application_date_for_ncl_certificate_list == ''
                && searchNCF.appointment_status_for_ncl_certificate_list == ''
                && searchNCF.query_status_for_ncl_certificate_list == ''
                && searchNCF.status_for_ncl_certificate_list == ''
                && searchNCF.is_full_for_ncl_certificate_list == ''
                && (searchNCF.district_for_ncl_certificate_list == '' || typeof searchNCF.district_for_ncl_certificate_list == "undefined")
                && (searchNCF.vdw_for_ncl_certificate_list == '' || typeof searchNCF.vdw_for_ncl_certificate_list == "undefined")
                && (searchNCF.currently_on_for_ncl_certificate_list == '' || typeof searchNCF.currently_on_for_ncl_certificate_list == "undefined"))) {
            nclCertificateDataTable = $('#ncl_certificate_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#ncl_certificate_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.com_addr_house_no + ', ' + (full.com_addr_house_name == '' ? '' : full.com_addr_house_name + ',') + full.com_addr_street + ', ' + full.com_addr_village_dmc_ward + ', ' + (damanCityArray[full.com_addr_city] == undefined ? full.com_addr_city : damanCityArray[full.com_addr_city]) + ', ' + (full.com_pincode == '0' ? full.pincode : full.com_pincode) + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + (full.mobile_number == '' ? full.guardian_mobile_no : full.mobile_number) + '</b>';
        };

        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? damanVillagesArray : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village_name] ? villageData[full.village_name] : '');
        };
        var appointmentRenderer = function (data, type, full, meta) {
            return '<div id="appointment_container_' + data + '">' + that.getAppointmentData(full) + '</div>';
        };
        var movementRenderer = function (data, type, full, meta) {
            return '<div id="movement_for_ic_list_' + data + '">' + movementString(full) + '</div>';
        };
        $('#ncl_certificate_datatable_container').html(nclCertificateTableTemplate);
        nclCertificateDataTable = $('#ncl_certificate_datatable').DataTable({
            ajax: {
                url: 'ncl_certificate/get_ncl_certificate_data',
                dataSrc: "ncl_certificate_data",
                type: "post", data: searchData
            },
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: '', 'class': '', 'render': appNumberWithRegiUserRenderer},
                {data: '', 'class': 'f-s-app-details', 'render': appDetailsRenderer},
                {data: 'district', 'class': 'text-center f-s-app-details', 'render': distVillRenderer},
                {data: 'ncl_certificate_id', 'class': 'v-a-t text-center', 'render': appointmentRenderer},
                {data: 'ncl_certificate_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'ncl_certificate_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'ncl_certificate_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "fnRowCallback": aciNR,
            "initComplete": searchableDatatable
        });
        $('#ncl_certificate_datatable_filter').remove();
        $('#ncl_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = nclCertificateDataTable.row(tr);

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
    getYearlyIncomeTotalofFather: function () {
        var totalIncome = 0;

        var cnt1 = parseFloat($('#father_annual_salary_for_nc').val()) ? parseFloat($('#father_annual_salary_for_nc').val()) : 0;
        var cnt2 = parseFloat($('#father_other_income_sources_for_nc').val()) ? parseFloat($('#father_other_income_sources_for_nc').val()) : 0;
        totalIncome = cnt1 + cnt2;

        $('#father_total_for_nc').val(totalIncome);
    },
    getYearlyIncomeTotalofMother: function () {
        var totalIncome = 0;

        var cnt1 = parseFloat($('#mother_annual_salary_for_nc').val()) ? parseFloat($('#mother_annual_salary_for_nc').val()) : 0;
        var cnt2 = parseFloat($('#mother_other_income_sources_for_nc').val()) ? parseFloat($('#mother_other_income_sources_for_nc').val()) : 0;
        totalIncome = cnt1 + cnt2;

        $('#mother_total_for_nc').val(totalIncome);
    },

    getYearlyIncomeTotalofSpouse: function () {
        var totalIncome = 0;

        var cnt1 = parseFloat($('#spouse_annual_salary_for_nc').val()) ? parseFloat($('#spouse_annual_salary_for_nc').val()) : 0;
        var cnt2 = parseFloat($('#spouse_other_income_sources_for_nc').val()) ? parseFloat($('#spouse_other_income_sources_for_nc').val()) : 0;
        totalIncome = cnt1 + cnt2;

        $('#spouse_total_for_nc').val(totalIncome);
    },
    getYearlyIncomeTotalofAll: function () {
        var totalIncome = 0;

        var cnt1 = parseFloat($('#father_total_for_nc').val()) ? parseFloat($('#father_total_for_nc').val()) : 0;
        var cnt2 = parseFloat($('#mother_total_for_nc').val()) ? parseFloat($('#mother_total_for_nc').val()) : 0;
        var cnt3 = parseFloat($('#spouse_total_for_nc').val()) ? parseFloat($('#spouse_total_for_nc').val()) : 0;
        var ms = $("input[name='marital_status_for_nc']:checked").val();
        if (ms == VALUE_ONE) {
            totalIncome = cnt1 + cnt2 + cnt3;
        } else {
            totalIncome = cnt1 + cnt2;
        }
        $('#family_annual_income_for_nc').val(totalIncome);
    },
    typeMajorNclCertificateForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.ncl_certificate_data;
            NclCertificate.router.navigate('edit_type_mjor_ncl_certificate_form');
        } else {
            var formData = {};
            NclCertificate.router.navigate('type_mjor_ncl_certificate_form');
        }

        tempVillageDataForNCL = [];
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_FIVE = VALUE_FIVE;
        templateData.VALUE_SIX = VALUE_SIX;
        templateData.VALUE_SEVEN = VALUE_SEVEN;
        templateData.VALUE_EIGHT = VALUE_EIGHT;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.ncl_certificate_data = parseData.ncl_certificate_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);

        if (isEdit) {
            templateData.obc_certificate_date = dateTo_DD_MM_YYYY(formData.obc_certificate_date);
            templateData.income_certificate_date = dateTo_DD_MM_YYYY(formData.income_certificate_date);
        }

        $('#ncl_certificate_form_and_datatable_container').html(typeMajorNclCertificateFormTemplate(templateData));
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district');

        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_nc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_nc');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        generateBoxes('radio', genderArray, 'gender', 'nc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'nc', formData.marital_status, false, false);
        showSubContainer('marital_status', 'nc', '.spouse_info_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'tax_payer', 'ncl_certificate', formData.tax_payer, false, false);
        showSubContainer('tax_payer', 'ncl_certificate', '.tax_payer_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'wealth_tax', 'ncl_certificate', formData.wealth_tax, false, false);
        showSubContainer('wealth_tax', 'ncl_certificate', '.wealth_tax_item', VALUE_ONE, 'radio');

        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_nc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_nc');
        renderOptionsForTwoDimensionalArray(parentProfessionArray, 'father_occupation_for_nc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_nc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_nc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_nc');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_nc');
        renderOptionsForTwoDimensionalArray(religionArray, 'religion_for_nc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'obccaste_for_nc');


        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'commu_add_state_for_nc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'per_add_state_for_nc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_nc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'native_place_state_for_nc');

        if (isEdit) {
            $('#commu_add_state_for_nc').val(formData.commu_add_state == 0 ? '' : formData.commu_add_state);

            var districtData = tempDistrictData[formData.commu_add_state] ? tempDistrictData[formData.commu_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'commu_add_district_for_nc', 'district_code', 'district_name', 'District');
            $('#commu_add_district_for_nc').val(formData.commu_add_district == 0 ? '' : formData.commu_add_district);

            //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.commu_add_village_data, 'commu_add_village_for_nc', 'village_code', 'village_name', 'Village');
            that.getEditVillageData(formData.commu_add_state, formData.commu_add_district, 'nc', formData.commu_add_village, 'Village');
            $('#commu_add_village_for_nc').val(formData.commu_add_village);

            $('#per_add_state_for_nc').val(formData.per_add_state == 0 ? '' : formData.per_add_state);

            var districtData = tempDistrictData[formData.per_add_state] ? tempDistrictData[formData.per_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_add_district_for_nc', 'district_code', 'district_name', 'District');
            $('#per_add_district_for_nc').val(formData.per_add_district == 0 ? '' : formData.per_add_district);

            tempVillageDataForNCL = formData.per_add_village_data;
            //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.per_add_village_data, 'per_add_village_for_nc', 'village_code', 'village_name', 'Village');
            that.getEditVillageData(formData.per_add_state, formData.per_add_district, 'nc', formData.per_add_village, 'Village');
            $('#per_add_village_for_nc').val(formData.per_add_village);

            $('#born_place_state_for_nc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);

            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_nc', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_nc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);

            //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.born_place_village_data, 'born_place_village_for_nc', 'village_code', 'village_name', 'Village');
            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'nc', formData.born_place_village, 'born_place');
            $('#born_place_village_for_nc').val(formData.born_place_village);

            $('#native_place_state_for_nc').val(formData.native_place_state == 0 ? '' : formData.native_place_state);

            var native_state = formData.native_place_state;
            var districtData = isEdit ? (native_state == VALUE_ONE ? damandiudistrictArray : (native_state == VALUE_TWO ? dnhdistrictArray : [])) : [];
            renderOptionsForTwoDimensionalArray(districtData, 'native_place_district_for_nc');
            $('#native_place_district_for_nc').val(formData.native_place_district == 0 ? '' : formData.native_place_district);

            var native_district = formData.native_place_district;
            var villageDataForNative = isEdit ? (native_district == VALUE_ONE ? damanVillageForNativeArray : (native_district == VALUE_TWO ? diuVillagesForNativeArray : (native_district == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
            renderOptionsForTwoDimensionalArray(villageDataForNative, 'native_place_village_for_nc');
            $('#native_place_village_for_nc').val(formData.native_place_village == 0 ? '' : formData.native_place_village);

            $('#com_addr_city_for_nc').val(formData.com_addr_city);
            $('#per_addr_city_for_nc').val(formData.per_addr_city);
            $('#village_name_for_nc').val(formData.village_name);
            $('#district').val(formData.district);
            // $('#com_addr_city_for_nc').val(formData.com_addr_city);
            $('#select_required_purpose_for_nc').val(formData.select_required_purpose);
            // $('#village_name_for_nc').val(formData.village_name);
            $('#applicant_education_for_nc').val(formData.applicant_education);

            if (formData.billingtoo == isChecked) {
                $('#billingtoo_for_nc').attr('checked', 'checked');
            }

            if (formData.marital_status == VALUE_ONE)
                $('.spouse_info_div').collapse().show();
            $('.part_a_div').collapse().show();
            $('.part_g_div').collapse().show();


            $('#declaration_for_ncl_cerfificate').attr('checked', 'checked');
            $('#declaration').attr('checked', 'checked');
            $('#occupation_for_nc').val(formData.occupation);
            $('#religion_for_nc').val(formData.religion);
            $('#nearest_police_station_for_nc').val(formData.nearest_police_station);
            $('#obccaste_for_nc').val(formData.obccaste);
            // $('#father_caste_for_nc').val(formData.father_caste);
            // $('#mother_caste_for_nc').val(formData.mother_caste);
            // $('#grandfather_caste_for_nc').val(formData.grandfather_caste);
            // $('#spouse_caste_for_nc').val(formData.spouse_caste);
            $('#father_occupation_for_nc').val(formData.father_occupation);
            $('#mother_occupation_for_nc').val(formData.mother_occupation);
            $('#spouse_occupation_for_nc').val(formData.spouse_occupation);


            that.getYearlyIncomeTotalofFather();
            that.getYearlyIncomeTotalofMother();
            that.getYearlyIncomeTotalofSpouse();
            that.getYearlyIncomeTotalofAll();

            if (formData.occupation == VALUE_TWELVE) {
                $('#applicant_occupation_other_div_for_ncl_certificate').show();
            } else {
                $('#applicant_occupation_other_div_for_ncl_certificate').hide();
            }
            if (formData.religion == VALUE_FIVE) {
                $('#other_religion_for_ncl_certificate').show();
            } else {
                $('#other_religion_for_ncl_certificate').hide();
            }
            $('#district').val(formData.district)

            if (formData.father_other_occupation) {
                $('#father_other_occupation_text_for_nc').show();
            }
            if (formData.mother_other_occupation) {
                $('#mother_other_occupation_text_for_nc').show();
            }
            if (formData.spouse_other_occupation) {
                $('#spouse_other_occupation_text_for_nc').show();
            }


            var val = formData.constitution_artical;

            if (formData.tax_payer_copy != '') {
                that.showDocument('tax_payer_copy_container_for_ncl_certificate', 'tax_payer_copy_name_image_for_ncl_certificate', 'tax_payer_copy_name_container_for_ncl_certificate',
                        'tax_payer_copy_download', 'tax_payer_copy', formData.tax_payer_copy, formData.ncl_certificate_id, VALUE_ONE);
            }

            if (formData.self_birth_certificate_doc != '') {
                that.showDocument('self_birth_certificate_doc_container_for_ncl_certificate', 'self_birth_certificate_doc_name_image_for_ncl_certificate', 'self_birth_certificate_doc_name_container_for_ncl_certificate',
                        'self_birth_certificate_doc_download', 'self_birth_certificate_doc', formData.self_birth_certificate_doc, formData.ncl_certificate_id, VALUE_TWO);
            }


            if (formData.leaving_certificate_doc != '') {
                that.showDocument('leaving_certificate_doc_container_for_ncl_certificate', 'leaving_certificate_doc_name_image_for_ncl_certificate', 'leaving_certificate_doc_name_container_for_ncl_certificate',
                        'leaving_certificate_doc_download', 'leaving_certificate_doc', formData.leaving_certificate_doc, formData.ncl_certificate_id, VALUE_THREE);
            }


            if (formData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_ncl_certificate', 'aadhar_card_doc_name_image_for_ncl_certificate', 'aadhar_card_doc_name_container_for_ncl_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.ncl_certificate_id, VALUE_FOUR);
            }

            if (formData.obc_certificate_doc != '') {
                that.showDocument('obc_certificate_doc_container_for_ncl_certificate', 'obc_certificate_doc_name_image_for_ncl_certificate', 'obc_certificate_doc_name_container_for_ncl_certificate',
                        'obc_certificate_doc_download', 'obc_certificate_doc', formData.obc_certificate_doc, formData.ncl_certificate_id, VALUE_FIVE);
            }

            if (formData.income_certificate != '') {
                that.showDocument('income_certificate_container_for_ncl_certificate', 'income_certificate_name_image_for_ncl_certificate', 'income_certificate_name_container_for_ncl_certificate',
                        'income_certificate_download', 'income_certificate', formData.income_certificate, formData.ncl_certificate_id, VALUE_SIX);
            }

            if (formData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_ncl_certificate', 'applicant_photo_doc_name_image_for_ncl_certificate', 'applicant_photo_doc_name_container_for_ncl_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.ncl_certificate_id, VALUE_SEVEN);
            }
            if (formData.election_card_doc != '') {
                that.showDocument('election_card_doc_container_for_ncl_certificate', 'election_card_doc_name_image_for_ncl_certificate', 'election_card_doc_name_container_for_ncl_certificate',
                        'election_card_doc_download', 'election_card_doc', formData.election_card_doc, formData.ncl_certificate_id, VALUE_EIGHT);
            }
            if (formData.father_aadhar_card_doc != '') {
                that.showDocument('father_aadhar_card_doc_container_for_ncl_certificate', 'father_aadhar_card_doc_name_image_for_ncl_certificate', 'father_aadhar_card_doc_name_container_for_ncl_certificate',
                        'father_aadhar_card_doc_download', 'father_aadhar_card_doc', formData.father_aadhar_card_doc, formData.ncl_certificate_id, VALUE_TEN);
            }
            if (formData.mother_aadhar_card_doc != '') {
                that.showDocument('mother_aadhar_card_doc_container_for_ncl_certificate', 'mother_aadhar_card_doc_name_image_for_ncl_certificate', 'mother_aadhar_card_doc_name_container_for_ncl_certificate',
                        'mother_aadhar_card_doc_download', 'mother_aadhar_card_doc', formData.mother_aadhar_card_doc, formData.ncl_certificate_id, VALUE_ELEVEN);
            }
            if (formData.father_election_card_doc != '') {
                that.showDocument('father_election_card_doc_container_for_ncl_certificate', 'father_election_card_doc_name_image_for_ncl_certificate', 'father_election_card_doc_name_container_for_ncl_certificate',
                        'father_election_card_doc_download', 'father_election_card_doc', formData.father_election_card_doc, formData.ncl_certificate_id, VALUE_TWELVE);
            }
            if (formData.mother_election_card_doc != '') {
                that.showDocument('mother_election_card_doc_container_for_ncl_certificate', 'mother_election_card_doc_name_image_for_ncl_certificate', 'mother_election_card_doc_name_container_for_ncl_certificate',
                        'mother_election_card_doc_download', 'mother_election_card_doc', formData.mother_election_card_doc, formData.ncl_certificate_id, VALUE_THIRTEEN);
            }
            if (formData.father_certificate_doc != '') {
                that.showDocument('father_certificate_doc_container_for_ncl_certificate', 'father_certificate_doc_name_image_for_ncl_certificate', 'father_certificate_doc_name_container_for_ncl_certificate',
                        'father_certificate_doc_download', 'father_certificate_doc', formData.father_certificate_doc, formData.ncl_certificate_id, VALUE_FOURTEEN);
            }
            if (formData.community_certificate_doc != '') {
                that.showDocument('community_certificate_doc_container_for_ncl_certificate', 'community_certificate_doc_name_image_for_ncl_certificate', 'community_certificate_doc_name_container_for_ncl_certificate',
                        'community_certificate_doc_download', 'community_certificate_doc', formData.community_certificate_doc, formData.ncl_certificate_id, VALUE_FIFTEEN);
            }
        }

        generateSelect2();
        datePicker();
        datePickerMax('applicant_dob_for_nc');
        datePickerToday('applied_date_for_ncl_certificate');
        datePickerToday('applied_date_of_hold_certy_for_ncl_certificate');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_nc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
        }

        resetCounterForDocument('doc_no_for_ncl_certificate', 29);

        $('#ncl_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitNclCertificate($('#submit_btn_for_ncl_certificate'));
            }
        });

        //  resetCounterForDocument('doc_no_for_ncl_certificate', 34);
    },

    typeMinorNclCertificateForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.ncl_certificate_data;
            NclCertificate.router.navigate('edit_type_minor_ncl_certificate_form');
        } else {
            var formData = {};
            NclCertificate.router.navigate('type_minor_ncl_certificate_form');
        }

        tempVillageDataForNCL = [];
        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_FIVE = VALUE_FIVE;
        templateData.VALUE_SIX = VALUE_SIX;
        templateData.VALUE_SEVEN = VALUE_SEVEN;
        templateData.VALUE_EIGHT = VALUE_EIGHT;
        templateData.VALUE_NINE = VALUE_NINE;
        templateData.VALUE_TEN = VALUE_TEN;
        templateData.VALUE_ELEVEN = VALUE_ELEVEN;
        templateData.VALUE_TWELVE = VALUE_TWELVE;
        templateData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.ncl_certificate_data = parseData.ncl_certificate_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);

        if (isEdit) {
            templateData.obc_certificate_date = dateTo_DD_MM_YYYY(formData.obc_certificate_date);
            templateData.income_certificate_date = dateTo_DD_MM_YYYY(formData.income_certificate_date);
        }



        $('#ncl_certificate_form_and_datatable_container').html(typeMinorNclCertificateFormTemplate(templateData));
        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_nc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_nc');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        generateBoxes('radio', genderArray, 'gender', 'nc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'nc', formData.marital_status, false, false);
        showSubContainer('marital_status', 'nc', '.spouse_info_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'tax_payer', 'ncl_certificate', formData.tax_payer, false, false);
        showSubContainer('tax_payer', 'ncl_certificate', '.tax_payer_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'wealth_tax', 'ncl_certificate', formData.wealth_tax, false, false);
        showSubContainer('wealth_tax', 'ncl_certificate', '.wealth_tax_item', VALUE_ONE, 'radio');

        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_nc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_nc');

        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_nc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_nc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_nc');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_nc');

        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'obccaste_for_nc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'father_caste_for_nc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'mother_caste_for_nc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'grandfather_caste_for_nc');
        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relationship_of_applicant_for_nc');
        renderOptionsForTwoDimensionalArray(religionArray, 'religion_for_nc');


        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'commu_add_state_for_nc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'per_add_state_for_nc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_nc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'native_place_state_for_nc');

        if (isEdit) {

            $('#commu_add_state_for_nc').val(formData.commu_add_state == 0 ? '' : formData.commu_add_state);

            var districtData = tempDistrictData[formData.commu_add_state] ? tempDistrictData[formData.commu_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'commu_add_district_for_nc', 'district_code', 'district_name', 'District');
            $('#commu_add_district_for_nc').val(formData.commu_add_district == 0 ? '' : formData.commu_add_district);

            //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.commu_add_village_data, 'commu_add_village_for_nc', 'village_code', 'village_name', 'Village');
            that.getEditVillageData(formData.commu_add_state, formData.commu_add_district, 'nc', formData.commu_add_village, 'Village');
            $('#commu_add_village_for_nc').val(formData.commu_add_village);

            $('#per_add_state_for_nc').val(formData.per_add_state == 0 ? '' : formData.per_add_state);

            var districtData = tempDistrictData[formData.per_add_state] ? tempDistrictData[formData.per_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_add_district_for_nc', 'district_code', 'district_name', 'District');
            $('#per_add_district_for_nc').val(formData.per_add_district == 0 ? '' : formData.per_add_district);

            tempVillageDataForNCL = formData.per_add_village_data;
            //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.per_add_village_data, 'per_add_village_for_nc', 'village_code', 'village_name', 'Village');
            that.getEditVillageData(formData.per_add_state, formData.per_add_district, 'nc', formData.per_add_village, 'Village');
            $('#per_add_village_for_nc').val(formData.per_add_village);

            $('#born_place_state_for_nc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);

            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_nc', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_nc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);

            // renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.born_place_village_data, 'born_place_village_for_nc', 'village_code', 'village_name', 'Village');
            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'nc', formData.born_place_village, 'born_place');
            $('#born_place_village_for_nc').val(formData.born_place_village);

            $('#native_place_state_for_nc').val(formData.native_place_state == 0 ? '' : formData.native_place_state);

            var native_state = formData.native_place_state;
            var districtData = isEdit ? (native_state == VALUE_ONE ? damandiudistrictArray : (native_state == VALUE_TWO ? dnhdistrictArray : [])) : [];
            renderOptionsForTwoDimensionalArray(districtData, 'native_place_district_for_nc');
            $('#native_place_district_for_nc').val(formData.native_place_district == 0 ? '' : formData.native_place_district);

            var native_district = formData.native_place_district;
            var villageDataForNative = isEdit ? (native_district == VALUE_ONE ? damanVillageForNativeArray : (native_district == VALUE_TWO ? diuVillagesForNativeArray : (native_district == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
            renderOptionsForTwoDimensionalArray(villageDataForNative, 'native_place_village_for_nc');
            $('#native_place_village_for_nc').val(formData.native_place_village == 0 ? '' : formData.native_place_village);

            // $('#com_addr_city_for_nc').val(formData.com_addr_city);
            $('#com_addr_city_for_nc').val(formData.com_addr_city);
            $('#per_addr_city_for_nc').val(formData.per_addr_city);
            $('#village_name_for_nc').val(formData.village_name);
            $('#district').val(formData.district);
            $('#select_required_purpose_for_nc').val(formData.select_required_purpose);
            //  $('#village_name_for_nc').val(formData.village_name);
            $('#applicant_education_for_nc').val(formData.applicant_education);

            if (formData.billingtoo == isChecked) {
                $('#billingtoo_for_nc').attr('checked', 'checked');
            }

            $('#declaration_for_ncl_cerfificate').attr('checked', 'checked');
            $('#declaration').attr('checked', 'checked');
            $('#occupation_for_nc').val(formData.occupation);
            $('#religion_for_nc').val(formData.religion);
            $('#nearest_police_station_for_nc').val(formData.nearest_police_station);
            $('#obccaste_for_nc').val(formData.obccaste);
            $('#father_caste_for_nc').val(formData.father_caste);
            $('#mother_caste_for_nc').val(formData.mother_caste);
            $('#grandfather_caste_for_nc').val(formData.grandfather_caste);
            $('#relationship_of_applicant_for_nc').val(formData.relationship_of_applicant);
            $('#father_occupation_for_nc').val(formData.father_occupation);
            $('#mother_occupation_for_nc').val(formData.mother_occupation);
            $('#spouse_occupation_for_nc').val(formData.spouse_occupation);

            that.getYearlyIncomeTotalofFather();
            that.getYearlyIncomeTotalofMother();
            // that.getYearlyIncomeTotalofSpouse();
            that.getYearlyIncomeTotalofAll();

            if (formData.occupation == VALUE_TWELVE)
                $('#district').val(formData.district)

            if (formData.father_other_occupation) {
                $('#father_other_occupation_text_for_nc').show();
            }
            if (formData.mother_other_occupation) {
                $('#mother_other_occupation_text_for_nc').show();
            }
            if (formData.spouse_other_occupation) {
                $('#spouse_other_occupation_text_for_nc').show();
            }

            $('.partAFChangeEvent').show();

            $('#declaration_for_ncl_cerfificate').attr('checked', 'checked');
            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_nc').show();

            $('#father_born_place_state_for_nc').val(formData.father_born_place_state == 0 ? '' : formData.father_born_place_state);

            var val = formData.constitution_artical;



            if (formData.tax_payer_copy != '') {
                that.showDocument('tax_payer_copy_container_for_ncl_certificate', 'tax_payer_copy_name_image_for_ncl_certificate', 'tax_payer_copy_name_container_for_ncl_certificate',
                        'tax_payer_copy_download', 'tax_payer_copy', formData.tax_payer_copy, formData.ncl_certificate_id, VALUE_ONE);
            }

            if (formData.self_birth_certificate_doc != '') {
                that.showDocument('self_birth_certificate_doc_container_for_ncl_certificate', 'self_birth_certificate_doc_name_image_for_ncl_certificate', 'self_birth_certificate_doc_name_container_for_ncl_certificate',
                        'self_birth_certificate_doc_download', 'self_birth_certificate_doc', formData.self_birth_certificate_doc, formData.ncl_certificate_id, VALUE_TWO);
            }


            if (formData.leaving_certificate_doc != '') {
                that.showDocument('leaving_certificate_doc_container_for_ncl_certificate', 'leaving_certificate_doc_name_image_for_ncl_certificate', 'leaving_certificate_doc_name_container_for_ncl_certificate',
                        'leaving_certificate_doc_download', 'leaving_certificate_doc', formData.leaving_certificate_doc, formData.ncl_certificate_id, VALUE_THREE);
            }


            if (formData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_ncl_certificate', 'aadhar_card_doc_name_image_for_ncl_certificate', 'aadhar_card_doc_name_container_for_ncl_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.ncl_certificate_id, VALUE_FOUR);
            }

            if (formData.obc_certificate_doc != '') {
                that.showDocument('obc_certificate_doc_container_for_ncl_certificate', 'obc_certificate_doc_name_image_for_ncl_certificate', 'obc_certificate_doc_name_container_for_ncl_certificate',
                        'obc_certificate_doc_download', 'obc_certificate_doc', formData.obc_certificate_doc, formData.ncl_certificate_id, VALUE_FIVE);
            }

            if (formData.income_certificate != '') {
                that.showDocument('income_certificate_container_for_ncl_certificate', 'income_certificate_name_image_for_ncl_certificate', 'income_certificate_name_container_for_ncl_certificate',
                        'income_certificate_download', 'income_certificate', formData.income_certificate, formData.ncl_certificate_id, VALUE_SIX);
            }

            if (formData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_ncl_certificate', 'applicant_photo_doc_name_image_for_ncl_certificate', 'applicant_photo_doc_name_container_for_ncl_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.ncl_certificate_id, VALUE_SEVEN);
            }
            if (formData.parents_photo_doc != '') {
                that.showDocument('parents_photo_doc_container_for_ncl_certificate', 'parents_photo_doc_name_image_for_ncl_certificate', 'parents_photo_doc_name_container_for_ncl_certificate',
                        'parents_photo_doc_download', 'parents_photo_doc', formData.parents_photo_doc, formData.ncl_certificate_id, VALUE_NINE);
            }

            if (formData.father_aadhar_card_doc != '') {
                that.showDocument('father_aadhar_card_doc_container_for_ncl_certificate', 'father_aadhar_card_doc_name_image_for_ncl_certificate', 'father_aadhar_card_doc_name_container_for_ncl_certificate',
                        'father_aadhar_card_doc_download', 'father_aadhar_card_doc', formData.father_aadhar_card_doc, formData.ncl_certificate_id, VALUE_TEN);
            }
            if (formData.mother_aadhar_card_doc != '') {
                that.showDocument('mother_aadhar_card_doc_container_for_ncl_certificate', 'mother_aadhar_card_doc_name_image_for_ncl_certificate', 'mother_aadhar_card_doc_name_container_for_ncl_certificate',
                        'mother_aadhar_card_doc_download', 'mother_aadhar_card_doc', formData.mother_aadhar_card_doc, formData.ncl_certificate_id, VALUE_ELEVEN);
            }
            if (formData.father_election_card_doc != '') {
                that.showDocument('father_election_card_doc_container_for_ncl_certificate', 'father_election_card_doc_name_image_for_ncl_certificate', 'father_election_card_doc_name_container_for_ncl_certificate',
                        'father_election_card_doc_download', 'father_election_card_doc', formData.father_election_card_doc, formData.ncl_certificate_id, VALUE_TWELVE);
            }
            if (formData.mother_election_card_doc != '') {
                that.showDocument('mother_election_card_doc_container_for_ncl_certificate', 'mother_election_card_doc_name_image_for_ncl_certificate', 'mother_election_card_doc_name_container_for_ncl_certificate',
                        'mother_election_card_doc_download', 'mother_election_card_doc', formData.mother_election_card_doc, formData.ncl_certificate_id, VALUE_THIRTEEN);
            }
            if (formData.father_certificate_doc != '') {
                that.showDocument('father_certificate_doc_container_for_ncl_certificate', 'father_certificate_doc_name_image_for_ncl_certificate', 'father_certificate_doc_name_container_for_ncl_certificate',
                        'father_certificate_doc_download', 'father_certificate_doc', formData.father_certificate_doc, formData.ncl_certificate_id, VALUE_FOURTEEN);
            }
        }

        generateSelect2();
        datePicker();
        datePickerMin('applicant_dob_for_nc');

        resetCounterForDocument('doc_no_for_ncl_certificate', 29);


        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_nc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
        }

        //    resetCounterForDocument('doc_no_for_ncl_certificate', 28);

    },

    editOrViewNclCertificate: function (btnObj, nclCertificateId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!nclCertificateId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        if (typeof isPrint === "undefined") {
            isPrint = false;
        }
        var isEditOrView = isEdit ? VALUE_ONE : VALUE_TWO;
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ncl_certificate/get_ncl_certificate_data_by_id',
            type: 'post',
            //  data: $.extend({}, {'ncl_certificate_id': nclCertificateId}, getTokenData()),
            data: $.extend({}, {'ncl_certificate_id': nclCertificateId, 'is_edit_view': isEditOrView}, getTokenData()),

            // data: $.extend({}, {'ncl_certificate_id': nclCertificateId, 'is_edit': (isEdit ? VALUE_ZERO : VALUE_ONE)}, getTokenData()),
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
                    var nclCertificateData = parseData.ncl_certificate_data;

                    if (nclCertificateData.constitution_artical == VALUE_ONE)
                        that.typeMajorNclCertificateForm(isEdit, parseData);
                    else if (nclCertificateData.constitution_artical == VALUE_TWO)
                        that.typeMinorNclCertificateForm(isEdit, parseData);
                } else {
                    var nclCertificateData = parseData.ncl_certificate_data;
                    that.viewNclCertificateForm(VALUE_ONE, nclCertificateData, isPrint);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', NCL_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", NCL_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'NclCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },

    viewNclCertificateForm: function (moduleType, nclCertificateData, isPrint) {
        var that = this;
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        if (moduleType == VALUE_ONE) {

            NclCertificate.router.navigate('view_ncl_certificate_form');
            nclCertificateData.title = 'View';

        } else {

            nclCertificateData.show_submit_btn = true;
            //alert(nclCertificateData);
            //console.log(nclCertificateData.show_submit_btn);
        }
        nclCertificateData.VALUE_THREE = VALUE_THREE;
        nclCertificateData.NCL_CERTIFICATE_DOC_PATH = NCL_CERTIFICATE_DOC_PATH;

        nclCertificateData.is_checked = isChecked;
        nclCertificateData.VALUE_ONE = VALUE_ONE;
        nclCertificateData.VALUE_TWO = VALUE_TWO;
        nclCertificateData.VALUE_THREE = VALUE_THREE;
        nclCertificateData.VALUE_FOUR = VALUE_FOUR;
        nclCertificateData.VALUE_FIVE = VALUE_FIVE;
        nclCertificateData.VALUE_SIX = VALUE_SIX;
        nclCertificateData.VALUE_SEVEN = VALUE_SEVEN;
        nclCertificateData.IS_CHECKED_YES = IS_CHECKED_YES;
        nclCertificateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        nclCertificateData.show_constitution_artical_detail = true;
        nclCertificateData.showSpouseDataForMajor = false;

        var application_type = nclCertificateData.constitution_artical ? nclCertificateData.constitution_artical : '';

        if (application_type == VALUE_ONE) {
            nclCertificateData.show_constitution_artical_detail = false;
            nclCertificateData.application_type_text = 'Major';
            nclCertificateData.application_type_title = ' Applicant Name';
            nclCertificateData.show_marital_status = true;
            nclCertificateData.show_applicant_name = true;
            nclCertificateData.show_election = true;
            nclCertificateData.show_profession = true;
            nclCertificateData.show_spouse_detail = true;



        } else if (application_type == VALUE_TWO) {
            nclCertificateData.application_type_text = 'Minor';
            nclCertificateData.application_type_title = 'Guardian Name';
            nclCertificateData.show_minor_child_name = true;
            nclCertificateData.show_spouse_detail = false;
        } else if (nclCertificateData.father_alive == VALUE_ONE) {
            nclCertificateData.show_father_alive = true;
            nclCertificateData.show_mother_alive = true;
            nclCertificateData.show_grandfather_alive = true;
        }
        nclCertificateData.application_date = nclCertificateData.submitted_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY(nclCertificateData.submitted_datetime) : '';
        nclCertificateData.obc_certificate_date = nclCertificateData.obc_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(nclCertificateData.obc_certificate_date) : '';
        nclCertificateData.income_certificate_date = nclCertificateData.income_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(nclCertificateData.income_certificate_date) : '';
        nclCertificateData.religion = religionArray[nclCertificateData.religion] ? religionArray[nclCertificateData.religion] : '';
        nclCertificateData.other_religion_text = nclCertificateData.other_religion ? nclCertificateData.other_religion : '';

        nclCertificateData.district_text = talukaArray[nclCertificateData.district] ? talukaArray[nclCertificateData.district] : '';
        var district = nclCertificateData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        nclCertificateData.village_name_text = villageData[nclCertificateData.village_name] ? villageData[nclCertificateData.village_name] : '';

        nclCertificateData.com_addr_house_name_text = nclCertificateData.com_addr_house_name == '' ? '' : nclCertificateData.com_addr_house_name + ',';

        nclCertificateData.gender_text = genderArray[nclCertificateData.gender] ? genderArray[nclCertificateData.gender] : '';
        nclCertificateData.applicant_dob_text = nclCertificateData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(nclCertificateData.applicant_dob) : '';
        nclCertificateData.occupation_text = applicantOccupationArray[nclCertificateData.occupation] ? (nclCertificateData.occupation == VALUE_TWELVE ? nclCertificateData.other_occupation : applicantOccupationArray[nclCertificateData.occupation]) : '';
        nclCertificateData.marital_status_text = maritalStatusArray[nclCertificateData.marital_status] ? maritalStatusArray[nclCertificateData.marital_status] : '';
        nclCertificateData.father_occupation_text = applicantOccupationArray[nclCertificateData.father_occupation] ? (nclCertificateData.father_occupation == VALUE_TWELVE ? nclCertificateData.father_other_occupation : applicantOccupationArray[nclCertificateData.father_occupation]) : '';
        nclCertificateData.mother_occupation_text = applicantOccupationArray[nclCertificateData.mother_occupation] ? (nclCertificateData.mother_occupation == VALUE_TWELVE ? nclCertificateData.mother_other_occupation : applicantOccupationArray[nclCertificateData.mother_occupation]) : '';
        nclCertificateData.grandfather_occupation_text = applicantOccupationArray[nclCertificateData.grandfather_occupation] ? (nclCertificateData.grandfather_occupation == VALUE_TWELVE ? nclCertificateData.grandfather_other_occupation : applicantOccupationArray[nclCertificateData.grandfather_occupation]) : '';
        nclCertificateData.obccaste_text = applicantobccasteArray[nclCertificateData.obccaste] ? applicantobccasteArray[nclCertificateData.obccaste] : '';

        nclCertificateData.tax_payer_text = yesNoArray[nclCertificateData.tax_payer] ? yesNoArray[nclCertificateData.tax_payer] : '';
        nclCertificateData.wealth_tax_text = yesNoArray[nclCertificateData.wealth_tax] ? yesNoArray[nclCertificateData.wealth_tax] : '';
        nclCertificateData.nearest_police_station_text = applicantPolicestationArray[nclCertificateData.nearest_police_station] ? applicantPolicestationArray[nclCertificateData.nearest_police_station] : '';

        if (application_type == VALUE_ONE && nclCertificateData.marital_status == VALUE_ONE) {
            nclCertificateData.showSpouseDataForMajor = true;
        }
        if (nclCertificateData.wealth_tax == VALUE_ONE) {
            nclCertificateData.furnished_detail = nclCertificateData.furnished_detail != '' ? nclCertificateData.furnished_detail : '-';
        }

        nclCertificateData.applicant_caste_text = applicantobccasteArray[nclCertificateData.obccaste] ? applicantobccasteArray[nclCertificateData.obccaste] : '';

        if (nclCertificateData.marital_status == VALUE_ONE) {
            nclCertificateData.show_spouse = true;
            nclCertificateData.spouse_occupation_text = applicantOccupationArray[nclCertificateData.spouse_occupation] ? (nclCertificateData.spouse_occupation == VALUE_TWELVE ? nclCertificateData.spouse_other_occupation : applicantOccupationArray[nclCertificateData.spouse_occupation]) : '';
        }

        if (nclCertificateData.father_native_place_district == VALUE_ONE)
            nclCertificateData.father_native_place_district_text = 'Daman';

        if (nclCertificateData.grandfather_native_place_district == VALUE_ONE)
            nclCertificateData.grandfather_native_place_district_text = 'Daman';

        //nclCertificateData.com_addr_city = nclCertificateData.com_addr_city == VALUE_ONE ? 'Nani Daman' : 'Moti Daman';
        // nclCertificateData.grandfather_city_text = nclCertificateData.grandfather_city == VALUE_ONE ? 'Nani Daman' : 'Moti Daman';
        // nclCertificateData.father_city_text = nclCertificateData.father_city == VALUE_ONE ? 'Nani Daman' : 'Moti Daman';
        //   nclCertificateData.per_addr_city = nclCertificateData.per_addr_city == VALUE_ONE ? 'Nani Daman' : 'Moti Daman';
        // if(c

        // if(nclCertificateData.marital_status == VALUE_ONE){
        //    // that.getStateDistictVillageName(nclCertificateData.spouse_born_place_state,nclCertificateData.spouse_born_place_district,nclCertificateData.spouse_born_place_village,'spouse_born_place');
        //    // that.getStateDistictVillageName(nclCertificateData.spouse_native_place_state,nclCertificateData.spouse_native_place_district,nclCertificateData.spouse_native_place_village,'spouse_native_place');
        // }

        nclCertificateData.native_place_state_text = stateArray[nclCertificateData.native_place_state] ? stateArray[nclCertificateData.native_place_state] : '';

        var State = nclCertificateData.native_place_state;
        var districtData = State == VALUE_ONE ? damandiudistrictArray : (State == VALUE_TWO ? dnhdistrictArray : []);
        nclCertificateData.native_place_district_text = districtData[nclCertificateData.native_place_district] ? districtData[nclCertificateData.native_place_district] : '';

        var district = nclCertificateData.native_place_district;
        var villageData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
        nclCertificateData.native_place_village_text = villageData[nclCertificateData.native_place_village] ? villageData[nclCertificateData.native_place_village] : '';


        var district = nclCertificateData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        nclCertificateData.father_native_place_village_text = villageData[nclCertificateData.father_native_place_village] ? villageData[nclCertificateData.father_native_place_village] : '';


        var district = nclCertificateData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        nclCertificateData.grandfather_native_place_village_text = villageData[nclCertificateData.grandfather_native_place_village] ? villageData[nclCertificateData.grandfather_native_place_village] : '';

        nclCertificateData.total_annual_income = parseInt(nclCertificateData.annual_income) + parseInt(nclCertificateData.family_annual_income);



        var val = nclCertificateData.constitution_artical;

        //-------------------------------------------------
        nclCertificateData.show_tax_payer_copy = nclCertificateData.tax_payer_copy != '' ? true : false;
        nclCertificateData.show_applicant_photo_doc = nclCertificateData.applicant_photo_doc != '' ? true : false;
        nclCertificateData.show_parents_photo_doc = nclCertificateData.parents_photo_doc != '' ? true : false;
        nclCertificateData.show_self_birth_certificate_doc = nclCertificateData.self_birth_certificate_doc != '' ? true : false;
        nclCertificateData.show_leaving_certificate_doc = nclCertificateData.leaving_certificate_doc != '' ? true : false;
        nclCertificateData.show_aadhar_card_doc = nclCertificateData.aadhar_card_doc != '' ? true : false;
        nclCertificateData.show_father_aadhar_card_doc = nclCertificateData.father_aadhar_card_doc != '' ? true : false;
        nclCertificateData.show_mother_aadhar_card_doc = nclCertificateData.mother_aadhar_card_doc != '' ? true : false;
        nclCertificateData.show_election_card_doc = nclCertificateData.election_card_doc != '' ? true : false;
        nclCertificateData.show_father_election_card_doc = nclCertificateData.father_election_card_doc != '' ? true : false;
        nclCertificateData.show_mother_election_card_doc = nclCertificateData.mother_election_card_doc != '' ? true : false;
        nclCertificateData.show_obc_certificate_doc = nclCertificateData.obc_certificate_doc != '' ? true : false;
        nclCertificateData.show_income_certificate = nclCertificateData.income_certificate != '' ? true : false;
        nclCertificateData.show_father_certificate_doc = nclCertificateData.father_certificate_doc != '' ? true : false;
        nclCertificateData.show_community_certificate_doc = nclCertificateData.community_certificate_doc != '' ? true : false;
        nclCertificateData.relationship_of_applicant_text = relationDeceasedPersonArray[nclCertificateData.relationship_of_applicant] ? relationDeceasedPersonArray[nclCertificateData.relationship_of_applicant] : '';

        nclCertificateData.show_declaration_btn = moduleType == VALUE_ONE ? true : (nclCertificateData.declaration == VALUE_ONE ? true : false);



        if (nclCertificateData.constitution_artical == VALUE_ONE) {
            nclCertificateData.show_applicant_data = true;
        }

        if (nclCertificateData.constitution_artical == VALUE_TWO) {
            nclCertificateData.show_gaudian_data = true;
        }
        if (nclCertificateData.status != VALUE_ZERO && nclCertificateData.status != VALUE_ONE) {
            nclCertificateData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(nclCertificateViewTemplate(nclCertificateData));
        if (nclCertificateData.status != VALUE_ONE || nclCertificateData.status != VALUE_ZERO) {
            if (nclCertificateData.declaration == VALUE_ONE) {
                $('#declaration_for_ncl_cerfificate').click();
            }
        }
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_nclview').click();
            }, 500);
        }

        if (nclCertificateData.applicant_dob != '0000-00-00') {
            $('#applicant_dob_for_ncl_certificate').val(dateTo_DD_MM_YYYY(nclCertificateData.applicant_dob));
        }
    },

    checkValidationForNclCertificate: function (nclCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        if (!nclCertificateData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!nclCertificateData.village_name) {
            return getBasicMessageAndFieldJSONArray('village_name_for_nc', villageNameValidationMessage);
        }
        if (!nclCertificateData.applicant_name) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_nc', applicantNameValidationMessage);
        }
        if (nclCertificateData.constitution_artical == VALUE_TWO) {
            if (!nclCertificateData.relationship_of_applicant) {
                return getBasicMessageAndFieldJSONArray('relationship_of_applicant_for_nc', relationWithDeceasedPersonValidationMessage);
            }
            if (!nclCertificateData.guardian_address) {
                return getBasicMessageAndFieldJSONArray('guardian_address_for_nc', guardianAddressValidationMessage);
            }
            if (!nclCertificateData.guardian_mobile_no) {
                return getBasicMessageAndFieldJSONArray('guardian_mobile_no_for_nc', mobileValidationMessage);
            }
            if (!nclCertificateData.guardian_aadhaar) {
                return getBasicMessageAndFieldJSONArray('guardian_aadhaar_for_nc', invalidAadharNumberValidationMessage);
            }
            if (!nclCertificateData.minor_child_name) {
                return getBasicMessageAndFieldJSONArray('minor_child_name_for_nc', minorChildNameValidationMessage);
            }
        }
        if (!nclCertificateData.com_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('com_addr_house_no_for_nc', houseNoValidationMessage);
        }
        if (!nclCertificateData.com_addr_street) {
            return getBasicMessageAndFieldJSONArray('com_addr_street_for_nc', streetValidationMessage);
        }
        if (!nclCertificateData.com_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('com_addr_village_dmc_ward_for_nc', villageNameValidationMessage);
        }
        if (!nclCertificateData.com_addr_city) {
            return getBasicMessageAndFieldJSONArray('com_addr_city_for_nc', selectCityValidationMessage);
        }
        if (!nclCertificateData.com_pincode) {
            return getBasicMessageAndFieldJSONArray('com_pincode_for_nc', pincodeValidationMessage);
        }

        if (!nclCertificateData.per_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('per_addr_house_no_for_nc', houseNoValidationMessage);
        }
        if (!nclCertificateData.per_addr_street) {
            return getBasicMessageAndFieldJSONArray('per_addr_street_for_nc', streetValidationMessage);
        }
        if (!nclCertificateData.per_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('per_addr_village_dmc_ward_for_nc', villageNameValidationMessage);
        }
        if (!nclCertificateData.per_addr_city) {
            return getBasicMessageAndFieldJSONArray('per_addr_city_for_nc', selectCityValidationMessage);
        }
        if (!nclCertificateData.per_pincode) {
            return getBasicMessageAndFieldJSONArray('per_pincode_for_nc', pincodeValidationMessage);
        }

        if (nclCertificateData.constitution_artical == VALUE_ONE) {
            if (!nclCertificateData.mobile_number) {
                return getBasicMessageAndFieldJSONArray('mobile_number_for_nc', mobileValidationMessage);
            }
        }

        if (!nclCertificateData.applicant_dob) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_nc', birthDateValidationMessage);
        }
        if (!nclCertificateData.applicant_age) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_nc', applicantAgeValidationMessage);
        }
        if (!nclCertificateData.applicant_nationality) {
            return getBasicMessageAndFieldJSONArray('applicant_nationality_for_nc', applicantNationalityValidationMessage);
        }
        if (!nclCertificateData.applicant_education) {
            return getBasicMessageAndFieldJSONArray('applicant_education_for_nc', applicantEducationValidationMessage);
        }
        if (nclCertificateData.constitution_artical == VALUE_ONE) {
            if (!nclCertificateData.name_of_school) {
                return getBasicMessageAndFieldJSONArray('name_of_school_for_nc', schoolNameValidationMessage);
            }
        }
        if (!nclCertificateData.born_place_state) {
            return getBasicMessageAndFieldJSONArray('born_place_state_for_nc', selectStateValidationMessage);
        }
        if (!nclCertificateData.born_place_district) {
            return getBasicMessageAndFieldJSONArray('born_place_district_for_nc', selectDistrictValidationMessage);
        }
        if (!nclCertificateData.born_place_village) {
            return getBasicMessageAndFieldJSONArray('born_place_village_for_nc', selectVillageValidationMessage);
        }
        if (!nclCertificateData.born_place_pincode) {
            return getBasicMessageAndFieldJSONArray('born_place_pincode_for_nc', pincodeValidationMessage);
        }
        if (!nclCertificateData.native_place_state) {
            return getBasicMessageAndFieldJSONArray('native_place_state_for_nc', selectStateValidationMessage);
        }
        if (!nclCertificateData.native_place_district) {
            return getBasicMessageAndFieldJSONArray('native_place_district_for_nc', selectDistrictValidationMessage);
        }
        if (!nclCertificateData.native_place_village) {
            return getBasicMessageAndFieldJSONArray('native_place_village_for_nc', selectVillageValidationMessage);
        }
        if (!nclCertificateData.native_place_pincode) {
            return getBasicMessageAndFieldJSONArray('native_place_pincode_for_nc', pincodeValidationMessage);
        }
        if (!nclCertificateData.gender_for_nc) {
            $('#gender_for_nc_1').focus();
            return getBasicMessageAndFieldJSONArray('gender_for_nc', genderValidationMessage);
        }

        if (nclCertificateData.constitution_artical == VALUE_ONE) {
            if (!nclCertificateData.marital_status_for_nc) {
                $('#marital_status_for_nc_1').focus();
                return getBasicMessageAndFieldJSONArray('marital_status_for_nc', maritalStatusValidationMessage);
            }
        }
        if (!nclCertificateData.religion) {
            return getBasicMessageAndFieldJSONArray('religion_for_nc', selectanyoneValidationMessage);
        }
        if (nclCertificateData.religion == VALUE_FIVE) {
            if (!nclCertificateData.other_religion) {
                return getBasicMessageAndFieldJSONArray('other_religion_for_nc', religionValidationMessage);
            }
        }
        if (!nclCertificateData.obccaste) {
            return getBasicMessageAndFieldJSONArray('obccaste_for_nc', castesValidationMessage);
        }
        if (!nclCertificateData.nearest_police_station) {
            return getBasicMessageAndFieldJSONArray('nearest_police_station_for_nc', nearestPoliceStationValidationMessage);
        }
        if (nclCertificateData.constitution_artical == VALUE_ONE) {
            if (!nclCertificateData.occupation) {
                return getBasicMessageAndFieldJSONArray('occupation_for_nc', occupationValidationMessage);
            }
        }

        if (nclCertificateData.occupation == VALUE_TWELVE) {
            if (!nclCertificateData.other_occupation) {
                return getBasicMessageAndFieldJSONArray('other_occupation_for_nc', otherOccupationValidationMessage);
            }
        }

        if (nclCertificateData.constitution_artical == VALUE_ONE) {
            if (!nclCertificateData.annual_income) {
                return getBasicMessageAndFieldJSONArray('annual_income_for_nc', annualIncomeValidationMessage);
            }
        }

        // FATHER PART - 1

        if (!nclCertificateData.father_name_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_name_for_ncl_certificate', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.father_organization_type_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_organization_type_for_ncl_certificate', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.father_organization_name_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_organization_name_for_ncl_certificate', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.father_designation_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_designation_for_ncl_certificate', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.father_scale_pay_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_scale_pay_for_ncl_certificate', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.father_appointment_date_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_appointment_date_for_ncl_certificate', fathergovDetailsValidationMessage);
        }


        // MOTHER PART -1 

        if (!nclCertificateData.mother_name_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_ncl_certificate', mothergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_organization_type_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_organization_type_for_ncl_certificate', mothergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_organization_name_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_organization_name_for_ncl_certificate', mothergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_designation_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_designation_for_ncl_certificate', mothergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_scale_pay_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_scale_pay_for_ncl_certificate', mothergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_appointment_date_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_appointment_date_for_ncl_certificate', mothergovDetailsValidationMessage);
        }

        // SPOUSE PART - 1

        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_name_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_name_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_organization_type_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_organization_type_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_organization_name_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_organization_name_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_designation_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_designation_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_scale_pay_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_scale_pay_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_appointment_date_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_appointment_date_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }

        // FATHER PART - 2


        if (!nclCertificateData.father_occupation_for_nc) {
            return getBasicMessageAndFieldJSONArray('father_occupation_for_nc', fatherOccupationValidationMessage);
        }
        if (nclCertificateData.father_occupation_for_nc == VALUE_TWELVE) {
            if (!nclCertificateData.father_other_occupation_text_for_nc) {
                return getBasicMessageAndFieldJSONArray('father_other_occupation_text_for_nc', otherOccupationValidationMessage);
            }
        }
        if (!nclCertificateData.father_annual_salary_for_nc) {
            return getBasicMessageAndFieldJSONArray('father_annual_salary_for_nc', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.father_other_income_sources_for_nc) {
            return getBasicMessageAndFieldJSONArray('father_other_income_sources_for_nc', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.father_remarks_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_remarks_for_ncl_certificate', fathergovDetailsValidationMessage);
        }


        // MOTHER PART - 2

        if (!nclCertificateData.mother_occupation_for_nc) {
            return getBasicMessageAndFieldJSONArray('mother_occupation_for_nc', motherOccupationValidationMessage);
        }
        if (nclCertificateData.mother_occupation_for_nc == VALUE_TWELVE) {
            if (!nclCertificateData.mother_other_occupation_text_for_nc) {
                return getBasicMessageAndFieldJSONArray('mother_other_occupation_text_for_nc', otherOccupationValidationMessage);
            }
        }
        if (!nclCertificateData.mother_annual_salary_for_nc) {
            return getBasicMessageAndFieldJSONArray('mother_annual_salary_for_nc', mothergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_other_income_sources_for_nc) {
            return getBasicMessageAndFieldJSONArray('mother_other_income_sources_for_nc', mothergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_remarks_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_remarks_for_ncl_certificate', mothergovDetailsValidationMessage);
        }


        // SPOUSE PART - 2

        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_occupation_for_nc) {
                return getBasicMessageAndFieldJSONArray('spouse_occupation_for_nc', spouseOccupationValidationMessage);
            }
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (nclCertificateData.spouse_occupation_for_nc == VALUE_TWELVE) {
                if (!nclCertificateData.spouse_other_occupation_text_for_nc) {
                    return getBasicMessageAndFieldJSONArray('spouse_other_occupation_text_for_nc', otherOccupationValidationMessage);
                }
            }
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_annual_salary_for_nc) {
                return getBasicMessageAndFieldJSONArray('spouse_annual_salary_for_nc', spoucegovDetailValidationMessage);
            }
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_other_income_sources_for_nc) {
                return getBasicMessageAndFieldJSONArray('spouse_other_income_sources_for_nc', spoucegovDetailValidationMessage);
            }
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_remarks_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_remarks_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }



        if (!nclCertificateData.father_land_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_land_for_ncl_certificate', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_land_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_land_for_ncl_certificate', mothergovDetailsValidationMessage);
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_land_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_land_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }
        if (!nclCertificateData.minorchild_land_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('minorchild_land_for_ncl_certificate', minorDetailValidationMessage);
        }



        if (!nclCertificateData.father_location_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_location_for_ncl_certificate', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_location_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_location_for_ncl_certificate', mothergovDetailsValidationMessage);
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_location_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_location_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }
        if (!nclCertificateData.minorchild_location_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('minorchild_location_for_ncl_certificate', minorDetailValidationMessage);
        }


        if (!nclCertificateData.father_sizeofholding_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_sizeofholding_for_ncl_certificate', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_sizeofholding_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_sizeofholding_for_ncl_certificate', mothergovDetailsValidationMessage);
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_sizeofholding_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_sizeofholding_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }
        if (!nclCertificateData.minorchild_sizeofholding_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('minorchild_sizeofholding_for_ncl_certificate', minorDetailValidationMessage);
        }



        if (!nclCertificateData.father_typeofirrigated_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('father_typeofirrigated_for_ncl_certificate', fathergovDetailsValidationMessage);
        }
        if (!nclCertificateData.mother_typeofirrigated_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_typeofirrigated_for_ncl_certificate', mothergovDetailsValidationMessage);
        }
        if (nclCertificateData.marital_status_for_nc == VALUE_ONE) {
            if (!nclCertificateData.spouse_typeofirrigated_for_ncl_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_typeofirrigated_for_ncl_certificate', spoucegovDetailValidationMessage);
            }
        }
        if (!nclCertificateData.minorchild_typeofirrigated_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('minorchild_typeofirrigated_for_ncl_certificate', minorDetailValidationMessage);
        }


        if (!nclCertificateData.percentageofland) {
            return getBasicMessageAndFieldJSONArray('percentageofland_for_ncl', percentageofirrigatedlandValidationMessage);
        }
        if (!nclCertificateData.landceiling) {
            return getBasicMessageAndFieldJSONArray('landceiling_for_ncl', irrigatedandunirrigatedlandValidationMessage);
        }
        if (!nclCertificateData.landceilinglimit) {
            return getBasicMessageAndFieldJSONArray('landceilinglimit_for_ncl', percentageoftotalirrigatedlandValidationMessage);
        }

        if (!nclCertificateData.cropsfruit_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('cropsfruit_for_ncl_certificate', detailValidationMessage);
        }
        if (!nclCertificateData.location_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('location_for_ncl_certificate', detailValidationMessage);
        }
        if (!nclCertificateData.areaofplantation_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('areaofplantation_for_ncl_certificate', detailValidationMessage);
        }

        if (!nclCertificateData.locationpoperty_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('locationpoperty_for_ncl_certificate', detailValidationMessage);
        }
        if (!nclCertificateData.detailproperty_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('detailproperty_for_ncl_certificate', detailValidationMessage);
        }
        if (!nclCertificateData.usetowhich_for_ncl_certificate) {
            return getBasicMessageAndFieldJSONArray('usetowhich_for_ncl_certificate', detailValidationMessage);
        }
        if (!nclCertificateData.tax_payer_for_ncl_certificate) {
            $('#tax_payer_for_ncl_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('tax_payer_for_ncl_certificate', selectanyoneValidationMessage);
        }
        if (!nclCertificateData.wealth_tax_for_ncl_certificate) {
            $('#wealth_tax_for_ncl_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('wealth_tax_for_ncl_certificate', selectanyoneValidationMessage);
        }

        if (nclCertificateData.wealth_tax_for_ncl_certificate == VALUE_ONE) {
            if (!nclCertificateData.furnished_detail) {
                return getBasicMessageAndFieldJSONArray('furnished_detail', furnishedDetailValidationMessage);
            }
        }
        if (!nclCertificateData.obc_certificate_no) {
            return getBasicMessageAndFieldJSONArray('obc_certificate_no', numberValidationMessage);
        }
        if (!nclCertificateData.income_certificate_no) {
            return getBasicMessageAndFieldJSONArray('income_certificate_no', numberValidationMessage);
        }
        if (!nclCertificateData.obc_certificate_date) {
            return getBasicMessageAndFieldJSONArray('obc_certificate_date', dateValidationMessage);
        }
        if (!nclCertificateData.income_certificate_date) {
            return getBasicMessageAndFieldJSONArray('income_certificate_date', dateValidationMessage);
        }

        return '';
    },
    askForSubmitNclCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'NclCertificate.listview.submitNclCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitNclCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var nclCertificateData = $('#ncl_certificate_form').serializeFormJSON();
        var bornPlaceStateText = jQuery("#born_place_state_for_nc option:selected").text();
        var bornPlaceDistrictText = jQuery("#born_place_district_for_nc option:selected").text();
        var bornPlaceVillageText = jQuery("#born_place_village_for_nc option:selected").text();
        var nativePlaceStateText = jQuery("#native_place_state_for_nc option:selected").text();
        var nativePlaceDistrictText = jQuery("#native_place_district_for_nc option:selected").text();
        var nativePlaceVillageText = jQuery("#native_place_village_for_nc option:selected").text();
        var validationData = that.checkValidationForNclCertificate(nclCertificateData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('ncl-certificate-' + validationData.field, validationData.message);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_ncl_certificate') : $('#submit_btn_for_ncl_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var nclCertificateData = new FormData($('#ncl_certificate_form')[0]);
        nclCertificateData.append("born_place_state_text", bornPlaceStateText);
        nclCertificateData.append("born_place_district_text", bornPlaceDistrictText);
        nclCertificateData.append("born_place_village_text", bornPlaceVillageText);
        nclCertificateData.append("native_place_state_text", nativePlaceStateText);
        nclCertificateData.append("native_place_district_text", nativePlaceDistrictText);
        nclCertificateData.append("native_place_village_text", nativePlaceVillageText);
        nclCertificateData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        nclCertificateData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/submit_ncl_certificate',
            data: nclCertificateData,
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
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('ncl_certificate', textStatus.statusText);
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
                    validationMessageShow('ncl_certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                NclCertificate.listview.loadNclCertificateData();
                showSuccess(parseData.message);
            }
        });
    },

    submitUploadDocuments: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var nclCertificateData = $('#ncl_certificate_upload_document_form').serializeFormJSON();



        if (nclCertificateData.tax_payer_for_ncl_certificate == VALUE_ONE) {
            if ($('#tax_payer_copy_container_for_ncl_certificate').is(':visible')) {
                var birthCertificate = checkValidationForDocument('tax_payer_copy_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
                if (birthCertificate == false) {
                    return false;
                }
            }
        }

        if ($('#self_birth_certificate_doc_container_for_ncl_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('self_birth_certificate_doc_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if ($('#father_certificate_doc_container_for_ncl_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('father_certificate_doc_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if ($('#father_election_card_container_for_ncl_certificate').is(':visible')) {
            var fatherelectionCard = checkValidationForDocument('father_election_card_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
            if (fatherelectionCard == false) {
                return false;
            }
        }

        if ($('#father_aadhar_card_container_for_ncl_certificate').is(':visible')) {
            var fatheraadharCard = checkValidationForDocument('father_aadhar_card_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
            if (fatheraadharCard == false) {
                return false;
            }
        }

        if (nclCertificateData.if_grandfather_having_document_for_ncl_certificate == VALUE_ONE) {
            if ($('#grandfather_birth_certificate_doc_container_for_ncl_certificate').is(':visible')) {
                var birthCertificate = checkValidationForDocument('grandfather_birth_certificate_doc_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
                if (birthCertificate == false) {
                    return false;
                }
            }
        }

        if (nclCertificateData.if_grandfather_having_document_for_ncl_certificate == VALUE_TWO) {
            if ($('#grandfather_property_doc_container_for_ncl_certificate').is(':visible')) {
                var birthCertificate = checkValidationForDocument('grandfather_property_doc_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
                if (birthCertificate == false) {
                    return false;
                }
            }
        }


        if ($('#leaving_certificate_doc_container_for_ncl_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('leaving_certificate_doc_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if (nclCertificateData.constitution_artical == VALUE_ONE) {
            if ($('#election_card_doc_container_for_ncl_certificate').is(':visible')) {
                var birthCertificate = checkValidationForDocument('election_card_doc_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
                if (birthCertificate == false) {
                    return false;
                }
            }
        }

        if ($('#aadhar_card_doc_container_for_ncl_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('aadhar_card_doc_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if ($('#community_certificate_doc_container_for_ncl_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('community_certificate_doc_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if ($('#income_certificate_container_for_ncl_certificate').is(':visible')) {
            var incomeCertificate = checkValidationForDocument('income_certificate_for_ncl_certificate', VALUE_ONE, 'ncl-certificate');
            if (incomeCertificate == false) {
                return false;
            }
        }

        if ($('#applicant_photo_doc_container_for_ncl_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('applicant_photo_doc_for_ncl_certificate', VALUE_TWO, 'ncl-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }


        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_ncl_certificate') : $('#submit_btn_for_ncl_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var nclCertificateData = new FormData($('#ncl_certificate_upload_document_form')[0]);
        nclCertificateData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        nclCertificateData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/submit_ncl_certificate_upload_document',
            data: nclCertificateData,
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
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('ncl_certificate', textStatus.statusText);
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
                    validationMessageShow('ncl_certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                NclCertificate.router.navigate('ncl_certificate', {'trigger': true});
            }
        });
    },
    askForApproveApplication: function (nclCertificate) {
        if (!nclCertificate) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + nclCertificate);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ncl_certificate/get_ncl_certificate_data_by_ncl_certificate_id',
            type: 'post',
            data: $.extend({}, {'ncl_certificate_id': nclCertificate}, getTokenData()),
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
                var nclCertificateData = parseData.ncl_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                var dcData = that.getBasicConfigurationForMovement(nclCertificateData);
                $('#popup_container').html(nclCertificateApproveTemplate(dcData));
                datePicker();
                resetCounterForDocument('form-numbering', 1);
            }
        });
    },

    getBasicConfigurationForMovement: function (nclCertificateData) {
        var that = this;
        if (nclCertificateData.constitution_artical == VALUE_ONE) {
            nclCertificateData.show_applicant_data = true;
        }
        nclCertificateData.annual_income_text = numberToWordsAmount(nclCertificateData.annual_income);
        nclCertificateData.family_annual_income_text = numberToWordsAmount(nclCertificateData.family_annual_income);
        nclCertificateData.total_annual_income = parseInt(nclCertificateData.annual_income) + parseInt(nclCertificateData.family_annual_income);
        nclCertificateData.total_annual_income_text = numberToWordsAmount(nclCertificateData.total_annual_income);

        nclCertificateData.income_by_talathi_text = numberToWordsAmount(nclCertificateData.income_by_talathi);
        if (nclCertificateData.talathi_to_aci != VALUE_ZERO) {
            nclCertificateData.show_talathi_updated_basic_details = true;
        }
        nclCertificateData.application_type_title = 'Applicant';
        if (nclCertificateData.constitution_artical == VALUE_TWO) {
            nclCertificateData.application_type_title = 'Guardian';
        }
        if (nclCertificateData.aci_rec == VALUE_ONE || nclCertificateData.aci_rec == VALUE_TWO) {
            nclCertificateData.show_aci_updated_basic_details = true;
            nclCertificateData.cert_type_text = certTypeArray[nclCertificateData.cert_type] ? certTypeArray[nclCertificateData.cert_type] : '';
            nclCertificateData.aci_rec_text = recArray[nclCertificateData.aci_rec] ? recArray[nclCertificateData.aci_rec] : '';
            if (nclCertificateData.aci_rec == VALUE_ONE) {
                nclCertificateData.act_to_mamlatdar_ldc_datetime_text = nclCertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.aci_to_ldc_datetime) : '';
                nclCertificateData.act_to_mamlatdar_ldc_name_text = nclCertificateData.ldc_name;
            }
            if (nclCertificateData.aci_rec == VALUE_TWO) {
                nclCertificateData.act_to_mamlatdar_ldc_datetime_text = nclCertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.aci_to_mamlatdar_datetime) : '';
                nclCertificateData.act_to_mamlatdar_ldc_name_text = nclCertificateData.mamlatdar_name;
            }
        }
        if (nclCertificateData.ldc_to_mamlatdar != VALUE_ZERO && nclCertificateData.aci_rec == VALUE_ONE) {
            nclCertificateData.show_ldc_updated_basic_details = true;
            nclCertificateData.ldc_commu_address = that.ldcCommuAddress(nclCertificateData);
            if (nclCertificateData.constitution_artical == VALUE_TWO) {
                nclCertificateData.show_ldc_updated_minor_child_details = true;
            }
            nclCertificateData.obccaste_text = applicantobccasteArray[nclCertificateData.obccaste] ? applicantobccasteArray[nclCertificateData.obccaste] : '';
            nclCertificateData.obc_certificate_date_text = nclCertificateData.obc_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(nclCertificateData.obc_certificate_date) : '';
            nclCertificateData.income_certificate_date_text = nclCertificateData.income_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(nclCertificateData.income_certificate_date) : '';
            nclCertificateData.ldc_to_mamlatdar_datetime_text = nclCertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        if (nclCertificateData.to_type_reverify != VALUE_ZERO) {
            nclCertificateData.show_mam_reverify_updated_basic_details = true;
            nclCertificateData.mam_reverification = nclCertificateData.to_type_reverify == VALUE_ONE ? nclCertificateData.talathi_name : nclCertificateData.aci_name;
        }
        if (nclCertificateData.talathi_to_type_reverify != VALUE_ZERO) {
            nclCertificateData.talathi_reverification = nclCertificateData.talathi_to_type_reverify == VALUE_ONE ? nclCertificateData.aci_name : nclCertificateData.mamlatdar_name;
            nclCertificateData.show_talathi_reverify_updated_basic_details = true;
            nclCertificateData.income_by_talathi_reverify_text = numberToWordsAmount(nclCertificateData.income_by_talathi_reverify);
        }
        if (nclCertificateData.aci_rec_reverify == VALUE_ONE || nclCertificateData.aci_rec_reverify == VALUE_TWO) {
            nclCertificateData.show_aci_reverify_updated_basic_details = true;
            nclCertificateData.cert_type_reverify_text = certTypeArray[nclCertificateData.cert_type_reverify] ? certTypeArray[nclCertificateData.cert_type_reverify] : '';
            nclCertificateData.aci_rec_reverify_text = recArray[nclCertificateData.aci_rec_reverify] ? recArray[nclCertificateData.aci_rec_reverify] : '';
            if (nclCertificateData.aci_rec_reverify == VALUE_ONE) {
                nclCertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = nclCertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.aci_to_ldc_datetime) : '';
                nclCertificateData.act_to_mamlatdar_ldc_reverify_name_text = nclCertificateData.ldc_name;
            }
            if (nclCertificateData.aci_rec_reverify == VALUE_TWO) {
                nclCertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = nclCertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.aci_to_reverify_datetime) : '';
                nclCertificateData.act_to_mamlatdar_ldc_reverify_name_text = nclCertificateData.mamlatdar_name;
            }
        }
        if (nclCertificateData.ldc_to_mamlatdar != VALUE_ZERO && nclCertificateData.aci_rec_reverify == VALUE_ONE) {
            nclCertificateData.show_ldc_reverify_updated_basic_details = true;
            nclCertificateData.ldc_commu_address = that.ldcCommuAddress(nclCertificateData);
            if (nclCertificateData.constitution_artical == VALUE_TWO) {
                nclCertificateData.show_ldc_reverify_updated_minor_child_details = true;
            }
            nclCertificateData.obc_certificate_date_text = nclCertificateData.obc_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(nclCertificateData.obc_certificate_date) : '';
            nclCertificateData.income_certificate_date_text = nclCertificateData.income_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(nclCertificateData.income_certificate_date) : '';
            nclCertificateData.ldc_to_mamlatdar_datetime_text = nclCertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        nclCertificateData.obccaste_text = applicantobccasteArray[nclCertificateData.obccaste] ? applicantobccasteArray[nclCertificateData.obccaste] : '';
        nclCertificateData.talathi_to_aci_datetime_text = nclCertificateData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.talathi_to_aci_datetime) : '';
        nclCertificateData.aci_to_mamlatdar_datetime_text = nclCertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.aci_to_mamlatdar_datetime) : '';
        nclCertificateData.mam_to_reverify_datetime_text = nclCertificateData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.mam_to_reverify_datetime) : '';
        nclCertificateData.talathi_to_reverify_datetime_text = nclCertificateData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.talathi_to_reverify_datetime) : '';
        nclCertificateData.aci_to_reverify_datetime_text = nclCertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(nclCertificateData.aci_to_reverify_datetime) : '';
        return nclCertificateData;
    },

    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_ncl_certificate_form').serializeFormJSON();
        if (!formData.ncl_certificate_id_for_ncl_certificate_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_ncl_certificate_approve) {
            $('#remarks_for_ncl_certificate_approve').focus();
            validationMessageShow('ncl-approve-remarks_for_ncl_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_ncl_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/approve_application',
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
                validationMessageShow('ncl-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('ncl-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                NclCertificate.listview.loadNclCertificateData();
//                $('#status_' + formData.ncl_certificate_id_for_ncl_certificate_approve).html(appStatusArray[VALUE_FIVE]);
//                $('#edit_btn_for_app_' + formData.ncl_certificate_id_for_ncl_certificate_approve).remove();
//                $('#reject_btn_for_app_' + formData.ncl_certificate_id_for_ncl_certificate_approve).remove();
//                $('#approve_btn_for_app_' + formData.ncl_certificate_id_for_ncl_certificate_approve).remove();
//                $('#download_certificate_btn_for_app_' + formData.ncl_certificate_id_for_ncl_certificate_approve).show();
            }
        });
    },
    askForRejectApplication: function (nclCertificateId) {
        if (!nclCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + nclCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ncl_certificate/get_ncl_certificate_data_by_ncl_certificate_id',
            type: 'post',
            data: $.extend({}, {'ncl_certificate_id': nclCertificateId}, getTokenData()),
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
                var nclCertificateData = parseData.ncl_certificate_data;
                showPopup();
                var dcData = that.getBasicConfigurationForMovement(nclCertificateData);
                $('#popup_container').html(nclCertificateRejectTemplate(dcData));
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_ncl_certificate_form').serializeFormJSON();
        if (!formData.ncl_certificate_id_for_ncl_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_ncl_certificate_reject) {
            $('#remarks_for_ncl_certificate_reject').focus();
            validationMessageShow('ncl-certificate-reject-remarks_for_ncl_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_ncl_certificate_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/reject_application',
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
                validationMessageShow('ncl-certificate-reject', textStatus.statusText);
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
                    validationMessageShow('ncl-certificate-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                NclCertificate.listview.loadNclCertificateData();
            }
        });
    },

    FillBilling: function () {
        if ($("#billingtoo_for_nc").is(":checked")) {
            $('#per_addr_house_no_for_nc').val($('#com_addr_house_no_for_nc').val());
            $('#per_addr_house_name_for_nc').val($('#com_addr_house_name_for_nc').val());
            $('#per_addr_street_for_nc').val($('#com_addr_street_for_nc').val());
            $('#per_addr_village_dmc_ward_for_nc').val($('#com_addr_village_dmc_ward_for_nc').val());
            $('#per_addr_city_for_nc').val($('#com_addr_city_for_nc').val());
            $('#per_pincode_for_nc').val($('#com_pincode_for_nc').val());
        } else {
            $('#per_addr_house_no_for_nc').val('');
            $('#per_addr_house_name_for_nc').val('');
            $('#per_addr_street_for_nc').val('');
            $('#per_addr_village_dmc_ward_for_nc').val('');
            $('#per_addr_city_for_nc').val('');
            $('#per_pincode_for_nc').val();
        }
        generateSelect2();
    },

    downloadCertificate: function (nclCertificateId, moduleType) {
        if (!nclCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#ncl_certificate_id_for_certificate').val(nclCertificateId);
        $('#mtype_for_certificate').val(moduleType);
        $('#ncl_certificate_pdf_form').submit();
        $('#ncl_certificate_id_for_certificate').val('');
        $('#mtype_for_certificate').val('');
    },

    getQueryData: function (nclCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!nclCertificateId) {
            //console.log(nclCertificateId);
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_SIX;
        templateData.module_id = nclCertificateId;
        var btnObj = $('#query_btn_for_app_' + nclCertificateId);
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
                tmpData.title = 'Applicant Name';
                tmpData.module_type = VALUE_SIX;
                tmpData.module_id = nclCertificateId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    setAppointment: function (nclCertificateId) {
        if (!nclCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + nclCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ncl_certificate/get_appointment_data_by_ncl_certificate_id',
            type: 'post',
            data: $.extend({}, {'ncl_certificate_id': nclCertificateId}, getTokenData()),
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
                var appointmentData = parseData.appointment_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                if (appointmentData == null) {
                    var appointmentData = {};
                }
                appointmentData.VALUE_ONE = VALUE_ONE;
                appointmentData.appointment_date = dateTo_DD_MM_YYYY(appointmentData.appointment_date);
                //console.log(appointmentData.appointment_date);
                if (appointmentData.status == VALUE_FIVE || appointmentData.status == VALUE_SIX) {
                    appointmentData.show_submit_btn = false;
                } else {
                    appointmentData.show_submit_btn = appointmentData.talathi_to_aci != VALUE_ZERO ? false : true;
                }

                $('#popup_container').html(nclCertificateAppointmentTemplate(appointmentData));
                if (appointmentData.online_statement == VALUE_ONE) {
                    $('#online_statement_for_ncl_certificate').attr('checked', 'checked');
                }
                if (appointmentData.visit_office == VALUE_ONE) {
                    $('#visit_office_for_ncl_certificate').attr('checked', 'checked');
                }
                loadAppointmentHistory('ncl_certificate', appointmentData);
                datePickerAppointment();

            }
        });
    },
    submitSetAppointment: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var formData = $('#set_appointment_ncl_certificate_form').serializeFormJSON();
        if (!formData.ncl_certificate_id_for_ncl_certificate_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_ncl_certificate) {
            //$('#appointment_date_for_ncl_certificate').focus();
            validationMessageShow('ncl-certificate-appointment_date_for_ncl_certificate', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_ncl_certificate) {
            //$('#appointment_time_for_ncl_certificate').focus();
            validationMessageShow('ncl-certificate-appointment_time_for_ncl_certificate', timeValidationMessage);
            return false;
        }
        var start_date = dateTo_YYYY_MM_DD(formData.appointment_date_for_ncl_certificate); // Oct 1, 2014
        var d = new Date();
        var end_date = d.setDate(d.getDate() - 1);
        var new_start_date = new Date(start_date);
        var new_end_date = new Date(end_date);

        if (new_end_date > new_start_date) {
            //$('#appointment_date_for_ncl_certificate').focus();
            validationMessageShow('ncl-certificate-appointment_date_for_ncl_certificate', appointmentDateSelectValidationMessage);
            return false;
        }
        if (formData.online_statement_for_ncl_certificate == undefined && formData.visit_office_for_ncl_certificate == undefined) {
            $('#visit_office_for_ncl_certificate').focus();
            validationMessageShow('ncl-certificate-visit_office_for_ncl_certificate', appointmentTypeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_ncl_certificate_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/submit_set_appointment',
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
                validationMessageShow('ncl-certificate-set-appointment', textStatus.statusText);
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
                    validationMessageShow('ncl-ertificate-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var nclCertificateData = parseData.ncl_certificate_data;

                if (nclCertificateData.appointment_date != '0000-00-00') {
                    var d1 = (dateTo_DD_MM_YYYY(nclCertificateData.appointment_date)).split("-");
                    var d2 = (dateTo_DD_MM_YYYY()).split("-");
                    d1 = d1[2].concat(d1[1], d1[0]);
                    d2 = d2[2].concat(d2[1], d2[0]);
                    if (parseInt(d2) >= parseInt(d1)) {
                        //nclCertificateData.show_forward_btn = true;
                        $('#update_basic_detail_btn_for_app_' + nclCertificateData.ncl_certificate_id).show();
                    } else {
                        $('#update_basic_detail_btn_for_app_' + nclCertificateData.ncl_certificate_id).hide();
                    }
                }

                $('#appointment_container_' + nclCertificateData.ncl_certificate_id).html(that.getAppointmentData(nclCertificateData));
                $('#movement_for_ic_list_' + nclCertificateData.ncl_certificate_id).html(movementString(nclCertificateData));
            }
        });
    },
    reverifyApplication: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_ncl_certificate_form').serializeFormJSON();
        if (!formData.ncl_certificate_id_for_ncl_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if (!formData.to_type_reverify_for_ncl_certificate) {
                $('#to_type_reverify_for_ncl_certificate_1').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-to_type_reverify_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.mam_reverify_remarks_for_ncl_certificate) {
                $('#mam_reverify_remarks_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-mam_reverify_remarks_for_ncl_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.talathi_to_type_reverify_for_ncl_certificate) {
                $('#talathi_to_type_reverify_for_ncl_certificate_1').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-talathi_to_type_reverify_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.upload_reverification_document_for_ncl_certificate) {
                $('#upload_reverification_document_for_ncl_certificate_1').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-upload_reverification_document_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_reverification_document_for_ncl_certificate == VALUE_ONE) {
                var fieldDocCnt = 1;
                var newFieldDocItems = [];
                var exiFieldDocItems = [];
                var isFieldDocItemValidation;
                $('.verification_document_row').each(function () {
                    var that = $(this);
                    var tempCnt = that.find('.og_verification_document_cnt').val();
                    var fdItem = {};
                    var docName = $('#doc_name_for_verification_document_' + tempCnt).val();
                    if (docName == '' || docName == null) {
                        $('#doc_name_for_verification_document_' + tempCnt).focus();
                        validationMessageShow('verification-doc_name_for_verification_document_' + tempCnt, documentNameValidationMessage);
                        isFieldDocItemValidation = true;
                        return false;
                    }
                    fdItem.doc_name = docName;
                    if ($('#document_container_for_verification_document_' + tempCnt).is(':visible')) {
                        var uploadDoc = $('#document_for_verification_document_' + tempCnt).val();
                        if (!uploadDoc) {
                            validationMessageShow('verification-document_for_verification_document_' + tempCnt, uploadDocValidationMessage);
                            isFieldDocItemValidation = true;
                        }
                        var uploadDocMessage = fileUploadValidation('document_for_verification_document_' + tempCnt, 5120);
                        if (uploadDocMessage != '') {
                            validationMessageShow('verification-document_for_verification_document_' + tempCnt, uploadDocMessage);
                            isFieldDocItemValidation = true;
                        }
                    }

                    var fieldDocumentId = $('#field_document_id_for_field_verification_' + tempCnt).val();
                    if (!fieldDocumentId || fieldDocumentId == null) {
                        newFieldDocItems.push(fdItem);
                    } else {
                        fdItem.field_verification_document_id = fieldDocumentId;
                        exiFieldDocItems.push(fdItem);
                    }
                    fieldDocCnt++;
                });
                if (isFieldDocItemValidation) {
                    return false;
                }
                if (fieldDocCnt == VALUE_ONE) {
                    showError(oneFieldDocValidationMessage);
                    return false;
                }
                formData.new_field_doc_items = newFieldDocItems;
                formData.exi_field_doc_items = exiFieldDocItems;
            }
            if (!formData.talathi_reverify_remarks_for_ncl_certificate) {
                $('#talathi_reverify_remarks_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-talathi_reverify_remarks_for_ncl_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.cert_type_reverify_for_ncl_certificate) {
                $('#cert_type_reverify_for_ncl_certificate_1').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-cert_type_reverify_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_rec_reverify_for_ncl_certificate) {
                $('#aci_rec_reverify_for_ncl_certificate_1').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-aci_rec_reverify_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_reverify_remarks_for_ncl_certificate) {
                $('#aci_reverify_remarks_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-aci_reverify_remarks_for_ncl_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_ncl_certificate == VALUE_ONE && !formData.aci_to_ldc_reverify_for_ncl_certificate) {
                $('#aci_to_ldc_reverify_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-aci_to_ldc_reverify_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_ncl_certificate == VALUE_ONE && !formData.aci_to_type_reverify_for_ncl_certificate) {
                $('#aci_to_type_reverify_for_ncl_certificate_1').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-aci_to_type_reverify_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/reverify_application',
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
                validationMessageShow('ncl-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('ncl-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var icData = parseData.ncl_certificate_data;
                if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
                    $('#status_' + formData.ncl_certificate_id_for_ncl_certificate_update_basic_detail).html(appStatusArray[VALUE_THREE]);
                    var reverificationName = formData.to_type_reverify_for_ncl_certificate == VALUE_ONE ? formData.talathi_name_for_ncl_certificate_update_basic_detail : formData.aci_name_for_ncl_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.ncl_certificate_id_for_ncl_certificate_update_basic_detail).html('<hr>' + reverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    var talathiReverificationName = formData.talathi_to_type_reverify_for_ncl_certificate == VALUE_ONE ? formData.aci_name_for_ncl_certificate_update_basic_detail : formData.mamlatdar_name_for_ncl_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.ncl_certificate_id_for_ncl_certificate_update_basic_detail).html('<hr>' + talathiReverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    if (icData.aci_rec_reverify == VALUE_ONE) {
                        $('#reverification_status_' + formData.ncl_certificate_id_for_ncl_certificate_update_basic_detail).html('<hr>' + icData.ldc_name);
                    } else {
                        $('#reverification_status_' + formData.ncl_certificate_id_for_ncl_certificate_update_basic_detail).html('<hr>' + formData.mamlatdar_name_for_ncl_certificate_update_basic_detail);
                    }
                }
                $('#movement_for_ic_list_' + formData.ncl_certificate_id_for_ncl_certificate_update_basic_detail).html(movementString(parseData.ncl_certificate_data));
                resetModelMD();
            }
        });
    },
    ldcCommuAddress: function (basicDetailData) {
        return basicDetailData.ldc_commu_address != '' ? basicDetailData.ldc_commu_address : (basicDetailData.com_addr_house_no != '' ? (basicDetailData.com_addr_house_no + ', ') : '')
                + (basicDetailData.com_addr_house_name != '' ? (basicDetailData.com_addr_house_name + ', ') : '')
                + (basicDetailData.com_addr_street != '' ? (basicDetailData.com_addr_street + ', ') : '')
                + (basicDetailData.com_addr_village_dmc_ward != '' ? (basicDetailData.com_addr_village_dmc_ward + ', ') : '')
                + basicDetailData.com_addr_city;
    },
    updateBasicDetails: function (btnObj, nclcertificateId) {
        if (!nclcertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_LDC_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }

        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ncl_certificate/get_update_basic_detail_data_by_ncl_certificate_id',
            type: 'post',
            data: $.extend({}, {'ncl_certificate_id': nclcertificateId}, getTokenData()),
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

                var basicDetailData = parseData.update_basic_detail_data;
                if (tempTypeInSession != TEMP_TYPE_TALATHI_USER) {
                    showPopup();
                }
                if (basicDetailData == null) {
                    basicDetailData = {};
                }
                basicDetailData.obccaste_text = applicantobccasteArray[basicDetailData.obccaste] ? applicantobccasteArray[basicDetailData.obccaste] : '';
                basicDetailData.relationship_of_applicant_text = relationDeceasedPersonArray[basicDetailData.relationship_of_applicant] ? relationDeceasedPersonArray[basicDetailData.relationship_of_applicant] : '';
                basicDetailData.annual_income_text = numberToWordsAmount(basicDetailData.annual_income);
                basicDetailData.family_annual_income_text = numberToWordsAmount(basicDetailData.family_annual_income);
                basicDetailData.total_annual_income = parseInt(basicDetailData.annual_income) + parseInt(basicDetailData.family_annual_income);
                basicDetailData.total_annual_income_text = numberToWordsAmount(basicDetailData.total_annual_income);

                if (basicDetailData.constitution_artical == VALUE_ONE) {
                    basicDetailData.show_applicant_data = true;
                    basicDetailData.show_marital_status_data = true;
                    basicDetailData.show_minor_detail = false;
                    basicDetailData.show_permanent_adder = true;
                }

                if (basicDetailData.constitution_artical == VALUE_TWO) {
                    basicDetailData.show_gaudian_data = true;
                    basicDetailData.show_minor_detail = true;
                }


                if (basicDetailData.marital_status == VALUE_ONE && (basicDetailData.constitution_artical != VALUE_TWO && basicDetailData.constitution_artical != VALUE_FOUR && basicDetailData.constitution_artical != VALUE_FIVE)) {
                    basicDetailData.show_spouse_data = true;
                }
                basicDetailData.marital_status = maritalStatusArray[basicDetailData.marital_status];
                // basicDetailData.com_pincode = basicDetailData.com_pincode == '0' ? basicDetailData.pincode : basicDetailData.com_pincode;
                // basicDetailData.election_no = basicDetailData.election_no == '' ? '-' : basicDetailData.election_no;
                // basicDetailData.father_election_no = basicDetailData.father_election_no == '' ? '-' : basicDetailData.father_election_no;
                // basicDetailData.mother_election_no = basicDetailData.mother_election_no == '' ? '-' : basicDetailData.mother_election_no;
                // basicDetailData.spouse_election_no = basicDetailData.spouse_election_no == '' ? '-' : basicDetailData.spouse_election_no;

                // basicDetailData.required_purpose = basicDetailData.select_required_purpose == VALUE_ONE ? 'Old Age Pension' : basicDetailData.required_purpose;

                basicDetailData.com_addr_city = damanCityArray[basicDetailData.com_addr_city] == undefined ? basicDetailData.com_addr_city : damanCityArray[basicDetailData.com_addr_city];

                basicDetailData.application_type_title = 'Applicant';
                if (basicDetailData.constitution_artical == VALUE_TWO) {
                    basicDetailData.application_type_title = 'Guardian';
                }
                basicDetailData.VALUE_ONE = VALUE_ONE;
                basicDetailData.VALUE_TWO = VALUE_TWO;
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_talathi_enter_basic_details = true;
                }
                if (basicDetailData.talathi_to_aci != VALUE_ZERO) {
                    basicDetailData.show_talathi_updated_basic_details = true;
                    basicDetailData.income_by_talathi_text = numberToWordsAmount(basicDetailData.income_by_talathi);
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                    basicDetailData.show_aci_enter_basic_details = true;
                    basicDetailData.show_submit_btn = true;
                }
                if (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_TWO) {
                    basicDetailData.show_aci_updated_basic_details = true;
                    basicDetailData.cert_type_text = certTypeArray[basicDetailData.cert_type] ? certTypeArray[basicDetailData.cert_type] : '';
                    basicDetailData.aci_rec_text = recArray[basicDetailData.aci_rec] ? recArray[basicDetailData.aci_rec] : '';
                    if (basicDetailData.aci_rec == VALUE_ONE) {
                        basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_ldc_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.ldc_name;
                    }
                    if (basicDetailData.aci_rec == VALUE_TWO) {
                        basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_mamlatdar_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.mamlatdar_name;
                    }
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec == VALUE_ONE &&
                        basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                    basicDetailData.show_ldc_enter_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData.t_vt_name = basicDetailData.com_addr_village_dmc_ward + ', ' + basicDetailData.com_addr_city;
                    basicDetailData = ldcAppDetails(basicDetailData, 't_vt_name', 'ldc_vt_name', 'ldc_vt');
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_enter_minor_child_details = true;
                        basicDetailData = ldcAppDetails(basicDetailData, 'minor_child_name', 'ldc_minor_child_name', 'ldc_mc_name');
                    }
                    basicDetailData = ldcAppDetails(basicDetailData, 'father_name', 'ldc_father_name', 'ldc_fname');
                    basicDetailData.obc_certificate_date_text = basicDetailData.obc_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(basicDetailData.obc_certificate_date) : '';
                    basicDetailData.income_certificate_date_text = basicDetailData.income_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(basicDetailData.income_certificate_date) : '';
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && basicDetailData.aci_rec == VALUE_ONE) {
                    basicDetailData.show_ldc_updated_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_updated_minor_child_details = true;
                    }
                    basicDetailData.obccaste_text = applicantobccasteArray[basicDetailData.obccaste] ? applicantobccasteArray[basicDetailData.obccaste] : '';
                    basicDetailData.obc_certificate_date_text = basicDetailData.obc_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(basicDetailData.obc_certificate_date) : '';
                    basicDetailData.income_certificate_date_text = basicDetailData.income_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(basicDetailData.income_certificate_date) : '';
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.to_type_reverify == VALUE_ZERO &&
                        basicDetailData.status == VALUE_TWO) {
                    basicDetailData.show_mam_reverify_enter_basic_details = true;
                    basicDetailData.show_reverify_submit_btn = true;
                }
                if (basicDetailData.to_type_reverify != VALUE_ZERO) {
                    basicDetailData.show_mam_reverify_updated_basic_details = true;
                    basicDetailData.mam_reverification = basicDetailData.to_type_reverify == VALUE_ONE ? basicDetailData.talathi_name : basicDetailData.aci_name;
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.to_type_reverify == VALUE_ONE &&
                        basicDetailData.talathi_to_type_reverify == VALUE_ZERO && basicDetailData.status == VALUE_THREE) {
                    basicDetailData.show_talathi_reverify_enter_basic_details = true;
                    basicDetailData.show_reverify_submit_btn = true;
                }
                if (basicDetailData.talathi_to_type_reverify != VALUE_ZERO) {
                    basicDetailData.talathi_reverification = basicDetailData.talathi_to_type_reverify == VALUE_ONE ? basicDetailData.aci_name : basicDetailData.mamlatdar_name;
                    basicDetailData.show_talathi_reverify_updated_basic_details = true;
                    basicDetailData.income_by_talathi_reverify_text = numberToWordsAmount(basicDetailData.income_by_talathi_reverify);
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                        basicDetailData.status == VALUE_THREE &&
                        (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                    basicDetailData.show_aci_reverify_enter_basic_details = true;
                    basicDetailData.show_reverify_submit_btn = true;
                }
                if (basicDetailData.aci_rec_reverify == VALUE_ONE || basicDetailData.aci_rec_reverify == VALUE_TWO) {
                    basicDetailData.show_aci_reverify_updated_basic_details = true;
                    basicDetailData.obccaste_text = applicantobccasteArray[basicDetailData.obccaste] ? applicantobccasteArray[basicDetailData.obccaste] : '';
                    basicDetailData.cert_type_reverify_text = certTypeArray[basicDetailData.cert_type_reverify] ? certTypeArray[basicDetailData.cert_type_reverify] : '';
                    basicDetailData.aci_rec_reverify_text = recArray[basicDetailData.aci_rec_reverify] ? recArray[basicDetailData.aci_rec_reverify] : '';
                    if (basicDetailData.aci_rec_reverify == VALUE_ONE) {
                        basicDetailData.act_to_mamlatdar_ldc_reverify_datetime_text = basicDetailData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_ldc_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_reverify_name_text = basicDetailData.ldc_name;
                    }
                    if (basicDetailData.aci_rec_reverify == VALUE_TWO) {
                        basicDetailData.act_to_mamlatdar_ldc_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_reverify_name_text = basicDetailData.mamlatdar_name;
                    }
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec_reverify == VALUE_ONE &&
                        basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                    basicDetailData.show_ldc_reverify_enter_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData.t_vt_name = basicDetailData.com_addr_village_dmc_ward + ', ' + basicDetailData.com_addr_city;
                    basicDetailData = ldcAppDetails(basicDetailData, 't_vt_name', 'ldc_vt_name', 'ldc_vt');
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_reverify_enter_minor_child_details = true;
                        basicDetailData = ldcAppDetails(basicDetailData, 'minor_child_name', 'ldc_minor_child_name', 'ldc_mc_name');
                    }
                    basicDetailData = ldcAppDetails(basicDetailData, 'father_name', 'ldc_father_name', 'ldc_fname');
                    basicDetailData.obc_certificate_date_text = basicDetailData.obc_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(basicDetailData.obc_certificate_date) : '';
                    basicDetailData.income_certificate_date_text = basicDetailData.income_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(basicDetailData.income_certificate_date) : '';
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && basicDetailData.aci_rec_reverify == VALUE_ONE) {
                    basicDetailData.show_ldc_reverify_updated_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_reverify_updated_minor_child_details = true;
                    }
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                    basicDetailData.obc_certificate_date_text = basicDetailData.obc_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(basicDetailData.obc_certificate_date) : '';
                    basicDetailData.income_certificate_date_text = basicDetailData.income_certificate_date != '0000-00-00' ? dateTo_DD_MM_YYYY(basicDetailData.income_certificate_date) : '';
                }
                basicDetailData.title = basicDetailData.to_type_reverify == VALUE_ZERO ? (tempTypeInSession == TEMP_TYPE_TALATHI_USER ? 'Forward for Verification' : (tempTypeInSession == TEMP_TYPE_ACI_USER ? 'Forward for Approval' : 'Update Basic Details')) : 'Reverification Income Certificate Form';
                basicDetailData.talathi_to_aci_datetime_text = basicDetailData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_aci_datetime) : '';
                basicDetailData.mam_to_reverify_datetime_text = basicDetailData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.mam_to_reverify_datetime) : '';
                basicDetailData.talathi_to_reverify_datetime_text = basicDetailData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_reverify_datetime) : '';
                basicDetailData.aci_to_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';

                if (basicDetailData.status == VALUE_FIVE || basicDetailData.status == VALUE_SIX) {
                    basicDetailData.show_approve_reject_details = true;
                    basicDetailData.status_text = returnAppStatus(basicDetailData.status);
                    basicDetailData.status_datetime_text = basicDetailData.status_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.status_datetime) : '';
                    basicDetailData.title = 'Movement Details of NCL (OBC Renewal) Certificate Form';
                }
                basicDetailData.status = queryStatus(basicDetailData.query_status);

                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    $('#model_md_title').html(basicDetailData.title);
                    $('#model_md_body').html(nclCertificateBasicDetailTemplate(basicDetailData));
                } else {
                    basicDetailData.show_card = true;
                    $('#popup_container').html(nclCertificateBasicDetailTemplate(basicDetailData));
                }

                if (basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) {
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                        generateBoxes('radio', yesNoArray, 'upload_verification_document', 'ncl_certificate', basicDetailData.is_upload_verification_document, false, false);
                        showSubContainer('upload_verification_document', 'ncl_certificate', '#field_verification_document_uploads', VALUE_ONE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.aci_data, 'talathi_to_aci_for_ncl_certificate', 'sa_user_id', 'name', '', false);
                        allowOnlyIntegerValue('income_by_talathi_for_ncl_certificate');

                        if (basicDetailData.field_documents != '') {
                            $.each(basicDetailData.field_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_ONE);
                                $('#upload_verification_document_for_ncl_certificate_1').attr('checked', 'checked');
                                $('#field_verification_document_uploads_container_for_ncl_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_ONE);
                            $('#upload_verification_document_for_ncl_certificate_2').attr('checked', 'checked');
                        }

                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                        basicDetailData.aci_rec = (basicDetailData.aci_rec == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec);
                        generateBoxes('radio', certTypeArray, 'cert_type', 'ncl_certificate', basicDetailData.cert_type, false, false);
                        generateBoxes('radio', recArray, 'aci_rec', 'ncl_certificate', basicDetailData.aci_rec, false, false);
                        showSubContainer('aci_rec', 'ncl_certificate', '#aci_to_ldc', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec', 'ncl_certificate', '#aci_to_mamlatdar', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'aci_to_mamlatdar_for_ncl_certificate', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_for_ncl_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'obccaste_for_ncl_certificate', false);
                        $('#obccaste_for_ncl_certificate').val(basicDetailData.obccaste);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'ldc_to_mamlatdar_for_ncl_certificate', 'sa_user_id', 'name', '', false);
                        datePicker();
                    }
                    if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.to_type_reverify == VALUE_ZERO) {
                        generateBoxes('radio', reverifyTypeArray, 'to_type_reverify', 'ncl_certificate', basicDetailData.to_type_reverify, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.to_type_reverify == VALUE_ONE) {
                        generateBoxes('radio', yesNoArray, 'upload_reverification_document', 'ncl_certificate', basicDetailData.is_upload_reverification_document, false, false);
                        showSubContainer('upload_reverification_document', 'ncl_certificate', '#field_reverification_document_uploads', VALUE_ONE, 'radio');
                        generateBoxes('radio', talathiReverifyTypeArray, 'talathi_to_type_reverify', 'ncl_certificate', basicDetailData.talathi_to_type_reverify, false);
                        allowOnlyIntegerValue('income_by_talathi_reverify_for_ncl_certificate');

                        if (basicDetailData.field_reverify_documents != '') {
                            $.each(basicDetailData.field_reverify_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_TWO);
                                $('#upload_reverification_document_for_ncl_certificate_1').attr('checked', 'checked');
                                $('#field_reverification_document_uploads_container_for_ncl_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_TWO);
                            $('#upload_reverification_document_for_ncl_certificate_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                            (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                        var tempArray = [];
                        tempArray[VALUE_ZERO] = basicDetailData.mamlatdar_name;
                        generateBoxes('radio', tempArray, 'aci_to_type_reverify', 'ncl_certificate', VALUE_ZERO, false);
                        basicDetailData.aci_rec_reverify = (basicDetailData.aci_rec_reverify == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec_reverify);
                        generateBoxes('radio', certTypeArray, 'cert_type_reverify', 'ncl_certificate', basicDetailData.cert_type_reverify, false, false);
                        generateBoxes('radio', recArray, 'aci_rec_reverify', 'ncl_certificate', basicDetailData.aci_rec_reverify, false, false);
                        showSubContainer('aci_rec_reverify', 'ncl_certificate', '#aci_to_ldc_reverify', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec_reverify', 'ncl_certificate', '#aci_to_mamlatdar_reverify', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_reverify_for_ncl_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec_reverify == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        var tempArray = [];
                        var tArray = {};
                        tArray['name'] = basicDetailData.mamlatdar_name;
                        tArray['sa_user_id'] = basicDetailData.aci_to_mamlatdar;
                        tempArray.push(tArray);
                        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'obccaste_for_ncl_certificate', false);
                        $('#obccaste_for_ncl_certificate').val(basicDetailData.obccaste);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempArray, 'ldc_to_mamlatdar_for_ncl_certificate', 'sa_user_id', 'name', '', false);
                        datePicker();
                    }
                    that.loadFieldDocumentView(basicDetailData, VALUE_ONE);
                    that.loadFieldReverifyDocumentView(basicDetailData, VALUE_TWO);
                }
                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    $('#popup_md_modal').modal('show');
                }
            }
        });
    },
    submitBasicDetail: function (btnObj, showLDCDraftBtn) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (typeof showLDCDraftBtn == "undefined") {
            showLDCDraftBtn = false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_LDC_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_ncl_certificate_form').serializeFormJSON();
        if (!formData.ncl_certificate_id_for_ncl_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {

            if (!formData.upload_verification_document_for_ncl_certificate) {
                $('#upload_verification_document_for_ncl_certificate_1').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-upload_verification_document_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_verification_document_for_ncl_certificate == VALUE_ONE) {
                var fieldDocCnt = 1;
                var newFieldDocItems = [];
                var exiFieldDocItems = [];
                var isFieldDocItemValidation;
                $('.verification_document_row').each(function () {
                    var that = $(this);
                    var tempCnt = that.find('.og_verification_document_cnt').val();
                    var fdItem = {};
                    var docName = $('#doc_name_for_verification_document_' + tempCnt).val();
                    if (docName == '' || docName == null) {
                        $('#doc_name_for_verification_document_' + tempCnt).focus();
                        validationMessageShow('verification-doc_name_for_verification_document_' + tempCnt, documentNameValidationMessage);
                        isFieldDocItemValidation = true;
                        return false;
                    }
                    fdItem.doc_name = docName;
                    if ($('#document_container_for_verification_document_' + tempCnt).is(':visible')) {
                        var uploadDoc = $('#document_for_verification_document_' + tempCnt).val();
                        if (!uploadDoc) {
                            validationMessageShow('verification-document_for_verification_document_' + tempCnt, uploadDocValidationMessage);
                            isFieldDocItemValidation = true;
                        }
                        var uploadDocMessage = fileUploadValidation('document_for_verification_document_' + tempCnt, 5120);
                        if (uploadDocMessage != '') {
                            validationMessageShow('verification-document_for_verification_document_' + tempCnt, uploadDocMessage);
                            isFieldDocItemValidation = true;
                        }
                    }
                    var fieldDocumentId = $('#field_document_id_for_field_verification_' + tempCnt).val();
                    if (!fieldDocumentId || fieldDocumentId == null) {
                        newFieldDocItems.push(fdItem);
                    } else {
                        fdItem.field_verification_document_id = fieldDocumentId;
                        exiFieldDocItems.push(fdItem);
                    }
                    fieldDocCnt++;
                });
                if (isFieldDocItemValidation) {
                    return false;
                }
                if (fieldDocCnt == VALUE_ONE) {
                    showError(oneFieldDocValidationMessage);
                    return false;
                }
                formData.new_field_doc_items = newFieldDocItems;
                formData.exi_field_doc_items = exiFieldDocItems;
            }
            if (!formData.talathi_remarks_for_ncl_certificate) {
                $('#talathi_remarks_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-talathi_remarks_for_ncl_certificate', remarksValidationMessage);
                return false;
            }
            if (!formData.talathi_to_aci_for_ncl_certificate) {
                $('#talathi_to_aci_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-talathi_to_aci_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.cert_type_for_ncl_certificate) {
                $('#cert_type_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-cert_type_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_remarks_for_ncl_certificate) {
                $('#aci_remarks_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-aci_remarks_for_ncl_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_ncl_certificate == VALUE_ONE && !formData.aci_to_ldc_for_ncl_certificate) {
                $('#aci_to_ldc_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-aci_to_ldc_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_ncl_certificate == VALUE_TWO && !formData.aci_to_mamlatdar_for_ncl_certificate) {
                $('#aci_to_mamlatdar_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-aci_to_mamlatdar_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            var constitutionArtical = parseInt($('#constitution_artical_for_ncl_certificate').val());
            if (constitutionArtical != VALUE_ONE && constitutionArtical != VALUE_TWO) {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (!formData.ldc_applicant_name_for_ncl_certificate) {
                $('#ldc_applicant_name_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-ldc_applicant_name_for_ncl_certificate', applicantNameValidationMessage);
                return false;
            }
            if (constitutionArtical == VALUE_TWO) {
                if (!formData.ldc_minor_child_name_for_ncl_certificate) {
                    $('#ldc_minor_child_name_for_ncl_certificate').focus();
                    validationMessageShow('ncl-certificate-update-basic-detail-ldc_minor_child_name_for_ncl_certificate', minorChildNameValidationMessage);
                    return false;
                }
            }
            if (!formData.ldc_father_name_for_ncl_certificate) {
                $('#ldc_father_name_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-ldc_father_name_for_ncl_certificate', fatherNameValidationMessage);
                return false;
            }
            if (!formData.ldc_vt_name_for_ncl_certificate) {
                $('#ldc_vt_name_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-ldc_vt_name_for_ncl_certificate', detailValidationMessage);
                return false;
            }
            if (!formData.ldc_commu_address_for_ncl_certificate) {
                $('#ldc_commu_address_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-ldc_commu_address_for_ncl_certificate', communicationAddressValidationMessage);
                return false;
            }
            if (!formData.obccaste_for_ncl_certificate) {
                $('#obccaste_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-obccaste_for_ncl_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.obc_certificate_no_for_ncl_certificate) {
                $('#obc_certificate_no_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-obc_certificate_no_for_ncl_certificate', numberValidationMessage);
                return false;
            }
            if (!formData.obc_certificate_date_for_ncl_certificate) {
                $('#obc_certificate_date_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-obc_certificate_date_for_ncl_certificate', dateValidationMessage);
                return false;
            }
            if (!formData.income_certificate_no_for_ncl_certificate) {
                $('#income_certificate_no_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-income_certificate_no_for_ncl_certificate', numberValidationMessage);
                return false;
            }
            if (!formData.income_certificate_date_for_ncl_certificate) {
                $('#income_certificate_date_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-income_certificate_date_for_ncl_certificate', dateValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_ncl_certificate) {
                $('#ldc_to_mamlatdar_remarks_for_ncl_certificate').focus();
                validationMessageShow('ncl-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_ncl_certificate', remarksValidationMessage);
                return false;
            }
            if (!showLDCDraftBtn) {
                formData.update_ldc_mam_details = VALUE_ONE;
                if (!formData.ldc_to_mamlatdar_for_ncl_certificate) {
                    $('#ldc_to_mamlatdar_for_ncl_certificate').focus();
                    validationMessageShow('ncl-certificate-update-basic-detail-ldc_to_mamlatdar_for_ncl_certificate', oneOptionValidationMessage);
                    return false;
                }
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/forward_to',
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
                validationMessageShow('ncl-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('ncl-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#movement_for_ic_list_' + parseData.ncl_certificate_id).html(movementString(parseData.ncl_certificate_data));
                resetModelMD();
            }
        });
    },
    getDocumentData: function (nclCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!nclCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#ncl_certificate_id_for_scrutiny').val(nclCertificateId);
        $('#ncl_certificate_document_for_scrutiny').submit();
        $('#ncl_certificate_id_for_scrutiny').val('');
    },
    getDistrictData: function (obj, moduleName, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'oc' ? '' : '';
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_district_for_' + moduleName, 'district_code', 'district_name', text + 'District');
        $('#district_for_' + moduleName).val('');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode([], id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
        $('id + #_village_for_' + moduleName).val('');
        var stateCode = obj.val();
        if (!stateCode) {
            return;
        }
        var districtData = tempDistrictData[stateCode] ? tempDistrictData[stateCode] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, id + '_district_for_' + moduleName, 'district_code', 'district_name', text + 'District');
        $('id + #_district_for_' + moduleName).val('');

        // ee
        // var eedistrictData = tempDistrictData[stateCode] ? tempDistrictData[stateCode] : [];
        // renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(eedistrictData, 'ee_dist', 'district_code', 'district_name', text + 'District');
        // $('#ee_dist').val('');


    },
    districtChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'village_name_for_nc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_nc');
    },
    getVillageData: function (obj, moduleName, id, isTemp = false) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var bornPlaceVillageSpinner = 'born_place_village_for_' + moduleName;
        addTagSpinner(bornPlaceVillageSpinner);
        var text = moduleName == 'oc' ? ' ' : '';
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
        $('#' + id + '_village_for_' + moduleName).val('');
        var state = $('#' + id + '_state_for_' + moduleName).val();
        var districtCode = obj.val();
        if (!districtCode || !state) {
            return;
        }
        $.ajax({
            url: 'ncl_certificate/get_village_data_for_ncl_certificate',
            type: 'post',
            data: $.extend({}, {'state_code': state, 'district_code': districtCode}, getTokenData()),
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
                showError(textStatus.statusText);
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
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                if (isTemp) {
                    tempVillageDataForNCL = parseData.village_data;
                }
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
                $('#' + id + '_village_for_' + moduleName).val('');
                removeTagSpinner();
            }
        });
    },
    getStateDistictVillageName: function (stateCode, districtCode, villageCode, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!districtCode || !stateCode || !villageCode) {
            return;
        }
        $.ajax({
            url: 'ncl_certificate/get_name_data_for_ncl_certificate',
            type: 'post',
            data: $.extend({}, {'state_code': stateCode, 'district_code': districtCode, 'village_code': villageCode}, getTokenData()),
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
                showError(textStatus.statusText);
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
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#' + id + '_state_text').val(parseData.state_data[0].state_name + ', ' + parseData.district_data[0].district_name + ', ' + parseData.village_data[0].village_name);
                // $('#' + id + '_district_text').val(parseData.district_data[0].district_name);
                // $('#' + id + '_village_text').val(parseData.village_data[0].village_name);

            }
        });
    },
    getEditVillageData: function (state, districtCode, moduleName, village, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'nc' ? ' ' : '';
        if (!districtCode || !state) {
            return;
        }
        $.ajax({
            url: 'ncl_certificate/get_village_data_for_ncl_certificate',
            type: 'post',
            async: false,
            data: $.extend({}, {'state_code': state, 'district_code': districtCode}, getTokenData()),
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
                showError(textStatus.statusText);
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
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_nc', 'village_code', 'village_name', 'Village');
                $('#' + id + '_village_for_nc').val(village == 0 ? '' : village);

            }
        });
    },
    getDistrictFornDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_district_for_nc');
        var state = obj.val();
        if (!state) {
            return false;
        }
        if (state != VALUE_ONE && state != VALUE_TWO) {
            return false;
        }
        var districtData = state == VALUE_ONE ? damandiudistrictArray : (state == VALUE_TWO ? dnhdistrictArray : []);
        renderOptionsForTwoDimensionalArray(districtData, id + '_district_for_nc');
    },
    getVillageDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_village_for_nc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var districtData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
        renderOptionsForTwoDimensionalArray(districtData, id + '_village_for_nc');
    },
    downloadDeclaration: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var icId = $('#ncl_certificate_id_for_nc_declaration').val();
        if (!icId) {
            validationMessageShow('ncl-certificate-declaration_for_ncl_certificate', invalidAccessValidationMessage);
            return false;
        }
        $('#nc_declaration_pdf').submit();
    },
    villageDMCChangeEvent: function () {
        var district = $('#district').val();
        var villageCode = $('#village_name_for_nc').val();
        var villageData = (district == VALUE_ONE ? damanVillagesArray[villageCode] : (district == VALUE_TWO ? diuVillagesArray[villageCode] : (district == VALUE_THREE ? dnhVillagesArray[villageCode] : [])));
        $('#com_addr_village_dmc_ward_for_nc').val(villageData);

        $("#billingtoo_for_nc").prop('checked', false);
        $('#per_addr_village_dmc_ward_for_nc').val('');
        $('#per_addr_city_for_nc').val('');
        $('#per_pincode_for_nc').val('');

        if (district == VALUE_ONE) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_nc');
            renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_nc');

            if (jQuery.inArray(villageCode, naniDamanVillageArray) != '-1') {
                $('#com_addr_city_for_nc').val(damanCityArray[VALUE_ONE]);
                var city_code = VALUE_ONE;

            } else if (jQuery.inArray(villageCode, motiDamanVillageArray) != '-1') {
                $('#com_addr_city_for_nc').val(damanCityArray[VALUE_TWO]);
                var city_code = VALUE_TWO;
            }

            var pincodeData = damanCityPincodeArray[city_code];
            $('#pincode_for_nc').val(pincodeData);
            $('#com_pincode_for_nc').val(pincodeData);

            generateSelect2();
        } else if (district == VALUE_TWO) {
            renderOptionsForTwoDimensionalArray(diuCityArray, 'com_addr_city_for_nc');
            renderOptionsForTwoDimensionalArray(diuCityArray, 'per_addr_city_for_nc');
            $('#com_addr_city_for_nc').val(diuCityArray[VALUE_ONE]);
            $('#pincode_for_nc').val('');
            $('#com_pincode_for_nc').val('');

        } else if (district == VALUE_THREE) {
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'com_addr_city_for_nc');
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'per_addr_city_for_nc');
            $('#com_addr_city_for_nc').val(dnhCityArray[VALUE_ONE]);
            $('#pincode_for_nc').val('');
            $('#com_pincode_for_nc').val('');
        }
    },
    getPincode: function () {
        var city_code = $('#com_addr_city_for_nc').val();
        var pincodeData = damanCityPincodeArray[city_code];
        $('#pincode_for_nc').val(pincodeData);
        $('#com_pincode_for_nc').val(pincodeData);

        var per_city_code = $('#per_addr_city_for_nc').val();
        var pincodeData = damanCityPincodeArray[per_city_code];
        $('#per_pincode_for_nc').val(pincodeData);
    },
    downloadExcelForNC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_ncge').val($('#app_no_for_ncl_certificate_list').val());
        $('#app_date_for_ncge').val($('#app_date_for_ncl_certificate_list').val());
        $('#app_details_for_ncge').val($('#app_details_for_ncl_certificate_list').val());
        $('#vdw_for_ncge').val(tempTypeInSession != TEMP_TYPE_A ? $('#vdw_for_ncl_certificate_list').val() : '');
        $('#status_for_ncge').val($('#status_for_ncl_certificate_list').val());
        $('#qstatus_for_ncge').val($('#query_status_for_ncl_certificate_list').val());
        $('#app_status_for_ncge').val($('#appointment_status_for_ncl_certificate_list').val());
        $('#currently_on_for_ncge').val($('#currently_on_for_ncl_certificate_list').val());
        $('#generate_excel_for_ncl_certificate').submit();
        $('.ncge').val('');
    },
    addVerificationDocItem: function (docData, moduleId) {
        var that = this;
        docData.cnt = verifyDocCnt;
        docData.verification_type = moduleId;
        $('#upload_verification_doc_item_container_for_ncl_certificate_' + moduleId).append(nclCertificateFieldVerificationDocItemTemplate(docData));
        if (docData.document) {
            that.loadDRDocument('document', verifyDocCnt, docData);
        }
        resetCounter('verification-document-cnt');
        verifyDocCnt++;
    },
    uploadDocForFieldVerification: function (tempCnt) {
        var that = this;
        var id = 'document_for_verification_document_' + tempCnt;
        var doc = $('#' + id).val();
        if (doc == '') {
            return false;
        }
        validationMessageHide();
        var docMessage = fileUploadValidation(id, 20480);
        if (docMessage != '') {
            showError(docMessage);
            return false;
        }
        $('#document_container_for_verification_document_' + tempCnt).hide();
        $('#document_name_container_for_verification_document_' + tempCnt).hide();
        $('#spinner_template_for_verification_document_' + tempCnt).show();
        //openFullPageOverlay();
        var formData = new FormData();
        formData.append('ncl_certificate_id_for_ncl_certificate_update_basic_detail', $('#ncl_certificate_id_for_ncl_certificate_update_basic_detail').val());
        formData.append('field_document_id_for_field_verification', $('#field_document_id_for_field_verification_' + tempCnt).val());
        formData.append('verification_type_for_field_verification', $('#verification_type_for_field_verification_' + tempCnt).val());
        formData.append('document_for_verification_document', $('#' + id)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/upload_field_verification_document',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function (textStatus, errorThrown) {
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                $('#spinner_template_for_verification_document_' + tempCnt).hide();
                $('#document_container_for_verification_document_' + tempCnt).show();
                $('#document_name_container_for_verification_document_' + tempCnt).hide();
                //closeFullPageOverlay();
                $('#' + id).val('');
                showError(textStatus.statusText);
            },
            success: function (data) {
                //closeFullPageOverlay();
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    $('#spinner_template_for_verification_document_' + tempCnt).hide();
                    $('#document_container_for_verification_document_' + tempCnt).show();
                    $('#document_name_container_for_verification_document_' + tempCnt).hide();
                    $('#' + id).val('');
                    showError(parseData.message);
                    return false;
                }
                $('#spinner_template_for_verification_document_' + tempCnt).hide();
                $('#document_name_container_for_verification_document_' + tempCnt).hide();
                $('#' + id).val('');
                $('#field_document_id_for_field_verification_' + tempCnt).val(parseData.field_verification_document_id);
                var docItemData = {};
                docItemData.field_verification_document_id = parseData.field_verification_document_id;
                docItemData.document = parseData.document_name;
                that.loadDRDocument('document', tempCnt, docItemData);
            }
        });
    },
    loadDRDocument: function (documentFieldName, cnt, docItemData) {
        $('#' + documentFieldName + '_container_for_verification_document_' + cnt).hide();
        $('#' + documentFieldName + '_name_container_for_verification_document_' + cnt).show();
        $('#' + documentFieldName + '_name_href_for_verification_document_' + cnt).attr('href', 'documents/ncl_certificate/' + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_verification_document_' + cnt).html(VIEW_UPLODED_DOCUMENT);
        $('#' + documentFieldName + '_remove_btn_for_verification_document_' + cnt).attr('onclick', 'NclCertificate.listview.askForRemoveDocForFieldVerification("' + docItemData.field_verification_document_id + '","' + cnt + '")');
    },
    askForRemoveDocForFieldVerification: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'NclCertificate.listview.removeFieldDoc(' + fieldDocumentId + ', ' + cnt + ')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeFieldDoc: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/remove_field_document',
            data: $.extend({}, {'field_document_id': fieldDocumentId}, getTokenData()),
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
                    showError(parseData.message);
                    return false;
                }
                $('.stack-bar-bottom').hide();
                showSuccess(parseData.message);
                removeDocument('document', 'verification_document_' + cnt);
            }
        });
    },
    askForRemoveDocItemForFieldVerification: function (cnt) {
        var that = this;
        var fieldDocumentId = $('#field_document_id_for_field_verification_' + cnt).val();
        if (!fieldDocumentId || fieldDocumentId == 0 || fieldDocumentId == null) {
            that.removeFieldItem(cnt);
            return false;
        }
        var yesEvent = 'NclCertificate.listview.removeFieldItemRow(' + cnt + ')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeFieldItem: function (cnt) {
        $('#verification_document_row_' + cnt).remove();
        resetCounter('verification-document-cnt');
    },
    removeFieldItemRow: function (cnt) {
        var fieldDocumentId = $('#field_document_id_for_field_verification_' + cnt).val();
        if (!fieldDocumentId || fieldDocumentId == 0 || fieldDocumentId == null) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        $.ajax({
            type: 'POST',
            url: 'ncl_certificate/remove_field_document_item',
            data: $.extend({}, {'field_verification_document_id': fieldDocumentId}, getTokenData()),
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
                    showError(parseData.message);
                    return false;
                }
                that.removeFieldItem(cnt);
                showSuccess(parseData.message);
            }
        });
    },
    loadFieldDocumentView: function (fieldData, moduleId) {
        var that = this;
        if ($.isEmptyObject(fieldData.field_documents)) {
            //$('#document_item_container_for_field_verification_view_' + moduleId).append('<tr><td colspan="3" class="text-center">No Data Available !</td></tr>');
            $('.field_varification_doc_title').hide();
            $('.field_varification_doc_tbl').hide();
        } else {
            $.each(fieldData.field_documents, function (index, docDetail) {
                docDetail.cnt = (index + 1);
                docDetail.moduleId = 'field_verification';
                $('#document_item_container_for_field_verification_view_' + moduleId).append(nclCertificateFieldVerificationViewDocItemTemplate(docDetail));
                if (docDetail['document'] != '') {
                    that.loadFieldDocForView(docDetail.cnt, 'document', 'field_verification', docDetail.document);
                }
            });
        }
    },
    loadFieldReverifyDocumentView: function (fieldData, moduleId) {
        var that = this;
        if ($.isEmptyObject(fieldData.field_reverify_documents)) {
            //$('#document_item_container_for_field_verification_view_' + moduleId).append('<tr><td colspan="3" class="text-center">No Data Available !</td></tr>');
            $('.field_revarification_doc_title').hide();
            $('.field_revarification_doc_tbl').hide();
        } else {
            $.each(fieldData.field_reverify_documents, function (index, reDocDetail) {
                reDocDetail.cnt = (index + 1);
                reDocDetail.moduleId = 'field_reverification';
                $('#document_item_container_for_field_verification_view_' + moduleId).append(nclCertificateFieldVerificationViewDocItemTemplate(reDocDetail));
                if (reDocDetail['document'] != '') {
                    that.loadFieldDocForView(reDocDetail.cnt, 'document', 'field_reverification', reDocDetail.document);
                }
            });
        }
    },
    loadFieldDocForView: function (tempCnt, id, moduleType, docField) {
        $('#' + id + '_container_for_' + moduleType + '_view_' + tempCnt).hide();
        $('#' + id + '_name_container_for_' + moduleType + '_view_' + tempCnt).show();
        $('#' + id + '_name_href_for_' + moduleType + '_view_' + tempCnt).attr('href', 'documents/ncl_certificate/' + docField);
        $('#' + id + '_name_for_' + moduleType + '_view_' + tempCnt).html(VIEW_UPLODED_DOCUMENT);
    },
});
