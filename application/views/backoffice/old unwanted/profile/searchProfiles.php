		<?php 
			$this->load->view(BACKOFFICE.'layout/header'); //print_r($knowledgeCentrePostCategoryResult); exit;
		?>
			
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			$formHeading    = "Search Profiles";
			$buttonName     = "Search Data";
			$url            = SHOW_DATA_EMPLOYEES_WITH_FILTER;
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
									<a class="text-muted"> Profile</a>
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
										<div class="col-lg-4" id="cmbGenderIDSection">
										        <div class="form-group">
													<label>Gender
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbGenderID" id="cmbGenderID" class="form-control form-control-round" required>
																<?php 
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($genderResult); $i++)
																	{
    																		echo "<option value=".$genderResult[$i]['genderID'].">".$genderResult[$i]['name']."</option>";
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="cmbonBehalfOfIDSection">
										        <div class="form-group">
													<label>On Behalf Of
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbOnBehalfOfID" id="cmbOnBehalfOfID" class="form-control form-control-round" required>
															<option value='0' selected> --- ALL ---</option>
															<?php 
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($onBehalfOfResult); $i++)
																	{
																		echo "<option value=".$onBehalfOfResult[$i]['behalfOfID'].">".$onBehalfOfResult[$i]['label']."</option>";
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="cmbReligionIDSection">
										        <div class="form-group">
													<label>Religion
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbReligionID" id="cmbReligionID" class="form-control form-control-round" required>
																<?php 
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($religionResult); $i++)
																	{
    																	echo "<option value=".$religionResult[$i]['religionID'].">".$religionResult[$i]['name']."</option>";
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="rbtnEmployeeFilterFlagSection">
										        <div class="form-group">
													<div class="radio-inline">
													    <label class="radio">
															<input type="radio" checked="checked" name="rbtnEmployeeFilterFlag" id="rbtnEmployeeFilterFlag-0" value='0'>
															<span></span>Working + Ex Employees
														</label>
														<label class="radio">
															<input type="radio" name="rbtnEmployeeFilterFlag" id="rbtnEmployeeFilterFlag-1" value='1'>
															<span></span>Working Employees
														</label>
														<label class="radio">
															<input type="radio" name="rbtnEmployeeFilterFlag" id="rbtnEmployeeFilterFlag-2" value='2'>
															<span></span>EX Employees
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
                        var html = '<option value="0" selected> --- ALL ---</option>';
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
	</body>
</html>