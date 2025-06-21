		<?php 
			$this->load->view('layout/header');
		?>
		<!-- Login Page Custom Styles(used by this page)-->
		<link href="<?php echo base_url('assetsbackoffice/css/pages/login/classic/login-27a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
		<!--Login Page Custom Styles-->
		
		<link rel="shortcut icon" href="" />
		
		<style>
			body {
			  /*background-image: url("https://lh3.googleusercontent.com/p/AF1QipOmPrKepTHVM9JqF81UMz2VIzx_Y-GWoqn-u2_t=s1360-w1920-h900");*/
			  background-position: center;
			  background-repeat: no-repeat;
			  background-size: cover;
			  background-color:white;
			  
			}

			.row
			{
				margin-right: 0px;
			}

			.form-control {
				padding-left: 15px !important;
				padding-right: 15px !important;
			}
			.checkbox.checkbox-outline>span {
				border-width: 2px;
			}
			.checkbox.checkbox-outline>span {
				border-color: #ffffff;
			}

			.btn {
				color: #ffffff;
			}
			.text-white-muted
			{
				color: #ffffffb5
			}

			@media (min-width: 992px) and (max-width: 1399.98px)
			{
				.login.login-2 .login-aside {
					width: 100%;
					max-width: 100%;
				}
			}
			
			@media (min-height: 700px) and (max-height: 768px)
			{
				.mtcss
				{
					padding-top:30px !important;
				}
			}
			@media (min-height: 900px) and (max-height: 1050px)
			{
				.mtcss
				{
					padding-top:100px !important;
				}
			}
			
			@media (min-height: 1051px) and (max-height: 1200px)
			{
				.mtcss
				{
					padding-top:160px !important;
				}
			}
			
			
		</style>
		
	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading align-middle">
		<?php
				
			if($this->session->userdata('toastrSuccess'))
			{
		?>
				<div id="toast-container" class="toast-top-right">
					<div class="toast toast-success" aria-live="polite" style="">
						<div class="toast-message"><?php echo $this->session->userdata('toastrSuccess'); ?></div>
					</div>
				</div>
		<?php			
				$this->session->unset_userdata('toastrSuccess');
			}
			else if($this->session->userdata('toastrWarning'))
			{
		?>
				<div id="toast-container" class="toast-top-right">
					<div class="toast toast-warning" aria-live="polite" style="">
						<div class="toast-message"><?php echo $this->session->userdata('toastrWarning'); ?></div>
					</div>
				</div>
		<?php		
				$this->session->unset_userdata('toastrWarning');
			}
			else if($this->session->userdata('toastrError'))
			{
		?>
				<div id="toast-container" class="toast-top-right">
					<div class="toast toast-error" aria-live="assertive" style="">
						<div class="toast-message"><?php echo $this->session->userdata('toastrError'); ?></div>
					</div>
				</div>
		<?php	
				$this->session->unset_userdata('toastrError');
			}
			
		?>
		<div class="d-flex flex-column flex-root">
			<div class="row">
				<div class="col-xl-4 col-lg-3 col-md-3 col-sm-6">
				</div>
				<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 mtcss">
					<div class="rounded-xl card card-custom login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white mt-10 bg-brand" id="kt_login">
						<div class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
							<div class="d-flex flex-row-fluid flex-column justify-content-between">
								<div class="d-flex flex-column-fluid flex-column flex-center mt-10 mt-lg-0">
									<a href="<?= base_url() ?>" class="mb-5 text-center">
										<img src="<?= base_url() ?>assetsbackoffice/uploads/logo/Primary_Logo_White.png" class="max-h-120px" alt="" />
									</a>
									<!--<h5 class="font-weight-bold mb-10 text-center">Welcome, to Rothe Erde India Pvt. Ltd. Intranet Application</h5>-->
									<h5 class="font-weight-bold mb-5 text-center text-white">Welcome, to REI Intranet Application</h5>
									<div class="login-form login-signin">
										<div class="text-center mb-5 mb-lg-5">
											<h3 class="font-weight-bold text-white">Sign In</h3>
											<p class="font-weight-bold text-white-muted">Enter your 8 ID and password</p>
										</div>
										<form class="form" method="post" action="<?php echo site_url('login/authenticateUser'); ?>" >
										<!--<form class="form" method="post" action="<?php echo site_url('login/authenticateUserByUsingLDAP'); ?>" >--> <!-- With LDAP -->
											<div class="form-group py-3 m-0">
												<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Email" placeholder="8 ID" name="txtUserName" autocomplete="off" required />
											</div>
											<div class="form-group py-3 border-top m-0">
												<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="Password" name="txtPassword" required/>
											</div>
											<div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
												<!--<div class="checkbox-inline">
													<label class="checkbox checkbox-outline m-0 text-white">
													<input type="checkbox" name="remember" />
													<span></span>Remember me</label>
												</div>-->
												<!--
												<a href="<?php echo base_url('assetsbackoffice/forgotPassword.php'); ?>" class="text-muted text-hover-primary">Forgot Password ?</a>-->
											</div>
											<div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-n10">
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
								<div class="d-flex flex-column-auto justify-content-between mt-0">
									<div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">
										<span class="font-weight-bold mr-2 text-white-muted">Copyright @<?php echo  date("Y");?></span>
										<a href="<?= base_url() ?>" target="_blank" class="text-white text-hover-dark">
											thyssenkrupp
										</a> 
										<span class="font-weight-bold mr-2 text-white-muted">All Rights Reserved.</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-3 col-md-3 col-sm-6">
				</div>
				<!--<div class="col-md-12">
					<div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2 text-center">
						<span class="text-muted font-weight-bold mr-2">Copyright <?php echo  date("Y");?></span>
						<a href="<?= base_url() ?>" target="_blank" class="text-dark-75 text-hover-primary">
							thyssenkrupp
						</a> 
						<span class="text-muted font-weight-bold mr-2">All Rights Reserved.</span>
					</div>
				</div>	-->					
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