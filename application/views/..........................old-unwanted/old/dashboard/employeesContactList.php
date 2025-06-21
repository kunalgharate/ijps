		<?php 
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu');
			
			$urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$segments = explode('/', $urlArray);
			$numSegments = count($segments); 
			$currentSegment = $segments[$numSegments - 2];
		?>
		<!--Main Content Start-->
		<style>
		    @media (max-width: 991.98px)
		    {
            .dash {
                max-width: none;
                padding: 80px 15px;
                vertical-align: middle;
            }
		    }
			
			.font-size-lg {
				font-size: 1.05rem;
			}
		</style>
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Employees Contact List </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Employees Contact List</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="d-flex align-items-center">
					</div>
				</div>
			</div>
			<!-- page heading end-->
			
			<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
				<div class="d-flex flex-column-fluid">
					<div class="container-fluid">
						<div class="d-flex flex-row">
							<div class="flex-column offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
								<div class="card card-custom gutter-b shadow-box">
									<div class="card-header border-0 pt-5">
										<h3 class="card-title align-items-start flex-column mb-2">
											<span class="card-label font-weight-bolder text-dark mb-1">Search</span>
										</h3>
										<form class="d-flex flex-center bg-white rounded mb-5" method="post" action="<?php echo site_url('searchEmployees'); ?>" enctype="multipart/form-data">
											<i class="fas fa-search"></i>
											<input type="text" class="form-control border-0 font-weight-bold pl-2" placeholder="Search Employee" name="txtSearch" required/>
											<button type="submit" class="btn btn-primary font-weight-bolder mr-2 px-8 btn-sm">GO</button>
										</form>
									</div>
								</div>
								<div class="card card-custom gutter-b shadow-box">
									<div class="card-body">
										<form method="post" action="<?php echo site_url('filterEmployees'); ?>" enctype="multipart/form-data">
											<div class="form-group mb-5">
												<label class="font-size-h5 font-weight-bolder text-dark mb-7">Departments</label>
												<!--
												<div class="checkbox-list">
													<?php
														for($j = 0; $j < count($departmentResult); $j++)
														{
													?>
															<label class="checkbox checkbox-lg mb-7">
																<input type="checkbox" name="chkDepartment[]" value="<?php echo $departmentResult[$j]['departmentID']; ?>"/>
																<span></span>
																<div class="font-size-lg text-dark-75 font-weight-bold">
																	<?php echo $departmentResult[$j]['departmentName']; ?>
																</div>
																<!--<div class="ml-auto text-muted font-weight-bold">28</div>--
															</label>
													<?php
														}
													?>
												</div>-->
												<div class="custom-file">
													<select name="cmbDepartmentID" id="cmbDepartmentID" class="form-control form-control-round">
															<option value="0" selected>-- ALL --</option>
															<?php 
																 for($i = 0; $i < count($departmentResult); $i++)
																{
																	if($departmentResult[$i]['departmentID'] == $postResult[0]['departmentID'])
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
											<div class="form-group mb-3">
												<label class="font-size-h5 font-weight-bolder text-dark mb-3">Employee Type</label>
												<!--
												<div class="radio-list">
													<?php
														for($k = 0; $k < count($employeeTypeResult); $k++)
														{
													?>
															<label class="radio radio-sm mb-2">
																<input type="radio" name="rbtnEmployeeType" value="<?php echo $employeeTypeResult[$k]['employeeTypeID']; ?>"/>
																<span></span>
																<div class="font-size-lg text-dark-75 font-weight-bold">
																	<?php echo $employeeTypeResult[$k]['employeeTypeName']; ?>
																</div>
																<!--<div class="ml-auto text-muted font-weight-bold">2047</div>--
															</label>
													<?php
														}
													?>
												</div>
												-->
												<div class="custom-file">
													<select name="cmbEmployeeTypeID" id="cmbEmployeeTypeID" class="form-control form-control-round">
															<option value="0" selected>-- ALL --</option>
															<?php 
																 for($i = 0; $i < count($employeeTypeResult); $i++)
																{
																	if($employeeTypeResult[$i]['employeeTypeID'] == $postResult[0]['employeeTypeID'])
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
											<button type="submit" class="btn btn-primary font-weight-bolder mr-2 px-8 btn-sm">Filter</button>
											<button type="reset" class="btn btn-clear font-weight-bolder text-muted px-8 btn-sm">Clear</button>
										</form>
									</div>
								</div>
							</div>
							<div class="flex-row-fluid ml-lg-8">
								<!--<div class="card card-custom card-stretch gutter-b">
									<div class="card-body">-->
										<div class="row">
											<?php	
												if(count($employeeResult) > 0)
												{
													for($i=0; $i < count($employeeResult); $i++)
													{
											?>
														<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 p-1">
															<div class="card card-custom gutter-b shadow-box">
																<div class="card-header-right">
																	<div class="shadow-box pr-5 pl-5">
																		<div class="d-flex align-items-center pt-4 mb-3">
																			<div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
																				<div class="symbol symbol-circle symbol-lg-75">
																					<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$employeeResult[$i]['photo']; ?>" alt="image" />
																				</div>
																				<div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
																					<span class="font-size-h3 font-weight-boldest">JM</span>
																				</div>
																			</div>
																			<div class="d-flex flex-column">
																				<a class="text-dark font-weight-bold text-hover-primary font-size-lg mb-0">
																					<?php /*echo $employeeResult[$i]['fullName'];*/ ?>
																					<?php
																						if(strlen($employeeResult[$i]['fullName'])>24)
																						{
																					?>
																							<div data-container="body" data-toggle="tooltip" data-placement="right" title="<?php echo $employeeResult[$i]['fullName']; ?>"><?php echo strip_tags(substr($employeeResult[$i]['fullName'], 0, 22))."..."; ?></div>
																					<?php
																						}
																						else
																						{
																					?>
																							<div><?php echo $employeeResult[$i]['fullName']; ?></div>
																					<?php
																						}
																					?>
																				</a>
																				<?php
																					if(strlen($employeeResult[$i]['designationName'])>30)
																					{
																				?>
																						<span class="text-muted font-weight-bold font-size-sm" data-container="body" data-toggle="tooltip" data-placement="right" title="<?php echo $employeeResult[$i]['designationName']; ?>"><?php echo strip_tags(substr($employeeResult[$i]['designationName'], 0, 29))."..."; ?></span>
																				<?php
																					}
																					else
																					{
																				?>
																						<span class="text-muted font-weight-bold font-size-sm"><?php echo $employeeResult[$i]['designationName']; ?></span>
																				<?php
																					}
																				?>
																				
																				<span class="text-muted font-weight-bold font-size-xs">(<?php echo $employeeResult[$i]['departmentName']; ?>)</span>
																			</div>
																		</div>
																		<div class="mb-4">
																			<div class="d-flex align-items-center">
																				<span class="text-dark-75 font-weight-bolder font-size-sm mr-2">Email :</span>
																				
																				<?php
																					if(strlen($employeeResult[$i]['emailAddress'])>36)
																					{
																				?>
																						<span class="text-muted text-hover-primary font-size-sm" data-container="body" data-toggle="tooltip" data-placement="right" title="<?php echo $employeeResult[$i]['emailAddress']; ?>">
																							<?php echo strip_tags(substr($employeeResult[$i]['emailAddress'], 0, 34))."..."; ?>
																						</span>
																				<?php
																					}
																					else
																					{
																				?>
																						<span class="text-muted text-hover-primary font-size-sm">
																							<?php echo $employeeResult[$i]['emailAddress']; ?>
																						</span>
																				<?php
																					}
																				?>
																			</div>
																			<div class="d-flex align-items-cente my-1">
																				<span class="text-dark-75 font-weight-bolder mr-2 font-size-sm">Phone :</span>
																				<span class="text-muted text-hover-primary font-size-sm"><?php echo $employeeResult[$i]['contactNumber']; ?></span>
																			</div>
																			<div class="d-flex align-items-center">
																				<span class="text-dark-75 font-weight-bolder mr-2 font-size-sm">Landline :</span>
																				<span class="text-muted font-weight-bold font-size-sm"><?php echo $employeeResult[$i]['landlineNumber']; ?></span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
											<?php
													}
												}
												else
												{
											?>		
														<div class="col-xl-12 col-lg-6 col-md-6 col-sm-6">
															<div class="card card-custom gutter-b card-stretch">
																<div class="card-body text-center pt-4">
																	<span class="text-dark font-weight-bold text-hover-primary font-size-h4 text-center align-middle">
																		No Data Found...
																	</span>
																</div>
															</div>
														</div>
											<?php
												}
											?>
										</div>
									<!--</div>
								</div>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>