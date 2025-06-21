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
				
				#previewA img { max-width: 150px; }
				#previewB img { max-width: 150px; }
			</style>
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			if(isset($blogResult))
			{
				$formHeading    = "Edit Blog";
				$buttonName     = "Update";
				$url            = 'blog/BlogController/updateBlog';
			}
			else
			{
				$formHeading    = "Add Blog";
				$buttonName     = "Save";
				$url            = 'blog/BlogController/insertBlog';
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
									<a class="text-muted"> Blog</a>
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
								<form method="post" id="addblogFrm" enctype="multipart/form-data" onload ="test();">
								<!-- <form method="post" action="<?php echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data" onload ="test();"> -->
									<div class="card-body">
										<div class="row">
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtBlogID" value="<?php
																																if(isset($blogResult))
																																{
																																	echo $blogResult[0]['blogID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4" id="cmbBlogCategoryIDSection">
										        <div class="form-group">
													<label>Blog Category
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbBlogCategoryID" id="cmbBlogCategoryID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($blogCategoryResult); $i++)
																	{
																		if($blogCategoryResult[$i]['blogCategoryID'] == $blogResult[0]['blogCategoryID'])
																		{
																			echo "<option value=".$blogCategoryResult[$i]['blogCategoryID']." selected>".$blogCategoryResult[$i]['blogCategoryName']."</option>";
																		} 
																		else
																		{
																			echo "<option value=".$blogCategoryResult[$i]['blogCategoryID'].">".$blogCategoryResult[$i]['blogCategoryName']."</option>";
																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-8">
												<div class="form-group">
													<label>Title
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtTitle" value="<?php
																															if(isset($blogResult))
																															{
																																echo $blogResult[0]['title'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Keyword
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtTitle" value="<?php if(isset($blogResult))	{	echo $blogResult[0]['title']; } ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtShortDescriptionSection">
												<div class="form-group">
													<label>Short Description
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($blogResult))
															{
																$shortDescription  = $blogResult[0]['shortDescription'];
															}
															else
															{
																$shortDescription  ="";
															}
														?>
														<textarea class="form-control" name="txtShortDescription" rows="6" required><?php echo $shortDescription; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtDescriptionSection">
												<div class="form-group">
													<label>Description
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($blogResult))
															{
																$description  = $blogResult[0]['description'];
															}
															else
															{
																$description  ="";
															}
														?>
														<textarea class="form-control" name="txtDescription" rows="6" required><?php echo $description; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="txtThumbnailImageSection">
												<div class="form-group">
													<label>Thumbnail Image
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtThumbnailImage" value="<?php
																															if(isset($blogResult))
																															{
																																echo $blogResult[0]['thumbnailImage'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtThumbnailImage" name="txtThumbnailImage" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesA'>
														<?php
															
															if(isset($blogResult) && $blogResult[0]['thumbnailImage'] != "")
															{																
																echo "<a href='".base_url().UPLOAD_BLOG.$blogResult[0]['thumbnailImage']."' target='_BLANK'>
																		<img alt='image' src='".base_url().UPLOAD_BLOG.$blogResult[0]['thumbnailImage']."' width='100px'>
																	</a><h6>Previous Image</h6>";
															}
														?>
														</div>
														<div id="previewA"></div>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="txtBannerImageSection">											
												<div class="form-group">
													<label>Banner Image
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtBannerImage" value="<?php
																															if(isset($blogResult))
																															{
																																echo $blogResult[0]['bannerImage'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtBannerImage" name="txtBannerImage" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesB'>
														<?php
															
															if(isset($blogResult) && $blogResult[0]['bannerImage'] != "")
															{																
																echo "<a href='".base_url().UPLOAD_BLOG.$blogResult[0]['bannerImage']."' target='_BLANK'>
																		<img alt='image' src='".base_url().UPLOAD_BLOG.$blogResult[0]['bannerImage']."' width='100px'>
																	</a><h6>Previous Image</h6>";
															}
														?>
														</div>
														<div id="previewB"></div>
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
		<script>
                CKEDITOR.replace( 'txtDescription' );
        </script>
		<?php 
			$this->load->view(BACKOFFICE.'layout/footer');
			$this->load->view(BACKOFFICE.'layout/jsfiles');
			$ajaxUrl = site_url(BACKOFFICE.$url);
		?>
		
		
		<script>
			const preview = (file) => {
										document.querySelector('#previewA').innerHTML = "";
										document.querySelector('#PreviousImagesA').innerHTML = "";
										
										const fr = new FileReader();
										fr.onload = () => {
																const img = document.createElement("img");
																img.src = fr.result;  // String Base64 
																img.alt = file.name;
																document.querySelector('#previewA').append(img);
															};
														fr.readAsDataURL(file);
													};

			document.querySelector("#txtThumbnailImage").addEventListener("change", (ev) => {
				if (!ev.target.files) return; // Do nothing.
					[...ev.target.files].forEach(preview);
				});
		</script>
		
			<script>
				const previewOne = (file) => {
											document.querySelector('#previewB').innerHTML = "";
											document.querySelector('#PreviousImagesB').innerHTML = "";
											
											const fr = new FileReader();
											fr.onload = () => {
																	const img = document.createElement("img");
																	img.src = fr.result;  // String Base64 
																	img.alt = file.name;
																	document.querySelector('#previewB').append(img);
																};
															fr.readAsDataURL(file);
														};

				document.querySelector("#txtBannerImage").addEventListener("change", (ev) => {
					if (!ev.target.files) return; // Do nothing.
						[...ev.target.files].forEach(previewOne);
					});
			</script>

		<script>
	
				$("#addblogFrm").submit(function (e) {
					e.preventDefault();
					if(confirm('Are you sure want to blog data?')){
						var bodyFormData = new FormData(this);
						$.ajax({
							url:  '<?php echo $ajaxUrl; ?>',
							type: 'POST',						
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							contentType: false,
							processData: false,
							data: bodyFormData,
							success: function (data) {
								var jsonParse = JSON.parse(data);                            
								if(jsonParse.status=='success'){
									Swal.fire(
										jsonParse.msg,
										'',
										'success'
										);		
										
										location.reload();
									
								}else{
									Swal.fire(
									jsonParse.status,
									'',
									'error'
									);
								}
							}
						});
					}
					
				});
	</script>
		
	</body>
</html>