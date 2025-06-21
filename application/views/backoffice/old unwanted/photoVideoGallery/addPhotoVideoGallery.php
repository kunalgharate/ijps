		<?php 
			$this->load->view(BACKOFFICE.'layout/header'); 
			//echo $photoVideoGalleryResult[0]['photoVideoTypeFlag']; print_r($photoVideoGalleryResult);exit;
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
			
			if(isset($photoVideoGalleryResult))
			{
				$formHeading    = "Edit Photo/Video Gallery";
				$buttonName     = "Update";
				$url            = 'photoVideoGallery/PhotoVideoGalleryController/updatePhotoVideoGallery';
			   
			}
			else
			{
				$formHeading    = "Add Photo/Video Gallery";
				$buttonName     = "Save";
				$url            = 'photoVideoGallery/PhotoVideoGalleryController/insertPhotoVideoGallery';
			}
			//print_r($photoVideoGalleryResult);exit;
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
									<a class="text-muted"> Photo Gallery</a>
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
						<div class="col-md-6">
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
														<input class="form-control" type="hidden" name="txtPhotoVideoGalleryID" value="<?php
																																if(isset($photoVideoGalleryResult))
																																{
																																	echo $photoVideoGalleryResult[0]['photoVideoGalleryID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12" id="rbtnPhotoVideoTypeFlagSection">
												<?php
													$checked0 = "";
													$checked1 = "";
													$checked2 = "checked='checked'";

													if(isset($photoVideoGalleryResult))
													{
														if($photoVideoGalleryResult[0]['photoVideoTypeFlag'] == 0)
														{ 
															$checked0 = "checked='checked'";
															$checked1 = "";
															$checked2 = ""; 
														}
														else if($photoVideoGalleryResult[0]['photoVideoTypeFlag'] == 1)
														{
															$checked0 = "";
															$checked1 = "checked='checked'";
															$checked2 = "";
														}
														else
														{ 
															$checked0 = "";
															$checked1 = "";
															$checked2 = "checked='checked'";
														}
													}
												?>
										        <div class="form-group row ml-1">
													<div class="radio-inline col-10">
													    <label class="radio">
															<input type="radio" <?php echo $checked0; ?> name="rbtnPhotoVideoTypeFlag" id="rbtnPhotoVideoTypeFlag-0" value='0' onclick="photoVideoTypeFlagEvent(this);">
															<span></span>YouTube Video
														</label>
														<label class="radio">
															<input type="radio" <?php echo $checked1; ?> name="rbtnPhotoVideoTypeFlag" id="rbtnPhotoVideoTypeFlag-1" value='1' onclick="photoVideoTypeFlagEvent(this);">
															<span></span>Local Video
														</label>
														<label class="radio">
															<input type="radio" <?php echo $checked2; ?> name="rbtnPhotoVideoTypeFlag" id="rbtnPhotoVideoTypeFlag-2" value='2' onclick="photoVideoTypeFlagEvent(this);">
															<span></span>Photo
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12" id="cmbPhotoGalleryCategoryIDSection">
										        <div class="form-group">
													<label>Photo Gallery Category
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbPhotoVideoGalleryCategoryID" id="cmbPhotoVideoGalleryCategoryID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($photoVideoGalleryCategoryResult); $i++)
																	{
    																		if($photoVideoGalleryCategoryResult[$i]['photoVideoGalleryCategoryID'] == $photoVideoGalleryResult[0]['photoVideoGalleryCategoryID'])
    																		{
    																			echo "<option value=".$photoVideoGalleryCategoryResult[$i]['photoVideoGalleryCategoryID']." selected>".$photoVideoGalleryCategoryResult[$i]['name']."</option>";
    																		} 
    																		else
    																		{
    																			echo "<option value=".$photoVideoGalleryCategoryResult[$i]['photoVideoGalleryCategoryID'].">".$photoVideoGalleryCategoryResult[$i]['name']."</option>";
    																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtVideoURLSection">
												<div class="form-group">
													<label>Video URL</label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtVideoURL" value="<?php
																															if(isset($photoVideoGalleryResult))
																															{
																																echo $photoVideoGalleryResult[0]['photoVideoLink'];
																															}
																														?>">
													</div>
													<span class="form-text text-muted">YouTube video embed link</span>
													<?php
                                                        if(isset($photoVideoGalleryResult) && $photoVideoGalleryResult[0]['photoVideoLink'] != "" && $photoVideoGalleryResult[0]['photoVideoTypeFlag'] == "0")
                                                        {
													?>
														<iframe width="100%" height="250px"
														src="<?php echo $photoVideoGalleryResult[0]['photoVideoLink']; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
														</iframe>
													<?php
														}
													?>
												</div>
											</div>
											<div class="col-lg-12" id="txtVideoURLUploadSection">
											    <div class="form-group">
													<label>Choose Video File
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtVideoURLUpload">
														<input type="file" class="fileUpload" id="txtVideoURLUpload" name="txtVideoURLUpload" accept="video/mp4">
													</div>
													<span class="form-text text-muted">Allowed file types: mp4 only</span>
													<?php
                                                        if(isset($photoVideoGalleryResult) && $photoVideoGalleryResult[0]['photoVideoLink'] != "" && $photoVideoGalleryResult[0]['photoVideoTypeFlag'] == "1")
                                                        {
													?>
														<iframe width="100%" height="200px"
														src="<?php echo base_url().UPLOAD_GALLERY_PHOTO_VIDEO.$photoVideoGalleryResult[0]['photoVideoLink']; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
														</iframe>
													<?php
														}
													?>
												</div>
											</div>
											<div class="col-lg-12" id="txtImageSection">
											    <div class="form-group">
													<label>Image
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtImage" value="<?php
																															if(isset($photoVideoGalleryResult))
																															{
																																echo $photoVideoGalleryResult[0]['photoVideoLink'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtImage" name="txtImage" accept="image/jpeg, image/jpg, image/png"/>
														<span class="form-text text-muted mb-5">(Dimensions : 250 X 250)</span>
														<?php
                                                            
                                                            if(isset($photoVideoGalleryResult) && $photoVideoGalleryResult[0]['photoVideoLink'] != "" && $photoVideoGalleryResult[0]['photoVideoTypeFlag'] == "2")
                                                            {																
                                                                echo "<a href='".base_url().UPLOAD_GALLERY_PHOTO_VIDEO.$photoVideoGalleryResult[0]['photoVideoLink']."' target='_BLANK'>
                                                                        <img alt='image' src='".base_url().UPLOAD_GALLERY_PHOTO_VIDEO.$photoVideoGalleryResult[0]['photoVideoLink']."' width='100px'>
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
			
			function photoVideoTypeFlagEvent(myRadio) 
			{
				var photoVideoTypeFlag = myRadio.value;
            
				if(photoVideoTypeFlag == 0)
				{   
					document.getElementById('txtVideoURLSection').style.display = "";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
					document.getElementById('txtImageSection').style.display = "none";
				}
				else if(photoVideoTypeFlag == 1)
				{
					document.getElementById('txtVideoURLSection').style.display = "none";
					document.getElementById('txtVideoURLUploadSection').style.display = "";
					document.getElementById('txtImageSection').style.display = "none";
				}
				else
				{
					document.getElementById('txtVideoURLSection').style.display = "none";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
					document.getElementById('txtImageSection').style.display = "";
				}
            } 
		</script>
		<?php
		if(isset($photoVideoGalleryResult))
			{
		?>
				<script>
					document.getElementById('txtVideoURLSection').style.display = "none";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
					document.getElementById('txtImageSection').style.display = "none";
				</script>
		<?php
				if($photoVideoGalleryResult[0]['photoVideoTypeFlag'] == 0)
				{ 
					$checked0 = "checked='checked'";
					$checked1 = "";
					$checked2 = ""; 
		?>
				<script>
					document.getElementById('txtVideoURLSection').style.display = "";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
					document.getElementById('txtImageSection').style.display = "none";
				</script>
		<?php
				}
				else if($photoVideoGalleryResult[0]['photoVideoTypeFlag'] == 1)
				{
					$checked0 = "";
					$checked1 = "checked='checked'";
					$checked2 = "";
		?>		
				<script>
					document.getElementById('txtVideoURLSection').style.display = "none";
					document.getElementById('txtVideoURLUploadSection').style.display = "";
					document.getElementById('txtImageSection').style.display = "none";
				</script>
		<?php
				}
				else
				{ 
					$checked0 = "";
					$checked1 = "";
					$checked2 = "checked='checked'";
		?>
				<script> 
					document.getElementById('txtVideoURLSection').style.display = "none";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
					document.getElementById('txtImageSection').style.display = "";

				</script>
		<?php
				}
			}
			else
			{ 
		?>
				<script> 
					document.getElementById('txtVideoURLSection').style.display = "none";
					document.getElementById('txtVideoURLUploadSection').style.display = "none";
					document.getElementById('txtImageSection').style.display = "";
				</script>
		<?php
			}
		?>
		<script type='text/javascript'> 
			//photoVideoTypeFlagEvent(1);
		</script>
	</body>
</html>