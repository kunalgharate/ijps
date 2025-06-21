		<?php
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu');
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
		</style>
		<div class="content pt-0 d-flex flex-column flex-column-fluid mt-n16" id="kt_content">
			<!--begin::Hero-->
			<div class="d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url('<?php echo base_url('assetsbackoffice/img/banner.png'); ?>')">
				<div class="container">
					<div class="d-flex align-items-stretch text-center flex-column py-40">
						<!--begin::Heading-->
						<h1 class="text-dark font-weight-bolder mb-12 pt-40 pb-40"></h1>
						<!--end::Heading-->
					</div>
				</div>
			</div>
			<!--end::Hero-->
			<div class="container mt-n35">
				<!--begin::Card-->
				<div class="card mb-8">
					<!--begin::Body-->
					<div class="card-body p-10">
						<div class="p-6">
							<div class="row">
								<div class="col-lg-12 text-center">
									<img alt="Logo" class="text-center" src="http://localhost/thyssenkrupp/assetsbackoffice/uploads/logo/Primary_Logo.png" height="120px">
									<h2 class="font-weight-bolder font-size-h1 text-center mb-5 mt-5">Rothe Erde India Pvt. Ltd.</h2><!--text-dark-65-->
								</div>
							</div>
						</div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Item-->
			</div>
			
			<?php
				if(count($guestResult)>0)
				{
			?>
			<div class="d-flex flex-column-fluid mt-25">
				<div class="container">
				<!--
					<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $guestHeading; ?></h2>
					<div class="separator separator-solid mb-5"></div>-->
					
					<div class="row">
						<div class="col-xl-4">
						</div>
						<div class="col-xl-4">
							<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $guestHeading; ?></h2>
						</div>
						<div class="col-xl-4 text-right">
							<!--<a href="<?php echo base_url()."guest"; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>-->
						</div>
						<div class="col-xl-12">
							<div class="separator separator-solid mb-5"></div>
						</div>
					</div>
					
					<div class="row">
						<?php							
							for($i=0; $i < count($guestResult); $i++)
							{
						?>
								<div class="col-xl-12 col-lg-6 col-md-6 col-sm-6">
									<div class="card card-custom gutter-b card-stretch shadow-box1">
										<div class="card-body text-center pt-4">
											<div class="mt-7">
												<div class="symbol symbol-circle symbol-lg-150">
													<img src="<?php echo base_url().UPLOAD_GUEST_PHOTO.$guestResult[$i]['photo']; ?>" alt="image">
												</div>
											</div>
											<div class="my-2">
												<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $guestResult[$i]['guestFullName']; ?></span>
												<p>(<?php echo $guestResult[$i]['designationName']; ?>)</p>
											</div>
											<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold">
												<?php echo date('d M Y', strtotime($guestResult[$i]['visitDate'])); ?>
											</span>
											<div class="my-2 mt-3">
												<p><?php echo $guestResult[$i]['introduction']; ?></p>
											</div>
										</div>
									</div>
								</div>
						<?php
							}
						?>
						
						<div class="col-xl-12">
							<div class="separator separator-solid mb-5"></div>
						</div>
						
					</div>
				</div>
			</div>
			<?php
				}
			?>
			
			<div class="container mt-25">
				<!--begin::Card-->
				<div class="card mb-8">
					<!--begin::Body-->
					<div class="card-body p-10">
						<div class="p-6">
							<div class="row">
								<div class="col-lg-12">
									<h2 class="text-center mb-5">About us</h2>
									<h5 class="text-center mb-5">Lorem Ipsum is simply dummy text of the printing.</h5>
									<div class="separator separator-solid mb-5"></div>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled...
									<div class="mt-9 text-center">
										<a href="<?php echo base_url()."aboutUS/"; ?>" class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase">Read More...</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Item-->
			</div>
		
		</div>
		<!--end::Content-->
		<div class="d-flex flex-column-fluid mt-25">
			<div class="container">
				<!--
				<h2 class="font-weight-bolder font-size-h3 text-center mb-5">Emergency Contacts</h2>
				<div class="separator separator-solid mb-5"></div>-->
				
				<div class="row">
					<div class="col-xl-4">
					</div>
					<div class="col-xl-4">
						<h2 class="font-weight-bolder font-size-h3 text-center mb-5">Emergency Contacts</h2>
					</div>
					<div class="col-xl-4 text-right">
						<?php
							if($emergencyContactCategoryCount > 3)
							{
						?>
								<a href="<?php echo base_url()."emergencyContacts"; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>
						<?php
							}
						?>
					</div>
					<div class="col-xl-12">
						<div class="separator separator-solid mb-5"></div>
					</div>
				</div>
				<div class="row">
					<?php							
						for($i=0; $i < count($emergencyContactCategoryResult); $i++)
						{
					?>
							<div class="col-xl-4">
								<div class="card card-custom card-stretch gutter-b shadow-box">
									<div class="card-header border-5 pt-5">
										<h3 class="card-title align-items-start flex-column">
											<span class="card-label font-weight-bolder text-dark"><?php echo $emergencyContactCategoryResult[$i]['name']; ?></span>
											<!--<span class="text-muted mt-3 font-weight-bold font-size-sm">Pending 10 tasks</span>-->
										</h3>
									</div>
									<div class="card-body pt-8">
					<?php							
										$dataResult = $emergencyContactResult[$emergencyContactCategoryResult[$i]['emergencyContactCategoryID']];
										
										for($j=0; $j < count($dataResult); $j++)
										{
					?>
											<div class="d-flex align-items-center mb-10">
												<div class="symbol symbol-40 symbol-light-white mr-5">
													<div class="symbol-label">
														<img src="<?php echo base_url().UPLOAD_EMERGENCY_CONTACT.$dataResult[$j]['image']; ?>" class="h-75 align-self-end" alt="<?php echo $dataResult[$j]['title']; ?>">
													</div>
												</div>
												<div class="d-flex flex-column font-weight-bold">
													<a href="tel:<?php echo $dataResult[$j]['contactNumber']; ?>" class="text-dark text-hover-primary mb-1 font-size-lg">
														<?php echo $dataResult[$j]['title']; ?>
													</a>
													<a href="tel:<?php echo $dataResult[$j]['contactNumber']; ?>">
														<span class="text-muted"><?php echo $dataResult[$j]['contactNumber']; ?></span>
													</a>
												</div>
											</div>
					<?php
										}
					?>
									</div>
								</div>
							</div>
					<?php
						}
						
						if(count($emergencyContactCategoryResult) == '0')
						{
							echo $noDataAvailable;
						}
					?>
				</div>
			</div>
		</div>
		
		<?php
			if(count($todaysBirthdayResult)>0)
			{
		?>
		<div class="d-flex flex-column-fluid mt-25">
			<div class="container">
			<!--
				<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $todaysBirthdayHeading; ?></h2>
				<div class="separator separator-solid mb-5"></div>-->
				
				<div class="row">
					<div class="col-xl-4">
					</div>
					<div class="col-xl-4">
						<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $todaysBirthdayHeading; ?></h2>
					</div>
					<div class="col-xl-4 text-right">
						<?php
							$count = 0;
							
							if(count($todaysBirthdayResult) > 4)
							{
								$count = 4;
						?>
								<a href="<?php echo base_url()."todaysBirthday"; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>
						<?php
							}
							else
							{
								$count = count($todaysBirthdayResult);
							}
						?>
						
					</div>
					<div class="col-xl-12">
						<div class="separator separator-solid mb-5"></div>
					</div>
				</div>
				
				<div class="row">
					<?php							
						for($i=0; $i < $count; $i++)
						{
					?>
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
								<div class="card card-custom gutter-b card-stretch shadow-box">
									<div class="card-header-right ribbon ribbon-clip ribbon-left">
										<div class="ribbon-target" style="top: 12px;">
											<span class="ribbon-inner bg-brand"></span><?php echo date('d M', strtotime($todaysBirthdayResult[$i]['dateOf‎Birth'])); ?>
										</div>
										<div class="card-body text-center pt-4">
											<div class="mt-7">
												<div class="symbol symbol-circle symbol-lg-150">
													<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$todaysBirthdayResult[$i]['photo']; ?>" alt="image">
												</div>
											</div>
											<div class="my-2">
												<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $todaysBirthdayResult[$i]['fullName']; ?></span>
												<p><?php echo $todaysBirthdayResult[$i]['departmentName']; ?></p>
											</div>
											<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold"><?php echo $todaysBirthdayResult[$i]['designationName']; ?></span>
											<div class="mt-9 mb-6">
												<a href="tel:<?php echo $todaysBirthdayResult[$i]['contactNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fas fa-mobile-alt"></i>
												</a>
												<a href="tel:<?php echo $todaysBirthdayResult[$i]['landlineNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fa fa-phone-alt"></i>
												</a>
											</div>
											<?php
												/*
												if($todaysBirthdayResult[$i]['contactNumber']!= "")
												{
											?>
													<div class="mt-5 mb-5">
														<a href="tel:<?php echo $todaysBirthdayResult[$i]['contactNumber']; ?>" class="btn btn-md btn-icon btn-light-facebook btn-pill mx-2">
															<i class="fas fa-mobile-alt"></i>
														</a>
														<?php echo $todaysBirthdayResult[$i]['contactNumber']; ?>
													</div>
																	
											<?php
												}
												
												if($todaysBirthdayResult[$i]['landlineNumber']!= "")
												{
											?>
													<div class="mt-5 mb-5">
														<a href="tel:<?php echo $todaysBirthdayResult[$i]['landlineNumber']; ?>" class="btn btn-md btn-icon btn-light-facebook btn-pill mx-2">
															<i class="fa fa-phone-alt"></i>
														</a>
														<?php echo $todaysBirthdayResult[$i]['landlineNumber']; ?>
													</div>
											<?php
												}
												
												if($todaysBirthdayResult[$i]['emailAddress']!= "")
												{
											?>
													<div class="mt-5 mb-5" data-container="body" data-toggle="tooltip" data-placement="top" title="<?php echo $todaysBirthdayResult[$i]['emailAddress']; ?>">
														<a href="mailto:<?php echo $todaysBirthdayResult[$i]['emailAddress']; ?>" class="btn btn-md btn-icon btn-light-facebook btn-pill mx-2">
															<i class="fa fa-envelope"></i>
														</a>
														<?php echo strip_tags(substr($todaysBirthdayResult[$i]['emailAddress'], 0, 20))."..."; ?>
													</div>
											<?php
												}*/
											?>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		<?php
			}
			
			if(count($upcomingBirthdayResult)>0)
			{
		?>
		<div class="d-flex flex-column-fluid mt-25">
			<div class="container">
			<!--
				<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $upcomingBirthdayHeading; ?></h2>
				<div class="separator separator-solid mb-5"></div>-->
				
				<div class="row">
					<div class="col-xl-4">
					</div>
					<div class="col-xl-4">
						<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $upcomingBirthdayHeading; ?></h2>
					</div>
					<div class="col-xl-4 text-right">
						<?php
							$count = 0;
							
							if(count($upcomingBirthdayResult) > 4)
							{
								$count = 4;
						?>
								<a href="<?php echo base_url()."upcomingBirthday"; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>
						<?php
							}
							else
							{
								$count = count($upcomingBirthdayResult);
							}
						?>
						
					</div>
					<div class="col-xl-12">
						<div class="separator separator-solid mb-5"></div>
					</div>
				</div>
				
				<div class="row">
					<?php							
						for($i=0; $i < $count; $i++)
						{
					?>
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
								<div class="card card-custom gutter-b card-stretch shadow-box">
									<div class="card-header-right ribbon ribbon-clip ribbon-left">
										<div class="ribbon-target" style="top: 12px;">
											<span class="ribbon-inner bg-brand"></span><?php echo date('d M', strtotime($upcomingBirthdayResult[$i]['dateOf‎Birth'])); ?>
										</div>
										<div class="card-body text-center pt-4">
											<div class="mt-7">
												<div class="symbol symbol-circle symbol-lg-150">
													<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$upcomingBirthdayResult[$i]['photo']; ?>" alt="image">
												</div>
											</div>
											<div class="my-2">
												<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $upcomingBirthdayResult[$i]['fullName']; ?></span>
												<p><?php echo $upcomingBirthdayResult[$i]['departmentName']; ?></p>
											</div>
											<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold"><?php echo $upcomingBirthdayResult[$i]['designationName']; ?></span>
											<div class="mt-9 mb-6">
												<a href="tel:<?php echo $upcomingBirthdayResult[$i]['contactNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fas fa-mobile-alt"></i>
												</a>
												<a href="tel:<?php echo $upcomingBirthdayResult[$i]['landlineNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fa fa-phone-alt"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		<?php
			}
			
			if(count($todaysWorkAnniversariesResult)>0)
			{
		?>
		<div class="d-flex flex-column-fluid mt-25">
			<div class="container">
				<!--<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $todaysWorkAnniversariesHeading; ?></h2>
				<div class="separator separator-solid mb-5"></div>-->
				
				<div class="row">
					<div class="col-xl-4">
					</div>
					<div class="col-xl-4">
						<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $todaysWorkAnniversariesHeading; ?></h2>
					</div>
					<div class="col-xl-4 text-right">
						<?php
							$count = 0;
							
							if(count($todaysWorkAnniversariesResult) > 4)
							{
								$count = 4;
						?>
								<a href="<?php echo base_url()."todaysWorkAnniversaries"; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>
						<?php
							}
							else
							{
								$count = count($todaysWorkAnniversariesResult);
							}
						?>
						
					</div>
					<div class="col-xl-12">
						<div class="separator separator-solid mb-5"></div>
					</div>
				</div>
				
				<div class="row">
					<?php							
						for($i=0; $i < $count; $i++)
						{
					?>
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
								<div class="card card-custom gutter-b card-stretch shadow-box">
									<div class="card-header-right ribbon ribbon-clip ribbon-left">
										<div class="ribbon-target" style="top: 12px;">
											<span class="ribbon-inner bg-brand"></span><?php echo date('d M Y', strtotime($todaysWorkAnniversariesResult[$i]['dateOfJoining'])); ?>
										</div>
										<div class="card-body text-center pt-4">
											<div class="mt-7">
												<div class="symbol symbol-circle symbol-lg-150">
													<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$todaysWorkAnniversariesResult[$i]['photo']; ?>" alt="image">
												</div>
											</div>
											<div class="my-2">
												<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $todaysWorkAnniversariesResult[$i]['fullName']; ?></span>
												<p><?php echo $todaysWorkAnniversariesResult[$i]['departmentName']; ?></p>
											</div>
											<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold"><?php echo $todaysWorkAnniversariesResult[$i]['designationName']; ?></span>
											<div class="mt-9 mb-6">
												<a href="tel:<?php echo $todaysWorkAnniversariesResult[$i]['contactNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fas fa-mobile-alt"></i>
												</a>
												<a href="tel:<?php echo $todaysWorkAnniversariesResult[$i]['landlineNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fa fa-phone-alt"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		
		<?php
			}
			
			if(count($upcomingWorkAnniversariesResult)>0)
			{
		?>
		<div class="d-flex flex-column-fluid mt-25">
			<div class="container">
				<!--<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $upcomingWorkAnniversariesHeading; ?></h2>
				<div class="separator separator-solid mb-5"></div>-->
				
				<div class="row">
					<div class="col-xl-4">
					</div>
					<div class="col-xl-4">
						<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $upcomingWorkAnniversariesHeading; ?></h2>
					</div>
					<div class="col-xl-4 text-right">
						<?php
							$count = 0;
							
							if(count($upcomingWorkAnniversariesResult) > 4)
							{
								$count = 4;
						?>
								<a href="<?php echo base_url()."upcomingWorkAnniversaries"; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>
						<?php
							}
							else
							{
								$count = count($upcomingWorkAnniversariesResult);
							}
						?>
						
					</div>
					<div class="col-xl-12">
						<div class="separator separator-solid mb-5"></div>
					</div>
				</div>
				
				<div class="row">
					<?php							
						for($i=0; $i < $count; $i++)
						{
					?>
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
								<div class="card card-custom gutter-b card-stretch shadow-box">
									<div class="card-header-right ribbon ribbon-clip ribbon-left">
										<div class="ribbon-target" style="top: 12px;">
											<span class="ribbon-inner bg-brand"></span><?php echo date('d M Y', strtotime($upcomingWorkAnniversariesResult[$i]['dateOfJoining'])); ?>
										</div>
										<div class="card-body text-center pt-4">
											<div class="mt-7">
												<div class="symbol symbol-circle symbol-lg-150">
													<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$upcomingWorkAnniversariesResult[$i]['photo']; ?>" alt="image">
												</div>
											</div>
											<div class="my-2">
												<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $upcomingWorkAnniversariesResult[$i]['fullName']; ?></span>
												<p><?php echo $upcomingWorkAnniversariesResult[$i]['departmentName']; ?></p>
											</div>
											<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold"><?php echo $upcomingWorkAnniversariesResult[$i]['designationName']; ?></span>
											<div class="mt-9 mb-6">
												<a href="tel:<?php echo $upcomingWorkAnniversariesResult[$i]['contactNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fas fa-mobile-alt"></i>
												</a>
												<a href="tel:<?php echo $upcomingWorkAnniversariesResult[$i]['landlineNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fa fa-phone-alt"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		
		<?php
			}
			
			if(count($employeeOfTheMonthYearResult)>0)
			{
		?>
		<div class="d-flex flex-column-fluid mt-25">
			<div class="container">
				<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $employeeOfTheMonthYearHeading; ?></h2>
				<div class="separator separator-solid mb-5"></div>
				
				<div class="row">
					<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6"></div>
					<?php							
						for($i=0; $i < count($employeeOfTheMonthYearResult); $i++)
						{
					?>
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
								<div class="card card-custom gutter-b card-stretch shadow-box">
									<div class="card-header-right ribbon ribbon-clip ribbon-left">
										<div class="ribbon-target" style="top: 12px;">
											<span class="ribbon-inner bg-brand"></span><?php echo date('d M Y', strtotime($employeeOfTheMonthYearResult[$i]['dateOfJoining'])); ?>
										</div>
										<div class="card-body text-center pt-4">
											<div class="mt-7">
												<div class="symbol symbol-circle symbol-lg-150">
													<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$employeeOfTheMonthYearResult[$i]['photo']; ?>" alt="image">
												</div>
											</div>
											<div class="my-2">
												<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $employeeOfTheMonthYearResult[$i]['fullName']; ?></span>
												<p><?php echo $employeeOfTheMonthYearResult[$i]['departmentName']; ?></p>
											</div>
											<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold"><?php echo $employeeOfTheMonthYearResult[$i]['designationName']; ?></span>
											<div class="mt-9 mb-6">
												<a href="tel:<?php echo $employeeOfTheMonthYearResult[$i]['contactNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fas fa-mobile-alt"></i>
												</a>
												<a href="tel:<?php echo $employeeOfTheMonthYearResult[$i]['landlineNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fa fa-phone-alt"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					?>
					
				</div>
			</div>
		</div>
		
		<?php
			}
			
			if(count($newEmployeeAnnouncementResult)>0)
			{
		?>
		<div class="d-flex flex-column-fluid mt-25" id="NewEmployeeAnnouncement">
			<div class="container">
				<!--<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $newEmployeeAnnouncementHeading; ?></h2>
				<div class="separator separator-solid mb-5"></div>-->
				
				<div class="row">
					<div class="col-xl-4">
					</div>
					<div class="col-xl-4">
						<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $newEmployeeAnnouncementHeading; ?></h2>
					</div>
					<div class="col-xl-4 text-right">
						<?php
							$count = 0;
							
							if(count($newEmployeeAnnouncementResult) > 4)
							{
								$count = 4;
						?>
								<a href="<?php echo base_url()."newEmployeeAnnouncement"; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>
						<?php
							}
							else
							{
								$count = count($newEmployeeAnnouncementResult);
							}
						?>
						
					</div>
					<div class="col-xl-12">
						<div class="separator separator-solid mb-5"></div>
					</div>
				</div>
				
				<div class="row">
					<?php							
						for($i=0; $i < $count; $i++)
						{
					?>
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
								<div class="card card-custom gutter-b card-stretch shadow-box">
									<div class="card-header-right ribbon ribbon-clip ribbon-left">
										<div class="ribbon-target" style="top: 12px;">
											<span class="ribbon-inner bg-brand"></span><?php echo date('d M Y', strtotime($newEmployeeAnnouncementResult[$i]['dateOfJoining'])); ?>
										</div>
										<div class="card-body text-center pt-4">
											<div class="mt-7">
												<div class="symbol symbol-circle symbol-lg-150">
													<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$newEmployeeAnnouncementResult[$i]['photo']; ?>" alt="image">
												</div>
											</div>
											<div class="my-2">
												<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $newEmployeeAnnouncementResult[$i]['fullName']; ?></span>
												<p><?php echo $newEmployeeAnnouncementResult[$i]['departmentName']; ?></p>
											</div>
											<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold"><?php echo $newEmployeeAnnouncementResult[$i]['designationName']; ?></span>
											<div class="mt-9 mb-6">
												<a href="tel:<?php echo $newEmployeeAnnouncementResult[$i]['contactNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fas fa-mobile-alt"></i>
												</a>
												<a href="tel:<?php echo $newEmployeeAnnouncementResult[$i]['landlineNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
													<i class="fa fa-phone-alt"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		
		<?php
			}
		?>
		
		<!--
		<div class="d-flex flex-column-fluid mt-25">
			<div class="container">
				<!--<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $importantLinkHeading; ?></h2>
				<div class="separator separator-solid mb-5"></div>--
				<div class="row">
					<div class="col-xl-4">
					</div>
					<div class="col-xl-4">
						<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $importantLinkHeading; ?></h2>
					</div>
					<div class="col-xl-4 text-right">
						<a href="<?php echo base_url()."importantLinks"; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>
					</div>
					<div class="col-xl-12">
						<div class="separator separator-solid mb-5"></div>
					</div>
				</div>
				<div class="row">
					<?php							
						for($i=0; $i < count($importantLinksResult); $i++)
						{
					?>
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
								<div class="card card-custom gutter-b card-stretch">
									<div class="card-body text-center pt-4">
										<div class="my-2 mt-7">
											<span class="text-dark font-weight-bold text-hover-primary font-size-h4">
												<?php echo $importantLinksResult[$i]['heading']; ?>
											</span>
											<p><?php echo $importantLinksResult[$i]['description']; ?></p>
										</div>
										<div class="mt-9">
											<a href="<?php echo $importantLinksResult[$i]['URL']; ?>" target="_blank"class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase">Visit</a>
										</div>
									</div>
								</div>
							</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		-->
		
		<div class="d-flex flex-column-fluid mt-25" id="ImportantLinks">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<div class="card card-custom card-stretch gutter-b shadow-box">
							<div class="card-header border-5 pt-5">
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label font-weight-bolder text-dark"><?php echo $importantLinkHeading; ?></span>
								</h3>
							</div>
							<div class="card-body pt-8">
								<div class="row">
								<?php										
									for($j=0; $j < count($importantLinksResult); $j++)
									{
								?>
									<div class="col-xl-4">
										<div class="d-flex align-items-center mb-1">
											<div class="symbol symbol-40 symbol-light-white mr-5">
												<div class="symbol-label">
													<span class="svg-icon menu-icon">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="54px" height="54px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24"></rect>
																<path d="M12.4644661,14.5355339 L9.46446609,14.5355339 C8.91218134,14.5355339 8.46446609,14.9832492 8.46446609,15.5355339 C8.46446609,16.0878187 8.91218134,16.5355339 9.46446609,16.5355339 L12.4644661,16.5355339 L12.4644661,17.5355339 C12.4644661,18.6401034 11.5690356,19.5355339 10.4644661,19.5355339 L6.46446609,19.5355339 C5.35989659,19.5355339 4.46446609,18.6401034 4.46446609,17.5355339 L4.46446609,13.5355339 C4.46446609,12.4309644 5.35989659,11.5355339 6.46446609,11.5355339 L10.4644661,11.5355339 C11.5690356,11.5355339 12.4644661,12.4309644 12.4644661,13.5355339 L12.4644661,14.5355339 Z" fill="#000000" opacity="0.3" transform="translate(8.464466, 15.535534) rotate(-45.000000) translate(-8.464466, -15.535534) "></path>
																<path d="M11.5355339,9.46446609 L14.5355339,9.46446609 C15.0878187,9.46446609 15.5355339,9.01675084 15.5355339,8.46446609 C15.5355339,7.91218134 15.0878187,7.46446609 14.5355339,7.46446609 L11.5355339,7.46446609 L11.5355339,6.46446609 C11.5355339,5.35989659 12.4309644,4.46446609 13.5355339,4.46446609 L17.5355339,4.46446609 C18.6401034,4.46446609 19.5355339,5.35989659 19.5355339,6.46446609 L19.5355339,10.4644661 C19.5355339,11.5690356 18.6401034,12.4644661 17.5355339,12.4644661 L13.5355339,12.4644661 C12.4309644,12.4644661 11.5355339,11.5690356 11.5355339,10.4644661 L11.5355339,9.46446609 Z" fill="#000000" transform="translate(15.535534, 8.464466) rotate(-45.000000) translate(-15.535534, -8.464466) "></path>
															</g>
														</svg>
													</span>
													<span class="bullet bullet-bar align-self-stretch ml-5"></span>
												</div>
											</div>
											<div class="d-flex flex-column font-weight-bold">
												<a href="<?php echo $importantLinksResult[$j]['URL']; ?>" target="_blank" class="text-dark text-hover-primary mb-1 font-size-lg">
													<?php echo $importantLinksResult[$j]['heading']; ?>
												</a>
											</div>
										</div>
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
		
		<?php	
			//$postResult 	= "";
			//$postHeading 	= "";
			
			for($k=1; $k < 8; $k++)
			{
				if($k==1)
				{
					$postHeading	= $safetyInstructionHeading;
					$postResult 	= $safetyInstructionPostsResult;
					$viewAllURL		= "safetyInstructions";
					$count 			= $safetyInstructionPostsCount;
				}
				else if($k==2)
				{
					$postHeading 	=  $eventHeading;
					$postResult		=  $eventPostsResult;
					$viewAllURL		= "events";
					$count 			= $eventPostsCount;
				}
				else if($k==3)
				{
					$postHeading	=  $newsHeading;
					$postResult 	=  $newsPostsResult; 
					$viewAllURL		= "news";
					$count 			= $newsPostsCount;
				}
				else if($k==4)
				{
					$postHeading	=  $alertHeading;
					$postResult 	=  $alertPostsResult;
					$viewAllURL		= "alerts";
					$count 			= $alertPostsCount;
				}
				else if($k==5)
				{
					$postHeading	=  $trainingHeading;
					$postResult 	=  $trainingPostsResult;
					$viewAllURL		= "trainings";
					$count 			= $trainingPostsCount;
				}
				else if($k==6)
				{
					$postHeading	=  $HRCommunicationsAndUpdateHeading;
					$postResult 	=  $HRCommunicationsAndUpdatePostsResult;
					$viewAllURL		= "HRcommunicationsAndUpdates";
					$count 			= $HRCommunicationsAndUpdatePostsCount;
				}
				else if($k==7)
				{
					$postHeading	=  $CSRHeading;
					$postResult 	=  $CSRPostsResult;
					$viewAllURL		= "CSR";
					$count 			= $CSRPostsCount;
				}
				
				/*
				'circularPostsResult'                   => $circularPostsResult,
																'circularHeading'                       => $circularHeading,
																'policiesPostsResult'                   => $policiesPostsResult,
																'policiesHeading'                       => $policiesHeading,
																'handbookPostsResult'                   => $handbookPostsResult,
																'handbookHeading'                       => $handbookHeading*/
				
		?>
				<div class="d-flex flex-column-fluid mt-25">
					<div class="container">
						<!--
						<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $postHeading; ?></h2>
						<div class="separator separator-solid mb-5"></div>-->
						
						<div class="row">
							<div class="col-xl-4">
							</div>
							<div class="col-xl-4">
								<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $postHeading; ?></h2>
							</div>
							<div class="col-xl-4 text-right">
								<?php
									
									if($count > 3)
									{
								?>
										<a href="<?php echo base_url()."".$viewAllURL; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>
								<?php
									}
								?>
								
							</div>
							<div class="col-xl-12">
								<div class="separator separator-solid mb-5"></div>
							</div>
						</div>
						
						<div class="row">
							<?php							
								for($i=0; $i < count($postResult); $i++)
								{
							?>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
										<div class="card card-custom gutter-b card-stretch">
											<div class="card-body text-center pt-4">
												<div class="mt-7">
													<div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" style="background-image: url(<?php echo base_url().UPLOAD_POST.$postResult[$i]['thumbnailImage']; ?>);"></div>
												</div>
												
												<div class="my-2 mt-7">
													<span class="text-dark font-weight-bold text-hover-primary font-size-h4">
													<?php echo $postResult[$i]['postHeading']; ?></span>
													<p class="mt-4"><?php echo strip_tags(substr($postResult[$i]['postShortDescription'], 0, 210)); ?>...</p>
												</div>
												<div class="mt-9">
													<!--<a href="<?php echo $postURL; ?>" class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase">Read More...</a>-->
													<a href="<?php echo base_url()."safetyInstructions/".$postResult[$i]['postID']; ?>" class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase">Read More...</a>
												</div>
											</div>
										</div>
									</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
		
		<?php
			
			}
		?>
		
		<?php	
			
			for($k=8; $k < 11; $k++)
			{
				if($k==8)
				{
					$postHeading	= $circularHeading;
					$postResult 	= $circularPostsResult;
					$viewAllURL		= "circulars";
					$count 			= $circularPostsCount;
				}
				else if($k==9)
				{
					$postHeading 	= $policiesHeading;
					$postResult		= $policiesPostsResult;
					$viewAllURL		= "policies";
					$count 			= $policiesPostsCount;
				}
				else if($k==10)
				{
					$postHeading	= $handbookHeading;
					$postResult 	= $handbookPostsResult; 
					$viewAllURL		= "handbook";
					$count 			= $handbookPostsCount;
				}
		?>
				<div class="d-flex flex-column-fluid mt-25">
					<div class="container">
						<!--<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $postHeading; ?></h2>
						<a href="#" class="btn btn-light-primary btn-sm font-weight-bolder justify-content-left">View All</a>
						<div class="separator separator-solid mb-5"></div>-->

						<div class="row">
							<div class="col-xl-4">
							</div>
							<div class="col-xl-4">
								<h2 class="font-weight-bolder font-size-h3 text-center mb-5"><?php echo $postHeading; ?></h2>
							</div>
							<div class="col-xl-4 text-right">
								<?php
									
									if($count > 3)
									{
								?>
										<a href="<?php echo base_url()."".$viewAllURL; ?>" target='_BLANK' class="btn btn-light-primary btn-sm font-weight-bolder text-right ">View All</a>
								<?php
									}
								?>
								
							</div>
							<div class="col-xl-12">
								<div class="separator separator-solid mb-5"></div>
							</div>
						</div>
						
						<div class="row">
							<?php							
								for($j=0; $j < count($postResult); $j++)
								{
							?>
									<div class="col-xl-4">
										<div class="card card-custom card-stretch gutter-b">
											<div class="card-body pt-8">
												<div class="d-flex align-items-center mb-0">
													<div class="symbol symbol-40 symbol-light-white mr-8">
														<div class="symbol-label">
															<i class="fas fa-file-pdf icon-5x"></i>
														</div>
													</div>
													<div class="d-flex flex-column font-weight-bold">
														<a href="<?php echo base_url().UPLOAD_POST.$postResult[$j]['PDFFile']; ?>" class="text-dark text-hover-primary mb-1 font-size-lg mx-2">
															<?php echo $postResult[$j]['postHeading']; ?>														
														</a>
														<div class="mt-4">
															<a href="<?php echo base_url().UPLOAD_POST.$postResult[$j]['PDFFile']; ?>" target='_BLANK' class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
																<i class="fas fa-search"></i>
															</a>
															<a href="<?php echo base_url().UPLOAD_POST.$postResult[$j]['PDFFile']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2" download>
																<i class="fas fa-file-download"></i>
															</a>
														</div>
													</div>
												</div>								
											</div>
										</div>
									</div>
							<?php
								}
							?>
							<div class="col-xl-12">
								<div class="separator separator-solid mb-5"></div>
							</div>
						</div>
					</div>
				</div>
		
		<?php
			
			}
		?>
		
		
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>