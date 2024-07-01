(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push($.trim(this.value) || '');
            } else {
                o[this.name] = $.trim(this.value) || '';
            }
        });
        return o;
    };

})(jQuery);

function loginPage() {
    window.location = baseUrl + 'login';
}

function checkValidation(moduleName, fieldName, messageName) {
    var val = $('#' + fieldName).val();
    var newFieldName = moduleName + '-' + fieldName;
    validationMessageHide(newFieldName);
    if (!val || !val.trim()) {
        validationMessageShow(newFieldName, messageName);
    }
}

function validationMessageHide(moduleName) {
    if (typeof moduleName === "undefined") {
        $('.error-message').hide();
        $('.error-message').html('');
    } else {
        $('.error-message-' + moduleName).hide();
        $('.error-message-' + moduleName).html('');
    }
}

function validationMessageShow(moduleName, messageName) {
    $('.error-message-' + moduleName).html(messageName);
    $('.error-message-' + moduleName).show();
}

function generateSelect2id(idText) {
    $('#' + idText).select2({"allowClear": true});
}

function districtChangeEvent(obj, moduleName) {
    var district = obj.val();
    var tempChangeVillageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? tempDiuVillageData : []);
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempChangeVillageData, 'village_for_' + moduleName, 'village', 'village_name', 'devnagari');
}

function villageChangeEvent(obj, moduleName, showDisplay = false, moduleFlag) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    var surveyNumberId = 'survey_number_for_' + moduleName;
    var districtId = $('#district_for_' + moduleName).val();
    if (typeof districtId == "undefined") {
        districtId = VALUE_ONE;
    }
    renderOptionsForTwoDimensionalArray([], surveyNumberId);
    $('#' + surveyNumberId).val('').trigger('change');
    var village = obj.val();
    if (!village) {
        if (showDisplay) {
            $('#dvillage_for_' + moduleName).html('Village Name');
        }
        return false;
    }
    if (showDisplay) {
        $('#dvillage_for_' + moduleName).html(tempVillageData[village] ? tempVillageData[village]['village_name'] : '');
    }
    addTagSpinner(surveyNumberId);
    $.ajax({
        url: 'utility/get_survey_number_list',
        type: 'post',
        data: $.extend({}, {'village': village, 'module_flag': moduleFlag, 'district': districtId}, getTokenData()),
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
        },
        success: function (response) {
            var parseData = JSON.parse(response);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                removeTagSpinner();
                showError(parseData.message);
                return false;
            }
            $('#occupant_detail_info_container').html('<tr><td class="text-center">No Data Available !</td></tr>');
            $('.land_details').hide();
            var surveyNumberData = parseData.survey_number_data;
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForLand(surveyNumberData, 'survey_number_for_' + moduleName, 'survey', 'survey', '');
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], 'subdivision_number_for_' + moduleName, '', '', '');
            removeTagSpinner();
        }
    });
}

function surveyNumberChangeEvent(obj, moduleName, showDisplay = false, moduleFlag) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    var subdivisionNumberId = 'subdivision_number_for_' + moduleName;
    renderOptionsForTwoDimensionalArray([], subdivisionNumberId);
    $('#' + subdivisionNumberId).val('').trigger('change');
    var village = $('#village_for_' + moduleName).val();
    var districtId = $('#district_for_' + moduleName).val();
    if (typeof districtId == "undefined") {
        districtId = VALUE_ONE;
    }
    var surveyNumber = obj.val();

    if (!village || !surveyNumber) {
        if (showDisplay) {
            $('#dsurvey_for_' + moduleName).html('Survey');
        }
        return false;
    }
    if (showDisplay) {
        $('#dsurvey_for_' + moduleName).html(surveyNumber);
    }
    addTagSpinner(subdivisionNumberId);
    $.ajax({
        url: 'utility/get_subdivision_number_list',
        type: 'post',
        data: $.extend({}, {'village': village, 'survey_number': surveyNumber, 'module_flag': moduleFlag, 'district': districtId}, getTokenData()),
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
        },
        success: function (response) {
            var parseData = JSON.parse(response);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                removeTagSpinner();
                showError(parseData.message);
                return false;
            }
            $('#occupant_detail_info_container').html('<tr><td class="text-center">No Data Available !</td></tr>');
            $('.land_details').hide();
            var tempSubdivData = parseData.subdivision_number_data;
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempSubdivData, subdivisionNumberId, 'subdiv', 'subdiv', '');
            removeTagSpinner();
        }
    });
}

function getBasicMessageAndFieldJSONArray(field, message) {
    var returnData = {};
    returnData['message'] = message;
    returnData['field'] = field;
    return returnData;
}

function resetForm(formId) {
    validationMessageHide();
    $('#' + formId).trigger("reset");
}

function checkPasswordValidation(moduleName, id) {
    var password = $('#' + id).val();
    if (!password) {
        validationMessageShow(moduleName + '-' + id, passwordValidationMessage);
        return;
    }
    var msg = passwordValidation(password);
    if (msg != '') {
        validationMessageShow(moduleName + '-' + id, msg);
        return;
    }
    validationMessageHide(moduleName + '-' + id);
}

function passwordValidation(password) {
    var regex = new RegExp(passwordRegex);
    if (!regex.test(password)) {
        return passwordPolicyValidationMessage;
    }
    return '';
}

function checkPasswordValidationForRetypePassword(moduleName, compareId, id) {
    var retypePassword = $('#' + compareId).val();
    if (!retypePassword) {
        validationMessageHide(moduleName + '-' + compareId);
        return;
    }
    var password = $('#' + id).val();
    if (password != retypePassword) {
        validationMessageShow(moduleName + '-' + compareId, passwordAndRetypePasswordValidationMessage);
        return;
    }
    validationMessageHide(moduleName + '-' + compareId);
}

function passwordValidation(password) {
    if (!passwordRegex.test(password)) {
        return passwordPolicyValidationMessage;
    }
    return '';
}

function generateSelect2() {
    $('.select2').select2({"allowClear": true});
}

function generateSelect2Class(idText) {
    $('.' + idText).select2({"allowClear": true});
}

function generateSelect2WithId(id) {
    $('#' + id).select2({"allowClear": true});
}

function renderOptionsForTwoDimensionalArray(dataArray, comboId, addBlankOption) {
    if (!dataArray) {
        return false;
    }
    if (typeof addBlankOption === "undefined") {
        addBlankOption = true;
    }
    if (addBlankOption) {
        $('#' + comboId).html('<option value="">&nbsp;</option>');
    }
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        data = {"value_field": index, 'text_field': dataObject};
        optionResult = optionTemplate(data);
        $("#" + comboId).append(optionResult);
    });
}

function renderOptionsForAVArray(dataArray, villArray, comboId, addBlankOption) {
    if (!dataArray) {
        return false;
    }
    if (typeof addBlankOption === "undefined") {
        addBlankOption = true;
    }
    if (addBlankOption) {
        $('#' + comboId).html('<option value="">&nbsp;</option>');
    }
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (villArray[dataObject]) {
            data = {"value_field": dataObject, 'text_field': villArray[dataObject]};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}

function renderOptionsForStartEndValues(startValue, EndValue, comboId, addBlankOption) {
    if (typeof addBlankOption === "undefined") {
        addBlankOption = true;
    }
    if (addBlankOption) {
        $('#' + comboId).html('<option value="">&nbsp;</option>');
    }
    var data = {};
    for (var i = startValue; i <= EndValue; i++) {
        data = {"value_field": i, 'text_field': i};
        $("#" + comboId).append('<option value="' + i + '">' + i + '</option>');
    }
}

function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(dataArray, comboId, keyId, valueId, message) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="">Select ' + message + '</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            data = {"value_field": dataObject[keyId], 'text_field': dataObject[valueId]};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}
function renderOptionsForStateAndDistrict(dataArray, comboId, keyId, valueId, message) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="0">' + message + '</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            data = {"value_field": dataObject[keyId], 'text_field': dataObject[valueId]};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}

function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(dataArray, comboId, keyId, valueId, valueId2, addBlankOption) {
    if (!dataArray) {
        return false;
    }
    if (typeof addBlankOption === "undefined") {
        addBlankOption = true;
    }
    if (addBlankOption) {
        $('#' + comboId).html('<option value="">&nbsp;</option>');
    }
    var data = {};
    var optionResult = "";
    var textField = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            if (dataObject[valueId2]) {
                textField = dataObject[valueId] + (dataObject[valueId2] != null ? '( ' + dataObject[valueId2] + ' )' : '');
            } else {
                textField = dataObject[valueId];
            }
            data = {"value_field": dataObject[keyId], 'text_field': textField};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}

function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(dataArray, comboId, keyId, valueId, valueId2, addBlankOption) {
    if (!dataArray) {
        return false;
    }
    if (typeof addBlankOption === "undefined") {
        addBlankOption = true;
    }
    if (addBlankOption) {
        $('#' + comboId).html('<option value="">&nbsp;</option>');
    }
    var data = {};
    var optionResult = "";
    var textField = "";
    if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && tempAVInSession != '') {
        var fullDataObj = tempAVInSession.split(',');
        $.each(fullDataObj, function (index, dataObject) {
            if (dataArray[dataObject]) {
                var nDataObj = dataArray[dataObject];
                if (nDataObj[valueId2]) {
                    textField = nDataObj[valueId] + (nDataObj[valueId2] != null ? '( ' + nDataObj[valueId2] + ' )' : '');
                } else {
                    textField = nDataObj[valueId];
                }
                data = {"value_field": nDataObj[keyId], 'text_field': textField};
                optionResult = optionTemplate(data);
                $("#" + comboId).append(optionResult);
            }
        });
    } else {
        $.each(dataArray, function (index, dataObject) {
            if (dataObject != undefined && dataObject[keyId] != 0) {
                if (dataObject[valueId2]) {
                    textField = dataObject[valueId] + (dataObject[valueId2] != null ? '( ' + dataObject[valueId2] + ' )' : '');
                } else {
                    textField = dataObject[valueId];
                }
                data = {"value_field": dataObject[keyId], 'text_field': textField};
                optionResult = optionTemplate(data);
                $("#" + comboId).append(optionResult);
            }
        });
    }
}

function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForLand(dataArray, comboId, keyId, valueId, valueId2, addBlankOption) {
    if (!dataArray) {
        return false;
    }
    if (typeof addBlankOption === "undefined") {
        addBlankOption = true;
    }
    if (addBlankOption) {
        $('#' + comboId).html('<option value="">&nbsp;</option>');
    }
    var data = {};
    var optionResult = "";
    var textField = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined) {
            if (dataObject[valueId2]) {
                textField = dataObject[valueId] + (dataObject[valueId2] != null ? ' ( ' + dataObject[valueId2] + ' )' : '');
            } else {
                textField = dataObject[valueId];
            }
            data = {"value_field": dataObject[keyId], 'text_field': textField};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}

function renderOptionsForTwoDimensionalArrayWithValueCombination(dataArray, comboId, valueId, addBlankOption) {
    if (!dataArray) {
        return false;
    }
    if (typeof addBlankOption === "undefined") {
        addBlankOption = true;
    }
    if (addBlankOption) {
        $('#' + comboId).html('<option value="">&nbsp;</option>');
    }
    var data = {};
    var optionResult = "";
    var textField = "";
    $.each(dataArray, function (index, dataObject) {
        textField = dataObject[valueId];
        data = {"value_field": index, 'text_field': textField};
        optionResult = optionTemplate(data);
        $("#" + comboId).append(optionResult);
    });
}

function dateTo_DD_MM_YYYY(date, delimeter) {
    var delim = delimeter ? delimeter : '-';
    var d = new Date(date || Date.now()),
            month = d.getMonth() + 1,
            day = '' + d.getDate(),
            year = d.getFullYear();
    if (month < 10)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;
    return [day, month, year].join(delim);
}

function dateTo_MM_YYYY(date, delimeter) {
    var delim = delimeter ? delimeter : '-';
    var d = new Date(date || Date.now()),
            month = d.getMonth() + 1,
            day = '' + d.getDate(),
            year = d.getFullYear();
    if (month < 10)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;
    return [month, year].join(delim);
}

function date_MINUS_ZERO() {
    var d = new Date();
    d.setFullYear(d.getFullYear() - 0);
    return d;
}

function date_MINUS_EIGHT() {
    var d = new Date();
    d.setFullYear(d.getFullYear() - 18);
    return d;
}
function date_MINUS_NINE() {
    var d = new Date();
    d.setFullYear(d.getFullYear() - 18);
    return d;
}
function date_MINUS_SIXTY() {
    var d = new Date();
    d.setFullYear(d.getFullYear() - 60);
    return d;
}

function date_MINUS_FIFTYNINE() {
    var d = new Date();
    d.setFullYear(d.getFullYear() - 59);
    return d;
}

function date_TOMMOROW() {
    var d = new Date();
    d.setDate(d.getDate() + 1);
    return d;
}

function dateTo_DD_MM_YYYY_HH_II_SS(date, delimeter) {
    var delim = delimeter ? delimeter : '-';
    var d = new Date(date || Date.now()),
            month = d.getMonth() + 1,
            day = '' + d.getDate(),
            year = d.getFullYear();
    if (month < 10)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    var hours = d.getHours();
    var minutes = d.getMinutes();
    var seconds = d.getSeconds();
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;
    return [day, month, year].join(delim) + ' ' + hours + ':' + minutes + ':' + seconds;
}

function getPerviousDateTo_DD_MM_YYYY(days, date) {
    var d = new Date(date || Date.now());
    d.setDate(d.getDate() - days);
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var year = d.getFullYear();
    if (month < 10)
        month = '0' + month;
    if (day < 10)
        day = '0' + day;
    return [day, month, year].join('-');
}

function getNextDateTo_DD_MM_YYYY(days, date) {
    var ndate = date.split("-").reverse().join("-");
    var d = new Date(ndate || Date.now());
    d.setDate(d.getDate() + days);
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var year = d.getFullYear();
    if (month < 10)
        month = '0' + month;
    if (day < 10)
        day = '0' + day;
    return [day, month, year].join('-');
}

function dateTo_YYYY_MM_DD(date, delimeter) {
    return date.split('-').reverse().join('-');
}

function getCurrentTime() {
    var date = new Date();
    var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
    var am_pm = date.getHours() >= 12 ? "PM" : "AM";
    hours = hours < 10 ? "0" + hours : hours;
    var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
    return hours + ":" + minutes + ":" + " " + am_pm;
}

function checkValidationForPincode(moduleName, id) {
    var val = $('#' + id).val();
    validationMessageHide(moduleName + '-' + id);
    if (!val || !val.trim()) {
        validationMessageShow(moduleName + '-' + id, pincodeValidationMessage);
        return false;
    }
    if (val.length != 6) {
        validationMessageShow(moduleName + '-' + id, validPincodeValidationMessage);
        return false;
    }
}

function pincodeValidation(pincode) {
    if (pincode.length != 6) {
        return validPincodeValidationMessage;
    }
    return '';
}

function checkNumeric(obj) {
    if (!$.isNumeric(obj.val())) {
        obj.val("");
    }
}

function allowOnlyIntegerValue(id) {
    allowOnlyIntegerValueWithObj($('#' + id));
}

function allowOnlyIntegerValueWithObj(obj) {
    $(obj).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
}

function roundOff(obj) {
    var amount = obj.val();
    if ($.isNumeric(amount)) {
        obj.val(parseFloat(Math.abs(amount)).toFixed(2));
    }
}

var districtRenderer = function (data, type, full, meta) {
    return talukaArray[data] ? talukaArray[data] : '';
};
var serialNumberRenderer = function (data, type, full, meta) {
    return meta.row + meta.settings._iDisplayStart + 1;
};

var districtRenderer = function (data, type, full, meta) {
    return talukaArray[data] ? talukaArray[data] : '-';
};

