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
			
			if(isset($commentResult))
			{
				$formHeading    = "Add Comment";
				$buttonName     = "Submit";
				$url            = 'comment/CommentController/insertComment';
			   
			}
			else
			{
				$this->session->set_userdata('toastrError', 'Something went wrong!');
				redirect(BACKOFFICE.SHOW_DATA_COUNTRIES, 'refresh');
			}

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
									<a href="<?php echo site_url(BACKOFFICE.'dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Comment</a>
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
									<h3 class="card-title"><?php echo $commentResult[0]['requestSeperatedName']; ?> Details</h3>
								</div>
								<div class="card-body">
									<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
										<tbody>
											<?php         
											  
												$countHeader = count($tableColumns);
												
												for($j=0; $j < $countHeader; $j++)
												{
													if ($j % 2 == 0)
													{
														echo "<tr>";
													}

													$headerName = $tableColumns[$j];
													$id = $tableColumns[0];
													
													echo "<th>".$headerArray[$j]."</th>";

													if($headerName == "invoicePDF" && $commentResult[0][$headerName] !="")
													{
														
														$link = base_url().UPLOAD_INVOICE."/";
														echo "<td><a href= '".$link.$commentResult[0][$headerName]."' target='_blank'>See Invoice</a></td>";
													}
													else
													{
														echo "<td >".$commentResult[0][$headerName]."</td>";
													}

													if ($j % 2 != 0)
													{
														echo "</tr>";
													}
												}
												
												echo "<tr><td colspan='3'></td></tr>";
											?>
																	
										</tbody>
									</table>
								</div>
								<div class="card-footer">
								</div>
							</div>
						</div>
						<div class="col-md-7">
							<div class="card card-custom">
								<div class="card-header align-items-center px-4 py-3">
									<div class="text-center flex-grow-1">
										<div class="text-dark font-weight-bold font-size-h5">Previous Comment Data</div>
									</div>
								</div>
								<div class="card-body">
									<div class="scroll scroll-pull ps ps--active-y" data-mobile-height="350" style="height: auto;">
										<div class="messages">
											<?php         
												
												for($i=0; $i < count($commentDataResult); $i++)
												{
													if($commentDataResult[$i]['commentFromFlag'] == '0')
													{
											?>
														<!--begin::Message Out-->
														<div class="d-flex flex-column mb-5 align-items-end">
															<div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">
																<?php echo $commentDataResult[$i]['comment']; ?>
															</div>
															<div class="d-flex align-items-center">
																<div>
																	<!--<a class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Purva Paryatan</a>-->
																	<span class="text-muted font-size-xs">
																		<?php echo date('d-m-Y h:i:s A', strtotime($commentDataResult[$i]['createdDate'])); ?>
																	</span>
																</div>
															</div>
															<!--
															<div class="d-flex align-items-center">
																<div>
																	<span class="text-muted font-size-xs">
																		<?php echo date('d-m-Y h:i:s A', strtotime($commentDataResult[$i]['createdDate'])); ?>
																	</span>
																</div>
															</div>-->
														</div>
														<!--end::Message Out-->
											<?php
													}
													else if($commentDataResult[$i]['commentFromFlag'] == '1')
													{
											?>
														<!--begin::Message In-->
														<div class="d-flex flex-column mb-5 align-items-start">
															<div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">
																<?php echo $commentDataResult[$i]['comment']; ?>
															</div>
															<div class="d-flex align-items-center">
																<div>
																	<!--<a class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Matt Pears</a>-->
																	<span class="text-muted font-size-xs">
																		<?php echo date('d-m-Y h:i:s A', strtotime($commentDataResult[$i]['createdDate'])); ?>)
																	</span>
																</div>
															</div>
															<!--
															<div class="d-flex align-items-center">
																<div>
																	<?php echo date('d-m-Y h:i:s A', strtotime($commentDataResult[$i]['createdDate'])); ?>
																</div>
															</div>-->
														</div>
														<!--end::Message In-->
											<?php
													}
												}
											?>
											

											
										</div>
									</div>
								</div>
								<div class="card-footer align-items-center">
								</div>
							</div>
						</div>
						<div class="col-md-7" style="display:none;">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title">Previous Comment Data</h3>
								</div>
								<div class="card-body">
									<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
										<thead>
											<tr>
												<th>Index</th>
												<th>Comment</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											<?php         
												
												for($i=0; $i < count($commentDataResult); $i++)
												{
													echo "<tr>";
														echo "<td >".($i+1)."</td>";
														echo "<td >".$commentDataResult[$i]['comment']."</td>";
														echo "<td >".date('d-m-Y h:i:s A', strtotime($commentDataResult[$i]['createdDate']))."</td>";
													echo "</tr>";
												}
											?>
																	
										</tbody>
									</table>
								</div>
								<div class="card-footer">
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title"><?php echo $formHeading; ?></h3>
								</div>
								<form method="post" action="<?php echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtRequestID" value="<?php
																																if(isset($commentResult))
																																{
																																	echo $commentResult[0]['requestID'];
																																}
																															?>">
														<input class="form-control" type="hidden" name="txtRequestName" value="<?php
																																if(isset($commentResult))
																																{
																																	echo $commentResult[0]['requestName'];
																																}
																															?>">
														<input class="form-control" type="hidden" name="txtRequestFlag" value="<?php
																																if(isset($commentResult))
																																{
																																	echo $commentResult[0]['requestFlag'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12" id="txtCommentSection">
												<div class="form-group">
													<label>Comment
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<textarea class="form-control" name="txtComment" rows="6" required></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer" id="buttonSubmit">
										<button type="submit" class="btn btn-primary mr-2"><?php echo $buttonName; ?></button>
										<!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
									</div>
								</form>
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

	</body>
</html>