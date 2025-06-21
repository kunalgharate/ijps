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
				
				#preview img { max-width: 100px; }
			</style>
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			if(isset($companyResult))
			{
				$formHeading    = "Edit Company";
				$buttonName     = "Update";
				$url            = 'company/CompanyController/updateCompany';
			}
			else
			{
				$formHeading    = "Add Company";
				$buttonName     = "Save";
				$url            = 'company/CompanyController/insertCompany';
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
									<a class="text-muted"> Company</a>
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
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtCompanyID" value="<?php
																																if(isset($companyResult))
																																{
																																	echo $companyResult[0]['companyID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
										    <div class="col-lg-12">
												<div class="form-group">
													<label>Company Name
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtCompanyName" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['companyName'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="txtRegisteredOfficeAddressSection">
												<div class="form-group">
													<label>Registered Office Address
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($companyResult))
															{
																$registeredOfficeAddress  = $companyResult[0]['registeredOfficeAddress'];
															}
															else
															{
																$registeredOfficeAddress  ="";
															}
														?>
														<textarea class="form-control" name="txtRegisteredOfficeAddress" rows="6" required><?php echo $registeredOfficeAddress; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="txtOfficeAddressSection">
												<div class="form-group">
													<label>Office Address
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($companyResult))
															{
																$officeAddress  = $companyResult[0]['officeAddress'];
															}
															else
															{
																$officeAddress  ="";
															}
														?>
														<textarea class="form-control" name="txtOfficeAddress" rows="6" required><?php echo $officeAddress; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>GSTIN
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtGSTIN" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['GSTIN'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>PAN
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtPAN" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['PAN'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>TIN
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtTIN" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['TIN'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Contact Number
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="number" name="txtContactNumber" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['contactNumber'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Alternate Contact Number
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="number" name="txtAlternateContactNumber" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['alternateContactNumber'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Email
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtEmail" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['email'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Contact Person Name
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtContactPersonName" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['contactPersonName'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Contact Person Email
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtContactPersonEmail" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['contactPersonEmail'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Contact Person Contact Number
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="number" name="txtContactPersonContactNumber" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['contactPersonContactNumber'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Contact Person Alternate Contact Number
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="number" name="txtContactPersonAlternateContactNumber" value="<?php
																															if(isset($companyResult))
																															{
																																echo $companyResult[0]['contactPersonAlternateContactNumber'];
																															}
																														?>" required>
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