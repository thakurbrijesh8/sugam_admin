<?php $base_url = base_url(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>SUGAM ADMIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->load->view('common/css_links', array('base_url' => $base_url)); ?>
        <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/datetimepicker/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>plugins/osm/leaflet.css">
        <?php
        $this->load->view('common/utility_template');
        $this->load->view('common/js_links', array('base_url' => $base_url));
        ?>
        <script src="<?php echo $base_url; ?>js/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>adminLTE/js/demo.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>plugins/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>plugins/osm/leaflet.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>plugins/select2/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>js/mordanizr.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>js/underscore.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>js/backbone.js" type="text/javascript"></script>
        <script src="<?php echo $base_url; ?>js/handlebars.js" type="text/javascript"></script>
        <?php $this->load->view('common/validation_message'); ?>
        <script type = "text/javascript">
            var tempIdInSession = <?php echo get_from_session('temp_id_for_sugam_admin'); ?>;
            var tempTypeInSession = <?php echo get_from_session('temp_type_for_sugam_admin'); ?>;
            var tempDistrictInSession = <?php echo get_from_session('temp_district_for_sugam_admin'); ?>;
            var tempAVInSession = '<?php echo get_from_session('temp_av_for_sugam_admin'); ?>';
            var optionTemplate = Handlebars.compile($('#option_template').html());
            var tagSpinnerTemplate = Handlebars.compile($('#tag_spinner_template').html());
            var spinnerTemplate = Handlebars.compile($('#spinner_template').html());
            var noRecordFoundTemplate = Handlebars.compile($('#no_record_found_template').html());
            var pageSpinnerTemplate = Handlebars.compile($('#page_spinner_template').html());
            var iconSpinnerTemplate = spinnerTemplate({'type': 'light', 'extra_class': 'spinner-border-small'});
            var fpMailHistoryTemplate = Handlebars.compile($('#fp_mail_history_template').html());
            var IS_DEACTIVE = <?php echo IS_DEACTIVE ?>;
            var IS_DELETE = <?php echo IS_DELETE ?>;
            var defaultPassword = '<?php echo DEFAULT_PASSWORD ?>';
            var isChecked = <?php echo IS_CHECKED_YES ?>;

            var DAMAN_LAT = <?php echo DAMAN_LAT ?>;
            var DAMAN_LNG = <?php echo DAMAN_LNG ?>;

            var IS_CHECKED_YES = <?php echo IS_CHECKED_YES; ?>;
            var IS_CHECKED_NO = <?php echo IS_CHECKED_NO; ?>;

            var PER_COPY_PRICE = <?php echo PER_COPY_PRICE; ?>;
            var RLP_RA_PRICE_PER_GUNTHA = <?php echo RLP_RA_PRICE_PER_GUNTHA; ?>;
            var RLP_UA_PRICE_PER_GUNTHA = <?php echo RLP_UA_PRICE_PER_GUNTHA; ?>;
            var NA_NATURE_CODE = '<?php echo NA_NATURE_CODE; ?>';

            var payTemplate = Handlebars.compile($('#pay_template').html());
            var fbListTemplate = Handlebars.compile($('#fb_list_template').html());
            var fbItemViewTemplate = Handlebars.compile($('#fb_item_view_template').html());
            var phListTemplate = Handlebars.compile($('#ph_list_template').html());
            var phItemTemplate = Handlebars.compile($('#ph_item_template').html());
            var updListTemplate = Handlebars.compile($('#upd_list_template').html());
            var updItemTemplate = Handlebars.compile($('#upd_item_template').html());

            var queryModuleArray = <?php echo json_encode($this->config->item('query_module_array')); ?>;
            var pgStatusArray = <?php echo json_encode($this->config->item('pg_status_array')); ?>;
            var pgStatusTextArray = <?php echo json_encode($this->config->item('pg_status_text_array')); ?>;
            var deptNameArray = <?php echo json_encode($this->config->item('dept_name_array')); ?>;
            var dvStatusArray = <?php echo json_encode($this->config->item('dv_status_array')); ?>;
            var dvStatusTextArray = <?php echo json_encode($this->config->item('dv_status_text_array')); ?>;

            var talukaArray = <?php echo json_encode($this->config->item('taluka_array')); ?>;
            var TALUKA_DAMAN = <?php echo TALUKA_DAMAN; ?>;
            var TALUKA_DIU = <?php echo TALUKA_DIU; ?>;
            var TALUKA_DNH = <?php echo TALUKA_DNH; ?>;

            var dgAPITypeArray = <?php echo json_encode($this->config->item('dg_api_type_array')); ?>;
            var emailTypeArray = <?php echo json_encode($this->config->item('email_type_array')); ?>;
            var dddAPITypeArray = <?php echo json_encode($this->config->item('api_ddd_type')); ?>;
            var appTypeArray = <?php echo json_encode($this->config->item('app_type_array')); ?>;
            var smsTypeArray = <?php echo json_encode($this->config->item('sms_type_array')); ?>;

            var TEMP_TYPE_A = <?php echo TEMP_TYPE_A; ?>;
            var TEMP_TYPE_TALATHI_USER = <?php echo TEMP_TYPE_TALATHI_USER; ?>;
            var TEMP_TYPE_ACI_USER = <?php echo TEMP_TYPE_ACI_USER; ?>;
            var TEMP_TYPE_MAMLATDAR_USER = <?php echo TEMP_TYPE_MAMLATDAR_USER; ?>;
            var TEMP_TYPE_EOCS_FS = <?php echo TEMP_TYPE_EOCS_FS; ?>;
            var TEMP_TYPE_LDC_USER = <?php echo TEMP_TYPE_LDC_USER; ?>;
            var TEMP_TYPE_SDPO_USER = <?php echo TEMP_TYPE_SDPO_USER; ?>;
            var TEMP_TYPE_SUBR_USER = <?php echo TEMP_TYPE_SUBR_USER; ?>;
            var TEMP_TYPE_SUBR_VER_USER = <?php echo TEMP_TYPE_SUBR_VER_USER; ?>;
            var TEMP_TYPE_USER_ACC_VER = <?php echo TEMP_TYPE_USER_ACC_VER; ?>;
            var TEMP_TYPE_EOCS_HEAD = <?php echo TEMP_TYPE_EOCS_HEAD; ?>;
            var TEMP_TYPE_EOCS_HS = <?php echo TEMP_TYPE_EOCS_HS; ?>;
            var TEMP_TYPE_EOCS_JFS = <?php echo TEMP_TYPE_EOCS_JFS; ?>;
            var TEMP_TYPE_MAM_VIEW_USER = <?php echo TEMP_TYPE_MAM_VIEW_USER; ?>;

            var appStatusArray = <?php echo json_encode($this->config->item('app_status_array')); ?>;
            var appStatusTextArray = <?php echo json_encode($this->config->item('app_status_text_array')); ?>;
            var fAppStatusArray = <?php echo json_encode($this->config->item('f_app_status_array')); ?>;
            var dashfAppStatusArray = <?php echo json_encode($this->config->item('dash_f_app_status_array')); ?>;
            var fAppStatusTextArray = <?php echo json_encode($this->config->item('f_app_status_text_array')); ?>;
            var caseStatusArray = <?php echo json_encode($this->config->item('case_status_array')); ?>;
            var paymentTypeArray = <?php echo json_encode($this->config->item('payment_type_array')); ?>;
            var yesNoArray = <?php echo json_encode($this->config->item('yes_no_array')); ?>;
            var eYesNoArray = <?php echo json_encode($this->config->item('e_yes_no_array')); ?>;
            var userStatusArray = <?php echo json_encode($this->config->item('user_status_array')); ?>;
            var relationDeceasedPersonArray = <?php echo json_encode($this->config->item('relation_deceased_person_array')); ?>;
            var aliveDeathStatusArray = <?php echo json_encode($this->config->item('alive_death_status_array')); ?>;
            var applicantobccasteArray = <?php echo json_encode($this->config->item('applicant_obc_caste_array')); ?>;
            var applicantobccasteArrayOne = <?php echo json_encode($this->config->item('applicant_obc_caste_arrayOne')); ?>;
            var applicantobccasteArrayTwo = <?php echo json_encode($this->config->item('applicant_obc_caste_arrayTwo')); ?>;
            var applicantobccasteArrayThree = <?php echo json_encode($this->config->item('applicant_obc_caste_arrayThree')); ?>;
            var rtiTypeArray = <?php echo json_encode($this->config->item('rti_type_array')); ?>;
            var NextHearingArray = <?php echo json_encode($this->config->item('Next_hearing_array')); ?>;


            var relationStatusArray = <?php echo json_encode($this->config->item('relation_status_array')); ?>;
            var applyingForArray = <?php echo json_encode($this->config->item('applying_for_array')); ?>;
            var dateYearArray = <?php echo json_encode($this->config->item('date_year_array')); ?>;


            var VALUE_ZERO = <?php echo VALUE_ZERO; ?>;
            var VALUE_ONE = <?php echo VALUE_ONE; ?>;
            var VALUE_TWO = <?php echo VALUE_TWO; ?>;
            var VALUE_THREE = <?php echo VALUE_THREE; ?>;
            var VALUE_FOUR = <?php echo VALUE_FOUR; ?>;
            var VALUE_FIVE = <?php echo VALUE_FIVE; ?>;
            var VALUE_SIX = <?php echo VALUE_SIX; ?>;
            var VALUE_SEVEN = <?php echo VALUE_SEVEN; ?>;
            var VALUE_EIGHT = <?php echo VALUE_EIGHT; ?>;
            var VALUE_NINE = <?php echo VALUE_NINE; ?>;
            var VALUE_TEN = <?php echo VALUE_TEN; ?>;
            var VALUE_ELEVEN = <?php echo VALUE_ELEVEN; ?>;
            var VALUE_TWELVE = <?php echo VALUE_TWELVE; ?>;
            var VALUE_THIRTEEN = <?php echo VALUE_THIRTEEN; ?>;
            var VALUE_FOURTEEN = <?php echo VALUE_FOURTEEN; ?>;
            var VALUE_FIFTEEN = <?php echo VALUE_FIFTEEN; ?>;
            var VALUE_SIXTEEN = <?php echo VALUE_SIXTEEN; ?>;
            var VALUE_SEVENTEEN = <?php echo VALUE_SEVENTEEN; ?>;
            var VALUE_EIGHTEEN = <?php echo VALUE_EIGHTEEN; ?>;
            var VALUE_NINETEEN = <?php echo VALUE_NINETEEN; ?>;
            var VALUE_TWENTY = <?php echo VALUE_TWENTY; ?>;
            var VALUE_TWENTYONE = <?php echo VALUE_TWENTYONE; ?>;
            var VALUE_TWENTYTWO = <?php echo VALUE_TWENTYTWO; ?>;
            var VALUE_TWENTYTHREE = <?php echo VALUE_TWENTYTHREE; ?>;
            var VALUE_TWENTYFOUR = <?php echo VALUE_TWENTYFOUR; ?>;
            var VALUE_TWENTYFIVE = <?php echo VALUE_TWENTYFIVE; ?>;
            var VALUE_TWENTYSIX = <?php echo VALUE_TWENTYSIX; ?>;
            var VALUE_TWENTYSEVEN = <?php echo VALUE_TWENTYSEVEN; ?>;
            var VALUE_TWENTYEIGHT = <?php echo VALUE_TWENTYEIGHT; ?>;
            var VALUE_TWENTYNINE = <?php echo VALUE_TWENTYNINE; ?>;
            var VALUE_THIRTY = <?php echo VALUE_THIRTY; ?>;
            var VALUE_THIRTYONE = <?php echo VALUE_THIRTYONE; ?>;
            var VALUE_THIRTYTWO = <?php echo VALUE_THIRTYTWO; ?>;
            var VALUE_THIRTYTHREE = <?php echo VALUE_THIRTYTHREE; ?>;
            var VALUE_THIRTYFOUR = <?php echo VALUE_THIRTYFOUR; ?>;
            var VALUE_THIRTYFIVE = <?php echo VALUE_THIRTYFIVE; ?>;


            var maxFileSizeInKb = <?php echo MAX_FILE_SIZE_IN_KB; ?>;
            var maxFileSizeInMb = <?php echo MAX_FILE_SIZE_IN_MB; ?>;

            var IS_CHECKED_YES = <?php echo IS_CHECKED_YES; ?>;
            var IS_CHECKED_NO = <?php echo IS_CHECKED_NO; ?>;
            var CONSIDERATION_AMOUNT = <?php echo CONSIDERATION_AMOUNT; ?>;
            var AUTHORIZED_PERSON_NAME = '<?php echo AUTHORIZED_PERSON_NAME; ?>';

            var INCOME_CERTIFICATE_DOC_PATH = '<?php echo INCOME_CERTIFICATE_DOC_PATH; ?>';
            var DOMICILE_CERTIFICATE_DOC_PATH = '<?php echo DOMICILE_CERTIFICATE_DOC_PATH; ?>';
            var HEIRSHIP_CERTIFICATE_DOC_PATH = '<?php echo HEIRSHIP_CERTIFICATE_DOC_PATH; ?>';
            var CASTE_CERTIFICATE_DOC_PATH = '<?php echo CASTE_CERTIFICATE_DOC_PATH; ?>';
            var OBC_CERTIFICATE_DOC_PATH = '<?php echo OBC_CERTIFICATE_DOC_PATH; ?>';
            var NA_APPLICATION_DOC_PATH = '<?php echo NA_APPLICATION_DOC_PATH; ?>';
            var NCL_CERTIFICATE_DOC_PATH = '<?php echo NCL_CERTIFICATE_DOC_PATH; ?>';
            var EWS_CERTIFICATE_DOC_PATH = '<?php echo EWS_CERTIFICATE_DOC_PATH; ?>';
            var FORM_ONE_FOURTEEN_DOC_PATH = '<?php echo FORM_ONE_FOURTEEN_DOC_PATH; ?>';
            var FORM_THREE_DOC_PATH = '<?php echo FORM_THREE_DOC_PATH; ?>';
            var FORM_FIVE_DOC_PATH = '<?php echo FORM_FIVE_DOC_PATH; ?>';
            var FORM_NINE_DOC_PATH = '<?php echo FORM_NINE_DOC_PATH; ?>';
            var CERTIFIED_COPY_DOC_PATH = '<?php echo CERTIFIED_COPY_DOC_PATH; ?>';
            var DR_DOC_PATH = '<?php echo DR_DOC_PATH; ?>';
            var EOCS_SITE_PLAN_DOC_PATH = '<?php echo EOCS_SITE_PLAN_DOC_PATH; ?>';
            var PROPERTY_CARD_DOC_PATH = '<?php echo PROPERTY_CARD_DOC_PATH; ?>';
            var EOCS_SITE_PLAN_RURAL_DOC_PATH = '<?php echo EOCS_SITE_PLAN_RURAL_DOC_PATH; ?>';
            var MARRIAGE_CERTIFICATE_DOC_PATH = '<?php echo MARRIAGE_CERTIFICATE_DOC_PATH; ?>';
            var SVAMITVA_ROR_DOC_PATH = '<?php echo SVAMITVA_ROR_DOC_PATH; ?>';
            var BIRTH_CERTIFICATE_DOC_PATH = '<?php echo BIRTH_CERTIFICATE_DOC_PATH; ?>';
            var DEATH_CERTIFICATE_DOC_PATH = '<?php echo DEATH_CERTIFICATE_DOC_PATH; ?>';
            var CHARACTER_CERTIFICATE_DOC_PATH = '<?php echo CHARACTER_CERTIFICATE_DOC_PATH; ?>';
            var GENERAL_APPLICATION_DOC_PATH = '<?php echo GENERAL_APPLICATION_DOC_PATH; ?>';
            var GENERAL_APPLICATION_DOC_ADMIN_PATH = '<?php echo GENERAL_APPLICATION_DOC_ADMIN_PATH; ?>';


            var tempStateData = [];
            var documentRowCnt = 1;
            var queryFormTemplate = Handlebars.compile($('#query_form_template').html());
            var queryQuestionTemplate = Handlebars.compile($('#query_question_template').html());
            var queryQuestionViewTemplate = Handlebars.compile($('#query_question_view_template').html());
            var queryAnswerViewTemplate = Handlebars.compile($('#query_answer_view_template').html());
            var documentItemTemplate = Handlebars.compile($('#document_item_template').html());
            var documentItemViewTemplate = Handlebars.compile($('#document_item_view_template').html());
            var queryResolveTemplate = Handlebars.compile($('#query_resolve_template').html());
            var queryResolveViewTemplate = Handlebars.compile($('#query_resolve_view_template').html());
            var duplicateDetailsTemplate = Handlebars.compile($('#duplicate_details_template').html());
            var queryStatusArray = <?php echo json_encode($this->config->item('query_status_array')); ?>;
            var queryStatuTextsArray = <?php echo json_encode($this->config->item('query_status_text_array')); ?>;
            var QUERY_PATH = '<?php echo QUERY_PATH; ?>';
            var VIEW_UPLODED_DOCUMENT = '<?php echo VIEW_UPLODED_DOCUMENT; ?>';
            var IMAGE_NA_PATH = '<?php echo IMAGE_NA_PATH; ?>';

            var genderArray = <?php echo json_encode($this->config->item('gender_array')); ?>;
            var maritalStatusArray = <?php echo json_encode($this->config->item('marital_status_array')); ?>;
            var professionArray = <?php echo json_encode($this->config->item('profession_array')); ?>;
            var applicantOccupationArray = <?php echo json_encode($this->config->item('applicant_occupation_array')); ?>;
            var parentProfessionArray = <?php echo json_encode($this->config->item('parent_profession_array')); ?>;
            var childProfessionArray = <?php echo json_encode($this->config->item('child_profession_array')); ?>;
            var propertyTypeArray = <?php echo json_encode($this->config->item('property_type_array')); ?>;
            var sourceOfIncomeArray = <?php echo json_encode($this->config->item('source_of_income_array')); ?>;


            var incomeByArray = <?php echo json_encode($this->config->item('income_by_array')); ?>;
            var domicileAppTypeArray = <?php echo json_encode($this->config->item('domicile_app_type_array')); ?>;
            var recArray = <?php echo json_encode($this->config->item('rec_array')); ?>;
            var recmigArray = <?php echo json_encode($this->config->item('recmig_array')); ?>;
            var damanVillagesArray = <?php echo json_encode($this->config->item('daman_villages_array')); ?>;
            var diuVillagesArray = <?php echo json_encode($this->config->item('diu_villages_array')); ?>;
            var dnhVillagesArray = <?php echo json_encode($this->config->item('dnh_villages_array')); ?>;
            var diuNCVillagesArray = <?php echo json_encode($this->config->item('diu_ncv_array')); ?>;
            var damanNCVillagesArray = <?php echo json_encode($this->config->item('daman_ncv_array')); ?>;

            var stateArray = <?php echo json_encode($this->config->item('state_array')); ?>;
            var damandiudistrictArray = <?php echo json_encode($this->config->item('daman_diu_district_array')); ?>;
            var dnhdistrictArray = <?php echo json_encode($this->config->item('dnh_district_array')); ?>;
            var damanVillageForNativeArray = <?php echo json_encode($this->config->item('daman_village_array_for_native')); ?>;
            var diuVillagesForNativeArray = <?php echo json_encode($this->config->item('diu_village_array_for_native')); ?>;
            var dnhVillagesForNativeArray = <?php echo json_encode($this->config->item('dnh_village_array_for_native')); ?>;
            var casteArray = <?php echo json_encode($this->config->item('caste_array')); ?>;
            var applicantScSubcasteArray = <?php echo json_encode($this->config->item('applicant_sc_subcaste_array')); ?>;
            var applicantStSubcasteArray = <?php echo json_encode($this->config->item('applicant_st_subcaste_array')); ?>;
            var applicantPolicestationArray = <?php echo json_encode($this->config->item('police_station_status_array')); ?>;

            var typeOfResidentArray = <?php echo json_encode($this->config->item('type_of_resident_array')); ?>;
            var businessTypeArray = <?php echo json_encode($this->config->item('business_type_array')); ?>;
            var educationTypeArray = <?php echo json_encode($this->config->item('education_type_array')); ?>;
            var siteProposedArray = <?php echo json_encode($this->config->item('site_proposed_array')); ?>;
            var occupantTypeArray = <?php echo json_encode($this->config->item('occupant_type_array')); ?>;
            var reverifyTypeArray = <?php echo json_encode($this->config->item('reverify_type_array')); ?>;
            var talathiReverifyTypeArray = <?php echo json_encode($this->config->item('talathi_reverify_type_array')); ?>;

            var damanCityArray = <?php echo json_encode($this->config->item('daman_city_array')); ?>;
            var diuCityArray = <?php echo json_encode($this->config->item('diu_city_array')); ?>;
            var dnhCityArray = <?php echo json_encode($this->config->item('dnh_city_array')); ?>;
            var diuNativeCityArray = <?php echo json_encode($this->config->item('diu_native_city_array')); ?>;
            var damanCityPincodeArray = <?php echo json_encode($this->config->item('daman_city_pincode_array')); ?>;
            var naniDamanVillageArray = <?php echo json_encode($this->config->item('nani_daman_village_array')); ?>;
            var motiDamanVillageArray = <?php echo json_encode($this->config->item('moti_daman_village_array')); ?>;
            var domicileCertificatePurposeArray = <?php echo json_encode($this->config->item('domicile_certificate_purpose_array')); ?>;

            var CaseResponseTypeArray = <?php echo json_encode($this->config->item('case_response_type_array')); ?>;
            var CaseTypeArray = <?php echo json_encode($this->config->item('case_type_array')); ?>;
            var caseyearArray = <?php echo json_encode($this->config->item('case_year_array')); ?>;
            var casestatus2Array = <?php echo json_encode($this->config->item('case_status2_array')); ?>;

            var docLanguageArray = <?php echo json_encode($this->config->item('doc_language_array')); ?>;
            var docTypeArray = <?php echo json_encode($this->config->item('doc_type_array')); ?>;
            var leasePeriodArray = <?php echo json_encode($this->config->item('lease_period_array')); ?>;
            var feeExemptionArray = <?php echo json_encode($this->config->item('fee_exemption_array')); ?>;
            var drAppStatusArray = <?php echo json_encode($this->config->item('dr_app_status_array')); ?>;
            var drAppStatusTextArray = <?php echo json_encode($this->config->item('dr_app_status_text_array')); ?>;
            var DRUploadDocStatusArray = <?php echo json_encode($this->config->item('dr_upload_doc_status_array')); ?>;
            var partyCategoryArray = <?php echo json_encode($this->config->item('party_category_array')); ?>;
            var partyDescriptionArray = <?php echo json_encode($this->config->item('party_description_array')); ?>;
            var birthTypeArray = <?php echo json_encode($this->config->item('birth_type_array')); ?>;
            var religionArray = <?php echo json_encode($this->config->item('religion_array')); ?>;
            var drOccupationArray = <?php echo json_encode($this->config->item('dr_occupation_array')); ?>;
            var panTypeArray = <?php echo json_encode($this->config->item('pan_type_array')); ?>;
            var DRPropertyUnitArray = <?php echo json_encode($this->config->item('dr_property_unit_array')); ?>;
            var mvExemptionArray = <?php echo json_encode($this->config->item('mv_exemption_array')); ?>;
            var sdExemptionArray = <?php echo json_encode($this->config->item('sd_exemption_array')); ?>;
            var drPOATypeArray = <?php echo json_encode($this->config->item('dr_poa_type_array')); ?>;
            var landOwnerTypeArray = <?php echo json_encode($this->config->item('land_owner_type_array')); ?>;
            var drDPETypeArray = <?php echo json_encode($this->config->item('dr_dpe_type_array')); ?>;
            var DRMainPropertyTypeArray = <?php echo json_encode($this->config->item('dr_main_property_type_array')); ?>;
            var DRPropertyTypeArray = <?php echo json_encode($this->config->item('dr_property_type_array')); ?>;
            var DRCCArray = <?php echo json_encode($this->config->item('dr_construction_category_array')); ?>;
            var DRMFArray = <?php echo json_encode($this->config->item('dr_mf_array')); ?>;
            var DROwnershipTypeArray = <?php echo json_encode($this->config->item('dr_ownership_type_array')); ?>;
            var docTypeCPArray = <?php echo json_encode($this->config->item('doc_type_cp_array')); ?>;
            var isAllowLandDetailsArray = <?php echo json_encode($this->config->item('is_allow_land_details_array')); ?>;
            var isAllowExemptionArray = <?php echo json_encode($this->config->item('is_allow_exemption_array')); ?>;
            var drBasicFeesArray = <?php echo json_encode($this->config->item('dr_basic_fees_array')); ?>;
            var certTypeArray = <?php echo json_encode($this->config->item('cert_type_array')); ?>;
            var appointmentFilterArray = <?php echo json_encode($this->config->item('appointment_filter_array')); ?>;
            var appointmentTypeArray = <?php echo json_encode($this->config->item('appointment_type_array')); ?>;
            var currentlyOnTypeArray = <?php echo json_encode($this->config->item('currently_on_type_array')); ?>;
            var areaTypeArray = <?php echo json_encode($this->config->item('area_type_array')); ?>;
            var propertyStatusArray = <?php echo json_encode($this->config->item('property_status_array')); ?>;
            var propertyStatusTextArray = <?php echo json_encode($this->config->item('property_status_text_array')); ?>;
            var psFormArray = <?php echo json_encode($this->config->item('ps_form_array')); ?>;
            var eocsPlanStatusArray = <?php echo json_encode($this->config->item('eocs_plan_status_array')); ?>;
            var serviceTypeArray = <?php echo json_encode($this->config->item('service_type_array')); ?>;
            var formTypeArray = <?php echo json_encode($this->config->item('form_type_array')); ?>;
            var ruAreaVillagesArray = <?php echo json_encode($this->config->item('ru_area_villages_array')); ?>;
            var ewsOccupationArray = <?php echo json_encode($this->config->item('ews_occupation_array')); ?>;
            var forwardToArray = <?php echo json_encode($this->config->item('forward_to_array')); ?>;
            var gaUploadDocStatusArray = <?php echo json_encode($this->config->item('ga_upload_doc_status_array')); ?>;
            var currentlyOnGATypeArray = <?php echo json_encode($this->config->item('currently_on_ga_type_array')); ?>;
            
            $(document).ready(function () {
                getCommonData();
            });
            var tDistrict = '<?php echo isset($t_district) ? $t_district : ""; ?>';
            var tMT = '<?php echo isset($t_mt) ? $t_mt : ""; ?>';
            var tMS = '<?php echo isset($t_ms) ? $t_ms : ""; ?>';
            var tMI = '<?php echo isset($t_mi) ? $t_mi : ""; ?>';
        </script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div id="full_page_overlay_div" class="overlay-full-page text-center">
            <div style="margin-top: 20%;">
                <i class="fas fa-spinner fa-5x fa-spin text-white"></i>
            </div>
            <div>
                <h2 class="text-white mt-5">Please Wait . . .</h2>
            </div>
        </div>
        <?php $this->load->view('security'); ?>
        <script type="text/javascript">
            handleDataTableError();
        </script>
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" id="sidebar_button" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" style="padding-right: 10px;">
                    <li class="nav-item dropdown f-w-b color-black">
                        Logged User: <?php echo get_from_session('name'); ?>
                    </li>
                </ul>
            </nav>
            <form id="qwertyuiqwdjkoplkjhfgazcxzc" method="post" action="<?php echo PG_URL ?>">
                <input type="hidden" name="EncryptTrans" id="temp_op_enct" class="null-pdjshdjs">
                <input type="hidden" name="MultiAccountInstructionDtls" id="temp_op_mt" class="null-pdjshdjs">
                <input type="hidden" name="merchIdVal" id="temp_op_mmptd" class="null-pdjshdjs">
            </form>
            <button type="button" style="display: none;" id="temp_btn"></button>
            <form target="_blank" id="cd_form" action="download_copy" method="post">
                <input type="hidden" id="form_copy_id_forcd" name="form_copy_id_forcd" class="forcd-null">
                <input type="hidden" id="vd_type_forcd" name="vd_type_forcd" class="forcd-null">
            </form>
            <?php $this->load->view('common/sidebar'); ?>
            <div class="modal fade" id="popup_modal" style="padding-right: 0px !important;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="model_title" class="modal-title f-w-b f-s-20px"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    onclick="resetModel();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="model_body" class="modal-body">
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-sm btn-danger" onclick="resetModel();"><i class="fas fa-times"></i>&nbsp; Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="popup_md_modal" style="padding-right: 0px !important;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="model_md_title" class="modal-title f-w-b f-s-20px"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    onclick="resetModelMD();">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="model_md_body" class="modal-body">
                        </div>
                    </div>
                </div>
            </div>

