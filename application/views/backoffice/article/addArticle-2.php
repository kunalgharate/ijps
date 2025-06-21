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
			
			if(isset($articleResult))
			{
				$formHeading    = "Edit Article";
				$buttonName     = "Update";
				$url            = 'article/ArticleController/updateArticle';
			}
			else
			{
				$formHeading    = "Add Article";
				$buttonName     = "Publish";
				$url            = 'article/ArticleController/insertArticle';
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
									<a class="text-muted"> Artical</a>
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
														<input class="form-control" type="hidden" name="txtArticleID" value="<?php
																																if(isset($articleResult))
																																{
																																	echo $articleResult[0]['articleID'];
																																}
																															?>">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
										    <div class="col-lg-4" id="cmbArticalIDSection">
										        <div class="form-group">
													<label>Artical ID
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbArticalID" id="cmbArticalID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($manuscriptResult); $i++)
																	{
																		if($manuscriptResult[$i]['manuscriptID'] == $articleResult[0]['manuscriptID'])
																		{
																			echo "<option value=".$manuscriptResult[$i]['manuscriptID']." selected>IJPS/".$manuscriptResult[$i]['uniqueCode']."</option>";
																		} 
																		else
																		{
																			echo "<option value=".$manuscriptResult[$i]['manuscriptID'].">IJPS/".$manuscriptResult[$i]['uniqueCode']."</option>";
																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="cmbArticalTypeIDSection">
										        <div class="form-group">
													<label>Artical Type
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbArticalTypeID" id="cmbArticalTypeID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($articalTypeResult); $i++)
																	{
																		if($articalTypeResult[$i]['articalTypeID'] == $articleResult[0]['articalTypeID'])
																		{
																			echo "<option value=".$articalTypeResult[$i]['articalTypeID']." selected>".$articalTypeResult[$i]['articalTypeName']."</option>";
																		} 
																		else
																		{
																			echo "<option value=".$articalTypeResult[$i]['articalTypeID'].">".$articalTypeResult[$i]['articalTypeName']."</option>";
																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											
											<!--
											<div class="col-lg-2" id="cmbVolumeIDSection">
										        <div class="form-group">
													<label>Volume
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbVolumeID" id="cmbVolumeID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($volumeResult); $i++)
																	{
																		if($volumeResult[$i]['articalTypeID'] == $articleResult[0]['articalTypeID'])
																		{
																			echo "<option value=".$volumeResult[$i]['volumeID']." selected>".$volumeResult[$i]['volumeName']."</option>";
																		} 
																		else
																		{
																			echo "<option value=".$volumeResult[$i]['volumeID'].">".$volumeResult[$i]['volumeName']."</option>";
																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-2" id="cmbIssueIDSection">
										        <div class="form-group">
													<label>Issue
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbIssueID" id="cmbIssueID" class="form-control form-control-round" required>
																<?php 
																	 for($i = 0; $i < count($issueResult); $i++)
																	{
																		if($issueResult[$i]['issueID'] == $articleResult[0]['articalTypeID'])
																		{
																			echo "<option value=".$issueResult[$i]['issueID']." selected>".$issueResult[$i]['issueName']."</option>";
																		} 
																		else
																		{
																			echo "<option value=".$issueResult[$i]['issueID'].">".$issueResult[$i]['issueName']."</option>";
																		}
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											-->
											<div class="col-lg-4" id="rbtnFeaturedArticleFlagSection">
										        <div class="form-group">
										            <label>is Featured Article ?
													<span class="text-danger">*</span></label>
													<div class="radio-inline">
													    <?php
															if(isset($articleResult))
															{
																if($articleResult[0]['featuredArticleFlag'] == 0)
																{
														?>
														            <label class="radio">
                														<input type="radio" name="rbtnFeaturedArticleFlag" id="rbtnFeaturedArticleFlag-1" value='1'>
                														<span></span>Yes
                													</label>
                													<label class="radio">
                														<input type="radio" checked="checked" name="rbtnFeaturedArticleFlag" id="rbtnFeaturedArticleFlag-0" value='0'>
                														<span></span>No
                													</label>
														<?php
																}
																else
																{
														?>
														               <label class="radio">
                															<input type="radio" checked="checked" name="rbtnFeaturedArticleFlag" id="rbtnFeaturedArticleFlag-1" value='1'>
                															<span></span>Yes
                														</label>
                														<label class="radio">
                															<input type="radio" name="rbtnFeaturedArticleFlag" id="rbtnFeaturedArticleFlag-0" value='0'>
                															<span></span>No
                														</label>
														<?php
																}
															}
															else
                                                            {
                                                        ?>
                                                                <label class="radio">
                														<input type="radio" name="rbtnFeaturedArticleFlag" id="rbtnFeaturedArticleFlag-1" value='1'>
                														<span></span>Yes
                													</label>
                													<label class="radio">
                														<input type="radio" checked="checked" name="rbtnFeaturedArticleFlag" id="rbtnFeaturedArticleFlag-0" value='0'>
                														<span></span>No
                													</label>
                										<?php
                                                            }
														?>
														
													    
													</div>
												</div>
											</div>
											
											
														
														
											<div class="col-lg-12">
												<div class="form-group">
													<label>Paper Title
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtPaperTitle" value="<?php
																															if(isset($articleResult))
																															{
																																echo $articleResult[0]['titleOfPaper'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtAbstractSection">
												<div class="form-group">
													<label>Abstract
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($articleResult))
															{
																$abstract  = $articleResult[0]['abstract'];
															}
															else
															{
																$abstract  ="";
															}
														?>
														<textarea class="form-control" name="txtAbstract" rows="6" required><?php echo $abstract; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Keywords
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtKeywords" value="<?php
																															if(isset($articleResult))
																															{
																																echo $articleResult[0]['keywords'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtAffiliationSection">
												<div class="form-group">
													<label>Affiliation
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($articleResult))
															{
																$affiliation  = $articleResult[0]['affiliation'];
															}
															else
															{
																$affiliation  ="";
															}
														?>
														<textarea class="form-control" name="txtAffiliation" rows="6" required><?php echo $affiliation; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtReferanceSection">
												<div class="form-group">
													<label>Reference
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															if(isset($articleResult))
															{
																$reference  = $articleResult[0]['reference'];
															}
															else
															{
																$reference  ="";
															}
														?>
														<textarea class="form-control" name="txtReferance" rows="6" required><?php echo $reference; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Citation
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtCitation" value="<?php
																															if(isset($articleResult))
																															{
																																echo $articleResult[0]['citation'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>DOI
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtDOI" value="<?php
																															if(isset($articleResult))
																															{
																																echo $articleResult[0]['doi'];
																															}
																														?>" required>
													</div>
												</div>
											</div>
											
											<!--<div class="col-lg-4" id="dtpDateOfReceivedSection">
											    <div class="form-group">
													<label>Received Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															
															$receivedDate = date("d-m-Y");
															
															if(isset($articleResult))
															{
																$receivedDate = strtotime(date($articleResult[0]['receivedDate']));
																$receivedDate = date("d-m-Y", $receivedDate);
															}
														?>
														<input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfReceived" readonly="readonly" placeholder="Select date" name="dtpDateOfReceived‎" value="<?php echo $receivedDate; ?>" required>
													</div>
												</div>
											</div>-->
											<div class="col-lg-4" id="dtpDateOfRecSection">
											    <div class="form-group">
													<label>Received Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															$receivedDate = date("d-m-Y");
															
															if(isset($articleResult))
															{
																$receivedDate = strtotime(date($articleResult[0]['receivedDate']));
																$receivedDate = date("d-m-Y", $receivedDate);
															}
														?>
														<input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfRec" readonly="readonly" placeholder="Select date" name="dtpDateOfRec" value="<?php echo $receivedDate; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOfRevisedSection">
											    <div class="form-group">
													<label>Revised Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															
															$revisedDate = date("d-m-Y");
															
															if(isset($articleResult))
															{
																$revisedDate = strtotime(date($articleResult[0]['revisedDate']));
																$revisedDate = date("d-m-Y", $revisedDate);
															}
														?>
														<input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfRevised" readonly="readonly" placeholder="Select date" name="dtpDateOfRevised" value="<?php echo $revisedDate; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOf‎AcceptedSection">
											    <div class="form-group">
													<label>Accepted Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															
															$acceptedDate = date("d-m-Y");
															
															if(isset($articleResult))
															{
																$acceptedDate = strtotime(date($articleResult[0]['acceptedDate']));
																$acceptedDate = date("d-m-Y", $acceptedDate);
															}
														?>
														<input type="text" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfAccepted" readonly="readonly" placeholder="Select date" name="dtpDateOfAccepted" value="<?php echo $acceptedDate; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="txtThumbnailImageSection">
												<div class="form-group">
													<label>Thumbnail Image
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtThumbnailImage" value="<?php
																															if(isset($articleResult))
																															{
																																echo $articleResult[0]['thumbnailImage'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtThumbnailImage" name="txtThumbnailImage" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
														<div id='PreviousImagesA'>
														<?php
															
															if(isset($articleResult) && $articleResult[0]['thumbnailImage'] != "")
															{																
																echo "<a href='".base_url().UPLOAD_ARTICLE.$articleResult[0]['thumbnailImage']."' target='_BLANK'>
																		<img alt='image' src='".base_url().UPLOAD_ARTICLE.$articleResult[0]['thumbnailImage']."' width='100px'>
																	</a><h6>Previous Image</h6>";
															}
														?>
														</div>
														<div id="previewA"></div>
													</div>
												</div>
											</div>
											<div class="col-lg-6" id="txtDocumentSection">											
												<div class="form-group">
													<label>Document
													<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtDocument" value="<?php
																															if(isset($articleResult))
																															{
																																echo $articleResult[0]['document'];
																															}
																														?>">
														<input type="file" class="fileUpload" id="txtDocument" name="txtDocument" accept="image/jpeg, image/jpg, image/png" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
													</div>
												</div>
											</div>
											<?php
												for($k = 0; $k < 10; $k++)
												{
											?>
											<div class="col-lg-3" id="cmbAuthorIDSection">
										        <div class="form-group">
													<label>Author <?php echo ($k+1); ?>
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbAuthorID<?php echo ($k+1); ?>" id="cmbAuthorID<?php echo ($k+1); ?>" class="form-control form-control-round" required>
															<option value='0' selected>Select Author <?php echo ($k+1); ?></option>
																<?php 
																	 for($i = 0; $i < count($authorResult); $i++)
																	{
																		$index = "authorID".($k+1);

																		if($authorResult[$i]['authorID'] == $articleResult[0][$index])
																		{
																			echo "<option value=".$authorResult[$i]['authorID']." selected>".$authorResult[$i]['name']."</option>";
																		} 
																		else
																		{
																			echo "<option value=".$authorResult[$i]['authorID'].">".$authorResult[$i]['name']."</option>";
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
                CKEDITOR.replace( 'txtReferance' );
        </script>
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
				$('#dtpDateOfRec').datepicker({
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
				$('#dtpDateOfRevised').datepicker({
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
				$('#dtpDateOfAccepted').datepicker({
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