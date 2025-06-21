		<?php 
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu'); //echo "<pre>"; print_r($AGMSalesMoreMoreResult);exit;
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
			.testcolor {
				background: #eef0f8 !important;
			}
			
			.col-xl-2-cust
			{
				max-width: 14.2%;
				padding-right: 4px;
				padding-left: 4px;
			}
			.accordion .card .card-header .card-title {
				padding: 0.5rem 0.5rem;
				font-size: 1.0rem;
			}
		</style>
		<style>
		.tree-diagram ul {
    display: flex;
    position: relative;

    /* Reset */
    list-style-type: none;
    margin: 0;
    padding: 1rem 0.5rem 0rem 0.5rem;
	
}

.tree-diagram ul ul::before {
    border-right: 1px solid #d1d5db;
    content: '';

    /* Position */
    position: absolute;
    top: 0;
    right: 50%;

    /* Size */
    height: 1rem;
    width: 50%;
}

.tree-diagram li {
    padding: 1rem 0.5rem 0rem 0.5rem;
    position: relative;

    /* Center the content */
    align-items: center;
    display: flex;
    flex-direction: column;
	width: max-content;
}

.tree-diagram li::before {
    border-right: 1px solid #d1d5db;
    border-top: 1px solid #d1d5db;
    content: '';

    /* Position */
    position: absolute;
    top: 0;
    right: 50%;

    /* Size */
    height: 1rem;
    width: 50%;
}

.tree-diagram li::after {
    border-top: 1px solid #d1d5db;
    content: '';

    /* Position */
    position: absolute;
    top: 0;
    right: 0;

    /* Size */
    width: 50%;
}

.tree-diagram li:first-child::before,
.tree-diagram li:last-child::after {
    /* Remove the top of border from the first and last items */
    border-top: none;
}

/* Add a root item if you want */
li.tree-diagram__root::before {
    border-right: none;
}

.accordion.accordion-solid .card .card-header {
    background-color: #78879b;
}
.accordion.accordion-panel .card .card-header .card-title {
    background-color: transparent !important;
	color:white;
}
.card, .card-body
{
	background-color: #d9dee8;
}

.card-body
{
	padding-top:10px !important;
}

