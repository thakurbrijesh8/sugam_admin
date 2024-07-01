<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        Query Resolve Details
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-12 text-center">
            <span class="error-message error-message-query-resolve f-w-b"
                  style="border-bottom: 2px solid red;"></span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-12">
            <label>Remarks <span style="color: red;">*</span></label>
            <textarea id="remarks_for_query_resolve" class="form-control" placeholder="Remarks !"
                      onblur="checkValidation('query-resolve', 'remarks_for_query_resolve', remarksValidationMessage);"
                      rows="4">{{remarks}}</textarea>
            <span class="error-message error-message-query-resolve-remarks_for_query_resolve"></span>
        </div>
    </div>
</div>
<div class="card-footer text-right">
    <button type="button" class="btn btn-sm btn-success" id="submit_resolved_btn_for_query_resolve"
            onclick="resolvedQuery({{module_type}},{{module_id}});"><i class="fas fa-check" style="margin-right: 4px;"></i>Resolve</button>
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();"><i class="fa fa-times" style="padding-right: 4px;"></i>Close</button>
</div>