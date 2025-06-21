<?php 
	include 'layout/header.php';
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
	include 'layout/menu.php';
?>
							<section class="slice--offset parallax-section parallax-section-lg" style="background-image: url(uploads/home_page/premium_plans_image/banner3.jpg)">
								<div class="container">	
									<div class="row align-items-center">
										<div class="col">
											<div class="d-none d-lg-block">
												<h1 class="h2 text-white">Intrested Profiles</h1>
											</div>
											<!-- Breadcrumb -->
											<nav aria-label="breadcrumb text-white">
												<ol class="breadcrumb breadcrumb-light mb-0">
													<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="index.php">Home</a></li>
													<li class="breadcrumb-item active" aria-current="page">Intrested Profiles</li>
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
										<div class="col-lg-2"></div>
										<div class="col-lg-8">
											<input type="hidden" id="member_type" value="">
											<div class="block-wrapper" id="result">          
												<!--
												<div class="block block--style-3 list z-depth-1-top" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(uploads/profile_image/profile_02.jpg)"></div>
														</a>
													</div>
													<div class="block-title-wrapper">
														<a class="badge-corner badge-corner-red">
															<span style="-ms-transform: rotate(45deg);/* IE 9 */-webkit-transform: rotate(45deg);/* Chrome, Safari, Opera */transform: rotate(45deg);font-size: 10px;margin-left: -14px;">
															Premium                    </span>
														</a>
														<h3 class="heading heading-5 strong-500 mt-1">
															<a onclick="return goto_profile(64)" class="c-base-1">Pooshpak Pawar</a>
														</h3>
														<h4 class="heading heading-xs c-gray-light text-uppercase strong-400">Digital Marketing Manager</h4>
														<table class="table-striped table-bordered mb-2" style="font-size: 12px;">
															<tbody>
																<tr>
																	<td height="30" style="padding-left: 5px;" class="font-dark"><b>Member ID</b></td>
																	<td height="30" style="padding-left: 5px;" class="font-dark" colspan="3">
																		<a onclick="return goto_profile(64)" class="c-base-1"><b>35B45A2664</b></a>
																	</td>
																</tr>
																<tr>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Age</b></td>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark">30</td>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Height</b></td>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark">0.00 Feet</td>
																</tr>
																<tr>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Religion</b></td>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark"></td>
																	<td width="120" height="30" style="padding-left: 5px;"><b>Caste / Sect</b></td>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark"></td>
																</tr>
																<tr>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Mother Tongue</b></td>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark"></td>
																	<td width="120" height="30" style="padding-left: 5px;"><b>Marital Status</b></td>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark">Never Married</td>
																</tr>
																<tr>
																	<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Location</b></td>
																	<td colspan="3" height="30" style="padding-left: 5px;" class="font-dark"></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="block-footer b-xs-top">
														<div class="row align-items-center">
															<div class="col-sm-12 text-center">
																<ul class="inline-links inline-links--style-3">
																	<li class="listing-hover">
																		<a onclick="return goto_profile(64)">
																			<i class="fa fa-id-card"></i>Full Profile                            
																		</a>
																	</li>
																	<li class="listing-hover">
																		<a id="interest_a_64" onclick="return confirm_interest(64)" style="">
																			<span id="interest_64" class="">
																				<i class="fa fa-heart"></i> Express Interest                                    
																			</span>
																		</a>
																	</li>
																	<li class="listing-hover">
																		<a id="shortlist_a_64" onclick="return do_shortlist(64)" style="">
																			<span id="shortlist_64" class="">
																				<i class="fa fa-list-ul"></i> Shortlist                                    
																			</span>
																		</a>
																	</li>
																	<li class="listing-hover">
																		<a id="followed_a_64" onclick="return do_follow(64)" style="">
																			<span id="followed_64" class="">
																				<i class="fa fa-star"></i> Follow
																			</span>
																		</a>
																	</li>
																	<li class="listing-hover">
																		<a onclick="return confirm_ignore(64)">
																			<i class="fa fa-ban"></i>Ignore                                
																		</a>
																	</li>
																	<li class="listing-hover">
																		<a id="report_a_64" onclick="return do_report(64)" style="">
																			<span id="report_64" class="">
																				<i class="fa fa-odnoklassniki"></i> Profile Report                                        
																			</span>
																		</a>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>-->
												<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(uploads/profile_image/profile_05.jpg)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="full-profile.php" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-400">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
														<table class="table-striped1 table-bordered1 mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 1px solid #971a1e; border-top: 1px solid #971a1e;">
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
												<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(uploads/profile_image/profile_05.jpg)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="full-profile.php" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-400">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
														<table class="table-striped1 table-bordered1 mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 1px solid #971a1e; border-top: 1px solid #971a1e;">
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
												<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(uploads/profile_image/profile_05.jpg)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="full-profile.php" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-400">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
														<table class="table-striped1 table-bordered1 mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 1px solid #971a1e; border-top: 1px solid #971a1e;">
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
												<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(uploads/profile_image/profile_05.jpg)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="full-profile.php" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-400">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
														<table class="table-striped1 table-bordered1 mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 1px solid #971a1e; border-top: 1px solid #971a1e;">
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
												<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(uploads/profile_image/profile_05.jpg)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="full-profile.php" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-400">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
														<table class="table-striped1 table-bordered1 mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 1px solid #971a1e; border-top: 1px solid #971a1e;">
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
												<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(uploads/profile_image/profile_05.jpg)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="full-profile.php" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-400">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
														<table class="table-striped1 table-bordered1 mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 1px solid #971a1e; border-top: 1px solid #971a1e;">
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
											<div id="pseudo_pagination" style="display: none;">
											<ul class="pagination"><li class="page-item active"><a class="page-link">1<span class="sr-only">(current)</span></a></li><li class="page-item"><a class="page-link" onclick="filter_members(((this.innerHTML-1)*5))">2</a></li><li class="page-item"><a class="page-link" onclick="filter_members(((this.innerHTML-1)*5))">3</a></li><li class="page-item"><a class="page-link" onclick="filter_members('5')">&gt;</a></li><li class="page-item"><a class="page-link" onclick="filter_members('150')">»</a></li></ul></div>

											<script type="text/javascript">
											$('#pagination').php($('#pseudo_pagination').php());
											</script>

</div>
                <div id="pagination" style="float: right;">
    <ul class="pagination"><li class="page-item active"><a class="page-link">1<span class="sr-only">(current)</span></a></li><li class="page-item"><a class="page-link" onclick="filter_members(((this.innerHTML-1)*5))">2</a></li><li class="page-item"><a class="page-link" onclick="filter_members(((this.innerHTML-1)*5))">3</a></li><li class="page-item"><a class="page-link" onclick="filter_members('5')">&gt;</a></li><li class="page-item"><a class="page-link" onclick="filter_members('150')">»</a></li></ul></div>
            </div>
										<div class="col-lg-2"></div>
									</div>
								</div>
							</section>
<?php 
	include 'layout/footer.php';
?>
<?php 
	include 'layout/jsfiles.php';
?>