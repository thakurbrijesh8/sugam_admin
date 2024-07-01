var rtiListTemplate = Handlebars.compile($('#rti_list_template').html());
var rtiSearchTemplate = Handlebars.compile($('#rti_search_template').html());
var rtiTableTemplate = Handlebars.compile($('#rti_table_template').html());
var rtiActionTemplate = Handlebars.compile($('#rti_action_template').html());
var rtiFormTemplate = Handlebars.compile($('#rti_form_template').html());
var rtiViewTemplate = Handlebars.compile($('#rti_view_template').html());
var rtiApproveTemplate = Handlebars.compile($('#rti_approve_template').html());
var rtiRejectTemplate = Handlebars.compile($('#rti_reject_template').html());
var rtiSetAppointmentTemplate = Handlebars.compile($('#rti_set_appointment_template').html());
var rtiUpdateBasicDetailTemplate = Handlebars.compile($('#rti_update_basic_detail_template').html());

var tempACIData = [];
var tempMamData = [];
var searchRF = {};

var Rti = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Rti.Router = Backbone.Router.extend({
    routes: {
        'rti': 'renderList',
        'rti_form': 'renderList',
        'edit_rti_form': 'renderList',
        'view_rti_form': 'renderList',
    },
    renderList: function () {
        Rti.listview.listPage();
    },
});
Rti.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="pertains_inspection_record_for_rti"]': 'hasPertainsInspectionRecordEvent',
    },
    hasPertainsInspectionRecordEvent: function (event) {
        var val = $('input[name=pertains_inspection_record_for_rti]:checked').val();
        if (val === '1') {
            this.$('.is_pertains_inspection_record_details_div').show();
        } else {
            this.$('.is_pertains_inspection_record_details_div').hide();

        }
    },
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('mam_rti', 'active');
        Rti.router.navigate('rti');
        var templateData = {};
        searchRF = {};
        this.$el.html(rtiListTemplate(templateData));
        this.loadRtiData();

    },
    actionRenderer: function (rowData) {
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) && rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX) {
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
        rowData.module_type = VALUE_TWELVE;
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
        return rtiActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        var onlineStatement = appointmentData.online_statement == VALUE_ONE ? 'Online Statement' : '';
        var visitOffice = appointmentData.visit_office == VALUE_ONE ? 'Visit Office' : '';
        if (appointmentData.appointment_date == '0000-00-00') {
            return '<span id="appointment_container_' + appointmentData.rti_id + '" class="badge bg-warning app-status">Appointment Not Scheduled By Talathi</span>';
        }
        var returnString = '<span id="appointment_container_' + appointmentData.rti_id + '"><span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">' + onlineStatement;
        if (onlineStatement != '' && visitOffice != '') {
            returnString += ',<br>';
        }
        returnString += (visitOffice + '</span>');
        return returnString;
    },
    loadRtiData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;

        var searchData = {};
        Rti.router.navigate('rti');
        $('#rti_form_and_datatable_container').html(rtiTableTemplate);
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_rti_list', false);
        $('#rti_form_and_datatable_container').html(rtiSearchTemplate(searchData));

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        //distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_rti_list', false);
        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_rti_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_rti_list', false);
        datePickerId('application_date_for_rti_list');

        if (tempTypeInSession != TEMP_TYPE_A) {
            var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'vdw_for_rti_list', 'village', 'village_name', false, false);
        } else {
            if (typeof searchRF.district_for_rti_list != "undefined" && searchRF.district_for_rti_list != '' && searchRF.village_for_rti_list != '')
            {
                var villageData = (searchRF.district_for_rti_list == VALUE_ONE ? tempVillageData : (searchRF.district_for_rti_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_rti_list', 'village', 'village_name', false, false);
            }
        }

        $('#app_no_for_rti_list').val((typeof searchRF.app_no_for_rti_list != "undefined" && searchRF.app_no_for_rti_list != '') ? searchRF.app_no_for_rti_list : '');
        $('#application_date_for_rti_list').val((typeof searchRF.application_date_for_rti_list != "undefined" && searchRF.application_date_for_rti_list != '') ? searchRF.application_date_for_rti_list : searchData.s_appd);
        $('#app_details_for_rti_list').val((typeof searchRF.app_details_for_rti_list != "undefined" && searchRF.app_details_for_rti_list != '') ? searchRF.app_details_for_rti_list : '');
        $('#query_status_for_rti_list').val((typeof searchRF.query_status_for_rti_list != "undefined" && searchRF.query_status_for_rti_list != '') ? searchRF.query_status_for_rti_list : searchData.s_qstatus);
        $('#status_for_rti_list').val((typeof searchRF.status_for_rti_list != "undefined" && searchRF.status_for_rti_list != '') ? searchRF.status_for_rti_list : searchData.s_status);
        $('#vdw_for_rti_list').val((typeof searchRF.vdw_for_rti_list != "undefined" && searchRF.vdw_for_rti_list != '') ? searchRF.vdw_for_rti_list : '');
        $('#is_full_for_rti_list').val((typeof searchRF.is_full_for_rti_list != "undefined" && searchRF.is_full_for_rti_list != '') ? searchRF.is_full_for_rti_list : searchData.s_is_full);

        this.searchRtiData();

        allowOnlyIntegerValue('mobile_number_for_rti_list');

    },
    searchRtiData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#rti_datatable_container').html(rtiTableTemplate);
        var searchData = $('#search_rti_form').serializeFormJSON();

        searchRF = searchData;
        if (typeof btnObj == "undefined" && (searchRF.app_details_for_rti_list == ''
                && searchRF.app_no_for_rti_list == ''
                && searchRF.application_date_for_rti_list == ''
                && searchRF.query_status_for_rti_list == ''
                && searchRF.status_for_rti_list == ''
                && searchRF.vdw_for_rti_list == ''
                && searchRF.is_full_for_rti_list == '')) {
            rtiDataTable = $('#rti_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#rti_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? damanVillagesArray : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.applicant_profession + ', ' + full.applicant_address + ', ' + (villageData[full.village_name] ? villageData[full.village_name] : '') + ', ' +
                    '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '</b>';
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
        $('#rti_datatable_container').html(rtiTableTemplate);
        rtiDataTable = $('#rti_datatable').DataTable({
            ajax: {url: 'rti/get_rti_data', dataSrc: "rti_data", type: "post", data: searchData},
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
                {data: 'rti_id', 'class': 'v-a-t text-center', 'render': appointmentRenderer},
                {data: 'rti_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'rti_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'rti_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "fnRowCallback": aciNR,
            "initComplete": searchableDatatable
        });
        $('#rti_datatable_filter').remove();
        $('#rti_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = rtiDataTable.row(tr);

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
    newRtiForm: function (rtiData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        Rti.router.navigate('edit_rti_form');
        rtiData.VALUE_ONE = VALUE_ONE;
        rtiData.VALUE_TWO = VALUE_TWO;
        rtiData.VALUE_THREE = VALUE_THREE;
        rtiData.VALUE_FOUR = VALUE_FOUR;
        rtiData.VALUE_FIVE = VALUE_FIVE;
        rtiData.VALUE_SIX = VALUE_SIX;
        rtiData.VALUE_SEVEN = VALUE_SEVEN;
        rtiData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        rtiData.declaration_date_text = dateTo_DD_MM_YYYY(rtiData.declaration_date);
        rtiData.district_text = talukaArray[rtiData.district] ? talukaArray[rtiData.district] : '';
        rtiData.declaration_date_text = dateTo_DD_MM_YYYY(rtiData.declaration_date);
        rtiData.applicant_dob_text = dateTo_DD_MM_YYYY(rtiData.applicant_dob);
        rtiData.pertains_period_date_text = dateTo_MM_YYYY(rtiData.pertains_period_date);

        $('#rti_form_and_datatable_container').html(rtiFormTemplate(rtiData));
        var district = rtiData.district;
        var villageData = (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : [])));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_rti');
        generateBoxes('radio', rtiTypeArray, 'rti_type', 'rti', rtiData.rti_type, false, false);
        generateBoxes('radio', yesNoArray, 'pertains_inspection_record', 'rti', rtiData.pertains_inspection_record, false, false);
        $('#village_name_for_rti').val(rtiData.village_name);
        $('#declaration_for_rti').attr('checked', 'checked');
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_rti');
            $('#district_for_rti').val(rtiData.district);
        }
        $('#district_for_rti').val(rtiData.district);

        $('#declaration_for_rti').click();
        that.viewDocument(rtiData);
        generateSelect2();
        datePicker();
        datePickerToday('death_date_for_rti');
        if (rtiData.applicant_dob != '0000-00-00') {
            $('#applicant_dob_for_rti').val(dateTo_DD_MM_YYYY(rtiData.applicant_dob));
        }
        if (rtiData.date != '0000-00-00') {
            $('#date_for_rti').val(dateTo_DD_MM_YYYY(rtiData.date));
        }

        $('#rti_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.askForSubmitRti(VALUE_TWO);
            }
        });
    },
    viewDocument: function (rtiData) {
        var that = this;
        if (rtiData.death_certificate_doc != '') {
            that.showDocument('death_certificate_doc_container_for_rti', 'death_certificate_doc_name_image_for_rti', 'death_certificate_doc_name_container_for_rti',
                    'death_certificate_doc_download', 'death_certificate_doc', rtiData.death_certificate_doc, rtiData.rti_id, VALUE_ONE);
        }
        if (rtiData.death_aadhar_card_doc != '') {
            that.showDocument('death_aadhar_card_doc_container_for_rti', 'death_aadhar_card_doc_name_image_for_rti', 'death_aadhar_card_doc_name_container_for_rti',
                    'death_aadhar_card_doc_download', 'death_aadhar_card_doc', rtiData.death_aadhar_card_doc, rtiData.rti_id, VALUE_TWO);
        }
        if (rtiData.marriage_certificate_doc != '') {
            that.showDocument('marriage_certificate_doc_container_for_rti', 'marriage_certificate_doc_name_image_for_rti', 'marriage_certificate_doc_name_container_for_rti',
                    'marriage_certificate_doc_download', 'marriage_certificate_doc', rtiData.marriage_certificate_doc, rtiData.rti_id, VALUE_THREE);
        }
        if (rtiData.aadhar_card_doc != '') {
            that.showDocument('aadhar_card_doc_container_for_rti', 'aadhar_card_doc_name_image_for_rti', 'aadhar_card_doc_name_container_for_rti',
                    'aadhar_card_doc_download', 'aadhar_card_doc', rtiData.aadhar_card_doc, rtiData.rti_id, VALUE_FOUR);
        }
        if (rtiData.panchayat_certificate_doc != '') {
            that.showDocument('panchayat_certificate_doc_container_for_rti', 'panchayat_certificate_doc_name_image_for_rti', 'panchayat_certificate_doc_name_container_for_rti',
                    'panchayat_certificate_doc_download', 'panchayat_certificate_doc', rtiData.panchayat_certificate_doc, rtiData.rti_id, VALUE_FIVE);
        }
        if (rtiData.community_certificate_doc != '') {
            that.showDocument('community_certificate_doc_container_for_rti', 'community_certificate_doc_name_image_for_rti', 'community_certificate_doc_name_container_for_rti',
                    'community_certificate_doc_download', 'community_certificate_doc', rtiData.community_certificate_doc, rtiData.rti_id, VALUE_SIX);
        }
        if (rtiData.applicant_photo_doc != '') {
            that.showDocument('applicant_photo_doc_container_for_rti', 'applicant_photo_doc_name_image_for_rti', 'applicant_photo_doc_name_container_for_rti',
                    'applicant_photo_doc_download', 'applicant_photo_doc', rtiData.applicant_photo_doc, rtiData.rti_id, VALUE_SEVEN);
        }
        if (rtiData.witness1_photo_doc != '') {
            that.showDocument('witness1_photo_doc_container_for_rti', 'witness1_photo_doc_name_image_for_rti', 'witness1_photo_doc_name_container_for_rti',
                    'witness1_photo_doc_download', 'witness1_photo_doc', rtiData.witness1_photo_doc, rtiData.rti_id, VALUE_EIGHT);
        }
        if (rtiData.witness2_photo_doc != '') {
            that.showDocument('witness2_photo_doc_container_for_rti', 'witness2_photo_doc_name_image_for_rti', 'witness2_photo_doc_name_container_for_rti',
                    'witness2_photo_doc_download', 'witness2_photo_doc', rtiData.witness2_photo_doc, rtiData.rti_id, VALUE_NINE);
        }
        if (rtiData.witness1_aadhar_doc != '') {
            that.showDocument('witness1_aadhar_doc_container_for_rti', 'witness1_aadhar_doc_name_image_for_rti', 'witness1_aadhar_doc_name_container_for_rti',
                    'witness1_aadhar_doc_download', 'witness1_aadhar_doc', rtiData.witness1_aadhar_doc, rtiData.rti_id, VALUE_TEN);
        }
        if (rtiData.witness2_aadhar_doc != '') {
            that.showDocument('witness2_aadhar_doc_container_for_rti', 'witness2_aadhar_doc_name_image_for_rti', 'witness2_aadhar_doc_name_container_for_rti',
                    'witness2_aadhar_doc_download', 'witness2_aadhar_doc', rtiData.witness2_aadhar_doc, rtiData.rti_id, VALUE_ELEVEN);
        }
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', HEIRSHIP_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", HEIRSHIP_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Rti.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },
    editOrViewRti: function (btnObj, rtiId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!rtiId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        if (typeof isPrint === "undefined") {
            isPrint = false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'rti/get_rti_data_by_id',
            type: 'post',
            data: $.extend({}, {'rti_id': rtiId}, getTokenData()),
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
                var rtiData = parseData.rti_data;
                if (isEdit) {
                    that.newRtiForm(rtiData);
                } else {
                    that.viewRtiForm(VALUE_THREE, rtiData, isPrint);
                }
            }
        });
    },
    viewRtiForm: function (moduleType, rtiData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        //        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
//            showError(invalidAccessValidationMessage+'1');
//            return;
//        }
//        if (moduleType == VALUE_ONE) {
//            Rti.router.navigate('view_rti_form');
//            rtiData.title = 'View';
//        } else {
//            rtiData.show_submit_btn = true;
//        }
        Rti.router.navigate('view_rti_form');
        rtiData.VALUE_ONE = VALUE_ONE;
        rtiData.VALUE_TWO = VALUE_TWO;
        rtiData.VALUE_THREE = VALUE_THREE;
        rtiData.VALUE_FOUR = VALUE_FOUR;
        rtiData.VALUE_FIVE = VALUE_FIVE;
        rtiData.VALUE_SIX = VALUE_SIX;
        rtiData.VALUE_SEVEN = VALUE_SEVEN;
        rtiData.VALUE_THREE = VALUE_THREE;
        rtiData.declaration_date_text = dateTo_DD_MM_YYYY(rtiData.declaration_date);
        rtiData.district_text = talukaArray[rtiData.district] ? talukaArray[rtiData.district] : '';
        var district = rtiData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        rtiData.village_dmc_ward_text = villageData[rtiData.village_name] ? villageData[rtiData.village_name] : '';
        rtiData.declaration_date_text = dateTo_DD_MM_YYYY(rtiData.declaration_date);
        rtiData.applicant_dob_text = dateTo_DD_MM_YYYY(rtiData.applicant_dob);
        rtiData.pertains_period_date_text = dateTo_MM_YYYY(rtiData.pertains_period_date);
        rtiData.show_declaration_btn = moduleType == VALUE_ONE ? true : (rtiData.declaration == VALUE_ONE ? true : false);
        rtiData.rti_type_text = rtiTypeArray[rtiData.rti_type] ? rtiTypeArray[rtiData.rti_type] : '';
        rtiData.pertains_inspection_record_text = yesNoArray[rtiData.pertains_inspection_record] ? yesNoArray[rtiData.pertains_inspection_record] : '';
        if (rtiData.pertains_inspection_record != VALUE_TWO) {
            rtiData.inspection_no_of_days_text = rtiData.inspection_no_of_days;
        }
        if (rtiData.status != VALUE_ZERO && rtiData.status != VALUE_ONE) {
            rtiData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(rtiViewTemplate(rtiData));

        if (rtiData.declaration == VALUE_ONE) {
            $('#declaration_for_rti').click();
        }

        //        var efmData = JSON.parse(rtiData.legal_heirs_details);
//        var efmCnt = 1;
//        $.each(efmData, function (index, efm) {
//            var aliveStatus = efm.member_remarks;
//            if (aliveStatus != VALUE_TWO) {
//                var memAge = efm.member_age;
//                var late = '';
//            } else {
//                var memAge = '-';
//                var late = 'Late.';
//            }
//            var efmRow = '<tr><td class="text-center">' + efmCnt + '</td><td>' + late + '&nbsp;' + efm.member_name + '</td>' +
//                    '<td class="text-center">' + memAge + '</td><td class="text-center">' + (relationDeceasedPersonArray[efm.member_relation]) + '</td>' +
//                    '<td>' + (maritalStatusArray[efm.member_marital_status]) + '</td>' +
//                    '<td class="text-right">' + (aliveDeathStatusArray[efm.member_remarks]) + '</td></tr>';
//            $('#efm_container_for_icview').append(efmRow);
//            efmCnt++;
//        });
//        var efmDataDec = JSON.parse(rtiData.legal_heirs_details);
//        var efmDecCnt = 1;
//        $.each(efmDataDec, function (index, efm) {
//            var aliveStatus = efm.member_remarks;
//            if (aliveStatus != VALUE_TWO) {
//                var memAge = efm.member_age;
//                var late = '';
//            } else {
//                var memAge = '-';
//                var late = 'Late.';
//            }
//            var efmRowDec = '<tr><td class="text-center">' + efmDecCnt + '</td><td>' + late + '&nbsp;' + efm.member_name + '</td>' +
//                    '<td class="text-center">' + memAge + '</td><td class="text-center">' + (relationDeceasedPersonArray[efm.member_relation]) + '</td>' +
//                    '<td>' + (maritalStatusArray[efm.member_marital_status]) + '</td>' +
//                    '<td class="text-right">' + (aliveDeathStatusArray[efm.member_remarks]) + '</td></tr>';
//            $('#efm_container_for_icview_declaration').append(efmRowDec);
//            var memberName = late + '&nbsp;' + efm.member_name + ',&nbsp;';
//            $('#efm_container_for_icview_declaration_name').append(memberName);
//            efmDecCnt++;
//        });
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_rtiview').click();
            }, 500);
        }
        //        var witnessDecData = JSON.parse(rtiData.witness_details);
