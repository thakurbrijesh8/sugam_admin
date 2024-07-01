<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="f-w-b f-s-15px text-primary">Sr. No. : {{tpi_cnt}} : {{party_name}}</div>
        <div class="table-responsive">
            <table class="table table-bordered table-padding bg-beige">
                <tr>
                    <td class="f-w-b" style="width: 40%;">Party Category</td>
                    <td>{{party_category_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Description</td>
                    <td>{{party_description_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Full Name</td>
                    <td class="f-w-b f-s-16px text-primary">{{party_name}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Address</td>
                    <td>{{party_address}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Date of Birth / Year of Birth / Age</td>
                    <td>{{party_dob_year_text}}</td>
                </tr>
                <tr>
                    <td class="f-w-b">Party Gender</td>
                    <td>{{party_gender_text}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="row">
            <div class="col-12">
                <img src="{{photo_path}}" id="photo_container_for_drtp_{{dr_party_details_id}}"
                     style="max-height: 195px; border: 1px solid #aaaaaa; cursor: pointer;" 
                     {{#if show_change_photo_and_biomatrics_details}}
                     onclick="DocumentRegistration.listview.takePhotoForm('{{dr_party_details_id}}');"
                     {{/if}}/>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-2">
        <hr>
    </div>
</div>
