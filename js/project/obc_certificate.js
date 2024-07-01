var obcCertificateListTemplate = Handlebars.compile($('#obc_certificate_list_template').html());
var obcCertificateSearchTemplate = Handlebars.compile($('#obc_certificate_search_template').html());
var obcCertificateTableTemplate = Handlebars.compile($('#obc_certificate_table_template').html());
var obcCertificateActionTemplate = Handlebars.compile($('#obc_certificate_action_template').html());
var obcCertificateFormTemplate = Handlebars.compile($('#obc_certificate_form_template').html());
var obcCertificateViewTemplate = Handlebars.compile($('#obc_certificate_view_template').html());
var obcCertificateApproveTemplate = Handlebars.compile($('#obc_certificate_approve_template').html());
var obcCertificateRejectTemplate = Handlebars.compile($('#obc_certificate_reject_template').html());
var obcCertificateViewDocumentTemplate = Handlebars.compile($('#obc_certificate_view_document_template').html());
var obcCertificateAppointmentTemplate = Handlebars.compile($('#obc_certificate_set_appointment_template').html());
var obcCertificateBasicDetailTemplate = Handlebars.compile($('#obc_certificate_update_basic_detail_template').html());

var typeMajorObcCertificateFormTemplate = Handlebars.compile($('#type_mjor_obc_certificate_form_template').html());
var typeMinorObcCertificateFormTemplate = Handlebars.compile($('#type_minor_obc_certificate_form_template').html());

var obcCertificateFieldVerificationDocItemTemplate = Handlebars.compile($('#obc_certificate_field_verification_document_template').html());
var obcCertificateFieldVerificationViewDocItemTemplate = Handlebars.compile($('#obc_certificate_field_verification_view_document_template').html());

var tempVillageDataForOBC = [];
var tempMemberCnt = 1;
var tempACIData = [];
var tempMamData = [];
var searchOCF = {};

var ObcCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
ObcCertificate.Router = Backbone.Router.extend({
    routes: {
        'obc_certificate': 'renderList',
        'obc_certificate_form': 'renderListForForm',
        'edit_obc_certificate_form': 'renderList',
        'view_obc_certificate_form': 'renderList',
        'type_mjor_obc_certificate_form': 'renderListForTypeOne',
        'edit_type_mjor_obc_certificate_form': 'renderList',
        'type_minor_obc_certificate_form': 'renderListForTypeTwoA',
        'edit_type_minor_obc_certificate_form': 'renderList',

    },
    renderList: function () {
        ObcCertificate.listview.listPage();
    },
    renderListForForm: function () {
        ObcCertificate.listview.listPageObcCertificateForm();
    },
    renderListForTypeOne: function () {
        ObcCertificate.listview.listPageTypeMajorObcCertificateForm();
    },
    renderListForTypeTwoA: function () {
        ObcCertificate.listview.listPageTypeMinorObcCertificateForm();
    },

});
ObcCertificate.listView = Backbone.View.extend({
    el: 'div#main_container',

    events: {
        'click input[name="father_alive_for_obc_certificate"]': 'fatherAlive',
        'click input[name="mother_alive_for_obc_certificate"]': 'motherAlive',
        'click input[name="grandfather_alive_for_obc_certificate"]': 'grandfatherAlive',
        'click input[name="spouse_alive_for_obc_certificate"]': 'spouseAlive',
    },
    fatherAlive: function (event) {
        var val = $("input[name='father_alive_for_obc_certificate']:checked").val();
        if (val == '1') {
            $('.if_father_alive_item_container_for_obc_certificate').show();
            $('.f-gov-job').removeClass('d-none');
            $('.f-gov-job').show();
        } else {
            $('.if_father_alive_item_container_for_obc_certificate').hide();
            $('.f-gov-job').hide();
        }
        resetCounterForDocument('doc_no_for_obc_certificate', 33);
    },
    motherAlive: function (event) {
        var val = $("input[name='mother_alive_for_obc_certificate']:checked").val();
        if (val == '1') {
            $('.if_mother_alive_item_container_for_obc_certificate').show();
            $('.m-gov-job').removeClass('d-none');
            $('.m-gov-job').show();
        } else {
            $('.if_mother_alive_item_container_for_obc_certificate').hide();
            $('.m-gov-job').hide();
        }
    },
    grandfatherAlive: function (event) {
        var val = $("input[name='grandfather_alive_for_obc_certificate']:checked").val();
        if (val == '1') {
            $('.if_grandfather_alive_item_container_for_obc_certificate').show();
        } else {
            $('.if_grandfather_alive_item_container_for_obc_certificate').hide();
        }
    },
    spouseAlive: function (event) {
        var val = $("input[name='spouse_alive_for_obc_certificate']:checked").val();
        if (val == '1') {
            $('.if_spouse_alive_item_container_for_obc_certificate').show();
            $('.s-gov-job').removeClass('d-none');
            $('.s-gov-job').show();
        } else {
            $('.if_spouse_alive_item_container_for_obc_certificate').hide();
            $('.s-gov-job').hide();
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
        addClass('menu_obc_certificate', 'active');
        ObcCertificate.router.navigate('obc_certificate');
        var templateData = {};
        searchOCF = {};
        this.$el.html(obcCertificateListTemplate(templateData));
        this.loadObcCertificateData(sDistrict, sType);

    },
    listPageTypeMajorObcCertificateForm: function () {
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
        addClass('mam_obc_certificate', 'active');
        this.$el.html(obcCertificateListTemplate);
        this.typeMajorObcCertificateForm(false, {});
    },
    listPageTypeMinorObcCertificateForm: function () {
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
        addClass('mam_obc_certificate', 'active');
        this.$el.html(obcCertificateListTemplate);
        this.typeMinorObcCertificateForm(false, {});
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
        rowData.module_type = VALUE_ONE;
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
        return obcCertificateActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        var onlineStatement = appointmentData.online_statement == VALUE_ONE ? 'Online Statement' : '';
        var visitOffice = appointmentData.visit_office == VALUE_ONE ? 'Visit Office' : '';
        if (appointmentData.appointment_date == '0000-00-00') {
            return '<span id="appointment_container_' + appointmentData.obc_certificate_id + '" class="badge bg-warning app-status">Appointment Not Scheduled By Talathi</span>';
        }
        var returnString = '<span id="appointment_container_' + appointmentData.obc_certificate_id + '"><span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">' + onlineStatement;
        if (onlineStatement != '' && visitOffice != '') {
            returnString += ',<br>';
        }
        returnString += (visitOffice + '</span>');
        return returnString;
    },
    loadObcCertificateData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        ObcCertificate.router.navigate('obc_certificate');
        var searchData = dtomMam(sDistrict, sType, 'ObcCertificate.listview.loadObcCertificateData();');
        $('#obc_certificate_form_and_datatable_container').html(obcCertificateSearchTemplate(searchData));
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            renderOptionsForTwoDimensionalArray(appointmentFilterArray, 'appointment_status_for_obc_certificate_list', false);
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(currentlyOnTypeArray, 'currently_on_for_obc_certificate_list', false);
        }

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_obc_certificate_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_obc_certificate_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_obc_certificate_list', false);
        datePickerId('application_date_for_obc_certificate_list');

        if (tempTypeInSession != TEMP_TYPE_A) {
            var dwVillagesData = (tempDistrictInSession == VALUE_ONE ? damanVillagesArray : (tempDistrictInSession == VALUE_TWO ? diuVillagesArray : (tempDistrictInSession == VALUE_THREE ? dnhVillagesArray : [])));
            if (tempAVInSession != '') {
                var avData = tempAVInSession.split(',');
                renderOptionsForAVArray(avData, dwVillagesData, 'vdw_for_obc_certificate_list', false);
            } else {
                renderOptionsForTwoDimensionalArray(dwVillagesData, 'vdw_for_obc_certificate_list', false);
            }
        } else {
            if (typeof searchOCF.district_for_income_certificate_list != "undefined" && searchOCF.district_for_income_certificate_list != '' && searchOCF.village_for_income_certificate_list != '') {
                var villageData = (searchOCF.district_for_obc_certificate_list == VALUE_ONE ? damanVillagesArray : (searchOCF.district_for_obc_certificate_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_obc_certificate_list', false);
            }
        }

        $('#app_no_for_obc_certificate_list').val((typeof searchOCF.app_no_for_obc_certificate_list != "undefined" && searchOCF.app_no_for_obc_certificate_list != '') ? searchOCF.app_no_for_obc_certificate_list : '');
        $('#application_date_for_obc_certificate_list').val((typeof searchOCF.application_date_for_obc_certificate_list != "undefined" && searchOCF.application_date_for_obc_certificate_list != '') ? searchOCF.application_date_for_obc_certificate_list : searchData.s_appd);
        $('#app_details_for_obc_certificate_list').val((typeof searchOCF.app_details_for_obc_certificate_list != "undefined" && searchOCF.app_details_for_obc_certificate_list != '') ? searchOCF.app_details_for_obc_certificate_list : '');
        $('#appointment_status_for_obc_certificate_list').val((typeof searchOCF.appointment_status_for_obc_certificate_list != "undefined" && searchOCF.appointment_status_for_obc_certificate_list != '') ? searchOCF.appointment_status_for_obc_certificate_list : searchData.s_app_status);
        $('#query_status_for_obc_certificate_list').val((typeof searchOCF.query_status_for_obc_certificate_list != "undefined" && searchOCF.query_status_for_obc_certificate_list != '') ? searchOCF.query_status_for_obc_certificate_list : searchData.s_qstatus);
        $('#status_for_obc_certificate_list').val((typeof searchOCF.status_for_obc_certificate_list != "undefined" && searchOCF.status_for_obc_certificate_list != '') ? searchOCF.status_for_obc_certificate_list : searchData.s_status);
        $('#currently_on_for_obc_certificate_list').val((typeof searchOCF.currently_on_for_obc_certificate_list != "undefined" && searchOCF.currently_on_for_obc_certificate_list != '') ? searchOCF.currently_on_for_obc_certificate_list : searchData.s_co_hand);
        $('#district_for_obc_certificate_list').val((typeof searchOCF.district_for_obc_certificate_list != "undefined" && searchOCF.district_for_obc_certificate_list != '') ? searchOCF.district_for_obc_certificate_list : searchData.search_district);
        $('#vdw_for_obc_certificate_list').val((typeof searchOCF.vdw_for_obc_certificate_list != "undefined" && searchOCF.vdw_for_obc_certificate_list != '') ? searchOCF.vdw_for_obc_certificate_list : '');
        $('#is_full_for_obc_certificate_list').val((typeof searchOCF.is_full_for_obc_certificate_list != "undefined" && searchOCF.is_full_for_obc_certificate_list != '') ? searchOCF.is_full_for_obc_certificate_list : searchData.s_is_full);

        this.searchObcCertificateData();
    },
    searchObcCertificateData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#obc_certificate_datatable_container').html(obcCertificateTableTemplate);
        var searchData = $('#search_obc_certificate_form').serializeFormJSON();

        searchOCF = searchData;
        if (typeof btnObj == "undefined" && (searchOCF.app_details_for_obc_certificate_list == ''
                && searchOCF.app_no_for_obc_certificate_list == ''
                && searchOCF.application_date_for_obc_certificate_list == ''
                && searchOCF.appointment_status_for_obc_certificate_list == ''
                && searchOCF.query_status_for_obc_certificate_list == ''
                && searchOCF.status_for_obc_certificate_list == ''
                && searchOCF.is_full_for_obc_certificate_list == ''
                && (searchOCF.district_for_obc_certificate_list == '' || typeof searchOCF.district_for_obc_certificate_list == "undefined")
                && (searchOCF.vdw_for_obc_certificate_list == '' || typeof searchOCF.vdw_for_obc_certificate_list == "undefined")
                && (searchOCF.currently_on_for_obc_certificate_list == '' || typeof searchOCF.currently_on_for_obc_certificate_list == "undefined"))) {
            obcCertificateDataTable = $('#obc_certificate_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#obc_certificate_datatable_filter').remove();
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
            return '<div id="movement_for_ic_list_' + data + '">' + movementStringMigrant(full) + '</div>';
        };
        $('#obc_certificate_datatable_container').html(obcCertificateTableTemplate);
        obcCertificateDataTable = $('#obc_certificate_datatable').DataTable({
            ajax: {
                url: 'obc_certificate/get_obc_certificate_data',
                dataSrc: "obc_certificate_data",
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
                {data: '', 'class': 'v-a-t f-s-app-details', 'render': appDetailsRenderer},
                {data: 'district', 'class': 'v-a-t text-center f-s-app-details', 'render': distVillRenderer},
                {data: 'obc_certificate_id', 'class': 'v-a-t text-center', 'render': appointmentRenderer},
                {data: 'obc_certificate_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'obc_certificate_id', 'class': 'v-a-t text-center', 'render': queryStatusRenderer},
                {data: 'obc_certificate_id', 'class': 'v-a-t text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "fnRowCallback": aciNR,
            "initComplete": searchableDatatable
        });
        $('#obc_certificate_datatable_filter').remove();
        $('#obc_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = obcCertificateDataTable.row(tr);

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
    partAFChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('.father_other_occupation_div_for_oc').hide();
        $('.f-gov-job').hide();
        var fOccupation = obj.val();
        if (!fOccupation) {
            return false;
        }
        if (fOccupation == fOccupation == VALUE_ONE || fOccupation == VALUE_TWO || fOccupation == VALUE_THREE || fOccupation == VALUE_FOUR || fOccupation == VALUE_FIVE || fOccupation == VALUE_SIX || fOccupation == VALUE_SEVEN || fOccupation == VALUE_EIGHT || fOccupation == VALUE_NINE || fOccupation == VALUE_TEN || fOccupation == VALUE_ELEVEN || fOccupation == VALUE_TWELVE || fOccupation == VALUE_THIRTEEN) {
            $('.f-gov-job').removeClass('d-none');
            $('.f-gov-job').show();
            $('.part_a_div').show();
            $('.part_b_div').show();
            $('.part_c_div').show();
            $('.part_d_div').show();
            $('.part_e_div').show();
            $('.part_f_div').show();
        }
        if (fOccupation == VALUE_TWELVE) {
            $('.father_other_occupation_div_for_oc').show();
        }
    },
    partAMChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('.mother_other_occupation_div_for_oc').hide();
        $('.m-gov-job').hide();
        var fOccupation = obj.val();
        if (!fOccupation) {
            return false;
        }
        if (fOccupation == fOccupation == VALUE_ONE || fOccupation == VALUE_TWO || fOccupation == VALUE_THREE || fOccupation == VALUE_FIVE || fOccupation == VALUE_SIX || fOccupation == VALUE_SEVEN || fOccupation == VALUE_EIGHT || fOccupation == VALUE_NINE || fOccupation == VALUE_TEN || fOccupation == VALUE_ELEVEN || fOccupation == VALUE_TWELVE || fOccupation == VALUE_THIRTEEN) {
            $('.m-gov-job').removeClass('d-none');
            $('.m-gov-job').show();
            $('.part_a_div').show();
            $('.part_b_div').show();
            $('.part_c_div').show();
            $('.part_d_div').show();
            $('.part_e_div').show();
            $('.part_f_div').show();
        }
        if (fOccupation == VALUE_TWELVE) {
            $('.mother_other_occupation_div_for_oc').show();
        }
        if (fOccupation == VALUE_FOUR) {
            $('.mother_seaman_annual_income_div_for_oc').hide();
            // $('.m-gov-job').removeClass('d-none');
            // $('.m-gov-job').hide();
        } else
        {
            $('.mother_seaman_annual_income_div_for_oc').show();
        }
    },
    partASChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('.spouse_other_occupation_div_for_oc').hide();
        $('.s-gov-job').hide();
        var fOccupation = obj.val();
        if (!fOccupation) {
            return false;
        }
        if (fOccupation == fOccupation == VALUE_ONE || fOccupation == VALUE_TWO || fOccupation == VALUE_THREE || fOccupation == VALUE_FOUR || fOccupation == VALUE_FIVE || fOccupation == VALUE_SIX || fOccupation == VALUE_SEVEN || fOccupation == VALUE_EIGHT || fOccupation == VALUE_NINE || fOccupation == VALUE_TEN || fOccupation == VALUE_ELEVEN || fOccupation == VALUE_TWELVE || fOccupation == VALUE_THIRTEEN) {
            $('.s-gov-job').removeClass('d-none');
            $('.s-gov-job').show();
            $('.part_a_div').show();
            $('.part_b_div').show();
            $('.part_c_div').show();
            $('.part_d_div').show();
            $('.part_e_div').show();
            $('.part_f_div').show();
        }
        if (fOccupation == VALUE_TWELVE) {
            $('.spouse_other_occupation_div_for_oc').show();
        }
    },
    getYearlyIncomeTotal: function () {
        var totalIncome = 0;

        var father = ($('#father_annual_income_for_oc').val() == '' ? 0 : $('#father_annual_income_for_oc').val());
        var mother = ($('#mother_annual_income_for_oc').val() == '' ? 0 : $('#mother_annual_income_for_oc').val());
        var spouse = ($('#spouse_annual_income_for_oc').val() == '' ? 0 : $('#spouse_annual_income_for_oc').val());

        var yearlyIncome = parseFloat(father) + parseFloat(mother) + parseFloat(spouse);

        totalIncome += (yearlyIncome ? yearlyIncome : 0);

        $('#family_annual_income').val(totalIncome);
    },
    getYearlyIncomeTotalforMinor: function () {
        var totalIncome = 0;

        var father = ($('#father_annual_income_for_oc').val() == '' ? 0 : $('#father_annual_income_for_oc').val());
        var mother = ($('#mother_annual_income_for_oc').val() == '' ? 0 : $('#mother_annual_income_for_oc').val());


        var yearlyIncome = parseFloat(father) + parseFloat(mother);

        totalIncome += (yearlyIncome ? yearlyIncome : 0);

        $('#family_annual_income').val(totalIncome);
    },
    newObcCertificateForm: function (parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        ObcCertificate.router.navigate('edit_obc_certificate_form');
        tempMemberCnt = 1;

        var formData = parseData.obc_certificate_data;
        formData.is_checked = isChecked;
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
        formData.VALUE_ELEVEN = VALUE_ELEVEN;
        formData.VALUE_TWELVE = VALUE_TWELVE;
        formData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        formData.IS_CHECKED_YES = IS_CHECKED_YES;
        formData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;

        formData.affidavit_date = dateTo_DD_MM_YYYY(formData.affidavit_date);
        formData.date = dateTo_DD_MM_YYYY(formData.date);
        formData.applicant_dob_text = formData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(formData.applicant_dob) : '';
        formData.f_designation = parseData['obc_certificate_data'].family_designation ? JSON.parse(parseData['obc_certificate_data'].family_designation) : '';
        formData.f_services = parseData['obc_certificate_data'].family_services ? JSON.parse(parseData['obc_certificate_data'].family_services) : '';
        formData.f_designation_b = parseData['obc_certificate_data'].family_designation_b ? JSON.parse(parseData['obc_certificate_data'].family_designation_b) : '';
        formData.f_scale_of_pay = parseData['obc_certificate_data'].family_scale_of_pay ? JSON.parse(parseData['obc_certificate_data'].family_scale_of_pay) : '';
        formData.f_appointment_date = parseData['obc_certificate_data'].family_appointment_date ? JSON.parse(parseData['obc_certificate_data'].family_appointment_date) : '';
        formData.f_promotion_age = parseData['obc_certificate_data'].family_promotion_age ? JSON.parse(parseData['obc_certificate_data'].family_promotion_age) : '';
        formData.f_organization_name = parseData['obc_certificate_data'].family_organization_name ? JSON.parse(parseData['obc_certificate_data'].family_organization_name) : '';
        formData.f_designation_b1 = parseData['obc_certificate_data'].family_designation_b1 ? JSON.parse(parseData['obc_certificate_data'].family_designation_b1) : '';
        formData.f_service_period = parseData['obc_certificate_data'].family_service_period ? JSON.parse(parseData['obc_certificate_data'].family_service_period) : '';
        formData.f_permanent_incapacitation_service = parseData['obc_certificate_data'].family_permanent_incapacitation_service ? JSON.parse(parseData['obc_certificate_data'].family_permanent_incapacitation_service) : '';
        formData.f_permanent_incapacitation = parseData['obc_certificate_data'].family_permanent_incapacitation ? JSON.parse(parseData['obc_certificate_data'].family_permanent_incapacitation) : '';
        formData.f_organization_name_partc = parseData['obc_certificate_data'].family_organization_name_partc ? JSON.parse(parseData['obc_certificate_data'].family_organization_name_partc) : '';
        formData.f_designation_partc = parseData['obc_certificate_data'].family_designation_partc ? JSON.parse(parseData['obc_certificate_data'].family_designation_partc) : '';
        formData.f_date_of_appointmet_partc = parseData['obc_certificate_data'].family_date_of_appointmet_partc ? JSON.parse(parseData['obc_certificate_data'].family_date_of_appointmet_partc) : '';
        formData.f_designation_partd = parseData['obc_certificate_data'].family_designation_partd ? JSON.parse(parseData['obc_certificate_data'].family_designation_partd) : '';
        formData.f_scale_of_pay_partd = parseData['obc_certificate_data'].family_scale_of_pay_partd ? JSON.parse(parseData['obc_certificate_data'].family_scale_of_pay_partd) : '';
        formData.f_occupation = parseData['obc_certificate_data'].family_occupation ? JSON.parse(parseData['obc_certificate_data'].family_occupation) : '';
        formData.f_agricultural_land = parseData['obc_certificate_data'].family_agricultural_land ? JSON.parse(parseData['obc_certificate_data'].family_agricultural_land) : '';
        formData.f_location = parseData['obc_certificate_data'].family_location ? JSON.parse(parseData['obc_certificate_data'].family_location) : '';
        formData.f_size_of_holding = parseData['obc_certificate_data'].family_size_of_holding ? JSON.parse(parseData['obc_certificate_data'].family_size_of_holding) : '';
        formData.f_irrigated = parseData['obc_certificate_data'].family_irrigated ? JSON.parse(parseData['obc_certificate_data'].family_irrigated) : '';
        formData.f_perecentage_of_irrigated = parseData['obc_certificate_data'].family_perecentage_of_irrigated ? JSON.parse(parseData['obc_certificate_data'].family_perecentage_of_irrigated) : '';
        formData.f_ceiling_low = parseData['obc_certificate_data'].family_ceiling_low ? JSON.parse(parseData['obc_certificate_data'].family_ceiling_low) : '';
        formData.f_total_percentage = parseData['obc_certificate_data'].family_total_percentage ? JSON.parse(parseData['obc_certificate_data'].family_total_percentage) : '';
        formData.f_crops = parseData['obc_certificate_data'].family_crops ? JSON.parse(parseData['obc_certificate_data'].family_crops) : '';
        formData.f_location_partf = parseData['obc_certificate_data'].family_location_partf ? JSON.parse(parseData['obc_certificate_data'].family_location_partf) : '';
        formData.f_area_plantation = parseData['obc_certificate_data'].family_area_plantation ? JSON.parse(parseData['obc_certificate_data'].family_area_plantation) : '';
        formData.f_location_property = parseData['obc_certificate_data'].family_location_property ? JSON.parse(parseData['obc_certificate_data'].family_location_property) : '';
        formData.f_details = parseData['obc_certificate_data'].family_details ? JSON.parse(parseData['obc_certificate_data'].family_details) : '';
        formData.f_use_to_which = parseData['obc_certificate_data'].family_use_to_which ? JSON.parse(parseData['obc_certificate_data'].family_use_to_which) : '';

        $('#obc_certificate_form_and_datatable_container').html(obcCertificateFormTemplate(formData));

        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {

            renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_obc_certificate');
            $('#district').val(formData.district);
        }

        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        generateBoxes('radio', genderArray, 'gender', 'oc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'oc', formData.marital_status, false, false);
        showSubContainer('marital_status', 'oc', '.spouse_info_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'obc_certificate', formData.have_you_own_house, false, false);
        generateBoxes('radio', yesNoArray, 'if_grandfather_having_document', 'obc_certificate', formData.if_grandfather_having_document, false, false);
        showSubContainer('if_grandfather_having_document', 'obc_certificate', '.if_grandfather_birth_document_item', VALUE_ONE, 'radio');
        showSubContainer('if_grandfather_having_document', 'obc_certificate', '.if_grandfather_property_document_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'tax_payer', 'obc_certificate', formData.tax_payer, false, false);
        showSubContainer('tax_payer', 'obc_certificate', '.tax_payer_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'wealth_tax', 'obc_certificate', formData.wealth_tax, false, false);
        showSubContainer('wealth_tax', 'obc_certificate', '.wealth_tax_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'father_alive', 'obc_certificate', formData.father_alive, false, false);
        showSubContainer('father_alive', 'obc_certificate', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'obc_certificate', '.father_death_proof_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'obc_certificate', formData.mother_alive, false, false);
        generateBoxes('radio', yesNoArray, 'grandfather_alive', 'obc_certificate', formData.grandfather_alive, false, false);
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'obc_certificate', formData.spouse_alive, false, false);



        var district = formData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_oc');
        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'father_native_place_village_for_oc');
        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'grandfather_native_place_village_for_oc');
        renderOptionsForTwoDimensionalArray(damanVillagesArray, 'grandfather_born_place_village_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'grandfather_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_oc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'obccaste_for_oc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'father_caste_for_oc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'grandfather_caste_for_oc');
        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relationship_of_applicant_for_oc');
        renderOptionsForTwoDimensionalArray(educationTypeArray, 'applicant_education_for_oc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'commu_add_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'per_add_state_for_oc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'native_place_state_for_oc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');

        if (formData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
            $('.f-gov-job').removeClass('d-none');
            $('.f-gov-job').show();
        }
        if (formData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
            $('.m-gov-job').removeClass('d-none');
            $('.m-gov-job').show();
        }
        if (formData.marital_status == VALUE_ONE) {
            if (formData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                $('.s-gov-job').removeClass('d-none');
                $('.s-gov-job').show();
            }


            $('#commu_add_state_for_oc').val(formData.commu_add_state == 0 ? '' : formData.commu_add_state);

            var districtData = tempDistrictData[formData.commu_add_state] ? tempDistrictData[formData.commu_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'commu_add_district_for_oc', 'district_code', 'district_name', 'District');
            $('#commu_add_district_for_oc').val(formData.commu_add_district == 0 ? '' : formData.commu_add_district);

            that.getEditVillageData(formData.commu_add_state, formData.commu_add_district, 'oc', formData.commu_add_village, 'commu_add');

            $('#per_add_state_for_oc').val(formData.per_add_state == 0 ? '' : formData.per_add_state);

            var districtData = tempDistrictData[formData.per_add_state] ? tempDistrictData[formData.per_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_add_district_for_oc', 'district_code', 'district_name', 'District');
            $('#per_add_district_for_oc').val(formData.per_add_district == 0 ? '' : formData.per_add_district);

            that.getEditVillageData(formData.per_add_state, formData.per_add_district, 'oc', formData.per_add_village, 'per_add');

            $('#born_place_state_for_oc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);

            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_oc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);

            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'oc', formData.born_place_village, 'born_place');

            $('#native_place_state_for_oc').val(formData.native_place_state == 0 ? '' : formData.native_place_state);

            var districtData = tempDistrictData[formData.native_place_state] ? tempDistrictData[formData.native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'native_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#native_place_district_for_oc').val(formData.native_place_district == 0 ? '' : formData.native_place_district);

            that.getEditVillageData(formData.native_place_state, formData.native_place_district, 'oc', formData.native_place_village, 'native_place');

            $('#constitution_artical').val(formData.constitution_artical);
            that.getConstitution(constitution_artical);
            $('#com_addr_city_for_oc').val(formData.com_addr_city);
            $('#per_addr_city_for_oc').val(formData.per_addr_city);
            $('#select_required_purpose_for_oc').val(formData.select_required_purpose);
            $('#village_name_for_oc').val(formData.village_name);
            $('#applicant_education_for_oc').val(formData.applicant_education);


            if (formData.billingtoo == isChecked) {
                $('#billingtoo_for_oc').attr('checked', 'checked');
            }

            $('.father_info_div').collapse().show();
            $('.mother_info_div').collapse().show();
            $('.grandfather_info_div').collapse().show();
            if (formData.marital_status == VALUE_ONE)
                $('.spouse_info_div').collapse().show();
            $('.part_a_div').collapse().show();
            $('.part_b_div').collapse().show();
            $('.part_c_div').collapse().show();
            $('.part_d_div').collapse().show();
            $('.part_e_div').collapse().show();
            $('.part_f_div').collapse().show();
            $('.part_g_div').collapse().show();

            $('#declaration_for_obc_certificate').attr('checked', 'checked');
            $('#declaration').attr('checked', 'checked');
            $('#occupation_for_oc').val(formData.occupation);
            $('#nearest_police_station_for_oc').val(formData.nearest_police_station);
            $('#obccaste_for_oc').val(formData.obccaste);
            $('#father_caste_for_oc').val(formData.father_caste);
            $('#mother_caste_for_oc').val(formData.mother_caste);
            $('#grandfather_caste_for_oc').val(formData.grandfather_caste);
            $('#spouse_caste_for_oc').val(formData.spouse_caste);
            $('#relationship_of_applicant_for_oc').val(formData.relationship_of_applicant);


            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_oc').show();
            $('#district').val(formData.district);

            $('#declaration_for_obc_certificate').attr('checked', 'checked');
            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_oc').show();

            $('#father_born_place_state_for_oc').val(formData.father_born_place_state == 0 ? '' : formData.father_born_place_state);

            var districtData = tempDistrictData[formData.father_born_place_state] ? tempDistrictData[formData.father_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#father_born_place_district_for_oc').val(formData.father_born_place_district == 0 ? '' : formData.father_born_place_district);

            if (formData.father_born_place_state != VALUE_ZERO)
                that.getEditVillageData(formData.father_born_place_state, formData.father_born_place_district, 'oc', formData.father_born_place_village, 'father_born_place');


            $('#father_city_for_oc').val(formData.father_city);
            //  $('#father_native_place_state_for_oc').val(formData.father_native_place_state);
            $('#father_native_place_district_for_oc').val(formData.father_native_place_district);
            $('#father_native_place_village_for_oc').val(formData.father_native_place_village);
            $('#father_occupation_for_oc').val(formData.father_occupation);

            if (formData.father_occupation == VALUE_TWELVE)
                $('.father_other_occupation_div_for_oc').show();


            $('#grandfather_borncity_for_oc').val(formData.grandfather_borncity);
            $('#grandfather_born_place_district_for_oc').val(formData.grandfather_born_place_district);
            $('#grandfather_born_place_village_for_oc').val(formData.grandfather_born_place_village);

            $('#grandfather_city_for_oc').val(formData.grandfather_city);
            $('#grandfather_native_place_district_for_oc').val(formData.grandfather_native_place_district);
            $('#grandfather_native_place_village_for_oc').val(formData.grandfather_native_place_village);
            $('#grandfather_occupation_for_oc').val(formData.grandfather_occupation);

            if (formData.grandfather_occupation == VALUE_TWELVE)
                $('.grandfather_other_occupation_div_for_oc').show();


            $('#mother_born_place_state_for_oc').val(formData.mother_born_place_state == 0 ? '' : formData.mother_born_place_state);

            var districtData = tempDistrictData[formData.mother_born_place_state] ? tempDistrictData[formData.mother_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#mother_born_place_district_for_oc').val(formData.mother_born_place_district == 0 ? '' : formData.mother_born_place_district);

            if (formData.mother_born_place_state != VALUE_ZERO)
                that.getEditVillageData(formData.mother_born_place_state, formData.mother_born_place_district, 'oc', formData.mother_born_place_village, 'mother_born_place');

            $('#mother_native_place_state_for_oc').val(formData.mother_native_place_state == 0 ? '' : formData.mother_native_place_state);

            var districtData = tempDistrictData[formData.mother_native_place_state] ? tempDistrictData[formData.mother_native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_native_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#mother_native_place_district_for_oc').val(formData.mother_native_place_district == 0 ? '' : formData.mother_native_place_district);

            if (formData.mother_native_place_state != VALUE_ZERO)
                that.getEditVillageData(formData.mother_native_place_state, formData.mother_native_place_district, 'oc', formData.mother_native_place_village, 'mother_native_place');

            $('#mother_city_for_oc').val(formData.mother_city);
            $('#mother_occupation_for_oc').val(formData.mother_occupation);

            if (formData.mother_occupation == VALUE_TWELVE)
                $('.mother_other_occupation_div_for_oc').show();

            if (formData.marital_status == VALUE_ONE) {
                $('#spouse_born_place_state_for_oc').val(formData.spouse_born_place_state == 0 ? '' : formData.spouse_born_place_state);

                var districtData = tempDistrictData[formData.spouse_born_place_state] ? tempDistrictData[formData.spouse_born_place_state] : [];
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_born_place_district_for_oc', 'district_code', 'district_name', 'District');
                $('#spouse_born_place_district_for_oc').val(formData.spouse_born_place_district == 0 ? '' : formData.spouse_born_place_district);

                if (formData.spouse_born_place_state != VALUE_ZERO)
                    that.getEditVillageData(formData.spouse_born_place_state, formData.spouse_born_place_district, 'oc', formData.spouse_born_place_village, 'spouse_born_place');

                $('#spouse_native_place_state_for_oc').val(formData.spouse_native_place_state == 0 ? '' : formData.spouse_native_place_state);

                var districtData = tempDistrictData[formData.spouse_native_place_state] ? tempDistrictData[formData.spouse_native_place_state] : [];
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_native_place_district_for_oc', 'district_code', 'district_name', 'District');
                $('#spouse_native_place_district_for_oc').val(formData.spouse_native_place_district == 0 ? '' : formData.spouse_native_place_district);

                if (formData.spouse_native_place_state != VALUE_ZERO)
                    that.getEditVillageData(formData.spouse_native_place_state, formData.spouse_native_place_district, 'oc', formData.spouse_native_place_village, 'spouse_native_place');

                $('#spouse_city_for_oc').val(formData.spouse_city);
                $('#spouse_occupation_for_oc').val(formData.spouse_occupation);

                if (formData.spouse_occupation == VALUE_TWELVE)
                    $('.spouse_other_occupation_div_for_oc').show();
            }

            var val = formData.constitution_artical;


            if (formData.tax_payer_copy != '') {
                that.showDocument('tax_payer_copy_container_for_obc_certificate', 'tax_payer_copy_name_image_for_obc_certificate', 'tax_payer_copy_name_container_for_obc_certificate',
                        'tax_payer_copy_download', 'tax_payer_copy', formData.tax_payer_copy, formData.obc_certificate_id, VALUE_ONE);
            }

            if (formData.self_birth_certificate_doc != '') {
                that.showDocument('self_birth_certificate_doc_container_for_obc_certificate', 'self_birth_certificate_doc_name_image_for_obc_certificate', 'self_birth_certificate_doc_name_container_for_obc_certificate',
                        'self_birth_certificate_doc_download', 'self_birth_certificate_doc', formData.self_birth_certificate_doc, formData.obc_certificate_id, VALUE_TWO);
            }

            if (formData.father_certificate_doc != '') {
                that.showDocument('father_certificate_doc_container_for_obc_certificate', 'father_certificate_doc_name_image_for_obc_certificate', 'father_certificate_doc_name_container_for_obc_certificate',
                        'father_certificate_doc_download', 'father_certificate_doc', formData.father_certificate_doc, formData.obc_certificate_id, VALUE_THREE);
            }

            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_obc_certificate', 'father_election_card_name_image_for_obc_certificate', 'father_election_card_name_container_for_obc_certificate',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.obc_certificate_id, VALUE_FOUR);
            }

            if (formData.father_aadhar_card != '') {
                that.showDocument('father_aadhar_card_container_for_obc_certificate', 'father_aadhar_card_name_image_for_obc_certificate', 'father_aadhar_card_name_container_for_obc_certificate',
                        'father_aadhar_card_download', 'father_aadhar_card', formData.father_aadhar_card, formData.obc_certificate_id, VALUE_FIVE);
            }

            if (formData.grandfather_birth_certificate_doc != '') {
                that.showDocument('grandfather_birth_certificate_doc_container_for_obc_certificate', 'grandfather_birth_certificate_doc_name_image_for_obc_certificate', 'grandfather_birth_certificate_doc_name_container_for_obc_certificate',
                        'grandfather_birth_certificate_doc_download', 'grandfather_birth_certificate_doc', formData.grandfather_birth_certificate_doc, formData.obc_certificate_id, VALUE_SIX);
            }

            if (formData.grandfather_property_doc != '') {
                that.showDocument('grandfather_property_doc_container_for_obc_certificate', 'grandfather_property_doc_name_image_for_obc_certificate', 'grandfather_property_doc_name_container_for_obc_certificate',
                        'grandfather_property_doc_download', 'grandfather_property_doc', formData.grandfather_property_doc, formData.obc_certificate_id, VALUE_SEVEN);
            }

            if (formData.father_community_death_doc != '') {
                that.showDocument('father_community_death_doc_container_for_obc_certificate', 'father_community_death_doc_name_image_for_obc_certificate', 'father_community_death_doc_name_container_for_obc_certificate',
                        'father_community_death_doc_download', 'father_community_death_doc', formData.father_community_death_doc, formData.obc_certificate_id, VALUE_EIGHT);
            }

            if (formData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_obc_certificate', 'aadhar_card_doc_name_image_for_obc_certificate', 'aadhar_card_doc_name_container_for_obc_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.obc_certificate_id, VALUE_TEN);
            }

            if (formData.community_certificate_doc != '') {
                that.showDocument('community_certificate_doc_container_for_obc_certificate', 'community_certificate_doc_name_image_for_obc_certificate', 'community_certificate_doc_name_container_for_obc_certificate',
                        'community_certificate_doc_download', 'community_certificate_doc', formData.community_certificate_doc, formData.obc_certificate_id, VALUE_ELEVEN);
            }

            if (formData.income_certificate != '') {
                that.showDocument('income_certificate_container_for_obc_certificate', 'income_certificate_name_image_for_obc_certificate', 'income_certificate_name_container_for_obc_certificate',
                        'income_certificate_download', 'income_certificate', formData.income_certificate, formData.obc_certificate_id, VALUE_TWELVE);
            }

            if (formData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_obc_certificate', 'applicant_photo_doc_name_image_for_obc_certificate', 'applicant_photo_doc_name_container_for_obc_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.obc_certificate_id, VALUE_THIRTEEN);
            }

            if (formData.father_alive == VALUE_ONE) {
                $('.father_proof_item_container_for_obc_certificate').show();
                $('.father_death_proof_item_container_for_obc_certificate').hide();
            } else if (formData.father_alive == VALUE_TWO) {
                $('.father_proof_item_container_for_obc_certificate').hide();
                $('.father_death_proof_item_container_for_obc_certificate').show();
            }

            if (formData.father_alive == VALUE_ONE) {
                $("#father_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#father_alive_for_obc_certificate_2").prop("checked", true);
            }

            if (formData.mother_alive == VALUE_ONE) {
                $("#mother_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#mother_alive_for_obc_certificate_2").prop("checked", true);
            }

            if (formData.grandfather_alive == VALUE_ONE) {
                $("#grandfather_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#grandfather_alive_for_obc_certificate_2").prop("checked", true);
            }

            if (formData.spouse_alive == VALUE_ONE) {
                $("#spouse_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#spouse_alive_for_obc_certificate_2").prop("checked", true);
            }
        }

        generateSelect2();
        datePicker();
        datePickerToday('applicant_dob_for_oc');

        if (formData.date != '0000-00-00') {
            $('#date_for_oc').val(dateTo_DD_MM_YYYY(formData.date));
        }
        $('#obc_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.askForSubmitObcCertificate(VALUE_TWO);
            }
        });
    },
    fatherDetailsForm: function (obcCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        ObcCertificate.router.navigate('father_details/' + obcCertificateData.encrypt_id);
        obcCertificateData.VALUE_ONE = VALUE_ONE;
        obcCertificateData.VALUE_TWO = VALUE_TWO;
        $('#obc_certificate_form_and_datatable_container').html(obc_certificateFatherDetailsTemplate(obcCertificateData));
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_oc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'father_born_place_district_for_oc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'father_native_place_district_for_oc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'father_born_place_village_for_oc', 'village_code', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'father_native_place_village_for_oc', 'village_code', 'village_name', 'Village');


        $('#father_born_place_state_for_oc').val(obcCertificateData.father_born_place_state == 0 ? '' : obcCertificateData.father_born_place_state);

        var districtData = tempDistrictData[obcCertificateData.father_born_place_state] ? tempDistrictData[obcCertificateData.father_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_oc', 'district_code', 'district_name', 'District');
        $('#father_born_place_district_for_oc').val(obcCertificateData.father_born_place_district == 0 ? '' : obcCertificateData.father_born_place_district);

        that.getEditVillageData(obcCertificateData.father_born_place_state, obcCertificateData.father_born_place_district, 'oc', obcCertificateData.father_born_place_village, 'father_born_place');

        $('#father_native_place_state_for_oc').val(obcCertificateData.father_native_place_state == 0 ? '' : obcCertificateData.father_native_place_state);

        var districtData = tempDistrictData[obcCertificateData.father_native_place_state] ? tempDistrictData[obcCertificateData.father_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_native_place_district_for_oc', 'district_code', 'district_name', 'District');
        $('#father_native_place_district_for_oc').val(obcCertificateData.father_native_place_district == 0 ? '' : obcCertificateData.father_native_place_district);

        that.getEditVillageData(obcCertificateData.father_native_place_state, obcCertificateData.father_native_place_district, 'oc', obcCertificateData.father_native_place_village, 'father_native_place');

        $('#father_city_for_oc').val(obcCertificateData.father_city);
        $('#father_occupation_for_oc').val(obcCertificateData.father_occupation);

        if (obcCertificateData.father_occupation == VALUE_TWELVE)
            $('.father_other_occupation_div_for_oc').show();

        datePicker();
        generateSelect2();
        $('#father_details_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },
    motherDetailsForm: function (obcCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        ObcCertificate.router.navigate('mother_details/' + obcCertificateData.encrypt_id);
        obcCertificateData.VALUE_ONE = VALUE_ONE;
        obcCertificateData.VALUE_TWO = VALUE_TWO;
        $('#obc_certificate_form_and_datatable_container').html(obc_certificateMotherDetailsTemplate(obcCertificateData));
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_oc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'mother_born_place_district_for_oc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'mother_native_place_district_for_oc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'mother_born_place_village_for_oc', 'village_code', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'mother_native_place_village_for_oc', 'village_code', 'village_name', 'Village');



        $('#mother_born_place_state_for_oc').val(obcCertificateData.mother_born_place_state == 0 ? '' : obcCertificateData.mother_born_place_state);

        var districtData = tempDistrictData[obcCertificateData.mother_born_place_state] ? tempDistrictData[obcCertificateData.mother_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_oc', 'district_code', 'district_name', 'District');
        $('#mother_born_place_district_for_oc').val(obcCertificateData.mother_born_place_district == 0 ? '' : obcCertificateData.mother_born_place_district);

        that.getEditVillageData(obcCertificateData.mother_born_place_state, obcCertificateData.mother_born_place_district, 'oc', obcCertificateData.mother_born_place_village, 'mother_born_place');

        $('#mother_native_place_state_for_oc').val(obcCertificateData.mother_native_place_state == 0 ? '' : obcCertificateData.mother_native_place_state);

        var districtData = tempDistrictData[obcCertificateData.mother_native_place_state] ? tempDistrictData[obcCertificateData.mother_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_native_place_district_for_oc', 'district_code', 'district_name', 'District');
        $('#mother_native_place_district_for_oc').val(obcCertificateData.mother_native_place_district == 0 ? '' : obcCertificateData.mother_native_place_district);

        that.getEditVillageData(obcCertificateData.mother_native_place_state, obcCertificateData.mother_native_place_district, 'oc', obcCertificateData.mother_native_place_village, 'mother_native_place');

        $('#mother_city_for_oc').val(obcCertificateData.mother_city);
        $('#mother_occupation_for_oc').val(obcCertificateData.mother_occupation);

        if (obcCertificateData.mother_occupation == VALUE_TWELVE)
            $('.mother_other_occupation_div_for_oc').show();

        datePicker();
        generateSelect2();
        $('#mother_details_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },

    grandfatherDetailsForm: function (obcCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        ObcCertificate.router.navigate('grandfather_details/' + obcCertificateData.encrypt_id);
        obcCertificateData.VALUE_ONE = VALUE_ONE;
        obcCertificateData.VALUE_TWO = VALUE_TWO;
        $('#obc_certificate_form_and_datatable_container').html(obc_certificateFatherDetailsTemplate(obcCertificateData));
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'grandfather_occupation_for_oc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'grandfather_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'grandfather_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'grandfather_born_place_district_for_oc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'grandfather_native_place_district_for_oc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'grandfather_born_place_village_for_oc', 'village_code', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'grandfather_native_place_village_for_oc', 'village_code', 'village_name', 'Village');


        //if (isEdit) {

        $('#grandfather_born_place_state_for_oc').val(obcCertificateData.grandfather_born_place_state == 0 ? '' : obcCertificateData.grandfather_born_place_state);

        var districtData = tempDistrictData[obcCertificateData.grandfather_born_place_state] ? tempDistrictData[obcCertificateData.grandfather_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'grandfather_born_place_district_for_oc', 'district_code', 'district_name', 'District');
        $('#grandfather_born_place_district_for_oc').val(obcCertificateData.grandfather_born_place_district == 0 ? '' : obcCertificateData.grandfather_born_place_district);

        that.getEditVillageData(obcCertificateData.grandfather_born_place_state, obcCertificateData.grandfather_born_place_district, 'oc', obcCertificateData.grandfather_born_place_village, 'grandfather_born_place');

        $('#grandfather_native_place_state_for_oc').val(obcCertificateData.grandfather_native_place_state == 0 ? '' : obcCertificateData.grandfather_native_place_state);

        var districtData = tempDistrictData[obcCertificateData.grandfather_native_place_state] ? tempDistrictData[obcCertificateData.grandfather_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'grandfather_native_place_district_for_oc', 'district_code', 'district_name', 'District');
        $('#grandfather_native_place_district_for_oc').val(obcCertificateData.grandfather_native_place_district == 0 ? '' : obcCertificateData.grandfather_native_place_district);

        that.getEditVillageData(obcCertificateData.grandfather_native_place_state, obcCertificateData.grandfather_native_place_district, 'oc', obcCertificateData.grandfather_native_place_village, 'grandfather_native_place');

        $('#grandfather_city_for_oc').val(obcCertificateData.grandfather_city);
        $('#grandfather_occupation_for_oc').val(obcCertificateData.grandfather_occupation);

        if (obcCertificateData.grandfather_occupation == VALUE_TWELVE)
            $('.grandfather_other_occupation_div_for_oc').show();

        datePicker();
        generateSelect2();
        $('#grandfather_details_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },
    spouseDetailsForm: function (obcCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        ObcCertificate.router.navigate('spouse_details/' + obcCertificateData.encrypt_id);
        obcCertificateData.VALUE_ONE = VALUE_ONE;
        obcCertificateData.VALUE_TWO = VALUE_TWO;
        $('#obc_certificate_form_and_datatable_container').html(obc_certificateSpouseDetailsTemplate(obcCertificateData));
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_oc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'spouse_born_place_district_for_oc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'spouse_native_place_district_for_oc', 'district_code', 'district_name', 'District');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'spouse_born_place_village_for_oc', 'village_code', 'village_name', 'Village');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'spouse_native_place_village_for_oc', 'village_code', 'village_name', 'Village');


        //if (isEdit) {

        $('#spouse_born_place_state_for_oc').val(obcCertificateData.spouse_born_place_state == 0 ? '' : obcCertificateData.spouse_born_place_state);

        var districtData = tempDistrictData[obcCertificateData.spouse_born_place_state] ? tempDistrictData[obcCertificateData.spouse_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_born_place_district_for_oc', 'district_code', 'district_name', 'District');
        $('#spouse_born_place_district_for_oc').val(obcCertificateData.spouse_born_place_district == 0 ? '' : obcCertificateData.spouse_born_place_district);

        that.getEditVillageData(obcCertificateData.spouse_born_place_state, obcCertificateData.spouse_born_place_district, 'oc', obcCertificateData.spouse_born_place_village, 'spouse_born_place');

        $('#spouse_native_place_state_for_oc').val(obcCertificateData.spouse_native_place_state == 0 ? '' : obcCertificateData.spouse_native_place_state);

        var districtData = tempDistrictData[obcCertificateData.spouse_native_place_state] ? tempDistrictData[obcCertificateData.spouse_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_native_place_district_for_oc', 'district_code', 'district_name', 'District');
        $('#spouse_native_place_district_for_oc').val(obcCertificateData.spouse_native_place_district == 0 ? '' : obcCertificateData.spouse_native_place_district);

        that.getEditVillageData(obcCertificateData.spouse_native_place_state, obcCertificateData.spouse_native_place_district, 'oc', obcCertificateData.spouse_native_place_village, 'spouse_native_place');
        $('#spouse_city_for_oc').val(obcCertificateData.spouse_city);
        $('#spouse_occupation_for_oc').val(obcCertificateData.spouse_occupation);

        if (obcCertificateData.spouse_occupation == VALUE_TWELVE)
            $('.spouse_other_occupation_div_for_oc').show();

        datePicker();
        generateSelect2();
        $('#spouse_details_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },
    uploadDocumentsForm: function (obcCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        ObcCertificate.router.navigate('upload_documents/' + obcCertificateData.encrypt_id);
        obcCertificateData.VALUE_ONE = VALUE_ONE;
        obcCertificateData.VALUE_TWO = VALUE_TWO;
        obcCertificateData.VALUE_THREE = VALUE_THREE;
        obcCertificateData.VALUE_FOUR = VALUE_FOUR;
        obcCertificateData.VALUE_FIVE = VALUE_FIVE;
        obcCertificateData.VALUE_SIX = VALUE_SIX;
        obcCertificateData.VALUE_SEVEN = VALUE_SEVEN;
        obcCertificateData.VALUE_EIGHT = VALUE_EIGHT;
        obcCertificateData.VALUE_NINE = VALUE_NINE;
        obcCertificateData.VALUE_TEN = VALUE_TEN;
        obcCertificateData.VALUE_ELEVEN = VALUE_ELEVEN;
        obcCertificateData.VALUE_TWELVE = VALUE_TWELVE;
        obcCertificateData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        obcCertificateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#obc_certificate_form_and_datatable_container').html(obc_certificateUploadDocumentsTemplate(obcCertificateData));
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'obc_certificate', obcCertificateData.have_you_own_house, false, false);
        showSubContainer('have_you_own_house', 'obc_certificate', '.house_tax_receipt_item', VALUE_ONE, 'radio');
        showSubContainer('have_you_own_house', 'obc_certificate', '.noc_with_notary_item', VALUE_TWO, 'radio');
        var val = obcCertificateData.constitution_artical;
        if (val === '1') {
            this.$('.birth_certificate_item_container_for_obc_certificate').show();
            this.$('.election_card_item_container_for_obc_certificate').show();
            this.$('.aadhar_card_item_container_for_obc_certificate').show();
            this.$('.leaving_certificate_item_container_for_obc_certificate').hide();
            this.$('.proof_document_item_container_for_obc_certificate').hide();
            this.$('.gas_book_item_container_for_obc_certificate').hide();
            this.$('.bank_book_item_container_for_obc_certificate').hide();
            this.$('.have_you_own_house_container_div').hide();
            this.$('.house_tax_receipt_item_container_for_obc_certificate').hide();
            this.$('.noc_with_notary_item_container_for_obc_certificate').hide();
        }
        if (val === '2') {
            this.$('.birth_certificate_item_container_for_obc_certificate').show();
            this.$('.election_card_item_container_for_obc_certificate').show();
            this.$('.aadhar_card_item_container_for_obc_certificate').show();
            this.$('.leaving_certificate_item_container_for_obc_certificate').show();
            this.$('.proof_document_item_container_for_obc_certificate').hide();
            this.$('.gas_book_item_container_for_obc_certificate').hide();
            this.$('.bank_book_item_container_for_obc_certificate').hide();
            this.$('.have_you_own_house_container_div').hide();
            this.$('.house_tax_receipt_item_container_for_obc_certificate').hide();
            this.$('.noc_with_notary_item_container_for_obc_certificate').hide();
        }

        if (obcCertificateData.tax_payer_copy != '') {
            that.showDocument('tax_payer_copy_container_for_obc_certificate', 'tax_payer_copy_name_image_for_obc_certificate', 'tax_payer_copy_name_container_for_obc_certificate',
                    'tax_payer_copy_download', 'tax_payer_copy', obcCertificateData.tax_payer_copy, obcCertificateData.obc_certificate_id, VALUE_ONE);
        }

        if (obcCertificateData.self_birth_certificate_doc != '') {
            that.showDocument('self_birth_certificate_doc_container_for_obc_certificate', 'self_birth_certificate_doc_name_image_for_obc_certificate', 'self_birth_certificate_doc_name_container_for_obc_certificate',
                    'self_birth_certificate_doc_download', 'self_birth_certificate_doc', obcCertificateData.self_birth_certificate_doc, obcCertificateData.obc_certificate_id, VALUE_TWO);
        }

        if (obcCertificateData.father_certificate_doc != '') {
            that.showDocument('father_certificate_doc_container_for_obc_certificate', 'father_certificate_doc_name_image_for_obc_certificate', 'father_certificate_doc_name_container_for_obc_certificate',
                    'father_certificate_doc_download', 'father_certificate_doc', obcCertificateData.father_certificate_doc, obcCertificateData.obc_certificate_id, VALUE_THREE);
        }

        if (obcCertificateData.father_election_card != '') {
            that.showDocument('father_election_card_container_for_obc_certificate', 'father_election_card_name_image_for_obc_certificate', 'father_election_card_name_container_for_obc_certificate',
                    'father_election_card_download', 'father_election_card', obcCertificateData.father_election_card, obcCertificateData.obc_certificate_id, VALUE_FOUR);
        }

        if (obcCertificateData.father_aadhar_card != '') {
            that.showDocument('father_aadhar_card_container_for_obc_certificate', 'father_aadhar_card_name_image_for_obc_certificate', 'father_aadhar_card_name_container_for_obc_certificate',
                    'father_aadhar_card_download', 'father_aadhar_card', obcCertificateData.father_aadhar_card, obcCertificateData.obc_certificate_id, VALUE_FIVE);
        }

        if (obcCertificateData.grandfather_birth_certificate_doc != '') {
            that.showDocument('grandfather_birth_certificate_doc_container_for_obc_certificate', 'grandfather_birth_certificate_doc_name_image_for_obc_certificate', 'grandfather_birth_certificate_doc_name_container_for_obc_certificate',
                    'grandfather_birth_certificate_doc_download', 'grandfather_birth_certificate_doc', obcCertificateData.grandfather_birth_certificate_doc, obcCertificateData.obc_certificate_id, VALUE_SIX);
        }

        if (obcCertificateData.grandfather_property_doc != '') {
            that.showDocument('grandfather_property_doc_container_for_obc_certificate', 'grandfather_property_doc_name_image_for_obc_certificate', 'grandfather_property_doc_name_container_for_obc_certificate',
                    'grandfather_property_doc_download', 'grandfather_property_doc', obcCertificateData.grandfather_property_doc, obcCertificateData.obc_certificate_id, VALUE_SEVEN);
        }

        if (obcCertificateData.father_community_death_doc != '') {
            that.showDocument('father_community_death_doc_container_for_obc_certificate', 'father_community_death_doc_name_image_for_obc_certificate', 'father_community_death_doc_name_container_for_obc_certificate',
                    'father_community_death_doc_download', 'father_community_death_doc', obcCertificateData.father_community_death_doc, obcCertificateData.obc_certificate_id, VALUE_EIGHT);
        }

        if (obcCertificateData.aadhar_card_doc != '') {
            that.showDocument('aadhar_card_doc_container_for_obc_certificate', 'aadhar_card_doc_name_image_for_obc_certificate', 'aadhar_card_doc_name_container_for_obc_certificate',
                    'aadhar_card_doc_download', 'aadhar_card_doc', obcCertificateData.aadhar_card_doc, obcCertificateData.obc_certificate_id, VALUE_TEN);
        }

        if (obcCertificateData.community_certificate_doc != '') {
            that.showDocument('community_certificate_doc_container_for_obc_certificate', 'community_certificate_doc_name_image_for_obc_certificate', 'community_certificate_doc_name_container_for_obc_certificate',
                    'community_certificate_doc_download', 'community_certificate_doc', obcCertificateData.community_certificate_doc, obcCertificateData.obc_certificate_id, VALUE_ELEVEN);
        }

        if (obcCertificateData.income_certificate != '') {
            that.showDocument('income_certificate_container_for_obc_certificate', 'income_certificate_name_image_for_obc_certificate', 'income_certificate_name_container_for_obc_certificate',
                    'income_certificate_download', 'income_certificate', obcCertificateData.income_certificate, obcCertificateData.obc_certificate_id, VALUE_TWELVE);
        }

        if (obcCertificateData.applicant_photo_doc != '') {
            that.showDocument('applicant_photo_doc_container_for_obc_certificate', 'applicant_photo_doc_name_image_for_obc_certificate', 'applicant_photo_doc_name_container_for_obc_certificate',
                    'applicant_photo_doc_download', 'applicant_photo_doc', obcCertificateData.applicant_photo_doc, obcCertificateData.obc_certificate_id, VALUE_THIRTEEN);
        }

        $('#upload_documents_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                //that.submitRoadDetails();
            }
        });
    },
    typeMajorObcCertificateForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.obc_certificate_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            var grandfatherDetails = formData.grandfather_details != '' ? JSON.parse(formData.grandfather_details) : {};
            ObcCertificate.router.navigate('edit_type_mjor_obc_certificate_form');
        } else {
            var formData = {};
            ObcCertificate.router.navigate('type_mjor_obc_certificate_form');
        }

        tempVillageDataForOBC = [];
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
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.obc_certificate_data = parseData.obc_certificate_data;
        if (isEdit) {
            templateData.applicant_dob_text = formData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(formData.applicant_dob) : '';
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
            templateData.grandfather_data = grandfatherDetails;
            templateData.f_designation = parseData['obc_certificate_data'].family_designation ? JSON.parse(parseData['obc_certificate_data'].family_designation) : '';
            templateData.f_services = parseData['obc_certificate_data'].family_services ? JSON.parse(parseData['obc_certificate_data'].family_services) : '';
            templateData.f_designation_b = parseData['obc_certificate_data'].family_designation_b ? JSON.parse(parseData['obc_certificate_data'].family_designation_b) : '';
            templateData.f_scale_of_pay = parseData['obc_certificate_data'].family_scale_of_pay ? JSON.parse(parseData['obc_certificate_data'].family_scale_of_pay) : '';
            templateData.f_appointment_date = parseData['obc_certificate_data'].family_appointment_date ? JSON.parse(parseData['obc_certificate_data'].family_appointment_date) : '';
            templateData.f_promotion_age = parseData['obc_certificate_data'].family_promotion_age ? JSON.parse(parseData['obc_certificate_data'].family_promotion_age) : '';
            templateData.f_organization_name = parseData['obc_certificate_data'].family_organization_name ? JSON.parse(parseData['obc_certificate_data'].family_organization_name) : '';
            templateData.f_designation_b1 = parseData['obc_certificate_data'].family_designation_b1 ? JSON.parse(parseData['obc_certificate_data'].family_designation_b1) : '';
            templateData.f_service_period = parseData['obc_certificate_data'].family_service_period ? JSON.parse(parseData['obc_certificate_data'].family_service_period) : '';
            templateData.f_permanent_incapacitation_service = parseData['obc_certificate_data'].family_permanent_incapacitation_service ? JSON.parse(parseData['obc_certificate_data'].family_permanent_incapacitation_service) : '';
            templateData.f_permanent_incapacitation = parseData['obc_certificate_data'].family_permanent_incapacitation ? JSON.parse(parseData['obc_certificate_data'].family_permanent_incapacitation) : '';
            templateData.f_organization_name_partc = parseData['obc_certificate_data'].family_organization_name_partc ? JSON.parse(parseData['obc_certificate_data'].family_organization_name_partc) : '';
            templateData.f_designation_partc = parseData['obc_certificate_data'].family_designation_partc ? JSON.parse(parseData['obc_certificate_data'].family_designation_partc) : '';
            templateData.f_date_of_appointmet_partc = parseData['obc_certificate_data'].family_date_of_appointmet_partc ? JSON.parse(parseData['obc_certificate_data'].family_date_of_appointmet_partc) : '';
            templateData.f_designation_partd = parseData['obc_certificate_data'].family_designation_partd ? JSON.parse(parseData['obc_certificate_data'].family_designation_partd) : '';
            templateData.f_scale_of_pay_partd = parseData['obc_certificate_data'].family_scale_of_pay_partd ? JSON.parse(parseData['obc_certificate_data'].family_scale_of_pay_partd) : '';
            templateData.f_occupation = parseData['obc_certificate_data'].family_occupation ? JSON.parse(parseData['obc_certificate_data'].family_occupation) : '';
            templateData.f_agricultural_land = parseData['obc_certificate_data'].family_agricultural_land ? JSON.parse(parseData['obc_certificate_data'].family_agricultural_land) : '';
            templateData.f_location = parseData['obc_certificate_data'].family_location ? JSON.parse(parseData['obc_certificate_data'].family_location) : '';
            templateData.f_size_of_holding = parseData['obc_certificate_data'].family_size_of_holding ? JSON.parse(parseData['obc_certificate_data'].family_size_of_holding) : '';
            templateData.f_irrigated = parseData['obc_certificate_data'].family_irrigated ? JSON.parse(parseData['obc_certificate_data'].family_irrigated) : '';
            templateData.f_perecentage_of_irrigated = parseData['obc_certificate_data'].family_perecentage_of_irrigated ? JSON.parse(parseData['obc_certificate_data'].family_perecentage_of_irrigated) : '';
            templateData.f_ceiling_low = parseData['obc_certificate_data'].family_ceiling_low ? JSON.parse(parseData['obc_certificate_data'].family_ceiling_low) : '';
            templateData.f_total_percentage = parseData['obc_certificate_data'].family_total_percentage ? JSON.parse(parseData['obc_certificate_data'].family_total_percentage) : '';
            templateData.f_crops = parseData['obc_certificate_data'].family_crops ? JSON.parse(parseData['obc_certificate_data'].family_crops) : '';
            templateData.f_location_partf = parseData['obc_certificate_data'].family_location_partf ? JSON.parse(parseData['obc_certificate_data'].family_location_partf) : '';
            templateData.f_area_plantation = parseData['obc_certificate_data'].family_area_plantation ? JSON.parse(parseData['obc_certificate_data'].family_area_plantation) : '';
            templateData.f_location_property = parseData['obc_certificate_data'].family_location_property ? JSON.parse(parseData['obc_certificate_data'].family_location_property) : '';
            templateData.f_details = parseData['obc_certificate_data'].family_details ? JSON.parse(parseData['obc_certificate_data'].family_details) : '';
            templateData.f_use_to_which = parseData['obc_certificate_data'].family_use_to_which ? JSON.parse(parseData['obc_certificate_data'].family_use_to_which) : '';
        }

        templateData.income_sources = 'father_annual_income' + 'mother_annual_income' + 'spouse_annual_income';

        $('#obc_certificate_form_and_datatable_container').html(typeMajorObcCertificateFormTemplate(templateData));

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
//        renderOptionsForTwoDimensionalArray(distData, 'district');
        renderOptionsForTwoDimensionalArray(distData, 'father_native_place_district_for_oc');
        renderOptionsForTwoDimensionalArray(distData, 'grandfather_native_place_district_for_oc');
        renderOptionsForTwoDimensionalArray(distData, 'grandfather_born_place_district_for_oc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_oc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_oc');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');

        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_oc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_oc');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        generateBoxes('radio', genderArray, 'gender', 'oc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'oc', formData.marital_status, false, false);
        showSubContainer('marital_status', 'oc', '.spouse_info_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'obc_certificate', formData.have_you_own_house, false, false);
        generateBoxes('radio', yesNoArray, 'im_member_of_scst', 'obc_certificate', formData.im_member_of_scst, false, false);
        showSubContainer('im_member_of_scst', 'obc_certificate', '.im_member_of_scst_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'applied_for_sc_st_certy', 'obc_certificate', formData.applied_for_sc_st_certy, false, false);
        showSubContainer('applied_for_sc_st_certy', 'obc_certificate', '.applied_for_sc_st_certy_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'fath_hus_wif_hold_sc_st_certy', 'obc_certificate', formData.fath_hus_wif_hold_sc_st_certy, false, false);
        showSubContainer('fath_hus_wif_hold_sc_st_certy', 'obc_certificate', '.fath_hus_wif_hold_sc_st_certy_item', VALUE_ONE, 'radio');

        generateBoxes('radio', yesNoArray, 'if_grandfather_having_document', 'obc_certificate', formData.if_grandfather_having_document, false, false);
        showSubContainer('if_grandfather_having_document', 'obc_certificate', '.if_grandfather_birth_document_item', VALUE_ONE, 'radio');
        showSubContainer('if_grandfather_having_document', 'obc_certificate', '.if_grandfather_property_document_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'tax_payer', 'obc_certificate', formData.tax_payer, false, false);
        showSubContainer('tax_payer', 'obc_certificate', '.tax_payer_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'wealth_tax', 'obc_certificate', formData.wealth_tax, false, false);
        showSubContainer('wealth_tax', 'obc_certificate', '.wealth_tax_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'father_alive', 'obc_certificate', formData.father_alive, false, false);
        showSubContainer('father_alive', 'obc_certificate', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'obc_certificate', '.father_death_proof_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'obc_certificate', formData.mother_alive, false, false);
        generateBoxes('radio', yesNoArray, 'grandfather_alive', 'obc_certificate', formData.grandfather_alive, false, false);
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'obc_certificate', formData.spouse_alive, false, false);


        var district = formData.district;
        var fatherNativePlaceDistrict = fatherDetails.father_native_place_district;
        var fatherNativeCity = fatherDetails.father_city;
        var grandfatherbornPlaceDistrict = grandfatherDetails.grandfather_born_place_district;
        var grandfatherBornCity = grandfatherDetails.grandfather_borncity;
        var grandfatherNativePlaceDistrict = grandfatherDetails.grandfather_native_place_district;
        var grandfatherNativeCity = grandfatherDetails.grandfather_city;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];

        var fatherCityDataNative = isEdit ? (fatherNativeCity == VALUE_ONE ? damanCityArray : (fatherNativeCity == VALUE_TWO ? damanCityArray : (fatherNativeCity == VALUE_THREE ? diuNativeCityArray : []))) : [];
        var fatherVillageDataNative = isEdit ? (fatherNativePlaceDistrict == VALUE_ONE ? damanVillageForNativeArray : (fatherNativePlaceDistrict == VALUE_TWO ? diuVillagesForNativeArray : (fatherNativePlaceDistrict == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];

        var grandfatherCityDataBorn = isEdit ? (grandfatherBornCity == VALUE_ONE ? damanCityArray : (grandfatherBornCity == VALUE_TWO ? damanCityArray : (grandfatherBornCity == VALUE_THREE ? diuNativeCityArray : []))) : [];
        var grandfatherVillageDataBorn = isEdit ? (grandfatherbornPlaceDistrict == VALUE_ONE ? damanVillageForNativeArray : (grandfatherbornPlaceDistrict == VALUE_TWO ? diuVillagesForNativeArray : (grandfatherbornPlaceDistrict == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];

        var grandfatherCityDataNative = isEdit ? (grandfatherNativeCity == VALUE_ONE ? damanCityArray : (grandfatherNativeCity == VALUE_TWO ? damanCityArray : (grandfatherNativeCity == VALUE_THREE ? diuNativeCityArray : []))) : [];
        var grandfatherVillageDataNative = isEdit ? (grandfatherNativePlaceDistrict == VALUE_ONE ? damanVillageForNativeArray : (grandfatherNativePlaceDistrict == VALUE_TWO ? diuVillagesForNativeArray : (grandfatherNativePlaceDistrict == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];

        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_oc');
        renderOptionsForTwoDimensionalArray(fatherCityDataNative, 'father_city_for_oc');
        renderOptionsForTwoDimensionalArray(fatherVillageDataNative, 'father_native_place_village_for_oc');
        renderOptionsForTwoDimensionalArray(grandfatherCityDataNative, 'grandfather_city_for_oc');
        renderOptionsForTwoDimensionalArray(grandfatherVillageDataNative, 'grandfather_native_place_village_for_oc');
        renderOptionsForTwoDimensionalArray(grandfatherCityDataBorn, 'grandfather_borncity_for_oc');
        renderOptionsForTwoDimensionalArray(grandfatherVillageDataBorn, 'grandfather_born_place_village_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'grandfather_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_oc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'obccaste_for_oc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'father_caste_for_oc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'grandfather_caste_for_oc');
        renderOptionsForTwoDimensionalArray(educationTypeArray, 'applicant_education_for_oc');


        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'commu_add_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'per_add_state_for_oc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'native_place_state_for_oc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        $('.part_g_div').collapse().show();

        if (isEdit) {

            if (fatherDetails.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                $('.f-gov-job').removeClass('d-none');
                $('.f-gov-job').show();
            } else {
                $('.f-gov-job').removeClass('d-none');
                $('.f-gov-job').hide();
            }
            if (motherDetails.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                $('.m-gov-job').removeClass('d-none');
                $('.m-gov-job').show();
            }
            if (formData.marital_status == VALUE_ONE) {
                if (spouseDetails.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    $('.s-gov-job').removeClass('d-none');
                    $('.s-gov-job').show();
                }
            }

            $('#commu_add_state_for_oc').val(formData.commu_add_state == 0 ? '' : formData.commu_add_state);

            $('#per_add_state_for_oc').val(formData.per_add_state == 0 ? '' : formData.per_add_state);

            var districtData = tempDistrictData[formData.per_add_state] ? tempDistrictData[formData.per_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_add_district_for_oc', 'district_code', 'district_name', 'District');
            $('#per_add_district_for_oc').val(formData.per_add_district == 0 ? '' : formData.per_add_district);

            tempVillageDataForOBC = formData.per_add_village_data;
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.per_add_village_data, 'per_add_village_for_oc', 'village_code', 'village_name', 'Village');
            $('#per_add_village_for_oc').val(formData.per_add_village);

            $('#born_place_state_for_oc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);
            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_oc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);
            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'oc', formData.born_place_village, 'born_place');

            $('#born_place_village_for_oc').val(formData.born_place_village);

            $('#native_place_state_for_oc').val(formData.native_place_state == 0 ? '' : formData.native_place_state);
            var native_state = formData.native_place_state;
            var districtData = isEdit ? (native_state == VALUE_ONE ? damandiudistrictArray : damandiudistrictArray) : [];
            renderOptionsForTwoDimensionalArray(districtData, 'native_place_district_for_oc');
            $('#native_place_district_for_oc').val(formData.native_place_district == 0 ? '' : formData.native_place_district);

            var native_district = formData.native_place_district;
            var villageDataForNative = isEdit ? (native_district == VALUE_ONE ? damanVillageForNativeArray : (native_district == VALUE_TWO ? diuVillagesForNativeArray : (native_district == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
            renderOptionsForTwoDimensionalArray(villageDataForNative, 'native_place_village_for_oc');
            $('#native_place_village_for_oc').val(formData.native_place_village == 0 ? '' : formData.native_place_village);

            $('#com_addr_city_for_oc').val(formData.com_addr_city);
            $('#per_addr_city_for_oc').val(formData.per_addr_city);
            $('#select_required_purpose_for_oc').val(formData.select_required_purpose);
            $('#village_name_for_oc').val(formData.village_name);
            $('#applicant_education_for_oc').val(formData.applicant_education);

            if (formData.billingtoo == isChecked) {
                $('#billingtoo_for_oc').attr('checked', 'checked');
            }

            $('.father_info_div').collapse().show();
            $('.mother_info_div').collapse().show();
            $('.grandfather_info_div').collapse().show();
            if (formData.marital_status == VALUE_ONE)
                $('.spouse_info_div').collapse().show();
            $('.part_a_div').collapse().show();
            $('.part_b_div').collapse().show();
            $('.part_c_div').collapse().show();
            $('.part_d_div').collapse().show();
            $('.part_e_div').collapse().show();
            $('.part_f_div').collapse().show();
            $('.part_g_div').collapse().show();

            $('#declaration_for_obc_certificate').attr('checked', 'checked');
            $('#declaration').attr('checked', 'checked');
            $('#occupation_for_oc').val(formData.occupation);
            $('#nearest_police_station_for_oc').val(formData.nearest_police_station);
            $('#obccaste_for_oc').val(formData.obccaste);
            $('#father_caste_for_oc').val(formData.father_caste);
            $('#applicant_education_for_oc').val(formData.applicant_education);
            $('#grandfather_caste_for_oc').val(formData.grandfather_caste);
            //  $('#spouse_caste_for_oc').val(formData.spouse_caste);

            $('.partAFChangeEvent').show();
            $('.partAMChangeEvent').show();
            $('.partASChangeEvent').show();

            $('#district').val(formData.district);


            $('.father_info_div').collapse().show();
            $('.mother_info_div').collapse().show();
            $('.grandfather_info_div').collapse().show();
            $('.part_a_div').collapse().show();
            $('.part_b_div').collapse().show();
            $('.part_c_div').collapse().show();
            $('.part_d_div').collapse().show();
            $('.part_e_div').collapse().show();
            $('.part_f_div').collapse().show();
            $('.part_g_div').collapse().show();


            $('#declaration_for_obc_certificate').attr('checked', 'checked');

            if (formData.occupation == VALUE_TWELVE)
                $('#applicant_occupation_other_div_for_obc_certificate').show();

            if (formData.applicant_education == VALUE_FIVE)
                $('#applicant_education_other_div_for_obc_certificate').show();

            if (grandfatherDetails.grandfather_occupation == VALUE_TWELVE)
                $('#grandfather_other_occupation_div_for_obc_certificate').show();



            // Father
            $('#father_born_place_state_for_oc').val(fatherDetails.father_born_place_state == 0 ? '' : fatherDetails.father_born_place_state);

            var districtData = tempDistrictData[fatherDetails.father_born_place_state] ? tempDistrictData[fatherDetails.father_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#father_born_place_district_for_oc').val(fatherDetails.father_born_place_district == 0 ? '' : fatherDetails.father_born_place_district);

            if (fatherDetails.father_born_place_state != VALUE_ZERO)
                that.getEditVillageData(fatherDetails.father_born_place_state, fatherDetails.father_born_place_district, 'oc', fatherDetails.father_born_place_village, 'father_born_place');

            $('#father_born_place_village_for_oc').val(fatherDetails.father_born_place_village);

            $('#father_city_for_oc').val(fatherDetails.father_city);
            $('#father_native_place_district_for_oc').val(fatherDetails.father_native_place_district);
            $('#father_native_place_village_for_oc').val(fatherDetails.father_native_place_village);
            $('#father_occupation_for_oc').val(fatherDetails.father_occupation);
            $('#father_caste_for_oc').val(fatherDetails.father_caste);

            if (fatherDetails.father_occupation == VALUE_TWELVE)
                $('.father_other_occupation_div_for_oc').show();


            // Grand Father
            $('#grandfather_borncity_for_oc').val(grandfatherDetails.grandfather_borncity);
            $('#grandfather_born_place_district_for_oc').val(grandfatherDetails.grandfather_born_place_district);
            $('#grandfather_born_place_village_for_oc').val(grandfatherDetails.grandfather_born_place_village);

            $('#grandfather_city_for_oc').val(grandfatherDetails.grandfather_city);
            $('#grandfather_native_place_district_for_oc').val(grandfatherDetails.grandfather_native_place_district);
            $('#grandfather_native_place_village_for_oc').val(grandfatherDetails.grandfather_native_place_village);

            $('#grandfather_occupation_for_oc').val(grandfatherDetails.grandfather_occupation);
            $('#grandfather_caste_for_oc').val(grandfatherDetails.grandfather_caste);
            if (grandfatherDetails.grandfather_occupation == VALUE_TWELVE)
                $('.grandfather_other_occupation_div_for_oc').show();


            $('#mother_born_place_state_for_oc').val(motherDetails.mother_born_place_state == 0 ? '' : motherDetails.mother_born_place_state);

            var districtData = tempDistrictData[motherDetails.mother_born_place_state] ? tempDistrictData[motherDetails.mother_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#mother_born_place_district_for_oc').val(motherDetails.mother_born_place_district == 0 ? '' : motherDetails.mother_born_place_district);

            if (motherDetails.mother_born_place_state != VALUE_ZERO)
                that.getEditVillageData(motherDetails.mother_born_place_state, motherDetails.mother_born_place_district, 'oc', motherDetails.mother_born_place_village, 'mother_born_place');

            $('#mother_born_place_village_for_oc').val(motherDetails.mother_born_place_village);

            $('#mother_native_place_state_for_oc').val(motherDetails.mother_native_place_state == 0 ? '' : motherDetails.mother_native_place_state);

            var districtData = tempDistrictData[motherDetails.mother_native_place_state] ? tempDistrictData[motherDetails.mother_native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_native_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#mother_native_place_district_for_oc').val(motherDetails.mother_native_place_district == 0 ? '' : motherDetails.mother_native_place_district);

            if (motherDetails.mother_native_place_state != VALUE_ZERO)
                that.getEditVillageData(motherDetails.mother_native_place_state, motherDetails.mother_native_place_district, 'oc', motherDetails.mother_native_place_village, 'mother_native_place');

            $('#mother_native_place_village_for_oc').val(motherDetails.mother_native_place_village);

            $('#mother_city_for_oc').val(motherDetails.mother_city);
            $('#mother_occupation_for_oc').val(motherDetails.mother_occupation);

            if (motherDetails.mother_occupation == VALUE_TWELVE)
                $('.mother_other_occupation_div_for_oc').show();

            if (formData.marital_status == VALUE_ONE) {
                $('#spouse_born_place_state_for_oc').val(spouseDetails.spouse_born_place_state == 0 ? '' : spouseDetails.spouse_born_place_state);

                var districtData = tempDistrictData[spouseDetails.spouse_born_place_state] ? tempDistrictData[spouseDetails.spouse_born_place_state] : [];
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_born_place_district_for_oc', 'district_code', 'district_name', 'District');
                $('#spouse_born_place_district_for_oc').val(spouseDetails.spouse_born_place_district == 0 ? '' : spouseDetails.spouse_born_place_district);

                if (spouseDetails.spouse_born_place_state != VALUE_ZERO)
                    that.getEditVillageData(spouseDetails.spouse_born_place_state, spouseDetails.spouse_born_place_district, 'oc', spouseDetails.spouse_born_place_village, 'spouse_born_place');

                $('#spouse_born_place_village_for_oc').val(spouseDetails.spouse_born_place_village);

                $('#spouse_native_place_state_for_oc').val(spouseDetails.spouse_native_place_state == 0 ? '' : spouseDetails.spouse_native_place_state);

                var districtData = tempDistrictData[spouseDetails.spouse_native_place_state] ? tempDistrictData[spouseDetails.spouse_native_place_state] : [];
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_native_place_district_for_oc', 'district_code', 'district_name', 'District');
                $('#spouse_native_place_district_for_oc').val(spouseDetails.spouse_native_place_district == 0 ? '' : spouseDetails.spouse_native_place_district);

                if (spouseDetails.spouse_native_place_state != VALUE_ZERO)
                    that.getEditVillageData(spouseDetails.spouse_native_place_state, spouseDetails.spouse_native_place_district, 'oc', spouseDetails.spouse_native_place_village, 'spouse_native_place');

                $('#spouse_native_place_village_for_oc').val(spouseDetails.spouse_native_place_village);

                $('#spouse_city_for_oc').val(spouseDetails.spouse_city);
                $('#spouse_occupation_for_oc').val(spouseDetails.spouse_occupation);


                if (spouseDetails.spouse_occupation == VALUE_TWELVE)
                    $('.spouse_other_occupation_div_for_oc').show();
            }


            var val = formData.constitution_artical;

            if (formData.tax_payer_copy != '') {
                that.showDocument('tax_payer_copy_container_for_obc_certificate', 'tax_payer_copy_name_image_for_obc_certificate', 'tax_payer_copy_name_container_for_obc_certificate',
                        'tax_payer_copy_download', 'tax_payer_copy', formData.tax_payer_copy, formData.obc_certificate_id, VALUE_ONE);
            }

            if (formData.self_birth_certificate_doc != '') {
                that.showDocument('self_birth_certificate_doc_container_for_obc_certificate', 'self_birth_certificate_doc_name_image_for_obc_certificate', 'self_birth_certificate_doc_name_container_for_obc_certificate',
                        'self_birth_certificate_doc_download', 'self_birth_certificate_doc', formData.self_birth_certificate_doc, formData.obc_certificate_id, VALUE_TWO);
            }

            if (formData.father_certificate_doc != '') {
                that.showDocument('father_certificate_doc_container_for_obc_certificate', 'father_certificate_doc_name_image_for_obc_certificate', 'father_certificate_doc_name_container_for_obc_certificate',
                        'father_certificate_doc_download', 'father_certificate_doc', formData.father_certificate_doc, formData.obc_certificate_id, VALUE_THREE);
            }

            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_obc_certificate', 'father_election_card_name_image_for_obc_certificate', 'father_election_card_name_container_for_obc_certificate',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.obc_certificate_id, VALUE_FOUR);
            }

            if (formData.father_aadhar_card_doc != '') {
                that.showDocument('father_aadhar_card_doc_container_for_obc_certificate', 'father_aadhar_card_doc_name_image_for_obc_certificate', 'father_aadhar_card_doc_name_container_for_obc_certificate',
                        'father_aadhar_card_doc_download', 'father_aadhar_card_doc', formData.father_aadhar_card_doc, formData.obc_certificate_id, VALUE_FIVE);
            }

            if (formData.grandfather_birth_certificate_doc != '') {
                that.showDocument('grandfather_birth_certificate_doc_container_for_obc_certificate', 'grandfather_birth_certificate_doc_name_image_for_obc_certificate', 'grandfather_birth_certificate_doc_name_container_for_obc_certificate',
                        'grandfather_birth_certificate_doc_download', 'grandfather_birth_certificate_doc', formData.grandfather_birth_certificate_doc, formData.obc_certificate_id, VALUE_SIX);
            }

            if (formData.grandfather_property_doc != '') {
                that.showDocument('grandfather_property_doc_container_for_obc_certificate', 'grandfather_property_doc_name_image_for_obc_certificate', 'grandfather_property_doc_name_container_for_obc_certificate',
                        'grandfather_property_doc_download', 'grandfather_property_doc', formData.grandfather_property_doc, formData.obc_certificate_id, VALUE_SEVEN);
            }

            if (formData.father_community_death_doc != '') {
                that.showDocument('father_community_death_doc_container_for_obc_certificate', 'father_community_death_doc_name_image_for_obc_certificate', 'father_community_death_doc_name_container_for_obc_certificate',
                        'father_community_death_doc_download', 'father_community_death_doc', formData.father_community_death_doc, formData.obc_certificate_id, VALUE_EIGHT);
            }

            if (formData.election_card_doc != '') {
                that.showDocument('election_card_doc_container_for_obc_certificate', 'election_card_doc_name_image_for_obc_certificate', 'election_card_doc_name_container_for_obc_certificate',
                        'election_card_doc_download', 'election_card_doc', formData.election_card_doc, formData.obc_certificate_id, VALUE_NINE);
            }

            if (formData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_obc_certificate', 'aadhar_card_doc_name_image_for_obc_certificate', 'aadhar_card_doc_name_container_for_obc_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.obc_certificate_id, VALUE_TEN);
            }

            if (formData.community_certificate_doc != '') {
                that.showDocument('community_certificate_doc_container_for_obc_certificate', 'community_certificate_doc_name_image_for_obc_certificate', 'community_certificate_doc_name_container_for_obc_certificate',
                        'community_certificate_doc_download', 'community_certificate_doc', formData.community_certificate_doc, formData.obc_certificate_id, VALUE_ELEVEN);
            }

            if (formData.income_certificate != '') {
                that.showDocument('income_certificate_container_for_obc_certificate', 'income_certificate_name_image_for_obc_certificate', 'income_certificate_name_container_for_obc_certificate',
                        'income_certificate_download', 'income_certificate', formData.income_certificate, formData.obc_certificate_id, VALUE_TWELVE);
            }

            if (formData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_obc_certificate', 'applicant_photo_doc_name_image_for_obc_certificate', 'applicant_photo_doc_name_container_for_obc_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.obc_certificate_id, VALUE_THIRTEEN);
            }

            if (formData.mother_aadhar_card_doc != '') {
                that.showDocument('mother_aadhar_card_doc_container_for_obc_certificate', 'mother_aadhar_card_doc_name_image_for_obc_certificate', 'mother_aadhar_card_doc_name_container_for_obc_certificate',
                        'mother_aadhar_card_doc_download', 'mother_aadhar_card_doc', formData.mother_aadhar_card_doc, formData.obc_certificate_id, VALUE_FIFTEEN);
            }

            if (formData.father_election_card_doc != '') {
                that.showDocument('father_election_card_doc_container_for_obc_certificate', 'father_election_card_doc_name_image_for_obc_certificate', 'father_election_card_doc_name_container_for_obc_certificate',
                        'father_election_card_doc_download', 'father_election_card_doc', formData.father_election_card_doc, formData.obc_certificate_id, VALUE_SIXTEEN);
            }

            if (formData.mother_election_card_doc != '') {
                that.showDocument('mother_election_card_doc_container_for_obc_certificate', 'mother_election_card_doc_name_image_for_obc_certificate', 'mother_election_card_doc_name_container_for_obc_certificate',
                        'mother_election_card_doc_download', 'mother_election_card_doc', formData.mother_election_card_doc, formData.obc_certificate_id, VALUE_SEVENTEEN);
            }

            if (formData.father_alive == VALUE_ONE) {
                $('.father_proof_item_container_for_obc_certificate').show();
                $('.father_death_proof_item_container_for_obc_certificate').hide();
            } else if (formData.father_alive == VALUE_TWO) {
                $('.father_proof_item_container_for_obc_certificate').hide();
                $('.father_death_proof_item_container_for_obc_certificate').show();
            }

            if (formData.father_alive == VALUE_ONE) {
                $("#father_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#father_alive_for_obc_certificate_2").prop("checked", true);
                $('.f-gov-job').removeClass('d-none');
                $('.f-gov-job').hide();
            }
            if (formData.mother_alive == VALUE_ONE) {
                $("#mother_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#mother_alive_for_obc_certificate_2").prop("checked", true);
                $('.m-gov-job').removeClass('d-none');
                $('.m-gov-job').hide();

            }
            if (formData.grandfather_alive == VALUE_ONE) {
                $("#grandfather_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#grandfather_alive_for_obc_certificate_2").prop("checked", true);
            }

            if (formData.spouse_alive == VALUE_ONE) {
                $("#spouse_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#spouse_alive_for_obc_certificate_2").prop("checked", true);
                $('.s-gov-job').removeClass('d-none');
                $('.s-gov-job').hide();
            }

        } else {
            $("#father_alive_for_obc_certificate_1").prop("checked", true);
            $("#mother_alive_for_obc_certificate_1").prop("checked", true);
            $("#grandfather_alive_for_obc_certificate_1").prop("checked", true);
            $("#spouse_alive_for_obc_certificate_1").prop("checked", true);
        }

        generateSelect2();
        datePicker();
        datePickerMax('applicant_dob_for_oc');
        datePickerToday('applied_date_for_obc_certificate');
        datePickerToday('applied_date_of_hold_certy_for_obc_certificate');

        $('#obc_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitObcCertificate($('#submit_btn_for_obc_certificate'));
            }
        });

        resetCounterForDocument('doc_no_for_obc_certificate', 33);
    },

    typeMinorObcCertificateForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.obc_certificate_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            var grandfatherDetails = formData.grandfather_details != '' ? JSON.parse(formData.grandfather_details) : {};
            ObcCertificate.router.navigate('edit_type_minor_obc_certificate_form');
        } else {
            var formData = {};
            var fatherDetails = '';
            var motherDetails = '';
            var grandfatherDetails = '';
            ObcCertificate.router.navigate('type_minor_obc_certificate_form');
        }

        tempVillageDataForOBC = [];
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
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.obc_certificate_data = parseData.obc_certificate_data;

        if (isEdit) {
            templateData.applicant_dob_text = formData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(formData.applicant_dob) : '';
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.grandfather_data = grandfatherDetails;
            templateData.f_designation = parseData['obc_certificate_data'].family_designation ? JSON.parse(parseData['obc_certificate_data'].family_designation) : '';
            templateData.f_services = parseData['obc_certificate_data'].family_services ? JSON.parse(parseData['obc_certificate_data'].family_services) : '';
            templateData.f_designation_b = parseData['obc_certificate_data'].family_designation_b ? JSON.parse(parseData['obc_certificate_data'].family_designation_b) : '';
            templateData.f_scale_of_pay = parseData['obc_certificate_data'].family_scale_of_pay ? JSON.parse(parseData['obc_certificate_data'].family_scale_of_pay) : '';
            templateData.f_appointment_date = parseData['obc_certificate_data'].family_appointment_date ? JSON.parse(parseData['obc_certificate_data'].family_appointment_date) : '';
            templateData.f_promotion_age = parseData['obc_certificate_data'].family_promotion_age ? JSON.parse(parseData['obc_certificate_data'].family_promotion_age) : '';
            templateData.f_organization_name = parseData['obc_certificate_data'].family_organization_name ? JSON.parse(parseData['obc_certificate_data'].family_organization_name) : '';
            templateData.f_designation_b1 = parseData['obc_certificate_data'].family_designation_b1 ? JSON.parse(parseData['obc_certificate_data'].family_designation_b1) : '';
            templateData.f_service_period = parseData['obc_certificate_data'].family_service_period ? JSON.parse(parseData['obc_certificate_data'].family_service_period) : '';
            templateData.f_permanent_incapacitation_service = parseData['obc_certificate_data'].family_permanent_incapacitation_service ? JSON.parse(parseData['obc_certificate_data'].family_permanent_incapacitation_service) : '';
            templateData.f_permanent_incapacitation = parseData['obc_certificate_data'].family_permanent_incapacitation ? JSON.parse(parseData['obc_certificate_data'].family_permanent_incapacitation) : '';
            templateData.f_organization_name_partc = parseData['obc_certificate_data'].family_organization_name_partc ? JSON.parse(parseData['obc_certificate_data'].family_organization_name_partc) : '';
            templateData.f_designation_partc = parseData['obc_certificate_data'].family_designation_partc ? JSON.parse(parseData['obc_certificate_data'].family_designation_partc) : '';
            templateData.f_date_of_appointmet_partc = parseData['obc_certificate_data'].family_date_of_appointmet_partc ? JSON.parse(parseData['obc_certificate_data'].family_date_of_appointmet_partc) : '';
            templateData.f_designation_partd = parseData['obc_certificate_data'].family_designation_partd ? JSON.parse(parseData['obc_certificate_data'].family_designation_partd) : '';
            templateData.f_scale_of_pay_partd = parseData['obc_certificate_data'].family_scale_of_pay_partd ? JSON.parse(parseData['obc_certificate_data'].family_scale_of_pay_partd) : '';
            templateData.f_occupation = parseData['obc_certificate_data'].family_occupation ? JSON.parse(parseData['obc_certificate_data'].family_occupation) : '';
            templateData.f_agricultural_land = parseData['obc_certificate_data'].family_agricultural_land ? JSON.parse(parseData['obc_certificate_data'].family_agricultural_land) : '';
            templateData.f_location = parseData['obc_certificate_data'].family_location ? JSON.parse(parseData['obc_certificate_data'].family_location) : '';
            templateData.f_size_of_holding = parseData['obc_certificate_data'].family_size_of_holding ? JSON.parse(parseData['obc_certificate_data'].family_size_of_holding) : '';
            templateData.f_irrigated = parseData['obc_certificate_data'].family_irrigated ? JSON.parse(parseData['obc_certificate_data'].family_irrigated) : '';
            templateData.f_perecentage_of_irrigated = parseData['obc_certificate_data'].family_perecentage_of_irrigated ? JSON.parse(parseData['obc_certificate_data'].family_perecentage_of_irrigated) : '';
            templateData.f_ceiling_low = parseData['obc_certificate_data'].family_ceiling_low ? JSON.parse(parseData['obc_certificate_data'].family_ceiling_low) : '';
            templateData.f_total_percentage = parseData['obc_certificate_data'].family_total_percentage ? JSON.parse(parseData['obc_certificate_data'].family_total_percentage) : '';
            templateData.f_crops = parseData['obc_certificate_data'].family_crops ? JSON.parse(parseData['obc_certificate_data'].family_crops) : '';
            templateData.f_location_partf = parseData['obc_certificate_data'].family_location_partf ? JSON.parse(parseData['obc_certificate_data'].family_location_partf) : '';
            templateData.f_area_plantation = parseData['obc_certificate_data'].family_area_plantation ? JSON.parse(parseData['obc_certificate_data'].family_area_plantation) : '';
            templateData.f_location_property = parseData['obc_certificate_data'].family_location_property ? JSON.parse(parseData['obc_certificate_data'].family_location_property) : '';
            templateData.f_details = parseData['obc_certificate_data'].family_details ? JSON.parse(parseData['obc_certificate_data'].family_details) : '';
            templateData.f_use_to_which = parseData['obc_certificate_data'].family_use_to_which ? JSON.parse(parseData['obc_certificate_data'].family_use_to_which) : '';
        }

        $('#obc_certificate_form_and_datatable_container').html(typeMinorObcCertificateFormTemplate(templateData));
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
//        renderOptionsForTwoDimensionalArray(distData, 'district');
        renderOptionsForTwoDimensionalArray(distData, 'father_native_place_district_for_oc');
        renderOptionsForTwoDimensionalArray(distData, 'grandfather_native_place_district_for_oc');
        renderOptionsForTwoDimensionalArray(distData, 'grandfather_born_place_district_for_oc');
        if (distData[VALUE_ONE]) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_oc');
        } else if (distData[VALUE_TWO]) {
            renderOptionsForTwoDimensionalArray(diuCityArray, 'com_addr_city_for_oc');
        }
        if (distData[VALUE_ONE]) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_oc');
        } else if (distData[VALUE_TWO]) {
            renderOptionsForTwoDimensionalArray(diuCityArray, 'per_addr_city_for_oc');
        }

        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        generateBoxes('radio', genderArray, 'gender', 'oc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'oc', formData.marital_status, false, false);
        showSubContainer('marital_status', 'oc', '.spouse_info_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'if_grandfather_having_document', 'obc_certificate', formData.if_grandfather_having_document, false, false);
        showSubContainer('if_grandfather_having_document', 'obc_certificate', '.if_grandfather_birth_document_item', VALUE_ONE, 'radio');
        showSubContainer('if_grandfather_having_document', 'obc_certificate', '.if_grandfather_property_document_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'tax_payer', 'obc_certificate', formData.tax_payer, false, false);
        showSubContainer('tax_payer', 'obc_certificate', '.tax_payer_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'wealth_tax', 'obc_certificate', formData.wealth_tax, false, false);
        showSubContainer('wealth_tax', 'obc_certificate', '.wealth_tax_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'father_alive', 'obc_certificate', formData.father_alive, false, false);
        showSubContainer('father_alive', 'obc_certificate', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'obc_certificate', '.father_death_proof_item', VALUE_TWO, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'obc_certificate', formData.mother_alive, false, false);
        generateBoxes('radio', yesNoArray, 'grandfather_alive', 'obc_certificate', formData.grandfather_alive, false, false);

        var district = formData.district;
        var fatherNativePlaceDistrict = fatherDetails.father_native_place_district;
        var fatherNativeCity = fatherDetails.father_city;
        var grandfatherbornPlaceDistrict = grandfatherDetails.grandfather_born_place_district;
        var grandfatherBornCity = grandfatherDetails.grandfather_borncity;
        var grandfatherNativePlaceDistrict = grandfatherDetails.grandfather_native_place_district;
        var grandfatherNativeCity = grandfatherDetails.grandfather_city;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];

        var fatherCityDataNative = isEdit ? (fatherNativeCity == VALUE_ONE ? damanCityArray : (fatherNativeCity == VALUE_TWO ? damanCityArray : (fatherNativeCity == VALUE_THREE ? diuNativeCityArray : []))) : [];
        var fatherVillageDataNative = isEdit ? (fatherNativePlaceDistrict == VALUE_ONE ? damanVillageForNativeArray : (fatherNativePlaceDistrict == VALUE_TWO ? diuVillagesForNativeArray : (fatherNativePlaceDistrict == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];

        var grandfatherCityDataNative = isEdit ? (grandfatherNativeCity == VALUE_ONE ? damanCityArray : (grandfatherNativeCity == VALUE_TWO ? damanCityArray : (grandfatherNativeCity == VALUE_THREE ? diuNativeCityArray : []))) : [];
        var grandfatherVillageDataNative = isEdit ? (grandfatherNativePlaceDistrict == VALUE_ONE ? damanVillageForNativeArray : (grandfatherNativePlaceDistrict == VALUE_TWO ? diuVillagesForNativeArray : (grandfatherNativePlaceDistrict == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];

        var grandfatherCityDataBorn = isEdit ? (grandfatherbornPlaceDistrict == VALUE_ONE ? damanCityArray : (grandfatherbornPlaceDistrict == VALUE_TWO ? diuNativeCityArray : (grandfatherbornPlaceDistrict == VALUE_THREE ? dnhCityArray : []))) : [];
        var grandfatherVillageDataBorn = isEdit ? (grandfatherBornCity == VALUE_ONE ? damanVillageForNativeArray : (grandfatherBornCity == VALUE_TWO ? damanVillageForNativeArray : (grandfatherBornCity == VALUE_THREE ? diuVillagesForNativeArray : []))) : [];

        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_oc');
        renderOptionsForTwoDimensionalArray(fatherCityDataNative, 'father_city_for_oc');
        renderOptionsForTwoDimensionalArray(fatherVillageDataNative, 'father_native_place_village_for_oc');
        renderOptionsForTwoDimensionalArray(grandfatherCityDataNative, 'grandfather_city_for_oc');
        renderOptionsForTwoDimensionalArray(grandfatherVillageDataNative, 'grandfather_native_place_village_for_oc');
        renderOptionsForTwoDimensionalArray(grandfatherCityDataBorn, 'grandfather_borncity_for_oc');
        renderOptionsForTwoDimensionalArray(grandfatherVillageDataBorn, 'grandfather_born_place_village_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'grandfather_occupation_for_oc');
        renderOptionsForTwoDimensionalArray(applicantPolicestationArray, 'nearest_police_station_for_oc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'obccaste_for_oc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'father_caste_for_oc');
        renderOptionsForTwoDimensionalArray(applicantobccasteArray, 'grandfather_caste_for_oc');
        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relationship_of_applicant_for_oc');
        renderOptionsForTwoDimensionalArray(educationTypeArray, 'applicant_education_for_oc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'commu_add_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'per_add_state_for_oc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'native_place_state_for_oc');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_oc', 'state_code', 'state_name', 'State/UT');
        $('.part_g_div').collapse().show();


        if (isEdit) {
            if (fatherDetails.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                $('.f-gov-job').removeClass('d-none');
                $('.f-gov-job').show();
            }
            if (fatherDetails.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                $('.m-gov-job').removeClass('d-none');
                $('.m-gov-job').show();
            }

            $('#commu_add_state_for_oc').val(formData.commu_add_state == 0 ? '' : formData.commu_add_state);

            var districtData = tempDistrictData[formData.commu_add_state] ? tempDistrictData[formData.commu_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'commu_add_district_for_oc', 'district_code', 'district_name', 'District');
            $('#commu_add_district_for_oc').val(formData.commu_add_district == 0 ? '' : formData.commu_add_district);

            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.commu_add_village_data, 'commu_add_village_for_oc', 'village_code', 'village_name', 'Village');
            $('#commu_add_village_for_oc').val(formData.commu_add_village);

            $('#per_add_state_for_oc').val(formData.per_add_state == 0 ? '' : formData.per_add_state);

            var districtData = tempDistrictData[formData.per_add_state] ? tempDistrictData[formData.per_add_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'per_add_district_for_oc', 'district_code', 'district_name', 'District');
            $('#per_add_district_for_oc').val(formData.per_add_district == 0 ? '' : formData.per_add_district);

            tempVillageDataForOBC = formData.per_add_village_data;

            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(formData.per_add_village_data, 'per_add_village_for_oc', 'village_code', 'village_name', 'Village');
            $('#per_add_village_for_oc').val(formData.per_add_village);

            $('#born_place_state_for_oc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);

            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_oc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);

            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'oc', formData.born_place_village, 'born_place');

            $('#born_place_village_for_oc').val(formData.born_place_village);
            $('#born_place_pincode_for_oc').val(formData.born_place_pincode == 0 ? '' : formData.born_place_pincode);

            $('#native_place_state_for_oc').val(formData.native_place_state == 0 ? '' : formData.native_place_state);

            var native_state = formData.native_place_state;
            var districtData = isEdit ? (native_state == VALUE_ONE ? damandiudistrictArray : damandiudistrictArray) : [];
            renderOptionsForTwoDimensionalArray(districtData, 'native_place_district_for_oc');
            $('#native_place_district_for_oc').val(formData.native_place_district == 0 ? '' : formData.native_place_district);

            var native_district = formData.native_place_district;
            var villageDataForNative = isEdit ? (native_district == VALUE_ONE ? damanVillageForNativeArray : (native_district == VALUE_TWO ? diuVillagesForNativeArray : (native_district == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
            renderOptionsForTwoDimensionalArray(villageDataForNative, 'native_place_village_for_oc');
            $('#native_place_village_for_oc').val(formData.native_place_village == 0 ? '' : formData.native_place_village);
            $('#native_place_pincode_for_oc').val(formData.native_place_pincode == 0 ? '' : formData.native_place_pincode);

            $('#com_addr_city_for_oc').val(formData.com_addr_city);
            $('#per_addr_city_for_oc').val(formData.per_addr_city);
            $('#select_required_purpose_for_oc').val(formData.select_required_purpose);
            $('#village_name_for_oc').val(formData.village_name);
            $('#applicant_education_for_oc').val(formData.applicant_education);

            if (formData.billingtoo == isChecked) {
                $('#billingtoo_for_oc').attr('checked', 'checked');
            }

            $('.father_info_div').collapse().show();
            $('.mother_info_div').collapse().show();
            $('.grandfather_info_div').collapse().show();
            $('.part_a_div').collapse().show();
            $('.part_b_div').collapse().show();
            $('.part_c_div').collapse().show();
            $('.part_d_div').collapse().show();
            $('.part_e_div').collapse().show();
            $('.part_f_div').collapse().show();
            $('.father_div').collapse().show();
            $('.mother_div').collapse().show();
            $('.part_g_div').collapse().show();

            $('#declaration_for_obc_certificate').attr('checked', 'checked');
            $('#declaration').attr('checked', 'checked');
            $('#occupation_for_oc').val(formData.occupation);
            $('#nearest_police_station_for_oc').val(formData.nearest_police_station);
            $('#obccaste_for_oc').val(formData.obccaste);
            $('#father_caste_for_oc').val(fatherDetails.father_caste);
            $('#grandfather_caste_for_oc').val(grandfatherDetails.grandfather_caste);
            $('#relationship_of_applicant_for_oc').val(formData.relationship_of_applicant);


            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_oc').show();
            $('#district').val(formData.district);


            $('#declaration_for_obc_certificate').attr('checked', 'checked');
            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_oc').show();

            if (formData.grandfather_occupation == VALUE_TWELVE)
                $('#grandfather_other_occupation_div_for_obc_certificate').show();


            $('#father_born_place_state_for_oc').val(fatherDetails.father_born_place_state == 0 ? '' : fatherDetails.father_born_place_state);

            var districtData = tempDistrictData[fatherDetails.father_born_place_state] ? tempDistrictData[fatherDetails.father_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#father_born_place_district_for_oc').val(fatherDetails.father_born_place_district == 0 ? '' : fatherDetails.father_born_place_district);

            if (fatherDetails.father_born_place_state != VALUE_ZERO)
                that.getEditVillageData(fatherDetails.father_born_place_state, fatherDetails.father_born_place_district, 'oc', fatherDetails.father_born_place_village, 'father_born_place');

            $('#father_born_place_village_for_oc').val(fatherDetails.father_born_place_village);

            $('#father_city_for_oc').val(fatherDetails.father_city);
            $('#father_native_place_district_for_oc').val(fatherDetails.father_native_place_district);
            $('#father_native_place_village_for_oc').val(fatherDetails.father_native_place_village);
            $('#father_occupation_for_oc').val(fatherDetails.father_occupation);
            $('#father_caste_for_oc').val(fatherDetails.father_caste);

            if (fatherDetails.father_occupation == VALUE_TWELVE)
                $('.father_other_occupation_div_for_oc').show();

            $('#grandfather_borncity_for_oc').val(grandfatherDetails.grandfather_borncity);
            $('#grandfather_born_place_district_for_oc').val(grandfatherDetails.grandfather_born_place_district);
            $('#grandfather_born_place_village_for_oc').val(grandfatherDetails.grandfather_born_place_village);


            $('#grandfather_city_for_oc').val(grandfatherDetails.grandfather_city);
            $('#grandfather_native_place_district_for_oc').val(grandfatherDetails.grandfather_native_place_district);
            $('#grandfather_native_place_village_for_oc').val(grandfatherDetails.grandfather_native_place_village);
            $('#grandfather_occupation_for_oc').val(grandfatherDetails.grandfather_occupation);
            $('#grandfather_caste_for_oc').val(grandfatherDetails.grandfather_caste);

            if (grandfatherDetails.grandfather_occupation == VALUE_TWELVE)
                $('.grandfather_other_occupation_div_for_oc').show();


            $('#mother_born_place_state_for_oc').val(motherDetails.mother_born_place_state == 0 ? '' : motherDetails.mother_born_place_state);

            var districtData = tempDistrictData[motherDetails.mother_born_place_state] ? tempDistrictData[motherDetails.mother_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#mother_born_place_district_for_oc').val(motherDetails.mother_born_place_district == 0 ? '' : motherDetails.mother_born_place_district);

            if (motherDetails.mother_born_place_state != VALUE_ZERO)
                that.getEditVillageData(motherDetails.mother_born_place_state, motherDetails.mother_born_place_district, 'oc', motherDetails.mother_born_place_village, 'mother_born_place');

            $('#mother_born_place_village_for_oc').val(motherDetails.mother_born_place_village);

            $('#mother_native_place_state_for_oc').val(motherDetails.mother_native_place_state == 0 ? '' : motherDetails.mother_native_place_state);

            var districtData = tempDistrictData[motherDetails.mother_native_place_state] ? tempDistrictData[motherDetails.mother_native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_native_place_district_for_oc', 'district_code', 'district_name', 'District');
            $('#mother_native_place_district_for_oc').val(motherDetails.mother_native_place_district == 0 ? '' : motherDetails.mother_native_place_district);

            if (motherDetails.mother_native_place_state != VALUE_ZERO)
                that.getEditVillageData(motherDetails.mother_native_place_state, motherDetails.mother_native_place_district, 'oc', motherDetails.mother_native_place_village, 'mother_native_place');

            $('#mother_native_place_village_for_oc').val(motherDetails.mother_native_place_village);

            $('#mother_city_for_oc').val(motherDetails.mother_city);
            $('#mother_occupation_for_oc').val(motherDetails.mother_occupation);

            if (motherDetails.mother_occupation == VALUE_TWELVE)
                $('.mother_other_occupation_div_for_oc').show();


            var val = formData.constitution_artical;

            if (formData.tax_payer_copy != '') {
                that.showDocument('tax_payer_copy_container_for_obc_certificate', 'tax_payer_copy_name_image_for_obc_certificate', 'tax_payer_copy_name_container_for_obc_certificate',
                        'tax_payer_copy_download', 'tax_payer_copy', formData.tax_payer_copy, formData.obc_certificate_id, VALUE_ONE);
            }

            if (formData.self_birth_certificate_doc != '') {
                that.showDocument('self_birth_certificate_doc_container_for_obc_certificate', 'self_birth_certificate_doc_name_image_for_obc_certificate', 'self_birth_certificate_doc_name_container_for_obc_certificate',
                        'self_birth_certificate_doc_download', 'self_birth_certificate_doc', formData.self_birth_certificate_doc, formData.obc_certificate_id, VALUE_TWO);
            }

            if (formData.father_certificate_doc != '') {
                that.showDocument('father_certificate_doc_container_for_obc_certificate', 'father_certificate_doc_name_image_for_obc_certificate', 'father_certificate_doc_name_container_for_obc_certificate',
                        'father_certificate_doc_download', 'father_certificate_doc', formData.father_certificate_doc, formData.obc_certificate_id, VALUE_THREE);
            }

            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_obc_certificate', 'father_election_card_name_image_for_obc_certificate', 'father_election_card_name_container_for_obc_certificate',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.obc_certificate_id, VALUE_FOUR);
            }

            if (formData.father_aadhar_card_doc != '') {
                that.showDocument('father_aadhar_card_doc_container_for_obc_certificate', 'father_aadhar_card_doc_name_image_for_obc_certificate', 'father_aadhar_card_doc_name_container_for_obc_certificate',
                        'father_aadhar_card_doc_download', 'father_aadhar_card_doc', formData.father_aadhar_card_doc, formData.obc_certificate_id, VALUE_FIVE);
            }

            if (formData.grandfather_birth_certificate_doc != '') {
                that.showDocument('grandfather_birth_certificate_doc_container_for_obc_certificate', 'grandfather_birth_certificate_doc_name_image_for_obc_certificate', 'grandfather_birth_certificate_doc_name_container_for_obc_certificate',
                        'grandfather_birth_certificate_doc_download', 'grandfather_birth_certificate_doc', formData.grandfather_birth_certificate_doc, formData.obc_certificate_id, VALUE_SIX);
            }

            if (formData.grandfather_property_doc != '') {
                that.showDocument('grandfather_property_doc_container_for_obc_certificate', 'grandfather_property_doc_name_image_for_obc_certificate', 'grandfather_property_doc_name_container_for_obc_certificate',
                        'grandfather_property_doc_download', 'grandfather_property_doc', formData.grandfather_property_doc, formData.obc_certificate_id, VALUE_SEVEN);
            }

            if (formData.father_community_death_doc != '') {
                that.showDocument('father_community_death_doc_container_for_obc_certificate', 'father_community_death_doc_name_image_for_obc_certificate', 'father_community_death_doc_name_container_for_obc_certificate',
                        'father_community_death_doc_download', 'father_community_death_doc', formData.father_community_death_doc, formData.obc_certificate_id, VALUE_EIGHT);
            }

            if (formData.election_card_doc != '') {
                that.showDocument('election_card_doc_container_for_obc_certificate', 'election_card_doc_name_image_for_obc_certificate', 'election_card_doc_name_container_for_obc_certificate',
                        'election_card_doc_download', 'election_card_doc', formData.election_card_doc, formData.obc_certificate_id, VALUE_NINE);
            }

            if (formData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_obc_certificate', 'aadhar_card_doc_name_image_for_obc_certificate', 'aadhar_card_doc_name_container_for_obc_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', formData.aadhar_card_doc, formData.obc_certificate_id, VALUE_TEN);
            }

            if (formData.community_certificate_doc != '') {
                that.showDocument('community_certificate_doc_container_for_obc_certificate', 'community_certificate_doc_name_image_for_obc_certificate', 'community_certificate_doc_name_container_for_obc_certificate',
                        'community_certificate_doc_download', 'community_certificate_doc', formData.community_certificate_doc, formData.obc_certificate_id, VALUE_ELEVEN);
            }

            if (formData.income_certificate != '') {
                that.showDocument('income_certificate_container_for_obc_certificate', 'income_certificate_name_image_for_obc_certificate', 'income_certificate_name_container_for_obc_certificate',
                        'income_certificate_download', 'income_certificate', formData.income_certificate, formData.obc_certificate_id, VALUE_TWELVE);
            }

            if (formData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_obc_certificate', 'applicant_photo_doc_name_image_for_obc_certificate', 'applicant_photo_doc_name_container_for_obc_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', formData.applicant_photo_doc, formData.obc_certificate_id, VALUE_THIRTEEN);
            }

            if (formData.minor_child_photo_doc != '') {
                that.showDocument('minor_child_photo_doc_container_for_obc_certificate', 'minor_child_photo_doc_name_image_for_obc_certificate', 'minor_child_photo_doc_name_container_for_obc_certificate',
                        'minor_child_photo_doc_download', 'minor_child_photo_doc', formData.minor_child_photo_doc, formData.obc_certificate_id, VALUE_FOURTEEN);
            }

            if (formData.mother_aadhar_card_doc != '') {
                that.showDocument('mother_aadhar_card_doc_container_for_obc_certificate', 'mother_aadhar_card_doc_name_image_for_obc_certificate', 'mother_aadhar_card_doc_name_container_for_obc_certificate',
                        'mother_aadhar_card_doc_download', 'mother_aadhar_card_doc', formData.mother_aadhar_card_doc, formData.obc_certificate_id, VALUE_FIFTEEN);
            }

            if (formData.father_election_card_doc != '') {
                that.showDocument('father_election_card_doc_container_for_obc_certificate', 'father_election_card_doc_name_image_for_obc_certificate', 'father_election_card_doc_name_container_for_obc_certificate',
                        'father_election_card_doc_download', 'father_election_card_doc', formData.father_election_card_doc, formData.obc_certificate_id, VALUE_SIXTEEN);
            }

            if (formData.mother_election_card_doc != '') {
                that.showDocument('mother_election_card_doc_container_for_obc_certificate', 'mother_election_card_doc_name_image_for_obc_certificate', 'mother_election_card_doc_name_container_for_obc_certificate',
                        'mother_election_card_doc_download', 'mother_election_card_doc', formData.mother_election_card_doc, formData.obc_certificate_id, VALUE_SEVENTEEN);
            }

            if (formData.father_alive == VALUE_ONE) {
                $('.father_proof_item_container_for_obc_certificate').show();
                $('.father_death_proof_item_container_for_obc_certificate').hide();
            } else if (formData.father_alive == VALUE_TWO) {
                $('.father_proof_item_container_for_obc_certificate').hide();
                $('.father_death_proof_item_container_for_obc_certificate').show();
            }

            if (formData.father_alive == VALUE_ONE) {
                $("#father_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#father_alive_for_obc_certificate_2").prop("checked", true);
                $('.f-gov-job').removeClass('d-none');
                $('.f-gov-job').hide();
            }

            if (formData.mother_alive == VALUE_ONE) {
                $("#mother_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#mother_alive_for_obc_certificate_2").prop("checked", true);
                $('.m-gov-job').removeClass('d-none');
                $('.m-gov-job').hide();

            }

            if (formData.grandfather_alive == VALUE_ONE) {
                $("#grandfather_alive_for_obc_certificate_1").prop("checked", true);
            } else {
                $("#grandfather_alive_for_obc_certificate_2").prop("checked", true);
            }

        } else {
            $("#father_alive_for_obc_certificate_1").prop("checked", true);
            $("#mother_alive_for_obc_certificate_1").prop("checked", true);
            $("#grandfather_alive_for_obc_certificate_1").prop("checked", true);

        }

        generateSelect2();
        datePicker();
        datePickerMin('applicant_dob_for_oc');
        resetCounterForDocument('doc_no_for_obc_certificate', 27);

    },

    editOrViewObcCertificate: function (btnObj, obcCertificateId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!obcCertificateId) {
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
            url: 'obc_certificate/get_obc_certificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'obc_certificate_id': obcCertificateId, 'is_edit_view': isEditOrView}, getTokenData()),
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
                    var obcCertificateData = parseData.obc_certificate_data;

                    if (obcCertificateData.constitution_artical == VALUE_ONE)
                        that.typeMajorObcCertificateForm(isEdit, parseData);
                    else if (obcCertificateData.constitution_artical == VALUE_TWO)
                        that.typeMinorObcCertificateForm(isEdit, parseData);
                } else {
                    var obcCertificateData = parseData.obc_certificate_data;
                    that.viewObcCertificateForm(VALUE_ONE, obcCertificateData, isPrint);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', OBC_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", OBC_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'ObcCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },

    viewObcCertificateForm: function (moduleType, obcCertificateData, isPrint) {
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

            ObcCertificate.router.navigate('view_obc_certificate_form');
            obcCertificateData.title = 'View';

        } else {

            obcCertificateData.show_submit_btn = true;
            //alert(obcCertificateData);
            //console.log(obcCertificateData.show_submit_btn);
        }
        obcCertificateData.VALUE_THREE = VALUE_THREE;
        obcCertificateData.OBC_CERTIFICATE_DOC_PATH = OBC_CERTIFICATE_DOC_PATH;

        obcCertificateData.is_checked = isChecked;
        obcCertificateData.VALUE_ONE = VALUE_ONE;
        obcCertificateData.VALUE_TWO = VALUE_TWO;
        obcCertificateData.VALUE_THREE = VALUE_THREE;
        obcCertificateData.VALUE_FOUR = VALUE_FOUR;
        obcCertificateData.VALUE_FIVE = VALUE_FIVE;
        obcCertificateData.VALUE_SIX = VALUE_SIX;
        obcCertificateData.VALUE_SEVEN = VALUE_SEVEN;
        obcCertificateData.IS_CHECKED_YES = IS_CHECKED_YES;
        obcCertificateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        obcCertificateData.show_constitution_artical_detail = true;

        var fatherDetails = obcCertificateData.father_details != '' ? JSON.parse(obcCertificateData.father_details) : {};
        var motherDetails = obcCertificateData.mother_details != '' ? JSON.parse(obcCertificateData.mother_details) : {};
        var spouseDetails = obcCertificateData.spouse_details != '' ? JSON.parse(obcCertificateData.spouse_details) : {};
        var grandfatherDetails = obcCertificateData.grandfather_details != '' ? JSON.parse(obcCertificateData.grandfather_details) : {};

        var application_type = obcCertificateData.constitution_artical ? obcCertificateData.constitution_artical : '';

        if (application_type == VALUE_ONE) {
            obcCertificateData.show_applicant_data = true;
            obcCertificateData.show_constitution_artical_detail = false;
            obcCertificateData.application_type_text = 'Major';
            obcCertificateData.application_type_title = ' Applicant Name';
            obcCertificateData.show_marital_status = true;
            obcCertificateData.show_applicant_name = true;
            obcCertificateData.show_election = true;
            obcCertificateData.show_profession = true;
            obcCertificateData.show_spouse_detail = true;
            obcCertificateData.show_minor_data = false;
            obcCertificateData.show_marital_status_data = true;
            obcCertificateData.show_education = true;
        } else if (application_type == VALUE_TWO) {
            obcCertificateData.show_gaudian_data = true;
            obcCertificateData.application_type_text = 'Minor';
            obcCertificateData.application_type_title = '/ Guardian Name';
            obcCertificateData.show_minor_child_name = true;
            obcCertificateData.show_spouse_detail = false;
            obcCertificateData.show_minor_data = true;
            // obcCertificateData.show_marital_status = false;
            obcCertificateData.show_marital_status_data = false;
        } else if (obcCertificateData.father_alive == VALUE_ONE) {
            obcCertificateData.show_father_alive = true;
            obcCertificateData.show_mother_alive = true;
            obcCertificateData.show_grandfather_alive = true;
        } else if (obcCertificateData.father_alive == VALUE_TWO) {
            obcCertificateData.show_father_alive = true;
            // obcCertificateData.show_mother_alive = true;
            // obcCertificateData.show_grandfather_alive = true;
        }

        obcCertificateData.district_text = talukaArray[obcCertificateData.district] ? talukaArray[obcCertificateData.district] : '';
        var district = obcCertificateData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        obcCertificateData.village_name_text = villageData[obcCertificateData.village_name] ? villageData[obcCertificateData.village_name] : '';

        obcCertificateData.com_addr_house_name = obcCertificateData.com_addr_house_name == '' ? '' : obcCertificateData.com_addr_house_name + ',';
        obcCertificateData.per_addr_house_name = obcCertificateData.per_addr_house_name == '' ? '' : obcCertificateData.per_addr_house_name + ',';

        obcCertificateData.gender_text = genderArray[obcCertificateData.gender] ? genderArray[obcCertificateData.gender] : '';
        obcCertificateData.applicant_dob_text = obcCertificateData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(obcCertificateData.applicant_dob) : '';
        obcCertificateData.occupation_text = applicantOccupationArray[obcCertificateData.occupation] ? (obcCertificateData.occupation == VALUE_TWELVE ? obcCertificateData.other_occupation : applicantOccupationArray[obcCertificateData.occupation]) : '-';
        obcCertificateData.marital_status_text = maritalStatusArray[obcCertificateData.marital_status] ? maritalStatusArray[obcCertificateData.marital_status] : '';
        obcCertificateData.father_occupation_text = applicantOccupationArray[fatherDetails.father_occupation] ? (fatherDetails.father_occupation == VALUE_TWELVE ? fatherDetails.father_other_occupation : applicantOccupationArray[fatherDetails.father_occupation]) : '';
        obcCertificateData.mother_occupation_text = applicantOccupationArray[motherDetails.mother_occupation] ? (motherDetails.mother_occupation == VALUE_TWELVE ? motherDetails.mother_other_occupation : applicantOccupationArray[motherDetails.mother_occupation]) : '';
        obcCertificateData.grandfather_occupation_text = applicantOccupationArray[grandfatherDetails.grandfather_occupation] ? (grandfatherDetails.grandfather_occupation == VALUE_TWELVE ? grandfatherDetails.grandfather_other_occupation : applicantOccupationArray[grandfatherDetails.grandfather_occupation]) : '';
        obcCertificateData.obccaste_text = applicantobccasteArray[obcCertificateData.obccaste] ? applicantobccasteArray[obcCertificateData.obccaste] : '';

        obcCertificateData.applicant_caste_text = applicantobccasteArray[obcCertificateData.obccaste] ? applicantobccasteArray[obcCertificateData.obccaste] : '';
        obcCertificateData.applicant_education = educationTypeArray[obcCertificateData.applicant_education] ? educationTypeArray[obcCertificateData.applicant_education] : ' ';


        obcCertificateData.show_father_mother_info = true;
        if (obcCertificateData.marital_status == VALUE_ONE) {
            obcCertificateData.show_spouse = true;
            obcCertificateData.spouse_occupation_text = applicantOccupationArray[spouseDetails.spouse_occupation] ? (spouseDetails.spouse_occupation == VALUE_TWELVE ? spouseDetails.spouse_other_occupation : applicantOccupationArray[spouseDetails.spouse_occupation]) : '';
        }
        obcCertificateData.family_annual_income = obcCertificateData.family_annual_income ? obcCertificateData.family_annual_income : '-';
        obcCertificateData.father_annual_income = fatherDetails.father_annual_income ? fatherDetails.father_annual_income : '-';
        obcCertificateData.mother_annual_income = motherDetails.mother_annual_income ? motherDetails.mother_annual_income : '-';
        obcCertificateData.spouse_annual_income = spouseDetails.spouse_annual_income ? spouseDetails.spouse_annual_income : '-';




        obcCertificateData.election_no = obcCertificateData.election_no ? obcCertificateData.election_no : '-';
        obcCertificateData.father_election_no = fatherDetails.father_election_no ? fatherDetails.father_election_no : '-';
        obcCertificateData.mother_election_no = motherDetails.mother_election_no ? motherDetails.mother_election_no : '-';
        obcCertificateData.spouse_election_no = spouseDetails.spouse_election_no ? spouseDetails.spouse_election_no : '-';
        obcCertificateData.grandfather_election_no = grandfatherDetails.grandfather_election_no ? grandfatherDetails.grandfather_election_no : '-';

        obcCertificateData.name_of_school = obcCertificateData.name_of_school ? obcCertificateData.name_of_school : '-';


        obcCertificateData.aadhaar = obcCertificateData.aadhaar ? obcCertificateData.aadhaar : '-';
        obcCertificateData.father_aadhaar = fatherDetails.father_aadhaar ? fatherDetails.father_aadhaar : '-';
        obcCertificateData.mother_aadhaar = motherDetails.mother_aadhaar ? motherDetails.mother_aadhaar : '-';
        obcCertificateData.spouse_aadhaar = spouseDetails.spouse_aadhaar ? spouseDetails.spouse_aadhaar : '-';
        obcCertificateData.grandfather_aadhaar_text = grandfatherDetails.grandfather_aadhaar ? grandfatherDetails.grandfather_aadhaar : '-';

        obcCertificateData.applicant_occupation_text = applicantOccupationArray[obcCertificateData.occupation] ? (obcCertificateData.occupation == VALUE_TWELVE ? obcCertificateData.other_occupation : applicantOccupationArray[obcCertificateData.occupation]) : '-';

        obcCertificateData.email = obcCertificateData.email ? obcCertificateData.email : '-';

        obcCertificateData.father_name = fatherDetails.father_name ? fatherDetails.father_name : '-';
        obcCertificateData.father_nationality = fatherDetails.father_nationality ? fatherDetails.father_nationality : '-';
        obcCertificateData.father_born_place_state_text = fatherDetails.father_born_place_state_text ? fatherDetails.father_born_place_state_text : '-';
        obcCertificateData.father_born_place_district_text = fatherDetails.father_born_place_district_text ? fatherDetails.father_born_place_district_text : '-';
        obcCertificateData.father_born_place_village_text = fatherDetails.father_born_place_village_text ? fatherDetails.father_born_place_village_text : '-';
        obcCertificateData.father_native_place_village_data = fatherDetails.father_native_place_village_text;
        obcCertificateData.father_native_place_district_text = fatherDetails.father_native_place_district_text;
        obcCertificateData.father_city_text = fatherDetails.father_city_text;
        obcCertificateData.father_caste = applicantobccasteArray[fatherDetails.father_caste] ? applicantobccasteArray[fatherDetails.father_caste] : '';
        obcCertificateData.father_religion = fatherDetails.father_religion;

        obcCertificateData.mother_name = motherDetails.mother_name ? motherDetails.mother_name : '-';
        obcCertificateData.mother_nationality = motherDetails.mother_nationality ? motherDetails.mother_nationality : '-';
        obcCertificateData.mother_born_place_state_text = motherDetails.mother_born_place_state_text ? motherDetails.mother_born_place_state_text : '-';
        obcCertificateData.mother_born_place_district_text = motherDetails.mother_born_place_district_text ? motherDetails.mother_born_place_district_text : '-';
        obcCertificateData.mother_born_place_village_text = motherDetails.mother_born_place_village_text ? motherDetails.mother_born_place_village_text : '-';
        obcCertificateData.mother_native_place_state_text = motherDetails.mother_native_place_state_text ? motherDetails.mother_native_place_state_text : '-';
        obcCertificateData.mother_native_place_district_text = motherDetails.mother_native_place_district_text ? motherDetails.mother_native_place_district_text : '-';
        obcCertificateData.mother_native_place_village_text = motherDetails.mother_native_place_village_text ? motherDetails.mother_native_place_village_text : '-';
        obcCertificateData.mother_caste = motherDetails.mother_caste ? motherDetails.mother_caste : '';
        obcCertificateData.mother_religion = motherDetails.mother_religion;

        obcCertificateData.spouse_name = spouseDetails.spouse_name ? spouseDetails.spouse_name : '-';
        obcCertificateData.spouse_nationality = spouseDetails.spouse_nationality ? spouseDetails.spouse_nationality : '-';
        obcCertificateData.spouse_born_place_state_text = spouseDetails.spouse_born_place_state_text ? spouseDetails.spouse_born_place_state_text : '-';
        obcCertificateData.spouse_born_place_district_text = spouseDetails.spouse_born_place_district_text ? spouseDetails.spouse_born_place_district_text : '-';
        obcCertificateData.spouse_born_place_village_text = spouseDetails.spouse_born_place_village_text ? spouseDetails.spouse_born_place_village_text : '-';
        obcCertificateData.spouse_native_place_state_text = spouseDetails.spouse_native_place_state_text ? spouseDetails.spouse_native_place_state_text : '-';
        obcCertificateData.spouse_native_place_district_text = spouseDetails.spouse_native_place_district_text ? spouseDetails.spouse_native_place_district_text : '-';
        obcCertificateData.spouse_native_place_village_text = spouseDetails.spouse_native_place_village_text ? spouseDetails.spouse_native_place_village_text : '-';
        obcCertificateData.spouse_caste = spouseDetails.spouse_caste ? spouseDetails.spouse_caste : '';
        obcCertificateData.spouse_religion = spouseDetails.spouse_religion;

        obcCertificateData.grandfather_name = grandfatherDetails.grandfather_name ? grandfatherDetails.grandfather_name : '-';
        obcCertificateData.grandfather_nationality = grandfatherDetails.grandfather_nationality ? grandfatherDetails.grandfather_nationality : '-';
        obcCertificateData.grandfather_borncity_text = grandfatherDetails.grandfather_borncity_text ? grandfatherDetails.grandfather_borncity_text : '-';
        obcCertificateData.grandfather_born_place_district_text = grandfatherDetails.grandfather_born_place_district_text ? grandfatherDetails.grandfather_born_place_district_text : '-';
        obcCertificateData.grandfather_born_place_village_data = grandfatherDetails.grandfather_born_place_village_text ? grandfatherDetails.grandfather_born_place_village_text : '-';
        obcCertificateData.grandfather_city_text = grandfatherDetails.grandfather_city_text ? grandfatherDetails.grandfather_city_text : '-';
        obcCertificateData.grandfather_native_place_village_data = grandfatherDetails.grandfather_native_place_village_text ? grandfatherDetails.grandfather_native_place_village_text : '-';
        obcCertificateData.grandfather_native_place_district_text = grandfatherDetails.grandfather_native_place_district_text ? grandfatherDetails.grandfather_native_place_district_text : '-';
        obcCertificateData.grandfather_caste = applicantobccasteArray[grandfatherDetails.grandfather_caste] ? applicantobccasteArray[grandfatherDetails.grandfather_caste] : '';
        obcCertificateData.grandfather_religion = grandfatherDetails.grandfather_religion;

        obcCertificateData.com_addr_city = obcCertificateData.com_addr_city;
        obcCertificateData.grandfather_city_text = grandfatherDetails.grandfather_city_text;
        obcCertificateData.father_city_text = fatherDetails.father_city_text;

        obcCertificateData.native_place_state_text = stateArray[obcCertificateData.native_place_state] ? stateArray[obcCertificateData.native_place_state] : '';

        obcCertificateData.native_place_district_text = damandiudistrictArray[obcCertificateData.native_place_district] ? damandiudistrictArray[obcCertificateData.native_place_district] : '';

        var district = obcCertificateData.native_place_district;
        var villageData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
        obcCertificateData.native_place_village_text = villageData[obcCertificateData.native_place_village] ? villageData[obcCertificateData.native_place_village] : '';


        // var district = obcCertificateData.district;
        // var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        // obcCertificateData.father_native_place_village_text = villageData[fatherDetails.father_native_place_village] ? villageData[fatherDetails.father_native_place_village] : '';


        // var district = obcCertificateData.district;
        // var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        // obcCertificateData.grandfather_native_place_village_text = villageData[grandfatherDetails.grandfather_native_place_village] ? villageData[grandfatherDetails.grandfather_native_place_village] : '';

        // var district = obcCertificateData.district;
        // var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        // obcCertificateData.grandfather_born_place_village_text = villageData[grandfatherDetails.grandfather_born_place_village] ? villageData[grandfatherDetails.grandfather_born_place_village] : '';




        var val = obcCertificateData.constitution_artical;

        //-------------------------------------------------
        obcCertificateData.show_tax_payer_copy = obcCertificateData.tax_payer_copy != '' ? true : false;
        obcCertificateData.show_applicant_photo_doc = obcCertificateData.applicant_photo_doc != '' ? true : false;
        obcCertificateData.show_minor_child_photo_doc = obcCertificateData.minor_child_photo_doc != '' ? true : false;
        obcCertificateData.show_self_birth_certificate_doc = obcCertificateData.self_birth_certificate_doc != '' ? true : false;
        obcCertificateData.show_father_certificate_doc = obcCertificateData.father_certificate_doc != '' ? true : false;
        obcCertificateData.show_father_election_card_doc = obcCertificateData.father_election_card_doc != '' ? true : false;
        obcCertificateData.show_father_aadhar_card_doc = obcCertificateData.father_aadhar_card_doc != '' ? true : false;
        obcCertificateData.show_mother_election_card_doc = obcCertificateData.mother_election_card_doc != '' ? true : false;
        obcCertificateData.show_mother_aadhar_card_doc = obcCertificateData.mother_aadhar_card_doc != '' ? true : false;
        obcCertificateData.show_grandfather_birth_certificate_doc = obcCertificateData.grandfather_birth_certificate_doc != '' ? true : false;
        obcCertificateData.show_grandfather_property_doc = obcCertificateData.grandfather_property_doc != '' ? true : false;
        obcCertificateData.show_father_community_death_doc = obcCertificateData.father_community_death_doc != '' ? true : false;
        obcCertificateData.show_election_card_doc = obcCertificateData.election_card_doc != '' ? true : false;
        obcCertificateData.show_aadhar_card_doc = obcCertificateData.aadhar_card_doc != '' ? true : false;
        obcCertificateData.show_community_certificate_doc = obcCertificateData.community_certificate_doc != '' ? true : false;
        obcCertificateData.show_tax_payer_copy = obcCertificateData.tax_payer_copy != '' ? true : false;
        obcCertificateData.show_income_certificate = obcCertificateData.income_certificate != '' ? true : false;

        obcCertificateData.relationship_of_applicant_text = relationDeceasedPersonArray[obcCertificateData.relationship_of_applicant] ? relationDeceasedPersonArray[obcCertificateData.relationship_of_applicant] : '';

        obcCertificateData.show_declaration_btn = moduleType == VALUE_ONE ? true : (obcCertificateData.declaration == VALUE_ONE ? true : false);
        if (obcCertificateData.status != VALUE_ZERO && obcCertificateData.status != VALUE_ONE) {
            obcCertificateData.show_print_btn = true;
        }
        if (obcCertificateData.constitution_artical == VALUE_TWO) {
            obcCertificateData.show_gaudian_data = true;
            obcCertificateData.show_hide_info = false;
        } else {
            obcCertificateData.show_hide_info = true;
        }
        obcCertificateData.submitted_datetime_text = obcCertificateData.submitted_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY(obcCertificateData.submitted_datetime) : dateTo_DD_MM_YYYY(obcCertificateData.created_time);
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(obcCertificateViewTemplate(obcCertificateData));
        if (obcCertificateData.status != VALUE_ONE || obcCertificateData.status != VALUE_ZERO) {
            if (obcCertificateData.declaration == VALUE_ONE) {
                $('#declaration_for_obc_certificate').click();
            }
        }
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_ocview').click();
            }, 500);
        }
    },

    checkValidationForObcCertificate: function (obcCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        if (!obcCertificateData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!obcCertificateData.village_name) {
            return getBasicMessageAndFieldJSONArray('village_name_for_oc', villageNameValidationMessage);
        }
        if (!obcCertificateData.applicant_name) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_oc', applicantNameValidationMessage);
        }
        if (obcCertificateData.constitution_artical == VALUE_TWO) {
            if (!obcCertificateData.relationship_of_applicant) {
                return getBasicMessageAndFieldJSONArray('relationship_of_applicant_for_oc', relationWithDeceasedPersonValidationMessage);
            }
            if (!obcCertificateData.guardian_address) {
                return getBasicMessageAndFieldJSONArray('guardian_address_for_oc', guardianAddressValidationMessage);
            }
            if (!obcCertificateData.guardian_mobile_no) {
                return getBasicMessageAndFieldJSONArray('guardian_mobile_no_for_oc', mobileValidationMessage);
            }
            if (!obcCertificateData.guardian_aadhaar) {
                return getBasicMessageAndFieldJSONArray('guardian_aadhaar_for_oc', invalidAadharNumberValidationMessage);
            }
            if (!obcCertificateData.minor_child_name) {
                return getBasicMessageAndFieldJSONArray('minor_child_name_for_oc', minorChildNameValidationMessage);
            }
        }

        if (!obcCertificateData.com_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('com_addr_house_no_for_oc', houseNoValidationMessage);
        }
        if (!obcCertificateData.com_addr_street) {
            return getBasicMessageAndFieldJSONArray('com_addr_street_for_oc', streetValidationMessage);
        }
        if (!obcCertificateData.com_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('com_addr_village_dmc_ward_for_oc', villageNameValidationMessage);
        }
        if (!obcCertificateData.com_addr_city) {
            return getBasicMessageAndFieldJSONArray('com_addr_city_for_oc', selectCityValidationMessage);
        }
        if (!obcCertificateData.com_pincode) {
            return getBasicMessageAndFieldJSONArray('com_pincode_for_oc', pincodeValidationMessage);
        }

        if (!obcCertificateData.per_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('per_addr_house_no_for_oc', houseNoValidationMessage);
        }
        if (!obcCertificateData.per_addr_street) {
            return getBasicMessageAndFieldJSONArray('per_addr_street_for_oc', streetValidationMessage);
        }
        if (!obcCertificateData.per_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('per_addr_village_dmc_ward_for_oc', villageNameValidationMessage);
        }
        if (!obcCertificateData.per_addr_city) {
            return getBasicMessageAndFieldJSONArray('per_addr_city_for_oc', selectCityValidationMessage);
        }
        if (!obcCertificateData.per_pincode) {
            return getBasicMessageAndFieldJSONArray('per_pincode_for_oc', pincodeValidationMessage);
        }

        if (obcCertificateData.constitution_artical == VALUE_ONE) {
            if (!obcCertificateData.mobile_number) {
                return getBasicMessageAndFieldJSONArray('mobile_number_for_oc', mobileValidationMessage);
            }
        }

        //  if (!obcCertificateData.aadhaar) {
        //     return getBasicMessageAndFieldJSONArray('aadhaar_for_oc', invalidAadharNumberValidationMessage);
        // }
        // if(obcCertificateData.constitution_artical == VALUE_ONE){
        //     if (!obcCertificateData.election_no) {
        //         return getBasicMessageAndFieldJSONArray('election_no_for_oc', electionNumberValidationMessage);
        //     }
        // }
        if (!obcCertificateData.applicant_age) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_oc', applicantAgeValidationMessage);
        }
        if (!obcCertificateData.applicant_nationality) {
            return getBasicMessageAndFieldJSONArray('applicant_nationality_for_oc', applicantNationalityValidationMessage);
        }
        if (obcCertificateData.constitution_artical == VALUE_ONE) {
            if (!obcCertificateData.applicant_education) {
                return getBasicMessageAndFieldJSONArray('applicant_education_for_oc', applicantEducationValidationMessage);
            }
            if (obcCertificateData.applicant_education == VALUE_FIVE) {
                if (!obcCertificateData.other_education) {
                    return getBasicMessageAndFieldJSONArray('other_education_for_oc', applicantEducationValidationMessage);
                }
            }
            if (!obcCertificateData.name_of_school) {
                return getBasicMessageAndFieldJSONArray('name_of_school_for_oc', schoolNameValidationMessage);
            }
        }
        if (obcCertificateData.constitution_artical == VALUE_TWO) {
            if (!obcCertificateData.minor_education) {
                return getBasicMessageAndFieldJSONArray('minor_education_for_oc', applicantEducationValidationMessage);
            }
        }
        if (!obcCertificateData.born_place_state) {
            return getBasicMessageAndFieldJSONArray('born_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obcCertificateData.born_place_district) {
            return getBasicMessageAndFieldJSONArray('born_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obcCertificateData.born_place_village) {
            return getBasicMessageAndFieldJSONArray('born_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obcCertificateData.born_place_pincode) {
            return getBasicMessageAndFieldJSONArray('born_place_pincode_for_oc', pincodeValidationMessage);
        }
        if (!obcCertificateData.native_place_state) {
            return getBasicMessageAndFieldJSONArray('native_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obcCertificateData.native_place_district) {
            return getBasicMessageAndFieldJSONArray('native_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obcCertificateData.native_place_village) {
            return getBasicMessageAndFieldJSONArray('native_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obcCertificateData.native_place_pincode) {
            return getBasicMessageAndFieldJSONArray('native_place_pincode_for_oc', pincodeValidationMessage);
        }
        if (!obcCertificateData.gender_for_oc) {
            $('#gender_for_oc_1').focus();
            return getBasicMessageAndFieldJSONArray('gender_for_oc', genderValidationMessage);
        }

        if (obcCertificateData.constitution_artical == VALUE_ONE) {
            if (!obcCertificateData.marital_status_for_oc) {
                $('#marital_status_for_oc_1').focus();
                return getBasicMessageAndFieldJSONArray('marital_status_for_oc', maritalStatusValidationMessage);
            }
        }

        if (!obcCertificateData.obccaste) {
            return getBasicMessageAndFieldJSONArray('obccaste_for_oc', castesValidationMessage);
        }
        if (!obcCertificateData.religion) {
            return getBasicMessageAndFieldJSONArray('religion_for_oc', religionValidationMessage);
        }
        if (!obcCertificateData.nearest_police_station) {
            return getBasicMessageAndFieldJSONArray('nearest_police_station_for_oc', nearestPoliceStationValidationMessage);
        }
        if (obcCertificateData.constitution_artical == VALUE_ONE) {
            if (!obcCertificateData.occupation) {
                return getBasicMessageAndFieldJSONArray('occupation_for_oc', occupationValidationMessage);
            }


            if (obcCertificateData.occupation == VALUE_TWELVE) {
                if (!obcCertificateData.other_occupation) {
                    return getBasicMessageAndFieldJSONArray('other_occupation_for_oc', otherOccupationValidationMessage);
                }
            }
        }
        if (!obcCertificateData.father_name) {
            return getBasicMessageAndFieldJSONArray('father_name_for_oc', fatherNameValidationMessage);
        }
        if (!obcCertificateData.father_nationality) {
            return getBasicMessageAndFieldJSONArray('father_nationality_for_oc', nationalityValidationMessage);
        }
        if (!obcCertificateData.father_born_place_state) {
            return getBasicMessageAndFieldJSONArray('father_born_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obcCertificateData.father_born_place_district) {
            return getBasicMessageAndFieldJSONArray('father_born_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obcCertificateData.father_born_place_village) {
            return getBasicMessageAndFieldJSONArray('father_born_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obcCertificateData.father_native_place_district) {
            return getBasicMessageAndFieldJSONArray('father_native_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obcCertificateData.father_city) {
            return getBasicMessageAndFieldJSONArray('father_city_for_oc', selectVillageValidationMessage);
        }
        if (!obcCertificateData.father_native_place_village) {
            return getBasicMessageAndFieldJSONArray('father_native_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obcCertificateData.father_religion) {
            return getBasicMessageAndFieldJSONArray('father_religion_for_oc', religionValidationMessage);
        }
        if (!obcCertificateData.father_caste) {
            return getBasicMessageAndFieldJSONArray('father_caste_for_oc', castesValidationMessage);
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (!obcCertificateData.father_annual_income) {
                $('#father_alive_for_obc_certificate_1').focus();
                return getBasicMessageAndFieldJSONArray('father_annual_income_for_oc', annualIncomeValidationMessage);
            }
            if (!obcCertificateData.father_occupation) {
                $('#father_alive_for_obc_certificate_1').focus();
                return getBasicMessageAndFieldJSONArray('father_occupation_for_oc', occupationValidationMessage);
            }
            if (obcCertificateData.father_occupation == VALUE_TWELVE) {
                if (!obcCertificateData.father_other_occupation) {
                    $('#father_alive_for_obc_certificate_1').focus();
                    return getBasicMessageAndFieldJSONArray('father_other_occupation_for_oc', otherOccupationValidationMessage);
                }
            }
        }
        if (!obcCertificateData.mother_name) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_oc', motherNameValidationMessage);
        }
        if (!obcCertificateData.mother_nationality) {
            return getBasicMessageAndFieldJSONArray('mother_nationality_for_oc', nationalityValidationMessage);
        }
        if (!obcCertificateData.mother_born_place_state) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obcCertificateData.mother_born_place_district) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obcCertificateData.mother_born_place_village) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obcCertificateData.mother_native_place_state) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obcCertificateData.mother_native_place_district) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obcCertificateData.mother_native_place_village) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obcCertificateData.mother_religion) {
            return getBasicMessageAndFieldJSONArray('mother_religion_for_oc', religionValidationMessage);
        }
        if (!obcCertificateData.mother_caste) {
            return getBasicMessageAndFieldJSONArray('mother_caste', castesValidationMessage);
        }

        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (!obcCertificateData.mother_annual_income) {
                $('#father_alive_for_obc_certificate_1').focus();
                return getBasicMessageAndFieldJSONArray('mother_annual_income_for_oc', annualIncomeValidationMessage);
            }
            if (!obcCertificateData.mother_occupation) {
                $('#father_alive_for_obc_certificate_1').focus();
                return getBasicMessageAndFieldJSONArray('mother_occupation_for_oc', occupationValidationMessage);
            }
            if (obcCertificateData.mother_occupation == VALUE_TWELVE) {
                if (!obcCertificateData.mother_other_occupation) {
                    $('#father_alive_for_obc_certificate_1').focus();
                    return getBasicMessageAndFieldJSONArray('mother_other_occupation_for_oc', otherOccupationValidationMessage);
                }
            }
        }


        if (!obcCertificateData.grandfather_name) {
            return getBasicMessageAndFieldJSONArray('grandfather_name_for_oc', grandfatherValidationMessage);
        }
        if (!obcCertificateData.grandfather_nationality) {
            return getBasicMessageAndFieldJSONArray('grandfather_nationality_for_oc', nationalityValidationMessage);
        }
        if (!obcCertificateData.grandfather_born_place_district) {
            return getBasicMessageAndFieldJSONArray('grandfather_born_place_district_for_oc', selectStateValidationMessage);
        }
        if (!obcCertificateData.grandfather_borncity) {
            return getBasicMessageAndFieldJSONArray('grandfather_borncity_for_oc', selectCityValidationMessage);
        }
        if (!obcCertificateData.grandfather_born_place_village) {
            return getBasicMessageAndFieldJSONArray('grandfather_born_place_village_for_oc', selectStateValidationMessage);
        }


        if (!obcCertificateData.grandfather_native_place_district) {
            return getBasicMessageAndFieldJSONArray('grandfather_native_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obcCertificateData.grandfather_city) {
            return getBasicMessageAndFieldJSONArray('grandfather_city_for_oc', selectCityValidationMessage);
        }
        if (!obcCertificateData.grandfather_native_place_village) {
            return getBasicMessageAndFieldJSONArray('grandfather_native_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obcCertificateData.grandfather_religion) {
            return getBasicMessageAndFieldJSONArray('grandfather_religion_for_oc', religionValidationMessage);
        }
        if (!obcCertificateData.grandfather_caste) {
            return getBasicMessageAndFieldJSONArray('grandfather_caste_for_oc', castesValidationMessage);
        }

        if (obcCertificateData.grandfather_alive_for_obc_certificate == VALUE_ONE) {
            if (!obcCertificateData.grandfather_occupation) {
                $('#grandfather_alive_for_obc_certificate_1').focus();
                return getBasicMessageAndFieldJSONArray('grandfather_occupation_for_oc', occupationValidationMessage);
            }
            if (obcCertificateData.grandfather_occupation == VALUE_TWELVE) {
                if (!obcCertificateData.grandfather_other_occupation) {
                    $('#grandfather_alive_for_obc_certificate_1').focus();
                    return getBasicMessageAndFieldJSONArray('grandfather_other_occupation_for_oc', otherOccupationValidationMessage);
                }
            }
        }

        if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
            if (!obcCertificateData.spouse_name) {
                return getBasicMessageAndFieldJSONArray('spouse_name_for_oc', spouseNameValidationMessage);
            }
            if (!obcCertificateData.spouse_nationality) {
                return getBasicMessageAndFieldJSONArray('spouse_nationality_for_oc', nationalityValidationMessage);
            }

            if (!obcCertificateData.spouse_born_place_state) {
                return getBasicMessageAndFieldJSONArray('spouse_born_place_state_for_oc', selectStateValidationMessage);
            }
            if (!obcCertificateData.spouse_born_place_district) {
                return getBasicMessageAndFieldJSONArray('spouse_born_place_district_for_oc', selectDistrictValidationMessage);
            }
            if (!obcCertificateData.spouse_born_place_village) {
                return getBasicMessageAndFieldJSONArray('spouse_born_place_village_for_oc', selectVillageValidationMessage);
            }
            if (!obcCertificateData.spouse_native_place_state) {
                return getBasicMessageAndFieldJSONArray('spouse_native_place_state_for_oc', selectStateValidationMessage);
            }
            if (!obcCertificateData.spouse_native_place_district) {
                return getBasicMessageAndFieldJSONArray('spouse_native_place_district_for_oc', selectDistrictValidationMessage);
            }
            if (!obcCertificateData.spouse_native_place_village) {
                return getBasicMessageAndFieldJSONArray('spouse_native_place_village_for_oc', selectVillageValidationMessage);
            }
            if (!obcCertificateData.spouse_religion_for_oc) {
                return getBasicMessageAndFieldJSONArray('spouse_religion_for_oc', religionValidationMessage);
            }
            if (!obcCertificateData.spouse_caste) {
                return getBasicMessageAndFieldJSONArray('spouse_caste', castesValidationMessage);
            }

            if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
                if (!obcCertificateData.spouse_annual_income) {
                    $('#spouse_alive_for_obc_certificate_1').focus();
                    return getBasicMessageAndFieldJSONArray('spouse_annual_income_for_oc', annualIncomeValidationMessage);
                }
                if (!obcCertificateData.spouse_occupation) {
                    $('#spouse_alive_for_obc_certificate_1').focus();
                    return getBasicMessageAndFieldJSONArray('spouse_occupation_for_oc', occupationValidationMessage);
                }
                if (obcCertificateData.spouse_occupation == VALUE_TWELVE) {
                    if (!obcCertificateData.spouse_other_occupation) {
                        $('#spouse_alive_for_obc_certificate_1').focus();
                        return getBasicMessageAndFieldJSONArray('spouse_other_occupation_for_oc', otherOccupationValidationMessage);
                    }
                }

            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_designation_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_designation_for_oc', fathergovDetailsValidationMessage);
                }
            }

        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_designation_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_designation_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }

        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_designation_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_designation_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_services_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_services_for_oc', fathergovDetailsValidationMessage);
                }
            }

        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_services_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_services_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }

        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_services_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_services_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_designation_b_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_designation_b_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_designation_b_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_designation_b_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_designation_b_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_designation_b_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_scale_of_pay_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_scale_of_pay_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_scale_of_pay_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_scale_of_pay_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_scale_of_pay_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_scale_of_pay_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_appointment_date_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_appointment_date_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_appointment_date_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_appointment_date_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_appointment_date_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_appointment_date_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_promotion_age_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_promotion_age_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_promotion_age_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_promotion_age_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_promotion_age_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_promotion_age_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_organization_name_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_organization_name_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_organization_name_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_organization_name_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_organization_name_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_organization_name_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_designation_b1_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_designation_b1_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_designation_b1_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_designation_b1_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_designation_b1_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_designation_b1_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }


        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_service_period_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_service_period_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_service_period_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_service_period_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_service_period_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_service_period_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_permanent_incapacitation_service_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_permanent_incapacitation_service_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_permanent_incapacitation_service_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_permanent_incapacitation_service_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_permanent_incapacitation_service_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_permanent_incapacitation_service_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_permanent_incapacitation_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_permanent_incapacitation_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_permanent_incapacitation_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_permanent_incapacitation_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_permanent_incapacitation_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_permanent_incapacitation_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_organization_name_partc_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_organization_name_partc_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_organization_name_partc_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_organization_name_partc_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_organization_name_partc_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_organization_name_partc_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_designation_partc_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_designation_partc_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_designation_partc_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_designation_partc_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_designation_partc_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_designation_partc_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_date_of_appointmet_partc_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_date_of_appointmet_partc_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_date_of_appointmet_partc_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_date_of_appointmet_partc_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_date_of_appointmet_partc_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_date_of_appointmet_partc_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_designation_partd_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_designation_partd_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_designation_partd_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_designation_partd_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_designation_partd_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_designation_partd_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_scale_of_pay_partd_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_scale_of_pay_partd_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_scale_of_pay_partd_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_scale_of_pay_partd_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_scale_of_pay_partd_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_scale_of_pay_partd_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_occupation_family_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_occupation_family_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_occupation_family_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_occupation_family_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_occupation_family_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_occupation_family_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_location_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_location_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_location_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_location_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_location_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_location_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_size_of_holding_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_size_of_holding_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_size_of_holding_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_size_of_holding_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_size_of_holding_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_size_of_holding_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_irrigated_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_irrigated_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_irrigated_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_irrigated_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_irrigated_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_irrigated_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_perecentage_of_irrigated_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_perecentage_of_irrigated_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_perecentage_of_irrigated_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_perecentage_of_irrigated_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_perecentage_of_irrigated_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_perecentage_of_irrigated_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_ceiling_low_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_ceiling_low_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_ceiling_low_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_ceiling_low_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_ceiling_low_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_ceiling_low_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_total_percentage_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_total_percentage_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_total_percentage_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_total_percentage_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_total_percentage_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_total_percentage_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_crops_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_crops_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_crops_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_crops_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_crops_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_crops_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_location_partf_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_location_partf_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_location_partf_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_location_partf_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_location_partf_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_location_partf_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_area_plantation_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_area_plantation_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_area_plantation_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_area_plantation_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_area_plantation_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_area_plantation_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_location_property_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_location_property_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_location_property_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_location_property_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_location_property_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_location_property_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_details_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_details_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_details_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_details_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_details_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_details_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }
        if (obcCertificateData.father_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.father_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.father_use_to_which_for_oc) {
                    return getBasicMessageAndFieldJSONArray('father_use_to_which_for_oc', fathergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.mother_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.mother_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                if (!obcCertificateData.mother_use_to_which_for_oc) {
                    return getBasicMessageAndFieldJSONArray('mother_use_to_which_for_oc', mothergovDetailsValidationMessage);
                }
            }
        }
        if (obcCertificateData.spouse_alive_for_obc_certificate == VALUE_ONE) {
            if (obcCertificateData.marital_status_for_oc == VALUE_ONE) {
                if (obcCertificateData.spouse_occupation == VALUE_ONE || VALUE_TWO || VALUE_THREE || VALUE_FOUR || VALUE_FIVE || VALUE_SIX || VALUE_SEVEN || VALUE_EIGHT || VALUE_NINE || VALUE_TEN || VALUE_ELEVEN || VALUE_TWELVE || VALUE_THIRTEEN) {
                    if (!obcCertificateData.spouce_use_to_which_for_oc) {
                        return getBasicMessageAndFieldJSONArray('spouce_use_to_which_for_oc', spoucegovDetailValidationMessage);
                    }
                }
            }
        }

        if (!obcCertificateData.tax_payer_for_obc_certificate) {
            $('#tax_payer_for_obc_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('tax_payer_for_obc_certificate', selectanyoneValidationMessage);
        }
        if (!obcCertificateData.wealth_tax_for_obc_certificate) {
            $('#wealth_tax_for_obc_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('wealth_tax_for_obc_certificate', selectanyoneValidationMessage);
        }

        if (obcCertificateData.wealth_tax_for_obc_certificate == VALUE_ONE) {
            if (!obcCertificateData.furnished_detail) {
                return getBasicMessageAndFieldJSONArray('furnished_detail', furnishedDetailValidationMessage);
            }
        }
        if (!obcCertificateData.purpose_of_obc_certificate) {
            return getBasicMessageAndFieldJSONArray('purpose_of_obc_certificate', purposeofobcCertificateValidationMessage);
        }
        if (!obcCertificateData.any_remarks) {
            return getBasicMessageAndFieldJSONArray('any_remarks', remarksValidationMessage);
        }

        if (!obcCertificateData.if_grandfather_having_document_for_obc_certificate) {
            $('#if_grandfather_having_document_for_obc_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('if_grandfather_having_document_for_obc_certificate', selectanyoneValidationMessage);
        }


        return '';
    },
    askForSubmitObcCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'ObcCertificate.listview.submitObcCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitObcCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var obcCertificateData = $('#obc_certificate_form').serializeFormJSON();
        var bornPlaceStateText = jQuery("#born_place_state_for_oc option:selected").text();
        var bornPlaceDistrictText = jQuery("#born_place_district_for_oc option:selected").text();
        var bornPlaceVillageText = jQuery("#born_place_village_for_oc option:selected").text();
        var nativePlaceStateText = jQuery("#native_place_state_for_oc option:selected").text();
        var nativePlaceDistrictText = jQuery("#native_place_district_for_oc option:selected").text();
        var nativePlaceVillageText = jQuery("#native_place_village_for_oc option:selected").text();
        var fBornPlaceStateText = jQuery("#father_born_place_state_for_oc option:selected").text();
        var fBornPlaceDistrictText = jQuery("#father_born_place_district_for_oc option:selected").text();
        var fBornPlaceVillageText = jQuery("#father_born_place_village_for_oc option:selected").text();
        var fNativePlaceDistrictText = jQuery("#father_native_place_district_for_oc option:selected").text();
        var fCityText = jQuery("#father_city_for_oc option:selected").text();
        var fNtivePlaceVillageText = jQuery("#father_native_place_village_for_oc option:selected").text();
        var mBornPlaceStateText = jQuery("#mother_born_place_state_for_oc option:selected").text();
        var mBornPlaceDistrictText = jQuery("#mother_born_place_district_for_oc option:selected").text();
        var mBornPlaceVillageText = jQuery("#mother_born_place_village_for_oc option:selected").text();
        var mNativePlaceStateText = jQuery("#mother_native_place_state_for_oc option:selected").text();
        var mNativePlaceDistrictText = jQuery("#mother_native_place_district_for_oc option:selected").text();
        var mNtivePlaceVillageText = jQuery("#mother_native_place_village_for_oc option:selected").text();
        var gfBornCityText = jQuery("#grandfather_borncity_for_oc option:selected").text();
        var gfBornPlaceDistrictText = jQuery("#grandfather_born_place_district_for_oc option:selected").text();
        var gfBornPlaceVillageText = jQuery("#grandfather_born_place_village_for_oc option:selected").text();
        var gfNativePlaceDistrictText = jQuery("#grandfather_native_place_district_for_oc option:selected").text();
        var gfCityText = jQuery("#grandfather_city_for_oc option:selected").text();
        var gfNtivePlaceVillageText = jQuery("#father_native_place_village_for_oc option:selected").text();
        var sBornPlaceStateText = jQuery("#spouse_born_place_state_for_oc option:selected").text();
        var sBornPlaceDistrictText = jQuery("#spouse_born_place_district_for_oc option:selected").text();
        var sBornPlaceVillageText = jQuery("#spouse_born_place_village_for_oc option:selected").text();
        var sNativePlaceStateText = jQuery("#spouse_native_place_state_for_oc option:selected").text();
        var sNativePlaceDistrictText = jQuery("#spouse_native_place_district_for_oc option:selected").text();
        var sNtivePlaceVillageText = jQuery("#spouse_native_place_village_for_oc option:selected").text();
        var validationData = that.checkValidationForObcCertificate(obcCertificateData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('obc-certificate-' + validationData.field, validationData.message);
            // $('html, body').animate({scrollTop: '0px'}, 0);
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_obc_certificate') : $('#submit_btn_for_obc_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var obcCertificateData = new FormData($('#obc_certificate_form')[0]);
        obcCertificateData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        obcCertificateData.append("module_type", moduleType);
        obcCertificateData.append("born_place_state_text", bornPlaceStateText);
        obcCertificateData.append("born_place_district_text", bornPlaceDistrictText);
        obcCertificateData.append("born_place_village_text", bornPlaceVillageText);
        obcCertificateData.append("native_place_state_text", nativePlaceStateText);
        obcCertificateData.append("native_place_district_text", nativePlaceDistrictText);
        obcCertificateData.append("native_place_village_text", nativePlaceVillageText);
        obcCertificateData.append("father_born_place_state_text", fBornPlaceStateText);
        obcCertificateData.append("father_born_place_district_text", fBornPlaceDistrictText);
        obcCertificateData.append("father_born_place_village_text", fBornPlaceVillageText);
        obcCertificateData.append("father_native_place_district_text", fNativePlaceDistrictText);
        obcCertificateData.append("father_city_text", fCityText);
        obcCertificateData.append("father_native_place_village_text", fNtivePlaceVillageText);
        obcCertificateData.append("mother_born_place_state_text", mBornPlaceStateText);
        obcCertificateData.append("mother_born_place_district_text", mBornPlaceDistrictText);
        obcCertificateData.append("mother_born_place_village_text", mBornPlaceVillageText);
        obcCertificateData.append("mother_native_place_state_text", mNativePlaceStateText);
        obcCertificateData.append("mother_native_place_district_text", mNativePlaceDistrictText);
        obcCertificateData.append("mother_native_place_village_text", mNtivePlaceVillageText);
        obcCertificateData.append("grandfather_borncity_text", gfBornCityText);
        obcCertificateData.append("grandfather_born_place_district_text", gfBornPlaceDistrictText);
        obcCertificateData.append("grandfather_born_place_village_text", gfBornPlaceVillageText);
        obcCertificateData.append("grandfather_native_place_district_text", gfNativePlaceDistrictText);
        obcCertificateData.append("grandfather_city_text", gfCityText);
        obcCertificateData.append("grandfather_native_place_village_text", gfNtivePlaceVillageText);
        obcCertificateData.append("spouse_born_place_state_text", sBornPlaceStateText);
        obcCertificateData.append("spouse_born_place_district_text", sBornPlaceDistrictText);
        obcCertificateData.append("spouse_born_place_village_text", sBornPlaceVillageText);
        obcCertificateData.append("spouse_native_place_state_text", sNativePlaceStateText);
        obcCertificateData.append("spouse_native_place_district_text", sNativePlaceDistrictText);
        obcCertificateData.append("spouse_native_place_village_text", sNtivePlaceVillageText);
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/submit_obc_certificate',
            data: obcCertificateData,
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
                validationMessageShow('obc_certificate', textStatus.statusText);
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
                    validationMessageShow('obc_certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                ObcCertificate.listview.loadObcCertificateData();
                showSuccess(parseData.message);
            }
        });
    },

    checkValidationForObcCertificateFatherDetails: function (obc_certificateFatherData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!obc_certificateFatherData.father_name) {
            return getBasicMessageAndFieldJSONArray('father_name_for_oc', fatherNameValidationMessage);
        }
        if (!obc_certificateFatherData.father_house_no) {
            return getBasicMessageAndFieldJSONArray('father_house_no_for_oc', houseNoValidationMessage);
        }
        if (!obc_certificateFatherData.father_house_name) {
            return getBasicMessageAndFieldJSONArray('father_house_name_for_oc', houseNameValidationMessage);
        }
        if (!obc_certificateFatherData.father_street) {
            return getBasicMessageAndFieldJSONArray('father_street_for_oc', streetValidationMessage);
        }
        if (!obc_certificateFatherData.father_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('father_village_dmc_ward_for_oc', villageNameValidationMessage);
        }
        if (!obc_certificateFatherData.father_city) {
            return getBasicMessageAndFieldJSONArray('father_city_for_oc', selectCityValidationMessage);
        }
        if (!obc_certificateFatherData.father_nationality) {
            return getBasicMessageAndFieldJSONArray('father_nationality_for_oc', applicantNationalityValidationMessage);
        }
        if (!obc_certificateFatherData.father_born_place_state) {
            return getBasicMessageAndFieldJSONArray('father_born_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obc_certificateFatherData.father_born_place_district) {
            return getBasicMessageAndFieldJSONArray('father_born_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obc_certificateFatherData.father_born_place_village) {
            return getBasicMessageAndFieldJSONArray('father_born_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obc_certificateFatherData.father_native_place_state) {
            return getBasicMessageAndFieldJSONArray('father_native_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obc_certificateFatherData.father_native_place_district) {
            return getBasicMessageAndFieldJSONArray('father_native_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obc_certificateFatherData.father_native_place_village) {
            return getBasicMessageAndFieldJSONArray('father_native_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obc_certificateFatherData.father_occupation) {
            return getBasicMessageAndFieldJSONArray('father_occupation_for_oc', occupationValidationMessage);
        }
        if (obc_certificateFatherData.father_occupation == VALUE_TWELVE) {
            if (!obc_certificateFatherData.father_other_occupation) {
                return getBasicMessageAndFieldJSONArray('father_other_occupation_for_oc', otherOccupationValidationMessage);
            }
        }
        // if (!obc_certificateFatherData.father_aadhaar) {
        //     return getBasicMessageAndFieldJSONArray('father_aadhaar_for_oc', invalidAadharNumberValidationMessage);
        // }
        // if (!obc_certificateFatherData.father_election_no) {
        //     return getBasicMessageAndFieldJSONArray('father_election_no_for_oc', electionNumberValidationMessage);
        // }

        return '';
    },

    submitFatherDetails: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var obc_certificateFatherData = $('#obc_certificate_father_form').serializeFormJSON();
        // var validationData = that.checkValidationForObcCertificateFatherDetails(obc_certificateFatherData);
        // if (validationData != '') {
        //     $('#' + validationData.field).focus();
        //     validationMessageShow('obc-certificate-' + validationData.field, validationData.message);
        //     // $('html, body').animate({scrollTop: '0px'}, 0);
        //     return false;
        // }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_obc_certificate') : $('#submit_btn_for_obc_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var obc_certificateFatherData = new FormData($('#obc_certificate_father_form')[0]);
        obc_certificateFatherData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        obc_certificateFatherData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/submit_obc_certificate_father_detail',
            data: obc_certificateFatherData,
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
                validationMessageShow('obc_certificate', textStatus.statusText);
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
                    validationMessageShow('obc_certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                // showSuccess(parseData.message);
                // ObcCertificate.router.navigate('obc_certificate', {'trigger': true});
                $('#obc_certificate_id').val(parseData.encrypt_id);
                that.motherDetailsForm(parseData.obc_certificate_data);
            }
        });
    },

    checkValidationForObcCertificateMotherDetails: function (obc_certificateMotherData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!obc_certificateMotherData.mother_name) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_oc', motherNameValidationMessage);
        }
        if (!obc_certificateMotherData.mother_house_no) {
            return getBasicMessageAndFieldJSONArray('mother_house_no_for_oc', houseNoValidationMessage);
        }
        if (!obc_certificateMotherData.mother_house_name) {
            return getBasicMessageAndFieldJSONArray('mother_house_name_for_oc', houseNameValidationMessage);
        }
        if (!obc_certificateMotherData.mother_street) {
            return getBasicMessageAndFieldJSONArray('mother_street_for_oc', streetValidationMessage);
        }
        if (!obc_certificateMotherData.mother_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('mother_village_dmc_ward_for_oc', villageNameValidationMessage);
        }
        if (!obc_certificateMotherData.mother_city) {
            return getBasicMessageAndFieldJSONArray('mother_city_for_oc', selectCityValidationMessage);
        }
        if (!obc_certificateMotherData.mother_nationality) {
            return getBasicMessageAndFieldJSONArray('mother_nationality_for_oc', applicantNationalityValidationMessage);
        }
        if (!obc_certificateMotherData.mother_born_place_state) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obc_certificateMotherData.mother_born_place_district) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obc_certificateMotherData.mother_born_place_village) {
            return getBasicMessageAndFieldJSONArray('mother_born_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obc_certificateMotherData.mother_native_place_state) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obc_certificateMotherData.mother_native_place_district) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obc_certificateMotherData.mother_native_place_village) {
            return getBasicMessageAndFieldJSONArray('mother_native_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obc_certificateMotherData.mother_occupation) {
            return getBasicMessageAndFieldJSONArray('mother_occupation_for_oc', occupationValidationMessage);
        }
        if (obc_certificateMotherData.mother_occupation == VALUE_TWELVE) {
            if (!obc_certificateMotherData.mother_other_occupation) {
                return getBasicMessageAndFieldJSONArray('mother_other_occupation_for_oc', otherOccupationValidationMessage);
            }
        }
        // if (!obc_certificateMotherData.mother_aadhaar) {
        //     return getBasicMessageAndFieldJSONArray('mother_aadhaar_for_oc', invalidAadharNumberValidationMessage);
        // }
        // if (!obc_certificateMotherData.mother_election_no) {
        //     return getBasicMessageAndFieldJSONArray('mother_election_no_for_oc', electionNumberValidationMessage);
        // }

        return '';
    },

    submitMotherDetails: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var obc_certificateMotherData = $('#obc_certificate_mother_form').serializeFormJSON();
        // var validationData = that.checkValidationForObcCertificateMotherDetails(obc_certificateMotherData);
        // if (validationData != '') {
        //     $('#' + validationData.field).focus();
        //     validationMessageShow('obc-certificate-' + validationData.field, validationData.message);
        //     // $('html, body').animate({scrollTop: '0px'}, 0);
        //     return false;
        // }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_obc_certificate') : $('#submit_btn_for_obc_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var obc_certificateMotherData = new FormData($('#obc_certificate_mother_form')[0]);
        obc_certificateMotherData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        obc_certificateMotherData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/submit_obc_certificate_mother_detail',
            data: obc_certificateMotherData,
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
                validationMessageShow('obc_certificate', textStatus.statusText);
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
                    validationMessageShow('obc_certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                // showSuccess(parseData.message);
                // ObcCertificate.router.navigate('obc_certificate', {'trigger': true});
                var obcCertificateData = parseData.obc_certificate_data;
                if (obcCertificateData.marital_status == 1) {
                    $('#obc_certificate_id').val(parseData.encrypt_id);
                    that.spouseDetailsForm(parseData.obc_certificate_data);
                } else {
                    $('#obc_certificate_id').val(parseData.encrypt_id);
                    that.uploadDocumentsForm(parseData.obc_certificate_data);
                }

            }
        });
    },

    checkValidationForObcCertificateGrandfatherDetails: function (obc_certificateGrandfatherData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!obc_certificateGrandfatherData.father_name) {
            return getBasicMessageAndFieldJSONArray('father_name_for_oc', fatherNameValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_house_no) {
            return getBasicMessageAndFieldJSONArray('father_house_no_for_oc', houseNoValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_house_name) {
            return getBasicMessageAndFieldJSONArray('father_house_name_for_oc', houseNameValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_street) {
            return getBasicMessageAndFieldJSONArray('father_street_for_oc', streetValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('father_village_dmc_ward_for_oc', villageNameValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_city) {
            return getBasicMessageAndFieldJSONArray('father_city_for_oc', selectCityValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_nationality) {
            return getBasicMessageAndFieldJSONArray('father_nationality_for_oc', applicantNationalityValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_born_place_state) {
            return getBasicMessageAndFieldJSONArray('father_born_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_born_place_district) {
            return getBasicMessageAndFieldJSONArray('father_born_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_born_place_village) {
            return getBasicMessageAndFieldJSONArray('father_born_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_native_place_state) {
            return getBasicMessageAndFieldJSONArray('father_native_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_native_place_district) {
            return getBasicMessageAndFieldJSONArray('father_native_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_native_place_village) {
            return getBasicMessageAndFieldJSONArray('father_native_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obc_certificateGrandfatherData.father_occupation) {
            return getBasicMessageAndFieldJSONArray('father_occupation_for_oc', occupationValidationMessage);
        }
        if (obc_certificateGrandfatherData.father_occupation == VALUE_TWELVE) {
            if (!obc_certificateGrandfatherData.father_other_occupation) {
                return getBasicMessageAndFieldJSONArray('father_other_occupation_for_oc', otherOccupationValidationMessage);
            }
        }
        // if (!obc_certificateGrandfatherData.father_aadhaar) {
        //     return getBasicMessageAndFieldJSONArray('father_aadhaar_for_oc', invalidAadharNumberValidationMessage);
        // }
        // if (!obc_certificateGrandfatherData.father_election_no) {
        //     return getBasicMessageAndFieldJSONArray('father_election_no_for_oc', electionNumberValidationMessage);
        // }

        return '';
    },

    submitGrandfatherDetails: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var obc_certificateGrandfatherData = $('#obc_certificate_father_form').serializeFormJSON();
        // var validationData = that.checkValidationForObcCertificateGrandfatherDetails(obc_certificateGrandfatherData);
        // if (validationData != '') {
        //     $('#' + validationData.field).focus();
        //     validationMessageShow('obc-certificate-' + validationData.field, validationData.message);
        //     // $('html, body').animate({scrollTop: '0px'}, 0);
        //     return false;
        // }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_obc_certificate') : $('#submit_btn_for_obc_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var obc_certificateGrandfatherData = new FormData($('#obc_certificate_father_form')[0]);
        obc_certificateGrandfatherData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        obc_certificateGrandfatherData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/submit_obc_certificate_father_detail',
            data: obc_certificateGrandfatherData,
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
                validationMessageShow('obc_certificate', textStatus.statusText);
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
                    validationMessageShow('obc_certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                // showSuccess(parseData.message);
                // ObcCertificate.router.navigate('obc_certificate', {'trigger': true});
                $('#obc_certificate_id').val(parseData.encrypt_id);
                that.grandfatherDetailsForm(parseData.obc_certificate_data);
            }
        });
    },
    checkValidationForObcCertificateSpouseDetails: function (obc_certificateSpouseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!obc_certificateSpouseData.spouse_name) {
            return getBasicMessageAndFieldJSONArray('spouse_name_for_oc', spouseNameValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_house_no) {
            return getBasicMessageAndFieldJSONArray('spouse_house_no_for_oc', houseNoValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_house_name) {
            return getBasicMessageAndFieldJSONArray('spouse_house_name_for_oc', houseNameValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_street) {
            return getBasicMessageAndFieldJSONArray('spouse_street_for_oc', streetValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('spouse_village_dmc_ward_for_oc', villageNameValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_city) {
            return getBasicMessageAndFieldJSONArray('spouse_city_for_oc', selectCityValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_nationality) {
            return getBasicMessageAndFieldJSONArray('spouse_nationality_for_oc', applicantNationalityValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_born_place_state) {
            return getBasicMessageAndFieldJSONArray('spouse_born_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_born_place_district) {
            return getBasicMessageAndFieldJSONArray('spouse_born_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_born_place_village) {
            return getBasicMessageAndFieldJSONArray('spouse_born_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_native_place_state) {
            return getBasicMessageAndFieldJSONArray('spouse_native_place_state_for_oc', selectStateValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_native_place_district) {
            return getBasicMessageAndFieldJSONArray('spouse_native_place_district_for_oc', selectDistrictValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_native_place_village) {
            return getBasicMessageAndFieldJSONArray('spouse_native_place_village_for_oc', selectVillageValidationMessage);
        }
        if (!obc_certificateSpouseData.spouse_occupation) {
            return getBasicMessageAndFieldJSONArray('spouse_occupation_for_oc', occupationValidationMessage);
        }
        if (obc_certificateSpouseData.spouse_occupation == VALUE_TWELVE) {
            if (!obc_certificateSpouseData.spouse_other_occupation) {
                return getBasicMessageAndFieldJSONArray('spouse_other_occupation_for_oc', otherOccupationValidationMessage);
            }
        }
        // if (!obc_certificateSpouseData.spouse_aadhaar) {
        //     return getBasicMessageAndFieldJSONArray('spouse_aadhaar_for_oc', invalidAadharNumberValidationMessage);
        // }
        // if (!obc_certificateSpouseData.spouse_election_no) {
        //     return getBasicMessageAndFieldJSONArray('spouse_election_no_for_oc', electionNumberValidationMessage);
        // }

        return '';
    },

    submitSpouseDetails: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var obc_certificateSpouseData = $('#obc_certificate_spouse_form').serializeFormJSON();
        // var validationData = that.checkValidationForObcCertificateSpouseDetails(obc_certificateSpouseData);
        // if (validationData != '') {
        //     $('#' + validationData.field).focus();
        //     validationMessageShow('obc-certificate-' + validationData.field, validationData.message);
        //     // $('html, body').animate({scrollTop: '0px'}, 0);
        //     return false;
        // }

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_obc_certificate') : $('#submit_btn_for_obc_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var obc_certificateSpouseData = new FormData($('#obc_certificate_spouse_form')[0]);
        obc_certificateSpouseData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        obc_certificateSpouseData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/submit_obc_certificate_spouse_detail',
            data: obc_certificateSpouseData,
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
                validationMessageShow('obc_certificate', textStatus.statusText);
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
                    validationMessageShow('obc_certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                // showSuccess(parseData.message);
                // ObcCertificate.router.navigate('obc_certificate', {'trigger': true});
                $('#obc_certificate_id').val(parseData.encrypt_id);
                that.uploadDocumentsForm(parseData.obc_certificate_data);
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
        var obcCertificateData = $('#obc_certificate_upload_document_form').serializeFormJSON();



        if (obcCertificateData.tax_payer_for_obc_certificate == VALUE_ONE) {
            if ($('#tax_payer_copy_container_for_obc_certificate').is(':visible')) {
                var birthCertificate = checkValidationForDocument('tax_payer_copy_for_obc_certificate', VALUE_ONE, 'obc-certificate');
                if (birthCertificate == false) {
                    return false;
                }
            }
        }

        if ($('#self_birth_certificate_doc_container_for_obc_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('self_birth_certificate_doc_for_obc_certificate', VALUE_ONE, 'obc-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if ($('#father_certificate_doc_container_for_obc_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('father_certificate_doc_for_obc_certificate', VALUE_ONE, 'obc-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if ($('#father_election_card_container_for_obc_certificate').is(':visible')) {
            var fatherelectionCard = checkValidationForDocument('father_election_card_for_obc_certificate', VALUE_ONE, 'obc-certificate');
            if (fatherelectionCard == false) {
                return false;
            }
        }

        if ($('#father_aadhar_card_container_for_obc_certificate').is(':visible')) {
            var fatheraadharCard = checkValidationForDocument('father_aadhar_card_for_obc_certificate', VALUE_ONE, 'obc-certificate');
            if (fatheraadharCard == false) {
                return false;
            }
        }

        if (obcCertificateData.if_grandfather_having_document_for_obc_certificate == VALUE_ONE) {
            if ($('#grandfather_birth_certificate_doc_container_for_obc_certificate').is(':visible')) {
                var birthCertificate = checkValidationForDocument('grandfather_birth_certificate_doc_for_obc_certificate', VALUE_ONE, 'obc-certificate');
                if (birthCertificate == false) {
                    return false;
                }
            }
        }

        if (obcCertificateData.if_grandfather_having_document_for_obc_certificate == VALUE_TWO) {
            if ($('#grandfather_property_doc_container_for_obc_certificate').is(':visible')) {
                var birthCertificate = checkValidationForDocument('grandfather_property_doc_for_obc_certificate', VALUE_ONE, 'obc-certificate');
                if (birthCertificate == false) {
                    return false;
                }
            }
        }


        if ($('#father_community_death_doc_container_for_obc_certificate').is(':visible')) {
            var fatherCommunityDeath = checkValidationForDocument('father_community_death_doc_for_obc_certificate', VALUE_ONE, 'obc-certificate');
            if (fatherCommunityDeath == false) {
                return false;
            }
        }

//        if (obcCertificateData.constitution_artical == VALUE_ONE) {
//            if ($('#election_card_doc_container_for_obc_certificate').is(':visible')) {
//                var birthCertificate = checkValidationForDocument('election_card_doc_for_obc_certificate', VALUE_ONE, 'obc-certificate');
//                if (birthCertificate == false) {
//                    return false;
//                }
//            }
//        }

        if ($('#aadhar_card_doc_container_for_obc_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('aadhar_card_doc_for_obc_certificate', VALUE_ONE, 'obc-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if ($('#community_certificate_doc_container_for_obc_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('community_certificate_doc_for_obc_certificate', VALUE_ONE, 'obc-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }

        if ($('#income_certificate_container_for_obc_certificate').is(':visible')) {
            var incomeCertificate = checkValidationForDocument('income_certificate_for_obc_certificate', VALUE_ONE, 'obc-certificate');
            if (incomeCertificate == false) {
                return false;
            }
        }

        if ($('#applicant_photo_doc_container_for_obc_certificate').is(':visible')) {
            var birthCertificate = checkValidationForDocument('applicant_photo_doc_for_obc_certificate', VALUE_TWO, 'obc-certificate');
            if (birthCertificate == false) {
                return false;
            }
        }


        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_obc_certificate') : $('#submit_btn_for_obc_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var obcCertificateData = new FormData($('#obc_certificate_upload_document_form')[0]);
        obcCertificateData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        obcCertificateData.append("module_type", moduleType);
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/submit_obc_certificate_upload_document',
            data: obcCertificateData,
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
                validationMessageShow('obc_certificate', textStatus.statusText);
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
                    validationMessageShow('obc_certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                ObcCertificate.router.navigate('obc_certificate', {'trigger': true});
            }
        });
    },
    askForApproveApplication: function (obcCertificateId) {
        if (!obcCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + obcCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'obc_certificate/get_obc_certificate_data_by_obc_certificate_id',
            type: 'post',
            data: $.extend({}, {'obc_certificate_id': obcCertificateId}, getTokenData()),
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
                var obcCertificateData = parseData.obc_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                //   obcCertificateData.aci_rec_text = recmigArray[obcCertificateData.aci_rec] ? recmigArray[obcCertificateData.aci_rec] : '';
                obcCertificateData.aci_rec_text = recmigArray[obcCertificateData.aci_rec] ? recmigArray[obcCertificateData.aci_rec] : '';
                obcCertificateData.com_addr_city = obcCertificateData.com_addr_city;
                obcCertificateData.required_purpose = obcCertificateData.select_required_purpose == VALUE_ONE ? 'Old Age Pension' : obcCertificateData.required_purpose;
                obcCertificateData.obccaste_text = applicantobccasteArray[obcCertificateData.obccaste] ? applicantobccasteArray[obcCertificateData.obccaste] : '';

                if (obcCertificateData.constitution_artical == VALUE_ONE) {
                    obcCertificateData.show_applicant_name = true;
                    obcCertificateData.show_gurdian_name = false;

                } else {
                    obcCertificateData.show_applicant_name = false;
                    obcCertificateData.show_gurdian_name = true;

                }


                if (obcCertificateData.marital_status == VALUE_ONE) {
                    obcCertificateData.show_spouse_data = true;
                    that.getStateDistictVillageName(obcCertificateData.spouse_native_place_state, obcCertificateData.spouse_native_place_district, obcCertificateData.spouse_native_place_village, 'spouse_native_place');
                }

                var obccerificateData = parseData.obc_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                var obcData = that.getBasicConfigurationForMovement(obccerificateData);
                $('#popup_container').html(obcCertificateApproveTemplate(obcData));
                datePicker();
                resetCounterForDocument('form-numbering', 1);
                //}
                // $('#popup_container').html(obcCertificateApproveTemplate(obcCertificateData));
                // datePicker();
            }
        });
    },

    getBasicConfigurationForMovement: function (obccertificateData) {
        var that = this;
        obccertificateData.family_annual_income_text = numberToWordsAmount(obccertificateData.family_annual_income);
        obccertificateData.income_by_talathi_text = numberToWordsAmount(obccertificateData.residing_year_as_per_talathi);
        if (obccertificateData.talathi_to_aci != VALUE_ZERO) {
            obccertificateData.show_talathi_updated_basic_details = true;
        }
        obccertificateData.application_type_title = 'Applicant';
        obccertificateData.show_minor_detail = false;
        if (obccertificateData.constitution_artical == VALUE_TWO) {
            obccertificateData.application_type_title = 'Guardian';
            obccertificateData.show_minor_detail = true;
        }
        if (obccertificateData.aci_rec == VALUE_ONE || obccertificateData.aci_rec == VALUE_TWO || obccertificateData.aci_rec == VALUE_THREE) {
            obccertificateData.show_aci_updated_basic_details = true;
            obccertificateData.cert_type_text = certTypeArray[obccertificateData.cert_type] ? certTypeArray[obccertificateData.cert_type] : certTypeArray[VALUE_ONE];
            // obccertificateData.aci_rec_text = recmigArray[obccertificateData.aci_rec] ? recmigArray[obccertificateData.aci_rec] : '';
            obccertificateData.aci_rec_text = recmigArray[obccertificateData.aci_rec] ? recmigArray[obccertificateData.aci_rec] : '';
            if (obccertificateData.aci_rec == VALUE_ONE || obccertificateData.aci_rec == VALUE_THREE) {
                if (obccertificateData.aci_rec == VALUE_ONE) {
                    obccertificateData.act_to_mamlatdar_ldc_datetime_text = obccertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.aci_to_ldc_datetime) : '';
                    obccertificateData.act_to_mamlatdar_ldc_name_text = obccertificateData.ldc_name;
                } else {
                    obccertificateData.act_to_mamlatdar_ldc_datetime_text = obccertificateData.aci_to_m_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.aci_to_m_ldc_datetime) : '';
                    obccertificateData.act_to_mamlatdar_ldc_name_text = obccertificateData.ldc_name_m;
                }
            }
            if (obccertificateData.aci_rec == VALUE_TWO) {
                obccertificateData.act_to_mamlatdar_ldc_datetime_text = obccertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.aci_to_mamlatdar_datetime) : '';
                obccertificateData.act_to_mamlatdar_ldc_name_text = obccertificateData.mamlatdar_name;
            }

        }
        if (obccertificateData.ldc_to_mamlatdar != VALUE_ZERO && (obccertificateData.aci_rec_text == VALUE_ONE || obccertificateData.aci_rec == VALUE_THREE)) {
            obccertificateData.show_ldc_updated_basic_details = true;
            obccertificateData.ldc_commu_address = that.ldcCommuAddress(obccertificateData);
            if (obccertificateData.constitution_artical == VALUE_TWO) {
                obccertificateData.show_ldc_updated_minor_child_details = true;
            }
            obccertificateData.ldc_to_mamlatdar_datetime_text = obccertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        if (obccertificateData.to_type_reverify != VALUE_ZERO) {
            obccertificateData.show_mam_reverify_updated_basic_details = true;
            obccertificateData.mam_reverification = obccertificateData.to_type_reverify == VALUE_ONE ? obccertificateData.talathi_name : obccertificateData.aci_name;
        }
        if (obccertificateData.talathi_to_type_reverify != VALUE_ZERO) {
            obccertificateData.talathi_reverification = obccertificateData.talathi_to_type_reverify == VALUE_ONE ? obccertificateData.aci_name : obccertificateData.mamlatdar_name;
            obccertificateData.show_talathi_reverify_updated_basic_details = true;
            obccertificateData.income_by_talathi_reverify_text = numberToWordsAmount(obccertificateData.residing_year_as_per_talathi);
        }
        if (obccertificateData.aci_rec_reverify == VALUE_ONE || obccertificateData.aci_rec_reverify == VALUE_TWO || obccertificateData.aci_rec_reverify == VALUE_THREE) {
            obccertificateData.show_aci_reverify_updated_basic_details = true;
            obccertificateData.cert_type_reverify_text = certTypeArray[obccertificateData.cert_type_reverify] ? certTypeArray[obccertificateData.cert_type_reverify] : certTypeArray[VALUE_ONE];
            obccertificateData.aci_rec_reverify_text = recmigArray[obccertificateData.aci_rec_reverify] ? recmigArray[obccertificateData.aci_rec_reverify] : '';
            if (obccertificateData.aci_rec_reverify == VALUE_ONE || obccertificateData.aci_rec_reverify == VALUE_THREE) {
                if (obccertificateData.aci_rec_reverify == VALUE_ONE) {
                    obccertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = obccertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.aci_to_ldc_datetime) : '';
                    obccertificateData.act_to_mamlatdar_ldc_reverify_name_text = obccertificateData.ldc_name;
                } else {
                    obccertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = obccertificateData.aci_to_m_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.aci_to_m_ldc_datetime) : '';
                    obccertificateData.act_to_mamlatdar_ldc_reverify_name_text = obccertificateData.ldc_name_m;
                }
            }
            if (obccertificateData.aci_rec_reverify == VALUE_TWO) {
                obccertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = obccertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.aci_to_reverify_datetime) : '';
                obccertificateData.act_to_mamlatdar_ldc_reverify_name_text = obccertificateData.mamlatdar_name;
            }

        }
        if (obccertificateData.ldc_to_mamlatdar != VALUE_ZERO && obccertificateData.aci_rec_reverify == VALUE_ONE) {
            obccertificateData.show_ldc_reverify_updated_basic_details = true;
            obccertificateData.ldc_commu_address = that.ldcCommuAddress(obccertificateData);
            if (obccertificateData.constitution_artical == VALUE_TWO) {
                obccertificateData.show_ldc_reverify_updated_minor_child_details = true;
            }
            obccertificateData.ldc_to_mamlatdar_datetime_text = obccertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        obccertificateData.ldc_name = (obccertificateData.ldc_name == null || obccertificateData.ldc_name == '') ? obccertificateData.ldc_name_m : obccertificateData.ldc_name;
        obccertificateData.talathi_to_aci_datetime_text = obccertificateData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.talathi_to_aci_datetime) : '';
        obccertificateData.aci_to_mamlatdar_datetime_text = obccertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.aci_to_mamlatdar_datetime) : '';
        obccertificateData.mam_to_reverify_datetime_text = obccertificateData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.mam_to_reverify_datetime) : '';
        obccertificateData.talathi_to_reverify_datetime_text = obccertificateData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.talathi_to_reverify_datetime) : '';
        obccertificateData.aci_to_reverify_datetime_text = obccertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(obccertificateData.aci_to_reverify_datetime) : '';
        return obccertificateData;
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var formData = $('#approve_obc_certificate_form').serializeFormJSON();
        if (!formData.obc_certificate_id_for_obc_certificate_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_obc_certificate_approve) {
            $('#remarks_for_obc_certificate_approve').focus();
            validationMessageShow('obc-certificate-approve-remarks_for_obc_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_obc_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/approve_application',
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
                validationMessageShow('obc-certificate-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('obc-certificate-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                ObcCertificate.listview.loadObcCertificateData();
//                $('#status_' + formData.obc_certificate_id_for_obc_certificate_approve).html(appStatusArray[VALUE_FIVE]);
//                $('#edit_btn_for_app_' + formData.obc_certificate_id_for_obc_certificate_approve).remove();
//                $('#reject_btn_for_app_' + formData.obc_certificate_id_for_obc_certificate_approve).remove();
//                $('#approve_btn_for_app_' + formData.obc_certificate_id_for_obc_certificate_approve).remove();
//                $('#download_certificate_btn_for_app_' + formData.obc_certificate_id_for_obc_certificate_approve).show();
//                that.loadObcCertificateData();
            }
        });
    },
    askForRejectApplication: function (obcCertificateId) {
        if (!obcCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + obcCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'obc_certificate/get_obc_certificate_data_by_obc_certificate_id',
            type: 'post',
            data: $.extend({}, {'obc_certificate_id': obcCertificateId}, getTokenData()),
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
                var obcCertificateData = parseData.obc_certificate_data;
                showPopup();
                var obcData = that.getBasicConfigurationForMovement(obcCertificateData);
                $('#popup_container').html(obcCertificateRejectTemplate(obcData));
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_obc_certificate_form').serializeFormJSON();
        if (!formData.obc_certificate_id_for_obc_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_obc_certificate_reject) {
            $('#remarks_for_obc_certificate_reject').focus();
            validationMessageShow('obc-certificate-reject-remarks_for_obc_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_obc_certificate_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/reject_application',
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
                validationMessageShow('obc-certificate-reject', textStatus.statusText);
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
                    validationMessageShow('obc-certificate-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                ObcCertificate.listview.loadObcCertificateData();
            }
        });
    },

    FillBilling: function () {
        if ($("#billingtoo_for_oc").is(":checked")) {
            $('#per_addr_house_no_for_oc').val($('#com_addr_house_no_for_oc').val());
            $('#per_addr_house_name_for_oc').val($('#com_addr_house_name_for_oc').val());
            $('#per_addr_street_for_oc').val($('#com_addr_street_for_oc').val());
            $('#per_addr_village_dmc_ward_for_oc').val($('#com_addr_village_dmc_ward_for_oc').val());
            $('#per_addr_city_for_oc').val($('#com_addr_city_for_oc').val());
            $('#per_pincode_for_oc').val($('#com_pincode_for_oc').val());
        } else {
            $('#per_addr_house_no_for_oc').val('');
            $('#per_addr_house_name_for_oc').val('');
            $('#per_addr_street_for_oc').val('');
            $('#per_addr_village_dmc_ward_for_oc').val('');
            $('#per_addr_city_for_oc').val('');
            $('#per_pincode_for_oc').val();
        }
        generateSelect2();
    },
    getConstitution: function (constitution) {
        //   $("#fees").prop("readonly", true);
        //  alert (constitution);
        // console.log(constitution);
        var val = constitution.value;
        if (val == '') {
            return false;
        }
        if (val === '1') {
            this.$('#main_div').show();
            this.$('.applicant_name_for_oc_div').show();
            this.$('.gurdian_name_for_oc_div').hide();
            this.$('.guardian_div_one').hide();
            this.$('.guardian_div_two').hide();
            this.$('.guardian_div_three').hide();
            this.$('.marital_status_div_for_oc').show();
            this.$('.occupation_div_for_oc').show();
            this.$('.major_div').show();
            this.$('.minor_div').hide();



        }
        if (val === '2') {
            this.$('#main_div').show();
            this.$('.applicant_name_for_oc_div').hide();
            this.$('.gurdian_name_for_oc_div').show();
            this.$('.guardian_div_one').show();
            this.$('.guardian_div_two').show();
            this.$('.guardian_div_three').show();
            this.$('.marital_status_div_for_oc').hide();
            this.$('.spouse_info_item_container_for_oc').hide();
            this.$('.occupation_div_for_oc').hide();
            this.$('.major_div').hide();
            this.$('.minor_div').show();

        }

    },
    downloadCertificate: function (obcCertificateId, moduleType) {
        if (!obcCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#obc_certificate_id_for_certificate').val(obcCertificateId);
        $('#mtype_for_certificate').val(moduleType);
        $('#obc_certificate_pdf_form').submit();
        $('#obc_certificate_id_for_certificate').val('');
        $('#mtype_for_certificate').val('');
    },
    migrantCertificate: function (obcCertificateId, moduleType) {
        if (!obcCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#obc_migrant_certificate_id_for_certificate').val(obcCertificateId);
        $('#mtype_migrant_for_certificate').val(moduleType);
        $('#obc_migrant_certificate_pdf_form').submit();
        $('#obc_migrant_certificate_id_for_certificate').val('');
        $('#mtype_migrant_for_certificate').val('');
    },
    getQueryData: function (obcCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!obcCertificateId) {
            //console.log(obcCertificateId);
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_FIVE;
        templateData.module_id = obcCertificateId;
        var btnObj = $('#query_btn_for_app_' + obcCertificateId);
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
                tmpData.module_type = VALUE_FIVE;
                tmpData.module_id = obcCertificateId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    setAppointment: function (obcCertificateId) {
        if (!obcCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + obcCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'obc_certificate/get_appointment_data_by_obc_certificate_id',
            type: 'post',
            data: $.extend({}, {'obc_certificate_id': obcCertificateId}, getTokenData()),
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

                $('#popup_container').html(obcCertificateAppointmentTemplate(appointmentData));
                if (appointmentData.online_statement == VALUE_ONE) {
                    $('#online_statement_for_obc_certificate').attr('checked', 'checked');
                }
                if (appointmentData.visit_office == VALUE_ONE) {
                    $('#visit_office_for_obc_certificate').attr('checked', 'checked');
                }
                loadAppointmentHistory('obc_certificate', appointmentData);
                datePickerAppointment();
            }
        });
    },
    reverifyApplication: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_obc_certificate_form').serializeFormJSON();
        if (!formData.obc_certificate_id_for_obc_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if (!formData.to_type_reverify_for_obc_certificate) {
                $('#to_type_reverify_for_obc_certificate_1').focus();
                validationMessageShow('obc-certificate-update-basic-detail-to_type_reverify_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.mam_reverify_remarks_for_obc_certificate) {
                $('#mam_reverify_remarks_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-mam_reverify_remarks_for_obc_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.talathi_to_type_reverify_for_obc_certificate) {
                $('#talathi_to_type_reverify_for_obc_certificate_1').focus();
                validationMessageShow('obc-certificate-update-basic-detail-talathi_to_type_reverify_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.upload_reverification_document_for_obc_certificate) {
                $('#upload_reverification_document_for_obc_certificate_1').focus();
                validationMessageShow('obc-certificate-update-basic-detail-upload_reverification_document_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_reverification_document_for_obc_certificate == VALUE_ONE) {
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
            if (!formData.talathi_reverify_remarks_for_obc_certificate) {
                $('#talathi_reverify_remarks_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-talathi_reverify_remarks_for_obc_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.cert_type_reverify_for_obc_certificate) {
                $('#cert_type_reverify_for_obc_certificate_1').focus();
                validationMessageShow('obc-certificate-update-basic-detail-cert_type_reverify_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_rec_reverify_for_obc_certificate) {
                $('#aci_rec_reverify_for_obc_certificate_1').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_rec_reverify_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_reverify_remarks_for_obc_certificate) {
                $('#aci_reverify_remarks_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_reverify_remarks_for_obc_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_obc_certificate == VALUE_ONE && !formData.aci_to_ldc_reverify_for_obc_certificate) {
                $('#aci_to_ldc_reverify_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_to_ldc_reverify_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_obc_certificate == VALUE_THREE && !formData.aci_to_ldc1_reverify_for_obc_certificate) {
                $('#aci_to_ldc1_reverify_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_to_ldc1_reverify_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_obc_certificate == VALUE_ONE && !formData.aci_to_type_reverify_for_obc_certificate) {
                $('#aci_to_type_reverify_for_obc_certificate_1').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_to_type_reverify_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_obc_certificate == VALUE_THREE && !formData.aci_to_type_reverify_for_obc_certificate) {
                $('#aci_to_type_reverify_for_obc_certificate_1').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_to_type_reverify_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/reverify_application',
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
                validationMessageShow('obc-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('obc-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var icData = parseData.obc_certificate_data;
                if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
                    $('#status_' + formData.obc_certificate_id_for_obc_certificate_update_basic_detail).html(appStatusArray[VALUE_THREE]);
                    var reverificationName = formData.to_type_reverify_for_obc_certificate == VALUE_ONE ? formData.talathi_name_for_obc_certificate_update_basic_detail : formData.aci_name_for_obc_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.obc_certificate_id_for_obc_certificate_update_basic_detail).html('<hr>' + reverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    var talathiReverificationName = formData.talathi_to_type_reverify_for_obc_certificate == VALUE_ONE ? formData.aci_name_for_obc_certificate_update_basic_detail : formData.mamlatdar_name_for_obc_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.obc_certificate_id_for_obc_certificate_update_basic_detail).html('<hr>' + talathiReverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    if (icData.aci_rec_reverify == VALUE_ONE || icData.aci_rec_reverify == VALUE_ONE) {
                        $('#reverification_status_' + formData.obc_certificate_id_for_obc_certificate_update_basic_detail).html('<hr>' + icData.ldc_name);
                    } else {
                        $('#reverification_status_' + formData.obc_certificate_id_for_obc_certificate_update_basic_detail).html('<hr>' + formData.mamlatdar_name_for_obc_certificate_update_basic_detail);
                    }
                }
                $('#movement_for_ic_list_' + formData.obc_certificate_id_for_obc_certificate_update_basic_detail).html(movementStringMigrant(parseData.obc_certificate_data));
                appReverifyStatusRenderer(icData, null, icData, null);
                resetModelMD();
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
        var formData = $('#set_appointment_obc_certificate_form').serializeFormJSON();
        if (!formData.obc_certificate_id_for_obc_certificate_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_obc_certificate) {
            //$('#appointment_date_for_domicile').focus();
            validationMessageShow('obc-certificate-appointment_date_for_obc_certificate', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_obc_certificate) {
            //$('#appointment_time_for_obc_certificate').focus();
            validationMessageShow('obc-certificate-appointment_time_for_obc_certificate', timeValidationMessage);
            return false;
        }
        var start_date = dateTo_YYYY_MM_DD(formData.appointment_date_for_obc_certificate); // Oct 1, 2014
        var d = new Date();
        var end_date = d.setDate(d.getDate() - 1);
        var new_start_date = new Date(start_date);
        var new_end_date = new Date(end_date);

        if (new_end_date > new_start_date) {
            //$('#appointment_date_for_domicile').focus();
            validationMessageShow('obc-certificate-appointment_date_for_obc_certificate', appointmentDateSelectValidationMessage);
            return false;
        }
        if (formData.online_statement_for_obc_certificate == undefined && formData.visit_office_for_obc_certificate == undefined) {
            $('#visit_office_for_obc_certificate').focus();
            validationMessageShow('obc-certificate-visit_office_for_obc_certificate', appointmentTypeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_obc_certificate_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/submit_set_appointment',
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
                validationMessageShow('obc-certificate-set-appointment', textStatus.statusText);
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
                    validationMessageShow('obc-certificate-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var obcCertificateData = parseData.obc_certificate_data;
                $('#appointment_container_' + obcCertificateData.obc_certificate_id).html(that.getAppointmentData(obcCertificateData));
                $('#movement_for_ic_list_' + obcCertificateData.obc_certificate_id).html(movementStringMigrant(obcCertificateData));
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
    updateBasicDetails: function (btnObj, obcId) {
        if (!obcId) {
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
            url: 'obc_certificate/get_update_basic_detail_data_by_obc_certificate_id',
            type: 'post',
            data: $.extend({}, {'obc_certificate_id': obcId}, getTokenData()),
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
                basicDetailData.family_annual_income_text = numberToWordsAmount(basicDetailData.family_annual_income);
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_talathi_enter_basic_details = true;
                }
                if (basicDetailData.talathi_to_aci != VALUE_ZERO) {
                    basicDetailData.show_talathi_updated_basic_details = true;
                    basicDetailData.income_by_talathi_text = numberToWordsAmount(basicDetailData.residing_year_as_per_talathi)
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                    basicDetailData.show_aci_enter_basic_details = true;
                    basicDetailData.show_submit_btn = true;
                }
                if (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_TWO || basicDetailData.aci_rec == VALUE_THREE) {
                    basicDetailData.show_aci_updated_basic_details = true;
                    //       basicDetailData.aci_rec_text = recmigArray[basicDetailData.aci_rec] ? recmigArray[basicDetailData.aci_rec] : '';
                    basicDetailData.cert_type_text = certTypeArray[basicDetailData.cert_type] ? certTypeArray[basicDetailData.cert_type] : certTypeArray[VALUE_ONE];
                    basicDetailData.aci_rec_text = recmigArray[basicDetailData.aci_rec] ? recmigArray[basicDetailData.aci_rec] : '';
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
//                    if (basicDetailData.aci_rec == VALUE_THREE) {
//                        basicDetailData.act_to_mamlatdar_ldc_datetime_text = basicDetailData.aci_to_m_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_m_ldc_datetime) : '';
//                        basicDetailData.act_to_mamlatdar_ldc_name_text = basicDetailData.ldc_name_m;
//                    }
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
                    basicDetailData.income_by_talathi_reverify_text = numberToWordsAmount(basicDetailData.residing_year_as_per_talathi_reverify);
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
                    basicDetailData.cert_type_reverify_text = certTypeArray[basicDetailData.cert_type_reverify] ? certTypeArray[basicDetailData.cert_type_reverify] : certTypeArray[VALUE_ONE];
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
                basicDetailData.title = basicDetailData.to_type_reverify == VALUE_ZERO ? (tempTypeInSession == TEMP_TYPE_TALATHI_USER ? 'Forward for Verification' : (tempTypeInSession == TEMP_TYPE_ACI_USER ? 'Forward for Approval' : 'Update Basic Details')) : 'Reverification OBC Certificate Form';
                basicDetailData.talathi_to_aci_datetime_text = basicDetailData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_aci_datetime) : '';
                basicDetailData.mam_to_reverify_datetime_text = basicDetailData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.mam_to_reverify_datetime) : '';
                basicDetailData.talathi_to_reverify_datetime_text = basicDetailData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_reverify_datetime) : '';
                basicDetailData.aci_to_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';

                if (basicDetailData.status == VALUE_FIVE || basicDetailData.status == VALUE_SIX) {
                    basicDetailData.show_approve_reject_details = true;
                    basicDetailData.status_text = returnAppStatus(basicDetailData.status);
                    basicDetailData.status_datetime_text = basicDetailData.status_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.status_datetime) : '';
                    basicDetailData.title = 'Movement Details of OBC Certificate Form';
                }

                if (basicDetailData.constitution_artical == VALUE_ONE) {
                    basicDetailData.application_type_title = 'Applicant';
                    basicDetailData.show_minor_detail = false;
                    basicDetailData.show_marital_status_data = true;
                } else {
                    basicDetailData.application_type_title = 'Guardian';
                    basicDetailData.show_minor_detail = true;
                    basicDetailData.show_marital_status_data = false;
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
                    $('#model_md_body').html(obcCertificateBasicDetailTemplate(basicDetailData));
                } else {
                    basicDetailData.show_card = true;
                    $('#popup_container').html(obcCertificateBasicDetailTemplate(basicDetailData));
                }

                if (basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) {
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                        generateBoxes('radio', yesNoArray, 'upload_verification_document', 'obc_certificate', basicDetailData.is_upload_verification_document, false, false);
                        showSubContainer('upload_verification_document', 'obc_certificate', '#field_verification_document_uploads', VALUE_ONE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.aci_data, 'talathi_to_aci_for_obc_certificate', 'sa_user_id', 'name', '', false);

                        if (basicDetailData.field_documents != '') {
                            $.each(basicDetailData.field_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_ONE);
                                $('#upload_verification_document_for_obc_certificate_1').attr('checked', 'checked');
                                $('#field_verification_document_uploads_container_for_obc_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_ONE);
                            $('#upload_verification_document_for_obc_certificate_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                        basicDetailData.aci_rec = (basicDetailData.aci_rec == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec);
                        generateBoxes('radio', certTypeArray, 'cert_type', 'obc_certificate', basicDetailData.cert_type, false, false);
                        generateBoxes('radio', recmigArray, 'aci_rec', 'obc_certificate', basicDetailData.aci_rec, false, false, false);
                        // generateBoxes('radio', recmigArray, 'aci_rec', 'obc_certificate', basicDetailData.aci_rec, false, false,false);



                        showSubContainer('aci_rec', 'obc_certificate', '#aci_to_ldc', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec', 'obc_certificate', '#aci_to_mamlatdar', VALUE_TWO, 'radio');
                        showSubContainer('aci_rec', 'obc_certificate', '#aci_to_ldc1', VALUE_THREE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'aci_to_mamlatdar_for_obc_certificate', 'sa_user_id', 'name', '', false);
                        //  renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'aci_to_mamlatdar1_for_obc_certificate', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_for_obc_certificate', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc1_for_obc_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_THREE) &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'ldc_to_mamlatdar_for_obc_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.to_type_reverify == VALUE_ZERO) {
                        generateBoxes('radio', reverifyTypeArray, 'to_type_reverify', 'obc_certificate', basicDetailData.to_type_reverify, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.to_type_reverify == VALUE_ONE) {
                        generateBoxes('radio', yesNoArray, 'upload_reverification_document', 'obc_certificate', basicDetailData.is_upload_reverification_document, false, false);
                        showSubContainer('upload_reverification_document', 'obc_certificate', '#field_reverification_document_uploads', VALUE_ONE, 'radio');
                        generateBoxes('radio', talathiReverifyTypeArray, 'talathi_to_type_reverify', 'obc_certificate', basicDetailData.talathi_to_type_reverify, false);

                        if (basicDetailData.field_reverify_documents != '') {
                            $.each(basicDetailData.field_reverify_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_TWO);
                                $('#upload_reverification_document_for_obc_certificate_1').attr('checked', 'checked');
                                $('#field_reverification_document_uploads_container_for_obc_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_TWO);
                            $('#upload_reverification_document_for_obc_certificate_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                            (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                        var tempArray = [];
                        tempArray[VALUE_ZERO] = basicDetailData.mamlatdar_name;
                        generateBoxes('radio', tempArray, 'aci_to_type_reverify', 'obc_certificate', VALUE_ZERO, false);
                        basicDetailData.aci_rec_reverify = (basicDetailData.aci_rec_reverify == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec_reverify);
                        generateBoxes('radio', certTypeArray, 'cert_type_reverify', 'obc_certificate', basicDetailData.cert_type_reverify, false, false);
                        generateBoxes('radio', recmigArray, 'aci_rec_reverify', 'obc_certificate', basicDetailData.aci_rec_reverify, false, false);
                        showSubContainer('aci_rec_reverify', 'obc_certificate', '#aci_to_ldc_reverify', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec_reverify', 'obc_certificate', '#aci_to_mamlatdar_reverify', VALUE_TWO, 'radio');
                        showSubContainer('aci_rec_reverify', 'obc_certificate', '#aci_to_ldc1_reverify', VALUE_THREE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_reverify_for_obc_certificate', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc1_reverify_for_obc_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec_reverify == VALUE_ONE || basicDetailData.aci_rec_reverify == VALUE_THREE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        var tempArray = [];
                        var tArray = {};
                        tArray['name'] = basicDetailData.mamlatdar_name;
                        tArray['sa_user_id'] = basicDetailData.aci_to_mamlatdar;
                        tempArray.push(tArray);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempArray, 'ldc_to_mamlatdar_for_obc_certificate', 'sa_user_id', 'name', '', false);
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
        var formData = $('#update_basic_detail_obc_certificate_form').serializeFormJSON();
        if (!formData.obc_certificate_id_for_obc_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {

            if (!formData.upload_verification_document_for_obc_certificate) {
                $('#upload_verification_document_for_obc_certificate_1').focus();
                validationMessageShow('obc-certificate-update-basic-detail-upload_verification_document_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_verification_document_for_obc_certificate == VALUE_ONE) {
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
            if (!formData.talathi_remarks_for_obc_certificate) {
                $('#talathi_remarks_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-talathi_remarks_for_obc_certificate', remarksValidationMessage);
                return false;
            }
            if (!formData.talathi_to_aci_for_obc_certificate) {
                $('#talathi_to_aci_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-talathi_to_aci_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.cert_type_for_obc_certificate) {
                $('#cert_type_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-cert_type_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_remarks_for_obc_certificate) {
                $('#aci_remarks_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_remarks_for_obc_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_obc_certificate == VALUE_ONE && !formData.aci_to_ldc_for_obc_certificate) {
                $('#aci_to_ldc_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_to_ldc_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_obc_certificate == VALUE_TWO && !formData.aci_to_mamlatdar_for_obc_certificate) {
                $('#aci_to_mamlatdar_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_to_mamlatdar_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_obc_certificate == VALUE_THREE && !formData.aci_to_ldc1_for_obc_certificate) {
                $('#aci_to_ldc1_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-aci_to_ldc1_for_obc_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            var constitutionArtical = parseInt($('#constitution_artical_for_obc_certificate').val());
            if (constitutionArtical != VALUE_ONE && constitutionArtical != VALUE_TWO) {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (!formData.ldc_applicant_name_for_obc_certificate) {
                $('#ldc_applicant_name_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-ldc_applicant_name_for_obc_certificate', applicantNameValidationMessage);
                return false;
            }
            if (constitutionArtical == VALUE_TWO) {
                if (!formData.ldc_minor_child_name_for_obc_certificate) {
                    $('#ldc_minor_child_name_for_obc_certificate').focus();
                    validationMessageShow('obc-certificate-update-basic-detail-ldc_minor_child_name_for_obc_certificate', minorChildNameValidationMessage);
                    return false;
                }
            }
            if (!formData.ldc_father_name_for_obc_certificate) {
                $('#ldc_father_name_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-ldc_father_name_for_obc_certificate', fatherNameValidationMessage);
                return false;
            }
            if (!formData.ldc_vt_name_for_obc_certificate) {
                $('#ldc_vt_name_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-ldc_vt_name_for_obc_certificate', detailValidationMessage);
                return false;
            }
            if (!formData.ldc_commu_address_for_obc_certificate) {
                $('#ldc_commu_address_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-ldc_commu_address_for_obc_certificate', communicationAddressValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_obc_certificate) {
                $('#ldc_to_mamlatdar_remarks_for_obc_certificate').focus();
                validationMessageShow('obc-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_obc_certificate', remarksValidationMessage);
                return false;
            }
            if (!showLDCDraftBtn) {
                formData.update_ldc_mam_details = VALUE_ONE;
                if (!formData.ldc_to_mamlatdar_for_obc_certificate) {
                    $('#ldc_to_mamlatdar_for_obc_certificate').focus();
                    validationMessageShow('obc-certificate-update-basic-detail-ldc_to_mamlatdar_for_obc_certificate', oneOptionValidationMessage);
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
            url: 'obc_certificate/forward_to',
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
                validationMessageShow('obc-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('obc-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#movement_for_ic_list_' + parseData.obc_certificate_id).html(movementStringMigrant(parseData.obc_certificate_data));
                resetModelMD();
                // var obcCertificateData = parseData.obc_certificate_data;
                // $('#appointment_container_' + obcCertificateData.obc_certificate_id).html(that.getAppointmentData(obcCertificateData));
                // $('#movement_for_ic_list_' + obcCertificateData.obc_certificate_id).html(movementStringMigrant(obcCertificateData));
            }
        });
    },
    getDocumentData: function (obcCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!obcCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#obc_certificate_id_for_scrutiny').val(obcCertificateId);
        $('#obc_certificate_document_for_scrutiny').submit();
        $('#obc_certificate_id_for_scrutiny').val('');
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
        renderOptionsForTwoDimensionalArray([], 'village_name_for_oc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_oc');
    },
    getVillageData: function (obj, moduleName, id, isTemp = false) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (id == 'born_place') {
            addTagSpinner('born_place_village_for_' + moduleName);
        } else if (id == 'father_born_place') {
            addTagSpinner('father_born_place_village_for_' + moduleName);
        } else if (id == 'mother_born_place') {
            addTagSpinner('mother_born_place_village_for_' + moduleName);
        } else if (id == 'mother_native_place') {
            addTagSpinner('mother_native_place_village_for_' + moduleName);
        } else if (id == 'spouse_born_place') {
            addTagSpinner('spouse_born_place_village_for_' + moduleName);
        } else if (id == 'spouse_native_place') {
            addTagSpinner('spouse_native_place_village_for_' + moduleName);
        }
        var text = moduleName == 'oc' ? ' ' : '';
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
        $('#' + id + '_village_for_' + moduleName).val('');
        var state = $('#' + id + '_state_for_' + moduleName).val();
        var districtCode = obj.val();
        if (!districtCode || !state) {
            return;
        }
        $.ajax({
            url: 'obc_certificate/get_village_data_for_obc_certificate',
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
                    tempVillageDataForOBC = parseData.village_data;
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
            url: 'obc_certificate/get_name_data_for_obc_certificate',
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
        var text = moduleName == 'oc' ? ' ' : '';
        if (!districtCode || !state) {
            return;
        }
        $.ajax({
            url: 'obc_certificate/get_village_data_for_obc_certificate',
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
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_oc', 'village_code', 'village_name', 'Village');
                $('#' + id + '_village_for_oc').val(village == 0 ? '' : village);

            }
        });
    },
    downloadDeclaration: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var icId = $('#obc_certificate_id_for_oc_declaration').val();
        if (!icId) {
            validationMessageShow('obc-certificate-declaration_for_obc_certificate', invalidAccessValidationMessage);
            return false;
        }
        $('#oc_declaration_pdf').submit();
    },
    getDistrictFornDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_district_for_oc');
        var state = obj.val();
        if (!state) {
            return false;
        }
        if (state != VALUE_ONE && state != VALUE_TWO) {
            return false;
        }
        renderOptionsForTwoDimensionalArray(damandiudistrictArray, id + '_district_for_oc');
    },
    getVillageDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_village_for_oc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var districtData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
        renderOptionsForTwoDimensionalArray(districtData, id + '_village_for_oc');
    },
    villageDMCChangeEvent: function () {
        var district = $('#district').val();
        var villageCode = $('#village_name_for_oc').val();
        var villageData = (district == VALUE_ONE ? damanVillagesArray[villageCode] : (district == VALUE_TWO ? diuVillagesArray[villageCode] : (district == VALUE_THREE ? dnhVillagesArray[villageCode] : [])));
        $('#com_addr_village_dmc_ward_for_oc').val(villageData);

        $("#billingtoo_for_oc").prop('checked', false);
        $('#per_addr_village_dmc_ward_for_oc').val('');
        $('#per_addr_city_for_oc').val('');
        $('#per_pincode_for_oc').val('');

        if (district == VALUE_ONE) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_oc');
            renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_oc');

            if (jQuery.inArray(villageCode, naniDamanVillageArray) != '-1') {
                $('#com_addr_city_for_oc').val(damanCityArray[VALUE_ONE]);
                var city_code = VALUE_ONE;

            } else if (jQuery.inArray(villageCode, motiDamanVillageArray) != '-1') {
                $('#com_addr_city_for_oc').val(damanCityArray[VALUE_TWO]);
                var city_code = VALUE_TWO;
            }

            var pincodeData = damanCityPincodeArray[city_code];
            $('#pincode_for_oc').val(pincodeData);
            $('#com_pincode_for_oc').val(pincodeData);

            generateSelect2();
        } else if (district == VALUE_TWO) {
            renderOptionsForTwoDimensionalArray(diuCityArray, 'com_addr_city_for_oc');
            renderOptionsForTwoDimensionalArray(diuCityArray, 'per_addr_city_for_oc');
            $('#com_addr_city_for_oc').val(diuCityArray[VALUE_ONE]);
            $('#pincode_for_oc').val('');
            $('#com_pincode_for_oc').val('');

        } else if (district == VALUE_THREE) {
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'com_addr_city_for_oc');
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'per_addr_city_for_oc');
            $('#com_addr_city_for_oc').val(dnhCityArray[VALUE_ONE]);
            $('#pincode_for_oc').val('');
            $('#com_pincode_for_oc').val('');
        }
    },
    getPincode: function () {
        var city_code = $('#com_addr_city_for_oc').val();
        var pincodeData = damanCityPincodeArray[city_code];
        $('#pincode_for_oc').val(pincodeData);
        $('#com_pincode_for_oc').val(pincodeData);

        var per_city_code = $('#per_addr_city_for_oc').val();
        var pincodeData = damanCityPincodeArray[per_city_code];
        $('#per_pincode_for_oc').val(pincodeData);
    },
    nativeCityChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'father_city_for_oc');
        renderOptionsForTwoDimensionalArray([], 'father_native_place_village_for_oc');
        var city = obj.val();
        if (!city) {
            return false;
        }
        if (city != VALUE_ONE && city != VALUE_TWO && city != VALUE_THREE) {
            return false;
        }
        var cityData = city == VALUE_ONE ? damanCityArray : (city == VALUE_TWO ? diuNativeCityArray : (city == VALUE_THREE ? dnhCityArray : []));
        renderOptionsForTwoDimensionalArray(cityData, 'father_city_for_oc');
    },
    grandfatherNativeCityChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'grandfather_city_for_oc');
        renderOptionsForTwoDimensionalArray([], 'grandfather_native_place_village_for_oc');
        var city = obj.val();
        if (!city) {
            return false;
        }
        if (city != VALUE_ONE && city != VALUE_TWO && city != VALUE_THREE) {
            return false;
        }
        var cityData = city == VALUE_ONE ? damanCityArray : (city == VALUE_TWO ? diuNativeCityArray : (city == VALUE_THREE ? dnhCityArray : []));
        renderOptionsForTwoDimensionalArray(cityData, 'grandfather_city_for_oc');
    },
    grandfatherBornCityChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'grandfather_borncity_for_oc');
        renderOptionsForTwoDimensionalArray([], 'grandfather_born_place_village_for_oc');
        var city = obj.val();
        if (!city) {
            return false;
        }
        if (city != VALUE_ONE && city != VALUE_TWO && city != VALUE_THREE) {
            return false;
        }
        var cityData = city == VALUE_ONE ? damanCityArray : (city == VALUE_TWO ? diuNativeCityArray : (city == VALUE_THREE ? dnhCityArray : []));
        renderOptionsForTwoDimensionalArray(cityData, 'grandfather_borncity_for_oc');
    },
    nativeFamilyVillageChangeEvent: function (obj, fieldName) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], fieldName);
        var village = obj.val();
        if (!village) {
            return false;
        }
        if (village != VALUE_ONE && village != VALUE_TWO && village != VALUE_THREE) {
            return false;
        }
        var villageData = village == VALUE_ONE ? damanVillageForNativeArray : (village == VALUE_TWO ? damanVillageForNativeArray : (village == VALUE_THREE ? diuVillagesForNativeArray : []));
        renderOptionsForTwoDimensionalArray(villageData, fieldName);
    },
    downloadExcelForOC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_ocge').val($('#app_no_for_obc_certificate_list').val());
        $('#app_date_for_ocge').val($('#app_date_for_obc_certificate_list').val());
        $('#app_details_for_ocge').val($('#app_details_for_obc_certificate_list').val());
        $('#vdw_for_ocge').val(tempTypeInSession != TEMP_TYPE_A ? $('#vdw_for_obc_certificate_list').val() : '');
        $('#status_for_ocge').val($('#status_for_obc_certificate_list').val());
        $('#qstatus_for_ocge').val($('#query_status_for_obc_certificate_list').val());
        $('#app_status_for_ocge').val($('#appointment_status_for_obc_certificate_list').val());
        $('#currently_on_for_ocge').val($('#currently_on_for_obc_certificate_list').val());
        $('#generate_excel_for_obc_certificate').submit();
        $('.ocge').val('');
    },
    addVerificationDocItem: function (docData, moduleId) {
        var that = this;
        docData.cnt = verifyDocCnt;
        docData.verification_type = moduleId;
        $('#upload_verification_doc_item_container_for_obc_certificate_' + moduleId).append(obcCertificateFieldVerificationDocItemTemplate(docData));
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
        formData.append('obc_certificate_id_for_obc_certificate_update_basic_detail', $('#obc_certificate_id_for_obc_certificate_update_basic_detail').val());
        formData.append('field_document_id_for_field_verification', $('#field_document_id_for_field_verification_' + tempCnt).val());
        formData.append('verification_type_for_field_verification', $('#verification_type_for_field_verification_' + tempCnt).val());
        formData.append('document_for_verification_document', $('#' + id)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/upload_field_verification_document',
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
        $('#' + documentFieldName + '_name_href_for_verification_document_' + cnt).attr('href', 'documents/obc_certificate/' + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_verification_document_' + cnt).html(VIEW_UPLODED_DOCUMENT);
        $('#' + documentFieldName + '_remove_btn_for_verification_document_' + cnt).attr('onclick', 'ObcCertificate.listview.askForRemoveDocForFieldVerification("' + docItemData.field_verification_document_id + '","' + cnt + '")');
    },
    askForRemoveDocForFieldVerification: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'ObcCertificate.listview.removeFieldDoc(' + fieldDocumentId + ', ' + cnt + ')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeFieldDoc: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'obc_certificate/remove_field_document',
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
        var yesEvent = 'ObcCertificate.listview.removeFieldItemRow(' + cnt + ')';
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
            url: 'obc_certificate/remove_field_document_item',
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(obcCertificateFieldVerificationViewDocItemTemplate(docDetail));
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(obcCertificateFieldVerificationViewDocItemTemplate(reDocDetail));
                if (reDocDetail['document'] != '') {
                    that.loadFieldDocForView(reDocDetail.cnt, 'document', 'field_reverification', reDocDetail.document);
                }
            });
        }
    },
    loadFieldDocForView: function (tempCnt, id, moduleType, docField) {
        $('#' + id + '_container_for_' + moduleType + '_view_' + tempCnt).hide();
        $('#' + id + '_name_container_for_' + moduleType + '_view_' + tempCnt).show();
        $('#' + id + '_name_href_for_' + moduleType + '_view_' + tempCnt).attr('href', 'documents/obc_certificate/' + docField);
        $('#' + id + '_name_for_' + moduleType + '_view_' + tempCnt).html(VIEW_UPLODED_DOCUMENT);
    },
});
