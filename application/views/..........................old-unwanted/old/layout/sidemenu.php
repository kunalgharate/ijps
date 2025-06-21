
		<style>
			@media (min-width: 992px)
			{
				.header {
					background-color: #ffffff;
				}
			}
			.shadow-box
			{
				box-shadow: 0 0 30px 0 rgb(82 63 105 / 1%) !important;
				border: 1px #8080804d solid!important;
			}
			
			.shadow-box-header
			{
				box-shadow: 0 0 40px 0 rgb(82 63 105 / 10%) !important
			}
			
			@media (min-width: 992px)
			{
				.header-fixed .header {
					box-shadow: 0 0 40px 0 rgb(82 63 105 / 10%) !important;
				}
				
			}
		</style>
	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed page-loading bg-white1 unselectable" oncontextmenu="return false;">
		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
			<a href="<?php echo site_url('dashboard/DashboardController'); ?>">
				<img alt="Logo" src="<?php echo base_url('assetsbackoffice/uploads/logo/mainLogo.png'); ?>" />
			</a>
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<!--begin::Header Menu Mobile Toggle-->
				<button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<!--end::Header Menu Mobile Toggle-->
				<!--begin::Topbar Mobile Toggle-->
				<button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
				<!--end::Topbar Mobile Toggle-->
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
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
				
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header header-fixed">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between shadow-box-header">
							<!--begin::Header Menu Wrapper-->
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
								<!--begin::Header Logo-->
								<div class="header-logo">
									<a href="<?php echo site_url('dashboard'); ?>" class="brand-logo">
										<img alt="Logo" src="<?php echo base_url('assetsbackoffice/uploads/logo/mainLogo-white.png'); ?>" height="50px"/>
									</a>
								</div>
								<!--end::Header Logo-->
								<!--begin::Header Menu-->
								<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default ">
									<!--begin::Header Nav-->
									<ul class="menu-nav">
										<li class="menu-item menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="<?php echo site_url('dashboard'); ?>" class="menu-link">
												<span class="menu-text">Home</span>
											</a>
										</li>
										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">About Company</span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left">
												<ul class="menu-subnav">
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo site_url('aboutUS'); ?>" class="menu-link">
															<i class="menu-bullet menu-bullet-dot">
																<span></span>
															</i>
															<span class="menu-text">About us</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo site_url('historyOfCompany'); ?>" class="menu-link">
															<i class="menu-bullet menu-bullet-dot">
																<span></span>
															</i>
															<span class="menu-text">History Of Company</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo site_url('loadCompanyVideos'); ?>" class="menu-link">
															<i class="menu-bullet menu-bullet-dot">
																<span></span>
															</i>
															<span class="menu-text">Company Video's</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										<li class="menu-item menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="<?php echo site_url('jobs'); ?>" class="menu-link">
												<span class="menu-text">Job's</span>
												
											</a>
										</li>
										<!--<li class="menu-item menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="<?php echo site_url('news'); ?>" class="menu-link">
												<span class="menu-text">News</span>
												<i class="menu-arrow"></i>
											</a>
										</li>
										<li class="menu-item menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="<?php echo site_url('circulars'); ?>" class="menu-link">
												<span class="menu-text">Circulars</span>
												<i class="menu-arrow"></i>
											</a>
										</li>
										<li class="menu-item menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="<?php echo site_url('policies'); ?>" class="menu-link">
												<span class="menu-text">Policies</span>
												<i class="menu-arrow"></i>
											</a>
										</li>
										<li class="menu-item menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="<?php echo site_url('dashboard/#ImportantLinks'); ?>" class="menu-link">
												<span class="menu-text">Important Links</span>
												<i class="menu-arrow"></i>
											</a>
										</li>
										-->
										<li class="menu-item menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="<?php echo site_url('photoGallery'); ?>" class="menu-link">
												<span class="menu-text">Gallery</span>
											</a>
										</li>
										
										<?php
											if($this->session->userdata('userType') == 2)
											{
										?>
										<li class="menu-item menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="<?php echo site_url('employeesContactList'); ?>" class="menu-link">
												<span class="menu-text">Contact List</span>
												
											</a>
										</li>
										<?php
											}
										?>
										<!--
										<li class="menu-item menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="<?php echo site_url('contactUS'); ?>" class="menu-link">
												<span class="menu-text">Contact us</span>
												
											</a>
										</li>-->
										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="menu-text">Others</span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-classic menu-submenu-left" style="width:350px">
												<ul class="menu-subnav">
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo site_url('holidayCalender'); ?>" class="menu-link">
															<i class="menu-bullet menu-bullet-dot">
																<span></span>
															</i>
															<span class="menu-text">Holiday Calender</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo site_url('departmentalInformation'); ?>" class="menu-link">
															<i class="menu-bullet menu-bullet-dot">
																<span></span>
															</i>
															<span class="menu-text">Departmental Information</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo site_url('companyPresentationTemplates'); ?>" class="menu-link">
															<i class="menu-bullet menu-bullet-dot">
																<span></span>
															</i>
															<span class="menu-text">Company Presentation Templates</span>
														</a>
													</li>
													<li class="menu-item" aria-haspopup="true">
														<a href="<?php echo site_url('organizationChart'); ?>" class="menu-link">
															<i class="menu-bullet menu-bullet-dot">
																<span></span>
															</i>
															<span class="menu-text">Organization Chart</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
										
										<?php
										/*
										<li class="menu-item menu-item-submenu" data-menu-toggle="click" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<!--<span class="symbol symbol-20">
													<i class="fa fa-birthday-cake text-white" aria-hidden="true"></i>
												</span>-->
												<span class="menu-text">Others</span>
												<i class="menu-arrow"></i>
											</a>
											<div class="menu-submenu menu-submenu-fixed menu-submenu-center mt-2" style="width:1200px">
												<div class="menu-subnav">
													<ul class="menu-content">
														<li class="menu-item">
															<h3 class="menu-heading menu-toggle">
																<i class="menu-bullet menu-bullet-dot">
																	<span></span>
																</i>
																<span class="menu-text">Main Menu</span>
																<i class="menu-arrow"></i>
															</h3>
															<ul class="menu-inner">
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('dashboard'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Home</span>
																	</a>
																</li>
																<!--<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('dashboard/home'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Home New</span>
																	</a>
																</li>-->
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('emergencyContacts'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Emergency Contacts</span>
																	</a>
																</li>
															</ul>
														</li>
														<li class="menu-item">
															<h3 class="menu-heading menu-toggle">
																<i class="menu-bullet menu-bullet-dot">
																	<span></span>
																</i>
																<span class="menu-text">Greetings</span>
																<i class="menu-arrow"></i>
															</h3>
															<ul class="menu-inner">
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('todaysBirthday'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Today’s Birthday</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('upcomingBirthday'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Upcoming Birthdays</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('todaysWorkAnniversaries'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Today’s Work Anniversaries</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('upcomingWorkAnniversaries'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Upcoming Work Anniversaries</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('employeeOfTheMonthYear'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Emp. Of The Month & Year</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('newEmployeeAnnouncement'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">New Employee Announcement</span>
																	</a>
																</li>
															</ul>
														</li>
														<li class="menu-item">
															<h3 class="menu-heading menu-toggle">
																<i class="menu-bullet menu-bullet-dot">
																	<span></span>
																</i>
																<span class="menu-text">HR & Admin </span>
																<i class="menu-arrow"></i>
															</h3>
															<ul class="menu-inner">
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('safetyInstructions'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Safety Instructions</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('events'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Events</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('alerts'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Alerts</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('trainings'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Trainings</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('HRcommunicationsAndUpdates'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">HR Commu. And Updates</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('CSR'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">CSR</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('handbook'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Handbook</span>
																	</a>
																</li>
															</ul>
														</li>
														<li class="menu-item">
															<h3 class="menu-heading menu-toggle">
																<i class="menu-bullet menu-bullet-dot">
																	<span></span>
																</i>
																<span class="menu-text">Other</span>
																<i class="menu-arrow"></i>
															</h3>
															<ul class="menu-inner">
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('holidayCalender'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Holiday Calender</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('departmentalInformation'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Departmental Information</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('companyPresentationTemplates'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Company Presentation Templates</span>
																	</a>
																</li>
																<li class="menu-item" aria-haspopup="true">
																	<a href="<?php echo site_url('organizationChart'); ?>" class="menu-link">
																		<i class="menu-bullet menu-bullet-dot">
																			<span></span>
																		</i>
																		<span class="menu-text">Organization Chart</span>
																	</a>
																</li>
															</ul>
														</li>
													</ul>
												</div>
											</div>
										</li>
										*/
										?>
									</ul>
									<!--end::Header Nav-->
								</div>
								<!--end::Header Menu-->
							</div>
							<!--end::Header Menu Wrapper-->
							<!--begin::Topbar-->
							<div class="topbar">
								<!--begin::Notifications-->
								<div class="dropdown">
									<!--begin::Toggle-->
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										
										<div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-white">
											<span class="svg-icon svg-icon-xl svg-icon-white">
												<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
														<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
											<span class="pulse-ring"></span>
										</div>
									</div>
									
									<!--end::Toggle-->
									<!--begin::Dropdown-->
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<form>
											<!--begin::Header-->
											<div class="d-flex flex-column pt-10 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(../../../theme/html/demo1/dist/assets/media/misc/bg-1.jpg)">
												<!--begin::Title-->
												<h5 class="d-flex flex-center rounded-top">
													<span class="mr-2">Notifications</span>
													
													<!--<span class="btn btn-text text-white bg-brand btn-sm font-weight-bold btn-font-md ml-2">
														<?php 
															//$notificationResult = $this->session->userdata('notificationResult');
															$notificationResult = $notifications;
															echo count($notificationResult); ?> new
													</span>-->
												</h5>
												<!--end::Title-->
											</div>
											<!--end::Header-->
											<!--begin::Content-->
											<div class="tab-content">
												<!--begin::Tabpane-->
												<div class="tab-pane active show" id="topbar_notifications_events" role="tabpanel">
													<!--begin::Nav-->
													<div class="navi navi-hover scroll my-4" data-scroll="true" data-height="500" data-mobile-height="200">
														<?php
															$notificationResult = $notifications;
															//print_r($notificationResult);
															for($i='0'; $i<count($notificationResult);$i++)
															{
																if($notificationResult[$i]['url']!="")
																{
														?>
														
																<!--begin::Item-->
																<a href="<?php echo site_url().$notificationResult[$i]['url']; ?>" class="navi-item">
																	<div class="navi-link">
																		<div class="navi-icon mr-2">
																			<i class="fa fa-chevron-right text-primary"></i>
																		</div>
																		<div class="navi-text">
																			<div class="font-weight-bold">
																				<?php echo $notificationResult[$i]['description']; ?>
																			</div>
																			<?php
																			/*
																				$todayDate = strtotime(date("d-m-Y h:m:s"));
																				
																				$createdDate = strtotime(date('d-m-Y h:m:s', strtotime($notificationResult[$i]['createdDate'])));
																				//strtotime(date("d-m-Y h:i:s", $notificationResult[$i]['createdDate']));
																				//$createdDate = date("d-m-Y", $‎createdDate);
																				
																				$difference = abs($createdDate - $todayDate)/3600;
																				
																				if($difference < 1)
																				{
																					$difference = round(abs($createdDate - $todayDate)/60,0);
																					$difference = $difference." minutes";
																				}
																				else if($difference > 24)
																				{
																					$difference = abs($createdDate - $todayDate)/(60*60*24);
																					$difference = round($difference)." days";
																				}
																				else
																				{
																					$difference = round($difference)." hrs";
																				}
																			*/
																			?>
																			<!--<div class="text-muted"><?php echo $difference; ?> ago</div>-->
																			<div class="text-muted"><?php echo get_time_ago(strtotime(date('d-m-Y h:m:s', strtotime($notificationResult[$i]['createdDate'])))); ?> ago</div>
																		</div>
																	</div>
																</a>
																<!--end::Item-->
																
														<?php
																}
															}
														?>
													</div>
													<!--end::Nav-->
												</div>
												<!--end::Tabpane-->
											</div>
											<!--end::Content-->
										</form>
									</div>
									<!--end::Dropdown-->
								</div>
								<!--end::Notifications-->
								<!--begin::User-->

								<div class="topbar-item">
									<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
										<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
											<!--<span class="symbol-label font-size-h5 font-weight-bold">SA</span>-->
											<img alt="Profile photo" src="<?php echo base_url('assetsbackoffice/uploads/employee/'.$this->session->userdata('employeeProfilePhoto').''); ?>" />
										</span>
									</div>
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->