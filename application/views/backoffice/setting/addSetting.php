		<?php 
			$this->load->view(BACKOFFICE.'layout/header');
		?>
			<style>
				.fileUpload
				{
					width: 100%;
					padding: 0.4rem 1rem;
					overflow: hidden;
					line-height: 1.5;
					color: #3f4254;
					background-color: #fff;
					border: 1px solid #e4e6ef;
					border-radius: .42rem;
				}
				
				#previewA img { max-width: 250px; }
				#previewB img { max-width: 250px; }
				#previewC img { max-width: 150px; }
			</style>
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			if(isset($settingResult))
			{
				$formHeading    = "Edit Settings";
				$buttonName     = "Update";
				$url            = 'setting/SettingController/updateSetting';
			}
			else
			{
				redirect(BACKOFFICE.SETTING, 'refresh');
			}
		?>
		
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content" onload="myFunction()">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> <?php echo $formHeading; ?></h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url(BACKOFFICE.'dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Blog</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"><?php echo $formHeading; ?></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="d-flex align-items-center">
					</div>
				</div>
			</div>
			<!-- page heading end-->
			<div class="d-flex flex-column-fluid">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title"><?php echo $formHeading; ?></h3>
								</div>
								<form method="post" action="<?php echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data" onload ="test();">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label>Email Address
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtMailID" value="<?php
																															if(isset($settingResult))
																															{
																																echo $settingResult[0]['mailID'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Phone Number
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtPhoneNumber" value="<?php
																															if(isset($settingResult))
																															{
																																echo $settingResult[0]['phoneNumber'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Facebook Link
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtFacebookLink" value="<?php
																															if(isset($settingResult))
																															{
																																echo $settingResult[0]['facebookLink'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Twitter Link
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtTwitterLink" value="<?php
																															if(isset($settingResult))
																															{
																																echo $settingResult[0]['twitterLink'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Instagram Link
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtInstagramLink" value="<?php
																															if(isset($settingResult))
																															{
																																echo $settingResult[0]['instagramLink'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Linkedin Link
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtLinkedinLink" value="<?php
																															if(isset($settingResult))
																															{
																																echo $settingResult[0]['linkedInLink'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtAddressSection">
												<div class="form-group">
													<label>Address
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($settingResult))
															{
																$officeAddress1  = $settingResult[0]['officeAddress1'];
															}
															else
															{
																$officeAddress1  ="";
															}
														?>
														<textarea class="form-control" name="txtAddress" rows="6" required><?php echo $officeAddress1; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="txtlightLogoSection">
												<div class="form-group">
													<label>Admin Logo
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtlightLogo" value="<?php
																															if(isset($settingResult))
																															{
																																echo $settingResult[0]['lightLogo'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtlightLogo" name="txtlightLogo" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesA'>
														<?php 
															
															if(isset($settingResult) && $settingResult[0]['lightLogo'] != "")
															{																
																echo "<a href='".base_url().UPLOAD_LOGOS.$settingResult[0]['lightLogo']."' target='_BLANK'>
																		<img alt='image' src='".base_url().UPLOAD_LOGOS.$settingResult[0]['lightLogo']."' width='250px'>
																	</a><h6>Previous Image</h6>";
															}
														?>
														</div>
														<div id="previewA"></div>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="txtdarkLogoSection">											
												<div class="form-group">
													<label>Website Logo
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtdarkLogo" value="<?php
																															if(isset($settingResult))
																															{
																																echo $settingResult[0]['darkLogo'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtdarkLogo" name="txtdarkLogo" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesB'>
														<?php
															
															if(isset($settingResult) && $settingResult[0]['darkLogo'] != "")
															{																
																echo "<a href='".base_url().UPLOAD_LOGOS.$settingResult[0]['darkLogo']."' target='_BLANK'>
																		<img alt='image' src='".base_url().UPLOAD_LOGOS.$settingResult[0]['darkLogo']."' width='250px'>
																	</a><h6>Previous Image</h6>";
															}
														?>
														</div>
														<div id="previewB"></div>
													</div>
												</div>
											</div> 
											<div class="col-lg-4" id="txtFaviconSection">											
												<div class="form-group">
													<label>Footer Logo
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtFavicon" value="<?php
																															if(isset($settingResult))
																															{
																																echo $settingResult[0]['favicon'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtFavicon" name="txtFavicon" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesC'>
														<?php
															
															if(isset($settingResult) && $settingResult[0]['favicon'] != "")
															{																
																echo "<a href='".base_url().UPLOAD_LOGOS.$settingResult[0]['favicon']."' target='_BLANK'>
																		<img alt='image' src='".base_url().UPLOAD_LOGOS.$settingResult[0]['favicon']."' width='150px'>
																	</a><h6>Previous Image</h6>";
															}
														?>
														</div>
														<div id="previewC"></div>
													</div>
												</div>
											</div> 
										</div>
									</div>
									<div class="card-footer" id="buttonSubmit">
										<button type="submit" class="btn btn-primary mr-2"><?php echo $buttonName; ?></button>
										<!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
									</div>
								</form>
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</div>
		
		<!--Main Content End-->
		
		<?php 
			$this->load->view(BACKOFFICE.'layout/footer');
			$this->load->view(BACKOFFICE.'layout/jsfiles');
		?>
		
		
		<script>
			const preview = (file) => {
										document.querySelector('#previewA').innerHTML = "";
										document.querySelector('#PreviousImagesA').innerHTML = "";
										
										const fr = new FileReader();
										fr.onload = () => {
																const img = document.createElement("img");
																img.src = fr.result;  // String Base64 
																img.alt = file.name;
																document.querySelector('#previewA').append(img);
															};
														fr.readAsDataURL(file);
													};

			document.querySelector("#txtlightLogo").addEventListener("change", (ev) => {
				if (!ev.target.files) return; // Do nothing.
					[...ev.target.files].forEach(preview);
				});
		</script>
		
		<script>
			const preview1 = (file) => {
										document.querySelector('#previewB').innerHTML = "";
										document.querySelector('#PreviousImagesB').innerHTML = "";
										
										const fr = new FileReader();
										fr.onload = () => {
																const img = document.createElement("img");
																img.src = fr.result;  // String Base64 
																img.alt = file.name;
																document.querySelector('#previewB').append(img);
															};
														fr.readAsDataURL(file);
													};

			document.querySelector("#txtdarkLogo").addEventListener("change", (ev) => {
				if (!ev.target.files) return; // Do nothing.
					[...ev.target.files].forEach(preview1);
				});
		</script>
		
		<script>
			const preview2 = (file) => {
										document.querySelector('#previewC').innerHTML = "";
										document.querySelector('#PreviousImagesC').innerHTML = "";
										
										const fr = new FileReader();
										fr.onload = () => {
																const img = document.createElement("img");
																img.src = fr.result;  // String Base64 
																img.alt = file.name;
																document.querySelector('#previewC').append(img);
															};
														fr.readAsDataURL(file);
													};

			document.querySelector("#txtFavicon").addEventListener("change", (ev) => {
				if (!ev.target.files) return; // Do nothing.
					[...ev.target.files].forEach(preview2);
				});
		</script>
		
	</body>
</html>