<style type="text/css">
    @page {
        margin: 20px;
    }
    body {
        font-family: serif;
        font-size: 12px;
    }
    .f-s-title{
        font-size: 20px;
    }
    .f-aum{
        font-family: arial_unicode_ms;
    }
    table {
        border-collapse: collapse;
        padding: 5px;
        width: 100%;
    }
    table tr td, table tr th {
        border: 1px solid black;
        padding: 5px;
    }
    .f-w-b{
        font-weight: bold;
    }
    .t-a-c{
        text-align: center;
    }
    .t-a-r{
        text-align: right;
    }
</style>
<div class="f-s-title t-a-c f-w-b"><u>Land Details</u></div>
<table style="margin-top: 20px;">
    <tr>
        <th class="f-w-b t-a-c" style="width: 10px;">Sr. No.</th>
        <th class="f-w-b t-a-c" style="width: 40px;">Khata Number</th>
        <th class="f-w-b t-a-c" style="width: 80px;">Village Name</th>
        <th class="f-w-b t-a-c" style="width: 50px;">Survey Number</th>
        <th class="f-w-b t-a-c" style="width: 90px;">Sub Division Number</th>
        <th class="f-w-b t-a-c" style="width: 50px;">Area</th>
        <th class="f-w-b t-a-c">Occupant Name</th>
        <th class="f-w-b t-a-c" style="width: 50px;">Mutation Number</th>
        <th class="f-w-b t-a-c" style="width: 50px;">Nature</th>
        <th class="f-w-b t-a-c" style="width: 90px;">Aadhar Card Number</th>
        <th class="f-w-b t-a-c" style="width: 90px;">Mobile Number</th>
    </tr>
    <?php
    foreach ($land_details as $index => $ld) {
        ?>
        <tr>
            <td class="f-aum t-a-c"><?php echo ($index + 1); ?></td>
            <td class="f-aum t-a-c"><?php echo $ld['khata_number']; ?></td>
            <td class="f-aum t-a-c"><?php echo $ld['village_name']; ?></td>
            <td class="f-aum t-a-c"><?php echo $ld['survey']; ?></td>
            <td class="f-aum t-a-c"><?php echo $ld['subdiv']; ?></td>
            <td class="f-aum t-a-r"><?php echo $ld['area']; ?></td>
            <td class="f-aum"><?php echo $ld['occupant_name']; ?></td>
            <td class="f-aum"><?php echo $ld['mutation_number']; ?></td>
            <td class="f-aum t-a-c"><?php echo $ld['nature']; ?></td>
            <td class="f-aum t-a-c"><?php echo $ld['aadhar_card_number']; ?></td>
            <td class="f-aum t-a-c"><?php echo $ld['mobile_number']; ?></td>
        </tr>
    <?php } ?>
</table>


