		<?php 
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu');
		?>
		<!--Main Content Start-->
		<style>
		    @media (max-width: 991.98px)
		    {
            .dash {
                max-width: none;
                padding: 80px 15px;
                vertical-align: middle;
            }
		    }
		</style>
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Contact US </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Contact Us</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="d-flex align-items-center">
					</div>
				</div>
			</div>
			<!-- page heading end-->
			<div class="d-flex flex-row-fluid bgi-size-cover bgi-position-center mb-8 mt-n6 firstSection" style="background-image: url('<?php echo base_url('assetsbackoffice//img/contactUs1.png'); ?>')">
				<div class="container">
					<div class="d-flex justify-content-between align-items-center border-white py-7">
					</div>
					<div class="d-flex align-items-stretch text-center flex-column py-40">
						<h1 class="text-dark font-weight-bolder mb-12"></h1>
					</div>
				</div>
			</div>
			<div class="d-flex flex-column-fluid mt-n20 firstSection">
				<div class="container">
					<div class="content pt-0 d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="container py-8">
							<div class="row">
								<div class="col-lg-4">
									<div class="card shadow-box card-custom wave wave-animate-slow wave-primary mb-8 mb-lg-0">
										<div class="card-body p-4">
											<div class="d-flex align-items-center p-5">
												<div class="mr-3">
													<i class="fas fa-envelope text-primary svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
												</div>
												<div class="d-flex flex-column">
													<a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Email</a>
													<div class="text-dark-75">contact@rotheerde.com</div>
													<div class="text-dark-75">hr@rotheerde.com</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="card shadow-box card-custom wave wave-animate-slow wave-danger mb-8 mb-lg-0">
										<div class="card-body p-4">
											<div class="d-flex align-items-center p-5">
												<div class="mr-3">
													<i class="fas fa-map-marker-alt text-primary svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
												</div>
												<div class="d-flex flex-column">
													<a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Address</a>
													<div class="text-dark-75">Gat No 429, Gonde, Wadivarhe Village, Igatpuri-422403.</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="card shadow-box card-custom wave wave-animate-slow wave-success mb-8 mb-lg-0">
										<div class="card-body p-4">
											<div class="d-flex align-items-center p-5">
												<div class="mr-3">
													<i class="fas fa-phone-alt text-primary svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
												</div>
												<div class="d-flex flex-column">
													<a class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Contact Number</a>
													<div class="text-dark-75">+91 (25 53) 30 22 31 </div>
													<div class="text-dark-75">+91 (25 53) 67 22 31</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--end::Section-->
						<!--begin::Section-->
						<div class="container mb-8">
							<div class="card shadow-box">
								<div class="card-body p-0">
									<div class="p-0">
										<div class="row">
											<div class="col-lg-6">
												<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15014.236620642901!2d73.6661793!3d19.8162803!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bdd91cf8830c393%3A0xcb0d034a9ffbea0c!2sRothe%20Erde%20India%20Pvt.%20Ltd!5e0!3m2!1sen!2sin!4v1675019010204!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
											</div>
											<div class="col-lg-6">
												<form method="post" action="<?php echo site_url('contactUSSubmit'); ?>" enctype="multipart/form-data" onload ="test();">
													<div class="card-body">
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
																	<label>First Name
																	<span class="text-danger">*</span></label>
																	<div class="custom-file">
																		<input class="form-control" type="text" name="txtFirstName" value="" required>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label>Last Name
																	<span class="text-danger">*</span></label>
																	<div class="custom-file">
																		<input class="form-control" type="text" name="txtLastName" value="" required>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label>Email
																	<span class="text-danger">*</span></label>
																	<div class="custom-file">
																		<input class="form-control" type="email" name="txtEmail" value="" required>
																	</div>
																</div>
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label>Contact Number
																	<span class="text-danger">*</span></label>
																	<div class="custom-file">
																		<input class="form-control" type="number" name="txtContactNumber" value="" required>
																	</div>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group">
																	<label>Subject
																	<span class="text-danger">*</span></label>
																	<div class="custom-file">
																		<input class="form-control" type="text" name="txtSubject" value="" required>
																	</div>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group">
																	<label>Message
																	<span class="text-danger">*</span></label>
																	<div class="custom-file">
																		<textarea class="form-control" name="txtMessage" rows="6" required></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-12">
																<button type="submit" class="btn btn-primary mr-2">Send</button>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>