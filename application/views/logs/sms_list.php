<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-user-lock"></i> SMS Logs</h1>
            </div>     
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item">Logs</li>
                    <li class="breadcrumb-item active">SMS Logs</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="sms_logs_datatable" class="table table-bordered table-hover vat-top">
                        <thead>
                            <tr class="bg-light-gray">
                                <th class="text-center" style="width: 20px;">No.</th>
                                <th class="text-center" style="min-width: 90px;">SMS Time</th>
                                <th class="text-center" style="min-width: 90px;">App Type</th>
                                <th class="text-center" style="min-width: 110px;">SMS Type</th>
                                <th class="text-center" style="min-width: 110px;">Module Type</th>
                                <th class="text-center" style="width: 100px;">Mobile Number</th>
                                <th class="text-center" style="min-width: 180px;">Message</th>
                                <th class="text-center" style="min-width: 150px;">Status</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                   <select id="app_type_for_smslist" class="form-control select2" style="position: relative; width: 100%;"
                                            data-placeholder="Select Type">
                                        <option value="">All</option>
                                    </select>
                                </td>
                                <td>
                                    <select id="sms_type_for_smslist" class="form-control select2" style="position: relative; width: 100%;"
                                            data-placeholder="Select Type">
                                          <option value="">All</option>
                                    </select>
                                </td>
                                <td>
                                    <select id="module_type_for_smslist" class="form-control select2" style="position: relative; width: 100%;"
                                            data-placeholder="Select Type">
                                          <option value="">All</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" placeholder="Mobile Number" maxlength="10"/>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>