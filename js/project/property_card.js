var propertyCardListTemplate = Handlebars.compile($('#property_card_list_template').html());
var propertyCardSearchTemplate = Handlebars.compile($('#property_card_search_template').html());
var propertyCardTableTemplate = Handlebars.compile($('#property_card_table_template').html());
var propertyCardActionTemplate = Handlebars.compile($('#property_card_action_template').html());
var propertyCardViewTemplate = Handlebars.compile($('#property_card_view_template').html());
var propertyCardApproveTemplate = Handlebars.compile($('#property_card_approve_template').html());
var propertyCardRejectTemplate = Handlebars.compile($('#property_card_reject_template').html());
var propertyCardCopyDetailsTemplate = Handlebars.compile($('#property_card_copy_details_template').html());
var propertyCardCopyDetailsItemTemplate = Handlebars.compile($('#property_card_copy_details_item_template').html());

var searchPCF = {};

var PropertyCard = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
PropertyCard.Router = Backbone.Router.extend({
    routes: {
        'property_card': 'renderList',
    },
    renderList: function () {
        PropertyCard.listview.listPage();
    },
});
PropertyCard.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function (sDistrict, sType, pgpcType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_EOCS_FS && tempTypeInSession != TEMP_TYPE_EOCS_HEAD
                && tempTypeInSession != TEMP_TYPE_EOCS_HS && tempTypeInSession != TEMP_TYPE_EOCS_JFS) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_eocs');
        addClass('property_card', 'active');
        PropertyCard.router.navigate('property_card');
        var templateData = {};
        searchPCF = {};
        this.$el.html(propertyCardListTemplate(templateData));
        this.loadPropertyCardData(sDistrict, sType, pgpcType);
    },
    actionRenderer: function (rowData) {
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_FS ||
                tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                (rowData.status == VALUE_TWO)) {
            rowData.show_reject_btn = '';
        } else {
            rowData.show_reject_btn = 'display: none;';
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                (rowData.plan_status == VALUE_FOUR && rowData.status == VALUE_FOUR)) {
            rowData.show_approve_btn = '';
        } else {
            rowData.show_approve_btn = 'display: none;';
        }
        if (rowData.status != VALUE_ZERO && rowData.status != VALUE_ONE) {
            rowData.show_pa_btn = true;
        }
        if (rowData.status == VALUE_TWO && rowData.is_verified != VALUE_ONE) {
            rowData.show_verify_btn = true;
        }
        if ((tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_FS ||
                tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_EOCS_HEAD) &&
                rowData.plan_status == VALUE_TWO && rowData.status == VALUE_FOUR) {
            rowData.show_check_btn = true;
        }
        rowData.VALUE_ONE = VALUE_ONE;
        rowData.VALUE_TWO = VALUE_TWO;
        rowData.module_type = VALUE_TWENTYFOUR;
        return propertyCardActionTemplate(rowData);
    },
    loadPropertyCardData: function (sDistrict, sType, pgpcType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;

        PropertyCard.router.navigate('property_card');
        var searchData = dtomFeesStatus(sDistrict, sType, 'PropertyCard.listview.loadPropertyCardData();', pgpcType);
        $('#property_card_form_and_datatable_container').html(propertyCardSearchTemplate(searchData));

        var distData = {};
        distData[VALUE_ONE] = talukaArray[VALUE_ONE] ? talukaArray[VALUE_ONE] : '';
        renderOptionsForTwoDimensionalArray(distData, 'district_for_property_card_list', false);

        renderOptionsForTwoDimensionalArray(fAppStatusTextArray, 'status_for_property_card_list', false);
        datePickerId('application_date_for_property_card_list');

        if (typeof searchPCF.district_for_property_card_list != "undefined" && searchPCF.district_for_property_card_list != '' && searchPCF.area_type_for_property_card_list && searchPCF.village_for_property_card_list != '') {
            if (searchPCF.area_type_for_property_card_list == VALUE_ONE) {
                var villageData = (searchPCF.district_for_property_card_list == VALUE_ONE ? damanCityArray : (searchPCF.district_for_property_card_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_property_card_list', false);
            } else if (searchPCF.area_type_for_property_card_list == VALUE_TWO) {
                var villageData = (searchPCF.district_for_property_card_list == VALUE_ONE ? tempUVillageData : (searchPCF.district_for_property_card_list == VALUE_TWO ? diuVillagesArray : (distData == VALUE_THREE ? dnhVillagesArray : [])));
                renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_property_card_list', 'village', 'village_name', false, false);
            }
        }

        $('#app_no_for_property_card_list').val((typeof searchPCF.app_no_for_property_card_list != "undefined" && searchPCF.app_no_for_property_card_list != '') ? searchPCF.app_no_for_property_card_list : '');
        $('#application_date_for_property_card_list').val((typeof searchPCF.application_date_for_property_card_list != "undefined" && searchPCF.application_date_for_property_card_list != '') ? searchPCF.application_date_for_property_card_list : searchData.s_appd);
        $('#app_details_for_property_card_list').val((typeof searchPCF.app_details_for_property_card_list != "undefined" && searchPCF.app_details_for_property_card_list != '') ? searchPCF.app_details_for_property_card_list : '');
        $('#status_for_property_card_list').val((typeof searchPCF.status_for_property_card_list != "undefined" && searchPCF.status_for_property_card_list != '') ? searchPCF.status_for_property_card_list : searchData.s_status);
        $('#district_for_property_card_list').val((typeof searchPCF.district_for_property_card_list != "undefined" && searchPCF.district_for_property_card_list != '') ? searchPCF.district_for_property_card_list : searchData.search_district);
        $('#area_type_for_property_card_list').val((typeof searchPCF.area_type_for_property_card_list != "undefined" && searchPCF.area_type_for_property_card_list != '') ? searchPCF.area_type_for_property_card_list : '');
        $('#vdw_for_property_card_list').val((typeof searchPCF.vdw_for_property_card_list != "undefined" && searchPCF.vdw_for_property_card_list != '') ? searchPCF.vdw_for_property_card_list : '');
        $('#is_full_for_property_card_list').val((typeof searchPCF.is_full_for_property_card_list != "undefined" && searchPCF.is_full_for_property_card_list != '') ? searchPCF.is_full_for_property_card_list : searchData.s_is_full);
        $('#is_plan_status_for_property_card_list').val((typeof searchSUF.is_plan_status_for_property_card_list != "undefined" && searchSUF.is_plan_status_for_property_card_list != '') ? searchSUF.is_plan_status_for_property_card_list : searchData.s_plan_status);

        this.searchPropertyCardData();
    },
    searchPropertyCardData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#property_card_datatable_container').html(propertyCardTableTemplate);
        var searchData = $('#search_property_card_form').serializeFormJSON();

        searchPCF = searchData;

        if (typeof btnObj == "undefined" && (searchPCF.app_details_for_property_card_list == ''
                && searchPCF.app_no_for_property_card_list == ''
                && searchPCF.application_date_for_property_card_list == ''
                && searchPCF.status_for_property_card_list == ''
                && searchPCF.is_full_for_property_card_list == ''
                && searchPCF.is_plan_statu_for_property_card_list == ''
                && (searchPCF.district_for_property_card_list == '' || typeof searchPCF.district_for_property_card_list == "undefined")
                && (searchPCF.area_type_for_property_card_list == '' || typeof searchPCF.area_type_for_property_card_list == "undefined")
                && (searchPCF.vdw_for_property_card_list == '' || typeof searchPCF.vdw_for_property_card_list == "undefined"))) {
            propertyCardDataTable = $('#property_card_datatable').DataTable({
                bAutoWidth: false,
                ordering: false,
                pageLength: 25,
                language: dataTableProcessingAndNoDataMsg,
            });
            $('#property_card_datatable_filter').remove();
            return false;
        }
        var that = this;
        var appDetailsRenderer = function (data, type, full, meta) {
            return  '<b><i class="fas fa-user f-s-10px"></i> :- ' + full.applicant_name + ' ' + full.father_name + ' ' + full.surname
                    + '</b><br><i class="fas fa-street-view f-s-10px"></i> :- '
                    + full.address + '<br><b><i class="fas fa-phone-volume f-s-10px"></i> :- ' + full.mobile_number + '</b>';
        };
        var distVillRenderer = function (data, type, full, meta) {
            var villageData = full.district == TALUKA_DAMAN ? (full.ld_area_type == VALUE_ONE ? damanCityArray : (full.ld_area_type == VALUE_TWO ? tempUVillageData : [])) : [];
            var villageName = '';
            if (full.ld_area_type == VALUE_ONE) {
                villageName = villageData[full.ld_village_sc] ? villageData[full.ld_village_sc] : '';
            } else if (full.ld_area_type == VALUE_TWO) {
                villageName = villageData[full.ld_village_sc] ? villageData[full.ld_village_sc]['village_name'] : '';
            }
            return (talukaArray[data] ? talukaArray[data] : '') + ((data != 0 && full.ld_area_type != 0) ? (areaTypeArray[full.ld_area_type] ? ('<br><b>(' + areaTypeArray[full.ld_area_type] + ')</b>') : '') : '') +
                    ((data != 0 && full.village != '') ? '<hr>' : '') + villageName;
        };
        var basicDetailsRenderer = function (data, type, full, meta) {
            return that.getSSCADetails(full);
        };
        $('#property_card_datatable_container').html(propertyCardTableTemplate);
        propertyCardDataTable = $('#property_card_datatable').DataTable({
            ajax: {url: 'property_card/get_property_card_data', dataSrc: "property_card_data", type: "post", data: searchData},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'application_number', 'class': 'text-center f-w-b', 'render': appNumberRenderer},
                {data: '', 'class': 'f-s-app-details', 'render': appDetailsRenderer},
                {data: 'district', 'class': 'text-center f-s-app-details', 'render': distVillRenderer},
                {data: '', 'class': 'text-center', 'render': basicDetailsRenderer},
                {data: 'property_card_id', 'class': 'text-center', 'render': formsAppStatusRenderer},
                {data: '', 'class': 'f-s-12px', 'render': appRejDetailsRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#property_card_datatable_filter').remove();
        $('#property_card_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = propertyCardDataTable.row(tr);

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
        var tempData = '<table class="table table-bordered mb-0 bg-beige f-s-12px" id="ssca_details_container_for_pclist_' + full.property_card_id + '">';
        var landDetails = full.land_details != '' ? JSON.parse(full.land_details) : [];
        if (landDetails.length == VALUE_ZERO) {
            return '';
        }
        var colspan = '2';
        $.each(landDetails, function (index, ld) {
            var eLD = '';
            var fdbBtn = '';
            if (ld.property_status) {
                var psFormData = psFormArray[ld.property_status] ? psFormArray[ld.property_status] : [];
                eLD = '<td class="text-center">' + (propertyStatusTextArray[ld.property_status] ? propertyStatusTextArray[ld.property_status] : '') + '</td>'
                        + '<td class="text-center">' + (ld.apply_with ? getCheckboxValue(ld.apply_with, psFormData) : '') + '</td>';
                colspan = '4';
                var aw = ld.apply_with != '' ? ld['apply_with'].split(',') : [];
                if (aw.length != VALUE_ZERO) {
                    if ($.inArray('1', aw) != -1 && ld['total_fd_copy_generated'] != ld['copies'] && full.status == VALUE_FOUR) {
                        fdbBtn += '<td class="text-center"><button class="btn btn-xs btn-nic-blue" title="Generate Form D" '
                                + 'onclick="PropertyCard.listview.requestForGenerateFormDB($(this),\'' + ld.form_land_details_id + '\',\'' + VALUE_ONE + '\')">FD</button></td>';
                    }
                    if ($.inArray('2', aw) != -1 && ld['total_fb_copy_generated'] != ld['copies'] && full.status == VALUE_FOUR) {
                        fdbBtn += '<td class="text-center"><button class="btn btn-xs btn-nic-blue" title="Generate Form B" '
                                + 'onclick="PropertyCard.listview.requestForGenerateFormDB($(this),\'' + ld.form_land_details_id + '\',\'' + VALUE_TWO + '\')">FB</button></td>';
                    }
                }
            }
            tempData += '<tr><td class="text-center">' + ld.survey + '</td><td class="text-center">' + ld.subdiv + '</td>'
                    + eLD
                    + '<td class="text-right">' + ld.copies + '</td><td class="text-right">' + ld.amount + '</td>'
                    + ((typeof ld.total_fd_copy_generated != "undefined" || typeof ld.total_fb_copy_generated != "undefined") ? ((ld.total_fd_copy_generated == ld.copies || ld.total_fb_copy_generated == ld.copies) ? '<td class="text-center"><button class="btn btn-xs btn-info" title="View Copy Details" '
                            + 'onclick="PropertyCard.listview.requestForViewCopy($(this),\'' + ld.form_land_details_id + '\')"><i class="fas fa-eye"></i></button></td>' : '') : '')
                    + fdbBtn
                    + '</tr>';
        });
        tempData += '<tr><td class="text-right text-success f-w-b" colspan="' + colspan + '">Rupees To Be Paid : </td><td class="text-right f-w-b">Copies : '
                + full.total_copies + '</td><td class="text-right f-w-b">Rs. : ' + full.total_amount + '</td></tr></table>';
        return tempData;
    },
    requestForPropertyCard: function (btnObj, propertyCardId, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!propertyCardId || (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FIVE)) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var that = this;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'property_card/get_property_card_data_by_id', type: 'post',
            data: $.extend({}, {'property_card_id': propertyCardId, 'module_type': moduleType}, getTokenData()),
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
                that.viewPropertyCard(moduleType, parseData);
            }
        });
    },
    setBasicDetailsforView: function (propertyCardData) {
        propertyCardData.district_text = talukaArray[propertyCardData.district] ? talukaArray[propertyCardData.district] : '';
        propertyCardData.ld_area_type_text = areaTypeArray[propertyCardData.ld_area_type] ? areaTypeArray[propertyCardData.ld_area_type] : '';
        var villageData = propertyCardData.district == TALUKA_DAMAN ? (propertyCardData.ld_area_type == VALUE_ONE ? damanCityArray : (propertyCardData.ld_area_type == VALUE_TWO ? tempUVillageData : [])) : [];
        if (propertyCardData.ld_area_type == VALUE_ONE) {
            propertyCardData.village_text = villageData[propertyCardData.ld_village_sc] ? villageData[propertyCardData.ld_village_sc] : '';
            propertyCardData.vsc_title = 'Sub City';
            propertyCardData.spg_title = 'P.T. Sheet Number';
            propertyCardData.scp_title = 'Chalta Number';
        } else if (propertyCardData.ld_area_type == VALUE_TWO) {
            propertyCardData.vsc_title = 'Village';
            propertyCardData.spg_title = 'Gauthan Wise Number';
            propertyCardData.scp_title = 'Plot Number';
            propertyCardData.village_text = villageData[propertyCardData.ld_village_sc] ? villageData[propertyCardData.ld_village_sc]['village_name'] : '';
        }
        return propertyCardData;
    },
    viewPropertyCard: function (moduleType, parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
                moduleType != VALUE_FIVE) {
            showError(invalidAccessValidationMessage);
            return;
        }
        var propertyCardData = parseData.property_card_data;
        propertyCardData.title = 'View';
        propertyCardData.VALUE_THREE = VALUE_THREE;
        propertyCardData = this.setBasicDetailsforView(propertyCardData);
