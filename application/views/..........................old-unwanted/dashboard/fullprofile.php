<?php 
	$this->load->view('layout/header');
?>
				<style>
					/* xs */
					.size-sm {
						display: none;
					}
					.size-sm-btn {
						display: block;
					}
					/* sm */
					@media (min-width: 768px) {
						.size-sm {
							display: none;
						}
						.size-sm-btn {
							display: block;
						}
					}
					/* md */
					@media (min-width: 992px) {
						.size-sm {
							display: block;
						}
						.size-sm-btn {
							display: none;
						}
					}
					/* lg */
					@media (min-width: 1200px) {
						.size-sm {
							display: block;
						}
						.size-sm-btn {
							display: none;
						}
					}
				</style>
<?php 
	$this->load->view('layout/menu');
?>							
							<section class="slice--offset parallax-section parallax-section-lg" style="background-image: url(<?php echo base_url('assets/uploads/home_page/premium_plans_image/banner3.jpg'); ?>)">
								<div class="container">	
									<div class="row align-items-center">
										<div class="col">
											<div class="d-none d-lg-block">
												<h1 class="h2 text-white">
													<?php echo $profileResult[0]['profileCode']; ?> |
													<?php echo $profileResult[0]['firstName']." ".$profileResult[0]['middleName']." ".$profileResult[0]['lastName']; ?>
													<?php
														if($profileResult[0]['verifiedFlag'] == '1')
														{
															echo "<img class='verifiedProfileImg' src='".base_url('assets/uploads/icons/verified.png')."' alt='Verified Profile'>";
														}
													?>
												</h1>
											</div>
											<!-- Breadcrumb -->
											<nav aria-label="breadcrumb text-white">
												<ol class="breadcrumb breadcrumb-light mb-0">
													<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="<?php echo site_url('home'); ?>">Home</a></li>
													<li class="breadcrumb-item active" aria-current="page">Profile</li>
												</ol>
											</nav>
											<!-- End Breadcrumb -->
										</div>
										<!-- End Col -->
									</div>
								</div>
							</section>
							<section class="slice sct-color-1">
								<div class="container">
									<div class="row z-depth-2-top z-depth-3--hover p-2 profilecardBR2">
										<!--
										<div class="col-lg-3">
											<input type="hidden" id="member_type" value="">
											<div class="block-wrapper" id="result">          
												<div class="block block--style-3 list z-depth-1-top1">
													<div class="block-image">
														<a onclick="#">
															<div class="listing-image" style="background-image: url(uploads/profile_image/profile_02.jpg)"></div>
														</a>
													</div>
												</div>
											</div>
										</div>
										-->
										<div class="col-lg-3">
											<input type="hidden" id="member_type" value="">
											<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
												<!--
												<ol class="carousel-indicators">
													<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
													<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
													<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
												</ol>
												-->
												<div class="carousel-inner">
													<div class="carousel-item active">
														<img class="d-block w-100 profilecardBR2" src="<?php echo base_url('assets/uploads/profile_image/profile_04.jpg'); ?>" alt="First slide">
													</div>
													<div class="carousel-item">
														<img class="d-block w-100 profilecardBR2" src="<?php echo base_url('assets/uploads/profile_image/profile_02.jpg'); ?>" alt="Second slide">
													</div>
													<div class="carousel-item">
														<img class="d-block w-100 profilecardBR2" src="<?php echo base_url('assets/uploads/profile_image/profile_03.jpg'); ?>" alt="Third slide">
													</div>
												</div>
												<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
													<span class="carousel-control-prev-icon" aria-hidden="true"></span>
													<span class="sr-only">Previous</span>
												</a>
												<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
													<span class="carousel-control-next-icon" aria-hidden="true"></span>
													<span class="sr-only">Next</span>
												</a>
											</div>
										</div>
										<div class="col-lg-9">
											<div class="block-title-wrapper pt-2" style="display:grid;">
												<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
													<a  class="c-base-1">
														<?php echo $profileResult[0]['profileCode']; ?> |</a> 
														<?php echo $profileResult[0]['firstName']." ".$profileResult[0]['middleName']." ".$profileResult[0]['lastName']; ?>
														<?php
															if($profileResult[0]['verifiedFlag'] == '1')
															{
																echo "<img class='verifiedProfileImg' src='".base_url('assets/uploads/icons/verified.png')."' alt='Verified Profile'>";
															}
														?>
												</h3>
												<h4 class="heading heading-xs c-gray-dark">
													<?php echo $profileResult[0]['introduction']; ?>
												</h4>
												<table class="table-striped1 table-bordered1 mb-2" style="font-size: 12px;">
													<tbody>
														<tr style="border-bottom: 1px solid #971a1e; border-top: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Age:</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: <?php echo $profileResult[0]['age']; ?> years</td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Religion</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Hindu</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Caste</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Brahmin</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Mother tongue</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Marathi</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Education</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Graduate, B.A</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Place</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Nashik</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Business</b></td>
															<td colspan="3" height="30" style="padding-left: 5px;" class="font-dark">: Distributor of Fruits and Vegetables in Pune/20,00,000 PA</td>
														</tr>
													</tbody>
												</table>
												<table class="mb-2" style="font-size: 12px;">
													<tbody>
														<tr style="border-bottom: 5px solid #971a1e; border-top: 5px solid #971a1e;vertical-align: middle;">
															<?php 
																$shareText = urlencode($profileResult[0]['profileCode']." | ".$profileResult[0]['firstName']." ".$profileResult[0]['middleName']." ".$profileResult[0]['lastName']." ".$profileResult[0]['introduction']); 
															?>
															<td width="50" height="40" style="padding-left: 5px; text-align:right" class="font-dark">
																<b>Share :  </b>
															</td>
															<td width="40" height="40" style="padding-left: 5px;" class="font-dark">
																<a href="https://api.whatsapp.com/send?text=<?php echo $shareText; ?>" target="_blank" title=""><i class="fa fa-whatsapp text-dark heading-4"></i></a>
															</td>
															<td width="100" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Shortlist : </b></td>
															<td width="100" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-star-o text-dark heading-4"></i></a></td>
															<td width="100" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Intrested ? : </b></td>
															<td width="100" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-check text-dark heading-4"></i></a></td>
															<td width="140" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Get contact details : </b></td>
															<td width="100" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-phone text-dark heading-4"></i></a></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="block-title-wrapper pt-2" style="display:grid;">
												<h3 class="heading heading-6 strong-500 mt-1 theme-bg text-white p-2" style="border-bottom: 1px solid #971a1e;">
													Basic information
												</h3>
												<table class="mb-2" style="font-size: 12px;">
													<tbody>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Age:</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">:  30 years</td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Religion</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Hindu</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Caste</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Brahmin</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Mother tongue</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Marathi</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Education</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Graduate, B.A</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Place</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Nashik</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Business</b></td>
															<td colspan="3" height="30" style="padding-left: 5px;" class="font-dark">: Distributor of Fruits and Vegetables in Pune/20,00,000 PA</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="block-title-wrapper pt-2" style="display:grid;">
												<h3 class="heading heading-6 strong-500 mt-1 theme-bg text-white p-2" style="border-bottom: 1px solid #971a1e;">
													Edcation and occupation
												</h3>
												<table class="mb-2" style="font-size: 12px;">
													<tbody>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Age:</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">:  30 years</td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Religion</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Hindu</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Caste</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Brahmin</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Mother tongue</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Marathi</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Education</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Graduate, B.A</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Place</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Nashik</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Business</b></td>
															<td colspan="3" height="30" style="padding-left: 5px;" class="font-dark">: Distributor of Fruits and Vegetables in Pune/20,00,000 PA</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="block-title-wrapper pt-2" style="display:grid;">
												<h3 class="heading heading-6 strong-500 mt-1 theme-bg text-white p-2" style="border-bottom: 1px solid #971a1e;">
													Profile Description
												</h3>
												<table class="mb-2" style="font-size: 12px;">
													<tbody>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Age:</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">:  30 years</td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Religion</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Hindu</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Caste</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Brahmin</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Mother tongue</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Marathi</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Education</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Graduate, B.A</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Place</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Nashik</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Business</b></td>
															<td colspan="3" height="30" style="padding-left: 5px;" class="font-dark">: Distributor of Fruits and Vegetables in Pune/20,00,000 PA</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="block-title-wrapper pt-2" style="display:grid;">
												<h3 class="heading heading-6 strong-500 mt-1 theme-bg text-white p-2" style="border-bottom: 1px solid #971a1e;">
													Family Details
												</h3>
												<table class="mb-2" style="font-size: 12px;">
													<tbody>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Age:</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">:  30 years</td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Religion</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Hindu</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Caste</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Brahmin</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Mother tongue</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Marathi</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Education</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Graduate, B.A</td>
															<td width="120" height="30" style="padding-left: 5px;"><b>Place</b></td>
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark">: Nashik</td>
														</tr>
														<tr style="border-bottom: 1px solid #971a1e;">
															<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Business</b></td>
															<td colspan="3" height="30" style="padding-left: 5px;" class="font-dark">: Distributor of Fruits and Vegetables in Pune/20,00,000 PA</td>
														</tr>
													</tbody>
												</table>
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