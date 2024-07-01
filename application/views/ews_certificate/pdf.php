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
                line-height: 22px;
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
        $daman_villages_array = $this->config->item('daman_villages_array');
        $diu_villages_array = $this->config->item('diu_villages_array');
        $dnh_villages_array = $this->config->item('dnh_villages_array');
        $marital_status_array = $this->config->item('marital_status_array');
        $taluka_array = $this->config->item('taluka_array');
        $taluka_array_guj = $this->config->item('taluka_array_guj');
        $gender_array = $this->config->item('gender_array');
        $relation_deceased_person_array = $this->config->item('relation_deceased_person_array');

        $taluka_name_text = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        $taluka_name_guj = isset($taluka_array_guj[$district]) ? $taluka_array_guj[$district] : '-';
        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');
        $gender_text = (isset($gender_array[$gender]) ? $gender_array[$gender] : '-');
        $relation_deceased_person_text = (isset($relation_deceased_person_array[$relationship_of_applicant]) ? $relation_deceased_person_array[$relationship_of_applicant] : '');
        if ($district == TALUKA_DAMAN)
            $village_name_text = (isset($daman_villages_array[$village_name]) ? $daman_villages_array[$village_name] : '');
        else if ($district == TALUKA_DIU)
            $village_name_text = (isset($diu_villages_array[$village_name]) ? $diu_villages_array[$village_name] : '');
        else if ($district == TALUKA_DNH)
            $village_name_text = (isset($dnh_villages_array[$village_name]) ? $dnh_villages_array[$village_name] : '');

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
            <br>
            <div class="l-s l-h" style="height: 90px;">
                મહેરબાન મામલતદાર સાહેબ,<br/><?php echo $taluka_name_guj; ?>
            </div>
            <div class="l-s l-h" style="height: 90px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                આપ સાહેબના પત્ર નં. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $application_number . '&nbsp;&nbsp;&nbsp;'; ?></span> તા:- 
                <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                નાં અનુસંધાનમાં જણાવવાનું  કે   શ્રી/શ્રીમતી/કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>, 
                <?php if ($constitution_artical == VALUE_TWO) { ?>
                    ,તેઓના પુત્ર/પુત્રી  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $minor_child_name . '&nbsp;&nbsp;&nbsp;'; ?></span>
                <?php } ?>રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;' . $com_addr_city . '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે.<br/>

                અરજદારનો જન્મ  :- <span class="b-b-1px f-w-b"><?php
                    echo '&nbsp;&nbsp;&nbsp;' .
                    $born_place_village_text . '&nbsp;&nbsp;&nbsp;';
                    ?></span> તાલુકા  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>જીલ્લો <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>

                અરજદારનો મુળવતન  :- <span class="b-b-1px f-w-b"><?php
                    echo '&nbsp;&nbsp;&nbsp;' .
                    $born_place_village_text . '&nbsp;&nbsp;&nbsp;';
                    ?></span> તાલુકા  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>જીલ્લો <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>

                અરજદારનો ભણતર  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_education . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/>

                અરજદારનો રહેણાંક ઘર નં. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;' . $com_addr_city . '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?> </span> રાશનકાર્ડ નં.   -  અનું. નં.   - છે, અરજદારનુ નામ મતદાર યાદીમા અનુંક્રમ નંબર -  થી નોધાયેલ છે. <br/>


                પોલીસ  સ્ટેશન / આઉટ  પોસ્ટ  <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $present_police_station; ?> &nbsp;&nbsp;&nbsp; </span> છે. તેમજ  પોસ્ટ  ઓફીસ <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $present_post_office; ?> &nbsp;&nbsp;&nbsp; </span> છે. <br/>

                અરજદાર જાતિએ જન્મથી <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $applicant_caste; ?> &nbsp;&nbsp;&nbsp; </span> / <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $applicant_religion; ?> &nbsp;&nbsp;&nbsp; </span> જાતિના છે. <br/> 
                અરજદારના માતા અને પિતા પણ જન્મથી એ જ જાતિના છે, જેમના નામો નીચે મુજબ છે. <br/>

                પિતાનું નામ <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $father_name; ?> &nbsp;&nbsp;&nbsp; </span> માતાનું નામ <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $mother_name; ?> &nbsp;&nbsp;&nbsp; </span><br/>

                એમનું કાયમી રહેઠાણ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;' . $com_addr_city . '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે.<br/>

                અરજદારના પિતાનો ધંધો  <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $father_occupation; ?> &nbsp;&nbsp;&nbsp; </span> છે.<br/>

                જેની સને <?php echo $application_year; ?>  ની વાર્ષિક આવક રૂ.<span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $father_total_income; ?> /- &nbsp;&nbsp;&nbsp; </span> જેટલી થાય છે.   <br/>

                અરજદાર હાલે  <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $applicant_education; ?> &nbsp;&nbsp;&nbsp; </span> કરે છે .<br/>                     

