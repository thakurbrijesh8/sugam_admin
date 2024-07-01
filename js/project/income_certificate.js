var incomeCertificateListTemplate = Handlebars.compile($('#income_certificate_list_template').html());
var incomeCertificateSearchTemplate = Handlebars.compile($('#income_certificate_search_template').html());
var incomeCertificateTableTemplate = Handlebars.compile($('#income_certificate_table_template').html());
var incomeCertificateActionTemplate = Handlebars.compile($('#income_certificate_action_template').html());
var incomeCertificateFormTemplate = Handlebars.compile($('#income_certificate_form_template').html());
var incomeCertificateMemberInfoTemplate = Handlebars.compile($('#income_certificate_member_info_template').html());
var incomeCertificateViewTemplate = Handlebars.compile($('#income_certificate_view_template').html());
var incomeCertificateApproveTemplate = Handlebars.compile($('#income_certificate_approve_template').html());
var incomeCertificateRejectTemplate = Handlebars.compile($('#income_certificate_reject_template').html());
var incomeCertificateViewDocumentTemplate = Handlebars.compile($('#income_certificate_view_document_template').html());
var incomeCertificateFamilyMemberInfoTemplate = Handlebars.compile($('#income_certificate_family_member_info_template').html());
var incomeCertificateChildrenInfoTemplate = Handlebars.compile($('#income_certificate_children_info_template').html());
var incomeCertificatePropertyInfoTemplate = Handlebars.compile($('#income_certificate_property_info_template').html());
var incomeCertificateOtherIncomeInfoTemplate = Handlebars.compile($('#income_certificate_other_income_info_template').html());
var incomeCertificateSetAppointmentTemplate = Handlebars.compile($('#income_certificate_set_appointment_template').html());
var incomeCertificateUpdateBasicDetailTemplate = Handlebars.compile($('#income_certificate_update_basic_detail_template').html());
var fieldVerificationDocItemTemplate = Handlebars.compile($('#income_certificate_field_verification_document_template').html());
var fieldVerificationViewDocItemTemplate = Handlebars.compile($('#income_certificate_field_verification_view_document_template').html());


var tempMemberCnt = 1;
var tempFamilyMemberCnt = 1;
var tempChildrenCnt = 1;
var tempPropertyCnt = 1;
var tempOtherIncomeCnt = 1;
var verifyDocCnt = 1;
var searchICF = {};

var IncomeCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
IncomeCertificate.Router = Backbone.Router.extend({
    routes: {
        'income_certificate': 'renderList',
        'income_certificate_form': 'renderList',
        'edit_income_certificate_form': 'renderList',
        'view_income_certificate_form': 'renderList',
    },
    renderList: function () {
        IncomeCertificate.listview.listPage();
    },
});
IncomeCertificate.listView = Backbone.View.extend({
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
        addClass('menu_income_certificate', 'active');
        IncomeCertificate.router.navigate('income_certificate');
        var templateData = {};
        searchICF = {};
        this.$el.html(incomeCertificateListTemplate(templateData));
        this.loadIncomeCertificateData(sDistrict, sType);
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
        rowData.module_type = VALUE_TWO;
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
        return incomeCertificateActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        var onlineStatement = appointmentData.online_statement == VALUE_ONE ? 'Online Statement' : '';
        var visitOffice = appointmentData.visit_office == VALUE_ONE ? 'Visit Office' : '';
        if (appointmentData.appointment_date == '0000-00-00') {
            return '<span class="badge bg-warning app-status">Appointment Not Scheduled By Talathi</span>';
        }
        var returnString = '<span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">' + onlineStatement;
        if (onlineStatement != '' && visitOffice != '') {
            returnString += 'Or <br>';
        }
        returnString += (visitOffice + '</span>');
        return returnString;
    },
    loadIncomeCertificateData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;

        IncomeCertificate.router.navigate('income_certificate');
        var searchData = dtomMam(sDistrict, sType, 'IncomeCertificate.listview.loadIncomeCertificateData();');
        $('#income_certificate_form_and_datatable_container').html(incomeCertificateSearchTemplate(searchData));
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            renderOptionsForTwoDimensionalArray(appointmentFilterArray, 'appointment_status_for_income_certificate_list', false);
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(currentlyOnTypeArray, 'currently_on_for_income_certificate_list', false);
        }

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_income_certificate_list', false);


        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_income_certificate_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_income_certificate_list', false);
        datePickerId('application_date_for_income_certificate_list');

        if (tempTypeInSession != TEMP_TYPE_A) {
            var dwVillagesData = (tempDistrictInSession == VALUE_ONE ? damanVillagesArray : (tempDistrictInSession == VALUE_TWO ? diuVillagesArray : (tempDistrictInSession == VALUE_THREE ? dnhVillagesArray : [])));
            if (tempAVInSession != '') {
                var avData = tempAVInSession.split(',');
                renderOptionsForAVArray(avData, dwVillagesData, 'vdw_for_income_certificate_list', false);
            } else {
                renderOptionsForTwoDimensionalArray(dwVillagesData, 'vdw_for_income_certificate_list', false);
            }
        } else {
            if (typeof searchICF.district_for_income_certificate_list != "undefined" && searchICF.district_for_income_certificate_list != '' && searchICF.village_for_income_certificate_list != '') {
                var villageData = (searchICF.district_for_income_certificate_list == VALUE_ONE ? damanVillagesArray : (searchICF.district_for_income_certificate_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_income_certificate_list', false);
            }
        }

        $('#app_no_for_income_certificate_list').val((typeof searchICF.app_no_for_income_certificate_list != "undefined" && searchICF.app_no_for_income_certificate_list != '') ? searchICF.app_no_for_income_certificate_list : '');
        $('#application_date_for_income_certificate_list').val((typeof searchICF.application_date_for_income_certificate_list != "undefined" && searchICF.application_date_for_income_certificate_list != '') ? searchICF.application_date_for_income_certificate_list : searchData.s_appd);
        $('#app_details_for_income_certificate_list').val((typeof searchICF.app_details_for_income_certificate_list != "undefined" && searchICF.app_details_for_income_certificate_list != '') ? searchICF.app_details_for_income_certificate_list : '');
        $('#appointment_status_for_income_certificate_list').val((typeof searchICF.appointment_status_for_income_certificate_list != "undefined" && searchICF.appointment_status_for_income_certificate_list != '') ? searchICF.appointment_status_for_income_certificate_list : searchData.s_app_status);
        $('#query_status_for_income_certificate_list').val((typeof searchICF.query_status_for_income_certificate_list != "undefined" && searchICF.query_status_for_income_certificate_list != '') ? searchICF.query_status_for_income_certificate_list : searchData.s_qstatus);
        $('#status_for_income_certificate_list').val((typeof searchICF.status_for_income_certificate_list != "undefined" && searchICF.status_for_income_certificate_list != '') ? searchICF.status_for_income_certificate_list : searchData.s_status);
        $('#currently_on_for_income_certificate_list').val((typeof searchICF.currently_on_for_income_certificate_list != "undefined" && searchICF.currently_on_for_income_certificate_list != '') ? searchICF.currently_on_for_income_certificate_list : searchData.s_co_hand);
        $('#district_for_income_certificate_list').val((typeof searchICF.district_for_income_certificate_list != "undefined" && searchICF.district_for_income_certificate_list != '') ? searchICF.district_for_income_certificate_list : searchData.search_district);
        $('#vdw_for_income_certificate_list').val((typeof searchICF.vdw_for_income_certificate_list != "undefined" && searchICF.vdw_for_income_certificate_list != '') ? searchICF.vdw_for_income_certificate_list : '');
        $('#is_full_for_income_certificate_list').val((typeof searchICF.is_full_for_income_certificate_list != "undefined" && searchICF.is_full_for_income_certificate_list != '') ? searchICF.is_full_for_income_certificate_list : searchData.s_is_full);

        this.searchIncomeCertificateData();
    },
    searchIncomeCertificateData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#income_certificate_datatable_container').html(incomeCertificateTableTemplate);
        var searchData = $('#search_income_certificate_form').serializeFormJSON();

        searchICF = searchData;

        if (typeof btnObj == "undefined" && (searchICF.app_details_for_income_certificate_list == ''
                && searchICF.app_no_for_income_certificate_list == ''
                && searchICF.application_date_for_income_certificate_list == ''
                && searchICF.appointment_status_for_income_certificate_list == ''
                && searchICF.query_status_for_income_certificate_list == ''
                && searchICF.status_for_income_certificate_list == ''
                && searchICF.is_full_for_income_certificate_list == ''
                && (searchICF.district_for_income_certificate_list == '' || typeof searchICF.district_for_income_certificate_list == "undefined")
                && (searchICF.vdw_for_income_certificate_list == '' || typeof searchICF.vdw_for_income_certificate_list == "undefined")
                && (searchICF.currently_on_for_income_certificate_list == '' || typeof searchICF.currently_on_for_income_certificate_list == "undefined"))) {
            incomeCertificateDataTable = $('#income_certificate_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#income_certificate_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.communication_address + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? damanVillagesArray : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village_dmc_ward] ? villageData[full.village_dmc_ward] : '');
        };
        var appointmentRenderer = function (data, type, full, meta) {
            return '<div id="appointment_container_' + data + '">' + that.getAppointmentData(full) + '</div>';
        };
        var movementRenderer = function (data, type, full, meta) {
            return '<div id="movement_for_ic_list_' + data + '">' + movementString(full) + '</div>';
        };
        $('#income_certificate_datatable_container').html(incomeCertificateTableTemplate);
        incomeCertificateDataTable = $('#income_certificate_datatable').DataTable({
            ajax: {
                url: 'income_certificate/get_income_certificate_data',
                dataSrc: "income_certificate_data",
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
                {data: 'income_certificate_id', 'class': 'v-a-t text-center', 'render': appointmentRenderer},
                {data: 'income_certificate_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'income_certificate_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'income_certificate_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "fnRowCallback": aciNR,
            "initComplete": searchableDatatable
        });
        $('#income_certificate_datatable_filter').remove();
        $('#income_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = incomeCertificateDataTable.row(tr);

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
    newIncomeCertificateForm: function (incomeCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        IncomeCertificate.router.navigate('edit_income_certificate_form');
        tempMemberCnt = 1;
        tempFamilyMemberCnt = 1;
        tempChildrenCnt = 1;
        tempPropertyCnt = 1;
        tempOtherIncomeCnt = 1;
        incomeCertificateData.VALUE_ONE = VALUE_ONE;
        incomeCertificateData.VALUE_TWO = VALUE_TWO;
        incomeCertificateData.VALUE_THREE = VALUE_THREE;
        incomeCertificateData.VALUE_FOUR = VALUE_FOUR;
        incomeCertificateData.VALUE_FIVE = VALUE_FIVE;
        incomeCertificateData.VALUE_SIX = VALUE_SIX;
        incomeCertificateData.VALUE_SEVEN = VALUE_SEVEN;
        incomeCertificateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        incomeCertificateData.declaration_date_text = dateTo_DD_MM_YYYY(incomeCertificateData.declaration_date);
        incomeCertificateData.district_text = talukaArray[incomeCertificateData.district] ? talukaArray[incomeCertificateData.district] : '';
        $('#income_certificate_form_and_datatable_container').html(incomeCertificateFormTemplate(incomeCertificateData));
        $('#view_document_container_for_income_certificate').html(incomeCertificateViewDocumentTemplate(incomeCertificateData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_income_certificate');
        var district = incomeCertificateData.district;
        var villageData = (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : [])));
        renderOptionsForTwoDimensionalArray(villageData, 'village_dmc_ward_for_income_certificate');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'applicant_occupation_for_income_certificate');
        renderOptionsForTwoDimensionalArray(parentProfessionArray, 'father_occupation_for_income_certificate');
        renderOptionsForTwoDimensionalArray(parentProfessionArray, 'mother_occupation_for_income_certificate');
        renderOptionsForTwoDimensionalArray(parentProfessionArray, 'spouse_occupation_for_income_certificate');
        generateBoxes('radio', genderArray, 'gender', 'income_certificate', incomeCertificateData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'income_certificate', incomeCertificateData.marital_status, false, false);
        showSubContainer('marital_status', 'income_certificate', '.marital_status_item', VALUE_ONE, 'radio', '.marital_status_item', VALUE_THREE);
        showSubContainer('marital_status', 'income_certificate', '.spouse_document_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'if_wife_husband_have_property', 'income_certificate', incomeCertificateData.if_wife_husband_have_property, false, false);
        showSubContainer('if_wife_husband_have_property', 'income_certificate', '.if_wife_husband_have_property_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'applicant_have_earning_member', 'income_certificate', incomeCertificateData.applicant_have_earning_member, false, false);
        showSubContainer('applicant_have_earning_member', 'income_certificate', '.applicant_have_earning_member_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'if_applicant_have_children', 'income_certificate', incomeCertificateData.if_applicant_have_children, false, false);
        showSubContainer('if_applicant_have_children', 'income_certificate', '.if_applicant_have_children_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'have_you_any_member_income_otherside', 'income_certificate', incomeCertificateData.have_you_any_member_income_otherside, false, false);
        showSubContainer('have_you_any_member_income_otherside', 'income_certificate', '.have_you_any_member_income_otherside_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'did_you_apply_income_certificate_before', 'income_certificate', incomeCertificateData.did_you_apply_income_certificate_before, false, false);
        showSubContainer('did_you_apply_income_certificate_before', 'income_certificate', '.did_you_apply_income_certificate_before_item', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'have_you_income_proof', 'income_certificate', incomeCertificateData.have_you_income_proof, false, false);
        showSubContainer('have_you_income_proof', 'income_certificate', '.income_proof_doc_upload_item', VALUE_ONE, 'radio');
        showSubContainer('have_you_income_proof', 'income_certificate', '.self_declaration_doc_upload_item', VALUE_TWO, 'radio');
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_income_certificate');
            $('#district_for_income_certificate').val(incomeCertificateData.district);
        }
        $('#district_for_income_certificate').val(incomeCertificateData.district);
        $('#village_dmc_ward_for_income_certificate').val(incomeCertificateData.village_dmc_ward);
        $('#applicant_occupation_for_income_certificate').val(incomeCertificateData.applicant_occupation);
        $('#father_occupation_for_income_certificate').val(incomeCertificateData.father_occupation);
        $('#mother_occupation_for_income_certificate').val(incomeCertificateData.mother_occupation);
        $('#spouse_occupation_for_income_certificate').val(incomeCertificateData.spouse_occupation);
        if (incomeCertificateData.father_occupation == VALUE_NINE) {
            $('#father_other_occupation_text_for_income_certificate').show();
        }
        if (incomeCertificateData.mother_occupation == VALUE_NINE) {
            $('#mother_other_occupation_text_for_income_certificate').show();
        }
        if (incomeCertificateData.spouse_occupation == VALUE_NINE) {
            $('#spouse_other_occupation_text_for_income_certificate').show();
        }

        if (incomeCertificateData.applicant_occupation == VALUE_TWELVE) {
            $('#applicant_other_occupation_div_for_income_certificate').show();
        }

        var cnt = 1;
        if (incomeCertificateData.member_details != '') {
            var memberDetails = JSON.parse(incomeCertificateData.member_details);
            $.each(memberDetails, function (key, value) {
                $('#profession_for_income_certificate').val(value);
                that.addFamilyMemberInfo(value, true);
                $('#profession_for_income_certificate_' + cnt).val(value.profession);
                if (value.profession == VALUE_TEN) {
                    $('#earning_member_other_occupation_text_for_income_certificate_' + cnt).show();
                }
                cnt++;
            });
        }
        var cntchild = 1;
        if (incomeCertificateData.children_details != '') {
            var childrenDetails = JSON.parse(incomeCertificateData.children_details);
            $.each(childrenDetails, function (key, value) {
                that.addChildrenInfo(value, true);
                $('#profession_for_children_for_income_certificate_' + cntchild).val(value.profession);
                if (value.profession == VALUE_EIGHT) {
                    $('#children_other_occupation_text_for_income_certificate_' + cntchild).show();
                }
                cntchild++;
            });
        }
        var cntprop = 1;
        if (incomeCertificateData.property_details != '') {
            var propertyDetails = JSON.parse(incomeCertificateData.property_details);
            $.each(propertyDetails, function (key, value) {
                that.addPropertyInfo(value, true);
                $('#property_type_for_income_certificate_' + cntprop).val(value.property_type);
                if (value.property_type == VALUE_THREE) {
                    $('#other_property_type_text_for_income_certificate_' + cntprop).show();
                }
                cntprop++;
            });
        }
        var cntincome = 1;
        if (incomeCertificateData.other_income_details != '') {
            var other_income_Details = JSON.parse(incomeCertificateData.other_income_details);
            $.each(other_income_Details, function (key, value) {
                that.addOtherIncomeInfo(value, true);
                $('#source_of_income_for_income_certificate_' + cntincome).val(value.source_of_income);
                if (value.source_of_income == VALUE_TWO) {
                    $('#other_income_source_text_for_income_certificate_' + cntincome).show();
                }
                cntincome++;
            });
        }
        that.getYearlyIncomeTotal();
        if (incomeCertificateData.have_you_any_member_income_otherside == VALUE_ONE) {
            $('#have_you_any_member_income_otherside_for_income_certificate').click();
        }
        // $('#applicant_profession_for_income_certificate').val(incomeCertificateData.applicant_profession);
        //    that.getOtherProfession(applicant_profession_for_income_certificate);

        //    $('#her_his_occupation_profession_for_income_certificate').val(incomeCertificateData.her_his_occupation_profession);
        //    that.getSpouseProfession(her_his_occupation_profession_for_income_certificate);
        $('#declaration_for_income_certificate').click();
        that.viewDocument(incomeCertificateData);
        //$('input[type=radio][name=have_you_income_proof_for_income_certificate]').attr('disabled', 'disabled');
        generateSelect2();
        datePicker();
        datePickerMax('applicant_dob_for_income_certificate');
        if (incomeCertificateData.applicant_dob != '0000-00-00') {
            $('#applicant_dob_for_income_certificate').val(dateTo_DD_MM_YYYY(incomeCertificateData.applicant_dob));
        }
        if (incomeCertificateData.date != '0000-00-00') {
            $('#date_for_income_certificate').val(dateTo_DD_MM_YYYY(incomeCertificateData.date));
        }
        allowOnlyIntegerValue('aadhar_number_for_income_certificate');
        allowOnlyIntegerValue('applicant_yearly_income_for_income_certificate');
        $('#income_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.askForSubmitIncomeCertificate(VALUE_TWO);
            }
        });
    },
    viewDocument: function (incomeCertificateData) {
        var that = this;
        if (incomeCertificateData.applicant_photo_doc != '') {
            that.showDocument('applicant_photo_doc_container_for_income_certificate', 'applicant_photo_doc_name_image_for_income_certificate', 'applicant_photo_doc_name_container_for_income_certificate',
                    'applicant_photo_doc_download', 'applicant_photo_doc', incomeCertificateData.applicant_photo_doc);
        }
        if (incomeCertificateData.birth_leaving_certy_doc != '') {
            that.showDocument('birth_leaving_certy_doc_container_for_income_certificate', 'birth_leaving_certy_doc_name_image_for_income_certificate', 'birth_leaving_certy_doc_name_container_for_income_certificate',
                    'birth_leaving_certy_doc_download', 'birth_leaving_certy_doc', incomeCertificateData.birth_leaving_certy_doc);
        }
        if (incomeCertificateData.aadhar_card_doc != '') {
            that.showDocument('aadhar_card_doc_container_for_income_certificate', 'aadhar_card_doc_name_image_for_income_certificate', 'aadhar_card_doc_name_container_for_income_certificate',
                    'aadhar_card_doc_download', 'aadhar_card_doc', incomeCertificateData.aadhar_card_doc);
        }
        if (incomeCertificateData.election_card_doc != '') {
            that.showDocument('election_card_doc_container_for_income_certificate', 'election_card_doc_name_image_for_income_certificate', 'election_card_doc_name_container_for_income_certificate',
                    'election_card_doc_download', 'election_card_doc', incomeCertificateData.election_card_doc);
        }
        if (incomeCertificateData.income_proof_doc != '') {
            that.showDocument('income_proof_doc_container_for_income_certificate', 'income_proof_doc_name_image_for_income_certificate', 'income_proof_doc_name_container_for_income_certificate',
                    'income_proof_doc_download', 'income_proof_doc', incomeCertificateData.income_proof_doc);
        }
        if (incomeCertificateData.marriage_certificate_doc != '') {
            that.showDocument('marriage_certificate_doc_container_for_income_certificate', 'marriage_certificate_doc_name_image_for_income_certificate', 'marriage_certificate_doc_name_container_for_income_certificate',
                    'marriage_certificate_doc_download', 'marriage_certificate_doc', incomeCertificateData.marriage_certificate_doc);
        }
        if (incomeCertificateData.death_certificate_doc != '') {
            that.showDocument('death_certificate_doc_container_for_income_certificate', 'death_certificate_doc_name_image_for_income_certificate', 'death_certificate_doc_name_container_for_income_certificate',
                    'death_certificate_doc_download', 'death_certificate_doc', incomeCertificateData.death_certificate_doc);
        }
        if (incomeCertificateData.spouse_aadhar_card_doc != '') {
            that.showDocument('spouse_aadhar_card_doc_container_for_income_certificate', 'spouse_aadhar_card_doc_name_image_for_income_certificate', 'spouse_aadhar_card_doc_name_container_for_income_certificate',
                    'spouse_aadhar_card_doc_download', 'spouse_aadhar_card_doc', incomeCertificateData.spouse_aadhar_card_doc);
        }
        if (incomeCertificateData.spouse_election_card_doc != '') {
            that.showDocument('spouse_election_card_doc_container_for_income_certificate', 'spouse_election_card_doc_name_image_for_income_certificate', 'spouse_election_card_doc_name_container_for_income_certificate',
                    'spouse_election_card_doc_download', 'spouse_election_card_doc', incomeCertificateData.spouse_election_card_doc);
        }
        // if (incomeCertificateData.declaration_form_doc != '') {
        //     that.showDocument('declaration_form_doc_container_for_income_certificate', 'declaration_form_doc_name_image_for_income_certificate', 'declaration_form_doc_name_container_for_income_certificate',
        //             'declaration_form_doc_download', 'declaration_form_doc', incomeCertificateData.declaration_form_doc);
        // }
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', INCOME_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", INCOME_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'IncomeCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },
    editOrViewIncomeCertificate: function (btnObj, incomeCertificateId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateId) {
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
            url: 'income_certificate/get_income_certificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'income_certificate_id': incomeCertificateId}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
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
                var incomeCertificateData = parseData.income_certificate_data;
                if (isEdit) {
                    that.newIncomeCertificateForm(incomeCertificateData);
                } else {
                    that.viewIncomeCertificateForm(VALUE_ONE, incomeCertificateData, isPrint);
                }
            }
        });
    },
    removeMemberInfo: function (perCnt) {
        $('#income_certificate_member_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    viewIncomeCertificateForm: function (moduleType, incomeCertificateData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        incomeCertificateData.VALUE_THREE = VALUE_THREE;
        incomeCertificateData.INCOME_CERTIFICATE_DOC_PATH = INCOME_CERTIFICATE_DOC_PATH;
        incomeCertificateData.declaration_date_text = dateTo_DD_MM_YYYY(incomeCertificateData.declaration_date);
        incomeCertificateData.district_text = talukaArray[incomeCertificateData.district] ? talukaArray[incomeCertificateData.district] : '';
        var district = incomeCertificateData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        incomeCertificateData.village_dmc_ward_text = villageData[incomeCertificateData.village_dmc_ward] ? villageData[incomeCertificateData.village_dmc_ward] : '';
        incomeCertificateData.gender_text = genderArray[incomeCertificateData.gender] ? genderArray[incomeCertificateData.gender] : '';
        incomeCertificateData.applicant_dob_text = incomeCertificateData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(incomeCertificateData.applicant_dob) : '';
        incomeCertificateData.applicant_occupation_text = applicantOccupationArray[incomeCertificateData.applicant_occupation] ? (incomeCertificateData.applicant_occupation == VALUE_TWELVE ? incomeCertificateData.applicant_other_occupation : applicantOccupationArray[incomeCertificateData.applicant_occupation]) : '';
        incomeCertificateData.marital_status_text = maritalStatusArray[incomeCertificateData.marital_status] ? maritalStatusArray[incomeCertificateData.marital_status] : '';
        incomeCertificateData.father_occupation_text = parentProfessionArray[incomeCertificateData.father_occupation] ? (incomeCertificateData.father_occupation == VALUE_NINE ? incomeCertificateData.father_other_occupation : parentProfessionArray[incomeCertificateData.father_occupation]) : '';
        incomeCertificateData.mother_occupation_text = parentProfessionArray[incomeCertificateData.mother_occupation] ? (incomeCertificateData.mother_occupation == VALUE_NINE ? incomeCertificateData.mother_other_occupation : parentProfessionArray[incomeCertificateData.mother_occupation]) : '';
        if (incomeCertificateData.marital_status == VALUE_ONE || incomeCertificateData.marital_status == VALUE_THREE) {
            incomeCertificateData.show_spouse = true;
            incomeCertificateData.spouse_occupation_text = parentProfessionArray[incomeCertificateData.spouse_occupation] ? (incomeCertificateData.spouse_occupation == VALUE_NINE ? incomeCertificateData.spouse_other_occupation : parentProfessionArray[incomeCertificateData.spouse_occupation]) : '';
        }
        incomeCertificateData.applicant_occupation_text = applicantOccupationArray[incomeCertificateData.applicant_occupation] ? (incomeCertificateData.applicant_occupation == VALUE_TWELVE ? incomeCertificateData.applicant_other_occupation : applicantOccupationArray[incomeCertificateData.applicant_occupation]) : '-';
        incomeCertificateData.applicant_yearly_income = indianCommaIncome(incomeCertificateData.applicant_yearly_income);
        incomeCertificateData.show_children = incomeCertificateData.if_applicant_have_children == VALUE_ONE ? true : false;
        incomeCertificateData.show_imm = incomeCertificateData.if_wife_husband_have_property == VALUE_ONE ? true : false;
        incomeCertificateData.show_mio = incomeCertificateData.have_you_any_member_income_otherside == VALUE_ONE ? true : false;
        incomeCertificateData.icb_text = yesNoArray[incomeCertificateData.did_you_apply_income_certificate_before] ? (yesNoArray[incomeCertificateData.did_you_apply_income_certificate_before] + (incomeCertificateData.did_you_apply_income_certificate_before == VALUE_ONE ? (' (' + incomeCertificateData.when_you_apply_income_certificate + ')') : '')) : yesNoArray[VALUE_TWO];
        incomeCertificateData.show_applicant_photo_doc = incomeCertificateData.applicant_photo_doc != '' ? true : false;
        incomeCertificateData.show_birth_leaving_certy_doc = incomeCertificateData.birth_leaving_certy_doc != '' ? true : false;
        incomeCertificateData.show_aadhar_card_doc = incomeCertificateData.aadhar_card_doc != '' ? true : false;
        incomeCertificateData.show_election_card_doc = incomeCertificateData.election_card_doc != '' ? true : false;
        incomeCertificateData.show_income_proof_doc = incomeCertificateData.income_proof_doc != '' ? true : false;
        incomeCertificateData.show_marriage_certificate_doc = incomeCertificateData.marriage_certificate_doc != '' ? true : false;
        incomeCertificateData.show_death_certificate_doc = incomeCertificateData.death_certificate_doc != '' ? true : false;
        if (incomeCertificateData.marital_status == VALUE_ONE) {
            incomeCertificateData.show_spouse_aadhar_card_doc = incomeCertificateData.spouse_aadhar_card_doc != '' ? true : false;
            incomeCertificateData.show_spouse_election_card_doc = incomeCertificateData.spouse_election_card_doc != '' ? true : false;
        }
        incomeCertificateData.show_declaration_btn = moduleType == VALUE_ONE ? true : (incomeCertificateData.declaration == VALUE_ONE ? true : false);
        if (incomeCertificateData.status != VALUE_ZERO && incomeCertificateData.status != VALUE_ONE) {
            incomeCertificateData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(incomeCertificateViewTemplate(incomeCertificateData));
        if (incomeCertificateData.declaration == VALUE_ONE) {
            $('#declaration_for_income_certificate').click();
        }
        if (incomeCertificateData.applicant_have_earning_member == VALUE_ONE) {
            var efmData = JSON.parse(incomeCertificateData.member_details);
            var efmCnt = 2;
            $.each(efmData, function (index, efm) {
                var efmRow = '<tr><td class="text-center">' + efmCnt + '</td><td>' + efm.name_of_family_memb + '</td>' +
                        '<td class="text-center">' + efm.age_of_family_memb + '</td><td class="text-center">' + efm.member_relation + '</td>' +
                        '<td>' + (professionArray[efm.profession] ? (efm.profession == VALUE_TEN ? efm.other_occupation : professionArray[efm.profession]) : '') + '</td>' +
                        '<td class="text-right">' + indianCommaIncome(efm.yearly_income) + '</td></tr>';
                $('.efm_container_for_icview').append(efmRow);
                efmCnt++;
            });
        }
        if (incomeCertificateData.if_applicant_have_children == VALUE_ONE) {
            var childData = JSON.parse(incomeCertificateData.children_details);
            var childCnt = 1;
            $.each(childData, function (index, chd) {
                var childRow = '<tr><td class="text-center">' + childCnt + '</td><td>' + chd.name_of_children + '</td>' +
                        '<td class="text-center">' + chd.age_of_children + '</td>' +
                        '<td>' + (childProfessionArray[chd.profession] ? (chd.profession == VALUE_EIGHT ? chd.children_other_occupation : childProfessionArray[chd.profession]) : '') + '</td></tr>';
                $('.child_container_for_icview').append(childRow);
                childCnt++;
            });
        }
        if (incomeCertificateData.if_wife_husband_have_property == VALUE_ONE) {
            var immData = JSON.parse(incomeCertificateData.property_details);
            var immCnt = 1;
            $.each(immData, function (index, imm) {
                var immRow = '<tr><td class="text-center">' + immCnt + '</td><td>' +
                        (propertyTypeArray[imm.property_type] ? (imm.property_type == VALUE_THREE ? imm.other_property_type : propertyTypeArray[imm.property_type]) : '') + '</td>' +
                        '<td>' + imm.description_of_property + '</td>' +
                        '<td class="text-right">' + indianCommaIncome(imm.income_of_property) + '</td></tr>';
                $('.imm_container_for_icview').append(immRow);
                immCnt++;
            });
        }
        if (incomeCertificateData.have_you_any_member_income_otherside == VALUE_ONE) {
            var mioData = JSON.parse(incomeCertificateData.other_income_details);
            var mioCnt = 1;
            $.each(mioData, function (index, mio) {
                var mioRow = '<tr><td class="text-center">' + mioCnt + '</td><td>' +
                        (sourceOfIncomeArray[mio.source_of_income] ? (mio.source_of_income == VALUE_TWO ? mio.other_income_source : sourceOfIncomeArray[mio.source_of_income]) : '') + '</td>' +
                        '<td>' + mio.description_of_source_of_property + '</td>' +
                        '<td class="text-right">' + indianCommaIncome(mio.amount_of_income) + '</td></tr>';
                $('.mio_container_for_icview').append(mioRow);
                mioCnt++;
            });
        }
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_icview').click();
            }, 500);
        }
    },
    addMemberInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt = tempMemberCnt;
        $('#member_info_container_for_income_certificate').append(incomeCertificateMemberInfoTemplate(templateData));
        tempMemberCnt++;
        resetCounter('display-cnt');
    },
    checkValidationForIncomeCertificateOne: function (incomeCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateData.district_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('district_for_income_certificate', selectDistrictValidationMessage);
        }
        if (!incomeCertificateData.communication_address_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('communication_address_for_income_certificate', communicationAddressValidationMessage);
        }
        if (!incomeCertificateData.mobile_number_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_income_certificate', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(incomeCertificateData.mobile_number_for_income_certificate);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_income_certificate', mobileMessage);
        }
        if (!incomeCertificateData.applicant_name_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_income_certificate', applicantNameValidationMessage);
        }
        if (!incomeCertificateData.applicant_nationality_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_nationality_for_income_certificate', applicantNationalityValidationMessage);
        }
        if (!incomeCertificateData.applicant_address_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_address_for_income_certificate', communicationAddressValidationMessage);
        }
        if (!incomeCertificateData.village_dmc_ward_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('village_dmc_ward_for_income_certificate', oneOptionValidationMessage);
        }
        if (!incomeCertificateData.applicant_dob_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_income_certificate', birthDateValidationMessage);
        }
        if (!incomeCertificateData.applicant_age_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_income_certificate', applicantAgeValidationMessage);
        }
        if (!incomeCertificateData.applicant_born_place_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_born_place_for_income_certificate', applicantBornPlaceValidationMessage);
        }
        if (!incomeCertificateData.applicant_occupation_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_occupation_for_income_certificate', applicantOccupationValidationMessage);
        }
        if (incomeCertificateData.applicant_occupation_for_income_certificate == VALUE_TWELVE) {
            if (!incomeCertificateData.applicant_other_occupation_text_for_income_certificate) {
                return getBasicMessageAndFieldJSONArray('applicant_other_occupation_text_for_income_certificate', otherOccupationValidationMessage);
            }
        }
        if (!incomeCertificateData.applicant_yearly_income_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_yearly_income_for_income_certificate', applicantYearlyIncomeValidationMessage);
        }
        if (!incomeCertificateData.gender_for_income_certificate) {
            $('#gender_for_income_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('gender_for_income_certificate', genderValidationMessage);
        }
        if (!incomeCertificateData.marital_status_for_income_certificate) {
            $('#marital_status_for_income_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('marital_status_for_income_certificate', maritalStatusValidationMessage);
        }
        if (!incomeCertificateData.father_name_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('father_name_for_income_certificate', fatherNameValidationMessage);
        }
        if (!incomeCertificateData.father_occupation_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('father_occupation_for_income_certificate', fatherOccupationValidationMessage);
        }
        if (incomeCertificateData.father_occupation_for_income_certificate == VALUE_NINE) {
            if (!incomeCertificateData.father_other_occupation_text_for_income_certificate) {
                return getBasicMessageAndFieldJSONArray('father_other_occupation_text_for_income_certificate', otherOccupationValidationMessage);
            }
        }
        if (!incomeCertificateData.mother_name_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_name_for_income_certificate', motherNameValidationMessage);
        }
        if (!incomeCertificateData.mother_occupation_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('mother_occupation_for_income_certificate', motherOccupationValidationMessage);
        }
        if (incomeCertificateData.mother_occupation_for_income_certificate == VALUE_NINE) {
            if (!incomeCertificateData.mother_other_occupation_text_for_income_certificate) {
                return getBasicMessageAndFieldJSONArray('mother_other_occupation_text_for_income_certificate', otherOccupationValidationMessage);
            }
        }
        if (incomeCertificateData.marital_status_for_income_certificate == 1 || incomeCertificateData.marital_status_for_income_certificate == 3) {
            if (!incomeCertificateData.spouse_name_for_income_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_name_for_income_certificate', spouseNameValidationMessage);
            }
            if (!incomeCertificateData.spouse_occupation_for_income_certificate) {
                return getBasicMessageAndFieldJSONArray('spouse_occupation_for_income_certificate', spouseOccupationValidationMessage);
            }
            if (incomeCertificateData.spouse_occupation_for_income_certificate == VALUE_NINE) {
                if (!incomeCertificateData.spouse_other_occupation_text_for_income_certificate) {
                    return getBasicMessageAndFieldJSONArray('spouse_other_occupation_text_for_income_certificate', otherOccupationValidationMessage);
                }
            }
        }
        if (!incomeCertificateData.applicant_have_earning_member_for_income_certificate) {
            $('#applicant_have_earning_member_for_income_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('applicant_have_earning_member_for_income_certificate', oneOptionValidationMessage);
        }

        return '';
    },
    checkValidationForIncomeCertificateTwo: function (incomeCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateData.if_applicant_have_children_for_income_certificate) {
            $('#if_applicant_have_children_for_income_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('if_applicant_have_children_for_income_certificate', oneOptionValidationMessage);
        }
        return '';
    },
    checkValidationForIncomeCertificateThree: function (incomeCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateData.if_wife_husband_have_property_for_income_certificate) {
            $('#if_wife_husband_have_property_for_income_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('if_wife_husband_have_property_for_income_certificate', oneOptionValidationMessage);
        }
        return '';
    },
    checkValidationForIncomeCertificateFour: function (incomeCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateData.have_you_any_member_income_otherside_for_income_certificate) {
            $('#have_you_any_member_income_otherside_for_income_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('have_you_any_member_income_otherside_for_income_certificate', oneOptionValidationMessage);
        }
        return '';
    },
    checkValidationForIncomeCertificateFive: function (incomeCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateData.purpose_of_income_certificate_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('purpose_of_income_certificate_for_income_certificate', purposeOfIncomeCertyValidationMessage);
        }
        if (!incomeCertificateData.did_you_apply_income_certificate_before_for_income_certificate) {
            $('#did_you_apply_income_certificate_before_for_income_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('did_you_apply_income_certificate_before_for_income_certificate', oneOptionValidationMessage);
        }
        if (incomeCertificateData.did_you_apply_income_certificate_before_for_income_certificate == 1) {
            if (!incomeCertificateData.when_you_apply_income_certificate_for_income_certificate) {
                return getBasicMessageAndFieldJSONArray('when_you_apply_income_certificate_for_income_certificate', certificateDetailValidationMessage);
            }
        }
        return '';
    },
    checkValidationForIncomeCertificateSix: function (incomeCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateData.have_you_income_proof_for_income_certificate) {
            $('#have_you_income_proof_for_income_certificate_1').focus();
            return getBasicMessageAndFieldJSONArray('have_you_income_proof_for_income_certificate', oneOptionValidationMessage);
        }
        return '';
    },
    checkValidationForIncomeCertificateSeven: function (incomeCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateData.declaration_for_income_certificate) {
            return getBasicMessageAndFieldJSONArray('declaration_for_income_certificate', declarationValidationMessage);
        }
        return '';
    },
    askForSubmitIncomeCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'IncomeCertificate.listview.submitIncomeCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitIncomeCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var incomeCertificateData = $('#income_certificate_form').serializeFormJSON();
        var validationDataOne = that.checkValidationForIncomeCertificateOne(incomeCertificateData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('income-certificate-' + validationDataOne.field, validationDataOne.message);
            return false;
        }
        if (incomeCertificateData.applicant_have_earning_member_for_income_certificate == 1) {
            var icFamilyMemberItem = [];
            var isICFamilyMemberValidation = false;
            $('.income_certificate_family_member_info').each(function () {
                var cnt1 = $(this).find('.temp_cnt').val();
                var icFamilyMemberInfo = {};

                var familyMemberName = $('#name_of_family_memb_for_income_certificate_' + cnt1).val();
                if (familyMemberName == '' || familyMemberName == null) {
                    $('#name_of_family_memb_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-name_of_family_memb_for_income_certificate_' + cnt1, familyMemberNameValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
                icFamilyMemberInfo.name_of_family_memb = familyMemberName;
                var memberRelation = $('#member_relation_for_income_certificate_' + cnt1).val();
                if (memberRelation == '' || memberRelation == null) {
                    $('#member_relation_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-member_relation_for_income_certificate_' + cnt1, memberRelationValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
                icFamilyMemberInfo.member_relation = memberRelation;
                var memberAge = $('#age_of_family_memb_for_income_certificate_' + cnt1).val();
                if (memberAge == '' || memberAge == null) {
                    $('#age_of_family_memb_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-age_of_family_memb_for_income_certificate_' + cnt1, memberAgeValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
                icFamilyMemberInfo.age_of_family_memb = memberAge;
                var profession = $('#profession_for_income_certificate_' + cnt1).val();
                if (profession == '' || profession == null) {
                    $('#profession_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-profession_for_income_certificate_' + cnt1, professionValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
                icFamilyMemberInfo.profession = profession;
                var otherOccupation = '';
                if (profession == VALUE_TEN) {
                    otherOccupation = $('#earning_member_other_occupation_text_for_income_certificate_' + cnt1).val();
                    if (otherOccupation == '' || otherOccupation == null) {
                        $('#earning_member_other_occupation_text_for_income_certificate_' + cnt1).focus();
                        validationMessageShow('income-certificate-earning_member_other_occupation_text_for_income_certificate_' + cnt1, otherOccupationValidationMessage);
                        isICFamilyMemberValidation = true;
                        return false;
                    }
                }
                icFamilyMemberInfo.other_occupation = otherOccupation;
                var yearlyIncome = $('#yearly_income_for_income_certificate_' + cnt1).val();
                if (yearlyIncome == '' || yearlyIncome == null) {
                    $('#yearly_income_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-yearly_income_for_income_certificate_' + cnt1, yearlyIncomeValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
                icFamilyMemberInfo.yearly_income = yearlyIncome;
                icFamilyMemberItem.push(icFamilyMemberInfo);
            });
            if (isICFamilyMemberValidation) {
                return false;
            }
        }
        var validationDataTwo = that.checkValidationForIncomeCertificateTwo(incomeCertificateData);
        if (validationDataTwo != '') {
            $('#' + validationDataTwo.field).focus();
            validationMessageShow('income-certificate-' + validationDataTwo.field, validationDataTwo.message);
            return false;
        }
        if (incomeCertificateData.if_applicant_have_children_for_income_certificate == 1) {
            var icChildrenItem = [];
            var isICChildrenValidation = false;
            $('.income_certificate_children_info').each(function () {
                var cnt1 = $(this).find('.temp_cnt').val();
                var icChildrenInfo = {};
                var childrenName = $('#name_of_children_for_income_certificate_' + cnt1).val();
                if (childrenName == '' || childrenName == null) {
                    $('#name_of_children_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-name_of_children_for_income_certificate_' + cnt1, childrenNameValidationMessage);
                    isICChildrenValidation = true;
                    return false;
                }
                icChildrenInfo.name_of_children = childrenName;
                var childrenAge = $('#age_of_children_for_income_certificate_' + cnt1).val();
                if (childrenAge == '' || childrenAge == null) {
                    $('#age_of_children_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-age_of_children_for_income_certificate_' + cnt1, childrenAgeValidationMessage);
                    isICChildrenValidation = true;
                    return false;
                }
                icChildrenInfo.age_of_children = childrenAge;
                var childrenProfession = $('#profession_for_children_for_income_certificate_' + cnt1).val();
                if (childrenProfession == '' || childrenProfession == null) {
                    $('#profession_for_children_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-profession_for_children_for_income_certificate_' + cnt1, childrenProfessionValidationMessage);
                    isICChildrenValidation = true;
                    return false;
                }
                icChildrenInfo.profession = childrenProfession;
                var childrenOtherOccupation = '';
                if (childrenProfession == VALUE_EIGHT) {
                    childrenOtherOccupation = $('#children_other_occupation_text_for_income_certificate_' + cnt1).val();
                    if (childrenOtherOccupation == '' || childrenOtherOccupation == null) {
                        $('#children_other_occupation_text_for_income_certificate_' + cnt1).focus();
                        validationMessageShow('income-certificate-children_other_occupation_text_for_income_certificate_' + cnt1, otherOccupationValidationMessage);
                        isICChildrenValidation = true;
                        return false;
                    }
                }
                icChildrenInfo.children_other_occupation = childrenOtherOccupation;
                icChildrenItem.push(icChildrenInfo);
            });
            if (isICChildrenValidation) {
                return false;
            }
        }
        var validationDataThree = that.checkValidationForIncomeCertificateThree(incomeCertificateData);
        if (validationDataThree != '') {
            $('#' + validationDataThree.field).focus();
            validationMessageShow('income-certificate-' + validationDataThree.field, validationDataThree.message);
            return false;
        }
        if (incomeCertificateData.if_wife_husband_have_property_for_income_certificate == 1) {
            var icPropertyItem = [];
            var isICPropertyValidation = false;
            $('.income_certificate_property_info').each(function () {
                var cnt1 = $(this).find('.temp_cnt').val();
                var icPropertyInfo = {};
                var propertyType = $('#property_type_for_income_certificate_' + cnt1).val();
                if (propertyType == '' || propertyType == null) {
                    $('#property_type_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-property_type_for_income_certificate_' + cnt1, propertyTypeValidationMessage);
                    isICPropertyValidation = true;
                    return false;
                }
                icPropertyInfo.property_type = propertyType;
                var otherPropertyType = '';
                if (propertyType == VALUE_THREE) {
                    otherPropertyType = $('#other_property_type_text_for_income_certificate_' + cnt1).val();
                    if (otherPropertyType == '' || otherPropertyType == null) {
                        $('#other_property_type_text_for_income_certificate_' + cnt1).focus();
                        validationMessageShow('income-certificate-other_property_type_text_for_income_certificate_' + cnt1, otherPropertyTypeValidationMessage);
                        isICPropertyValidation = true;
                        return false;
                    }
                }
                icPropertyInfo.other_property_type = otherPropertyType;
                var description = $('#description_of_property_for_income_certificate_' + cnt1).val();
                // if (description == '' || description == null) {
                //     $('#description_of_property_for_income_certificate_' + cnt1).focus();
                //     validationMessageShow('income-certificate-description_of_property_for_income_certificate_' + cnt1, descriptionValidationMessage);
                //     isICPropertyValidation = true;
                //     return false;
                // }
                icPropertyInfo.description_of_property = description;
                var incomeOfProperty = $('#income_for_income_certificate_' + cnt1).val();
                if (incomeOfProperty == '' || incomeOfProperty == null) {
                    $('#income_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-income_for_income_certificate_' + cnt1, incomeOfPropertyValidationMessage);
                    isICPropertyValidation = true;
                    return false;
                }
                icPropertyInfo.income_of_property = incomeOfProperty;
                icPropertyItem.push(icPropertyInfo);
            });
            if (isICPropertyValidation) {
                return false;
            }
        }
        var validationDataFour = that.checkValidationForIncomeCertificateFour(incomeCertificateData);
        if (validationDataFour != '') {
            $('#' + validationDataFour.field).focus();
            validationMessageShow('income-certificate-' + validationDataFour.field, validationDataFour.message);
            return false;
        }
        if (incomeCertificateData.have_you_any_member_income_otherside_for_income_certificate == 1) {
            var icOtherIncomeItem = [];
            var isICOtherIncomeValidation = false;
            $('.income_certificate_other_income_info').each(function () {
                var cnt1 = $(this).find('.temp_cnt').val();
                var icOtherIncomeInfo = {};
                var sourceOfIncome = $('#source_of_income_for_income_certificate_' + cnt1).val();
                if (sourceOfIncome == '' || sourceOfIncome == null) {
                    $('#source_of_income_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-source_of_income_for_income_certificate_' + cnt1, sourceOfIncomeValidationMessage);
                    isICOtherIncomeValidation = true;
                    return false;
                }
                icOtherIncomeInfo.source_of_income = sourceOfIncome;
                var otherSourceOfIncome = '';
                if (sourceOfIncome == VALUE_TWO) {
                    otherSourceOfIncome = $('#other_income_source_text_for_income_certificate_' + cnt1).val();
                    if (otherSourceOfIncome == '' || otherSourceOfIncome == null) {
                        $('#other_income_source_text_for_income_certificate_' + cnt1).focus();
                        validationMessageShow('income-certificate-other_income_source_text_for_income_certificate_' + cnt1, otherSourceOfIncomeValidationMessage);
                        isICOtherIncomeValidation = true;
                        return false;
                    }
                }
                icOtherIncomeInfo.other_income_source = otherSourceOfIncome;
                var descriptionOfProperty = $('#description_of_source_of_property_for_income_certificate_' + cnt1).val();
                // if (descriptionOfProperty == '' || descriptionOfProperty == null) {
                //     $('#description_of_source_of_property_for_income_certificate_' + cnt1).focus();
                //     validationMessageShow('income-certificate-description_of_source_of_property_for_income_certificate_' + cnt1, descriptionOfPropertyValidationMessage);
                //     isICOtherIncomeValidation = true;
                //     return false;
                // }
                icOtherIncomeInfo.description_of_source_of_property = descriptionOfProperty;
                var amountOfOtherIncome = $('#amount_of_income_for_income_certificate_' + cnt1).val();
                if (amountOfOtherIncome == '' || amountOfOtherIncome == null) {
                    $('#amount_of_income_for_income_certificate_' + cnt1).focus();
                    validationMessageShow('income-certificate-amount_of_income_for_income_certificate_' + cnt1, amountOfOtherIncomeValidationMessage);
                    isICOtherIncomeValidation = true;
                    return false;
                }
                icOtherIncomeInfo.amount_of_income = amountOfOtherIncome;
                icOtherIncomeItem.push(icOtherIncomeInfo);
            });
            if (isICOtherIncomeValidation) {
                return false;
            }
        }
        var validationDataFive = that.checkValidationForIncomeCertificateFive(incomeCertificateData);
        if (validationDataFive != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('income-certificate-' + validationDataFive.field, validationDataFive.message);
            return false;
        }
        var validationDataSeven = that.checkValidationForIncomeCertificateSeven(incomeCertificateData);
        if (validationDataSeven != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('income-certificate-' + validationDataSeven.field, validationDataSeven.message);
            return false;
        }
        incomeCertificateData.module_type = moduleType;
        //incomeCertificateData.member_info = icMemberItem;
        incomeCertificateData.family_member_info = icFamilyMemberItem;
        incomeCertificateData.children_info = icChildrenItem;
        if (incomeCertificateData.if_wife_husband_have_property_for_income_certificate == 1)
            incomeCertificateData.property_info = icPropertyItem;
        if (incomeCertificateData.have_you_any_member_income_otherside_for_income_certificate == 1)
            incomeCertificateData.other_income_info = icOtherIncomeItem;
        var btnObj = $('#submit_btn_for_income_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'income_certificate/submit_income_certificate',
            data: $.extend({}, incomeCertificateData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (textStatus.status === 403) {
                    loginPage();
                    return false;
                }
                if (!textStatus.statusText) {
                    loginPage();
                    return false;
                }
                validationMessageShow('income-certificate', textStatus.statusText);
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
                    validationMessageShow('income-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                IncomeCertificate.listview.loadIncomeCertificateData();
                showSuccess(parseData.message);
            }
        });
    },
    addMemberInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt = tempMemberCnt;
        $('#member_info_container_for_income_certificate').append(incomeCertificateMemberInfoTemplate(templateData));
        tempMemberCnt++;
        resetCounter('display-cnt');
    },
    removeMemberInfo: function (perCnt) {
        $('#income_certificate_member_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    addFamilyMemberInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt = tempFamilyMemberCnt;
        $('#family_member_info_container_for_income_certificate').append(incomeCertificateFamilyMemberInfoTemplate(templateData));
        renderOptionsForTwoDimensionalArray(professionArray, 'profession_for_income_certificate_' + tempFamilyMemberCnt);
        allowOnlyIntegerValue('age_of_family_memb_for_income_certificate_' + tempFamilyMemberCnt);
        allowOnlyIntegerValue('yearly_income_for_income_certificate_' + tempFamilyMemberCnt);
        tempFamilyMemberCnt++;
        generateSelect2();
        resetCounter('display-cnt');
    },
    removeFamilyMemberInfo: function (perCnt) {
        $('#income_certificate_family_member_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    addChildrenInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt_child = tempChildrenCnt;
        $('#children_info_container_for_income_certificate').append(incomeCertificateChildrenInfoTemplate(templateData));
        renderOptionsForTwoDimensionalArray(childProfessionArray, 'profession_for_children_for_income_certificate_' + tempChildrenCnt);
        allowOnlyIntegerValue('age_of_children_for_income_certificate_' + tempChildrenCnt);
        tempChildrenCnt++;
        generateSelect2();
        resetCounter('display-cnt-child');
    },
    removeChildrenInfo: function (perCntChild) {
        $('#income_certificate_children_info_' + perCntChild).remove();
        resetCounter('display-cnt-child');
    },
    addPropertyInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt_property = tempPropertyCnt;
        $('#property_info_container_for_income_certificate').append(incomeCertificatePropertyInfoTemplate(templateData));
        renderOptionsForTwoDimensionalArray(propertyTypeArray, 'property_type_for_income_certificate_' + tempPropertyCnt);
        allowOnlyIntegerValue('value_of_property_for_income_certificate_' + tempPropertyCnt);
        allowOnlyIntegerValue('income_for_income_certificate_' + tempPropertyCnt);
        tempPropertyCnt++;
        generateSelect2();
        resetCounter('display-cnt-property');
    },
    removePropertyInfo: function (perCntProperty) {
        $('#income_certificate_property_info_' + perCntProperty).remove();
        resetCounter('display-cnt-property');
    },
    addOtherIncomeInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt_other_income = tempOtherIncomeCnt;
        $('#other_income_info_container_for_income_certificate').append(incomeCertificateOtherIncomeInfoTemplate(templateData));
        renderOptionsForTwoDimensionalArray(sourceOfIncomeArray, 'source_of_income_for_income_certificate_' + tempOtherIncomeCnt);
        allowOnlyIntegerValue('amount_of_income_for_income_certificate_' + tempOtherIncomeCnt);
        tempOtherIncomeCnt++;
        generateSelect2();
        resetCounter('display-cnt-other-income');
    },
    removeOtherIncomeInfo: function (perCntOtherIncome) {
        $('#income_certificate_other_income_info_' + perCntOtherIncome).remove();
        resetCounter('display-cnt-other-income');
    },
    askForApproveApplication: function (incomeCertificateId) {
        if (!incomeCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + incomeCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'income_certificate/get_income_certificate_data_by_income_certificate_id',
            type: 'post',
            data: $.extend({}, {'income_certificate_id': incomeCertificateId}, getTokenData()),
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
                var incomeCertificateData = parseData.income_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                var icData = that.getBasicConfigurationForMovement(incomeCertificateData);
                $('#popup_container').html(incomeCertificateApproveTemplate(icData));
                datePicker();
            }
        });
    },
    getBasicConfigurationForMovement: function (incomeCertificateData) {
        incomeCertificateData.total_income_by_user_text = numberToWordsAmount(incomeCertificateData.total_income);
        incomeCertificateData.total_income_by_talathi_text = numberToWordsAmount(incomeCertificateData.income_by_talathi);
        if (incomeCertificateData.talathi_to_aci != VALUE_ZERO) {
            incomeCertificateData.show_talathi_updated_basic_details = true;
        }
        if (incomeCertificateData.aci_rec == VALUE_ONE || incomeCertificateData.aci_rec == VALUE_TWO) {
            incomeCertificateData.show_aci_updated_basic_details = true;
            incomeCertificateData.aci_rec_text = recArray[incomeCertificateData.aci_rec] ? recArray[incomeCertificateData.aci_rec] : '';
            if (incomeCertificateData.aci_rec == VALUE_ONE) {
                incomeCertificateData.act_to_mamlatdar_ldc_datetime_text = incomeCertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.aci_to_ldc_datetime) : '';
                incomeCertificateData.act_to_mamlatdar_ldc_name_text = incomeCertificateData.ldc_name;
            }
            if (incomeCertificateData.aci_rec == VALUE_TWO) {
                incomeCertificateData.act_to_mamlatdar_ldc_datetime_text = incomeCertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.aci_to_mamlatdar_datetime) : '';
                incomeCertificateData.act_to_mamlatdar_ldc_name_text = incomeCertificateData.mamlatdar_name;
            }
        }
        if (incomeCertificateData.ldc_to_mamlatdar != VALUE_ZERO && incomeCertificateData.aci_rec == VALUE_ONE) {
            incomeCertificateData.show_ldc_updated_basic_details = true;
            incomeCertificateData.ldc_to_mamlatdar_datetime_text = incomeCertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        if (incomeCertificateData.to_type_reverify != VALUE_ZERO) {
            incomeCertificateData.show_mam_reverify_updated_basic_details = true;
            incomeCertificateData.mam_reverification = incomeCertificateData.to_type_reverify == VALUE_ONE ? incomeCertificateData.talathi_name : incomeCertificateData.aci_name;
        }
        if (incomeCertificateData.talathi_to_type_reverify != VALUE_ZERO) {
            incomeCertificateData.talathi_reverification = incomeCertificateData.talathi_to_type_reverify == VALUE_ONE ? incomeCertificateData.aci_name : incomeCertificateData.mamlatdar_name;
            incomeCertificateData.show_talathi_reverify_updated_basic_details = true;
            incomeCertificateData.total_income_by_talathi_reverify_text = numberToWordsAmount(incomeCertificateData.income_by_talathi_reverify);
        }
        if (incomeCertificateData.aci_rec_reverify == VALUE_ONE || incomeCertificateData.aci_rec_reverify == VALUE_TWO) {
            incomeCertificateData.show_aci_reverify_updated_basic_details = true;
            incomeCertificateData.aci_rec_reverify_text = recArray[incomeCertificateData.aci_rec_reverify] ? recArray[incomeCertificateData.aci_rec_reverify] : '';
            if (incomeCertificateData.aci_rec_reverify == VALUE_ONE) {
                incomeCertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = incomeCertificateData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.aci_to_ldc_datetime) : '';
                incomeCertificateData.act_to_mamlatdar_ldc_reverify_name_text = incomeCertificateData.ldc_name;
            }
            if (incomeCertificateData.aci_rec_reverify == VALUE_TWO) {
                incomeCertificateData.act_to_mamlatdar_ldc_reverify_datetime_text = incomeCertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.aci_to_reverify_datetime) : '';
                incomeCertificateData.act_to_mamlatdar_ldc_reverify_name_text = incomeCertificateData.mamlatdar_name;
            }
        }
        if (incomeCertificateData.ldc_to_mamlatdar != VALUE_ZERO && incomeCertificateData.aci_rec_reverify == VALUE_ONE) {
            incomeCertificateData.show_ldc_reverify_updated_basic_details = true;
            incomeCertificateData.ldc_to_mamlatdar_datetime_text = incomeCertificateData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.ldc_to_mamlatdar_datetime) : '';
        }
        incomeCertificateData.talathi_to_aci_datetime_text = incomeCertificateData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.talathi_to_aci_datetime) : '';
        incomeCertificateData.aci_to_mamlatdar_datetime_text = incomeCertificateData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.aci_to_mamlatdar_datetime) : '';
        incomeCertificateData.mam_to_reverify_datetime_text = incomeCertificateData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.mam_to_reverify_datetime) : '';
        incomeCertificateData.talathi_to_reverify_datetime_text = incomeCertificateData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.talathi_to_reverify_datetime) : '';
        incomeCertificateData.aci_to_reverify_datetime_text = incomeCertificateData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(incomeCertificateData.aci_to_reverify_datetime) : '';
        return incomeCertificateData;
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_income_certificate_form').serializeFormJSON();
        if (!formData.income_certificate_id_for_income_certificate_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_income_certificate_approve) {
            $('#remarks_for_income_certificate_approve').focus();
            validationMessageShow('income-certificate-approve-remarks_for_income_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_income_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'income_certificate/approve_application',
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
                validationMessageShow('income-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('income-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                IncomeCertificate.listview.loadIncomeCertificateData();
            }
        });
    },
    askForRejectApplication: function (incomeCertificateId) {
        if (!incomeCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + incomeCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'income_certificate/get_income_certificate_data_by_income_certificate_id',
            type: 'post',
            data: $.extend({}, {'income_certificate_id': incomeCertificateId}, getTokenData()),
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
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                var incomeCertificateData = parseData.income_certificate_data;
                showPopup();
                var icData = that.getBasicConfigurationForMovement(incomeCertificateData);
                $('#popup_container').html(incomeCertificateRejectTemplate(icData));
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_income_certificate_form').serializeFormJSON();
        if (!formData.income_certificate_id_for_income_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_income_certificate_reject) {
            $('#remarks_for_income_certificate_reject').focus();
            validationMessageShow('income-certificate-reject-remarks_for_income_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_income_certificate_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'income_certificate/reject_application',
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
                validationMessageShow('income-certificate-reject', textStatus.statusText);
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
                    validationMessageShow('income-certificate-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                IncomeCertificate.listview.loadIncomeCertificateData();
            }
        });
    },
    downloadCertificate: function (incomeCertificateId, moduleType) {
        if (!incomeCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#income_certificate_id_for_certificate').val(incomeCertificateId);
        $('#mtype_for_certificate').val(moduleType);
        $('#income_certificate_pdf_form').submit();
        $('#income_certificate_id_for_certificate').val('');
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
    getQueryData: function (incomeCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_TWO;
        templateData.module_id = incomeCertificateId;
        var btnObj = $('#query_btn_for_app_' + incomeCertificateId);
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
                tmpData.module_type = VALUE_TWO;
                tmpData.module_id = incomeCertificateId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    setAppointment: function (incomeCertificateId) {
        if (!incomeCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + incomeCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'income_certificate/get_appointment_data_by_income_certificate_id',
            type: 'post',
            data: $.extend({}, {'income_certificate_id': incomeCertificateId}, getTokenData()),
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
                $('#popup_container').html(incomeCertificateSetAppointmentTemplate(appointmentData));
                if (appointmentData.online_statement == VALUE_ONE) {
                    $('#online_statement_for_income_certificate').attr('checked', 'checked');
                }
                if (appointmentData.visit_office == VALUE_ONE) {
                    $('#visit_office_for_income_certificate').attr('checked', 'checked');
                }
                loadAppointmentHistory('income_certificate', appointmentData);
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
        var formData = $('#set_appointment_income_certificate_form').serializeFormJSON();
        if (!formData.income_certificate_id_for_income_certificate_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_income_certificate) {
            $('#appointment_date_for_income_certificate').focus();
            validationMessageShow('income-certificate-appointment_date_for_income_certificate', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_income_certificate) {
            $('#appointment_time_for_income_certificate').focus();
            validationMessageShow('income-certificate-appointment_time_for_income_certificate', timeValidationMessage);
            return false;
        }
        var start_date = dateTo_YYYY_MM_DD(formData.appointment_date_for_income_certificate); // Oct 1, 2014
        var d = new Date();
        var end_date = d.setDate(d.getDate() - 1);
        var new_start_date = new Date(start_date);
        var new_end_date = new Date(end_date);

        if (new_end_date > new_start_date) {
            //$('#appointment_date_for_income_certificate').focus();
            validationMessageShow('income-certificate-appointment_date_for_income_certificate', appointmentDateSelectValidationMessage);
            return false;
        }
        if (formData.online_statement_for_income_certificate == undefined && formData.visit_office_for_income_certificate == undefined) {
            $('#visit_office_for_income_certificate').focus();
            validationMessageShow('income-certificate-visit_office_for_income_certificate', appointmentTypeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_income_certificate_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'income_certificate/submit_set_appointment',
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
                validationMessageShow('income-certificate-set-appointment', textStatus.statusText);
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
                    validationMessageShow('income-certificate-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var incomeCertificateData = parseData.income_certificate_data;
                $('#appointment_container_' + incomeCertificateData.income_certificate_id).html(that.getAppointmentData(incomeCertificateData));
                $('#movement_for_ic_list_' + incomeCertificateData.income_certificate_id).html(movementString(incomeCertificateData));
            }
        });
    },
    reverifyApplication: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_income_certificate_form').serializeFormJSON();
        if (!formData.income_certificate_id_for_income_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if (!formData.to_type_reverify_for_income_certificate) {
                $('#to_type_reverify_for_income_certificate_1').focus();
                validationMessageShow('income-certificate-update-basic-detail-to_type_reverify_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.mam_reverify_remarks_for_income_certificate) {
                $('#mam_reverify_remarks_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-mam_reverify_remarks_for_income_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.talathi_to_type_reverify_for_income_certificate) {
                $('#talathi_to_type_reverify_for_income_certificate_1').focus();
                validationMessageShow('income-certificate-update-basic-detail-talathi_to_type_reverify_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.upload_reverification_document_for_income_certificate) {
                $('#upload_reverification_document_for_income_certificate_1').focus();
                validationMessageShow('income-certificate-update-basic-detail-upload_reverification_document_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_reverification_document_for_income_certificate == VALUE_ONE) {
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
            if (!formData.talathi_reverify_remarks_for_income_certificate) {
                $('#talathi_reverify_remarks_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-talathi_reverify_remarks_for_income_certificate', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_reverify_for_income_certificate) {
                $('#aci_rec_reverify_for_income_certificate_1').focus();
                validationMessageShow('income-certificate-update-basic-detail-aci_rec_reverify_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_reverify_remarks_for_income_certificate) {
                $('#aci_reverify_remarks_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-aci_reverify_remarks_for_income_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_income_certificate == VALUE_ONE && !formData.aci_to_ldc_reverify_for_income_certificate) {
                $('#aci_to_ldc_reverify_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-aci_to_ldc_reverify_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_income_certificate == VALUE_ONE && !formData.aci_to_type_reverify_for_income_certificate) {
                $('#aci_to_type_reverify_for_income_certificate_1').focus();
                validationMessageShow('income-certificate-update-basic-detail-aci_to_type_reverify_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'income_certificate/reverify_application',
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
                validationMessageShow('income-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('income-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var icData = parseData.income_certificate_data;
                if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
                    $('#status_' + formData.income_certificate_id_for_income_certificate_update_basic_detail).html(appStatusArray[VALUE_THREE]);
                    var reverificationName = formData.to_type_reverify_for_income_certificate == VALUE_ONE ? formData.talathi_name_for_income_certificate_update_basic_detail : formData.aci_name_for_income_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.income_certificate_id_for_income_certificate_update_basic_detail).html('<hr>' + reverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    var talathiReverificationName = formData.talathi_to_type_reverify_for_income_certificate == VALUE_ONE ? formData.aci_name_for_income_certificate_update_basic_detail : formData.mamlatdar_name_for_income_certificate_update_basic_detail;
                    $('#reverification_status_' + formData.income_certificate_id_for_income_certificate_update_basic_detail).html('<hr>' + talathiReverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    if (icData.aci_rec_reverify == VALUE_ONE) {
                        $('#reverification_status_' + formData.income_certificate_id_for_income_certificate_update_basic_detail).html('<hr>' + icData.ldc_name);
                    } else {
                        $('#reverification_status_' + formData.income_certificate_id_for_income_certificate_update_basic_detail).html('<hr>' + formData.mamlatdar_name_for_income_certificate_update_basic_detail);
                    }
                }
                $('#movement_for_ic_list_' + formData.income_certificate_id_for_income_certificate_update_basic_detail).html(movementString(parseData.income_certificate_data));
                resetModelMD();
            }
        });
    },
    updateBasicDetails: function (btnObj, incomeCertificateId) {
        if (!incomeCertificateId) {
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
            url: 'income_certificate/get_update_basic_detail_data_by_income_certificate_id',
            type: 'post',
            data: $.extend({}, {'income_certificate_id': incomeCertificateId}, getTokenData()),
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
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
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
                    basicDetailData.total_income_by_talathi_reverify_text = numberToWordsAmount(basicDetailData.income_by_talathi_reverify);
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
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && basicDetailData.aci_rec_reverify == VALUE_ONE) {
                    basicDetailData.show_ldc_reverify_updated_basic_details = true;
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                }
                basicDetailData.title = basicDetailData.to_type_reverify == VALUE_ZERO ? (tempTypeInSession == TEMP_TYPE_TALATHI_USER ? 'Forward for Verification' : (tempTypeInSession == TEMP_TYPE_ACI_USER ? 'Forward for Approval' : 'Update Basic Details')) : 'Reverification Income Certificate Form';
                basicDetailData.talathi_to_aci_datetime_text = basicDetailData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_aci_datetime) : '';
                basicDetailData.mam_to_reverify_datetime_text = basicDetailData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.mam_to_reverify_datetime) : '';
                basicDetailData.talathi_to_reverify_datetime_text = basicDetailData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_reverify_datetime) : '';
                basicDetailData.aci_to_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';

                if (basicDetailData.status == VALUE_FIVE || basicDetailData.status == VALUE_SIX) {
                    basicDetailData.show_approve_reject_details = true;
                    basicDetailData.status_text = returnAppStatus(basicDetailData.status);
                    basicDetailData.status_datetime_text = basicDetailData.status_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.status_datetime) : '';
                    basicDetailData.title = 'Movement Details of Income Certificate Form';
                }
                basicDetailData.status = queryStatus(basicDetailData.query_status);

                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    $('#model_md_title').html(basicDetailData.title);
                    $('#model_md_body').html(incomeCertificateUpdateBasicDetailTemplate(basicDetailData));
                } else {
                    basicDetailData.show_card = true;
                    $('#popup_container').html(incomeCertificateUpdateBasicDetailTemplate(basicDetailData));
                }
                if (basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) {
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                        generateBoxes('radio', yesNoArray, 'upload_verification_document', 'income_certificate', basicDetailData.is_upload_verification_document, false, false);
                        showSubContainer('upload_verification_document', 'income_certificate', '#field_verification_document_uploads', VALUE_ONE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.aci_data, 'talathi_to_aci_for_income_certificate', 'sa_user_id', 'name', '', false);
                        allowOnlyIntegerValue('income_by_talathi_for_income_certificate');

                        if (basicDetailData.field_documents != '') {
                            $.each(basicDetailData.field_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_ONE);
                                $('#upload_verification_document_for_income_certificate_1').attr('checked', 'checked');
                                $('#field_verification_document_uploads_container_for_income_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_ONE);
                            $('#upload_verification_document_for_income_certificate_2').attr('checked', 'checked');
                        }

                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                        basicDetailData.aci_rec = (basicDetailData.aci_rec == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec);
                        generateBoxes('radio', recArray, 'aci_rec', 'income_certificate', basicDetailData.aci_rec, false, false);
                        showSubContainer('aci_rec', 'income_certificate', '#aci_to_ldc', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec', 'income_certificate', '#aci_to_mamlatdar', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'aci_to_mamlatdar_for_income_certificate', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_for_income_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'ldc_to_mamlatdar_for_income_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.to_type_reverify == VALUE_ZERO) {
                        generateBoxes('radio', reverifyTypeArray, 'to_type_reverify', 'income_certificate', basicDetailData.to_type_reverify, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.to_type_reverify == VALUE_ONE) {
                        generateBoxes('radio', yesNoArray, 'upload_reverification_document', 'income_certificate', basicDetailData.is_upload_reverification_document, false, false);
                        showSubContainer('upload_reverification_document', 'income_certificate', '#field_reverification_document_uploads', VALUE_ONE, 'radio');
                        generateBoxes('radio', talathiReverifyTypeArray, 'talathi_to_type_reverify', 'income_certificate', basicDetailData.talathi_to_type_reverify, false);

                        if (basicDetailData.field_reverify_documents != '') {
                            $.each(basicDetailData.field_reverify_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_TWO);
                                $('#upload_reverification_document_for_income_certificate_1').attr('checked', 'checked');
                                $('#field_reverification_document_uploads_container_for_income_certificate').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_TWO);
                            $('#upload_reverification_document_for_income_certificate_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                            (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                        var tempArray = [];
                        tempArray[VALUE_ZERO] = basicDetailData.mamlatdar_name;
                        generateBoxes('radio', tempArray, 'aci_to_type_reverify', 'income_certificate', VALUE_ZERO, false);

                        basicDetailData.aci_rec_reverify = (basicDetailData.aci_rec_reverify == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec_reverify);
                        generateBoxes('radio', recArray, 'aci_rec_reverify', 'income_certificate', basicDetailData.aci_rec_reverify, false, false);
                        showSubContainer('aci_rec_reverify', 'income_certificate', '#aci_to_ldc_reverify', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec_reverify', 'income_certificate', '#aci_to_mamlatdar_reverify', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_reverify_for_income_certificate', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec_reverify == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        var tempArray = [];
                        var tArray = {};
                        tArray['name'] = basicDetailData.mamlatdar_name;
                        tArray['sa_user_id'] = basicDetailData.aci_to_mamlatdar;
                        tempArray.push(tArray);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempArray, 'ldc_to_mamlatdar_for_income_certificate', 'sa_user_id', 'name', '', false);
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
        var formData = $('#update_basic_detail_income_certificate_form').serializeFormJSON();
        if (!formData.income_certificate_id_for_income_certificate_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.upload_verification_document_for_income_certificate) {
                $('#upload_verification_document_for_income_certificate_1').focus();
                validationMessageShow('income-certificate-update-basic-detail-upload_verification_document_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_verification_document_for_income_certificate == VALUE_ONE) {
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
            if (!formData.talathi_remarks_for_income_certificate) {
                $('#talathi_remarks_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-talathi_remarks_for_income_certificate', remarksValidationMessage);
                return false;
            }
            if (!formData.talathi_to_aci_for_income_certificate) {
                $('#talathi_to_aci_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-talathi_to_aci_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_for_income_certificate) {
                $('#aci_rec_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-aci_rec_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_remarks_for_income_certificate) {
                $('#aci_remarks_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-aci_remarks_for_income_certificate', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_income_certificate == VALUE_ONE && !formData.aci_to_ldc_for_income_certificate) {
                $('#aci_to_ldc_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-aci_to_ldc_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_income_certificate == VALUE_TWO && !formData.aci_to_mamlatdar_for_income_certificate) {
                $('#aci_to_mamlatdar_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-aci_to_mamlatdar_for_income_certificate', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            if (!formData.ldc_applicant_name_for_income_certificate) {
                $('#ldc_applicant_name_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-ldc_applicant_name_for_income_certificate', applicantNameValidationMessage);
                return false;
            }
            if (!formData.communication_address_for_income_certificate) {
                $('#communication_address_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-communication_address_for_income_certificate', communicationAddressValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_income_certificate) {
                $('#ldc_to_mamlatdar_remarks_for_income_certificate').focus();
                validationMessageShow('income-certificate-update-basic-detail-ldc_to_mamlatdar_remarks_for_income_certificate', remarksValidationMessage);
                return false;
            }
            if (!showLDCDraftBtn) {
                formData.update_ldc_mam_details = VALUE_ONE;
                if (!formData.ldc_to_mamlatdar_for_income_certificate) {
                    $('#ldc_to_mamlatdar_for_income_certificate').focus();
                    validationMessageShow('income-certificate-update-basic-detail-ldc_to_mamlatdar_for_income_certificate', oneOptionValidationMessage);
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
            url: 'income_certificate/forward_to',
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
                validationMessageShow('income-certificate-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('income-certificate-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#movement_for_ic_list_' + parseData.income_certificate_id).html(movementString(parseData.income_certificate_data));
                resetModelMD();
            }
        });
    },
    getYearlyIncomeTotal: function () {
        var totalIncome = 0;
        $('.income_certificate_family_member_info').each(function () {
            var cnt1 = $(this).find('.temp_cnt').val();

            var yearlyIncome = $('#yearly_income_for_income_certificate_' + cnt1).val();
            currentRow = parseFloat(yearlyIncome);
            totalIncome += currentRow;
        });
        $('#total_income_for_income_certificate').val(totalIncome);
    },
    getDocumentData: function (incomeCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!incomeCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#income_certificate_id_for_scrutiny').val(incomeCertificateId);
        $('#income_certificate_document_for_scrutiny').submit();
        $('#income_certificate_id_for_scrutiny').val('');
    },
    districtChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'village_dmc_ward_for_income_certificate');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_dmc_ward_for_income_certificate');
    },
    downloadDeclaration: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var icId = $('#income_certificate_id_for_ic_declaration').val();
        if (!icId) {
            validationMessageShow('income-certificate-declaration_for_income_certificate', invalidAccessValidationMessage);
            return false;
        }
        $('#ic_declaration_pdf').submit();
    },
    downloadExcelForIC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_icge').val($('#app_no_for_income_certificate_list').val());
        $('#app_date_for_icge').val($('#application_date_for_income_certificate_list').val());
        $('#app_details_for_icge').val($('#app_details_for_income_certificate_list').val());
        $('#vdw_for_icge').val(tempTypeInSession != TEMP_TYPE_A ? $('#vdw_for_income_certificate_list').val() : '');
        $('#status_for_icge').val($('#status_for_income_certificate_list').val());
        $('#qstatus_for_icge').val($('#query_status_for_income_certificate_list').val());
        $('#app_status_for_icge').val($('#appointment_status_for_income_certificate_list').val());
        $('#currently_on_for_icge').val($('#currently_on_for_income_certificate_list').val());
        $('#generate_excel_for_income_certificate').submit();
        $('.icge').val('');
    },
    addVerificationDocItem: function (docData, moduleId) {
        var that = this;
        docData.cnt = verifyDocCnt;
        docData.verification_type = moduleId;
        $('#upload_verification_doc_item_container_for_income_certificate_' + moduleId).append(fieldVerificationDocItemTemplate(docData));
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
        formData.append('income_certificate_id_for_income_certificate_update_basic_detail', $('#income_certificate_id_for_income_certificate_update_basic_detail').val());
        formData.append('field_document_id_for_field_verification', $('#field_document_id_for_field_verification_' + tempCnt).val());
        formData.append('verification_type_for_field_verification', $('#verification_type_for_field_verification_' + tempCnt).val());
        formData.append('document_for_verification_document', $('#' + id)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'income_certificate/upload_field_verification_document',
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
        $('#' + documentFieldName + '_name_href_for_verification_document_' + cnt).attr('href', 'documents/income_certificate/' + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_verification_document_' + cnt).html(VIEW_UPLODED_DOCUMENT);
        $('#' + documentFieldName + '_remove_btn_for_verification_document_' + cnt).attr('onclick', 'IncomeCertificate.listview.askForRemoveDocForFieldVerification("' + docItemData.field_verification_document_id + '","' + cnt + '")');
    },
    askForRemoveDocForFieldVerification: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'IncomeCertificate.listview.removeFieldDoc(' + fieldDocumentId + ', ' + cnt + ')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeFieldDoc: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'income_certificate/remove_field_document',
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
        var yesEvent = 'IncomeCertificate.listview.removeFieldItemRow(' + cnt + ')';
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
            url: 'income_certificate/remove_field_document_item',
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(fieldVerificationViewDocItemTemplate(docDetail));
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(fieldVerificationViewDocItemTemplate(reDocDetail));
                if (reDocDetail['document'] != '') {
                    that.loadFieldDocForView(reDocDetail.cnt, 'document', 'field_reverification', reDocDetail.document);
                }
            });
        }
    },
    loadFieldDocForView: function (tempCnt, id, moduleType, docField) {
        $('#' + id + '_container_for_' + moduleType + '_view_' + tempCnt).hide();
        $('#' + id + '_name_container_for_' + moduleType + '_view_' + tempCnt).show();
        $('#' + id + '_name_href_for_' + moduleType + '_view_' + tempCnt).attr('href', 'documents/income_certificate/' + docField);
        $('#' + id + '_name_for_' + moduleType + '_view_' + tempCnt).html(VIEW_UPLODED_DOCUMENT);
    },
});
