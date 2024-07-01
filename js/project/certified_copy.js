var certifiedCopyListTemplate = Handlebars.compile($('#certified_copy_list_template').html());
var certifiedCopySearchTemplate = Handlebars.compile($('#certified_copy_search_template').html());
var certifiedCopyTableTemplate = Handlebars.compile($('#certified_copy_table_template').html());
var certifiedCopyActionTemplate = Handlebars.compile($('#certified_copy_action_template').html());
var certifiedCopyViewTemplate = Handlebars.compile($('#certified_copy_view_template').html());
var certifiedCopySetAppointmentTemplate = Handlebars.compile($('#certified_copy_set_appointment_template').html());
var certifiedCopyApproveTemplate = Handlebars.compile($('#certified_copy_approve_template').html());
var certifiedCopyRejectTemplate = Handlebars.compile($('#certified_copy_reject_template').html());

var searchCCF = {};

var CertifiedCopy = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
CertifiedCopy.Router = Backbone.Router.extend({
    routes: {
        'certified_copy': 'renderList',
        'view_certified_copy_form': 'renderList',
    },
    renderList: function () {
        CertifiedCopy.listview.listPage();
    },
});
CertifiedCopy.listView = Backbone.View.extend({
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
        addClass('mam_certified_copy', 'active');
        CertifiedCopy.router.navigate('certified_copy');
        var templateData = {};
        searchCCF = {};
        this.$el.html(certifiedCopyListTemplate(templateData));
        this.loadCertifiedCopyData(sDistrict, sType);

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
        rowData.module_type = VALUE_NINE;
        rowData.ld_module_type = VALUE_FOUR;
        return certifiedCopyActionTemplate(rowData);
    },
    getAppointmentData: function (appointmentData) {
        if (appointmentData.appointment_date == '0000-00-00') {
            return '';
        }
        var returnString = '<span class="badge bg-success app-status">Appointment Scheduled On<hr style="border-top-color: white;">'
                + dateTo_DD_MM_YYYY(appointmentData.appointment_date) + ' ' + (appointmentData.appointment_time) + '<hr style="border-top-color: white;">Visit Office</span>';
        return returnString;
    },
    loadCertifiedCopyData: function (sDistrict, sType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        
        CertifiedCopy.router.navigate('certified_copy');
        var searchData = dtomFeesStatus(sDistrict, sType, 'CertifiedCopy.listview.loadCertifiedCopyData();');
        $('#certified_copy_form_and_datatable_container').html(certifiedCopySearchTemplate(searchData));
        
        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        //distData[VALUE_TWO] = talukaArray[VALUE_TWO] ? talukaArray[VALUE_TWO] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_certified_copy_list', false);
        renderOptionsForTwoDimensionalArray(queryStatuTextsArray, 'query_status_for_certified_copy_list', false);
        renderOptionsForTwoDimensionalArray(fAppStatusTextArray, 'status_for_certified_copy_list', false);
        datePickerId('application_date_for_certified_copy_list');
        
        if (tempTypeInSession != TEMP_TYPE_A) {
            var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'vdw_for_certified_copy_list', 'village', 'village_name', false, false);
        } else {
            if (typeof searchCCF.district_for_certified_copy_list != "undefined" && searchCCF.district_for_certified_copy_list != '' && searchCCF.village_for_certified_copy_list != '')
            {
                var villageData = (searchCCF.district_for_certified_copy_list == VALUE_ONE ? tempVillageData : (searchCCF.district_for_certified_copy_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_certified_copy_list', 'village', 'village_name', false, false);
            }
        }
        
        $('#app_no_for_certified_copy_list').val((typeof searchCCF.app_no_for_certified_copy_list != "undefined" && searchCCF.app_no_for_certified_copy_list != '') ? searchCCF.app_no_for_certified_copy_list : '');
        $('#application_date_for_certified_copy_list').val((typeof searchCCF.application_date_for_certified_copy_list != "undefined" && searchCCF.application_date_for_certified_copy_list != '') ? searchCCF.application_date_for_certified_copy_list : searchData.s_appd);
        $('#app_details_for_certified_copy_list').val((typeof searchCCF.app_details_for_certified_copy_list != "undefined" && searchCCF.app_details_for_certified_copy_list != '') ? searchCCF.app_details_for_certified_copy_list : '');
        $('#query_status_for_certified_copy_list').val((typeof searchCCF.query_status_for_certified_copy_list != "undefined" && searchCCF.query_status_for_certified_copy_list != '') ? searchCCF.query_status_for_certified_copy_list : searchData.s_qstatus);
        $('#status_for_certified_copy_list').val((typeof searchCCF.status_for_certified_copy_list != "undefined" && searchCCF.status_for_certified_copy_list != '') ? searchCCF.status_for_certified_copy_list : searchData.s_status);
        $('#district_for_certified_copy_list').val((typeof searchCCF.district_for_certified_copy_list != "undefined" && searchCCF.district_for_certified_copy_list != '') ? searchCCF.district_for_certified_copy_list : searchData.search_district);
        $('#vdw_for_certified_copy_list').val((typeof searchCCF.vdw_for_certified_copy_list != "undefined" && searchCCF.vdw_for_certified_copy_list != '') ? searchCCF.vdw_for_certified_copy_list : '');
        $('#is_full_for_certified_copy_list').val((typeof searchCCF.is_full_for_certified_copy_list != "undefined" && searchCCF.is_full_for_certified_copy_list != '') ? searchCCF.is_full_for_certified_copy_list : searchData.s_is_full);
        
        this.searchCertifiedCopyData();
        
    },
    searchCertifiedCopyData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#certified_copy_datatable_container').html(certifiedCopyTableTemplate);
        var searchData = $('#search_certified_copy_form').serializeFormJSON();

        searchCCF = searchData;
        if (typeof btnObj == "undefined" && (searchCCF.app_details_for_certified_copy_list == '' 
                && searchCCF.app_no_for_certified_copy_list == '' 
                && searchCCF.application_date_for_certified_copy_list == ''
                && searchCCF.query_status_for_certified_copy_list == '' 
                && searchCCF.status_for_certified_copy_list == '' 
                && searchCCF.district_for_certified_copy_list == '' 
                && searchCCF.vdw_for_certified_copy_list == '' 
                && searchCCF.is_full_for_certified_copy_list == '')) {
            certifiedCopyDataTable = $('#certified_copy_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#certified_copy_datatable_filter').remove();
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
        $('#certified_copy_datatable_container').html(certifiedCopyTableTemplate);
        certifiedCopyDataTable = $('#certified_copy_datatable').DataTable({
            ajax: {url: 'certified_copy/get_certified_copy_data', dataSrc: "certified_copy_data", type: "post", data: searchData},
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
//                {data: 'certified_copy_id', 'class': 'text-center', 'render': appointmentRenderer},
                {data: 'certified_copy_id', 'class': 'text-center', 'render': queryStatusRenderer},
                {data: 'certified_copy_id', 'class': 'text-center', 'render': formsAppStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#certified_copy_datatable_filter').remove();
        $('#certified_copy_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = certifiedCopyDataTable.row(tr);

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
                    + '<td class="text-right">' + ld.document_required + '</td>'
                    + '<td class="text-right">' + ld.copies + '</td>'
                    + '<td class="text-right">' + (ld.is_na == VALUE_ONE ? 'N.A.' : (ld.pages ? ld.pages : VALUE_ZERO)) + '</td>'
                    + '<td class="text-right">' + (ld.is_na == VALUE_ONE ? 'N.A.' : (ld.amount ? ld.amount : VALUE_ZERO)) + '</td>'
                    + '<td class="text-right" title="Click Here to Pay Your Land Tax" style="cursor:pointer;" onclick="LandTaxNA.listview.listPage(' + full.village + ',\'' + ld.survey + '\',\'' + ld.subdiv + '\');">' + pendingLandTaxAmount + '</td></tr>';
        });
        tempData += '<tr><td class="text-right text-success f-w-b" colspan="4">Rupees To Be Paid : </td>'
                + '<td class="text-right f-w-b">Copies : ' + full.total_copies + '</td>'
                + '<td class="text-right f-w-b">Pages : ' + full.total_pages + '</td>'
                + '<td class="text-right f-w-b">Rs. : ' + full.total_amount + '</td><td></td></tr>';
        return tempData;
    },
    editOrViewCertifiedCopy: function (btnObj, certifiedCopyId, isEdit, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!certifiedCopyId) {
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
            url: 'certified_copy/get_certified_copy_data_by_id', type: 'post',
            data: $.extend({}, {'certified_copy_id': certifiedCopyId, 'is_edit': (isEdit ? VALUE_ONE : VALUE_TWO)}, getTokenData()),
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
                    that.viewCertifiedCopy(VALUE_ONE, parseData, isPrint);
                }
            }
        });
    },
    viewCertifiedCopy: function (moduleType, parseData, isPrint) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var certifiedCopyData = parseData.certified_copy_data;
        CertifiedCopy.router.navigate('view_certified_copy_form');
        certifiedCopyData.title = 'View';
        certifiedCopyData.VALUE_THREE = VALUE_THREE;
        certifiedCopyData.district_text = talukaArray[certifiedCopyData.district] ? talukaArray[certifiedCopyData.district] : '';
        var district = certifiedCopyData.district;
        var villageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        certifiedCopyData.village_text = villageData[certifiedCopyData.village] ? villageData[certifiedCopyData.village]['village_name'] : '';
        certifiedCopyData.show_applicant_photo = certifiedCopyData.applicant_photo != '' ? true : false;
        certifiedCopyData.show_id_proof = certifiedCopyData.id_proof != '' ? true : false;
        certifiedCopyData.show_other_document = certifiedCopyData.other_document != '' ? true : false;
        if (certifiedCopyData.status != VALUE_ZERO && certifiedCopyData.status != VALUE_ONE) {
            certifiedCopyData.show_print_btn = true;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        certifiedCopyData.CERTIFIED_COPY_DOC_PATH = CERTIFIED_COPY_DOC_PATH;
        $('#popup_container').html(certifiedCopyViewTemplate(certifiedCopyData));

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
                    + '<td class="text-center" title="Click Here to Pay Your Land Tax" style="cursor:pointer;" onclick="Swal.close(); LandTaxNA.listview.listPage(' + certifiedCopyData.village + ',\'' + fld.survey + '\',\'' + fld.subdiv + '\');">' + pendingLandTaxAmount + '</td>'
                    + '<td class="text-center">' + fld.mutation_entry_no + '</td>'
                    + '<td class="text-right">' + fld.document_required + '</td>'
                    + '<td class="text-right">' + fld.copies + '</td>'
                    + '<td class="text-right">' + (fld.is_na == VALUE_ONE ? 'N.A.' : fld.pages) + '</td>'
                    + '<td class="text-right">' + (fld.is_na == VALUE_ONE ? 'N.A.' : fld.amount) + '</td></tr>';
            $('#fld_container_for_certi_c_view').append(ldRow);
            totalCopies += parseInt(fld.copies) ? parseInt(fld.copies) : VALUE_ZERO;
            totalPages += parseInt(fld.pages) ? parseInt(fld.pages) : VALUE_ZERO;
            totalAmount += parseInt(fld.amount) ? parseInt(fld.amount) : VALUE_ZERO;
            ldCnt++;
        });
        $('#total_copies_for_certi_c_view').html(totalCopies);
        $('#total_pages_for_certi_c_view').html(totalPages);
        $('#total_amount_for_certi_c_view').html(totalAmount);
        if (isPrint) {
            setTimeout(function () {
                $('#pa_btn_for_certi_c_view').click();
            }, 500);
        }
    },
    setAppointment: function (certifiedCopyId) {
        if (!certifiedCopyId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var that = this;
        var btnObj = $('#appointment_btn_for_app_' + certifiedCopyId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'certified_copy/get_data_by_certified_copy_id',
            type: 'post',
            data: $.extend({}, {'certified_copy_id': certifiedCopyId}, getTokenData()),
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
                var fofData = parseData.certified_copy_data;
                showPopup();
                if (fofData == null) {
                    var fofData = {};
                }
                if (fofData.status != VALUE_FIVE && fofData.status != VALUE_SIX) {
                    fofData.show_submit_btn = true;
                }
                $('#popup_container').html(certifiedCopySetAppointmentTemplate(fofData));
                datePickerAppointment();
                var appointmentDate = fofData.appointment_date != '0000-00-00' ? dateTo_DD_MM_YYYY(fofData.appointment_date) : '';
                $('#appointment_date_for_certified_copy').val(appointmentDate);
                $('#appointment_time_for_certified_copy').val(fofData.appointment_time);
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
        var formData = $('#set_appointment_certified_copy_form').serializeFormJSON();
        if (!formData.certified_copy_id_for_certified_copy_set_appointment) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.appointment_date_for_certified_copy) {
            $('#appointment_date_for_certified_copy').focus();
            validationMessageShow('form-nine-appointment_date_for_certified_copy', appointmentDateValidationMessage);
            return false;
        }
        if (!formData.appointment_time_for_certified_copy) {
            $('#appointment_time_for_certified_copy').focus();
            validationMessageShow('form-nine-appointment_time_for_certified_copy', timeValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_certified_copy_set_appointment');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'certified_copy/submit_set_appointment',
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
                var incomeCertificateData = parseData.certified_copy_data;
                $('#appointment_container_' + incomeCertificateData.certified_copy_id).html(that.getAppointmentData(incomeCertificateData));
                $('#appointment_by_name_' + incomeCertificateData.certified_copy_id).html('<hr>' + parseData.appointment_by_name);
            }
        });
    },
    askForApproveRejectApplication: function (btnObj, certifiedCopyId, moduleType) {
        if (!certifiedCopyId) {
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
            url: 'certified_copy/get_data_by_certified_copy_id',
            type: 'post',
            data: $.extend({}, {'certified_copy_id': certifiedCopyId}, getTokenData()),
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
                var certifiedCopyData = parseData.certified_copy_data;
                showPopup();
                if (moduleType == VALUE_ONE) {
                    $('#popup_container').html(certifiedCopyApproveTemplate(certifiedCopyData));
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(certifiedCopyRejectTemplate(certifiedCopyData));
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
        var formData = $('#approve_certified_copy_form').serializeFormJSON();
        if (!formData.certified_copy_id_for_certified_copy_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_certified_copy_approve) {
            $('#remarks_for_certified_copy_approve').focus();
            validationMessageShow('form-nine-approve-remarks_for_certified_copy_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_certified_copy_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'certified_copy/approve_application',
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
                CertifiedCopy.listview.loadCertifiedCopyData();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_certified_copy_form').serializeFormJSON();
        if (!formData.certified_copy_id_for_certified_copy_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_certified_copy_reject) {
            $('#remarks_for_certified_copy_reject').focus();
            validationMessageShow('form-nine-reject-remarks_for_certified_copy_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_certified_copy_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'certified_copy/reject_application',
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
                CertifiedCopy.listview.loadCertifiedCopyData();
            }
        });
    },
    getQueryData: function (certifiedCopyId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!certifiedCopyId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var templateData = {};
        templateData.module_type = VALUE_NINE;
        templateData.module_id = certifiedCopyId;
        var btnObj = $('#query_btn_for_app_' + certifiedCopyId);
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
                tmpData.module_type = VALUE_NINE;
                tmpData.module_id = certifiedCopyId;
                loadQueryManagementModule(parseData, templateData, tmpData);
            }
        });
    },
});
