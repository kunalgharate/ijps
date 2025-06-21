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
			
			if(isset($employeeResult))
			{
				$formHeading    = "Edit Employee";
				$buttonName     = "Update";
				$url            = 'employee/EmployeeController/updateEmployee';
			}
			else
			{
				$formHeading    = "Add Employee";
				$buttonName     = "Save";
				$url            = 'employee/EmployeeController/insertEmployee';
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
									<a class="text-muted"> Employee</a>
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
														<input class="form-control" type="hidden" name="txtEmployeeID" value="<?php
																																if(isset($employeeResult))
																																{
																																	echo $employeeResult[0]['employeeID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-lg-4" id="cmbDepartmentIDSection">
										        <div class="form-group">
													<label>Company
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbCompanyID" id="cmbCompanyID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($companyResult); $i++)
																	{
    																		if($companyResult[$i]['companyID'] == $employeeResult[0]['companyID'])
    																		{
    																			echo "<option value=".$companyResult[$i]['companyID']." selected>".$companyResult[$i]['companyName']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$companyResult[$i]['companyID'].">".$companyResult[$i]['companyName']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="cmbDepartmentIDSection">
										        <div class="form-group">
													<label>Department
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbDepartmentID" id="cmbDepartmentID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($departmentResult); $i++)
																	{
    																		if($departmentResult[$i]['departmentID'] == $employeeResult[0]['departmentID'])
    																		{
    																			echo "<option value=".$departmentResult[$i]['departmentID']." selected>".$departmentResult[$i]['departmentName']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$departmentResult[$i]['departmentID'].">".$departmentResult[$i]['departmentName']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
										    <div class="col-lg-4">
												<div class="form-group">
													<label>Employee Name
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtEmployeeName" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['employeeName'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Approval Authority
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtApprovalAuthority" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['approvalAuthority'];
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
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['contactNumber'];
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
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['alternateContactNumber'];
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
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['email'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Budget
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="number" name="txtBudget" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['budget'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
											</div>
											<div class="col-lg-6" id="txtPermanentAddressSection">
												<div class="form-group">
													<label>Permanent Address
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($employeeResult))
															{
																$permanentAddress  = $employeeResult[0]['permanentAddress'];
															}
															else
															{
																$permanentAddress  ="";
															}
														?>
														<textarea class="form-control" name="txtPermanentAddress" rows="6" required><?php echo $permanentAddress; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="txtResidentialAddressSection">
												<div class="form-group">
													<label>Residential Address
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($employeeResult))
															{
																$residentialAddress  = $employeeResult[0]['residentialAddress'];
															}
															else
															{
																$residentialAddress  ="";
															}
														?>
														<textarea class="form-control" name="txtResidentialAddress" rows="6" required><?php echo $residentialAddress; ?></textarea>
													</div>
												</div>
											</div>
											
											<div class="col-lg-4" id="txtAadharCardImageSection">
											    <div class="form-group">
													<label>Aadhar Card
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtAadharCardImage" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['aadharCardImage'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtAadharCardImage" name="txtAadharCardImage" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesA'>
														<?php
                                                            
                                                            if(isset($employeeResult) && $employeeResult[0]['aadharCardImage'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['aadharCardImage']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['aadharCardImage']."' width='100px'>
                                                                    </a><h6>Previous Image</h6>";
                                                            }
                                                        ?>
														</div>
														<div id="previewA"></div>
													</div>
												</div>
											</div> 
											<div class="col-lg-4" id="txtPanCardImageSection">
											    <div class="form-group">
													<label>PAN Card
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtPanCardImage" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['panCardImage'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtPanCardImage" name="txtPanCardImage" accept="image/jpeg, image/jpg, image/png"  />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesP'>
														<?php
                                                            
                                                            if(isset($employeeResult) && $employeeResult[0]['panCardImage'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['panCardImage']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['panCardImage']."' width='100px'>
                                                                    </a><h6>Previous Image</h6>";
                                                            }
                                                        ?>
														</div>
														<div id="previewP"></div>
													</div>
												</div>
											</div> 
											<div class="col-lg-4" id="txtPassportImageSection">
											    <div class="form-group">
													<label>Passport
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtPassportImage" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['passportImage'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtPassportImage" name="txtPassportImage" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesPP'>
														<?php
                                                            
                                                            if(isset($employeeResult) && $employeeResult[0]['passportImage'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['passportImage']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['passportImage']."' width='100px'>
                                                                    </a><h6>Previous Image</h6>";
                                                            }
                                                        ?>
														</div>
														<div id="previewPP"></div>
													</div>
												</div>
											</div> 
											<div class="col-lg-4" id="txtPassportImageSection">
											    <div class="form-group">
													<label>VISA
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtVisaImage" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['visaImage'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtVisaImage" name="txtVisaImage" accept="image/jpeg, image/jpg, image/png"  />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesV'>
														<?php
                                                            
                                                            if(isset($employeeResult) && $employeeResult[0]['visaImage'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['visaImage']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['visaImage']."' width='100px'>
                                                                    </a><h6>Previous Image</h6>";
                                                            }
                                                        ?>
														</div>
														<div id="previewV"></div>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="txtTravelInsuranceImageSection">
											    <div class="form-group">
													<label>Travel Insurance
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtTravelInsuranceImage" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['travelInsuranceImage'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtTravelInsuranceImage" name="txtTravelInsuranceImage" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesTI'>
														<?php
                                                            
                                                            if(isset($employeeResult) && $employeeResult[0]['travelInsuranceImage'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['travelInsuranceImage']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_EMPLOYEE.$employeeResult[0]['travelInsuranceImage']."' width='100px'>
                                                                    </a><h6>Previous Image</h6>";
                                                            }
                                                        ?>
														</div>
														<div id="previewTI"></div>
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
																document.querySelector('#preview').append(img);
															};
														fr.readAsDataURL(file);
													};

			document.querySelector("#txtAadharCardImage").addEventListener("change", (ev) => {
				if (!ev.target.files) return; // Do nothing.
					[...ev.target.files].forEach(preview);
				});
		</script>
		<script>
			const preview = (file) => {
										document.querySelector('#previewP').innerHTML = "";
										document.querySelector('#PreviousImagesP').innerHTML = "";
										
										const fr = new FileReader();
										fr.onload = () => {
																const img = document.createElement("img");
																img.src = fr.result;  // String Base64 
																img.alt = file.name;
																document.querySelector('#preview').append(img);
															};
														fr.readAsDataURL(file);
													};

			document.querySelector("#txtPanCardImage").addEventListener("change", (ev) => {
				if (!ev.target.files) return; // Do nothing.
					[...ev.target.files].forEach(preview);
				});
		</script>
		
	</body>
</html>