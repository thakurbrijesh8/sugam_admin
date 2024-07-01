var formNineListTemplate = Handlebars.compile($('#form_nine_list_template').html());
var formNineSearchTemplate = Handlebars.compile($('#form_nine_search_template').html());
var formNineTableTemplate = Handlebars.compile($('#form_nine_table_template').html());
var formNineActionTemplate = Handlebars.compile($('#form_nine_action_template').html());
var formNineViewTemplate = Handlebars.compile($('#form_nine_view_template').html());
var formNineSetAppointmentTemplate = Handlebars.compile($('#form_nine_set_appointment_template').html());
var formNineApproveTemplate = Handlebars.compile($('#form_nine_approve_template').html());
var formNineRejectTemplate = Handlebars.compile($('#form_nine_reject_template').html());

var searchFNF = {};

var FormNine = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
FormNine.Router = Backbone.Router.extend({
    routes: {
        'form_nine': 'renderList',
        'view_form_nine_form': 'renderList',
    },
    renderList: function () {
        FormNine.listview.listPage();
    },
});
FormNine.listView = Backbone.View.extend({
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
        addClass('mam_form_9', 'active');
        FormNine.router.navigate('form_nine');
        var templateData = {};
        searchFNF = {};
        this.$el.html(formNineListTemplate(templateData));
        this.loadFormNineData(sDistrict, sType);

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
            if (rowData.status == VALUE_TWO) {
                rowData.show_upd_btn = true;
            }
        }
        rowData.VALUE_ONE = VALUE_ONE;
        rowData.VALUE_TWO = VALUE_TWO;
        rowData.module_type = VALUE_SIXTEEN;
        rowData.ld_module_type = VALUE_THREE;
        return formNineActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        if (appointmentData.appointment_date == '0000-00-00') {
            return '';
        }
        var returnString = '<span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">'
                + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">Visit Office</span>';
        return returnString;
    },
    loadFormNineData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        
        FormNine.router.navigate('form_nine');
        var searchData = dtomFeesStatus(sDistrict, sType, 'FormNine.listview.loadFormNineData();');
        $('#form_nine_form_and_datatable_container').html(formNineSearchTemplate(searchData));
        
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        //distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_form_nine_list', false);
        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_form_nine_list', false);
        renderOptionsForTwoDimensionalArray(fAppStatusTextArray, 'status_for_form_nine_list', false);
        datePickerId('application_date_for_form_nine_list');
        
        if (tempTypeInSession != TEMP_TYPE_A) {
            var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'vdw_for_form_nine_list', 'village', 'village_name', false, false);
        } else {
            if (typeof searchFNF.district_for_form_nine_list != "undefined" && searchFNF.district_for_form_nine_list != '' && searchFNF.village_for_form_nine_list != '')
            {
                var villageData = (searchFNF.district_for_form_nine_list == VALUE_ONE ? tempVillageData : (searchFNF.district_for_form_nine_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_form_nine_list', 'village', 'village_name', false, false);
            }
        }
        
        $('#app_no_for_form_nine_list').val((typeof searchFNF.app_no_for_form_nine_list != "undefined" && searchFNF.app_no_for_form_nine_list != '') ? searchFNF.app_no_for_form_nine_list : '');
        $('#application_date_for_form_nine_list').val((typeof searchFNF.application_date_for_form_nine_list != "undefined" && searchFNF.application_date_for_form_nine_list != '') ? searchFNF.application_date_for_form_nine_list : searchData.s_appd);
        $('#app_details_for_form_nine_list').val((typeof searchFNF.app_details_for_form_nine_list != "undefined" && searchFNF.app_details_for_form_nine_list != '') ? searchFNF.app_details_for_form_nine_list : '');
        $('#query_status_for_form_nine_list').val((typeof searchFNF.query_status_for_form_nine_list != "undefined" && searchFNF.query_status_for_form_nine_list != '') ? searchFNF.query_status_for_form_nine_list : searchData.s_qstatus);
        $('#status_for_form_nine_list').val((typeof searchFNF.status_for_form_nine_list != "undefined" && searchFNF.status_for_form_nine_list != '') ? searchFNF.status_for_form_nine_list : searchData.s_status);
        $('#district_for_form_nine_list').val((typeof searchFNF.district_for_form_nine_list != "undefined" && searchFNF.district_for_form_nine_list != '') ? searchFNF.district_for_form_nine_list : searchData.search_district);
        $('#vdw_for_form_nine_list').val((typeof searchFNF.vdw_for_form_nine_list != "undefined" && searchFNF.vdw_for_form_nine_list != '') ? searchFNF.vdw_for_form_nine_list : '');
        $('#is_full_for_form_nine_list').val((typeof searchFNF.is_full_for_form_nine_list != "undefined" && searchFNF.is_full_for_form_nine_list != '') ? searchFNF.is_full_for_form_nine_list : searchData.s_is_full);
        
        this.searchFormNineData();
        
    },
    searchFormNineData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#form_nine_datatable_container').html(formNineTableTemplate);
        var searchData = $('#search_form_nine_form').serializeFormJSON();

        searchFNF = searchData;
        if (typeof btnObj == "undefined" && (searchFNF.app_details_for_form_nine_list == '' 
                && searchFNF.app_no_for_form_nine_list == '' 
                && searchFNF.application_date_for_form_nine_list == ''
                && searchFNF.query_status_for_form_nine_list == '' 
                && searchFNF.status_for_form_nine_list == '' 
                && searchFNF.district_for_form_nine_list == '' 
                && searchFNF.vdw_for_form_nine_list == '' 
                && searchFNF.is_full_for_form_nine_list == '')) {
            formNineDataTable = $('#form_nine_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#form_nine_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + ' ' + full.father_name + ' ' + full.surname
                    + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.address + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '</b>';
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
        $('#form_nine_datatable_container').html(formNineTableTemplate);
        formNineDataTable = $('#form_nine_datatable').DataTable({
            ajax: {url: 'form_nine/get_form_nine_data', dataSrc: "form_nine_data", type: "post", data: searchData},
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
//                {data: 'form_nine_id', 'class': 'text-center', 'render': appointmentRenderer},
                {data: 'form_nine_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'form_nine_id', 'class': 'text-center', 'render': formsAppStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#form_nine_datatable_filter').remove();
        $('#form_nine_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = formNineDataTable.row(tr);

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
        var tempData = '<table class="table table-bordered mb-0 bg-beige f-s-12px">';
        var landDetails = full.land_details != '' ? JSON.parse(full.land_details) : [];
        if (landDetails.length == VALUE_ZERO) {
            return '';
        }
        $.each(landDetails, function (index, ld) {
            var pendingLandTaxAmount = '';
            if (ld.pending_landtax) {
                pendingLandTaxAmount = '<span class="badge bg-danger app-status mw-10px f-s-10px" style="text-align:right">Pay ' + ld.pending_landtax + '/-</span>';
            }
            tempData += '<tr><td class="text-center">' + ld.survey + '</td>'
                    + '<td class="text-center">' + ld.subdiv + '</td>'
                    + '<td class="text-center">' + ld.mutation_entry_no + '</td>'
                    + '<td class="text-right">' + ld.copies + '</td>'
                    + '<td class="text-right">' + (ld.is_na == VALUE_ONE ? 'N.A.' : (ld.pages ? ld.pages : VALUE_ZERO)) + '</td>'
                    + '<td class="text-right">' + (ld.is_na == VALUE_ONE ? 'N.A.' : (ld.amount ? ld.amount : VALUE_ZERO)) + '</td>'
                    + '<td class="text-right" title="Click Here to Pay Your Land Tax" style="cursor:pointer;" onclick="LandTaxNA.listview.listPage(' + full.village + ',\'' + ld.survey + '\',\'' + ld.subdiv + '\');">' + pendingLandTaxAmount + '</td></tr>';
        });
        tempData += '<tr><td class="text-right text-success f-w-b" colspan="3">Rupees To Be Paid : </td>'
                + '<td class="text-right f-w-b">Copies : ' + full.total_copies + '</td>'
                + '<td class="text-right f-w-b">Pages : ' + full.total_pages + '</td>'
                + '<td class="text-right f-w-b">Rs. : ' + full.total_amount + '</td><td></td></tr>';
        return tempData;
    },
    editOrViewFormNine: function (btnObj, formNineId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formNineId) {
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
            url: 'form_nine/get_form_nine_data_by_id', type: 'post',
            data: $.extend({}, {'form_nine_id': formNineId, 'is_edit': (isEdit ? VALUE_ONE : VALUE_TWO)}, getTokenData()),
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
                    that.viewFormNine(VALUE_ONE, parseData, isPrint);
                }
            }
        });
    },
    viewFormNine: function (moduleType, parseData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var formNineData = parseData.form_nine_data;
        FormNine.router.navigate('view_form_nine_form');
        formNineData.title = 'View';
        formNineData.VALUE_THREE = VALUE_THREE;
        formNineData.district_text = talukaArray[formNineData.district] ? talukaArray[formNineData.district] : '';
        var district = formNineData.district;
        var villageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        formNineData.village_text = villageData[formNineData.village] ? villageData[formNineData.village]['village_name'] : '';
        formNineData.show_applicant_photo = formNineData.applicant_photo != '' ? true : false;
        formNineData.show_id_proof = formNineData.id_proof != '' ? true : false;
        formNineData.show_other_document = formNineData.other_document != '' ? true : false;
        if (formNineData.status != VALUE_ZERO && formNineData.status != VALUE_ONE) {
            formNineData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        formNineData.FORM_NINE_DOC_PATH = FORM_NINE_DOC_PATH;
        $('#popup_container').html(formNineViewTemplate(formNineData));

        var ldCnt = 1;
        var totalCopies = VALUE_ZERO;
        var totalPages = VALUE_ZERO;
        var totalAmount = VALUE_ZERO;
        $.each(parseData.form_land_details, function (index, fld) {
            var pendingLandTaxAmount = '';
            if (fld.pending_landtax) {
                pendingLandTaxAmount = '<span class="badge bg-danger app-status mw-80px f-s-16px" style="text-align:right">Pay ' + fld.pending_landtax + '/-</span>';
            }
            var ldRow = '<tr><td class="text-center">' + ldCnt + '</td>'
                    + '<td class="text-center">' + fld.survey + '</td>'
                    + '<td class="text-center">' + fld.subdiv + '</td>'
                    + '<td>' + fld.occupant_details + '</td>'
                    + '<td class="text-center">' + fld.total_area + '</td>'
                    + '<td class="text-center" title="Click Here to Pay Your Land Tax" style="cursor:pointer;" onclick="Swal.close(); LandTaxNA.listview.listPage(' + formNineData.village + ',\'' + fld.survey + '\',\'' + fld.subdiv + '\');">' + pendingLandTaxAmount + '</td>'
                    + '<td class="text-center">' + fld.mutation_entry_no + '</td>'
                    + '<td class="text-right">' + fld.copies + '</td>'
                    + '<td class="text-right">' + (fld.is_na == VALUE_ONE ? 'N.A.' : fld.pages) + '</td>'
                    + '<td class="text-right">' + (fld.is_na == VALUE_ONE ? 'N.A.' : fld.amount) + '</td></tr>';
            $('#fld_container_for_fnview').append(ldRow);
            totalCopies += parseInt(fld.copies) ? parseInt(fld.copies) : VALUE_ZERO;
            totalPages += parseInt(fld.pages) ? parseInt(fld.pages) : VALUE_ZERO;
            totalAmount += parseInt(fld.amount) ? parseInt(fld.amount) : VALUE_ZERO;
            ldCnt++;
        });
        $('#total_copies_for_fnview').html(totalCopies);
        $('#total_pages_for_fnview').html(totalPages);
        $('#total_amount_for_fnview').html(totalAmount);
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_fnview').click();
            }, 500);
        }

    },
    setAppointment: function (formNineId) {
        if (!formNineId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + formNineId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'form_nine/get_data_by_form_nine_id',
            type: 'post',
            data: $.extend({}, {'form_nine_id': formNineId}, getTokenData()),
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
                var fofData = parseData.form_nine_data;
                showPopup();
                if (fofData == null) {
                    var fofData = {};
                }
                if (fofData.status != VALUE_FIVE && fofData.status != VALUE_SIX) {
                    fofData.show_submit_btn = true;
                }
                $('#popup_container').html(formNineSetAppointmentTemplate(fofData));
                datePickerAppointment();
                var appointmentDate = fofData.appointment_date != '0000-00-00' ? dateTo_DD_MM_YYYY(fofData.appointment_date) : '';
                $('#appointment_date_for_form_nine').val(appointmentDate);
                $('#appointment_time_for_form_nine').val(fofData.appointment_time);
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
        var formData = $('#set_appointment_form_nine_form').serializeFormJSON();
        if (!formData.form_nine_id_for_form_nine_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_form_nine) {
            $('#appointment_date_for_form_nine').focus();
            validationMessageShow('form-nine-appointment_date_for_form_nine', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_form_nine) {
            $('#appointment_time_for_form_nine').focus();
            validationMessageShow('form-nine-appointment_time_for_form_nine', timeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_nine_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_nine/submit_set_appointment',
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
                validationMessageShow('form-nine-set-appointment', textStatus.statusText);
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
                    validationMessageShow('form-nine-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var incomeCertificateData = parseData.form_nine_data;
                $('#appointment_container_' + incomeCertificateData.form_nine_id).html(that.getAppointmentData(incomeCertificateData));
                $('#appointment_by_name_' + incomeCertificateData.form_nine_id).html('<hr>' + parseData.appointment_by_name);
            }
        });
    },
    askForApproveRejectApplication: function (btnObj, formNineId, moduleType) {
        if (!formNineId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'form_nine/get_data_by_form_nine_id',
            type: 'post',
            data: $.extend({}, {'form_nine_id': formNineId}, getTokenData()),
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
                var formNineData = parseData.form_nine_data;
                showPopup();
                if (moduleType == VALUE_ONE) {
                    $('#popup_container').html(formNineApproveTemplate(formNineData));
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(formNineRejectTemplate(formNineData));
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
        var formData = $('#approve_form_nine_form').serializeFormJSON();
        if (!formData.form_nine_id_for_form_nine_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_form_nine_approve) {
            $('#remarks_for_form_nine_approve').focus();
            validationMessageShow('form-nine-approve-remarks_for_form_nine_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_nine_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_nine/approve_application',
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
                validationMessageShow('form-nine-approve', textStatus.statusText);
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
                    validationMessageShow('form-nine-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FormNine.listview.loadFormNineData();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_form_nine_form').serializeFormJSON();
        if (!formData.form_nine_id_for_form_nine_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_form_nine_reject) {
            $('#remarks_for_form_nine_reject').focus();
            validationMessageShow('form-nine-reject-remarks_for_form_nine_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_nine_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_nine/reject_application',
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
                validationMessageShow('form-nine-reject', textStatus.statusText);
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
                    validationMessageShow('form-nine-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FormNine.listview.loadFormNineData();
            }
        });
    },
    getQueryData: function (formNineId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formNineId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var templateData = {};
        templateData.module_type = VALUE_SIXTEEN;
        templateData.module_id = formNineId;
        var btnObj = $('#query_btn_for_app_' + formNineId);
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
                tmpData.module_type = VALUE_SIXTEEN;
                tmpData.module_id = formNineId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
});
