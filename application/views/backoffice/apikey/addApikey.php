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
			</style>
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			

			// print_r($newsletterResult); die;
			if(isset($newsletterResult))


			{
				$formHeading    = "Edit API key";
				$buttonName     = "Update";
				$url            = 'apikey/ApiKeyController/updateNewsletter';
			}
			else
			{
				$formHeading    = "Add API key";
				$buttonName     = "Save";
				$url            = 'apikey/ApiKeyController/insertNewsletter';
			}
		?>
		
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content" onload="myFunction()">
			<!--page heading start-->
			<?php if(isset($newsletterResult)) { ?>
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
									<a class="text-muted"> API Key</a>
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
								<form method="post" id="addNewsletterFrm" enctype="multipart/form-data" onload ="test();">
								<!-- <form method="post" action="<?php //echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data" onload ="test();"> -->
									<div class="card-body">
										<div class="row">
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
													<!-- txtNewsletterID -->
														<input class="form-control" type="hidden" name="apikeyID" value="<?php
																																if(isset($newsletterResult))
																																{
																																	echo $newsletterResult[0]['apikeyID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label>Public key
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="apiPublicKey" value="<?php
																															if(isset($newsletterResult))
																															{
																																echo $newsletterResult[0]['PublicKey'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Secret key
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="apiSecretKey" value="<?php
																															if(isset($newsletterResult))
																															{
																																echo $newsletterResult[0]['SecretKey'];
																															}
																														?>" required>
													</div>
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
				<?php } else { ?>
					<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title"><?php echo $formHeading; ?></h3>
								</div>
								<form method="post" id="addNewsletterFrm" enctype="multipart/form-data" onload ="test();">
								<!-- <form method="post" action="<?php //echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data" onload ="test();"> -->
									<div class="card-body">
										<div class="row">
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtNewsletterID" value="<?php
																																if(isset($newsletterResult))
																																{
																																	echo $newsletterResult[0]['newsletterID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label>Public key
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="apiPublicKey" value="<?php
																															if(isset($newsletterResult))
																															{
																																echo $newsletterResult[0]['title'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Secret key
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="apiSecretKey" value="<?php
																															if(isset($newsletterResult))
																															{
																																echo $newsletterResult[0]['link'];
																															}
																														?>" required>
													</div>
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
    <?php } ?>

		</div>
		
		<!--Main Content End-->
		
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
			
			$("#addNewsletterFrm").submit(function (e) {
			e.preventDefault();
			if(confirm('Are you sure want to add API Key ?')){
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
								$('#addNewsletterFrm').trigger("reset");
								location.reload();	
								window.location.href = '<?php echo base_url("backoffice/apikey"); ?>';
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