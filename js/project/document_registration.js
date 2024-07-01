var documentRegistrationListTemplate = Handlebars.compile($('#document_registration_list_template').html());
var documentRegistrationSearchTemplate = Handlebars.compile($('#document_registration_search_template').html());
var documentRegistrationTableTemplate = Handlebars.compile($('#document_registration_table_template').html());
var documentRegistrationActionTemplate = Handlebars.compile($('#document_registration_action_template').html());
var documentRegistrationFormTemplate = Handlebars.compile($('#document_registration_form_template').html());
var documentRegistrationViewTemplate = Handlebars.compile($('#document_registration_view_template').html());
var documentRegistrationPartyDetailsTemplate = Handlebars.compile($('#document_registration_party_details_template').html());
var documentRegistrationViewPartyDetailsTemplate = Handlebars.compile($('#document_registration_view_party_details_template').html());
var DRSOneFormTemplate = Handlebars.compile($('#drsone_form_template').html());
var DRSOneViewTemplate = Handlebars.compile($('#drsone_view_template').html());
var DRSOneViewDocItemTemplate = Handlebars.compile($('#drsone_view_doc_item_template').html());
var DRSOneDocItemTemplate = Handlebars.compile($('#drsone_doc_item_template').html());
var DRSTwoFormTemplate = Handlebars.compile($('#drstwo_form_template').html());
var DRSThreeFormTemplate = Handlebars.compile($('#drsthree_form_template').html());
var DRSFourFormTemplate = Handlebars.compile($('#drsfour_form_template').html());
var DRSFourPropertyDetailsTemplate = Handlebars.compile($('#drsfour_property_details_template').html());
var drPhotoDetailsTemplate = Handlebars.compile($('#dr_photo_details_template').html());
var drPhotoItemTemplate = Handlebars.compile($('#dr_photo_item_template').html());
var drPhotoCaptureTemplate = Handlebars.compile($('#dr_photo_capture_template').html());
var drFeesDetailsTemplate = Handlebars.compile($('#dr_fees_details_template').html());
var drFDItemTemplate = Handlebars.compile($('#dr_fd_item_template').html());
var drFDItemViewTemplate = Handlebars.compile($('#dr_fd_item_view_template').html());
var drSDItemTemplate = Handlebars.compile($('#dr_sd_item_template').html());
var drSDItemViewTemplate = Handlebars.compile($('#dr_sd_item_view_template').html());
var drScannedDocTemplate = Handlebars.compile($('#dr_scanned_doc_template').html());
var drViewPDATemplate = Handlebars.compile($('#dr_view_pd_a_template').html());
var drViewPDAItemTemplate = Handlebars.compile($('#dr_view_pd_a_item_template').html());
var drViewPDNATemplate = Handlebars.compile($('#dr_view_pd_na_template').html());
var drPDMapTemplate = Handlebars.compile($('#dr_pd_map_template').html());
var drPartyOrderTemplate = Handlebars.compile($('#dr_party_order_template').html());
var drPartyOrderItemTemplate = Handlebars.compile($('#dr_party_order_item_template').html());
var drsoneDocCnt = 1;
var partyDetailsCnt = 1;
var propertyDetailsCnt = 1;
var tempPMVRelation = [];
var tempPMVCR = [];
var tempLandDetails = [];
var fdCnt = 1;
var sdCnt = 1;
var DocumentRegistration = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
DocumentRegistration.Router = Backbone.Router.extend({
    routes: {
        'document_registration': 'renderList',
        'document_registration_form': 'renderList'
    },
    renderList: function () {
        DocumentRegistration.listview.listPage();
    }
});
DocumentRegistration.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (searchStatus, searchModule) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_SUBR_USER && tempTypeInSession != TEMP_TYPE_SUBR_VER_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_sub_registrar');
        addClass('subr_document_registration', 'active');
        DocumentRegistration.router.navigate('document_registration');
        var templateData = {};
        this.$el.html(documentRegistrationListTemplate(templateData));
        this.loadDocumentRegistrationData(searchStatus, searchModule);
    },
    loadDocumentRegistrationData: function (searchStatus, searchModule) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_SUBR_USER && tempTypeInSession != TEMP_TYPE_SUBR_VER_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        DocumentRegistration.router.navigate('document_registration');
        var searchData = dashboardNaviationToDocumentRegistration(searchStatus, searchModule);
        $('#document_registration_form_and_datatable_container').html(documentRegistrationSearchTemplate(searchData));
        renderOptionsForTwoDimensionalArray(docTypeArray, 'doc_type_for_document_registration_list', false);
        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_document_registration_list', false);
        renderOptionsForTwoDimensionalArray(drAppStatusTextArray, 'status_for_document_registration_list', false);
        datePickerId('appointment_date_for_document_registration_list');
        $('#status_for_document_registration_list').val(searchData.search_dr_status);
        $('#query_status_for_document_registration_list').val(searchData.search_dr_qstatus);
        $('#appointment_date_for_document_registration_list').val(searchData.search_dr_appd);
        this.searchDocumentRegistrationData();
    },
    actionRenderer: function (rowData) {
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_USER ||
                tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) &&
                rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX && rowData.fee_receipt_number == VALUE_ZERO) {
            rowData.show_edit_btn = true;
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) &&
                rowData.is_verified_doc == VALUE_ZERO && rowData.is_verified_app == VALUE_ZERO) {
            rowData.show_verify_btn = true;
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_USER) &&
                rowData.is_verified_app == VALUE_ZERO) {
            rowData.show_verify_app_btn = true;
        }
        rowData.fee_receipt_btn = 'display: none;';
        if (rowData.is_verified_app == VALUE_ONE) {
            rowData.show_doc_verified_btns = true;

            if (rowData.fee_receipt_number != VALUE_ZERO) {
                rowData.fee_receipt_btn = '';
            }
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_USER) &&
                rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX &&
                (rowData.query_status == VALUE_ZERO || rowData.query_status == VALUE_THREE)) {
            rowData.show_reject_btn = '';
        } else {
            rowData.show_reject_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) &&
                rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX) {
            rowData.show_cpo_btn = true;
        }
        if (rowData.status == VALUE_FIVE) {
            rowData.show_scanned_doc_btn = true;
        }
        return documentRegistrationActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        if (appointmentData.appointment_status == VALUE_ZERO) {
            return '<span class="badge bg-warning app-status">Appointment Not Scheduled</span>';
        }
        var returnString = '<span class="badge bg-success app-status">Appointment ' + (appointmentData.appointment_history != '' ? 'Re-' : '')
                + 'Scheduled On<hr style="border-top-color: white;">' +
                dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '</span>';
        returnString += '<span class="badge bg-white app-status mt-1" style="color: red !important;">Applicant is required to be present 15 Minutes before the Scheduled Time.</span>'
        return returnString;
    },
    searchDocumentRegistrationData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#document_registration_datatable_container').html(documentRegistrationTableTemplate);
        var searchData = $('#search_document_registration_form').serializeFormJSON();
        if (!searchData.doc_number_for_document_registration_list && !searchData.temp_application_number_for_document_registration_list &&
                !searchData.doc_type_for_document_registration_list && !searchData.appointment_date_for_document_registration_list &&
                !searchData.query_status_for_document_registration_list && !searchData.status_for_document_registration_list &&
                !searchData.party_details_for_document_registration_list) {
            documentRegistrationDataTable = $('#document_registration_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#document_registration_datatable_filter').remove();
            if (typeof btnObj != "undefined") {
                showError(oneSearchValidationMessage);
            }
            return false;
        }
        var that = this;
        var distRenderer = function (data, type, full, meta) {
            return (talukaArray[data] ? talukaArray[data] : '-') +
                    (full.status == VALUE_FIVE ? '<hr>' + ('<span class="badge badge-primary app-status">' + full.application_number + '</span>') : '');
        };
        var docAppNumberRenderer = function (data, type, full, meta) {
            return data + (full.application_datetime != '0000-00-00 00:00:00' ? '<hr>' + dateTo_DD_MM_YYYY_HH_II_SS(full.application_datetime) : '') +
                    (full.submitted_datetime != '0000-00-00 00:00:00' ? '<hr>' + dateTo_DD_MM_YYYY_HH_II_SS(full.submitted_datetime) : '');
        };
        var PPDRenderer = function (data, type, full, meta) {
            return '<b><i class="fas fa-layer-group f-s-10px"></i> :- ' + (partyCategoryArray[full.party_category] ? partyCategoryArray[full.party_category] : '') + '<br>'
                    + '<i class="fas fa-user f-s-10px"></i> :- ' + full.party_name + '</b><br>'
                    + '<i class="fas fa-street-view f-s-10px"></i> :- ' + full.party_address + '<br>'
                    + '<b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.party_mobile_number + '</b>';
        };
        var docTypeRenderer = function (data, type, full, meta) {
            return '<b><i class="fas fa-file-alt f-s-10px"></i> :- </b>' + (docTypeArray[data] ? docTypeArray[data] : '') +
                    '<br><b><i class="fas fa-rupee-sign f-s-10px"></i> :- </b>' + full.doc_consideration_amount;
        };
        var appointmentRenderer = function (data, type, full, meta) {
            return '<div id="appointment_container_' + data + '">' + that.getAppointmentData(full) + '</div>';
        };
        var drAppStatusRenderer = function (data, type, full, meta) {
            return '<div id="dr_app_status_container_' + full.document_registration_id + '">' + getDRAppStatusString(data) + (full.status == VALUE_FIVE ? ('<br>' + dateTo_DD_MM_YYYY_HH_II_SS(full.status_datetime)) : '') + '</div>' +
                    '<div id="total_fees_' + full.document_registration_id + '">' + returnFees(full) + '</div>' +
                    (full.status == VALUE_FIVE ? '<hr>' + '<div id="dr_sd_status_' + full.document_registration_id + '">' +
                            (DRUploadDocStatusArray[full.doc_upload_status] ? DRUploadDocStatusArray[full.doc_upload_status] : '') + '</div>' : '');
        };
        $('#document_registration_datatable_container').html(documentRegistrationTableTemplate);
        documentRegistrationDataTable = $('#document_registration_datatable').DataTable({
            ajax: {url: 'document_registration/get_document_registration_data',
                dataSrc: "document_registration_data", type: "post", data: searchData},
            bAutoWidth: false,
            ordering: false,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'district', 'class': 'text-center f-w-b', 'render': distRenderer},
                {data: 'temp_application_number', 'class': 'text-center f-w-b f-s-app-details', 'render': docAppNumberRenderer},
                {data: '', 'class': 'f-s-app-details', 'render': PPDRenderer},
                {data: 'doc_type', 'class': 'v-a-t f-s-app-details', 'render': docTypeRenderer},
                {data: 'document_registration_id', 'class': 'v-a-t text-center', 'render': appointmentRenderer},
                {data: 'document_registration_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'status', 'class': 'text-center', 'render': drAppStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#document_registration_datatable_filter').remove();
        $('#document_registration_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = documentRegistrationDataTable.row(tr);

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
    newDocumentRegistrationForm: function (documentRegistrationData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_SUBR_USER && tempTypeInSession != TEMP_TYPE_SUBR_VER_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        var that = this;
        $('#document_registration_form_and_datatable_container').html(documentRegistrationFormTemplate);
        that.drStepOneForm(documentRegistrationData);
    },
    stateChangeEvent: function (obj, id, moduleName) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_district_for_' + moduleName, 'district_code', 'district_name');
        $('#' + id + '_district_for_' + moduleName).val('');
        var stateCode = obj.val();
        if (!stateCode) {
            return;
        }
        var districtData = tempDistrictData[stateCode] ? tempDistrictData[stateCode] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, id + '_district_for_' + moduleName, 'district_code', 'district_name');
        $('#' + id + '_district_for_' + moduleName).val('');
    },
    drStepOneForm: function (stepOneData) {
        $('.all-step').removeClass('active text-primary');
        $('.step-one').addClass('active text-primary');
        var that = this;
        $('html, body').animate({scrollTop: '0px'}, 0);
        stepOneData.application_datetime_text = dateTo_DD_MM_YYYY_HH_II_SS(stepOneData.application_datetime);
        stepOneData.doc_execution_date_text = dateTo_DD_MM_YYYY(stepOneData.doc_execution_date);
        DocumentRegistration.router.navigate('document_registration_form');
        drsoneDocCnt = 1;
        $('#dr_form_wizard_container').html(DRSOneFormTemplate(stepOneData));
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_drsone');
        renderOptionsForTwoDimensionalArray(docLanguageArray, 'doc_language_for_drsone');
        renderOptionsForTwoDimensionalArray(docTypeArray, 'doc_type_for_drsone');
        renderOptionsForStartEndValues(0, 100, 'noy_lease_for_drsone');
        renderOptionsForStartEndValues(0, 11, 'nom_lease_for_drsone');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'dpe_state_for_drsone', 'state_code', 'state_name');
        var tDistrictData = tempDistrictData[stepOneData.dpe_state] ? tempDistrictData[stepOneData.dpe_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tDistrictData, 'dpe_district_for_drsone', 'district_code', 'district_name');
        generateBoxes('radio', feeExemptionArray, 'fee_exemption', 'drsone', stepOneData.fee_exemption, false, false);
        generateBoxes('radio', drDPETypeArray, 'dpe_type', 'drsone', stepOneData.dpe_type, false, false);
        showSubContainer('dpe_type', 'drsone', '#within_india', VALUE_ONE, 'radio', '#outside_india', VALUE_TWO);
        $('#temp_application_number_main_container_for_drsone').show();
        $('#district_for_drsone').val(stepOneData.district);
        $('#doc_language_for_drsone').val(stepOneData.doc_language);
        $('#doc_type_for_drsone').val(stepOneData.doc_type).trigger('change');
        if (stepOneData.doc_type == VALUE_TWENTYSEVEN) {
            $('#noy_lease_for_drsone').val(stepOneData.noy_lease);
            $('#nom_lease_for_drsone').val(stepOneData.nom_lease);
        }
        $('#dpe_state_for_drsone').val(stepOneData.dpe_state);
        $('#dpe_district_for_drsone').val(stepOneData.dpe_district);
        $.each(stepOneData.dr_documents, function (index, docData) {
            that.addDRSOneDocItem(docData);
        });
        allowOnlyIntegerValue('deposit_for_drsone');
        allowOnlyIntegerValue('yearly_rent_for_drsone');
        allowOnlyIntegerValue('doc_consideration_amount_for_drsone');
        resetCounter('drsone-cnt');
        generateSelect2();
        datePickerMaxToday('doc_execution_date_for_drsone');
        $('#drsone_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDRSOne($('.next_btn_for_drsone'));
            }
        });
    },
    addDRSOneDocItem: function (docData) {
        var that = this;
        docData.cnt = drsoneDocCnt;
        $('#document_item_container_for_drsone').append(DRSOneDocItemTemplate(docData));
        if (docData.document) {
            that.loadDRDocument('document', drsoneDocCnt, docData);
        }
        resetCounter('drsone-document-cnt');
        drsoneDocCnt++;
    },
    loadDRDocument: function (documentFieldName, cnt, docItemData) {
        $('#' + documentFieldName + '_container_for_drsone_' + cnt).hide();
        $('#' + documentFieldName + '_name_container_for_drsone_' + cnt).show();
        $('#' + documentFieldName + '_name_href_for_drsone_' + cnt).attr('href', DR_DOC_PATH + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_drsone_' + cnt).html(VIEW_UPLODED_DOCUMENT);
    },
    checkValidationForDRSOne: function (DRSOneData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!DRSOneData.district_for_drsone) {
            return getBasicMessageAndFieldJSONArray('district_for_drsone', selectDistrictValidationMessage);
        }
        if (!DRSOneData.doc_language_for_drsone) {
            return getBasicMessageAndFieldJSONArray('doc_language_for_drsone', oneOptionValidationMessage);
        }
        if (!DRSOneData.doc_type_for_drsone) {
            return getBasicMessageAndFieldJSONArray('doc_type_for_drsone', oneOptionValidationMessage);
        }
        if (DRSOneData.doc_type_for_drsone == VALUE_TWENTYSEVEN) {
            if (DRSOneData.noy_lease_for_drsone == '') {
                return getBasicMessageAndFieldJSONArray('noy_lease_for_drsone', oneOptionValidationMessage);
            }
            if (DRSOneData.nom_lease_for_drsone == '') {
                return getBasicMessageAndFieldJSONArray('nom_lease_for_drsone', oneOptionValidationMessage);
            }
            if (DRSOneData.noy_lease_for_drsone == VALUE_ZERO && DRSOneData.nom_lease_for_drsone == VALUE_ZERO) {
                return getBasicMessageAndFieldJSONArray('noy_lease_for_drsone', lylmValidationMessage);
            }
            if (!DRSOneData.deposit_for_drsone) {
                return getBasicMessageAndFieldJSONArray('deposit_for_drsone', depositValidationMessage);
            }
            if (!DRSOneData.yearly_rent_for_drsone || DRSOneData.yearly_rent_for_drsone == VALUE_ZERO) {
                return getBasicMessageAndFieldJSONArray('yearly_rent_for_drsone', rentValidationMessage);
            }
        }
        if (!DRSOneData.fee_exemption_for_drsone) {
            $('#fee_exemption_for_drsone_1').focus();
            return getBasicMessageAndFieldJSONArray('fee_exemption_for_drsone', oneOptionValidationMessage);
        }
        if (!DRSOneData.doc_execution_date_for_drsone) {
            return getBasicMessageAndFieldJSONArray('doc_execution_date_for_drsone', dateValidationMessage);
        }
        if (!DRSOneData.dpe_type_for_drsone) {
            return getBasicMessageAndFieldJSONArray('dpe_type_for_drsone', oneOptionValidationMessage);
        }
        if (DRSOneData.dpe_type_for_drsone == VALUE_ONE) {
            if (!DRSOneData.dpe_state_for_drsone) {
                return getBasicMessageAndFieldJSONArray('dpe_state_for_drsone', selectStateValidationMessage);
            }
            if (!DRSOneData.dpe_district_for_drsone) {
                return getBasicMessageAndFieldJSONArray('dpe_district_for_drsone', selectDistrictValidationMessage);
            }
        }
        if (DRSOneData.dpe_type_for_drsone == VALUE_TWO) {
            if (!DRSOneData.dpe_country_name_for_drsone) {
                return getBasicMessageAndFieldJSONArray('dpe_country_name_for_drsone', nameValidationMessage);
            }
            if (!DRSOneData.dpe_address_for_drsone) {
                return getBasicMessageAndFieldJSONArray('dpe_address_for_drsone', addressValidationMessage);
            }
        }
        if (!DRSOneData.adv_dw_name_for_drsone) {
            return getBasicMessageAndFieldJSONArray('adv_dw_name_for_drsone', nameValidationMessage);
        }
        return '';
    },
    submitDRSOne: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var DRSOneData = $('#drsone_form').serializeFormJSON();
        var validationDataOne = that.checkValidationForDRSOne(DRSOneData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('drsone-' + validationDataOne.field, validationDataOne.message);
            return false;
        }
        if (DRSOneData.doc_type_for_drsone == VALUE_TWENTYSEVEN) {
            var noy = DRSOneData.noy_lease_for_drsone;
            var nom = DRSOneData.nom_lease_for_drsone;
            DRSOneData.lease_period = VALUE_ZERO;
            if (noy == 0 && nom != 0 || noy == 1 && nom == 0) {
                DRSOneData.lease_period = VALUE_ONE;
            }
            if ((noy >= 1 && noy <= 4 && nom != 0) || (noy > 1 && noy <= 5 && nom == 0)) {
                DRSOneData.lease_period = VALUE_TWO;
            }
            if ((noy >= 5 && noy <= 9 && nom != 0) || (noy > 5 && noy <= 10 && nom == 0)) {
                DRSOneData.lease_period = VALUE_THREE;
            }
            if ((noy >= 10 && noy <= 19 && nom != 0) || (noy > 10 && noy <= 20 && nom == 0)) {
                DRSOneData.lease_period = VALUE_FOUR;
            }
            if ((noy >= 20 && noy <= 29 && nom != 0) || (noy > 20 && noy <= 30 && nom == 0)) {
                DRSOneData.lease_period = VALUE_FIVE;
            }
            if ((noy >= 30 && noy <= 99 && nom != 0) || (noy > 30 && noy <= 100 && nom == 0)) {
                DRSOneData.lease_period = VALUE_SIX;
            }
            if (DRSOneData.lease_period == VALUE_ZERO) {
                $('#noy_lease_for_drsone').focus();
                validationMessageShow('drsone-noy_lease_for_drsone', lylmValidationMessage);
                return false;
            }
        }
        var drdCnt = 1;
        var exiDRDItems = [];
        var isDRDItemValidation;
        $('.drsone_document_row').each(function () {
            var that = $(this);
            var tempCnt = that.find('.og_drsone_document_cnt').val();
            if (tempCnt == '' || tempCnt == null) {
                showError(invalidAccessValidationMessage);
                isDRDItemValidation = true;
                return false;
            }
            var qdItem = {};
            var drDocumentId = $('#dr_document_id_for_drsone_' + tempCnt).val();
            if (drDocumentId == '' || drDocumentId == null || drDocumentId == 0) {
                showError(invalidAccessMsg);
                isDRDItemValidation = true;
                return false;
            }
            qdItem.dr_document_id = drDocumentId;
            var docName = $('#doc_name_for_drsone_' + tempCnt).val();
            if (docName == '' || docName == null) {
                $('#doc_name_for_drsone_' + tempCnt).focus();
                validationMessageShow('drsone-doc_name_for_drsone_' + tempCnt, documentNameValidationMessage);
                isDRDItemValidation = true;
                return false;
            }
            qdItem.doc_name = docName;
            exiDRDItems.push(qdItem);
            drdCnt++;
        });
        if (isDRDItemValidation) {
            return false;
        }
        if (drdCnt == VALUE_ONE) {
            showError(oneUSCDRValidationMessage);
            return false;
        }
        DRSOneData.exi_drd_items = exiDRDItems;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'document_registration/submit_step_one',
            data: $.extend({}, DRSOneData, getTokenData()),
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
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                that.drStepTwoForm(parseData.new_pd_data);
            }
        });
    },
    loadBasicDetailsForPD: function (partyData) {
        var that = this;
        if (partyData.show_bd_drstwo) {
            generateBoxes('radio', yesNoArray, 'is_poa_holder', partyData.temp_mt, partyData.is_poa_holder, false, false);
            showSubContainer('is_poa_holder', partyData.temp_mt, '#poa_details_main', VALUE_ONE, 'radio');
            generateBoxes('radio', drPOATypeArray, 'poa_type', partyData.temp_mt, partyData.poa_type, false, false);
        }
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'party_state_for_' + partyData.temp_mt, 'state_code', 'state_name');
        var tDistrictData = partyData.party_state ? (tempDistrictData[partyData.party_state] ? tempDistrictData[partyData.party_state] : []) : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tDistrictData, 'party_district_for_' + partyData.temp_mt, 'district_code', 'district_name');
        if (partyData.party_state && partyData.party_state != VALUE_ZERO) {
            $('#party_state_for_' + partyData.temp_mt).val(partyData.party_state);
        }
        if (partyData.party_district && partyData.party_district != VALUE_ZERO) {
            $('#party_district_for_' + partyData.temp_mt).val(partyData.party_district);
        }
        generateSelect2id('party_state_for_' + partyData.temp_mt);
        generateSelect2id('party_district_for_' + partyData.temp_mt);
        renderOptionsForTwoDimensionalArray(partyCategoryArray, 'party_category_for_' + partyData.temp_mt);
        if (partyData.show_bd_drstwo) {
            $('#party_category_for_' + partyData.temp_mt + ' option[value="' + VALUE_FIVE + '"]').remove();
            $('#party_category_for_' + partyData.temp_mt + ' option[value="' + VALUE_SIX + '"]').remove();
        }
        if (partyData.party_category && partyData.party_category != VALUE_ZERO) {
            $('#party_category_for_' + partyData.temp_mt).val(partyData.party_category);
        }
        renderOptionsForTwoDimensionalArray(partyDescriptionArray, 'party_description_for_' + partyData.temp_mt);
        generateBoxes('radio', birthTypeArray, 'party_birth_type', partyData.temp_mt, partyData.party_birth_type, false, false);
        showSubContainer('party_birth_type', partyData.temp_mt, '#date_of_birth', VALUE_ONE, 'radio', '#year_of_birth', VALUE_TWO, '#age', VALUE_THREE);
        generateBoxes('radio', genderArray, 'party_gender', partyData.temp_mt, partyData.party_gender, false, false);
        renderOptionsForTwoDimensionalArray(religionArray, 'party_religion_for_' + partyData.temp_mt);
        renderOptionsForTwoDimensionalArray(drOccupationArray, 'party_occupation_for_' + partyData.temp_mt);
        generateBoxes('radio', panTypeArray, 'party_pan_type', partyData.temp_mt, partyData.party_pan_type, false, false);
        showSubContainer('party_pan_type', partyData.temp_mt, '.party_pan_details', VALUE_ONE, 'radio', '.party_form_sixteen_details', VALUE_TWO);
        if (partyData.party_description != VALUE_ZERO && partyData.party_description != '') {
            $('#party_description_for_' + partyData.temp_mt).val(partyData.party_description);
        }
        if (partyData.party_religion != VALUE_ZERO && partyData.party_religion != '') {
            $('#party_religion_for_' + partyData.temp_mt).val(partyData.party_religion);
        }
        if (partyData.party_occupation != VALUE_ZERO && partyData.party_occupation != '') {
            $('#party_occupation_for_' + partyData.temp_mt).val(partyData.party_occupation);
        }
        if (partyData.poa_doc) {
            partyData.module_type = VALUE_ONE;
            that.loadPDDocument('poa_doc', partyData.temp_mt, partyData);
        }
        if (partyData.party_pan_doc) {
            partyData.module_type = VALUE_TWO;
            that.loadPDDocument('party_pan_doc', partyData.temp_mt, partyData);
        }
        if (partyData.party_form_sixteen) {
            partyData.module_type = VALUE_THREE;
            that.loadPDDocument('party_form_sixteen', partyData.temp_mt, partyData);
        }
        if (partyData.party_aadhar_doc) {
            partyData.module_type = VALUE_FOUR;
            that.loadPDDocument('party_aadhar_doc', partyData.temp_mt, partyData);
        }
        allowOnlyIntegerValue('party_pincode_for_' + partyData.temp_mt);
        allowOnlyIntegerValue('party_dob_year_for_' + partyData.temp_mt);
        allowOnlyIntegerValue('party_age_for_' + partyData.temp_mt);
        allowOnlyIntegerValue('party_mobile_number_for_' + partyData.temp_mt);
        generateSelect2id('party_category_for_' + partyData.temp_mt);
        generateSelect2id('party_description_for_' + partyData.temp_mt);
        generateSelect2id('party_religion_for_' + partyData.temp_mt);
        generateSelect2id('party_occupation_for_' + partyData.temp_mt);
        resetCounter(partyData.temp_mt_class + '-cnt');
        datePickerId('poa_execution_date_for_' + partyData.temp_mt);
        datePickerId('party_dob_for_' + partyData.temp_mt);
        if (partyData.show_bd_drsthree) {
            that.changeEventForAcc('select', partyData, 'party_category', '_for_' + partyData.temp_mt, 'Party Category', partyCategoryArray);
            that.changeEventForAcc('select', partyData, 'party_description', '_for_' + partyData.temp_mt, 'Party Description', partyDescriptionArray);
            that.changeEventForAcc('text', partyData, 'party_name', '_for_' + partyData.temp_mt, 'Party Name', []);
        }

    },
    changeEventForAcc: function (mType, partyData, dbFieldName, mtType, tempPCName, tempArray) {
        var id = dbFieldName + mtType;
        var changeObj = mType == 'radio' ? 'input[name="' + id + '"]' : ((mType == 'select' || mType == 'text') ? '#' + id : '');
        if (mType == 'text') {
            $('#acc_' + id).html(partyData[dbFieldName] ? partyData[dbFieldName] : tempPCName);
            $(changeObj).keyup(function () {
                var other = $(this).val();
                $('#acc_' + id).html(other ? other : tempPCName);
            });
            return false;
        } else {
            $('#acc_' + id).html(partyData[dbFieldName] ? (tempArray[partyData[dbFieldName]] ? tempArray[partyData[dbFieldName]] : tempPCName) : tempPCName);
            $(changeObj).change(function () {
                var other = $(this).val();
                $('#acc_' + id).html(tempArray[other] ? tempArray[other] : tempPCName);
            });
        }
    },
    loadPDDocument: function (documentFieldName, mtType, docItemData) {
        $('#' + documentFieldName + '_container_for_' + mtType).hide();
        $('#' + documentFieldName + '_name_container_for_' + mtType).show();
        $('#' + documentFieldName + '_name_href_for_' + mtType).attr('href', DR_DOC_PATH + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_' + mtType).html(VIEW_UPLODED_DOCUMENT);
    },
    setBasicDetailsForPD: function (partyData) {
        partyData.party_birth_type = (!partyData.party_birth_type ? VALUE_ONE : partyData.party_birth_type);
        if (partyData.is_poa_holder == VALUE_ONE) {
            partyData.poa_execution_date_text = partyData.poa_execution_date != '0000-00-00' ? dateTo_DD_MM_YYYY(partyData.poa_execution_date) : '';
        }
        if (partyData.party_birth_type == VALUE_ONE) {
            partyData.party_dob_text = (partyData.party_dob != '0000-00-00' && partyData.party_dob) ? dateTo_DD_MM_YYYY(partyData.party_dob) : '';
        }
        partyData.VALUE_ONE = VALUE_ONE;
        partyData.VALUE_TWO = VALUE_TWO;
        partyData.VALUE_THREE = VALUE_THREE;
        partyData.VALUE_FOUR = VALUE_FOUR;
        return partyData;
    },
    drStepTwoForm: function (stepTwoData) {
        $('.all-step').removeClass('active text-primary');
        $('.step-one').addClass('active text-primary');
        $('.step-two').addClass('active text-primary');
        $('html, body').animate({scrollTop: '0px'}, 0);
        var that = this;
        DocumentRegistration.router.navigate('document_registration_form');
        $('#dr_form_wizard_container').html(DRSTwoFormTemplate(stepTwoData));
        stepTwoData.temp_mt = 'drstwo';
        stepTwoData.temp_mt_class = 'drstwo';
        stepTwoData.show_bd_drstwo = true;
        stepTwoData.party_type = VALUE_ONE;
        stepTwoData = that.setBasicDetailsForPD(stepTwoData);
        $('#party_details_main_container_for_drstwo').html(documentRegistrationPartyDetailsTemplate(stepTwoData));
        that.loadBasicDetailsForPD(stepTwoData);
        $('#drstwo_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDRSTwo($('.next_btn_for_drstwo'));
            }
        });
    },
    loadStepWiseForm: function (btnObj, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var documentRegistrationId = $('#document_registration_id_for_dr').val();
        if (!documentRegistrationId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        this.editOrViewDocumentRegistration(btnObj, documentRegistrationId, moduleType);
    },
    editOrViewDocumentRegistration: function (btnObj, documentRegistrationId, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!documentRegistrationId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE && moduleType != VALUE_FOUR &&
                moduleType != VALUE_FIVE && moduleType != VALUE_SIX && moduleType != VALUE_SEVEN && moduleType != VALUE_EIGHT &&
                moduleType != VALUE_NINE && moduleType != VALUE_TEN && moduleType != VALUE_ELEVEN) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'document_registration/get_document_registration_data_by_id',
            type: 'post',
            data: $.extend({}, {'document_registration_id': documentRegistrationId, 'module_type': moduleType}, getTokenData()),
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
                var documentRegistrationData = parseData.document_registration_data;
                if (moduleType == VALUE_ONE) {
                    that.newDocumentRegistrationForm(documentRegistrationData);
                }
                if (moduleType == VALUE_TWO) {
                    that.drStepTwoForm(documentRegistrationData);
                }
                if (moduleType == VALUE_THREE) {
                    that.drStepThreeForm(documentRegistrationData);
                }
                if (moduleType == VALUE_FOUR || moduleType == VALUE_FIVE || moduleType == VALUE_SEVEN ||
                        moduleType == VALUE_EIGHT || moduleType == VALUE_NINE) {
                    that.viewDocumentRegistrationDetails(moduleType, documentRegistrationData);
                }
                if (moduleType == VALUE_SIX) {
                    that.photoDetails(documentRegistrationData);
                }
                if (moduleType == VALUE_TEN) {
                    that.loadScannedDocument(documentRegistrationData);
                }
                if (moduleType == VALUE_ELEVEN) {
                    that.partyDetailsOrderingForm(documentRegistrationData);
                }
            }
        });
    },
    checkValidationForDRPD: function (partyData, moduleType, mtText) {
        if (!partyData['party_category_for_' + mtText]) {
            $('#party_category_for_' + mtText + '_1').focus();
            return getBasicMessageAndFieldJSONArray('party_category_for_' + mtText, oneOptionValidationMessage);
        }
        if (!partyData['party_description_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_description_for_' + mtText, oneOptionValidationMessage);
        }
        if (moduleType == VALUE_ONE) {
            if (!partyData['is_poa_holder_for_' + mtText]) {
                $('#is_poa_holder_for_' + mtText + '_1').focus();
                return getBasicMessageAndFieldJSONArray('is_poa_holder_for_' + mtText, oneOptionValidationMessage);
            }
            if (partyData['is_poa_holder_for_' + mtText] == VALUE_ONE) {
                if (!partyData['poa_principal_name_for_' + mtText]) {
                    return getBasicMessageAndFieldJSONArray('poa_principal_name_for_' + mtText, nameValidationMessage);
                }
                if (!partyData['poa_type_for_' + mtText]) {
                    $('#poa_type_for_' + mtText + '_1').focus();
                    return getBasicMessageAndFieldJSONArray('poa_type_for_' + mtText, oneOptionValidationMessage);
                }
                if (!partyData['poa_description_for_' + mtText]) {
                    return getBasicMessageAndFieldJSONArray('poa_description_for_' + mtText, descriptionValidationMessage);
                }
                if (!partyData['poa_principal_pd_for_' + mtText]) {
                    return getBasicMessageAndFieldJSONArray('poa_principal_pd_for_' + mtText, pdPrincipalValidationMessage);
                }
                if (!partyData['poa_execution_date_for_' + mtText]) {
                    return getBasicMessageAndFieldJSONArray('poa_execution_date_for_' + mtText, dateValidationMessage);
                }
                if (!partyData['poa_execution_place_for_' + mtText]) {
                    return getBasicMessageAndFieldJSONArray('poa_execution_place_for_' + mtText, placeValidationMessage);
                }
                if (!partyData['poa_witnesses_for_' + mtText]) {
                    return getBasicMessageAndFieldJSONArray('poa_witnesses_for_' + mtText, witnessNameValidationMessage);
                }
                if (!partyData['poa_notarised_advocate_for_' + mtText]) {
                    return getBasicMessageAndFieldJSONArray('poa_notarised_advocate_for_' + mtText, notADVValidationMessage);
                }
            }
        }
        if (!partyData['party_name_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_name_for_' + mtText, partyNameValidationMessage);
        }
        if (!partyData['party_address_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_address_for_' + mtText, addressValidationMessage);
        }
        if (!partyData['party_pincode_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_pincode_for_' + mtText, pincodeValidationMessage);
        }
        var pinMessage = pincodeValidation(partyData['party_pincode_for_' + mtText]);
        if (pinMessage != '') {
            return getBasicMessageAndFieldJSONArray('party_pincode_for_' + mtText, pinMessage);
        }
        if (!partyData['party_state_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_state_for_' + mtText, selectStateValidationMessage);
        }
        if (!partyData['party_district_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_district_for_' + mtText, selectDistrictValidationMessage);
        }
        if (!partyData['party_birth_type_for_' + mtText]) {
            $('#party_birth_type_for_' + mtText + '_1').focus();
            return getBasicMessageAndFieldJSONArray('party_birth_type_for_' + mtText, oneOptionValidationMessage);
        }
        if (partyData['party_birth_type_for_' + mtText] == VALUE_ONE && !partyData['party_dob_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_dob_for_' + mtText, dateValidationMessage);
        }
        if (partyData['party_birth_type_for_' + mtText] == VALUE_TWO && !partyData['party_dob_year_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_dob_year_for_' + mtText, yearValidationMessage);
        }
        if (partyData['party_birth_type_for_' + mtText] == VALUE_THREE && !partyData['party_age_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_age_for_' + mtText, ageValidationMessage);
        }
        if (!partyData['party_gender_for_' + mtText]) {
            $('#party_gender_for_' + mtText + '_1').focus();
            return getBasicMessageAndFieldJSONArray('party_gender_for_' + mtText, oneOptionValidationMessage);
        }
        if (!partyData['party_religion_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_religion_for_' + mtText, oneOptionValidationMessage);
        }
        if (!partyData['party_mobile_number_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_mobile_number_for_' + mtText, mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(partyData['party_mobile_number_for_' + mtText]);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('party_mobile_number_for_' + mtText, mobileMessage);
        }
        if (partyData['party_email_address_for_' + mtText] != '') {
            var emailMessage = emailIdValidation(partyData['party_email_address_for_' + mtText]);
            if (emailMessage != '') {
                return getBasicMessageAndFieldJSONArray('party_email_address_for_' + mtText, emailMessage);
            }
        }
        if (!partyData['party_occupation_for_' + mtText]) {
            return getBasicMessageAndFieldJSONArray('party_occupation_for_' + mtText, oneOptionValidationMessage);
        }
        var consAmount = parseInt($('#doc_consideration_amount_for_dr').val()) ? parseInt($('#doc_consideration_amount_for_dr').val()) : VALUE_ZERO;
        if (consAmount >= CONSIDERATION_AMOUNT && (partyData['party_category_for_' + mtText] == VALUE_ONE ||
                partyData['party_category_for_' + mtText] == VALUE_TWO || partyData['party_category_for_' + mtText] == VALUE_THREE)) {
            if (!partyData['party_pan_type_for_' + mtText]) {
                $('#party_pan_type_for_' + mtText + '_1').focus();
                return getBasicMessageAndFieldJSONArray('party_pan_type_for_' + mtText, oneOptionValidationMessage);
            }
            if (partyData['party_pan_type_for_' + mtText] == VALUE_ONE) {
                if (!partyData['party_pan_number_for_' + mtText]) {
                    return getBasicMessageAndFieldJSONArray('party_pan_number_for_' + mtText, enterPANValidationMessage);
                }
                var panMessage = PANValidation(partyData['party_pan_number_for_' + mtText]);
                if (panMessage != '') {
                    return getBasicMessageAndFieldJSONArray('party_pan_number_for_' + mtText, panMessage);
                }
            }
        }
        if (partyData['party_aadhar_number_for_' + mtText] != '') {
            var aadharMessage = checkUID(partyData['party_aadhar_number_for_' + mtText]);
            if (aadharMessage != '') {
                return getBasicMessageAndFieldJSONArray('party_aadhar_number_for_' + mtText, aadharMessage);
            }
        }
        return '';
    },
    submitDRSTwo: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var DRSTwoData = $('#drstwo_form').serializeFormJSON();
        if (!DRSTwoData.dr_party_details_id_for_drstwo) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var validationDataOne = that.checkValidationForDRPD(DRSTwoData, VALUE_ONE, 'drstwo');
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('drstwo-' + validationDataOne.field, validationDataOne.message);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'document_registration/submit_step_two',
            data: $.extend({}, DRSTwoData, getTokenData()),
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
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                that.drStepThreeForm(parseData.dr_data);
            }
        });
    },
    drStepThreeForm: function (stepThreeData) {
        $('.all-step').removeClass('active text-primary');
        $('.step-one').addClass('active text-primary');
        $('.step-two').addClass('active text-primary');
        $('.step-three').addClass('active text-primary');
        $('html, body').animate({scrollTop: '0px'}, 0);
        partyDetailsCnt = 1;
        var that = this;
        DocumentRegistration.router.navigate('document_registration_form');
        $('#dr_form_wizard_container').html(DRSThreeFormTemplate(stepThreeData));
        if (stepThreeData.new_opd_data) {
            var tempCnt = VALUE_ONE;
            $.each(stepThreeData.new_opd_data, function (index, partyDetails) {
                that.addMorePartyDetails(partyDetails);
                tempCnt++;
            });
            if (tempCnt == VALUE_ONE) {
                that.addMorePartyDetails({});
            }
        } else {
            that.addMorePartyDetails({});
        }
        $('#drsthree_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDRSThree($('.next_btn_for_drsthree'));
            }
        });
    },
    addMorePartyDetails: function (partyDetails) {
        var that = this;
        partyDetails.temp_mt = 'drsthree_' + partyDetailsCnt;
        partyDetails.temp_mt_class = 'drsthree-' + partyDetailsCnt;
        partyDetails.temp_mt_cnt = partyDetailsCnt;
        partyDetails.show_bd_drsthree = true;
        partyDetails.party_type = VALUE_TWO;
        partyDetails = that.setBasicDetailsForPD(partyDetails);
        $('#party_details_main_container_for_drsthree').append(documentRegistrationPartyDetailsTemplate(partyDetails));
        that.loadBasicDetailsForPD(partyDetails);
        resetCounter('opd-drsthree-display-cnt');
        partyDetailsCnt++;
    },
    removePartyDetails: function (tempMTCnt) {
        $('#other_party_main_details_for_drsthree_' + tempMTCnt).remove();
        resetCounter('opd-drsthree-display-cnt');
    },
    submitDRSThree: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var documentRegistrationId = $('#document_registration_id_for_dr').val();
        if (!documentRegistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        validationMessageHide();
        var drOPDCnt = 1;
        var newDROPDItems = [];
        var exiDROPDItems = [];
        var isDROPDItemValidation;
        var formData = {};
        var validationData = '';
        var opdItem = {};
        var identifierCnt = VALUE_ZERO;
        var witnessCnt = VALUE_ZERO;
        $('.other_party_details_for_drsthree').each(function () {
            var thatOPD = $(this);
            var tempMT = thatOPD.find('.temp_opd_drsthree_temp_mt').val();
            if (tempMT == '' || tempMT == null) {
                showError(invalidAccessValidationMessage);
                isDROPDItemValidation = true;
                return false;
            }
            var tempMTClass = thatOPD.find('.temp_opd_drsthree_temp_class').val();
            if (tempMTClass == '' || tempMTClass == null) {
                showError(invalidAccessValidationMessage);
                isDROPDItemValidation = true;
                return false;
            }
            formData = $('#drsthree_form_' + tempMT).serializeFormJSON();
            validationData = that.checkValidationForDRPD(formData, VALUE_TWO, tempMT);
            if (validationData != '') {
                if ($("#other_party_main_details_for_" + tempMT).hasClass("collapsed-card")) {
                    $('#other_party_main_details_hs_btn_for_' + tempMT).click();
                }
                $('#' + validationData.field).focus();
                validationMessageShow(tempMTClass + '-' + validationData.field, validationData.message);
                isDROPDItemValidation = true;
                return false;
            }
            opdItem = {};
            opdItem.party_category = formData['party_category_for_' + tempMT];
            if (opdItem.party_category == VALUE_FIVE) {
                identifierCnt++;
            } else if (opdItem.party_category == VALUE_SIX) {
                witnessCnt++;
            }
            opdItem.party_description = formData['party_description_for_' + tempMT];
            opdItem.party_name = formData['party_name_for_' + tempMT];
            opdItem.party_address = formData['party_address_for_' + tempMT];
            opdItem.party_pincode = formData['party_pincode_for_' + tempMT];
            opdItem.party_state = formData['party_state_for_' + tempMT];
            opdItem.party_district = formData['party_district_for_' + tempMT];
            opdItem.party_birth_type = formData['party_birth_type_for_' + tempMT];
            if (opdItem.party_birth_type == VALUE_ONE) {
                opdItem.party_dob = formData['party_dob_for_' + tempMT];
            }
            if (opdItem.party_birth_type == VALUE_TWO) {
                opdItem.party_dob_year = formData['party_dob_year_for_' + tempMT];
            }
            if (opdItem.party_birth_type == VALUE_THREE) {
                opdItem.party_age = formData['party_age_for_' + tempMT];
            }
            opdItem.party_gender = formData['party_gender_for_' + tempMT];
            opdItem.party_religion = formData['party_religion_for_' + tempMT];
            opdItem.party_mobile_number = formData['party_mobile_number_for_' + tempMT];
            opdItem.party_email_address = formData['party_email_address_for_' + tempMT];
            opdItem.party_occupation = formData['party_occupation_for_' + tempMT];
            opdItem.party_pan_type = formData['party_pan_type_for_' + tempMT];
            if (opdItem.party_pan_type == VALUE_ONE) {
                opdItem.party_pan_number = formData['party_pan_number_for_' + tempMT];
            }
            opdItem.party_aadhar_number = formData['party_aadhar_number_for_' + tempMT];
            opdItem.party_remarks = formData['party_remarks_for_' + tempMT];
            if (!formData['dr_party_details_id_for_' + tempMT] || formData['dr_party_details_id_for_' + tempMT] == null) {
                newDROPDItems.push(opdItem);
            } else {
                opdItem.dr_party_details_id = formData['dr_party_details_id_for_' + tempMT];
                exiDROPDItems.push(opdItem);
            }
            drOPDCnt++;
        });
        if (isDROPDItemValidation) {
            return false;
        }
        if (drOPDCnt == VALUE_ONE) {
            showError(oneOPDValidationMessage);
            return false;
        }
        if (identifierCnt == VALUE_ZERO) {
            showError(oneIdeValidationMessage);
            return false;
        }
        if (witnessCnt < VALUE_TWO) {
            showError(atWitnessValidationMessage);
            return false;
        }
        var DRSThreeData = {};
        DRSThreeData.document_registration_id = documentRegistrationId;
        DRSThreeData.new_dr_opd_items = newDROPDItems;
        DRSThreeData.exi_dr_opd_items = exiDROPDItems;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'document_registration/submit_step_three',
            data: $.extend({}, DRSThreeData, getTokenData()),
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
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                tempPMVRelation = parseData.pmv_relation_data;
                tempPMVCR = parseData.pmv_cr;
                that.drStepFourForm(parseData.dr_data);
            }
        });
    },
    drStepFourForm: function (stepFourData) {
        $('.all-step').removeClass('active text-primary');
        $('.step-one').addClass('active text-primary');
        $('.step-two').addClass('active text-primary');
        $('.step-three').addClass('active text-primary');
        $('.step-four').addClass('active text-primary');
        $('html, body').animate({scrollTop: '0px'}, 0);
        var that = this;
        tempLandDetails = [];
        propertyDetailsCnt = 1;
        stepFourData.doc_type_text = docTypeArray[stepFourData.doc_type] ? docTypeArray[stepFourData.doc_type] : '';
        DocumentRegistration.router.navigate('document_registration_form');
        if ($.inArray(parseInt(stepFourData.doc_type), isAllowExemptionArray) != -1) {
            stepFourData.show_sd_exe = true;
        }
        if (stepFourData.doc_type == VALUE_TWENTYSEVEN) {
            stepFourData.show_lease_details = true;
            stepFourData.lease_period_text = leasePeriodArray[stepFourData.lease_period] ? leasePeriodArray[stepFourData.lease_period] : '';
        } else {
            var consAmount = parseInt(stepFourData.doc_consideration_amount) ? parseInt(stepFourData.doc_consideration_amount) : VALUE_ZERO;
            if (consAmount != VALUE_ZERO) {
                stepFourData.show_total_of_entered_ca = true;
            }
            stepFourData.show_ca = true;
        }
        stepFourData.VALUE_ONE = VALUE_ONE;
        stepFourData.VALUE_TWO = VALUE_TWO;
        $('#dr_form_wizard_container').html(DRSFourFormTemplate(stepFourData));
        generateBoxes('radio', feeExemptionArray, 'property_details_status', 'drsfour', stepFourData.property_details_status);
        renderOptionsForTwoDimensionalArray(DROwnershipTypeArray, 'ownership_type_for_drsfour');
        if (stepFourData.ownership_type) {
            $('#ownership_type_for_drsfour').val(stepFourData.ownership_type);
        }
        $('input[name="property_details_status_for_drsfour"][value="' + stepFourData.property_details_status + '"]').prop('checked', true);
        renderOptionsForTwoDimensionalArray(mvExemptionArray, 'mv_exemption_for_drsfour');
        if (stepFourData.show_sd_exe) {
            renderOptionsForTwoDimensionalArray(sdExemptionArray, 'sd_exemption_for_drsfour');
            generateSelect2id('sd_exemption_for_drsfour');
        }
        generateSelect2id('mv_exemption_for_drsfour');
        generateSelect2id('ownership_type_for_drsfour');
        if (stepFourData.property_details_status == VALUE_TWO) {
            var sdCD = stepFourData.total_calculation ? JSON.parse(stepFourData.total_calculation) : [];
            if (sdCD.length != VALUE_ZERO) {
                that.loadSDRFC('other', stepFourData.doc_type, sdCD, 'oth', VALUE_ZERO);
            }
        }
        if (stepFourData.new_pd_data) {
            var sdCD = stepFourData.total_calculation ? JSON.parse(stepFourData.total_calculation) : [];
            if (sdCD.length != VALUE_ZERO) {
                sdCD.sd_rf_type = parseInt(sdCD.sd_rf_type) ? parseInt(sdCD.sd_rf_type) : VALUE_ZERO;
                sdCD.sd = parseFloat(sdCD.sd) ? parseFloat(sdCD.sd) : VALUE_ZERO;
                sdCD.rf = parseFloat(sdCD.rf) ? parseFloat(sdCD.rf) : VALUE_ZERO;
                if (consAmount != VALUE_ZERO) {
                    that.loadSDRFC('total', stepFourData.doc_type, sdCD, 'eca', consAmount);
                }
            }
            tempLandDetails = stepFourData.temp_ld_data;
            var tempCnt = VALUE_ONE;
            $.each(stepFourData.new_pd_data, function (index, propertyDetails) {
                propertyDetails.total_calculation = sdCD;
                propertyDetails.doc_type = stepFourData.doc_type;
                that.addMorePropertyDetails(propertyDetails);
                tempCnt++;
            });
        }
    },
    changeEventForECAT: function () {
        $('.null-eca-total-cal').html('0');
        $('.total_dsd_per_for_drsfour_eca').html('');
        $('.total_drf_per_for_drsfour_eca').html('');
        var docType = parseInt($('#doc_type_for_dr').val());
        var ownershipType = $('#ownership_type_for_drsfour').val();
        var consAmount = $('#doc_consideration_amount_for_dr').val();
        this.calculateECATotal(docType, ownershipType, consAmount);
    },
    calculateECATotal: function (docType, ownershipType, consAmount) {
        var that = this;
        var tDT = docTypeCPArray[docType] ? docTypeCPArray[docType] : [];
        var sdCD = tDT[ownershipType] ? tDT[ownershipType] : [];
        if (sdCD.length != VALUE_ZERO) {
            that.loadSDRFC('total', docType, sdCD, 'eca', consAmount);
        }
    },
    addMorePropertyDetails: function (propertyDetails) {
        var that = this;
        propertyDetails.VALUE_ONE = VALUE_ONE;
        propertyDetails.VALUE_TWO = VALUE_TWO;
        propertyDetails.VALUE_THREE = VALUE_THREE;
        propertyDetails.temp_cnt = propertyDetailsCnt;
        if (typeof propertyDetails.dr_property_details_id == "undefined") {
            propertyDetails.land_auto_con = VALUE_ZERO;
            propertyDetails.land_auto_sd = VALUE_ZERO;
            propertyDetails.land_auto_rf = VALUE_ZERO;
            propertyDetails.cp_auto_co = VALUE_ZERO;
            propertyDetails.cp_auto_sd = VALUE_ZERO;
            propertyDetails.cp_auto_rf = VALUE_ZERO;
        }
        var docType = parseInt($('#doc_type_for_dr').val());
        if (docType != VALUE_TWENTYSEVEN) {
            propertyDetails.show_ca = true;
        }
        $('#property_details_main_container_for_drsfour').append(DRSFourPropertyDetailsTemplate(propertyDetails));

        renderOptionsForTwoDimensionalArray(damanCityArray, 'ol_main_area_for_drsfour_' + propertyDetailsCnt);
        var olSubArea = propertyDetails.ol_main_area ? (tempPMVRelation[propertyDetails.ol_main_area] ? tempPMVRelation[propertyDetails.ol_main_area] : []) : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(olSubArea, 'ol_sub_area_for_drsfour_' + propertyDetailsCnt, 'pmv_relation_id', 'panchayat_name');
        var pArray = DRPropertyTypeArray[VALUE_ONE] ? DRPropertyTypeArray[VALUE_ONE] : [];
        renderOptionsForTwoDimensionalArray(pArray, 'ol_purpose_for_drsfour_' + propertyDetailsCnt);

        var ptArray = DRPropertyTypeArray[VALUE_TWO] ? DRPropertyTypeArray[VALUE_TWO] : [];
        renderOptionsForTwoDimensionalArray(ptArray, 'cp_property_type_for_drsfour_' + propertyDetailsCnt);
        var cpCC = propertyDetails.cp_property_type ? (DRCCArray[propertyDetails.cp_property_type] ? DRCCArray[propertyDetails.cp_property_type] : []) : [];
        renderOptionsForTwoDimensionalArray(cpCC, 'cp_cc_for_drsfour_' + propertyDetailsCnt);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(DRMFArray, 'cp_age_cd_for_drsfour_' + propertyDetailsCnt, 'mf_id', 'building_age');

        if (typeof propertyDetails.ld_type == "undefined") {
            propertyDetails.ld_type = VALUE_ONE;
        }
        if (propertyDetails.ld_type == VALUE_ONE) {
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempVillageData, 'ld_village_sc_for_drsfour_' + propertyDetailsCnt, 'village', 'name', 'devnagari');
        } else if (propertyDetails.ld_type == VALUE_TWO) {
            if (propertyDetails.ld_area_type == VALUE_ONE) {
                renderOptionsForTwoDimensionalArray(damanCityArray, 'ld_village_sc_for_drsfour_' + propertyDetailsCnt);
            } else if (propertyDetails.ld_area_type == VALUE_TWO) {
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempUVillageData, 'ld_village_sc_for_drsfour_' + propertyDetailsCnt, 'village', 'name');
            }
        }
        if (typeof propertyDetails.dr_property_details_id != "undefined") {
            that.setBDForPropertyDetails(propertyDetailsCnt, propertyDetails);
        }
        resetCounter('drsfour-cnt');
        generateSelect2Class('select2-drsfour-' + propertyDetailsCnt);
        propertyDetailsCnt++;
    },
    removePropertyDetails: function (pdCnt) {
        $('#property_main_details_for_drsfour_' + pdCnt).remove();
        $('.null-hidden-amount-total').val(VALUE_ZERO);
        $('.null-amount-total').html(VALUE_ZERO);
        this.calculateAllSDRF();
    },
    setBDForPropertyDetails: function (pdCnt, propertyDetails) {
        var that = this;
        $('input[name=pd_type_for_drsfour_' + pdCnt + '][value="' + propertyDetails.pd_type + '"]').attr('checked', true);
        that.pdTypeChangeEventForEdit(pdCnt, propertyDetails.pd_type);

        var sdCD = propertyDetails.total_calculation ? propertyDetails.total_calculation : [];
        if (propertyDetails.pd_type == VALUE_ONE || propertyDetails.pd_type == VALUE_THREE) {
            $('#ol_main_area_for_drsfour_' + pdCnt).val(propertyDetails.ol_main_area);
            $('#ol_sub_area_for_drsfour_' + pdCnt).val(propertyDetails.ol_sub_area);
            $('#ol_purpose_for_drsfour_' + pdCnt).val(propertyDetails.ol_purpose);
            if (sdCD.length != VALUE_ZERO) {
                that.loadSDRFC('land', propertyDetails.doc_type, sdCD, pdCnt, propertyDetails.land_auto_con);
            }
        }
        if (propertyDetails.pd_type == VALUE_TWO || propertyDetails.pd_type == VALUE_THREE) {
            $('#cp_property_type_for_drsfour_' + pdCnt).val(propertyDetails.cp_property_type);
            $('#cp_cc_for_drsfour_' + pdCnt).val(propertyDetails.cp_cc);

            if ((propertyDetails.cp_property_type == VALUE_FIVE && propertyDetails.cp_cc == VALUE_FIVE) ||
                    (propertyDetails.cp_property_type == VALUE_NINE && propertyDetails.cp_cc == VALUE_EIGHTEEN)) {
                $('#height_above_sqft_container_for_drsfour_' + pdCnt).show();
            }

            $('#cp_age_cd_for_drsfour_' + pdCnt).val(propertyDetails.cp_age_cd);
            if (sdCD.length != VALUE_ZERO) {
                that.loadSDRFC('cp', propertyDetails.doc_type, sdCD, pdCnt, propertyDetails.cp_auto_co, propertyDetails.ownership_type, propertyDetails.cp_property_type, propertyDetails.cp_cc, propertyDetails.cp_height_above);
            }
        }
        $('input[name=ld_type_for_drsfour_' + pdCnt + '][value="' + propertyDetails.ld_type + '"]').click();
        if (propertyDetails.ld_type == VALUE_TWO) {
            $('input[name=ld_area_type_for_drsfour_' + pdCnt + '][value="' + propertyDetails.ld_area_type + '"]').click();
        }
        $('#ld_village_sc_for_drsfour_' + pdCnt).val(propertyDetails.ld_village_sc);

        var villageWise = tempLandDetails[propertyDetails.ld_type] ? tempLandDetails[propertyDetails.ld_type] : [];
        if (propertyDetails.ld_type == VALUE_ONE) {
            var tvData = villageWise[propertyDetails.ld_village_sc] ? villageWise[propertyDetails.ld_village_sc]['ld_srv_pts_gtw_data'] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForLand(tvData, 'ld_srv_pts_gtw_for_drsfour_' + pdCnt, 'survey', 'survey');

            var subDiv = villageWise[propertyDetails.ld_village_sc] ? (villageWise[propertyDetails.ld_village_sc][propertyDetails.ld_srv_pts_gtw] ? villageWise[propertyDetails.ld_village_sc][propertyDetails.ld_srv_pts_gtw] : []) : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(subDiv, 'ld_sd_cl_pt_for_drsfour_' + pdCnt, 'subdiv', 'subdiv');
        }
        if (propertyDetails.ld_type == VALUE_TWO) {
            var avData = villageWise[propertyDetails.ld_area_type] ? villageWise[propertyDetails.ld_area_type] : [];
            var tvData = avData[propertyDetails.ld_village_sc] ? avData[propertyDetails.ld_village_sc]['ld_srv_pts_gtw_data'] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tvData, 'ld_srv_pts_gtw_for_drsfour_' + pdCnt, 'pts_gtw', 'pts_gtw');

            var clptDiv = avData[propertyDetails.ld_village_sc] ? (avData[propertyDetails.ld_village_sc][propertyDetails.ld_srv_pts_gtw] ? avData[propertyDetails.ld_village_sc][propertyDetails.ld_srv_pts_gtw] : []) : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(clptDiv, 'ld_sd_cl_pt_for_drsfour_' + pdCnt, 'cl_pt', 'cl_pt');
        }
        $('#ld_srv_pts_gtw_for_drsfour_' + pdCnt).val(propertyDetails.ld_srv_pts_gtw);
        $('#ld_sd_cl_pt_for_drsfour_' + pdCnt).val(propertyDetails.ld_sd_cl_pt);
    },
    pdTypeChangeEvent: function (pdType, tempCnt) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if ((pdType != VALUE_ONE && pdType != VALUE_TWO && pdType != VALUE_THREE) ||
                (!tempCnt || tempCnt == null)) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        this.calculationForSDRF(tempCnt);
        this.pdTypeChangeEventForEdit(tempCnt, pdType);
    },
    pdTypeChangeEventForEdit: function (tempCnt, pdType) {
        $('.pd-type-open-land-' + tempCnt).hide();
        $('.pd-type-constructed-property-' + tempCnt).hide();
        $('.pd-type-both-' + tempCnt).hide();
        if (pdType == VALUE_ONE) {
            $('.pd-type-both-' + tempCnt).show();
            $('.pd-type-open-land-' + tempCnt).show();
            return false;
        }
        if (pdType == VALUE_TWO) {
            $('.pd-type-both-' + tempCnt).show();
            $('.pd-type-constructed-property-' + tempCnt).show();
            return false;
        }
        if (pdType == VALUE_THREE) {
            $('.pd-type-both-' + tempCnt).show();
            $('.pd-type-open-land-' + tempCnt).show();
            $('.pd-type-constructed-property-' + tempCnt).show();
            return false;
        }
    },
    mainAreaChangeEvent: function (obj, tempCnt) {
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'ol_sub_area_for_drsfour_' + tempCnt, 'pmv_relation_id', 'panchayat_name');
        $('#ol_sub_area_for_drsfour_' + tempCnt).val('');
        if (!tempCnt || tempCnt == null) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var mainArea = obj.val();
        if (!mainArea) {
            return false;
        }
        var subCity = tempPMVRelation[mainArea] ? tempPMVRelation[mainArea] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(subCity, 'ol_sub_area_for_drsfour_' + tempCnt, 'pmv_relation_id', 'panchayat_name');
    },
    ptChangeEvent: function (obj, tempCnt) {
        renderOptionsForTwoDimensionalArray([], 'cp_cc_for_drsfour_' + tempCnt);
        $('#cp_cc_for_drsfour_' + tempCnt).val('');
        if (!tempCnt || tempCnt == null) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var pType = obj.val();
        if (!pType) {
            return false;
        }
        var ccArray = DRCCArray[pType] ? DRCCArray[pType] : [];
        renderOptionsForTwoDimensionalArray(ccArray, 'cp_cc_for_drsfour_' + tempCnt);
    },
    ldTypeChangeEvent: function (ldType, tempCnt) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var district = $('#district_for_dr').val();
        if (district != VALUE_ONE && district != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ((ldType != VALUE_ONE && ldType != VALUE_TWO) || (!tempCnt || tempCnt == null)) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        $('#ld_area_type_container_for_drsfour_' + tempCnt).hide();
        if (ldType == VALUE_ONE) {
            $('#ld_village_sc_title_for_drsfour_' + tempCnt).html('1.1 Village <span class="color-nic-red">*</span>');
            $('#ld_srv_pts_gtw_title_for_drsfour_' + tempCnt).html('1.2 Survey Number <span class="color-nic-red">*</span>');
            $('#ld_sd_cl_pt_title_for_drsfour_' + tempCnt).html('1.3 Subdivision Number <span class="color-nic-red">*</span>');
            that.resetLandDetailsCombo(tempCnt, district, ldType);
        }
        if (ldType == VALUE_TWO) {
            $('#ld_area_type_container_for_drsfour_' + tempCnt).show();
            var ldAreaType = $('input[name="ld_area_type_for_drsfour_' + tempCnt + '"]:checked').val();
            that.ldAreaTypeChangeEvent(ldAreaType, tempCnt);
        }
    },
    ldAreaTypeChangeEvent: function (ldAreaType, tempCnt) {
        if (!tempCnt || tempCnt == null) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var district = $('#district_for_dr').val();
        if (district != VALUE_ONE && district != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var ldType = $('input[name="ld_type_for_drsfour_' + tempCnt + '"]:checked').val();
        if (ldType != VALUE_ONE && ldType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        if (ldAreaType != VALUE_ONE && ldAreaType != VALUE_TWO) {
            $('input[name="ld_area_type_for_drsfour_' + tempCnt + '"][value="' + VALUE_ONE + '"]').click();
            ldAreaType = VALUE_ONE;
        }
        if (ldAreaType == VALUE_ONE) {
            $('#ld_village_sc_title_for_drsfour_' + tempCnt).html('1.2 Sub City <span class="color-nic-red">*</span>');
            $('#ld_srv_pts_gtw_title_for_drsfour_' + tempCnt).html('1.3 P.T. Sheet Number <span class="color-nic-red">*</span>');
            $('#ld_sd_cl_pt_title_for_drsfour_' + tempCnt).html('1.4 Chalta Number <span class="color-nic-red">*</span>');
        }
        if (ldAreaType == VALUE_TWO) {
            $('#ld_village_sc_title_for_drsfour_' + tempCnt).html('1.2 Village <span class="color-nic-red">*</span>');
            $('#ld_srv_pts_gtw_title_for_drsfour_' + tempCnt).html('1.3 Gauthan Wise Number <span class="color-nic-red">*</span>');
            $('#ld_sd_cl_pt_title_for_drsfour_' + tempCnt).html('1.4 Plot Number <span class="color-nic-red">*</span>');
        }
        that.resetLandDetailsCombo(tempCnt, district, ldType);
    },
    resetLandDetailsCombo: function (tempCnt, district, ldType) {
        renderOptionsForTwoDimensionalArray([], 'ld_village_sc_for_drsfour_' + tempCnt);
        if (district == VALUE_ONE && ldType == VALUE_ONE) {
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempVillageData, 'ld_village_sc_for_drsfour_' + tempCnt, 'village', 'name', 'devnagari');
        }
        if (district == VALUE_ONE && ldType == VALUE_TWO) {
            var ldAreaType = $('input[name="ld_area_type_for_drsfour_' + tempCnt + '"]:checked').val();
            if (ldAreaType == VALUE_ONE) {
                renderOptionsForTwoDimensionalArray(damanCityArray, 'ld_village_sc_for_drsfour_' + tempCnt);
            } else if (ldAreaType == VALUE_TWO) {
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempUVillageData, 'ld_village_sc_for_drsfour_' + tempCnt, 'village', 'name', 'devnagari');
            }
        }
        renderOptionsForTwoDimensionalArray([], 'ld_srv_pts_gtw_for_drsfour_' + tempCnt);
        renderOptionsForTwoDimensionalArray([], 'ld_sd_cl_pt_for_drsfour_' + tempCnt);
        $('#ld_village_sc_for_drsfour_' + tempCnt).val('');
        $('#ld_srv_pts_gtw_for_drsfour_' + tempCnt).val('');
        $('#ld_sd_cl_pt_for_drsfour_' + tempCnt).val('');
    },
    pdsChangeEventForCal: function (pdsType) {
        var that = this;
        $('.pd_a_container_for_drsfour').hide();
        $('.pd_na_container_for_drsfour').hide();
        if (pdsType != VALUE_ONE && pdsType != VALUE_TWO) {
            return false;
        }
        if (pdsType == VALUE_ONE) {
            $('.pd_a_container_for_drsfour').show();
        } else if (pdsType == VALUE_TWO) {
            $('.pd_na_container_for_drsfour').show();
        }
        var docType = parseInt($('#doc_type_for_dr').val());
        if (docType == VALUE_TWENTYSEVEN) {
            that.calculateLeaseCalculation(docType, pdsType);
        } else {
            that.mainChangeEventForCal();
        }
    },
    calculateLeaseCalculation: function (docType, pdsType) {
        var that = this;
        var noyLease = $('#noy_lease_for_dr').val();
        var nomLease = $('#nom_lease_for_dr').val();
        var leasePeriod = parseInt($('#lease_period_for_dr').val());
        var tDeposit = parseInt($('#deposit_for_dr').val());
        var deposit = tDeposit ? tDeposit : VALUE_ZERO;
        var tYearlyRent = parseInt($('#yearly_rent_for_dr').val());
        var yearlyRent = tYearlyRent ? tYearlyRent : VALUE_ZERO;
        if (pdsType == VALUE_ONE) {
            $('.null-amount-total').html('0');
            $('.null-hidden-amount-total').html(VALUE_ZERO);
            $('#total_dsd_auto_for_drsfour').html('');
            $('#total_drf_auto_for_drsfour').html('');
        }
        if (pdsType == VALUE_TWO) {
            $('.null-oth-cal').html('0');
            $('.null-hidden-amount-oth').val(VALUE_ZERO);
            $('.other_dsd_per_for_drsfour_oth').html('');
            $('.other_drf_per_for_drsfour_oth').html('');
        }
        if (noyLease != '' && nomLease != '' && yearlyRent != VALUE_ZERO && leasePeriod != VALUE_ZERO) {
            var tDT = docTypeCPArray[docType] ? docTypeCPArray[docType] : [];
            var sdrfCD = tDT[leasePeriod] ? tDT[leasePeriod] : [];
            if (sdrfCD.length != VALUE_ZERO) {
                if (leasePeriod == VALUE_ONE) {
                    var sd = Math.ceil((tYearlyRent * sdrfCD.r_sd) / 100);
                } else {
                    var sd = Math.ceil((tYearlyRent * sdrfCD.r_sd) / 100) + (deposit != VALUE_ZERO ? Math.ceil((deposit * sdrfCD.d_sd) / 100) : VALUE_ZERO);
                }
                var rf = Math.ceil(((tYearlyRent + deposit) * sdrfCD.dr_rf) / 100);
                if (pdsType == VALUE_ONE) {
                    $('#total_auto_sd_amount_drsfour').val(sd);
                    $('#total_dsd_auto_for_drsfour').html(sd);
                    $('#total_auto_rf_amount_drsfour').val(rf);
                    $('#total_drf_auto_for_drsfour').html(rf);
                }
                if (pdsType == VALUE_TWO) {
                    $('#other_auto_sd_amount_drsfour_oth').val(sd);
                    $('#other_dsd_auto_for_drsfour_oth').html(sd);
                    $('#other_auto_rf_amount_drsfour_oth').val(rf);
                    $('#other_drf_auto_for_drsfour_oth').html(rf);
                }
            }
        }
    },
    mainChangeEventForCal: function () {
        var that = this;
        var pds = $('input[name="property_details_status_for_drsfour"]:checked').val();
        if (pds == VALUE_TWO) {
            $('.null-oth-cal').html('0');
            $('.other_dsd_per_for_drsfour_oth').html('');
            $('.other_drf_per_for_drsfour_oth').html('');
            $('.null-hidden-amount-oth').val(VALUE_ZERO);
            that.calculationForSDRFOther();
            return;
        }
        if (pds == VALUE_ONE) {
            that.calculateAllSDRF();
            that.changeEventForECAT();
        }
    },
    calculateAllSDRF: function () {
        var that = this;
        $('.property_details_for_drsfour').each(function () {
            var thatOPD = $(this);
            var tempMT = thatOPD.find('.temp_opd_drsfour_cnt').val();
            that.calculationForSDRF(tempMT);
        });
    },
    calculationForSDRFOther: function () {
        var that = this;
        var docType = parseInt($('#doc_type_for_dr').val());
        if (!docType) {
            return false;
        }
        that.SDRFCalculation('other', docType, 'oth', VALUE_ZERO);
    },
    calculationForSDRF: function (tempCnt) {
        var that = this;
        if (!tempCnt) {
            return false;
        }
        var docType = parseInt($('#doc_type_for_dr').val());
        if (!docType) {
            return false;
        }
        $('.null-' + tempCnt + '-cal').html('0');
        $('.land_dsd_per_for_drsfour_' + tempCnt).html('');
        $('.land_drf_per_for_drsfour_' + tempCnt).html('');
        $('.cp_dsd_per_for_drsfour_' + tempCnt).html('');
        $('.cp_drf_per_for_drsfour_' + tempCnt).html('');
        $('.null-hidden-amount-' + tempCnt).val(VALUE_ZERO);
        var pdType = $('input[name="pd_type_for_drsfour_' + tempCnt + '"]:checked').val();
        if (pdType != VALUE_ONE && pdType != VALUE_TWO && pdType != VALUE_THREE) {
            return false;
        }
        if (docType != VALUE_TWENTYSEVEN) {
            if (pdType == VALUE_ONE || pdType == VALUE_THREE) {
                that.openLandCalculation(tempCnt, docType);
            }
            if (pdType == VALUE_TWO || pdType == VALUE_THREE) {
                that.constructedPropertyCalculation(tempCnt, docType);
            }
        }
    },
    openLandCalculation: function (tempCnt, docType) {
        var that = this;
        if (docType != VALUE_TWENTYSEVEN) {
            var mainArea = $('#ol_main_area_for_drsfour_' + tempCnt).val();
            var subArea = $('#ol_sub_area_for_drsfour_' + tempCnt).val();
            var purpose = $('#ol_purpose_for_drsfour_' + tempCnt).val();
            var landArea = parseFloat($('#ol_land_area_for_drsfour_' + tempCnt).val());
            if (!mainArea || !subArea || !purpose || !landArea) {
                that.totalSDRFC();
                return false;
            }
            var tempPDT = tempPMVCR[VALUE_ONE] ? tempPMVCR[VALUE_ONE] : [];
            var tempSA = tempPDT[subArea] ? tempPDT[subArea] : [];
            var pmvCR = tempSA[purpose] ? tempSA[purpose] : VALUE_ZERO;
            var acCR = Math.round(pmvCR * landArea);
            $('#land_dca_auto_for_drsfour_' + tempCnt).html(acCR);
            $('#land_auto_con_amount_drsfour_' + tempCnt).val(acCR);
            that.SDRFCalculation('land', docType, tempCnt, acCR);
        }
    },
    constructedPropertyCalculation: function (tempCnt, docType) {
        var that = this;
        if (docType != VALUE_TWENTYSEVEN) {
            var propertyType = $('#cp_property_type_for_drsfour_' + tempCnt).val();
            var cc = $('#cp_cc_for_drsfour_' + tempCnt).val();
            var ageCD = $('#cp_age_cd_for_drsfour_' + tempCnt).val();
            var consArea = parseFloat($('#cp_constructed_area_for_drsfour_' + tempCnt).val());
            var cpHeightAbove = parseFloat($('#cp_height_above_for_drsfour_' + tempCnt).val());
            if (!propertyType || !cc || !ageCD || !consArea) {
                that.totalSDRFC();
                return false;
            }
            var drMF = DRMFArray[ageCD] ? DRMFArray[ageCD] : [];
            var tempPDT = tempPMVCR[VALUE_TWO] ? tempPMVCR[VALUE_TWO] : [];
            var tempPT = tempPDT[propertyType] ? tempPDT[propertyType] : [];
            var pmvCC = tempPT[cc] ? tempPT[cc] : VALUE_ZERO;
            var acCR = Math.round((pmvCC * (drMF.mf ? drMF.mf : VALUE_ZERO)) * consArea);
            $('#cp_dca_auto_for_drsfour_' + tempCnt).html(acCR);
            $('#cp_auto_con_amount_drsfour_' + tempCnt).val(acCR);
            that.SDRFCalculation('cp', docType, tempCnt, acCR, propertyType, cc, cpHeightAbove);
        }
    },
    SDRFCalculation: function (moduleType, docType, tempCnt, acCR, propertyType, cc, cpHeightAbove) {
        var that = this;
        if (docType != VALUE_TWENTYSEVEN) {
            var ownerShipType = $('#ownership_type_for_drsfour').val();
            if (ownerShipType == VALUE_ONE || ownerShipType == VALUE_TWO ||
                    ownerShipType == VALUE_THREE || ownerShipType == VALUE_FOUR ||
                    ownerShipType == VALUE_FIVE || ownerShipType == VALUE_SIX) {
                var tDT = docTypeCPArray[docType] ? docTypeCPArray[docType] : [];
                var sdCD = tDT[ownerShipType] ? tDT[ownerShipType] : [];
                if (sdCD.length != VALUE_ZERO) {
                    if (moduleType == 'cp') {
                        that.loadSDRFC(moduleType, docType, sdCD, tempCnt, acCR, ownerShipType, propertyType, cc, cpHeightAbove);
                    } else {
                        that.loadSDRFC(moduleType, docType, sdCD, tempCnt, acCR);
                    }
                }
            }
            if (moduleType == 'land' || moduleType == 'cp') {
                that.totalSDRFC();
            }
        }
    },
    totalSDRFC: function () {
        $('.null-hidden-amount-total').val(VALUE_ZERO);
        var totalACD = VALUE_ZERO;
        var totalASD = VALUE_ZERO;
        var totalARF = VALUE_ZERO;
        $('.property_details_for_drsfour').each(function () {
            var thatOPD = $(this);
            var tempMT = thatOPD.find('.temp_opd_drsfour_cnt').val();
            var pdType = $('input[name="pd_type_for_drsfour_' + tempMT + '"]:checked').val();
            if (pdType == VALUE_ONE || pdType == VALUE_THREE) {
                totalACD += parseInt($('#land_auto_con_amount_drsfour_' + tempMT).val()) ? parseInt($('#land_auto_con_amount_drsfour_' + tempMT).val()) : VALUE_ZERO;
                totalASD += parseInt($('#land_auto_sd_amount_drsfour_' + tempMT).val()) ? parseInt($('#land_auto_sd_amount_drsfour_' + tempMT).val()) : VALUE_ZERO;
                totalARF += parseInt($('#land_auto_rf_amount_drsfour_' + tempMT).val()) ? parseInt($('#land_auto_rf_amount_drsfour_' + tempMT).val()) : VALUE_ZERO;
            }
            if (pdType == VALUE_TWO || pdType == VALUE_THREE) {
                totalACD += parseInt($('#cp_auto_con_amount_drsfour_' + tempMT).val()) ? parseInt($('#cp_auto_con_amount_drsfour_' + tempMT).val()) : VALUE_ZERO;
                totalASD += parseInt($('#cp_auto_sd_amount_drsfour_' + tempMT).val()) ? parseInt($('#cp_auto_sd_amount_drsfour_' + tempMT).val()) : VALUE_ZERO;
                totalARF += parseInt($('#cp_auto_rf_amount_drsfour_' + tempMT).val()) ? parseInt($('#cp_auto_rf_amount_drsfour_' + tempMT).val()) : VALUE_ZERO;
            }
        });
        $('#total_dca_auto_for_drsfour').html(totalACD);
        $('#total_dsd_auto_for_drsfour').html(totalASD);
        $('#total_drf_auto_for_drsfour').html(totalARF);

        $('#total_auto_ca_amount_drsfour').val(totalACD);
        $('#total_auto_sd_amount_drsfour').val(totalASD);
        $('#total_auto_rf_amount_drsfour').val(totalARF);
    },
    loadSDRFC: function (moduleType, docType, sdCD, tempCnt, acCR, ownershipType, cpPropertyType, cpCC, cpHeightAbove) {
        if (docType != VALUE_TWENTYSEVEN) {
            var rfAuto = VALUE_ZERO;
//                var sdExemption = $('#sd_exemption_for_drsfour_' + tempCnt).val();
//                if (typeof sdExemption == "undefined") {
//                    sdExemption = '';
//                }
//                if (typeof sdCD.ex_type == "undefined") {
//                    sdCD.ex_type = '';
//                }
            if (sdCD.sd_rf_type == VALUE_ONE || sdCD.sd_rf_type == VALUE_TWO || sdCD.sd_rf_type == VALUE_THREE) {
//                    if ($.inArray(docType, isAllowExemptionArray) != -1 && sdExemption != '') {
//                        if (sdCD.ex_type == VALUE_ONE) {
//                            $('.' + moduleType + '_dsd_per_for_drsfour_' + tempCnt).html('Exemption ' + sdCD.sd_ex + '%');
//                            var sdExe = sdCD.sd_ex != VALUE_ZERO ? Math.round((sdCD.sd_ex * acCR) / 100) : VALUE_ZERO;
//                            $('#' + moduleType + '_dsd_auto_for_drsfour_' + tempCnt).html(sdExe);
//                            $('#' + moduleType + '_auto_sd_amount_drsfour_' + tempCnt).val(sdExe);
//
//                            $('.' + moduleType + '_drf_per_for_drsfour_' + tempCnt).html('Exemption ' + sdCD.rf_ex + '%');
//                            var rfExe = sdCD.rf_ex != VALUE_ZERO ? Math.round((sdCD.rf_ex * acCR) / 100) : VALUE_ZERO;
//                            $('#' + moduleType + '_drf_auto_for_drsfour_' + tempCnt).html(rfExe);
//                            $('#' + moduleType + '_auto_rf_amount_drsfour_' + tempCnt).val(rfExe);
//                        }
//                    } else if (sdExemption == '' || !sdExemption) {
                $('.' + moduleType + '_dsd_per_for_drsfour_' + tempCnt).html(sdCD.sd + '%');
                var sdAuto = Math.round((sdCD.sd * acCR) / 100);
                $('#' + moduleType + '_dsd_auto_for_drsfour_' + tempCnt).html(sdAuto);
                if (moduleType != 'total') {
                    $('#' + moduleType + '_auto_sd_amount_drsfour_' + tempCnt).val(sdAuto);
                }
                if (sdCD.sd_rf_type == VALUE_ONE) {
                    $('.' + moduleType + '_drf_per_for_drsfour_' + tempCnt).html(sdCD.rf + '%');
                    rfAuto = ((sdCD.rf * acCR) / 100);
                }
                if (sdCD.sd_rf_type == VALUE_TWO) {
                    $('.' + moduleType + '_drf_per_for_drsfour_' + tempCnt).html('Rs. ' + sdCD.rf);
                    rfAuto = sdCD.rf;
                }
                if (sdCD.sd_rf_type == VALUE_THREE) {
                    $('.' + moduleType + '_drf_per_for_drsfour_' + tempCnt).html(sdCD.rf + '% + Other Amount');
                    rfAuto = ((sdCD.rf * acCR) / 100) + (parseInt(sdCD.o_rf) ? parseInt(sdCD.o_rf) : VALUE_ZERO);
                }
//                    }
            }
            if (sdCD.sd_rf_type == VALUE_FOUR || sdCD.sd_rf_type == VALUE_FIVE) {
//                    if ($.inArray(docType, isAllowExemptionArray) != -1 && sdExemption != '') {
//                        $('.' + moduleType + '_dsd_per_for_drsfour_' + tempCnt).html('Exemption');
//                        $('#' + moduleType + '_dsd_auto_for_drsfour_' + tempCnt).html(VALUE_ZERO);
//                        $('#' + moduleType + '_auto_sd_amount_drsfour_' + tempCnt).val(VALUE_ZERO);
//                    } else if (sdExemption == '' || !sdExemption) {
                $('.' + moduleType + '_dsd_per_for_drsfour_' + tempCnt).html('Rs.' + sdCD.sd);
                var sdBoth = Math.round(sdCD.sd);
                $('#' + moduleType + '_dsd_auto_for_drsfour_' + tempCnt).html(sdBoth);
                if (moduleType != 'total') {
                    $('#' + moduleType + '_auto_sd_amount_drsfour_' + tempCnt).val(sdBoth);
                }
//                    }
            }
            if (sdCD.sd_rf_type == VALUE_FOUR) {
                $('.' + moduleType + '_drf_per_for_drsfour_' + tempCnt).html('Rs.' + sdCD.rf);
                rfAuto = sdCD.rf;
            }
            if (sdCD.sd_rf_type == VALUE_FIVE) {
                $('.' + moduleType + '_drf_per_for_drsfour_' + tempCnt).html('Rs.' + sdCD.rf);
                rfAuto = sdCD.rf;
                if (ownershipType == VALUE_TWO || ownershipType == VALUE_THREE || ownershipType == VALUE_FOUR ||
                        ownershipType == VALUE_FIVE || ownershipType == VALUE_SIX) {
                    if (moduleType == 'cp' && ((cpPropertyType == VALUE_FIVE && cpCC == VALUE_FIVE) ||
                            (cpPropertyType == VALUE_NINE && cpCC == VALUE_EIGHTEEN))) {
                        var heightAbove = parseFloat(cpHeightAbove) ? Math.ceil(parseFloat(cpHeightAbove)) : VALUE_ZERO;
                        if (heightAbove >= 16) {
                            var fHeight = (heightAbove - 16) * 50;
                            rfAuto += fHeight;
                        }
                    }
                }
                $('#' + moduleType + '_drf_auto_for_drsfour_' + tempCnt).html(Math.round(rfAuto));
                if (moduleType != 'total') {
                    $('#' + moduleType + '_auto_rf_amount_drsfour_' + tempCnt).val(Math.round(rfAuto));
                }
            }
            if (sdCD.sd_rf_type == VALUE_ONE || sdCD.sd_rf_type == VALUE_TWO || sdCD.sd_rf_type == VALUE_THREE || sdCD.sd_rf_type == VALUE_FOUR) {
//                    if (sdExemption == '' || !sdExemption) {
                if (ownershipType == VALUE_TWO || ownershipType == VALUE_THREE || ownershipType == VALUE_FOUR ||
                        ownershipType == VALUE_FIVE || ownershipType == VALUE_SIX) {
                    if (moduleType == 'cp' && ((cpPropertyType == VALUE_FIVE && cpCC == VALUE_FIVE) ||
                            (cpPropertyType == VALUE_NINE && cpCC == VALUE_EIGHTEEN))) {
                        var heightAbove = parseFloat(cpHeightAbove) ? Math.ceil(parseFloat(cpHeightAbove)) : VALUE_ZERO;
                        if (heightAbove >= 16) {
                            var fHeight = (heightAbove - 16) * 50;
                            rfAuto += fHeight;
                        }
                    }
                }
                $('#' + moduleType + '_drf_auto_for_drsfour_' + tempCnt).html(Math.round(rfAuto));
                if (moduleType != 'total') {
                    $('#' + moduleType + '_auto_rf_amount_drsfour_' + tempCnt).val(Math.round(rfAuto));
                }
//                    }
            }
        }
    },
    villSCChangeEvent: function (obj, tempCnt) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!tempCnt || tempCnt == null) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'ld_srv_pts_gtw_for_drsfour_' + tempCnt);
        renderOptionsForTwoDimensionalArray([], 'ld_sd_cl_pt_for_drsfour_' + tempCnt);
        $('#ld_srv_pts_gtw_for_drsfour_' + tempCnt).val('');
        $('#ld_sd_cl_pt_for_drsfour_' + tempCnt).val('');
        var formData = {};
        var district = $('#district_for_dr').val();
        if (district != VALUE_ONE && district != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        formData.district_for_ror = district;
        var ldType = $('input[name=ld_type_for_drsfour_' + tempCnt + ']:checked').val();
        if (ldType != VALUE_ONE && ldType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        formData.type_for_ror = ldType;
        if (ldType == VALUE_TWO) {
            var ldAreaType = $('input[name=ld_area_type_for_drsfour_' + tempCnt + ']:checked').val();
            if (ldAreaType != VALUE_ONE && ldAreaType != VALUE_TWO) {
                showError(invalidAccessValidationMessage);
                return false;
            }
            formData.area_type_for_ror = ldAreaType;
        }
        var villSc = obj.val();
        if (!villSc) {
            return false;
        }
        formData.village_for_ror = villSc;
        addTagSpinner('ld_srv_pts_gtw_for_drsfour_' + tempCnt);
        $.ajax({
            url: 'utility/get_survey_data_by_district',
            type: 'post',
            data: formData,
            error: function (textStatus, errorThrown) {
                removeTagSpinner();
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
                var parseData = JSON.parse(response);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                if (parseData.success === false) {
                    removeTagSpinner();
                    showError(parseData.message);
                    return false;
                }
                var surveyData = parseData.survey_data;
                if (district == VALUE_ONE && ldType == VALUE_ONE) {
                    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForLand(surveyData, 'ld_srv_pts_gtw_for_drsfour_' + tempCnt, 'survey', 'survey');
                }
                if (district == VALUE_ONE && ldType == VALUE_TWO) {
                    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForLand(surveyData, 'ld_srv_pts_gtw_for_drsfour_' + tempCnt, 'pts_gtw', 'pts_gtw');
                }
                removeTagSpinner();
            }
        });
    },
    srvPtsGtwChangeEvent: function (obj, tempCnt) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!tempCnt || tempCnt == null) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'ld_sd_cl_pt_for_drsfour_' + tempCnt);
        $('#ld_sd_cl_pt_for_drsfour_' + tempCnt).val('');
        var formData = {};
        var district = $('#district_for_dr').val();
        if (district != VALUE_ONE && district != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        formData.district_for_ror = district;
        var ldType = $('input[name=ld_type_for_drsfour_' + tempCnt + ']:checked').val();
        if (ldType != VALUE_ONE && ldType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        formData.type_for_ror = ldType;
        if (ldType == VALUE_TWO) {
            var ldAreaType = $('input[name=ld_area_type_for_drsfour_' + tempCnt + ']:checked').val();
            if (ldAreaType != VALUE_ONE && ldAreaType != VALUE_TWO) {
                showError(invalidAccessValidationMessage);
                return false;
            }
            formData.area_type_for_ror = ldAreaType;
        }
        var villSc = $('#ld_village_sc_for_drsfour_' + tempCnt).val();
        if (!villSc) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        formData.village_for_ror = villSc;
        var survey = obj.val();
        if (!survey) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        formData.survey_for_ror = survey;
        addTagSpinner('ld_sd_cl_pt_for_drsfour_' + tempCnt);
        $.ajax({
            url: 'utility/get_subdiv_data_by_district',
            type: 'post',
            data: formData,
            error: function (textStatus, errorThrown) {
                removeTagSpinner();
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
                var parseData = JSON.parse(response);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                if (parseData.success === false) {
                    removeTagSpinner();
                    showError(parseData.message);
                    return false;
                }
                var subdivData = parseData.subdiv_data;
                if (district == VALUE_ONE && ldType == VALUE_ONE) {
                    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(subdivData, 'ld_sd_cl_pt_for_drsfour_' + tempCnt, 'subdiv', 'subdiv');
                }
                if (district == VALUE_ONE && ldType == VALUE_TWO) {
                    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(subdivData, 'ld_sd_cl_pt_for_drsfour_' + tempCnt, 'cl_pt', 'cl_pt');
                }
                removeTagSpinner();
            }
        });
    },
    askForSubmitDRSFour: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var documentRegistrationId = $('#document_registration_id_for_dr').val();
        if (!documentRegistrationId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'DocumentRegistration.listview.submitDRSFour(' + VALUE_TWO + ')';
        showConfirmation(yesEvent, 'Submit');
    },
    checkValidationForPD: function (partyData, tPDCnt) {
        if (!partyData['pd_type_for_drsfour_' + tPDCnt]) {
            $('#pd_type_for_drsfour_' + tPDCnt + '_1').focus();
            return getBasicMessageAndFieldJSONArray('pd_type_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
        }
        if (partyData['pd_type_for_drsfour_' + tPDCnt] != VALUE_ONE && partyData['pd_type_for_drsfour_' + tPDCnt] != VALUE_TWO &&
                partyData['pd_type_for_drsfour_' + tPDCnt] != VALUE_THREE) {
            $('#pd_type_for_drsfour_' + tPDCnt + '_1').focus();
            return getBasicMessageAndFieldJSONArray('pd_type_for_drsfour_' + tPDCnt, invalidAccessValidationMessage);
        }
        if (partyData['pd_type_for_drsfour_' + tPDCnt] == VALUE_ONE || partyData['pd_type_for_drsfour_' + tPDCnt] == VALUE_THREE) {
            if (!partyData['ol_main_area_for_drsfour_' + tPDCnt]) {
                return getBasicMessageAndFieldJSONArray('ol_main_area_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
            }
            if (!partyData['ol_sub_area_for_drsfour_' + tPDCnt]) {
                return getBasicMessageAndFieldJSONArray('ol_sub_area_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
            }
            if (!partyData['ol_purpose_for_drsfour_' + tPDCnt]) {
                return getBasicMessageAndFieldJSONArray('ol_purpose_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
            }
            if (!partyData['ol_land_area_for_drsfour_' + tPDCnt]) {
                return getBasicMessageAndFieldJSONArray('ol_land_area_for_drsfour_' + tPDCnt, landAreaValidationMessage);
            }
        }
        if (partyData['pd_type_for_drsfour_' + tPDCnt] == VALUE_TWO || partyData['pd_type_for_drsfour_' + tPDCnt] == VALUE_THREE) {
            if (!partyData['cp_property_type_for_drsfour_' + tPDCnt]) {
                return getBasicMessageAndFieldJSONArray('cp_property_type_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
            }
            if (!partyData['cp_cc_for_drsfour_' + tPDCnt]) {
                return getBasicMessageAndFieldJSONArray('cp_cc_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
            }

            if ((partyData['cp_property_type_for_drsfour_' + tPDCnt] == VALUE_FIVE && partyData['cp_cc_for_drsfour_' + tPDCnt] == VALUE_FIVE) ||
                    (partyData['cp_property_type_for_drsfour_' + tPDCnt] == VALUE_NINE && partyData['cp_cc_for_drsfour_' + tPDCnt] == VALUE_EIGHTEEN)) {
                var cpHeightAbove = parseFloat(partyData['cp_height_above_for_drsfour_' + tPDCnt]) ? parseFloat(partyData['cp_height_above_for_drsfour_' + tPDCnt]) : VALUE_ZERO;
                if (!cpHeightAbove) {
                    return getBasicMessageAndFieldJSONArray('cp_height_above_for_drsfour_' + tPDCnt, heightValidationMessage);
                }
                if (cpHeightAbove < 16) {
                    return getBasicMessageAndFieldJSONArray('cp_height_above_for_drsfour_' + tPDCnt, heightAboveValidationMessage);
                }
            }
            if (!partyData['cp_age_cd_for_drsfour_' + tPDCnt]) {
                return getBasicMessageAndFieldJSONArray('cp_age_cd_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
            }
            if (!partyData['cp_constructed_area_for_drsfour_' + tPDCnt]) {
                return getBasicMessageAndFieldJSONArray('cp_constructed_area_for_drsfour_' + tPDCnt, landAreaValidationMessage);
            }
        }
        if (!partyData['ld_type_for_drsfour_' + tPDCnt]) {
            $('#ld_type_for_drsfour_' + tPDCnt + '_1').focus();
            return getBasicMessageAndFieldJSONArray('ld_type_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
        }
        if (partyData['ld_type_for_drsfour_' + tPDCnt] != VALUE_ONE && partyData['ld_type_for_drsfour_' + tPDCnt] != VALUE_TWO) {
            $('#ld_type_for_drsfour_' + tPDCnt + '_1').focus();
            return getBasicMessageAndFieldJSONArray('ld_type_for_drsfour_' + tPDCnt, invalidAccessValidationMessage);
        }
        if (partyData['ld_type_for_drsfour_' + tPDCnt] == VALUE_TWO) {
            if (!partyData['ld_area_type_for_drsfour_' + tPDCnt]) {
                $('#ld_area_type_for_drsfour_' + tPDCnt + '_1').focus();
                return getBasicMessageAndFieldJSONArray('ld_area_type_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
            }
            if (partyData['ld_area_type_for_drsfour_' + tPDCnt] != VALUE_ONE && partyData['ld_area_type_for_drsfour_' + tPDCnt] != VALUE_TWO) {
                $('#ld_area_type_for_drsfour_' + tPDCnt + '_1').focus();
                return getBasicMessageAndFieldJSONArray('ld_area_type_for_drsfour_' + tPDCnt, invalidAccessValidationMessage);
            }
        }
        if (!partyData['ld_village_sc_for_drsfour_' + tPDCnt]) {
            return getBasicMessageAndFieldJSONArray('ld_village_sc_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
        }
        if (!partyData['ld_srv_pts_gtw_for_drsfour_' + tPDCnt]) {
            return getBasicMessageAndFieldJSONArray('ld_srv_pts_gtw_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
        }
        if (!partyData['ld_sd_cl_pt_for_drsfour_' + tPDCnt]) {
            return getBasicMessageAndFieldJSONArray('ld_sd_cl_pt_for_drsfour_' + tPDCnt, oneOptionValidationMessage);
        }
        return '';
    },
    submitDRSFour: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var documentRegistrationId = $('#document_registration_id_for_dr').val();
        var docType = parseInt($('#doc_type_for_dr').val());
        var propertyDetailsStatus = $('input[name="property_details_status_for_drsfour"]:checked').val();
        if (!propertyDetailsStatus) {
            $('#property_details_status_for_drsfour_1').focus();
            validationMessageShow('drsfour-property_details_status_for_drsfour', oneOptionValidationMessage);
            return false;
        }
        if (!documentRegistrationId || !docType || (propertyDetailsStatus != VALUE_ONE && propertyDetailsStatus != VALUE_TWO)) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var DRSFourData = {};
        DRSFourData.document_registration_id = documentRegistrationId;
        DRSFourData.module_type = moduleType;
        DRSFourData.property_details_status = propertyDetailsStatus;
        DRSFourData.ownership_type = $('#ownership_type_for_drsfour').val();
        if (DRSFourData.ownership_type != VALUE_ONE && DRSFourData.ownership_type != VALUE_TWO &&
                DRSFourData.ownership_type != VALUE_THREE && DRSFourData.ownership_type != VALUE_FOUR &&
                DRSFourData.ownership_type != VALUE_FIVE && DRSFourData.ownership_type != VALUE_SIX) {
            $('#ownership_type_for_drsfour').focus();
            validationMessageShow('drsfour-ownership_type_for_drsfour', oneOptionValidationMessage);
            return false;
        }
        if (DRSFourData.property_details_status == VALUE_TWO) {
            DRSFourData.total_stamp_duty = $('#other_auto_sd_amount_drsfour_oth').val();
            DRSFourData.total_registration_fee = $('#other_auto_rf_amount_drsfour_oth').val();
        }
        if (DRSFourData.property_details_status == VALUE_ONE) {
            DRSFourData.total_consideration_amount = $('#total_auto_ca_amount_drsfour').val();
            DRSFourData.total_stamp_duty = $('#total_auto_sd_amount_drsfour').val();
            DRSFourData.total_registration_fee = $('#total_auto_rf_amount_drsfour').val();

            var pdCnt = 1;
            var newPDItems = [];
            var exiPDItems = [];
            var isPDItemValidation;
            var formData = {};
            var validationData = '';
            var opdItem = {};
            $('.property_details_for_drsfour').each(function () {
                var thatOPD = $(this);
                var tPDCnt = thatOPD.find('.temp_opd_drsfour_cnt').val();
                if (tPDCnt == '' || tPDCnt == null) {
                    showError(invalidAccessValidationMessage);
                    isPDItemValidation = true;
                    return false;
                }
                formData = $('#drsfour_form_' + tPDCnt).serializeFormJSON();
                validationData = that.checkValidationForPD(formData, tPDCnt);
                if (validationData != '') {
                    if ($("#property_main_details_for_drsfour_" + tPDCnt).hasClass("collapsed-card")) {
                        $('#property_main_details_hs_btn_for_drsfour_' + tPDCnt).click();
                    }
                    $('#' + validationData.field).focus();
                    validationMessageShow('drsfour' + '-' + validationData.field, validationData.message);
                    isPDItemValidation = true;
                    return false;
                }
                opdItem = {};
                opdItem.land_auto_con = VALUE_ZERO;
                opdItem.land_auto_sd = VALUE_ZERO;
                opdItem.land_auto_rf = VALUE_ZERO;
                opdItem.cp_auto_co = VALUE_ZERO;
                opdItem.cp_auto_sd = VALUE_ZERO;
                opdItem.cp_auto_rf = VALUE_ZERO;
                opdItem.ol_main_area = '';
                opdItem.ol_sub_area = '';
                opdItem.ol_purpose = '';
                opdItem.ol_land_area = '';
                opdItem.cp_property_type = '';
                opdItem.cp_cc = '';
                opdItem.cp_age_cd = '';
                opdItem.cp_constructed_area = '';
                opdItem.pd_type = formData['pd_type_for_drsfour_' + tPDCnt];
                if (opdItem.pd_type == VALUE_ONE || opdItem.pd_type == VALUE_THREE) {
                    opdItem.land_auto_con = $('#land_auto_con_amount_drsfour_' + tPDCnt).val();
                    opdItem.land_auto_sd = $('#land_auto_sd_amount_drsfour_' + tPDCnt).val();
                    opdItem.land_auto_rf = $('#land_auto_rf_amount_drsfour_' + tPDCnt).val();

                    opdItem.ol_main_area = formData['ol_main_area_for_drsfour_' + tPDCnt];
                    opdItem.ol_sub_area = formData['ol_sub_area_for_drsfour_' + tPDCnt];
                    opdItem.ol_purpose = formData['ol_purpose_for_drsfour_' + tPDCnt];
                    opdItem.ol_land_area = formData['ol_land_area_for_drsfour_' + tPDCnt];
                }
                if (opdItem.pd_type == VALUE_TWO || opdItem.pd_type == VALUE_THREE) {
                    opdItem.cp_auto_co = $('#cp_auto_con_amount_drsfour_' + tPDCnt).val();
                    opdItem.cp_auto_sd = $('#cp_auto_sd_amount_drsfour_' + tPDCnt).val();
                    opdItem.cp_auto_rf = $('#cp_auto_rf_amount_drsfour_' + tPDCnt).val();

                    opdItem.cp_property_type = formData['cp_property_type_for_drsfour_' + tPDCnt];
                    opdItem.cp_cc = formData['cp_cc_for_drsfour_' + tPDCnt];
                    opdItem.cp_height_above = formData['cp_height_above_for_drsfour_' + tPDCnt];
                    opdItem.cp_age_cd = formData['cp_age_cd_for_drsfour_' + tPDCnt];
                    opdItem.cp_constructed_area = formData['cp_constructed_area_for_drsfour_' + tPDCnt];
                }
                opdItem.ld_type = formData['ld_type_for_drsfour_' + tPDCnt];
                opdItem.ld_area_type = opdItem.ld_type == VALUE_TWO ? formData['ld_area_type_for_drsfour_' + tPDCnt] : VALUE_ZERO;
                opdItem.ld_village_sc = formData['ld_village_sc_for_drsfour_' + tPDCnt];
                opdItem.ld_srv_pts_gtw = formData['ld_srv_pts_gtw_for_drsfour_' + tPDCnt];
                opdItem.ld_sd_cl_pt = formData['ld_sd_cl_pt_for_drsfour_' + tPDCnt];
                opdItem.ld_ownership_details = formData['ld_ownership_details_for_drsfour_' + tPDCnt];
                opdItem.ld_ulpin = formData['ld_ulpin_for_drsfour_' + tPDCnt];
                opdItem.ld_latitude = formData['ld_latitude_for_drsfour_' + tPDCnt];
                opdItem.ld_longitude = formData['ld_longitude_for_drsfour_' + tPDCnt];
                opdItem.ld_nsew_details = formData['ld_nsew_details_for_drsfour_' + tPDCnt];
                opdItem.ld_pds_details = formData['ld_pds_details_for_drsfour_' + tPDCnt];
                if (opdItem.pd_type == VALUE_TWO || opdItem.pd_type == VALUE_THREE) {
                    opdItem.pd_property_number = formData['pd_property_number_for_drsfour_' + tPDCnt];
                    opdItem.pd_ulpin = formData['pd_ulpin_for_drsfour_' + tPDCnt];
                    opdItem.pd_latitude = formData['pd_latitude_for_drsfour_' + tPDCnt];
                    opdItem.pd_longitude = formData['pd_longitude_for_drsfour_' + tPDCnt];
                    opdItem.pd_nsew_details = formData['pd_nsew_details_for_drsfour_' + tPDCnt];
                    opdItem.pd_pds_details = formData['pd_pds_details_for_drsfour_' + tPDCnt];
                }
                if (!formData['dr_property_details_id_for_drsfour_' + tPDCnt] || formData['dr_property_details_id_for_drsfour_' + tPDCnt] == null) {
                    newPDItems.push(opdItem);
                } else {
                    opdItem.dr_property_details_id = formData['dr_property_details_id_for_drsfour_' + tPDCnt];
                    exiPDItems.push(opdItem);
                }
                pdCnt++;
            });
            if (isPDItemValidation) {
                return false;
            }
            if (pdCnt == VALUE_ONE) {
                showError(onePDValidationMessage);
                return false;
            }
            DRSFourData.new_dr_pd_items = newPDItems;
            DRSFourData.exi_dr_pd_items = exiPDItems;
        }
        var tDT = docTypeCPArray[docType] ? docTypeCPArray[docType] : [];
        if (docType == VALUE_TWENTYSEVEN) {
            var leasePeriod = $('#lease_period_for_dr').val();
            DRSFourData.total_calculation = tDT[leasePeriod] ? tDT[leasePeriod] : '';
        } else {
            DRSFourData.total_calculation = tDT[DRSFourData.ownership_type] ? tDT[DRSFourData.ownership_type] : '';
        }
        if (moduleType == VALUE_THREE) {
            that.askForSubmitDRSFour();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }

        var btnObj = moduleType == VALUE_ONE ? $('.draft_btn_for_drsfour') : $('.submit_btn_for_drsfour');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'document_registration/submit_step_four',
            data: $.extend({}, DRSFourData, getTokenData()),
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
                that.listPage();
                showSuccess(parseData.message);
            }
        });
    },
    viewDocumentRegistrationDetails: function (moduleType, drData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        var district = drData.district;
        drData.application_datetime_text = drData.application_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(drData.application_datetime) : '';
        drData.submitted_datetime_text = drData.submitted_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(drData.submitted_datetime) : '';
        drData.district_text = talukaArray[district] ? talukaArray[district] : '';
        drData.doc_language_text = docLanguageArray[drData.doc_language] ? docLanguageArray[drData.doc_language] : '';
        drData.doc_type_text = docTypeArray[drData.doc_type] ? docTypeArray[drData.doc_type] : '';
        drData.fee_exemption_text = feeExemptionArray[drData.fee_exemption] ? feeExemptionArray[drData.fee_exemption] : '';
        drData.doc_execution_date_text = drData.doc_execution_date != '0000-00-00' ? dateTo_DD_MM_YYYY(drData.doc_execution_date) : '';
        drData.dpe_type_text = drDPETypeArray[drData.dpe_type] ? drDPETypeArray[drData.dpe_type] : '';
        if (drData.dpe_type == VALUE_ONE) {
            drData.show_within_india = true;
            drData.dpe_state_text = tempStateData[drData.dpe_state] ? tempStateData[drData.dpe_state]['state_name'] : '';
            var allDistData = tempDistrictData[drData.dpe_state] ? tempDistrictData[drData.dpe_state] : '';
            drData.dpe_district_text = allDistData[drData.dpe_district] ? allDistData[drData.dpe_district]['district_name'] : '';
        }
        if (drData.dpe_type == VALUE_TWO) {
            drData.show_outside_india = true;
        }
        drData.property_details_status_text = feeExemptionArray[drData.property_details_status] ? feeExemptionArray[drData.property_details_status] : '';
        drData.ownership_type_text = DROwnershipTypeArray[drData.ownership_type] ? DROwnershipTypeArray[drData.ownership_type] : '';
        if (moduleType == VALUE_FIVE && drData.is_verified_doc == VALUE_ZERO && drData.is_verified_app == VALUE_ZERO &&
                (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_VER_USER)) {
            drData.show_verify_btn = true;
            drData.show_enter_remarks = true;
        }
        if (moduleType == VALUE_SEVEN && (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_USER) &&
                drData.is_verified_app == VALUE_ZERO) {
            drData.show_verify_app_btn = true;
            drData.show_enter_remarks = true;
        }
        if ((moduleType == VALUE_NINE) && (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_USER) &&
                drData.status != VALUE_FIVE && drData.status != VALUE_SIX &&
                (drData.query_status == VALUE_ZERO || drData.query_status == VALUE_THREE)) {
            drData.show_reject_btn = true;
            drData.show_enter_remarks = true;
            drData.show_declaration = true;
        }
        if (moduleType == VALUE_FOUR || moduleType == VALUE_SEVEN || moduleType == VALUE_EIGHT ||
                moduleType == VALUE_NINE) {
            if (drData.is_verified_doc == VALUE_ONE) {
                drData.show_verification_details = true;
                drData.verified_datetime_text = drData.verified_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(drData.verified_datetime) : '';
            }
            if (drData.is_verified_app == VALUE_ONE) {
                drData.show_verified_app_details = true;
                drData.verified_app_datetime_text = drData.verified_app_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(drData.verified_app_datetime) : '';
            }
            if (drData.status == VALUE_FIVE || drData.status == VALUE_SIX) {
                drData.show_approval_or_rejection_details = true;
                drData.status_text = getDRAppStatusString(drData.status);
                drData.status_datetime_text = drData.status_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(drData.status_datetime) : '';
            }
        }
        drData.title = 'View';
        if (moduleType == VALUE_FIVE) {
            drData.title = 'Verify';
        }
        if (moduleType == VALUE_SEVEN) {
            drData.title = 'Verify & Send to User for Appointment';
        }
        if (moduleType == VALUE_EIGHT) {
            drData.title = 'Approve';
        }
        if (moduleType == VALUE_NINE) {
            drData.title = 'Reject';
        }
        showPopup();
        $('.swal2-popup').css('width', '50em');
        $('#popup_container').html(documentRegistrationViewTemplate(drData));
        if (drData.doc_type == VALUE_TWENTYSEVEN) {
            drData.show_lease_details = true;
            drData.lease_period_text = leasePeriodArray[drData.lease_period] ? leasePeriodArray[drData.lease_period] : '';
        } else {
            drData.show_ca = true;
        }
        that.loadDRSOneView(drData);
        if (drData.dr_party_details) {
            that.loadDRPDView(drData.dr_party_details);
        }
        if (drData.property_details_status == VALUE_ONE) {
            if (drData.doc_type != VALUE_TWENTYSEVEN) {
                var consAmount = parseInt(drData.doc_consideration_amount) ? parseInt(drData.doc_consideration_amount) : VALUE_ZERO;
                if (consAmount != VALUE_ZERO) {
                    drData.show_total_of_entered_ca = true;
                }
            }
            $('#drsfour_main_container_for_view').html(drViewPDATemplate(drData));
            var sdCD = drData.total_calculation ? JSON.parse(drData.total_calculation) : [];
            if (sdCD.length != VALUE_ZERO) {
                if (drData.doc_type != VALUE_TWENTYSEVEN) {
                    sdCD.sd_rf_type = parseInt(sdCD.sd_rf_type) ? parseInt(sdCD.sd_rf_type) : VALUE_ZERO;
                    sdCD.sd = parseFloat(sdCD.sd) ? parseFloat(sdCD.sd) : VALUE_ZERO;
                    sdCD.rf = parseFloat(sdCD.rf) ? parseFloat(sdCD.rf) : VALUE_ZERO;
                    if (consAmount != VALUE_ZERO) {
                        that.loadSDRFC('total', drData.doc_type, sdCD, 'eca_view', consAmount);
                    }
                }
            }
            var tempCnt = VALUE_ONE;
            $.each(drData.dr_property_details, function (index, propertyDetails) {
                propertyDetails.temp_cnt = tempCnt;
                propertyDetails.total_calculation = sdCD;
                propertyDetails.doc_type = drData.doc_type;
                if (drData.doc_type != VALUE_TWENTYSEVEN) {
                    propertyDetails.show_ca = drData.show_ca;
                }
                that.loadPDAItemForView(drData.pmv_relation, propertyDetails, sdCD);
                tempCnt++;
            });
        }
        // Show For Map Initialize in Full Screen
        $('#custom-tabs-drsone-tab').click();
        if (drData.property_details_status == VALUE_TWO) {
            $('#drsfour_main_container_for_view').html(drViewPDNATemplate);
            var sdCD = drData.total_calculation ? JSON.parse(drData.total_calculation) : [];
            if (sdCD.length != VALUE_ZERO) {
                if (drData.doc_type != VALUE_TWENTYSEVEN) {
                    that.loadSDRFC('other', drData.doc_type, sdCD, 'oth_view', VALUE_ZERO);
                }
            }
        }
    },
    loadPDAItemForView: function (pmvRelation, propertyDetails, sdCD) {
        var that = this;
        propertyDetails.pd_type_text = DRMainPropertyTypeArray[propertyDetails.pd_type] ? DRMainPropertyTypeArray[propertyDetails.pd_type] : '';

        if (propertyDetails.pd_type == VALUE_ONE || propertyDetails.pd_type == VALUE_THREE) {
            propertyDetails.ol_main_area_text = damanCityArray[propertyDetails.ol_main_area] ? damanCityArray[propertyDetails.ol_main_area] : '';
            propertyDetails.ol_sub_area_text = pmvRelation[propertyDetails.ol_sub_area] ? pmvRelation[propertyDetails.ol_sub_area]['panchayat_name'] : '';
            var tpt = DRPropertyTypeArray[VALUE_ONE] ? DRPropertyTypeArray[VALUE_ONE] : [];
            propertyDetails.ol_purpose_text = tpt[propertyDetails.ol_purpose] ? tpt[propertyDetails.ol_purpose] : '';
            propertyDetails.show_ld = true;
        }
        if (propertyDetails.pd_type == VALUE_TWO || propertyDetails.pd_type == VALUE_THREE) {
            var tpt = DRPropertyTypeArray[VALUE_TWO] ? DRPropertyTypeArray[VALUE_TWO] : [];
            propertyDetails.cp_property_type_text = tpt[propertyDetails.cp_property_type] ? tpt[propertyDetails.cp_property_type] : '';
            var tcc = DRCCArray[propertyDetails.cp_property_type] ? DRCCArray[propertyDetails.cp_property_type] : [];
            propertyDetails.cp_cc_text = tcc[propertyDetails.cp_cc] ? tcc[propertyDetails.cp_cc] : '';
            propertyDetails.cp_age_cd_text = DRMFArray[propertyDetails.cp_age_cd] ? DRMFArray[propertyDetails.cp_age_cd]['building_age'] : '';
            propertyDetails.show_cp = true;
            if ((propertyDetails.cp_property_type == VALUE_FIVE && propertyDetails.cp_cc == VALUE_FIVE) ||
                    (propertyDetails.cp_property_type == VALUE_NINE && propertyDetails.cp_cc == VALUE_EIGHTEEN)) {
                propertyDetails.show_cp_height_above = true;
            }
            propertyDetails.pd_latitude = parseFloat(propertyDetails.pd_latitude);
            propertyDetails.pd_longitude = parseFloat(propertyDetails.pd_longitude);
            if (propertyDetails.pd_latitude != VALUE_ZERO || propertyDetails.pd_longitude != VALUE_ZERO) {
                propertyDetails.show_pd_map = true;
            }
        }
        propertyDetails.ld_type_text = propertyDetails.ld_type == VALUE_ONE ? 'Rural' : (propertyDetails.ld_type == VALUE_TWO ? ('Urban' + (propertyDetails.ld_area_type == VALUE_ONE ? ' : P.T. Sheet Wise Area' : (propertyDetails.ld_area_type == VALUE_TWO ? ' : Gauthan Wise Area' : ''))) : '');
        if (propertyDetails.ld_type == VALUE_ONE) {
            propertyDetails.ld_village_sc_title = 'Village';
            propertyDetails.ld_srv_pts_gtw_title = 'Survey Number';
            propertyDetails.ld_sd_cl_pt_title = 'Subdivision Number';
            propertyDetails.ld_village_sc_text = tempVillageData[propertyDetails.ld_village_sc] ? (tempVillageData[propertyDetails.ld_village_sc]['name'] + '(' + tempVillageData[propertyDetails.ld_village_sc]['devnagari'] + ')') : '';
        }
        if (propertyDetails.ld_type == VALUE_TWO && propertyDetails.ld_area_type == VALUE_ONE) {
            propertyDetails.ld_village_sc_title = 'Sub City';
            propertyDetails.ld_srv_pts_gtw_title = 'P.T. Sheet Number';
            propertyDetails.ld_sd_cl_pt_title = 'Chalta Number';
            propertyDetails.ld_village_sc_text = damanCityArray[propertyDetails.ld_village_sc] ? damanCityArray[propertyDetails.ld_village_sc] : '';
        }
        if (propertyDetails.ld_type == VALUE_TWO && propertyDetails.ld_area_type == VALUE_TWO) {
            propertyDetails.ld_village_sc_title = 'Village';
            propertyDetails.ld_srv_pts_gtw_title = 'Gauthan Wise Number';
            propertyDetails.ld_sd_cl_pt_title = 'Plot Number';
            propertyDetails.ld_village_sc_text = tempUVillageData[propertyDetails.ld_village_sc] ? tempUVillageData[propertyDetails.ld_village_sc]['name'] : '';
        }
        propertyDetails.ld_latitude = parseFloat(propertyDetails.ld_latitude);
        propertyDetails.ld_longitude = parseFloat(propertyDetails.ld_longitude);
        if (propertyDetails.ld_latitude != VALUE_ZERO || propertyDetails.ld_longitude != VALUE_ZERO) {
            propertyDetails.show_ld_map = true;
        }
        $('#drsfour_main_container_for_view').append(drViewPDAItemTemplate(propertyDetails));
        if (propertyDetails.pd_type == VALUE_ONE || propertyDetails.pd_type == VALUE_THREE) {
            that.loadSDRFC('land', propertyDetails.doc_type, sdCD, ('view_' + propertyDetails.temp_cnt), propertyDetails.land_auto_con);
        }
        if (propertyDetails.pd_type == VALUE_TWO || propertyDetails.pd_type == VALUE_THREE) {
            that.loadSDRFC('cp', propertyDetails.doc_type, sdCD, ('view_' + propertyDetails.temp_cnt), propertyDetails.cp_auto_co, propertyDetails.ownership_type, propertyDetails.cp_property_type, propertyDetails.cp_cc, propertyDetails.cp_height_above);
        }
        if (propertyDetails.show_ld_map) {
            var mapData = {};
            mapData.lat = propertyDetails.ld_latitude;
            mapData.lng = propertyDetails.ld_longitude;
            loadMap('ld_map_container_for_drsfour_view_' + propertyDetails.temp_cnt, '', '', mapData, false);
        }
        if (propertyDetails.show_pd_map) {
            var mapData = {};
            mapData.lat = propertyDetails.pd_latitude;
            mapData.lng = propertyDetails.pd_longitude;
            loadMap('pd_map_container_for_drsfour_view_' + propertyDetails.temp_cnt, '', '', mapData, false);
        }
    },
    loadDRPDView: function (drPartyDetails) {
        var that = this;
        var opdCnt = 1;
        var tempPDCnt = 1;
        $.each(drPartyDetails, function (index, drpd) {
            drpd.mt_cnt = tempPDCnt;
            if (drpd['party_type'] == VALUE_ONE) {
                drpd.mt_type = 'drstwo';
                drpd.show_bd_drstwo = true;
                drpd = that.getBDForPDView(drpd);
                $('#custom-tabs-' + drpd.mt_type).html(documentRegistrationViewPartyDetailsTemplate(drpd));
            }
            if (drpd['party_type'] == VALUE_TWO) {
                drpd.mt_type = 'drsthree';
                drpd.show_bd_drsthree = true;
                drpd.opd_cnt = opdCnt;
                drpd = that.getBDForPDView(drpd);
                $('#custom-tabs-' + drpd.mt_type).append(documentRegistrationViewPartyDetailsTemplate(drpd));
                opdCnt++;
            }
            that.setBDForPDView(drpd);
            tempPDCnt++;
        });
    },
    loadDRSOneView: function (drData) {
        var that = this;
        $('#custom-tabs-drsone').html(DRSOneViewTemplate(drData));
        if (drData.dr_documents) {
            $.each(drData.dr_documents, function (index, docDetail) {
                docDetail.cnt = (index + 1);
                $('#document_item_container_for_drsone_view').append(DRSOneViewDocItemTemplate(docDetail));
                if (docDetail['document'] != '') {
                    that.loadDocForView(docDetail.cnt, 'document', 'drsone', docDetail.document);
                }
            });
        }
    },
    getBDForPDView: function (drpd) {
        if (drpd.party_type == VALUE_ONE) {
            drpd.is_poa_holder_text = yesNoArray[drpd.is_poa_holder] ? yesNoArray[drpd.is_poa_holder] : '';
            if (drpd.is_poa_holder == VALUE_ONE) {
                drpd.show_poa_details = true;
                drpd.poa_type_text = drPOATypeArray[drpd.poa_type] ? drPOATypeArray[drpd.poa_type] : '';
                drpd.poa_execution_date_text = drpd.poa_execution_date != '0000-00-00' ? dateTo_DD_MM_YYYY(drpd.poa_execution_date) : '';
            }
        }
        drpd.party_state_text = tempStateData[drpd.party_state] ? tempStateData[drpd.party_state]['state_name'] : '';
        var allDistData = tempDistrictData[drpd.party_state] ? tempDistrictData[drpd.party_state] : '';
        drpd.party_district_text = allDistData[drpd.party_district] ? allDistData[drpd.party_district]['district_name'] : '';
        drpd.party_category_text = partyCategoryArray[drpd.party_category] ? partyCategoryArray[drpd.party_category] : '';
        drpd.party_description_text = partyDescriptionArray[drpd.party_description] ? partyDescriptionArray[drpd.party_description] : '';
        drpd.party_dob_year_text = drpd.party_birth_type == VALUE_ONE ? ((drpd.party_dob != '0000-00-00' && drpd.party_dob) ? dateTo_DD_MM_YYYY(drpd.party_dob) : '') :
                (drpd.party_birth_type == VALUE_TWO ? drpd.party_dob_year : (drpd.party_birth_type == VALUE_THREE ? drpd.party_age : ''));
        drpd.party_gender_text = genderArray[drpd.party_gender] ? genderArray[drpd.party_gender] : '';
        drpd.party_religion_text = religionArray[drpd.party_religion] ? religionArray[drpd.party_religion] : '';
        drpd.party_occupation_text = drOccupationArray[drpd.party_occupation] ? drOccupationArray[drpd.party_occupation] : '';
        if (drpd.party_pan_type == VALUE_ONE) {
            drpd.show_pan_details = true;
        }
        if (drpd.party_pan_type == VALUE_TWO) {
            drpd.show_form60_details = true;
        }
        return drpd;
    },
    setBDForPDView: function (drpd) {
        var that = this;
        if (drpd.party_type == VALUE_ONE && drpd.is_poa_holder == VALUE_ONE) {
            if (drpd.poa_doc) {
                that.loadDocForView('', 'poa_doc', drpd.mt_type, drpd.poa_doc);
            }
        }
        if (drpd.party_pan_type == VALUE_ONE) {
            if (drpd.party_pan_doc) {
                that.loadDocForView(drpd.mt_cnt, 'party_pan_doc', drpd.mt_type, drpd.party_pan_doc);
            }
        }
        if (drpd.party_pan_type == VALUE_TWO) {
            if (drpd.party_form_sixteen) {
                that.loadDocForView(drpd.mt_cnt, 'party_form_sixteen', drpd.mt_type, drpd.party_form_sixteen);
            }
        }
        if (drpd.party_aadhar_doc) {
            that.loadDocForView(drpd.mt_cnt, 'party_aadhar_doc', drpd.mt_type, drpd.party_aadhar_doc);
        }
    },
    loadDocForView: function (tempCnt, id, moduleType, docField) {
        $('#' + id + '_container_for_' + moduleType + '_view_' + tempCnt).hide();
        $('#' + id + '_name_container_for_' + moduleType + '_view_' + tempCnt).show();
        $('#' + id + '_name_href_for_' + moduleType + '_view_' + tempCnt).attr('href', DR_DOC_PATH + docField);
        $('#' + id + '_name_for_' + moduleType + '_view_' + tempCnt).html(VIEW_UPLODED_DOCUMENT);
    },
    getQueryData: function (drId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var templateData = {};
        templateData.module_type = VALUE_ELEVEN;
        templateData.module_id = drId;
        var btnObj = $('#query_btn_for_app_' + drId);
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
                tmpData.application_number = moduleData.temp_application_number;
                tmpData.applicant_name = docTypeArray[moduleData.doc_type] ? docTypeArray[moduleData.doc_type] : '';
                tmpData.title = 'Document Type (Article)';
                tmpData.module_type = VALUE_ELEVEN;
                tmpData.module_id = drId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    getDRBD: function (drData) {
        drData.application_datetime_text = drData.application_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(drData.application_datetime) : '';
        drData.submitted_datetime_text = drData.submitted_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(drData.submitted_datetime) : '';
        drData.district_text = talukaArray[drData.district] ? talukaArray[drData.district] : '';
        drData.doc_type_text = docTypeArray[drData.doc_type] ? docTypeArray[drData.doc_type] : '';
        return drData;
    },
    photoDetails: function (drData) {
        drData = this.getDRBD(drData);
        $('#model_title').html('Capture Photo & Biometrics for Document Registration');
        $('#model_body').html(drPhotoDetailsTemplate(drData));
        $('#popup_modal').modal('show');

        Webcam.set({
            width: 400,
            height: 300,
            image_format: 'jpeg',
            jpeg_quality: 100
        });

        $.each(drData.dr_party_details, function (index, drDoc) {
            drDoc.photo_path = drDoc.party_photo ? ('documents/document_registration/' + drDoc.party_photo) : IMAGE_NA_PATH;
            drDoc.tpi_cnt = (index + 1);
            drDoc.party_category_text = partyCategoryArray[drDoc.party_category] ? partyCategoryArray[drDoc.party_category] : '';
            drDoc.party_description_text = partyDescriptionArray[drDoc.party_description] ? partyDescriptionArray[drDoc.party_description] : '';
            drDoc.party_dob_year_text = drDoc.party_birth_type == VALUE_ONE ? ((drDoc.party_dob != '0000-00-00' && drDoc.party_dob) ? dateTo_DD_MM_YYYY(drDoc.party_dob) : '') :
                    (drDoc.party_birth_type == VALUE_TWO ? drDoc.party_dob_year : (drDoc.party_birth_type == VALUE_THREE ? drDoc.party_age : ''));
            drDoc.party_gender_text = genderArray[drDoc.party_gender] ? genderArray[drDoc.party_gender] : '';
            if (drData.status != VALUE_FIVE && drData.status != VALUE_SIX) {
                drDoc.show_change_photo_and_biomatrics_details = true;
            }
            $('#taking_photo_main_container_for_drtp').append(drPhotoItemTemplate(drDoc));
        });
    },
    takePhotoForm: function (drPartyDetailsId) {
        showPopup();
        $('.swal2-popup').css('width', '55em');
        $('#popup_container').html(drPhotoCaptureTemplate({'dr_party_details_id': drPartyDetailsId}));
        Webcam.attach('#camera_container_for_drtp');
    },
    takePhoto: function () {
        Webcam.snap(function (dataURI) {
            $('#party_photo_for_drtp').val(dataURI);
            $('#temp_image_container_for_drtp').html('<img src="' + dataURI + '"/>');
            $('#upload_photo_btn_for_drtp').show();
        });
    },
    uploadPartyPhoto: function (btnObj, drPartyDetailsId) {
        if (!drPartyDetailsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var partyPhoto = $('#party_photo_for_drtp').val();
        if (!partyPhoto) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'document_registration/upload_party_photo',
            type: 'post',
            data: $.extend({}, {'dr_party_details_id': drPartyDetailsId, 'party_photo': partyPhoto}, getTokenData()),
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
                $('#photo_container_for_drtp_' + drPartyDetailsId).attr('src', parseData.photo_file_path);
                Swal.close();
            }
        });
    },
    showFeesDetails: function (btnObj, drId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'document_registration/get_fees_details',
            type: 'post',
            data: $.extend({}, {'dr_id': drId}, getTokenData()),
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
                that.loadFD(parseData);
            }
        });
    },
    loadFD: function (parseData) {
        var that = this;
        var drData = parseData.dr_data;
        drData = that.getDRBD(drData);
        var consAmount = parseInt(drData.doc_consideration_amount) ? parseInt(drData.doc_consideration_amount) : VALUE_ZERO;
        if (consAmount != VALUE_ZERO) {
            drData.show_total_of_entered_ca = true;
        }
        var isAllowChanges = false;
        if (drData.status != VALUE_FIVE && drData.status != VALUE_SIX) {
            isAllowChanges = true;
        }
        fdCnt = 1;
        sdCnt = 1;
        showPopup();
        $('.swal2-popup').css('width', '40em');
        drData.is_allow_changes = isAllowChanges;
        $('#popup_container').html(drFeesDetailsTemplate(drData));

        var sdCD = drData.total_calculation ? JSON.parse(drData.total_calculation) : [];
        if (sdCD.length != VALUE_ZERO) {
            sdCD.sd_rf_type = parseInt(sdCD.sd_rf_type) ? parseInt(sdCD.sd_rf_type) : VALUE_ZERO;
            sdCD.sd = parseFloat(sdCD.sd) ? parseFloat(sdCD.sd) : VALUE_ZERO;
            sdCD.rf = parseFloat(sdCD.rf) ? parseFloat(sdCD.rf) : VALUE_ZERO;
            if (consAmount != VALUE_ZERO) {
                that.loadSDRFC('total', drData.doc_type, sdCD, 'fd', consAmount);
            }
        }
        if (!isAllowChanges) {
            var totalFee = 0;
            var totalSD = 0;
        }
        $.each(parseData.fees_details, function (index, fd) {
            fd.is_allow_changes = isAllowChanges;
            that.addFDRow(fd);
            if (!isAllowChanges) {
                var fee = parseInt(fd.fee);
                totalFee += fee ? fee : 0;
            }
        });
        if (fdCnt == 1 && isAllowChanges) {
            $.each(drBasicFeesArray, function (index, fdName) {
                var tData = {};
                tData.fee_description = fdName;
                tData.is_allow_changes = isAllowChanges;
                that.addFDRow(tData);
            });
        }
        if (fdCnt == VALUE_ONE && !isAllowChanges) {
            $('#fd_item_container_for_fd').html(noRecordFoundTemplate({'colspan': 3, 'message': 'Fee Details Not Available !'}));
        }
        if (drData.sd_details != '') {
            var sdDetails = JSON.parse(drData.sd_details);
            $.each(sdDetails, function (index, sdd) {
                sdd.is_allow_changes = isAllowChanges;
                that.addSDRow(sdd);
                if (!isAllowChanges) {
                    var sd = parseInt(sdd.sd_amount);
                    totalSD += sd ? sd : 0;
                    console.log(sd);
                }
            });
        }
        if (sdCnt == 1 && isAllowChanges) {
            var tsData = {};
            tsData.is_allow_changes = isAllowChanges;
            that.addSDRow(tsData);
        }
        if (sdCnt == VALUE_ONE && !isAllowChanges) {
            $('#sd_item_container_for_sdd').html(noRecordFoundTemplate({'colspan': 3, 'message': 'Stamp Duty Details Not Available !'}));
        }
        if (!isAllowChanges) {
            $('#total_fees_for_fd').html(totalFee + ' /-');
            $('#total_sd_for_sdd').html(totalSD + ' /-');
        }
    },
    addFDRow: function (fdd) {
        var that = this;
        fdd.fd_cnt = fdCnt;
        if (fdd.is_allow_changes) {
            $('#fd_item_container_for_fd').append(drFDItemTemplate(fdd));
            allowOnlyIntegerValue('fee_for_fd_' + fdCnt);
            resetCounter('fd-cnt');
            that.fdFeeCalculation();
        } else {
            $('#fd_item_container_for_fd').append(drFDItemViewTemplate(fdd));
        }
        fdCnt++;
    },
    askForRemoveFDRow: function (rowCnt) {
        $('#fd_row_' + rowCnt).remove();
        this.fdFeeCalculation();
        resetCounter('fd-cnt');
    },
    fdFeeCalculation: function () {
        var totalFee = 0;
        $('.fee_for_fd').each(function () {
            var fee = parseInt($(this).val());
            totalFee += fee ? fee : 0;
        });
        $('#total_fees_for_fd').html(totalFee + ' /-');
    },
    addSDRow: function (sdd) {
        var that = this;
        sdd.sd_cnt = sdCnt;
        if (sdd.is_allow_changes) {
            $('#sd_item_container_for_sdd').append(drSDItemTemplate(sdd));
            allowOnlyIntegerValue('sd_amount_for_sdd_' + sdCnt);
            resetCounter('sd-cnt');
            that.sdCalculation();
        } else {
            $('#sd_item_container_for_sdd').append(drSDItemViewTemplate(sdd));
        }
        sdCnt++;
    },
    removeSDRow: function (rowCnt) {
        $('#sd_row_' + rowCnt).remove();
        this.sdCalculation();
        resetCounter('sd-cnt');
    },
    sdCalculation: function () {
        var totalSD = 0;
        $('.sd_amount_for_sdd').each(function () {
            var sd = parseInt($(this).val());
            totalSD += sd ? sd : 0;
        });
        $('#total_sd_for_sdd').html(totalSD + ' /-');
    },
    checkValidationForFD: function (vmClass) {
        var tempCntForFD = 0;
        var newFDItems = [];
        var exiFDItems = [];
        var totalFees = 0;
        var isFDItemValidation = false;
        $('.fd_row').each(function () {
            var tfdCnt = $(this).find('.og_fd_cnt').val();
            var fdItem = {};
            var desc = $('#desc_for_fd_' + tfdCnt).val();
            if (desc == '' || desc == null) {
                $('#desc_for_fd_' + tfdCnt).focus();
                validationMessageShow(vmClass + '-desc_for_fd_' + tfdCnt, descriptionValidationMessage);
                isFDItemValidation = true;
                return false;
            }
            fdItem.fee_description = desc;
            var fee = parseInt($('#fee_for_fd_' + tfdCnt).val());
            fee = fee ? fee : VALUE_ZERO;
//            if (fee == '' || fee == null) {
//                $('#fee_for_fd_' + tfdCnt).focus();
//                validationMessageShow(vmClass + '-fee_for_fd_' + tfdCnt, feesValidationMessage);
//                isFDItemValidation = true;
//                return false;
//            }
            fdItem.fee = fee;
            totalFees += fee;
            var fdId = $('#fd_id_for_fd_' + tfdCnt).val();
            if (fdId != '') {
                fdItem.fees_bifurcation_id = fdId;
                exiFDItems.push(fdItem);
            } else {
                newFDItems.push(fdItem);
            }
            tempCntForFD++;
        });
        if (isFDItemValidation) {
            return false;
        }
        if (tempCntForFD == 0) {
            validationMessageShow(vmClass, oneFeeValidationMessage);
            return false;
        }
        var returnData = {};
        returnData.new_fd_items = newFDItems;
        returnData.exi_fd_items = exiFDItems;
        returnData.total_fees = totalFees;
        return returnData;
    },
    checkValidationForSD: function () {
        var tempCntForSD = 0;
        var sdItems = [];
        var totalSD = 0;
        var isSDItemValidation = false;
        $('.sd_row').each(function () {
            var tsdCnt = $(this).find('.og_sd_cnt').val();
            var sdItem = {};
            var sdPaperNumber = $('#sd_paper_number_for_sdd_' + tsdCnt).val();
            if (sdPaperNumber == '' || sdPaperNumber == null) {
                $('#sd_paper_number_for_sdd_' + tsdCnt).focus();
                validationMessageShow('sdd-sd_paper_number_for_sdd_' + tsdCnt, sdPaperValidationMessage);
                isSDItemValidation = true;
                return false;
            }
            sdItem.sd_paper_number = sdPaperNumber;
            var sdAmount = parseInt($('#sd_amount_for_sdd_' + tsdCnt).val());
            sdAmount = sdAmount ? sdAmount : VALUE_ZERO;
//            if (sdAmount == '' || sdAmount == null) {
//                $('#sd_amount_for_sdd_' + tsdCnt).focus();
//                validationMessageShow('sdd-sd_amount_for_sdd_' + tsdCnt, sdValidationMessage);
//                isSDItemValidation = true;
//                return false;
//            }
            sdItem.sd_amount = sdAmount;
            totalSD += sdAmount;
            sdItems.push(sdItem);
            tempCntForSD++;
        });
        if (isSDItemValidation) {
            return false;
        }
        if (tempCntForSD == 0) {
            validationMessageShow('sdd', oneSDValidationMessage);
            return false;
        }
        var returnData = {};
        returnData.sd_items = sdItems;
        returnData.total_stamp_duty = totalSD;
        return returnData;
    },
    updateFeesDetails: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var drId = $('#document_registration_id_for_fd').val();
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var formData = this.checkValidationForFD('fd');
        if (!formData) {
            return false;
        }
        var sdData = this.checkValidationForSD();
        if (!sdData) {
            return false;
        }
        formData.sd_details = sdData.sd_items;
        formData.sd_amount = sdData.total_stamp_duty;
        formData.dr_id = drId;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'document_registration/update_fees_details',
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
                validationMessageShow('fd', textStatus.statusText);
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
                    validationMessageShow('fd', parseData.message);
                    return false;
                }
                DocumentRegistration.listview.listPage();
                Swal.close();
                showSuccess(parseData.message);
            }
        });
    },
    generateFeeReceipt: function (drId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#dr_id_for_dr_list_gfr').val(drId);
        $('#dr_fee_receipt_form').submit();
        $('#dr_id_for_dr_list_gfr').val('');
    },
    askForGenerateEndorsement: function (btnObj, drId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'document_registration/check_details_for_endorsement',
            data: $.extend({}, {'dr_id': drId}, getTokenData()),
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
                    showError(parseData.message);
                    return false;
                }
                if (parseData.status != VALUE_FIVE && parseData.status != VALUE_FIVE) {
                    var yesEvent = 'DocumentRegistration.listview.updateStatusApplication(' + drId + ',' + VALUE_THREE + ')';
                    showConfirmation(yesEvent, 'Lock the Application', 'Application Details Cannot be Changed After Lock the Application !');
                } else {
                    that.generateEndorsement(drId);
                }
            }
        });
    },
    generateEndorsement: function (drId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#dr_id_for_dr_list_gend').val(drId);
        $('#dr_endorsement_form').submit();
        $('#dr_id_for_dr_list_gend').val('');
    },
    updateStatusApplication: function (btnObj, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE && moduleType != VALUE_FOUR) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        validationMessageHide();
        if (moduleType == VALUE_THREE) {
            var drId = btnObj;
            btnObj = $('#dr_endorsement_btn_for_app_' + drId);
            var remarks = 'Application Locked';
        } else {
            var drId = $('#document_registration_id_for_view_dr').val();
            if (!drId) {
                showError(invalidAccessValidationMessage);
                return false;
            }
            var remarks = $('#remarks_for_view_dr').val();
        }
        if (!remarks) {
            $('#remarks_for_view_dr').focus();
            validationMessageShow('view-dr-remarks_for_view_dr', remarksValidationMessage);
            return false;
        }
        if (moduleType == VALUE_FOUR) {
            if (!$('#declaration_for_view_dr').is(':checked')) {
                $('#declaration_for_view_dr').focus();
                validationMessageShow('view-dr-declaration_for_view_dr', declarationValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'document_registration/update_status_for_dr',
            type: 'post',
            data: $.extend({}, {'dr_id': drId, 'remarks': remarks, 'module_type': moduleType}, getTokenData()),
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
                DocumentRegistration.listview.listPage();
                Swal.close();
                showSuccess(parseData.message);
                if (moduleType == VALUE_THREE) {
                    that.generateEndorsement(drId);
                }
            }
        });
    },
    loadScannedDocument: function (drData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (drData.status != VALUE_FIVE) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        showPopup();
        $('.swal2-popup').css('width', '40em');
        drData.doc_upload_status_text = DRUploadDocStatusArray[drData.doc_upload_status] ? DRUploadDocStatusArray[drData.doc_upload_status] : '';
        if (drData.doc_upload_status == VALUE_ZERO || drData.doc_upload_status == VALUE_ONE) {
            drData.show_scanned_doc_btn = true;
        }
        $('#popup_container').html(drScannedDocTemplate(drData));
        if (drData.final_document != '') {
            that.loadSD('final_document', 'dr_sd', drData);
        }
    },
    uploadScannedDoc: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        var id = 'final_document';
        var doc = $('#' + id + '_for_dr_sd').val();
        if (doc == '') {
            return false;
        }
        var drId = $('#document_registration_id_for_dr_sd').val();
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var docMessage = fileUploadValidationForPDF(id + '_for_dr_sd', 25600);
        if (docMessage != '') {
            validationMessageShow('dr-sd', docMessage);
            return false;
        }
        $('#' + id + '_container_for_dr_sd').hide();
        $('#' + id + '_name_container_for_dr_sd').hide();
        $('#spinner_template_' + id + '_for_dr_sd').show();
        var formData = new FormData();
        formData.append('document_registration_id', drId);
        formData.append('document_file', $('#' + id + '_for_dr_sd')[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'document_registration/upload_scanned_document',
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
                $('#' + id + '_name_container_for_dr_sd').hide();
                $('#spinner_template_' + id + '_for_dr_sd').hide();
                $('#' + id + '_container_for_dr_sd').show();
                $('#' + id + '_for_dr_sd').val('');
                validationMessageShow('dr-sd', textStatus.statusText);
            },
            success: function (data) {
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                if (parseData.success == false) {
                    $('#' + id + '_name_container_for_dr_sd').hide();
                    $('#spinner_template_' + id + '_for_dr_sd').hide();
                    $('#' + id + '_container_for_dr_sd').show();
                    $('#' + id + '_for_dr_sd').val('');
                    validationMessageShow('dr-sd', parseData.message);
                    return false;
                }
                $('#spinner_template_' + id + '_for_dr_sd').hide();
                $('#' + id + '_name_container_for_dr_sd').hide();
                $('#' + id + '_for_dr_sd').val('');

                var docData = parseData.document_data;
                if (docData.doc_upload_status) {
                    that.updateDRDocStatus(drId, docData.doc_upload_status);
                }
                that.loadSD(id, 'dr_sd', docData);
            }
        });
    },
    updateDRDocStatus: function (drId, docUS) {
        $('#dr_sd_status_' + drId).html(DRUploadDocStatusArray[docUS] ? DRUploadDocStatusArray[docUS] : '');
        $('#dr_sd_status_for_dr_sd').html(DRUploadDocStatusArray[docUS] ? DRUploadDocStatusArray[docUS] : '');
    },
    loadSD: function (documentFieldName, mtType, docItemData) {
        $('#' + documentFieldName + '_container_for_' + mtType).hide();
        $('#' + documentFieldName + '_name_container_for_' + mtType).show();
        $('#' + documentFieldName + '_name_href_for_' + mtType).attr('href', 'documents/dr_scanned_document/' + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_' + mtType).html(VIEW_UPLODED_DOCUMENT);
        $('#' + documentFieldName + '_remove_btn_for_' + mtType).attr('onclick', 'DocumentRegistration.listview.removePDDoc("' + docItemData['document_registration_id'] + '")');
    },
    removePDDoc: function (drId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        validationMessageHide();
        var id = 'final_document';
        $('#' + id + '_container_for_dr_sd').hide();
        $('#' + id + '_name_container_for_dr_sd').hide();
        $('#spinner_template_' + id + '_for_dr_sd').show();
        $.ajax({
            type: 'POST',
            url: 'document_registration/remove_scanned_document',
            data: $.extend({}, {'document_registration_id': drId}, getTokenData()),
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
                $('#' + id + '_container_for_dr_sd').hide();
                $('#spinner_template_' + id + '_for_dr_sd').hide();
                $('#' + id + '_name_container_for_dr_sd').show();
                validationMessageShow('dr-sd', textStatus.statusText);
            },
            success: function (response) {
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    $('#' + id + '_container_for_dr_sd').hide();
                    $('#spinner_template_' + id + '_for_dr_sd').hide();
                    $('#' + id + '_name_container_for_dr_sd').show();
                    validationMessageShow('dr-sd', parseData.message);
                    return false;
                }
                $('#spinner_template_' + id + '_for_dr_sd').hide();
                that.updateDRDocStatus(drId, parseData.doc_upload_status);
                removeDocument('final_document', 'dr_sd');
            }
        });
    },
    updateSDStatus: function (btnObj, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var drId = $('#document_registration_id_for_dr_sd').val();
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'document_registration/update_scanned_document_status',
            type: 'post',
            data: $.extend({}, {'document_registration_id': drId, 'module_type': moduleType}, getTokenData()),
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
                that.updateDRDocStatus(drId, parseData.doc_upload_status);
                Swal.close();
                showSuccess(parseData.message);
            }
        });
    },
    openMapForDRSFour: function (moduleType, tempCnt) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!tempCnt) {
            return false;
        }
        var mapData = {};
        mapData.temp_cnt = tempCnt;
        mapData.module_type = moduleType;
        mapData.lat = $('#' + moduleType + '_latitude_for_drsfour_' + tempCnt).val();
        mapData.lng = $('#' + moduleType + '_longitude_for_drsfour_' + tempCnt).val();
        mapData.lat_display = mapData.lat;
        mapData.lng_display = mapData.lng;
        if (mapData.lat == '' || mapData.lat == VALUE_ZERO) {
            mapData.lat = DAMAN_LAT;
        }
        if (mapData.lng == '' || mapData.lng == VALUE_ZERO) {
            mapData.lng = DAMAN_LNG;
        }
        showPopup();
        $('.swal2-popup').css('width', '70em');
        $('#popup_container').html(drPDMapTemplate(mapData));

        loadMap(moduleType + '_map_container_for_drsfour_' + tempCnt, moduleType + '_latitude_for_drsfour_' + tempCnt, moduleType + '_longitude_for_drsfour_' + tempCnt, mapData, true);
    },
    resetAndClose: function (moduleType, tempCnt) {
        $('.' + moduleType + '_latitude_for_drsfour_' + tempCnt).val(VALUE_ZERO);
        $('.' + moduleType + '_longitude_for_drsfour_' + tempCnt).val(VALUE_ZERO);
        Swal.close();
    },
    ccChangeEvent: function (tempCnt) {
        $('#height_above_sqft_container_for_drsfour_' + tempCnt).hide();
        var cpPropertyType = $('#cp_property_type_for_drsfour_' + tempCnt).val();
        var cpCC = $('#cp_cc_for_drsfour_' + tempCnt).val();
        if ((cpPropertyType == VALUE_FIVE && cpCC == VALUE_FIVE) || (cpPropertyType == VALUE_NINE && cpCC == VALUE_EIGHTEEN)) {
            $('#height_above_sqft_container_for_drsfour_' + tempCnt).show();
        }
    },
    pcChangeEvent: function (tempMt) {
        var pc = $('#party_category_for_' + tempMt).val();
        if (!pc) {
            return false;
        }
        if (pc == VALUE_ONE || pc == VALUE_TWO) {
            $('#party_description_for_' + tempMt).val(pc).trigger('change');
        } else if (pc == VALUE_FIVE) {
            $('#party_description_for_' + tempMt).val(VALUE_THREE).trigger('change');
        } else if (pc == VALUE_SIX) {
            $('#party_description_for_' + tempMt).val(VALUE_EIGHT).trigger('change');
        }
    },
    drDocTypeChangeEvent: function (obj) {
        var docType = obj.val();
        $('#doc_type_ld_lla_tl_for_drsone').hide();
        if (!docType) {
            return false;
        }
        if (docType == VALUE_TWENTYSEVEN) {
            $('#doc_type_ld_lla_tl_for_drsone').show();
            return false;
        }
    },
    noyLeaseChangeEvent: function (obj) {
        var noy = obj.val();
        if (noy == '') {
            return false;
        }
        if (noy == 100) {
            $('#nom_lease_for_drsone').val(VALUE_ZERO).trigger('change');
            return false;
        }
    },
    nomLeaseChangeEvent: function (obj) {
        var nom = obj.val();
        if (nom == '') {
            return false;
        }
        var noy = $('#noy_lease_for_drsone').val();
        if (noy == 100 && nom != '' && nom != 0) {
            $('#noy_lease_for_drsone').val(99).trigger('change');
            return false;
        }
    },
    downloadExcelForDocumentRegistration: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#doc_number_for_document_registration_excel').val($('#doc_number_for_document_registration_list').val());
        $('#temp_application_number_for_document_registration_excel').val($('#temp_application_number_for_document_registration_list').val());
        $('#party_details_for_document_registration_excel').val($('#party_details_for_document_registration_list').val());
        $('#doc_type_for_document_registration_excel').val($('#doc_type_for_document_registration_list').val());
        $('#appointment_status_for_document_registration_excel').val($('#appointment_date_for_document_registration_list').val());
        $('#query_status_for_document_registration_excel').val($('#query_status_for_document_registration_list').val());
        $('#status_for_document_registration_excel').val($('#status_for_document_registration_list').val());

        $('#generate_excel_for_document_registration').submit();
        $('#doc_number_for_document_registration_excel').val('');
        $('#temp_application_number_for_document_registration_excel').val('');
        $('#party_details_for_document_registration_excel').val('');
        $('#doc_type_for_document_registration_excel').val('');
        $('#appointment_status_for_document_registration_excel').val('');
        $('#query_status_for_document_registration_excel').val('');
        $('#status_for_document_registration_excel').val('');

    },
    partyDetailsOrderingForm: function (drData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (drData.status == VALUE_FIVE || drData.status == VALUE_SIX) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(drPartyOrderTemplate(drData));
        $.each(drData.dr_party_details, function (index, drpd) {
            drpd.poi_cnt = (index + 1);
            drpd.party_category_text = partyCategoryArray[drpd.party_category] ? partyCategoryArray[drpd.party_category] : '';
            drpd.party_description_text = partyDescriptionArray[drpd.party_description] ? partyDescriptionArray[drpd.party_description] : '';
            $('#poi_container_for_party_order').append(drPartyOrderItemTemplate(drpd));
        });
        $("#poi_container_for_party_order").sortable({handle: 'button', cancel: ''}).disableSelection();
    },
    changeOrder: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var drId = $('#document_registration_id_for_party_order').val();
        if (!drId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var tempCntForSD = 1;
        var pdItems = [];
        var isDRPDIValidation = false;
        $('.dr_pd_id_for_poi').each(function () {
            var drpdId = $(this).val();
            if (drpdId == '' || drpdId == null || drpdId == 0 || !drpdId) {
                showError(invalidAccessValidationMessage);
                isDRPDIValidation = true;
                return false;
            }
            var pdItem = {};
            pdItem.order = tempCntForSD;
            pdItem.dr_party_details_id = drpdId;
            pdItems.push(pdItem);
            tempCntForSD++;
        });
        if (isDRPDIValidation) {
            return false;
        }
        if (tempCntForSD == 1) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var formData = {};
        formData.document_registration_id = drId;
        formData.pd_items = pdItems;
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'document_registration/change_party_order',
            type: 'post',
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
                Swal.close();
                showSuccess(parseData.message);
            }
        });
    }
});
