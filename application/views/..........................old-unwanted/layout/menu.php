	</head>
	<body>
		<div class="container">
			<div class="row">
				<!-- Alerts for Member actions -->
				<div class="col-lg-3 col-md-4" id="success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
					<div class="alert alert-success fade show" role="alert">
						<!-- Success Alert Content -->
					</div>
				</div>
				<div class="col-lg-3 col-md-4" id="danger_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
					<div class="alert alert-danger fade show" role="alert">
						<!-- Danger Alert Content -->
					</div>
				</div>
				<!-- Alerts for Member actions -->
			</div>
		</div>
		
		<!-- MAIN WRAPPER -->
		<div class="body-wrap">
			<div id="st-container" class="st-container">
				<div class="st-pusher">
					<div class="st-content">
						<div class="st-content-inner">
							<!-- Navbar -->
							<div id="myHeader" class="" style="z-index: 9999">
								<div class="top-navbar align-items-center">
									<div class="container">
										<div class="row align-items-center py-1" style="padding-bottom: 0px !important">
											<div class="col-lg-6 col-md-5 col">
												<nav class="top-navbar-menu" style="margin:0px !important;">
													<ul class="top-menu" style="float: left !important;width: 35%;">
														<li>
														 <a href="tel:+918888888888"><i class="fa fa-phone"></i>+91 8888 888 888</a>
														</li>
													</ul>
													<ul class="top-menu" style="float: left !important;width: 50%;">
														<li>
														 <a href="mailto:contact@antarpatweddings.com"><i class="fa fa-envelope"></i>contact@antarpatweddings.com</a>
														
														</li>
													</ul>
												</nav>
											</div>
											<div class="col-lg-6 col-md-7 col">
												<nav class="top-navbar-menu">
													<ul class="float-right top_bar_right social-media social-media--style-1-v4">
														<?php
															if($this->session->userdata('userType') == 2)
															{
														?>
																<li>
																	<!--<a href="registration.php"><i class="fa fa-user"></i>  Register</a>-->
																	<a href="<?php echo site_url('login/signOut'); ?>">
																		<button type="button" class="btn btn-sm btn-outline-theme" ><i class="fa fa-sign-out"></i> Logout </button>
																	</a>
																</li>
														<?php
															}
															else
															{
														?>
																<li class="border-right">
																	<!--<a href="login.php"><i class="fa fa-lock"></i> Login </a>-->
																	<!--<a class="btn btn-base-1 text-white profilecardBR" href="<?php echo site_url('listing'); ?>"> <i class="fa fa-lock"></i> Login </a>-->
																	<a href="<?php echo site_url('login'); ?>">
																		<button type="button" class="btn btn-sm btn-outline-theme" ><i class="fa fa-lock"></i> Login </button>
																	</a>
																</li>
																<li>
																	<!--<a href="registration.php"><i class="fa fa-user"></i>  Register</a>-->
																	<a href="<?php echo site_url('registration'); ?>">
																		<button type="button" class="btn btn-sm btn-outline-theme" ><i class="fa fa-user"></i> Register </button>
																	</a>
																</li>
														
														<?php
															}
														?>
														
													</ul>
												</nav>
											</div>
										</div>
									</div>
								</div>
								<nav class="navbar navbar-expand-lg navbar-light bg-default navbar--link-arrow navbar--uppercase">
									<div class="container navbar-container">
										<!-- Brand/Logo -->
										<a class="navbar-brand" href="<?php echo site_url(); ?>" style="background-color: white; margin-bottom: -35px; border-radius: 55px; padding: 0px 15px 15px 15px; box-shadow: 0px 10px 10px rgba(0, 0, 10, 0.12);">
											<img src="<?php echo base_url('assets/uploads/header_logo/antarpatweddings-logo.png'); ?>" class="img-responsive" width="200px">
										</a>
										<div class="d-inline-block">
											<!-- Navbar toggler  -->
											<button class="navbar-toggler hamburger hamburger-js hamburger--spring" type="button" data-toggle="collapse" data-target="#navbar_main" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
												<span class="hamburger-box">
													<span class="hamburger-inner"></span>
												</span>
											</button>
										</div>
										<div class="collapse navbar-collapse align-items-center justify-content-end" id="navbar_main">
											<!-- Navbar links -->
											<ul class="navbar-nav mt-2" data-hover="dropdown">
												<li class="custom-nav">
													<a class="nav-link nav_active1" href="<?php echo site_url(); ?>" aria-haspopup="true" aria-expanded="false">
														Home
													</a>
												</li>
												<li class="custom-nav dropdown">
													<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Search
													</a>
													<ul class="dropdown-menu" style="border: 1px solid #f1f1f1 !important;">
														<li>
															<a class="dropdown-item " href="<?php echo site_url('listing'); ?>">
																 <img src="<?php echo base_url('assets/uploads/icons/searchprofile.png'); ?>" class="img-responsive" width="25px"> Search by Profile ID
															</a>
														</li>
														<li>
															<a class="dropdown-item " href="<?php echo site_url('listing'); ?>">
																<img src="<?php echo base_url('assets/uploads/icons/advanceserachprofile.png'); ?>" class="img-responsive" width="25px"> Advance Search
															</a>
														</li>
														<?php
															if(($this->session->userdata('userType') == 2 && $this->session->userdata('genderID') == 1) || (empty($this->session->userdata('userType'))))
															{
														?>
															<li>
																<a class="dropdown-item " href="<?php echo site_url('bride'); ?>">
																	<img src="<?php echo base_url('assets/uploads/icons/bride.png'); ?>" class="img-responsive" width="25px"> Bride
																</a>
															</li>
														<?php
															}
															
															if(($this->session->userdata('userType') == 2 && $this->session->userdata('genderID') == 2) || (empty($this->session->userdata('userType'))))
															{
														?>
															<li>
																<a class="dropdown-item " href="<?php echo site_url('groom'); ?>">
																	<img src="<?php echo base_url('assets/uploads/icons/groom.png'); ?>" class="img-responsive" width="25px"> Groom
																</a>
															</li>
														<?php
															}
															
															if(($this->session->userdata('userType') == 2 && $this->session->userdata('genderID') == 1) || (empty($this->session->userdata('userType'))))
															{
														?>
																<li>
																	<a class="dropdown-item " href="<?php echo site_url('divorced-widowed-bride'); ?>">
																		<img src="<?php echo base_url('assets/uploads/icons/dbride.png'); ?>" class="img-responsive" width="25px"> Divorced/Widowed Bride
																	</a>
																</li>
														<?php
															}
															if(($this->session->userdata('userType') == 2 && $this->session->userdata('genderID') == 2) || (empty($this->session->userdata('userType'))))
															{
														?>
																<li>
																	<a class="dropdown-item " href="<?php echo site_url('divorced-widow-groom'); ?>">
																		<img src="<?php echo base_url('assets/uploads/icons/dgroom.png'); ?>" class="img-responsive" width="25px"> Divorced/Widow Grooms
																	</a>
																</li>
														<?php
															}
														?>
													</ul>
												</li>
												<li class="custom-nav">
													<a class="nav-link" href="<?php echo site_url('horoscope'); ?>" aria-haspopup="true" aria-expanded="false">
														Horoscope Matching
													</a>
												</li>
												<li class="custom-nav">
													<a class="nav-link " href="<?php echo site_url('successstories'); ?>" aria-haspopup="true" aria-expanded="false">
														Success Stories
													</a>
												</li>
												<li class="custom-nav dropdown">
													<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Contact
													</a>
													<ul class="dropdown-menu" style="border: 1px solid #f1f1f1 !important;">
														<li>
															<a class="dropdown-item " href="<?php echo site_url('aboutus'); ?>">
																About us
															</a>
														</li>
														<li>
															<a class="dropdown-item " href="<?php echo site_url('contactus'); ?>">
																Contact us
															</a>
														</li>
													</ul>
												</li>
												
												<?php
													if($this->session->userdata('userType') == 2)
													{
												?>
														<li class="custom-nav dropdown" style="margin-top:-10px !important;">
															<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<!--<i class="fa fa-user"></i>-->
																<img alt="Profile photo" src="<?php echo base_url(UPLOAD_PROFILE.$this->session->userdata('profilePhoto').''); ?>"  style="width:40px; border-radius:25px;"/>
															</a>
															<ul class="dropdown-menu" style="border: 1px solid #f1f1f1 !important;">
																<li>
																	<a class="dropdown-item " href="<?php echo site_url('updateprofile'); ?>">
																		<img src="<?php echo base_url('assets/uploads/icons/user.png'); ?>" class="img-responsive" width="25px"> Update Profile
																	</a>
																</li>
																<li>
																	<a class="dropdown-item " href="<?php echo site_url('listing'); ?>">
																		<img src="<?php echo base_url('assets/uploads/icons/ShortlistedProfiles.png'); ?>" class="img-responsive" width="25px"> Shortlisted Profiles
																	</a>
																</li>
																<li>
																	<a class="dropdown-item " href="<?php echo site_url('listing'); ?>">
																		<img src="<?php echo base_url('assets/uploads/icons/IntrestedProfiles.png'); ?>" class="img-responsive" width="25px"> Intrested Profiles
																	</a>
																</li>
																<li class="custom-nav1 dropdown">
																	<a class="nav-link1 dropdown-item" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<img src="<?php echo base_url('assets/uploads/icons/settings.png'); ?>" class="img-responsive" width="25px"> Settings
																	</a>
																	<ul class="dropdown-menu" style="border: 1px solid #f1f1f1 !important;">
																		<li>
																			<a class="dropdown-item " href="#">
																				<img src="<?php echo base_url('assets/uploads/icons/close.png'); ?>" class="img-responsive" width="25px"> Close Profile
																			</a>
																		</li>
																		<li>
																			<a class="dropdown-item " href="<?php echo site_url('changepassword'); ?>">
																				<img src="<?php echo base_url('assets/uploads/icons/password.png'); ?>" class="img-responsive" width="25px"> Change Password
																			</a>
																		</li>
																	</ul>
																</li>
																<li>
																	<a class="dropdown-item " href="<?php echo site_url('login/signOut'); ?>">
																		<img src="<?php echo base_url('assets/uploads/icons/switch.png'); ?>" class="img-responsive" width="25px"> Logout
																	</a>
																</li>
															</ul>
														</li>
														<li class="custom-nav dropdown">
															<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<img src="<?php echo base_url('assets/uploads/icons/notification.png'); ?>" class="img-responsive" width="25px">
																<span class="badge">3</span>
															</a>
															<ul class="dropdown-menu notification-nav" style="border: 1px solid #f1f1f1 !important;">
																<!--<li>
																	<a class="dropdown-item " href="updateProfile.php">
																		<img src="<?php echo base_url('assets/uploads/profile_image/profile_03.jpg'); ?>" style="width:50px; border-radius:25px;"> 
																		Aman Vivek Pawar (AW000001)
																		<p>Find the flexible ticket on fligh
																		<small>Shortlisted</small></p>
																	</a>
																	<a href="#" class="list-group-item list-group-item-action rounded notif-unread border-0 mb-1 p-3">
																		<h6 class="mb-2">New! Booking flights from New York ✈️</h6>
																		<p class="mb-0 small">Find the flexible ticket on flights around the world. Start searching today</p>
																		<span>Wednesday</span>
																	</a>
																</li>-->
																
																
																<li>
																	<a class="dropdown-item " href="<?php echo site_url('listing'); ?>">
																		<div class="row">
																			<div class="col-2">
																				<img src="<?php echo base_url('assets/uploads/profile_image/profile_03.jpg'); ?>" style="width:50px; border-radius:25px; margin-top:10px;"> 
																			</div>
																			<div class="col-8 p-2">
																				<!--<h6 class="mb-0">Aman Vivek Pawar (AW000001)</h6>
																				<p class="mb-0 small">Profile Shortlisted</p>-->
																				<p class="mb-1 small">Aman Vivek Pawar (AW000001)</p>
																				Profile Shortlisted</br>
																				<small class="mt-2">2 Days Ago</small>
																			</div>
																		</div>
																	</a>
																</li>
																<li>
																	<a class="dropdown-item " href="<?php echo site_url('listing'); ?>">
																		<div class="row">
																			<div class="col-2">
																				<img src="<?php echo base_url('assets/uploads/profile_image/profile_03.jpg'); ?>" style="width:50px; border-radius:25px; margin-top:10px;"> 
																			</div>
																			<div class="col-8 p-2">
																				<!--<h6 class="mb-0">Aman Vivek Pawar (AW000001)</h6>
																				<p class="mb-0 small">Profile Shortlisted</p>-->
																				<p class="mb-1 small">Aman Vivek Pawar (AW000001)</p>
																				Profile Shortlisted</br>
																				<small class="mt-2">2 Days Ago</small>
																			</div>
																		</div>
																	</a>
																</li>
																<li>
																	<a class="dropdown-item " href="<?php echo site_url('listing'); ?>">
																		<div class="row">
																			<div class="col-2">
																				<img src="<?php echo base_url('assets/uploads/profile_image/profile_03.jpg'); ?>" style="width:50px; border-radius:25px; margin-top:10px;"> 
																			</div>
																			<div class="col-8 p-2">
																				<!--<h6 class="mb-0">Aman Vivek Pawar (AW000001)</h6>
																				<p class="mb-0 small">Profile Shortlisted</p>-->
																				<p class="mb-1 small">Aman Vivek Pawar (AW000001)</p>
																				Profile Shortlisted</br>
																				<small class="mt-2">2 Days Ago</small>
																			</div>
																		</div>
																	</a>
																</li>
																
															</ul>
														</li>
												<?php
													}
												?>
											</ul>
										</div>
									</div>
								</nav>
							</div>
							
							