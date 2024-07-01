<?php
$barcode_number = generate_barcode_number(VALUE_TWENTYFIVE, $fc_data['form_copy_id']);

$header_array = array();
$header_array['title'] = 'Certificate';
$header_array['department_name'] = 'Office of the Enquiry Officer, City Survey';
$header_array['district'] = $esprld_data_data['district'] == VALUE_ONE ? 'Daman' : ($esprld_data_data['district'] == VALUE_THREE ? 'Dadra and Nagar Haveli' : 'Diu');
// Do not changes this page size only for this page
$header_array['page_size'] = 'A4';
$this->load->view('certificate/copy_header', $header_array);

$url = 'https://daman.nic.in/sugamverify?sv=' . $barcode_number;
?>
<div>
    <h3 style="margin-bottom: 0px;"><b>Barcode Number : <?php echo $barcode_number; ?></b></h3>
    <h3><b>Mobile Number : <?php echo $esprld_data_data['mobile_number']; ?></b></h3>
</div>
<div style="text-align: center; margin-top: 30px;">
    <h1 style="margin-bottom: 50px;"><u>Scan QR to Obtain Digital Copy</u></h1>
    <barcode disableborder="1" code="<?php echo $url; ?>" type="QR" size="5"/>
</div>
<?php $this->load->view('certificate/copy_footer', array('barcode_number' => $barcode_number, 'url' => $url, 'mobile_number' => $esprld_data_data['mobile_number'])); ?>