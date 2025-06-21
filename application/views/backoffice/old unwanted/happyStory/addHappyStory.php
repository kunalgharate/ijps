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
				
				#preview img { max-width: 100px; }
			</style>
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			if(isset($happyStoryResult))
			{
				$formHeading    = "Edit Happy Story";
				$buttonName     = "Update";
				$url            = 'happyStories/HappyStoriesController/updateHappyStory';
			}
			else
			{
				$formHeading    = "Add Happy Story";
				$buttonName     = "Save";
				$url            = 'happyStories/HappyStoriesController/insertHappyStory';
			}
		?>
		
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content" onload="myFunction()">
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
									<a class="text-muted"> Happy Story</a>
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
									<h3 class="card-title"><?php echo $formHeading; ?></h3>
								</div>
								<form method="post" action="<?php echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data" onload ="test();">
									<div class="card-body">
										<div class="row">
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtHappyStoryID" value="<?php
																																if(isset($happyStoryResult))
																																{
																																	echo $happyStoryResult[0]['happyStoryID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
										    <div class="col-lg-12">
												<div class="form-group">
													<label>Story Heading
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtStoryHeading" value="<?php
																															if(isset($happyStoryResult))
																															{
																																echo $happyStoryResult[0]['happyStoryHeading'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtStoryShortDescriptionSection">
												<div class="form-group">
													<label>Story Short Description
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($happyStoryResult))
															{
																$happyStoryShortDescription  = $happyStoryResult[0]['happyStoryShortDescription'];
															}
															else
															{
																$happyStoryShortDescription  ="";
															}
														?>
														<textarea class="form-control" name="txtStoryShortDescription" rows="6" required><?php echo $happyStoryShortDescription; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtStoryDescriptionSection">
												<div class="form-group">
													<label>Story Description
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($happyStoryResult))
															{
																$storyDescription  = $happyStoryResult[0]['happyStoryDescription'];
															}
															else
															{
																$storyDescription  ="";
															}
														?>
														<textarea class="form-control" name="txtStoryDescription" rows="6" required><?php echo $storyDescription; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="rbtnVideoTypeFlagSection">
												<?php
													$checked0 = "checked='checked'";
													$checked1 = "";

													if(isset($happyStoryResult))
													{
														if($happyStoryResult[0]['videoTypeFlag'] == '0')
														{
															$checked0 = "checked='checked'";
															$checked1 = "";
														}
														else
														{
															$checked1 = "checked='checked'";
															$checked0 = "";
														}
													}
												?>
										        <div class="form-group">
													<label>Video Type</label>
													<div class="radio-inline">
													    <label class="radio">
															<input type="radio" <?php echo $checked0; ?> name="rbtnVideoTypeFlag" id="rbtnVideoTypeFlag-0" value='0' onclick="videoTypeFlagEvent(this);">
															<span></span>YouTube Video
														</label>
														<label class="radio">
															<input type="radio" <?php echo $checked1; ?> name="rbtnVideoTypeFlag" id="rbtnVideoTypeFlag-1" value='1' onclick="videoTypeFlagEvent(this);">
															<span></span>Local Video
														</label>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="txtVideoURLSection">
												<div class="form-group">
													<label>Video URL</label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtVideoURL" value="<?php
																															if(isset($happyStoryResult))
																															{
																																echo $happyStoryResult[0]['videoURL'];
																															}
																														?>">
													</div>
													<span class="form-text text-muted">YouTube video embed link</span>
												</div>
											</div>
											<div class="col-lg-4" id="txtVideoURLUploadSection">
											    <div class="form-group">
													<label>Choose Video File
													</label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtVideoURLUpload">
														<input type="file" class="fileUpload" id="txtVideoURLUpload" name="txtVideoURLUpload" accept="video/mp4">
													</div>
													<span class="form-text text-muted">Allowed file types: mp4 only</span>
												</div>
											</div>
											<div class="col-lg-4" id="txtThumbnailImageSection">
											    <div class="form-group">
													<label>Thumbnail Image
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtThumbnailImage" value="<?php
																															if(isset($happyStoryResult))
																															{
																																echo $happyStoryResult[0]['thumbnailImage'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtThumbnailImage" name="txtThumbnailImage" accept="image/jpeg, image/jpg, image/png" required />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImages'>
														<?php
                                                            
                                                            if(isset($happyStoryResult) && $happyStoryResult[0]['thumbnailImage'] != "")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_HAPPY_STORY.$happyStoryResult[0]['thumbnailImage']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_HAPPY_STORY.$happyStoryResult[0]['thumbnailImage']."' width='100px'>
                                                                    </a><h6>Previous Image</h6>";
                                                            }
                                                        ?>
														</div>
														<div id="preview"></div>
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
		<script>
			document.getElementById('txtVideoURLUploadSection').style.display = "none";
			
			function videoTypeFlagEvent(myRadio) 
			{
				var videoTypeFlag = myRadio.value;
            
				if(videoTypeFlag == 1)
				{   
					document.getElementById('txtVideoURLSection').style.display = "none";
					document.getElementById('txtVideoURLUploadSection').style.display = "";
				}
				else
				{
					document.getElementById('txtVideoURLSection').style.display = "";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
				}
            } 
			

		</script>
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
				$('#dtpDateOfTraining').datepicker({
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
		
		<script>
			const preview = (file) => {
										document.querySelector('#preview').innerHTML = "";
										document.querySelector('#PreviousImages').innerHTML = "";
										
										const fr = new FileReader();
										fr.onload = () => {
																const img = document.createElement("img");
																img.src = fr.result;  // String Base64 
																img.alt = file.name;
																document.querySelector('#preview').append(img);
															};
														fr.readAsDataURL(file);
													};

			document.querySelector("#txtThumbnailImage").addEventListener("change", (ev) => {
				if (!ev.target.files) return; // Do nothing.
					[...ev.target.files].forEach(preview);
				});
		</script>
		
		<?php
			if(isset($happyStoryResult))
			{
				if($happyStoryResult[0]['videoTypeFlag']=="0")
				{
		?>
					<script type='text/javascript'> 
						document.getElementById('txtVideoURLSection').style.display = "";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
					</script>
		<?php
				}
				else if($happyStoryResult[0]['videoTypeFlag']=="1")
				{
		?>
					<script type='text/javascript'> 
						document.getElementById('txtVideoURLSection').style.display = "none";
						document.getElementById('txtVideoURLUploadSection').style.display = "";
					</script>
		<?php
				}
			}
		?>
		<script>
                CKEDITOR.replace( 'txtStoryDescription' );
        </script>
	</body>
</html>