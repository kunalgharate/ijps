		<?php 
			$this->load->view(BACKOFFICE.'layout/header'); //print_r($knowledgeCentrePostCategoryResult); exit;
		?>
			
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			$formHeading    = "Search Job Applications";
			$buttonName     = "Search Data";
			$url            = SHOW_DATA_JOB_APPLICATIONS;
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
									<a class="text-muted"> Job Post</a>
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
								<form method="post" action="<?php echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtDesignationID" value="<?php
																																if(isset($designationResult))
																																{
																																	echo $designationResult[0]['designationID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6" id="cmbJobPostIDSection">
										        <div class="form-group">
													<label>Job Post Title
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbJobPostID" id="cmbJobPostID" class="form-control form-control-round" required>
																<?php 
																	
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($jobPostResult); $i++)
																	{
    																	echo "<option value=".$jobPostResult[$i]['jobPostID'].">".$jobPostResult[$i]['jobTitle']."</option>";
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="cmbEmployeeIDSection">
										        <div class="form-group">
													<label>Employee
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbEmployeeID" id="cmbEmployeeID" class="form-control form-control-round" required>
																<?php 
																	
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($employeeResult); $i++)
																	{
    																	echo "<option value=".$employeeResult[$i]['employeeID'].">".$employeeResult[$i]['fullName']."</option>";
																	}
																?>
														</select>
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
	</body>
</html>