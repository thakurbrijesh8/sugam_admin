var circleRateListTemplate = Handlebars.compile($('#circle_rate_list_template').html());
var circleRateTableTemplate = Handlebars.compile($('#circle_rate_table_template').html());
var circleRateRateTemplate = Handlebars.compile($('#circle_rate_rate_template').html());
var circleRateActionTemplate = Handlebars.compile($('#circle_rate_action_template').html());
var CircleRate = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
CircleRate.Router = Backbone.Router.extend({
    routes: {
        'circle_rate': 'renderList',
    },
    renderList: function () {
        CircleRate.listview.listPage();
    }
});
CircleRate.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_SUBR_USER) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        CircleRate.router.navigate('circle_rate');
        activeLink('menu_sub_registrar');
        addClass('subr_circle_rate', 'active');
        var templateData = {};
        this.$el.html(circleRateListTemplate(templateData));
        this.loadCircleRateData();
    },
    loadCircleRateData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_SUBR_USER) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        var pmvTypeRenderer = function (data, type, full, meta) {
            return DRMainPropertyTypeArray[data] ? DRMainPropertyTypeArray[data] : '';
        };
        var descRenderer = function (data, type, full, meta) {
            if (full.district != TALUKA_DAMAN && full.district != TALUKA_DIU) {
                return '';
            }
            var cityArray = full.district == TALUKA_DAMAN ? damanCityArray : (full.district == TALUKA_DIU ? diuCityArray : []);
            return  '<b><i class="fas fa-map-marker-alt f-s-10px"></i> :- ' + (cityArray[full.city] ? cityArray[full.city] : '')
                    + '</b><br><b><i class="fas fa-file-signature f-s-10px"></i> :- </b>' + full.panchayat_name;
        };
        var pmvPTRenderer = function (data, type, full, meta) {
            var PTAraay = DRPropertyTypeArray[full.pmv_type] ? DRPropertyTypeArray[full.pmv_type] : [];
            return PTAraay[data] ? PTAraay[data] : '';
        };
        var pmvCRenderer = function (data, type, full, meta) {
            var CAraay = DRCCArray[full.pmv_land_property_type] ? DRCCArray[full.pmv_land_property_type] : [];
            return CAraay[full.pmv_category] ? CAraay[full.pmv_category] : '';
        };
        var pmvURenderer = function (data, type, full, meta) {
            return DRPropertyUnitArray[data] ? DRPropertyUnitArray[data] : '';
        };
        var circleRateRenderer = function (data, type, full, meta) {
            return circleRateRateTemplate({'pmv_cr_id': full.pmv_cr_id, 'pmv_rate': data});
        };
        var circleRateActionRenderer = function (data, type, full, meta) {
            return circleRateActionTemplate({'pmv_cr_id': data});
        };
        CircleRate.router.navigate('circle_rate');
        $('#circle_rate_datatable_container').html(circleRateTableTemplate);
        $('#circle_rate_datatable').DataTable({
            ajax: {url: 'circle_rate/get_circle_rate_data', dataSrc: "circle_rate_data", type: "post", data: getTokenData()},
            bAutoWidth: false,
            pageLength: 100,
            language: dataTableProcessingAndNoDataMsg,
            ordering: false,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'pmv_type', 'render': pmvTypeRenderer, 'class': 'text-center'},
                {data: '', 'render': descRenderer, 'class': 'f-s-app-details'},
                {data: 'pmv_land_property_type', 'render': pmvPTRenderer},
                {data: 'pmv_category', 'render': pmvCRenderer},
                {data: 'pmv_unit', 'render': pmvURenderer, 'class': 'text-center'},
                {data: 'pmv_rate', 'render': circleRateRenderer},
                {
                    "orderable": false,
                    "data": 'pmv_cr_id',
                    "render": circleRateActionRenderer,
                    'class': 'text-center'
                }
            ],
            "initComplete": function (settings, json) {
                setNewToken(json.temp_token);
                allowOnlyIntegerValue('circle-rate-ucr', '.');
            }
        });
    },
    updateCircleRate: function (btnObj, pmvCRId) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A && tempTypeInSession != TEMP_TYPE_SUBR_USER) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        if (!pmvCRId) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        validationMessageHide();
        var circleRate = $('#circle_rate_for_ucr_' + pmvCRId).val();
        if (!circleRate) {
            $('#circle_rate_for_ucr_' + pmvCRId).focus();
            validationMessageShow('ucr-circle_rate_for_ucr_' + pmvCRId, rateValidationMessage);
            return false;
        }
        addTagSpinner('circle_rate_for_ucr_' + pmvCRId);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            type: 'POST',
            url: 'circle_rate/update_circle_rate',
            data: $.extend({}, {'pmv_cr_id': pmvCRId, 'circle_rate': circleRate}, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                removeTagSpinner();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
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
            success: function (data) {
                removeTagSpinner();
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    return false;
                }
                showSuccess(parseData.message);
            }
        });
    },
    hideShowPassword: function (obj, id) {
        var InputType = document.getElementById(id);
        if (InputType.type === "password") {
            InputType.type = "text";
            obj.html('<span class="input-group-text"><i class="fa fa-eye-slash"></i></span>');
        } else {
            InputType.type = "password";
            obj.html('<span class="input-group-text"><i class="fa fa-eye"></i></span>');
        }

    },
    listPageForChangePassword: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_change_password');
        CircleRate.router.navigate('change_password');
        var that = this;
        that.$el.html(changePasswordFormTemplate);
        $('#change_password_form').find('input').keypress(function (e) {
            if (e.which == 13) {
                that.changePassword($('#submit_btn_for_change_password'));
            }
        });
    },
    checkValidationForChangePassword: function (changePasswordFormData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!changePasswordFormData.current_password_for_change_password) {
            return getBasicMessageAndFieldJSONArray('current_password_for_change_password', passwordValidationMessage);
        }
        if (!changePasswordFormData.new_password_for_change_password) {
            return getBasicMessageAndFieldJSONArray('new_password_for_change_password', passwordValidationMessage);
        }
        var passwordVMessage = passwordValidation(changePasswordFormData.new_password_for_change_password);
        if (passwordVMessage != '') {
            return getBasicMessageAndFieldJSONArray('new_password_for_change_password', passwordVMessage);
        }
        if (!changePasswordFormData.retype_password_for_change_password) {
            return getBasicMessageAndFieldJSONArray('retype_password_for_change_password', retypePasswordValidationMessage);
        }
        if (changePasswordFormData.new_password_for_change_password != changePasswordFormData.retype_password_for_change_password) {
            return getBasicMessageAndFieldJSONArray('retype_password_for_change_password', passwordAndRetypePasswordValidationMessage);
        }
        return '';
    },
    changePassword: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        validationMessageHide();
        var changePasswordFormData = $('#change_password_form').serializeFormJSON();
        var validationData = that.checkValidationForChangePassword(changePasswordFormData);
        if (validationData != '') {
            $('#' + validationData.field).focus();
            validationMessageShow('change-password-' + validationData.field, validationData.message);
            return false;
        }
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({type: 'POST',
            url: 'users/change_password',
            data: $.extend({}, changePasswordFormData, getTokenData()),
            error: function (textStatus, errorThrown) {
                generateNewCSRFToken();
                btnObj.html('Submit');
                btnObj.attr('onclick', 'CircleRate.listview.changePassword($(this))');
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
            success: function (data) {
                btnObj.html('Submit');
                btnObj.attr('onclick', 'CircleRate.listview.changePassword($(this))');
                if (!isJSON(data)) {
                    loginPage();
                    return false;
                }
                var parseData = JSON.parse(data);
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    showError(parseData.message);
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                that.resetChangePasswordForm();
                showSuccess(parseData.message);
            }
        });
    },
    resetChangePasswordForm: function () {
        validationMessageHide();
        resetForm('change_password_form');
        document.getElementById('current_password_for_change_password').type = 'password';
        document.getElementById('new_password_for_change_password').type = 'password';
        document.getElementById('retype_password_for_change_password').type = 'password';
        $('.eye-class').html('<span class="input-group-text"><i class="fa fa-eye"></i></span>');
    }
});
