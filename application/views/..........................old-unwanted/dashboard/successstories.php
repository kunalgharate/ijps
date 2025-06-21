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
												<h1 class="h2 text-white">Success Stories</h1>
											</div>
											<!-- Breadcrumb -->
											<nav aria-label="breadcrumb text-white">
												<ol class="breadcrumb breadcrumb-light mb-0">
													<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="<?php echo site_url('home'); ?>">Home</a></li>
													<li class="breadcrumb-item active" aria-current="page">Success Stories</li>
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
									<div class="row">
										<?php
											if(count($successStoriesResult)>0)
											{							
												for($i=0; $i < count($successStoriesResult); $i++)
												{
										?>
													<div class="col-md-3 col-lg-4">
														<div class="block block--style-1 mb-4 profilecardBR2">
															<a href="<?php echo site_url('successstory')."/".$successStoriesResult[$i]['happyStoryID']; ?>" target="_blank">
															<div class="card card-hover--animation-1 z-depth-2-top z-depth-3--hover home-p-member profilecardBR2">
																<div class="profile-picture profile-picture--style-3">
																	<div class="home_pm profilecardBR2" style="background-image: url(<?php echo base_url().UPLOAD_HAPPY_STORY.$successStoriesResult[$i]['thumbnailImage']; ?>)"></div>
																</div>
																<div class="card-body text-center p-0 borderBottom profilecardBR2">
																	<div class="p-3">
																		<small class="text-dark">
																			<em>
																				<?php echo date('d M Y', strtotime($successStoriesResult[$i]['createdDate'])); ?>
																			</em>
																		</small>
																		<h3 class="heading heading-5 premium_heading mt-2">
																			<?php echo $successStoriesResult[$i]['happyStoryHeading']; ?>
																		</h3>
																		<p class="text-dark">
																			<?php echo strip_tags(substr($successStoriesResult[$i]['happyStoryShortDescription'], 0, 200)); ?>...
																		</p>
																	</div>
																	<!--<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>-->
																</div>
															</div>
															</a>
														</div>
													</div>
										<?php
												}
											}
											else
											{
										?>
												<div class="col-md-3 col-lg-12">
													<div class="block block--style-1 mb-4 profilecardBR2">
														<a href="<?php echo site_url('successstoriedetails'); ?>" target="_blank">
														<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member profilecardBR2">
															<div class="profile-picture profile-picture--style-3">
																<div class="home_pm profilecardBR2" style="background-image: url(<?php echo base_url('assets/uploads/happy_story_image/happystory02.jpg'); ?>)"></div>
															</div>
															<div class="card-body text-center p-0 borderBottom profilecardBR2">
																<div class="p-3">
																	<small class="text-dark"><em>08 March 2023 </em></small>
																	<h3 class="heading heading-5 premium_heading mt-2">Success Story 2</h3>
																	<p class="text-dark">I am thankful to Ashu who has helped me finding the perfect...</p>
																</div>
																<!--<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>-->
															</div>
														</div>
														</a>
													</div>
												</div>
									
										<?php
											}
										?>
									</div>										
								</div>
							</section>

												
												
							<section class="slice sct-color-1" style="display:none;">
								<div class="container">
									<div class="row">
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-4 profilecardBR2">
												<a href="<?php echo site_url('successstoriedetails'); ?>" target="_blank">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member profilecardBR2">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm profilecardBR2" style="background-image: url(<?php echo base_url('assets/uploads/happy_story_image/happystory01.jpg'); ?>)"></div>
													</div>
													<div class="card-body text-center p-0 borderBottom profilecardBR2">
														<div class="p-3">
															<small class="text-dark"><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 1</h3>
															<p class="text-dark">I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<!--<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>-->
													</div>
												</div>
												</a>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-4 profilecardBR2">
												<a href="<?php echo site_url('successstoriedetails'); ?>" target="_blank">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member profilecardBR2">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm profilecardBR2" style="background-image: url(<?php echo base_url('assets/uploads/happy_story_image/happystory02.jpg'); ?>)"></div>
													</div>
													<div class="card-body text-center p-0 borderBottom profilecardBR2">
														<div class="p-3">
															<small class="text-dark"><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 2</h3>
															<p class="text-dark">I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<!--<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>-->
													</div>
												</div>
												</a>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-4 profilecardBR2">
												<a href="<?php echo site_url('successstoriedetails'); ?>" target="_blank">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member profilecardBR2">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm profilecardBR2" style="background-image: url(<?php echo base_url('assets/uploads/happy_story_image/happystory03.jpg'); ?>)"></div>
													</div>
													<div class="card-body text-center p-0 borderBottom profilecardBR2">
														<div class="p-3">
															<small class="text-dark"><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 3</h3>
															<p class="text-dark">I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<!--<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>-->
													</div>
												</div>
												</a>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-4 profilecardBR2">
												<a href="<?php echo site_url('successstoriedetails'); ?>" target="_blank">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member profilecardBR2">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm profilecardBR2" style="background-image: url(<?php echo base_url('assets/uploads/happy_story_image/happystory04.jpg'); ?>)"></div>
													</div>
													<div class="card-body text-center p-0 borderBottom profilecardBR2">
														<div class="p-3">
															<small class="text-dark"><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 4</h3>
															<p class="text-dark">I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<!--<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>-->
													</div>
												</div>
												</a>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-4 profilecardBR2">
												<a href="<?php echo site_url('successstoriedetails'); ?>" target="_blank">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member profilecardBR2">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm profilecardBR2" style="background-image: url(<?php echo base_url('assets/uploads/happy_story_image/happystory05.jpg'); ?>)"></div>
													</div>
													<div class="card-body text-center p-0 borderBottom profilecardBR2">
														<div class="p-3">
															<small class="text-dark"><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 5</h3>
															<p class="text-dark">I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<!--<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>-->
													</div>
												</div>
												</a>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-4 profilecardBR2">
												<a href="<?php echo site_url('successstoriedetails'); ?>" target="_blank">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member profilecardBR2">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm profilecardBR2" style="background-image: url(<?php echo base_url('assets/uploads/happy_story_image/happystory06.jpg'); ?>)"></div>
													</div>
													<div class="card-body text-center p-0 borderBottom profilecardBR2">
														<div class="p-3">
															<small class="text-dark"><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 6</h3>
															<p class="text-dark">I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<!--<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>-->
													</div>
												</div>
												</a>
											</div>
										</div>
									</div>										
								<!--
									<div class="row">
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-2">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm" style="background-image: url(uploads/happy_story_image/happystory01.jpg)"></div>
													</div>
													<div class="card-body text-center p-0">
														<div class="p-3">
															<small><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 1</h3>
															<p>I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-2">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm" style="background-image: url(uploads/happy_story_image/happystory02.jpg)"></div>
													</div>
													<div class="card-body text-center p-0">
														<div class="p-3">
															<small><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 2</h3>
															<p>I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-2">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm" style="background-image: url(uploads/happy_story_image/happystory03.jpg)"></div>
													</div>
													<div class="card-body text-center p-0">
														<div class="p-3">
															<small><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 3</h3>
															<p>I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-2">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm" style="background-image: url(uploads/happy_story_image/happystory04.jpg)"></div>
													</div>
													<div class="card-body text-center p-0">
														<div class="p-3">
															<small><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 4</h3>
															<p>I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-2">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm" style="background-image: url(uploads/happy_story_image/happystory05.jpg)"></div>
													</div>
													<div class="card-body text-center p-0">
														<div class="p-3">
															<small><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 5</h3>
															<p>I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3 col-lg-4">
											<div class="block block--style-1 mb-2">
												<div class="card card-hover--animation-1 z-depth-1-top z-depth-2--hover home-p-member">
													<div class="profile-picture profile-picture--style-3">
														<div class="home_pm" style="background-image: url(uploads/happy_story_image/happystory06.jpg)"></div>
													</div>
													<div class="card-body text-center p-0">
														<div class="p-3">
															<small><em>08 March 2023 </em></small>
															<h3 class="heading heading-5 premium_heading mt-2">Success Story 6</h3>
															<p>I am thankful to Ashu who has helped me finding the perfect...</p>
														</div>
														<a class="btn btn-base-1 btn-block mt-2 text-white" href="<?php echo site_url('successstoriedetails'); ?>">See...</a>
													</div>
												</div>
											</div>
										</div>
									</div>										
								-->
								</div>
							</section>

<?php 
	$this->load->view('layout/footer');
?>
<?php 
	$this->load->view('layout/jsfiles');
?>