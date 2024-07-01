<div class="card">
    <div class="card-header">
        <h3 class="card-title float-right">
            <button type="button" class="btn btn-sm btn-success" 
                    onclick="$('#generate_excel_for_dapvr_case').submit();">
                <i class="fas fa-file-excel"></i>&nbsp; Download Excel</button>
        </h3>
        {{{s_display_text}}}
        <?php if (!is_mam_view_user()) { ?>
            <h3 class="card-title float-right"  style="margin-right: 15px;">
                <button type="button" class="btn btn-sm btn-primary" onclick="DAPVRCase.listview.askForNewDapvrCaseForm($(this));">New Case Entry</button>
                <!--             <button type="button" class="btn btn-sm btn-primary" onclick="DAPVRCase.listview.listPage(false, {});">Dashboard</button>-->
            </h3>
        <?php } ?>

    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table id="dapvr_case_datatable" class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="text-center v-a-m" style="width: 30px;">No.</th>
                        <th class="text-center v-a-m" style="width: 50px;">Case No</th>
                        <th class="text-center v-a-m" style="width: 80px;">Register Date</th>
                        <th class="text-center v-a-m" style="width: 100px;">Case Type</th>
                        <th class="text-center v-a-m" style="width: 80px;">Case Year</th>
                        <th class="text-center v-a-m" style="min-width: 95px;">Name of Petitioner</th>
                        <th class="text-center v-a-m" style="min-width: 95px;">Name of Respondent</th>
<!--                        <th class="text-center" style="min-width: 100px;">Case Movement Status</th>-->
                        <th class="text-center" style="min-width: 95px;">Hearing<br>Date</th>
                        <th class="text-center v-a-m" style="width: 100px;">Case Status</th>
                        <th class="text-center v-a-m" style="width: 50px;">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>