<?php

define('IS_CHECKED_NO', 0);
define('IS_CHECKED_YES', 1);
define('IS_DELETE', 1);
define('IS_ACTIVE', 0);
define('IS_DEACTIVE', 1);
define('IS_VERIFY', 1);
define('IS_SVAMITVA', 1);

define('LOGIN', 1);
define('LOGOUT', 2);

$config['log_type'] = array(
    LOGIN => 'Login',
    LOGOUT => 'Logout'
);

define('DAMAN', '03948');
define('DIU', '03947');

define('DAMAN_LAT', 20.4080051);
define('DAMAN_LNG', 72.8336303);

define("ENCRYPTION_KEY", "!@#$%^&*");

define('PASSWORD_REGEX', '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!#$@%_+\-=<>]).{8,16}$/');

define('API_ENCRYPTION_KEY', 'sgAD#@$@^^&fAB%^*(*&&^%$');
define('API_ACCESS_KEY', '%#d@AE$#Idgqw$$^jhhh');

define('DAMAN_API_ENCRYPTION_KEY', 'sgAD#@$@^^&fVzq#q@#$$#%^*(*&&^%$');
define('DAMAN_API_ACCESS_KEY', '%#d@3sMj7yDFIdgqw$$^jhhh');
define('DAMAN_API_URL', 'https://dd.nlrmp.in/sugamws/');

// Logs Table
define('TBL_LOGS_LOGIN_LOGOUT', 'sa_logs_login_details');
define('TBL_LOGS_LOGIN_LOGOUT_PRIMARY_KEY', 'sa_logs_login_details_id');
define('TBL_LOGS_CHANGE_PASSWORD', 'sa_logs_change_password');
define('TBL_LOGS_API', 'sa_logs_api');

define('DEFAULT_PASSWORD', 'Admin@1819');

define('TALUKA_DAMAN', 1);
define('TALUKA_DIU', 2);
define('TALUKA_DNH', 3);

$config['taluka_array'] = array(
    TALUKA_DAMAN => 'Daman',
    TALUKA_DIU => 'Diu',
    TALUKA_DNH => 'DNH'
);

$config['taluka_sc_array'] = array(
    TALUKA_DAMAN => 'DMN',
    TALUKA_DIU => 'DIU',
    TALUKA_DNH => 'DNH',
);

$config['io_cd_array'] = array(
    TALUKA_DAMAN => array(
        'email' => 'mdar-dmn-dd@ddd.gov.in',
        'address' => 'Dholar, Moti Daman, Daman',
        'tele' => '02602230861',
    ),
    TALUKA_DIU => array(
        'email' => 'mamlatdar.diu-dd@nic.in',
        'address' => 'Diu',
        'tele' => '02875252137',
    ),
    TALUKA_DNH => array(
        'email' => 'mdar-dmn-dd@ddd.gov.in',
        'tele' => '02602230861',
    ),
);

$config['taluka_array_guj'] = array(
    TALUKA_DAMAN => 'દમણ',
    TALUKA_DIU => 'દીવ',
    TALUKA_DNH => 'દાદરા અને નગર હવેલી'
);

define('FROM_NAME', 'SUGAM DDDGOV');
define('FROM_EMAIL', 'noreply@sugam.dddgov.in');

define('OLD_SUBR_DAMAN_NAME', 'SILVANA L.M. PEREIRA');
define('OLD_SUBR_DAMAN_LDT', '2023-07-07 00:00:00');

define('OLD_2_SUBR_DAMAN_NAME', 'RIMA D. JALAM');
define('OLD_2_SUBR_DAMAN_LDT', '2024-03-20 00:00:00');

$config['sub_registrar_array'] = array(
    TALUKA_DAMAN => 'MITESH B. PATHAK',
    TALUKA_DIU => '',
    TALUKA_DNH => ''
);

define('TEMP_TYPE_A', 1);
define('TEMP_TYPE_TALATHI_USER', 2);
define('TEMP_TYPE_ACI_USER', 3);
define('TEMP_TYPE_MAMLATDAR_USER', 4);
define('TEMP_TYPE_EOCS_FS', 5);
define('TEMP_TYPE_LDC_USER', 6);
define('TEMP_TYPE_SDPO_USER', 7);
define('TEMP_TYPE_SUBR_USER', 8);
define('TEMP_TYPE_SUBR_VER_USER', 9);
define('TEMP_TYPE_USER_ACC_VER', 10);
define('TEMP_TYPE_EOCS_HEAD', 11);
define('TEMP_TYPE_EOCS_HS', 12);
define('TEMP_TYPE_EOCS_JFS', 13);
define('TEMP_TYPE_MAM_VIEW_USER', 14);

define('AUTHORIZED_PERSON_NAME', 'RIMA D. JALAM');

define('VERSION', 'v=1.1.102');

define('GS_PATH', "C:\Program Files\gs\gs10.01.2\bin\gswin64c.exe");
//define('GS_PATH', "C:\Program Files\gs\bin\gswin64c.exe");
define('PROJECT_PATH', 'https://sugam.dddgov.in/');
//define('PROJECT_PATH', 'http://localhost:90/sugam/');

define('DOC_PATH', PROJECT_PATH . 'documents/');
define('QUERY_PATH', DOC_PATH . 'query/');
define('INCOME_CERTIFICATE_DOC_PATH', DOC_PATH . 'income_certificate/');
define('DOMICILE_CERTIFICATE_DOC_PATH', DOC_PATH . 'domicile/');
define('HEIRSHIP_CERTIFICATE_DOC_PATH', DOC_PATH . 'heirship/');
define('CASTE_CERTIFICATE_DOC_PATH', DOC_PATH . 'caste_certificate/');
define('OBC_CERTIFICATE_DOC_PATH', DOC_PATH . 'obc_certificate/');
define('NA_APPLICATION_DOC_PATH', DOC_PATH . 'na_application/');
define('NCL_CERTIFICATE_DOC_PATH', DOC_PATH . 'ncl_certificate/');
define('EWS_CERTIFICATE_DOC_PATH', DOC_PATH . 'ews_certificate/');
define('FORM_ONE_FOURTEEN_DOC_PATH', DOC_PATH . 'form_one_fourteen/');
define('FORM_THREE_DOC_PATH', DOC_PATH . 'form_three/');
define('FORM_FIVE_DOC_PATH', DOC_PATH . 'form_five/');
define('FORM_NINE_DOC_PATH', DOC_PATH . 'form_nine/');
define('CERTIFIED_COPY_DOC_PATH', DOC_PATH . 'certified_copy/');
define('RTI_DOC_PATH', DOC_PATH . 'rti/');
define('DR_DOC_PATH', DOC_PATH . 'document_registration/');
define('EOCS_SITE_PLAN_DOC_PATH', DOC_PATH . 'eocs_site_plan/');
define('EOCS_SITE_PLAN_RURAL_DOC_PATH', DOC_PATH . 'eocs_site_plan_rural/');
define('PROPERTY_CARD_DOC_PATH', DOC_PATH . 'property_card/');
define('DMC_AREA', 'DMC Area');
define('MARRIAGE_CERTIFICATE_DOC_PATH', DOC_PATH . 'marriage_certificate/');
define('SVAMITVA_ROR_DOC_PATH', DOC_PATH . 'svamitva_ror/');
define('BIRTH_CERTIFICATE_DOC_PATH', DOC_PATH . 'birth_certificate/');
define('DEATH_CERTIFICATE_DOC_PATH', DOC_PATH . 'death_certificate/');
define('CHARACTER_CERTIFICATE_DOC_PATH', DOC_PATH . 'character_certificate/');
define('GENERAL_APPLICATION_DOC_PATH', DOC_PATH . 'general_application/');
define('GENERAL_APPLICATION_DOC_ADMIN_PATH', 'documents/' . 'general_application/');

define('PER_COPY_PRICE', 5);
define('VIEW_UPLODED_DOCUMENT', 'View Uploaded Document');

define('VALUE_ZERO', 0);
define('VALUE_ONE', 1);
define('VALUE_TWO', 2);
define('VALUE_THREE', 3);
define('VALUE_FOUR', 4);
define('VALUE_FIVE', 5);
define('VALUE_SIX', 6);
define('VALUE_SEVEN', 7);
define('VALUE_EIGHT', 8);
define('VALUE_NINE', 9);
define('VALUE_TEN', 10);
define('VALUE_ELEVEN', 11);
define('VALUE_TWELVE', 12);
define('VALUE_THIRTEEN', 13);
define('VALUE_FOURTEEN', 14);
define('VALUE_FIFTEEN', 15);
define('VALUE_SIXTEEN', 16);
define('VALUE_SEVENTEEN', 17);
define('VALUE_EIGHTEEN', 18);
define('VALUE_NINETEEN', 19);
define('VALUE_TWENTY', 20);
define('VALUE_TWENTYONE', 21);
define('VALUE_TWENTYTWO', 22);
define('VALUE_TWENTYTHREE', 23);
define('VALUE_TWENTYFOUR', 24);
define('VALUE_TWENTYFIVE', 25);
define('VALUE_TWENTYSIX', 26);
define('VALUE_TWENTYSEVEN', 27);
define('VALUE_TWENTYEIGHT', 28);
define('VALUE_TWENTYNINE', 29);
define('VALUE_THIRTY', 30);
define('VALUE_THIRTYONE', 31);
define('VALUE_THIRTYTWO', 32);
define('VALUE_THIRTYTHREE', 33);
define('VALUE_THIRTYFOUR', 34);
define('VALUE_THIRTYFIVE', 35);
define('VALUE_THIRTYSIX', 36);
define('VALUE_THIRTYSEVEN', 37);
define('VALUE_THIRTYEIGHT', 38);
define('VALUE_THIRTYNINE', 39);
define('VALUE_FOURTY', 40);
define('VALUE_FOURTYONE', 41);
define('VALUE_FOURTYTWO', 42);
define('VALUE_FOURTYTHREE', 43);
define('VALUE_FOURTYFOUR', 44);
define('VALUE_FOURTYFIVE', 45);
define('VALUE_FOURTYSIX', 46);
define('VALUE_FOURTYSEVEN', 47);
define('VALUE_FOURTYEIGHT', 48);
define('VALUE_FOURTYNINE', 49);
define('VALUE_FIFTY', 50);
define('VALUE_FIFTYONE', 51);
define('VALUE_FIFTYTWO', 52);
define('VALUE_FIFTYTHREE', 53);
define('VALUE_FIFTYFOUR', 54);
define('VALUE_FIFTYFIVE', 55);
define('VALUE_FIFTYSIX', 56);
define('VALUE_FIFTYSEVEN', 57);
define('VALUE_FIFTYEIGHT', 58);
define('VALUE_FIFTYNINE', 59);
define('VALUE_SIXTY', 60);
define('VALUE_SIXTYONE', 61);
define('VALUE_SIXTYTWO', 62);
define('VALUE_SIXTYTHREE', 63);
define('VALUE_SIXTYFOUR', 64);
define('VALUE_SIXTYFIVE', 65);
define('VALUE_SIXTYSIX', 66);
define('VALUE_SIXTYSEVEN', 67);
define('VALUE_SIXTYEIGHT', 68);
define('VALUE_SIXTYNINE', 69);
define('VALUE_SEVENTY', 70);
define('VALUE_SEVENTYONE', 71);
define('VALUE_HUNDRED', 100);

define('API_USER_FOR_SMS', 'mamlatdar');
define('API_KEY_FOR_SMS', '7fb0d8cf2eXX');
define('SENDER_ID_FOR_SMS', 'DDDGOV');
define('ENTITY_ID_FOR_SMS', '1401551570000053588');

define('URL_FOR_DSC_SIGN', 'http://127.0.0.1:1620/');

