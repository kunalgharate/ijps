<?php 
	$this->load->view('layout/header');
?>
<?php 
	$this->load->view('layout/menu');
?>
							<section class="slice--offset parallax-section parallax-section-lg" style="background-image: url(<?php echo base_url('assets/uploads/home_page/premium_plans_image/banner3.jpg'); ?>)">
								<div class="container">	
									<div class="row align-items-center">
										<div class="col">
											<div class="d-none d-lg-block">
												<h1 class="h2 text-white">Contact us</h1>
											</div>
											<!-- Breadcrumb -->
											<nav aria-label="breadcrumb text-white">
												<ol class="breadcrumb breadcrumb-light mb-0">
													<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="<?php echo site_url('home'); ?>">Home</a></li>
													<li class="breadcrumb-item active" aria-current="page">Contact us</li>
												</ol>
											</nav>
											<!-- End Breadcrumb -->
										</div>
										<!-- End Col -->
									</div>
								</div>
							</section>
							
							<section class="parallax-section-lg">
								<div class="container">
									<div class="row">
										<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
											<div class="block block--style-1">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="card-body text-center">
														<div class="mb-3 heading-2">
															<i class="fa fa-map-marker"></i>
														</div>
														<h3 class="heading heading-5 premium_heading">Office Address</h3>
														<p><a href="#" class="text-dark">Nashik, Maharashtra</a></p>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
											<div class="block block--style-1">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="card-body text-center">
														<div class="mb-3 heading-2">
															<i class="fa fa-phone"></i>
														</div>
														<h3 class="heading heading-5 premium_heading">Contact</h3>
														<p><a href="tel:+918888888888" class="text-dark">+91 8888 888 888</a></p>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
											<div class="block block--style-1">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="card-body text-center">
														<div class="mb-3 heading-2">
															<i class="fa fa-envelope"></i>
														</div>
														<h3 class="heading heading-5 premium_heading">Email ID</h3>
														<p><a href="mailto:contact@antarpatweddings.com" class="text-dark">contact@antarpatweddings.com</a></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

							<section class="slice">
								<div class="container">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="block block--style-1">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="card-body text-center">
														<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119981.38704996691!2d73.73344035729528!3d19.99094929628815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bddd290b09914b3%3A0xcb07845d9d28215c!2sNashik%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1681307583591!5m2!1sen!2sin" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="block block--style-1">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="card-body">
														<div class="section-title section-title--style-1 text-left m-0">
															<h3 class="section-title-inner">
																<span>Send us a message</span>
															</h3>
															<p>We are here for you...</p>
														</div>
														<form class="form-default" role="form" method="POST" action="#">
															<div class="row">
																<div class="col-md-12">
																	<div class="form-group">
																		<label for="">Full Name</label>
																		<input type="text" name="name" class="form-control form-control-md" required="" value="">
																	</div>
																</div>
															</div>

															<div class="row">
																<div class="col-md-6">
																	<div class="form-group has-feedback">
																		<label for="">Email</label>
																		<input type="email" name="email" class="form-control form-control-md" required="" value="">
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group has-feedback">
																		<label for="">Contact Number</label>
																		<input type="text" name="subject" class="form-control form-control-md" required="" value="">
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-sm-12">
																	<div class="form-group has-feedback">
																		<label for="">Subject</label>
																		<input type="text" name="subject" class="form-control form-control-md" required="" value="">
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<div class="form-group has-feedback">
																		<label for="">Message </label>
																		<textarea name="message" class="form-control no-resize" rows="5" required="" maxlength="300"></textarea>
																	</div>
																</div>
															</div>
															<div class="mt-2 col-12">
															</div>
															<div class="">
																<button type="submit" class="btn btn-styled btn-base-1 mt-4 btn-block">Send...</button>
															</div>
														</form>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>

<?php 
	$this->load->view('layout/footer');
?>
<?php 
	$this->load->view('layout/jsfiles');
?>