<?php

define('INVALID_ACCESS', 1);
define('INVALID_ACCESS_MESSAGE', 'Invalid Access !');

$config['invalid_access_array'] = array(
    INVALID_ACCESS => INVALID_ACCESS_MESSAGE
);

define('PASSWORD_VALIDATION_MESSAGE', '1. Password must be between 8 to 16 characters long.<br>'
        . '2. Contain at least one digit and two alphabetic character.<br>'
        . '3. At least one upper case and one lower case character.<br>'
        . '4. Contain at least one special character of (!#$@%-_+<>=).');

define('CONTACT_NIC_MESSAGE', 'Please Contact System Administrator NIC Office Daman (‪+91-7046030691‬) to Submit this Application !');
define('DATABASE_ERROR_MESSAGE', 'Some unexpected database error encountered due to which your transaction could not be complete');
define('INVALID_USER_MESSAGE', 'Invalid User !');
define('INVALID_PASSWORD_MESSAGE', 'Invalid Password !');
define('RETYPE_PASSWORD_MESSAGE', 'Retype your Password !');
define('NEW_PASSWORD_MESSAGE', 'Enter New Password !');
define('PASSWORD_AND_RETYPE_PASSWORD_NOT_MATCH_MESSAGE', 'Password and Retype password do not match !');
define('USERNAME_MESSAGE', 'Enter Username !');
define('PASSWORD_MESSAGE', 'Enter Password !');
define('USER_EXISTS_MESSAGE', 'User Already Exists !');
define('PASSWORD_POLICY_MESSAGE', 'Password entered is not as per password policy !');
define('NO_RECORD_FOUND_MESSAGE', 'No Record Found..!');
define('APPROVE_MESSAGE', 'Approved Successfully !');
define('APP_DRAFT_MESSAGE', 'Application Save as Draft Successfully  !');
define('APP_SUBMITTED_MESSAGE', 'Application Submitted Successfully  !');
define('ONE_CONTRACTOR_MESSAGE', 'Enter Atleast One Contractor Details!');
define('EMAIL_MESSAGE', 'Enter Email !');
define('INVALID_EMAIL_MESSAGE', 'Invalid Email !');
define('DATE_MESSAGE', 'Select Date !');
define('MOBILE_NUMBER_MESSAGE', 'Enter Mobile Number !');
define('INVALID_MOBILE_NUMBER_MESSAGE', 'Invalid Mobile Number !');
define('CHALLAN_UPLOADED_MESSAGE', 'Payment Details Send Successfully !');
define('PAYMENT_CONFIRMED_MESSAGE', 'Payment Confirmed Successfully !');
define('PIN_MESSAGE', 'Enter Pin !');
define('SIX_DIGIT_PIN_MESSAGE', 'Enter Proper 6 Digit Pin !');
define('INVALID_PIN_MESSAGE', 'Invalid Pin !');
define('MOBILE_NUMBER_OR_PIN_MESSAGE', 'Mobile Number or Pin is Invalid !');
define('CURRENT_PIN_VALIDATION_MESSAGE', 'Enter Current Pin !');
define('NEW_PIN_VALIDATION_MESSAGE', 'Enter New Pin !');
define('RETYPE_NEW_PIN_VALIDATION_MESSAGE', 'Retype New Pin !');
define('NOT_MATCH_PIN_VALIDATION_MESSAGE', 'New Pin and Retype Pin is Not Match !');
define('CURRENT_PIN_IS_INVALID_MESSAGE', 'Current Pin is Invalid !');
define('PIN_CHANGED_MESSAGE', 'Pin Changed Successfully !');
define('ONE_PAYMENT_OPTION_MESSAGE', 'Select One Payment Option !');
define('LICENSE_NO_NOT_AVAILABLE', 'Invalid License Number !');
define('REGISTRATION_NUMBER_EXISTS_MESSAGE', 'Registration Number Already Exists !');
define('REGISTRATION_FILE_NO_MESSAGE', 'Enter Only File No. !');
define('VILLAGE_NAME_MESSAGE', 'Enter Village Name !');
define('VER_MAIL_RESEND_MESSAGE', 'Verification Mail Re-Send Successfully !');
define('DOCUMENT_NOT_UPLOADED_ERROR_MESSAGE', 'Document Not Uploaded, Please Try After Some Time !');

//Login
define('INVALID_USERNAME_OR_PASSWORD_MESSAGE', 'Username or Password is Invalid !');
define('EMAIL_NOT_VERIFY_MESSAGE', 'Your email is not verified. Please verify your email !');
define('MOBILE_NUMBER_NOT_VERIFY_MESSAGE', 'Your mobile number is not verified. Please verify your mobile number !');
define('ACCOUNT_NOT_ACTIVE_MESSAGE', 'Permission Denied !');
define('ACCOUNT_DELETE_MESSAGE', 'Your Account is Disabled. Please contect to System Administration !');

