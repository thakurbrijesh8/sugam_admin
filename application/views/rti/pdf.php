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
        $profession_array = $this->config->item('profession_array');
        $pre_city_text = $pre_city == VALUE_ONE ? 'Nani Daman' : 'Moti Daman';
        $per_city_text = $per_city == VALUE_ONE ? 'Nani Daman' : 'Moti Daman';
        // $parent_profession_array = $this->config->item('parent_profession_array');
        //$witness_profession_array = $this->config->item('witness_profession_array');
        // $property_type_array = $this->config->item('property_type_array');
        // $source_of_income_array = $this->config->item('source_of_income_array');
        $rec_array = $this->config->item('rec_array');
        $marital_status_array = $this->config->item('marital_status_array');
        $relation_deceased_person_array = $this->config->item('relation_deceased_person_array');
        $member_remarks_array = $this->config->item('alive_death_status_array');
        $taluka_array = $this->config->item('taluka_array');
        $gender_array = $this->config->item('gender_array');
        $yes_no_array = $this->config->item('yes_no_array');
        $taluka_name = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        $year_array = explode('-', $application_year);
        $occupation_text = (isset($applicant_occupation_array[$occupation]) ? $applicant_occupation_array[$occupation] : '-');
        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');
        $member_marital_status_text = (isset($member_marital_status_array[$member_marital_status]) ? $member_marital_status_array[$member_marital_status] : '');
        $death_marital_status_text = (isset($marital_status_array[$death_marital_status]) ? $marital_status_array[$death_marital_status] : '');
        $relation_deceased_person_text = (isset($relation_deceased_person_array[$relation_deceased_person]) ? $relation_deceased_person_array[$relation_deceased_person] : '');
        $relation_with_applicant_text = (isset($relation_deceased_person_array[$relation_with_applicant]) ? $relation_deceased_person_array[$relation_with_applicant] : '');
        $member_remarks_array_text = (isset($member_remarks_array[$member_remarks]) ? $member_remarks_array[$member_remarks] : '');
        $daman_villages_array = $this->config->item('daman_villages_array');
        $diu_villages_array = $this->config->item('diu_villages_array');
        $dnh_villages_array = $this->config->item('dnh_villages_array');
        $village_array = $district == TALUKA_DAMAN ? $daman_villages_array : ($district == TALUKA_DIU ? $diu_villages_array : ($district == TALUKA_DNH ? $dnh_villages_array : array()));
        $village_name = isset($village_array[$village_name]) ? $village_array[$village_name] : '';
        $pre_village_text = isset($village_array[$pre_village]) ? $village_array[$pre_village] : '';
        $per_village_text = isset($village_array[$per_village]) ? $village_array[$per_village] : '';
        ?>
        <div style="font-family: arial_unicode_ms;">
            <div class="f-s-title t-a-c l-s" style="margin-top: 10px;"><span class="b-b-1px f-w-b">અરજદારનો જવાબ</span></div>
            <div class="l-s l-h" style="height: 90px; margin-top: 20px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                હું નીચે સહી કરનાર શ્રી / શ્રીમતી / કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                <!--ઉંમર <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_age . '&nbsp;&nbsp;&nbsp;'; ?></span> વર્ષ,-->
                રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $pre_house_no . ',&nbsp;' . $pre_house_name . ',&nbsp;' . $pre_street . ',&nbsp;' . $pre_village . ',&nbsp;' . $pre_city_text . ',&nbsp;' . $pre_pincode . '&nbsp;&nbsp;&nbsp;'; ?></span>નાં આજ રોજ તલાટી – દમણ અને ડાભેલ સેજા રૂબરૂ હાજર થઇ પુછવાથી 
                લખાવું છું કે મહે. મામલતદાર સાહેબ દમણની ઓફીસમાં મરનારના કુટુબના સભ્યો તરીકેનું સર્ટીફીકેટ મેળવવા જે અરજી કરેલ છે. તે મારી પોતાની છે.
            </div>
            <div class="l-s l-h" style="height: 20px;margin-left: 50px;">સ્વર્ગસ્થ :-<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $death_person_name . '&nbsp;&nbsp;&nbsp;'; ?></span> જે મારા <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $relation_deceased_person_text . '&nbsp;&nbsp;&nbsp;'; ?></span> . જેમનું અવસાન મરણ  </div>
            <div class="l-s l-h" style="height: 20px;">સર્ટીફીકેટ મુજબ તા.<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . convert_to_new_date_format($death_date) . '&nbsp;&nbsp;&nbsp;'; ?></span> નાં રોજ ગુજરી ગયેલ છે. મરનારના કુટુબના સભ્યો નીચે મુજબ છે. </div>

            <?php $efm_cnt = 1; ?>
            <table class="monthly-income l-s l-h" style="font-size: 13px; margin-top: 5px;font-family: arial_unicode_ms;">
                <tr>
                    <td class="f-w-b t-a-c" style="width: 40px;">ક્રમ નં.</td>
                    <td class="f-w-b t-a-c">નામ</td>
                    <td class="f-w-b t-a-c" style="width: 80px;">ઉમર (વર્ષમાં )</td>
                    <td class="f-w-b t-a-c" style="width: 90px; font-size: 12px;">સંબંધ</td>
                    <td class="f-w-b t-a-c" style="width: 90px;">નોધ </td>
                </tr>
                <?php
                $temp_member_details = json_decode($legal_heirs_details, true);
                foreach ($temp_member_details as $md) {
                    $temp_marital_status = isset($md['member_marital_status']) ? $md['member_marital_status'] : VALUE_ZERO;
                    $temp_relation = isset($md['member_relation']) ? $md['member_relation'] : VALUE_ZERO;
                    $temp_remarks = isset($md['member_remarks']) ? $md['member_remarks'] : VALUE_ZERO;
                    if ($temp_remarks == VALUE_TWO) {
                        $late = 'Late.';
                        $memAge = '-';
                    } else {
                        $late = '';
                        $memAge = isset($md['member_age']) ? $md['member_age'] : '-';
                    }
                    ?>
                    <tr>
                        <td class="t-a-c"><?php echo $efm_cnt; ?></td>
                        <td><?php
                            echo $late . '&nbsp;';
                            echo isset($md['member_name']) ? $md['member_name'] : '';
                            ?></td>
                        <td class="t-a-c"><?php echo $memAge; ?></td>
                        <td class="t-a-c"><?php echo isset($relation_deceased_person_array[$temp_relation]) ? $relation_deceased_person_array[$temp_relation] : '-'; ?></td>
                        <td class="t-a-c"><?php echo isset($member_remarks_array[$temp_remarks]) ? $member_remarks_array[$temp_remarks] : '-'; ?></td>
                    </tr>
                    <?php
                    $efm_cnt++;
                }
                ?>
            </table>
            <div class="l-s" style="margin-top: 50px;margin-left: 50px;">
                ઉપરોક્ત કુટુબના સભ્યો મરનાર મારા માતા/પિતાના કાયદેસરના સીધી લીટીના કુટુબના સભ્યો છે. આ સિવાય બીજા 
            </div>
            <div class="l-s" style="margin-top: 0px;">
                કોઈપણ વારસદારો નથી. 
            </div>
            <div class="l-s" style="margin-top: 10px;margin-left: 50px;">
                સદર હું મરનારના કુટુબના સભ્યો તર્રીકેનું સર્ટીફીકેટનો ઉપયોગ હું સરકારી, અર્ધ-સરકારી તેમજ બેક ખાતે રજુ કરનાર 
            </div>
            <div class="l-s" style="margin-top: 0px;">
                છે. જે મારો જવાબ છે.
            </div>
            <div class="l-s" style="margin-top: 10px;margin-left: 50px;">
                ઉપરોક્ત જવાબ મારા લખાવ્યા મુંજબ ખરો અને બરાબર છે. જે વાંચી-સાંભળી, વાંચી-સંભળાવ્યા બાંદ સમજી 
            </div>
            <div class="l-s" style="margin-top: 0px;">
                વિચારીને કોઈપણ જાતના દાબ-દબાણ કે ધાક-ધમકી વગર બિનકેફીયતથી મે નીચે સહી કરેલ છે.
            </div>
            <div class="l-s" style="margin-top: 10px;">
                તારીખ :- <span class="f-w-b"><?php echo $appointment_date != '0000-00-00' ? convert_to_new_date_format($appointment_date) : '-'; ?></span><br>
                સ્થળ &nbsp; :- <span class="f-w-b"><?php echo $taluka_name; ?></span>
            </div>
            <div class="l-s" style="margin-top: -23px; margin-left: 300px;">
                રૂબરૂ 
            </div>
            <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%; margin-top: -40px;">&nbsp;</div>
            <div class="l-s" style="padding-left: 70%; margin-top: 0px;">તલાટી :- <span class="f-w-b">સેજા<!--<?php // echo $village_name . ' સેજા';         ?>--></span></div>
            <!--            <div style="border-bottom: 1px dashed; margin-top: 10px;">&nbsp;</div>
                        <div>
                            This Report & Statement is electronically generated and no signature is required.
                        </div>-->
        </div>
        <div>
            <pagebreak></pagebreak>
        </div>
        <div style="font-family: arial_unicode_ms;">
            <div class="f-s-title t-a-c l-s" style="margin-top: 10px;"><span class="b-b-1px f-w-b">પંચક્યાસ</span></div>
            <div class="l-s l-h" style="height: 20px; margin-top: 20px;margin-left: 50px;">અમો પંચો નીચે સહી કરનારાઓ </div>
            <div class="l-s l-h" style="height: 40px; margin-top: 20px;">(1) શ્રી/શ્રીમતી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $witness1_name . '&nbsp;&nbsp;&nbsp;'; ?></span>- <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $witness1_age . '&nbsp;&nbsp;&nbsp;'; ?></span>વર્ષ, રહેવાસી ,<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $witness1_address . '&nbsp;&nbsp;&nbsp;'; ?></span></div>
            <div class="l-s l-h" style="height: 40px; margin-top: 0px;">(2) શ્રી/શ્રીમતી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $witness2_name . '&nbsp;&nbsp;&nbsp;'; ?></span>- <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $witness2_age . '&nbsp;&nbsp;&nbsp;'; ?></span>વર્ષ, રહેવાસી ,<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $witness2_address . '&nbsp;&nbsp;&nbsp;'; ?></span></div>
            <div class="l-s" style="margin-top: 10px;">
                નાં તે આજરોજ તલાટી- દમણ અને ડાભેલ રૂબરૂ હાજર થઇ પુછવાથી લખાવીએ છીએ કે મહે. મામલતદાર સાહેબ દમણની 
            </div>
            <div class="l-s" style="margin-top: 30px;">
                ઓફીસમાં મરનાર નાં કુટુબના સભ્યો તરીકેનું સર્ટીફીકેટ મેળવવા જે અરજી કરેલ છે. તેની અમને જાણ છે. 
            </div>
            <div class="l-s l-h" style="height: 20px;margin-left: 50px;">સ્વર્ગસ્થ :-<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $death_person_name . '&nbsp;&nbsp;&nbsp;'; ?></span> જે તેઓનાં  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $relation_deceased_person_text . '&nbsp;&nbsp;&nbsp;'; ?></span> . હતા. જેમનું અવસાન મરણ   </div>
            <div class="l-s l-h" style="height: 20px;">સર્ટીફીકેટ મુજબ તારીખ:-<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . convert_to_new_date_format($death_date) . '&nbsp;&nbsp;&nbsp;'; ?></span> નાં રોજ ગુજરી ગયેલ છે. મરનારના કુટુબના સભ્યો નીચે મુજબ છે. </div>

            <?php $efm_cnt = 1; ?>
            <table class="monthly-income l-s l-h" style="font-size: 13px; margin-top: 5px;font-family: arial_unicode_ms;">
                <tr>
                    <td class="f-w-b t-a-c" style="width: 40px;">ક્રમ નં.</td>
                    <td class="f-w-b t-a-c">નામ</td>
                    <td class="f-w-b t-a-c" style="width: 80px;">ઉમર (વર્ષમાં )</td>
                    <td class="f-w-b t-a-c" style="width: 90px; font-size: 12px;">સંબંધ</td>
                    <td class="f-w-b t-a-c" style="width: 90px;">નોધ </td>
                </tr>
                <?php
                $temp_member_details = json_decode($legal_heirs_details, true);
                foreach ($temp_member_details as $md) {
                    $temp_marital_status = isset($md['member_marital_status']) ? $md['member_marital_status'] : VALUE_ZERO;
                    $temp_relation = isset($md['member_relation']) ? $md['member_relation'] : VALUE_ZERO;
                    $temp_remarks = isset($md['member_remarks']) ? $md['member_remarks'] : VALUE_ZERO;
                    if ($temp_remarks == VALUE_TWO) {
                        $late = 'Late.';
                        $memAge = '-';
                    } else {
                        $late = '';
                        $memAge = isset($md['member_age']) ? $md['member_age'] : '-';
                    }
                    ?>
                    ?>
                    <tr>
                        <td class="t-a-c"><?php echo $efm_cnt; ?></td>
                        <td><?php echo $late . '&nbsp;';
                echo isset($md['member_name']) ? $md['member_name'] : '';
                    ?></td>
                        <td class="t-a-c"><?php echo $memAge; ?></td>
                        <td class="t-a-c"><?php echo isset($relation_deceased_person_array[$temp_relation]) ? $relation_deceased_person_array[$temp_relation] : '-'; ?></td>
                        <td class="t-a-c"><?php echo isset($member_remarks_array[$temp_remarks]) ? $member_remarks_array[$temp_remarks] : '-'; ?></td>
                    </tr>
                    <?php
                    $efm_cnt++;
                }
                ?>
            </table>
            <div class="l-s" style="margin-top: 50px;margin-left: 50px;">
                ઉપરોક્ત કુટુબના સભ્યો મરનારના કાયદેસરના સીધી લીટીના કુટુબના સભ્યો છે. જે અમારી જાણ માહિતી બરાબર છે. 
            </div>
            <div class="l-s" style="margin-top: 0px;">
                જેની અમો ખાત્રી આપીએ છીએ. મરનારના વારસદારો છુપાવવા કે ખોટા બતાવવા એ ફોજદારી ગુન્હો બને છે. તેની અમને જાણ છે. 
            </div>
            <div class="l-s" style="margin-top: 10px;margin-left: 50px;">
                સદર હું મરનારના કુટુબના સભ્યો તર્રીકેનું સર્ટીફીકેટનો ઉપયોગ સરકારી, અર્ધ-સરકારી તેમજ બેક ખાતે રજુ કરનાર છે. 
            </div>
            <div class="l-s" style="margin-top: 0px;">
                જે અમારો જવાબ છે.
            </div>
            <div class="l-s" style="margin-top: 10px;margin-left: 50px;">
                ઉપરોક્ત પંચક્યાસ અમારા લખાવ્યા મુંજબ ખરો અને બરાબર છે. જે વાંચી-સાંભળી, વાંચી-સંભળાવ્યા બાંદ સમજી 
            </div>
            <div class="l-s" style="margin-top: 0px;">
                વિચારીને કોઈપણ જાતના દાબ-દબાણ કે ધાક-ધમકી વગર બિનકેફીયતથી અમે નીચે સહી કરેલ છે.
            </div>
            <div class="l-s" style="margin-top: 10px;">
                તારીખ :- <span class="f-w-b"><?php echo $appointment_date != '0000-00-00' ? convert_to_new_date_format($appointment_date) : '-'; ?></span><br>
                સ્થળ &nbsp; :- <span class="f-w-b"><?php echo $taluka_name; ?></span>
            </div>
            <div class="l-s" style="margin-top: -23px; margin-left: 300px;">
                રૂબરૂ 
            </div>
            <!--<div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%; margin-top: -40px;">&nbsp;</div>-->
            <div class="l-s" style="padding-left: 70%; margin-top: 20px;">(૧) ____________________     </div>
            <div class="l-s" style="padding-left: 70%; margin-top: 20px;">(૨)_____________________   </div>
            <!--            <div style="border-bottom: 1px dashed; margin-top: 10px;">&nbsp;</div>
                        <div>
                            This Report & Statement is electronically generated and no signature is required.
                        </div>-->
        </div>
        <div>
            <pagebreak></pagebreak>
        </div>
        <div style="font-family: arial_unicode_ms;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">રીપોર્ટ</span></div>
            <div class="l-s" style="padding-left: 70%; margin-top: 10px;">જા.નં.&nbsp; :- <span class="f-w-b"><?php echo $application_number; ?></span></div>
            <div class="l-s" style="padding-left: 70%;">તલાટી :- <span class="f-w-b">સેજા</span></div>
            <div class="l-s" style="padding-left: 70%;">તારીખ :- <span class="f-w-b"><?php echo $talathi_to_aci_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($talathi_to_aci_datetime) : '-'; ?></span></div>
            <br>

            <div class="l-s l-h" style="height: 20px;">મહેરબાન મામલતદાર સાહેબ,</div>
            <div class="l-s l-h" style="height: 40px;margin-left: 130px;"><?php echo '&nbsp;&nbsp;&nbsp;' . $taluka_name . '&nbsp;&nbsp;&nbsp;'; ?></div>
            <div class="l-s l-h" style="height: 90px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                આપ સાહેબના પત્ર નં. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $application_number . '&nbsp;&nbsp;&nbsp;'; ?></span> તા:- 
                <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                નાં અનુસંધાનમાં જણાવવાનું  કે   શ્રી/શ્રીમતી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $pre_house_no . ',' . $pre_house_name . ',' . $pre_street . ',' . $pre_village . ',' . $pre_city_text . ',' . $pre_pincode . '&nbsp;&nbsp;&nbsp;'; ?></span> નાંએ મરનાર ના સભ્યો તરીકેનું સર્ટીફીકેટ મેળવવા અરજી કરેલ છે તે બાબતે. 
            </div>
            <div class="l-s l-h" style="height: 20px;margin-left: 50px;">સ્વર્ગસ્થ :-<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $death_person_name . '&nbsp;&nbsp;&nbsp;'; ?></span> જેમનું અવસાન મરણ સર્ટીફીકેટ મુજબ </div>
            <div class="l-s l-h" style="height: 20px;">તારીખ:-<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . convert_to_new_date_format($death_date) . '&nbsp;&nbsp;&nbsp;'; ?></span> નાં રોજ ગુજરી ગયેલ છે. મરનારના કુટુબના સભ્યો નીચે મુજબ છે.  </div>
