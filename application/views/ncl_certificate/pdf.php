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
            .t-a-r{
                text-align: right;
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
        $taluka_array_guj = $this->config->item('taluka_array_guj');
        $gender_array = $this->config->item('gender_array');
        $yes_no_array = $this->config->item('yes_no_array');
        $religion_array = $this->config->item('religion_array');
        $applicant_obccaste_array = $this->config->item('applicant_obc_caste_array');
        //   $applicant_st_subcaste_array = $this->config->item('applicant_st_subcaste_array');
        $relation_deceased_person_array = $this->config->item('relation_deceased_person_array');

        $state_array = $this->config->item('state_array');
        $damandiudistrict_array = $this->config->item('daman_diu_district_array');
        $dnhdistrict_array = $this->config->item('dnh_district_array');
        $damanvillageForNative_array = $this->config->item('daman_village_array_for_native');
        $diuvillagesForNative_array = $this->config->item('diu_village_array_for_native');
        $dnhvillagesForNative_array = $this->config->item('dnh_village_array_for_native');

        $taluka_name = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        $taluka_name_guj = isset($taluka_array_guj[$district]) ? $taluka_array_guj[$district] : '-';
        if ($district == TALUKA_DAMAN) {
            $village_name_text = (isset($daman_villages_array[$village_name]) ? $daman_villages_array[$village_name] : '');

            $village_name_text_for_native = (isset($damanvillageForNative_array[$native_place_village]) ? $damanvillageForNative_array[$native_place_village] : '');

            $father_village_name_text_for_native = (isset($daman_villages_array[$father_native_place_village]) ? $daman_villages_array[$father_native_place_village] : '');

            $grandfather_village_name_text_for_native = (isset($damanvillageForNative_array[$grandfather_native_place_village]) ? $damanvillageForNative_array[$grandfather_native_place_village] : '');
            $mother_village_name_text_for_native = (isset($damanvillageForNative_array[$mother_native_place_village]) ? $damanvillageForNative_array[$mother_native_place_village] : '');
            $spouse_village_name_text_for_native = (isset($damanvillageForNative_array[$spouse_native_place_village]) ? $damanvillageForNative_array[$spouse_native_place_village] : '');
            $occupation_text = (isset($applicant_occupation_array[$occupation]) ? ($occupation == VALUE_TWELVE ? $applicant_other_occupation : $applicant_occupation_array[$occupation]) : '-');
            $father_occupation_text = (isset($applicant_occupation_array[$father_occupation]) ? ($father_occupation == VALUE_TWELVE ? $father_other_occupation : $applicant_occupation_array[$father_occupation]) : '-');
            $mother_occupation_text = (isset($applicant_occupation_array[$mother_occupation]) ? ($mother_occupation == VALUE_TWELVE ? $mother_other_occupation : $applicant_occupation_array[$mother_occupation]) : '-');
            $grandfather_occupation_text = (isset($applicant_occupation_array[$grandfather_occupation]) ? ($grandfather_occupation == VALUE_TWELVE ? $grandfather_other_occupation : $applicant_occupation_array[$grandfather_occupation]) : '-');
            $spouse_occupation_text = (isset($applicant_occupation_array[$spouse_occupation]) ? ($spouse_occupation == VALUE_TWELVE ? $spouse_other_occupation : $applicant_occupation_array[$spouse_occupation]) : '-');
        } else if ($district == TALUKA_DIU) {
            $village_name_text = (isset($diu_villages_array[$village_name]) ? $diu_villages_array[$village_name] : '');

            $village_name_text_for_native = (isset($diuvillagesForNative_array[$native_place_village]) ? $diuvillagesForNative_array[$native_place_village] : '');
            $father_village_name_text_for_native = (isset($diuvillagesForNative_array[$father_native_place_village]) ? $diuvillagesForNative_array[$father_native_place_village] : '');
            $grandfather_village_name_text_for_native = (isset($diuvillagesForNative_array[$grandfather_native_place_village]) ? $diuvillagesForNative_array[$grandfather_native_place_village] : '');
            $mother_village_name_text_for_native = (isset($diuvillagesForNative_array[$mother_native_place_village]) ? $diuvillagesForNative_array[$mother_native_place_village] : '');
            $spouse_village_name_text_for_native = (isset($diuvillagesForNative_array[$spouse_native_place_village]) ? $diuvillagesForNative_array[$spouse_native_place_village] : '');
        } else if ($district == TALUKA_DNH) {
            $village_name_text = (isset($dnh_villages_array[$village_name]) ? $dnh_villages_array[$village_name] : '');

            $village_name_text_for_native = (isset($dnhvillagesForNative_array[$native_place_village]) ? $dnhvillagesForNative_array[$native_place_village] : '');
            $father_village_name_text_for_native = (isset($dnhvillagesForNative_array[$father_native_place_village]) ? $dnhvillagesForNative_array[$father_native_place_village] : '');
            $grandfather_village_name_text_for_native = (isset($dnhvillagesForNative_array[$grandfather_native_place_village]) ? $dnhvillagesForNative_array[$grandfather_native_place_village] : '');
            $mother_village_name_text_for_native = (isset($dnhvillagesForNative_array[$mother_native_place_village]) ? $dnhvillagesForNative_array[$mother_native_place_village] : '');
            $spouse_village_name_text_for_native = (isset($dnhvillagesForNative_array[$spouse_native_place_village]) ? $dnhvillagesForNative_array[$spouse_native_place_village] : '');
        }

        $family_details_text = $family_details ? json_decode($family_details, true) : array();

        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');

        $state_name_text_for_native = (isset($state_array[$native_place_state]) ? $state_array[$native_place_state] : '');
        $father_state_name_text_for_native = (isset($state_array[$father_native_place_state]) ? $state_array[$father_native_place_state] : '');
        $mother_state_name_text_for_native = (isset($state_array[$mother_native_place_state]) ? $state_array[$mother_native_place_state] : '');
        $spouse_state_name_text_for_native = (isset($state_array[$spouse_native_place_state]) ? $state_array[$spouse_native_place_state] : '');

        $gender_text = (isset($gender_array[$gender]) ? $gender_array[$gender] : '-');
        //$relationship_of_applicant_text = (isset($relationship_of_applicant_array[$relationship_of_applicant]) ? $relationship_of_applicant_array[$relationship_of_applicant] : '-');
        $relation_deceased_person_text = (isset($relation_deceased_person_array[$relationship_of_applicant]) ? $relation_deceased_person_array[$relationship_of_applicant] : '');

        $obccaste_text = $applicant_obccaste_array[$obccaste];
        $fatherobccaste_text = $applicant_obccaste_array[$father_caste];
        $motherbccaste_text = $applicant_obccaste_array[$mother_caste];
        $grandfatherobccaste_text = $applicant_obccaste_array[$grandfather_caste];
        $spouceobccaste_text = $applicant_obccaste_array[$spouse_caste];

        $district_name_text_for_native = $native_place_state == VALUE_ONE ? $damandiudistrict_array[$native_place_district] : ($native_place_state == VALUE_TWO ? $dnhdistrict_array[$native_place_district] : []);
        $district_name_text_for_native = $born_place_state == VALUE_ONE ? $damandiudistrict_array[$born_place_district] : ($born_place_state == VALUE_TWO ? $dnhdistrict_array[$born_place_district] : []);
        $father_district_name_text_for_native = $father_native_place_state == VALUE_ONE ? $damandiudistrict_array[$father_native_place_district] : ($father_native_place_state == VALUE_TWO ? $dnhdistrict_array[$father_native_place_district] : []);
        $mother_district_name_text_for_native = $mother_native_place_state == VALUE_ONE ? $damandiudistrict_array[$mother_native_place_district] : ($mother_native_place_state == VALUE_TWO ? $dnhdistrict_array[$mother_native_place_district] : []);
        $spouse_district_name_text_for_native = $spouse_native_place_state == VALUE_ONE ? $damandiudistrict_array[$spouse_native_place_district] : ($spouse_native_place_state == VALUE_TWO ? $dnhdistrict_array[$spouse_native_place_district] : []);
        $religion = isset($religion_array[$religion]) ? $religion_array[$religion] : '-';

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
            <div class="l-s" style="padding-left: 70%;">તારીખ :-  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span></div>
            <br>
            <div class="l-s l-h" style="height: 90px;">
                મહેરબાન મામલતદાર સાહેબ,<br/><?php echo $taluka_name_guj; ?>
            </div>
            <div class="l-s l-h" style="height: 90px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    આપ સાહેબના પત્ર નં. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $application_number . '&nbsp;&nbsp;&nbsp;'; ?></span> તા:- 
                    <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                    નાં અનુસંધાનમાં જણાવવાનું  કે   શ્રી/શ્રીમતી/કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,તેઓના પુત્ર/પુત્રી  -                                                    
                    રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . '&nbsp;&nbsp;&nbsp;'; ?></span>એ ઓ.બી.સી. સર્ટીફિકેટ માટે અરજી કરેલ છે.<br/>

                <?php } else { ?>
                    આપ સાહેબના પત્ર નં. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $application_number . '&nbsp;&nbsp;&nbsp;'; ?></span> તા:- 
                    <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                    નાં અનુસંધાનમાં જણાવવાનું  કે   શ્રી/શ્રીમતી/કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,તેઓના પુત્ર/પુત્રી  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $minor_child_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,                                                   
                    રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . '&nbsp;&nbsp;&nbsp;'; ?></span>એ નોન ક્રીમીલેયર સર્ટીફિકેટ માટે અરજી કરેલ છે.<br/> 
                <?php } ?>


                ૧. મારો જન્મ સ્થળ મોજે :- <span class="b-b-1px f-w-b"><?php
                    echo '&nbsp;&nbsp;&nbsp;' .
                    $born_place_village_text . '&nbsp;&nbsp;&nbsp;';
                    ?></span> તાલુકા  <span class="b-b-1px f-w-b"><?php ?><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>

             <!--    ૨. અરજદારનું નામ રાશન કાર્ડ નંબર  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_religion . '&nbsp;&nbsp;&nbsp;' . $subcaste_name_text_for_caste . '&nbsp;&nbsp;&nbsp;'; ?></span>માં નોધાયેલ છે.<br/> -->



                ૨.  
                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    અરજદાર
                <?php } else { ?>
                    અરજદારની પુત્ર / પુત્રી
                <?php } ?> જાતે  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $religion . '&nbsp;' . $other_religion . '&nbsp;' . $obccaste_text . '&nbsp;&nbsp;&nbsp;'; ?></span> છે. તેમજ એમના માં-બાપ પણ જાતે   <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $religion . '&nbsp;' . $other_religion . '&nbsp;' . $fatherobccaste_text . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>

                ૩. 
                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    અરજદાર
                <?php } else { ?>
                    અરજદારની પુત્ર / પુત્રી
                <?php } ?> ના  પિતાના નામે ખેતીની જમીન <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . (isset($family_details_text['father_details']) ? $family_details_text['father_details'] : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span> નોધાયેલ છે/નથી.<br/>



                <?php if ($occupation == VALUE_FIVE) { ?>

                    ૪. 
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        અરજદાર
                    <?php } else { ?>
                        અરજદારની પુત્ર / પુત્રી
                    <?php } ?> સરકારી નોકરી કરે છે<br/>

                <?php } else { ?>

                    ૪. 
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        અરજદાર
                    <?php } else { ?>
                        અરજદારની પુત્ર / પુત્રી
                    <?php } ?> સરકારી નોકરી કરતા નથી .<br/>

                <?php }
                ?>


                ૫. 
                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    અરજદાર
                <?php } else { ?>
                    અરજદારની પુત્ર / પુત્રી
                <?php } ?> કૂટુંબના કમાવા વાળા સભયો તેમજ ફેમેલી મેમ્બરો નીચે પ્રમાણે છે. <br/>


                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    ૬. મારી વાર્ષિક આવક<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $annual_income . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>
                <?php } ?> 


                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    ૭. મારા
                <?php } else { ?>
                    ૬. અરજદારની પુત્ર / પુત્રી
                <?php } ?>ના પિતાની વાર્ષિક આવક<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_annual_salary . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>



                <?php if ($mother_occupation == VALUE_FOUR) { ?>


                <?php } else { ?>

                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        ૮. મારા
                    <?php } else { ?>
                        અરજદારની પુત્ર / પુત્રી
                    <?php } ?>ના માતાની વાર્ષિક આવક<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_annual_salary . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>


                <?php } ?>


                <?php if ($marital_status == VALUE_ONE && ($constitution_artical == VALUE_ONE)) { ?>

                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        ૯. મારા
                    <?php } else { ?>
                        અરજદારની પુત્ર / પુત્રી
                    <?php } ?>ના પતિ/પત્ની વાર્ષિક આવક<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_annual_salary . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>

                <?php } ?>    


                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    ૧૦.  જેઓની વાર્ષિક આવક રૂ  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $annual_income + $family_annual_income . '&nbsp;&nbsp;&nbsp;'; ?></span> /- જેટલી થાય છે.
                <?php } else { ?>


                   ૭. જેઓની વાર્ષિક આવક રૂ  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $family_annual_income . '&nbsp;&nbsp;&nbsp;'; ?></span> /- જેટલી થાય છે.

                <?php } ?>

                <div class="l-s" style="margin-top: 20px;">
                    આ સર્ટીફીકેટનો ઉપયોગ  <span class="b-b-1px f-w-b">  </span>  માટે રજુ કરનાર છે. 
                </div>

                <div class="l-s" style="margin-top: 10px;">
                    <b>હું આ સાથે 
                        <?php
                        if ($aadhar_card_doc != '') {
                            echo 'આધાર કાર્ડ';
                        }if ($self_birth_certificate_doc != '') {
                            echo ', બર્થ સર્ટીફિકેટ';
                        }if ($leaving_certificate_doc != '') {
                            echo ', લિવિંગ સર્ટીફિકેટ';
                        }if ($obc_certificate_doc != '') {
                            echo ', ઓ.બી.સી. સર્ટીફિકેટ';
                        }if ($income_certificate != '') {
                            echo ', આવક સર્ટીફિકેટ';
                        }
                        ?>  વિગેરે રજૂ કરું છુ</b>
                </div>
                <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%;">&nbsp;</div>
                <div class="l-s">
                    જે આપ સાહેબને વિદિત થાય.
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
                        રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                        આજરોજ તલાટી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $village_name_text_seja . '&nbsp;&nbsp;&nbsp;'; ?></span> 
                        સેજા રૂબરૂ હાજર થઇ પૂછવાથી લખાવું છું કે 
                    <?php } else { ?>

                        હું નીચે સહી કરનાર શ્રી / શ્રીમતી / કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                        ઉંમરલાયક , મારા/પુત્ર/પુત્રી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $minor_child_name . '&nbsp;&nbsp;&nbsp;'; ?></span>, 
                        રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                        આજરોજ તલાટી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $village_name_text_seja . '&nbsp;&nbsp;&nbsp;'; ?></span> 
                        સેજા રૂબરૂ હાજર થઇ પૂછવાથી લખાવું છું કે 
                    <?php } ?>

                </div>




                ૧. મારો  જન્મ મોજે :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span>  તાલુકા  <span class="b-b-1px f-w-b"><?php ?><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>છે.<br/>

        <!--    ૨. મારું નામ રાશન કાર્ડ નંબર <span class="b-b-1px f-w-b">-</span> માં નોધાયેલ છે.<br/> -->

                ૨. હું જાતે હિન્દુ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_religion . '&nbsp;&nbsp;&nbsp;' . $obccaste_text . '&nbsp;&nbsp;&nbsp;'; ?></span>છુ. તેમજ મારા માં-બાપ પણ જાતે હિન્દુ  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $religion . '&nbsp;' . $other_religion . '&nbsp;' . $fatherobccaste_text . '&nbsp;&nbsp;&nbsp;'; ?></span>છે. <!-- મારા પિતા જન્મ થી મૂળવતની  <span class="b-b-1px f-w-b"><?php //echo '&nbsp;&nbsp;&nbsp;' . $father_village_name_text_for_native . '&nbsp;&nbsp;&nbsp;';         ?></span>ના છે. તેમજ મારા માતા મૂળવતની <span class="b-b-1px f-w-b"><?php //echo '&nbsp;&nbsp;&nbsp;' . $mother_native_village_name . '&nbsp;&nbsp;&nbsp;';         ?></span>છે. --> <br/>

                ૩. મારા પિતા/માતાના નામે ખેતીની જમીન મોજે   <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_land . '&nbsp;&nbsp;&nbsp;'; ?></span>ગામે આવેલ છે. જે બિન પિયત / પિયતની છે.<br/>

                <?php if ($father_occupation == VALUE_FIVE || $mother_occupation == VALUE_FIVE) { ?>

                    ૪. મારા પિતા/માતા સરકારી નોકરી કરે છે<br/>

                <?php } else { ?>

                    ૪. મારા પિતા/માતા સરકારી નોકરી કરતા નથી. .<br/>

                <?php }
                ?>

                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    ૫. મારી વાર્ષિક આવક<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $annual_income . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>
                <?php } ?>

                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    ૬. <?php } else { ?> ૫. <?php } ?>
              
                મારા કૂટુંબના સભ્યોની વાર્ષિક આવક રૂ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $family_annual_income . ' /- ' . '&nbsp;&nbsp;&nbsp;'; ?></span> જેટલી થાય છે.<br/>

               <?php if ($constitution_artical == VALUE_ONE) { ?>
                    ૭. કુલ વાર્ષિક આવક<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $annual_income + $family_annual_income . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>
                <?php } ?>
                    
                <div class="l-s" style="margin-top: 20px;">
                    આ સર્ટીફીકેટનો ઉપયોગ  <span class="b-b-1px f-w-b"> </span>  માટે રજુ કરનાર છે. 
                </div>
                <div class="l-s" style="margin-top: 10px;"> 
                    હું આ સાથે 
                    <?php
                    if ($aadhar_card_doc != '') {
                        echo 'આધાર કાર્ડ';
                    }if ($self_birth_certificate_doc != '') {
                        echo ', બર્થ સર્ટીફિકેટ';
                    }if ($leaving_certificate_doc != '') {
                        echo ', લિવિંગ સર્ટીફિકેટ';
                    }if ($obc_certificate_doc != '') {
                        echo ', ઓ.બી.સી. સર્ટીફિકેટ';
                    }if ($income_certificate != '') {
                        echo ', આવક સર્ટીફિકેટ';
                    }
                    ?>
                    વિગેરે રજૂ કરું છુ.
                </div>
                <div class="l-s" style="margin-top: 10px;">
                    સ્થળ &nbsp; :- <span class="f-w-b"><?php echo $taluka_name; ?></span><br>

                    તારીખ :-  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                </div>
                <div class="l-s" style="margin-top: -23px; margin-left: 300px;">
                    રૂબરૂ 
                </div>
                <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%; margin-top: -40px;">&nbsp;</div>
                <div class="l-s" style="padding-left: 70%; margin-top: 0px;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text_seja; ?></span> , દમણ સેજા</div>
                <div style="border-bottom: 1px dashed; margin-top: 10px;">&nbsp;</div>

            </div>
            <div>
                <pagebreak></pagebreak>
            </div>
            <div style="font-size: 13px;">
                <div class="f-s-title t-a-c l-s"><span class="f-w-b">Application For NCL (OBC Renewal) Certificate</span></div>
                <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                    <tr>
                        <td class="f-w-b" width="40%">Application Number</td>
                        <td><?php echo $application_number; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">District</td>
                        <td><?php echo $taluka_name; ?></td>
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
                            <td class="f-w-b">Gaurdian Name</td>
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

                    </table>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 20px;">
