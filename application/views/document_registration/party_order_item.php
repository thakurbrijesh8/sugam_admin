<div class="card party_details_for_poi fw-body">
    <div class="card-header pt-2 pb-1 bg-nic-blue" style="border-radius: 0.25rem;">
        <input type="hidden" class="dr_pd_id_for_poi" value="{{dr_party_details_id}}" />
        <h3 class="card-title f-w-b f-s-15px">
            Party Detail : Sr. No. {{poi_cnt}} -
            <span class="badge bg-white app-status">{{party_category_text}}</span> -
            <span class="badge bg-white app-status">{{party_description_text}}</span> - 
            <span class="badge bg-white app-status">{{party_name}}</span>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool bg-orange" data-card-widget="collapse"
                    style="margin: -5px 2px -2px 0px; padding: 4px 10px 3px 10px;">
                <i class="fas fa-sort"></i>
            </button>
        </div>
    </div>
</div>