var appStatusRenderer = function (data, type, full, meta) {
    return '<div id="status_' + data + '">' + (returnAppStatus(full.status)) + '</div>';
};
var caseStatusRenderer = function (data, type, full, meta) {
    return '<div id="status_' + data + '">' + (caseStatusArray[full.status] ? caseStatusArray[full.status] : caseStatusArray[VALUE_ZERO]) + '</div>';
};
function returnAppStatus(status) {
    return appStatusArray[status] ? appStatusArray[status] : appStatusArray[VALUE_ZERO];
}
var appReverifyStatusRenderer = function (data, type, full, meta) {
    var returnString = '<div id="status_' + data + '">' + (appStatusArray[full.status] ? appStatusArray[full.status] : appStatusArray[VALUE_ZERO]) + '</div>';
    returnString += '<div id="reverification_status_' + data + '">';
    if (full.to_type_reverify != VALUE_ZERO && full.status == VALUE_THREE) {
        returnString += '<hr>';
        if (full.talathi_to_reverify_datetime != '0000-00-00 00:00:00' && full.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                full.talathi_to_type_reverify == VALUE_ONE) {
            returnString += full.aci_name;
        } else if (full.talathi_to_reverify_datetime != '0000-00-00 00:00:00' && full.aci_to_reverify_datetime == '0000-00-00 00:00:00' &&
                full.talathi_to_type_reverify == VALUE_TWO) {
            returnString += full.mamlatdar_name;
        } else if ((full.talathi_to_reverify_datetime != '0000-00-00 00:00:00' && full.aci_to_reverify_datetime != '0000-00-00 00:00:00') ||
                (full.talathi_to_reverify_datetime == '0000-00-00 00:00:00' && full.aci_to_reverify_datetime != '0000-00-00 00:00:00')) {
            if (full.aci_to_ldc != VALUE_ZERO && full.aci_rec_reverify == VALUE_ONE && full.ldc_to_mamlatdar == VALUE_ZERO) {
                returnString += full.ldc_name;
            } else {
                returnString += full.mamlatdar_name;
            }
        } else {
            returnString += (full.to_type_reverify == VALUE_ONE ? full.talathi_name : full.aci_name);
        }
    }
    returnString += '</div>';
    return returnString;
};
var appNumberWithRegiUserRenderer = function (data, type, full, meta) {
    return '<div class="text-center f-w-b">' + full.application_number + '<hr>' + dateTo_DD_MM_YYYY_HH_II_SS(full.submitted_datetime) + '</div><hr><div class="f-s-app-details text-left">' + '<i class="fas fa-user f-s-10px"></i> :- ' + full.reg_user_name + '<br><i class="fas fa-phone-volume f-s-10px"></i> :- '
            + full.reg_user_mobile_number + '<br><i class="fas fa-envelope f-s-10px"></i> :- ' + full.reg_user_email + '</div>';
};
var appNumberRenderer = function (data, type, full, meta) {
    return data + '<hr>' + dateTo_DD_MM_YYYY_HH_II_SS(full.submitted_datetime);
};

//var queryStatusRenderer = function (data, type, full, meta) {
//    return '<div id="query_status_' + data + '">' + (queryStatusArray[full.query_status] ? queryStatusArray[full.query_status] : queryStatusArray[VALUE_ZERO]) + '</div>';
//};

var queryStatusRenderer = function (data, type, full, meta) {
    return '<div id="query_status_' + data + '" class="mb-1">' + (queryStatusArray[full.query_status] ? queryStatusArray[full.query_status] : queryStatusArray[VALUE_ZERO]) + '</div>' +
            '<div id="query_ad_' + data + '" class="f-s-app-details">' + (full.query_by_name ? ('<hr>' + full.query_by_name + '<hr>' + dateTo_DD_MM_YYYY_HH_II_SS(full.query_datetime)) : ' ') + '</div>';
};
var queryGrievanceStatusRenderer = function (data, type, full, meta) {
    return '<div id="query_grievance_status_' + data + '">' + (queryGrievanceStatusArray[full.status] ? queryGrievanceStatusArray[full.status] : queryGrievanceStatusArray[VALUE_ZERO]) + '</div>';
};

var dateRenderer = function (data, type, full, meta) {
    return dateTo_DD_MM_YYYY(data);
};

var dateTimeRenderer = function (data, type, full, meta) {
    return data != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(data) : '-';
};

var premisesStatusRenderer = function (data, type, full, meta) {
    return premisesStatusArray[data] ? premisesStatusArray[data] : '';
};

var emailEditsplitStringRenderer = function (data, type, full, meta) {
    var btn = full.is_delete == VALUE_ONE ? '' : '<button class="btn btn-sm" onclick="VPUsers.listview.editEmailVPUsers($(this),' + full.user_id + ', false);" style="padding: 2px 5px; margin-top: 1px; margin-bottom: 2px;"> <i class="fas fa-edit text-success" style="margin-right: 2px;"></i></button>';
    return data.replace('@', '<br>@') + btn;
};

var splitStringRenderer = function (data, type, full, meta) {
    return data.replace('@', '<br>@');
};

var yesNoRenderer = function (data, type, full, meta) {
    return yesNoArray[data] ? yesNoArray[data] : '-';
};

var userStatusRenderer = function (data, type, full, meta) {
    return userStatusArray[data] ? userStatusArray[data] : '-';
};

function checkAlphabets(obj) {
    obj.val(obj.val().replace(/[^a-z A-Z.]/g, ""));
    if ((event.which >= 48 && event.which <= 57)) {
        event.preventDefault();
    }
}

function checkAlphabetsBlur(obj) {
    obj.val(obj.val().replace(/[^a-z A-Z.]/g, ''));
}

function datePicker() {
    $('.date_picker').datetimepicker({
        icons:
                {
                    up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down',
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
        format: 'DD-MM-YYYY'
    });
    dateChangeEvent();
}

function datePickerId(id) {
    $('#' + id).datetimepicker({
        icons:
                {
                    up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down',
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
        format: 'DD-MM-YYYY'
    });
    dateChangeEvent();
}

function datePickerMax(id) {
    $('#' + id).datetimepicker({
        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },
        maxDate: date_MINUS_EIGHT()
    });
    dateChangeEvent();
}

function datePickerMaxToday(id) {
    $('#' + id).datetimepicker({
        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },
        maxDate: new Date()
    });
    dateChangeEvent();
}

function datePickerToday(id) {
    $('#' + id).datetimepicker({
        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },
        maxDate: $.now()
    });
    dateChangeEvent();
}

function datePickerSixty(id) {
    $('#' + id).datetimepicker({
        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },
        maxDate: date_MINUS_SIXTY()
    });
    dateChangeEvent();
}
function datePickerEigSix(id) {
    $('#' + id).datetimepicker({
        // format : 'mm-dd-yyyy',

        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },

        minDate: date_MINUS_SIXTY(),
        maxDate: date_MINUS_EIGHT()
    });
    dateChangeEvent();
}
function datePickerFif(id) {
    $('#' + id).datetimepicker({
        // format : 'mm-dd-yyyy',

        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },

        minDate: date_MINUS_FIFTYNINE(),
        maxDate: date_MINUS_EIGHT()
    });
    dateChangeEvent();
}
function datePickerMinor(id) {
    $('#' + id).datetimepicker({
        // format : 'mm-dd-yyyy',

        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },

        minDate: date_MINUS_EIGHT(),
        maxDate: date_MINUS_ZERO()
    });
    dateChangeEvent();
}

function datePickerMin(id) {
    $('#' + id).datetimepicker({
        // format : 'mm-dd-yyyy',

        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },

        minDate: date_MINUS_NINE(),
        maxDate: $.now()
    });
    dateChangeEvent();
}

function datePickerAppointment() {
    $('.appointment_date_picker').datetimepicker({
        icons:
                {
                    up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down',
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
        format: 'DD-MM-YYYY',
        minDate: new Date()
    });
    $('.appointment_time_picker').datetimepicker({
        icons: {
            up: 'fa fa-angle-up',
            down: 'fa fa-angle-down',
            next: 'fa fa-angle-right',
            previous: 'fa fa-angle-left'
        },
    });
    dateChangeEvent();
}

function startDateEndDateFunctionality(startDateId, endDateId) {
    $('#' + startDateId).datetimepicker();
    $('#' + endDateId).datetimepicker({
        useCurrent: false //Important! See issue #1075
    });
    $('#' + startDateId).on("dp.change", function (e) {
        $('#' + endDateId).data("DateTimePicker").minDate(e.date);
    });
    $('#' + endDateId).on("dp.change", function (e) {
        $('#' + startDateId).data("DateTimePicker").maxDate(e.date);
    });
    dateChangeEvent();
}

function timePicker() {
    $('.timepicker').datetimepicker({
        format: 'LT'
    })
}

function dateChangeEvent() {
    $('.date_picker').keyup(function (e) {
        e = e || window.event; //for pre-IE9 browsers, where the event isn't passed to the handler function
        if (e.keyCode == '37' || e.which == '37' || e.keyCode == '39' || e.which == '39') {
            var message = ' ' + $('.ui-state-hover').html() + ' ' + $('.ui-datepicker-month').html() + ' ' + $('.ui-datepicker-year').html();
            if ($(this).attr('id') == 'startDate') {
                $(".date_picker").val(message);
            }
        }
    });
}

function checkValidationForMobileNumber(moduleName, id) {
    validationMessageHide(moduleName + '-' + id);
    var mobileNumber = $('#' + id).val();
    if (!mobileNumber) {
        validationMessageShow(moduleName + '-' + id, mobileValidationMessage);
        return;
    }
    var validate = mobileNumberValidation(mobileNumber);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
}

function checkValidationForMobileNumberForOnlyEnter(moduleName, id) {
    validationMessageHide(moduleName + '-' + id);
    var mobileNumber = $('#' + id).val();
    if (!mobileNumber) {
        return;
    }
    var validate = mobileNumberValidation(mobileNumber);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
}

function mobileNumberValidation(mobileNumber) {
    var filter = /^[0-9-+]+$/;
    if (mobileNumber.length != 10 || !filter.test(mobileNumber)) {
        return invalidMobileValidationMessage;
    }
    return '';
}

function checkValidationForEmail(moduleName, id) {
    validationMessageHide(moduleName + '-' + id);
    var emailId = $('#' + id).val();
    if (!emailId) {
        return false;
    }
    var validate = emailIdValidation(emailId);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
}

function checkValidationForExiEmail(moduleName, id) {
    validationMessageHide(moduleName + '-' + id);
    var emailId = $('#' + id).val();
    if (!emailId) {
        validationMessageShow(moduleName + '-' + id, emailValidationMessage);
        return false;
    }
    var validate = emailIdValidation(emailId);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
}

function emailIdValidation(emailId) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(emailId)) {
        return invalidEmailValidationMessage;
    }
    return '';
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 10000
});

function toastFire(type, message) {
    Toast.fire({
        type: type,
        title: '<span style="padding-left: 10px; padding-right: 10px;">' + message + '</span>',
        showCloseButton: true,
    });
}

function showConfirmation(yesEvent, message, extraMessage) {
    if (typeof extraMessage == "undefined") {
        extraMessage = '';
    }
    $('.swal2-popup').removeClass('p-5px');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'Are you sure You want to ' + message + ' ?',
        type: 'warning',
        html: (extraMessage != '' ? ('<span class="text-danger f-s-18px f-w-b">' + extraMessage + '</span>') : ''),
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes, ' + message + ' it !',
        cancelButtonText: 'No, Cancel !',
    }).then((result) => {
        if (result.value) {
            $('#temp_btn').attr('onclick', yesEvent);
            $('#temp_btn').click();
            $('#temp_btn').attr('onclick', '');
        }
    });
}

function showPopup() {
    const swalWithBootstrapButtons = Swal.mixin({});
    swalWithBootstrapButtons.fire({
        showCancelButton: false,
        showConfirmButton: false,
        html: '<div id="popup_container"></div>',
    });
    $('.swal2-popup').addClass('p-5px');
}

function showSuccess(message) {
    toastFire('success', message);
}

function showError(message) {
    toastFire('error', message);
}

function activeLink(id) {
    $('.nav-link').removeClass('active');
    addClass(id, 'active');
}

function addClass(id, className) {
    $('#' + id).addClass(className);
}

function addTagSpinner(id) {
    $('#' + id).parent().find('.error-message').before(tagSpinnerTemplate);
}

function removeTagSpinner() {
    $('#tag_spinner').remove();
}

function resetModel() {
    $('#popup_modal').modal('hide');
    $('#model_title').html('');
    $('#model_body').html('');
}
function resetModelMD() {
    $('#popup_md_modal').modal('hide');
    $('#model_md_title').html('');
    $('#model_md_body').html('');
}
function activeSelectedBtn(obj) {
    $('.small-btn').removeClass('btn-success');
    $('.small-btn').addClass('btn-primary');
    if (obj) {
        obj.removeClass('btn-primary');
        obj.addClass('btn-success');
    }
}

function selectOrDeselectRow(obj, id) {
    if (obj.hasClass('bg-white')) {
        obj.removeClass('bg-white');
        obj.addClass('bg-active');
        $('#' + id).prop('checked', true);
    } else {
        obj.removeClass('bg-active');
        obj.addClass('bg-white');
        $('#' + id).prop('checked', false);
    }
}

function getTotalSelectedRows(id) {
    $('#' + id).html($('.bg-active').length);
}

var trimColumnValueRenderer = function (data, type, full, meta) {
    return (data).trim();
};

function generateRandomString(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function getDistrictData(stateId, districtId) {
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor([], districtId, 'district_code', 'district_name', 'District');
    $('#' + districtId).val('');
    var stateCode = $('#' + stateId).val();
    if (!stateCode) {
        return;
    }
    var districtData = tempDistrictData[stateCode] ? tempDistrictData[stateCode] : [];
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationFor(districtData, districtId, 'district_code', 'district_name', 'District');
    $('#' + districtId).val('');
}

function fileUploadValidationForImage(imageUploadAttrId, maxFileSize) {
    var allowedFiles = ['jpg', 'png', 'jpeg', 'jfif'];
    var fileName = $('#' + imageUploadAttrId).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if ($.inArray(ext, allowedFiles) == -1) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Please upload File having extensions: <b>' + allowedFiles.join(', ') + '</b> only.';
    }
    if (($('#' + imageUploadAttrId)[0].files[0].size / 1024) > maxFileSize) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Maximum upload size ' + (maxFileSize / 1024) + ' MB only.';
    }
    return false;
}

function fileUploadValidation(imageUploadAttrId, maxFileSize) {
    var allowedFiles = ['jpg', 'png', 'jpeg', 'jfif', 'pdf'];
    var fileName = $('#' + imageUploadAttrId).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if ($.inArray(ext, allowedFiles) == -1) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Please upload File having extensions: <b>' + allowedFiles.join(', ') + '</b> only.';
    }
    if (($('#' + imageUploadAttrId)[0].files[0].size / 1024) > maxFileSize) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Maximum upload size ' + (maxFileSize / 1024) + ' MB only.';
    }
    return false;
}

function fileUploadValidationForPDF(imageUploadAttrId, maxFileSize) {
    var allowedFiles = ['pdf', 'PDF'];
    var fileName = $('#' + imageUploadAttrId).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if ($.inArray(ext, allowedFiles) == -1) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Please upload File having extensions: <b>' + allowedFiles.join(', ') + '</b> only.';
    }
    if (($('#' + imageUploadAttrId)[0].files[0].size / 1024) > maxFileSize) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Maximum upload size ' + (maxFileSize / 1024) + ' MB only.';
    }
    return false;
}

function checkValidationForDocumentfileUploadValidation(imageUploadAttrId, maxFileSize) {
    var allowedFiles = ['jpg', 'png', 'jpeg', 'jfif', 'pdf'];
    var fileName = $('#' + imageUploadAttrId).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    if ($.inArray(ext, allowedFiles) == -1) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Please upload File having extensions: <b>' + allowedFiles.join(', ') + '</b> only.';
    }
    if (($('#' + imageUploadAttrId)[0].files[0].size / 1024) > maxFileSize) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Maximum upload size ' + (maxFileSize / 1024) + ' MB only.';
    }
    return false;
}

function fileUploadValidationForAllFiles(imageUploadAttrId, maxFileSize) {
    if (($('#' + imageUploadAttrId)[0].files[0].size / 1024) > maxFileSize) {
        $('#' + imageUploadAttrId).val('');
        $('#' + imageUploadAttrId).focus();
        return 'Maximum upload size ' + (maxFileSize / 1024) + ' MB only.';
    }
    return false;
}

var dataTableProcessingAndNoDataMsg = {
    'loadingRecords': '<span class="color-nic-blue"><i class="fas fa-spinner fa-spin fa-2x"></i></span>',
    'processing': '<span class="color-nic-blue"><i class="fas fa-spinner fa-spin fa-3x"></i></span>',
    'emptyTable': 'No Data Available !'
};