<?php $efm_cnt = 1; ?>
            <table class="monthly-income l-s l-h" style="font-size: 13px; margin-top: 5px;font-family: arial_unicode_ms;">
                <tr>
                    <td class="f-w-b t-a-c" style="width: 40px;">ક્રમ નં.</td>
                    <td class="f-w-b t-a-c">નામ</td>
                    <td class="f-w-b t-a-c" style="width: 80px;">ઉમર (વર્ષમાં )</td>
                    <td class="f-w-b t-a-c" style="width: 90px; font-size: 12px;">સંબંધ</td>
                    <td class="f-w-b t-a-c" style="width: 90px;">નોધ </td>
                </tr>
                <?php
                $temp_member_details1 = json_decode($legal_heirs_details, true);
                foreach ($temp_member_details1 as $md) {
                    $temp_marital_status = isset($md['member_marital_status']) ? $md['member_marital_status'] : VALUE_ZERO;
                    $temp_relation1 = isset($md['member_relation']) ? $md['member_relation'] : VALUE_ZERO;
                    $temp_remarks = isset($md['member_remarks']) ? $md['member_remarks'] : VALUE_ZERO;
                    if ($temp_remarks == VALUE_TWO) {
                        $late = 'Late.';
                        $memAge = '-';
                    } else {
                        $late = '';
                        $memAge = isset($md['member_age']) ? $md['member_age'] : '-';
                    }
                    ?>
                    <tr>
                        <td class="t-a-c"><?php echo $efm_cnt; ?></td>
                        <td><?php echo $late . '&nbsp;';
                    echo isset($md['member_name']) ? $md['member_name'] : '';
                    ?></td>
                        <td class="t-a-c"><?php echo $memAge; ?></td>
                        <td class="t-a-c"><?php echo isset($relation_deceased_person_array[$temp_relation1]) ? $relation_deceased_person_array[$temp_relation1] : '-'; ?></td>
                        <td class="t-a-c"><?php echo isset($member_remarks_array[$temp_remarks]) ? $member_remarks_array[$temp_remarks] : '-'; ?></td>
                    </tr>
                    <?php
                    $efm_cnt++;
                }
                ?>
            </table>


            <div class="l-s" style="margin-top: 50px;margin-left: 50px;">
                ઉપરોક્ત કુટુબના સભ્યો બીજા કોઈપણ સભ્યો નથી. સદર હું મરનારના કુટુબના સભ્યો તર્રીકેનું સર્ટીફીકેટનો ઉપયોગ 
            </div>
            <div class="l-s" style="margin-top: 0px;">
                સરકારી, અર્ધ-સરકારી તેમજ બેક ખાતે રજુ કરનાર છે. એવું પંચોએ તથા જવાબમાં જણાવેલ છે.
            </div>
            <div class="l-s" style="margin-top: 20px;margin-left: 50px;">
                પ્રકરણે Application, Declaration, Statement, Witness Statement, Death Certificate, Aadhar Card
            </div>
            <div class="l-s" style="margin-top: 0px;">
                ની કોપી સામેલ કરવામાં આવેલ છે. જેની આગળની કાર્યવાહી થવા આપ સાહેબ તરફથી યોગ્ય તે ધટતું થવા વિનંતી.
            </div>
            <!--            <div class="l-s" style="margin-top: 10px;">
                            &#9679; &nbsp; અરજદારની વાર્ષિક આવક રૂ.
                            <div class="b-b-1px f-w-b t-a-c" style="margin-top: -23px; width: 280px; margin-left: 180px;">
