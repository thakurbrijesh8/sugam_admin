<div class="table-responsive">
    <table id="landtax_na_datatable" class="table table-bordered table-hover vat-top">
        <thead>
            <tr class="bg-light-gray">
                <th class="text-center" style="width: 30px;">No.</th>
                <th class="text-center" style="width: 200px;">Village</th>
                <th class="text-center" style="width: 100px;">Khata Number</th>
                <th class="text-center" style="min-width: 80px;">Total Area</th>
                <th class="text-center" style="min-width: 350px;">Occupant Name</th>
                <th class="text-center" style="min-width: 80px;">
                    Current Tax<br>(<?php echo get_financial_year(); ?>)
                </th>
                <th class="text-center" style="min-width: 80px;">
                    Arrears<br>(<?php echo get_financial_year(1); ?>)
                </th>
                <th class="text-center" style="min-width: 80px;">Total Paid Tax</th>
                <th class="text-center" style="min-width: 80px;">Total Pending Tax</th>
                <th class="text-center" style="width: 50px;">Action</th>
            </tr>
        </thead>
    </table>
</div>