$config['email_type_array'] = array(
    VALUE_ONE => 'Registration Confirmation Link',
    VALUE_TWO => 'Mobile & Pin Email',
    VALUE_THREE => 'Forgot Password',
    VALUE_FOUR => 'Query Grievance',
    VALUE_FIVE => 'Raise Query',
    VALUE_SIX => 'Application Submitted',
    VALUE_SEVEN => 'Application Approve',
    VALUE_EIGHT => 'Application Reject',
    VALUE_NINE => 'Query Resolved',
    VALUE_TEN => 'Payment Confirmed',
    VALUE_ELEVEN => 'Document Verified & Take Appointment',
    VALUE_TWELVE => 'Appointment Details',
    VALUE_THIRTEEN => 'Application Fees Pending',
    VALUE_FOURTEEN => 'OTP'
);

$config['sms_otp_type_array'] = array(
    VALUE_ONE => 'Mobile Verification',
    VALUE_TWO => 'Mobile & Pin SMS',
    VALUE_FOUR => 'Query Grievance',
    VALUE_FIVE => 'Raise Query',
    VALUE_SIX => 'Application Submitted',
    VALUE_SEVEN => 'Application Approve',
    VALUE_EIGHT => 'Application Reject',
    VALUE_NINE => 'Query Resolved',
    VALUE_TEN => 'Payment Confirmed',
    VALUE_ELEVEN => 'Document Verified & Take Appointment',
    VALUE_TWELVE => 'Appointment Details'
);

$config['app_status_array'] = array(
    VALUE_ZERO => '<span class="badge bg-warning app-status">Pending</span>',
    VALUE_ONE => '<span class="badge bg-nic-blue app-status">Draft</span>',
    VALUE_TWO => '<span class="badge bg-warning app-status">Application Submitted</span>',
    VALUE_THREE => '<span class="badge bg-orange app-status">Reverification</span>',
    VALUE_FIVE => '<span class="badge bg-success app-status">Approved</span>',
    VALUE_SIX => '<span class="badge bg-danger app-status">Rejected</span>',
);
$config['case_status_array'] = array(
    VALUE_ZERO => '<span class="badge bg-warning app-status">Draft</span>',
    VALUE_ONE => '<span class="badge bg-nic-blue app-status">Case Submitted</span>',
    VALUE_TWO => '<span class="badge bg-warning app-status">Pending</span>',
    VALUE_THREE => '<span class="badge bg-danger app-status">Hearing Set</span>',
    VALUE_FOUR => '<span class="badge bg-success app-status">Close-Pending for Order</span>',
    VALUE_FIVE => '<span class="badge bg-success app-status">Case Closed</span>',
//    VALUE_SIX => '<span class="badge bg-danger app-status">Rejected</span>',
);
$config['case_status2_array'] = array(
    VALUE_ONE => 'Admitted',
    VALUE_TWO => 'Running',
    VALUE_THREE => 'Pending',
    VALUE_FOUR => 'Dismiss',
);
$config['app_status_text_array'] = array(
    VALUE_TWO => 'Application Submitted',
    VALUE_THREE => 'Reverification',
    VALUE_FIVE => 'Approved',
    VALUE_SIX => 'Rejected',
);

$config['f_app_status_array'] = array(
    VALUE_ZERO => '<span class="badge bg-warning app-status">Pending</span>',
    VALUE_ONE => '<span class="badge bg-nic-blue app-status">Draft</span>',
    VALUE_TWO => '<span class="badge bg-warning app-status">Application Submitted</span>',
    VALUE_THREE => '<span class="badge bg-warning app-status">Application Submitted</span><hr><span class="badge bg-warning app-status">Fees Pending</span>',
    VALUE_FOUR => '<span class="badge bg-warning app-status">Application Submitted</span><hr><span class="badge bg-success app-status">Fees Paid</span>',
    VALUE_FIVE => '<span class="badge bg-success app-status">Approved</span>',
    VALUE_SIX => '<span class="badge bg-danger app-status">Rejected</span>',
);

$config['dash_f_app_status_array'] = array(
    VALUE_ZERO => '<span class="badge bg-warning app-status">Pending</span>',
    VALUE_ONE => '<span class="badge bg-nic-blue app-status">Draft</span>',
    VALUE_TWO => '<span class="badge bg-warning app-status">Application Submitted</span>',
    VALUE_THREE => '<span class="badge bg-warning app-status">Fees Pending</span>',
    VALUE_FOUR => '<span class="badge bg-success app-status">Fees Paid</span>',
    VALUE_FIVE => '<span class="badge bg-success app-status">Approved</span>',
    VALUE_SIX => '<span class="badge bg-danger app-status">Rejected</span>',
);

$config['f_app_status_text_array'] = array(
    VALUE_ZERO => 'Pending',
    VALUE_ONE => 'Draft',
    VALUE_TWO => 'Application Submitted',
    VALUE_THREE => 'Fees Pending',
    VALUE_FOUR => 'Fees Paid',
    VALUE_FIVE => 'Approved',
    VALUE_SIX => 'Rejected',
);

$config['eocs_plan_status_array'] = array(
    VALUE_ONE => '<span class="badge bg-warning app-status">Pending</span>',
    VALUE_TWO => '<span class="badge bg-info app-status">Generated</span>',
    VALUE_THREE => '<span class="badge bg-orange app-status">Prepared</span>',
    VALUE_FOUR => '<span class="badge bg-success app-status">Checked</span>',
);

define('MAX_FILE_SIZE_IN_KB', 100);
define('MAX_FILE_SIZE_IN_MB', 5);

$config['query_status_array'] = array(
    VALUE_ZERO => '-',
    VALUE_ONE => '<span class="badge bg-warning app-status">Queried</span>',
    VALUE_TWO => '<span class="badge bg-nic-blue app-status">Response Received</span>',
    VALUE_THREE => '<span class="badge bg-success app-status">Resolved</span>',
);

$config['query_status_text_array'] = array(
    VALUE_ONE => 'Queried',
    VALUE_TWO => 'Response Received',
    VALUE_THREE => 'Resolved'
);

define('TEMP_MAMLATDAR', 'Mamlatdar Office');
define('TEMP_SUB_REGISTRAR', 'Civil Registrar - Cum - Sub - Registrar Office');
define('TEMP_EOCS', 'EOCS Office');

$config['c_dept_array'] = array(
    VALUE_ONE => TEMP_MAMLATDAR,
    VALUE_TWO => TEMP_SUB_REGISTRAR,
    VALUE_THREE => TEMP_EOCS,
);

$config['dept_name_array'] = array(
    TEMP_TYPE_MAMLATDAR_USER => TEMP_MAMLATDAR,
    TEMP_TYPE_EOCS_HEAD => TEMP_EOCS,
);

$config['dept_module_array'] = array(
    TEMP_TYPE_TALATHI_USER => array(VALUE_NINE, VALUE_THIRTEEN, VALUE_FOURTEEN, VALUE_FIFTEEN, VALUE_SIXTEEN, VALUE_TWENTYSEVEN, VALUE_TWENTYNINE),
    TEMP_TYPE_ACI_USER => array(VALUE_NINE, VALUE_THIRTEEN, VALUE_FOURTEEN, VALUE_FIFTEEN, VALUE_SIXTEEN, VALUE_TWENTYSEVEN, VALUE_TWENTYNINE),
    TEMP_TYPE_MAMLATDAR_USER => array(VALUE_NINE, VALUE_THIRTEEN, VALUE_FOURTEEN, VALUE_FIFTEEN, VALUE_SIXTEEN, VALUE_TWENTYSEVEN, VALUE_TWENTYNINE),
    TEMP_TYPE_MAM_VIEW_USER => array(VALUE_NINE, VALUE_THIRTEEN, VALUE_FOURTEEN, VALUE_FIFTEEN, VALUE_SIXTEEN, VALUE_TWENTYSEVEN, VALUE_TWENTYNINE),
    TEMP_TYPE_LDC_USER => array(VALUE_NINE, VALUE_THIRTEEN, VALUE_FOURTEEN, VALUE_FIFTEEN, VALUE_SIXTEEN, VALUE_TWENTYSEVEN, VALUE_TWENTYNINE),
    TEMP_TYPE_EOCS_FS => array(VALUE_TWENTYTHREE, VALUE_TWENTYFOUR, VALUE_TWENTYFIVE),
    TEMP_TYPE_EOCS_HEAD => array(VALUE_TWENTYTHREE, VALUE_TWENTYFOUR, VALUE_TWENTYFIVE),
    TEMP_TYPE_EOCS_HS => array(VALUE_TWENTYTHREE, VALUE_TWENTYFOUR, VALUE_TWENTYFIVE),
);

