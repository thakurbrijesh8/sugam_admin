<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Scrutiny</title>
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
        $daman_villages_array = $this->config->item('daman_villages_array');
        $diu_villages_array = $this->config->item('diu_villages_array');
        $dnh_villages_array = $this->config->item('dnh_villages_array');
        $rec_array = $this->config->item('rec_array');
        $marital_status_array = $this->config->item('marital_status_array');
        $taluka_array = $this->config->item('taluka_array');
        $gender_array = $this->config->item('gender_array');
        $yes_no_array = $this->config->item('yes_no_array');
        $applicant_caste_array = $this->config->item('caste_array');
        $applicant_sc_subcaste_array = $this->config->item('applicant_sc_subcaste_array');
        $applicant_st_subcaste_array = $this->config->item('applicant_st_subcaste_array');
        $relation_deceased_person_array = $this->config->item('relation_deceased_person_array');
        $education_array = $this->config->item('education_type_array');
        $police_station_status_array = $this->config->item('police_station_status_array');

        $state_array = $this->config->item('state_array');
        $damandiudistrict_array = $this->config->item('daman_diu_district_array');
        $dnhdistrict_array = $this->config->item('dnh_district_array');
        $damanvillageForNative_array = $this->config->item('daman_village_array_for_native');
        $diuvillagesForNative_array = $this->config->item('diu_village_array_for_native');
        $dnhvillagesForNative_array = $this->config->item('dnh_village_array_for_native');

        $taluka_name_text = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        if ($district == TALUKA_DAMAN) {
            $village_name_text = (isset($daman_villages_array[$village_name]) ? $daman_villages_array[$village_name] : '');

            $village_name_text_for_native = (isset($damanvillageForNative_array[$native_place_village]) ? $damanvillageForNative_array[$native_place_village] : '');

            $mother_village_name_text_for_native = (isset($damanvillageForNative_array[$mother_native_place_village]) ? $damanvillageForNative_array[$mother_native_place_village] : '');
            $spouse_village_name_text_for_native = (isset($damanvillageForNative_array[$spouse_native_place_village]) ? $damanvillageForNative_array[$spouse_native_place_village] : '');
        } else if ($district == TALUKA_DIU) {
            $village_name_text = (isset($diu_villages_array[$village_name]) ? $diu_villages_array[$village_name] : '');

            $village_name_text_for_native = (isset($diuvillagesForNative_array[$native_place_village]) ? $diuvillagesForNative_array[$native_place_village] : '');

            $mother_village_name_text_for_native = (isset($diuvillagesForNative_array[$mother_native_place_village]) ? $diuvillagesForNative_array[$mother_native_place_village] : '');
            $spouse_village_name_text_for_native = (isset($diuvillagesForNative_array[$spouse_native_place_village]) ? $diuvillagesForNative_array[$spouse_native_place_village] : '');
        } else if ($district == TALUKA_DNH) {
            $village_name_text = (isset($dnh_villages_array[$village_name]) ? $dnh_villages_array[$village_name] : '');

            $village_name_text_for_native = (isset($dnhvillagesForNative_array[$native_place_village]) ? $dnhvillagesForNative_array[$native_place_village] : '');

            $mother_village_name_text_for_native = (isset($dnhvillagesForNative_array[$mother_native_place_village]) ? $dnhvillagesForNative_array[$mother_native_place_village] : '');
            $spouse_village_name_text_for_native = (isset($dnhvillagesForNative_array[$spouse_native_place_village]) ? $dnhvillagesForNative_array[$spouse_native_place_village] : '');
        }

        $father_data = $father_details ? json_decode($father_details, true) : array();
        $mother_data = $mother_details ? json_decode($mother_details, true) : array();
        $grandfather_data = $grandfather_details ? json_decode($grandfather_details, true) : array();
        $spouse_data = $spouse_details ? json_decode($spouse_details, true) : array();

        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');

        $state_name_text_for_native = (isset($state_array[$native_place_state]) ? $state_array[$native_place_state] : '');
