var formOneFourteenListTemplate = Handlebars.compile($('#form_one_fourteen_list_template').html());
var formOneFourteenSearchTemplate = Handlebars.compile($('#form_one_fourteen_search_template').html());
var formOneFourteenTableTemplate = Handlebars.compile($('#form_one_fourteen_table_template').html());
var formOneFourteenActionTemplate = Handlebars.compile($('#form_one_fourteen_action_template').html());
var formOneFourteenViewTemplate = Handlebars.compile($('#form_one_fourteen_view_template').html());
var formOneFourteenSetAppointmentTemplate = Handlebars.compile($('#form_one_fourteen_set_appointment_template').html());
var formOneFourteenApproveTemplate = Handlebars.compile($('#form_one_fourteen_approve_template').html());
var formOneFourteenRejectTemplate = Handlebars.compile($('#form_one_fourteen_reject_template').html());
var formOneFourteenCopyDetailsTemplate = Handlebars.compile($('#form_one_fourteen_copy_details_template').html());
var formOneFourteenCopyDetailsItemTemplate = Handlebars.compile($('#form_one_fourteen_copy_details_item_template').html());
var fofocListTemplate = Handlebars.compile($('#fofoc_list_template').html());
var fofocFormTemplate = Handlebars.compile($('#fofoc_form_template').html());

var searchFOFF = {};

