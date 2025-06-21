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
												<h1 class="h2 text-white">Profiles</h1>
											</div>
											<!-- Breadcrumb -->
											<nav aria-label="breadcrumb text-white">
												<ol class="breadcrumb breadcrumb-light mb-0">
													<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="<?php echo site_url('home'); ?>">Home</a></li>
													<li class="breadcrumb-item active" aria-current="page">Profiles</li>
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
										<div class="col-lg-4 size-sm">
											<div class="sidebar ">
												<div class="">
													<div class="card z-depth-2-top z-depth-3--hover profilecardBR2">
														<div class="card-title b-xs-bottom">
															<h3 class="heading heading-sm text-uppercase"> <i class="fa fa-sliders"></i>   Search Profile</h3>
														</div>
														<div class="card-body">
															<form class="form-default" id="filter_form" data-toggle="validator" role="form">
																<div class="row">
																	<div class="col-sm-12">
																		<div class="form-group has-feedback">
																			<input type="text" class="form-control form-control-sm" name="member_id" id="filter_member_id" value="" placeholder="Search by Keyword" style="width: 70%; border-bottom-left-radius: 50px; border-top-left-radius: 50px; display: inline; line-height: 1.90;">
																			<button type="button" class="btn btn-base-1 mt-0" onclick="filter_members('0','search')"style="width: 28%; border-bottom-right-radius: 50px; border-top-right-radius: 50px; display: inline;">Search <i class="fa fa-search"></i></button>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-sm-5"><hr class="fr hr1"></div>
																	<div class="col-sm-2 p-0">
																		<p class="text-center">OR</p>
																	</div>
																	<div class="col-sm-5"><hr class="fr hr1"></div>
																</div>
																<div class="row b-xs-bottom">
																	<div class="col-sm-12">
																		<div class="form-group has-feedback">
																			<input type="text" class="form-control form-control-sm" name="member_id" id="filter_member_id" value="" placeholder="Search by Profile ID" style="width: 70%; border-bottom-left-radius: 50px; border-top-left-radius: 50px; display: inline; line-height: 1.90;">
																			<button type="button" class="btn btn-base-1 mt-0" onclick="filter_members('0','search')"style="width: 28%; border-bottom-right-radius: 50px; border-top-right-radius: 50px; display: inline;">  Search <i class="fa fa-search"></i></button>
																		</div>
																	</div>
																</div>
																<div class="row mt-3">
																	<div class="col-sm-2">
																		<div class="form-group has-feedback">
																			<label for="" class="text-uppercase">Gender </label>
																		</div>
																	</div>
																	<div class="col-sm-10">
																		<div class="form-group has-feedback mt-1">
																			<div class="radio radio-primary">
																				<input type="radio" name="gender" id="groom" value="2" >
																				<label for="groom" class="pr-3">Male</label>
																				<input type="radio" name="gender" id="bride" value="1" >
																				<label for="bride">Female</label>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div class="row">
																	<div class="col-sm-6">
																		<div class="form-group has-feedback">
																			<label for="" class="text-uppercase">From age </label>
																			<input type="number" class="form-control form-control-sm" name="aged_from" id="filter_aged_from" value="">
																			<div class="help-block with-errors">
																			</div>
																		</div>
																	</div>
																	<div class="col-sm-6">
																		<div class="form-group has-feedback">
																			<label for="" class="text-uppercase">To age</label>
																			<input type="number" class="form-control form-control-sm" name="aged_to" id="filter_aged_to" value="">
																		</div>
																		<div class="help-block with-errors">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-sm-6">
																		<div class="form-group has-feedback">
																			<label for="" class="text-uppercase">From height (feet)</label>
																			<input type="text" class="form-control form-control-sm height_mask" name="min_height" id="min_height" value="">
																			<div class="help-block with-errors">
																			</div>
																		</div>
																	</div>
																	<div class="col-sm-6">
																		<div class="form-group has-feedback">
																			<label for="" class="text-uppercase">To height (feet)</label>
																			<input type="text" class="form-control form-control-sm height_mask" name="max_height" id="max_height" value="">
																		</div>
																		<div class="help-block with-errors">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-sm-12">
																		<div class="form-group has-feedback">
																			<label for="" class="text-uppercase">Marital status</label>
																			<select name="marital_status" onChange="(this.value,this)" class="form-control form-control-sm selectpicker"   data-placeholder="Choose a marital_status" tabindex="2" data-hide-disabled="true" >
																				<option value="">Select</option>
																				<option value="1" >Never married</option>
																				<option value="2" >Married</option>
																				<option value="3" >Divorced </option>
																				<option value="4" >Separated</option>
																				<option value="5" >Widowed or widowed</option>
																			</select>                                    
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-sm-12">
																		<div class="form-group has-feedback">
																			<label for="" class="text-uppercase">Mother tongue</label>
																			<select name="language" onChange="(this.value,this)" class="form-control form-control-sm selectpicker"   data-placeholder="निवडा मातृ भाषा" tabindex="2" data-hide-disabled="true" >
																				<option value="">Select</option>
																				<option value="1">Marathi</option>
																				<option value="2">Hindi</option>
																				<option value="3">English</option>
																			</select>                                    
																		</div>
																	</div>
																</div>
																<button type="button" class="btn btn-block btn-base-1 mt-2" style="border-radius: 50px;"><i class="fa fa-search"></i> Search</button>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-8">
											<input type="hidden" id="member_type" value="">
											<div class="block-wrapper" id="result">    
												<?php
													if(count($profilesResult)>0)
													{							
														for($i=0; $i < count($profilesResult); $i++)
														{
												?>
															<div class="block block--style-3 list z-depth-2-top z-depth-3--hover profilecardBR2 p-1" id="block_64">
																<div class="block-image">
																	<a onclick="return goto_profile(64)">
																		<div class="listing-image profilecardBR2" style="background-image: url(<?php echo base_url().UPLOAD_PROFILE.$profilesResult[$i]['photo']; ?>)"></div>
																	</a>
																</div>
																<div class="block-title-wrapper pt-2">
																	<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
																		<a href="<?php echo site_url('fullprofile')."/".$profilesResult[$i]['profileID']; ?>" class="c-base-1">
																			<?php echo $profilesResult[$i]['profileCode']; ?> |</a> 
																			<?php echo $profilesResult[$i]['firstName']." ".$profilesResult[$i]['middleName']." ".$profilesResult[$i]['lastName']; ?>
																			<?php
																				if($profilesResult[$i]['verifiedFlag'] == '1')
																				{
																					echo "<img class='verifiedProfileImg' src='".base_url('assets/uploads/icons/verified.png')."' alt='Verified Profile'>";
																				}
																			?>
																	</h3>
																	<h4 class="heading heading-xs c-gray-light strong-500">
																		<?php echo strip_tags(substr($profilesResult[$i]['introduction'], 0, 200)); ?>...
																	</h4>
																	<table class="table-striped1 table-bordered1 mb-2" style="font-size: 12px;">
																		<tbody>
																			<tr style="border-bottom: 1px solid #971a1e; border-top: 1px solid #971a1e;">
																				<td width="120" height="30" style="padding-left: 5px;" class="font-dark"><b>Age:</b></td>
																				<td width="120" height="30" style="padding-left: 5px;" class="font-dark">:  <?php echo $profilesResult[$i]['age']; ?> years</td>
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
																					$shareText = urlencode($profilesResult[$i]['profileCode']." | ".$profilesResult[$i]['firstName']." ".$profilesResult[$i]['middleName']." ".$profilesResult[$i]['lastName']." ".$profilesResult[$i]['introduction']); 
																				?>
																				<td width="50" height="40" style="padding-left: 5px; text-align:right" class="font-dark">
																					<b>Share :  </b>
																				</td>
																				<td width="40" height="40" style="padding-left: 5px;" class="font-dark">
																					<a href="https://api.whatsapp.com/send?text=<?php echo $shareText; ?>" target="_blank" title=""><i class="fa fa-whatsapp text-dark heading-4"></i></a>
																				</td>
																				<td width="70" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Shortlist : </b></td>
																				<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-star-o text-dark heading-4"></i></a></td>
																				<td width="90" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Intrested ? : </b></td>
																				<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-check text-dark heading-4"></i></a></td>
																				<td width="140" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Get contact details : </b></td>
																				<td width="30" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-phone text-dark heading-4"></i></a></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
												<?php
														}
													}
													
												?>
												<div id="pagination" style="float: right;">
													<ul class="pagination">
														<?php
															
															if($_SESSION['total_pages'] > 15)
															{
																if(($this->uri->segment(2)-7) > 0)
																{
																	$start= $this->uri->segment(2)-7;
																	if(($start + 15) < $_SESSION['total_pages'])
																	{
																		$count= $start + 15;
																	}
																	else
																	{
																		$count= $_SESSION['total_pages'];
																	}
																	
																}
																else
																{
																	$start=0;
																	$count=15;
																}
															}
															else
															{
																$start=0;
																$count=$_SESSION['total_pages'];
															}
															
															if($this->uri->segment(2)!=1 && !empty($this->uri->segment(2)))
															{
																echo "<li class='page-item active'>
																			<a class='page-link' href='".site_url($URLResult)."/1'><i class='fa fa-angle-double-left'></i> </a>
																		</li>";
															}
																		
															for($i=$start; $i < $count; $i++)
															{
																if($this->uri->segment(2) == ($i+1))
																{
																	echo "<li class='page-item active'>
																			<a class='page-link' href='".site_url($URLResult)."/".($i+1)."'>".($i+1)."</a>
																		</li>";
																	//echo "->((".($i+1)."))";
																}
																else
																{
																	echo "<li class='page-item'>
																			<a class='page-link' href='".site_url($URLResult)."/".($i+1)."'>".($i+1)."</a>
																		</li>";
																	//echo "->".($i+1);
																}
															}
															
															if($this->uri->segment(2)!= $_SESSION['total_pages'])
															{
																echo "<li class='page-item active'>
																			<a class='page-link' href='".site_url($URLResult)."/".$_SESSION['total_pages']."'><i class='fa fa-angle-double-right'></i> </a>
																		</li>";
															}
															
															/*
															for($i=0; $i < $_SESSION['total_pages']; $i++)
															{
																if($this->uri->segment(2) == ($i+1))
																{
																	echo "<li class='page-item active'>
																			<a class='page-link' href='".site_url('listing')."/".($i+1)."'>".($i+1)."</a>
																		</li>";
																	//echo "->((".($i+1)."))";
																}
																else
																{
																	echo "<li class='page-item'>
																			<a class='page-link' href='".site_url('listing')."/".($i+1)."'>".($i+1)."</a>
																		</li>";
																	//echo "->".($i+1);
																}
															}
															*/
														?>
														<!--
														<li class="page-item active"><a class="page-link">1<span class="sr-only">(current)</span></a></li>
														<li class="page-item"><a class="page-link" onclick="filter_members(((this.innerHTML-1)*5))">2</a></li>
														<li class="page-item"><a class="page-link" onclick="filter_members(((this.innerHTML-1)*5))">3</a></li>
														<li class="page-item"><a class="page-link" onclick="filter_members('5')">&gt;</a></li>
														<li class="page-item"><a class="page-link" onclick="filter_members('150')">»</a></li>-->
													</ul>
												</div>
											<div id="pseudo_pagination" style="display: none;">
											<ul class="pagination"><li class="page-item active"><a class="page-link">1<span class="sr-only">(current)</span></a></li><li class="page-item"><a class="page-link" onclick="filter_members(((this.innerHTML-1)*5))">2</a></li><li class="page-item"><a class="page-link" onclick="filter_members(((this.innerHTML-1)*5))">3</a></li><li class="page-item"><a class="page-link" onclick="filter_members('5')">&gt;</a></li><li class="page-item"><a class="page-link" onclick="filter_members('150')">»</a></li></ul></div>

											<script type="text/javascript">
											$('#pagination').php($('#pseudo_pagination').php());
											</script>

										</div>
									</div>
									
										<div class="col-lg-8" style="display:none";>
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
														<h4 class="heading heading-xs c-gray-light text-uppercase strong-500">Digital Marketing Manager</h4>
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
															<div class="listing-image" style="background-image: url(<?php echo base_url('assets/uploads/profile_image/profile_02.jpg'); ?>)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="<?php echo site_url('fullprofile'); ?>" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-500">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
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
														<table class="mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 5px solid #971a1e; border-top: 5px solid #971a1e;vertical-align: middle;">
																	<td width="50" height="40" style="padding-left: 5px; text-align:right" class="font-dark">
																		<b>Share :  </b>
																	</td>
																	<td width="40" height="40" style="padding-left: 5px;" class="font-dark">
																		<a href="https://api.whatsapp.com/send?phone=919822898042&amp;text=AW000001 | अमन किरण पवार See Profile:http://antarpatweddings.com/" target="_blank" title=""><i class="fa fa-whatsapp text-dark heading-4"></i></a>
																	</td>
																	<td width="70" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Shortlist : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-star-o text-dark heading-4"></i></a></td>
																	<td width="90" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Intrested ? : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-check text-dark heading-4"></i></a></td>
																	<td width="140" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Get contact details : </b></td>
																	<td width="30" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-phone text-dark heading-4"></i></a></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
													<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(<?php echo base_url('assets/uploads/profile_image/profile_03.jpg'); ?>)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="<?php echo site_url('fullprofile'); ?>" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-500">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
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
														<table class="mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 5px solid #971a1e; border-top: 5px solid #971a1e;vertical-align: middle;">
																	<td width="50" height="40" style="padding-left: 5px; text-align:right" class="font-dark">
																		<b>Share :  </b>
																	</td>
																	<td width="40" height="40" style="padding-left: 5px;" class="font-dark">
																		<a href="https://api.whatsapp.com/send?phone=919822898042&amp;text=AW000001 | अमन किरण पवार See Profile:http://antarpatweddings.com/" target="_blank" title=""><i class="fa fa-whatsapp text-dark heading-4"></i></a>
																	</td>
																	<td width="70" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Shortlist : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-star-o text-dark heading-4"></i></a></td>
																	<td width="90" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Intrested ? : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-check text-dark heading-4"></i></a></td>
																	<td width="140" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Get contact details : </b></td>
																	<td width="30" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-phone text-dark heading-4"></i></a></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(<?php echo base_url('assets/uploads/profile_image/profile_04.jpg'); ?>)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="<?php echo site_url('fullprofile'); ?>" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-500">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
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
														<table class="mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 5px solid #971a1e; border-top: 5px solid #971a1e;vertical-align: middle;">
																	<td width="50" height="40" style="padding-left: 5px; text-align:right" class="font-dark">
																		<b>Share :  </b>
																	</td>
																	<td width="40" height="40" style="padding-left: 5px;" class="font-dark">
																		<a href="https://api.whatsapp.com/send?phone=919822898042&amp;text=AW000001 | अमन किरण पवार See Profile:http://antarpatweddings.com/" target="_blank" title=""><i class="fa fa-whatsapp text-dark heading-4"></i></a>
																	</td>
																	<td width="70" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Shortlist : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-star-o text-dark heading-4"></i></a></td>
																	<td width="90" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Intrested ? : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-check text-dark heading-4"></i></a></td>
																	<td width="140" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Get contact details : </b></td>
																	<td width="30" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-phone text-dark heading-4"></i></a></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(<?php echo base_url('assets/uploads/profile_image/profile_05.jpg'); ?>)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="<?php echo site_url('fullprofile'); ?>" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-500">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
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
														<table class="mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 5px solid #971a1e; border-top: 5px solid #971a1e;vertical-align: middle;">
																	<td width="50" height="40" style="padding-left: 5px; text-align:right" class="font-dark">
																		<b>Share :  </b>
																	</td>
																	<td width="40" height="40" style="padding-left: 5px;" class="font-dark">
																		<a href="https://api.whatsapp.com/send?phone=919822898042&amp;text=AW000001 | अमन किरण पवार See Profile:http://antarpatweddings.com/" target="_blank" title=""><i class="fa fa-whatsapp text-dark heading-4"></i></a>
																	</td>
																	<td width="70" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Shortlist : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-star-o text-dark heading-4"></i></a></td>
																	<td width="90" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Intrested ? : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-check text-dark heading-4"></i></a></td>
																	<td width="140" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Get contact details : </b></td>
																	<td width="30" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-phone text-dark heading-4"></i></a></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="#">
															<div class="listing-image" style="background-image: url(<?php echo base_url('assets/uploads/profile_image/profile_06.jpg'); ?>)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="<?php echo site_url('fullprofile'); ?>" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-500">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
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
														<table class="mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 5px solid #971a1e; border-top: 5px solid #971a1e;vertical-align: middle;">
																	<td width="50" height="40" style="padding-left: 5px; text-align:right" class="font-dark">
																		<b>Share :  </b>
																	</td>
																	<td width="40" height="40" style="padding-left: 5px;" class="font-dark">
																		<a href="https://api.whatsapp.com/send?phone=919822898042&amp;text=AW000001 | अमन किरण पवार See Profile:http://antarpatweddings.com/" target="_blank" title=""><i class="fa fa-whatsapp text-dark heading-4"></i></a>
																	</td>
																	<td width="70" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Shortlist : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-star-o text-dark heading-4"></i></a></td>
																	<td width="90" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Intrested ? : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-check text-dark heading-4"></i></a></td>
																	<td width="140" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Get contact details : </b></td>
																	<td width="30" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-phone text-dark heading-4"></i></a></td>
																</tr>
															</tbody>
														</table>

													</div>
												</div>
													<div class="block block--style-3 list z-depth-1-top1" id="block_64">
													<div class="block-image">
														<a onclick="return goto_profile(64)">
															<div class="listing-image" style="background-image: url(<?php echo base_url('assets/uploads/profile_image/profile_01.jpg'); ?>)"></div>
														</a>
													</div>
													<div class="block-title-wrapper pt-2">
														<h3 class="heading heading-5 strong-500 mt-1" style="border-bottom: 1px solid #971a1e;">
															<a href="<?php echo site_url('fullprofile'); ?>" class="c-base-1">AW000001 |</a> Aman Kiran Pawar
														</h3>
														<h4 class="heading heading-xs c-gray-light strong-500">Chartered Accountant, single child, residing at Andheri, Mumbai. Loves travel and photography and music</h4>
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
														<table class="mb-2" style="font-size: 12px;">
															<tbody>
																<tr style="border-bottom: 5px solid #971a1e; border-top: 5px solid #971a1e;vertical-align: middle;">
																	<td width="50" height="40" style="padding-left: 5px; text-align:right" class="font-dark">
																		<b>Share :  </b>
																	</td>
																	<td width="40" height="40" style="padding-left: 5px;" class="font-dark">
																		<a href="https://api.whatsapp.com/send?phone=919822898042&amp;text=AW000001 | अमन किरण पवार See Profile:http://antarpatweddings.com/" target="_blank" title=""><i class="fa fa-whatsapp text-dark heading-4"></i></a>
																	</td>
																	<td width="70" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Shortlist : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-star-o text-dark heading-4"></i></a></td>
																	<td width="90" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Intrested ? : </b></td>
																	<td width="40" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-check text-dark heading-4"></i></a></td>
																	<td width="140" height="30" style="padding-left: 5px;  text-align:right" class="font-dark"><b>Get contact details : </b></td>
																	<td width="30" height="30" style="padding-left: 5px;" class="font-dark"><a href="#" target="_blank" title=""><i class="fa fa-phone text-dark heading-4"></i></a></td>
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
									</div>
								</div>
							</section>
<?php 
	$this->load->view('layout/footer');
?>
<?php 
	$this->load->view('layout/jsfiles');
?>