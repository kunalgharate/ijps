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
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Important Links </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Important Links</a>
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
							
							if(count($importantLinksResult) == '0')
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