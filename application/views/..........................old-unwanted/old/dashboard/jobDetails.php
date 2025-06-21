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
			
			.jobSubHeader
			{
				display:none !important;
			}
		</style>
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Job Details </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo base_url()."jobs"; ?>" class="text-muted"> Jobs</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Job Details</a>
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
					<div class="card card-custom gutter-b">
						<div class="card-body">
							<div class="d-flex" id="jobHeader">
								<div class="mr-15">
									<!--<img src="<?php echo base_url().UPLOAD_POST.$jobDetailsResult[0]['thumbnailImage']; ?>" alt="image" style="width:450px" class ="rounded">-->
									<img src="<?php echo base_url('assetsbackoffice//uploads/logo/Primary_Logo.png'); ?>" alt="image" style="width:150px" class ="rounded">
								</div>
								<div class="flex-grow-1">
									<div class="d-flex align-items-center justify-content-between flex-wrap mt-10">
										<div class="mr-3">
											<a class="d-flex align-items-center text-dark text-hover-primary font-size-h3 font-weight-bold mr-3">
												<?php echo $jobDetailsResult[0]['jobTitle']; ?>
											</a>
											<div class="d-flex flex-wrap my-2 mt-5">
												<a class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
													<i class="fas fa-user-tie svg-icon svg-icon-md svg-icon-gray-500 mr-1"></i>
													<?php echo $jobDetailsResult[0]['createdByUserName']; ?>
												</a>
												<a class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
													<i class="far fa-calendar-alt svg-icon svg-icon-md svg-icon-gray-500 mr-1"></i>
													<?php echo date('d M Y G:ia', strtotime($jobDetailsResult[0]['createdDate'])); ?>
												</a>
											</div>
										</div>
										<div class="my-lg-0 my-1">
											<a href="<?php echo base_url()."jobs"; ?>" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">
												<i class="fa fa-reply svg-icon svg-icon-md svg-icon-white-500 mr-1"></i>
												Back
											</a>
										</div>
									</div>
									<div class="d-flex align-items-center flex-wrap justify-content-between mt-5" id="jobSubHeader">
										<div class="flex-grow-1 font-weight-bold text-dark-50 py-5 py-lg-2 mr-5">
											<!--<?php echo $jobDetailsResult[0]['postShortDescription']; ?>-->
										</div>
									</div>
								</div>
							</div>
							<div class="separator separator-solid my-7"></div>
							<div class="d-flex align-items-center flex-wrap">
								<div class="d-flex align-items-center flex-lg-fill- mr-0 my-1 width-25-100"><!--w-25-->
									<span class="mr-4">
										<i class="fas fa-map-marker-alt svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
									</span>
									<div class="d-flex flex-column flex-lg-fill">
										<span class="text-dark-75 font-weight-bolder font-size-sm">Job Location</span>
										<?php echo $jobDetailsResult[0]['location']; ?>
									</div>
								</div>
								<div class="d-flex align-items-center flex-lg-fill- mr-0 my-1 width-25-100">
									<span class="mr-4">
										<i class="fas fa-calendar-alt svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
									</span>
									<div class="d-flex flex-column flex-lg-fill">
										<span class="text-dark-75 font-weight-bolder font-size-sm">Start Date</span>
										<?php echo date('d M Y', strtotime($jobDetailsResult[0]['startDate'])); ?>
									</div>
								</div>
								<div class="d-flex align-items-center flex-lg-fill- mr-0 my-1 width-25-100">
									<span class="mr-4">
										<i class="fas fa-briefcase svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
									</span>
									<div class="d-flex flex-column flex-lg-fill">
										<span class="text-dark-75 font-weight-bolder font-size-sm">Work Experience</span>
										<?php echo $jobDetailsResult[0]['workExperience']; ?>
									</div>
								</div>
								<div class="d-flex align-items-center flex-lg-fill- mr-0 my-1 width-25-100">
									<span class="mr-4">
										<i class="fas fa-money-bill-wave svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
									</span>
									<div class="d-flex flex-column flex-lg-fill">
										<span class="text-dark-75 font-weight-bolder font-size-sm">Salary</span>
										<?php echo $jobDetailsResult[0]['salary']; ?>
									</div>
								</div>
							</div>
							<div class="separator separator-solid my-7"></div>
							<div class="d-flex align-items-center flex-wrap">
								<span class="text-dark-75 font-weight-bolder font-size-sm">Qualification : </span> <?php echo "&nbsp;".$jobDetailsResult[0]['qualification']; ?>
							</div>
							<div class="separator separator-solid my-7"></div>
							<span class="text-dark-75 font-weight-bolder font-size-sm">Job Description : </span>
							<div class="d-flex align-items-center flex-wrap">
								<?php echo $jobDetailsResult[0]['jobDescription']; ?>
							</div>
							<div class="separator separator-solid my-7"></div>
							<span class="text-dark-75 font-weight-bolder font-size-sm"> Apply For Job : </span>
							<form method="post" action="<?php echo base_url('job/uploadResume'); ?>" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-12" style="display:none;">
										<div class="form-group">
											<div class="custom-file">
											<input class="form-control" type="hidden" name="txtJobPostID" value="<?php echo $jobDetailsResult[0]['jobPostID'];?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6" id="txtMessageSection">
										<div class="form-group">
											<label for="exampleTextarea">Message  
											<span class="text-danger">*</span></label>
											<textarea class="form-control" name="txtMessage" rows="5" cols="80" required=""></textarea>
										</div>
									</div>
									<div class="col-lg-6" id="txtPDFSection">
										<div class="form-group">
											<label for="exampleTextarea">Resume  
											<span class="text-danger">*</span></label>
											<div class="custom-file">
												<input class="form-control" type="hidden" name="txtPDF" value="">
												<input type="file" class="fileUpload" id="txtPDF" name="txtPDF" accept=".pdf" required/>
											</div>
											<span class="form-text text-muted mb-5">Allowed file types: pdf only</span>
											<button type="submit" class="btn btn-primary mr-2 btn-sm">Upload Resume</button>
										</div>
									</div> 
								</div>
								
							</form>
							<div class="separator separator-solid my-7"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		<script>
			if ($(window).width() < 514) {
				$('#jobHeader').removeClass('d-flex');
				$('#jobSubHeader').addClass('jobSubHeader');
			} else {
				$('#jobHeader').addClass('d-flex');
				$('#jobSubHeader').removeClass('jobSubHeader');
			}
		</script>
		
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>