//User Type
define('INVALID_USER_TYPE_MESSAGE', 'Invalid User Type !');
define('USER_TYPE_MESSAGE', 'Enter User Type !');
define('USER_TYPE_EXISTS_MESSAGE', 'User Type Already Exists !');
define('USER_TYPE_SAVED_MESSAGE', 'User Type Saved Successfully !');
define('USER_TYPE_UPDATED_MESSAGE', 'User Type Updated Successfully !');

//User Module
define('NAME_MESSAGE', 'Enter Name !');
define('SELECT_USER_TYPE_MESSAGE', 'Select User Type !');
define('SELECT_USER_MESSAGE', 'Select User !');
define('USER_SAVED_MESSSAGE', 'User Saved Successfully !');
define('USER_UPDATED_MESSSAGE', 'User Updated Successfully !');
define('EMAIL_UPDATED_MESSSAGE', 'Email ID Updated Successfully !');
define('EMAIL_ID_EXISTS_MESSAGE', 'Email ID Already Exists !');
define('DELETE_MESSAGE', 'User Deleted Successfully !');

//Change Password Module
define('PASSWORD_CHANGED_MESSAGE', 'Password Changed Successfully !');
define('CURRENT_NEW_PASSWORD_SAME_MESSAGE', 'Your Current Password and New Password are Same. Please Enter Another Password !');
define('INCORRECT_CURRENT_PASSWORD', 'Incorrect Current Password !');

//Query Management Module
define('REMARKS_MESSAGE', 'Enter Remarks !');
define('QUERY_RAISED_MESSAGE', 'Query Raised Successfully !');
define('QUERY_RESOLVED_MESSAGE', 'Query Resolved Successfully !');
define('DOCUMENT_NAME_MESSAGE', 'Enter Document Name !');
define('QUERY_DOCUMENT_ITEM_REMOVED_MESSAGE', 'Query Document Item Removed Successfully !');
define('APPLICATION_IN_QUERY_MESSAGE', 'Application is in Query, Please Resolve Query First !');

//incomecerty Message
define('TIME_MESSAGE', 'Select Time !');
define('INVALID_AADHAR_MESSAGE', 'Invalid Aadhar Number !');
define('SELECT_DISTRICT_MESSAGE', 'Select District !');
define('APPLICANT_NAME_MESSAGE', 'Enter Applicant Name !');
define('COMMUNICATION_ADDRESS_MESSAGE', 'Enter Address !');
define('BIRTH_DATE_MESSAGE', 'Select Birth Date !');
define('BORN_PLACE_MESSAGE', 'Enter Born Place !');
define('PROFESSION_OCCUPASSION_MESSAGE', 'Enter Profession or Occupation !');
define('MARRITIAL_STATUS_MESSAGE', 'Select Maritial Status !');
define('WIFE_HUSBD_NAME_MESSAGE', 'Enter Wife or Husband Name !');
define('WIFE_HUSB_OCCUPASSION_MESSAGE', 'Enter His/Her Profession or Occupation !');
define('FAMILY_MEMBER_MESSAGE', 'Enter Family Member !');
define('MEMBER_RELATION_MESSAGE', 'Enter Family Member Relation !');
define('MEMBER_INCOME_MESSAGE', 'Enter Family Member Income !');
define('DESC_IP_MESSAGE', 'Enter Description of Income Property !');
define('PURPOSE_OF_INCOMECERTY_MESSAGE', 'Enter Purpopse of Income Certificate !');
define('ONE_EARNING_MEMBER_MESSAGE', 'Enter Atleast One Earning Members Detail !');
define('DECLARATION_MESSAGE', 'Please Select Declaration !');
define('APP_APPROVED_MESSAGE', 'Application Approved Successfully !');
define('APP_REJECTED_MESSAGE', 'Application Rejected Successfully !');
define('APP_REVERIFY_MESSAGE', 'Application Sent to Reverification Successfully !');
define('SPOUSE_MESSAGE', 'Enter Spouse Name !');
define('OTHER_PROFESSION_MESSAGE', 'Enter Other Profession Detail !');
define('APPLICANT_NATIONALITY_MESSAGE', 'Enter Applicant Nationality !');
define('APPLICANT_AGE_MESSAGE', 'Enter Applicant Age !');
define('GENDER_MESSAGE', 'Select Gender !');
define('FATHER_NAME_MESSAGE', 'Enter Father Name !');
define('FATHER_OCCUPATION_MESSAGE', 'Enter Father Occupation !');
define('MOTHER_NAME_MESSAGE', 'Enter Mother Name !');
define('MOTHER_OCCUPATION_MESSAGE', 'Enter Mother Occupation !');
define('SPOUSE_NAME_MESSAGE', 'Enter Spouse Name !');
define('SPOUSE_OCCUPATION_MESSAGE', 'Enter Spouse Occupation !');
define('FAMILY_MEMBER_NAME_MESSAGE', 'Enter Name of Member !');
define('MEMBER_RELATIONSHIP_MESSAGE', 'Enter Relation with Applicant !');
define('MEMBER_AGE_MESSAGE', 'Enter Age of Member !');
define('MEMBER_PROFESSION_MESSAGE', 'Enter Profession !');
define('MEMBER_YEARLY_INCOME_MESSAGE', 'Enter Yearly Income !');
define('ONE_FAMILY_MEMBER_MESSAGE', 'Enter Atleast One Earning Member Details !');
define('CHILDREN_NAME_MESSAGE', 'Enter Children Name !');
define('CHILDREN_AGE_MESSAGE', 'Enter Children Age !');
define('CHILDREN_PROFESSION_MESSAGE', 'Enter Children Profession !');
define('DESCRIPTION_MESSAGE', 'Enter Description !');
define('VALUE_OF_PROPERTY_MESSAGE', 'Enter Value of property !');
define('INCOME_OF_PROPERTY_MESSAGE', 'Enter Income !');
define('SOURCE_OF_INCOME_MESSAGE', 'Enter Source of Income !');
define('AMOUNT_OF_INCOME_MESSAGE', 'Enter Amount of Income !');
define('CERTIFICATE_DETAIL_MESSAGE', 'Enter Detail of Certificate of Income which applied before !');
define('ONE_OPTION_MESSAGE', 'Select One Option !');
define('APPOINTMENT_DATE_MESSAGE', 'Select Appointment Date !');
define('APPOINTMENT_TYPE_MESSAGE', 'Select Appointment Type Option !');
define('APPOINTMENT_SET_MESSAGE', 'Appointment Set Successfully !');
define('HEARING_DATE_SET_MESSAGE', 'Hearing Date Set Successfully !');
define('JUDGEMENT_SAVE_SUCCESSFULLY', 'Judgement Save Successfully !');
define('ORDER_UPLOADED_SUCCESSFULLY', 'Order uploaded Successfully !');
define('PROPERTY_TYPE_MESSAGE', 'Select Property Type !');
define('DESCRIPTION_OF_PROPERTY_MESSAGE', 'Enter Description Of Property !');
define('OTHER_OCCUPATION_MESSAGE', 'Enter Other Occupation Detail !');
define('OTHER_PROPERTY_TYPE_MESSAGE', 'Enter Other Property Detail !');
define('OTHER_SOURCE_OF_INCOME_MESSAGE', 'Enter Other Source of Income Detail !');
define('APPLICANT_OCCUPATION_MESSAGE', 'Select Applicant Occupation !');
define('APPLICANT_YEARLY_INCOME_MESSAGE', 'Enter Applicant Yearly Income !');
define('APP_FORWARDED_MESSSAGE', 'Application Forwarded Successfully !');
define('INCOME_BY_AMOUNT_MESSAGE', 'Enter Amount !');

