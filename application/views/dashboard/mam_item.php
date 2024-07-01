<tr>
    <td class="text-center">{{item_cnt}}</td>
    <td class="text-center">{{district_text}}</td>
    <td style="vertical-align: top !important;">{{service_name}}</td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_ZERO}});">
        <span class="badge bg-primary app-status f-s-18px mw-label">{{total_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_FOUR}});">
        <span class="badge bg-warning app-status f-s-18px mw-label">{{new_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_ONE}});">
        <span class="badge bg-warning app-status f-s-18px mw-label">{{queried_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_TWO}});">
        <span class="badge bg-nic-blue app-status f-s-18px mw-label">{{response_received_app}}</span></td>
    <?php if (is_admin() || is_talathi_user()) { ?>
        <td class="text-center f-w-b f-s-16px cursor-pointer"
            onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_SEVEN}});">
            <span class="badge bg-success app-status f-s-18px mw-label">{{app_scheduled_app}}</span></td>
    <?php } if (is_talathi_user() || is_aci_user() || is_ldc_user()) { ?>
        <td class="text-center f-w-b f-s-16px cursor-pointer"
            onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_EIGHT}});">
            <span class="badge bg-secondary app-status f-s-18px mw-label">{{forwarded_app}}</span></td>
    <?php } if (is_admin()) { ?>
        <td class="text-center f-w-b f-s-16px cursor-pointer"
            onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_THREE}});">
            <span class="badge bg-orange app-status f-s-18px mw-label">{{reverification_app}}</span></td>
    <?php } if (is_talathi_user() || is_aci_user() || is_ldc_user()) { ?>
        <td class="text-center f-w-b f-s-16px cursor-pointer"
            onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_NINE}});">
            <span class="badge bg-orange app-status f-s-18px mw-label">{{new_reverification_app}}</span></td>
    <?php } if (is_talathi_user() || is_aci_user() || is_ldc_user() || is_mamlatdar_user()) { ?>
        <td class="text-center f-w-b f-s-16px cursor-pointer"
            onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_TEN}});">
            <span class="badge bg-orange app-status f-s-18px mw-label">{{forwarded_reverification_app}}</span></td>
    <?php } if (is_mamlatdar_user()) {  ?>
        <td class="text-center f-w-b f-s-16px cursor-pointer"
            onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_ELEVEN}});">
            <span class="badge bg-orange app-status f-s-18px mw-label">{{received_reverification_app}}</span></td>
    <?php }?>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_FIVE}});">
        <span class="badge bg-success app-status f-s-18px mw-label">{{approved_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_SIX}});">
        <span class="badge bg-danger app-status f-s-18px mw-label">{{rejected_app}}</span></td>
</tr>