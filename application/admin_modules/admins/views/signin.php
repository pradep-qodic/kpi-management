<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <title>
        <?php echo (@$title)?$title:$this->config->item('applicationName');?>
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

</head>
<!-- end::Head -->

<!-- end::Body -->

<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
	<input type="hidden" id="base_url" value="<?php echo base_url();?>" />
	<input type="hidden" id="admin_base_url" value="<?php echo admin_base_url();?>" />
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(themes/admin/assets/app/media/img/bg/bg-3.jpg);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
				<img src="<?php echo admin_base_url() ?>./themes/admin/assets/app/media/img/logos/logo-1.png">  	
				</a>
                    </div>
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h3 class="m-login__title">Sign In To Respect Dashboard</h3>
                        </div>                        
						<form class="m-login__form m-form" method="post" name="frmSignIn" id="frmSignIn">
                            <div class="form-group m-form__group">
                                <input class="form-control m-input" type="email" id="uEmail" name="email"  placeholder="E-Mail" autocomplete="off">
                            </div>
                            <div class="form-group m-form__group">
                                <input class="form-control m-input m-login__form-input--last" type="password" id="uPass" name="password" class="form-control" data-toggle="password" placeholder="Password">
                            </div>
                            <div class="row m-login__form-sub">
                                <div class="col m--align-left m-login__form-left">
                                    <label class="m-checkbox  m-checkbox--focus">
                                        <input type="checkbox" name="remember"> Remember me
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="m-login__form-action">
                                <button id="btnSignIn" type="button" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <script src="<?php echo admin_base_url() ?>./themes/admin/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script src="<?php echo admin_base_url() ?>./themes/admin/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>    
    <script src="<?php echo admin_base_url() ?>./themes/admin/assets/snippets/pages/user/login.js" type="text/javascript"></script>
    <script src="<?php echo admin_base_url() ?>./themes/admin/assets/demo/default/custom/components/base/toastr.js" type="text/javascript"></script>
	<script	src="<?php echo admin_base_url('themes/admin/js/admin.js'); ?>"></script>
</body>
</html>