<?php } ?>
<?php if ($constitution_artical == VALUE_TWO) { ?>
                        <tr>
                            <td class="f-w-b" width="40%">Name of Minor Child</td>
                            <td><?php echo $minor_child_name; ?></td>
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
                            <td class="f-w-b">Guardian’s Aadhaar Number</td>
                            <td><?php echo $guardian_aadhaar; ?></td>
                        </tr>
<?php } ?>
                    <tr>
                        <td class="f-w-b">Communication Address</td>
                        <td><?php echo $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city; ?></td>
                    </tr>
<?php if ($constitution_artical == VALUE_ONE) { ?>
                        <tr>
                            <td class="f-w-b">Permanent Address</td>
                            <td><?php echo $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city; ?></td>
                        </tr>
<?php } else { ?>
                        <tr>
                            <td class="f-w-b">Permanent Address</td>
                            <td><?php echo $per_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $per_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $per_addr_street . '&nbsp;&nbsp;&nbsp;' . $per_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $per_addr_city; ?></td>
                        </tr>
<?php } ?>
                    <tr>
                        <td class="f-w-b">Mobile Number / Aadhaar Number</td>
                        <td><?php echo $mobile_number . ($aadhaar != '' ? (' / ' . $aadhaar) : ''); ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Gender / Date of Birth / Age <br> Birth Place <br> Native Place</td>
                        <td><?php echo (isset($gender_array[$gender]) ? $gender_array[$gender] : ' - ') . ' / ' . convert_to_new_date_format($applicant_dob) . ' / ' . $applicant_age . ' Years <br>' . $born_place_state_text . ',' . $born_place_district_text . ',' . $born_place_village_text . '<br>' . $native_place_state_text . ',' . $native_place_district_text . ',' . $native_place_village_text; ?></td>
                    </tr>
