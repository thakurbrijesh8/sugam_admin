<div class="card-header">
    <input type="hidden" id="document_registration_id_for_party_order" name="document_registration_id_for_party_order" value="{{document_registration_id}}" />
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        Change Party Order Form
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;" id="poi_container_for_party_order"></div>
<div class="card-footer text-right">
    <button type="button" class="btn btn-sm btn-success"
            onclick="DocumentRegistration.listview.changeOrder($(this));">Change Order</button>
    <button type="button" class="btn btn-sm btn-danger" onclick="Swal.close();">Close</button>
</div>