//        propertyCardData.show_applicant_photo = propertyCardData.applicant_photo != '' ? true : false;
//        propertyCardData.show_nakal = propertyCardData.nakal != '' ? true : false;
        propertyCardData.show_id_proof = propertyCardData.id_proof != '' ? true : false;
        if (moduleType == VALUE_TWO) {
            propertyCardData.show_print_btn = true;
        }
        if (moduleType == VALUE_THREE && propertyCardData.is_verified != VALUE_ONE) {
            propertyCardData.show_enter_remarks = true;
            propertyCardData.show_verification_btn = true;
        }
        if (propertyCardData.is_verified == VALUE_ONE && propertyCardData.verified_details != '') {
            var verifiedDetails = JSON.parse(propertyCardData.verified_details);
            propertyCardData.show_verification_details = true;
            verifiedDetails.verified_datetime_text = verifiedDetails.verified_datetime ? dateTo_DD_MM_YYYY_HH_II_SS(verifiedDetails.verified_datetime) : '';
            propertyCardData.n_verified_details = verifiedDetails;
        }
        if (moduleType == VALUE_FIVE && propertyCardData.is_checked != VALUE_ONE && propertyCardData.plan_status == VALUE_TWO) {
            propertyCardData.show_enter_remarks = true;
            propertyCardData.show_check_btn = true;
        }
        if (propertyCardData.is_checked == VALUE_ONE && propertyCardData.checked_details != '') {
            var checkedDetails = JSON.parse(propertyCardData.checked_details);
            propertyCardData.show_checked_details = true;
            checkedDetails.checked_datetime_text = checkedDetails.checked_datetime ? dateTo_DD_MM_YYYY_HH_II_SS(checkedDetails.checked_datetime) : '';
            propertyCardData.n_checked_details = checkedDetails;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        propertyCardData.PROPERTY_CARD_DOC_PATH = PROPERTY_CARD_DOC_PATH;
        $('#popup_container').html(propertyCardViewTemplate(propertyCardData));
        var ldCnt = 1;
        var totalCopies = 0;
        var totalAmount = 0;
        $.each(parseData.form_land_details, function (index, fld) {
            var psFormData = psFormArray[fld.property_status] ? psFormArray[fld.property_status] : [];
            var ldRow = '<tr><td class="text-center">' + ldCnt + '</td><td class="text-center">' + fld.survey + '</td>' + '<td class="text-center">' + fld.subdiv + '</td>'
                    + '<td class="text-center">' + (propertyStatusTextArray[fld.property_status] ? propertyStatusTextArray[fld.property_status] : '') + '</td>'
                    + '<td class="text-center">' + (fld.apply_with ? getCheckboxValue(fld.apply_with, psFormData) : '') + '</td>'
                    + '<td class="text-center">' + fld.total_area + '</td><td class="text-right">' + fld.copies + '</td><td class="text-right">' + fld.amount + '</td></tr>';
            $('#fld_container_for_pcview').append(ldRow);
            totalCopies += parseInt(fld.copies) ? parseInt(fld.copies) : VALUE_ZERO;
            totalAmount += parseInt(fld.amount) ? parseInt(fld.amount) : VALUE_ZERO;
            ldCnt++;
        });
        $('#total_copies_for_pcview').html(totalCopies);
        $('#total_amount_for_pcview').html(totalAmount);
        if (moduleType == VALUE_TWO) {
            setTimeout(function () {
                $('#pa_btn_for_pcview').click();
            }, 500);
        }
    },
    askForApproveRejectApplication: function (btnObj, propertyCardId, moduleType) {
        if (!propertyCardId) {
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
            url: 'property_card/get_data_by_property_card_id',
            type: 'post',
            data: $.extend({}, {'property_card_id': propertyCardId, 'module_type': moduleType}, getTokenData()),
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
                var propertyCardData = parseData.property_card_data;
                showPopup();
                if (moduleType == VALUE_ONE) {
                    $('#popup_container').html(propertyCardApproveTemplate(propertyCardData));
                    return false;
                }
                if (moduleType == VALUE_TWO) {
                    $('#popup_container').html(propertyCardRejectTemplate(propertyCardData));
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
        var formData = $('#approve_property_card_form').serializeFormJSON();
        if (!formData.property_card_id_for_property_card_approve) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_property_card_approve) {
            $('#remarks_for_property_card_approve').focus();
            validationMessageShow('property-card-approve-remarks_for_property_card_approve', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_property_card_approve');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'property_card/approve_application',
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
                validationMessageShow('property-card-approve', textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                if (parseData.success === false) {
                    btnObj.html(ogBtnHTML);
                    btnObj.attr('onclick', ogBtnOnclick);
                    validationMessageShow('property-card-approve', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                PropertyCard.listview.loadPropertyCardData();
            }
        });
    },
    rejectApplication: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        validationMessageHide();
        var formData = $('#reject_property_card_form').serializeFormJSON();
        if (!formData.property_card_id_for_property_card_reject) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        if (!formData.remarks_for_property_card_reject) {
            $('#remarks_for_property_card_reject').focus();
            validationMessageShow('property-card-reject-remarks_for_property_card_reject', remarksValidationMessage);
            return false;
        }
        var btnObj = $('#submit_btn_for_property_card_reject');
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'property_card/reject_application',
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
                validationMessageShow('property-card-reject', textStatus.statusText);
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
                    validationMessageShow('property-card-reject', parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                showSuccess(parseData.message);
                PropertyCard.listview.loadPropertyCardData();
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
            url: 'property_card/request_for_view_copy',
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
    basicPSData: function (psData) {
        if (psData.property_status) {
            var psFormData = psFormArray[psData.property_status] ? psFormArray[psData.property_status] : [];
            psData.property_status_text = (propertyStatusTextArray[psData.property_status] ? propertyStatusTextArray[psData.property_status] : '');
            psData.apply_with_text = (psData.apply_with ? getCheckboxValue(psData.apply_with, psFormData) : '');
        }
        return psData;
    },
    viewCopyDetails: function (parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        showPopup();
        $('.swal2-popup').css('width', '45em');
        var pcldData = this.setBasicDetailsforView(parseData.pcld_data);
        pcldData = this.basicPSData(pcldData);
        if (pcldData.status == VALUE_FOUR && (pcldData.plan_status == VALUE_ONE || pcldData.plan_status == VALUE_TWO)) {
            if (pcldData.copies == pcldData.total_fd_copy_generated) {
                pcldData.show_regenerate_fd_details = true;
                pcldData.show_regenerate_fdb_details = true;
            }
            if (pcldData.copies == pcldData.total_fb_copy_generated) {
                pcldData.show_regenerate_fb_details = true;
                pcldData.show_regenerate_fdb_details = true;
            }
        }
        $('#popup_container').html(propertyCardCopyDetailsTemplate(pcldData));
        $.each(parseData.copy_details, function (index, cd) {
            cd.temp_cnt = (index + 1);
            cd.barcode_number = VALUE_TWENTYFOUR + ('0000000' + cd.form_copy_id).slice(-7);
            cd.generated_datetime_text = cd.created_time != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(cd.created_time) : '';
            cd.form_type_text = formTypeArray[cd.form_type] ? formTypeArray[cd.form_type] : '';
            $('#cd_container_for_pccd').append(propertyCardCopyDetailsItemTemplate(cd));
        });
    },
    updateApplicationStatus: function (btnObj, moduleType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (moduleType != VALUE_ONE && moduleType != VALUE_THREE) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var pcId = $('#property_card_id_for_pcview').val();
        if (!pcId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var remarks = $('#remarks_for_pcview').val();
        if (!remarks) {
            $('#remarks_for_pcview').focus();
            validationMessageShow('pcview-remarks_for_pcview', remarksValidationMessage);
            return false;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'property_card/update_status_for_pc',
            type: 'post',
            data: $.extend({}, {'pc_id': pcId, 'remarks': remarks, 'module_type': moduleType}, getTokenData()),
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
                return false;
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
                showSuccess(parseData.message);
                PropertyCard.listview.listPage();
            }
        });
    },
    requestForGenerateFormDB: function (btnObj, formLandDetailsId, formType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId || (formType != VALUE_ONE && formType != VALUE_TWO)) {
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
            url: 'property_card/request_for_generate_form_db',
            type: 'post',
            data: $.extend({}, {'form_land_details_id': formLandDetailsId, 'form_type': formType}, getTokenData()),
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
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    btnObj.html(ogBtnHTML);
                    btnObj.attr('onclick', ogBtnOnclick);
                    showError(parseData.message);
                    return false;
                }
                var espData = parseData.property_card_data;
                if (espData.plan_status == VALUE_TWO) {
                    PropertyCard.listview.listPage();
                } else {
                    $('#ssca_details_container_for_pclist_' + espData.property_card_id).parent().html(that.getSSCADetails(espData));
                }
                showSuccess(parseData.message);
            }
        });
    },
    requestForReGenerateFormDB: function (btnObj, formLandDetailsId, formType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!formLandDetailsId || (formType != VALUE_ONE && formType != VALUE_TWO)) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        openFullPageOverlay();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'property_card/request_for_regenerate_form_db',
            type: 'post',
            data: $.extend({}, {'form_land_details_id': formLandDetailsId, 'form_type': formType}, getTokenData()),
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
                if (!isJSON(response)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    btnObj.html(ogBtnHTML);
                    btnObj.attr('onclick', ogBtnOnclick);
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
});
