<aside class="main-sidebar sidebar-dark-primary">
    <?php $this->load->view('common/logo'); ?>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if (!is_user_acc_ver()) { ?>
                    <li class="nav-item">
                        <a id="menu_dashboard" href="Javascript:void(0);" class="nav-link menu-close-click border-project"
                           onclick="Dashboard.listview.listPage();">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                <?php } if (is_admin() || is_talathi_user() || is_aci_user() || is_mamlatdar_user() || is_mam_view_user() || is_ldc_user() || is_sdpo_user()) { ?>
                    <li class="nav-item has-treeview">
                        <a id="menu_certificates" href="Javascript:void(0)" class="nav-link border-project">
                            <i class="nav-icon fas fa-certificate"></i>
                            <p>Certificates <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (!is_sdpo_user()) { ?>
                                <li class="nav-item">
                                    <a id="menu_income_certificate" href="Javascript:void(0);"
                                       onclick="IncomeCertificate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>Income Certificate</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu_domicile" href="Javascript:void(0);"
                                       onclick="Domicile.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>Domicile Certificate</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu_caste_certificate" href="Javascript:void(0);"
                                       onclick="CasteCertificate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>Caste Certificate</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu_heirship" href="Javascript:void(0);"
                                       onclick="Heirship.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>Heir Ship Certificate</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu_obc_certificate" href="Javascript:void(0);"
                                       onclick="ObcCertificate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>OBC Certificate</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu_ncl_certificate" href="Javascript:void(0);"
                                       onclick="NclCertificate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>NCL (OBC Renewal) Certificate</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu_ews_certificate" href="Javascript:void(0);"
                                       onclick="EwsCertificate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>EWS Certificate</p>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (!is_talathi_user() && !is_aci_user()) { ?>
                                <li class="nav-item">
                                    <a id="character_certificate" href="Javascript:void(0);"
                                       onclick="CharacterCertificate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Character Certificate</p>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php if (is_admin() || is_talathi_user() || is_mamlatdar_user() || is_mam_view_user() || is_aci_user() || is_ldc_user()) { ?>
                        <li class="nav-item has-treeview">
                            <a id="menu_mamlatdar" href="Javascript:void(0)" class="nav-link border-project">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Mamlatdar Office <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if (!is_ldc_user()) {
                                 if (!is_mam_view_user()) { ?>
                                    <li class="nav-item">
                                        <a id="mam_form_1_14_oc" href="Javascript:void(0);"
                                           onclick="FormOneFourteen.listview.listPageOC();" class="nav-link menu-close-click">
                                            <i class="nav-icon fas fa-file-alt"></i>
                                            <p>Form No. I & XIV (Office Copy)</p>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="nav-item">
                                    <a id="mam_form_1_14" href="Javascript:void(0);"
                                       onclick="FormOneFourteen.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="nav-icon fas fa-file-alt"></i>
                                        <p>Form No. I & XIV</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="mam_form_3" href="Javascript:void(0);"
                                       onclick="FormThree.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Form No. 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="mam_form_5" href="Javascript:void(0);"
                                       onclick="FormFive.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Form No. 5</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="mam_form_9" href="Javascript:void(0);"
                                       onclick="FormNine.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Form No. 9</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="mam_certified_copy" href="Javascript:void(0);"
                                       onclick="CertifiedCopy.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Certified Copy</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="mam_rti" href="Javascript:void(0);"
                                       onclick="Rti.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>RTI</p>
                                    </a>
                                </li>
                                <?php if (!is_aci_user()) { ?>
                                    <li class="nav-item">
                                        <a id="mam_dapvr_case" href="Javascript:void(0);"
                                           onclick="DAPVRCase.listview.listPage();" class="nav-link menu-close-click">
                                            <i class="nav-icon fas fa-file-alt"></i>
                                            <p>DAPVR Case</p>
                                        </a>
                                    </li>
                                <?php } } ?>
                                    <li class="nav-item">
                                    <a id="mam_ga" href="Javascript:void(0);"
                                       onclick="GeneralApplication.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>General Application</p>
                                    </a>
                                </li>
                                
                                    <?php if (is_talathi_user() || is_mamlatdar_user() || is_aci_user() || is_admin()) { ?>
                                    <li class="nav-item">
                                        <a id="assign_khata_number" href="Javascript:void(0);"
                                           onclick="ArrearsUpdate.listview.listPage();" class="nav-link menu-close-click">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>Assign Khata Number</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="assign_khata_number_v2" href="Javascript:void(0);"
                                           onclick="ArrearsUpdate.listview.listPageForAssignKhataNumberV2();" class="nav-link menu-close-click">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>Assign Khata Number V2</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="khata_number" href="Javascript:void(0);"
                                           onclick="KhataNumber.listview.listPage();" class="nav-link menu-close-click">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>Khata Number</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="landtax_na" href="Javascript:void(0);"
                                           onclick="LandTaxNA.listview.listPage();" class="nav-link menu-close-click">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>Land Tax (N.A.)</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="landtax_agriculture" href="Javascript:void(0);"
                                           onclick="LandTaxAgriculture.listview.listPage();" class="nav-link menu-close-click">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>Land Tax (Agriculture)</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="notice_history" href="Javascript:void(0);"
                                           onclick="LandTaxNA.listview.listPageForNH();" class="nav-link menu-close-click">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>Notice History (N.A.)</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="notice_history_agriculture" href="Javascript:void(0);"
                                           onclick="LandTaxAgriculture.listview.listPageForNHAgriculture();" class="nav-link menu-close-click">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>Notice History (Agriculture)</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="tr_five_history" href="Javascript:void(0);"
                                           onclick="LandTaxNA.listview.listPageForTRFive();" class="nav-link menu-close-click">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>T.R.5 History (N.A.)</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="tr_five_history_agriculture" href="Javascript:void(0);"
                                           onclick="LandTaxAgriculture.listview.listPageForTRFiveAgriculture();" class="nav-link menu-close-click">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                            <p>T.R.5 History (Agriculture)</p>
                                        </a>
                                    </li>
                                <?php } ?>  
                            </ul>
                        </li>
                        <?php
                    }
                } if (is_admin() || is_eocs_fs_user() || is_eocs_hs_user() || is_eocs_head() || is_eocs_jfs_user()) {
                    ?>
                    <li class="nav-item has-treeview">
                        <a id="menu_eocs" href="Javascript:void(0)" class="nav-link border-project">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>EOCS Office<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="eocs_site_plan" href="Javascript:void(0);"
                                   onclick="EocsSitePlan.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-map nav-icon"></i>
                                    <p>Site Plan (Urban Area)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="eocs_site_plan_rural" href="Javascript:void(0);"
                                   onclick="EocsSitePlanRural.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-map nav-icon"></i>
                                    <p>Site Plan (Rural Area)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="property_card" href="Javascript:void(0);"
                                   onclick="PropertyCard.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-map nav-icon"></i>
                                    <p>Property Card</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="svamitva_ror" href="Javascript:void(0);"
                                   onclick="SvamitvaRor.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-map nav-icon"></i>
                                    <p>Svamitva RoR</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } if (is_admin()) { ?>
                    <li class="nav-item has-treeview">
                        <a id="menu_collector" href="Javascript:void(0)" class="nav-link border-project">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Collector Office<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="coll_na_application" href="Javascript:void(0);"
                                   onclick="NaApplication.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-id-card nav-icon"></i>
                                    <p>Change In Land Use (N.A.)</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } if (is_admin() || is_subr_user() || is_subr_ver_user()) { ?>
                    <li class="nav-item has-treeview">
                        <a id="menu_sub_registrar" href="Javascript:void(0)" class="nav-link border-project">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Sub-Registrar Office<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (is_admin() || is_subr_user()) { ?> 
                                <li class="nav-item">
                                    <a id="subr_circle_rate" href="Javascript:void(0);"
                                       onclick="CircleRate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-rupee-sign nav-icon"></i>
                                        <p>Update Circle Rates</p>
                                    </a>
                                </li>
                            <?php } if (is_admin() || is_subr_user() || is_subr_ver_user()) { ?>
                                <li class="nav-item">
                                    <a id="subr_document_registration" href="Javascript:void(0);"
                                       onclick="DocumentRegistration.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-id-card nav-icon"></i>
                                        <p>Document Registration</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="subr_marriage_certificate" href="Javascript:void(0);"
                                       onclick="MarriageCertificate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-id-card nav-icon"></i>
                                        <p>Marriage Application</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="subr_birth_certificate" href="Javascript:void(0);"
                                       onclick="BirthCertificate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-id-card nav-icon"></i>
                                        <p>Birth Certificate</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="subr_death_certificate" href="Javascript:void(0);"
                                       onclick="DeathCertificate.listview.listPage();" class="nav-link menu-close-click">
                                        <i class="fas fa-id-card nav-icon"></i>
                                        <p>Death Certificate</p>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } if (is_admin() || is_talathi_user() || is_aci_user() || is_ldc_user() || is_mamlatdar_user() || is_mam_view_user() || is_eocs_fs_user() || is_eocs_hs_user() || is_eocs_head()) { ?>
                    <li class="nav-item has-treeview">
                        <a id="menu_opd" href="Javascript:void(0)" class="nav-link border-project">
                            <i class="nav-icon fas fa-money-check"></i>
                            <p>Online Payment Details <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="menu_oph" href="Javascript:void(0);" class="nav-link menu-close-click"
                                   onclick="Dashboard.listview.listPageForOPH();">
                                    <i class="nav-icon fas fa-rupee-sign"></i>
                                    <p>Online Payment History</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_hwr" href="Javascript:void(0);" class="nav-link menu-close-click"
                                   onclick="Dashboard.listview.listPageForHWR();">
                                    <i class="nav-icon fas fa-heading"></i>
                                    <p>Head Wise Report</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } if (is_admin()) { ?>
                    <li class="nav-item has-treeview">
                        <a id="menu_users" href="Javascript:void(0)" class="nav-link border-project">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Admin Master Manage. <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="menu_users_user" href="Javascript:void(0);"
                                   onclick="Users.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_users_user_type" href="Javascript:void(0);"
                                   onclick="Users.listview.listPageForUserType();" class="nav-link menu-close-click">
                                    <i class="fas fa-list-alt nav-icon"></i>
                                    <p>User Type</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_users_department" href="Javascript:void(0);"
                                   onclick="Department.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-building nav-icon"></i>
                                    <p>Department(s)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_users_service" href="Javascript:void(0);"
                                   onclick="Service.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-server nav-icon"></i>
                                    <p>Service(s)</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } if (is_admin() || is_user_acc_ver()) { ?>
                    <li class="nav-item has-treeview">
                        <a id="menu_client_mm" href="Javascript:void(0)" class="nav-link border-project">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Client Master Manage. <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="menu_client_active_users" href="Javascript:void(0);"
                                   onclick="ActiveUsers.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Active Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_client_vp_users" href="Javascript:void(0);"
                                   onclick="VPUsers.listview.listPage();" class="nav-link menu-close-click">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Pending Verification Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_client_deleted_users" href="Javascript:void(0);"
                                   onclick="VPUsers.listview.loadDeletedUserData();" class="nav-link menu-close-click">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Deleted Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } if (is_admin()) { ?>
                    <li class="nav-item has-treeview">
                        <a id="menu_logs" href="Javascript:void(0);" class="nav-link border-project">
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Logs <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a id="menu_admin_logs_login_detail" href="Javascript:void(0);"
                                   onclick="Logs.listview.listPageForALL();" class="nav-link menu-close-click">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>Admin Login Details</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_user_logs_login_detail" href="Javascript:void(0);"
                                   onclick="Logs.listview.listPageForULL();" class="nav-link menu-close-click">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>User Login Details</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_logs_dg_locker_api" href="Javascript:void(0);"
                                   onclick="Logs.listview.listPageForDGLAPI();" class="nav-link menu-close-click">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>DG Locker API Logs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_logs_email" href="Javascript:void(0);"
                                   onclick="Logs.listview.listPageForEmail();" class="nav-link menu-close-click">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>Email Logs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_logs_ddd_api" href="Javascript:void(0);"
                                   onclick="Logs.listview.listPageForDDDAPI();" class="nav-link menu-close-click">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>DDD API Logs</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_logs_sms" href="Javascript:void(0);"
                                   onclick="Logs.listview.listPageForSMS();" class="nav-link menu-close-click">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>SMS Logs</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a id="menu_change_password" href="Javascript:void(0);"
                       onclick="Users.listview.listPageForChangePassword();" class="nav-link menu-close-click border-project">
                        <i class="nav-icon fa fa-key"></i>
                        <p>Change Password</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="menu_logout" href="<?php echo base_url() ?>login/logout" class="nav-link menu-close-click border-project" onclick="activeLink('menu_logout');">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
