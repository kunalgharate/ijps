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
			
			if(isset($manuscriptResult))
			{
				$formHeading    = "Change Manuscript Status";
				$buttonName     = "Update";
				$url            = 'manuscript/ManuscriptController/updateManuscript';
			}
			else
			{
				$this->session->set_userdata('toastrError', 'Something went wrong!');
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPT, 'refresh');
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
									<a class="text-muted"> Manuscript</a>
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
						<div class="col-md-3"></div>
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
														<input class="form-control" type="hidden" name="txtManuscriptID" value="<?php
																																if(isset($manuscriptResult))
																																{
																																	echo $manuscriptResult[0]['manuscriptID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<label>Title
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtTitle" value="<?php
																															if(isset($manuscriptResult))
																															{
																																echo $manuscriptResult[0]['titleOfPaper'];
																															}
																														?>" readonly>
													</div>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Article ID
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtTitle" value="<?php
																															if(isset($manuscriptResult))
																															{
																																echo "IJPS".$manuscriptResult[0]['uniqueCode'];
																															}
																														?>" readonly>
													</div>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Article Type
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtArticleTypeName" value="<?php
																															if(isset($manuscriptResult))
																															{
																																echo $manuscriptResult[0]['articalTypeName'];
																															}
																														?>" readonly>
													</div>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Country
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtArticleTypeName" value="<?php
																															if(isset($manuscriptResult))
																															{
																																echo $manuscriptResult[0]['countryName'];
																															}
																														?>" readonly>
													</div>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Approved
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtApproved" value="<?php
																															if(isset($manuscriptResult))
																															{
																																if($manuscriptResult[0]['approvedFlag'] == 0)
																																{
																																	echo "NO";
																																}
																																else
																																{
																																	echo "YES";
																																}
																															}
																														?>" readonly>
													</div>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Author Name
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtManuscriptURL" value="<?php
																															if(isset($manuscriptResult))
																															{
																																echo $manuscriptResult[0]['name'];
																															}
																														?>" readonly>
													</div>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Author Email
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtManuscriptURL" value="<?php
																															if(isset($manuscriptResult))
																															{
																																echo $manuscriptResult[0]['email'];
																															}
																														?>" readonly>
													</div>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Author Contact Number
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtManuscriptURL" value="<?php
																															if(isset($manuscriptResult))
																															{
																																echo $manuscriptResult[0]['contactNumber'];
																															}
																														?>" readonly>
													</div>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="form-group">
													<label>Current Status
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtArticleTypeName" value="<?php
																															if(isset($manuscriptResult))
																															{
																																echo $manuscriptResult[0]['statusName'];
																															}
																														?>" readonly>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="cmbStatusIDSection">
												<hr>
										        <div class="form-group">
													<label>Status
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbStatusID" id="cmbStatusID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($statusResult); $i++)
																	{
																		if($statusResult[$i]['statusID'] == $manuscriptResult[0]['statusID'])
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
										</div>
									<div class="card-footer" id="buttonSubmit">
										<button type="submit" class="btn btn-primary mr-2"><?php echo $buttonName; ?></button>
										<!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
									</div>
								</form>
							</div>
						</div>
					</div>
						<div class="col-md-3"></div>
				</div>
			</div>
		</div>
		
		<!--Main Content End-->
		
		<?php 
			$this->load->view(BACKOFFICE.'layout/footer');
			$this->load->view(BACKOFFICE.'layout/jsfiles');
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
		
	</body>
</html>