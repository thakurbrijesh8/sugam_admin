<?php
$base_url = base_url();
$tci = & get_instance();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SUGAM ADMIN | Site is Temporary Unavailable</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $tci->load->view('common/css_links', array('base_url' => $base_url)); ?>
        <?php $tci->load->view('common/js_links', array('base_url' => $base_url)); ?>
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
                    <div class="error-page text-center" style="margin: 0px auto 0;">
                        <h1 class="text-danger" style="font-size: 30px;">
                            <i class="fas fa-exclamation-triangle"></i>  Site is Temporary Unavailable ! <br> Please Try Later !
                        </h1>
                    </div>
                </section>
            </div>
            <?php $tci->load->view('common/footer_text'); ?>
        </div>
    </body>
</html>

<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Database Error</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
        background-color: #fff;
        margin: 40px;
        font: 13px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
}

a {
        color: #003399;
        background-color: transparent;
        font-weight: normal;
}

h1 {
        color: #444;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 19px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
}

code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 12px;
        background-color: #f9f9f9;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
}

#container {
        margin: 10px;
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 8px #D0D0D0;
}

p {
        margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
        <div id="container">
                <h1><?php // echo $heading;    ?></h1>
<?php // echo $message; ?>
        </div>
</body>
</html>-->