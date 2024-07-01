<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-tachometer-alt"></i> Dashboard</h1>
            </div>     
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <?php if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user()) { ?>
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">DAPVR Case Details</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body border-project pb-1">
                    <div class="row">
                        <div class="col-6 col-sm-3 col-md-2">
                            <div class="small-box bg-danger mb-2">
                                <div class="inner">
                                    <h3 id="today_hearing_dapvr_cases_for_dashboard" class="null-value mb-1"><i class="fas fa-spinner fa-spin"></i></h3>
                                    <p class="mb-1"><b>Today's Hearing</b></p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                </div>
                                <a onclick="DAPVRCase.listview.listPage(VALUE_THREE);" class="small-box-footer cursor-pointer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3 col-md-2">
                            <div class="small-box bg-gradient-gray mb-2">
                                <div class="inner">
                                    <h3 id="this_month_hearing_dapvr_cases_for_dashboard" class="null-value mb-1"><i class="fas fa-spinner fa-spin"></i></h3>
                                    <p class="mb-1"><b>This Month Hearing</b></p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                </div>
                                <a onclick="DAPVRCase.listview.listPage(VALUE_THREE, VALUE_ONE);" class="small-box-footer cursor-pointer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3 col-md-2">
                            <div class="small-box bg-gradient-indigo mb-2">
                                <div class="inner">
                                    <h3 id="next_month_hearing_dapvr_cases_for_dashboard" class="null-value mb-1"><i class="fas fa-spinner fa-spin"></i></h3>
                                    <p class="mb-1"><b>Next Month Hearing</b></p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                </div>
                                <a onclick="DAPVRCase.listview.listPage(VALUE_THREE, VALUE_TWO);" class="small-box-footer cursor-pointer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3 col-md-2">
                            <div class="small-box bg-info mb-2">
                                <div class="inner">
                                    <h3 id="total_dapvr_cases_for_dashboard" class="null-value mb-1"><i class="fas fa-spinner fa-spin"></i></h3>
                                    <p class="mb-1"><b>Total Cases</b></p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                </div>
                                <a onclick="DAPVRCase.listview.listPage();"  class="small-box-footer cursor-pointer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3 col-md-2">
                            <div class="small-box bg-warning mb-2">
                                <div class="inner">
                                    <h3 id="pending_dapvr_cases_for_dashboard" class="null-value mb-1"><i class="fas fa-spinner fa-spin"></i></h3>
                                    <p class="mb-1"><b>Pending Cases</b></p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                </div>
                                <a onclick="DAPVRCase.listview.listPage(VALUE_TWO);" class="small-box-footer cursor-pointer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3 col-md-2">
                            <div class="small-box bg-success mb-2">
                                <div class="inner">
                                    <h3 id="close_dapvr_cases_for_dashboard" class="null-value mb-1"><i class="fas fa-spinner fa-spin"></i></h3>
                                    <p class="mb-1"><b>Close Cases</b></p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                </div>
                                <a onclick="DAPVRCase.listview.listPage(VALUE_FOUR);" class="small-box-footer cursor-pointer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-sm-3 col-md-2">
                            <div class="small-box bg-nic-blue mb-2">
                                <div class="inner">
                                    <h3 id="pass_dapvr_cases_for_dashboard" class="null-value mb-1"><i class="fas fa-spinner fa-spin"></i></h3>
                                    <p class="mb-1"><b>Order Passed</b></p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-list-alt"></i>
                                </div>
                                <a onclick="DAPVRCase.listview.listPage(VALUE_FIVE);" class="small-box-footer cursor-pointer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user() || is_aci_user() || is_ldc_user()) { ?>
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Certificate Details</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body border-project">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-0 mb-0 table-hover-cells">
                            <thead>
                                <tr class="bg-light-gray">
                                    <th class="text-center" style="width: 40px;">Sr. No.</th>
                                    <th class="text-center" style="width: 80px;">District</th>
                                    <th class="text-center" style="min-width: 200px;">Service Name</th>
                                    <th class="text-center" style="width: 100px;">Total Application</th>
                                    <th class="text-center" style="width: 100px;">New</th>
                                    <th class="text-center" style="width: 100px;">Queried</th>
                                    <th class="text-center" style="width: 100px;">Response Received</th>
                                    <?php if (is_admin() || is_talathi_user()) { ?>
                                        <th class="text-center" style="width: 100px;">Appointment Scheduled</th>
                                    <?php } ?>
                                    <?php if (is_talathi_user() || is_aci_user() || is_ldc_user()) { ?>
                                        <th class="text-center" style="width: 100px;">Forwarded</th>
                                    <?php } ?>
                                    <?php if (is_admin()) { ?>
                                        <th class="text-center" style="width: 100px;">Reverification</th>
                                    <?php } ?>
                                    <?php if (is_talathi_user() || is_aci_user() || is_ldc_user()) { ?>
                                        <th class="text-center" style="width: 100px;">New Reverification</th>
                                    <?php } ?>
                                    <?php if (is_talathi_user() || is_aci_user() || is_ldc_user() || is_mamlatdar_user()) { ?>
                                        <th class="text-center" style="width: 100px;">Forwarded Reverification</th>
                                    <?php } ?>
                                    <?php if (is_mamlatdar_user()) { ?>
                                        <th class="text-center" style="width: 100px;">Received Reverification</th>
                                    <?php } ?>
                                    <th class="text-center" style="width: 100px;">Approved</th>
                                    <th class="text-center" style="width: 100px;">Rejected</th>
                                </tr>
                            </thead>
                            <tbody id="mam_dash_item_container_for_dashboard"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">General Application</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body border-project">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-0 mb-0 table-hover-cells">
                            <thead>
                                <tr class="bg-light-gray">
                                    <th class="text-center" style="width: 40px;">Sr. No.</th>
                                    <th class="text-center" style="width: 80px;">District</th>
                                    <th class="text-center" style="min-width: 200px;">Service Name</th>
                                    <th class="text-center" style="width: 100px;">Total Application</th>
                                    <th class="text-center" style="width: 100px;">New</th>
                                    <th class="text-center" style="width: 100px;">Queried</th>
                                    <th class="text-center" style="width: 100px;">Response Received</th>
                                    <th class="text-center" style="width: 100px;">Forwarded</th>
                                    <th class="text-center" style="width: 100px;">Approved</th>
                                    <th class="text-center" style="width: 100px;">Rejected</th>
                                </tr>
                            </thead>
                            <tbody id="general_application_dash_item_container_for_dashboard"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } if (is_admin() || is_talathi_user() || is_aci_user() || is_mamlatdar_user() || is_mam_view_user() || is_eocs_fs_user() || is_eocs_hs_user() || is_eocs_head() || is_eocs_jfs_user()) { ?>
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Land Revenue Services</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body border-project">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-0 mb-0 table-hover-cells">
                            <thead>
                                <tr class="bg-light-gray">
                                    <th class="text-center" style="width: 40px;">Sr. No.</th>
                                    <th class="text-center" style="width: 80px;">District</th>
                                    <th class="text-center" style="min-width: 200px;">Service Name</th>
                                    <th class="text-center" style="width: 100px;">Total Application</th>
                                    <th class="text-center" style="width: 100px;">Submitted</th>
                                    <th class="text-center" style="width: 100px;">Queried</th>
                                    <th class="text-center" style="width: 100px;">Response Received</th>
                                    <th class="text-center" style="width: 100px;">Fees Pending</th>
                                    <?php if (is_admin() || is_eocs_head() || is_eocs_hs_user() || is_eocs_fs_user() || is_eocs_jfs_user()) { ?>
                                        <th class="text-center" style="width: 100px;">Copy<hr>Pending</th>
                                        <th class="text-center" style="width: 100px;">Copy<hr>Generated</th>
                                        <th class="text-center" style="width: 100px;">Copy<hr>Prepared</th>
                                        <th class="text-center" style="width: 100px;">Copy<hr>Checked</th>
                                    <?php } else { ?>
                                        <th class="text-center" style="width: 100px;">Fees Paid</th>
                                    <?php } ?>
                                    <th class="text-center" style="width: 100px;">Approved</th>
                                    <th class="text-center" style="width: 100px;">Rejected</th>
                                </tr>
                            </thead>
                            <tbody id="fees_status_dash_item_container_for_dashboard"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } if (is_admin() || is_subr_user() || is_subr_ver_user()) { ?>
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">CRSR Services</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body border-project">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-0">
                                <div class="card-header bg-primary">
                                    <h3 class="card-title">Status wise Document Registration</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0 border-project">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a onclick="DocumentRegistration.listview.listPage(VALUE_TWO, VALUE_ONE);" class="nav-link cursor-pointer">
                                                Application Submitted
                                                <span class="float-right badge bg-warning f-s-18px mw-label" id="application_submitted_for_dashboard"><i class="fas fa-spinner fa-spin"></i></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a onclick="DocumentRegistration.listview.listPage(VALUE_THREE, VALUE_ONE);" class="nav-link cursor-pointer">
                                                Doc. Verified & Appointment Pending
                                                <span class="float-right badge bg-warning f-s-18px mw-label" id="doc_verify_appointment_pending_for_dashboard"><i class="fas fa-spinner fa-spin"></i></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a onclick="DocumentRegistration.listview.listPage(VALUE_EIGHT, VALUE_ONE);" class="nav-link cursor-pointer">
                                                Doc. Verified & Appointment Approval Pending
                                                <span class="float-right badge bg-warning f-s-18px mw-label" id="doc_verify_appointment_approval_pending_for_dashboard"><i class="fas fa-spinner fa-spin"></i></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a onclick="DocumentRegistration.listview.listPage(VALUE_FOUR, VALUE_ONE);" class="nav-link cursor-pointer">
                                                Doc. Verified & Appointment Scheduled
                                                <span class="float-right badge bg-primary f-s-18px mw-label" id="doc_verify_appointment_scheduled_for_dashboard"><i class="fas fa-spinner fa-spin"></i></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a onclick="DocumentRegistration.listview.listPage(VALUE_FIVE, VALUE_ONE);" class="nav-link cursor-pointer">
                                                Document Registered
                                                <span class="float-right badge bg-success f-s-18px mw-label" id="document_register_for_dashboard"><i class="fas fa-spinner fa-spin"></i></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a onclick="DocumentRegistration.listview.listPage(VALUE_SIX, VALUE_ONE);" class="nav-link cursor-pointer">
                                                Rejected
                                                <span class="float-right badge bg-danger f-s-18px mw-label" id="rejected_for_dashboard"><i class="fas fa-spinner fa-spin"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-0">
                                <div class="card-header bg-primary">
                                    <h3 class="card-title">Document Registration</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0 border-project">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a onclick="DocumentRegistration.listview.listPage(VALUE_ONE, VALUE_TWO);" class="nav-link cursor-pointer">
                                                Queried
                                                <span class="float-right badge bg-warning f-s-18px mw-label" id="total_queried_for_dashboard"><i class="fas fa-spinner fa-spin"></i></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a onclick="DocumentRegistration.listview.listPage(VALUE_TWO, VALUE_TWO);" class="nav-link cursor-pointer">
                                                Response Received & Pending Resolved
                                                <span class="float-right badge bg-primary f-s-18px mw-label" id="total_response_received_for_dashboard"><i class="fas fa-spinner fa-spin"></i></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a onclick="DocumentRegistration.listview.listPage(VALUE_TWO, VALUE_THREE);" class="nav-link cursor-pointer">
                                                Today's Appointment
                                                <span class="float-right badge bg-success f-s-18px mw-label" id="todays_appointment_for_dashboard"><i class="fas fa-spinner fa-spin"></i></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--                    <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mt-0 mb-0 table-hover-cells">
                                                        <thead>
                                                            <tr class="bg-light-gray">
                                                                <th class="text-center" style="width: 40px;">Sr. No.</th>
                                                                <th class="text-center" style="width: 80px;">District</th>
                                                                <th class="text-center" style="min-width: 200px;">Service Name</th>
                                                                <th class="text-center" style="width: 100px;">Total Application</th>
                                                                <th class="text-center" style="width: 100px;">Queried</th>
                                                                <th class="text-center" style="width: 100px;">Response Received</th>
                                                                <th class="text-center" style="width: 100px;">Approved</th>
                                                                <th class="text-center" style="width: 100px;">Rejected</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="crsr_dash_item_container_for_dashboard"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>-->
                </div>
            </div>
        <?php } ?>
    </div>
</section>