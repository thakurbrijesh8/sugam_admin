var arrearsUpdateListTemplate = Handlebars.compile($('#arrears_update_list_template').html());
var arrearsUpdateFormTemplate = Handlebars.compile($('#arrears_update_form_template').html());
var arrearsUpdateMergeTemplate = Handlebars.compile($('#arrears_update_merge_template').html());
var assignKhataNumberV2ListTemplate = Handlebars.compile($('#assign_khata_number_v2_list_template').html());
var assignKhataNumberV2TableTemplate = Handlebars.compile($('#assign_khata_number_v2_table_template').html());

var ArrearsUpdate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
ArrearsUpdate.Router = Backbone.Router.extend({
    routes: {
        'assign_khata_number': 'renderList',
        'assign_khata_number_v2': 'renderListForAssignKhataNumberV2',
    },
    renderList: function () {
        ArrearsUpdate.listview.listPage();
    },
    renderListForAssignKhataNumberV2: function () {
        ArrearsUpdate.listview.listPageForAssignKhataNumberV2();
    }
});
ArrearsUpdate.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
        'click input[name="select_all_individual"]': 'checkboxSelectOptionIndividual',
    },
    checkboxSelectOptionIndividual: function () {
        if ($("input[name='select_all_individual']:checked").val()) {
            $(".checkbox_individual").prop('checked', true);
        } else {
            $(".checkbox_individual").prop('checked', false);
        }
        $(".checkbox_individual").change(function () {
            if (!$(this).prop("checked")) {
                $("#select_all_individual").prop("checked", false);
            }
            if ($('.checkbox_individual:checked').length == $('.checkbox_individual').length) {
                $("#select_all_individual").prop('checked', true);
            }
        });
    },
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('assign_khata_number', 'active');
        ArrearsUpdate.router.navigate('assign_khata_number');
        var templateData = {};
        this.$el.html(arrearsUpdateListTemplate(templateData));
        this.newArrearsUpdateForm();
    },
    newArrearsUpdateForm: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        var templateData = {};
        templateData.VALUE_ONE = VALUE_ONE;
        templateData.VALUE_TWO = VALUE_TWO;
        templateData.VALUE_THREE = VALUE_THREE;
        $('#arrears_update_form_and_datatable_container').html(arrearsUpdateFormTemplate(templateData));
        var dArray = {};
        if (tempTypeInSession == TEMP_TYPE_A || tempDistrictInSession == TALUKA_DAMAN) {
            dArray[TALUKA_DAMAN] = talukaArray[TALUKA_DAMAN];
        }
        if (tempTypeInSession == TEMP_TYPE_A || tempDistrictInSession == TALUKA_DIU) {
            dArray[TALUKA_DIU] = talukaArray[TALUKA_DIU];
        }
        renderOptionsForTwoDimensionalArray(dArray, 'district_for_arrears_update', false);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'village_for_arrears_update', 'village', 'village_name', 'devnagari');
        if (tempTypeInSession == TEMP_TYPE_A) {
            $('#district_for_arrears_update').val(TALUKA_DAMAN).trigger('change');
        } else {
            if (tempDistrictInSession == TALUKA_DAMAN || tempDistrictInSession == TALUKA_DIU) {
                $('#district_for_arrears_update').val(tempDistrictInSession).trigger('change');
            }
        }
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForLand([], 'survey_number_for_arrears_update', '', '', '');
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'subdivision_number_for_arrears_update', '', '', '');
        $('#occupant_detail_info_container').append('<tr><td class="text-center">No Data Available !</td></tr>');
        generateSelect2();
    },
    getOccupantDetails: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        var village = $('#village_for_arrears_update').val();
        var district = $('#district_for_arrears_update').val();
        var survey = $('#survey_number_for_arrears_update').val();
        var subdiv = $('#subdivision_number_for_arrears_update').val();
        $('#ij_land_count').text(0);
        if (!village || !survey || !subdiv) {
            return;
        }
        $('#occupant_detail_info_container').html(noRecordFoundTemplate({'colspan': 3, 'message': spinnerTemplate({'type': 'primary', 'extra_class': 'spinner-border-small'})}));
        $.ajax({
            url: 'utility/get_occupant_details_by_village',
            type: 'post',
            data: $.extend({}, {'village_for_arrears_update': village, 'district_for_arrears_update': district, 'survey_number_for_arrears_update': survey, 'subdivision_number_for_arrears_update': subdiv}, getTokenData()),
            error: function (textStatus, errorThrown) {
                $('#occupant_detail_info_container').html(noRecordFoundTemplate({'colspan': 3, 'message': noRecordFoundTemplate}));
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
                var parseData = JSON.parse(response);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    $('#occupant_detail_info_container').html(noRecordFoundTemplate({'colspan': 3, 'message': noRecordFoundTemplate}));
                    showError(parseData.message);
                    return false;
                }
                $("#select_all_individual").prop("checked", false);
                $("#occupant_detail_info_container").empty();
                $("#ij_land_ownership").empty();
                $("#ij_land_ownership_footer").empty();
                var occupantDataText = parseData.occupant_data;
                var detailCnt = 1;
                $.each(occupantDataText, function (index, ocd) {
                    var ocName = "";
                    var ret = ocd.occupant_name.split(" ");
                    $.each(ret, function (index, ocsplitname) {
                        if (ocsplitname != '') {
                            ocName += ('&nbsp;&nbsp;<button type="button" class="btn btn-xs btn-primary" id="split_occupant_name_for_arrears_update_' + detailCnt + '" '
                                    + 'onclick="ArrearsUpdate.listview.getAllLandDetails($(this),\'' + ocsplitname + '\');">'
                                    + ocsplitname + '</button>');
                        }
                    });
                    var ocRow = '<tr><td class="text-center">' + detailCnt + '</td><td id="occupant_name_for_arrears_update_' + detailCnt + '">' + ocd.occupant_name + '</td>' +
                            '<td>' + ocName + '</td>' +
                            '<td><button type="button" class="btn btn-xs btn-nic-blue float-right" onclick="ArrearsUpdate.listview.getAllLandDetails($(this),\'' + ocd.occupant_name + '\');">Show All Lands</button></td></tr>';
                    $('#occupant_detail_info_container').append(ocRow);
                    detailCnt++;
                });
                if (detailCnt == 1) {
                    $('#occupant_detail_info_container').html(noRecordFoundTemplate({'colspan': 3, 'message': noRecordFoundTemplate}));
                }
            }
        });
    },
    getAllLandDetails: function (btnObj, occupantName) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.listview.listPage();
            return false;
        }
        var village = $('#village_for_arrears_update').val();
        var district = $('#district_for_arrears_update').val();
        if (!village || !occupantName) {
            return;
        }
        var tCnt = 1;
        $('#ij_land_count').text(0);
        $('#ij_land_ownership').html(noRecordFoundTemplate({'colspan': 13, 'message': spinnerTemplate({'type': 'primary', 'extra_class': 'spinner-border-small'})}));
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'utility/get_land_details_by_occupants',
            type: 'post',
            data: $.extend({}, {'village_for_arrears_update': village, 'district_for_arrears_update': district, 'occupant_name_for_arrears_update': occupantName}, getTokenData()),
            error: function (textStatus, errorThrown) {
                $('#ij_land_ownership').html(noRecordFoundTemplate({'colspan': 13, 'message': noRecordFoundTemplate}));
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
                var parseData = JSON.parse(response);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    $('#ij_land_ownership').html(noRecordFoundTemplate({'colspan': 13, 'message': noRecordFoundTemplate}));
                    showError(parseData.message);
                    return false;
                }
                $("#select_all_individual").prop("checked", false);
                $("#ij_land_ownership").empty();
                $("#ij_land_ownership_footer").empty();
                $(".land_details").show();
                var landData = parseData.land_data;
                if (!landData || landData.length == 0) {
                    $('#ij_land_ownership').html(noRecordFoundTemplate({'colspan': 13, 'message': noRecordFoundTemplate}));
                    return false;
                }
                var totalArea = 0;
                var totalArrears = 0;
                var totalCurrentTax = 0;
                var totalPaidTax = 0;
                var totalPendingTax = 0;
                var arrears = 0;
                var currentYearDueTax = 0;
                var paidTax = '';
                var pendingTax = 0;
                $.each(landData, function (i, landDataItem) {
                    arrears = '';
                    currentYearDueTax = '';
                    paidTax = '';
                    pendingTax = '';
                    showUpdateBtn = 'display: none;';
                    allLandArrearsCls = 'display: none;';
                    var isNA = false;
                    if (landDataItem.nature == 'N.A' || (landDataItem.nature && landDataItem.nature.indexOf('N.A') > -1)) {
                        arrears = landDataItem.arrears ? parseInt(landDataItem.arrears) : 0;
                        currentYearDueTax = getCurrentYearDue(landDataItem);
                        paidTax = landDataItem.total_land_tax_payment ? parseInt(landDataItem.total_land_tax_payment) : 0;
                        pendingTax = (parseInt(currentYearDueTax) + parseInt(arrears)) - parseInt(paidTax);
                        showUpdateBtn = '';
                        allLandArrearsCls = '';

                        totalArrears += arrears;
                        totalCurrentTax += currentYearDueTax;
                        totalPaidTax += paidTax;
                        totalPendingTax += pendingTax;
                        isNA = true;
                    }
                    totalArea += landDataItem.area == '' ? 0 : parseFloat(landDataItem.area);
                    if (landDataItem.owner_type == VALUE_TWO) {
                        var occName = '<span style="font-weight: bold;">(' + landDataItem.occupant_name + ')</span><br/>' + landDataItem.joint_occupants;
                    } else {
                        var occName = landDataItem.occupant_name;
                    }
                    var ldRow = '<tr><td class="text-center v-a-m"><input type="checkbox" class="checkbox_individual cursor-pointer"></td>'
                            + '<td class="text-center">' + tCnt + '</td>'
                            + '<td class="f-s-12px">' + occName + '</td>'
                            + '<td class="text-center">' + (landDataItem.mutation_number == null ? '-' : landDataItem.mutation_number) + '</td>'
                            + '<td class="text-center" style="font-weight: bold;">' + landOwnerTypeArray[landDataItem.owner_type] + '</td>'
                            + '<td class="text-center" id="nature_for_individual_update_arrears_' + tCnt + '">' + landDataItem.nature + '</td>'
                            + '<td class="text-center" id="survey_number_for_individual_update_arrears_' + tCnt + '">' + landDataItem.survey + '</td>'
                            + '<td class="text-center" id="subdiv_number_for_individual_update_arrears_' + tCnt + '">' + landDataItem.subdiv + '</td>'
                            + '<td class="text-right">' + landDataItem.area + '</td>'
                            + '<td class="t-a-r" id="current_year_due_for_individual_update_arrears_' + tCnt + '">' + (isNA ? (currentYearDueTax + '/-') : '') + '</td>'
                            + '<td class="text-right">' + (isNA ? (tempTypeInSession == TEMP_TYPE_A || paidTax == 0 ? '<input type="text" class="t-a-r form-control" style="width: 60%;margin: 5px; 5px;" '
                                    + 'id="all_land_arrears_for_individual_update_arrears_' + tCnt + '" value="' + arrears + '">'
                                    + '<button id="arrears_update_btn_' + tCnt + '" type="button" class="btn btn-xs btn-success float-right" '
                                    + 'style="margin-top: -40px;" onclick="ArrearsUpdate.listview.updateLandArrears($(this),' + tCnt + ',\'for_individual_update_arrears\');">Update</button></td>' : arrears + '/-') : '')
                            + '<td class="t-a-r" id="total_paid_amount_for_individual_update_arrears_' + tCnt + '">' + (isNA ? (paidTax + '/-') : '') + '</td>'
                            + '<td class="t-a-r" id="total_pending_amount_for_individual_update_arrears_' + tCnt + '">' + (isNA ? (pendingTax + '/-') : '') + '</td>'
                            + '<td style="display:none;">' + landDataItem.occupant_id + '</td></tr>';
                    $('#ij_land_ownership').append(ldRow);
                    allowOnlyIntegerValue('all_land_arrears_for_individual_update_arrears_' + tCnt);
                    tCnt++;
                });
                $('#ij_land_count').text(tCnt - 1);
                var ldRowFooter = '<tr><td class="t-a-r v-a-m f-w-b" colspan="8">Total : </td><td class="t-a-r v-a-m f-w-b">' + totalArea + '/-' + '</td><td class="t-a-r v-a-m f-w-b">' + totalCurrentTax + '/-' + '</td><td class="t-a-r v-a-m f-w-b" id="grand_total_arreas_for_land">' + totalArrears + '/-' + '</td><td class="t-a-r v-a-m f-w-b">' + totalPaidTax + '/-' + '</td><td class="t-a-r v-a-m f-w-b" id="grand_total_pending_amount_for_land">' + totalPendingTax + '/-' + '</td></tr>';
                $('#ij_land_ownership_footer').append(ldRowFooter);
            }
        });
    },
    updateLandArrears: function (btnObj, ids, moduleIds) {
        var district = $('#district_for_arrears_update').val();
        var village = $('#village_for_arrears_update').val();
        var survey = $('#survey_number_' + moduleIds + '_' + ids).text();
        var subdiv = $('#subdiv_number_' + moduleIds + '_' + ids).text();
        var arrears = $('#all_land_arrears_' + moduleIds + '_' + ids).val();
        var currentYearDueTax = $('#current_year_due_' + moduleIds + '_' + ids).text();
        var grandTotalArreas = $('#grand_total_arreas_for_land').text();
        var grandTotalPendingAmount = $('#grand_total_pending_amount_for_land').text();
        if (!village || !survey || !subdiv || !arrears) {
            return;
        }
        var formData = {};
        formData.module_type = VALUE_ONE;
        formData.district_for_land_arrears_update = district;
        formData.village_for_land_arrears_update = village;
        formData.survey_number_for_land_arrears_update = survey;
        formData.subdivision_number_for_land_arrears_update = subdiv;
        formData.all_land_arrears_for_land_arrears_update = arrears;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'utility/update_land_arrears',
            type: 'post',
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
                showError(textStatus.statusText);
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
                    return false;
                }
                showSuccess(parseData.message);
                var totalPaidTax = parseData.total_land_tax_payment ? parseInt(parseData.total_land_tax_payment) : 0;
                var totalPendingTax = (parseInt(currentYearDueTax) + parseInt(arrears)) - parseInt(totalPaidTax);

                var finalGrandTotalOfArrears = parseInt(grandTotalArreas) + parseInt(arrears);
                var finalGrandTotalPendingAmount = parseInt(grandTotalPendingAmount) + parseInt(arrears);

                $('#total_paid_amount_' + moduleIds + '_' + ids).text(totalPaidTax + '/-');
                $('#total_pending_amount_' + moduleIds + '_' + ids).text(totalPendingTax + '/-');

                $('#grand_total_arreas_for_land').text(finalGrandTotalOfArrears + '/-');
                $('#grand_total_pending_amount_for_land').text(finalGrandTotalPendingAmount + '/-');
            }
        });
    },
    mergeLandForKhataNumber: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var village = $('#village_for_arrears_update').val();
        var district = $('#district_for_arrears_update').val();
        if (!village || !district) {
            return;
        }
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'utility/get_khata_number_by_village',
            type: 'post',
            data: $.extend({}, {'village_for_arrears_update': village, 'district_for_arrears_update': district}, getTokenData()),
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
                var parseData = JSON.parse(response);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                setNewToken(parseData.temp_token);
                if (parseData.success === false) {
                    btnObj.html(ogBtnHTML);
                    btnObj.attr('onclick', ogBtnOnclick);
                    showError(parseData.message);
                    return false;
                }
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var khataNumber = parseData.khata_number_data;
                showPopup();
                $('.swal2-popup').css('width', '70em');
                $('#popup_container').html(arrearsUpdateMergeTemplate);

                var detailCnt = 1;
                var newKhataNumber = 0;
                $("#ij_land_ownership input[type=checkbox]:checked").each(function () {
                    var row = $(this).closest("tr")[0];
                    if (detailCnt == 1) {
                        newKhataNumber = khataNumber.khata_number != 0 ? (parseInt(khataNumber.khata_number) + parseInt(1)) : 1;
                    }
                    var eduRow = '<tr><td class="text-center">' + detailCnt + '</td>'
                            + '<td class="f-s-12px">' + row.cells[2].innerHTML + '</td>'
                            + '<td class="text-center">' + row.cells[3].innerHTML + '</td>'
                            + '<td class="text-center">' + row.cells[4].innerHTML + '</td>'
                            + '<td class="text-center">' + row.cells[5].innerHTML + '</td>'
                            + '<td class="text-center">' + row.cells[6].innerHTML + '</td>'
                            + '<td class="text-center">' + row.cells[7].innerHTML + '</td>'
                            + '<td class="text-right">' + row.cells[8].innerHTML + '</td>'
                            + '<td class="text-center">' + row.cells[13].innerHTML + '</td>'
                            + '<td class="text-center"><input type="text" class="form-control khata_number_for_aukn" id="khata_number_' + detailCnt + '" onkeyup="ArrearsUpdate.listview.setKhataNumber(' + detailCnt + ')" maxlength="12" value="' + newKhataNumber + '" placeholder = "Enter Khata Number"></td>'
                            + '<td class="text-center"><input type="text" class="form-control aadhar_card_for_aukn" id="aadhar_card_number_' + detailCnt + '" onblur="aadharNumberValidation(\'aukn\',\'aadhar_card_number_' + detailCnt + '\');" onkeyup="ArrearsUpdate.listview.setAadharNumber(' + detailCnt + ')" maxlength="12" placeholder="Enter Aadhar Number"><span class="error-message error-message-aukn-aadhar_card_number_' + detailCnt + '"></span></td>'
                            + '<td class="text-center"><input type="text" class="form-control mobile_number_for_aukn" id="mobile_number_' + detailCnt + '" onblur="checkValidationForMobileNumberForOnlyEnter(\'aukn\',\'mobile_number_' + detailCnt + '\');" onkeyup="ArrearsUpdate.listview.setMobileNumber(' + detailCnt + ')" maxlength="10" placeholder="Enter Mobile Number"><span class="error-message error-message-aukn-mobile_number_' + detailCnt + '"></span></td></tr>';
                    $('#merge_container_for_kn_arrears_update').append(eduRow);
                    allowOnlyIntegerValue('khata_number_' + detailCnt);
                    allowOnlyIntegerValue('aadhar_card_number_' + detailCnt);
                    allowOnlyIntegerValue('mobile_number_' + detailCnt);
                    detailCnt++;
                    $('#khata_update_btn').show();
                });
            }
        });
    },
    setKhataNumber: function (ids) {
        var x = $('#khata_number_' + ids).val();
        $('.khata_number_for_aukn').val(x);
    },
    setAadharNumber: function (ids) {
        var x = $('#aadhar_card_number_' + ids).val();
        $('.aadhar_card_for_aukn').val(x);
    },
    setMobileNumber: function (ids) {
        var x = $('#mobile_number_' + ids).val();
        $('.mobile_number_for_aukn').val(x);
    },
    updateKhataNumber: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var updateKhataNumberData = $('#update_khata_number_form').serializeFormJSON();
        updateKhataNumberData.district = $('#district_for_arrears_update').val();
        updateKhataNumberData.village = $('#village_for_arrears_update').val();
        var khataNumberItem = [];
        var isKNAUValidation = false;
        $("#khata_number_table_for_arrears_update tr:not(:first)").each(function () {
            var khataNumberInfo = {};
            khataNumberInfo.survey = $(this).find("td:eq(5)").text();
            khataNumberInfo.subdiv = $(this).find("td:eq(6)").text();
            khataNumberInfo.khata_number = $(this).find("td:eq(9) input[type='text']").val();
            var aadharId = $(this).find("td:eq(10) input[type='text']").attr('id');
            khataNumberInfo.aadhar_card_number = $('#' + aadharId).val();
            if (khataNumberInfo.aadhar_card_number != '') {
                var aadharMessage = checkUID(khataNumberInfo.aadhar_card_number);
                if (aadharMessage != '') {
                    $('#' + aadharId).focus();
                    validationMessageShow('aukn-' + aadharId, aadharMessage);
                    isKNAUValidation = true;
                    return false;

                }
            }
            var mobileId = $(this).find("td:eq(11) input[type='text']").attr('id');
            khataNumberInfo.mobile_number = $('#' + mobileId).val();
            if (khataNumberInfo.mobile_number != '') {
                var mobileMessage = mobileNumberValidation(khataNumberInfo.mobile_number);
                if (mobileMessage != '') {
                    $('#' + mobileId).focus();
                    validationMessageShow('aukn-' + mobileId, mobileMessage);
                    isKNAUValidation = true;
                    return false;

                }
            }
            khataNumberItem.push(khataNumberInfo);
        });
        if (isKNAUValidation) {
            return false;
        }
        updateKhataNumberData.khata_number_detail = khataNumberItem;
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'utility/update_khata_number',
            data: $.extend({}, updateKhataNumberData, getTokenData()),
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
            },
            success: function (data) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(data);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    return false;
                }
                showSuccess(parseData.message);
                $("#ij_land_ownership input[type=checkbox]:checked").each(function () {
                    $(this).parents("tr").remove();
                });
                $("#ij_land_ownership_footer").empty();
            }
        });
    },
    districtChangeEvent: function (btnObj) {
        var district = btnObj.val();
        var tempChangeVillageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? tempDiuVillageData : []);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempChangeVillageData, 'village_for_arrears_update', 'village', 'village_name', 'devnagari');
    },
    listPageForAssignKhataNumberV2: function (village = '', survey = '', subdiv = '') {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        activeLink('menu_mamlatdar');
        addClass('assign_khata_number_v2', 'active');
        ArrearsUpdate.router.navigate('assign_khata_number_v2');
        var templateData = {};
        this.$el.html(assignKhataNumberV2ListTemplate(templateData));
        this.loadAssignKhataNumberV2();

        var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'village_for_assign_khata_number_v2_list', 'village', 'village_name', 'devnagari');
        if (village != '' && survey != '' && subdiv != '') {
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor([{survey: survey}], 'survey_number_for_assign_khata_number_v2_list', 'survey', 'survey', '', 'Survey Number');
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor([{subdiv: subdiv}], 'subdivision_number_for_assign_khata_number_v2_list', 'subdiv', 'subdiv', '', 'Subdiv Number');
            $('#village_for_assign_khata_number_v2_list').val(village);
            $('#survey_number_for_assign_khata_number_v2_list').val(survey);
            $('#subdivision_number_for_assign_khata_number_v2_list').val(subdiv);
            that.searchLandTaxNAData($('#search_btn_for_assign_khata_number_v2_list'));
        }
        generateSelect2id('village_for_assign_khata_number_v2_list');
        generateSelect2id('survey_number_for_assign_khata_number_v2_list');
        generateSelect2id('subdivision_number_for_assign_khata_number_v2_list');
    },
    loadAssignKhataNumberV2: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_TALATHI_USER && tempTypeInSession != TEMP_TYPE_ACI_USER && tempTypeInSession != TEMP_TYPE_MAMLATDAR_USER) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        var that = this;
        ArrearsUpdate.router.navigate('assign_khata_number_v2');
        var ownertRenderer = function (data, type, full, meta) {
            return landOwnerTypeArray[data] ? landOwnerTypeArray[data] : '';
        };
        var khataNumberRenderer = function (data, type, full, meta) {
            return that.getKhataNumberDetails(full);
        };
        $('#assign_khata_number_v2_form_and_datatable_container').html(assignKhataNumberV2TableTemplate);
        assignKhataNumberV2Datatable = $('#assign_khata_number_v2_datatable').DataTable({
            ajax: {url: 'assign_khata_number_v2/get_assign_khata_number_v2_data', dataSrc: "assign_khata_number_v2_data", type: "post", data: getTokenData()},
            bAutoWidth: false,
            pageLength: 25,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'village_name', 'class': 'text-center'},
                {data: 'survey', 'class': 'text-center'},
                {data: 'subdiv', 'class': 'text-center'},
                {data: 'area', 'class': 'text-center'},
                {data: 'owner_type', 'class': 'text-center', 'render': ownertRenderer},
                {data: 'joint_occupants', 'class': 'text-left'},
                {data: 'mutation_number', 'class': 'text-center'},
                {data: 'nature', 'class': 'text-center'},
                {data: '', 'class': 'text-center', 'render': khataNumberRenderer}
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
            }
        });
    },
    getKhataNumberDetails: function (full) {
        var tempData = '<table class="table table-bordered mb-0 bg-beige f-s-12px" id="ssca_details_container_for_knlist_' + full.occupant_id + '">';
        tempData += '<tr><td><input type="text" class="form-control form-control-sm" id="assign_khata_number_' + full.occupant_id + '" maxlength="10" placeholder="Enter Khata Number" value="' + full.khata_number + '"><span class="error-message error-message-ldkn-assign_khata_number_' + full.occupant_id + '"></span></td><td><button id="assign_khata_number_update_btn_' + full.occupant_id + '" type="button" class="btn btn-xs btn-success float-right" onclick="ArrearsUpdate.listview.updateAssignKhataNumber($(this),' + full.occupant_id + ');">Update</button></td></tr>';
        tempData += '</table>';
        return tempData;
    },
    updateAssignKhataNumber: function (btnObj, occupantId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!occupantId) {
            showError(invalidAccessValidationMessage);
            return;
        }
        validationMessageHide();
        var khataNumber = $('#assign_khata_number_' + occupantId).val();
        if (!khataNumber || khataNumber == 0) {
            $('#assign_khata_number_' + occupantId).focus();
            validationMessageShow('ldkn-assign_khata_number_' + occupantId, khataNumberValidationMessage);
            return false;
        }
        var formData = {};
        formData.occupant_id_for_assign_khata_number_update = occupantId;
        formData.khata_number_for_assign_khata_number_update = khataNumber;

        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'assign_khata_number_v2/update_assign_khata_number',
            type: 'post',
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
                    btnObj.html(ogBtnHTML);
                    btnObj.attr('onclick', ogBtnOnclick);
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                assignKhataNumberV2Datatable.row(btnObj.parent().parent().parent().parent().parent().parent()).remove().draw();
            }
        });
    },