<?php if ($constitution_artical == VALUE_ONE) { ?>
                        <tr>
                            <td class="f-w-b">Marital Status</td>
                            <td><?php echo $marital_status_text; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Applicant Election Number</td>
                            <td><?php echo $election_no; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Email Address</td>
                            <td><?php echo $email; ?></td>
                        </tr>
<?php } ?>
                    <tr>
                        <td class="f-w-b">Caste / Religion</td>
                        <td style="vertical-align: top;"><?php echo $obccaste_text; ?> / <?php echo $religion; ?>&nbsp;<?php echo $other_religion; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Nationality</td>
                        <td style="vertical-align: top;"><?php echo $applicant_nationality; ?></td>
                    </tr>
<?php if ($constitution_artical == VALUE_ONE) { ?>
                        <tr>
                            <td class="f-w-b">Occupation</td>
                            <td><?php echo ((isset($applicant_occupation_array[$occupation]) ? ($occupation == VALUE_TWELVE ? $other_occupation : $applicant_occupation_array[$occupation]) : '-')); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Applicant Annual Income</td>
                            <td><?php echo ' ₹ ' . $annual_income . ' /- '; ?></td>
                        </tr>
<?php } ?>
                    <tr>
                        <td class="f-w-b">Family Annual Income</td>
                        <td><?php echo ' ₹ ' . $family_annual_income . ' /- '; ?></td>
                    </tr>
