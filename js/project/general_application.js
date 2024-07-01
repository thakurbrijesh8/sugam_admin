var generalApplicationListTemplate = Handlebars.compile($('#general_application_list_template').html());
var generalApplicationSearchTemplate = Handlebars.compile($('#general_application_search_template').html());
var generalApplicationTableTemplate = Handlebars.compile($('#general_application_table_template').html());
var generalApplicationActionTemplate = Handlebars.compile($('#general_application_action_template').html());
var generalApplicationViewTemplate = Handlebars.compile($('#general_application_view_template').html());
var generalApplicationSetAppointmentTemplate = Handlebars.compile($('#general_application_set_appointment_template').html());
var generalApplicationApproveTemplate = Handlebars.compile($('#general_application_approve_template').html());
var generalApplicationRejectTemplate = Handlebars.compile($('#general_application_reject_template').html());
var generalApplicationForwardApplicationTemplate = Handlebars.compile($('#general_application_forward_application_template').html());
var generalApplicationFieldVerificationDocItemTemplate = Handlebars.compile($('#general_application_field_verification_document_template').html());
var generalApplicationFieldVerificationViewDocItemTemplate = Handlebars.compile($('#general_application_field_verification_view_document_template').html());

var searchGAF = {};
var verifyDocCnt = 1;
var GeneralApplication = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
GeneralApplication.Router = Backbone.Router.extend({
    routes: {
        'general_application': 'renderList',
        'view_general_application_form': 'renderList',
    },
    renderList: function () {
        GeneralApplication.listview.listPage();
    },
    renderListForOC: function () {
        GeneralApplication.listview.listPageOC();
    },
});
GeneralApplication.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER &&
                tempTypeInSession != TEMP_TYPE_LDC_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('mam_ga', 'active');
        GeneralApplication.router.navigate('general_application');
        var templateData = {};
        searchGAF = {};
        this.$el.html(generalApplicationListTemplate(templateData));
        this.loadGeneralApplicationData(sDistrict, sType);
    },
    actionRenderer: function (rowData) {
        var isApproveShow = VALUE_ZERO;
        if (rowData.application_history != '') {
            var movmentString = JSON.parse(rowData.application_history);
            if (movmentString.length >= VALUE_TWO) {
                var lastForwardedId = parseInt(movmentString[movmentString.length - 1].forwarded_to);
                var secondLastForwardedId = parseInt(movmentString[movmentString.length - 2].forwarded_to);

                if (lastForwardedId === VALUE_FOUR && secondLastForwardedId === VALUE_THREE) {
                    isApproveShow = VALUE_ONE;
                }
            }
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if ((rowData.status == VALUE_TWO) && (rowData.query_status == VALUE_ZERO ||
                    rowData.query_status == VALUE_THREE) && rowData.is_ldc == VALUE_ONE && isApproveShow == VALUE_ONE) {
                rowData.show_approve_btn = '';
            } else {
                rowData.show_approve_btn = 'display: none;';
            }
        } else {
            rowData.show_approve_btn = 'display: none;';
        }
        if (rowData.status == VALUE_FIVE || rowData.status == VALUE_SIX) {
            rowData.show_reject_btn = 'display: none;';
        } else {
            rowData.show_reject_btn = '';
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_pa_btn = true;
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            rowData.show_fw_btn = true;
        } else {
            if ((tempTypeInSession == TEMP_TYPE_TALATHI_USER && rowData.is_talathi == VALUE_ONE)
                    || (tempTypeInSession == TEMP_TYPE_LDC_USER && rowData.is_ldc == VALUE_ONE)
                    || (tempTypeInSession == TEMP_TYPE_ACI_USER && rowData.is_aci == VALUE_ONE)) {
                rowData.show_fw_btn = true;
            }
        }
        if ((rowData.status == VALUE_FIVE)) {
            rowData.show_dwn_btn = true;
            rowData.download_certificate_style = '';
        } else {
            rowData.download_certificate_style = 'display: none;';
        }
        rowData.VALUE_ONE = VALUE_ONE;
        rowData.VALUE_TWO = VALUE_TWO;
        rowData.VALUE_THREE = VALUE_THREE;
        rowData.module_type = VALUE_THIRTY;
        rowData.GENERAL_APPLICATION_DOC_ADMIN_PATH = GENERAL_APPLICATION_DOC_ADMIN_PATH;
        return generalApplicationActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        if (appointmentData.appointment_date == '0000-00-00') {
            return '';
        }
        var returnString = '<span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">'
                + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">Visit Office</span>';
        return returnString;
    },
    loadGeneralApplicationData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        GeneralApplication.router.navigate('general_application');
        var searchData = dtoGAStatus(sDistrict, sType, 'GeneralApplication.listview.loadGeneralApplicationData();');
        $('#general_application_form_and_datatable_container').html(generalApplicationSearchTemplate(searchData));
        
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(currentlyOnGATypeArray, 'currently_on_for_general_application_list', false);
        }
        
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        //distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_general_application_list', false);
        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_general_application_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_general_application_list', false);
        datePickerId('application_date_for_general_application_list');
        if (tempTypeInSession != TEMP_TYPE_A) {
            var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'vdw_for_general_application_list', 'village', 'village_name', false, false);
        } else {
            if (typeof searchGAF.district_for_general_application_list != "undefined" && searchGAF.district_for_general_application_list != '' && searchGAF.village_for_general_application_list != '')
            {
                var villageData = (searchGAF.district_for_general_application_list == VALUE_ONE ? tempVillageData : (searchGAF.district_for_general_application_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_general_application_list', 'village', 'village_name', false, false);
            }
        }

        $('#app_no_for_general_application_list').val((typeof searchGAF.app_no_for_general_application_list != "undefined" && searchGAF.app_no_for_general_application_list != '') ? searchGAF.app_no_for_general_application_list : '');
        $('#application_date_for_general_application_list').val((typeof searchGAF.application_date_for_general_application_list != "undefined" && searchGAF.application_date_for_general_application_list != '') ? searchGAF.application_date_for_general_application_list : searchData.s_appd);
        $('#app_details_for_general_application_list').val((typeof searchGAF.app_details_for_general_application_list != "undefined" && searchGAF.app_details_for_general_application_list != '') ? searchGAF.app_details_for_general_application_list : '');
        $('#query_status_for_general_application_list').val((typeof searchGAF.query_status_for_general_application_list != "undefined" && searchGAF.query_status_for_general_application_list != '') ? searchGAF.query_status_for_general_application_list : searchData.s_qstatus);
        $('#status_for_general_application_list').val((typeof searchGAF.status_for_general_application_list != "undefined" && searchGAF.status_for_general_application_list != '') ? searchGAF.status_for_general_application_list : searchData.s_status);
        $('#currently_on_for_general_application_list').val((typeof searchGAF.currently_on_for_general_application_list != "undefined" && searchGAF.currently_on_for_general_application_list != '') ? searchGAF.currently_on_for_general_application_list : searchData.s_co_hand);
        $('#district_for_general_application_list').val((typeof searchGAF.district_for_general_application_list != "undefined" && searchGAF.district_for_general_application_list != '') ? searchGAF.district_for_general_application_list : searchData.search_district);
        $('#vdw_for_general_application_list').val((typeof searchGAF.vdw_for_general_application_list != "undefined" && searchGAF.vdw_for_general_application_list != '') ? searchGAF.vdw_for_general_application_list : '');
        $('#is_full_for_general_application_list').val((typeof searchGAF.is_full_for_general_application_list != "undefined" && searchGAF.is_full_for_general_application_list != '') ? searchGAF.is_full_for_general_application_list : searchData.s_is_full);
        this.searchGeneralApplicationData();
    },
    searchGeneralApplicationData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#general_application_datatable_container').html(generalApplicationTableTemplate);
        var searchData = $('#search_general_application_form').serializeFormJSON();
        searchGAF = searchData;
        if (typeof btnObj == "undefined" && (searchGAF.app_details_for_general_application_list == ''
                && searchGAF.app_no_for_general_application_list == ''
                && searchGAF.application_date_for_general_application_list == ''
                && searchGAF.query_status_for_general_application_list == ''
                && searchGAF.status_for_general_application_list == ''
                && (searchGAF.district_for_general_application_list == '' || typeof searchGAF.district_for_general_application_list == "undefined")
                && searchGAF.vdw_for_general_application_list == ''
                && searchGAF.is_full_for_general_application_list == '')
                && (searchGAF.currently_on_for_general_application_list == '' || typeof searchGAF.currently_on_for_general_application_list == "undefined")) {
            generalApplicationDataTable = $('#general_application_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#general_application_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name
                    + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.address + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '</b>' + (full.email != '' ? '<br><b><i class="fas fa-envelope f-s-10px"></i> :- ' + full.email + '</b>' : '');
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? tempVillageData : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village] ? villageData[full.village]['village_name'] : '');
        };
        var appointmentRenderer = function (data, type, full, meta) {
            return '<div id="appointment_container_' + data + '">' + that.getAppointmentData(full) + '</div>';
        };
        var gaAppStatusRenderer = function (data, type, full, meta) {
            return '<div id="ga_app_status_container_' + full.general_application_id + '">' + returnAppStatus(full.status) + '</div>' +
                    (full.status == VALUE_FIVE ? '<hr>' + '<div id="ga_sd_status_' + full.general_application_id + '">' +
                            (gaUploadDocStatusArray[full.doc_upload_status] ? gaUploadDocStatusArray[full.doc_upload_status] : '') + '</div>' : '');
        };
        var movementRenderer = function (data, type, full, meta) {
            if (full.application_history != '') {
                return '<div id="movement_for_ga_list_' + data + '">' + gaHistorymovementString(full) + '</div>';
            } else {
                return '<div id="movement_for_ga_list_' + data + '"></div>';
            }
        };
        $('#general_application_datatable_container').html(generalApplicationTableTemplate);
        generalApplicationDataTable = $('#general_application_datatable').DataTable({
            ajax: {url: 'general_application/get_general_application_data', dataSrc: "general_application_data", type: "post", data: searchData},
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
                {data: 'subject', 'class': 'text-center'},
                {data: 'general_application_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'general_application_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'general_application_id', 'class': 'text-center', 'render': appStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#general_application_datatable_filter').remove();
        $('#general_application_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = generalApplicationDataTable.row(tr);
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
    editOrViewGeneralApplication: function (btnObj, generalApplicationId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!generalApplicationId) {
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
            url: 'general_application/get_general_application_data_by_id', type: 'post',
            data: $.extend({}, {'general_application_id': generalApplicationId, 'is_edit': (isEdit ? VALUE_ONE : VALUE_TWO)}, getTokenData()),
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
                    that.viewGeneralApplication(VALUE_ONE, parseData, isPrint);
                }
            }
        });
    },
    viewGeneralApplication: function (moduleType, parseData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var generalApplicationData = parseData.general_application_data;
        GeneralApplication.router.navigate('view_general_application_form');
        generalApplicationData.title = 'View';
        generalApplicationData.VALUE_THREE = VALUE_THREE;
        generalApplicationData.district_text = talukaArray[generalApplicationData.district] ? talukaArray[generalApplicationData.district] : '';
        var district = generalApplicationData.district;
        var villageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        generalApplicationData.village_text = villageData[generalApplicationData.village] ? villageData[generalApplicationData.village]['village_name'] : '';
        generalApplicationData.show_applicant_photo = generalApplicationData.applicant_photo != '' ? true : false;
        generalApplicationData.show_id_proof = generalApplicationData.id_proof != '' ? true : false;
        generalApplicationData.show_other_document = generalApplicationData.other_document != '' ? true : false;
        if (generalApplicationData.status != VALUE_ZERO && generalApplicationData.status != VALUE_ONE) {
            generalApplicationData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        generalApplicationData.GENERAL_APPLICATION_DOC_PATH = GENERAL_APPLICATION_DOC_PATH;
        $('#popup_container').html(generalApplicationViewTemplate(generalApplicationData));
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_fofview').click();
            }, 500);
        }
    },
    setAppointment: function (generalApplicationId) {
        if (!generalApplicationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + generalApplicationId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'general_application/get_data_by_general_application_id',
            type: 'post',
            data: $.extend({}, {'general_application_id': generalApplicationId}, getTokenData()),
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
                var fofData = parseData.general_application_data;
                showPopup();
                if (fofData == null) {
                    var fofData = {};
                }
                if (fofData.status != VALUE_FIVE && fofData.status != VALUE_SIX) {
                    fofData.show_submit_btn = true;
                }
                $('#popup_container').html(generalApplicationSetAppointmentTemplate(fofData));
                datePickerAppointment();
                var appointmentDate = fofData.appointment_date != '0000-00-00' ? dateTo_DD_MM_YYYY(fofData.appointment_date) : '';
                $('#appointment_date_for_general_application').val(appointmentDate);
                $('#appointment_time_for_general_application').val(fofData.appointment_time);
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
        var formData = $('#set_appointment_general_application_form').serializeFormJSON();
        if (!formData.general_application_id_for_general_application_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_general_application) {
            $('#appointment_date_for_general_application').focus();
            validationMessageShow('general-application-appointment_date_for_general_application', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_general_application) {
            $('#appointment_time_for_general_application').focus();
            validationMessageShow('general-application-appointment_time_for_general_application', timeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_general_application_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'general_application/submit_set_appointment',
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
                validationMessageShow('general-application-set-appointment', textStatus.statusText);
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
                    validationMessageShow('general-application-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var incomeCertificateData = parseData.general_application_data;
                $('#appointment_container_' + incomeCertificateData.general_application_id).html(that.getAppointmentData(incomeCertificateData));
                $('#appointment_by_name_' + incomeCertificateData.general_application_id).html('<hr>' + parseData.appointment_by_name);
            }
        });
    },
    askForApproveRejectApplication: function (btnObj, generalApplicationId, moduleType) {
        if (!generalApplicationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'general_application/get_data_by_general_application_id',
            type: 'post',
            data: $.extend({}, {'general_application_id': generalApplicationId, 'module_type': moduleType}, getTokenData()),
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
                var generalApplicationData = parseData.general_application_data;

                showPopup();
                if (moduleType == VALUE_ONE) {
                    var generalApplicationHistoryData = parseData.gah_data;
                    generalApplicationData.general_application_history_id = generalApplicationHistoryData.general_application_history_id;
                    generalApplicationData.subject_text = generalApplicationData.ldc_subject != '' ? generalApplicationData.ldc_subject : generalApplicationData.subject;
                    generalApplicationData.authority = generalApplicationHistoryData.authority;
                    generalApplicationData.reference = generalApplicationHistoryData.reference;
                    generalApplicationData.copy_to = generalApplicationHistoryData.copy_to;
                    generalApplicationData.report = generalApplicationHistoryData.report;
                    generalApplicationData.VALUE_TWO = VALUE_TWO;
                    $('#popup_container').html(generalApplicationApproveTemplate(generalApplicationData));
                    that.loadReportDocumentView(generalApplicationData, VALUE_TWO);
                    $('#report_for_general_application_approve').summernote();
                    $('#reference_for_general_application_approve').summernote();
                    $('#copy_to_for_general_application_approve').summernote();
                    resetCounterForIndex('index_no_for_approve', 1);
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(generalApplicationRejectTemplate(generalApplicationData));
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
        var formData = $('#approve_general_application_form').serializeFormJSON();
        if (!formData.general_application_id_for_general_application_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.ldc_subject_for_general_application_approve) {
            $('#ldc_subject_for_general_application_approve').focus();
            validationMessageShow('general-application-approve-ldc_subject_for_general_application_approve', subjectValidationMessage);
            return false;
        }
        if (!formData.authority_for_general_application_approve) {
            $('#authority_for_general_application_approve').focus();
            validationMessageShow('general-application-approve-authority_for_general_application_approve', authorityValidationMessage);
            return false;
        }
        if ($('#reference_for_general_application_approve').summernote('isEmpty')) {
            $('#reference_for_general_application_approve').focus();
            validationMessageShow('general-application-approve-reference_for_general_application_approve', referenceValidationMessage);
            return false;
        }
        if ($('#report_for_general_application_approve').summernote('isEmpty')) {
            $('#report_for_general_application_approve').focus();
            validationMessageShow('general-application-approve-report_for_general_application_approve', reportValidationMessage);
            return false;
        }
        if ($('#copy_to_for_general_application_approve').summernote('isEmpty')) {
            $('#copy_to_for_general_application_approve').focus();
            validationMessageShow('general-application-approve-copy_to_for_general_application_approve', copytoValidationMessage);
            return false;
        }
        if (!formData.remarks_for_general_application_approve) {
            $('#remarks_for_general_application_approve').focus();
            validationMessageShow('general-application-approve-remarks_for_general_application_approve', remarksValidationMessage);
            return false;
        }

        var isReportAPDocValidation = false;
        var reportAPDocItem = [];
        $('.report_doc_info').each(function () {
            var cnt = $(this).find('.temp_cnt').val();
            var reportAPDocInfo = {};

            var reportDoc = $('#report_doc_' + cnt + ':checked').val();

            reportAPDocInfo.report_doc = reportDoc;
            reportAPDocItem.push(reportAPDocInfo);
        });
        if (isReportAPDocValidation) {
            return false;
        }
        formData.report_doc_item = reportAPDocItem;
        var btnObj = $('#submit_btn_for_general_application_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'general_application/approve_application',
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
                validationMessageShow('general-application-approve', textStatus.statusText);
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
                    validationMessageShow('general-application-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                GeneralApplication.listview.listPage();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_general_application_form').serializeFormJSON();
        if (!formData.general_application_id_for_general_application_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_general_application_reject) {
            $('#remarks_for_general_application_reject').focus();
            validationMessageShow('general-application-reject-remarks_for_general_application_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_general_application_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'general_application/reject_application',
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
                validationMessageShow('general-application-reject', textStatus.statusText);
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
                    validationMessageShow('general-application-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                GeneralApplication.listview.listPage();
            }
        });
    },
    getQueryData: function (generalApplicationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!generalApplicationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var templateData = {};
        templateData.module_type = VALUE_THIRTY;
        templateData.module_id = generalApplicationId;
        var btnObj = $('#query_btn_for_app_' + generalApplicationId);
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
                tmpData.title = 'Full Name of Applicant';
                tmpData.module_type = VALUE_THIRTY;
                tmpData.module_id = generalApplicationId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    hideShowReportInformation: function (gaData, ldcReportData) {
        var otherId = $('input[name=forward_to_for_general_application]:checked').val();
        $('.report_info_for_general_application').hide();
        $('.report_info_for_report_for_general_application').hide();
        if (((tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) && (gaData.is_report_generated == VALUE_ONE && (ldcReportData != '' && ldcReportData != null)))
                || ((tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) && otherId == VALUE_FOUR)) {
            $('.report_info_for_general_application').show();
            $('.report_info_for_report_for_general_application').show();
            resetCounterForIndex('index_no_for_ga', 2);
        } else if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            $('.report_info_for_report_for_general_application').show();
            resetCounterForIndex('index_no_for_ga', 2);
        }
        $('input[name=forward_to_for_general_application' + ']').change(function () {
            var other = $(this).val();
            $('.report_info_for_general_application').hide();
            $('.report_info_for_report_for_general_application').hide();
            if (((tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) && (gaData.is_report_generated == VALUE_ONE && (ldcReportData != '' && ldcReportData != null)))
                    || ((tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) && other == VALUE_FOUR)) {
                $('.report_info_for_general_application').show();
                $('.report_info_for_report_for_general_application').show();
                resetCounterForIndex('index_no_for_ga', 2);
                return false;
            } else if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                $('.report_info_for_report_for_general_application').show();
                resetCounterForIndex('index_no_for_ga', 2);
                return false;
            }
        });
    },
    forwardApplication: function (btnObj, generalApplicationId) {
        if (!generalApplicationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_LDC_USER
                && tempTypeInSession != TEMP_TYPE_ACI_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'general_application/get_general_application_details_by_general_application_id',
            type: 'post',
            data: $.extend({}, {'general_application_id': generalApplicationId}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
//                if (textStatus.status === 403) {
//                    loginPage();
//                    return false;
//                }
//                if (!textStatus.statusText) {
//                    loginPage();
//                    return false;
//                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
//                if (!isJSON(response)) {
//                    loginPage();
//                    return false;
//                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                var forwardToData = parseData.forward_to_data;
                var generalApplicationData = parseData.general_application_detail_data;
                var currentGeneralApplicationData = parseData.current_general_application_data;
                var generalApplicationHistoryData = parseData.general_application_history_data;
                var ldcReportData = parseData.ldc_report_data;
                //var field_documents = parseData.field_documents;

                showPopup();
                $('.swal2-popup').css('width', '45em');

                if (currentGeneralApplicationData != null) {
                    if (currentGeneralApplicationData.is_forwarded == VALUE_ONE && (generalApplicationData.status != VALUE_FIVE && generalApplicationData.status != VALUE_SIX)) {
                        if ((tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && currentGeneralApplicationData.forwarded_by == VALUE_FOUR)
                                || (tempTypeInSession == TEMP_TYPE_TALATHI_USER && currentGeneralApplicationData.forwarded_by == VALUE_ONE)
                                || (tempTypeInSession == TEMP_TYPE_ACI_USER && currentGeneralApplicationData.forwarded_by == VALUE_TWO)
                                || (tempTypeInSession == TEMP_TYPE_LDC_USER && currentGeneralApplicationData.forwarded_by == VALUE_THREE)) {
                            generalApplicationData.show_mamlatdar_enter_forward_to = true;
                            generalApplicationData.show_field_documents_forward_to = true;
                            generalApplicationData.show_frd_btn = true;
                            if (tempTypeInSession == TEMP_TYPE_LDC_USER) {
                                generalApplicationData.show_report_doc_for_ldc = true;
                            }
                            if (tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) {
                                generalApplicationData.show_ldc_ci_enter_forward_to = true;
                            }

                            if (currentGeneralApplicationData != null) {
                                generalApplicationData.report = currentGeneralApplicationData.report;
                                generalApplicationData.remarks = currentGeneralApplicationData.remarks;
                                generalApplicationData.general_application_history_id = currentGeneralApplicationData.general_application_history_id;
                            }
                        }
                    } else if (currentGeneralApplicationData.is_forwarded == VALUE_TWO && (generalApplicationData.status != VALUE_FIVE && generalApplicationData.status != VALUE_SIX)) {
                        if ((tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && currentGeneralApplicationData.forwarded_to == VALUE_FOUR)
                                || (tempTypeInSession == TEMP_TYPE_TALATHI_USER && currentGeneralApplicationData.forwarded_to == VALUE_ONE)
                                || (tempTypeInSession == TEMP_TYPE_ACI_USER && currentGeneralApplicationData.forwarded_to == VALUE_TWO)
                                || (tempTypeInSession == TEMP_TYPE_LDC_USER && currentGeneralApplicationData.forwarded_to == VALUE_THREE)) {
                            generalApplicationData.show_mamlatdar_enter_forward_to = true;
                            generalApplicationData.show_field_documents_forward_to = true;
                            generalApplicationData.show_frd_btn = true;
                            if (tempTypeInSession == TEMP_TYPE_LDC_USER) {
                                generalApplicationData.show_report_doc_for_ldc = true;
                            }
                            if (tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) {
                                generalApplicationData.show_ldc_ci_enter_forward_to = true;
                            }
                        }
                    } else {
                        generalApplicationData.show_mamlatdar_forward_to = true;
                    }
                } else {
                    if (generalApplicationData.status != VALUE_FIVE && generalApplicationData.status != VALUE_SIX) {
                        generalApplicationData.show_mamlatdar_enter_forward_to = true;
                        generalApplicationData.show_field_documents_forward_to = true;
                        generalApplicationData.show_frd_btn = true;
                        if (tempTypeInSession == TEMP_TYPE_LDC_USER) {
                            generalApplicationData.show_report_doc_for_ldc = true;
                        }
                        if (tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) {
                            generalApplicationData.show_ldc_ci_enter_forward_to = true;
                        }
                    }
                }
                if (tempTypeInSession == TEMP_TYPE_LDC_USER) {
                    generalApplicationData.show_ldc_enter_forward_to = true;
                }
                if (tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    if (ldcReportData != null && ldcReportData != '') {
                        generalApplicationData.authority = ldcReportData.authority;
                        generalApplicationData.reference = ldcReportData.reference;
                        generalApplicationData.copy_to = ldcReportData.copy_to;
                        generalApplicationData.report = ldcReportData.report;
                    } else {
                        generalApplicationData.authority = currentGeneralApplicationData.authority;
                        generalApplicationData.reference = currentGeneralApplicationData.reference;
                        generalApplicationData.copy_to = currentGeneralApplicationData.copy_to;
                    }
                }
                generalApplicationData.show_report_enter = true;
                if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
                    generalApplicationData.show_report_enter = false;
                }
                generalApplicationData.VALUE_ONE = VALUE_ONE;
                generalApplicationData.VALUE_TWO = VALUE_TWO;
                generalApplicationData.subject_text = generalApplicationData.ldc_subject != '' ? generalApplicationData.ldc_subject : generalApplicationData.subject;

                $('#popup_container').html(generalApplicationForwardApplicationTemplate(generalApplicationData));

                if (currentGeneralApplicationData == null) {
                    currentGeneralApplicationData = {};
                }
                generateBoxes('radio', yesNoArray, 'upload_verification_document', 'general_application', currentGeneralApplicationData.is_upload_verification_document, false, false);
                showSubContainer('upload_verification_document', 'general_application', '#field_verification_document_uploads', VALUE_ONE, 'radio');

                generateBoxesForGA('radio', forwardToData, forwardToArray, 'forward_to', 'general_application', currentGeneralApplicationData.forwarded_to, false);
                showSubContainer('forward_to', 'general_application', '#mam_to_ldc', VALUE_THREE, 'radio');
                showSubContainer('forward_to', 'general_application', '#mam_to_ci', VALUE_TWO, 'radio');
                showSubContainer('forward_to', 'general_application', '#mam_to_talathi', VALUE_ONE, 'radio');
                showSubContainer('forward_to', 'general_application', '#forward_to_mam', VALUE_FOUR, 'radio');

                that.hideShowReportInformation(generalApplicationData, ldcReportData);

                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'mam_to_ldc_for_general_application', 'sa_user_id', 'name', '', false);
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.aci_data, 'mam_to_ci_for_general_application', 'sa_user_id', 'name', '', false);
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.talathi_data, 'mam_to_talathi_for_general_application', 'sa_user_id', 'name', '', false);
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'forward_to_mam_for_general_application', 'sa_user_id', 'name', '', false);


                if (currentGeneralApplicationData.forwarded_to == VALUE_ONE) {
                    $('#mam_to_talathi_for_general_application').val(currentGeneralApplicationData.forwarded_to_user_id);
                } else {
                    if (parseData.talathi_data && parseData.talathi_data.length > 0) {
                        var talathiUserId = parseData.talathi_data[0].sa_user_id;
                        if (talathiUserId) {
                            $('#mam_to_talathi_for_general_application').val(talathiUserId);
                        }
                    }
                }
                if (currentGeneralApplicationData.forwarded_to == VALUE_TWO) {
                    $('#mam_to_ci_for_general_application').val(currentGeneralApplicationData.forwarded_to_user_id);
                } else {
                    if (parseData.aci_data && parseData.aci_data.length > 0) {
                        var aciUserId = parseData.aci_data[0].sa_user_id;
                        if (aciUserId) {
                            $('#mam_to_ci_for_general_application').val(aciUserId);
                        }
                    }
                }
                if (currentGeneralApplicationData.forwarded_to == VALUE_THREE) {
                    $('#mam_to_ldc_for_general_application').val(currentGeneralApplicationData.forwarded_to_user_id);
                } else {
                    if (parseData.ldc_data && parseData.ldc_data.length > 0) {
                        var ldcUserId = parseData.ldc_data[0].sa_user_id;
                        if (ldcUserId) {
                            $('#mam_to_ldc_for_general_application').val(ldcUserId);
                        }
                    }
                }
                if (currentGeneralApplicationData.forwarded_to == VALUE_FOUR) {
                    $('#forward_to_mam_for_general_application').val(currentGeneralApplicationData.forwarded_to_user_id);
                } else {
                    if (parseData.mamlatdar_data && parseData.mamlatdar_data.length > 0) {
                        var mamUserId = parseData.mamlatdar_data[0].sa_user_id;
                        if (mamUserId) {
                            $('#forward_to_mam_for_general_application').val(mamUserId);
                        }
                    }
                    //$('#forward_to_for_general_application_4').attr('checked', 'checked');
                }

                if (generalApplicationData != '' && generalApplicationData.new_field_documents != '') {
                    $.each(generalApplicationData.new_field_documents, function (index, docData) {
                        that.addVerificationDocItem(docData, VALUE_ONE);
                        $('#upload_verification_document_for_general_application_1').attr('checked', 'checked');
                        $('#field_verification_document_uploads_container_for_general_application').show();
                    });
                } else {
                    that.addVerificationDocItem({}, VALUE_ONE);
                    $('#upload_verification_document_for_general_application_2').attr('checked', 'checked');
                }

                if (generalApplicationHistoryData != '') {
                    var historyCnt = 1;
                    $.each(generalApplicationHistoryData, function (index, aph) {
                        var reportBtn = '';
                        if (aph.report != '') {
                            reportBtn = '\n\<button type="button" class="btn btn-sm btn btn-nic-blue" onclick="GeneralApplication.listview.downloadReportPdf(' + aph.general_application_history_id + ');"><i class="fas fa-file-pdf" style="margin-right: 2px;"></i></button>'
                        }

                        var aphRow = '<tr>';
                        aphRow += '<td class="text-center">' + historyCnt + '</td>\n\
                                   <td class="text-center">' + aph.forwarded_by_user_name + '</td>' +
                                '<td class="text-center">' + aph.forwarded_to_user_name + '</td>\n\
                                   <td class="text-center">' + dateTo_DD_MM_YYYY(aph.forwarded_datetime) + '</td>\n\
                                   <td class="text-center">' + aph.remarks + '</td>\n\
                                   <td class="text-center" id="document_column_' + historyCnt + '"</td>\n\
                                   <td class="text-center">' + reportBtn + '</td>';
                        aphRow += '</tr>';
                        $('#application_movment_history_container_for_general_application').append(aphRow);
                        generalApplicationData.field_documents = parseData.field_documents;
                        that.loadFieldDocumentView(generalApplicationData, historyCnt, aph.general_application_history_id);
                        historyCnt++;
                    });
                } else {
                    $('#application_movment_history_container_for_general_application').html('<tr><td colspan="7" class="text-center">No Movement History Available!</td></tr>');
                }
                generalApplicationData.all_field_documents = parseData.all_field_documents;
                generalApplicationData.ldc_report_doc_ids = currentGeneralApplicationData.ldc_report_doc_ids
                that.loadReportDocumentView(generalApplicationData, VALUE_ONE);
                $('#report_for_general_application').summernote();
                $('#reference_for_general_application').summernote();
                $('#copy_to_for_general_application').summernote();
                resetCounterForIndex('index_no_for_ga', 2);

            }
        });
    },
    submitForwardApplication: function (btnObj, moduleStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_LDC_USER
                && tempTypeInSession != TEMP_TYPE_ACI_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var formData = $('#forward_application_general_application_form').serializeFormJSON();
        var generalApplicationId = formData.general_application_id_for_general_application_forward_application;
        if (!generalApplicationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }

        if (!formData.upload_verification_document_for_general_application) {
            $('#upload_verification_document_for_general_application_1').focus();
            validationMessageShow('general-application-forward-application-upload_verification_document_for_general_application', oneOptionValidationMessage);
            return false;
        }
        if (formData.upload_verification_document_for_general_application == VALUE_ONE) {
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
        if (!formData.forward_to_for_general_application) {
            $('#forward_to_for_general_application_1').focus();
            validationMessageShow('general-application-forward-application-forward_to_for_general_application', oneOptionValidationMessage);
            return false;
        }
        if (formData.forward_to_for_general_application == VALUE_ONE) {
            if (!formData.mam_to_talathi_for_general_application) {
                $('#mam_to_talathi_for_general_application').focus();
                validationMessageShow('general-application-forward-application-mam_to_talathi_for_general_application', oneOptionValidationMessage);
                return false;
            }
        }
        if (formData.forward_to_for_general_application == VALUE_TWO) {
            if (!formData.mam_to_ci_for_general_application) {
                $('#mam_to_ci_for_general_application').focus();
                validationMessageShow('general-application-forward-application-mam_to_ci_for_general_application', oneOptionValidationMessage);
                return false;
            }
        }
        if (formData.forward_to_for_general_application == VALUE_THREE) {
            if (!formData.mam_to_ldc_for_general_application) {
                $('#mam_to_ldc_for_general_application').focus();
                validationMessageShow('general-application-forward-application-mam_to_ldc_for_general_application', oneOptionValidationMessage);
                return false;
            }
        }

        if (tempTypeInSession == TEMP_TYPE_LDC_USER) {
            if (!formData.ldc_subject_for_general_application) {
                $('#ldc_subject_for_general_application').focus();
                validationMessageShow('general-application-forward-application-ldc_subject_for_general_application', subjectValidationMessage);
                return false;
            }
        }
        if ((tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) && formData.forward_to_for_general_application == VALUE_FOUR) {
            if (!formData.authority_for_general_application) {
                $('#authority_for_general_application').focus();
                validationMessageShow('general-application-forward-application-authority_for_general_application', authorityValidationMessage);
                return false;
            }
            if ($('#reference_for_general_application').summernote('isEmpty')) {
                $('#reference_for_general_application').focus();
                validationMessageShow('general-application-forward-application-reference_for_general_application', referenceValidationMessage);
                return false;
            }
            if ($('#copy_to_for_general_application').summernote('isEmpty')) {
                $('#copy_to_for_general_application').focus();
                validationMessageShow('general-application-forward-application-copy_to_for_general_application', copytoValidationMessage);
                return false;
            }
        }

        if (tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && formData.forward_to_for_general_application == VALUE_FOUR) {
            if ($('#report_for_general_application').summernote('isEmpty')) {
                $('#report_for_general_application').focus();
                validationMessageShow('general-application-forward-application-report_for_general_application', reportValidationMessage);
                return false;
            }
        }

        if (!formData.remarks_for_general_application) {
            $('#remarks_for_general_application').focus();
            validationMessageShow('general-application-forward-application-remarks_for_general_application', remarksValidationMessage);
            return false;
        }

        if (tempTypeInSession == TEMP_TYPE_LDC_USER) {
            var isReportDocValidation = false;
            var reportDocItem = [];
            $('.report_doc_info').each(function () {
                var cnt = $(this).find('.temp_cnt').val();
                var reportDocInfo = {};

                var reportDoc = $('#report_doc_' + cnt + ':checked').val();

                reportDocInfo.report_doc = reportDoc;
                reportDocItem.push(reportDocInfo);
            });
            if (isReportDocValidation) {
                return false;
            }
        }

        if (formData.forward_to_for_general_application == VALUE_ONE) {
            var forwardedToUserNameText = jQuery("#mam_to_talathi_for_general_application option:selected").text();
        } else if (formData.forward_to_for_general_application == VALUE_TWO) {
            var forwardedToUserNameText = jQuery("#mam_to_ci_for_general_application option:selected").text();
        } else if (formData.forward_to_for_general_application == VALUE_THREE) {
            var forwardedToUserNameText = jQuery("#mam_to_ldc_for_general_application option:selected").text();
        } else {
            var forwardedToUserNameText = jQuery("#forward_to_mam_for_general_application option:selected").text();
        }
        if (tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            var summernoteContent = $('#report_for_general_application').summernote('code');

            if (summernoteContent.trim() === "" || summernoteContent.trim() === "<p><br></p>") {
                // Set the Summernote content to blank
                formData.report_for_general_application = '';
            } else {
                formData.report_for_general_application = $('#report_for_general_application').summernote('code');
            }

        }
        formData.module_status = moduleStatus;
        formData.forwarded_to_user_name = forwardedToUserNameText;
        if (tempTypeInSession == TEMP_TYPE_LDC_USER) {
            formData.report_doc_item = reportDocItem;
        }

        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'general_application/forward_to',
            data: $.extend({}, formData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
//                if (textStatus.status === 403) {
//                    loginPage();
//                    return false;
//                }
//                if (!textStatus.statusText) {
//                    loginPage();
//                    return false;
//                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                validationMessageShow('general-application-forward-application', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                if (!isJSON(response)) {
                    //loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    btnObj.html(ogBtnHTML);
                    btnObj.attr('onclick', ogBtnOnclick);
                    validationMessageShow('general-application-forward-application', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                if (moduleStatus == VALUE_TWO) {
                    $('#movement_for_ga_list_' + generalApplicationId).html(gaHistorymovementString(parseData.general_application_data));
                }
//                resetModelMD();
            }
        });
    },
    addVerificationDocItem: function (docData, moduleId) {
        var that = this;
        docData.cnt = verifyDocCnt;
        //docData.verification_type = moduleId;
        $('#upload_verification_doc_item_container_for_general_application_' + moduleId).append(generalApplicationFieldVerificationDocItemTemplate(docData));
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
        formData.append('general_application_id_for_general_application_forward_application', $('#general_application_id_for_general_application_forward_application').val());
        formData.append('field_document_id_for_field_verification', $('#field_document_id_for_field_verification_' + tempCnt).val());
        formData.append('verification_type_for_field_verification', $('#verification_type_for_field_verification_' + tempCnt).val());
        formData.append('document_for_verification_document', $('#' + id)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'general_application/upload_field_verification_document',
            data: formData,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            error: function (textStatus, errorThrown) {
//                if (textStatus.status === 403) {
//                    loginPage();
//                    return false;
//                }
//                if (!textStatus.statusText) {
//                    loginPage();
//                    return false;
//                }
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
                    //loginPage();
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
        $('#' + documentFieldName + '_name_href_for_verification_document_' + cnt).attr('href', 'documents/general_application/' + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_verification_document_' + cnt).html(VIEW_UPLODED_DOCUMENT);
        $('#' + documentFieldName + '_remove_btn_for_verification_document_' + cnt).attr('onclick', 'GeneralApplication.listview.askForRemoveDocForFieldVerification("' + docItemData.field_verification_document_id + '","' + cnt + '")');
    },
    askForRemoveDocForFieldVerification: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'GeneralApplication.listview.removeFieldDoc(' + fieldDocumentId + ', ' + cnt + ')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeFieldDoc: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'general_application/remove_field_document',
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
        var yesEvent = 'GeneralApplication.listview.removeFieldItemRow(' + cnt + ')';
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
            url: 'general_application/remove_field_document_item',
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
    loadFieldDocumentView: function (aph, historyCnt, general_application_history_id) {
        if (aph.field_documents && aph.field_documents.length > 0) {
            var documentLinks = '';
            $.each(aph.field_documents, function (index, doc) {
                if (doc.sub_module_id == general_application_history_id) {
                    var docUrl = 'documents/general_application/' + doc.document;
                    documentLinks += '<a href="' + docUrl + '" target="_blank"><i class="fa fa-eye"></i> ' + doc.doc_name + '</a><br>';
                }
            });
            $('#document_column_' + historyCnt).html(documentLinks);
        } else {
            $('#document_column_' + historyCnt).html('No Documents Available');
        }
    },
    downloadReportPdf: function (generalApplicationHistoryId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#general_application_history_id_for_gah').val(generalApplicationHistoryId);
        $('#download_general_application_history_report').submit();
        $('#general_application_history_id_for_gah').val('');
    },
    getReportData: function (generalApplicationId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!generalApplicationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#general_application_id_for_report').val(generalApplicationId);
        $('#general_application_report_for_report').submit();
        $('#general_application_id_for_report').val('');
    },
    downloadCertificate: function (generalApplicationId) {
        if (!generalApplicationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!generalApplicationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#general_application_id_for_certificate').val(generalApplicationId);
        $('#general_application_pdf_form').submit();
        $('#general_application_id_for_certificate').val('');
    },
    loadReportDocumentView: function (fieldData, moduleId) {
        var that = this;
        if ($.isEmptyObject(fieldData.all_field_documents)) {
            $('#document_item_container_for_field_verification_view_' + moduleId).append('<tr><td colspan="4" class="text-center">No Documents Available !</td></tr>');
            $('.field_varification_doc_title').hide();
            $('.field_varification_doc_tbl').hide();
        } else {
            $.each(fieldData.all_field_documents, function (index, docDetail) {
                docDetail.cnt = (index + 1);
                docDetail.moduleId = 'field_verification';
                $('#document_item_container_for_field_verification_view_' + moduleId).append(generalApplicationFieldVerificationViewDocItemTemplate(docDetail));
                if (docDetail['document'] != '') {
                    that.loadReportDocForView(docDetail.cnt, 'document', 'field_verification', docDetail.document);
                }
                if ($.inArray(docDetail.field_verification_document_id, fieldData.ldc_report_doc_ids) !== -1) {
                    $('#report_doc_' + docDetail.cnt).prop('checked', true); // Check the checkbox
                }
            });
        }
    },
    loadReportDocForView: function (tempCnt, id, moduleType, docField) {
        $('#' + id + '_container_for_' + moduleType + '_view_' + tempCnt).hide();
        $('#' + id + '_name_container_for_' + moduleType + '_view_' + tempCnt).show();
        $('#' + id + '_name_href_for_' + moduleType + '_view_' + tempCnt).attr('href', 'documents/general_application/' + docField);
        $('#' + id + '_name_for_' + moduleType + '_view_' + tempCnt).html(VIEW_UPLODED_DOCUMENT);
    },
});