<?php if ($agricultural_area != '' || $residental_flat_area != '' || $residental_plot_urban_area != '' || $residental_plot_rural_area != '') { ?>
                    અરજદાર પિતાના નામે નીચે મુજબ મિલકત નોધાયેલ છે.
                    <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                        <tr>
                            <td class="f-w-b t-a-c">Sr. No</td>
                            <td class="f-w-b t-a-c">Asset</td>
                            <td class="f-w-b t-a-c">Area (in sq.yd/sq.ft)</td>
                            <td class="f-w-b t-a-c">Location</td>
                        </tr>
                        <tr>
                            <td class="f-w-b t-a-c">1.</td>
                            <td>Agricultural</td>
                            <td class="t-a-c"><?php echo $agricultural_area; ?></td>
                            <td class="t-a-c"><?php echo $agricultural_location; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b t-a-c">2.</td>
                            <td>Residental Flat</td>
                            <td class="t-a-c"><?php echo $residental_flat_area; ?></td>
                            <td class="t-a-c"><?php echo $residental_flat_location; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b t-a-c">3.</td>
                            <td>Residental plot in urban areas i.e.notified Municipality/Municipal Corporation/Municipality etc.anywhere in the Country</td>
                            <td class="t-a-c"><?php echo $residental_plot_urban_area; ?></td>
                            <td class="t-a-c"><?php echo $residental_plot_urban_location; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b t-a-c">4.</td>
                            <td>Residential plot in areas other than the urban areas i.e.Rural Areas anywhere in the Country</td>
                            <td class="t-a-c"><?php echo $residental_plot_rural_area; ?></td>
                            <td class="t-a-c"><?php echo $residental_plot_rural_location; ?></td>
                        </tr>
                    </table>
                    આ સિવાય 
<?php } ?>    
<?php echo $taluka_name_guj; ?> મુકામે કે અન્ય કોઈ પણ સ્થળે કોઈ પણ જાતની મિલકત નોધાયેલ નથી, મારી કે મારા પરિવારની ઉપર જણાવેલ સિવાય અન્ય સ્ત્રોત થી કોઈ પણ આવક નથી જેની હુ ખાત્રી આપુ છુ,<br/>                                                                   

                સદરહુ સર્ટીફીકેટ માટે જે અરજી પત્રક તેમજ સોગંદનામા માં રજુ કરેલ વિગત સાચી અને   બરાબર છે, તેની અરજદારે ખાત્રી આપી છે, તેમજ અરજી પત્રક તેમજ સોગંદનામા મા રજુ કરેલ વિગત ખોટી હશે તો તેની સંપ્રુણ જવાબદારી અરજદારની રહેશે અને જો સદરહુ વિગત ખોટી હશે તો અરજદારનુ સર્ટીફીકેટ રદ કરવામા આવશે તેની તેમને જાણ છે . 
                <br/>                                                                 
                <div class="l-s" >                                                  
                    આ EWS સર્ટીફીકેટનો ઉપયોગ અરજદાર <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $purpose_of_ews_certificate; ?> &nbsp;&nbsp;&nbsp; </span> માટે કરનાર છે. 
                    <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%;">&nbsp;</div>
                    <div class="l-s">
                        જે આપ સાહેબને  વિદિત થાય.
                    </div>
                    <div class="l-s" style="padding-left: 70%; margin-top: -20px;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text_seja . ' સેજા'; ?></span></div>
                    <div style="border-bottom: 1px dashed; margin-top: -10px;">&nbsp;</div>


                    <div>
                        <pagebreak></pagebreak>
                    </div>

                    <div class="f-s-title t-a-c l-s" style="margin-top: 10px;"><span class="b-b-1px f-w-b">અરજદારનો જવાબ</span></div>

                    <div class="l-s l-h" style="height: 90px; margin-top: 20px;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        હુ    નીચે    સહી    કરનાર  શ્રી / શ્રીમતી / કુમાર / કુમારી / મી. / મીસીસ
                        <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>     ઉંમર    <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_age . '&nbsp;&nbsp;&nbsp;'; ?></span>
                        <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;' . $com_addr_city . '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?> </span> આજરોજ તલાટી
                        <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $village_name_text_seja . '&nbsp;&nbsp;&nbsp;'; ?> </span>રૂબરૂ હાજર થઇ પૂછવાથી લખાવુ છુ કે <br/>   

                        મારો જન્મ   <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?>   તાલુકા  <?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>   જીલ્લો  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span> <br/>   
                        મારુ મુળવતન <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_village_text . '&nbsp;&nbsp;&nbsp;'; ?>   તાલુકા  <?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_district_text . '&nbsp;&nbsp;&nbsp;'; ?></span>   જીલ્લો <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $born_place_state_text . '&nbsp;&nbsp;&nbsp;'; ?></span>  <br/>
                        મારું ભણતર  <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_education . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.<br/> 

                        મારો રહેણાંક ઘર નં.<span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;' . $com_addr_city . '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?> </span> રાશનકાર્ડ નં.   -   અનું. નં.   
                        છે, મારુ નામ મતદાર યાદીમા અનુંક્રમ નંબર  -   થી નોધાયેલ છે.<br/> 


                        પોલીસ સ્ટેશન / આઉટ પોસ્ટ    <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $present_police_station; ?> &nbsp;&nbsp;&nbsp; </span>   છે. તેમજ પોસ્ટ ઓફિસ <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $present_post_office; ?> &nbsp;&nbsp;&nbsp; </span><br/>   

                        હુ જાતિએ જન્મથી  <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $applicant_caste; ?> &nbsp;&nbsp;&nbsp; </span> / <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $applicant_religion; ?> &nbsp;&nbsp;&nbsp; </span> જાતિનો છુ.  મારા માતા અને પિતા પણ
                        જન્મથી એ જ જાતિના છે,  જેમના નામો નીચે મુજબ છે.   <br/>                     

                        પિતાનું નામ <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $father_name; ?> &nbsp;&nbsp;&nbsp; </span> માતાનું નામ <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $mother_name; ?> &nbsp;&nbsp;&nbsp; </span><br/>

                        એમનું કાયમી રહેઠાણ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $com_addr_village_dmc_ward . '&nbsp;&nbsp;&nbsp;' . $com_addr_city . '&nbsp;&nbsp;&nbsp;' . $com_pincode . '&nbsp;&nbsp;&nbsp;'; ?> </span> છે.<br/>

                        મારા પિતાનો ધંધો <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $father_occupation; ?> &nbsp;&nbsp;&nbsp; </span>  છે.     <br/>   
                        જેની સને <?php echo $application_year; ?> ની વાર્ષિક આવક રૂ.<span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $father_total_income; ?> &nbsp;&nbsp;&nbsp; </span> જેટલી થાય છે.<br/>   
                        હાલે હુ <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $applicant_education; ?> &nbsp;&nbsp;&nbsp; </span>   કરુ છુ.<br/>   