var searchableDatatable = function (settings, json) {
    this.api().columns().every(function () {
        var that = this;
        $('input', this.header()).on('keyup change clear', function () {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
        $('select', this.header()).on('change', function () {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    });
}

var aciNR = function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
    if (aData.aci_rec_reverify == VALUE_TWO || (aData.aci_rec_reverify == VALUE_ZERO && aData.aci_rec == VALUE_TWO)) {
        $('td', nRow).css('background-color', '#fdd1d1');
    }
};

function generateBoxes(type, data, id, moduleName, existingArray, isBr) {
    $.each(data, function (index, value) {
        var template = '<label class="' + type + '-inline f-w-n m-b-0px m-r-10px"><input type="' + type + '" id="' + id + '_for_' + moduleName + '_' + index + '" name="' + id + '_for_' + moduleName + '" value="' + index + '">&nbsp;&nbsp;' + value + '</label>';
        if (isBr) {
            template += '<br>';
        }
        $('#' + id + '_container_for_' + moduleName).append(template);
    });
    if (existingArray) {
        if (type == 'checkbox') {
            var existingData = (existingArray).split(',');
            $.each(existingData, function (index, value) {
                $('input[name=' + id + '_for_' + moduleName + '][value="' + value + '"]').click();
            });
        } else {
            $('input[name=' + id + '_for_' + moduleName + '][value="' + existingArray + '"]').click();
        }
    } else {
        $('input[name=' + id + '_for_' + moduleName + '][value="' + existingArray + '"]').click();
    }
}

function generateBoxesForGA(type, data, fullData, id, moduleName, existingArray, isBr, startValue, endValue) {
    $.each(data, function (index, value) {
//        if (index >= startValue && index <= endValue) {
        var template = '<label class="' + type + '-inline f-w-n m-b-0px m-r-10px"><input type="' + type + '" id="' + id + '_for_' + moduleName + '_' + value + '" name="' + id + '_for_' + moduleName + '" value="' + value + '">&nbsp;&nbsp;' + (fullData[value] ? fullData[value] : '') + '</label>';
        if (isBr) {
            template += '<br>';
        }
        $('#' + id + '_container_for_' + moduleName).append(template);
//        }
    });
    if (existingArray) {
        if (type == 'checkbox') {
            var existingData = (existingArray).split(',');
            $.each(existingData, function (index, value) {
                $('input[name=' + id + '_for_' + moduleName + '][value="' + value + '"]').click();
            });
        } else {
            $('input[name=' + id + '_for_' + moduleName + '][value="' + existingArray + '"]').click();
        }
    } else {
        $('input[name=' + id + '_for_' + moduleName + '][value="' + existingArray + '"]').click();
    }
}



function generateCheckBoxesForVillages(type, data, id, moduleName, existingArray, isBr) {
    $('#' + id + '_container_for_' + moduleName).html('');
    $.each(data, function (index, value) {
        var template = '<label class="' + type + '-inline f-w-n m-b-0px m-r-10px"><input type="' + type + '" id="' + id + '_for_' + moduleName + '_' + index + '" name="' + id + '_for_' + moduleName + '" value="' + value.village + '">&nbsp;&nbsp;' + value.village_name + '</label>';
        if (isBr) {
            template += '<br>';
        }
        $('#' + id + '_container_for_' + moduleName).append(template);
    });
    if (existingArray) {
        if (type == 'checkbox') {
            var existingData = (existingArray).split(',');
            $.each(existingData, function (index, value) {
                $('input[name=' + id + '_for_' + moduleName + '][value="' + value + '"]').click();
            });
        } else {
            $('input[name=' + id + '_for_' + moduleName + '][value="' + existingArray + '"]').click();
        }
    } else {
        $('input[name=' + id + '_for_' + moduleName + '][value="' + existingArray + '"]').click();
    }
}

function getLocation() {
    tempLocationData = {};
    tempLocationData.latitude = '';
    tempLocationData.longitude = '';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getCurrentLatLong);
    }
}

function getCurrentLatLong(position) {
    $('#latitude_for_road_details').val(position.coords.latitude);
    $('#longitude_for_road_details').val(position.coords.longitude);
}

function showSubContainer(id, moduleName, showId, showValue, type, showId2, showValue2, showId3, showValue3) {
    var otherId = '';
    if (type == 'radio') {
        otherId = $('input[name=' + id + '_for_' + moduleName + ']:checked').val();
    } else {
        otherId = $('#' + id + '_for_' + moduleName).val();
    }
    if (otherId == showValue) {
        $(showId + '_container_for_' + moduleName).show();
    }

    if (typeof showId2 != "undefined" && typeof showValue2 != "undefined") {
        if (otherId == showValue2) {
            $(showId2 + '_container_for_' + moduleName).show();
        }
    }

    if (typeof showId3 != "undefined" && typeof showValue3 != "undefined") {
        if (otherId == showValue3) {
            $(showId3 + '_container_for_' + moduleName).show();
        }
    }

    var inputObj = type == 'radio' ? 'input[name=' + id + '_for_' + moduleName + ']' : '#' + id + '_for_' + moduleName;
    $(inputObj).change(function () {
        var other = $(this).val();
        $(showId + '_container_for_' + moduleName).hide();
        if (typeof showId2 != "undefined" && typeof showValue2 != "undefined") {
            $(showId2 + '_container_for_' + moduleName).hide();
        }
        if (typeof showId3 != "undefined" && typeof showValue3 != "undefined") {
            $(showId3 + '_container_for_' + moduleName).hide();
        }
        if (other == showValue) {
            $(showId + '_container_for_' + moduleName).show();
            return false;
        } else {
            if (typeof showId2 != "undefined" && typeof showValue2 != "undefined") {
                if (other == showValue2) {
                    $(showId2 + '_container_for_' + moduleName).show();
                }
            }
            if (typeof showId3 != "undefined" && typeof showValue3 != "undefined") {
                if (other == showValue3) {
                    $(showId3 + '_container_for_' + moduleName).show();
                }
            }
        }
    });
}

function showSubContainerForPaymentDetails(id, moduleName, showId, type) {
    var otherId = '';
    if (type == 'radio') {
        otherId = $('input[name=' + id + '_for_' + moduleName + ']:checked').val();
    } else {
        otherId = $('#' + id + '_for_' + moduleName).val();
    }
    if (otherId == VALUE_ONE || otherId == VALUE_TWO) {
        $('#' + showId + '_container_for_' + moduleName + '').show();
    }
    $('input[name=' + id + '_for_' + moduleName + ']').change(function () {
        validationMessageHide('wmregistration-uc-' + id + '_for_' + moduleName);
        var other = $(this).val();
        $('#' + showId + '_container_for_' + moduleName + '').hide();
        if (other == VALUE_ONE || other == VALUE_TWO) {
            if (other == VALUE_ONE) {
                $('.utitle_for_' + moduleName).html('Challan Copy');
            } else {
                $('.utitle_for_' + moduleName).html('Payment Details');
            }
            $('#' + showId + '_container_for_' + moduleName + '').show();
            return false;
        }
    });
}

function getEncryptedId(id) {
    return generateRandomString(3) + window.btoa(id) + generateRandomString(3);
}

function getDescryptedId(encryptedId) {
    var tempString = encryptedId.substr(3);
    var tempString2 = tempString.substr(0, -3);
    return window.atob(tempString2);
}

function resetCounter(className) {
    var cnt = 1;
    $('.' + className).each(function () {
        $(this).html(cnt);
        cnt++;
    });
}

function returnCounter(className) {
    var cnt = 0;
    $('.' + className).each(function () {
        cnt++;
    });
    return cnt;
}

function resetCounterForDocument(className, startCounter) {
    $('.' + className).each(function () {
        var objNo = $(this);
        if (objNo.parent().parent().is(':visible')) {
            objNo.html(startCounter + '.');
            startCounter++;
        }
    });
}

function getTextOfId(dataArray, value, compareValue, otherValue) {
    var data = dataArray[value] ? dataArray[value] : '';
    if (compareValue != '' && otherValue != '') {
        if (value == compareValue) {
            data = data + '(' + otherValue + ')';
        }
    }
    return data;
}

var emailRenderer = function (data, type, full, meta) {
    return data.replace('@', '<br>@');
};

function removeDocument(id, moduleName) {
    $('#' + id + '_name_container_for_' + moduleName).hide();
    $('#' + id + '_container_for_' + moduleName).show();
    $('#' + id + '_name_href_for_' + moduleName).attr('href', '');
    $('#' + id + '_name_for_' + moduleName).html('');
    $('#' + id + '_remove_btn_for_' + moduleName).attr('onclick', '');
}

function removeRowDetails(moduleName, cnt) {
    $('#' + moduleName + '_row_' + cnt).remove();
    resetCounter(moduleName + '-cnt');
}

var _validFileExtensions = [".jpg", ".jpeg", ".png"];
//var _validFileExtensions = [".jpg", ".jpeg", ".png", ".pdf"];
var _imageFileExtensions = [".jpg", ".jpeg", ".png"];
function imagePdfValidation(oInput, message, imagePdfUploadAttrId) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                showError(message + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
            if (jQuery.inArray(sCurExtension, _imageFileExtensions) != -1) {
                if (($('#' + imagePdfUploadAttrId)[0].files[0].size / 1204) > maxFileSizeInKb) {
                    $('#' + imagePdfUploadAttrId).val('');
                    $('#' + imagePdfUploadAttrId).focus();
                    showError('Maximum upload size ' + maxFileSizeInKb + ' mb only in ' + message);
                    return false;
                }
            } else {
                if ((($('#' + imagePdfUploadAttrId)[0].files[0].size / 1024) / 1024) > maxFileSizeInMb) {
                    $('#' + imagePdfUploadAttrId).val('');
                    $('#' + imagePdfUploadAttrId).focus();
                    showError('Maximum upload size ' + maxFileSizeInMb + ' mb only in ' + message);
                    return true;
                }
            }
        }
    }
    return true;
}

function imagePdfUploadValidation(imageUploadAttrId, message, isValidateFileSize) {
    var allowedFiles = ['.jpg', '.png', '.jpeg'];
//    var allowedFiles = ['.jpg', '.png', '.jpeg', '.pdf'];
    var allowedFilesImage = ['.jpg', '.png', '.jpeg'];
    var imageName = $('#' + imageUploadAttrId).val();
    var fileExtension = imageName.replace(/^.*\./, '');
//    if (imageName.length > 0) {
    var regex = new RegExp('([a-zA-Z0-9\s_\\.\-:])+(' + allowedFiles.join('|') + ')$');

    if (!regex.test(imageName.toLowerCase())) {
        showError(message + ' <b>' + allowedFiles.join(', ') + '</b> only.');
        return true;
    }

    if (jQuery.inArray('.' + fileExtension, allowedFilesImage) != -1) {
        if (isValidateFileSize) {
            if (($('#' + imageUploadAttrId)[0].files[0].size / 1204) > maxFileSizeInKb) {
                $('#' + imageUploadAttrId).val('');
                $('#' + imageUploadAttrId).focus();
                showError('Maximum upload size ' + maxFileSizeInKb + 'kb only.');
                return true;
            }
        }
    } else {
        if (isValidateFileSize) {
            if ((($('#' + imageUploadAttrId)[0].files[0].size / 1024) / 1024) > maxFileSizeInMb) {
                $('#' + imageUploadAttrId).val('');
                $('#' + imageUploadAttrId).focus();
                showError('Maximum upload size ' + maxFileSizeInMb + ' mb only.');
                return true;
            }
        }
    }
//    }
    return false;
}

function loadQueryDocItemForViewQuestion(queryDocumentData, mainCnt) {
    var tempCnt = 1;
    $.each(queryDocumentData, function (index, docData) {
        docData.cnt = tempCnt;
        $('#document_item_container_for_query_view_' + mainCnt).append(documentItemViewTemplate(docData));
        if (docData.document) {
            $('#document_name_href_for_query_answer_view_' + tempCnt).attr('href', 'documents/query/' + docData['document']);
            $('#document_name_for_query_answer_view_' + tempCnt).html(docData['document']);
        }
        tempCnt++;
    });
}

function loadQueryDocItemForView(queryDocumentData, mainCnt) {
    var tempCnt = 1;
    $.each(queryDocumentData, function (index, docData) {
        docData.cnt = tempCnt;
        $('#document_item_container_for_query_answer_view_' + mainCnt).append(documentItemViewTemplate(docData));
        if (docData.document) {
            $('#document_name_href_for_query_answer_view_' + tempCnt).attr('href', QUERY_PATH + docData['document']);
            $('#document_name_for_query_answer_view_' + tempCnt).html(docData['document']);
        }
        tempCnt++;
    });
}

function checkValidationForSubmitQueryDetails() {
    validationMessageHide();
    var moduleType = $('#module_type_for_query').val();

    if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
            moduleType != VALUE_FOUR && moduleType != VALUE_FIVE && moduleType != VALUE_SIX &&
            moduleType != VALUE_SEVEN && moduleType != VALUE_EIGHT && moduleType != VALUE_NINE && moduleType != VALUE_TEN &&
            moduleType != VALUE_ELEVEN && moduleType != VALUE_TWELVE && moduleType != VALUE_THIRTEEN &&
            moduleType != VALUE_FOURTEEN && moduleType != VALUE_FIFTEEN && moduleType != VALUE_SIXTEEN && moduleType != VALUE_EIGHTEEN &&
            moduleType != VALUE_NINETEEN && moduleType != VALUE_TWENTY &&
            moduleType != VALUE_TWENTYTHREE && moduleType != VALUE_TWENTYFIVE && moduleType != VALUE_THIRTY) {
        return invalidAccessValidationMessage;
    }
    var moduleId = $('#module_id_for_query').val();
    if (!moduleId) {
        return invalidAccessValidationMessage;
    }
    var queryType = $('#query_type_for_query').val();
    if (queryType != VALUE_ONE && queryType != VALUE_TWO) {
        return invalidAccessValidationMessage;
    }
    var remarks = $('#remarks_for_query').val();
    if (!remarks) {
        return remarksValidationMessage;
    }
    return '';
}

function askForSubmitQueryDetails() {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    var validationMessage = checkValidationForSubmitQueryDetails();
    if (validationMessage != '') {
        $('#remarks_for_query').focus();
        validationMessageShow('query-remarks_for_query', validationMessage);
        return false;
    }
    var yesEvent = 'submitQueryDetails()';
    showConfirmation(yesEvent, 'Submit');
}

function getQDItems() {
    var newQDItems = [];
    var exiQDItems = [];
    var isQDItemValidation;
    $('.query_document_row').each(function () {
        var that = $(this);
        var tempCnt = that.find('.og_query_document_cnt').val();
        if (tempCnt == '' || tempCnt == null) {
            showError(invalidAccessMsg);
            isQDItemValidation = true;
            return false;
        }
        var qdItem = {};
        var docName = $('#doc_name_for_query_' + tempCnt).val();
        if (docName == '' || docName == null) {
            $('#doc_name_for_query_' + tempCnt).focus();
            validationMessageShow('query-doc_name_for_query_' + tempCnt, documentNameValidationMessage);
            isQDItemValidation = true;
            return false;
        }
        qdItem.doc_name = docName;
        if ($('#document_container_for_query_' + tempCnt).is(':visible')) {
            var uploadDoc = $('#document_for_query_' + tempCnt).val();
            if (!uploadDoc) {
                validationMessageShow('query-document_for_query_' + tempCnt, uploadDocValidationMessage);
                isQDItemValidation = true;
                return false;
            }
            var uploadDocMessage = fileUploadValidation('document_for_query_' + tempCnt, 2048);
            if (uploadDocMessage != '') {
                validationMessageShow('query-document_for_query_' + tempCnt, uploadDocMessage);
                isQDItemValidation = true;
                return false;
            }
        }

        var queryDocumentId = $('#query_document_id_for_query_' + tempCnt).val();
        if (!queryDocumentId || queryDocumentId == null) {
            newQDItems.push(qdItem);
        } else {
            qdItem.query_document_id = queryDocumentId;
            exiQDItems.push(qdItem);
        }
    });
    if (isQDItemValidation) {
        return false;
    }
    return {'new_qd_items': newQDItems, 'exi_qd_items': exiQDItems};
}

function submitQueryDetails() {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    var validationMessage = checkValidationForSubmitQueryDetails();
    if (validationMessage != '') {
        $('#remarks_for_query').focus();
        validationMessageShow('query-remarks_for_query', validationMessage);
        return false;
    }
    var formData = {};
    formData.query_id_for_query = $('#query_id_for_query').val();
    formData.module_type_for_query = $('#module_type_for_query').val();
    formData.module_id_for_query = $('#module_id_for_query').val();
    formData.query_type_for_query = $('#query_type_for_query').val();
    formData.remarks_for_query = $('#remarks_for_query').val();
    formData.new_qd_items = [];
    formData.exi_qd_items = [];
    var qdItems = getQDItems();
    if (!qdItems) {
        return false;
    }
    formData.new_qd_items = qdItems.new_qd_items;
    formData.exi_qd_items = qdItems.exi_qd_items;
    var btnObj = $('#submit_btn_for_query');
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/raise_a_query',
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
            $('html, body').animate({scrollTop: '0px'}, 0);
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
                $('html, body').animate({scrollTop: '0px'}, 0);
                return false;
            }
            showSuccess(parseData.message);
            var tempData = {};
            tempData.remarks = formData.remarks_for_query;
            tempData.datetime_text = parseData.query_datetime;
            tempData.query_by_name = parseData.query_by_name;
            if (!jQuery.isEmptyObject(parseData.query_document_data)) {
                tempData.show_document_container = true;
            }
            tempData.cnt = 1;
            $('#query_container').html(queryQuestionViewTemplate(tempData));
            $('#query_status_' + formData.module_id_for_query).html(queryStatusArray[parseData.query_status]);
            $('#query_ad_' + formData.module_id_for_query).html(parseData.query_by_name ? ('<hr>' + parseData.query_by_name + '<hr>' + parseData.query_datetime) : ' ');
            loadQueryDocItemForViewQuestion(parseData.query_document_data, tempData.cnt);
            $('#reject_btn_for_app_' + formData.module_id_for_query).hide();
            $('#approve_btn_for_app_' + formData.module_id_for_query).hide();
        }
    });
}

