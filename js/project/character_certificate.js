var characterCertificateListTemplate = Handlebars.compile($('#character_certificate_list_template').html());
var characterCertificateSearchTemplate = Handlebars.compile($('#character_certificate_search_template').html());
var characterCertificateTableTemplate = Handlebars.compile($('#character_certificate_table_template').html());
var characterCertificateActionTemplate = Handlebars.compile($('#character_certificate_action_template').html());
var characterCertificateFormTemplate = Handlebars.compile($('#character_certificate_form_template').html());
var characterCertificateViewTemplate = Handlebars.compile($('#character_certificate_view_template').html());
var characterCertificateApproveTemplate = Handlebars.compile($('#character_certificate_approve_template').html());
var characterCertificateRejectTemplate = Handlebars.compile($('#character_certificate_reject_template').html());
var characterCertificateUpdateBasicDetailTemplate = Handlebars.compile($('#character_certificate_update_basic_detail_template').html());

var tempMemberCnt = 1;
var tempFamilyMemberCnt = 1;
var tempChildrenCnt = 1;
var tempPropertyCnt = 1;
var tempOtherCharacterCnt = 1;
var searchCCF = {};

var CharacterCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
CharacterCertificate.Router = Backbone.Router.extend({
    routes: {
        'character_certificate': 'renderList',
        'character_certificate_form': 'renderList',
        'edit_character_certificate_form': 'renderList',
        'view_character_certificate_form': 'renderList',
    },
    renderList: function () {
        CharacterCertificate.listview.listPage();
    },
});
CharacterCertificate.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_LDC_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_SDPO_USER && tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_certificates');
        addClass('menu_character_certificate', 'active');
        CharacterCertificate.router.navigate('character_certificate');
        var templateData = {};
        searchCCF = {};
        this.$el.html(characterCertificateListTemplate(templateData));
        this.loadCharacterCertificateData(sDistrict, sType);

    },
    actionRenderer: function (rowData) {
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) && rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX) {
            //rowData.show_edit_btn = true;
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_form_one_btn = true;
        }
        rowData.status = parseInt(rowData.status);
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) &&
                rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX &&
                (rowData.query_status == VALUE_ZERO || rowData.query_status == VALUE_THREE) && (rowData.mamlatdar_to_sdpo != VALUE_ZERO && rowData.sdpo_status != VALUE_ZERO)) {
            if (rowData.basic_detail_status == VALUE_ZERO) {
                rowData.show_reject_btn = 'display: none;';
            } else {
                rowData.show_reject_btn = '';
            }
        } else {
            rowData.show_reject_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) &&
                (rowData.status == VALUE_TWO) && (rowData.query_status == VALUE_ZERO ||
                rowData.query_status == VALUE_THREE) && (rowData.mamlatdar_to_sdpo != VALUE_ZERO && rowData.sdpo_status != VALUE_ZERO)) {
            rowData.show_approve_btn = '';
        } else {
            rowData.show_approve_btn = 'display: none;';
        }

        rowData.module_type = VALUE_TEN;
        if (rowData.status == VALUE_FIVE) {
            rowData.download_certificate_style = '';
        } else {
            rowData.download_certificate_style = 'display: none;';
        }
        rowData.show_movement_btn = 'display: none;';
        if (rowData.status == VALUE_FIVE || rowData.status == VALUE_SIX) {
            rowData.show_forward_btn = false;
            rowData.show_movement_btn = '';
        } else {
            rowData.show_forward_btn = true;
        }
        return characterCertificateActionTemplate(rowData);
    },
    loadCharacterCertificateData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        
        var that = this;
        CharacterCertificate.router.navigate('character_certificate');
        var searchData = dtomMam(sDistrict, sType, 'CharacterCertificate.listview.loadCharacterCertificateData();');
        $('#character_certificate_form_and_datatable_container').html(characterCertificateSearchTemplate(searchData));
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(currentlyOnTypeArray, 'currently_on_for_character_certificate_list', false);
        }
        
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_character_certificate_list', false);
        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_character_certificate_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_character_certificate_list', false);
        datePickerId('application_date_for_character_certificate_list');
        
        $('#app_no_for_character_certificate_list').val((typeof searchCCF.app_no_for_character_certificate_list != "undefined" && searchCCF.app_no_for_character_certificate_list != '') ? searchCCF.app_no_for_character_certificate_list : '');
        $('#application_date_for_character_certificate_list').val((typeof searchCCF.application_date_for_character_certificate_list != "undefined" && searchCCF.application_date_for_character_certificate_list != '') ? searchCCF.application_date_for_character_certificate_list : searchData.s_appd);
        $('#app_details_for_character_certificate_list').val((typeof searchCCF.app_details_for_character_certificate_list != "undefined" && searchCCF.app_details_for_character_certificate_list != '') ? searchCCF.app_details_for_character_certificate_list : '');
        $('#query_status_for_character_certificate_list').val((typeof searchCCF.query_status_for_character_certificate_list != "undefined" && searchCCF.query_status_for_character_certificate_list != '') ? searchCCF.query_status_for_character_certificate_list : searchData.s_qstatus);
        $('#status_for_character_certificate_list').val((typeof searchCCF.status_for_character_certificate_list != "undefined" && searchCCF.status_for_character_certificate_list != '') ? searchCCF.status_for_character_certificate_list : searchData.s_status);
        $('#district_for_character_certificate_list').val((typeof searchCCF.district_for_character_certificate_list != "undefined" && searchCCF.district_for_character_certificate_list != '') ? searchCCF.district_for_character_certificate_list : searchData.search_district);
        //$('#vdw_for_character_certificate_list').val((typeof searchCCF.vdw_for_character_certificate_list != "undefined" && searchCCF.vdw_for_character_certificate_list != '') ? searchCCF.vdw_for_character_certificate_list : '');
        $('#is_full_for_character_certificate_list').val((typeof searchCCF.is_full_for_character_certificate_list != "undefined" && searchCCF.is_full_for_character_certificate_list != '') ? searchCCF.is_full_for_character_certificate_list : searchData.s_is_full);
        
        this.searchCharacterCertificateData();
        
    },
    searchCharacterCertificateData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#character_certificate_datatable_container').html(characterCertificateTableTemplate);
        var searchData = $('#search_character_certificate_form').serializeFormJSON();

        searchCCF = searchData;
        if (typeof btnObj == "undefined" && (searchCCF.app_details_for_character_certificate_list == '' 
                && searchCCF.app_no_for_character_certificate_list == '' 
                && searchCCF.application_date_for_character_certificate_list == '' 
                && searchCCF.query_status_for_character_certificate_list == '' 
                && searchCCF.status_for_character_certificate_list == '' 
                && searchCCF.is_full_for_character_certificate_list == ''
                && (searchCCF.district_for_character_certificate_list == '' || typeof searchCCF.district_for_character_certificate_list == "undefined"))){
                //&& (searchCCF.vdw_for_character_certificate_list == '' || typeof searchCCF.vdw_for_character_certificate_list == "undefined"))) {
            characterCertificateDataTable = $('#character_certificate_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#character_certificate_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.com_addr_house_no + ',' + full.com_addr_house_name + ',' + full.com_addr_street + ',' + full.com_addr_village_dmc_ward + ',' + full.com_addr_city + ',' + full.com_pincode + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? damanVillagesArray : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '');
        };
        var movementRenderer = function (data, type, full, meta) {
            return '<div id="movement_for_ic_list_' + data + '">' + movementStringForCharacterCertificate(full) + '</div>';
        };
        $('#character_certificate_datatable_container').html(characterCertificateTableTemplate);
        characterCertificateDataTable = $('#character_certificate_datatable').DataTable({
            ajax: {url: 'character_certificate/get_character_certificate_data',dataSrc: "character_certificate_data",type: "post", data: searchData},
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
                {data: 'character_certificate_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'character_certificate_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'character_certificate_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#character_certificate_datatable_filter').remove();
        $('#character_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = characterCertificateDataTable.row(tr);

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
    newCharacterCertificateForm: function (isEdit, characterCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            CharacterCertificate.router.navigate('edit_character_certificate_form');
        } else {
            CharacterCertificate.router.navigate('character_certificate_form');
        }
        tempMemberCnt = 1;
        tempFamilyMemberCnt = 1;
        tempChildrenCnt = 1;
        tempPropertyCnt = 1;
        tempOtherIncomeCnt = 1;
        characterCertificateData.VALUE_ONE = VALUE_ONE;
        characterCertificateData.VALUE_TWO = VALUE_TWO;
        characterCertificateData.is_checked = isChecked;
        characterCertificateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#character_certificate_form_and_datatable_container').html(characterCertificateFormTemplate(characterCertificateData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_character_certificate');
        var district = characterCertificateData.district;

        if (isEdit) {
            $('#district_for_character_certificate').val(characterCertificateData.district);
            if (characterCertificateData.billingtoo == isChecked) {
                $('#billingtoo_for_character_certificate').attr('checked', 'checked');
            }

            if (characterCertificateData.birth_leaving_certy_doc != '') {
                that.showDocument('birth_leaving_certy_doc_container_for_character_certificate', 'birth_leaving_certy_doc_name_image_for_character_certificate', 'birth_leaving_certy_doc_name_container_for_character_certificate',
                        'birth_leaving_certy_doc_download', 'birth_leaving_certy_doc', characterCertificateData.birth_leaving_certy_doc, characterCertificateData.character_certificate_id, VALUE_ONE);
            }
            if (characterCertificateData.aadhar_card_doc != '') {
                that.showDocument('aadhar_card_doc_container_for_character_certificate', 'aadhar_card_doc_name_image_for_character_certificate', 'aadhar_card_doc_name_container_for_character_certificate',
                        'aadhar_card_doc_download', 'aadhar_card_doc', characterCertificateData.aadhar_card_doc, characterCertificateData.character_certificate_id, VALUE_TWO);
            }
        }
        generateSelect2();
        //datePicker();
        datePickerToday('applicant_dob_for_character_certificate');
        if (!isEdit) {
            $('#applicant_dob_for_character_certificate').val('');
        }
        if (isEdit) {
            if (characterCertificateData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_character_certificate').val(dateTo_DD_MM_YYYY(characterCertificateData.applicant_dob));
            }
        }
        $('#character_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitCharacterCertificate(VALUE_ONE);
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', CHARACTER_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", CHARACTER_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'CharacterCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },
    editOrViewCharacterCertificate: function (btnObj, characterCertificateId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!characterCertificateId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'character_certificate/get_character_certificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'character_certificate_id': characterCertificateId}, getTokenData()),
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
                var characterCertificateData = parseData.character_certificate_data;
                if (isEdit) {
                    that.newCharacterCertificateForm(characterCertificateData);
                } else {
                    that.viewCharacterCertificateForm(VALUE_ONE, characterCertificateData);
                }
            }
        });
    },
    viewCharacterCertificateForm: function (moduleType, characterCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        if (moduleType == VALUE_ONE) {
            CharacterCertificate.router.navigate('view_character_certificate_form');
            characterCertificateData.title = 'View';
        } else {
            characterCertificateData.show_submit_btn = true;
        }
        characterCertificateData.VALUE_THREE = VALUE_THREE;
        characterCertificateData.district_text = talukaArray[characterCertificateData.district] ? talukaArray[characterCertificateData.district] : '';
        var district = characterCertificateData.district;
        characterCertificateData.CHARACTER_CERTIFICATE_DOC_PATH = CHARACTER_CERTIFICATE_DOC_PATH;
        characterCertificateData.applicant_dob_text = characterCertificateData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(characterCertificateData.applicant_dob) : '';
        characterCertificateData.show_birth_leaving_certy_doc = characterCertificateData.birth_certi != '' ? true : false;
        characterCertificateData.show_aadhar_card_doc = characterCertificateData.aadhaar_card != '' ? true : false;
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(characterCertificateViewTemplate(characterCertificateData));
    },

    askForSubmitCharacterCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'CharacterCertificate.listview.submitCharacterCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    checkValidationForCharacterCertificate: function (characterCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!characterCertificateData.district_for_character_certificate) {
            return getBasicMessageAndFieldJSONArray('district_for_character_certificate', selectDistrictValidationMessage);
        }
        if (!characterCertificateData.applicant_name) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_character_certificate', applicantNameValidationMessage);
        }
        if (!characterCertificateData.com_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('com_addr_house_no_for_character_certificate', houseNoValidationMessage);
        }
        if (!characterCertificateData.com_addr_house_name) {
            return getBasicMessageAndFieldJSONArray('com_addr_house_name_for_character_certificate', houseNameValidationMessage);
        }
        if (!characterCertificateData.com_addr_street) {
            return getBasicMessageAndFieldJSONArray('com_addr_street_for_character_certificate', streetValidationMessage);
        }
        if (!characterCertificateData.com_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('com_addr_village_dmc_ward_for_character_certificate', villageNameValidationMessage);
        }
        if (!characterCertificateData.com_addr_city) {
            return getBasicMessageAndFieldJSONArray('com_addr_city_for_character_certificate', selectCityValidationMessage);
        }
        if (!characterCertificateData.com_pincode) {
            return getBasicMessageAndFieldJSONArray('com_pincode_for_character_certificate', pincodeValidationMessage);
        }
        if (!characterCertificateData.per_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('per_addr_house_no_for_character_certificate', houseNoValidationMessage);
        }
        if (!characterCertificateData.per_addr_house_name) {
            return getBasicMessageAndFieldJSONArray('per_addr_house_name_for_character_certificate', houseNameValidationMessage);
        }
        if (!characterCertificateData.per_addr_street) {
            return getBasicMessageAndFieldJSONArray('per_addr_street_for_character_certificate', streetValidationMessage);
        }
        if (!characterCertificateData.per_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('per_addr_village_dmc_ward_for_character_certificate', villageNameValidationMessage);
        }
        if (!characterCertificateData.per_addr_city) {
            return getBasicMessageAndFieldJSONArray('per_addr_city_for_character_certificate', selectCityValidationMessage);
        }
        if (!characterCertificateData.per_pincode) {
            return getBasicMessageAndFieldJSONArray('per_pincode_for_character_certificate', pincodeValidationMessage);
        }
        if (!characterCertificateData.applicant_dob) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_character_certificate', birthDateValidationMessage);
        }
        if (!characterCertificateData.applicant_age) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_character_certificate', applicantAgeValidationMessage);
        }
        if (!characterCertificateData.father_name) {
            return getBasicMessageAndFieldJSONArray('father_name_for_character_certificate', fatherNameValidationMessage);
        }
        if (!characterCertificateData.mother_name) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_character_certificate', motherNameValidationMessage);
        }
        if (!characterCertificateData.purpose) {
            return getBasicMessageAndFieldJSONArray('purpose_for_character_certificate', purposeofDomicileValidationMessage);
        }

        return '';
    },

    submitCharacterCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var characterCertificateData = $('#character_certificate_form').serializeFormJSON();
        var validationDataOne = that.checkValidationForCharacterCertificate(characterCertificateData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('character-certificate-' + validationDataOne.field, validationDataOne.message);
            return false;
        }

        characterCertificateData.module_type = moduleType;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_character_certificate') : (moduleType == VALUE_TWO ? $('#submit_btn_for_character_certificate') : $('#fsubmit_btn_for_character_certificate'));
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'character_certificate/submit_character_certificate',
            data: $.extend({}, characterCertificateData, getTokenData()),
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
                validationMessageShow('character-certificate', textStatus.statusText);
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
                    validationMessageShow('character-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    that.viewCharacterCertificateForm(moduleType, parseData.new_cc_data);
                    return false;
                }
                showSuccess(parseData.message);
                CharacterCertificate.router.navigate('character_certificate', {'trigger': true});
            }
        });
    },
    FillBilling: function () {
        if ($("#billingtoo_for_character_certificate").is(":checked")) {
            $('#per_addr_house_no_for_character_certificate').val($('#com_addr_house_no_for_character_certificate').val());
            $('#per_addr_house_name_for_character_certificate').val($('#com_addr_house_name_for_character_certificate').val());
            $('#per_addr_street_for_character_certificate').val($('#com_addr_street_for_character_certificate').val());
            $('#per_addr_village_dmc_ward_for_character_certificate').val($('#com_addr_village_dmc_ward_for_character_certificate').val());
            $('#per_addr_city_for_character_certificate').val($('#com_addr_city_for_character_certificate').val());
            $('#per_pincode_for_character_certificate').val($('#com_pincode_for_character_certificate').val());
        } else {
            $('#per_addr_house_no_for_character_certificate').val('');
            $('#per_addr_house_name_for_character_certificate').val('');
            $('#per_addr_street_for_character_certificate').val('');
            $('#per_addr_village_dmc_ward_for_character_certificate').val('');
            $('#per_addr_city_for_character_certificate').val('');
            $('#per_pincode_for_character_certificate').val();
        }
        generateSelect2();
    },

    askForApproveApplication: function (characterCertificateId) {
        if (!characterCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + characterCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'character_certificate/get_character_certificate_data_by_character_certificate_id',
            type: 'post',
            data: $.extend({}, {'character_certificate_id': characterCertificateId}, getTokenData()),
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
                var characterCertificateData = parseData.character_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                var icData = that.getBasicConfigurationForMovement(characterCertificateData);
                $('#popup_container').html(characterCertificateApproveTemplate(icData));
                $('#inquiry_copy_name_container_for_sdpo').show();
                $('#inquiry_copy_name_href_for_sdpo').attr('href', 'documents/character_certificate/' + characterCertificateData.inquiry_copy);
                $('#inquiry_copy_name_for_sdpo').html(characterCertificateData.inquiry_copy);
                $('#inquiry_copy_remove_btn_for_sdpo').attr('onclick', 'CharacterCertificate.listview.removeUploadDoc("' + characterCertificateData.character_certificate_id + '")');
                datePicker();
            }
        });
    },
    getBasicConfigurationForMovement: function (characterCertificateData) {
        characterCertificateData.ldc_to_mamlatdar_datetime_text = characterCertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(characterCertificateData.ldc_to_mamlatdar_datetime) : '';
        characterCertificateData.mamlatdar_to_sdpo_datetime_text = characterCertificateData.mamlatdar_to_sdpo_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(characterCertificateData.mamlatdar_to_sdpo_datetime) : '';
        return characterCertificateData;
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_character_certificate_form').serializeFormJSON();
        if (!formData.character_certificate_id_for_character_certificate_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_character_certificate_approve) {
            $('#remarks_for_character_certificate_approve').focus();
            validationMessageShow('character-certificate-approve-remarks_for_character_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_character_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'character_certificate/approve_application',
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
                validationMessageShow('character-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('character-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                CharacterCertificate.listview.loadCharacterCertificateData();
            }
        });
    },
    askForRejectApplication: function (characterCertificateId) {
        if (!characterCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + characterCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'character_certificate/get_character_certificate_data_by_character_certificate_id',
            type: 'post',
            data: $.extend({}, {'character_certificate_id': characterCertificateId}, getTokenData()),
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
                var characterCertificateData = parseData.character_certificate_data;
                showPopup();
                var icData = that.getBasicConfigurationForMovement(characterCertificateData);
                $('#popup_container').html(characterCertificateRejectTemplate(icData));
                $('#inquiry_copy_name_container_for_sdpo').show();
                $('#inquiry_copy_name_href_for_sdpo').attr('href', 'documents/character_certificate/' + characterCertificateData.inquiry_copy);
                $('#inquiry_copy_name_for_sdpo').html(characterCertificateData.inquiry_copy);
                $('#inquiry_copy_remove_btn_for_sdpo').attr('onclick', 'CharacterCertificate.listview.removeUploadDoc("' + characterCertificateData.character_certificate_id + '")');
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_character_certificate_form').serializeFormJSON();
        if (!formData.character_certificate_id_for_character_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_character_certificate_reject) {
            $('#remarks_for_character_certificate_reject').focus();
            validationMessageShow('character-certificate-reject-remarks_for_character_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_character_certificate_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'character_certificate/reject_application',
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
                validationMessageShow('character-certificate-reject', textStatus.statusText);
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
                    validationMessageShow('character-certificate-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                CharacterCertificate.listview.loadCharacterCertificateData();
            }
        });
    },
    downloadCertificate: function (characterCertificateId) {
        if (!characterCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#character_certificate_id_for_certificate').val(characterCertificateId);
        $('#character_certificate_pdf_form').submit();
        $('#character_certificate_id_for_certificate').val('');
    },

    getQueryData: function (characterCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!characterCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_TEN;
        templateData.module_id = characterCertificateId;
        var btnObj = $('#query_btn_for_app_' + characterCertificateId);
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
                tmpData.module_type = VALUE_TEN;
                tmpData.module_id = characterCertificateId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },

    updateBasicDetails: function (btnObj, characterCertificateId) {
        if (!characterCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_LDC_USER && tempTypeInSession != TEMP_TYPE_SDPO_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'character_certificate/get_update_basic_detail_data_by_character_certificate_id',
            type: 'post',
            data: $.extend({}, {'character_certificate_id': characterCertificateId}, getTokenData()),
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
                showPopup();
                if (basicDetailData == null) {
                    basicDetailData = {};
                }
                //basicDetailData.show_submit_btn = true;

                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                    basicDetailData.show_ldc_enter_basic_details = true;
                    basicDetailData.show_submit_btn = true;
                }
                // if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                //         tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.sdpo_to_ldc_to_mamlatdar == VALUE_ZERO) {
                //     basicDetailData.show_ldc_enter_basic_details = true;
                //     basicDetailData.show_submit_btn = true;
                // }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO) {
                    basicDetailData.show_ldc_updated_basic_details = true;
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.mamlatdar_to_sdpo == VALUE_ZERO) {
                    basicDetailData.show_mamlatdar_enter_basic_details = true;
                    basicDetailData.show_submit_btn = true;
                }
                if (basicDetailData.mamlatdar_to_sdpo != VALUE_ZERO) {
                    basicDetailData.show_mamlatdar_updated_basic_details = true;
                    basicDetailData.mamlatdar_to_sdpo_datetime_text = basicDetailData.mamlatdar_to_sdpo_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.mamlatdar_to_sdpo_datetime) : '';
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_SDPO_USER && (basicDetailData.mamlatdar_to_sdpo != VALUE_ZERO && basicDetailData.sdpo_status == VALUE_ZERO)) {
                    basicDetailData.show_sdpo_enter_basic_details = true;
                    basicDetailData.show_submit_btn = true;
                }
                if (basicDetailData.mamlatdar_to_sdpo != VALUE_ZERO && basicDetailData.sdpo_status != VALUE_ZERO && basicDetailData.inquiry_copy != '') {
                    basicDetailData.show_sdpo_updated_basic_details = true;
                    basicDetailData.show_remove_upload_btn = true;
                }
                if (basicDetailData.status == VALUE_FIVE || basicDetailData.status == VALUE_SIX) {
                    basicDetailData.title = 'Movement Details of Character Certificate Form';
                } else {
                    basicDetailData.title = 'Forward For Approval';
                }

                $('#popup_container').html(characterCertificateUpdateBasicDetailTemplate(basicDetailData));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'ldc_to_mamlatdar_for_character_certificate', 'sa_user_id', 'name', '', false);
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.sdpo_data, 'mamlatdar_to_sdpo_for_character_certificate', 'sa_user_id', 'name', '', false);
                // renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'sdpo_to_ldc_for_character_certificate', 'sa_user_id', 'name', '', false);
                $('#inquiry_copy_name_container_for_sdpo').show();
                $('#inquiry_copy_name_href_for_sdpo').attr('href', 'documents/character_certificate/' + basicDetailData.inquiry_copy);
                $('#inquiry_copy_name_for_sdpo').html(basicDetailData.inquiry_copy);
                $('#inquiry_copy_remove_btn_for_sdpo').attr('onclick', 'CharacterCertificate.listview.removeUploadDoc("' + basicDetailData.character_certificate_id + '")');
            }
        });
    },
    submitBasicDetail: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_LDC_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_SDPO_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_character_certificate_form').serializeFormJSON();
        if (!formData.character_certificate_id_for_character_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            if (!formData.ldc_to_mamlatdar_remarks_for_character_certificate) {
                $('#ldc_to_mamlatdar_remarks_for_character_certificate').focus();
                validationMessageShow('character-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_character_certificate', remarksValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_for_character_certificate) {
                $('#ldc_to_mamlatdar_for_character_certificate').focus();
                validationMessageShow('character-certificate-update-basic-detail-ldc_to_mamlatdar_for_character_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if (!formData.mamlatdar_to_sdpo_remarks_for_character_certificate) {
                $('#mamlatdar_to_sdpo_remarks_for_character_certificate').focus();
                validationMessageShow('character-certificate-update-basic-detail-mamlatdar_to_sdpo_remarks_for_character_certificate', remarksValidationMessage);
                return false;
            }
            if (!formData.mamlatdar_to_sdpo_for_character_certificate) {
                $('#mamlatdar_to_sdpo_for_character_certificate').focus();
                validationMessageShow('character-certificate-update-basic-detail-mamlatdar_to_sdpo_for_character_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SDPO_USER) {
            if ($('#inquiry_copy_container_for_sdpo').is(':visible')) {
                var sealAndStamp = $('#inquiry_copy_for_sdpo').val();
                if (sealAndStamp == '') {
                    $('#inquiry_copy_for_sdpo').focus();
                    validationMessageShow('character-certificate-uc-inquiry_copy_for_sdpo', uploadDocumentValidationMessage);
                    return false;
                }
                var sdpoCopyMessage = fileUploadValidation('inquiry_copy_for_sdpo', 2048);
                if (sdpoCopyMessage != '') {
                    $('#inquiry_copy_for_sdpo').focus();
                    validationMessageShow('character-certificate-uc-inquiry_copy_for_sdpo', challanMessage);
                    return false;
                }
            }
        }

        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');

        var newFormData = new FormData($('#update_basic_detail_character_certificate_form')[0]);
        newFormData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        $.ajax({
            type: 'POST',
            url: 'character_certificate/forward_to',
            data: newFormData,
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
                validationMessageShow('character-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('character-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#movement_for_ic_list_' + parseData.character_certificate_id).html(movementStringForCharacterCertificate(parseData.character_certificate_data));
            }
        });
    },
    applicationPDF: function (characterCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!characterCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#character_certificate_id_for_app_pdf').val(characterCertificateId);
        $('#character_certificate_document_for_app_pdf').submit();
        $('#character_certificate_id_for_app_pdf').val('');
    },
    issueOfCharacterCertificate: function (characterCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!characterCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#character_certificate_id_for_issue_of_cc').val(characterCertificateId);
        $('#character_certificate_document_for_issue_of_cc').submit();
        $('#character_certificate_id_for_issue_of_cc').val('');
    },
    downloadExcelForCC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_ccge').val($('#app_no_for_character_certificate_list').val());
        $('#app_date_for_ccge').val($('#application_date_for_character_certificate_list').val());
        $('#app_details_for_ccge').val($('#app_details_for_character_certificate_list').val());
        $('#vdw_for_ccge').val(tempTypeInSession != TEMP_TYPE_A ? $('#vdw_for_character_certificate_list').val() : '');
        $('#status_for_ccge').val($('#status_for_character_certificate_list').val());
        $('#qstatus_for_ccge').val($('#query_status_for_character_certificate_list').val());
        $('#currently_on_for_ccge').val($('#currently_on_for_character_certificate_list').val());
        $('#generate_excel_for_character_certificate').submit();
        $('.ccge').val('');
    },
});
