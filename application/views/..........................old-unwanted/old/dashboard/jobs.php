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
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Jobs </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Jobs</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="d-flex align-items-center">
					</div>
				</div>
			</div>
			<!-- page heading end-->
			<div class="d-flex flex-column-fluid container">
				<div class="container">
					<div class="row">
						<div class="flex-row-fluid ml-lg-8">
							<div class="card card-custom gutter-b shadow-box">
								<div class="card-header flex-wrap border-0 pt-6 pb-0">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label font-weight-bolder font-size-h3 text-dark">Current Openings</span>
									</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<?php
											if(count($jobsResult)>0)
											{
										?>
										<table class="table">
											<thead>
												<tr>
													<th>Job Title</th>
													<th>Location</th>
													<th>Work Experience</th>
													<th>Salary</th>
													<th>Start Date</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php							
													for($i=0; $i < count($jobsResult); $i++)
													{
												?>
														<tr>
															<td class="d-flex align-items-center font-weight-bolder">
																<img src="<?php echo base_url('assetsbackoffice/img/favicon.png'); ?>" class="h-75 align-self-end mr-5" alt="Fire Fighter Contact 1">
																<span class="bullet bullet-bar bg-primary align-self-stretch"></span>
																<div class="d-flex flex-column flex-grow-1 ml-5">
																	<a href="<?php echo base_url()."job/".$jobsResult[$i]['jobPostID']; ?>" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">
																		<?php echo $jobsResult[$i]['jobTitle']; ?>
																	</a>
																	<span class="text-muted font-weight-bold">
																		<i class="fas fa-piggy-bank icon-lg icon-1x mr-1"></i>
																		<?php echo $jobsResult[$i]['location']; ?>
																	</span>
																</div>
															</td>
															<td class="align-middle align-items-center font-weight-bolder">
																<?php echo $jobsResult[$i]['location']; ?>
															</td>
															<td class="text-left align-middle font-weight-bolder">
																<?php echo $jobsResult[$i]['workExperience']; ?>
															</td>
															<td class="text-left align-middle font-weight-bolder">
																<?php echo $jobsResult[$i]['salary']; ?>
															</td>
															<td class="text-left align-middle font-weight-bolder">
																<?php echo date('d-m-Y', strtotime($jobsResult[$i]['startDate'])); ?>
															</td>
															<td class="text-left  align-middle pr-0">
																<a href="<?php echo base_url()."job/".$jobsResult[$i]['jobPostID']; ?>" class="btn btn-icon btn-light btn-sm">
																	<i class="fas fa-angle-double-right icon-lg text-primary icon-1x mr-1"></i>
																</a>
															</td>
														</tr>
												<?php
													}
												?>
											</tbody>
										</table>
										<?php
											}
											if(count($jobsResult) == '0')
											{
												echo "<div class='col-xl-12'>".$noDataAvailable."</div>";
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

		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>