    		<?php 
				$this->load->view(BACKOFFICE.'layout/header'); 
				$emailList="";
			?>
		
			<!-- datatable page CSS start-->
			<link href="<?php echo base_url('assetsbackoffice/plugins/custom/datatables/datatables.bundle7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />
			<!-- datatable page CSS end-->
			
			<style>
				<!--
				#toast-container {
					-webkit-animation: cssAnimation 5s forwards; 
					animation: cssAnimation 5s forwards;
				}
				@keyframes cssAnimation {
					0%   {opacity: 1;}
					90%  {opacity: 1;}
					100% {opacity: 0;}
				}
				@-webkit-keyframes cssAnimation {
					0%   {opacity: 1;}
					90%  {opacity: 1;}
					100% {opacity: 0;}
				}
				-->
				.badge-primary1 {
					color: #fff;
					background-color: #3E97FF;
					}
					
					.text-primary1 {
						color: #009ef7 !important;
					}
					
				.badge-success {
                    color: #fff;
                    background-color: #198754;
                }
                
                .badge-dark
                {
                    background-color: #181C32;
                }
                
                .badge-warning {
                    color: #181c32;
                    background-color: #FFC700;
                }
                
                .badge-danger {
                    color: #fff;
                    background-color: #DC3545;
                }
			</style>
			<?php 

				$this->load->view(BACKOFFICE.'layout/sidemenu'); 

				// echo ">>>>>>>".$show;
			
				switch ($show) 
				{
					case 'subscribers':
						$parentMenu 				= 	"All Subscribers";
						$buttonLabel				=	"Add Subscriber";
						$tableHeading               =   "All Subscribers List";
						$imagePath					=	"";
						$addControllerName          =   "subscriber";
						$updateControllerName       =   "subscriber/";
						$visibilityControllerName   =   "subscriber/setVisibility/";
						$deleteControllerName   	=   "subscriber/deleteData/";
						break;
					
					case 'contactformdata':
						$parentMenu 				= 	"Contact Form Data";
						$buttonLabel				=	"";
						$tableHeading               =   "Contact Form Data";
						$imagePath					=	"";
						$addControllerName          =   "contactFormData";
						$updateControllerName       =   "contactFormData/";
						$visibilityControllerName   =   "contactFormData/setVisibility/";
						$deleteControllerName   	=   "contactFormData/deleteData/";
						break;
						
					case 'newsletters':
						$parentMenu 				= 	"All Newsletters";
						$buttonLabel				=	"Add Newsletter";
						$tableHeading               =   "All Newsletters List";
						$imagePath					=	UPLOAD_NEWSLETTER;
						$addControllerName          =   "newsletter";
						$updateControllerName       =   "newsletter/";
						$visibilityControllerName   =   "newsletter/setVisibility/";
						$deleteControllerName   	=   "newsletter/deleteData/";
						break;
						
					case 'blogs':
						$parentMenu 				= 	"All Blogs";
						$buttonLabel				=	"Add Blog";
						$tableHeading               =   "All Blogs List";
						$imagePath					=	UPLOAD_BLOG;
						$addControllerName          =   "blog";
						$updateControllerName       =   "blog/";
						$visibilityControllerName   =   "blog/setVisibility/";
						$deleteControllerName   	=   "blog/deleteData/";
						break;
					
					case 'manuscripts':
						$parentMenu 				= 	"All Manuscripts";
						$buttonLabel				=	"Add Manuscript";
						$tableHeading               =   "All Manuscripts List";
						$imagePath					=	UPLOAD_MANUSCRIPT;
						$addControllerName          =   "manuscript";
						$updateControllerName       =   "manuscript/";
						$visibilityControllerName   =   "manuscript/setVisibility/";
						$approvedControllerName   	=   "manuscript/setApproval/";
						$deleteControllerName   	=   "manuscript/deleteData/";
						break;
						
					case 'manuscriptsauthorsinfo':
						$parentMenu 				= 	"All Manuscripts Authors info details";
						$buttonLabel				=	"";
						$tableHeading               =   "All Manuscripts Authors info List";
						$imagePath					=	UPLOAD_AUTHORS;
						$addControllerName          =   "manuscriptinfo";
						$updateControllerName       =   "manuscript/changeManuscriptArticleID/";
						$visibilityControllerName   =   "manuscriptinfo/setVisibility/";
						$approvedControllerName   	=   "manuscriptinfo/setApproval/";
						$deleteControllerName   	=   "manuscriptinfo/deleteData/";
						break;
					
					case 'articles':
						$parentMenu 				= 	"All Articles";
						$buttonLabel				=	"Add Articles";
						$tableHeading               =   "All Articles List";
						$imagePath					=	UPLOAD_ARTICLE;
						$addControllerName          =   "article";
						$updateControllerName       =   "updatearticle/";
						$visibilityControllerName   =   "article/setVisibility/";
						$deleteControllerName   	=   "article/deleteData/";
						break;
						
					case 'authors':
						$parentMenu 				= 	"All Authors";
						$buttonLabel				=	"Add Author";
						$tableHeading               =   "All Authors List";
						$imagePath					=	UPLOAD_AUTHORS;
						$addControllerName          =   "author";
						$updateControllerName       =   "author/";
						$visibilityControllerName   =   "author/setVisibility/";
						$approvedControllerName   	=   "author/setApproval/";
						$deleteControllerName   	=   "author/deleteData/";
						break;
					
					case 'blogcategories':
						$parentMenu 				= 	"All Blog Categories";
						$buttonLabel				=	"Add Blog Category";
						$tableHeading               =   "All Blog Categories List";
						$imagePath					=	"";
						$addControllerName          =   "blog-category";
						$updateControllerName       =   "blog-category/";
						$visibilityControllerName   =   "blog-category/setVisibility/";
						$deleteControllerName   	=   "blog-category/deleteData/";
						break;
						
					case 'volumes':
						$parentMenu 				= 	"All Volumes";
						$buttonLabel				=	"Add Volume";
						$tableHeading               =   "All Volumes List";
						$imagePath					=	"";
						$addControllerName          =   "volume";
						$updateControllerName       =   "volume/";
						$visibilityControllerName   =   "volume/setVisibility/";
						$deleteControllerName   	=   "volume/deleteData/";
						break;
					
					case 'issues':
						$parentMenu 				= 	"All Issues";
						$buttonLabel				=	"Add Issue";
						$tableHeading               =   "All Issues List";
						$imagePath					=	"";
						$addControllerName          =   "issue";
						$updateControllerName       =   "issue/";
						$visibilityControllerName   =   "issue/setVisibility/";
						$deleteControllerName   	=   "issue/deleteData/";
						break;
						
					case 'companies':
						$parentMenu 				= 	"All Companies";
						$buttonLabel				=	"Add Company";
						$tableHeading               =   "All Companies List";
						$imagePath					=	"";
						$addControllerName          =   "company";
						$updateControllerName       =   "company/";
						$visibilityControllerName   =   "company/setVisibility/";
						$deleteControllerName   	=   "company/deleteData/";
						break;
					
					case 'employees':
						$parentMenu 				= 	"All Employees";
						$buttonLabel				=	"Add Employee";
						$tableHeading               =   "All Employees List";
						$imagePath					=	"";
						$addControllerName          =   "employee";
						$updateControllerName       =   "employee/";
						$visibilityControllerName   =   "employee/setVisibility/";
						$deleteControllerName   	=   "employee/deleteData/";
						break;
					
					case 'departments':
						$parentMenu 				= 	"All Departments";
						$buttonLabel				=	"Add Department";
						$tableHeading               =   "All Departments List";
						$imagePath					=	"";
						$addControllerName          =   "department";
						$updateControllerName       =   "department/";
						$visibilityControllerName   =   "department/setVisibility/";
						$deleteControllerName   	=   "department/deleteData/";
						break;
						
					case 'countries':
						$parentMenu 				= 	"All Countries";
						$buttonLabel				=	"Add Country";
						$tableHeading               =   "All Countries List";
						$imagePath					=	"";
						$addControllerName          =   "country";
						$updateControllerName       =   "country/";
						$visibilityControllerName   =   "country/setVisibility/";
						$deleteControllerName   	=   "country/deleteData/";
						break;
						
					case 'states':
						$parentMenu 				= 	"All States";
						$buttonLabel				=	"Add State";
						$tableHeading               =   "All States List";
						$imagePath					=	"";
						$addControllerName          =   "state";
						$updateControllerName       =   "state/";
						$visibilityControllerName   =   "state/setVisibility/";
						$deleteControllerName   	=   "state/deleteData/";
						break;
						
					case 'cities':
						$parentMenu 				= 	"All Cities";
						$buttonLabel				=	"Add City";
						$tableHeading               =   "All Cities List";
						$imagePath					=	"";
						$addControllerName          =   "city";
						$updateControllerName       =   "city/";
						$visibilityControllerName   =   "city/setVisibility/";
						$deleteControllerName   	=   "city/deleteData/";
						break;
						
					case 'currencies':
						$parentMenu 				= 	"All Currencies";
						$buttonLabel				=	"Add Currency";
						$tableHeading               =   "All Currencies List";
						$imagePath					=	"";
						$addControllerName          =   "currency";
						$updateControllerName       =   "currency/";
						$visibilityControllerName   =   "currency/setVisibility/";
						$deleteControllerName   	=   "currency/deleteData/";
						break;
						
					case 'cabtypes':
						$parentMenu 				= 	"All Cab Types";
						$buttonLabel				=	"Add Cab Type";
						$tableHeading               =   "All Cab Types List";
						$imagePath					=	"";
						$addControllerName          =   "cabtype";
						$updateControllerName       =   "cabtype/";
						$visibilityControllerName   =   "cabtype/setVisibility/";
						$deleteControllerName   	=   "cabtype/deleteData/";
						break;
					
					case 'visatypes':
						$parentMenu 				= 	"All Visa Types";
						$buttonLabel				=	"Add Visa Type";
						$tableHeading               =   "All Visa Types List";
						$imagePath					=	"";
						$addControllerName          =   "visatype";
						$updateControllerName       =   "visatype/";
						$visibilityControllerName   =   "visatype/setVisibility/";
						$deleteControllerName   	=   "visatype/deleteData/";
						break;
						
					case 'trainclasses':
						$parentMenu 				= 	"All Train Classes";
						$buttonLabel				=	"Add Train Class";
						$tableHeading               =   "All Train Classes List";
						$imagePath					=	"";
						$addControllerName          =   "trainclass";
						$updateControllerName       =   "trainclass/";
						$visibilityControllerName   =   "trainclass/setVisibility/";
						$deleteControllerName   	=   "trainclass/deleteData/";
						break;
						
					case 'busclasses':
						$parentMenu 				= 	"All Bus Classes";
						$buttonLabel				=	"Add Bus Class";
						$tableHeading               =   "All Bus Classes List";
						$imagePath					=	"";
						$addControllerName          =   "busclass";
						$updateControllerName       =   "busclass/";
						$visibilityControllerName   =   "busclass/setVisibility/";
						$deleteControllerName   	=   "busclass/deleteData/";
						break;
						
					case 'flightclasses':
						$parentMenu 				= 	"All Flight Classes";
						$buttonLabel				=	"Add Flight Class";
						$tableHeading               =   "All Flight Classes List";
						$imagePath					=	"";
						$addControllerName          =   "flightclass";
						$updateControllerName       =   "flightclass/";
						$visibilityControllerName   =   "flightclass/setVisibility/";
						$deleteControllerName   	=   "flightclass/deleteData/";
						break;
						
					case 'flights':
						$parentMenu 				= 	"All Flights";
						$buttonLabel				=	"Add Flight";
						$tableHeading               =   "All Flights List";
						$imagePath					=	UPLOAD_HAPPY_STORY;
						$addControllerName          =   "flight";
						$updateControllerName       =   "flight/";
						$visibilityControllerName   =   "flight/setVisibility/";
						$deleteControllerName   	=   "flight/deleteData/";
						break;
						
					case 'trains':
						$parentMenu 				= 	"All Trains";
						$buttonLabel				=	"Add Train";
						$tableHeading               =   "All Trains List";
						$imagePath					=	UPLOAD_HAPPY_STORY;
						$addControllerName          =   "train";
						$updateControllerName       =   "train/";
						$visibilityControllerName   =   "train/setVisibility/";
						$deleteControllerName   	=   "train/deleteData/";
						break;
						
						
					
					
					
					case 'busrequests':
						$parentMenu 				= 	"All Bus Requests";
						$buttonLabel				=	"Add Bus Request";
						$tableHeading               =   "All Bus Requests List";
						$imagePath					=	"";
						$addControllerName          =   "";
						$updateControllerName       =   "request/";
						$commentControllerName		=   "comment/";
						$visibilityControllerName   =   "request/setVisibility";
						$cancelControllerName   	=   "request/cancelRequest";
//						$updateStatusControllerName	=   "request/updateStatusRequest";
						$deleteControllerName   	=   "";
						break;					
						
					case 'cabrequests':
						$parentMenu 				= 	"All Cab Requests";
						$buttonLabel				=	"Add Cab Request";
						$tableHeading               =   "All Cab Requests List";
						$imagePath					=	"";
						$addControllerName          =   "";
						$updateControllerName       =   "request/";
						$commentControllerName		=   "comment/";
						$visibilityControllerName   =   "request/setVisibility";
						$cancelControllerName   	=   "request/cancelRequest";
						$deleteControllerName   	=   "";
						break;
						
					case 'flightrequests':
						$parentMenu 				= 	"All Flight Requests";
						$buttonLabel				=	"Add Flight Request";
						$tableHeading               =   "All Flight Requests List";
						$imagePath					=	"";
						$addControllerName          =   "";
						$updateControllerName       =   "request/";
						$commentControllerName		=   "comment/";
						$visibilityControllerName   =   "request/setVisibility";
						$cancelControllerName   	=   "request/cancelRequest";
						$deleteControllerName   	=   "";
						break;
						
					case 'forexrequests':
						$parentMenu 				= 	"All Forex Requests";
						$buttonLabel				=	"Add Forex Request";
						$tableHeading               =   "All Forex Requests List";
						$imagePath					=	"";
						$addControllerName          =   "";
						$updateControllerName       =   "request/";
						$commentControllerName		=   "comment/";
						$visibilityControllerName   =   "request/setVisibility";
						$cancelControllerName   	=   "request/cancelRequest";
						$deleteControllerName   	=   "";
						break;
						
					case 'hotelrequests':
						$parentMenu 				= 	"All Hotel Requests";
						$buttonLabel				=	"Add Hotel Request";
						$tableHeading               =   "All Hotel Requests List";
						$imagePath					=	"";
						$addControllerName          =   "";
						$updateControllerName       =   "request/";
						$commentControllerName		=   "comment/";
						$visibilityControllerName   =   "request/setVisibility";
						$cancelControllerName   	=   "request/cancelRequest";
						$deleteControllerName   	=   "";
						break;
						
					case 'trainrequests':
						$parentMenu 				= 	"All Train Requests";
						$buttonLabel				=	"Add Train Request";
						$tableHeading               =   "All Train Requests List";
						$imagePath					=	"";
						$addControllerName          =   "";
						$updateControllerName       =   "request/";
						$commentControllerName		=   "comment/";
						$visibilityControllerName   =   "request/setVisibility";
						$cancelControllerName   	=   "request/cancelRequest";
						$deleteControllerName   	=   "";
						break;
						
					case 'visarequests':
						$parentMenu 				= 	"All Visa Requests";
						$buttonLabel				=	"Add Visa Request";
						$tableHeading               =   "All Visa Requests List";
						$imagePath					=	"";
						$addControllerName          =   "";
						$updateControllerName       =   "request/";
						$commentControllerName		=   "comment/";
						$visibilityControllerName   =   "request/setVisibility";
						$cancelControllerName   	=   "request/cancelRequest";
						$deleteControllerName   	=   "";
						break;
					
					case 'railwaystations':
						$parentMenu 				= 	"All Railway Stations";
						$buttonLabel				=	"Add Railway Station";
						$tableHeading               =   "All Railway Stations List";
						$imagePath					=	"";
						$addControllerName          =   "railwaystation";
						$updateControllerName       =   "railwaystation/";
						$visibilityControllerName   =   "railwaystation/setVisibility/";
						$cancelControllerName   	=   "comment/cancelRequest";
						$deleteControllerName   	=   "railwaystation/deleteData/";
						break;

					case 'airports':
						$parentMenu 				= 	"All Airports";
						$buttonLabel				=	"Add Airport";
						$tableHeading               =   "All Airports List";
						$imagePath					=	"";
						$addControllerName          =   "airport";
						$updateControllerName       =   "airport/";
						$visibilityControllerName   =   "airport/setVisibility/";
						$cancelControllerName   	=   "comment/cancelRequest";
						$deleteControllerName   	=   "airport/deleteData/";
						break;
					
					case 'requestwithfilters':
						$parentMenu 				= 	"Custom Report";
						$buttonLabel				=	"Go BACK";
						$tableHeading               =   $pageHeading; //"Request Data As Per Filters--";
						$imagePath					=	UPLOAD_ARTICLE;
						$addControllerName          =   "customReport/seeCustomReport";
						$updateControllerName       =   "";
						$visibilityControllerName   =   "";
						$deleteControllerName   	=   "";
						break;
				}
			?>
			<!--Main Content Start-->	
			<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
				<!--page heading start-->
				<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
					<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
						<div class="d-flex align-items-center flex-wrap mr-1">
							<div class="d-flex align-items-baseline flex-wrap mr-5">
								<h5 class="text-dark font-weight-bold my-1 mr-5"> <?php echo $tableHeading; ?></h5>
								<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
									<li class="breadcrumb-item text-muted">
										<a href="<?php echo site_url(BACKOFFICE.'dashboard/DashboardController'); ?>" class="text-muted">Dashboard</a>
									</li>
									<li class="breadcrumb-item text-muted">
										<a class="text-muted"><?php echo $parentMenu; ?></a>
									</li>
									<li class="breadcrumb-item text-muted">
										<a class="text-muted"><?php echo $tableHeading; ?></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="d-flex align-items-center">
						</div>
					</div>
				</div>
				<?php
				/*
					if($this->session->userdata('toastrSuccess'))
					{
				?>
						<div id="toast-container" class="toast-top-right">
							<div class="toast toast-success" aria-live="polite" style="">
								<div class="toast-message"><?php echo $this->session->userdata('toastrSuccess'); ?></div>
							</div>
						</div>
				<?php			
						$this->session->unset_userdata('toastrSuccess');
					}
					else if($this->session->userdata('toastrWarning'))
					{
				?>
						<div id="toast-container" class="toast-top-right">
							<div class="toast toast-warning" aria-live="polite" style="">
								<div class="toast-message"><?php echo $this->session->userdata('toastrWarning'); ?></div>
							</div>
						</div>
				<?php		
						$this->session->unset_userdata('toastrWarning');
					}
					else if($this->session->userdata('toastrError'))
					{
				?>
						<div id="toast-container" class="toast-top-right">
							<div class="toast toast-error" aria-live="assertive" style="">
								<div class="toast-message"><?php echo $this->session->userdata('toastrError'); ?></div>
							</div>
						</div>
				<?php	
						$this->session->unset_userdata('toastrError');
					}
					*/
				?>

				
				<!-- page heading end-->
				<div class="d-flex flex-column-fluid">
					<div class="container">	
						<div class="card card-custom">
							<div class="card-header py-3">
								<div class="card-title">
									<span class="card-icon">
										<!--<i class="flaticon2-shopping-cart text-primary"></i>-->
										<i class="fa fa-list text-primary"></i>
									</span>
									<h3 class="card-label"><?php echo $tableHeading; ?></h3>
								</div>
								<div class="card-toolbar">
								    <?php
								        if($show != "subscribers" && $show != "manuscripts" && $show != "authors" && $show != "manuscriptsauthorsinfo" && $show != "articles" && $show != "contactformdata" && $show != "visarequests")
										{
								    ?>
									<a href="<?php echo site_url(BACKOFFICE.$addControllerName); ?>" class="btn btn-primary font-weight-bolder">
										<?php
											if($show == "requestwithfilters" || $show == "jobApplications" || $show == "searchEmployees" || $show == "searchActivityLogs" || $show == "searchMeasurements")
											{
												echo "<i class='fa fa-reply'></i>";
											}
											else
											{
												echo "<i class='fa fa-plus'></i>";
											}
										?>

										<?php echo $buttonLabel; ?>
									</a>
									<?php
								        }
								    ?>
								</div>
							</div>
							<div class="card-body">
								<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
									<thead>
										<tr>
											<?php
												$arraySize = count($headerArray);
												
												for($i=0; $i < $arraySize; $i++)
												{
													echo "<th>".$headerArray[$i]."</th>";
												}
												
												if($show != "requestwithfilters")
												{
													echo "<th>Action</th>";
												}
												
											?>
										</tr>
									</thead>
									<tbody>
										<?php         
										  
											$countHeader = count($tableColumns);

											for($i=0; $i < count($result); $i++)
											{ 	
												echo "<tr>";

												for($j=0; $j < $countHeader; $j++)
												{
													$headerName = $tableColumns[$j];
													$id = $tableColumns[0];
													
													if($show == "requestwithfilters" && $headerName == "thumbnailImage")
													{
														if($result[$i][$headerName] !="")
														{
															echo "<td>
													                    <img alt='image' src='".base_url()."".UPLOAD_BLOG."".$result[$i][$headerName]."' width='100px' class='mr-3'>
													                </td>";
														}
														else
														{
															echo "<td >-</td>";
														}
													}
													else if($show == "requestwithfilters" && ($headerName == "copyrightform" || $headerName == "paymentreceipt"))
													{
                                                        echo "<td>".$result[$i][$headerName]."</td>";
													}
													else if($headerName == "index")
													{
														echo "<td>".($i+1)."</td>";
													}
													else if(($headerName == "authorPhoto" && $show =="manuscriptsauthorsinfo") || ($headerName == "coAuthorPhoto" && $show =="manuscriptsauthorsinfo" ))
													{
														
													    //echo "<td ><a href='".base_url()."/assetsbackoffice/uploads/".$result[$i][$headerName]."' target='_BLANK'>See Document</a></td>";
													    echo "<td>
													                <a href='".base_url()."".$imagePath."".$result[$i][$headerName]."' target='_BLANK'>
													                    <img alt='image' src='".base_url()."".$imagePath."".$result[$i][$headerName]."' width='100px' class='mr-3'>
													                </a>";
													                
													                if($result[$i]['authorPhoto'] != "")
            														{
            															echo "<a href= '".base_url().$imagePath."".$result[$i]['authorPhoto']."' download><i class='fa fa-cloud-download-alt text-primary1 mt-3'></i></a>
            																";
            														}
																	echo '<a href="'.site_url(BACKOFFICE.$deleteControllerName.''.$result[$i][$id]).'" onclick="return confirmDialog();" class="btn btn-sm" title="Delete Record permanently"><i class="fa fa-trash text-danger"></i></a>';
																	
													      echo "</td>";
													}
													else if(($headerName == "image" || $headerName == "thumbnailImage" || $headerName == "photo" || $headerName == "bannerImage" || $headerName == "authorPhoto" || $headerName == "coAuthorPhoto") && $result[$i][$headerName] != "" )
													{
													    //echo "<td ><a href='".base_url()."/assetsbackoffice/uploads/".$result[$i][$headerName]."' target='_BLANK'>See Document</a></td>";
													    echo "<td>
													                <a href='".base_url()."".$imagePath."".$result[$i][$headerName]."' target='_BLANK'>
													                    <img alt='image' src='".base_url()."".$imagePath."".$result[$i][$headerName]."' width='100px' class='mr-3'>
													                </a>";
													      echo "</td>";
													}
													else if($headerName == "description" ||$headerName == "happyStoryShortDescription" || $headerName == "address" || $headerName == "postDescription" || $headerName == "jobDescription"  || $headerName == "departmentInformation")
													{
													    echo "<td >".strip_tags(substr($result[$i][$headerName], 0, 100))."...</td>";
													}
													/*else if($headerName == "createdDate" && ($show="manuscripts" || $show="articles"))
													{
														echo "<td >".date('d-m-Y', strtotime($result[$i][$headerName]))."<br>".date('H:m:s', strtotime($result[$i][$headerName]))."</td>";
													}*/
													else if($headerName == "fromDate" || $headerName == "toDate" || $headerName == "pickUpDateTime" || $headerName == "dropDateTime" || $headerName == "checkIn" || $headerName == "checkOut" || $headerName == "createdDate")
													{
														if($headerName == "createdDate" || $headerName == "pickUpDateTime" || $headerName == "dropDateTime")
														{
															echo "<td >".date('d-m-Y h:m:s', strtotime($result[$i][$headerName]))."</td>";
														}
														else
														{
															echo "<td >".date('d-m-Y', strtotime($result[$i][$headerName]))."</td>";
														}
													}
													else if($headerName == "URL" || $headerName == "videoURL" || $headerName == "photoVideoLink" || $headerName == "copyrightform" || $headerName == "paymentreceipt")
													{
														if($headerName == "videoURL" && $result[$i]['videoTypeFlag'] == "1" && $show == "posts")
														{
															echo "<td><a href= '".base_url().UPLOAD_POST.$result[$i][$headerName]."' target='_blank'>".$result[$i][$headerName]."</a></td>";
														}
														else if($headerName == "videoURL" && $result[$i]['videoTypeFlag'] == "1" && $show == "companyVideos")
														{
															echo "<td><a href= '".base_url().UPLOAD_COMPANY_VIDEO.$result[$i][$headerName]."' target='_blank'>".$result[$i][$headerName]."</a></td>";
														}
														else if($headerName == "photoVideoLink" && $result[$i]['photoVideoTypeFlag'] == "1")
														{
															echo "<td><a href= '".base_url().UPLOAD_GALLERY_PHOTO_VIDEO."/".$result[$i][$headerName]."' target='_blank'>".$result[$i][$headerName]."</a></td>";
														}
														else if($headerName == "photoVideoLink" && $result[$i]['photoVideoTypeFlag'] == "0")
														{
															echo "<td><a href= '".$result[$i][$headerName]."' target='_blank'>".$result[$i][$headerName]."</a></td>";
														}
														else if($headerName == "photoVideoLink" && $result[$i]['photoVideoTypeFlag'] == "2")
														{
															echo "<td><a href= '".base_url().UPLOAD_GALLERY_PHOTO_VIDEO."/".$result[$i][$headerName]."' target='_blank'>".$result[$i][$headerName]."</a></td>";
														}
														else if($headerName == "copyrightform" || $headerName == "paymentreceipt")
														{
														    echo "<td >
														            <a href='".base_url().UPLOAD_ARTICLE."/".$result[$i][$headerName]."' title='Change Status' target='_blank'>
														                <div class='badge badge-primary1 text-white'>VIEW</div>
														            </a>
														    </td>";
															//echo "<td><a href= '".base_url().UPLOAD_ARTICLE."/".$result[$i][$headerName]."' target='_blank'>See Attchment</a></td>";
														}
														else
														{
															echo "<td><a href= '".$result[$i][$headerName]."' target='_blank'>".$result[$i][$headerName]."</a></td>";
														}
													}
													else if($headerName == "confirmFlag")
													{
														if($result[$i]['confirmFlag'] == "1")
														{
															echo "<td >Yes</td>";
														}
														else if($result[$i]['confirmFlag'] == "0")
														{
															echo "<td >No</td>";
														}
														else
														{
															echo "<td ></td>";
														}
													}
													else if($headerName == "videoTypeFlag")
													{
														if($result[$i]['videoTypeFlag'] == "1")
														{
															echo "<td >Local</td>";
														}
														else if($result[$i]['videoTypeFlag'] == "0")
														{
															echo "<td >YouTube</td>";
														}
														else
														{
															echo "<td >Unknown</td>";
														}
													}
													else if($headerName == "featuredArticleFlag")
													{
														if($result[$i]['featuredArticleFlag'] == "1")
														{
															echo "<td >YES</td>";
														}
														else 
														{
															echo "<td >NO</td>";
														}
													}
													else if($headerName == "photoVideoTypeFlag")
													{
														if($result[$i]['photoVideoTypeFlag'] == "1")
														{
															echo "<td >Local</td>";
														}
														else if($result[$i]['photoVideoTypeFlag'] == "0")
														{
															echo "<td >YouTube</td>";
														}
														else if($result[$i]['photoVideoTypeFlag'] == "2")
														{
															echo "<td >Photo</td>";
														}
														else
														{
															echo "<td >Unknown</td>";
														}
													}
													else if($show == "requestwithfilters" && $headerName == "invoicePDF")
													{
														if($result[$i][$headerName] !="")
														{
															echo "<td >Sended</td>";
														}
														else
														{
															echo "<td >Pending</td>";
														}
													}
													else if($headerName == "invoicePDF" && $result[$i][$headerName] !="")
													{
														$link = base_url().UPLOAD_INVOICE."/";
														echo "<td><a href= '".$link.$result[$i][$headerName]."' target='_blank'>See Invoice</a></td>";
													}
													else if($headerName == "uploadFile")
													{
														echo "<td><a href= '".base_url().UPLOAD_POST_COMPANY_PRESENTATION_TEMPLATES."/".$result[$i][$headerName]."' download>".$result[$i][$headerName]."</a></td>";
													}
													else if($headerName == "resumeLink")
													{
														$link = base_url().UPLOAD_POST_JOB_APPLICATIONS."/";
														echo "<td><a href= '".$link.$result[$i][$headerName]."' target='_blank'>".$result[$i][$headerName]."</a></td>";
													}
													else if($headerName == "file")
													{
														$link = base_url().UPLOAD_DEPARTMENT."/";
														echo "<td><a href= '".$link.$result[$i][$headerName]."' target='_blank'>".$result[$i][$headerName]."</a></td>";
													}
													else if($headerName == "linkType")
													{
														if($result[$i][$headerName] == "0")
														{
															echo "<td>Internal</td>";
														}
														else
														{
															echo "<td>External</td>";
														}
													}
													else if($headerName == "visibleForFlag")
													{
														if($result[$i][$headerName] == "0")
														{
															echo "<td>All</td>";
														}
														else
														{
															echo "<td>Staff</td>";
														}
													}
													else if(($headerName == "authorName") && ($show == "manuscripts"))
													{
														echo "<td >".$result[$i][$headerName]."<br>".$result[$i]['email']."<br>".$result[$i]['contactNumber']." </td>";
													}
													else if(($headerName == "employeeName") && ($show != "employees") && ($show != "requestwithfilters"))
													{
														echo "<td >".$result[$i][$headerName]."<br>(".$result[$i]['companyName'].") </td>";
													}
													else if($headerName == "document")
													{
														if($result[$i][$headerName] != "")
														{
														/*	echo "<td>
																	<a href= '".base_url().$imagePath."".$result[$i][$headerName]."' target='_blank'><i class='fa fa-file text-primary1'></i></a>
																	<a href= '".base_url().$imagePath."".$result[$i][$headerName]."' download><i class='fa fa-download text-primary1'></i></a>
																	</td>";*/
															echo "<td>
																	<a href= '".base_url().$imagePath."".$result[$i][$headerName]."' download><i class='fa fa-cloud-download-alt text-primary1 mt-3'></i></a>
																	</td>";		
																	
														}
														else
														{
															echo "<td></td>";
														}
													}
													else if(($headerName == "uniqueCode") || ($headerName == "articleID"))
													{
														echo "<td >IJPS/".$result[$i][$headerName]."</td>";
													}
													else if($headerName == "approvedFlag")
													{
														if($result[$i][$headerName] == "0")
														{
															echo "<td>No</td>";
														}
														else
														{
															echo "<td>Yes</td>";
														}
													}
													else if(($headerName == "statusName"))
													{
														$flag = "";
														if($result[$i]['statusID'] == "1")
														{
															$flag = "warning";
														}
														else if($result[$i]['statusID'] == "2")
														{
															$flag = "danger";
														} 
														else if($result[$i]['statusID'] == "3")
														{
															$flag = "primary1";
														} 
														else if($result[$i]['statusID'] == "4")
														{
															$flag = "success";
														} 
														else
														{
															$flag = "dark";
														}
														$payment_date ='';
														if($result[$i]['payment_date']!='' && $result[$i]['payment_date']!='0000-00-00 00:00:00' && $result[$i]['statusID'] == "3"){
														    $payment_date = $result[$i]['payment_date'];
														}
														echo "<td >
														            <a data-bs-toggle='modal' onclick='shoD(".$result[$i][$id].")' data-bs-target='#ChangeManuscriptStatus-".$result[$i][$id]."' class='action-btn' href='#' title='Change Status'>
														                <div class='badge badge-".$flag." text-white'>".$result[$i][$headerName]."</div>
														            </a>
														            
														            <p>".$payment_date."</p>
														    </td>";
														?> 
														<?php
													} 
													else if(($headerName == "coAuthors") && $show=="requestwithfilters")
													{
													    $data ="";
                                    					    
                                					    for($l=0;$l<count($result[$i]['coAuthorsData']);$l++) 
                                					    {  
                                					        $data .= "<b>Co-Author ".($l+1)."</b><br>
                                                                        <b>Name : </b>".$result[$i]['coAuthorsData'][$l]['name']."<br>
                                                                        <b>Email : </b>".$result[$i]['coAuthorsData'][$l]['email']."<br>
                                                                        <b>Affiliation : </b>".$result[$i]['coAuthorsData'][$l]['affiliation']."<br><br>";
                                					    }
                                    					
                                    					echo "<td>".$data."</td>";
													}
													else if(($headerName == "coAuthors"))
													{
													    
													    
													    //for($k=0;$k<count($result);$k++)
                                    					//{
                                    					    $data ="<table style='width:100%'>";
                                    					    
                                    					    for($l=0;$l<count($result[$i]['coAuthorsData']);$l++) 
                                    					    {
                                    					        //$data .= "<b>Co-Author ".$l.":</b><img alt='image' src='".base_url()."".$imagePath."".$result[$i]['coAuthorsData'][$l]['coAuthorPhoto']."' width='50px'><a href= '".base_url().$imagePath."".$result[$i]['authorPhoto']."' download><i class='fa fa-cloud-download-alt text-primary1 mt-3'></i></a>".$result[$i]['coAuthorsData'][$l]['name']."|".$result[$i]['coAuthorsData'][$l]['email']."<br>";
                                    					        
                                    					       /* $data .="<td><table style='width:100%'>
                                                                              <tr>
                                                                                <th colspan=2'><b>Co-Author ".($l+1).":</b></th>
                                                                              </tr>
                                                                              <tr>
                                                                                <th colspan=2'><img alt='image' class='mr-3' src='".base_url()."".$imagePath."".$result[$i]['coAuthorsData'][$l]['coAuthorPhoto']."' width='120px'><a href= '".base_url().$imagePath."".$result[$i]['authorPhoto']."' download><i class='fa fa-cloud-download-alt text-primary1 mt-3'></i></a></th>
                                                                              </tr>
                                                                              <tr>
                                                                                <th>Name</th>
                                                                                <td>".$result[$i]['coAuthorsData'][$l]['name']."</td>
                                                                              </tr>
                                                                              <tr>
                                                                                <th>Email</th>
                                                                                <td>".$result[$i]['coAuthorsData'][$l]['email']."</td>
                                                                              </tr>
                                                                        </table></td>";*/
                                                                        
                                                                $data .= "<tr><td class='p-0 border-0'>
                                                                            <div class='card card-custom gutter-b'>
                                                                                <div class='card-body'>
                                                                                    <div class='text-dark text-hover-primary font-size-h5 font-weight-bold'>Co-Author ".($l+1)."</div>
                                                                                    <div class='separator separator-solid my-5'></div><br>
                                                                                    <div class='d-flex'>
                                                                                        <div class='flex-shrink-0 mr-7'>
                                                                                            <div class='symbol symbol-50 symbol-lg-120'>
                                                                                                <img alt='Pic' src='".base_url()."".$imagePath."".$result[$i]['coAuthorsData'][$l]['coAuthorPhoto']."'>
                                                                                                <a href= '".base_url().$imagePath."".$result[$i]['coAuthorsData'][$l]['coAuthorPhoto']."' download><i class='fa fa-cloud-download-alt text-primary1 mt-3'></i></a>
                                                                                            </div> 
                                                                                        </div>
                                                                                        <div class='flex-grow-1'>
                                                                                            <div class='d-flex align-items-center justify-content-between flex-wrap mt-2'>
                                                                                                <div class='mr-3'>
                                                                                                    <a href='#' class='d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3'>
                                                                                                        ".$result[$i]['coAuthorsData'][$l]['name']." 
                                                                                                    </a>
                                                                                                    <div class='d-flex flex-wrap my-2'>
                                                                                                        <a href='#' class='text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2'>
                                                                                                            <span class='svg-icon svg-icon-md svg-icon-gray-500 mr-1'>
                                                                        										<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1'>
                                                                        											<g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'>
                                                                        												<rect x='0' y='0' width='24' height='24'></rect>
                                                                        												<path d='M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z' fill='#000000'></path>
                                                                        												<circle fill='#000000' opacity='0.3' cx='19.5' cy='17.5' r='2.5'></circle>
                                                                        											</g>
                                                                        										</svg>
                                                                        									</span>                                
                                                                        									".$result[$i]['coAuthorsData'][$l]['email']."
                                                                                                        </a>
                                                                        							</div>
                                                                        						</div>
                                                                        					</div>
                                                                        					<div class='d-flex align-items-center flex-wrap justify-content-between'>
                                                                        						<div class='flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5'>
                                                                        							".$result[$i]['coAuthorsData'][$l]['affiliation']."
                                                                        						</div>
                                                                        					</div>
                                                                        				</div>
                                                                        			</div>
                                                                        		</div>
                                                                        	</div>
                                                                        </td></tr>";
                                                                        
                                                                $emailList .= $result[$i]['coAuthorsData'][$l]['email'].",";
                                    					    }
                                    					//}
                                    					$data .= "</table>";
                                    					
                                    					echo "<td>".$data."</td>";
													}
													else 
													{
													    echo "<td >".$result[$i][$headerName]."</td>";
													}
													
													/*
													else if($headerName == "registrationDate")
													{
													    echo "<td >".date('d/m/Y h:i:s a', strtotime($result[$i]['registrationDate']))."</td>";
													}
                                                    */
													
													if($j == $countHeader-1 && $show != "requestwithfilters")
													{
														echo "<td>";
														
														if($result[$i]['isActive'] == '0')
														{
															$icon = "far fa-eye-slash";
															$tooltiptext = "Activate";
														}
														else
														{
															$icon = "far fa-eye";
															$tooltiptext = "Deactivate";
														}
														
														if($show == "photoVideoGalleryCategory")
														{
															if($result[$i]['pin'] == '0')
															{
																$iconColor = "";
																$tooltiptext = "Pin";
															}
															else
															{
																$iconColor = "text-primary";
																$tooltiptext = "Unpin";
															}
										?>
															<a href="<?php echo site_url(BACKOFFICE.$pinControllerName."".$result[$i][$id]."/".$result[$i]['pin']); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="<?php echo $tooltiptext; ?>">
    															<i class="fas fa-thumbtack <?php echo $iconColor; ?>"></i>
															</a>
										<?php
														}
														
														if($show == "profiles")
														{
															if($result[$i]['verifiedFlag'] == '1')
															{
										?>
																<a href="<?php echo site_url(BACKOFFICE.$verifyControllerName."".$result[$i][$id]."/".$result[$i]['verifiedFlag']); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Set as unverified profile">
																	<i class="fa fa-user"></i>
																</a>
										<?php
															}
															else
															{
										?>
																<a href="<?php echo site_url(BACKOFFICE.$verifyControllerName."".$result[$i][$id]."/".$result[$i]['verifiedFlag']); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Set as verified profile">
																	<i class="fa fa-user"></i>
																</a>
										<?php						
															}
														}
														
														if($show == "employees1")
														{
										?>
															<a href="<?php echo site_url(BACKOFFICE.$monthControllerName."".$result[$i][$id]); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Set as employee of the month">
																<i class="fa fa-award"></i>
															</a>
															<a href="<?php echo site_url(BACKOFFICE.$yearControllerName."".$result[$i][$id]); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Set as employee of the year">
																<i class="fa fa-trophy"></i>
															</a>
															<a href="<?php echo site_url(BACKOFFICE.$endServiceControllerName."".$result[$i][$id]); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="End Service">
																<i class="fa fa-times"></i>
															</a>
										<?php
														}
														
														if($show != "subscribers" && $show != "manuscripts" && $show != "authors" && $show != "forexrequests" && $show != "hotelrequests" && $show != "trainrequests" && $show != "visarequests" && $show != "contactformdata")
														{
										?>
										
															<a href="<?php echo site_url(BACKOFFICE.$updateControllerName."".$result[$i][$id]); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit Details">
																<i class="far fa-edit"></i>
															</a>
									    <?php
															if($show != "manuscriptsauthorsinfo")
															{
										?>
															<a href="<?php echo site_url(BACKOFFICE.$visibilityControllerName."".$result[$i][$id]."/".$result[$i]['isActive']); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="<?php echo $tooltiptext; ?>">
																		<i class="<?php echo $icon; ?>"></i>
															</a>
										<?php
														}
														
														if($show != "companies" && $show != "employees" && $show != "manuscriptsauthorsinfo")
														{
														
										?>
															<a href="<?php echo site_url(BACKOFFICE.$deleteControllerName."".$result[$i][$id]); ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-sm btn-clean btn-icon mr-2" title="Delete Record permanently">
																<i class="far fa-trash-alt"></i>
															</a>
										<?php
														
														}
														}
														
														if($show == "authors")
														{
										?>
															<a href="<?php echo site_url(BACKOFFICE.$visibilityControllerName."".$result[$i][$id]."/".$result[$i]['isActive']); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="<?php echo $tooltiptext; ?>">
																		<i class="<?php echo $icon; ?>"></i>
															</a>
										<?php
														}
														
														if($show == "manuscripts")
														{
														    if($result[$i]['document'] != "")
    														{
    															//echo "<a href= '".base_url().$imagePath."".$result[$i][$headerName]."' target='_blank'><i class='fa fa-file text-primary1'></i></a>";
    															echo "<a href= '".base_url().$imagePath."".$result[$i]['document']."' download><i class='fa fa-cloud-download-alt text-primary1'></i></a>
    																";
    														}

															if($result[$i]['approvedFlag'] == '0')
															{
																$iconAF = "fa fa-times";
																$tooltiptextAF = "Activate";
															}
															else
															{
																$iconAF = "fa fa-check";
																$tooltiptextAF = "Deactivate";
															}
															
															if($result[$i]['statusID'] == '3')
															{
										?>
										                        <a href="<?php echo site_url(BACKOFFICE."article/".$result[$i][$id]); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Add Article">
    																<i class="fa fa-plus"></i>
    															</a>
										<?php
															}
										?>
										                    
										                    <!--
															<a href="<?php echo site_url(BACKOFFICE.$approvedControllerName."".$result[$i][$id]."/".$result[$i]['approvedFlag']); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="<?php echo $tooltiptextAF; ?>">
																<i class="<?php echo $iconAF; ?>"></i>
															</a>-->
															<!--
															<a data-bs-toggle="modal" data-bs-target="#ChangeManuscriptStatus-<?php echo $result[$i][$id];?>" href="#" class="btn btn-sm btn-clean btn-icon mr-2" title="Change Status">
																<i class="fa fa-stream"></i>
															</a>-->
															<!--<a href="<?php echo site_url(BACKOFFICE.$updateControllerName."".$result[$i][$id]); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Change Status">
																<i class="fa fa-stream"></i>
															</a>-->
															<a href="<?php echo site_url(BACKOFFICE.$deleteControllerName."".$result[$i][$id]); ?>" onclick="return confirm('Are you sure you want to delete this record?');" class="btn btn-sm btn-clean btn-icon mr-2" title="Delete Record permanently">
																<i class="far fa-trash-alt"></i>
															</a>
															
										<?php
														}

														if($show=='contactformdata'){ ?>
															<a href="<?php echo site_url(BACKOFFICE.$deleteControllerName."".$result[$i][$id]); ?>" onclick="return confirm('Are you sure you want to delete this record?');" class="btn btn-sm btn-clean btn-icon mr-2" title="Delete Record permanently">
																<i class="far fa-trash-alt"></i>
															</a>
														<?php } 
														
														if($show == "cabrequests" || $show == "busrequests" || $show == "flightrequests" || $show == "forexrequests" || $show == "hotelrequests" || $show == "trainrequests" || $show == "visarequests" )
														{

															
															/*if($result[$i]['cancelRequestFlag'] == '0')
															{
																$iconCancel = "fa fa-times";
																$tooltiptextCancel = "Cancel Request";
															}
															else
															{
																$iconCancel = "fa fa-undo";
																$tooltiptextCancel = "Reopen Request";
															}*/
										?>
															<a href="<?php echo site_url(BACKOFFICE.$updateControllerName."".$show."/".$result[$i][$id]."/1"); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Upload Invoice">
        														<i class="far fa-file"></i>
        												    </a>
										                    <a href="<?php echo site_url(BACKOFFICE.$commentControllerName."".$show."/".$result[$i][$id]); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Add/See Comments">
        														<i class="far fa-comment"></i>
        												    </a>
															<a href="<?php echo site_url(BACKOFFICE.$visibilityControllerName."/".$show."/".$result[$i][$id]."/".$result[$i]['isActive']); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="<?php echo $tooltiptext; ?>">
																<i class="<?php echo $icon; ?>"></i>
															</a>
															<!--<a href="<?php echo site_url(BACKOFFICE.$cancelControllerName."/".$show."/".$result[$i][$id]."/".$result[$i]['cancelRequestFlag']); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="<?php echo $tooltiptextCancel; ?>">
																<i class="<?php echo $iconCancel; ?>"></i>
															</a>-->
															<a href="<?php echo site_url(BACKOFFICE.$updateControllerName."".$show."/".$result[$i][$id]."/2"); ?>" class="btn btn-sm btn-clean btn-icon mr-2" title="Change Status">
																<i class="fa fa-stream"></i>
															</a>
										<?php
														}
														echo "</td>";
													}

												}
												echo "</tr>";
											}
										?>
																
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			
				if($show == "manuscripts")
				{
					
					
					for($i=0; $i < count($result); $i++)
					{

						
			?>
					<div class="modal fade" tabindex="-1" id="ChangeManuscriptStatus-<?php echo $result[$i]['manuscriptID']; ?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title">Change Manuscript Status</h3>

									<!--begin::Close-->
									<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
										<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
									</div>
									<!--end::Close-->
								</div>

								
								<form method="post" id="submitStatusFrm" enctype="multipart/form-data">
								<!-- <form method="post" action="<?php echo site_url(BACKOFFICE.'manuscript/ManuscriptController/updateManuscript'); ?>" enctype="multipart/form-data"> -->
									<div class="modal-body">
										<div class="row">
											<div class="col-lg-12" style="display:none;">
												<div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtManuscriptID" value="<?php echo $result[$i]['manuscriptID']; ?>">
														<input class="form-control" type="hidden" name="txtArticleID" value="<?php echo $result[$i]['uniqueCode']; ?>">
														<input class="form-control" type="hidden" name="txtPDate" value="<?php echo $result[$i]['createdDate']; ?>">
														<input class="form-control" type="hidden" name="txtEmail" value="<?php echo $result[$i]['email']; ?>">
														<input class="form-control" type="hidden" name="txtEmailList" value="<?php echo $emailList.",".$result[$i]['email']; ?>">
														<input class="form-control" type="hidden" name="txtTitleOfPaper" value="<?php echo $result[$i]['titleOfPaper']; ?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12" id="cmbStatusIDSection<?php echo $i; ?>">
												<div class="form-group">
													<label>Status
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbStatusID" id="cmbStatusID<?php echo $i; ?>" class="form-control form-control-round" onchange="showhidefun(<?php echo $i; ?>)" required>
																<?php 
																	 for($j = 0; $j < count($statusResult); $j++)
																	{
																		if($statusResult[$j]['statusID'] == $result[$i]['statusID'])
																		{
																			echo "<option value=".$statusResult[$j]['statusID']." selected>".$statusResult[$j]['statusName']."</option>";
																		} 
																		else
																		{
																			echo "<option value=".$statusResult[$j]['statusID'].">".$statusResult[$j]['statusName']."</option>";
																		}
																	}
																	
																	if($result[$i]['statusID'] != 1 && $result[$i]['statusID'] != 3)
																	{
																	    $dtyleText = "display:block;";
																	}
																	else
																	{
																	    $dtyleText = "display:none;";
																	}
																	
																	if($result[$i]['statusID'] != 4)
																	{
																	    $dtyleText1 = "display:none;";
																	}
																	else
																	{
																	    $dtyleText1 = "display:block;";
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtURLSection<?php echo $i; ?>" style="<?php echo $dtyleText1; ?>" class="hide">
    											<div class="form-group">
    												<input type="text" name="txtURL" id="txtURL<?php echo $i; ?>" class="form-control" data-error="Article URL*" placeholder="Article URL*">
    												<div class="help-block with-errors"></div>
    											</div>
    										</div>
												<input type="hidden" name="articlePdf" id="articlePdf<?php echo $result[$i][$id]; ?>">
											<input type="hidden" name="articleUrl" id="articleUrl<?php echo $result[$i][$id]; ?>">
    										<!-- <div class="col-lg-12" id="file1Section<?php echo $i; ?>" style="<?php echo $dtyleText1; ?>">
        										<div class="form-group">
    												<label for="Paper">
    													Upload Article PDF
    													<span style="color:red">(only PDF file) *</span>
    												</label>
    												<input type="file" name="file1" class="form-control" id="file1<?php echo $i; ?>" accept=".pdf">
    												<div class="help-block with-errors"></div>
    											</div>
    										</div> -->
    										<div class="col-lg-12" id="file2Section<?php echo $i; ?>" style="<?php echo $dtyleText1; ?>">
        										<div class="form-group">
    												<label for="Paper">
    													Upload Certificate PDF
    													<span style="color:red">(only PDF file) *</span>
    												</label>
    												<input type="file" name="file2" class="form-control" id="file2<?php echo $i; ?>" accept=".pdf">
    												<div class="help-block with-errors"></div>
    											</div>
    										</div>
    										<?php
    										        $dtyleText101 = "display:none;";
    										        
    										    	if($result[$i]['statusID'] == 2)
													{
													    $dtyleText101 = "display:block;";
													}
													
													$getReviewPoint = get_record_by_id('tbl_reviewpoint',$result[$i]['uniqueCode']);
													//echo "<pre>unique code::";print_r($getReviewPoint->reviewPoint);

    										?>
    										<div class="col-lg-12" id="status2Section<?php echo $i; ?>" style="<?php echo $dtyleText101; ?>">

																								
														<table class="table table-bordered">
															<thead>
																<tr>
																<th scope="col">Sr.No</th>
																<th scope="col">Critical review on</th>
																<th scope="col">Points out of 10</th>		
																</tr>
															</thead>
															<tbody>
															<?php
															if(!empty($getReviewPoint->reviewPoint)){

																$jsnDecode = json_decode($getReviewPoint->reviewPoint,true);
															$sr=1; foreach ($jsnDecode as $key => $value) { ?>
																<tr>
																	<td><?php echo $sr++; ?></td>
																	<td><input class="form-control" type="hidden" name="reviewPoint[]" value="<?php echo $value['reviewPoint']; ?>"><?php echo $value['reviewPoint']; ?></td>
																	<td><input type="text" class="form-control" name="txtCol1Value[]" value="<?php echo $value['txtCol1Value']; ?>"></td>
																</tr>
															<?php }}else{
																$emptyJson = json_decode('[{"reviewPoint":"Relevance of Title","txtCol1Value":""},{"reviewPoint":"Depth of Research","txtCol1Value":""},{"reviewPoint":"Extent of originality","txtCol1Value":""},{"reviewPoint":"Practical Applicability","txtCol1Value":""},{"reviewPoint":"Justification of conclusion","txtCol1Value":""},{"reviewPoint":"Structure and Organization","txtCol1Value":""},{"reviewPoint":"Quality of references","txtCol1Value":""}]', true);
																$sr=1; foreach ($emptyJson as $key => $emptyValue) {
																?>
																<tr>
																	<td><?php echo $sr++; ?></td>
																	<td><input class="form-control" type="hidden" name="reviewPoint[]" value="<?php echo $emptyValue['reviewPoint']; ?>"><?php echo $emptyValue['reviewPoint']; ?></td>
																	<td><input type="text" class="form-control" name="txtCol1Value[]" value="<?php echo $emptyValue['txtCol1Value']; ?>"></td>
																</tr>
																<?php } } ?>
															</tbody>
														</table>
    										</div>
											<div class="col-lg-12" id="txtSMessageSection<?php echo $i; ?>" style="<?php echo $dtyleText; ?>">
												<div class="form-group">
													<label>Message
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
														/*	if($result[$i]['message'] != "")
															{
																$message  = $result[$i]['message'];
															}
															else
															{
																$message  ="";
															}*/
															$message  =""; /*"<table border='1' cellspacing='0' cellpadding='0' style='border-collapse:collapse;border:none'>
	<tr>
		<th style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Sr. No.</th>
		<th style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Critical review on</th>
		<th style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Points out of 10</th>
	</tr>
	<tr>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;1</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Relevance of Title</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;7</td>
	</tr>
	<tr>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;2</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Depth of Research</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;7</td>
	</tr>
	<tr>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;3</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Extent of originality</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;7</td>
	</tr>
	<tr>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;4</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Practical Applicability</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;7</td>
	</tr>
	<tr>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;5</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Justification of conclusion</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;7</td>
	</tr>
	<tr>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;6</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Structure and Organization</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;7</td>
	</tr>
	<tr>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;7</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;Quality of references</td>
		<td style='width:49.25pt;border:1pt solid rgb(191,191,191);padding:0in 5.4pt;min-height:16.1pt'>&nbsp;7</td>
	</tr>
</table>";*/
														?>
														<textarea class="form-control" name="txtMessage" rows="6"><?php echo htmlentities($message, ENT_QUOTES, "UTF-8"); ?></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="modal-footer">
										<button type="submit" class="btn btn-primary mr-2">Update</button>
										<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
									</div> 
								</form>
							</div>
						</div>
					</div>
			<?php
					}
				}
			?>					

		<?php 
		
			$imagePath = base_url("assetsbackoffice/images/mainlogo.png");
			$updateLink = base_url()."/".BACKOFFICE.'manuscript/ManuscriptController/updateManuscript';
			$fetchLink = base_url()."/".BACKOFFICE.'manuscript/ManuscriptController/fetchDocuments';
			/*$header = "<div class='row'><div class='col-4' style='display: inline;'><img alt='Logo' src='".$imagePath."' style='width:200px; height:50px;' /></div><div  style='display: inline; margin-top:15px; text-align:center;' class='col-4'><h2>".$this->session->userdata('companyName')."</h2></div><div  style='display: inline;' class='col-4'><p>".$this->session->userdata('description')."</p></div></div><div class='separator separator-solid mb-10 mt-10'></div>";*/
			
			$header = "<div class='row'><div style='display: inline;margin-top:25px;'>&nbsp;&nbsp;&nbsp;&nbsp;<img alt='Logo' src='".$imagePath."' style='width:300px; height:60px;' /></div><div  style='display: inline; margin-top:30px; text-align:left; margin-left:20px; padding-right:150px;'><h2>International Journal in Pharmaceutical Sciences.</h2><p>Gangapur Road,Nashik - 422213.</p></div></div><div class='separator separator-solid mb-10 mt-10'></div>";
			
			$this->load->view(BACKOFFICE.'layout/footer'); 
			$this->load->view(BACKOFFICE.'layout/jsfiles');  
		?>
		
		<script>
	
	$(document).ready(function() {
		$(document).on('submit', '#submitStatusFrm', function (e) {
			e.preventDefault();
			var form = this;
			Swal.fire({
				title: "Do you want to change the status?",
				showCancelButton: true,
				confirmButtonText: "Ok",
			}).then((result) => {
				if (result.isConfirmed) {
					var bodyFormData = new FormData(form);
					$.ajax({
						url:  '<?php echo $updateLink; ?>',
						type: 'POST',
						contentType: false,
						processData: false,
						data: bodyFormData,
						success: function (data) {
							var jsonParse = JSON.parse(data);
							if (jsonParse.status == 'success') {
								Swal.fire({
									title: "Updated!",
									text: jsonParse.msg,
									icon: "success"
								});
								// $(form).trigger("reset");
								location.reload();
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: jsonParse.status
								});
							}
						}
					});
				}
			});
		});
	});

			
			function shoD(manuscriptId){
			
				$.ajax({
						url:  '<?php echo $fetchLink; ?>',
						type: 'POST',
						
						data: {manuscriptId:manuscriptId},
						success: function (data) {
						   try {
                                if (data) {
                                    var jsonParse = JSON.parse(data);
                                    if (jsonParse.status == 'success') {
                                        $("#articlePdf" + manuscriptId).val(jsonParse.document);
                                        $("#articleUrl" + manuscriptId).val(jsonParse.articleUrl);
                                    } else {
                                        // Handle failure case if needed
                                    }
                                } else {
                                    // Handle the case when data is undefined or empty
                                }
                            } catch (error) {
                                console.error('Error parsing JSON:', error);
                                // Handle the error appropriately
                            }
						}
					});
			}

		    function showhidefun($index)
		    {
		        var keyval = document.getElementById("cmbStatusID"+$index).value;
		        var boxval = document.getElementById("txtSMessageSection"+$index).value;
                
                if (keyval == '1' || keyval == '3' || keyval == '4' || keyval == '2') {
                    document.getElementById("txtSMessageSection"+$index).style.display = 'none';
                 } else {
                    document.getElementById("txtSMessageSection"+$index).style.display = '';
                 }
                 
                 if (keyval == '2') {
                    document.getElementById("status2Section"+$index).style.display = '';
                 } else {
                    document.getElementById("status2Section"+$index).style.display = 'none';
                 }
                 
                 if (keyval == '4') {
                    // document.getElementById("txtURLSection"+$index).style.display = '';
                    // document.getElementById("file1Section"+$index).style.display = '';
                    document.getElementById("file2Section"+$index).style.display = '';
                 } else {
                    // document.getElementById("txtURLSection"+$index).style.display = 'none';
                    // document.getElementById("file1Section"+$index).style.display = 'none';
                    document.getElementById("file2Section"+$index).style.display = 'none';
                 }
		    }
		</script>
		<script>
