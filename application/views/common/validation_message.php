<script type="text/javascript">
    var baseUrl = '<?php echo base_url(); ?>';
    var invalidAccessValidationMessage = '<?php echo INVALID_ACCESS_MESSAGE ?>';
    var passwordPolicyValidationMessage = '<?php echo PASSWORD_POLICY_MESSAGE ?>';
    var passwordAndRetypePasswordValidationMessage = '<?php echo PASSWORD_AND_RETYPE_PASSWORD_NOT_MATCH_MESSAGE; ?>';
    var noRecordFoundMessage = '<?php echo NO_RECORD_FOUND_MESSAGE; ?>';
    var emailValidationMessage = '<?php echo EMAIL_MESSAGE; ?>';
    var invalidEmailValidationMessage = '<?php echo INVALID_EMAIL_MESSAGE; ?>';
    var dateValidationMessage = '<?php echo DATE_MESSAGE; ?>';
    var mobileValidationMessage = '<?php echo MOBILE_NUMBER_MESSAGE; ?>';
    var invalidMobileValidationMessage = '<?php echo INVALID_MOBILE_NUMBER_MESSAGE; ?>';
    var pinValidationMessage = '<?php echo PIN_MESSAGE; ?>';
    var sixDigitPinValidationMessage = '<?php echo SIX_DIGIT_PIN_MESSAGE; ?>';
    var invalidPinValidationMessage = '<?php echo INVALID_PIN_MESSAGE; ?>';
    var currentPinValidationMessage = '<?php echo CURRENT_PIN_VALIDATION_MESSAGE; ?>';
    var newPinValidationMessage = '<?php echo NEW_PIN_VALIDATION_MESSAGE; ?>';
    var retypeNewPinValidationMessage = '<?php echo RETYPE_NEW_PIN_VALIDATION_MESSAGE; ?>';
    var notMatchPinValidationMessage = '<?php echo NOT_MATCH_PIN_VALIDATION_MESSAGE; ?>';
    var onePaymentOptionValidationMessage = '<?php echo ONE_PAYMENT_OPTION_MESSAGE; ?>';
    var licenseNoNotAvailable = '<?php echo LICENSE_NO_NOT_AVAILABLE; ?>';
    var registrationNumberExistsValidationMessage = '<?php echo REGISTRATION_NUMBER_EXISTS_MESSAGE; ?>';
    var registrationFileNoValidationMessage = '<?php echo REGISTRATION_FILE_NO_MESSAGE; ?>';
    var villageNameValidationMessage = '<?php echo VILLAGE_NAME_MESSAGE; ?>';
    var khataNumberValidationMessage = '<?php echo KHATA_NUMBER_MESSAGE; ?>';
    var oneSearchValidationMessage = '<?php echo ONE_SEARCH_MESSAGE; ?>';
    var aadharNumberValidationMessage = '<?php echo AADHAR_MESSAGE; ?>';
    var documentNotUploadedErrorValidationMessage = '<?php echo DOCUMENT_NOT_UPLOADED_ERROR_MESSAGE; ?>';

    // Login Messages
    var passwordRegex = <?php echo PASSWORD_REGEX ?>;
    var usernameValidationMessage = '<?php echo USERNAME_MESSAGE; ?>';
    var passwordValidationMessage = '<?php echo PASSWORD_MESSAGE; ?>';
    var newPasswordValidationMessage = '<?php echo NEW_PASSWORD_MESSAGE; ?>';
    var invalidPasswordValidationMessage = '<?php echo INVALID_PASSWORD_MESSAGE; ?>';
    var retypePasswordValidationMessage = '<?php echo RETYPE_PASSWORD_MESSAGE; ?>';
    var usernameOrPasswordIsInvalid = '<?php echo INVALID_USERNAME_OR_PASSWORD_MESSAGE; ?>';

    // User Type Messages
    var invalidUserTypeValidationMessage = '<?php echo INVALID_USER_TYPE_MESSAGE; ?>';
    var userTypeValidationMessage = '<?php echo USER_TYPE_MESSAGE; ?>';

    // Users Messages
    var nameValidationMessage = '<?php echo NAME_MESSAGE; ?>';
    var selectUserTypeValidationMessage = '<?php echo SELECT_USER_TYPE_MESSAGE; ?>';
    var selectUserValidationMessage = '<?php echo SELECT_USER_MESSAGE; ?>';
    var invalidUserValidationMessage = '<?php echo INVALID_USER_MESSAGE; ?>';

    // Query Mananagemt Module
    var remarksValidationMessage = '<?php echo REMARKS_MESSAGE; ?>';
    var documentNameValidationMessage = '<?php echo DOCUMENT_NAME_MESSAGE; ?>';

    //Income Certificate Message
    var timeValidationMessage = '<?php echo TIME_MESSAGE; ?>';
    var selectDistrictValidationMessage = '<?php echo SELECT_DISTRICT_MESSAGE; ?>';
    var invalidAadharNumberValidationMessage = '<?php echo INVALID_AADHAR_MESSAGE; ?>';
    var applicantNameValidationMessage = '<?php echo APPLICANT_NAME_MESSAGE; ?>';
    var communicationAddressValidationMessage = '<?php echo COMMUNICATION_ADDRESS_MESSAGE; ?>';
    var birthDateValidationMessage = '<?php echo BIRTH_DATE_MESSAGE; ?>';
    var applicantBornPlaceValidationMessage = '<?php echo BORN_PLACE_MESSAGE; ?>';
    var professionOccupationValidationMessage = '<?php echo PROFESSION_OCCUPASSION_MESSAGE; ?>';
    var wifeHusbandNameValidationMessage = '<?php echo WIFE_HUSBD_NAME_MESSAGE; ?>';
    var wifHusbprofessionOccupationValidationMessage = '<?php echo WIFE_HUSB_OCCUPASSION_MESSAGE; ?>';
    var familyMembernoValidationMessage = '<?php echo FAMILY_MEMBER_MESSAGE; ?>';
    var memberRelationValidationMessage = '<?php echo MEMBER_RELATION_MESSAGE; ?>';
    var memberIncomeValidationMessage = '<?php echo MEMBER_INCOME_MESSAGE; ?>';
    var descIPValidationMessage = '<?php echo DESC_IP_MESSAGE; ?>';
    var purposeOfIncomeCertyValidationMessage = '<?php echo PURPOSE_OF_INCOMECERTY_MESSAGE; ?>';
    var oneEarningMemberValidationMessage = '<?php echo ONE_EARNING_MEMBER_MESSAGE; ?>';
    var declarationValidationMessage = '<?php echo DECLARATION_MESSAGE; ?>';
    var spouseNameValidationMessage = '<?php echo SPOUSE_MESSAGE; ?>';
    var otherProfessionValidationMessage = '<?php echo OTHER_PROFESSION_MESSAGE; ?>';
    var applicantNationalityValidationMessage = '<?php echo APPLICANT_NATIONALITY_MESSAGE; ?>';
    var applicantAgeValidationMessage = '<?php echo APPLICANT_AGE_MESSAGE; ?>';
    var genderValidationMessage = '<?php echo GENDER_MESSAGE; ?>';
    var maritalStatusValidationMessage = '<?php echo MARRITIAL_STATUS_MESSAGE; ?>';
    var fatherNameValidationMessage = '<?php echo FATHER_NAME_MESSAGE; ?>';
    var fatherOccupationValidationMessage = '<?php echo FATHER_OCCUPATION_MESSAGE; ?>';
    var motherNameValidationMessage = '<?php echo MOTHER_NAME_MESSAGE; ?>';
    var motherOccupationValidationMessage = '<?php echo MOTHER_OCCUPATION_MESSAGE; ?>';
    var spouseNameValidationMessage = '<?php echo SPOUSE_NAME_MESSAGE; ?>';
    var spouseOccupationValidationMessage = '<?php echo SPOUSE_OCCUPATION_MESSAGE; ?>';
    var familyMemberNameValidationMessage = '<?php echo FAMILY_MEMBER_NAME_MESSAGE; ?>';
    var memberRelationValidationMessage = '<?php echo MEMBER_RELATIONSHIP_MESSAGE; ?>';
    var memberAgeValidationMessage = '<?php echo MEMBER_AGE_MESSAGE; ?>';
    var professionValidationMessage = '<?php echo MEMBER_PROFESSION_MESSAGE; ?>';
    var yearlyIncomeValidationMessage = '<?php echo MEMBER_YEARLY_INCOME_MESSAGE; ?>';
    var childrenNameValidationMessage = '<?php echo CHILDREN_NAME_MESSAGE; ?>';
    var childrenAgeValidationMessage = '<?php echo CHILDREN_AGE_MESSAGE; ?>';
    var childrenProfessionValidationMessage = '<?php echo CHILDREN_PROFESSION_MESSAGE; ?>';
    var descriptionValidationMessage = '<?php echo DESCRIPTION_MESSAGE; ?>';
    var valueOfPropertyValidationMessage = '<?php echo VALUE_OF_PROPERTY_MESSAGE; ?>';
    var incomeOfPropertyValidationMessage = '<?php echo INCOME_OF_PROPERTY_MESSAGE; ?>';
    var sourceOfIncomeValidationMessage = '<?php echo SOURCE_OF_INCOME_MESSAGE; ?>';
    var amountOfOtherIncomeValidationMessage = '<?php echo AMOUNT_OF_INCOME_MESSAGE; ?>';
    var certificateDetailValidationMessage = '<?php echo CERTIFICATE_DETAIL_MESSAGE; ?>';
    var oneOptionValidationMessage = '<?php echo ONE_OPTION_MESSAGE; ?>';
    var appointmentDateValidationMessage = '<?php echo APPOINTMENT_DATE_MESSAGE; ?>';
    var appointmentTypeValidationMessage = '<?php echo APPOINTMENT_TYPE_MESSAGE; ?>';
    var propertyTypeValidationMessage = '<?php echo PROPERTY_TYPE_MESSAGE; ?>';
    var descriptionOfPropertyValidationMessage = '<?php echo DESCRIPTION_OF_PROPERTY_MESSAGE; ?>';
    var otherOccupationValidationMessage = '<?php echo OTHER_OCCUPATION_MESSAGE; ?>';
    var otherPropertyTypeValidationMessage = '<?php echo OTHER_PROPERTY_TYPE_MESSAGE; ?>';
    var otherSourceOfIncomeValidationMessage = '<?php echo OTHER_SOURCE_OF_INCOME_MESSAGE; ?>';
    var applicantOccupationValidationMessage = '<?php echo APPLICANT_OCCUPATION_MESSAGE; ?>';
    var applicantYearlyIncomeValidationMessage = '<?php echo APPLICANT_YEARLY_INCOME_MESSAGE; ?>';
    var incomeByAmountValidationMessage = '<?php echo INCOME_BY_AMOUNT_MESSAGE; ?>';

    //Domicile Certificate
    var districtValidationMessage = '<?php echo DISTRICT_MESSAGE; ?>';
    var occupationValidationMessage = '<?php echo OCCUPATION_MESSAGE; ?>';
    var nameofheadValidationMessage = '<?php echo NAME_OF_HEAD_MESSAGE; ?>';
    var placeofresidenceValidationMessage = '<?php echo PLACE_OF_RESIDENCE_MESSAGE; ?>';
    var houseNoValidationMessage = '<?php echo HOUSE_NO_MESSAGE; ?>';
    var houseNameValidationMessage = '<?php echo HOUSE_NAME_MESSAGE; ?>';
    var streetValidationMessage = '<?php echo STREET_MESSAGE; ?>';
    var villagewardValidationMessage = '<?php echo VILLAGE_WARD_MESSAGE; ?>';
    var panchayatOrDmcValidationMessage = '<?php echo PANCHAYAT_DMC_MESSAGE; ?>';
    var presentAddressValidationMessage = '<?php echo PRESENT_ADDRESS_MESSAGE; ?>';
    var permanentAddressValidationMessage = '<?php echo PERMANENT_ADDRESS_MESSAGE; ?>';
    var residelast10yearValidationMessage = '<?php echo RESIDE_LAST_10YEAR_MESSAGE; ?>';
    var policeandPostValidationMessage = '<?php echo POLICE_POST_MESSAGE; ?>';
    var placeresidePriorValidationMessage = '<?php echo PLACE_RESIDE_PRIOR_MESSAGE; ?>';
    var employedValidationMessage = '<?php echo EMPLIYED_MESSAGE; ?>';
    var placeofStudyValidationMessage = '<?php echo PLACE_OF_STUDY_MESSAGE; ?>';
    var relationshipofApplicantValidationMessage = '<?php echo RELATIONSHIP_OF_APPLICANT_MESSAGE; ?>';
    var rationcardNoValidationMessage = '<?php echo RATION_CARD_MESSAGE; ?>';
    var propertyorShearValidationMessage = '<?php echo PROPERTY_SHEAR_MESSAGE; ?>';
    var purposeofDomicileValidationMessage = '<?php echo PURPOSE_OF_DOMICILE_MESSAGE; ?>';
    var affidativeDateValidationMessage = '<?php echo AFFIDATIVE_DATE_MESSAGE; ?>';
    var placeValidationMessage = '<?php echo PLACE_MESSAGE; ?>';
    var yearValidationMessage = '<?php echo YEAR_MESSAGE; ?>';
    var monthValidationMessage = '<?php echo MONTH_MESSAGE; ?>';
    var selectApplicationValidationMessage = '<?php echo SELECT_APPLICATION_MESSAGE; ?>';
    var declarationValidationMessage = '<?php echo DECLARATION_MESSAGE; ?>';
    var selectCityValidationMessage = '<?php echo SELECT_CITY_MESSAGE; ?>';
    var electionNumberValidationMessage = '<?php echo ELECTION_NUMBER_MESSAGE; ?>';
    var applicantOriginalPlaceValidationMessage = '<?php echo ORIGINAL_PLACE_MESSAGE; ?>';
    var nearestPoliceStationValidationMessage = '<?php echo NEAREST_POLICE_STATION_MESSAGE; ?>';
    var nearestPostOfficeValidationMessage = '<?php echo NEAREST_POST_OFFICE_MESSAGE; ?>';
    var applicantEducationValidationMessage = '<?php echo APPLICANT_EDUCATION_MESSAGE; ?>';
    var residingYearValidationMessage = '<?php echo RESIDING_YEAR_MESSAGE; ?>';
    var addressValidationMessage = '<?php echo ADDRESS_MESSAGE; ?>';
    var selectStateValidationMessage = '<?php echo SELECT_STATE_MESSAGE; ?>';
    var selectVillageValidationMessage = '<?php echo SELECT_VILLAGE_MESSAGE; ?>';
    var selectSurveyValidationMessage = '<?php echo SELECT_SURVEY_MESSAGE; ?>';
    var selectSubdivValidationMessage = '<?php echo SELECT_SUBDIV_MESSAGE; ?>';
    var applicantRelationshipValidationMessage = '<?php echo APPLICANT_RELATION_MESSAGE; ?>';
    var guardianAddressValidationMessage = '<?php echo GUARDIAN_ADDRESS_MESSAGE; ?>';
    var minorChildNameValidationMessage = '<?php echo MINOR_CHILD_NAME_MESSAGE; ?>';
    var declarationOneValidationMessage = '<?php echo DECLARATION_ONE_MESSAGE; ?>';
    var pincodeValidationMessage = '<?php echo PINCODE_MESSAGE; ?>';
    var validPincodeValidationMessage = '<?php echo VALID_PINCODE_MESSAGE; ?>';
    var allLDNAValidationMessage = '<?php echo ALL_LD_NA_MESSAGE; ?>';

    var schoolNameValidationMessage = '<?php echo SCHOOL_NAME_MESSAGE; ?>';
    var classStandardValidationMessage = '<?php echo CLASS_STANDARD_MESSAGE; ?>';
    var totalPeriodValidationMessage = '<?php echo TOTAL_PERIOD_MESSAGE; ?>';
    var residentTypeValidationMessage = '<?php echo RESIDENT_TYPE_MESSAGE; ?>';
    var businessTypeValidationMessage = '<?php echo BUSINESS_TYPE_MESSAGE; ?>';
    var businessNameValidationMessage = '<?php echo BUSINESS_NAME_MESSAGE; ?>';
    var companyNameValidationMessage = '<?php echo COMPANY_NAME_MESSAGE; ?>';
    var appointmentDateSelectValidationMessage = '<?php echo APPOINTMENT_DATE_SELECT_MESSAGE; ?>';
    var residingYearNotValidValidationMessage = '<?php echo RESIDING_YEAR_NOT_VALID_MESSAGE; ?>';
    var futureDateValidationMessage = '<?php echo FUTURE_DATE_MESSAGE; ?>';

    //Heirship Certificate
    var religionValidationMessage = '<?php echo RELIGION_MESSAGE; ?>';
    var casteValidationMessage = '<?php echo CASTE_MESSAGE; ?>';
    var relationWithDeceasedPersonValidationMessage = '<?php echo RELATION_WITH_DECEASED_PERSON_MESSAGE; ?>';
    var deathPersonNameValidationMessage = '<?php echo DEATH_PERSON_NAME_MESSAGE; ?>';
    var deathPersonAddressValidationMessage = '<?php echo DEATH_PERSON_ADDRESS_MESSAGE; ?>';
    var oneLegalHeirsValidationMessage = '<?php echo ONE_LEGAL_HEIRS_MESSAGE; ?>';
    var witnessNameValidationMessage = '<?php echo WITNESS_NAME_MESSAGE; ?>';
    var witnessAgeValidationMessage = '<?php echo WITNESS_AGE_MESSAGE; ?>';
    var witnessAddressValidationMessage = '<?php echo WITNESS_ADDRESS_MESSAGE; ?>';
    var oneWitnessValidationMessage = '<?php echo ONE_WITNESS_MESSAGE; ?>';
    var deathOfPlaceValidationMessage = '<?php echo DEATH_PLACE_MESSAGE; ?>';
    var witnessAgeLimitValidationMessage = '<?php echo WITNESS_AGE_LIMIT_MESSAGE; ?>';
    var otherOccupationValidationMessage = '<?php echo APPLICANT_OCCUPATION_OTHER_MESSAGE; ?>';

    //Caste Certificate
    var grandfatherValidationMessage = '<?php echo GRANDFATHER_NAME_MESSAGE; ?>';
    var occupationValidationMessage = '<?php echo OCCUPATIONS_MESSAGE; ?>';
    var nationalityValidationMessage = '<?php echo NATIONALITY_MESSAGE; ?>';
    var subcasteValidationMessage = '<?php echo SUBCASTE_MESSAGE; ?>';
    var castesValidationMessage = '<?php echo CASTES_MESSAGE; ?>';
    var detailValidationMessage = '<?php echo DETAIL_MESSAGE; ?>';
    var dateslectValidationMessage = '<?php echo SELECTE_DATE_MESSAGE; ?>';
    var numberValidationMessage = '<?php echo NUMBER_MESSAGE; ?>';
    var selectanyoneValidationMessage = '<?php echo SELECT_ANY_MESSAGE; ?>';
    var purposeValidationMessage = '<?php echo PURPOSE_MESSAGE; ?>';
    var aadharValidationMessage = '<?php echo AADHAR_MESSAGE; ?>';
    var electionValidationMessage = '<?php echo ELECTION_MESSAGE; ?>';

    // OBC Certificate
    var annualIncomeValidationMessage = '<?php echo ANNUAL_INCOME_MESSAGE; ?>';
    var purposeofobcCertificateValidationMessage = '<?php echo PURPOSE_OF_OBC_MESSAGE; ?>';
    var furnishedDetailValidationMessage = '<?php echo FURNISHED_DETAIL_MESSAGE; ?>';
    var applicantRelationValidationMessage = '<?php echo RELATION_MESSAGE; ?>';
    var fathergovDetailsValidationMessage = '<?php echo FATHER_GOV_MESSAGE; ?>';
    var mothergovDetailsValidationMessage = '<?php echo MOTHER_GOV_MESSAGE; ?>';
    var spoucegovDetailValidationMessage = '<?php echo SPOUCE_GOV_MESSAGE; ?>';

    // NCL Certificate
    var percentageofirrigatedlandValidationMessage = '<?php echo PERCENTAGE_OF_LAND_MESSAGE; ?>';
    var irrigatedandunirrigatedlandValidationMessage = '<?php echo IRRIGATED_AND_UNIRRIGATED_LAND_MESSAGE; ?>';
    var percentageoftotalirrigatedlandValidationMessage = '<?php echo PERCENTAGE_OF_TOTAL_IRRIGATED_LAND_MESSAGE; ?>';
    var minorDetailValidationMessage = '<?php echo MINOR_DETAIL; ?>';

    //ews Certificate
    var applicantFatherHusbNameValidationMessage = '<?php echo FATHER_HUSB_NAME_MESSAGE; ?>';
    var bornPlaceValidationMessage = '<?php echo BORN_PLACE_MESSAGE; ?>';
    var casteValidationMessage = '<?php echo CASTE_MESSAGE; ?>';
    var pancardValidationMessage = '<?php echo PANCARD_MESSAGE; ?>';
    var nameValidationMessage = '<?php echo NAME_MESSAGE; ?>';
    var ageValidationMessage = '<?php echo AGE_MESSAGE; ?>';
    var occupationValidationMessage = '<?php echo OCCUPATION_MESSAGE; ?>';
    var remarkValidationMessage = '<?php echo REMARK_MESSAGE; ?>';
    var postOfficeValidationMessage = '<?php echo POST_OFFICE_MESSAGE; ?>';
    var certyNoValidationMessage = '<?php echo CERTIFICATE_NUMBER_MESSAGE; ?>';
    var salaryIncomeValidationMessage = '<?php echo SALARY_INCOME_MESSAGE; ?>';
    var businessIncomeValidationMessage = '<?php echo BUSINESS_INCOME_MESSAGE; ?>';
    var agriIncomeValidationMessage = '<?php echo AGRI_INCOME_MESSAGE; ?>';
    var professionalIncomeValidationMessage = '<?php echo PROFESSIONAL_INCOME_MESSAGE; ?>';
    var otherIncomeValidationMessage = '<?php echo OTHER_INCOME_MESSAGE; ?>';
    var totalIncomeValidationMessage = '<?php echo TOTAL_INCOME_MESSAGE; ?>';
    var authorityDetailsValidationMessage = '<?php echo AUTHORITY_DETAILS_MESSAGE; ?>';
    var tehsilValidationMessage = '<?php echo TEHSIL_MESSAGE; ?>';
    var bornPeriodValidationMessage = '<?php echo BORN_PERIOD_MESSAGE; ?>';
    var locationValidationMessage = '<?php echo LOCATION_MESSAGE; ?>';
    var financialYearValidationMessage = '<?php echo FINANCIAL_YEAR_MESSAGE; ?>';
    var permanentResidenceValidationMessage = '<?php echo PERMANENT_RESIDENCE_MESSAGE; ?>';
    var religionCastValidationMessage = '<?php echo RELIGION_CAST_MESSAGE; ?>';

    // DAPVR Case
    var selectcaseresponsetypeValidationMessage = '<?php echo SELECT_CASE_RESPONSE_TYPE; ?>';
    var selectcasetypeValidationMessage = '<?php echo SELECT_CASE_TYPE; ?>';
    var selectcaseyearValidationMessage = '<?php echo SELECT_CASE_YEAR; ?>';
    var matterValidationMessage = '<?php echo BRIEF_MATTER_MESSAGE; ?>';
    var rojnamuValidationMessage = '<?php echo ROJNAMU_MESSAGE; ?>';
    var caseregisterdateValidationMessage = '<?php echo CASE_REGISTER_DATE_MESSAGE; ?>';
    var nameValidationMessage = '<?php echo NAME_MESSAGE; ?>';
    var advnameValidationMessage = '<?php echo ADV_NAME_MESSAGE; ?>';
    var oneLandValidationMessage = '<?php echo ONE_LAND_MESSAGE; ?>';
    var onePetitionerValidationMessage = '<?php echo ONE_PETITIONER_MESSAGE; ?>';
    var onerespondentValidationMessage = '<?php echo ONE_RESPONDENT_MESSAGE; ?>';
    var selectcasestatusValidationMessage = '<?php echo SELECT_CASE_STATUS; ?>';
    var HearingDateValidationMessage = '<?php echo HEARING_DATE_MESSAGE; ?>';
    var selectadvocateValidationMessage = '<?php echo SELECT_ADVOCATE; ?>';

    //arrears Update
    var occupantNameValidationMessage = '<?php echo OCCUPANT_NAME_MESSAGE; ?>';
    var CaseNoValidationMessage = '<?php echo CASE_NO_MESSAGE; ?>';
    var oneUSCDRValidationMessage = '<?php echo ONE_USCDR_MESSAGE; ?>';
    var partyNameValidationMessage = '<?php echo PARTY_NAME_MESSAGE; ?>';
    var enterPANValidationMessage = '<?php echo ENTER_PAN_MESSAGE; ?>';
    var invalidPANValidationMessage = '<?php echo INVALID_PAN_MESSAGE; ?>';
    var pdPrincipalValidationMessage = '<?php echo PD_PRINCIPAL_MESSAGE; ?>';
    var notADVValidationMessage = '<?php echo NOT_ADV_MESSAGE; ?>';
    var oneOPDValidationMessage = '<?php echo ONE_OPD_MESSAGE; ?>';
    var onePDValidationMessage = '<?php echo ONE_PD_MESSAGE; ?>';
    var landAreaValidationMessage = '<?php echo LAND_AREA_MESSAGE; ?>';
    var rateValidationMessage = '<?php echo RATE_MESSAGE; ?>';
    var oneFeeValidationMessage = '<?php echo ONE_FEE_MESSAGE; ?>';
    var feesValidationMessage = '<?php echo FEES_MESSAGE; ?>';
    var oneLDValidationMessage = '<?php echo ONE_LD_MESSAGE; ?>';
    var ldPTZeroValidationMessage = '<?php echo LD_PT_ZERO_MESSAGE; ?>';

    //Mannual Payment
    var selectNoticeNumberValidationMessage = '<?php echo SELECT_NOTICE_NUMBER_MESSAGE; ?>';
    var receiptNumberDateValidationMessage = '<?php echo RECEIPT_NUMBER_DATE_MESSAGE; ?>';
    var receiptNumberValidationMessage = '<?php echo RECEIPT_NUMBER_MESSAGE; ?>';
    var pocReceiptNumberDateValidationMessage = '<?php echo POC_RECEIPT_NUMBER_DATE_MESSAGE; ?>';
    var pocReceiptNumberValidationMessage = '<?php echo POC_RECEIPT_NUMBER_MESSAGE; ?>';
    var generateNoticeValidationMessage = '<?php echo GENERATE_NOTICE_MESSAGE; ?>';
    var paymentPendingValidationMessage = '<?php echo PAYMENT_PENDING_MESSAGE; ?>';

    //Document Registration
    var heightValidationMessage = '<?php echo HEIGHT_MESSAGE; ?>';
    var heightAboveValidationMessage = '<?php echo HEIGHT_ABOVE_MESSAGE; ?>';
    var oneIdeValidationMessage = '<?php echo ATLEAST_ONE_IDENTIFIER_MESSAGE; ?>';
    var atWitnessValidationMessage = '<?php echo ATLEAST_WITNESS_MESSAGE; ?>';
    var sdPaperValidationMessage = '<?php echo SD_PAPER_MESSAGE; ?>';
    var sdValidationMessage = '<?php echo SD_MESSAGE; ?>';
    var oneSDValidationMessage = '<?php echo ONE_SD_MESSAGE; ?>';
    var depositValidationMessage = '<?php echo DEPOSIT_MESSAGE; ?>';
    var rentValidationMessage = '<?php echo RENT_MESSAGE; ?>';
    var lylmValidationMessage = '<?php echo LYLM_MESSAGE; ?>';


    var oneFieldDocValidationMessage = '<?php echo ONE_FIELD_DOC_MESSAGE; ?>';
    var uploadDocValidationMessage = '<?php echo UPLOAD_DOC_MESSAGE; ?>';

    // Department Messages
    var departmentValidationMessage = '<?php echo DEPARTMENT_MESSAGE; ?>';
    var selectDepartmentValidationMessage = '<?php echo SELECT_DEPARTMENT_MESSAGE; ?>';
    var invalidDepartmentValidationMessage = '<?php echo INVALID_DEPARTMENT_MESSAGE; ?>';

    // Services Messages
    var serviceNameValidationMessage = '<?php echo SERVICE_NAME_MESSAGE; ?>';
    var invalidServiceValidationMessage = '<?php echo INVALID_SERVICE_MESSAGE; ?>';
    var enterTimelineValidationMessage = '<?php echo ENTER_TIMELINE_MESSAGE; ?>';
    var enterQuestionValidationMessage = '<?php echo ENTER_QUESTION_MESSAGE; ?>';

    //Marriage Certificate
    var marriageNoValidationMessage = '<?php echo MARRIAGE_NO_MESSAGE; ?>';
    var residenceOfValidationMessage = '<?php echo RESIDENCE_OF_MESSAGE; ?>';
    var pageNoValidationMessage = '<?php echo PAGE_NO_MESSAGE; ?>';
    var entryNumberValidationMessage = '<?php echo ENTRY_NUMBER_MESSAGE; ?>';
    var registrationYearValidationMessage = '<?php echo REGISTRATION_YEAR_MESSAGE; ?>';

    // Birth Certificate
    var registrationNumberValidationMessage = '<?php echo REGISTRATION_NUMBER_MESSAGE; ?>';
    var dateYearValidationMessage = '<?php echo DATE_YEAR_MESSAGE; ?>';
    var registrationDateValidationMessage = '<?php echo REGISTRATION_DATE_MESSAGE; ?>';
    var purposeForBirthCertificateValidationMessage = '<?php echo PURPOSE_FOR_BIRTH_CERTIFICATE_MESSAGE; ?>';
    var applyingForValidationMessage = '<?php echo APPLYING_FOR_CERTIFICATE_MESSAGE; ?>';
    var otherRelationshipValidationMessage = '<?php echo OTHER_RELATIONSHIP_MESSAGE; ?>';

    //Death Certificate
    var deathDateValidationMessage = '<?php echo DEATH_DATE_MESSAGE; ?>';
    var relationStatusValidationMessage = '<?php echo RELATION_STATUS_MESSAGE; ?>';
    var purposeForDeathCertificateValidationMessage = '<?php echo PURPOSE_FOR_DEATH_CERTIFICATE_MESSAGE; ?>';

    // Landtax Agriculture
    var surveyNumberValidationMessage = '<?php echo SURVEY_NUMBER_MESSAGE; ?>';
    var amountValidationMessage = '<?php echo AMOUNT_MESSAGE; ?>';
    var arreasValidationMessage = '<?php echo ARREAS_MESSAGE; ?>';
    
    // general Application
    var reportValidationMessage = '<?php echo REPORT_MESSAGE; ?>';
    var subjectValidationMessage = '<?php echo SUBJECT_MESSAGE; ?>';
    var authorityValidationMessage = '<?php echo AUTHORITY_MESSAGE; ?>';
    var referenceValidationMessage = '<?php echo REFERENCE_MESSAGE; ?>';
    var copytoValidationMessage = '<?php echo COPYTO_MESSAGE; ?>';
    
    

</script>