$config['query_module_array'] = array(
    VALUE_ONE => array(
        'pd_upd' => true,
        'timeline' => '7 Days',
        'day' => 7,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Domicile Certificate',
        'key_id_text' => 'domicile_certificate_id',
        'tbl_text' => 'domicile_certificate',
        'village_field' => 'village_name',
        'mob_no' => 'mobile_number'),
    VALUE_TWO => array(
        'pd_upd' => true,
        'timeline' => '7 Days',
        'day' => 7,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Income Certificate',
        'key_id_text' => 'income_certificate_id',
        'tbl_text' => 'income_certificate',
        'village_field' => 'village_dmc_ward',
        'mob_no' => 'mobile_number'),
    VALUE_THREE => array(
        'pd_upd' => true,
        'timeline' => '15 Days',
        'day' => 15,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Heir Ship Certificate',
        'key_id_text' => 'heirship_id',
        'tbl_text' => 'heirship',
        'village_field' => 'village_name',
        'mob_no' => 'mobile_number'),
    VALUE_FOUR => array(
        'pd_upd' => true,
        'timeline' => '7 Days',
        'day' => 7,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Caste Certificate',
        'key_id_text' => 'caste_certificate_id',
        'tbl_text' => 'caste_certificate',
        'village_field' => 'village_name',
        'mob_no' => 'mobile_number'),
    VALUE_FIVE => array(
        'pd_upd' => true,
        'timeline' => '15 Days',
        'day' => 15,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'OBC Certificate',
        'key_id_text' => 'obc_certificate_id',
        'tbl_text' => 'obc_certificate',
        'village_field' => 'village_name',
        'mob_no' => 'mobile_number'),
    VALUE_SIX => array(
        'pd_upd' => true,
        'timeline' => '7 Days',
        'day' => 7,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'NCL (OBC Renewal) Certificate',
        'key_id_text' => 'ncl_certificate_id',
        'tbl_text' => 'ncl_certificate',
        'village_field' => 'village_name',
        'mob_no' => 'mobile_number'),
    VALUE_SEVEN => array(
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'EWS Certificate',
        'key_id_text' => 'ews_certificate_id',
        'tbl_text' => 'ews_certificate',
        'village_field' => 'village_name',
        'mob_no' => 'mobile_number'),
    VALUE_EIGHT => array(
        'department_name' => 'Collector Office',
        'title' => 'Na Application',
        'key_id_text' => 'na_application_id',
        'tbl_text' => 'na_application'),
    VALUE_NINE => array(
        'pd_upd' => true,
        'timeline' => '30 Days',
        'day' => 30,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Certified Copy',
        'key_id_text' => 'certified_copy_id',
        'tbl_text' => 'certified_copy',
        'village_field' => 'village',
        'mob_no' => 'mobile_number'),
    VALUE_TEN => array(
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Character Certificate',
        'key_id_text' => 'character_certificate_id',
        'tbl_text' => 'character_certificate'),
    VALUE_ELEVEN => array(
        'pd_upd' => true,
        'timeline' => '2 Days',
        'day' => 2,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_TWO,
        'department_name' => TEMP_SUB_REGISTRAR,
        'title' => 'Document Registration',
        'key_id_text' => 'document_registration_id',
        'tbl_text' => 'document_registration'),
    VALUE_TWELVE => array(
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'RTI',
        'key_id_text' => 'rti_id',
        'tbl_text' => 'rti'),
    VALUE_THIRTEEN => array(
        'pd_upd' => true,
        'timeline' => '1 Day',
        'day' => 1,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Form No. I & XIV ( RoR )',
        'key_id_text' => 'form_one_fourteen_id',
        'tbl_text' => 'form_one_fourteen',
        'village_field' => 'village',
        'mob_no' => 'mobile_number'),
    VALUE_FOURTEEN => array(
        'pd_upd' => true,
        'timeline' => '30 Days',
        'day' => 30,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Form No. 3 / Abolition Record',
        'key_id_text' => 'form_three_id',
        'tbl_text' => 'form_three',
        'village_field' => 'village',
        'mob_no' => 'mobile_number'),
    VALUE_FIFTEEN => array(
        'pd_upd' => true,
        'timeline' => '30 Days',
        'day' => 30,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Form No. 5',
        'key_id_text' => 'form_five_id',
        'tbl_text' => 'form_five',
        'village_field' => 'village',
        'mob_no' => 'mobile_number'),
    VALUE_SIXTEEN => array(
        'pd_upd' => true,
        'timeline' => '30 Days',
        'day' => 30,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => 'Mamlatdar Office',
        'title' => 'Form No. 9',
        'key_id_text' => 'form_nine_id',
        'tbl_text' => 'form_nine',
        'village_field' => 'village',
        'mob_no' => 'mobile_number'),
    VALUE_EIGHTEEN => array(
        'department_name' => 'Civil Registrar - Cum - Sub - Registrar Office',
        'title' => 'Marriage Application',
        'key_id_text' => 'marriage_certificate_id',
        'tbl_text' => 'marriage_certificate',
        'photo_folder' => 'marriage_certificate',
        'photo_id' => 'bridegroom_photo',
        'app_name' => 'applicant_name'),
    VALUE_NINETEEN => array(
        'department_name' => 'Civil Registrar - Cum - Sub - Registrar Office',
        'title' => 'Birth Certificate',
        'key_id_text' => 'birth_certificate_id',
        'tbl_text' => 'birth_certificate',
        'photo_folder' => 'Birth_certificate',
        'photo_id' => 'applicant_photo_doc',
        'app_name' => 'applicant_name'),
    VALUE_TWENTY => array(
        'department_name' => 'Civil Registrar - Cum - Sub - Registrar Office',
        'title' => 'Death Certificate',
        'key_id_text' => 'death_certificate_id',
        'tbl_text' => 'death_certificate',
        'photo_folder' => 'Death_certificate',
        'photo_id' => 'applicant_photo_doc',
        'app_name' => 'applicant_name'),
    VALUE_TWENTYTWO => array(
        'pd_upd' => true,
        'timeline' => '3 Days',
        'day' => 3,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_THREE,
        'department_name' => TEMP_EOCS,
        'title' => 'Svamitva RoR',
        'key_id_text' => 'svamitva_ror_id',
        'tbl_text' => 'svamitva_ror',
        'village_field' => 'ld_village_sc'),
    VALUE_TWENTYTHREE => array(
        'pd_upd' => true,
        'timeline' => '30 Days',
        'day' => 30,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_THREE,
        'department_name' => TEMP_EOCS,
        'title' => 'Site Plan (Urban Area)',
        'key_id_text' => 'eocs_site_plan_id',
        'tbl_text' => 'eocs_site_plan',
        'village_field' => 'ld_village_sc'),
    VALUE_TWENTYFOUR => array(
        'pd_upd' => true,
        'timeline' => '3 Days',
        'day' => 3,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_THREE,
        'department_name' => TEMP_EOCS,
        'title' => 'Property Cards',
        'key_id_text' => 'property_card_id',
        'tbl_text' => 'property_card',
        'village_field' => 'ld_village_sc'),
    VALUE_TWENTYFIVE => array(
        'pd_upd' => true,
        'timeline' => '30 Days',
        'day' => 30,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_THREE,
        'department_name' => TEMP_EOCS,
        'title' => 'Site Plan (Rural Area)',
        'key_id_text' => 'eocs_site_plan_rural_id',
        'tbl_text' => 'eocs_site_plan_rural',
        'village_field' => 'village'),
    VALUE_TWENTYSIX => array(
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Non Agriculture Land Tax Notice',
        'key_id_text' => 'rlp_notice_id',
        'tbl_text' => 'rlp_notice'),
    VALUE_TWENTYSEVEN => array(
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Non Agriculture Land Tax Payment',
        'key_id_text' => 'rlp_land_tax_payment_id',
        'tbl_text' => 'rlp_land_tax_payment'),
    VALUE_TWENTYEIGHT => array(
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Agriculture Land Tax Notice',
        'key_id_text' => 'landtax_agriculture_notice_id',
        'tbl_text' => 'landtax_agriculture_notice'),
    VALUE_TWENTYNINE => array(
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'Agriculture Land Tax Payment',
        'key_id_text' => 'landtax_agriculture_payment_id',
        'tbl_text' => 'landtax_agriculture_payment'),
    VALUE_THIRTY => array(
        'pd_upd' => true,
        'timeline' => '30 Day',
        'day' => 30,
        'working_days' => 'fdw_ess',
        'department_id' => VALUE_ONE,
        'department_name' => TEMP_MAMLATDAR,
        'title' => 'General Application',
        'key_id_text' => 'general_application_id',
        'tbl_text' => 'general_application',
        'village_field' => 'village',),
);

$config['form_land_details_module_array'] = array(
    VALUE_ONE => 'Form No. I & XIV ( RoR )',
    VALUE_TWO => 'Form No. 3 / Abolition Record',
    VALUE_THREE => 'Form No. 9 / Mutation Entries',
    VALUE_FOUR => 'Certified Copy (Mutation File)',
    VALUE_FIVE => 'Form No. 5',
    VALUE_SIX => 'Svamitva RoR',
    VALUE_SEVEN => 'EOCS Site Plan (Urban Area)',
    VALUE_EIGHT => 'Property Card',
    VALUE_NINE => 'EOCS Site Plan (Rural Area)',
);

$config['prefix_module_array'] = array(
    VALUE_ONE => 'DC',
    VALUE_TWO => 'INCRT',
    VALUE_THREE => 'HC',
    VALUE_FOUR => 'CC',
    VALUE_FIVE => 'OC',
    VALUE_FIVE => 'OBC',
    VALUE_SIX => 'NCL',
    VALUE_SEVEN => 'EWS',
    VALUE_EIGHT => 'NA',
    VALUE_NINE => 'CCO',
    VALUE_TEN => 'CRC',
);

$config['payment_type_array'] = array(
    VALUE_ONE => 'Net Banking / IMPS / UPI',
);

$config['yes_no_array'] = array(
    VALUE_ONE => 'Yes',
    VALUE_TWO => 'No',
);

$config['e_yes_no_array'] = array(
    VALUE_ZERO => 'No',
    VALUE_ONE => 'Yes',
);

$config['Next_hearing_array'] = array(
    VALUE_ONE => 'Yes',
    VALUE_TWO => 'No',
);
$config['user_status_array'] = array(
    VALUE_ZERO => '<span class="badge bg-warning app-status">Pending</span>',
    VALUE_ONE => '<span class="badge bg-success app-status">Active</span>',
);

$config['marital_status_array'] = array(
    VALUE_ONE => 'Married',
    VALUE_TWO => 'Unmarried',
    VALUE_THREE => 'Widow',
    VALUE_FOUR => 'Divorcee'
);

$config['police_station_status_array'] = array(
    VALUE_ONE => 'Daman - Bhimpore',
    VALUE_TWO => 'Daman - Coastal',
    VALUE_THREE => 'Daman - Devka',
    VALUE_FOUR => 'Daman - Dabhel',
    VALUE_FIVE => 'Daman - Kachigam',
    VALUE_SIX => 'Daman - Kalariya',
    VALUE_SEVEN => 'Daman - Moti Daman',
    VALUE_EIGHT => 'Daman - Nani Daman',
    VALUE_NINE => 'Diu - Police Station'
);

$config['gender_array'] = array(
    VALUE_ONE => 'Male',
    VALUE_TWO => 'Female',
    VALUE_THREE => 'Transgender',
    VALUE_FOUR => 'Not Applicable',
);

$config['profession_array'] = array(
    VALUE_ONE => 'Salaried (Government)',
    VALUE_TWO => 'Salaried (Private)',
    VALUE_THREE => 'Business',
    VALUE_FOUR => 'Labour',
    VALUE_FIVE => 'Farmer',
    VALUE_SIX => 'Home Maker / House Wife',
    VALUE_SEVEN => 'Retire / Pensioner',
    VALUE_EIGHT => 'Senior citizen',
    VALUE_NINE => 'Student',
    VALUE_TEN => 'Other',
);

$config['applicant_occupation_array'] = array(
    VALUE_ONE => 'Fisherman (khalashi/Tandel)',
    VALUE_TWO => 'Fisherman (Boat/Dango)',
    VALUE_THREE => 'Driver (Riksha/Tempo/Bus/Car)',
    VALUE_FOUR => 'Seaman',
    VALUE_FIVE => 'Governent job',
    VALUE_SIX => 'Private job',
    VALUE_SEVEN => 'Daily wages (worker/staff/Teacher)',
    VALUE_EIGHT => 'Contract (worker/staff/Teacher)',
    VALUE_NINE => 'Doctor',
    VALUE_TEN => 'Shop',
    VALUE_ELEVEN => 'Luhar/Sudhar/Tailor/Khataki',
    VALUE_TWELVE => 'Other',
    VALUE_THIRTEEN => 'Armed Forced / Para Military Forces',
    VALUE_FOURTEEN => 'Pensioner / Retired',
    VALUE_FIFTEEN => 'House Wife',
);

$config['parent_profession_array'] = array(
    VALUE_ONE => 'Salaried (Government)',
    VALUE_TWO => 'Salaried (Private)',
    VALUE_THREE => 'Business',
    VALUE_FOUR => 'Labour',
    VALUE_FIVE => 'Farmer',
    VALUE_SIX => 'Home Maker / House Wife',
    VALUE_SEVEN => 'Retire / Pensioner',
    VALUE_EIGHT => 'Expired',
    VALUE_NINE => 'Other',
    VALUE_TEN => 'Seaman',
);

$config['child_profession_array'] = array(
    VALUE_ONE => 'Salaried (Government)',
    VALUE_TWO => 'Salaried (Private)',
    VALUE_THREE => 'Business',
    VALUE_FOUR => 'Labour',
    VALUE_FIVE => 'Farmer',
    VALUE_SIX => 'Home Maker / House Wife',
    VALUE_SEVEN => 'Study',
    VALUE_EIGHT => 'Other',
);

$config['property_type_array'] = array(
    VALUE_ONE => 'farm',
    VALUE_TWO => 'Rent / Lease',
    VALUE_THREE => 'Other',
);

$config['source_of_income_array'] = array(
    VALUE_ONE => 'Income from Bank Deposite',
    VALUE_TWO => 'other',
);

$config['rec_array'] = array(
    VALUE_ONE => 'Recommended',
    VALUE_TWO => 'Not Recommended'
);

$config['recmig_array'] = array(
    VALUE_ONE => 'Recommended',
    VALUE_TWO => 'Not Recommended',
    VALUE_THREE => 'Migration'
);

$config['caste_array'] = array(
    VALUE_ONE => 'SC',
    VALUE_TWO => 'ST'
);

$config['applicant_sc_subcaste_array'] = array(
    VALUE_ONE => 'Bhangi',
    VALUE_TWO => 'Chambhar',
    VALUE_THREE => 'Mahar',
    VALUE_FOUR => 'Mahyavanshi',
    VALUE_FIVE => 'Mang',
    VALUE_SIX => 'Hadi',
    VALUE_SEVEN => 'Vankar',
    VALUE_EIGHT => 'Mochi',
);
$config['applicant_st_subcaste_array'] = array(
    VALUE_ONE => 'Dhodia',
    VALUE_TWO => 'Dubla',
    VALUE_THREE => 'Nayaka',
    VALUE_FOUR => 'Siddi',
    VALUE_FIVE => 'Varli',
    VALUE_SIX => 'Halpati',
    VALUE_SEVEN => 'Talavia',
);

