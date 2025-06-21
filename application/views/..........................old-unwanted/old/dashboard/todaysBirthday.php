		<?php   
			$url 		= $_SERVER['REQUEST_URI'];    
			$urlArray	= explode("/", $url);
			$pageLoaded = $urlArray[(count($urlArray)-1)];
	
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
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> <?php echo $pageHeading; ?> </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> <?php echo $pageHeading; ?></a>
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
						<?php							
							for($i=0; $i < count($todaysBirthdayResult); $i++)
							{
						?>
								<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
									<div class="card card-custom gutter-b card-stretch shadow-box">
										<div class="card-header-right ribbon ribbon-clip ribbon-left">
											<div class="ribbon-target" style="top: 12px;">
						<?php
												if($pageLoaded == 'todaysBirthday' || $pageLoaded == 'upcomingBirthday')
												{
						?>
													<span class="ribbon-inner bg-brand"></span><?php echo date('d M', strtotime($todaysBirthdayResult[$i]['dateOf‎Birth'])); ?>
						<?php
												}
												else
												{
													$date_of_joining = new DateTime($todaysBirthdayResult[$i]['dateOfJoining']);
													$current_date = new DateTime();
													$interval = $current_date->diff($date_of_joining);
													$diff = $interval->y;
						?>
													<span class="ribbon-inner bg-brand"></span><?php echo date('d M Y', strtotime($todaysBirthdayResult[$i]['dateOfJoining']))." (".$diff." Years Completed"; ?>
						<?php
												}
						?>
												
												
											</div>
											<div class="card-body text-center pt-4">
												<div class="mt-12">
													<div class="symbol symbol-circle symbol-lg-150">
														<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$todaysBirthdayResult[$i]['photo']; ?>" alt="image">
													</div>
												</div>
												<div class="my-2">
													<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $todaysBirthdayResult[$i]['fullName']; ?></span>
													<p><?php echo $todaysBirthdayResult[$i]['departmentName']; ?></p>
												</div>
												<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold"><?php echo $todaysBirthdayResult[$i]['designationName']; ?></span>
												<!--
												<div class="mt-9 mb-6">
													<a href="tel:<?php echo $todaysBirthdayResult[$i]['contactNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
														<i class="fas fa-mobile-alt"></i>
													</a>
													<a href="tel:<?php echo $todaysBirthdayResult[$i]['landlineNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
														<i class="fa fa-phone-alt"></i>
													</a>
												</div>
												-->
											</div>
										</div>
									</div>
								</div>
						<?php
							}
							
							if(count($todaysBirthdayResult) == '0')
							{
								echo "<div class='col-xl-12'>".$noDataAvailable."</div>";
							}
						?>
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