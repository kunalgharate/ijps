<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | International Journal of Pharmaceutical Sciences</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assetsbackoffice/new_login/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assetsbackoffice/new_login/css/fontawesome-all.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assetsbackoffice/new_login/css/iofrm-style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assetsbackoffice/new_login/css/iofrm-theme27.css') ?>">
    <meta charset="utf-8" />
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
		<title>International Journal of Pharmaceutical Sciences | Open Access</title>
		<meta name="description" content="ijpsjournal" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="" />
		
		<!-- Font Start-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!-- Font End-->
</head>

<body>
    <div class="form-body without-side">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <img class="logo-size" src="<?php echo base_url('assetsbackoffice/new_login/images/logo-light.svg')?>" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="<?php echo base_url('assetsbackoffice/new_login/images/graphic8.svg')?>" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="form-icon">
                        <div class="icon-holder"><img src="<?= base_url() ?>assetsbackoffice/new_login/images/ijps_logo-removebg-preview.svg" alt=""></div>
                        </div>
                        <h3 class="form-title-center">Sign In (Admin)</h3>
                        <form method="post" action="<?php echo site_url(BACKOFFICE.'LoginController/verifyOtp'); ?>">
                            <input class="form-control" type="email" name="txtUserName" placeholder="E-mail Address" required>
                            <input class="form-control" type="password" name="txtPassword" placeholder="Password" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn ibtn-full">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assetsbackoffice/new_login/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assetsbackoffice/new_login/js/popper.min.js') ?>"></script>
    <script src="<?php echo base_url('assetsbackoffice/new_login/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assetsbackoffice/new_login/js/main.js') ?>"></script>
</body>
</html>