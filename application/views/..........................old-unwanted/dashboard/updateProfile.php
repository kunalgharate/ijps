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
												<h1 class="h2 text-white">Update my profile</h1>
											</div>
											<!-- Breadcrumb -->
											<nav aria-label="breadcrumb text-white">
												<ol class="breadcrumb breadcrumb-light mb-0">
													<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="<?php echo site_url('home'); ?>">Home</a></li>
													<li class="breadcrumb-item active" aria-current="page">Update my profile</li>
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
										<div class="col-lg-1 col-md-6 col-sm-6 col-xs-12"></div>
										<div class="col-lg-10 col-md-6 col-sm-6 col-xs-12">
											<div class="block block--style-1 profilecardBR2">
												<div class="card card-hover--animation-1 z-depth-2-top z-depth-3--hover home-p-member profilecardBR2">
													<div class="card-body">
														<div class="section-title section-title--style-1 text-center m-0">
															<h3 class="section-title-inner">
																<span>Update my profile</span>
															</h3>
														</div>
														<hr class="fr hr1">
														<form class="form-default mt-4" id="register_form" method="post" action="<?php echo site_url('updateprofilesubmit'); ?>">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">First Name </label>
																	<input type="text" class="form-control form-control-sm" name="txtFirstName" value="<?php echo $profileResult['0']['firstName']; ?>" autofocus>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Middle Name </label>
																	<input type="text" class="form-control form-control-sm" name="txtMiddleName" value="<?php echo $profileResult['0']['middleName']; ?>" autofocus>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label class="control-label">Surname</label>
																	<input type="text" class="form-control form-control-sm" name="txtLastName" value="<?php echo $profileResult['0']['lastName']; ?>">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Gender</label>
																	<select name="cmbGender" onChange="(this.value,this)" class="form-control form-control-sm selectpicker"   data-placeholder="Choose a gender" tabindex="2" data-hide-disabled="true" >
																		<?php 
																			 for($i = 0; $i < count($genderResult); $i++)
																			{
																				echo "<option value=".$genderResult[$i]['genderID'].">".$genderResult[$i]['name']."</option>";
																			}
																		?>
																	</select>                                                                                       
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Email</label>
																	<input type="email" class="form-control form-control-sm" name="txtEmail" value="<?php echo $profileResult['0']['emailAddress']; ?>">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<?php															
																		$dateOf‎Birth = date("d-m-Y");
																		
																		if(isset($profileResult))
																		{
																			$dateOf‎Birth = strtotime(date($profileResult[0]['dateOf‎Birth']));
																			$dateOf‎Birth = date("d-m-Y", $dateOf‎Birth);
																		}
																	?>
																	<label class="control-label">Date of birth</label>
																	<input type="date" class="form-control form-control-sm" name="dtpDateOfBirth" value="<?php echo $dateOf‎Birth; ?>">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Mobile</label>
																	<input type="number" class="form-control form-control-sm" name="txtMobile" value="<?php echo $profileResult['0']['contactNumber']; ?>">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label class="control-label">Introduction</label>
																	<textarea class="form-control form-control-sm" id="txtIntroduction" name="txtIntroduction" rows="4"></textarea>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Behalf of</label>
																	<select name="cmbOnBehalf" onChange="(this.value,this)" class="form-control form-control-sm selectpicker" data-placeholder="Choose a on_behalf" tabindex="2" data-hide-disabled="true" >
																		<?php 
																			 for($i = 0; $i < count($behalfOfResult); $i++)
																			{
																				echo "<option value=".$behalfOfResult[$i]['behalfOfID'].">".$behalfOfResult[$i]['label']."</option>";
																			}
																		?>
																	</select>                                          
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Religion</label>
																	<select name="cmbReligionID" onChange="(this.value,this)" class="form-control form-control-sm selectpicker" data-placeholder="Choose a religion" tabindex="2" data-hide-disabled="true" >
																		<?php 
																			 for($i = 0; $i < count($religionResult); $i++)
																			{
																				echo "<option value=".$religionResult[$i]['religionID'].">".$religionResult[$i]['name']."</option>";
																			}
																		?>
																	</select>                                          
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Mother Tongue</label>
																	<select name="cmbMotherTongue" onChange="(this.value,this)" class="form-control form-control-sm selectpicker" data-placeholder="Choose a on_behalf" tabindex="2" data-hide-disabled="true" >
																		<?php 
																			 for($i = 0; $i < count($motherTongueResult); $i++)
																			{
																				echo "<option value=".$motherTongueResult[$i]['motherTongueID'].">".$motherTongueResult[$i]['name']."</option>";
																			}
																		?>
																	</select>                                          
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Marital Status</label>
																	<select name="cmbMotherTongue" onChange="(this.value,this)" class="form-control form-control-sm selectpicker" data-placeholder="Choose a on_behalf" tabindex="2" data-hide-disabled="true" >
																		<?php 
																			 for($i = 0; $i < count($maritalStatusResult); $i++)
																			{
																				echo "<option value=".$maritalStatusResult[$i]['maritalStatusID'].">".$maritalStatusResult[$i]['maritalStatusName']."</option>";
																			}
																		?>
																	</select>                                          
																</div>
															</div>
														</div>
														
														<div class="col-12 text-center">
															<button type="submit" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom mt-2" style="width: 100%">
															Update </button>

														</div>
													</form>
												
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-1 col-md-6 col-sm-6 col-xs-12"></div>
									</div>
								</div>
							</section>

<?php 
	$this->load->view('layout/footer');
?>
<?php 
	$this->load->view('layout/jsfiles');
?>