/*
		$(document).ready(function() {
    $('#kt_datatable1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            "<?php echo $header; ?>"
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            },
			{
                extend: 'excelHtml5',
                messageBottom: null
            }
        ]
    } );
} );
*/
</script>

<script>


var KTDatatablesExtensionButtons = {
	init: function () {
		var t;
		$("#kt_datatable1").DataTable({
		    <?php
				if($show == "requestwithfilters")
				{
			?>
		    order: [[ 0, 'asc' ]],
		    <?php
				}
				else
				{
			?>
		        order: [[ 0, 'desc' ]],
		    <?php
				}
			?>
			responsive: !0,
			dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
			buttons: [
			<?php
				if($show == "requestwithfilters")
				{
			?>
            {
                extend: 'print',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            "<?php echo $header; ?>"
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            },
			{
                extend: 'excelHtml5',
                messageBottom: null
            }
			<?php
				}
			?>
        ],
			/*columnDefs: [{
				width: "75px",
				targets: 6,
				render: function (t, e, l, a) {
					var n = {
						1: {
							title: "Pending",
							class: "label-light-primary"
						},
						2: {
							title: "Delivered",
							class: " label-light-danger"
						},
						3: {
							title: "Canceled",
							class: " label-light-primary"
						},
						4: {
							title: "Success",
							class: " label-light-success"
						},
						5: {
							title: "Info",
							class: " label-light-info"
						},
						6: {
							title: "Danger",
							class: " label-light-danger"
						},
						7: {
							title: "Warning",
							class: " label-light-warning"
						}
					};
					return void 0 === n[t] ? t : '<span class="label label-lg font-weight-bold' + n[t].class + ' label-inline">' + n[t].title + "</span>"
				}
			}, {
				width: "75px",
				targets: 7,
				render: function (t, e, l, a) {
					var n = {
						1: {
							title: "Online",
							state: "danger"
						},
						2: {
							title: "Retail",
							state: "primary"
						},
						3: {
							title: "Direct",
							state: "success"
						}
					};
					return void 0 === n[t] ? t : '<span class="label label-' + n[t].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + n[t].state + '">' + n[t].title + "</span>"
				}
			}]*/
		}), $("#export_print").on("click", (function (e) {
			e.preventDefault(), t.button(0).trigger()
		})), $("#export_copy").on("click", (function (e) {
			e.preventDefault(), t.button(1).trigger()
		})), $("#export_excel").on("click", (function (e) {
			e.preventDefault(), t.button(2).trigger()
		})), $("#export_csv").on("click", (function (e) {
			e.preventDefault(), t.button(3).trigger()
		})), $("#export_pdf").on("click", (function (e) {
			e.preventDefault(), t.button(4).trigger()
		}))
	}
};
jQuery(document).ready((function () {
	KTDatatablesExtensionButtons.init()
}));

		</script>
		
		<!-- datatable Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- datatable Page Scripts End -->
		
		<!-- Page Vendors(used by this page)-->
		<script src="<?php echo base_url('assetsbackoffice/plugins/custom/datatables/datatables.bundle7a50.js?v=7.2.7'); ?>"></script>
		<!-- Page Vendors-->
		
		<!-- Page Scripts(used by this page)-->
		<!--<script src="<?php echo base_url('assetsbackoffice/js/pages/crud/datatables/extensions/buttons7a50.js?v=7.2.7'); ?>"></script>-->
		<!-- Page Scripts-->
		
		<script src="<?php echo base_url('assetsbackoffice/js/pages/features/miscellaneous/toastr7a50.js?v=7.2.7'); ?>"></script>
		<script>

			
				
			
			function confirmDialog() {
				return confirm("Are you sure you want to delete this record?")
			}

			
		</script>
	</body>
</html>