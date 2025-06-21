		<?php 
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu');
			
			$urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$segments = explode('/', $urlArray);
			$numSegments = count($segments); 
			$currentSegment = $segments[$numSegments - 1];
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
							for($i=0; $i < count($postsResult); $i++)
							{
								/*if($postsResult[$i]['postCategoryID'] != '6' && $postsResult[$i]['postCategoryID'] != '7')
								{
									$postURL = base_url().lcfirst(str_replace(' ', '', $pageHeading))."/".$postsResult[$i]['postID'];
								}
								else
								{
									$postURL = base_url().ucfirst(str_replace(' ', '', $pageHeading))."/".$postsResult[$i]['postID'];
								}*/
								
						?>
								<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
									<div class="card card-custom gutter-b card-stretch">
										<div class="card-body text-center pt-4">
											<div class="mt-7">
												<div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" style="background-image: url(<?php echo base_url().UPLOAD_POST.$postsResult[$i]['thumbnailImage']; ?>);"></div>
											</div>
											
											<div class="my-2 mt-7">
												<span class="text-dark font-weight-bold text-hover-primary font-size-h4">
												<?php echo $postsResult[$i]['postHeading']; ?></span>
												<?php
													if($currentSegment == "trainings")
													{
												?>
														<p class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2 mt-4">
															<i class="far fa-calendar-alt svg-icon svg-icon-md svg-icon-gray-500 mr-1"></i>
															<?php echo date('d M Y', strtotime($postsResult[$i]['dateOf‎Training'])); ?>
														</p>
												<?php
													}
												?>
												<p class="mt-4"><?php echo strip_tags(substr($postsResult[$i]['postShortDescription'], 0, 210)); ?>...</p>
											</div>
											<div class="mt-9">
												<!--<a href="<?php echo $postURL; ?>" class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase">Read More...</a>-->
												<a href="<?php echo base_url().$currentSegment."/".$postsResult[$i]['postID']; ?>" class="btn btn-light-primary font-weight-bolder btn-sm py-2 px-6 text-uppercase">Read More...</a>
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