//        var witnessDecCnt = 1;
//        $.each(witnessDecData, function (index, chd) {
//            var witnessDecRow = '<tr><td class="text-center">' + witnessDecCnt + '</td><td>' + chd.name_of_witness + '</td>' +
//                    '<td class="text-center">' + chd.age_of_witness + '</td>' +
//                    '<td>' + chd.address_of_witness + '</td></tr>';
//            $('#witness_container_for_icview_declaration').append(witnessDecRow);
//            witnessDecCnt++;
//        });
//        var witnessData = JSON.parse(rtiData.witness_details);
//        var witnessCnt = 1;
//        $.each(witnessData, function (index, chd) {
//            var witnessRow = '<tr><td class="text-center">' + witnessCnt + '</td><td>' + chd.name_of_witness + '</td>' +
//                    '<td class="text-center">' + chd.age_of_witness + '</td>' +
//                    '<td>' + chd.address_of_witness + '</td></tr>';
//            $('#witness_container_for_icview').append(witnessRow);
//            witnessCnt++;
//        });

    },
    //    viewRtiForm: function (rtiData) {
//        if (!tempIdInSession || tempIdInSession == null) {
//            loginPage();
//            return false;
//        }
//        var that = this;
//        tempMemberCnt = 1;
//        tempFamilyMemberCnt = 1;
//        Rti.router.navigate('view_rti_form');
//        rtiData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
//        rtiData.VALUE_ONE = VALUE_ONE;
//        rtiData.VALUE_TWO = VALUE_TWO;
//        rtiData.VALUE_THREE = VALUE_THREE;
//        rtiData.VALUE_FOUR = VALUE_FOUR;
//        rtiData.VALUE_FIVE = VALUE_FIVE;
//        rtiData.VALUE_SIX = VALUE_SIX;
//        rtiData.VALUE_SEVEN = VALUE_SEVEN;
//        rtiData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
//        rtiData.declaration_date_text = dateTo_DD_MM_YYYY(rtiData.declaration_date);
//        rtiData.district_text = talukaArray[rtiData.district] ? talukaArray[rtiData.district] : '';
//        $('#rti_form_and_datatable_container').html(rtiViewTemplate(rtiData));
//        $('#view_document_container_for_rti').html(rtiViewDocumentTemplate(rtiData));
//        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_rti');
//        var district = rtiData.district;
//        var villageData = (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : [])));
//        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_rti');
//        renderOptionsForTwoDimensionalArray(villageData, 'pre_village_for_rti');
//        renderOptionsForTwoDimensionalArray(villageData, 'per_village_for_rti');
//        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'applicant_occupation_for_rti');
//        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'witness1_occupation_for_rti');
//        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'witness2_occupation_for_rti');
//        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relation_deceased_person_for_rti');
//        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relation_with_applicant_for_rti');
//        generateBoxes('radio', genderArray, 'gender', 'rti', rtiData.gender, false, false);
//        generateBoxes('radio', maritalStatusArray, 'marital_status', 'rti', rtiData.marital_status, false, false);
//        showSubContainer('marital_status', 'rti', '.marital_status_item', VALUE_ONE, 'radio');
//        generateBoxes('radio', maritalStatusArray, 'death_marital_status', 'rti', rtiData.death_marital_status, false, false);
//        showSubContainer('marital_status', 'rti', '.marital_status_item', VALUE_ONE, 'radio');
////        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
////            renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_rti');
////            $('#district_for_rti').val(rtiData.district);
////        }
//
//        $('#district_for_rti').val(rtiData.district);
//        $('#applicant_occupation_for_rti').val(rtiData.occupation);
//        $('#witness1_occupation_for_rti').val(rtiData.witness1_occupation);
//        $('#witness2_occupation_for_rti').val(rtiData.witness2_occupation);
//        $('#pre_city_for_rti').val(rtiData.pre_city);
//        $('#per_city_for_rti').val(rtiData.per_city);
//        $('#village_name_for_rti').val(rtiData.village_name);
//        $('#pre_village_for_rti').val(rtiData.pre_village);
//        $('#per_village_for_rti').val(rtiData.per_village);
//        $('#relation_deceased_person_for_rti').val(rtiData.relation_deceased_person);
//        $('#relation_with_applicant_for_rti').val(rtiData.relation_with_applicant);
//
//        var cntFm = 1;
//        if (rtiData.legal_heirs_details != '') {
//            var familyMemberDetails = JSON.parse(rtiData.legal_heirs_details);
//            $.each(familyMemberDetails, function (key, value) {
//                that.addFamilyMemberInfo(value, true);
//                $('#member_marital_status_for_rti_' + cntFm).val(value.member_marital_status);
//                $('#member_relation_for_rti_' + cntFm).val(value.member_relation);
//                $('#member_remarks_for_rti_' + cntFm).val(value.member_remarks);
//                cntFm++;
//            });
//        }
//        
//        that.viewDocument(rtiData);
//        $('input[type=radio]').attr('disabled', 'disabled');
//        $('input[type=checkbox]').attr('disabled', 'disabled');
//        $('input[type=text]').attr('disabled', 'disabled');
//        $('.hideView').prop('disabled', true);
//        $('.removeView').hide();
//
//        if (rtiData.death_date != '0000-00-00') {
//            $('#death_date_for_rti').val(dateTo_DD_MM_YYYY(rtiData.death_date));
//        }
//    },
    checkValidationForRti: function (rtiData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!rtiData.district_for_rti) {
            return getBasicMessageAndFieldJSONArray('district_for_rti', selectDistrictValidationMessage);
        }
        if (!rtiData.village_name_for_rti) {
            return getBasicMessageAndFieldJSONArray('village_name_for_rti', selectVillageValidationMessage);
        }
        if (!rtiData.applicant_name_for_rti) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_rti', applicantNameValidationMessage);
        }
        if (!rtiData.applicant_profession_for_rti) {
            return getBasicMessageAndFieldJSONArray('applicant_profession_for_rti', professionValidationMessage);
        }
        if (!rtiData.applicant_dob_for_rti) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_rti', dateValidationMessage);
        }
        if (!rtiData.applicant_address_for_rti) {
            return getBasicMessageAndFieldJSONArray('applicant_address_for_rti', addressValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(rtiData.mobile_number_for_rti);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_rti', mobileMessage);
        }
        if (!rtiData.subject_for_rti) {
            return getBasicMessageAndFieldJSONArray('subject_for_rti', detailValidationMessage);
        }
        if (!rtiData.pertains_period_date_for_rti) {
            return getBasicMessageAndFieldJSONArray('pertains_period_date_for_rti', dateValidationMessage);
        }
        if (!rtiData.rti_type_for_rti) {
            return getBasicMessageAndFieldJSONArray('rti_type_for_rti', selectanyoneValidationMessage);
        }
        if (!rtiData.pertains_inspection_record_for_rti) {
            return getBasicMessageAndFieldJSONArray('pertains_inspection_record_for_rti', selectanyoneValidationMessage);
        }
        if (rtiData.pertains_inspection_record_for_rti == VALUE_ONE) {
            if (!rtiData.inspection_no_of_days_for_rti) {
                return getBasicMessageAndFieldJSONArray('inspection_no_of_days_for_rti', detailValidationMessage);
            }
        }

        return '';
    },
    askForSubmitRti: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Rti.listview.submitRti(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitRti: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var rtiData = $('#rti_form').serializeFormJSON();
        var validationDataOne = that.checkValidationForRti(rtiData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('rti-' + validationDataOne.field, validationDataOne.message);
            return false;
        }

        rtiData.module_type = moduleType;

        var btnObj = $('#submit_btn_for_rti');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'rti/submit_rti',
            data: $.extend({}, rtiData, getTokenData()),
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
                validationMessageShow('rti', textStatus.statusText);
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
                    validationMessageShow('rti', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Rti.listview.loadRtiData();
                showSuccess(parseData.message);
            }
        });
    },
    askForApproveApplication: function (rtiId) {
        if (!rtiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + rtiId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'rti/get_rti_data_by_rti_id',
            type: 'post',
            data: $.extend({}, {'rti_id': rtiId}, getTokenData()),
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
                var rtiData = parseData.rti_data;
                showPopup();
                //                var pre_village_text = (rtiData.district == VALUE_ONE ? damanVillagesArray : (rtiData.district == VALUE_TWO ? diuVillagesArray : (rtiData.district == VALUE_THREE ? dnhVillagesArray : [])));
                rtiData.pre_village_text = rtiData.pre_village ? rtiData.pre_village : '';
                rtiData.pre_city_text = (rtiData.pre_city == VALUE_ONE) ? 'Nani Daman' : 'Moti Daman';
                rtiData.relation_deceased_person_text = relationDeceasedPersonArray[rtiData.relation_deceased_person] ? relationDeceasedPersonArray[rtiData.relation_deceased_person] : '';
                rtiData.relation_with_applicant_text = relationDeceasedPersonArray[rtiData.relation_with_applicant] ? relationDeceasedPersonArray[rtiData.relation_with_applicant] : '';
                rtiData.death_date_text = dateTo_DD_MM_YYYY(rtiData.death_date) ? dateTo_DD_MM_YYYY(rtiData.death_date) : '';
                $('.swal2-popup').css('width', '40em');
                var icData = that.getBasicConfigurationForMovement(rtiData);
                $('#popup_container').html(rtiApproveTemplate(icData));

                var efmDataDec = JSON.parse(rtiData.legal_heirs_details);
                var efmDecCnt = 1;
                $.each(efmDataDec, function (index, efm) {
                    var aliveStatus = efm.member_remarks;
                    if (aliveStatus != VALUE_TWO) {
                        var memAge = efm.member_age;
                        var late = '';
                    } else {
                        var memAge = '-';
                        var late = 'Late.';
                    }
                    var efmRowDec = '<tr><td class="text-center">' + efmDecCnt + '</td><td>' + late + '&nbsp;' + efm.member_name + '</td>' +
                            '<td class="text-center">' + memAge + '</td><td class="text-center">' + (relationDeceasedPersonArray[efm.member_relation]) + '</td>' +
                            '<td>' + (maritalStatusArray[efm.member_marital_status]) + '</td>' +
                            '<td class="text-right">' + (aliveDeathStatusArray[efm.member_remarks]) + '</td></tr>';
                    $('#efm_container_for_icupdate').append(efmRowDec);
                    efmDecCnt++;
                });
                datePicker();
            }
        });
    },
    getBasicConfigurationForMovement: function (rtiData) {
        if (rtiData.talathi_to_aci != VALUE_ZERO) {
            rtiData.show_talathi_updated_basic_details = true;
        }
        if (rtiData.aci_rec == VALUE_ONE || rtiData.aci_rec == VALUE_TWO) {
            rtiData.show_aci_updated_basic_details = true;
            rtiData.aci_rec_text = recArray[rtiData.aci_rec] ? recArray[rtiData.aci_rec] : '';
            if (rtiData.aci_rec == VALUE_ONE) {
                rtiData.act_to_mamlatdar_ldc_datetime_text = rtiData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.aci_to_ldc_datetime) : '';
                rtiData.act_to_mamlatdar_ldc_name_text = rtiData.ldc_name;
            }
            if (rtiData.aci_rec == VALUE_TWO) {
                rtiData.act_to_mamlatdar_ldc_datetime_text = rtiData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.aci_to_mamlatdar_datetime) : '';
                rtiData.act_to_mamlatdar_ldc_name_text = rtiData.mamlatdar_name;
            }
        }
        if (rtiData.ldc_to_mamlatdar != VALUE_ZERO && rtiData.aci_rec == VALUE_ONE) {
            rtiData.show_ldc_updated_basic_details = true;
            rtiData.ldc_to_mamlatdar_datetime_text = rtiData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.ldc_to_mamlatdar_datetime) : '';
        }
        if (rtiData.to_type_reverify != VALUE_ZERO) {
            rtiData.show_mam_reverify_updated_basic_details = true;
            rtiData.mam_reverification = rtiData.to_type_reverify == VALUE_ONE ? rtiData.talathi_name : rtiData.aci_name;
        }
        if (rtiData.talathi_to_type_reverify != VALUE_ZERO) {
            rtiData.talathi_reverification = rtiData.talathi_to_type_reverify == VALUE_ONE ? rtiData.aci_name : rtiData.mamlatdar_name;
            rtiData.show_talathi_reverify_updated_basic_details = true;
        }
        if (rtiData.aci_rec_reverify == VALUE_ONE || rtiData.aci_rec_reverify == VALUE_TWO) {
            rtiData.show_aci_reverify_updated_basic_details = true;
            rtiData.aci_rec_reverify_text = recArray[rtiData.aci_rec_reverify] ? recArray[rtiData.aci_rec_reverify] : '';
            if (rtiData.aci_rec_reverify == VALUE_ONE) {
                rtiData.act_to_mamlatdar_ldc_reverify_datetime_text = rtiData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.aci_to_ldc_datetime) : '';
                rtiData.act_to_mamlatdar_ldc_reverify_name_text = rtiData.ldc_name;
            }
            if (rtiData.aci_rec_reverify == VALUE_TWO) {
                rtiData.act_to_mamlatdar_ldc_reverify_datetime_text = rtiData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.aci_to_reverify_datetime) : '';
                rtiData.act_to_mamlatdar_ldc_reverify_name_text = rtiData.mamlatdar_name;
            }
        }
        if (rtiData.ldc_to_mamlatdar != VALUE_ZERO && rtiData.aci_rec_reverify == VALUE_ONE) {
            rtiData.show_ldc_reverify_updated_basic_details = true;
            rtiData.ldc_to_mamlatdar_datetime_text = rtiData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.ldc_to_mamlatdar_datetime) : '';
        }
        rtiData.talathi_to_aci_datetime_text = rtiData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.talathi_to_aci_datetime) : '';
        rtiData.aci_to_mamlatdar_datetime_text = rtiData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.aci_to_mamlatdar_datetime) : '';
        rtiData.mam_to_reverify_datetime_text = rtiData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.mam_to_reverify_datetime) : '';
        rtiData.talathi_to_reverify_datetime_text = rtiData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.talathi_to_reverify_datetime) : '';
        rtiData.aci_to_reverify_datetime_text = rtiData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(rtiData.aci_to_reverify_datetime) : '';
        return rtiData;
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_rti_form').serializeFormJSON();
        if (!formData.rti_id_for_rti_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_rti_approve) {
            $('#remarks_for_rti_approve').focus();
            validationMessageShow('rti-approve-remarks_for_rti_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_rti_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'rti/approve_application',
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
                validationMessageShow('rti-apptove', textStatus.statusText);
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
                    validationMessageShow('rti-apptove', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Rti.listview.loadRtiData();
//                $('#status_' + formData.rti_id_for_rti_approve).html(appStatusArray[VALUE_FIVE]);
//                $('#edit_btn_for_app_' + formData.rti_id_for_rti_approve).remove();
//                $('#reject_btn_for_app_' + formData.rti_id_for_rti_approve).remove();
//                $('#approve_btn_for_app_' + formData.rti_id_for_rti_approve).remove();
//                $('#download_certificate_btn_for_app_' + formData.rti_id_for_rti_approve).show();
            }
        });
    },
    askForRejectApplication: function (rtiId) {
        if (!rtiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + rtiId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'rti/get_rti_data_by_rti_id',
            type: 'post',
            data: $.extend({}, {'rti_id': rtiId}, getTokenData()),
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
                var rtiData = parseData.rti_data;
                showPopup();
                // var pre_village_text = (rtiData.district == VALUE_ONE ? damanVillagesArray : (rtiData.district == VALUE_TWO ? diuVillagesArray : (rtiData.district == VALUE_THREE ? dnhVillagesArray : [])));
                rtiData.pre_village_text = rtiData.pre_village ? rtiData.pre_village : '';
                rtiData.pre_city_text = rtiData.pre_city ? rtiData.pre_city : '';
                rtiData.relation_deceased_person_text = relationDeceasedPersonArray[rtiData.relation_deceased_person] ? relationDeceasedPersonArray[rtiData.relation_deceased_person] : '';
                rtiData.relation_with_applicant_text = relationDeceasedPersonArray[rtiData.relation_with_applicant] ? relationDeceasedPersonArray[rtiData.relation_with_applicant] : '';
                rtiData.death_date_text = dateTo_DD_MM_YYYY(rtiData.death_date) ? dateTo_DD_MM_YYYY(rtiData.death_date) : '';
                var hcData = that.getBasicConfigurationForMovement(rtiData);
                $('#popup_container').html(rtiRejectTemplate(hcData));

                var efmDataDec = JSON.parse(rtiData.legal_heirs_details);
                var efmDecCnt = 1;
                $.each(efmDataDec, function (index, efm) {
                    var aliveStatus = efm.member_remarks;
                    if (aliveStatus != VALUE_TWO) {
                        var memAge = efm.member_age;
                        var late = '';
                    } else {
                        var memAge = '-';
                        var late = 'Late.';
                    }
                    var efmRowDec = '<tr><td class="text-center">' + efmDecCnt + '</td><td>' + late + '&nbsp;' + efm.member_name + '</td>' +
                            '<td class="text-center">' + memAge + '</td><td class="text-center">' + (relationDeceasedPersonArray[efm.member_relation]) + '</td>' +
                            '<td>' + (maritalStatusArray[efm.member_marital_status]) + '</td>' +
                            '<td class="text-right">' + (aliveDeathStatusArray[efm.member_remarks]) + '</td></tr>';
                    $('#efm_container_for_icupdate').append(efmRowDec);
                    efmDecCnt++;
                });
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_rti_form').serializeFormJSON();
        if (!formData.rti_id_for_rti_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_rti_reject) {
            $('#remarks_for_rti_reject').focus();
            validationMessageShow('rti-reject-remarks_for_rti_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_rti_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'rti/reject_application',
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
                validationMessageShow('rti-reject', textStatus.statusText);
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
                    validationMessageShow('rti-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Rti.listview.loadRtiData();
            }
        });
    },
    downloadCertificate: function (rtiId, moduleType) {
        if (!rtiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#rti_id_for_certificate').val(rtiId);
        $('#mtype_for_certificate').val(moduleType);
        $('#rti_pdf_form').submit();
        $('#rti_id_for_certificate').val('');
        $('#mtype_for_certificate').val('');
    },

    getOtherProfession: function (constitution) {
        var categoryOfProffession = constitution.value;
        if (categoryOfProffession == '') {
            return false;
        }

        if (categoryOfProffession == 'other') {
            $('.other_div').show();
        } else
        {
            $('.other_div').hide();
        }


    },
    getSpouseProfession: function (constitution) {
        var categoryOfSpouseProffession = constitution.value;
        if (categoryOfSpouseProffession == '') {
            return false;
        }

        if (categoryOfSpouseProffession == 'other') {
            $('.his_her_other_div').show();
        } else
        {
            $('.his_her_other_div').hide();
        }


    },
    getQueryData: function (rtiId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!rtiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_TWELVE;
        templateData.module_id = rtiId;
        var btnObj = $('#query_btn_for_app_' + rtiId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'utility/get_query_data',
            type: 'post',
            data: $.extend({}, templateData, getTokenData()), error: function (textStatus, errorThrown) {
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
                tmpData.module_type = VALUE_TWELVE;
                tmpData.module_id = rtiId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    setAppointment: function (rtiId) {
        if (!rtiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + rtiId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'rti/get_appointment_data_by_rti_id',
            type: 'post',
            data: $.extend({}, {'rti_id': rtiId}, getTokenData()),
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
                $('#popup_container').html(rtiSetAppointmentTemplate(appointmentData));
                if (appointmentData.online_statement == VALUE_ONE) {
                    $('#online_statement_for_rti').attr('checked', 'checked');
                }
                if (appointmentData.visit_office == VALUE_ONE) {
                    $('#visit_office_for_rti').attr('checked', 'checked');
                }
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
        var formData = $('#set_appointment_rti_form').serializeFormJSON();
        if (!formData.rti_id_for_rti_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_rti) {
            $('#appointment_date_for_rti').focus();
            validationMessageShow('rti-appointment_date_for_rti', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_rti) {
            $('#appointment_time_for_rti').focus();
            validationMessageShow('rti-appointment_time_for_rti', timeValidationMessage);
            return false;
        }
        if (formData.online_statement_for_rti == undefined && formData.visit_office_for_rti == undefined) {
            $('#visit_office_for_rti').focus();
            validationMessageShow('rti-visit_office_for_rti', appointmentTypeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_rti_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'rti/submit_set_appointment',
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
                validationMessageShow('rti-set-appointment', textStatus.statusText);
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
                    validationMessageShow('rti-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var rtiData = parseData.rti_data;

                if (rtiData.appointment_date != '0000-00-00') {
                    var d1 = (dateTo_DD_MM_YYYY(rtiData.appointment_date)).split("-");
                    var d2 = (dateTo_DD_MM_YYYY()).split("-");
                    d1 = d1[2].concat(d1[1], d1[0]);
                    d2 = d2[2].concat(d2[1], d2[0]);
                    if (parseInt(d2) >= parseInt(d1)) {
                        //rtiCertificateData.show_forward_btn = true;
                        $('#update_basic_detail_btn_for_app_' + rtiData.rti_certificate_id).show();
                    } else {
                        $('#update_basic_detail_btn_for_app_' + rtiData.rti_certificate_id).hide();
                    }
                }

                $('#appointment_container_' + rtiData.rti_id).html(that.getAppointmentData(rtiData));
                $('#movement_for_ic_list_' + rtiData.rti_id).html(movementString(rtiData));
            }
        });
    },
    reverifyApplication: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_rti_form').serializeFormJSON();
        if (!formData.rti_id_for_rti_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if (!formData.to_type_reverify_for_rti) {
                $('#to_type_reverify_for_rti_1').focus();
                validationMessageShow('rti-update-basic-detail-to_type_reverify_for_rti', oneOptionValidationMessage);
                return false;
            }
            if (!formData.mam_reverify_remarks_for_rti) {
                $('#mam_reverify_remarks_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-mam_reverify_remarks_for_rti', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.talathi_to_type_reverify_for_rti) {
                $('#talathi_to_type_reverify_for_rti_1').focus();
                validationMessageShow('rti-update-basic-detail-talathi_to_type_reverify_for_rti', oneOptionValidationMessage);
                return false;
            }
            if (!formData.talathi_reverify_remarks_for_rti) {
                $('#talathi_reverify_remarks_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-talathi_reverify_remarks_for_rti', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_reverify_for_rti) {
                $('#aci_rec_reverify_for_rti_1').focus();
                validationMessageShow('rti-update-basic-detail-aci_rec_reverify_for_rti', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_reverify_remarks_for_rti) {
                $('#aci_reverify_remarks_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-aci_reverify_remarks_for_rti', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_rti == VALUE_ONE && !formData.aci_to_ldc_reverify_for_rti) {
                $('#aci_to_ldc_reverify_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-aci_to_ldc_reverify_for_rti', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_rti == VALUE_ONE && !formData.aci_to_type_reverify_for_rti) {
                $('#aci_to_type_reverify_for_rti_1').focus();
                validationMessageShow('rti-update-basic-detail-aci_to_type_reverify_for_rti', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            if (!formData.ldc_applicant_name_for_rti) {
                $('#ldc_applicant_name_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-ldc_applicant_name_for_rti', applicantNameValidationMessage);
                return false;
            }
            if (!formData.pre_house_no) {
                $('#pre_house_no_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_house_no_for_rti', houseNoValidationMessage);
                return false;
            }
            if (!formData.pre_house_name) {
                $('#pre_house_name_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_house_name_for_rti', houseNameValidationMessage);
                return false;
            }
            if (!formData.pre_street) {
                $('#pre_street_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_street_for_rti', streetValidationMessage);
                return false;
            }
            if (!formData.pre_village) {
                $('#pre_village_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_village_for_rti', villagewardValidationMessage);
                return false;
            }
            if (!formData.pre_city) {
                $('#pre_city_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_city_for_rti', selectCityValidationMessage);
                return false;
            }
            if (!formData.pre_pincode) {
                $('#pre_pincode_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_pincode_for_rti', pincodeValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_rti) {
                $('#ldc_to_mamlatdar_remarks_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-ldc_to_mamlatdar_remarks_for_rti', remarksValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_for_rti) {
                $('#ldc_to_mamlatdar_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-ldc_to_mamlatdar_for_rti', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'rti/reverify_application',
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
                validationMessageShow('rti-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('rti-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var icData = parseData.rti_data;
                if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
                    $('#status_' + formData.rti_id_for_rti_update_basic_detail).html(appStatusArray[VALUE_THREE]);
                    var reverificationName = formData.to_type_reverify_for_rti == VALUE_ONE ? formData.talathi_name_for_rti_update_basic_detail : formData.aci_name_for_rti_update_basic_detail;
                    $('#reverification_status_' + formData.rti_id_for_rti_update_basic_detail).html('<hr>' + reverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    var talathiReverificationName = formData.talathi_to_type_reverify_for_rti == VALUE_ONE ? formData.aci_name_for_rti_update_basic_detail : formData.mamlatdar_name_for_rti_update_basic_detail;
                    $('#reverification_status_' + formData.rti_id_for_rti_update_basic_detail).html('<hr>' + talathiReverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    if (icData.aci_rec_reverify == VALUE_ONE) {
                        $('#reverification_status_' + formData.rti_id_for_rti_update_basic_detail).html('<hr>' + icData.ldc_name);
                    } else {
                        $('#reverification_status_' + formData.rti_id_for_rti_update_basic_detail).html('<hr>' + formData.mamlatdar_name_for_rti_update_basic_detail);
                    }
                }
                $('#movement_for_ic_list_' + formData.rti_id_for_rti_update_basic_detail).html(movementString(parseData.rti_data));
            }
        });
    },
    updateBasicDetails: function (btnObj, rtiId) {
        if (!rtiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_LDC_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        //        tempACIData = [];
        //        tempMamData = [];
        var that = this;
        var btnObj = $('#update_basic_detail_btn_for_app_' + rtiId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'rti/get_update_basic_detail_data_by_rti_id',
            type: 'post',
            data: $.extend({}, {'rti_id': rtiId}, getTokenData()),
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
                //                tempACIData = parseData.aci_data;
//                tempMamData = parseData.mamlatdar_data;
                var basicDetailData = parseData.update_basic_detail_data;
                showPopup();
                if (basicDetailData == null) {
                    basicDetailData = {};
                }

                basicDetailData.VALUE_ONE = VALUE_ONE;
                // var pre_village_text = (basicDetailData.district == VALUE_ONE ? damanVillagesArray : (basicDetailData.district == VALUE_TWO ? diuVillagesArray : (basicDetailData.district == VALUE_THREE ? dnhVillagesArray : [])));
                basicDetailData.pre_village_text = basicDetailData.pre_village ? basicDetailData.pre_village : '';
                basicDetailData.pre_city_text = basicDetailData.pre_city ? basicDetailData.pre_city : '';
                basicDetailData.relation_deceased_person_text = relationDeceasedPersonArray[basicDetailData.relation_deceased_person] ? relationDeceasedPersonArray[basicDetailData.relation_deceased_person] : '';
                basicDetailData.relation_with_applicant_text = relationDeceasedPersonArray[basicDetailData.relation_with_applicant] ? relationDeceasedPersonArray[basicDetailData.relation_with_applicant] : '';
                basicDetailData.death_date_text = dateTo_DD_MM_YYYY(basicDetailData.death_date) ? dateTo_DD_MM_YYYY(basicDetailData.death_date) : '';
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
                if (basicDetailData.aci_rec == VALUE_ONE || basicDetailData.aci_rec == VALUE_TWO) {
                    basicDetailData.show_aci_updated_basic_details = true;
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
                    basicDetailData.show_submit_btn = true;
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && basicDetailData.aci_rec == VALUE_ONE) {
                    basicDetailData.show_ldc_updated_basic_details = true;
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
                if (basicDetailData.aci_rec_reverify == VALUE_ONE || basicDetailData.aci_rec_reverify == VALUE_TWO) {
                    basicDetailData.show_aci_reverify_updated_basic_details = true;

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
                    basicDetailData.show_submit_btn = true;
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && basicDetailData.aci_rec_reverify == VALUE_ONE) {
                    basicDetailData.show_ldc_reverify_updated_basic_details = true;
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                }
                basicDetailData.title = basicDetailData.to_type_reverify == VALUE_ZERO ? (tempTypeInSession == TEMP_TYPE_TALATHI_USER ? 'Forward for Verification' : (tempTypeInSession == TEMP_TYPE_ACI_USER ? 'Forward for Approval' : 'Update Basic Details')) : 'Reverification Rti Certificate Form';
                basicDetailData.talathi_to_aci_datetime_text = basicDetailData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_aci_datetime) : '';
                basicDetailData.mam_to_reverify_datetime_text = basicDetailData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.mam_to_reverify_datetime) : '';
                basicDetailData.talathi_to_reverify_datetime_text = basicDetailData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_reverify_datetime) : '';
                basicDetailData.aci_to_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';

                if (basicDetailData.status == VALUE_FIVE || basicDetailData.status == VALUE_SIX) {
                    basicDetailData.show_approve_reject_details = true;
                    basicDetailData.status_text = returnAppStatus(basicDetailData.status);
                    basicDetailData.status_datetime_text = basicDetailData.status_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.status_datetime) : '';
                    basicDetailData.title = 'Movement Details of Rti Certificate Form';
                }
                basicDetailData.status = queryStatus(basicDetailData.query_status);
                $('#popup_container').html(rtiUpdateBasicDetailTemplate(basicDetailData));

                if (basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) {
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.aci_data, 'talathi_to_aci_for_rti', 'sa_user_id', 'name', '', false);
                        // allowOnlyIntegerValue('income_by_talathi_for_rti');
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                        basicDetailData.aci_rec = (basicDetailData.aci_rec == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec);
                        generateBoxes('radio', recArray, 'aci_rec', 'rti', basicDetailData.aci_rec, false, false);
                        showSubContainer('aci_rec', 'rti', '#aci_to_ldc', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec', 'rti', '#aci_to_mamlatdar', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'aci_to_mamlatdar_for_rti', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_for_rti', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'ldc_to_mamlatdar_for_rti', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.to_type_reverify == VALUE_ZERO) {
                        generateBoxes('radio', reverifyTypeArray, 'to_type_reverify', 'rti', basicDetailData.to_type_reverify, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.to_type_reverify == VALUE_ONE) {
                        generateBoxes('radio', talathiReverifyTypeArray, 'talathi_to_type_reverify', 'rti', basicDetailData.talathi_to_type_reverify, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                            (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                        var tempArray = [];
                        tempArray[VALUE_ZERO] = basicDetailData.mamlatdar_name;
                        generateBoxes('radio', tempArray, 'aci_to_type_reverify', 'rti', VALUE_ZERO, false);

                        basicDetailData.aci_rec_reverify = (basicDetailData.aci_rec_reverify == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec_reverify);
                        generateBoxes('radio', recArray, 'aci_rec_reverify', 'rti', basicDetailData.aci_rec_reverify, false, false);
                        showSubContainer('aci_rec_reverify', 'rti', '#aci_to_ldc_reverify', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec_reverify', 'rti', '#aci_to_mamlatdar_reverify', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_reverify_for_rti', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec_reverify == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        var tempArray = [];
                        var tArray = {};
                        tArray['name'] = basicDetailData.mamlatdar_name;
                        tArray['sa_user_id'] = basicDetailData.aci_to_mamlatdar;
                        tempArray.push(tArray);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempArray, 'ldc_to_mamlatdar_for_rti', 'sa_user_id', 'name', '', false);
                    }
                }
            }
        });
    },
    submitBasicDetail: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_LDC_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_rti_form').serializeFormJSON();
        if (!formData.rti_id_for_rti_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
//            if (!formData.income_by_talathi_for_rti) {
//                $('#income_by_talathi_for_rti').focus();
//                validationMessageShow('rti-update-basic-detail-income_by_talathi_for_rti', incomeByAmountValidationMessage);
//                return false;
//            }
//            if (parseFloat(formData.income_by_talathi_for_rti) == VALUE_ZERO) {
//                $('#income_by_talathi_for_rti').focus();
//                validationMessageShow('rti-update-basic-detail-income_by_talathi_for_rti', incomeByAmountValidationMessage);
//                return false;
//            }
            if (!formData.talathi_remarks_for_rti) {
                $('#talathi_remarks_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-talathi_remarks_for_rti', remarksValidationMessage);
                return false;
            }
            if (!formData.talathi_to_aci_for_rti) {
                $('#talathi_to_aci_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-talathi_to_aci_for_rti', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_for_rti) {
                $('#aci_rec_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-aci_rec_for_rti', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_remarks_for_rti) {
                $('#aci_remarks_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-aci_remarks_for_rti', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_rti == VALUE_ONE && !formData.aci_to_ldc_for_rti) {
                $('#aci_to_ldc_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-aci_to_ldc_for_rti', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_rti == VALUE_TWO && !formData.aci_to_mamlatdar_for_rti) {
                $('#aci_to_mamlatdar_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-aci_to_mamlatdar_for_rti', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            if (!formData.ldc_applicant_name_for_rti) {
                $('#ldc_applicant_name_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-ldc_applicant_name_for_rti', applicantNameValidationMessage);
                return false;
            }
            if (!formData.pre_house_no) {
                $('#pre_house_no_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_house_no_for_rti', houseNoValidationMessage);
                return false;
            }
            if (!formData.pre_house_name) {
                $('#pre_house_name_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_house_name_for_rti', houseNameValidationMessage);
                return false;
            }
            if (!formData.pre_street) {
                $('#pre_street_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_street_for_rti', streetValidationMessage);
                return false;
            }
            if (!formData.pre_village) {
                $('#pre_village_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_village_for_rti', villagewardValidationMessage);
                return false;
            }
            if (!formData.pre_city) {
                $('#pre_city_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_city_for_rti', selectCityValidationMessage);
                return false;
            }
            if (!formData.pre_pincode) {
                $('#pre_pincode_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-pre_pincode_for_rti', pincodeValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_rti) {
                $('#ldc_to_mamlatdar_remarks_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-ldc_to_mamlatdar_remarks_for_rti', remarksValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_for_rti) {
                $('#ldc_to_mamlatdar_for_rti').focus();
                validationMessageShow('rti-update-basic-detail-ldc_to_mamlatdar_for_rti', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'rti/forward_to',
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
                validationMessageShow('rti-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('rti-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#movement_for_ic_list_' + parseData.rti_id).html(movementString(parseData.rti_data));
//                if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
//                    $('#talathi_for_ic_list_' + parseData.rti_id).html(parseData.talathi_name);
//                    $('#aci_for_ic_list_' + parseData.rti_id).html(parseData.aci_name);
//                }
            }
        });
    },
    getYearlyIncomeTotal: function () {
        var totalIncome = 0;
        $('.rti_family_member_info').each(function () {
            var cnt1 = $(this).find('.temp_cnt').val();

            var yearlyIncome = $('#yearly_income_for_rti_' + cnt1).val();
            currentRow = parseFloat(yearlyIncome);
            totalIncome += currentRow;
        });
        $('#total_income_for_rti').val(totalIncome);
    },
    getDocumentData: function (rtiId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!rtiId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#rti_id_for_scrutiny').val(rtiId);
        $('#rti_document_for_scrutiny').submit();
        $('#rti_id_for_scrutiny').val('');
    },
    districtChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'village_dmc_ward_for_rti');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_dmc_ward_for_rti');
    },
    getPresentAddress: function (value) {
        if ($("#same_as_present").is(':checked')) {
            $('#per_house_no_for_rti').val($('#pre_house_no_for_rti').val());
            $('#per_house_name_for_rti').val($('#pre_house_name_for_rti').val());
            $('#per_street_for_rti').val($('#pre_street_for_rti').val());
            $('#per_village_for_rti').val($('#pre_village_for_rti').val());
            $('#per_city_for_rti').val($('#pre_city_for_rti').val());
            $('#per_pincode_for_rti').val($('#pre_pincode_for_rti').val());
        } else {
            $('#per_house_no_for_rti').val('');
            $('#per_house_name_for_rti').val('');
            $('#per_street_for_rti').val('');
            $('#per_village_for_rti').val('');
            $('#per_city_for_rti').val('');
            $('#per_pincode_for_rti').val('');
        }
        generateSelect2();
    },
    villageDMCChangeEvent: function () {
        var district = $('#district_for_rti').val();
        var villageCode = $('#village_name_for_rti').val();
        var villageData = (district == VALUE_ONE ? damanVillagesArray[villageCode] : (district == VALUE_TWO ? diuVillagesArray[villageCode] : (district == VALUE_THREE ? dnhVillagesArray[villageCode] : [])));
        $('#pre_village_for_rti').val(villageData);

        // $("#billingtoo_for_rti").prop('checked',false);
        $('#per_village_for_rti').val('');
        $('#per_city_for_rti').val('');
        $('#per_pincode_for_rti').val('');

        if (district == VALUE_ONE) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'pre_city_for_rti');
            renderOptionsForTwoDimensionalArray(damanCityArray, 'per_city_for_rti');
            if (jQuery.inArray(villageCode, naniDamanVillageArray) != '-1') {
                $('#pre_city_for_rti').val(damanCityArray[VALUE_ONE]);
                var city_code = VALUE_ONE;
            } else if (jQuery.inArray(villageCode, motiDamanVillageArray) != '-1') {
                $('#pre_city_for_rti').val(damanCityArray[VALUE_TWO]);
                var city_code = VALUE_TWO;
            }

            var pincodeData = damanCityPincodeArray[city_code];
//            $('#pincode_for_rti').val(pincodeData);
            $('#pre_pincode_for_rti').val(pincodeData);

            generateSelect2();
        } else if (district == VALUE_TWO) {
            renderOptionsForTwoDimensionalArray(diuCityArray, 'pre_city_for_rti');
            renderOptionsForTwoDimensionalArray(diuCityArray, 'per_city_for_rti');
            $('#pre_city_for_rti').val(diuCityArray[VALUE_ONE]);
//            $('#pincode_for_rti').val('');
            $('#pre_pincode_for_rti').val('');

        } else if (district == VALUE_THREE) {
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'pre_city_for_rti');
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'per_city_for_rti');
            $('#pre_city_for_rti').val(dnhCityArray[VALUE_ONE]);
//            $('#pincode_for_rti').val('');
            $('#pre_pincode_for_rti').val('');
            $('#pre_pincode_for_rti').val('');
        }
    },
    getPincode: function () {
        var city_code = $('#pre_city_for_rti').val();
        var pincodeData = damanCityPincodeArray[city_code];
//        $('#pincode_for_rti').val(pincodeData);
        $('#pre_pincode_for_rti').val(pincodeData);

        var per_city_code = $('#per_city_for_rti').val();
        var pincodeData = damanCityPincodeArray[per_city_code];
        $('#per_pincode_for_rti').val(pincodeData);
    },
    getRemarksStatusForAge: function (row) {
        var status = $('#member_remarks_for_rti_' + row).val();
        if (status == VALUE_TWO) {
            $('#age_of_family_memb_for_rti_' + row).hide();
        } else {
            $('#age_of_family_memb_for_rti_' + row).show();
        }
    },
    downloadExcelForRti: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_rtige').val($('#app_no_for_rti_list').val());
        $('#app_date_for_rtige').val($('#application_date_for_rti_list').val());
        $('#app_details_for_rtige').val($('#app_details_for_rti_list').val());
        $('#vdw_for_rtige').val(tempTypeInSession != TEMP_TYPE_A ? $('#vdw_for_rti_list').val() : '');
        $('#status_for_rtige').val($('#status_for_rti_list').val());
        $('#qstatus_for_rtige').val($('#query_status_for_rti_list').val());
        $('#generate_excel_for_rti').submit();
        $('.rtige').val('');
    },
});
