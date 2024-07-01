var dapvrCaseListTemplate = Handlebars.compile($('#dapvr_case_list_template').html());
var dapvrCaseTableTemplate = Handlebars.compile($('#dapvr_case_table_template').html());
var dapvrCaseActionTemplate = Handlebars.compile($('#dapvr_case_action_template').html());
var dapvrCaseFormTemplate = Handlebars.compile($('#dapvr_case_form_template').html());
var dapvrCasePetitionerInfoTemplate = Handlebars.compile($('#dapvr_case_petitioner_info_template').html());
var dapvrCaseRespondentInfoTemplate = Handlebars.compile($('#dapvr_case_respondent_info_template').html());
var dapvrCaseLandDetailsTemplate = Handlebars.compile($('#dapvr_case_land_details_template').html());
var dapvrCaseViewTemplate = Handlebars.compile($('#dapvr_case_view_template').html());
var dapvrCaseLDViewTemplate = Handlebars.compile($('#dapvr_case_ld_view_template').html());
var dapvrCaseSetHearingDateTemplate = Handlebars.compile($('#dapvr_case_set_hearing_date_template').html());
var dapvrCaseUploadOrderTemplate = Handlebars.compile($('#dapvr_case_order_template').html());
var dapvrCaseJudgementTemplate = Handlebars.compile($('#dapvr_case_judgement_template').html());
var dapvrCaseUpdateBasicDetailTemplate = Handlebars.compile($('#dapvr_case_update_basic_detail_template').html());
var dapvrCaseAddAdvocateTemplate = Handlebars.compile($('#dapvr_case_add_advocate_template').html());
var tempPetitionerCnt = 1;
var tempRespondentCnt = 1;
var tempLDCnt = 1;
var tempAdvocateList = [];
var DAPVRCase = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
DAPVRCase.Router = Backbone.Router.extend({
    routes: {
        'dapvr_case': 'renderList',
        'dapvr_case_form': 'renderList',
        'edit_dapvr_case_form': 'renderList',
        'view_dapvr_case_form': 'renderList',
        'dapvr_dashboard_form': 'renderDashboard',
    },
    renderList: function () {
        DAPVRCase.listview.listPage();
    },
    renderDashboard: function () {
        DAPVRCase.listview.listPage();
    },
    renderListForForm: function () {
        DAPVRCase.listview.listPageDapvrCaseForm();
    }
});
DAPVRCase.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sStatus, sMonthStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        if (typeof sMonthStatus === "undefined") {
            sMonthStatus = '';
        }
        activeLink('menu_mamlatdar');
        addClass('mam_dapvr_case', 'active');
        DAPVRCase.router.navigate('dapvr_dashboard_form');
        var templateData = {};
        this.$el.html(dapvrCaseListTemplate(templateData));
        this.loadDapvrCaseData(sStatus, sMonthStatus);
    },
    listPageDapvrCaseForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('mam_dapvr_case', 'active');
        this.$el.html(dapvrCaseListTemplate);
        this.newDapvrCaseForm(false, {}, {});
    },
    actionRenderer: function (rowData) {
        if (tempTypeInSession == TEMP_TYPE_MAM_VIEW_USER) {
            return dapvrCaseActionTemplate(rowData);
        }
        if (rowData.status == VALUE_ONE || rowData.status == VALUE_FOUR || rowData.status == VALUE_FIVE) {
            rowData.show_hearing_btn = false;
        } else {
            rowData.show_hearing_btn = true;
        }
        if (rowData.status == VALUE_FOUR || rowData.status == VALUE_FIVE) {
            rowData.show_edit_btn = false;
        } else {
            rowData.show_edit_btn = true;
        }
        if (rowData.status == VALUE_THREE || rowData.status == VALUE_FOUR || rowData.status == VALUE_FIVE) {

            rowData.show_judgement_btn = true;
        } else {
            rowData.show_judgement_btn = false;
        }
        if (rowData.status == VALUE_FOUR || rowData.status == VALUE_FIVE) {
            rowData.show_order_btn = true;
        } else {
            rowData.show_order_btn = false;
        }
        rowData.show_forward_btn = true;
        if (rowData.next_hearing_date == '0000-00-00') {
//            console.log(rowData.next_hearing_date);
            rowData.show_forward_btn = true;
        }
        return dapvrCaseActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        if (appointmentData.next_hearing_date == '0000-00-00') {
            return '<span class="badge bg-warning app-status">Hearing Date Not Set Yet</span>';
        } else {
            var returnString = '<span class="badge bg-success app-status">Next Hearing Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.next_hearing_date);
        }
        if (appointmentData.status == VALUE_FOUR) {
            var returnString = '<span class="badge bg-warning app-status">Last Hearing Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.next_hearing_date);
        }
        return returnString;
    },
    loadDapvrCaseData: function (sStatus, sMonthStatus) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        var CaseYearRenderer = function (data, type, full, meta) {
            var CaseYearData = caseyearArray[data] ? caseyearArray[data] : '';
            return CaseYearData;
        };
        var CaseTypeRenderer = function (data, type, full, meta) {
            var CaseTypeData = CaseTypeArray[data] ? CaseTypeArray[data] : '';
            return CaseTypeData;
        };
        var PetitionerNameRenderer = function (data, type, full, meta) {
            var pet_name;
            var petitionerdata = JSON.parse(full.petitioner_details);
            $.each(petitionerdata, function (index, pr) {
                if (index != 0)
                {
                    pet_name += ',' + pr.pet_name;
                } else
                {
                    pet_name = pr.pet_name;
                }
                //pet_name += (index != 0 ? ',' : '') + pr.pet_name;               
            });
            return pet_name;
        };
        var RespondentNameRenderer = function (data, type, full, meta) {
            var res_name;
            var respondentdata = JSON.parse(full.respondent_details);
            $.each(respondentdata, function (index, rs) {
                if (index != 0)
                {
                    res_name += ',' + rs.res_name;
                } else
                {
                    res_name = rs.res_name;
                }
            });
            return res_name;
        };
        var movementRenderer = function (data, type, full, meta) {
            return '<div id="movement_for_ic_list_' + data + '">' + casemovementString(full) + '</div>';
        };
        var hearingRenderer = function (data, type, full, meta) {
            return '<div id="appointment_container_' + data + '">' + that.getAppointmentData(full) + '</div>';
        };
        var searchData = dashboardNaviationToDAPVR(sStatus, sMonthStatus);
        DAPVRCase.router.navigate('dapvr_case');
        $('#dapvr_case_form_and_datatable_container').html(dapvrCaseTableTemplate(searchData));
        dapvrCaseDataTable = $('#dapvr_case_datatable').DataTable({
            ajax: {url: 'dapvr_case/get_dapvr_case_data', dataSrc: "dapvr_case_data", type: "post",
                data: $.extend({}, searchData, getTokenData())},
            bAutoWidth: false,
            pageLength: 10,
            //ordering: false,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'v-a-m text-center', 'orderable': false},
                {data: 'case_no', 'class': 'v-a-m text-center f-w-b'},
                {data: 'register_date', 'class': 'v-a-m text-center', render: dateRenderer},
                {data: 'case_type', 'class': 'v-a-m text-center f-w-b', 'render': CaseTypeRenderer, 'orderable': false},
                {data: 'year', 'class': 'v-a-m text-center f-w-b', 'render': CaseYearRenderer, 'orderable': false},
                {data: '', 'class': 'v-a-m text-center f-w-b', 'render': PetitionerNameRenderer, 'orderable': false},
                {data: '', 'class': 'v-a-m text-center f-w-b', 'render': RespondentNameRenderer, 'orderable': false},
//                {data: 'case_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'case_id', 'class': 'v-a-t text-center', 'render': hearingRenderer},
                {data: 'case_id', 'class': 'v-a-t text-center', 'render': caseStatusRenderer, 'orderable': false},
                {'class': 'v-a-m details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
        $('#dapvr_case_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = dapvrCaseDataTable.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(that.actionRenderer(row.data())).show();
                tr.addClass('shown');
            }
        });
    },
    askForNewDapvrCaseForm: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dapvr_case/get_advocate_list_for_dapvr_case',
            type: 'post',
            data: getTokenData(),
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
                tempAdvocateList = parseData.advocate_list_data;
                that.newDapvrCaseForm(false, {}, []);
            }
        });
    },
    newDapvrCaseForm: function (isEdit, dapvrCaseData, landData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            DAPVRCase.router.navigate('edit_dapvr_case_form');
        } else {
            dapvrCaseData.register_date_text = dateTo_DD_MM_YYYY();
            DAPVRCase.router.navigate('dapvr_case_form');
        }
        if (isEdit) {
            dapvrCaseData.register_date_text = dapvrCaseData.register_date != '0000-00-00' ? dateTo_DD_MM_YYYY(dapvrCaseData.register_date) : '';
        } else {
        }

        $('#dapvr_case_form_and_datatable_container').html(dapvrCaseFormTemplate(dapvrCaseData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_dapvr_case');
        renderOptionsForTwoDimensionalArray(CaseResponseTypeArray, 'response_type_for_dapvr_case');
        renderOptionsForTwoDimensionalArray(CaseTypeArray, 'case_type_for_dapvr_case');
        renderOptionsForTwoDimensionalArray(caseyearArray, 'case_year_for_dapvr_case');
        renderOptionsForTwoDimensionalArray(casestatus2Array, 'case_status_for_dapvr_case');
        $("#district_for_dapvr_case option[value='" + VALUE_THREE + "']").remove();
        $("#district_for_dapvr_case option[value='" + VALUE_TWO + "']").remove();
        if (isEdit) {
            $('#district_for_dapvr_case').val(dapvrCaseData.district);
            $('#response_type_for_dapvr_case').val(dapvrCaseData.case_response_type);
            $('#case_type_for_dapvr_case').val(dapvrCaseData.case_type);
            $('#case_year_for_dapvr_case').val(dapvrCaseData.year);
            $('#case_status_for_dapvr_case').val(dapvrCaseData.case_status);

            if (landData.length == VALUE_ZERO) {
                that.addMoreLandDetails({}, true);
            } else {
                $.each(landData, function (key, ldData) {
                    that.addMoreLandDetails(ldData, true);
                });
            }
            var cntpet = 1;
            if (dapvrCaseData.petitioner_details != '') {
                var petitionerDetails = JSON.parse(dapvrCaseData.petitioner_details);
                $.each(petitionerDetails, function (key, value) {
                    that.addMorepetitioner(value, true);
                    cntpet++;
                });
            }
            var cntres = 1;
            if (dapvrCaseData.respondent_details != '') {
                var respondentDetails = JSON.parse(dapvrCaseData.respondent_details);
                $.each(respondentDetails, function (key, value) {
                    that.addMoreRespondent(value, true);
                    cntres++;
                });
            }
        } else {
            that.addMoreRespondent({}, true);
            that.addMorepetitioner({}, true);
            that.addMoreLandDetails({}, true);
        }
        generateSelect2();
        datePickerToday('register_date_for_dapvr_case');
        $('#dapvr_case_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitdapvrCase($('#draft_btn_for_dapvr_case'));
            }
        });
    },
    caseyearChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var caseyear = obj.val();
        if (caseyear == 42 || caseyear == 43 || caseyear == 44 || caseyear == 45) {
            $('#div_case_no_for_dapvr_case').hide();
        } else {
            $('#div_case_no_for_dapvr_case').show();
        }
        addTagSpinner(caseyear);
    },
    addMoreLandDetails: function (landDetails, showRemoveBtn) {
        if (showRemoveBtn) {
            landDetails.show_remove_btn = true;
        } else {
            landDetails.readonly = 'readonly';
        }
        landDetails.ld_cnt = tempLDCnt;
        $('#land_details_container_for_dapvr_case').append(dapvrCaseLandDetailsTemplate(landDetails));
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempVillageData, 'village_for_dapvr_case_' + tempLDCnt, 'village', 'village_name');
        if (landDetails.village) {
            $('#village_for_dapvr_case_' + tempLDCnt).val(landDetails.village);
        }
        if (landDetails.survey_data) {
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForLand(landDetails.survey_data, 'survey_number_for_dapvr_case_' + tempLDCnt, 'survey', 'survey');
            $('#survey_number_for_dapvr_case_' + tempLDCnt).val(landDetails.survey);
        }
        if (landDetails.subdiv_data) {
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(landDetails.subdiv_data, 'subdivision_number_for_dapvr_case_' + tempLDCnt, 'subdiv', 'subdiv');
            $('#subdivision_number_for_dapvr_case_' + tempLDCnt).val(landDetails.subdiv);
        }
        generateSelect2id('village_for_dapvr_case_' + tempLDCnt);
        generateSelect2id('survey_number_for_dapvr_case_' + tempLDCnt);
        generateSelect2id('subdivision_number_for_dapvr_case_' + tempLDCnt);
        tempLDCnt++;
        resetCounter('ld-display-cnt');
    },
    removeLandDetails: function (ldCnt) {
        $('#land_details_for_dapvr_case_' + ldCnt).remove();
        resetCounter('ld-display-cnt');
    },
    addMorepetitioner: function (piData, showRemoveBtn) {
        if (showRemoveBtn) {
            piData.show_remove_btn = true;
        } else {
            piData.readonly = 'readonly';
        }

        piData.pet_cnt = tempPetitionerCnt;
        $('#petitioner_info_container_for_dapvr_case').append(dapvrCasePetitionerInfoTemplate(piData));
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(tempAdvocateList, 'pet_adv_name_for_dapvr_case_' + tempPetitionerCnt, 'advocate_detail_id', 'advocate_name', 'Advocate !');
        if (piData.pet_adv_name) {
            $('#pet_adv_name_for_dapvr_case_' + tempPetitionerCnt).val(piData.pet_adv_name);
        }
        generateSelect2id('pet_adv_name_for_dapvr_case_' + tempPetitionerCnt);
        resetCounter('pet-display-cnt');
        tempPetitionerCnt++;
    },
    removePetitionerInfo: function (petCnt) {
        $('#petitioner_info_for_dapvr_case_' + petCnt).remove();
        resetCounter('pet-display-cnt');
    },
    addMoreRespondent: function (riData, showRemoveBtn) {
        if (showRemoveBtn) {
            riData.show_remove_btn = true;
        } else {
            riData.readonly = 'readonly';
        }
        riData.res_cnt = tempRespondentCnt;
        $('#respondent_info_container_for_dapvr_case').append(dapvrCaseRespondentInfoTemplate(riData));
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(tempAdvocateList, 'res_adv_name_for_dapvr_case_' + tempRespondentCnt, 'advocate_detail_id', 'advocate_name', 'Advocate !');
        if (riData.res_adv_name) {
            $('#res_adv_name_for_dapvr_case_' + tempRespondentCnt).val(riData.res_adv_name);
        }
        generateSelect2id('res_adv_name_for_dapvr_case_' + tempRespondentCnt);
        resetCounter('res-display-cnt');
        tempRespondentCnt++;
    },
    removeRespondentInfo: function (petCnt) {
        $('#respondent_info_for_dapvr_case_' + petCnt).remove();
        resetCounter('res-display-cnt');
    },
    checkValidationForDapvrCase: function (dapvr_case_data) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!dapvr_case_data.district_for_dapvr_case) {
            return getBasicMessageAndFieldJSONArray('district_for_dapvr_case', districtValidationMessage);
        }
        if (!dapvr_case_data.response_type_for_dapvr_case) {
            return getBasicMessageAndFieldJSONArray('response_type_for_dapvr_case', selectcaseresponsetypeValidationMessage);
        }
        if (!dapvr_case_data.case_type_for_dapvr_case) {
            return getBasicMessageAndFieldJSONArray('case_type_for_dapvr_case', selectcasetypeValidationMessage);
        }
        if (!dapvr_case_data.case_year_for_dapvr_case) {
            return getBasicMessageAndFieldJSONArray('case_year_for_dapvr_case', selectcaseyearValidationMessage);
        }
        if (!dapvr_case_data.matter_for_dapvr_case) {
            return getBasicMessageAndFieldJSONArray('matter_for_dapvr_case', matterValidationMessage);
        }
        if (!dapvr_case_data.rojnamu_for_dapvr_case) {
            return getBasicMessageAndFieldJSONArray('rojnamu_for_dapvr_case', rojnamuValidationMessage);
        }
        if (!dapvr_case_data.case_status_for_dapvr_case) {
            return getBasicMessageAndFieldJSONArray('case_status_for_dapvr_case', selectcasestatusValidationMessage);
        }
        return '';
    },
    submitdapvrCase: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var dapvr_case_data = $('#dapvr_case_form').serializeFormJSON();
        var validationData = that.checkValidationForDapvrCase(dapvr_case_data);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('dapvr_case-' + validationData.field, validationData.message);
            return false;
        }
        var ldItems = [];
        var isLdValidation = false;
        $('.land_details_for_dapvr_case').each(function () {
            var cnt = $(this).find('.temp_ld_cnt').val();
            var ldInfo = {};
            var village = $('#village_for_dapvr_case_' + cnt).val();
            if (village == '' || village == null) {
                $('#village_for_dapvr_case_' + cnt).focus();
                validationMessageShow('dapvr_case-village_for_dapvr_case_' + cnt, selectVillageValidationMessage);
                isLdValidation = true;
                return false;
            }
            ldInfo.village = village;
            var survey = $('#survey_number_for_dapvr_case_' + cnt).val();
            if (survey == '' || survey == null) {
                $('#survey_number_for_dapvr_case_' + cnt).focus();
                validationMessageShow('dapvr_case-survey_number_for_dapvr_case_' + cnt, selectSurveyValidationMessage);
                isLdValidation = true;
                return false;
            }
            ldInfo.survey = survey;
            var subdiv = $('#subdivision_number_for_dapvr_case_' + cnt).val();
            if (subdiv == '' || subdiv == null) {
                $('#subdivision_number_for_dapvr_case_' + cnt).focus();
                validationMessageShow('dapvr_case-subdivision_number_for_dapvr_case_' + cnt, selectSubdivValidationMessage);
                isLdValidation = true;
                return false;
            }
            ldInfo.subdiv = subdiv;
            ldItems.push(ldInfo);
        });
        if (isLdValidation) {
            return false;
        }
        if (ldItems.length == VALUE_ZERO) {
            $('#' + validationData.field).focus();
            showError(oneLandValidationMessage);
            return false;
        }
        var petitionerInfoItems = [];
        var ispetitionerValidation = false;
        $('.petitioner_info_for_dapvr_case').each(function () {
            var cnt = $(this).find('.temp_pet_cnt').val();
            var petitionerInfo = {};
            var petitionerName = $('#name_of_petitioner_for_dapvr_case_' + cnt).val();
            if (petitionerName == '' || petitionerName == null) {
                $('#name_of_petitioner_for_dapvr_case_' + cnt).focus();
                validationMessageShow('dapvr_case-name_of_petitioner_for_dapvr_case_' + cnt, nameValidationMessage);
                ispetitionerValidation = true;
                return false;
            }
            petitionerInfo.pet_name = petitionerName;
            var petitioneraddress = $('#address_of_petitioner_for_dapvr_case_' + cnt).val();
            if (petitioneraddress == '' || petitioneraddress == null) {
                $('#address_of_petitioner_for_dapvr_case_' + cnt).focus();
                validationMessageShow('dapvr_case-address_of_petitioner_for_dapvr_case_' + cnt, addressValidationMessage);
                ispetitionerValidation = true;
                return false;
            }
            petitionerInfo.pet_address = petitioneraddress;
            var petitionerAdvName = $('#pet_adv_name_for_dapvr_case_' + cnt).val();
            petitionerInfo.pet_adv_name = petitionerAdvName;
            var petitionerAdvMobno = $('#pet_adv_mobno_for_dapvr_case_' + cnt).val();
            petitionerInfo.pet_adv_mobno = petitionerAdvMobno;
            var petitionerAdvEmail = $('#pet_adv_email_for_dapvr_case_' + cnt).val();
            petitionerInfo.pet_adv_email = petitionerAdvEmail;
            petitionerInfoItems.push(petitionerInfo);
        });
        if (ispetitionerValidation) {
            return false;
        }
        if (petitionerInfoItems.length == VALUE_ZERO) {
            $('html, body, table').animate({scrollTop: '0px'}, 0);
            showError(onePetitionerValidationMessage);
            return false;
        }
        var respondentInfoItems = [];
        var isrespondentValidation = false;
        $('.respondent_info_for_dapvr_case').each(function () {
            var cnt = $(this).find('.temp_res_cnt').val();
            var respondentInfo = {};
            var respondentName = $('#name_of_respondent_for_dapvr_case_' + cnt).val();
            if (respondentName == '' || respondentName == null) {
                $('#name_of_respondent_for_dapvr_case_' + cnt).focus();
                validationMessageShow('dapvr_case-name_of_respondent_for_dapvr_case_' + cnt, nameValidationMessage);
                isrespondentValidation = true;
                return false;
            }
            respondentInfo.res_name = respondentName;
            var respondentaddress = $('#address_of_respondent_for_dapvr_case_' + cnt).val();
            if (respondentaddress == '' || respondentaddress == null) {
                $('#address_of_respondent_for_dapvr_case_' + cnt).focus();
                validationMessageShow('dapvr_case-address_of_respondent_for_dapvr_case_' + cnt, addressValidationMessage);
                isrespondentValidation = true;
                return false;
            }
            respondentInfo.res_address = respondentaddress;
            var respondentAdvName = $('#res_adv_name_for_dapvr_case_' + cnt).val();
            respondentInfo.res_adv_name = respondentAdvName;
            var respondentAdvMobno = $('#res_adv_mobno_for_dapvr_case_' + cnt).val();
            respondentInfo.res_adv_mobno = respondentAdvMobno;
            var respondentAdvEmail = $('#res_adv_email_for_dapvr_case_' + cnt).val();
            respondentInfo.res_adv_email = respondentAdvEmail;
            respondentInfoItems.push(respondentInfo);
        });
        if (isrespondentValidation) {
            return false;
        }
        if (respondentInfoItems.length == VALUE_ZERO) {
            $('html, body, table').animate({scrollTop: '0px'}, 0);
            showError(onerespondentValidationMessage);
            return false;
        }
        dapvr_case_data.module_type = moduleType = VALUE_ONE;
        dapvr_case_data.land_details = ldItems;
        dapvr_case_data.petitioner_info = petitionerInfoItems;
        dapvr_case_data.respondent_info = respondentInfoItems;
        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_dapvr_case') : $('#submit_btn_for_dapvr_case');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'dapvr_case/submit_dapvr_case',
            data: $.extend({}, dapvr_case_data, getTokenData()),
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
                validationMessageShow('dapvr_case', textStatus.statusText);
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
                    validationMessageShow('dapvr_case', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                DAPVRCase.listview.loadDapvrCaseData();
                $('#movement_for_ic_list_' + dapvr_case_data.case_id).html(movementString(dapvr_case_data));
            }
        });
    },
    editOrViewDapvrCaseEntry: function (btnObj, CaseId, isEdit) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!CaseId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dapvr_case/get_dapvr_case_data_by_id',
            type: 'post',
            data: $.extend({}, {'case_id': CaseId, 'is_edit': isEdit ? VALUE_ONE : VALUE_TWO}, getTokenData()),
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
                tempAdvocateList = parseData.advocate_list_data;
                var dapvr_case_data = parseData.dapvr_case_data;
                var land_data = parseData.ld_details;
                if (isEdit) {
                    that.newDapvrCaseForm(isEdit, dapvr_case_data, land_data);
                } else {
                    that.viewDapvrCaseForm(dapvr_case_data);
                }
            }
        });
    },
    viewDapvrCaseForm: function (dapvr_case_data) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        dapvr_case_data.title = 'View';
        dapvr_case_data.district_text = talukaArray[dapvr_case_data.district] ? talukaArray[dapvr_case_data.district] : '';
        dapvr_case_data.case_response_type_text = CaseResponseTypeArray[dapvr_case_data.case_response_type] ? CaseResponseTypeArray[dapvr_case_data.case_response_type] : '';
        dapvr_case_data.case_type_text = CaseTypeArray[dapvr_case_data.case_type] ? CaseTypeArray[dapvr_case_data.case_type] : '';
        dapvr_case_data.year_text = caseyearArray[dapvr_case_data.year] ? caseyearArray[dapvr_case_data.year] : '';
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(dapvrCaseViewTemplate(dapvr_case_data));
        var landdata = {};
        landdata = JSON.parse(dapvr_case_data.land_details);
        var ldCnt = 1;
        $.each(landdata, function (index, ld) {
            ld.village_name = tempVillageData[ld.village] ? tempVillageData[ld.village]['village_name'] : '';
            var ldRow = '<tr><td class="text-center">' + ldCnt + '</td><td>' + ld.village_name + '</td>' +
                    '<td class="text-center">' + ld.survey + '</td><td class="text-center">' + ld.subdiv + '</td></tr>';
            $('.ld_container_for_dcview').append(ldRow);
            ldCnt++;
        });
        var ptdata = JSON.parse(dapvr_case_data.petitioner_details);
        var ptCnt = 1;
        $.each(ptdata, function (index, pt) {
            var ptRow = '<tr><td class="text-center">' + ptCnt + '</td><td>' + pt.pet_name + '</td>' +
                    '<td class="text-center">' + pt.pet_address + '</td><td class="text-center">' + pt.pet_adv_name + '</td>' +
                    '<td class="text-center">' + pt.pet_adv_mobno + '</td><td class="text-center">' + pt.pet_adv_email + '</td></tr>';
            $('.pt_container_for_dcview').append(ptRow);
            ptCnt++;
        });

        var rsdata = JSON.parse(dapvr_case_data.respondent_details);
        //console.log(rsdata);
        var rsCnt = 1;
        $.each(rsdata, function (index, rs) {
            var rsRow = '<tr><td class="text-center">' + rsCnt + '</td><td>' + rs.res_name + '</td>' +
                    '<td class="text-center">' + rs.res_address + '</td><td class="text-center">' + rs.res_adv_name + '</td>' +
                    '<td class="text-center">' + rs.res_adv_mobno + '</td><td class="text-center">' + rs.res_adv_email + '</td></tr>';
            $('.rs_container_for_dcview').append(rsRow);
            rsCnt++;
        });
        var hearingdata = {};

        var hrCnt = 1;
        if (dapvr_case_data.previous_hearing_date) {
            hearingdata = JSON.parse(dapvr_case_data.previous_hearing_date);
            $.each(hearingdata, function (index, hr) {
                var hrRow = '<tr><td class="text-center">' + hrCnt + '</td><td class="text-center">' + hr.hearing_date + '</td>' +
                        '<td>' + hr.hearing_remarks + '</td></tr>';
                $('.hr_container_for_dcview').append(hrRow);
                hrCnt++;
            });
        }
        if (hrCnt == 1) {
            $('.hr_container_for_dcview').html(noRecordFoundTemplate({'colspan': 3, 'message': noRecordFoundMessage}));
        }
    },
    askForSubmitdapvrCase: function (moduleType) {
    },
    setHearingDate: function (caseId) {
        if (!caseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#hearingdate_btn_for_case_' + caseId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dapvr_case/get_hearing_data_by_case_id',
            type: 'post',
            data: $.extend({}, {'case_id': caseId}, getTokenData()),
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
                var hearingData = parseData.hearing_data;
                showPopup();
                if (hearingData == null) {
                    var hearingData = {};
                }

                var CaseYearRenderer = function (data, type, full, meta) {
                    var CaseYearData = caseyearArray[data] ? caseyearArray[data] : '';
                    return CaseYearData;
                };
                var CaseTypeRenderer = function (data, type, full, meta) {
                    var CaseTypeData = CaseTypeArray[data] ? CaseTypeArray[data] : '';
                    return CaseTypeData;
                };

                hearingData.VALUE_ONE = VALUE_ONE;
                hearingData.CaseYearData = caseyearArray[hearingData.year] ? caseyearArray[hearingData.year] : '';
                hearingData.CaseTypeData = CaseTypeArray[hearingData.case_type] ? CaseTypeArray[hearingData.case_type] : '';
                hearingData.next_hearing_date = dateTo_DD_MM_YYYY(hearingData.next_hearing_date);

                //hearingData.previous_hearing_date = dateTo_DD_MM_YYYY(hearingData.previous_hearing_date);


                if (hearingData.status == VALUE_FIVE || hearingData.status == VALUE_SIX) {
                    hearingData.show_submit_btn = false;
                } else {
                    hearingData.show_submit_btn = true;
                }
                $('#popup_container').html(dapvrCaseSetHearingDateTemplate(hearingData));
                if (hearingData.previous_hearing_date == '') {
                    $('#set_hearing_date_div_for_dapvr_case').show();
                } else {

                    $('#set_hearing_date_div_for_dapvr_case').hide();
                    $('#next_hearing_div_for_dapvr_case').show();
                }
                datePicker();
                var hrCnt = 1;
                if (hearingData.previous_hearing_date) {
                    var hearing = {};
                    hearing = JSON.parse(hearingData.previous_hearing_date);
                    $.each(hearing, function (index, hr) {
                        var hrRow = '<tr><td class="text-center">' + hrCnt + '</td><td class="text-center">' + hr.hearing_date + '</td>' +
                                '<td class="text-center">' + hr.hearing_time + '</td>' + '<td>' + hr.hearing_remarks + '</td></tr>';
                        $('.hr_container_for_dcview').append(hrRow);
                        hrCnt++;
                    });
                }
                if (hrCnt == 1) {
                    $('.hr_container_for_dcview').html(noRecordFoundTemplate({'colspan': 4, 'message': noRecordFoundMessage}));
                }
                generateBoxes('radio', yesNoArray, 'next_hearing', 'dapvr_case', hearingData.next_hearing, false, false);
                showSubContainer('next_hearing', 'dapvr_case', '.next_hearing_item', VALUE_ONE, 'radio');
            }
        });
    },
    submitsetHearingDate: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var formData = $('#set_hearing_date_dapvr_case_form').serializeFormJSON();
        if (!formData.case_id_for_dapvr_case_set_hearing_date) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.hearing_date_for_dapvr_case) {
            $('#hearing_date_for_dapvr_case').focus();
            validationMessageShow('dapvr_case-hearing_date_for_dapvr_case', HearingDateValidationMessage);
            return false;
        }
        if (!formData.hearing_time_for_dapvr_case) {
            $('#hearing_time_for_dapvr_case').focus();
            validationMessageShow('dapvr_case-hearing_time_for_dapvr_case', timeValidationMessage);
            return false;
        }
        if (!formData.hearing_remarks_for_dapvr_case) {
            $('#hearing_remarks_for_dapvr_case').focus();
            validationMessageShow('dapvr_case-hearing_remarks_for_dapvr_case', remarksValidationMessage);
            return false;
        }

        var hearingItems = [];
        var hearingInfo = {};
        var hearing_date = $('#hearing_date_for_dapvr_case').val();
        hearingInfo.hearing_date = hearing_date;
        var hearing_time = $('#hearing_time_for_dapvr_case').val();
        hearingInfo.hearing_time = hearing_time;
        var hearing_remarks = $('#hearing_remarks_for_dapvr_case').val();
        hearingInfo.hearing_remarks = hearing_remarks;
        hearingItems.push(hearingInfo);
        formData.hearing_details = hearingItems;
        var btnObj = $('#submit_btn_for_dapvr_case_set_hearing_date');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'dapvr_case/submit_set_hearing_date',
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
                validationMessageShow('dapvr_case-set_hearing_date', textStatus.statusText);
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
                    validationMessageShow('dapvr_case-set_hearing_date', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                DAPVRCase.listview.listPage();
                var dapvr_case_data = parseData.dapvr_case_data;
                $('#movement_for_ic_list_' + dapvr_case_data.case_id).html(movementString(dapvr_case_data));
            }
        });
    },
    updateBasicDetails: function (btnObj, caseId) {
        if (!caseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }

        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dapvr_case/get_update_basic_detail_data_by_case_id',
            type: 'post',
            data: $.extend({}, {'case_id': caseId}, getTokenData()),
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
                basicDetailData.VALUE_ONE = VALUE_ONE;
                basicDetailData.title = basicDetailData.talathi_to_mamlatdar == VALUE_ZERO ? (tempTypeInSession == TEMP_TYPE_TALATHI_USER ? 'Forward to Mamlatdar test' : (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER ? 'Forward Details' : 'Update Basic Details')) : 'Forward to Mamlatdar Details';
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_mamlatdar == VALUE_ZERO) {
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_talathi_enter_basic_details = true;
                }
                if (basicDetailData.talathi_to_mamlatdar != VALUE_ZERO) {
                    basicDetailData.talathi_to_mamlatdar_datetime_text = basicDetailData.talathi_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_mamlatdar_datetime) : '';
                    basicDetailData.show_talathi_updated_basic_details = true;

                }
                $('#popup_container').html(dapvrCaseUpdateBasicDetailTemplate(basicDetailData));
                if (basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) {
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_mamlatdar == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'talathi_to_mamlatdar_for_dapvr_case', 'sa_user_id', 'name', '', false);

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
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_dapvr_case_form').serializeFormJSON();
        if (!formData.case_id_for_dapvr_case_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.talathi_remarks_for_dapvr_case) {
                $('#talathi_remarks_for_dapvr_case').focus();
                validationMessageShow('dapvr_case-update-basic-detail-talathi_remarks_for_dapvr_case', remarksValidationMessage);
                return false;
            }
            if (!formData.talathi_to_mamlatdar_for_dapvr_case) {
                $('#talathi_to_mamlatdar_for_dapvr_case').focus();
                validationMessageShow('dapvr_case-update-basic-detail-talathi_to_mamlatdar_for_dapvr_case', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'dapvr_case/forward_to',
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
                validationMessageShow('dapvr_case-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('dapvr_case-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var dapvr_case_data = parseData.dapvr_case_data;
                DAPVRCase.listview.loadDapvrCaseData();
                $('#movement_for_ic_list_' + dapvr_case_data.case_id).html(movementString(dapvr_case_data));
            }
        });
    },
    Judgement: function (caseId) {
        if (!caseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#judgement_btn_for_case_' + caseId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dapvr_case/get_hearing_data_by_case_id',
            type: 'post',
            data: $.extend({}, {'case_id': caseId}, getTokenData()),
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
                var judgementData = parseData.hearing_data;
                showPopup();
                if (judgementData == null) {
                    var judgementData = {};
                }

                var CaseYearRenderer = function (data, type, full, meta) {
                    var CaseYearData = caseyearArray[data] ? caseyearArray[data] : '';
                    return CaseYearData;
                };
                var CaseTypeRenderer = function (data, type, full, meta) {
                    var CaseTypeData = CaseTypeArray[data] ? CaseTypeArray[data] : '';
                    return CaseTypeData;
                };

                judgementData.VALUE_ONE = VALUE_ONE;
                judgementData.CaseYearData = caseyearArray[judgementData.year] ? caseyearArray[judgementData.year] : '';
                judgementData.CaseTypeData = CaseTypeArray[judgementData.case_type] ? CaseTypeArray[judgementData.case_type] : '';
                judgementData.next_hearing_date = dateTo_DD_MM_YYYY(judgementData.next_hearing_date);
                if (judgementData.status == VALUE_FOUR || judgementData.status == VALUE_FIVE) {
                    judgementData.show_submit_btn = false;
                } else {
                    judgementData.show_submit_btn = true;
                }
                $('#popup_container').html(dapvrCaseJudgementTemplate(judgementData));
                var hearing = {};
                hearing = JSON.parse(judgementData.previous_hearing_date);
                var hrCnt = 1;
                $.each(hearing, function (index, hr) {
                    var hrRow = '<tr><td class="text-center">' + hrCnt + '</td><td class="text-center">' + hr.hearing_date + '</td>' +
                            '<td class="text-center">' + hr.hearing_time + '</td>' + '<td>' + hr.hearing_remarks + '</td></tr>';
                    $('.judgement_hr_container_for_dcview').append(hrRow);
                    hrCnt++;
                });
            }
        });
    },
    submitJudgement: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var formData = $('#judgement_dapvr_case_form').serializeFormJSON();
        if (!formData.case_id_for_dapvr_case_judgement) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.judgement_remarks_for_dapvr_case) {
            $('#judgement_remarks_for_dapvr_case').focus();
            validationMessageShow('dapvr_case-judgement_remarks_for_dapvr_case', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_dapvr_case_judgement');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'dapvr_case/submit_judgement',
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
                validationMessageShow('dapvr_case-judgement', textStatus.statusText);
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
                    validationMessageShow('dapvr_case-judgement', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                DAPVRCase.listview.listPage();
            }
        });
    },
    UploadOrder: function (caseId) {
        if (!caseId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#order_btn_for_case_' + caseId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'dapvr_case/get_hearing_data_by_case_id',
            type: 'post',
            data: $.extend({}, {'case_id': caseId}, getTokenData()),
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
                var orderData = parseData.hearing_data;
                showPopup();
                if (orderData == null) {
                    var orderData = {};
                }

                var CaseYearRenderer = function (data, type, full, meta) {
                    var CaseYearData = caseyearArray[data] ? caseyearArray[data] : '';
                    return CaseYearData;
                };
                var CaseTypeRenderer = function (data, type, full, meta) {
                    var CaseTypeData = CaseTypeArray[data] ? CaseTypeArray[data] : '';
                    return CaseTypeData;
                };

                orderData.VALUE_ONE = VALUE_ONE;
                orderData.CaseYearData = caseyearArray[orderData.year] ? caseyearArray[orderData.year] : '';
                orderData.CaseTypeData = CaseTypeArray[orderData.case_type] ? CaseTypeArray[orderData.case_type] : '';
                orderData.next_hearing_date = dateTo_DD_MM_YYYY(orderData.next_hearing_date);
                if (orderData.status == VALUE_FIVE) {
                    orderData.show_submit_btn = false;
                } else {
                    orderData.show_submit_btn = true;
                }

                $('#popup_container').html(dapvrCaseUploadOrderTemplate(orderData));
                $('#upload_order_name_container_for_dc').show();
                $('#upload_order_href_for_dc').attr('href', 'documents/dapvr_case_order/' + orderData.order_doc);
                $('#upload_order_name_for_dc').html(orderData.order_doc);
                $('#upload_order_remove_btn_for_dc').attr('onclick', 'DAPVRCase.listview.removeUploadDoc("' + orderData.case_id + '")');
                var hearing = {};
                hearing = JSON.parse(orderData.previous_hearing_date);
                var hrCnt = 1;
                $.each(hearing, function (index, hr) {
                    var hrRow = '<tr><td class="text-center">' + hrCnt + '</td><td class="text-center">' + hr.hearing_date + '</td>' +
                            '<td>' + hr.hearing_remarks + '</td></tr>';
                    $('.order_hr_container_for_dcview').append(hrRow);
                    hrCnt++;
                });
            }
        });
    },
    submitOrder: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var formData = $('#order_dapvr_case_form').serializeFormJSON();
        if (!formData.case_id_for_dapvr_case_order) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if ($('#upload_order_dv_for_dc').is(':visible')) {
            var sealAndStamp = $('#upload_order_for_dc').val();
            if (sealAndStamp == '') {
                $('#upload_order_for_dc').focus();
                validationMessageShow('dapvr_case-upload_order_for_dc', uploadDocumentValidationMessage);
                return false;
            }
            var sdpoCopyMessage = fileUploadValidation('upload_order_for_dc', 2048);
            if (sdpoCopyMessage != '') {
                $('#upload_order_for_dc').focus();
                validationMessageShow('dapvr_case-upload_order_for_dc', challanMessage);
                return false;
            }
        }
        var btnObj = $('#submit_btn_for_dapvr_case_order');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        var newFormData = new FormData($('#order_dapvr_case_form')[0]);
        newFormData.append("csrf_token_sugam_admin", getTokenData()['csrf_token_sugam_admin']);
        $.ajax({
            type: 'POST',
            url: 'dapvr_case/submit_order',
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
                validationMessageShow('dapvr_case-order', textStatus.statusText);
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
                    validationMessageShow('dapvr_case-order', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                DAPVRCase.listview.listPage();
            }
        });
    },
    ViewDashboard: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#dapvr_case_form_and_datatable_container').html(dapvrCaseDashboardTemplate);
        $.ajax({
            url: 'dapvr_case/get_dashboard_data',
            type: 'post',
            data: (getTokenData()),
            error: function (textStatus, errorThrown) {
                $('.null-value').html(0);
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
                $('#total_dapvr_cases_for_dashboard').html(parseData.total_cases);
                $('#pending_dapvr_cases_for_dashboard').html(parseData.pending_cases);
                $('#close_dapvr_cases_for_dashboard').html(parseData.close_cases);
                $('#today_hearing_dapvr_cases_for_dashboard').html(parseData.today_hearing_cases);
            }
        });
    },
    AddAdvocate: function () {
        showPopup();
        $('#popup_container').html(dapvrCaseAddAdvocateTemplate());
    },
    submitAdvocate: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var formData = $('#add_advocate_dapvr_case_form').serializeFormJSON();
