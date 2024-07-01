<?php $base_url = base_url(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SUGAM ADMIN</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->load->view('common/css_links', array('base_url' => $base_url)); ?>
        <?php $this->load->view('common/js_links', array('base_url' => $base_url)); ?>
    </head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <span class="brand-text font-weight-light" style="font-weight: bold !important; font-size: 25px !important;"><span class="d-sm-block d-md-none d-lg-none">SUGAM ADMIN</span> <span class="d-none d-md-block d-lg-block">SUGAM ADMIN</span></span>
                </div>
            </nav>
            <div class="content-wrapper">
                <section class="content" style="padding-top: 15%;">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-8">
                                <div class="card shadow-lg">
                                    <div class="card-body text-center">
                                        <div class="mb-2"><i class="fa fa-<?php echo $pg_icon; ?> fa-5x <?php echo $pg_class; ?>"></i></div>
                                        <h2 class="<?php echo $pg_class; ?>"><?php echo $pg_title; ?></h2>
                                        <h4><?php echo $pg_message; ?></h4>
                                        <a class="btn btn-primary text-white mt-3" href="<?php echo $base_url; ?>main?<?php echo $redirect_url; ?>">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php $this->load->view('common/footer_text'); ?>
        </div>
    </body>
</html>