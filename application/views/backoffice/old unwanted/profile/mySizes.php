		<?php 
			$this->load->view(BACKOFFICE.'layout/header');
		?>
			<style>
				.fileUpload
				{
					width: 100%;
					padding: 0.4rem 1rem;
					overflow: hidden;
					line-height: 1.5;
					color: #3f4254;
					background-color: #fff;
					border: 1px solid #e4e6ef;
					border-radius: .42rem;
				}
			</style>
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			$formHeading    = "Size Guide";
		?>
		
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> <?php echo $formHeading; ?></h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Sizes Master</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"><?php echo $formHeading; ?></a>
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
						<div class="col-md-12">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title">Size Guide</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<?php
											for($k=0; $k < 8; $k++)
											{
												$headerArrayShoe	= array('shoeSizeID', 'brandSize', 'UKIndia', 'EU', 'USA', 'lengthInCM');
												$tableColumnsShoe	= array('Shoe Size ID', 'Brand Size', 'UK India', 'EU', 'USA', 'Length In CM');
												
												$headerArrayTShirt 	= array('tShirtSizeID', 'brandSize', 'standardSize', 'chest', 'shoulder', 'length', 'sleeveLength', 'waist');
												$tableColumnsTShirt = array('T-Shirt Size ID', 'Brand Size', 'Standard Size', 'Chest', 'Shoulder', 'Length', 'Sleeve Length', 'Waist');
												
												$headerArrayShirt 	= array('shirtSizeID', 'brandSize', 'size', 'chest', 'shoulder', 'length', 'sleeveLength');
												$tableColumnsShirt 	= array('Shirt Size ID', 'Brand Size', 'Size', 'Chest', 'Shoulder', 'Length', 'Sleeve Length');
												
												$headerArrayPant 	= array('pantSizeID', 'brandSize', 'waist', 'hip');
												$tableColumnsPant 	= array('Pant Size ID', 'Brand Size', 'Qaist', 'Hip');
												
												if($k==0)
												{
													$headerArray	= $headerArrayShoe;
													$tableColumns	= $tableColumnsShoe;
													$result			= $shoeSizeMaleResult;
													$heading 		= "Size Chart (Shoe)- MALE";
												}
												else if($k==1)
												{
													$headerArray	= $headerArrayShoe;
													$tableColumns	= $tableColumnsShoe;
													$result			= $shoeSizeFemaleResult;
													$heading 		= "Size Chart (Shoe)- FEMALE";
												}
												else if($k==2)
												{
													$headerArray 	= $headerArrayTShirt;
													$tableColumns 	= $tableColumnsTShirt;
													$result			= $tShirtSizeMaleResult;
													$heading 		= "Size Chart (T-Shirt)- MALE";
												}
												else if($k==3)
												{
													$headerArray 	= $headerArrayTShirt;
													$tableColumns 	= $tableColumnsTShirt;
													$result			= $tShirtSizeFemaleResult;
													$heading 		= "Size Chart (T-Shirt)- FEMALE";
												}
												else if($k==4)
												{
													$headerArray 	= $headerArrayShirt;
													$tableColumns 	= $tableColumnsShirt;
													$result			= $shirtSizeMaleResult;
													$heading 		= "Size Chart (Shirt)- MALE";
												}
												else if($k==5)
												{
													$headerArray 	= $headerArrayShirt;
													$tableColumns 	= $tableColumnsShirt;
													$result			= $shirtSizeFemaleResult;
													$heading 		= "Size Chart (Shirt)- FEMALE";
												}
												else if($k==6)
												{
													$headerArray 	= $headerArrayPant;
													$tableColumns 	= $tableColumnsPant;
													$result			= $pantSizeMaleResult;
													$heading 		= "Size Chart (Pant)- MALE";
												}
												else if($k==7)
												{
													$headerArray 	= $headerArrayPant;
													$tableColumns 	= $tableColumnsPant;
													$result			= $pantSizeFemaleResult;
													$heading 		= "Size Chart (Pant)- FEMALE";
												}
										?>
												<div class="col-lg-6 mb-10">
													<div class="card-header1">
														<h5 class="card-title">
															<strong><?php echo $heading; ?></strong>
														</h5>
													</div>
													<div class="table-responsive">
														<table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
															<thead>
																<tr class="text-left text-uppercase">
																	<?php
																		$arraySize = count($headerArray);
																		
																		for($i=1; $i < $arraySize; $i++)
																		{
																			echo "<th>".$tableColumns[$i]."</th>";
																		}
																	?>
																</tr>
															</thead>
															<tbody>
										<?php
																$countHeader = count($headerArray);
													
																for($i=0; $i < count($result); $i++)
																{ 	
																	echo "<tr>";
																		for($j=1; $j < $countHeader; $j++)
																		{
																			echo "<td>".$result[$i][$headerArray[$j]]."</td>";
																		}
																	echo "</tr>";
																}
										?>
															</tbody>
														</table>
													</div>
													<!--end::Table-->
												</div>
										
										<?php
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
		
		<!--Main Content End-->
		
		<?php 
			$this->load->view(BACKOFFICE.'layout/footer');
			$this->load->view(BACKOFFICE.'layout/jsfiles');
		?>
		
		<!--Js for date picker start-->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/crud/forms/widgets/bootstrap-datepicker7a50.js?v=7.2.7'); ?>"></script>
		<!--Js for date picker end-->
	</body>
</html>