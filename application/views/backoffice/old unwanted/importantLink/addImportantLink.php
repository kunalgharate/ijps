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
			
			if(isset($importantLinkResult))
			{
				$formHeading    = "Edit Important Link";
				$buttonName     = "Update";
				$url            = 'importantLink/ImportantLinkController/updateImportantLink';
			   
			}
			else
			{
				$formHeading    = "Add Important Link";
				$buttonName     = "Save";
				$url            = 'importantLink/ImportantLinkController/insertImportantLink';
			}
			//print_r($importantLinkResult);exit;
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
									<a class="text-muted"> Important Link</a>
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
														<input class="form-control" type="hidden" name="txtImportantLinkID" value="<?php
																																if(isset($importantLinkResult))
																																{
																																	echo $importantLinkResult[0]['importantLinkID'];
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
																															if(isset($importantLinkResult))
																															{
																																echo $importantLinkResult[0]['heading'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<!--
											<div class="col-lg-12">
												<div class="form-group">
													<label>Description
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($importantLinkResult))
															{
																$description  = $importantLinkResult[0]['description'];
															}
															else
															{
																$description  ="";
															}
														?>
														<textarea class="form-control" name="txtDescription" rows="6" required><?php echo $description; ?></textarea>
													</div>
												</div>
											</div>-->
											<div class="col-lg-12">
												<div class="form-group">
													<label>URL
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtURL" value="<?php
																															if(isset($importantLinkResult))
																															{
																																echo $importantLinkResult[0]['URL'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="rbtnLinkTypeSection">
										        <div class="form-group">
													<div class="radio-inline">
														<?php
															$checked0 = "checked='checked'";
															$checked1 = "";
															
															if(isset($importantLinkResult))
															{
																if($importantLinkResult[0]['linkType'] == '0')
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
													    <label class="radio">
															<input type="radio" <?php echo $checked0; ?> name="rbtnLinkType" id="rbtnLinkType-0" value='0'>
															<span></span>Internal
														</label>
														<label class="radio">
															<input type="radio" <?php echo $checked1; ?> name="rbtnLinkType" id="rbtnLinkType-1" value='1'>
															<span></span>External
														</label>
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

		<!--Js for date picker start-->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/crud/forms/widgets/bootstrap-datepicker7a50.js?v=7.2.7'); ?>"></script>
		<!--Js for date picker end-->
	</body>
</html>