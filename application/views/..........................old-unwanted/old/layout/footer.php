					<!-- Footer Start -->
					<div class="footer bg-white py-0 d-flex flex-lg-column" id="kt_footer">
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<div class="text-dark order-2 order-md-1 font-size-sm">
								<span class="text-muted font-weight-bold mr-2">Copyright @<?php echo  date("Y");?></span>
								<a href="<?php echo site_url(); ?>" target="_blank" class="text-dark-75 text-hover-primary">
								    thyssenkrupp
								</a> 
								<span class="text-muted font-weight-bold mr-2">All Rights Reserved.</span>
							</div>
							<div class="nav nav-dark">
								<a href="<?php echo site_url('dashboard'); ?>" class="nav-link pl-0 pr-5">Home</a>
								<a href="<?php echo site_url('aboutUS'); ?>" class="nav-link pl-0 pr-5">About us</a>
								<a href="<?php echo site_url('contactUS'); ?>" class="nav-link pl-0 pr-0">Contact us</a>
							</div>
						</div>
					</div>
					<!-- Footer End -->
				</div>
			</div>
			<!-- Page end -->
		</div>
		
		<!-- User Profile Panel Start -->
		<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
				<h3 class="font-weight-bold m-0">User Profile 
				<small class="text-muted font-size-sm ml-2"></small></h3>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<div class="offcanvas-content pr-5 mr-n5">
				<div class="d-flex align-items-center mt-5">
					<div class="symbol symbol-100 mr-5">
						<div class="symbol-label" style="background-image:url('<?php echo base_url('assetsbackoffice/uploads/employee/'.$this->session->userdata('employeeProfilePhoto').''); ?>')">
						</div>
						<i class="symbol-badge bg-success"></i>
					</div>
					<div class="d-flex flex-column">
						<a href="<?php echo site_url(BACKOFFICE.'user/UserController'); ?>" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
							<?php echo $this->session->userdata('employeeFullName'); ?>
						</a>
						<div class="text-muted mt-1">
					 
						</div>
						<div class="navi mt-2">
							<a class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-icon mr-1">
										<span class="svg-icon svg-icon-lg svg-icon-primary">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
													<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
												</g>
											</svg>
										</span>
									</span>
									<span class="navi-text text-muted text-hover-primary"><?php echo $this->session->userdata('employeeMailID'); ?></span>
								</span>
							</a>
							<a href="<?php echo site_url('login/signOut'); ?>" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
						</div>
					</div>
				</div>
				<div class="separator separator-dashed mt-8 mb-5"></div>
				<div class="navi navi-spacer-x-0 p-0">
					<!--<a href="<?php echo site_url(BACKOFFICE.'user/UserController'); ?>" class="navi-item">-->
					<!--	<div class="navi-link">-->
					<!--		<div class="symbol symbol-40 bg-light mr-3">-->
					<!--			<div class="symbol-label">-->
					<!--				<span class="svg-icon svg-icon-md svg-icon-success">-->
					<!--					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
					<!--						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
					<!--							<polygon points="0 0 24 0 24 24 0 24"/>-->
					<!--							<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>-->
					<!--							<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>-->
					<!--						</g>-->
					<!--					</svg>-->
					<!--				</span>-->
					<!--			</div>-->
					<!--		</div>-->
							
					<!--		<div class="navi-text">-->
					<!--			<div class="font-weight-bold">My Profile</div>-->
								<!--<div class="text-muted">Account settings and more </div>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</a>-->
					<!--<a href="<?php echo site_url(BACKOFFICE.'user/UserController/changePassword'); ?>" class="navi-item">-->
					<!--	<div class="navi-link">-->
					<!--		<div class="symbol symbol-40 bg-light mr-3">-->
					<!--			<div class="symbol-label">-->
					<!--				<span class="svg-icon svg-icon-md svg-icon-warning">-->
					<!--					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
					<!--						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
					<!--							<mask fill="white">-->
					<!--								<use xlink:href="#path-1"/>-->
					<!--							</mask>-->
					<!--							<g/>-->
					<!--							<path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>-->
					<!--						</g>-->
					<!--					</svg>-->
					<!--				</span>-->
					<!--			</div>-->
					<!--		</div>-->
					<!--		<div class="navi-text">-->
					<!--			<div class="font-weight-bold">Change Password</div>-->
								<!--<div class="text-muted">Inbox and tasks</div>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</a>-->
					<a href="<?php echo site_url('mySizesShow'); ?>" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-primary">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M6.182345,4.09500888 C6.73256296,3.42637697 7.56648864,3 8.5,3 L15.5,3 C16.4330994,3 17.266701,3.42600075 17.8169264,4.09412386 C17.8385143,4.10460774 17.8598828,4.11593789 17.8809917,4.1281251 L22.5900048,6.8468751 C23.0682974,7.12301748 23.2321726,7.73460788 22.9560302,8.21290051 L21.2997802,11.0816097 C21.0236378,11.5599023 20.4120474,11.7237774 19.9337548,11.4476351 L18.5,10.6198563 L18.5,19 C18.5,19.5522847 18.0522847,20 17.5,20 L6.5,20 C5.94771525,20 5.5,19.5522847 5.5,19 L5.5,10.6204852 L4.0673344,11.4476351 C3.58904177,11.7237774 2.97745137,11.5599023 2.70130899,11.0816097 L1.04505899,8.21290051 C0.768916618,7.73460788 0.932791773,7.12301748 1.4110844,6.8468751 L6.12009753,4.1281251 C6.14061376,4.11628005 6.16137525,4.10524462 6.182345,4.09500888 Z" fill="#000000" opacity="0.3"/>
													<path d="M9.85156673,3.2226499 L9.26236944,4.10644584 C9.11517039,4.32724441 9.1661011,4.62457583 9.37839459,4.78379594 L11,6 L10.0353553,12.7525126 C10.0130986,12.9083095 10.0654932,13.0654932 10.1767767,13.1767767 L11.6464466,14.6464466 C11.8417088,14.8417088 12.1582912,14.8417088 12.3535534,14.6464466 L13.8232233,13.1767767 C13.9345068,13.0654932 13.9869014,12.9083095 13.9646447,12.7525126 L13,6 L14.6216054,4.78379594 C14.8338989,4.62457583 14.8848296,4.32724441 14.7376306,4.10644584 L14.1484333,3.2226499 C14.0557004,3.08355057 13.8995847,3 13.7324081,3 L10.2675919,3 C10.1004153,3 9.94429962,3.08355057 9.85156673,3.2226499 Z" fill="#000000"/>
												</g>
										</svg>
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">My Sizes</div>
								<!--<div class="text-muted">latest tasks and projects</div>-->
							</div>
						</div>
					</a>
					<a href="<?php echo site_url('loadCoOperativeSocietyAccBal'); ?>" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-primary">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
												<path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
											</g>
										</svg>
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">Co-Operative Society Acc. Bal.</div>
								<!--<div class="text-muted">latest tasks and projects</div>-->
							</div>
						</div>
					</a>
					<a href="<?php echo site_url('login/signOut'); ?>" class="navi-item">
						<div class="navi-link">
							<div class="symbol symbol-40 bg-light mr-3">
								<div class="symbol-label">
									<span class="svg-icon svg-icon-md svg-icon-primary">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M7.62302337,5.30262097 C8.08508802,5.000107 8.70490146,5.12944838 9.00741543,5.59151303 C9.3099294,6.05357769 9.18058801,6.67339112 8.71852336,6.97590509 C7.03468892,8.07831239 6,9.95030239 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,9.99549229 17.0108275,8.15969002 15.3875704,7.04698597 C14.9320347,6.73472706 14.8158858,6.11230651 15.1281448,5.65677076 C15.4404037,5.20123501 16.0628242,5.08508618 16.51836,5.39734508 C18.6800181,6.87911023 20,9.32886071 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,9.26852332 5.38056879,6.77075716 7.62302337,5.30262097 Z" fill="#000000" fill-rule="nonzero"/>
												<rect fill="#000000" opacity="0.3" x="11" y="3" width="2" height="10" rx="1"/>
											</g>
										</svg>
									</span>
								</div>
							</div>
							<div class="navi-text">
								<div class="font-weight-bold">Logout</div>
								<!--<div class="text-muted">latest tasks and projects</div>-->
							</div>
						</div>
					</a>
				</div>
				<!-- Nav end -->
				<div class="separator separator-dashed my-7"></div>
			</div>
		</div>
		<!-- User Profile Panel End -->

		