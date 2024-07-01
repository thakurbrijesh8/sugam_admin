var adminLoginDetailLogsListTemplate = Handlebars.compile($('#admin_login_detail_logs_list_template').html());
var userLoginDetailLogsListTemplate = Handlebars.compile($('#user_login_detail_logs_list_template').html());
var dglapiLogsListTemplate = Handlebars.compile($('#dgl_api_logs_list_template').html());
var emailLogsListTemplate = Handlebars.compile($('#email_logs_list_template').html());
var dddapiLogsListTemplate = Handlebars.compile($('#ddd_api_logs_list_template').html());
var smsLogsListTemplate = Handlebars.compile($('#sms_logs_list_template').html());

var Logs = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Logs.Router = Backbone.Router.extend({
    routes: {
        'admin_login_detail_logs': 'renderListForALL',
        'user_login_detail_logs': 'renderListForULL',
        'dg_locker_api_logs': 'renderListForDGLAPI',
        'email_logs': 'renderListForEmail',
        'ddd_api_logs': 'renderListForDDDAPI',
        'sms_logs': 'renderListForSMS',
    },
    renderListForALL: function () {
        Logs.listview.listPageForALL();
    },
    renderListForULL: function () {
        Logs.listview.listPageForULL();
    },
    renderListForDGLAPI: function () {
        Logs.listview.listPageForDGLAPI();
    },
    renderListForEmail: function () {
        Logs.listview.listPageForEmail();
    },
    renderListForDDDAPI: function () {
        Logs.listview.listPageForDDDAPI();
    },
    renderListForSMS: function () {
        Logs.listview.listPageForSMS();
    }
});
Logs.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPageForALL: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        activeLink('menu_logs');
        addClass('menu_admin_logs_login_detail', 'active');
        Logs.router.navigate('admin_login_detail_logs');
        var templateData = {};
        this.$el.html(adminLoginDetailLogsListTemplate(templateData));
        this.loadALLDetail();
    },
    loadALLDetail: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        var nameRenderer = function (data, type, full, meta) {
            return data + ' - ' + full.username;
        };
        $('#admin_login_detail_datatable').DataTable({
            ajax: {url: 'logs/get_admin_login_logs_data', dataSrc: "admin_login_data", type: "post"},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'name', 'render': nameRenderer},
                {data: 'ip_address', 'class': 'text-center'},
                {data: 'login_time', 'class': 'text-center'},
                {data: 'logout_time', 'class': 'text-center'}
            ],
            "initComplete": searchableDatatable
        });
        $('#admin_login_detail_datatable_filter').remove();
    },
    listPageForULL: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        activeLink('menu_logs');
        addClass('menu_user_logs_login_detail', 'active');
        Logs.router.navigate('user_login_detail_logs');
        var templateData = {};
        this.$el.html(userLoginDetailLogsListTemplate(templateData));
        this.loadULLDetail();
    },
    loadULLDetail: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        var nameRenderer = function (data, type, full, meta) {
            return full.mobile_number + ' - ' + full.applicant_name;
        };
        $('#user_login_detail_datatable').DataTable({
            ajax: {url: 'logs/get_user_login_logs_data', dataSrc: "user_login_data", type: "post"},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: '', 'render': nameRenderer},
                {data: 'ip_address', 'class': 'text-center'},
                {data: 'login_time', 'class': 'text-center'},
                {data: 'logout_time', 'class': 'text-center'}
            ],
            "initComplete": searchableDatatable
        });
        $('#user_login_detail_datatable_filter').remove();
    },
    listPageForDGLAPI: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        activeLink('menu_logs');
        addClass('menu_logs_dg_locker_api', 'active');
        Logs.router.navigate('dg_locker_api_logs');
        var templateData = {};
        this.$el.html(dglapiLogsListTemplate(templateData));
        this.loadDGLAPI();
    },
    loadDGLAPI: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        var atRenderer = function (data, type, full, meta) {
            return dgAPITypeArray[data] ? dgAPITypeArray[data] : '';
        };
        var dttRenderer = function (data, type, full, meta) {
            return '<span class="badge bg-info app-status">' + full.document_type + '</span><hr>' + dateTo_DD_MM_YYYY_HH_II_SS(full.created_time);
        };
        var dgRenderer = function (data, type, full, meta) {
            return  (full.uri != '' ? '<i class="fas fa-link f-s-10px"></i> :- ' + full.uri + '<br>' : '')
                    + '<i class="fas fa-key f-s-10px f-w-b"></i> :- ' + full.digi_locker_id
                    + (full.fullname != '' ? '<br><i class="fas fa-user f-s-10px"></i> :- ' + full.fullname : '')
                    + (full.date_of_birth != '' ? '<br><i class="fas fa-birthday-cake f-s-10px"></i> :- ' + full.date_of_birth : '')
                    + (full.gender != '' ? '<br><i class="fas fa-venus f-s-10px"></i> :- ' + full.gender : '');
        };
        var ybAppRenderer = function (data, type, full, meta) {
            return full.year_of_birth + (full.year_of_birth != '' && full.application_number != '' ? '<hr>' : '') + full.application_number;
        };
        var mbRenderer = function (data, type, full, meta) {
            return full.mobile_number + (full.mobile_number != '' && full.barcode_number != '' ? '<hr>' : '') + full.barcode_number;
        };
        var odRenderer = function (data, type, full, meta) {
            return (full.status == VALUE_ONE ? '<span class="badge bg-success app-status">Success</span>' : '<span class="badge bg-danger app-status">Fail</span>')
                    + (full.message != '' ? '<br>' + full.message : '')
                    + '<hr>' + full.ip_address;
        };
        $('#dg_locker_api_logs_datatable').DataTable({
            ajax: {url: 'logs/get_dg_locker_api_logs_data', dataSrc: "dgl_api_logs_data", type: "post"},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'api_type', 'class': 'text-center', 'render': atRenderer},
                {data: '', 'class': 'text-center', 'render': dttRenderer},
                {data: '', 'render': dgRenderer},
                {data: '', 'class': 'text-center', 'render': ybAppRenderer},
                {data: '', 'class': 'text-center', 'render': mbRenderer},
                {data: '', 'class': 'text-center', 'render': odRenderer},
            ],
            "initComplete": searchableDatatable
        });
        $('#dg_locker_api_logs_datatable_filter').remove();
    },
    listPageForEmail: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        activeLink('menu_logs');
        addClass('menu_logs_email', 'active');
        Logs.router.navigate('email_logs');
        var templateData = {};
        this.$el.html(emailLogsListTemplate(templateData));
        renderOptionsForTwoDimensionalArray(emailTypeArray, 'email_type_for_ellist');
        generateSelect2WithId('email_type_for_ellist');
        this.loadEmail();
    },
    emailActionRenderer: function (rowData) {
        return '<div class="card mb-0"><div class="card-body bg-light-gray">' + rowData.message + '</div></div>';
    },
    loadEmail: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        var that = this;
        var etRenderer = function (data, type, full, meta) {
            return emailTypeArray[data] ? emailTypeArray[data] : '';
        };
        var mtRenderer = function (data, type, full, meta) {
            return queryModuleArray[data] ? queryModuleArray[data]['title'] : '';
        };
        var stRenderer = function (data, type, full, meta) {
            return data == 'success' ? '<span class="badge bg-success app-status">Success</span>' : '<span class="badge bg-danger app-status">Fail</span>';
        };
        emailLogsDataTable = $('#email_logs_datatable').DataTable({
            ajax: {url: 'logs/get_email_logs_data', dataSrc: "email_logs_data", type: "post"},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'created_time', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'email_type', 'class': 'text-center', 'render': etRenderer},
                {data: 'module_type', 'class': 'text-center', 'render': mtRenderer},
                {data: 'email', 'class': 'text-center'},
                {data: 'status', 'class': 'text-center', 'render': stRenderer},
                {'class': 'details-control text-center', 'orderable': false, 'data': null, "defaultContent": ''}
            ],
            "initComplete": searchableDatatable
        });
        $('#email_logs_datatable_filter').remove();
        $('#email_logs_datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).parents('tr');
            var row = emailLogsDataTable.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(that.emailActionRenderer(row.data())).show();
                tr.addClass('shown');
            }
        });
    },
    listPageForDDDAPI: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        activeLink('menu_logs');
        addClass('menu_logs_ddd_api', 'active');
        Logs.router.navigate('ddd_api_logs');
        var templateData = {};
        this.$el.html(dddapiLogsListTemplate(templateData));
        renderOptionsForTwoDimensionalArray(dddAPITypeArray, 'api_type_for_dddapilist');
        generateSelect2WithId('api_type_for_dddapilist');
        renderOptionsForTwoDimensionalArray(eYesNoArray, 'other_ip_address_for_dddapilist');
        generateSelect2WithId('other_ip_address_for_dddapilist');
        this.loadDDDAPI();
    },
    loadDDDAPI: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        var that = this;
        var apitRenderer = function (data, type, full, meta) {
            return dddAPITypeArray[data] ? dddAPITypeArray[data] : '';
        };
        var otheripRenderer = function (data, type, full, meta) {
            return eYesNoArray[data] ? eYesNoArray[data] : '';
        };
        var stRenderer = function (data, type, full, meta) {
            return (full.status == 200 ? '<span class="badge bg-success app-status">Success</span>' : '<span class="badge bg-danger app-status">Fail</span>')
                    + (full.message != '' ? '<hr>' + full.message : '');
        };
        dddapiLogsDataTable = $('#ddd_api_logs_datatable').DataTable({
            ajax: {url: 'logs/get_ddd_api_logs_data', dataSrc: "ddd_api_logs_data", type: "post"},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'created_time', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'api_type', 'class': 'text-center', 'render': apitRenderer},
                {data: 'is_other_ip_address', 'class': 'text-center', 'render': otheripRenderer},
                {data: 'ip_address', 'class': 'text-center'},
                {data: 'status', 'class': 'text-center', 'render': stRenderer},
            ],
            "initComplete": searchableDatatable
        });
        $('#ddd_api_logs_datatable_filter').remove();
    },
    listPageForSMS: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        activeLink('menu_logs');
        addClass('menu_logs_sms', 'active');
        Logs.router.navigate('sms_logs');
        var templateData = {};
        this.$el.html(smsLogsListTemplate(templateData));
        renderOptionsForTwoDimensionalArray(appTypeArray, 'app_type_for_smslist', false);
        renderOptionsForTwoDimensionalArray(smsTypeArray, 'sms_type_for_smslist', false);
        renderOptionsForTwoDimensionalArrayWithValueCombination(queryModuleArray, 'module_type_for_smslist', 'title', false);
        this.loadSMS();
    },
    loadSMS: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession != TEMP_TYPE_A) {
            Dashboard.router.navigate('dashboard', {trigger: true});
            return false;
        }
        var that = this;
        var apptRenderer = function (data, type, full, meta) {
            return appTypeArray[data] ? appTypeArray[data] : '';
        };
        var mtRenderer = function (data, type, full, meta) {
            var qmData = queryModuleArray[data] ? queryModuleArray[data] : '';
            return qmData['title'] ? qmData['title'] : '';
        };
        var smstRenderer = function (data, type, full, meta) {
            return smsTypeArray[data] ? smsTypeArray[data] : '';
        };
        var stRenderer = function (data, type, full, meta) {
            return (full.status == 'sent' ? '<span class="badge bg-success app-status">Success</span>' : '<span class="badge bg-danger app-status">Fail</span>')
                    + (full.status_message != '' ? '<hr>' + full.status_message : '');
        };
        smsLogsDataTable = $('#sms_logs_datatable').DataTable({
            ajax: {url: 'logs/get_sms_logs_data', dataSrc: "sms_logs_data", type: "post"},
            bAutoWidth: false,
            ordering: false,
            pageLength: 25,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'created_time', 'class': 'text-center', 'render': dateTimeRenderer},
                {data: 'app_type', 'class': 'text-center', 'render': apptRenderer},
                {data: 'sms_type', 'class': 'text-center', 'render': smstRenderer},
                {data: 'module_type', 'class': 'text-center', 'render': mtRenderer},
                {data: 'mobile_number', 'class': 'text-center'},
                {data: 'message', 'class': 'text-center'},
                {data: 'status', 'class': 'text-center', 'render': stRenderer}
            ],
            "initComplete": searchableDatatable
        });
        $('#sms_logs_datatable_filter').remove();
    }
});