//Domicile Certificate
define('DISTRICT_MESSAGE', 'Select District !');
define('OCCUPATION_MESSAGE', 'Enter Occupation of Applicant !');
define('NAME_OF_HEAD_MESSAGE', 'Enter Name of the Head of the House hold !');
define('PLACE_OF_RESIDENCE_MESSAGE', 'Enter Place of Residence !');
define('HOUSE_NO_MESSAGE', 'Enter House No. !');
define('HOUSE_NAME_MESSAGE', 'Enter House Name / Building Name. !');
define('STREET_MESSAGE', 'Enter Street. !');
define('VILLAGE_WARD_MESSAGE', 'Enter Name of Village/Ward !');
define('PANCHAYAT_DMC_MESSAGE', 'Enter Name of Village Panchayat/D.M.C. !');
define('PRESENT_ADDRESS_MESSAGE', 'Enter Present Address !');
define('PERMANENT_ADDRESS_MESSAGE', 'Enter Permanent Address !');
define('RESIDE_LAST_10YEAR_MESSAGE', 'Enter Residence during last 10 year !');
define('POLICE_POST_MESSAGE', 'Enter Name of Police Station/Post Office !');
define('PLACE_RESIDE_PRIOR_MESSAGE', 'Enter Place of Business !');
define('EMPLIYED_MESSAGE', 'Enter employed where employed ! ');
define('PLACE_OF_STUDY_MESSAGE', 'Enter Place of Study');
define('RELATIONSHIP_OF_APPLICANT_MESSAGE', 'Enter Relationship with Applicant !');
define('RATION_CARD_MESSAGE', 'Enter Ration Card No./Electoral Roll No. !');
define('PROPERTY_SHEAR_MESSAGE', 'Enter Applicant or his parents has any immovable Property or Shear !');
define('PURPOSE_OF_DOMICILE_MESSAGE', 'Enter Purpose of Domicile Certificate required !');
define('AFFIDATIVE_DATE_MESSAGE', 'Enter Affidative Date !');
define('PLACE_MESSAGE', 'Enter Place !');
define('YEAR_MESSAGE', 'Enter Year !');
define('MONTH_MESSAGE', 'Enter Month !');
define('SELECT_APPLICATION_MESSAGE', 'Select Type of Application !');
define('SELECT_CITY_MESSAGE', 'Select City !');
define('ELECTION_NUMBER_MESSAGE', 'Enter Election Number !');
define('ORIGINAL_PLACE_MESSAGE', 'Enter Original From !');
define('NEAREST_POLICE_STATION_MESSAGE', 'Enter Name of nearest Police Station !');
define('NEAREST_POST_OFFICE_MESSAGE', 'Enter Name of nearest Post Office !');
define('APPLICANT_EDUCATION_MESSAGE', 'Enter Applicant Education !');
define('RESIDING_YEAR_MESSAGE', 'Enter the year from which he/she is residing in the U.T. Of Daman & Diu !');
define('ADDRESS_MESSAGE', 'Enter Address !');
define('SELECT_STATE_MESSAGE', 'Select State !');
define('SELECT_VILLAGE_MESSAGE', 'Select Village !');
define('SELECT_SURVEY_MESSAGE', 'Select Survey Number !');
define('SELECT_SUBDIV_MESSAGE', 'Select Subdiv Number !');
define('APPLICANT_RELATION_MESSAGE', 'Enter Relationship of Applicant !');
define('GUARDIAN_ADDRESS_MESSAGE', 'Enter Guardian Address !');
define('MINOR_CHILD_NAME_MESSAGE', 'Enter Minor Child Name !');
define('DECLARATION_ONE_MESSAGE', 'Please Tick !');
define('PINCODE_MESSAGE', 'Enter Pincode !');
define('VALID_PINCODE_MESSAGE', 'Enter Valid Pincode !');