<?php if ($constitution_artical == VALUE_ONE) { ?>
                        <tr>
                            <td class="f-w-b">Total Annual Income</td>
                            <td><?php echo ' ₹ ' . $annual_income + $family_annual_income . ' /- '; ?></td>
                        </tr>
<?php } ?>
                    <tr>
                        <td class="f-w-b">Education</td>
                        <td><?php echo $applicant_education; ?></td>
                    </tr>
<?php if ($constitution_artical == VALUE_ONE) { ?>
                        <tr>
                            <td class="f-w-b">Name of School / Collage / Institute</td>
                            <td><?php echo $name_of_school; ?></td>
                        </tr>
<?php } ?>
                    <tr>
                        <td class="f-w-b">Father Name</td>
                        <td><?php echo $father_name; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Father Occupation</td>
                        <td><?php echo ((isset($applicant_occupation_array[$father_occupation]) ? ($father_occupation == VALUE_TWELVE ? $father_other_occupation : $applicant_occupation_array[$father_occupation]) : '-')); ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Mother Name</td>
                        <td><?php echo $mother_name; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Mother Occupation</td>
                        <td><?php echo ((isset($applicant_occupation_array[$mother_occupation]) ? ($mother_occupation == VALUE_TWELVE ? $mother_other_occupation : $applicant_occupation_array[$mother_occupation]) : '-')); ?></td>
                    </tr>
                </table>
                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Members Details</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <thead>
                            <tr>
                                <td class="f-w-b">Sr.No.</td>
                                <td class="f-w-b">Source of Income</td>
                                <td class="f-w-b">Name</td>
                                <td class="f-w-b">Type of Org. (Govt/Pvt) Profession/Trae/Business/<br>Agriculture</td>
                                <td class="f-w-b">Name of Organization/ Department</td>
                                <td class="f-w-b">Designation/Post Held</td>
                                <td class="f-w-b">Scale of Pay</td>
                                <td class="f-w-b">Date of Appointment</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Father</td>
                                <td><?php echo $father_name; ?></td>
                                <td><?php echo $father_organization_type; ?></td>
                                <td><?php echo $father_organization_name; ?></td>
                                <td><?php echo $father_designation; ?></td>
                                <td><?php echo $father_scale_pay; ?></td>
                                <td><?php echo $father_appointment_date; ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mother</td>
                                <td><?php echo $mother_name; ?></td>
                                <td><?php echo $mother_organization_type; ?></td>
                                <td><?php echo $mother_organization_name; ?></td>
                                <td><?php echo $mother_designation; ?></td>
                                <td><?php echo $mother_scale_pay; ?></td>
                                <td><?php echo $mother_appointment_date; ?></td>
                            </tr>
