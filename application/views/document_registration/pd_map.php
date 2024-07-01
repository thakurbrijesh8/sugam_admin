<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        Select Latitude & Longitude
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="form-group col-sm-4">
            <label>Latitude</label>
            <input type="text" class="form-control {{module_type}}_latitude_for_drsfour_{{temp_cnt}}"
                   placeholder="Enter Latitude !" maxlength="30" value="{{lat_display}}" readonly="">
        </div>
        <div class="form-group col-sm-4">
            <label>Longitude</label>
            <input type="text" class="form-control {{module_type}}_longitude_for_drsfour_{{temp_cnt}}"
                   placeholder="Enter Longitude !" maxlength="30" value="{{lng_display}}" readonly="">
        </div>
        <div class="form-group col-sm-4">
            <label>&nbsp;</label>
            <div>
                <button type="button" class="btn btn-sm btn-success" onclick="Swal.close();">Select & Close</button>
                <button type="button" class="btn btn-sm btn-danger"
                        onclick="DocumentRegistration.listview.resetAndClose('{{module_type}}',{{temp_cnt}});">Clear & Close</button>
            </div>
        </div>
    </div>
    <div id="{{module_type}}_map_container_for_drsfour_{{temp_cnt}}" style="height: 500px;"></div>
</div>