define('SCHOOL_NAME_MESSAGE', 'Enter Name of School !');
define('CLASS_STANDARD_MESSAGE', 'Enter Class !');
define('TOTAL_PERIOD_MESSAGE', 'Enter Total Period !');
define('RESIDENT_TYPE_MESSAGE', 'Enter Type of Resident !');
define('RESIDENTIAL_MESSAGE', 'Enter Residential Details !');
define('BUSINESS_TYPE_MESSAGE', 'Select Type !');
define('BUSINESS_NAME_MESSAGE', 'Enter Name of Business !');
define('COMPANY_NAME_MESSAGE', 'Enter Name of Company !');
define('BUSINESS_MESSAGE', 'Enter Business Details !');
define('SERVICE_MESSAGE', 'Enter Service Details !');
define('APPOINTMENT_DATE_SELECT_MESSAGE', 'Select Valid Appointment Date !');
define('RESIDING_YEAR_NOT_VALID_MESSAGE', 'Your are not eligible for Domicile Certificate becasue of residing year is below than ten year !');
define('FUTURE_DATE_MESSAGE', 'Date of Leaving Cannot be Future Date ! Max Current Date !');

//Heirship Certificate
define('RELIGION_MESSAGE', 'Enter Religion !');
define('CASTE_MESSAGE', 'Enter Applicant Caste !');
define('RELATION_WITH_DECEASED_PERSON_MESSAGE', 'Select Relation with Deceased Person !');
define('DEATH_PERSON_NAME_MESSAGE', 'Enter Death Person Name !');
define('DEATH_PERSON_ADDRESS_MESSAGE', 'Enter Death Person Address !');
define('ONE_LEGAL_HEIRS_MESSAGE', 'Enter Atleast One family member Details !');
define('ONE_WITNESS_MESSAGE', 'Enter Atleast One Witness Details !');
define('WITNESS_NAME_MESSAGE', 'Enter Witness Name !');
define('WITNESS_AGE_MESSAGE', 'Enter Witness Age !');
define('WITNESS_ADDRESS_MESSAGE', 'Enter Witness Address !');
define('DEATH_PLACE_MESSAGE', 'Enter Death of Place !');
define('WITNESS_AGE_LIMIT_MESSAGE', 'Enter Witness, whose Age above 35  !');
define('APPLICANT_OCCUPATION_OTHER_MESSAGE', 'Enter Other Occupation !');

//Caste Certificate
define('GRANDFATHER_NAME_MESSAGE', 'Enter Grandfather Name !');
define('OCCUPATIONS_MESSAGE', 'Enter Occupation !');
define('NATIONALITY_MESSAGE', 'Enter Nationality !');
define('SUBCASTE_MESSAGE', 'Enter Subcaste !');
define('CASTES_MESSAGE', 'Select Caste !');
define('MEMBERSHIP_MESSAGE', 'Select If you have membership !');
define('DETAIL_MESSAGE', 'Enter  Detail !');
define('BEFOR_APPY_CASTECERTY_MESSAGE', 'Did You Befor Apply Certy !');
define('SELECTE_DATE_MESSAGE', 'Select  Date !');
define('NUMBER_MESSAGE', 'Enter Certificate Number !');
define('SELECT_ANY_MESSAGE', 'Select Any One !');
define('PURPOSE_MESSAGE', 'Enter Purpose of Certificate !');
define('AADHAR_MESSAGE', 'Enter Aadhar Number !');
define('ELECTION_MESSAGE', 'Enter Election Number !');