//        $father_state_name_text_for_native = (isset($state_array[$father_native_place_state]) ? $state_array[$father_native_place_state] : '');
//        $mother_state_name_text_for_native = (isset($state_array[$mother_native_place_state]) ? $state_array[$mother_native_place_state] : '');
//        $spouse_state_name_text_for_native = (isset($state_array[$spouse_native_place_state]) ? $state_array[$spouse_native_place_state] : '');

        $gender_text = (isset($gender_array[$gender]) ? $gender_array[$gender] : '-');
        //$relationship_of_applicant_text = (isset($relationship_of_applicant_array[$relationship_of_applicant]) ? $relationship_of_applicant_array[$relationship_of_applicant] : '-');
        $relation_deceased_person_text = (isset($relation_deceased_person_array[$relationship_of_applicant]) ? $relation_deceased_person_array[$relationship_of_applicant] : '');

        $village_name_text_for_native = (isset($daman_villages_array[$native_place_village]) ? $daman_villages_array[$native_place_village] : '');

        // $village_name_text_for_native = (isset($damanVillagesArray[$native_place_village]) ? $damanVillagesArray[$native_place_village] : '');
        // $father_village_name_text_for_native = (isset($daman_villages_array[$father_native_place_village]) ? $daman_villages_array[$father_native_place_village] : '');
        //$grandfather_village_name_text_for_native = (isset($daman_villages_array[$grandfather_native_place_village]) ? $daman_villages_array[$grandfather_native_place_village] : '');
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

        $applicant_caste_text = $applicant_caste_array[$applicant_caste];
        $father_caste_text = $applicant_caste_array[$father_data['father_caste']];
        $mother_caste_text = $applicant_caste_array[$mother_data['mother_caste']];
        $spouse_caste_text = $applicant_caste_array[$spouse_data['spouse_caste']];
        $grandfather_caste_text = $applicant_caste_array[$grandfather_data['grandfather_caste']];

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

        if ($father_data['father_caste'] == VALUE_ONE) {
            if ($father_data['father_sc_subcaste'] != '')
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
        if ($spouse_data['spouse_caste'] == VALUE_ONE) {
            if ($spouse_data['spouse_sc_subcaste'] != '')
                $spousesubcaste_name_text_for_caste = $applicant_sc_subcaste_array[$spouse_data['spouse_sc_subcaste']];
            else
                $spousesubcaste_name_text_for_caste = $applicant_st_subcaste_array[$spouse_data['spouse_st_subcaste']];
        }
        if ($spouse_data['spouse_caste'] == VALUE_TWO) {
            if ($spouse_data['spouse_sc_subcaste'] != '')
                $spousesubcaste_name_text_for_caste = $applicant_sc_subcaste_array[$spouse_data['spouse_sc_subcaste']];
            else
                $spousesubcaste_name_text_for_caste = $applicant_st_subcaste_array[$spouse_data['spouse_st_subcaste']];
        }




        $district_name_text_for_native = $native_place_state == VALUE_ONE ? $damandiudistrict_array[$native_place_district] : ($native_place_state == VALUE_TWO ? $dnhdistrict_array[$native_place_district] : []);
        $district_name_text_for_native = $born_place_state == VALUE_ONE ? $damandiudistrict_array[$born_place_district] : ($born_place_state == VALUE_TWO ? $dnhdistrict_array[$born_place_district] : []);

        $village = array($village_name);
        $needle = range(25, 39);
        if (array_intersect($village, $needle)) {
            $village_name_text_seja = DMC_AREA;
        } else {
            if ($district == TALUKA_DAMAN)
                $village_name_text_seja = (isset($daman_villages_array[$village_name]) ? $daman_villages_array[$village_name] : '');
            else if ($district == TALUKA_DIU)
                $village_name_text_seja = (isset($diu_villages_array[$village_name]) ? $diu_villages_array[$village_name] : '');
            else if ($district == TALUKA_DNH)
                $village_name_text_seja = (isset($dnh_villages_array[$village_name]) ? $dnh_villages_array[$village_name] : '');
        }
        ?>
        <div style="font-family: arial_unicode_ms;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">રીપોર્ટ</span></div>
            <div class="l-s" style="padding-left: 70%; margin-top: 10px;">જા.નં.&nbsp; :- <span class="f-w-b"><?php echo $application_number; ?></span></div>
            <div class="l-s" style="padding-left: 70%;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text_seja . ' સેજા'; ?></span></div>
            <div class="l-s" style="padding-left: 70%;">તારીખ :- <span class="f-w-b"><?php echo $talathi_to_aci_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($talathi_to_aci_datetime) : '-'; ?></span></div>
            <div class="l-s l-h" style="height: 90px;">
                મહેરબાન મામલતદાર સાહેબ,<br/>દમણ
            </div>
            <div class="l-s l-h" style="height: 60px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    આપ સાહેબના પત્ર નં. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $application_number . '&nbsp;&nbsp;&nbsp;'; ?></span> તા:- 
                    <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                    નાં અનુસંધાનમાં જણાવવાનું  કે   શ્રી/શ્રીમતી/કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>, રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . '&nbsp;&nbsp;&nbsp;'; ?></span>એ કાસ્ટ સર્ટીફિકેટ માટે અરજી કરેલ છે.<br/>

                <?php } else { ?>
                    આપ સાહેબના પત્ર નં. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $application_number . '&nbsp;&nbsp;&nbsp;'; ?></span> તા:- 
                    <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                    નાં અનુસંધાનમાં જણાવવાનું  કે   શ્રી/શ્રીમતી/કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,તેઓના પુત્ર/પુત્રી  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $minor_child_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,                                                   
                    રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . '&nbsp;&nbsp;&nbsp;'; ?></span>એ કાસ્ટ સર્ટીફિકેટ માટે અરજી કરેલ છે.<br/> 
                <?php } ?>


                ૧. મારો જન્મ સ્થળ મોજે :- <span class="b-b-1px f-w-b"><?php
                    echo '&nbsp;&nbsp;&nbsp;' .
                    $born_village_name . '&nbsp;&nbsp;&nbsp;';
                    ?></span> તાલુકા  <span class="b-b-1px f-w-b"><?php ?><?php echo '&nbsp;&nbsp;&nbsp;' . $born_district_name . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>



                ૨. હું જાતે હિન્દુ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_religion . '&nbsp;&nbsp;&nbsp;' . $subcaste_name_text_for_caste . '&nbsp;&nbsp;&nbsp;'; ?></span>છુ. તેમજ અરજદારના માતા / પિતા પણ જાતે હિન્દુ <span class="b-b-1px f-w-b"><?php
                    echo '&nbsp;&nbsp;&nbsp;' .
                    $mothersubcaste_name_text_for_caste . '&nbsp;&nbsp;&nbsp;';
                    ?></span> અને <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $fathersubcaste_name_text_for_caste . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>

                3. મારા પિતા શ્રીનું નામ  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>છે, તેઓનું જન્મ સ્થળ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>

                4. મારા માતા શ્રીનું નામ  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>છે, તેઓનું જન્મ સ્થળ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>

                5. મારા દાદા શ્રીનું નામ  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $grandfather_data['grandfather_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>છે, તેઓનું જન્મ સ્થળ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $grandfather_data['grandfather_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>



                <div class="l-s" style="margin-top: 10px;">
                    <b>અરજદારે રજૂ કરેલ આ સાથે અરજી, એફિડેવિટ, ઇલેક્શન કાર્ડ, આધાર કાર્ડ, બર્થ સર્ટિ  છે.</b>
                </div>
                <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%;">&nbsp;</div>
                <div class="l-s">
                    જે આપ સાહેબને  વિદિત થાય.
                </div>
                <div class="l-s" style="padding-left: 70%; margin-top: -20px;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text_seja . ' સેજા'; ?></span></div>
                <div style="border-bottom: 1px dashed; margin-top: -10px;">&nbsp;</div>


                <!-- <div>
                    <pagebreak></pagebreak>
                </div> -->

                <div class="f-s-title t-a-c l-s" style="margin-top: 10px;"><span class="b-b-1px f-w-b">અરજદારનો જવાબ</span></div>
                <div class="l-s l-h" style="height: 90px; margin-top: 20px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        હું નીચે સહી કરનાર શ્રી / શ્રીમતી / કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                        ઉંમર <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_age . '&nbsp;&nbsp;&nbsp;'; ?></span> વર્ષ,  
                        રહેવાસી મોજે<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $commu_add_state_name . '&nbsp;&nbsp;&nbsp;' . $commu_add_district_name . '&nbsp;&nbsp;&nbsp;' . $commu_add_village_name . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                        આજરોજ તલાટી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $village_name_text_seja . '&nbsp;&nbsp;&nbsp;'; ?></span> 
                        સેજા રૂબરૂ હાજર થઇ પૂછવાથી લખાવું છું કે મહેરબાન સાહેબ દમણમાં કાસ્ટ સટીફીકેટ મેળવવા બાબતે અરજી કરેલ છે.

                    <?php } else { ?>

                        હું નીચે સહી કરનાર શ્રી / શ્રીમતી / કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                        ઉંમર <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_age . '&nbsp;&nbsp;&nbsp;'; ?></span> વર્ષ, મારા/પુત્ર/પુત્રી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $minor_child_name . '&nbsp;&nbsp;&nbsp;'; ?></span>, 
                        રહેવાસી મોજે<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $commu_add_state_name . '&nbsp;&nbsp;&nbsp;' . $commu_add_district_name . '&nbsp;&nbsp;&nbsp;' . $commu_add_village_name . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                        આજરોજ તલાટી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $village_name_text_seja . '&nbsp;&nbsp;&nbsp;'; ?></span> 
                        સેજા રૂબરૂ હાજર થઇ પૂછવાથી લખાવું છું કે મહેરબાન સાહેબ દમણમાં કાસ્ટ સટીફીકેટ મેળવવા બાબતે અરજી કરેલ છે. 
                    <?php } ?>

                </div>



                ૧. મારો  જન્મ મોજે :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_village_name . '&nbsp;&nbsp;&nbsp;'; ?></span>  તાલુકા  <span class="b-b-1px f-w-b"><?php ?><?php echo '&nbsp;&nbsp;&nbsp;' . $born_district_name . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>


                2. હું જાતે હિન્દુ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_religion . '&nbsp;&nbsp;&nbsp;' . $subcaste_name_text_for_caste . '&nbsp;&nbsp;&nbsp;'; ?></span>છુ. તેમજ અરજદારના માતા / પિતા પણ જાતે હિન્દુ <span class="b-b-1px f-w-b"><?php
                    echo '&nbsp;&nbsp;&nbsp;' .
                    $mothersubcaste_name_text_for_caste . '&nbsp;&nbsp;&nbsp;';
                    ?></span> અને <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $fathersubcaste_name_text_for_caste . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>

                3. મારા પિતા શ્રીનું નામ  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>

                4. મારા માતા શ્રીનું નામ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>

                <div class="l-s" style="margin-top: 20px;">
                    આ સર્ટીફીકેટનો ઉપયોગ  <span class="b-b-1px f-w-b"> <?php echo $purpose_of_caste_certificate == '' ? 'Old Age Pension' : $purpose_of_caste_certificate; ?> </span>  માટે રજુ કરનાર છે. 
                </div>
                <div class="l-s" style="margin-top: 10px;">
                    ઉપરોકત મારો જવાબ ખરો અને બરાબર છે. જે બદલ વાંચી, સમજી, વાંચી સંભળાવ્યા બાદ સહી કરેલ છે.
                </div>
                <div class="l-s" style="margin-top: 10px;">
                    સ્થળ &nbsp; :- <span class="f-w-b"><?php echo $taluka_name_text; ?></span><br>

                    તારીખ :- <span class="f-w-b"><?php echo $appointment_date != '0000-00-00' ? convert_to_new_date_format($appointment_date) : '-'; ?></span>
                </div>
                <div class="l-s" style="margin-top: -23px; margin-left: 300px;">
                    રૂબરૂ 
                </div>
                <!-- <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%; margin-top: -40px;">&nbsp;</div> -->
                <!-- <div class="l-s" style="padding-left: 70%; margin-top: 0px;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text; ?></span>  સેજા</div> -->
                <div style="border-bottom: 1px dashed; margin-top: 10px;">&nbsp;</div>

            </div>
            <div>
                <pagebreak></pagebreak>
            </div>
            <div style="font-size: 13px;">
                <div class="f-s-title t-a-c l-s"><span class="f-w-b">Application For Caste Certificate</span></div>
                <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                    <tr>
                        <td class="f-w-b">Application Number</td>
                        <td><?php echo $application_number; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Application Type</td>
                        <td>
                            <?php
                            if ($constitution_artical == VALUE_ONE)
                                echo 'Major';
                            else if ($constitution_artical == VALUE_TWO)
                                echo 'Minor';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <?php if ($constitution_artical == VALUE_TWO) { ?>
                            <td class="f-w-b">Name of Applicant / Gaurdian Name</td>
                        <?php } else { ?>
                            <td class="f-w-b">Name of Applicant</td>
                        <?php } ?>
                        <td><?php echo $applicant_name; ?></td>
                    </tr>
                    <?php if ($constitution_artical == VALUE_TWO) { ?>
                        <tr>
                            <td class="f-w-b">Relationship of Applicant</td>
                            <td><?php echo $relation_deceased_person_text; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Guardian's Address</td>
                            <td><?php echo $guardian_address; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Guardian’s Mobile Number</td>
                            <td><?php echo $guardian_mobile_no; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Guardian’s Aadhar Number</td>
                            <td><?php echo $guardian_aadhaar; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="f-w-b">Communication Address</td>
                        <td><?php echo $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;' . $com_addr_city . '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?></td>
                    </tr>
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        <tr>
                            <td class="f-w-b">Permanent Address</td>
                            <td><?php echo $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;' . $com_addr_city . '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;' ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td class="f-w-b">Permanent Address</td>
                            <td><?php echo $per_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $per_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $per_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;' . $com_addr_city . '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?> </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="f-w-b">Mobile Number / Aadhar Number</td>
                        <td><?php echo $mobile_number . ($aadhaar != '' ? (' / ' . $aadhaar) : ''); ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Election Number</td>
                        <td><?php echo $election_no; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Gender / Date of Birth / Age <br> Birth Place </td>
                        <td><?php echo (isset($gender_array[$gender]) ? $gender_array[$gender] : ' - ') . ' / ' . convert_to_new_date_format($applicant_dob) . ' / ' . $applicant_age . ' Years <br>' . $born_state_name . ',' . $born_district_name . ',' . $born_village_name; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Marital Status</td>
                        <td><?php echo $marital_status_text; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Applicant Religion / Cast / Sub Cast</td>
                        <td><?php echo $applicant_religion . ' / ' . $applicant_caste_text . ' / ' . $subcaste_name_text_for_caste; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Nationality</td>
                        <td style="vertical-align: top;"><?php echo $applicant_nationality; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Occupation</td>
                        <td><?php echo ((isset($applicant_occupation_array[$occupation]) ? ($occupation == VALUE_TWELVE ? $other_occupation : $applicant_occupation_array[$occupation]) : '-')); ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Nearest Police Station</td>
                        <td><?php echo isset($police_station_status_array[$nearest_police_station]) ? $police_station_status_array[$nearest_police_station] : '-'; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Education</td>
                        <td><?php echo isset($education_array[$applicant_education]) ? $education_array[$applicant_education] : '-'; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Name of School / Collage / Institute</td>
                        <td><?php echo $name_of_school; ?></td>
                    </tr>
                </table>
                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Father Information</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class="f-w-b">Father Name</td>
                            <td><?php echo $father_data['father_name']; ?></td>
                        </tr>

                        <tr>
                            <td class="f-w-b">Nationality</td>
                            <td style="vertical-align: top;"><?php echo $father_data['father_nationality']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Birth Place</td>
                            <td><?php echo $father_data['father_born_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_born_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_born_place_village_text']; ?></td>
                        </tr>
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td><?php echo $father_data['father_native_place_village_text']; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td><?php echo $father_data['father_native_place_village_text']; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="f-w-b">Father Religion / Cast / Sub Cast</td>
                            <td><?php echo $father_data['father_religion'] . ' / ' . $father_caste_text . ' / ' . $fathersubcaste_name_text_for_caste; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Occupation</td>
                            <td><?php echo((isset($applicant_occupation_array[$father_data['father_occupation']]) ? ($father_data['father_occupation'] == VALUE_TWELVE ? $father_data['father_other_occupation'] : $applicant_occupation_array[$father_data['father_occupation']]) : '-')); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Aadhar Number</td>
                            <td><?php echo ($father_data['father_aadhaar'] != '' ? ($father_data['father_aadhaar']) : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Election Number</td>
                            <td><?php echo ($father_data['father_election_no'] != '' ? ($father_data['father_election_no']) : ''); ?></td>
                        </tr>
                    </table>
                </div>
                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Mother Information</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class="f-w-b">Mother Name</td>
                            <td><?php echo $mother_data['mother_name']; ?></td>
                        </tr>

                        <tr>
                            <td class="f-w-b">Nationality</td>
                            <td style="vertical-align: top;"><?php echo $mother_data['mother_nationality']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Birth Place</td>
                            <td><?php echo $mother_data['mother_born_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_born_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_born_place_village_text']; ?></td>
                        </tr>
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td><?php echo $mother_data['mother_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text']; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td><?php echo $mother_data['mother_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text']; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="f-w-b">Mother Religion / Cast / Sub Cast</td>
                            <td><?php echo $mother_data['mother_religion'] . ' / ' . $mother_caste_text . ' / ' . $mothersubcaste_name_text_for_caste; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Occupation</td>
                            <td><?php echo ((isset($applicant_occupation_array[$mother_data['mother_occupation']]) ? ($mother_data['mother_occupation'] == VALUE_TWELVE ? $mother_data['mother_other_occupation'] : $applicant_occupation_array[$mother_data['mother_occupation']]) : '-')); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Aadhar Number</td>
                            <td><?php echo ($mother_data['mother_aadhaar'] != '' ? ($mother_data['mother_aadhaar']) : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Election Number</td>
                            <td><?php echo ($mother_data['mother_election_no'] != '' ? ($mother_data['mother_election_no']) : ''); ?></td>
                        </tr>
                    </table>
                </div>
                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Grandfather Information</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class="f-w-b">Grandfather Name</td>
                            <td><?php echo $grandfather_data['grandfather_name']; ?></td>
                        </tr>

                        <tr>
                            <td class="f-w-b">Nationality</td>
                            <td style="vertical-align: top;"><?php echo $grandfather_data['grandfather_nationality']; ?></td>
                        </tr>

                        <tr>
                            <td class="f-w-b">Birth Place</td>
                            <td><?php echo $grandfather_data['grandfather_born_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $grandfather_data['grandfather_born_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $grandfather_data['grandfather_born_place_village_text']; ?></td>
                        </tr>

                        <tr>
                            <td class="f-w-b">Original Native Of</td>
                            <td><?php echo $grandfather_data['grandfather_native_place_village_text']; ?></td>
                        </tr>

                        <tr>
                            <td class="f-w-b">Grandfather Religion / Cast / Sub Cast</td>
                            <td><?php echo $grandfather_data['grandfather_religion'] . ' / ' . $grandfather_caste_text . ' / ' . $grandfathersubcaste_name_text_for_caste; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Occupation</td>
                            <td><?php echo((isset($applicant_occupation_array[$grandfather_data['grandfather_occupation']]) ? ($grandfather_data['grandfather_occupation'] == VALUE_TWELVE ? $grandfather_data['grandfather_other_occupation'] : $applicant_occupation_array[$grandfather_data['grandfather_occupation']]) : '-')); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Aadhar Number</td>
                            <td><?php echo ($grandfather_data['grandfather_aadhaar'] != '' ? ($grandfather_data['grandfather_aadhaar']) : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Election Number</td>
                            <td><?php echo ($grandfather_data['grandfather_election_no'] != '' ? ($grandfather_data['grandfather_election_no']) : ''); ?></td>
                        </tr>
                    </table>
                </div>
                <?php if ($marital_status == VALUE_ONE && ($constitution_artical == VALUE_ONE)) { ?>
                    <div style="margin-top: 20px;">
                        <b style="font-size: 14px;">Spouse Information</b>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                            <tr>
                                <td class="f-w-b">Spouse Name</td>
                                <td><?php echo $spouse_data['spouse_name']; ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Nationality</td>
                                <td style="vertical-align: top;"><?php echo $spouse_data['spouse_nationality']; ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Birth Place</td>
                                <td><?php echo $spouse_data['spouse_born_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_born_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_born_place_village_text']; ?></td>
                            </tr>

                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td><?php echo $spouse_data['spouse_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_village_text']; ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Spouse Religion / Cast / Sub Cast</td>
                                <td><?php echo $spouse_data['spouse_religion'] . ' / ' . $spouse_caste_text . ' / ' . $spousesubcaste_name_text_for_caste; ?></td>
                            </tr>

                            <tr>
                                <td class="f-w-b">Occupation</td>
                                <td><?php echo ((isset($applicant_occupation_array[$spouse_data['spouse_occupation']]) ? ($spouse_data['spouse_occupation'] == VALUE_TWELVE ? $spouse_data['spouse_other_occupation'] : $applicant_occupation_array[$spouse_data['spouse_occupation']]) : '-')); ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Aadhar Number</td>
                                <td><?php echo ($spouse_data['spouse_aadhaar'] != '' ? ($spouse_data['spouse_aadhaar']) : ''); ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Election Number</td>
                                <td><?php echo ($spouse_data['spouse_election_no'] != '' ? ($spouse_data['spouse_election_no']) : ''); ?></td>
                            </tr>
                        </table>
                    </div>
                <?php } ?>

                <table class="app-form-income" style="font-size: 13px; margin-top: 20px;">
                    <?php if ($im_member_of_scst == VALUE_ONE) { ?>
                        <tr>
                            <td class="f-w-b" style="width: 50%;">Membership Detail of Scheduled Caste/ tribe or community classified by Govt.</td>
                            <td style="vertical-align: top;"><?php echo $detail_of_membership_scst; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class="f-w-b" style="width: 50%;">For What Purpose is the Certificate of Caste Required</td>
                        <td style="vertical-align: top;"><?php echo $purpose_of_caste_certificate; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b" style="width: 50%;">Previously Date of Caste/Tribe Certificate</td>
                        <td style="vertical-align: top;"><?php echo convert_to_new_date_format($applied_date) . ' / ' . $year_of_applied_certy; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b" style="width: 40%;">My father/ Husband/ Wife hold Caste/Tribe Certificate details of the same are as under</td>
                        <td><?php echo convert_to_new_date_format($applied_date_of_hold_certy) . ' / ' . $year_of_applied_hold_certy; ?></td>
                    </tr>
                </table>
            </div>
            <div>
                <pagebreak></pagebreak>
            </div>

            <div style="font-size: 13px;">
                <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <!-- I the undersigned Shri / Smt. / Kum. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_name . '&nbsp;'; ?></span>
                    aged about  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_age . '&nbsp;'; ?></span> ,Years, -->

                    I the undersigned Shri / Smt. / Kum. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_name . '&nbsp;'; ?></span>
                    <?php if ($constitution_artical == VALUE_TWO) { ?>
                        aged
                    <?php } else { ?>
                        aged about <span class="b-b-1px f-w-b t-d-u"><?php echo '&nbsp;' . $applicant_age . '&nbsp;'; ?></span></span>Years.
                    <?php } ?>

                    <?php if ($constitution_artical == VALUE_ONE) { ?> Marital Status :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $marital_status_text . '&nbsp;'; ?></span>
                        resident of :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $com_addr_house_no . '&nbsp;' . $com_addr_house_name . '&nbsp;' . $com_addr_street . '&nbsp;' . $com_addr_city . '&nbsp;' ?></span>, of <?php echo $taluka_name_text; ?> District.
                    <?php } else { ?>
                        resident of :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $com_addr_house_no . '&nbsp;' . $com_addr_house_name . '&nbsp;' . $com_addr_street . '&nbsp;' . $com_addr_city . '&nbsp;' ?></span>, of <?php echo $taluka_name_text; ?> District. That I am applied for my Minor Child <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $minor_child_name . '&nbsp;'; ?></span><?php } ?></div>


                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        1. That my name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $applicant_name . '&nbsp;'; ?></span><?php } else { ?>
                        1. That my Child name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $minor_child_name . '&nbsp;'; ?></span><?php } ?>.</div>

                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    2. That I was born at Village &nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_place_village_text; ?></span>&nbsp;District&nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_place_district_text; ?></span>&nbsp;State&nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $born_place_district_text; ?></span> on <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . convert_to_new_date_format($applicant_dob) . '&nbsp;'; ?></span> and permanent resident at <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $per_addr_house_no . '&nbsp;' . $per_addr_house_name . '&nbsp;' . $per_addr_street . '&nbsp;' . $per_addr_city . '&nbsp;' . $per_pincode; ?></span>&nbsp;Since</div>

                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    3.  That my Original Native is Village &nbsp;<span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $native_place_village_text; ?></span>&nbsp; District &nbsp;<span class="b-b-1px f-w-b">
                        <?php
                        echo $native_place_district_text;
                        ?></span>&nbsp; State&nbsp; <span class="b-b-1px f-w-b">
                        <?php
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
                    6.   That I was studied in the School / College <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . isset($education_array[$applicant_education]) ? $education_array[$applicant_education] : '-'; ?></span> at <?php echo $taluka_name_text; ?> District.
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
                        <?php echo '&nbsp;' . $father_data['father_native_place_district_text']; ?></span> City <span class="b-b-1px f-w-b"><?php echo $father_data['father_native_place_city_text']; ?></span>.
                </div>

                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    10.   He is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_nationality']; ?></span> National. He is holding Election Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_election_no']; ?></span> & Aadhar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_aadhaar']; ?></span> of <?php echo $taluka_name_text; ?> District. That his profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_occupation_text; ?></span> and he is belongs to <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $fathersubcaste_name_text_for_caste; ?></span> Caste and Religion <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $father_data['father_religion']; ?></span>. 
                </div>

                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    11.  That my mother name is  <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_name']; ?></span></br>
                    She was born at Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_native_place_state_text']; ?></span> Since.
                </div>

                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    12.  She is Original Native of Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_native_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_native_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_native_place_state_text']; ?></span>.
                </div>

                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    13.  She is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_nationality']; ?></span> National. He is holding Election Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_election_no']; ?></span> & Aadhar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_data['mother_aadhaar']; ?></span> of <?php echo $taluka_name_text; ?> District. That his profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_occupation_text; ?></span> and he is belongs to <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mothersubcaste_name_text_for_caste; ?></span> Caste and Religion <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $mother_religion; ?></span>. 
                </div>

                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    14.   That my Grandfather name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_name']; ?></span></br>
                    He was born at Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_village_text']; ?></span> District <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_district_text']; ?></span> State <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_born_place_state_text']; ?></span> Since.
                </div>

                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    15.   His Original Native is Village <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_native_place_village_text']; ?></span>  District <span class="b-b-1px f-w-b">
                        <?php echo '&nbsp;' . $grandfather_data['grandfather_native_place_district_text']; ?></span> City <span class="b-b-1px f-w-b"><?php echo $grandfather_data['grandfather_native_place_district_text']; ?></span>.
                </div>

                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    16.   He is <span class="b-b-1px f-w-b"><?php echo $grandfather_data['grandfather_nationality']; ?></span> National. He is holding Election Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_election_no']; ?></span> & Aadhar Card No. <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_data['grandfather_aadhaar']; ?></span> of Daman District. That his profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_occupation_text; ?></span> and he is belongs to <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfathersubcaste_name_text_for_caste; ?></span> Caste and Religion <span class="b-b-1px f-w-b"><?php echo '&nbsp;' . $grandfather_religion; ?></span>. 
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


        </div>

        <table style="margin-top: 10px; width: 100%;">
            <tr>
                <td style="vertical-align: top; width: 33%;">
                    <b>Place&nbsp; :-</b> <?php echo $taluka_name; ?><br>
                    <b>Dated :-</b> <?php echo convert_to_new_date_format($submitted_datetime); ?>
                </td>
                <!-- <td class="t-a-c" style="width: 25%;">
                    <img src='<?php //echo CASTE_CERTIFICATE_DOC_PATH . $applicant_photo_doc;  ?>'
                         style="width: 110px; height: 130px; border: 1px solid;" />
                </td>
                <td class="t-a-c" style="width: 25%;">
                    <img src='<?php //echo CASTE_CERTIFICATE_DOC_PATH . $minor_child_photo_doc;  ?>'
                         style="width: 110px; height: 130px; border: 1px solid;" />
                </td> -->

                <td class="t-a-c" style="width: 25%;">
                    <table style="margin-top: 10px; width: 100%;">
                        <tr>
                            <td>
                                <img src='<?php echo CASTE_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'style="width: 110px; height: 130px; border: 1px solid;" />
                            </td>
                            <?php if ($constitution_artical == VALUE_TWO && $minor_child_photo_doc != '') { ?>
                                <td>
                                    <img src='<?php echo CASTE_CERTIFICATE_DOC_PATH . $minor_child_photo_doc; ?>' style="width: 110px; height: 130px; border: 1px solid;" />
                                </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Applicant Name : <?php echo $applicant_name; ?></td>
                            <?php if ($constitution_artical == VALUE_TWO) { ?>
                                <td>Minor child Name : <?php echo $minor_child_name; ?></td>
                            <?php } ?>
                        </tr>
                    </table> 
                </td>
                <td class="t-a-c" style="width: 42%;">
                    <div>
                        This receipt is electronically generated and no signature is required.
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
    </div>
</body>
</html>
