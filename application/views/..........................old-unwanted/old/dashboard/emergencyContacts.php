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
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Emergency Contacts </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Emergency Contacts</a>
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
							for($i=0; $i < count($emergencyContactCategoryResult); $i++)
							{
						?>
								<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
									<div class="card card-custom card-stretch gutter-b">
										<div class="card-header border-0 pt-5">
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
												<div class="d-flex align-items-center mb-2">
													<div class="symbol symbol-40 symbol-light-white mr-5">
														<!--<div class="symbol-label">
															<img src="<?php echo base_url().UPLOAD_EMERGENCY_CONTACT.$dataResult[$j]['image']; ?>" class="h-75 align-self-end" alt="<?php echo $dataResult[$j]['title']; ?>">
														</div>
														-->
														<div class="symbol-label">
															<i class="fas fa-caret-right icon-1x"></i>
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
											
											if(count($dataResult) == '0')
											{
												echo "<div class='col-xl-12'>".$noDataAvailable."</div>";
											}
						?>
										</div>
									</div>
								</div>
						<?php
							}
							
							if(count($emergencyContactCategoryResult) == '0')
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