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
										<div class="col-lg-4 col-md-6 ml-auto mr-auto">
											<div class="form-card login-form">
												<div class="form-body">
													<div class="text-center px-2">
														<h4 class="heading heading-4 mb-3"  style="border-bottom: 3px solid #971a1e; padding-bottom: 10px">Login</h4>
													</div>
													<form class="form-default" role="form" method="post" action="<?php echo site_url('login/authenticateUser'); ?>" >
														<div class="row">
															<div class="col-12">
																<div class="form-group">
																	<label>Email</label>
																	<input type="email" class="form-control input-sm" name="txtUserName" autofocus required>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group has-feedback">
																	<label>Password</label>
																	<input type="password" class="form-control input-sm" name="txtPassword" required>
																</div>
															</div>
														</div>
														<button type="submit" class="btn btn-styled btn-sm btn-block btn-base-1 z-depth-2-bottom mt-2">Login</button>
														<div class="row pt-3">
															<div class="col-6" >
																<div class="checkbox">
																	<input type="checkbox" name="remember_me" id="remember_me" value="checked">
																	<label for="remember_me"><span class="c-gray-light" style="font-size: 12px;">Remember me</span></label>
																</div>
															</div>
															<div class="col-6 text-right" style="font-size: 12px;">
																<a href="<?php echo site_url('forgetpassword'); ?>" class="c-gray-light">Forgot password ?</a>
															</div>
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