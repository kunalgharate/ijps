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
			
			.nav.nav-tabs.nav-tabs-line .nav-link
			{
				margin: 0 0.7rem;
			}
			
			img
			{
				width: -webkit-fill-available;
			}
		</style>
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> History Of Company </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> History Of Company</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="d-flex align-items-center">
					</div>
				</div>
			</div>
			<!-- page heading end-->
			<div class="d-flex flex-row-fluid bgi-size-cover bgi-position-center mb-8 mt-n6 firstSection" style="background-image: url('<?php echo base_url('assetsbackoffice/img/banner.png'); ?>')">
				<div class="container">
					<div class="d-flex justify-content-between align-items-center border-white py-7">
					</div>
					<div class="d-flex align-items-stretch text-center flex-column py-40">
						<h1 class="text-dark font-weight-bolder mb-12"></h1>
					</div>
				</div>
			</div>	
			<div class="d-flex flex-column-fluid mt-n20">
				<div class="container">
					<div class="content pt-0 d-flex flex-column flex-column-fluid" id="kt_content">
						<!--end::Section-->
						<!--begin::Section-->
						<div class="container mb-8">
							<div class="card">
								<div class="card-body">
									<div class="p-6">
										
										<ul class="nav nav-tabs nav-tabs-line nav-tabs-primary justify-content-center">
											<li class="nav-item">
												<a class="nav-link active font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_1">1861</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_2">1916</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_3">1934</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_4">1935</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_5">1949</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_6">1952</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_7">1962</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_8">1966</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_9">1967</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_10">1975</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_11">1992</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_12">1995</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_13">1999</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_14">2000</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_15">2002</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_16">2006</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_17">2012</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_18">2015</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_19">2018</a>
											</li>
											<li class="nav-item">
												<a class="nav-link font-weight-bolder" data-toggle="tab" href="#kt_tab_pane_20">2021</a>
											</li>
										</ul>
										<div class="tab-content mt-5" id="myTabContent">
											<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1861.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1861</h2>
														<!--<h5 class="mb-5">Lorem Ipsum is simply dummy text of the printing.</h5>-->
														<div class="separator separator-solid mb-5"></div>
														Carl Ruetz purchases the Paulinenhütte and relocates the Aachen plant to Dortmund/Germany. The first plant equipped with a single press and a ring rolling mill gets the plant name "Rothe Erde Dortmund" which is valid till today.
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1916</h2>
														<div class="separator separator-solid mb-5"></div>
														Integration of the company into the Dortmund Smelting Works Union.
													</div>
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1916.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-left" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1934.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1934</h2>
														<div class="separator separator-solid mb-5"></div>
														Establishment of the company Eisenwerk Rothe Erde GmbH in Dortmund. Programme: Forging, bending and mechanical workshop and Rothe Erde ball turntables - beginning of the manufacturing of slewing bearings.
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1935</h2>
														<div class="separator separator-solid mb-5"></div>
														Takeover of the Lippstädter Eisen- und Metallwerke GmbH by Dortmund-Hörder-Hüttenverein and Eisenwerk Rothe Erde.
													</div>
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1935.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-left" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1949.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1949</h2>
														<div class="separator separator-solid mb-5"></div>
														Reconstruction of the company destroyed by the war.
													</div>
													
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_6" role="tabpanel" aria-labelledby="kt_tab_pane_6">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1952</h2>
														<div class="separator separator-solid mb-5"></div>
														In the course of the reorganization of the iron and steel industry, the company's shares were transferred to Dortmunder-Hörder-Hüttenunion AG, Dortmund. Relocation and production of rothe erde® slewing bearings to Lippstadt/Germany.
													</div>
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1952.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-left" id="kt_tab_pane_7" role="tabpanel" aria-labelledby="kt_tab_pane_7">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1962.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1962</h2>
														<div class="separator separator-solid mb-5"></div>
														Start of internationalization by founding a production facility in the USA. This is followed by Japan (1967), Italy, Spain and England (1975), Brazil (1976), Slovakia (1995), China (2002) and India (2006).
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_8" role="tabpanel" aria-labelledby="kt_tab_pane_8">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1966</h2>
														<div class="separator separator-solid mb-5"></div>
														After the merger with Hoesch AG, Dortmund-Hörder-Hüttenunion AG was incorporated into the Hoesch Group.
													</div>
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1966.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-left" id="kt_tab_pane_9" role="tabpanel" aria-labelledby="kt_tab_pane_9">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1967.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1967</h2>
														<div class="separator separator-solid mb-5"></div>
														Establishment of the first production line for seamlessly rolled rings in Dortmund.
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_10" role="tabpanel" aria-labelledby="kt_tab_pane_10">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1975</h2>
														<div class="separator separator-solid mb-5"></div>
														With the acquisition of "Metallurgica Rossi" on the Italian market from the 1950s, "Hoesch Rothe Erde" increases its presence to adequately address the growing demand for large diameter bearings of the Italian domestic market.
													</div>
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1975.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-left" id="kt_tab_pane_11" role="tabpanel" aria-labelledby="kt_tab_pane_11">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1992.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1992</h2>
														<div class="separator separator-solid mb-5"></div>
														Takeover of Hoesch AG by the Krupp Group and subsequent merging with Fried. Krupp AG, Hoesch-Krupp. Hoesch Rothe Erde is integrated into the Group with the business areas of slewing bearings and seamlessly rolled rings.
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_12" role="tabpanel" aria-labelledby="kt_tab_pane_12">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1995</h2>
														<div class="separator separator-solid mb-5"></div>
														PSL: The main area of the production program is the manufacturing of standard and special bearings with large diameter, slewing bearings, worm drives and bearing rollers.
													</div>
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1995.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-left" id="kt_tab_pane_13" role="tabpanel" aria-labelledby="kt_tab_pane_13">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/1999.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">1999</h2>
														<div class="separator separator-solid mb-5"></div>
														Since March 17, 1999, after belonging to Hoesch AG, Rothe Erde has been part of the ThyssenKrupp Group since the merger of Thyssen AG and Fried. Krupp AG.
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_14" role="tabpanel" aria-labelledby="kt_tab_pane_14">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">2000</h2>
														<div class="separator separator-solid mb-5"></div>
														In order to increase the hardness of the bearing raceways on slewing bearings, a patented inductive hardening procedure without a soft spot was developed. This was the entry into the manufacturing of continuously rotating bearings, such as main bearings in wind turbines.
													</div>
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/2000.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-left" id="kt_tab_pane_15" role="tabpanel" aria-labelledby="kt_tab_pane_15">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/2002.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">2002</h2>
														<div class="separator separator-solid mb-5"></div>
														Company name changed to Rothe Erde GmbH. Establishment of a production site in China.
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_16" role="tabpanel" aria-labelledby="kt_tab_pane_16">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">2006</h2>
														<div class="separator separator-solid mb-5"></div>
														Establishment of a production site in India.
													</div>
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/2006.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-left" id="kt_tab_pane_17" role="tabpanel" aria-labelledby="kt_tab_pane_17">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/2012.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">2012</h2>
														<div class="separator separator-solid mb-5"></div>
														Change of name to ThyssenKrupp Rothe Erde GmbH.
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_18" role="tabpanel" aria-labelledby="kt_tab_pane_18">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">2015</h2>
														<div class="separator separator-solid mb-5"></div>
														#wirsindnemarke (#we are a brand) - new thyssenkrupp brand image. All of the Group's brands unite under one umbrella brand.
													</div>
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/2015.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-left" id="kt_tab_pane_19" role="tabpanel" aria-labelledby="kt_tab_pane_19">
												<div class="row">
													<div class="col-lg-6">
														<div>
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/2018.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">2018</h2>
														<div class="separator separator-solid mb-5"></div>
														Change of the company name to thyssenkrupp rothe erde. #rotheerde
													</div>
												</div>
											</div>
											<div class="tab-pane fade text-right" id="kt_tab_pane_20" role="tabpanel" aria-labelledby="kt_tab_pane_20">
												<div class="row">
													<div class="col-lg-6 p-10">
														<h2 class="mb-5 mt-5">2021</h2>
														<div class="separator separator-solid mb-5"></div>
														160 years of thyssenkrupp rothe erde. From the founding of the company to the present day, #160years have already passed, we are celebrating our anniversary! #160yearssthyssenkrupprotheerde
													</div>
													<div class="col-lg-6">
														<div> <!-- class="bgi-no-repeat bgi-size-cover rounded min-h-350px w-100" style="background-image: url(assetsbackoffice/uploads/historyOfCompany/2021.png);">-->
															<img src="<?php echo base_url()."assetsbackoffice/uploads/historyOfCompany/2021.png"; ?>" class="h-100 align-self-end" alt="">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--
						<div class="container mb-8">
							<div class="card card-custom card-stretch gutter-b">
								<div class="card-body pt-4">
									<div class="timeline timeline-6 mt-3">
										<div class="timeline-item align-items-start">
											<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">1861</div>
											<div class="timeline-badge">
												<i class="fa fa-genderless text-brand icon-xl"></i>
											</div>
											<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
												Carl Ruetz purchases the Paulinenhütte and relocates the Aachen plant to Dortmund/Germany. The first plant equipped with a single press and a ring rolling mill gets the plant name "Rothe Erde Dortmund" which is valid till today.
											</div>
										</div>
										<div class="timeline-item align-items-start">
											<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">1916</div>
											<div class="timeline-badge">
												<i class="fa fa-genderless text-brand icon-xl"></i>
											</div>
											<div class="timeline-content d-flex">
												<span class="font-weight-bolder text-dark-75 pl-3 font-size-lg">
												Integration of the company into the Dortmund Smelting Works Union.
												</span>
											</div>
										</div>
										<div class="timeline-item align-items-start">
											<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">1934</div>
											<div class="timeline-badge">
												<i class="fa fa-genderless text-brand icon-xl"></i>
											</div>
											<div class="timeline-content font-weight-bolder font-size-lg text-dark-75 pl-3">Establishment of the company Eisenwerk Rothe Erde GmbH in Dortmund. Programme: Forging, bending and mechanical workshop and Rothe Erde ball turntables - beginning of the manufacturing of slewing bearings. 
											</div>
										</div>
										<div class="timeline-item align-items-start">
											<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">1935</div>
											<div class="timeline-badge">
												<i class="fa fa-genderless text-brand icon-xl"></i>
											</div>
											<div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3">Takeover of the Lippstädter Eisen- und Metallwerke GmbH by Dortmund-Hörder-Hüttenverein and Eisenwerk Rothe Erde.</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						-->
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