// OBC Certificate

define('ANNUAL_INCOME_MESSAGE', 'Enter Annual Income !');
define('PURPOSE_OF_OBC_MESSAGE', 'Enter Purpose of OBC Certificate required !');
define('FURNISHED_DETAIL_MESSAGE', 'Enter Furnished Detail !');
define('RELATION_MESSAGE', 'Enter Applicant Relation with Minor !');
define('FATHER_GOV_MESSAGE', 'Enter Detail of Father !');
define('MOTHER_GOV_MESSAGE', 'Enter Detail of Mother !');
define('SPOUCE_GOV_MESSAGE', 'Enter Detail of Spouce !');

// NCL Certificate
define('PERCENTAGE_OF_LAND_MESSAGE', 'Enter Percentage of Irrigated Land !');
define('IRRIGATED_AND_UNIRRIGATED_LAND_MESSAGE', 'Enter Irrigated and Un-irrigated Land !');
define('PERCENTAGE_OF_TOTAL_IRRIGATED_LAND_MESSAGE', 'Enter Percentage of Total Irrigated Land !');
define('MINOR_DETAIL', 'Enter Minor Detail !');

//ews certificate
define('FATHER_HUSB_NAME_MESSAGE', 'Enter Father / Husband Name !');
define('PANCARD_MESSAGE', 'Enter PAN Number !');
define('AGE_MESSAGE', 'Enter Age !');
define('REMARK_MESSAGE', 'Enter Remarks !');
define('POST_OFFICE_MESSAGE', 'Enter Post Office Detail !');
define('CERTIFICATE_NUMBER_MESSAGE', 'Enter Certificate Number !');
define('SALARY_INCOME_MESSAGE', 'Enter Salary Income !');
define('BUSINESS_INCOME_MESSAGE', 'Enter Business Income !');
define('AGRI_INCOME_MESSAGE', 'Enter Agriculture Income !');
define('PROFESSIONAL_INCOME_MESSAGE', 'Enter Professional Income !');
define('OTHER_INCOME_MESSAGE', 'Enter Other Income !');
define('TOTAL_INCOME_MESSAGE', 'Enter Total Income !');
define('AUTHORITY_DETAILS_MESSAGE', 'Enter Details of Issuing authority !');
define('TEHSIL_MESSAGE', 'Enter Tehsil !');
define('BORN_PERIOD_MESSAGE', 'Enter Born Period !');
define('ONE_BIRTH_STAY_PLACE_MESSAGE', 'Enter Atleast One Born Stay Period !');
define('LOCATION_MESSAGE', 'Enter Location !');
define('FINANCIAL_YEAR_MESSAGE', 'Enter Financial Year !');
define('PERMANENT_RESIDENCE_MESSAGE', 'Enter Permanent Residence !');
define('RELIGION_CAST_MESSAGE', 'Enter Religion and Cast !');

//DAPVR Case
define('SELECT_CASE_RESPONSE_TYPE', 'Select Case Response Type !');
define('SELECT_COURT', 'Select Court !');
define('SELECT_CASE_TYPE', 'Select Case Type !');
define('SELECT_CASE_YEAR', 'Select Case Year !');
define('SELECT_CASE_STATUS', 'Select Case Status !');
define('BRIEF_MATTER_MESSAGE', 'Enter Brief of matter !');
define('ROJNAMU_MESSAGE', 'Enter Rojnamu !');
define('CASE_REGISTER_DATE_MESSAGE', 'Enter Register Date !');
//define('NAME_MESSAGE', 'Enter Name !');
define('ADV_NAME_MESSAGE', 'Enter Advocate Name !');
define('ONE_LAND_MESSAGE', 'Enter Atleast One Land Details !');
define('ONE_PETITIONER_MESSAGE', 'Enter Atleast One Petitioner Details !');
define('ONE_RESPONDENT_MESSAGE', 'Enter Atleast One Respondent Details !');
define('CASE_STATUS', 'Enter Case Status Detail !');
define('HEARING_DATE_MESSAGE', 'Select Hearing Date !');
define('CASE_NO_MESSAGE', 'Enter Case Number !');
define('SELECT_ADVOCATE', 'Select Advocate !');
define('ADVOCATE_SAVE_SUCCESSFULLY', 'Advocate Detail Save Successfully !');