function askForResolvedQuery(moduleType, moduleId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
            moduleType != VALUE_FOUR && moduleType != VALUE_FIVE && moduleType != VALUE_SIX &&
            moduleType != VALUE_SEVEN && moduleType != VALUE_EIGHT && moduleType != VALUE_NINE && moduleType != VALUE_TEN &&
            moduleType != VALUE_ELEVEN && moduleType != VALUE_TWELVE && moduleType != VALUE_THIRTEEN &&
            moduleType != VALUE_FOURTEEN && moduleType != VALUE_FIFTEEN && moduleType != VALUE_SIXTEEN && moduleType != VALUE_EIGHTEEN &&
            moduleType != VALUE_NINETEEN && moduleType != VALUE_TWENTY &&
            moduleType != VALUE_TWENTYTHREE && moduleType != VALUE_TWENTYFIVE && moduleType != VALUE_THIRTY) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    if (!moduleId) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    showPopup();
    $('.swal2-popup').css('width', '35em');
    $('#popup_container').html(queryResolveTemplate({'module_type': moduleType, 'module_id': moduleId}));
//    var yesEvent = 'resolvedQuery(' + moduleType + ',' + moduleId + ')';
//    showConfirmation(yesEvent, 'Resolved Query');
}

function resolvedQuery(moduleType, moduleId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
            moduleType != VALUE_FOUR && moduleType != VALUE_FIVE && moduleType != VALUE_SIX &&
            moduleType != VALUE_SEVEN && moduleType != VALUE_EIGHT && moduleType != VALUE_NINE && moduleType != VALUE_TEN &&
            moduleType != VALUE_ELEVEN && moduleType != VALUE_TWELVE && moduleType != VALUE_THIRTEEN &&
            moduleType != VALUE_FOURTEEN && moduleType != VALUE_FIFTEEN && moduleType != VALUE_SIXTEEN && moduleType != VALUE_EIGHTEEN &&
            moduleType != VALUE_NINETEEN && moduleType != VALUE_TWENTY &&
            moduleType != VALUE_TWENTYTHREE && moduleType != VALUE_TWENTYFIVE && moduleType != VALUE_THIRTY) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    if (!moduleId) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var remarks = $('#remarks_for_query_resolve').val();
    if (!remarks) {
        $('#remarks_for_query_resolve').focus();
        validationMessageShow('query-resolve-remarks_for_query_resolve', remarksValidationMessage);
        return false;
    }
    var btnObj = $('#submit_resolved_btn_for_query_resolve');
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/resolved_query',
        data: $.extend({}, {'module_type': moduleType, 'module_id': moduleId, 'remarks': remarks}, getTokenData()),
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
                $('html, body').animate({scrollTop: '0px'}, 0);
                return false;
            }
            $('#query_status_' + moduleId).html(queryStatusArray[parseData.query_status]);
            $('#query_ad_' + moduleId).html(parseData.query_by_name ? ('<hr>' + parseData.query_by_name + '<hr>' + parseData.query_datetime) : ' ');
            resetModel();
            showSuccess(parseData.message);
            if (moduleType == VALUE_TWENTYTHREE || moduleType == VALUE_TWENTYFIVE) {
                if (parseData.status == VALUE_TWO &&
                        (parseData.query_status == VALUE_ZERO || parseData.query_status == VALUE_THREE)) {
                    $('#reject_btn_for_app_' + moduleId).show();
                }
            } else {
                if (parseData.status != VALUE_FIVE && parseData.status != VALUE_SIX &&
                        (parseData.query_status == VALUE_ZERO || parseData.query_status == VALUE_THREE)) {
                    $('#reject_btn_for_app_' + moduleId).show();
                }
            }
            if (moduleType == VALUE_ONE || moduleType == VALUE_TWO || moduleType == VALUE_THREE || moduleType == VALUE_FOUR ||
                    moduleType == VALUE_FIVE || moduleType == VALUE_SIX || moduleType == VALUE_TWELVE) {
                if ((parseData.status == VALUE_TWO || parseData.status == VALUE_THREE) &&
                        (parseData.query_status == VALUE_ZERO || parseData.query_status == VALUE_THREE)) {
                    $('#approve_btn_for_app_' + moduleId).show();
                }
            }
            if (moduleType == VALUE_THIRTEEN || moduleType == VALUE_TWENTYTHREE || moduleType == VALUE_TWENTYFIVE || moduleType == VALUE_THIRTY) {
                if (parseData.status == VALUE_FOUR && (parseData.query_status == VALUE_ZERO || parseData.query_status == VALUE_THREE)) {
                    $('#approve_btn_for_app_' + moduleId).show();
                }
            } else {
                if (parseData.status != VALUE_FIVE && parseData.status != VALUE_SIX &&
                        (parseData.query_status == VALUE_ZERO || parseData.query_status == VALUE_THREE)) {
                    $('#approve_btn_for_app_' + moduleId).show();
                }
            }
            $('#resolved_btn_for_query').remove();
        }
    });
}

function raiseAnotherQuery(moduleType, moduleId) {
    var templateData = {};
    templateData.datetime_text = '00-00-0000 00:00:00';
    templateData.query_type = VALUE_ONE;
    templateData.module_type = moduleType;
    templateData.module_id = moduleId;
    $('#query_item_container').prepend(queryQuestionTemplate(templateData));
    $('#raise_query_btn_for_query').hide();
}

function loadQueryManagementModule(parseData, templateData, tmpData) {
    documentRowCnt = 1;
    var moduleData = parseData.module_data;
    if (tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
        if ((moduleData.status != VALUE_FIVE && moduleData.status != VALUE_SIX) && (moduleData.query_status == VALUE_ONE || moduleData.query_status == VALUE_TWO)) {
            tmpData.show_resolve_query_btn = true;
        }
        if ((moduleData.status != VALUE_FIVE && moduleData.status != VALUE_SIX) && (moduleData.query_status == VALUE_TWO || moduleData.query_status == VALUE_THREE)) {
            tmpData.show_raise_query_btn = true;
        }
    }
    $('#model_title').html('Query Management');
    $('#model_body').html(queryFormTemplate(tmpData));
    var cnt = 1;
    $.each(parseData.query_data, function (index, qd) {
        qd.cnt = cnt;
        qd.show_extra_div = true;
        qd.datetime_text = qd.display_datetime;
        if (qd.query_type == VALUE_ONE) {
            if (qd.status == VALUE_ONE) {
                if (!jQuery.isEmptyObject(qd.query_documents)) {
                    qd.show_document_container = true;
                }
                $('#query_item_container').prepend(queryQuestionViewTemplate(qd));
                loadQueryDocItemForViewQuestion(qd.query_documents, cnt);
            } else {
                qd.datetime_text = '00-00-0000 00:00:00';
                $('#query_item_container').prepend(queryQuestionTemplate(qd));
                $.each(qd.query_documents, function (index, docData) {
                    addDocumentRow(docData);
                });
                $('#raise_query_btn_for_query').hide();
            }
        }
        if (qd.query_type == VALUE_TWO) {
            if (qd.status == VALUE_ONE) {
                if (!jQuery.isEmptyObject(qd.query_documents)) {
                    qd.show_document_container = true;
                }
                $('#query_item_container').prepend(queryAnswerViewTemplate(qd));
                loadQueryDocItemForView(qd.query_documents, cnt);
            }
        }
        if (qd.query_type == VALUE_THREE) {
            $('#query_item_container').prepend(queryResolveViewTemplate(qd));
        }
        cnt++;
    });
    if (tempTypeInSession != TEMP_TYPE_MAM_VIEW_USER) {
        if (moduleData.status == VALUE_TWO || moduleData.status == VALUE_THREE || moduleData.status == VALUE_FOUR || moduleData.status == VALUE_SEVEN || moduleData.status == VALUE_EIGHT) {
            if (cnt == 1) {
                raiseAnotherQuery(templateData.module_type, templateData.module_id);
            }
        }
    }
    $('#popup_modal').modal('show');
}

function addDocumentRow(templateData) {
    templateData.cnt = documentRowCnt;
    $('#document_item_container_for_query').append(documentItemTemplate(templateData));
    if (templateData.document) {
        loadQueryDocument('document', documentRowCnt, templateData);
    }
    resetCounter('query-document-cnt');
    documentRowCnt++;
}

function checkValidationForDocUpload() {
    validationMessageHide();
    var moduleType = $('#module_type_for_query').val();
    if (moduleType != VALUE_ONE && moduleType != VALUE_TWO && moduleType != VALUE_THREE &&
            moduleType != VALUE_FOUR && moduleType != VALUE_FIVE && moduleType != VALUE_SIX &&
            moduleType != VALUE_SEVEN && moduleType != VALUE_EIGHT && moduleType != VALUE_NINE && moduleType != VALUE_TEN &&
            moduleType != VALUE_ELEVEN && moduleType != VALUE_TWELVE && moduleType != VALUE_THIRTEEN &&
            moduleType != VALUE_FOURTEEN && moduleType != VALUE_FIFTEEN && moduleType != VALUE_SIXTEEN && moduleType != VALUE_EIGHTEEN &&
            moduleType != VALUE_NINETEEN && moduleType != VALUE_TWENTY &&
            moduleType != VALUE_TWENTYTHREE && moduleType != VALUE_TWENTYFIVE && moduleType != VALUE_THIRTY) {
        return invalidAccessValidationMessage;
    }
    var moduleId = $('#module_id_for_query').val();
    if (!moduleId) {
        return invalidAccessValidationMessage;
    }
    var queryType = $('#query_type_for_query').val();
    if (queryType != VALUE_ONE && queryType != VALUE_TWO) {
        return invalidAccessValidationMessage;
    }
    return '';
}

function uploadDocumentForQuery(tempCnt) {
    var validationMessage = checkValidationForDocUpload();
    if (validationMessage != '') {
        showError(validationMessage);
        return false;
    }
    var id = 'document_for_query_' + tempCnt;
    var doc = $('#' + id).val();
    if (doc == '') {
        return false;
    }
    var materialslipMessage = fileUploadValidation(id, 2048);
    if (materialslipMessage != '') {
        showError(materialslipMessage);
        return false;
    }
    $('#document_container_for_query_' + tempCnt).hide();
    $('#document_name_container_for_query_' + tempCnt).hide();
    $('#spinner_template_for_query_' + tempCnt).show();
    var formData = new FormData();
    formData.append('query_id_for_query', $('#query_id_for_query').val());
    formData.append('module_type_for_query', $('#module_type_for_query').val());
    formData.append('module_id_for_query', $('#module_id_for_query').val());
    formData.append('query_type_for_query', $('#query_type_for_query').val());
    formData.append('query_document_id_for_query', $('#query_document_id_for_query_' + tempCnt).val());
    formData.append('document_for_query', $('#' + id)[0].files[0]);
    $.ajax({
        type: 'POST',
        url: 'utility/upload_query_document',
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
            $('#spinner_template_for_query_' + tempCnt).hide();
            $('#document_container_for_query_' + tempCnt).show();
            $('#document_name_container_for_query_' + tempCnt).hide();
            $('#' + id).val('');
            showError(documentNotUploadedErrorValidationMessage);
        },
        success: function (data) {
            var parseData = JSON.parse(data);
            if (parseData.is_logout === true) {
                loginPage();
                return false;
            }
            if (parseData.success == false) {
                $('#spinner_template_for_query_' + tempCnt).hide();
                $('#document_container_for_query_' + tempCnt).show();
                $('#document_name_container_for_query_' + tempCnt).hide();
                $('#' + id).val('');
                showError(parseData.message);
                return false;
            }
            $('#spinner_template_for_query_' + tempCnt).hide();
            $('#document_name_container_for_query_' + tempCnt).hide();
            $('#' + id).val('');
            $('#query_id_for_query').val(parseData.query_id);
            $('#query_document_id_for_query_' + tempCnt).val(parseData.query_document_id);
            var docItemData = {};
            docItemData.query_document_id = parseData.query_document_id;
            docItemData.query_id = parseData.query_id;
            docItemData.document = parseData.document_name;
            loadQueryDocument('document', tempCnt, docItemData);
        }
    });
}

function loadQueryDocument(documentFieldName, cnt, docItemData) {
    $('#' + documentFieldName + '_container_for_query_' + cnt).hide();
    $('#' + documentFieldName + '_name_container_for_query_' + cnt).show();
    $('#' + documentFieldName + '_name_href_for_query_' + cnt).attr('href', 'documents/query/' + docItemData[documentFieldName]);
    $('#' + documentFieldName + '_name_for_query_' + cnt).html(docItemData[documentFieldName]);
    $('#' + documentFieldName + '_remove_btn_for_query_' + cnt).attr('onclick', 'askForRemoveDocumentRow("' + cnt + '")');
}


function askForRemoveDocumentRow(cnt) {
    var queryDocumentId = $('#query_document_id_for_query_' + cnt).val();
    if (!queryDocumentId || queryDocumentId == 0 || queryDocumentId == null) {
        removeDocumentItemRow(cnt);
        return false;
    }
    var yesEvent = 'removeDocumentRow(' + cnt + ')';
    showConfirmation(yesEvent, 'Remove');
}

function removeDocumentItemRow(cnt) {
    $('#query_document_row_' + cnt).remove();
    resetCounter('query-document-cnt');
}

function removeDocumentRow(cnt) {
    var queryDocumentId = $('#query_document_id_for_query_' + cnt).val();
    if (!queryDocumentId || queryDocumentId == 0 || queryDocumentId == null) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    $.ajax({
        type: 'POST',
        url: 'utility/remove_query_document_item',
        data: $.extend({}, {'query_document_id': queryDocumentId}, getTokenData()),
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
            removeDocumentItemRow(cnt);
        }
    });
}

function showTableContainer(id) {
    $('#' + id + '_form_container').hide();
    $('#' + id + '_datatable_container').show();
}

function showFormContainer(id) {
    $('#' + id + '_datatable_container').hide();
    $('#' + id + '_form_container').show();
}

function getTotal(btnObj) {

    var a = $('#contribution').val() == "" ? 0 : $('#contribution').val();
    var b = $('#term_loan').val() == "" ? 0 : $('#term_loan').val();
    var c = $('#unsecured_loan').val() == "" ? 0 : $('#unsecured_loan').val();
    var d = $('#accruals').val() == "" ? 0 : $('#accruals').val();

    var res = parseFloat(a) + parseFloat(b) + parseFloat(c) + parseFloat(d);
    $('#finance_total').val(res);
}

function getTotalInvestment(btnObj) {

    var a = $('#capital_subsidy').val() == "" ? 0 : $('#capital_subsidy').val();
    var b = $('#anum').val() == "" ? 0 : $('#anum').val();

    var res = parseFloat(a) + parseFloat(b);
    $('#cliam_amount_total').val(res);
}

function getTotalCliam(btnObj) {

    var a = $('#capital_cost').val() == "" ? 0 : $('#capital_cost').val();
    var b = $('#consutancy_fees').val() == "" ? 0 : $('#consutancy_fees').val();
    var c = $('#certification_charges').val() == "" ? 0 : $('#certification_charges').val();
    var d = $('#testing_equipments').val() == "" ? 0 : $('#testing_equipments').val();

    var res = parseFloat(a) + parseFloat(b) + parseFloat(c) + parseFloat(d);
    $('#cliam_amount_total').val(res);
}

function getTotalCliamAmount(btnObj) {

    var a = $('#audit_fees').val() == "" ? 0 : $('#audit_fees').val();
    var b = $('#equipment_cost').val() == "" ? 0 : $('#equipment_cost').val();

    var res = parseFloat(a) + parseFloat(b);
    $('#cliam_amount_total').val(res);
}

function getTotalAcquisition(btnObj) {

    var a = $('#purchase').val() == "" ? 0 : $('#purchase').val();
    var b = $('#technology_fees').val() == "" ? 0 : $('#technology_fees').val();
    var c = $('#other_detail').val() == "" ? 0 : $('#other_detail').val();

    var res = parseFloat(a) + parseFloat(b) + parseFloat(c);
    $('#upgradation_total').val(res);
}

function getTotalEmployee(btnObj) {

    var a = $('#direct_unskilled').val() == "" ? 0 : $('#direct_unskilled').val();
    var b = $('#direct_semiskilled').val() == "" ? 0 : $('#direct_semiskilled').val();
    var c = $('#direct_skilled').val() == "" ? 0 : $('#direct_skilled').val();

    var res = parseFloat(a) + parseFloat(b) + parseFloat(c);
    $('#direct_total').val(res);


    var d = $('#contractor_unskilled').val() == "" ? 0 : $('#contractor_unskilled').val();
    var e = $('#contractor_semiskilled').val() == "" ? 0 : $('#contractor_semiskilled').val();
    var f = $('#contractor_skilled').val() == "" ? 0 : $('#contractor_skilled').val();

    var res1 = parseFloat(d) + parseFloat(e) + parseFloat(f);
    $('#contractor_total').val(res1);

    var res2 = parseFloat(a) + parseFloat(d);
    $('#total_unskilled').val(res2);

    var res3 = parseFloat(b) + parseFloat(e);
    $('#total_semiskilled').val(res3);

    var res4 = parseFloat(c) + parseFloat(f);
    $('#total_skilled').val(res4);

    var res5 = parseFloat(res) + parseFloat(res1);
    $('#total_total').val(res5);


    var g = $('#direct_male').val() == "" ? 0 : $('#direct_male').val();
    var h = $('#contractor_male').val() == "" ? 0 : $('#contractor_male').val();

    var res6 = parseFloat(g) + parseFloat(h);
    $('#total_male').val(res6);

    var i = $('#direct_female').val() == "" ? 0 : $('#direct_female').val();
    var j = $('#contractor_female').val() == "" ? 0 : $('#contractor_female').val();

    var res7 = parseFloat(i) + parseFloat(j);
    $('#total_female').val(res7);

}

