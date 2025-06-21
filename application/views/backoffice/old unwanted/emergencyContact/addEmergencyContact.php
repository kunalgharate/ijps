		<?php 
			$this->load->view(BACKOFFICE.'layout/header'); //print_r($knowledgeCentrePostCategoryResult); exit;
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
			
			if(isset($emergencyContactResult))
			{
				$formHeading    = "Edit Emergency Contact";
				$buttonName     = "Update";
				$url            = 'emergencyContact/EmergencyContactController/updateEmergencyContact';
			   
			}
			else
			{
				$formHeading    = "Add Emergency Contact";
				$buttonName     = "Save";
				$url            = 'emergencyContact/EmergencyContactController/insertEmergencyContact';
			}
			//print_r($emergencyContactResult);exit;
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
									<a class="text-muted"> Emergency Contact</a>
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
														<input class="form-control" type="hidden" name="txtEmergencyContactID" value="<?php
																																if(isset($emergencyContactResult))
																																{
																																	echo $emergencyContactResult[0]['emergencyContactID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12" id="cmbHealthPackageIDSection">
										        <div class="form-group">
													<label>Emergency Contact Category
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbEmergencyContactCategoryID" id="cmbEmergencyContactCategoryID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($emergencyContactCategoryResult); $i++)
																	{
    																		if($emergencyContactCategoryResult[$i]['emergencyContactCategoryID'] == $emergencyContactResult[0]['emergencyContactCategoryID'])
    																		{
    																			echo "<option value=".$emergencyContactCategoryResult[$i]['emergencyContactCategoryID']." selected>".$emergencyContactCategoryResult[$i]['name']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$emergencyContactCategoryResult[$i]['emergencyContactCategoryID'].">".$emergencyContactCategoryResult[$i]['name']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
										    <div class="col-lg-12">
												<div class="form-group">
													<label>Title
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtTitle" value="<?php
																															if(isset($emergencyContactResult))
																															{
																																echo $emergencyContactResult[0]['title'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Contact Number
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="number" name="txtContactNumber" value="<?php
																															if(isset($emergencyContactResult))
																															{
																																echo $emergencyContactResult[0]['contactNumber'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<!--
											<div class="col-lg-12" id="txtImageSection">
											    <div class="form-group">
													<label>Image
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtImage" value="<?php
																															if(isset($emergencyContactResult))
																															{
																																echo $emergencyContactResult[0]['image'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtImage" name="txtImage" accept="image/jpeg, image/jpg, image/png"/>
														<span class="form-text text-muted mb-5">(Dimensions : 250 X 250)</span>
														<?php
                                                            
                                                            if(isset($emergencyContactResult) && $emergencyContactResult[0]['image'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_EMERGENCY_CONTACT.$emergencyContactResult[0]['image']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_EMERGENCY_CONTACT.$emergencyContactResult[0]['image']."' width='100px'>
                                                                    </a><h6>Previous Image</h6>";
                                                            }
                                                        ?>
														
													</div>
												</div>
											</div> -->
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
		
	</body>
</html>