//arrears Update
define('OCCUPANT_NAME_MESSAGE', 'Select Occupant Name !');
define('ARREARS_MESSAGE', 'Enter Arrears !');
define('ARREARS_UPDATE_MESSAGE', 'Arrears Updated Successfully!');
define('KHATA_NUMBER_UPDATE_MESSAGE', 'Khata Number Updated Successfully !');
define('AADHAR_CARD_UPDATE_MESSAGE', 'Aadhar Card Number Updated Successfully !');
define('MOBILE_UPDATE_MESSAGE', 'Mobile Number Updated Successfully !');
define('AT_UPDATE_MESSAGE', 'Area Type Updated Successfully !');
define('LD_UPDATE_MESSAGE', 'Land Details Updated Successfully !');

define('ONE_SEARCH_MESSAGE', 'Atleast One Search Parameters is Require !');
define('ONE_USCDR_MESSAGE', 'Atleast One Upload Scanned Copies of Documents to be Registered !');
define('PARTY_NAME_MESSAGE', 'Enter Party Name !');
define('ENTER_PAN_MESSAGE', 'Enter PAN Number !');
define('INVALID_PAN_MESSAGE', 'Invalid PAN Number !');
define('PD_PRINCIPAL_MESSAGE', 'Enter Personal Details of Principal !');
define('NOT_ADV_MESSAGE', 'Enter Notarised Advocate Details !');
define('DR_BD_SAVED_MESSAGE', 'Document Registration Basic Details Saved Successfully !');
define('PPD_SAVED_MESSAGE', 'Presenting Party Details Saved Successfully !');
define('ONE_OPD_MESSAGE', 'Atleast One Other Party Details is Required !');
define('OPD_SAVED_MESSAGE', 'Other Party Details Saved Successfully !');
define('ONE_PD_MESSAGE', 'Atleast One Property Details is Required !');
define('LAND_AREA_MESSAGE', 'Enter Land Area !');
define('DR_DETAILS_UPDATED_MESSAGE', 'Document Registration Details Updated Successfully !');
define('DR_AL_VERIFIED_MESSAGE', 'Document Already Verified !');
define('DR_AL_FORWARDED_MESSAGE', 'Document Already Forwarded for Appointment !');
define('DR_APP_VERIFIED_TO_AASUBR_MESSAGE', 'Document Verified Successfully ! <br> Application Sent for Appointment Approval to Sub Registrar !');
define('DR_APP_VERIFIED_TO_USER_MESSAGE', 'Document Verified Successfully ! <br> Application Sent for Appointment to User !');
define('DR_RQ_AGE_MESSAGE', 'Please Resolve the Query !<br> After Generate a Endorsement !');
define('DR_PHOTO_BIO_PENDING_MESSAGE', 'Photo & Biometrics are Pending !');
define('DR_FEES_PENDING_MESSAGE', 'Fee Details are Pending !<br>');
define('DR_APP_LOCKED_MESSAGE', 'Application Locked Successfully !');
define('DR_APP_REJECTED_MESSAGE', 'Document Rejected Successfully !');
define('RATE_MESSAGE', 'Enter Rate !');
define('RATE_UPDATED_MESSAGE', 'Rate Updated Successfully !');
define('KHATA_NUMBER_MESSAGE', 'Enter Khata Number !');
define('SELECT_KHATA_NUMBER_MESSAGE', 'Select Khata Number !');
define('ONE_LD_MESSAGE', 'Select Atleast One Land Details !');
define('LD_PT_ZERO_MESSAGE', 'Selected Land Details Total Pending Tax is <b>0</b> !<br>Please Select Another Land Details !');
define('INVALID_PHOTO_MESSAGE', 'Invalid Photo !');
define('FEES_MESSAGE', 'Enter Fee !');
define('ONE_FEE_MESSAGE', 'Enter Atleast One Fees Details !');
define('FEES_UPDATED_MESSAGE', 'Fees Details Updated Successfully !');
define('DOCUMENT_NOT_UPLOAD_MESSAGE', 'Document Not Uploaded !');
define('DOCUMENT_LOCKED_MESSAGE', 'Document is Locked !');
define('DOCUMENT_UPLOAD_MESSAGE', 'Document Uploaded Successfully !');
define('DOCUMENT_UPLOAD_LOCKED_MESSAGE', 'Document Uploaded & Locked Successfully !');
define('PAYMENT_SUCCESSFUL_MESSAGE', 'Payment Successfully Done !');
define('HEIGHT_MESSAGE', 'Enter Height !');
define('HEIGHT_ABOVE_MESSAGE', 'Height must be 16 ft or above !');
define('ATLEAST_ONE_IDENTIFIER_MESSAGE', 'Please Add More Other Party Details / Identifier !');
define('ATLEAST_WITNESS_MESSAGE', 'Please Add More Other Party Details / Two Witness !');
define('DEPOSIT_MESSAGE', 'Enter Deposit !');
define('RENT_MESSAGE', 'Enter Rent !');
define('LYLM_MESSAGE', 'Lease Year and Lease Month Cannot be Zero !');
define('SD_PAPER_MESSAGE', 'Enter Stemp Paper Number !');
define('SD_MESSAGE', 'Enter Amount !');
define('ONE_SD_MESSAGE', 'Enter Atleast One Stamp Duty Details !');
define('PO_CHANGED_MESSAGE', 'Party Order Changed Successfully !');
define('ALL_LD_NA_MESSAGE', 'Cannot Select All Land Details to Not Available !');

