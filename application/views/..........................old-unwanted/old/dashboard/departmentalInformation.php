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
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Departmental Information </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Departmental Information</a>
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
					<div class="container mb-8">
						<div class="card">
							<div class="card-body">
								<div class="p-0">
									<div class="row">
										<div class="col-lg-12">
											<div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionExample7">
												<?php

													$show = "";
													$collapsed = "";
													for($j=0; $j < count($departmentalInformationResult); $j++)
													{
														if($j==0)
														{
															$show = "show";
															$collapsed = "card-title";
														}
														else
														{
															$show = "";
															$collapsed = "card-title collapsed";
														}
														
												?>
												<div class="card">
													<div class="card-header" id="headingOne<?php echo $j; ?>">
														<div class="<?php echo $collapsed; ?>" data-toggle="collapse" data-target="#collapseOne<?php echo $j; ?>" aria-expanded="true" role="button">
															<span class="svg-icon svg-icon-primary">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24"></polygon>
																		<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
																		<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"></path>
																	</g>
																</svg>
															</span>
															<div class="card-label text-dark pl-4"><?php echo $departmentalInformationResult[$j]['departmentName']; ?></div>
														</div>
													</div>
													<div id="collapseOne<?php echo $j; ?>" class="collapse <?php echo $show; ?>" aria-labelledby="headingOne<?php echo $j; ?>" data-parent="#accordionExample7">
														<div class="card-body text-dark-75 font-size-lg pl-12">
															<?php echo $departmentalInformationResult[$j]['departmentInformation']; ?>
															<?php
																if($departmentalInformationResult[$j]['file'] != "")
																{
																	echo "<a href= ".base_url().UPLOAD_DEPARTMENT."/".$departmentalInformationResult[$j]['file']." target='_blank'>See File</a>";
																}
															?>
														</div>
													</div>
												</div>
												<?php
													}
													
													if(count($departmentalInformationResult) == '0')
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