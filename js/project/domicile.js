var domicileListTemplate = Handlebars.compile($('#domicile_list_template').html());
var domicileSearchTemplate = Handlebars.compile($('#domicile_search_template').html());
var domicileTableTemplate = Handlebars.compile($('#domicile_table_template').html());
var domicileActionTemplate = Handlebars.compile($('#domicile_action_template').html());
var domicileFormTemplate = Handlebars.compile($('#domicile_form_template').html());
var domicileViewTemplate = Handlebars.compile($('#domicile_view_template').html());
var domicileApproveTemplate = Handlebars.compile($('#domicile_approve_template').html());
var domicileRejectTemplate = Handlebars.compile($('#domicile_reject_template').html());
var domicileViewDocumentTemplate = Handlebars.compile($('#domicile_view_document_template').html());
var domicileSetAppointmentTemplate = Handlebars.compile($('#domicile_set_appointment_template').html());
var domicileUpdateBasicDetailTemplate = Handlebars.compile($('#domicile_update_basic_detail_template').html());

var typeOneDomicileFormTemplate = Handlebars.compile($('#type_one_domicile_form_template').html());
var typeTwoADomicileFormTemplate = Handlebars.compile($('#type_two_a_domicile_form_template').html());
var typeTwoBDomicileFormTemplate = Handlebars.compile($('#type_two_b_domicile_form_template').html());
var typeTwoCDomicileFormTemplate = Handlebars.compile($('#type_two_c_domicile_form_template').html());
var typeThreeADomicileFormTemplate = Handlebars.compile($('#type_three_a_domicile_form_template').html());
var typeThreeBDomicileFormTemplate = Handlebars.compile($('#type_three_b_domicile_form_template').html());
var typeFourDomicileFormTemplate = Handlebars.compile($('#type_four_domicile_form_template').html());

var applicantEducationInfoTemplate = Handlebars.compile($('#applicant_education_detail_template').html());
var applicantResidentialInfoTemplate = Handlebars.compile($('#residential_detail_template').html());
var applicantBusinessInfoTemplate = Handlebars.compile($('#business_detail_template').html());
var applicantServiceInfoTemplate = Handlebars.compile($('#service_detail_template').html());
var domicileFieldVerificationDocItemTemplate = Handlebars.compile($('#domicile_field_verification_document_template').html());
var domicileFieldVerificationViewDocItemTemplate = Handlebars.compile($('#domicile_field_verification_view_document_template').html());



var tempPersonCnt = 1;
var tempEducationDetailCnt = 1;
var tempResidentialDetailCnt = 1;
var tempBusinessDetailCnt = 1;
var tempServiceDetailCnt = 1;

var tempMemberCnt = 1;
var tempACIData = [];
var tempMamData = [];
var searchDCF = {};

