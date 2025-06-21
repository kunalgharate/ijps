		<?php 
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu');
			
			$urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$segments = explode('/', $urlArray);
			$numSegments = count($segments); 
			$currentSegment = $segments[$numSegments - 2];
			
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
									<a href="<?php echo base_url().$currentSegment; ?>" class="text-muted"> <?php echo $pageHeading; ?></a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> <?php echo $postDetailsResult[0]['postHeading']; ?></a>
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
				<div class="container-fluid">
					<div class="card card-custom gutter-b">
						<div class="card-body">
							<div class="d-flex">
								<div class="mr-7">
									<img src="<?php echo base_url().UPLOAD_POST.$postDetailsResult[0]['thumbnailImage']; ?>" alt="image" style="width:450px" class ="rounded">
								</div>
								<div class="flex-grow-1">
									<div class="d-flex align-items-center justify-content-between flex-wrap mt-10">
										<div class="mr-3">
											<a class="d-flex align-items-center text-dark text-hover-primary font-size-h1 font-weight-bold mr-3">
												<?php echo $postDetailsResult[0]['postHeading']; ?>
											</a>
											<div class="d-flex flex-wrap my-2 mt-5">
												<a class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
													<i class="fas fa-user-tie svg-icon svg-icon-md svg-icon-gray-500 mr-1"></i>
													<?php echo $postDetailsResult[0]['createdByUserName']; ?>
												</a>
												<a class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
													<i class="far fa-calendar-alt svg-icon svg-icon-md svg-icon-gray-500 mr-1"></i>
													<?php echo date('d M Y G:ia', strtotime($postDetailsResult[0]['createdDate'])); ?>
												</a>
											</div>
										</div>
										<div class="my-lg-0 my-1">
											<a href="<?php echo base_url().$currentSegment; ?>" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">
												<i class="fa fa-reply svg-icon svg-icon-md svg-icon-white-500 mr-1"></i>
												Back
											</a>
										</div>
									</div>
									<div class="d-flex align-items-center flex-wrap justify-content-between mt-5">
										<div class="flex-grow-1 font-weight-bold text-dark-50 py-5 py-lg-2 mr-5">
											<?php echo $postDetailsResult[0]['postShortDescription']; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="separator separator-solid my-7"></div>
							<div class="d-flex align-items-center flex-wrap">
								<div class="d-flex align-items-center flex-lg-fill- mr-0 my-1 w-25">
									<span class="mr-4">
										<i class="fas fa-user-tie svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
									</span>
									<div class="d-flex flex-column flex-lg-fill">
										<span class="text-dark-75 font-weight-bolder font-size-sm">Author</span>
										<?php echo $postDetailsResult[0]['createdByUserName']; ?>
									</div>
								</div>
								<div class="d-flex align-items-center flex-lg-fill- mr-0 my-1 w-25">
									<span class="mr-4">
										<i class="fas fa-calendar-alt svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
									</span>
									<div class="d-flex flex-column flex-lg-fill">
										<?php
											if($currentSegment == "trainings")
											{
										?>
												<span class="text-dark-75 font-weight-bolder font-size-sm">Training Date</span>
										<?php
												echo date('d M Y', strtotime($postDetailsResult[0]['dateOf‎Training'])); 
											}
											else
											{
										?>
												<span class="text-dark-75 font-weight-bolder font-size-sm">Publish Date</span>
										<?php 
												echo date('d M Y G:ia', strtotime($postDetailsResult[0]['createdDate'])); 
											}
										?>
									</div>
								</div>
								<?php 
									if($postDetailsResult[0]['videoURL'] != "")
									{
								?>
										<div class="d-flex align-items-center flex-lg-fill- mr-0 my-1 w-25">
											<span class="mr-4">
												<i class="fas fa-video svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
											</span>
											<div class="d-flex flex-column flex-lg-fill">
												<span class="text-dark-75 font-weight-bolder font-size-sm">VIDEO</span>
												<a class="text-primary font-weight-bolder" data-toggle="modal" data-target="#video-modal">View</a>
											</div>
										</div>
								<?php 
									}
									
									if($postDetailsResult[0]['PDFFile'] != "")
									{
								?>
										<div class="d-flex align-items-center flex-lg-fill- mr-0 my-1 w-25">
											<span class="mr-4">
												<i class="fas fa-file-pdf svg-icon svg-icon-md svg-icon-white-500 mr-1 icon-2x"></i>
											</span>
											<div class="d-flex flex-column flex-lg-fill">
												<span class="text-dark-75 font-weight-bolder font-size-sm">PDF</span>
												<a href="<?php echo base_url().UPLOAD_POST.$postDetailsResult[0]['PDFFile']; ?>"  class="text-primary font-weight-bolder" data-toggle="modal" data-target="#pdf-modal">View</a>
											</div>
										</div>
								<?php 
									}
								?>
							</div>
							<div class="separator separator-solid my-7"></div>
							<div class="d-flex align-items-center flex-wrap">
								<?php echo $postDetailsResult[0]['postDescription']; ?>
							</div>
							<div class="separator separator-solid my-7"></div>
							<?php 
								if($postDetailsResult[0]['postCategoryID'] == "5" && ($postDetailsResult[0]['dateOf‎Training'] < date("Y-m-d")	))
								{
							?>
								<form method="post" action="<?php echo base_url('trainings/sendFeedback'); ?>" enctype="multipart/form-data" class="container-fluid w-75 mt-20">
									<span class="d-flex align-items-center text-dark text-hover-primary font-size-h6 font-weight-bold mb-0">
										PLEASE GIVE US
									</span>	
									<span class="d-flex align-items-center text-primary text-hover-dark font-size-h2 font-weight-bold mb-5">
										<i class="far fa-edit svg-icon svg-icon-md svg-icon-gray-500 mr-1"></i>YOUR FEEDBACK
									</span>

									<div class="form-group" style="display:none;">
										<div class="custom-file">
											<input class="form-control" type="hidden" name="txtPostID" value="<?php
																													if(isset($postDetailsResult))
																													{
																														echo $postDetailsResult[0]['postID'];
																													}
																												?>">
										</div>
									</div>
									<table class="table table-hover">
										<thead class= "table-dark">
											<tr class= "bg-primary">
												<th scope="col" style="width:650px;">Training Content</th>
												<th scope="col">Excellent(5)</th>
												<th scope="col">Good(4)</th>
												<th scope="col">Satisfactory(3)</th>
												<th scope="col">Fair(2)</th>
												<th scope="col">Poor(1)</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th scope="row">The training content was relevant to me</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnTrainingContentFlag1" value='5'>
														<span></span>                                                         
													</label>                                                                  
												</td>                                                                         
												<td>                                                                          
													<label class="radio">                                                     
														<input type="radio" name="rbtnTrainingContentFlag1" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag1" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag1" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag1" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
											<tr>
												<th scope="row">The amount of material covered was sufficient</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnTrainingContentFlag2" value='5'>
														<span></span>                                                         
													</label>                                                                  
												</td>                                                                         
												<td>                                                                          
													<label class="radio">                                                     
														<input type="radio" name="rbtnTrainingContentFlag2" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag2" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag2" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag2" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
											<tr>
												<th scope="row">Instructional methods & media were used appropriately which made learning easy</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnTrainingContentFlag3" value='5'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag3" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag3" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag3" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag3" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
											<tr>
												<th scope="row">I am confident of using the concepts covered</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnTrainingContentFlag4" value='5'>
														<span></span>                                                         
													</label>                                                                  
												</td>                                                                         
												<td>                                                                          
													<label class="radio">                                                     
														<input type="radio" name="rbtnTrainingContentFlag4" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag4" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag4" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag4" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
											<tr>
												<th scope="row">Duration of the training was appropriate</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnTrainingContentFlag5" value='5'>
														<span></span>                                                         
													</label>                                                                  
												</td>                                                                         
												<td>                                                                          
													<label class="radio">                                                     
														<input type="radio" name="rbtnTrainingContentFlag5" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag5" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag5" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag5" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
											<tr>
												<th scope="row">The training met my expectations</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnTrainingContentFlag6" value='5'>
														<span></span>                                                         
													</label>                                                                  
												</td>                                                                         
												<td>                                                                          
													<label class="radio">                                                     
														<input type="radio" name="rbtnTrainingContentFlag6" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag6" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag6" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnTrainingContentFlag6" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
										</tbody>
									</table>
									
									<table class="table mt-10">
										<thead class= "table-dark">
											<tr class= "bg-primary">
												<th scope="col" style="width:650px;">Faculty</th>
												<th scope="col">Excellent(5)</th>
												<th scope="col">Good(4)</th>
												<th scope="col">Satisfactory(3)</th>
												<th scope="col">Fair(2)</th>
												<th scope="col">Poor(1)</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th scope="row">Faculty had a good grasp of the subject</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnFacultyFlag1" value='5'>
														<span></span>                                                         
													</label>                                                                  
												</td>                                                                         
												<td>                                                                          
													<label class="radio">                                                     
														<input type="radio" name="rbtnFacultyFlag1" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag1" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag1" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag1" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
											<tr>
												<th scope="row">The concepts were clearly explained</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnFacultyFlag2" value='5'>
														<span></span>                                                         
													</label>                                                                  
												</td>                                                                         
												<td>                                                                          
													<label class="radio">                                                     
														<input type="radio" name="rbtnFacultyFlag2" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag2" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag2" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag2" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
											<tr>
												<th scope="row">Faculty involved all participants</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnFacultyFlag3" value='5'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag3" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag3" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag3" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag3" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
											<tr>
												<th scope="row">My questions were answered adequately</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnFacultyFlag4" value='5'>
														<span></span>                                                         
													</label>                                                                  
												</td>                                                                         
												<td>                                                                          
													<label class="radio">                                                     
														<input type="radio" name="rbtnFacultyFlag4" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag4" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag4" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag4" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
											<tr>
												<th scope="row">Faculty was supportive and encouraging</th>
												<td>
													<label class="radio">
														<input type="radio" checked="checked" name="rbtnFacultyFlag5" value='5'>
														<span></span>                                                         
													</label>                                                                  
												</td>                                                                         
												<td>                                                                          
													<label class="radio">                                                     
														<input type="radio" name="rbtnFacultyFlag5" value='4'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag5" value='3'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag5" value='2'>
														<span></span>                                       
													</label>                                                
												</td>                                                       
												<td>                                                        
													<label class="radio">                                   
														<input type="radio" name="rbtnFacultyFlag5" value='1'>
														<span></span>
													</label>
												</td>
											</tr>
										</tbody>
									</table>
								
									<div class="col-lg-12" id="txtUsefulAspectSection">
										<div class="form-group">
											<label>Three most useful aspect of the training program for me were
											<span class="text-danger">*</span></label>
											<div class="custom-file">
												<textarea class="form-control" name="txtPostDescription" rows="6" required></textarea>
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-primary mr-2">Submit</button>
								</form>
							<?php
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- VIDEO Modal-->
		<div class="modal fade" id="video-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
			<div class="modal-dialog .modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><?php echo $postDetailsResult[0]['postHeading']; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="ki ki-close"></i>
						</button>
					</div>
					<div class="modal-body">
						<?php 
							if($postDetailsResult[0]['videoURL'] != "")
							{
								if($postDetailsResult[0]['videoTypeFlag'] == "1")
								{
									$videoURL = base_url().UPLOAD_POST.$postDetailsResult[0]['videoURL'];
								}
								else
								{
									$videoURL = $postDetailsResult[0]['videoURL'];
								}
							}
						?>
						<iframe width="100%" height="600px"
							src="<?php echo $videoURL; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
						</iframe>
					</div>
				</div>
			</div>
		</div>

		<!-- PDF Modal-->
		<div class="modal fade" id="pdf-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
			<div class="modal-dialog .modal-dialog-scrollable1 modal-dialog-centered modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><?php echo $postDetailsResult[0]['postHeading']; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="ki ki-close"></i>
						</button>
					</div>
					<div class="modal-body">
						<?php 
							if($postDetailsResult[0]['PDFFile'] != "")
							{
								$PDFURL = base_url().UPLOAD_POST.$postDetailsResult[0]['PDFFile'];
						?>
								<iframe width="100%" height="600px"
									src="<?php echo $PDFURL; ?>">
								</iframe>
						<?php	
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