function getTotalWorker(id1, id2, id3) {
    var value1 = $('#' + id1).val();
    var value2 = $('#' + id2).val();
    var value3 = $('#' + id3);

    var a = value1 == "" ? 0 : value1;
    var b = value2 == "" ? 0 : value2;

    var res = parseFloat(a) + parseFloat(b);
    $(value3).val(res);
}


function getPlotData(obj, id, moduleName) {
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination([], id + '_for_' + moduleName, 'plot_id', 'plot_no', 'Plot No');
    $('#' + id + '_for_' + moduleName).val('');
    var villageCode = obj.val();
    if (!villageCode) {
        return;
    }
    var plotData = tempPlotData[villageCode] ? tempPlotData[villageCode] : [];
    renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(plotData, id + '_for_' + moduleName, 'plot_id', 'plot_no', 'Plot No');
    $('#' + id + '_for_' + moduleName).val('');
    this.getAreaData('plot_id', 'area');
}

function getAreaData(obj) {
    var villageCode = $('#villages_for_noc_data').val();
    $('#govt_industrial_estate_area').val('');
    if (!villageCode) {
        return false;
    }
    var plotId = obj.val();
    if (!plotId) {
        return false;
    }
    var plotsData = tempPlotData[villageCode] ? tempPlotData[villageCode] : [];
    var plotData = plotsData[plotId] ? plotsData[plotId] : [];
    $('#govt_industrial_estate_area').val(plotData.area ? plotData.area : '');
}

function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForPlot(dataArray, comboId, keyId, valueId, message) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="">Select ' + message + '</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            if (dataObject[is_vacant] == VALUE_ONE) {
                data = {"value_field": dataObject[keyId], 'text_field': dataObject[valueId]};
                optionResult = optionTemplate(data);
                $("#" + comboId).append(optionResult);
            }
        }
    });
}


function aadharNumberValidation(moduleName, id) {
    validationMessageHide(moduleName + '-' + id);
    var aadharNumber = $('#' + id).val();
    if (!aadharNumber) {
        return;
    }
    var validate = checkUID(aadharNumber);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
}

function checkUID(uid) {
    if (uid.length != 12) {
        return invalidAadharNumberValidationMessage;
    }
    var Verhoeff = {
        "d": [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]],
        "p": [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]],
        "j": [0, 4, 3, 2, 1, 5, 6, 7, 8, 9],
        "check": function (str) {
            var c = 0;
            str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {
                c = Verhoeff.d[c][Verhoeff.p[i % 8][parseInt(u, 10)]];
            });
            return c;

        },
        "get": function (str) {

            var c = 0;
            str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {
                c = Verhoeff.d[c][Verhoeff.p[(i + 1) % 8][parseInt(u, 10)]];
            });
            return Verhoeff.j[c];
        }
    };

    String.prototype.verhoeffCheck = (function () {
        var d = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]];
        var p = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]];

        return function () {
            var c = 0;
            this.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {
                c = d[c][p[i % 8][parseInt(u, 10)]];
            });
            return (c === 0);
        };
    })();

    if (Verhoeff['check'](uid) === 0) {
        return '';
    } else {
        return invalidAadharNumberValidationMessage;
    }
}

function yearPicker() {
    $('#yearPicker').datetimepicker({
        icons:
                {
                    up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down',
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
        format: "YYYY",
        viewMode: "years",
    });
}

function monthPicker() {
    $('#monthPicker').datetimepicker({
        icons:
                {
                    up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down',
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
        format: "MM",
        viewMode: "months",
    });
}
function calculateAge(moduleName) {
    var dob = document.getElementById("applicant_dob_" + moduleName).value;
    var newdate = dob.split("-").reverse().join("/");
    var dobDate = new Date(newdate);
    var nowDate = new Date();
    var diff = nowDate.getTime() - dobDate.getTime();
    var ageDate = new Date(diff); // miliseconds from epoch
    var age = Math.abs(ageDate.getUTCFullYear() - 1970);
    $('#applicant_age_' + moduleName).val(age);
}
function showOtherOccupationtext(occupationId, id, moduleName) {
    // alert('#' + id + '_for_' + moduleName);
    if (occupationId.value == VALUE_TEN) {
        $('#' + id + '_for_' + moduleName).show();
    } else {
        $('#' + id + '_for_' + moduleName).hide();
    }
}
function showOtherapplicantEducationtext(occupationId, id, moduleName) {
    // alert('#' + id + '_for_' + moduleName);
    if (occupationId.value == VALUE_FIVE) {
        $('#' + id + '_for_' + moduleName).show();
    } else {
        $('#' + id + '_for_' + moduleName).hide();
    }
}
function showOtherapplicantOccupationtext(occupationId, id, moduleName) {
    // alert('#' + id + '_for_' + moduleName);
    if (occupationId.value == VALUE_TWELVE) {
        $('#' + id + '_for_' + moduleName).show();
    } else {
        $('#' + id + '_for_' + moduleName).hide();
    }
}
function showParentOtherOccupationtext(occupationId, id, moduleName) {
    // alert('#' + id + '_for_' + moduleName);
    if (occupationId.value == VALUE_NINE) {
        $('#' + id + '_for_' + moduleName).show();
    } else {
        $('#' + id + '_for_' + moduleName).hide();
    }
}
function showOtherOccupationforChildrentext(occupationId, id, moduleName) {
    // alert('#' + id + '_for_' + moduleName);
    if (occupationId.value == VALUE_EIGHT) {
        $('#' + id + '_for_' + moduleName).show();
    } else {
        $('#' + id + '_for_' + moduleName).hide();
    }
}
function showOtherTypeOfPropertytext(occupationId, id, moduleName) {
    // alert('#' + id + '_for_' + moduleName);
    if (occupationId.value == VALUE_THREE) {
        $('#' + id + '_for_' + moduleName).show();
    } else {
        $('#' + id + '_for_' + moduleName).hide();
    }
}
function showOtherSourceOfIncometext(occupationId, id, moduleName) {
    // alert('#' + id + '_for_' + moduleName);
    if (occupationId.value == VALUE_TWO) {
        $('#' + id + '_for_' + moduleName).show();
    } else {
        $('#' + id + '_for_' + moduleName).hide();
    }
}
function showOtherReligionOfNCLtext(occupationId, id, moduleName) {
    // alert('#' + id + '_for_' + moduleName);
    if (occupationId.value == VALUE_FIVE) {
        $('#' + id + '_for_' + moduleName).show();
    } else {
        $('#' + id + '_for_' + moduleName).hide();
    }
}
function renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForCode(dataArray, comboId, keyId, valueId, message) {
    if (!dataArray) {
        return false;
    }
    $('#' + comboId).html('<option value="">Select ' + message + '</option>');
    var data = {};
    var optionResult = "";
    $.each(dataArray, function (index, dataObject) {
        if (dataObject != undefined && dataObject[keyId] != 0) {
            data = {"value_field": dataObject[keyId], 'text_field': dataObject[valueId]};
            optionResult = optionTemplate(data);
            $("#" + comboId).append(optionResult);
        }
    });
}

function getCommonData() {
    tempDeptData = [];
    tempVillageData = [];
    tempDiuVillageData = [];
    tempUVillageData = [];
    tempStateData = [];
    tempDistrictData = [];
    $.ajax({
        url: 'utility/get_common_data',
        type: 'post',
        async: false,
        error: function (textStatus, errorThrown) {
            showError(textStatus.statusText);
        },
        success: function (response) {
            var parseData = JSON.parse(response);
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                showError(parseData.message);
                return false;
            }
            tempDeptData = parseData.department_data;
            tempVillageData = parseData.village_data;
            tempDiuVillageData = parseData.diu_village_data;
            tempUVillageData = parseData.urban_village_data;
            tempStateData = parseData.state_data;
            tempDistrictData = parseData.district_data;
        }
    });
}

function indianCommaIncome(x) {
    x = parseFloat(x) ? parseFloat(x) : 0;
    x = x.toString();
    var afterPoint = '';
    if (x.indexOf('.') > 0)
        afterPoint = x.substring(x.indexOf('.'), x.length);
    x = Math.floor(x);
    x = x.toString();
    var lastThree = x.substring(x.length - 3);
    var otherNumbers = x.substring(0, x.length - 3);
    if (otherNumbers != '')
        lastThree = ',' + lastThree;
    return otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
}

var newAppStatusRenderer = function (data, type, full, meta) {
    return '<div id="status_' + data + '">' + (appStatusArray[full.status] ? appStatusArray[full.status] : appStatusArray[VALUE_ZERO]) + '</div>';
};

var formsAppStatusRenderer = function (data, type, full, meta) {

    var returnString = '<div id="status_' + data + '">' + (fAppStatusArray[full.status] ? fAppStatusArray[full.status] : fAppStatusArray[VALUE_ZERO]) + '</div>';
    returnString += '<div id="appointment_by_name_' + data + '">';
    if (full.appointment_status == VALUE_ONE) {
        returnString += '<hr>' + full.appointment_by_name;
    }
    returnString += '</div>';
    if (full.plan_status) {
        returnString += (full.status == VALUE_TWO || full.status == VALUE_THREE ? '' : ('<div id="plan_status_' + data + '">' + (eocsPlanStatusArray[full.plan_status] ? '<hr>' + eocsPlanStatusArray[full.plan_status] : '') + '</div>'));
    }
    return returnString;
};
var formsSRORAppStatusRenderer = function (data, type, full, meta) {

    var returnString = '<div id="status_' + data + '">' + (fAppStatusArray[full.status] ? fAppStatusArray[full.status] : fAppStatusArray[VALUE_ZERO]) + '</div>';
    returnString += '<div id="appointment_by_name_' + data + '">';
    if (full.appointment_status == VALUE_ONE) {
        returnString += '<hr>' + full.appointment_by_name;
    }
    returnString += '</div>';
    if (full.plan_status) {
        returnString += ('<div id="plan_status_' + data + '">' + (eocsPlanStatusArray[full.plan_status] ? '<hr>' + eocsPlanStatusArray[full.plan_status] : '') + '</div>');
    }
    return returnString;
};

function movementString(full) {
    var returnString = '<table class="table table-bordered mb-0 bg-beige f-s-app-details table-lh1">';
    if (full.aci_to_ldc == VALUE_ZERO && full.aci_rec_reverify == VALUE_TWO) {
        if (full.aci_to_reverify_datetime != '0000-00-00 00:00:00') {
            returnString += '<tr><td><b>Reverify : </b>' + (full.mamlatdar_name) +
                    '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_reverify_datetime) + '</td></tr>';
        }
    }
    if (full.ldc_to_mamlatdar != VALUE_ZERO && full.aci_rec_reverify == VALUE_ONE) {
        returnString += '<tr><td><b>Reverify : </b>' + full.mamlatdar_name +
                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.ldc_to_mamlatdar_datetime) + '</td></tr>';
    }
    if (full.aci_to_ldc != VALUE_ZERO && full.aci_rec_reverify == VALUE_ONE) {
        if (full.aci_to_reverify_datetime != '0000-00-00 00:00:00') {
            returnString += '<tr><td><b>Reverify : </b>' + (full.ldc_name) +
                    '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_reverify_datetime) + '</td></tr>';
        }
    }
    if (full.talathi_to_type_reverify != VALUE_ZERO) {
        returnString += '<tr><td><b>Reverify : </b>' + (full.talathi_to_type_reverify == VALUE_ONE ? full.aci_name : full.mamlatdar_name) +
                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.talathi_to_reverify_datetime) + '</td></tr>';
    }
    if (full.to_type_reverify != VALUE_ZERO) {
        returnString += '<tr><td><b>Reverify : </b>' + (full.to_type_reverify == VALUE_ONE ? full.talathi_name : full.aci_name) +
                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.mam_to_reverify_datetime) + '</td></tr>';
    }
    if (full.ldc_to_mamlatdar != VALUE_ZERO && full.aci_rec_reverify == VALUE_ZERO) {
        returnString += '<tr><td>' + full.mamlatdar_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.ldc_to_mamlatdar_datetime) + '</td></tr>';
    }
    if (full.aci_to_ldc != VALUE_ZERO && full.aci_rec_reverify == VALUE_ZERO) {
        returnString += '<tr><td>' + full.ldc_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_ldc_datetime) + '</td></tr>';
    }
    if (full.aci_to_mamlatdar != VALUE_ZERO) {
        returnString += '<tr><td>' + full.mamlatdar_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_mamlatdar_datetime) + '</td></tr>';
    }
    if (full.talathi_to_aci != VALUE_ZERO) {
        returnString += '<tr><td>' + full.aci_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.talathi_to_aci_datetime) + '</td></tr>';
    }
    if (full.appointment_datetime != '0000-00-00 00:00:00') {
        returnString += '<tr><td>' + full.appointment_by_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.appointment_datetime) + '</td></tr>';
    } else if (full.appointment_datetime == '0000-00-00 00:00:00' && full.talathi_to_aci != VALUE_ZERO) {
        returnString += '<tr><td>' + full.talathi_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.talathi_to_aci_datetime) + '</td></tr>';
    }
    returnString += '</table>';
    return returnString;
}

function movementStringMigrant(full) {
    var returnString = '<table class="table table-bordered mb-0 bg-beige f-s-app-details table-lh1">';
    if (full.ldc_to_mamlatdar != VALUE_ZERO && full.aci_rec_reverify == VALUE_THREE) {
        returnString += '<tr><td><b>Reverify : </b>' + full.mamlatdar_name +
                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.ldc_to_mamlatdar_datetime) + '</td></tr>';
    }
    if (full.aci_to_ldc != VALUE_ZERO && full.aci_rec_reverify == VALUE_THREE) {
        if (full.aci_to_reverify_datetime != '0000-00-00 00:00:00') {
            returnString += '<tr><td><b>Reverify : </b>' + (full.ldc_name) +
                    '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_reverify_datetime) + '</td></tr>';
        }
    }
    if (full.aci_to_ldc == VALUE_ZERO && full.aci_rec_reverify == VALUE_TWO) {
        if (full.aci_to_reverify_datetime != '0000-00-00 00:00:00') {
            returnString += '<tr><td><b>Reverify : </b>' + (full.mamlatdar_name) +
                    '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_reverify_datetime) + '</td></tr>';
        }
    }
    if (full.ldc_to_mamlatdar != VALUE_ZERO && full.aci_rec_reverify == VALUE_ONE) {
        returnString += '<tr><td><b>Reverify : </b>' + full.mamlatdar_name +
                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.ldc_to_mamlatdar_datetime) + '</td></tr>';
    }
    if (full.aci_to_ldc != VALUE_ZERO && full.aci_rec_reverify == VALUE_ONE) {
        if (full.aci_to_reverify_datetime != '0000-00-00 00:00:00') {
            returnString += '<tr><td><b>Reverify : </b>' + (full.ldc_name) +
                    '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_reverify_datetime) + '</td></tr>';
        }
    }
    if (full.talathi_to_type_reverify != VALUE_ZERO) {
        returnString += '<tr><td><b>Reverify : </b>' + (full.talathi_to_type_reverify == VALUE_ONE ? full.aci_name : full.mamlatdar_name) +
                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.talathi_to_reverify_datetime) + '</td></tr>';
    }
    if (full.to_type_reverify != VALUE_ZERO) {
        returnString += '<tr><td><b>Reverify : </b>' + (full.to_type_reverify == VALUE_ONE ? full.talathi_name : full.aci_name) +
                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.mam_to_reverify_datetime) + '</td></tr>';
    }
    if (full.ldc_to_mamlatdar != VALUE_ZERO && full.aci_rec_reverify == VALUE_ZERO) {
        returnString += '<tr><td>' + full.mamlatdar_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.ldc_to_mamlatdar_datetime) + '</td></tr>';
    }
    if (full.aci_to_ldc != VALUE_ZERO && full.aci_rec_reverify == VALUE_ZERO) {
        returnString += '<tr><td>' + full.ldc_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_ldc_datetime) + '</td></tr>';
    }
    if (full.ldc_to_mamlatdar != VALUE_ZERO && (full.aci_rec_reverify == VALUE_THREE || full.aci_rec_reverify == VALUE_ONE)) {
        returnString += '<tr><td>' + full.mamlatdar_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.ldc_to_mamlatdar_datetime) + '</td></tr>';
    }
    if (full.aci_rec == VALUE_THREE) {
        if (full.aci_to_m_ldc != VALUE_ZERO && (full.aci_rec_reverify == VALUE_ZERO || full.aci_rec_reverify == VALUE_ONE || full.aci_rec_reverify == VALUE_TWO || full.aci_rec_reverify == VALUE_THREE)) {
            returnString += '<tr><td><b>Migration: </b>' + full.ldc_name_m + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_m_ldc_datetime) + '</td></tr>';
        }
    }
    if (full.aci_to_mamlatdar != VALUE_ZERO) {
        returnString += '<tr><td>' + full.mamlatdar_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_mamlatdar_datetime) + '</td></tr>';
    }
    if (full.talathi_to_aci != VALUE_ZERO) {
        returnString += '<tr><td>' + full.aci_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.talathi_to_aci_datetime) + '</td></tr>';
    }
    if (full.appointment_datetime != '0000-00-00 00:00:00') {
        returnString += '<tr><td>' + full.appointment_by_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.appointment_datetime) + '</td></tr>';
    } else if (full.appointment_datetime == '0000-00-00 00:00:00' && full.talathi_to_aci != VALUE_ZERO) {
        returnString += '<tr><td>' + full.talathi_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.talathi_to_aci_datetime) + '</td></tr>';
    }
    returnString += '</table>';
    return returnString;
}

