var dashboardListTemplate = Handlebars.compile($('#dashboard_list_template').html());
var dashboardMamItemTemplate = Handlebars.compile($('#dashboard_mam_item_template').html());
var dashboardFeesStatusItemTemplate = Handlebars.compile($('#dashboard_fees_status_item_template').html());
var ophListTemplate = Handlebars.compile($('#oph_list_template').html());
var ophActionTemplate = Handlebars.compile($('#oph_action_template').html());
var dvListTemplate = Handlebars.compile($('#dv_list_template').html());
var dvItemTemplate = Handlebars.compile($('#dv_item_template').html());
var hwrListTemplate = Handlebars.compile($('#hwr_list_template').html());
var hwrTableTemplate = Handlebars.compile($('#hwr_table_template').html());
var hwrItemTemplate = Handlebars.compile($('#hwr_item_template').html());
var hwrViewListTemplate = Handlebars.compile($('#hwr_view_list_template').html());
var dashboardGeneralApplicationStatusItemTemplate = Handlebars.compile($('#dashboard_general_application_status_item_template').html());

//var dashboardCrsrItemTemplate = Handlebars.compile($('#dashboard_crsr_item_template').html());

var Dashboard = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};
Dashboard.Router = Backbone.Router.extend({
    routes: {
        '': 'renderListForURLChange',
        'dashboard': 'renderList',
        'online_payment_history': 'renderListForOPH',
        'head_wise_report': 'renderListForHWR'
    },
    renderList: function () {
        Dashboard.listview.listPage();
    },
    renderListForURLChange: function () {
        history.pushState({}, null, 'main#dashboard');
        if (tDistrict != '' && tMT != '' && tMS != '' && tMI != '') {
            Dashboard.listview.changeRouterForMam(parseInt(tMT), parseInt(tDistrict), parseInt(tMS));
            tDistrict = '';
            tMT = '';
            tMS = '';
            tMI = '';
            return false;
        }
        Dashboard.listview.listPage();
    },
    renderListForOPH: function () {
        Dashboard.listview.listPageForOPH();
    },
    renderListForHWR: function () {
        Dashboard.listview.listPageForHWR();
    },
});
Dashboard.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (tempTypeInSession == TEMP_TYPE_USER_ACC_VER) {
            VPUsers.listview.listPage();
            return false;
        }
        Dashboard.router.navigate('dashboard');
        activeLink('menu_dashboard');
        var templateData = {};
        this.$el.html(dashboardListTemplate(templateData));
        datePicker();
        this.loadDashboardData();
    },
    loadDashboardData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var that = this;
        if (tempTypeInSession == TEMP_TYPE_A) {
            $('#mam_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 12, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
            $('#fees_status_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 14, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
//            $('#crsr_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 8, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
            $('#general_application_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 10, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
        } else if (tempTypeInSession == TEMP_TYPE_ACI_USER ||
                tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAM_VIEW_USER) {
            $('#mam_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 12, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
            $('#fees_status_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 11, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
            $('#general_application_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 10, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
        } else if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
            $('#mam_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 13, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
            $('#fees_status_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 11, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
        } else if (tempTypeInSession == TEMP_TYPE_EOCS_FS || tempTypeInSession == TEMP_TYPE_EOCS_HEAD || tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_EOCS_JFS) {
            $('#fees_status_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 14, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
        } else if (tempTypeInSession == TEMP_TYPE_SUBR_USER || tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) {
//            $('#crsr_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 8, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
        }
        $.ajax({
            url: 'main/get_dashboard_data',
            type: 'post',
            data: getTokenData(),
            error: function (textStatus, errorThrown) {
                if (tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                    $('#mam_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 13, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                    $('#fees_status_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 11, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                    $('#general_application_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 10, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                } else if (tempTypeInSession == TEMP_TYPE_EOCS_FS || tempTypeInSession == TEMP_TYPE_EOCS_HEAD || tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_EOCS_JFS) {
                    $('#fees_status_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 14, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                } else if (tempTypeInSession == TEMP_TYPE_SUBR_USER || tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) {
//                    $('#crsr_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 8, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                } else {
                    $('#mam_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 12, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                    $('#fees_status_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 14, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                }
                $('.null-value').html(0);
                generateNewCSRFToken();
                showError(textStatus.statusText);
                $('html, body').animate({scrollTop: '0px'}, 0);
            },
            success: function (response) {
                var parseData = JSON.parse(response);
                setNewToken(parseData.temp_token);
                if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER || tempTypeInSession == TEMP_TYPE_MAM_VIEW_USER) {
                    $('#total_dapvr_cases_for_dashboard').html(parseData.total_cases);
                    $('#pending_dapvr_cases_for_dashboard').html(parseData.pending_cases);
                    $('#close_dapvr_cases_for_dashboard').html(parseData.close_cases);
                    $('#today_hearing_dapvr_cases_for_dashboard').html(parseData.today_hearing_cases);
                    $('#this_month_hearing_dapvr_cases_for_dashboard').html(parseData.this_month_hearing_cases);
                    $('#next_month_hearing_dapvr_cases_for_dashboard').html(parseData.next_month_hearing_cases);
                    $('#pass_dapvr_cases_for_dashboard').html(parseData.pass_cases);
                }
                if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER || tempTypeInSession == TEMP_TYPE_ACI_USER ||
                        tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_MAM_VIEW_USER) {
                    that.loadMamCertificateDetails(parseData.mam_certificate_details);
                }
                if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER ||
                        tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER || tempTypeInSession == TEMP_TYPE_EOCS_FS || tempTypeInSession == TEMP_TYPE_EOCS_JFS ||
                        tempTypeInSession == TEMP_TYPE_EOCS_HEAD || tempTypeInSession == TEMP_TYPE_EOCS_HS || tempTypeInSession == TEMP_TYPE_MAM_VIEW_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    that.loadFeesStatusDetails(parseData.fees_status_details);
                }
                if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_SUBR_USER || tempTypeInSession == TEMP_TYPE_SUBR_VER_USER) {
                    $('#application_submitted_for_dashboard').html(parseData.total_application_submitted);
                    $('#doc_verify_appointment_approval_pending_for_dashboard').html(parseData.total_doc_verify_appointment_approval_pending);
                    $('#doc_verify_appointment_pending_for_dashboard').html(parseData.total_doc_verify_appointment_pending);
                    $('#doc_verify_appointment_scheduled_for_dashboard').html(parseData.total_doc_verify_appointment_scheduled);
                    $('#document_register_for_dashboard').html(parseData.total_document_register);
                    $('#rejected_for_dashboard').html(parseData.total_rejected);
                    $('#todays_appointment_for_dashboard').html(parseData.todays_appointment);
                    $('#total_queried_for_dashboard').html(parseData.total_queried);
                    $('#total_response_received_for_dashboard').html(parseData.total_response_received);

//                    that.loadCrsrCertificateDetails(parseData.crsr_certificate_details);
                }
                if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_TALATHI_USER ||
                        tempTypeInSession == TEMP_TYPE_MAMLATDAR_USER || tempTypeInSession == TEMP_TYPE_LDC_USER || tempTypeInSession == TEMP_TYPE_ACI_USER) {
                    that.loadGeneralApplicationStatusDetails(parseData.ga_status_details);
                }
            }
        });
    },
    getDistWiseCalculation: function (dWiseData) {
//        var totalCnt = dWiseData['new_app'] + dWiseData['queried_app'] +
//                dWiseData['response_received_app'] + dWiseData['app_scheduled_app'] + dWiseData['reverification_app'] +
//                dWiseData['approved_app'] + dWiseData['rejected_app'];
        var totalCnt = dWiseData['total_app'];
        return parseInt(totalCnt) ? parseInt(totalCnt) : 0;
    },
    getDistWiseFeesStatusCalculation: function (dWiseData) {
        var totalFeesStatusCnt = dWiseData['total_app'] + dWiseData['queried_app'] +
                dWiseData['response_received_app'] + dWiseData['fees_paid'] + dWiseData['fees_pending'] + dWiseData['approved_app'] + dWiseData['rejected_app'];
        return parseInt(totalFeesStatusCnt) ? parseInt(totalFeesStatusCnt) : 0;
    },
    getDistWiseGAStatusCalculation: function (dWiseData) {
        var totalGAStatusCnt = dWiseData['total_app'] + dWiseData['queried_app'] +
                dWiseData['response_received_app'] + dWiseData['new_app'] + dWiseData['forwarded_app'] + dWiseData['approved_app'] + dWiseData['rejected_app'];
        return parseInt(totalGAStatusCnt) ? parseInt(totalGAStatusCnt) : 0;
    },
//    getDistWiseCalculationForCrsr: function (dWiseData) {
//        var totalCnt = dWiseData['total_app'] + dWiseData['queried_app'] +
//                dWiseData['response_received_app'] + dWiseData['approved_app'] + dWiseData['rejected_app'];
//        return parseInt(totalCnt) ? parseInt(totalCnt) : 0;
//    },
    basicDataForItem: function (serCnt, appData, serviceData, district) {
        var moduleType = serviceData.module_type;
        if (moduleType == VALUE_NINE || moduleType == VALUE_THIRTEEN || moduleType == VALUE_FOURTEEN ||
                moduleType == VALUE_FIFTEEN || moduleType == VALUE_SIXTEEN ||
                moduleType == VALUE_TWENTYTHREE || moduleType == VALUE_TWENTYFIVE) {
            appData.enable_onclick = true;
        }
//        if (moduleType == VALUE_NINE || moduleType == VALUE_THIRTEEN || moduleType == VALUE_FOURTEEN ||
//                moduleType == VALUE_FIFTEEN || moduleType == VALUE_SIXTEEN || moduleType == VALUE_TWENTYFOUR ||
//                moduleType == VALUE_TWENTYTHREE || moduleType == VALUE_TWENTYFIVE) {
//            appData.enable_fp = true;
//        }
//        if (moduleType == VALUE_TWENTYTWO) {
//            appData.enable_pgcp_sror = true;
//            appData.enable_pgcp = false;
//            appData.enable_blank_pgcp = false;
//        }
        if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_EOCS_HEAD || tempTypeInSession == TEMP_TYPE_EOCS_HS ||
                tempTypeInSession == TEMP_TYPE_EOCS_FS || tempTypeInSession == TEMP_TYPE_EOCS_JFS) {
            if (moduleType == VALUE_TWENTYTHREE || moduleType == VALUE_TWENTYFIVE || moduleType == VALUE_TWENTYFOUR) {
                appData.enable_pgcp = true;
            } else {
//                if (moduleType != VALUE_TWENTYTWO) {
                appData.enable_blank_pgcp = true;
//                }
            }
        }
        appData.item_cnt = serCnt;
        appData.service_name = serviceData.service_name;
        appData.district_text = talukaArray[district] ? talukaArray[district] : '';
        appData.district = district;
        appData.module_type = serviceData.module_type;
        appData.VALUE_ZERO = VALUE_ZERO;
        appData.VALUE_ONE = VALUE_ONE;
        appData.VALUE_TWO = VALUE_TWO;
        appData.VALUE_THREE = VALUE_THREE;
        appData.VALUE_FOUR = VALUE_FOUR;
        appData.VALUE_FIVE = VALUE_FIVE;
        appData.VALUE_SIX = VALUE_SIX;
        appData.VALUE_SEVEN = VALUE_SEVEN;
        appData.VALUE_EIGHT = VALUE_EIGHT;
        appData.VALUE_NINE = VALUE_NINE;
        appData.VALUE_TEN = VALUE_TEN;
        appData.VALUE_ELEVEN = VALUE_ELEVEN;
        appData.VALUE_THIRTEEN = VALUE_THIRTEEN;
        appData.VALUE_EIGHTEEN = VALUE_EIGHTEEN;
        appData.VALUE_NINETEEN = VALUE_NINETEEN;
        appData.VALUE_TWENTY = VALUE_TWENTY;
        appData.VALUE_TWENTYTWO = VALUE_TWENTYTWO;
        appData.VALUE_TWENTYTHREE = VALUE_TWENTYTHREE;
        appData.VALUE_TWENTYFOUR = VALUE_TWENTYFOUR;
        appData.VALUE_THIRTY = VALUE_THIRTY;
        return appData;
    },
    loadMamCertificateDetails: function (mamCertDetails) {
        var that = this;
        var serCnt = 1;
        var damanData = {};
        var diuData = {};
        var dnhData = {};
        $.each(mamCertDetails, function (index, serviceData) {
            if (serCnt == 1) {
                $('#mam_dash_item_container_for_dashboard').html('');
            }
            serviceData.item_cnt = serCnt;
            damanData = serviceData[TALUKA_DAMAN] ? serviceData[TALUKA_DAMAN] : {};
            if (that.getDistWiseCalculation(damanData) != VALUE_ZERO) {
                damanData = that.basicDataForItem(serCnt, damanData, serviceData, TALUKA_DAMAN);
                $('#mam_dash_item_container_for_dashboard').append(dashboardMamItemTemplate(damanData));
                serCnt++;
            }
            diuData = serviceData[TALUKA_DIU] ? serviceData[TALUKA_DIU] : {};
            if (that.getDistWiseCalculation(diuData) != VALUE_ZERO) {
                diuData = that.basicDataForItem(serCnt, diuData, serviceData, TALUKA_DIU);
                $('#mam_dash_item_container_for_dashboard').append(dashboardMamItemTemplate(diuData));
                serCnt++;
            }
            dnhData = serviceData[TALUKA_DNH] ? serviceData[TALUKA_DNH] : {};
            if (that.getDistWiseCalculation(dnhData) != VALUE_ZERO) {
                dnhData = that.basicDataForItem(serCnt, dnhData, serviceData, TALUKA_DNH);
                $('#mam_dash_item_container_for_dashboard').append(dashboardMamItemTemplate(dnhData));
                serCnt++;
            }
        });
        if (serCnt == VALUE_ONE) {
            if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
                $('#mam_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 13, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
            } else {
                $('#mam_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 12, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
            }
        }
    },
//    loadCrsrCertificateDetails: function (crsrCertDetails) {
//        var that = this;
//        var serCnt = 1;
//        var damanData = {};
//        var diuData = {};
//        var dnhData = {};
//        $.each(crsrCertDetails, function (index, serviceData) {
//            if (serCnt == 1) {
//                $('#crsr_dash_item_container_for_dashboard').html('');
//            }
//            serviceData.item_cnt = serCnt;
//            damanData = serviceData[TALUKA_DAMAN] ? serviceData[TALUKA_DAMAN] : {};
//            if (that.getDistWiseCalculationForCrsr(damanData) != VALUE_ZERO) {
//                damanData = that.basicDataForItem(serCnt, damanData, serviceData, TALUKA_DAMAN);
//                $('#crsr_dash_item_container_for_dashboard').append(dashboardCrsrItemTemplate(damanData));
//                serCnt++;
//            }
//            diuData = serviceData[TALUKA_DIU] ? serviceData[TALUKA_DIU] : {};
//            if (that.getDistWiseCalculationForCrsr(diuData) != VALUE_ZERO) {
//                diuData = that.basicDataForItem(serCnt, diuData, serviceData, TALUKA_DIU);
//                $('#crsr_dash_item_container_for_dashboard').append(dashboardCrsrItemTemplate(diuData));
//                serCnt++;
//            }
//            dnhData = serviceData[TALUKA_DNH] ? serviceData[TALUKA_DNH] : {};
//            if (that.getDistWiseCalculationForCrsr(dnhData) != VALUE_ZERO) {
//                dnhData = that.basicDataForItem(serCnt, dnhData, serviceData, TALUKA_DNH);
//                $('#crsr_dash_item_container_for_dashboard').append(dashboardCrsrItemTemplate(dnhData));
//                serCnt++;
//            }
//        });
//        if (serCnt == VALUE_ONE) {
//            if (tempTypeInSession == TEMP_TYPE_TALATHI_USER) {
//                $('#crsr_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 13, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
//            } else {
//                $('#crsr_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 12, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
//            }
//        }
//    },
    loadFeesStatusDetails: function (mamFormsDetails) {
        var that = this;
        var serCnt = 1;
        var damanData = {};
        var diuData = {};
        var dnhData = {};
        $.each(mamFormsDetails, function (index, serviceData) {
            if (serCnt == 1) {
                $('#fees_status_dash_item_container_for_dashboard').html('');
            }
            serviceData.item_cnt = serCnt;
            damanData = serviceData[TALUKA_DAMAN] ? serviceData[TALUKA_DAMAN] : {};
            if (that.getDistWiseFeesStatusCalculation(damanData) != VALUE_ZERO) {
                damanData = that.basicDataForItem(serCnt, damanData, serviceData, TALUKA_DAMAN);
                $('#fees_status_dash_item_container_for_dashboard').append(dashboardFeesStatusItemTemplate(damanData));
                serCnt++;
            }
            diuData = serviceData[TALUKA_DIU] ? serviceData[TALUKA_DIU] : {};
            if (that.getDistWiseFeesStatusCalculation(diuData) != VALUE_ZERO) {
                diuData = that.basicDataForItem(serCnt, diuData, serviceData, TALUKA_DIU);
                $('#fees_status_dash_item_container_for_dashboard').append(dashboardFeesStatusItemTemplate(diuData));
                serCnt++;
            }
            dnhData = serviceData[TALUKA_DNH] ? serviceData[TALUKA_DNH] : {};
            if (that.getDistWiseFeesStatusCalculation(dnhData) != VALUE_ZERO) {
                dnhData = that.basicDataForItem(serCnt, dnhData, serviceData, TALUKA_DNH);
                $('#fees_status_dash_item_container_for_dashboard').append(dashboardFeesStatusItemTemplate(dnhData));
                serCnt++;
            }
        });
        if (serCnt == VALUE_ONE) {
            if (tempTypeInSession == TEMP_TYPE_A || tempTypeInSession == TEMP_TYPE_ACI_USER || tempTypeInSession == TEMP_TYPE_EOCS_HEAD || tempTypeInSession == TEMP_TYPE_EOCS_HS ||
                    tempTypeInSession == TEMP_TYPE_EOCS_FS || tempTypeInSession == TEMP_TYPE_EOCS_JFS) {
                $('#fees_status_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 14, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
            } else {
                $('#fees_status_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 11, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
            }
        }
    },
    loadGeneralApplicationStatusDetails: function (serviceData) {
        var that = this;
        var serCnt = 1;
        var damanData = {};
        var diuData = {};
        var dnhData = {};
        if (serCnt == 1) {
            $('#general_application_dash_item_container_for_dashboard').html('');
        }
        serviceData.item_cnt = serCnt;
        damanData = serviceData[TALUKA_DAMAN] ? serviceData[TALUKA_DAMAN] : {};
        if (that.getDistWiseGAStatusCalculation(damanData) != VALUE_ZERO) {
            damanData = serviceData[TALUKA_DAMAN] ? serviceData[TALUKA_DAMAN] : {};
            damanData = that.basicDataForItem(serCnt, damanData, serviceData, TALUKA_DAMAN);
            $('#general_application_dash_item_container_for_dashboard').append(dashboardGeneralApplicationStatusItemTemplate(damanData));
            serCnt++;
        }

        diuData = serviceData[TALUKA_DIU] ? serviceData[TALUKA_DIU] : {};
        if (that.getDistWiseGAStatusCalculation(diuData) != VALUE_ZERO) {
            diuData = serviceData[TALUKA_DIU] ? serviceData[TALUKA_DIU] : {};
            diuData = that.basicDataForItem(serCnt, diuData, serviceData, TALUKA_DIU);
            $('#general_application_dash_item_container_for_dashboard').append(dashboardGeneralApplicationStatusItemTemplate(diuData));
            serCnt++;
        }

        dnhData = serviceData[TALUKA_DNH] ? serviceData[TALUKA_DNH] : {};
        if (that.getDistWiseGAStatusCalculation(dnhData) != VALUE_ZERO) {
            dnhData = serviceData[TALUKA_DNH] ? serviceData[TALUKA_DNH] : {};
            dnhData = that.basicDataForItem(serCnt, dnhData, serviceData, TALUKA_DNH);
            $('#general_application_dash_item_container_for_dashboard').append(dashboardGeneralApplicationStatusItemTemplate(dnhData));
            serCnt++;
        }
        if (serCnt == VALUE_ONE) {
            $('#general_application_dash_item_container_for_dashboard').html(noRecordFoundTemplate({'colspan': 10, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
        }
    },
    changeRouterForMam: function (moduleType, district, sType, pgpcType) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (district != TALUKA_DAMAN && district != TALUKA_DIU && district != TALUKA_DNH) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        switch (moduleType) {
            case VALUE_ONE:
                Domicile.listview.listPage(district, sType);
                break;
            case VALUE_TWO:
                IncomeCertificate.listview.listPage(district, sType);
                break;
            case VALUE_THREE:
                Heirship.listview.listPage(district, sType);
                break;
            case VALUE_FOUR:
                CasteCertificate.listview.listPage(district, sType);
                break;
            case VALUE_FIVE:
                ObcCertificate.listview.listPage(district, sType);
                break;
            case VALUE_SIX:
                NclCertificate.listview.listPage(district, sType);
                break;
            case VALUE_SEVEN:
                EwsCertificate.listview.listPage(district, sType);
                break;
            case VALUE_NINE:
                CertifiedCopy.listview.listPage(district, sType);
                break;
            case VALUE_THIRTEEN:
                FormOneFourteen.listview.listPage(district, sType);
                break;
            case VALUE_FOURTEEN:
                FormThree.listview.listPage(district, sType);
                break;
            case VALUE_FIFTEEN:
                FormFive.listview.listPage(district, sType);
                break;
            case VALUE_SIXTEEN:
                FormNine.listview.listPage(district, sType);
                break;
            case VALUE_EIGHTEEN:
                MarriageCertificate.listview.listPage(district, sType);
                break;
            case VALUE_NINETEEN:
                BirthCertificate.listview.listPage(district, sType);
                break;
            case VALUE_TWENTY:
                DeathCertificate.listview.listPage(district, sType);
                break;
            case VALUE_TWENTYTWO:
                SvamitvaRor.listview.listPage(district, sType, pgpcType);
                break;
            case VALUE_TWENTYTHREE:
                EocsSitePlan.listview.listPage(district, sType, pgpcType);
                break;
            case VALUE_TWENTYFOUR:
                PropertyCard.listview.listPage(district, sType, pgpcType);
                break;
            case VALUE_TWENTYFIVE:
                EocsSitePlanRural.listview.listPage(district, sType, pgpcType);
                break;
            case VALUE_TWENTYSEVEN:
                LandTaxNA.listview.listPage(district, sType);
                break;
            case VALUE_TWENTYNINE:
                LandTaxAgriculture.listview.listPage(district, sType);
                break;
            case VALUE_THIRTY:
                GeneralApplication.listview.listPage(district, sType, pgpcType);
                break;
        }
    },
    listPageForOPH: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_opd');
        addClass('menu_oph', 'active');
        Dashboard.router.navigate('online_payment_history');
        var templateData = {};
        this.$el.html(ophListTemplate(templateData));
        if (tempTypeInSession == TEMP_TYPE_A) {
            renderOptionsForTwoDimensionalArray(talukaArray, 'district_for_oph_list', false);
        }
        renderOptionsForTwoDimensionalArray(deptNameArray, 'dept_name_for_oph_list', false);
        renderOptionsForTwoDimensionalArray(pgStatusArray, 'pg_status_for_oph_list', false);
        this.loadOPHData();
    },
    loadOPHData: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var feeRenderer = function (data, type, full, meta) {
            return data + ' /-';
        };
        var deptNameRenderer = function (data, type, full, meta) {
            return getDeptName(data);
        };
        var serviceNameRenderer = function (data, type, full, meta) {
            return getServiceName(data);
        };
        var opMessageRenderer = function (data, type, full, meta) {
            return pgMessage(data, full.fees_payment_id);
        };
        var tdtRenderer = function (data, type, full, meta) {
            return full.op_transaction_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(full.op_transaction_datetime) : (full.op_start_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(full.op_start_datetime) : '-');
        };
        var actionRenderer = function (data, type, full, meta) {
            return ophActionTemplate({'fees_payment_id': data});
        };
        ophDataTable = $('#oph_datatable').DataTable({
            ajax: {url: 'utility/get_all_payment_history', dataSrc: "payment_history", type: "post"},
            bAutoWidth: false,
            pageLength: 25,
            ordering: false,
            processing: true,
            language: dataTableProcessingAndNoDataMsg,
            serverSide: true,
            columns: [
                {data: '', 'render': serialNumberRenderer, 'class': 'text-center'},
                {data: 'district', 'class': 'text-center', 'render': districtRenderer},
                {data: 'module_type', 'render': deptNameRenderer},
                {data: 'module_type', 'render': serviceNameRenderer},
                {data: 'application_number', 'class': 'text-center f-w-b'},
                {data: '', 'class': 'text-center', 'render': tdtRenderer},
                {data: 'total_fees', 'class': 'text-right', 'render': feeRenderer},
                {data: 'reference_id', 'class': 'text-center'},
                {data: 'op_status', 'class': 'text-center', 'render': pgStatusRenderer},
                {data: 'op_message', 'render': opMessageRenderer},
                {data: 'fees_payment_id', 'class': 'text-center', 'render': actionRenderer},
            ],
            "initComplete": searchableDatatable
        });
        $('#oph_datatable_filter').remove();
    },
    getBasicOPHDetails: function (btnObj, feesPaymentId) {
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
            url: 'utility/get_oph_data_by_id',
            type: 'post',
            data: $.extend({}, {'fees_payment_id': feesPaymentId}, getTokenData()),
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
                    $('html, body').animate({scrollTop: '0px'}, 0);
                    return false;
                }
                that.loadDVDetails(parseData);
            }
        });
    },
    loadDVDetails: function (parseData) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        var fpData = parseData.fp_data;
        var dvData = parseData.dv_data;
        showPopup();
        fpData.district_text = talukaArray[fpData.district] ? talukaArray[fpData.district] : '';
        fpData.department_name = getDeptName(fpData.module_type);
        fpData.service_name = getServiceName(fpData.module_type);
        fpData.transaction_datetime_text = fpData.op_transaction_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(fpData.op_transaction_datetime) : (fpData.op_start_datetime != '0000-00-00 00:00:00' ? dateTo_DD_MM_YYYY_HH_II_SS(fpData.op_start_datetime) : '-');
        fpData.payment_status_text = pgStatus(fpData.op_status, fpData.fees_payment_id);
        $('#popup_container').html(dvListTemplate(fpData));
        var tempDVCnt = 1;
        $.each(dvData, function (index, dv) {
            loadDVRow(dv);
            tempDVCnt++;
        });
        if (tempDVCnt == 1) {
            $('#dv_item_container').html(noRecordFoundTemplate({'colspan': 8, 'message': 'No Data Available !'}));
        }
        resetCounter('dv-cnt');
        $('.swal2-popup').css('width', '60em');
    },
    listPageForHWR: function () {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        activeLink('menu_opd');
        addClass('menu_hwr', 'active');
        Dashboard.router.navigate('head_wise_report');
        var templateData = {};
        this.$el.html(hwrListTemplate(templateData));
        datePicker();
        $('#from_date_for_hwr').val(dateTo_DD_MM_YYYY());
        this.searchHWR($('#search_btn_for_hwr'));
    },
    searchHWR: function (btnObj) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        $('.h_field_for_hwr').val('');
        $('#hwr_datatable_container_for_hwr').html(hwrTableTemplate);
        var that = this;
        $('#total_online_payment_received_for_hwr').html(VALUE_ZERO);
        $('#item_container_for_hwr').html(noRecordFoundTemplate({'colspan': 16, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
        var searchData = $('#hwr_form').serializeFormJSON();
        if (!searchData.from_date_for_hwr && !searchData.to_date_for_hwr) {
            showError(fromToDateValidationMessage);
            return false;
        }
        $('#h_from_date_for_hwr').val(searchData.from_date_for_hwr);
        $('#h_to_date_for_hwr').val(searchData.to_date_for_hwr);
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $('#item_container_for_hwr').html(noRecordFoundTemplate({'colspan': 16, 'message': dataTableProcessingAndNoDataMsg.loadingRecords}));
        $.ajax({
            url: 'utility/get_head_wise_report_data',
            type: 'post',
            data: $.extend({}, searchData, getTokenData()),
            error: function (textStatus, errorThrown) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                $('#total_online_payment_received_for_hwr').html(VALUE_ZERO);
                $('#item_container_for_hwr').html(noRecordFoundTemplate({'colspan': 16, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
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
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                $('#total_online_payment_received_for_hwr').html(VALUE_ZERO);
                var parseData = JSON.parse(response);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    showError(parseData.message);
                    $('#item_container_for_hwr').html(noRecordFoundTemplate({'colspan': 16, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                    return false;
                }
                var hwrData = parseData.hwr_data;
                if (hwrData.length == VALUE_ZERO) {
                    $('#item_container_for_hwr').html(noRecordFoundTemplate({'colspan': 16, 'message': dataTableProcessingAndNoDataMsg.emptyTable}));
                    return false;
                }
                $('#item_container_for_hwr').html('');
                that.loadHWR(hwrData);
            }
        });
    },
    loadHWR: function (hwrData) {
        var tCnt = VALUE_ONE;
        var tdwCnt = VALUE_ONE;
        var thwCnt = VALUE_ONE;
        var totalORP = VALUE_ZERO;
        var totalFPORP = VALUE_ZERO;
        $.each(hwrData, function (index, hwr) {
            hwr.temp_cnt = tCnt;
            $('#item_container_for_hwr').append(hwrItemTemplate(hwr));
            totalFPORP += parseInt(hwr.fp_total) ? parseInt(hwr.fp_total) : VALUE_ZERO;
            tdwCnt = 1;
            $.each(hwr.dwise, function (index, dwiseDetails) {
                if (tdwCnt == VALUE_ONE) {
                    $('#dwise_item_container_for_hwr_' + hwr.module_type).html('<div id="hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district + '">' + dwiseDetails.district_name + '</div>');
                } else {
                    $('#item_container_for_hwr').append('<tr><td></td><td></td><td></td><td class="text-center"><div id="hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district + '">' + dwiseDetails.district_name + '</div></td>'
                            + '</tr>');
                }
                thwCnt = 1;
                $.each(dwiseDetails.head_wise, function (fullHead, hwise) {
                    totalORP += parseInt(hwise.hw_total_fees) ? parseInt(hwise.hw_total_fees) : VALUE_ZERO;
                    if (thwCnt == VALUE_ONE) {
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-right">' + hwise.hw_total_fees + '/-</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.pao_code ? hwise.pao_code : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.ddo_code ? hwise.ddo_code : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.grant_number ? hwise.grant_number : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.major_head ? hwise.major_head : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.sub_major_head ? hwise.sub_major_head : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.minor_head ? hwise.minor_head : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.sub_head ? hwise.sub_head : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.detailed_head ? hwise.detailed_head : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.object ? hwise.object : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center">' + (hwise.category ? hwise.category : '') + '</td>');
                        $('#hwise_item_container_for_hwr_' + hwr.module_type + '_' + dwiseDetails.district).parent().parent().append('<td class="text-center"><button type="button" class="btn btn-sm btn-primary" title="View" '
                                + 'onclick="Dashboard.listview.viewHWR($(this),' + hwr.module_type + ',' + dwiseDetails.district + ',\'' + fullHead + '\');" style="padding: 4px 8px 2.5px 8px;">'
                                + '<i class="fas fa-eye"></i></button></td>');
                    } else {
                        $('#item_container_for_hwr').append('<tr><td></td><td></td><td></td><td></td>'
                                + '<td class="text-right">' + hwise.hw_total_fees + '/-</td>'
                                + '<td class="text-center">' + (hwise.pao_code ? hwise.pao_code : '') + '</td>'
                                + '<td class="text-center">' + (hwise.ddo_code ? hwise.ddo_code : '') + '</td>'
                                + '<td class="text-center">' + (hwise.grant_number ? hwise.grant_number : '') + '</td>'
                                + '<td class="text-center">' + (hwise.major_head ? hwise.major_head : '') + '</td>'
                                + '<td class="text-center">' + (hwise.sub_major_head ? hwise.sub_major_head : '') + '</td>'
                                + '<td class="text-center">' + (hwise.minor_head ? hwise.minor_head : '') + '</td>'
                                + '<td class="text-center">' + (hwise.sub_head ? hwise.sub_head : '') + '</td>'
                                + '<td class="text-center">' + (hwise.detailed_head ? hwise.detailed_head : '') + '</td>'
                                + '<td class="text-center">' + (hwise.object ? hwise.object : '') + '</td>'
                                + '<td class="text-center">' + (hwise.category ? hwise.category : '') + '</td>'
                                + '<td class="text-center"><button type="button" class="btn btn-sm btn-primary" title="View" '
                                + 'onclick="Dashboard.listview.viewHWR($(this),' + hwr.module_type + ',' + dwiseDetails.district + ',\'' + fullHead + '\');" style="padding: 4px 8px 2.5px 8px;">'
                                + '<i class="fas fa-eye"></i></button></td>'
                                + '</tr>');
                    }
                    thwCnt++;
                });
                tdwCnt++;
            });
            tCnt++;
        });
//        if (totalORP != totalFPORP) {
//            $('#total_online_payment_received_for_hwr').html('<span class="text-danger">' + totalORP + '<span>');
//        } else {
        $('#total_online_payment_received_for_hwr').html(totalORP);
//        }
        $('#hwr_datatable').DataTable({
            ordering: false, paging: false, info: false, searching: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csvHtml5',
                    title: 'Head Wise Report - ' + dateTo_DD_MM_YYYY_HH_II_SS(),
                    text: '<i class="fas fa-file-excel"></i> &nbsp; Download CSV',
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Head Wise Report - ' + dateTo_DD_MM_YYYY_HH_II_SS(),
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    text: '<i class="fas fa-file-pdf"></i> &nbsp; Download PDF',
                    footer: true
                }
            ]
        });
    },
    viewHWR: function (btnObj, moduleType, district, fullHead) {
        if (!tempIdInSession || tempIdInSession == null) {
            loginPage();
            return false;
        }
        if (!moduleType || (district != VALUE_ONE && district != VALUE_TWO && district != VALUE_THREE) || !fullHead) {
            showError(invalidAccessValidationMessage);
            return false;
        }
        var searchData = {};
        searchData.module_type = moduleType;
        searchData.district = district;
        searchData.full_head = fullHead;
        searchData.from_date = $('#h_from_date_for_hwr').val();
        searchData.to_date = $('#h_to_date_for_hwr').val();
        var ogBtnHTML = btnObj.html();
        var ogBtnOnclick = btnObj.attr('onclick');
        btnObj.html(iconSpinnerTemplate);
        btnObj.attr('onclick', '');
        $.ajax({
            url: 'utility/get_module_district_hwr_data',
            type: 'post',
            data: $.extend({}, searchData, getTokenData()),
            error: function (textStatus, errorThrown) {
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
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
                btnObj.html(ogBtnHTML);
                btnObj.attr('onclick', ogBtnOnclick);
                var parseData = JSON.parse(response);
                if (parseData.is_logout === true) {
                    loginPage();
                    return false;
                }
                setNewToken(parseData.temp_token);
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                var mtData = parseData.mt_data;
                var mdHWRData = parseData.md_hwr_data;
                mtData.district_text = talukaArray[district] ? talukaArray[district] : '';
                showPopup();
                $('.swal2-popup').css('width', '45em');
                $('#popup_container').html(hwrViewListTemplate(mtData));
                var totalFee = 0;
                $.each(mdHWRData, function (index, mdhwr) {
                    totalFee += parseInt(mdhwr.fee) ? parseInt(mdhwr.fee) : VALUE_ZERO;
                    $('#item_container_for_dhwr_view').append('<tr><td class="f-w-b text-center">' + (index + 1) + '</td>'
                            + '<td class="text-center">' + mdhwr.op_transaction_datetime + '</td>'
                            + '<td class="text-center">' + mdhwr.application_number + '</td>'
                            + '<td class="text-right">' + mdhwr.total_fees + '/-</td>'
                            + '<td>' + mdhwr.fee_description + '</td>'
                            + '<td class="text-right">' + mdhwr.fee + '/-</td></tr>');
                });
                $('.orp_for_hwr_view').html(totalFee);

                $('#dhwr_datatable').DataTable({
                    ordering: false, paging: false, info: false, searching: false,
                    language: dataTableProcessingAndNoDataMsg,
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'csvHtml5',
                            title: 'Detailed Head Wise Report - ' + dateTo_DD_MM_YYYY_HH_II_SS(),
                            text: '<i class="fas fa-file-excel"></i> &nbsp; Download CSV',
                            footer: true
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Detailed Head Wise Report - ' + dateTo_DD_MM_YYYY_HH_II_SS(),
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            text: '<i class="fas fa-file-pdf"></i> &nbsp; Download PDF',
                            footer: true
                        }
                    ]
                });
            }
        });
    }
});
