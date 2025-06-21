<?php 
	$this->load->view('layout/header');
?>
<style>
			.theme-bg
			{
				background-color:#971a1e;
			}

			.login-form
			{
				background:#ffffff;
				padding:25px;
				border-radius: 8px;

			}
			
		</style>
<?php 
	$this->load->view('layout/menu');
?>							
							<section class="slice-lg has-bg-cover bg-size-cover" style="background-image: url(<?php echo base_url('assets/uploads/images/loginbanner.jpg'); ?>); background-position: bottom bottom;">
								<span class="mask mask-dark--style-2"></span>
								<div class="container">
									<div class="row cols-xs-space align-items-center text-center text-md-left">
										<div class="col-lg-6 col-md-6 ml-auto mr-auto">
											<div class="form-card login-form">
												<div class="form-body">
													<div class="text-center px-2">
														<h4 class="heading heading-4 mb-3"  style="border-bottom: 3px solid #971a1e; padding-bottom: 10px">Register Now</h4>
													</div>
													<form class="form-default mt-4" id="register_form" method="post" action="<?php echo site_url('profileregistration'); ?>">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">First Name </label>
																	<input type="text" class="form-control form-control-sm" name="txtFirstName" value="" autofocus>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Surname</label>
																	<input type="text" class="form-control form-control-sm" name="txtLastName" value="">
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
																	<input type="email" class="form-control form-control-sm" name="txtEmail" value="">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Date of birth</label>
																	<input type="date" class="form-control form-control-sm" name="dtpDateOfBirth" value="">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Mobile</label>
																	<input type="number" class="form-control form-control-sm" name="txtMobile" value="">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
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
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Password</label>
																	<input type="password" class="form-control form-control-sm" name="txtPassword">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group has-feedback">
																	<label class="control-label">Re-enter password</label>
																	<input type="password" class="form-control form-control-sm" name="txtConfirmPassword">
																</div>
															</div>
														</div>

														<div class="mt-1 col-12">
															<div class="checkbox">
																<input type="checkbox" checked="checked" name="rbtnAccept" id="rbtnAccept" value="1">
																<label for="remember_me"><small class="c-gray-light">I agree to the <a href="<?php echo site_url('termsandconditions'); ?>" class="c-gray-light">terms and conditions </a>and have read and understood the <a href="<?php echo site_url('privacypolicy'); ?>" class="c-gray-light">privacy policy </a></small></label>
															</div>
															<!--<small class="c-gray-light">I agree to the <a href="terms_and_conditions.php" class="c-gray-light">terms and conditions </a>and have read and understood the <a href="terms_and_conditions.php" class="c-gray-light">privacy policy </a></small>-->
															<div class="mt-2" style="color: #ccc !important"></div>
															<style>
																p{
																	margin: 0px;
																	font-size: 12px;
																	color: red;
																}
															</style>
														</div>
														<div class="col-12 text-center">
															<button type="submit" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom mt-2" style="width: 100%">
															Register Now </button>

														</div>
													</form>
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