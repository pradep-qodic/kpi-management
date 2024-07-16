<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <title>
        <?php echo (@$title)?$title:$this->config->item('applicationName');?></title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="<?php echo admin_base_url() ?>./themes/admin/js/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="<?php echo admin_base_url() ?>./themes/admin/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo admin_base_url() ?>./themes/admin/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="<?php echo admin_base_url() ?>./themes/admin/assets/demo/default/media/img/logo/favicon.ico" />

    <script src="<?php echo admin_base_url() ?>./themes/admin/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script src="<?php echo admin_base_url() ?>./themes/admin/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
    <!--<script src="<?php echo admin_base_url() ?>./themes/admin/assets/app/js/dashboard.js" type="text/javascript"></script>-->
    <script src="<?php echo admin_base_url() ?>./themes/admin/assets/demo/default/custom/components/base/toastr.js" type="text/javascript"></script>
</head>