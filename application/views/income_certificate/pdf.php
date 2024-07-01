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
        $parent_profession_array = $this->config->item('parent_profession_array');
        $child_profession_array = $this->config->item('child_profession_array');
        $property_type_array = $this->config->item('property_type_array');
        $source_of_income_array = $this->config->item('source_of_income_array');
        $rec_array = $this->config->item('rec_array');
        $marital_status_array = $this->config->item('marital_status_array');
        $taluka_array = $this->config->item('taluka_array');
        $gender_array = $this->config->item('gender_array');
        $yes_no_array = $this->config->item('yes_no_array');
        $taluka_name = isset($taluka_array[$district]) ? $taluka_array[$district] : '-';
        $year_array = explode('-', $application_year);
        $app_occupation = (isset($applicant_occupation_array[$applicant_occupation]) ? ($applicant_occupation == VALUE_TWELVE ? $applicant_other_occupation : $applicant_occupation_array[$applicant_occupation]) : '-');
        $marital_status_text = (isset($marital_status_array[$marital_status]) ? $marital_status_array[$marital_status] : '');
        $daman_villages_array = $this->config->item('daman_villages_array');
        $diu_villages_array = $this->config->item('diu_villages_array');
        $dnh_villages_array = $this->config->item('dnh_villages_array');
        $village_array = $district == TALUKA_DAMAN ? $daman_villages_array : ($district == TALUKA_DIU ? $diu_villages_array : ($district == TALUKA_DNH ? $dnh_villages_array : array()));
        $village_name = isset($village_array[$village_dmc_ward]) ? $village_array[$village_dmc_ward] : '';

        $village = array($village_dmc_ward);
        $needle  = range(25, 39);
        if (array_intersect($village, $needle)) {
            $village_name_text_seja = DMC_AREA;
        }else{
            if ($district == TALUKA_DAMAN)
                $village_name_text_seja = (isset($daman_villages_array[$village_dmc_ward]) ? $daman_villages_array[$village_dmc_ward] : '');   
            else if ($district == TALUKA_DIU)
                $village_name_text_seja = (isset($diu_villages_array[$village_dmc_ward]) ? $diu_villages_array[$village_dmc_ward] : '');
            else if ($district == TALUKA_DNH)
                $village_name_text_seja = (isset($dnh_villages_array[$village_dmc_ward]) ? $dnh_villages_array[$village_dmc_ward] : '');
        }
        ?>
        <div style="font-family: arial_unicode_ms;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">રીપોર્ટ</span></div>
            <div class="l-s" style="padding-left: 70%;">જા.નં.&nbsp; :- <span class="f-w-b"><?php echo $application_number; ?></span></div>
            <div class="l-s" style="padding-left: 70%;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text_seja . ' સેજા'; ?></span></div>
            <div class="l-s" style="padding-left: 70%;">તારીખ :- <span class="f-w-b"><?php echo $talathi_to_aci_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($talathi_to_aci_datetime) : '-'; ?></span></div>
            <br>
            <div class="l-s l-h" style="height: 90px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                આપ સાહેબના પત્ર નં. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $application_number . '&nbsp;&nbsp;&nbsp;'; ?></span> તા:- 
                <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . ($submitted_datetime != '0000-00-00 00:00:00' ? convert_to_new_date_format($submitted_datetime) : '-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                નાં અનુસંધાનમાં જણાવવાનું  કે   શ્રી/શ્રીમતી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $communication_address . '&nbsp;&nbsp;&nbsp;'; ?></span> છે.
            </div>
            <div class="l-s" style="margin-top: 10px;">
                &#9679; &nbsp; અરજદારનો ધંધો
                <div class="b-b-1px f-w-b t-a-c" style="margin-top: -23px; width: 400px; margin-left: 120px;">
                    <?php echo $app_occupation; ?>
                </div>
                <div style="margin-top: -23px; margin-left: 530px;">છે.</div>
            </div>
            <div class="l-s" style="margin-top: 10px;">
                &#9679; &nbsp; અરજદારની વાર્ષિક આવક રૂ.
                <div class="b-b-1px f-w-b t-a-c" style="margin-top: -23px; width: 280px; margin-left: 180px;">
                    <?php echo indian_comma_income($income_by_talathi) . ' /-'; ?>
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
                આ સર્ટીફીકેટનો ઉપયોગ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $purpose_of_income_certificate . '&nbsp;&nbsp;&nbsp;'; ?></span> માટે રજુ કરનાર છે. 
            </div>
            <div class="l-s" style="margin-top: 10px;">
                જે પ્રકરણે  એફિડેવિટ સામેલ છે.
            </div>
            <div class="l-s" style="margin-top: 10px;">
                Remarks if any :- <?php echo $talathi_remarks; ?>
            </div>
            <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%;">&nbsp;</div>
            <div class="l-s">
                જે આપ સાહેબને  વિદિત થાય.
            </div>
            <div class="l-s" style="padding-left: 70%; margin-top: -20px;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text_seja . ' સેજા'; ?></span></div>
            <div style="border-bottom: 1px dashed; margin-top: -10px;">&nbsp;</div>
            <div style="margin-top: 5px;">
                <b>Recommendation of Awal Karkun / Circle Inspector :- </b> <?php echo isset($rec_array[$aci_rec]) ? $rec_array[$aci_rec] : $rec_array[VALUE_TWO]; ?>
            </div>
            <div class="l-s">
                Remarks if any :- <?php echo $aci_remarks; ?>
            </div>
            <div style="border-bottom: 1px dashed; margin-top: -15px;">&nbsp;</div>
            <div class="f-s-title t-a-c l-s" style="margin-top: 10px;"><span class="b-b-1px f-w-b">અરજદારનો જવાબ</span></div>
            <div class="l-s l-h" style="height: 90px; margin-top: 20px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                હું નીચે સહી કરનાર શ્રી / શ્રીમતી / કુમારી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                ઉંમર <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_age . '&nbsp;&nbsp;&nbsp;'; ?></span> વર્ષ,
                રહેવાસી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $communication_address . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                આજરોજ તલાટી <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $village_name_text_seja . ' સેજા' . '&nbsp;&nbsp;&nbsp;'; ?></span> 
                રૂબરૂ હાજર થઇ પૂછવાથી લખાવું છું કે
            </div>
            <div class="l-s" style="margin-top: 10px;">
                &#9679; &nbsp; મારો ધંધો
                <div class="b-b-1px f-w-b t-a-c" style="margin-top: -23px; width: 400px; margin-left: 85px;">
                    <?php echo (isset($applicant_occupation_array[$applicant_occupation]) ? ($applicant_occupation == VALUE_TWELVE ? $applicant_other_occupation : $applicant_occupation_array[$applicant_occupation]) : '-'); ?>
                </div>
                <div style="margin-top: -23px; margin-left: 495px;">છે.</div>
            </div>
            <div class="l-s" style="margin-top: 10px;">
                &#9679; &nbsp; મારી વાર્ષિક આવક રૂ.
                <div class="b-b-1px f-w-b t-a-c" style="margin-top: -23px; width: 280px; margin-left: 140px;">
                    <?php echo indian_comma_income($total_income) . '/-'; ?>
                </div>
                <div style="margin-top: -23px; margin-left: 430px;">જેટલી થાય છે.</div>
            </div>
            <div class="l-s" style="margin-top: 10px;">
                &#9679; &nbsp; મારા ધરના કુલ સભ્યોની સંખ્યા
                <div class="b-b-1px f-w-b t-a-c" style="margin-top: -23px; width: 80px; margin-left: 190px;">
                    <?php echo $total_members; ?>
                </div>
                <div style="margin-top: -23px; margin-left: 280px;">છે. તે પૈકી કમાવવાવાળા</div>
                <div class="b-b-1px f-w-b t-a-c" style="margin-top: -20px; width: 80px; margin-left: 410px;">
                    <?php echo $total_earning_members; ?>
                </div>
                <div style="margin-top: -23px; margin-left: 495px;">છે.</div>
            </div>
            <div class="l-s" style="margin-top: 20px;">
                આ સર્ટીફીકેટનો ઉપયોગ <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $purpose_of_income_certificate . '&nbsp;&nbsp;&nbsp;'; ?></span> માટે રજુ કરનાર છે. 
            </div>
            <div class="l-s" style="margin-top: 10px;">
                ઉપરોક્ત જવાબ મારા લખાવ્યા મુજબ ખરો અને બરાબર છે. જે બદલ મેં નીચે સહી કરેલ છે.
            </div>
            <div class="l-s" style="margin-top: 10px;">
                તારીખ :- <span class="f-w-b"><?php echo $appointment_date != '0000-00-00' ? convert_to_new_date_format($appointment_date) : '-'; ?></span><br>
                સ્થળ &nbsp; :- <span class="f-w-b"><?php echo $taluka_name; ?></span>
            </div>
            <div class="l-s" style="margin-top: -23px; margin-left: 300px;">
                રૂબરૂ 
            </div>
            <div class="l-s" style="border-bottom: 1px dotted; margin-left: 70%; margin-top: -40px;">&nbsp;</div>
            <div class="l-s" style="padding-left: 70%; margin-top: 0px;">તલાટી :- <span class="f-w-b"><?php echo $village_name_text_seja . ' સેજા'; ?></span></div>
            <div style="border-bottom: 1px dashed; margin-top: 0px;">&nbsp;</div>
            <div>
                This Report & Statement is electronically generated and no signature is required.
            </div>
        </div>
        <div>
            <pagebreak></pagebreak>
        </div>
        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="f-w-b">Application For Income Certificate</span></div>
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
                    <td class="f-w-b">Permanent Address</td>
                    <td><?php echo $applicant_address; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Communication Address</td>
                    <td><?php echo $communication_address; ?></td>
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
                    <td class="f-w-b">Gender</td>
                    <td><?php echo (isset($gender_array[$gender]) ? $gender_array[$gender] : ' - '); ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Date of Birth</td>
                    <td><?php echo convert_to_new_date_format($applicant_dob); ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Age</td>
                    <td><?php echo $applicant_age; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Birth Place </td>
                    <td><?php echo $applicant_born_place; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Marital Status</td>
                    <td><?php echo $marital_status_text; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Nationality</td>
                    <td style="vertical-align: top;"><?php echo $applicant_nationality; ?></td>
                </tr>
                <tr>
                    <td class="f-w-b">Occupation</td>
                    <td><?php echo $app_occupation; ?></td>
                </tr>
            </table>
            <div style="margin-top: 20px;">
                <?php
                $this->load->view('income_certificate/pdf_fd', array('parent_profession_array' => $parent_profession_array, 'marital_status' => $marital_status,
                    'father_name' => $father_name, 'father_occupation' => $father_occupation, 'father_other_occupation' => $father_other_occupation,
                    'mother_name' => $mother_name, 'mother_occupation' => $mother_occupation, 'mother_other_occupation' => $mother_other_occupation,
                    'spouse_name' => $spouse_name, 'spouse_occupation' => $spouse_occupation, 'spouse_other_occupation' => $spouse_other_occupation));
                ?>
            </div>
            <div style="margin-top: 20px;">
                <?php $this->load->view('income_certificate/pdf_mi', array('profession_array' => $profession_array, 'app_occupation' => $app_occupation)); ?>
            </div>
            <?php if ($if_applicant_have_children == VALUE_ONE) { ?>
                <div style="margin-top: 20px;">
                    <?php $this->load->view('income_certificate/pdf_cd', array('children_details' => $children_details, 'child_profession_array' => $child_profession_array)); ?>
                </div>
            <?php } if ($if_wife_husband_have_property == VALUE_ONE) { ?>
                <div style="margin-top: 20px;">
                    <?php $this->load->view('income_certificate/pdf_ipd', array('property_details' => $property_details, 'property_type_array' => $property_type_array)); ?>
                </div>
            <?php } if ($have_you_any_member_income_otherside == VALUE_ONE) { ?>
                <div style="margin-top: 20px;">
                    <?php $this->load->view('income_certificate/pdf_osi', array('other_income_details' => $other_income_details, 'source_of_income_array' => $source_of_income_array)); ?>
                </div>
            <?php } ?>
            <table class="app-form-income" style="font-size: 13px; margin-top: 20px;">
                <tr>
                    <td class="f-w-b" style="width: 50%;">For What Purpose is the Certificate of Income Required</td>
                    <td style="vertical-align: top;"><?php echo $purpose_of_income_certificate; ?></td>
                </tr>
            </table>
            <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                <tr>
                    <td class="f-w-b" style="width: 50%;">Did you applied for a Certificate of Income at any time before and if so, when ?</td>
                    <td style="vertical-align: top;"><?php echo isset($yes_no_array[$did_you_apply_income_certificate_before]) ? ($yes_no_array[$did_you_apply_income_certificate_before] . ($did_you_apply_income_certificate_before == VALUE_ONE ? ' (' . $when_you_apply_income_certificate . ')' : '')) : $yes_no_array[VALUE_TWO]; ?></td>
                </tr>
            </table>
            <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                <tr>
                    <td class="f-w-b" style="width: 50%;">Total Income</td>
                    <td style="vertical-align: top; text-align: right;" class="f-w-b"><?php echo indian_comma_income($total_income) . '/-'; ?></td>
                </tr>
            </table>
        </div>
        <div>
            <pagebreak></pagebreak>
        </div>
        <div style="font-size: 13px;">
            <div class="f-s-title t-a-c l-s"><span class="b-b-1px f-w-b">DECLARATION</span></div>
            <div class="l-s" style="margin-top: 20px; text-align: justify; text-justify: inter-word; line-height: 25px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_name . '&nbsp;&nbsp;&nbsp;'; ?></span>
                Son/Daughter of Shri <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $father_name . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                Age <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_age . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                Year, Marital Status :- <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $marital_status_text . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                Nationality <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $applicant_nationality . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                Resident of <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $communication_address . '&nbsp;&nbsp;&nbsp;'; ?></span>,
                <?php echo $taluka_name; ?> of <?php echo $taluka_name; ?> District.
            </div>
            <div class="l-s l-h" style="text-align: justify; text-justify: inter-word; margin-top: 5px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                That my family annual income from all sources was Rs. <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . (indian_comma_income($total_income) . '/-') . '&nbsp;&nbsp;&nbsp;'; ?></span>
                during the year <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . (($year_array[0] - 1) . '-' . ($year_array[1] - 1)) . '&nbsp;&nbsp;&nbsp;'; ?></span>. 
                That details of my family annual income as are under :- 
            </div>
            <div style="margin-top: 5px;">
                <?php
                $this->load->view('income_certificate/pdf_fd', array('parent_profession_array' => $parent_profession_array, 'marital_status' => $marital_status,
                    'father_name' => $father_name, 'father_occupation' => $father_occupation, 'father_other_occupation' => $father_other_occupation,
                    'mother_name' => $mother_name, 'mother_occupation' => $mother_occupation, 'mother_other_occupation' => $mother_other_occupation,
                    'spouse_name' => $spouse_name, 'spouse_occupation' => $spouse_occupation, 'spouse_other_occupation' => $spouse_other_occupation));
                ?>
            </div>
            <div style="margin-top: 5px;">
                <?php $this->load->view('income_certificate/pdf_mi', array('profession_array' => $profession_array, 'app_occupation' => $app_occupation)); ?>
            </div>
            <?php if ($if_applicant_have_children == VALUE_ONE) { ?>
                <div style="margin-top: 5px;">
                    <?php $this->load->view('income_certificate/pdf_cd', array('children_details' => $children_details, 'child_profession_array' => $child_profession_array)); ?>
                </div>
            <?php } if ($if_wife_husband_have_property == VALUE_ONE) { ?>
                <div style="margin-top: 5px;">
                    <?php $this->load->view('income_certificate/pdf_ipd', array('property_details' => $property_details, 'property_type_array' => $property_type_array)); ?>
                </div>
            <?php } if ($have_you_any_member_income_otherside == VALUE_ONE) { ?>
                <div style="margin-top: 5px;">
                    <?php $this->load->view('income_certificate/pdf_osi', array('other_income_details' => $other_income_details, 'source_of_income_array' => $source_of_income_array)); ?>
                </div>
            <?php } ?>
            <table class="app-form-income" style="font-size: 13px; margin-top: 10px;">
                <tr>
                    <td class="f-w-b" style="width: 80%;">Grand Total Income</td>
                    <td style="vertical-align: top; text-align: right;" class="f-w-b"><?php echo indian_comma_income($total_income) . '/-'; ?></td>
                </tr>
            </table>
            <div class="l-s l-h" style="margin-top: 10px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;That I have neither other except as shown above nor any income from bank interest, etc.
            </div>
            <div class="l-s l-h" style="text-align: justify; text-justify: inter-word;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This declaration, I have to submit before the Mamlatdar, <?php $taluka_name; ?> to obtain the Income Certificate for 
                <span class="b-b-1px f-w-b"><?php echo '&nbsp;&nbsp;&nbsp;' . $purpose_of_income_certificate . '&nbsp;&nbsp;&nbsp;'; ?></span> purpose.
            </div>
            <div class="l-s f-w-b" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                I, hereby declare that the above information is true to the best of my knowledge and belief and nothing has been concealed therein.
                I am well aware of the fact that if the information given by me is proved false /not true, I will have to face the 
                punishment as per the law and that the benefits availed by me shall be summarily withdrawn.
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                This is to certify that I have read and understood the provisions of Section 199 and 200 of the Indian Penal Code which state as follows:-
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                <b>Section 199. False statement made in declaration which is by law receivable as evidence:- </b>
                <div>
                    Whoever, in any declaration made or subscribed by him, which declaration any Court of justice, or 
                    any Public Servant or other person, is bound or authorized bylaw to receive as evidence of any fact, 
                    makes any statement which is false, and which he either knows or believes to be false or does not 
                    believe to be true, touching any point material to the object for which the declaration is made or 
                    used, shall be punished in the same manner as if he gave false evidence.
                </div>
            </div>
            <div class="l-s" style="text-align: justify; text-justify: inter-word; margin-top: 10px; font-size: 12px;">
                <b>Section 200. Using as true such declaration knowing it to be false:- </b>
                Whoever corruptly uses or attempts to use as true any such declaration, knowing the 
                same to be false in any material point, shall be punished in the same manner as if he gave false evidence.
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
                        <img src='<?php echo INCOME_CERTIFICATE_DOC_PATH . $applicant_photo_doc; ?>'
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
        </div>
    </body>
</html>