<?php echo indian_comma_income($income_by_talathi) . '/-'; ?>
                            </div>
                            <div style="margin-top: -23px; margin-left: 470px;">જેટલી થાય છે.</div>
                        </div>
                        <div class="l-s" style="margin-top: 10px;">
                            &#9679; &nbsp; અરજદારના  ધરના  કુલ  સભ્યોની સંખ્યા  
                            <div class="b-b-1px f-w-b t-a-c" style="margin-top: -23px; width: 200px; margin-left: 230px;">
<?php echo $total_members; ?>
                            </div>
                            <div style="margin-top: -23px; margin-left: 440px;">છે.</div>
                        </div>
                        <div class="l-s" style="margin-top: 10px;">
                            આ સર્ટીફીકેટનો ઉપયોગ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $purpose_of_heirship . '&nbsp;&nbsp;&nbsp;'; ?></span> માટે રજુ કરનાર છે. 
                        </div>
                        <div class="l-s" style="margin-top: 10px;">
                            જે પ્રકરણે  એફિડેવિટ સામેલ છે.
                        </div>-->
            <!--            <div class="l-s" style="margin-top: 10px;">
                            Remarks if any :- <?php echo $talathi_remarks; ?>
                        </div>-->
            <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%;margin-top: 20px;">&nbsp;</div>
            <div class="l-s">
                જે આપ સાહેબને  વિદિત થાય.
            </div>
            <div class="l-s" style="padding-left: 70%; margin-top: -20px;">તલાટી :- <span class="f-w-b">સેજા<?php // echo $village_name . ' સેજા';         ?></span></div>
            <!--<div style="border-bottom: 1px dashed; margin-top: -10px;">&nbsp;</div>-->
            <!--            <div style="margin-top: 10px;">
                            <b>Recommendation of Awal Karkun / Circle Inspector :- </b> <?php echo isset($rec_array[$aci_rec]) ? $rec_array[$aci_rec] : $rec_array[VALUE_TWO]; ?>
                        </div>
                        <div class="l-s" style="margin-top: 10px;">
                            Remarks if any :- <?php echo $aci_remarks; ?>
                        </div>-->
            <!--<div style="border-bottom: 1px dashed; margin-top: -10px;">&nbsp;</div>-->
        </div>
        <div>
            <pagebreak></pagebreak>
        </div>
        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="f-w-b">Application For Heirship Certificate</span></div>
            <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                <tr>
                    <td class="f-w-b">Application Number</td>
                    <td><?php echo $application_number; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Name of Applicant</td>
                    <td><?php echo $applicant_name; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Name of Applicant Father</td>
                    <td><?php echo $applicant_father_name; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Present Address of Applicant</td>
                    <td><?php echo $pre_house_no . ',' . $pre_house_name . ',' . $pre_street . ',' . $pre_village . ',' . $pre_city_text . ',' . $pre_pincode; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Permanent Address</td>
                    <td><?php echo $per_house_no . ',' . $per_house_name . ',' . $per_street . ',' . $per_village . ',' . $per_city_text . ',' . $per_pincode; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Mobile Number / Aadhar Number</td>
                    <td><?php echo $mobile_number . ($aadhar_number != '' ? (' / ' . $aadhar_number) : ''); ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Email Address</td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Village / DMC Ward / SMC Ward</td>
                    <td><?php echo $village_name; ?></td>
                </tr>
                <tr>
                    <!--<td class="f-w-b">Gender / Date of Birth / Age <br> Birth Place </td>-->
                    <td class="f-w-b">Gender / Date of Birth  </td>
                    <td><?php echo (isset($gender_array[$gender]) ? $gender_array[$gender] : ' - ') . ' / ' . convert_to_new_date_format($applicant_dob); ?></td>
                    <!--<td><?php // echo (isset($gender_array[$gender]) ? $gender_array[$gender] : ' - ') . ' / ' . convert_to_new_date_format($applicant_dob) . ' / ' . $applicant_age . ' Years <br>' . $applicant_born_place;       ?></td>-->
                </tr>
                <tr>
                    <td class="f-w-b">Marital Status</td>
                    <td><?php echo $marital_status_text; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Nationality / caste</td>
                    <td style="vertical-align: top;"><?php echo $nationality . ' / ' . $caste; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td><?php echo $occupation_text; ?>&nbsp;-&nbsp;<?php echo $occupation_other; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Relation Deceased Person / Death Person Name</td>
                    <td><?php echo $relation_deceased_person_text . ' / ' . $death_person_name; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Relation with Applicant / Death Date / Death of Place</td>
                    <td><?php echo $relation_with_applicant_text . ' / ' . convert_to_new_date_format($death_date) . ' / ' . $death_place; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Death Aadhar Number / Deceased Person Marital Status </td>
                    <td><?php echo $death_aadhar_number . ' / ' . $death_marital_status_text; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Purpose of Certificate</td>
                    <td><?php echo $final_remarks; ?></td>
                </tr>
            </table>
            <div style="margin-top: 20px;">
                <b style="font-size: 14px;">Details of family members</b>