<?php if ($agricultural_area != '' || $residental_flat_area != '' || $residental_plot_urban_area != '' || $residental_plot_rural_area != '') { ?>
                            મારા પિતાના નામે નીચે મુજબ મિલકત નોધાયેલ છે.
                            <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                                <tr>
                                    <td class="f-w-b t-a-c">Sr. No</td>
                                    <td class="f-w-b t-a-c">Asset</td>
                                    <td class="f-w-b t-a-c">Area (in sq.yd/sq.ft)</td>
                                    <td class="f-w-b t-a-c">Location</td>
                                </tr>
                                <tr>
                                    <td class="f-w-b t-a-c">1.</td>
                                    <td>Agricultural</td>
                                    <td class="t-a-c"><?php echo $agricultural_area; ?></td>
                                    <td class="t-a-c"><?php echo $agricultural_location; ?></td>
                                </tr>
                                <tr>
                                    <td class="f-w-b t-a-c">2.</td>
                                    <td>Residental Flat</td>
                                    <td class="t-a-c"><?php echo $residental_flat_area; ?></td>
                                    <td class="t-a-c"><?php echo $residental_flat_location; ?></td>
                                </tr>
                                <tr>
                                    <td class="f-w-b t-a-c">3.</td>
                                    <td>Residental plot in urban areas i.e.notified Municipality/Municipal Corporation/Municipality etc.anywhere in the Country</td>
                                    <td class="t-a-c"><?php echo $residental_plot_urban_area; ?></td>
                                    <td class="t-a-c"><?php echo $residental_plot_urban_location; ?></td>
                                </tr>
                                <tr>
                                    <td class="f-w-b t-a-c">4.</td>
                                    <td>Residential plot in areas other than the urban areas i.e.Rural Areas anywhere in the Country</td>
                                    <td class="t-a-c"><?php echo $residental_plot_rural_area; ?></td>
                                    <td class="t-a-c"><?php echo $residental_plot_rural_location; ?></td>
                                </tr>
                            </table>
                            આ સિવાય
<?php } ?>
<?php echo $taluka_name_guj; ?> મુકામે કે અન્ય કોઈ પણ 
                        સ્થળે કોઈ પણ જાતની મિલકત નોધાયેલ નથી, મારી કે મારા પરિવારની ઉપર જણાવેલ સિવાય અન્ય  
                        સ્ત્રોત થી કોઈ પણ આવક નથી જેની હુ ખાત્રી આપુ છુ,     <br/>         

                        સદરહુ સર્ટીફીકેટ માટે જે અરજી પત્રક તેમજ સોગંદનામા માં રજુ કરેલ વિગત સાચી અને   બરાબર છે, તેની હુ ખાત્રી આપું છુ, તેમજ અરજી પત્રક તેમજ સોગંદનામા માં રજુ કરેલ વિગત ખોટી   હશે તો તેની સંપ્રુણ જવાબદારી મારી રહેશે અને જો સદરહુ વિગત ખોટી હશે તો મારુ સર્ટીફીકેટ રદ કરવામા આવશે તેની મને જાણ છે  <br/>   

                        આ EWS સર્ટીફીકેટનો ઉપયોગ હુ <span class="b-b-1px f-w-b"> &nbsp;&nbsp;&nbsp; <?php echo $purpose_of_ews_certificate; ?> &nbsp;&nbsp;&nbsp; </span> માટે કરનાર છુ.<br/>   

                        ઉપરોક્ત જવાબ મારા લખાવ્યા મુજબ ખરો અને બરાબર છે.  જે બદલ મે નીચે સહી કરેલ છે.<br/>   
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
                    <div class="f-s-title t-a-c l-s"><span class="f-w-b">Application For Issuance of Income & Asset Certificate</span></div>
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
                            <td class="f-w-b">Village / DMC Ward / SMC Ward</td>
                            <td><?php echo $village_name_text; ?></td>
                        </tr>
                        <tr>
                            <?php if ($constitution_artical == VALUE_TWO) { ?>
                                <td class="f-w-b">Name of Applicant / Gaurdian Name</td>
                            <?php } else { ?>
                                <td class="f-w-b">Name of Applicant</td>
                        <?php } ?>
                            <td><?php echo $applicant_name; ?></td>
                        </tr>
