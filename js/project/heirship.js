var heirshipListTemplate = Handlebars.compile($('#heirship_list_template').html());
var heirshipSearchTemplate = Handlebars.compile($('#heirship_search_template').html());
var heirshipTableTemplate = Handlebars.compile($('#heirship_table_template').html());
var heirshipActionTemplate = Handlebars.compile($('#heirship_action_template').html());
var heirshipFormTemplate = Handlebars.compile($('#heirship_form_template').html());
var heirshipViewTemplate = Handlebars.compile($('#heirship_view_template').html());
var heirshipApproveTemplate = Handlebars.compile($('#heirship_approve_template').html());
var heirshipRejectTemplate = Handlebars.compile($('#heirship_reject_template').html());
var heirshipViewDocumentTemplate = Handlebars.compile($('#heirship_view_document_template').html());
var heirshipFamilyMemberInfoTemplate = Handlebars.compile($('#heirship_family_member_info_template').html());
var heirshipSetAppointmentTemplate = Handlebars.compile($('#heirship_set_appointment_template').html());
var heirshipUpdateBasicDetailTemplate = Handlebars.compile($('#heirship_update_basic_detail_template').html());
var heirshipUdbFdItemTemplate = Handlebars.compile($('#heirship_udb_fd_item_template').html());
var heirshipfieldVerificationDocItemTemplate = Handlebars.compile($('#heirship_field_verification_document_template').html());
var heirshipfieldVerificationViewDocItemTemplate = Handlebars.compile($('#heirship_field_verification_view_document_template').html());

var tempMemberCnt = 1;
var tempFamilyMemberCnt = 1;
var tempWitnessCnt = 1;
var tempPropertyCnt = 1;
var tempOtherIncomeCnt = 1;
var tempACIData = [];
var tempMamData = [];
var verifyDocCnt = 1;
var searchHCF = {};

