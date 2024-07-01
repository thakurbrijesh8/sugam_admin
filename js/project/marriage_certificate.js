var marriageCertificateListTemplate = Handlebars.compile($('#marriage_certificate_list_template').html());
var marriageCertificateTableTemplate = Handlebars.compile($('#marriage_certificate_table_template').html());
var marriageCertificateActionTemplate = Handlebars.compile($('#marriage_certificate_action_template').html());
var marriageCertificateFormTemplate = Handlebars.compile($('#marriage_certificate_form_template').html());
var marriageCertificateViewTemplate = Handlebars.compile($('#marriage_certificate_view_template').html());
var marriageCertificateDeclarationTemplate = Handlebars.compile($('#marriage_certificate_declaration_template').html());
var marriageCertificateWitnessTemplate = Handlebars.compile($('#marriage_certificate_witness_template').html());
var marriageCertificateWitnessItemTemplate = Handlebars.compile($('#marriage_certificate_witness_item_template').html());
var marriageCertificateApproveTemplate = Handlebars.compile($('#marriage_certificate_approve_template').html());
var marriageCertificateRejectTemplate = Handlebars.compile($('#marriage_certificate_reject_template').html());

var tempWitnessCnt = 1;
var verifyDocCnt = 1;

var MarriageCertificate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
MarriageCertificate.Router = Backbone.Router.extend({
    routes: {
        'marriage_certificate': 'renderList',
        'marriage_certificate_form': 'renderList',
        'edit_marriage_certificate_form': 'renderList',
        'view_marriage_certificate_form': 'renderList',
    },
    renderList: function () {
        MarriageCertificate.listview.listPage();
    },
});
MarriageCertificate.listView = Backbone.View.extend({
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
        addClass('subr_marriage_certificate', 'active');
        MarriageCertificate.router.navigate('marriage_certificate');
        var templateData = {};
        this.$el.html(marriageCertificateListTemplate(templateData));
        this.loadMarriageCertificateData(sDistrict, sType);
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
                tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) && (rowData.status == VALUE_TWO || rowData.status == VALUE_THREE) && (rowData.query_status == VALUE_ZERO || rowData.query_status == VALUE_THREE) && (rowData.declaration_status == VALUE_ONE && rowData.witness_status == VALUE_ONE)) {
            rowData.show_approve_btn = '';
        } else {
            rowData.show_approve_btn = 'display: none;';
        }
        rowData.module_type = VALUE_EIGHTEEN;
        if (rowData.status == VALUE_FIVE) {
            rowData.download_certificate_style = '';
        } else {
            rowData.download_certificate_style = 'display: none;';
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_pa_btn = true;
        }
        return marriageCertificateActionTemplate(rowData);
    },
    loadMarriageCertificateData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.communication_address + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '<br><b><i class="fas fa-calendar f-s-10px"></i> :- ' + dateTo_DD_MM_YYYY(full.applicant_dob) + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = (data == VALUE_ONE ? damanVillagesArray : (data == VALUE_TWO ? diuVillagesArray : (data == VALUE_THREE ? dnhVillagesArray : [])));
            return (talukaArray[data] ? talukaArray[data] : '');
        };
        var brideGroomDetailsRenderer = function (data, type, full, meta) {
            return  '<b>Bridegroom :- </b>' + full.bridegroom_name + '<br><b>Father :- </b>'
                    + full.bridegroom_father_name + '<br><b>Mother :- </b>' + full.bridegroom_mother_name + '</b>';
        };
        var brideDetailsRenderer = function (data, type, full, meta) {
            return  '<b>Bride :- </b>' + full.bride_name + '<br><b>Father :- </b>'
                    + full.bride_father_name + '<br><b>Mother :- </b>' + full.bride_mother_name + '</b>';
        };
        var that = this;
        MarriageCertificate.router.navigate('marriage_certificate');
        var searchData = dtomMam(sDistrict, sType, 'MarriageCertificate.listview.loadMarriageCertificateData();');
        $('#marriage_certificate_form_and_datatable_container').html(marriageCertificateTableTemplate(searchData));
        renderOptionsForTwoDimensionalArray(appStatusTextArray, 'status_for_marriage_certificate_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_marriage_certificate_list', false);
        if (tempTypeInSession != TEMP_TYPE_A) {
            var dwVillagesData = (tempDistrictInSession == VALUE_ONE ? damanVillagesArray : (tempDistrictInSession == VALUE_TWO ? diuVillagesArray : (tempDistrictInSession == VALUE_THREE ? dnhVillagesArray : [])));
            if (tempAVInSession != '') {
                var avData = tempAVInSession.split(',');
                renderOptionsForAVArray(avData, dwVillagesData, 'vdw_for_marriage_certificate_list', false);
            } else {
                renderOptionsForTwoDimensionalArray(dwVillagesData, 'vdw_for_marriage_certificate_list', false);
            }
        }
        if (sType == VALUE_ONE || sType == VALUE_TWO) {
            $('#query_status_for_marriage_certificate_list').val(sType);
            $('#query_status_for_marriage_certificate_list').attr('disabled', 'disabled');
        }
        if (sType == VALUE_THREE || sType == VALUE_FIVE || sType == VALUE_SIX) {
            $('#status_for_marriage_certificate_list').val(sType);
            $('#status_for_marriage_certificate_list').attr('disabled', 'disabled');
        }
        if (sType == VALUE_FOUR || sType == VALUE_SEVEN) {
            if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && (sType == VALUE_FOUR || sType == VALUE_SEVEN)) {
                $('#currently_on_for_marriage_certificate_list').val(VALUE_ONE);
                $('#currently_on_for_marriage_certificate_list').attr('disabled', 'disabled');
            }
        }
        if (sType == VALUE_EIGHT) {
            $('#currently_on_for_marriage_certificate_list').val(VALUE_TWO);
            $('#currently_on_for_marriage_certificate_list').attr('disabled', 'disabled');
        }
        marriageCertificateDataTable = $('#marriage_certificate_datatable').DataTable({
            ajax: {
                url: 'marriage_certificate/get_marriage_certificate_data',
                dataSrc: "marriage_certificate_data",
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
                {data: 'marriage_certificate_id', 'class': 'f-s-app-details v-a-t', 'render': brideGroomDetailsRenderer},
                {data: 'marriage_certificate_id', 'class': 'f-s-app-details v-a-t', 'render': brideDetailsRenderer},
                {data: 'marriage_certificate_id', 'class': 'v-a-m text-center', 'render': queryStatusRenderer},
                {data: 'marriage_certificate_id', 'class': 'text-center', 'render': appReverifyStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#marriage_certificate_datatable_filter').remove();
        $('#marriage_certificate_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = marriageCertificateDataTable.row(tr);

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
    newMarriageCertificateForm: function (isEdit, mcData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (isEdit) {
            MarriageCertificate.router.navigate('edit_marriage_certificate_form');
        } else {
            MarriageCertificate.router.navigate('marriage_certificate_form');
        }
        mcData.VALUE_ONE = VALUE_ONE;
        mcData.VALUE_TWO = VALUE_TWO;
        mcData.VALUE_THREE = VALUE_THREE;
        mcData.VALUE_FOUR = VALUE_FOUR;
        mcData.VALUE_FIVE = VALUE_FIVE;
        mcData.VALUE_SIX = VALUE_SIX;
        mcData.VALUE_SEVEN = VALUE_SEVEN;
        mcData.VALUE_EIGHT = VALUE_EIGHT;
        mcData.VALUE_NINE = VALUE_NINE;
        mcData.VALUE_TEN = VALUE_TEN;
        mcData.VALUE_ELEVEN = VALUE_ELEVEN;
        mcData.VALUE_TWELVE = VALUE_TWELVE;
        mcData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        mcData.VALUE_FOURTEEN = VALUE_FOURTEEN;
        mcData.VIEW_UPLODED_DOCUMENT = VIEW_UPLODED_DOCUMENT;
        $('#marriage_certificate_form_and_datatable_container').html(marriageCertificateFormTemplate(mcData));
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_marriage_certificate');
        var district = mcData.district;

        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bridegroom_birthplace_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bridegroom_residence_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bridegroom_father_birthplace_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bridegroom_father_residence_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bridegroom_mother_birthplace_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bridegroom_mother_residence_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');


        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bride_birthplace_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bride_residence_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bride_father_birthplace_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bride_father_residence_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bride_mother_birthplace_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempStateData, 'bride_mother_residence_state_for_marriage_certificate', 'state_code', 'state_name', 'State / UT');

        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'bridegroom_occupation_for_marriage_certificate');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'bridegroom_father_occupation_for_marriage_certificate');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'bridegroom_mother_occupation_for_marriage_certificate');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'bride_occupation_for_marriage_certificate');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'bride_father_occupation_for_marriage_certificate');
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'bride_mother_occupation_for_marriage_certificate');

        if (isEdit) {
            ///bridegroom
            $('#bridegroom_birthplace_state_for_marriage_certificate').val(mcData.bridegroom_birthplace_state == 0 ? '' : mcData.bridegroom_birthplace_state);
            var districtData = tempDistrictData[mcData.bridegroom_birthplace_state] ? tempDistrictData[mcData.bridegroom_birthplace_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bridegroom_birthplace_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bridegroom_birthplace_district_for_marriage_certificate').val(mcData.bridegroom_birthplace_district == 0 ? '' : mcData.bridegroom_birthplace_district);
            that.getEditVillageDataForMC(mcData.bridegroom_birthplace_state, mcData.bridegroom_birthplace_district, 'marriage_certificate', mcData.bridegroom_birthplace_village, 'bridegroom_birthplace');

            $('#bridegroom_residence_state_for_marriage_certificate').val(mcData.bridegroom_residence_state == 0 ? '' : mcData.bridegroom_residence_state);
            var districtData = tempDistrictData[mcData.bridegroom_residence_state] ? tempDistrictData[mcData.bridegroom_residence_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bridegroom_residence_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bridegroom_residence_district_for_marriage_certificate').val(mcData.bridegroom_residence_district == 0 ? '' : mcData.bridegroom_residence_district);


            $('#bridegroom_father_birthplace_state_for_marriage_certificate').val(mcData.bridegroom_father_birthplace_state == 0 ? '' : mcData.bridegroom_father_birthplace_state);
            var districtData = tempDistrictData[mcData.bridegroom_father_birthplace_state] ? tempDistrictData[mcData.bridegroom_father_birthplace_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bridegroom_father_birthplace_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bridegroom_father_birthplace_district_for_marriage_certificate').val(mcData.bridegroom_father_birthplace_district == 0 ? '' : mcData.bridegroom_father_birthplace_district);
            that.getEditVillageDataForMC(mcData.bridegroom_father_birthplace_state, mcData.bridegroom_father_birthplace_district, 'marriage_certificate', mcData.bridegroom_father_birthplace_village, 'bridegroom_father_birthplace');

            $('#bridegroom_father_residence_state_for_marriage_certificate').val(mcData.bridegroom_father_residence_state == 0 ? '' : mcData.bridegroom_father_residence_state);
            var districtData = tempDistrictData[mcData.bridegroom_father_residence_state] ? tempDistrictData[mcData.bridegroom_father_residence_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bridegroom_father_residence_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bridegroom_father_residence_district_for_marriage_certificate').val(mcData.bridegroom_father_residence_district == 0 ? '' : mcData.bridegroom_father_residence_district);


            $('#bridegroom_mother_birthplace_state_for_marriage_certificate').val(mcData.bridegroom_mother_birthplace_state == 0 ? '' : mcData.bridegroom_mother_birthplace_state);
            var districtData = tempDistrictData[mcData.bridegroom_mother_birthplace_state] ? tempDistrictData[mcData.bridegroom_mother_birthplace_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bridegroom_mother_birthplace_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bridegroom_mother_birthplace_district_for_marriage_certificate').val(mcData.bridegroom_mother_birthplace_district == 0 ? '' : mcData.bridegroom_mother_birthplace_district);
            that.getEditVillageDataForMC(mcData.bridegroom_mother_birthplace_state, mcData.bridegroom_mother_birthplace_district, 'marriage_certificate', mcData.bridegroom_mother_birthplace_village, 'bridegroom_mother_birthplace');

            $('#bridegroom_mother_residence_state_for_marriage_certificate').val(mcData.bridegroom_mother_residence_state == 0 ? '' : mcData.bridegroom_mother_residence_state);
            var districtData = tempDistrictData[mcData.bridegroom_mother_residence_state] ? tempDistrictData[mcData.bridegroom_mother_residence_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bridegroom_mother_residence_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bridegroom_mother_residence_district_for_marriage_certificate').val(mcData.bridegroom_mother_residence_district == 0 ? '' : mcData.bridegroom_mother_residence_district);

            ///bride

            $('#bride_birthplace_state_for_marriage_certificate').val(mcData.bride_birthplace_state == 0 ? '' : mcData.bride_birthplace_state);
            var districtData = tempDistrictData[mcData.bride_birthplace_state] ? tempDistrictData[mcData.bride_birthplace_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bride_birthplace_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bride_birthplace_district_for_marriage_certificate').val(mcData.bride_birthplace_district == 0 ? '' : mcData.bride_birthplace_district);
            that.getEditVillageDataForMC(mcData.bride_birthplace_state, mcData.bride_birthplace_district, 'marriage_certificate', mcData.bride_birthplace_village, 'bride_birthplace');

            $('#bride_residence_state_for_marriage_certificate').val(mcData.bride_residence_state == 0 ? '' : mcData.bride_residence_state);
            var districtData = tempDistrictData[mcData.bride_residence_state] ? tempDistrictData[mcData.bride_residence_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bride_residence_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bride_residence_district_for_marriage_certificate').val(mcData.bride_residence_district == 0 ? '' : mcData.bride_residence_district);


            $('#bride_father_birthplace_state_for_marriage_certificate').val(mcData.bride_father_birthplace_state == 0 ? '' : mcData.bride_father_birthplace_state);
            var districtData = tempDistrictData[mcData.bride_father_birthplace_state] ? tempDistrictData[mcData.bride_father_birthplace_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bride_father_birthplace_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bride_father_birthplace_district_for_marriage_certificate').val(mcData.bride_father_birthplace_district == 0 ? '' : mcData.bride_father_birthplace_district);
            that.getEditVillageDataForMC(mcData.bride_father_birthplace_state, mcData.bride_father_birthplace_district, 'marriage_certificate', mcData.bride_father_birthplace_village, 'bride_father_birthplace');

            $('#bride_father_residence_state_for_marriage_certificate').val(mcData.bride_father_residence_state == 0 ? '' : mcData.bride_father_residence_state);
            var districtData = tempDistrictData[mcData.bride_father_residence_state] ? tempDistrictData[mcData.bride_father_residence_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bride_father_residence_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bride_father_residence_district_for_marriage_certificate').val(mcData.bride_father_residence_district == 0 ? '' : mcData.bride_father_residence_district);


            $('#bride_mother_birthplace_state_for_marriage_certificate').val(mcData.bride_mother_birthplace_state == 0 ? '' : mcData.bride_mother_birthplace_state);
            var districtData = tempDistrictData[mcData.bride_mother_birthplace_state] ? tempDistrictData[mcData.bride_mother_birthplace_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bride_mother_birthplace_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bride_mother_birthplace_district_for_marriage_certificate').val(mcData.bride_mother_birthplace_district == 0 ? '' : mcData.bride_mother_birthplace_district);
            that.getEditVillageDataForMC(mcData.bride_mother_birthplace_state, mcData.bride_mother_birthplace_district, 'marriage_certificate', mcData.bride_mother_birthplace_village, 'bride_mother_birthplace');

            $('#bride_mother_residence_state_for_marriage_certificate').val(mcData.bride_mother_residence_state == 0 ? '' : mcData.bride_mother_residence_state);
            var districtData = tempDistrictData[mcData.bride_mother_residence_state] ? tempDistrictData[mcData.bride_mother_residence_state] : [];
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, 'bride_mother_residence_district_for_marriage_certificate', 'district_code', 'district_name', 'District');
            $('#bride_mother_residence_district_for_marriage_certificate').val(mcData.bride_mother_residence_district == 0 ? '' : mcData.bride_mother_residence_district);

            $('#district_for_marriage_certificate').val(mcData.district);
            $('#bridegroom_occupation_for_marriage_certificate').val(mcData.bridegroom_occupation);
            if (mcData.bridegroom_occupation == VALUE_TWELVE) {
                $('.bridegroom_other_occupation_div_for_marriage_certificate').show();
            }

            $('#bridegroom_father_occupation_for_marriage_certificate').val(mcData.bridegroom_father_occupation);
            if (mcData.bridegroom_father_occupation == VALUE_TWELVE) {
                $('.bridegroom_father_other_occupation_div_for_marriage_certificate').show();
            }

            $('#bridegroom_mother_occupation_for_marriage_certificate').val(mcData.bridegroom_mother_occupation);
            if (mcData.bridegroom_mother_occupation == VALUE_TWELVE) {
                $('.bridegroom_mother_other_occupation_div_for_marriage_certificate').show();
            }

            $('#bride_occupation_for_marriage_certificate').val(mcData.bride_occupation);
            if (mcData.bride_occupation == VALUE_TWELVE) {
                $('.bride_other_occupation_div_for_marriage_certificate').show();
            }

            $('#bride_father_occupation_for_marriage_certificate').val(mcData.bride_father_occupation);
            if (mcData.bride_father_occupation == VALUE_TWELVE) {
                $('.bride_father_other_occupation_div_for_marriage_certificate').show();
            }

            $('#bride_mother_occupation_for_marriage_certificate').val(mcData.bride_mother_occupation);
            if (mcData.bride_mother_occupation == VALUE_TWELVE) {
                $('.bride_mother_other_occupation_div_for_marriage_certificate').show();
            }

            if (mcData.bridegroom_photo != '') {
                that.showDocument('bridegroom_photo_container_for_marriage_certificate', 'bridegroom_photo_name_image_for_marriage_certificate', 'bridegroom_photo_name_container_for_marriage_certificate',
                        'bridegroom_photo_download', 'bridegroom_photo', mcData.bridegroom_photo, mcData.marriage_certificate_id, VALUE_ONE);
            }
            // if (mcData.bride_photo != '') {
            //     that.showDocument('bride_photo_container_for_marriage_certificate', 'bride_photo_name_image_for_marriage_certificate', 'bride_photo_name_container_for_marriage_certificate',
            //             'bride_photo_download', 'bride_photo', mcData.bride_photo, mcData.marriage_certificate_id, VALUE_TWO);
            // }
            if (mcData.bridegroom_birth_certi_doc != '') {
                that.showDocument('bridegroom_birth_certi_doc_container_for_marriage_certificate', 'bridegroom_birth_certi_doc_name_image_for_marriage_certificate', 'bridegroom_birth_certi_doc_name_container_for_marriage_certificate',
                        'bridegroom_birth_certi_doc_download', 'bridegroom_birth_certi_doc', mcData.bridegroom_birth_certi_doc, mcData.marriage_certificate_id, VALUE_THREE);
            }
            if (mcData.bridegroom_passport_copy_doc != '') {
                that.showDocument('bridegroom_passport_copy_doc_container_for_marriage_certificate', 'bridegroom_passport_copy_doc_name_image_for_marriage_certificate', 'bridegroom_passport_copy_doc_name_container_for_marriage_certificate',
                        'bridegroom_passport_copy_doc_download', 'bridegroom_passport_copy_doc', mcData.bridegroom_passport_copy_doc, mcData.marriage_certificate_id, VALUE_FOUR);
            }
            if (mcData.bridegroom_domicile_certi_doc != '') {
                that.showDocument('bridegroom_domicile_certi_doc_container_for_marriage_certificate', 'bridegroom_domicile_certi_doc_name_image_for_marriage_certificate', 'bridegroom_domicile_certi_doc_name_container_for_marriage_certificate',
                        'bridegroom_domicile_certi_doc_download', 'bridegroom_domicile_certi_doc', mcData.bridegroom_domicile_certi_doc, mcData.marriage_certificate_id, VALUE_FIVE);
            }
            if (mcData.bridegroom_aadhar_card_doc != '') {
                that.showDocument('bridegroom_aadhar_card_doc_container_for_marriage_certificate', 'bridegroom_aadhar_card_doc_name_image_for_marriage_certificate', 'bridegroom_aadhar_card_doc_name_container_for_marriage_certificate',
                        'bridegroom_aadhar_card_doc_download', 'bridegroom_aadhar_card_doc', mcData.bridegroom_aadhar_card_doc, mcData.marriage_certificate_id, VALUE_SIX);
            }
            if (mcData.bridegroom_election_card_doc != '') {
                that.showDocument('bridegroom_election_card_doc_container_for_marriage_certificate', 'bridegroom_election_card_doc_name_image_for_marriage_certificate', 'bridegroom_election_card_doc_name_container_for_marriage_certificate',
                        'bridegroom_election_card_doc_download', 'bridegroom_election_card_doc', mcData.bridegroom_election_card_doc, mcData.marriage_certificate_id, VALUE_SEVEN);
            }
            if (mcData.bridegroom_court_order_certi_doc != '') {
                that.showDocument('bridegroom_court_order_certi_doc_container_for_marriage_certificate', 'bridegroom_court_order_certi_doc_name_image_for_marriage_certificate', 'bridegroom_court_order_certi_doc_name_container_for_marriage_certificate',
                        'bridegroom_court_order_certi_doc_download', 'bridegroom_court_order_certi_doc', mcData.bridegroom_court_order_certi_doc, mcData.marriage_certificate_id, VALUE_EIGHT);
            }
            if (mcData.bride_birth_certi_doc != '') {
                that.showDocument('bride_birth_certi_doc_container_for_marriage_certificate', 'bride_birth_certi_doc_name_image_for_marriage_certificate', 'bride_birth_certi_doc_name_container_for_marriage_certificate',
                        'bride_birth_certi_doc_download', 'bride_birth_certi_doc', mcData.bride_birth_certi_doc, mcData.marriage_certificate_id, VALUE_NINE);
            }
            if (mcData.bride_passport_copy_doc != '') {
                that.showDocument('bride_passport_copy_doc_container_for_marriage_certificate', 'bride_passport_copy_doc_name_image_for_marriage_certificate', 'bride_passport_copy_doc_name_container_for_marriage_certificate',
                        'bride_passport_copy_doc_download', 'bride_passport_copy_doc', mcData.bride_passport_copy_doc, mcData.marriage_certificate_id, VALUE_TEN);
            }
            if (mcData.bride_domicile_certi_doc != '') {
                that.showDocument('bride_domicile_certi_doc_container_for_marriage_certificate', 'bride_domicile_certi_doc_name_image_for_marriage_certificate', 'bride_domicile_certi_doc_name_container_for_marriage_certificate',
                        'bride_domicile_certi_doc_download', 'bride_domicile_certi_doc', mcData.bride_domicile_certi_doc, mcData.marriage_certificate_id, VALUE_ELEVEN);
            }
            if (mcData.bride_aadhar_card_doc != '') {
                that.showDocument('bride_aadhar_card_doc_container_for_marriage_certificate', 'bride_aadhar_card_doc_name_image_for_marriage_certificate', 'bride_aadhar_card_doc_name_container_for_marriage_certificate',
                        'bride_aadhar_card_doc_download', 'bride_aadhar_card_doc', mcData.bride_aadhar_card_doc, mcData.marriage_certificate_id, VALUE_TWELVE);
            }
            if (mcData.bride_election_card_doc != '') {
                that.showDocument('bride_election_card_doc_container_for_marriage_certificate', 'bride_election_card_doc_name_image_for_marriage_certificate', 'bride_election_card_doc_name_container_for_marriage_certificate',
                        'bride_election_card_doc_download', 'bride_election_card_doc', mcData.bride_election_card_doc, mcData.marriage_certificate_id, VALUE_THIRTEEN);
            }
            if (mcData.bride_court_order_certi_doc != '') {
                that.showDocument('bride_court_order_certi_doc_container_for_marriage_certificate', 'bride_court_order_certi_doc_name_image_for_marriage_certificate', 'bride_court_order_certi_doc_name_container_for_marriage_certificate',
                        'bride_court_order_certi_doc_download', 'bride_court_order_certi_doc', mcData.bride_court_order_certi_doc, mcData.marriage_certificate_id, VALUE_FOURTEEN);
            }
            if (mcData.samaj_marriage_certi_doc != '') {
                that.showDocument('samaj_marriage_certi_doc_container_for_marriage_certificate', 'samaj_marriage_certi_doc_name_image_for_marriage_certificate', 'samaj_marriage_certi_doc_name_container_for_marriage_certificate',
                        'samaj_marriage_certi_doc_download', 'samaj_marriage_certi_doc', mcData.samaj_marriage_certi_doc, mcData.marriage_certificate_id, VALUE_FIFTEEN);
            }

        }
        generateSelect2();
        datePicker();
        datePickerMax('applicant_dob_for_marriage_certificate');
        datePickerMax('bridegroom_dob_for_marriage_certificate');
        datePickerMax('bride_dob_for_marriage_certificate');
        allowOnlyIntegerValue('mobile_number_for_marriage_certificate');

        if (isEdit) {
            if (mcData.applicant_dob != '0000-00-00') {
                $('#applicant_dob_for_marriage_certificate').val(dateTo_DD_MM_YYYY(mcData.applicant_dob));
            }
            if (mcData.bridegroom_dob != '0000-00-00') {
                $('#bridegroom_dob_for_marriage_certificate').val(dateTo_DD_MM_YYYY(mcData.bridegroom_dob));
            }
            if (mcData.bride_dob != '0000-00-00') {
                $('#bride_dob_for_marriage_certificate').val(dateTo_DD_MM_YYYY(mcData.bride_dob));
            }
        }

        $('#marriage_certificate_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.submitMarriageCertificate(VALUE_TWO);
            }
        });
    },
    viewDocument: function (marriageCertificateData) {
        var that = this;
        if (marriageCertificateData.applicant_photo_doc != '') {
            that.showDocument('applicant_photo_doc_container_for_marriage_certificate', 'applicant_photo_doc_name_image_for_marriage_certificate', 'applicant_photo_doc_name_container_for_marriage_certificate',
                    'applicant_photo_doc_download', 'applicant_photo_doc', marriageCertificateData.applicant_photo_doc);
        }
        if (marriageCertificateData.birth_leaving_certy_doc != '') {
            that.showDocument('birth_leaving_certy_doc_container_for_marriage_certificate', 'birth_leaving_certy_doc_name_image_for_marriage_certificate', 'birth_leaving_certy_doc_name_container_for_marriage_certificate',
                    'birth_leaving_certy_doc_download', 'birth_leaving_certy_doc', marriageCertificateData.birth_leaving_certy_doc);
        }
        if (marriageCertificateData.aadhar_card_doc != '') {
            that.showDocument('aadhar_card_doc_container_for_marriage_certificate', 'aadhar_card_doc_name_image_for_marriage_certificate', 'aadhar_card_doc_name_container_for_marriage_certificate',
                    'aadhar_card_doc_download', 'aadhar_card_doc', marriageCertificateData.aadhar_card_doc);
        }
        if (marriageCertificateData.election_card_doc != '') {
            that.showDocument('election_card_doc_container_for_marriage_certificate', 'election_card_doc_name_image_for_marriage_certificate', 'election_card_doc_name_container_for_marriage_certificate',
                    'election_card_doc_download', 'election_card_doc', marriageCertificateData.election_card_doc);
        }
        if (marriageCertificateData.marriage_proof_doc != '') {
            that.showDocument('marriage_proof_doc_container_for_marriage_certificate', 'marriage_proof_doc_name_image_for_marriage_certificate', 'marriage_proof_doc_name_container_for_marriage_certificate',
                    'marriage_proof_doc_download', 'marriage_proof_doc', marriageCertificateData.marriage_proof_doc);
        }
        if (marriageCertificateData.marriage_certificate_doc != '') {
            that.showDocument('marriage_certificate_doc_container_for_marriage_certificate', 'marriage_certificate_doc_name_image_for_marriage_certificate', 'marriage_certificate_doc_name_container_for_marriage_certificate',
                    'marriage_certificate_doc_download', 'marriage_certificate_doc', marriageCertificateData.marriage_certificate_doc);
        }
        if (marriageCertificateData.death_certificate_doc != '') {
            that.showDocument('death_certificate_doc_container_for_marriage_certificate', 'death_certificate_doc_name_image_for_marriage_certificate', 'death_certificate_doc_name_container_for_marriage_certificate',
                    'death_certificate_doc_download', 'death_certificate_doc', marriageCertificateData.death_certificate_doc);
        }
        // if (marriageCertificateData.declaration_form_doc != '') {
        //     that.showDocument('declaration_form_doc_container_for_marriage_certificate', 'declaration_form_doc_name_image_for_marriage_certificate', 'declaration_form_doc_name_container_for_marriage_certificate',
        //             'declaration_form_doc_download', 'declaration_form_doc', marriageCertificateData.declaration_form_doc);
        // }
    },
    showDocument: function (containerHideId, documentSrcPathId, containerShowId, documenthrefPathId, removeDocumentBtnId, dbDocumentFieldName, dbDocumentFieldId, docValue) {
        $('#' + containerHideId).hide();
        $('#' + documentSrcPathId).attr('src', MARRIAGE_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + containerShowId).show();
        $('#' + documenthrefPathId).attr("href", MARRIAGE_CERTIFICATE_DOC_PATH + dbDocumentFieldName);
        $('#' + removeDocumentBtnId).attr('onclick', 'MarriageCertificate.listview.askForRemove("' + dbDocumentFieldId + '","' + docValue + '")');
    },
    editOrViewMarriageCertificate: function (btnObj, marriageCertificateId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!marriageCertificateId) {
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
            url: 'marriage_certificate/get_marriage_certificate_data_by_id',
            type: 'post',
            data: $.extend({}, {'marriage_certificate_id': marriageCertificateId, 'is_edit': (isEdit ? VALUE_ZERO : VALUE_ONE)}, getTokenData()),
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
                var marriageCertificateData = parseData.marriage_certificate_data;
                if (isEdit) {
                    that.newMarriageCertificateForm(isEdit, marriageCertificateData);
                } else {
                    that.viewMarriageCertificateForm(VALUE_ONE, marriageCertificateData, isPrint);
                }
            }
        });
    },
    viewMarriageCertificateForm: function (moduleType, marriageCertificateData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        if (moduleType == VALUE_ONE) {
            MarriageCertificate.router.navigate('view_marriage_certificate_form');
            marriageCertificateData.title = 'View';
        } else {
            marriageCertificateData.show_submit_btn = true;
        }
        marriageCertificateData.VALUE_THREE = VALUE_THREE;
        marriageCertificateData.MARRIAGE_CERTIFICATE_DOC_PATH = MARRIAGE_CERTIFICATE_DOC_PATH;
        marriageCertificateData.district_text = talukaArray[marriageCertificateData.district] ? talukaArray[marriageCertificateData.district] : '';
        var district = marriageCertificateData.district;

        marriageCertificateData.show_bridegroom_photo = marriageCertificateData.bridegroom_photo != '' ? true : false;
        //marriageCertificateData.show_bride_photo = marriageCertificateData.bride_photo != '' ? true : false;
        marriageCertificateData.show_bridegroom_birth_certi_doc = marriageCertificateData.bridegroom_birth_certi_doc != '' ? true : false;
        marriageCertificateData.show_bridegroom_passport_copy_doc = marriageCertificateData.bridegroom_passport_copy_doc != '' ? true : false;
        marriageCertificateData.show_bridegroom_domicile_certi_doc = marriageCertificateData.bridegroom_domicile_certi_doc != '' ? true : false;
        marriageCertificateData.show_bridegroom_aadhar_card_doc = marriageCertificateData.bridegroom_aadhar_card_doc != '' ? true : false;
        marriageCertificateData.show_bridegroom_election_card_doc = marriageCertificateData.bridegroom_election_card_doc != '' ? true : false;
        marriageCertificateData.show_bridegroom_court_order_certi_doc = marriageCertificateData.bridegroom_court_order_certi_doc != '' ? true : false;

        marriageCertificateData.show_bride_birth_certi_doc = marriageCertificateData.bride_birth_certi_doc != '' ? true : false;
        marriageCertificateData.show_bride_passport_copy_doc = marriageCertificateData.bride_passport_copy_doc != '' ? true : false;
        marriageCertificateData.show_bride_domicile_certi_doc = marriageCertificateData.bride_domicile_certi_doc != '' ? true : false;
        marriageCertificateData.show_bride_aadhar_card_doc = marriageCertificateData.bride_aadhar_card_doc != '' ? true : false;
        marriageCertificateData.show_bride_election_card_doc = marriageCertificateData.bride_election_card_doc != '' ? true : false;
        marriageCertificateData.show_bride_court_order_certi_doc = marriageCertificateData.bride_court_order_certi_doc != '' ? true : false;
        marriageCertificateData.show_samaj_marriage_certi_doc = marriageCertificateData.samaj_marriage_certi_doc != '' ? true : false;
        marriageCertificateData.show_declaration_btn = moduleType == VALUE_ONE ? true : (marriageCertificateData.declaration == VALUE_ONE ? true : false);

        marriageCertificateData.bridegroom_occupation = applicantOccupationArray[marriageCertificateData.bridegroom_occupation] ? (marriageCertificateData.bridegroom_occupation == VALUE_TWELVE ? marriageCertificateData.bridegroom_other_occupation : applicantOccupationArray[marriageCertificateData.bridegroom_occupation]) : '';
        marriageCertificateData.bridegroom_father_occupation = applicantOccupationArray[marriageCertificateData.bridegroom_father_occupation] ? (marriageCertificateData.bridegroom_father_occupation == VALUE_TWELVE ? marriageCertificateData.bridegroom_father_other_occupation : applicantOccupationArray[marriageCertificateData.bridegroom_father_occupation]) : '';
        marriageCertificateData.bridegroom_mother_occupation = applicantOccupationArray[marriageCertificateData.bridegroom_mother_occupation] ? (marriageCertificateData.bridegroom_mother_occupation == VALUE_TWELVE ? marriageCertificateData.bridegroom_mother_other_occupation : applicantOccupationArray[marriageCertificateData.bridegroom_mother_occupation]) : '';

        marriageCertificateData.bride_occupation = applicantOccupationArray[marriageCertificateData.bride_occupation] ? (marriageCertificateData.bride_occupation == VALUE_TWELVE ? marriageCertificateData.bride_other_occupation : applicantOccupationArray[marriageCertificateData.bride_occupation]) : '';
        marriageCertificateData.bride_father_occupation = applicantOccupationArray[marriageCertificateData.bride_father_occupation] ? (marriageCertificateData.bride_father_occupation == VALUE_TWELVE ? marriageCertificateData.bride_father_other_occupation : applicantOccupationArray[marriageCertificateData.bride_father_occupation]) : '';
        marriageCertificateData.bride_mother_occupation = applicantOccupationArray[marriageCertificateData.bride_mother_occupation] ? (marriageCertificateData.bride_mother_occupation == VALUE_TWELVE ? marriageCertificateData.bride_mother_other_occupation : applicantOccupationArray[marriageCertificateData.bride_mother_occupation]) : '';

        marriageCertificateData.applicant_dob = marriageCertificateData.applicant_dob != '' ? dateTo_DD_MM_YYYY(marriageCertificateData.applicant_dob) : '';
        marriageCertificateData.bridegroom_dob = marriageCertificateData.bridegroom_dob != '' ? dateTo_DD_MM_YYYY(marriageCertificateData.bridegroom_dob) : '';
        marriageCertificateData.bride_dob = marriageCertificateData.bride_dob != '' ? dateTo_DD_MM_YYYY(marriageCertificateData.bride_dob) : '';

        if (marriageCertificateData.status != VALUE_ZERO && marriageCertificateData.status != VALUE_ONE) {
            marriageCertificateData.show_print_btn = true;
        }

        showPopup();
        $('.swal2-popup').css('width', '45em');
        $('#popup_container').html(marriageCertificateViewTemplate(marriageCertificateData));
        if (marriageCertificateData.declaration == VALUE_ONE) {
            $('#declaration_for_marriage_certificate').click();
        }

        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_icview').click();
            }, 500);
        }
    },
    checkValidationForMarriageCertificate: function (moduleType, marriageCertificateData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        if (!marriageCertificateData.district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.applicant_name_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_name_for_marriage_certificate', applicantNameValidationMessage);
        }
        if (!marriageCertificateData.mobile_number_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_marriage_certificate', mobileValidationMessage);
        }
        var mobileMessage = mobileNumberValidation(marriageCertificateData.mobile_number_for_marriage_certificate);
        if (mobileMessage != '') {
            return getBasicMessageAndFieldJSONArray('mobile_number_for_marriage_certificate', mobileMessage);
        }
        if (!marriageCertificateData.communication_address_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('communication_address_for_marriage_certificate', communicationAddressValidationMessage);
        }
        if (!marriageCertificateData.permanent_address_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('permanent_address_for_marriage_certificate', communicationAddressValidationMessage);
        }
        if (!marriageCertificateData.applicant_dob_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_dob_for_marriage_certificate', birthDateValidationMessage);
        }
        if (!marriageCertificateData.applicant_age_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('applicant_age_for_marriage_certificate', ageValidationMessage);
        }
        if (moduleType == VALUE_ONE) {
            return '';
        }

        //bridegroom
        if (!marriageCertificateData.bridegroom_name_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_name_for_marriage_certificate', nameValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_birthplace_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_birthplace_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_birthplace_village_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_residence_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_residence_for_marriage_certificate', residenceValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_residence_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_residence_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_residence_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_residence_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_dob_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_dob_for_marriage_certificate', birthDateValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_age_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_age_for_marriage_certificate', ageValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_occupation_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_occupation_for_marriage_certificate', occupationValidationMessage);
        }
        if (marriageCertificateData.bridegroom_occupation_for_marriage_certificate == VALUE_TWELVE) {
            if (!marriageCertificateData.bridegroom_other_occupation_for_marriage_certificate) {
                return getBasicMessageAndFieldJSONArray('bridegroom_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);
            }
        }

        if (!marriageCertificateData.bridegroom_father_name_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_father_name_for_marriage_certificate', nameValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_father_birthplace_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_father_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_father_birthplace_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_father_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_father_birthplace_village_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_father_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_father_residence_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_father_residence_for_marriage_certificate', residenceValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_father_residence_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_father_residence_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_father_residence_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_father_residence_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_father_occupation_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_father_occupation_for_marriage_certificate', occupationValidationMessage);
        }
        if (marriageCertificateData.bridegroom_father_occupation_for_marriage_certificate == VALUE_TWELVE) {
            if (!marriageCertificateData.bridegroom_father_other_occupation_for_marriage_certificate) {
                return getBasicMessageAndFieldJSONArray('bridegroom_father_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);
            }
        }

        if (!marriageCertificateData.bridegroom_mother_name_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_mother_name_for_marriage_certificate', nameValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_mother_birthplace_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_mother_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_mother_birthplace_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_mother_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_mother_birthplace_village_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_mother_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_mother_residence_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_mother_residence_for_marriage_certificate', residenceValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_mother_residence_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_mother_residence_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_mother_residence_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_mother_residence_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bridegroom_mother_occupation_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bridegroom_mother_occupation_for_marriage_certificate', occupationValidationMessage);
        }
        if (marriageCertificateData.bridegroom_mother_occupation_for_marriage_certificate == VALUE_TWELVE) {
            if (!marriageCertificateData.bridegroom_mother_other_occupation_for_marriage_certificate) {
                return getBasicMessageAndFieldJSONArray('bridegroom_mother_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);
            }
        }

        ///bride
        if (!marriageCertificateData.bride_name_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_name_for_marriage_certificate', nameValidationMessage);
        }
        if (!marriageCertificateData.bride_birthplace_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bride_birthplace_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bride_birthplace_village_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);
        }
        if (!marriageCertificateData.bride_residence_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_residence_for_marriage_certificate', residenceValidationMessage);
        }
        if (!marriageCertificateData.bride_residence_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_residence_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bride_residence_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_residence_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bride_dob_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_dob_for_marriage_certificate', birthDateValidationMessage);
        }
        if (!marriageCertificateData.bride_age_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_age_for_marriage_certificate', ageValidationMessage);
        }
        if (!marriageCertificateData.bride_occupation_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_occupation_for_marriage_certificate', occupationValidationMessage);
        }
        if (marriageCertificateData.bride_occupation_for_marriage_certificate == VALUE_TWELVE) {
            if (!marriageCertificateData.bride_other_occupation_for_marriage_certificate) {
                return getBasicMessageAndFieldJSONArray('bride_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);
            }
        }

        if (!marriageCertificateData.bride_father_name_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_father_name_for_marriage_certificate', nameValidationMessage);
        }
        if (!marriageCertificateData.bride_father_birthplace_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_father_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bride_father_birthplace_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_father_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bride_father_birthplace_village_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_father_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);
        }
        if (!marriageCertificateData.bride_father_residence_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_father_residence_for_marriage_certificate', residenceValidationMessage);
        }
        if (!marriageCertificateData.bride_father_residence_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_father_residence_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bride_father_residence_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_father_residence_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bride_father_occupation_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_father_occupation_for_marriage_certificate', occupationValidationMessage);
        }
        if (marriageCertificateData.bride_father_occupation_for_marriage_certificate == VALUE_TWELVE) {
            if (!marriageCertificateData.bride_father_other_occupation_for_marriage_certificate) {
                return getBasicMessageAndFieldJSONArray('bride_father_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);
            }
        }

        if (!marriageCertificateData.bride_mother_name_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_mother_name_for_marriage_certificate', nameValidationMessage);
        }
        if (!marriageCertificateData.bride_mother_birthplace_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_mother_birthplace_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bride_mother_birthplace_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_mother_birthplace_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bride_mother_birthplace_village_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_mother_birthplace_village_for_marriage_certificate', selectVillageValidationMessage);
        }
        if (!marriageCertificateData.bride_mother_residence_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_mother_residence_for_marriage_certificate', residenceValidationMessage);
        }
        if (!marriageCertificateData.bride_mother_residence_state_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_mother_residence_state_for_marriage_certificate', selectStateValidationMessage);
        }
        if (!marriageCertificateData.bride_mother_residence_district_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_mother_residence_district_for_marriage_certificate', selectDistrictValidationMessage);
        }
        if (!marriageCertificateData.bride_mother_occupation_for_marriage_certificate) {
            return getBasicMessageAndFieldJSONArray('bride_mother_occupation_for_marriage_certificate', occupationValidationMessage);
        }
        if (marriageCertificateData.bride_mother_occupation_for_marriage_certificate == VALUE_TWELVE) {
            if (!marriageCertificateData.bride_mother_other_occupation_for_marriage_certificate) {
                return getBasicMessageAndFieldJSONArray('bride_mother_other_occupation_for_marriage_certificate', otherOccupationValidationMessage);
            }
        }
        return '';
    },
    askForSubmitMarriageCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var yesEvent = 'MarriageCertificate.listview.submitMarriageCertificate(\'' + moduleType + '\')';
        showConfirmation(yesEvent, 'Submit');
    },
    submitMarriageCertificate: function (moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var mcData = $('#marriage_certificate_form').serializeFormJSON();
        var validationDataOne = that.checkValidationForMarriageCertificate(moduleType, mcData);
        if (validationDataOne != '') {
            $('#' + validationDataOne.field).focus();
            validationMessageShow('marriage-certificate-' + validationDataOne.field, validationDataOne.message);
            return false;
        }
        if (moduleType != VALUE_ONE) {
            if ($('#bridegroom_photo_container_for_marriage_certificate').is(':visible')) {
                var bridegroomPhoto = checkValidationForDocument('bridegroom_photo_for_marriage_certificate', VALUE_TWO, 'marriage-certificate');
                if (bridegroomPhoto == false) {
                    return false;
                }
            }

            if ($('#bridegroom_birth_certi_doc_container_for_marriage_certificate').is(':visible')) {
                var bridegroomBirthCertificate = checkValidationForDocument('bridegroom_birth_certi_doc_for_marriage_certificate', VALUE_ONE, 'marriage-certificate');
                if (bridegroomBirthCertificate == false) {
                    return false;
                }
            }

            if ($('#bridegroom_aadhar_card_doc_container_for_marriage_certificate').is(':visible')) {
                var bridegroomAadharCertificate = checkValidationForDocument('bridegroom_aadhar_card_doc_for_marriage_certificate', VALUE_ONE, 'marriage-certificate');
                if (bridegroomAadharCertificate == false) {
                    return false;
                }
            }

            // if ($('#bride_photo_container_for_marriage_certificate').is(':visible')) {
            //     var bridePhoto = checkValidationForDocument('bride_photo_for_marriage_certificate', VALUE_TWO, 'marriage-certificate');
            //     if (bridePhoto == false) {
            //         return false;
            //     }
            // }

            if ($('#bride_birth_certi_doc_container_for_marriage_certificate').is(':visible')) {
                var brideBirthCertificate = checkValidationForDocument('bride_birth_certi_doc_for_marriage_certificate', VALUE_ONE, 'marriage-certificate');
                if (brideBirthCertificate == false) {
                    return false;
                }
            }

            if ($('#bride_aadhar_card_doc_container_for_marriage_certificate').is(':visible')) {
                var brideAadharCertificate = checkValidationForDocument('bride_aadhar_card_doc_for_marriage_certificate', VALUE_ONE, 'marriage-certificate');
                if (brideAadharCertificate == false) {
                    return false;
                }
            }

            if ($('#samaj_marriage_certi_doc_container_for_marriage_certificate').is(':visible')) {
                var samajMarriageCertificate = checkValidationForDocument('samaj_marriage_certi_doc_for_marriage_certificate', VALUE_ONE, 'marriage-certificate');
                if (samajMarriageCertificate == false) {
                    return false;
                }
            }
        }

        if (moduleType == VALUE_FOUR || moduleType == VALUE_FIVE) {
            var status = $('#status_for_marriage_certificate').val();
            var queryStatus = $('#query_status_for_marriage_certificate').val();
            if (status != VALUE_FIVE && status != VALUE_SIX && queryStatus == VALUE_ONE) {
                var qrRemarks = $('#remarks_for_marriage_certificate').val();
                if (!qrRemarks) {
                    $('#remarks_for_marriage_certificate').focus();
                    validationMessageShow('qrmc-remarks_for_marriage_certificate', remarksValidationMessage);
                    return false;
                }
                mcData.qr_remarks = qrRemarks;
            } else {
                showError(invalidAccessValidationMessage);
                return false;
            }
            if (moduleType == VALUE_FOUR) {
                that.askForSubmitMarriageCertificate(moduleType);
                return false;
            }
        }

        mcData.module_type = moduleType;

        mcData.bridegroom_birthplace_state_text_for_marriage_certificate = jQuery("#bridegroom_birthplace_state_for_marriage_certificate option:selected").text();
        mcData.bridegroom_birthplace_district_text_for_marriage_certificate = jQuery("#bridegroom_birthplace_district_for_marriage_certificate option:selected").text();
        mcData.bridegroom_birthplace_village_text_for_marriage_certificate = jQuery("#bridegroom_birthplace_village_for_marriage_certificate option:selected").text();
        mcData.bridegroom_residence_state_text_for_marriage_certificate = jQuery("#bridegroom_residence_state_for_marriage_certificate option:selected").text();
        mcData.bridegroom_residence_district_text_for_marriage_certificate = jQuery("#bridegroom_residence_district_for_marriage_certificate option:selected").text();

        mcData.bridegroom_father_birthplace_state_text_for_marriage_certificate = jQuery("#bridegroom_father_birthplace_state_for_marriage_certificate option:selected").text();
        mcData.bridegroom_father_birthplace_district_text_for_marriage_certificate = jQuery("#bridegroom_father_birthplace_district_for_marriage_certificate option:selected").text();
        mcData.bridegroom_father_birthplace_village_text_for_marriage_certificate = jQuery("#bridegroom_father_birthplace_village_for_marriage_certificate option:selected").text();
        mcData.bridegroom_father_residence_state_text_for_marriage_certificate = jQuery("#bridegroom_father_residence_state_for_marriage_certificate option:selected").text();
        mcData.bridegroom_father_residence_district_text_for_marriage_certificate = jQuery("#bridegroom_father_residence_district_for_marriage_certificate option:selected").text();

        mcData.bridegroom_mother_birthplace_state_text_for_marriage_certificate = jQuery("#bridegroom_mother_birthplace_state_for_marriage_certificate option:selected").text();
        mcData.bridegroom_mother_birthplace_district_text_for_marriage_certificate = jQuery("#bridegroom_mother_birthplace_district_for_marriage_certificate option:selected").text();
        mcData.bridegroom_mother_birthplace_village_text_for_marriage_certificate = jQuery("#bridegroom_mother_birthplace_village_for_marriage_certificate option:selected").text();
        mcData.bridegroom_mother_residence_state_text_for_marriage_certificate = jQuery("#bridegroom_mother_residence_state_for_marriage_certificate option:selected").text();
        mcData.bridegroom_mother_residence_district_text_for_marriage_certificate = jQuery("#bridegroom_mother_residence_district_for_marriage_certificate option:selected").text();

        mcData.bride_birthplace_state_text_for_marriage_certificate = jQuery("#bride_birthplace_state_for_marriage_certificate option:selected").text();
        mcData.bride_birthplace_district_text_for_marriage_certificate = jQuery("#bride_birthplace_district_for_marriage_certificate option:selected").text();
        mcData.bride_birthplace_village_text_for_marriage_certificate = jQuery("#bride_birthplace_village_for_marriage_certificate option:selected").text();
        mcData.bride_residence_state_text_for_marriage_certificate = jQuery("#bride_residence_state_for_marriage_certificate option:selected").text();
        mcData.bride_residence_district_text_for_marriage_certificate = jQuery("#bride_residence_district_for_marriage_certificate option:selected").text();

        mcData.bride_father_birthplace_state_text_for_marriage_certificate = jQuery("#bride_father_birthplace_state_for_marriage_certificate option:selected").text();
        mcData.bride_father_birthplace_district_text_for_marriage_certificate = jQuery("#bride_father_birthplace_district_for_marriage_certificate option:selected").text();
        mcData.bride_father_birthplace_village_text_for_marriage_certificate = jQuery("#bride_father_birthplace_village_for_marriage_certificate option:selected").text();
        mcData.bride_father_residence_state_text_for_marriage_certificate = jQuery("#bride_father_residence_state_for_marriage_certificate option:selected").text();
        mcData.bride_father_residence_district_text_for_marriage_certificate = jQuery("#bride_father_residence_district_for_marriage_certificate option:selected").text();

        mcData.bride_mother_birthplace_state_text_for_marriage_certificate = jQuery("#bride_mother_birthplace_state_for_marriage_certificate option:selected").text();
        mcData.bride_mother_birthplace_district_text_for_marriage_certificate = jQuery("#bride_mother_birthplace_district_for_marriage_certificate option:selected").text();
        mcData.bride_mother_birthplace_village_text_for_marriage_certificate = jQuery("#bride_mother_birthplace_village_for_marriage_certificate option:selected").text();
        mcData.bride_mother_residence_state_text_for_marriage_certificate = jQuery("#bride_mother_residence_state_for_marriage_certificate option:selected").text();
        mcData.bride_mother_residence_district_text_for_marriage_certificate = jQuery("#bride_mother_residence_district_for_marriage_certificate option:selected").text();

        var btnObj = moduleType == VALUE_ONE ? $('#draft_btn_for_marriage_certificate') : $('#submit_btn_for_marriage_certificate');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'marriage_certificate/submit_marriage_certificate',
            data: $.extend({}, mcData, getTokenData()),
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
                validationMessageShow('marriage-certificate', textStatus.statusText);
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
                    validationMessageShow('marriage-certificate', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                MarriageCertificate.router.navigate('marriage_certificate', {'trigger': true});
            }
        });
    },

    getEditVillageDataForMC: function (state, districtCode, moduleName, village, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'dc' ? ' ' : '';
        if (!districtCode || !state || state == VALUE_ZERO || districtCode == VALUE_ZERO) {
            return;
        }
        var bornStateId = id + '_village_for_marriage_certificate';
        addTagSpinner(bornStateId);
        $.ajax({
            url: 'marriage_certificate/get_village_data_for_marriage_certificate',
            type: 'post',
            data: {'state_code': state, 'district_code': districtCode},
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
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                removeTagSpinner();
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                if (parseData.success == false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_marriage_certificate', 'village_code', 'village_name', 'Village');
                $('#' + id + '_village_for_marriage_certificate').val(village == 0 ? '' : village);
                removeTagSpinner();
            }
        });
    },
    downloadDeclaration: function (btnObj, marriageCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        if (!marriageCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#marriage_certificate_id_for_mc_declaration').val(marriageCertificateId);
        $('#mc_declaration_pdf').submit();
        $('#marriage_certificate_id_for_mc_declaration').val('');
    },
    editDeclarationForMarriageCertificate: function (btnObj, marriageCertificateId) {
        if (!marriageCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'marriage_certificate/get_marriage_certificate_data_by_marriage_certificate_id',
            type: 'post',
            data: $.extend({}, {'marriage_certificate_id': marriageCertificateId}, getTokenData()),
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
                var marriageCertificateData = parseData.marriage_certificate_data;
                marriageCertificateData.show_declaration_submit_btn = true;
                if (marriageCertificateData.status == VALUE_FIVE || marriageCertificateData.status == VALUE_SIX) {
                    marriageCertificateData.show_declaration_submit_btn = false;
                }
                showPopup();
                $('.swal2-popup').css('width', '40em');
                $('#popup_container').html(marriageCertificateDeclarationTemplate(marriageCertificateData));
                datePicker();
                allowOnlyIntegerValue('marriage_no_for_marriage_certificate_declaration');
            }
        });
    },
    submitDeclarationForMarriageCertificate: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#declaration_marriage_certificate_form').serializeFormJSON();
        if (!formData.marriage_certificate_id_for_marriage_certificate_declaration) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.marriage_no_for_marriage_certificate_declaration) {
            $('#marriage_no_for_marriage_certificate_declaration').focus();
            validationMessageShow('marriage-certificate-declaration-marriage_no_for_marriage_certificate_declaration', marriageNoValidationMessage);
            return false;
        }
        if (!formData.residence_of_for_marriage_certificate_declaration) {
            $('#residence_of_for_marriage_certificate_declaration').focus();
            validationMessageShow('marriage-certificate-declaration-residence_of_for_marriage_certificate_declaration', residenceOfValidationMessage);
            return false;
        }
        if (!formData.declaration_date_for_marriage_certificate_declaration) {
            $('#declaration_date_for_marriage_certificate_declaration').focus();
            validationMessageShow('marriage-certificate-declaration-declaration_date_for_marriage_certificate_declaration', dateValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_marriage_certificate_declaration');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'marriage_certificate/submit_declaration',
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
                validationMessageShow('marriage-certificate-declaration', textStatus.statusText);
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
                    validationMessageShow('marriage-certificate-declaration', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                MarriageCertificate.listview.listPage();
            }
        });
    },
    addWitnessInfo: function (templateData, showRemoveBtn) {
        if (showRemoveBtn) {
            templateData.show_remove_btn = true;
        } else {
            templateData.readonly = 'readonly';
        }
        templateData.per_cnt = tempWitnessCnt;
        $('#witness_info_container_for_marriage_certificate').append(marriageCertificateWitnessItemTemplate(templateData));
        renderOptionsForTwoDimensionalArray(applicantOccupationArray, 'occupation_for_marriage_certificate_' + tempWitnessCnt);
        allowOnlyIntegerValue('age_for_marriage_certificate_' + tempWitnessCnt);
        tempWitnessCnt++;
        resetCounter('display-cnt');
        generateSelect2();
    },
    removeWitnessInfo: function (perCnt) {
        $('#marriage_certificate_witness_info_' + perCnt).remove();
        resetCounter('display-cnt');
    },
    addWitnessForMarriageCertificate: function (btnObj, marriageCertificateId) {
        if (!marriageCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        tempWitnessCnt = 1;
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'marriage_certificate/get_marriage_certificate_data_by_marriage_certificate_id',
            type: 'post',
            data: $.extend({}, {'marriage_certificate_id': marriageCertificateId}, getTokenData()),
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
                var marriageCertificateData = parseData.marriage_certificate_data;
                marriageCertificateData.show_witness_submit_btn = true;
                if (marriageCertificateData.status == VALUE_FIVE || marriageCertificateData.status == VALUE_SIX) {
                    marriageCertificateData.show_witness_submit_btn = false;
                }
                showPopup();
                $('.swal2-popup').css('width', '60em');
                $('#popup_container').html(marriageCertificateWitnessTemplate(marriageCertificateData));
                var cntwint = 1;
                if (marriageCertificateData.witness_details != '' && marriageCertificateData.witness_details != null) {
                    var witnessDetails = JSON.parse(marriageCertificateData.witness_details);
                    $.each(witnessDetails, function (key, value) {
                        that.addWitnessInfo(value, true);
                        $('#occupation_for_marriage_certificate_' + cntwint).val(value.witness_occupation);
                        cntwint++;
                    });
                } else {
                    that.addWitnessInfo({}, true);
                }
                generateSelect2();
            }
        });
    },
    submitWitnessForMarriageCertificate: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#witness_marriage_certificate_form').serializeFormJSON();
        if (!formData.marriage_certificate_id_for_marriage_certificate_witness) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var mcWitnessItem = [];
        var ismcWitnessValidation = false;
        var rc = 1;
        $('.marriage_certificate_witness_info').each(function () {
            rc++;
            var cnt = $(this).find('.temp_cnt').val();
            var mcWitnessInfo = {};
            var witnessName = $('#witness_name_for_marriage_certificate_' + cnt).val();
            if (witnessName == '' || witnessName == null) {
                $('#witness_name_for_marriage_certificate_' + cnt).focus();
                validationMessageShow('marriage-certificate-witness_name_for_marriage_certificate_' + cnt, witnessNameValidationMessage);
                ismcWitnessValidation = true;
                return false;
            }
            mcWitnessInfo.witness_name = witnessName;
            var witnessAge = $('#age_for_marriage_certificate_' + cnt).val();
            if (witnessAge == '' || witnessAge == null) {
                $('#age_for_marriage_certificate_' + cnt).focus();
                validationMessageShow('marriage-certificate-age_for_marriage_certificate_' + cnt, ageValidationMessage);
                ismcWitnessValidation = true;
                return false;
            }
            mcWitnessInfo.witness_age = witnessAge;
            var witnessOccupation = $('#occupation_for_marriage_certificate_' + cnt).val();
            if (witnessOccupation == '' || witnessOccupation == null) {
                $('#occupation_for_marriage_certificate_' + cnt).focus();
                validationMessageShow('marriage-certificate-occupation_for_marriage_certificate_' + cnt, oneOptionValidationMessage);
                ismcWitnessValidation = true;
                return false;
            }
            mcWitnessInfo.witness_occupation = witnessOccupation;
            var witnessAddress = $('#witness_address_for_marriage_certificate_' + cnt).val();
            if (witnessAddress == '' || witnessAddress == null) {
                $('#witness_address_for_marriage_certificate_' + cnt).focus();
                validationMessageShow('marriage-certificate-witness_address_for_marriage_certificate_' + cnt, oneOptionValidationMessage);
                ismcWitnessValidation = true;
                return false;
            }
            mcWitnessInfo.witness_address = witnessAddress;
            mcWitnessItem.push(mcWitnessInfo);
        });
        if (ismcWitnessValidation) {
            return false;
        }
        formData.witness_info = mcWitnessItem;
        formData.rc = rc;
        var btnObj = $('#submit_btn_for_marriage_certificate_declaration');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'marriage_certificate/submit_witness',
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
                validationMessageShow('marriage-certificate-witness', textStatus.statusText);
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
                    validationMessageShow('marriage-certificate-witness', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                MarriageCertificate.listview.listPage();
            }
        });
    },
    askForApproveApplication: function (marriageCertificateId) {
        if (!marriageCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#approve_btn_for_app_' + marriageCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'marriage_certificate/get_marriage_certificate_data_by_marriage_certificate_id',
            type: 'post',
            data: $.extend({}, {'marriage_certificate_id': marriageCertificateId}, getTokenData()),
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
                var marriageCertificateData = parseData.marriage_certificate_data;
                showPopup();
                $('.swal2-popup').css('width', '40em');
                $('#popup_container').html(marriageCertificateApproveTemplate(marriageCertificateData));
                allowOnlyIntegerValue('page_no_for_marriage_certificate_approve');
                allowOnlyIntegerValue('entry_number_for_marriage_certificate_approve');
                allowOnlyIntegerValue('registration_year_for_marriage_certificate_approve');
                datePicker();
            }
        });
    },
    approveApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#approve_marriage_certificate_form').serializeFormJSON();
        if (!formData.marriage_certificate_id_for_marriage_certificate_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.page_no_for_marriage_certificate_approve) {
            $('#page_no_for_marriage_certificate_approve').focus();
            validationMessageShow('marriage-certificate-approve-page_no_for_marriage_certificate_approve', pageNoValidationMessage);
            return false;
        }
        if (!formData.entry_number_for_marriage_certificate_approve) {
            $('#entry_number_for_marriage_certificate_approve').focus();
            validationMessageShow('marriage-certificate-approve-entry_number_for_marriage_certificate_approve', entryNumberValidationMessage);
            return false;
        }
        if (!formData.registration_year_for_marriage_certificate_approve) {
            $('#registration_year_for_marriage_certificate_approve').focus();
            validationMessageShow('marriage-certificate-approve-registration_year_for_marriage_certificate_approve', registrationYearValidationMessage);
            return false;
        }
        if (!formData.remarks_for_marriage_certificate_approve) {
            $('#remarks_for_marriage_certificate_approve').focus();
            validationMessageShow('marriage-certificate-approve-remarks_for_marriage_certificate_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_marriage_certificate_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'marriage_certificate/approve_application',
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
                validationMessageShow('marriage-certificate-approve', textStatus.statusText);
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
                    validationMessageShow('marriage-certificate-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                MarriageCertificate.listview.listPage();
            }
        });
    },
    askForRejectApplication: function (marriageCertificateId) {
        if (!marriageCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#reject_btn_for_app_' + marriageCertificateId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'marriage_certificate/get_marriage_certificate_data_by_marriage_certificate_id',
            type: 'post',
            data: $.extend({}, {'marriage_certificate_id': marriageCertificateId}, getTokenData()),
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
                var marriageCertificateData = parseData.marriage_certificate_data;
                showPopup();
                $('#popup_container').html(marriageCertificateRejectTemplate(marriageCertificateData));
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_marriage_certificate_form').serializeFormJSON();
        if (!formData.marriage_certificate_id_for_marriage_certificate_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_marriage_certificate_reject) {
            $('#remarks_for_marriage_certificate_reject').focus();
            validationMessageShow('marriage-certificate-reject-remarks_for_marriage_certificate_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_marriage_certificate_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'marriage_certificate/reject_application',
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
                validationMessageShow('marriage-certificate-reject', textStatus.statusText);
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
                    validationMessageShow('marriage-certificate-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                MarriageCertificate.listview.listPage();
            }
        });
    },
    downloadCertificate: function (marriageCertificateId, moduleType) {
        if (!marriageCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        $('#marriage_certificate_id_for_certificate').val(marriageCertificateId);
        $('#mtype_for_certificate').val(moduleType);
        $('#marriage_certificate_pdf_form').submit();
        $('#marriage_certificate_id_for_certificate').val('');
        $('#mtype_for_certificate').val('');
    },
    getQueryData: function (marriageCertificateId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!marriageCertificateId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var templateData = {};
        templateData.module_type = VALUE_EIGHTEEN;
        templateData.module_id = marriageCertificateId;
        var btnObj = $('#query_btn_for_app_' + marriageCertificateId);
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
                tmpData.module_type = VALUE_EIGHTEEN;
                tmpData.module_id = marriageCertificateId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    districtChangeEvent: function (obj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        renderOptionsForTwoDimensionalArray([], 'village_dmc_ward_for_marriage_certificate');
        var district = obj.val();
        if (!district) {
            return false;
        }
        if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
            return false;
        }
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'village_dmc_ward_for_marriage_certificate');
    },
    getDistrictData: function (obj, moduleName, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        //openFullPageOverlay();
        var text = moduleName == 'marriage_certificate' ? '' : '';
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_district_for_' + moduleName, 'district_code', 'district_name', text + 'District');
        $('#district_for_' + moduleName).val('');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode([], id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
        $(id + '#_village_for_' + moduleName).val('');
        var stateCode = obj.val();
        if (!stateCode) {
            return;
        }
        var districtData = tempDistrictData[stateCode] ? tempDistrictData[stateCode] : [];
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(districtData, id + '_district_for_' + moduleName, 'district_code', 'district_name', text + 'District');
        $('id + #_district_for_' + moduleName).val('');
        //closeFullPageOverlay();
    },
    getVillageData: function (obj, moduleName, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'marriage_certificate' ? ' ' : '';
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
        $('#' + id + '_village_for_' + moduleName).val('');
        var state = $('#' + id + '_state_for_' + moduleName).val();
        var districtCode = obj.val();
        if (!districtCode || !state) {
            return;
        }
        openFullPageOverlay();
        $.ajax({
            url: 'marriage_certificate/get_village_data_for_marriage_certificate',
            type: 'post',
            data: {'state_code': state, 'district_code': districtCode},
            error: function (textStatus, errorThrown) {
                closeFullPageOverlay();
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
                if (parseData.success == false) {
                    closeFullPageOverlay();
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_' + moduleName, 'village_code', 'village_name', text + 'Village');
                $('#' + id + '_village_for_' + moduleName).val('');
                closeFullPageOverlay();
            }
        });
    },
    getEditVillageDataForMC: function (state, districtCode, moduleName, village, id) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var text = moduleName == 'dc' ? ' ' : '';
        if (!districtCode || !state || state == VALUE_ZERO || districtCode == VALUE_ZERO) {
            return;
        }
        openFullPageOverlay();
        $.ajax({
            url: 'marriage_certificate/get_village_data_for_marriage_certificate',
            type: 'post',
            data: {'state_code': state, 'district_code': districtCode},
            error: function (textStatus, errorThrown) {
                closeFullPageOverlay();
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
                closeFullPageOverlay();
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                if (parseData.success == false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(parseData.village_data, id + '_village_for_marriage_certificate', 'village_code', 'village_name', 'Village');
                $('#' + id + '_village_for_marriage_certificate').val(village == 0 ? '' : village);
                closeFullPageOverlay();
            }
        });
    },
    downloadExcelForMC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#app_no_for_mcge').val($('#app_no_for_marriage_certificate_list').val());
        $('#app_details_for_mcge').val($('#app_details_for_marriage_certificate_list').val());
        $('#status_for_mcge').val($('#status_for_marriage_certificate_list').val());
        $('#qstatus_for_mcge').val($('#query_status_for_marriage_certificate_list').val());
        $('#generate_excel_for_marriage_certificate').submit();
        $('.mcge').val('');
    },
});
