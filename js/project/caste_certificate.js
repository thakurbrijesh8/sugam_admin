var casteCertificateListTemplate = Handlebars.compile($('#caste_certificate_list_template').html());
var casteCertificateSearchTemplate = Handlebars.compile($('#caste_certificate_search_template').html());
var casteCertificateTableTemplate = Handlebars.compile($('#caste_certificate_table_template').html());
var casteCertificateActionTemplate = Handlebars.compile($('#caste_certificate_action_template').html());
var casteCertificateFormTemplate = Handlebars.compile($('#caste_certificate_form_template').html());
var casteCertificateViewTemplate = Handlebars.compile($('#caste_certificate_view_template').html());
var casteCertificateApproveTemplate = Handlebars.compile($('#caste_certificate_approve_template').html());
var casteCertificateRejectTemplate = Handlebars.compile($('#caste_certificate_reject_template').html());
var casteCertificateViewDocumentTemplate = Handlebars.compile($('#caste_certificate_view_document_template').html());
var casteCertificateAppointmentTemplate = Handlebars.compile($('#caste_certificate_set_appointment_template').html());
var casteCertificateUpdateBasicDetailTemplate = Handlebars.compile($('#caste_certificate_update_basic_detail_template').html());

var typeMajorCasteCertificateFormTemplate = Handlebars.compile($('#type_mjor_caste_certificate_form_template').html());
var typeMinorCasteCertificateFormTemplate = Handlebars.compile($('#type_minor_caste_certificate_form_template').html());

var casteCertificateFieldVerificationDocItemTemplate = Handlebars.compile($('#caste_certificate_field_verification_document_template').html());
var casteCertificateFieldVerificationViewDocItemTemplate = Handlebars.compile($('#caste_certificate_field_verification_view_document_template').html());

var tempVillageDataForCC = [];
var tempMemberCnt = 1;
var tempACIData = [];
var tempMamData = [];
var searchCCF = {};

var CasteCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
CasteCertificate.Router = Backbone.Router.extend({
    routes: {
        'caste_certificate': 'renderList',
        'caste_certificate_form': 'renderListForForm',
        'edit_caste_certificate_form': 'renderList',
        'view_caste_certificate_form': 'renderList',
        'type_mjor_caste_certificate_form': 'renderListForTypeOne',
        'edit_type_mjor_caste_certificate_form': 'renderList',
        'type_minor_caste_certificate_form': 'renderListForTypeTwoA',
        'edit_type_minor_caste_certificate_form': 'renderList',

    },
    renderList: function () {
        CasteCertificate.listview.listPage();
    },
    renderListForForm: function () {
        CasteCertificate.listview.listPageCasteCertificateForm();
    },
    renderListForTypeOne: function () {
        CasteCertificate.listview.listPageTypeMajorCasteCertificateForm();
    },
    renderListForTypeTwoA: function () {
        CasteCertificate.listview.listPageTypeMinorCasteCertificateForm();
    },

});
CasteCertificate.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="father_alive_for_caste_certificate"]': 'fatherAlive',
        'click input[name="mother_alive_for_caste_certificate"]': 'motherAlive',
        'click input[name="grandfather_alive_for_caste_certificate"]': 'grandfatherAlive',
        'click input[name="spouse_alive_for_caste_certificate"]': 'spouseAlive',
    },
    fatherAlive: function (event) {
        var val = $("input[name='father_alive_for_caste_certificate']:checked").val();
        if (val == '1') {
            $('.if_father_alive_item_container_for_caste_certificate').show();
        } else {
            $('.if_father_alive_item_container_for_caste_certificate').hide();
        }
    },
    motherAlive: function (event) {
        var val = $("input[name='mother_alive_for_caste_certificate']:checked").val();
        if (val == '1') {
            $('.if_mother_alive_item_container_for_caste_certificate').show();
        } else {
            $('.if_mother_alive_item_container_for_caste_certificate').hide();
        }
    },
    grandfatherAlive: function (event) {
        var val = $("input[name='grandfather_alive_for_caste_certificate']:checked").val();
        if (val == '1') {
            $('.if_grandfather_alive_item_container_for_caste_certificate').show();
        } else {
            $('.if_grandfather_alive_item_container_for_caste_certificate').hide();
        }
    },
    spouseAlive: function (event) {
        var val = $("input[name='spouse_alive_for_caste_certificate']:checked").val();
        if (val == '1') {
            $('.if_spouse_alive_item_container_for_caste_certificate').show();
        } else {
            $('.if_spouse_alive_item_container_for_caste_certificate').hide();
        }
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
        addClass('menu_caste_certificate', 'active');
        CasteCertificate.router.navigate('caste_certificate');
        var templateData = {};
        searchCCF = {};
        this.$el.html(casteCertificateListTemplate(templateData));
        this.loadCasteCertificateData(sDistrict, sType);

    },
    listPageTypeMajorCasteCertificateForm: function () {
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
        addClass('mam_caste_certificate', 'active');
        this.$el.html(casteCertificateListTemplate);
        this.typeMajorCasteCertificateForm(false, {});
    },
    listPageTypeMinorCasteCertificateForm: function () {
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
        addClass('mam_caste_certificate', 'active');
        this.$el.html(casteCertificateListTemplate);
        this.typeMinorCasteCertificateForm(false, {});
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
//                rowData.show_migration_btn = 'display: none;';
//            } else {
            if (rowData.aci_rec == VALUE_THREE) {
                rowData.show_migration_btn = '';
                rowData.show_approve_btn = 'display: none;';
            } else {
                rowData.show_approve_btn = '';
                rowData.show_migration_btn = 'display: none;';
            }
//            }
        } else {
            rowData.show_approve_btn = 'display: none;';
            rowData.show_migration_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) &&
                (rowData.status == VALUE_TWO || rowData.status == VALUE_THREE || rowData.status == VALUE_FIVE ||
                        rowData.status == VALUE_SIX) && (rowData.query_status == VALUE_ZERO ||
                rowData.query_status == VALUE_THREE)) {
//            if (rowData.appointment_status == VALUE_ZERO || rowData.aci_rec != VALUE_TWO && rowData.aci_rec != VALUE_THREE) {
            if (rowData.aci_rec != VALUE_TWO && rowData.aci_rec != VALUE_THREE) {
                rowData.show_reverification_btn = 'display: none;';
            } else {
                rowData.show_reverification_btn = '';
            }
        } else {
            rowData.show_reverification_btn = 'display: none;';
        }
        rowData.module_type = VALUE_FOUR;
        if (rowData.status == VALUE_FIVE) {
            if (rowData.aci_rec == VALUE_THREE && rowData.aci_rec != VALUE_ONE && rowData.aci_rec != VALUE_TWO) {
                rowData.download_certificate_migrant_style = '';
                rowData.download_certificate_style = 'display: none;';
            } else if (rowData.aci_rec_reverify == VALUE_THREE) {
                rowData.download_certificate_migrant_style = '';
                rowData.download_certificate_style = 'display: none;';
            } else {
                rowData.download_certificate_style = '';
                rowData.download_certificate_migrant_style = 'display: none;';
            }
        } else {
            rowData.download_certificate_style = 'display: none;';
            rowData.download_certificate_migrant_style = 'display: none;';
        }
        rowData.download_verify_certificate_style = 'display: none;';
        rowData.download_verify_certificate_migrant_style = 'display: none;';
        if (rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX) {
            if (rowData.aci_rec == VALUE_THREE && rowData.aci_rec != VALUE_ONE && rowData.aci_rec != VALUE_TWO) {
                rowData.download_verify_certificate_migrant_style = '';
            } else if (rowData.aci_rec_reverify == VALUE_THREE) {
                rowData.download_verify_certificate_migrant_style = '';
            } else {
                rowData.download_verify_certificate_style = '';
            }
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
        return casteCertificateActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        var onlineStatement = appointmentData.online_statement == VALUE_ONE ? 'Online Statement' : '';
        var visitOffice = appointmentData.visit_office == VALUE_ONE ? 'Visit Office' : '';
        if (appointmentData.appointment_date == '0000-00-00') {
            return '<span id="appointment_container_' + appointmentData.caste_certificate_id + '" class="badge bg-warning app-status">Appointment Not Scheduled By Talathi</span>';
        }
        var returnString = '<span id="appointment_container_' + appointmentData.caste_certificate_id + '"><span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">' + onlineStatement;
        if (onlineStatement != '' && visitOffice != '') {
            returnString += ',<br>';
        }
        returnString += (visitOffice + '</span>');
        return returnString;
    },
    loadCasteCertificateData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        CasteCertificate.router.navigate('caste_certificate');
        var searchData = dtomMam(sDistrict, sType, 'CasteCertificate.listview.loadCasteCertificateData();');
        $('#caste_certificate_form_and_datatable_container').html(casteCertificateSearchTemplate(searchData));
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            renderOptionsForTwoDimensionalArray(appointmentFilterArray, 'appointment_status_for_caste_certificate_list', false);
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(currentlyOnTypeArray, 'currently_on_for_caste_certificate_list', false);
        }


        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_caste_certificate_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_caste_certificate_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_caste_certificate_list', false);
        datePickerId('application_date_for_caste_certificate_list');

        if (tempTypeInSession != TEMP_TYPE_A) {
            var dwVillagesData = (tempDistrictInSession == VALUE_ONE ? damanVillagesArray : (tempDistrictInSession == VALUE_TWO ? diuVillagesArray : (tempDistrictInSession == VALUE_THREE ? dnhVillagesArray : [])));
            if (tempAVInSession != '') {
                var avData = tempAVInSession.split(',');
                renderOptionsForAVArray(avData, dwVillagesData, 'vdw_for_caste_certificate_list', false);
            } else {
                renderOptionsForTwoDimensionalArray(dwVillagesData, 'vdw_for_caste_certificate_list', false);
            }
        } else {
            if (typeof searchCCF.district_for_caste_certificate_list != "undefined" && searchCCF.district_for_caste_certificate_list != '' && searchCCF.village_for_caste_certificate_list != '') {
                var villageData = (searchCCF.district_for_caste_certificate_list == VALUE_ONE ? damanVillagesArray : (searchCCF.district_for_caste_certificate_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_caste_certificate_list', false);
            }
        }

        $('#app_no_for_caste_certificate_list').val((typeof searchCCF.app_no_for_caste_certificate_list != "undefined" && searchCCF.app_no_for_caste_certificate_list != '') ? searchCCF.app_no_for_caste_certificate_list : '');
        $('#application_date_for_caste_certificate_list').val((typeof searchCCF.application_date_for_caste_certificate_list != "undefined" && searchCCF.application_date_for_caste_certificate_list != '') ? searchCCF.application_date_for_caste_certificate_list : searchData.s_appd);
        $('#app_details_for_caste_certificate_list').val((typeof searchCCF.app_details_for_caste_certificate_list != "undefined" && searchCCF.app_details_for_caste_certificate_list != '') ? searchCCF.app_details_for_caste_certificate_list : '');
        $('#appointment_status_for_caste_certificate_list').val((typeof searchCCF.appointment_status_for_caste_certificate_list != "undefined" && searchCCF.appointment_status_for_caste_certificate_list != '') ? searchCCF.appointment_status_for_caste_certificate_list : searchData.s_app_status);
        $('#query_status_for_caste_certificate_list').val((typeof searchCCF.query_status_for_caste_certificate_list != "undefined" && searchCCF.query_status_for_caste_certificate_list != '') ? searchCCF.query_status_for_caste_certificate_list : searchData.s_qstatus);
        $('#status_for_caste_certificate_list').val((typeof searchCCF.status_for_caste_certificate_list != "undefined" && searchCCF.status_for_caste_certificate_list != '') ? searchCCF.status_for_caste_certificate_list : searchData.s_status);
        $('#currently_on_for_caste_certificate_list').val((typeof searchCCF.currently_on_for_caste_certificate_list != "undefined" && searchCCF.currently_on_for_caste_certificate_list != '') ? searchCCF.currently_on_for_caste_certificate_list : searchData.s_co_hand);
        $('#district_for_caste_certificate_list').val((typeof searchCCF.district_for_caste_certificate_list != "undefined" && searchCCF.district_for_caste_certificate_list != '') ? searchCCF.district_for_caste_certificate_list : searchData.search_district);
        $('#vdw_for_caste_certificate_list').val((typeof searchCCF.vdw_for_caste_certificate_list != "undefined" && searchCCF.vdw_for_caste_certificate_list != '') ? searchCCF.vdw_for_caste_certificate_list : '');
        $('#is_full_for_caste_certificate_list').val((typeof searchCCF.is_full_for_caste_certificate_list != "undefined" && searchCCF.is_full_for_caste_certificate_list != '') ? searchCCF.is_full_for_caste_certificate_list : searchData.s_is_full);

        this.searchCasteCertificateData();

    },
    searchCasteCertificateData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#caste_certificate_datatable_container').html(casteCertificateTableTemplate);
        var searchData = $('#search_caste_certificate_form').serializeFormJSON();

        searchCCF = searchData;
        if (typeof btnObj == "undefined" && (searchCCF.app_details_for_caste_certificate_list == ''
                && searchCCF.app_no_for_caste_certificate_list == ''
                && searchCCF.application_date_for_caste_certificate_list == ''
                && searchCCF.appointment_status_for_caste_certificate_list == ''
                && searchCCF.query_status_for_caste_certificate_list == ''
                && searchCCF.status_for_caste_certificate_list == ''
                && searchCCF.is_full_for_caste_certificate_list == ''
                && (searchCCF.district_for_caste_certificate_list == '' || typeof searchCCF.district_for_caste_certificate_list == "undefined")
                && (searchCCF.vdw_for_caste_certificate_list == '' || typeof searchCCF.vdw_for_caste_certificate_list == "undefined")
                && (searchCCF.currently_on_for_caste_certificate_list == '' || typeof searchCCF.currently_on_for_caste_certificate_list == "undefined"))) {
            casteCertificateDataTable = $('#caste_certificate_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#caste_certificate_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.com_addr_house_no + ', ' + (full.com_addr_house_name == '' ? '' : full.com_addr_house_name + ',') + full.com_addr_street + ', ' + full.com_addr_village_dmc_ward + ', ' + full.com_addr_city + ', ' + (full.com_pincode == '0' ? full.pincode : full.com_pincode) + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + (full.mobile_number == '' ? full.guardian_mobile_no : full.mobile_number) + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? damanVillagesArray : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village_name] ? villageData[full.village_name] : '');
        };
        var appointmentRenderer = function (data, type, full, meta) {
            return '<div id="appointment_container_' + data + '">' + that.getAppointmentData(full) + '</div>';
        };
        var movementRenderer = function (data, type, full, meta) {
            return '<div id="movement_for_cc_list_' + data + '">' + movementStringMigrant(full) + '</div>';
        };
        $('#caste_certificate_datatable_container').html(casteCertificateTableTemplate);
        casteCertificateDataTable = $('#caste_certificate_datatable').DataTable({
            ajax: {
                url: 'caste_certificate/get_caste_certificate_data',
                dataSrc: "caste_certificate_data",
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
                {data: 'caste_certificate_id', 'class': 'v-a-t text-center', 'render': appointmentRenderer},
                {data: 'caste_certificate_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'caste_certificate_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'caste_certificate_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "fnRowCallback": aciNR,
            "initComplete": searchableDatatable
        });

        $('#caste_certificate_datatable_filter').remove();
        $('#caste_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = casteCertificateDataTable.row(tr);

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
    newCasteCertificateForm: function (parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        CasteCertificate.router.navigate('edit_caste_certificate_form');
        tempMemberCnt = 1;

        tempVillageDataForCC = [];
        var formData = parseData.caste_certificate_data;
        var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
        var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
        var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
        var grandfatherDetails = formData.grandfather_details != '' ? JSON.parse(formData.grandfather_details) : {};
        formData.is_checked = isChecked;
        formData.VALUE_ONE = VALUE_ONE;
        formData.VALUE_TWO = VALUE_TWO;
        formData.VALUE_THREE = VALUE_THREE;
        formData.VALUE_FOUR = VALUE_FOUR;
        formData.VALUE_FIVE = VALUE_FIVE;
        formData.VALUE_SIX = VALUE_SIX;
        formData.VALUE_SEVEN = VALUE_SEVEN;
        formData.VALUE_EIGHT = VALUE_EIGHT;
        formData.VALUE_NINE = VALUE_NINE;
        formData.VALUE_TEN = VALUE_TEN;
        formData.IS_CHECKED_YES = IS_CHECKED_YES;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        formData.caste_certificate_data = parseData.caste_certificate_data;
        formData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        formData.affidavit_date = dateTo_DD_MM_YYYY(formData.affidavit_date);
        formData.date = dateTo_DD_MM_YYYY(formData.date);

        $('#caste_certificate_form_and_datatable_container').html(casteCertificateFormTemplate(formData));
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {

            renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_caste_certificate');
            $('#district').val(formData.district);
        }

        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        generateBoxes('radio', genderArray, 'gender', 'cc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'cc', formData.marital_status, false, false);
        showSubContainer('marital_status', 'cc', '.spouse_info_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'caste_certificate', formData.have_you_own_house, false, false);
        showSubContainer('have_you_own_house', 'caste_certificate', '.house_tax_receipt_item', VALUE_ONE, 'radio');
        showSubContainer('have_you_own_house', 'caste_certificate', '.noc_with_notary_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'im_member_of_scst', 'caste_certificate', formData.im_member_of_scst, false, false);
        showSubContainer('im_member_of_scst', 'caste_certificate', '.im_member_of_scst_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'applied_for_sc_st_certy', 'caste_certificate', formData.applied_for_sc_st_certy, false, false);
        showSubContainer('applied_for_sc_st_certy', 'caste_certificate', '.applied_for_sc_st_certy_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'fath_hus_wif_hold_sc_st_certy', 'caste_certificate', formData.fath_hus_wif_hold_sc_st_certy, false, false);
        showSubContainer('fath_hus_wif_hold_sc_st_certy', 'caste_certificate', '.fath_hus_wif_hold_sc_st_certy_item', VALUE_ONE, 'radio');
        generateBoxes('radio', casteArray, 'applicant_caste', 'caste_certificate', formData.applicant_caste, false, false);
        showSubContainer('applicant_caste', 'caste_certificate', '.applicant_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('applicant_caste', 'caste_certificate', '.applicant_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'if_grandfather_having_document', 'caste_certificate', formData.if_grandfather_having_document, false, false);
        showSubContainer('if_grandfather_having_document', 'caste_certificate', '.if_grandfather_birth_document_item', VALUE_ONE, 'radio');
        showSubContainer('if_grandfather_having_document', 'caste_certificate', '.if_grandfather_property_document_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'father_caste', 'caste_certificate', fatherDetails.father_caste, false, false);
        showSubContainer('father_caste', 'caste_certificate', '.father_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('father_caste', 'caste_certificate', '.father_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'mother_caste', 'caste_certificate', motherDetails.mother_caste, false, false);
        showSubContainer('mother_caste', 'caste_certificate', '.mother_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('mother_caste', 'caste_certificate', '.mother_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'grandfather_caste', 'caste_certificate', grandfatherDetails.grandfather_caste, false, false);
        showSubContainer('grandfather_caste', 'caste_certificate', '.grandfather_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('grandfather_caste', 'caste_certificate', '.grandfather_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'spouse_caste', 'caste_certificate', spouseDetails.spouse_caste, false, false);
        showSubContainer('spouse_caste', 'caste_certificate', '.spouse_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('spouse_caste', 'caste_certificate', '.spouse_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'father_alive', 'caste_certificate', formData.father_alive, false, false);
        generateBoxes('radio', yesNoArray, 'mother_alive', 'caste_certificate', formData.mother_alive, false, false);
        generateBoxes('radio', yesNoArray, 'grandfather_alive', 'caste_certificate', formData.grandfather_alive, false, false);
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'caste_certificate', formData.spouse_alive, false, false);


        var district = formData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_cc');
//        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'native_place_village_for_cc');
//        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'father_native_place_village_for_cc');
//        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'grandfather_native_place_village_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'grandfather_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'apllicant_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'apllicant_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'father_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'father_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'mother_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'mother_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'grandfather_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'grandfather_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'spouse_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'spouse_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relationship_of_applicant_for_cc');


        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'commu_add_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'per_addr_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'grandfather_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        // if (isEdit) {
        $('#commu_add_state_for_cc').val(formData.commu_add_state == 0 ? '' : formData.commu_add_state);

        var districtData = tempDistrictData[formData.commu_add_state] ? tempDistrictData[formData.commu_add_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'commu_add_district_for_cc', 'district_code', 'district_name', 'District');
        $('#commu_add_district_for_cc').val(formData.commu_add_district == 0 ? '' : formData.commu_add_district);

        that.getEditVillageData(formData.commu_add_state, formData.commu_add_district, 'cc', formData.commu_add_village, 'commu_add');

        $('#born_place_state_for_cc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);

        var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#born_place_district_for_cc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);

        that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'cc', formData.born_place_village, 'born_place');

        $('#per_addr_state_for_cc').val(formData.per_addr_state == 0 ? '' : formData.per_addr_state);
        var districtData = tempDistrictData[formData.per_addr_state] ? tempDistrictData[formData.per_addr_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_addr_district_for_cc', 'district_code', 'district_name', 'District');
        $('#per_addr_district_for_cc').val(formData.per_addr_district == 0 ? '' : formData.per_addr_district);

        tempVillageDataForCC = formData.per_addr_village_data;
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.per_addr_village_data, 'per_addr_village_for_cc', 'village_code', 'village_name', 'Village');
        $('#per_addr_village_for_cc').val(formData.per_addr_village);
        $('#constitution_artical').val(formData.constitution_artical);
        that.getConstitution(constitution_artical);
        $('#com_addr_city_for_cc').val(formData.com_addr_city);
        $('#per_addr_city_for_cc').val(formData.per_addr_city);
        $('#select_required_purpose_for_cc').val(formData.select_required_purpose);
        $('#village_name_for_cc').val(formData.village_name);
        $('#native_place_state_for_cc').val(formData.native_place_state);
        $('#native_place_district_for_cc').val(formData.native_place_district);
        $('#native_place_village_for_cc').val(formData.native_place_village);
        $('#father_caste_for_cc').val(fatherDetails.father_caste);
        $('#mother_caste_for_cc').val(motherDetails.mother_caste);
        if (formData.billingtoo == isChecked) {
            $('#billingtoo_for_cc').attr('checked', 'checked');
        }

        $('.father_info_div').collapse().show();
        $('.mother_info_div').collapse().show();
        $('.grandfather_info_div').collapse().show();
        if (formData.marital_status == VALUE_ONE)
            $('.spouse_info_div').collapse().show();

        $('#declaration_for_caste_certificate').attr('checked', 'checked');
        $('#declaration').attr('checked', 'checked');
        $('#occupation_for_cc').val(formData.occupation);
        $('#nearest_police_station_for_cc').val(formData.nearest_police_station);
        $('#relationship_of_applicant_for_cc').val(formData.relationship_of_applicant);


        if (formData.occupation == VALUE_TWELVE)
            $('.other_occupation_div_for_cc').show();
        $('#district').val(formData.district);


        $('.father_info_div').collapse().show();
        $('.mother_info_div').collapse().show();
        $('.grandfather_info_div').collapse().show();

        if (formData.applicant_caste == VALUE_ONE) {
            $('.applicant_caste_sc_item_container_for_caste_certificate').collapse().show();
            $('#apllicant_sc_subcaste_for_cc').val(formData.apllicant_sc_subcaste);
        } else {
            $('.applicant_caste_st_item_container_for_caste_certificate').collapse().show();
            $('#apllicant_st_subcaste_for_cc').val(formData.apllicant_st_subcaste);
        }


        if (fatherDetails.father_caste == VALUE_ONE) {
            $('.father_caste_sc_item_container_for_caste_certificate').collapse().show();
            $('#father_sc_subcaste_for_cc').val(fatherDetails.father_sc_subcaste);
        } else {
            $('.father_caste_st_item_container_for_caste_certificate').collapse().show();
            $('#father_st_subcaste_for_cc').val(fatherDetails.father_st_subcaste);
        }

        if (motherDetails.mother_caste == VALUE_ONE) {
            $('.mother_caste_sc_item_container_for_caste_certificate').collapse().show();
            $('#mother_sc_subcaste_for_cc').val(motherDetails.mother_sc_subcaste);
        } else {
            $('.mother_caste_st_item_container_for_caste_certificate').collapse().show();
            $('#mother_st_subcaste_for_cc').val(motherDetails.mother_st_subcaste);
        }

        if (grandfatherDetails.grandfather_caste == VALUE_ONE) {
            $('.grandfather_caste_sc_item_container_for_caste_certificate').collapse().show();
            $('#grandfather_sc_subcaste_for_cc').val(grandfatherDetails.grandfather_sc_subcaste);
        } else {
            $('.grandfather_caste_st_item_container_for_caste_certificate').collapse().show();
            $('#grandfather_st_subcaste_for_cc').val(grandfatherDetails.grandfather_st_subcaste);
        }

        if (spouseDetails.spouse_caste == VALUE_ONE) {
            $('.spouse_caste_sc_item_container_for_caste_certificate').collapse().show();
            $('#spouse_sc_subcaste_for_cc').val(spouseDetails.spouse_sc_subcaste);
        } else {
            $('.spouse_caste_st_item_container_for_caste_certificate').collapse().show();
            $('#spouse_st_subcaste_for_cc').val(spouseDetails.spouse_st_subcaste);
        }

        $('#declaration_for_caste_certificate').attr('checked', 'checked');
        if (formData.occupation == VALUE_TWELVE)
            $('.other_occupation_div_for_cc').show();

        $('#father_born_place_state_for_cc').val(fatherDetails.father_born_place_state == 0 ? '' : fatherDetails.father_born_place_state);

        var districtData = tempDistrictData[fatherDetails.father_born_place_state] ? tempDistrictData[fatherDetails.father_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#father_born_place_district_for_cc').val(fatherDetails.father_born_place_district == 0 ? '' : fatherDetails.father_born_place_district);

        if (fatherDetails.father_born_place_state != VALUE_ZERO)
            that.getEditVillageData(fatherDetails.father_born_place_state, fatherDetails.father_born_place_district, 'cc', fatherDetails.father_born_place_village, 'father_born_place');

        $('#father_city_for_cc').val(fatherDetails.father_city);
        $('#father_native_place_district_for_cc').val(fatherDetails.father_native_place_district);
        $('#father_native_place_village_for_cc').val(fatherDetails.father_native_place_village);
        $('#father_occupation_for_cc').val(fatherDetails.father_occupation);

        if (fatherDetails.father_occupation == VALUE_TWELVE)
            $('.father_other_occupation_div_for_cc').show();

        $('#grandfather_born_place_state_for_cc').val(grandfatherDetails.grandfather_born_place_state == 0 ? '' : grandfatherDetails.grandfather_born_place_state);

        var districtData = tempDistrictData[grandfatherDetails.grandfather_born_place_state] ? tempDistrictData[grandfatherDetails.grandfather_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'grandfather_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#grandfather_born_place_district_for_cc').val(grandfatherDetails.grandfather_born_place_district == 0 ? '' : grandfatherDetails.grandfather_born_place_district);

        if (grandfatherDetails.grandfather_born_place_state != VALUE_ZERO)
            that.getEditVillageData(grandfatherDetails.grandfather_born_place_state, grandfatherDetails.grandfather_born_place_district, 'cc', grandfatherDetails.grandfather_born_place_village, 'grandfather_born_place');

        $('#grandfather_city_for_cc').val(grandfatherDetails.grandfather_city);
        $('#grandfather_native_place_district_for_cc').val(grandfatherDetails.grandfather_native_place_district);
        $('#grandfather_native_place_village_for_cc').val(grandfatherDetails.grandfather_native_place_village);
        $('#grandfather_occupation_for_cc').val(grandfatherDetails.grandfather_occupation);

        if (grandfatherDetails.grandfather_occupation == VALUE_TWELVE)
            $('.grandfather_other_occupation_div_for_cc').show();


        $('#mother_born_place_state_for_cc').val(motherDetails.mother_born_place_state == 0 ? '' : motherDetails.mother_born_place_state);

        var districtData = tempDistrictData[motherDetails.mother_born_place_state] ? tempDistrictData[motherDetails.mother_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#mother_born_place_district_for_cc').val(motherDetails.mother_born_place_district == 0 ? '' : motherDetails.mother_born_place_district);

        if (motherDetails.mother_born_place_state != VALUE_ZERO)
            that.getEditVillageData(motherDetails.mother_born_place_state, motherDetails.mother_born_place_district, 'cc', motherDetails.mother_born_place_village, 'mother_born_place');

        $('#mother_native_place_state_for_cc').val(motherDetails.mother_native_place_state == 0 ? '' : motherDetails.mother_native_place_state);

        var districtData = tempDistrictData[motherDetails.mother_native_place_state] ? tempDistrictData[motherDetails.mother_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_native_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#mother_native_place_district_for_cc').val(motherDetails.mother_native_place_district == 0 ? '' : motherDetails.mother_native_place_district);

        if (motherDetails.mother_native_place_state != VALUE_ZERO)
            that.getEditVillageData(motherDetails.mother_native_place_state, motherDetails.mother_native_place_district, 'cc', motherDetails.mother_native_place_village, 'mother_native_place');

        $('#mother_city_for_cc').val(motherDetails.mother_city);
        $('#mother_occupation_for_cc').val(motherDetails.mother_occupation);

        if (motherDetails.mother_occupation == VALUE_TWELVE)
            $('.mother_other_occupation_div_for_cc').show();

        if (formData.marital_status == VALUE_ONE) {
            $('#spouse_born_place_state_for_cc').val(spouseDetails.spouse_born_place_state == 0 ? '' : spouseDetails.spouse_born_place_state);

            var districtData = tempDistrictData[spouseDetails.spouse_born_place_state] ? tempDistrictData[spouseDetails.spouse_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_born_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#spouse_born_place_district_for_cc').val(spouseDetails.spouse_born_place_district == 0 ? '' : spouseDetails.spouse_born_place_district);

            if (spouseDetails.spouse_born_place_state != VALUE_ZERO)
                that.getEditVillageData(spouseDetails.spouse_born_place_state, spouseDetails.spouse_born_place_district, 'cc', spouseDetails.spouse_born_place_village, 'spouse_born_place');

            $('#spouse_native_place_state_for_cc').val(spouseDetails.spouse_native_place_state == 0 ? '' : spouseDetails.spouse_native_place_state);

            var districtData = tempDistrictData[spouseDetails.spouse_native_place_state] ? tempDistrictData[spouseDetails.spouse_native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_native_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#spouse_native_place_district_for_cc').val(spouseDetails.spouse_native_place_district == 0 ? '' : spouseDetails.spouse_native_place_district);

            if (spouseDetails.spouse_native_place_state != VALUE_ZERO)
                that.getEditVillageData(spouseDetails.spouse_native_place_state, spouseDetails.spouse_native_place_district, 'cc', spouseDetails.spouse_native_place_village, 'spouse_native_place');

            $('#spouse_city_for_cc').val(spouseDetails.spouse_city);
            $('#spouse_occupation_for_cc').val(spouseDetails.spouse_occupation);

            if (spouseDetails.spouse_occupation == VALUE_TWELVE)
                $('.spouse_other_occupation_div_for_cc').show();
        }



        //------------------------------------------

        var val = formData.constitution_artical;


        if (formData.self_birth_certificate_doc != '') {
            that.showDocument('self_birth_certificate_doc_container_for_caste_certificate', 'self_birth_certificate_doc_name_image_for_caste_certificate', 'self_birth_certificate_doc_name_container_for_caste_certificate',
                    'self_birth_certificate_doc_download', 'self_birth_certificate_doc', formData.self_birth_certificate_doc, formData.caste_certificate_id, VALUE_ONE);
        }

        if (formData.father_certificate_doc != '') {
            that.showDocument('father_certificate_doc_container_for_caste_certificate', 'father_certificate_doc_name_image_for_caste_certificate', 'father_certificate_doc_name_container_for_caste_certificate',
                    'father_certificate_doc_download', 'father_certificate_doc', formData.father_certificate_doc, formData.caste_certificate_id, VALUE_TWO);
        }

        if (formData.grandfather_birth_certificate_doc != '') {
            that.showDocument('grandfather_birth_certificate_doc_container_for_caste_certificate', 'grandfather_birth_certificate_doc_name_image_for_caste_certificate', 'grandfather_birth_certificate_doc_name_container_for_caste_certificate',
                    'grandfather_birth_certificate_doc_download', 'grandfather_birth_certificate_doc', formData.grandfather_birth_certificate_doc, formData.caste_certificate_id, VALUE_THREE);
        }

        if (formData.grandfather_property_doc != '') {
            that.showDocument('grandfather_property_doc_container_for_caste_certificate', 'grandfather_property_doc_name_image_for_caste_certificate', 'grandfather_property_doc_name_container_for_caste_certificate',
                    'grandfather_property_doc_download', 'grandfather_property_doc', formData.grandfather_property_doc, formData.caste_certificate_id, VALUE_FOUR);
        }

        if (formData.leaving_certificate_doc != '') {
            that.showDocument('leaving_certificate_doc_container_for_caste_certificate', 'leaving_certificate_doc_name_image_for_caste_certificate', 'leaving_certificate_doc_name_container_for_caste_certificate',
                    'leaving_certificate_doc_download', 'leaving_certificate_doc', formData.leaving_certificate_doc, formData.caste_certificate_id, VALUE_FIVE);
        }

        if (formData.constitution_artical == VALUE_ONE) {
            if (formData.election_card_doc != '') {
                that.showDocument('election_card_doc_container_for_caste_certificate', 'election_card_doc_name_image_for_caste_certificate', 'election_card_doc_name_container_for_caste_certificate',
                        'election_card_doc_download', 'election_card_doc', formData.election_card_doc, formData.caste_certificate_id, VALUE_SIX);
            }
        }

        if (formData.aadhar_card_doc != '') {
            that.showDocument('aadhar_card_doc_container_for_caste_certificate', 'aadhar_card_doc_name_image_for_caste_certificate', 'aadhar_card_doc_name_container_for_caste_certificate',
                    'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.caste_certificate_id, VALUE_SEVEN);
        }

        if (formData.community_certificate_doc != '') {
            that.showDocument('community_certificate_doc_container_for_caste_certificate', 'community_certificate_doc_name_image_for_caste_certificate', 'community_certificate_doc_name_container_for_caste_certificate',
                    'community_certificate_doc_download', 'community_certificate_doc', formData.community_certificate_doc, formData.caste_certificate_id, VALUE_EIGHT);
        }

        if (formData.applicant_photo_doc != '') {
            that.showDocument('applicant_photo_doc_container_for_caste_certificate', 'applicant_photo_doc_name_image_for_caste_certificate', 'applicant_photo_doc_name_container_for_caste_certificate',
                    'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.caste_certificate_id, VALUE_NINE);
        }

        if (formData.father_alive == VALUE_ONE) {
            $("#father_alive_for_caste_certificate_1").prop("checked", true);
        } else {
            $("#father_alive_for_caste_certificate_2").prop("checked", true);
        }

        if (formData.mother_alive == VALUE_ONE) {
            $("#mother_alive_for_caste_certificate_1").prop("checked", true);
        } else {
            $("#mother_alive_for_caste_certificate_2").prop("checked", true);
        }

        if (formData.grandfather_alive == VALUE_ONE) {
            $("#grandfather_alive_for_caste_certificate_1").prop("checked", true);
        } else {
            $("#grandfather_alive_for_caste_certificate_2").prop("checked", true);
        }

        if (formData.spouse_alive == VALUE_ONE) {
            $("#spouse_alive_for_caste_certificate_1").prop("checked", true);
        } else {
            $("#spouse_alive_for_caste_certificate_2").prop("checked", true);
        }

        //  }


        generateSelect2();
        datePicker();
        datePickerToday('applicant_dob_for_cc');
        datePickerToday('applied_date_for_caste_certificate');
        datePickerToday('applied_date_of_hold_certy_for_caste_certificate');
        //if (isEdit) {
        if (formData.applicant_dob != '0000-00-00') {
            $('#applicant_dob_for_cc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
        }
        if (formData.applied_date != '0000-00-00') {
            $('#applied_date_for_caste_certificate').val(dateTo_DD_MM_YYYY(formData.applied_date));
        }
        if (formData.applied_date_of_hold_certy != '0000-00-00') {
            $('#applied_date_of_hold_certy_for_caste_certificate').val(dateTo_DD_MM_YYYY(formData.applied_date_of_hold_certy));
        }
        if (formData.date != '0000-00-00') {
            $('#date_for_cc').val(dateTo_DD_MM_YYYY(formData.date));
        }
        //}
        $('#caste_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.askForSubmitCasteCertificate(VALUE_TWO);
            }
        });
    },
    fatherDetailsForm: function (casteCertificateData) {
        console.log(casteCertificateData);
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        CasteCertificate.router.navigate('father_details/' + casteCertificateData.encrypt_id);
        casteCertificateData.VALUE_ONE = VALUE_ONE;
        casteCertificateData.VALUE_TWO = VALUE_TWO;
        $('#caste_certificate_form_and_datatable_container').html(caste_certificateFatherDetailsTemplate(casteCertificateData));
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_cc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'father_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'father_native_place_district_for_cc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'father_born_place_village_for_cc', 'village_code', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'father_native_place_village_for_cc', 'village_code', 'village_name', 'Village');


        //if (isEdit) {

        $('#father_born_place_state_for_cc').val(casteCertificateData.father_born_place_state == 0 ? '' : casteCertificateData.father_born_place_state);

        var districtData = tempDistrictData[casteCertificateData.father_born_place_state] ? tempDistrictData[casteCertificateData.father_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#father_born_place_district_for_cc').val(casteCertificateData.father_born_place_district == 0 ? '' : casteCertificateData.father_born_place_district);

        that.getEditVillageData(casteCertificateData.father_born_place_state, casteCertificateData.father_born_place_district, 'cc', casteCertificateData.father_born_place_village, 'father_born_place');

        $('#father_native_place_state_for_cc').val(casteCertificateData.father_native_place_state == 0 ? '' : casteCertificateData.father_native_place_state);

        var districtData = tempDistrictData[casteCertificateData.father_native_place_state] ? tempDistrictData[casteCertificateData.father_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_native_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#father_native_place_district_for_cc').val(casteCertificateData.father_native_place_district == 0 ? '' : casteCertificateData.father_native_place_district);

        that.getEditVillageData(casteCertificateData.father_native_place_state, casteCertificateData.father_native_place_district, 'cc', casteCertificateData.father_native_place_village, 'father_native_place');
        $('#father_city_for_cc').val(casteCertificateData.father_city);
        $('#father_occupation_for_cc').val(casteCertificateData.father_occupation);

        if (casteCertificateData.father_occupation == VALUE_TWELVE)
            $('.father_other_occupation_div_for_cc').show();

        datePicker();
        generateSelect2();
        $('#father_details_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },
    motherDetailsForm: function (casteCertificateData) {
        console.log(casteCertificateData);
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        CasteCertificate.router.navigate('mother_details/' + casteCertificateData.encrypt_id);
        casteCertificateData.VALUE_ONE = VALUE_ONE;
        casteCertificateData.VALUE_TWO = VALUE_TWO;
        $('#caste_certificate_form_and_datatable_container').html(caste_certificateMotherDetailsTemplate(casteCertificateData));
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_cc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'mother_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'mother_native_place_district_for_cc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'mother_born_place_village_for_cc', 'village_code', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'mother_native_place_village_for_cc', 'village_code', 'village_name', 'Village');


        $('#mother_born_place_state_for_cc').val(casteCertificateData.mother_born_place_state == 0 ? '' : casteCertificateData.mother_born_place_state);

        var districtData = tempDistrictData[casteCertificateData.mother_born_place_state] ? tempDistrictData[casteCertificateData.mother_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#mother_born_place_district_for_cc').val(casteCertificateData.mother_born_place_district == 0 ? '' : casteCertificateData.mother_born_place_district);

        that.getEditVillageData(casteCertificateData.mother_born_place_state, casteCertificateData.mother_born_place_district, 'cc', casteCertificateData.mother_born_place_village, 'mother_born_place');

        $('#mother_native_place_state_for_cc').val(casteCertificateData.mother_native_place_state == 0 ? '' : casteCertificateData.mother_native_place_state);

        var districtData = tempDistrictData[casteCertificateData.mother_native_place_state] ? tempDistrictData[casteCertificateData.mother_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_native_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#mother_native_place_district_for_cc').val(casteCertificateData.mother_native_place_district == 0 ? '' : casteCertificateData.mother_native_place_district);

        that.getEditVillageData(casteCertificateData.mother_native_place_state, casteCertificateData.mother_native_place_district, 'cc', casteCertificateData.mother_native_place_village, 'mother_native_place');
        $('#mother_city_for_cc').val(casteCertificateData.mother_city);
        $('#mother_occupation_for_cc').val(casteCertificateData.mother_occupation);

        if (casteCertificateData.mother_occupation == VALUE_TWELVE)
            $('.mother_other_occupation_div_for_cc').show();

        datePicker();
        generateSelect2();
        $('#mother_details_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },

    grandfatherDetailsForm: function (casteCertificateData) {
        console.log(casteCertificateData);
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        CasteCertificate.router.navigate('grandfather_details/' + casteCertificateData.encrypt_id);
        casteCertificateData.VALUE_ONE = VALUE_ONE;
        casteCertificateData.VALUE_TWO = VALUE_TWO;
        $('#caste_certificate_form_and_datatable_container').html(caste_certificateFatherDetailsTemplate(casteCertificateData));
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'grandfather_occupation_for_cc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'grandfather_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'grandfather_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'grandfather_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'grandfather_native_place_district_for_cc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'grandfather_born_place_village_for_cc', 'village_code', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'grandfather_native_place_village_for_cc', 'village_code', 'village_name', 'Village');


        $('#grandfather_born_place_state_for_cc').val(casteCertificateData.grandfather_born_place_state == 0 ? '' : casteCertificateData.grandfather_born_place_state);

        var districtData = tempDistrictData[casteCertificateData.grandfather_born_place_state] ? tempDistrictData[casteCertificateData.grandfather_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'grandfather_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#grandfather_born_place_district_for_cc').val(casteCertificateData.grandfather_born_place_district == 0 ? '' : casteCertificateData.grandfather_born_place_district);

        that.getEditVillageData(casteCertificateData.grandfather_born_place_state, casteCertificateData.grandfather_born_place_district, 'cc', casteCertificateData.grandfather_born_place_village, 'grandfather_born_place');
        $('#grandfather_native_place_state_for_cc').val(casteCertificateData.grandfather_native_place_state == 0 ? '' : casteCertificateData.grandfather_native_place_state);

        var districtData = tempDistrictData[casteCertificateData.grandfather_native_place_state] ? tempDistrictData[casteCertificateData.grandfather_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'grandfather_native_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#grandfather_native_place_district_for_cc').val(casteCertificateData.grandfather_native_place_district == 0 ? '' : casteCertificateData.grandfather_native_place_district);

        that.getEditVillageData(casteCertificateData.grandfather_native_place_state, casteCertificateData.grandfather_native_place_district, 'cc', casteCertificateData.grandfather_native_place_village, 'grandfather_native_place');
        $('#grandfather_city_for_cc').val(casteCertificateData.grandfather_city);
        $('#grandfather_occupation_for_cc').val(casteCertificateData.grandfather_occupation);

        if (casteCertificateData.grandfather_occupation == VALUE_TWELVE)
            $('.grandfather_other_occupation_div_for_cc').show();

        datePicker();
        generateSelect2();
        $('#grandfather_details_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },
    spouseDetailsForm: function (casteCertificateData) {
        console.log(casteCertificateData);
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        CasteCertificate.router.navigate('spouse_details/' + casteCertificateData.encrypt_id);
        casteCertificateData.VALUE_ONE = VALUE_ONE;
        casteCertificateData.VALUE_TWO = VALUE_TWO;
        $('#caste_certificate_form_and_datatable_container').html(caste_certificateSpouseDetailsTemplate(casteCertificateData));
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_cc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'spouse_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'spouse_native_place_district_for_cc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'spouse_born_place_village_for_cc', 'village_code', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'spouse_native_place_village_for_cc', 'village_code', 'village_name', 'Village');



        $('#spouse_born_place_state_for_cc').val(casteCertificateData.spouse_born_place_state == 0 ? '' : casteCertificateData.spouse_born_place_state);

        var districtData = tempDistrictData[casteCertificateData.spouse_born_place_state] ? tempDistrictData[casteCertificateData.spouse_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_born_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#spouse_born_place_district_for_cc').val(casteCertificateData.spouse_born_place_district == 0 ? '' : casteCertificateData.spouse_born_place_district);

        that.getEditVillageData(casteCertificateData.spouse_born_place_state, casteCertificateData.spouse_born_place_district, 'cc', casteCertificateData.spouse_born_place_village, 'spouse_born_place');


        $('#spouse_native_place_state_for_cc').val(casteCertificateData.spouse_native_place_state == 0 ? '' : casteCertificateData.spouse_native_place_state);

        var districtData = tempDistrictData[casteCertificateData.spouse_native_place_state] ? tempDistrictData[casteCertificateData.spouse_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_native_place_district_for_cc', 'district_code', 'district_name', 'District');
        $('#spouse_native_place_district_for_cc').val(casteCertificateData.spouse_native_place_district == 0 ? '' : casteCertificateData.spouse_native_place_district);

        that.getEditVillageData(casteCertificateData.spouse_native_place_state, casteCertificateData.spouse_native_place_district, 'cc', casteCertificateData.spouse_native_place_village, 'spouse_native_place');
        $('#spouse_city_for_cc').val(casteCertificateData.spouse_city);
        $('#spouse_occupation_for_cc').val(casteCertificateData.spouse_occupation);

        if (casteCertificateData.spouse_occupation == VALUE_TWELVE)
            $('.spouse_other_occupation_div_for_cc').show();

        datePicker();
        generateSelect2();
        $('#spouse_details_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },
    uploadDocumentsForm: function (casteCertificateData) {
        console.log(casteCertificateData);
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        CasteCertificate.router.navigate('upload_documents/' + casteCertificateData.encrypt_id);
        casteCertificateData.VALUE_ONE = VALUE_ONE;
        casteCertificateData.VALUE_TWO = VALUE_TWO;
        casteCertificateData.VALUE_THREE = VALUE_THREE;
        casteCertificateData.VALUE_FOUR = VALUE_FOUR;
        casteCertificateData.VALUE_FIVE = VALUE_FIVE;
        casteCertificateData.VALUE_SIX = VALUE_SIX;
        casteCertificateData.VALUE_SEVEN = VALUE_SEVEN;
        casteCertificateData.VALUE_EIGHT = VALUE_EIGHT;
        casteCertificateData.VALUE_NINE = VALUE_NINE;
        casteCertificateData.VALUE_TEN = VALUE_TEN;
        casteCertificateData.VALUE_ELEVEN = VALUE_ELEVEN;
        casteCertificateData.VALUE_TWELVE = VALUE_TWELVE;
        casteCertificateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#caste_certificate_form_and_datatable_container').html(caste_certificateUploadDocumentsTemplate(casteCertificateData));
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'caste_certificate', casteCertificateData.have_you_own_house, false, false);
        showSubContainer('have_you_own_house', 'caste_certificate', '.house_tax_receipt_item', VALUE_ONE, 'radio');
        showSubContainer('have_you_own_house', 'caste_certificate', '.noc_with_notary_item', VALUE_TWO, 'radio');
        var val = casteCertificateData.constitution_artical;
        if (val === '1') {
            this.$('.birth_certificate_item_container_for_caste_certificate').show();
            this.$('.election_card_item_container_for_caste_certificate').show();
            this.$('.aadhar_card_item_container_for_caste_certificate').show();
            this.$('.leaving_certificate_item_container_for_caste_certificate').hide();
            this.$('.proof_document_item_container_for_caste_certificate').hide();
            this.$('.gas_book_item_container_for_caste_certificate').hide();
            this.$('.bank_book_item_container_for_caste_certificate').hide();
            this.$('.have_you_own_house_container_div').hide();
            this.$('.house_tax_receipt_item_container_for_caste_certificate').hide();
            this.$('.noc_with_notary_item_container_for_caste_certificate').hide();
        }
        if (val === '2') {
            this.$('.birth_certificate_item_container_for_caste_certificate').show();
            this.$('.election_card_item_container_for_caste_certificate').show();
            this.$('.aadhar_card_item_container_for_caste_certificate').show();
            this.$('.leaving_certificate_item_container_for_caste_certificate').show();
            this.$('.proof_document_item_container_for_caste_certificate').hide();
            this.$('.gas_book_item_container_for_caste_certificate').hide();
            this.$('.bank_book_item_container_for_caste_certificate').hide();
            this.$('.have_you_own_house_container_div').hide();
            this.$('.house_tax_receipt_item_container_for_caste_certificate').hide();
            this.$('.noc_with_notary_item_container_for_caste_certificate').hide();
        }
        if (val === '3') {
            this.$('.birth_certificate_item_container_for_caste_certificate').show();
            this.$('.election_card_item_container_for_caste_certificate').show();
            this.$('.aadhar_card_item_container_for_caste_certificate').show();
            this.$('.leaving_certificate_item_container_for_caste_certificate').show();
            this.$('.proof_document_item_container_for_caste_certificate').hide();
            this.$('.gas_book_item_container_for_caste_certificate').hide();
            this.$('.bank_book_item_container_for_caste_certificate').hide();
            this.$('.have_you_own_house_container_div').hide();
            this.$('.house_tax_receipt_item_container_for_caste_certificate').hide();
            this.$('.noc_with_notary_item_container_for_caste_certificate').hide();
        }
        if (val === '4') {
            this.$('.birth_certificate_item_container_for_caste_certificate').show();
            this.$('.election_card_item_container_for_caste_certificate').show();
            this.$('.aadhar_card_item_container_for_caste_certificate').show();
            this.$('.leaving_certificate_item_container_for_caste_certificate').show();
            this.$('.proof_document_item_container_for_caste_certificate').show();
            this.$('.gas_book_item_container_for_caste_certificate').show();
            this.$('.bank_book_item_container_for_caste_certificate').show();
            this.$('.have_you_own_house_container_div').show();
        }
        if (val === '5') {
            this.$('.birth_certificate_item_container_for_caste_certificate').show();
            this.$('.election_card_item_container_for_caste_certificate').show();
            this.$('.aadhar_card_item_container_for_caste_certificate').show();
            this.$('.leaving_certificate_item_container_for_caste_certificate').show();
            this.$('.proof_document_item_container_for_caste_certificate').show();
            this.$('.gas_book_item_container_for_caste_certificate').show();
            this.$('.bank_book_item_container_for_caste_certificate').show();
            this.$('.have_you_own_house_container_div').show();
        }
        if (val === '6') {
            this.$('.birth_certificate_item_container_for_caste_certificate').show();
            this.$('.election_card_item_container_for_caste_certificate').show();
            this.$('.aadhar_card_item_container_for_caste_certificate').show();
            this.$('.leaving_certificate_item_container_for_caste_certificate').show();
            this.$('.proof_document_item_container_for_caste_certificate').show();
            this.$('.have_you_own_house_container_div').show();
            this.$('.gas_book_item_container_for_caste_certificate').show();
            this.$('.bank_book_item_container_for_caste_certificate').show();
        }


        if (casteCertificateData.applicant_photo != '') {
            that.showDocument('applicant_photo_container_for_caste_certificate', 'applicant_photo_name_image_for_caste_certificate', 'applicant_photo_name_container_for_caste_certificate',
                    'applicant_photo_download', 'applicant_photo', casteCertificateData.applicant_photo, casteCertificateData.caste_certificate_id, VALUE_ONE);
        }

        if (casteCertificateData.birth_certi != '') {
            that.showDocument('birth_certi_container_for_caste_certificate', 'birth_certi_name_image_for_caste_certificate', 'birth_certi_name_container_for_caste_certificate',
                    'birth_certi_download', 'birth_certi', casteCertificateData.birth_certi, casteCertificateData.caste_certificate_id, VALUE_TWO);
        }

        if (casteCertificateData.election_card != '') {
            that.showDocument('election_card_container_for_caste_certificate', 'election_card_name_image_for_caste_certificate', 'election_card_name_container_for_caste_certificate',
                    'election_card_download', 'election_card', casteCertificateData.election_card, casteCertificateData.caste_certificate_id, VALUE_THREE);
        }
        if (casteCertificateData.aadhaar_card != '') {
            that.showDocument('aadhaar_card_container_for_caste_certificate', 'aadhaar_card_name_image_for_caste_certificate', 'aadhaar_card_name_container_for_caste_certificate',
                    'aadhaar_card_download', 'aadhaar_card', casteCertificateData.aadhaar_card, casteCertificateData.caste_certificate_id, VALUE_FOUR);
        }
        if (casteCertificateData.leaving_certi != '') {
            that.showDocument('leaving_certi_container_for_caste_certificate', 'leaving_certi_name_image_for_caste_certificate', 'leaving_certi_name_container_for_caste_certificate',
                    'leaving_certi_download', 'leaving_certi', casteCertificateData.leaving_certi, casteCertificateData.caste_certificate_id, VALUE_FIVE);
        }
        if (casteCertificateData.marriage_certi != '') {
            that.showDocument('marriage_certi_container_for_caste_certificate', 'marriage_certi_name_image_for_caste_certificate', 'marriage_certi_name_container_for_caste_certificate',
                    'marriage_certi_download', 'marriage_certi', casteCertificateData.marriage_certi, casteCertificateData.caste_certificate_id, VALUE_SIX);
        }
        if (casteCertificateData.last_10year_proof != '' || val === '4' || val === '5' || val === '6') {
            that.showDocument('last_10year_proof_container_for_caste_certificate', 'last_10year_proof_name_image_for_caste_certificate', 'last_10year_proof_name_container_for_caste_certificate',
                    'last_10year_proof_download', 'last_10year_proof', casteCertificateData.last_10year_proof, casteCertificateData.caste_certificate_id, VALUE_SEVEN);
        }
        if (casteCertificateData.caste_proof != '') {
            that.showDocument('caste_proof_container_for_caste_certificate', 'caste_proof_name_image_for_caste_certificate', 'caste_proof_name_container_for_caste_certificate',
                    'caste_proof_download', 'caste_proof', casteCertificateData.caste_proof, casteCertificateData.caste_certificate_id, VALUE_EIGHT);
        }
        if (casteCertificateData.gas_book != '' || val === '4' || val === '5' || val === '6') {
            that.showDocument('gas_book_container_for_caste_certificate', 'gas_book_name_image_for_caste_certificate', 'gas_book_name_container_for_caste_certificate',
                    'gas_book_download', 'gas_book', casteCertificateData.gas_book, casteCertificateData.caste_certificate_id, VALUE_NINE);
        }
        if (casteCertificateData.bank_book != '' || val === '4' || val === '5' || val === '6') {
            that.showDocument('bank_book_container_for_caste_certificate', 'bank_book_name_image_for_caste_certificate', 'bank_book_name_container_for_caste_certificate',
                    'bank_book_download', 'bank_book', casteCertificateData.bank_book, casteCertificateData.caste_certificate_id, VALUE_TEN);
        }
        if (casteCertificateData.house_tax_receipt != '' || val === '4' || val === '5' || val === '6') {
            that.showDocument('house_tax_receipt_container_for_caste_certificate', 'house_tax_receipt_name_image_for_caste_certificate', 'house_tax_receipt_name_container_for_caste_certificate',
                    'house_tax_receipt_download', 'house_tax_receipt', casteCertificateData.house_tax_receipt, casteCertificateData.caste_certificate_id, VALUE_ELEVEN);
        }
        if (casteCertificateData.noc_with_notary != '' || val === '4' || val === '5' || val === '6') {
            that.showDocument('noc_with_notary_container_for_caste_certificate', 'noc_with_notary_name_image_for_caste_certificate', 'noc_with_notary_name_container_for_caste_certificate',
                    'noc_with_notary_download', 'noc_with_notary', casteCertificateData.noc_with_notary, casteCertificateData.caste_certificate_id, VALUE_TWELVE);
        }

        $('#upload_documents_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },
    typeMajorCasteCertificateForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.caste_certificate_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            var grandfatherDetails = formData.grandfather_details != '' ? JSON.parse(formData.grandfather_details) : {};
            CasteCertificate.router.navigate('edit_type_mjor_caste_certificate_form');
        } else {
            var formData = {};
            var fatherDetails = '';
            var motherDetails = '';
            var spouseDetails = '';
            var grandfatherDetails = '';
            CasteCertificate.router.navigate('type_mjor_caste_certificate_form');
        }

        tempVillageDataForCC = [];
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
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.caste_certificate_data = parseData.caste_certificate_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
            templateData.grandfather_data = grandfatherDetails;
        }


        $('#caste_certificate_form_and_datatable_container').html(typeMajorCasteCertificateFormTemplate(templateData));

        //--------------------------------------------
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        generateBoxes('radio', genderArray, 'gender', 'cc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'cc', formData.marital_status, false, false);
        showSubContainer('marital_status', 'cc', '.spouse_info_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'caste_certificate', formData.have_you_own_house, false, false);
        generateBoxes('radio', yesNoArray, 'im_member_of_scst', 'caste_certificate', formData.im_member_of_scst, false, false);
        showSubContainer('im_member_of_scst', 'caste_certificate', '.im_member_of_scst_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'applied_for_sc_st_certy', 'caste_certificate', formData.applied_for_sc_st_certy, false, false);
        showSubContainer('applied_for_sc_st_certy', 'caste_certificate', '.applied_for_sc_st_certy_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'fath_hus_wif_hold_sc_st_certy', 'caste_certificate', formData.fath_hus_wif_hold_sc_st_certy, false, false);
        showSubContainer('fath_hus_wif_hold_sc_st_certy', 'caste_certificate', '.fath_hus_wif_hold_sc_st_certy_item', VALUE_ONE, 'radio');
        generateBoxes('radio', casteArray, 'applicant_caste', 'caste_certificate', formData.applicant_caste, false, false);
        showSubContainer('applicant_caste', 'caste_certificate', '.applicant_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('applicant_caste', 'caste_certificate', '.applicant_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'if_grandfather_having_document', 'caste_certificate', formData.if_grandfather_having_document, false, false);
        showSubContainer('if_grandfather_having_document', 'caste_certificate', '.if_grandfather_birth_document_item', VALUE_ONE, 'radio');
        showSubContainer('if_grandfather_having_document', 'caste_certificate', '.if_grandfather_property_document_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'father_caste', 'caste_certificate', fatherDetails.father_caste, false, false);
        showSubContainer('father_caste', 'caste_certificate', '.father_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('father_caste', 'caste_certificate', '.father_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'mother_caste', 'caste_certificate', motherDetails.mother_caste, false, false);
        showSubContainer('mother_caste', 'caste_certificate', '.mother_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('mother_caste', 'caste_certificate', '.mother_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'grandfather_caste', 'caste_certificate', grandfatherDetails.grandfather_caste, false, false);
        showSubContainer('grandfather_caste', 'caste_certificate', '.grandfather_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('grandfather_caste', 'caste_certificate', '.grandfather_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'spouse_caste', 'caste_certificate', spouseDetails.spouse_caste, false, false);
        showSubContainer('spouse_caste', 'caste_certificate', '.spouse_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('spouse_caste', 'caste_certificate', '.spouse_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'father_alive', 'caste_certificate', formData.father_alive, false, false);
        showSubContainer('father_alive', 'caste_certificate', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'caste_certificate', '.father_death_proof_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'caste_certificate', formData.mother_alive, false, false);
        generateBoxes('radio', yesNoArray, 'grandfather_alive', 'caste_certificate', formData.grandfather_alive, false, false);
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'caste_certificate', formData.spouse_alive, false, false);
        //showSubContainer('father_alive', 'caste_certificate', '.if_father_alive_item', VALUE_TWO, 'radio');

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
//        renderOptionsForTwoDimensionalArray(distData, 'district');
        renderOptionsForTwoDimensionalArray(distData, 'native_place_district_for_cc');
        renderOptionsForTwoDimensionalArray(distData, 'father_native_place_district_for_cc')
        renderOptionsForTwoDimensionalArray(distData, 'grandfather_native_place_district_for_cc')

        var district = formData.district;
        var nativePlaceDistrict = formData.native_place_district;
        var fatherNativePlaceDistrict = fatherDetails.father_native_place_district;
        var fatherNativeCity = fatherDetails.father_city;
        var grandfatherNativePlaceDistrict = grandfatherDetails.grandfather_native_place_district;
        var grandfatherNativeCity = grandfatherDetails.grandfather_city;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        var villageDataNative = isEdit ? (nativePlaceDistrict == VALUE_ONE ? damanVillagesArray : (nativePlaceDistrict == VALUE_TWO ? diuVillagesArray : (nativePlaceDistrict == VALUE_THREE ? dnhVillagesArray : []))) : [];
        var fatherCityDataNative = isEdit ? (fatherNativePlaceDistrict == VALUE_ONE ? damanVillageForNativeArray : (fatherNativePlaceDistrict == VALUE_TWO ? diuNativeCityArray : (fatherNativePlaceDistrict == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
        var fatherVillageDataNative = isEdit ? (fatherNativeCity == VALUE_ONE ? damanVillageForNativeArray : (fatherNativeCity == VALUE_TWO ? damanVillageForNativeArray : (fatherNativeCity == VALUE_THREE ? diuVillagesForNativeArray : []))) : [];
        var grandfatherCityDataNative = isEdit ? (grandfatherNativePlaceDistrict == VALUE_ONE ? damanVillageForNativeArray : (grandfatherNativePlaceDistrict == VALUE_TWO ? diuNativeCityArray : (grandfatherNativePlaceDistrict == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
        var grandfatherVillageDataNative = isEdit ? (grandfatherNativeCity == VALUE_ONE ? damanVillageForNativeArray : (grandfatherNativeCity == VALUE_TWO ? damanVillageForNativeArray : (grandfatherNativeCity == VALUE_THREE ? diuVillagesForNativeArray : []))) : [];

//        var district = formData.district;
//        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_cc');
        renderOptionsForTwoDimensionalArray(villageDataNative, 'native_place_village_for_cc');
        renderOptionsForTwoDimensionalArray(fatherCityDataNative, 'father_city_for_cc');
        renderOptionsForTwoDimensionalArray(fatherVillageDataNative, 'father_native_place_village_for_cc');
        renderOptionsForTwoDimensionalArray(grandfatherCityDataNative, 'grandfather_city_for_cc');
        renderOptionsForTwoDimensionalArray(grandfatherVillageDataNative, 'grandfather_native_place_village_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_cc');
//        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'native_place_village_for_cc');
//        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'father_native_place_village_for_cc');
        renderOptionsForTwoDimensionalArray(educationTypeArray, 'applicant_education_for_cc');
//        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'grandfather_native_place_village_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'grandfather_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'apllicant_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'apllicant_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'father_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'father_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'mother_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'mother_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'grandfather_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'grandfather_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'spouse_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'spouse_st_subcaste_for_cc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'grandfather_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');


        if (isEdit) {

            $('#born_place_state_for_cc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);

            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_cc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);

            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'cc', formData.born_place_village, 'born_place');
            $('#com_addr_city_for_cc').val(formData.com_addr_city);
            $('#applicant_education_for_cc').val(formData.applicant_education);
            $('#per_addr_city_for_cc').val(formData.per_addr_city);
            $('#select_required_purpose_for_cc').val(formData.select_required_purpose);
            $('#village_name_for_cc').val(formData.village_name);

            if (formData.billingtoo == isChecked) {
                $('#billingtoo_for_cc').attr('checked', 'checked');
            }

            $('.father_info_div').collapse().show();
            $('.mother_info_div').collapse().show();
            $('.grandfather_info_div').collapse().show();
            if (formData.marital_status == VALUE_ONE)
                $('.spouse_info_div').collapse().show();

            $('#declaration_for_caste_certificate').attr('checked', 'checked');
            $('#declaration').attr('checked', 'checked');
            $('#occupation_for_cc').val(formData.occupation);
            $('#nearest_police_station_for_cc').val(formData.nearest_police_station);


            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_cc').show();
            $('#district').val(formData.district);


            $('.father_info_div').collapse().show();
            $('.mother_info_div').collapse().show();
            $('.grandfather_info_div').collapse().show();

            if (formData.applicant_caste == VALUE_ONE) {
                $('.applicant_caste_sc_item_container_for_caste_certificate').collapse().show();
                $('#apllicant_sc_subcaste_for_cc').val(formData.apllicant_sc_subcaste);
            } else {
                $('.applicant_caste_st_item_container_for_caste_certificate').collapse().show();
                $('#apllicant_st_subcaste_for_cc').val(formData.apllicant_st_subcaste);
            }

            if (fatherDetails.father_caste == VALUE_ONE) {
                $('.father_caste_sc_item_container_for_caste_certificate').collapse().show();
                $('#father_sc_subcaste_for_cc').val(fatherDetails.father_sc_subcaste);
            } else {
                $('.father_caste_st_item_container_for_caste_certificate').collapse().show();
                $('#father_st_subcaste_for_cc').val(fatherDetails.father_st_subcaste);
            }

            if (motherDetails.mother_caste == VALUE_ONE) {
                $('.mother_caste_sc_item_container_for_caste_certificate').collapse().show();
                $('#mother_sc_subcaste_for_cc').val(motherDetails.mother_sc_subcaste);
            } else {
                $('.mother_caste_st_item_container_for_caste_certificate').collapse().show();
                $('#mother_st_subcaste_for_cc').val(motherDetails.mother_st_subcaste);
            }

            if (grandfatherDetails.grandfather_caste == VALUE_ONE) {
                $('.grandfather_caste_sc_item_container_for_caste_certificate').collapse().show();
                $('#grandfather_sc_subcaste_for_cc').val(grandfatherDetails.grandfather_sc_subcaste);
            } else {
                $('.grandfather_caste_st_item_container_for_caste_certificate').collapse().show();
                $('#grandfather_st_subcaste_for_cc').val(grandfatherDetails.grandfather_st_subcaste);
            }

            if (spouseDetails.spouse_caste == VALUE_ONE) {
                $('.spouse_caste_sc_item_container_for_caste_certificate').collapse().show();
                $('#spouse_sc_subcaste_for_cc').val(spouseDetails.spouse_sc_subcaste);
            } else {
                $('.spouse_caste_st_item_container_for_caste_certificate').collapse().show();
                $('#spouse_st_subcaste_for_cc').val(spouseDetails.spouse_st_subcaste);
            }

            $('#declaration_for_caste_certificate').attr('checked', 'checked');
            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_cc').show();

            $('#father_born_place_state_for_cc').val(fatherDetails.father_born_place_state == 0 ? '' : fatherDetails.father_born_place_state);

            var districtData = tempDistrictData[fatherDetails.father_born_place_state] ? tempDistrictData[fatherDetails.father_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#father_born_place_district_for_cc').val(fatherDetails.father_born_place_district == 0 ? '' : fatherDetails.father_born_place_district);

            if (fatherDetails.father_born_place_state != VALUE_ZERO)
                that.getEditVillageData(fatherDetails.father_born_place_state, fatherDetails.father_born_place_district, 'cc', fatherDetails.father_born_place_village, 'father_born_place');

            $('#per_addr_state_for_cc').val(formData.per_addr_state == 0 ? '' : formData.per_addr_state);
            var districtData = tempDistrictData[formData.per_addr_state] ? tempDistrictData[formData.per_addr_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_addr_district_for_cc', 'district_code', 'district_name', 'District');
            $('#per_addr_district_for_cc').val(formData.per_addr_district == 0 ? '' : formData.per_addr_district);

            tempVillageDataForCC = formData.per_addr_village_data;
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.per_addr_village_data, 'per_addr_village_for_cc', 'village_code', 'village_name', 'Village');
            $('#per_addr_village_for_cc').val(formData.per_addr_village);


            $('#father_city_for_cc').val(fatherDetails.father_city);
            $('#native_place_state_for_cc').val(formData.native_place_state);
            $('#native_place_district_for_cc').val(formData.native_place_district);
            $('#native_place_village_for_cc').val(formData.native_place_village);
            $('#father_native_place_district_for_cc').val(fatherDetails.father_native_place_district);
            $('#father_native_place_village_for_cc').val(fatherDetails.father_native_place_village);
            $('#father_occupation_for_cc').val(fatherDetails.father_occupation);

            if (fatherDetails.father_occupation == VALUE_TWELVE)
                $('.father_other_occupation_div_for_cc').show();

            $('#grandfather_born_place_state_for_cc').val(grandfatherDetails.grandfather_born_place_state == 0 ? '' : grandfatherDetails.grandfather_born_place_state);

            var districtData = tempDistrictData[grandfatherDetails.grandfather_born_place_state] ? tempDistrictData[grandfatherDetails.grandfather_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'grandfather_born_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#grandfather_born_place_district_for_cc').val(grandfatherDetails.grandfather_born_place_district == 0 ? '' : grandfatherDetails.grandfather_born_place_district);

            if (grandfatherDetails.grandfather_born_place_state != VALUE_ZERO)
                that.getEditVillageData(grandfatherDetails.grandfather_born_place_state, grandfatherDetails.grandfather_born_place_district, 'cc', grandfatherDetails.grandfather_born_place_village, 'grandfather_born_place');

            $('#grandfather_city_for_cc').val(grandfatherDetails.grandfather_city);
            $('#grandfather_native_place_district_for_cc').val(grandfatherDetails.grandfather_native_place_district);
            $('#grandfather_native_place_village_for_cc').val(grandfatherDetails.grandfather_native_place_village);
            $('#grandfather_occupation_for_cc').val(grandfatherDetails.grandfather_occupation);

            if (grandfatherDetails.grandfather_occupation == VALUE_TWELVE)
                $('.grandfather_other_occupation_div_for_cc').show();


            $('#mother_born_place_state_for_cc').val(motherDetails.mother_born_place_state == 0 ? '' : motherDetails.mother_born_place_state);

            var districtData = tempDistrictData[motherDetails.mother_born_place_state] ? tempDistrictData[motherDetails.mother_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#mother_born_place_district_for_cc').val(motherDetails.mother_born_place_district == 0 ? '' : motherDetails.mother_born_place_district);

            if (motherDetails.mother_born_place_state != VALUE_ZERO)
                that.getEditVillageData(motherDetails.mother_born_place_state, motherDetails.mother_born_place_district, 'cc', motherDetails.mother_born_place_village, 'mother_born_place');
            $('#mother_native_place_state_for_cc').val(motherDetails.mother_native_place_state == 0 ? '' : motherDetails.mother_native_place_state);

            var districtData = tempDistrictData[motherDetails.mother_native_place_state] ? tempDistrictData[motherDetails.mother_native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_native_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#mother_native_place_district_for_cc').val(motherDetails.mother_native_place_district == 0 ? '' : motherDetails.mother_native_place_district);

            if (motherDetails.mother_native_place_state != VALUE_ZERO)
                that.getEditVillageData(motherDetails.mother_native_place_state, motherDetails.mother_native_place_district, 'cc', motherDetails.mother_native_place_village, 'mother_native_place');
            $('#mother_native_place_state_for_cc').val(motherDetails.mother_native_place_state == 0 ? '' : motherDetails.mother_native_place_state);
            $('#mother_city_for_cc').val(motherDetails.mother_city);
            $('#mother_occupation_for_cc').val(motherDetails.mother_occupation);

            if (motherDetails.mother_occupation == VALUE_TWELVE)
                $('.mother_other_occupation_div_for_cc').show();

            if (formData.marital_status == VALUE_ONE) {
                $('#spouse_born_place_state_for_cc').val(spouseDetails.spouse_born_place_state == 0 ? '' : spouseDetails.spouse_born_place_state);

                var districtData = tempDistrictData[spouseDetails.spouse_born_place_state] ? tempDistrictData[spouseDetails.spouse_born_place_state] : [];
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_born_place_district_for_cc', 'district_code', 'district_name', 'District');
                $('#spouse_born_place_district_for_cc').val(spouseDetails.spouse_born_place_district == 0 ? '' : spouseDetails.spouse_born_place_district);

                if (spouseDetails.spouse_born_place_state != VALUE_ZERO)
                    that.getEditVillageData(spouseDetails.spouse_born_place_state, spouseDetails.spouse_born_place_district, 'cc', spouseDetails.spouse_born_place_village, 'spouse_born_place');
                $('#spouse_native_place_state_for_cc').val(spouseDetails.spouse_native_place_state == 0 ? '' : spouseDetails.spouse_native_place_state);

                var districtData = tempDistrictData[spouseDetails.spouse_native_place_state] ? tempDistrictData[spouseDetails.spouse_native_place_state] : [];
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_native_place_district_for_cc', 'district_code', 'district_name', 'District');
                $('#spouse_native_place_district_for_cc').val(spouseDetails.spouse_native_place_district == 0 ? '' : spouseDetails.spouse_native_place_district);

                if (spouseDetails.spouse_native_place_state != VALUE_ZERO)
                    that.getEditVillageData(spouseDetails.spouse_native_place_state, spouseDetails.spouse_native_place_district, 'cc', spouseDetails.spouse_native_place_village, 'spouse_native_place');

                $('#spouse_city_for_cc').val(spouseDetails.spouse_city);
                $('#spouse_occupation_for_cc').val(spouseDetails.spouse_occupation);

                if (spouseDetails.spouse_occupation == VALUE_TWELVE)
                    $('.spouse_other_occupation_div_for_cc').show();
            }


            //------------------------------------------

            var val = formData.constitution_artical;

            if (formData.self_birth_certificate_doc != '') {
                that.showDocument('self_birth_certificate_doc_container_for_caste_certificate', 'self_birth_certificate_doc_name_image_for_caste_certificate', 'self_birth_certificate_doc_name_container_for_caste_certificate',
                        'self_birth_certificate_doc_download', 'self_birth_certificate_doc', formData.self_birth_certificate_doc, formData.caste_certificate_id, VALUE_ONE);
            }

            if (formData.father_certificate_doc != '') {
                that.showDocument('father_certificate_doc_container_for_caste_certificate', 'father_certificate_doc_name_image_for_caste_certificate', 'father_certificate_doc_name_container_for_caste_certificate',
                        'father_certificate_doc_download', 'father_certificate_doc', formData.father_certificate_doc, formData.caste_certificate_id, VALUE_TWO);
            }

            if (formData.grandfather_birth_certificate_doc != '') {
                that.showDocument('grandfather_birth_certificate_doc_container_for_caste_certificate', 'grandfather_birth_certificate_doc_name_image_for_caste_certificate', 'grandfather_birth_certificate_doc_name_container_for_caste_certificate',
                        'grandfather_birth_certificate_doc_download', 'grandfather_birth_certificate_doc', formData.grandfather_birth_certificate_doc, formData.caste_certificate_id, VALUE_THREE);
            }

            if (formData.grandfather_property_doc != '') {
                that.showDocument('grandfather_property_doc_container_for_caste_certificate', 'grandfather_property_doc_name_image_for_caste_certificate', 'grandfather_property_doc_name_container_for_caste_certificate',
                        'grandfather_property_doc_download', 'grandfather_property_doc', formData.grandfather_property_doc, formData.caste_certificate_id, VALUE_FOUR);
            }

            if (formData.leaving_certificate_doc != '') {
                that.showDocument('leaving_certificate_doc_container_for_caste_certificate', 'leaving_certificate_doc_name_image_for_caste_certificate', 'leaving_certificate_doc_name_container_for_caste_certificate',
                        'leaving_certificate_doc_download', 'leaving_certificate_doc', formData.leaving_certificate_doc, formData.caste_certificate_id, VALUE_FIVE);
            }

            if (formData.election_card_doc != '') {
                that.showDocument('election_card_doc_container_for_caste_certificate', 'election_card_doc_name_image_for_caste_certificate', 'election_card_doc_name_container_for_caste_certificate',
                        'election_card_doc_download', 'election_card_doc', formData.election_card_doc, formData.caste_certificate_id, VALUE_SIX);
            }

            if (formData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_caste_certificate', 'aadhar_card_doc_name_image_for_caste_certificate', 'aadhar_card_doc_name_container_for_caste_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.caste_certificate_id, VALUE_SEVEN);
            }

            if (formData.community_certificate_doc != '') {
                that.showDocument('community_certificate_doc_container_for_caste_certificate', 'community_certificate_doc_name_image_for_caste_certificate', 'community_certificate_doc_name_container_for_caste_certificate',
                        'community_certificate_doc_download', 'community_certificate_doc', formData.community_certificate_doc, formData.caste_certificate_id, VALUE_EIGHT);
            }

            if (formData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_caste_certificate', 'applicant_photo_doc_name_image_for_caste_certificate', 'applicant_photo_doc_name_container_for_caste_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.caste_certificate_id, VALUE_NINE);
            }

            if (formData.father_community_certificate_doc != '') {
                that.showDocument('father_community_certificate_doc_container_for_caste_certificate', 'father_community_certificate_doc_name_image_for_caste_certificate', 'father_community_certificate_doc_name_container_for_caste_certificate',
                        'father_community_certificate_doc_download', 'father_community_certificate_doc', formData.father_community_certificate_doc, formData.caste_certificate_id, VALUE_TWELVE);
            }

            if (formData.father_election_card_doc != '') {
                that.showDocument('father_election_card_doc_container_for_caste_certificate', 'father_election_card_doc_name_image_for_caste_certificate', 'father_election_card_doc_name_container_for_caste_certificate',
                        'father_election_card_doc_download', 'father_election_card_doc', formData.father_election_card_doc, formData.caste_certificate_id, VALUE_THIRTEEN);
            }

            if (formData.father_aadhar_card_doc != '') {
                that.showDocument('father_aadhar_card_doc_container_for_caste_certificate', 'father_aadhar_card_doc_name_image_for_caste_certificate', 'father_aadhar_card_doc_name_container_for_caste_certificate',
                        'father_aadhar_card_doc_download', 'father_aadhar_card_doc', formData.father_aadhar_card_doc, formData.caste_certificate_id, VALUE_FOURTEEN);
            }
            if (formData.mother_election_card_doc != '') {
                that.showDocument('mother_election_card_doc_container_for_caste_certificate', 'mother_election_card_doc_name_image_for_caste_certificate', 'mother_election_card_doc_name_container_for_caste_certificate',
                        'mother_election_card_doc_download', 'mother_election_card_doc', formData.mother_election_card_doc, formData.caste_certificate_id, VALUE_FIFTEEN);
            }

            if (formData.mother_aadhar_card_doc != '') {
                that.showDocument('mother_aadhar_card_doc_container_for_caste_certificate', 'mother_aadhar_card_doc_name_image_for_caste_certificate', 'mother_aadhar_card_doc_name_container_for_caste_certificate',
                        'mother_aadhar_card_doc_download', 'mother_aadhar_card_doc', formData.mother_aadhar_card_doc, formData.caste_certificate_id, VALUE_SIXTEEN);
            }


            if (formData.father_alive == VALUE_ONE) {
                $("#father_alive_for_caste_certificate_1").prop("checked", true);
            } else {
                $("#father_alive_for_caste_certificate_2").prop("checked", true);
            }

            if (formData.mother_alive == VALUE_ONE) {
                $("#mother_alive_for_caste_certificate_1").prop("checked", true);
            } else {
                $("#mother_alive_for_caste_certificate_2").prop("checked", true);
            }

            if (formData.grandfather_alive == VALUE_ONE) {
                $("#grandfather_alive_for_caste_certificate_1").prop("checked", true);
            } else {
                $("#grandfather_alive_for_caste_certificate_2").prop("checked", true);
            }

            if (formData.spouse_alive == VALUE_ONE) {
                $("#spouse_alive_for_caste_certificate_1").prop("checked", true);
            } else {
                $("#spouse_alive_for_caste_certificate_2").prop("checked", true);
            }

        } else {
            $("#father_alive_for_caste_certificate_1").prop("checked", true);
            $("#mother_alive_for_caste_certificate_1").prop("checked", true);
            $("#grandfather_alive_for_caste_certificate_1").prop("checked", true);
            $("#spouse_alive_for_caste_certificate_1").prop("checked", true);
        }

        generateSelect2();
        datePicker();
        datePickerMax('applicant_dob_for_cc');
        datePickerToday('applied_date_for_caste_certificate');
        datePickerToday('applied_date_of_hold_certy_for_caste_certificate');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_cc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
            if (formData.applied_date != '0000-00-00') {
                $('#applied_date_for_caste_certificate').val(dateTo_DD_MM_YYYY(formData.applied_date));
            }
            if (formData.applied_date_of_hold_certy != '0000-00-00') {
                $('#applied_date_of_hold_certy_for_caste_certificate').val(dateTo_DD_MM_YYYY(formData.applied_date_of_hold_certy));
            }
        }

        $('#caste_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitCasteCertificate($('#submit_btn_for_caste_certificate'));
            }
        });
    },
    typeMinorCasteCertificateForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.caste_certificate_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            var grandfatherDetails = formData.grandfather_details != '' ? JSON.parse(formData.grandfather_details) : {};
            CasteCertificate.router.navigate('edit_type_minor_caste_certificate_form');
        } else {
            var formData = {};
            var fatherDetails = '';
            var motherDetails = '';
            var spouseDetails = '';
            var grandfatherDetails = '';
            CasteCertificate.router.navigate('type_minor_caste_certificate_form');
        }

        tempVillageDataForCC = [];
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
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.caste_certificate_data = parseData.caste_certificate_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
            templateData.grandfather_data = grandfatherDetails;
        }


        $('#caste_certificate_form_and_datatable_container').html(typeMinorCasteCertificateFormTemplate(templateData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        generateBoxes('radio', genderArray, 'gender', 'cc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'cc', formData.marital_status, false, false);
        showSubContainer('marital_status', 'cc', '.spouse_info_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'caste_certificate', formData.have_you_own_house, false, false);
        generateBoxes('radio', yesNoArray, 'im_member_of_scst', 'caste_certificate', formData.im_member_of_scst, false, false);
        showSubContainer('im_member_of_scst', 'caste_certificate', '.im_member_of_scst_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'applied_for_sc_st_certy', 'caste_certificate', formData.applied_for_sc_st_certy, false, false);
        showSubContainer('applied_for_sc_st_certy', 'caste_certificate', '.applied_for_sc_st_certy_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'fath_hus_wif_hold_sc_st_certy', 'caste_certificate', formData.fath_hus_wif_hold_sc_st_certy, false, false);
        showSubContainer('fath_hus_wif_hold_sc_st_certy', 'caste_certificate', '.fath_hus_wif_hold_sc_st_certy_item', VALUE_ONE, 'radio');
        generateBoxes('radio', casteArray, 'applicant_caste', 'caste_certificate', formData.applicant_caste, false, false);
        showSubContainer('applicant_caste', 'caste_certificate', '.applicant_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('applicant_caste', 'caste_certificate', '.applicant_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'if_grandfather_having_document', 'caste_certificate', formData.if_grandfather_having_document, false, false);
        showSubContainer('if_grandfather_having_document', 'caste_certificate', '.if_grandfather_birth_document_item', VALUE_ONE, 'radio');
        showSubContainer('if_grandfather_having_document', 'caste_certificate', '.if_grandfather_property_document_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'father_caste', 'caste_certificate', fatherDetails.father_caste, false, false);
        showSubContainer('father_caste', 'caste_certificate', '.father_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('father_caste', 'caste_certificate', '.father_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'mother_caste', 'caste_certificate', motherDetails.mother_caste, false, false);
        showSubContainer('mother_caste', 'caste_certificate', '.mother_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('mother_caste', 'caste_certificate', '.mother_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', casteArray, 'grandfather_caste', 'caste_certificate', grandfatherDetails.grandfather_caste, false, false);
        showSubContainer('grandfather_caste', 'caste_certificate', '.grandfather_caste_sc_item', VALUE_ONE, 'radio');
        showSubContainer('grandfather_caste', 'caste_certificate', '.grandfather_caste_st_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'father_alive', 'caste_certificate', formData.father_alive, false, false);
        generateBoxes('radio', yesNoArray, 'mother_alive', 'caste_certificate', formData.mother_alive, false, false);
        generateBoxes('radio', yesNoArray, 'grandfather_alive', 'caste_certificate', formData.grandfather_alive, false, false);
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'caste_certificate', formData.spouse_alive, false, false);

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
//        renderOptionsForTwoDimensionalArray(distData, 'district');
        renderOptionsForTwoDimensionalArray(distData, 'native_place_district_for_cc');
        renderOptionsForTwoDimensionalArray(distData, 'father_native_place_district_for_cc');
        renderOptionsForTwoDimensionalArray(distData, 'grandfather_native_place_district_for_cc');

        var district = formData.district;
        var nativePlaceDistrict = formData.native_place_district;
        var fatherNativePlaceDistrict = fatherDetails.father_native_place_district;
        var fatherNativeCity = fatherDetails.father_city;
        var grandfatherNativePlaceDistrict = grandfatherDetails.grandfather_native_place_district;
        var grandfatherNativeCity = grandfatherDetails.grandfather_city;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        var villageDataNative = isEdit ? (nativePlaceDistrict == VALUE_ONE ? damanVillagesArray : (nativePlaceDistrict == VALUE_TWO ? diuVillagesArray : (nativePlaceDistrict == VALUE_THREE ? dnhVillagesArray : []))) : [];
        var fatherCityDataNative = isEdit ? (fatherNativePlaceDistrict == VALUE_ONE ? damanVillageForNativeArray : (fatherNativePlaceDistrict == VALUE_TWO ? diuNativeCityArray : (fatherNativePlaceDistrict == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
        var fatherVillageDataNative = isEdit ? (fatherNativeCity == VALUE_ONE ? damanVillageForNativeArray : (fatherNativeCity == VALUE_TWO ? damanVillageForNativeArray : (fatherNativeCity == VALUE_THREE ? diuVillagesForNativeArray : []))) : [];
        var grandfatherCityDataNative = isEdit ? (grandfatherNativePlaceDistrict == VALUE_ONE ? damanVillageForNativeArray : (grandfatherNativePlaceDistrict == VALUE_TWO ? diuNativeCityArray : (grandfatherNativePlaceDistrict == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
        var grandfatherVillageDataNative = isEdit ? (grandfatherNativeCity == VALUE_ONE ? damanVillageForNativeArray : (grandfatherNativeCity == VALUE_TWO ? damanVillageForNativeArray : (grandfatherNativeCity == VALUE_THREE ? diuVillagesForNativeArray : []))) : [];
//        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_cc');
        renderOptionsForTwoDimensionalArray(villageDataNative, 'native_place_village_for_cc');
        renderOptionsForTwoDimensionalArray(fatherCityDataNative, 'father_city_for_cc');
        renderOptionsForTwoDimensionalArray(fatherVillageDataNative, 'father_native_place_village_for_cc');
        renderOptionsForTwoDimensionalArray(grandfatherCityDataNative, 'grandfather_city_for_cc');
        renderOptionsForTwoDimensionalArray(grandfatherVillageDataNative, 'grandfather_native_place_village_for_cc');
//        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_cc');
//        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'native_place_village_for_cc');
//        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'father_native_place_village_for_cc');
//        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'grandfather_native_place_village_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'grandfather_occupation_for_cc');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'father_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'apllicant_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'apllicant_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relationship_of_applicant_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'father_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'father_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'mother_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'mother_st_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantScSubcasteArray, 'grandfather_sc_subcaste_for_cc');
        renderOptionsForTwoDimensionalArray(applicantStSubcasteArray, 'grandfather_st_subcaste_for_cc');



        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'commu_add_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'per_addr_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'grandfather_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_cc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_cc', 'state_code', 'state_name', 'State/UT');


        if (isEdit) {

            $('#commu_add_state_for_cc').val(formData.commu_add_state == 0 ? '' : formData.commu_add_state);

            var districtData = tempDistrictData[formData.commu_add_state] ? tempDistrictData[formData.commu_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'commu_add_district_for_cc', 'district_code', 'district_name', 'District');
            $('#commu_add_district_for_cc').val(formData.commu_add_district == 0 ? '' : formData.commu_add_district);

            that.getEditVillageData(formData.commu_add_state, formData.commu_add_district, 'cc', formData.commu_add_village, 'commu_add');

            $('#born_place_state_for_cc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);

            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_cc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);

            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'cc', formData.born_place_village, 'born_place');

            $('#per_addr_state_for_cc').val(formData.per_addr_state == 0 ? '' : formData.per_addr_state);
            var districtData = tempDistrictData[formData.per_addr_state] ? tempDistrictData[formData.per_addr_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_addr_district_for_cc', 'district_code', 'district_name', 'District');
            $('#per_addr_district_for_cc').val(formData.per_addr_district == 0 ? '' : formData.per_addr_district);

            tempVillageDataForCC = formData.per_addr_village_data;
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.per_addr_village_data, 'per_addr_village_for_cc', 'village_code', 'village_name', 'Village');
            $('#per_addr_village_for_cc').val(formData.per_addr_village);


            $('#com_addr_city_for_cc').val(formData.com_addr_city);
            $('#per_addr_city_for_cc').val(formData.per_addr_city);
            $('#select_required_purpose_for_cc').val(formData.select_required_purpose);
            $('#village_name_for_cc').val(formData.village_name);


            if (formData.billingtoo == isChecked) {
                $('#billingtoo_for_cc').attr('checked', 'checked');
            }

            $('.father_info_div').collapse().show();
            $('.mother_info_div').collapse().show();
            $('.grandfather_info_div').collapse().show();
            if (formData.marital_status == VALUE_ONE)
                $('.spouse_detail_div').collapse().show();

            $('#declaration_for_caste_certificate').attr('checked', 'checked');
            $('#declaration').attr('checked', 'checked');
            $('#occupation_for_cc').val(formData.occupation);
            $('#nearest_police_station_for_cc').val(formData.nearest_police_station);
            $('#relationship_of_applicant_for_cc').val(formData.relationship_of_applicant);


            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_cc').show();
            $('#district').val(formData.district);


            $('.father_info_div').collapse().show();
            $('.mother_info_div').collapse().show();
            $('.grandfather_info_div').collapse().show();

            if (formData.applicant_caste == VALUE_ONE) {
                $('.applicant_caste_sc_item_container_for_caste_certificate').collapse().show();
                $('#apllicant_sc_subcaste_for_cc').val(formData.apllicant_sc_subcaste);
            } else {
                $('.applicant_caste_st_item_container_for_caste_certificate').collapse().show();
                $('#apllicant_st_subcaste_for_cc').val(formData.apllicant_st_subcaste);
            }

            if (fatherDetails.father_caste == VALUE_ONE) {
                $('.father_caste_sc_item_container_for_caste_certificate').collapse().show();
                $('#father_sc_subcaste_for_cc').val(fatherDetails.father_sc_subcaste);
            } else {
                $('.father_caste_st_item_container_for_caste_certificate').collapse().show();
                $('#father_st_subcaste_for_cc').val(fatherDetails.father_st_subcaste);
            }

            if (motherDetails.mother_caste == VALUE_ONE) {
                $('.mother_caste_sc_item_container_for_caste_certificate').collapse().show();
                $('#mother_sc_subcaste_for_cc').val(motherDetails.mother_sc_subcaste);
            } else {
                $('.mother_caste_st_item_container_for_caste_certificate').collapse().show();
                $('#mother_st_subcaste_for_cc').val(motherDetails.mother_st_subcaste);
            }

            if (grandfatherDetails.grandfather_caste == VALUE_ONE) {
                $('.grandfather_caste_sc_item_container_for_caste_certificate').collapse().show();
                $('#grandfather_sc_subcaste_for_cc').val(grandfatherDetails.grandfather_sc_subcaste);
            } else {
                $('.grandfather_caste_st_item_container_for_caste_certificate').collapse().show();
                $('#grandfather_st_subcaste_for_cc').val(grandfatherDetails.grandfather_st_subcaste);
            }



            $('#declaration_for_caste_certificate').attr('checked', 'checked');
            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_cc').show();

            $('#father_born_place_state_for_cc').val(fatherDetails.father_born_place_state == 0 ? '' : fatherDetails.father_born_place_state);

            var districtData = tempDistrictData[fatherDetails.father_born_place_state] ? tempDistrictData[fatherDetails.father_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#father_born_place_district_for_cc').val(fatherDetails.father_born_place_district == 0 ? '' : fatherDetails.father_born_place_district);

            if (fatherDetails.father_born_place_state != VALUE_ZERO)
                that.getEditVillageData(fatherDetails.father_born_place_state, fatherDetails.father_born_place_district, 'cc', fatherDetails.father_born_place_village, 'father_born_place');

            $('#father_city_for_cc').val(fatherDetails.father_city);
            $('#native_place_state_for_cc').val(formData.native_place_state);
            $('#native_place_district_for_cc').val(formData.native_place_district);
            $('#native_place_village_for_cc').val(formData.native_place_village);
            $('#father_native_place_district_for_cc').val(fatherDetails.father_native_place_district);
            $('#father_native_place_village_for_cc').val(fatherDetails.father_native_place_village);
            $('#father_occupation_for_cc').val(fatherDetails.father_occupation);

            if (fatherDetails.father_occupation == VALUE_TWELVE)
                $('.father_other_occupation_div_for_cc').show();

            $('#grandfather_born_place_state_for_cc').val(grandfatherDetails.grandfather_born_place_state == 0 ? '' : grandfatherDetails.grandfather_born_place_state);

            var districtData = tempDistrictData[grandfatherDetails.grandfather_born_place_state] ? tempDistrictData[grandfatherDetails.grandfather_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'grandfather_born_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#grandfather_born_place_district_for_cc').val(grandfatherDetails.grandfather_born_place_district == 0 ? '' : grandfatherDetails.grandfather_born_place_district);

            if (grandfatherDetails.grandfather_born_place_state != VALUE_ZERO)
                that.getEditVillageData(grandfatherDetails.grandfather_born_place_state, grandfatherDetails.grandfather_born_place_district, 'cc', grandfatherDetails.grandfather_born_place_village, 'grandfather_born_place');

            $('#grandfather_city_for_cc').val(grandfatherDetails.grandfather_city);
            $('#grandfather_native_place_district_for_cc').val(grandfatherDetails.grandfather_native_place_district);
            $('#grandfather_native_place_village_for_cc').val(grandfatherDetails.grandfather_native_place_village);
            $('#grandfather_occupation_for_cc').val(grandfatherDetails.grandfather_occupation);

            if (grandfatherDetails.grandfather_occupation == VALUE_TWELVE)
                $('.grandfather_other_occupation_div_for_cc').show();


            $('#mother_born_place_state_for_cc').val(motherDetails.mother_born_place_state == 0 ? '' : motherDetails.mother_born_place_state);

            var districtData = tempDistrictData[motherDetails.mother_born_place_state] ? tempDistrictData[motherDetails.mother_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#mother_born_place_district_for_cc').val(motherDetails.mother_born_place_district == 0 ? '' : motherDetails.mother_born_place_district);

            if (motherDetails.mother_born_place_state != VALUE_ZERO)
                that.getEditVillageData(motherDetails.mother_born_place_state, motherDetails.mother_born_place_district, 'cc', motherDetails.mother_born_place_village, 'mother_born_place');

            $('#mother_native_place_state_for_cc').val(motherDetails.mother_native_place_state == 0 ? '' : motherDetails.mother_native_place_state);

            var districtData = tempDistrictData[motherDetails.mother_native_place_state] ? tempDistrictData[motherDetails.mother_native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_native_place_district_for_cc', 'district_code', 'district_name', 'District');
            $('#mother_native_place_district_for_cc').val(motherDetails.mother_native_place_district == 0 ? '' : motherDetails.mother_native_place_district);

            if (motherDetails.mother_native_place_state != VALUE_ZERO)
                that.getEditVillageData(motherDetails.mother_native_place_state, motherDetails.mother_native_place_district, 'cc', motherDetails.mother_native_place_village, 'mother_native_place');

            $('#mother_city_for_cc').val(motherDetails.mother_city);
            $('#mother_occupation_for_cc').val(motherDetails.mother_occupation);

            if (motherDetails.mother_occupation == VALUE_TWELVE)
                $('.mother_other_occupation_div_for_cc').show();

            if (formData.marital_status == VALUE_ONE) {
                $('#spouse_born_place_state_for_cc').val(spouseDetails.spouse_born_place_state == 0 ? '' : spouseDetails.spouse_born_place_state);

                var districtData = tempDistrictData[spouseDetails.spouse_born_place_state] ? tempDistrictData[spouseDetails.spouse_born_place_state] : [];
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_born_place_district_for_cc', 'district_code', 'district_name', 'District');
                $('#spouse_born_place_district_for_cc').val(spouseDetails.spouse_born_place_district == 0 ? '' : spouseDetails.spouse_born_place_district);

                if (spouseDetails.spouse_born_place_state != VALUE_ZERO)
                    that.getEditVillageData(spouseDetails.spouse_born_place_state, spouseDetails.spouse_born_place_district, 'cc', spouseDetails.spouse_born_place_village, 'spouse_born_place');

                $('#spouse_native_place_state_for_cc').val(spouseDetails.spouse_native_place_state == 0 ? '' : spouseDetails.spouse_native_place_state);

                var districtData = tempDistrictData[spouseDetails.spouse_native_place_state] ? tempDistrictData[spouseDetails.spouse_native_place_state] : [];
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_native_place_district_for_cc', 'district_code', 'district_name', 'District');
                $('#spouse_native_place_district_for_cc').val(spouseDetails.spouse_native_place_district == 0 ? '' : spouseDetails.spouse_native_place_district);

                if (spouseDetails.spouse_native_place_state != VALUE_ZERO)
                    that.getEditVillageData(spouseDetails.spouse_native_place_state, spouseDetails.spouse_native_place_district, 'cc', spouseDetails.spouse_native_place_village, 'spouse_native_place');

                $('#spouse_city_for_cc').val(spouseDetails.spouse_city);
                $('#spouse_occupation_for_cc').val(spouseDetails.spouse_occupation);

                if (spouseDetails.spouse_occupation == VALUE_TWELVE)
                    $('.spouse_other_occupation_div_for_cc').show();
            }



            //------------------------------------------

            var val = formData.constitution_artical;

            if (formData.self_birth_certificate_doc != '') {
                that.showDocument('self_birth_certificate_doc_container_for_caste_certificate', 'self_birth_certificate_doc_name_image_for_caste_certificate', 'self_birth_certificate_doc_name_container_for_caste_certificate',
                        'self_birth_certificate_doc_download', 'self_birth_certificate_doc', formData.self_birth_certificate_doc, formData.caste_certificate_id, VALUE_ONE);
            }

            if (formData.father_certificate_doc != '') {
                that.showDocument('father_certificate_doc_container_for_caste_certificate', 'father_certificate_doc_name_image_for_caste_certificate', 'father_certificate_doc_name_container_for_caste_certificate',
                        'father_certificate_doc_download', 'father_certificate_doc', formData.father_certificate_doc, formData.caste_certificate_id, VALUE_TWO);
            }

            if (formData.grandfather_birth_certificate_doc != '') {
                that.showDocument('grandfather_birth_certificate_doc_container_for_caste_certificate', 'grandfather_birth_certificate_doc_name_image_for_caste_certificate', 'grandfather_birth_certificate_doc_name_container_for_caste_certificate',
                        'grandfather_birth_certificate_doc_download', 'grandfather_birth_certificate_doc', formData.grandfather_birth_certificate_doc, formData.caste_certificate_id, VALUE_THREE);
            }

            if (formData.grandfather_property_doc != '') {
                that.showDocument('grandfather_property_doc_container_for_caste_certificate', 'grandfather_property_doc_name_image_for_caste_certificate', 'grandfather_property_doc_name_container_for_caste_certificate',
                        'grandfather_property_doc_download', 'grandfather_property_doc', formData.grandfather_property_doc, formData.caste_certificate_id, VALUE_FOUR);
            }

            if (formData.leaving_certificate_doc != '') {
                that.showDocument('leaving_certificate_doc_container_for_caste_certificate', 'leaving_certificate_doc_name_image_for_caste_certificate', 'leaving_certificate_doc_name_container_for_caste_certificate',
                        'leaving_certificate_doc_download', 'leaving_certificate_doc', formData.leaving_certificate_doc, formData.caste_certificate_id, VALUE_FIVE);
            }

            if (formData.election_card_doc != '') {
                that.showDocument('election_card_doc_container_for_caste_certificate', 'election_card_doc_name_image_for_caste_certificate', 'election_card_doc_name_container_for_caste_certificate',
                        'election_card_doc_download', 'election_card_doc', formData.election_card_doc, formData.caste_certificate_id, VALUE_SIX);
            }

            if (formData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_caste_certificate', 'aadhar_card_doc_name_image_for_caste_certificate', 'aadhar_card_doc_name_container_for_caste_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.caste_certificate_id, VALUE_SEVEN);
            }

            if (formData.community_certificate_doc != '') {
                that.showDocument('community_certificate_doc_container_for_caste_certificate', 'community_certificate_doc_name_image_for_caste_certificate', 'community_certificate_doc_name_container_for_caste_certificate',
                        'community_certificate_doc_download', 'community_certificate_doc', formData.community_certificate_doc, formData.caste_certificate_id, VALUE_EIGHT);
            }

            if (formData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_caste_certificate', 'applicant_photo_doc_name_image_for_caste_certificate', 'applicant_photo_doc_name_container_for_caste_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.caste_certificate_id, VALUE_NINE);
            }

            if (formData.minor_child_photo_doc != '') {
                that.showDocument('minor_child_photo_doc_container_for_caste_certificate', 'minor_child_photo_doc_name_image_for_caste_certificate', 'minor_child_photo_doc_name_container_for_caste_certificate',
                        'minor_child_photo_doc_download', 'minor_child_photo_doc', formData.minor_child_photo_doc, formData.caste_certificate_id, VALUE_TEN);
            }

            if (formData.parents_aadhar_card_doc != '') {
                that.showDocument('parents_aadhar_card_doc_container_for_caste_certificate', 'parents_aadhar_card_doc_name_image_for_caste_certificate', 'parents_aadhar_card_doc_name_container_for_caste_certificate',
                        'parents_aadhar_card_doc_download', 'parents_aadhar_card_doc', formData.parents_aadhar_card_doc, formData.caste_certificate_id, VALUE_ELEVEN);
            }

            if (formData.father_community_certificate_doc != '') {
                that.showDocument('father_community_certificate_doc_container_for_caste_certificate', 'father_community_certificate_doc_name_image_for_caste_certificate', 'father_community_certificate_doc_name_container_for_caste_certificate',
                        'father_community_certificate_doc_download', 'father_community_certificate_doc', formData.father_community_certificate_doc, formData.caste_certificate_id, VALUE_TWELVE);
            }

            if (formData.father_alive == VALUE_ONE) {
                $("#father_alive_for_caste_certificate_1").prop("checked", true);
            } else {
                $("#father_alive_for_caste_certificate_2").prop("checked", true);
            }

            if (formData.mother_alive == VALUE_ONE) {
                $("#mother_alive_for_caste_certificate_1").prop("checked", true);
            } else {
                $("#mother_alive_for_caste_certificate_2").prop("checked", true);
            }

            if (formData.grandfather_alive == VALUE_ONE) {
                $("#grandfather_alive_for_caste_certificate_1").prop("checked", true);
            } else {
                $("#grandfather_alive_for_caste_certificate_2").prop("checked", true);
            }

            if (formData.spouse_alive == VALUE_ONE) {
                $("#spouse_alive_for_caste_certificate_1").prop("checked", true);
            } else {
                $("#spouse_alive_for_caste_certificate_2").prop("checked", true);
            }

        } else {
            $("#father_alive_for_caste_certificate_1").prop("checked", true);
            $("#mother_alive_for_caste_certificate_1").prop("checked", true);
            $("#grandfather_alive_for_caste_certificate_1").prop("checked", true);
            $("#spouse_alive_for_caste_certificate_1").prop("checked", true);
        }

        datePickerMin('applicant_dob_for_cc');
        datePickerToday('applied_date_for_caste_certificate');
        datePickerToday('applied_date_of_hold_certy_for_caste_certificate');
        generateSelect2();
        datePicker();
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_cc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
            if (formData.applied_date != '0000-00-00') {
                $('#applied_date_for_caste_certificate').val(dateTo_DD_MM_YYYY(formData.applied_date));
            }
            if (formData.applied_date_of_hold_certy != '0000-00-00') {
                $('#applied_date_of_hold_certy_for_caste_certificate').val(dateTo_DD_MM_YYYY(formData.applied_date_of_hold_certy));
            }
        }

    },

    editOrViewCasteCertificate: function (btnObj, casteCertificateId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!casteCertificateId) {
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
            url: 'caste_certificate/get_caste_certificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'caste_certificate_id': casteCertificateId, 'is_edit_view': isEditOrView}, getTokenData()),
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
                    var casteCertificateData = parseData.caste_certificate_data;

                    if (casteCertificateData.constitution_artical == VALUE_ONE)
                        that.typeMajorCasteCertificateForm(isEdit, parseData);
                    else if (casteCertificateData.constitution_artical == VALUE_TWO)
                        that.typeMinorCasteCertificateForm(isEdit, parseData);
                } else {
                    var casteCertificateData = parseData.caste_certificate_data;
                    that.viewCasteCertificateForm(VALUE_ONE, casteCertificateData, isPrint);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', CASTE_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", CASTE_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'CasteCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },

    viewCasteCertificateForm: function (moduleType, casteCertificateData, isPrint) {
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
            CasteCertificate.router.navigate('view_caste_certificate_form');
            casteCertificateData.title = 'View';
        } else {
            casteCertificateData.show_submit_btn = true;
        }
        casteCertificateData.VALUE_THREE = VALUE_THREE;
        casteCertificateData.is_checked = isChecked;
        casteCertificateData.VALUE_ONE = VALUE_ONE;
        casteCertificateData.VALUE_TWO = VALUE_TWO;
        casteCertificateData.VALUE_THREE = VALUE_THREE;
        casteCertificateData.VALUE_FOUR = VALUE_FOUR;
        casteCertificateData.VALUE_FIVE = VALUE_FIVE;
        casteCertificateData.VALUE_SIX = VALUE_SIX;
        casteCertificateData.VALUE_SEVEN = VALUE_SEVEN;
        casteCertificateData.IS_CHECKED_YES = IS_CHECKED_YES;
        casteCertificateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        casteCertificateData.CASTE_CERTIFICATE_DOC_PATH = CASTE_CERTIFICATE_DOC_PATH;
        casteCertificateData.declaration_date_text = dateTo_DD_MM_YYYY(casteCertificateData.declaration_date);

        var fatherDetails = casteCertificateData.father_details != '' ? JSON.parse(casteCertificateData.father_details) : {};
        var motherDetails = casteCertificateData.mother_details != '' ? JSON.parse(casteCertificateData.mother_details) : {};
        var spouseDetails = casteCertificateData.spouse_details != '' ? JSON.parse(casteCertificateData.spouse_details) : {};
        var grandfatherDetails = casteCertificateData.grandfather_details != '' ? JSON.parse(casteCertificateData.grandfather_details) : {};

        var application_type = casteCertificateData.constitution_artical ? casteCertificateData.constitution_artical : '';

        if (application_type == VALUE_ONE) {
            casteCertificateData.application_type_text = 'Major';
            casteCertificateData.application_type_title = ' Applicant Name';
            casteCertificateData.show_marital_status = true;
            casteCertificateData.show_applicant_name = true;
            casteCertificateData.show_election = true;
            casteCertificateData.show_profession = true;
        } else if (application_type == VALUE_TWO) {
            casteCertificateData.application_type_text = 'Minor';
            casteCertificateData.application_type_title = ' Guardian Name';
            casteCertificateData.show_minor_child_name = true;
        }
        if (casteCertificateData.father_alive == VALUE_ONE) {
            casteCertificateData.show_father_alive = true;
        }
        if (casteCertificateData.mother_alive == VALUE_ONE) {
            casteCertificateData.show_mother_alive = true;
        }
        if (casteCertificateData.grandfather_alive == VALUE_ONE) {
            casteCertificateData.show_grandfather_alive = true;
        }



        casteCertificateData.district_text = talukaArray[casteCertificateData.district] ? talukaArray[casteCertificateData.district] : '';
        var district = casteCertificateData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        casteCertificateData.village_name_text = villageData[casteCertificateData.village_name] ? villageData[casteCertificateData.village_name] : '';

        casteCertificateData.com_addr_house_name = casteCertificateData.com_addr_house_name == '' ? '' : casteCertificateData.com_addr_house_name + ',';
        casteCertificateData.per_addr_house_name = casteCertificateData.per_addr_house_name == '' ? '' : casteCertificateData.per_addr_house_name + ',';

        casteCertificateData.gender_text = genderArray[casteCertificateData.gender] ? genderArray[casteCertificateData.gender] : '';
        casteCertificateData.applicant_dob_text = casteCertificateData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(casteCertificateData.applicant_dob) : '';
        casteCertificateData.occupation_text = applicantOccupationArray[casteCertificateData.occupation] ? (casteCertificateData.occupation == VALUE_TWELVE ? casteCertificateData.other_occupation : applicantOccupationArray[casteCertificateData.occupation]) : '';
        casteCertificateData.marital_status_text = maritalStatusArray[casteCertificateData.marital_status] ? maritalStatusArray[casteCertificateData.marital_status] : '';
        casteCertificateData.applicant_caste_text = casteArray[casteCertificateData.applicant_caste] ? casteArray[casteCertificateData.applicant_caste] : '';
        casteCertificateData.applied_date_text = casteCertificateData.applied_date != '0000-00-00' ? dateTo_DD_MM_YYYY(casteCertificateData.applied_date) : '';
        casteCertificateData.applied_date_of_hold_certy_text = casteCertificateData.applied_date_of_hold_certy != '0000-00-00' ? dateTo_DD_MM_YYYY(casteCertificateData.applied_date_of_hold_certy) : '';

        casteCertificateData.nearest_police_station_text = applicantPolicestationArray[casteCertificateData.nearest_police_station] ? applicantPolicestationArray[casteCertificateData.nearest_police_station] : '';
        casteCertificateData.relationship_of_applicant_text = relationDeceasedPersonArray[casteCertificateData.relationship_of_applicant] ? relationDeceasedPersonArray[casteCertificateData.relationship_of_applicant] : '';
        casteCertificateData.submitted_datetime_text = casteCertificateData.submitted_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY(casteCertificateData.submitted_datetime) : dateTo_DD_MM_YYYY(casteCertificateData.created_time);
        if (application_type == VALUE_ONE) {
            casteCertificateData.applicant_education = educationTypeArray[casteCertificateData.applicant_education] ? educationTypeArray[casteCertificateData.applicant_education] : ' ';
        }
        if (application_type == VALUE_TWO) {
            casteCertificateData.applicant_education = casteCertificateData.applicant_education ? casteCertificateData.applicant_education : ' ';
        }
        casteCertificateData.ldc_name = (casteCertificateData.ldc_name == null || casteCertificateData.ldc_name == '') ? casteCertificateData.ldc_name_m : casteCertificateData.ldc_name;
        casteCertificateData.father_name = fatherDetails.father_name ? fatherDetails.father_name : '';
        casteCertificateData.father_nationality = fatherDetails.father_nationality ? fatherDetails.father_nationality : '';
        casteCertificateData.father_election_no = fatherDetails.father_election_no ? fatherDetails.father_election_no : '';
        casteCertificateData.father_aadhaar = fatherDetails.father_aadhaar ? fatherDetails.father_aadhaar : '';
        casteCertificateData.father_occupation_text = applicantOccupationArray[fatherDetails.father_occupation] ? (fatherDetails.father_occupation == VALUE_TWELVE ? fatherDetails.father_other_occupation : applicantOccupationArray[fatherDetails.father_occupation]) : '';
        casteCertificateData.father_born_place_state_text = fatherDetails.father_born_place_state_text ? fatherDetails.father_born_place_state_text : '';
        casteCertificateData.father_born_place_district_text = fatherDetails.father_born_place_district_text ? fatherDetails.father_born_place_district_text : '';
        casteCertificateData.father_born_place_village_text = fatherDetails.father_born_place_village_text ? fatherDetails.father_born_place_village_text : '';
        casteCertificateData.father_native_place_district_text = fatherDetails.father_native_place_district_text ? fatherDetails.father_native_place_district_text : '';
        casteCertificateData.father_native_place_city_text = fatherDetails.father_native_place_city_text ? fatherDetails.father_native_place_city_text : '';
        casteCertificateData.father_native_place_village_text = fatherDetails.father_native_place_village_text ? fatherDetails.father_native_place_village_text : '';

        casteCertificateData.father_religion_text = fatherDetails.father_religion;
        casteCertificateData.father_caste_text = casteArray[fatherDetails.father_caste] ? casteArray[fatherDetails.father_caste] : '';

        casteCertificateData.mother_name = motherDetails.mother_name ? motherDetails.mother_name : '';
        casteCertificateData.mother_nationality = motherDetails.mother_nationality ? motherDetails.mother_nationality : '';
        casteCertificateData.mother_election_no = motherDetails.mother_election_no ? motherDetails.mother_election_no : '';
        casteCertificateData.mother_aadhaar = motherDetails.mother_aadhaar ? motherDetails.mother_aadhaar : '';
        casteCertificateData.mother_occupation_text = applicantOccupationArray[motherDetails.mother_occupation] ? (motherDetails.mother_occupation == VALUE_TWELVE ? motherDetails.mother_other_occupation : applicantOccupationArray[motherDetails.mother_occupation]) : '';

        casteCertificateData.mother_born_place_state_text = motherDetails.mother_born_place_state_text ? motherDetails.mother_born_place_state_text : '';
        casteCertificateData.mother_born_place_district_text = motherDetails.mother_born_place_district_text ? motherDetails.mother_born_place_district_text : '';
        casteCertificateData.mother_born_place_village_text = motherDetails.mother_born_place_village_text ? motherDetails.mother_born_place_village_text : '';
        casteCertificateData.mother_native_place_state_text = motherDetails.mother_native_place_state_text ? motherDetails.mother_native_place_state_text : '';
        casteCertificateData.mother_native_place_district_text = motherDetails.mother_native_place_district_text ? motherDetails.mother_native_place_district_text : '';
        casteCertificateData.mother_native_place_village_text = motherDetails.mother_native_place_village_text ? motherDetails.mother_native_place_village_text : '';

        casteCertificateData.mother_religion_text = motherDetails.mother_religion;
        casteCertificateData.mother_caste_text = casteArray[motherDetails.mother_caste] ? casteArray[motherDetails.mother_caste] : '';

        casteCertificateData.grandfather_name = grandfatherDetails.grandfather_name ? grandfatherDetails.grandfather_name : '';
        casteCertificateData.grandfather_nationality = grandfatherDetails.grandfather_nationality ? grandfatherDetails.grandfather_nationality : '';
        casteCertificateData.grandfather_election_no = grandfatherDetails.grandfather_election_no ? grandfatherDetails.grandfather_election_no : '';
        casteCertificateData.grandfather_aadhaar = grandfatherDetails.grandfather_aadhaar ? grandfatherDetails.grandfather_aadhaar : '';
        casteCertificateData.grandfather_occupation_text = applicantOccupationArray[grandfatherDetails.grandfather_occupation] ? (grandfatherDetails.grandfather_occupation == VALUE_TWELVE ? grandfatherDetails.grandfather_other_occupation : applicantOccupationArray[grandfatherDetails.grandfather_occupation]) : '';

        casteCertificateData.grandfather_born_place_state_text = grandfatherDetails.grandfather_born_place_state_text ? grandfatherDetails.grandfather_born_place_state_text : '';
        casteCertificateData.grandfather_born_place_district_text = grandfatherDetails.grandfather_born_place_district_text ? grandfatherDetails.grandfather_born_place_district_text : '';
        casteCertificateData.grandfather_born_place_village_text = grandfatherDetails.grandfather_born_place_village_text ? grandfatherDetails.grandfather_born_place_village_text : '';
        //casteCertificateData.grandfather_native_place_state_text = grandfatherDetails.grandfather_native_place_state_text ? grandfatherDetails.grandfather_native_place_state_text : '';
        casteCertificateData.grandfather_native_place_district_text = grandfatherDetails.grandfather_native_place_district_text ? grandfatherDetails.grandfather_native_place_district_text : '';
        casteCertificateData.grandfather_native_place_city_text = grandfatherDetails.grandfather_native_place_city_text ? grandfatherDetails.grandfather_native_place_city_text : '';
        casteCertificateData.grandfather_native_place_village_text = grandfatherDetails.grandfather_native_place_village_text ? grandfatherDetails.grandfather_native_place_village_text : '';

        casteCertificateData.grandfather_religion_text = grandfatherDetails.grandfather_religion;
        casteCertificateData.grandfather_caste_text = casteArray[grandfatherDetails.grandfather_caste] ? casteArray[grandfatherDetails.grandfather_caste] : '';

        if (casteCertificateData.marital_status == VALUE_ONE) {
            casteCertificateData.show_spouse = true;
            casteCertificateData.spouse_name = spouseDetails.spouse_name ? spouseDetails.spouse_name : '';
            casteCertificateData.spouse_nationality = spouseDetails.spouse_nationality ? spouseDetails.spouse_nationality : '';
            casteCertificateData.spouse_election_no = spouseDetails.spouse_election_no ? spouseDetails.spouse_election_no : '';
            casteCertificateData.spouse_aadhaar = spouseDetails.spouse_aadhaar ? spouseDetails.spouse_aadhaar : '';
            casteCertificateData.spouse_occupation_text = applicantOccupationArray[spouseDetails.spouse_occupation] ? (spouseDetails.spouse_occupation == VALUE_TWELVE ? spouseDetails.spouse_other_occupation : applicantOccupationArray[spouseDetails.spouse_occupation]) : '';

            casteCertificateData.spouse_born_place_state_text = spouseDetails.spouse_born_place_state_text ? spouseDetails.spouse_born_place_state_text : '';
            casteCertificateData.spouse_born_place_district_text = spouseDetails.spouse_born_place_district_text ? spouseDetails.spouse_born_place_district_text : '';
            casteCertificateData.spouse_born_place_village_text = spouseDetails.spouse_born_place_village_text ? spouseDetails.spouse_born_place_village_text : '';
            casteCertificateData.spouse_native_place_state_text = spouseDetails.spouse_native_place_state_text ? spouseDetails.spouse_native_place_state_text : '';
            casteCertificateData.spouse_native_place_district_text = spouseDetails.spouse_native_place_district_text ? spouseDetails.spouse_native_place_district_text : '';
            casteCertificateData.spouse_native_place_village_text = spouseDetails.spouse_native_place_village_text ? spouseDetails.spouse_native_place_village_text : '';

            casteCertificateData.spouse_religion_text = spouseDetails.spouse_religion;
            casteCertificateData.spouse_caste_text = casteArray[spouseDetails.spouse_caste] ? casteArray[spouseDetails.spouse_caste] : '';


            if (spouseDetails.spouse_caste == VALUE_ONE || spouseDetails.spouse_caste == VALUE_TWO) {
                if (spouseDetails.spouse_sc_subcaste != '')
                    casteCertificateData.spouse_subcaste_text = applicantScSubcasteArray[spouseDetails.spouse_sc_subcaste] ? applicantScSubcasteArray[spouseDetails.spouse_sc_subcaste] : '';
                else
                    casteCertificateData.spouse_subcaste_text = applicantStSubcasteArray[spouseDetails.spouse_st_subcaste] ? applicantStSubcasteArray[spouseDetails.spouse_st_subcaste] : '';
            }
        }

//        if (casteCertificateData.native_place_state == VALUE_ONE)
        casteCertificateData.native_place_state_text = casteCertificateData.native_place_state_text;

//        if (casteCertificateData.native_place_district == VALUE_ONE)
        casteCertificateData.native_place_district_text = casteCertificateData.native_place_district_text;

//        if (fatherDetails.father_native_place_district == VALUE_ONE)
//        casteCertificateData.father_native_place_district_text = fatherDetails.father_native_place_district_text;

//        if (grandfatherDetails.grandfather_native_place_district == VALUE_ONE)
        //casteCertificateData.father_native_place_district_text = fatherDetails.father_native_place_district_text;
        casteCertificateData.grandfather_native_place_district_text = grandfatherDetails.grandfather_native_place_district_text;

        casteCertificateData.com_addr_city = casteCertificateData.com_addr_city;
        casteCertificateData.grandfather_city_text = grandfatherDetails.grandfather_native_place_city_text;
        casteCertificateData.father_city_text = fatherDetails.father_native_place_city_text;
        casteCertificateData.per_addr_city = casteCertificateData.per_addr_city;

        if (casteCertificateData.applicant_caste == VALUE_ONE || casteCertificateData.applicant_caste == VALUE_TWO) {
            if (casteCertificateData.apllicant_sc_subcaste != '')
                casteCertificateData.apllicant_subcaste_text = applicantScSubcasteArray[casteCertificateData.apllicant_sc_subcaste] ? applicantScSubcasteArray[casteCertificateData.apllicant_sc_subcaste] : '';
            else
                casteCertificateData.apllicant_subcaste_text = applicantStSubcasteArray[casteCertificateData.apllicant_st_subcaste] ? applicantStSubcasteArray[casteCertificateData.apllicant_st_subcaste] : '';
        }

        if (fatherDetails.father_caste == VALUE_ONE || fatherDetails.father_caste == VALUE_TWO) {
            if (fatherDetails.father_sc_subcaste != '')
                casteCertificateData.father_subcaste_text = applicantScSubcasteArray[fatherDetails.father_sc_subcaste] ? applicantScSubcasteArray[fatherDetails.father_sc_subcaste] : '';
            else
                casteCertificateData.father_subcaste_text = applicantStSubcasteArray[fatherDetails.father_st_subcaste] ? applicantStSubcasteArray[fatherDetails.father_st_subcaste] : '';
        }

        if (motherDetails.mother_caste == VALUE_ONE || motherDetails.mother_caste == VALUE_TWO) {
            if (motherDetails.mother_sc_subcaste != '')
                casteCertificateData.mother_subcaste_text = applicantScSubcasteArray[motherDetails.mother_sc_subcaste] ? applicantScSubcasteArray[motherDetails.mother_sc_subcaste] : '';
            else
                casteCertificateData.mother_subcaste_text = applicantStSubcasteArray[motherDetails.mother_st_subcaste] ? applicantStSubcasteArray[motherDetails.mother_st_subcaste] : '';
        }

        if (grandfatherDetails.grandfather_caste == VALUE_ONE || grandfatherDetails.grandfather_caste == VALUE_TWO) {
            if (grandfatherDetails.grandfather_sc_subcaste != '')
                casteCertificateData.grandfather_subcaste_text = applicantScSubcasteArray[grandfatherDetails.grandfather_sc_subcaste] ? applicantScSubcasteArray[grandfatherDetails.grandfather_sc_subcaste] : '';
            else
                casteCertificateData.grandfather_subcaste_text = applicantStSubcasteArray[grandfatherDetails.grandfather_st_subcaste] ? applicantStSubcasteArray[grandfatherDetails.grandfather_st_subcaste] : '';
        }


        var district = casteCertificateData.district;
        var nativevillageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        casteCertificateData.native_place_village_text = nativevillageData[casteCertificateData.native_place_village] ? nativevillageData[casteCertificateData.native_place_village] : '';

        var district = casteCertificateData.district;
        var fathervillageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        //casteCertificateData.father_native_place_village_text = fathervillageData[fatherDetails.father_native_place_village] ? fathervillageData[fatherDetails.father_native_place_village] : '';


        var district = casteCertificateData.district;
        var grandfathervillageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        casteCertificateData.grandfather_native_place_village_text = grandfathervillageData[grandfatherDetails.grandfather_native_place_village] ? grandfathervillageData[grandfatherDetails.grandfather_native_place_village] : '';



        var val = casteCertificateData.constitution_artical;

        //-------------------------------------------------

        casteCertificateData.show_applicant_photo_doc = casteCertificateData.applicant_photo_doc != '' ? true : false;
        casteCertificateData.show_minor_child_photo_doc = casteCertificateData.minor_child_photo_doc != '' ? true : false;
        casteCertificateData.show_self_birth_certificate_doc = casteCertificateData.self_birth_certificate_doc != '' ? true : false;
        casteCertificateData.show_father_certificate_doc = casteCertificateData.father_certificate_doc != '' ? true : false;
        casteCertificateData.show_grandfather_birth_certificate_doc = casteCertificateData.grandfather_birth_certificate_doc != '' ? true : false;
        casteCertificateData.show_grandfather_property_doc = casteCertificateData.grandfather_property_doc != '' ? true : false;
        casteCertificateData.show_leaving_certificate_doc = casteCertificateData.leaving_certificate_doc != '' ? true : false;
        casteCertificateData.show_election_card_doc = casteCertificateData.election_card_doc != '' ? true : false;
        casteCertificateData.show_aadhar_card_doc = casteCertificateData.aadhar_card_doc != '' ? true : false;
        casteCertificateData.show_father_election_card_doc = casteCertificateData.father_election_card_doc != '' ? true : false;
        casteCertificateData.show_father_aadhar_card_doc = casteCertificateData.father_aadhar_card_doc != '' ? true : false;
        casteCertificateData.show_mother_election_card_doc = casteCertificateData.mother_election_card_doc != '' ? true : false;
        casteCertificateData.show_mother_aadhar_card_doc = casteCertificateData.mother_aadhar_card_doc != '' ? true : false;
        casteCertificateData.show_parents_aadhar_card_doc = casteCertificateData.parents_aadhar_card_doc != '' ? true : false;
        casteCertificateData.show_community_certificate_doc = casteCertificateData.community_certificate_doc != '' ? true : false;
        casteCertificateData.show_father_community_certificate_doc = casteCertificateData.father_community_certificate_doc != '' ? true : false;
        casteCertificateData.show_declaration_btn = moduleType == VALUE_ONE ? true : (casteCertificateData.declaration == VALUE_ONE ? true : false);



        if (casteCertificateData.constitution_artical == VALUE_ONE) {
            casteCertificateData.show_applicant_data = true;
        }

        if (casteCertificateData.constitution_artical == VALUE_TWO) {
            casteCertificateData.show_gaudian_data = true;
        }
        if (casteCertificateData.status != VALUE_ZERO && casteCertificateData.status != VALUE_ONE) {
            casteCertificateData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(casteCertificateViewTemplate(casteCertificateData));
        if (casteCertificateData.declaration == VALUE_ONE) {
            $('#declaration_for_caste_certificate').click();
        }

        if (casteCertificateData.applicant_dob != '0000-00-00') {
            $('#applicant_dob_for_caste_certificate').val(dateTo_DD_MM_YYYY(casteCertificateData.applicant_dob));
        }
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_ccview').click();
            }, 500);
        }
    },

    checkValidationForCasteCertificate: function (casteCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!casteCertificateData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!casteCertificateData.village_name) {
            return getBasicMessageAndFieldJSONArray('village_name_for_cc', villageNameValidationMessage);
        }
        if (!casteCertificateData.applicant_name) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_cc', applicantNameValidationMessage);
        }
        if (casteCertificateData.constitution_artical == VALUE_TWO) {
            if (!casteCertificateData.relationship_of_applicant) {
                return getBasicMessageAndFieldJSONArray('relationship_of_applicant_for_cc', relationshipofApplicantValidationMessage);
            }
            if (!casteCertificateData.guardian_address) {
                return getBasicMessageAndFieldJSONArray('guardian_address_for_cc', guardianAddressValidationMessage);
            }
            if (!casteCertificateData.guardian_mobile_no) {
                return getBasicMessageAndFieldJSONArray('guardian_mobile_no_for_cc', mobileValidationMessage);
            }
            if (!casteCertificateData.guardian_aadhaar) {
                return getBasicMessageAndFieldJSONArray('guardian_aadhaar_for_cc', invalidAadharNumberValidationMessage);
            }
            if (!casteCertificateData.minor_child_name) {
                return getBasicMessageAndFieldJSONArray('minor_child_name_for_cc', minorChildNameValidationMessage);
            }
        }
        if (!casteCertificateData.com_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('com_addr_house_no_for_cc', houseNoValidationMessage);
        }
        if (!casteCertificateData.com_addr_street) {
            return getBasicMessageAndFieldJSONArray('com_addr_street_for_cc', streetValidationMessage);
        }
        if (!casteCertificateData.com_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('com_addr_village_dmc_ward_for_cc', villageNameValidationMessage);
        }
        if (!casteCertificateData.com_addr_city) {
            return getBasicMessageAndFieldJSONArray('com_addr_city_for_cc', selectCityValidationMessage);
        }

        if (!casteCertificateData.com_pincode) {
            return getBasicMessageAndFieldJSONArray('com_pincode_for_cc', pincodeValidationMessage);
        }
        if (!casteCertificateData.per_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('per_addr_house_no_for_cc', houseNoValidationMessage);
        }
        if (!casteCertificateData.per_addr_street) {
            return getBasicMessageAndFieldJSONArray('per_addr_street_for_cc', streetValidationMessage);
        }
        if (!casteCertificateData.per_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('per_addr_village_dmc_ward_for_cc', villageNameValidationMessage);
        }
        if (!casteCertificateData.per_addr_city) {
            return getBasicMessageAndFieldJSONArray('per_addr_city_for_cc', selectCityValidationMessage);
        }
        if (!casteCertificateData.per_pincode) {
            return getBasicMessageAndFieldJSONArray('per_pincode_for_cc', pincodeValidationMessage);
        }

        if (casteCertificateData.constitution_artical == VALUE_ONE) {
            if (!casteCertificateData.mobile_number) {
                return getBasicMessageAndFieldJSONArray('mobile_number_for_cc', mobileValidationMessage);
            }
        }
        if (!casteCertificateData.applicant_dob) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_cc', birthDateValidationMessage);
        }
        if (!casteCertificateData.applicant_age) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_cc', applicantAgeValidationMessage);
        }
        if (!casteCertificateData.born_place_state) {
            return getBasicMessageAndFieldJSONArray('born_place_state_for_cc', selectStateValidationMessage);
        }
        if (!casteCertificateData.born_place_district) {
            return getBasicMessageAndFieldJSONArray('born_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!casteCertificateData.born_place_village) {
            return getBasicMessageAndFieldJSONArray('born_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!casteCertificateData.born_place_pincode) {
            return getBasicMessageAndFieldJSONArray('born_place_pincode_for_cc', pincodeValidationMessage);
        }
        if (!casteCertificateData.native_place_state) {
            return getBasicMessageAndFieldJSONArray('native_place_state_for_cc', selectStateValidationMessage);
        }
        if (!casteCertificateData.native_place_district) {
            return getBasicMessageAndFieldJSONArray('native_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!casteCertificateData.native_place_village) {
            return getBasicMessageAndFieldJSONArray('native_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!casteCertificateData.native_place_pincode) {
            return getBasicMessageAndFieldJSONArray('native_place_pincode_for_cc', pincodeValidationMessage);
        }


        if (!casteCertificateData.gender_for_cc) {
            $('#gender_for_cc_1').focus();
            return getBasicMessageAndFieldJSONArray('gender_for_cc', genderValidationMessage);
        }

        if (casteCertificateData.constitution_artical == VALUE_ONE) {
            if (!casteCertificateData.marital_status_for_cc) {
                $('#marital_status_for_cc_1').focus();
                return getBasicMessageAndFieldJSONArray('marital_status_for_cc', maritalStatusValidationMessage);
            }
        }
        if (!casteCertificateData.applicant_caste_for_caste_certificate) {
            $('#applicant_caste_for_caste_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('applicant_caste_for_caste_certificate', castesValidationMessage);
        }
        if (casteCertificateData.applicant_caste_for_caste_certificate == VALUE_ONE) {
            if (!casteCertificateData.applicant_religion_for_cc) {
                return getBasicMessageAndFieldJSONArray('applicant_religion_for_cc', religionValidationMessage);
            }
            if (!casteCertificateData.apllicant_sc_subcaste) {
                return getBasicMessageAndFieldJSONArray('apllicant_sc_subcaste_for_cc', subcasteValidationMessage);
            }
        }
        if (casteCertificateData.applicant_caste_for_caste_certificate == VALUE_TWO) {
            if (!casteCertificateData.apllicant_st_subcaste) {
                return getBasicMessageAndFieldJSONArray('apllicant_st_subcaste_for_cc', subcasteValidationMessage);
            }
        }


        if (!casteCertificateData.applicant_nationality) {
            return getBasicMessageAndFieldJSONArray('applicant_nationality_for_cc', applicantNationalityValidationMessage);
        }
        if (!casteCertificateData.nearest_police_station) {
            return getBasicMessageAndFieldJSONArray('nearest_police_station_for_cc', nearestPoliceStationValidationMessage);
        }
        if (!casteCertificateData.applicant_education) {
            return getBasicMessageAndFieldJSONArray('applicant_education_for_cc', applicantEducationValidationMessage);
        }

        if (casteCertificateData.constitution_artical == VALUE_ONE) {
            if (!casteCertificateData.name_of_school) {
                return getBasicMessageAndFieldJSONArray('name_of_school_for_cc', schoolNameValidationMessage);
            }
            if (!casteCertificateData.occupation) {
                return getBasicMessageAndFieldJSONArray('occupation_for_cc', occupationValidationMessage);
            }
        }

        if (casteCertificateData.occupation == VALUE_TWELVE) {
            if (!casteCertificateData.other_occupation) {
                return getBasicMessageAndFieldJSONArray('other_occupation_for_cc', otherOccupationValidationMessage);
            }
        }
        if (!casteCertificateData.father_name) {
            return getBasicMessageAndFieldJSONArray('father_name_for_cc', fatherNameValidationMessage);
        }

        if (!casteCertificateData.father_born_place_state) {
            return getBasicMessageAndFieldJSONArray('father_born_place_state_for_cc', selectStateValidationMessage);
        }
        if (!casteCertificateData.father_born_place_district) {
            return getBasicMessageAndFieldJSONArray('father_born_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!casteCertificateData.father_born_place_village) {
            return getBasicMessageAndFieldJSONArray('father_born_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!casteCertificateData.father_native_place_district) {
            return getBasicMessageAndFieldJSONArray('father_native_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!casteCertificateData.father_city) {
            return getBasicMessageAndFieldJSONArray('father_city_for_cc', selectCityValidationMessage);
        }
        if (!casteCertificateData.father_native_place_village) {
            return getBasicMessageAndFieldJSONArray('father_native_place_village_for_cc', selectVillageValidationMessage);
        }

        if (!casteCertificateData.father_nationality) {
            return getBasicMessageAndFieldJSONArray('father_nationality_for_cc', nationalityValidationMessage);
        }
        if (!casteCertificateData.father_religion_for_cc) {
            return getBasicMessageAndFieldJSONArray('father_religion_for_cc', religionValidationMessage);
        }
        if (!casteCertificateData.father_caste_for_caste_certificate) {
            $('#father_caste_for_caste_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('father_caste_for_caste_certificate', castesValidationMessage);
        }
        if (casteCertificateData.father_caste_for_caste_certificate == VALUE_ONE) {
            if (!casteCertificateData.father_sc_subcaste) {
                return getBasicMessageAndFieldJSONArray('father_sc_subcaste_for_cc', subcasteValidationMessage);
            }
        }
        if (casteCertificateData.father_caste_for_caste_certificate == VALUE_TWO) {
            if (!casteCertificateData.father_st_subcaste) {
                return getBasicMessageAndFieldJSONArray('father_st_subcaste_for_cc', subcasteValidationMessage);
            }
        }

        if (casteCertificateData.father_alive_for_caste_certificate == VALUE_ONE) {
            $('#father_alive_for_caste_certificate_1').focus();
            if (!casteCertificateData.father_occupation) {
                return getBasicMessageAndFieldJSONArray('father_occupation_for_cc', occupationValidationMessage);
            }
            if (casteCertificateData.father_occupation == VALUE_TWELVE) {
                if (!casteCertificateData.father_other_occupation) {
                    return getBasicMessageAndFieldJSONArray('father_other_occupation_for_cc', otherOccupationValidationMessage);
                }
            }
        }


        if (!casteCertificateData.mother_name) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_cc', motherNameValidationMessage);
        }


        if (!casteCertificateData.mother_born_place_state) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_state_for_cc', selectStateValidationMessage);
        }
        if (!casteCertificateData.mother_born_place_district) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!casteCertificateData.mother_born_place_village) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!casteCertificateData.mother_native_place_state) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_state_for_cc', selectStateValidationMessage);
        }
        if (!casteCertificateData.mother_native_place_district) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!casteCertificateData.mother_native_place_village) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!casteCertificateData.mother_nationality) {
            return getBasicMessageAndFieldJSONArray('mother_nationality_for_cc', nationalityValidationMessage);
        }
        if (!casteCertificateData.mother_religion_for_cc) {
            return getBasicMessageAndFieldJSONArray('mother_religion_for_cc', religionValidationMessage);
        }
        if (!casteCertificateData.mother_caste_for_caste_certificate) {
            $('#mother_caste_for_caste_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('mother_caste_for_caste_certificate', castesValidationMessage);
        }
        if (casteCertificateData.mother_caste_for_caste_certificate == VALUE_ONE) {
            if (!casteCertificateData.mother_sc_subcaste) {
                return getBasicMessageAndFieldJSONArray('mother_sc_subcaste_for_cc', subcasteValidationMessage);
            }
        }
        if (casteCertificateData.mother_caste_for_caste_certificate == VALUE_TWO) {
            if (!casteCertificateData.mother_st_subcaste) {
                return getBasicMessageAndFieldJSONArray('mother_st_subcaste_for_cc', subcasteValidationMessage);
            }
        }

        if (casteCertificateData.mother_alive_for_caste_certificate == VALUE_ONE) {
            $('#mother_alive_for_caste_certificate_1').focus();
            if (!casteCertificateData.mother_occupation) {
                return getBasicMessageAndFieldJSONArray('mother_occupation_for_cc', occupationValidationMessage);
            }
            if (casteCertificateData.mother_occupation == VALUE_TWELVE) {
                if (!casteCertificateData.mother_other_occupation) {
                    return getBasicMessageAndFieldJSONArray('mother_other_occupation_for_cc', otherOccupationValidationMessage);
                }
            }
        }

        if (!casteCertificateData.grandfather_name) {
            return getBasicMessageAndFieldJSONArray('grandfather_name_for_cc', grandfatherValidationMessage);
        }

        if (!casteCertificateData.grandfather_born_place_state) {
            return getBasicMessageAndFieldJSONArray('grandfather_born_place_state_for_cc', selectStateValidationMessage);
        }
        if (!casteCertificateData.grandfather_born_place_district) {
            return getBasicMessageAndFieldJSONArray('grandfather_born_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!casteCertificateData.grandfather_born_place_village) {
            return getBasicMessageAndFieldJSONArray('grandfather_born_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!casteCertificateData.grandfather_native_place_district) {
            return getBasicMessageAndFieldJSONArray('grandfather_native_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!casteCertificateData.grandfather_city) {
            return getBasicMessageAndFieldJSONArray('grandfather_city_for_cc', selectCityValidationMessage);
        }
        if (!casteCertificateData.grandfather_native_place_village) {
            return getBasicMessageAndFieldJSONArray('grandfather_native_place_village_for_cc', selectVillageValidationMessage);
        }

        if (!casteCertificateData.grandfather_nationality) {
            return getBasicMessageAndFieldJSONArray('grandfather_nationality_for_cc', nationalityValidationMessage);
        }
        if (!casteCertificateData.grandfather_religion_for_cc) {
            return getBasicMessageAndFieldJSONArray('grandfather_religion_for_cc', religionValidationMessage);
        }
        if (!casteCertificateData.grandfather_caste_for_caste_certificate) {
            $('#grandfather_caste_for_caste_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('grandfather_caste_for_caste_certificate', castesValidationMessage);
        }
        if (casteCertificateData.grandfather_caste_for_caste_certificate == VALUE_ONE) {
            if (!casteCertificateData.grandfather_sc_subcaste) {
                return getBasicMessageAndFieldJSONArray('grandfather_sc_subcaste_for_cc', subcasteValidationMessage);
            }
        }
        if (casteCertificateData.grandfather_caste_for_caste_certificate == VALUE_TWO) {
            if (!casteCertificateData.grandfather_st_subcaste) {
                return getBasicMessageAndFieldJSONArray('grandfather_st_subcaste_for_cc', subcasteValidationMessage);
            }
        }

        if (casteCertificateData.grandfather_alive_for_caste_certificate == VALUE_ONE) {
            $('#grandfather_alive_for_caste_certificate_1').focus();
            if (!casteCertificateData.grandfather_occupation) {
                return getBasicMessageAndFieldJSONArray('grandfather_occupation_for_cc', occupationValidationMessage);
            }
            if (casteCertificateData.grandfather_occupation == VALUE_TWELVE) {
                if (!casteCertificateData.grandfather_other_occupation) {
                    return getBasicMessageAndFieldJSONArray('grandfather_other_occupation_for_cc', otherOccupationValidationMessage);
                }
            }
        }

        if (casteCertificateData.marital_status_for_cc == VALUE_ONE) {
            if (!casteCertificateData.spouse_name) {
                return getBasicMessageAndFieldJSONArray('spouse_name_for_cc', spouseNameValidationMessage);
            }

            if (!casteCertificateData.spouse_born_place_state) {
                return getBasicMessageAndFieldJSONArray('spouse_born_place_state_for_cc', selectStateValidationMessage);
            }
            if (!casteCertificateData.spouse_born_place_district) {
                return getBasicMessageAndFieldJSONArray('spouse_born_place_district_for_cc', selectDistrictValidationMessage);
            }
            if (!casteCertificateData.spouse_born_place_village) {
                return getBasicMessageAndFieldJSONArray('spouse_born_place_village_for_cc', selectVillageValidationMessage);
            }
            if (!casteCertificateData.spouse_native_place_state) {
                return getBasicMessageAndFieldJSONArray('spouse_native_place_state_for_cc', selectStateValidationMessage);
            }
            if (!casteCertificateData.spouse_native_place_district) {
                return getBasicMessageAndFieldJSONArray('spouse_native_place_district_for_cc', selectDistrictValidationMessage);
            }
            if (!casteCertificateData.spouse_native_place_village) {
                return getBasicMessageAndFieldJSONArray('spouse_native_place_village_for_cc', selectVillageValidationMessage);
            }
            if (!casteCertificateData.spouse_nationality) {
                return getBasicMessageAndFieldJSONArray('spouse_nationality_for_cc', nationalityValidationMessage);
            }
            if (!casteCertificateData.spouse_religion_for_cc) {
                return getBasicMessageAndFieldJSONArray('spouse_religion_for_cc', religionValidationMessage);
            }
            if (!casteCertificateData.spouse_caste_for_caste_certificate) {
                $('#spouse_caste_for_caste_certificate_1').focus();
                return getBasicMessageAndFieldJSONArray('spouse_caste_for_caste_certificate', castesValidationMessage);
            }
            if (casteCertificateData.spouse_caste_for_caste_certificate == VALUE_ONE) {
                if (!casteCertificateData.spouse_sc_subcaste) {
                    return getBasicMessageAndFieldJSONArray('spouse_sc_subcaste_for_cc', subcasteValidationMessage);
                }
            }
            if (casteCertificateData.spouse_caste_for_caste_certificate == VALUE_TWO) {
                if (!casteCertificateData.spouse_st_subcaste) {
                    return getBasicMessageAndFieldJSONArray('spouse_st_subcaste_for_cc', subcasteValidationMessage);
                }
            }

            if (casteCertificateData.spouse_alive_for_caste_certificate == VALUE_ONE) {
                $('#spouse_alive_for_caste_certificate_1').focus();
                if (!casteCertificateData.spouse_occupation) {
                    return getBasicMessageAndFieldJSONArray('spouse_occupation_for_cc', occupationValidationMessage);
                }
                if (casteCertificateData.spouse_occupation == VALUE_TWELVE) {
                    if (!casteCertificateData.spouse_other_occupation) {
                        return getBasicMessageAndFieldJSONArray('spouse_other_occupation_for_cc', otherOccupationValidationMessage);
                    }
                }
            }


        }


        if (!casteCertificateData.im_member_of_scst_for_caste_certificate) {
            $('#im_member_of_scst_for_caste_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('im_member_of_scst_for_caste_certificate', selectanyoneValidationMessage);
        }
        if (casteCertificateData.im_member_of_scst_for_caste_certificate == VALUE_ONE) {
            if (!casteCertificateData.detail_of_membership_scst_for_caste_certificate) {
                return getBasicMessageAndFieldJSONArray('detail_of_membership_scst_for_caste_certificate', detailValidationMessage);
            }
        }
        if (!casteCertificateData.purpose_of_caste_certificate_for_cc) {
            return getBasicMessageAndFieldJSONArray('purpose_of_caste_certificate_for_cc', purposeValidationMessage);
        }
        if (!casteCertificateData.applied_for_sc_st_certy_for_caste_certificate) {
            $('#applied_for_sc_st_certy_for_caste_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('applied_for_sc_st_certy_for_caste_certificate', selectanyoneValidationMessage);
        }

        if (casteCertificateData.applied_for_sc_st_certy_item_container_for_caste_certificate == VALUE_ONE) {
            if (!casteCertificateData.applied_date_for_caste_certificate) {
                return getBasicMessageAndFieldJSONArray('applied_date_for_caste_certificate', dateslectValidationMessage);
            }
        }

        if (casteCertificateData.applied_for_sc_st_certy_item_container_for_caste_certificate == VALUE_ONE) {
            if (!casteCertificateData.year_of_applied_certy_for_caste_certificate) {
                return getBasicMessageAndFieldJSONArray('year_of_applied_certy_for_caste_certificate', numberValidationMessage);
            }
        }
        if (!casteCertificateData.fath_hus_wif_hold_sc_st_certy_for_caste_certificate) {
            $('#fath_hus_wif_hold_sc_st_certy_for_caste_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('fath_hus_wif_hold_sc_st_certy_for_caste_certificate', selectanyoneValidationMessage);
        }


        if (!casteCertificateData.if_grandfather_having_document_for_caste_certificate) {
            $('#if_grandfather_having_document_for_caste_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('if_grandfather_having_document_for_caste_certificate', selectanyoneValidationMessage);
        }



        return '';
    },
    askForSubmitCasteCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'CasteCertificate.listview.submitCasteCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitCasteCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var casteCertificateData = $('#caste_certificate_form').serializeFormJSON();
        var bornPlaceStateText = jQuery("#born_place_state_for_cc option:selected").text();
        var bornPlaceDistrictText = jQuery("#born_place_district_for_cc option:selected").text();
        var bornPlaceVillageText = jQuery("#born_place_village_for_cc option:selected").text();
        var nativePlaceStateText = jQuery("#native_place_state_for_cc option:selected").text();
        var nativePlaceDistrictText = jQuery("#native_place_district_for_cc option:selected").text();
        var nativePlaceVillageText = jQuery("#native_place_village_for_cc option:selected").text();
        var fBornPlaceStateText = jQuery("#father_born_place_state_for_cc option:selected").text();
        var fBornPlaceDistrictText = jQuery("#father_born_place_district_for_cc option:selected").text();
        var fBornPlaceVillageText = jQuery("#father_born_place_village_for_cc option:selected").text();
        var fNativePlaceDistrictText = jQuery("#father_native_place_district_for_cc option:selected").text();
        var fNativePlaceCityText = jQuery("#father_city_for_cc option:selected").text();
        var fNtivePlaceVillageText = jQuery("#father_native_place_village_for_cc option:selected").text();
        var mBornPlaceStateText = jQuery("#mother_born_place_state_for_cc option:selected").text();
        var mBornPlaceDistrictText = jQuery("#mother_born_place_district_for_cc option:selected").text();
        var mBornPlaceVillageText = jQuery("#mother_born_place_village_for_cc option:selected").text();
        var mNativePlaceStateText = jQuery("#mother_native_place_state_for_cc option:selected").text();
        var mNativePlaceDistrictText = jQuery("#mother_native_place_district_for_cc option:selected").text();
        var mNtivePlaceVillageText = jQuery("#mother_native_place_village_for_cc option:selected").text();
        var gfBornPlaceStateText = jQuery("#grandfather_born_place_state_for_cc option:selected").text();
        var gfBornPlaceDistrictText = jQuery("#grandfather_born_place_district_for_cc option:selected").text();
        var gfBornPlaceVillageText = jQuery("#grandfather_born_place_village_for_cc option:selected").text();
        var gfNativePlaceDistrictText = jQuery("#grandfather_native_place_district_for_cc option:selected").text();
        var gfNativePlaceCityText = jQuery("#grandfather_city_for_cc option:selected").text();
        var gfNtivePlaceVillageText = jQuery("#grandfather_native_place_village_for_cc option:selected").text();
        var sBornPlaceStateText = jQuery("#spouse_born_place_state_for_cc option:selected").text();
        var sBornPlaceDistrictText = jQuery("#spouse_born_place_district_for_cc option:selected").text();
        var sBornPlaceVillageText = jQuery("#spouse_born_place_village_for_cc option:selected").text();
        var sNativePlaceStateText = jQuery("#spouse_native_place_state_for_cc option:selected").text();
        var sNativePlaceDistrictText = jQuery("#spouse_native_place_district_for_cc option:selected").text();
        var sNtivePlaceVillageText = jQuery("#spouse_native_place_village_for_cc option:selected").text();

        var validationData = that.checkValidationForCasteCertificate(casteCertificateData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('caste-certificate-' + validationData.field, validationData.message);
            // $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }


        //var casteCertificateData = new FormData($('#caste_certificate_form')[0]);
        //casteCertificateData.append("csrf_token_sugam", getTokenData()['csrf_token_sugam']);
        casteCertificateData.module_type = moduleType;
        casteCertificateData.born_place_state_text = bornPlaceStateText;
        casteCertificateData.born_place_district_text = bornPlaceDistrictText;
        casteCertificateData.born_place_village_text = bornPlaceVillageText;
        casteCertificateData.native_place_state_text = nativePlaceStateText;
        casteCertificateData.native_place_district_text = nativePlaceDistrictText;
        casteCertificateData.native_place_village_text = nativePlaceVillageText;
        casteCertificateData.father_born_place_state_text = fBornPlaceStateText;
        casteCertificateData.father_born_place_district_text = fBornPlaceDistrictText;
        casteCertificateData.father_born_place_village_text = fBornPlaceVillageText;
        casteCertificateData.father_native_place_district_text = fNativePlaceDistrictText;
        casteCertificateData.father_native_place_city_text = fNativePlaceCityText;
        casteCertificateData.father_native_place_village_text = fNtivePlaceVillageText;
        casteCertificateData.mother_born_place_state_text = mBornPlaceStateText;
        casteCertificateData.mother_born_place_district_text = mBornPlaceDistrictText;
        casteCertificateData.mother_born_place_village_text = mBornPlaceVillageText;
        casteCertificateData.mother_native_place_state_text = mNativePlaceStateText;
        casteCertificateData.mother_native_place_district_text = mNativePlaceDistrictText;
        casteCertificateData.mother_native_place_village_text = mNtivePlaceVillageText;
        casteCertificateData.grandfather_born_place_state_text = gfBornPlaceStateText;
        casteCertificateData.grandfather_born_place_district_text = gfBornPlaceDistrictText;
        casteCertificateData.grandfather_born_place_village_text = gfBornPlaceVillageText;
        casteCertificateData.grandfather_native_place_district_text = gfNativePlaceDistrictText;
        casteCertificateData.grandfather_native_place_city_text = gfNativePlaceCityText;
        casteCertificateData.grandfather_native_place_village_text = gfNtivePlaceVillageText;
        casteCertificateData.spouse_born_place_state_text = sBornPlaceStateText;
        casteCertificateData.spouse_born_place_district_text = sBornPlaceDistrictText;
        casteCertificateData.spouse_born_place_village_text = sBornPlaceVillageText;
        casteCertificateData.spouse_native_place_state_text = sNativePlaceStateText;
        casteCertificateData.spouse_native_place_district_text = sNativePlaceDistrictText;
        casteCertificateData.spouse_native_place_village_text = sNtivePlaceVillageText;

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_caste_certificate') : $('#submit_btn_for_caste_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');

        $.ajax({
            type: 'POST',
            url: 'caste_certificate/submit_caste_certificate',
            data: $.extend({}, casteCertificateData, getTokenData()),
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
                validationMessageShow('caste-certificate', textStatus.statusText);
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
                    validationMessageShow('caste-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                CasteCertificate.listview.loadCasteCertificateData();
                showSuccess(parseData.message);
            }
        });
    },

    checkValidationForCasteCertificateFatherDetails: function (caste_certificateFatherData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!caste_certificateFatherData.father_name) {
            return getBasicMessageAndFieldJSONArray('father_name_for_cc', fatherNameValidationMessage);
        }
        if (!caste_certificateFatherData.father_house_no) {
            return getBasicMessageAndFieldJSONArray('father_house_no_for_cc', houseNoValidationMessage);
        }
        if (!caste_certificateFatherData.father_house_name) {
            return getBasicMessageAndFieldJSONArray('father_house_name_for_cc', houseNameValidationMessage);
        }
        if (!caste_certificateFatherData.father_street) {
            return getBasicMessageAndFieldJSONArray('father_street_for_cc', streetValidationMessage);
        }
        if (!caste_certificateFatherData.father_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('father_village_dmc_ward_for_cc', villageNameValidationMessage);
        }
        if (!caste_certificateFatherData.father_city) {
            return getBasicMessageAndFieldJSONArray('father_city_for_cc', selectCityValidationMessage);
        }
        if (!caste_certificateFatherData.father_nationality) {
            return getBasicMessageAndFieldJSONArray('father_nationality_for_cc', applicantNationalityValidationMessage);
        }
        if (!caste_certificateFatherData.father_born_place_state) {
            return getBasicMessageAndFieldJSONArray('father_born_place_state_for_cc', selectStateValidationMessage);
        }
        if (!caste_certificateFatherData.father_born_place_district) {
            return getBasicMessageAndFieldJSONArray('father_born_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!caste_certificateFatherData.father_born_place_village) {
            return getBasicMessageAndFieldJSONArray('father_born_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!caste_certificateFatherData.father_native_place_state) {
            return getBasicMessageAndFieldJSONArray('father_native_place_state_for_cc', selectStateValidationMessage);
        }
        if (!caste_certificateFatherData.father_native_place_district) {
            return getBasicMessageAndFieldJSONArray('father_native_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!caste_certificateFatherData.father_native_place_village) {
            return getBasicMessageAndFieldJSONArray('father_native_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!caste_certificateFatherData.father_occupation) {
            return getBasicMessageAndFieldJSONArray('father_occupation_for_cc', occupationValidationMessage);
        }
        if (caste_certificateFatherData.father_occupation == VALUE_TWELVE) {
            if (!caste_certificateFatherData.father_other_occupation) {
                return getBasicMessageAndFieldJSONArray('father_other_occupation_for_cc', otherOccupationValidationMessage);
            }
        }

        return '';
    },

    submitFatherDetails: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var caste_certificateFatherData = $('#caste_certificate_father_form').serializeFormJSON();

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_caste_certificate') : $('#submit_btn_for_caste_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var caste_certificateFatherData = new FormData($('#caste_certificate_father_form')[0]);
        caste_certificateFatherData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        caste_certificateFatherData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/submit_caste_certificate_father_detail',
            data: caste_certificateFatherData,
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
                validationMessageShow('caste-certificate', textStatus.statusText);
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
                    validationMessageShow('caste-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#caste_certificate_id').val(parseData.encrypt_id);
                that.motherDetailsForm(parseData.caste_certificate_data);
            }
        });
    },

    checkValidationForCasteCertificateMotherDetails: function (caste_certificateMotherData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!caste_certificateMotherData.mother_name) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_cc', motherNameValidationMessage);
        }
        if (!caste_certificateMotherData.mother_house_no) {
            return getBasicMessageAndFieldJSONArray('mother_house_no_for_cc', houseNoValidationMessage);
        }
        if (!caste_certificateMotherData.mother_house_name) {
            return getBasicMessageAndFieldJSONArray('mother_house_name_for_cc', houseNameValidationMessage);
        }
        if (!caste_certificateMotherData.mother_street) {
            return getBasicMessageAndFieldJSONArray('mother_street_for_cc', streetValidationMessage);
        }
        if (!caste_certificateMotherData.mother_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('mother_village_dmc_ward_for_cc', villageNameValidationMessage);
        }
        if (!caste_certificateMotherData.mother_city) {
            return getBasicMessageAndFieldJSONArray('mother_city_for_cc', selectCityValidationMessage);
        }
        if (!caste_certificateMotherData.mother_nationality) {
            return getBasicMessageAndFieldJSONArray('mother_nationality_for_cc', applicantNationalityValidationMessage);
        }
        if (!caste_certificateMotherData.mother_born_place_state) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_state_for_cc', selectStateValidationMessage);
        }
        if (!caste_certificateMotherData.mother_born_place_district) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!caste_certificateMotherData.mother_born_place_village) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!caste_certificateMotherData.mother_native_place_state) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_state_for_cc', selectStateValidationMessage);
        }
        if (!caste_certificateMotherData.mother_native_place_district) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!caste_certificateMotherData.mother_native_place_village) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!caste_certificateMotherData.mother_occupation) {
            return getBasicMessageAndFieldJSONArray('mother_occupation_for_cc', occupationValidationMessage);
        }
        if (caste_certificateMotherData.mother_occupation == VALUE_TWELVE) {
            if (!caste_certificateMotherData.mother_other_occupation) {
                return getBasicMessageAndFieldJSONArray('mother_other_occupation_for_cc', otherOccupationValidationMessage);
            }
        }

        return '';
    },

    submitMotherDetails: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var caste_certificateMotherData = $('#caste_certificate_mother_form').serializeFormJSON();

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_caste_certificate') : $('#submit_btn_for_caste_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var caste_certificateMotherData = new FormData($('#caste_certificate_mother_form')[0]);
        caste_certificateMotherData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        caste_certificateMotherData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/submit_caste_certificate_mother_detail',
            data: caste_certificateMotherData,
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
                validationMessageShow('caste-certificate', textStatus.statusText);
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
                    validationMessageShow('caste-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                var casteCertificateData = parseData.caste_certificate_data;
                if (casteCertificateData.marital_status == 1) {
                    $('#caste_certificate_id').val(parseData.encrypt_id);
                    that.spouseDetailsForm(parseData.caste_certificate_data);
                } else {
                    $('#caste_certificate_id').val(parseData.encrypt_id);
                    that.uploadDocumentsForm(parseData.caste_certificate_data);
                }

            }
        });
    },

    checkValidationForCasteCertificateGrandfatherDetails: function (caste_certificateGrandfatherData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!caste_certificateGrandfatherData.father_name) {
            return getBasicMessageAndFieldJSONArray('father_name_for_cc', fatherNameValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_house_no) {
            return getBasicMessageAndFieldJSONArray('father_house_no_for_cc', houseNoValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_house_name) {
            return getBasicMessageAndFieldJSONArray('father_house_name_for_cc', houseNameValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_street) {
            return getBasicMessageAndFieldJSONArray('father_street_for_cc', streetValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('father_village_dmc_ward_for_cc', villageNameValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_city) {
            return getBasicMessageAndFieldJSONArray('father_city_for_cc', selectCityValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_nationality) {
            return getBasicMessageAndFieldJSONArray('father_nationality_for_cc', applicantNationalityValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_born_place_state) {
            return getBasicMessageAndFieldJSONArray('father_born_place_state_for_cc', selectStateValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_born_place_district) {
            return getBasicMessageAndFieldJSONArray('father_born_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_born_place_village) {
            return getBasicMessageAndFieldJSONArray('father_born_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_native_place_state) {
            return getBasicMessageAndFieldJSONArray('father_native_place_state_for_cc', selectStateValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_native_place_district) {
            return getBasicMessageAndFieldJSONArray('father_native_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_native_place_village) {
            return getBasicMessageAndFieldJSONArray('father_native_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!caste_certificateGrandfatherData.father_occupation) {
            return getBasicMessageAndFieldJSONArray('father_occupation_for_cc', occupationValidationMessage);
        }
        if (caste_certificateGrandfatherData.father_occupation == VALUE_TWELVE) {
            if (!caste_certificateGrandfatherData.father_other_occupation) {
                return getBasicMessageAndFieldJSONArray('father_other_occupation_for_cc', otherOccupationValidationMessage);
            }
        }

        return '';
    },

    submitGrandfatherDetails: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var caste_certificateGrandfatherData = $('#caste_certificate_father_form').serializeFormJSON();

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_caste_certificate') : $('#submit_btn_for_caste_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var caste_certificateGrandfatherData = new FormData($('#caste_certificate_father_form')[0]);
        caste_certificateGrandfatherData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        caste_certificateGrandfatherData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/submit_caste_certificate_father_detail',
            data: caste_certificateGrandfatherData,
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
                validationMessageShow('caste-certificate', textStatus.statusText);
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
                    validationMessageShow('caste-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#caste_certificate_id').val(parseData.encrypt_id);
                that.grandfatherDetailsForm(parseData.caste_certificate_data);
            }
        });
    },
    checkValidationForCasteCertificateSpouseDetails: function (caste_certificateSpouseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!caste_certificateSpouseData.spouse_name) {
            return getBasicMessageAndFieldJSONArray('spouse_name_for_cc', spouseNameValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_house_no) {
            return getBasicMessageAndFieldJSONArray('spouse_house_no_for_cc', houseNoValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_house_name) {
            return getBasicMessageAndFieldJSONArray('spouse_house_name_for_cc', houseNameValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_street) {
            return getBasicMessageAndFieldJSONArray('spouse_street_for_cc', streetValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('spouse_village_dmc_ward_for_cc', villageNameValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_city) {
            return getBasicMessageAndFieldJSONArray('spouse_city_for_cc', selectCityValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_nationality) {
            return getBasicMessageAndFieldJSONArray('spouse_nationality_for_cc', applicantNationalityValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_born_place_state) {
            return getBasicMessageAndFieldJSONArray('spouse_born_place_state_for_cc', selectStateValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_born_place_district) {
            return getBasicMessageAndFieldJSONArray('spouse_born_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_born_place_village) {
            return getBasicMessageAndFieldJSONArray('spouse_born_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_native_place_state) {
            return getBasicMessageAndFieldJSONArray('spouse_native_place_state_for_cc', selectStateValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_native_place_district) {
            return getBasicMessageAndFieldJSONArray('spouse_native_place_district_for_cc', selectDistrictValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_native_place_village) {
            return getBasicMessageAndFieldJSONArray('spouse_native_place_village_for_cc', selectVillageValidationMessage);
        }
        if (!caste_certificateSpouseData.spouse_occupation) {
            return getBasicMessageAndFieldJSONArray('spouse_occupation_for_cc', occupationValidationMessage);
        }
        if (caste_certificateSpouseData.spouse_occupation == VALUE_TWELVE) {
            if (!caste_certificateSpouseData.spouse_other_occupation) {
                return getBasicMessageAndFieldJSONArray('spouse_other_occupation_for_cc', otherOccupationValidationMessage);
            }
        }

        return '';
    },

    submitSpouseDetails: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var caste_certificateSpouseData = $('#caste_certificate_spouse_form').serializeFormJSON();

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_caste_certificate') : $('#submit_btn_for_caste_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var caste_certificateSpouseData = new FormData($('#caste_certificate_spouse_form')[0]);
        caste_certificateSpouseData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        caste_certificateSpouseData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/submit_caste_certificate_spouse_detail',
            data: caste_certificateSpouseData,
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
                validationMessageShow('caste-certificate', textStatus.statusText);
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
                    validationMessageShow('caste-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                $('#caste_certificate_id').val(parseData.encrypt_id);
                that.uploadDocumentsForm(parseData.caste_certificate_data);
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
        var casteCertificateData = $('#caste_certificate_upload_document_form').serializeFormJSON();


        if ($('#applicant_photo_container_for_caste_certificate').is(':visible')) {
            var applicantPhoto = checkValidationForDocument('applicant_photo_for_caste_certificate', VALUE_TWO, 'caste-certificate');
            if (applicantPhoto == false) {
                return false;
            }
        }

        if ($('#birth_certi_container_for_caste_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('birth_certi_for_caste_certificate', VALUE_ONE, 'caste-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if ($('#election_card_container_for_caste_certificate').is(':visible')) {
            var electionCard = checkValidationForDocument('election_card_for_caste_certificate', VALUE_ONE, 'caste-certificate');
            if (electionCard == false) {
                return false;
            }
        }

        if ($('#aadhaar_card_container_for_caste_certificate').is(':visible')) {
            var aadhaarCard = checkValidationForDocument('aadhaar_card_for_caste_certificate', VALUE_ONE, 'caste-certificate');
            if (aadhaarCard == false) {
                return false;
            }
        }
        if (casteCertificateData.constitution_artical == VALUE_TWO || casteCertificateData.constitution_artical == VALUE_THREE || casteCertificateData.constitution_artical == VALUE_FOUR || casteCertificateData.constitution_artical == VALUE_FIVE) {
            if ($('#leaving_certi_container_for_caste_certificate').is(':visible')) {
                var leavingCertificate = checkValidationForDocument('leaving_certi_for_caste_certificate', VALUE_ONE, 'caste-certificate');
                if (leavingCertificate == false) {
                    return false;
                }
            }
        }
        if (casteCertificateData.constitution_artical == VALUE_THREE) {
            if ($('#marriage_certi_container_for_caste_certificate').is(':visible')) {
                var marriageCertificate = checkValidationForDocument('marriage_certi_for_caste_certificate', VALUE_ONE, 'caste-certificate');
                if (marriageCertificate == false) {
                    return false;
                }
            }
        }
        if (casteCertificateData.constitution_artical == VALUE_FOUR || casteCertificateData.constitution_artical == VALUE_FIVE) {
            if ($('#last_10year_proof_container_for_caste_certificate').is(':visible')) {
                var last10YearProof = checkValidationForDocument('last_10year_proof_for_caste_certificate', VALUE_ONE, 'caste-certificate');
                if (last10YearProof == false) {
                    return false;
                }
            }
        }
        if (casteCertificateData.constitution_artical == VALUE_SIX) {
            if ($('#caste_proof_container_for_caste_certificate').is(':visible')) {
                var incomeProof = checkValidationForDocument('caste_proof_for_caste_certificate', VALUE_ONE, 'caste-certificate');
                if (incomeProof == false) {
                    return false;
                }
            }
        }
        if (casteCertificateData.constitution_artical == VALUE_FOUR || casteCertificateData.constitution_artical == VALUE_FIVE || casteCertificateData.constitution_artical == VALUE_SIX) {
            if ($('#gas_book_container_for_caste_certificate').is(':visible')) {
                var gasBook = checkValidationForDocument('gas_book_for_caste_certificate', VALUE_ONE, 'caste-certificate');
                if (gasBook == false) {
                    return false;
                }
            }
            if ($('#bank_book_container_for_caste_certificate').is(':visible')) {
                var bankBook = checkValidationForDocument('bank_book_for_caste_certificate', VALUE_ONE, 'caste-certificate');
                if (bankBook == false) {
                    return false;
                }
            }
            if (casteCertificateData.have_you_own_house_for_caste_certificate == VALUE_ONE) {
                if ($('#house_tax_receipt_container_for_caste_certificate').is(':visible')) {
                    var houseTaxReceipt = checkValidationForDocument('house_tax_receipt_for_caste_certificate', VALUE_ONE, 'caste-certificate');
                    if (houseTaxReceipt == false) {
                        return false;
                    }
                }
            }
            if (casteCertificateData.have_you_own_house_for_caste_certificate == VALUE_TWO) {
                if ($('#noc_with_notary_container_for_caste_certificate').is(':visible')) {
                    var nocWithNotary = checkValidationForDocument('noc_with_notary_for_caste_certificate', VALUE_ONE, 'caste-certificate');
                    if (nocWithNotary == false) {
                        return false;
                    }
                }
            }

        }


        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_caste_certificate') : $('#submit_btn_for_caste_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var casteCertificateData = new FormData($('#caste_certificate_upload_document_form')[0]);
        casteCertificateData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        casteCertificateData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/submit_caste_certificate_upload_document',
            data: casteCertificateData,
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
                validationMessageShow('caste-certificate', textStatus.statusText);
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
                    validationMessageShow('caste-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }

                showSuccess(parseData.message);
                CasteCertificate.router.navigate('caste_certificate', {'trigger': true});
            }
        });
    },
    askForApproveApplication: function (casteCertificateId) {
        if (!casteCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + casteCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'caste_certificate/get_caste_certificate_data_by_caste_certificate_id',
            type: 'post',
            data: $.extend({}, {'caste_certificate_id': casteCertificateId}, getTokenData()),
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
                var casteCertificateData = parseData.caste_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                var ccData = that.getBasicConfigurationForMovement(casteCertificateData);
                $('#popup_container').html(casteCertificateApproveTemplate(ccData));
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
        var formData = $('#approve_caste_certificate_form').serializeFormJSON();
        if (!formData.caste_certificate_id_for_caste_certificate_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_caste_certificate_approve) {
            $('#remarks_for_caste_certificate_approve').focus();
            validationMessageShow('caste-certificate-approve-remarks_for_caste_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_caste_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/approve_application',
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
                validationMessageShow('caste-certificate-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('caste-certificate-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                CasteCertificate.listview.loadCasteCertificateData();
            }
        });
    },
    getBasicConfigurationForMovement: function (casteCertificateData) {
        var that = this;
        if (casteCertificateData.talathi_to_aci != VALUE_ZERO) {
            casteCertificateData.show_talathi_updated_basic_details = true;
        }
        casteCertificateData.application_type_title = 'Applicant';
        casteCertificateData.show_minor_detail = false;
        if (casteCertificateData.constitution_artical == VALUE_TWO) {
            casteCertificateData.application_type_title = 'Guardian';
            casteCertificateData.show_minor_detail = true;
        }
        if (casteCertificateData.aci_rec == VALUE_ONE || casteCertificateData.aci_rec == VALUE_TWO || casteCertificateData.aci_rec == VALUE_THREE) {
            casteCertificateData.show_aci_updated_basic_details = true;
            //casteCertificateData.aci_rec_text = recArray[casteCertificateData.aci_rec] ? recArray[casteCertificateData.aci_rec] : '';
            casteCertificateData.aci_rec_text = recmigArray[casteCertificateData.aci_rec] ? recmigArray[casteCertificateData.aci_rec] : '';
            casteCertificateData.caste_by_aci_text = casteArray[casteCertificateData.caste_by_aci] ? casteArray[casteCertificateData.caste_by_aci] : '';
            if (casteCertificateData.aci_rec == VALUE_ONE || casteCertificateData.aci_rec == VALUE_THREE) {
                if (casteCertificateData.aci_rec == VALUE_ONE) {
                    casteCertificateData.act_to_mamlatdar_ldc_datetime_text = casteCertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.aci_to_ldc_datetime) : '';
                    casteCertificateData.act_to_mamlatdar_ldc_name_text = casteCertificateData.ldc_name;
                } else {
                    casteCertificateData.act_to_mamlatdar_ldc_datetime_text = casteCertificateData.aci_to_m_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.aci_to_m_ldc_datetime) : '';
                    casteCertificateData.act_to_mamlatdar_ldc_name_text = casteCertificateData.ldc_name_m;
                }
            }
            if (casteCertificateData.aci_rec == VALUE_TWO) {
                casteCertificateData.act_to_mamlatdar_ldc_datetime_text = casteCertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.aci_to_mamlatdar_datetime) : '';
                casteCertificateData.act_to_mamlatdar_ldc_name_text = casteCertificateData.mamlatdar_name;
            }
        }
        if (casteCertificateData.ldc_to_mamlatdar != VALUE_ZERO && (casteCertificateData.aci_rec == VALUE_ONE || casteCertificateData.aci_rec == VALUE_THREE)) {
            casteCertificateData.show_ldc_updated_basic_details = true;
            casteCertificateData.ldc_commu_address = that.ldcCommuAddress(casteCertificateData);
            if (casteCertificateData.constitution_artical == VALUE_TWO) {
                casteCertificateData.show_ldc_updated_minor_child_details = true;
            }
            casteCertificateData.ldc_to_mamlatdar_datetime_text = casteCertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        if (casteCertificateData.to_type_reverify != VALUE_ZERO) {
            casteCertificateData.show_mam_reverify_updated_basic_details = true;
            casteCertificateData.mam_reverification = casteCertificateData.to_type_reverify == VALUE_ONE ? casteCertificateData.talathi_name : casteCertificateData.aci_name;
        }
        if (casteCertificateData.talathi_to_type_reverify != VALUE_ZERO) {
            casteCertificateData.talathi_reverification = casteCertificateData.talathi_to_type_reverify == VALUE_ONE ? casteCertificateData.aci_name : casteCertificateData.mamlatdar_name;
            casteCertificateData.show_talathi_reverify_updated_basic_details = true;
        }
        if (casteCertificateData.aci_rec_reverify == VALUE_ONE || casteCertificateData.aci_rec_reverify == VALUE_TWO) {
            casteCertificateData.show_aci_reverify_updated_basic_details = true;
            casteCertificateData.aci_rec_reverify_text = recArray[casteCertificateData.aci_rec_reverify] ? recArray[casteCertificateData.aci_rec_reverify] : '';
            casteCertificateData.caste_by_aci_reverify_text = casteArray[casteCertificateData.caste_by_aci_reverify] ? casteArray[casteCertificateData.caste_by_aci_reverify] : '';
            if (casteCertificateData.aci_rec_reverify == VALUE_ONE) {
                casteCertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = casteCertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.aci_to_ldc_datetime) : '';
                casteCertificateData.act_to_mamlatdar_ldc_reverify_name_text = casteCertificateData.ldc_name;
            }
            if (casteCertificateData.aci_rec_reverify == VALUE_TWO) {
                casteCertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = casteCertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.aci_to_reverify_datetime) : '';
                casteCertificateData.act_to_mamlatdar_ldc_reverify_name_text = casteCertificateData.mamlatdar_name;
            }
        }
        if (casteCertificateData.ldc_to_mamlatdar != VALUE_ZERO && casteCertificateData.aci_rec_reverify == VALUE_ONE) {
            casteCertificateData.show_ldc_reverify_updated_basic_details = true;
            casteCertificateData.ldc_commu_address = that.ldcCommuAddress(casteCertificateData);
            if (casteCertificateData.constitution_artical == VALUE_TWO) {
                casteCertificateData.show_ldc_reverify_updated_minor_child_details = true;
            }
            casteCertificateData.ldc_to_mamlatdar_datetime_text = casteCertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        casteCertificateData.talathi_to_aci_datetime_text = casteCertificateData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.talathi_to_aci_datetime) : '';
        casteCertificateData.aci_to_mamlatdar_datetime_text = casteCertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.aci_to_mamlatdar_datetime) : '';
        casteCertificateData.mam_to_reverify_datetime_text = casteCertificateData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.mam_to_reverify_datetime) : '';
        casteCertificateData.talathi_to_reverify_datetime_text = casteCertificateData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.talathi_to_reverify_datetime) : '';
        casteCertificateData.aci_to_reverify_datetime_text = casteCertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(casteCertificateData.aci_to_reverify_datetime) : '';
        return casteCertificateData;
    },
    askForRejectApplication: function (casteCertificateId) {
        if (!casteCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + casteCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'caste_certificate/get_caste_certificate_data_by_caste_certificate_id',
            type: 'post',
            data: $.extend({}, {'caste_certificate_id': casteCertificateId}, getTokenData()),
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
                var casteCertificateData = parseData.caste_certificate_data;
                showPopup();
                var ccData = that.getBasicConfigurationForMovement(casteCertificateData);
                $('#popup_container').html(casteCertificateRejectTemplate(ccData));
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_caste_certificate_form').serializeFormJSON();
        if (!formData.caste_certificate_id_for_caste_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_caste_certificate_reject) {
            $('#remarks_for_caste_certificate_reject').focus();
            validationMessageShow('caste-certificate-reject-remarks_for_caste_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_caste_certificate_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/reject_application',
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
                validationMessageShow('caste-certificate-reject', textStatus.statusText);
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
                    validationMessageShow('caste-certificate-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                CasteCertificate.listview.loadCasteCertificateData();
            }
        });
    },

    FillBilling: function () {
        if ($("#billingtoo_for_cc").is(":checked")) {
            $('#per_addr_house_no_for_cc').val($('#com_addr_house_no_for_cc').val());
            $('#per_addr_house_name_for_cc').val($('#com_addr_house_name_for_cc').val());
            $('#per_addr_street_for_cc').val($('#com_addr_street_for_cc').val());
            $('#per_addr_village_dmc_ward_for_cc').val($('#com_addr_village_dmc_ward_for_cc').val());
            $('#per_addr_state_for_cc').val($('#commu_add_state_for_cc').val());
            $('#per_pincode_for_cc').val($('#com_pincode_for_cc').val());
            var stateCode = $('#commu_add_state_for_cc').val();
            var districtData = tempDistrictData[stateCode] ? tempDistrictData[stateCode] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_addr_district_for_cc', 'district_code', 'district_name', 'District');
            $('#per_addr_district_for_cc').val($('#commu_add_district_for_cc').val());

            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(tempVillageDataForCC, 'per_addr_village_for_cc', 'village_code', 'village_name', 'Select Village');
            // console.log(tempVillageDataForCC);
            $('#per_addr_village_for_cc').val($('#commu_add_village_for_cc').val());
            $('#per_addr_city_for_cc').val($('#com_addr_city_for_cc').val());
        } else {
            $('#per_addr_house_no_for_cc').val('');
            $('#per_addr_house_name_for_cc').val('');
            $('#per_addr_street_for_cc').val('');
            $('#per_addr_village_dmc_ward_for_cc').val('');
            $('#per_addr_state_for_cc').val('');
            $('#per_addr_district_for_cc').val('');
            $('#per_addr_village_for_cc').val('');
            $('#per_addr_city_for_cc').val('');
            $('#per_pincode_for_cc').val('');
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
            this.$('.applicant_name_for_cc_div').show();
            this.$('.gurdian_name_for_cc_div').hide();
            this.$('.guardian_div_one').hide();
            this.$('.guardian_div_two').hide();
            this.$('.guardian_div_three').hide();
            this.$('.marital_status_div_for_cc').show();
            this.$('.occupation_div_for_cc').show();

        }
        if (val === '2') {
            this.$('#main_div').show();
            this.$('.applicant_name_for_cc_div').hide();
            this.$('.gurdian_name_for_cc_div').show();
            this.$('.guardian_div_one').show();
            this.$('.guardian_div_two').show();
            this.$('.guardian_div_three').show();
            this.$('.marital_status_div_for_cc').hide();
            this.$('.spouse_info_item_container_for_cc').hide();
            this.$('.occupation_div_for_cc').hide();

        }

    },

    getDistrictFornDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_district_for_cc');
        var state = obj.val();
        if (!state) {
            return false;
        }
        if (state != VALUE_ONE && state != VALUE_TWO) {
            return false;
        }
        var districtData = state == VALUE_ONE ? damandiudistrictArray : (state == VALUE_TWO ? dnhdistrictArray : []);
        renderOptionsForTwoDimensionalArray(districtData, id + '_district_for_cc');
    },
    getVillageDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_village_for_cc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var districtData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
        renderOptionsForTwoDimensionalArray(districtData, id + '_village_for_cc');
    },
    downloadCertificate: function (casteCertificateId, moduleType) {
        if (!casteCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#caste_certificate_id_for_certificate').val(casteCertificateId);
        $('#mtype_for_certificate').val(moduleType);
        $('#caste_certificate_pdf_form').submit();
        $('#caste_certificate_id_for_certificate').val('');
        $('#mtype_for_certificate').val('');
    },
    migrantCertificate: function (casteCertificateId, moduleType) {
        if (!casteCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#caste_migrant_certificate_id_for_certificate').val(casteCertificateId);
        $('#mtype_migrant_for_caste_certificate').val(moduleType);
        $('#caste_migrant_certificate_pdf_form').submit();
        $('#caste_migrant_certificate_id_for_certificate').val('');
        $('#mtype_migrant_for_caste_certificate').val('');
    },
    getQueryData: function (casteCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!casteCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_FOUR;
        templateData.module_id = casteCertificateId;
        var btnObj = $('#query_btn_for_app_' + casteCertificateId);
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
                tmpData.module_type = VALUE_FOUR;
                tmpData.module_id = casteCertificateId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    setAppointment: function (casteCertificateId) {
        if (!casteCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + casteCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'caste_certificate/get_appointment_data_by_caste_certificate_id',
            type: 'post',
            data: $.extend({}, {'caste_certificate_id': casteCertificateId}, getTokenData()),
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

                $('#popup_container').html(casteCertificateAppointmentTemplate(appointmentData));
                if (appointmentData.online_statement == VALUE_ONE) {
                    $('#online_statement_for_caste_certificate').attr('checked', 'checked');
                }
                if (appointmentData.visit_office == VALUE_ONE) {
                    $('#visit_office_for_caste_certificate').attr('checked', 'checked');
                }
                loadAppointmentHistory('caste_certificate', appointmentData);
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
        var formData = $('#set_appointment_caste_certificate_form').serializeFormJSON();
        if (!formData.caste_certificate_id_for_caste_certificate_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_caste_certificate) {
            //$('#appointment_date_for_caste_certificate').focus();
            validationMessageShow('caste-certificate-appointment_date_for_caste_certificate', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_caste_certificate) {
            //$('#appointment_time_for_caste_certificate').focus();
            validationMessageShow('caste-certificate-appointment_time_for_caste_certificate', timeValidationMessage);
            return false;
        }
        var start_date = dateTo_YYYY_MM_DD(formData.appointment_date_for_caste_certificate); // Oct 1, 2014
        var d = new Date();
        var end_date = d.setDate(d.getDate() - 1);
        var new_start_date = new Date(start_date);
        var new_end_date = new Date(end_date);

        if (new_end_date > new_start_date) {
            //$('#appointment_date_for_caste_certificate').focus();
            validationMessageShow('caste-certificate-appointment_date_for_caste_certificate', appointmentDateSelectValidationMessage);
            return false;
        }
        if (formData.online_statement_for_caste_certificate == undefined && formData.visit_office_for_caste_certificate == undefined) {
            $('#visit_office_for_caste_certificate').focus();
            validationMessageShow('caste-certificate-visit_office_for_caste_certificate', appointmentTypeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_caste_certificate_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/submit_set_appointment',
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
                validationMessageShow('caste-certificate-set-appointment', textStatus.statusText);
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
                    validationMessageShow('caste-certificate-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var casteCertificateData = parseData.caste_certificate_data;

                if (casteCertificateData.appointment_date != '0000-00-00') {
                    var d1 = (dateTo_DD_MM_YYYY(casteCertificateData.appointment_date)).split("-");
                    var d2 = (dateTo_DD_MM_YYYY()).split("-");
                    d1 = d1[2].concat(d1[1], d1[0]);
                    d2 = d2[2].concat(d2[1], d2[0]);
                    if (parseInt(d2) >= parseInt(d1)) {
                        //casteCertificateData.show_forward_btn = true;
                        $('#update_basic_detail_btn_for_app_' + casteCertificateData.caste_certificate_id).show();
                    } else {
                        $('#update_basic_detail_btn_for_app_' + casteCertificateData.caste_certificate_id).hide();
                    }
                }

                $('#appointment_container_' + casteCertificateData.caste_certificate_id).html(that.getAppointmentData(casteCertificateData));
                $('#movement_for_cc_list_' + casteCertificateData.caste_certificate_id).html(movementStringMigrant(casteCertificateData));
            }
        });
    },
    reverifyApplication: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_caste_certificate_form').serializeFormJSON();
        if (!formData.caste_certificate_id_for_caste_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if (!formData.to_type_reverify_for_caste_certificate) {
                $('#to_type_reverify_for_caste_certificate_1').focus();
                validationMessageShow('caste-certificate-update-basic-detail-to_type_reverify_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.mam_reverify_remarks_for_caste_certificate) {
                $('#mam_reverify_remarks_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-mam_reverify_remarks_for_caste_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.talathi_to_type_reverify_for_caste_certificate) {
                $('#talathi_to_type_reverify_for_caste_certificate_1').focus();
                validationMessageShow('caste-certificate-update-basic-detail-talathi_to_type_reverify_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.upload_reverification_document_for_caste_certificate) {
                $('#upload_reverification_document_for_caste_certificate_1').focus();
                validationMessageShow('caste-certificate-update-basic-detail-upload_reverification_document_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_reverification_document_for_caste_certificate == VALUE_ONE) {
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
            if (!formData.talathi_reverify_remarks_for_caste_certificate) {
                $('#talathi_reverify_remarks_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-talathi_reverify_remarks_for_caste_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_reverify_for_caste_certificate) {
                $('#aci_rec_reverify_for_caste_certificate_1').focus();
                validationMessageShow('caste-certificate-update-basic-detail-aci_rec_reverify_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.caste_by_aci_reverify_for_caste_certificate) {
                $('#caste_by_aci_reverify_for_caste_certificate_1').focus();
                validationMessageShow('caste-certificate-update-basic-detail-caste_by_aci_reverify_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_reverify_remarks_for_caste_certificate) {
                $('#aci_reverify_remarks_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-aci_reverify_remarks_for_caste_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_caste_certificate == VALUE_ONE && !formData.aci_to_ldc_reverify_for_caste_certificate) {
                $('#aci_to_ldc_reverify_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-aci_to_ldc_reverify_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_caste_certificate == VALUE_ONE && !formData.aci_to_type_reverify_for_caste_certificate) {
                $('#aci_to_type_reverify_for_caste_certificate_1').focus();
                validationMessageShow('caste-certificate-update-basic-detail-aci_to_type_reverify_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            if (!formData.ldc_applicant_name_for_caste_certificate) {
                $('#ldc_applicant_name_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-ldc_applicant_name_for_caste_certificate', applicantNameValidationMessage);
                return false;
            }
            if (!formData.pre_house_no) {
                $('#pre_house_no_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-pre_house_no_for_caste_certificate', houseNoValidationMessage);
                return false;
            }
            if (!formData.pre_house_name) {
                $('#pre_house_name_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-pre_house_name_for_caste_certificate', houseNameValidationMessage);
                return false;
            }
            if (!formData.pre_street) {
                $('#pre_street_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-pre_street_for_caste_certificate', streetValidationMessage);
                return false;
            }
            if (!formData.pre_village) {
                $('#pre_village_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-pre_village_for_caste_certificate', villagewardValidationMessage);
                return false;
            }
            if (!formData.pre_city) {
                $('#pre_city_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-pre_city_for_caste_certificate', selectCityValidationMessage);
                return false;
            }
            if (!formData.pre_pincode) {
                $('#pre_pincode_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-pre_pincode_for_caste_certificate', pincodeValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_caste_certificate) {
                $('#ldc_to_mamlatdar_remarks_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_caste_certificate', remarksValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_for_caste_certificate) {
                $('#ldc_to_mamlatdar_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-ldc_to_mamlatdar_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/reverify_application',
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
                validationMessageShow('caste-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('caste-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var icData = parseData.caste_certificate_data;
                if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
                    $('#status_' + formData.caste_certificate_id_for_caste_certificate_update_basic_detail).html(appStatusArray[VALUE_THREE]);
                    var reverificationName = formData.to_type_reverify_for_caste_certificate == VALUE_ONE ? formData.talathi_name_for_caste_certificate_update_basic_detail : formData.aci_name_for_caste_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.caste_certificate_id_for_caste_certificate_update_basic_detail).html('<hr>' + reverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    var talathiReverificationName = formData.talathi_to_type_reverify_for_caste_certificate == VALUE_ONE ? formData.aci_name_for_caste_certificate_update_basic_detail : formData.mamlatdar_name_for_caste_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.caste_certificate_id_for_caste_certificate_update_basic_detail).html('<hr>' + talathiReverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    if (icData.aci_rec_reverify == VALUE_ONE) {
                        $('#reverification_status_' + formData.caste_certificate_id_for_caste_certificate_update_basic_detail).html('<hr>' + icData.ldc_name);
                    } else {
                        $('#reverification_status_' + formData.caste_certificate_id_for_caste_certificate_update_basic_detail).html('<hr>' + formData.mamlatdar_name_for_caste_certificate_update_basic_detail);
                    }
                }
                $('#movement_for_cc_list_' + formData.caste_certificate_id_for_caste_certificate_update_basic_detail).html(movementStringMigrant(parseData.caste_certificate_data));
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
    updateBasicDetails: function (btnObj, casteCertificateId) {
        if (!casteCertificateId) {
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
            url: 'caste_certificate/get_update_basic_detail_data_by_caste_certificate_id',
            type: 'post',
            data: $.extend({}, {'caste_certificate_id': casteCertificateId}, getTokenData()),
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

                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_talathi_enter_basic_details = true;
                }
                if (basicDetailData.talathi_to_aci != VALUE_ZERO) {
                    basicDetailData.show_talathi_updated_basic_details = true;
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
                    basicDetailData.caste_by_aci_text = casteArray[basicDetailData.caste_by_aci] ? casteArray[basicDetailData.caste_by_aci] : '';
                    if (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_THREE) {
                        if (basicDetailData.aci_rec == VALUE_ONE) {
                            basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_ldc_datetime) : '';
                            basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.ldc_name;
                        } else {
                            basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_m_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_m_ldc_datetime) : '';
                            basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.ldc_name_m;
                        }
                    }
                    if (basicDetailData.aci_rec == VALUE_TWO) {
                        basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_mamlatdar_datetime) : '';
                        basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.mamlatdar_name;
                    }
                    // if (basicDetailData.aci_rec == VALUE_THREE) {
                    //     basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_ldc_datetime) : '';
                    //     basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.ldc_name;
                    // }
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_LDC_USER && (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_THREE) &&
                        basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                    basicDetailData.show_ldc_enter_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData.t_vt_name = basicDetailData.com_addr_village_dmc_ward + ', ' + basicDetailData.com_addr_city;
                    basicDetailData = ldcAppDetails(basicDetailData, 't_vt_name', 'ldc_vt_name', 'ldc_vt');
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_religion', 'ldc_applicant_religion', 'ldc_ar');
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_enter_minor_child_details = true;
                        basicDetailData = ldcAppDetails(basicDetailData, 'minor_child_name', 'ldc_minor_child_name', 'ldc_mc_name');
                    }
                    basicDetailData = returnFieldNameFromJSON(basicDetailData, 'father_details', 'father_name', 'app_father_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'app_father_name', 'ldc_father_name', 'ldc_fname');
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_THREE)) {
                    basicDetailData.show_ldc_updated_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
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
                    basicDetailData.caste_by_aci_reverify_text = casteArray[basicDetailData.caste_by_aci_reverify] ? casteArray[basicDetailData.caste_by_aci_reverify] : '';
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
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData.t_vt_name = basicDetailData.com_addr_village_dmc_ward + ', ' + basicDetailData.com_addr_city;
                    basicDetailData = ldcAppDetails(basicDetailData, 't_vt_name', 'ldc_vt_name', 'ldc_vt');
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_religion', 'ldc_applicant_religion', 'ldc_ar');
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_reverify_enter_minor_child_details = true;
                        basicDetailData = ldcAppDetails(basicDetailData, 'minor_child_name', 'ldc_minor_child_name', 'ldc_mc_name');
                    }
                    basicDetailData = returnFieldNameFromJSON(basicDetailData, 'father_details', 'father_name', 'app_father_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'app_father_name', 'ldc_father_name', 'ldc_fname');
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && (basicDetailData.aci_rec_reverify == VALUE_ONE || basicDetailData.aci_rec_reverify == VALUE_THREE)) {
                    basicDetailData.show_ldc_reverify_updated_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    if (basicDetailData.constitution_artical == VALUE_TWO) {
                        basicDetailData.show_ldc_reverify_updated_minor_child_details = true;
                    }
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                }
                basicDetailData.title = basicDetailData.to_type_reverify == VALUE_ZERO ? (tempTypeInSession == TEMP_TYPE_TALATHI_USER ? 'Forward for Verification' : (tempTypeInSession == TEMP_TYPE_ACI_USER ? 'Forward for Approval' : 'Update Basic Details')) : 'Reverification Caste Certificate Form';
                basicDetailData.talathi_to_aci_datetime_text = basicDetailData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_aci_datetime) : '';
                basicDetailData.mam_to_reverify_datetime_text = basicDetailData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.mam_to_reverify_datetime) : '';
                basicDetailData.talathi_to_reverify_datetime_text = basicDetailData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_reverify_datetime) : '';
                basicDetailData.aci_to_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';

                if (basicDetailData.status == VALUE_FIVE || basicDetailData.status == VALUE_SIX) {
                    basicDetailData.show_approve_reject_details = true;
                    basicDetailData.status_text = returnAppStatus(basicDetailData.status);
                    basicDetailData.status_datetime_text = basicDetailData.status_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.status_datetime) : '';
                    basicDetailData.title = 'Movement Details of Caste Certificate Form';
                }

                if (basicDetailData.constitution_artical == VALUE_ONE) {
                    basicDetailData.application_type_title = 'Applicant';
                    basicDetailData.show_minor_detail = false;
                } else {
                    basicDetailData.show_education_tbl = true;
                    basicDetailData.application_type_title = 'Guardian';
                    basicDetailData.show_minor_detail = true;
                }
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


                basicDetailData.ldc_name = (basicDetailData.ldc_name == null || basicDetailData.ldc_name == '') ? basicDetailData.ldc_name_m : basicDetailData.ldc_name;
                basicDetailData.required_purpose = basicDetailData.select_required_purpose == VALUE_ONE ? 'Old Age Pension' : basicDetailData.required_purpose;

                basicDetailData.com_addr_city = basicDetailData.com_addr_city;
                basicDetailData.status = queryStatus(basicDetailData.query_status);


                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    $('#model_md_title').html(basicDetailData.title);
                    $('#model_md_body').html(casteCertificateUpdateBasicDetailTemplate(basicDetailData));
                } else {
                    basicDetailData.show_card = true;
                    $('#popup_container').html(casteCertificateUpdateBasicDetailTemplate(basicDetailData));
                }

                if (basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) {
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                        generateBoxes('radio', yesNoArray, 'upload_verification_document', 'caste_certificate', basicDetailData.is_upload_verification_document, false, false);
                        showSubContainer('upload_verification_document', 'caste_certificate', '#field_verification_document_uploads', VALUE_ONE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.aci_data, 'talathi_to_aci_for_caste_certificate', 'sa_user_id', 'name', '', false);

                        if (basicDetailData.field_documents != '') {
                            $.each(basicDetailData.field_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_ONE);
                                $('#upload_verification_document_for_caste_certificate_1').attr('checked', 'checked');
                                $('#field_verification_document_uploads_container_for_caste_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_ONE);
                            $('#upload_verification_document_for_caste_certificate_2').attr('checked', 'checked');
                        }

                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                        basicDetailData.aci_rec = (basicDetailData.aci_rec == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec);
                        generateBoxes('radio', recmigArray, 'aci_rec', 'caste_certificate', basicDetailData.aci_rec, false, false, false);

                        showSubContainer('aci_rec', 'caste_certificate', '#aci_to_ldc', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec', 'caste_certificate', '#aci_to_mamlatdar', VALUE_TWO, 'radio');
                        showSubContainer('aci_rec', 'caste_certificate', '#aci_to_ldc1', VALUE_THREE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'aci_to_mamlatdar_for_caste_certificate', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_for_caste_certificate', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc1_for_caste_certificate', 'sa_user_id', 'name', '', false);

                        generateBoxes('radio', casteArray, 'caste_by_aci', 'caste_certificate', basicDetailData.caste_by_aci, false, false, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_THREE) &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'ldc_to_mamlatdar_for_caste_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.to_type_reverify == VALUE_ZERO) {
                        generateBoxes('radio', reverifyTypeArray, 'to_type_reverify', 'caste_certificate', basicDetailData.to_type_reverify, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.to_type_reverify == VALUE_ONE) {
                        generateBoxes('radio', yesNoArray, 'upload_reverification_document', 'caste_certificate', basicDetailData.is_upload_reverification_document, false, false);
                        showSubContainer('upload_reverification_document', 'caste_certificate', '#field_reverification_document_uploads', VALUE_ONE, 'radio');
                        generateBoxes('radio', talathiReverifyTypeArray, 'talathi_to_type_reverify', 'caste_certificate', basicDetailData.talathi_to_type_reverify, false);

                        if (basicDetailData.field_reverify_documents != '') {
                            $.each(basicDetailData.field_reverify_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_TWO);
                                $('#upload_reverification_document_for_caste_certificate_1').attr('checked', 'checked');
                                $('#field_reverification_document_uploads_container_for_caste_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_TWO);
                            $('#upload_reverification_document_for_caste_certificate_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                            (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                        var tempArray = [];
                        tempArray[VALUE_ZERO] = basicDetailData.mamlatdar_name;
                        generateBoxes('radio', tempArray, 'aci_to_type_reverify', 'caste_certificate', VALUE_ZERO, false);
                        basicDetailData.aci_rec_reverify = (basicDetailData.aci_rec_reverify == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec_reverify);
                        generateBoxes('radio', recmigArray, 'aci_rec_reverify', 'caste_certificate', basicDetailData.aci_rec_reverify, false, false);
                        showSubContainer('aci_rec_reverify', 'caste_certificate', '#aci_to_ldc_reverify', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec_reverify', 'caste_certificate', '#aci_to_mamlatdar_reverify', VALUE_TWO, 'radio');
                        showSubContainer('aci_rec_reverify', 'caste_certificate', '#aci_to_ldc1_reverify', VALUE_THREE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_reverify_for_caste_certificate', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc1_reverify_for_caste_certificate', 'sa_user_id', 'name', '', false);

                        generateBoxes('radio', casteArray, 'caste_by_aci_reverify', 'caste_certificate', basicDetailData.caste_by_aci_reverify, false, false, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec_reverify == VALUE_ONE || basicDetailData.aci_rec_reverify == VALUE_THREE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        var tempArray = [];
                        var tArray = {};
                        tArray['name'] = basicDetailData.mamlatdar_name;
                        tArray['sa_user_id'] = basicDetailData.aci_to_mamlatdar;
                        tempArray.push(tArray);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempArray, 'ldc_to_mamlatdar_for_caste_certificate', 'sa_user_id', 'name', '', false);
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
        var formData = $('#update_basic_detail_caste_certificate_form').serializeFormJSON();
        if (!formData.caste_certificate_id_for_caste_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {

            if (!formData.upload_verification_document_for_caste_certificate) {
                $('#upload_verification_document_for_caste_certificate_1').focus();
                validationMessageShow('caste-certificate-update-basic-detail-upload_verification_document_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_verification_document_for_caste_certificate == VALUE_ONE) {
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

            if (!formData.talathi_remarks_for_caste_certificate) {
                $('#talathi_remarks_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-talathi_remarks_for_caste_certificate', remarksValidationMessage);
                return false;
            }
            if (!formData.talathi_to_aci_for_caste_certificate) {
                $('#talathi_to_aci_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-talathi_to_aci_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_for_caste_certificate) {
                $('#aci_rec_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-aci_rec_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.caste_by_aci_for_caste_certificate) {
                $('#caste_by_aci_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-caste_by_aci_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_remarks_for_caste_certificate) {
                $('#aci_remarks_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-aci_remarks_for_caste_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_caste_certificate == VALUE_ONE && !formData.aci_to_ldc_for_caste_certificate) {
                $('#aci_to_ldc_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-aci_to_ldc_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_caste_certificate == VALUE_TWO && !formData.aci_to_mamlatdar_for_caste_certificate) {
                $('#aci_to_mamlatdar_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-aci_to_mamlatdar_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_caste_certificate == VALUE_THREE && !formData.aci_to_ldc1_for_caste_certificate) {
                $('#aci_to_ldc1_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-aci_to_ldc1_for_caste_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            var constitutionArtical = parseInt($('#constitution_artical_for_caste_certificate').val());
            if (constitutionArtical != VALUE_ONE && constitutionArtical != VALUE_TWO) {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (!formData.ldc_applicant_name_for_caste_certificate) {
                $('#ldc_applicant_name_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-ldc_applicant_name_for_caste_certificate', applicantNameValidationMessage);
                return false;
            }
            if (constitutionArtical == VALUE_TWO) {
                if (!formData.ldc_minor_child_name_for_caste_certificate) {
                    $('#ldc_minor_child_name_for_caste_certificate').focus();
                    validationMessageShow('caste-certificate-update-basic-detail-ldc_minor_child_name_for_caste_certificate', minorChildNameValidationMessage);
                    return false;
                }
            }
            if (!formData.ldc_father_name_for_caste_certificate) {
                $('#ldc_father_name_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-ldc_father_name_for_caste_certificate', fatherNameValidationMessage);
                return false;
            }
            if (!formData.ldc_vt_name_for_caste_certificate) {
                $('#ldc_vt_name_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-ldc_vt_name_for_caste_certificate', detailValidationMessage);
                return false;
            }
            if (!formData.ldc_commu_address_for_caste_certificate) {
                $('#ldc_commu_address_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-ldc_commu_address_for_caste_certificate', communicationAddressValidationMessage);
                return false;
            }
//            if (!formData.ldc_applicant_religion_for_caste_certificate) {
//                $('#ldc_applicant_religion_for_caste_certificate').focus();
//                validationMessageShow('caste-certificate-update-basic-detail-ldc_applicant_religion_for_caste_certificate', religionValidationMessage);
//                return false;
//            }
            if (!formData.ldc_to_mamlatdar_remarks_for_caste_certificate) {
                $('#ldc_to_mamlatdar_remarks_for_caste_certificate').focus();
                validationMessageShow('caste-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_caste_certificate', remarksValidationMessage);
                return false;
            }
            if (!showLDCDraftBtn) {
                formData.update_ldc_mam_details = VALUE_ONE;
                if (!formData.ldc_to_mamlatdar_for_caste_certificate) {
                    $('#ldc_to_mamlatdar_for_caste_certificate').focus();
                    validationMessageShow('caste-certificate-update-basic-detail-ldc_to_mamlatdar_for_caste_certificate', oneOptionValidationMessage);
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
            url: 'caste_certificate/forward_to',
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
                validationMessageShow('caste-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('caste-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                //$('#movement_for_cc_list_' + parseData.caste_certificate_id).html(movementString(parseData.caste_certificate_data));
                $('#movement_for_cc_list_' + parseData.caste_certificate_id).html(movementStringMigrant(parseData.caste_certificate_data));
                resetModelMD();
            }
        });
    },
    getDocumentData: function (casteCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!casteCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#caste_certificate_id_for_scrutiny').val(casteCertificateId);
        $('#caste_certificate_document_for_scrutiny').submit();
        $('#caste_certificate_id_for_scrutiny').val('');
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
        renderOptionsForTwoDimensionalArray([], 'village_name_for_cc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_cc');
    },
    getVillageData: function (obj, moduleName, id, isTemp = false) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'cc' ? ' ' : '';
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
        $('#' + id + '_village_for_' + moduleName).val('');
        var state = $('#' + id + '_state_for_' + moduleName).val();
        var districtCode = obj.val();
        if (!districtCode || !state) {
            return;
        }
        var bornStateId = id + '_village_for_cc';
        addTagSpinner(bornStateId);
        $.ajax({
            url: 'caste_certificate/get_village_data_for_caste_certificate',
            type: 'post',
            data: $.extend({}, {'state_code': state, 'district_code': districtCode}, getTokenData()),
            error: function (textStatus, errorThrown) {
                removeTagSpinner();
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
                removeTagSpinner();
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
            url: 'caste_certificate/get_name_data_for_caste_certificate',
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
        var bornStateId = id + '_village_for_cc';
        addTagSpinner(bornStateId);
        $.ajax({
            url: 'caste_certificate/get_village_data_for_caste_certificate',
            type: 'post',
            async: false,
            data: $.extend({}, {'state_code': state, 'district_code': districtCode}, getTokenData()),
            error: function (textStatus, errorThrown) {
                removeTagSpinner();
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
                removeTagSpinner();
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
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_cc', 'village_code', 'village_name', 'Village');
                $('#' + id + '_village_for_cc').val(village == 0 ? '' : village);
                removeTagSpinner();
            }
        });
    },
    getDistrictFornDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_district_for_cc');
        var state = obj.val();
        if (!state) {
            return false;
        }
        if (state != VALUE_ONE && state != VALUE_TWO) {
            return false;
        }
        var districtData = state == VALUE_ONE ? damandiudistrictArray : (state == VALUE_TWO ? dnhdistrictArray : []);
        renderOptionsForTwoDimensionalArray(districtData, id + '_district_for_cc');
    },
    getVillageDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_village_for_cc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var districtData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
        renderOptionsForTwoDimensionalArray(districtData, id + '_village_for_cc');
    },
    villageDMCChangeEvent: function () {
        var district = $('#district').val();
        var villageCode = $('#village_name_for_cc').val();
        var villageData = (district == VALUE_ONE ? damanVillagesArray[villageCode] : (district == VALUE_TWO ? diuVillagesArray[villageCode] : (district == VALUE_THREE ? dnhVillagesArray[villageCode] : [])));
        $('#com_addr_village_dmc_ward_for_cc').val(villageData);

        $("#billingtoo_for_cc").prop('checked', false);
        $('#per_addr_village_dmc_ward_for_cc').val('');
        $('#per_addr_city_for_cc').val('');
        $('#per_pincode_for_cc').val('');

        if (district == VALUE_ONE) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_cc');
            renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_cc');

            if (jQuery.inArray(villageCode, naniDamanVillageArray) != '-1') {
                $('#com_addr_city_for_cc').val(damanCityArray[VALUE_ONE]);
                var city_code = VALUE_ONE;

            } else if (jQuery.inArray(villageCode, motiDamanVillageArray) != '-1') {
                $('#com_addr_city_for_cc').val(damanCityArray[VALUE_TWO]);
                var city_code = VALUE_TWO;
            }

            var pincodeData = damanCityPincodeArray[city_code];
            $('#pincode_for_cc').val(pincodeData);
            $('#com_pincode_for_cc').val(pincodeData);

            generateSelect2();
        } else if (district == VALUE_TWO) {
            renderOptionsForTwoDimensionalArray(diuCityArray, 'com_addr_city_for_cc');
            renderOptionsForTwoDimensionalArray(diuCityArray, 'per_addr_city_for_cc');
            $('#com_addr_city_for_cc').val(diuCityArray[VALUE_ONE]);
            $('#pincode_for_cc').val('');
            $('#com_pincode_for_cc').val('');

        } else if (district == VALUE_THREE) {
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'com_addr_city_for_cc');
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'per_addr_city_for_cc');
            $('#com_addr_city_for_cc').val(dnhCityArray[VALUE_ONE]);
            $('#pincode_for_cc').val('');
            $('#com_pincode_for_cc').val('');
        }
    },
    nativeDistrictChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'native_place_village_for_cc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'native_place_village_for_cc');
    },
    nativeCityChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'father_city_for_cc');
        renderOptionsForTwoDimensionalArray([], 'father_native_place_village_for_cc');
        var city = obj.val();
        if (!city) {
            return false;
        }
        if (city != VALUE_ONE && city != VALUE_TWO && city != VALUE_THREE) {
            return false;
        }
        var cityData = city == VALUE_ONE ? damanCityArray : (city == VALUE_TWO ? diuNativeCityArray : (city == VALUE_THREE ? dnhCityArray : []));
        renderOptionsForTwoDimensionalArray(cityData, 'father_city_for_cc');
    },
    grandfatherNativeCityChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'grandfather_city_for_cc');
        renderOptionsForTwoDimensionalArray([], 'grandfather_native_place_village_for_cc');
        var city = obj.val();
        if (!city) {
            return false;
        }
        if (city != VALUE_ONE && city != VALUE_TWO && city != VALUE_THREE) {
            return false;
        }
        var cityData = city == VALUE_ONE ? damanCityArray : (city == VALUE_TWO ? diuNativeCityArray : (city == VALUE_THREE ? dnhCityArray : []));
        renderOptionsForTwoDimensionalArray(cityData, 'grandfather_city_for_cc');
    },
    nativeFamilyVillageChangeEvent: function (obj, fieldName) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], fieldName);
        var village = obj.val();
        alert(village);
        if (!village) {
            return false;
        }
        if (village != VALUE_ONE && village != VALUE_TWO && village != VALUE_THREE) {
            return false;
        }
        var villageData = village == VALUE_ONE ? damanVillageForNativeArray : (village == VALUE_TWO ? damanVillageForNativeArray : (village == VALUE_THREE ? diuVillagesForNativeArray : []));
        renderOptionsForTwoDimensionalArray(villageData, fieldName);
        alert(villageData);
    },
    downloadDeclaration: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var icId = $('#caste_certificate_id_for_cc_declaration').val();
        if (!icId) {
            validationMessageShow('caste-certificate-declaration_for_caste_certificate', invalidAccessValidationMessage);
            return false;
        }
        $('#cc_declaration_pdf').submit();
    },
    downloadExcelForCC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_ccge').val($('#app_no_for_caste_certificate_list').val());
        $('#app_date_for_ccge').val($('#application_date_for_caste_certificate_list').val());
        $('#app_details_for_ccge').val($('#app_details_for_caste_certificate_list').val());
        $('#vdw_for_ccge').val(tempTypeInSession != TEMP_TYPE_A ? $('#vdw_for_caste_certificate_list').val() : '');
        $('#status_for_ccge').val($('#status_for_caste_certificate_list').val());
        $('#qstatus_for_ccge').val($('#query_status_for_caste_certificate_list').val());
        $('#app_status_for_ccge').val($('#appointment_status_for_caste_certificate_list').val());
        $('#currently_on_for_ccge').val($('#currently_on_for_caste_certificate_list').val());
        $('#generate_excel_for_caste_certificate').submit();
        $('.ccge').val('');
    },
    addVerificationDocItem: function (docData, moduleId) {
        var that = this;
        docData.cnt = verifyDocCnt;
        docData.verification_type = moduleId;
        $('#upload_verification_doc_item_container_for_caste_certificate_' + moduleId).append(casteCertificateFieldVerificationDocItemTemplate(docData));
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
        formData.append('caste_certificate_id_for_caste_certificate_update_basic_detail', $('#caste_certificate_id_for_caste_certificate_update_basic_detail').val());
        formData.append('field_document_id_for_field_verification', $('#field_document_id_for_field_verification_' + tempCnt).val());
        formData.append('verification_type_for_field_verification', $('#verification_type_for_field_verification_' + tempCnt).val());
        formData.append('document_for_verification_document', $('#' + id)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/upload_field_verification_document',
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
        $('#' + documentFieldName + '_name_href_for_verification_document_' + cnt).attr('href', 'documents/caste_certificate/' + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_verification_document_' + cnt).html(VIEW_UPLODED_DOCUMENT);
        $('#' + documentFieldName + '_remove_btn_for_verification_document_' + cnt).attr('onclick', 'CasteCertificate.listview.askForRemoveDocForFieldVerification("' + docItemData.field_verification_document_id + '","' + cnt + '")');
    },
    askForRemoveDocForFieldVerification: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'CasteCertificate.listview.removeFieldDoc(' + fieldDocumentId + ', ' + cnt + ')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeFieldDoc: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'caste_certificate/remove_field_document',
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
        var yesEvent = 'CasteCertificate.listview.removeFieldItemRow(' + cnt + ')';
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
            url: 'caste_certificate/remove_field_document_item',
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(casteCertificateFieldVerificationViewDocItemTemplate(docDetail));
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(casteCertificateFieldVerificationViewDocItemTemplate(reDocDetail));
                if (reDocDetail['document'] != '') {
                    that.loadFieldDocForView(reDocDetail.cnt, 'document', 'field_reverification', reDocDetail.document);
                }
            });
        }
    },
    loadFieldDocForView: function (tempCnt, id, moduleType, docField) {
        $('#' + id + '_container_for_' + moduleType + '_view_' + tempCnt).hide();
        $('#' + id + '_name_container_for_' + moduleType + '_view_' + tempCnt).show();
        $('#' + id + '_name_href_for_' + moduleType + '_view_' + tempCnt).attr('href', 'documents/caste_certificate/' + docField);
        $('#' + id + '_name_for_' + moduleType + '_view_' + tempCnt).html(VIEW_UPLODED_DOCUMENT);
    },
});
