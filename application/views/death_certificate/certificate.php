<?php
$barcode_number = generate_barcode_number(VALUE_TWENTY, $death_certificate_data['death_certificate_id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Death Certificate</title>
        <style type="text/css">
            @page {
                margin: 25px;
                margin-top: 20px;
                margin-bottom: 25px;
            }
            body {
                font-family: meiryo;
                font-size: 13.5px;
                width: 100%;
                border: 1px solid red;
                line-height: 17px;
            }
            hr {
                margin-top: 0px;
                margin-bottom: 0px;
                color: black;
            }
            table{
                width: 100%;
            }
            .f-w-b{
                font-weight: bold;
            }
            .t-a-c{
                text-align: center;
            }
            .v-a-t{
                vertical-align: top;
            }
            .t-a-r{
                text-align: right;
            }
            .f-s-18{
                font-size: 18px;
            }
            .ff-arialunicodems{
                font-family: arial_unicode_ms;
                font-size: 15px;
                word-spacing: 0.5px;
            }
            .ff-timesnewroman{
                font-family: timesnewroman;
                font-size: 16px;
                line-height: 14px;
                padding-left: 10px;
                padding-right: 10px;
            }
            .l-h-10{
                line-height: 10px;
            }
            .p-lr-10px{
                padding-left: 9px;
                padding-right: 9px;
            }
            .bb-2px{
                border-bottom: 2px dotted;
            }
        </style>
    </head>
    <body>
         <?php
        $taluka_array = $this->config->item('taluka_array');
        $district_text = isset($taluka_array[$death_certificate_data['district']]) ? $taluka_array[$death_certificate_data['district']] : '-';
        $date_of_death = date("d-m-Y", strtotime($death_certificate_data['death_person_dod']));
        $date_of_registration = date("d-m-Y", strtotime($death_certificate_data['registration_date']));
        ?>
        <div style="border: 1.5px solid red; padding: 1px;">
            <div style="border: 3px solid red; padding: 1px;">
                <div style="border: 1.5px solid black; padding: 8px; height: 100%;">
                    <table>
                        <tr>
                            <td style="width: 33%;">
                                <div style="margin-top: 20px;">
                                    <barcode code="<?php echo $barcode_number . '841'; ?>" type="EAN13" height="0.50" />
                                </div>
                            </td>
                            <td class="t-a-c" style="width: 34%;"><img src="images/emblem-dark.png" width="50px"></td>
                            <td class="v-a-t t-a-c"><span class="ff-arialunicodems f-s-18">प्रपत्र</span> - 6 / FORM - 6</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class="ff-arialunicodems t-a-c f-s-18" style="line-height: 15px;">संघ प्रदेश दादरा एवं नगर हवेली तथा दमण एवं दीव प्रशासन</td>
                        </tr>
                        <tr>
                            <td class="t-a-c">U.T. ADMINISTRATION OF DADRA AND NAGAR HAVELI AND DAMAN AND DIU</td>
                        </tr>
                        <tr>
                            <td class="ff-arialunicodems t-a-c f-s-18" style="line-height: 15px;">योजना एवं सांख्यिकी विभाग</td>
                        </tr>
                        <tr>
                            <td class="t-a-c">DEPARTMENT OF PLANNING & STATISTICS</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td class="ff-arialunicodems t-a-c" style="font-size: 30px; line-height: 20px;">मृत्यु प्रमाण - पत्र</td>
                        </tr>
                        <tr>
                            <td class="t-a-c" style="font-size: 16px; line-height: 25px;">DEATH CERTIFICATE</td>
                        </tr>
                        <tr>
                            <td class="ff-arialunicodems t-a-c l-h-10">(जन्म मृत्यु रजिस्ट्रीकरण अधिनियम, 1969 की धारा 12/17 तथा</td>
                        </tr>
                        <tr>
                            <td class="ff-arialunicodems t-a-c">दमण एवं दीव जन्म मृत्यु रजिस्ट्रीकरण नियम, 2000 के नियम 8/13 के अंतर्गत जारी किया गया)</td>
                        </tr>
                        <tr>
                            <td class="t-a-c">(Issued under Section 12/17 of the Registration of Death & Death Act, 1969 and</td>
                        </tr>
                        <tr>
                            <td class="t-a-c l-h-10">Rule 8/13 of the Daman & Diu Registration of Death and Death Rules, 2000)</td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 10px;">
                        <tr>
                            <td class="ff-arialunicodems">
                                यह प्रमाणित किया जाता है कि निम्नलिखित सूचना मृत्यु के मूल लेख से ली गई है, जो की
                            </td>
                            <td class="bb-2px t-a-c f-w-b" style="width: 28%;">--------</td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 5px;">
                        <tr>
                            <td class="ff-arialunicodems" style="width: 40px;">
                                तहसील
                            </td>
                            <td class="bb-2px t-a-c f-w-b" style="width: 21%;">--------</td>
                            <td class="ff-arialunicodems" style="width: 40px;">जिला</td>
                            <td class="bb-2px t-a-c f-w-b">--------</td>
                            <td class="ff-arialunicodems" style="width: 300px;">संघ प्रदेश दमण एवं दीव के रजिस्टर में उल्लिखित हे |</td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 10px;">
                        <tr>
                            <td colspan="4" style="height: 40px;">
                                This is to certify that the following information has been taken from the original record of death which is
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 120px;">
                                in the register for
                            </td>
                            <td class="ff-timesnewroman bb-2px">
                                <?php echo $death_certificate_data['applicant_name']; ?>
                            </td>
                            <td style="width: 63px;">of Tahsil</td>
                            <td class="t-a-c ff-timesnewroman bb-2px" style="width: 200px;">
                                <?php echo $district_text; ?>
                            </td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 5px;">
                        <tr>
                            <td style="width: 70px;"s>of District</td>
                            <td class="t-a-c ff-timesnewroman bb-2px" style="width: 200px;"><?php echo $district_text; ?></td>
                            <td> of Union Territory of Daman & Diu.</td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 20px;">
                        <tr>
                            <td style="width: 70%;"><span class="ff-arialunicodems">नाम</span> / Name : <span class="ff-timesnewroman"><?php echo $death_certificate_data['full_name']; ?></span></td>
                            <td><span class="ff-arialunicodems">लिंग</span> / Sex : 
                                <span class="ff-timesnewroman">
                                    <?php
                                    if ($death_certificate_data['gender'] == '1') {
                                        echo 'Male';
                                    } else if ($death_certificate_data['gender'] == '2') {
                                        echo 'Female';
                                    } else if ($death_certificate_data['gender'] == '3') {
                                        echo 'Transgender';
                                    } else if ($death_certificate_data['gender'] == '4') {
                                        echo 'Not Applicable';
                                    }
                                    ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 5px;">
                        <tr>
                            <td><span class="ff-arialunicodems">मृत्यु तिथि</span> / Date of Death : <span class="ff-timesnewroman"><?php echo $date_of_death; ?></span></td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 5px;">
                        <tr>
                            <td><span class="ff-arialunicodems">मृत्यु स्थान</span> / Place of Death : <span class="ff-timesnewroman"><?php echo $death_certificate_data['death_place']; ?></span></td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 5px;">
                        <tr>
                            <td><span class="ff-arialunicodems">माता का नाम</span> / Name of Mother : <span class="ff-timesnewroman"><?php echo $death_certificate_data['mother_name']; ?></span></td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 5px;">
                        <tr>
                            <td><span class="ff-arialunicodems">पिता का नाम</span> / Name of Father : <span class="ff-timesnewroman"><?php echo $death_certificate_data['father_name']; ?></span></td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 5px;">
                        <tr>
                            <td><span class="ff-arialunicodems">पति/पत्नी का नाम</span> / Name of Husband/Wife : <span class="ff-timesnewroman"><?php echo $death_certificate_data['husband_wife_name']; ?></span></td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 5px;">
                        <tr>
                            <td class="ff-arialunicodems" style="width: 50%;">मृतक का मृत्यु के समय का पता  /</td>
                            <td class="ff-arialunicodems">मृतक का स्थायी पता /</td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                Address of the deceased at the time of death : 
                            </td>
                            <td>
                                Permanent address of the deceased : 
                            </td>
                        </tr>
                    </table>
                    <table class="p-lr-10px">
                        <tr>
                            <td class="ff-timesnewroman v-a-t" style="height: 80px; width: 50%; padding-left: 0px; padding-right: 5px; line-height: 20px;">
                                <?php echo $death_certificate_data['dp_communication_address']; ?>
                            </td>
                            <td class="ff-timesnewroman v-a-t" style="height: 80px; padding-left: 0px; padding-right: 0px; line-height: 20px;">
                                <?php echo $death_certificate_data['dp_permanent_address']; ?>
                            </td>
                        </tr>
                    </table>
                    <table class="p-lr-10px">
                        <tr>
                            <td style="width: 50%;">
                                <span class="ff-arialunicodems" style="letter-spacing: 0px;">पंजीकरण संख्या</span>/Registration No. :
                                <span class="ff-timesnewroman" style="font-size: 15px;"><?php echo $death_certificate_data['registration_number']; ?></span>
                            </td>
                            <td>
                                <span class="ff-arialunicodems" style="letter-spacing: 0px;">पंजीकरण दिनांक</span>/Date of Registration :
                                <span class="ff-timesnewroman" style="font-size: 15px;"> <?php echo $death_certificate_data['is_date_or_year'] == VALUE_ONE ? $date_of_registration : ($death_certificate_data['is_date_or_year'] == VALUE_TWO ? $death_certificate_data['registration_year'] : '--------'); ?></span>
                            </td>
                        </tr>
                    </table>
                    <table class="p-lr-10px" style="margin-top: 10px;">
                        <tr>
                            <td class="v-a-t" style="height: 40px;">
                                <span class="ff-arialunicodems">टिप्पणी</span> / Remarks (if any) : 
                                <?php echo $death_certificate_data['remarks']; ?>
                            </td>
                        </tr>
                    </table>
                    <table class="p-lr-10px">
                        <tr>
                            <td style="width: 50%;">
                                <span class="ff-arialunicodems" style="letter-spacing: 0px;">जारी करने की तिथि</span> / Date of Issue : 
                            </td>
                            <td>
                                <span class="ff-arialunicodems" style="letter-spacing: 0px; font-size: 14px;">प्राधिकारी के हस्ताक्षर</span>/<span style="font-size: 13px;">Signature of the issuing authority</span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><span class="ff-arialunicodems" style="letter-spacing: 0px; font-size: 14px;">प्राधिकारी के पता</span>/<span style="font-size: 13px;">Address of the issuing authority</span></td>
                        </tr>
                    </table>
                    <div class="t-a-c" style="margin-top: 10px;">
                        <img src="images/birth-death-logo.png" width="50px">
                    </div>
                    <div style="margin-left: 70px;"><span class="ff-arialunicodems">मोहर</span> / Seal</div>
                    <table style="border: 1px solid black; margin: 10px 10% 0% 10%;">
                        <tr>
                            <td class="t-a-c"><span style="font-family: arial_unicode_ms; font-size: 13px;">"प्रत्येक जन्म एवं मृत्यु का पंजीकरण सुनिश्चित करें / Ensure registration of every death and death"</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>