function movementStringForCharacterCertificate(full) {
    var returnString = '<table class="table table-bordered mb-0 bg-beige f-s-app-details table-lh1">';
    if (full.sdpo_status != VALUE_ZERO) {
        returnString += '<tr><td>' + full.mamlatdar_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.sdpo_status_datetime) + '</td></tr>';
    }
    if (full.mamlatdar_to_sdpo != VALUE_ZERO) {
        returnString += '<tr><td>' + full.sdpo_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.mamlatdar_to_sdpo_datetime) + '</td></tr>';
    }
    if (full.ldc_to_mamlatdar != VALUE_ZERO) {
        returnString += '<tr><td>' + full.mamlatdar_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.ldc_to_mamlatdar_datetime) + '</td></tr>';
    }
    returnString += '</table>';
    return returnString;
}

function dashboardNaviationToDAPVR(sStatus, sMonthStatus) {
    var sDisplayText = '';
    if (typeof sStatus === "undefined") {
        sStatus = '';
    } else {
        sDisplayText += caseStatusArray[sStatus] ? caseStatusArray[sStatus] : '';
    }
    if (typeof sMonthStatus === "undefined") {
        sMonthStatus = '';
    } else {

    }
    var returnData = {};
    if (sMonthStatus == VALUE_ONE) {
        returnData.s_display_text = sDisplayText + '<span class="badge bg-gradient-gray app-status">: This Month</span>';
    } else if (sMonthStatus == VALUE_TWO) {
        returnData.s_display_text = sDisplayText + '<span class="badge bg-gradient-indigo app-status">: Next Month</span>';
    } else {
        returnData.s_display_text = sDisplayText;
    }

    returnData.search_status = sStatus;
    returnData.search_month_status = sMonthStatus;
    return returnData;
}

function casemovementString(full) {
    var returnString = '<table class="table table-bordered mb-0 bg-beige f-s-app-details table-lh1">';
    if (full.register_date != '0000-00-00') {
        returnString += '<tr><td>' + full.talathi_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.register_date) + '</td></tr>';
    }
//    if (full.talathi_to_aci != VALUE_ZERO) {
//        returnString += '<tr><td>' + full.aci_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.talathi_to_aci_datetime) + '</td></tr>';
//    }
    if (full.talathi_to_mamlatdar != VALUE_ZERO) {
        returnString += '<tr><td>' + full.mamlatdar_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.talathi_to_mamlatdar_datetime) + '</td></tr>';
    }
//    if (full.aci_rec == VALUE_THREE) {
//        if (full.aci_to_m_ldc != VALUE_ZERO && (full.aci_rec_reverify == VALUE_ZERO || full.aci_rec_reverify == VALUE_ONE || full.aci_rec_reverify == VALUE_THREE)) {
//            returnString += '<tr><td><b>Re-Migration: </b>' + full.ldc_name_m + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_m_ldc_datetime) + '</td></tr>';
//        }
//    }
//    if (full.aci_to_ldc != VALUE_ZERO && full.aci_rec_reverify == VALUE_ZERO) {
//        returnString += '<tr><td>' + full.ldc_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_ldc_datetime) + '</td></tr>';
//    }
//    if (full.ldc_to_mamlatdar != VALUE_ZERO && full.aci_rec_reverify == VALUE_ZERO) {
//        returnString += '<tr><td>' + full.mamlatdar_name + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.ldc_to_mamlatdar_datetime) + '</td></tr>';
//    }
//    if (full.to_type_reverify != VALUE_ZERO) {
//        returnString += '<tr><td><b>Reverify : </b>' + (full.to_type_reverify == VALUE_ONE ? full.talathi_name : full.aci_name) +
//                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.mam_to_reverify_datetime) + '</td></tr>';
//    }
//    if (full.talathi_to_type_reverify != VALUE_ZERO) {
//        returnString += '<tr><td><b>Reverify : </b>' + (full.talathi_to_type_reverify == VALUE_ONE ? full.aci_name : full.mamlatdar_name) +
//                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.talathi_to_reverify_datetime) + '</td></tr>';
//    }
//    if (full.aci_to_ldc != VALUE_ZERO && full.aci_rec_reverify == VALUE_ONE) {
//        if (full.aci_to_reverify_datetime != '0000-00-00 00:00:00') {
//            returnString += '<tr><td><b>Reverify : </b>' + (full.ldc_name) +
//                    '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_reverify_datetime) + '</td></tr>';
//        }
//    }
//    if (full.ldc_to_mamlatdar != VALUE_ZERO && full.aci_rec_reverify == VALUE_ONE) {
//        returnString += '<tr><td><b>Reverify : </b>' + full.mamlatdar_name +
//                '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.ldc_to_mamlatdar_datetime) + '</td></tr>';
//    }
//
//    if (full.aci_to_ldc == VALUE_ZERO && full.aci_rec_reverify == VALUE_TWO) {
//        if (full.aci_to_reverify_datetime != '0000-00-00 00:00:00') {
//            returnString += '<tr><td><b>Reverify : </b>' + (full.mamlatdar_name) +
//                    '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_reverify_datetime) + '</td></tr>';
//        }
//    }
//    if (full.aci_rec == VALUE_THREE) {
//        if (full.aci_to_ldc == VALUE_ZERO && full.aci_rec_reverify == VALUE_THREE) {
//            if (full.aci_to_reverify_datetime != '0000-00-00 00:00:00') {
//                returnString += '<tr><td><b>Re-Migration : </b>' + (full.mamlatdar_name) +
//                        '</td><td class="text-center">' + dateTo_DD_MM_YYYY(full.aci_to_reverify_datetime) + '</td></tr>';
//            }
//        }
//    }
    returnString += '</table>';
    return returnString;
}


function checkValidationForPAN(moduleName, id) {
    validationMessageHide(moduleName + '-' + id);
    var panNumber = $('#' + id).val();
    if (!panNumber) {
        return false;
    }
    var validate = PANValidation(panNumber);
    if (validate != '') {
        validationMessageShow(moduleName + '-' + id, validate);
        return false;
    }
}

function PANValidation(panNumber) {
    var filter = /[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$/;
    if (!filter.test(panNumber)) {
        return invalidPANValidationMessage;
    }
    return '';
}

function getDRAppStatusString(status) {
    return drAppStatusArray[status] ? drAppStatusArray[status] : '';
}

function returnFees(full) {
    return (full.fee_receipt_number != VALUE_ZERO ? '<hr><span class="badge bg-primary app-status">Fees : ' + full.total_fees + '/-</span>' : '');
}

function loadMap(mapId, latClass, lngClass, mapData, allowOnClick) {
    if (typeof allowOnClick === "undefined") {
        allowOnClick = false;
    }
    var map = L.map(mapId).setView([mapData.lat, mapData.lng], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; NIC Daman'
    }).addTo(map);
    var popup = L.popup();
    if (allowOnClick) {
        popup.setLatLng(mapData)
                .setContent('Selected LatLng(' + mapData.lat + ',' + mapData.lng + ')')
                .openOn(map);
        map.on('click', onMapClick);
        function onMapClick(e) {
            popup
                    .setLatLng(e.latlng)
                    .setContent("Selected " + e.latlng.toString())
                    .openOn(map);

            $('.' + latClass).val((e['latlng'].lat).toFixed(6));
            $('.' + lngClass).val((e['latlng'].lng).toFixed(6));
        }
    } else {
        var marker = L.marker([mapData.lat, mapData.lng]).addTo(map);
        marker.bindPopup('Selected LatLng(' + mapData.lat + ',' + mapData.lng + ')').openPopup();
    }
}

function openFullPageOverlay() {
    document.getElementById("full_page_overlay_div").style.width = "100%";
}

function closeFullPageOverlay() {
    document.getElementById("full_page_overlay_div").style.width = "0%";
}

function queryStatus(status) {
    return queryStatusArray[status] ? queryStatusArray[status] : queryStatusArray[VALUE_ZERO];
}

function dashboardNaviationToDocumentRegistration(searchStatus, searchModule) {
    if (typeof searchStatus === "undefined") {
        searchStatus = '';
    }
    var returnData = {};
    returnData.search_dr_status = '';
    returnData.search_dr_qstatus = '';
    returnData.search_dr_appd = '';
    console.log(searchModule);
    if (searchModule == VALUE_ONE) {
        returnData.search_dr_status = searchStatus;
    } else if (searchModule == VALUE_TWO) {
        returnData.search_dr_qstatus = searchStatus;
    } else if (searchModule == VALUE_THREE) {
        if (searchStatus == VALUE_ONE) {
            returnData.search_dr_appd = getPerviousDateTo_DD_MM_YYYY(VALUE_ONE);
        } else if (searchStatus == VALUE_TWO) {
            returnData.search_dr_appd = dateTo_DD_MM_YYYY();
        } else if (searchStatus == VALUE_ONE) {
            returnData.search_dr_appd = getNextDateTo_DD_MM_YYYY(VALUE_ONE);
        }
    }
    return returnData;
}

var appRejDetailsRenderer = function (data, type, full, meta) {
    if (full.status == VALUE_FIVE || full.status == VALUE_SIX) {
        return  '<b><i class="fas fa-user f-s-10px"></i></b> :- ' + full.actioner_user_name + '<hr><b><i class="fas fa-calendar f-s-10px"></i></b> :- ' + dateTo_DD_MM_YYYY_HH_II_SS(full.status_datetime) + '<hr><b><i class="fas fa-comment f-s-10px"></i></b> :- ' + full.remarks;
    } else {
        return '-';
    }
};

function gaHistorymovementString(full) {
    var data = JSON.parse(full.application_history);
    data.reverse();
    var returnString = '<table class="table table-bordered mb-0 bg-beige f-s-app-details table-lh1">';
    for (var i = 0; i < data.length; i++) {
        returnString += '<tr>';
        returnString += '<td>' + data[i].forwarded_to_user_name + '</td>';
        returnString += '<td>' + dateTo_DD_MM_YYYY(data[i].forwarded_datetime) + '</td>';
        returnString += '</tr>';
    }
    returnString += '</table>';
    return returnString;
}

function returnFieldNameFromJSON(basicDetailData, fieldDetails, fieldName, returnField) {
    basicDetailData[returnField] = '';
    if (basicDetailData[fieldDetails] != '') {
        var fd = JSON.parse(basicDetailData[fieldDetails]);
        if (fd[fieldName]) {
            basicDetailData[returnField] = fd[fieldName];
        }
    }
    return basicDetailData;
}

function ldcAppDetails(basicDetailData, appField, lAppNameField, returnField) {
    if (basicDetailData.aci_to_m_ldc) {
        if ((basicDetailData.aci_to_ldc != VALUE_ZERO || basicDetailData.aci_to_m_ldc != VALUE_ZERO) && basicDetailData[lAppNameField] != '' &&
                basicDetailData[appField] != basicDetailData[lAppNameField]) {
            basicDetailData[returnField] = basicDetailData[lAppNameField];
        } else {
            basicDetailData[returnField] = basicDetailData[appField];
        }
    } else {
        if ((basicDetailData.aci_to_ldc != VALUE_ZERO) && basicDetailData[lAppNameField] != '' &&
                basicDetailData[appField] != basicDetailData[lAppNameField]) {
            basicDetailData[returnField] = basicDetailData[lAppNameField];
        } else {
            basicDetailData[returnField] = basicDetailData[appField];
        }
    }
    return basicDetailData;
}

function dtomMam(sDistrict, sType, resetPageEvent) {
    var returnData = {};
    returnData.s_app_status = '';
    returnData.s_co_hand = '';
    returnData.s_qstatus = '';
    returnData.s_status = '';
    returnData.s_appd = '';
    returnData.s_is_full = '';
    var sDisplayText = '';
    if (typeof sDistrict == "undefined") {
        sDistrict = '';
    } else {
        sDisplayText += (talukaArray[sDistrict] ? '<span class="badge bg-info app-status">' + talukaArray[sDistrict] + '</span>' : '');
    }
    returnData.search_district = sDistrict;
    if (typeof sType == "undefined") {
        sType = '';
    } else {
        var tempText = '';
        if (sType == VALUE_FOUR || sType == VALUE_SEVEN) {
            if (tempTypeInSession == TEMP_TYPE_TALATHI_USER && sType == VALUE_SEVEN) {
                tempText += '<span class="badge bg-success app-status">Appointment Scheduled (Currently On Hand)</span>';
                returnData.s_co_hand = VALUE_ONE;
            } else if ((tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER) && sType == VALUE_FOUR) {
                tempText += '<span class="badge bg-warning app-status">New Applications (Currently On Hand)</span>';
                returnData.s_co_hand = VALUE_ONE;
            } else {
                tempText += (sType == VALUE_FOUR ? '<span class="badge bg-warning app-status">New Applications</span>' : '<span class="badge bg-success app-status">Appointment Scheduled</span>');
            }
            returnData.s_app_status = sType == VALUE_FOUR ? sType : VALUE_FIVE;
        } else if (sType == VALUE_ONE || sType == VALUE_TWO) {
            tempText += (queryStatusArray[sType] ? queryStatusArray[sType] : '');
            returnData.s_qstatus = sType;
        } else if (sType == VALUE_EIGHT) {
            tempText += '<span class="badge bg-secondary app-status">Forwarded</span>';
            returnData.s_co_hand = VALUE_TWO;
        } else if (sType == VALUE_NINE) {
            tempText += '<span class="badge bg-orange app-status">New Reverification (Currently On Hand)</span>';
            returnData.s_co_hand = VALUE_THREE;
        } else if (sType == VALUE_TEN) {
            tempText += '<span class="badge bg-orange app-status">Forwarded Reverification</span>';
            returnData.s_co_hand = VALUE_FOUR;
        } else if (tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER && sType == VALUE_ELEVEN) {
            tempText += '<span class="badge bg-orange app-status">Received Reverification (Currently On Hand)</span>';
            returnData.s_co_hand = VALUE_THREE;
        } else if (sType == VALUE_ZERO) {
            returnData.s_is_full = VALUE_ZERO;
        } else {
            tempText += (appStatusArray[sType] ? appStatusArray[sType] : '');
            returnData.s_status = sType;
        }
        sDisplayText += tempText != '' ? ' <b>></b> ' + tempText : '';
    }
    if (sDisplayText != '') {
        sDisplayText += ' : <span class="badge bg-danger app-status cursor-pointer" style="padding: 7px !important;" ' +
                'onclick="' + resetPageEvent + '"><i class="fas fa-sync-alt"></i>&nbsp; Reset Search</span>';
    }
    returnData.s_display_text = sDisplayText;
    return returnData;
}
function dtomFeesStatus(sDistrict, sType, resetPageEvent, pgpcType) {
    var returnData = {};
    returnData.s_qstatus = '';
    returnData.s_status = '';
    returnData.s_is_full = '';
    var sDisplayText = '';
    if (typeof sDistrict == "undefined") {
        sDistrict = '';
    } else {
        sDisplayText += (talukaArray[sDistrict] ? '<span class="badge bg-info app-status">' + talukaArray[sDistrict] + '</span>' : '');
    }
    returnData.search_district = sDistrict;
    if (typeof sType == "undefined") {
        sType = '';
    } else {
        var tempText = '';
        if (sType == VALUE_ONE || sType == VALUE_SEVEN) {
            sType = sType == VALUE_SEVEN ? VALUE_TWO : sType;
            tempText += (queryStatusArray[sType] ? queryStatusArray[sType] : '');
            returnData.s_qstatus = sType;
        } else if (sType == VALUE_ZERO) {
            returnData.s_is_full = VALUE_ZERO;
        } else {
            tempText += (dashfAppStatusArray[sType] ? dashfAppStatusArray[sType] : '');
            returnData.s_status = sType;
        }

        sDisplayText += tempText != '' ? ' <b>></b> ' + tempText : '';
    }
    if (typeof pgpcType == "undefined") {
        pgpcType = '';
    } else {
        var pgpcText = (eocsPlanStatusArray[pgpcType] ? eocsPlanStatusArray[pgpcType] : '');
        returnData.s_plan_status = pgpcType;
        sDisplayText += (' <b>></b> ' + pgpcText);
    }
    if (sDisplayText != '') {
        sDisplayText += ' : <span class="badge bg-danger app-status cursor-pointer" style="padding: 7px !important;" ' +
                'onclick="' + resetPageEvent + '"><i class="fas fa-sync-alt"></i>&nbsp; Reset Search</span>';
    }
    returnData.s_display_text = sDisplayText != '' ? '<div class="card-header">' + sDisplayText + '</div>' : sDisplayText;
    return returnData;
}