//        if (!formData.case_id_for_dapvr_case_judgement) {
//            showError(invalidAccessValidationMessage);
//            return false;
//        }
        if (!formData.advocate_name_for_dapvr_case) {
            $('#advocate_name_for_dapvr_case').focus();
            validationMessageShow('dapvr_case-advocate_name_for_dapvr_case', advnameValidationMessage);
            return false;
        }
//        if (!formData.advocate_mobile_number_for_dapvr_case) {
//            $('#advocate_mobile_number_for_dapvr_case').focus();
//            validationMessageShow('dapvr_case-advocate_mobile_number_for_dapvr_case', mobileValidationMessage);
//            return false;
//        }
//        if (!formData.advocate_email_for_dapvr_case) {
//            $('#advocate_email_for_dapvr_case').focus();
//            validationMessageShow('dapvr_case-advocate_email_for_dapvr_case', advnameValidationMessage);
//            return false;
//        }
        var btnObj = $('#submit_btn_for_add_advocate_dapvr_case');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'dapvr_case/submit_advocate',
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
                validationMessageShow('dapvr_case-add_advocate', textStatus.statusText);
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
                    validationMessageShow('dapvr_case-add_advocate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
//                DAPVRCase.listview.listPage();
                tempAdvocateList.push(parseData.advocate_data);

                $('.temp-advocate-list').each(function (index) {
                    var exAdvocate = $(this).val();
                    var id = $(this).attr('id');
                    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(tempAdvocateList, id, 'advocate_detail_id', 'advocate_name', 'Advocate !');
                    $('#' + id).val(exAdvocate);
                });

            }
        });
    },
});
