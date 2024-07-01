var formThreeListTemplate = Handlebars.compile($('#form_three_list_template').html());
var formThreeSearchTemplate = Handlebars.compile($('#form_three_search_template').html());
var formThreeTableTemplate = Handlebars.compile($('#form_three_table_template').html());
var formThreeActionTemplate = Handlebars.compile($('#form_three_action_template').html());
var formThreeViewTemplate = Handlebars.compile($('#form_three_view_template').html());
var formThreeSetAppointmentTemplate = Handlebars.compile($('#form_three_set_appointment_template').html());
var formThreeApproveTemplate = Handlebars.compile($('#form_three_approve_template').html());
var formThreeRejectTemplate = Handlebars.compile($('#form_three_reject_template').html());

var searchFTF = {};

var FormThree = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
FormThree.Router = Backbone.Router.extend({
    routes: {
        'form_three': 'renderList',
        'view_form_three_form': 'renderList',
    },
    renderList: function () {
        FormThree.listview.listPage();
    },
});
FormThree.listView = Backbone.View.extend({
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
        addClass('mam_form_3', 'active');
        FormThree.router.navigate('form_three');
        var templateData = {};
        searchFTF = {};
        this.$el.html(formThreeListTemplate(templateData));
        this.loadFormThreeData(sDistrict, sType);

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
        rowData.module_type = VALUE_FOURTEEN;
        rowData.ld_module_type = VALUE_TWO;
        return formThreeActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        if (appointmentData.appointment_date == '0000-00-00') {
            return '';
        }
        var returnString = '<span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">'
                + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">Visit Office</span>';
        return returnString;
    },
    loadFormThreeData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        
        FormThree.router.navigate('form_three');
        var searchData = dtomFeesStatus(sDistrict, sType, 'FormThree.listview.loadFormThreeData();');

        $('#form_three_form_and_datatable_container').html(formThreeSearchTemplate(searchData));
        
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        //distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_form_three_list', false);
        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_form_three_list', false);
        renderOptionsForTwoDimensionalArray(fAppStatusTextArray, 'status_for_form_three_list', false);
        datePickerId('application_date_for_form_three_list');
        
        if (tempTypeInSession != TEMP_TYPE_A) {
            var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'vdw_for_form_three_list', 'village', 'village_name', false, false);
        } else {
            if (typeof searchFTF.district_for_form_three_list != "undefined" && searchFTF.district_for_form_three_list != '' && searchFTF.village_for_form_three_list != '')
            {
                var villageData = (searchFTF.district_for_form_three_list == VALUE_ONE ? tempVillageData : (searchFTF.district_for_form_three_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_form_three_list', 'village', 'village_name', false, false);
            }
        }
        
        $('#app_no_for_form_three_list').val((typeof searchFTF.app_no_for_form_three_list != "undefined" && searchFTF.app_no_for_form_three_list != '') ? searchFTF.app_no_for_form_three_list : '');
        $('#application_date_for_form_three_list').val((typeof searchFTF.application_date_for_form_three_list != "undefined" && searchFTF.application_date_for_form_three_list != '') ? searchFTF.application_date_for_form_three_list : searchData.s_appd);
        $('#app_details_for_form_three_list').val((typeof searchFTF.app_details_for_form_three_list != "undefined" && searchFTF.app_details_for_form_three_list != '') ? searchFTF.app_details_for_form_three_list : '');
        $('#query_status_for_form_three_list').val((typeof searchFTF.query_status_for_form_three_list != "undefined" && searchFTF.query_status_for_form_three_list != '') ? searchFTF.query_status_for_form_three_list : searchData.s_qstatus);
        $('#status_for_form_three_list').val((typeof searchFTF.status_for_form_three_list != "undefined" && searchFTF.status_for_form_three_list != '') ? searchFTF.status_for_form_three_list : searchData.s_status);
        $('#district_for_form_three_list').val((typeof searchFTF.district_for_form_three_list != "undefined" && searchFTF.district_for_form_three_list != '') ? searchFTF.district_for_form_three_list : searchData.search_district);
        $('#vdw_for_form_three_list').val((typeof searchFTF.vdw_for_form_three_list != "undefined" && searchFTF.vdw_for_form_three_list != '') ? searchFTF.vdw_for_form_three_list : '');
        $('#is_full_for_form_three_list').val((typeof searchFTF.is_full_for_form_three_list != "undefined" && searchFTF.is_full_for_form_three_list != '') ? searchFTF.is_full_for_form_three_list : searchData.s_is_full);
        
        this.searchFormThreeData();
        
    },
    searchFormThreeData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#form_three_datatable_container').html(formThreeTableTemplate);
        var searchData = $('#search_form_three_form').serializeFormJSON();

        searchFTF = searchData;
        if (typeof btnObj == "undefined" && (searchFTF.app_details_for_form_three_list == '' 
                && searchFTF.app_no_for_form_three_list == '' 
                && searchFTF.application_date_for_form_three_list == ''
                && searchFTF.query_status_for_form_three_list == '' 
                && searchFTF.status_for_form_three_list == '' 
                && searchFTF.district_for_form_three_list == '' 
                && searchFTF.vdw_for_form_three_list == '' 
                && searchFTF.is_full_for_form_three_list == '')) {
            formThreeDataTable = $('#form_three_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#form_three_datatable_filter').remove();
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
        $('#form_three_datatable_container').html(formThreeTableTemplate);
        formThreeDataTable = $('#form_three_datatable').DataTable({
            ajax: {url: 'form_three/get_form_three_data', dataSrc: "form_three_data", type: "post", data: searchData},
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
//                {data: 'form_three_id', 'class': 'text-center', 'render': appointmentRenderer},
                {data: 'form_three_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'form_three_id', 'class': 'text-center', 'render': formsAppStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#form_three_datatable_filter').remove();
        $('#form_three_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = formThreeDataTable.row(tr);

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
    editOrViewFormThree: function (btnObj, formThreeId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formThreeId) {
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
            url: 'form_three/get_form_three_data_by_id', type: 'post',
            data: $.extend({}, {'form_three_id': formThreeId, 'is_edit': (isEdit ? VALUE_ONE : VALUE_TWO)}, getTokenData()),
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
                    that.viewFormThree(VALUE_ONE, parseData, isPrint);
                }
            }
        });
    },
    viewFormThree: function (moduleType, parseData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var formThreeData = parseData.form_three_data;
        FormThree.router.navigate('view_form_three_form');
        formThreeData.title = 'View';
        formThreeData.VALUE_THREE = VALUE_THREE;
        formThreeData.district_text = talukaArray[formThreeData.district] ? talukaArray[formThreeData.district] : '';
        var district = formThreeData.district;
        var villageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        formThreeData.village_text = villageData[formThreeData.village] ? villageData[formThreeData.village]['village_name'] : '';
        formThreeData.show_applicant_photo = formThreeData.applicant_photo != '' ? true : false;
        formThreeData.show_id_proof = formThreeData.id_proof != '' ? true : false;
        formThreeData.show_other_document = formThreeData.other_document != '' ? true : false;
        if (formThreeData.status != VALUE_ZERO && formThreeData.status != VALUE_ONE) {
            formThreeData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        formThreeData.FORM_THREE_DOC_PATH = FORM_THREE_DOC_PATH;
        $('#popup_container').html(formThreeViewTemplate(formThreeData));

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
                    + '<td class="text-center" title="Click Here to Pay Your Land Tax" style="cursor:pointer;" onclick="Swal.close(); LandTaxNA.listview.listPage(' + formThreeData.village + ',\'' + fld.survey + '\',\'' + fld.subdiv + '\');">' + pendingLandTaxAmount + '</td>'
                    + '<td class="text-right">' + fld.copies + '</td>'
                    + '<td class="text-right">' + (fld.is_na == VALUE_ONE ? 'N.A.' : fld.pages) + '</td>'
                    + '<td class="text-right">' + (fld.is_na == VALUE_ONE ? 'N.A.' : fld.amount) + '</td></tr>';
            $('#fld_container_for_ftview').append(ldRow);
            totalCopies += parseInt(fld.copies) ? parseInt(fld.copies) : VALUE_ZERO;
            totalPages += parseInt(fld.pages) ? parseInt(fld.pages) : VALUE_ZERO;
            totalAmount += parseInt(fld.amount) ? parseInt(fld.amount) : VALUE_ZERO;
            ldCnt++;
        });
        $('#total_copies_for_ftview').html(totalCopies);
        $('#total_pages_for_ftview').html(totalPages);
        $('#total_amount_for_ftview').html(totalAmount);
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_ftview').click();
            }, 500);
        }
    },
    setAppointment: function (formThreeId) {
        if (!formThreeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + formThreeId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'form_three/get_data_by_form_three_id',
            type: 'post',
            data: $.extend({}, {'form_three_id': formThreeId}, getTokenData()),
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
                var fofData = parseData.form_three_data;
                showPopup();
                if (fofData == null) {
                    var fofData = {};
                }
                if (fofData.status != VALUE_FIVE && fofData.status != VALUE_SIX) {
                    fofData.show_submit_btn = true;
                }
                $('#popup_container').html(formThreeSetAppointmentTemplate(fofData));
                datePickerAppointment();
                var appointmentDate = fofData.appointment_date != '0000-00-00' ? dateTo_DD_MM_YYYY(fofData.appointment_date) : '';
                $('#appointment_date_for_form_three').val(appointmentDate);
                $('#appointment_time_for_form_three').val(fofData.appointment_time);
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
        var formData = $('#set_appointment_form_three_form').serializeFormJSON();
        if (!formData.form_three_id_for_form_three_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_form_three) {
            $('#appointment_date_for_form_three').focus();
            validationMessageShow('form-three-appointment_date_for_form_three', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_form_three) {
            $('#appointment_time_for_form_three').focus();
            validationMessageShow('form-three-appointment_time_for_form_three', timeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_three_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_three/submit_set_appointment',
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
                validationMessageShow('form-three-set-appointment', textStatus.statusText);
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
                    validationMessageShow('form-three-set-appointment', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                var incomeCertificateData = parseData.form_three_data;
                $('#appointment_container_' + incomeCertificateData.form_three_id).html(that.getAppointmentData(incomeCertificateData));
                $('#appointment_by_name_' + incomeCertificateData.form_three_id).html('<hr>' + parseData.appointment_by_name);
            }
        });
    },
    askForApproveRejectApplication: function (btnObj, formThreeId, moduleType) {
        if (!formThreeId) {
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
            url: 'form_three/get_data_by_form_three_id',
            type: 'post',
            data: $.extend({}, {'form_three_id': formThreeId}, getTokenData()),
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
                var formThreeData = parseData.form_three_data;
                showPopup();
                if (moduleType == VALUE_ONE) {
                    $('#popup_container').html(formThreeApproveTemplate(formThreeData));
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(formThreeRejectTemplate(formThreeData));
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
        var formData = $('#approve_form_three_form').serializeFormJSON();
        if (!formData.form_three_id_for_form_three_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_form_three_approve) {
            $('#remarks_for_form_three_approve').focus();
            validationMessageShow('form-three-approve-remarks_for_form_three_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_three_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_three/approve_application',
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
                validationMessageShow('form-three-approve', textStatus.statusText);
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
                    validationMessageShow('form-three-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FormThree.listview.loadFormThreeData();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_form_three_form').serializeFormJSON();
        if (!formData.form_three_id_for_form_three_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_form_three_reject) {
            $('#remarks_for_form_three_reject').focus();
            validationMessageShow('form-three-reject-remarks_for_form_three_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_form_three_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'form_three/reject_application',
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
                validationMessageShow('form-three-reject', textStatus.statusText);
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
                    validationMessageShow('form-three-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                FormThree.listview.loadFormThreeData();
            }
        });
    },
    getQueryData: function (formThreeId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formThreeId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var templateData = {};
        templateData.module_type = VALUE_FOURTEEN;
        templateData.module_id = formThreeId;
        var btnObj = $('#query_btn_for_app_' + formThreeId);
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
                tmpData.module_type = VALUE_FOURTEEN;
                tmpData.module_id = formThreeId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
});