<?php $this->load->view('heirship/pdf_mi', array('marital_status_array' => $marital_status_array, 'relation_deceased_person_array' => $relation_deceased_person_array, 'member_remarks_array' => $member_remarks_array)); ?>
            </div>
            <div style="margin-top: 20px;">
                <b style="font-size: 14px;">Witness Details</b>
                <table class="monthly-income" style="font-size: 13px; margin-top: 5px;">
                    <tr>
                        <td class="f-w-b t-a-c" style="width: 60px;">Sr. No</td>
                        <td class="f-w-b t-a-c">Witness Name</td>
                        <td class="f-w-b t-a-c" style="width: 60px;">Age</td>
                        <td class="f-w-b t-a-c" style="width: 250px;">Address</td>
                    </tr>
                    <tr>
                        <td class="t-a-c"><?php echo VALUE_ONE; ?></td>
                        <td><?php echo $witness1_name; ?></td>
                        <td class="t-a-c"><?php echo $witness1_age; ?></td>
                        <td class="t-a-c"><?php echo $witness1_address; ?></td>
                    </tr>
                    <tr>
                        <td class="t-a-c"><?php echo VALUE_TWO; ?></td>
                        <td><?php echo $witness2_name; ?></td>
                        <td class="t-a-c"><?php echo $witness2_age; ?></td>
                        <td class="t-a-c"><?php echo $witness2_address; ?></td>
                    </tr>
                </table>
            </div>

