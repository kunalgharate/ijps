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
			
			if(isset($requestResult))
			{
				$formHeading    = "";
				
				if($requestResult[0]['loadFlag'] == '1')
				{
					$formHeading    = "Upload Invoice";
				}
				else
				{
					$formHeading    = "Change Status";
				}
				
				$buttonName     = "Submit";
				$url            = 'request/RequestController/updateRequest';
			   
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
									<a class="text-muted"> Upload Invoice</a>
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
									<h3 class="card-title"><?php echo $requestResult[0]['requestSeperatedName']; ?> Details</h3>
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

													if($headerName == "invoicePDF" && $requestResult[0][$headerName] !="")
													{
														
														$link = base_url().UPLOAD_INVOICE."/";
														echo "<td><a href= '".$link.$requestResult[0][$headerName]."' target='_blank'>See Invoice</a></td>";
													}
													else
													{
														echo "<td >".$requestResult[0][$headerName]."</td>";
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
						
						<div class="col-md-3">
						</div>
						<div class="col-md-12">
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
																																if(isset($requestResult))
																																{
																																	echo $requestResult[0]['requestID'];
																																}
																															?>">
																															
														<input class="form-control" type="hidden" name="txtRequestName" value="<?php
																																if(isset($requestResult))
																																{
																																	echo $requestResult[0]['requestName'];
																																}
																														?>">
																														
														<input class="form-control" type="hidden" name="txtLoadFlag" value="<?php
																																if(isset($requestResult))
																																{
																																	echo $requestResult[0]['loadFlag'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<!--
											<div class="col-lg-12">
												<div class="form-group">
													<label>Request ID 
													</label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtRequest" value="<?php
																															if(isset($requestResult))
																															{
																																echo $requestResult[0]['requestID'];
																															}
																														?>" required readonly>
													</div>
												</div>
											</div>-->
											<?php
												if($requestResult[0]['loadFlag'] == '1')
												{
											?>
											
											<div class="col-lg-12" id="txtInvoicePDFSection">
											    <div class="form-group">
													<label>Invoice
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtInvoicePDF" value="<?php
																															if(isset($requestResult))
																															{
																																echo $requestResult[0]['invoicePDF'];
																															}
																															?>">
														<input type="file" class="fileUpload" id="txtInvoicePDF" name="txtInvoicePDF" accept="application/PDF"/>
																														
														<!--<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>-->
														<div id='PreviousImages'>
														<?php
                                                            
                                                            if(isset($requestResult) && $requestResult[0]['invoicePDF'] != "")
                                                            {																
                                                                /*echo "<a href='".base_url().UPLOAD_INVOICE.$requestResult[0]['invoicePDF']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_INVOICE.$requestResult[0]['invoicePDF']."' width='100px'>
                                                                    </a>";*/
																$link = base_url().UPLOAD_INVOICE."/";
																echo "<h6 style='margin-top:10px;'>Previous Invoice : <a href= '".$link.$requestResult[0]['invoicePDF']."' target='_blank'>See Invoice</a></h6>";
                                                            }
                                                        ?>
														</div>
														
													</div>
												</div>
											</div> 
										
											<?php
												}
												else
												{
											?>
											<div class="col-lg-12" id="cmbStatusIDSection">
										        <div class="form-group">
													<label>Status
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbStatusID" id="cmbStatusID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($statusResult); $i++)
																	{
    																		if($statusResult[$i]['statusID'] == $requestResult[0]['statusID'])
    																		{
    																			echo "<option value=".$statusResult[$i]['statusID']." selected>".$statusResult[$i]['statusName']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$statusResult[$i]['statusID'].">".$statusResult[$i]['statusName']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<?php
													
												}
											?>
										</div>
									</div>
									<div class="card-footer" id="buttonSubmit">
										<button type="submit" class="btn btn-primary mr-2"><?php echo $buttonName; ?></button>
										<!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-3">
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