$config['domicile_app_type_array'] = array(
    VALUE_ONE => 'A person who is permanently residing in the Union territory of Daman and Diu (Old Age Person Only)',
    VALUE_TWO => 'A Person who is permanently residing in the Union Territory of Daman and Diu & either of whose parents were born in the Territory',
    VALUE_THREE => 'Spouse (wife) of persons mentioned in (a) above.',
    VALUE_FOUR => 'Minor child of persons mentioned in (a) above.',
    VALUE_FIVE => 'A Minor child who has/had a minimum of 10 years continuous education in Union Territory of Daman and Diu',
    VALUE_SIX => 'A Person who has/had a minimum of 10 years continuous education in Union Territory of Daman and Diu along with a minimum of 10 years continuous residing in Daman, Diu District',
    VALUE_SEVEN => 'A Person who is residing in the Union Territory of Daman and Diu continuously for 10 years.',
);

$config['daman_villages_array'] = array(
    1 => 'Aatiyawad',
    2 => 'Bhamti',
    3 => 'Bhimpore',
    4 => 'Dabhel',
    5 => 'Damanwada',
    6 => 'Devapardi',
    7 => 'Devka',
    8 => 'Dholar',
    9 => 'Dunetha',
    10 => 'Ghelwad',
    11 => 'Jampore',
    12 => 'Janivankad',
    13 => 'Kachigam',
    14 => 'Kadaiya',
    15 => 'Magarwada',
    16 => 'Marwad',
    17 => 'NailaPardi',
    18 => 'Palhit',
    19 => 'Pariyari',
    20 => 'Patlara',
    21 => 'Somnath',
    22 => 'ThanaPardi',
    23 => 'Varkund',
    24 => 'Zari',
    25 => 'Ward 1 - MOTI DAMAN - MARKET AREA',
    26 => 'Ward 2 - MOTI DAMAN - FOOTBALL GROUND',
    27 => 'Ward 3 - NANI DAMAN - GANCHIWAD',
    28 => 'Ward 4 - RANA STREET / JAIN STREET',
    29 => 'Ward 5 - NANI DAMAN JETTY AREA',
    30 => 'Ward 6 - ZAPABAR MAIN ROAD - TAXI STAND',
    31 => 'Ward 7 - TIN BATTI TO TAXI STAND',
    32 => 'Ward 8 - SATYANARAYAN MANDIR / CHAPPLI SHERI',
    33 => 'Ward 9 - BHANDARWAD / CHINIYA SHERI',
    34 => 'Ward 10 - MARWAD HOSPITAL / NARAYAN PARK',
    35 => 'Ward 11 - DILIPNAGAR TO MASHAL CHOWK',
    36 => 'Ward 12 - GOVT COLLEGE ROAD',
    37 => 'Ward 13 - KHARIWAD / ICE FACTORY ROAD',
    38 => 'Ward 14 - ROMA GAS / LIFE CARE HOSPITAL',
    39 => 'Ward 15 - MITNAWAD / VAAD CHOWKI'
);

$config['diu_villages_array'] = array(
    1 => 'Bhucharvada',
    2 => 'Diu - Fudam',
    3 => 'Ghoghla - 1 - Urban',
    4 => 'Ghoghla - 2 - Urban',
    5 => 'Saudwadi',
    6 => 'Vanakbara',
    7 => 'Zolawadi',
);

$config['dnh_villages_array'] = array(
    1 => 'Amboli',
    2 => 'Apti',
    3 => 'Dolara',
    4 => 'Kala',
    5 => 'Karachgam',
    6 => 'Kherdi',
    7 => 'Parzai',
    8 => 'Surangi',
    9 => 'Velugam',
    10 => 'Dadra',
    11 => 'Demani',
    12 => 'Tighra',
    13 => 'Vaghchauda',
    14 => 'Bindrabin',
    15 => 'Chikhali',
    16 => 'Chinchpada',
    17 => 'Dapada',
    18 => 'Khadoli',
    19 => 'Pati',
    20 => 'Tinoda',
    21 => 'Vasona',
    22 => 'Ambabari',
    23 => 'Bildhari',
    24 => 'Dudhani',
    25 => 'Ghodbari',
    26 => 'Goratpada',
    27 => 'Gunsa',
    28 => 'Jamalpada',
    29 => 'Karchond',
    30 => 'Kauncha',
    31 => 'Kherarbari',
    32 => 'Medha',
    33 => 'Athola',
    34 => 'Falandi',
    35 => 'Galonda',
    36 => 'Kilavani',
    37 => 'Sili',
    38 => 'Umarkui',
    39 => 'Vaghchhipa',
    40 => 'Bedpa',
    41 => 'Bensda',
    42 => 'Chinsda',
    43 => 'Khedpa',
    44 => 'Mandoni',
    45 => 'Sindoni',
    46 => 'Vansda',
    47 => 'Masat',
    48 => 'Saily',
    49 => 'Athal',
    50 => 'Dhapsa',
    51 => 'Kanadi',
    52 => 'Kharadpada',
    53 => 'Luhari',
    54 => 'Naroli',
    55 => 'Karad',
    56 => 'Kudacha',
    57 => 'Rakholi',
    58 => 'Samarvarni',
    59 => 'Bonta',
    60 => 'Morkhal',
    61 => 'Mota Randha',
    62 => 'Nana Randha',
    63 => 'Chauda',
    64 => 'Khanvel',
    65 => 'Khutali',
    66 => 'Rudana',
    67 => 'Shelti',
    68 => 'Talavali',
    69 => 'Umbervarni',
    70 => 'WARD 1',
    71 => 'WARD 2',
    72 => 'WARD 3',
    73 => 'WARD 4',
    74 => 'WARD 5',
    75 => 'WARD 6',
    76 => 'WARD 7',
    77 => 'WARD 8',
    78 => 'WARD 9',
    79 => 'WARD 10',
    80 => 'WARD 11',
    81 => 'WARD 12',
    82 => 'WARD 13',
    83 => 'WARD 14',
    84 => 'WARD 15',
);

$config['daman_cv_array'] = array(
    524911 => 7,
    524912 => 12,
    524913 => 23,
    524915 => 15,
    524916 => 5,
    524917 => 18,
    524919 => 8,
    524920 => 11,
    524921 => 19,
    524922 => 6,
    524923 => 17,
    524924 => 22,
    524925 => 24,
    524926 => 16,
    524927 => 14,
    524928 => 3,
    524929 => 9,
    524930 => 4,
    524931 => 13
);

$config['diu_cv_array'] = array(
    524907 => 6,
    524909 => 1,
);

$config['diu_ncv_array'] = array(
    2 => 'Diu - Fudam',
    3 => 'Ghoghla - 1 - Urban',
    4 => 'Ghoghla - 2 - Urban',
    5 => 'Saudwadi',
    7 => 'Zolawadi',
);

$config['daman_ncv_array'] = array(
    1 => 'Aatiyawad',
    10 => 'Ghelwad',
    14 => 'Kadaiya',
    20 => 'Patlara',
    21 => 'Somnath',
    25 => 'Ward 1 - MOTI DAMAN - MARKET AREA',
    26 => 'Ward 2 - MOTI DAMAN - FOOTBALL GROUND',
    27 => 'Ward 3 - NANI DAMAN - GANCHIWAD',
    28 => 'Ward 4 - RANA STREET / JAIN STREET',
    29 => 'Ward 5 - NANI DAMAN JETTY AREA',
    30 => 'Ward 6 - ZAPABAR MAIN ROAD - TAXI STAND',
    31 => 'Ward 7 - TIN BATTI TO TAXI STAND',
    32 => 'Ward 8 - SATYANARAYAN MANDIR / CHAPPLI SHERI',
    33 => 'Ward 9 - BHANDARWAD / CHINIYA SHERI',
    34 => 'Ward 10 - MARWAD HOSPITAL / NARAYAN PARK',
    35 => 'Ward 11 - DILIPNAGAR TO MASHAL CHOWK',
    36 => 'Ward 12 - GOVT COLLEGE ROAD',
    37 => 'Ward 13 - KHARIWAD / ICE FACTORY ROAD',
    38 => 'Ward 14 - ROMA GAS / LIFE CARE HOSPITAL',
    39 => 'Ward 15 - MITNAWAD / VAAD CHOWKI'
);

$config['nani_daman_village_array'] = array(
    '1', '3', '4', '7', '9', '10', '12', '13', '14', '16', '21', '23', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39'
);
$config['moti_daman_village_array'] = array(
    '2', '5', '6', '8', '11', '15', '17', '18', '19', '20', '24', '25', '26', '22'
);

define('OLD_MAM_NAME', '(Sagar S. Thakkar)');
define('OLD_MAM_IP', 'images/sst_mam_daman.png');
define('OLD_MAM_LDT', '2023-01-19 00:00:00');
define('MAM_PM_FIRST_SIGN', 'images/mam_daman_first_pm.png');
define('MAM_PM_FIRST_SIGN_LDT', '2023-05-19 00:00:00');
define('RELIGION_LAST_DATE_IN_CC', '2023-07-05 00:00:00');

define('INC_AMD_DT', '2023-02-08 00:00:00');
define('G20_LOGO_DT', '2023-02-15 00:00:00');

$config['mam_image_array'] = array(
    TALUKA_DAMAN => array(
        'mamlatdar_name' => '(Premji Makvana)',
        'image_path' => 'images/mam_daman.png',
        'district' => '<span class="f-aum">दमण</span> / Daman',
        'short_text' => 'DMN'
    ),
    TALUKA_DIU => array(
        'mamlatdar_name' => '(D. R. Damania)',
        'image_path' => 'images/mam_diu.png',
        'district' => '<span class="f-aum">दीव</span> / Diu',
        'short_text' => 'DIU'
    ),
);

$config['state_array'] = array(
    VALUE_ONE => 'DADRA AND NAGAR HAVELI AND DAMAN AND DIU'
);

$config['daman_diu_district_array'] = array(
    VALUE_ONE => 'DAMAN',
    VALUE_TWO => 'DIU',
    VALUE_THREE => 'DADRA AND NAGAR HAVELI',
        //VALUE_FOUR => 'DADRA AND NAGAR HAVELI',
);

// $config['dnh_district_array'] = array(
//     VALUE_THREE => 'DADRA AND NAGAR HAVELI',
// );

