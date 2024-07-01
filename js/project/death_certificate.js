var deathCertificateListTemplate = Handlebars.compile($('#death_certificate_list_template').html());
var deathCertificateTableTemplate = Handlebars.compile($('#death_certificate_table_template').html());
var deathCertificateActionTemplate = Handlebars.compile($('#death_certificate_action_template').html());
var deathCertificateFormTemplate = Handlebars.compile($('#death_certificate_form_template').html());
var deathCertificateViewTemplate = Handlebars.compile($('#death_certificate_view_template').html());
var deathCertificateApproveTemplate = Handlebars.compile($('#death_certificate_approve_template').html());
var deathCertificateRejectTemplate = Handlebars.compile($('#death_certificate_reject_template').html());

var DeathCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
DeathCertificate.Router = Backbone.Router.extend({
    routes: {
        'death_certificate': 'renderList',
        'death_certificate_form': 'renderList',
        'edit_death_certificate_form': 'renderList',
        'view_death_certificate_form': 'renderList',
    },
    renderList: function () {
        DeathCertificate.listview.listPage();
    },
});
DeathCertificate.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_SUBR_USER &&
                tempTypeInSession != TEMP_TYPE_SUBR_VER_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_sub_registrar');
        addClass('subr_death_certificate', 'active');
        DeathCertificate.router.navigate('death_certificate');
        var templateData = {};
        this.$el.html(deathCertificateListTemplate(templateData));
        this.loadDeathCertificateData(sDistrict, sType);
    },
    actionRenderer: function (rowData) {
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_USER ||
                tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) && rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX) {
            rowData.show_edit_btn = true;
        }
        rowData.status = parseInt(rowData.status);
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_USER ||
                tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) && rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX &&
                (rowData.query_status == VALUE_ZERO || rowData.query_status == VALUE_THREE)) {
            rowData.show_reject_btn = '';
        } else {
            rowData.show_reject_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_USER ||
                tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) && (rowData.status == VALUE_TWO || rowData.status == VALUE_THREE) && (rowData.query_status == VALUE_ZERO || rowData.query_status == VALUE_THREE)) {
            rowData.show_approve_btn = '';
        } else {
            rowData.show_approve_btn = 'display: none;';
        }
        rowData.module_type = VALUE_TWENTY;
        if (rowData.status == VALUE_FIVE) {
            rowData.download_certificate_style = '';
        } else {
            rowData.download_certificate_style = 'display: none;';
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_pa_btn = true;
        }
        return deathCertificateActionTemplate(rowData);
    },
    loadDeathCertificateData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + '</b><br><b><i class="fa fa-birthday-cake f-s-10px"></i> :- ' + (full.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(full.applicant_dob) : '') + '</b><br><i class="fas fa-phone-volume f-s-10px"></i> :- '
                    + full.mobile_number + '<br><b><i class="fas fa-street-view f-s-10px"></i> :- ' + full.communication_address + '</b>';
        };
        var regDetailsRenderer = function (data, type, full, meta) {
            var regData = (full.is_date_or_year == VALUE_ONE ? (full.registration_date != '0000-00-00' ? dateTo_DD_MM_YYYY(full.registration_date) : '') : (full.is_date_or_year == VALUE_TWO ? full.registration_year : (full.is_date_or_year == VALUE_THREE ? 'None' : [])));
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.registration_number + '</b><br><b><i class="fa fa-calendar f-s-10px"></i> :- ' + regData + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? damanVillagesArray : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '');
        };
        var that = this;
        DeathCertificate.router.navigate('death_certificate');
        var searchData = dtomMam(sDistrict, sType, 'DeathCertificate.listview.loadDeathCertificateData();');
        $('#death_certificate_form_and_datatable_container').html(deathCertificateTableTemplate(searchData));
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_death_certificate_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_death_certificate_list', false);
        if (sType == VALUE_ONE || sType == VALUE_TWO) {
            $('#query_status_for_death_certificate_list').val(sType);
            $('#query_status_for_death_certificate_list').attr('disabled', 'disabled');
        }
        if (sType == VALUE_THREE || sType == VALUE_FIVE || sType == VALUE_SIX) {
            $('#status_for_death_certificate_list').val(sType);
            $('#status_for_death_certificate_list').attr('disabled', 'disabled');
        }
        deathCertificateDataTable = $('#death_certificate_datatable').DataTable({
            ajax: {
                url: 'death_certificate/get_death_certificate_data',
                dataSrc: "death_certificate_data",
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
                {data: 'application_number', 'class': 'text-center f-w-b', 'render': appNumberWithRegiUserRenderer},
                {data: 'district', 'class': 'text-center f-w-b', 'render': distVillRenderer},
                {data: '', 'class': 'f-s-app-details', 'render': appDetailsRenderer},
                {data: '', 'class': 'f-s-app-details', 'render': regDetailsRenderer},
                {data: 'death_certificate_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {data: 'death_certificate_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#death_certificate_datatable_filter').remove();
        $('#death_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = deathCertificateDataTable.row(tr);

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
    newDeathCertificateForm: function (isEdit, dcData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            DeathCertificate.router.navigate('edit_death_certificate_form');
        } else {
            DeathCertificate.router.navigate('death_certificate_form');
        }
        dcData.VALUE_ONE = VALUE_ONE;
        dcData.VALUE_TWO = VALUE_TWO;
        dcData.VALUE_THREE = VALUE_THREE;
        dcData.VALUE_FOUR = VALUE_FOUR;
        dcData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#death_certificate_form_and_datatable_container').html(deathCertificateFormTemplate(dcData));
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_death_certificate');
        renderOptionsForTwoDimensionalArray(relationStatusArray, 'relation_status_for_death_certificate');
        renderOptionsForTwoDimensionalArray(applyingForArray, 'applying_for_death_certificate');
        generateBoxes('radio', genderArray, 'gender', 'death_certificate', dcData.gender, false, false);
        generateBoxes('radio', dateYearArray, 'date_year', 'death_certificate', dcData.is_date_or_year, false, false);
        showSubContainer('date_year', 'death_certificate', '.date_item', VALUE_ONE, 'radio', '.year_item', VALUE_TWO);


        if (isEdit) {
            $('#district_for_death_certificate').val(dcData.district);
            $('#relation_status_for_death_certificate').val(dcData.relation_status);
            $('#applying_for_death_certificate').val(dcData.applying_for);

            if (dcData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_death_certificate', 'applicant_photo_doc_name_image_for_death_certificate', 'applicant_photo_doc_name_container_for_death_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', dcData.applicant_photo_doc, dcData.death_certificate_id, VALUE_ONE);
            }
            if (dcData.birth_certi_doc != '') {
                that.showDocument('birth_certi_doc_container_for_death_certificate', 'birth_certi_doc_name_image_for_death_certificate', 'birth_certi_doc_name_container_for_death_certificate',
                        'birth_certi_doc_download', 'birth_certi_doc', dcData.birth_certi_doc, dcData.death_certificate_id, VALUE_TWO);
            }
            if (dcData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_death_certificate', 'aadhar_card_doc_name_image_for_death_certificate', 'aadhar_card_doc_name_container_for_death_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', dcData.aadhar_card_doc, dcData.death_certificate_id, VALUE_THREE);
            }
            if (dcData.old_death_certi_doc != '') {
                that.showDocument('old_death_certi_doc_container_for_death_certificate', 'old_death_certi_doc_name_image_for_death_certificate', 'old_death_certi_doc_name_container_for_death_certificate',
                        'old_death_certi_doc_download', 'old_death_certi_doc', dcData.old_death_certi_doc, dcData.death_certificate_id, VALUE_FOUR);
            }
        }
        generateSelect2();
        datePicker();
        datePickerId('applicant_dob_for_death_certificate');
        datePickerId('death_person_dod_for_death_certificate');
        datePickerId('registration_date_for_death_certificate');
        allowOnlyIntegerValue('mobile_number_for_death_certificate');

        if (isEdit) {
            if (dcData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_death_certificate').val(dateTo_DD_MM_YYYY(dcData.applicant_dob));
            }
            if (dcData.death_person_dod != '0000-00-00') {
                $('#death_person_dod_for_death_certificate').val(dateTo_DD_MM_YYYY(dcData.death_person_dod));
            }
            if (dcData.date != '0000-00-00') {
                $('#date_for_death_certificate').val(dateTo_DD_MM_YYYY(dcData.date));
            }
            if (dcData.registration_date != '0000-00-00') {
                $('#registration_date_for_death_certificate').val(dateTo_DD_MM_YYYY(dcData.registration_date));
            }
            if (dcData.relation_status == VALUE_FIVE) {
                $('.other_relationship_with_applicant_div_for_death_certificate').show();
            } else {
                $('.other_relationship_with_applicant_div_for_death_certificate').hide();
            }
        }

        allowOnlyIntegerValue('aadhar_number_for_death_certificate');
        allowOnlyIntegerValue('registration_year_for_death_certificate');
        if (!isEdit) {
            $('#applicant_dob_for_death_certificate').val('');
            $('#death_person_dod_for_death_certificate').val('');
            $('#registration_date_for_death_certificate').val('');
        }
        $('#death_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDeathCertificate(VALUE_TWO);
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', DEATH_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", DEATH_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'DeathCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },
    editOrViewDeathCertificate: function (btnObj, deathCertificateId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!deathCertificateId) {
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
            url: 'death_certificate/get_death_certificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'death_certificate_id': deathCertificateId, 'is_edit': (isEdit ? VALUE_ZERO : VALUE_ONE)}, getTokenData()),
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
                var deathCertificateData = parseData.death_certificate_data;
                if (isEdit) {
                    that.newDeathCertificateForm(isEdit, deathCertificateData);
                } else {
                    that.viewDeathCertificateForm(VALUE_ONE, deathCertificateData, isPrint);
                }
            }
        });
    },
    viewDeathCertificateForm: function (moduleType, deathCertificateData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        if (moduleType == VALUE_ONE) {
            DeathCertificate.router.navigate('view_death_certificate_form');
            deathCertificateData.title = 'View';
        } else {
            deathCertificateData.show_submit_btn = true;
        }
        deathCertificateData.VALUE_THREE = VALUE_THREE;
        deathCertificateData.DEATH_CERTIFICATE_DOC_PATH = DEATH_CERTIFICATE_DOC_PATH;
        deathCertificateData.district_text = talukaArray[deathCertificateData.district] ? talukaArray[deathCertificateData.district] : '';
        deathCertificateData.gender_text = genderArray[deathCertificateData.gender] ? genderArray[deathCertificateData.gender] : '';
        if (deathCertificateData.relation_status == VALUE_FIVE) {
            deathCertificateData.relationship_with_applicant_text = deathCertificateData.other_relationship_with_applicant;
        } else {
            deathCertificateData.relationship_with_applicant_text = relationStatusArray[deathCertificateData.relation_status] ? relationStatusArray[deathCertificateData.relation_status] : '';
        }
        deathCertificateData.applying_for_text = applyingForArray[deathCertificateData.applying_for] ? applyingForArray[deathCertificateData.applying_for] : '';
        deathCertificateData.applicant_dob_text = deathCertificateData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(deathCertificateData.applicant_dob) : '';
        deathCertificateData.death_person_dod_text = deathCertificateData.death_person_dod != '0000-00-00' ? dateTo_DD_MM_YYYY(deathCertificateData.death_person_dod) : '';
        deathCertificateData.show_applicant_photo_doc = deathCertificateData.applicant_photo_doc != '' ? true : false;
        deathCertificateData.show_birth_certi_doc = deathCertificateData.birth_certi_doc != '' ? true : false;
        deathCertificateData.show_aadhar_card_doc = deathCertificateData.aadhar_card_doc != '' ? true : false;
        deathCertificateData.show_old_death_certi_doc = deathCertificateData.old_death_certi_doc != '' ? true : false;
        var regDate = deathCertificateData.registration_date != '0000-00-00' ? dateTo_DD_MM_YYYY(deathCertificateData.registration_date) : '';
        var dateYear = deathCertificateData.is_date_or_year;
        var regData = dateYear == VALUE_ONE ? regDate : (dateYear == VALUE_TWO ? deathCertificateData.registration_year : (dateYear == VALUE_THREE ? 'None' : []));
        deathCertificateData.registration_details_text = regData;
        if (deathCertificateData.status != VALUE_ZERO && deathCertificateData.status != VALUE_ONE) {
            deathCertificateData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(deathCertificateViewTemplate(deathCertificateData));

        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_dcview').click();
            }, 500);
        }
    },
    checkValidationForDeathCertificate: function (moduleType, deathCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!deathCertificateData.district_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('district_for_death_certificate', selectDistrictValidationMessage);
        }
        if (!deathCertificateData.applicant_name_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_death_certificate', applicantNameValidationMessage);
        }
        if (!deathCertificateData.mobile_number_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_death_certificate', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(deathCertificateData.mobile_number_for_death_certificate);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_death_certificate', mobileMessage);
        }
        if (deathCertificateData.aadhar_number_for_death_certificate != '') {
            var aadharNumberValidationMessage = aadharNumberValidation('death-certificate', 'aadhar_number_for_death_certificate');
            if (aadharNumberValidationMessage != undefined) {
                return getBasicMessageAndFieldJSONArray('aadhar_number_for_death_certificate', invalidAadharNumberValidationMessage);
            }
        }
        if (deathCertificateData.email_for_death_certificate != '') {
            var emailIdValidationMessage = emailIdValidation(deathCertificateData.email_for_death_certificate);
            if (emailIdValidationMessage != '') {
                return getBasicMessageAndFieldJSONArray('email_for_death_certificate', emailIdValidationMessage);
            }
        }
        if (!deathCertificateData.communication_address_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('communication_address_for_death_certificate', communicationAddressValidationMessage);
        }
        if (!deathCertificateData.applicant_address_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_address_for_death_certificate', communicationAddressValidationMessage);
        }
        if (!deathCertificateData.applicant_dob_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_death_certificate', birthDateValidationMessage);
        }
        if (!deathCertificateData.applicant_age_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_death_certificate', applicantAgeValidationMessage);
        }
        if (moduleType == VALUE_ONE) {
            return '';
        }
        if (!deathCertificateData.relation_status_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('relation_status_for_death_certificate', relationStatusValidationMessage);
        }
        if (deathCertificateData.relation_status_for_death_certificate == VALUE_FIVE) {
            if (!deathCertificateData.other_relationship_with_applicant_for_death_certificate) {
                return getBasicMessageAndFieldJSONArray('other_relationship_with_applicant_for_death_certificate', otherRelationshipValidationMessage);
            }
        }
        if (!deathCertificateData.purpose_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('purpose_for_death_certificate', purposeForDeathCertificateValidationMessage);
        }
        if (!deathCertificateData.death_person_name_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('death_person_name_for_death_certificate', deathPersonNameValidationMessage);
        }
        if (!deathCertificateData.gender_for_death_certificate) {
            $('#gender_for_death_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('gender_for_death_certificate', genderValidationMessage);
        }
        if (!deathCertificateData.death_person_dod_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('death_person_dod_for_death_certificate', deathDateValidationMessage);
        }
        if (!deathCertificateData.death_place_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('death_place_for_death_certificate', deathOfPlaceValidationMessage);
        }
        if (!deathCertificateData.mother_name_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_death_certificate', motherNameValidationMessage);
        }
        if (!deathCertificateData.father_name_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('father_name_for_death_certificate', fatherNameValidationMessage);
        }
        if (!deathCertificateData.dp_communication_address_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('dp_communication_address_for_death_certificate', communicationAddressValidationMessage);
        }
        if (!deathCertificateData.dp_permanent_address_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('dp_permanent_address_for_death_certificate', communicationAddressValidationMessage);
        }
        if (!deathCertificateData.registration_number_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('registration_number_for_death_certificate', registrationNumberValidationMessage);
        }
        if (!deathCertificateData.date_year_for_death_certificate) {
            $('#date_year_for_death_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('date_year_for_death_certificate', dateYearValidationMessage);
        }
        if (deathCertificateData.date_year_for_death_certificate == 1) {
            if (!deathCertificateData.registration_date_for_death_certificate) {
                return getBasicMessageAndFieldJSONArray('registration_date_for_death_certificate', registrationDateValidationMessage);
            }
        }
        if (deathCertificateData.date_year_for_death_certificate == 2) {
            if (!deathCertificateData.registration_year_for_death_certificate) {
                return getBasicMessageAndFieldJSONArray('registration_year_for_death_certificate', registrationYearValidationMessage);
            }
        }
        if (!deathCertificateData.applying_for_death_certificate) {
            return getBasicMessageAndFieldJSONArray('applying_for_death_certificate', applyingForValidationMessage);
        }
        return '';
    },
    askForSubmitDeathCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'DeathCertificate.listview.submitDeathCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitDeathCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var dcData = $('#death_certificate_form').serializeFormJSON();
        var validationDataOne = that.checkValidationForDeathCertificate(moduleType, dcData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('death-certificate-' + validationDataOne.field, validationDataOne.message);
            return false;
        }
        if (moduleType != VALUE_ONE) {
            if ($('#applicant_photo_doc_container_for_death_certificate').is(':visible')) {
                var applicantPhoto = checkValidationForDocument('applicant_photo_doc_for_death_certificate', VALUE_TWO, 'death-certificate');
                if (applicantPhoto == false) {
                    return false;
                }
            }
            if ($('#birth_certi_doc_container_for_death_certificate').is(':visible')) {
                var deathCertificate = checkValidationForDocument('birth_certi_doc_for_death_certificate', VALUE_ONE, 'death-certificate');
                if (deathCertificate == false) {
                    return false;
                }
            }
        }
        if (moduleType == VALUE_FOUR || moduleType == VALUE_FIVE) {
            var status = $('#status_for_death_certificate').val();
            var queryStatus = $('#query_status_for_death_certificate').val();
            if (status != VALUE_FIVE && status != VALUE_SIX && queryStatus == VALUE_ONE) {
                var qrRemarks = $('#remarks_for_death_certificate').val();
                if (!qrRemarks) {
                    $('#remarks_for_death_certificate').focus();
                    validationMessageShow('qrmc-remarks_for_death_certificate', remarksValidationMessage);
                    return false;
                }
                dcData.qr_remarks = qrRemarks;
            } else {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (moduleType == VALUE_FOUR) {
                that.askForSubmitDeathCertificate(moduleType);
                return false;
            }
        }

        dcData.module_type = moduleType;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_death_certificate') : $('#submit_btn_for_death_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'death_certificate/submit_death_certificate',
            data: $.extend({}, dcData, getTokenData()),
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
                validationMessageShow('death-certificate', textStatus.statusText);
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
                    validationMessageShow('death-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                DeathCertificate.router.navigate('death_certificate', {'trigger': true});
            }
        });
    },
    relationshipChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var relationship = obj.val();
        if (!relationship) {
            return false;
        }
        if (relationship == VALUE_FIVE) {
            $('.other_relationship_with_applicant_div_for_death_certificate').show();
        } else {
            $('.other_relationship_with_applicant_div_for_death_certificate').hide();
        }
    },
    askForApproveApplication: function (deathCertificateId) {
        if (!deathCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + deathCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'death_certificate/get_death_certificate_data_by_death_certificate_id',
            type: 'post',
            data: $.extend({}, {'death_certificate_id': deathCertificateId}, getTokenData()),
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
                var deathCertificateData = parseData.death_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                $('#popup_container').html(deathCertificateApproveTemplate(deathCertificateData));
            }
        });
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_death_certificate_form').serializeFormJSON();
        if (!formData.death_certificate_id_for_death_certificate_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_death_certificate_approve) {
            $('#remarks_for_death_certificate_approve').focus();
            validationMessageShow('death-certificate-approve-remarks_for_death_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_death_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'death_certificate/approve_application',
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
                validationMessageShow('death-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('death-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                DeathCertificate.listview.listPage();
            }
        });
    },
    askForRejectApplication: function (deathCertificateId) {
        if (!deathCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + deathCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'death_certificate/get_death_certificate_data_by_death_certificate_id',
            type: 'post',
            data: $.extend({}, {'death_certificate_id': deathCertificateId}, getTokenData()),
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
                var deathCertificateData = parseData.death_certificate_data;
                showPopup();
                $('#popup_container').html(deathCertificateRejectTemplate(deathCertificateData));
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_death_certificate_form').serializeFormJSON();
        if (!formData.death_certificate_id_for_death_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_death_certificate_reject) {
            $('#remarks_for_death_certificate_reject').focus();
            validationMessageShow('death-certificate-reject-remarks_for_death_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_death_certificate_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'death_certificate/reject_application',
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
                validationMessageShow('death-certificate-reject', textStatus.statusText);
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
                    validationMessageShow('death-certificate-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                DeathCertificate.listview.listPage();
            }
        });
    },
    downloadCertificate: function (deathCertificateId, moduleType) {
        if (!deathCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#death_certificate_id_for_certificate').val(deathCertificateId);
        $('#mtype_for_certificate').val(moduleType);
        $('#death_certificate_pdf_form').submit();
        $('#death_certificate_id_for_certificate').val('');
        $('#mtype_for_certificate').val('');
    },
    getQueryData: function (deathCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!deathCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_TWENTY;
        templateData.module_id = deathCertificateId;
        var btnObj = $('#query_btn_for_app_' + deathCertificateId);
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
                tmpData.module_type = VALUE_TWENTY;
                tmpData.module_id = deathCertificateId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    downloadExcelForDC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_dcge').val($('#app_no_for_death_certificate_list').val());
        $('#app_details_for_dcge').val($('#app_details_for_death_certificate_list').val());
        $('#status_for_dcge').val($('#status_for_death_certificate_list').val());
        $('#qstatus_for_dcge').val($('#query_status_for_death_certificate_list').val());
        $('#generate_excel_for_death_certificate').submit();
        $('.dcge').val('');
    }
});
