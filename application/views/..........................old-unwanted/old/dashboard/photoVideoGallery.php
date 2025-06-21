		<?php 
		//echo "<pre>"; print_r($photoGalleryCategoryResult);exit;
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
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Photo /Video Gallery </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Photo/Video Gallery</a>
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
					<div class="card card-custom">
						<div class="card-header border-0">
							<h3 class="card-title font-weight-bolder text-dark"><?php echo $postHeading; ?></h3>
							<div class="card-toolbar">
								<a href="<?php echo base_url()."photoGallery"; ?>" class="btn btn-outline-primary btn-sm font-weight-bolder text-center btn-block text-uppercase">
									<i class="fa fa-reply svg-icon svg-icon-md svg-icon-white-500 mr-1"></i>Back
								</a>
							</div>
						</div>
						<div class="separator separator-solid my-0"></div>
						<div class="card-body text-center p-4">
							<div class="row">
							<?php							
								for($i=0; $i < count($photoVideoGalleryResult); $i++)
								{
									if($photoVideoGalleryResult[$i]['photoVideoTypeFlag'] == '0')
									{
							?>
										<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
											<div class="mt-5 mb-5">
												<div class="mt-2">
													<iframe width="100%" height="200px" src="<?php echo $photoVideoGalleryResult[$i]['photoVideoLink']; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen data-toggle="modal" data-target="#staticBackdrop" onclick="galleryEvent(<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>);">
													</iframe>
												</div>
											</div>
										</div>
							<?php
								
									}
									else if($photoVideoGalleryResult[$i]['photoVideoTypeFlag'] == '1')
									{
							?>
										<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
											<div class="mt-5 mb-5">
												<div class="mt-2">
													<iframe width="100%" height="200px" src="<?php echo base_url().UPLOAD_GALLERY_PHOTO_VIDEO.$photoVideoGalleryResult[$i]['photoVideoLink']; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen data-toggle="modal" data-target="#staticBackdrop" onclick="galleryEvent(<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>);">
													</iframe>
												</div>
											</div>
										</div>
							<?php
									}
									else
									{
							?>
									<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
										<div class="mt-5 mb-5">
											<div class="mt-2">
												<img src="<?php echo base_url().UPLOAD_GALLERY_PHOTO_VIDEO.$photoVideoGalleryResult[$i]['photoVideoLink']; ?>" style="width: 100% !important; height: auto !important;" alt="" data-toggle="modal" data-target="#staticBackdrop" onclick="galleryEvent(<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>);">
											</div>
										</div>
									</div>
							<?php
									}
								}
								
								if(count($photoVideoGalleryResult) == '0')
								{
									echo "<div class='col-xl-12'>".$noDataAvailable."</div>";
								}
							?>
							
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal-->
			<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><?php echo $postHeading; ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<i aria-hidden="true" class="ki ki-close"></i>
							</button>
						</div>
						<div class="modal-body p-0">
						

							<div id="herosection" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<?php	
										$active = "";
										for($i=0; $i < count($photoVideoGalleryResult); $i++)
										{		
											/*if($i==0)
											{
												$active = "active";
											}
											else
											{
												$active = "";
											}*/
									?>
											<li data-target="#herosection" data-slide-to="<?php echo $i; ?>" class="carousel-item-ol <?php echo $active; ?>" id="carousel-item-ol<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>"></li>
									<?php							
										}
									?>
								</ol>
								<div class="carousel-inner">
									<?php	
									$active = "";
										for($i=0; $i < count($photoVideoGalleryResult); $i++)
										{	
											/*if($i==0)
											{
												$active = "active";
											}
											else
											{
												$active = "";
											}*/
											
											if($photoVideoGalleryResult[$i]['photoVideoTypeFlag'] == '0')
											{
									?>
												<div class="carousel-item <?php echo $active; ?>" id="carousel-item-<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>">
													<iframe width="100%" height="600px" src="<?php echo $photoVideoGalleryResult[$i]['photoVideoLink']; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen data-toggle="modal" data-target="#staticBackdrop" onclick="galleryEvent(<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>);">
													</iframe>
												</div>
									<?php
											}
											else if($photoVideoGalleryResult[$i]['photoVideoTypeFlag'] == '1')
											{
									?>
											<div class="carousel-item <?php echo $active; ?>" id="carousel-item-<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>">
												<iframe width="100%" height="600px" src="<?php echo base_url().UPLOAD_GALLERY_PHOTO_VIDEO.$photoVideoGalleryResult[$i]['photoVideoLink']; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen data-toggle="modal" data-target="#staticBackdrop" onclick="galleryEvent(<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>);">
													</iframe>
											</div>
									<?php
											}
											else
											{
									?>
											<div class="carousel-item <?php echo $active; ?>" id="carousel-item-<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>">
												<img class="d-block w-100" src="<?php echo base_url().UPLOAD_GALLERY_PHOTO_VIDEO.$photoVideoGalleryResult[$i]['photoVideoLink']; ?>" alt="...">
											</div>
									<?php
											}
										}
									?>
								</div>
								<a class="carousel-control-prev" href="#herosection" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#herosection" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
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
		<script type="text/javascript">
			function galleryEvent(photo) {
				/*var lastid = sessionStorage.getItem("lastid");
				
				if(lastid)
				{
					var element = document.getElementById("carousel-item-ol"+lastid);
					  element.classList.remove("active");
					  
					  var element = document.getElementById("carousel-item-"+lastid);
					  element.classList.remove("active");
				}
				 
				sessionStorage.setItem("lastid", photo);*/
				
				<?php	
					
					for($i=0; $i < count($photoVideoGalleryResult); $i++)
					{
				?>
						var element = document.getElementById("carousel-item-ol"+<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>);
						element.classList.remove("active");
						
						var element = document.getElementById("carousel-item-"+<?php echo $photoVideoGalleryResult[$i]['photoVideoGalleryID']; ?>);
						element.classList.remove("active");
				<?php
					}
				?>
				var element = document.getElementById("carousel-item-ol"+photo);
				element.classList.add("active");
  
				var element = document.getElementById("carousel-item-"+photo);
				element.classList.add("active");	
            } 
        </script>
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>