//    showDatatableAssignKhataNumberV2Data: function () {
//        $('#assign_khata_number_v2_form_container').html('');
//        $('#assign_khata_number_v2_form_container').hide();
//        $('#assign_khata_number_v2_datatable_main_container').show();
//    },
    searchAssignKhataNumberVTwoData: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }

        var searchData = {};
        searchData.village = $('#village_for_assign_khata_number_v2_list').val();
        searchData.survey_number = $('#survey_number_for_assign_khata_number_v2_list').val();
        searchData.subdivision_number = $('#subdivision_number_for_assign_khata_number_v2_list').val();
        searchData.occupant_name = $('#occupant_name_for_assign_khata_number_v2_list').val();

        if (!searchData.village && !searchData.survey_number && !searchData.subdivision_number && !searchData.occupant_name) {
            showError(oneSearchValidationMessage);
            return false;
        }

        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');

        var that = this;
        var ownertRenderer = function (data, type, full, meta) {
            return landOwnerTypeArray[data] ? landOwnerTypeArray[data] : '';
        };
        var khataNumberRenderer = function (data, type, full, meta) {
            return that.getKhataNumberDetails(full);
        };
        var ltagriDataTable = function (settings, json) {
            btnObj.html(ogBtnHTML);
            btnObj.attr('onclick', ogBtnOnclick);
        };
