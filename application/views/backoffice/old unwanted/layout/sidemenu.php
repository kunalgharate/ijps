	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading" >
		<!-- Mobile Header Start -->
		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
			<a href="<?php echo site_url(BACKOFFICE.'dashboard/DashboardController'); ?>">
				<img alt="Logo" src="<?php echo base_url('assetsbackoffice/images/purvalogo.png'); ?>" />
			</a>
			<!-- Toolbar Start assetsbackoffice//img/mainLogo.png-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon " id="kt_aside_mobile_toggle">
					<span></span>
				</button>
			</div>
			<!-- Toolbar End -->
		</div>
		<!-- Mobile Header End -->
		<div class="d-flex flex-column flex-root">
			<!-- Page Start -->
			<div class="d-flex flex-row flex-column-fluid page">
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
				<!-- Left Menu Start -->
				<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
					<div class="brand flex-column-auto" id="kt_brand">
						<a href="<?php echo site_url(BACKOFFICE.'dashboard/DashboardController'); ?>" class="brand-logo">
							<img alt="Logo" src="<?php echo base_url('assetsbackoffice/images/purvalogo.png'); ?>" height="55px"/>
						</a>
						<!-- Toggle Buttom Minimize Side Menu start-->
						<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
										<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
									</g>
								</svg>
							</span>
						</button>
						<!-- Toggle Buttom Minimize Side Menu end-->
					</div>
					
					<!-- Menu start-->
					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
							<ul class="menu-nav">
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url(BACKOFFICE.'dashboard'); ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fa fa-th-large text-white"></i>
										</span>
										<span class="menu-text">Dashboard</span>
									</a>
								</li>
								<!--
                                <li class="menu-section">
									<h4 class="menu-text">Admin Menu</h4>
									<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<rect fill="#000000" opacity="0.3" x="2" y="2" width="20" height="20" rx="10"/>
													<path d="M6.16794971,14.5547002 C5.86159725,14.0951715 5.98577112,13.4743022 6.4452998,13.1679497 C6.90482849,12.8615972 7.52569784,12.9857711 7.83205029,13.4452998 C8.9890854,15.1808525 10.3543313,16 12,16 C13.6456687,16 15.0109146,15.1808525 16.1679497,13.4452998 C16.4743022,12.9857711 17.0951715,12.8615972 17.5547002,13.1679497 C18.0142289,13.4743022 18.1384028,14.0951715 17.8320503,14.5547002 C16.3224187,16.8191475 14.3543313,18 12,18 C9.64566871,18 7.67758127,16.8191475 6.16794971,14.5547002 Z" fill="#000000"/>
												</g>
											</svg>
										</span>
										<span class="menu-text"> Happy Stories</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">	
											<li class="menu-item" aria-haspopup="true">
												<a href="<?php echo site_url(BACKOFFICE.'happyStory'); ?>" class="menu-link">
													<i class="menu-bullet menu-bullet-dot"><span></span></i>
													<span class="menu-text">Add New Happy Story</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_HAPPY_STORIES; ?>" class="menu-link">
													<i class="menu-bullet menu-bullet-dot"><span></span></i>
													<span class="menu-text">All Happy Stories</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"/>
													<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
													<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
												</g>
											</svg>
										</span>
										<span class="menu-text"> Members</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item" aria-haspopup="true">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_PROFILES; ?>" class="menu-link">
													<i class="menu-bullet menu-bullet-dot"><span></span></i>
													<span class="menu-text">All Members</span>
												</a>
											</li>
											<li class="menu-item" aria-haspopup="true">
												<a href="<?php echo site_url(BACKOFFICE.'profile/searchProfiles'); ?>" class="menu-link">
													<i class="menu-bullet menu-bullet-dot"><span></span></i>
													<span class="menu-text">See Members (With Filters)</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url(BACKOFFICE.'dashboard/DashboardController'); ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
													<path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
												</g>
											</svg>
										</span>
										<span class="menu-text">See Payments</span>
									</a>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url(BACKOFFICE.'dashboard/DashboardController'); ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"/>
													<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"/>
												</g>
											</svg>
										</span>
										<span class="menu-text">Contact Requests</span>
									</a>
								</li>
                                <li class="menu-section">
									<h4 class="menu-text">OTHER</h4>
									<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url(BACKOFFICE.'LoginController/signOut'); ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M7.62302337,5.30262097 C8.08508802,5.000107 8.70490146,5.12944838 9.00741543,5.59151303 C9.3099294,6.05357769 9.18058801,6.67339112 8.71852336,6.97590509 C7.03468892,8.07831239 6,9.95030239 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,9.99549229 17.0108275,8.15969002 15.3875704,7.04698597 C14.9320347,6.73472706 14.8158858,6.11230651 15.1281448,5.65677076 C15.4404037,5.20123501 16.0628242,5.08508618 16.51836,5.39734508 C18.6800181,6.87911023 20,9.32886071 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,9.26852332 5.38056879,6.77075716 7.62302337,5.30262097 Z" fill="#000000" fill-rule="nonzero"/>
													<rect fill="#000000" opacity="0.3" x="11" y="3" width="2" height="10" rx="1"/>
												</g>
											</svg>
										</span>
										<span class="menu-text">Logout</span>
									</a>
								</li>
								
								-->
								
							
								<li class="menu-section">
									<h4 class="menu-text">Main Menu</h4>
									<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_BUS_REQUESTS; ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-bus-alt text-white"></i>
										</span>
										<span class="menu-text">Bus requests</span>
									</a>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_CAB_REQUESTS; ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fa fa-taxi text-white"></i>
										</span>
										<span class="menu-text">Cab requests</span>
									</a>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_FLIGHT_REQUESTS; ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-plane text-white"></i>
										</span>
										<span class="menu-text">Flight requests</span>
									</a>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_FOREX_REQUESTS; ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-exchange-alt text-white"></i>
										</span>
										<span class="menu-text">Forex requests</span>
									</a>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_HOTEL_REQUESTS; ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-hotel text-white"></i>
										</span>
										<span class="menu-text">Hotel requests</span>
									</a>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_TRAIN_REQUESTS; ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-train text-white"></i>
										</span>
										<span class="menu-text">Train requests</span>
									</a>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_VISA_REQUESTS; ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fab la-cc-visa text-white"></i>
										</span>
										<span class="menu-text">Visa requests</span>
									</a>
								</li>
								<li class="menu-section">
									<h4 class="menu-text">Masters</h4>
									<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fa fa-building text-white"></i>
										</span>
										<span class="menu-text">Companies</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_COMPANIES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage companies</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'company'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new company</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fa fa-user text-white"></i>
										</span>
										<span class="menu-text">Employees</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_EMPLOYEES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage employees</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'employee'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new employee</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fa fa-flag text-white"></i>
										</span>
										<span class="menu-text">Departments</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_DEPARTMENTS; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage departments</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'department'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new department</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fa fa-flag text-white"></i>
										</span>
										<span class="menu-text">Countries</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_COUNTRIES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage countries</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'country'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new country</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-city text-white"></i>
										</span>
										<span class="menu-text">States</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_STATES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage states</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'state'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new state</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-city text-white"></i>
										</span>
										<span class="menu-text">Cities</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_CITIES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage cities</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'city'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new city</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-money-bill text-white"></i>
										</span>
										<span class="menu-text">Currencies</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_CURRENCIES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage currencies</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'currency'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new currency</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fa fa-taxi text-white"></i>
										</span>
										<span class="menu-text">Cab Types</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_CABTYPES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage cab types</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'cabtype'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new cab type</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fab la-cc-visa text-white"></i>
										</span>
										<span class="menu-text">Visa Types</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_VISA_TYPES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage visa types</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'visatype'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new visa type</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-train text-white"></i>
										</span>
										<span class="menu-text">Train Classes</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_TRAINCLASSES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage train classes</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'trainclass'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new train class</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-bus-alt text-white"></i>
										</span>
										<span class="menu-text">Bus Classes</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_BUSCLASSES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage bus classes</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'busclass'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new bus class</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-plane text-white"></i>
										</span>
										<span class="menu-text">Flight Classes</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_FLIGHTCLASSES; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage flight classes</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'flightclass'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new flight class</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-plane text-white"></i>
										</span>
										<span class="menu-text">Flights</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_FLIGHTS; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage flights</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'flight'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new flight</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-train text-white"></i>
										</span>
										<span class="menu-text">Trains</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_TRAINS; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage trains</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'train'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new train</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-plane text-white"></i>
										</span>
										<span class="menu-text">Airports</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_AIRPORTS; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage airports</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'airport'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new airport</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">
										<span class="svg-icon menu-icon">
											<i class="fas fa-train text-white"></i>
										</span>
										<span class="menu-text">Railway Stations</span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu" kt-hidden-height="200" style="overflow: hidden;">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url().BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS; ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Manage railway stations</span>
												</a>
											</li>
											<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
												<a href="<?php echo site_url(BACKOFFICE.'railwaystation'); ?>" class="menu-link menu-toggle">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text">Add new railway station</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								
								<li class="menu-section">
									<h4 class="menu-text">Reports</h4>
									<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
								</li>
								<li class="menu-item" aria-haspopup="true">
									<!--<a href="#" class="menu-link">-->
									<a href="<?php echo site_url(BACKOFFICE.'customReport/seeCustomReport'); ?>" class="menu-link">
										<span class="svg-icon menu-icon">
											<i class="fas fa-file text-white"></i>
										</span>
										<span class="menu-text">Custom Report</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- Menu end -->
				</div>
				<!-- Left Menu Start -->
				
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<div id="kt_header" class="header header-fixed">
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!-- Header Menu Start -->
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
							</div>
							<div class="topbar">
								<div class="topbar-item">
									<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
										<span class="text-white font-weight-bold font-size-base d-none d-md-inline mr-1">Hello,</span>
										<span class="text-white font-weight-bolder font-size-base d-none d-md-inline mr-3">
											<?php echo $this->session->userdata('adminuserFullName'); ?>
										</span>
										<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
											<!--<span class="symbol-label font-size-h5 font-weight-bold">SA</span>-->
											<img alt="Profile photo" src="<?php echo base_url('assetsbackoffice/images/profile/'.$this->session->userdata('adminprofilePhoto').''); ?>" />
										</span>
									</div>
								</div>
							</div>
							<!-- Header Menu Start -->
						</div>
					</div>
					