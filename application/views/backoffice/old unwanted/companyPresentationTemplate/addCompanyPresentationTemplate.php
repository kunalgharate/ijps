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
			
			if(isset($companyPresentationTemplateResult))
			{
				$formHeading    = "Edit Company Presentation Template";
				$buttonName     = "Update";
				$url            = 'companyPresentationTemplate/CompanyPresentationTemplateController/updateCompanyPresentationTemplate';
			   
			}
			else
			{
				$formHeading    = "Add Company Presentation Template";
				$buttonName     = "Save";
				$url            = 'companyPresentationTemplate/CompanyPresentationTemplateController/insertCompanyPresentationTemplate';
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
									<a class="text-muted"> Company Presentation Template</a>
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
														<input class="form-control" type="hidden" name="txtCompanyPresentationTemplateID" value="<?php
																																if(isset($companyPresentationTemplateResult))
																																{
																																	echo $companyPresentationTemplateResult[0]['companyPresentationTemplateID'];
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
																															if(isset($companyPresentationTemplateResult))
																															{
																																echo $companyPresentationTemplateResult[0]['heading'];
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
															if(isset($companyPresentationTemplateResult))
															{
																$description  = $companyPresentationTemplateResult[0]['shortDescription'];
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
											<div class="col-lg-12">
											    <div class="form-group">
													<label>Upload File
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtUploadFile" value="<?php
																															if(isset($companyPresentationTemplateResult))
																															{
																																echo $companyPresentationTemplateResult[0]['uploadFile'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtUploadFile" name="txtUploadFile" accept=".zip,.rar,.7z,.gz">
														<span class="form-text text-muted mb-5">Allowed file types: .zip,.rar,.7z,.gz</span>
														
														<?php
                                                            
                                                            if(isset($companyPresentationTemplateResult) && $companyPresentationTemplateResult[0]['uploadFile'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_POST_COMPANY_PRESENTATION_TEMPLATES.$companyPresentationTemplateResult[0]['uploadFile']."' target='_BLANK'>
                                                                        Click Here To See
                                                                    </a><h6>Previous ZIP</h6>";
                                                            }
                                                        ?>
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
		<!--Js for date picker start-->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/crud/forms/widgets/bootstrap-datepicker7a50.js?v=7.2.7'); ?>"></script>
		<!--Js for date picker end-->
	</body>
</html>