//        that.showDatatableAssignKhataNumberV2Data();
        $('#assign_khata_number_v2_form_and_datatable_container').html(assignKhataNumberV2TableTemplate);
        $('#assign_khata_number_v2_datatable').DataTable({
            ajax: {url: 'assign_khata_number_v2/get_assign_khata_number_v2_data', dataSrc: "assign_khata_number_v2_data", type: "post", data: searchData},
            bAutoWidth: false,
            pageLength: 25,
            language: dataTableProcessingAndNoDataMsg,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'village_name', 'class': 'text-center'},
                {data: 'survey', 'class': 'text-center'},
                {data: 'subdiv', 'class': 'text-center'},
                {data: 'area', 'class': 'text-center'},
                {data: 'owner_type', 'class': 'text-center', 'render': ownertRenderer},
                {data: 'joint_occupants', 'class': 'text-left'},
                {data: 'mutation_number', 'class': 'text-center'},
                {data: 'nature', 'class': 'text-center'},
                {data: '', 'class': 'text-center', 'render': khataNumberRenderer}
            ],
            "initComplete": ltagriDataTable
        });
    },
    downloadExcelForAssignKhataNumberV2: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('#village_for_aknv2ge').val($('#village_for_assign_khata_number_v2_list').val());
        $('#survey_number_for_aknv2ge').val($('#survey_number_for_assign_khata_number_v2_list').val());
        $('#subdivision_number_for_aknv2ge').val($('#subdivision_number_for_assign_khata_number_v2_list').val());
        $('#occupant_name_for_aknv2ge').val($('#occupant_name_for_assign_khata_number_v2_list').val());
        $('#download_assign_khata_number_v2_excel_form').submit();
        $('.aknv2ge').val('');
    }
});
