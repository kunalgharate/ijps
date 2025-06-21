		<?php 
			$this->load->view(BACKOFFICE.'layout/header');
		?>
		<!-- Login Page Custom Styles(used by this page)-->
		<link href="<?php echo base_url('assetsbackoffice/css/pages/login/classic/login-27a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
		<!--Login Page Custom Styles-->
		
		<link rel="shortcut icon" href="" />
	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<div class="d-flex flex-column flex-root">
			<div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
				<div class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
					<div class="d-flex flex-row-fluid flex-column justify-content-between">
						<div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
							<a href="#" class="mb-10 text-center">
								<img src="<?= base_url() ?>assetsbackoffice/images/mainlogo.png" class="max-h-75px" alt="" />
							</a>
							<div class="login-form login-signin">
								<div class="text-center mt-0 mb-lg-5">
									<h2 class="font-weight-bold">Sign In (Admin)</h2>
									<p class="text-muted font-weight-bold">Enter your username and password</p>
								</div>
								<form class="form" method="post" action="<?php echo site_url(BACKOFFICE.'login/authenticateUser'); ?>" >
									<div class="form-group py-3 m-0">
										<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Email" placeholder="Username" name="txtUserName" autocomplete="off" required />
									</div>
									<div class="form-group py-3 border-top m-0">
										<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="Password" name="txtPassword" required/>
									</div>
									<div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
										<div class="checkbox-inline">
											<label class="checkbox checkbox-outline m-0 text-muted">
											<input type="checkbox" name="remember" />
											<span></span>Remember me</label>
										</div>
										<a href="<?php echo base_url('assetsbackoffice/forgotPassword.php'); ?>" class="text-muted text-hover-primary">Forgot Password ?</a>
									</div>
									<div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
										<div class="my-3 mr-2">
											<!--<span class="text-muted mr-2">Don't have an account?</span>
											<a href="#" id="kt_login_signup1" class="font-weight-bold">Signup</a>-->
										</div>
										<button type="submit" class="btn font-weight-bold px-9 py-4 my-3" style="border:1px solid;"> <!--btn-primary  font-weight-bold px-9 py-4 my-3-->
											Sign In
										</button>
										<!--<button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Sign In</button>-->
										<!--<button type="button" class="btn btn-primary font-weight-bold px-9 py-4 my-3"><a href="<?php echo base_url('assetsbackoffice/dashboard.php'); ?>" style="color:white;">Sign In</a></button>-->
									</div>
								</form>
							</div>
						</div>
						<div class="d-flex flex-column-auto justify-content-between mt-15">
							<div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">
								<span class="text-muted font-weight-bold mr-2">Copyright <?php echo  date("Y");?></span>
								<a href="<?= base_url() ?>" target="_blank" class="text-dark-75 text-hover-primary">
								    ijpsjournal.com
								</a> 
								<span class="text-muted font-weight-bold mr-2">All Rights Reserved.</span>
							</div>
						</div>
					</div>
				</div>
				<div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7" style="background-image: url(<?php echo base_url('assetsbackoffice/images/login-background.png'); ?>); background-repeat: no-repeat; background-size: cover; background-position: top right;">
					<div class="d-flex flex-column-fluid flex-lg-center">
						<div class="d-flex flex-column justify-content-center">
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
			$this->load->view(BACKOFFICE.'layout/jsfiles');
		?>
		
		<!--Login Page Scripts(used by this page)-->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/custom/login/login-general7a50.js?v=7.2.7'); ?>"></script>
		<!--Login Page Scripts-->

	</body>
</html>