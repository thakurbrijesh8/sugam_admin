<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-user-lock"></i> Email Logs</h1>
            </div>     
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#dashboard">Home</a></li>
                    <li class="breadcrumb-item">Logs</li>
                    <li class="breadcrumb-item active">Email Logs</li>
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
                    <table id="email_logs_datatable" class="table table-bordered table-hover vat-top">
                        <thead>
                            <tr class="bg-light-gray">
                                <th class="text-center" style="width: 20px;">No.</th>
                                <th class="text-center" style="min-width: 110px;">Date & time</th>
                                <th class="text-center" style="min-width: 110px;">Email Type</th>
                                <th class="text-center" style="min-width: 110px;">Service</th>
                                <th class="text-center" style="min-width: 200px;">Email</th>
                                <th class="text-center" style="min-width: 80px;">Status</th>
                                <th class="text-center" style="width: 50px;">Action</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control text-center" placeholder="Date & Time" maxlength="50"/>
                                </td>
                                <th>
                                    <select id="email_type_for_ellist" class="form-control select2" style="position: relative; width: 100%;"
                                            data-placeholder="Select Type">
                                    </select>
                                </th>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control text-center" placeholder="Email" maxlength="50"/>
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