<?php if ($marital_status == VALUE_ONE && ($constitution_artical == VALUE_ONE)) { ?>
                                <tr>
                                    <td>3</td>
                                    <td>Spouse</td>
                                    <td><?php echo $spouse_name; ?></td>
                                    <td><?php echo $spouse_organization_type; ?></td>
                                    <td><?php echo $spouse_organization_name; ?></td>
                                    <td><?php echo $spouse_designation; ?></td>
                                    <td><?php echo $spouse_scale_pay; ?></td>
                                    <td><?php echo $spouse_appointment_date; ?></td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Details</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <thead>
                            <tr>
                                <td class="f-w-b" >Sr.No.</td>
                                <td class="f-w-b">Source of Income</td>
                                <td class="f-w-b">Occupation</td>
                                <td class="f-w-b">Gross annual Salary / Amount </td>
                                <td class="f-w-b">Income from other sources </td>
                                <td class="f-w-b">Total </td>
                                <td class="f-w-b">Remarks </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Father</td>
                                <td><?php echo ((isset($applicant_occupation_array[$father_occupation]) ? ($father_occupation == VALUE_TWELVE ? $father_other_occupation : $applicant_occupation_array[$father_occupation]) : '-')); ?></td>
                                <td class="t-a-r"><?php echo $father_annual_salary . ' /- '; ?></td>
                                <td class="t-a-r"><?php echo $father_other_income_sources . ' /- '; ?></td>
                                <td class="t-a-r"><?php echo $father_total . ' /- '; ?></td>
                                <td><?php echo $father_remarks; ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mother</td>
                                <td><?php echo ((isset($applicant_occupation_array[$mother_occupation]) ? ($mother_occupation == VALUE_TWELVE ? $mother_other_occupation : $applicant_occupation_array[$mother_occupation]) : '-')); ?></td>
                                <td class="t-a-r"><?php echo $mother_annual_salary . ' /- '; ?></td>
                                <td class="t-a-r"><?php echo $mother_other_income_sources . ' /- '; ?></td>
                                <td class="t-a-r"><?php echo $mother_total . ' /- '; ?></td>
                                <td><?php echo $mother_remarks; ?></td>
                            </tr>
<?php if ($marital_status == VALUE_ONE && ($constitution_artical == VALUE_ONE)) { ?>
                                <tr>
                                    <td>3</td>
                                    <td>Spouse</td>
                                    <td><?php echo ((isset($applicant_occupation_array[$spouse_occupation]) ? ($spouse_occupation == VALUE_TWELVE ? $spouse_other_occupation : $applicant_occupation_array[$spouse_occupation]) : '-')); ?></td>
                                    <td class="t-a-r"><?php echo $spouse_annual_salary . ' /- '; ?></td>
                                    <td class="t-a-r"><?php echo $spouse_other_income_sources . ' /- '; ?></td>
                                    <td class="t-a-r"><?php echo $spouse_total . ' /- '; ?></td>
                                    <td><?php echo $spouse_remarks; ?></td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;"> More Details</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td style="width: 85%;">Percentage of irrigated land holding to statutory ceiling limit under state and ceiling laws</td>
                            <td><?php echo $percentageofland; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 85%;">If land holding is both irrigated and un-irrigated land holding on the basis of conversion formula in state land ceiling law</td>
                            <td><?php echo $landceiling; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 85%;">Percentage of total irrigated land holding to statutory ceiling limit as Per(V)</td>
                            <td><?php echo $landceilinglimit; ?></td>
                        </tr>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Plantation</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tbody>
                            <tr>
                                <td>a</td>
                                <td style="width: 50%;">Crops / Fruit</td>
                                <td style="width: 50%;"><?php echo $cropsfruit; ?></td>
                            </tr>
                            <tr>
                                <td>b</td>
                                <td>Location</td>
                                <td><?php echo $location; ?></td>
                            </tr>
                            <tr>
                                <td>c</td>
                                <td>Area of Plantation</td>
                                <td><?php echo $areaofplantation; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">More Details</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tbody>
                            <tr>
                                <td>a</td>
                                <td style="width: 50%;">Location of Property</td>
                                <td style="width: 50%;"><?php echo $locationpoperty; ?></td>
                            </tr>
                            <tr>
                                <td>b</td>
                                <td>Details of Property</td>
                                <td><?php echo $detailproperty; ?></td>
                            </tr>
                            <tr>
                                <td>c</td>
                                <td>Use to which it is put</td>
                                <td><?php echo $usetowhich; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class="f-w-b" style="width: 40%;">Weather Tax Payer</td>
                            <td><?php echo $tax_payer == VALUE_ONE ? 'YES' : 'NO'; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Weather covered in wealth Tax Act</td>
                            <td><?php echo $wealth_tax == VALUE_ONE ? 'YES' : 'NO'; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b"> If so Furnished Details</td>
                            <td><?php echo $furnished_detail; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Applicant First OBC Certificate No.</td>
                            <td><?php echo $obc_certificate_no; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Applicant First OBC Certificate Date</td>
                            <td><?php echo convert_to_new_date_format($obc_certificate_date); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Income Certificate No.</td>
                            <td><?php echo $income_certificate_no; ?></td>                            
                        </tr>
                        <tr>
                            <td class="f-w-b">Income Certificate Date</td>
                            <td><?php echo convert_to_new_date_format($income_certificate_date); ?></td>
                        </tr>
                    </table>
                </div>

                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Details</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <thead>
                            <tr>
                                <td class="f-w-b">Sr.No.</td>
                                <td class="f-w-b">Relation With Applicant</td>
                                <td class="f-w-b">Father</td>
                                <td class="f-w-b">Mother</td>
                                <td class="f-w-b">Spouse</td>
                                <td class="f-w-b">Minor Child</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Agriculture land holding</td>
                                <td><?php echo $father_land; ?></td>
                                <td><?php echo $mother_land; ?></td>
                                <td><?php echo $spouse_land; ?></td>
                                <td><?php echo $minorchild_land; ?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Location</td>
                                <td><?php echo $father_location; ?></td>
                                <td><?php echo $mother_location; ?></td>
                                <td><?php echo $spouse_location; ?></td>
                                <td><?php echo $minorchild_location; ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Size of holding</td>
                                <td><?php echo $father_sizeofholding; ?></td>
                                <td><?php echo $mother_sizeofholding; ?></td>
                                <td><?php echo $spouse_sizeofholding; ?></td>
                                <td><?php echo $minorchild_sizeofholding; ?></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Type of irrigated Land</td>
                                <td><?php echo $father_typeofirrigated; ?></td>
                                <td><?php echo $mother_typeofirrigated; ?></td>
                                <td><?php echo $spouse_typeofirrigated; ?></td>
                                <td><?php echo $minorchild_typeofirrigated; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

<?php if ($marital_status == VALUE_ONE && ($constitution_artical == VALUE_ONE)) { ?>
                    <div style="margin-top: 20px;">
                        <b style="font-size: 14px;">Spouse Information</b>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                            <tr>
                                <td class="f-w-b">Spouse Name</td>
                                <td><?php echo $spouse_name; ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Nationality</td>
                                <td style="vertical-align: top;"><?php echo $spouse_nationality; ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Birth Place</td>
                                <td><?php echo $spouse_born_state_name . '&nbsp;&nbsp;&nbsp;' . $spouse_born_district_name . '&nbsp;&nbsp;&nbsp;' . $spouse_born_village_name; ?></td>
                            </tr>

                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td><?php echo $spouse_native_state_name . '&nbsp;&nbsp;&nbsp;' . $spouse_native_district_name . '&nbsp;&nbsp;&nbsp;' . $spouse_native_village_name; ?></td>
                            </tr>


                            <tr>
                                <td class="f-w-b">Occupation</td>
                                <td><?php echo ((isset($applicant_occupation_array[$spouse_occupation]) ? ($spouse_occupation == VALUE_TWELVE ? $spouse_other_occupation : $applicant_occupation_array[$spouse_occupation]) : '-')); ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Aadhaar Number</td>
                                <td><?php echo ($spouse_aadhaar != '' ? ($spouse_aadhaar) : ''); ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Election Number</td>
                                <td><?php echo ($spouse_election_no != '' ? ($spouse_election_no) : ''); ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">Spouse Annual Income</td>
                                <td><?php echo $spouse_annual_income; ?></td>
                            </tr>
                        </table>
                    </div>
<?php } ?>

                <table class="app-form-income" style="font-size: 13px; margin-top: 20px;">
                    <tr>
                        <td class="f-w-b" style="width: 50%;"> Annual Family Income from all Sources.</td>
                        <td style="vertical-align: top;"><?php echo ' ₹ ' . $family_annual_income . ' /- '; ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b" style="width: 50%;">For What Purpose is the Certificate of OBC Required</td>
                        <td style="vertical-align: top;"><?php echo $purpose_of_ncl_certificate; ?></td>
                    </tr>
                </table>
            </div>
            <div>
                <pagebreak></pagebreak>
            </div>

            <div style="font-size: 13px;">
                <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I, <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $applicant_name; ?>,&nbsp;&nbsp;</span> 
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        aged about <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $applicant_age; ?>&nbsp;&nbsp;&nbsp;</span><b> years,</b>
                    <?php } else { ?>
                        Major age
                        <?php } ?>
                    Resident at <span class="b-b-1px f-w-b">&nbsp;&nbsp;<?php echo $com_addr_house_no; ?>,&nbsp;&nbsp;
                            <?php echo $com_addr_house_name == '' ? '' : $com_addr_house_name . ','; ?>&nbsp;<?php echo $com_addr_street; ?>,
                        <span class="b-b-1px f-w-b"><?php echo $com_addr_village_dmc_ward; ?>, <?php echo $com_addr_city; ?>, 
                    <?php echo $com_pincode; ?></span></span>&nbsp;<?php echo $taluka_name; ?> District of U.T. DNH & Daman & Diu,
                    <?php if ($constitution_artical == VALUE_TWO) { ?>
                        That my minor child <?php echo $minor_child_name; ?>
<?php } ?>

                    hereby declare that the above/following information is true to the bet of my knowledge and belief and nothing 
                    has been concealed therein. I am well aware of the face that if the information given by me is proved 
                    false/not true, I will have to face the punishment as per the law and the benefits availed by me shall 
                    be summarily withdrawn.
                    <br>

                    <div class="l-s" style="margin-top: 10px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I have applied to the Mamlatdar, <?php echo $taluka_name; ?>, to issue me a <b> Non Creamy Layer Certificate </b>in respect of 
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            myself
                        <?php } else { ?>
                            my minor child <?php echo $minor_child_name; ?>
<?php } ?>, I hereby declare and state that I am holding an OBC Certificate bearing No. <span class="b-b-1px f-w-b"><?php echo $obc_certificate_no; ?></span> and date <span class="b-b-1px f-w-b"><?php echo convert_to_new_date_format($obc_certificate_date); ?></span>
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; line-height: 25px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I hereby declared that 
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            I am
                        <?php } else { ?>
                            my minor child <?php echo $minor_child_name; ?>
<?php } ?> belongs to <b> <?php echo $religion; ?><?php echo $other_religion; ?></b><span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $obccaste_text; ?></span>&nbsp;&nbsp;&nbsp;Community which is recognized as an Other Backward Class by the Government of India.
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; line-height: 25px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Further, I sate that this academic year, our annual family income form, all source is Approximately Rs.<span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $family_annual_income; ?> only </span>&nbsp;&nbsp;&nbsp;hence, 
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            I do not
                        <?php } else { ?>
                            my minor child <?php echo $minor_child_name; ?> is not
<?php } ?>  belongs to the Creamy Layer.
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; line-height: 25px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This declaration is required to b e submitted to the Mamlatdar, <?php echo $taluka_name; ?> to getting <b> Non Creamy Layer  </b> Renew Certificate in respect of 
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            my Self
                        <?php } else { ?>
                            my minor child <?php echo $minor_child_name; ?>
<?php } ?>.
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; line-height: 25px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that I have read and understood the provision of section 199 and 200 of the Indian Penal Code.
                    </div><br>

                    <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px;">
                        <b>Section 199. False statement made in declaration which is by law receivable as evidence:-  </b>
                        <div>
                            Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or any Public Servant or other person, is bound or authorized bylaw to receive as evidence of any fact, makes any statement which is false, and which he either knows or believes to be false or does not believe to be true, touching any point material to the object for which the declaration is made or used, shall be punished in the same manner as if he gave false evidence.
                        </div>
                    </div>
                    <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px;">
                        <b>Section 200. Using as true such declaration knowing it to be false:- </b>
                        Whoever corruptly uses or attempts to use as true any such declaration, knowing the same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
                    </div>
                    <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px;">
                        <b>Explanation :- </b>
                        A declaration which is inadmissible merely upon the ground of some informality, is a declaration within the meaning of Sections 199 and 200.
                    </div>
                </div>
            </div>

            <table style="margin-top: 10px; width: 100%;">
                <tr>
                    <td style="vertical-align: top; width: 33%;">
                        <b>Place&nbsp; :-</b> <?php echo $taluka_name; ?><br>
                        <b>Dated :-</b> <?php echo convert_to_new_date_format($submitted_datetime); ?>
                    </td>
                    <td class="t-a-c" style="width: 25%;">
                        <img src='<?php echo NCL_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'
                             style="width: 110px; height: 130px; border: 1px solid;" />
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