<!--            <table class="app-form-income" style="font-size: 13px; margin-top: 20px;">
    <tr>
        <td class="f-w-b" style="width: 50%;">For What Purpose is the Certificate of Income Required</td>
        <td style="vertical-align: top;"><?php echo $purpose_of_heirship; ?></td>
    </tr>
</table>
<table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
    <tr>
        <td class="f-w-b" style="width: 50%;">Did you applied for a Certificate of Income at any time before and if so, when ?</td>
        <td style="vertical-align: top;"><?php echo isset($yes_no_array[$did_you_apply_heirship_before]) ? ($yes_no_array[$did_you_apply_heirship_before] . ($did_you_apply_heirship_before == VALUE_ONE ? ' (' . $when_you_apply_heirship . ')' : '')) : $yes_no_array[VALUE_TWO]; ?></td>
    </tr>
</table>
<table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
    <tr>
        <td class="f-w-b" style="width: 50%;">Total Income</td>
        <td style="vertical-align: top; text-align: right;" class="f-w-b"><?php echo indian_comma_income($total_income) . '/-'; ?></td>
    </tr>
</table>
</div>-->
            <div>
                <pagebreak></pagebreak>
            </div>
            <div style="font-size: 13px;">
                <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
                <div class="l-s" style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    I the undersigned <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $applicant_name; ?> &nbsp;&nbsp;&nbsp;</span>
                    Resident of <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $pre_house_no . ',&nbsp;' . $pre_house_name . ',&nbsp;' . $pre_street . ',&nbsp;' . $pre_village . ',&nbsp;' . $pre_city_text . ',&nbsp;' . $pre_pincode; ?> &nbsp;&nbsp;&nbsp;</span>,
                    <!--Age <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;{{applicant_age}}&nbsp;&nbsp;&nbsp;</span>,-->
                    Marital Status :- <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $marital_status_text; ?>&nbsp;&nbsp;&nbsp;</span>,
                    Occupation <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $occupation_text; ?>-&nbsp;<?php echo $occupation_other; ?>&nbsp;&nbsp;&nbsp;</span>
                    Nationality <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $nationality; ?>&nbsp;&nbsp;&nbsp;</span>
                    declaring are as under :-
                </div>
                <div class="l-s l-h" style="text-align: justify; text-justify: inter-word; margin-top: 5px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    1. That my <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $relation_deceased_person_text; ?>&nbsp;(<?php echo $death_person_name; ?>)&nbsp;&nbsp;&nbsp;</span> was expired on <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo convert_to_new_date_format($death_date); ?>&nbsp;&nbsp;&nbsp;</span>
                    at <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $death_place; ?> &nbsp;&nbsp;&nbsp;</span>, and leaving behind following family members. 

                </div>
