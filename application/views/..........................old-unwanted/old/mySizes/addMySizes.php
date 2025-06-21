		<?php 
			$this->load->view('layout/header');
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
			$this->load->view('layout/sidemenu');
			
			if(isset($employeeResult))
			{
				$formHeading    = "Show/Add/Update My Sizes";
				$buttonName     = "Add/Update";
				$url            = 'mySizes/MySizesController/updateMySizes';
			   
			}
			else
			{
				$formHeading    = "Add My Sizes";
				$buttonName     = "Save";
				$url            = 'mySizes/MySizesController/insertMySizes';
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
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> My Sizes</a>
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
									<div class="card-toolbar">
									<?php
										if($flag == '0')
										{
									?>
								    	<a href="<?php echo site_url('mySizesEdit'); ?>" class="btn btn-primary font-weight-bolder">
											Edit									
										</a>
									<?php
										}
									?>
									</div>
								</div>
								<form method="post" action="<?php echo site_url($url); ?>" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtEmployeeID" value="<?php
																																echo $_SESSION['employeeID'];
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<div class="custom-file">
														<label>
															<strong>Your Name : </strong><?php	echo $_SESSION['employeeFullName'];	?>
														</label>
													</div>
													<div class="custom-file">
														<label>
															<strong>Gender : </strong><?php	
																							if($employeeResult[0]['genderFlag']== '0')
																							{
																								echo "Male";
																							}
																							else if($employeeResult[0]['genderFlag']== '1')
																							{
																								echo "Female";
																							}
																					?>
														</label>
													</div>
												</div>
											</div>
										<?php
											if($flag == '1')
											{
										?>
											<div class="col-lg-3" id="cmbShoeSizeIDSection">
										        <div class="form-group">
													<label>Shoe Size</label>
													<div class="custom-file">
														<select name="cmbShoeSizeID" id="cmbShoeSizeID" class="form-control form-control-round">
															<option value="0" selected> --- Select ---</option>
																<?php 
																	 for($i = 0; $i < count($shoeSizeResult); $i++)
																	{
    																		if($shoeSizeResult[$i]['shoeSizeID'] == $employeeResult[0]['shoeSizeID'])
    																		{
    																			echo "<option value=".$shoeSizeResult[$i]['shoeSizeID']." selected>".$shoeSizeResult[$i]['brandSize']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$shoeSizeResult[$i]['shoeSizeID'].">".$shoeSizeResult[$i]['brandSize']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbTShirtSizeIDSection">
										        <div class="form-group">
													<label>T-Shirt Size</label>
													<div class="custom-file">
														<select name="cmbTShirtSizeID" id="cmbTShirtSizeID" class="form-control form-control-round">
																<option value="0" selected> --- Select ---</option>
																<?php 
																	 for($i = 0; $i < count($tShirtSizeResult); $i++)
																	{
    																		if($tShirtSizeResult[$i]['tShirtSizeID'] == $employeeResult[0]['tShirtSizeID'])
    																		{
    																			echo "<option value=".$tShirtSizeResult[$i]['tShirtSizeID']." selected>".$tShirtSizeResult[$i]['brandSize']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$tShirtSizeResult[$i]['tShirtSizeID'].">".$tShirtSizeResult[$i]['brandSize']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbShirtSizeIDSection">
										        <div class="form-group">
													<label>Shirt Size</label>
													<div class="custom-file">
														<select name="cmbShirtSizeID" id="cmbShirtSizeID" class="form-control form-control-round">
															<option value="0" selected> --- Select ---</option>
															<?php 
																	 for($i = 0; $i < count($shirtSizeResult); $i++)
																	{
    																		if($shirtSizeResult[$i]['shirtSizeID'] == $employeeResult[0]['shirtSizeID'])
    																		{
    																			echo "<option value=".$shirtSizeResult[$i]['shirtSizeID']." selected>".$shirtSizeResult[$i]['brandSize']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$shirtSizeResult[$i]['shirtSizeID'].">".$shirtSizeResult[$i]['brandSize']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbPantSizeIDSection">
										        <div class="form-group">
													<label>Pant Size</label>
													<div class="custom-file">
														<select name="cmbPantSizeID" id="cmbPantSizeID" class="form-control form-control-round">
															<option value="0" selected> --- Select ---</option>
															<?php 
																	 for($i = 0; $i < count($pantSizeResult); $i++)
																	{
    																		if($pantSizeResult[$i]['pantSizeID'] == $employeeResult[0]['pantSizeID'])
    																		{
    																			echo "<option value=".$pantSizeResult[$i]['pantSizeID']." selected>".$pantSizeResult[$i]['brandSize']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$pantSizeResult[$i]['pantSizeID'].">".$pantSizeResult[$i]['brandSize']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
										<?php
											}
											else
											{
										?>
											<div class="col-lg-3">
										        <div class="form-group">
													<label><strong>Shoe Size : </strong>
													<?php 
														$message =" - ";
														
														 for($i = 0; $i < count($shoeSizeResult); $i++)
														{
																if($shoeSizeResult[$i]['shoeSizeID'] == $employeeResult[0]['shoeSizeID'])
																{
																	$message = $shoeSizeResult[$i]['brandSize'];
																} 
														}
														echo $message;
													?>
													</label>
												</div>
											</div>
											<div class="col-lg-3">
										        <div class="form-group">
													<label><strong>T-Shirt Size : </strong>
													<?php 
														$message =" - ";
														
														 for($i = 0; $i < count($tShirtSizeResult); $i++)
														{
																if($tShirtSizeResult[$i]['tShirtSizeID'] == $employeeResult[0]['tShirtSizeID'])
																{
																	$message = $tShirtSizeResult[$i]['brandSize'];
																} 
														}
														echo $message;
													?>
													</label>
												</div>
											</div>
											<div class="col-lg-3">
										        <div class="form-group">
													<label><strong>Shirt Size : </strong>
													<?php 
														$message =" - ";
														
														 for($i = 0; $i < count($shirtSizeResult); $i++)
														{
																if($shirtSizeResult[$i]['shirtSizeID'] == $employeeResult[0]['shirtSizeID'])
																{
																	$message = $shirtSizeResult[$i]['brandSize'];
																} 
														}
														echo $message;
													?>
													</label>
												</div>
											</div>
											<div class="col-lg-3">
										        <div class="form-group">
													<label><strong>Pant Size : </strong>
													<?php 
														$message =" - ";
														
														 for($i = 0; $i < count($pantSizeResult); $i++)
														{
																if($pantSizeResult[$i]['pantSizeID'] == $employeeResult[0]['pantSizeID'])
																{
																	$message = $pantSizeResult[$i]['brandSize'];
																} 
														}
														echo $message;
													?>
													</label>
												</div>
											</div>
											
										<?php
											}
										?>
										</div>
									</div>
									<div class="card-footer" id="buttonSubmit">
										<?php
											if($flag == '1')
											{
										?>
										<button type="submit" class="btn btn-primary mr-2"><?php echo $buttonName; ?></button>
										<?php
											}
										?>
										<!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-12">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title">Size Guide</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<?php
											for($k=0; $k < 4; $k++)
											{
												if($k==0)
												{
													$headerArray	= array('shoeSizeID', 'brandSize', 'UKIndia', 'EU', 'USA', 'lengthInCM');
													$tableColumns	= array('Shoe Size ID', 'Brand Size', 'UK India', 'EU', 'USA', 'Length In CM');
													$result			= $shoeSizeResult;
													$heading 		= "Size Chart (Shoe)";
												}
												else if($k==1)
												{
													$headerArray 	= array('tShirtSizeID', 'brandSize', 'standardSize', 'chest', 'shoulder', 'length', 'sleeveLength', 'waist');
													$tableColumns 	= array('T-Shirt Size ID', 'Brand Size', 'Standard Size', 'Chest', 'Shoulder', 'Length', 'Sleeve Length', 'Waist');
													$result			= $tShirtSizeResult;
													$heading 		= "Size Chart (T-Shirt)";
												}
												else if($k==2)
												{
													$headerArray 	= array('shirtSizeID', 'brandSize', 'size', 'chest', 'shoulder', 'length', 'sleeveLength');
													$tableColumns 	= array('Shirt Size ID', 'Brand Size', 'Size', 'Chest', 'Shoulder', 'Length', 'Sleeve Length');
													$result			= $shirtSizeResult;
													$heading 		= "Size Chart (Shirt)";
												}
												else if($k==3)
												{
													$headerArray 	= array('pantSizeID', 'brandSize', 'waist', 'hip');
													$tableColumns 	= array('Pant Size ID', 'Brand Size', 'Qaist', 'Hip');
													$result			= $pantSizeResult;
													$heading 		= "Size Chart (Pant)";
												}
										?>
												<div class="col-lg-6 mb-10">
													<div class="card-header1">
														<h5 class="card-title">
															<strong><?php echo $heading; ?></strong>
														</h5>
													</div>
													<div class="table-responsive">
														<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
															<thead>
																<tr class="text-left text-uppercase">
																	<?php
																		$arraySize = count($headerArray);
																		
																		for($i=1; $i < $arraySize; $i++)
																		{
																			echo "<th>".$tableColumns[$i]."</th>";
																		}
																	?>
																</tr>
															</thead>
															<tbody>
										<?php
																$countHeader = count($headerArray);
													
																for($i=0; $i < count($result); $i++)
																{ 	
																	echo "<tr>";
																		for($j=1; $j < $countHeader; $j++)
																		{
																			echo "<td>".$result[$i][$headerArray[$j]]."</td>";
																		}
																	echo "</tr>";
																}
										?>
															</tbody>
														</table>
													</div>
													<!--end::Table-->
												</div>
										
										<?php
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!--Main Content End-->
		
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		
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