function dtoGAStatus(sDistrict, sType, resetPageEvent, pgpcType) {
    var returnData = {};
    returnData.s_qstatus = '';
    returnData.s_status = '';
    returnData.s_is_full = '';
    var sDisplayText = '';
    if (typeof sDistrict == "undefined") {
        sDistrict = '';
    } else {
        sDisplayText += (talukaArray[sDistrict] ? '<span class="badge bg-info app-status">' + talukaArray[sDistrict] + '</span>' : '');
    }
    returnData.search_district = sDistrict;
    if (typeof sType == "undefined") {
        sType = '';
    } else {
        var tempText = '';
        if (sType == VALUE_ONE || sType == VALUE_SEVEN) {
            sType = sType == VALUE_SEVEN ? VALUE_TWO : sType;
            tempText += (queryStatusArray[sType] ? queryStatusArray[sType] : '');
            returnData.s_qstatus = sType;
        } else if (sType == VALUE_ONE || sType == VALUE_TWO) {
            tempText += (queryStatusArray[sType] ? queryStatusArray[sType] : '');
            returnData.s_qstatus = sType;
        } else if (sType == VALUE_ZERO) {
            returnData.s_is_full = VALUE_ZERO;
        } else if (sType == VALUE_THREE) {
            tempText += '<span class="badge bg-orange app-status">New (Currently On Hand)</span>';
            returnData.s_co_hand = VALUE_ONE;
        } else if (sType == VALUE_FOUR) {
            tempText += '<span class="badge bg-orange app-status">Forwarded </span>';
            returnData.s_co_hand = VALUE_TWO;
        } else {
            tempText += (appStatusArray[sType] ? appStatusArray[sType] : '');
            returnData.s_status = sType;
        }

        sDisplayText += tempText != '' ? ' <b>></b> ' + tempText : '';
    }
    if (typeof pgpcType == "undefined") {
        pgpcType = '';
    }
    if (sDisplayText != '') {
        sDisplayText += ' : <span class="badge bg-danger app-status cursor-pointer" style="padding: 7px !important;" ' +
                'onclick="' + resetPageEvent + '"><i class="fas fa-sync-alt"></i>&nbsp; Reset Search</span>';
    }
    returnData.s_display_text = sDisplayText != '' ? '<div class="card-header">' + sDisplayText + '</div>' : sDisplayText;
    return returnData;
}

function loadAppointmentHistory(moduleName, appointmentData) {
    if (appointmentData.appointment_history != '') {
        var historyData = JSON.parse(appointmentData.appointment_history);
        var historyCnt = 1;
        $.each(historyData, function (index, aph) {
            var aphRow = '<tr>';
            if (historyData.length == historyCnt) {
                aphRow = '<tr class="bg-success disabled">';
            }
            aphRow += '<td class="text-center">' + historyCnt + '</td><td class="text-center">' + dateTo_DD_MM_YYYY(aph.appointment_date) + '</td>' +
                    '<td class="text-center">' + aph.appointment_time + '</td><td class="text-center">' + appointmentTypeArray[aph.appointment_type] + '</td><td class="text-center">' + aph.appointment_by_name + '</td></tr>';
            $('#appointment_history_container_for_' + moduleName).append(aphRow);
            historyCnt++;
        });
    } else {
        $('#appointment_history_container_for_' + moduleName).html('<tr><td colspan="5" class="text-center">Appointment Not Available !</td></tr>');
    }
}

function changeBorderColor(moduleId, moduleName, mName) {
    var userIncome = parseInt($('#' + mName + '_for_' + moduleName).val());
    var talathiIncome = parseInt($('#' + moduleId + '_for_' + moduleName).val());
    if (!talathiIncome || userIncome > talathiIncome) {
        document.getElementById(moduleId + '_for_' + moduleName).style.border = "2px solid red";
    } else {
        document.getElementById(moduleId + '_for_' + moduleName).style.border = "";
    }
}

function changeTextBorderColor(moduleId, mName) {
    var userIncome = parseInt($('#' + mName).val());
    var talathiIncome = parseInt($('#' + moduleId).val());
    if (!talathiIncome || userIncome > talathiIncome) {
        document.getElementById(moduleId).style.border = "2px solid red";
    } else {
        document.getElementById(moduleId).style.border = "";
    }
}

function viewFPaymentDetails(btnObj, moduleType, moduleId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleType || !moduleId) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/get_f_payment_details',
        data: $.extend({}, {'module_type': moduleType, 'module_id': moduleId}, getTokenData()),
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
            showFeeDetails(moduleType, moduleId, parseData.module_data);
        }
    });
}

function showFeeDetails(moduleType, moduleId, moduleData) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    showPopup();
    $('.swal2-popup').css('width', '55em');
    moduleData.payment_type = moduleData.payment_type == VALUE_ZERO ? VALUE_ONE : moduleData.payment_type;
    moduleData.module_type = moduleType;
    moduleData.module_id = moduleId;
    if (moduleType == VALUE_NINE || moduleType == VALUE_FOURTEEN || moduleType == VALUE_FIFTEEN || moduleType == VALUE_SIXTEEN) {
        moduleData.show_pd = true;
        moduleData.show_na = true;
    }
    if (moduleData.status == VALUE_THREE &&
            (moduleType == VALUE_NINE || moduleType == VALUE_THIRTEEN || moduleType == VALUE_FOURTEEN ||
                    moduleType == VALUE_FIFTEEN || moduleType == VALUE_SIXTEEN ||
                    moduleType == VALUE_TWENTYTHREE || moduleType == VALUE_TWENTYFOUR || moduleType == VALUE_TWENTYFIVE)) {
        if (!moduleData.hide_submit_btn) {
            moduleData.show_fees_paid = true;
        }
    }
    moduleData.s_title = 'Survey';
    moduleData.sd_title = 'Subdiv';
    if (moduleType == VALUE_TWENTYTHREE) {
        moduleData.s_title = moduleData.ld_area_type == VALUE_TWO ? 'Gauthan Wise Number' : 'P.T. Sheet Number';
        moduleData.sd_title = moduleData.ld_area_type == VALUE_TWO ? 'Plot Number' : 'Chalta Number';
        moduleData.show_psaw = true;
    }
    $('#popup_container').html(payTemplate(moduleData));
    generateBoxes('radio', paymentTypeArray, 'payment_type', 'pfd', moduleData.payment_type, true);

    var ldDetails = JSON.parse(moduleData.land_details);
    $.each(ldDetails, function (index, ld) {
        if (moduleData.show_psaw) {
            var psFormData = psFormArray[ld.property_status] ? psFormArray[ld.property_status] : [];
        }
        $('#ld_item_container_for_' + moduleType).append('<tr><td class="text-center">' + (index + 1) + '</td>'
                + '<td class="text-center">' + ld.survey + '</td><td class="text-center">' + ld.subdiv + '</td>'
                + (moduleData.show_psaw ? ('<td class="text-center">' + (propertyStatusTextArray[ld.property_status] ? propertyStatusTextArray[ld.property_status] : '') + '</td>'
                        + '<td class="text-center">' + (ld.apply_with ? getCheckboxValue(ld.apply_with, psFormData) : '') + '</td>') : '')
                + '<td class="text-right">' + ld.copies + '</td>'
                + (moduleData.show_pd ? '<td class="text-right">' + (moduleData.show_na ? (ld.is_na == VALUE_ONE ? 'N.A.' : (ld.pages ? ld.pages : VALUE_ZERO)) : (ld.pages ? ld.pages : VALUE_ZERO)) + '</td>' : '')
                + '<td class="text-right">' + (moduleData.show_na ? (ld.is_na == VALUE_ONE ? 'N.A.' : ld.amount) : ld.amount) + '</td></tr>');
    });
    loadFB(moduleType, moduleData.fb_data);
    loadPH(moduleType, moduleData.ph_data);
}

function loadFB(moduleType, fbDetails) {
    var templateData = {};
    templateData.module_type = moduleType;
    $('#fb_container_for_' + moduleType).html(fbListTemplate(templateData));
    var tempCnt = 1;
    var totalFee = 0;
    $.each(fbDetails, function (index, fbd) {
        fbd.module_type = moduleType;
        fbd.fb_cnt = tempCnt;
        $('#fb_item_container_for_' + moduleType).append(fbItemViewTemplate(fbd));
        var fees = parseInt(fbd.fee);
        totalFee += fees ? fees : 0;
        tempCnt++;
    });
    $('#total_fees_for_fb_' + moduleType).html(totalFee + ' /-');
    if (tempCnt != 1) {
        $('#fb_container_for_' + moduleType).show();
    }
}

function loadPH(moduleType, phDetails) {
    var templateData = {};
    templateData.module_type = moduleType;
    $('#ph_container_for_' + moduleType).html(phListTemplate(templateData));
    var tempCnt = 1;
    $.each(phDetails, function (index, phd) {
        phd.module_type = moduleType;
        phd.ph_cnt = tempCnt;
        phd.transaction_datetime = phd.op_transaction_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(phd.op_transaction_datetime) : (phd.op_start_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(phd.op_start_datetime) : '');
        phd.status_text = pgStatus(phd.op_status, phd.fees_payment_id);
        if (phd.op_status == VALUE_FOUR || phd.op_status == VALUE_FIVE || phd.op_status == VALUE_SIX) {
            phd.show_update_payment_status_btn = true;
        }
        $('#ph_item_container_for_' + moduleType).append(phItemTemplate(phd));
        tempCnt++;
    });
    if (tempCnt == 1) {
        $('#ph_item_container_for_' + moduleType).html(noRecordFoundTemplate({'colspan': 7, 'message': noRecordFoundMessage}));
        return false;
    }
}

var pgStatusRenderer = function (data, type, full, meta) {
    return pgStatus(data, full.fees_payment_id);
};

function pgStatus(data, feePaymentId) {
    return '<div class="pg_status_' + feePaymentId + '">' + (pgStatusTextArray[data] ? pgStatusTextArray[data] : pgStatusTextArray[VALUE_ZERO]) + '</div>';
}

function payFormFees(btnObj) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    validationMessageHide();
    var formData = $('#pfd_form').serializeFormJSON();
    if (!formData.module_id_for_pfd || !formData.module_type_for_pfd) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    if (!formData.payment_type_for_pfd) {
        $('#payment_type_for_pfd_1').focus();
        validationMessageShow('pfd-payment_type_for_pfd', oneOptionValidationMessage);
        return false;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/submit_fee_details',
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
                showError(parseData.message);
                return false;
            }
            Swal.close();
            if (parseData.payment_type == VALUE_ONE) {
                openFullPageOverlay();
                submitPG(parseData);
                return false;
            }
        }
    });
}

function submitPG(pgData) {
    $('#temp_op_enct').val(pgData.op_enct);
    $('#temp_op_mt').val(pgData.op_mt);
    $('#temp_op_mmptd').val(pgData.op_mmptd);
    $('#qwertyuiqwdjkoplkjhfgazcxzc').submit();
    $('.null-pdjshdjs').val('');
}

function pgMessage(data, feePaymentId) {
    return '<div class="pg_message_' + feePaymentId + '">' + data + '</div>';
}

function getDeptName(data) {
    var qmData = queryModuleArray[data] ? queryModuleArray[data] : [];
    return qmData['department_name'] ? qmData['department_name'] : '';
}

function getServiceName(data) {
    var qmData = queryModuleArray[data] ? queryModuleArray[data] : [];
    return qmData['title'] ? qmData['title'] : '';
}

function checkPaymentDV(btnObj, feesPaymentId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!feesPaymentId || !btnObj) {
        showError(invalidAccessValidationMessage);
        return;
    }
    var that = this;
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        url: 'payment_status/check_payment_dv',
        type: 'post',
        data: $.extend({}, {'fees_payment_id': feesPaymentId}, getTokenData()),
        error: function (textStatus, errorThrown) {
            generateNewCSRFToken();
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
            setNewToken(parseData.temp_token);
            if (parseData.success === false) {
                showError(parseData.message);
                return false;
            }
            var totalExCnt = returnCounter('dv-cnt');
            if (totalExCnt == 0) {
                $('#dv_item_container').html('');
            }
            var dvData = parseData.dv_data;
            $('.success-message-ph').html(parseData.message);
            loadDVRow(dvData);
            resetCounter('dv-cnt');
            if (parseData.is_updated_fp) {
                $('.pg_status_' + feesPaymentId).html(pgStatus(parseData.updated_op_status, feesPaymentId));
                $('.pg_message_' + feesPaymentId).html(parseData.updated_op_message);
            }
        }
    });
}

function loadDVRow(dv) {
    dv.dv_by = dv.dv_type == VALUE_ONE ? 'Auto' : (dv.entered_by ? dv.entered_by : '');
    dv.dv_start_datetime_text = dateTo_DD_MM_YYYY_HH_II_SS(dv.dv_start_datetime);
    dv.dv_status_text = dvStatusTextArray[dv.dv_status] ? dvStatusTextArray[dv.dv_status] : '';
    dv.dv_pg_status_text = dv.dv_pg_status != VALUE_ZERO ? (pgStatusTextArray[dv.dv_pg_status] ? pgStatusTextArray[dv.dv_pg_status] : '') : '';
    $('#dv_item_container').prepend(dvItemTemplate(dv));
}

function getPageDetails(btnObj, ldModuleType, moduleType, moduleId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleType || !moduleId || !ldModuleType) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/get_pages_details',
        data: $.extend({}, {'ld_module_type': ldModuleType, 'module_type': moduleType, 'module_id': moduleId}, getTokenData()),
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
            showPageDetails(moduleType, moduleId, parseData.module_data);
        }
    });
}

function showPageDetails(moduleType, moduleId, moduleData) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    var villageData = (moduleData.district == VALUE_ONE ? tempVillageData : (moduleData.district == VALUE_TWO ? diuVillagesArray : (moduleData.district == VALUE_THREE ? dnhVillagesArray : [])));
    moduleData.village_text = (villageData[moduleData.village] ? villageData[moduleData.village]['village_name'] : '');

    showPopup();
    $('.swal2-popup').css('width', '55em');
    moduleData.module_type = moduleType;
    moduleData.module_id = moduleId;
    moduleData.show_colspan = VALUE_FOUR;
    if (moduleType == VALUE_SIXTEEN || moduleType == VALUE_NINE) {
        moduleData.show_mte = true;
        moduleData.show_colspan = VALUE_FIVE;
        if (moduleType == VALUE_NINE) {
            moduleData.show_dr = true;
            moduleData.show_colspan = VALUE_SIX;
        }
    }
    if (moduleType == VALUE_NINE || moduleType == VALUE_FOURTEEN || moduleType == VALUE_FIFTEEN || moduleType == VALUE_SIXTEEN) {
        moduleData.show_na = true;
    }
    $('#popup_container').html(updListTemplate(moduleData));

    $.each(moduleData.fl_data, function (index, ld) {
        ld.temp_cnt = (index + 1);
        if (moduleData.show_mte) {
            ld.show_mte = true;
        }
        if (moduleData.show_dr) {
            ld.show_dr = true;
        }
        ld.village_text = moduleData.village_text;
        if (moduleData.show_na) {
            ld.show_na = true;
            if (ld.is_na == VALUE_ONE) {
                ld.readonly_upd = 'readonly';
                ld.is_na_checked_upd = 'checked';
            }
        }
        $('#ld_item_container_for_upd_' + moduleType).append(updItemTemplate(ld));
    });
    allowOnlyIntegerValueWithObj($('.allow-int-value'));
}

function isNotAvailableUPD(fldId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!fldId || fldId == VALUE_ZERO) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    $('#pages_for_upd_' + fldId).removeAttr('readonly');
    if ($('#is_na_for_upd_' + fldId).is(':checked')) {
        $('.input-null-upd-' + fldId).val(VALUE_ZERO);
        $('.html-null-upd-' + fldId).html(VALUE_ZERO);
        $('#pages_for_upd_' + fldId).attr('readonly', 'readonly');
    }
    calculatePagesWithCopyAmount(fldId);
}

