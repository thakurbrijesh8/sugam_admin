var birthCertificateListTemplate = Handlebars.compile($('#birth_certificate_list_template').html());
var birthCertificateTableTemplate = Handlebars.compile($('#birth_certificate_table_template').html());
var birthCertificateActionTemplate = Handlebars.compile($('#birth_certificate_action_template').html());
var birthCertificateFormTemplate = Handlebars.compile($('#birth_certificate_form_template').html());
var birthCertificateViewTemplate = Handlebars.compile($('#birth_certificate_view_template').html());
var birthCertificateApproveTemplate = Handlebars.compile($('#birth_certificate_approve_template').html());
var birthCertificateRejectTemplate = Handlebars.compile($('#birth_certificate_reject_template').html());

var BirthCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
BirthCertificate.Router = Backbone.Router.extend({
    routes: {
        'birth_certificate': 'renderList',
        'birth_certificate_form': 'renderList',
        'edit_birth_certificate_form': 'renderList',
        'view_birth_certificate_form': 'renderList',
    },
    renderList: function () {
        BirthCertificate.listview.listPage();
    },
});
BirthCertificate.listView = Backbone.View.extend({
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
        addClass('subr_birth_certificate', 'active');
        BirthCertificate.router.navigate('birth_certificate');
        var templateData = {};
        this.$el.html(birthCertificateListTemplate(templateData));
        this.loadBirthCertificateData(sDistrict, sType);
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
        rowData.module_type = VALUE_NINETEEN;
        if (rowData.status == VALUE_FIVE) {
            rowData.download_certificate_style = '';
        } else {
            rowData.download_certificate_style = 'display: none;';
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_pa_btn = true;
        }
        return birthCertificateActionTemplate(rowData);
    },
    loadBirthCertificateData: function (sDistrict, sType) {
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
        BirthCertificate.router.navigate('birth_certificate');
        var searchData = dtomMam(sDistrict, sType, 'BirthCertificate.listview.loadBirthCertificateData();');
        $('#birth_certificate_form_and_datatable_container').html(birthCertificateTableTemplate(searchData));
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_birth_certificate_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_birth_certificate_list', false);
        if (sType == VALUE_ONE || sType == VALUE_TWO) {
            $('#query_status_for_birth_certificate_list').val(sType);
            $('#query_status_for_birth_certificate_list').attr('disabled', 'disabled');
        }
        if (sType == VALUE_THREE || sType == VALUE_FIVE || sType == VALUE_SIX) {
            $('#status_for_birth_certificate_list').val(sType);
            $('#status_for_birth_certificate_list').attr('disabled', 'disabled');
        }
        birthCertificateDataTable = $('#birth_certificate_datatable').DataTable({
            ajax: {
                url: 'birth_certificate/get_birth_certificate_data',
                dataSrc: "birth_certificate_data",
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
                {data: 'birth_certificate_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {data: 'birth_certificate_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#birth_certificate_datatable_filter').remove();
        $('#birth_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = birthCertificateDataTable.row(tr);

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
    newBirthCertificateForm: function (isEdit, bcData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            BirthCertificate.router.navigate('edit_birth_certificate_form');
        } else {
            BirthCertificate.router.navigate('birth_certificate_form');
        }
        bcData.VALUE_ONE = VALUE_ONE;
        bcData.VALUE_TWO = VALUE_TWO;
        bcData.VALUE_THREE = VALUE_THREE;
        bcData.VALUE_FOUR = VALUE_FOUR;
        bcData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#birth_certificate_form_and_datatable_container').html(birthCertificateFormTemplate(bcData));
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_birth_certificate');
        renderOptionsForTwoDimensionalArray(relationStatusArray, 'relationship_with_applicant_for_birth_certificate');
        renderOptionsForTwoDimensionalArray(applyingForArray, 'applying_for_birth_certificate');
        generateBoxes('radio', genderArray, 'gender', 'birth_certificate', bcData.gender, false, false);
        generateBoxes('radio', dateYearArray, 'date_year', 'birth_certificate', bcData.is_date_or_year, false, false);
        showSubContainer('date_year', 'birth_certificate', '.date_item', VALUE_ONE, 'radio', '.year_item', VALUE_TWO);


        if (isEdit) {
            $('#district_for_birth_certificate').val(bcData.district);
            $('#relationship_with_applicant_for_birth_certificate').val(bcData.relationship_with_applicant);
            $('#applying_for_birth_certificate').val(bcData.applying_for);

            if (bcData.applicant_photo_doc != '') {
                that.showDocument('applicant_photo_doc_container_for_birth_certificate', 'applicant_photo_doc_name_image_for_birth_certificate', 'applicant_photo_doc_name_container_for_birth_certificate',
                        'applicant_photo_doc_download', 'applicant_photo_doc', bcData.applicant_photo_doc, bcData.birth_certificate_id, VALUE_ONE);
            }
            if (bcData.birth_certi_doc != '') {
                that.showDocument('birth_certi_doc_container_for_birth_certificate', 'birth_certi_doc_name_image_for_birth_certificate', 'birth_certi_doc_name_container_for_birth_certificate',
                        'birth_certi_doc_download', 'birth_certi_doc', bcData.birth_certi_doc, bcData.birth_certificate_id, VALUE_TWO);
            }
            if (bcData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_birth_certificate', 'aadhar_card_doc_name_image_for_birth_certificate', 'aadhar_card_doc_name_container_for_birth_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', bcData.aadhar_card_doc, bcData.birth_certificate_id, VALUE_THREE);
            }
            if (bcData.old_birth_certi_doc != '') {
                that.showDocument('old_birth_certi_doc_container_for_birth_certificate', 'old_birth_certi_doc_name_image_for_birth_certificate', 'old_birth_certi_doc_name_container_for_birth_certificate',
                        'old_birth_certi_doc_download', 'old_birth_certi_doc', bcData.old_birth_certi_doc, bcData.birth_certificate_id, VALUE_FOUR);
            }
        }
        generateSelect2();
        datePicker();
        datePickerId('applicant_dob_for_birth_certificate');
        datePickerId('registration_date_for_birth_certificate');
        allowOnlyIntegerValue('mobile_number_for_birth_certificate');

        if (isEdit) {
            if (bcData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_birth_certificate').val(dateTo_DD_MM_YYYY(bcData.applicant_dob));
            }
            if (bcData.date != '0000-00-00') {
                $('#date_for_birth_certificate').val(dateTo_DD_MM_YYYY(bcData.date));
            }
            if (bcData.registration_date != '0000-00-00') {
                $('#registration_date_for_birth_certificate').val(dateTo_DD_MM_YYYY(bcData.registration_date));
            }
            if (bcData.relationship_with_applicant == VALUE_FIVE) {
                $('.other_relationship_with_applicant_div_for_birth_certificate').show();
            } else {
                $('.other_relationship_with_applicant_div_for_birth_certificate').hide();
            }
        }

        allowOnlyIntegerValue('aadhar_number_for_birth_certificate');
        allowOnlyIntegerValue('registration_year_for_birth_certificate');
        if (!isEdit) {
            $('#applicant_dob_for_birth_certificate').val('');
            $('#registration_date_for_birth_certificate').val('');
        }
        $('#birth_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitBirthCertificate(VALUE_TWO);
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', BIRTH_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", BIRTH_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'BirthCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },
    editOrViewBirthCertificate: function (btnObj, birthCertificateId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!birthCertificateId) {
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
            url: 'birth_certificate/get_birth_certificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'birth_certificate_id': birthCertificateId, 'is_edit': (isEdit ? VALUE_ZERO : VALUE_ONE)}, getTokenData()),
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
                var birthCertificateData = parseData.birth_certificate_data;
                if (isEdit) {
                    that.newBirthCertificateForm(isEdit, birthCertificateData);
                } else {
                    that.viewBirthCertificateForm(VALUE_ONE, birthCertificateData, isPrint);
                }
            }
        });
    },
    viewBirthCertificateForm: function (moduleType, birthCertificateData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        if (moduleType == VALUE_ONE) {
            BirthCertificate.router.navigate('view_birth_certificate_form');
            birthCertificateData.title = 'View';
        } else {
            birthCertificateData.show_submit_btn = true;
        }
        birthCertificateData.VALUE_THREE = VALUE_THREE;
        birthCertificateData.BIRTH_CERTIFICATE_DOC_PATH = BIRTH_CERTIFICATE_DOC_PATH;
        birthCertificateData.district_text = talukaArray[birthCertificateData.district] ? talukaArray[birthCertificateData.district] : '';
        birthCertificateData.gender_text = genderArray[birthCertificateData.gender] ? genderArray[birthCertificateData.gender] : '';
        if (birthCertificateData.relationship_with_applicant == VALUE_FIVE) {
            birthCertificateData.relationship_with_applicant_text = birthCertificateData.other_relationship_with_applicant;
        } else {
            birthCertificateData.relationship_with_applicant_text = relationStatusArray[birthCertificateData.relationship_with_applicant] ? relationStatusArray[birthCertificateData.relationship_with_applicant] : '';
        }
        birthCertificateData.applying_for_text = applyingForArray[birthCertificateData.applying_for] ? applyingForArray[birthCertificateData.applying_for] : '';
        birthCertificateData.applicant_dob_text = birthCertificateData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(birthCertificateData.applicant_dob) : '';
        birthCertificateData.death_person_dod_text = birthCertificateData.death_person_dod != '0000-00-00' ? dateTo_DD_MM_YYYY(birthCertificateData.death_person_dod) : '';
        birthCertificateData.show_applicant_photo_doc = birthCertificateData.applicant_photo_doc != '' ? true : false;
        birthCertificateData.show_birth_certi_doc = birthCertificateData.birth_certi_doc != '' ? true : false;
        birthCertificateData.show_aadhar_card_doc = birthCertificateData.aadhar_card_doc != '' ? true : false;
        birthCertificateData.show_old_birth_certi_doc = birthCertificateData.old_birth_certi_doc != '' ? true : false;
        var regDate = birthCertificateData.registration_date != '0000-00-00' ? dateTo_DD_MM_YYYY(birthCertificateData.registration_date) : '';
        var dateYear = birthCertificateData.is_date_or_year;
        var regData = dateYear == VALUE_ONE ? regDate : (dateYear == VALUE_TWO ? birthCertificateData.registration_year : (dateYear == VALUE_THREE ? 'None' : []));
        birthCertificateData.registration_details_text = regData;
        if (birthCertificateData.status != VALUE_ZERO && birthCertificateData.status != VALUE_ONE) {
            birthCertificateData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(birthCertificateViewTemplate(birthCertificateData));

        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_bcview').click();
            }, 500);
        }
    },
    checkValidationForBirthCertificate: function (moduleType, birthCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        if (!birthCertificateData.district_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('district_for_birth_certificate', selectDistrictValidationMessage);
        }
        if (!birthCertificateData.applicant_name_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_birth_certificate', applicantNameValidationMessage);
        }
        if (!birthCertificateData.mobile_number_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_birth_certificate', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(birthCertificateData.mobile_number_for_birth_certificate);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_birth_certificate', mobileMessage);
        }
        if (birthCertificateData.aadhar_number_for_birth_certificate != '') {
            var aadharNumberValidationMessage = aadharNumberValidation('birth-certificate', 'aadhar_number_for_birth_certificate');
            if (aadharNumberValidationMessage != undefined) {
                return getBasicMessageAndFieldJSONArray('aadhar_number_for_birth_certificate', invalidAadharNumberValidationMessage);
            }
        }
        if (birthCertificateData.email_for_birth_certificate != '') {
            var emailIdValidationMessage = emailIdValidation(birthCertificateData.email_for_birth_certificate);
            if (emailIdValidationMessage != '') {
                return getBasicMessageAndFieldJSONArray('email_for_birth_certificate', emailIdValidationMessage);
            }
        }
        if (!birthCertificateData.communication_address_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('communication_address_for_birth_certificate', communicationAddressValidationMessage);
        }
        if (!birthCertificateData.applicant_address_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_address_for_birth_certificate', communicationAddressValidationMessage);
        }
        if (!birthCertificateData.applicant_dob_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_birth_certificate', birthDateValidationMessage);
        }
        if (!birthCertificateData.applicant_age_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_birth_certificate', applicantAgeValidationMessage);
        }
        if (moduleType == VALUE_ONE) {
            return '';
        }
        if (!birthCertificateData.applicant_born_place_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_born_place_for_birth_certificate', applicantBornPlaceValidationMessage);
        }
        if (!birthCertificateData.gender_for_birth_certificate) {
            $('#gender_for_birth_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('gender_for_birth_certificate', genderValidationMessage);
        }
        if (!birthCertificateData.mother_name_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_birth_certificate', motherNameValidationMessage);
        }
        if (!birthCertificateData.father_name_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('father_name_for_birth_certificate', fatherNameValidationMessage);
        }
        if (!birthCertificateData.registration_number_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('registration_number_for_birth_certificate', registrationNumberValidationMessage);
        }
        if (!birthCertificateData.date_year_for_birth_certificate) {
            $('#date_year_for_birth_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('date_year_for_birth_certificate', dateYearValidationMessage);
        }
        if (birthCertificateData.date_year_for_birth_certificate == 1) {
            if (!birthCertificateData.registration_date_for_birth_certificate) {
                return getBasicMessageAndFieldJSONArray('registration_date_for_birth_certificate', registrationDateValidationMessage);
            }
        }
        if (birthCertificateData.date_year_for_birth_certificate == 2) {
            if (!birthCertificateData.registration_year_for_birth_certificate) {
                return getBasicMessageAndFieldJSONArray('registration_year_for_birth_certificate', registrationYearValidationMessage);
            }
        }
        if (!birthCertificateData.relationship_with_applicant_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('relationship_with_applicant_for_birth_certificate', relationStatusValidationMessage);
        }
        if (birthCertificateData.relationship_with_applicant_for_birth_certificate == VALUE_FIVE) {
            if (!birthCertificateData.other_relationship_with_applicant_for_birth_certificate) {
                return getBasicMessageAndFieldJSONArray('other_relationship_with_applicant_for_birth_certificate', otherRelationshipValidationMessage);
            }
        }
        if (!birthCertificateData.purpose_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('purpose_for_birth_certificate', purposeForBirthCertificateValidationMessage);
        }
        if (!birthCertificateData.applying_for_birth_certificate) {
            return getBasicMessageAndFieldJSONArray('applying_for_birth_certificate', applyingForValidationMessage);
        }

        return '';
    },
    askForSubmitBirthCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'BirthCertificate.listview.submitBirthCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitBirthCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var bcData = $('#birth_certificate_form').serializeFormJSON();
        var validationDataOne = that.checkValidationForBirthCertificate(moduleType, bcData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('birth-certificate-' + validationDataOne.field, validationDataOne.message);
            return false;
        }
        if (moduleType != VALUE_ONE) {
            if ($('#applicant_photo_doc_container_for_birth_certificate').is(':visible')) {
                var applicantPhoto = checkValidationForDocument('applicant_photo_doc_for_birth_certificate', VALUE_TWO, 'birth-certificate');
                if (applicantPhoto == false) {
                    return false;
                }
            }
            if ($('#birth_certi_doc_container_for_birth_certificate').is(':visible')) {
                var birthCertificate = checkValidationForDocument('birth_certi_doc_for_birth_certificate', VALUE_ONE, 'birth-certificate');
                if (birthCertificate == false) {
                    return false;
                }
            }
        }
        if (moduleType == VALUE_FOUR || moduleType == VALUE_FIVE) {
            var status = $('#status_for_birth_certificate').val();
            var queryStatus = $('#query_status_for_birth_certificate').val();
            if (status != VALUE_FIVE && status != VALUE_SIX && queryStatus == VALUE_ONE) {
                var qrRemarks = $('#remarks_for_birth_certificate').val();
                if (!qrRemarks) {
                    $('#remarks_for_birth_certificate').focus();
                    validationMessageShow('qrmc-remarks_for_birth_certificate', remarksValidationMessage);
                    return false;
                }
                bcData.qr_remarks = qrRemarks;
            } else {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (moduleType == VALUE_FOUR) {
                that.askForSubmitBirthCertificate(moduleType);
                return false;
            }
        }

        bcData.module_type = moduleType;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_birth_certificate') : $('#submit_btn_for_birth_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'birth_certificate/submit_birth_certificate',
            data: $.extend({}, bcData, getTokenData()),
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
                validationMessageShow('birth-certificate', textStatus.statusText);
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
                    validationMessageShow('birth-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                BirthCertificate.router.navigate('birth_certificate', {'trigger': true});
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
            $('.other_relationship_with_applicant_div_for_birth_certificate').show();
        } else {
            $('.other_relationship_with_applicant_div_for_birth_certificate').hide();
        }
    },
    askForApproveApplication: function (birthCertificateId) {
        if (!birthCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + birthCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'birth_certificate/get_birth_certificate_data_by_birth_certificate_id',
            type: 'post',
            data: $.extend({}, {'birth_certificate_id': birthCertificateId}, getTokenData()),
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
                var birthCertificateData = parseData.birth_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                $('#popup_container').html(birthCertificateApproveTemplate(birthCertificateData));
            }
        });
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_birth_certificate_form').serializeFormJSON();
        if (!formData.birth_certificate_id_for_birth_certificate_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_birth_certificate_approve) {
            $('#remarks_for_birth_certificate_approve').focus();
            validationMessageShow('birth-certificate-approve-remarks_for_birth_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_birth_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'birth_certificate/approve_application',
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
                validationMessageShow('birth-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('birth-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                BirthCertificate.listview.listPage();
            }
        });
    },
    askForRejectApplication: function (birthCertificateId) {
        if (!birthCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + birthCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'birth_certificate/get_birth_certificate_data_by_birth_certificate_id',
            type: 'post',
            data: $.extend({}, {'birth_certificate_id': birthCertificateId}, getTokenData()),
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
                var birthCertificateData = parseData.birth_certificate_data;
                showPopup();
                $('#popup_container').html(birthCertificateRejectTemplate(birthCertificateData));
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_birth_certificate_form').serializeFormJSON();
        if (!formData.birth_certificate_id_for_birth_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_birth_certificate_reject) {
            $('#remarks_for_birth_certificate_reject').focus();
            validationMessageShow('birth-certificate-reject-remarks_for_birth_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_birth_certificate_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'birth_certificate/reject_application',
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
                validationMessageShow('birth-certificate-reject', textStatus.statusText);
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
                    validationMessageShow('birth-certificate-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                BirthCertificate.listview.listPage();
            }
        });
    },
    downloadCertificate: function (birthCertificateId, moduleType) {
        if (!birthCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#birth_certificate_id_for_certificate').val(birthCertificateId);
        $('#mtype_for_certificate').val(moduleType);
        $('#birth_certificate_pdf_form').submit();
        $('#birth_certificate_id_for_certificate').val('');
        $('#mtype_for_certificate').val('');
    },
    getQueryData: function (birthCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!birthCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_NINETEEN;
        templateData.module_id = birthCertificateId;
        var btnObj = $('#query_btn_for_app_' + birthCertificateId);
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
                tmpData.module_type = VALUE_NINETEEN;
                tmpData.module_id = birthCertificateId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    downloadExcelForBC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_bcge').val($('#app_no_for_birth_certificate_list').val());
        $('#app_details_for_bcge').val($('#app_details_for_birth_certificate_list').val());
        $('#status_for_bcge').val($('#status_for_birth_certificate_list').val());
        $('#qstatus_for_bcge').val($('#query_status_for_birth_certificate_list').val());
        $('#generate_excel_for_birth_certificate').submit();
        $('.bcge').val('');
    }
});
