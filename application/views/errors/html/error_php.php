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

<!--<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4>A PHP Error was encountered</h4>

<p>Severity: <?php // echo $severity;  ?></p>
<p>Message:  <?php // echo $message;  ?></p>
<p>Filename: <?php // echo $filepath;  ?></p>
<p>Line Number: <?php // echo $line;  ?></p>

<?php // if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

        <p>Backtrace:</p>
<?php // foreach (debug_backtrace() as $error): ?>

<?php // if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

                        <p style="margin-left:10px">
                        File: <?php // echo $error['file']  ?><br />
                        Line: <?php // echo $error['line']  ?><br />
                        Function: <?php // echo $error['function']  ?>
                        </p>

<?php // endif ?>

<?php // endforeach ?>

<?php // endif ?>

</div>-->