var FormOneFourteen = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
FormOneFourteen.Router = Backbone.Router.extend({
    routes: {
        'form_one_fourteen': 'renderList',
        'view_form_one_fourteen_form': 'renderList',
        'form_one_fourteen_office_copy': 'renderListForOC',
    },
    renderList: function () {
        FormOneFourteen.listview.listPage();
    },
    renderListForOC: function () {
        FormOneFourteen.listview.listPageOC();
    },
});
FormOneFourteen.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER && tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('mam_form_1_14', 'active');
        FormOneFourteen.router.navigate('form_one_fourteen');
        var templateData = {};
        searchFOFF = {};
        this.$el.html(formOneFourteenListTemplate(templateData));
        this.loadFormOneFourteenData(sDistrict, sType);
    },
    actionRenderer: function (rowData) {
        if (tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
            if (rowData.status != VALUE_FIVE && rowData.status != VALUE_SIX &&
                    (rowData.query_status == VALUE_ZERO || rowData.query_status == VALUE_THREE)) {
                rowData.show_reject_btn = '';
            } else {
                rowData.show_reject_btn = 'display: none;';
            }
            if ((rowData.status == VALUE_FOUR) && (rowData.query_status == VALUE_ZERO ||
                    rowData.query_status == VALUE_THREE)) {
                rowData.show_approve_btn = '';
            } else {
                rowData.show_approve_btn = 'display: none;';
            }
            if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
                rowData.show_pa_btn = true;
            }
        }
        rowData.VALUE_ONE = VALUE_ONE;
        rowData.VALUE_TWO = VALUE_TWO;
        rowData.module_type = VALUE_THIRTEEN;
        return formOneFourteenActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        if (appointmentData.appointment_date == '0000-00-00') {
            return '';
        }
        var returnString = '<span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">'
                + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">Visit Office</span>';
        return returnString;
    },
    loadFormOneFourteenData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;

        FormOneFourteen.router.navigate('form_one_fourteen');
        var searchData = dtomFeesStatus(sDistrict, sType, 'FormOneFourteen.listview.loadFormOneFourteenData();');
        $('#form_one_fourteen_form_and_datatable_container').html(formOneFourteenSearchTemplate(searchData));

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        //distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_form_one_fourteen_list', false);

        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_form_one_fourteen_list', false);
        renderOptionsForTwoDimensionalArray(fAppStatusTextArray, 'status_for_form_one_fourteen_list', false);
        datePickerId('application_date_for_form_one_fourteen_list');

        if (tempTypeInSession != TEMP_TYPE_A) {
            var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'vdw_for_form_one_fourteen_list', 'village', 'village_name', false, false);
        } else {
            if (typeof searchFOFF.district_for_form_one_fourteen_list != "undefined" && searchFOFF.district_for_form_one_fourteen_list != '' && searchFOFF.village_for_form_one_fourteen_list != '')
            {
                var villageData = (searchFOFF.district_for_form_one_fourteen_list == VALUE_ONE ? tempVillageData : (searchFOFF.district_for_form_one_fourteen_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_form_one_fourteen_list', 'village', 'village_name', false, false);
            }
        }

        $('#app_no_for_form_one_fourteen_list').val((typeof searchFOFF.app_no_for_form_one_fourteen_list != "undefined" && searchFOFF.app_no_for_form_one_fourteen_list != '') ? searchFOFF.app_no_for_form_one_fourteen_list : '');
        $('#application_date_for_form_one_fourteen_list').val((typeof searchFOFF.application_date_for_form_one_fourteen_list != "undefined" && searchFOFF.application_date_for_form_one_fourteen_list != '') ? searchFOFF.application_date_for_form_one_fourteen_list : searchData.s_appd);
        $('#app_details_for_form_one_fourteen_list').val((typeof searchFOFF.app_details_for_form_one_fourteen_list != "undefined" && searchFOFF.app_details_for_form_one_fourteen_list != '') ? searchFOFF.app_details_for_form_one_fourteen_list : '');
        $('#query_status_for_form_one_fourteen_list').val((typeof searchFOFF.query_status_for_form_one_fourteen_list != "undefined" && searchFOFF.query_status_for_form_one_fourteen_list != '') ? searchFOFF.query_status_for_form_one_fourteen_list : searchData.s_qstatus);
        $('#status_for_form_one_fourteen_list').val((typeof searchFOFF.status_for_form_one_fourteen_list != "undefined" && searchFOFF.status_for_form_one_fourteen_list != '') ? searchFOFF.status_for_form_one_fourteen_list : searchData.s_status);
        $('#district_for_form_one_fourteen_list').val((typeof searchFOFF.district_for_form_one_fourteen_list != "undefined" && searchFOFF.district_for_form_one_fourteen_list != '') ? searchFOFF.district_for_form_one_fourteen_list : searchData.search_district);
        $('#vdw_for_form_one_fourteen_list').val((typeof searchFOFF.vdw_for_form_one_fourteen_list != "undefined" && searchFOFF.vdw_for_form_one_fourteen_list != '') ? searchFOFF.vdw_for_form_one_fourteen_list : '');
        $('#is_full_for_form_one_fourteen_list').val((typeof searchFOFF.is_full_for_form_one_fourteen_list != "undefined" && searchFOFF.is_full_for_form_one_fourteen_list != '') ? searchFOFF.is_full_for_form_one_fourteen_list : searchData.s_is_full);

        this.searchFormOneFourteenData();

    },
    searchFormOneFourteenData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#form_one_fourteen_datatable_container').html(formOneFourteenTableTemplate);
        var searchData = $('#search_form_one_fourteen_form').serializeFormJSON();

        searchFOFF = searchData;
        if (typeof btnObj == "undefined" && (searchFOFF.app_details_for_form_one_fourteen_list == ''
                && searchFOFF.app_no_for_form_one_fourteen_list == ''
                && searchFOFF.application_date_for_form_one_fourteen_list == ''
                && searchFOFF.query_status_for_form_one_fourteen_list == ''
                && searchFOFF.status_for_form_one_fourteen_list == ''
                && searchFOFF.district_for_form_one_fourteen_list == ''
                && searchFOFF.vdw_for_form_one_fourteen_list == ''
                && searchFOFF.is_full_for_form_one_fourteen_list == '')) {
            formOneFourteenDataTable = $('#form_one_fourteen_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#form_one_fourteen_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + ' ' + full.father_name + ' ' + full.surname
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
        var basicDetailsRenderer = function (data, type, full, meta) {
            return that.getSSCADetails(full);
        };
        $('#form_one_fourteen_datatable_container').html(formOneFourteenTableTemplate);
        formOneFourteenDataTable = $('#form_one_fourteen_datatable').DataTable({
            ajax: {url: 'form_one_fourteen/get_form_one_fourteen_data', dataSrc: "form_one_fourteen_data", type: "post", data: searchData},
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
                {data: '', 'class': 'text-center', 'render': basicDetailsRenderer},
//                {data: 'form_one_fourteen_id', 'class': 'text-center', 'render': appointmentRenderer},
                {data: 'form_one_fourteen_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'form_one_fourteen_id', 'class': 'text-center', 'render': formsAppStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#form_one_fourteen_datatable_filter').remove();
        $('#form_one_fourteen_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = formOneFourteenDataTable.row(tr);

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
    getSSCADetails: function (full) {
        var tempData = '<table class="table table-bordered mb-0 bg-beige f-s-12px" id="ssca_details_container_for_foflist_' + full.form_one_fourteen_id + '">';
        var landDetails = full.land_details != '' ? JSON.parse(full.land_details) : [];
        if (landDetails.length == VALUE_ZERO) {
            return '';
        }
        $.each(landDetails, function (index, ld) {
            var pendingLandTaxAmount = '';
            if (ld.pending_landtax) {
                pendingLandTaxAmount = '<span class="badge bg-danger app-status mw-10px f-s-10px" style="text-align:right">Pay ' + ld.pending_landtax + '/-</span>';
            }
            tempData += '<tr><td class="text-center">' + ld.survey + '</td><td class="text-center">' + ld.subdiv + '</td>'
                    + '<td class="text-right">' + ld.copies + '</td><td class="text-right">' + ld.amount + '</td>'
                    + '<td class="text-right" title="Click Here to Pay Your Land Tax" style="cursor:pointer;" onclick="LandTaxNA.listview.listPage(' + full.village + ',\'' + ld.survey + '\',\'' + ld.subdiv + '\');">' + pendingLandTaxAmount + '</td>'
                    + (typeof ld.total_copy_generated == "undefined" ? '' : (ld.total_copy_generated == ld.copies ? '<td class="text-center"><button class="btn btn-xs btn-info" title="View Copy Details" '
                            + 'onclick="FormOneFourteen.listview.requestForViewCopy($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-eye"></i></button></td>' :
                            ((full.status == VALUE_FOUR && tempTypeInSession == TEMP_TYPE_TALATHI_USER) ? ('<td class="text-center"><button class="btn btn-xs btn-nic-blue" title="Generate Copy" '
                                    + 'onclick="FormOneFourteen.listview.requestForGenerateCopy($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-recycle"></i></button></td>') : '')))
                    + '</tr>';
        });
        tempData += '<tr><td class="text-right text-success f-w-b" colspan="2">Rupees To Be Paid : </td><td class="text-right f-w-b">Copies : ' +
                full.total_copies + '</td><td class="text-right f-w-b">Rs. : ' + full.total_amount + '</td><td></td></tr></table>';
        return tempData;
    },
    editOrViewFormOneFourteen: function (btnObj, formOneFourteenId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formOneFourteenId) {
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
            url: 'form_one_fourteen/get_form_one_fourteen_data_by_id', type: 'post',
            data: $.extend({}, {'form_one_fourteen_id': formOneFourteenId, 'is_edit': (isEdit ? VALUE_ONE : VALUE_TWO)}, getTokenData()),
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
                    that.viewFormOneFourteen(VALUE_ONE, parseData, isPrint);
                }
            }
        });
    },
    viewFormOneFourteen: function (moduleType, parseData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var formOneFourteenData = parseData.form_one_fourteen_data;
        FormOneFourteen.router.navigate('view_form_one_fourteen_form');
        formOneFourteenData.title = 'View';
        formOneFourteenData.VALUE_THREE = VALUE_THREE;
        formOneFourteenData.district_text = talukaArray[formOneFourteenData.district] ? talukaArray[formOneFourteenData.district] : '';
        var district = formOneFourteenData.district;
        var villageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        formOneFourteenData.village_text = villageData[formOneFourteenData.village] ? villageData[formOneFourteenData.village]['village_name'] : '';
        formOneFourteenData.show_applicant_photo = formOneFourteenData.applicant_photo != '' ? true : false;
        formOneFourteenData.show_id_proof = formOneFourteenData.id_proof != '' ? true : false;
        formOneFourteenData.show_other_document = formOneFourteenData.other_document != '' ? true : false;
        if (formOneFourteenData.status != VALUE_ZERO && formOneFourteenData.status != VALUE_ONE) {
            formOneFourteenData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        formOneFourteenData.FORM_ONE_FOURTEEN_DOC_PATH = FORM_ONE_FOURTEEN_DOC_PATH;
        $('#popup_container').html(formOneFourteenViewTemplate(formOneFourteenData));

        var ldCnt = 1;
        var totalCopies = 0;
        var totalAmount = 0;
        $.each(parseData.form_land_details, function (index, fld) {
            var pendingLandTaxAmount = '';
            if (fld.pending_landtax) {
                pendingLandTaxAmount = '<span class="badge bg-danger app-status mw-80px f-s-16px" style="text-align:right">Pay ' + fld.pending_landtax + '/-</span>';
            }
            var ldRow = '<tr><td class="text-center">' + ldCnt + '</td><td class="text-center">' + fld.survey + '</td>' + '<td class="text-center">' + fld.subdiv + '</td><td>' + fld.occupant_details + '</td>' +
                    '<td class="text-center">' + fld.total_area + '</td><td class="text-center" title="Click Here to Pay Your Land Tax" style="cursor:pointer;" onclick="Swal.close(); LandTaxNA.listview.listPage(' + formOneFourteenData.village + ',\'' + fld.survey + '\',\'' + fld.subdiv + '\');">' + pendingLandTaxAmount + '</td><td class="text-right">' + fld.copies + '</td><td class="text-right">' + fld.amount + '</td></tr>';
            $('#fld_container_for_fofview').append(ldRow);
            totalCopies += parseInt(fld.copies) ? parseInt(fld.copies) : VALUE_ZERO;
            totalAmount += parseInt(fld.amount) ? parseInt(fld.amount) : VALUE_ZERO;
            ldCnt++;
        });
        $('#total_copies_for_fofview').html(totalCopies);
        $('#total_amount_for_fofview').html(totalAmount);
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_fofview').click();
            }, 500);
        }
    },
    setAppointment: function (formOneFourteenId) {
        if (!formOneFourteenId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + formOneFourteenId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'form_one_fourteen/get_data_by_form_one_fourteen_id',
            type: 'post',
            data: $.extend({}, {'form_one_fourteen_id': formOneFourteenId}, getTokenData()),
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
                var fofData = parseData.form_one_fourteen_data;
                showPopup();
                if (fofData == null) {
                    var fofData = {};
                }
                if (fofData.status != VALUE_FIVE && fofData.status != VALUE_SIX) {
                    fofData.show_submit_btn = true;
                }
                $('#popup_container').html(formOneFourteenSetAppointmentTemplate(fofData));
                datePickerAppointment();
                var appointmentDate = fofData.appointment_date != '0000-00-00' ? dateTo_DD_MM_YYYY(fofData.appointment_date) : '';
                $('#appointment_date_for_form_one_fourteen').val(appointmentDate);
                $('#appointment_time_for_form_one_fourteen').val(fofData.appointment_time);
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
        var formData = $('#set_appointment_form_one_fourteen_form').serializeFormJSON();
        if (!formData.form_one_fourteen_id_for_form_one_fourteen_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_form_one_fourteen) {
            $('#appointment_date_for_form_one_fourteen').focus();
            validationMessageShow('form-one-fourteen-appointment_date_for_form_one_fourteen', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_form_one_fourteen) {
            $('#appointment_time_for_form_one_fourteen').focus();
            validationMessageShow('form-one-fourteen-appointment_time_for_form_one_fourteen', timeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_one_fourteen_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_one_fourteen/submit_set_appointment',
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
                validationMessageShow('form-one-fourteen-set-appointment', textStatus.statusText);
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
                    validationMessageShow('form-one-fourteen-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var incomeCertificateData = parseData.form_one_fourteen_data;
                $('#appointment_container_' + incomeCertificateData.form_one_fourteen_id).html(that.getAppointmentData(incomeCertificateData));
                $('#appointment_by_name_' + incomeCertificateData.form_one_fourteen_id).html('<hr>' + parseData.appointment_by_name);
            }
        });
    },
    askForApproveRejectApplication: function (btnObj, formOneFourteenId, moduleType) {
        if (!formOneFourteenId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'form_one_fourteen/get_data_by_form_one_fourteen_id',
            type: 'post',
            data: $.extend({}, {'form_one_fourteen_id': formOneFourteenId, 'module_type': moduleType}, getTokenData()),
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
                var formOneFourteenData = parseData.form_one_fourteen_data;
                showPopup();
                if (moduleType == VALUE_ONE) {
                    $('#popup_container').html(formOneFourteenApproveTemplate(formOneFourteenData));
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(formOneFourteenRejectTemplate(formOneFourteenData));
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
        var formData = $('#approve_form_one_fourteen_form').serializeFormJSON();
        if (!formData.form_one_fourteen_id_for_form_one_fourteen_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_form_one_fourteen_approve) {
            $('#remarks_for_form_one_fourteen_approve').focus();
            validationMessageShow('form-one-fourteen-approve-remarks_for_form_one_fourteen_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_one_fourteen_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_one_fourteen/approve_application',
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
                validationMessageShow('form-one-fourteen-approve', textStatus.statusText);
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
                    validationMessageShow('form-one-fourteen-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FormOneFourteen.listview.loadFormOneFourteenData();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_form_one_fourteen_form').serializeFormJSON();
        if (!formData.form_one_fourteen_id_for_form_one_fourteen_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_form_one_fourteen_reject) {
            $('#remarks_for_form_one_fourteen_reject').focus();
            validationMessageShow('form-one-fourteen-reject-remarks_for_form_one_fourteen_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_one_fourteen_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_one_fourteen/reject_application',
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
                validationMessageShow('form-one-fourteen-reject', textStatus.statusText);
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
                    validationMessageShow('form-one-fourteen-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FormOneFourteen.listview.loadFormOneFourteenData();
            }
        });
    },
    requestForGenerateCopy: function (btnObj, formLandDetailsId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'form_one_fourteen/request_for_generate_copy',
            type: 'post',
            data: $.extend({}, {'form_land_details_id': formLandDetailsId}, getTokenData()),
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
                closeFullPageOverlay();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                showError(textStatus.statusText);
            },
            success: function (response) {
                closeFullPageOverlay();
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
                var fofData = parseData.form_one_fourteen_data;
                $('#ssca_details_container_for_foflist_' + fofData.form_one_fourteen_id).parent().html(that.getSSCADetails(fofData));
                showSuccess(parseData.message);
            }
        });
    },
    requestForViewCopy: function (btnObj, formLandDetailsId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'form_one_fourteen/request_for_view_copy',
            type: 'post',
            data: $.extend({}, {'form_land_details_id': formLandDetailsId}, getTokenData()),
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
                that.viewCopyDetails(parseData);
            }
        });
    },
    viewCopyDetails: function (parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        var fofldData = parseData.fofld_data;
        var district = fofldData.district;
        fofldData.district_text = talukaArray[district] ? talukaArray[district] : '';
        var villageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        fofldData.village_text = villageData[fofldData.village] ? villageData[fofldData.village]['village_name'] : '';
        $('#popup_container').html(formOneFourteenCopyDetailsTemplate(fofldData));
        $.each(parseData.copy_details, function (index, cd) {
            cd.temp_cnt = (index + 1);
            cd.barcode_number = VALUE_THIRTEEN + ('0000000' + cd.form_copy_id).slice(-7);
            cd.generated_datetime_text = cd.created_time != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(cd.created_time) : '';
            $('#cd_container_for_fofcd').append(formOneFourteenCopyDetailsItemTemplate(cd));
        });
    },
    getQueryData: function (formOneFourteenId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formOneFourteenId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var templateData = {};
        templateData.module_type = VALUE_THIRTEEN;
        templateData.module_id = formOneFourteenId;
        var btnObj = $('#query_btn_for_app_' + formOneFourteenId);
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
                tmpData.applicant_name = moduleData.applicant_name + ' ' + moduleData.father_name + ' ' + moduleData.surname;
                tmpData.title = 'Full Name of Applicant';
                tmpData.module_type = VALUE_THIRTEEN;
                tmpData.module_id = formOneFourteenId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
    listPageOC: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('mam_form_1_14_oc', 'active');
        FormOneFourteen.router.navigate('form_one_fourteen_office_copy');
        var templateData = {};
        this.$el.html(fofocListTemplate(templateData));
        this.loadOCForm();
    },
    loadOCForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        $('#fofoc_form_datatable_container').html(fofocFormTemplate);
        var dArray = {};
        if (tempTypeInSession == TEMP_TYPE_A || tempDistrictInSession == TALUKA_DAMAN) {
            dArray[TALUKA_DAMAN] = talukaArray[TALUKA_DAMAN];
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempDistrictInSession == TALUKA_DIU) {
            dArray[TALUKA_DIU] = talukaArray[TALUKA_DIU];
        }
        renderOptionsForTwoDimensionalArray(dArray, 'district_for_fofoc', false);
        if (tempTypeInSession == TEMP_TYPE_A) {
            $('#district_for_fofoc').val(TALUKA_DAMAN).trigger('change');
        } else {
            if (tempDistrictInSession == TALUKA_DAMAN || tempDistrictInSession == TALUKA_DIU) {
                $('#district_for_fofoc').val(tempDistrictInSession).trigger('change');
            }
        }
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForLand([], 'survey_number_for_fofoc', '', '', '');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'subdivision_number_for_fofoc', '', '', '');
        generateSelect2();
    },
    viewOfficeCopy: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER &&
                tempTypeInSession != TEMP_TYPE_ACI_USER &&
                tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        $('.fofocp').val('');
        validationMessageHide();
        var formData = $('#fofoc_form').serializeFormJSON();
        if (!formData.district_for_fofoc) {
            $('#district_for_fofoc').focus();
            validationMessageShow('fofoc-district_for_fofoc', selectDistrictValidationMessage);
            return false;
        }
        if (!formData.village_for_fofoc) {
            $('#village_for_fofoc').focus();
            validationMessageShow('fofoc-village_for_fofoc', selectVillageValidationMessage);
            return false;
        }
        if (!formData.survey_number_for_fofoc) {
            $('#survey_number_for_fofoc').focus();
            validationMessageShow('fofoc-survey_number_for_fofoc', selectSurveyValidationMessage);
            return false;
        }
        if (!formData.subdivision_number_for_fofoc) {
            $('#subdivision_number_for_fofoc').focus();
            validationMessageShow('fofoc-subdivision_number_for_fofoc', selectSubdivValidationMessage);
            return false;
        }
        console.log(formData);
        $('#district_for_fofocp').val(formData.district_for_fofoc);
        $('#village_for_fofocp').val(formData.village_for_fofoc);
        $('#survey_number_for_fofocp').val(formData.survey_number_for_fofoc);
        $('#subdivision_number_for_fofocp').val(formData.subdivision_number_for_fofoc);
        $('#download_fofocp_form').submit();
        $('.fofocp').val('');
    }
});
