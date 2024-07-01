<tr>
    <td class="text-center">{{item_cnt}}</td>
    <td class="text-center">{{district_text}}</td>
    <td style="vertical-align: top !important;">{{service_name}}</td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_ZERO}});">
        <span class="badge bg-primary app-status f-s-18px mw-label">{{total_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_TWO}});">
        <span class="badge bg-warning app-status f-s-18px mw-label">{{submitted_app}}</span></td>    
    {{#if enable_onclick}}
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_ONE}});">
        <span class="badge bg-warning app-status f-s-18px mw-label">{{queried_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_SEVEN}});">
        <span class="badge bg-nic-blue app-status f-s-18px mw-label">{{response_received_app}}</span></td>
    {{else}}
    <td></td><td></td>
    {{/if}}
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_THREE}});">
        <span class="badge bg-warning app-status f-s-18px mw-label">{{fees_pending}}</span></td>
    {{#if enable_pgcp}}
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_FOUR}},{{VALUE_ONE}});">
        <span class="badge bg-warning app-status f-s-18px mw-label">{{fees_paid}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_FOUR}},{{VALUE_TWO}});">
        <span class="badge bg-info app-status f-s-18px mw-label">{{fees_paid_generated}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_FOUR}},{{VALUE_THREE}});">
        <span class="badge bg-orange app-status f-s-18px mw-label">{{fees_paid_prepared}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_FOUR}},{{VALUE_FOUR}});">
        <span class="badge bg-success app-status f-s-18px mw-label">{{fees_paid_checked}}</span></td>
    {{else}}
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_FOUR}});">
        <span class="badge bg-success app-status f-s-18px mw-label">{{fees_paid}}</span></td>
    {{/if}}
    {{#if enable_blank_pgcp}}
    <td></td><td></td><td></td>
    {{/if}}
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_FIVE}});">
        <span class="badge bg-success app-status f-s-18px mw-label">{{approved_app}}</span></td>
    <td class="text-center f-w-b f-s-16px cursor-pointer"
        onclick="Dashboard.listview.changeRouterForMam({{module_type}},{{district}},{{VALUE_SIX}});">
        <span class="badge bg-danger app-status f-s-18px mw-label">{{rejected_app}}</span></td>
</tr>