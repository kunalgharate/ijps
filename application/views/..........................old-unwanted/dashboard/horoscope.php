<?php 
	$this->load->view('layout/header');
?>
<style>
	li
	{
		font-size: 0.90rem;
		margin-bottom: 10px;
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
												<h1 class="h2 text-white">Match Horoscope</h1>
											</div>
											<!-- Breadcrumb -->
											<nav aria-label="breadcrumb text-white">
												<ol class="breadcrumb breadcrumb-light mb-0">
													<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="<?php echo site_url('home'); ?>">Home</a></li>
													<li class="breadcrumb-item active" aria-current="page">Match Horoscope</li>
												</ol>
											</nav>
											<!-- End Breadcrumb -->
										</div>
										<!-- End Col -->
									</div>
								</div>
							</section>
							<section class="slice">
								<div class="container">
									<div class="row">
										<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"></div>-->
										<div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 mb-5">
											<div class="block block--style-1 profilecardBR2">
												<div class="card card-hover--animation-1 home-p-member z-depth-2-top z-depth-3--hover profilecardBR2">
													<div class="row">
														<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 profilecardBR2" style="background-image: url(<?php echo base_url('assets/uploads/images/horoscopeLeft.jpg'); ?>); background-position: center; background-repeat: no-repeat; background-size: cover;">
															<!--<img src="uploads/images/horoscopeLeft.jpg" class="img-responsive">-->
														</div>
														<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
															<div class="card-body">
																<div class="section-title section-title--style-1 text-center m-0">
																	<h3 class="section-title-inner">
																		<span>Match Horoscope</span>
																	</h3>
																	<p>View Kundli (guna-milan) with other member...</p>
																</div>
																<form class="form-default" role="form" method="POST" action="#">
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">My Registration ID</label>
																				<input type="text" name="name" class="form-control form-control-md" required="" value="">
																			</div>
																		</div>
																		<div class="col-sm-6">
																			<div class="form-group has-feedback">
																				<label for="">My E-mail ID (as mentioned in Biodata)</label>
																				<input type="text" name="subject" class="form-control form-control-md" required="" value="">
																			</div>
																		</div>
																		<div class="col-sm-12">
																			<div class="form-group has-feedback">
																				<label for="">Match with</label>
																				<input type="radio" checked="checked" id="rbtnMatchWith0" name="rbtnMatchWith" value="0" onclick="matchWithEvent(this);">
																				<label for="html">Manual Profile ID</label>
																				<input type="radio" id="rbtnMatchWith1" name="rbtnMatchWith" value="1" onclick="matchWithEvent(this);">
																				<label for="css">Shortlisted Profile</label>
																				<input type="radio" id="rbtnMatchWith2" name="rbtnMatchWith" value="2" onclick="matchWithEvent(this);">
																				<label for="javascript">Intrested Profile</label>
																			</div>
																		</div>
																		<div class="col-md-12" id="txtAnotherRegistrationIDSection">
																			<div class="form-group has-feedback">
																				<label for="">Another Registration ID</label>
																				<input type="text" name="txtAnotherRegistrationID" class="form-control form-control-md" required="" value="">
																			</div>
																		</div>
																		<div class="col-md-12" id="cmbShortlistedSection">
																			<div class="form-group">
																				<label class="control-label">Shortlisted Profiles</label>
																				<select name="cmbShortlisted" onChange="(this.value,this)" class="form-control form-control-sm selectpicker" data-placeholder="Choose Shortlisted Profile" tabindex="2" data-hide-disabled="true" >
																					<option value="">Select</option>
																					<option value="1">Self</option>
																					<option value="2">Daughter/Son</option>
																					<option value="3">Sister</option>
																					<option value="4">Brother</option>
																					<option value="5">Friend</option>
																				</select>                                            
																			</div>
																		</div>
																		<div class="col-md-12" id="cmbIntrestedProfileSection">
																			<div class="form-group">
																				<label class="control-label">Intrested Profiles</label>
																				<select name="cmbIntrestedProfile" onChange="(this.value,this)" class="form-control form-control-sm selectpicker" data-placeholder="Choose Intrested Profile" tabindex="2" data-hide-disabled="true" >
																					<option value="">Select</option>
																					<option value="1">Self</option>
																					<option value="2">Daughter/Son</option>
																					<option value="3">Sister</option>
																					<option value="4">Brother</option>
																					<option value="5">Friend</option>
																				</select>                                            
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="form-group">
																				<div class="form-check1">
																					<input type="checkbox" value="" id="flexCheckChecked" checked>		
																					<label class="control-label" for="flexCheckChecked">
																						Send Mail
																					</label>
																				</div>
																			</div>
																		</div>
																		<div class="mt-1 col-12">
																			<small class="c-gray-light"> <strong>Note : </strong>The horoscope matching screen is provided for informational purposes only, and users should consult with a qualified astrologer for personalized guidance.</small>
																		</div>
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
										<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"></div>-->
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
											<h5 class="text-center">Your Horoscope Matching Report - Porutham Result</h5>
											<h3 class="heading heading-6 strong-500 mt-3 mb-3 theme-bg text-white p-2" style="border-bottom: 1px solid #971a1e;">
												<i class="fa fa-angle-double-right"></i> Guna Milan
											</h3>
											<p>
												In India, Janam Kundli (also called as Birth Chart or Natal Chart) is taken into consideration for Kundli </a>
												Matching. Guna Milan is based on the position of Moon in the Natal Charts of bride and groom. In North
												India, there is a process of Guna Milan, called as, "Ashtakoot Milan", which signifies the eight aspects
												of Gunas. "Ashta" means "Eight" and "Koota" means "Aspects". The eight Kootas are:
											</p>
											<ul>
												<li>
													<b>Varna/Varan/Jaati : </b>It shows spiritual compatibility of boy and girl along with their ego levels.
													It is divided into 4 categories, such as Brahmins (Highest), Kshatriya, Vaishya, Shudra (Lowest).
												</li>
												<li>
													<b>Vasya/Vashya : </b>It shows mutual attraction, control in marriage and also calculates the power
													equation in between married couples. A person is classified into 5 types, namely Manav/Nara (human),
													Vanchar (wild animals such as lion), Chatushpad (small animals such as deer), Jalchar (sea animals),
													Keeta/Keet (insects).
												</li>
												<li>
													<b>Tara/Dina : </b>It is related to birth star compatibility and destiny. There are 27 birth stars (Nakshatra).
												</li>
												<li>
													<b>Yoni : </b>It measures the intimacy level, sexual compatibility and mutual love between the couple.
													Yoni Koot is classified into 14 animals, which are Horse, Elephant, Sheep, Snake, Dog, Cat, Rat, Cow,
													Buffalo, Tiger, Hare/Deer, Monkey, Lion, Mongoose.
												</li>
												<li>
													<b>Graha Maitri/Rasyadipati : </b>It shows mental compatibility, affection and natural friendship. It
													also represents the moon sign compatibility between couples. 
												</li>
												<li>
													<b>Gana : </b>It is related to behaviour and temperament. Birth stars (Nakshatras) are divided into
													three categories- Deva (God, indicating Satwa Guna), Manava (Human, indicating Rajo Guna) and Rakshasa
													(Demon, indicating Tamo Guna).
												</li>
												<li>
													<b>Rashi or Bhakoot : </b>It relates to the emotional compatibility and love between partners. The position
													of planets in boy's birth chart is compared with the girl's birth chart. If the boy's moon is placed
													in 2nd, 3rd, 4th, 5th, 6th house from girl's moon, then it is considered bad or inauspicious, whereas
													7th and 12th houses are considered good. In case of female, If natal chart moon is placed in 2nd, 3rd,
													4th, 5th and 6th houses from man's chart, then it will be auspicious and inauspicious if placed 12th
													from man's chart. 
												</li>
												<li>
													<b>Nadi : </b>It is related to health and genes. Stars (Nakshatra) are divided into 3 parts- Aadi (Vata)
													Nadi, Madhya (Pitta) Nadi and Antya (Kapha) Nadi. 
												</li>
											</ul>
											<h3 class="heading heading-6 strong-500 mt-5 mb-3 theme-bg text-white p-2" style="border-bottom: 1px solid #971a1e;">
												<i class="fa fa-angle-double-right"></i> 10 Poruthams and Your Compatibility
											</h3>
											<div class="table-responsive no-margin">
												<table class="table t-small table-bordered no-margin">
													<thead>
														<tr>
															<th>Porutham</th><th>Result</th><th>Girl</th><th>Boy</th>
														</tr>
													</thead>
													<tbody class="porutham-info">
														<tr>
															<th>Dina Porutham</th>
															<td><i class="fa fa-check-circle"></i> Good</td>
															<td>Hasta</td>
															<td>Hasta</td>
														</tr>
														<tr>
															<th>Gana Porutham</th>
															<td><i class="fa fa-check-circle"></i> Good</td>
															<td>Deva</td>
															<td>Deva</td>
														</tr>
														<tr>
															<th>Mahendra</th>
															<td><i aria-hidden="true" class="icon icon-close">&ZeroWidthSpace;</i> Not Satisfactory</td>
															<td>Hasta</td>
															<td>Hasta</td>
														</tr>
														<tr>
															<th>Stree Dhrirgham</th>
															<td><i aria-hidden="true" class="icon icon-close">&ZeroWidthSpace;</i> Not Satisfactory</td>
															<td>Hasta</td>
															<td>Hasta</td>
														</tr>
														<tr>
															<th>Yoni Porutham</th>
															<td><i aria-hidden="true" class="icon icon-minus-circle">&ZeroWidthSpace;</i> Satisfactory</td>
															<td>Female</td>
															<td>Female</td>
														</tr>
														<tr>
															<th>Veda Porutham</th>
															<td><i class="fa fa-check-circle"></i> Good</td>
															<td>Hasta</td>
															<td>Hasta</td>
														</tr>
														<tr>
															<th>Rajju Porutham</th>
															<td><i class="fa fa-check-circle"></i> Good</td>
															<td>Prathama</td>
															<td>Prathama</td>
														</tr>
														<tr>
															<th>Vasya Porutham</th>
															<td><i class="fa fa-times-circle"></i> Not Satisfactory</td>
															<td>Kanya</td>
															<td>Kanya</td>
														</tr>
														<tr>
															<th>Rasi Porutham</th>
															<td><i class="fa fa-check-circle"></i> Good</td>
															<td>Kanya</td>
															<td>Kanya</td>
														</tr>
														<tr>
															<th>Rasyadhipa</th>
															<td><i class="fa fa-check-circle"></i> Good</td>
															<td>Mercury</td>
															<td>Mercury</td>
														</tr>
														<tr>
															<td class="tc" colspan="4"><h6>Based on your input, <strong>the boy and girl has 6.5/10 poruthams</strong> and your <strong>marriage compatibility is Uthama</strong></h6></td>
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
		<script>
			document.getElementById('txtAnotherRegistrationIDSection').style.display = "";
			document.getElementById('cmbShortlistedSection').style.display = "none";
			document.getElementById('cmbIntrestedProfileSection').style.display = "none";
            
            function matchWithEvent(myRadio) {
                var tempFlag = myRadio.value;
                
                if(tempFlag == 0)
                {
                    document.getElementById('txtAnotherRegistrationIDSection').style.display = "";
					document.getElementById('cmbShortlistedSection').style.display = "none";
					document.getElementById('cmbIntrestedProfileSection').style.display = "none";
                }
				else if(tempFlag == 1)
                {
                    document.getElementById('txtAnotherRegistrationIDSection').style.display = "none";
					document.getElementById('cmbShortlistedSection').style.display = "";
					document.getElementById('cmbIntrestedProfileSection').style.display = "none";
                }
                else
                {
                    document.getElementById('txtAnotherRegistrationIDSection').style.display = "none";
					document.getElementById('cmbShortlistedSection').style.display = "none";
					document.getElementById('cmbIntrestedProfileSection').style.display = "";
                }
            }  
		</script>
<?php 
	$this->load->view('layout/jsfiles');
?>