var Domicile = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Domicile.Router = Backbone.Router.extend({
    routes: {
        'domicile': 'renderList',
        'domicile_form': 'renderListForForm',
        'edit_domicile_form': 'renderList',
        'view_domicile_form': 'renderList',
        'type_one_domicile_form': 'renderListForTypeOne',
        'edit_type_one_domicile_form': 'renderList',
        'type_two_a_domicile_form': 'renderListForTypeTwoA',
        'edit_type_two_a_domicile_form': 'renderList',
        'type_two_b_domicile_form': 'renderListForTypeTwoB',
        'edit_type_two_b_domicile_form': 'renderList',
        'type_two_c_domicile_form': 'renderListForTypeTwoC',
        'edit_type_two_c_domicile_form': 'renderList',
        'type_three_a_domicile_form': 'renderListForTypeThreeA',
        'edit_type_three_a_domicile_form': 'renderList',
        'type_three_b_domicile_form': 'renderListForTypeThreeB',
        'edit_type_three_b_domicile_form': 'renderList',
        'type_four_domicile_form': 'renderListForTypeFour',
        'edit_type_four_domicile_form': 'renderList',
    },
    renderList: function () {
        Domicile.listview.listPage();
    },
    renderListForForm: function () {
        Domicile.listview.listPageDomicileForm();
    },
    renderListForTypeOne: function () {
        Domicile.listview.listPageTypeOneDomicileForm();
    },
    renderListForTypeTwoA: function () {
        Domicile.listview.listPageTypeTwoADomicileForm();
    },
    renderListForTypeTwoB: function () {
        Domicile.listview.listPageTypeTwoBDomicileForm();
    },
    renderListForTypeTwoC: function () {
        Domicile.listview.listPageTypeTwoCDomicileForm();
    },
    renderListForTypeTwoC: function () {
        Domicile.listview.listPageTypeTwoCDomicileForm();
    },
    renderListForTypeThreeA: function () {
        Domicile.listview.listPageTypeThreeADomicileForm();
    },
    renderListForTypeThreeB: function () {
        Domicile.listview.listPageTypeThreeBDomicileForm();
    },
    renderListForTypeFour: function () {
        Domicile.listview.listPageTypeFourDomicileForm();
    },
});
Domicile.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="gender_for_dc"]': 'basicShowHideInfo',
        'click input[name="marital_status_for_dc"]': 'basicShowHideInfo',
        'click input[name="spouse_alive_for_dc"]': 'mstatusShowHideInfo',
    },
    mstatusShowHideInfo: function (event) {
        $('#spouse_alive_container_for_dc').click(function () {
            var s_alive_dc = $("input[name='spouse_alive_for_dc']:checked").val();
            if (s_alive_dc == '1') {
                $('#marital_status_for_dc_1').prop('checked', true);
            } else {
                $('#marital_status_for_dc_3').prop('checked', true);
            }
        });
    },
    basicShowHideInfo: function (event) {
        var g_status_dc = $("input[name='gender_for_dc']:checked").val();
        var m_status_dc = $("input[name='marital_status_for_dc']:checked").val();
        var d_id_dc = $("#domicile_certificate_id").val();
        var ca_id_dc = $("#constitution_artical").val();
        var f_proof_href = $("#father_proof_download").attr('href');
        var m_proof_href = $("#mother_proof_download").attr('href');
        var s_proof_href = $("#spouse_proof_download").attr('href');

        $(".marital_status_item_container_for_dc :input").prop('disabled', false);
        if (g_status_dc == '3' || g_status_dc == '4') {
            $(".marital_status_item_container_for_dc :input").prop('checked', false);
            $(".marital_status_item_container_for_dc :input").prop('disabled', true);
            // collapse info
            $('.father_info_item_container_for_dc').hide();
            $('.mother_info_item_container_for_dc').hide();
            $('.spouse_info_item_container_for_dc').hide();
            // uploads info
            $('.father_proof_file_container_for_dc').hide();
            $('.mother_proof_file_container_for_dc').hide();
            $('.spouse_proof_file_container_for_dc').hide();
        }
        //if(ca_id_dc != VALUE_TWO){
        if (g_status_dc == '1' && (m_status_dc == '1' || m_status_dc == '3')) {
            $('.father_info_item_container_for_dc').show();
            $('.mother_info_item_container_for_dc').show();
            $('.spouse_info_item_container_for_dc').show();

            $('.father_proof_file_container_for_dc').show();
            $('.mother_proof_file_container_for_dc').show();
            $('.spouse_proof_file_container_for_dc').show();
            if (m_status_dc == '1') {
                $('#spouse_alive_for_dc_1').prop('checked', true);
                $('.spouse_death_proof_item_container_for_dc').hide();
                $('.spouse_proof_item_container_for_dc').show();
                $('.is_spouse_alive_container_for_dc').show();
            } else if (m_status_dc == '3') {
                $('#spouse_alive_for_dc_2').prop('checked', true);
                $('.spouse_death_proof_item_container_for_dc').show();
                $('.spouse_proof_item_container_for_dc').hide();
                $('.is_spouse_alive_container_for_dc').hide();
            }

            if (d_id_dc == '') {
                $('#father_birth_certificate_container_for_dc').show();
                $('#father_election_card_container_for_dc').show();
                $('#father_aadhar_card_container_for_dc').show();

                $('#mother_birth_certificate_container_for_dc').show();
                $('#mother_election_card_container_for_dc').show();
                $('#mother_aadhar_card_container_for_dc').show();

                $('#spouse_birth_certificate_container_for_dc').show();
                $('#spouse_election_card_container_for_dc').show();
                $('#spouse_aadhar_card_container_for_dc').show();

            } else {
                if (f_proof_href != undefined) {
                    $('#father_birth_certificate_name_container_for_dc').show();
                    $('#father_election_card_name_container_for_dc').show();
                    $('#father_aadhar_card_name_container_for_dc').show();

                    $('#father_birth_certificate_container_for_dc').hide();
                    $('#father_election_card_container_for_dc').hide();
                    $('#father_aadhar_card_container_for_dc').hide();
                } else {
                    $('#father_birth_certificate_container_for_dc').show();
                    $('#father_election_card_container_for_dc').show();
                    $('#father_aadhar_card_container_for_dc').show();

                    $('#father_birth_certificate_name_container_for_dc').hide();
                    $('#father_election_card_name_container_for_dc').hide();
                    $('#father_aadhar_card_name_container_for_dc').hide();
                }

                if (m_proof_href != undefined) {
                    $('#mother_proof_name_container_for_domicile').show();
                    $('#mother_birth_certificate_container_for_dc').hide();
                    $('#mother_election_card_container_for_dc').hide();
                    $('#mother_aadhar_card_container_for_dc').hide();
                } else {
                    $('#mother_birth_certificate_container_for_dc').show();
                    $('#mother_election_card_container_for_dc').show();
                    $('#mother_aadhar_card_container_for_dc').show();
                    $('#mother_proof_name_container_for_domicile').hide();
                }
                if (s_proof_href != undefined) {
                    $('#spouse_proof_name_container_for_domicile').show();
                    $('#spouse_birth_certificate_container_for_dc').hide();
                    $('#spouse_election_card_container_for_dc').hide();
                    $('#spouse_aadhar_card_container_for_dc').hide();
                } else {
                    $('#spouse_birth_certificate_container_for_dc').show();
                    $('#spouse_election_card_container_for_dc').show();
                    $('#spouse_aadhar_card_container_for_dc').show();
                    $('#spouse_proof_name_container_for_domicile').hide();
                }
            }
        } else if (g_status_dc == '1' && (m_status_dc == '2' || m_status_dc == '4')) {
            $('.father_info_item_container_for_dc').show();
            $('.mother_info_item_container_for_dc').show();
            $('.spouse_info_item_container_for_dc').hide();
            if (d_id_dc == '') {
                $('#father_birth_certificate_container_for_dc').show();
                $('#father_election_card_container_for_dc').show();
                $('#father_aadhar_card_container_for_dc').show();

                $('#mother_birth_certificate_container_for_dc').show();
                $('#mother_election_card_container_for_dc').show();
                $('#mother_aadhar_card_container_for_dc').show();

                $('#spouse_birth_certificate_container_for_dc').hide();
                $('#spouse_election_card_container_for_dc').hide();
                $('#spouse_aadhar_card_container_for_dc').hide();
                $('#spouse_death_proof_container_for_dc').hide();
            } else {
                $('.spouse_proof_file_container_for_dc').hide();
                if (f_proof_href != undefined) {
                    $('#father_birth_certificate_name_container_for_dc').show();
                    $('#father_election_card_name_container_for_dc').show();
                    $('#father_aadhar_card_name_container_for_dc').show();

                    $('#father_birth_certificate_container_for_dc').hide();
                    $('#father_election_card_container_for_dc').hide();
                    $('#father_aadhar_card_container_for_dc').hide();
                } else {
                    $('#father_birth_certificate_container_for_dc').show();
                    $('#father_election_card_container_for_dc').show();
                    $('#father_aadhar_card_container_for_dc').show();

                    $('#father_birth_certificate_name_container_for_dc').hide();
                    $('#father_election_card_name_container_for_dc').hide();
                    $('#father_aadhar_card_name_container_for_dc').hide();
                }

                if (m_proof_href != undefined) {
                    $('#mother_proof_name_container_for_domicile').show();
                    $('#mother_birth_certificate_container_for_dc').hide();
                    $('#mother_election_card_container_for_dc').hide();
                    $('#mother_aadhar_card_container_for_dc').hide();
                } else {
                    $('#mother_birth_certificate_container_for_dc').show();
                    $('#mother_election_card_container_for_dc').show();
                    $('#mother_aadhar_card_container_for_dc').show();
                    $('#mother_proof_name_container_for_domicile').hide();
                }
            }
        } else if (g_status_dc == '2' && (m_status_dc == '1' || m_status_dc == '3')) {

            if (ca_id_dc != VALUE_TWO && ca_id_dc != VALUE_THREE && ca_id_dc != VALUE_SEVEN) {
                $('.father_info_item_container_for_dc').hide();
                $('.mother_info_item_container_for_dc').hide();
            }
            $('.spouse_info_item_container_for_dc').show();
            $('.spouse_proof_file_container_for_dc').show();
            if (m_status_dc == '1') {
                $('#spouse_alive_for_dc_1').prop('checked', true);
                $('.spouse_death_proof_item_container_for_dc').hide();
                $('.spouse_proof_item_container_for_dc').show();
                $('.is_spouse_alive_container_for_dc').show();
            } else if (m_status_dc == '3') {
                $('#spouse_alive_for_dc_2').prop('checked', true);
                $('.spouse_death_proof_item_container_for_dc').show();
                $('.spouse_proof_item_container_for_dc').hide();
                $('.is_spouse_alive_container_for_dc').hide();
            }

            if (d_id_dc == '') {
                if (ca_id_dc != VALUE_TWO && ca_id_dc != VALUE_THREE && ca_id_dc != VALUE_SEVEN) {
                    $('#father_birth_certificate_container_for_dc').hide();
                    $('#father_election_card_container_for_dc').hide();
                    $('#father_aadhar_card_container_for_dc').hide();

                    $('#mother_birth_certificate_container_for_dc').hide();
                    $('#mother_election_card_container_for_dc').hide();
                    $('#mother_aadhar_card_container_for_dc').hide();
                }
                $('#spouse_birth_certificate_container_for_dc').show();
                $('#spouse_election_card_container_for_dc').show();
                $('#spouse_aadhar_card_container_for_dc').show();
            } else {
                if (ca_id_dc != VALUE_TWO && ca_id_dc != VALUE_THREE && ca_id_dc != VALUE_SEVEN) {
                    $('.father_proof_file_container_for_dc').hide();
                    $('.mother_proof_file_container_for_dc').hide();
                }
                if (s_proof_href != undefined) {
                    $('#spouse_proof_name_container_for_domicile').show();
                    $('#spouse_birth_certificate_container_for_dc').hide();
                    $('#spouse_election_card_container_for_dc').hide();
                    $('#spouse_aadhar_card_container_for_dc').hide();
                } else {
                    $('#spouse_birth_certificate_container_for_dc').show();
                    $('#spouse_election_card_container_for_dc').show();
                    $('#spouse_aadhar_card_container_for_dc').show();
                    $('#spouse_proof_name_container_for_domicile').hide();
                }
            }
        } else if (g_status_dc == '2' && (m_status_dc == '2' || m_status_dc == '4')) {
            $('.father_info_item_container_for_dc').show();
            $('.mother_info_item_container_for_dc').show();
            $('.spouse_info_item_container_for_dc').hide();
            if (d_id_dc == '') {
                $('#father_birth_certificate_container_for_dc').show();
                $('#father_election_card_container_for_dc').show();
                $('#father_aadhar_card_container_for_dc').show();

                $('#mother_birth_certificate_container_for_dc').show();
                $('#mother_election_card_container_for_dc').show();
                $('#mother_aadhar_card_container_for_dc').show();

                $('#spouse_birth_certificate_container_for_dc').hide();
                $('#spouse_election_card_container_for_dc').hide();
                $('#spouse_aadhar_card_container_for_dc').hide();
                $('#spouse_death_proof_container_for_dc').hide();
            } else {
                $('.father_proof_file_container_for_dc').show();
                $('.mother_proof_file_container_for_dc').show();
                $('.spouse_proof_file_container_for_dc').hide();
                if (f_proof_href != undefined) {
                    $('#father_birth_certificate_name_container_for_dc').show();
                    $('#father_election_card_name_container_for_dc').show();
                    $('#father_aadhar_card_name_container_for_dc').show();

                    $('#father_birth_certificate_container_for_dc').hide();
                    $('#father_election_card_container_for_dc').hide();
                    $('#father_aadhar_card_container_for_dc').hide();
                } else {
                    $('#father_birth_certificate_container_for_dc').show();
                    $('#father_election_card_container_for_dc').show();
                    $('#father_aadhar_card_container_for_dc').show();

                    $('#father_birth_certificate_name_container_for_dc').hide();
                    $('#father_election_card_name_container_for_dc').hide();
                    $('#father_aadhar_card_name_container_for_dc').hide();
                }

                if (m_proof_href != undefined) {
                    $('#mother_proof_name_container_for_domicile').show();
                    $('#mother_birth_certificate_container_for_dc').hide();
                    $('#mother_election_card_container_for_dc').hide();
                    $('#mother_aadhar_card_container_for_dc').hide();
                } else {
                    $('#mother_birth_certificate_container_for_dc').show();
                    $('#mother_election_card_container_for_dc').show();
                    $('#mother_aadhar_card_container_for_dc').show();
                    $('#mother_proof_name_container_for_domicile').hide();
                }
            }
        } else {
            if (g_status_dc == '1' || g_status_dc == '2') {
                $(".marital_status_item_container_for_dc :input").prop('disabled', false);
                // collapse info
                $('.father_info_item_container_for_dc').show();
                $('.mother_info_item_container_for_dc').show();
                // uploads info
                $('.father_proof_file_container_for_dc').show();
                $('.mother_proof_file_container_for_dc').show();
            }
        }
        //}
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
        addClass('menu_domicile', 'active');
        Domicile.router.navigate('domicile');
        var templateData = {};
        searchDCF = {};
        this.$el.html(domicileListTemplate(templateData));
        this.loadDomicileData(sDistrict, sType);

    },
    listPageTypeOneDomicileForm: function () {
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
        addClass('mam_domicile_certificate', 'active');
        this.$el.html(domicileListTemplate);
        this.typeOneDomicileForm(false, {});
    },
    listPageTypeTwoADomicileForm: function () {
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
        addClass('mam_domicile_certificate', 'active');
        this.$el.html(domicileListTemplate);
        this.typeTwoADomicileForm(false, {});
    },
    listPageTypeTwoBDomicileForm: function () {
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
        addClass('mam_domicile_certificate', 'active');
        this.$el.html(domicileListTemplate);
        this.typeTwoBDomicileForm(false, {});
    },
    listPageTypeTwoCDomicileForm: function () {
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
        addClass('mam_domicile_certificate', 'active');
        this.$el.html(domicileListTemplate);
        this.typeTwoCDomicileForm(false, {});
    },
    listPageTypeThreeADomicileForm: function () {
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
        addClass('mam_domicile_certificate', 'active');
        this.$el.html(domicileListTemplate);
        this.typeThreeADomicileForm(false, {});
    },
    listPageTypeThreeBDomicileForm: function () {
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
        addClass('mam_domicile_certificate', 'active');
        this.$el.html(domicileListTemplate);
        this.typeThreeBDomicileForm(false, {});
    },
    listPageTypeFourDomicileForm: function () {
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
        addClass('mam_domicile_certificate', 'active');
        this.$el.html(domicileListTemplate);
        this.typeFourDomicileForm(false, {});
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
        rowData.module_type = VALUE_ONE;
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
        return domicileActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        var onlineStatement = appointmentData.online_statement == VALUE_ONE ? 'Online Statement' : '';
        var visitOffice = appointmentData.visit_office == VALUE_ONE ? 'Visit Office' : '';
        if (appointmentData.appointment_date == '0000-00-00') {
            return '<span id="appointment_container_' + appointmentData.domicile_certificate_id + '" class="badge bg-warning app-status">Appointment Not Scheduled By Talathi</span>';
        }
        var returnString = '<span id="appointment_container_' + appointmentData.domicile_certificate_id + '"><span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">' + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">' + onlineStatement;
        if (onlineStatement != '' && visitOffice != '') {
            returnString += ',<br>';
        }
        returnString += (visitOffice + '</span>');
        return returnString;
    },
    getConstitutionData: function (constitutionData) {
        return domicileAppTypeArray[constitutionData.constitution_artical] ? domicileAppTypeArray[constitutionData.constitution_artical] : '';
    },
    loadDomicileData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        Domicile.router.navigate('domicile');
        var searchData = dtomMam(sDistrict, sType, 'Domicile.listview.loadDomicileData();');
        $('#domicile_form_and_datatable_container').html(domicileSearchTemplate(searchData));
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            renderOptionsForTwoDimensionalArray(appointmentFilterArray, 'appointment_status_for_domicile_list', false);
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            renderOptionsForTwoDimensionalArray(currentlyOnTypeArray, 'currently_on_for_domicile_list', false);
        }

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_domicile_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_domicile_list', false);
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_domicile_list', false);
        datePickerId('application_date_for_domicile_list');

        if (tempTypeInSession != TEMP_TYPE_A) {
            var dwVillagesData = (tempDistrictInSession == VALUE_ONE ? damanVillagesArray : (tempDistrictInSession == VALUE_TWO ? diuVillagesArray : (tempDistrictInSession == VALUE_THREE ? dnhVillagesArray : [])));
            if (tempAVInSession != '') {
                var avData = tempAVInSession.split(',');
                renderOptionsForAVArray(avData, dwVillagesData, 'vdw_for_domicile_list', false);
            } else {
                renderOptionsForTwoDimensionalArray(dwVillagesData, 'vdw_for_domicile_list', false);
            }
        } else {
            if (typeof searchDCF.district_for_domicile_list != "undefined" && searchDCF.district_for_domicile_list != '' && searchDCF.village_for_domicile_list != '') {
                var villageData = (searchDCF.district_for_domicile_list == VALUE_ONE ? damanVillagesArray : (searchDCF.district_for_domicile_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_domicile_list', false);
            }
        }

        $('#app_no_for_domicile_list').val((typeof searchDCF.app_no_for_domicile_list != "undefined" && searchDCF.app_no_for_domicile_list != '') ? searchDCF.app_no_for_domicile_list : '');
        $('#application_date_for_domicile_list').val((typeof searchDCF.application_date_for_domicile_list != "undefined" && searchDCF.application_date_for_domicile_list != '') ? searchDCF.application_date_for_domicile_list : searchData.s_appd);
        $('#app_details_for_domicile_list').val((typeof searchDCF.app_details_for_domicile_list != "undefined" && searchDCF.app_details_for_domicile_list != '') ? searchDCF.app_details_for_domicile_list : '');
        $('#appointment_status_for_domicile_list').val((typeof searchDCF.appointment_status_for_domicile_list != "undefined" && searchDCF.appointment_status_for_domicile_list != '') ? searchDCF.appointment_status_for_domicile_list : searchData.s_app_status);
        $('#query_status_for_domicile_list').val((typeof searchDCF.query_status_for_domicile_list != "undefined" && searchDCF.query_status_for_domicile_list != '') ? searchDCF.query_status_for_domicile_list : searchData.s_qstatus);
        $('#status_for_domicile_list').val((typeof searchDCF.status_for_domicile_list != "undefined" && searchDCF.status_for_domicile_list != '') ? searchDCF.status_for_domicile_list : searchData.s_status);
        $('#currently_on_for_domicile_list').val((typeof searchDCF.currently_on_for_domicile_list != "undefined" && searchDCF.currently_on_for_domicile_list != '') ? searchDCF.currently_on_for_domicile_list : searchData.s_co_hand);
        $('#district_for_domicile_list').val((typeof searchDCF.district_for_domicile_list != "undefined" && searchDCF.district_for_domicile_list != '') ? searchDCF.district_for_domicile_list : searchData.search_district);
        $('#vdw_for_domicile_list').val((typeof searchDCF.vdw_for_domicile_list != "undefined" && searchDCF.vdw_for_domicile_list != '') ? searchDCF.vdw_for_domicile_list : '');
        $('#is_full_for_domicile_list').val((typeof searchDCF.is_full_for_domicile_list != "undefined" && searchDCF.is_full_for_domicile_list != '') ? searchDCF.is_full_for_domicile_list : searchData.s_is_full);


        this.searchDomicileData();
    },
    searchDomicileData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#domicile_datatable_container').html(domicileTableTemplate);
        var searchData = $('#search_domicile_form').serializeFormJSON();

        searchDCF = searchData;
        if (typeof btnObj == "undefined" && (searchDCF.app_details_for_domicile_list == ''
                && searchDCF.app_no_for_domicile_list == ''
                && searchDCF.application_date_for_domicile_list == ''
                && searchDCF.appointment_status_for_domicile_list == ''
                && searchDCF.is_full_for_domicile_list == ''
                && searchDCF.query_status_for_domicile_list == ''
                && searchDCF.status_for_domicile_list == ''
                && (searchDCF.district_for_domicile_list == '' || typeof searchDCF.district_for_domicile_list == "undefined")
                && (searchDCF.vdw_for_domicile_list == '' || typeof searchDCF.vdw_for_domicile_list == "undefined")
                && (searchDCF.currently_on_for_domicile_list == '' || typeof searchDCF.currently_on_for_domicile_list == "undefined"))) {
            domicileDataTable = $('#domicile_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#domicile_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appTypeRenderer = function (data, type, full, meta) {
            return that.getConstitutionData(full);
        };
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.name_of_applicant + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.com_addr_house_no + ',' + (full.com_addr_house_name == '' ? '' : full.com_addr_house_name + ',') + full.com_addr_street + ',' + full.com_addr_village_dmc_ward + ',' + full.com_addr_city + ',' + (full.com_pincode == '0' ? full.pincode : full.com_pincode) + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? damanVillagesArray : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '') + '<hr>' + (villageData[full.village_name] ? villageData[full.village_name] : '');
        };
        var appointmentRenderer = function (data, type, full, meta) {
            return '<div id="appointment_container_' + data + '">' + that.getAppointmentData(full) + '</div>';
        };
        var movementRenderer = function (data, type, full, meta) {
            return '<div id="movement_for_dc_list_' + data + '">' + movementString(full) + '</div>';
        };
        $('#domicile_datatable_container').html(domicileTableTemplate);
        domicileDataTable = $('#domicile_datatable').DataTable({
            ajax: {url: 'domicile/get_domicile_data',
                dataSrc: "domicile_data",
                type: "post", data: searchData},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: '', 'class': '', 'render': appNumberWithRegiUserRenderer},
                {data: 'domicile_certificate_id', 'class': 'v-a-t text-center f-s-12px', 'render': appTypeRenderer},
                {data: '', 'class': 'f-s-app-details', 'render': appDetailsRenderer},
                {data: 'district', 'class': 'text-center f-s-app-details', 'render': distVillRenderer},
                {data: 'domicile_certificate_id', 'class': 'v-a-t text-center f-s-14px', 'render': appointmentRenderer},
                {data: 'domicile_certificate_id', 'class': 'v-a-t', 'render': movementRenderer},
                {data: 'domicile_certificate_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'domicile_certificate_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "fnRowCallback": aciNR,
            "initComplete": searchableDatatable
        });

        $('#domicile_datatable_filter').remove();
        $('#domicile_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = domicileDataTable.row(tr);

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
    typeOneDomicileForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.domicile_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            Domicile.router.navigate('edit_type_one_domicile_form');
        } else {
            var formData = {};
            Domicile.router.navigate('type_one_domicile_form');
        }

        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        templateData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        templateData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        templateData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.domicile_data = parseData.domicile_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
        }
        $('#domicile_form_and_datatable_container').html(typeOneDomicileFormTemplate(templateData));

        allowOnlyIntegerValue('residing_year_for_dc');
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_dc');
        generateBoxes('radio', genderArray, 'gender', 'dc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'dc', formData.marital_status, false, false);

        var $select = $(".year");
        for (i = 0; i <= 99; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var $select = $(".month");
        for (i = 1; i <= 12; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var $select = $(".days");
        for (i = 0; i <= 31; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(educationTypeArray, 'applicant_education_for_dc');
        renderOptionsForTwoDimensionalArray(domicileCertificatePurposeArray, 'select_required_purpose_for_dc');
        generateBoxes('radio', yesNoArray, 'father_alive', 'dc', formData.father_alive, false, false);
        showSubContainer('father_alive', 'dc', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'dc', '.father_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('father_alive', 'dc', '.is_father_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'dc', formData.mother_alive, false, false);
        showSubContainer('mother_alive', 'dc', '.mother_proof_item', VALUE_ONE, 'radio');
        showSubContainer('mother_alive', 'dc', '.mother_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('mother_alive', 'dc', '.is_mother_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'dc', formData.spouse_alive, false, false);
        showSubContainer('spouse_alive', 'dc', '.spouse_proof_item', VALUE_ONE, 'radio');
        showSubContainer('spouse_alive', 'dc', '.spouse_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('spouse_alive', 'dc', '.is_spouse_alive', VALUE_ONE, 'radio');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'native_place_state_for_dc');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'father_native_place_state_for_dc');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'mother_native_place_state_for_dc');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'spouse_native_place_state_for_dc');
        if (isEdit) {
            $('#born_place_state_for_dc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);
            var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_dc', 'district_code', 'district_name', 'District');
            $('#born_place_district_for_dc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);
            that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'dc', formData.born_place_village, 'born_place');
            $('#born_place_village_for_dc').val(formData.born_place_village);
            $('#native_place_state_for_dc').val(formData.native_place_state == 0 ? '' : formData.native_place_state);
            var native_state = formData.native_place_state;
            var districtData = isEdit ? (native_state == VALUE_ONE ? damandiudistrictArray : (native_state == VALUE_TWO ? dnhdistrictArray : [])) : [];
            renderOptionsForTwoDimensionalArray(districtData, 'native_place_district_for_dc');
            $('#native_place_district_for_dc').val(formData.native_place_district == 0 ? '' : formData.native_place_district);
            var native_district = formData.native_place_district;
            var villageDataForNative = isEdit ? (native_district == VALUE_ONE ? damanVillageForNativeArray : (native_district == VALUE_TWO ? diuVillagesForNativeArray : (native_district == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
            renderOptionsForTwoDimensionalArray(villageDataForNative, 'native_place_village_for_dc');
            $('#native_place_village_for_dc').val(formData.native_place_village == 0 ? '' : formData.native_place_village);
            $('#applicant_education_for_dc').val(formData.applicant_education);
            if (formData.applicant_education == VALUE_FIVE)
                $('.other_education_div_for_dc').show();
            $('#com_addr_city_for_dc').val(formData.com_addr_city);
            $('#village_name_for_dc').val(formData.village_name);
            $('#district').val(formData.district);
            $('#occupation_for_dc').val(formData.occupation);
            $('#select_required_purpose_for_dc').val(formData.select_required_purpose);
            if (formData.occupation == VALUE_TWELVE)
                $('.other_occupation_div_for_dc').show();
            if (formData.select_required_purpose == VALUE_FIVE)
                $('.other_required_purpose_for_dc_div').show();
            if (formData.gender == VALUE_THREE || formData.gender == VALUE_FOUR)
                $(".marital_status_item_container_for_dc :input").prop('disabled', true);
            $('.father_info_div').collapse().show();
            $('.mother_info_div').collapse().show();
            if (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE)
                $('.spouse_info_div').collapse().show();

            // Father
            $('#father_born_place_state_for_dc').val(fatherDetails.father_born_place_state == 0 ? '' : fatherDetails.father_born_place_state);
            var districtData = tempDistrictData[fatherDetails.father_born_place_state] ? tempDistrictData[fatherDetails.father_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_dc', 'district_code', 'district_name', 'District');
            $('#father_born_place_district_for_dc').val(fatherDetails.father_born_place_district == 0 ? '' : fatherDetails.father_born_place_district);
            that.getEditVillageData(fatherDetails.father_born_place_state, fatherDetails.father_born_place_district, 'dc', fatherDetails.father_born_place_village, 'father_born_place');
            $('#father_born_place_village_for_dc').val(fatherDetails.father_born_place_village);
            $('#father_native_place_state_for_dc').val(fatherDetails.father_native_place_state == 0 ? '' : fatherDetails.father_native_place_state);
            var father_native_state = fatherDetails.father_native_place_state;
            var fatherDistrictData = isEdit ? (father_native_state == VALUE_ONE ? damandiudistrictArray : (father_native_state == VALUE_TWO ? dnhdistrictArray : [])) : [];
            renderOptionsForTwoDimensionalArray(fatherDistrictData, 'father_native_place_district_for_dc');
            $('#father_native_place_district_for_dc').val(fatherDetails.father_native_place_district == 0 ? '' : fatherDetails.father_native_place_district);
            var father_native_district = fatherDetails.father_native_place_district;
            var fatherVillageDataForNative = isEdit ? (father_native_district == VALUE_ONE ? damanVillageForNativeArray : (father_native_district == VALUE_TWO ? diuVillagesForNativeArray : (father_native_district == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
            renderOptionsForTwoDimensionalArray(fatherVillageDataForNative, 'father_native_place_village_for_dc');
            $('#father_native_place_village_for_dc').val(fatherDetails.father_native_place_village == 0 ? '' : fatherDetails.father_native_place_village);

            $('#father_city_for_dc').val(fatherDetails.father_city);
            $('#father_occupation_for_dc').val(fatherDetails.father_occupation);
            if (fatherDetails.father_occupation == VALUE_TWELVE)
                $('.father_other_occupation_div_for_dc').show();
            // Mother
            $('#mother_born_place_state_for_dc').val(motherDetails.mother_born_place_state == 0 ? '' : motherDetails.mother_born_place_state);
            var districtData = tempDistrictData[motherDetails.mother_born_place_state] ? tempDistrictData[motherDetails.mother_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_dc', 'district_code', 'district_name', 'District');
            $('#mother_born_place_district_for_dc').val(motherDetails.mother_born_place_district == 0 ? '' : motherDetails.mother_born_place_district);
            that.getEditVillageData(motherDetails.mother_born_place_state, motherDetails.mother_born_place_district, 'dc', motherDetails.mother_born_place_village, 'mother_born_place');
            $('#mother_native_place_state_for_dc').val(motherDetails.mother_native_place_state == 0 ? '' : motherDetails.mother_native_place_state);
            var mother_native_state = motherDetails.mother_native_place_state;
            var motherDistrictData = isEdit ? (mother_native_state == VALUE_ONE ? damandiudistrictArray : (mother_native_state == VALUE_TWO ? dnhdistrictArray : [])) : [];
            renderOptionsForTwoDimensionalArray(motherDistrictData, 'mother_native_place_district_for_dc');
            $('#mother_native_place_district_for_dc').val(motherDetails.mother_native_place_district == 0 ? '' : motherDetails.mother_native_place_district);
            var mother_native_district = motherDetails.mother_native_place_district;
            var motherVillageDataForNative = isEdit ? (mother_native_district == VALUE_ONE ? damanVillageForNativeArray : (mother_native_district == VALUE_TWO ? diuVillagesForNativeArray : (mother_native_district == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
            renderOptionsForTwoDimensionalArray(motherVillageDataForNative, 'mother_native_place_village_for_dc');
            $('#mother_native_place_village_for_dc').val(motherDetails.mother_native_place_village == 0 ? '' : motherDetails.mother_native_place_village);

            $('#mother_city_for_dc').val(motherDetails.mother_city);
            $('#mother_occupation_for_dc').val(motherDetails.mother_occupation);
            if (motherDetails.mother_occupation == VALUE_TWELVE)
                $('.mother_other_occupation_div_for_dc').show();
            if (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE) {
                // Spouse
                $('#spouse_born_place_state_for_dc').val(spouseDetails.spouse_born_place_state == 0 ? '' : spouseDetails.spouse_born_place_state);
                var districtData = tempDistrictData[spouseDetails.spouse_born_place_state] ? tempDistrictData[spouseDetails.spouse_born_place_state] : [];
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_born_place_district_for_dc', 'district_code', 'district_name', 'District');
                $('#spouse_born_place_district_for_dc').val(spouseDetails.spouse_born_place_district == 0 ? '' : spouseDetails.spouse_born_place_district);
                that.getEditVillageData(spouseDetails.spouse_born_place_state, spouseDetails.spouse_born_place_district, 'dc', spouseDetails.spouse_born_place_village, 'spouse_born_place');
                $('#spouse_native_place_state_for_dc').val(spouseDetails.spouse_native_place_state == 0 ? '' : spouseDetails.spouse_native_place_state);
                var spouse_native_state = spouseDetails.spouse_native_place_state;
                var spouseDistrictData = isEdit ? (spouse_native_state == VALUE_ONE ? damandiudistrictArray : (spouse_native_state == VALUE_TWO ? dnhdistrictArray : [])) : [];
                renderOptionsForTwoDimensionalArray(spouseDistrictData, 'spouse_native_place_district_for_dc');
                $('#spouse_native_place_district_for_dc').val(spouseDetails.spouse_native_place_district == 0 ? '' : spouseDetails.spouse_native_place_district);
                var spouse_native_district = spouseDetails.spouse_native_place_district;
                var spouseVillageDataForNative = isEdit ? (spouse_native_district == VALUE_ONE ? damanVillageForNativeArray : (spouse_native_district == VALUE_TWO ? diuVillagesForNativeArray : (spouse_native_district == VALUE_THREE ? dnhVillagesForNativeArray : []))) : [];
                renderOptionsForTwoDimensionalArray(spouseVillageDataForNative, 'spouse_native_place_village_for_dc');
                $('#spouse_native_place_village_for_dc').val(spouseDetails.spouse_native_place_village == 0 ? '' : spouseDetails.spouse_native_place_village);
                $('#spouse_city_for_dc').val(spouseDetails.spouse_city);
                $('#spouse_occupation_for_dc').val(spouseDetails.spouse_occupation);
                if (spouseDetails.spouse_occupation == VALUE_TWELVE)
                    $('.spouse_other_occupation_div_for_dc').show();
            }

            if (formData.father_alive == VALUE_ONE) {
                $('.father_proof_item_container_for_dc').show();
                $('.father_death_proof_item_container_for_dc').hide();
                $('.is_father_alive_container_for_dc').show();
            } else if (formData.father_alive == VALUE_TWO) {
                $('.father_proof_item_container_for_dc').hide();
                $('.father_death_proof_item_container_for_dc').show();
                $('.is_father_alive_container_for_dc').hide();
            }

            if (formData.mother_alive == VALUE_ONE) {
                $('.mother_proof_item_container_for_dc').show();
                $('.mother_death_proof_item_container_for_dc').hide();
                $('.is_mother_alive_container_for_dc').show();
            } else if (formData.mother_alive == VALUE_TWO) {
                $('.mother_proof_item_container_for_dc').hide();
                $('.mother_death_proof_item_container_for_dc').show();
                $('.is_mother_alive_container_for_dc').hide();
            }

            if (formData.spouse_alive == VALUE_ONE) {
                $('.spouse_proof_item_container_for_dc').show();
                $('.spouse_death_proof_item_container_for_dc').hide();
                $('.is_spouse_alive_container_for_dc').show();
            } else if (formData.spouse_alive == VALUE_TWO) {
                $('.spouse_proof_item_container_for_dc').hide();
                $('.spouse_death_proof_item_container_for_dc').show();
                $('.is_spouse_alive_container_for_dc').hide();
            }

            // $(".spouse_item_container_for_dc :input").prop('disabled', true);
            if (formData.marital_status == VALUE_ONE)
                $('#spouse_alive_for_dc_1').prop('checked', true);
            else if (formData.marital_status == VALUE_THREE)
                $('#spouse_alive_for_dc_2').prop('checked', true);
            if (formData.gender == VALUE_TWO && (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE)) {
                $('.father_proof_file_container_for_dc').hide();
                $('.mother_proof_file_container_for_dc').hide();
            }

            var words = formData.residing_year.split(' ');
            residing_year = (words[0]);
            residing_month = (words[2]);
            residing_days = (words[4]);
            $('#residing_year_for_dc').val(residing_year);
            $('#residing_month_for_dc').val(residing_month);
            $('#residing_days_for_dc').val(residing_days);
            if (formData.applicant_photo != '') {
                that.showDocument('applicant_photo_container_for_domicile', 'applicant_photo_name_image_for_domicile', 'applicant_photo_name_container_for_domicile',
                        'applicant_photo_download', 'applicant_photo', formData.applicant_photo, formData.domicile_certificate_id, VALUE_ONE);
            }

            if (formData.birth_certi != '') {
                that.showDocument('birth_certi_container_for_domicile', 'birth_certi_name_image_for_domicile', 'birth_certi_name_container_for_domicile',
                        'birth_certi_download', 'birth_certi', formData.birth_certi, formData.domicile_certificate_id, VALUE_TWO);
            }

            if (formData.election_card != '') {
                that.showDocument('election_card_container_for_domicile', 'election_card_name_image_for_domicile', 'election_card_name_container_for_domicile',
                        'election_card_download', 'election_card', formData.election_card, formData.domicile_certificate_id, VALUE_THREE);
            }
            if (formData.aadhaar_card != '') {
                that.showDocument('aadhaar_card_container_for_domicile', 'aadhaar_card_name_image_for_domicile', 'aadhaar_card_name_container_for_domicile',
                        'aadhaar_card_download', 'aadhaar_card', formData.aadhaar_card, formData.domicile_certificate_id, VALUE_FOUR);
            }
            if (formData.father_birth_certificate != '') {
                that.showDocument('father_birth_certificate_container_for_dc', 'father_birth_certificate_name_image_for_domicile', 'father_birth_certificate_name_container_for_domicile',
                        'father_birth_certificate_download', 'father_birth_certificate', formData.father_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYTHREE);
            }
            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_dc', 'father_election_card_name_image_for_domicile', 'father_election_card_name_container_for_domicile',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.domicile_certificate_id, VALUE_TWENTYFOUR);
            }
            if (formData.father_aadhar_card != '') {
                that.showDocument('father_aadhar_card_container_for_dc', 'father_aadhar_card_name_image_for_domicile', 'father_aadhar_card_name_container_for_domicile',
                        'father_aadhar_card_download', 'father_aadhar_card', formData.father_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYFIVE);
            }
            if (formData.father_death_proof != '') {
                that.showDocument('father_death_proof_container_for_dc', 'father_death_proof_name_image_for_domicile', 'father_death_proof_name_container_for_domicile',
                        'father_death_proof_download', 'father_death_proof', formData.father_death_proof, formData.domicile_certificate_id, VALUE_TWENTYSIX);
            }


            if (formData.mother_birth_certificate != '') {
                that.showDocument('mother_birth_certificate_container_for_dc', 'mother_birth_certificate_name_image_for_domicile', 'mother_birth_certificate_name_container_for_domicile',
                        'mother_birth_certificate_download', 'mother_birth_certificate', formData.mother_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYSEVEN);
            }
            if (formData.mother_election_card != '') {
                that.showDocument('mother_election_card_container_for_dc', 'mother_election_card_name_image_for_domicile', 'mother_election_card_name_container_for_domicile',
                        'mother_election_card_download', 'mother_election_card', formData.mother_election_card, formData.domicile_certificate_id, VALUE_TWENTYEIGHT);
            }
            if (formData.mother_aadhar_card != '') {
                that.showDocument('mother_aadhar_card_container_for_dc', 'mother_aadhar_card_name_image_for_domicile', 'mother_aadhar_card_name_container_for_domicile',
                        'mother_aadhar_card_download', 'mother_aadhar_card', formData.mother_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYNINE);
            }
            if (formData.mother_death_proof != '') {
                that.showDocument('mother_death_proof_container_for_dc', 'mother_death_proof_name_image_for_domicile', 'mother_death_proof_name_container_for_domicile',
                        'mother_death_proof_download', 'mother_death_proof', formData.mother_death_proof, formData.domicile_certificate_id, VALUE_THIRTY);
            }
            if (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE) {
                // if (formData.spouse_proof != '') {
                //     that.showDocument('spouse_proof_container_for_dc', 'spouse_proof_name_image_for_domicile', 'spouse_proof_name_container_for_domicile',
                //             'spouse_proof_download', 'spouse_proof', formData.spouse_proof, formData.domicile_certificate_id, VALUE_SEVENTEEN);
                // }
                if (formData.spouse_birth_certificate != '') {
                    that.showDocument('spouse_birth_certificate_container_for_dc', 'spouse_birth_certificate_name_image_for_domicile', 'spouse_birth_certificate_name_container_for_domicile',
                            'spouse_birth_certificate_download', 'spouse_birth_certificate', formData.spouse_birth_certificate, formData.domicile_certificate_id, VALUE_THIRTYONE);
                }
                if (formData.spouse_election_card != '') {
                    that.showDocument('spouse_election_card_container_for_dc', 'spouse_election_card_name_image_for_domicile', 'spouse_election_card_name_container_for_domicile',
                            'spouse_election_card_download', 'spouse_election_card', formData.spouse_election_card, formData.domicile_certificate_id, VALUE_THIRTYTWO);
                }
                if (formData.spouse_aadhar_card != '') {
                    that.showDocument('spouse_aadhar_card_container_for_dc', 'spouse_aadhar_card_name_image_for_domicile', 'spouse_aadhar_card_name_container_for_domicile',
                            'spouse_aadhar_card_download', 'spouse_aadhar_card', formData.spouse_aadhar_card, formData.domicile_certificate_id, VALUE_THIRTYTHREE);
                }
                if (formData.spouse_death_proof != '') {
                    that.showDocument('spouse_death_proof_container_for_dc', 'spouse_death_proof_name_image_for_domicile', 'spouse_death_proof_name_container_for_domicile',
                            'spouse_death_proof_download', 'spouse_death_proof', formData.spouse_death_proof, formData.domicile_certificate_id, VALUE_THIRTYFOUR);
                }
            }
            if (formData.other_document != '') {
                that.showDocument('other_document_container_for_domicile', 'other_document_name_image_for_domicile', 'other_document_name_container_for_domicile',
                        'other_document_download', 'other_document', formData.other_document, formData.domicile_certificate_id, VALUE_SIXTEEN);
            }

        } else {
            $('#father_alive_for_dc_1').prop('checked', true);
            $('#mother_alive_for_dc_1').prop('checked', true);
            $('#spouse_alive_for_dc_1').prop('checked', true);
        }


        generateSelect2();
        datePicker();
        datePickerSixty('applicant_dob_for_dc');
        allowOnlyIntegerValue('residing_year_for_dc');
        allowOnlyIntegerValue('residing_month_for_dc');
        allowOnlyIntegerValue('residing_days_for_dc');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_dc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
        }

        $('#domicile_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDomicile($('#submit_btn_for_domicile'));
            }
        });
    },
    typeTwoADomicileForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.domicile_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            Domicile.router.navigate('edit_type_two_a_domicile_form');
        } else {
            var formData = {};
            Domicile.router.navigate('type_two_a_domicile_form');
        }

        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_FIVE = VALUE_FIVE;
        templateData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        templateData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        templateData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        templateData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.domicile_data = parseData.domicile_data;
        if (isEdit) {
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
        }
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        $('#domicile_form_and_datatable_container').html(typeTwoADomicileFormTemplate(templateData));

        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_dc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_dc');
        generateBoxes('radio', genderArray, 'gender', 'dc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'dc', formData.marital_status, false, false);

        var $select = $(".year");
        for (i = 0; i <= 99; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var $select = $(".month");
        for (i = 1; i <= 12; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var $select = $(".days");
        for (i = 0; i <= 31; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(educationTypeArray, 'applicant_education_for_dc');
        generateBoxes('radio', yesNoArray, 'father_alive', 'dc', formData.father_alive, false, false);
        showSubContainer('father_alive', 'dc', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'dc', '.father_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('father_alive', 'dc', '.is_father_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'dc', formData.mother_alive, false, false);
        showSubContainer('mother_alive', 'dc', '.mother_proof_item', VALUE_ONE, 'radio');
        showSubContainer('mother_alive', 'dc', '.mother_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('mother_alive', 'dc', '.is_mother_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'dc', formData.spouse_alive, false, false);
        showSubContainer('spouse_alive', 'dc', '.spouse_proof_item', VALUE_ONE, 'radio');
        showSubContainer('spouse_alive', 'dc', '.spouse_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('spouse_alive', 'dc', '.is_spouse_alive', VALUE_ONE, 'radio');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        if (isEdit) {
            that.getFatherMotherSpouseData(fatherDetails, motherDetails, spouseDetails, formData);

            if (formData.applicant_photo != '') {
                that.showDocument('applicant_photo_container_for_domicile', 'applicant_photo_name_image_for_domicile', 'applicant_photo_name_container_for_domicile',
                        'applicant_photo_download', 'applicant_photo', formData.applicant_photo, formData.domicile_certificate_id, VALUE_ONE);
            }

            if (formData.birth_certi != '') {
                that.showDocument('birth_certi_container_for_domicile', 'birth_certi_name_image_for_domicile', 'birth_certi_name_container_for_domicile',
                        'birth_certi_download', 'birth_certi', formData.birth_certi, formData.domicile_certificate_id, VALUE_TWO);
            }

            if (formData.election_card != '') {
                that.showDocument('election_card_container_for_domicile', 'election_card_name_image_for_domicile', 'election_card_name_container_for_domicile',
                        'election_card_download', 'election_card', formData.election_card, formData.domicile_certificate_id, VALUE_THREE);
            }
            if (formData.aadhaar_card != '') {
                that.showDocument('aadhaar_card_container_for_domicile', 'aadhaar_card_name_image_for_domicile', 'aadhaar_card_name_container_for_domicile',
                        'aadhaar_card_download', 'aadhaar_card', formData.aadhaar_card, formData.domicile_certificate_id, VALUE_FOUR);
            }
            if (formData.leaving_certi != '') {
                that.showDocument('leaving_certi_container_for_domicile', 'leaving_certi_name_image_for_domicile', 'leaving_certi_name_container_for_domicile',
                        'leaving_certi_download', 'leaving_certi', formData.leaving_certi, formData.domicile_certificate_id, VALUE_FIVE);
            }
            if (formData.father_birth_certificate != '') {
                that.showDocument('father_birth_certificate_container_for_dc', 'father_birth_certificate_name_image_for_domicile', 'father_birth_certificate_name_container_for_domicile',
                        'father_birth_certificate_download', 'father_birth_certificate', formData.father_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYTHREE);
            }
            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_dc', 'father_election_card_name_image_for_domicile', 'father_election_card_name_container_for_domicile',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.domicile_certificate_id, VALUE_TWENTYFOUR);
            }
            if (formData.father_aadhar_card != '') {
                that.showDocument('father_aadhar_card_container_for_dc', 'father_aadhar_card_name_image_for_domicile', 'father_aadhar_card_name_container_for_domicile',
                        'father_aadhar_card_download', 'father_aadhar_card', formData.father_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYFIVE);
            }
            if (formData.father_death_proof != '') {
                that.showDocument('father_death_proof_container_for_dc', 'father_death_proof_name_image_for_domicile', 'father_death_proof_name_container_for_domicile',
                        'father_death_proof_download', 'father_death_proof', formData.father_death_proof, formData.domicile_certificate_id, VALUE_TWENTYSIX);
            }


            if (formData.mother_birth_certificate != '') {
                that.showDocument('mother_birth_certificate_container_for_dc', 'mother_birth_certificate_name_image_for_domicile', 'mother_birth_certificate_name_container_for_domicile',
                        'mother_birth_certificate_download', 'mother_birth_certificate', formData.mother_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYSEVEN);
            }
            if (formData.mother_election_card != '') {
                that.showDocument('mother_election_card_container_for_dc', 'mother_election_card_name_image_for_domicile', 'mother_election_card_name_container_for_domicile',
                        'mother_election_card_download', 'mother_election_card', formData.mother_election_card, formData.domicile_certificate_id, VALUE_TWENTYEIGHT);
            }
            if (formData.mother_aadhar_card != '') {
                that.showDocument('mother_aadhar_card_container_for_dc', 'mother_aadhar_card_name_image_for_domicile', 'mother_aadhar_card_name_container_for_domicile',
                        'mother_aadhar_card_download', 'mother_aadhar_card', formData.mother_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYNINE);
            }
            if (formData.mother_death_proof != '') {
                that.showDocument('mother_death_proof_container_for_dc', 'mother_death_proof_name_image_for_domicile', 'mother_death_proof_name_container_for_domicile',
                        'mother_death_proof_download', 'mother_death_proof', formData.mother_death_proof, formData.domicile_certificate_id, VALUE_THIRTY);
            }
            if (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE) {
                // if (formData.spouse_proof != '') {
                //     that.showDocument('spouse_proof_container_for_dc', 'spouse_proof_name_image_for_domicile', 'spouse_proof_name_container_for_domicile',
                //             'spouse_proof_download', 'spouse_proof', formData.spouse_proof, formData.domicile_certificate_id, VALUE_SEVENTEEN);
                // }
                if (formData.spouse_birth_certificate != '') {
                    that.showDocument('spouse_birth_certificate_container_for_dc', 'spouse_birth_certificate_name_image_for_domicile', 'spouse_birth_certificate_name_container_for_domicile',
                            'spouse_birth_certificate_download', 'spouse_birth_certificate', formData.spouse_birth_certificate, formData.domicile_certificate_id, VALUE_THIRTYONE);
                }
                if (formData.spouse_election_card != '') {
                    that.showDocument('spouse_election_card_container_for_dc', 'spouse_election_card_name_image_for_domicile', 'spouse_election_card_name_container_for_domicile',
                            'spouse_election_card_download', 'spouse_election_card', formData.spouse_election_card, formData.domicile_certificate_id, VALUE_THIRTYTWO);
                }
                if (formData.spouse_aadhar_card != '') {
                    that.showDocument('spouse_aadhar_card_container_for_dc', 'spouse_aadhar_card_name_image_for_domicile', 'spouse_aadhar_card_name_container_for_domicile',
                            'spouse_aadhar_card_download', 'spouse_aadhar_card', formData.spouse_aadhar_card, formData.domicile_certificate_id, VALUE_THIRTYTHREE);
                }
                if (formData.spouse_death_proof != '') {
                    that.showDocument('spouse_death_proof_container_for_dc', 'spouse_death_proof_name_image_for_domicile', 'spouse_death_proof_name_container_for_domicile',
                            'spouse_death_proof_download', 'spouse_death_proof', formData.spouse_death_proof, formData.domicile_certificate_id, VALUE_THIRTYFOUR);
                }
            }
            if (formData.other_document != '') {
                that.showDocument('other_document_container_for_domicile', 'other_document_name_image_for_domicile', 'other_document_name_container_for_domicile',
                        'other_document_download', 'other_document', formData.other_document, formData.domicile_certificate_id, VALUE_SIXTEEN);
            }
        } else {
            $('#father_alive_for_dc_1').prop('checked', true);
            $('#mother_alive_for_dc_1').prop('checked', true);
            $('#spouse_alive_for_dc_1').prop('checked', true);
        }

        generateSelect2();
        datePicker();
        datePickerEigSix('applicant_dob_for_dc');
        allowOnlyIntegerValue('residing_year_for_dc');
        allowOnlyIntegerValue('residing_month_for_dc');
        allowOnlyIntegerValue('residing_days_for_dc');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_dc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
        }

        $('#domicile_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDomicile($('#submit_btn_for_domicile'));
            }
        });
    },
    typeTwoBDomicileForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.domicile_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            Domicile.router.navigate('edit_domicile_form');
        } else {
            var formData = {};
            Domicile.router.navigate('type_two_b_domicile_form');
        }

        var templateData = {};
        var that = this;
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_FIVE = VALUE_FIVE;
        templateData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        templateData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        templateData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        templateData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.domicile_data = parseData.domicile_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
        }
        $('#domicile_form_and_datatable_container').html(typeTwoBDomicileFormTemplate(templateData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_dc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_dc');
        generateBoxes('radio', genderArray, 'gender', 'dc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'dc', formData.marital_status, false, false);

        var $select = $(".year");
        for (i = 0; i <= 99; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var $select = $(".month");
        for (i = 1; i <= 12; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var $select = $(".days");
        for (i = 0; i <= 31; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(educationTypeArray, 'applicant_education_for_dc');
        generateBoxes('radio', yesNoArray, 'father_alive', 'dc', formData.father_alive, false, false);
        showSubContainer('father_alive', 'dc', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'dc', '.father_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('father_alive', 'dc', '.is_father_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'dc', formData.mother_alive, false, false);
        showSubContainer('mother_alive', 'dc', '.mother_proof_item', VALUE_ONE, 'radio');
        showSubContainer('mother_alive', 'dc', '.mother_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('mother_alive', 'dc', '.is_mother_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'dc', formData.spouse_alive, false, false);
        showSubContainer('spouse_alive', 'dc', '.spouse_proof_item', VALUE_ONE, 'radio');
        showSubContainer('spouse_alive', 'dc', '.spouse_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('spouse_alive', 'dc', '.is_spouse_alive', VALUE_ONE, 'radio');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        if (isEdit) {
            that.getFatherMotherSpouseData(fatherDetails, motherDetails, spouseDetails, formData);

            if (formData.applicant_photo != '') {
                that.showDocument('applicant_photo_container_for_domicile', 'applicant_photo_name_image_for_domicile', 'applicant_photo_name_container_for_domicile',
                        'applicant_photo_download', 'applicant_photo', formData.applicant_photo, formData.domicile_certificate_id, VALUE_ONE);
            }

            if (formData.birth_certi != '') {
                that.showDocument('birth_certi_container_for_domicile', 'birth_certi_name_image_for_domicile', 'birth_certi_name_container_for_domicile',
                        'birth_certi_download', 'birth_certi', formData.birth_certi, formData.domicile_certificate_id, VALUE_TWO);
            }

            if (formData.election_card != '') {
                that.showDocument('election_card_container_for_domicile', 'election_card_name_image_for_domicile', 'election_card_name_container_for_domicile',
                        'election_card_download', 'election_card', formData.election_card, formData.domicile_certificate_id, VALUE_THREE);
            }
            if (formData.aadhaar_card != '') {
                that.showDocument('aadhaar_card_container_for_domicile', 'aadhaar_card_name_image_for_domicile', 'aadhaar_card_name_container_for_domicile',
                        'aadhaar_card_download', 'aadhaar_card', formData.aadhaar_card, formData.domicile_certificate_id, VALUE_FOUR);
            }
            if (formData.leaving_certi != '') {
                that.showDocument('leaving_certi_container_for_domicile', 'leaving_certi_name_image_for_domicile', 'leaving_certi_name_container_for_domicile',
                        'leaving_certi_download', 'leaving_certi', formData.leaving_certi, formData.domicile_certificate_id, VALUE_FIVE);
            }
            if (formData.father_birth_certificate != '') {
                that.showDocument('father_birth_certificate_container_for_dc', 'father_birth_certificate_name_image_for_domicile', 'father_birth_certificate_name_container_for_domicile',
                        'father_birth_certificate_download', 'father_birth_certificate', formData.father_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYTHREE);
            }
            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_dc', 'father_election_card_name_image_for_domicile', 'father_election_card_name_container_for_domicile',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.domicile_certificate_id, VALUE_TWENTYFOUR);
            }
            if (formData.father_aadhar_card != '') {
                that.showDocument('father_aadhar_card_container_for_dc', 'father_aadhar_card_name_image_for_domicile', 'father_aadhar_card_name_container_for_domicile',
                        'father_aadhar_card_download', 'father_aadhar_card', formData.father_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYFIVE);
            }
            if (formData.father_death_proof != '') {
                that.showDocument('father_death_proof_container_for_dc', 'father_death_proof_name_image_for_domicile', 'father_death_proof_name_container_for_domicile',
                        'father_death_proof_download', 'father_death_proof', formData.father_death_proof, formData.domicile_certificate_id, VALUE_TWENTYSIX);
            }


            if (formData.mother_birth_certificate != '') {
                that.showDocument('mother_birth_certificate_container_for_dc', 'mother_birth_certificate_name_image_for_domicile', 'mother_birth_certificate_name_container_for_domicile',
                        'mother_birth_certificate_download', 'mother_birth_certificate', formData.mother_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYSEVEN);
            }
            if (formData.mother_election_card != '') {
                that.showDocument('mother_election_card_container_for_dc', 'mother_election_card_name_image_for_domicile', 'mother_election_card_name_container_for_domicile',
                        'mother_election_card_download', 'mother_election_card', formData.mother_election_card, formData.domicile_certificate_id, VALUE_TWENTYEIGHT);
            }
            if (formData.mother_aadhar_card != '') {
                that.showDocument('mother_aadhar_card_container_for_dc', 'mother_aadhar_card_name_image_for_domicile', 'mother_aadhar_card_name_container_for_domicile',
                        'mother_aadhar_card_download', 'mother_aadhar_card', formData.mother_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYNINE);
            }
            if (formData.mother_death_proof != '') {
                that.showDocument('mother_death_proof_container_for_dc', 'mother_death_proof_name_image_for_domicile', 'mother_death_proof_name_container_for_domicile',
                        'mother_death_proof_download', 'mother_death_proof', formData.mother_death_proof, formData.domicile_certificate_id, VALUE_THIRTY);
            }
            if (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE) {
                // if (formData.spouse_proof != '') {
                //     that.showDocument('spouse_proof_container_for_dc', 'spouse_proof_name_image_for_domicile', 'spouse_proof_name_container_for_domicile',
                //             'spouse_proof_download', 'spouse_proof', formData.spouse_proof, formData.domicile_certificate_id, VALUE_SEVENTEEN);
                // }
                if (formData.spouse_birth_certificate != '') {
                    that.showDocument('spouse_birth_certificate_container_for_dc', 'spouse_birth_certificate_name_image_for_domicile', 'spouse_birth_certificate_name_container_for_domicile',
                            'spouse_birth_certificate_download', 'spouse_birth_certificate', formData.spouse_birth_certificate, formData.domicile_certificate_id, VALUE_THIRTYONE);
                }
                if (formData.spouse_election_card != '') {
                    that.showDocument('spouse_election_card_container_for_dc', 'spouse_election_card_name_image_for_domicile', 'spouse_election_card_name_container_for_domicile',
                            'spouse_election_card_download', 'spouse_election_card', formData.spouse_election_card, formData.domicile_certificate_id, VALUE_THIRTYTWO);
                }
                if (formData.spouse_aadhar_card != '') {
                    that.showDocument('spouse_aadhar_card_container_for_dc', 'spouse_aadhar_card_name_image_for_domicile', 'spouse_aadhar_card_name_container_for_domicile',
                            'spouse_aadhar_card_download', 'spouse_aadhar_card', formData.spouse_aadhar_card, formData.domicile_certificate_id, VALUE_THIRTYTHREE);
                }
                if (formData.spouse_death_proof != '') {
                    that.showDocument('spouse_death_proof_container_for_dc', 'spouse_death_proof_name_image_for_domicile', 'spouse_death_proof_name_container_for_domicile',
                            'spouse_death_proof_download', 'spouse_death_proof', formData.spouse_death_proof, formData.domicile_certificate_id, VALUE_THIRTYFOUR);
                }
            }
            if (formData.other_document != '') {
                that.showDocument('other_document_container_for_domicile', 'other_document_name_image_for_domicile', 'other_document_name_container_for_domicile',
                        'other_document_download', 'other_document', formData.other_document, formData.domicile_certificate_id, VALUE_SIXTEEN);
            }
        } else {
            $('#father_alive_for_dc_1').prop('checked', true);
            $('#mother_alive_for_dc_1').prop('checked', true);
            $('#spouse_alive_for_dc_1').prop('checked', true);
        }

        generateSelect2();
        datePicker();
        datePickerEigSix('applicant_dob_for_dc');
        allowOnlyIntegerValue('residing_year_for_dc');
        allowOnlyIntegerValue('residing_month_for_dc');
        allowOnlyIntegerValue('residing_days_for_dc');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_dc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
        }

        $('#domicile_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDomicile($('#submit_btn_for_domicile'));
            }
        });
    },
    typeTwoCDomicileForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.domicile_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            Domicile.router.navigate('edit_domicile_form');
        } else {
            var formData = {};
            Domicile.router.navigate('type_two_c_domicile_form');
        }

        var templateData = {};
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_FIVE = VALUE_FIVE;
        templateData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        templateData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        templateData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        templateData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        templateData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.domicile_data = parseData.domicile_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
        }
        $('#domicile_form_and_datatable_container').html(typeTwoCDomicileFormTemplate(templateData));

        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_dc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_dc');
        generateBoxes('radio', genderArray, 'gender', 'dc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'dc', formData.marital_status, false, false);

        var $select = $(".year");
        for (i = 0; i <= 99; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var $select = $(".month");
        for (i = 1; i <= 12; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var $select = $(".days");
        for (i = 0; i <= 31; i++) {
            $select.append($('<option></option>').val(i).html(i))
        }

        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(educationTypeArray, 'applicant_education_for_dc');
        generateBoxes('radio', yesNoArray, 'father_alive', 'dc', formData.father_alive, false, false);
        showSubContainer('father_alive', 'dc', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'dc', '.father_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('father_alive', 'dc', '.is_father_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'dc', formData.mother_alive, false, false);
        showSubContainer('mother_alive', 'dc', '.mother_proof_item', VALUE_ONE, 'radio');
        showSubContainer('mother_alive', 'dc', '.mother_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('mother_alive', 'dc', '.is_mother_alive', VALUE_ONE, 'radio');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'native_place_state_for_dc');
        //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArray(stateArray, 'father_native_place_state_for_dc');
        //renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        if (isEdit) {

            that.getFatherMotherSpouseData(fatherDetails, motherDetails, spouseDetails, formData);

            if (formData.applicant_photo != '') {
                that.showDocument('applicant_photo_container_for_domicile', 'applicant_photo_name_image_for_domicile', 'applicant_photo_name_container_for_domicile',
                        'applicant_photo_download', 'applicant_photo', formData.applicant_photo, formData.domicile_certificate_id, VALUE_ONE);
            }

            if (formData.minor_child_photo != '') {
                that.showDocument('minor_child_photo_container_for_domicile', 'minor_child_photo_name_image_for_domicile', 'minor_child_photo_name_container_for_domicile',
                        'minor_child_photo_download', 'minor_child_photo', formData.minor_child_photo, formData.domicile_certificate_id, VALUE_THIRTEEN);
            }

            if (formData.birth_certi != '') {
                that.showDocument('birth_certi_container_for_domicile', 'birth_certi_name_image_for_domicile', 'birth_certi_name_container_for_domicile',
                        'birth_certi_download', 'birth_certi', formData.birth_certi, formData.domicile_certificate_id, VALUE_TWO);
            }

            if (formData.election_card != '') {
                that.showDocument('election_card_container_for_domicile', 'election_card_name_image_for_domicile', 'election_card_name_container_for_domicile',
                        'election_card_download', 'election_card', formData.election_card, formData.domicile_certificate_id, VALUE_THREE);
            }
            if (formData.aadhaar_card != '') {
                that.showDocument('aadhaar_card_container_for_domicile', 'aadhaar_card_name_image_for_domicile', 'aadhaar_card_name_container_for_domicile',
                        'aadhaar_card_download', 'aadhaar_card', formData.aadhaar_card, formData.domicile_certificate_id, VALUE_FOUR);
            }
            if (formData.leaving_certi != '') {
                that.showDocument('leaving_certi_container_for_domicile', 'leaving_certi_name_image_for_domicile', 'leaving_certi_name_container_for_domicile',
                        'leaving_certi_download', 'leaving_certi', formData.leaving_certi, formData.domicile_certificate_id, VALUE_FIVE);
            }
            if (formData.father_birth_certificate != '') {
                that.showDocument('father_birth_certificate_container_for_dc', 'father_birth_certificate_name_image_for_domicile', 'father_birth_certificate_name_container_for_domicile',
                        'father_birth_certificate_download', 'father_birth_certificate', formData.father_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYTHREE);
            }
            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_dc', 'father_election_card_name_image_for_domicile', 'father_election_card_name_container_for_domicile',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.domicile_certificate_id, VALUE_TWENTYFOUR);
            }
            if (formData.father_aadhar_card != '') {
                that.showDocument('father_aadhar_card_container_for_dc', 'father_aadhar_card_name_image_for_domicile', 'father_aadhar_card_name_container_for_domicile',
                        'father_aadhar_card_download', 'father_aadhar_card', formData.father_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYFIVE);
            }
            if (formData.father_death_proof != '') {
                that.showDocument('father_death_proof_container_for_dc', 'father_death_proof_name_image_for_domicile', 'father_death_proof_name_container_for_domicile',
                        'father_death_proof_download', 'father_death_proof', formData.father_death_proof, formData.domicile_certificate_id, VALUE_TWENTYSIX);
            }


            if (formData.mother_birth_certificate != '') {
                that.showDocument('mother_birth_certificate_container_for_dc', 'mother_birth_certificate_name_image_for_domicile', 'mother_birth_certificate_name_container_for_domicile',
                        'mother_birth_certificate_download', 'mother_birth_certificate', formData.mother_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYSEVEN);
            }
            if (formData.mother_election_card != '') {
                that.showDocument('mother_election_card_container_for_dc', 'mother_election_card_name_image_for_domicile', 'mother_election_card_name_container_for_domicile',
                        'mother_election_card_download', 'mother_election_card', formData.mother_election_card, formData.domicile_certificate_id, VALUE_TWENTYEIGHT);
            }
            if (formData.mother_aadhar_card != '') {
                that.showDocument('mother_aadhar_card_container_for_dc', 'mother_aadhar_card_name_image_for_domicile', 'mother_aadhar_card_name_container_for_domicile',
                        'mother_aadhar_card_download', 'mother_aadhar_card', formData.mother_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYNINE);
            }
            if (formData.mother_death_proof != '') {
                that.showDocument('mother_death_proof_container_for_dc', 'mother_death_proof_name_image_for_domicile', 'mother_death_proof_name_container_for_domicile',
                        'mother_death_proof_download', 'mother_death_proof', formData.mother_death_proof, formData.domicile_certificate_id, VALUE_THIRTY);
            }
            if (formData.other_document != '') {
                that.showDocument('other_document_container_for_domicile', 'other_document_name_image_for_domicile', 'other_document_name_container_for_domicile',
                        'other_document_download', 'other_document', formData.other_document, formData.domicile_certificate_id, VALUE_SIXTEEN);
            }
        } else {
            $('#father_alive_for_dc_1').prop('checked', true);
            $('#mother_alive_for_dc_1').prop('checked', true);
            $('#spouse_alive_for_dc_1').prop('checked', true);
        }

        generateSelect2();
        datePicker();
        datePickerMinor('applicant_dob_for_dc');
        allowOnlyIntegerValue('residing_year_for_dc');
        allowOnlyIntegerValue('residing_month_for_dc');
        allowOnlyIntegerValue('residing_days_for_dc');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_dc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
        }

        $('#domicile_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDomicile($('#submit_btn_for_domicile'));
            }
        });
    },
    typeThreeADomicileForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.domicile_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            Domicile.router.navigate('edit_domicile_form');
        } else {
            var formData = {};
            Domicile.router.navigate('type_three_a_domicile_form');
        }

        var templateData = {};
        tempEducationDetailCnt = 1;
        tempResidentialDetailCnt = 1;
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_SEVEN = VALUE_SEVEN;
        templateData.VALUE_EIGHT = VALUE_EIGHT;
        templateData.VALUE_NINE = VALUE_NINE;
        templateData.VALUE_TEN = VALUE_TEN;
        templateData.VALUE_ELEVEN = VALUE_ELEVEN;
        templateData.VALUE_TWELVE = VALUE_TWELVE;
        templateData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        templateData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        templateData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        templateData.VALUE_EIGHTEEN = VALUE_EIGHTEEN;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.domicile_data = parseData.domicile_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
        }
        $('#domicile_form_and_datatable_container').html(typeThreeADomicileFormTemplate(templateData));

        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_dc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_dc');
        generateBoxes('radio', genderArray, 'gender', 'dc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'dc', formData.marital_status, false, false);
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'domicile', formData.have_you_own_house, false, false);
        showSubContainer('have_you_own_house', 'domicile', '.house_tax_receipt_item', VALUE_ONE, 'radio');
        showSubContainer('have_you_own_house', 'domicile', '.noc_with_notary_item', VALUE_TWO, 'radio');
        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_dc');
        generateBoxes('radio', yesNoArray, 'father_alive', 'dc', formData.father_alive, false, false);
        showSubContainer('father_alive', 'dc', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'dc', '.father_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('father_alive', 'dc', '.is_father_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'dc', formData.mother_alive, false, false);
        showSubContainer('mother_alive', 'dc', '.mother_proof_item', VALUE_ONE, 'radio');
        showSubContainer('mother_alive', 'dc', '.mother_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('mother_alive', 'dc', '.is_mother_alive', VALUE_ONE, 'radio');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        if (isEdit) {
            that.getFatherMotherSpouseData(fatherDetails, motherDetails, spouseDetails, formData);
            if (formData.applicant_photo != '') {
                that.showDocument('applicant_photo_container_for_domicile', 'applicant_photo_name_image_for_domicile', 'applicant_photo_name_container_for_domicile',
                        'applicant_photo_download', 'applicant_photo', formData.applicant_photo, formData.domicile_certificate_id, VALUE_ONE);
            }

            if (formData.minor_child_photo != '') {
                that.showDocument('minor_child_photo_container_for_domicile', 'minor_child_photo_name_image_for_domicile', 'minor_child_photo_name_container_for_domicile',
                        'minor_child_photo_download', 'minor_child_photo', formData.minor_child_photo, formData.domicile_certificate_id, VALUE_THIRTEEN);
            }

            if (formData.birth_certi != '') {
                that.showDocument('birth_certi_container_for_domicile', 'birth_certi_name_image_for_domicile', 'birth_certi_name_container_for_domicile',
                        'birth_certi_download', 'birth_certi', formData.birth_certi, formData.domicile_certificate_id, VALUE_TWO);
            }

            // if (formData.election_card != '') {
            //     that.showDocument('election_card_container_for_domicile', 'election_card_name_image_for_domicile', 'election_card_name_container_for_domicile',
            //             'election_card_download', 'election_card', formData.election_card, formData.domicile_certificate_id, VALUE_THREE);
            // }
            if (formData.aadhaar_card != '') {
                that.showDocument('aadhaar_card_container_for_domicile', 'aadhaar_card_name_image_for_domicile', 'aadhaar_card_name_container_for_domicile',
                        'aadhaar_card_download', 'aadhaar_card', formData.aadhaar_card, formData.domicile_certificate_id, VALUE_FOUR);
            }
            if (formData.leaving_certi != '') {
                that.showDocument('leaving_certi_container_for_domicile', 'leaving_certi_name_image_for_domicile', 'leaving_certi_name_container_for_domicile',
                        'leaving_certi_download', 'leaving_certi', formData.leaving_certi, formData.domicile_certificate_id, VALUE_EIGHTEEN);
            }
            if (formData.last_10year_proof != '') {
                that.showDocument('last_10year_proof_container_for_domicile', 'last_10year_proof_name_image_for_domicile', 'last_10year_proof_name_container_for_domicile',
                        'last_10year_proof_download', 'last_10year_proof', formData.last_10year_proof, formData.domicile_certificate_id, VALUE_SEVEN);
            }
            if (formData.gas_book != '') {
                that.showDocument('gas_book_container_for_domicile', 'gas_book_name_image_for_domicile', 'gas_book_name_container_for_domicile',
                        'gas_book_download', 'gas_book', formData.gas_book, formData.domicile_certificate_id, VALUE_NINE);
            }
            if (formData.bank_book != '') {
                that.showDocument('bank_book_container_for_domicile', 'bank_book_name_image_for_domicile', 'bank_book_name_container_for_domicile',
                        'bank_book_download', 'bank_book', formData.bank_book, formData.domicile_certificate_id, VALUE_TEN);
            }
            if (formData.house_tax_receipt != '') {
                that.showDocument('house_tax_receipt_container_for_domicile', 'house_tax_receipt_name_image_for_domicile', 'house_tax_receipt_name_container_for_domicile',
                        'house_tax_receipt_download', 'house_tax_receipt', formData.house_tax_receipt, formData.domicile_certificate_id, VALUE_ELEVEN);
            }
            if (formData.sale_deed_copy != '') {
                that.showDocument('sale_deed_copy_container_for_domicile', 'sale_deed_copy_name_image_for_domicile', 'sale_deed_copy_name_container_for_domicile',
                        'sale_deed_copy_download', 'sale_deed_copy', formData.sale_deed_copy, formData.domicile_certificate_id, VALUE_NINETEEN);
            }
            if (formData.noc_with_notary != '') {
                that.showDocument('noc_with_notary_container_for_domicile', 'noc_with_notary_name_image_for_domicile', 'noc_with_notary_name_container_for_domicile',
                        'noc_with_notary_download', 'noc_with_notary', formData.noc_with_notary, formData.domicile_certificate_id, VALUE_TWELVE);
            }
            if (formData.aggriment_with_notary != '') {
                that.showDocument('aggriment_with_notary_container_for_domicile', 'aggriment_with_notary_name_image_for_domicile', 'aggriment_with_notary_name_container_for_domicile',
                        'aggriment_with_notary_download', 'aggriment_with_notary', formData.aggriment_with_notary, formData.domicile_certificate_id, VALUE_TWENTY);
            }
            if (formData.father_birth_certificate != '') {
                that.showDocument('father_birth_certificate_container_for_dc', 'father_birth_certificate_name_image_for_domicile', 'father_birth_certificate_name_container_for_domicile',
                        'father_birth_certificate_download', 'father_birth_certificate', formData.father_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYTHREE);
            }
            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_dc', 'father_election_card_name_image_for_domicile', 'father_election_card_name_container_for_domicile',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.domicile_certificate_id, VALUE_TWENTYFOUR);
            }
            if (formData.father_aadhar_card != '') {
                that.showDocument('father_aadhar_card_container_for_dc', 'father_aadhar_card_name_image_for_domicile', 'father_aadhar_card_name_container_for_domicile',
                        'father_aadhar_card_download', 'father_aadhar_card', formData.father_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYFIVE);
            }
            if (formData.father_death_proof != '') {
                that.showDocument('father_death_proof_container_for_dc', 'father_death_proof_name_image_for_domicile', 'father_death_proof_name_container_for_domicile',
                        'father_death_proof_download', 'father_death_proof', formData.father_death_proof, formData.domicile_certificate_id, VALUE_TWENTYSIX);
            }


            if (formData.mother_birth_certificate != '') {
                that.showDocument('mother_birth_certificate_container_for_dc', 'mother_birth_certificate_name_image_for_domicile', 'mother_birth_certificate_name_container_for_domicile',
                        'mother_birth_certificate_download', 'mother_birth_certificate', formData.mother_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYSEVEN);
            }
            if (formData.mother_election_card != '') {
                that.showDocument('mother_election_card_container_for_dc', 'mother_election_card_name_image_for_domicile', 'mother_election_card_name_container_for_domicile',
                        'mother_election_card_download', 'mother_election_card', formData.mother_election_card, formData.domicile_certificate_id, VALUE_TWENTYEIGHT);
            }
            if (formData.mother_aadhar_card != '') {
                that.showDocument('mother_aadhar_card_container_for_dc', 'mother_aadhar_card_name_image_for_domicile', 'mother_aadhar_card_name_container_for_domicile',
                        'mother_aadhar_card_download', 'mother_aadhar_card', formData.mother_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYNINE);
            }
            if (formData.mother_death_proof != '') {
                that.showDocument('mother_death_proof_container_for_dc', 'mother_death_proof_name_image_for_domicile', 'mother_death_proof_name_container_for_domicile',
                        'mother_death_proof_download', 'mother_death_proof', formData.mother_death_proof, formData.domicile_certificate_id, VALUE_THIRTY);
            }
            if (formData.other_document != '') {
                that.showDocument('other_document_container_for_domicile', 'other_document_name_image_for_domicile', 'other_document_name_container_for_domicile',
                        'other_document_download', 'other_document', formData.other_document, formData.domicile_certificate_id, VALUE_SIXTEEN);
            }
            var cntedu = 1;
            if (formData.applicant_education_details != '') {
                var applicant_education_details = JSON.parse(formData.applicant_education_details);
                $.each(applicant_education_details, function (key, value) {
                    that.addEducationInfo(value, true);
                    cntedu++;
                });
            }

            var cntresi = 1;
            if (formData.residential_details != '') {
                var residential_details = JSON.parse(formData.residential_details);
                $.each(residential_details, function (key, value) {
                    that.addResidentialInfo(value, true);
                    $('#type_of_resident_' + cntresi).val(value.type_of_resident);
                    cntresi++;
                });
            }
        } else {
            that.addEducationInfo({}, true);
            that.addResidentialInfo({}, true);
            $('#father_alive_for_dc_1').prop('checked', true);
            $('#mother_alive_for_dc_1').prop('checked', true);
            $('#spouse_alive_for_dc_1').prop('checked', true);
            $('#have_you_own_house_for_domicile_1').prop('checked', true);
            $('.house_tax_receipt_item_container_for_domicile').show();
        }

        generateSelect2();
        datePicker();
        datePickerToday('applicant_dob_for_dc');
        allowOnlyIntegerValue('residing_year_for_dc');
        allowOnlyIntegerValue('residing_month_for_dc');
        allowOnlyIntegerValue('residing_days_for_dc');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_dc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
        }

        $('#domicile_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDomicile($('#submit_btn_for_domicile'));
            }
        });
    },
    typeThreeBDomicileForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.domicile_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            Domicile.router.navigate('edit_domicile_form');
        } else {
            var formData = {};
            Domicile.router.navigate('type_three_b_domicile_form');
        }

        var templateData = {};
        tempEducationDetailCnt = 1;
        tempResidentialDetailCnt = 1;
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_SEVEN = VALUE_SEVEN;
        templateData.VALUE_NINE = VALUE_NINE;
        templateData.VALUE_TEN = VALUE_TEN;
        templateData.VALUE_ELEVEN = VALUE_ELEVEN;
        templateData.VALUE_TWELVE = VALUE_TWELVE;
        templateData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        templateData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        templateData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        templateData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        templateData.VALUE_EIGHTEEN = VALUE_EIGHTEEN;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.domicile_data = parseData.domicile_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
        }
        $('#domicile_form_and_datatable_container').html(typeThreeBDomicileFormTemplate(templateData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_dc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_dc');
        generateBoxes('radio', genderArray, 'gender', 'dc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'dc', formData.marital_status, false, false);
        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'domicile', formData.have_you_own_house, false, false);
        showSubContainer('have_you_own_house', 'domicile', '.house_tax_receipt_item', VALUE_ONE, 'radio');
        showSubContainer('have_you_own_house', 'domicile', '.noc_with_notary_item', VALUE_TWO, 'radio');
        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_dc');
        generateBoxes('radio', yesNoArray, 'father_alive', 'dc', formData.father_alive, false, false);
        showSubContainer('father_alive', 'dc', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'dc', '.father_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('father_alive', 'dc', '.is_father_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'dc', formData.mother_alive, false, false);
        showSubContainer('mother_alive', 'dc', '.mother_proof_item', VALUE_ONE, 'radio');
        showSubContainer('mother_alive', 'dc', '.mother_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('mother_alive', 'dc', '.is_mother_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'dc', formData.spouse_alive, false, false);
        showSubContainer('spouse_alive', 'dc', '.spouse_proof_item', VALUE_ONE, 'radio');
        showSubContainer('spouse_alive', 'dc', '.spouse_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('spouse_alive', 'dc', '.is_spouse_alive', VALUE_ONE, 'radio');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        if (isEdit) {
            that.getFatherMotherSpouseData(fatherDetails, motherDetails, spouseDetails, formData);
            if (formData.applicant_photo != '') {
                that.showDocument('applicant_photo_container_for_domicile', 'applicant_photo_name_image_for_domicile', 'applicant_photo_name_container_for_domicile',
                        'applicant_photo_download', 'applicant_photo', formData.applicant_photo, formData.domicile_certificate_id, VALUE_ONE);
            }

            if (formData.birth_certi != '') {
                that.showDocument('birth_certi_container_for_domicile', 'birth_certi_name_image_for_domicile', 'birth_certi_name_container_for_domicile',
                        'birth_certi_download', 'birth_certi', formData.birth_certi, formData.domicile_certificate_id, VALUE_TWO);
            }

            if (formData.election_card != '') {
                that.showDocument('election_card_container_for_domicile', 'election_card_name_image_for_domicile', 'election_card_name_container_for_domicile',
                        'election_card_download', 'election_card', formData.election_card, formData.domicile_certificate_id, VALUE_THREE);
            }
            if (formData.aadhaar_card != '') {
                that.showDocument('aadhaar_card_container_for_domicile', 'aadhaar_card_name_image_for_domicile', 'aadhaar_card_name_container_for_domicile',
                        'aadhaar_card_download', 'aadhaar_card', formData.aadhaar_card, formData.domicile_certificate_id, VALUE_FOUR);
            }
            if (formData.leaving_certi != '') {
                that.showDocument('leaving_certi_container_for_domicile', 'leaving_certi_name_image_for_domicile', 'leaving_certi_name_container_for_domicile',
                        'leaving_certi_download', 'leaving_certi', formData.leaving_certi, formData.domicile_certificate_id, VALUE_EIGHTEEN);
            }
            if (formData.last_10year_proof != '') {
                that.showDocument('last_10year_proof_container_for_domicile', 'last_10year_proof_name_image_for_domicile', 'last_10year_proof_name_container_for_domicile',
                        'last_10year_proof_download', 'last_10year_proof', formData.last_10year_proof, formData.domicile_certificate_id, VALUE_SEVEN);
            }
            if (formData.gas_book != '') {
                that.showDocument('gas_book_container_for_domicile', 'gas_book_name_image_for_domicile', 'gas_book_name_container_for_domicile',
                        'gas_book_download', 'gas_book', formData.gas_book, formData.domicile_certificate_id, VALUE_NINE);
            }
            if (formData.bank_book != '') {
                that.showDocument('bank_book_container_for_domicile', 'bank_book_name_image_for_domicile', 'bank_book_name_container_for_domicile',
                        'bank_book_download', 'bank_book', formData.bank_book, formData.domicile_certificate_id, VALUE_TEN);
            }
            if (formData.house_tax_receipt != '') {
                that.showDocument('house_tax_receipt_container_for_domicile', 'house_tax_receipt_name_image_for_domicile', 'house_tax_receipt_name_container_for_domicile',
                        'house_tax_receipt_download', 'house_tax_receipt', formData.house_tax_receipt, formData.domicile_certificate_id, VALUE_ELEVEN);
            }
            if (formData.sale_deed_copy != '') {
                that.showDocument('sale_deed_copy_container_for_domicile', 'sale_deed_copy_name_image_for_domicile', 'sale_deed_copy_name_container_for_domicile',
                        'sale_deed_copy_download', 'sale_deed_copy', formData.sale_deed_copy, formData.domicile_certificate_id, VALUE_NINETEEN);
            }
            if (formData.noc_with_notary != '') {
                that.showDocument('noc_with_notary_container_for_domicile', 'noc_with_notary_name_image_for_domicile', 'noc_with_notary_name_container_for_domicile',
                        'noc_with_notary_download', 'noc_with_notary', formData.noc_with_notary, formData.domicile_certificate_id, VALUE_TWELVE);
            }
            if (formData.aggriment_with_notary != '') {
                that.showDocument('aggriment_with_notary_container_for_domicile', 'aggriment_with_notary_name_image_for_domicile', 'aggriment_with_notary_name_container_for_domicile',
                        'aggriment_with_notary_download', 'aggriment_with_notary', formData.aggriment_with_notary, formData.domicile_certificate_id, VALUE_TWENTY);
            }
            if (formData.father_birth_certificate != '') {
                that.showDocument('father_birth_certificate_container_for_dc', 'father_birth_certificate_name_image_for_domicile', 'father_birth_certificate_name_container_for_domicile',
                        'father_birth_certificate_download', 'father_birth_certificate', formData.father_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYTHREE);
            }
            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_dc', 'father_election_card_name_image_for_domicile', 'father_election_card_name_container_for_domicile',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.domicile_certificate_id, VALUE_TWENTYFOUR);
            }
            if (formData.father_aadhar_card != '') {
                that.showDocument('father_aadhar_card_container_for_dc', 'father_aadhar_card_name_image_for_domicile', 'father_aadhar_card_name_container_for_domicile',
                        'father_aadhar_card_download', 'father_aadhar_card', formData.father_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYFIVE);
            }
            if (formData.father_death_proof != '') {
                that.showDocument('father_death_proof_container_for_dc', 'father_death_proof_name_image_for_domicile', 'father_death_proof_name_container_for_domicile',
                        'father_death_proof_download', 'father_death_proof', formData.father_death_proof, formData.domicile_certificate_id, VALUE_TWENTYSIX);
            }


            if (formData.mother_birth_certificate != '') {
                that.showDocument('mother_birth_certificate_container_for_dc', 'mother_birth_certificate_name_image_for_domicile', 'mother_birth_certificate_name_container_for_domicile',
                        'mother_birth_certificate_download', 'mother_birth_certificate', formData.mother_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYSEVEN);
            }
            if (formData.mother_election_card != '') {
                that.showDocument('mother_election_card_container_for_dc', 'mother_election_card_name_image_for_domicile', 'mother_election_card_name_container_for_domicile',
                        'mother_election_card_download', 'mother_election_card', formData.mother_election_card, formData.domicile_certificate_id, VALUE_TWENTYEIGHT);
            }
            if (formData.mother_aadhar_card != '') {
                that.showDocument('mother_aadhar_card_container_for_dc', 'mother_aadhar_card_name_image_for_domicile', 'mother_aadhar_card_name_container_for_domicile',
                        'mother_aadhar_card_download', 'mother_aadhar_card', formData.mother_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYNINE);
            }
            if (formData.mother_death_proof != '') {
                that.showDocument('mother_death_proof_container_for_dc', 'mother_death_proof_name_image_for_domicile', 'mother_death_proof_name_container_for_domicile',
                        'mother_death_proof_download', 'mother_death_proof', formData.mother_death_proof, formData.domicile_certificate_id, VALUE_THIRTY);
            }
            if (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE) {
                // if (formData.spouse_proof != '') {
                //     that.showDocument('spouse_proof_container_for_dc', 'spouse_proof_name_image_for_domicile', 'spouse_proof_name_container_for_domicile',
                //             'spouse_proof_download', 'spouse_proof', formData.spouse_proof, formData.domicile_certificate_id, VALUE_SEVENTEEN);
                // }
                if (formData.spouse_birth_certificate != '') {
                    that.showDocument('spouse_birth_certificate_container_for_dc', 'spouse_birth_certificate_name_image_for_domicile', 'spouse_birth_certificate_name_container_for_domicile',
                            'spouse_birth_certificate_download', 'spouse_birth_certificate', formData.spouse_birth_certificate, formData.domicile_certificate_id, VALUE_THIRTYONE);
                }
                if (formData.spouse_election_card != '') {
                    that.showDocument('spouse_election_card_container_for_dc', 'spouse_election_card_name_image_for_domicile', 'spouse_election_card_name_container_for_domicile',
                            'spouse_election_card_download', 'spouse_election_card', formData.spouse_election_card, formData.domicile_certificate_id, VALUE_THIRTYTWO);
                }
                if (formData.spouse_aadhar_card != '') {
                    that.showDocument('spouse_aadhar_card_container_for_dc', 'spouse_aadhar_card_name_image_for_domicile', 'spouse_aadhar_card_name_container_for_domicile',
                            'spouse_aadhar_card_download', 'spouse_aadhar_card', formData.spouse_aadhar_card, formData.domicile_certificate_id, VALUE_THIRTYTHREE);
                }
                if (formData.spouse_death_proof != '') {
                    that.showDocument('spouse_death_proof_container_for_dc', 'spouse_death_proof_name_image_for_domicile', 'spouse_death_proof_name_container_for_domicile',
                            'spouse_death_proof_download', 'spouse_death_proof', formData.spouse_death_proof, formData.domicile_certificate_id, VALUE_THIRTYFOUR);
                }
            }
            if (formData.other_document != '') {
                that.showDocument('other_document_container_for_domicile', 'other_document_name_image_for_domicile', 'other_document_name_container_for_domicile',
                        'other_document_download', 'other_document', formData.other_document, formData.domicile_certificate_id, VALUE_SIXTEEN);
            }
            var cntedu = 1;
            if (formData.applicant_education_details != '') {
                var applicant_education_details = JSON.parse(formData.applicant_education_details);
                $.each(applicant_education_details, function (key, value) {
                    that.addEducationInfo(value, true);
                    cntedu++;
                });
            }

            var cntresi = 1;
            if (formData.residential_details != '') {
                var residential_details = JSON.parse(formData.residential_details);
                $.each(residential_details, function (key, value) {
                    that.addResidentialInfo(value, true);
                    $('#type_of_resident_' + cntresi).val(value.type_of_resident);
                    cntresi++;
                });
            }
        } else {
            that.addEducationInfo({}, true);
            that.addResidentialInfo({}, true);
            $('#father_alive_for_dc_1').prop('checked', true);
            $('#mother_alive_for_dc_1').prop('checked', true);
            $('#spouse_alive_for_dc_1').prop('checked', true);
            $('#have_you_own_house_for_domicile_1').prop('checked', true);
            $('.house_tax_receipt_item_container_for_domicile').show();
        }

        generateSelect2();
        datePicker();
        datePickerFif('applicant_dob_for_dc');
        allowOnlyIntegerValue('residing_year_for_dc');
        allowOnlyIntegerValue('residing_month_for_dc');
        allowOnlyIntegerValue('residing_days_for_dc');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_dc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
        }

        $('#domicile_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDomicile($('#submit_btn_for_domicile'));
            }
        });
    },
    typeFourDomicileForm: function (isEdit, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var that = this;
        if (isEdit) {
            var formData = parseData.domicile_data;
            var fatherDetails = formData.father_details != '' ? JSON.parse(formData.father_details) : {};
            var motherDetails = formData.mother_details != '' ? JSON.parse(formData.mother_details) : {};
            var spouseDetails = formData.spouse_details != '' ? JSON.parse(formData.spouse_details) : {};
            Domicile.router.navigate('edit_domicile_form');
        } else {
            var formData = {};
            Domicile.router.navigate('type_four_domicile_form');
        }

        var templateData = {};
        tempResidentialDetailCnt = 1;
        tempBusinessDetailCnt = 1;
        tempServiceDetailCnt = 1;
        templateData.is_checked = isChecked;
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        templateData.VALUE_FOUR = VALUE_FOUR;
        templateData.VALUE_FIVE = VALUE_FIVE;
        templateData.VALUE_SEVEN = VALUE_SEVEN;
        templateData.VALUE_NINE = VALUE_NINE;
        templateData.VALUE_TEN = VALUE_TEN;
        templateData.VALUE_ELEVEN = VALUE_ELEVEN;
        templateData.VALUE_TWELVE = VALUE_TWELVE;
        templateData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        templateData.VALUE_FIFTEEN = VALUE_FIFTEEN;
        templateData.VALUE_SIXTEEN = VALUE_SIXTEEN;
        templateData.VALUE_SEVENTEEN = VALUE_SEVENTEEN;
        templateData.IS_CHECKED_YES = IS_CHECKED_YES;
        templateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        templateData.domicile_data = parseData.domicile_data;
        templateData.applicant_dob = dateTo_DD_MM_YYYY(formData.applicant_dob);
        if (isEdit) {
            templateData.father_data = fatherDetails;
            templateData.mother_data = motherDetails;
            templateData.spouse_data = spouseDetails;
        }
        $('#domicile_form_and_datatable_container').html(typeFourDomicileFormTemplate(templateData));
        renderOptionsForTwoDimensionalArray(talukaArray, 'district');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_dc');
        renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_dc');
        generateBoxes('radio', genderArray, 'gender', 'dc', formData.gender, false, false);
        generateBoxes('radio', maritalStatusArray, 'marital_status', 'dc', formData.marital_status, false, false);

        generateBoxes('radio', yesNoArray, 'have_you_own_house', 'domicile', formData.have_you_own_house, false, false);
        showSubContainer('have_you_own_house', 'domicile', '.house_tax_receipt_item', VALUE_ONE, 'radio');
        showSubContainer('have_you_own_house', 'domicile', '.noc_with_notary_item', VALUE_TWO, 'radio');
        var district = formData.district;
        var villageData = isEdit ? (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []))) : [];
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'father_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'mother_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'spouse_occupation_for_dc');
        renderOptionsForTwoDimensionalArray(businessTypeArray, 'business_type_for_dc');
        renderOptionsForTwoDimensionalArray(educationTypeArray, 'applicant_education_for_dc');
        showSubContainer('business_type', 'dc', '.business_type_item', VALUE_ONE, 'select');
        showSubContainer('business_type', 'dc', '.service_type_item', VALUE_TWO, 'select');
        generateBoxes('radio', yesNoArray, 'father_alive', 'dc', formData.father_alive, false, false);
        showSubContainer('father_alive', 'dc', '.father_proof_item', VALUE_ONE, 'radio');
        showSubContainer('father_alive', 'dc', '.father_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('father_alive', 'dc', '.is_father_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'mother_alive', 'dc', formData.mother_alive, false, false);
        showSubContainer('mother_alive', 'dc', '.mother_proof_item', VALUE_ONE, 'radio');
        showSubContainer('mother_alive', 'dc', '.mother_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('mother_alive', 'dc', '.is_mother_alive', VALUE_ONE, 'radio');
        generateBoxes('radio', yesNoArray, 'spouse_alive', 'dc', formData.spouse_alive, false, false);
        showSubContainer('spouse_alive', 'dc', '.spouse_proof_item', VALUE_ONE, 'radio');
        showSubContainer('spouse_alive', 'dc', '.spouse_death_proof_item', VALUE_TWO, 'radio');
        showSubContainer('spouse_alive', 'dc', '.is_spouse_alive', VALUE_ONE, 'radio');

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'father_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'mother_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_born_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'spouse_native_place_state_for_dc', 'state_code', 'state_name', 'State/UT');
        if (isEdit) {
            that.getFatherMotherSpouseData(fatherDetails, motherDetails, spouseDetails, formData);
            if (formData.applicant_photo != '') {
                that.showDocument('applicant_photo_container_for_domicile', 'applicant_photo_name_image_for_domicile', 'applicant_photo_name_container_for_domicile',
                        'applicant_photo_download', 'applicant_photo', formData.applicant_photo, formData.domicile_certificate_id, VALUE_ONE);
            }

            if (formData.birth_certi != '') {
                that.showDocument('birth_certi_container_for_domicile', 'birth_certi_name_image_for_domicile', 'birth_certi_name_container_for_domicile',
                        'birth_certi_download', 'birth_certi', formData.birth_certi, formData.domicile_certificate_id, VALUE_TWO);
            }

            if (formData.election_card != '') {
                that.showDocument('election_card_container_for_domicile', 'election_card_name_image_for_domicile', 'election_card_name_container_for_domicile',
                        'election_card_download', 'election_card', formData.election_card, formData.domicile_certificate_id, VALUE_THREE);
            }
            if (formData.aadhaar_card != '') {
                that.showDocument('aadhaar_card_container_for_domicile', 'aadhaar_card_name_image_for_domicile', 'aadhaar_card_name_container_for_domicile',
                        'aadhaar_card_download', 'aadhaar_card', formData.aadhaar_card, formData.domicile_certificate_id, VALUE_FOUR);
            }
            if (formData.leaving_certi != '') {
                that.showDocument('leaving_certi_container_for_domicile', 'leaving_certi_name_image_for_domicile', 'leaving_certi_name_container_for_domicile',
                        'leaving_certi_download', 'leaving_certi', formData.leaving_certi, formData.domicile_certificate_id, VALUE_FIVE);
            }
            if (formData.last_10year_proof != '') {
                that.showDocument('last_10year_proof_container_for_domicile', 'last_10year_proof_name_image_for_domicile', 'last_10year_proof_name_container_for_domicile',
                        'last_10year_proof_download', 'last_10year_proof', formData.last_10year_proof, formData.domicile_certificate_id, VALUE_SEVEN);
            }
            if (formData.gas_book != '') {
                that.showDocument('gas_book_container_for_domicile', 'gas_book_name_image_for_domicile', 'gas_book_name_container_for_domicile',
                        'gas_book_download', 'gas_book', formData.gas_book, formData.domicile_certificate_id, VALUE_NINE);
            }
            if (formData.bank_book != '') {
                that.showDocument('bank_book_container_for_domicile', 'bank_book_name_image_for_domicile', 'bank_book_name_container_for_domicile',
                        'bank_book_download', 'bank_book', formData.bank_book, formData.domicile_certificate_id, VALUE_TEN);
            }
            if (formData.house_tax_receipt != '') {
                that.showDocument('house_tax_receipt_container_for_domicile', 'house_tax_receipt_name_image_for_domicile', 'house_tax_receipt_name_container_for_domicile',
                        'house_tax_receipt_download', 'house_tax_receipt', formData.house_tax_receipt, formData.domicile_certificate_id, VALUE_ELEVEN);
            }
            if (formData.sale_deed_copy != '') {
                that.showDocument('sale_deed_copy_container_for_domicile', 'sale_deed_copy_name_image_for_domicile', 'sale_deed_copy_name_container_for_domicile',
                        'sale_deed_copy_download', 'sale_deed_copy', formData.sale_deed_copy, formData.domicile_certificate_id, VALUE_NINETEEN);
            }
            if (formData.noc_with_notary != '') {
                that.showDocument('noc_with_notary_container_for_domicile', 'noc_with_notary_name_image_for_domicile', 'noc_with_notary_name_container_for_domicile',
                        'noc_with_notary_download', 'noc_with_notary', formData.noc_with_notary, formData.domicile_certificate_id, VALUE_TWELVE);
            }
            if (formData.aggriment_with_notary != '') {
                that.showDocument('aggriment_with_notary_container_for_domicile', 'aggriment_with_notary_name_image_for_domicile', 'aggriment_with_notary_name_container_for_domicile',
                        'aggriment_with_notary_download', 'aggriment_with_notary', formData.aggriment_with_notary, formData.domicile_certificate_id, VALUE_TWENTY);
            }
            if (formData.father_birth_certificate != '') {
                that.showDocument('father_birth_certificate_container_for_dc', 'father_birth_certificate_name_image_for_domicile', 'father_birth_certificate_name_container_for_domicile',
                        'father_birth_certificate_download', 'father_birth_certificate', formData.father_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYTHREE);
            }
            if (formData.father_election_card != '') {
                that.showDocument('father_election_card_container_for_dc', 'father_election_card_name_image_for_domicile', 'father_election_card_name_container_for_domicile',
                        'father_election_card_download', 'father_election_card', formData.father_election_card, formData.domicile_certificate_id, VALUE_TWENTYFOUR);
            }
            if (formData.father_aadhar_card != '') {
                that.showDocument('father_aadhar_card_container_for_dc', 'father_aadhar_card_name_image_for_domicile', 'father_aadhar_card_name_container_for_domicile',
                        'father_aadhar_card_download', 'father_aadhar_card', formData.father_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYFIVE);
            }
            if (formData.father_death_proof != '') {
                that.showDocument('father_death_proof_container_for_dc', 'father_death_proof_name_image_for_domicile', 'father_death_proof_name_container_for_domicile',
                        'father_death_proof_download', 'father_death_proof', formData.father_death_proof, formData.domicile_certificate_id, VALUE_TWENTYSIX);
            }


            if (formData.mother_birth_certificate != '') {
                that.showDocument('mother_birth_certificate_container_for_dc', 'mother_birth_certificate_name_image_for_domicile', 'mother_birth_certificate_name_container_for_domicile',
                        'mother_birth_certificate_download', 'mother_birth_certificate', formData.mother_birth_certificate, formData.domicile_certificate_id, VALUE_TWENTYSEVEN);
            }
            if (formData.mother_election_card != '') {
                that.showDocument('mother_election_card_container_for_dc', 'mother_election_card_name_image_for_domicile', 'mother_election_card_name_container_for_domicile',
                        'mother_election_card_download', 'mother_election_card', formData.mother_election_card, formData.domicile_certificate_id, VALUE_TWENTYEIGHT);
            }
            if (formData.mother_aadhar_card != '') {
                that.showDocument('mother_aadhar_card_container_for_dc', 'mother_aadhar_card_name_image_for_domicile', 'mother_aadhar_card_name_container_for_domicile',
                        'mother_aadhar_card_download', 'mother_aadhar_card', formData.mother_aadhar_card, formData.domicile_certificate_id, VALUE_TWENTYNINE);
            }
            if (formData.mother_death_proof != '') {
                that.showDocument('mother_death_proof_container_for_dc', 'mother_death_proof_name_image_for_domicile', 'mother_death_proof_name_container_for_domicile',
                        'mother_death_proof_download', 'mother_death_proof', formData.mother_death_proof, formData.domicile_certificate_id, VALUE_THIRTY);
            }
            if (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE) {
                // if (formData.spouse_proof != '') {
                //     that.showDocument('spouse_proof_container_for_dc', 'spouse_proof_name_image_for_domicile', 'spouse_proof_name_container_for_domicile',
                //             'spouse_proof_download', 'spouse_proof', formData.spouse_proof, formData.domicile_certificate_id, VALUE_SEVENTEEN);
                // }
                if (formData.spouse_birth_certificate != '') {
                    that.showDocument('spouse_birth_certificate_container_for_dc', 'spouse_birth_certificate_name_image_for_domicile', 'spouse_birth_certificate_name_container_for_domicile',
                            'spouse_birth_certificate_download', 'spouse_birth_certificate', formData.spouse_birth_certificate, formData.domicile_certificate_id, VALUE_THIRTYONE);
                }
                if (formData.spouse_election_card != '') {
                    that.showDocument('spouse_election_card_container_for_dc', 'spouse_election_card_name_image_for_domicile', 'spouse_election_card_name_container_for_domicile',
                            'spouse_election_card_download', 'spouse_election_card', formData.spouse_election_card, formData.domicile_certificate_id, VALUE_THIRTYTWO);
                }
                if (formData.spouse_aadhar_card != '') {
                    that.showDocument('spouse_aadhar_card_container_for_dc', 'spouse_aadhar_card_name_image_for_domicile', 'spouse_aadhar_card_name_container_for_domicile',
                            'spouse_aadhar_card_download', 'spouse_aadhar_card', formData.spouse_aadhar_card, formData.domicile_certificate_id, VALUE_THIRTYTHREE);
                }
                if (formData.spouse_death_proof != '') {
                    that.showDocument('spouse_death_proof_container_for_dc', 'spouse_death_proof_name_image_for_domicile', 'spouse_death_proof_name_container_for_domicile',
                            'spouse_death_proof_download', 'spouse_death_proof', formData.spouse_death_proof, formData.domicile_certificate_id, VALUE_THIRTYFOUR);
                }
            }
            if (formData.other_document != '') {
                that.showDocument('other_document_container_for_domicile', 'other_document_name_image_for_domicile', 'other_document_name_container_for_domicile',
                        'other_document_download', 'other_document', formData.other_document, formData.domicile_certificate_id, VALUE_SIXTEEN);
            }
            var cntresi = 1;
            if (formData.residential_details != '') {
                var residential_details = JSON.parse(formData.residential_details);
                $.each(residential_details, function (key, value) {
                    that.addResidentialInfo(value, true);
                    $('#type_of_resident_' + cntresi).val(value.type_of_resident);
                    cntresi++;
                });
            }

            $('#business_type_for_dc').val(formData.business_type);
            if (formData.business_type == VALUE_ONE)
                $('.business_type_item_container_for_dc').show()
            if (formData.business_type == VALUE_TWO)
                $('.service_type_item_container_for_dc').show()

            var cntbus = 1;
            if (formData.business_details != '') {
                var business_details = JSON.parse(formData.business_details);
                $.each(business_details, function (key, value) {
                    that.addBusinessInfo(value, true);
                    cntbus++;
                });
            }

            var cntser = 1;
            if (formData.service_details != '') {
                var service_details = JSON.parse(formData.service_details);
                $.each(service_details, function (key, value) {
                    that.addServiceInfo(value, true);
                    cntser++;
                });
            }
        } else {
            that.addResidentialInfo({}, true);
            that.addBusinessInfo({}, true);
            that.addServiceInfo({}, true);
            $('#father_alive_for_dc_1').prop('checked', true);
            $('#mother_alive_for_dc_1').prop('checked', true);
            $('#spouse_alive_for_dc_1').prop('checked', true);
            $('#have_you_own_house_for_domicile_1').prop('checked', true);
            $('.house_tax_receipt_item_container_for_domicile').show();
        }

        generateSelect2();
        datePicker();
        datePickerMax('applicant_dob_for_dc');
        allowOnlyIntegerValue('residing_year_for_dc');
        allowOnlyIntegerValue('residing_month_for_dc');
        allowOnlyIntegerValue('residing_days_for_dc');
        if (isEdit) {
            if (formData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_dc').val(dateTo_DD_MM_YYYY(formData.applicant_dob));
            }
        }

        $('#domicile_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitDomicile($('#submit_btn_for_domicile'));
            }
        });
    },
    editOrViewDomicile: function (btnObj, domicileId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!domicileId) {
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
            url: 'domicile/get_domicile_data_by_id',
            type: 'post',
            data: $.extend({}, {'domicile_certificate_id': domicileId, 'is_edit_view': isEditOrView}, getTokenData()),
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
                    var domicileCertificateData = parseData.domicile_data;
                    if (domicileCertificateData.constitution_artical == VALUE_ONE)
                        that.typeOneDomicileForm(isEdit, parseData);
                    else if (domicileCertificateData.constitution_artical == VALUE_TWO)
                        that.typeTwoADomicileForm(isEdit, parseData);
                    else if (domicileCertificateData.constitution_artical == VALUE_THREE)
                        that.typeTwoBDomicileForm(isEdit, parseData);
                    else if (domicileCertificateData.constitution_artical == VALUE_FOUR)
                        that.typeTwoCDomicileForm(isEdit, parseData);
                    else if (domicileCertificateData.constitution_artical == VALUE_FIVE)
                        that.typeThreeADomicileForm(isEdit, parseData);
                    else if (domicileCertificateData.constitution_artical == VALUE_SIX)
                        that.typeThreeBDomicileForm(isEdit, parseData);
                    else if (domicileCertificateData.constitution_artical == VALUE_SEVEN)
                        that.typeFourDomicileForm(isEdit, parseData);
                    //that.newDomicileForm(isEdit, parseData);
                } else {
                    var domicileCertificateData = parseData.domicile_data;
                    that.viewDomicileForm(VALUE_ONE, domicileCertificateData, isPrint);
                }
            }
        });
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', DOMICILE_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", DOMICILE_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'Domicile.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },
    viewDomicileForm: function (moduleType, domicileCertificateData, isPrint) {
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
            Domicile.router.navigate('view_domicile_form');
            domicileCertificateData.title = 'View';
        } else {
            domicileCertificateData.show_submit_btn = true;
        }

        tempMemberCnt = 1;
        tempFamilyMemberCnt = 1;
        tempChildrenCnt = 1;
        tempPropertyCnt = 1;
        tempOtherIncomeCnt = 1;
        domicileCertificateData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        Domicile.router.navigate('view_domicile_form');
        domicileCertificateData.VALUE_ONE = VALUE_ONE;
        domicileCertificateData.VALUE_TWO = VALUE_TWO;
        domicileCertificateData.VALUE_THREE = VALUE_THREE;
        domicileCertificateData.VALUE_FOUR = VALUE_FOUR;
        domicileCertificateData.VALUE_FIVE = VALUE_FIVE;
        domicileCertificateData.VALUE_SIX = VALUE_SIX;
        domicileCertificateData.VALUE_SEVEN = VALUE_SEVEN;
        domicileCertificateData.DOMICILE_CERTIFICATE_DOC_PATH = DOMICILE_CERTIFICATE_DOC_PATH;
        domicileCertificateData.show_constitution_artical_detail = true;
        domicileCertificateData.showInfo = true;
        domicileCertificateData.showMinorInfo = false;

        var fatherDetails = domicileCertificateData.father_details != '' ? JSON.parse(domicileCertificateData.father_details) : {};
        var motherDetails = domicileCertificateData.mother_details != '' ? JSON.parse(domicileCertificateData.mother_details) : {};
        var spouseDetails = domicileCertificateData.spouse_details != '' ? JSON.parse(domicileCertificateData.spouse_details) : {};

        var appType = domicileCertificateData.constitution_artical ? domicileCertificateData.constitution_artical : '';
        if (appType == VALUE_THREE || appType == VALUE_FOUR) {
            domicileCertificateData.show_gaudian_detail = true;
        }
        domicileCertificateData.application_type_title = 'Applicant Name';
        domicileCertificateData.application_type_text = domicileAppTypeArray[appType] ? domicileAppTypeArray[appType] : '';
        if (appType == VALUE_ONE) {
            domicileCertificateData.show_constitution_artical_detail = false;
        } else if (appType == VALUE_FOUR || appType == VALUE_FIVE) {
            domicileCertificateData.application_type_title = 'Guardian Name';
        }

        if (appType == VALUE_FOUR || appType == VALUE_FIVE) {
            domicileCertificateData.showInfo = false;
            domicileCertificateData.showMinorInfo = true;
        }

        domicileCertificateData.com_addr_house_name = domicileCertificateData.com_addr_house_name == '' ? '' : domicileCertificateData.com_addr_house_name + ',';
        domicileCertificateData.per_addr_house_name = domicileCertificateData.per_addr_house_name == '' ? '' : domicileCertificateData.per_addr_house_name + ',';

        domicileCertificateData.district_text = talukaArray[domicileCertificateData.district] ? talukaArray[domicileCertificateData.district] : '';
        var district = domicileCertificateData.district;
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        domicileCertificateData.village_name_text = villageData[domicileCertificateData.village_name] ? villageData[domicileCertificateData.village_name] : '';
        domicileCertificateData.gender_text = genderArray[domicileCertificateData.gender] ? genderArray[domicileCertificateData.gender] : '';
        domicileCertificateData.applicant_dob_text = domicileCertificateData.applicant_dob != '0000-00-00' ? dateTo_DD_MM_YYYY(domicileCertificateData.applicant_dob) : '';
        domicileCertificateData.occupation_text = applicantOccupationArray[domicileCertificateData.occupation] ? (domicileCertificateData.occupation == VALUE_TWELVE ? domicileCertificateData.other_occupation : applicantOccupationArray[domicileCertificateData.occupation]) : '';
        domicileCertificateData.marital_status_text = maritalStatusArray[domicileCertificateData.marital_status] ? maritalStatusArray[domicileCertificateData.marital_status] : '';
        if (domicileCertificateData.marital_status == VALUE_ONE && (domicileCertificateData.constitution_artical != VALUE_FIVE && domicileCertificateData.constitution_artical != VALUE_FOUR) || (domicileCertificateData.marital_status == VALUE_THREE && domicileCertificateData.constitution_artical == VALUE_THREE)) {
            domicileCertificateData.show_spouse = true;
            domicileCertificateData.spouse_name = spouseDetails.spouse_name ? spouseDetails.spouse_name : '';
            domicileCertificateData.spouse_nationality = spouseDetails.spouse_nationality ? spouseDetails.spouse_nationality : '';
            domicileCertificateData.spouse_born_place_state_text = spouseDetails.spouse_born_place_state_text ? spouseDetails.spouse_born_place_state_text : '';
            domicileCertificateData.spouse_born_place_district_text = spouseDetails.spouse_born_place_district_text ? spouseDetails.spouse_born_place_district_text : '';
            domicileCertificateData.spouse_born_place_village_text = spouseDetails.spouse_born_place_village_text ? spouseDetails.spouse_born_place_village_text : '';
            domicileCertificateData.spouse_born_pincode = spouseDetails.spouse_born_pincode ? spouseDetails.spouse_born_pincode : '';
            domicileCertificateData.spouse_native_place_state_text = spouseDetails.spouse_native_place_state_text ? spouseDetails.spouse_native_place_state_text : '';
            domicileCertificateData.spouse_native_place_district_text = spouseDetails.spouse_native_place_district_text ? spouseDetails.spouse_native_place_district_text : '';
            domicileCertificateData.spouse_native_place_village_text = spouseDetails.spouse_native_place_village_text ? spouseDetails.spouse_native_place_village_text : '';
            domicileCertificateData.spouse_occupation_text = applicantOccupationArray[spouseDetails.spouse_occupation] ? (spouseDetails.spouse_occupation == VALUE_TWELVE ? spouseDetails.spouse_other_occupation : applicantOccupationArray[spouseDetails.spouse_occupation]) : '';
            domicileCertificateData.spouse_aadhaar = spouseDetails.spouse_aadhaar ? spouseDetails.spouse_aadhaar : '';
            domicileCertificateData.spouse_election_no = spouseDetails.spouse_election_no ? spouseDetails.spouse_election_no : '';
            domicileCertificateData.spouse_native_pincode = spouseDetails.spouse_native_pincode ? spouseDetails.spouse_native_pincode : '';
        }

        domicileCertificateData.show_father_mother_info = true;
        if ((domicileCertificateData.gender == VALUE_TWO && appType != VALUE_SEVEN && appType != VALUE_TWO && appType != VALUE_THREE && (domicileCertificateData.marital_status == VALUE_ONE || domicileCertificateData.marital_status == VALUE_THREE)) || (domicileCertificateData.gender == VALUE_THREE || domicileCertificateData.gender == VALUE_FOUR)) {
            domicileCertificateData.show_father_mother_info = false;
        }
        // Father
        domicileCertificateData.father_constitution_artical_btn = true;
        domicileCertificateData.show_spouse_name = false;
        domicileCertificateData.show_father_name = false;
        if (fatherDetails.father_name == '') {
            domicileCertificateData.show_spouse_name = true;
        } else {
            domicileCertificateData.show_father_name = true;
        }
        domicileCertificateData.father_name = fatherDetails.father_name ? fatherDetails.father_name : '';
        domicileCertificateData.father_nationality = fatherDetails.father_nationality ? fatherDetails.father_nationality : '';
        domicileCertificateData.father_born_place_state_text = fatherDetails.father_born_place_state_text ? fatherDetails.father_born_place_state_text : '';
        domicileCertificateData.father_born_place_district_text = fatherDetails.father_born_place_district_text ? fatherDetails.father_born_place_district_text : '';
        domicileCertificateData.father_born_place_village_text = fatherDetails.father_born_place_village_text ? fatherDetails.father_born_place_village_text : '';
        domicileCertificateData.father_born_pincode = fatherDetails.father_born_pincode ? fatherDetails.father_born_pincode : '';
        domicileCertificateData.father_native_place_state_text = fatherDetails.father_native_place_state_text ? fatherDetails.father_native_place_state_text : '';
        domicileCertificateData.father_native_place_district_text = fatherDetails.father_native_place_district_text ? fatherDetails.father_native_place_district_text : '';
        domicileCertificateData.father_native_place_village_text = fatherDetails.father_native_place_village_text ? fatherDetails.father_native_place_village_text : '';
        domicileCertificateData.father_occupation_text = applicantOccupationArray[fatherDetails.father_occupation] ? (fatherDetails.father_occupation == VALUE_TWELVE ? fatherDetails.father_other_occupation : applicantOccupationArray[fatherDetails.father_occupation]) : '';
        domicileCertificateData.father_aadhaar = fatherDetails.father_aadhaar ? fatherDetails.father_aadhaar : '';
        domicileCertificateData.father_election_no = fatherDetails.father_election_no ? fatherDetails.father_election_no : '';
        domicileCertificateData.father_native_pincode = fatherDetails.father_native_pincode ? fatherDetails.father_native_pincode : '';
        // mother
        domicileCertificateData.mother_constitution_artical_btn = true;
        domicileCertificateData.mother_name = motherDetails.mother_name ? motherDetails.mother_name : '';
        domicileCertificateData.mother_nationality = motherDetails.mother_nationality ? motherDetails.mother_nationality : '';
        domicileCertificateData.mother_born_place_state_text = motherDetails.mother_born_place_state_text ? motherDetails.mother_born_place_state_text : '';
        domicileCertificateData.mother_born_place_district_text = motherDetails.mother_born_place_district_text ? motherDetails.mother_born_place_district_text : '';
        domicileCertificateData.mother_born_place_village_text = motherDetails.mother_born_place_village_text ? motherDetails.mother_born_place_village_text : '';
        domicileCertificateData.mother_born_pincode = motherDetails.mother_born_pincode ? motherDetails.mother_born_pincode : '';
        domicileCertificateData.mother_native_place_state_text = motherDetails.mother_native_place_state_text ? motherDetails.mother_native_place_state_text : '';
        domicileCertificateData.mother_native_place_district_text = motherDetails.mother_native_place_district_text ? motherDetails.mother_native_place_district_text : '';
        domicileCertificateData.mother_native_place_village_text = motherDetails.mother_native_place_village_text ? motherDetails.mother_native_place_village_text : '';
        domicileCertificateData.mother_occupation_text = applicantOccupationArray[motherDetails.mother_occupation] ? (motherDetails.mother_occupation == VALUE_TWELVE ? motherDetails.mother_other_occupation : applicantOccupationArray[motherDetails.mother_occupation]) : '';
        domicileCertificateData.mother_aadhaar = motherDetails.mother_aadhaar ? motherDetails.mother_aadhaar : '';
        domicileCertificateData.mother_election_no = motherDetails.mother_election_no ? motherDetails.mother_election_no : '';
        domicileCertificateData.mother_native_pincode = motherDetails.mother_native_pincode ? motherDetails.mother_native_pincode : '';
        if (appType == VALUE_ONE) {
            domicileCertificateData.native_place_state_text = stateArray[domicileCertificateData.native_place_state] ? stateArray[domicileCertificateData.native_place_state] : '';
            var State = domicileCertificateData.native_place_state;
            var districtData = State == VALUE_ONE ? damandiudistrictArray : (State == VALUE_TWO ? dnhdistrictArray : []);
            domicileCertificateData.native_place_district_text = districtData[domicileCertificateData.native_place_district] ? districtData[domicileCertificateData.native_place_district] : '';
            var district = domicileCertificateData.native_place_district;
            var villageData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
            domicileCertificateData.native_place_village_text = villageData[domicileCertificateData.native_place_village] ? villageData[domicileCertificateData.native_place_village] : '';

            if (domicileCertificateData.marital_status == VALUE_ONE && (domicileCertificateData.constitution_artical != VALUE_FIVE && domicileCertificateData.constitution_artical != VALUE_TWO)) {
                domicileCertificateData.spouse_constitution_artical_btn = true;
                domicileCertificateData.spouse_name = spouseDetails.spouse_name ? spouseDetails.spouse_name : '';
                domicileCertificateData.spouse_nationality = spouseDetails.spouse_nationality ? spouseDetails.spouse_nationality : '';
                domicileCertificateData.spouse_born_place_state_text = spouseDetails.spouse_born_place_state_text ? spouseDetails.spouse_born_place_state_text : '';
                domicileCertificateData.spouse_born_place_district_text = spouseDetails.spouse_born_place_district_text ? spouseDetails.spouse_born_place_district_text : '';
                domicileCertificateData.spouse_born_place_village_text = spouseDetails.spouse_born_place_village_text ? spouseDetails.spouse_born_place_village_text : '';
                domicileCertificateData.spouse_native_place_state_text = spouseDetails.spouse_native_place_state_text ? spouseDetails.spouse_native_place_state_text : '';
                domicileCertificateData.spouse_native_place_district_text = spouseDetails.spouse_native_place_district_text ? spouseDetails.spouse_native_place_district_text : '';
                domicileCertificateData.spouse_native_place_village_text = spouseDetails.spouse_native_place_village_text ? spouseDetails.spouse_native_place_village_text : '';
                domicileCertificateData.spouse_occupation_text = applicantOccupationArray[spouseDetails.spouse_occupation] ? (spouseDetails.spouse_occupation == VALUE_TWELVE ? spouseDetails.spouse_other_occupation : applicantOccupationArray[spouseDetails.spouse_occupation]) : '';
                domicileCertificateData.spouse_aadhaar = spouseDetails.spouse_aadhaar ? spouseDetails.spouse_aadhaar : '';
                domicileCertificateData.spouse_election_no = spouseDetails.spouse_election_no ? spouseDetails.spouse_election_no : '';
            }
        }

        if (domicileCertificateData.constitution_artical == VALUE_ONE || domicileCertificateData.constitution_artical == VALUE_TWO || domicileCertificateData.constitution_artical == VALUE_THREE || domicileCertificateData.constitution_artical == VALUE_FOUR || domicileCertificateData.constitution_artical == VALUE_SEVEN) {
            domicileCertificateData.show_education = true;
        } else {
            domicileCertificateData.show_education_tbl = true;
        }

        if (domicileCertificateData.constitution_artical == VALUE_SEVEN && domicileCertificateData.business_type == VALUE_ONE)
            domicileCertificateData.show_business_tbl = true;
        if (domicileCertificateData.constitution_artical == VALUE_SEVEN && domicileCertificateData.business_type == VALUE_TWO)
            domicileCertificateData.show_service_tbl = true;
        domicileCertificateData.show_applicant_photo_doc = domicileCertificateData.applicant_photo != '' ? true : false;
        domicileCertificateData.show_birth_leaving_certy_doc = domicileCertificateData.birth_certi != '' ? true : false;
        domicileCertificateData.show_aadhar_card_doc = domicileCertificateData.aadhaar_card != '' ? true : false;
        domicileCertificateData.show_election_card_doc = domicileCertificateData.election_card != '' ? true : false;
        domicileCertificateData.show_leaving_certi_doc = domicileCertificateData.leaving_certi != '' ? true : false;
        domicileCertificateData.show_last_10year_proof_doc = domicileCertificateData.last_10year_proof != '' ? true : false;
        domicileCertificateData.show_gas_book_doc = domicileCertificateData.gas_book != '' ? true : false;
        domicileCertificateData.show_bank_book_doc = domicileCertificateData.bank_book != '' ? true : false;
        domicileCertificateData.show_noc_with_notary_doc = domicileCertificateData.noc_with_notary != '' ? true : false;
        domicileCertificateData.show_aggriment_with_notary_doc = domicileCertificateData.aggriment_with_notary != '' ? true : false;
        domicileCertificateData.show_house_tax_receipt_doc = domicileCertificateData.house_tax_receipt != '' ? true : false;
        domicileCertificateData.show_sale_deed_copy_doc = domicileCertificateData.sale_deed_copy != '' ? true : false;
        domicileCertificateData.show_minor_child_photo_doc = domicileCertificateData.minor_child_photo != '' ? true : false;
        domicileCertificateData.show_father_birth_certificate_doc = domicileCertificateData.father_birth_certificate != '' ? true : false;
        domicileCertificateData.show_father_election_card_doc = domicileCertificateData.father_election_card != '' ? true : false;
        domicileCertificateData.show_father_aadhar_card_doc = domicileCertificateData.father_aadhar_card != '' ? true : false;
        domicileCertificateData.show_father_death_proof_doc = domicileCertificateData.father_death_proof != '' ? true : false;
        domicileCertificateData.show_mother_birth_certificate_doc = domicileCertificateData.mother_birth_certificate != '' ? true : false;
        domicileCertificateData.show_mother_election_card_doc = domicileCertificateData.mother_election_card != '' ? true : false;
        domicileCertificateData.show_mother_aadhar_card_doc = domicileCertificateData.mother_aadhar_card != '' ? true : false;
        domicileCertificateData.show_mother_death_proof_doc = domicileCertificateData.mother_death_proof != '' ? true : false;
        domicileCertificateData.show_spouse_birth_certificate_doc = domicileCertificateData.spouse_birth_certificate != '' ? true : false;
        domicileCertificateData.show_spouse_election_card_doc = domicileCertificateData.spouse_election_card != '' ? true : false;
        domicileCertificateData.show_spouse_aadhar_card_doc = domicileCertificateData.spouse_aadhar_card != '' ? true : false;
        domicileCertificateData.show_spouse_death_proof_doc = domicileCertificateData.spouse_death_proof != '' ? true : false;
        domicileCertificateData.show_other_document_doc = domicileCertificateData.other_document != '' ? true : false;
        domicileCertificateData.com_addr_city = domicileCertificateData.com_addr_city ? domicileCertificateData.com_addr_city : '-';
        domicileCertificateData.per_addr_city = domicileCertificateData.per_addr_city ? domicileCertificateData.per_addr_city : '-';
        domicileCertificateData.father_city = fatherDetails.father_city ? fatherDetails.father_city : '-';
        domicileCertificateData.mother_city = fatherDetails.mother_city ? fatherDetails.mother_city : '-';
        domicileCertificateData.spouse_city = fatherDetails.spouse_city ? fatherDetails.spouse_city : '-';
        domicileCertificateData.election_no = domicileCertificateData.election_no ? domicileCertificateData.election_no : '-';
        domicileCertificateData.father_election_no = domicileCertificateData.father_election_no ? domicileCertificateData.father_election_no : '-';
        domicileCertificateData.mother_election_no = domicileCertificateData.mother_election_no ? domicileCertificateData.mother_election_no : '-';
        domicileCertificateData.spouse_election_no = domicileCertificateData.spouse_election_no ? domicileCertificateData.spouse_election_no : '-';
        domicileCertificateData.name_of_school = domicileCertificateData.name_of_school ? domicileCertificateData.name_of_school : '-';
        domicileCertificateData.aadhaar = domicileCertificateData.aadhaar ? domicileCertificateData.aadhaar : '-';
        domicileCertificateData.father_aadhaar = fatherDetails.father_aadhaar ? fatherDetails.father_aadhaar : '-';
        domicileCertificateData.mother_aadhaar = motherDetails.mother_aadhaar ? motherDetails.mother_aadhaar : '-';
        domicileCertificateData.spouse_aadhaar = spouseDetails.spouse_aadhaar ? spouseDetails.spouse_aadhaar : '-';
        domicileCertificateData.taluka_name = talukaArray[domicileCertificateData.district] ? talukaArray[domicileCertificateData.district] : '-';
        domicileCertificateData.show_declaration_btn = moduleType == VALUE_ONE ? true : (domicileCertificateData.declaration == VALUE_ONE ? true : false);
        domicileCertificateData.applicant_occupation_text = applicantOccupationArray[domicileCertificateData.occupation] ? (domicileCertificateData.occupation == VALUE_TWELVE ? domicileCertificateData.other_occupation : applicantOccupationArray[domicileCertificateData.occupation]) : '-';

        if (domicileCertificateData.applicant_education == VALUE_FIVE) {
            domicileCertificateData.applicant_education = domicileCertificateData.other_education_detail;
        } else {
            domicileCertificateData.applicant_education = educationTypeArray[domicileCertificateData.applicant_education] ? educationTypeArray[domicileCertificateData.applicant_education] : '-';
        }

        if (domicileCertificateData.constitution_artical == VALUE_FIVE || domicileCertificateData.constitution_artical == VALUE_FOUR) {
            domicileCertificateData.show_gaudian_data = true;
        }

        if (domicileCertificateData.constitution_artical == VALUE_FIVE || domicileCertificateData.constitution_artical == VALUE_SIX || domicileCertificateData.constitution_artical == VALUE_SEVEN) {
            domicileCertificateData.show_school_data = true;
        }

        if (domicileCertificateData.constitution_artical == VALUE_SEVEN) {
            domicileCertificateData.show_business_data = true;
        }

        if (domicileCertificateData.select_required_purpose != VALUE_FIVE && domicileCertificateData.select_required_purpose != VALUE_ZERO)
            domicileCertificateData.required_purpose = domicileCertificatePurposeArray[domicileCertificateData.select_required_purpose];
        domicileCertificateData.com_pincode = domicileCertificateData.constitution_artical == VALUE_ONE ? domicileCertificateData.pincode : domicileCertificateData.com_pincode;
        if (domicileCertificateData.status != VALUE_ZERO && domicileCertificateData.status != VALUE_ONE) {
            domicileCertificateData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(domicileViewTemplate(domicileCertificateData));
        resetCounter('declaration-numbering');
        if (domicileCertificateData.status != VALUE_ONE || domicileCertificateData.status != VALUE_ZERO) {
            if (domicileCertificateData.declaration == VALUE_ONE) {
                $('#declaration_for_dc').click();
            }
        }


        if (domicileCertificateData.constitution_artical == VALUE_FIVE || domicileCertificateData.constitution_artical == VALUE_SIX) {
            var educationData = JSON.parse(domicileCertificateData.applicant_education_details);
            var detailCnt = 1;
            $.each(educationData, function (index, edu) {
                var eduRow = '<tr><td class="text-center">' + detailCnt + '</td><td>' + edu.name_of_school + '</td>' +
                        '<td class="text-center">' + edu.class_standard + '</td>' +
                        '<td class="text-center">' + edu.admission_date + '</td>' +
                        '<td class="text-center">' + edu.leaving_date + '</td>' +
                        '<td class="text-center">' + edu.total_period_in_year + ' Year ' + edu.total_period_in_month + ' Month ' + edu.total_period_in_days + ' Days' + '</td>' +
                        '<td class="text-center">' + edu.edu_remarks + '</td></tr>';
                $('#education_container_for_dcview').append(eduRow);
                detailCnt++;
            });
        }
        if (domicileCertificateData.constitution_artical == VALUE_FIVE || domicileCertificateData.constitution_artical == VALUE_SIX || domicileCertificateData.constitution_artical == VALUE_SEVEN) {
            var residentialData = JSON.parse(domicileCertificateData.residential_details);
            var resiCnt = 1;
            $.each(residentialData, function (index, resi) {
                var resiRow = '<tr><td class="text-center">' + resiCnt + '</td><td>' + resi.resident_address + '</td>' +
                        '<td>' + typeOfResidentArray[resi.type_of_resident] + '</td>' +
                        '<td class="text-center">' + resi.resident_date + '</td>' +
                        '<td class="text-center">' + resi.resident_leaving_date + '</td>' +
                        '<td class="text-center">' + resi.resident_total_period_in_year + ' Year ' + resi.resident_total_period_in_month + ' Month ' + resi.resident_total_period_in_days + ' Days' + '</td>' +
                        '<td class="text-center">' + resi.resident_remarks + '</td></tr>';
                $('#residential_container_for_dcview').append(resiRow);
                resiCnt++;
            });
        }

        if (domicileCertificateData.constitution_artical == VALUE_SEVEN && domicileCertificateData.business_type == VALUE_ONE) {
            var businessData = JSON.parse(domicileCertificateData.business_details);
            var busCnt = 1;
            $.each(businessData, function (index, bus) {
                var busRow = '<tr><td class="text-center">' + busCnt + '</td><td>' + bus.business_name + '</td>' +
                        '<td class="text-center">' + bus.business_address + '</td>' +
                        '<td class="text-center">' + bus.business_type + '</td>' +
                        '<td class="text-center">' + bus.start_business_date + '</td>' +
                        '<td class="text-center">' + bus.end_business_date + '</td>' +
                        '<td class="text-center">' + bus.business_total_period_in_year + ' Year ' + bus.business_total_period_in_month + ' Month ' + bus.business_total_period_in_days + ' Days' + '</td>' +
                        '<td class="text-center">' + bus.business_remarks + '</td></tr>';
                $('#business_container_for_dcview').append(busRow);
                resiCnt++;
            });
        }
        if (domicileCertificateData.constitution_artical == VALUE_SEVEN && domicileCertificateData.business_type == VALUE_TWO) {
            var serviceData = JSON.parse(domicileCertificateData.service_details);
            var serCnt = 1;
            $.each(serviceData, function (index, ser) {
                var serRow = '<tr><td class="text-center">' + serCnt + '</td><td>' + ser.company_name + '</td>' +
                        '<td class="text-center">' + ser.company_address + '</td>' +
                        '<td class="text-center">' + ser.joining_date + '</td>' +
                        '<td class="text-center">' + ser.reliving_date + '</td>' +
                        '<td class="text-center">' + ser.service_total_period_in_year + ' Year ' + ser.service_total_period_in_month + ' Month ' + ser.service_total_period_in_days + ' Days' + '</td>' +
                        '<td class="text-center">' + ser.service_remarks + '</td></tr>';
                $('#service_container_for_dcview').append(serRow);
                resiCnt++;
            });
        }
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_dcview').click();
            }, 500);
        }
    },
    checkValidationForDomicile: function (domicileData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!domicileData.district) {
            return getBasicMessageAndFieldJSONArray('district', districtValidationMessage);
        }
        if (!domicileData.village_name) {
            return getBasicMessageAndFieldJSONArray('village_name_for_dc', villageNameValidationMessage);
        }
        if (!domicileData.name_of_applicant) {
            return getBasicMessageAndFieldJSONArray('name_of_applicant_for_dc', applicantNameValidationMessage);
        }
        if (domicileData.constitution_artical == VALUE_FOUR || domicileData.constitution_artical == VALUE_FIVE) {
            if (!domicileData.relationship_of_applicant) {
                return getBasicMessageAndFieldJSONArray('relationship_of_applicant_for_dc', applicantRelationshipValidationMessage);
            }
            if (!domicileData.guardian_address) {
                return getBasicMessageAndFieldJSONArray('guardian_address_for_dc', guardianAddressValidationMessage);
            }
            if (!domicileData.guardian_mobile_no) {
                return getBasicMessageAndFieldJSONArray('guardian_mobile_no_for_dc', mobileValidationMessage);
            }
            if (!domicileData.guardian_aadhaar) {
                return getBasicMessageAndFieldJSONArray('guardian_aadhaar_for_dc', invalidAadharNumberValidationMessage);
            }
            if (!domicileData.minor_child_name) {
                return getBasicMessageAndFieldJSONArray('minor_child_name_for_dc', minorChildNameValidationMessage);
            }
        }
        if (!domicileData.com_addr_house_no) {
            return getBasicMessageAndFieldJSONArray('com_addr_house_no_for_dc', houseNoValidationMessage);
        }
        if (!domicileData.com_addr_street) {
            return getBasicMessageAndFieldJSONArray('com_addr_street_for_dc', streetValidationMessage);
        }
        if (!domicileData.com_addr_village_dmc_ward) {
            return getBasicMessageAndFieldJSONArray('com_addr_village_dmc_ward_for_dc', villageNameValidationMessage);
        }
        if (!domicileData.com_addr_city) {
            return getBasicMessageAndFieldJSONArray('com_addr_city_for_dc', selectCityValidationMessage);
        }
        if (domicileData.constitution_artical == VALUE_ONE) {
            if (!domicileData.pincode) {
                return getBasicMessageAndFieldJSONArray('pincode_for_dc', pincodeValidationMessage);
            }
        }
        if (domicileData.constitution_artical != VALUE_ONE) {
            if (!domicileData.com_pincode) {
                return getBasicMessageAndFieldJSONArray('com_pincode_for_dc', pincodeValidationMessage);
            }
        }
        if (domicileData.constitution_artical != VALUE_ONE) {
            if (!domicileData.per_addr_house_no) {
                return getBasicMessageAndFieldJSONArray('per_addr_house_no_for_dc', houseNoValidationMessage);
            }
            if (!domicileData.per_addr_street) {
                return getBasicMessageAndFieldJSONArray('per_addr_street_for_dc', streetValidationMessage);
            }
            if (!domicileData.per_addr_village_dmc_ward) {
                return getBasicMessageAndFieldJSONArray('per_addr_village_dmc_ward_for_dc', villageNameValidationMessage);
            }
            if (!domicileData.per_addr_city) {
                return getBasicMessageAndFieldJSONArray('per_addr_city_for_dc', selectCityValidationMessage);
            }
            if (domicileData.constitution_artical != VALUE_ONE) {
                if (!domicileData.per_pincode) {
                    return getBasicMessageAndFieldJSONArray('per_pincode_for_dc', pincodeValidationMessage);
                }
            }
        }
        if (!domicileData.mobile_number) {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_dc', mobileValidationMessage);
        }
        if (!domicileData.applicant_nationality) {
            return getBasicMessageAndFieldJSONArray('applicant_nationality_for_dc', applicantNationalityValidationMessage);
        }
        if (!domicileData.aadhaar) {
            return getBasicMessageAndFieldJSONArray('aadhaar_for_dc', invalidAadharNumberValidationMessage);
        }
        if (!domicileData.applicant_dob) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_dc', birthDateValidationMessage);
        }
        if (!domicileData.applicant_age) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_dc', applicantAgeValidationMessage);
        }
        if (domicileData.constitution_artical != VALUE_FOUR && domicileData.constitution_artical != VALUE_FIVE) {
            if (domicileData.applicant_age >= 25) {
                if (!domicileData.election_no) {
                    return getBasicMessageAndFieldJSONArray('election_no_for_dc', electionNumberValidationMessage);
                }
            }
        }
        if (!domicileData.born_place_state) {
            return getBasicMessageAndFieldJSONArray('born_place_state_for_dc', selectStateValidationMessage);
        }
        if (!domicileData.born_place_district) {
            return getBasicMessageAndFieldJSONArray('born_place_district_for_dc', selectDistrictValidationMessage);
        }
        if (!domicileData.born_place_village) {
            return getBasicMessageAndFieldJSONArray('born_place_village_for_dc', selectVillageValidationMessage);
        }
        if (!domicileData.native_place_state) {
            return getBasicMessageAndFieldJSONArray('native_place_state_for_dc', selectStateValidationMessage);
        }
        if (!domicileData.native_place_district) {
            return getBasicMessageAndFieldJSONArray('native_place_district_for_dc', selectDistrictValidationMessage);
        }
        if (!domicileData.native_place_village) {
            return getBasicMessageAndFieldJSONArray('native_place_village_for_dc', selectVillageValidationMessage);
        }
        if (!domicileData.gender_for_dc) {
            $('#gender_for_dc_1').focus();
            return getBasicMessageAndFieldJSONArray('gender_for_dc', genderValidationMessage);
        }
        if ((domicileData.constitution_artical != VALUE_FOUR && domicileData.constitution_artical != VALUE_FIVE) && (domicileData.gender_for_dc != VALUE_THREE && domicileData.gender_for_dc != VALUE_FOUR)) {
            if (!domicileData.marital_status_for_dc) {
                $('#marital_status_for_dc_1').focus();
                return getBasicMessageAndFieldJSONArray('marital_status_for_dc', maritalStatusValidationMessage);
            }
        }
        if (!domicileData.nearest_police_station) {
            return getBasicMessageAndFieldJSONArray('nearest_police_station_for_dc', nearestPoliceStationValidationMessage);
        }
        if (!domicileData.nearest_post_office) {
            return getBasicMessageAndFieldJSONArray('nearest_post_office_for_dc', nearestPostOfficeValidationMessage);
        }
        if (domicileData.constitution_artical != VALUE_FOUR && domicileData.constitution_artical != VALUE_FIVE) {
            if (!domicileData.occupation) {
                return getBasicMessageAndFieldJSONArray('occupation_for_dc', occupationValidationMessage);
            }
            if (domicileData.occupation == VALUE_TWELVE) {
                if (!domicileData.other_occupation) {
                    return getBasicMessageAndFieldJSONArray('other_occupation_for_dc', otherOccupationValidationMessage);
                }
            }
        }
        if (domicileData.constitution_artical != VALUE_FIVE && domicileData.constitution_artical != VALUE_SIX) {
            if (!domicileData.applicant_education) {
                return getBasicMessageAndFieldJSONArray('applicant_education_for_dc', applicantEducationValidationMessage);
            }
            if (domicileData.applicant_education == VALUE_FIVE) {
                if (!domicileData.other_education_detail) {
                    return getBasicMessageAndFieldJSONArray('other_education_detail_for_dc', applicantEducationValidationMessage);
                }
            }
            if (!domicileData.name_of_school) {
                return getBasicMessageAndFieldJSONArray('name_of_school_for_dc', schoolNameValidationMessage);
            }
        }
        if ((domicileData.constitution_artical == VALUE_TWO || domicileData.constitution_artical == VALUE_THREE || domicileData.constitution_artical == VALUE_SEVEN) || ((domicileData.constitution_artical == VALUE_ONE || domicileData.constitution_artical == VALUE_SIX) && domicileData.gender_for_dc != VALUE_TWO || (domicileData.marital_status_for_dc != VALUE_ONE && domicileData.marital_status_for_dc != VALUE_THREE)) && (domicileData.gender_for_dc != VALUE_THREE && domicileData.gender_for_dc != VALUE_FOUR)) {
            if (!domicileData.father_alive_for_dc) {
                $('#father_alive_for_dc_1').focus();
                return getBasicMessageAndFieldJSONArray('father_alive_for_dc', selectanyoneValidationMessage);
            }
            if (!domicileData.father_name) {
                return getBasicMessageAndFieldJSONArray('father_name_for_dc', fatherNameValidationMessage);
            }
            if (!domicileData.father_nationality) {
                return getBasicMessageAndFieldJSONArray('father_nationality_for_dc', applicantNationalityValidationMessage);
            }
            if (!domicileData.father_born_place_state) {
                return getBasicMessageAndFieldJSONArray('father_born_place_state_for_dc', selectStateValidationMessage);
            }
            if (!domicileData.father_born_place_district) {
                return getBasicMessageAndFieldJSONArray('father_born_place_district_for_dc', selectDistrictValidationMessage);
            }
            if (!domicileData.father_born_place_village) {
                return getBasicMessageAndFieldJSONArray('father_born_place_village_for_dc', selectVillageValidationMessage);
            }
            if (!domicileData.father_born_pincode) {
                return getBasicMessageAndFieldJSONArray('father_born_pincode_for_dc', pincodeValidationMessage);
            }
            if (!domicileData.father_native_place_state) {
                return getBasicMessageAndFieldJSONArray('father_native_place_state_for_dc', selectStateValidationMessage);
            }
            if (!domicileData.father_native_place_district) {
                return getBasicMessageAndFieldJSONArray('father_native_place_district_for_dc', selectDistrictValidationMessage);
            }
            if (!domicileData.father_native_place_village) {
                return getBasicMessageAndFieldJSONArray('father_native_place_village_for_dc', selectVillageValidationMessage);
            }
            if (!domicileData.father_native_pincode) {
                return getBasicMessageAndFieldJSONArray('father_native_pincode_for_dc', pincodeValidationMessage);
            }
            if (domicileData.father_occupation == VALUE_TWELVE) {
                if (!domicileData.father_other_occupation) {
                    return getBasicMessageAndFieldJSONArray('father_other_occupation_for_dc', otherOccupationValidationMessage);
                }
            }
            if (!domicileData.mother_alive_for_dc) {
                $('#mother_alive_for_dc_1').focus();
                return getBasicMessageAndFieldJSONArray('mother_alive_for_dc', selectanyoneValidationMessage);
            }
            if (!domicileData.mother_name) {
                return getBasicMessageAndFieldJSONArray('mother_name_for_dc', motherNameValidationMessage);
            }
            if (!domicileData.mother_nationality) {
                return getBasicMessageAndFieldJSONArray('mother_nationality_for_dc', applicantNationalityValidationMessage);
            }
            if (!domicileData.mother_born_place_state) {
                return getBasicMessageAndFieldJSONArray('mother_born_place_state_for_dc', selectStateValidationMessage);
            }
            if (!domicileData.mother_born_place_district) {
                return getBasicMessageAndFieldJSONArray('mother_born_place_district_for_dc', selectDistrictValidationMessage);
            }
            if (!domicileData.mother_born_place_village) {
                return getBasicMessageAndFieldJSONArray('mother_born_place_village_for_dc', selectVillageValidationMessage);
            }
            if (!domicileData.mother_born_pincode) {
                return getBasicMessageAndFieldJSONArray('mother_born_pincode_for_dc', pincodeValidationMessage);
            }
            if (!domicileData.mother_native_place_state) {
                return getBasicMessageAndFieldJSONArray('mother_native_place_state_for_dc', selectStateValidationMessage);
            }
            if (!domicileData.mother_native_place_district) {
                return getBasicMessageAndFieldJSONArray('mother_native_place_district_for_dc', selectDistrictValidationMessage);
            }
            if (!domicileData.mother_native_place_village) {
                return getBasicMessageAndFieldJSONArray('mother_native_place_village_for_dc', selectVillageValidationMessage);
            }
            if (!domicileData.mother_native_pincode) {
                return getBasicMessageAndFieldJSONArray('mother_native_pincode_for_dc', pincodeValidationMessage);
            }
            if (domicileData.mother_occupation == VALUE_TWELVE) {
                if (!domicileData.mother_other_occupation) {
                    return getBasicMessageAndFieldJSONArray('mother_other_occupation_for_dc', otherOccupationValidationMessage);
                }
            }
        }
        if ((domicileData.marital_status_for_dc == VALUE_ONE || domicileData.marital_status_for_dc == VALUE_THREE) && (domicileData.constitution_artical != VALUE_FOUR && domicileData.constitution_artical != VALUE_FIVE)) {

            if (!domicileData.spouse_name) {
                return getBasicMessageAndFieldJSONArray('spouse_name_for_dc', spouseNameValidationMessage);
            }
            if (!domicileData.spouse_nationality) {
                return getBasicMessageAndFieldJSONArray('spouse_nationality_for_dc', applicantNationalityValidationMessage);
            }
            if (!domicileData.spouse_born_place_state) {
                return getBasicMessageAndFieldJSONArray('spouse_born_place_state_for_dc', selectStateValidationMessage);
            }
            if (!domicileData.spouse_born_place_district) {
                return getBasicMessageAndFieldJSONArray('spouse_born_place_district_for_dc', selectDistrictValidationMessage);
            }
            if (!domicileData.spouse_born_place_village) {
                return getBasicMessageAndFieldJSONArray('spouse_born_place_village_for_dc', selectVillageValidationMessage);
            }
            if (!domicileData.spouse_born_pincode) {
                return getBasicMessageAndFieldJSONArray('spouse_born_pincode_for_dc', pincodeValidationMessage);
            }
            if (!domicileData.spouse_native_place_state) {
                return getBasicMessageAndFieldJSONArray('spouse_native_place_state_for_dc', selectStateValidationMessage);
            }
            if (!domicileData.spouse_native_place_district) {
                return getBasicMessageAndFieldJSONArray('spouse_native_place_district_for_dc', selectDistrictValidationMessage);
            }
            if (!domicileData.spouse_native_place_village) {
                return getBasicMessageAndFieldJSONArray('spouse_native_place_village_for_dc', selectVillageValidationMessage);
            }
            if (!domicileData.spouse_native_pincode) {
                return getBasicMessageAndFieldJSONArray('spouse_native_pincode_for_dc', pincodeValidationMessage);
            }
            if (domicileData.spouse_occupation == VALUE_TWELVE) {
                if (!domicileData.spouse_other_occupation) {
                    return getBasicMessageAndFieldJSONArray('spouse_other_occupation_for_dc', otherOccupationValidationMessage);
                }
            }
        }
        if (domicileData.constitution_artical != VALUE_TWO && domicileData.constitution_artical != VALUE_FOUR && domicileData.constitution_artical != VALUE_FIVE && domicileData.constitution_artical != VALUE_SIX && domicileData.constitution_artical != VALUE_SEVEN) {
            if (!domicileData.residing_year) {
                return getBasicMessageAndFieldJSONArray('residing_year_for_dc', residingYearValidationMessage);
            }
            // if (domicileData.residing_year < 10) {
            //     return getBasicMessageAndFieldJSONArray('residing_year_for_dc', residingYearNotValidValidationMessage);
            // }
            if (!domicileData.residing_month) {
                return getBasicMessageAndFieldJSONArray('residing_month_for_dc', residingMonthValidationMessage);
            }
            if (!domicileData.residing_days) {
                return getBasicMessageAndFieldJSONArray('residing_days_for_dc', residingDaysValidationMessage);
            }
        }
        // if (domicileData.constitution_artical == VALUE_FIVE || domicileData.constitution_artical == VALUE_SIX || domicileData.constitution_artical == VALUE_SEVEN) {
        //     var resident_period = domicileData.resident_total_period;
        //     var resarr = resident_period.split(' ');
        //     var resident_year = resarr[0];
        //     if (resident_year < 10) {
        //         return getBasicMessageAndFieldJSONArray('resident_total_period_for_dc', residingYearNotValidValidationMessage);
        //     }
        // }
        if (domicileData.constitution_artical == VALUE_SEVEN) {
            if (!domicileData.business_type) {
                return getBasicMessageAndFieldJSONArray('business_type_for_dc', businessTypeValidationMessage);
            }
        }
        if (domicileData.constitution_artical == VALUE_ONE) {
            if (!domicileData.select_required_purpose) {
                return getBasicMessageAndFieldJSONArray('select_required_purpose_for_dc', purposeofDomicileValidationMessage);
            }
            if (domicileData.select_required_purpose == VALUE_FIVE) {
                if (!domicileData.other_required_purpose) {
                    return getBasicMessageAndFieldJSONArray('other_required_purpose_for_dc', purposeofDomicileValidationMessage);
                }
            }
        } else {
            if (!domicileData.required_purpose) {
                return getBasicMessageAndFieldJSONArray('required_purpose_for_dc', purposeofDomicileValidationMessage);
            }
        }
        return '';
    },
    askForSubmitDomicile: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Domicile.listview.submitDomicile(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitDomicile: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var domicileData = $('#domicile_form').serializeFormJSON();
        var bornPlaceStateText = jQuery("#born_place_state_for_dc option:selected").text();
        var bornPlaceDistrictText = jQuery("#born_place_district_for_dc option:selected").text();
        var bornPlaceVillageText = jQuery("#born_place_village_for_dc option:selected").text();
        var nativePlaceStateText = jQuery("#native_place_state_for_dc option:selected").text();
        var nativePlaceDistrictText = jQuery("#native_place_district_for_dc option:selected").text();
        var nativePlaceVillageText = jQuery("#native_place_village_for_dc option:selected").text();
        var fBornPlaceStateText = jQuery("#father_born_place_state_for_dc option:selected").text();
        var fBornPlaceDistrictText = jQuery("#father_born_place_district_for_dc option:selected").text();
        var fBornPlaceVillageText = jQuery("#father_born_place_village_for_dc option:selected").text();
        var fNativePlaceStateText = jQuery("#father_native_place_state_for_dc option:selected").text();
        var fNativePlaceDistrictText = jQuery("#father_native_place_district_for_dc option:selected").text();
        var fNtivePlaceVillageText = jQuery("#father_native_place_village_for_dc option:selected").text();
        var mBornPlaceStateText = jQuery("#mother_born_place_state_for_dc option:selected").text();
        var mBornPlaceDistrictText = jQuery("#mother_born_place_district_for_dc option:selected").text();
        var mBornPlaceVillageText = jQuery("#mother_born_place_village_for_dc option:selected").text();
        var mNativePlaceStateText = jQuery("#mother_native_place_state_for_dc option:selected").text();
        var mNativePlaceDistrictText = jQuery("#mother_native_place_district_for_dc option:selected").text();
        var mNtivePlaceVillageText = jQuery("#mother_native_place_village_for_dc option:selected").text();
        var sBornPlaceStateText = jQuery("#spouse_born_place_state_for_dc option:selected").text();
        var sBornPlaceDistrictText = jQuery("#spouse_born_place_district_for_dc option:selected").text();
        var sBornPlaceVillageText = jQuery("#spouse_born_place_village_for_dc option:selected").text();
        var sNativePlaceStateText = jQuery("#spouse_native_place_state_for_dc option:selected").text();
        var sNativePlaceDistrictText = jQuery("#spouse_native_place_district_for_dc option:selected").text();
        var sNtivePlaceVillageText = jQuery("#spouse_native_place_village_for_dc option:selected").text();
        var validationData = that.checkValidationForDomicile(domicileData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('domicile-' + validationData.field, validationData.message);
            return false;
        }

        if (domicileData.constitution_artical == VALUE_FIVE || domicileData.constitution_artical == VALUE_SIX) {
            var applicantEducationItem = [];
            var applicantEducationValidation = false;
            $('.applicant_education_info').each(function () {
                var cnt1 = $(this).find('.temp_cnt').val();
                var applicantEducationInfo = {};
                var nameOfSchool = $('#name_of_school_' + cnt1).val();
                if (nameOfSchool == '' || nameOfSchool == null) {
                    $('#name_of_school_' + cnt1).focus();
                    validationMessageShow('domicile-name_of_school_' + cnt1, schoolNameValidationMessage);
                    applicantEducationValidation = true;
                    return false;
                }
                applicantEducationInfo.name_of_school = nameOfSchool;

                var classStandard = $('#class_standard_' + cnt1).val();
                if (classStandard == '' || classStandard == null) {
                    $('#class_standard_' + cnt1).focus();
                    validationMessageShow('domicile-class_standard_' + cnt1, classStandardValidationMessage);
                    applicantEducationValidation = true;
                    return false;
                }
                applicantEducationInfo.class_standard = classStandard;

                var admissionDate = $('#admission_date_' + cnt1).val();
                if (admissionDate == '' || admissionDate == null) {
                    $('#admission_date_' + cnt1).focus();
                    validationMessageShow('domicile-admission_date_' + cnt1, dateValidationMessage);
                    applicantEducationValidation = true;
                    return false;
                }
                applicantEducationInfo.admission_date = admissionDate;

                var leavingDate = $('#leaving_date_' + cnt1).val();
                if (leavingDate == '' || leavingDate == null) {
                    $('#leaving_date_' + cnt1).focus();
                    validationMessageShow('domicile-leaving_date_' + cnt1, dateValidationMessage);
                    applicantEducationValidation = true;
                    return false;
                }
                applicantEducationInfo.leaving_date = leavingDate;

                var totalPeriodInYear = $('#total_period_in_year_' + cnt1).val();
                if (totalPeriodInYear == '' || totalPeriodInYear == null) {
                    $('#total_period_in_year_' + cnt1).focus();
                    validationMessageShow('domicile-total_period_in_year_' + cnt1, totalPeriodValidationMessage);
                    applicantEducationValidation = true;
                    return false;
                }
                applicantEducationInfo.total_period_in_year = totalPeriodInYear;

                var totalPeriodInMonth = $('#total_period_in_month_' + cnt1).val();
                if (totalPeriodInMonth == '' || totalPeriodInMonth == null) {
                    $('#total_period_in_month_' + cnt1).focus();
                    validationMessageShow('domicile-total_period_in_month_' + cnt1, totalPeriodValidationMessage);
                    applicantEducationValidation = true;
                    return false;
                }
                applicantEducationInfo.total_period_in_month = totalPeriodInMonth;

                var totalPeriodInDays = $('#total_period_in_days_' + cnt1).val();
                if (totalPeriodInDays == '' || totalPeriodInDays == null) {
                    $('#total_period_in_days_' + cnt1).focus();
                    validationMessageShow('domicile-total_period_in_days_' + cnt1, totalPeriodValidationMessage);
                    applicantEducationValidation = true;
                    return false;
                }
                applicantEducationInfo.total_period_in_days = totalPeriodInDays;

                var eduRemarks = $('#edu_remarks_' + cnt1).val();
                if (eduRemarks == '' || eduRemarks == null) {
                    $('#edu_remarks_' + cnt1).focus();
                    validationMessageShow('domicile-edu_remarks_' + cnt1, remarksValidationMessage);
                    applicantEducationValidation = true;
                    return false;
                }
                applicantEducationInfo.edu_remarks = eduRemarks;
                applicantEducationItem.push(applicantEducationInfo);
            });
            if (applicantEducationValidation) {
                return false;
            }

        }

        if (domicileData.constitution_artical == VALUE_SEVEN) {
            if (domicileData.business_type == VALUE_ONE) {
                var businessItem = [];
                var businessValidation = false;
                $('.business_info').each(function () {
                    var cnt1 = $(this).find('.temp_cnt').val();
                    var businessInfo = {};
                    var businessName = $('#business_name_' + cnt1).val();
                    if (businessName == '' || businessName == null) {
                        $('#business_name_' + cnt1).focus();
                        validationMessageShow('domicile-business_name_' + cnt1, businessNameValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    businessInfo.business_name = businessName;

                    var businessAddress = $('#business_address_' + cnt1).val();
                    if (businessAddress == '' || businessAddress == null) {
                        $('#business_address_' + cnt1).focus();
                        validationMessageShow('domicile-business_address_' + cnt1, addressValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    businessInfo.business_address = businessAddress;

                    var businessType = $('#business_type_' + cnt1).val();
                    if (businessType == '' || businessType == null) {
                        $('#business_type_' + cnt1).focus();
                        validationMessageShow('domicile-business_type_' + cnt1, businessTypeValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    businessInfo.business_type = businessType;

                    var startBusinessDate = $('#start_business_date_' + cnt1).val();
                    if (startBusinessDate == '' || startBusinessDate == null) {
                        $('#start_business_date_' + cnt1).focus();
                        validationMessageShow('domicile-start_business_date_' + cnt1, dateValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    businessInfo.start_business_date = startBusinessDate;

                    var endBusinessDate = $('#end_business_date_' + cnt1).val();
                    if (endBusinessDate == '' || endBusinessDate == null) {
                        $('#end_business_date_' + cnt1).focus();
                        validationMessageShow('domicile-end_business_date_' + cnt1, dateValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    var end_business_date_components = endBusinessDate.split("-");
                    var endBusinessDay = end_business_date_components[0];
                    var endBusinessMonth = end_business_date_components[1];
                    var endBusinessYear = end_business_date_components[2];
                    var endBusinessEndDate = new Date(endBusinessYear, endBusinessMonth - 1, endBusinessDay);
                    if (endBusinessEndDate > new Date()) {
                        $('#end_business_date_' + cnt1).focus();
                        validationMessageShow('domicile-end_business_date_' + cnt1, futureDateValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    businessInfo.end_business_date = endBusinessDate;

                    var businessTotalPeriodInYear = $('#business_total_period_in_year_' + cnt1).val();
                    if (businessTotalPeriodInYear == '' || businessTotalPeriodInYear == null) {
                        $('#business_total_period_in_year_' + cnt1).focus();
                        validationMessageShow('domicile-business_total_period_in_year_' + cnt1, totalPeriodValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    businessInfo.business_total_period_in_year = businessTotalPeriodInYear;

                    var businessTotalPeriodInMonth = $('#business_total_period_in_month_' + cnt1).val();
                    if (businessTotalPeriodInMonth == '' || businessTotalPeriodInMonth == null) {
                        $('#business_total_period_in_month_' + cnt1).focus();
                        validationMessageShow('domicile-business_total_period_in_month_' + cnt1, totalPeriodValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    businessInfo.business_total_period_in_month = businessTotalPeriodInMonth;

                    var businessTotalPeriodInDays = $('#business_total_period_in_days_' + cnt1).val();
                    if (businessTotalPeriodInDays == '' || businessTotalPeriodInDays == null) {
                        $('#business_total_period_in_days_' + cnt1).focus();
                        validationMessageShow('domicile-business_total_period_in_days_' + cnt1, totalPeriodValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    businessInfo.business_total_period_in_days = businessTotalPeriodInDays;

                    var businessRemarks = $('#business_remarks_' + cnt1).val();
                    if (businessRemarks == '' || businessRemarks == null) {
                        $('#business_remarks_' + cnt1).focus();
                        validationMessageShow('domicile-business_remarks_' + cnt1, remarksValidationMessage);
                        businessValidation = true;
                        return false;
                    }
                    businessInfo.business_remarks = businessRemarks;
                    businessItem.push(businessInfo);
                });
                if (businessValidation) {
                    return false;
                }
            }
            if (domicileData.business_type == VALUE_TWO) {
                var serviceItem = [];
                var serviceValidation = false;
                $('.service_info').each(function () {
                    var cnt1 = $(this).find('.temp_cnt').val();
                    var serviceInfo = {};
                    var companyName = $('#company_name_' + cnt1).val();
                    if (companyName == '' || companyName == null) {
                        $('#company_name_' + cnt1).focus();
                        validationMessageShow('domicile-company_name_' + cnt1, companyNameValidationMessage);
                        serviceValidation = true;
                        return false;
                    }
                    serviceInfo.company_name = companyName;

                    var companyAddress = $('#company_address_' + cnt1).val();
                    if (companyAddress == '' || companyAddress == null) {
                        $('#company_address_' + cnt1).focus();
                        validationMessageShow('domicile-company_address_' + cnt1, addressValidationMessage);
                        serviceValidation = true;
                        return false;
                    }
                    serviceInfo.company_address = companyAddress;

                    var joiningDate = $('#joining_date_' + cnt1).val();
                    if (joiningDate == '' || joiningDate == null) {
                        $('#joining_date_' + cnt1).focus();
                        validationMessageShow('domicile-joining_date_' + cnt1, dateValidationMessage);
                        serviceValidation = true;
                        return false;
                    }
                    serviceInfo.joining_date = joiningDate;

                    var relivingDate = $('#reliving_date_' + cnt1).val();
                    if (relivingDate == '' || relivingDate == null) {
                        $('#reliving_date_' + cnt1).focus();
                        validationMessageShow('domicile-reliving_date_' + cnt1, dateValidationMessage);
                        serviceValidation = true;
                        return false;
                    }
                    var reliving_date_components = relivingDate.split("-");
                    var relivingDay = reliving_date_components[0];
                    var relivingMonth = reliving_date_components[1];
                    var relivingYear = reliving_date_components[2];
                    var relivingEndDate = new Date(relivingYear, relivingMonth - 1, relivingDay);
                    if (relivingEndDate > new Date()) {
                        $('#reliving_date_' + cnt1).focus();
                        validationMessageShow('domicile-reliving_date_' + cnt1, futureDateValidationMessage);
                        serviceValidation = true;
                        return false;
                    }
                    serviceInfo.reliving_date = relivingDate;

                    var serviceTotalPeriodInYear = $('#service_total_period_in_year_' + cnt1).val();
                    if (serviceTotalPeriodInYear == '' || serviceTotalPeriodInYear == null) {
                        $('#service_total_period_in_year_' + cnt1).focus();
                        validationMessageShow('domicile-service_total_period_in_year_' + cnt1, totalPeriodValidationMessage);
                        serviceValidation = true;
                        return false;
                    }
                    serviceInfo.service_total_period_in_year = serviceTotalPeriodInYear;

                    var serviceTotalPeriodInMonth = $('#service_total_period_in_month_' + cnt1).val();
                    if (serviceTotalPeriodInMonth == '' || serviceTotalPeriodInMonth == null) {
                        $('#service_total_period_in_month_' + cnt1).focus();
                        validationMessageShow('domicile-service_total_period_in_month_' + cnt1, totalPeriodValidationMessage);
                        serviceValidation = true;
                        return false;
                    }
                    serviceInfo.service_total_period_in_month = serviceTotalPeriodInMonth;

                    var serviceTotalPeriodInDays = $('#service_total_period_in_days_' + cnt1).val();
                    if (serviceTotalPeriodInDays == '' || serviceTotalPeriodInDays == null) {
                        $('#service_total_period_in_days_' + cnt1).focus();
                        validationMessageShow('domicile-service_total_period_in_days_' + cnt1, totalPeriodValidationMessage);
                        serviceValidation = true;
                        return false;
                    }
                    serviceInfo.service_total_period_in_days = serviceTotalPeriodInDays;

                    var serviceRemarks = $('#service_remarks_' + cnt1).val();
                    if (serviceRemarks == '' || serviceRemarks == null) {
                        $('#service_remarks_' + cnt1).focus();
                        validationMessageShow('domicile-service_remarks_' + cnt1, remarksValidationMessage);
                        serviceValidation = true;
                        return false;
                    }
                    serviceInfo.service_remarks = serviceRemarks;
                    serviceItem.push(serviceInfo);
                });
                if (serviceValidation) {
                    return false;
                }
            }
        }

        if (domicileData.constitution_artical == VALUE_FIVE || domicileData.constitution_artical == VALUE_SIX || domicileData.constitution_artical == VALUE_SEVEN) {
            var residentialItem = [];
            var residentialValidation = false;
            $('.residential_info').each(function () {
                var cnt1 = $(this).find('.temp_cnt').val();
                var residentialInfo = {};
                var residentAddress = $('#resident_address_' + cnt1).val();
                if (residentAddress == '' || residentAddress == null) {
                    $('#resident_address_' + cnt1).focus();
                    validationMessageShow('domicile-resident_address_' + cnt1, addressValidationMessage);
                    residentialValidation = true;
                    return false;
                }
                residentialInfo.resident_address = residentAddress;

                var residentType = $('#type_of_resident_' + cnt1).val();
                if (residentType == '' || residentType == null) {
                    $('#type_of_resident_' + cnt1).focus();
                    validationMessageShow('domicile-type_of_resident_' + cnt1, residentTypeValidationMessage);
                    residentialValidation = true;
                    return false;
                }
                residentialInfo.type_of_resident = residentType;

                var residentDate = $('#resident_date_' + cnt1).val();
                if (residentDate == '' || residentDate == null) {
                    $('#resident_date_' + cnt1).focus();
                    validationMessageShow('domicile-resident_date_' + cnt1, dateValidationMessage);
                    residentialValidation = true;
                    return false;
                }
                residentialInfo.resident_date = residentDate;

                var residentLeavingDate = $('#resident_leaving_date_' + cnt1).val();
                if (residentLeavingDate == '' || residentLeavingDate == null) {
                    $('#resident_leaving_date_' + cnt1).focus();
                    validationMessageShow('domicile-resident_leaving_date_' + cnt1, dateValidationMessage);
                    residentialValidation = true;
                    return false;
                }
                var date_components = residentLeavingDate.split("-");
                var residentLeavingDay = date_components[0];
                var residentLeavingMonth = date_components[1];
                var residentLeavingYear = date_components[2];
                var residentLeavingEndDate = new Date(residentLeavingYear, residentLeavingMonth - 1, residentLeavingDay);
                if (residentLeavingEndDate > new Date()) {
                    $('#resident_leaving_date_' + cnt1).focus();
                    validationMessageShow('domicile-resident_leaving_date_' + cnt1, futureDateValidationMessage);
                    residentialValidation = true;
                    return false;
                }
                residentialInfo.resident_leaving_date = residentLeavingDate;

                var residentTotalPeriodInYear = $('#resident_total_period_in_year_' + cnt1).val();
                if (residentTotalPeriodInYear == '' || residentTotalPeriodInYear == null) {
                    $('#resident_total_period_in_year_' + cnt1).focus();
                    validationMessageShow('domicile-resident_total_period_in_year_' + cnt1, totalPeriodValidationMessage);
                    residentialValidation = true;
                    return false;
                }
                residentialInfo.resident_total_period_in_year = residentTotalPeriodInYear;

                var residentTotalPeriodInMonth = $('#resident_total_period_in_month_' + cnt1).val();
                if (residentTotalPeriodInMonth == '' || residentTotalPeriodInMonth == null) {
                    $('#resident_total_period_in_month_' + cnt1).focus();
                    validationMessageShow('domicile-resident_total_period_in_month_' + cnt1, totalPeriodValidationMessage);
                    residentialValidation = true;
                    return false;
                }
                residentialInfo.resident_total_period_in_month = residentTotalPeriodInMonth;

                var residentTotalPeriodInDays = $('#resident_total_period_in_days_' + cnt1).val();
                if (residentTotalPeriodInDays == '' || residentTotalPeriodInDays == null) {
                    $('#resident_total_period_in_days_' + cnt1).focus();
                    validationMessageShow('domicile-resident_total_period_in_days_' + cnt1, totalPeriodValidationMessage);
                    residentialValidation = true;
                    return false;
                }
                residentialInfo.resident_total_period_in_days = residentTotalPeriodInDays;

                var residentRemarks = $('#resident_remarks_' + cnt1).val();
                if (residentRemarks == '' || residentRemarks == null) {
                    $('#resident_remarks_' + cnt1).focus();
                    validationMessageShow('domicile-resident_remarks_' + cnt1, remarksValidationMessage);
                    residentialValidation = true;
                    return false;
                }
                residentialInfo.resident_remarks = residentRemarks;
                residentialItem.push(residentialInfo);
            });
            if (residentialValidation) {
                return false;
            }
        }


        domicileData.module_type = moduleType;
        if (domicileData.constitution_artical == VALUE_FIVE || domicileData.constitution_artical == VALUE_SIX)
            domicileData.applicant_education_details = applicantEducationItem;
        if (domicileData.constitution_artical == VALUE_FIVE || domicileData.constitution_artical == VALUE_SIX || domicileData.constitution_artical == VALUE_SEVEN)
            domicileData.residential_details = residentialItem;
        if (domicileData.constitution_artical == VALUE_SEVEN && domicileData.business_type == VALUE_ONE)
            domicileData.business_details = businessItem;
        if (domicileData.constitution_artical == VALUE_SEVEN && domicileData.business_type == VALUE_TWO)
            domicileData.service_details = serviceItem;

        domicileData.born_place_state_text = bornPlaceStateText;
        domicileData.born_place_district_text = bornPlaceDistrictText;
        domicileData.born_place_village_text = bornPlaceVillageText;
        domicileData.native_place_state_text = nativePlaceStateText;
        domicileData.native_place_district_text = nativePlaceDistrictText;
        domicileData.native_place_village_text = nativePlaceVillageText;
        domicileData.father_born_place_state_text = fBornPlaceStateText;
        domicileData.father_born_place_district_text = fBornPlaceDistrictText;
        domicileData.father_born_place_village_text = fBornPlaceVillageText;
        domicileData.father_native_place_state_text = fNativePlaceStateText;
        domicileData.father_native_place_district_text = fNativePlaceDistrictText;
        domicileData.father_native_place_village_text = fNtivePlaceVillageText;
        domicileData.mother_born_place_state_text = mBornPlaceStateText;
        domicileData.mother_born_place_district_text = mBornPlaceDistrictText;
        domicileData.mother_born_place_village_text = mBornPlaceVillageText;
        domicileData.mother_native_place_state_text = mNativePlaceStateText;
        domicileData.mother_native_place_district_text = mNativePlaceDistrictText;
        domicileData.mother_native_place_village_text = mNtivePlaceVillageText;
        domicileData.spouse_born_place_state_text = sBornPlaceStateText;
        domicileData.spouse_born_place_district_text = sBornPlaceDistrictText;
        domicileData.spouse_born_place_village_text = sBornPlaceVillageText;
        domicileData.spouse_native_place_state_text = sNativePlaceStateText;
        domicileData.spouse_native_place_district_text = sNativePlaceDistrictText;
        domicileData.spouse_native_place_village_text = sNtivePlaceVillageText;

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_domicile') : $('#submit_btn_for_domicile');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'domicile/submit_domicile',
            data: $.extend({}, domicileData, getTokenData()),
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
                validationMessageShow('domicile', textStatus.statusText);
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
                    validationMessageShow('domicile', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                Domicile.listview.loadDomicileData();
                showSuccess(parseData.message);
            }
        });
    },
    askForApproveApplication: function (domicileId) {
        if (!domicileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + domicileId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'domicile/get_domicile_data_by_domicile_certificate_id',
            type: 'post',
            data: $.extend({}, {'domicile_certificate_id': domicileId}, getTokenData()),
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
                var domicileData = parseData.domicile_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                var dcData = that.getBasicConfigurationForMovement(domicileData);
                $('#popup_container').html(domicileApproveTemplate(dcData));
                datePicker();
                resetCounterForDocument('form-numbering', 1);
            }
        });
    },
    getBasicConfigurationForMovement: function (domicileData) {
        var that = this;
        domicileData.show_permanent_adder = true;
        if (domicileData.constitution_artical == VALUE_ONE) {
            domicileData.show_permanent_adder = false;
        }
        if (domicileData.talathi_to_aci != VALUE_ZERO) {
            domicileData.show_talathi_updated_basic_details = true;
        }
        if (domicileData.aci_rec == VALUE_ONE || domicileData.aci_rec == VALUE_TWO) {
            domicileData.show_aci_updated_basic_details = true;
            domicileData.aci_rec_text = recArray[domicileData.aci_rec] ? recArray[domicileData.aci_rec] : '';
            if (domicileData.aci_rec == VALUE_ONE) {
                domicileData.act_to_mamlatdar_ldc_datetime_text = domicileData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.aci_to_ldc_datetime) : '';
                domicileData.act_to_mamlatdar_ldc_name_text = domicileData.ldc_name;
            }
            if (domicileData.aci_rec == VALUE_TWO) {
                domicileData.act_to_mamlatdar_ldc_datetime_text = domicileData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.aci_to_mamlatdar_datetime) : '';
                domicileData.act_to_mamlatdar_ldc_name_text = domicileData.mamlatdar_name;
            }
        }
        domicileData.applicant_name_title = 'Applicant Name';
        if (domicileData.constitution_artical == VALUE_FOUR || domicileData.constitution_artical == VALUE_FIVE) {
            domicileData.applicant_name_title = 'Gardian Name';
        }
        if (domicileData.ldc_to_mamlatdar != VALUE_ZERO && domicileData.aci_rec == VALUE_ONE) {
            domicileData.show_ldc_updated_basic_details = true;
            domicileData.ldc_commu_address = that.ldcCommuAddress(domicileData);
            if (domicileData.constitution_artical == VALUE_FOUR || domicileData.constitution_artical == VALUE_FIVE) {
                domicileData.show_ldc_updated_minor_child_details = true;
            }
            domicileData.ldc_to_mamlatdar_datetime_text = domicileData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.ldc_to_mamlatdar_datetime) : '';
            domicileData.ldc_fname_title = 'Father Name';
            if ((domicileData.constitution_artical == VALUE_TWO || domicileData.constitution_artical == VALUE_THREE) &&
                    domicileData.gender == VALUE_TWO && (domicileData.marital_status == VALUE_ONE ||
                            domicileData.marital_status == VALUE_THREE)) {
                domicileData.ldc_fname_title = 'Spouse Name';
            }
        }
        if (domicileData.to_type_reverify != VALUE_ZERO) {
            domicileData.show_mam_reverify_updated_basic_details = true;
            domicileData.mam_reverification = domicileData.to_type_reverify == VALUE_ONE ? domicileData.talathi_name : domicileData.aci_name;
        }
        if (domicileData.talathi_to_type_reverify != VALUE_ZERO) {
            domicileData.talathi_reverification = domicileData.talathi_to_type_reverify == VALUE_ONE ? domicileData.aci_name : domicileData.mamlatdar_name;
            domicileData.show_talathi_reverify_updated_basic_details = true;
        }
        if (domicileData.aci_rec_reverify == VALUE_ONE || domicileData.aci_rec_reverify == VALUE_TWO) {
            domicileData.show_aci_reverify_updated_basic_details = true;
            domicileData.aci_rec_reverify_text = recArray[domicileData.aci_rec_reverify] ? recArray[domicileData.aci_rec_reverify] : '';
            if (domicileData.aci_rec_reverify == VALUE_ONE) {
                domicileData.act_to_mamlatdar_ldc_reverify_datetime_text = domicileData.aci_to_ldc_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.aci_to_ldc_datetime) : '';
                domicileData.act_to_mamlatdar_ldc_reverify_name_text = domicileData.ldc_name;
            }
            if (domicileData.aci_rec_reverify == VALUE_TWO) {
                domicileData.act_to_mamlatdar_ldc_reverify_datetime_text = domicileData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.aci_to_reverify_datetime) : '';
                domicileData.act_to_mamlatdar_ldc_reverify_name_text = domicileData.mamlatdar_name;
            }
        }
        if (domicileData.ldc_to_mamlatdar != VALUE_ZERO && domicileData.aci_rec_reverify == VALUE_ONE) {
            domicileData.show_ldc_reverify_updated_basic_details = true;
            domicileData.ldc_commu_address = that.ldcCommuAddress(domicileData);
            if (domicileData.constitution_artical == VALUE_FOUR || domicileData.constitution_artical == VALUE_FIVE) {
                domicileData.show_ldc_reverify_updated_minor_child_details = true;
            }
            domicileData.ldc_to_mamlatdar_datetime_text = domicileData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.ldc_to_mamlatdar_datetime) : '';
            domicileData.ldc_to_mamlatdar_datetime_text = domicileData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.ldc_to_mamlatdar_datetime) : '';
            domicileData.ldc_fname_title = 'Father Name';
            if ((domicileData.constitution_artical == VALUE_TWO || domicileData.constitution_artical == VALUE_THREE) &&
                    domicileData.gender == VALUE_TWO && (domicileData.marital_status == VALUE_ONE ||
                            domicileData.marital_status == VALUE_THREE)) {
                domicileData.ldc_fname_title = 'Spouse Name';
            }
        }
        domicileData.show_minor_detail = false;
        if (domicileData.constitution_artical == VALUE_FOUR || domicileData.constitution_artical == VALUE_FIVE) {
            domicileData.show_minor_detail = true;
        }
        domicileData.talathi_to_aci_datetime_text = domicileData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.talathi_to_aci_datetime) : '';
        domicileData.aci_to_mamlatdar_datetime_text = domicileData.aci_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.aci_to_mamlatdar_datetime) : '';
        domicileData.mam_to_reverify_datetime_text = domicileData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.mam_to_reverify_datetime) : '';
        domicileData.talathi_to_reverify_datetime_text = domicileData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.talathi_to_reverify_datetime) : '';
        domicileData.aci_to_reverify_datetime_text = domicileData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(domicileData.aci_to_reverify_datetime) : '';
        return domicileData;
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_domicile_form').serializeFormJSON();
        if (!formData.domicile_id_for_domicile_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_domicile_certificate_approve) {
            $('#remarks_for_domicile_certificate_approve').focus();
            validationMessageShow('domicile-approve-remarks_for_domicile_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_domicile_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'domicile/approve_application',
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
                validationMessageShow('domicile-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('domicile-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Domicile.listview.loadDomicileData();
//                $('#status_' + formData.domicile_id_for_domicile_approve).html(appStatusArray[VALUE_FIVE]);
//                $('#edit_btn_for_app_' + formData.domicile_id_for_domicile_approve).remove();
//                $('#reject_btn_for_app_' + formData.domicile_id_for_domicile_approve).remove();
//                $('#approve_btn_for_app_' + formData.domicile_id_for_domicile_approve).remove();
//                $('#download_certificate_btn_for_app_' + formData.domicile_id_for_domicile_approve).show();
            }
        });
    },
    askForRejectApplication: function (domicileId) {
        if (!domicileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + domicileId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'domicile/get_domicile_data_by_domicile_certificate_id',
            type: 'post',
            data: $.extend({}, {'domicile_certificate_id': domicileId}, getTokenData()),
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
                var domicileData = parseData.domicile_data;
                showPopup();
                var dcData = that.getBasicConfigurationForMovement(domicileData);
                $('#popup_container').html(domicileRejectTemplate(dcData));
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_domicile_form').serializeFormJSON();
        if (!formData.domicile_certificate_id_for_domicile_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_domicile_certificate_reject) {
            $('#remarks_for_domicile_certificate_reject').focus();
            validationMessageShow('domicile-reject-remarks_for_domicile_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_domicile_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'domicile/reject_application',
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
                validationMessageShow('domicile-reject', textStatus.statusText);
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
                    validationMessageShow('domicile-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                Domicile.listview.loadDomicileData();
            }
        });
    },

    FillBilling: function () {
        if ($("#billingtoo_for_dc").is(":checked")) {
            $('#per_addr_house_no_for_dc').val($('#com_addr_house_no_for_dc').val());
            $('#per_addr_house_name_for_dc').val($('#com_addr_house_name_for_dc').val());
            $('#per_addr_street_for_dc').val($('#com_addr_street_for_dc').val());
            $('#per_addr_village_dmc_ward_for_dc').val($('#com_addr_village_dmc_ward_for_dc').val());
            $('#per_addr_city_for_dc').val($('#com_addr_city_for_dc').val());
            $('#per_pincode_for_dc').val($('#com_pincode_for_dc').val());
        } else {
            $('#per_addr_house_no_for_dc').val('');
            $('#per_addr_house_name_for_dc').val('');
            $('#per_addr_street_for_dc').val('');
            $('#per_addr_village_dmc_ward_for_dc').val('');
            $('#per_addr_city_for_dc').val('');
            $('#per_pincode_for_dc').val();
        }
        generateSelect2();
    },
    villageDMCChangeEvent: function () {
        var district = $('#district').val();
        var villageCode = $('#village_name_for_dc').val();
        var villageData = (district == VALUE_ONE ? damanVillagesArray[villageCode] : (district == VALUE_TWO ? diuVillagesArray[villageCode] : (district == VALUE_THREE ? dnhVillagesArray[villageCode] : [])));
        $('#com_addr_village_dmc_ward_for_dc').val(villageData);

        $("#billingtoo_for_dc").prop('checked', false);
        $('#per_addr_village_dmc_ward_for_dc').val('');
        $('#per_addr_city_for_dc').val('');
        $('#per_pincode_for_dc').val('');

        if (district == VALUE_ONE) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'com_addr_city_for_dc');
            renderOptionsForTwoDimensionalArray(damanCityArray, 'per_addr_city_for_dc');

            if (jQuery.inArray(villageCode, naniDamanVillageArray) != '-1') {
                $('#com_addr_city_for_dc').val(damanCityArray[VALUE_ONE]);
                var city_code = VALUE_ONE;

            } else if (jQuery.inArray(villageCode, motiDamanVillageArray) != '-1') {
                $('#com_addr_city_for_dc').val(damanCityArray[VALUE_TWO]);
                var city_code = VALUE_TWO;
            }

            var pincodeData = damanCityPincodeArray[city_code];
            $('#pincode_for_dc').val(pincodeData);
            $('#com_pincode_for_dc').val(pincodeData);

            generateSelect2();
        } else if (district == VALUE_TWO) {
            renderOptionsForTwoDimensionalArray(diuCityArray, 'com_addr_city_for_dc');
            renderOptionsForTwoDimensionalArray(diuCityArray, 'per_addr_city_for_dc');
            $('#com_addr_city_for_dc').val(diuCityArray[VALUE_ONE]);
            $('#pincode_for_dc').val('');
            $('#com_pincode_for_dc').val('');

        } else if (district == VALUE_THREE) {
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'com_addr_city_for_dc');
            renderOptionsForTwoDimensionalArray(dnhCityArray, 'per_addr_city_for_dc');
            $('#com_addr_city_for_dc').val(dnhCityArray[VALUE_ONE]);
            $('#pincode_for_dc').val('');
            $('#com_pincode_for_dc').val('');
        }
    },
    getPincode: function () {
        var city_code = $('#com_addr_city_for_dc').val();
        var pincodeData = damanCityPincodeArray[city_code];
        $('#pincode_for_dc').val(pincodeData);
        $('#com_pincode_for_dc').val(pincodeData);

        var per_city_code = $('#per_addr_city_for_dc').val();
        var pincodeData = damanCityPincodeArray[per_city_code];
        $('#per_pincode_for_dc').val(pincodeData);
    },
    downloadCertificate: function (domicileId, moduleType) {
        if (!domicileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#domicile_certificate_id_for_certificate').val(domicileId);
        $('#mtype_for_certificate').val(moduleType);
        $('#domicile_certificate_pdf_form').submit();
        $('#domicile_certificate_id_for_certificate').val('');
        $('#mtype_for_certificate').val('');
    },
    getQueryData: function (domicileId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!domicileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_ONE;
        templateData.module_id = domicileId;
        var btnObj = $('#query_btn_for_app_' + domicileId);
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
                tmpData.applicant_name = moduleData.name_of_applicant;
                tmpData.title = 'Applicant Name';
                tmpData.module_type = VALUE_ONE;
                tmpData.module_id = domicileId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    setAppointment: function (domicileId) {
        if (!domicileId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + domicileId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'domicile/get_appointment_data_by_domicile_certificate_id',
            type: 'post',
            data: $.extend({}, {'domicile_certificate_id': domicileId}, getTokenData()),
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
                $('#popup_container').html(domicileSetAppointmentTemplate(appointmentData));
                if (appointmentData.online_statement == VALUE_ONE) {
                    $('#online_statement_for_domicile').attr('checked', 'checked');
                }
                if (appointmentData.visit_office == VALUE_ONE) {
                    $('#visit_office_for_domicile').attr('checked', 'checked');
                }
                loadAppointmentHistory('domicile', appointmentData);
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
        var formData = $('#set_appointment_domicile_form').serializeFormJSON();
        if (!formData.domicile_id_for_domicile_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_domicile) {
            //$('#appointment_date_for_domicile').focus();
            validationMessageShow('domicile-appointment_date_for_domicile', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_domicile) {
            //$('#appointment_time_for_domicile').focus();
            validationMessageShow('domicile-appointment_time_for_domicile', timeValidationMessage);
            return false;
        }
        var start_date = dateTo_YYYY_MM_DD(formData.appointment_date_for_domicile); // Oct 1, 2014
        var d = new Date();
        var end_date = d.setDate(d.getDate() - 1);
        var new_start_date = new Date(start_date);
        var new_end_date = new Date(end_date);

        if (new_end_date > new_start_date) {
            //$('#appointment_date_for_domicile').focus();
            validationMessageShow('domicile-appointment_date_for_domicile', appointmentDateSelectValidationMessage);
            return false;
        }
        if (formData.online_statement_for_domicile == undefined && formData.visit_office_for_domicile == undefined) {
            $('#visit_office_for_domicile').focus();
            validationMessageShow('domicile-visit_office_for_domicile', appointmentTypeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_domicile_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'domicile/submit_set_appointment',
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
                validationMessageShow('domicile-set-appointment', textStatus.statusText);
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
                    validationMessageShow('domicile-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var domicileCertificateData = parseData.domicile_certificate_data;

                if (domicileCertificateData.appointment_date != '0000-00-00') {
                    var d1 = (dateTo_DD_MM_YYYY(domicileCertificateData.appointment_date)).split("-");
                    var d2 = (dateTo_DD_MM_YYYY()).split("-");
                    d1 = d1[2].concat(d1[1], d1[0]);
                    d2 = d2[2].concat(d2[1], d2[0]);
                    if (parseInt(d2) >= parseInt(d1)) {
                        //domicileCertificateData.show_forward_btn = true;
                        $('#update_basic_detail_btn_for_app_' + domicileCertificateData.domicile_certificate_id).show();
                    } else {
                        $('#update_basic_detail_btn_for_app_' + domicileCertificateData.domicile_certificate_id).hide();
                    }
                }

                $('#appointment_container_' + domicileCertificateData.domicile_certificate_id).html(that.getAppointmentData(domicileCertificateData));
                $('#movement_for_dc_list_' + domicileCertificateData.domicile_certificate_id).html(movementString(domicileCertificateData));
            }
        });
    },
    reverifyApplication: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#update_basic_detail_domicile_form').serializeFormJSON();
        if (!formData.domicile_certificate_id_for_domicile_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
            if (!formData.to_type_reverify_for_domicile) {
                $('#to_type_reverify_for_domicile_1').focus();
                validationMessageShow('domicile-update-basic-detail-to_type_reverify_for_domicile', oneOptionValidationMessage);
                return false;
            }
            if (!formData.mam_reverify_remarks_for_domicile) {
                $('#mam_reverify_remarks_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-mam_reverify_remarks_for_domicile', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            if (!formData.talathi_to_type_reverify_for_domicile) {
                $('#talathi_to_type_reverify_for_domicile_1').focus();
                validationMessageShow('domicile-update-basic-detail-talathi_to_type_reverify_for_domicile', oneOptionValidationMessage);
                return false;
            }
            if (!formData.upload_reverification_document_for_domicile) {
                $('#upload_reverification_document_for_domicile_1').focus();
                validationMessageShow('domicile-update-basic-detail-upload_reverification_document_for_domicile', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_reverification_document_for_domicile == VALUE_ONE) {
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
            if (!formData.talathi_reverify_remarks_for_domicile) {
                $('#talathi_reverify_remarks_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-talathi_reverify_remarks_for_domicile', remarksValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
            if (!formData.aci_rec_reverify_for_domicile) {
                $('#aci_rec_reverify_for_domicile_1').focus();
                validationMessageShow('domicile-update-basic-detail-aci_rec_reverify_for_domicile', oneOptionValidationMessage);
                return false;
            }
            if (!formData.aci_reverify_remarks_for_domicile) {
                $('#aci_reverify_remarks_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-aci_reverify_remarks_for_domicile', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_domicile == VALUE_ONE && !formData.aci_to_ldc_reverify_for_domicile) {
                $('#aci_to_ldc_reverify_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-aci_to_ldc_reverify_for_domicile', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_reverify_for_domicile == VALUE_ONE && !formData.aci_to_type_reverify_for_domicile) {
                $('#aci_to_type_reverify_for_domicile_1').focus();
                validationMessageShow('domicile-update-basic-detail-aci_to_type_reverify_for_domicile', oneOptionValidationMessage);
                return false;
            }
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'domicile/reverify_application',
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
                validationMessageShow('domicile-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('domicile-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var icData = parseData.domicile_data;
                if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) {
                    $('#status_' + formData.domicile_id_for_domicile_update_basic_detail).html(appStatusArray[VALUE_THREE]);
                    var reverificationName = formData.to_type_reverify_for_domicile == VALUE_ONE ? formData.talathi_name_for_domicile_update_basic_detail : formData.aci_name_for_domicile_update_basic_detail;
                    $('#reverification_status_' + formData.domicile_id_for_domicile_update_basic_detail).html('<hr>' + reverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    var talathiReverificationName = formData.talathi_to_type_reverify_for_domicile == VALUE_ONE ? formData.aci_name_for_domicile_update_basic_detail : formData.mamlatdar_name_for_domicile_update_basic_detail;
                    $('#reverification_status_' + formData.domicile_id_for_domicile_update_basic_detail).html('<hr>' + talathiReverificationName);
                }
                if (tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    if (icData.aci_rec_reverify == VALUE_ONE) {
                        $('#reverification_status_' + formData.domicile_id_for_domicile_update_basic_detail).html('<hr>' + icData.ldc_name);
                    } else {
                        $('#reverification_status_' + formData.domicile_id_for_domicile_update_basic_detail).html('<hr>' + formData.mamlatdar_name_for_domicile_update_basic_detail);
                    }
                }
                $('#movement_for_dc_list_' + formData.domicile_id_for_domicile_update_basic_detail).html(movementString(parseData.domicile_data));
                resetModelMD();
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
    updateBasicDetails: function (btnObj, domicileId) {
        if (!domicileId) {
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
            url: 'domicile/get_update_basic_detail_data_by_domicile_certificate_id',
            type: 'post',
            data: $.extend({}, {'domicile_certificate_id': domicileId}, getTokenData()),
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

                var basicDetailData = parseData.update_basic_detail_data;
                if (tempTypeInSession != TEMP_TYPE_TALATHI_USER) {
                    showPopup();
                }
                if (basicDetailData == null) {
                    basicDetailData = {};
                }

                basicDetailData.VALUE_ONE = VALUE_ONE;
                basicDetailData.VALUE_TWO = VALUE_TWO;
                basicDetailData.show_permanent_adder = true;
                if (basicDetailData.constitution_artical == VALUE_ONE) {
                    basicDetailData.show_permanent_adder = false;
                }
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
                basicDetailData.applicant_name_title = 'Applicant Name';
                if (basicDetailData.constitution_artical == VALUE_FOUR || basicDetailData.constitution_artical == VALUE_FIVE) {
                    basicDetailData.applicant_name_title = 'Gardian Name';
                }
                if ((basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) &&
                        tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec == VALUE_ONE &&
                        basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                    basicDetailData.show_ldc_enter_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData = ldcAppDetails(basicDetailData, 'name_of_applicant', 'ldc_applicant_name', 'ldc_app_name');
                    if (basicDetailData.constitution_artical == VALUE_FOUR || basicDetailData.constitution_artical == VALUE_FIVE) {
                        basicDetailData.show_ldc_enter_minor_child_details = true;
                        basicDetailData = ldcAppDetails(basicDetailData, 'minor_child_name', 'ldc_minor_child_name', 'ldc_mc_name');
                    }
                    basicDetailData = returnFieldNameFromJSON(basicDetailData, 'father_details', 'father_name', 'app_father_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'app_father_name', 'ldc_father_name', 'ldc_fname');
                    basicDetailData.ldc_fname_title = 'Father Name';
                    if ((basicDetailData.constitution_artical == VALUE_TWO || basicDetailData.constitution_artical == VALUE_THREE) &&
                            basicDetailData.gender == VALUE_TWO && (basicDetailData.marital_status == VALUE_ONE ||
                                    basicDetailData.marital_status == VALUE_THREE)) {
                        var spouseDetails = basicDetailData.spouse_details != '' ? JSON.parse(basicDetailData.spouse_details) : {};
                        basicDetailData.ldc_fname_title = 'Spouse Name';
                        basicDetailData.ldc_fname = spouseDetails.spouse_name ? spouseDetails.spouse_name : '';
                    }
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && basicDetailData.aci_rec == VALUE_ONE) {
                    basicDetailData.show_ldc_updated_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    if (basicDetailData.constitution_artical == VALUE_FOUR || basicDetailData.constitution_artical == VALUE_FIVE) {
                        basicDetailData.show_ldc_updated_minor_child_details = true;
                    }
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                    basicDetailData.ldc_fname_title = 'Father Name';
                    if ((basicDetailData.constitution_artical == VALUE_TWO || basicDetailData.constitution_artical == VALUE_THREE) &&
                            basicDetailData.gender == VALUE_TWO && (basicDetailData.marital_status == VALUE_ONE ||
                                    basicDetailData.marital_status == VALUE_THREE)) {
                        basicDetailData.ldc_fname_title = 'Spouse Name';
                    }
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
                    basicDetailData.show_submit_btn = true;
                    basicDetailData.show_ldc_draft_btn = true;
                    basicDetailData = ldcAppDetails(basicDetailData, 'name_of_applicant', 'ldc_applicant_name', 'ldc_app_name');
                    if (basicDetailData.constitution_artical == VALUE_FOUR || basicDetailData.constitution_artical == VALUE_FIVE) {
                        basicDetailData.show_ldc_reverify_enter_minor_child_details = true;
                        basicDetailData = ldcAppDetails(basicDetailData, 'minor_child_name', 'ldc_minor_child_name', 'ldc_mc_name');
                    }
                    basicDetailData = returnFieldNameFromJSON(basicDetailData, 'father_details', 'father_name', 'app_father_name');
                    basicDetailData = ldcAppDetails(basicDetailData, 'app_father_name', 'ldc_father_name', 'ldc_fname');
                    basicDetailData.ldc_fname_title = 'Father Name';
                    if ((basicDetailData.constitution_artical == VALUE_TWO || basicDetailData.constitution_artical == VALUE_THREE) &&
                            basicDetailData.gender == VALUE_TWO && (basicDetailData.marital_status == VALUE_ONE ||
                                    basicDetailData.marital_status == VALUE_THREE)) {
                        var spouseDetails = basicDetailData.spouse_details != '' ? JSON.parse(basicDetailData.spouse_details) : {};
                        basicDetailData.ldc_fname_title = 'Spouse Name';
                        basicDetailData.ldc_fname = spouseDetails.spouse_name ? spouseDetails.spouse_name : '';
                    }
                }
                if (basicDetailData.ldc_to_mamlatdar != VALUE_ZERO && basicDetailData.aci_rec_reverify == VALUE_ONE) {
                    basicDetailData.show_ldc_reverify_updated_basic_details = true;
                    basicDetailData.ldc_commu_address = that.ldcCommuAddress(basicDetailData);
                    if (basicDetailData.constitution_artical == VALUE_FOUR || basicDetailData.constitution_artical == VALUE_FIVE) {
                        basicDetailData.show_ldc_reverify_updated_minor_child_details = true;
                    }
                    basicDetailData.ldc_to_mamlatdar_datetime_text = basicDetailData.ldc_to_mamlatdar_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.ldc_to_mamlatdar_datetime) : '';
                    basicDetailData.ldc_fname_title = 'Father Name';
                    if ((basicDetailData.constitution_artical == VALUE_TWO || basicDetailData.constitution_artical == VALUE_THREE) &&
                            basicDetailData.gender == VALUE_TWO && (basicDetailData.marital_status == VALUE_ONE ||
                                    basicDetailData.marital_status == VALUE_THREE)) {
                        basicDetailData.ldc_fname_title = 'Spouse Name';
                    }
                }
                basicDetailData.title = basicDetailData.to_type_reverify == VALUE_ZERO ? (tempTypeInSession == TEMP_TYPE_TALATHI_USER ? 'Forward for Verification' : (tempTypeInSession == TEMP_TYPE_ACI_USER ? 'Forward for Approval' : 'Update Basic Details')) : 'Reverification Domicile Certificate Form';
                basicDetailData.talathi_to_aci_datetime_text = basicDetailData.talathi_to_aci_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_aci_datetime) : '';
                basicDetailData.mam_to_reverify_datetime_text = basicDetailData.mam_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.mam_to_reverify_datetime) : '';
                basicDetailData.talathi_to_reverify_datetime_text = basicDetailData.talathi_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.talathi_to_reverify_datetime) : '';
                basicDetailData.aci_to_reverify_datetime_text = basicDetailData.aci_to_reverify_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.aci_to_reverify_datetime) : '';

                if (basicDetailData.status == VALUE_FIVE || basicDetailData.status == VALUE_SIX) {
                    basicDetailData.show_approve_reject_details = true;
                    basicDetailData.status_text = returnAppStatus(basicDetailData.status);
                    basicDetailData.status_datetime_text = basicDetailData.status_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(basicDetailData.status_datetime) : '';
                    basicDetailData.title = 'Movement Details of Domicile Certificate Form';
                }

                basicDetailData.show_minor_detail = false;
                if (basicDetailData.constitution_artical == VALUE_FOUR || basicDetailData.constitution_artical == VALUE_FIVE) {
                    basicDetailData.show_minor_detail = true;
                }

                if (basicDetailData.marital_status == VALUE_ONE && (basicDetailData.constitution_artical != VALUE_TWO && basicDetailData.constitution_artical != VALUE_FOUR && basicDetailData.constitution_artical != VALUE_FIVE)) {
                    basicDetailData.show_spouse_data = true;
                }
                basicDetailData.marital_status = maritalStatusArray[basicDetailData.marital_status];
                basicDetailData.com_pincode = basicDetailData.com_pincode == '0' ? basicDetailData.pincode : basicDetailData.com_pincode;
                basicDetailData.election_no = basicDetailData.election_no == '' ? '-' : basicDetailData.election_no;
                basicDetailData.father_election_no = basicDetailData.father_election_no == '' ? '-' : basicDetailData.father_election_no;
                basicDetailData.mother_election_no = basicDetailData.mother_election_no == '' ? '-' : basicDetailData.mother_election_no;
                basicDetailData.spouse_election_no = basicDetailData.spouse_election_no == '' ? '-' : basicDetailData.spouse_election_no;

                basicDetailData.required_purpose = basicDetailData.required_purpose == '' ? domicileCertificatePurposeArray[basicDetailData.select_required_purpose] : basicDetailData.required_purpose;

                //basicDetailData.com_addr_city = damanCityArray[basicDetailData.com_addr_city] == undefined ? basicDetailData.com_addr_city : damanCityArray[basicDetailData.com_addr_city];
                basicDetailData.status = queryStatus(basicDetailData.query_status);

                if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    $('#model_md_title').html(basicDetailData.title);
                    $('#model_md_body').html(domicileUpdateBasicDetailTemplate(basicDetailData));
                } else {
                    basicDetailData.show_card = true;
                    $('#popup_container').html(domicileUpdateBasicDetailTemplate(basicDetailData));
                }

                if (basicDetailData.status != VALUE_FIVE && basicDetailData.status != VALUE_SIX) {
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.talathi_to_aci == VALUE_ZERO) {
                        generateBoxes('radio', yesNoArray, 'upload_verification_document', 'domicile', basicDetailData.is_upload_verification_document, false, false);
                        showSubContainer('upload_verification_document', 'domicile', '#field_verification_document_uploads', VALUE_ONE, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.aci_data, 'talathi_to_aci_for_domicile', 'sa_user_id', 'name', '', false);

                        if (basicDetailData.field_documents != '') {
                            $.each(basicDetailData.field_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_ONE);
                                $('#upload_verification_document_for_domicile_1').attr('checked', 'checked');
                                $('#field_verification_document_uploads_container_for_domicile').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_ONE);
                            $('#upload_verification_document_for_domicile_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_rec == VALUE_ZERO) {
                        basicDetailData.aci_rec = (basicDetailData.aci_rec == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec);
                        generateBoxes('radio', recArray, 'aci_rec', 'domicile', basicDetailData.aci_rec, false, false);
                        showSubContainer('aci_rec', 'domicile', '#aci_to_ldc', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec', 'domicile', '#aci_to_mamlatdar', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'aci_to_mamlatdar_for_domicile', 'sa_user_id', 'name', '', false);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_for_domicile', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.mamlatdar_data, 'ldc_to_mamlatdar_for_domicile', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && basicDetailData.to_type_reverify == VALUE_ZERO) {
                        generateBoxes('radio', reverifyTypeArray, 'to_type_reverify', 'domicile', basicDetailData.to_type_reverify, false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && basicDetailData.to_type_reverify == VALUE_ONE) {
                        generateBoxes('radio', yesNoArray, 'upload_reverification_document', 'domicile', basicDetailData.is_upload_reverification_document, false, false);
                        showSubContainer('upload_reverification_document', 'domicile', '#field_reverification_document_uploads', VALUE_ONE, 'radio');
                        generateBoxes('radio', talathiReverifyTypeArray, 'talathi_to_type_reverify', 'domicile', basicDetailData.talathi_to_type_reverify, false);

                        if (basicDetailData.field_reverify_documents != '') {
                            $.each(basicDetailData.field_reverify_documents, function (index, docData) {
                                that.addVerificationDocItem(docData, VALUE_TWO);
                                $('#upload_reverification_document_for_domicile_1').attr('checked', 'checked');
                                $('#field_reverification_document_uploads_container_for_domicile').show();
                            });
                        } else {
                            that.addVerificationDocItem({}, VALUE_TWO);
                            $('#upload_reverification_document_for_domicile_2').attr('checked', 'checked');
                        }
                    }
                    if (tempTypeInSession == TEMP_TYPE_ACI_USER && basicDetailData.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                            (basicDetailData.to_type_reverify == VALUE_TWO || basicDetailData.talathi_to_type_reverify == VALUE_ONE)) {
                        var tempArray = [];
                        tempArray[VALUE_ZERO] = basicDetailData.mamlatdar_name;
                        generateBoxes('radio', tempArray, 'aci_to_type_reverify', 'domicile', VALUE_ZERO, false);

                        basicDetailData.aci_rec_reverify = (basicDetailData.aci_rec_reverify == VALUE_ZERO ? VALUE_TWO : basicDetailData.aci_rec_reverify);
                        generateBoxes('radio', recArray, 'aci_rec_reverify', 'domicile', basicDetailData.aci_rec_reverify, false, false);
                        showSubContainer('aci_rec_reverify', 'domicile', '#aci_to_ldc_reverify', VALUE_ONE, 'radio');
                        showSubContainer('aci_rec_reverify', 'domicile', '#aci_to_mamlatdar_reverify', VALUE_TWO, 'radio');
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(parseData.ldc_data, 'aci_to_ldc_reverify_for_domicile', 'sa_user_id', 'name', '', false);
                    }
                    if (tempTypeInSession == TEMP_TYPE_LDC_USER && basicDetailData.aci_rec_reverify == VALUE_ONE &&
                            basicDetailData.ldc_to_mamlatdar == VALUE_ZERO) {
                        var tempArray = [];
                        var tArray = {};
                        tArray['name'] = basicDetailData.mamlatdar_name;
                        tArray['sa_user_id'] = basicDetailData.aci_to_mamlatdar;
                        tempArray.push(tArray);
                        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempArray, 'ldc_to_mamlatdar_for_domicile', 'sa_user_id', 'name', '', false);
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
        var formData = $('#update_basic_detail_domicile_form').serializeFormJSON();
        if (!formData.domicile_certificate_id_for_domicile_update_basic_detail) {
            showError(invalidAccessValidationMessage);
            return false;
        }


        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {

            if (!formData.upload_verification_document_for_domicile) {
                $('#upload_verification_document_for_domicile_1').focus();
                validationMessageShow('domicile-update-basic-detail-upload_verification_document_for_domicile', oneOptionValidationMessage);
                return false;
            }
            if (formData.upload_verification_document_for_domicile == VALUE_ONE) {
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
            if (!formData.talathi_remarks_for_domicile) {
                $('#talathi_remarks_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-talathi_remarks_for_domicile', remarksValidationMessage);
                return false;
            }
            if (!formData.talathi_to_aci_for_domicile) {
                $('#talathi_to_aci_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-talathi_to_aci_for_domicile', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_ACI_USER) {

            if (!formData.aci_remarks_for_domicile) {
                $('#aci_remarks_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-aci_remarks_for_domicile', remarksValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_domicile == VALUE_ONE && !formData.aci_to_ldc_for_domicile) {
                $('#aci_to_ldc_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-aci_to_ldc_for_domicile', oneOptionValidationMessage);
                return false;
            }
            if (formData.aci_rec_for_domicile == VALUE_TWO && !formData.aci_to_mamlatdar_for_domicile) {
                $('#aci_to_mamlatdar_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-aci_to_mamlatdar_for_domicile', oneOptionValidationMessage);
                return false;
            }
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_LDC_USER) {
            var constitutionArtical = parseInt($('#constitution_artical_for_domicile').val());
            if (constitutionArtical != VALUE_ONE && constitutionArtical != VALUE_TWO && constitutionArtical != VALUE_THREE &&
                    constitutionArtical != VALUE_FOUR && constitutionArtical != VALUE_FIVE && constitutionArtical != VALUE_SIX &&
                    constitutionArtical != VALUE_SEVEN) {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (!formData.ldc_applicant_name_for_domicile) {
                $('#ldc_applicant_name_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-ldc_applicant_name_for_domicile', applicantNameValidationMessage);
                return false;
            }
            if (constitutionArtical == VALUE_FOUR || constitutionArtical == VALUE_FIVE) {
                if (!formData.ldc_minor_child_name_for_domicile) {
                    $('#ldc_minor_child_name_for_domicile').focus();
                    validationMessageShow('domicile-update-basic-detail-ldc_minor_child_name_for_domicile', minorChildNameValidationMessage);
                    return false;
                }
            }
            if (!formData.ldc_father_name_for_domicile) {
                $('#ldc_father_name_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-ldc_father_name_for_domicile', detailValidationMessage);
                return false;
            }
            if (!formData.ldc_commu_address_for_domicile) {
                $('#ldc_commu_address_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-ldc_commu_address_for_domicile', communicationAddressValidationMessage);
                return false;
            }
            if (!formData.ldc_to_mamlatdar_remarks_for_domicile) {
                $('#ldc_to_mamlatdar_remarks_for_domicile').focus();
                validationMessageShow('domicile-update-basic-detail-ldc_to_mamlatdar_remarks_for_domicile', remarksValidationMessage);
                return false;
            }
            if (!showLDCDraftBtn) {
                formData.update_ldc_mam_details = VALUE_ONE;
                if (!formData.ldc_to_mamlatdar_for_domicile) {
                    $('#ldc_to_mamlatdar_for_domicile').focus();
                    validationMessageShow('domicile-update-basic-detail-ldc_to_mamlatdar_for_domicile', oneOptionValidationMessage);
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
            url: 'domicile/forward_to',
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
                validationMessageShow('domicile-update-basic-detail', textStatus.statusText);
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
                    validationMessageShow('domicile-update-basic-detail', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                $('#movement_for_dc_list_' + parseData.domicile_certificate_id).html(movementString(parseData.domicile_certificate_data));
                resetModelMD();
            }
        });
    },
    getDocumentData: function (domicileCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!domicileCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#domicile_certificate_id_for_scrutiny').val(domicileCertificateId);
        $('#domicile_certificate_document_for_scrutiny').submit();
        $('#domicile_certificate_id_for_scrutiny').val('');
    },
    getDistrictData: function (obj, moduleName, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'dc' ? '' : '';
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
    },
    districtChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'village_name_for_dc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_name_for_dc');
    },
    getVillageData: function (obj, moduleName, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'dc' ? ' ' : '';
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
        $('#' + id + '_village_for_' + moduleName).val('');
        var state = $('#' + id + '_state_for_' + moduleName).val();
        var districtCode = obj.val();
        if (!districtCode || !state) {
            return;
        }
        var bornStateId = id + '_village_for_dc';
        addTagSpinner(bornStateId);
        $.ajax({
            url: 'domicile/get_village_data_for_domicile',
            type: 'post',
            data: $.extend({}, {'state_code': state, 'district_code': districtCode}, getTokenData()),
            error: function (textStatus, errorThrown) {
                removeTagSpinner();
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
                removeTagSpinner();
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
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
                $('#' + id + '_village_for_' + moduleName).val('');
                removeTagSpinner();
            }
        });
    },
    getDistrictFornDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_district_for_dc');
        var state = obj.val();
        if (!state) {
            return false;
        }
        if (state != VALUE_ONE && state != VALUE_TWO) {
            return false;
        }
        var districtData = state == VALUE_ONE ? damandiudistrictArray : (state == VALUE_TWO ? dnhdistrictArray : []);
        renderOptionsForTwoDimensionalArray(districtData, id + '_district_for_dc');
    },
    getVillageDataForNative: function (obj, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], id + '_village_for_dc');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var districtData = district == VALUE_ONE ? damanVillageForNativeArray : (district == VALUE_TWO ? diuVillagesForNativeArray : (district == VALUE_THREE ? dnhVillagesForNativeArray : []));
        renderOptionsForTwoDimensionalArray(districtData, id + '_village_for_dc');
    },
    addEducationInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt = tempEducationDetailCnt;
        $('#applicant_education_info_container').append(applicantEducationInfoTemplate(templateData));
        tempEducationDetailCnt++;
        datePicker();
        resetCounter('display-cnt');
    },
    removeEducationInfo: function (perCnt) {
        $('#applicant_education_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    addResidentialInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt_res = tempResidentialDetailCnt;
        $('#residential_info_container').append(applicantResidentialInfoTemplate(templateData));
        renderOptionsForTwoDimensionalArray(typeOfResidentArray, 'type_of_resident_' + tempResidentialDetailCnt);
        tempResidentialDetailCnt++;
        generateSelect2();
        datePicker();
        resetCounter('display-cnt-res');
    },
    removeResidentialInfo: function (perCntRes) {
        $('#residential_info_' + perCntRes).remove();
        resetCounter('display-cnt-res');
    },
    addBusinessInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt_bus = tempBusinessDetailCnt;
        $('#business_info_container').append(applicantBusinessInfoTemplate(templateData));
        tempBusinessDetailCnt++;
        datePicker();
        resetCounter('display-cnt-bus');
    },
    removeBusinessInfo: function (perCntBus) {
        $('#business_info_' + perCntBus).remove();
        resetCounter('display-cnt-bus');
    },
    addServiceInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt_ser = tempServiceDetailCnt;
        $('#service_info_container').append(applicantServiceInfoTemplate(templateData));
        tempServiceDetailCnt++;
        datePicker();
        resetCounter('display-cnt-bus');
    },
    removeServiceInfo: function (perCntSer) {
        $('#service_info_' + perCntSer).remove();
        resetCounter('display-cnt-ser');
    },
    getTotalPeriod: function () {
        var totalPeriodYear = 0;
        var totalPeriodMonth = 0;
        var totalPeriodDays = 0;
        $('.applicant_education_info').each(function () {
            var cnt1 = $(this).find('.temp_cnt').val();
            var periodYear = parseFloat($('#total_period_in_year_' + cnt1).val());
            totalPeriodYear += (periodYear ? periodYear : 0);

            var periodMonth = parseFloat($('#total_period_in_month_' + cnt1).val());
            totalPeriodMonth += (periodMonth ? periodMonth : 0);

            var periodDays = parseFloat($('#total_period_in_days_' + cnt1).val());
            totalPeriodDays += (periodDays ? periodDays : 0);
        });
        $('#total_period_for_dc').val(totalPeriodYear + ' Year ' + totalPeriodMonth + ' Month ' + totalPeriodDays + ' Days');
    },
    getResidentialTotalPeriod: function () {
        var totalPeriodYear = 0;
        var totalPeriodMonth = 0;
        var totalPeriodDays = 0;
        $('.residential_info').each(function () {
            var cnt1 = $(this).find('.temp_cnt').val();
            var periodYear = parseFloat($('#resident_total_period_in_year_' + cnt1).val());
            totalPeriodYear += (periodYear ? periodYear : 0);

            var periodMonth = parseFloat($('#resident_total_period_in_month_' + cnt1).val());
            totalPeriodMonth += (periodMonth ? periodMonth : 0);

            var periodDays = parseFloat($('#resident_total_period_in_days_' + cnt1).val());
            totalPeriodDays += (periodDays ? periodDays : 0);
        });
        $('#resident_total_period_for_dc').val(totalPeriodYear + ' Year ' + totalPeriodMonth + ' Month ' + totalPeriodDays + ' Days');
    },
    getBusinessTotalPeriod: function () {
        var totalPeriodYear = 0;
        var totalPeriodMonth = 0;
        var totalPeriodDays = 0;
        $('.business_info').each(function () {
            var cnt1 = $(this).find('.temp_cnt').val();
            var periodYear = parseFloat($('#business_total_period_in_year_' + cnt1).val());
            totalPeriodYear += (periodYear ? periodYear : 0);

            var periodMonth = parseFloat($('#business_total_period_in_month_' + cnt1).val());
            totalPeriodMonth += (periodMonth ? periodMonth : 0);

            var periodDays = parseFloat($('#business_total_period_in_days_' + cnt1).val());
            totalPeriodDays += (periodDays ? periodDays : 0);
        });
        $('#business_total_period_for_dc').val(totalPeriodYear + ' Year ' + totalPeriodMonth + ' Month ' + totalPeriodDays + ' Days');
    },
    getServiceTotalPeriod: function () {
        var totalPeriodYear = 0;
        var totalPeriodMonth = 0;
        var totalPeriodDays = 0;
        $('.service_info').each(function () {
            var cnt1 = $(this).find('.temp_cnt').val();
            var periodYear = parseFloat($('#service_total_period_in_year_' + cnt1).val());
            totalPeriodYear += (periodYear ? periodYear : 0);

            var periodMonth = parseFloat($('#service_total_period_in_month_' + cnt1).val());
            totalPeriodMonth += (periodMonth ? periodMonth : 0);

            var periodDays = parseFloat($('#service_total_period_in_days_' + cnt1).val());
            totalPeriodDays += (periodDays ? periodDays : 0);
        });
        $('#service_total_period_for_dc').val(totalPeriodYear + ' Year ' + totalPeriodMonth + ' Month ' + totalPeriodDays + ' Days');
    },
    calculateAutoPeriod: function (id, num, dateOne, dateTwo) {
        var d1 = $('#' + dateOne + num).val();
        var d2 = $('#' + dateTwo + num).val();

        if (d1 == "" || d2 == "") {
            var yearDiff = 0;
            var monthDiff = 0;
            var dayDiff = 0;
        } else {
            var d1 = new Date(d1.split("-").reverse().join("-"));
            var dd1 = d1.getDate();
            var mm1 = d1.getMonth() + 1;
            var yy1 = d1.getFullYear();
            var startingDate = yy1 + "-" + mm1 + "-" + dd1;

            var d2 = new Date(d2.split("-").reverse().join("-"));
            var dd2 = d2.getDate();
            var mm2 = d2.getMonth() + 1;
            var yy2 = d2.getFullYear();
            var endingDate = yy2 + "-" + mm2 + "-" + dd2;

            var startDate = new Date(new Date(startingDate).toISOString().substr(0, 10));
            if (!endingDate) {
                endingDate = new Date().toISOString().substr(0, 10);    // need date in YYYY-MM-DD format
            }
            var endDate = new Date(endingDate);
            if (startDate > endDate) {
                var swap = startDate;
                startDate = endDate;
                endDate = swap;
            }
            var startYear = startDate.getFullYear();
            var february = (startYear % 4 === 0 && startYear % 100 !== 0) || startYear % 400 === 0 ? 29 : 28;
            var daysInMonth = [31, february, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

            var yearDiff = endDate.getFullYear() - startYear;
            var monthDiff = endDate.getMonth() - startDate.getMonth();
            if (monthDiff < 0) {
                yearDiff--;
                monthDiff += 12;
            }
            var dayDiff = endDate.getDate() - startDate.getDate();
            if (dayDiff < 0) {
                if (monthDiff > 0) {
                    monthDiff--;
                } else {
                    yearDiff--;
                    monthDiff = 11;
                }
                dayDiff += daysInMonth[startDate.getMonth()];
            }
        }

        //return yearDiff + 'Y ' + monthDiff + 'M ' + dayDiff + 'D';

        $('#' + id + '_in_year_' + num).val(yearDiff);
        $('#' + id + '_in_month_' + num).val(monthDiff);
        $('#' + id + '_in_days_' + num).val(dayDiff);
    },
    getEditVillageData: function (state, districtCode, moduleName, village, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'dc' ? ' ' : '';
        if (!districtCode || !state) {
            return;
        }
        var bornStateId = id + '_village_for_dc';
        addTagSpinner(bornStateId);
        $.ajax({
            url: 'domicile/get_village_data_for_domicile',
            type: 'post',
            async: false,
            data: $.extend({}, {'state_code': state, 'district_code': districtCode}, getTokenData()),
            error: function (textStatus, errorThrown) {
                removeTagSpinner();
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
                removeTagSpinner();
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
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_dc', 'village_code', 'village_name', 'Village');
                $('#' + id + '_village_for_dc').val(village == 0 ? '' : village);
                removeTagSpinner();
            }
        });
    },
    getFatherMotherSpouseData: function (fatherDetails, motherDetails, spouseDetails, formData) {
        var that = this;
        // Applicant
        $('#born_place_state_for_dc').val(formData.born_place_state == 0 ? '' : formData.born_place_state);
        var districtData = tempDistrictData[formData.born_place_state] ? tempDistrictData[formData.born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'born_place_district_for_dc', 'district_code', 'district_name', 'District');
        $('#born_place_district_for_dc').val(formData.born_place_district == 0 ? '' : formData.born_place_district);
        that.getEditVillageData(formData.born_place_state, formData.born_place_district, 'dc', formData.born_place_village, 'born_place');
        $('#born_place_village_for_dc').val(formData.born_place_village);
        $('#native_place_state_for_dc').val(formData.native_place_state == 0 ? '' : formData.native_place_state);
        if (formData.constitution_artical == VALUE_FOUR) {
            var native_state = formData.native_place_state;
            var districtData = native_state == VALUE_ONE ? damandiudistrictArray : (native_state == VALUE_TWO ? dnhdistrictArray : []);
            renderOptionsForTwoDimensionalArray(districtData, 'native_place_district_for_dc');
            $('#native_place_district_for_dc').val(formData.native_place_district == 0 ? '' : formData.native_place_district);
            var native_district = formData.native_place_district;
            var villageDataForNative = native_district == VALUE_ONE ? damanVillageForNativeArray : (native_district == VALUE_TWO ? diuVillagesForNativeArray : (native_district == VALUE_THREE ? dnhVillagesForNativeArray : []));
            renderOptionsForTwoDimensionalArray(villageDataForNative, 'native_place_village_for_dc');
            $('#native_place_village_for_dc').val(formData.native_place_village == 0 ? '' : formData.native_place_village);
        } else {
            var districtData = tempDistrictData[formData.native_place_state] ? tempDistrictData[formData.native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'native_place_district_for_dc', 'district_code', 'district_name', 'District');
            $('#native_place_district_for_dc').val(formData.native_place_district == 0 ? '' : formData.native_place_district);
            that.getEditVillageData(formData.native_place_state, formData.native_place_district, 'dc', formData.native_place_village, 'native_place');
            $('#native_place_village_for_dc').val(formData.native_place_village);
        }

        $('#applicant_education_for_dc').val(formData.applicant_education);
        if (formData.applicant_education == VALUE_FIVE)
            $('.other_education_div_for_dc').show();
        $('#com_addr_city_for_dc').val(formData.com_addr_city);
        $('#per_addr_city_for_dc').val(formData.per_addr_city);
        $('#village_name_for_dc').val(formData.village_name);
        $('#district').val(formData.district);
        $('#occupation_for_dc').val(formData.occupation);
        if (formData.occupation == VALUE_TWELVE) {
            $('.other_occupation_div_for_dc').show();
        }
        if (formData.billingtoo == isChecked) {
            $('#billingtoo_for_dc').attr('checked', 'checked');
        }


        $('.father_info_div').collapse().show();
        $('.mother_info_div').collapse().show();
        if (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE) {
            $('.spouse_info_div').collapse().show();
        }
        // Father
        $('#father_born_place_state_for_dc').val(fatherDetails.father_born_place_state == 0 ? '' : fatherDetails.father_born_place_state);
        var districtData = tempDistrictData[fatherDetails.father_born_place_state] ? tempDistrictData[fatherDetails.father_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_born_place_district_for_dc', 'district_code', 'district_name', 'District');
        $('#father_born_place_district_for_dc').val(fatherDetails.father_born_place_district == 0 ? '' : fatherDetails.father_born_place_district);
        that.getEditVillageData(fatherDetails.father_born_place_state, fatherDetails.father_born_place_district, 'dc', fatherDetails.father_born_place_village, 'father_born_place');
        $('#father_native_place_state_for_dc').val(fatherDetails.father_native_place_state == 0 ? '' : fatherDetails.father_native_place_state);

        if (formData.constitution_artical == VALUE_FOUR) {
            var father_native_state = fatherDetails.father_native_place_state;
            var fatherDistrictData = father_native_state == VALUE_ONE ? damandiudistrictArray : (father_native_state == VALUE_TWO ? dnhdistrictArray : []);
            renderOptionsForTwoDimensionalArray(fatherDistrictData, 'father_native_place_district_for_dc');
            $('#father_native_place_district_for_dc').val(fatherDetails.father_native_place_district == 0 ? '' : fatherDetails.father_native_place_district);
            var father_native_district = fatherDetails.father_native_place_district;
            var fatherVillageDataForNative = father_native_district == VALUE_ONE ? damanVillageForNativeArray : (father_native_district == VALUE_TWO ? diuVillagesForNativeArray : (father_native_district == VALUE_THREE ? dnhVillagesForNativeArray : []));
            renderOptionsForTwoDimensionalArray(fatherVillageDataForNative, 'father_native_place_village_for_dc');
            $('#father_native_place_village_for_dc').val(fatherDetails.father_native_place_village == 0 ? '' : fatherDetails.father_native_place_village);
        } else {
            var districtData = tempDistrictData[fatherDetails.father_native_place_state] ? tempDistrictData[fatherDetails.father_native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'father_native_place_district_for_dc', 'district_code', 'district_name', 'District');
            $('#father_native_place_district_for_dc').val(fatherDetails.father_native_place_district == 0 ? '' : fatherDetails.father_native_place_district);
            that.getEditVillageData(fatherDetails.father_native_place_state, fatherDetails.father_native_place_district, 'dc', fatherDetails.father_native_place_village, 'father_native_place');
        }
        $('#father_city_for_dc').val(fatherDetails.father_city);
        $('#father_occupation_for_dc').val(fatherDetails.father_occupation);
        if (fatherDetails.father_occupation == VALUE_TWELVE)
            $('.father_other_occupation_div_for_dc').show();
        // Mother
        $('#mother_born_place_state_for_dc').val(motherDetails.mother_born_place_state == 0 ? '' : motherDetails.mother_born_place_state);
        var districtData = tempDistrictData[motherDetails.mother_born_place_state] ? tempDistrictData[motherDetails.mother_born_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_born_place_district_for_dc', 'district_code', 'district_name', 'District');
        $('#mother_born_place_district_for_dc').val(motherDetails.mother_born_place_district == 0 ? '' : motherDetails.mother_born_place_district);
        that.getEditVillageData(motherDetails.mother_born_place_state, motherDetails.mother_born_place_district, 'dc', motherDetails.mother_born_place_village, 'mother_born_place');
        $('#mother_native_place_state_for_dc').val(motherDetails.mother_native_place_state == 0 ? '' : motherDetails.mother_native_place_state);
        var districtData = tempDistrictData[motherDetails.mother_native_place_state] ? tempDistrictData[motherDetails.mother_native_place_state] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'mother_native_place_district_for_dc', 'district_code', 'district_name', 'District');
        $('#mother_native_place_district_for_dc').val(motherDetails.mother_native_place_district == 0 ? '' : motherDetails.mother_native_place_district);
        that.getEditVillageData(motherDetails.mother_native_place_state, motherDetails.mother_native_place_district, 'dc', motherDetails.mother_native_place_village, 'mother_native_place');
        $('#mother_city_for_dc').val(motherDetails.mother_city);
        $('#mother_occupation_for_dc').val(motherDetails.mother_occupation);
        if (motherDetails.mother_occupation == VALUE_TWELVE)
            $('.mother_other_occupation_div_for_dc').show();
        if (formData.marital_status == VALUE_ONE || formData.marital_status == VALUE_THREE) {
            // Spouse
            $('#spouse_born_place_state_for_dc').val(spouseDetails.spouse_born_place_state == 0 ? '' : spouseDetails.spouse_born_place_state);
            var districtData = tempDistrictData[spouseDetails.spouse_born_place_state] ? tempDistrictData[spouseDetails.spouse_born_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_born_place_district_for_dc', 'district_code', 'district_name', 'District');
            $('#spouse_born_place_district_for_dc').val(spouseDetails.spouse_born_place_district == 0 ? '' : spouseDetails.spouse_born_place_district);
            that.getEditVillageData(spouseDetails.spouse_born_place_state, spouseDetails.spouse_born_place_district, 'dc', spouseDetails.spouse_born_place_village, 'spouse_born_place');
            $('#spouse_native_place_state_for_dc').val(spouseDetails.spouse_native_place_state == 0 ? '' : spouseDetails.spouse_native_place_state);
            var districtData = tempDistrictData[spouseDetails.spouse_native_place_state] ? tempDistrictData[spouseDetails.spouse_native_place_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'spouse_native_place_district_for_dc', 'district_code', 'district_name', 'District');
            $('#spouse_native_place_district_for_dc').val(spouseDetails.spouse_native_place_district == 0 ? '' : spouseDetails.spouse_native_place_district);
            that.getEditVillageData(spouseDetails.spouse_native_place_state, spouseDetails.spouse_native_place_district, 'dc', spouseDetails.spouse_native_place_village, 'spouse_native_place');
            $('#spouse_city_for_dc').val(spouseDetails.spouse_city);
            $('#spouse_occupation_for_dc').val(spouseDetails.spouse_occupation);
            if (spouseDetails.spouse_occupation == VALUE_TWELVE) {
                $('.spouse_other_occupation_div_for_dc').show();
            }
        }

        if (fatherDetails.father_alive == VALUE_ONE) {
            $('.father_proof_item_container_for_dc').show();
            $('.father_death_proof_item_container_for_dc').hide();
            $('.is_father_alive_container_for_dc').show();
        } else if (fatherDetails.father_alive == VALUE_TWO) {
            $('.father_proof_item_container_for_dc').hide();
            $('.father_death_proof_item_container_for_dc').show();
            $('.is_father_alive_container_for_dc').hide();
        }

        if (motherDetails.mother_alive == VALUE_ONE) {
            $('.mother_proof_item_container_for_dc').show();
            $('.mother_death_proof_item_container_for_dc').hide();
            $('.is_mother_alive_container_for_dc').show();
        } else if (motherDetails.mother_alive == VALUE_TWO) {
            $('.mother_proof_item_container_for_dc').hide();
            $('.mother_death_proof_item_container_for_dc').show();
            $('.is_mother_alive_container_for_dc').hide();
        }

        if (spouseDetails.spouse_alive == VALUE_ONE) {
            $('.spouse_proof_item_container_for_dc').show();
            $('.spouse_death_proof_item_container_for_dc').hide();
            $('.is_spouse_alive_container_for_dc').show();
        } else if (spouseDetails.spouse_alive == VALUE_TWO) {
            $('.spouse_proof_item_container_for_dc').hide();
            $('.spouse_death_proof_item_container_for_dc').show();
            $('.is_spouse_alive_container_for_dc').hide();
        }

        $('#declaration_for_dc').attr('checked', 'checked');
        if (formData.marital_status == VALUE_ONE) {
            $('#spouse_alive_for_dc_1').prop('checked', true);
        } else if (formData.marital_status == VALUE_THREE) {
            $('#spouse_alive_for_dc_2').prop('checked', true);
        }
        var words = formData.residing_year.split(' ');
        residing_year = (words[0]);
        residing_month = (words[2]);
        residing_days = (words[4]);
        $('#residing_year_for_dc').val(residing_year);
        $('#residing_month_for_dc').val(residing_month);
        $('#residing_days_for_dc').val(residing_days);
    },
    downloadExcelForDC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_dcge').val($('#app_no_for_domicile_list').val());
        $('#app_date_for_dcge').val($('#application_date_for_domicile_list').val());
        $('#app_details_for_dcge').val($('#app_details_for_domicile_list').val());
        $('#vdw_for_dcge').val(tempTypeInSession != TEMP_TYPE_A ? $('#vdw_for_domicile_list').val() : '');
        $('#status_for_dcge').val($('#status_for_domicile_list').val());
        $('#qstatus_for_dcge').val($('#query_status_for_domicile_list').val());
        $('#app_status_for_dcge').val($('#appointment_status_for_domicile_list').val());
        $('#currently_on_for_dcge').val($('#currently_on_for_domicile_list').val());
        $('#generate_excel_for_domicile').submit();
        $('.dcge').val('');
    },
    addVerificationDocItem: function (docData, moduleId) {
        var that = this;
        docData.cnt = verifyDocCnt;
        docData.verification_type = moduleId;
        $('#upload_verification_doc_item_container_for_domicile_' + moduleId).append(domicileFieldVerificationDocItemTemplate(docData));
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
        formData.append('domicile_certificate_id_for_domicile_update_basic_detail', $('#domicile_certificate_id_for_domicile_update_basic_detail').val());
        formData.append('field_document_id_for_field_verification', $('#field_document_id_for_field_verification_' + tempCnt).val());
        formData.append('verification_type_for_field_verification', $('#verification_type_for_field_verification_' + tempCnt).val());
        formData.append('document_for_verification_document', $('#' + id)[0].files[0]);
        $.ajax({
            type: 'POST',
            url: 'domicile/upload_field_verification_document',
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
        $('#' + documentFieldName + '_name_href_for_verification_document_' + cnt).attr('href', 'documents/domicile/' + docItemData[documentFieldName]);
        $('#' + documentFieldName + '_name_for_verification_document_' + cnt).html(VIEW_UPLODED_DOCUMENT);
        $('#' + documentFieldName + '_remove_btn_for_verification_document_' + cnt).attr('onclick', 'Domicile.listview.askForRemoveDocForFieldVerification("' + docItemData.field_verification_document_id + '","' + cnt + '")');
    },
    askForRemoveDocForFieldVerification: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'Domicile.listview.removeFieldDoc(' + fieldDocumentId + ', ' + cnt + ')';
        showConfirmation(yesEvent, 'Remove');
    },
    removeFieldDoc: function (fieldDocumentId, cnt) {
        if (!fieldDocumentId || !cnt) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'domicile/remove_field_document',
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
        var yesEvent = 'Domicile.listview.removeFieldItemRow(' + cnt + ')';
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
            url: 'domicile/remove_field_document_item',
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(domicileFieldVerificationViewDocItemTemplate(docDetail));
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
                $('#document_item_container_for_field_verification_view_' + moduleId).append(domicileFieldVerificationViewDocItemTemplate(reDocDetail));
                if (reDocDetail['document'] != '') {
                    that.loadFieldDocForView(reDocDetail.cnt, 'document', 'field_reverification', reDocDetail.document);
                }
            });
        }
    },
    loadFieldDocForView: function (tempCnt, id, moduleType, docField) {
        $('#' + id + '_container_for_' + moduleType + '_view_' + tempCnt).hide();
        $('#' + id + '_name_container_for_' + moduleType + '_view_' + tempCnt).show();
        $('#' + id + '_name_href_for_' + moduleType + '_view_' + tempCnt).attr('href', 'documents/domicile/' + docField);
        $('#' + id + '_name_for_' + moduleType + '_view_' + tempCnt).html(VIEW_UPLODED_DOCUMENT);
    },
});