<?php if ($constitution_artical == VALUE_ONE) { ?>
                            <tr>
                                <td class="f-w-b">Father's / Husband's Name </td>
                                <td><?php echo $father_husbund_name; ?></td>
                            </tr>
<?php } ?>
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
                            <td><?php echo $com_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $com_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $com_addr_street . '&nbsp;&nbsp;&nbsp;' . $commu_add_state_name . '&nbsp;&nbsp;&nbsp;' . $commu_add_district_name . '&nbsp;&nbsp;&nbsp;' . $commu_add_village_name . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $com_addr_city ; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Permanent Address</td>
                            <td><?php echo $per_addr_house_no . '&nbsp;&nbsp;&nbsp;' . $per_addr_house_name . '&nbsp;&nbsp;&nbsp;' . $per_addr_street . '&nbsp;&nbsp;&nbsp;' . $per_addr_state_name . '&nbsp;&nbsp;&nbsp;' . $per_addr_district_name . '&nbsp;&nbsp;&nbsp;' . $per_addr_village_name . '&nbsp;&nbsp;&nbsp;'; ?> <?php echo $per_addr_city ; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Mobile Number / Aadhar Number</td>
                            <td><?php echo $mobile_no . ($aadhaar != '' ? (' / ' . $aadhaar) : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Pan Card / email</td>
                            <td><?php echo $pancard . ($email != '' ? (' / ' . $email) : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Gender / Date of Birth / Age </td>
                            <td><?php echo (isset($gender_array[$gender]) ? $gender_array[$gender] : ' - ') . ' / ' . convert_to_new_date_format($applicant_dob) . ' / ' . $applicant_age . ' Years' ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Birth Place</td>
                            <td><?php echo $born_place; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Marital Status</td>
                            <td><?php echo $marital_status_text; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">Applicant Religion  / Caste</td>
                            <td style="vertical-align: top;"><?php echo $applicant_religion . ' / ' . $applicant_caste; ?></td>
                        </tr>
                        <!-- <tr>
                            <td class="f-w-b">Places of Stay since Birth</td>
                            <td><?php //echo $born_place_state_text;  ?> , <?php //echo $born_place_district_text;  ?> , <?php //echo $born_place_village_text;  ?></td>
                        </tr> -->
                        <tr>
                            <td class="f-w-b">Education</td>
                            <td><?php echo $applicant_education; ?></td>
                        </tr>
                        <tr>
                            <td class="f-w-b">For What Purpose is the Certificate of EWS Required</td>
                            <td><?php echo $purpose_of_ews_certificate; ?></td>
                        </tr>
                    </table>
                    <div style="margin-top: 20px;">
                        <b style="font-size: 14px;"> Places of Stay since Birth</b>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                            <tr>
                                <td class="f-w-b">Sr.No.</td>
                                <td class="f-w-b">State</td>
                                <td class="f-w-b">District</td>
                                <td class="f-w-b">Village / Town</td>
                                <td class="f-w-b">Tehsil</td>
                                <td class="f-w-b">Birth Period</td>
                            </tr>
                            <?php
                            $bsp_cnt = 1;
                            $temp_birth_stay_place_details = json_decode($birth_stay_place_details, true);
                            foreach ($temp_birth_stay_place_details as $bsp) {
                                ?>
                                <tr>
                                    <td ><?php echo $bsp_cnt; ?></td>
                                    <td ><?php echo $bsp['born_place_state_text']; ?></td>
                                    <td ><?php echo $bsp['born_place_district_text']; ?></td>
                                    <td ><?php echo $bsp['born_place_village_text']; ?></td>
                                    <td ><?php echo $bsp['born_place_tehsil']; ?></td>
                                    <td ><?php echo $bsp['born_period']; ?></td>
                                <?php $bsp_cnt++; ?>
                                </tr>
<?php } ?>
                        </table>
                    </div>
                    <div style="margin-top: 20px;">
                        <b style="font-size: 14px;"> Family Details</b>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">

                            <tr>
                                <td class="f-w-b">Sr.No.</td>
                                <td class="f-w-b">Family Member Detail</td>
                                <td class="f-w-b">Name</td>
                                <td class="f-w-b">Age</td>
                                <td class="f-w-b">Occupation/Education</td>
                                <td class="f-w-b">Remark</td>
                            </tr>
                            <tr>
                                <td class="f-w-b">1.</td>
                                <td >Father</td>
                                <td ><?php echo $father_name; ?></td>
                                <td ><?php echo $father_age; ?></td>
                                <td ><?php echo $father_occupation; ?></td>
                                <td ><?php echo $father_remark; ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">2.</td>
                                <td >Mother</td>
                                <td ><?php echo $mother_name; ?></td>
                                <td ><?php echo $mother_age; ?></td>
                                <td ><?php echo $mother_occupation; ?></td>
                                <td ><?php echo $mother_remark; ?></td>
                            </tr>
                            <?php
                            $bro_cnt = 1;
                            $temp_sibling_bro_details = json_decode($sibling_bro_details, true);
                            foreach ($temp_sibling_bro_details as $sbro) {
                                ?>
                                <tr>
                                    <?php if ($bro_cnt == 1) { ?>
                                        <td class="f-w-b" rowspan="<?= count($temp_sibling_bro_details) ?>">3.</td>
                                        <td rowspan="<?= count($temp_sibling_bro_details) ?>">Sibling Brother Details </td>
    <?php } ?>
                                    <td ><?php echo $sbro['sibling_bro_name']; ?></td>
                                    <td ><?php echo $sbro['sibling_bro_age']; ?></td>
                                    <td ><?php echo $sbro['sibling_bro_occu_edu']; ?></td>
                                    <td ><?php echo $sbro['sibling_bro_remark']; ?></td>
                                <?php $bro_cnt++; ?>
                                </tr>
                            <?php } ?>
                            <?php
                            $sis_cnt = 1;
                            $temp_sibling_sis_details = json_decode($sibling_sis_details, true);
                            foreach ($temp_sibling_sis_details as $ssis) {
                                ?>
                                <tr>
                                    <?php if ($sis_cnt == 1) { ?>
                                        <td class="f-w-b" rowspan="<?= count($temp_sibling_sis_details) ?>">4.</td>
                                        <td rowspan="<?= count($temp_sibling_sis_details) ?>">Sibling Sister Details </td>
    <?php } ?>
                                    <td ><?php echo $ssis['sibling_sis_name']; ?></td>
                                    <td ><?php echo $ssis['sibling_sis_age']; ?></td>
                                    <td ><?php echo $ssis['sibling_sis_occu_edu']; ?></td>
                                    <td ><?php echo $ssis['sibling_sis_remark']; ?></td>
                                <?php $sis_cnt++; ?>
                                </tr>
                            <?php } ?>
                            <?php
                            $son_cnt = 1;
                            $temp_son_details = json_decode($son_details, true);
                            foreach ($temp_son_details as $son) {
                                ?>
                                <tr>
                                    <?php if ($son_cnt == 1) { ?>
                                        <td class="f-w-b" rowspan="<?= count($temp_son_details) ?>">5.</td>
                                        <td rowspan="<?= count($temp_son_details) ?>">Children Details (Son) </td>
    <?php } ?>
                                    <td ><?php echo $son['children_son_name']; ?></td>
                                    <td ><?php echo $son['children_son_age']; ?></td>
                                    <td ><?php echo $son['children_son_occu_edu']; ?></td>
                                    <td ><?php echo $son['children_son_remark']; ?></td>
                                <?php $son_cnt++; ?>
                                </tr>
                            <?php } ?>
                            <?php
                            $daughter_cnt = 1;
                            $temp_daughter_details = json_decode($daughter_details, true);
                            foreach ($temp_daughter_details as $daughter) {
                                ?>
                                <tr>
                                    <?php if ($daughter_cnt == 1) { ?>
                                        <td class="f-w-b" rowspan="<?= count($temp_daughter_details) ?>">6.</td>
                                        <td rowspan="<?= count($temp_daughter_details) ?>">Children Details (Daughter) </td>
    <?php } ?>
                                    <td ><?php echo $daughter['children_daughter_name']; ?></td>
                                    <td ><?php echo $daughter['children_daughter_age']; ?></td>
                                    <td ><?php echo $daughter['children_daughter_occu_edu']; ?></td>
                                    <td ><?php echo $daughter['children_daughter_remark']; ?></td>
                                <?php $daughter_cnt++; ?>
                                </tr>
<?php } ?>

                        </table>
                    </div>
                    <div style="margin-top: 20px;">
                        <b style="font-size: 14px;"> Details of Income & Asset Certificate/s issued earlier</b>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                            <tr>
                                <td class="f-w-b">Sr.No.</td>
                                <td class="f-w-b">Issuing Authority</td>
                                <td class="f-w-b">Certificate.No.</td>
                                <td class="f-w-b">Issued Date</td>
                                <td class="f-w-b">Valid up to</td>
                            </tr>
                            <?php
                            $detail_cnt = 1;
                            $temp_income_certy_details = json_decode($income_certy_details, true);
                            foreach ($temp_income_certy_details as $incomecerty) {
                                ?>
                                <tr>
                                    <td ><?php echo $detail_cnt; ?></td>
                                    <td ><?php echo $incomecerty['issuing_authority']; ?></td>
                                    <td ><?php echo $incomecerty['certificate_no']; ?></td>
                                    <td ><?php echo $incomecerty['issue_date']; ?></td>
                                    <td ><?php echo $incomecerty['valid_up_to_date']; ?></td>
                                </tr>
                                <?php
                                $detail_cnt++;
                            }
                            ?>
                        </table>
                    </div>
                    <div style="margin-top: 20px;">
                        <b style="font-size: 14px;"> Gross annual income of the Family</b>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">

                            <tr>
                                <td class="f-w-b">Sr.No.</td>
                                <td class="f-w-b">Source of Income Member</td>
                                <td class="f-w-b">Salary</td>
                                <td class="f-w-b">Business</td>
                                <td class="f-w-b">Agriculture</td>
                                <td class="f-w-b">Profession</td>
                                <td class="f-w-b">Other Source(please specify)</td>
                                <td class="f-w-b">Total Income</td>
                            </tr>
                            <tr>
                                <td class="f-w-b">1.</td>
                                <td >Father</td>
                                <td ><?php echo $father_salary_detail; ?></td>
                                <td ><?php echo $father_business_detail; ?></td>
                                <td ><?php echo $father_agri_detail; ?></td>
                                <td ><?php echo $father_profe_detail; ?></td>
                                <td ><?php echo $father_other_detail; ?></td>
                                <td ><?php echo $father_total_income; ?></td>
                            </tr>
                            <tr>
                                <td class="f-w-b">2.</td>
                                <td >Mother</td>
                                <td ><?php echo $mother_salary_detail; ?></td>
                                <td ><?php echo $mother_business_detail; ?></td>
                                <td ><?php echo $mother_agri_detail; ?></td>
                                <td ><?php echo $mother_profe_detail; ?></td>
                                <td ><?php echo $mother_other_detail; ?></td>
                                <td ><?php echo $mother_total_income; ?></td>
                            </tr>
                            <?php
                            $bro_income_cnt = 1;
                            $temp_sibling_broincome_details = json_decode($sibling_broincome_details, true);
                            foreach ($temp_sibling_broincome_details as $sbroincome) {
                                ?>
                                <tr>
                                    <?php if ($bro_income_cnt == 1) { ?>
                                        <td class="f-w-b" rowspan="<?= count($temp_sibling_broincome_details) ?>">3.</td>
                                        <td rowspan="<?= count($temp_sibling_broincome_details) ?>">Sibling Brother Details </td>
    <?php } ?>
                                    <td ><?php echo $sbroincome['sibling_bro_sallary']; ?></td>
                                    <td ><?php echo $sbroincome['sibling_bro_business']; ?></td>
                                    <td ><?php echo $sbroincome['sibling_bro_agri']; ?></td>
                                    <td ><?php echo $sbroincome['sibling_bro_proffe']; ?></td>
                                    <td ><?php echo $sbroincome['sibling_bro_other_sour']; ?></td>
                                    <td ><?php echo $sbroincome['sibling_bro_income']; ?></td>
                                <?php $bro_income_cnt++; ?>
                                </tr>
                            <?php } ?>
                            <?php
                            $sis_income_cnt = 1;
                            $temp_sibling_sisincome_details = json_decode($sibling_sisincome_details, true);
                            foreach ($temp_sibling_sisincome_details as $ssisincome) {
                                ?>
                                <tr>
                                    <?php if ($sis_income_cnt == 1) { ?>
                                        <td class="f-w-b" rowspan="<?= count($temp_sibling_sisincome_details) ?>">4.</td>
                                        <td rowspan="<?= count($temp_sibling_sisincome_details) ?>">Sibling Sister Details </td>
    <?php } ?>
                                    <td ><?php echo $ssisincome['sibling_sis_sallary']; ?></td>
                                    <td ><?php echo $ssisincome['sibling_sis_business']; ?></td>
                                    <td ><?php echo $ssisincome['sibling_sis_agri']; ?></td>
                                    <td ><?php echo $ssisincome['sibling_sis_proffe']; ?></td>
                                    <td ><?php echo $ssisincome['sibling_sis_other_sour']; ?></td>
                                    <td ><?php echo $ssisincome['sibling_sis_income']; ?></td>
                                <?php $sis_income_cnt++; ?>
                                </tr>
                            <?php } ?>
                            <?php
                            $son_income_cnt = 1;
                            $temp_sonincome_details = json_decode($sonincome_details, true);
                            foreach ($temp_sonincome_details as $ssonincome) {
                                ?>
                                <tr>
                                    <?php if ($son_income_cnt == 1) { ?>
                                        <td class="f-w-b" rowspan="<?= count($temp_sonincome_details) ?>">5.</td>
                                        <td rowspan="<?= count($temp_sonincome_details) ?>">Children Details (Son)</td>
    <?php } ?>
                                    <td ><?php echo $ssonincome['son_sallary']; ?></td>
                                    <td ><?php echo $ssonincome['son_business']; ?></td>
                                    <td ><?php echo $ssonincome['son_agri']; ?></td>
                                    <td ><?php echo $ssonincome['son_proffe']; ?></td>
                                    <td ><?php echo $ssonincome['son_other_sour']; ?></td>
                                    <td ><?php echo $ssonincome['son_income']; ?></td>
                                <?php $son_income_cnt++; ?>
                                </tr>
                            <?php } ?>
                            <?php
                            $daughter_income_cnt = 1;
                            $temp_daughterincome_details = json_decode($daughterincome_details, true);
                            foreach ($temp_daughterincome_details as $sdaughterincome) {
                                ?>
                                <tr>
                                    <?php if ($daughter_income_cnt == 1) { ?>
                                        <td class="f-w-b" rowspan="<?= count($temp_daughterincome_details) ?>">6.</td>
                                        <td rowspan="<?= count($temp_daughterincome_details) ?>">Children Details (Daughter)</td>
    <?php } ?>
                                    <td ><?php echo $sdaughterincome['daughter_sallary']; ?></td>
                                    <td ><?php echo $sdaughterincome['daughter_business']; ?></td>
                                    <td ><?php echo $sdaughterincome['daughter_agri']; ?></td>
                                    <td ><?php echo $sdaughterincome['daughter_proffe']; ?></td>
                                    <td ><?php echo $sdaughterincome['daughter_other_sour']; ?></td>
                                    <td ><?php echo $sdaughterincome['daughter_income']; ?></td>
                                <?php $daughter_income_cnt++; ?>
                                </tr>
<?php } ?>
                        </table>
                    </div>
                    <div style="margin-top: 20px;">
                        <b style="font-size: 14px;"> Asset Details of the Family</b>
                        <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">

                            <tr>
                                <td class="f-w-b">Sr.No.</td>
                                <td class="f-w-b">Asset</td>
                                <td class="f-w-b">Area (in sq.yd/sq.ft)</td>
                                <td class="f-w-b">Location</td>
                            </tr>
                            <tr>
                                <td class="text-center">1.</td>
                                <td class="text-center">Agricultural</td>
                                <td class="text-center"><?php echo $residental_flat_area; ?></td>
                                <td class="text-center"><?php echo $agricultural_location; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center">2.</td>
                                <td class="text-center">Residental Flat</td>
                                <td class="text-center"><?php echo $agricultural_area; ?></td>
                                <td class="text-center"><?php echo $residental_flat_location; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center">3.</td>
                                <td class="text-center">Residental plot in urban areas i.e.notified Municipality/Municipal Corporation/Municipality etc.anywhere in the Country</td>
                                <td class="text-center"><?php echo $residental_plot_urban_area; ?></td>
                                <td class="text-center"><?php echo $residental_plot_urban_location; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center">4.</td>
                                <td class="text-center">Residential plot in areas other than the urban areas i.e.Rural Areas anywhere in the Country</td>
                                <td class="text-center"><?php echo $residental_plot_rural_area; ?></td>
                                <td class="text-center"><?php echo $residental_plot_rural_location; ?></td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div>
                    <pagebreak></pagebreak>
                </div>

                <div style="font-size: 13px;">
                    <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div><br>
                    <div style="margin-top: 5px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                        &nbsp;&nbsp;&nbsp;I Shri/Miss/Mrs <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $applicant_name; ?>&nbsp;&nbsp;</span> 
                        <?php if ($constitution_artical == VALUE_ONE) { ?>
                            Son of daughter of/ wife of <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $father_husbund_name; ?>&nbsp;&nbsp;&nbsp;</span>
<?php } ?> age <span class="b-b-1px f-w-b">&nbsp;&nbsp;&nbsp;<?php echo $applicant_age; ?>&nbsp;&nbsp;&nbsp;</span> of ,&nbsp;<span class="b-b-1px f-w-b"><?php echo $born_place_state_text; ?></span>,&nbsp;<span class="b-b-1px f-w-b"><?php echo $born_place_district_text; ?></span>,&nbsp;<span class="b-b-1px f-w-b"><?php echo $born_place_village_text; ?></span></span>&nbsp;of the Union Territory of Daman & Diu / Dadra & Nagar Haveli, do hereby declare that the information given by me in this application form and its attached enclosures is true to the best of my knowledge and that the information furnished is exhaustive and I have not suppressed any fact. That I am solely responsible for the accuracy of the declaration and information furnished and liable for action under section 199 and 200 of the Indian penal code in case of wrong declaration and information. Also I am well aware of the fact that the certificate shall be summarily cancelled and all the benefits availed by meshall be summarily cancelled and all the benefits availed by me shall be summarily withdrawn incase of wrong declaration and information. <?php if ($minor_child_name != '') { ?>, That I am applied for my Minor Child <span class="b-b-1px f-w-b"><?php echo $minor_child_name;
}
?> </span></br>
                    </div>

                    <table style="margin-top: 10px; width: 100%;">
                        <tr>
                            <td style="vertical-align: top; width: 33%;">
                                <b>Place&nbsp; :-</b> <?php echo $taluka_name_text; ?><br>
                                <b>Dated :-</b> <?php echo convert_to_new_date_format($submitted_datetime); ?>
                            </td>
                            <td class="t-a-c" style="width: 25%;">
                                <img src='<?php echo EWS_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'
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