$config['daman_village_array_for_native'] = array(
    VALUE_ONE => 'Antiawad',
    VALUE_TWO => 'Bhamati',
    VALUE_THREE => 'Bhenslore',
    VALUE_FOUR => 'Bhimpore (CT)',
    VALUE_FIVE => 'Dabhel (CT)',
    VALUE_SIX => 'Damanwada (Dama O-De-Cima)',
    VALUE_SEVEN => 'Deva Pardi',
    VALUE_EIGHT => 'Devka',
    VALUE_NINE => 'Dholar',
    VALUE_TEN => 'Dunetha (CT)',
    VALUE_ELEVEN => 'GHELWAD',
    VALUE_TWELVE => 'Jampore',
    VALUE_THIRTEEN => 'Janivankad',
    VALUE_FOURTEEN => 'Kachigam (CT)',
    VALUE_FIFTEEN => 'Kadaiya (CT)',
    VALUE_SIXTEEN => 'KATHIRIA',
    VALUE_SEVENTEEN => 'Magarwada',
    VALUE_EIGHTEEN => 'Marwad (CT)',
    VALUE_NINETEEN => 'Naila Pardi',
    VALUE_TWENTY => 'Palhit',
    VALUE_TWENTYONE => 'Pariari',
    VALUE_TWENTYTWO => 'Patlara',
    VALUE_TWENTYTHREE => 'Ringanwada',
    VALUE_TWENTYFOUR => 'Somnath',
    VALUE_TWENTYFIVE => 'Thana Pardi',
    VALUE_TWENTYSIX => 'Varkund',
    VALUE_TWENTYSEVEN => 'Zari',
    VALUE_TWENTYEIGHT => 'Ward 1 - MOTI DAMAN - MARKET AREA',
    VALUE_TWENTYNINE => 'Ward 2 - MOTI DAMAN - FOOTBALL GROUND',
    VALUE_THIRTY => 'Ward 3 - NANI DAMAN - GANCHIWAD',
    VALUE_THIRTYONE => 'Ward 4 - RANA STREET / JAIN STREET',
    VALUE_THIRTYTWO => 'Ward 5 - NANI DAMAN JETTY AREA',
    VALUE_THIRTYTHREE => 'Ward 6 - ZAPABAR MAIN ROAD - TAXI STAND',
    VALUE_THIRTYFOUR => 'Ward 7 - TIN BATTI TO TAXI STAND',
    VALUE_THIRTYFIVE => 'Ward 8 - SATYANARAYAN MANDIR / CHAPPLI SHERI',
    VALUE_THIRTYSIX => 'Ward 9 - BHANDARWAD / CHINIYA SHERI',
    VALUE_THIRTYSEVEN => 'Ward 10 - MARWAD HOSPITAL / NARAYAN PARK',
    VALUE_THIRTYEIGHT => 'Ward 11 - DILIPNAGAR TO MASHAL CHOWK',
    VALUE_THIRTYNINE => 'Ward 12 - GOVT COLLEGE ROAD',
    VALUE_FOURTY => 'Ward 13 - KHARIWAD / ICE FACTORY ROAD',
    VALUE_FOURTYONE => 'Ward 14 - ROMA GAS / LIFE CARE HOSPITAL',
    VALUE_FOURTYTWO => 'Ward 15 - MITNAWAD / VAAD CHOWKI'
);
$config['diu_village_array_for_native'] = array(
    1 => 'Bhucharvada',
    2 => 'Saudwadi',
    3 => 'Vanakbara',
    4 => 'Zolawadi',
    5 => 'Diu - Fudam',
    6 => 'Ghoghla - 1 - Urban',
    7 => 'Ghoghla - 2 - Urban',
);
$config['dnh_village_array_for_native'] = array(
    VALUE_ONE => 'Ambabari',
    VALUE_TWO => 'Amboli',
    VALUE_THREE => 'Apti',
    VALUE_FOUR => 'Athal',
    VALUE_FIVE => 'Athola',
    VALUE_SIX => 'Bedpa',
    VALUE_SEVEN => 'Bensda',
    VALUE_EIGHT => 'Bildhari',
    VALUE_NINE => 'Bindrabin',
    VALUE_TEN => 'Bonta',
    VALUE_ELEVEN => 'Chauda',
    VALUE_TWELVE => 'Chikhali',
    VALUE_THIRTEEN => 'Chinchpada',
    VALUE_FOURTEEN => 'Chinsda',
    VALUE_FIFTEEN => 'Dadra (CT)',
    VALUE_SIXTEEN => 'Dapada',
    VALUE_SEVENTEEN => 'Demani',
    VALUE_EIGHTEEN => 'Dhapsa',
    VALUE_NINETEEN => 'Dolara',
    VALUE_TWENTY => 'Dudhani',
    VALUE_TWENTYONE => 'FALANDI',
    VALUE_TWENTYTWO => 'GALONDA',
    VALUE_TWENTYTHREE => 'Ghodbari',
    VALUE_TWENTYFOUR => 'Goratpada',
    VALUE_TWENTYFIVE => 'Gunsa',
    VALUE_TWENTYSIX => 'Jamalpada',
    VALUE_TWENTYSEVEN => 'Kala',
    VALUE_TWENTYEIGHT => 'Kanadi',
    VALUE_TWENTYNINE => 'Karachgam',
    VALUE_THIRTY => 'Karad',
    VALUE_THIRTYONE => 'Karchond',
    VALUE_THIRTYTWO => 'Kauncha',
    VALUE_THIRTYTHREE => 'Khadoli',
    VALUE_THIRTYFOUR => 'Khanvel',
    VALUE_THIRTYFIVE => 'Kharadpada',
    VALUE_THIRTYSIX => 'Khedpa',
    VALUE_THIRTYSEVEN => 'Kherarbari',
    VALUE_THIRTYEIGHT => 'Kherdi',
    VALUE_THIRTYNINE => 'Khutali',
    VALUE_FOURTY => 'Kilavani',
    VALUE_FOURTYONE => 'Kothar',
    VALUE_FOURTYTWO => 'Kudacha',
    VALUE_FOURTYTHREE => 'Luhari',
    VALUE_FOURTYFOUR => 'Mandoni',
    VALUE_FOURTYFIVE => 'Masat (CT)',
    VALUE_FOURTYSIX => 'Medha',
    VALUE_FOURTYSEVEN => 'Morkhal',
    VALUE_FOURTYEIGHT => 'Mota Randha',
    VALUE_FOURTYNINE => 'Nana Randha',
    VALUE_FIFTY => 'Naroli (CT)',
    VALUE_FIFTYONE => 'Parzai',
    VALUE_FIFTYTWO => 'Pati',
    VALUE_FIFTYTHREE => 'Rakholi (CT)',
    VALUE_FIFTYFOUR => 'Rudana',
    VALUE_FIFTYFIVE => 'Saily',
    VALUE_FIFTYSIX => 'Samarvarni (CT)',
    VALUE_FIFTYSEVEN => 'Shelti',
    VALUE_FIFTYEIGHT => 'Sili',
    VALUE_FIFTYNINE => 'Silvassa',
    VALUE_SIXTY => 'Sindoni',
    VALUE_SIXTYONE => 'Surangi',
    VALUE_SIXTYTWO => 'Talavali',
    VALUE_SIXTYTHREE => 'Tighra',
    VALUE_SIXTYFOUR => 'Tinoda',
    VALUE_SIXTYFIVE => 'UMARKUI',
    VALUE_SIXTYSIX => 'Umbervarni',
    VALUE_SIXTYSEVEN => 'Vaghchauda',
    VALUE_SIXTYEIGHT => 'Vaghchhipa',
    VALUE_SIXTYNINE => 'Vansda',
    VALUE_SEVENTY => 'Vasona',
    VALUE_SEVENTYONE => 'Velugam',
);

$config['relation_deceased_person_array'] = array(
    VALUE_ONE => 'Great Grand Father',
    VALUE_TWO => 'Great Grand Mother',
    VALUE_THREE => 'Grand Father',
    VALUE_FOUR => 'Grand Mother',
    VALUE_FIVE => 'Father',
    VALUE_SIX => 'Mother',
    VALUE_SEVEN => 'Husband',
    VALUE_EIGHT => 'Wife',
    VALUE_NINE => 'Father in law',
    VALUE_TEN => 'Mother in law',
    VALUE_ELEVEN => 'Son',
    VALUE_TWELVE => 'Daughter',
    VALUE_THIRTEEN => 'Sister',
    VALUE_FOURTEEN => 'Brother',
    VALUE_FIFTEEN => 'Sister in law',
    VALUE_SIXTEEN => 'Son in law',
    VALUE_SEVENTEEN => 'Brother in law',
    VALUE_EIGHTEEN => 'Daughter in law',
    VALUE_NINETEEN => 'Grand Son',
    VALUE_TWENTY => 'Grand Daughter',
    VALUE_TWENTYONE => 'Niece',
    VALUE_TWENTYTWO => 'Nephew',
    VALUE_TWENTYTHREE => 'Uncle'
);

$config['alive_death_status_array'] = array(
    VALUE_ONE => 'Alive',
    VALUE_TWO => 'Death',
);

$config['applicant_obc_caste_array'] = array(
    VALUE_ONE => 'Banjara',
    VALUE_TWO => 'Limbadi',
    VALUE_THREE => 'Lamani',
    VALUE_FOUR => 'Sugali',
    VALUE_FIVE => 'Bhandari',
    VALUE_SIX => 'Christian Chamar',
    VALUE_SEVEN => 'Christian Mahar',
    VALUE_EIGHT => 'Dhangar',
    VALUE_NINE => 'Dhobi',
    VALUE_TEN => 'Dhor',
    VALUE_ELEVEN => 'Gauda',
    VALUE_TWELVE => 'Goggi',
    VALUE_THIRTEEN => 'Gosavi (Dasnam, Goswami, Gosain)',
    VALUE_FOURTEEN => 'Kasar',
    VALUE_FIFTEEN => 'Koli - Patel',
    VALUE_SIXTEEN => 'Koli - Machhi',
    VALUE_SEVENTEEN => 'Koli - Kadia',
    VALUE_EIGHTEEN => 'Kumbi',
    VALUE_NINETEEN => 'Mitna',
    VALUE_TWENTY => 'Naidu',
    VALUE_TWENTYONE => 'Nath',
    VALUE_TWENTYTWO => 'Jogi',
    VALUE_TWENTYTHREE => 'Nhavi',
    VALUE_TWENTYFOUR => 'Nai',
    VALUE_TWENTYFIVE => 'Sagar',
    VALUE_TWENTYSIX => 'Yadav',
    VALUE_TWENTYSEVEN => 'Gavli',
    VALUE_TWENTYEIGHT => 'Rana',
    VALUE_TWENTYNINE => 'Luhar (Panchal)',
    VALUE_THIRTY => 'Kansara',
    VALUE_THIRTYONE => 'Kumbhar(Prajapati)',
    VALUE_THIRTYTWO => 'Kapdi',
    VALUE_THIRTYTHREE => 'Khatri (Vankar)',
    VALUE_THIRTYFOUR => 'Khatri (Rangara)',
    VALUE_THIRTYFIVE => 'Baria',
    VALUE_THIRTYSIX => 'Sorthi',
    VALUE_THIRTYSEVEN => 'Soni',
    VALUE_THIRTYEIGHT => 'Sonar',
    VALUE_THIRTYNINE => 'Mali',
    VALUE_FOURTY => 'Kasbati (Muslim)',
    VALUE_FOURTYONE => 'Mansuri (Muslim)',
    VALUE_FOURTYTWO => 'Darji',
    VALUE_FOURTYTHREE => 'Bhoi',
    VALUE_FOURTYFOUR => 'Vanza',
    VALUE_FOURTYFIVE => 'Kharva',
    VALUE_FOURTYSIX => 'Khatki (Butchar)',
    VALUE_FOURTYSEVEN => 'Kureshi (Muzavar)',
    VALUE_FOURTYEIGHT => 'Mogal',
    VALUE_FOURTYNINE => 'Thapania',
    VALUE_FIFTY => 'Vadhel (Muslim)',
    VALUE_FIFTYONE => 'Mir',
    VALUE_FIFTYTWO => 'Fakir',
    VALUE_FIFTYTHREE => 'Khalifa (Nai)',
    VALUE_FIFTYFOUR => 'Mangela',
    VALUE_FIFTYFIVE => 'Koli Khania',
    VALUE_FIFTYSIX => 'Salat',
    VALUE_FIFTYSEVEN => 'Koli',
);

$config['applicant_obc_caste_arrayOne'] = array(
    VALUE_ONE => 'Banjara',
    VALUE_TWO => 'Limbadi',
    VALUE_THREE => 'Lamani',
    VALUE_FOUR => 'Sugali',
    VALUE_FIVE => 'Bhandari',
    VALUE_SIX => 'Christian Chamar',
    VALUE_SEVEN => 'Christian Mahar',
    VALUE_EIGHT => 'Dhangar',
    VALUE_NINE => 'Dhobi',
    VALUE_TEN => 'Dhor',
    VALUE_ELEVEN => 'Gauda',
    VALUE_TWELVE => 'Goggi',
    VALUE_THIRTEEN => 'Gosavi (Dasnam, Goswami, Gosain)',
    VALUE_FOURTEEN => 'Kasar',
    VALUE_FIFTEEN => 'Koli - Patel',
    VALUE_SIXTEEN => 'Machii - Patel',
    VALUE_SEVENTEEN => 'Kadia - Patel',
    VALUE_EIGHTEEN => 'Kumbi',
    VALUE_NINETEEN => 'Mitna',
    VALUE_TWENTY => 'Naidu',
    VALUE_TWENTYONE => 'Nath',
    VALUE_TWENTYTWO => 'Jogi',
    VALUE_TWENTYTHREE => 'Nhavi',
    VALUE_TWENTYFOUR => 'Nai',
    VALUE_TWENTYFIVE => 'Sagar',
    VALUE_TWENTYSIX => 'Yadav',
    VALUE_TWENTYSEVEN => 'Gavli',
    VALUE_FIFTYSEVEN => 'Koli',
);

