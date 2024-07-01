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
            .t-d-w{
                width: 230px;
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
        $type_of_resident_array = $this->config->item('type_of_resident_array');
        $education_array = $this->config->item('education_type_array');
        $domicileCertificatePurposeArray = $this->config->item('domicile_certificate_purpose_array');

        $taluka_name = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        $taluka_name_guj = isset($taluka_array_guj[$district]) ? $taluka_array_guj[$district] : '-';
        $applicant_education_text = isset($education_array[$applicant_education]) ? $education_array[$applicant_education] : '-';

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

        if ($district == TALUKA_DAMAN)
            $village_name_text = (isset($daman_villages_array[$village_name]) ? $daman_villages_array[$village_name] : '');
        else if ($district == TALUKA_DIU)
            $village_name_text = (isset($diu_villages_array[$village_name]) ? $diu_villages_array[$village_name] : '');
        else if ($district == TALUKA_DNH)
            $village_name_text = (isset($dnh_villages_array[$village_name]) ? $dnh_villages_array[$village_name] : '');


        $father_data = $father_details ? json_decode($father_details, true) : array();
        $mother_data = $mother_details ? json_decode($mother_details, true) : array();
        $spouse_data = $spouse_details ? json_decode($spouse_details, true) : array();

        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');
        ?>
        <div style="font-family: arial_unicode_ms;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">રીપોર્ટ</span></div>
            <div class="l-s" style="padding-left: 70%; margin-top: 10px;">જા.નં.&nbsp; :- <span class="f-w-b"><?php echo $application_number; ?></span></div>
            <div class="l-s" style="padding-left: 70%;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text_seja . ' સેજા'; ?></span></div>
            <div class="l-s" style="padding-left: 70%;">તારીખ :- <span class="f-w-b"><?php echo $talathi_to_aci_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($talathi_to_aci_datetime) : '-'; ?></span></div>
            <br>
            <div class="l-s l-h" style="height: 90px;">
                મહેરબાન મામલતદાર સાહેબ,<br/><?php echo $taluka_name_guj; ?>
            </div>
            <div class="l-s l-h" style="height: 90px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                આપ સાહેબના પત્ર નં. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $application_number . '&nbsp;&nbsp;&nbsp;'; ?></span> તા:- 
                <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                નાં અનુસંધાનમાં જણાવવાનું  કે   શ્રી/શ્રીમતી/કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $name_of_applicant . '&nbsp;&nbsp;&nbsp;'; ?></span>,                                                     
                રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . ',&nbsp;&nbsp;&nbsp;' . ($com_addr_house_name == '' ? '' : $com_addr_house_name . ',&nbsp;&nbsp;&nbsp;') . $com_addr_street . ',&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . ',&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . ','; ?> <?php echo $com_pincode == '0' ? '&nbsp;&nbsp;&nbsp;' . $pincode : '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>

                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    અરજદારના પુત્ર / પુત્રી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $minor_child_name . '&nbsp;&nbsp;&nbsp;'; ?></span> ના ડોમીશયલ સર્ટીફીકેટ વિષે નીચે મુજબ જણાવુ છુ.<br/>
                <?php } ?>

                અરજદારનો જન્મ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span> જીલ્લો  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span> રાજ્ય <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>

                અરજદારનું મુળવતન <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span> જીલ્લો <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span> રાજ્ય <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>
                
                <?php if ($applicant_education_text == '-') { ?>
                    <div style="margin-top: 7px;">
                        <span>અરજદારના ભણતરની મહિતી નીચે મુજબ છે.</span>
                        <?php $detail_cnt = 1; ?>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                            <tr>
                                <td class="f-w-b t-a-c" style="width: 60px;">Sr. No</td>
                                <td class="f-w-b t-a-c" style="width: 100px;">Name of School / Institute</td>
                                <td class="f-w-b t-a-c" style="width: 60px;">Class / Standard</td>
                                <td class="f-w-b t-a-c" style="width: 100px;">Date of Admission</td>
                                <td class="f-w-b t-a-c" style="width: 100px;">Date of Leaving School</td>
                                <td class="f-w-b t-a-c" style="width: 60px;">Total Period</td>
                                <td class="f-w-b t-a-c" style="width: 100px;">Remarks</td>
                            </tr>
                            <?php
                            $temp_applicant_education_details = json_decode($applicant_education_details, true);
                            foreach ($temp_applicant_education_details as $edu) {
                                ?>
                                <tr>
                                    <td class="t-a-c"><?php echo $detail_cnt; ?></td>
                                    <td class="t-a-c"><?php echo $edu['name_of_school']; ?></td>
                                    <td class="t-a-c"><?php echo $edu['class_standard']; ?></td>
                                    <td class="t-a-c"><?php echo $edu['admission_date']; ?></td>
                                    <td class="t-a-c"><?php echo $edu['leaving_date']; ?></td>
                                    <td class="t-a-c"><?php echo $edu['total_period_in_year'] . ' Year ' . $edu['total_period_in_month'] . ' Month'; ?></td>
                                    <td class="t-a-c"><?php echo $edu['edu_remarks']; ?></td>
                                </tr>
                                <?php
                                $detail_cnt++;
                            }
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: right;">Grand Total</td>
                                <td style="text-align: center;"><?php echo $total_period; ?></td>
                            </tr>
                        </table>
                    </div>
                <?php } else { ?>
                    અરજદારનું ભણતર <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($education_array[$applicant_education]) ? ($applicant_education == VALUE_FIVE ? $other_education_detail : $education_array[$applicant_education]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?></span> થી પાસ કરલે છે.
                <?php } ?><br/>

                <?php if($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE){ ?>
                અરજદારનો  મતદાર  યાદી  નંબર  <span class="b-b-1px f-w-b"> <?php echo $election_no == '' ? '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' : $election_no; ?> </span>  છે. 
                <?php } ?> પોલીસ  સ્ટેશન / આઉટ  પોસ્ટ  <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $nearest_police_station; ?> &nbsp;&nbsp;&nbsp; </span> છે. તેમજ  પોસ્ટ  ઓફીસ <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $nearest_post_office; ?> &nbsp;&nbsp;&nbsp; </span> છે. <br/>

                અરજદાર <?php echo $taluka_name_guj; ?>માં  <span class="b-b-1px f-w-b"><?php echo $residing_year_as_per_talathi != VALUE_ZERO ? $residing_year_as_per_talathi : ($residing_year != '' ?$residing_year : $resident_total_period); ?></span>  વર્ષ થી  રહે  છે <br/>

                <?php
                if (($gender == VALUE_TWO && $constitution_artical != VALUE_SEVEN && $constitution_artical != VALUE_TWO && $constitution_artical != VALUE_THREE && ($marital_status == VALUE_ONE || $marital_status == VALUE_THREE)) || ($gender == VALUE_THREE || $gender == VALUE_FOUR)) {
                    
                } else { ?>
                    અરજદારના પિતાનું નામ <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_name'] . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે.<br/>

                    
                    એમનું કાયમી રહેઠાણ  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_village_text'] . ',&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_district_text'] . ',&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_state_text']; ?> </span> છે.<br/>
                    

                    અરજદારના માતાનું નામ <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_name'] . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે.<br/>

                    
                    એમનું કાયમી રહેઠાણ  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text'] . ',&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_district_text'] . ',&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_state_text']; ?> </span> છે.<br/>
                <?php } ?>
                <?php if (($marital_status == VALUE_ONE || $marital_status == VALUE_THREE) && ($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE)) { ?>
                    અરજદારના પતિ / પત્ની નું નામ <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_name'] . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે.<br/>

                    એમનું કાયમી રહેઠાણ  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_village_text'] . ',&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_district_text'] . ',&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_state_text']; ?> </span> છે.<br/>
                <?php } ?>

                અરજદાર હાલે  
                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($education_array[$applicant_education]) ? ($applicant_education == VALUE_FIVE ? $other_education_detail : $education_array[$applicant_education]) : 'અભ્યાસ')) . '&nbsp;&nbsp;&nbsp;'; ?></span>
                <?php }else { ?>
                    <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($applicant_occupation_array[$occupation]) ? ($occupation == VALUE_TWELVE ? $other_occupation : $applicant_occupation_array[$occupation]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?>
                <?php } ?></span> કરે છે.<br/>

                <?php if($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE){ ?>
                    અરજદારનાં નામે મોજે  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $village_name_text . '&nbsp;&nbsp;&nbsp;'; ?> </span> ગામે સ્થાવર મિલકત  નોધાયેલ છે / નથી.<br/>
                <?php } ?>

                અરજદાર આ <b>ડોમીશયલ સર્ટીફીકેટનો</b> <span class="b-b-1px f-w-b"> <?php echo $required_purpose == '' ? $domicileCertificatePurposeArray[$select_required_purpose] : $required_purpose; ?> </span> માટે ઉપયોગ કરનાર છું.<br/>

            </div>
            <div class="l-s" style="margin-top: 10px;">
                <b>અરજદારે આ સાથે અરજીમાં, ડિકલેરેસન
                    <?php
                    if ($aadhaar_card != '') {
                        echo ', આધાર કાર્ડ';
                    }
                    if ($election_card != '') {
                        echo ', ઇલેક્શન કાર્ડ';
                    }if ($birth_certi != '') {
                        echo ', લિવિંગ / બર્થ સટી';
                    }if ($noc_with_notary != '') {
                        echo ', એન ઑ સી માલિક';
                    }if ($gas_book != '') {
                        echo ', ગેસ બૂક';
                    }if ($bank_book != '') {
                        echo ', બેંક બુક';
                    }if ($house_tax_receipt != '') {
                        echo ', ઘરવેરો રસીદ';
                    }if ($last_10year_proof != '') {
                        echo ', છેલ્લા 10 વર્ષનો પુરાવો';
                    }if ($father_proof != '') {
                        echo ', પિતાનો પુરાવો';
                    }if ($mother_proof != '') {
                        echo ', માતાનો પુરાવો';
                    }if ($spouse_proof != '') {
                        echo ', જીવનસાથીનો પુરાવો પુરાવો';
                    }
                    ?><!-- , માર્કસ સીટ અને બોનોફાઇડ --> કોપી રજુ કરેલ છે.</b>
            </div>
            <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%;">&nbsp;</div>
            <div class="l-s">
                જે આપ સાહેબને  વિદિત થાય.
            </div>
            <div class="l-s" style="padding-left: 70%; margin-top: -20px;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text_seja . ' - સેજા'; ?></span></div>
            <div style="border-bottom: 1px dashed; margin-top: -10px;">&nbsp;</div>
            <div class="l-s" style="margin-top: 10px;">
                Remarks of Talathi if any :- <?php echo $talathi_remarks; ?>
            </div>
            <div style="margin-top: 10px;">
                <b>Recommendation of Awal Karkun / Circle Inspector :- </b> <?php echo isset($rec_array[$aci_rec]) ? $rec_array[$aci_rec] : $rec_array[VALUE_TWO]; ?>
            </div>
            <div class="l-s" style="margin-top: 10px;">
                Remarks if any :- <?php echo $aci_remarks; ?>
            </div>
            <div>
                <pagebreak></pagebreak>
            </div>
            <div style="border-bottom: 1px dashed; margin-top: -10px;">&nbsp;</div>
            <div class="f-s-title t-a-c l-s" style="margin-top: 10px;"><span class="b-b-1px f-w-b">અરજદારનો જવાબ</span></div>
            <div class="l-s l-h" style="height: 90px; margin-top: 20px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                હું નીચે સહી કરનાર શ્રી / શ્રીમતી / કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $name_of_applicant . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    ઉંમરલાયક ,
                <?php }else{ ?>
                    ઉંમર <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_age . '&nbsp;&nbsp;&nbsp;'; ?></span> વર્ષ,
                <?php } ?>
                
                રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . ',&nbsp;&nbsp;&nbsp;' . ($com_addr_house_name == '' ? '' : $com_addr_house_name . ',&nbsp;&nbsp;&nbsp;') . $com_addr_street . ',&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . ',&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . ','; ?> <?php echo $com_pincode == '0' ? '&nbsp;&nbsp;&nbsp;' . $pincode : '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?></span>,

                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    મારા પુત્ર / પુત્રી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $minor_child_name . '&nbsp;&nbsp;&nbsp;'; ?></span> ના ડોમીશયલ સર્ટીફીકેટ માટે ,
                <?php } ?>

                આજરોજ તલાટી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $village_name_text_seja . '&nbsp;&nbsp;&nbsp;'; ?></span> 
                રૂબરૂ હાજર થઇ પૂછવાથી લખાવું છું કે<br/>

                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    મારા પુત્ર / પુત્રી નો જન્મ
                <?php }else{ ?>
                    મારો જન્મ
                <?php } ?>
                <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span> જીલ્લો  <span class="b-b-1px f-w-b"><?php ?><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>રાજ્ય <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>

                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                   મારા પુત્ર / પુત્રી નું મુળવતન  
                <?php }else{ ?>
                    મારું મુળવતન 
                <?php } ?>
                <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span> જીલ્લો <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span> રાજ્ય <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>

                <?php if ($applicant_education_text == '-') { ?>
                    <div style="margin-top: 7px;">
                        <span>
                        <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                            મારા પુત્ર / પુત્રી ના
                        <?php }else{ ?>
                            મારા
                        <?php } ?>
                        ભણતરની મહિતી નીચે મુજબ છે.</span>
                        <?php $detail_cnt = 1; ?>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                            <tr>
                                <td class="f-w-b t-a-c" style="width: 60px;">Sr. No</td>
                                <td class="f-w-b t-a-c" style="width: 100px;">Name of School / Institute</td>
                                <td class="f-w-b t-a-c" style="width: 60px;">Class / Standard</td>
                                <td class="f-w-b t-a-c" style="width: 100px;">Date of Admission</td>
                                <td class="f-w-b t-a-c" style="width: 100px;">Date of Leaving School</td>
                                <td class="f-w-b t-a-c" style="width: 60px;">Total Period</td>
                                <td class="f-w-b t-a-c" style="width: 100px;">Remarks</td>
                            </tr>
                            <?php
                            $temp_applicant_education_details = json_decode($applicant_education_details, true);
                            foreach ($temp_applicant_education_details as $edu) {
                                ?>
                                <tr>
                                    <td class="t-a-c"><?php echo $detail_cnt; ?></td>
                                    <td class="t-a-c"><?php echo $edu['name_of_school']; ?></td>
                                    <td class="t-a-c"><?php echo $edu['class_standard']; ?></td>
                                    <td class="t-a-c"><?php echo $edu['admission_date']; ?></td>
                                    <td class="t-a-c"><?php echo $edu['leaving_date']; ?></td>
                                    <td class="t-a-c"><?php echo $edu['total_period_in_year'] . ' Year ' . $edu['total_period_in_month'] . ' Month'; ?></td>
                                    <td class="t-a-c"><?php echo $edu['edu_remarks']; ?></td>
                                </tr>
                                <?php
                                $detail_cnt++;
                            }
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: right;">Grand Total</td>
                                <td style="text-align: center;"><?php echo $total_period; ?></td>
                            </tr>
                        </table>
                    </div>
                <?php } else { ?>
                    <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                        મારા પુત્ર / પુત્રી નું 
                    <?php }else{ ?>
                        મારું
                    <?php } ?>
                    ભણતર <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($education_array[$applicant_education]) ? ($applicant_education == VALUE_FIVE ? $other_education_detail : $education_array[$applicant_education]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?></span> થી પાસ કરલે છે.
                <?php } ?><br/>
                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    મારા પુત્ર / પુત્રી નો
                <?php }else{ ?>
                    મારો 
                <?php } ?>
                રહેણાંક ઘર નં.  <span class="b-b-1px f-w-b"> <?php echo $com_addr_house_no; ?> </span> છે.
                <?php if($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE){ ?>
                મારું  મતદાર  યાદીનો  નંબર <span class="b-b-1px f-w-b"> <?php echo $election_no == '' ? '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' : $election_no; ?> </span> છે. 
                <?php } ?>

                પોલીસ  સ્ટેશન / આઉટ  પોસ્ટ <span class="b-b-1px f-w-b">  <?php echo '&nbsp;&nbsp;&nbsp;' . $nearest_police_station . '&nbsp;&nbsp;&nbsp;'; ?></span> છે. તેમજ  પોસ્ટ  ઓફીસ <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $nearest_post_office . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે. <br/>

                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    તેમજ તે  <?php echo $taluka_name_guj; ?>માં  <span class="b-b-1px f-w-b"><?php echo $residing_year; ?><?php echo $resident_total_period; ?></span>  થી  રહે છે.<br/>
                <?php }else{ ?>
                    તેમજ હું  <?php echo $taluka_name_guj; ?>માં  <span class="b-b-1px f-w-b"><?php echo $residing_year; ?><?php echo $resident_total_period; ?></span>  થી  રહુ  છું<br/>
                <?php } ?>
                

                <?php
                if (($gender == VALUE_TWO && $constitution_artical != VALUE_SEVEN && $constitution_artical != VALUE_TWO && $constitution_artical != VALUE_THREE && ($marital_status == VALUE_ONE || $marital_status == VALUE_THREE)) || ($gender == VALUE_THREE || $gender == VALUE_FOUR)) {
                    
                } else { ?>
                    <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                        મારા પુત્ર / પુત્રી ના
                    <?php }else{ ?>
                        મારા
                    <?php } ?>
                    પિતાનું નામ <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_name'] . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે.<br/>

                    એમનું કાયમી રહેઠાણ  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_village_text'] . ',&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_district_text'] . ',&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_state_text']; ?> </span> છે.<br/>
                    
                    <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                        મારા પુત્ર / પુત્રી ના
                    <?php }else{ ?>
                        મારા
                    <?php } ?>
                    માતાનું નામ <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_name'] . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે.<br/>
                    
                    એમનું કાયમી રહેઠાણ  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text'] . ',&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_district_text'] . ',&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_state_text']; ?> </span> છે.<br/>
                <?php } ?>
                <?php if (($marital_status == VALUE_ONE || $marital_status == VALUE_THREE) && ($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE)) { ?>
                    મારા પતિ / પત્ની નું નામ <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_name'] . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે.<br/>

                    એમનું કાયમી રહેઠાણ  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_village_text'] . ',&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_district_text'] . ',&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_state_text']; ?> </span> છે.<br/>
                <?php } ?>

                હાલે હું  
                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($education_array[$applicant_education]) ? ($applicant_education == VALUE_FIVE ? $other_education_detail : $education_array[$applicant_education]) : 'અભ્યાસ')) . '&nbsp;&nbsp;&nbsp;'; ?></span>
                <?php }else { ?>
                    <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($applicant_occupation_array[$occupation]) ? ($occupation == VALUE_TWELVE ? $other_occupation : $applicant_occupation_array[$occupation]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?>
                <?php } ?></span> કરું છું.<br/>

                <?php if($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE){ ?>
                    મારા  નામે મોજે  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $village_name_text . '&nbsp;&nbsp;&nbsp;'; ?> </span> ગામે સ્થાવર મિલકત  નોધાયેલ છે.<br/>
                <?php } ?>
                
            </div>
            <div class="l-s" style="margin-top: 10px;">
                આ સર્ટીફીકેટનો ઉપયોગ 
                    <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                        મારા પુત્ર / પુત્રી 
                    <?php } ?>
                    <span class="b-b-1px f-w-b"> <?php echo $required_purpose == '' ? $domicileCertificatePurposeArray[$select_required_purpose] : $required_purpose; ?> </span> માટે કરનાર છુ. 
            </div>
            <div class="l-s" style="margin-top: 10px;">
                ઉપરોક્ત જવાબ મારા લખાવ્યા મુજબ ખરો અને બરાબર છે. જે બદલ મેં નીચે સહી કરેલ છે.
            </div>
            <div class="l-s" style="margin-top: 10px;">
                તારીખ :- <span class="f-w-b"><?php echo $appointment_date != '0000-00-00' ? convert_to_new_date_format($appointment_date) : '-'; ?></span><br>
                સ્થળ &nbsp; :- <span class="f-w-b"><?php echo $taluka_name; ?></span>
            </div>
            <div style="border-bottom: 1px dashed; margin-top: 10px;">&nbsp;</div>
            <div>
                This receipt is electronically generated and no signature is required.
            </div>
        </div>
        <div>
            <pagebreak></pagebreak>
        </div>
        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="f-w-b">Application For Domicile Certificate</span></div>
            <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                <tr>
                    <td class="f-w-b t-d-w">Application Number</td>
                    <td><?php echo $application_number; ?></td>
                </tr>
                <tr>
                    <?php if ($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE) { ?>
                        <td class="f-w-b">Gaurdian Name</td>
                    <?php } else { ?>
                        <td class="f-w-b">Name of Applicant</td>
                    <?php } ?>
                    <td><?php echo $name_of_applicant; ?></td>
                </tr>
                <?php if ($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE) { ?>
                    <tr>
                        <td class="f-w-b">Guardian Relation with Child</td>
                        <td><?php echo $relationship_of_applicant; ?></td>
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
                    <tr>
                        <td class="f-w-b">Name of Minor Child</td>
                        <td><?php echo $minor_child_name; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="f-w-b">Communication Address</td>
                    <td><?php echo $com_addr_house_no . ',&nbsp;&nbsp;&nbsp;' . ($com_addr_house_name == '' ? '' : $com_addr_house_name . ',&nbsp;&nbsp;&nbsp;') . $com_addr_street . ',&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . ',&nbsp;&nbsp;&nbsp;'; ?><?php echo $com_addr_city . ','; ?> <?php echo $com_pincode == '0' ? '&nbsp;&nbsp;&nbsp;' . $pincode : '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?></td>
                </tr>
                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    <tr>
                        <td class="f-w-b">Permanent Address</td>
                        <td><?php echo $com_addr_house_no . ',&nbsp;&nbsp;&nbsp;' . ($com_addr_house_name == '' ? '' : $com_addr_house_name . ',&nbsp;&nbsp;&nbsp;') . $com_addr_street . ',&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . ',&nbsp;&nbsp;&nbsp;'; ?>, <?php echo $com_addr_city . ','; ?> <?php echo $com_pincode == '0' ? '&nbsp;&nbsp;&nbsp;' . $pincode : '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?></td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="f-w-b">Permanent Address</td>
                        <td><?php echo $per_addr_house_no . ',&nbsp;&nbsp;&nbsp;' . ($per_addr_house_name == '' ? '' : $per_addr_house_name . ',&nbsp;&nbsp;&nbsp;') . $per_addr_street . ',&nbsp;&nbsp;&nbsp;' . $per_addr_village_dmc_ward . ',&nbsp;&nbsp;&nbsp;'; ?> <?php echo $per_addr_city . ','; ?> <?php echo $per_pincode == '0' ? '&nbsp;&nbsp;&nbsp;' . $pincode : '&nbsp;&nbsp;&nbsp;' . $per_pincode . '&nbsp;&nbsp;&nbsp;'; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="f-w-b">Mobile Number / Aadhar Number <?php if($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE){ ?>/ Election Number <?php } ?></td>
                    <td><?php echo $mobile_number . ($aadhaar != '' ? (' / ' . $aadhaar) : ''); ?>
                        <?php if($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE){  echo ($election_no != '' ? (' / ' . $election_no) : ''); } ?>
                    </td>
                </tr>
                <tr>
                    <td class="f-w-b">Gender / Date of Birth / Age <br> Birth Place <br> Native Place</td>
                    <td><?php echo (isset($gender_array[$gender]) ? $gender_array[$gender] : ' - ') . ' / ' . convert_to_new_date_format($applicant_dob) . ' / ' . $applicant_age . ' Years <br>' . $born_place_state_text . ',' . $born_place_district_text . ',' . $born_place_village_text . '<br>' . $native_place_state_text . ',' . $native_place_district_text . ',' . $native_place_village_text; ?></td>
                </tr>
                <?php if($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE){ ?>
                <tr>
                    <td class="f-w-b">Marital Status</td>
                    <td><?php echo $marital_status_text; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="f-w-b">Nationality</td>
                    <td style="vertical-align: top;"><?php echo $applicant_nationality; ?></td>
                </tr>
                <?php if($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE){ ?>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td><?php echo ((isset($applicant_occupation_array[$occupation]) ? ($occupation == VALUE_TWELVE ? $other_occupation : $applicant_occupation_array[$occupation]) : '-')); ?></td>
                </tr>
                <?php } ?>
                <?php if ($constitution_artical != VALUE_FIVE && $constitution_artical != VALUE_SIX) { ?>
                    <tr>
                        <td class="f-w-b">Education</td>
                        <td><?php echo ((isset($education_array[$applicant_education]) ? ($applicant_education == VALUE_FIVE ? $other_education_detail : $education_array[$applicant_education]) : '-')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="f-w-b">Name of School / Collage / Institute</td>
                        <td><?php echo $name_of_school; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="f-w-b">Nearest Police Station / Nearest Post Office</td>
                    <td><?php echo $nearest_police_station .'/ '. $nearest_post_office; ?></td>
                </tr>
            </table>
            <?php if ($constitution_artical == VALUE_FIVE || $constitution_artical == VALUE_SIX) { ?>
                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Applicant Education Details. (i.e. Since K.G. to till date or last education)</b>
                    <?php $detail_cnt = 1; ?>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class="f-w-b t-a-c" style="width: 60px;">Sr. No</td>
                            <td class="f-w-b t-a-c" style="width: 100px;">Name of School / Institute</td>
                            <td class="f-w-b t-a-c" style="width: 60px;">Class / Standard</td>
                            <td class="f-w-b t-a-c" style="width: 100px;">Date of Admission</td>
                            <td class="f-w-b t-a-c" style="width: 100px;">Date of Leaving School</td>
                            <td class="f-w-b t-a-c" style="width: 60px;">Total Period</td>
                            <td class="f-w-b t-a-c" style="width: 100px;">Remarks</td>
                        </tr>
                        <?php
                        $temp_applicant_education_details = json_decode($applicant_education_details, true);
                        foreach ($temp_applicant_education_details as $edu) {
                            // $temp_profession = isset($edu['profession']) ? $edu['profession'] : VALUE_ZERO;
                            // $temp_oo = isset($edu['children_other_occupation']) ? $edu['children_other_occupation'] : '';
                            ?>
                            <tr>
                                <td class="t-a-c"><?php echo $detail_cnt; ?></td>
                                <td class="t-a-c"><?php echo $edu['name_of_school']; ?></td>
                                <td class="t-a-c"><?php echo $edu['class_standard']; ?></td>
                                <td class="t-a-c"><?php echo $edu['admission_date']; ?></td>
                                <td class="t-a-c"><?php echo $edu['leaving_date']; ?></td>
                                <td class="t-a-c"><?php echo $edu['total_period_in_year'] . ' Year ' . $edu['total_period_in_month'] . ' Month'; ?></td>
                                <td class="t-a-c"><?php echo $edu['edu_remarks']; ?></td>
                            </tr>
                            <?php
                            $detail_cnt++;
                        }
                        ?>
                        <tr>
                            <td colspan="6" style="text-align: right;">Grand Total</td>
                            <td style="text-align: center;"><?php echo $total_period; ?></td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
            <?php
            if (($gender == VALUE_TWO && $constitution_artical != VALUE_SEVEN && $constitution_artical != VALUE_TWO && $constitution_artical != VALUE_THREE && ($marital_status == VALUE_ONE || $marital_status == VALUE_THREE)) || ($gender == VALUE_THREE || $gender == VALUE_FOUR)) {
                
            } else {
                ?>
                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Father Information</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class="f-w-b t-d-w">Father Name</td>
                            <td><?php echo $father_data['father_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Nationality</td>
                            <td style="vertical-align: top;"><?php echo $father_data['father_nationality']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Birth Place</td>
                            <td><?php echo $father_data['father_born_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_born_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_born_place_village_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_born_pincode']; ?></td>
                        </tr>
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td><?php echo $father_data['father_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_born_pincode']; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td> <?php echo $father_data['father_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;' . $father_data['father_born_pincode']; ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td class="f-w-b">Occupation</td>
                            <td><?php echo((isset($applicant_occupation_array[$father_data['father_occupation']]) ? ($father_data['father_occupation'] == VALUE_TWELVE ? $father_data['father_other_occupation'] : $applicant_occupation_array[$father_data['father_occupation']]) : '-')); ?>
                            </td>
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
                            <td class="f-w-b t-d-w">Mother Name</td>
                            <td><?php echo $mother_data['mother_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Nationality</td>
                            <td style="vertical-align: top;"><?php echo $mother_data['mother_nationality']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Birth Place</td>
                            <td><?php echo $mother_data['mother_born_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_born_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_born_place_village_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_born_pincode']; ?></td>
                        </tr>
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td> <?php echo $mother_data['mother_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_born_pincode']; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td> <?php echo $mother_data['mother_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_born_pincode']; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="f-w-b">Occupation</td>
                            <td><?php echo((isset($applicant_occupation_array[$mother_data['mother_occupation']]) ? ($mother_data['mother_occupation'] == VALUE_TWELVE ? $mother_data['mother_other_occupation'] : $applicant_occupation_array[$mother_data['mother_occupation']]) : '-')); ?></td>
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
            <?php } ?>
            <?php if (($marital_status == VALUE_ONE || $marital_status == VALUE_THREE) && ($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE)) { ?>
                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Spouse Information</b>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class="f-w-b t-d-w">Spouse Name</td>
                            <td><?php echo $spouse_data['spouse_name']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Nationality</td>
                            <td style="vertical-align: top;"><?php echo $spouse_data['spouse_nationality']; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Birth Place</td>
                            <td><?php echo $spouse_data['spouse_born_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_born_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_born_place_village_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_born_pincode']; ?></td>
                        </tr>
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td> <?php echo $spouse_data['spouse_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_born_pincode']; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td class="f-w-b">Original Native Of</td>
                                <td> <?php echo $spouse_data['spouse_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_born_pincode']; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="f-w-b">Occupation</td>
                            <td><?php echo((isset($applicant_occupation_array[$spouse_data['spouse_occupation']]) ? ($spouse_data['spouse_occupation'] == VALUE_TWELVE ? $spouse_data['spouse_other_occupation'] : $applicant_occupation_array[$spouse_data['spouse_occupation']]) : '-')); ?></td>
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
                <tr>
                    <td class="f-w-b" style="width: 50%;">The Year from which he/she is residing in the U.T. Of Daman & Diu</td>
                    <td style="vertical-align: top;"><?php echo $residing_year; ?><?php echo $resident_total_period; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b" style="width: 50%;">For What Purpose is the Certificate of Income Required</td>
                    <td style="vertical-align: top;"><?php echo $required_purpose == '' ? $domicileCertificatePurposeArray[$select_required_purpose] : $required_purpose; ?></td>
                </tr>
            </table>
            <?php if ($constitution_artical == VALUE_FIVE || $constitution_artical == VALUE_SIX || $constitution_artical == VALUE_SEVEN) { ?>
                                                            <!-- <tr>
                                                                <td class="f-w-b" style="width: 50%;">If Student, the place of study during the last 10 years (Name of school)</td>
                                                                <td style="vertical-align: top;"><?php //echo $name_of_school;            ?></td>
                                                            </tr> -->

                <div style="margin-top: 20px;">
                    <b style="font-size: 14px;">Residential details of last 10 year in <?php echo $taluka_name; ?> District.</b>
                    <?php $resi_cnt = 1; ?>
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class="f-w-b t-a-c" style="width: 60px;">Sr. No</td>
                            <td class="f-w-b t-a-c" style="width: 100px;">Details / Address of Residential Place</td>
                            <td class="f-w-b t-a-c" style="width: 60px;">Type of Resident</td>
                            <td class="f-w-b t-a-c" style="width: 100px;">Date of Resident</td>
                            <td class="f-w-b t-a-c" style="width: 100px;">Date of Leaving</td>
                            <td class="f-w-b t-a-c" style="width: 60px;">Total Period</td>
                            <td class="f-w-b t-a-c" style="width: 100px;">Remarks</td>
                        </tr>
                        <?php
                        $temp_residential_details = json_decode($residential_details, true);
                        foreach ($temp_residential_details as $resi) {
                            ?>
                            <tr>
                                <td class="t-a-c"><?php echo $resi_cnt; ?></td>
                                <td class="t-a-c"><?php echo $resi['resident_address']; ?></td>
                                <td class="t-a-c"><?php echo $type_of_resident_array[$resi['type_of_resident']]; ?></td>
                                <td class="t-a-c"><?php echo $resi['resident_date']; ?></td>
                                <td class="t-a-c"><?php echo $resi['resident_leaving_date']; ?></td>
                                <td class="t-a-c"><?php echo $resi['resident_total_period_in_year'] . ' Year ' . $resi['resident_total_period_in_month'] . ' Month'; ?></td>
                                <td class="t-a-c"><?php echo $resi['resident_remarks']; ?></td>
                            </tr>
                            <?php
                            $resi_cnt++;
                        }
                        ?>
                        <tr>
                            <td colspan="6" style="text-align: right;">Total Period of Resident</td>
                            <td style="text-align: center;"><?php echo $resident_total_period; ?></td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
            <?php if ($constitution_artical == VALUE_SEVEN) { ?>
                    <!-- <tr>
                        <td class="f-w-b" style="width: 50%;">If in business, the place of business during the last 10 years</td>
                        <td style="vertical-align: top;"><?php //echo $place_of_business;            ?></td>
                    </tr>
                    <tr>
                        <td class="f-w-b" style="width: 50%;">If employed, where employed during the last 10 years</td>
                        <td style="vertical-align: top;"><?php //echo $employed_during_years;          ?></td>
                    </tr> -->

                <?php if ($business_type == VALUE_ONE) { ?>
                    <div style="margin-top: 20px;">
                        <b style="font-size: 14px;">If in business, the place of business during the last 10 years.</b>
                        <?php $bus_cnt = 1; ?>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                            <tr>
                                <th class="f-w-b t-a-c" style="width: 30px;">Sr.No.</th>
                                <th class="f-w-b t-a-c" style="width: 60px;">Name of Business</th>
                                <th class="f-w-b t-a-c" style="width: 150px;">Address of Business</th>
                                <th class="f-w-b t-a-c" style="width: 80px;">Type of Business</th>
                                <th class="f-w-b t-a-c" style="width: 100px;">Start of Business</th>
                                <th class="f-w-b t-a-c" style="width: 100px;">End of Business</th>
                                <th class="f-w-b t-a-c" style="width: 80px;">Total Period</th>
                                <th class="f-w-b t-a-c" style="width: 80px;">Remarks</th>
                            </tr>
                            <?php
                            $temp_business_details = json_decode($business_details, true);
                            foreach ($temp_business_details as $bus) {
                                ?>
                                <tr>
                                    <td class="t-a-c"><?php echo $bus_cnt; ?></td>
                                    <td class="t-a-c"><?php echo $bus['business_name']; ?></td>
                                    <td class="t-a-c"><?php echo $bus['business_address']; ?></td>
                                    <td class="t-a-c"><?php echo $bus['business_type']; ?></td>
                                    <td class="t-a-c"><?php echo $bus['start_business_date']; ?></td>
                                    <td class="t-a-c"><?php echo $bus['end_business_date']; ?></td>
                                    <td class="t-a-c"><?php echo $bus['business_total_period_in_year'] . ' Year ' . $bus['business_total_period_in_month'] . ' Month'; ?></td>
                                    <td class="t-a-c"><?php echo $bus['business_remarks']; ?></td>
                                </tr>
                                <?php
                                $bus_cnt++;
                            }
                            ?>
                            <tr>
                                <td colspan="7" style="text-align: right;">Total Period of Business</td>
                                <td style="text-align: center;"><?php echo $business_total_period; ?></td>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
                <?php if ($business_type == VALUE_TWO) { ?>
                    <div style="margin-top: 20px;">
                        <b style="font-size: 14px;">If employed, where employed during the last 10 years.</b>
                        <?php $ser_cnt = 1; ?>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                            <tr>
                                <th class="f-w-b t-a-c" style="width: 30px;">Sr.No.</th>
                                <th class="f-w-b t-a-c" style="width: 80px;">Name of Company / Firm / Shop / Employer</th>
                                <th class="f-w-b t-a-c" style="width: 150px;">Address</th>
                                <th class="f-w-b t-a-c" style="width: 100px;">Date of Joining</th>
                                <th class="f-w-b t-a-c" style="width: 100px;">Date of reliving</th>
                                <th class="f-w-b t-a-c" style="width: 80px;">Total Period</th>
                                <th class="f-w-b t-a-c" style="width: 80px;">Remarks</th>
                            </tr>
                            <?php
                            $temp_service_details = json_decode($service_details, true);
                            foreach ($temp_service_details as $ser) {
                                ?>
                                <tr>
                                    <td class="t-a-c"><?php echo $ser_cnt; ?></td>
                                    <td class="t-a-c"><?php echo $ser['company_name']; ?></td>
                                    <td class="t-a-c"><?php echo $ser['company_address']; ?></td>
                                    <td class="t-a-c"><?php echo $ser['joining_date']; ?></td>
                                    <td class="t-a-c"><?php echo $ser['reliving_date']; ?></td>
                                    <td class="t-a-c"><?php echo $ser['service_total_period_in_year'] . ' Year ' . $ser['service_total_period_in_month'] . ' Month'; ?></td>
                                    <td class="t-a-c"><?php echo $ser['service_remarks']; ?></td>
                                </tr>
                                <?php
                                $ser_cnt++;
                            }
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: right;">Total Period of Service</td>
                                <td style="text-align: center;"><?php echo $service_total_period; ?></td>
                            </tr>
                        </table>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div>
            <pagebreak></pagebreak>
        </div>
        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
            
            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $name_of_applicant . '&nbsp;&nbsp;&nbsp;'; ?></span>
                <?php if($father_data['father_name'] == ''){ ?>
                    Spouse of Shri <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                <?php }else{ ?>
                    Son/Daughter of Shri <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                <?php } ?>
                
                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    Aged, 
                <?php }else{ ?>
                    Age <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_age . '&nbsp;&nbsp;&nbsp;'; ?></span>, Year, Marital Status :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $marital_status_text . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                <?php } ?>
                
                Resident of <span class="b-b-1px f-w-b"><?php echo $com_addr_house_no . ',&nbsp;&nbsp;&nbsp;' . ($com_addr_house_name == '' ? '' : $com_addr_house_name . ',&nbsp;&nbsp;&nbsp;') . $com_addr_street . ',&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . ',&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . ','; ?> <?php echo $com_pincode == '0' ? '&nbsp;&nbsp;&nbsp;' . $pincode : '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $taluka_name . '&nbsp;&nbsp;&nbsp;'; ?></span> District of U.T. DNH & Daman & Diu.
                <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                    for my minor child <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $minor_child_name . '&nbsp;&nbsp;&nbsp;'; ?></span>
                <?php } ?>
            </div>
            <div class="l-s l-h" style="text-align: justify; text-justify: inter-word; margin-top: 5px;">
                That my family details are as under :-
            </div>
            <?php if($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE){ ?>
                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                1. That minor child name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $minor_child_name . '&nbsp;&nbsp;&nbsp;'; ?></span>, <br/>
                That minor child was born at <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist.<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span> <br/>
                    That minor child original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span> <br/>

                That minor child presently resident at <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . ',&nbsp;&nbsp;&nbsp;' . ($com_addr_house_name == '' ? '' : $com_addr_house_name . ',&nbsp;&nbsp;&nbsp;') . $com_addr_street . ',&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . ',&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_pincode == '0' ? ',&nbsp;&nbsp;&nbsp;' . $pincode : ',&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?></span>. That minor child is <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_nationality . '&nbsp;&nbsp;&nbsp;'; ?></span> National. <br/>
               <!--  That minor child was studied at <span class="b-b-1px f-w-b"><?php //echo '&nbsp;&nbsp;&nbsp;' . $name_of_school . '&nbsp;&nbsp;&nbsp;'; ?></span> School at <?php //echo $taluka_name; ?>. <br/> -->
                 That minor child residing Since  <span class="b-b-1px f-w-b"><!-- <?php //echo '&nbsp;&nbsp;&nbsp;' . $residing_year . '&nbsp;&nbsp;&nbsp;';            ?> --> <?php echo $residing_year == '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' ? '' : $residing_year; ?><?php echo $resident_total_period == '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' ? '' : $resident_total_period; ?></span>in <?php echo $taluka_name; ?> District.
            </div>

            <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                2. That minor child's father name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, <br/>
                    That minor child's father is original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>

                That minor child's father Election Card No. is <span class="b-b-1px f-w-b"> <?php echo $father_data['father_election_no'] == '' ? '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' : $father_data['father_election_no']; ?> </span> That minor child's father profession is<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($applicant_occupation_array[$father_data['father_occupation']]) ? ($father_data['father_occupation'] == VALUE_TWELVE ? $father_data['father_other_occupation'] : $applicant_occupation_array[$father_data['father_occupation']]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?></span>,
            </div>

            <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                3. That minor child's mother name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, <br/>
                    That minor child's mother is original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>

                That minor child's mother Election Card No. is <span class="b-b-1px f-w-b"> <?php echo $mother_data['mother_election_no'] == '' ? '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' : $mother_data['mother_election_no']; ?> </span> That minor child's mother profession is<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($applicant_occupation_array[$mother_data['mother_occupation']]) ? ($mother_data['mother_occupation'] == VALUE_TWELVE ? $mother_data['mother_other_occupation'] : $applicant_occupation_array[$mother_data['mother_occupation']]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?></span>,
            </div>
            <?php }else{ ?>
                <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                1. That my name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $name_of_applicant . '&nbsp;&nbsp;&nbsp;'; ?></span>, <br/>
                That I was born at <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist.<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span> <br/>
                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    That I am original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span> <br/>
                <?php } else { ?>
                    That I am original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $native_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span> <br/>
                <?php } ?>

                That I am presently resident at <span class="b-b-1px f-w-b"> <?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . ',&nbsp;&nbsp;&nbsp;' . ($com_addr_house_name == '' ? '' : $com_addr_house_name . ',&nbsp;&nbsp;&nbsp;') . $com_addr_street . ',&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . ',&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city . ','; ?> <?php echo $com_pincode == '0' ? '&nbsp;&nbsp;&nbsp;' . $pincode : '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?></span>. That I am an <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_nationality . '&nbsp;&nbsp;&nbsp;'; ?></span> National. That my name Election Card No. is <span class="b-b-1px f-w-b"> <?php echo $election_no == '' ? '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' : $election_no; ?> </span> <br/>
                <!-- That I was studied at <span class="b-b-1px f-w-b"><?php //echo '&nbsp;&nbsp;&nbsp;' . $name_of_school . '&nbsp;&nbsp;&nbsp;'; ?></span> School at <?php //echo $taluka_name; ?>. <br/> -->
                That my profession is <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($applicant_occupation_array[$occupation]) ? ($occupation == VALUE_TWELVE ? $other_occupation : $applicant_occupation_array[$occupation]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?></span>, That I am residing Since  <span class="b-b-1px f-w-b"><!-- <?php //echo '&nbsp;&nbsp;&nbsp;' . $residing_year . '&nbsp;&nbsp;&nbsp;';            ?> --> <?php echo $residing_year == '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' ? '' : $residing_year; ?><?php echo $resident_total_period == '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' ? '' : $resident_total_period . '&nbsp;&nbsp;&nbsp;'; ?></span>in <?php echo $taluka_name; ?> District.
            </div>
            <?php if (($gender == VALUE_TWO && $constitution_artical != VALUE_SEVEN && $constitution_artical != VALUE_TWO && $constitution_artical != VALUE_THREE && ($marital_status == VALUE_ONE || $marital_status == VALUE_THREE)) || ($gender == VALUE_THREE || $gender == VALUE_FOUR)) {
                
            } else { ?>
            <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                2. That my father name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, <br/>
                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    That he is original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>
                <?php } else { ?>
                    That he is original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_data['father_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>
                <?php } ?>

                That his Election Card No. is <span class="b-b-1px f-w-b"> <?php echo $father_data['father_election_no'] == '' ? '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' : $father_data['father_election_no']; ?> </span> That his profession is<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($applicant_occupation_array[$father_data['father_occupation']]) ? ($father_data['father_occupation'] == VALUE_TWELVE ? $father_data['father_other_occupation'] : $applicant_occupation_array[$father_data['father_occupation']]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?></span>,
            </div>

            <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                3. That my mother name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, <br/>
                <?php if ($constitution_artical == VALUE_ONE) { ?>
                    That he is original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>
                <?php } else { ?>
                    That he is original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $mother_data['mother_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>
                <?php } ?>

                That his Election Card No. is <span class="b-b-1px f-w-b"> <?php echo $mother_data['mother_election_no'] == '' ? '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' : $mother_data['mother_election_no']; ?> </span> That his profession is<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($applicant_occupation_array[$mother_data['mother_occupation']]) ? ($mother_data['mother_occupation'] == VALUE_TWELVE ? $mother_data['mother_other_occupation'] : $applicant_occupation_array[$mother_data['mother_occupation']]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?></span>,
            </div>
            <?php } ?>
            <?php } ?>
            
            <?php if (($marital_status == VALUE_ONE || $marital_status == VALUE_THREE) && ($constitution_artical != VALUE_FOUR && $constitution_artical != VALUE_FIVE)) { ?>
                <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    4. That my spouse name is <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_name'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, <br/>
                    <?php if ($constitution_artical == VALUE_ONE) { ?>
                        That he is original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>
                    <?php } else { ?>
                        That he is original from <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_village_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, Dist. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_district_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span>, State <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $spouse_data['spouse_native_place_state_text'] . '&nbsp;&nbsp;&nbsp;'; ?></span><br/>
                    <?php } ?>

                    That his Election Card No. is <span class="b-b-1px f-w-b"> <?php echo $spouse_data['spouse_election_no'] == '' ? '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' : $spouse_data['spouse_election_no']; ?> </span> That his profession is<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ((isset($applicant_occupation_array[$spouse_data['spouse_occupation']]) ? ($spouse_data['spouse_occupation'] == VALUE_TWELVE ? $spouse_data['spouse_other_occupation'] : $applicant_occupation_array[$spouse_data['spouse_occupation']]) : '-')) . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                </div>
            <?php } ?>
            <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                That I am Domiciled in <?php echo $taluka_name; ?> of <?php echo $taluka_name; ?> District of U.T. DNH & Daman & Diu.
            </div>
            <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                That my parents are residence since <span class="b-b-1px f-w-b"><!-- <?php //echo '&nbsp;&nbsp;&nbsp;' . $residing_year . '&nbsp;&nbsp;&nbsp;';           ?> --> <?php echo $residing_year == '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' ? '' : $residing_year; ?><?php echo $resident_total_period == '&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;' ? '' : $resident_total_period; ?></span> in the <?php echo $taluka_name; ?> District and they are also domiciled in <?php echo $taluka_name; ?> of <?php echo $taluka_name; ?> District of U.T. DNH & Daman & Diu.
            </div>
            <?php if ($constitution_artical == VALUE_ONE) { ?>
                <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    That myself and my parents/my family are ordinarily resident of  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;' . $com_addr_house_no . ',&nbsp;' . ($com_addr_house_name == '' ? '' : $com_addr_house_name . ',&nbsp;') . $com_addr_street . ',&nbsp;' . $com_addr_village_dmc_ward . ',&nbsp;'; ?> <?php echo $com_addr_city  . ','; ?> <?php echo $com_pincode == '0' ? '&nbsp;&nbsp;&nbsp;' . $pincode : '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?> </span> of Taluka <?php echo $taluka_name; ?> of <?php echo $taluka_name; ?> District in section 20 of the representation of the people Act,1950.
                </div>
            <?php } else { ?>
                <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    That myself and my parents/my family are ordinarily resident of  <span class="b-b-1px f-w-b"> <?php echo '&nbsp;' . $per_addr_house_no . ',&nbsp;' . $per_addr_house_name . ',&nbsp;' . $per_addr_street . ',&nbsp;' . $per_addr_village_dmc_ward . ',&nbsp;'; ?> <?php echo $per_addr_city  . ','; ?> <?php echo $per_pincode == '0' ? '&nbsp;&nbsp;&nbsp;' . $pincode : '&nbsp;&nbsp;&nbsp;' . $per_pincode . '&nbsp;&nbsp;&nbsp;'; ?> </span> of Taluka <?php echo $taluka_name; ?> of <?php echo $taluka_name; ?> District in section 20 of the representation of the people Act,1950.
                </div>
            <?php } ?>

            <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                That I am not having OCI, Portuguese Passport or any other country nationality and I was not visited any country since my birth to till date.
            </div>
            <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                This declaration I have to submit before the Mamlatdar, <?php echo $taluka_name; ?> to obtain the Domicile Certificate for <span class="b-b-1px f-w-b"> <?php echo $required_purpose == '' ? $domicileCertificatePurposeArray[$select_required_purpose] : $required_purpose; ?> </span> purpose. 
            </div>

            <div class="l-s f-w-b" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein. I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the punishment as per the law and that the benefits availed by me shall be summarily withdrawn”. 
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian Penal Code which state as follows:-
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                <b>Section 199. False statement made in declaration which is by law receivable as evidence:-  </b>
                <div>
                    Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or any Public Servant or other person, is bound or authorized bylaw to receive as evidence of any fact, makes any statement which is false, and which he either knows or believes to be false or does not believe to be true, touching any point material to the object for which the declaration is made or used, shall be punished in the same manner as if he gave false evidence.
                </div>
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                <b>Section 200. Using as true such declaration knowing it to be false:- </b>
                Whoever corruptly uses or attempts to use as true any such declaration, knowing the same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                <b>Explanation :- </b>
                A declaration which is inadmissible merely upon the ground of some informality, is a declaration within the meaning of Sections 199 and 200.
            </div>
            <table style="margin-top: 10px; width: 100%;">
                <tr>
                    <td style="vertical-align: top; width: 33%;">
                        <b>Place&nbsp; :-</b> <?php echo $taluka_name; ?><br>
                        <b>Dated :-</b> <?php echo convert_to_new_date_format($submitted_datetime); ?>
                    </td>
                    <td class="t-a-c" style="width: 25%;">
                        <table style="margin-top: 10px; width: 100%;">
                            <tr>
                                <td>
                                    <img src='<?php echo DOMICILE_CERTIFICATE_DOC_PATH . $applicant_photo; ?>'style="width: 110px; height: 130px; border: 1px solid;" />
                                </td>
                                <?php if ($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE) { ?>
                                    <td>
                                        <img src='<?php echo DOMICILE_CERTIFICATE_DOC_PATH . $minor_child_photo; ?>' style="width: 110px; height: 130px; border: 1px solid;" />
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>Applicant Name : <?php echo $name_of_applicant; ?></td>
                                <?php if ($constitution_artical == VALUE_FOUR || $constitution_artical == VALUE_FIVE) { ?>
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
