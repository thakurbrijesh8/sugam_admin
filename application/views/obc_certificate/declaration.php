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
        $applicant_obc_caste_array = $this->config->item('applicant_obc_caste_array');
        $marital_status_array = $this->config->item('marital_status_array');
        $taluka_array = $this->config->item('taluka_array');
        $village_array = $district == TALUKA_DAMAN ? $daman_villages_array : ($district == TALUKA_DIU ? $diu_villages_array : ($district == TALUKA_DNH ? $dnh_villages_array : array()));

        $obccaste_text = (isset($applicant_obc_caste_array[$obccaste]) ? $applicant_obc_caste_array[$obccaste] : '');

        $taluka_name = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        //$year_array = explode('-', $application_year);
        $app_occupation = (isset($applicant_occupation_array[$applicant_occupation]) ? ($applicant_occupation == VALUE_TWELVE ? $applicant_other_occupation : $applicant_occupation_array[$applicant_occupation]) : '-');
        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');
        $per_village_text = isset($village_array[$per_village]) ? $village_array[$per_village] : '';

        $father_data = $father_details ? json_decode($father_details, true) : array();
        $mother_data = $mother_details ? json_decode($mother_details, true) : array();
        $grandfather_data = $grandfather_details ? json_decode($grandfather_details, true) : array();
        $spouse_data = $spouse_details ? json_decode($spouse_details, true) : array();
        ?>

        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I the undersigned Shri / Smt. / Kum. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_name . '&nbsp;'; ?></span>
                aged about  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_age . '&nbsp;'; ?></span> ,Years,
                <?php if ($constitution_artical == VALUE_ONE) { ?> Marital Status :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $marital_status_text . '&nbsp;'; ?></span>
                    resident of :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $com_addr_house_no . '&nbsp;' . $com_addr_house_name . '&nbsp;' . $com_addr_street . '&nbsp;' . $com_addr_city . '&nbsp;' ?></span>, of <?php echo $taluka_name; ?> District.
                <?php } else { ?>
                    resident of :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $com_addr_house_no . '&nbsp;' . $com_addr_house_name . '&nbsp;' . $com_addr_street . '&nbsp;' . $com_addr_city . '&nbsp;' ?></span>, of <?php echo $taluka_name; ?> District. That I am applied for my Minor Child <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $minor_child_name . '&nbsp;'; ?></span><?php } ?></div>


            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    1. That my name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_name . '&nbsp;'; ?></span><?php } else { ?>
                    1. That my Child name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $minor_child_name . '&nbsp;'; ?></span><?php } ?>. That I was born at Village &nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_village_name; ?></span>&nbsp;District&nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_district_name; ?></span>&nbsp;State&nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_state_name; ?></span> on <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . convert_to_new_date_format($applicant_dob) . '&nbsp;'; ?></span> and  That my Original Native is Village &nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $native_place_village_text; ?></span>&nbsp; District &nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $native_place_district_text; ?></span>&nbsp; State&nbsp; <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $native_place_state_text; ?></span>  That I am <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_nationality; ?></span> National. <?php if ($constitution_artical == VALUE_ONE) { ?>That my name has been included in Electoral Roll of <?php echo $taluka_name; ?> and my Photo ID Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $election_no; ?></span> & Aadhaar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $aadhaar; ?></span><?php } else { ?>That my Aadhaar Card No. is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $aadhaar; ?></span><?php } ?>.  That I was studied in the School / College <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_education; ?></span> at <?php echo $taluka_name; ?> District.
                That my profession is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $occupation_text; ?></span>.My gross annual income is<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $income_sources; ?></span>for the year 20-21. That I do not possess wealth above the exemption limit as prescribed in the wealth Tax Act</span> </div>


            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                2.   That I belong to  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $obccaste_text; ?></span>
                Caste which is recognized as other Backward Class as per Government Notification No.DC/10/201/92/2440 dated 27.01.1994 issued by the Assistant Secretary, Administrator’s Secretariat, Moti Daman/No.AS/SW/519(2)/02-03/260 dated 31.01.2003 issued by the Assistant Secretary, (S.W.), Secretariat, Moti Daman. 
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                3.   That my Father name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_name']; ?></span></br>
                He was born at Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_born_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_born_place_state_text']; ?></span> Since.
                His Original Native is Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_native_place_village_text']; ?></span> District <span class="b-b-1px f-w-b">
                    <?php echo $father_data['father_native_place_district_text'];
                    ?></span> City <span class="b-b-1px f-w-b"><?php echo $father_city_text; ?></span>.  He is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_nationality']; ?></span> National. That his name has been included in Electoral Roll of <?php echo $taluka_name; ?> and His Photo ID Card No <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_election_no']; ?></span> & Aadhaar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_aadhaar']; ?></span> of <?php echo $taluka_name; ?> District. That his profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_occupation_text; ?></span> His gross annual income is Rs <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $income_sources; ?></span> for the year 20-2021. That he does not possess wealth above the exemption limit as prescribed in the wealth Tax Act. 
            </div>

            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                4.  That my mother name is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_name']; ?></span>
                She was born at Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_state_text']; ?></span> Since. She is Original Native of Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_native_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_state_text']; ?></span>.
            </div> She is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $$mother_data['mother_nationality']; ?></span> National. That her name has been included in Electoral Roll of <?php echo $taluka_name; ?> and Her Photo ID Card No.  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_election_no']; ?></span> & Aadhaar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_aadhaar']; ?></span> of <?php echo $taluka_name; ?> District. That his profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_occupation_text; ?></span> and Her gross annual income is Rs <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $income_sources; ?></span> for the year 20-2021. That she does not possess wealth above the exemption limit as prescribed in the wealth Tax Act. 
        </div>

        <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">  <?php if ($constitution_artical == VALUE_ONE) { ?>
                5.   That name of my spouse is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $spouse_data['spouse_name']; ?></span></br>
                That He/she was born at village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $spouse_data['spouse_born_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $spouse_data['spouse_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $spouse_data['spouse_born_place_state_text']; ?></span> Since.  His Original Native is Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $spouse_data['spouse_native_place_village_text']; ?></span>  District <span class="b-b-1px f-w-b">
                    <?php
                    echo $spouse_data['spouse_native_place_district_text'];
                    ?></span> City <span class="b-b-1px f-w-b"><?php echo $spouse_data['spouse_city_text']; ?></span>. That he is an  <span class="b-b-1px f-w-b"><?php echo $spouse_nationality; ?></span> National.That his/her name has been included in Electoral Roll of <?php echo $taluka_name; ?> and His/her Photo ID Card No <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $spouse_data['spouse_election_no']; ?></span> & Aadhaar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $spouse_data['spouse_aadhaar']; ?></span> of <?php echo $taluka_name; ?> District. That his/her profession is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $spouse_occupation_text; ?></span> His/her gross annual income is Rs <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $income_sources; ?></span> for the year 20-2021. That he/she does not possess wealth above the exemption limit as prescribed in the wealth Tax Act.<?php } ?> 
        </div>

        <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    6.  That my grandfather name is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_name']; ?></span>
                    He was born at Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_state_text']; ?></span> Since. He is Original Native of Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_native_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_state_text']; ?></span>.
                </div> He is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_nationality']; ?></span> National. That his name has been included in Electoral Roll of <?php echo $taluka_name; ?> and His Photo ID Card No.  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_election_no']; ?></span> & Aadhaar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_aadhaar']; ?></span> of <?php echo $taluka_name; ?> District. That his profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_occupation_text; ?></span> and His gross annual income is Rs <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $income_sources; ?></span> for the year 20-2021. That he does not possess wealth above the exemption limit as prescribed in the wealth Tax Act. 
            </div>

        <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
            7. That myself and my parents / my family are ordinarily resident of <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $village_name_text; ?></span> of Taluka <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $taluka_name; ?></span> of District in section 20 of the representation of the people Act,1950.
        </div>

        <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
            8. That rule of exclusion as mentioned in Office Memorandum no.36012/22/93-Estt(SCT) date 08.09.1993 issued by the ministry of Personnel, public Grievances of Pensions (department of Personnel 7 training), New Delhi, will not apply in my case. My case does not fall in category of persona/sections mentioned in Col.3 of the Schedule to the Office Memorandum as stated above. I am entitled for getting benefit of reservation for other backward Class in Civil Posts and Services under the Government of India
        </div>

        <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
            9. That I, my father, my mother or family members including minor children do not hold any agricultural land anywhere, if they hold an agricultural land following particulars are to be mentioned. That my father / mother / minor children possess vacant land and / or building in urban areas or urban agglomeration. Details are as under.
        </div>

        <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
            A. Location of Property.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B. Details of Property.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C. Use to which it is put.
        </div>

        <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
            &nbsp;Except above property we do not own any property anywhere.
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


        <table style="margin-top: 10px; width: 100%;">
            <tr>
                <td style="vertical-align: top; width: 33%;">
                    <b>Place&nbsp; :-</b> <?php echo $taluka_name; ?><br>
                    <b>Dated :-</b> <?php echo $submitted_datetime == '0000-00-00 00:00:00' ? date('d-m-Y') : convert_to_new_date_format($submitted_datetime); ?>
                </td>
                <td class="t-a-c" style="width: 25%;">
                    <img src='<?php echo OBC_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'
                         style="width: 110px; height: 130px; border: 1px solid;" />
                </td>
                <td class="t-a-c" style="width: 42%;">
                    <div>
                        This Declaration is electronically generated and no signature is required.
                    </div>
                    <div style="border-bottom: 1px dashed;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <br>
                    <div style="padding-top: 3px;">
                        DEPONENT
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>