<div class="row">
    {{#if show_lease_details}}
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="v-a-m bg-beige" style="min-width: 120px;">Lease Period</th>
                        <th class="text-right f-w-b v-a-m" style="min-width: 80px;">{{lease_period_text}}</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">No. of Year For Lease</th>
                        <th class="text-right f-w-b v-a-m">{{noy_lease}} Year</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">No. of Month For Lease</th>
                        <th class="text-right f-w-b v-a-m">{{nom_lease}} Month</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">Deposit For Lease</th>
                        <th class="text-right f-w-b v-a-m">{{deposit}}/-</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">Yearly Rent For Lease / Average Annual Rent</th>
                        <th class="text-right f-w-b v-a-m">{{yearly_rent}}/-</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    {{/if}}
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-beige">
                        <th class="text-center v-a-m f-w-b" colspan="2">Auto Calculated (Estimated)</th>
                    </tr>
                    {{#if show_ca}}
                    <tr>
                        <th class="v-a-m bg-beige" style="min-width: 120px;">Total Consideration Amount</th>
                        <th class="text-right f-w-b v-a-m" id="total_dca_auto_for_drsfour_view" style="min-width: 80px;">{{total_consideration_amount}}</th>
                    </tr>
                    {{/if}}
                    <tr>
                        <th class="v-a-m bg-beige">Total Stamp Duty</th>
                        <th class="text-right f-w-b v-a-m" id="total_dsd_auto_for_drsfour_view">{{total_stamp_duty}}</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">Total Registration Fee</th>
                        <th class="text-right f-w-b v-a-m" id="total_drf_auto_for_drsfour_view">{{total_registration_fee}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    {{#if show_total_of_entered_ca}}
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-beige">
                        <th class="text-center v-a-m f-w-b" colspan="2">Consideration Amount (Entered by User) : (Estimated)</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige" style="min-width: 120px;">Consideration Amount</th>
                        <th class="text-right f-w-b v-a-m" style="min-width: 80px;">{{doc_consideration_amount}}</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">
                            Stamp Duty (<span class="total_dsd_per_for_drsfour_eca_view f-w-b"></span>)
                        </th>
                        <th class="text-right f-w-b v-a-m" id="total_dsd_auto_for_drsfour_eca_view">0</th>
                    </tr>
                    <tr>
                        <th class="v-a-m bg-beige">
                            Registration Fee (<span class="total_drf_per_for_drsfour_eca_view f-w-b"></span>)
                        </th>
                        <th class="text-right f-w-b v-a-m" id="total_drf_auto_for_drsfour_eca_view">0</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    {{/if}}
</div>