//Mannual Payment
define('NOTICE_NOT_GENERATED_MESSAGE', 'Notice Not Generated !');
define('SELECT_NOTICE_NUMBER_MESSAGE', 'Select Notice Number !');
define('RECEIPT_NUMBER_DATE_MESSAGE', 'Select Receipt Number Date !');
define('RECEIPT_NUMBER_MESSAGE', 'Enter Receipt Number !');
define('POC_RECEIPT_NUMBER_DATE_MESSAGE', 'Select POC Receipt Number Date !');
define('POC_RECEIPT_NUMBER_MESSAGE', 'Enter POC Receipt Number !');
define('GENERATE_NOTICE_MESSAGE', 'No any Pending Amount in Selected Village / Survey / Sub Division !');
define('PAYMENT_PENDING_MESSAGE', 'Payment is pending !');

define('UPLOAD_DOC_MESSAGE', 'Upload Document !');
define('DOC_INVALID_SIZE_MESSAGE', 'Upload at least 1kb Size Document !');
define('UPLOAD_MAX_MB_MESSAGE', 'Maximum upload size 2 MB only.');
define('DOCUMENT_REMOVED_MESSAGE', 'Document Removed Successfully !');
define('ONE_FIELD_DOC_MESSAGE', 'Atleast One Upload Field Verification Documents !');
define('DOCUMENT_ITEM_REMOVED_MESSAGE', 'Document Item Removed Successfully !');

define('PG_DRAFT_MESSAGE', 'Pages Details Draft Successfully !');
define('PG_SUBMITTED_MESSAGE', 'Pages Details Submitted & Send For Payment Successfully !');
define('RES_NOT_REC_MESSAGE', 'Response Not Received !');

define('COPY_ALREADY_GENERATED_MESSAGE', 'Copies of Selected Survey & Subdiv Number Are Already Generated !');
define('COPY_NOT_GENERATED_MESSAGE', 'Copies of Selected Survey & Subdiv Number Are Not Generated !');
define('ROR_COPY_NOT_GENERATED_PGC_MESSAGE', 'RoR Generation Pending !<br>Please Generate RoR !');
define('ROR_NOT_FOUND_MESSAGE', 'RoR Not Generated. Please Contact Concerned Talathi !');
define('ROR_GENERATED_MESSAGE', 'RoR Generated Successfully !');

define('SP_COPY_ALREADY_GENERATED_MESSAGE', 'Copies of Selected (P.T. Sheet / Gauthan Wise) / (Chalta / Plot) Are Already Generated !');
define('SP_COPY_NOT_GENERATED_PGC_MESSAGE', 'Site Plan Copy Generation Pending !<br>Please Upload Site Plan and Generate Copy !');
define('SP_COPY_NOT_GENERATED_MESSAGE', 'Site Plan Copies Are Not Generated !');
define('SP_COPY_GENERATED_MESSAGE', 'Site Plan Copy Generated Successfully !');
define('SP_COPY_REGENERATED_MESSAGE', 'Site Plan Copy Re-Generated Successfully !');
define('SP_DETAILS_AL_VERIFIED_MESSAGE', 'Site Plan Details Already Scrutinized !');
define('SP_APP_VERIFIED_TO_USER_MESSAGE', 'Site Plan Details Scrutinized Successfully ! <br> Application Sent for Payment to User !');
define('SP_DETAILS_NOT_PREPARED_MESSAGE', 'Site Plan Not Prepared <br> Please Prepare First !!');
define('SP_DETAILS_PREPARED_MESSAGE', 'Site Plan Prepared Successfully !');
define('SP_DETAILS_AL_PREPARED_MESSAGE', 'Site Plan Details Already Prepared !');
define('SP_DETAILS_NOT_CHECKED_MESSAGE', 'Site Plan Not Checked <br> Please Check First !!');
define('SP_DETAILS_CHECKED_MESSAGE', 'Site Plan Checked Successfully !');
define('SP_DETAILS_AL_CHECKED_MESSAGE', 'Site Plan Details Already Checked !');

define('SP_FDB_NOT_FOUND_MESSAGE', ' Not Generated. Please Contact the EOCS Office !');
define('SP_FDB_COPY_NOT_GENERATED_MESSAGE', ' Copies Are Not Generated !');
define('SP_FDB_GENERATED_MESSAGE', ' Generated Successfully !');
define('SP_FDB_REGENERATED_MESSAGE', ' Re-Generated Successfully !');
define('FDB_DETAILS_AL_VERIFIED_MESSAGE', 'Property Card Details Already Scrutinized !');
define('FDB_APP_VERIFIED_TO_USER_MESSAGE', 'Property Card Details Scrutinized Successfully ! <br> Application Sent for Payment to User !');
define('FDB_DETAILS_AL_CHECKED_MESSAGE', 'Property Card Details Already Checked !');
define('FDB_DETAILS_CHECKED_MESSAGE', 'Property Card Details Checked Successfully !');

