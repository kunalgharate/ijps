		<?php
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu');
			$this->load->helper('date');
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
			/*
			@media (max-width: 700px)
			{
				.SearchOnGoogle
				{
					width: 180px !important;
				}
			}
			
			@media (min-height: 700px) and (max-height: 768px)
			{
				.SearchOnGoogle
				{
					width: 160px !important;
				}
			}
			@media (min-height: 900px) and (max-height: 1050px)
			{
				.SearchOnGoogle
				{
					width: 190px !important;
				}
			}
			
			@media (min-height: 1051px) and (max-height: 1200px)
			{
				.SearchOnGoogle
				{
					width: 300px !important;
				}
			}*/
			
			.SearchOnGoogle
			{
				//width: 210px;
				width: 100%;
			}
		</style>

		<div class="content pt-0 d-flex flex-column flex-column-fluid mt-n16 first1Section" id="kt_content">
			<div class="d-flex flex-column-fluid mt-10">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
							<div class="card card-custom mb-2 shadow-box">
								<div class="card-header border-0 p-5">
									<form class="d-flex flex-center bg-white rounded mb-0" method="GET" action="https://www.google.com/search" target="_blank">
										<div class="symbol symbol-30 symbol-light-white mr-2">
											<div class="symbol-label">
												<img src="<?php echo base_url()."assetsbackoffice/uploads/google.png"; ?>" class="h-100 align-self-end" alt="Google">
											</div>
										</div>
										<input type="text" class="form-control border-1 font-weight-bold pl-2 SearchOnGoogle" placeholder="Search on google" name="q" required/>
										<button type="submit" class="btn btn-primary btn-sm font-weight-bolder ml-2 px-4">GO</button>
									</form>
								</div>
							</div>
							<?php				
								$data891011 = array();

								for($k=8; $k < 11; $k++)
								{
									if($k==8)
									{
										$data891011[$k]['postHeading'] 	= $circularHeading;
										$data891011[$k]['postResult'] 	= $circularPostsResult;
										$data891011[$k]['viewAllURL']	= "circulars";
										$data891011[$k]['count'] 		= $circularPostsCount;
										$data891011[$k]['active']		= "active";
										$data891011[$k]['show']			= "show";
									}
									else if($k==9)
									{
										$data891011[$k]['postHeading'] 	= $policiesHeading;
										$data891011[$k]['postResult']	= $policiesPostsResult;
										$data891011[$k]['viewAllURL']	= "policies";
										$data891011[$k]['count'] 		= $policiesPostsCount;
										$data891011[$k]['active']		= "";
										$data891011[$k]['show']			= "";
									}
									else if($k==10)
									{
										$data891011[$k]['postHeading']	= $handbookHeading;
										$data891011[$k]['postResult'] 	= $handbookPostsResult; 
										$data891011[$k]['viewAllURL']	= "handbook";
										$data891011[$k]['count'] 		= $handbookPostsCount;
										$data891011[$k]['active']		= "";
										$data891011[$k]['show']			= "";
									}
								}
							?>
							<div class="row mb-2">
								<div class="col-xl-12">
									<div class="card card-custom card-stretch">
										<div class="card-header1 border-0 pt-7">
											<!--<h3 class="card-title font-weight-bolder text-dark">ejk</h3>-->
											<div class="card-toolbar1">
												<!--<ul class="nav nav-pills nav-pills-sm nav-dark">-->
												<ul class="nav nav-tabs nav-tabs-line nav-semi-bold justify-content-center">
													<?php
														for($k=8; $k < 11; $k++)
														{
													?>
															<li class="nav-item">
																<a class="nav-link py-1 px-1 <?php echo $data891011[$k]['active']; ?> font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_<?php echo $data891011[$k]['postHeading']; ?>">
																	<?php echo $data891011[$k]['postHeading']; ?>
																</a>
															</li>
													<?php
														}
													?>
												</ul>
											</div>
										</div>
										<!--<div class="separator separator-solid mt-2"></div>-->
										<div class="card-body pt-0">
											<div class="tab-content mt-5" id="myTabLIist18">
												<?php
													for($k=8; $k < 11; $k++)
													{
												?>
														<div class="tab-pane fade <?php echo $data891011[$k]['show']; ?> <?php echo $data891011[$k]['active']; ?>" id="kt_tab_<?php echo $data891011[$k]['postHeading']; ?>" role="tabpanel" aria-labelledby="kt_tab_<?php echo $data891011[$k]['postHeading']; ?>">
															<div class="form">
																<?php
																	$postResult=$data891011[$k]['postResult'];

																	for($i=0; $i < count($postResult); $i++)
																	{
																?>

																	<div class="d-flex align-items-center pb-0">
																		<div class="symbol symbol-40 symbol-light-white mr-2">
																			<div class="symbol-label">
																				<i class="fas fa-file-pdf icon-1x111"></i>
																			</div>
																		</div>
																		<div class="d-flex flex-column flex-grow-1">
																			<a href="<?php echo base_url().UPLOAD_POST.$postResult[$i]['PDFFile']; ?>" target='_BLANK' class="text-dark-75 font-weight-bolder text-hover-primary font-size-sm mb-1">
																				<?php echo $postResult[$i]['postHeading']; ?>
																			</a>
																		</div>
																	</div>
																<?php
																	}
																	
																	if(count($postResult) == '0')
																	{
																		echo $noDataAvailable;
																	}
																	
																	if($data891011[$k]['count'] > 3)
																	{
																?>
																		<div class="d-flex align-items-center pt-5 justify-content-center">
																			<a href="<?php echo base_url()."".$data891011[$k]['viewAllURL']; ?>" target='_BLANK' class="btn btn-outline-primary btn-sm font-weight-bolder text-center btn-block1">View All</a>
																		</div>
																<?php
																	}
																?>
															</div>
														</div>
															
												<?php
													}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<?php
								/*if(count($guestResult)>0)
								{
							?>
									<div class="card card-custom card-stretch1 mb-2 shadow-box" id="Guest">
										<div class="card-header border-5 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label font-weight-bolder text-dark"><?php echo $guestHeading; ?></span>
											</h3>
										</div>
										<div class="card-body p-2">
											<div id="carouselExampleIndicators" class="carousel slide p-1" data-ride="carousel">
												<!--<ol class="carousel-indicators">
													<?php							
														for($i=0; $i < count($guestResult); $i++)
														{
															$active = "";
															
															if($i=='0')
															{
																$active = "active";
															}
														
													?>
															<li class="bg-dark" data-target="#carouselExampleIndicators" data-slide-to="<?php $i; ?>" class="<?php echo $active; ?>"></li>
													<?php
														}
													?>
												</ol>-->
												<div class="carousel-inner">
													<?php							
														for($i=0; $i < count($guestResult); $i++)
														{
															$active = "";
															
															if($i=='0')
															{
																$active = "active";
															}
													?>
															<div class="carousel-item <?php echo $active; ?>">
																<div class="card card-custom gutter-b card-stretch shadow-box1">
																	<div class="card-body text-center p-1">
																		<div class="my-2">
																			<span class="text-dark font-weight-bold text-hover-primary font-size-h4">
																				<?php echo $guestResult[$i]['guestFullName']; ?>
																			</span>
																		</div>
																		<div class="mt-2">
																			<div class="symbol symbol-circle symbol-lg-120">
																				<img src="<?php echo base_url().UPLOAD_GUEST_PHOTO.$guestResult[$i]['photo']; ?>" alt="image">
																			</div>
																		</div>
																		<div class="my-2">
																			<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $guestResult[$i]['guestFullName']; ?></span>
																			<p>(<?php echo $guestResult[$i]['designationName']; ?>)</p>
																		</div>
																		<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold">
																			<?php echo date('d M Y', strtotime($guestResult[$i]['visitDate'])); ?>
																		</span>
																		<div class="my-2 mt-3">
																			<p><?php echo $guestResult[$i]['introduction']; ?></p>
																		</div>
																	</div>
																</div>
															</div>
													<?php
														}
														
														if(count($guestResult) == '0')
														{
															echo $noDataAvailable;
														}
													?>
												</div>
												<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
													<span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
													<span class="sr-only">Previous</span>	
												</a>
												<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
													<span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
													<span class="sr-only">Next</span>
												</a>
											</div>
										</div>
									</div>
							<?php
								} *///exit;
							?>
							
							<?php
								if(count($guestResult)>0 || count($todaysBirthdayResult)>0 || count($todaysWorkAnniversariesResult)>0 || count($newEmployeeAnnouncementResult)>0)
								{
							
								for($k=1; $k < 5; $k++)
								{
									if($k==1)
									{
										$dataPost[$k]['postHeading'] 	= $guestHeading;
										$dataPost[$k]['postResult'] 	= 	$guestResult;
										$dataPost[$k]['viewAllURL']	= "guests";
										$dataPost[$k]['count'] 		= $guestCount;
										$dataPost[$k]['active']		= "active";
										$dataPost[$k]['show']			= "show";
									}
									else if($k==2)
									{
										$dataPost[$k]['postHeading'] 	= $todaysBirthdayHeading;
										$dataPost[$k]['postResult'] 	= $todaysBirthdayResult;
										$dataPost[$k]['viewAllURL']		= "todaysBirthday";
										$dataPost[$k]['count'] 			= count($todaysBirthdayResult);
										$dataPost[$k]['active']			= "";
										$dataPost[$k]['show']			= "";
									}
									else if($k==3)
									{
										$dataPost[$k]['postHeading']	= $todaysWorkAnniversariesHeading;
										$dataPost[$k]['postResult'] 	= $todaysWorkAnniversariesResult; 
										$dataPost[$k]['viewAllURL']		= "todaysWorkAnniversaries";
										$dataPost[$k]['count'] 			= count($todaysWorkAnniversariesResult);
										$dataPost[$k]['active']			= "";
										$dataPost[$k]['show']			= "";
									}
									else if($k==4)
									{
										$dataPost[$k]['postHeading']	= $newEmployeeAnnouncementHeading;
										$dataPost[$k]['postResult'] 	= $newEmployeeAnnouncementResult; 
										$dataPost[$k]['viewAllURL']		= "newEmployeeAnnouncement";
										$dataPost[$k]['count'] 			= count($newEmployeeAnnouncementResult);
										$dataPost[$k]['active']			= "";
										$dataPost[$k]['show']			= "";
									}
								}
							?>
							<div class="card card-custom card-stretch1 mb-2 shadow-box" id="Guest">
								<div class="card-body p-2">
									<div id="carouselExampleIndicators" class="carousel slide p-1" data-ride="carousel">
										<div class="carousel-inner">
											<?php	
												$active = "";
												$activeFlag = 0;
													
												for($k=1; $k < 5; $k++)
												{
													
													$postResult=$dataPost[$k]['postResult'];
													
													$count = 0;
													if(count($postResult) > 3)
													{
														$count = 3;
													}
													else
													{
														$count = count($postResult);
													}
													
													for($i=0; $i < $count; $i++)
													{
														if($activeFlag =='0')
														{
															$active = "active";
															$activeFlag = 1;
														}
														else
														{
															$active = "";
														}
														
											?>
													<div class="carousel-item <?php echo $active; ?>">
														<div class="card card-custom gutter-b card-stretch shadow-box1">
															<div class="card-body text-center p-1">
																<div class="my-4">
																	<span class="card-title font-weight-bolder text-dark text-hover-primary font-size-h411 ">
																		<?php 
																			echo $dataPost[$k]['postHeading'];
																		?>
																		<div class="separator separator-solid separator-border-2 my-2"></div>
																	</span>
																</div>
																<div class="mt-2">
																	<div class="symbol symbol-circle symbol-lg-120">
																		<?php 
																			if($k=='1')
																			{
																				$photo = base_url().UPLOAD_GUEST_PHOTO."/".$postResult[$i]['photo'];
																			}
																			else
																			{
																				//$photo = 'UPLOAD_EMPLOYEE_PHOTO';
																				$photo = base_url().UPLOAD_EMPLOYEE_PHOTO."/".$postResult[$i]['photo'];
																			}
																		?>
																		<img src="<?php echo $photo; ?>" alt="image">
																	</div>
																</div>
																<div class="my-2">
																	<span class="text-dark font-weight-bold text-hover-primary font-size-h4">
																		<?php 
																			if($k=='1')
																			{
																				echo $postResult[$i]['guestFullName'];
																			}
																			else
																			{
																				echo $postResult[$i]['fullName'];
																			}
																		?>
																	</span>
																	<p>(
																		<?php 
																			if($k=='1')
																			{
																				echo $postResult[$i]['designationName'];
																			}
																			else
																			{
																				echo $postResult[$i]['designationName']." - ".$postResult[$i]['departmentName'];;
																			}
																		?>
																		)
																	</p>
																</div>
																<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold">
																	<?php 
																		if($k==1)
																		{
																			echo date('d M Y', strtotime($postResult[$i]['visitDate']));
																		}
																		else if($k==2)
																		{
																			echo date('d M', strtotime($postResult[$i]['dateOf‎Birth'])); 
																		}
																		else
																		{
																			echo date('d M Y', strtotime($postResult[$i]['dateOfJoining']));
																		}
																	?>
																</span>
																<?php 
																	if($k=='1')
																	{
																?>
																		<div class="my-2 mt-3">
																			<p>
																				<?php echo $postResult[$i]['introduction']; ?>
																			</p>
																		</div>
																<?php
																	}
																	else
																	{
																?>
																		<div class="mb-4 mt-5">
																			<table class="table table-bordered">
																				<tbody>
																					<tr>
																						<th scope="row">Email : </th>
																						<td><?php echo $postResult[$i]['emailAddress']; ?></td>
																					</tr>
																					<tr>
																						<th scope="row">Phone : </th>
																						<td><?php echo $postResult[$i]['contactNumber']; ?></td>
																					</tr>
																					<tr>
																						<th scope="row">Landline : </th>
																						<td><?php echo $postResult[$i]['landlineNumber']; ?></td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																<?php
																	}
																?>
																	<?php

																		if(count($postResult) > 2)
																		{
																	?>
																			<p><a href="<?php echo base_url().$dataPost[$k]['viewAllURL']; ?>" target='_BLANK' class="mt-5 btn btn-outline-primary btn-sm font-weight-bolder text-center btn-block1">View All</a></p>
																	<?php
																		}
																	?>
															</div>
														</div>
													</div>
											<?php
													}
												}
											?>
										</div>
										<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>	
										</a>
										<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
											<span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
								</div>
							</div>
							
							<?php
								}
							?>
								
							<div class="card card-custom card-stretch1 mb-2 shadow-box" id="ImportantLinks">
								<div class="card-header border-5 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label font-weight-bolder text-dark"><?php echo $importantLinkHeading; ?></span>
									</h3>
								</div>
								<div class="card-body pt-4">
									<div class="row">
										<div class="col-xl-12">
											<h6><?php echo $importantLinkInternalHeading; ?></h6>
											<div class="separator separator-solid separator-border-2 my-2"></div>
										</div>
									<?php										
										for($j=0; $j < count($importantLinksInternalResult); $j++)
										{
									?>
										<div class="col-xl-12">
											<div class="d-flex align-items-center mb-1">
												<div class="symbol symbol-40 symbol-light-white mr-1">
													<div class="symbol-label">
														<i class="fas fa-caret-right icon-1x"></i>
													</div>
												</div>
												<div class="d-flex flex-column font-weight-bold">
													<a href="<?php echo $importantLinksInternalResult[$j]['URL']; ?>" target="_blank" class="text-dark text-hover-primary mb-1 font-size-lg">
														<?php echo $importantLinksInternalResult[$j]['heading']; ?>
													</a>
												</div>
											</div>
										</div>
									<?php
										}
										
										if(count($importantLinksInternalResult) == '0')
										{
											echo "<div class='col-xl-12'>".$noDataAvailable."</div>";
										}
									?>
									</div>
									
									<div class="row mt-5">
										<div class="col-xl-12">
											<h6 class="ml-6"><?php echo $importantLinkExternalHeading; ?></h6>
											<div class="separator separator-solid separator-border-2 my-2"></div>
										</div>
									<?php										
										for($j=0; $j < count($importantLinksExternalResult); $j++)
										{
									?>
										<div class="col-xl-12">
											<div class="d-flex align-items-center mb-1">
												<div class="symbol symbol-40 symbol-light-white mr-1">
													<div class="symbol-label">
														<i class="fas fa-caret-right icon-1x"></i>
													</div>
												</div>
												<div class="d-flex flex-column font-weight-bold">
													<a href="<?php echo $importantLinksExternalResult[$j]['URL']; ?>" target="_blank" class="text-dark text-hover-primary mb-1 font-size-lg">
														<?php echo $importantLinksExternalResult[$j]['heading']; ?>
													</a>
												</div>
											</div>
										</div>
									<?php
										}
										
										if(count($importantLinksExternalResult) == '0')
										{
											echo "<div class='col-xl-12'>".$noDataAvailable."</div>";
										}
									?>
									</div>
								</div>
							</div>
						
						
							<?php

								
								if(count($notificationListResult)>0)
								{
							?>
									<div class="card card-custom card-stretch1 mb-2 shadow-box">
										<div class="card-header border-5 pt-5">
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label font-weight-bolder text-dark"><?php echo $notificationListHeading; ?></span>
											</h3>
										</div>
										<div class="card-body p-2">
											<?php			
												
											//print_r($notificationListResult);exit;
												for($i=0; $i < count($notificationListResult); $i++)
												{
													if($notificationListResult[$i]['url']!="")
													{
											?>
											
											<div class="col-xl-12">
												<div class="d-flex align-items-center mb-1">
													<div class="symbol symbol-40 symbol-light-white mr-1">
														<div class="symbol-label">
															<i class="fas fa-caret-right icon-1x"></i>
														</div>
													</div>
													<div class="d-flex flex-column font-weight-bold">
														<a href="<?php echo site_url().$notificationListResult[$i]['url']; ?>" target="_blank" class="text-dark text-hover-primary mb-1 font-size-lg">
															<?php echo $notificationListResult[$i]['description']; ?>
														</a>
														<?php
														/*
															$todayDate = strtotime(date("d-m-Y h:m:s"));
															
															$createdDate = strtotime(date('d-m-Y h:m:s', strtotime($notificationListResult[$i]['createdDate'])));
															//strtotime(date("d-m-Y h:i:s", $notificationListResult[$i]['createdDate']));
															//$createdDate = date("d-m-Y", $‎createdDate);
															
															$difference = abs($createdDate - $todayDate)/3600;

															if($difference < 1)
															{
																$difference = round(abs($createdDate - $todayDate)/60,0);
																$difference = $difference." minutes";
															}
															else if($difference > 24)
															{
																$difference = abs($createdDate - $todayDate)/(60*60*24);
																$difference = round($difference)." days";
															}
															else
															{
																$difference = round($difference)." hrs";
															}
															*/
														?>
														
														<!--<div class="text-muted"><?php echo $difference; ?> ago</div>
														<div class="text-muted"><?php echo timespan(strtotime(date('d-m-Y h:m:s', strtotime($notificationListResult[$i]['createdDate']))), time(), 1); ?> ago</div>-->
														<div class="text-muted"><?php echo get_time_ago(strtotime(date('d-m-Y h:m:s', strtotime($notificationListResult[$i]['createdDate'])))); ?> ago</div>
													</div>
												</div>
											</div>
											<?php
													}
												}
												
												if(count($notificationListResult) == '0')
												{
													echo $noDataAvailable;
												}
											?>
										</div>
									</div>
							<?php
								} //exit;
							?>
						</div>
						<div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
							<!--begin:: Image Slider section-->
							<div id="herosection" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#herosection" data-slide-to="0" class="active"></li>
									<li data-target="#herosection" data-slide-to="1"></li>
									<li data-target="#herosection" data-slide-to="2"></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="d-block w-100" src="<?php echo base_url('assetsbackoffice/img/banner.png'); ?>" alt="...">
										<div class="carousel-caption d-none d-md-block">
											<h5>Rothe Erde India Pvt. Ltd.- Thyssenkrupp </h5>
											<p>engineering. tomorrow. together</p>
										</div>
									</div>
									<div class="carousel-item">
										<img class="d-block w-100" src="<?php echo base_url('assetsbackoffice/img/banner1.png'); ?>" alt="...">
										<div class="carousel-caption d-none d-md-block">
											<h5>Rothe Erde India Pvt. Ltd.- Entrance</h5>
											<p>We have over 11 companies, with 14 plants in 10 countries.</p>
										</div>
									</div>
									<div class="carousel-item">
										<img class="d-block w-100" src="<?php echo base_url('assetsbackoffice/img/banner2.png'); ?>" alt="...">
										<div class="carousel-caption d-none d-md-block">
											<h5>Rothe Erde India Pvt. Ltd.- Plant</h5>
											<p>thyssenkrupp rothe erde is part of thyssenkrupp’s international group of companies.</p>
										</div>
									</div>
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
							<!--end:: Image slider section-->
							
							<!--begin:: Image Slider section-->
							<div class="row mt-2">
								<?php	
								
									for($k=1; $k < 7; $k++)
									{
										if($k==1)
										{
											$postHeading	=  $HRCommunicationsAndUpdateHeading;
											$postResult 	=  $HRCommunicationsAndUpdatePostsResult;
											$viewAllURL		= "HRcommunicationsAndUpdates";
											$count 			= $HRCommunicationsAndUpdatePostsCount;
										}
										else if($k==2)
										{
											$postHeading	=  $newsHeading;
											$postResult 	=  $newsPostsResult; 
											$viewAllURL		= "news";
											$count 			= $newsPostsCount;
										}
										else if($k==3)
										{
											$postHeading 	=  $eventHeading;
											$postResult		=  $eventPostsResult;
											$viewAllURL		= "events";
											$count 			= $eventPostsCount;
										}
										else if($k==4)
										{
											$postHeading	=  $CSRHeading;
											$postResult 	=  $CSRPostsResult;
											$viewAllURL		= "CSR";
											$count 			= $CSRPostsCount;
										}
										else if($k==5)
										{
											$postHeading	= $safetyInstructionHeading;
											$postResult 	= $safetyInstructionPostsResult;
											$viewAllURL		= "safetyInstructions";
											$count 			= $safetyInstructionPostsCount;
										}
										else if($k==6)
										{
											$postHeading	=  $alertHeading;
											$postResult 	=  $alertPostsResult;
											$viewAllURL		= "alerts";
											$count 			= $alertPostsCount;
										}
														
										
										/*
										if($k==1)
										{
											$postHeading	=  $trainingHeading;
											$postResult 	=  $trainingPostsResult;
											$viewAllURL		= "trainings";
											$count 			= $trainingPostsCount;
										}
										else if($k==2)
										{
											$postHeading	=  $upcomingTrainingHeading;
											$postResult 	=  $upcomingTrainingPostsResult;
											$viewAllURL		= "trainings";
											$count 			= $upcomingTrainingPostsCount;
										}
										*/
								?>
								<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mb-2">
									<div class="card card-custom card-stretch">
										<div class="card-header border-0">
											<h3 class="card-title font-weight-bolder text-dark"><?php echo $postHeading; ?></h3>
											<div class="card-toolbar">
												<?php									
													if($count > 3)
													{
												?>
													<a href="<?php echo base_url()."".$viewAllURL; ?>" target='_BLANK' class="btn btn-outline-primary btn-sm font-weight-bolder text-center btn-block1">View All</a>
												<?php
													}
												?>
											</div>
										</div>
										<div class="separator separator-solid mb-2"></div>
										<div class="card-body p-4">
											<?php
												for($i=0; $i < count($postResult); $i++)
												{
											?>
													<div class="d-flex align-items-center mb-4">
														<div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-3">
															<div class="symbol-label" style="background-image: url('<?php echo base_url().UPLOAD_POST.$postResult[$i]['thumbnailImage']; ?>')"></div>
														</div>

														<div class="d-flex flex-column flex-grow-1">
															<a href="<?php echo base_url().$viewAllURL."/".$postResult[$i]['postID']; ?>" class="text-dark font-weight-bolder font-size-lg text-hover-primary mb-1"><?php echo $postResult[$i]['postHeading']; ?></a>
															<span class="text-dark-50 font-weight-normal font-size-sm">
																<?php echo strip_tags(substr($postResult[$i]['postShortDescription'], 0, 50)); ?>...
															</span>
														</div>
													</div>
											<?php
												}
												
												if(count($postResult) == '0')
												{
													echo $noDataAvailable;
												}
											?>
												
										</div>
									</div>
								</div>
								<?php
									}
								?>
								
								<div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 mb-2">
									<div class="card card-custom card-stretch">
										<div class="card-header border-0">
											<h3 class="card-title font-weight-bolder text-dark">Emergency Contacts</h3>
											<div class="card-toolbar">
												<?php
													/*if($emergencyContactCategoryCount > 2)
													{*/
												?>
														<a href="<?php echo base_url()."emergencyContacts"; ?>" target='_BLANK' class="btn btn-outline-primary btn-sm font-weight-bolder text-center btn-block1">View All</a>
												<?php
													//}
												?>
											</div>
										</div>
										<div class="separator separator-solid mb-2"></div>
										<div class="card-body p-2">
											<div class="row">
											<?php							
												for($i=0; $i < count($emergencyContactCategoryResult); $i++)
												{
											?>
													<div class="col-xl-6 col-lg-6 col-md-12 col-sm-6">
														<div class="card card-custom card-stretch gutter-b shadow-box1">
															<div class="card-header border-2">
																<h3 class="card-title font-weight-bolder text-dark"><?php echo $emergencyContactCategoryResult[$i]['name']; ?></h3>
																<div class="card-toolbar">
																	<?php
																		$dataResult = $emergencyContactResult[$emergencyContactCategoryResult[$i]['emergencyContactCategoryID']];
																		$count = 3;
																		/*if(count($dataResult) > 3)
																		{
																	?>
																			<a href="<?php echo base_url()."emergencyContacts"; ?>" target='_BLANK' class="btn btn-outline-primary btn-sm font-weight-bolder text-center btn-block1">View All</a>
																	<?php
																		}
																		else{
																			$count = count($dataResult);
																		}*/
																	?>
																</div>
															</div>
															<div class="card-body p-4">
											<?php							
																for($j=0; $j < $count; $j++)
																{
											?>
																	<div class="d-flex align-items-center mb-1">
																		<div class="symbol symbol-40 symbol-light-white mr-2">
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
																
																if($count == '0')
																{
																	echo $noDataAvailable;
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
									$postDataResult = array();

									for($k=1; $k < 3; $k++)
									{
										if($k==1)
										{
											$postDataResult[$k]['postHeading'] 	= $trainingHeading;
											$postDataResult[$k]['postResult'] 	= $trainingPostsResult;
											$postDataResult[$k]['viewAllURL']	= "trainings";
											$postDataResult[$k]['count'] 		= $trainingPostsCount;
											$postDataResult[$k]['active']		= "active";
											$postDataResult[$k]['show']			= "show";
										}
										else if($k==2)
										{
											$postDataResult[$k]['postHeading'] 	= $upcomingTrainingHeading;
											$postDataResult[$k]['postResult']	= $upcomingTrainingPostsResult;
											$postDataResult[$k]['viewAllURL']	= "trainings";
											$postDataResult[$k]['count'] 		= $upcomingTrainingPostsCount;
											$postDataResult[$k]['active']		= "";
											$postDataResult[$k]['show']			= "";
										}
									}
								?>
								<div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 mb-2">
									<div class="card card-custom card-stretch">
										<div class="card-header1 border-0 pt-7">
											<!--<h3 class="card-title font-weight-bolder text-dark">ejk</h3>-->
											<div class="card-toolbar1">
												<!--<ul class="nav nav-pills nav-pills-sm nav-dark">-->
												<ul class="nav nav-tabs nav-tabs-line nav-semi-bold justify-content-center">
													<?php
														for($k=1; $k < 3; $k++)
														{
													?>
															<li class="nav-item">
																<a class="nav-link py-1 px-1 <?php echo $postDataResult[$k]['active']; ?> font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_training_<?php echo $k; ?>">
																	<?php echo $postDataResult[$k]['postHeading']; ?>
																</a>
															</li>
													<?php
														}
													?>
												</ul>
											</div>
										</div>
										<!--<div class="separator separator-solid mt-2"></div>-->
										<div class="card-body p-5">
											<div class="tab-content mt-5" id="myTabLIist18">
												<?php
													for($k=1; $k < 3; $k++)
													{
												?>
														<div class="tab-pane fade <?php echo $postDataResult[$k]['show']; ?> <?php echo $postDataResult[$k]['active']; ?>" id="kt_tab_training_<?php echo $k; ?>" role="tabpanel" aria-labelledby="kt_tab_<?php echo $postDataResult[$k]['postHeading']; ?>">
															<div class="form">
																<?php
																	$postResult=$postDataResult[$k]['postResult'];
																	
																	$postCount = 0;
									
																	if(count($postResult) < 3)
																	{
																		$postCount = count($postResult);
																	}
																	else
																	{
																		$postCount = 3;
																	}
																	
																	for($i=0; $i < $postCount; $i++)
																	{
																?>
																	<div class="d-flex align-items-center mb-4">
																		<div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-3">
																			<div class="symbol-label" style="background-image: url('<?php echo base_url().UPLOAD_POST.$postResult[$i]['thumbnailImage']; ?>')"></div>
																		</div>

																		<div class="d-flex flex-column flex-grow-1">
																			<a href="<?php echo base_url()."trainings/".$postResult[$i]['postID']; ?>" class="text-dark font-weight-bolder font-size-lg text-hover-primary mb-1"><?php echo $postResult[$i]['postHeading']; ?></a>
																			<span class="text-dark-50 font-weight-normal font-size-sm">
																				<?php echo strip_tags(substr($postResult[$i]['postShortDescription'], 0, 50)); ?>...
																			</span>
																		</div>
																	</div>
																<?php
																	}
																	
																	if($postCount == '0')
																	{
																		echo $noDataAvailable;
																	}
																	
																	if($postDataResult[$k]['count'] > 3)
																	{
																?>
																		<div class="d-flex align-items-center pt-5 justify-content-center">
																			<a href="<?php echo base_url()."".$postDataResult[$k]['viewAllURL']; ?>" target='_BLANK' class="btn btn-outline-primary btn-sm font-weight-bolder text-center btn-block1">View All</a>
																		</div>
																<?php
																	}
																?>
															</div>
														</div>
															
												<?php
													}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row" id="NewEmployeeAnnouncement">
								<?php				
									$dataPost = array();

									for($k=0; $k < 3; $k++)
									{
										/*if($k==0)
										{
											$dataPost[$k]['postHeading'] 	= $todaysBirthdayHeading;
											$dataPost[$k]['postResult'] 	= $todaysBirthdayResult;
											$dataPost[$k]['viewAllURL']		= "todaysBirthday";
											$dataPost[$k]['count'] 			= count($todaysBirthdayResult);
											$dataPost[$k]['active']			= "active";
											$dataPost[$k]['show']			= "show";
										}
										else if($k==2)
										{
											$dataPost[$k]['postHeading']	= $todaysWorkAnniversariesHeading;
											$dataPost[$k]['postResult'] 	= $todaysWorkAnniversariesResult; 
											$dataPost[$k]['viewAllURL']		= "todaysWorkAnniversaries";
											$dataPost[$k]['count'] 			= count($todaysWorkAnniversariesResult);
											$dataPost[$k]['active']			= "";
											$dataPost[$k]['show']			= "";
										}
										else if($k==5)
										{
											$dataPost[$k]['postHeading']	= $newEmployeeAnnouncementHeading;
											$dataPost[$k]['postResult'] 	= $newEmployeeAnnouncementResult; 
											$dataPost[$k]['viewAllURL']		= "newEmployeeAnnouncement";
											$dataPost[$k]['count'] 			= count($newEmployeeAnnouncementResult);
											$dataPost[$k]['active']			= "";
											$dataPost[$k]['show']			= "";
										}
										else */
											
										if($k==0)
										{
											$dataPost[$k]['postHeading'] 	= $upcomingBirthdayHeading;
											$dataPost[$k]['postResult']		= $upcomingBirthdayResult;
											$dataPost[$k]['viewAllURL']		= "upcomingBirthday";
											$dataPost[$k]['count'] 			= count($upcomingBirthdayResult);
											$dataPost[$k]['active']			= "active";
											$dataPost[$k]['show']			= "show";
										}
										
										else if($k==1)
										{
											$dataPost[$k]['postHeading']	= $upcomingWorkAnniversariesHeading;
											$dataPost[$k]['postResult'] 	= $upcomingWorkAnniversariesResult; 
											$dataPost[$k]['viewAllURL']		= "upcomingWorkAnniversaries";
											$dataPost[$k]['count'] 			= count($upcomingWorkAnniversariesResult);
											$dataPost[$k]['active']			= "";
											$dataPost[$k]['show']			= "";
										}
										else if($k==2)
										{
											$dataPost[$k]['postHeading']	= $employeeOfTheMonthYearHeading;
											$dataPost[$k]['postResult'] 	= $employeeOfTheMonthYearResult; 
											$dataPost[$k]['viewAllURL']		= "";
											$dataPost[$k]['count'] 			= count($employeeOfTheMonthYearResult);
											$dataPost[$k]['active']			= "";
											$dataPost[$k]['show']			= "";
										}
										
									}
								?>
								<div class="col-xl-12 mb-2">
									<div class="card card-custom card-stretch">
										<div class="card-header1 border-0 pt-7">
											<!--<h3 class="card-title font-weight-bolder text-dark">ejk</h3>-->
											<div class="card-toolbar1">
												<!--<ul class="nav nav-pills nav-pills-sm nav-dark">-->
												<ul class="nav nav-tabs nav-tabs-line nav-semi-bold justify-content-center">
													<?php
														for($k=0; $k < count($dataPost); $k++)
														{
													?>
															<li class="nav-item">
																<a class="nav-link py-1 px-1 mr-1 <?php echo $dataPost[$k]['active']; ?> font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_<?php echo $k."-1"; ?>">
																	<?php echo $dataPost[$k]['postHeading']; ?>
																</a>
															</li>
													<?php
														}
													?>
												</ul>
											</div>
										</div>
										<!--<div class="separator separator-solid mt-2"></div>-->
										<div class="card-body pt-0">
											<div class="tab-content mt-5" id="myTabLIist18">
												<?php
													for($k=0; $k < count($dataPost); $k++)
													{ 
												?>
														<div class="tab-pane fade <?php echo $dataPost[$k]['show']; ?> <?php echo $dataPost[$k]['active']; ?>" id="kt_tab_<?php echo $k."-1"; ?>" role="tabpanel" aria-labelledby="kt_tab_<?php echo $k."-1"; ?>">
															<div class="form">
																<div class="row">
																	<?php
																		$count = 0;
																		$postResult=$dataPost[$k]['postResult'];
																		
																		if(count($postResult) > 3)
																		{
																			$count = 3;
																		}
																		else
																		{
																			$count = count($postResult);
																		}
																		
																		for($i=0; $i < $count; $i++)
																		{
																	?>
																		<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
																			<div class="card-header-right ribbon ribbon-clip ribbon-right">
																				<div class="ribbon-target font-size-xs" style="top: 3px;">
																					<span class="ribbon-inner bg-brand"></span>
																					<?php 
																						if($k==0) /* || $k==1)*/
																						{
																							echo date('d M', strtotime($postResult[$i]['dateOf‎Birth'])); 
																						}
																						else
																						{
																							echo date('d M Y', strtotime($postResult[$i]['dateOfJoining']));
																						}
																						
																					?>
																				</div>
																			<div class="shadow-box pr-5 pl-5">
																				<div class="d-flex align-items-center pt-4 mb-3">
																					<div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
																						<div class="symbol symbol-circle symbol-lg-75">
																							<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$postResult[$i]['photo']; ?>" alt="image" />
																						</div>
																						<div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
																							<span class="font-size-h3 font-weight-boldest">JM</span>
																						</div>
																					</div>
																					<div class="d-flex flex-column">
																						<a class="text-dark font-weight-bold text-hover-primary font-size-lg mb-0">
																							<?php echo $postResult[$i]['fullName']; ?>
																						</a>
																						<span class="text-muted font-weight-bold font-size-sm"><?php echo $postResult[$i]['designationName']; ?></span>
																						<span class="text-muted font-weight-bold font-size-xs">(<?php echo $postResult[$i]['departmentName']; ?>)</span>
																					</div>
																				</div>
																				<?php
																					if($k==2)
																					{
																						$headingEmp = "";
																						if($postResult[$i]['employeeOfTheMonthFlag'])
																						{
																							$headingEmp = "Employee Of The Month";
																						}
																						else 
																						{
																							$headingEmp = "Employee Of The Year";
																						}
																				?>
																						<div class="mb-4 bg-primary p-2">
																							<div class="text-white font-weight-bold font-size-lg mb-0 text-center">
																								<?php echo $headingEmp; ?>
																							</div>
																						</div>
																				<?php
																					}
																					
																					if($k==1)
																					{
																						$date_of_joining = new DateTime($postResult[$i]['dateOfJoining']);
																						$current_date = new DateTime();
																						$interval = $current_date->diff($date_of_joining);
																						$diff = $interval->y;
																				?>
																						<div class="mb-4 bg-primary p-2">
																							<div class="text-white font-weight-bold font-size-lg mb-0 text-center">
																								<?php echo $diff." Years Completed"; ?>
																							</div>
																						</div>
																				<?php		
																					}
																				?>
																				<!--
																				<div class="mb-4">
																					<div class="d-flex justify-content-between align-items-center">
																						<span class="text-dark-75 font-weight-bolder font-size-sm mr-2">Email :</span>
																						<a href="#" class="text-muted text-hover-primary font-size-sm"><?php echo $postResult[$i]['emailAddress']; ?></a>
																					</div>
																					<div class="d-flex justify-content-between align-items-cente my-1">
																						<span class="text-dark-75 font-weight-bolder mr-2 font-size-sm">Phone :</span>
																						<a href="#" class="text-muted text-hover-primary font-size-sm"><?php echo $postResult[$i]['contactNumber']; ?></a>
																					</div>
																					<div class="d-flex justify-content-between align-items-center">
																						<span class="text-dark-75 font-weight-bolder mr-2 font-size-sm">Landline :</span>
																						<span class="text-muted font-weight-bold font-size-sm"><?php echo $postResult[$i]['landlineNumber']; ?></span>
																					</div>
																				</div>
																				-->
																			</div>
																			</div>
																		</div>
																	<?php
																		}
																		
																		if($count == '0')
																		{
																			echo "<div class='col-xl-12'>".$noDataAvailable."</div>";
																		}
																	?>
																	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
																		
																		<?php
																			if(count($postResult) > 3)
																			{
																		?>
																				<div class="d-flex align-items-center pt-5 justify-content-center"><a href="<?php echo base_url().$dataPost[$k]['viewAllURL']; ?>" target='_BLANK' class="btn btn-outline-primary btn-sm font-weight-bolder text-center">View All</a></div>
																		<?php
																			}
																		?>
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
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end::Content-->

		<?php /*
		<div class="d-flex flex-column-fluid mt-1" id="NewEmployeeAnnouncement">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12">
						<div class="card card-custom card-stretch gutter-b">
							<div class="card-header1 border-0 pt-7">
								<!--<h3 class="card-title font-weight-bolder text-dark">ejk</h3>-->
								<div class="card-toolbar1">
									<!--<ul class="nav nav-pills nav-pills-sm nav-dark">-->
									<ul class="nav nav-tabs nav-tabs-line nav-semi-bold justify-content-center">
										<?php
											for($k=0; $k < count($dataPost); $k++)
											{
										?>
												<li class="nav-item">
													<a class="nav-link py-1 px-1 mr-1 <?php echo $dataPost[$k]['active']; ?> font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_<?php echo $k; ?>">
														<?php echo $dataPost[$k]['postHeading']; ?>
													</a>
												</li>
										<?php
											}
										?>
									</ul>
								</div>
							</div>
							<!--<div class="separator separator-solid mt-2"></div>-->
							<div class="card-body pt-0">
								<div class="tab-content mt-5" id="myTabLIist18">
									<?php
										for($k=0; $k < count($dataPost); $k++)
										{ 
									?>
											<div class="tab-pane fade <?php echo $dataPost[$k]['show']; ?> <?php echo $dataPost[$k]['active']; ?>" id="kt_tab_<?php echo $k; ?>" role="tabpanel" aria-labelledby="kt_tab_<?php echo $k; ?>">
												<div class="form">
													<div class="row">
														<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
															<div class="card card-custom gutter-b card-stretch shadow-box bg-brand px-50">
																<div class="card-header-right">
																	<div class="card-body text-center pt-4 h-550">
																		<div class="my-2">
																			<span class="text-white font-weight-bolder text-hover-primary font-size-h6"><?php echo $dataPost[$k]['postHeading']; ?></span>
																			<?php
																				$count = 0;
																				$postResult=$dataPost[$k]['postResult'];
	
																				if(count($postResult) > 3)
																				{
																					$count = 3;
																			?>
																					<p><a href="<?php echo base_url().$dataPost[$k]['viewAllURL']; ?>" target='_BLANK' class="btn btn-outline-white btn-sm font-weight-bolder text-center btn-block1 mt-5">View All</a></p>
																			<?php
																				}
																				else
																				{
																					$count = count($postResult);
																				}
																			?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php
															for($i=0; $i < $count; $i++)
															{
														?>
																<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
																	<div class="card card-custom gutter-b card-stretch shadow-box">
																		<div class="card-header-right ribbon ribbon-clip ribbon-left">
																			<div class="ribbon-target" style="top: 12px;">
																				<span class="ribbon-inner bg-brand"></span><?php echo date('d M', strtotime($postResult[$i]['dateOf‎Birth'])); ?>
																			</div>
																			<div class="card-body text-center p-3"><!--pt-34 pr-3  pl-3-->
																				<div class="mt-1">
																					<div class="symbol symbol-circle symbol-lg-150">
																						<img src="<?php echo base_url().UPLOAD_EMPLOYEE_PHOTO.$postResult[$i]['photo']; ?>" alt="image">
																					</div>
																				</div>
																				<div class="my-2">
																					<span class="text-dark font-weight-bold text-hover-primary font-size-h4"><?php echo $postResult[$i]['fullName']; ?></span>
																					<p><?php echo $postResult[$i]['departmentName']; ?></p>
																				</div>
																				<span class="label label-inline label-lg label-light-designation btn-sm font-weight-bold"><?php echo $postResult[$i]['designationName']; ?></span>
																				<div class="mt-3 mb-0">
																					<a href="tel:<?php echo $postResult[$i]['contactNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
																						<i class="fas fa-mobile-alt"></i>
																					</a>
																					<a href="tel:<?php echo $postResult[$i]['landlineNumber']; ?>" class="btn btn-md btn-icon btn-light-twitter btn-pill mx-2">
																						<i class="fa fa-phone-alt"></i>
																					</a>
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
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		*/
		?>
		
		
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>