$config['applicant_obc_caste_arrayTwo'] = array(
    VALUE_TWENTYEIGHT => 'Rana',
);

$config['applicant_obc_caste_arrayThree'] = array(
    VALUE_TWENTYNINE => 'Luhar (Panchal)',
    VALUE_THIRTY => 'Kansara',
    VALUE_THIRTYONE => 'Kumbhar(Prajapati)',
    VALUE_THIRTYTWO => 'Kapdi',
    VALUE_THIRTYTHREE => 'Khatri (Vankar)',
    VALUE_THIRTYFOUR => 'Khatri (Rangara)',
    VALUE_THIRTYFIVE => 'Baria',
    VALUE_THIRTYSIX => 'Sorthi',
    VALUE_THIRTYSEVEN => 'Soni',
    VALUE_THIRTYEIGHT => 'Sonar',
    VALUE_THIRTYNINE => 'Mali',
    VALUE_FOURTY => 'Kasbati (Muslim)',
    VALUE_FOURTYONE => 'Mansuri (Muslim)',
    VALUE_FOURTYTWO => 'Darji',
    VALUE_FOURTYTHREE => 'Bhoi',
    VALUE_FOURTYFOUR => 'Vanza',
    VALUE_FOURTYFIVE => 'Kharva',
    VALUE_FOURTYSIX => 'Khatki (Butchar)',
    VALUE_FOURTYSEVEN => 'Kureshi (Muzavar)',
    VALUE_FOURTYEIGHT => 'Mogal',
    VALUE_FOURTYNINE => 'Thapania',
    VALUE_FIFTY => 'Vadhel (Muslim)',
    VALUE_FIFTYONE => 'Mir',
    VALUE_FIFTYTWO => 'Fakir',
    VALUE_FIFTYTHREE => 'Khalifa (Nai)',
    VALUE_FIFTYFOUR => 'Mangela',
    VALUE_FIFTYFIVE => 'Koli Khania',
    VALUE_FIFTYSIX => 'Salat',
);

$config['type_of_resident_array'] = array(
    VALUE_ONE => 'Own',
    VALUE_TWO => 'Rented',
);

$config['business_type_array'] = array(
    VALUE_ONE => 'Business',
    VALUE_TWO => 'Service',
    VALUE_THREE => 'House Wife',
);

$config['education_type_array'] = array(
    VALUE_ONE => '10 th',
    VALUE_TWO => '12 th',
    VALUE_THREE => 'Graduate',
    VALUE_FOUR => 'Post Graduate',
    VALUE_FIVE => 'Others',
);

$config['site_proposed_array'] = array(
    VALUE_ONE => 'Residential',
    VALUE_TWO => 'Industrial',
    VALUE_THREE => 'Commercial',
    VALUE_FOUR => 'Residential-cumCommercial',
    VALUE_FIVE => 'Any other N.A. Purpose',
);

$config['occupant_type_array'] = array(
    VALUE_ONE => 'Class - I',
    VALUE_TWO => 'Class - II',
    VALUE_THREE => 'Tenant',
    VALUE_FOUR => 'Government Lessee',
);

$config['reverify_type_array'] = array(
    VALUE_ONE => 'Talathi',
    VALUE_TWO => 'Awal Karkun / Circle Inspector'
);

$config['talathi_reverify_type_array'] = array(
    VALUE_ONE => 'Awal Karkun / Circle Inspector',
    VALUE_TWO => 'Mamlatdar'
);
$config['daman_city_array'] = array(
    VALUE_ONE => 'Nani Daman',
    VALUE_TWO => 'Moti Daman',
);
$config['diu_city_array'] = array(
    VALUE_ONE => 'Diu',
);
$config['dnh_city_array'] = array(
    VALUE_ONE => 'DNH',
);
$config['daman_city_pincode_array'] = array(
    1 => '396210',
    2 => '396220',
);
$config['diu_city_pincode_array'] = array(
    1 => '362520',
);
$config['dnh_city_pincode_array'] = array(
    1 => '396230',
);
$config['domicile_certificate_purpose_array'] = array(
    VALUE_ONE => 'Widow Pension Scheme',
    VALUE_TWO => 'Old Age Pension Scheme',
    VALUE_THREE => 'Aayushman Bharat Scheme',
    VALUE_FOUR => 'Ration Card',
    VALUE_FIVE => 'Others',
);

$config['rti_type_array'] = array(
    VALUE_ONE => 'Photo Copy',
    VALUE_TWO => 'Floppy;etc',
);

$config['case_response_type_array'] = array(
    VALUE_ONE => 'Petitioner',
    VALUE_TWO => 'Respondent',
);
$config['case_type_array'] = array(
    VALUE_ONE => 'Mamlatdar Court',
    VALUE_TWO => 'LRC Appeal (Remind back)',
    VALUE_THREE => 'DAPVR Under Section 12-A',
);
$config['case_year_array'] = array(
    VALUE_ONE => '1980',
    VALUE_TWO => '1981',
    VALUE_THREE => '1982',
    VALUE_FOUR => '1983',
    VALUE_FIVE => '1984',
    VALUE_SIX => '1985',
    VALUE_SEVEN => '1986',
    VALUE_EIGHT => '1987',
    VALUE_NINE => '1988',
    VALUE_TEN => '1989',
    VALUE_ELEVEN => '1990',
    VALUE_TWELVE => '1991',
    VALUE_THIRTEEN => '1992',
    VALUE_FOURTEEN => '1993',
    VALUE_FIFTEEN => '1994',
    VALUE_SIXTEEN => '1995',
    VALUE_SEVENTEEN => '1996',
    VALUE_EIGHTEEN => '1997',
    VALUE_NINETEEN => '1998',
    VALUE_TWENTY => '1999',
    VALUE_TWENTYONE => '2000',
    VALUE_TWENTYTWO => '2001',
    VALUE_TWENTYTHREE => '2002',
    VALUE_TWENTYFOUR => '2003',
    VALUE_TWENTYFIVE => '2004',
    VALUE_TWENTYFIVE => '2005',
    VALUE_TWENTYSIX => '2006',
    VALUE_TWENTYSEVEN => '2007',
    VALUE_TWENTYEIGHT => '2008',
    VALUE_TWENTYNINE => '2009',
    VALUE_THIRTY => '2010',
    VALUE_THIRTYONE => '2011',
    VALUE_THIRTYTWO => '2012',
    VALUE_THIRTYTHREE => '2013',
    VALUE_THIRTYFOUR => '2014',
    VALUE_THIRTYFIVE => '2015',
    VALUE_THIRTYSIX => '2016',
    VALUE_THIRTYSEVEN => '2017',
    VALUE_THIRTYEIGHT => '2018',
    VALUE_THIRTYNINE => '2019',
    VALUE_FOURTY => '2020',
    VALUE_FOURTYONE => '2021',
    VALUE_FOURTYTWO => '2022',
    VALUE_FOURTYTHREE => '2023',
    VALUE_FOURTYFOUR => '2024',
    VALUE_FOURTYFIVE => '2025',
);

$config['doc_language_array'] = array(
    VALUE_ONE => 'English',
    VALUE_TWO => 'Gujarati',
    VALUE_THREE => 'Hindi',
    VALUE_FOUR => 'Assamese',
    VALUE_FIVE => 'Bengali',
    VALUE_SIX => 'Kannada',
    VALUE_SEVEN => 'Kashmiri',
    VALUE_EIGHT => 'Konkani',
    VALUE_NINE => 'Malayalam',
    VALUE_TEN => 'Manipuri',
    VALUE_ELEVEN => 'Marathi',
    VALUE_TWELVE => 'Nepali',
    VALUE_THIRTEEN => 'Oriya',
    VALUE_FOURTEEN => 'Punjabi',
    VALUE_FIFTEEN => 'Sanskrit',
    VALUE_SIXTEEN => 'Sindhi',
    VALUE_SEVENTEEN => 'Tamil',
    VALUE_EIGHTEEN => 'Telugu',
    VALUE_NINETEEN => 'Urdu',
    VALUE_TWENTY => 'Bodo',
    VALUE_TWENTYONE => 'Santhali',
    VALUE_TWENTYTWO => 'Maithili',
    VALUE_TWENTYTHREE => 'Dogri',
);

$config['doc_type_array'] = array(
    VALUE_ONE => 'Additional Deed (Mortgage)',
    VALUE_TWO => 'Adoption Deed',
    VALUE_FOUR => 'Agreement of Sale',
    VALUE_FIVE => 'Cancellation / Revocation of General Power of Attorney',
    VALUE_SIX => 'Cancellation of  Will',
    VALUE_SEVEN => 'Cancellation of Conveyance',
    VALUE_EIGHT => 'Cancellation of Lease Pandency',
    VALUE_NINE => 'Correction',
    VALUE_TEN => 'Counterpart Or Duplicate',
    VALUE_ELEVEN => 'Deed of Admission',
    VALUE_TWELVE => 'Deed of Assignment',
    VALUE_THIRTEEN => 'Deed of Assignment(Amount of Consideration = 0)',
    VALUE_FOURTEEN => 'Deed of Cancellation',
    VALUE_FIFTEEN => 'Deed of Declaration',
    VALUE_SIXTEEN => 'Deed of Dissolution',
    VALUE_SEVENTEEN => 'Deed of Confirmation & Rectification Deed of Acknowledgement',
    VALUE_EIGHTEEN => 'Deed of Transfer',
    VALUE_NINETEEN => 'Divorce',
    VALUE_TWENTY => 'Duplicate Lease Deed',
    VALUE_TWENTYONE => 'Exchange Deed',
    VALUE_TWENTYTWO => 'Family Settlement Deed',
    VALUE_TWENTYTHREE => 'Generel Power of Attorney',
    VALUE_TWENTYFOUR => 'Gift Deed',
    VALUE_TWENTYFIVE => 'Irrevocable Generel  Power of Attorney',
    VALUE_TWENTYSEVEN => 'Lease Deed',
    VALUE_TWENTYEIGHT => 'LIS Pendence',
    VALUE_TWENTYNINE => 'Memorandum of Understanding Deed',
    VALUE_THIRTY => 'Mortgage / Loan',
    VALUE_THIRTYONE => 'Mortgage Deed for BANK ant Other Corporation',
    VALUE_THIRTYTWO => 'Mortgage Deed with possession',
    VALUE_THIRTYTHREE => 'Mortgage deed without possession',
    VALUE_THIRTYFOUR => 'Mortgage Of Crop (Loan Repayable After Three Month)',
    VALUE_THIRTYFIVE => 'Notary Work (Will Deed ,Adoption Deed,Success Deed)',
    VALUE_THIRTYSEVEN => 'Partition Deed',
    VALUE_THIRTYEIGHT => 'Partnership Deed',
    VALUE_THIRTYNINE => 'Possession Deed',
    VALUE_FOURTY => 'Power of Attorney',
    VALUE_FOURTYONE => 'Reconveyance Deed',
    VALUE_FOURTYTWO => 'Release (With Consideration)',
    VALUE_FOURTYTHREE => 'Release Deed',
    VALUE_FOURTYFOUR => 'Retirement Deed',
    VALUE_FOURTYFIVE => 'Retirement Cum Partnership Deed',
    VALUE_FOURTYSIX => 'Sale Deed (Exemption) for Resale',
    VALUE_FOURTYSEVEN => 'Sale Deed / Conveyance Deed',
    VALUE_FOURTYEIGHT => 'Special  Power of Attorney',
    VALUE_FOURTYNINE => 'Transfer (Property Under Administartive)',
    VALUE_FIFTY => 'Transfer Of Bond, Policy, Mortgage Deed',
    VALUE_FIFTYTWO => 'Trust Deed',
    VALUE_FIFTYTHREE => 'Will Deed',
    VALUE_FIFTYFOUR => 'Deed of Cancellation of Agreement',
    VALUE_FIFTYFIVE => 'Delcaration Cum Consent cum Release Deed',
);