var Heirship = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Heirship.Router = Backbone.Router.extend({
    routes: {
        'heirship': 'renderList',
        'heirship_form': 'renderList',
        'edit_heirship_form': 'renderList',
        'view_heirship_form': 'renderList',
    },
    renderList: function () {
        Heirship.listview.listPage();
    },
});
Heirship.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="have_you_any_member_income_otherside_for_heirship"]': 'haveOtherMembIncome',
        'click input[name="other"]': 'haveOtherProfession',
    },
    haveOtherMembIncome: function (event) {
        var val = $('input[name=have_you_any_member_income_otherside_for_heirship]:checked').val();
        if (val == '1') {
            this.$('.have_you_any_member_income_otherside_for_heirship_div').show();
        } else {
            this.$('.have_you_any_member_income_otherside_for_heirship_div').hide();

        }
    },
    haveOtherProfession: function (event) {
        var val = $('input[name=other]:checked').val();
        if (val == '1') {
            this.$('.other_div').show();
        } else {
            this.$('.other_div').hide();

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
        addClass('menu_heirship', 'active');
        Heirship.router.navigate('heirship');
        var templateData = {};
        searchHCF = {};
        this.$el.html(heirshipListTemplate(templateData));
        this.loadHeirshipData(sDistrict, sType);

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
        return heirshipActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        var onlineStatement = appointmentData.online_statement == VALUE_ONE ? 'Online Statement' : '';
        var visitOffice = appointmentData.visit_office == VALUE_ONE ? 'Visit Office' : '';
        if (appointmentData.appointment_date == '0000-00-00') {
            return '<span id="appointment_container_' + appointmentData.heirship_id + '" class="badge bg-warning app-status">Appointment Not Scheduled By Talathi</span>';
        }
        var returnString = '<span id="appointment_container_' + appointmentData.heirship_id + '"><span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">' + onlineStatement;
        if (onlineStatement != '' && visitOffice != '') {
            returnString += ',<br>';
        }
        returnString += (visitOffice + '</span>');
        return returnString;
    },
    loadHeirshipData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;

        var that = this;
        Heirship.router.navigate('heirship');
        var searchData = dtomMam(sDistrict, sType, 'Heirship.listview.loadHeirshipData();');
        $('#heirship_form_and_datatable_container').html(heirshipSearchTemplate(searchData));
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            renderOptionsForTwoDimensionalArray(appointmentFilterArray, 'appointment_status_for_heirship_list', false);
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(currentlyOnTypeArray, 'currently_on_for_heirship_list', false);
        }

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_heirship_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_heirship_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_heirship_list', false);
        datePickerId('application_date_for_heirship_list');

        if (tempTypeInSession != TEMP_TYPE_A) {
            var dwVillagesData = (tempDistrictInSession == VALUE_ONE ? damanVillagesArray : (tempDistrictInSession == VALUE_TWO ? diuVillagesArray : (tempDistrictInSession == VALUE_THREE ? dnhVillagesArray : [])));
            if (tempAVInSession != '') {
                var avData = tempAVInSession.split(',');
                renderOptionsForAVArray(avData, dwVillagesData, 'vdw_for_heirship_list', false);
            } else {
                renderOptionsForTwoDimensionalArray(dwVillagesData, 'vdw_for_heirship_list', false);
            }
        } else {
            if (typeof searchHCF.district_for_heirship_list != "undefined" && searchHCF.district_for_heirship_list != '' && searchHCF.village_for_heirship_list != '') {
                var villageData = (searchHCF.district_for_heirship_list == VALUE_ONE ? damanVillagesArray : (searchHCF.district_for_heirship_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_heirship_list', false);
            }
        }

        $('#app_no_for_heirship_list').val((typeof searchHCF.app_no_for_heirship_list != "undefined" && searchHCF.app_no_for_heirship_list != '') ? searchHCF.app_no_for_heirship_list : '');
        $('#application_date_for_heirship_list').val((typeof searchHCF.application_date_for_heirship_list != "undefined" && searchHCF.application_date_for_heirship_list != '') ? searchHCF.application_date_for_heirship_list : searchData.s_appd);
        $('#app_details_for_heirship_list').val((typeof searchHCF.app_details_for_heirship_list != "undefined" && searchHCF.app_details_for_heirship_list != '') ? searchHCF.app_details_for_heirship_list : '');
        $('#appointment_status_for_heirship_list').val((typeof searchHCF.appointment_status_for_heirship_list != "undefined" && searchHCF.appointment_status_for_heirship_list != '') ? searchHCF.appointment_status_for_heirship_list : searchData.s_app_status);
        $('#query_status_for_heirship_list').val((typeof searchHCF.query_status_for_heirship_list != "undefined" && searchHCF.query_status_for_heirship_list != '') ? searchHCF.query_status_for_heirship_list : searchData.s_qstatus);
        $('#status_for_heirship_list').val((typeof searchHCF.status_for_heirship_list != "undefined" && searchHCF.status_for_heirship_list != '') ? searchHCF.status_for_heirship_list : searchData.s_status);
        $('#currently_on_for_heirship_list').val((typeof searchHCF.currently_on_for_heirship_list != "undefined" && searchHCF.currently_on_for_heirship_list != '') ? searchHCF.currently_on_for_heirship_list : searchData.s_co_hand);
        $('#district_for_heirship_list').val((typeof searchHCF.district_for_heirship_list != "undefined" && searchHCF.district_for_heirship_list != '') ? searchHCF.district_for_heirship_list : searchData.search_district);
        $('#vdw_for_heirship_list').val((typeof searchHCF.vdw_for_heirship_list != "undefined" && searchHCF.vdw_for_heirship_list != '') ? searchHCF.vdw_for_heirship_list : '');
        $('#is_full_for_heirship_list').val((typeof searchHCF.is_full_for_heirship_list != "undefined" && searchHCF.is_full_for_heirship_list != '') ? searchHCF.is_full_for_heirship_list : searchData.s_is_full);

        this.searchHeirshipData();
    },
    searchHeirshipData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#heirship_datatable_container').html(heirshipTableTemplate);
        var searchData = $('#search_heirship_form').serializeFormJSON();

        searchHCF = searchData;
        if (typeof btnObj == "undefined" && (searchHCF.app_details_for_heirship_list == ''
                && searchHCF.app_no_for_heirship_list == ''
                && searchHCF.application_date_for_heirship_list == ''
                && searchHCF.appointment_status_for_heirship_list == ''
                && searchHCF.query_status_for_heirship_list == ''
                && searchHCF.status_for_heirship_list == ''
                && searchHCF.is_full_for_heirship_list == ''
                && (searchHCF.district_for_heirship_list == '' || typeof searchHCF.district_for_heirship_list == "undefined")
                && (searchHCF.vdw_for_heirship_list == '' || typeof searchHCF.vdw_for_heirship_list == "undefined")
                && (searchHCF.currently_on_for_heirship_list == '' || typeof searchHCF.currently_on_for_heirship_list == "undefined"))) {
            heirshipDataTable = $('#heirship_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#heirship_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.pre_house_no + ', ' + (full.pre_house_name == '' ? '' : full.pre_house_name + ',') + full.pre_street + ', ' + (full.pre_village ? full.pre_village : '') + ', ' + full.pre_city + ', ' + full.pre_pincode +
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
        $('#heirship_datatable_container').html(heirshipTableTemplate);
        heirshipDataTable = $('#heirship_datatable').DataTable({
            ajax: {
                url: 'heirship/get_heirship_data', dataSrc: "heirship_data",
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
                {data: 'heirship_id', 'class': 'v-a-t text-center', 'render': appointmentRenderer},
                {data: 'heirship_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'heirship_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'heirship_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "fnRowCallback": aciNR,
            "initComplete": searchableDatatable
        });
        $('#heirship_datatable_filter').remove();
        $('#heirship_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = heirshipDataTable.row(tr);

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
    newHeirshipForm: function (heirshipData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        Heirship.router.navigate('edit_heirship_form');
        tempFamilyMemberCnt = 1;
        heirshipData.VALUE_ONE = VALUE_ONE;
        heirshipData.VALUE_TWO = VALUE_TWO;
        heirshipData.VALUE_THREE = VALUE_THREE;
        heirshipData.VALUE_FOUR = VALUE_FOUR;
        heirshipData.VALUE_FIVE = VALUE_FIVE;
        heirshipData.VALUE_SIX = VALUE_SIX;
        heirshipData.VALUE_SEVEN = VALUE_SEVEN;
        heirshipData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        heirshipData.applicant_dob_text = heirshipData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(heirshipData.applicant_dob) : '';
        heirshipData.death_date_text = heirshipData.death_date != '0000-00-00' ? dateTo_DD_MM_YYYY(heirshipData.death_date) : '';
        heirshipData.declaration_date_text = heirshipData.declaration_date != '0000-00-00' ? dateTo_DD_MM_YYYY(heirshipData.declaration_date) : '';
        heirshipData.district_text = talukaArray[heirshipData.district] ? talukaArray[heirshipData.district] : '';
        $('#heirship_form_and_datatable_container').html(heirshipFormTemplate(heirshipData));
        $('#view_document_container_for_heirship').html(heirshipViewDocumentTemplate(heirshipData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_heirship');
        var district = heirshipData.district;
        var villageData = (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : [])));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_heirship');
        renderOptionsForTwoDimensionalArray(villageData, 'pre_village_for_heirship');
        renderOptionsForTwoDimensionalArray(villageData, 'per_village_for_heirship');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'applicant_occupation_for_heirship');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'witness1_occupation_for_heirship');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'witness2_occupation_for_heirship');
        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relation_deceased_person_for_heirship');
        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relation_with_applicant_for_heirship');
        generateBoxes('radio', genderArray, 'gender', 'heirship', heirshipData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'heirship', heirshipData.marital_status, false, false);
        showSubContainer('marital_status', 'heirship', '.marital_status_item', VALUE_ONE, 'radio');
        generateBoxes('radio', maritalStatusArray, 'death_marital_status', 'heirship', heirshipData.death_marital_status, false, false);
        showSubContainer('marital_status', 'heirship', '.marital_status_item', VALUE_ONE, 'radio');
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_heirship');
            $('#district_for_heirship').val(heirshipData.district);
        }
        $('#district_for_heirship').val(heirshipData.district);
        $('#applicant_age_for_heirship').val(heirshipData.applicant_age);
        $('#applicant_occupation_for_heirship').val(heirshipData.occupation);
        if (heirshipData.occupation == VALUE_TWELVE) {
            $('#applicant_occupation_other_div_for_heirship').show();
        } else {
            $('#applicant_occupation_other_div_for_heirship').hide();
        }
        $('#witness1_occupation_for_heirship').val(heirshipData.witness1_occupation);
        if (heirshipData.witness1_occupation == VALUE_TWELVE) {
            $('#witness1_occupation_other_for_heirship').show();
        } else {
            $('#witness1_occupation_other_for_heirship').hide();
        }
        $('#witness2_occupation_for_heirship').val(heirshipData.witness2_occupation);
        if (heirshipData.witness2_occupation == VALUE_TWELVE) {
            $('#witness2_occupation_other_for_heirship').show();
        } else {
            $('#witness2_occupation_other_for_heirship').hide();
        }
        $('#pre_city_for_heirship').val(heirshipData.pre_city);
        $('#per_city_for_heirship').val(heirshipData.per_city);
        $('#village_name_for_heirship').val(heirshipData.village_name);
        $('#pre_village_for_heirship').val(heirshipData.pre_village);
        $('#per_village_for_heirship').val(heirshipData.per_village);
        $('#relation_deceased_person_for_heirship').val(heirshipData.relation_deceased_person);
        $('#relation_with_applicant_for_heirship').val(heirshipData.relation_with_applicant);

        var cntFm = 1;
        if (heirshipData.legal_heirs_details != '') {
            var familyMemberDetails = JSON.parse(heirshipData.legal_heirs_details);
            $.each(familyMemberDetails, function (key, value) {
                that.addFamilyMemberInfo(value, true);
                if (value.member_remarks == VALUE_TWO) {
                    $('#age_of_family_memb_for_heirship_' + cntFm).hide();
                }
                $('#member_marital_status_for_heirship_' + cntFm).val(value.member_marital_status);
                $('#member_relation_for_heirship_' + cntFm).val(value.member_relation);
                $('#member_remarks_for_heirship_' + cntFm).val(value.member_remarks);
                cntFm++;
            });
        }

        $('#declaration_for_heirship').click();
        that.viewDocument(heirshipData);
        generateSelect2();
        datePicker();
        datePicker('applicant_dob_for_heirship');
        datePickerToday('death_date_for_heirship');
        if (heirshipData.date != '0000-00-00') {
            $('#date_for_heirship').val(dateTo_DD_MM_YYYY(heirshipData.date));
        }
        $('#heirship_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.askForSubmitHeirship(VALUE_TWO);
            }
        });
    },
    viewDocument: function (heirshipData) {
        var that = this;
        if (heirshipData.death_certificate_doc != '') {
            that.showDocument('death_certificate_doc_container_for_heirship', 'death_certificate_doc_name_image_for_heirship', 'death_certificate_doc_name_container_for_heirship',
                    'death_certificate_doc_download', 'death_certificate_doc', heirshipData.death_certificate_doc, heirshipData.heirship_id, VALUE_ONE);
        }
        if (heirshipData.death_aadhar_card_doc != '') {
            that.showDocument('death_aadhar_card_doc_container_for_heirship', 'death_aadhar_card_doc_name_image_for_heirship', 'death_aadhar_card_doc_name_container_for_heirship',
                    'death_aadhar_card_doc_download', 'death_aadhar_card_doc', heirshipData.death_aadhar_card_doc, heirshipData.heirship_id, VALUE_TWO);
        }
        if (heirshipData.marriage_certificate_doc != '') {
            that.showDocument('marriage_certificate_doc_container_for_heirship', 'marriage_certificate_doc_name_image_for_heirship', 'marriage_certificate_doc_name_container_for_heirship',
                    'marriage_certificate_doc_download', 'marriage_certificate_doc', heirshipData.marriage_certificate_doc, heirshipData.heirship_id, VALUE_THREE);
        }
        if (heirshipData.aadhar_card_doc != '') {
            that.showDocument('aadhar_card_doc_container_for_heirship', 'aadhar_card_doc_name_image_for_heirship', 'aadhar_card_doc_name_container_for_heirship',
                    'aadhar_card_doc_download', 'aadhar_card_doc', heirshipData.aadhar_card_doc, heirshipData.heirship_id, VALUE_FOUR);
        }
        if (heirshipData.panchayat_certificate_doc != '') {
            that.showDocument('panchayat_certificate_doc_container_for_heirship', 'panchayat_certificate_doc_name_image_for_heirship', 'panchayat_certificate_doc_name_container_for_heirship',
                    'panchayat_certificate_doc_download', 'panchayat_certificate_doc', heirshipData.panchayat_certificate_doc, heirshipData.heirship_id, VALUE_FIVE);
        }
        if (heirshipData.community_certificate_doc != '') {
            that.showDocument('community_certificate_doc_container_for_heirship', 'community_certificate_doc_name_image_for_heirship', 'community_certificate_doc_name_container_for_heirship',
                    'community_certificate_doc_download', 'community_certificate_doc', heirshipData.community_certificate_doc, heirshipData.heirship_id, VALUE_SIX);
        }
        if (heirshipData.applicant_photo_doc != '') {
            that.showDocument('applicant_photo_doc_container_for_heirship', 'applicant_photo_doc_name_image_for_heirship', 'applicant_photo_doc_name_container_for_heirship',
                    'applicant_photo_doc_download', 'applicant_photo_doc', heirshipData.applicant_photo_doc, heirshipData.heirship_id, VALUE_SEVEN);
        }
        if (heirshipData.witness1_photo_doc != '') {
            that.showDocument('witness1_photo_doc_container_for_heirship', 'witness1_photo_doc_name_image_for_heirship', 'witness1_photo_doc_name_container_for_heirship',
                    'witness1_photo_doc_download', 'witness1_photo_doc', heirshipData.witness1_photo_doc, heirshipData.heirship_id, VALUE_EIGHT);
        }
        if (heirshipData.witness2_photo_doc != '') {
            that.showDocument('witness2_photo_doc_container_for_heirship', 'witness2_photo_doc_name_image_for_heirship', 'witness2_photo_doc_name_container_for_heirship',
                    'witness2_photo_doc_download', 'witness2_photo_doc', heirshipData.witness2_photo_doc, heirshipData.heirship_id, VALUE_NINE);
        }
        if (heirshipData.witness1_aadhar_doc != '') {
            that.showDocument('witness1_aadhar_doc_container_for_heirship', 'witness1_aadhar_doc_name_image_for_heirship', 'witness1_aadhar_doc_name_container_for_heirship',
                    'witness1_aadhar_doc_download', 'witness1_aadhar_doc', heirshipData.witness1_aadhar_doc, heirshipData.heirship_id, VALUE_TEN);
        }
        if (heirshipData.witness2_aadhar_doc != '') {
            that.showDocument('witness2_aadhar_doc_container_for_heirship', 'witness2_aadhar_doc_name_image_for_heirship', 'witness2_aadhar_doc_name_container_for_heirship',
                    'witness2_aadhar_doc_download', 'witness2_aadhar_doc', heirshipData.witness2_aadhar_doc, heirshipData.heirship_id, VALUE_ELEVEN);
        }
        if (heirshipData.applicant_witness_photo_notary_affidavit_doc != '') {
            that.showDocument('applicant_witness_photo_notary_affidavit_doc_container_for_heirship', 'applicant_witness_photo_notary_affidavit_doc_name_image_for_heirship', 'applicant_witness_photo_notary_affidavit_doc_name_container_for_heirship',
                    'applicant_witness_photo_notary_affidavit_doc_download', 'applicant_witness_photo_notary_affidavit_doc', heirshipData.applicant_witness_photo_notary_affidavit_doc, heirshipData.heirship_id, VALUE_ELEVEN);
        }
        if (heirshipData.property_documents_doc != '') {
            that.showDocument('property_documents_doc_container_for_heirship', 'property_documents_doc_name_image_for_heirship', 'property_documents_doc_name_container_for_heirship',
                    'property_documents_doc_download', 'property_documents_doc', heirshipData.property_documents_doc, heirshipData.heirship_id, VALUE_ELEVEN);
        }
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', HEIRSHIP_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", HEIRSHIP_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Heirship.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },
    editOrViewHeirship: function (btnObj, heirshipId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!heirshipId) {
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
            url: 'heirship/get_heirship_data_by_id',
            type: 'post',
            data: $.extend({}, {'heirship_id': heirshipId}, getTokenData()),
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
                var heirshipData = parseData.heirship_data;
                if (isEdit) {
                    that.newHeirshipForm(heirshipData);
                } else {
                    that.viewHeirshipForm(VALUE_THREE, heirshipData, isPrint);
                }
            }
        });
    },
    viewHeirshipForm: function (moduleType, heirshipData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
//        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
//            showError(invalidAccessValidationMessage+'1');
//            return;
//        }
//        if (moduleType == VALUE_ONE) {
//            Heirship.router.navigate('view_heirship_form');
//            heirshipData.title = 'View';
//        } else {
//            heirshipData.show_submit_btn = true;
//        }
        Heirship.router.navigate('view_heirship_form');
        heirshipData.VALUE_ONE = VALUE_ONE;
        heirshipData.VALUE_TWO = VALUE_TWO;
        heirshipData.VALUE_THREE = VALUE_THREE;
        heirshipData.VALUE_FOUR = VALUE_FOUR;
        heirshipData.VALUE_FIVE = VALUE_FIVE;
        heirshipData.VALUE_SIX = VALUE_SIX;
        heirshipData.VALUE_SEVEN = VALUE_SEVEN;
        heirshipData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        heirshipData.HEIRSHIP_CERTIFICATE_DOC_PATH = HEIRSHIP_CERTIFICATE_DOC_PATH;
        heirshipData.declaration_date_text = dateTo_DD_MM_YYYY(heirshipData.declaration_date);
        heirshipData.district_text = talukaArray[heirshipData.district] ? talukaArray[heirshipData.district] : '';

        heirshipData.pre_house_name = heirshipData.pre_house_name ? heirshipData.pre_house_name + ',' : '';
        heirshipData.per_house_name = heirshipData.per_house_name ? heirshipData.per_house_name + ',' : '';

        var district = heirshipData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        heirshipData.village_dmc_ward_text = villageData[heirshipData.village_name] ? villageData[heirshipData.village_name] : '';
        heirshipData.pre_village_text = heirshipData.pre_village ? heirshipData.pre_village : '';
        heirshipData.gender_text = genderArray[heirshipData.gender] ? genderArray[heirshipData.gender] : '';
        heirshipData.death_date_text = heirshipData.death_date != '0000-00-00' ? dateTo_DD_MM_YYYY(heirshipData.death_date) : '';
        heirshipData.occupation_text = applicantOccupationArray[heirshipData.occupation];
        heirshipData.marital_status_text = maritalStatusArray[heirshipData.marital_status] ? maritalStatusArray[heirshipData.marital_status] : '';
        heirshipData.death_marital_status_text = maritalStatusArray[heirshipData.death_marital_status] ? maritalStatusArray[heirshipData.death_marital_status] : '';
        heirshipData.relation_deceased_person_text = relationDeceasedPersonArray[heirshipData.relation_deceased_person] ? relationDeceasedPersonArray[heirshipData.relation_deceased_person] : '';
        heirshipData.relation_with_applicant_text = relationDeceasedPersonArray[heirshipData.relation_with_applicant] ? relationDeceasedPersonArray[heirshipData.relation_with_applicant] : '';
        heirshipData.pre_city_text = heirshipData.pre_city ? heirshipData.pre_city : '';
        heirshipData.per_city_text = heirshipData.per_city ? heirshipData.per_city : '';
        heirshipData.witness1_occupation_text = applicantOccupationArray[heirshipData.witness1_occupation];
        heirshipData.witness2_occupation_text = applicantOccupationArray[heirshipData.witness2_occupation];
        heirshipData.applicant_dob_text = heirshipData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(heirshipData.applicant_dob) : '';
        heirshipData.show_death_certificate_doc = heirshipData.death_certificate_doc != '' ? true : false;
        heirshipData.show_death_aadhar_card_doc = heirshipData.death_aadhar_card_doc != '' ? true : false;
        heirshipData.show_marriage_certificate_doc = heirshipData.marriage_certificate_doc != '' ? true : false;
        heirshipData.show_aadhar_card_doc = heirshipData.aadhar_card_doc != '' ? true : false;
        heirshipData.show_panchayat_certificate_doc = heirshipData.panchayat_certificate_doc != '' ? true : false;
        heirshipData.show_community_certificate_doc = heirshipData.community_certificate_doc != '' ? true : false;
        heirshipData.show_applicant_photo_doc = heirshipData.applicant_photo_doc != '' ? true : false;
        heirshipData.show_witness1_photo_doc = heirshipData.witness1_photo_doc != '' ? true : false;
        heirshipData.show_witness2_photo_doc = heirshipData.witness2_photo_doc != '' ? true : false;
        heirshipData.show_witness1_aadhar_doc = heirshipData.witness1_aadhar_doc != '' ? true : false;
        heirshipData.show_witness2_aadhar_doc = heirshipData.witness2_aadhar_doc != '' ? true : false;
        heirshipData.show_applicant_witness_photo_notary_affidavit_doc = heirshipData.applicant_witness_photo_notary_affidavit_doc != '' ? true : false;
        heirshipData.show_property_documents_doc = heirshipData.property_documents_doc != '' ? true : false;
        heirshipData.show_declaration_btn = moduleType == VALUE_ONE ? true : (heirshipData.declaration == VALUE_ONE ? true : false);
        if (heirshipData.status != VALUE_ZERO && heirshipData.status != VALUE_ONE) {
            heirshipData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(heirshipViewTemplate(heirshipData));

        if (heirshipData.declaration == VALUE_ONE) {
            $('#declaration_for_heirship').click();
        }

        var efmData = JSON.parse(heirshipData.legal_heirs_details);
        var efmCnt = 1;
        $.each(efmData, function (index, efm) {
            var aliveStatus = efm.member_remarks;
            if (aliveStatus != VALUE_TWO) {
                var memAge = efm.member_age;
                var late = '';
            } else {
                var memAge = '-';
                var late = 'Late.';
            }
            var efmRow = '<tr><td class="text-center">' + efmCnt + '</td><td>' + late + '&nbsp;' + efm.member_name + '</td>' +
                    '<td class="text-center">' + memAge + '</td><td class="text-center">' + (relationDeceasedPersonArray[efm.member_relation]) + '</td>' +
                    '<td class="text-center">' + (maritalStatusArray[efm.member_marital_status]) + '</td>' +
                    '<td class="text-center">' + (aliveDeathStatusArray[efm.member_remarks]) + '</td></tr>';
            $('#efm_container_for_icview').append(efmRow);
            efmCnt++;
        });
        var efmDataDec = JSON.parse(heirshipData.legal_heirs_details);
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
                    '<td class="text-center">' + (maritalStatusArray[efm.member_marital_status]) + '</td>' +
                    '<td class="text-center">' + (aliveDeathStatusArray[efm.member_remarks]) + '</td></tr>';
            $('#efm_container_for_icview_declaration').append(efmRowDec);
            var memberName = late + '&nbsp;' + efm.member_name + ',&nbsp;';
            $('#efm_container_for_icview_declaration_name').append(memberName);
            efmDecCnt++;
        });
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_hview').click();
            }, 500);
        }

