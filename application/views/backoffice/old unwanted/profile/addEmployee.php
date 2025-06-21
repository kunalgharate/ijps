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
			//print_r($employeeResult);exit;
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
						<div class="col-md-3">
						</div>
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
											<div class="col-lg-4" id="cmbHealthPackageIDSection">
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
											<div class="col-lg-4" id="cmbHealthPackageIDSection">
										        <div class="form-group">
													<label>Designation
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbDesignationID" id="cmbDesignationID" class="form-control form-control-round" required>
															<option value='0' selected> --- Select Designation  ---</option>
																<?php /*
																	 for($i = 0; $i < count($designationResult); $i++)
																	{
    																		if($designationResult[$i]['designationID'] == $employeeResult[0]['designationID'])
    																		{
    																			echo "<option value=".$designationResult[$i]['designationID']." selected>".$designationResult[$i]['designationName']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$designationResult[$i]['designationID'].">".$designationResult[$i]['designationName']."</option>";
    																		}
																	}*/
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="cmbEmployeeTypeIDSection">
										        <div class="form-group">
													<label>Employee Type
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbEmployeeTypeID" id="cmbEmployeeTypeID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($employeeTypeResult); $i++)
																	{
    																		if($employeeTypeResult[$i]['designationID'] == $employeeResult[0]['designationID'])
    																		{
    																			echo "<option value=".$employeeTypeResult[$i]['employeeTypeID']." selected>".$employeeTypeResult[$i]['employeeTypeName']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$employeeTypeResult[$i]['employeeTypeID'].">".$employeeTypeResult[$i]['employeeTypeName']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
										    <div class="col-lg-4">
												<div class="form-group">
													<label>Full Name
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtFullName" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['fullName'];
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
													<label>Landline Number
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtLandlineNumber" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['landlineNumber'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOf‎BirthSection">
											    <div class="form-group">
													<label>‎Birth Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															
															$dateOf‎Birth = date("d-m-Y");
															
															if(isset($employeeResult))
															{
																$dateOf‎Birth = strtotime(date($employeeResult[0]['dateOf‎Birth']));
																$dateOf‎Birth = date("d-m-Y", $dateOf‎Birth);
															}
														?>
														<input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOf‎Birth" readonly="readonly" placeholder="Select date" name="dtpDateOf‎Birth" value="<?php echo $dateOf‎Birth; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOf‎JoiningSection">
											    <div class="form-group">
													<label>Joining Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															
															$dateOfJoining = date("d-m-Y");
															
															if(isset($employeeResult))
															{
																$dateOfJoining = strtotime(date($employeeResult[0]['dateOfJoining']));
																$dateOfJoining = date("d-m-Y", $dateOfJoining);
															}
														?>
														<input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOf‎Joining" readonly="readonly" placeholder="Select date" name="dtpDateOf‎Joining" value="<?php echo $dateOfJoining; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Email
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="email" name="txtEmail" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['emailAddress'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="txtAddressSection">
											    <div class="form-group">
													<label for="exampleTextarea">Address  
													<span class="text-danger">*</span></label>
													<?php
														if(isset($employeeResult))
														{
															$address  = $employeeResult[0]['address'];
														}
														else
														{
															$address  ="";
														}
													?>
													<textarea class="form-control" name="txtAddress" rows="5" cols="80" required><?php echo $address; ?></textarea>
												</div>
											</div>
											<div class="col-lg-6" id="txtImageSection">
											    <div class="form-group">
													<label>Photo
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtPhoto" value="<?php
																															if(isset($employeeResult))
																															{
																																echo $employeeResult[0]['photo'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtPhoto" name="txtPhoto" accept="image/jpeg, image/jpg, image/png"/>
														<span class="form-text text-muted mb-5">(Dimensions : 400 X 400)</span>
														<?php
                                                            
                                                            if(isset($employeeResult) && $employeeResult[0]['photo'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_EMPLOYEE_PHOTO.$employeeResult[0]['photo']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_EMPLOYEE_PHOTO.$employeeResult[0]['photo']."' width='100px'>
                                                                    </a><h6>Previous Image</h6>";
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
		
		<script type="text/javascript">
		$(document).ready(function(){
 
            $('#cmbDepartmentID').change(function(){  
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url(BACKOFFICE.'employee/EmployeeController/getDesignationsAsPerDepartment');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        //var html = '';
                        var html = '<option value="0" selected> --- Select Designation  ---</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].designationID+'>'+data[i].designationName+'</option>';
                        }
                        $('#cmbDesignationID').html(html);
 
                    }
                });
                return false;
            }); 
             
        });
        </script>
		
		<script>
			var KTBootstrapDatepicker = function () {

				var arrows;
				if (KTUtil.isRTL()) {
					arrows = {
						leftArrow: '<i class="la la-angle-right"></i>',
						rightArrow: '<i class="la la-angle-left"></i>'
					}
				} else {
					arrows = {
					leftArrow: '<i class="la la-angle-left"></i>',
					rightArrow: '<i class="la la-angle-right"></i>'
					}
				}

				// minimum setup for modal demo
				$('#dtpDateOf‎Birth').datepicker({
					rtl: KTUtil.isRTL(),
					todayHighlight: true,
					orientation: "bottom left",
					templates: arrows,
					autoclose: true
				});

				return {
					// public functions
					init: function() {
						demos();
					}
				};
			}();

			jQuery(document).ready(function() {
				KTBootstrapDatepicker.init();
			});
			
			var KTBootstrapDatepicker = function () {

				var arrows;
				if (KTUtil.isRTL()) {
					arrows = {
						leftArrow: '<i class="la la-angle-right"></i>',
						rightArrow: '<i class="la la-angle-left"></i>'
					}
				} else {
					arrows = {
					leftArrow: '<i class="la la-angle-left"></i>',
					rightArrow: '<i class="la la-angle-right"></i>'
					}
				}

				// minimum setup for modal demo
				$('#dtpDateOf‎Joining').datepicker({
					rtl: KTUtil.isRTL(),
					todayHighlight: true,
					orientation: "bottom left",
					templates: arrows,
					autoclose: true
				});

				return {
					// public functions
					init: function() {
						demos();
					}
				};
			}();

			jQuery(document).ready(function() {
				KTBootstrapDatepicker.init();
			});
		</script>
		
		
		<!--Js for date picker start-->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/crud/forms/widgets/bootstrap-datepicker7a50.js?v=7.2.7'); ?>"></script>
		<!--Js for date picker end-->
	</body>
</html>