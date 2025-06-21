		<?php 
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu'); //print_r($CoOperativeSocietyAccBalResult);exit;
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
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Co-Operative Society Accont Balance </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Co-Operative Society Accont Balance</a>
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
					<?php
						if(!empty($CoOperativeSocietyAccBalResult))
						{
					?>
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-body pt-8">
									<div class="d-flex align-items-center mb-2">
										<div class="symbol symbol-40 symbol-light-white mr-5">
											<i class="fas fa-piggy-bank icon-lg icon-3x mr-1"></i>
										</div>
										<div class="d-flex flex-column font-weight-bold">
											<a class="text-dark text-hover-primary mb-1 font-size-lg">
												Saving Acc. No. : <?php echo $CoOperativeSocietyAccBalResult[0]['savingAccountNumber']; ?>
											</a>
											<span class="text-muted">Saving Acc. Bal. : <i class="fas fa-rupee-sign icon-nm mr-1"></i><?php echo $CoOperativeSocietyAccBalResult[0]['savingAccountBalance']; ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-body pt-8">
									<div class="d-flex align-items-center mb-2">
										<div class="symbol symbol-40 symbol-light-white mr-5">
											<i class="fas fa-money-bill-wave icon-lg icon-3x mr-1"></i>
										</div>
										<div class="d-flex flex-column font-weight-bold">
											<a class="text-dark text-hover-primary mb-1 font-size-lg">
												FD Acc. No. : <?php echo $CoOperativeSocietyAccBalResult[0]['FDAccountNumber']; ?>
											</a>
											<span class="text-muted">FD Acc. Bal. : <i class="fas fa-rupee-sign icon-nm mr-1"></i><?php echo $CoOperativeSocietyAccBalResult[0]['FDAccountBalance']; ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-body pt-8">
									<div class="d-flex align-items-center mb-2">
										<div class="symbol symbol-40 symbol-light-white mr-5">
											<i class="fas fa-hand-holding-usd icon-lg icon-3x mr-1"></i>
										</div>
										<div class="d-flex flex-column font-weight-bold">
											<a class="text-dark text-hover-primary mb-1 font-size-lg">
												Loan Acc. No. : <?php echo $CoOperativeSocietyAccBalResult[0]['loanAccountNumber']; ?>
											</a>
											<span class="text-muted">Loan Acc. Bal. : <i class="fas fa-rupee-sign icon-nm mr-1"></i><?php echo $CoOperativeSocietyAccBalResult[0]['loanAccountBalance']; ?></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
						}
						else
						{
					?>
							<div class="row">
								<div class="col-xl-12">
									<div class="card card-custom card-stretch gutter-b">
										<div class="card-body pt-8 ">
											<div class="d-flex align-items-center mb-2">
												<div class="symbol symbol-40 symbol-light-white mr-5">
													<span class="svg-icon svg-icon-primary svg-icon-3x mr-1">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"/>
															<path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#000000" opacity="0.3"/>
															<rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
															<rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
														</g>
													</svg>
												</span>
												</div>
												<div class="d-flex flex-column font-weight-bold">
													<a class="text-dark text-hover-primary mb-1 font-size-lg">
														No data available
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