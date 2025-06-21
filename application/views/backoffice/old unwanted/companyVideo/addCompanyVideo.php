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
			</style>
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			if(isset($companyVideoResult))
			{
				$formHeading    = "Edit Company Video";
				$buttonName     = "Update";
				$url            = 'companyVideo/CompanyVideoController/updateCompanyVideo';
			   
			}
			else
			{
				$formHeading    = "Add Company Video";
				$buttonName     = "Save";
				$url            = 'companyVideo/CompanyVideoController/insertCompanyVideo';
			}

		?>
		
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
									<a class="text-muted"> Company Video</a>
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
						<div class="col-md-3">
						</div>
						<div class="col-md-6">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title"><?php echo $formHeading; ?></h3>
								</div>
								<form method="post" action="<?php echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtCompanyVideoID" value="<?php
																																if(isset($companyVideoResult))
																																{
																																	echo $companyVideoResult[0]['companyVideoID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<label>Heading
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtHeading" value="<?php
																															if(isset($companyVideoResult))
																															{
																																echo $companyVideoResult[0]['heading'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Description
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($companyVideoResult))
															{
																$description  = $companyVideoResult[0]['description'];
															}
															else
															{
																$description  ="";
															}
														?>
														<textarea class="form-control" name="txtDescription" rows="6" required><?php echo $description; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="rbtnVideoTypeFlagSection">
												<?php
													$checked0 = "checked='checked'";
													$checked1 = "";

													if(isset($companyVideoResult))
													{
														if($companyVideoResult[0]['videoTypeFlag'] == '0')
														{
															$checked0 = "checked='checked'";
															$checked1 = "";
														}
														else
														{
															$checked1 = "checked='checked'";
															$checked0 = "";
														}
													}
												?>
										        <div class="form-group">
													<div class="radio-inline">
													    <label class="radio">
															<input type="radio" <?php echo $checked0; ?> name="rbtnVideoTypeFlag" id="rbtnVideoTypeFlag-0" value='0' onclick="videoTypeFlagEvent(this);">
															<span></span>YouTube Video
														</label>
														<label class="radio">
															<input type="radio" <?php echo $checked1; ?> name="rbtnVideoTypeFlag" id="rbtnVideoTypeFlag-1" value='1' onclick="videoTypeFlagEvent(this);">
															<span></span>Local Video
														</label>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtVideoURLSection">
												<div class="form-group">
													<label>Video URL
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtVideoURL" value="<?php
																															if(isset($companyVideoResult))
																															{
																																echo $companyVideoResult[0]['videoURL'];
																															}
																														?>">
													</div>
													<span class="form-text text-muted">YouTube video embed link</span>
												</div>
											</div>
											<div class="col-lg-12" id="txtVideoURLUploadSection">
											    <div class="form-group">
													<label>Choose Video File
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtVideoURLUpload">
														<input type="file" class="fileUpload" id="txtVideoURLUpload" name="txtVideoURLUpload" accept="video/mp4">
													</div>
													<span class="form-text text-muted">Allowed file types: mp4 only</span>
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
						<div class="col-md-3">
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
			document.getElementById('txtVideoURLUploadSection').style.display = "none";
			
			function videoTypeFlagEvent(myRadio) 
			{
				var videoTypeFlag = myRadio.value;
            
				if(videoTypeFlag == 1)
				{   
					document.getElementById('txtVideoURLSection').style.display = "none";
					document.getElementById('txtVideoURLUploadSection').style.display = "";
				}
				else
				{
					document.getElementById('txtVideoURLSection').style.display = "";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
				}
            } 
		</script>
		<?php
			if(isset($companyVideoResult))
			{
				if($companyVideoResult[0]['videoTypeFlag']=="0")
				{
		?>
					<script type='text/javascript'> 
						document.getElementById('txtVideoURLSection').style.display = "";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
					</script>
		<?php
				}
				else if($companyVideoResult[0]['videoTypeFlag']=="1")
				{
		?>
					<script type='text/javascript'> 
						document.getElementById('txtVideoURLSection').style.display = "none";
						document.getElementById('txtVideoURLUploadSection').style.display = "";
					</script>
		<?php
				}
			}
		?>
		<!--Js for date picker start-->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/crud/forms/widgets/bootstrap-datepicker7a50.js?v=7.2.7'); ?>"></script>
		<!--Js for date picker end-->
	</body>
</html>