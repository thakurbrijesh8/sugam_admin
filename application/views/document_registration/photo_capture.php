<div class="card-header">
    <h3 class="card-title f-w-b" style="float: none; text-align: center;">
        Capture Photo & Biometrics Form
    </h3>
</div>
<div class="card-body p-b-0px text-left" style="font-size: 13px;">
    <div class="row">
        <div class="col-sm-6 text-center">
            <div id="camera_container_for_drtp"></div>
            <button type="button" class="btn btn-sm btn-nic-blue mt-1"
                    onclick="DocumentRegistration.listview.takePhoto();"
                    style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px;">
                <i class="fas fa-camera" style="margin-right: 5px;"></i> Review & Capture Photo</button>
        </div>
        <div class="col-sm-6 text-center">
            <input type="hidden" name="party_photo_for_drtp" id="party_photo_for_drtp" value="">
            <div id="temp_image_container_for_drtp"></div>
            <button type="button" class="btn btn-sm btn-success mt-1" id="upload_photo_btn_for_drtp"
                    onclick="DocumentRegistration.listview.uploadPartyPhoto($(this),'{{dr_party_details_id}}');"
                    style="padding: 2px 7px; margin-top: 1px; margin-bottom: 2px; display: none;">
                <i class="fas fa-cloud-upload-alt" style="margin-right: 5px;"></i> Confirm Photo</button>
        </div>
    </div>
</div>