$config['fee_exemption_array'] = array(
    VALUE_ONE => 'Applicable',
    VALUE_TWO => 'Not Applicable',
);

$config['dr_app_status_array'] = array(
    VALUE_ZERO => '<span class="badge bg-nic-blue app-status">Draft</span>',
    VALUE_ONE => '<span class="badge bg-nic-blue app-status">Draft</span>',
    VALUE_TWO => '<span class="badge bg-warning app-status">Application Submitted</span>',
    VALUE_EIGHT => '<span class="badge bg-warning app-status">Doc. Verified<hr>Appointment Approval Pending</span>',
    VALUE_THREE => '<span class="badge bg-warning app-status">Doc. Verified<hr>Appointment Pending</span>',
    VALUE_FOUR => '<span class="badge bg-nic-blue app-status">Doc. Verified<hr style="border-top-color: white;">Appointment Scheduled</span>',
    VALUE_FIVE => '<span class="badge bg-success app-status">Document Registered</span>',
    VALUE_SIX => '<span class="badge bg-danger app-status">Rejected</span>',
//    VALUE_SEVEN => '<span class="badge bg-orange app-status">Final Approval in Process</span>',
);

$config['dr_app_status_text_array'] = array(
    VALUE_TWO => 'Application Submitted',
    VALUE_EIGHT => 'Doc. Verified & Appointment Approval Pending',
    VALUE_THREE => 'Doc. Verified & Appointment Pending',
    VALUE_FOUR => 'Doc. Verified & Appointment Scheduled',
    VALUE_FIVE => 'Document Registered',
    VALUE_SIX => 'Rejected',
//    VALUE_SEVEN => 'Final Approval in Process',
);

$config['dr_upload_doc_status_array'] = array(
    VALUE_ZERO => '<span class="badge bg-warning app-status">Registered Document Upload Pending</span>',
    VALUE_ONE => '<span class="badge bg-warning app-status">Registered Document Uploaded & Lock Pending </span>',
    VALUE_TWO => '<span class="badge bg-success app-status">Locked</span>',
);
$config['dr_upload_doc_status_text_array'] = array(
    VALUE_ZERO => 'Registered Document Upload Pending',
    VALUE_ONE => 'Registered Document Uploaded & Lock Pending ',
    VALUE_TWO => 'Locked',
);

$config['party_category_array'] = array(
    VALUE_ONE => 'Executant',
    VALUE_TWO => 'Claimant',
    VALUE_THREE => 'Executant & Claimant',
    VALUE_FOUR => 'Confirming Party',
    VALUE_FIVE => 'Identifier',
    VALUE_SIX => 'Witness',
);

$config['party_description_array'] = array(
    VALUE_ONE => 'Executing Party /Seller',
    VALUE_TWO => 'Claiming Party/ Purchaser',
    VALUE_THREE => 'Identifier',
    VALUE_FOUR => 'Power of Attorney Holder',
    VALUE_FIVE => 'Confirming Party',
    VALUE_SIX => 'Confirming Party for Vendor',
    VALUE_SEVEN => 'Confirming Party for Purchaser',
    VALUE_EIGHT => 'Witness',
    VALUE_NINE => 'Dirctor',
    VALUE_TEN => 'Document Hand Over To',
    VALUE_ELEVEN => 'Power of Attorney Holder - Vendor',
    VALUE_TWELVE => 'Power of Attorney Holder - Purchaser',
    VALUE_THIRTEEN => 'Power of Attorney Holder - Confirming Party',
    VALUE_FOURTEEN => 'Power of Attorney Holder - Vendor & Confirming Party',
    VALUE_FIFTEEN => 'Mortgagor',
    VALUE_SIXTEEN => 'Mortgagee',
    VALUE_SEVENTEEN => 'Releasor',
    VALUE_EIGHTEEN => 'Releasee',
    VALUE_NINETEEN => 'Doner',
    VALUE_TWENTY => 'Donee',
    VALUE_TWENTYONE => 'Borrower',
    VALUE_TWENTYTWO => 'Borrowee',
);

$config['birth_type_array'] = array(
    VALUE_ONE => 'Date',
    VALUE_TWO => 'Year',
    VALUE_THREE => 'Age',
);

$config['religion_array'] = array(
    VALUE_ONE => 'HINDU',
    VALUE_TWO => 'MUSLIM',
    VALUE_THREE => 'CHRISTIAN',
    VALUE_FOUR => 'SINDI',
    VALUE_FIVE => 'OTHERS',
    VALUE_SIX => 'SHIKH',
    VALUE_SEVEN => 'PARSI',
);

$config['dr_occupation_array'] = array(
    VALUE_ONE => 'Bussiness',
    VALUE_TWO => 'House Wife',
    VALUE_THREE => 'Service',
    VALUE_FOUR => 'Retierd',
    VALUE_FIVE => 'Study',
    VALUE_SIX => 'House keeping',
    VALUE_SEVEN => 'Farming',
    VALUE_EIGHT => 'Other'
);

$config['pan_type_array'] = array(
    VALUE_ONE => 'PAN Number',
    VALUE_TWO => 'Form 60'
);

$config['dr_property_unit_array'] = array(
    VALUE_ONE => 'Sq. Metre',
    VALUE_TWO => 'Sq. Yards',
    VALUE_THREE => 'HectareAre',
    VALUE_FOUR => 'AcreGuntha',
    VALUE_FIVE => 'Sq. Foot'
);

$config['mv_exemption_array'] = array(
    VALUE_ONE => 'Residential < 50 or  < 100 Sqmts',
    VALUE_TWO => 'Tenant for more than 15 yrs Residential',
    VALUE_THREE => 'With permission of Charity Comm. Sale by Trust',
    VALUE_FOUR => 'Small / Simant farmer',
    VALUE_FIVE => 'GIDC Shade/Plot Saledeed',
    VALUE_SIX => 'GRHB / GHB first Alotty conveyance',
    VALUE_SEVEN => 'Public Auction made by GOVT.',
    VALUE_EIGHT => 'Weaker Section',
    VALUE_NINE => 'Executed by Govt.',
    VALUE_TEN => 'OTHERS',
    VALUE_ELEVEN => 'BPL Exemption'
);

$config['sd_exemption_array'] = array(
    VALUE_ONE => 'Exemption by under section 9',
    VALUE_TWO => 'Agriculture & Land Development',
    VALUE_THREE => 'Loan for  Agricultural/Rural Activities',
    VALUE_FOUR => 'Reg. Society (SC/ST)',
    VALUE_FIVE => 'Lease (GIDC)',
    VALUE_SIX => 'GRHB / GHB (GHB Pays the Stamp Duty)',
    VALUE_SEVEN => 'Mortgage by Co-operative Society.',
    VALUE_EIGHT => 'Mortgage (Guj. Co-op. Hsg. Finance Ltd.)',
    VALUE_NINE => "Partition of Agri. Land bet'n brothers",
    VALUE_TEN => 'Industrial Mortgage',
    VALUE_ELEVEN => 'Sale Deed in favour if Public Trust',
    VALUE_TWELVE => 'Loan/Advance by APMC',
    VALUE_THIRTEEN => 'Registered under NTC act 1959',
);

$config['dr_poa_type_array'] = array(
    VALUE_ONE => 'General',
    VALUE_TWO => 'Particular'
);

$config['land_owner_type_array'] = array(
    VALUE_ONE => 'Individual',
    VALUE_TWO => 'Joint'
);

define('CONSIDERATION_AMOUNT', 500000);

$config['dr_dpe_type_array'] = array(
    VALUE_ONE => 'Within India',
    VALUE_TWO => 'Outside India'
);

$config['dr_main_property_type_array'] = array(
    VALUE_ONE => 'For Open Land Only',
    VALUE_TWO => 'For Constructed Property Only',
    VALUE_THREE => 'Constructed Property with Land'
);

$config['dr_property_type_array'] = array(
    VALUE_ONE => array(
        VALUE_ONE => 'Agriculture',
        VALUE_TWO => 'Residential',
        VALUE_THREE => 'Commercial / Industrial'
    ),
    VALUE_TWO => array(
        VALUE_FOUR => 'Bungalows/Individual Houses/ Farm Houses / Raw Houses',
        VALUE_FIVE => 'Industrial Building',
        VALUE_SIX => 'Commercial Buildings',
        VALUE_SEVEN => 'Commercial Shops',
        VALUE_EIGHT => 'Apartment / Flats',
        VALUE_NINE => 'Industrial / Commercial Gala'
    ),
);
$config['dr_construction_category_array'] = array(
    VALUE_FOUR => array(
        VALUE_ONE => 'Normal Construction',
        VALUE_TWO => 'Superior Construction',
    ),
    VALUE_FIVE => array(
        VALUE_THREE => 'Ac Sheet / GI Sheet Roofig',
        VALUE_FOUR => 'R.C.C Factory Building upto 16 ft. Height',
        VALUE_FIVE => 'R.C.C Factory Building above 16 ft. Height',
        VALUE_SIX => 'Tin shed structure without walls / open on all sides'
    ),
    VALUE_SIX => array(
        VALUE_SEVEN => 'Offices',
        VALUE_EIGHT => 'Superior Constructions',
        VALUE_NINE => 'Shops in Malls',
        VALUE_TEN => 'Hotels A Category',
        VALUE_ELEVEN => 'Hotels B Category',
        VALUE_TWELVE => 'Hotels C Category'
    ),
    VALUE_SEVEN => array(
        VALUE_THIRTEEN => 'Normal Construction',
        VALUE_FOURTEEN => 'Superior Construction',
    ),
    VALUE_EIGHT => array(
        VALUE_FIFTEEN => 'Normal Construction',
        VALUE_SIXTEEN => 'Superior Construction',
    ),
    VALUE_NINE => array(
        VALUE_SEVENTEEN => 'Gala upto 16 ft. Height',
        VALUE_EIGHTEEN => 'Gala above 16 ft. Height',
    ),
);

$config['dr_mf_array'] = array(
    VALUE_ONE => array('mf_id' => VALUE_ONE, 'building_age' => '0 to 5 Years', 'mf' => 1),
    VALUE_TWO => array('mf_id' => VALUE_TWO, 'building_age' => '5 to 10 Years', 'mf' => 0.9),
    VALUE_THREE => array('mf_id' => VALUE_THREE, 'building_age' => '10 to 15 Years', 'mf' => 0.8),
    VALUE_FOUR => array('mf_id' => VALUE_FOUR, 'building_age' => '15 to 20 Years', 'mf' => 0.7),
    VALUE_FIVE => array('mf_id' => VALUE_FIVE, 'building_age' => '20 to 25 Years', 'mf' => 0.6),
    VALUE_SIX => array('mf_id' => VALUE_SIX, 'building_age' => 'Above 25 Years', 'mf' => 0.5)
);

define('IMAGE_NA_PATH', 'images/no-image.png');
define('THUMB_NA_PATH', 'images/no-thumb.png');

$config['dr_ownership_type_array'] = array(
    VALUE_ONE => 'Female Only',
    VALUE_TWO => 'Male Only',
    VALUE_THREE => 'Joint (Male + Female)',
    VALUE_FOUR => 'Society',
    VALUE_FIVE => 'Company / Industry / Firm',
    VALUE_SIX => 'Trust'
);

$config['sd_rf_type_array'] = array(
    VALUE_ONE => 'Percentage',
    VALUE_TWO => 'SD : Percentage + RF : Amount + Other Amount',
    VALUE_THREE => 'SD : Percentage + RF : Percentage + Other Amount',
    VALUE_FOUR => 'SD : Amount + RF : Amount + Other Amount',
    VALUE_FIVE => 'SD : Amount + RF : Amount',
);
$config['ex_type_array'] = array(
    VALUE_ONE => 'SD : Percentage or RF : Percentage'
);

