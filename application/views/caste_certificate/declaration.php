<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Declaration</title>
        <style type="text/css">
            body {
                font-size: 14px;
            }
            .f-w-b{
                font-weight: bold;
            }
            .f-s-title{
                font-size: 25px;
                letter-spacing: 1px;
            }
            .t-a-c{
                text-align: center;
            }
            .b-b-1px{
                border-bottom: 1px solid;
            }
            .l-s{
                letter-spacing: 0.5px;
            }
            .l-h{
                line-height: 25px;
            }
            .monthly-income, .app-form-income{
                width: 100%;
                border-collapse: collapse;
            }
            .monthly-income tr td{
                border: 1px solid black;
                padding: 3px;
            }
            .app-form-income tr td{
                border: 1px solid black;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <?php
        $applicant_occupation_array = $this->config->item('applicant_occupation_array');
        //$profession_array = $this->config->item('profession_array');
        $marital_status_array = $this->config->item('marital_status_array');
        $taluka_array = $this->config->item('taluka_array');
        $daman_villages_array = $this->config->item('daman_villages_array');
        $diu_villages_array = $this->config->item('diu_villages_array');
        $dnh_villages_array = $this->config->item('dnh_villages_array');
        $caste_array = $this->config->item('caste_array');
        $applicant_education_array = $this->config->item('education_type_array');
        $applicant_caste_text = isset($caste_array[$applicant_caste]) ? $caste_array[$applicant_caste] : '-';
        $taluka_name_text = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        //$year_array = explode('-', $application_year);

        $father_data = $father_details ? json_decode($father_details, true) : array();
        $mother_data = $mother_details ? json_decode($mother_details, true) : array();
        $grandfather_data = $grandfather_details ? json_decode($grandfather_details, true) : array();
        $spouse_data = $spouse_details ? json_decode($spouse_details, true) : array();
        $father_occupation = $father_data['father_occupation'];
        $mother_occupation = $mother_data['mother_occupation'];
        $grandfather_occupation = $grandfather_data['grandfather_occupation'];
        $spouse_occupation = $spouse_data['spouse_occupation'];
        $occupation_text = (isset($applicant_occupation_array[$occupation]) ? ($occupation == VALUE_TWELVE ? $applicant_other_occupation : $applicant_occupation_array[$occupation]) : '-');
        $father_occupation_text = (isset($applicant_occupation_array[$father_occupation]) ? ($father_occupation == VALUE_TWELVE ? $father_other_occupation : $applicant_occupation_array[$father_occupation]) : '-');
        $mother_occupation_text = (isset($applicant_occupation_array[$mother_occupation]) ? ($mother_occupation == VALUE_TWELVE ? $mother_other_occupation : $applicant_occupation_array[$mother_occupation]) : '-');
        $grandfather_occupation_text = (isset($applicant_occupation_array[$grandfather_occupation]) ? ($grandfather_occupation == VALUE_TWELVE ? $grandfather_other_occupation : $applicant_occupation_array[$grandfather_occupation]) : '-');
        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');
        $applicant_education_text = (isset($applicant_education_array[$applicant_education]) ? $applicant_education_array[$applicant_education] : '');


        if ($district == TALUKA_DAMAN) {
            $village_name_text = (isset($daman_villages_array[$village_name]) ? $daman_villages_array[$village_name] : '');
        } else if ($district == TALUKA_DIU) {
            $village_name_text = (isset($diu_villages_array[$village_name]) ? $diu_villages_array[$village_name] : '');
        } else if ($district == TALUKA_DNH) {
            $village_name_text = (isset($dnh_villages_array[$village_name]) ? $dnh_villages_array[$village_name] : '');
        }

        $applicant_caste_array = $this->config->item('caste_array');
        $applicant_sc_subcaste_array = $this->config->item('applicant_sc_subcaste_array');
        $applicant_st_subcaste_array = $this->config->item('applicant_st_subcaste_array');
        $relation_deceased_person_array = $this->config->item('relation_deceased_person_array');
        $damanVillagesArray = $this->config->item('daman_villages_array');

        $village_name_text_for_native = (isset($damanVillagesArray[$native_place_village]) ? $damanVillagesArray[$native_place_village] : '');

        $father_village_name_text_for_native = (isset($damanVillagesArray[$father_native_place_village]) ? $damanVillagesArray[$father_native_place_village] : '');

        $grandfather_village_name_text_for_native = (isset($damanVillagesArray[$grandfather_native_place_village]) ? $damanVillagesArray[$grandfather_native_place_village] : '');

        $relation_deceased_person_text = (isset($relation_deceased_person_array[$relationship_of_applicant]) ? $relation_deceased_person_array[$relationship_of_applicant] : '');



        if ($applicant_caste == VALUE_ONE) {
            if ($apllicant_sc_subcaste != '')
                $subcaste_name_text_for_caste = $applicant_sc_subcaste_array[$apllicant_sc_subcaste];
            else
                $subcaste_name_text_for_caste = $applicant_st_subcaste_array[$apllicant_st_subcaste];
        }

        if ($applicant_caste == VALUE_TWO) {
            if ($apllicant_sc_subcaste != '')
                $subcaste_name_text_for_caste = $applicant_sc_subcaste_array[$apllicant_sc_subcaste];
            else
                $subcaste_name_text_for_caste = $applicant_st_subcaste_array[$apllicant_st_subcaste];
        }

        if ($father_caste == VALUE_ONE) {
            if ($father_sc_subcaste != '')
                $fathersubcaste_name_text_for_caste = $applicant_sc_subcaste_array[$father_data['father_sc_subcaste']];
            else
                $fathersubcaste_name_text_for_caste = $applicant_st_subcaste_array[$father_data['father_st_subcaste']];
        }

        if ($father_data['father_caste'] == VALUE_TWO) {
            if ($father_data['father_sc_subcaste'] != '')
                $fathersubcaste_name_text_for_caste = $applicant_sc_subcaste_array[$father_data['father_sc_subcaste']];
            else
                $fathersubcaste_name_text_for_caste = $applicant_st_subcaste_array[$father_data['father_st_subcaste']];
        }
        if ($mother_data['mother_caste'] == VALUE_ONE) {
            if ($mother_data['mother_sc_subcaste'] != '')
                $mothersubcaste_name_text_for_caste = $applicant_sc_subcaste_array[$mother_data['mother_sc_subcaste']];
            else
                $mothersubcaste_name_text_for_caste = $applicant_st_subcaste_array[$mother_data['mother_st_subcaste']];
        }

        if ($mother_data['mother_caste'] == VALUE_TWO) {
            if ($mother_data['mother_sc_subcaste'] != '')
                $mothersubcaste_name_text_for_caste = $applicant_sc_subcaste_array[$mother_data['mother_sc_subcaste']];
            else
                $mothersubcaste_name_text_for_caste = $applicant_st_subcaste_array[$mother_data['mother_st_subcaste']];
        }

        if ($grandfather_data['grandfather_caste'] == VALUE_ONE) {
            if ($grandfather_data['grandfather_sc_subcaste'] != '')
                $grandfathersubcaste_name_text_for_caste = $applicant_sc_subcaste_array[$grandfather_data['grandfather_sc_subcaste']];
            else
                $grandfathersubcaste_name_text_for_caste = $applicant_st_subcaste_array[$grandfather_data['grandfather_st_subcaste']];
        }

        if ($grandfather_data['grandfather_caste'] == VALUE_TWO) {
            if ($grandfather_data['grandfather_sc_subcaste'] != '')
                $grandfathersubcaste_name_text_for_caste = $applicant_sc_subcaste_array[$grandfather_data['grandfather_sc_subcaste']];
            else
                $grandfathersubcaste_name_text_for_caste = $applicant_st_subcaste_array[$grandfather_data['grandfather_st_subcaste']];
        }
        ?>
        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I the undersigned Shri / Smt. / Kum. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_name . '&nbsp;'; ?></span>
                aged about  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_age . '&nbsp;'; ?></span> ,Years,
                <?php if ($constitution_artical == VALUE_ONE) { ?> Marital Status :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $marital_status_text . '&nbsp;'; ?></span>
                    resident of :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $com_addr_house_no . '&nbsp;' . $com_addr_house_name . '&nbsp;' . $com_addr_street . '&nbsp;' . $com_addr_city; ?></span>, of <?php echo $taluka_name_text; ?> District.
                <?php } else { ?>
                    resident of :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $com_addr_house_no . '&nbsp;' . $com_addr_house_name . '&nbsp;' . $com_addr_street . '&nbsp;' . $com_addr_city; ?></span>, of <?php echo $taluka_name_text; ?> District. That I am applied for my Minor Child <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $minor_child_name . '&nbsp;'; ?></span><?php } ?></div>


            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    1. That my name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_name . '&nbsp;'; ?></span><?php } else { ?>
                    1. That my Child name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $minor_child_name . '&nbsp;'; ?></span><?php } ?>.</div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                2. That I was born at Village &nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_place_village_text; ?></span>&nbsp;District&nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_place_district_text; ?></span>&nbsp;State&nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_place_state_text; ?></span> on <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . convert_to_new_date_format($applicant_dob) . '&nbsp;'; ?></span> and permanent resident at <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $per_addr_house_no . '&nbsp;' . $per_addr_house_name . '&nbsp;' . $per_addr_street . '&nbsp;' . '&nbsp;' . $per_pincode; ?></span>&nbsp;Since</div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                3.  That my Original Native is Village &nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $village_name_text_for_native; ?></span>&nbsp; District &nbsp;<span class="b-b-1px f-w-b">
                    <?php
                    echo $native_place_district_text;
                    ?></span>&nbsp; State&nbsp; <span class="b-b-1px f-w-b"><?php
                    echo $native_place_state_text;
                    ?></span>

            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                4.  That I am <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_nationality; ?></span> National. That I am belongs to <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $subcaste_name_text_for_caste; ?></span> Caste and Religion<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_religion; ?></span>

            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                5.   <?php if ($constitution_artical == VALUE_ONE) { ?>That I am holding Electoral Card i.e. PJG No.<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $election_no; ?></span> & Aadhar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $aadhaar; ?></span><?php } else { ?>That my Aadhar Card No. is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $aadhaar; ?></span><?php } ?>.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                6.   That I was studied in the School / College <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_education_text; ?></span> at <?php echo $taluka_name_text; ?> District.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                7.   That my profession is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $occupation_text; ?></span>.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                8.   That my Father name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_name']; ?></span></br>
                He was born at Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_born_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_born_place_state_text']; ?></span> Since.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                9.   His Original Native is Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_native_place_village_text']; ?></span> District <span class="b-b-1px f-w-b">
                    <?php
                    echo $father_data['father_native_place_district_text'];
                    ?></span> City <span class="b-b-1px f-w-b"><?php echo $father_data['father_native_place_city_text']; ?></span>.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                10.   He is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_nationality']; ?></span> National. He is holding Election Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_election_no']; ?></span> & Aadhar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_aadhaar']; ?></span> of <?php echo $taluka_name_text; ?> District. That his profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_occupation_text; ?></span> and he is belongs to <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $fathersubcaste_name_text_for_caste; ?></span> Caste and Religion <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_religion']; ?></span>. 
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                11.  That my mother name is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_name']; ?></span></br>
                She was born at Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_state_text']; ?></span> Since.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                12.  She is Original Native of Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_native_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_native_place_district']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_native_place_state_text']; ?></span>.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                13.  She is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_nationality']; ?></span> National. He is holding Election Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_election_no']; ?></span> & Aadhar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_aadhaar']; ?></span> of <?php echo $taluka_name_text; ?> District. That his profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_occupation_text; ?></span> and he is belongs to <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mothersubcaste_name_text_for_caste; ?></span> Caste and Religion <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_religion']; ?></span>. 
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                14.   That my Grandfather name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_name']; ?></span></br>
                He was born at Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_state_text']; ?></span> Since.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                15.   His Original Native is Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_native_place_village_text']; ?></span> District <span class="b-b-1px f-w-b">
                    <?php
                    echo $grandfather_data['grandfather_native_place_district_text'];
                    ?></span> City <span class="b-b-1px f-w-b"><?php echo $grandfather_data['grandfather_native_place_city_text']; ?></span>.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                16.   He is <span class="b-b-1px f-w-b"><?php echo $grandfather_data['grandfather_nationality']; ?></span> National. He is holding Election Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_election_no']; ?></span> & Aadhar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_aadhaar']; ?></span> of <?php echo $taluka_name_text; ?> District. That his profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_occupation_text; ?></span> and he is belongs to <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfathersubcaste_name_text_for_caste; ?></span> Caste and Religion <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_religion']; ?></span>. 
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                17. That myself and my parents / my family are ordinarily resident of <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $village_name_text; ?></span> of Taluka <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $taluka_name_text; ?></span> of District in section 20 of the representation of the people Act,1950.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                18.  Except above resident, we do not have own any other permanent residential address anywhere in India.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                19.  That I did not applied for a Certificate of Caste here before.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                20.  That the Cast Certificate is required for <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $purpose_of_caste_certificate; ?></span> Purpose.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein. I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the punishment as per the law and that the benefits availed by me shall be summarily withdrawn”.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian Penal Code which state as follows:-
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;<b>Section 199.</b> False statement made in declaration which is by law receivable as evidence:- Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or any Public Servant or other person, is bound or authorized by law to receive as evidence of any fact, makes any statement which is false, and which he either knows or believes to be false or does not believe to be true, touching any point material to the object for which the declaration is made or used, shall be punished in the same manner as if he gave false evidence.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;<b>Section 200.</b> Using as true such declaration knowing it to be false:-Whoever corruptly uses or attempts to use as true any such declaration, knowing the same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;Explanation: A declaration which is inadmissible merely upon the ground of some informality is a declaration within the meaning of Sections 199 and 200.
            </div>
        </div>


        <table style="margin-top: 10px; width: 100%;">
            <tr>
                <td style="vertical-align: top; width: 33%;">
                    <b>Place&nbsp; :-</b> <?php echo $taluka_name_text; ?><br>
                    <b>Dated :-</b> <?php echo $submitted_datetime == '0000-00-00 00:00:00' ? date('d-m-Y') : convert_to_new_date_format($submitted_datetime); ?>
                </td>
                <td class="t-a-c" style="width: 25%;">
                    <img src='<?php echo CASTE_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'
                         style="width: 110px; height: 130px; border: 1px solid;" />
                </td>
                <td class="t-a-c" style="width: 42%;">
                    <div>
                        This Declaration is electronically generated and no signature is required.
                    </div>
                    <div style="border-bottom: 1px dashed;">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <br>
                    <div style="padding-top: 3px;">
                        DEPONENT
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>