function calculatePagesWithCopyAmount(fldId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!fldId || fldId == VALUE_ZERO) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var copies = parseInt($('#copies_for_upd_' + fldId).val());
    var pages = parseInt($('#pages_for_upd_' + fldId).val());
    var amount = ((copies ? copies : VALUE_ZERO) * (pages ? pages : VALUE_ZERO)) * PER_COPY_PRICE;
    $('#amount_for_upg_' + fldId).val(amount);
    $('#d_amount_for_upg_' + fldId).html(amount);
    this.calculateTotalPagesWithCopyAmount();
}

function calculateTotalPagesWithCopyAmount() {
    var totalPages = VALUE_ZERO;
    var copies = VALUE_ZERO;
    var pages = VALUE_ZERO;
    var totalAmount = VALUE_ZERO;
    $('.update_page_details_for_upd').each(function () {
        var fldId = $(this).find('.form_land_details_id_for_upg').val();
        copies = parseInt($('#copies_for_upd_' + fldId).val());
        pages = parseInt($('#pages_for_upd_' + fldId).val());
        totalPages += (pages ? pages : VALUE_ZERO);
        totalAmount += (((copies ? copies : VALUE_ZERO) * (pages ? pages : VALUE_ZERO)) * PER_COPY_PRICE);
    });
    $('#total_pages_for_upd').html(totalPages);
    $('#total_amount_for_upd').html(totalAmount);
}

function updatePageDetails(btnObj, sType) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (sType != VALUE_ONE && sType != VALUE_TWO) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var moduleId = $('#module_id_for_upd').val();
    var moduleType = $('#module_type_for_upd').val();
    if (!moduleId || moduleId == null || !moduleType || moduleType == null ||
            (moduleType != VALUE_NINE && moduleType != VALUE_FOURTEEN && moduleType != VALUE_FIFTEEN && moduleType != VALUE_SIXTEEN)) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var ldItems = [];
    var isLdValidation = false;
    var isNACnt = 0;
    $('.update_page_details_for_upd').each(function () {
        var fldId = $(this).find('.form_land_details_id_for_upg').val();
        if (!fldId || fldId == '' || fldId == null || fldId == 0) {
            showError(invalidAccessValidationMessage);
            isLdValidation = true;
            return false;
        }
        var ldInfo = {};
        var survey = $('#survey_for_upd_' + fldId).val();
        if (survey == '' || survey == null) {
            $('#survey_for_upd_' + fldId).focus();
            validationMessageShow('upd-survey_for_upd_' + fldId, selectSurveyValidationMessage);
            isLdValidation = true;
            return false;
        }
        ldInfo.survey = survey;
        var subdiv = $('#subdiv_for_upd_' + fldId).val();
        if (subdiv == '' || subdiv == null) {
            $('#subdiv_for_upd_' + fldId).focus();
            validationMessageShow('upd-subdiv_for_upd_' + fldId, selectSubdivValidationMessage);
            isLdValidation = true;
            return false;
        }
        ldInfo.subdiv = subdiv;
        var copies = $('#copies_for_upd_' + fldId).val();
        if (copies == '' || copies == null || copies == 0) {
            $('#copies_for_upd_' + fldId).focus();
            validationMessageShow('upd-copies_for_upd_' + fldId, oneCopyValidationMessage);
            isLdValidation = true;
            return false;
        }
        ldInfo.copies = copies;
        ldInfo.is_na = VALUE_ZERO;
        if (moduleType == VALUE_NINE || moduleType == VALUE_FOURTEEN || moduleType == VALUE_FIFTEEN || moduleType == VALUE_SIXTEEN) {
            if ($('#is_na_for_upd_' + fldId).is(':checked')) {
                ldInfo.is_na = VALUE_ONE;
                isNACnt++;
            }
        }
        var pages = $('#pages_for_upd_' + fldId).val();
        if ((pages == '' || pages == null || pages == 0) && ldInfo.is_na == VALUE_ZERO) {
            $('#pages_for_upd_' + fldId).focus();
            validationMessageShow('upd-pages_for_upd_' + fldId, detailValidationMessage);
            isLdValidation = true;
            return false;
        }
        ldInfo.pages = pages;
        if (moduleType == VALUE_SIXTEEN || moduleType == VALUE_NINE) {
            ldInfo.mutation_entry_no = $('#mutation_entry_no_for_upd_' + fldId).val();
            if (moduleType == VALUE_NINE) {
                ldInfo.document_required = $('#document_required_for_upd_' + fldId).val();
            }
        }
        ldInfo.form_land_details_id = fldId;
        if (survey != '' || subdiv != '' || (fldId != 0 && fldId != '')) {
            ldItems.push(ldInfo);
        }
    });
    if (isLdValidation) {
        return false;
    }
    if (ldItems.length == VALUE_ZERO) {
        showError(oneLDValidationMessage);
        return false;
    }
    if (moduleType == VALUE_NINE || moduleType == VALUE_FOURTEEN || moduleType == VALUE_FIFTEEN || moduleType == VALUE_SIXTEEN) {
        if (isNACnt == ldItems.length) {
            showError(allLDNAValidationMessage);
            return false;
        }
    }
    var sfpRemarks = $('#sfp_remarks_for_upd').val();
    if (sType == VALUE_TWO && (sfpRemarks == '' || !sfpRemarks)) {
        $('#sfp_remarks_for_upd').focus();
        validationMessageShow('upd-sfp_remarks_for_upd', remarksValidationMessage);
        return false;
    }
    var formData = {};
    formData.s_type = sType;
    formData.module_id = moduleId;
    formData.module_type = moduleType;
    formData.sfp_remarks = sfpRemarks;
    formData.land_detail_items = ldItems;
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/update_pages_details',
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
            if (moduleType == VALUE_FOURTEEN) {
                FormThree.listview.listPage();
            }
            if (moduleType == VALUE_FIFTEEN) {
                FormFive.listview.listPage();
            }
            if (moduleType == VALUE_SIXTEEN) {
                FormNine.listview.listPage();
            }
            if (moduleType == VALUE_NINE) {
                CertifiedCopy.listview.listPage();
            }
        }
    });
}

function downloadCopy(vdType, formCopyId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if ((vdType != VALUE_ONE && vdType != VALUE_TWO) || !formCopyId || formCopyId == '') {
        showError(invalidAccessValidationMessage);
        return false;
    }
    $('#form_copy_id_forcd').val(formCopyId);
    $('#vd_type_forcd').val(vdType);
    $('#cd_form').submit();
    $('.forcd-null').val('');
}

function getCheckboxValue(columValue, arrayValue) {
    var tempstring = [];
    var str = columValue;
    if (columValue) {
        var splitComma = str.split(',');
        $.each(splitComma, function (index, value) {
            if (index != VALUE_ZERO) {
                tempstring += ', ';
            }
            tempstring += arrayValue[value] ? arrayValue[value] : '';
        });
        return tempstring;
    }
}

function fpMailHistory(btnObj, moduleType, moduleId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleId || (moduleType != VALUE_NINE && moduleType != VALUE_THIRTEEN && moduleType != VALUE_FOURTEEN &&
            moduleType != VALUE_FIFTEEN && moduleType != VALUE_SIXTEEN)) {
        showError(invalidAccessValidationMessage);
        return;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        type: 'POST',
        url: 'utility/get_fp_mail_history',
        data: $.extend({}, {'module_id_for_fp': moduleId, 'module_type_for_fp': moduleType}, getTokenData()),
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
            fpMailHistoryDetails(parseData);
        }
    });
}

function fpMailHistoryDetails(parseData) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    showPopup();
    $('.swal2-popup').css('width', '55em');
    var templateData = {};
    var mailHistoryData = parseData.mail_history_data;
    var moduleData = parseData.module_data;
    templateData.module_id = moduleData.module_id;
    templateData.module_type = moduleData.module_type;
    templateData.application_number = moduleData.application_number;
    templateData.show_send_email = false;
    if (moduleData.status == VALUE_THREE) {
        templateData.show_send_email = true;
    }
    $('#popup_container').html(fpMailHistoryTemplate(templateData));
    var tempHistoryCnt = 1;
    $.each(mailHistoryData, function (index, mhd) {
        var mhdRow = '<tr><td class="text-center">' + tempHistoryCnt + '</td><td class="text-center">' + mhd.email + '</td>' +
                '<td class="text-center">' + mhd.status + '</td>' +
                '<td class="text-center">' + mhd.message + '</td>' +
                '<td class="text-center">' + mhd.created_time + '</td></tr>';
        $('#mail_history_container_for_fpmh').append(mhdRow);
        tempHistoryCnt++;
    });
    if (tempHistoryCnt == 1) {
        $('#mail_history_container_for_fpmh').html(noRecordFoundTemplate({'colspan': 7, 'message': noRecordFoundMessage}));
        return false;
    }
}

function sendFPEmail(btnObj, moduleType, moduleId) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleId || (moduleType != VALUE_NINE && moduleType != VALUE_THIRTEEN && moduleType != VALUE_FOURTEEN &&
            moduleType != VALUE_FIFTEEN && moduleType != VALUE_SIXTEEN)) {
        showError(invalidAccessValidationMessage);
        return;
    }
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        url: 'utility/send_fp_email',
        type: 'post',
        data: $.extend({}, {'module_id_for_fpmh': moduleId, 'module_type_for_fpmh': moduleType}, getTokenData()),
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
        }
    });
}

function getCurrentYearDue(ld) {
    var area = ld.area ? ld.area : VALUE_ZERO;
    var guntha = (1 * area) / 100;
    if (ld.area_type == VALUE_ONE) {
        return Math.ceil(guntha * RLP_UA_PRICE_PER_GUNTHA);
    }
    return Math.ceil(guntha * RLP_RA_PRICE_PER_GUNTHA);
}

function numberToWord(moduleId, valueId) {
    var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
    var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    var amount = ($('#' + moduleId).val()).toString();
    if (amount.length > 9) {
        $('#' + valueId).html('overflow');
        return;
    }
    var n = ('000000000' + amount).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) {
        $('#' + valueId).html('');
        return;
    }
    var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';

    $('#' + valueId).html((str != '' ? '(' + str + 'only)' : ''));

}
function numberToWordsAmount(amount) {
    var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
    var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];


    var n = ('000000000' + amount).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) {
        return;
    }
    var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';

    return str + 'only';
}
function allowOnlyDecimalValue(id) {
    allowOnlyDecimalValueWithObj($('#' + id));
}

function allowOnlyDecimalValueWithObj(obj) {
    $(obj).keypress(function (evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
            return false;
        }
    });
}

function isJSON(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function districtChangeEventForList(obj, id) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    $('#vdw_for_' + id).html('<option value="">All</option>');
    var district = obj.val();
    if (!district) {
        return false;
    }
    if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
        return false;
    }
    if (tempTypeInSession != TEMP_TYPE_A) {
        var dwVillagesData = (district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : [])));
        if (tempAVInSession != '') {
            var avData = tempAVInSession.split(',');
            renderOptionsForAVArray(avData, dwVillagesData, 'vdw_for_' + id, false);
        } else {
            renderOptionsForTwoDimensionalArray(dwVillagesData, 'vdw_for_' + id, false);
        }
    } else {
        var villageData = district == VALUE_ONE ? damanVillagesArray : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArray(villageData, 'vdw_for_' + id, false);
    }
}

function districtChangeEventForMamOfficeList(obj, id) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    $('#vdw_for_' + id).html('<option value="">All</option>');
    var district = obj.val();
    if (!district) {
        return false;
    }
    if (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) {
        return false;
    }
    if (tempTypeInSession != TEMP_TYPE_A) {
        var tvData = tempDistrictInSession == VALUE_ONE ? tempVillageData : (tempDistrictInSession == VALUE_TWO ? tempDiuVillageData : tempVillageData);
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombinationForExAV(tvData, 'vdw_for_' + id, 'village', 'village_name', false, false);
    } else {
        var villageData = district == VALUE_ONE ? tempVillageData : (district == VALUE_TWO ? diuVillagesArray : (district == VALUE_THREE ? dnhVillagesArray : []));
        renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(villageData, 'vdw_for_' + id, 'village', 'village_name', false, false);
    }
}

function districtChangeEventForEocsList(obj, id) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    $('#vdw_for_' + id).html('<option value="">All</option>');
    var areaType = $('#area_type_for_eocs_site_plan_list').val();
    var district = obj.val();
    if (!district) {
        return false;
    }
    if (district == TALUKA_DAMAN) {
        if (areaType == VALUE_ONE) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'vdw_for_' + id, false);
        } else if (areaType == VALUE_TWO) {
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempUVillageData, 'vdw_for_' + id, 'village', 'village_name', false, false);
        }
    }
}

function areaTypeChangeEventForList(obj, id) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    $('#vdw_for_' + id).html('<option value="">All</option>');
    var district = $('#district_for_' + id).val();
    if (typeof district == "undefined") {
        district = tempDistrictInSession;
    }
    var areaType = obj.val();
    if (!areaType) {
        return false;
    }
    if (areaType != VALUE_ONE && areaType != VALUE_TWO) {
        return false;
    }
    if (district == TALUKA_DAMAN) {
        if (areaType == VALUE_ONE) {
            renderOptionsForTwoDimensionalArray(damanCityArray, 'vdw_for_' + id, false);
        } else if (areaType == VALUE_TWO) {
            renderOptionsForTwoDimensionalArrayWithKeyValueWithCombination(tempUVillageData, 'vdw_for_' + id, 'village', 'village_name', false, false);
        }
    }
}
function resetCounterForIndex(className, startCounter) {
    $('.' + className).each(function () {
        var objNo = $(this);
        if (objNo.parent().parent().is(':visible')) {
            objNo.html(startCounter + '.');
            startCounter++;
        }
    });
}

function duplicateDetailsOfApplicant(moduleType, moduleId, onclickForView, mIdText) {
    if (!tempIdInSession || tempIdInSession == null) {
        loginPage();
        return false;
    }
    if (!moduleId) {
        showError(invalidAccessValidationMessage);
        return false;
    }
    var templateData = {};
    templateData.module_type = moduleType;
    templateData.module_id = moduleId;

    var btnObj = $('#duplicate_details_btn_for_app_' + moduleId);
    var ogBtnHTML = btnObj.html();
    var ogBtnOnclick = btnObj.attr('onclick');
    btnObj.html(iconSpinnerTemplate);
    btnObj.attr('onclick', '');
    $.ajax({
        url: 'utility/get_duplicate_details_data',
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
                return false;
            }
            var applicantData = parseData.applicant_data;
            var moduleData = parseData.module_data;
            applicantData.module_type = templateData.module_type;
            if (templateData.module_type == VALUE_ONE) {
                applicantData.applicant_name = applicantData.name_of_applicant;
                applicantData.aadhar_number = applicantData.aadhaar;
            } else if (templateData.module_type == VALUE_FOUR || templateData.module_type == VALUE_FIVE ||
                    templateData.module_type == VALUE_SIX || templateData.module_type == VALUE_SEVEN) {
                applicantData.aadhar_number = applicantData.aadhaar;
            }
            $('#model_title').html('Duplicate Application Details');
            $('#model_body').html(duplicateDetailsTemplate(applicantData));
            $('#popup_modal').modal('show');
            var tCnt = 1;
            $.each(moduleData, function (index, cd) {
                if (templateData.module_type == VALUE_ONE) {
                    var applicantName = cd.name_of_applicant;
                    var aadharNumber = cd.aadhaar;
                } else if (templateData.module_type == VALUE_FOUR || templateData.module_type == VALUE_FIVE ||
                        templateData.module_type == VALUE_SIX || templateData.module_type == VALUE_SEVEN) {
                    var applicantName = cd.applicant_name;
                    var aadharNumber = cd.aadhaar;
                } else {
                    var applicantName = cd.applicant_name;
                    var aadharNumber = cd.aadhar_number;
                }
                $('#duplicate_details_container_for_' + templateData.module_type).append('<tr>'
                        + '<td class="f-w-b text-center">' + tCnt + '</td>'
                        + '<td class="text-center">' + cd.application_number + '</td>'

                        + '<td class="text-center">' + (cd.submitted_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(cd.submitted_datetime) : '') + '</td>'
                        + '<td class="text-center">' + (talukaArray[cd.district] ? talukaArray[cd.district] : '') + '</td>'
                        + '<td class="text-left">' + applicantName + '</td>'
                        + '<td class="text-center">' + cd.mobile_number + '</td>'
                        + '<td class="text-center">' + aadharNumber + '</td>'
                        + '<td class="text-center" style="width: 30px;"><button class="btn btn-xs btn-info" title="View" '
                        + 'onclick="' + onclickForView + '($(this),\'' + cd.m_id + '\',false);"><i class="fas fa-eye" style="margin-right: 2px;"></i></button></td>');

                tCnt++;
            });

            $('#duplicate_details_datatable').DataTable({
                ordering: false,
                pageLength: 10,
                lengthChange: false,
                language: dataTableProcessingAndNoDataMsg,
            });
        }
    });
}