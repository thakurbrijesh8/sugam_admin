var formFiveListTemplate = Handlebars.compile($('#form_five_list_template').html());
var formFiveSearchTemplate = Handlebars.compile($('#form_five_search_template').html());
var formFiveTableTemplate = Handlebars.compile($('#form_five_table_template').html());
var formFiveActionTemplate = Handlebars.compile($('#form_five_action_template').html());
var formFiveViewTemplate = Handlebars.compile($('#form_five_view_template').html());
var formFiveSetAppointmentTemplate = Handlebars.compile($('#form_five_set_appointment_template').html());
var formFiveApproveTemplate = Handlebars.compile($('#form_five_approve_template').html());
var formFiveRejectTemplate = Handlebars.compile($('#form_five_reject_template').html());

var searchFFF = {};

var FormFive = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
FormFive.Router = Backbone.Router.extend({
    routes: {
        'form_five': 'renderList',
        'view_form_five_form': 'renderList',
    },
    renderList: function () {
        FormFive.listview.listPage();
    },
});
FormFive.listView = Backbone.View.extend({
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
        addClass('mam_form_5', 'active');
        FormFive.router.navigate('form_five');
        var templateData = {};
        searchFFF = {};
        this.$el.html(formFiveListTemplate(templateData));
        this.loadFormFiveData(sDistrict, sType);

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
        rowData.module_type = VALUE_FIFTEEN;
        rowData.ld_module_type = VALUE_FIVE;
        return formFiveActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        if (appointmentData.appointment_date == '0000-00-00') {
            return '';
        }
        var returnString = '<span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">'
                + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">Visit Office</span>';
        return returnString;
    },
    loadFormFiveData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        
        FormFive.router.navigate('form_five');
        var searchData = dtomFeesStatus(sDistrict, sType, 'FormFive.listview.loadFormFiveData();');
        
        $('#form_five_form_and_datatable_container').html(formFiveSearchTemplate(searchData));
        
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        //distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_form_five_list', false);
        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_form_five_list', false);
        renderOptionsForTwoDimensionalArray(fAppStatusTextArray, 'status_for_form_five_list', false);
        datePickerId('application_date_for_form_five_list');
        
        if (tempTypeInSession != TEMP_TYPE_A) {
            var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'vdw_for_form_five_list', 'village', 'village_name', false, false);
        } else {
            if (typeof searchFFF.district_for_form_five_list != "undefined" && searchFFF.district_for_form_five_list != '' && searchFFF.village_for_form_five_list != '')
            {
                var villageData = (searchFFF.district_for_form_five_list == VALUE_ONE ? tempVillageData : (searchFFF.district_for_form_five_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_form_five_list', 'village', 'village_name', false, false);
            }
        }
        
        $('#app_no_for_form_five_list').val((typeof searchFFF.app_no_for_form_five_list != "undefined" && searchFFF.app_no_for_form_five_list != '') ? searchFFF.app_no_for_form_five_list : '');
        $('#application_date_for_form_five_list').val((typeof searchFFF.application_date_for_form_five_list != "undefined" && searchFFF.application_date_for_form_five_list != '') ? searchFFF.application_date_for_form_five_list : searchData.s_appd);
        $('#app_details_for_form_five_list').val((typeof searchFFF.app_details_for_form_five_list != "undefined" && searchFFF.app_details_for_form_five_list != '') ? searchFFF.app_details_for_form_five_list : '');
        $('#query_status_for_form_five_list').val((typeof searchFFF.query_status_for_form_five_list != "undefined" && searchFFF.query_status_for_form_five_list != '') ? searchFFF.query_status_for_form_five_list : searchData.s_qstatus);
        $('#status_for_form_five_list').val((typeof searchFFF.status_for_form_five_list != "undefined" && searchFFF.status_for_form_five_list != '') ? searchFFF.status_for_form_five_list : searchData.s_status);
        $('#district_for_form_five_list').val((typeof searchFFF.district_for_form_five_list != "undefined" && searchFFF.district_for_form_five_list != '') ? searchFFF.district_for_form_five_list : searchData.search_district);
        $('#vdw_for_form_five_list').val((typeof searchFFF.vdw_for_form_five_list != "undefined" && searchFFF.vdw_for_form_five_list != '') ? searchFFF.vdw_for_form_five_list : '');
        $('#is_full_for_form_five_list').val((typeof searchFFF.is_full_for_form_five_list != "undefined" && searchFFF.is_full_for_form_five_list != '') ? searchFFF.is_full_for_form_five_list : searchData.s_is_full);
        
        this.searchFormFiveData();
        
    },
    searchFormFiveData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#form_five_datatable_container').html(formFiveTableTemplate);
        var searchData = $('#search_form_five_form').serializeFormJSON();

        searchFFF = searchData;
        if (typeof btnObj == "undefined" && (searchFFF.app_details_for_form_five_list == '' 
                && searchFFF.app_no_for_form_five_list == '' 
                && searchFFF.application_date_for_form_five_list == ''
                && searchFFF.query_status_for_form_five_list == '' 
                && searchFFF.status_for_form_five_list == '' 
                && searchFFF.district_for_form_five_list == ''
                && searchFFF.vdw_for_form_five_list == '' 
                && searchFFF.is_full_for_form_five_list == '')) {
            formFiveDataTable = $('#form_five_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#form_five_datatable_filter').remove();
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
        $('#form_five_datatable_container').html(formFiveTableTemplate);
        formFiveDataTable = $('#form_five_datatable').DataTable({
            ajax: {url: 'form_five/get_form_five_data', dataSrc: "form_five_data", type: "post", data: searchData},
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
//                {data: 'form_five_id', 'class': 'text-center', 'render': appointmentRenderer},
                {data: 'form_five_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'form_five_id', 'class': 'text-center', 'render': formsAppStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#form_five_datatable_filter').remove();
        $('#form_five_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = formFiveDataTable.row(tr);

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
                    + '<td class="text-right">' + ld.copies + '</td>'
                    + '<td class="text-right">' + (ld.is_na == VALUE_ONE ? 'N.A.' : (ld.pages ? ld.pages : VALUE_ZERO)) + '</td>'
                    + '<td class="text-right">' + (ld.is_na == VALUE_ONE ? 'N.A.' : ld.amount) + '</td>'
                    + '<td class="text-right" title="Click Here to Pay Your Land Tax" style="cursor:pointer;" onclick="LandTaxNA.listview.listPage(' + full.village + ',\'' + ld.survey + '\',\'' + ld.subdiv + '\');">' + pendingLandTaxAmount + '</td></tr>';
        });
        tempData += '<tr><td class="text-right text-success f-w-b" colspan="2">Rupees To Be Paid : </td>'
                + '<td class="text-right f-w-b">Copies : ' + full.total_copies + '</td>'
                + '<td class="text-right f-w-b">Pages : ' + full.total_pages + '</td>'
                + '<td class="text-right f-w-b">Rs. : ' + full.total_amount + '</td><td></td></tr>';
        return tempData;
    },
    editOrViewFormFive: function (btnObj, formFiveId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formFiveId) {
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
            url: 'form_five/get_form_five_data_by_id', type: 'post',
            data: $.extend({}, {'form_five_id': formFiveId, 'is_edit': (isEdit ? VALUE_ONE : VALUE_TWO)}, getTokenData()),
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
                    that.viewFormFive(VALUE_ONE, parseData, isPrint);
                }
            }
        });
    },
    viewFormFive: function (moduleType, parseData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var formFiveData = parseData.form_five_data;
        FormFive.router.navigate('view_form_five_form');
        formFiveData.title = 'View';
        formFiveData.VALUE_THREE = VALUE_THREE;
        formFiveData.district_text = talukaArray[formFiveData.district] ? talukaArray[formFiveData.district] : '';
        var district = formFiveData.district;
        var villageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        formFiveData.village_text = villageData[formFiveData.village] ? villageData[formFiveData.village]['village_name'] : '';
        formFiveData.show_applicant_photo = formFiveData.applicant_photo != '' ? true : false;
        formFiveData.show_id_proof = formFiveData.id_proof != '' ? true : false;
        formFiveData.show_other_document = formFiveData.other_document != '' ? true : false;
        if (formFiveData.status != VALUE_ZERO && formFiveData.status != VALUE_ONE) {
            formFiveData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        formFiveData.FORM_FIVE_DOC_PATH = FORM_FIVE_DOC_PATH;
        $('#popup_container').html(formFiveViewTemplate(formFiveData));

        var ldCnt = 1;
        var totalCopies = 0;
        var totalPages = 0;
        var totalAmount = 0;
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
                    + '<td class="text-center" title="Click Here to Pay Your Land Tax" style="cursor:pointer;" onclick="Swal.close(); LandTaxNA.listview.listPage(' + formFiveData.village + ',\'' + fld.survey + '\',\'' + fld.subdiv + '\');">' + pendingLandTaxAmount + '</td>'
                    + '<td class="text-right">' + fld.copies + '</td>'
                    + '<td class="text-right">' + (fld.is_na == VALUE_ONE ? 'N.A.' : fld.pages) + '</td>'
                    + '<td class="text-right">' + (fld.is_na == VALUE_ONE ? 'N.A.' : fld.amount) + '</td></tr>';
            $('#fld_container_for_ffview').append(ldRow);
            totalCopies += parseInt(fld.copies) ? parseInt(fld.copies) : VALUE_ZERO;
            totalPages += parseInt(fld.pages) ? parseInt(fld.pages) : VALUE_ZERO;
            totalAmount += parseInt(fld.amount) ? parseInt(fld.amount) : VALUE_ZERO;
            ldCnt++;
        });
        $('#total_copies_for_ffview').html(totalCopies);
        $('#total_pages_for_ffview').html(totalPages);
        $('#total_amount_for_ffview').html(totalAmount);
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_ffview').click();
            }, 500);
        }
    },
    setAppointment: function (formFiveId) {
        if (!formFiveId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + formFiveId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'form_five/get_data_by_form_five_id',
            type: 'post',
            data: $.extend({}, {'form_five_id': formFiveId}, getTokenData()),
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
                var fofData = parseData.form_five_data;
                showPopup();
                if (fofData == null) {
                    var fofData = {};
                }
                if (fofData.status != VALUE_FIVE && fofData.status != VALUE_SIX) {
                    fofData.show_submit_btn = true;
                }
                $('#popup_container').html(formFiveSetAppointmentTemplate(fofData));
                datePickerAppointment();
                var appointmentDate = fofData.appointment_date != '0000-00-00' ? dateTo_DD_MM_YYYY(fofData.appointment_date) : '';
                $('#appointment_date_for_form_five').val(appointmentDate);
                $('#appointment_time_for_form_five').val(fofData.appointment_time);
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
        var formData = $('#set_appointment_form_five_form').serializeFormJSON();
        if (!formData.form_five_id_for_form_five_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_form_five) {
            $('#appointment_date_for_form_five').focus();
            validationMessageShow('form-five-appointment_date_for_form_five', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_form_five) {
            $('#appointment_time_for_form_five').focus();
            validationMessageShow('form-five-appointment_time_for_form_five', timeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_five_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_five/submit_set_appointment',
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
                validationMessageShow('form-five-set-appointment', textStatus.statusText);
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
                    validationMessageShow('form-five-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var incomeCertificateData = parseData.form_five_data;
                $('#appointment_container_' + incomeCertificateData.form_five_id).html(that.getAppointmentData(incomeCertificateData));
                $('#appointment_by_name_' + incomeCertificateData.form_five_id).html('<hr>' + parseData.appointment_by_name);
            }
        });
    },
    askForApproveRejectApplication: function (btnObj, formFiveId, moduleType) {
        if (!formFiveId) {
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
            url: 'form_five/get_data_by_form_five_id',
            type: 'post',
            data: $.extend({}, {'form_five_id': formFiveId}, getTokenData()),
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
                var formFiveData = parseData.form_five_data;
                showPopup();
                if (moduleType == VALUE_ONE) {
                    $('#popup_container').html(formFiveApproveTemplate(formFiveData));
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(formFiveRejectTemplate(formFiveData));
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
        var formData = $('#approve_form_five_form').serializeFormJSON();
        if (!formData.form_five_id_for_form_five_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_form_five_approve) {
            $('#remarks_for_form_five_approve').focus();
            validationMessageShow('form-five-approve-remarks_for_form_five_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_five_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_five/approve_application',
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
                validationMessageShow('form-five-approve', textStatus.statusText);
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
                    validationMessageShow('form-five-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FormFive.listview.loadFormFiveData();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_form_five_form').serializeFormJSON();
        if (!formData.form_five_id_for_form_five_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_form_five_reject) {
            $('#remarks_for_form_five_reject').focus();
            validationMessageShow('form-five-reject-remarks_for_form_five_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_five_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_five/reject_application',
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
                validationMessageShow('form-five-reject', textStatus.statusText);
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
                    validationMessageShow('form-five-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FormFive.listview.loadFormFiveData();
            }
        });
    },
    getQueryData: function (formFiveId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formFiveId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var templateData = {};
        templateData.module_type = VALUE_FIFTEEN;
        templateData.module_id = formFiveId;
        var btnObj = $('#query_btn_for_app_' + formFiveId);
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
                tmpData.module_type = VALUE_FIFTEEN;
                tmpData.module_id = formFiveId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
});