.separator {
    border-bottom-color: #00A0F5 !important;
}

	</style>
		<div class="content pt-0 d-flex flex-column flex-column-fluid mt-n16 testcolor bg-white" id="kt_content">
			<div class="mt-5">
				<div class="accordion accordion-solid accordion-panel accordion-svg-toggle" id="organizationChart">
					<div class="tree-diagram">
						<ul>
							<li class="tree-diagram__root">
								<div class="card shadow-box mb-0">
									<div class="card-header" id="headingOne8">
										<div class="card-title collapsed text-center" data-toggle="collapse" data-target="#boardOfDirectors">
											<div class="card-label">Board of Directors</div>
										</div>
									</div>
								</div>
								<ul>
									<li>
										<div class="card shadow-box mb-0">
											<div class="card-header" id="headingTwo8">
												<div class="card-title collapsed" data-toggle="collapse" data-target="#JMDCEO">
													<div class="card-label">JMD & CEO</div>
													<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
												</div>
											</div>
											<div id="JMDCEO" class="collapse" data-parent="#organizationChart">
												<div class="card-body">
													<p>
														<?php
															for($i=0; $i<count($JMDCEOResult); $i++)
															{
																echo "<i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$JMDCEOResult[$i]['fullName'];
															}
														?>
													</p>
												</div>
											</div>
										</div>
										<ul>
											<li style="z-index: 10;">
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#DGMPurchase">
															<div class="card-label">Purchase</div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="DGMPurchase" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<?php
																for($i=0; $i<count($DGMPurchaseResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$DGMPurchaseResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$DGMPurchaseResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
												<ul>
													<li>
														<div class="card shadow-box mb-0">
															<div class="card-header" id="headingTwo8">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#DGMPurchaseMore">
																	<div class="card-label">More</div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="DGMPurchaseMore" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	
																	<?php
																		for($i=0; $i<count($DGMPurchaseMoreResult); $i++)
																		{
																			if($DGMPurchaseMoreResult[$i]['designationID'] != '59')
																			{
																			echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$DGMPurchaseMoreResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			$data =$DGMPurchaseMoreResult[$i]['employees'];
																			
																			for($j=0; $j<count($data); $j++)
																			{
																				echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																			}
																			echo "</div>";
																			}
																		}
																	?>
																</div>
															</div>
														</div>
													</li>
												</ul>
											</li>
											<li style="z-index: 10;">
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#AGMSales">
															<div class="card-label">Sales </div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="AGMSales" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<?php
																for($i=0; $i<count($AGMSalesResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$AGMSalesResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$AGMSalesResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
												<ul>
													<li>
														<div class="card shadow-box mb-0">
															<div class="card-header" id="headingAGMSalesMore">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#AGMSalesMore">
																	<div class="card-label">More</div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="AGMSalesMore" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	
																	<?php
																		for($i=0; $i<count($AGMSalesMoreMoreResult); $i++)
																		{
																			if($AGMSalesMoreMoreResult[$i]['designationID'] != '80' && $AGMSalesMoreMoreResult[$i]['designationID'] != '77') 
																			{
																			echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$AGMSalesMoreMoreResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			$data =$AGMSalesMoreMoreResult[$i]['employees'];
																			
																			for($j=0; $j<count($data); $j++)
																			{
																				echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																			}
																			echo "</div>";
																			}
																		}
																		
																	?>
																</div>
															</div>
														</div>
													</li>
												</ul>
											</li>
											<li style="z-index: 10;">
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#ManagerOHSE ">
															<div class="card-label">OHSE </div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="ManagerOHSE" class="collapse" data-parent="#organizationChart">
														<div class="card-body" style="z-index: 20;">
															<?php
																for($i=0; $i<count($ManagerOHSEResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$ManagerOHSEResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$ManagerOHSEResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
												<ul>
													<li>
														<div class="card shadow-box mb-0">
															<div class="card-header" id="headingManagerOHSEMore">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#ManagerOHSEMore">
																	<div class="card-label">More</div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="ManagerOHSEMore" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	
																	<?php
																		for($i=0; $i<count($ManagerOHSEMoreMoreResult); $i++)
																		{
																			if($ManagerOHSEMoreMoreResult[$i]['designationID'] != '67')
																			{
																			echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$ManagerOHSEMoreMoreResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			$data =$ManagerOHSEMoreMoreResult[$i]['employees'];
																			
																			for($j=0; $j<count($data); $j++)
																			{
																				echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																			}
																			echo "</div>";
																			}
																		}
																	?>
																</div>
															</div>
														</div>
													</li>
												</ul>
											</li>
											
											<li style="z-index: 10;">
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#MRQMS">
															<div class="card-label">QMS</div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="MRQMS" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<?php
																for($i=0; $i<count($MRQMSResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$MRQMSResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$MRQMSResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
											</li>
											<li style="z-index: 10;">
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#MREMSOHSAS">
															<div class="card-label">EMS & OHSAS</div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="MREMSOHSAS" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<?php
																for($i=0; $i<count($MREMSOHSASResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$MREMSOHSASResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$MREMSOHSASResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
											</li>
											<li style="width:10px;">
												<!--s-->
												<ul>
													<li>
														<ul>
															<li>
																<ul>
																	<li>
																		<ul>
																			<li>
																				<ul>
																					<li>
																						<ul>
																							<li>
												<!--s-->
												
												<div class="card shadow-box mb-0" style="z-index: 10;">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#GMPlant">
															<div class="card-label">Plant</div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="GMPlant" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<?php
																for($i=0; $i<count($GMPlantResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$GMPlantResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$GMPlantResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
												<ul>
													<li>
														<div class="card shadow-box mb-0" style="z-index: 10;">
															<div class="card-header" id="headingTwo8">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#DGMProduction">
																	<div class="card-label">Production </div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="DGMProduction" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	<?php
																		for($i=0; $i<count($DGMProductionResult); $i++)
																		{
																			echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$DGMProductionResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$DGMProductionResult[$i]['fullName']."</div>";
																			echo "</div>";
																		}
																	?>
																</div>
															</div>
														</div>
														<ul>
															<li>
																<div class="card shadow-box mb-0" style="z-index: 10;">
																	<div class="card-header" id="headingDGMProductionMore">
																		<div class="card-title collapsed" data-toggle="collapse" data-target="#DGMProductionMore">
																			<div class="card-label">More</div>
																			<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																		</div>
																	</div>
																	<div id="DGMProductionMore" class="collapse" data-parent="#organizationChart">
																		<div class="card-body">
																			
																			<?php
																				for($i=0; $i<count($DGMProductionMoreResult); $i++)
																				{
																					if($DGMProductionMoreResult[$i]['designationID']!= '51')
																					{
																						echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$DGMProductionMoreResult[$i]['designationName']."</p>"; 
																			?>
																						<div class="separator separator-solid mb-1"></div>
																			<?php
																			
																						$data =$DGMProductionMoreResult[$i]['employees'];
																						
																						for($j=0; $j<count($data); $j++)
																						{
																							echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																						}
																						echo "</div>";
																					}
																				}
																			?>
																		</div>
																	</div>
																</div>
																<ul>
																	<li>
																		<div class="card shadow-box mb-0" style="z-index: 10;">
																			<div class="card-header" id="headingDGMProductionMoreOperators">
																				<div class="card-title collapsed" data-toggle="collapse" data-target="#DGMProductionMoreOperators">
																					<div class="card-label"><?php echo $DGMProductionMoreOperatorsResult[0]['designationName']."(".$DGMProductionMoreOperatorsResultCount.")"; ?></div>
																					<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																				</div>
																			</div>
																			<div id="DGMProductionMoreOperators" class="collapse" data-parent="#organizationChart">
																				<div class="card-body">
																					
																					<?php
																						for($i=0; $i<count($DGMProductionMoreOperatorsResult); $i++)
																						{
																								echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$DGMProductionMoreOperatorsResult[$i]['designationName']."</p>"; 
																					?>
																								<div class="separator separator-solid mb-1"></div>
																					<?php
																					
																								$data =$DGMProductionMoreOperatorsResult[$i]['employees'];
																								
																								for($j=0; $j<count($data); $j++)
																								{
																									echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																								}
																								echo "</div>";
																						}
																					?>
																				</div>
																			</div>
																		</div>
																	</li>
																</ul>
															</li>
														</ul>	
													</li>
													<li>
														<div class="card shadow-box mb-0">
															<div class="card-header" id="headingTwo8" style="z-index: 10;">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#AGMMaintenance">
																	<div class="card-label">Maintenance</div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="AGMMaintenance" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	<!--
																	<p>
																		<?php
																			for($i=0; $i<count($AGMMaintenanceResult); $i++)
																			{
																				echo "<i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$AGMMaintenanceResult[$i]['fullName'];
																			}
																		?>
																	</p>-->
																	<?php
																		for($i=0; $i<count($AGMMaintenanceResult); $i++)
																		{
																			echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$AGMMaintenanceResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$AGMMaintenanceResult[$i]['fullName']."</div>";
																			echo "</div>";
																		}
																	?>
																</div>
															</div>
														</div>
														<ul>
															<li>
																<div class="card shadow-box mb-0" style="z-index: 10;">
																	<div class="card-header" id="headingAGMMaintenanceMore">
																		<div class="card-title collapsed" data-toggle="collapse" data-target="#AGMMaintenanceMore">
																			<div class="card-label">More</div>
																			<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																		</div>
																	</div>
																	<div id="AGMMaintenanceMore" class="collapse" data-parent="#organizationChart">
																		<div class="card-body">
																			
																			<?php
																				for($i=0; $i<count($AGMMaintenanceMoreResult); $i++)
																				{
																					if($AGMMaintenanceMoreResult[$i]['designationID'] != '27' && $AGMMaintenanceMoreResult[$i]['designationID'] != '1')
																					{
																					echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$AGMMaintenanceMoreResult[$i]['designationName']."</p>"; 
																			?>
																					<div class="separator separator-solid mb-1"></div>
																			<?php
																			
																					$data =$AGMMaintenanceMoreResult[$i]['employees'];
																					
																					for($j=0; $j<count($data); $j++)
																					{
																						echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																					}
																					echo "</div>";
																				}
																				}
																			?>
																		</div>
																	</div>
																</div>															
															</li>
														</ul>
													</li>
													<li>
														<div class="card shadow-box mb-0" style="z-index: 10;">
															<div class="card-header" id="headingTwo8">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#SrManagerQA">
																	<div class="card-label">QA </div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="SrManagerQA" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	<?php
																		for($i=0; $i<count($SrManagerQAResult); $i++)
																		{
																			echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$SrManagerQAResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$SrManagerQAResult[$i]['fullName']."</div>";
																			echo "</div>";
																		}
																	?>
																</div>
															</div>
														</div>
														<ul>
															<li>
																<div class="card shadow-box mb-0" style="z-index: 10;">
																	<div class="card-header" id="headingSrManagerQAMore">
																		<div class="card-title collapsed" data-toggle="collapse" data-target="#SrManagerQAMore">
																			<div class="card-label">More</div>
																			<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																		</div>
																	</div>
																	<div id="SrManagerQAMore" class="collapse" data-parent="#organizationChart">
																		<div class="card-body">
																			
																			<?php
																				for($i=0; $i<count($SrManagerQAMoreResult); $i++)
																				{
																					if($SrManagerQAMoreResult[$i]['designationID'] != '50' && $SrManagerQAMoreResult[$i]['designationID'] != '47')
																					{
																					echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$SrManagerQAMoreResult[$i]['designationName']."</p>"; 
																			?>
																					<div class="separator separator-solid mb-1"></div>
																			<?php
																			
																					$data =$SrManagerQAMoreResult[$i]['employees'];
																					
																					for($j=0; $j<count($data); $j++)
																					{
																						echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																					}
																					echo "</div>";
																					}
																				}
																			?>
																		</div>
																	</div>
																</div>		
															</li>
														</ul>
													</li>
													<li>
														<div class="card shadow-box mb-0" style="z-index: 10;">
															<div class="card-header" id="headingTwo8">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#SrManagerPlanning">
																	<div class="card-label">Planning</div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="SrManagerPlanning" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	<?php
																		for($i=0; $i<count($SrManagerPlanningResult); $i++)
																		{
																			echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$SrManagerPlanningResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$SrManagerPlanningResult[$i]['fullName']."</div>";
																			echo "</div>";
																		}
																	?>
																</div>
															</div>
														</div>													
														<ul>
															<li>
																<div class="card shadow-box mb-0" style="z-index: 10;">
																	<div class="card-header" id="headingSrManagerPlanningMore">
																		<div class="card-title collapsed" data-toggle="collapse" data-target="#SrManagerPlanningMore">
																			<div class="card-label">More</div>
																			<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																		</div>
																	</div>
																	<div id="SrManagerPlanningMore" class="collapse" data-parent="#organizationChart">
																		<div class="card-body">
																			
																			<?php
																				for($i=0; $i<count($SrManagerPlanningMoreResult); $i++)
																				{
																					if($SrManagerPlanningMoreResult[$i]['designationID'] != '69')
																					{
																					echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$SrManagerPlanningMoreResult[$i]['designationName']."</p>"; 
																			?>
																					<div class="separator separator-solid mb-1"></div>
																			<?php
																			
																					$data =$SrManagerPlanningMoreResult[$i]['employees'];
																					
																					for($j=0; $j<count($data); $j++)
																					{
																						echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																					}
																					echo "</div>";
																					}
																				}
																			?>
																		</div>
																	</div>
																</div>		
															</li>
														</ul>
													</li>
													<li>
														<div class="card shadow-box mb-0" style="z-index: 10;">
															<div class="card-header" id="headingTwo8">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#SrManagerEngineering">
																	<div class="card-label">Engineering </div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="SrManagerEngineering" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	<?php
																		for($i=0; $i<count($SrManagerEngineeringResult); $i++)
																		{
																			echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$SrManagerEngineeringResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$SrManagerEngineeringResult[$i]['fullName']."</div>";
																			echo "</div>";
																		}
																	?>
																</div>
															</div>
														</div>
														<ul>
															<li>
																<div class="card shadow-box mb-0" style="z-index: 10;">
																	<div class="card-header" id="headingSrManagerEngineeringMore">
																		<div class="card-title collapsed" data-toggle="collapse" data-target="#SrManagerEngineeringMore">
																			<div class="card-label">More</div>
																			<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																		</div>
																	</div>
																	<div id="SrManagerEngineeringMore" class="collapse" data-parent="#organizationChart">
																		<div class="card-body">
																			
																			<?php
																				for($i=0; $i<count($SrManagerEngineeringMoreResult); $i++)
																				{
																					if($SrManagerEngineeringMoreResult[$i]['designationID'] != '4')
																					{
																					echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$SrManagerEngineeringMoreResult[$i]['designationName']."</p>"; 
																			?>
																					<div class="separator separator-solid mb-1"></div>
																			<?php
																			
																					$data =$SrManagerEngineeringMoreResult[$i]['employees'];
																					
																					for($j=0; $j<count($data); $j++)
																					{
																						echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																					}
																					echo "</div>";
																					}
																				}
																			?>
																		</div>
																	</div>
																</div>		
															</li>
														</ul>
													</li>
													<li>
														<div class="card shadow-box mb-0" style="z-index: 10;">
															<div class="card-header" id="headingTwo8">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#DyManagerCivil">
																	<div class="card-label">Civil</div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="DyManagerCivil" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	<?php
																		for($i=0; $i<count($DyManagerCivilResult); $i++)
																		{
																			echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$DyManagerCivilResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$DyManagerCivilResult[$i]['fullName']."</div>";
																			echo "</div>";
																		}
																	?>
																</div>
															</div>
														</div>
													</li>
												</ul>
												
												<!--s-->				
																							</li>
																						</ul>
																					</li>
																				</ul>
																			</li>
																		</ul>
																	</li>
																</ul>
															</li>
														</ul>
													</li>
												</ul>
												<!--s-->
											</li>
											<li style="z-index: 0;">
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#Secretary">
															<div class="card-label">Secretary</div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="Secretary" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<p>
																<?php
																	for($i=0; $i<count($SecretaryResult); $i++)
																	{
																		echo "<i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$SecretaryResult[$i]['fullName'];
																	}
																?>
															</p>
														</div>
													</div>
												</div>
											</li>
										</ul>
									</li>
									<li>
										<div class="card shadow-box mb-0">
											<div class="card-header" id="headingTwo8">
												<div class="card-title collapsed" data-toggle="collapse" data-target="#WTDCFO">
													<div class="card-label">WTD & CFO</div>
													<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
												</div>
											</div>
											<div id="WTDCFO" class="collapse" data-parent="#organizationChart">
												<div class="card-body">
													<p>
														<?php
															for($i=0; $i<count($WTDCFOResult); $i++)
															{
																echo "<i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$WTDCFOResult[$i]['fullName'];
															}
														?>
													</p>
												</div>
											</div>
										</div>
										<ul>
											<li>
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#ManagerIT">
															<div class="card-label">I.T. </div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="ManagerIT" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<?php
																for($i=0; $i<count($ManagerITResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$ManagerITResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$ManagerITResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
											</li>
											<li>
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#ManagerLegalCS">
															<div class="card-label">Legal & C.S.</div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="ManagerLegalCS" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<?php
																for($i=0; $i<count($ManagerLegalCSResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$ManagerLegalCSResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$ManagerLegalCSResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
											</li>
											<li>
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#AGMFinAccounts">
															<div class="card-label">Fin & Accounts </div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="AGMFinAccounts" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<?php
																for($i=0; $i<count($AGMFinAccountsResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$AGMFinAccountsResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$AGMFinAccountsResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
												<ul>
													<li>
														<div class="card shadow-box mb-0">
															<div class="card-header" id="headingAGMFinAccountsMore">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#AGMFinAccountsMore">
																	<div class="card-label">More</div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="AGMFinAccountsMore" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	
																	<?php
																		for($i=0; $i<count($AGMFinAccountsMoreResult); $i++)
																		{
																			if($AGMFinAccountsMoreResult[$i]['designationID'] != '11' && $AGMFinAccountsMoreResult[$i]['designationID'] != '7')
																			{
																			echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$AGMFinAccountsMoreResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			$data =$AGMFinAccountsMoreResult[$i]['employees'];
																			
																			for($j=0; $j<count($data); $j++)
																			{
																				echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																			}
																			echo "</div>";
																		}
																		}
																	?>
																</div>
															</div>
														</div>		
													</li>
												</ul>
											</li>
											<li>
												<div class="card shadow-box mb-0">
													<div class="card-header" id="headingTwo8">
														<div class="card-title collapsed" data-toggle="collapse" data-target="#AGMHRAdmin ">
															<div class="card-label">H.R.& Admin</div>
															<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
														</div>
													</div>
													<div id="AGMHRAdmin" class="collapse" data-parent="#organizationChart">
														<div class="card-body">
															<?php
															
																for($i=0; $i<count($AGMHRAdminResult); $i++)
																{
																	echo "<div class='mb-0'><p class='font-weight-bold mb-1'>".$AGMHRAdminResult[$i]['designationName']."</p>"; 
															?>
																	<div class="separator separator-solid mb-1"></div>
															<?php
															
																	echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$AGMHRAdminResult[$i]['fullName']."</div>";
																	echo "</div>";
																}
															?>
														</div>
													</div>
												</div>
												<ul>
													<li>
														<div class="card shadow-box mb-0">
															<div class="card-header" id="headingAGMHRAdminMore">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#AGMHRAdminMore">
																	<div class="card-label">More</div>
																	<i class="fas fa-angle-double-right icon-lg text-white icon-1x ml-3"></i>
																</div>
															</div>
															<div id="AGMHRAdminMore" class="collapse" data-parent="#organizationChart">
																<div class="card-body">
																	
																	<?php
																		for($i=0; $i<count($AGMHRAdminMoreResult); $i++)
																		{
																			if($AGMHRAdminMoreResult[$i]['designationID'] != '15')
																			{
																			echo "<div class='mb-5'><p class='font-weight-bold mb-1'>".$AGMHRAdminMoreResult[$i]['designationName']."</p>"; 
																	?>
																			<div class="separator separator-solid mb-1"></div>
																	<?php
																	
																			$data =$AGMHRAdminMoreResult[$i]['employees'];
																			
																			for($j=0; $j<count($data); $j++)
																			{
																				echo "<div><i class='fa fa-circle text-primary mr-2 icon-xs' aria-hidden='true'></i>".$data[$j]['fullName']."</div>";
																			}
																			echo "</div>";
																			}
																		}
																	?>
																</div>
															</div>
														</div>		
													</li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--end::Content-->
		<!--
		<div class="content pt-0 d-flex flex-column flex-column-fluid mt-n16 testcolor bg-white1" id="kt_content" style="display:none;">
			<div class="container mt-25">
				<div class="tree-diagram">
					<ul>
						<li class="tree-diagram__root">
							Board of Directors
							<ul>
								<li>
									JMD & CEO
									<ul>
										<li>Secretary</li>
										<li>
											DGM –Purchase
											<ul>
												<li>
													Manager
													Dy.Manager
													Engineer
												</li>
											</ul>
										</li>
										<li>
											AGM –Sales
											<ul>
												<li>
													Manager
													Dy.Manager
													Engineer
												</li>
											</ul>
										</li>
										<li>
											Manager - OHSE
											<ul>
												<li>
													Manager
													Dy.Manager
													Engineer
												</li>
											</ul>
										</li>
										<li>
											G.M. Plant
											<ul>
												<li>
													DGM – Production
													<ul>
														<li>
															Manager
															Dy.Manager
															Engineer
															<ul>
																<li>Dy. Mgr.- Prod.(4)
																	<ul>
																		<li>Operators(131)</li>
																	</ul>
																</li>
															</ul>
														</li>
													</ul>	
												</li>
												<li>
													AGM – Maintenance
													<ul>
														<li>
															Manager
															Dy.Manager
															Engineer
														</li>
													</ul>
												</li>
												<li>
													Sr. Manager – QA
													<ul>
														<li>
															Manager
															Dy.Manager
															Engineer
														</li>
													</ul>
												</li>
												<li>
													Sr. Manager – Planning
													<ul>
														<li>
															Manager
															Dy.Manager
															Engineer
														</li>
													</ul>
												</li>
												<li>
													Sr. Manager Engineering
													<ul>
														<li>
															Manager
															Dy.Manager
															Engineer
														</li>
													</ul>
												</li>
												<li>
													Dy. Manager - Civil
													<ul>
														<li>
															Manager
															Dy.Manager
															Engineer
														</li>
													</ul>
												</li>
											</ul>
										</li>
										<li>M.R. QMS</li>
										<li>M.R. EMS &amp; OHSAS</li>
									</ul>
								</li>
								<li>
									WTD &amp; CFO
									<ul>
										<li>
											AGM – Fin &amp; Accounts
											<ul>
												<li>
													Manager
													Dy.Manager
													Engineer
												</li>
											</ul>
										</li>
										<li>
											AGM - H.R.&amp;Admin
											<ul>
												<li>
													Manager
													Dy.Manager
													Engineer
												</li>
											</ul>
										</li>
										<li>Manager -I.T.</li>
										<li>Manager- Legal &amp;C.S.</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>-->
		<!--end::Content-->
		
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>