define('SROR_DETAILS_AL_CHECKED_MESSAGE', 'Svamitva RoR Details Already Checked !');
define('SROR_DETAILS_CHECKED_MESSAGE', 'Svamitva RoR Details Checked Successfully !');

define('PC_COPY_NOT_GENERATED_PGC_MESSAGE', 'Property Card Generation Pending !<br>Please Generate Property Card !');
define('PC_GENERATED_MESSAGE', 'Property Card Generated Successfully !');

define('FEES_PENDING_EMAIL_MESSAGE', 'Mail Send Successfully !');

///payment

define('PH_NOT_AVAILABLE_MESSAGE', 'Payment History Not Available !');
define('PG_NOT_AVAILABLE_MESSAGE', 'Online Payment is Under Maintenance !<br>Please Try Another Payment Type !');
define('PG_DOWN_AVAILABLE_MESSAGE', 'SBI Online Payment Gateway is Down !<br>Please Try After 5 to 10 Minutes !');
define('PG_PS_UPDATED_TA_MESSAGE', 'Latest Payment Status Updated Successfully !<br>Please Try After 5 to 10 Minutes !');
define('PG_PS_UPDATED_MESSAGE', 'Latest Payment Status Updated Successfully !');

//Department Messages
define('DEPARTMENT_MESSAGE', 'Enter Department Name !');
define('SELECT_DEPARTMENT_MESSAGE', 'Select Department !');
define('INVALID_DEPARTMENT_MESSAGE', 'Invalid Department !');
define('DEPARTMENT_EXISTS_MESSAGE', 'Department Name Already Exists !');
define('DEPARTMENT_SAVED_MESSAGE', 'Department Saved Successfully !');
define('DEPARTMENT_UPDATED_MESSAGE', 'Department Updated Successfully !');

//Service Messages
define('SERVICE_NAME_MESSAGE', 'Enter Name of Service/Clearance !');
define('INVALID_SERVICE_MESSAGE', 'Invalid Service !');
define('SERVICE_SUBMITTED_MESSAGE', 'Service Details Submitted Successfully !');
define('ENTER_TIMELINE_MESSAGE', 'Enter Timeline (Working Days) !');
define('ENTER_QUESTION_MESSAGE', 'Enter Question !');

//Marriage Certificate
define('MARRIAGE_NO_MESSAGE', 'Enter Marriage No. !');
define('RESIDENCE_OF_MESSAGE', 'Enter residence of !');
define('DECLARATION_SAVE_MESSAGE', 'Declaration Save Successfully !');
define('WITNESS_SAVE_MESSAGE', 'Witness Save Successfully !');
define('TWO_WITNESS_MESSAGE', 'Enter Atleast Two Witness Details !');
define('APP_LOCK_MESSAGE', 'Application Lock Sucessfully !');
define('PAGE_NO_MESSAGE', 'Enter Page No. !');
define('ENTRY_NUMBER_MESSAGE', 'AEnter Entry Number !');
define('REGISTRATION_YEAR_MESSAGE', 'Enter Registration Year !');

// Birth Certificate
define('REGISTRATION_NUMBER_MESSAGE', 'Enter Registration Number !');
define('DATE_YEAR_MESSAGE', 'Select Date Or Year of Registration !');
define('REGISTRATION_DATE_MESSAGE', 'Enter Registration Date !');
define('PURPOSE_FOR_BIRTH_CERTIFICATE_MESSAGE', 'Enter Purpose For Birth Certificate !');
define('APPLYING_FOR_CERTIFICATE_MESSAGE', 'Select Applying For !');
define('OTHER_RELATIONSHIP_MESSAGE', 'Enter Other Relationship With Applicant !');

//Death Certificate
define('DEATH_DATE_MESSAGE', 'Select Death Date !');
define('RELATION_STATUS_MESSAGE', 'Select Relationship With Applicant !');
define('PURPOSE_FOR_DEATH_CERTIFICATE_MESSAGE', 'Enter Purpose For Death Certificate !');

// Landtax Agriculture
define('SURVEY_NUMBER_MESSAGE', 'Enter Survey Number !');
define('AMOUNT_MESSAGE', 'Enter Amount !');
define('ARREAS_MESSAGE', 'Enter Arreas !');
define('DATA_UPDATE_MESSAGE', 'Landtax Agriculture Data Updated Successfully !');

//general Application
define('REPORT_MESSAGE', 'Enter Report !');
define('SUBJECT_MESSAGE', 'Enter Subject !');
define('AUTHORITY_MESSAGE', 'Enter Authority !');
define('REFERENCE_MESSAGE', 'Enter Reference !');
define('COPYTO_MESSAGE', 'Enter Copy To !');

