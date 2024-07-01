<tr>
    <td class="text-center">{{item_cnt}}</td>
    <td class="text-center">{{district_text}}</td>
    <td style="vertical-align: top !important;">{{service_name}}</td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}});">
        <span class="badge bg-primary app-status f-s-18px mw-label">{{total_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_ONE}});">
        <span class="badge bg-warning app-status f-s-18px mw-label">{{queried_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_TWO}});">
        <span class="badge bg-nic-blue app-status f-s-18px mw-label">{{response_received_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_FIVE}});">
        <span class="badge bg-success app-status f-s-18px mw-label">{{approved_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_SIX}});">
        <span class="badge bg-danger app-status f-s-18px mw-label">{{rejected_app}}</span></td>
</tr>