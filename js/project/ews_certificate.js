var ewsCertificateListTemplate = Handlebars.compile($('#ews_certificate_list_template').html());
var ewsCertificateSearchTemplate = Handlebars.compile($('#ews_certificate_search_template').html());
var ewsCertificateTableTemplate = Handlebars.compile($('#ews_certificate_table_template').html());
var ewsCertificateActionTemplate = Handlebars.compile($('#ews_certificate_action_template').html());
var ewsCertificateFormTemplate = Handlebars.compile($('#ews_certificate_form_template').html());
var ewsCertificateViewTemplate = Handlebars.compile($('#ews_certificate_view_template').html());
var ewsCertificateApproveTemplate = Handlebars.compile($('#ews_certificate_approve_template').html());
var ewsCertificateRejectTemplate = Handlebars.compile($('#ews_certificate_reject_template').html());
var ewsCertificateAppointmentTemplate = Handlebars.compile($('#ews_certificate_set_appointment_template').html());
var ewsCertificateUpdateBasicDetailTemplate = Handlebars.compile($('#ews_certificate_update_basic_detail_template').html());
var ewsCertificateIncomeCertyInfoTemplate = Handlebars.compile($('#ews_certificate_income_certy_info_template').html());
var ewstypeMajorEwsCertificateFormTemplate = Handlebars.compile($('#ews_type_major_ews_certificate_form_template').html());
var ewstypeMinorEwsCertificateFormTemplate = Handlebars.compile($('#ews_type_minor_ews_certificate_form_template').html());
var ewsCertificateSiblingBroIncomeTemplate = Handlebars.compile($('#ews_certificate_sibling_bro_income_template').html());
var ewsCertificateSiblingSisIncomeTemplate = Handlebars.compile($('#ews_certificate_sibling_sis_income_template').html());
var ewsCertificateSonIncomeTemplate = Handlebars.compile($('#ews_certificate_son_income_template').html());
var ewsCertificateDaughterIncomeTemplate = Handlebars.compile($('#ews_certificate_daughter_income_template').html());
var ewsCertificateSiblingBroInfoTemplate = Handlebars.compile($('#ews_certificate_sibling_bro_info_template').html());
var ewsCertificateSiblingSisInfoTemplate = Handlebars.compile($('#ews_certificate_sibling_sis_info_template').html());
var ewsCertificateChildrenSonInfoTemplate = Handlebars.compile($('#ews_certificate_children_son_info_template').html());
var ewsCertificateChildrenDaughterInfoTemplate = Handlebars.compile($('#ews_certificate_children_daughter_info_template').html());
var ewsFieldVerificationDocItemTemplate = Handlebars.compile($('#ews_certificate_field_verification_document_template').html());
var ewsFieldVerificationViewDocItemTemplate = Handlebars.compile($('#ews_certificate_field_verification_view_document_template').html());
var ewsCertificateBirthStayPeriodInfoTemplate = Handlebars.compile($('#detail_of_birth_stay_period_template').html());

var tempVillageDataForEC = [];
var tempPersonCnt = 1;
var tempIncomeCertyCnt = 1;
var tempSiblingBroCnt = 1;
var tempSiblingSisCnt = 1;
var tempChildrenSonCnt = 1;
var tempChildrenDaughterCnt = 1;
var tempSiblingBroIncomeCnt = 1;
var tempSiblingSisIncomeCnt = 1;
var tempSonIncomeCnt = 1;
var tempDaughterIncomeCnt = 1;
var verifyDocCnt = 1;
var tempBirthStayPeriodCnt = 1;
var searchECF = {};

var EwsCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
EwsCertificate.Router = Backbone.Router.extend({
    routes: {
        'ews_certificate': 'renderList',
        'ews_certificate_form': 'renderListForForm',
        'edit_ews_certificate_form': 'renderList',
        'view_ews_certificate_form': 'renderList',
        'type_major_ews_certificate_form': 'renderListForTypeOne',
        'edit_type_major_ews_certificate_form': 'renderList',
        'type_minor_ews_certificate_form': 'renderListForTypeTwoA',
        'edit_type_minor_ews_certificate_form': 'renderList',

    },
    renderList: function () {
        EwsCertificate.listview.listPage();
    },
    renderListForForm: function () {
        EwsCertificate.listview.listPageEwsCertificateForm();
    },
    renderListForTypeOne: function () {
        EwsCertificate.listview.listPageTypeMajorEwsCertificateForm();
    },
    renderListForTypeTwoA: function () {
        EwsCertificate.listview.listPageTypeMinorEwsCertificateForm();
    },

});
EwsCertificate.listView = Backbone.View.extend({
    el: 'div#main_container',
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
        addClass('menu_ews_certificate', 'active');
        EwsCertificate.router.navigate('ews_certificate');
        var templateData = {};
        searchECF = {};
        this.$el.html(ewsCertificateListTemplate(templateData));
        this.loadEwsCertificateData(sDistrict, sType);

    },
    listPageTypeMajorEwsCertificateForm: function () {
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
        activeLink('menu_mamlatdar');
        addClass('mam_ews_certificate', 'active');
        this.$el.html(ewsCertificateListTemplate);
        this.typeMajorEwsCertificateForm(false, {});
    },
    listPageTypeMinorEwsCertificateForm: function () {
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
        activeLink('menu_mamlatdar');
        addClass('mam_ews_certificate', 'active');
        this.$el.html(ewsCertificateListTemplate);
        this.typeMinorEwsCertificateForm(false, {});
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
            rowData.show_approve_btn = '';
        } else {
            rowData.show_approve_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) &&
                (rowData.status == VALUE_TWO || rowData.status == VALUE_THREE || rowData.status == VALUE_FIVE ||
                        rowData.status == VALUE_SIX) && (rowData.query_status == VALUE_ZERO ||
                rowData.query_status == VALUE_THREE)) {
            if (rowData.aci_rec != VALUE_TWO) {
                rowData.show_reverification_btn = 'display: none;';
            } else {
                rowData.show_reverification_btn = '';
            }
        } else {
            rowData.show_reverification_btn = 'display: none;';
        }
        rowData.module_type = VALUE_SEVEN;
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

        return ewsCertificateActionTemplate(rowData);
    },

    getAppointmentData: function (appointmentData) {
        var onlineStatement = appointmentData.online_statement == VALUE_ONE ? 'Online Statement' : '';
        var visitOffice = appointmentData.visit_office == VALUE_ONE ? 'Visit Office' : '';
        if (appointmentData.appointment_date == '0000-00-00') {
            return '<span id="appointment_container_' + appointmentData.ews_certificate_id + '" class="badge bg-warning app-status">Appointment Not Scheduled By Talathi</span>';
        }
        var returnString = '<span id="appointment_container_' + appointmentData.ews_certificate_id + '"><span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">' + onlineStatement;
        if (onlineStatement != '' && visitOffice != '') {
            returnString += ',<br>';
        }
        returnString += (visitOffice + '</span>');
        return returnString;
    },
    loadEwsCertificateData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        EwsCertificate.router.navigate('ews_certificate');
        var searchData = dtomMam(sDistrict, sType, 'EwsCertificate.listview.loadEwsCertificateData();');
        $('#ews_certificate_form_and_datatable_container').html(ewsCertificateSearchTemplate(searchData));
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            renderOptionsForTwoDimensionalArray(appointmentFilterArray, 'appointment_status_for_ews_certificate_list', false);
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(currentlyOnTypeArray, 'currently_on_for_ews_certificate_list', false);
        }


        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_ews_certificate_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_ews_certificate_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_ews_certificate_list', false);
        datePickerId('application_date_for_ews_certificate_list');

        if (tempTypeInSession != TEMP_TYPE_A) {
            var dwVillagesData = (tempDistrictInSession == VALUE_ONE ? damanVillagesArray : (tempDistrictInSession == VALUE_TWO ? diuVillagesArray : (tempDistrictInSession == VALUE_THREE ? dnhVillagesArray : [])));
            if (tempAVInSession != '') {
                var avData = tempAVInSession.split(',');
                renderOptionsForAVArray(avData, dwVillagesData, 'vdw_for_ews_certificate_list', false);
            } else {
                renderOptionsForTwoDimensionalArray(dwVillagesData, 'vdw_for_ews_certificate_list', false);
            }
        } else {
            if (typeof searchECF.district_for_ews_certificate_list != "undefined" && searchECF.district_for_ews_certificate_list != '' && searchECF.village_for_ews_certificate_list != '') {
                var villageData = (searchECF.district_for_ews_certificate_list == VALUE_ONE ? damanVillagesArray : (searchECF.district_for_ews_certificate_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_ews_certificate_list', false);
            }
        }

        $('#app_no_for_ews_certificate_list').val((typeof searchECF.app_no_for_ews_certificate_list != "undefined" && searchECF.app_no_for_ews_certificate_list != '') ? searchECF.app_no_for_ews_certificate_list : '');
        $('#application_date_for_ews_certificate_list').val((typeof searchECF.application_date_for_ews_certificate_list != "undefined" && searchECF.application_date_for_ews_certificate_list != '') ? searchECF.application_date_for_ews_certificate_list : searchData.s_appd);
        $('#app_details_for_ews_certificate_list').val((typeof searchECF.app_details_for_ews_certificate_list != "undefined" && searchECF.app_details_for_ews_certificate_list != '') ? searchECF.app_details_for_ews_certificate_list : '');
        $('#appointment_status_for_ews_certificate_list').val((typeof searchECF.appointment_status_for_ews_certificate_list != "undefined" && searchECF.appointment_status_for_ews_certificate_list != '') ? searchECF.appointment_status_for_ews_certificate_list : searchData.s_app_status);
        $('#query_status_for_ews_certificate_list').val((typeof searchECF.query_status_for_ews_certificate_list != "undefined" && searchECF.query_status_for_ews_certificate_list != '') ? searchECF.query_status_for_ews_certificate_list : searchData.s_qstatus);
        $('#status_for_ews_certificate_list').val((typeof searchECF.status_for_ews_certificate_list != "undefined" && searchECF.status_for_ews_certificate_list != '') ? searchECF.status_for_ews_certificate_list : searchData.s_status);
        $('#currently_on_for_ews_certificate_list').val((typeof searchECF.currently_on_for_ews_certificate_list != "undefined" && searchECF.currently_on_for_ews_certificate_list != '') ? searchECF.currently_on_for_ews_certificate_list : searchData.s_co_hand);
        $('#district_for_ews_certificate_list').val((typeof searchECF.district_for_ews_certificate_list != "undefined" && searchECF.district_for_ews_certificate_list != '') ? searchECF.district_for_ews_certificate_list : searchData.search_district);
        $('#vdw_for_ews_certificate_list').val((typeof searchECF.vdw_for_ews_certificate_list != "undefined" && searchECF.vdw_for_ews_certificate_list != '') ? searchECF.vdw_for_ews_certificate_list : '');
        $('#is_full_for_ews_certificate_list').val((typeof searchECF.is_full_for_ews_certificate_list != "undefined" && searchECF.is_full_for_ews_certificate_list != '') ? searchECF.is_full_for_ews_certificate_list : searchData.s_is_full);

        this.searchEwsCertificateData();
        allowOnlyIntegerValue('mobile_number_for_ews_certificate_list');

    },
    searchEwsCertificateData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#ews_certificate_datatable_container').html(ewsCertificateTableTemplate);
        var searchData = $('#search_ews_certificate_form').serializeFormJSON();

        searchECF = searchData;
        if (typeof btnObj == "undefined" && (searchECF.app_details_for_ews_certificate_list == ''
                && searchECF.app_no_for_ews_certificate_list == ''
                && searchECF.application_date_for_ews_certificate_list == ''
                && searchECF.appointment_status_for_ews_certificate_list == ''
                && searchECF.query_status_for_ews_certificate_list == ''
                && searchECF.status_for_ews_certificate_list == ''
                && searchECF.is_full_for_ews_certificate_list == ''
                && (searchECF.district_for_ews_certificate_list == '' || typeof searchECF.district_for_ews_certificate_list == "undefined")
                && (searchECF.vdw_for_ews_certificate_list == '' || typeof searchECF.vdw_for_ews_certificate_list == "undefined")
                && (searchECF.currently_on_for_ews_certificate_list == '' || typeof searchECF.currently_on_for_ews_certificate_list == "undefined"))) {
            ewsCertificateDataTable = $('#ews_certificate_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#ews_certificate_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.com_addr_house_no + ', ' + full.com_addr_house_name + ', ' + full.com_addr_street + ',' + full.com_addr_village_dmc_ward + ', ' + (damanCityArray[full.com_addr_city] == undefined ? full.com_addr_city : damanCityArray[full.com_addr_city]) + ', ' + (full.com_pincode == '0' ? full.pincode : full.com_pincode) + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + (full.mobile_number == '' ? full.guardian_mobile_no : full.mobile_number) + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? damanVillagesArray : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village_name] ? villageData[full.village_name] : '');
        };
        var appointmentRenderer = function (data, type, full, meta) {
            return '<div id="appointment_container_' + data + '">' + that.getAppointmentData(full) + '</div>';
        };
        var movementRenderer = function (data, type, full, meta) {
            return '<div id="movement_for_ec_list_' + data + '">' + movementString(full) + '</div>';
        };
        $('#ews_certificate_datatable_container').html(ewsCertificateTableTemplate);
        ewsCertificateDataTable = $('#ews_certificate_datatable').DataTable({
            ajax: {
                url: 'ews_certificate/get_ews_certificate_data',
                dataSrc: "ews_certificate_data",
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
                {data: 'ews_certificate_id', 'class': 'v-a-t text-center', 'render': appointmentRenderer},
                {data: 'ews_certificate_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'ews_certificate_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'ews_certificate_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "fnRowCallback": aciNR,
            "initComplete": searchableDatatable
        });

        $('#ews_certificate_datatable_filter').remove();
        $('#ews_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = ewsCertificateDataTable.row(tr);

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
    typeMajorEwsCertificateForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.ews_certificate_data;
            EwsCertificate.router.navigate('edit_type_major_ews_certificate_form');
        } else {
            showCertAppInstruction();
            var formData = {};
            EwsCertificate.router.navigate('type_major_ews_certificate_form');
        }

        tempVillageDataForEC = [];
        tempIncomeCertyCnt = 1;
        tempSiblingBroCnt = 1;
        tempSiblingSisCnt = 1;
        tempChildrenSonCnt = 1;
        tempChildrenDaughterCnt = 1;
        tempSiblingBroIncomeCnt = 1;
        tempSiblingSisIncomeCnt = 1;
        tempSonIncomeCnt = 1;
        tempDaughterIncomeCnt = 1;
        tempBirthStayPeriodCnt = 1;
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
        templateData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        templateData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        templateData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        templateData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        templateData.VALUE_EIGHTEEN = VALUE_EIGHTEEN;
        templateData.VALUE_NINETEEN = VALUE_NINETEEN;
        templateData.VALUE_TWENTY = VALUE_TWENTY;
        templateData.VALUE_TWENTYONE = VALUE_TWENTYONE;
        templateData.VALUE_TWENTYTWO = VALUE_TWENTYTWO;
        templateData.VALUE_TWENTYTHREE = VALUE_TWENTYTHREE;
        templateData.VALUE_TWENTYFOUR = VALUE_TWENTYFOUR;
        templateData.VALUE_TWENTYFIVE = VALUE_TWENTYFIVE;
        templateData.VALUE_TWENTYSIX = VALUE_TWENTYSIX;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.ews_certificate_data = parseData.ews_certificate_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            if (templateData['ews_certificate_data'].status != VALUE_FIVE && templateData['ews_certificate_data'].status != VALUE_SIX && templateData['ews_certificate_data'].query_status == VALUE_ONE) {
                templateData.show_submit_qr_details = true;
            }
        }
        $('#ews_certificate_form_and_datatable_container').html(ewstypeMajorEwsCertificateFormTemplate(templateData));

        //--------------------------------------------
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district');
        generateBoxes('radio', genderArray, 'gender', 'ec', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'ec', formData.marital_status, false, false);
        generateBoxes('radio', yesNoArray, 'reservation_cast_list', 'ews_certificate', formData.reservation_cast_list, false, false);
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'ews_certificate', formData.have_you_own_house, false, false);
        showSubContainer('have_you_own_house', 'ews_certificate', '.house_tax_receipt_item', VALUE_ONE, 'radio');
        showSubContainer('have_you_own_house', 'ews_certificate', '.noc_with_notary_item', VALUE_TWO, 'radio');
        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_ec');
        renderOptionsForTwoDimensionalArray(ewsOccupationArray, 'occupation_for_ec');
        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'native_place_village_for_ec');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_ec');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'apllicant_sc_subcaste_for_ec');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'apllicant_st_subcaste_for_ec');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'present_add_state_for_ec', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'per_addr_state_for_ec', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_ec', 'state_code', 'state_name', 'State/UT');

        if (isEdit) {
            $('#present_add_state_for_ec').val(formData.present_add_state == 0 ? '' : formData.present_add_state);

            var districtData = tempDistrictData[formData.present_add_state] ? tempDistrictData[formData.present_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'present_add_district_for_ec', 'district_code', 'district_name', 'District');
            $('#present_add_district_for_ec').val(formData.present_add_district == 0 ? '' : formData.present_add_district);

            that.getEditVillageData(formData.present_add_state, formData.present_add_district, 'ec', formData.present_add_village, 'present_add');
            $('#present_add_village_for_ec').val(formData.present_add_village);

            $('#born_place_state_for_ec').val(formData.born_place_state == 0 ? '' : formData.born_place_state);

            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_ec', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_ec').val(formData.born_place_district == 0 ? '' : formData.born_place_district);

            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'ec', formData.born_place_village, 'born_place');
            $('#born_place_village_for_ec').val(formData.born_place_village);

            $('#per_addr_state_for_ec').val(formData.per_addr_state == 0 ? '' : formData.per_addr_state);
            var districtData = tempDistrictData[formData.per_addr_state] ? tempDistrictData[formData.per_addr_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_addr_district_for_ec', 'district_code', 'district_name', 'District');
            $('#per_addr_district_for_ec').val(formData.per_addr_district == 0 ? '' : formData.per_addr_district);

            tempVillageDataForEC = formData.per_addr_village_data;
            that.getEditVillageData(formData.per_addr_state, formData.per_addr_district, 'ec', formData.per_addr_village, 'Village');
            $('#per_addr_village_for_ec').val(formData.per_addr_village);

            $('#select_required_purpose_for_ec').val(formData.select_required_purpose);
            $('#village_name_for_ec').val(formData.village_name);

            if (formData.billingtoo == isChecked) {
                $('#billingtoo_for_ec').attr('checked', 'checked');
            }

            $('.family_info_div').collapse().show();
            if (formData.marital_status == VALUE_ONE)
                $('.spouse_info_div').collapse().show();

            $('#declaration_for_ews_certificate').attr('checked', 'checked');
            $('#declaration').attr('checked', 'checked');
            $('#occupation_for_ec').val(formData.occupation);
            $('#nearest_police_station_for_ec').val(formData.nearest_police_station);

            if (formData.occupation == VALUE_FOUR) {
                $('.other_occupation_div_for_ec').show();
            }
            $('#district').val(formData.district);

            if (formData.applicant_caste == VALUE_ONE) {
                $('.applicant_caste_sc_item_container_for_ews_certificate').collapse().show();
                $('#apllicant_sc_subcaste_for_ec').val(formData.apllicant_sc_subcaste);
            } else {
                $('.applicant_caste_st_item_container_for_ews_certificate').collapse().show();
                $('#apllicant_st_subcaste_for_ec').val(formData.apllicant_st_subcaste);
            }

            $('#declaration_for_ews_certificate').attr('checked', 'checked');

            var cnt = 1;
            if (formData.income_certy_details != '') {
                var memberDetails = JSON.parse(formData.income_certy_details);
                if (memberDetails != null) {
                    $.each(memberDetails, function (key, value) {
                        that.addIncomeCertyInfo(value, true);
                        issue_date = dateTo_DD_MM_YYYY(value.issue_date);
                        $('#issue_date_' + cnt).val(value.issue_date);
                        valid_up_to_date = dateTo_DD_MM_YYYY(value.valid_up_to_date);
                        $('#valid_up_to_date_' + cnt).val(value.valid_up_to_date);
                        cnt++;
                    });
                } else {
                    that.addIncomeCertyInfo({}, true);
                }
            }

            var cntbro = 1;
            if (formData.sibling_bro_details != '') {
                var memberDetails1 = JSON.parse(formData.sibling_bro_details);
                if (memberDetails1 != null) {
                    $.each(memberDetails1, function (key, value) {
                        that.addSiblingBroInfo(value, true);
                        cntbro++;
                    });
                } else {
                    that.addSiblingBroInfo({}, true);
                }
            }

            var cntsis = 1;
            if (formData.sibling_sis_details != '') {
                var memberDetails2 = JSON.parse(formData.sibling_sis_details);
                if (memberDetails2 != null) {
                    $.each(memberDetails2, function (key, value) {
                        that.addSiblingSisInfo(value, true);
                        cntsis++;
                    });
                } else {
                    that.addSiblingSisInfo({}, true);
                }
            }

            var cntson = 1;
            if (formData.son_details != '') {
                var memberDetails3 = JSON.parse(formData.son_details);
                if (memberDetails3 != null) {
                    $.each(memberDetails3, function (key, value) {
                        that.addChildrenSonInfo(value, true);
                        cntson++;
                    });
                } else {
                    that.addChildrenSonInfo({}, true);
                }
            }

            var cntdaughter = 1;
            if (formData.daughter_details != '') {
                var memberDetails4 = JSON.parse(formData.daughter_details);
                if (memberDetails4 != null) {
                    $.each(memberDetails4, function (key, value) {
                        that.addChildrenDaughterInfo(value, true);
                        cntdaughter++;
                    });
                } else {
                    that.addChildrenDaughterInfo({}, true);
                }
            }

            var cntincomebro = 1;
            if (formData.sibling_broincome_details != '') {
                var memberDetails5 = JSON.parse(formData.sibling_broincome_details);
                if (memberDetails5 != null) {
                    $.each(memberDetails5, function (key, value) {
                        that.addSiblingBroIncome(value, true);
                        cntincomebro++;
                    });
                } else {
                    that.addSiblingBroIncome({}, true);
                }
            }


            var cntincomesis = 1;
            if (formData.sibling_sisincome_details != '') {
                var memberDetails6 = JSON.parse(formData.sibling_sisincome_details);
                if (memberDetails6 != null) {
                    $.each(memberDetails6, function (key, value) {
                        that.addSiblingSisIncome(value, true);
                        cntincomesis++;
                    });
                } else {
                    that.addSiblingSisIncome({}, true);
                }
            }

            var cntincomeson = 1;
            if (formData.sonincome_details != '') {
                var memberDetails7 = JSON.parse(formData.sonincome_details);
                if (memberDetails7 != null) {
                    $.each(memberDetails7, function (key, value) {
                        that.addSonIncome(value, true);
                        cntincomeson++;
                    });
                } else {
                    that.addSonIncome({}, true);
                }
            }

            var cntincomedaughter = 1;
            if (formData.daughterincome_details != '') {
                var memberDetails8 = JSON.parse(formData.daughterincome_details);
                if (memberDetails8 != null) {
                    $.each(memberDetails8, function (key, value) {
                        that.addDaughterIncome(value, true);
                        cntincomedaughter++;
                    });
                } else {
                    that.addDaughterIncome({}, true);
                }
            }

            var cntbps = 1;
            if (formData.birth_stay_place_details != '') {
                var birthStayPlace = JSON.parse(formData.birth_stay_place_details);
                if (birthStayPlace != null) {
                    $.each(birthStayPlace, function (key, value) {
                        that.addBirthStayPeriodInfo(value, true);
                        $('#born_place_state_for_ec_' + cntbps).val(value.born_place_state);
                        var districtData = tempDistrictData[value.born_place_state] ? tempDistrictData[value.born_place_state] : [];
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_ec_' + cntbps, 'district_code', 'district_name', 'District');
                        $('#born_place_district_for_ec_' + cntbps).val(value.born_place_district);
                        that.getEditVillageData(value.born_place_state, value.born_place_district, 'EWS', value.born_place_village, 'born_place_village_for_ec_' + cntbps);
                        $('#born_place_village_for_ec_' + cntbps).val(value.born_place_village);
                        cntbps++;
                    });
                } else {
                    that.addBirthStayPeriodInfo({}, true);
                }
            }

            //------------------------------------------
            that.getYearlyIncomeTotal();
            var val = formData.constitution_artical;


            if (formData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_ews_certificate', 'applicant_photo_doc_name_image_for_ews_certificate', 'applicant_photo_doc_name_container_for_ews_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.ews_certificate_id, VALUE_ONE);
            }
            if (formData.birth_certificate_doc != '') {
                that.showDocument('birth_certificate_doc_container_for_ews_certificate', 'birth_certificate_doc_name_image_for_ews_certificate', 'birth_certificate_doc_name_container_for_ews_certificate',
                        'birth_certificate_doc_download', 'birth_certificate_doc', formData.birth_certificate_doc, formData.ews_certificate_id, VALUE_TWO);
            }
            if (formData.leaving_certificate_doc != '') {
                that.showDocument('leaving_certificate_doc_container_for_ews_certificate', 'leaving_certificate_doc_name_image_for_ews_certificate', 'leaving_certificate_doc_name_container_for_ews_certificate',
                        'leaving_certificate_doc_download', 'leaving_certificate_doc', formData.leaving_certificate_doc, formData.ews_certificate_id, VALUE_THREE);
            }

            if (formData.election_card_doc != '') {
                that.showDocument('election_card_doc_container_for_ews_certificate', 'election_card_doc_name_image_for_ews_certificate', 'election_card_doc_name_container_for_ews_certificate',
                        'election_card_doc_download', 'election_card_doc', formData.election_card_doc, formData.ews_certificate_id, VALUE_FOUR);
            }
            if (formData.father_election_card_doc != '') {
                that.showDocument('father_election_card_doc_container_for_ews_certificate', 'father_election_card_doc_name_image_for_ews_certificate', 'father_election_card_doc_name_container_for_ews_certificate',
                        'father_election_card_doc_download', 'father_election_card_doc', formData.father_election_card_doc, formData.ews_certificate_id, VALUE_TWENTY);
            }
            if (formData.mother_election_card_doc != '') {
                that.showDocument('mother_election_card_doc_container_for_ews_certificate', 'mother_election_card_doc_name_image_for_ews_certificate', 'mother_election_card_doc_name_container_for_ews_certificate',
                        'mother_election_card_doc_download', 'mother_election_card_doc', formData.mother_election_card_doc, formData.ews_certificate_id, VALUE_TWENTYONE);
            }

            if (formData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_ews_certificate', 'aadhar_card_doc_name_image_for_ews_certificate', 'aadhar_card_doc_name_container_for_ews_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.ews_certificate_id, VALUE_FIVE);
            }
            if (formData.father_aadhar_card_doc != '') {
                that.showDocument('father_aadhar_card_doc_container_for_ews_certificate', 'father_aadhar_card_doc_name_image_for_ews_certificate', 'father_aadhar_card_doc_name_container_for_ews_certificate',
                        'father_aadhar_card_doc_download', 'father_aadhar_card_doc', formData.father_aadhar_card_doc, formData.ews_certificate_id, VALUE_TWENTYTWO);
            }
            if (formData.mother_aadhar_card_doc != '') {
                that.showDocument('mother_aadhar_card_doc_container_for_ews_certificate', 'mother_aadhar_card_doc_name_image_for_ews_certificate', 'mother_aadhar_card_doc_name_container_for_ews_certificate',
                        'mother_aadhar_card_doc_download', 'mother_aadhar_card_doc', formData.mother_aadhar_card_doc, formData.ews_certificate_id, VALUE_TWENTYTHREE);
            }
            if (formData.community_certificate_doc != '') {
                that.showDocument('community_certificate_doc_container_for_ews_certificate', 'community_certificate_doc_name_image_for_ews_certificate', 'community_certificate_doc_name_container_for_ews_certificate',
                        'community_certificate_doc_download', 'community_certificate_doc', formData.community_certificate_doc, formData.ews_certificate_id, VALUE_SIX);
            }
            if (formData.father_mother_community_certificate_doc != '') {
                that.showDocument('father_mother_community_certificate_doc_container_for_ews_certificate', 'father_mother_community_certificate_doc_name_image_for_ews_certificate', 'father_mother_community_certificate_doc_name_container_for_ews_certificate',
                        'father_mother_community_certificate_doc_download', 'father_mother_community_certificate_doc', formData.father_mother_community_certificate_doc, formData.ews_certificate_id, VALUE_SIXTEEN);
            }
            if (formData.caste_certificate_doc != '') {
                that.showDocument('caste_certificate_doc_container_for_ews_certificate', 'caste_certificate_doc_name_image_for_ews_certificate', 'caste_certificate_doc_name_container_for_ews_certificate',
                        'caste_certificate_doc_download', 'caste_certificate_doc', formData.caste_certificate_doc, formData.ews_certificate_id, VALUE_SEVEN);
            }
            if (formData.father_mother_caste_certificate_doc != '') {
                that.showDocument('father_mother_caste_certificate_doc_container_for_ews_certificate', 'father_mother_caste_certificate_doc_name_image_for_ews_certificate', 'father_mother_caste_certificate_doc_name_container_for_ews_certificate',
                        'father_mother_caste_certificate_doc_download', 'father_mother_caste_certificate_doc', formData.father_mother_caste_certificate_doc, formData.ews_certificate_id, VALUE_SEVENTEEN);
            }
            if (formData.affidativet_immovable_property_doc != '') {
                that.showDocument('affidativet_immovable_property_doc_container_for_ews_certificate', 'affidativet_immovable_property_doc_name_image_for_ews_certificate', 'affidativet_immovable_property_doc_name_container_for_ews_certificate',
                        'affidativet_immovable_property_doc_download', 'affidativet_immovable_property_doc', formData.affidativet_immovable_property_doc, formData.ews_certificate_id, VALUE_EIGHT);
            }
            if (formData.gazeted_copy_doc != '') {
                that.showDocument('gazeted_copy_doc_container_for_ews_certificate', 'gazeted_copy_doc_name_image_for_ews_certificate', 'gazeted_copy_doc_name_container_for_ews_certificate',
                        'gazeted_copy_doc_download', 'gazeted_copy_doc', formData.gazeted_copy_doc, formData.ews_certificate_id, VALUE_NINE);
            }

            if (formData.agricultural_detail_doc != '') {
                that.showDocument('agricultural_detail_doc_container_for_ews_certificate', 'agricultural_detail_doc_name_image_for_ews_certificate', 'agricultural_detail_doc_name_container_for_ews_certificate',
                        'agricultural_detail_doc_download', 'agricultural_detail_doc', formData.agricultural_detail_doc, formData.ews_certificate_id, VALUE_TEN);
            }
            if (formData.incometax_return_doc != '') {
                that.showDocument('incometax_return_doc_container_for_ews_certificate', 'incometax_return_doc_name_image_for_ews_certificate', 'incometax_return_doc_name_container_for_ews_certificate',
                        'incometax_return_doc_download', 'incometax_return_doc', formData.incometax_return_doc, formData.ews_certificate_id, VALUE_ELEVEN);
            }
            if (formData.house_tax_receipt != '') {
                that.showDocument('house_tax_receipt_container_for_ews_certificate', 'house_tax_receipt_name_image_for_ews_certificate', 'house_tax_receipt_name_container_for_ews_certificate',
                        'house_tax_receipt_download', 'house_tax_receipt', formData.house_tax_receipt, formData.ews_certificate_id, VALUE_EIGHTEEN);
            }
            if (formData.sale_deed_copy != '') {
                that.showDocument('sale_deed_copy_container_for_domicile', 'sale_deed_copy_name_image_for_ews_certificate', 'sale_deed_copy_name_container_for_ews_certificate',
                        'sale_deed_copy_download', 'sale_deed_copy', formData.sale_deed_copy, formData.ews_certificate_id, VALUE_NINETEEN);
            }
            if (formData.noc_with_notary != '') {
                that.showDocument('noc_with_notary_container_for_ews_certificate', 'noc_with_notary_name_image_for_ews_certificate', 'noc_with_notary_name_container_for_ews_certificate',
                        'noc_with_notary_download', 'noc_with_notary', formData.noc_with_notary, formData.ews_certificate_id, VALUE_TWENTYFIVE);
            }
            if (formData.aggriment_with_notary != '') {
                that.showDocument('aggriment_with_notary_container_for_ews_certificate', 'aggriment_with_notary_name_image_for_ews_certificate', 'aggriment_with_notary_name_container_for_ews_certificate',
                        'aggriment_with_notary_download', 'aggriment_with_notary', formData.aggriment_with_notary, formData.ews_certificate_id, VALUE_TWENTYSIX);
            }
            if (formData.other_doc != '') {
                that.showDocument('other_doc_container_for_ews_certificate', 'other_doc_name_image_for_ews_certificate', 'other_doc_name_container_for_ews_certificate',
                        'other_doc_download', 'other_doc', formData.other_doc, formData.ews_certificate_id, VALUE_TWELVE);
            }

        } else {
            that.addIncomeCertyInfo({}, true);
            that.addSiblingBroInfo({}, true);
            that.addSiblingSisInfo({}, true);
            that.addChildrenSonInfo({}, true);
            that.addChildrenDaughterInfo({}, true);
            that.addSiblingBroIncome({}, true);
            that.addSiblingSisIncome({}, true);
            that.addSonIncome({}, true);
            that.addDaughterIncome({}, true);
            that.addBirthStayPeriodInfo({}, true);
        }

        generateSelect2();
        datePicker();
        datePickerMax('applicant_dob_for_ec');
        datePickerToday('applied_date_for_ews_certificate');
        datePickerToday('applied_date_of_hold_certy_for_ews_certificate');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_ec').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }

        }

        $('#ews_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitEwsCertificate(templateData.show_submit_qr_details ? VALUE_FOUR : VALUE_TWO);
            }
        });
    },
    typeMinorEwsCertificateForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.ews_certificate_data;
            EwsCertificate.router.navigate('edit_type_minor_ews_certificate_form');
        } else {
            showCertAppInstruction();
            var formData = {};
            EwsCertificate.router.navigate('type_minor_ews_certificate_form');
        }

        tempVillageDataForEC = [];
        tempIncomeCertyCnt = 1;
        tempSiblingBroCnt = 1;
        tempSiblingSisCnt = 1;
        tempChildrenSonCnt = 1;
        tempChildrenDaughterCnt = 1;
        tempSiblingBroIncomeCnt = 1;
        tempSiblingSisIncomeCnt = 1;
        tempSonIncomeCnt = 1;
        tempDaughterIncomeCnt = 1;
        tempBirthStayPeriodCnt = 1;
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
        templateData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        templateData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        templateData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        templateData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        templateData.VALUE_EIGHTEEN = VALUE_EIGHTEEN;
        templateData.VALUE_NINETEEN = VALUE_NINETEEN;
        templateData.VALUE_TWENTY = VALUE_TWENTY;
        templateData.VALUE_TWENTYONE = VALUE_TWENTYONE;
        templateData.VALUE_TWENTYTWO = VALUE_TWENTYTWO;
        templateData.VALUE_TWENTYTHREE = VALUE_TWENTYTHREE;
        templateData.VALUE_TWENTYFOUR = VALUE_TWENTYFOUR;
        templateData.VALUE_TWENTYFIVE = VALUE_TWENTYFIVE;
        templateData.VALUE_TWENTYSIX = VALUE_TWENTYSIX;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.ews_certificate_data = parseData.ews_certificate_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            if (templateData['ews_certificate_data'].status != VALUE_FIVE && templateData['ews_certificate_data'].status != VALUE_SIX && templateData['ews_certificate_data'].query_status == VALUE_ONE) {
                templateData.show_submit_qr_details = true;
            }
        }

        $('#ews_certificate_form_and_datatable_container').html(ewstypeMinorEwsCertificateFormTemplate(templateData));
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district');
        generateBoxes('radio', genderArray, 'gender', 'ec', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'ec', formData.marital_status, false, false);
        generateBoxes('radio', yesNoArray, 'reservation_cast_list', 'ews_certificate', formData.reservation_cast_list, false, false);
        generateBoxes('radio', yesNoArray, 'if_having_domicile_certi', 'ews_certificate', formData.if_having_domicile_certi, false, false);
        showSubContainer('if_having_domicile_certi', 'ews_certificate', '.if_domicile_certificate_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'ews_certificate', formData.have_you_own_house, false, false);
        showSubContainer('have_you_own_house', 'ews_certificate', '.house_tax_receipt_item', VALUE_ONE, 'radio');
        showSubContainer('have_you_own_house', 'ews_certificate', '.noc_with_notary_item', VALUE_TWO, 'radio');

        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_ec');
        renderOptionsForTwoDimensionalArray(ewsOccupationArray, 'occupation_for_ec');
        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'native_place_village_for_ec');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_ec');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'apllicant_sc_subcaste_for_ec');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'apllicant_st_subcaste_for_ec');
        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relationship_of_applicant_for_ec');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'present_add_state_for_ec', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'per_addr_state_for_ec', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_ec', 'state_code', 'state_name', 'State/UT');


        if (isEdit) {
            $('#present_add_state_for_ec').val(formData.present_add_state == 0 ? '' : formData.present_add_state);

            var districtData = tempDistrictData[formData.present_add_state] ? tempDistrictData[formData.present_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'present_add_district_for_ec', 'district_code', 'district_name', 'District');
            $('#present_add_district_for_ec').val(formData.present_add_district == 0 ? '' : formData.present_add_district);

            that.getEditVillageData(formData.present_add_state, formData.present_add_district, 'ec', formData.present_add_village, 'present_add');
            $('#present_add_village_for_ec').val(formData.present_add_village);

            $('#born_place_state_for_ec').val(formData.born_place_state == 0 ? '' : formData.born_place_state);

            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_ec', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_ec').val(formData.born_place_district == 0 ? '' : formData.born_place_district);

            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'ec', formData.born_place_village, 'born_place');
            $('#born_place_village_for_ec').val(formData.born_place_village);

            $('#per_addr_state_for_ec').val(formData.per_addr_state == 0 ? '' : formData.per_addr_state);
            var districtData = tempDistrictData[formData.per_addr_state] ? tempDistrictData[formData.per_addr_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_addr_district_for_ec', 'district_code', 'district_name', 'District');
            $('#per_addr_district_for_ec').val(formData.per_addr_district == 0 ? '' : formData.per_addr_district);

            tempVillageDataForEC = formData.per_addr_village_data;
            that.getEditVillageData(formData.per_addr_state, formData.per_addr_district, 'ec', formData.per_addr_village, 'Village');
            $('#per_addr_village_for_ec').val(formData.per_addr_village);

            $('#select_required_purpose_for_ec').val(formData.select_required_purpose);
            $('#village_name_for_ec').val(formData.village_name);

            if (formData.billingtoo == isChecked) {
                $('#billingtoo_for_ec').attr('checked', 'checked');
            }

            $('.family_info_div').collapse().show();
            if (formData.marital_status == VALUE_ONE)
                $('.spouse_info_div').collapse().show();

            $('#declaration_for_ews_certificate').attr('checked', 'checked');
            $('#declaration').attr('checked', 'checked');
            $('#occupation_for_ec').val(formData.occupation);
            $('#nearest_police_station_for_ec').val(formData.nearest_police_station);
            $('#relationship_of_applicant_for_ec').val(formData.relationship_of_applicant);


            if (formData.occupation == VALUE_FOUR) {
                $('.other_occupation_div_for_ec').show();
            }
            $('#district').val(formData.district);


            if (formData.applicant_caste == VALUE_ONE) {
                $('.applicant_caste_sc_item_container_for_ews_certificate').collapse().show();
                $('#apllicant_sc_subcaste_for_ec').val(formData.apllicant_sc_subcaste);
            } else {
                $('.applicant_caste_st_item_container_for_ews_certificate').collapse().show();
                $('#apllicant_st_subcaste_for_ec').val(formData.apllicant_st_subcaste);
            }

            $('#declaration_for_ews_certificate').attr('checked', 'checked');

            var cnt = 1;
            if (formData.income_certy_details != '') {
                var memberDetails = JSON.parse(formData.income_certy_details);
                if (memberDetails != null) {
                    $.each(memberDetails, function (key, value) {
                        that.addIncomeCertyInfo(value, true);
                        issue_date = dateTo_DD_MM_YYYY(value.issue_date);
                        $('#issue_date_' + cnt).val(value.issue_date);
                        valid_up_to_date = dateTo_DD_MM_YYYY(value.valid_up_to_date);
                        $('#valid_up_to_date_' + cnt).val(value.valid_up_to_date);
                        cnt++;
                    });
                } else {
                    that.addIncomeCertyInfo({}, true);
                }
            }

            var cntbro = 1;
            if (formData.sibling_bro_details != '') {
                var memberDetails1 = JSON.parse(formData.sibling_bro_details);
                if (memberDetails1 != null) {
                    $.each(memberDetails1, function (key, value) {
                        that.addSiblingBroInfo(value, true);
                        cntbro++;
                    });
                } else {
                    that.addSiblingBroInfo({}, true);
                }
            }

            var cntsis = 1;
            if (formData.sibling_sis_details != '') {
                var memberDetails2 = JSON.parse(formData.sibling_sis_details);
                if (memberDetails2 != null) {
                    $.each(memberDetails2, function (key, value) {
                        that.addSiblingSisInfo(value, true);
                        cntsis++;
                    });
                } else {
                    that.addSiblingSisInfo({}, true);
                }
            }

            var cntson = 1;
            if (formData.son_details != '') {
                var memberDetails3 = JSON.parse(formData.son_details);
                if (memberDetails3 != null) {
                    $.each(memberDetails3, function (key, value) {
                        that.addChildrenSonInfo(value, true);
                        cntson++;
                    });
                } else {
                    that.addChildrenSonInfo({}, true);
                }
            }

            var cntdaughter = 1;
            if (formData.daughter_details != '') {
                var memberDetails4 = JSON.parse(formData.daughter_details);
                if (memberDetails4 != null) {
                    $.each(memberDetails4, function (key, value) {
                        that.addChildrenDaughterInfo(value, true);
                        cntdaughter++;
                    });
                } else {
                    that.addChildrenDaughterInfo({}, true);
                }
            }

            var cntincomebro = 1;
            if (formData.sibling_broincome_details != '') {
                var memberDetails5 = JSON.parse(formData.sibling_broincome_details);
                if (memberDetails5 != null) {
                    $.each(memberDetails5, function (key, value) {
                        that.addSiblingBroIncome(value, true);
                        cntincomebro++;
                    });
                } else {
                    that.addSiblingBroIncome({}, true);
                }
            }


            var cntincomesis = 1;
            if (formData.sibling_sisincome_details != '') {
                var memberDetails6 = JSON.parse(formData.sibling_sisincome_details);
                if (memberDetails6 != null) {
                    $.each(memberDetails6, function (key, value) {
                        that.addSiblingSisIncome(value, true);
                        cntincomesis++;
                    });
                } else {
                    that.addSiblingSisIncome({}, true);
                }
            }

            var cntincomeson = 1;
            if (formData.sonincome_details != '') {
                var memberDetails7 = JSON.parse(formData.sonincome_details);
                if (memberDetails7 != null) {
                    $.each(memberDetails7, function (key, value) {
                        that.addSonIncome(value, true);
                        cntincomeson++;
                    });
                } else {
                    that.addSonIncome({}, true);
                }
            }

            var cntincomedaughter = 1;
            if (formData.daughterincome_details != '') {
                var memberDetails8 = JSON.parse(formData.daughterincome_details);
                if (memberDetails8 != null) {
                    $.each(memberDetails8, function (key, value) {
                        that.addDaughterIncome(value, true);
                        cntincomedaughter++;
                    });
                } else {
                    that.addDaughterIncome({}, true);
                }
            }

            var cntbps = 1;
            if (formData.birth_stay_place_details != '') {
                var birthStayPlace = JSON.parse(formData.birth_stay_place_details);
                if (birthStayPlace != null) {
                    $.each(birthStayPlace, function (key, value) {
                        that.addBirthStayPeriodInfo(value, true);
                        $('#born_place_state_for_ec_' + cntbps).val(value.born_place_state);
                        var districtData = tempDistrictData[value.born_place_state] ? tempDistrictData[value.born_place_state] : [];
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_ec_' + cntbps, 'district_code', 'district_name', 'District');
                        $('#born_place_district_for_ec_' + cntbps).val(value.born_place_district);
                        that.getEditVillageData(value.born_place_state, value.born_place_district, 'EWS', value.born_place_village, 'born_place_village_for_ec_' + cntbps);
                        $('#born_place_village_for_ec_' + cntbps).val(value.born_place_village);
                        cntbps++;
                    });
                } else {
                    that.addBirthStayPeriodInfo({}, true);
                }
            }

            //------------------------------------------
            that.getYearlyIncomeTotal();
            var val = formData.constitution_artical;

            if (formData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_ews_certificate', 'applicant_photo_doc_name_image_for_ews_certificate', 'applicant_photo_doc_name_container_for_ews_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.ews_certificate_id, VALUE_ONE);
            }
            if (formData.minor_child_photo != '') {
                that.showDocument('minor_child_photo_container_for_ews_certificate', 'minor_child_photo_name_image_for_ews_certificate', 'minor_child_photo_name_container_for_ews_certificate',
                        'minor_child_photo_download', 'minor_child_photo', formData.minor_child_photo, formData.ews_certificate_id, VALUE_THIRTEEN);
            }
            if (formData.birth_certificate_doc != '') {
                that.showDocument('birth_certificate_doc_container_for_ews_certificate', 'birth_certificate_doc_name_image_for_ews_certificate', 'birth_certificate_doc_name_container_for_ews_certificate',
                        'birth_certificate_doc_download', 'birth_certificate_doc', formData.birth_certificate_doc, formData.ews_certificate_id, VALUE_TWO);
            }
            if (formData.leaving_certificate_doc != '') {
                that.showDocument('leaving_certificate_doc_container_for_ews_certificate', 'leaving_certificate_doc_name_image_for_ews_certificate', 'leaving_certificate_doc_name_container_for_ews_certificate',
                        'leaving_certificate_doc_download', 'leaving_certificate_doc', formData.leaving_certificate_doc, formData.ews_certificate_id, VALUE_THREE);
            }
            if (formData.election_card_doc != '') {
                that.showDocument('election_card_doc_container_for_ews_certificate', 'election_card_doc_name_image_for_ews_certificate', 'election_card_doc_name_container_for_ews_certificate',
                        'election_card_doc_download', 'election_card_doc', formData.election_card_doc, formData.ews_certificate_id, VALUE_FOUR);
            }
            if (formData.mother_election_card_doc != '') {
                that.showDocument('mother_election_card_doc_container_for_ews_certificate', 'mother_election_card_doc_name_image_for_ews_certificate', 'mother_election_card_doc_name_container_for_ews_certificate',
                        'mother_election_card_doc_download', 'mother_election_card_doc', formData.mother_election_card_doc, formData.ews_certificate_id, VALUE_TWENTYONE);
            }
            if (formData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_ews_certificate', 'aadhar_card_doc_name_image_for_ews_certificate', 'aadhar_card_doc_name_container_for_ews_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.ews_certificate_id, VALUE_FIVE);
            }
            if (formData.mother_aadhar_card_doc != '') {
                that.showDocument('mother_aadhar_card_doc_container_for_ews_certificate', 'mother_aadhar_card_doc_name_image_for_ews_certificate', 'mother_aadhar_card_doc_name_container_for_ews_certificate',
                        'mother_aadhar_card_doc_download', 'mother_aadhar_card_doc', formData.mother_aadhar_card_doc, formData.ews_certificate_id, VALUE_TWENTYTHREE);
            }
            if (formData.community_certificate_doc != '') {
                that.showDocument('community_certificate_doc_container_for_ews_certificate', 'community_certificate_doc_name_image_for_ews_certificate', 'community_certificate_doc_name_container_for_ews_certificate',
                        'community_certificate_doc_download', 'community_certificate_doc', formData.community_certificate_doc, formData.ews_certificate_id, VALUE_SIX);
            }
            if (formData.father_mother_community_certificate_doc != '') {
                that.showDocument('father_mother_community_certificate_doc_container_for_ews_certificate', 'father_mother_community_certificate_doc_name_image_for_ews_certificate', 'father_mother_community_certificate_doc_name_container_for_ews_certificate',
                        'father_mother_community_certificate_doc_download', 'father_mother_community_certificate_doc', formData.father_mother_community_certificate_doc, formData.ews_certificate_id, VALUE_SIXTEEN);
            }
            if (formData.caste_certificate_doc != '') {
                that.showDocument('caste_certificate_doc_container_for_ews_certificate', 'caste_certificate_doc_name_image_for_ews_certificate', 'caste_certificate_doc_name_container_for_ews_certificate',
                        'caste_certificate_doc_download', 'caste_certificate_doc', formData.caste_certificate_doc, formData.ews_certificate_id, VALUE_SEVEN);
            }
            if (formData.father_mother_caste_certificate_doc != '') {
                that.showDocument('father_mother_caste_certificate_doc_container_for_ews_certificate', 'father_mother_caste_certificate_doc_name_image_for_ews_certificate', 'father_mother_caste_certificate_doc_name_container_for_ews_certificate',
                        'father_mother_caste_certificate_doc_download', 'father_mother_caste_certificate_doc', formData.father_mother_caste_certificate_doc, formData.ews_certificate_id, VALUE_SEVENTEEN);
            }
            if (formData.affidativet_immovable_property_doc != '') {
                that.showDocument('affidativet_immovable_property_doc_container_for_ews_certificate', 'affidativet_immovable_property_doc_name_image_for_ews_certificate', 'affidativet_immovable_property_doc_name_container_for_ews_certificate',
                        'affidativet_immovable_property_doc_download', 'affidativet_immovable_property_doc', formData.affidativet_immovable_property_doc, formData.ews_certificate_id, VALUE_EIGHT);
            }
            if (formData.gazeted_copy_doc != '') {
                that.showDocument('gazeted_copy_doc_container_for_ews_certificate', 'gazeted_copy_doc_name_image_for_ews_certificate', 'gazeted_copy_doc_name_container_for_ews_certificate',
                        'gazeted_copy_doc_download', 'gazeted_copy_doc', formData.gazeted_copy_doc, formData.ews_certificate_id, VALUE_NINE);
            }
            if (formData.agricultural_detail_doc != '') {
                that.showDocument('agricultural_detail_doc_container_for_ews_certificate', 'agricultural_detail_doc_name_image_for_ews_certificate', 'agricultural_detail_doc_name_container_for_ews_certificate',
                        'agricultural_detail_doc_download', 'agricultural_detail_doc', formData.agricultural_detail_doc, formData.ews_certificate_id, VALUE_TEN);
            }
            if (formData.incometax_return_doc != '') {
                that.showDocument('incometax_return_doc_container_for_ews_certificate', 'incometax_return_doc_name_image_for_ews_certificate', 'incometax_return_doc_name_container_for_ews_certificate',
                        'incometax_return_doc_download', 'incometax_return_doc', formData.incometax_return_doc, formData.ews_certificate_id, VALUE_ELEVEN);
            }
            if (formData.other_doc != '') {
                that.showDocument('other_doc_container_for_ews_certificate', 'other_doc_name_image_for_ews_certificate', 'other_doc_name_container_for_ews_certificate',
                        'other_doc_download', 'other_doc', formData.other_doc, formData.ews_certificate_id, VALUE_TWELVE);
            }
            if (formData.child_aadhar_card_doc != '') {
                that.showDocument('child_aadhar_card_doc_container_for_ews_certificate', 'child_aadhar_card_doc_name_image_for_ews_certificate', 'child_aadhar_card_doc_name_container_for_ews_certificate',
                        'child_aadhar_card_doc_download', 'child_aadhar_card_doc', formData.child_aadhar_card_doc, formData.ews_certificate_id, VALUE_FOURTEEN);
            }
            if (formData.domicile_certificate_doc != '') {
                that.showDocument('domicile_certificate_doc_container_for_ews_certificate', 'domicile_certificate_doc_name_image_for_ews_certificate', 'domicile_certificate_doc_name_container_for_ews_certificate',
                        'domicile_certificate_doc_download', 'domicile_certificate_doc', formData.domicile_certificate_doc, formData.ews_certificate_id, VALUE_FIFTEEN);
            }
            if (formData.father_mother_domicile_certificate_doc != '') {
                that.showDocument('father_mother_domicile_certificate_doc_container_for_ews_certificate', 'father_mother_domicile_certificate_doc_name_image_for_ews_certificate', 'father_mother_domicile_certificate_doc_name_container_for_ews_certificate',
                        'father_mother_domicile_certificate_doc_download', 'father_mother_domicile_certificate_doc', formData.father_mother_domicile_certificate_doc, formData.ews_certificate_id, VALUE_TWENTYFOUR);
            }
            if (formData.house_tax_receipt != '') {
                that.showDocument('house_tax_receipt_container_for_ews_certificate', 'house_tax_receipt_name_image_for_ews_certificate', 'house_tax_receipt_name_container_for_ews_certificate',
                        'house_tax_receipt_download', 'house_tax_receipt', formData.house_tax_receipt, formData.ews_certificate_id, VALUE_EIGHTEEN);
            }
            if (formData.sale_deed_copy != '') {
                that.showDocument('sale_deed_copy_container_for_domicile', 'sale_deed_copy_name_image_for_ews_certificate', 'sale_deed_copy_name_container_for_ews_certificate',
                        'sale_deed_copy_download', 'sale_deed_copy', formData.sale_deed_copy, formData.ews_certificate_id, VALUE_NINETEEN);
            }
            if (formData.noc_with_notary != '') {
                that.showDocument('noc_with_notary_container_for_ews_certificate', 'noc_with_notary_name_image_for_ews_certificate', 'noc_with_notary_name_container_for_ews_certificate',
                        'noc_with_notary_download', 'noc_with_notary', formData.noc_with_notary, formData.ews_certificate_id, VALUE_TWENTYFIVE);
            }
            if (formData.aggriment_with_notary != '') {
                that.showDocument('aggriment_with_notary_container_for_ews_certificate', 'aggriment_with_notary_name_image_for_ews_certificate', 'aggriment_with_notary_name_container_for_ews_certificate',
                        'aggriment_with_notary_download', 'aggriment_with_notary', formData.aggriment_with_notary, formData.ews_certificate_id, VALUE_TWENTYSIX);
            }
        } else {
            that.addIncomeCertyInfo({}, true);
            that.addSiblingBroInfo({}, true);
            that.addSiblingSisInfo({}, true);
            that.addChildrenSonInfo({}, true);
            that.addChildrenDaughterInfo({}, true);
            that.addSiblingBroIncome({}, true);
            that.addSiblingSisIncome({}, true);
            that.addSonIncome({}, true);
            that.addDaughterIncome({}, true);
            that.addBirthStayPeriodInfo({}, true);
        }

        datePickerMin('applicant_dob_for_ec');
        datePickerToday('applied_date_for_ews_certificate');
        datePickerToday('applied_date_of_hold_certy_for_ews_certificate');
        generateSelect2();
        datePicker();
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_ec').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }

        }

        $('#ews_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitEwsCertificate(templateData.show_submit_qr_details ? VALUE_FOUR : VALUE_ONE);
            }
        });

    },
    addSiblingBroInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cntbro = tempSiblingBroCnt;
        $('#detail_of_sibling_bro_info_container_for_ec').append(ewsCertificateSiblingBroInfoTemplate(templateData));
        tempSiblingBroCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cntbro');
    },

    removeSiblingBroInfo: function (perCnt) {
        $('#detail_of_sibling_bro_info_' + perCnt).remove();
        $('#detail_of_sibling_bro_income_' + perCnt).remove();
        resetCounter('display-cntbro');
    },

    addSiblingBroIncome: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cntbroincome = tempSiblingBroIncomeCnt;
        $('#detail_of_sibling_bro_income_container_for_ec').append(ewsCertificateSiblingBroIncomeTemplate(templateData));
        tempSiblingBroIncomeCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cntincomebro');
    },

    removeSiblingBroIncome: function (perCnt) {
        $('#detail_of_sibling_bro_income_' + perCnt).remove();
        resetCounter('display-cntbro');
    },

    addSiblingSisInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cntsis = tempSiblingSisCnt;
        $('#detail_of_sibling_sis_info_container_for_ec').append(ewsCertificateSiblingSisInfoTemplate(templateData));
        tempSiblingSisCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cntsis');
    },

    removeSiblingSisInfo: function (perCnt) {
        $('#detail_of_sibling_sis_info_' + perCnt).remove();
        $('#detail_of_sibling_sis_income_' + perCnt).remove();
        resetCounter('display-cntsis');
    },

    addChildrenSonInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cntson = tempChildrenSonCnt;
        $('#detail_of_children_son_info_container_for_ec').append(ewsCertificateChildrenSonInfoTemplate(templateData));
        tempChildrenSonCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cntson');
    },

    removeChildrenSonInfo: function (perCnt) {
        $('#detail_of_children_son_info_' + perCnt).remove();
        $('#detail_of_son_income_' + perCnt).remove();
        resetCounter('display-cntson');
    },

    addChildrenDaughterInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cntdaughter = tempChildrenDaughterCnt;
        $('#detail_of_children_daughter_info_container_for_ec').append(ewsCertificateChildrenDaughterInfoTemplate(templateData));
        tempChildrenDaughterCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cntdaughter');
    },

    removeChildrenDaughterInfo: function (perCnt) {
        $('#detail_of_children_daughter_info_' + perCnt).remove();
        $('#detail_of_daughter_income_' + perCnt).remove();
        resetCounter('display-cntdaughter');
    },

    addIncomeCertyInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt = tempIncomeCertyCnt;
        $('#detail_of_income_asset_info_container_for_ec').append(ewsCertificateIncomeCertyInfoTemplate(templateData));
        tempIncomeCertyCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cnt');
    },
    removeIncomeCertyInfo: function (perCnt) {
        $('#detail_of_income_asset_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },

    addSiblingSisIncome: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cntsisincome = tempSiblingSisIncomeCnt;
        $('#detail_of_sibling_sis_income_container_for_ec').append(ewsCertificateSiblingSisIncomeTemplate(templateData));
        tempSiblingSisIncomeCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cntincomesis');
    },

    removeSiblingSisIncome: function (perCnt) {
        perCnt--;
        $('#detail_of_sibling_sis_income_' + perCnt).remove();
        resetCounter('display-cntsis');
    },

    addSonIncome: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cntsonincome = tempSonIncomeCnt;
        $('#detail_of_son_income_container_for_ec').append(ewsCertificateSonIncomeTemplate(templateData));
        tempSonIncomeCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cntincomeson');
    },

    removeSonIncome: function (perCnt) {
        perCnt--;
        $('#detail_of_son_income_' + perCnt).remove();
        resetCounter('display-cntson');
    },

    addDaughterIncome: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cntdaughterincome = tempDaughterIncomeCnt;
        $('#detail_of_daughter_income_container_for_ec').append(ewsCertificateDaughterIncomeTemplate(templateData));
        tempDaughterIncomeCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cntincomedaughter');
    },

    removeDaughterIncome: function (perCnt) {
        perCnt--;
        $('#detail_of_daughter_income_' + perCnt).remove();
        resetCounter('display-cntdaughter');
    },
    getGrandIncomeTotal: function () {
        var calculated_total_sum = 0;

        $("#myTable .txtCal").each(function () {
            var get_textbox_value = $(this).val();
            if ($.isNumeric(get_textbox_value)) {
                calculated_total_sum += parseFloat(get_textbox_value);
            }
        });
        $("#total_income_for_ec").val(calculated_total_sum);
    },
    getYearlyIncomeTotal: function (incomeId, totalIncomeId, valueId = 0) {

        var fathergrandincome;
        var mothergrandincome;
        var siblingbroincome;
        var siblingsisincome;
        var sonincome;
        var daughterincome;
        var grandtotal;
        var brograndtotal;

        if (valueId == 0) {
            var cnt1 = parseFloat($('#' + incomeId + '_salary_detail_for_ec').val()) ? parseFloat($('#' + incomeId + '_salary_detail_for_ec').val()) : 0;
            var cnt2 = parseFloat($('#' + incomeId + '_business_detail_for_ec').val()) ? parseFloat($('#' + incomeId + '_business_detail_for_ec').val()) : 0;
            var cnt3 = parseFloat($('#' + incomeId + '_agri_detail_for_ec').val()) ? parseFloat($('#' + incomeId + '_agri_detail_for_ec').val()) : 0;
            var cnt4 = parseFloat($('#' + incomeId + '_profe_detail_for_ec').val()) ? parseFloat($('#' + incomeId + '_profe_detail_for_ec').val()) : 0;
            var cnt5 = parseFloat($('#' + incomeId + '_other_detail_for_ec').val()) ? parseFloat($('#' + incomeId + '_other_detail_for_ec').val()) : 0;
        } else {
            var cnt1 = parseFloat($('#' + incomeId + '_salary_detail_for_ec_' + valueId).val()) ? parseFloat($('#' + incomeId + '_salary_detail_for_ec_' + valueId).val()) : 0;
            var cnt2 = parseFloat($('#' + incomeId + '_business_detail_for_ec_' + valueId).val()) ? parseFloat($('#' + incomeId + '_business_detail_for_ec_' + valueId).val()) : 0;
            var cnt3 = parseFloat($('#' + incomeId + '_agri_detail_for_ec_' + valueId).val()) ? parseFloat($('#' + incomeId + '_agri_detail_for_ec_' + valueId).val()) : 0;
            var cnt4 = parseFloat($('#' + incomeId + '_profe_detail_for_ec_' + valueId).val()) ? parseFloat($('#' + incomeId + '_profe_detail_for_ec_' + valueId).val()) : 0;
            var cnt5 = parseFloat($('#' + incomeId + '_other_detail_for_ec_' + valueId).val()) ? parseFloat($('#' + incomeId + '_other_detail_for_ec_' + valueId).val()) : 0;
        }

        totalIncome = cnt1 + cnt2 + cnt3 + cnt4 + cnt5;

        $('#' + totalIncomeId).val(totalIncome ? totalIncome : 0);

    },
    editOrViewEwsCertificate: function (btnObj, ewsCertificateId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ewsCertificateId) {
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
            url: 'ews_certificate/get_ews_certificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'ews_certificate_id': ewsCertificateId, 'is_edit_view': isEditOrView}, getTokenData()),
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
                    var ewsCertificateData = parseData.ews_certificate_data;

                    if (ewsCertificateData.constitution_artical == VALUE_ONE)
                        that.typeMajorEwsCertificateForm(isEdit, parseData);
                    else if (ewsCertificateData.constitution_artical == VALUE_TWO)
                        that.typeMinorEwsCertificateForm(isEdit, parseData);
                } else {
                    var ewsCertificateData = parseData.ews_certificate_data;
                    that.viewEwsCertificateForm(VALUE_ONE, ewsCertificateData, isPrint);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', EWS_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", EWS_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'EwsCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },

    viewEwsCertificateForm: function (moduleType, ewsCertificateData, isPrint) {
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
            EwsCertificate.router.navigate('view_ews_certificate_form');
            ewsCertificateData.title = 'View';
        } else {
            ewsCertificateData.show_submit_btn = true;
        }
        ewsCertificateData.VALUE_THREE = VALUE_THREE;
        ewsCertificateData.EWS_CERTIFICATE_DOC_PATH = EWS_CERTIFICATE_DOC_PATH;
        ewsCertificateData.declaration_date_text = dateTo_DD_MM_YYYY(ewsCertificateData.declaration_date);

        var application_type = ewsCertificateData.constitution_artical ? ewsCertificateData.constitution_artical : '';
        if (application_type == VALUE_ONE) {
            ewsCertificateData.application_type_text = 'Major';
            ewsCertificateData.application_type_title = ' Applicant Name';
            ewsCertificateData.show_fathername = true;
            ewsCertificateData.show_adhar = true;
        } else if (application_type == VALUE_TWO) {
            ewsCertificateData.application_type_text = 'Minor';
            ewsCertificateData.application_type_title = ' Guardian Name';
            ewsCertificateData.show_minor_child_name = true;
        }

        ewsCertificateData.district_text = talukaArray[ewsCertificateData.district] ? talukaArray[ewsCertificateData.district] : '';
        var district = ewsCertificateData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        ewsCertificateData.village_name_text = villageData[ewsCertificateData.village_name] ? villageData[ewsCertificateData.village_name] : '';

        ewsCertificateData.gender_text = genderArray[ewsCertificateData.gender] ? genderArray[ewsCertificateData.gender] : '';
        ewsCertificateData.applicant_dob_text = ewsCertificateData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(ewsCertificateData.applicant_dob) : '';

        ewsCertificateData.marital_status_text = maritalStatusArray[ewsCertificateData.marital_status] ? maritalStatusArray[ewsCertificateData.marital_status] : '';

        ewsCertificateData.relationship_of_applicant_text = relationDeceasedPersonArray[ewsCertificateData.relationship_of_applicant] ? relationDeceasedPersonArray[ewsCertificateData.relationship_of_applicant] : '';
        ewsCertificateData.submitted_datetime_text = ewsCertificateData.submitted_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY(ewsCertificateData.submitted_datetime) : dateTo_DD_MM_YYYY(ewsCertificateData.created_time);
        ewsCertificateData.list_text = yesNoArray[ewsCertificateData.reservation_cast_list];

        //-------------------------------------------------
        ewsCertificateData.show_applicant_photo_doc = ewsCertificateData.applicant_photo_doc != '' ? true : false;
        ewsCertificateData.show_minor_child_photo = ewsCertificateData.minor_child_photo != '' ? true : false;
        ewsCertificateData.show_birth_certificate_doc = ewsCertificateData.birth_certificate_doc != '' ? true : false;
        ewsCertificateData.show_leaving_certificate_doc = ewsCertificateData.leaving_certificate_doc != '' ? true : false;
        ewsCertificateData.show_election_card_doc = ewsCertificateData.election_card_doc != '' ? true : false;
        ewsCertificateData.show_father_election_card_doc = ewsCertificateData.father_election_card_doc != '' ? true : false;
        ewsCertificateData.show_mother_election_card_doc = ewsCertificateData.mother_election_card_doc != '' ? true : false;
        ewsCertificateData.show_aadhar_card_doc = ewsCertificateData.aadhar_card_doc != '' ? true : false;
        ewsCertificateData.show_father_aadhar_card_doc = ewsCertificateData.father_aadhar_card_doc != '' ? true : false;
        ewsCertificateData.show_mother_aadhar_card_doc = ewsCertificateData.mother_aadhar_card_doc != '' ? true : false;
        ewsCertificateData.show_child_aadhar_card_doc = ewsCertificateData.child_aadhar_card_doc != '' ? true : false;
        ewsCertificateData.show_community_certificate_doc = ewsCertificateData.community_certificate_doc != '' ? true : false;
        ewsCertificateData.show_father_mother_community_certificate_doc = ewsCertificateData.father_mother_community_certificate_doc != '' ? true : false;
        ewsCertificateData.show_caste_certificate_doc = ewsCertificateData.caste_certificate_doc != '' ? true : false;
        ewsCertificateData.show_father_mother_caste_certificate_doc = ewsCertificateData.father_mother_caste_certificate_doc != '' ? true : false;
        ewsCertificateData.show_affidativet_immovable_property_doc = ewsCertificateData.affidativet_immovable_property_doc != '' ? true : false;
        ewsCertificateData.show_gazeted_copy_doc = ewsCertificateData.gazeted_copy_doc != '' ? true : false;
        ewsCertificateData.show_agricultural_detail_doc = ewsCertificateData.agricultural_detail_doc != '' ? true : false;
        ewsCertificateData.show_incometax_return_doc = ewsCertificateData.incometax_return_doc != '' ? true : false;
        ewsCertificateData.show_domicile_certificate_doc = ewsCertificateData.domicile_certificate_doc != '' ? true : false;
        ewsCertificateData.show_father_mother_domicile_certificate_doc = ewsCertificateData.father_mother_domicile_certificate_doc != '' ? true : false;
        ewsCertificateData.show_noc_with_notary_doc = ewsCertificateData.noc_with_notary != '' ? true : false;
        ewsCertificateData.show_aggriment_with_notary_doc = ewsCertificateData.aggriment_with_notary != '' ? true : false;
        ewsCertificateData.show_house_tax_receipt_doc = ewsCertificateData.house_tax_receipt != '' ? true : false;
        ewsCertificateData.show_sale_deed_copy_doc = ewsCertificateData.sale_deed_copy != '' ? true : false;

        ewsCertificateData.show_other_doc = ewsCertificateData.other_doc != '' ? true : false;
        ewsCertificateData.show_declaration_btn = moduleType == VALUE_ONE ? true : (ewsCertificateData.declaration == VALUE_ONE ? true : false);

        if (ewsCertificateData.constitution_artical == VALUE_ONE) {
            ewsCertificateData.show_applicant_data = true;
        }

        if (ewsCertificateData.constitution_artical == VALUE_TWO) {
            ewsCertificateData.show_gaudian_data = true;
        }
        if (ewsCertificateData.status != VALUE_ZERO && ewsCertificateData.status != VALUE_ONE) {
            ewsCertificateData.show_print_btn = true;
        }
        //---------------------------------------------------
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(ewsCertificateViewTemplate(ewsCertificateData));
        if (ewsCertificateData.declaration == VALUE_ONE) {
            $('#declaration_for_ews_certificate').click();
        }

        if (ewsCertificateData.sibling_bro_details != '') {
            var broInfoData = JSON.parse(ewsCertificateData.sibling_bro_details);
            var broInfoCnt = 1;
            $.each(broInfoData, function (index, bro) {
                var rowSpanForSiblingBro = '';
                if (broInfoCnt == 1) {
                    rowSpanForSiblingBro = '<td class="text-center" rowspan="' + broInfoData.length + '">3</td><td class="text-center" rowspan="' + broInfoData.length + '">Sibling Brother</td>';
                }
                var broInfoRow = '<tr>' + rowSpanForSiblingBro + '<td class="text-center">' + bro.sibling_bro_name + '</td>' + '<td class="text-center">' + bro.sibling_bro_age + '</td><td class="text-center">' + bro.sibling_bro_occu_edu + '</td>' + '<td class="text-center">' + bro.sibling_bro_remark + '</td></tr>';
                $('#sibling_info_container_for_view_ews').append(broInfoRow);
                broInfoCnt++;
            });
        }
        if (ewsCertificateData.sibling_sis_details != '') {
            var sisInfoData = JSON.parse(ewsCertificateData.sibling_sis_details);
            var sisInfoCnt = 1;
            $.each(sisInfoData, function (index, sis) {
                var rowSpanForSiblingSis = '';
                if (sisInfoCnt == 1) {
                    rowSpanForSiblingSis = '<td class="text-center" rowspan="' + sisInfoData.length + '">4</td><td class="text-center" rowspan="' + sisInfoData.length + '">Sibling Sister</td>';
                }
                var sisInfoRow = '<tr>' + rowSpanForSiblingSis + '<td class="text-center">' + sis.sibling_sis_name + '</td>' + '<td class="text-center">' + sis.sibling_sis_age + '</td><td class="text-center">' + sis.sibling_sis_occu_edu + '</td>' + '<td class="text-center">' + sis.sibling_sis_remark + '</td></tr>';
                $('#sibling_info_container_for_view_ews').append(sisInfoRow);
                sisInfoCnt++;
            });
        }
        if (ewsCertificateData.son_details != '') {
            var sonInfoData = JSON.parse(ewsCertificateData.son_details);
            var sonInfoCnt = 1;
            $.each(sonInfoData, function (index, son) {
                var rowSpanForSon = '';
                if (sonInfoCnt == 1) {
                    rowSpanForSon = '<td class="text-center" rowspan="' + sonInfoData.length + '">5</td><td class="text-center" rowspan="' + sonInfoData.length + '">Son</td>';
                }
                var sonInfoRow = '<tr>' + rowSpanForSon + '<td class="text-center">' + son.children_son_name + '</td>' + '<td class="text-center">' + son.children_son_age + '</td><td class="text-center">' + son.children_son_occu_edu + '</td>' + '<td class="text-center">' + son.children_son_remark + '</td></tr>';
                $('#sibling_info_container_for_view_ews').append(sonInfoRow);
                sonInfoCnt++;
            });
        }
        if (ewsCertificateData.daughter_details != '') {
            var daughterInfoData = JSON.parse(ewsCertificateData.daughter_details);
            var daughterInfoCnt = 1;
            $.each(daughterInfoData, function (index, daughter) {
                var rowSpanForDaughter = '';
                if (daughterInfoCnt == 1) {
                    rowSpanForDaughter = '<td class="text-center" rowspan="' + daughterInfoData.length + '">6</td><td class="text-center" rowspan="' + daughterInfoData.length + '">Daughter</td>';
                }
                var daughterInfoRow = '<tr>' + rowSpanForDaughter + '<td class="text-center">' + daughter.children_daughter_name + '</td>' + '<td class="text-center">' + daughter.children_daughter_age + '</td><td class="text-center">' + daughter.children_daughter_occu_edu + '</td>' + '<td class="text-center">' + daughter.children_daughter_remark + '</td></tr>';
                $('#sibling_info_container_for_view_ews').append(daughterInfoRow);
                daughterInfoCnt++;
            });
        }

        var efmData = JSON.parse(ewsCertificateData.income_certy_details);
        var efmCnt = 1;
        $.each(efmData, function (index, efm) {
            var efmRow = '<tr><td class="text-center">' + efmCnt + '</td><td class="text-center">' + efm.issuing_authority + '</td>' +
                    '<td class="text-center">' + efm.certificate_no + '</td><td class="text-center">' + efm.issue_date + '</td>' +
                    '<td class="text-center">' + efm.valid_up_to_date + '</td></tr>';
            $('#efm_container_for_icview_ews').append(efmRow);
            efmCnt++;
        });

        if (ewsCertificateData.sibling_broincome_details != '') {
            var broIncomeData = JSON.parse(ewsCertificateData.sibling_broincome_details);
            var broIncomeCnt = 1;
            $.each(broIncomeData, function (index, bro) {
                var rowSpanForSiblingBroIncome = '';
                if (broIncomeCnt == 1) {
                    rowSpanForSiblingBroIncome = '<td class="text-center" rowspan="' + broIncomeData.length + '">3</td><td class="text-center" rowspan="' + broIncomeData.length + '">Sibling Brother</td>';
                }
                var broIncomeRow = '<tr>' + rowSpanForSiblingBroIncome + '<td class="text-center">' + bro.sibling_bro_sallary + '</td>' + '<td class="text-center">' + bro.sibling_bro_business + '</td><td class="text-center">' + bro.sibling_bro_agri + '</td>' + '<td class="text-center">' + bro.sibling_bro_proffe + '</td>' + '<td class="text-center">' + bro.sibling_bro_other_sour + '</td>' + '<td class="text-center">' + bro.sibling_bro_income + '</td></tr>';
                $('#sibling_income_container_for_view_ews').append(broIncomeRow);
                broIncomeCnt++;
            });
        }
        if (ewsCertificateData.sibling_sisincome_details != '') {
            var sisIncomeData = JSON.parse(ewsCertificateData.sibling_sisincome_details);
            var sisIncomeCnt = 1;
            $.each(sisIncomeData, function (index, sis) {
                var rowSpanForSiblingSisIncome = '';
                if (sisIncomeCnt == 1) {
                    rowSpanForSiblingSisIncome = '<td class="text-center" rowspan="' + sisIncomeData.length + '">4</td><td class="text-center" rowspan="' + sisIncomeData.length + '">Sibling Sister</td>';
                }
                var sisIncomeRow = '<tr>' + rowSpanForSiblingSisIncome + '<td class="text-center">' + sis.sibling_sis_sallary + '</td>' + '<td class="text-center">' + sis.sibling_sis_business + '</td><td class="text-center">' + sis.sibling_sis_agri + '</td>' + '<td class="text-center">' + sis.sibling_sis_proffe + '</td>' + '<td class="text-center">' + sis.sibling_sis_other_sour + '</td>' + '<td class="text-center">' + sis.sibling_sis_income + '</td></tr>';
                $('#sibling_income_container_for_view_ews').append(sisIncomeRow);
                sisIncomeCnt++;
            });
        }
        if (ewsCertificateData.sonincome_details != '') {
            var sonIncomeData = JSON.parse(ewsCertificateData.sonincome_details);
            var sonIncomeCnt = 1;
            $.each(sonIncomeData, function (index, son) {
                var rowSpanForSiblingSonIncome = '';
                if (sonIncomeCnt == 1) {
                    rowSpanForSiblingSonIncome = '<td class="text-center" rowspan="' + sonIncomeData.length + '">5</td><td class="text-center" rowspan="' + sonIncomeData.length + '">Son</td>';
                }
                var sonIncomeRow = '<tr>' + rowSpanForSiblingSonIncome + '<td class="text-center">' + son.son_sallary + '</td>' + '<td class="text-center">' + son.son_business + '</td><td class="text-center">' + son.son_agri + '</td>' + '<td class="text-center">' + son.son_proffe + '</td>' + '<td class="text-center">' + son.son_other_sour + '</td>' + '<td class="text-center">' + son.son_income + '</td></tr>';
                $('#sibling_income_container_for_view_ews').append(sonIncomeRow);
                sonIncomeCnt++;
            });
        }
        if (ewsCertificateData.daughterincome_details != '') {
            var daughterIncomeData = JSON.parse(ewsCertificateData.daughterincome_details);
            var daughterIncomeCnt = 1;
            $.each(daughterIncomeData, function (index, daughter) {
                var rowSpanForSiblingDaughterIncome = '';
                if (daughterIncomeCnt == 1) {
                    rowSpanForSiblingDaughterIncome = '<td class="text-center" rowspan="' + daughterIncomeData.length + '">6</td><td class="text-center" rowspan="' + daughterIncomeData.length + '">Daughter</td>';
                }
                var daughterIncomeRow = '<tr>' + rowSpanForSiblingDaughterIncome + '<td class="text-center">' + daughter.daughter_sallary + '</td>' + '<td class="text-center">' + daughter.daughter_business + '</td><td class="text-center">' + daughter.daughter_agri + '</td>' + '<td class="text-center">' + daughter.daughter_proffe + '</td>' + '<td class="text-center">' + daughter.daughter_other_sour + '</td>' + '<td class="text-center">' + daughter.daughter_income + '</td></tr>';
                $('#sibling_income_container_for_view_ews').append(daughterIncomeRow);
                daughterIncomeCnt++;
            });
        }
        if (ewsCertificateData.birth_stay_place_details != '') {
            var bspInfoData = JSON.parse(ewsCertificateData.birth_stay_place_details);
            var bspInfoCnt = 1;
            $.each(bspInfoData, function (index, bsp) {
                var bspInfoRow = '<tr><td class="text-center">' + bspInfoCnt + '</td><td class="text-center">' + bsp.born_place_state_text + '</td>' + '<td class="text-center">' + bsp.born_place_district_text + '</td><td class="text-center">' + bsp.born_place_village_text + '</td>' + '<td class="text-center">' + bsp.born_place_tehsil + '</td>' + '<td class="text-center">' + bsp.born_period + '</td></tr>';
                $('#birth_stay_period_info_container_for_view_ews').append(bspInfoRow);
                bspInfoCnt++;
            });
        }
        if (ewsCertificateData.applicant_dob != '0000-00-00') {
            $('#applicant_dob_for_ews_certificate').val(dateTo_DD_MM_YYYY(ewsCertificateData.applicant_dob));
        }
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_ewsview').click();
            }, 500);
        }
    },

    checkValidationForEwsCertificate: function (moduleType, ewsCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ewsCertificateData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!ewsCertificateData.village_name) {
            return getBasicMessageAndFieldJSONArray('village_name_for_ec', villageNameValidationMessage);
        }
        if (!ewsCertificateData.applicant_name) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_ec', applicantNameValidationMessage);
        }
        if (ewsCertificateData.constitution_artical == VALUE_ONE) {
            if (!ewsCertificateData.father_husbund_name) {
                return getBasicMessageAndFieldJSONArray('father_husbund_name_for_ec', applicantFatherHusbNameValidationMessage);
            }
        }

        if (ewsCertificateData.constitution_artical == VALUE_TWO) {
            if (!ewsCertificateData.relationship_of_applicant) {
                return getBasicMessageAndFieldJSONArray('relationship_of_applicant_for_ec', relationshipofApplicantValidationMessage);
            }
            if (!ewsCertificateData.guardian_address) {
                return getBasicMessageAndFieldJSONArray('guardian_address_for_ec', guardianAddressValidationMessage);
            }
            if (!ewsCertificateData.guardian_mobile_no) {
                return getBasicMessageAndFieldJSONArray('guardian_mobile_no_for_ec', mobileValidationMessage);
            }
            if (!ewsCertificateData.guardian_aadhaar) {
                return getBasicMessageAndFieldJSONArray('guardian_aadhaar_for_ec', invalidAadharNumberValidationMessage);
            }
            if (!ewsCertificateData.minor_child_name) {
                return getBasicMessageAndFieldJSONArray('minor_child_name_for_ec', minorChildNameValidationMessage);
            }
        }

        if (!ewsCertificateData.gender_for_ec) {
            $('#gender_for_ec_1').focus();
            return getBasicMessageAndFieldJSONArray('gender_for_ec', genderValidationMessage);
        }

        if (ewsCertificateData.constitution_artical == VALUE_ONE) {
            if (!ewsCertificateData.marital_status_for_ec) {
                $('#marital_status_for_ec_1').focus();
                return getBasicMessageAndFieldJSONArray('marital_status_for_ec', maritalStatusValidationMessage);
            }
        }

        if (!ewsCertificateData.applicant_dob) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_ec', birthDateValidationMessage);
        }
        if (!ewsCertificateData.applicant_age) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_ec', applicantAgeValidationMessage);
        }
        if (moduleType == VALUE_ONE) {
            return '';
        }
        if (!ewsCertificateData.born_place) {
            return getBasicMessageAndFieldJSONArray('born_place_for_ec', selectStateValidationMessage);
        }

        if (!ewsCertificateData.applicant_religion) {
            return getBasicMessageAndFieldJSONArray('applicant_religion_for_ec', religionValidationMessage);
        }

        if (!ewsCertificateData.applicant_caste) {
            return getBasicMessageAndFieldJSONArray('applicant_caste_for_ec', casteValidationMessage);
        }

        if (ewsCertificateData.constitution_artical == VALUE_ONE) {
            if (!ewsCertificateData.mobile_number) {
                return getBasicMessageAndFieldJSONArray('mobile_number_for_ec', mobileValidationMessage);
            }
        }
        if (ewsCertificateData.constitution_artical == VALUE_ONE) {
            if (!ewsCertificateData.aadhaar) {
                return getBasicMessageAndFieldJSONArray('aadhaar_for_ec', aadharNumberValidationMessage);
            }
            var validate = checkUID(ewsCertificateData.aadhaar);
            if (validate != '') {
                return getBasicMessageAndFieldJSONArray('aadhaar_for_ec', validate);
            }
        }
        if (!ewsCertificateData.present_police_station) {
            return getBasicMessageAndFieldJSONArray('present_police_station_for_ec', nearestPoliceStationValidationMessage);
        }

        if (!ewsCertificateData.present_post_office) {
            return getBasicMessageAndFieldJSONArray('present_post_office_for_ec', postOfficeValidationMessage);
        }
        if (!ewsCertificateData.applicant_education) {
            return getBasicMessageAndFieldJSONArray('applicant_education_for_ec', applicantEducationValidationMessage);
        }

        if (!ewsCertificateData.purpose_of_ews_certificate) {
            return getBasicMessageAndFieldJSONArray('present_post_office_for_ec', purposeValidationMessage);
        }

        if (!ewsCertificateData.reservation_cast_list_for_ews_certificate) {
            $('#reservation_cast_list_for_ews_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('reservation_cast_list_for_ews_certificate', oneOptionValidationMessage);
        }
        if (!ewsCertificateData.com_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('com_addr_house_no_for_ec', houseNoValidationMessage);
        }
        if (!ewsCertificateData.com_addr_street) {
            return getBasicMessageAndFieldJSONArray('com_addr_street_for_ec', streetValidationMessage);
        }
        if (!ewsCertificateData.com_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('com_addr_village_dmc_ward_for_ec', villageNameValidationMessage);
        }
        if (!ewsCertificateData.com_addr_city) {
            return getBasicMessageAndFieldJSONArray('com_addr_city_for_ec', selectCityValidationMessage);
        }

        if (!ewsCertificateData.com_pincode) {
            return getBasicMessageAndFieldJSONArray('com_pincode_for_ec', pincodeValidationMessage);
        }
        if (!ewsCertificateData.per_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('per_addr_house_no_for_ec', houseNoValidationMessage);
        }
        if (!ewsCertificateData.per_addr_street) {
            return getBasicMessageAndFieldJSONArray('per_addr_street_for_ec', streetValidationMessage);
        }
        if (!ewsCertificateData.per_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('per_addr_village_dmc_ward_for_ec', villageNameValidationMessage);
        }
        if (!ewsCertificateData.per_addr_city) {
            return getBasicMessageAndFieldJSONArray('per_addr_city_for_ec', selectCityValidationMessage);
        }
        if (!ewsCertificateData.per_pincode) {
            return getBasicMessageAndFieldJSONArray('per_pincode_for_ec', pincodeValidationMessage);
        }
        if (ewsCertificateData.constitution_artical == VALUE_ONE) {
            if (!ewsCertificateData.occupation) {
                return getBasicMessageAndFieldJSONArray('occupation_for_ec', occupationValidationMessage);
            }
            if (ewsCertificateData.occupation == VALUE_FOUR) {
                if (!ewsCertificateData.other_occupation) {
                    return getBasicMessageAndFieldJSONArray('other_occupation_for_ec', occupationValidationMessage);
                }
            }
        }
        if (!ewsCertificateData.father_name) {
            return getBasicMessageAndFieldJSONArray('father_name_for_ec', nameValidationMessage);
        }
        if (!ewsCertificateData.father_age) {
            return getBasicMessageAndFieldJSONArray('father_age_for_ec', ageValidationMessage);
        }
        if (!ewsCertificateData.father_occupation) {
            return getBasicMessageAndFieldJSONArray('father_occupation_for_ec', occupationValidationMessage);
        }
        if (!ewsCertificateData.father_remark) {
            return getBasicMessageAndFieldJSONArray('father_remark_for_ec', remarkValidationMessage);
        }
        if (!ewsCertificateData.mother_name) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_ec', nameValidationMessage);
        }
        if (!ewsCertificateData.mother_age) {
            return getBasicMessageAndFieldJSONArray('mother_age_for_ec', ageValidationMessage);
        }
        if (!ewsCertificateData.mother_occupation) {
            return getBasicMessageAndFieldJSONArray('mother_occupation_for_ec', occupationValidationMessage);
        }
        if (!ewsCertificateData.mother_remark) {
            return getBasicMessageAndFieldJSONArray('mother_remark_for_ec', remarkValidationMessage);
        }
        if (ewsCertificateData.constitution_artical == VALUE_ONE) {
            if (!ewsCertificateData.self_salary_detail) {
                return getBasicMessageAndFieldJSONArray('self_salary_detail_for_ec', salaryIncomeValidationMessage);
            }
            if (!ewsCertificateData.self_business_detail) {
                return getBasicMessageAndFieldJSONArray('self_business_detail_for_ec', businessIncomeValidationMessage);
            }
            if (!ewsCertificateData.self_agri_detail) {
                return getBasicMessageAndFieldJSONArray('self_agri_detail_for_ec', agriIncomeValidationMessage);
            }
            if (!ewsCertificateData.self_profe_detail) {
                return getBasicMessageAndFieldJSONArray('self_profe_detail_for_ec', professionalIncomeValidationMessage);
            }
            if (!ewsCertificateData.self_other_detail) {
                return getBasicMessageAndFieldJSONArray('self_other_detail_for_ec', otherIncomeValidationMessage);
            }
        }
        if (!ewsCertificateData.residental_flat_area) {
            return getBasicMessageAndFieldJSONArray('residental_flat_area_for_ec', areaValidationMessage);
        }
        if (!ewsCertificateData.residental_flat_location) {
            return getBasicMessageAndFieldJSONArray('residental_flat_location_for_ec', locationValidationMessage);
        }
        if (ewsCertificateData.constitution_artical == VALUE_TWO) {
            if (!ewsCertificateData.if_having_domicile_certi_for_ews_certificate) {
                $('#if_having_domicile_certi_for_ews_certificate_1').focus();
                return getBasicMessageAndFieldJSONArray('if_having_domicile_certi_for_ews_certificate', selectanyoneValidationMessage);
            }
        }
        if (!ewsCertificateData.have_you_own_house_for_ews_certificate) {
            $('#have_you_own_house_for_ews_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('have_you_own_house_for_ews_certificate', selectanyoneValidationMessage);
        }

        return '';
    },
    checkValidationForEwsCertificateForFamilyIncome: function (ewsCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ewsCertificateData.father_salary_detail) {
            return getBasicMessageAndFieldJSONArray('father_salary_detail_for_ec', salaryIncomeValidationMessage);
        }
        if (!ewsCertificateData.father_business_detail) {
            return getBasicMessageAndFieldJSONArray('father_business_detail_for_ec', businessIncomeValidationMessage);
        }
        if (!ewsCertificateData.father_agri_detail) {
            return getBasicMessageAndFieldJSONArray('father_agri_detail_for_ec', agriIncomeValidationMessage);
        }
        if (!ewsCertificateData.father_profe_detail) {
            return getBasicMessageAndFieldJSONArray('father_profe_detail_for_ec', professionalIncomeValidationMessage);
        }
        if (!ewsCertificateData.father_other_detail) {
            return getBasicMessageAndFieldJSONArray('father_other_detail_for_ec', otherIncomeValidationMessage);
        }
        if (!ewsCertificateData.mother_salary_detail) {
            return getBasicMessageAndFieldJSONArray('mother_salary_detail_for_ec', salaryIncomeValidationMessage);
        }
        if (!ewsCertificateData.mother_business_detail) {
            return getBasicMessageAndFieldJSONArray('mother_business_detail_for_ec', businessIncomeValidationMessage);
        }
        if (!ewsCertificateData.mother_agri_detail) {
            return getBasicMessageAndFieldJSONArray('mother_agri_detail_for_ec', agriIncomeValidationMessage);
        }
        if (!ewsCertificateData.mother_profe_detail) {
            return getBasicMessageAndFieldJSONArray('mother_profe_detail_for_ec', professionalIncomeValidationMessage);
        }
        if (!ewsCertificateData.mother_other_detail) {
            return getBasicMessageAndFieldJSONArray('mother_other_detail_for_ec', otherIncomeValidationMessage);
        }

        return '';
    },
    askForSubmitEwsCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'EwsCertificate.listview.submitEwsCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },

    submitEwsCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var ewsCertificateData = $('#ews_certificate_form').serializeFormJSON();
        var nativePlaceStateText = jQuery("#native_place_state_for_ec option:selected").text();
        var nativePlaceDistrictText = jQuery("#native_place_district_for_ec option:selected").text();
        var nativePlaceVillageText = jQuery("#native_place_village_for_ec option:selected").text();

        var validationData = that.checkValidationForEwsCertificate(moduleType, ewsCertificateData);
        if (validationData != '') {
            validationMessageShow('ews-certificate-' + validationData.field, validationData.message);
            $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }

        // ------------------------------------ Birth Stay Place ---------------------------------

        var icBirthStayPlaceItem = [];
        var isICBirthStayPlaceValidation = false;
        $('.detail_of_birth_stay_period_info').each(function () {
            var cntbp = $(this).find('.temp_cnt_bsp').val();
            var icBirthStayPlaceInfo = {};
            var bornPlaceState = $('#born_place_state_for_ec_' + cntbp).val();
            var bornPlaceStateText = jQuery("#born_place_state_for_ec_" + cntbp + " option:selected").text();
            if (moduleType != VALUE_ONE) {
                if (bornPlaceState == '' || bornPlaceState == null) {
                    $('#born_place_state_for_ec_' + cntbp).focus();
                    validationMessageShow('ews-certificate-born_place_state_for_ec_' + cntbp, selectStateValidationMessage);
                    isICBirthStayPlaceValidation = true;
                    return false;
                }
            }
            icBirthStayPlaceInfo.born_place_state = bornPlaceState;
            icBirthStayPlaceInfo.born_place_state_text = bornPlaceStateText;
            var bornPlaceDistrict = $('#born_place_district_for_ec_' + cntbp).val();
            var bornPlaceDistrictText = jQuery("#born_place_district_for_ec_" + cntbp + " option:selected").text();
            if (moduleType != VALUE_ONE) {
                if (bornPlaceDistrict == '' || bornPlaceDistrict == null) {
                    $('#born_place_district_for_ec_' + cntbp).focus();
                    validationMessageShow('ews-certificate-born_place_district_for_ec_' + cntbp, selectDistrictValidationMessage);
                    isICBirthStayPlaceValidation = true;
                    return false;
                }
            }
            icBirthStayPlaceInfo.born_place_district = bornPlaceDistrict;
            icBirthStayPlaceInfo.born_place_district_text = bornPlaceDistrictText;
            var bornPlaceVillage = $('#born_place_village_for_ec_' + cntbp).val();
            var bornPlaceVillageText = jQuery("#born_place_village_for_ec_" + cntbp + " option:selected").text();
            if (moduleType != VALUE_ONE) {
                if (bornPlaceVillage == '' || bornPlaceVillage == null) {
                    $('#born_place_village_for_ec_' + cntbp).focus();
                    validationMessageShow('ews-certificate-born_place_village_for_ec_' + cntbp, selectVillageValidationMessage);
                    isICBirthStayPlaceValidation = true;
                    return false;
                }
            }
            icBirthStayPlaceInfo.born_place_village = bornPlaceVillage;
            icBirthStayPlaceInfo.born_place_village_text = bornPlaceVillageText;
            var bornPlaceTehsil = $('#born_tehsil_for_ec_' + cntbp).val();
            if (moduleType != VALUE_ONE) {
                if (bornPlaceTehsil == '' || bornPlaceTehsil == null) {
                    $('#born_tehsil_for_ec_' + cntbp).focus();
                    validationMessageShow('ews-certificate-born_tehsil_for_ec_' + cntbp, tehsilValidationMessage);
                    isICBirthStayPlaceValidation = true;
                    return false;
                }
            }
            icBirthStayPlaceInfo.born_place_tehsil = bornPlaceTehsil;
            var bornPeriod = $('#born_period_for_ec_' + cntbp).val();
            if (moduleType != VALUE_ONE) {
                if (bornPeriod == '' || bornPeriod == null) {
                    $('#born_period_for_ec_' + cntbp).focus();
                    validationMessageShow('ews-certificate-born_period_for_ec_' + cntbp, bornPeriodValidationMessage);
                    isICBirthStayPlaceValidation = true;
                    return false;
                }
            }
            icBirthStayPlaceInfo.born_period = bornPeriod;
            icBirthStayPlaceItem.push(icBirthStayPlaceInfo);
        });
        if (isICBirthStayPlaceValidation) {
            return false;
        }

        // ---------------------------------------------------------------------------------------


        //---------------------------------sibling bro--------------------------------------
        var icSiblingBroItem = [];
        var isICSiblingBroValidation = false;
        $('.detail_of_sibling_bro_info').each(function () {
            var cnt2 = $(this).find('.temp_cnt').val();

            var icSiblingBroInfo = {};
            var siblingName = $('#sibling_bro_name_for_ec_' + cnt2).val();
            if (moduleType != VALUE_ONE) {
                if (siblingName == '' || siblingName == null) {
                    $('#sibling_bro_name_for_ec_' + cnt2).focus();
                    validationMessageShow('ews-certificate-sibling_bro_name_for_ec_' + cnt2, familyMemberNameValidationMessage);
                    isICSiblingBroValidation = true;
                    return false;
                }
            }
            icSiblingBroInfo.sibling_bro_name = siblingName;
            var sibAge = $('#sibling_bro_age_for_ec_' + cnt2).val();
            if (moduleType != VALUE_ONE) {
                if (sibAge == '' || sibAge == null) {
                    $('#sibling_bro_age_for_ec_' + cnt2).focus();
                    validationMessageShow('ews-certificate-sibling_bro_age_for_ec_' + cnt2, memberAgeValidationMessage);
                    isICSiblingBroValidation = true;
                    return false;
                }
            }
            icSiblingBroInfo.sibling_bro_age = sibAge;
            var siblBroOccu = $('#sibling_bro_occu_edu_for_ec_' + cnt2).val();
            if (moduleType != VALUE_ONE) {
                if (siblBroOccu == '' || siblBroOccu == null) {
                    $('#sibling_bro_occu_edu_for_ec_' + cnt2).focus();
                    validationMessageShow('ews-certificate-sibling_bro_occu_edu_for_ec_' + cnt2, memberAgeValidationMessage);
                    isICSiblingBroValidation = true;
                    return false;
                }
            }
            icSiblingBroInfo.sibling_bro_occu_edu = siblBroOccu;
            var siblBroRem = $('#sibling_bro_remark_for_ec_' + cnt2).val();
            if (moduleType != VALUE_ONE) {
                if (siblBroRem == '' || siblBroRem == null) {
                    $('#sibling_bro_remark_for_ec_' + cnt2).focus();
                    validationMessageShow('ews-certificate-sibling_bro_remark_for_ec_' + cnt2, memberAgeValidationMessage);
                    isICSiblingBroValidation = true;
                    return false;
                }
            }
            icSiblingBroInfo.sibling_bro_remark = siblBroRem;
            icSiblingBroItem.push(icSiblingBroInfo);
        });
        if (isICSiblingBroValidation) {
            return false;
        }
        //----------------------------sibling sis----------------------------------
        var icSiblingSisItem = [];
        var isICSiblingSisValidation = false;
        $('.detail_of_sibling_sis_info').each(function () {
            var cnt3 = $(this).find('.temp_cnt').val();
            var icSiblingSisInfo = {};
            var siblSisName = $('#sibling_sis_name_for_ec_' + cnt3).val();
            if (moduleType != VALUE_ONE) {
                if (siblSisName == '' || siblSisName == null) {
                    $('#sibling_sis_name_for_ec_' + cnt3).focus();
                    validationMessageShow('ews-certificate-sibling_sis_name_for_ec_' + cnt3, familyMemberNameValidationMessage);
                    isICSiblingSisValidation = true;
                    return false;
                }
            }
            icSiblingSisInfo.sibling_sis_name = siblSisName;
            var siblSisAge = $('#sibling_sis_age_for_ec_' + cnt3).val();
            if (moduleType != VALUE_ONE) {
                if (siblSisAge == '' || siblSisAge == null) {
                    $('#sibling_sis_age_for_ec_' + cnt3).focus();
                    validationMessageShow('ews-certificate-sibling_sis_age_for_ec_' + cnt3, memberRelationValidationMessage);
                    isICSiblingSisValidation = true;
                    return false;
                }
            }
            icSiblingSisInfo.sibling_sis_age = siblSisAge;
            var siblSisOccu = $('#sibling_sis_occu_edu_for_ec_' + cnt3).val();
            if (moduleType != VALUE_ONE) {
                if (siblSisOccu == '' || siblSisOccu == null) {
                    $('#sibling_sis_occu_edu_for_ec_' + cnt3).focus();
                    validationMessageShow('ews-certificate-sibling_sis_occu_edu_for_ec_' + cnt3, memberAgeValidationMessage);
                    isICSiblingSisValidation = true;
                    return false;
                }
            }
            icSiblingSisInfo.sibling_sis_occu_edu = siblSisOccu;
            var siblSisRem = $('#sibling_sis_remark_for_ec_' + cnt3).val();
            if (moduleType != VALUE_ONE) {
                if (siblSisRem == '' || siblSisRem == null) {
                    $('#sibling_sis_remark_for_ec_' + cnt3).focus();
                    validationMessageShow('ews-certificate-sibling_sis_remark_for_ec_' + cnt3, professionValidationMessage);
                    isICSiblingSisValidation = true;
                    return false;
                }
            }
            icSiblingSisInfo.sibling_sis_remark = siblSisRem;
            icSiblingSisItem.push(icSiblingSisInfo);

        });
        if (isICSiblingSisValidation) {
            return false;
        }
        //------------------------------son--------------------------
        var icFamilySonItem = [];
        var isICFamilySonValidation = false;
        $('.detail_of_children_son_info').each(function () {
            var cnt4 = $(this).find('.temp_cnt').val();
            var icFamilySonInfo = {};
            var sonName = $('#children_son_name_for_ec_' + cnt4).val();
            if (moduleType != VALUE_ONE) {
                if (sonName == '' || sonName == null) {
                    $('#children_son_name_for_ec_' + cnt4).focus();
                    validationMessageShow('ews-certificate-children_son_name_for_ec_' + cnt4, familyMemberNameValidationMessage);
                    isICFamilySonValidation = true;
                    return false;
                }
            }
            icFamilySonInfo.children_son_name = sonName;
            var sonAge = $('#children_son_age_for_ec_' + cnt4).val();
            if (moduleType != VALUE_ONE) {
                if (sonAge == '' || sonAge == null) {
                    $('#children_son_age_for_ec_' + cnt4).focus();
                    validationMessageShow('ews-certificate-children_son_age_for_ec_' + cnt4, memberRelationValidationMessage);
                    isICFamilySonValidation = true;
                    return false;
                }
            }
            icFamilySonInfo.children_son_age = sonAge;
            var sonOccu = $('#children_son_occu_edu_for_ec_' + cnt4).val();
            if (moduleType != VALUE_ONE) {
                if (sonOccu == '' || sonOccu == null) {
                    $('#children_son_occu_edu_for_ec_' + cnt4).focus();
                    validationMessageShow('ews-certificate-children_son_occu_edu_for_ec_' + cnt4, memberAgeValidationMessage);
                    isICFamilySonValidation = true;
                    return false;
                }
            }
            icFamilySonInfo.children_son_occu_edu = sonOccu;
            var sonRemk = $('#children_son_remark_for_ec_' + cnt4).val();
            if (moduleType != VALUE_ONE) {
                if (sonRemk == '' || sonRemk == null) {
                    $('#children_son_remark_for_ec_' + cnt4).focus();
                    validationMessageShow('ews-certificate-children_son_remark_for_ec_' + cnt4, professionValidationMessage);
                    isICFamilySonValidation = true;
                    return false;
                }
            }
            icFamilySonInfo.children_son_remark = sonRemk;
            icFamilySonItem.push(icFamilySonInfo);

        });
        if (isICFamilySonValidation) {
            return false;
        }
        //-----------------------daughter-------------------------------
        var icFamilyDaughterItem = [];
        var isICFamilyDaughterValidation = false;
        $('.detail_of_children_daughter_info').each(function () {
            var cnt5 = $(this).find('.temp_cnt').val();
            var icFamilyDaughterInfo = {};
            var daughterName = $('#children_daughter_name_for_ec_' + cnt5).val();
            if (moduleType != VALUE_ONE) {
                if (daughterName == '' || daughterName == null) {
                    $('#children_daughter_name_for_ec_' + cnt5).focus();
                    validationMessageShow('ews-certificate-children_daughter_name_for_ec_' + cnt5, familyMemberNameValidationMessage);
                    isICFamilyDaughterValidation = true;
                    return false;
                }
            }
            icFamilyDaughterInfo.children_daughter_name = daughterName;
            var daughterAge = $('#children_daughter_age_for_ec_' + cnt5).val();
            if (moduleType != VALUE_ONE) {
                if (daughterAge == '' || daughterAge == null) {
                    $('#children_daughter_age_for_ec_' + cnt5).focus();
                    validationMessageShow('ews-certificate-children_daughter_age_for_ec_' + cnt5, memberRelationValidationMessage);
                    isICFamilyDaughterValidation = true;
                    return false;
                }
            }
            icFamilyDaughterInfo.children_daughter_age = daughterAge;
            var daughterOccu = $('#children_daughter_occu_edu_for_ec_' + cnt5).val();
            if (moduleType != VALUE_ONE) {
                if (daughterOccu == '' || daughterOccu == null) {
                    $('#children_daughter_occu_edu_for_ec_' + cnt5).focus();
                    validationMessageShow('ews-certificate-children_daughter_occu_edu_for_ec_' + cnt5, memberAgeValidationMessage);
                    isICFamilyDaughterValidation = true;
                    return false;
                }
            }
            icFamilyDaughterInfo.children_daughter_occu_edu = daughterOccu;
            var daughterRemk = $('#children_daughter_remark_for_ec_' + cnt5).val();
            if (moduleType != VALUE_ONE) {
                if (daughterRemk == '' || daughterRemk == null) {
                    $('#children_daughter_remark_for_ec_' + cnt5).focus();
                    validationMessageShow('ews-certificate-children_daughter_remark_for_ec_' + cnt5, professionValidationMessage);
                    isICFamilyDaughterValidation = true;
                    return false;
                }
            }
            icFamilyDaughterInfo.children_daughter_remark = daughterRemk;
            icFamilyDaughterItem.push(icFamilyDaughterInfo);
        });
        if (isICFamilyDaughterValidation) {
            return false;
        }

        /////------------------------------------------------------

        var icFamilyMemberItem = [];
        var isICFamilyMemberValidation = false;
        $('.detail_of_income_asset_info').each(function () {
            var cnt1 = $(this).find('.temp_cnt').val();
            var icFamilyMemberInfo = {};
            var issuingAuth = $('#issuing_authority_for_ec_' + cnt1).val();
            if (moduleType != VALUE_ONE) {
                if (issuingAuth == '' || issuingAuth == null) {
                    $('#issuing_authority_for_ec_' + cnt1).focus();
                    validationMessageShow('ews-certificate-issuing_authority_for_ec_' + cnt1, authorityDetailsValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
            }
            icFamilyMemberInfo.issuing_authority = issuingAuth;
            var certyNo = $('#certificate_no_for_ec_' + cnt1).val();
            if (moduleType != VALUE_ONE) {
                if (certyNo == '' || certyNo == null) {
                    $('#certificate_no_for_ec_' + cnt1).focus();
                    validationMessageShow('ews-certificate-certificate_no_for_ec_' + cnt1, certyNoValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
            }
            icFamilyMemberInfo.certificate_no = certyNo;
            var issueDate = $('#issue_date_' + cnt1).val();
            if (moduleType != VALUE_ONE) {
                if (issueDate == '' || issueDate == null) {
                    $('#issue_date_' + cnt1).focus();
                    validationMessageShow('ews-certificate-issue_date_' + cnt1, dateValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
            }
            icFamilyMemberInfo.issue_date = issueDate;
            var validDate = $('#valid_up_to_date_' + cnt1).val();
            if (moduleType != VALUE_ONE) {
                if (validDate == '' || validDate == null) {
                    $('#valid_up_to_date_' + cnt1).focus();
                    validationMessageShow('ews-certificate-valid_up_to_date_' + cnt1, dateValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
            }
            icFamilyMemberInfo.valid_up_to_date = validDate;
            icFamilyMemberItem.push(icFamilyMemberInfo);
        });
        if (isICFamilyMemberValidation) {
            return false;
        }

        //-----------------------
        if (moduleType != VALUE_ONE) {
            var validationDataForIncome = that.checkValidationForEwsCertificateForFamilyIncome(ewsCertificateData);
            if (validationDataForIncome != '') {
                $('#' + validationDataForIncome.field).focus();
                validationMessageShow('ews-certificate-' + validationDataForIncome.field, validationDataForIncome.message);
                return false;
            }
        }

        //---------------------------------sibling bro Income--------------------------------------
        var icSiblingBroIncomeItem = [];
        var isICSiblingBroIncomeValidation = false;
        $('.detail_of_sibling_bro_income').each(function () {
            var cnt6 = $(this).find('.temp_cnt').val();

            var icSiblingBroIncome = {};
            var broSallary = $('#sibling_bro_salary_detail_for_ec_' + cnt6).val();
            if (moduleType != VALUE_ONE) {
                if (broSallary == '' || broSallary == null) {
                    $('#sibling_bro_salary_detail_for_ec_' + cnt6).focus();
                    validationMessageShow('ews-certificate-sibling_bro_salary_detail_for_ec_' + cnt6, salaryIncomeValidationMessage);
                    isICSiblingBroIncomeValidation = true;
                    return false;
                }
            }
            icSiblingBroIncome.sibling_bro_sallary = broSallary;
            var broBusiness = $('#sibling_bro_business_detail_for_ec_' + cnt6).val();
            if (moduleType != VALUE_ONE) {
                if (broBusiness == '' || broBusiness == null) {
                    $('#sibling_bro_business_detail_for_ec_' + cnt6).focus();
                    validationMessageShow('ews-certificate-sibling_bro_business_detail_for_ec_' + cnt6, businessIncomeValidationMessage);
                    isICSiblingBroIncomeValidation = true;
                    return false;
                }
            }
            icSiblingBroIncome.sibling_bro_business = broBusiness;
            var broAgri = $('#sibling_bro_agri_detail_for_ec_' + cnt6).val();
            if (moduleType != VALUE_ONE) {
                if (broAgri == '' || broAgri == null) {
                    $('#sibling_bro_agri_detail_for_ec_' + cnt6).focus();
                    validationMessageShow('ews-certificate-sibling_bro_agri_detail_for_ec_' + cnt6, agriIncomeValidationMessage);
                    isICSiblingBroIncomeValidation = true;
                    return false;
                }
            }
            icSiblingBroIncome.sibling_bro_agri = broAgri;
            var broProffe = $('#sibling_bro_profe_detail_for_ec_' + cnt6).val();
            if (moduleType != VALUE_ONE) {
                if (broProffe == '' || broProffe == null) {
                    $('#sibling_bro_profe_detail_for_ec_' + cnt6).focus();
                    validationMessageShow('ews-certificate-sibling_bro_profe_detail_for_ec_' + cnt6, professionalIncomeValidationMessage);
                    isICSiblingBroIncomeValidation = true;
                    return false;
                }
            }
            icSiblingBroIncome.sibling_bro_proffe = broProffe;
            var broOtherSour = $('#sibling_bro_other_detail_for_ec_' + cnt6).val();
            if (moduleType != VALUE_ONE) {
                if (broOtherSour == '' || broOtherSour == null) {
                    $('#sibling_bro_other_detail_for_ec_' + cnt6).focus();
                    validationMessageShow('ews-certificate-sibling_bro_other_detail_for_ec_' + cnt6, otherIncomeValidationMessage);
                    isICSiblingBroIncomeValidation = true;
                    return false;
                }
            }
            icSiblingBroIncome.sibling_bro_other_sour = broOtherSour;
            var broIncome = $('#sibling_bro_income_for_ec_' + cnt6).val();
            if (moduleType != VALUE_ONE) {
                if (broIncome == '' || broIncome == null) {
                    $('#sibling_bro_income_for_ec_' + cnt6).focus();
                    validationMessageShow('ews-certificate-sibling_bro_income_for_ec_' + cnt6, totalIncomeValidationMessage);
                    isICSiblingBroIncomeValidation = true;
                    return false;
                }
            }
            icSiblingBroIncome.sibling_bro_income = broIncome;
            icSiblingBroIncomeItem.push(icSiblingBroIncome);
        });
        if (isICSiblingBroIncomeValidation) {
            return false;
        }


        //----------------------------sibling sis Income----------------------------------
        var icSiblingSisIncomeItem = [];
        var isICSiblingSisIncomeValidation = false;
        $('.detail_of_sibling_sis_income').each(function () {
            var cnt7 = $(this).find('.temp_cnt').val();

            var icSiblingSisIncome = {};
            var sisSallary = $('#sibling_sis_salary_detail_for_ec_' + cnt7).val();
            if (moduleType != VALUE_ONE) {
                if (sisSallary == '' || sisSallary == null) {
                    $('#sibling_sis_salary_detail_for_ec_' + cnt7).focus();
                    validationMessageShow('ews-certificate-sibling_sis_salary_detail_for_ec_' + cnt7, salaryIncomeValidationMessage);
                    isICSiblingSisIncomeValidation = true;
                    return false;
                }
            }
            icSiblingSisIncome.sibling_sis_sallary = sisSallary;
            var sisBusiness = $('#sibling_sis_business_detail_for_ec_' + cnt7).val();
            if (moduleType != VALUE_ONE) {
                if (sisBusiness == '' || sisBusiness == null) {
                    $('#sibling_sis_business_detail_for_ec_' + cnt7).focus();
                    validationMessageShow('ews-certificate-sibling_sis_business_detail_for_ec_' + cnt7, businessIncomeValidationMessage);
                    isICSiblingSisIncomeValidation = true;
                    return false;
                }
            }
            icSiblingSisIncome.sibling_sis_business = sisBusiness;
            var sisAgri = $('#sibling_sis_agri_detail_for_ec_' + cnt7).val();
            if (moduleType != VALUE_ONE) {
                if (sisAgri == '' || sisAgri == null) {
                    $('#sibling_sis_agri_detail_for_ec_' + cnt7).focus();
                    validationMessageShow('ews-certificate-sibling_sis_agri_detail_for_ec_' + cnt7, agriIncomeValidationMessage);
                    isICSiblingSisIncomeValidation = true;
                    return false;
                }
            }
            icSiblingSisIncome.sibling_sis_agri = sisAgri;
            var sisProffe = $('#sibling_sis_profe_detail_for_ec_' + cnt7).val();
            if (moduleType != VALUE_ONE) {
                if (sisProffe == '' || sisProffe == null) {
                    $('#sibling_sis_profe_detail_for_ec_' + cnt7).focus();
                    validationMessageShow('ews-certificate-sibling_sis_profe_detail_for_ec_' + cnt7, professionalIncomeValidationMessage);
                    isICSiblingSisIncomeValidation = true;
                    return false;
                }
            }
            icSiblingSisIncome.sibling_sis_proffe = sisProffe;
            var sisOtherSour = $('#sibling_sis_other_detail_for_ec_' + cnt7).val();
            if (moduleType != VALUE_ONE) {
                if (sisOtherSour == '' || sisOtherSour == null) {
                    $('#sibling_sis_other_detail_for_ec_' + cnt7).focus();
                    validationMessageShow('ews-certificate-sibling_sis_other_detail_for_ec_' + cnt7, otherIncomeValidationMessage);
                    isICSiblingSisIncomeValidation = true;
                    return false;
                }
            }
            icSiblingSisIncome.sibling_sis_other_sour = sisOtherSour;
            var sisIncome = $('#sibling_sis_income_for_ec_' + cnt7).val();
            if (moduleType != VALUE_ONE) {
                if (sisIncome == '' || sisIncome == null) {
                    $('#sibling_sis_income_for_ec_' + cnt7).focus();
                    validationMessageShow('ews-certificate-sibling_sis_income_for_ec_' + cnt7, totalIncomeValidationMessage);
                    isICSiblingSisIncomeValidation = true;
                    return false;
                }
            }
            icSiblingSisIncome.sibling_sis_income = sisIncome;
            icSiblingSisIncomeItem.push(icSiblingSisIncome);
        });
        if (isICSiblingSisIncomeValidation) {
            return false;
        }


        //------------------------------son Income--------------------------
        var icSonIncomeItem = [];
        var isICSonIncomeValidation = false;
        $('.detail_of_son_income').each(function () {
            var cnt8 = $(this).find('.temp_cnt').val();

            var icSonIncome = {};
            var sonSallary = $('#son_salary_detail_for_ec_' + cnt8).val();
            if (moduleType != VALUE_ONE) {
                if (sonSallary == '' || sonSallary == null) {
                    $('#son_salary_detail_for_ec_' + cnt8).focus();
                    validationMessageShow('ews-certificate-son_salary_detail_for_ec_' + cnt8, salaryIncomeValidationMessage);
                    isICSonIncomeValidation = true;
                    return false;
                }
            }
            icSonIncome.son_sallary = sonSallary;
            var sonBusiness = $('#son_business_detail_for_ec_' + cnt8).val();
            if (moduleType != VALUE_ONE) {
                if (sonBusiness == '' || sonBusiness == null) {
                    $('#son_business_detail_for_ec_' + cnt8).focus();
                    validationMessageShow('ews-certificate-son_business_detail_for_ec_' + cnt8, businessIncomeValidationMessage);
                    isICSonIncomeValidation = true;
                    return false;
                }
            }
            icSonIncome.son_business = sonBusiness;
            var sonAgri = $('#son_agri_detail_for_ec_' + cnt8).val();
            if (moduleType != VALUE_ONE) {
                if (sonAgri == '' || sonAgri == null) {
                    $('#son_agri_detail_for_ec_' + cnt8).focus();
                    validationMessageShow('ews-certificate-son_agri_detail_for_ec_' + cnt8, agriIncomeValidationMessage);
                    isICSonIncomeValidation = true;
                    return false;
                }
            }
            icSonIncome.son_agri = sonAgri;
            var sonProffe = $('#son_profe_detail_for_ec_' + cnt8).val();
            if (moduleType != VALUE_ONE) {
                if (sonProffe == '' || sonProffe == null) {
                    $('#son_profe_detail_for_ec_' + cnt8).focus();
                    validationMessageShow('ews-certificate-son_profe_detail_for_ec_' + cnt8, professionalIncomeValidationMessage);
                    isICSonIncomeValidation = true;
                    return false;
                }
            }
            icSonIncome.son_proffe = sonProffe;
            var sonOtherSour = $('#son_other_detail_for_ec_' + cnt8).val();
            if (moduleType != VALUE_ONE) {
                if (sonOtherSour == '' || sonOtherSour == null) {
                    $('#son_other_detail_for_ec_' + cnt8).focus();
                    validationMessageShow('ews-certificate-son_other_detail_for_ec_' + cnt8, otherIncomeValidationMessage);
                    isICSonIncomeValidation = true;
                    return false;
                }
            }
            icSonIncome.son_other_sour = sonOtherSour;
            var sonIncome = $('#son_income_for_ec_' + cnt8).val();
            if (moduleType != VALUE_ONE) {
                if (sonIncome == '' || sonIncome == null) {
                    $('#son_income_for_ec_' + cnt8).focus();
                    validationMessageShow('ews-certificate-son_income_for_ec_' + cnt8, totalIncomeValidationMessage);
                    isICSonIncomeValidation = true;
                    return false;
                }
            }
            icSonIncome.son_income = sonIncome;
            icSonIncomeItem.push(icSonIncome);
        });
        if (isICSonIncomeValidation) {
            return false;
        }

        //-----------------------daughter Income-------------------------------
        var icDaughterIncomeItem = [];
        var isICDaughterIncomeValidation = false;
        $('.detail_of_daughter_income').each(function () {
            var cnt9 = $(this).find('.temp_cnt').val();

            var icDaughterIncome = {};
            var daughterSallary = $('#daughter_salary_detail_for_ec_' + cnt9).val();
            if (moduleType != VALUE_ONE) {
                if (daughterSallary == '' || daughterSallary == null) {
                    $('#daughter_salary_detail_for_ec_' + cnt9).focus();
                    validationMessageShow('ews-certificate-daughter_salary_detail_for_ec_' + cnt9, salaryIncomeValidationMessage);
                    isICDaughterIncomeValidation = true;
                    return false;
                }
            }
            icDaughterIncome.daughter_sallary = daughterSallary;
            var daughterBusiness = $('#daughter_business_detail_for_ec_' + cnt9).val();
            if (moduleType != VALUE_ONE) {
                if (daughterBusiness == '' || daughterBusiness == null) {
                    $('#daughter_business_detail_for_ec_' + cnt9).focus();
                    validationMessageShow('ews-certificate-daughter_business_detail_for_ec_' + cnt9, businessIncomeValidationMessage);
                    isICDaughterIncomeValidation = true;
                    return false;
                }
            }
            icDaughterIncome.daughter_business = daughterBusiness;
            var daughterAgri = $('#daughter_agri_detail_for_ec_' + cnt9).val();
            if (moduleType != VALUE_ONE) {
                if (daughterAgri == '' || daughterAgri == null) {
                    $('#daughter_agri_detail_for_ec_' + cnt9).focus();
                    validationMessageShow('ews-certificate-daughter_agri_detail_for_ec_' + cnt9, agriIncomeValidationMessage);
                    isICDaughterIncomeValidation = true;
                    return false;
                }
            }
            icDaughterIncome.daughter_agri = daughterAgri;
            var daughterProffe = $('#daughter_profe_detail_for_ec_' + cnt9).val();
            if (moduleType != VALUE_ONE) {
                if (daughterProffe == '' || daughterProffe == null) {
                    $('#daughter_profe_detail_for_ec_' + cnt9).focus();
                    validationMessageShow('ews-certificate-daughter_profe_detail_for_ec_' + cnt9, professionalIncomeValidationMessage);
                    isICDaughterIncomeValidation = true;
                    return false;
                }
            }
            icDaughterIncome.daughter_proffe = daughterProffe;
            var daughterOtherSour = $('#daughter_other_detail_for_ec_' + cnt9).val();
            if (moduleType != VALUE_ONE) {
                if (daughterOtherSour == '' || daughterOtherSour == null) {
                    $('#daughter_other_detail_for_ec_' + cnt9).focus();
                    validationMessageShow('ews-certificate-daughter_other_detail_for_ec_' + cnt9, otherIncomeValidationMessage);
                    isICDaughterIncomeValidation = true;
                    return false;
                }
            }
            icDaughterIncome.daughter_other_sour = daughterOtherSour;
            var daughterIncome = $('#daughter_income_for_ec_' + cnt9).val();
            if (moduleType != VALUE_ONE) {
                if (daughterIncome == '' || daughterIncome == null) {
                    $('#daughter_income_for_ec_' + cnt9).focus();
                    validationMessageShow('ews-certificate-daughter_income_for_ec_' + cnt9, totalIncomeValidationMessage);
                    isICDaughterIncomeValidation = true;
                    return false;
                }
            }
            icDaughterIncome.daughter_income = daughterIncome;
            icDaughterIncomeItem.push(icDaughterIncome);
        });
        if (isICDaughterIncomeValidation) {
            return false;
        }

        ewsCertificateData.module_type = moduleType;
        ewsCertificateData.detail_of_income_asset_info = icFamilyMemberItem;
        ewsCertificateData.detail_of_sibling_bro_info = icSiblingBroItem;
        ewsCertificateData.detail_of_sibling_sis_info = icSiblingSisItem;
        ewsCertificateData.detail_of_children_son_info = icFamilySonItem;
        ewsCertificateData.detail_of_children_daughter_info = icFamilyDaughterItem;
        ewsCertificateData.detail_of_sibling_bro_income = icSiblingBroIncomeItem;
        ewsCertificateData.detail_of_sibling_sis_income = icSiblingSisIncomeItem;
        ewsCertificateData.detail_of_son_income = icSonIncomeItem;
        ewsCertificateData.detail_of_daughter_income = icDaughterIncomeItem;
        ewsCertificateData.native_place_state_text = nativePlaceStateText;
        ewsCertificateData.native_place_district_text = nativePlaceDistrictText;
        ewsCertificateData.native_place_village_text = nativePlaceVillageText;

        ewsCertificateData.detail_of_birth_stay_place_info = icBirthStayPlaceItem;

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_ews_certificate') : (moduleType == VALUE_TWO ? $('#submit_btn_for_ews_certificate') : $('#fsubmit_btn_for_ews_certificate'));
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ews_certificate/submit_ews_certificate',
            data: $.extend({}, ewsCertificateData, getTokenData()),
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
                validationMessageShow('ews-certificate', textStatus.statusText);
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
                    validationMessageShow('ews-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                EwsCertificate.listview.loadEwsCertificateData();
                showSuccess(parseData.message);
            }
        });
    },
    askForApproveApplication: function (ewsCertificateId) {
        if (!ewsCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + ewsCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ews_certificate/get_ews_certificate_data_by_ews_certificate_id',
            type: 'post',
            data: $.extend({}, {'ews_certificate_id': ewsCertificateId}, getTokenData()),
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
                var ewsCertificateData = parseData.ews_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                var ecData = that.getBasicConfigurationForMovement(ewsCertificateData);
                $('#popup_container').html(ewsCertificateApproveTemplate(ecData));
                datePicker();
            }
        });
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_ews_certificate_form').serializeFormJSON();
        if (!formData.ews_certificate_id_for_ews_certificate_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_ews_certificate_approve) {
            $('#remarks_for_ews_certificate_approve').focus();
            validationMessageShow('ews_certificate-approve-remarks_for_ews_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_ews_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ews_certificate/approve_application',
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
                validationMessageShow('ews-certificate-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('ews-certificate-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                EwsCertificate.listview.loadEwsCertificateData();
            }
        });
    },
    downloadExcelForEC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_Ecge').val($('#app_no_for_ews_certificate_list').val());
        $('#app_date_for_Ecge').val($('#application_date_for_ews_certificate_list').val());
        $('#app_details_for_Ecge').val($('#app_details_for_ews_certificate_list').val());
        $('#vdw_for_Ecge').val(tempTypeInSession != TEMP_TYPE_A ? $('#vdw_for_ews_certificate_list').val() : '');
        $('#status_for_Ecge').val($('#status_for_ews_certificate_list').val());
        $('#qstatus_for_Ecge').val($('#query_status_for_ews_certificate_list').val());
        $('#app_status_for_Ecge').val($('#appointment_status_for_ews_certificate_list').val());
        $('#currently_on_for_Ecge').val($('#currently_on_for_ews_certificate_list').val());
        $('#generate_excel_for_ews_certificate').submit();
        $('.Ecge').val('');
    },
    getBasicConfigurationForMovement: function (ewsCertificateData) {
        ewsCertificateData.total_income_by_user_text = numberToWordsAmount(ewsCertificateData.total_income);
        ewsCertificateData.total_income_by_talathi_text = numberToWordsAmount(ewsCertificateData.income_by_talathi);
        if (ewsCertificateData.talathi_to_aci != VALUE_ZERO) {
            ewsCertificateData.show_talathi_updated_basic_details = true;
        }
        if (ewsCertificateData.aci_rec == VALUE_ONE || ewsCertificateData.aci_rec == VALUE_TWO) {
            ewsCertificateData.show_aci_updated_basic_details = true;
            ewsCertificateData.aci_rec_text = recArray[ewsCertificateData.aci_rec] ? recArray[ewsCertificateData.aci_rec] : '';
            if (ewsCertificateData.aci_rec == VALUE_ONE) {
                ewsCertificateData.act_to_mamlatdar_ldc_datetime_text = ewsCertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.aci_to_ldc_datetime) : '';
                ewsCertificateData.act_to_mamlatdar_ldc_name_text = ewsCertificateData.ldc_name;
            }
            if (ewsCertificateData.aci_rec == VALUE_TWO) {
                ewsCertificateData.act_to_mamlatdar_ldc_datetime_text = ewsCertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.aci_to_mamlatdar_datetime) : '';
                ewsCertificateData.act_to_mamlatdar_ldc_name_text = ewsCertificateData.mamlatdar_name;
            }
        }
        if (ewsCertificateData.ldc_to_mamlatdar != VALUE_ZERO && ewsCertificateData.aci_rec == VALUE_ONE) {
            ewsCertificateData.show_ldc_updated_basic_details = true;
            ewsCertificateData.ldc_to_mamlatdar_datetime_text = ewsCertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        if (ewsCertificateData.to_type_reverify != VALUE_ZERO) {
            ewsCertificateData.show_mam_reverify_updated_basic_details = true;
            ewsCertificateData.mam_reverification = ewsCertificateData.to_type_reverify == VALUE_ONE ? ewsCertificateData.talathi_name : ewsCertificateData.aci_name;
        }
        if (ewsCertificateData.talathi_to_type_reverify != VALUE_ZERO) {
            ewsCertificateData.talathi_reverification = ewsCertificateData.talathi_to_type_reverify == VALUE_ONE ? ewsCertificateData.aci_name : ewsCertificateData.mamlatdar_name;
            ewsCertificateData.show_talathi_reverify_updated_basic_details = true;
            ewsCertificateData.total_income_by_talathi_reverify_text = numberToWordsAmount(ewsCertificateData.income_by_talathi_reverify);
        }
        if (ewsCertificateData.aci_rec_reverify == VALUE_ONE || ewsCertificateData.aci_rec_reverify == VALUE_TWO) {
            ewsCertificateData.show_aci_reverify_updated_basic_details = true;
            ewsCertificateData.aci_rec_reverify_text = recArray[ewsCertificateData.aci_rec_reverify] ? recArray[ewsCertificateData.aci_rec_reverify] : '';
            if (ewsCertificateData.aci_rec_reverify == VALUE_ONE) {
                ewsCertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = ewsCertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.aci_to_ldc_datetime) : '';
                ewsCertificateData.act_to_mamlatdar_ldc_reverify_name_text = ewsCertificateData.ldc_name;
            }
            if (ewsCertificateData.aci_rec_reverify == VALUE_TWO) {
                ewsCertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = ewsCertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.aci_to_reverify_datetime) : '';
                ewsCertificateData.act_to_mamlatdar_ldc_reverify_name_text = ewsCertificateData.mamlatdar_name;
            }
        }
        if (ewsCertificateData.ldc_to_mamlatdar != VALUE_ZERO && ewsCertificateData.aci_rec_reverify == VALUE_ONE) {
            ewsCertificateData.show_ldc_reverify_updated_basic_details = true;
            ewsCertificateData.ldc_to_mamlatdar_datetime_text = ewsCertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        ewsCertificateData.talathi_to_aci_datetime_text = ewsCertificateData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.talathi_to_aci_datetime) : '';
        ewsCertificateData.aci_to_mamlatdar_datetime_text = ewsCertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.aci_to_mamlatdar_datetime) : '';
        ewsCertificateData.mam_to_reverify_datetime_text = ewsCertificateData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.mam_to_reverify_datetime) : '';
        ewsCertificateData.talathi_to_reverify_datetime_text = ewsCertificateData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.talathi_to_reverify_datetime) : '';
        ewsCertificateData.aci_to_reverify_datetime_text = ewsCertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(ewsCertificateData.aci_to_reverify_datetime) : '';
        return ewsCertificateData;
    },
    askForRejectApplication: function (ewsCertificateId) {
        if (!ewsCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + ewsCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ews_certificate/get_ews_certificate_data_by_ews_certificate_id',
            type: 'post',
            data: $.extend({}, {'ews_certificate_id': ewsCertificateId}, getTokenData()),
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
                var ewsCertificateData = parseData.ews_certificate_data;
                showPopup();
                var ecData = that.getBasicConfigurationForMovement(ewsCertificateData);
                $('#popup_container').html(ewsCertificateRejectTemplate(ecData));
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_ews_certificate_form').serializeFormJSON();
        if (!formData.ews_certificate_id_for_ews_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_ews_certificate_reject) {
            $('#remarks_for_ews_certificate_reject').focus();
            validationMessageShow('ews_certificate-reject-remarks_for_ews_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_ews_certificate_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ews_certificate/reject_application',
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
                validationMessageShow('ews-certificate-reject', textStatus.statusText);
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
                    validationMessageShow('ews-certificate-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                EwsCertificate.listview.loadEwsCertificateData();
            }
        });
    },

    FillBilling: function () {
        if ($("#billingtoo_for_ec").is(":checked")) {
            $('#per_village_town_for_ec').val($('#present_village_town_for_ec').val());
            $('#per_police_station_for_ec').val($('#present_police_station_for_ec').val());
            $('#per_post_office_for_ec').val($('#present_post_office_for_ec').val());
            $('#per_addr_state_for_ec').val($('#present_add_state_for_ec').val());
            var stateCode = $('#present_add_state_for_ec').val();
            var districtData = tempDistrictData[stateCode] ? tempDistrictData[stateCode] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_addr_district_for_ec', 'district_code', 'district_name', 'District');
            $('#per_addr_district_for_ec').val($('#present_add_district_for_ec').val());

            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(tempVillageDataForEC, 'per_addr_village_for_ec', 'village_code', 'village_name', 'Select Village');
            $('#per_addr_village_for_ec').val($('#present_add_village_for_ec').val());

            $('#pincode_for_ec').val($('#present_addr_pincode_for_ec').val());

        } else {
            $('#per_village_town_for_ec').val('');
            $('#per_police_station_for_ec').val('');
            $('#per_post_office_for_ec').val('');
            $('#per_addr_state_for_ec').val('');
            $('#per_addr_district_for_ec').val('');
            $('#per_addr_village_for_ec').val('');
            $('#pincode_for_ec').val('');
        }
        generateSelect2();
    },
    getConstitution: function (constitution) {
        var val = constitution.value;
        if (val == '') {
            return false;
        }
        if (val === '1') {
            this.$('#main_div').show();
            this.$('.applicant_name_for_ec_div').show();
            this.$('.gurdian_name_for_ec_div').hide();
            this.$('.guardian_div_one').hide();
            this.$('.guardian_div_two').hide();
            this.$('.guardian_div_three').hide();
            this.$('.marital_status_div_for_ec').show();
            this.$('.occupation_div_for_ec').show();

        }
        if (val === '2') {
            this.$('#main_div').show();
            this.$('.applicant_name_for_ec_div').hide();
            this.$('.gurdian_name_for_ec_div').show();
            this.$('.guardian_div_one').show();
            this.$('.guardian_div_two').show();
            this.$('.guardian_div_three').show();
            this.$('.marital_status_div_for_ec').hide();
            this.$('.spouse_info_item_container_for_ec').hide();
            this.$('.occupation_div_for_ec').hide();

        }

    },

    getDistrictFornDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_district_for_ec');
        var state = obj.val();
        if (!state) {
            return false;
        }
        if (state != VALUE_ONE && state != VALUE_TWO) {
            return false;
        }
        var districtData = state == VALUE_ONE ? damandiudistrictArray : (state == VALUE_TWO ? dnhdistrictArray : []);
        renderOptionsForTwoDimensionalArray(districtData, id + '_district_for_ec');
    },
    getVillageDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_village_for_ec');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var districtData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
        renderOptionsForTwoDimensionalArray(districtData, id + '_village_for_ec');
    },
    downloadCertificate: function (ewsCertificateId, moduleType) {
        if (!ewsCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#ews_certificate_id_for_certificate').val(ewsCertificateId);
        $('#mtype_for_certificate').val(moduleType);
        $('#ews_certificate_pdf_form').submit();
        $('#ews_certificate_id_for_certificate').val('');
        $('#mtype_for_certificate').val('');
    },
    getQueryData: function (ewsCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ewsCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_SEVEN;
        templateData.module_id = ewsCertificateId;
        var btnObj = $('#query_btn_for_app_' + ewsCertificateId);
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
                tmpData.module_type = VALUE_SEVEN;
                tmpData.module_id = ewsCertificateId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },

    setAppointment: function (ewsCertificateId) {
        if (!ewsCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + ewsCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'ews_certificate/get_appointment_data_by_ews_certificate_id',
            type: 'post',
            data: $.extend({}, {'ews_certificate_id': ewsCertificateId}, getTokenData()),
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
                if (appointmentData.status == VALUE_FIVE || appointmentData.status == VALUE_SIX) {
                    appointmentData.show_submit_btn = false;
                } else {
                    appointmentData.show_submit_btn = appointmentData.talathi_to_aci != VALUE_ZERO ? false : true;
                }

                $('#popup_container').html(ewsCertificateAppointmentTemplate(appointmentData));
                if (appointmentData.online_statement == VALUE_ONE) {
                    $('#online_statement_for_ews_certificate').attr('checked', 'checked');
                }
                if (appointmentData.visit_office == VALUE_ONE) {
                    $('#visit_office_for_ews_certificate').attr('checked', 'checked');
                }
                loadAppointmentHistory('ews_certificate', appointmentData);
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
        var formData = $('#set_appointment_ews_certificate_form').serializeFormJSON();
        if (!formData.ews_certificate_id_for_ews_certificate_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_ews_certificate) {
            //$('#appointment_date_for_ews_certificate').focus();
            validationMessageShow('ews-certificate-appointment_date_for_ews_certificate', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_ews_certificate) {
            //$('#appointment_time_for_ews_certificate').focus();
            validationMessageShow('ews-certificate-appointment_time_for_ews_certificate', timeValidationMessage);
            return false;
        }
        var start_date = dateTo_YYYY_MM_DD(formData.appointment_date_for_ews_certificate); // Oct 1, 2014
        var d = new Date();
        var end_date = d.setDate(d.getDate() - 1);
        var new_start_date = new Date(start_date);
        var new_end_date = new Date(end_date);

        if (new_end_date > new_start_date) {
            //$('#appointment_date_for_ews_certificate').focus();
            validationMessageShow('ews-certificate-appointment_date_for_ews_certificate', appointmentDateSelectValidationMessage);
            return false;
        }
        if (formData.online_statement_for_ews_certificate == undefined && formData.visit_office_for_ews_certificate == undefined) {
            $('#visit_office_for_ews_certificate').focus();
            validationMessageShow('ews-certificate-visit_office_for_ews_certificate', appointmentTypeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_ews_certificate_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ews_certificate/submit_set_appointment',
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
                validationMessageShow('ews-certificate-set-appointment', textStatus.statusText);
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
                    validationMessageShow('ews-certificate-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var ewsCertificateData = parseData.ews_certificate_data;

                if (ewsCertificateData.appointment_date != '0000-00-00') {
                    var d1 = (dateTo_DD_MM_YYYY(ewsCertificateData.appointment_date)).split("-");
                    var d2 = (dateTo_DD_MM_YYYY()).split("-");
                    d1 = d1[2].concat(d1[1], d1[0]);
                    d2 = d2[2].concat(d2[1], d2[0]);
                    if (parseInt(d2) >= parseInt(d1)) {
                        //ewsCertificateData.show_forward_btn = true;
                        $('#update_basic_detail_btn_for_app_' + ewsCertificateData.ews_certificate_id).show();
                    } else {
                        $('#update_basic_detail_btn_for_app_' + ewsCertificateData.ews_certificate_id).hide();
                    }
                }

                $('#appointment_container_' + ewsCertificateData.ews_certificate_id).html(that.getAppointmentData(ewsCertificateData));
                $('#movement_for_ec_list_' + ewsCertificateData.ews_certificate_id).html(movementString(ewsCertificateData));
            }
        });
    },
    reverifyApplication: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_ews_certificate_form').serializeFormJSON();
        if (!formData.ews_certificate_id_for_ews_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if (!formData.to_type_reverify_for_ews_certificate) {
                $('#to_type_reverify_for_ews_certificate_1').focus();
                validationMessageShow('ews-certificate-update-basic-detail-to_type_reverify_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.mam_reverify_remarks_for_ews_certificate) {
                $('#mam_reverify_remarks_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-mam_reverify_remarks_for_ews_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.talathi_to_type_reverify_for_ews_certificate) {
                $('#talathi_to_type_reverify_for_ews_certificate_1').focus();
                validationMessageShow('ews-certificate-update-basic-detail-talathi_to_type_reverify_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.upload_reverification_document_for_ews_certificate) {
                $('#upload_reverification_document_for_ews_certificate_1').focus();
                validationMessageShow('ews-certificate-update-basic-detail-upload_reverification_document_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_reverification_document_for_ews_certificate == VALUE_ONE) {
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
            if (!formData.talathi_reverify_remarks_for_ews_certificate) {
                $('#talathi_reverify_remarks_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-talathi_reverify_remarks_for_ews_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_reverify_for_ews_certificate) {
                $('#aci_rec_reverify_for_ews_certificate_1').focus();
                validationMessageShow('ews-certificate-update-basic-detail-aci_rec_reverify_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_reverify_remarks_for_ews_certificate) {
                $('#aci_reverify_remarks_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-aci_reverify_remarks_for_ews_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_ews_certificate == VALUE_ONE && !formData.aci_to_ldc_reverify_for_ews_certificate) {
                $('#aci_to_ldc_reverify_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-aci_to_ldc_reverify_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_ews_certificate == VALUE_ONE && !formData.aci_to_type_reverify_for_ews_certificate) {
                $('#aci_to_type_reverify_for_ews_certificate_1').focus();
                validationMessageShow('ews-certificate-update-basic-detail-aci_to_type_reverify_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            if (!formData.ldc_applicant_name_for_ews_certificate) {
                $('#ldc_applicant_name_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_applicant_name_for_ews_certificate', applicantNameValidationMessage);
                return false;
            }
            if (!formData.pre_house_no) {
                $('#pre_house_no_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-pre_house_no_for_ews_certificate', houseNoValidationMessage);
                return false;
            }
            if (!formData.pre_house_name) {
                $('#pre_house_name_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-pre_house_name_for_ews_certificate', houseNameValidationMessage);
                return false;
            }
            if (!formData.pre_street) {
                $('#pre_street_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-pre_street_for_ews_certificate', streetValidationMessage);
                return false;
            }
            if (!formData.pre_village) {
                $('#pre_village_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-pre_village_for_ews_certificate', villagewardValidationMessage);
                return false;
            }
            if (!formData.pre_city) {
                $('#pre_city_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-pre_city_for_ews_certificate', selectCityValidationMessage);
                return false;
            }
            if (!formData.pre_pincode) {
                $('#pre_pincode_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-pre_pincode_for_ews_certificate', pincodeValidationMessage);
                return false;
            }
            if (!formData.ldc_financial_year_for_ews_certificate) {
                $('#ldc_financial_year_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_financial_year_for_ews_certificate', financialYearValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_ews_certificate) {
                $('#ldc_to_mamlatdar_remarks_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_ews_certificate', remarksValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_for_ews_certificate) {
                $('#ldc_to_mamlatdar_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_to_mamlatdar_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'ews_certificate/reverify_application',
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
                validationMessageShow('ews-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('ews-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var icData = parseData.ews_certificate_data;
                if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
                    $('#status_' + formData.ews_certificate_id_for_ews_certificate_update_basic_detail).html(appStatusArray[VALUE_THREE]);
                    var reverificationName = formData.to_type_reverify_for_ews_certificate == VALUE_ONE ? formData.talathi_name_for_ews_certificate_update_basic_detail : formData.aci_name_for_ews_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.ews_certificate_id_for_ews_certificate_update_basic_detail).html('<hr>' + reverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    var talathiReverificationName = formData.talathi_to_type_reverify_for_ews_certificate == VALUE_ONE ? formData.aci_name_for_ews_certificate_update_basic_detail : formData.mamlatdar_name_for_ews_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.ews_certificate_id_for_ews_certificate_update_basic_detail).html('<hr>' + talathiReverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    if (icData.aci_rec_reverify == VALUE_ONE) {
                        $('#reverification_status_' + formData.ews_certificate_id_for_ews_certificate_update_basic_detail).html('<hr>' + icData.ldc_name);
                    } else {
                        $('#reverification_status_' + formData.ews_certificate_id_for_ews_certificate_update_basic_detail).html('<hr>' + formData.mamlatdar_name_for_ews_certificate_update_basic_detail);
                    }
                }
                $('#movement_for_ec_list_' + formData.ews_certificate_id_for_ews_certificate_update_basic_detail).html(movementString(parseData.ews_certificate_data));
                resetModelMD();
            }
        });
    },

    updateBasicDetails: function (btnObj, ewsCertificateId) {
        if (!ewsCertificateId) {
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
            url: 'ews_certificate/get_update_basic_detail_data_by_ews_certificate_id',
            type: 'post',
            data: $.extend({}, {'ews_certificate_id': ewsCertificateId}, getTokenData()),
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

                basicDetailData.VALUE_ONE = VALUE_ONE;
                basicDetailData.VALUE_TWO = VALUE_TWO;
                basicDetailData.total_income_by_user_text = numberToWordsAmount(basicDetailData.total_income);

                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_talathi_enter_basic_details = true;
                }
                if (basicDetailData.talathi_to_aci != VALUE_ZERO) {
                    basicDetailData.show_talathi_updated_basic_details = true;
                    basicDetailData.total_income_by_talathi_text = numberToWordsAmount(basicDetailData.income_by_talathi);
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                    basicDetailData.show_aci_enter_basic_details = true;
                    basicDetailData.show_submit_btn = true;
                }
                if (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_TWO || basicDetailData.aci_rec == VALUE_THREE) {
                    basicDetailData.show_aci_updated_basic_details = true;
                    //       basicDetailData.aci_rec_text = recmigArray[basicDetailData.aci_rec] ? recmigArray[basicDetailData.aci_rec] : '';
                    basicDetailData.aci_rec_text = recmigArray[basicDetailData.aci_rec] ? recmigArray[basicDetailData.aci_rec] : '';
                    if (basicDetailData.aci_rec == VALUE_ONE) {
                        basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_ldc_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.ldc_name;
                    }
                    if (basicDetailData.aci_rec == VALUE_TWO) {
                        basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_mamlatdar_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.mamlatdar_name;
                    }
                    if (basicDetailData.aci_rec == VALUE_THREE) {
                        basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_ldc_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.ldc_name;
                    }
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_LDC_USER && (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_THREE) &&
                        basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                    basicDetailData.show_ldc_enter_basic_details = true;
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'application_year', 'ldc_financial_year', 'ldc_fin_yr');
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_enter_minor_child_details = true;
                        basicDetailData = ldcAppDetails(basicDetailData, 'minor_child_name', 'ldc_minor_child_name', 'ldc_mc_name');
                    }
                    if (basicDetailData.ldc_pr == '') {
                        basicDetailData.full_pr = basicDetailData.com_addr_village_dmc_ward.concat(", ", basicDetailData.com_addr_city);
                    } else {
                        basicDetailData.full_pr = basicDetailData.ldc_pr;
                    }
                    if (basicDetailData.ldc_address == '') {
                        basicDetailData.full_address = basicDetailData.com_addr_house_no.concat(", ", basicDetailData.com_addr_house_name, ", ", basicDetailData.com_addr_street);
                    } else {
                        basicDetailData.full_address = basicDetailData.ldc_address;
                    }
                    if (basicDetailData.ldc_religion_caste == '') {
                        basicDetailData.religion_caste = basicDetailData.applicant_religion.concat(" / ", basicDetailData.applicant_caste);
                    } else {
                        basicDetailData.religion_caste = basicDetailData.ldc_religion_caste;
                    }
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_THREE)) {
                    basicDetailData.show_ldc_updated_basic_details = true;
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_updated_minor_child_details = true;
                    }
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
                    basicDetailData.total_income_by_talathi_reverify_text = numberToWordsAmount(basicDetailData.income_by_talathi_reverify);
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                        basicDetailData.status == VALUE_THREE &&
                        (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                    basicDetailData.show_aci_reverify_enter_basic_details = true;
                    basicDetailData.show_reverify_submit_btn = true;
                }
                if (basicDetailData.aci_rec_reverify == VALUE_ONE || basicDetailData.aci_rec_reverify == VALUE_TWO || basicDetailData.aci_rec_reverify == VALUE_THREE) {
                    basicDetailData.show_aci_reverify_updated_basic_details = true;

                    basicDetailData.aci_rec_reverify_text = recmigArray[basicDetailData.aci_rec_reverify] ? recmigArray[basicDetailData.aci_rec_reverify] : '';
                    if (basicDetailData.aci_rec_reverify == VALUE_ONE) {
                        basicDetailData.act_to_mamlatdar_ldc_reverify_datetime_text = basicDetailData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_ldc_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_reverify_name_text = basicDetailData.ldc_name;
                    }
                    if (basicDetailData.aci_rec_reverify == VALUE_TWO) {
                        basicDetailData.act_to_mamlatdar_ldc_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_reverify_name_text = basicDetailData.mamlatdar_name;
                    }
                    if (basicDetailData.aci_rec_reverify == VALUE_THREE) {
                        basicDetailData.act_to_mamlatdar_ldc_reverify_datetime_text = basicDetailData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_ldc_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_reverify_name_text = basicDetailData.ldc_name;
                    }
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_LDC_USER && (basicDetailData.aci_rec_reverify == VALUE_ONE || basicDetailData.aci_rec_reverify == VALUE_THREE) &&
                        basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                    basicDetailData.show_ldc_reverify_enter_basic_details = true;
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'application_year', 'ldc_financial_year', 'ldc_fin_yr');
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_reverify_enter_minor_child_details = true;
                        basicDetailData = ldcAppDetails(basicDetailData, 'minor_child_name', 'ldc_minor_child_name', 'ldc_mc_name');
                    }
                    if (basicDetailData.ldc_pr == '') {
                        basicDetailData.full_pr = basicDetailData.com_addr_village_dmc_ward.concat(", ", basicDetailData.com_addr_city);
                    } else {
                        basicDetailData.full_pr = basicDetailData.ldc_pr;
                    }
                    if (basicDetailData.ldc_address == '') {
                        basicDetailData.full_address = basicDetailData.com_addr_house_no + (basicDetailData.com_addr_house_name != '' ? (", " + basicDetailData.com_addr_house_name) : '')
                                + (basicDetailData.com_addr_street != '' ? (", " + basicDetailData.com_addr_street) : '');
                    } else {
                        basicDetailData.full_address = basicDetailData.ldc_address;
                    }
                    if (basicDetailData.ldc_religion_caste == '') {
                        basicDetailData.religion_caste = basicDetailData.applicant_religion.concat(" / ", basicDetailData.applicant_caste);
                    } else {
                        basicDetailData.religion_caste = basicDetailData.ldc_religion_caste;
                    }
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && (basicDetailData.aci_rec_reverify == VALUE_ONE || basicDetailData.aci_rec_reverify == VALUE_THREE)) {
                    basicDetailData.show_ldc_reverify_updated_basic_details = true;
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_reverify_updated_minor_child_details = true;
                    }
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                }
                basicDetailData.title = basicDetailData.to_type_reverify == VALUE_ZERO ? (tempTypeInSession == TEMP_TYPE_TALATHI_USER ? 'Forward for Verification' : (tempTypeInSession == TEMP_TYPE_ACI_USER ? 'Forward for Approval' : 'Update Basic Details')) : 'Reverification EWS Certificate Form';
                basicDetailData.talathi_to_aci_datetime_text = basicDetailData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_aci_datetime) : '';
                basicDetailData.mam_to_reverify_datetime_text = basicDetailData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.mam_to_reverify_datetime) : '';
                basicDetailData.talathi_to_reverify_datetime_text = basicDetailData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_reverify_datetime) : '';
                basicDetailData.aci_to_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';

                if (basicDetailData.status == VALUE_FIVE || basicDetailData.status == VALUE_SIX) {
                    basicDetailData.show_approve_reject_details = true;
                    basicDetailData.status_text = returnAppStatus(basicDetailData.status);
                    basicDetailData.status_datetime_text = basicDetailData.status_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.status_datetime) : '';
                    basicDetailData.title = 'Movement Details of EWS Certificate Form';
                }

                if (basicDetailData.constitution_artical == VALUE_ONE) {
                    basicDetailData.show_minor_detail = false;
                    basicDetailData.show_marital_detail = true;
                    basicDetailData.show_marital_status_data = true;
                    //  basicDetailData.show_permanent_adder = true;
                } else {
                    basicDetailData.show_education_tbl = true;
                    basicDetailData.show_minor_detail = true;
                    basicDetailData.show_marital_detail = false;
                    basicDetailData.show_marital_status_data = false;
                }

                basicDetailData.show_minor_detail = false;

                if (basicDetailData.marital_status == VALUE_TWO) {
                    basicDetailData.show_spouse_data = true;
                }
                basicDetailData.marital_status = maritalStatusArray[basicDetailData.marital_status];
                basicDetailData.com_pincode = basicDetailData.com_pincode == '0' ? basicDetailData.pincode : basicDetailData.com_pincode;
                basicDetailData.election_no = basicDetailData.election_no == '' ? '-' : basicDetailData.election_no;
                basicDetailData.father_election_no = basicDetailData.father_election_no == '' ? '-' : basicDetailData.father_election_no;
                basicDetailData.mother_election_no = basicDetailData.mother_election_no == '' ? '-' : basicDetailData.mother_election_no;
                basicDetailData.spouse_election_no = basicDetailData.spouse_election_no == '' ? '-' : basicDetailData.spouse_election_no;
                basicDetailData.relationship_of_applicant_text = relationDeceasedPersonArray[basicDetailData.relationship_of_applicant] ? relationDeceasedPersonArray[basicDetailData.relationship_of_applicant] : '';
                basicDetailData.obccaste_text = applicantobccasteArray[basicDetailData.obccaste] ? applicantobccasteArray[basicDetailData.obccaste] : '';

                basicDetailData.required_purpose = basicDetailData.select_required_purpose == VALUE_ONE ? 'Old Age Pension' : basicDetailData.required_purpose;

                basicDetailData.com_addr_city = damanCityArray[basicDetailData.com_addr_city] == undefined ? basicDetailData.com_addr_city : damanCityArray[basicDetailData.com_addr_city];
                basicDetailData.status = queryStatus(basicDetailData.query_status);

                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    $('#model_md_title').html(basicDetailData.title);
                    $('#model_md_body').html(ewsCertificateUpdateBasicDetailTemplate(basicDetailData));
                } else {
                    basicDetailData.show_card = true;
                    $('#popup_container').html(ewsCertificateUpdateBasicDetailTemplate(basicDetailData));
                }
                if (basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) {
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.aci_data, 'talathi_to_aci_for_ews_certificate', 'sa_user_id', 'name', '', false);
                        generateBoxes('radio', yesNoArray, 'upload_verification_document', 'ews_certificate', basicDetailData.is_upload_verification_document, false, false);
                        showSubContainer('upload_verification_document', 'ews_certificate', '#field_verification_document_uploads', VALUE_ONE, 'radio');

                        if (basicDetailData.field_documents != '') {
                            $.each(basicDetailData.field_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_ONE);
                                $('#upload_verification_document_for_ews_certificate_1').attr('checked', 'checked');
                                $('#field_verification_document_uploads_container_for_ews_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_ONE);
                            $('#upload_verification_document_for_ews_certificate_2').attr('checked', 'checked');
                        }

                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                        basicDetailData.aci_rec = (basicDetailData.aci_rec == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec);
                        generateBoxes('radio', recArray, 'aci_rec', 'ews_certificate', basicDetailData.aci_rec, false, false);
                        showSubContainer('aci_rec', 'ews_certificate', '#aci_to_ldc', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec', 'ews_certificate', '#aci_to_mamlatdar', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'aci_to_mamlatdar_for_ews_certificate', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_for_ews_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_THREE) &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'ldc_to_mamlatdar_for_ews_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.to_type_reverify == VALUE_ZERO) {
                        generateBoxes('radio', reverifyTypeArray, 'to_type_reverify', 'ews_certificate', basicDetailData.to_type_reverify, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.to_type_reverify == VALUE_ONE) {
                        generateBoxes('radio', talathiReverifyTypeArray, 'talathi_to_type_reverify', 'ews_certificate', basicDetailData.talathi_to_type_reverify, false);
                        generateBoxes('radio', yesNoArray, 'upload_reverification_document', 'ews_certificate', basicDetailData.is_upload_reverification_document, false, false);
                        showSubContainer('upload_reverification_document', 'ews_certificate', '#field_reverification_document_uploads', VALUE_ONE, 'radio');

                        if (basicDetailData.field_reverify_documents != '') {
                            $.each(basicDetailData.field_reverify_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_TWO);
                                $('#upload_reverification_document_for_ews_certificate_1').attr('checked', 'checked');
                                $('#field_reverification_document_uploads_container_for_ews_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_TWO);
                            $('#upload_reverification_document_for_ews_certificate_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                            (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                        var tempArray = [];
                        tempArray[VALUE_ZERO] = basicDetailData.mamlatdar_name;
                        generateBoxes('radio', tempArray, 'aci_to_type_reverify', 'ews_certificate', VALUE_ZERO, false);

                        basicDetailData.aci_rec_reverify = (basicDetailData.aci_rec_reverify == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec_reverify);
                        generateBoxes('radio', recArray, 'aci_rec_reverify', 'ews_certificate', basicDetailData.aci_rec_reverify, false, false);
                        showSubContainer('aci_rec_reverify', 'ews_certificate', '#aci_to_ldc_reverify', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec_reverify', 'ews_certificate', '#aci_to_mamlatdar_reverify', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_reverify_for_ews_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec_reverify == VALUE_ONE || basicDetailData.aci_rec_reverify == VALUE_THREE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        var tempArray = [];
                        var tArray = {};
                        tArray['name'] = basicDetailData.mamlatdar_name;
                        tArray['sa_user_id'] = basicDetailData.aci_to_mamlatdar;
                        tempArray.push(tArray);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempArray, 'ldc_to_mamlatdar_for_ews_certificate', 'sa_user_id', 'name', '', false);
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
        var formData = $('#update_basic_detail_ews_certificate_form').serializeFormJSON();
        if (!formData.ews_certificate_id_for_ews_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.upload_verification_document_for_ews_certificate) {
                $('#upload_verification_document_for_ews_certificate_1').focus();
                validationMessageShow('ews-certificate-update-basic-detail-upload_verification_document_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_verification_document_for_ews_certificate == VALUE_ONE) {
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
            if (!formData.talathi_remarks_for_ews_certificate) {
                $('#talathi_remarks_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-talathi_remarks_for_ews_certificate', remarksValidationMessage);
                return false;
            }
            if (!formData.talathi_to_aci_for_ews_certificate) {
                $('#talathi_to_aci_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-talathi_to_aci_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_for_ews_certificate) {
                $('#aci_rec_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-aci_rec_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_remarks_for_ews_certificate) {
                $('#aci_remarks_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-aci_remarks_for_ews_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_ews_certificate == VALUE_ONE && !formData.aci_to_ldc_for_ews_certificate) {
                $('#aci_to_ldc_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-aci_to_ldc_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_ews_certificate == VALUE_TWO && !formData.aci_to_mamlatdar_for_ews_certificate) {
                $('#aci_to_mamlatdar_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-aci_to_mamlatdar_for_ews_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            var constitutionArtical = parseInt($('#constitution_artical_for_ews_certificate').val());
            if (constitutionArtical != VALUE_ONE && constitutionArtical != VALUE_TWO) {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (!formData.ldc_applicant_name_for_ews_certificate) {
                $('#ldc_applicant_name_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_applicant_name_for_ews_certificate', applicantNameValidationMessage);
                return false;
            }
            if (constitutionArtical == VALUE_TWO) {
                if (!formData.ldc_minor_child_name_for_ews_certificate) {
                    $('#ldc_minor_child_name_for_ews_certificate').focus();
                    validationMessageShow('ews-certificate-update-basic-detail-ldc_minor_child_name_for_ews_certificate', minorChildNameValidationMessage);
                    return false;
                }
            }
            if (!formData.ldc_pr_for_ews_certificate) {
                $('#ldc_pr_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_pr_for_ews_certificate', permanentResidenceValidationMessage);
                return false;
            }
            if (!formData.ldc_address_for_ews_certificate) {
                $('#ldc_address_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_address_for_ews_certificate', addressValidationMessage);
                return false;
            }
            if (!formData.com_pincode) {
                $('#com_pincode_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-com_pincode_for_ews_certificate', pincodeValidationMessage);
                return false;
            }
            if (!formData.ldc_post_office_for_ews_certificate) {
                $('#ldc_post_office_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_post_office_for_ews_certificate', postOfficeValidationMessage);
                return false;
            }
            if (!formData.ldc_religion_caste_for_ews_certificate) {
                $('#ldc_religion_caste_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_religion_caste_for_ews_certificate', religionCastValidationMessage);
                return false;
            }
            if (!formData.ldc_financial_year_for_ews_certificate) {
                $('#ldc_financial_year_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_financial_year_for_ews_certificate', financialYearValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_ews_certificate) {
                $('#ldc_to_mamlatdar_remarks_for_ews_certificate').focus();
                validationMessageShow('ews-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_ews_certificate', remarksValidationMessage);
                return false;
            }
            if (!showLDCDraftBtn) {
                formData.update_ldc_mam_details = VALUE_ONE;
                if (!formData.ldc_to_mamlatdar_for_ews_certificate) {
                    $('#ldc_to_mamlatdar_for_ews_certificate').focus();
                    validationMessageShow('ews-certificate-update-basic-detail-ldc_to_mamlatdar_for_ews_certificate', oneOptionValidationMessage);
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
            url: 'ews_certificate/forward_to',
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
                validationMessageShow('ews-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('ews-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#movement_for_ec_list_' + parseData.ews_certificate_id).html(movementString(parseData.ews_certificate_data));
                resetModelMD();

            }
        });
    },
    getDocumentData: function (ewsCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!ewsCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#ews_certificate_id_for_scrutiny').val(ewsCertificateId);
        $('#ews_certificate_document_for_scrutiny').submit();
        $('#ews_certificate_id_for_scrutiny').val('');
    },
    getDistrictData: function (obj, moduleName, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'cc' ? '' : '';
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
    },
    districtChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'village_name_for_ec');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_ec');
    },
    getVillageData: function (obj, moduleName, id, isTemp = false) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var bornPlaceVillageSpinner = 'born_place_village_for_' + moduleName;
        addTagSpinner(bornPlaceVillageSpinner);
        var text = moduleName == 'cc' ? ' ' : '';
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
        $('#' + id + '_village_for_' + moduleName).val('');
        var state = $('#' + id + '_state_for_' + moduleName).val();
        var districtCode = obj.val();
        if (!districtCode || !state) {
            return;
        }
        $.ajax({
            url: 'ews_certificate/get_village_data_for_ews_certificate',
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
                    console.log(parseData.village_data);
                    tempVillageDataForCC = parseData.village_data;
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
            url: 'ews_certificate/get_name_data_for_ews_certificate',
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

            }
        });
    },
    getEditVillageData: function (state, districtCode, moduleName, village, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'cc' ? ' ' : '';
        if (!districtCode || !state) {
            return;
        }
        $.ajax({
            url: 'ews_certificate/get_village_data_for_ews_certificate',
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
                if (moduleName == 'EWS') {
                    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id, 'village_code', 'village_name', 'Village');
                    $('#' + id).val(village == 0 ? '' : village);
                } else {
                    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_ec', 'village_code', 'village_name', 'Village');
                    $('#' + id + '_village_for_ec').val(village == 0 ? '' : village);
                }

            }
        });
    },
    getDistrictFornDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_district_for_ec');
        var state = obj.val();
        if (!state) {
            return false;
        }
        if (state != VALUE_ONE && state != VALUE_TWO) {
            return false;
        }
        var districtData = state == VALUE_ONE ? damandiudistrictArray : (state == VALUE_TWO ? dnhdistrictArray : []);
        renderOptionsForTwoDimensionalArray(districtData, id + '_district_for_ec');
    },
    getVillageDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_village_for_ec');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var districtData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
        renderOptionsForTwoDimensionalArray(districtData, id + '_village_for_ec');
    },
    villageDMCChangeEvent: function () {
        var district = $('#district').val();
        var villageCode = $('#village_name_for_ec').val();
        var villageData = (district == VALUE_ONE ? damanVillagesArray[villageCode] : (district == VALUE_TWO ? diuVillagesArray[villageCode] : (district == VALUE_THREE ? dnhVillagesArray[villageCode] : [])));
        $('#com_addr_village_dmc_ward_for_ec').val(villageData);

        $("#billingtoo_for_ec").prop('checked', false);
        $('#per_addr_village_dmc_ward_for_ec').val('');
        $('#per_addr_city_for_ec').val('');
        $('#per_pincode_for_ec').val('');

        if (district == VALUE_ONE) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_ec');
            renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_ec');

            if (jQuery.inArray(villageCode, naniDamanVillageArray) != '-1') {
                $('#com_addr_city_for_ec').val(damanCityArray[VALUE_ONE]);
                var city_code = VALUE_ONE;

            } else if (jQuery.inArray(villageCode, motiDamanVillageArray) != '-1') {
                $('#com_addr_city_for_ec').val(damanCityArray[VALUE_TWO]);
                var city_code = VALUE_TWO;
            }

            var pincodeData = damanCityPincodeArray[city_code];
            $('#pincode_for_ec').val(pincodeData);
            $('#com_pincode_for_ec').val(pincodeData);

            generateSelect2();
        } else if (district == VALUE_TWO) {
            renderOptionsForTwoDimensionalArray(diuCityArray, 'com_addr_city_for_ec');
            renderOptionsForTwoDimensionalArray(diuCityArray, 'per_addr_city_for_ec');
            $('#com_addr_city_for_ec').val(diuCityArray[VALUE_ONE]);
            $('#pincode_for_ec').val('');
            $('#com_pincode_for_ec').val('');

        } else if (district == VALUE_THREE) {
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'com_addr_city_for_ec');
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'per_addr_city_for_ec');
            $('#com_addr_city_for_ec').val(dnhCityArray[VALUE_ONE]);
            $('#pincode_for_ec').val('');
            $('#com_pincode_for_ec').val('');
        }
    },
    addVerificationDocItem: function (docData, moduleId) {
        var that = this;
        docData.cnt = verifyDocCnt;
        docData.verification_type = moduleId;
        $('#upload_verification_doc_item_container_for_ews_certificate_' + moduleId).append(ewsFieldVerificationDocItemTemplate(docData));
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
        formData.append('ews_certificate_id_for_ews_certificate_update_basic_detail', $('#ews_certificate_id_for_ews_certificate_update_basic_detail').val());
        formData.append('field_document_id_for_field_verification', $('#field_document_id_for_field_verification_' + tempCnt).val());
        formData.append('verification_type_for_field_verification', $('#verification_type_for_field_verification_' + tempCnt).val());
        formData.append('document_for_verification_document', $('#' + id)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'ews_certificate/upload_field_verification_document',
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
        $('#' + documentFieldName + '_name_href_for_verification_document_' + cnt).attr('href', 'documents/ews_certificate/' + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_verification_document_' + cnt).html(VIEW_UPLODED_DOCUMENT);
        $('#' + documentFieldName + '_remove_btn_for_verification_document_' + cnt).attr('onclick', 'EwsCertificate.listview.askForRemoveDocForFieldVerification("' + docItemData.field_verification_document_id + '","' + cnt + '")');
    },
    askForRemoveDocForFieldVerification: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'EwsCertificate.listview.removeFieldDoc(' + fieldDocumentId + ', ' + cnt + ')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeFieldDoc: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'ews_certificate/remove_field_document',
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
        var yesEvent = 'EwsCertificate.listview.removeFieldItemRow(' + cnt + ')';
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
            url: 'ews_certificate/remove_field_document_item',
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(ewsFieldVerificationViewDocItemTemplate(docDetail));
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(ewsFieldVerificationViewDocItemTemplate(reDocDetail));
                if (reDocDetail['document'] != '') {
                    that.loadFieldDocForView(reDocDetail.cnt, 'document', 'field_reverification', reDocDetail.document);
                }
            });
        }
    },
    loadFieldDocForView: function (tempCnt, id, moduleType, docField) {
        $('#' + id + '_container_for_' + moduleType + '_view_' + tempCnt).hide();
        $('#' + id + '_name_container_for_' + moduleType + '_view_' + tempCnt).show();
        $('#' + id + '_name_href_for_' + moduleType + '_view_' + tempCnt).attr('href', 'documents/ews_certificate/' + docField);
        $('#' + id + '_name_for_' + moduleType + '_view_' + tempCnt).html(VIEW_UPLODED_DOCUMENT);
    },
    downloadDeclaration: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var icId = $('#ews_certificate_id_for_ec_declaration').val();
        if (!icId) {
            validationMessageShow('ews-certificate-declaration_for_ews_certificate', invalidAccessValidationMessage);
            return false;
        }
        $('#ec_declaration_pdf').submit();
    },
    addBirthStayPeriodInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt = tempBirthStayPeriodCnt;
        $('#detail_of_birth_stay_period_info_container_for_ec').append(ewsCertificateBirthStayPeriodInfoTemplate(templateData));
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_ec_' + tempBirthStayPeriodCnt, 'state_code', 'state_name', 'State/UT');
        tempBirthStayPeriodCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cnt');
    },
    removeBirthStayPeriodInfo: function (perCnt) {
        $('#detail_of_birth_stay_period_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
});