<?php $this->load->view('heirship/pdf_mi', array('profession_array' => $profession_array, 'app_occupation' => $app_occupation)); ?>

                <div class="l-s l-h" style="margin-top: 5px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    2. That after the death of my <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $relation_deceased_person_text; ?>&nbsp;(<?php echo $death_person_name; ?>)&nbsp;&nbsp;&nbsp;</span>, I/We
                    <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;
                        <?php
                        $temp_member_details = json_decode($legal_heirs_details, true);
                        foreach ($temp_member_details as $md) {
                            $temp_remarks = isset($md['member_remarks']) ? $md['member_remarks'] : VALUE_ZERO;
                            if ($temp_remarks == VALUE_TWO) {
                                $late = 'Late.';
                                $memAge = '';
                            } else {
                                $late = '';
                                $memAge = isset($md['member_age']) ? $md['member_age'] : '-';
                            }
                            ?>
                            <?php
                            echo $late . '&nbsp;';
                            echo isset($md['member_name']) ? $md['member_name'] : '';
                            echo ',';
                        }
                        ?>
                        &nbsp;&nbsp;&nbsp;</span>only the legal heirs of deceased person.
                </div>
                <div class="l-s l-h" style="text-align: justify; text-justify: inter-word;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    3. That except above no other legal heir is having of deceased person.
                </div>
                <div class="l-s f-w-b" style="text-align: justify; text-justify: inter-word; margin-top: 5px; font-size: 12px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein.
                    I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the 
                    punishment as per the law and that the benefits availed by me shall be summarily withdrawn.
                </div>
                <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian Penal Code which state as follows:-
                </div>
                <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 5px; font-size: 12px;">
                    <b>Section 199. False statement made in declaration which is by law receivable as evidence:- </b>
                    <div>
                        Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or 
                        any Public Servant or other person, is bound or authorized bylaw to receive as evidence of any fact, 
                        makes any statement which is false, and which he either knows or believes to be false or does not 
                        believe to be true, touching any point material to the object for which the declaration is made or 
                        used, shall be punished in the same manner as if he gave false evidence.
                    </div>
                </div>
                <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 5px; font-size: 12px;">
                    <b>Section 200. Using as true such declaration knowing it to be false:- </b>
                    Whoever corruptly uses or attempts to use as true any such declaration, knowing the 
                    same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
                </div>
                <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                    <b>Explanation :- </b>
                    A declaration which is inadmissible merely upon the ground of some informality, is a declaration within the meaning of Sections 199 and 200.
                </div>
                <table style="margin-top: 5px; width: 100%;">
                    <tr>
                        <td style="vertical-align: top; width: 33%;">
                            <b>Place&nbsp; :-</b> <?php echo $taluka_name; ?><br>
                            <b>Dated :-</b> <?php echo convert_to_new_date_format($submitted_datetime); ?>
                        </td>
                        <td class="t-a-c" style="width: 25%;">
                            <img src='<?php echo HEIRSHIP_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'
                                 style="width: 110px; height: 100px; border: 1px solid;" />
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
                    <tr>
                        <td style="vertical-align: top; width: 33%;"><span class="b-b-1px f-w-b">Witness :-</span></td>
                    <tr>
                        <td style="vertical-align: top; width: 33%;">
                            <b>1. Witness Name & Address &nbsp; :-</b> <?php echo '&nbsp;&nbsp;&nbsp;' . $witness1_name . '&nbsp;&nbsp;&nbsp;'; ?>, <?php echo '&nbsp;&nbsp;&nbsp;' . $witness1_address . '&nbsp;&nbsp;&nbsp;'; ?></span>
                        </td>
                        <td class="t-a-c" style="width: 25%;">
                            <img src='<?php echo HEIRSHIP_CERTIFICATE_DOC_PATH . $witness1_photo_doc; ?>'
                                 style="width: 90px; height: 80px; border: 1px solid;" />
                        </td>
                    <tr>
                        <td style="vertical-align: top; width: 33%;">
                            <b>2. Witness Name & Address &nbsp; :-</b> <?php echo '&nbsp;&nbsp;&nbsp;' . $witness2_name . '&nbsp;&nbsp;&nbsp;'; ?>, <?php echo '&nbsp;&nbsp;&nbsp;' . $witness2_address . '&nbsp;&nbsp;&nbsp;'; ?></span>
                        </td>
                        <td class="t-a-c" style="width: 25%;">
                            <img src='<?php echo HEIRSHIP_CERTIFICATE_DOC_PATH . $witness2_photo_doc; ?>'
                                 style="width: 90px; height: 80px; border: 1px solid;" />
                        </td>
                    </tr>
                    </tr>
                </table>
            </div>
    </body>
</html>
