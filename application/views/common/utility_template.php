<!--------------------------- Template definitions start ------------------------------------------------>
<script id="option_template" type="text/x-handlebars-template">
    <option value="{{value_field}}">{{text_field}}</option>
</script>
<script id="tag_spinner_template" type="text/x-handlebars-template">
    <div id="tag_spinner" class="overlay dark" style="margin-top: -38px;height: 38px;">
    <div class="spinner-border text-primary" role="status">
    <span class="sr-only">Loading...</span>
    </div>
    </div>
</script>
<script id="no_record_found_template" type="text/x-handlebars-template">
    <tr style="background-color: #{{back-color}};">
    <td class='text-center' colspan='{{colspan}}'>{{{message}}}</td>
    </tr>
</script>
<script id="spinner_template" type="text/x-handlebars-template">
    <div class="spinner-border text-{{type}} {{extra_class}}" role="status">
    <span class="sr-only">Loading...</span>
    </div>
</script>
<script id="page_spinner_template" type="text/x-handlebars-template">
    <div class="card">
    <div class="card-header p-b-0px">
    <div class="row">
    <div class="form-group col-sm-12 text-center">
    <span class="color-nic-blue"><i class="fas fa-spinner fa-spin fa-4x"></i></span>
    </div>
    </div>
    </div>
    </div>
</script>
<script id="query_form_template" type="text/x-handlebars-template">
<?php $this->load->view('query/form'); ?>
</script>
<script id="query_question_template" type="text/x-handlebars-template">
<?php $this->load->view('query/question'); ?>
</script>
<script id="document_item_template" type="text/x-handlebars-template">
<?php $this->load->view('query/document_item'); ?>
</script>
<script id="query_question_view_template" type="text/x-handlebars-template">
<?php $this->load->view('query/question_view'); ?>
</script>
<script id="query_answer_view_template" type="text/x-handlebars-template">
<?php $this->load->view('query/answer_view'); ?>
</script>
<script id="document_item_view_template" type="text/x-handlebars-template">
<?php $this->load->view('query/document_item_view'); ?>
</script>
<script id="query_resolve_template" type="text/x-handlebars-template">
<?php $this->load->view('query/resolve'); ?>
</script>
<script id="query_resolve_view_template" type="text/x-handlebars-template">
<?php $this->load->view('query/resolve_view'); ?>
</script>

<script type="text/x-handlebars-template" id="pay_template">
<?php $this->load->view('payment/pay'); ?>
</script>
<script type="text/x-handlebars-template" id="fb_list_template">
<?php $this->load->view('payment/fb_list'); ?>
</script>
<script type="text/x-handlebars-template" id="fb_item_view_template">
<?php $this->load->view('payment/fb_item_view'); ?>
</script>
<script type="text/x-handlebars-template" id="ph_list_template">
<?php $this->load->view('payment/ph_list'); ?>
</script>
<script type="text/x-handlebars-template" id="ph_item_template">
<?php $this->load->view('payment/ph_item'); ?>
</script>
<script type="text/x-handlebars-template" id="upd_list_template">
<?php $this->load->view('payment/upd_list'); ?>
</script>
<script type="text/x-handlebars-template" id="upd_item_template">
<?php $this->load->view('payment/upd_item'); ?>
</script>

<script type="text/x-handlebars-template" id="fp_mail_history_template">
    <?php $this->load->view('mail/fp_history'); ?>
</script>

<script type="text/x-handlebars-template" id="duplicate_details_template">
    <?php $this->load->view('certificate/duplicate_details'); ?>
</script>
<!--------------------------------  Template definitions end -------------------------------------------->