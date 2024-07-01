{{#if show_extra_div}}
<div>
    {{/if}}
    <i class="fas fa-check bg-success"></i>
    <div class="timeline-item">
        <span class="time text-dark f-w-b"><i class="fas fa-clock"></i> Query Resolved By & Date Time : <span class="color-nic-red">{{query_by_name}} ( {{datetime_text}} )</span></span>
        <h3 class="timeline-header"><a class="text-success" href="Javascript:void(0);">Query Resolved</a></h3>
        <div class="timeline-body p-b-0px">
            <div class="row">
                <div class="form-group col-sm-12">
                    <label>Remarks <span style="color: red;">*</span></label>
                    <div class="box-new textarea-new">{{remarks}}</div>
                </div>
            </div>
        </div>
    </div>
    {{#if show_extra_div}}
</div>
{{/if}}