$config['is_allow_land_details_array'] = array(
    VALUE_ONE, VALUE_FOUR, VALUE_SIX, VALUE_SEVEN, VALUE_EIGHT, VALUE_NINE, VALUE_TEN, VALUE_ELEVEN,
    VALUE_TWELVE, VALUE_THIRTEEN, VALUE_FOURTEEN, VALUE_FIFTEEN, VALUE_SIXTEEN, VALUE_SEVENTEEN, VALUE_EIGHTEEN,
    VALUE_TWENTY, VALUE_TWENTYONE, VALUE_TWENTYTWO, VALUE_TWENTYFOUR, VALUE_TWENTYFIVE, VALUE_TWENTYSEVEN,
    VALUE_TWENTYEIGHT, VALUE_TWENTYNINE, VALUE_THIRTY, VALUE_THIRTYONE, VALUE_THIRTYTWO, VALUE_THIRTYTHREE,
    VALUE_THIRTYFOUR, VALUE_THIRTYFIVE, VALUE_THIRTYSEVEN, VALUE_THIRTYEIGHT, VALUE_THIRTYNINE, VALUE_FOURTY,
    VALUE_FOURTYONE, VALUE_FOURTYTWO, VALUE_FOURTYTHREE, VALUE_FOURTYFOUR, VALUE_FOURTYFIVE, VALUE_FOURTYSIX,
    VALUE_FOURTYSEVEN, VALUE_FOURTYEIGHT, VALUE_FOURTYNINE, VALUE_FIFTYTWO, VALUE_FIFTYTHREE, VALUE_FIFTYFOUR,
    VALUE_FIFTYFIVE
);

$config['is_allow_exemption_array'] = array(
    VALUE_TWELVE, VALUE_TWENTYFOUR, VALUE_THIRTYONE, VALUE_THIRTYTWO, VALUE_THIRTYTHREE, VALUE_FOURTYTWO,
    VALUE_FOURTYSIX, VALUE_FOURTYSEVEN
);

$config['lease_period_array'] = array(
    VALUE_ONE => '0 to 1 Year',
    VALUE_TWO => '1 to 5 Years',
    VALUE_THREE => '5 to 10 Years',
    VALUE_FOUR => '10 to 20 Years',
    VALUE_FIVE => '20 to 30 Years',
    VALUE_SIX => '30 to 100 Years'
);

$config['doc_type_cp_array'] = array(
    VALUE_ONE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27)
    ),
    VALUE_TWO => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_FOUR => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_FIVE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_TWO => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_THREE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_SIX => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5)
    ),
    VALUE_SIX => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_SEVEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_EIGHT => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_NINE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_TEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_ELEVEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102)
    ),
    VALUE_TWELVE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_ONE, 'sd' => 4, 'rf' => 0),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 5, 'rf' => 0.25, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27)
    ),
    VALUE_THIRTEEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_FOURTEEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_FIFTEEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_SIXTEEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102)
    ),
    VALUE_SEVENTEEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_EIGHTEEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_NINETEEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_TWENTY => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_TWENTYONE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
    ),
    VALUE_TWENTYTWO => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_TWENTYTHREE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_TWO => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_THREE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_SIX => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
    ),
    VALUE_TWENTYFOUR => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_ONE, 'sd' => 4, 'rf' => 0),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 5, 'rf' => 0.25, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
    ),
    VALUE_TWENTYFIVE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_TWO => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_THREE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_SIX => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5)
    ),
    VALUE_TWENTYSEVEN => array(
        VALUE_ONE => array('d_sd' => 0, 'r_sd' => 0.5, 'dr_rf' => 0.5),
        VALUE_TWO => array('d_sd' => 1, 'r_sd' => 0.5, 'dr_rf' => 0.5),
        VALUE_THREE => array('d_sd' => 1, 'r_sd' => 1, 'dr_rf' => 0.5),
        VALUE_FOUR => array('d_sd' => 1, 'r_sd' => 2, 'dr_rf' => 0.5),
        VALUE_FIVE => array('d_sd' => 1, 'r_sd' => 3, 'dr_rf' => 0.5),
        VALUE_SIX => array('d_sd' => 1, 'r_sd' => 4, 'dr_rf' => 0.5),
    ),
    VALUE_TWENTYEIGHT => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_TWENTYNINE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_THIRTY => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27)
    ),
    VALUE_THIRTYONE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27)
    ),
    VALUE_THIRTYTWO => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27)
    ),
    VALUE_THIRTYTHREE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27)
    ),
    VALUE_THIRTYFOUR => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_THIRTYFIVE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_THIRTYSEVEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 1, 'rf' => 0.5, 'o_rf' => 27)
    ),
    VALUE_THIRTYEIGHT => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102)
    ),
    VALUE_THIRTYNINE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_FOURTY => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_TWO => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_THREE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_SIX => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5)
    ),
    VALUE_FOURTYONE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_FOURTYTWO => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_ONE, 'sd' => 4, 'rf' => 0),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 5, 'rf' => 0.25, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27)
    ),
    VALUE_FOURTYTHREE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_FOURTYFOUR => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 102)
    ),
    VALUE_FOURTYFIVE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_FOURTYSIX => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_ONE, 'sd' => 4, 'rf' => 0),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 5, 'rf' => 0.25, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
    ),
    VALUE_FOURTYSEVEN => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_ONE, 'sd' => 4, 'rf' => 0),
        VALUE_TWO => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_THREE => array('sd_rf_type' => VALUE_THREE, 'sd' => 5, 'rf' => 0.25, 'o_rf' => 27),
        VALUE_FOUR => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_FIVE => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
        VALUE_SIX => array('sd_rf_type' => VALUE_THREE, 'sd' => 6, 'rf' => 0.5, 'o_rf' => 27),
    ),
    VALUE_FOURTYEIGHT => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_TWO => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_THREE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
        VALUE_SIX => array('sd_rf_type' => VALUE_FIVE, 'sd' => 10, 'rf' => 5),
    ),
    VALUE_FOURTYNINE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_FIFTY => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_TWO, 'sd' => 0.5, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_TWO, 'sd' => 0.5, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_TWO, 'sd' => 0.5, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_TWO, 'sd' => 0.5, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_FIFTYTWO => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_FIFTYTHREE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 100, 'rf' => 17)
    ),
    VALUE_FIFTYFOUR => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
    VALUE_FIFTYFIVE => array(
        VALUE_ONE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_TWO => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_THREE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FOUR => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_FIVE => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17),
        VALUE_SIX => array('sd_rf_type' => VALUE_FOUR, 'sd' => 10, 'rf' => 17)
    ),
);

$config['dr_basic_fees_array'] = array('Registration Fees', 'Feeling and Comparing (Folios / Sides)',
    'Copy Fees for Endorsements', 'Postage', 'Copies or Memoranda (Section 64 to 67)', 'Searches or Inspection',
    'Section 25', 'Section 35', 'Certified Copies (Section 57) Folios');

$config['diu_native_city_array'] = array(
    VALUE_THREE => 'Diu'
);

$config['cert_type_array'] = array(
    VALUE_ONE => 'Non-Creamy Layer',
    VALUE_TWO => 'Creamy Layer',
);

$config['appointment_filter_array'] = array(
    VALUE_ONE => 'Previous Day',
    VALUE_TWO => 'Today',
    VALUE_THREE => 'Next Day',
    VALUE_FOUR => 'Not Scheduled',
    VALUE_FIVE => 'Scheduled',
);

$config['appointment_type_array'] = array(
    VALUE_ONE => 'Online Statement',
    VALUE_TWO => 'Visit Office'
);

$config['currently_on_type_array'] = array(
    VALUE_ONE => 'Currently On Hand',
    VALUE_TWO => 'Forwarded',
    VALUE_THREE => 'Reverification : Currently On Hand',
    VALUE_FOUR => 'Reverification : Forwarded'
);

$config['currently_on_ga_type_array'] = array(
    VALUE_ONE => 'Currently On Hand',
    VALUE_TWO => 'Forwarded'
);

$config['area_type_array'] = array(
    VALUE_ONE => 'PT Sheet Wise Area',
    VALUE_TWO => 'Gauthan Wise Area'
);

$config['property_status_array'] = array(
    VALUE_ONE => '<span class="badge bg-success app-status">Confirmed</span>',
    VALUE_TWO => '<span class="badge bg-orange app-status">Provisional</span>',
);

$config['property_status_text_array'] = array(
    VALUE_ONE => 'Confirmed',
    VALUE_TWO => 'Provisional',
);

$config['ps_form_array'] = array(
    VALUE_ONE => array(
        VALUE_ONE => 'Form D',
        VALUE_TWO => 'Form B',
    ),
    VALUE_TWO => array(
        VALUE_TWO => 'Form B',
    ),
);

$config['service_type_array'] = array(
    VALUE_ONE => 'Pre-Establishment',
    VALUE_TWO => 'Pre-Operation',
    VALUE_THREE => 'Pre-Establishment & Pre-Operation',
    VALUE_FOUR => 'Renewal',
    VALUE_FIVE => 'Post-Establishment',
    VALUE_SIX => 'Post-Operation',
    VALUE_SEVEN => 'Pre-Operation & Post-Operation',
);

$config['form_type_array'] = array(
    VALUE_ZERO => 'Site Plan',
    VALUE_ONE => 'Form-D',
    VALUE_TWO => 'Form-B'
);

define('RLP_RA_PRICE_PER_GUNTHA', 2);
define('RLP_UA_PRICE_PER_GUNTHA', 400);
define('NA_NATURE_CODE', 'N.A');

$config['ru_area_villages_array'] = array(
    524926 => 'Marwad(CT)',
    524929 => 'Dunetha(CT)',
    923609 => 'Kathiriya',
    802638 => 'Juprim'
);

$config['relation_status_array'] = array(
    VALUE_ONE => 'Father',
    VALUE_TWO => 'Mother',
    VALUE_THREE => 'Grand Father',
    VALUE_FOUR => 'Grand Mother',
    VALUE_FIVE => 'Other',
);

$config['applying_for_array'] = array(
    VALUE_ONE => 'Applying For Certificate Only',
    VALUE_TWO => 'Applying For Certificate With Teor',
);

$config['date_year_array'] = array(
    VALUE_ONE => 'Date',
    VALUE_TWO => 'Year',
    VALUE_THREE => 'None',
);

$config['active_deactive_array'] = array(
    VALUE_ZERO => '',
    VALUE_ONE => 'Active',
    VALUE_TWO => 'Deactive',
);

$config['app_type_array'] = array(
    VALUE_ONE => 'Sugam',
    VALUE_TWO => 'Sugam Admin',
);

$config['sms_type_array'] = array(
    VALUE_ONE => 'Account Verification',
    VALUE_TWO => 'Mobile OTP Verification',
    VALUE_THREE => 'Account Activation',
    VALUE_FOUR => 'Reset Password',
    VALUE_FIVE => 'Application Submission',
    VALUE_SIX => 'Query Raised',
    VALUE_SEVEN => 'Query Resolved',
    VALUE_EIGHT => 'Fees Pending',
    VALUE_NINE => 'Appointment Scheduled',
    VALUE_TEN => 'Application Approved',
    VALUE_ELEVEN => 'Application Rejected',
);
$config['ews_occupation_array'] = array(
    VALUE_ONE => 'Service',
    VALUE_TWO => 'Bussiness',
    VALUE_THREE => 'Study',
    VALUE_FOUR => 'Other',
);

$config['forward_to_array'] = array(
    VALUE_ONE => 'Talathi',
    VALUE_TWO => 'Awal Karkun / Circle Inspector',
    VALUE_THREE => 'LDC',
    VALUE_FOUR => 'Mamlatdar',
);

$config['ga_upload_doc_status_array'] = array(
    VALUE_ZERO => '<span class="badge bg-warning app-status">Document Upload Pending</span>',
    VALUE_ONE => '<span class="badge bg-warning app-status">Document Uploaded</span>',
);