//        var witnessDecData = JSON.parse(heirshipData.witness_details);
//        var witnessDecCnt = 1;
//        $.each(witnessDecData, function (index, chd) {
//            var witnessDecRow = '<tr><td class="text-center">' + witnessDecCnt + '</td><td>' + chd.name_of_witness + '</td>' +
//                    '<td class="text-center">' + chd.age_of_witness + '</td>' +
//                    '<td>' + chd.address_of_witness + '</td></tr>';
//            $('#witness_container_for_icview_declaration').append(witnessDecRow);
//            witnessDecCnt++;
//        });
//        var witnessData = JSON.parse(heirshipData.witness_details);
//        var witnessCnt = 1;
//        $.each(witnessData, function (index, chd) {
//            var witnessRow = '<tr><td class="text-center">' + witnessCnt + '</td><td>' + chd.name_of_witness + '</td>' +
//                    '<td class="text-center">' + chd.age_of_witness + '</td>' +
//                    '<td>' + chd.address_of_witness + '</td></tr>';
//            $('#witness_container_for_icview').append(witnessRow);
//            witnessCnt++;
//        });

    },
//    viewHeirshipForm: function (heirshipData) {
//        if (!tempIdInSession || tempIdInSession == null) {
//            loginPage();
//            return false;
//        }
//        var that = this;
//        tempMemberCnt = 1;
//        tempFamilyMemberCnt = 1;
//        Heirship.router.navigate('view_heirship_form');
//        heirshipData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
//        heirshipData.VALUE_ONE = VALUE_ONE;
//        heirshipData.VALUE_TWO = VALUE_TWO;
//        heirshipData.VALUE_THREE = VALUE_THREE;
//        heirshipData.VALUE_FOUR = VALUE_FOUR;
//        heirshipData.VALUE_FIVE = VALUE_FIVE;
//        heirshipData.VALUE_SIX = VALUE_SIX;
//        heirshipData.VALUE_SEVEN = VALUE_SEVEN;
//        heirshipData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
//        heirshipData.declaration_date_text = dateTo_DD_MM_YYYY(heirshipData.declaration_date);
//        heirshipData.district_text = talukaArray[heirshipData.district] ? talukaArray[heirshipData.district] : '';
//        $('#heirship_form_and_datatable_container').html(heirshipViewTemplate(heirshipData));
//        $('#view_document_container_for_heirship').html(heirshipViewDocumentTemplate(heirshipData));
//        renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_heirship');
//        var district = heirshipData.district;
//        var villageData = (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : [])));
//        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_heirship');
//        renderOptionsForTwoDimensionalArray(villageData, 'pre_village_for_heirship');
//        renderOptionsForTwoDimensionalArray(villageData, 'per_village_for_heirship');
//        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'applicant_occupation_for_heirship');
//        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'witness1_occupation_for_heirship');
//        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'witness2_occupation_for_heirship');
//        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relation_deceased_person_for_heirship');
//        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'relation_with_applicant_for_heirship');
//        generateBoxes('radio', genderArray, 'gender', 'heirship', heirshipData.gender, false, false);
//        generateBoxes('radio', maritalStatusArray, 'marital_status', 'heirship', heirshipData.marital_status, false, false);
//        showSubContainer('marital_status', 'heirship', '.marital_status_item', VALUE_ONE, 'radio');
//        generateBoxes('radio', maritalStatusArray, 'death_marital_status', 'heirship', heirshipData.death_marital_status, false, false);
//        showSubContainer('marital_status', 'heirship', '.marital_status_item', VALUE_ONE, 'radio');
////        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
////            renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_heirship');
////            $('#district_for_heirship').val(heirshipData.district);
////        }
//
//        $('#district_for_heirship').val(heirshipData.district);
//        $('#applicant_occupation_for_heirship').val(heirshipData.occupation);
//        $('#witness1_occupation_for_heirship').val(heirshipData.witness1_occupation);
//        $('#witness2_occupation_for_heirship').val(heirshipData.witness2_occupation);
//        $('#pre_city_for_heirship').val(heirshipData.pre_city);
//        $('#per_city_for_heirship').val(heirshipData.per_city);
//        $('#village_name_for_heirship').val(heirshipData.village_name);
//        $('#pre_village_for_heirship').val(heirshipData.pre_village);
//        $('#per_village_for_heirship').val(heirshipData.per_village);
//        $('#relation_deceased_person_for_heirship').val(heirshipData.relation_deceased_person);
//        $('#relation_with_applicant_for_heirship').val(heirshipData.relation_with_applicant);
//
//        var cntFm = 1;
//        if (heirshipData.legal_heirs_details != '') {
//            var familyMemberDetails = JSON.parse(heirshipData.legal_heirs_details);
//            $.each(familyMemberDetails, function (key, value) {
//                that.addFamilyMemberInfo(value, true);
//                $('#member_marital_status_for_heirship_' + cntFm).val(value.member_marital_status);
//                $('#member_relation_for_heirship_' + cntFm).val(value.member_relation);
//                $('#member_remarks_for_heirship_' + cntFm).val(value.member_remarks);
//                cntFm++;
//            });
//        }
//        
//        that.viewDocument(heirshipData);
//        $('input[type=radio]').attr('disabled', 'disabled');
//        $('input[type=checkbox]').attr('disabled', 'disabled');
//        $('input[type=text]').attr('disabled', 'disabled');
//        $('.hideView').prop('disabled', true);
//        $('.removeView').hide();
//
//        if (heirshipData.death_date != '0000-00-00') {
//            $('#death_date_for_heirship').val(dateTo_DD_MM_YYYY(heirshipData.death_date));
//        }
//    },
    checkValidationForHeirshipOne: function (heirshipData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!heirshipData.district_for_heirship) {
            return getBasicMessageAndFieldJSONArray('district_for_heirship', selectDistrictValidationMessage);
        }
        if (!heirshipData.village_name_for_heirship) {
            return getBasicMessageAndFieldJSONArray('village_name_for_heirship', selectVillageValidationMessage);
        }
        if (!heirshipData.applicant_name_for_heirship) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_heirship', applicantNameValidationMessage);
        }
        if (!heirshipData.father_name_for_heirship) {
            return getBasicMessageAndFieldJSONArray('father_name_for_heirship', fatherNameValidationMessage);
        }
        if (!heirshipData.pre_house_no_for_heirship) {
            return getBasicMessageAndFieldJSONArray('pre_house_no_for_heirship', houseNoValidationMessage);
        }
        if (!heirshipData.pre_street_for_heirship) {
            return getBasicMessageAndFieldJSONArray('pre_street_for_heirship', streetValidationMessage);
        }
        if (!heirshipData.pre_village_for_heirship) {
            return getBasicMessageAndFieldJSONArray('pre_village_for_heirship', selectVillageValidationMessage);
        }
        if (!heirshipData.pre_city_for_heirship) {
            return getBasicMessageAndFieldJSONArray('pre_city_for_heirship', selectCityValidationMessage);
        }
        if (!heirshipData.pre_pincode_for_heirship) {
            return getBasicMessageAndFieldJSONArray('pre_pincode_for_heirship', pincodeValidationMessage);
        }
        if (!heirshipData.per_house_no_for_heirship) {
            return getBasicMessageAndFieldJSONArray('per_house_no_for_heirship', houseNoValidationMessage);
        }
        if (!heirshipData.per_street_for_heirship) {
            return getBasicMessageAndFieldJSONArray('per_street_for_heirship', streetValidationMessage);
        }
        if (!heirshipData.per_village_for_heirship) {
            return getBasicMessageAndFieldJSONArray('per_village_for_heirship', selectVillageValidationMessage);
        }
        if (!heirshipData.per_city_for_heirship) {
            return getBasicMessageAndFieldJSONArray('per_city_for_heirship', selectCityValidationMessage);
        }
        if (!heirshipData.per_pincode_for_heirship) {
            return getBasicMessageAndFieldJSONArray('per_pincode_for_heirship', pincodeValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(heirshipData.mobile_number_for_heirship);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_heirship', mobileMessage);
        }
        if (!heirshipData.applicant_dob_for_heirship) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_heirship', birthDateValidationMessage);
        }
        if (!heirshipData.applicant_religion_for_heirship) {
            return getBasicMessageAndFieldJSONArray('applicant_religion_for_heirship', religionValidationMessage);
        }
        if (!heirshipData.gender_for_heirship) {
            $('#gender_for_heirship_1').focus();
            return getBasicMessageAndFieldJSONArray('gender_for_heirship', genderValidationMessage);
        }
        if (!heirshipData.applicant_nationality_for_heirship) {
            return getBasicMessageAndFieldJSONArray('applicant_nationality_for_heirship', applicantNationalityValidationMessage);
        }
        if (!heirshipData.marital_status_for_heirship) {
            $('#marital_status_for_heirship_1').focus();
            return getBasicMessageAndFieldJSONArray('marital_status_for_heirship', maritalStatusValidationMessage);
        }
        if (!heirshipData.caste_for_heirship) {
            return getBasicMessageAndFieldJSONArray('caste_for_heirship', casteValidationMessage);
        }
        if (!heirshipData.applicant_occupation_for_heirship) {
            return getBasicMessageAndFieldJSONArray('applicant_occupation_for_heirship', applicantOccupationValidationMessage);
        }
        if (heirshipData.applicant_occupation_for_heirship == VALUE_TWELVE) {
            if (!heirshipData.applicant_occupation_other_for_heirship) {
                return getBasicMessageAndFieldJSONArray('applicant_occupation_other_for_heirship', otherOccupationValidationMessage);
            }
        }
        if (!heirshipData.relation_deceased_person_for_heirship) {
            return getBasicMessageAndFieldJSONArray('relation_deceased_person_for_heirship', relationWithDeceasedPersonValidationMessage);
        }
        if (!heirshipData.death_person_name_for_heirship) {
            return getBasicMessageAndFieldJSONArray('death_person_name_for_heirship', deathPersonNameValidationMessage);
        }
        if (!heirshipData.relation_with_applicant_for_heirship) {
            return getBasicMessageAndFieldJSONArray('relation_with_applicant_for_heirship', relationshipofApplicantValidationMessage);
        }
        if (!heirshipData.death_date_for_heirship) {
            return getBasicMessageAndFieldJSONArray('death_date_for_heirship', dateValidationMessage);
        }
        if (!heirshipData.death_place_for_heirship) {
            return getBasicMessageAndFieldJSONArray('death_place_for_heirship', deathOfPlaceValidationMessage);
        }
        if (!heirshipData.death_marital_status_for_heirship) {
            $('#death_marital_status_for_heirship_1').focus();
            return getBasicMessageAndFieldJSONArray('death_marital_status_for_heirship', maritalStatusValidationMessage);
        }
        if (!heirshipData.witness1_name_for_heirship) {
            return getBasicMessageAndFieldJSONArray('witness1_name_for_heirship', witnessNameValidationMessage);
        }
        if (!heirshipData.witness1_age_for_heirship) {
            return getBasicMessageAndFieldJSONArray('witness1_age_for_heirship', witnessAgeValidationMessage);
        }
        if (heirshipData.witness1_age_for_heirship < VALUE_THIRTYFIVE) {
            return getBasicMessageAndFieldJSONArray('witness1_age_for_heirship', witnessAgeLimitValidationMessage);
        }
        if (!heirshipData.witness1_address_for_heirship) {
            return getBasicMessageAndFieldJSONArray('witness1_address_for_heirship', witnessAddressValidationMessage);
        }
        if (!heirshipData.witness1_occupation_for_heirship) {
            return getBasicMessageAndFieldJSONArray('witness1_occupation_for_heirship', applicantOccupationValidationMessage);
        }
        if (heirshipData.witness1_occupation_for_heirship == VALUE_TWELVE) {
            if (!heirshipData.witness1_occupation_other_for_heirship) {
                $('#' + heirshipData.witness1_occupation_other_for_heirship.field).focus();
                return getBasicMessageAndFieldJSONArray('witness1_occupation_other_for_heirship', otherOccupationValidationMessage);
            }
        }
        if (!heirshipData.witness2_name_for_heirship) {
            return getBasicMessageAndFieldJSONArray('witness2_name_for_heirship', witnessNameValidationMessage);
        }
        if (!heirshipData.witness2_age_for_heirship) {
            return getBasicMessageAndFieldJSONArray('witness2_age_for_heirship', witnessAgeValidationMessage);
        }
        if (heirshipData.witness2_age_for_heirship < VALUE_THIRTYFIVE) {
            return getBasicMessageAndFieldJSONArray('witness2_age_for_heirship', witnessAgeLimitValidationMessage);
        }
        if (!heirshipData.witness2_address_for_heirship) {
            return getBasicMessageAndFieldJSONArray('witness2_address_for_heirship', witnessAddressValidationMessage);
        }
        if (!heirshipData.witness2_occupation_for_heirship) {
            return getBasicMessageAndFieldJSONArray('witness2_occupation_for_heirship', applicantOccupationValidationMessage);
        }
        if (heirshipData.witness2_occupation_for_heirship == VALUE_TWELVE) {
            if (!heirshipData.witness2_occupation_other_for_heirship) {
                return getBasicMessageAndFieldJSONArray('witness2_occupation_other_for_heirship', otherOccupationValidationMessage);
            }
        }

        return '';
    },
    askForSubmitHeirship: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Heirship.listview.submitHeirship(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitHeirship: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var heirshipData = $('#heirship_form').serializeFormJSON();
        var validationDataOne = that.checkValidationForHeirshipOne(heirshipData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('heirship-' + validationDataOne.field, validationDataOne.message);
            return false;
        }

        var fmCnt = 1;
        var icFamilyMemberItem = [];
        var isICFamilyMemberValidation = false;
        $('.heirship_family_member_info').each(function () {
            var cnt1 = $(this).find('.temp_cnt').val();
            var icFamilyMemberInfo = {};
            var familyMemberName = $('#name_of_family_memb_for_heirship_' + cnt1).val();
            if (familyMemberName == '' || familyMemberName == null) {
                $('#name_of_family_memb_for_heirship_' + cnt1).focus();
                validationMessageShow('heirship-name_of_family_memb_for_heirship_' + cnt1, familyMemberNameValidationMessage);
                isICFamilyMemberValidation = true;
                return false;
            }
            icFamilyMemberInfo.member_name = familyMemberName;
            var memberRemarks = $('#member_remarks_for_heirship_' + cnt1).val();
            if (memberRemarks == '' || memberRemarks == null) {
                $('#member_remarks_for_heirship_' + cnt1).focus();
                validationMessageShow('heirship-member_remarks_for_heirship_' + cnt1, oneOptionValidationMessage);
                isICFamilyMemberValidation = true;
                return false;
            }
            icFamilyMemberInfo.member_remarks = memberRemarks;
            if (memberRemarks == VALUE_ONE) {
                var memberAge = $('#age_of_family_memb_for_heirship_' + cnt1).val();
                if (memberAge == '' || memberAge == null) {
                    $('#age_of_family_memb_for_heirship_' + cnt1).focus();
                    validationMessageShow('heirship-age_of_family_memb_for_heirship_' + cnt1, memberAgeValidationMessage);
                    isICFamilyMemberValidation = true;
                    return false;
                }
                icFamilyMemberInfo.member_age = memberAge;
            } else {
                $('#age_of_family_memb_for_heirship_' + cnt1).hide();
            }
            var memberRelation = $('#member_relation_for_heirship_' + cnt1).val();
            if (memberRelation == '' || memberRelation == null) {
                $('#member_relation_for_heirship_' + cnt1).focus();
                validationMessageShow('heirship-member_relation_for_heirship_' + cnt1, memberRelationValidationMessage);
                isICFamilyMemberValidation = true;
                return false;
            }
            icFamilyMemberInfo.member_relation = memberRelation;
            var memberMaritalStatus = $('#member_marital_status_for_heirship_' + cnt1).val();
            if (memberMaritalStatus == '' || memberMaritalStatus == null) {
                $('#member_marital_status_for_heirship_' + cnt1).focus();
                validationMessageShow('heirship-member_marital_status_for_heirship_' + cnt1, maritalStatusValidationMessage);
                isICFamilyMemberValidation = true;
                return false;
            }
            icFamilyMemberInfo.member_marital_status = memberMaritalStatus;
            icFamilyMemberItem.push(icFamilyMemberInfo);
            fmCnt++;
        });
        if (isICFamilyMemberValidation) {
            return false;
        }
        if (fmCnt == VALUE_ONE) {
            showError(oneLegalHeirsValidationMessage);
            return false;
        }

        heirshipData.module_type = moduleType;
        heirshipData.family_member_info = icFamilyMemberItem;

        var btnObj = $('#submit_btn_for_heirship');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'heirship/submit_heirship',
            data: $.extend({}, heirshipData, getTokenData()),
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
                validationMessageShow('heirship', textStatus.statusText);
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
                    validationMessageShow('heirship', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Heirship.listview.loadHeirshipData();
                showSuccess(parseData.message);
            }
        });
    },
    addFamilyMemberInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt = tempFamilyMemberCnt;
        $('#family_member_info_container_for_heirship').append(heirshipFamilyMemberInfoTemplate(templateData));
        renderOptionsForTwoDimensionalArray(maritalStatusArray, 'member_marital_status_for_heirship_' + tempFamilyMemberCnt);
        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'member_relation_for_heirship_' + tempFamilyMemberCnt);
        renderOptionsForTwoDimensionalArray(aliveDeathStatusArray, 'member_remarks_for_heirship_' + tempFamilyMemberCnt);
        allowOnlyIntegerValue('age_of_family_memb_for_heirship_' + tempFamilyMemberCnt);
        tempFamilyMemberCnt++;
        generateSelect2();
        resetCounter('display-cnt');
    },
    removeFamilyMemberInfo: function (perCnt) {
        $('#heirship_family_member_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    askForApproveApplication: function (heirshipId) {
        if (!heirshipId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + heirshipId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'heirship/get_heirship_data_by_heirship_id',
            type: 'post',
            data: $.extend({}, {'heirship_id': heirshipId}, getTokenData()),
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
                var heirshipData = parseData.heirship_data;
                showPopup();
//                var pre_village_text = (heirshipData.district == VALUE_ONE ? damanVillagesArray : (heirshipData.district == VALUE_TWO ? diuVillagesArray : (heirshipData.district == VALUE_THREE ? dnhVillagesArray : [])));
                heirshipData.pre_village_text = heirshipData.pre_village ? heirshipData.pre_village : '';
                heirshipData.pre_city_text = heirshipData.pre_city ? heirshipData.pre_city : '';
                heirshipData.relation_deceased_person_text = relationDeceasedPersonArray[heirshipData.relation_deceased_person] ? relationDeceasedPersonArray[heirshipData.relation_deceased_person] : '';
                heirshipData.relation_with_applicant_text = relationDeceasedPersonArray[heirshipData.relation_with_applicant] ? relationDeceasedPersonArray[heirshipData.relation_with_applicant] : '';
                heirshipData.death_date_text = dateTo_DD_MM_YYYY(heirshipData.death_date) ? dateTo_DD_MM_YYYY(heirshipData.death_date) : '';
                $('.swal2-popup').css('width', '40em');
                var icData = that.getBasicConfigurationForMovement(heirshipData);
                $('#popup_container').html(heirshipApproveTemplate(icData));

                var efmDataDec = JSON.parse(heirshipData.legal_heirs_details);
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
                            '<td class="text-center">' + (maritalStatusArray[efm.member_marital_status]) + '</td>' +
                            '<td class="text-center">' + (aliveDeathStatusArray[efm.member_remarks]) + '</td></tr>';
                    $('#efm_container_for_icupdate').append(efmRowDec);
                    efmDecCnt++;
                });
                datePicker();
            }
        });
    },
    getBasicConfigurationForMovement: function (heirshipData) {
        var that = this;
        if (heirshipData.talathi_to_aci != VALUE_ZERO) {
            heirshipData.show_talathi_updated_basic_details = true;
        }
        if (heirshipData.aci_rec == VALUE_ONE || heirshipData.aci_rec == VALUE_TWO) {
            heirshipData.show_aci_updated_basic_details = true;
            heirshipData.aci_rec_text = recArray[heirshipData.aci_rec] ? recArray[heirshipData.aci_rec] : '';
            if (heirshipData.aci_rec == VALUE_ONE) {
                heirshipData.act_to_mamlatdar_ldc_datetime_text = heirshipData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.aci_to_ldc_datetime) : '';
                heirshipData.act_to_mamlatdar_ldc_name_text = heirshipData.ldc_name;
            }
            if (heirshipData.aci_rec == VALUE_TWO) {
                heirshipData.act_to_mamlatdar_ldc_datetime_text = heirshipData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.aci_to_mamlatdar_datetime) : '';
                heirshipData.act_to_mamlatdar_ldc_name_text = heirshipData.mamlatdar_name;
            }
        }
        if (heirshipData.ldc_to_mamlatdar != VALUE_ZERO && heirshipData.aci_rec == VALUE_ONE) {
            heirshipData.show_ldc_updated_basic_details = true;
            heirshipData.ldc_commu_address = that.ldcCommuAddress(heirshipData);
            heirshipData.ldc_to_mamlatdar_datetime_text = heirshipData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.ldc_to_mamlatdar_datetime) : '';
        }
        if (heirshipData.to_type_reverify != VALUE_ZERO) {
            heirshipData.show_mam_reverify_updated_basic_details = true;
            heirshipData.mam_reverification = heirshipData.to_type_reverify == VALUE_ONE ? heirshipData.talathi_name : heirshipData.aci_name;
        }
        if (heirshipData.talathi_to_type_reverify != VALUE_ZERO) {
            heirshipData.talathi_reverification = heirshipData.talathi_to_type_reverify == VALUE_ONE ? heirshipData.aci_name : heirshipData.mamlatdar_name;
            heirshipData.show_talathi_reverify_updated_basic_details = true;
        }
        if (heirshipData.aci_rec_reverify == VALUE_ONE || heirshipData.aci_rec_reverify == VALUE_TWO) {
            heirshipData.show_aci_reverify_updated_basic_details = true;
            heirshipData.aci_rec_reverify_text = recArray[heirshipData.aci_rec_reverify] ? recArray[heirshipData.aci_rec_reverify] : '';
            if (heirshipData.aci_rec_reverify == VALUE_ONE) {
                heirshipData.act_to_mamlatdar_ldc_reverify_datetime_text = heirshipData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.aci_to_ldc_datetime) : '';
                heirshipData.act_to_mamlatdar_ldc_reverify_name_text = heirshipData.ldc_name;
            }
            if (heirshipData.aci_rec_reverify == VALUE_TWO) {
                heirshipData.act_to_mamlatdar_ldc_reverify_datetime_text = heirshipData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.aci_to_reverify_datetime) : '';
                heirshipData.act_to_mamlatdar_ldc_reverify_name_text = heirshipData.mamlatdar_name;
            }
        }
        if (heirshipData.ldc_to_mamlatdar != VALUE_ZERO && heirshipData.aci_rec_reverify == VALUE_ONE) {
            heirshipData.show_ldc_reverify_updated_basic_details = true;
            heirshipData.ldc_commu_address = that.ldcCommuAddress(heirshipData);
            heirshipData.ldc_to_mamlatdar_datetime_text = heirshipData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.ldc_to_mamlatdar_datetime) : '';
        }
        heirshipData.talathi_to_aci_datetime_text = heirshipData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.talathi_to_aci_datetime) : '';
        heirshipData.aci_to_mamlatdar_datetime_text = heirshipData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.aci_to_mamlatdar_datetime) : '';
        heirshipData.mam_to_reverify_datetime_text = heirshipData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.mam_to_reverify_datetime) : '';
        heirshipData.talathi_to_reverify_datetime_text = heirshipData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.talathi_to_reverify_datetime) : '';
        heirshipData.aci_to_reverify_datetime_text = heirshipData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(heirshipData.aci_to_reverify_datetime) : '';
        return heirshipData;
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_heirship_form').serializeFormJSON();
        if (!formData.heirship_id_for_heirship_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_heirship_approve) {
            $('#remarks_for_heirship_approve').focus();
            validationMessageShow('heirship-approve-remarks_for_heirship_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_heirship_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'heirship/approve_application',
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
                validationMessageShow('heirship-apptove', textStatus.statusText);
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
                    validationMessageShow('heirship-apptove', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Heirship.listview.loadHeirshipData();
//                $('#status_' + formData.heirship_id_for_heirship_approve).html(appStatusArray[VALUE_FIVE]);
//                $('#edit_btn_for_app_' + formData.heirship_id_for_heirship_approve).remove();
//                $('#reject_btn_for_app_' + formData.heirship_id_for_heirship_approve).remove();
//                $('#approve_btn_for_app_' + formData.heirship_id_for_heirship_approve).remove();
//                $('#download_certificate_btn_for_app_' + formData.heirship_id_for_heirship_approve).show();
            }
        });
    },
    askForRejectApplication: function (heirshipId) {
        if (!heirshipId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + heirshipId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'heirship/get_heirship_data_by_heirship_id',
            type: 'post',
            data: $.extend({}, {'heirship_id': heirshipId}, getTokenData()),
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
                var heirshipData = parseData.heirship_data;
                showPopup();
                // var pre_village_text = (heirshipData.district == VALUE_ONE ? damanVillagesArray : (heirshipData.district == VALUE_TWO ? diuVillagesArray : (heirshipData.district == VALUE_THREE ? dnhVillagesArray : [])));
                heirshipData.pre_village_text = heirshipData.pre_village ? heirshipData.pre_village : '';
                heirshipData.pre_city_text = heirshipData.pre_city ? heirshipData.pre_city : '';
                heirshipData.relation_deceased_person_text = relationDeceasedPersonArray[heirshipData.relation_deceased_person] ? relationDeceasedPersonArray[heirshipData.relation_deceased_person] : '';
                heirshipData.relation_with_applicant_text = relationDeceasedPersonArray[heirshipData.relation_with_applicant] ? relationDeceasedPersonArray[heirshipData.relation_with_applicant] : '';
                heirshipData.death_date_text = dateTo_DD_MM_YYYY(heirshipData.death_date) ? dateTo_DD_MM_YYYY(heirshipData.death_date) : '';
                $('.swal2-popup').css('width', '40em');
                var hcData = that.getBasicConfigurationForMovement(heirshipData);
                $('#popup_container').html(heirshipRejectTemplate(hcData));

                var efmDataDec = JSON.parse(heirshipData.legal_heirs_details);
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
                            '<td class="text-center">' + (maritalStatusArray[efm.member_marital_status]) + '</td>' +
                            '<td class="text-center">' + (aliveDeathStatusArray[efm.member_remarks]) + '</td></tr>';
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
        var formData = $('#reject_heirship_form').serializeFormJSON();
        if (!formData.heirship_id_for_heirship_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_heirship_reject) {
            $('#remarks_for_heirship_reject').focus();
            validationMessageShow('heirship-reject-remarks_for_heirship_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_heirship_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'heirship/reject_application',
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
                validationMessageShow('heirship-reject', textStatus.statusText);
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
                    validationMessageShow('heirship-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Heirship.listview.loadHeirshipData();
            }
        });
    },
    downloadCertificate: function (heirshipId, moduleType) {
        if (!heirshipId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#heirship_id_for_certificate').val(heirshipId);
        $('#mtype_for_certificate').val(moduleType);
        $('#heirship_pdf_form').submit();
        $('#heirship_id_for_certificate').val('');
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
    getQueryData: function (heirshipId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!heirshipId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_THREE;
        templateData.module_id = heirshipId;
        var btnObj = $('#query_btn_for_app_' + heirshipId);
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
                tmpData.module_type = VALUE_THREE;
                tmpData.module_id = heirshipId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    setAppointment: function (heirshipId) {
        if (!heirshipId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + heirshipId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'heirship/get_appointment_data_by_heirship_id',
            type: 'post',
            data: $.extend({}, {'heirship_id': heirshipId}, getTokenData()),
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
                $('#popup_container').html(heirshipSetAppointmentTemplate(appointmentData));
                if (appointmentData.online_statement == VALUE_ONE) {
                    $('#online_statement_for_heirship').attr('checked', 'checked');
                }
                if (appointmentData.visit_office == VALUE_ONE) {
                    $('#visit_office_for_heirship').attr('checked', 'checked');
                }
                loadAppointmentHistory('heirship', appointmentData);
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
        var formData = $('#set_appointment_heirship_form').serializeFormJSON();
        if (!formData.heirship_id_for_heirship_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_heirship) {
            $('#appointment_date_for_heirship').focus();
            validationMessageShow('heirship-appointment_date_for_heirship', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_heirship) {
            $('#appointment_time_for_heirship').focus();
            validationMessageShow('heirship-appointment_time_for_heirship', timeValidationMessage);
            return false;
        }
        if (formData.online_statement_for_heirship == undefined && formData.visit_office_for_heirship == undefined) {
            $('#visit_office_for_heirship').focus();
            validationMessageShow('heirship-visit_office_for_heirship', appointmentTypeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_heirship_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'heirship/submit_set_appointment',
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
                validationMessageShow('heirship-set-appointment', textStatus.statusText);
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
                    validationMessageShow('heirship-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var heirshipData = parseData.heirship_data;

                if (heirshipData.appointment_date != '0000-00-00') {
                    var d1 = (dateTo_DD_MM_YYYY(heirshipData.appointment_date)).split("-");
                    var d2 = (dateTo_DD_MM_YYYY()).split("-");
                    d1 = d1[2].concat(d1[1], d1[0]);
                    d2 = d2[2].concat(d2[1], d2[0]);
                    if (parseInt(d2) >= parseInt(d1)) {
                        //heirshipCertificateData.show_forward_btn = true;
                        $('#update_basic_detail_btn_for_app_' + heirshipData.heirship_certificate_id).show();
                    } else {
                        $('#update_basic_detail_btn_for_app_' + heirshipData.heirship_certificate_id).hide();
                    }
                }

                $('#appointment_container_' + heirshipData.heirship_id).html(that.getAppointmentData(heirshipData));
                $('#movement_for_ic_list_' + heirshipData.heirship_id).html(movementString(heirshipData));
            }
        });
    },
    reverifyApplication: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_heirship_form').serializeFormJSON();
        if (!formData.heirship_id_for_heirship_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if (!formData.to_type_reverify_for_heirship) {
                $('#to_type_reverify_for_heirship_1').focus();
                validationMessageShow('heirship-update-basic-detail-to_type_reverify_for_heirship', oneOptionValidationMessage);
                return false;
            }
            if (!formData.mam_reverify_remarks_for_heirship) {
                $('#mam_reverify_remarks_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-mam_reverify_remarks_for_heirship', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {

            if (!formData.talathi_to_type_reverify_for_heirship) {
                $('#talathi_to_type_reverify_for_heirship_1').focus();
                validationMessageShow('heirship-update-basic-detail-talathi_to_type_reverify_for_heirship', oneOptionValidationMessage);
                return false;
            }

            if (!formData.upload_reverification_document_for_heirship) {
                $('#upload_reverification_document_for_heirship_1').focus();
                validationMessageShow('heirship-update-basic-detail-upload_reverification_document_for_heirship', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_reverification_document_for_heirship == VALUE_ONE) {
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

            if (!formData.talathi_reverify_remarks_for_heirship) {
                $('#talathi_reverify_remarks_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-talathi_reverify_remarks_for_heirship', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_reverify_for_heirship) {
                $('#aci_rec_reverify_for_heirship_1').focus();
                validationMessageShow('heirship-update-basic-detail-aci_rec_reverify_for_heirship', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_reverify_remarks_for_heirship) {
                $('#aci_reverify_remarks_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-aci_reverify_remarks_for_heirship', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_heirship == VALUE_ONE && !formData.aci_to_ldc_reverify_for_heirship) {
                $('#aci_to_ldc_reverify_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-aci_to_ldc_reverify_for_heirship', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_heirship == VALUE_ONE && !formData.aci_to_type_reverify_for_heirship) {
                $('#aci_to_type_reverify_for_heirship_1').focus();
                validationMessageShow('heirship-update-basic-detail-aci_to_type_reverify_for_heirship', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            if (!formData.ldc_applicant_name_for_heirship) {
                $('#ldc_applicant_name_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-ldc_applicant_name_for_heirship', applicantNameValidationMessage);
                return false;
            }
            if (!formData.pre_house_no) {
                $('#pre_house_no_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-pre_house_no_for_heirship', houseNoValidationMessage);
                return false;
            }
            if (!formData.pre_house_name) {
                $('#pre_house_name_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-pre_house_name_for_heirship', houseNameValidationMessage);
                return false;
            }
            if (!formData.pre_street) {
                $('#pre_street_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-pre_street_for_heirship', streetValidationMessage);
                return false;
            }
            if (!formData.pre_village) {
                $('#pre_village_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-pre_village_for_heirship', villagewardValidationMessage);
                return false;
            }
            if (!formData.pre_city) {
                $('#pre_city_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-pre_city_for_heirship', selectCityValidationMessage);
                return false;
            }
            if (!formData.pre_pincode) {
                $('#pre_pincode_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-pre_pincode_for_heirship', pincodeValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_heirship) {
                $('#ldc_to_mamlatdar_remarks_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-ldc_to_mamlatdar_remarks_for_heirship', remarksValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_for_heirship) {
                $('#ldc_to_mamlatdar_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-ldc_to_mamlatdar_for_heirship', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'heirship/reverify_application',
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
                validationMessageShow('heirship-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('heirship-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var icData = parseData.heirship_data;
                if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
                    $('#status_' + formData.heirship_id_for_heirship_update_basic_detail).html(appStatusArray[VALUE_THREE]);
                    var reverificationName = formData.to_type_reverify_for_heirship == VALUE_ONE ? formData.talathi_name_for_heirship_update_basic_detail : formData.aci_name_for_heirship_update_basic_detail;
                    $('#reverification_status_' + formData.heirship_id_for_heirship_update_basic_detail).html('<hr>' + reverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    var talathiReverificationName = formData.talathi_to_type_reverify_for_heirship == VALUE_ONE ? formData.aci_name_for_heirship_update_basic_detail : formData.mamlatdar_name_for_heirship_update_basic_detail;
                    $('#reverification_status_' + formData.heirship_id_for_heirship_update_basic_detail).html('<hr>' + talathiReverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    if (icData.aci_rec_reverify == VALUE_ONE) {
                        $('#reverification_status_' + formData.heirship_id_for_heirship_update_basic_detail).html('<hr>' + icData.ldc_name);
                    } else {
                        $('#reverification_status_' + formData.heirship_id_for_heirship_update_basic_detail).html('<hr>' + formData.mamlatdar_name_for_heirship_update_basic_detail);
                    }
                }
                $('#movement_for_ic_list_' + formData.heirship_id_for_heirship_update_basic_detail).html(movementString(parseData.heirship_data));
                resetModelMD();
            }
        });
    },
    ldcCommuAddress: function (basicDetailData) {
        return basicDetailData.ldc_commu_address != '' ? basicDetailData.ldc_commu_address : (basicDetailData.pre_house_no != '' ? (basicDetailData.pre_house_no + ', ') : '')
                + (basicDetailData.pre_house_name != '' ? (basicDetailData.pre_house_name + ', ') : '')
                + (basicDetailData.pre_street != '' ? (basicDetailData.pre_street + ', ') : '')
                + (basicDetailData.pre_village != '' ? (basicDetailData.pre_village + ', ') : '')
                + basicDetailData.pre_city;
    },
    updateBasicDetails: function (btnObj, heirshipId) {
        if (!heirshipId) {
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
            url: 'heirship/get_update_basic_detail_data_by_heirship_id',
            type: 'post',
            data: $.extend({}, {'heirship_id': heirshipId}, getTokenData()),
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
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    basicDetailData.ldc_death_person_address = basicDetailData.ldc_death_person_address != '' ? basicDetailData.ldc_death_person_address : basicDetailData.ldc_commu_address;
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'death_person_name', 'ldc_death_person_name', 'ldc_dp_name');
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && basicDetailData.aci_rec == VALUE_ONE) {
                    basicDetailData.show_ldc_updated_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    basicDetailData.ldc_death_person_address = basicDetailData.ldc_death_person_address != '' ? basicDetailData.ldc_death_person_address : basicDetailData.ldc_commu_address;
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
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    basicDetailData.ldc_death_person_address = basicDetailData.ldc_death_person_address != '' ? basicDetailData.ldc_death_person_address : basicDetailData.ldc_commu_address;
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData = ldcAppDetails(basicDetailData, 'applicant_name', 'ldc_applicant_name', 'ldc_app_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'death_person_name', 'ldc_death_person_name', 'ldc_dp_name');
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && basicDetailData.aci_rec_reverify == VALUE_ONE) {
                    basicDetailData.show_ldc_reverify_updated_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    basicDetailData.ldc_death_person_address = basicDetailData.ldc_death_person_address != '' ? basicDetailData.ldc_death_person_address : basicDetailData.ldc_commu_address;
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                }
                basicDetailData.title = basicDetailData.to_type_reverify == VALUE_ZERO ? (tempTypeInSession == TEMP_TYPE_TALATHI_USER ? 'Forward for Verification' : (tempTypeInSession == TEMP_TYPE_ACI_USER ? 'Forward for Approval' : 'Update Basic Details')) : 'Reverification Heirship Certificate Form';
                basicDetailData.talathi_to_aci_datetime_text = basicDetailData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_aci_datetime) : '';
                basicDetailData.mam_to_reverify_datetime_text = basicDetailData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.mam_to_reverify_datetime) : '';
                basicDetailData.talathi_to_reverify_datetime_text = basicDetailData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_reverify_datetime) : '';
                basicDetailData.aci_to_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';

                if (basicDetailData.status == VALUE_FIVE || basicDetailData.status == VALUE_SIX) {
                    basicDetailData.show_approve_reject_details = true;
                    basicDetailData.status_text = returnAppStatus(basicDetailData.status);
                    basicDetailData.status_datetime_text = basicDetailData.status_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.status_datetime) : '';
                    basicDetailData.title = 'Movement Details of Heirship Certificate Form';
                }
                basicDetailData.status = queryStatus(basicDetailData.query_status);
                //$('.swal2-popup').css('width', '50em');

                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    $('#model_md_title').html(basicDetailData.title);
                    $('#model_md_body').html(heirshipUpdateBasicDetailTemplate(basicDetailData));
                } else {
                    basicDetailData.show_card = true;
                    $('#popup_container').html(heirshipUpdateBasicDetailTemplate(basicDetailData));
                }

                var efmDataDec = basicDetailData.legal_heirs_details != '' ? JSON.parse(basicDetailData.legal_heirs_details) : [];
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
                            '<td class="text-center">' + (maritalStatusArray[efm.member_marital_status]) + '</td>' +
                            '<td class="text-center">' + (aliveDeathStatusArray[efm.member_remarks]) + '</td></tr>';
                    $('#efm_container_for_icupdate').append(efmRowDec);

                    if (basicDetailData.show_ldc_enter_basic_details || basicDetailData.show_ldc_reverify_enter_basic_details) {
                        efm.temp_cnt = efmDecCnt;
                        $('#update_fmi_container_for_ubd').append(heirshipUdbFdItemTemplate(efm));
                        renderOptionsForTwoDimensionalArray(relationDeceasedPersonArray, 'member_relation_for_ubd_' + efmDecCnt, false);
                        renderOptionsForTwoDimensionalArray(aliveDeathStatusArray, 'member_remarks_for_ubd_' + efmDecCnt, false);
                        allowOnlyIntegerValue('age_of_family_memb_for_heirship_' + efmDecCnt);
                        if (efm.member_remarks == VALUE_TWO) {
                            $('#age_of_family_memb_for_ubd_' + efmDecCnt).hide();
                        }
                        $('#member_relation_for_ubd_' + efmDecCnt).val(efm.member_relation);
                        $('#member_remarks_for_ubd_' + efmDecCnt).val(efm.member_remarks);
                    }
                    efmDecCnt++;
                });

                if (basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) {
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                        generateBoxes('radio', yesNoArray, 'upload_verification_document', 'heirship', basicDetailData.is_upload_verification_document, false, false);
                        showSubContainer('upload_verification_document', 'heirship', '#field_verification_document_uploads', VALUE_ONE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.aci_data, 'talathi_to_aci_for_heirship', 'sa_user_id', 'name', '', false);

                        if (basicDetailData.field_documents != '') {
                            $.each(basicDetailData.field_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_ONE);
                                $('#upload_verification_document_for_heirship_1').attr('checked', 'checked');
                                $('#field_verification_document_uploads_container_for_heirship').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_ONE);
                            $('#upload_verification_document_for_heirship_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                        basicDetailData.aci_rec = (basicDetailData.aci_rec == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec);
                        generateBoxes('radio', recArray, 'aci_rec', 'heirship', basicDetailData.aci_rec, false, false);
                        showSubContainer('aci_rec', 'heirship', '#aci_to_ldc', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec', 'heirship', '#aci_to_mamlatdar', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'aci_to_mamlatdar_for_heirship', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_for_heirship', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'ldc_to_mamlatdar_for_heirship', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.to_type_reverify == VALUE_ZERO) {
                        generateBoxes('radio', reverifyTypeArray, 'to_type_reverify', 'heirship', basicDetailData.to_type_reverify, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.to_type_reverify == VALUE_ONE) {
                        generateBoxes('radio', yesNoArray, 'upload_reverification_document', 'heirship', basicDetailData.is_upload_reverification_document, false, false);
                        showSubContainer('upload_reverification_document', 'heirship', '#field_reverification_document_uploads', VALUE_ONE, 'radio');
                        generateBoxes('radio', talathiReverifyTypeArray, 'talathi_to_type_reverify', 'heirship', basicDetailData.talathi_to_type_reverify, false);

                        if (basicDetailData.field_reverify_documents != '') {
                            $.each(basicDetailData.field_reverify_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_TWO);
                                $('#upload_reverification_document_for_heirship_1').attr('checked', 'checked');
                                $('#field_reverification_document_uploads_container_for_heirship').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_TWO);
                            $('#upload_reverification_document_for_heirship_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                            (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                        var tempArray = [];
                        tempArray[VALUE_ZERO] = basicDetailData.mamlatdar_name;
                        generateBoxes('radio', tempArray, 'aci_to_type_reverify', 'heirship', VALUE_ZERO, false);

                        basicDetailData.aci_rec_reverify = (basicDetailData.aci_rec_reverify == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec_reverify);
                        generateBoxes('radio', recArray, 'aci_rec_reverify', 'heirship', basicDetailData.aci_rec_reverify, false, false);
                        showSubContainer('aci_rec_reverify', 'heirship', '#aci_to_ldc_reverify', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec_reverify', 'heirship', '#aci_to_mamlatdar_reverify', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_reverify_for_heirship', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec_reverify == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        var tempArray = [];
                        var tArray = {};
                        tArray['name'] = basicDetailData.mamlatdar_name;
                        tArray['sa_user_id'] = basicDetailData.aci_to_mamlatdar;
                        tempArray.push(tArray);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempArray, 'ldc_to_mamlatdar_for_heirship', 'sa_user_id', 'name', '', false);
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
        var formData = $('#update_basic_detail_heirship_form').serializeFormJSON();
        if (!formData.heirship_id_for_heirship_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {

            if (!formData.upload_verification_document_for_heirship) {
                $('#upload_verification_document_for_heirship_1').focus();
                validationMessageShow('heirship-update-basic-detail-upload_verification_document_for_heirship', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_verification_document_for_heirship == VALUE_ONE) {
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

            if (!formData.talathi_remarks_for_heirship) {
                $('#talathi_remarks_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-talathi_remarks_for_heirship', remarksValidationMessage);
                return false;
            }
            if (!formData.talathi_to_aci_for_heirship) {
                $('#talathi_to_aci_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-talathi_to_aci_for_heirship', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_for_heirship) {
                $('#aci_rec_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-aci_rec_for_heirship', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_remarks_for_heirship) {
                $('#aci_remarks_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-aci_remarks_for_heirship', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_heirship == VALUE_ONE && !formData.aci_to_ldc_for_heirship) {
                $('#aci_to_ldc_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-aci_to_ldc_for_heirship', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_heirship == VALUE_TWO && !formData.aci_to_mamlatdar_for_heirship) {
                $('#aci_to_mamlatdar_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-aci_to_mamlatdar_for_heirship', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            if (!formData.ldc_applicant_name_for_heirship) {
                $('#ldc_applicant_name_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-ldc_applicant_name_for_heirship', applicantNameValidationMessage);
                return false;
            }
            if (!formData.ldc_death_person_name_for_heirship) {
                $('#ldc_death_person_name_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-ldc_death_person_name_for_heirship', deathPersonNameValidationMessage);
                return false;
            }
            if (!formData.ldc_commu_address_for_heirship) {
                $('#ldc_commu_address_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-ldc_commu_address_for_heirship', communicationAddressValidationMessage);
                return false;
            }
            if (!formData.ldc_death_person_address_for_heirship) {
                $('#ldc_death_person_address_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-ldc_death_person_address_for_heirship', deathPersonAddressValidationMessage);
                return false;
            }

            var tfmCnt = 1;
            var fmItems = [];
            var isFMIValidation = false;
            $('.fd_for_ubd').each(function () {
                var tCnt = $(this).find('.temp_cnt').val();
                if (!tCnt) {
                    validationMessageShow('ubd', invalidAccessValidationMessage);
                    isFMIValidation = true;
                    return false;
                }
                var fmInfo = {};
                var fmName = $('#name_of_family_memb_for_ubd_' + tCnt).val();
                if (fmName == '' || fmName == null) {
                    $('#name_of_family_memb_for_ubd_' + tCnt).focus();
                    validationMessageShow('ubd-name_of_family_memb_for_ubd_' + tCnt, familyMemberNameValidationMessage);
                    isFMIValidation = true;
                    return false;
                }
                fmInfo.member_name = fmName;
                var memberRemarks = $('#member_remarks_for_ubd_' + tCnt).val();
                if (memberRemarks == '' || memberRemarks == null) {
                    $('#member_remarks_for_ubd_' + tCnt).focus();
                    validationMessageShow('ubd-member_remarks_for_ubd_' + tCnt, oneOptionValidationMessage);
                    isFMIValidation = true;
                    return false;
                }
                fmInfo.member_remarks = memberRemarks;
                if (memberRemarks == VALUE_ONE) {
                    var memberAge = $('#age_of_family_memb_for_ubd_' + tCnt).val();
                    if (memberAge == '' || memberAge == null) {
                        $('#age_of_family_memb_for_ubd_' + tCnt).focus();
                        validationMessageShow('ubd-age_of_family_memb_for_ubd_' + tCnt, memberAgeValidationMessage);
                        isFMIValidation = true;
                        return false;
                    }
                    fmInfo.member_age = memberAge;
                }
                var memberRelation = $('#member_relation_for_ubd_' + tCnt).val();
                if (memberRelation == '' || memberRelation == null) {
                    $('#member_relation_for_ubd_' + tCnt).focus();
                    validationMessageShow('ubd-member_relation_for_ubd_' + tCnt, memberRelationValidationMessage);
                    isFMIValidation = true;
                    return false;
                }
                fmInfo.member_relation = memberRelation;
                fmInfo.member_marital_status = $('#member_marital_status_for_udb_' + tCnt).val();
                fmItems.push(fmInfo);
                tfmCnt++;
            });
            if (isFMIValidation) {
                return false;
            }
            if (tfmCnt == VALUE_ONE) {
                validationMessageShow('ubd', oneLegalHeirsValidationMessage);
                return false;
            }
            formData.family_member_info_for_heirship = fmItems;
            if (!formData.ldc_to_mamlatdar_remarks_for_heirship) {
                $('#ldc_to_mamlatdar_remarks_for_heirship').focus();
                validationMessageShow('heirship-update-basic-detail-ldc_to_mamlatdar_remarks_for_heirship', remarksValidationMessage);
                return false;
            }
            if (!showLDCDraftBtn) {
                formData.update_ldc_mam_details = VALUE_ONE;
                if (!formData.ldc_to_mamlatdar_for_heirship) {
                    $('#ldc_to_mamlatdar_for_heirship').focus();
                    validationMessageShow('heirship-update-basic-detail-ldc_to_mamlatdar_for_heirship', oneOptionValidationMessage);
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
            url: 'heirship/forward_to',
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
                validationMessageShow('heirship-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('heirship-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#movement_for_ic_list_' + parseData.heirship_id).html(movementString(parseData.heirship_data));
                resetModelMD();
            }
        });
    },
    getYearlyIncomeTotal: function () {
        var totalIncome = 0;
        $('.heirship_family_member_info').each(function () {
            var cnt1 = $(this).find('.temp_cnt').val();

            var yearlyIncome = $('#yearly_income_for_heirship_' + cnt1).val();
            currentRow = parseFloat(yearlyIncome);
            totalIncome += currentRow;
        });
        $('#total_income_for_heirship').val(totalIncome);
    },
    getDocumentData: function (heirshipId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!heirshipId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#heirship_id_for_scrutiny').val(heirshipId);
        $('#heirship_document_for_scrutiny').submit();
        $('#heirship_id_for_scrutiny').val('');
    },
    districtChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'village_name_for_heirship');
        renderOptionsForTwoDimensionalArray([], 'pre_village_for_heirship');
        renderOptionsForTwoDimensionalArray([], 'per_village_for_heirship');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_heirship');
        renderOptionsForTwoDimensionalArray(villageData, 'pre_village_for_heirship');
        renderOptionsForTwoDimensionalArray(villageData, 'per_village_for_heirship');
    },
//    districtChangeEvent: function (obj) {
//        if (!tempIdInSession || tempIdInSession == null) {
//            loginPage();
//            return false;
//        }
//        renderOptionsForTwoDimensionalArray([], 'village_dmc_ward_for_heirship');
//        var district = obj.val();
//        if (!district) {
//            return false;
//        }
//        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
//            return false;
//        }
//        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
//        renderOptionsForTwoDimensionalArray(villageData, 'village_dmc_ward_for_heirship');
//    },
    getPresentAddress: function (value) {
        if ($("#same_as_present").is(':checked')) {
            $('#per_house_no_for_heirship').val($('#pre_house_no_for_heirship').val());
            $('#per_house_name_for_heirship').val($('#pre_house_name_for_heirship').val());
            $('#per_street_for_heirship').val($('#pre_street_for_heirship').val());
            $('#per_village_for_heirship').val($('#pre_village_for_heirship').val());
            $('#per_city_for_heirship').val($('#pre_city_for_heirship').val());
            $('#per_pincode_for_heirship').val($('#pre_pincode_for_heirship').val());
        } else {
            $('#per_house_no_for_heirship').val('');
            $('#per_house_name_for_heirship').val('');
            $('#per_street_for_heirship').val('');
            $('#per_village_for_heirship').val('');
            $('#per_city_for_heirship').val('');
            $('#per_pincode_for_heirship').val('');
        }
        generateSelect2();
    },
    villageDMCChangeEvent: function () {
        var district = $('#district_for_heirship').val();
        var villageCode = $('#village_name_for_heirship').val();
        var villageData = (district == VALUE_ONE ? damanVillagesArray[villageCode] : (district == VALUE_TWO ? diuVillagesArray[villageCode] : (district == VALUE_THREE ? dnhVillagesArray[villageCode] : [])));
        $('#pre_village_for_heirship').val(villageData);

        // $("#billingtoo_for_heirship").prop('checked',false);
        $('#per_village_for_heirship').val('');
        $('#per_city_for_heirship').val('');
        $('#per_pincode_for_heirship').val('');

        if (district == VALUE_ONE) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'pre_city_for_heirship');
            renderOptionsForTwoDimensionalArray(damanCityArray, 'per_city_for_heirship');
            if (jQuery.inArray(villageCode, naniDamanVillageArray) != '-1') {
                $('#pre_city_for_heirship').val(damanCityArray[VALUE_ONE]);
                var city_code = VALUE_ONE;
            } else if (jQuery.inArray(villageCode, motiDamanVillageArray) != '-1') {
                $('#pre_city_for_heirship').val(damanCityArray[VALUE_TWO]);
                var city_code = VALUE_TWO;
            }

            var pincodeData = damanCityPincodeArray[city_code];
//            $('#pincode_for_heirship').val(pincodeData);
            $('#pre_pincode_for_heirship').val(pincodeData);

            generateSelect2();
        } else if (district == VALUE_TWO) {
            renderOptionsForTwoDimensionalArray(diuCityArray, 'pre_city_for_heirship');
            renderOptionsForTwoDimensionalArray(diuCityArray, 'per_city_for_heirship');
            $('#pre_city_for_heirship').val(diuCityArray[VALUE_ONE]);
//            $('#pincode_for_heirship').val('');
            $('#pre_pincode_for_heirship').val('');

        } else if (district == VALUE_THREE) {
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'pre_city_for_heirship');
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'per_city_for_heirship');
            $('#pre_city_for_heirship').val(dnhCityArray[VALUE_ONE]);
//            $('#pincode_for_heirship').val('');
            $('#pre_pincode_for_heirship').val('');
            $('#pre_pincode_for_heirship').val('');
        }
    },
    getPincode: function () {
        var city_code = $('#pre_city_for_heirship').val();
        var pincodeData = damanCityPincodeArray[city_code];
//        $('#pincode_for_heirship').val(pincodeData);
        $('#pre_pincode_for_heirship').val(pincodeData);

        var per_city_code = $('#per_city_for_heirship').val();
        var pincodeData = damanCityPincodeArray[per_city_code];
        $('#per_pincode_for_heirship').val(pincodeData);
    },
    getRemarksStatusForAge: function (row, moduleName) {
        var status = $('#member_remarks_for_' + moduleName + '_' + row).val();
        if (status == VALUE_TWO) {
            $('#age_of_family_memb_for_' + moduleName + '_' + row).hide();
        } else {
            $('#age_of_family_memb_for_' + moduleName + '_' + row).show();
        }
    },
    downloadExcelForHC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_hcge').val($('#app_no_for_heirship_list').val());
        $('#app_date_for_hcge').val($('#application_date_for_heirship_list').val());
        $('#app_details_for_hcge').val($('#app_details_for_heirship_list').val());
        $('#vdw_for_hcge').val(tempTypeInSession != TEMP_TYPE_A ? $('#vdw_for_heirship_list').val() : '');
        $('#status_for_hcge').val($('#status_for_heirship_list').val());
        $('#qstatus_for_hcge').val($('#query_status_for_heirship_list').val());
        $('#app_status_for_hcge').val($('#appointment_status_for_heirship_list').val());
        $('#currently_on_for_hcge').val($('#currently_on_for_heirship_list').val());
        $('#generate_excel_for_heirship').submit();
        $('.hcge').val('');
    },
    addVerificationDocItem: function (docData, moduleId) {
        var that = this;
        docData.cnt = verifyDocCnt;
        docData.verification_type = moduleId;
        $('#upload_verification_doc_item_container_for_heirship_' + moduleId).append(heirshipfieldVerificationDocItemTemplate(docData));
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
        formData.append('heirship_id_for_heirship_update_basic_detail', $('#heirship_id_for_heirship_update_basic_detail').val());
        formData.append('field_document_id_for_field_verification', $('#field_document_id_for_field_verification_' + tempCnt).val());
        formData.append('verification_type_for_field_verification', $('#verification_type_for_field_verification_' + tempCnt).val());
        formData.append('document_for_verification_document', $('#' + id)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'heirship/upload_field_verification_document',
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
        $('#' + documentFieldName + '_name_href_for_verification_document_' + cnt).attr('href', 'documents/heirship/' + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_verification_document_' + cnt).html(VIEW_UPLODED_DOCUMENT);
        $('#' + documentFieldName + '_remove_btn_for_verification_document_' + cnt).attr('onclick', 'Heirship.listview.askForRemoveDocForFieldVerification("' + docItemData.field_verification_document_id + '","' + cnt + '")');
    },
    askForRemoveDocForFieldVerification: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Heirship.listview.removeFieldDoc(' + fieldDocumentId + ', ' + cnt + ')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeFieldDoc: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'heirship/remove_field_document',
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
        var yesEvent = 'Heirship.listview.removeFieldItemRow(' + cnt + ')';
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
            url: 'heirship/remove_field_document_item',
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(heirshipfieldVerificationViewDocItemTemplate(docDetail));
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
        $('#' + id + '_name_href_for_' + moduleType + '_view_' + tempCnt).attr('href', 'documents/heirship/' + docField);
        $('#' + id + '_name_for_' + moduleType + '_view_' + tempCnt).html(VIEW_UPLODED_DOCUMENT);
    },
});
