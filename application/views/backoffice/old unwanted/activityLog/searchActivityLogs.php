		<?php 
			$this->load->view(BACKOFFICE.'layout/header');
		?>
			
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			$formHeading    = "Search Activity Logs";
			$buttonName     = "Search Data";
			$url            = SHOW_DATA_ACTIVITY_LOG_WITH_FILTER;
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
									<a class="text-muted"> Activity Logs</a>
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
											<div class="col-lg-12" id="rbtnWebsiteLogSection">
										        <div class="form-group">
													<div class="radio-inline">
													    <label class="radio">
															<input type="radio" checked="checked" name="rbtnWebsiteLog" id="rbtnWebsiteLog-0" value='0' onclick="logWebsiteFlagEvent(this);">
															<span></span>Employee Front Website Log
														</label>
														<label class="radio">
															<input type="radio" name="rbtnWebsiteLog" id="rbtnWebsiteLog-1" value='1' onclick="logWebsiteFlagEvent(this);">
															<span></span>Admin/HR Log
														</label>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="cmbBackofficeUserSection">
										        <div class="form-group">
													<label>Backoffice User
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbBackofficeUser" id="cmbBackofficeUser" class="form-control form-control-round" required>
																<?php 
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($userResult); $i++)
																	{
    																		echo "<option value=".$userResult[$i]['userID'].">".$userResult[$i]['userFullName']."(".$userResult[$i]['userName'].")</option>";
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="cmbActivityLabelSection">
										        <div class="form-group">
													<label>Backoffice Activity Label
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbActivityLabel" id="cmbActivityLabel" class="form-control form-control-round" required>
															<option value='0' selected>-- ALL --</option>
															<option value='Login Admin/HR'>Login Admin/HR</option>
															<option value='Signout Admin/HR'>Signout Admin/HR</option>
															<option value='Emergency contact category'>Emergency Contact Category</option>
															<option value='Emergency contact'>Emergency Contact</option>
															<option value='Important link'>Important Link</option>
															<option value='Company Video'>Company Video</option>
															<option value='Department'>Department</option>
															<option value='Designation'>Designation</option>
															<option value='Employee type'>Employee Type</option>
															<option value='Bank Data'>Bank Data</option>
															<option value='Post'>Post </option>
															<option value='Company Presentation Template'>Company Presentation Template</option>
															<option value='Job post'>Job Post</option>
															<option value='Holiday'>Holiday</option>
															<option value='Employee'>Employee</option>
															<option value='Guest'>Guest</option>
															<option value='Photo Gallery Category'>Photo Gallery Category</option>
															<option value='Photo Gallery'>Photo Gallery</option>
														</select>
													</div>
												</div>
											</div>

											<div class="col-lg-6" id="cmbWebsiteUserSection">
										        <div class="form-group">
													<label>Website User
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbWebsiteUser" id="cmbWebsiteUser" class="form-control form-control-round" required>
																<?php 
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($websiteUserResult); $i++)
																	{
    																		echo "<option value=".$websiteUserResult[$i]['employeeID'].">".$websiteUserResult[$i]['employeeCode']." - ".$websiteUserResult[$i]['fullName']."</option>";
																	}
																?>
														</select>
													</div>
												</div>
											</div>

											<div class="col-lg-6" id="cmbWebsiteActivityLabelSection">
												<div class="form-group">
													<label>Website Activity Label
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbWebsiteActivityLabel" id="cmbWebsiteActivityLabel" class="form-control form-control-round" required>
															<option value='0' selected>-- ALL --</option>
															<option value='Login Employee'>Login Employee</option>
															<option value='Signout Employee'>Signout Employee</option>
															<option value='Sizes : Added/Updated'>Sizes Added/Updated</option>
															<option value='Job Application'>Job Application</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="rbtnLogPeriodFlagSection">
										        <div class="form-group">
													<div class="radio-inline">
													    <label class="radio">
															<input type="radio" checked="checked" name="rbtnLogPeriodFlag" id="rbtnLogPeriodFlag-0" value='0' onclick="logPeriodFlagEvent(this);">
															<span></span>Today's Log
														</label>
														<label class="radio">
															<input type="radio" name="rbtnLogPeriodFlag" id="rbtnLogPeriodFlag-1" value='1' onclick="logPeriodFlagEvent(this);">
															<span></span>Last 5 Day's Log
														</label>
														<label class="radio">
															<input type="radio" name="rbtnLogPeriodFlag" id="rbtnLogPeriodFlag-2" value='2' onclick="logPeriodFlagEvent(this);">
															<span></span>Specific Period Log
														</label>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOf‎FromSection">
											    <div class="form-group">
													<label>From Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															$todayDate = date("d-m-Y");
														?>
														<input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfFrom" readonly="readonly" placeholder="Select date" name="dtpDateOfFrom" value="<?php echo $todayDate; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOfToSection">
											    <div class="form-group">
													<label>To Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfTo" readonly="readonly" placeholder="Select date" name="dtpDateOfTo" value="<?php echo $todayDate; ?>" required>
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
				$('#dtpDateOfFrom').datepicker({
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
				$('#dtpDateOfTo').datepicker({
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
		<script>
			document.getElementById('dtpDateOf‎FromSection').style.display = "none";
			document.getElementById('dtpDateOfToSection').style.display = "none";
					
			function logPeriodFlagEvent(myRadio) {
                var logFlag = myRadio.value;
                
                if(logFlag == 2)
                {
                    document.getElementById('dtpDateOf‎FromSection').style.display = "";
					document.getElementById('dtpDateOfToSection').style.display = "";
                }
                else
                {
                    document.getElementById('dtpDateOf‎FromSection').style.display = "none";
					document.getElementById('dtpDateOfToSection').style.display = "none";
                }
            } 
		</script>
		<script>
			
			document.getElementById('cmbBackofficeUserSection').style.display = "none";
			document.getElementById('cmbActivityLabelSection').style.display = "none";

			document.getElementById('cmbWebsiteUserSection').style.display = "";
			document.getElementById('cmbWebsiteActivityLabelSection').style.display = "";

			function logWebsiteFlagEvent(myRadio) {
                var logFlag = myRadio.value;
                
                if(logFlag == 0)
                {
					document.getElementById('cmbBackofficeUserSection').style.display = "none";
					document.getElementById('cmbActivityLabelSection').style.display = "none";

					document.getElementById('cmbWebsiteUserSection').style.display = "";
					document.getElementById('cmbWebsiteActivityLabelSection').style.display = "";
                }
                else
                {
                    document.getElementById('cmbBackofficeUserSection').style.display = "";
					document.getElementById('cmbActivityLabelSection').style.display = "";

					document.getElementById('cmbWebsiteUserSection').style.display = "none";
					document.getElementById('cmbWebsiteActivityLabelSection').style.display = "none";
                }
            } 
		</script>

		<!--Js for date picker start-->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/crud/forms/widgets/bootstrap-datepicker7a50.js?v=7.2.7'); ?>"></script>
		<!--Js for date picker end-->
	</body>
	
</html>