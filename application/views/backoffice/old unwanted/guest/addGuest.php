		<?php 
			$this->load->view(BACKOFFICE.'layout/header'); //print_r($knowledgeCentrePostCategoryResult); exit;
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
			
			if(isset($guestResult))
			{
				$formHeading    = "Edit Guest";
				$buttonName     = "Update";
				$url            = 'guest/GuestController/updateGuest';
			   
			}
			else
			{
				$formHeading    = "Add Guest";
				$buttonName     = "Save";
				$url            = 'guest/GuestController/insertGuest';
			}
			//print_r($guestResult);exit;
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
									<a class="text-muted"> Guest</a>
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
														<input class="form-control" type="hidden" name="txtGuestID" value="<?php
																																if(isset($guestResult))
																																{
																																	echo $guestResult[0]['guestID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<div class="form-group">
													<label>Full Name
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtFullName" value="<?php
																															if(isset($guestResult))
																															{
																																echo $guestResult[0]['guestFullName'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Designation Name
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtDesignationName" value="<?php
																															if(isset($guestResult))
																															{
																																echo $guestResult[0]['designationName'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOfVisitSection">
											    <div class="form-group">
													<label>‎Visit Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															
															$dateOfVisit = date("d-m-Y");
															
															if(isset($guestResult))
															{
																$dateOfVisit = strtotime(date($guestResult[0]['visitDate']));
																$dateOfVisit = date("d-m-Y", $dateOfVisit);
															}
														?>
														<input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOf‎Visit" readonly="readonly" placeholder="Select date" name="dtpDateOf‎Visit" value="<?php echo $dateOfVisit; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="txtIntroductionSection">
											    <div class="form-group">
													<label for="exampleTextarea">Introduction  
													<span class="text-danger">*</span></label>
													<?php
														if(isset($guestResult))
														{
															$introduction  = $guestResult[0]['introduction'];
														}
														else
														{
															$introduction  ="";
														}
													?>
													<textarea class="form-control" name="txtIntroduction" rows="5" cols="80" required><?php echo $introduction; ?></textarea>
												</div>
											</div>
											<div class="col-lg-6" id="txtImageSection">
											    <div class="form-group">
													<label>Photo
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtPhoto" value="<?php
																															if(isset($guestResult))
																															{
																																echo $guestResult[0]['photo'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtPhoto" name="txtPhoto" accept="image/jpeg, image/jpg, image/png"/>
														<span class="form-text text-muted mb-5">(Dimensions : 400 X 400)</span>
														<?php
                                                            
                                                            if(isset($guestResult) && $guestResult[0]['photo'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_GUEST_PHOTO.$guestResult[0]['photo']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_GUEST_PHOTO.$guestResult[0]['photo']."' width='100px'>
                                                                    </a><h6>Previous Image</h6>";
                                                            }
                                                        ?>
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
		
		<script>
			var KTBootstrapDatepicker = function () {

				var arrows;
				if (KTUtil.isRTL()) {
					arrows = {
						leftArrow: '<i class="la la-angle-right"></i>',
						rightArrow: '<i class="la la-angle-left"></i>'
					}
				} else {
					arrows = {
					leftArrow: '<i class="la la-angle-left"></i>',
					rightArrow: '<i class="la la-angle-right"></i>'
					}
				}

				// minimum setup for modal demo
				$('#dtpDateOf‎Visit').datepicker({
					rtl: KTUtil.isRTL(),
					todayHighlight: true,
					orientation: "bottom left",
					templates: arrows,
					autoclose: true
				});

				return {
					// public functions
					init: function() {
						demos();
					}
				};
			}();

			jQuery(document).ready(function() {
				KTBootstrapDatepicker.init();
			});

		</script>
		
		
		<!--Js for date picker start-->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/crud/forms/widgets/bootstrap-datepicker7a50.js?v=7.2.7'); ?>"></script>
		<!--Js for date picker end-->
	</body>
</html>