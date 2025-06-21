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
							for($j=0; $j < count($postsResult); $j++)
							{
						?>		
								<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-2">
									<div class="card shadow-box card-custom card-stretch gutter-b">
										<div class="card-body pt-8">
											<div class="d-flex align-items-center mb-0">
												<div class="symbol symbol-40 symbol-light-white mr-8">
													<div class="symbol-label">
														<i class="fas fa-file-pdf icon-5x"></i>
													</div>
												</div>
												<div class="d-flex flex-column font-weight-bold">
													<a href="<?php echo base_url().UPLOAD_POST.$postsResult[$j]['PDFFile']; ?>" class="text-dark text-hover-primary mb-1 font-size-lg mx-2">
														<?php echo $postsResult[$j]['postHeading']; ?>														
													</a>
													<div class="mt-4">
														<a href="<?php echo base_url().UPLOAD_POST.$postsResult[$j]['PDFFile']; ?>" target='_BLANK' class="btn btn-md btn-icon btn-light-facebook btn-pill mx-2">
															<i class="fas fa-search"></i>
														</a>
														<a href="<?php echo base_url().UPLOAD_POST.$postsResult[$j]['PDFFile']; ?>" class="btn btn-md btn-icon btn-light-facebook btn-pill mx-2" download>
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
							
							if(count($postsResult) == '0')
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