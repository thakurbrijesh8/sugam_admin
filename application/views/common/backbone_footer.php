<script type="text/javascript" src="<?php echo base_url() ?>js/project/dashboard.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/users.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/logs.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/income_certificate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/active_users.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/vp_users.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/domicile.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/heirship.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/caste_certificate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/obc_certificate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/na_application.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/ncl_certificate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/ews_certificate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/form_one_fourteen.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/form_three.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/form_nine.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/certified_copy.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/rti.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/character_certificate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/dapvr_case.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/arrears_update.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/document_registration.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/khata_number.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/circle_rate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/landtax_na.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/form_five.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/eocs_site_plan.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/property_card.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/eocs_site_plan_rural.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/department.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/service.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/marriage_certificate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/svamitva_ror.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/birth_certificate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/death_certificate.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/landtax_agriculture.js?<?php echo VERSION; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/project/general_application.js?<?php echo VERSION; ?>"></script>

<script type="text/javascript" >
    $(function () {
        Dashboard.run();
        Users.run();
        Logs.run();
        IncomeCertificate.run();
        ActiveUsers.run();
        VPUsers.run();
        Domicile.run();
        Heirship.run();
        CasteCertificate.run();
        ObcCertificate.run();
        NaApplication.run();
        NclCertificate.run();
        EwsCertificate.run();
        FormOneFourteen.run();
        FormThree.run();
        FormNine.run();
        CertifiedCopy.run();
        Rti.run();
        CharacterCertificate.run();
        DAPVRCase.run();
        ArrearsUpdate.run();
        KhataNumber.run();
        LandTaxNA.run();
        DocumentRegistration.run();
        CircleRate.run();
        FormFive.run();
        EocsSitePlan.run();
        PropertyCard.run();
        EocsSitePlanRural.run();
        Department.run();
        Service.run();
        MarriageCertificate.run();
        SvamitvaRor.run();
        BirthCertificate.run();
        DeathCertificate.run();
        LandTaxAgriculture.run();
        GeneralApplication.run();
        Backbone.history.start();
    });
    var width = parseFloat($(window).width());
    if (width < 1024) {
//        $('body').addClass('sidebar-collapse');

        // Close side bar when Display width is less then 1400.
        $('a.menu-close-click').click(function () {
            if ($('body').hasClass('sidebar-open') || !$('body').hasClass('sidebar-collapse')) {
                $('#sidebar_button').click();
            }
        });
    }
</script>