		<?php
		$this->load->view(BACKOFFICE . 'layout/header');
		?>

		<script>
			var indexval = 0;
		</script>
		<style>
			.fileUpload {
				width: 100%;
				padding: 0.4rem 1rem;
				overflow: hidden;
				line-height: 1.5;
				color: #3f4254;
				background-color: #fff;
				border: 1px solid #e4e6ef;
				border-radius: .42rem;
			}

			<?php
			for ($i = 0; $i < 25; $i++) {
				echo "#preview" . $i . " img { max-width: 150px; }";
			}
			?>#previewA img {
				max-width: 150px;
			}
		</style>

		<?php
		$this->load->view(BACKOFFICE . 'layout/sidemenu');

		if (isset($articleResult)) {
			$formHeading    = "Edit Article";
			$buttonName     = "Update";
			$url       = 'article/ArticleController/updateArticle';
		} else {
			$formHeading    = "Add Article";
			$buttonName     = "Publish";
			$url            = 'article/ArticleController/insertArticle';
		}
		$saveThumb = 'article/ArticleController/saveThumb';

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
									<a href="<?php echo site_url(BACKOFFICE . 'dashboard'); ?>" class="text-muted">Dashboard</a>
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


								<form method="post" id="editArticalFrm" enctype="multipart/form-data" onload="test();">
									<!-- <form method="post" action="<?php //echo site_url(BACKOFFICE.$url); 
																		?>" enctype="multipart/form-data" onload ="test();"> -->
									<div class="card-body">
										<div class="row">
											<div class="col-lg-12" style="display:none;">
												<div class="form-group">
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtArticleID" value="<?php if (isset($articleResult)) {
																																	echo $articleResult[0]['articleID'];
																																} ?>">
														<input class="form-control" type="hidden" name="txtUniqueCode" value="<?php
																																if (isset($loadData)) {
																																	echo $loadData[0]['uniqueCode'];
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
															$flag101 = 0;
															for ($i = 0; $i < count($manuscriptResult); $i++) {
																if (isset($loadData)) {
																	if ($manuscriptResult[$i]['manuscriptID'] == $loadData[0]['manuscriptID']) {
																		echo "<option value=" . $manuscriptResult[$i]['manuscriptID'] . " selected>IJPS/" . $manuscriptResult[$i]['uniqueCode'] . "</option>";
																	}
																} else if (isset($articleResult)) {
																	if ($manuscriptResult[$i]['manuscriptID'] == $articleResult[0]['manuscriptID']) {
																		echo "<option value=" . $manuscriptResult[$i]['manuscriptID'] . " selected>IJPS/" . $manuscriptResult[$i]['uniqueCode'] . "</option>";
																	} else {
																		if ($flag101 == 0) {
																			$flag101 = 1;
																			echo "<option value='" . $articleResult[0]['manuscriptID'] . "' selected>IJPS/" . $articleResult[0]['articleIDUniqueCode'] . "</option>";
																		}
																	}
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
															for ($i = 0; $i < count($articalTypeResult); $i++) {
																if (isset($loadData) && ($articalTypeResult[$i]['articalTypeID'] == $loadData[0]['articalTypeID'])) {
																	//if(($articalTypeResult[$i]['articalTypeID'] == $loadData[0]['articalTypeID']))
																	//{
																	echo "<option value=" . $articalTypeResult[$i]['articalTypeID'] . " selected>" . $articalTypeResult[$i]['articalTypeName'] . "</option>";
																	//} 
																} else if (isset($articleResult) && ($articalTypeResult[$i]['articalTypeID'] == $articleResult[0]['articalTypeID'])) {
																	//if(($articalTypeResult[$i]['articalTypeID'] == $articleResult[0]['articalTypeID']))
																	//{
																	echo "<option value=" . $articalTypeResult[$i]['articalTypeID'] . " selected>" . $articalTypeResult[$i]['articalTypeName'] . "</option>";
																	//} 
																} else {
																	echo "<option value=" . $articalTypeResult[$i]['articalTypeID'] . ">" . $articalTypeResult[$i]['articalTypeName'] . "</option>";
																}

																/*if(($articalTypeResult[$i]['articalTypeID'] == $loadData[0]['articalTypeID']) || ($articalTypeResult[$i]['articalTypeID'] == $articleResult[0]['articalTypeID']))
																		{
																			echo "<option value=".$articalTypeResult[$i]['articalTypeID']." selected>".$articalTypeResult[$i]['articalTypeName']."</option>";
																		} 
																		else
																		{
																			echo "<option value=".$articalTypeResult[$i]['articalTypeID'].">".$articalTypeResult[$i]['articalTypeName']."</option>";
																		}*/
															}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="rbtnFeaturedArticleFlagSection">
												<div class="form-group">
													<label>is Featured Article ?
														<span class="text-danger">*</span></label>
													<div class="radio-inline">
														<?php
														if (isset($articleResult)) {
															if ($articleResult[0]['featuredArticleFlag'] == 0) {
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
															} else {
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
														} else {
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
																															if (isset($loadData)) {
																																echo $loadData[0]['titleOfPaper'];
																															} else if (isset($articleResult)) {
																																echo $articleResult[0]['titleOfPaper'];
																															}
																															?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>URL
														<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" id="text" name="txtPaperTitleOne" value="<?php
																																			if (isset($loadData)) {
																																				echo isset($loadData[0]['titleOfPaperOne']) ? $loadData[0]['titleOfPaperOne'] : '';
																																			} else if (isset($articleResult)) {
																																				echo $articleResult[0]['titleOfPaperOne'];
																																			}
																																			?>" required>
														<input type="button" onclick="removeSpecialCharacters()" value="Remove" class="btn btn-primary btn-sm mt-2">
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtAbstractSection">
												<div class="form-group">
													<label>Abstract
														<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
														if (isset($articleResult)) {
															$abstract  = $articleResult[0]['abstract'];
														} else {
															$abstract  = "";
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
																															if (isset($articleResult)) {
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
														if (isset($articleResult)) {
															$affiliation  = $articleResult[0]['affiliation'];
														} else {
															$affiliation  = "";
														}
														?>
														<textarea class="form-control" name="txtAffiliation" id="txtAffiliation" rows="6" required><?php echo $affiliation; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtBodySection">
												<div class="form-group">
													<label>Introduction
														<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
														if (isset($articleResult)) {
															$txtBody  = $articleResult[0]['txtBody'];
														} else {
															$txtBody  = "";
														}
														?>
														<textarea class="form-control" name="txtBody" id="txtBody" rows="6" required><?php echo $txtBody; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtReferanceSection">
												<div class="form-group">
													<label>Reference
														<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
														if (isset($articleResult)) {
															$reference  = $articleResult[0]['reference'];
														} else {
															$reference  = "";
														}
														?>
														<textarea class="form-control" name="txtReferance" id="txtReferance" rows="6" required><?php echo $reference; ?></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Citation
														<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtCitation" value="<?php
																															if (isset($articleResult)) {
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
																														if (isset($articleResult)) {
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

														$receivedDate = date("Y-m-d");

														if (isset($articleResult)) {
															$receivedDate = strtotime(date($articleResult[0]['receivedDate']));
															$receivedDate = date("Y-m-d", $receivedDate);
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
														$receivedDate = date("Y-m-d");

														if (isset($articleResult)) {
															$receivedDate = strtotime(date($articleResult[0]['receivedDate']));
															$receivedDate = date("Y-m-d", $receivedDate);
														} else if (isset($loadData)) {
															$receivedDate = strtotime(date($loadData[0]['createdDate']));
															$receivedDate = date("Y-m-d", $receivedDate);
														}

														?>
														<input type="date" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfRec" placeholder="Select date" name="dtpDateOfRec" value="<?php echo $receivedDate; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-1" id="rbtnRevisedFlagSection">
												<div class="form-group">
													<label>Revised
														<!--<span class="text-danger">*</span>--></label>
													<div class="radio-inline">
														<?php
														$checked = "";

														if (isset($articleResult)) {
															if ($articleResult[0]['revisedFlag'] == 1) {
																$checked = "checked='checked'";
															} else {
																$checked = "";
															}
														}
														?>
														<label class="checkbox">
															<input type="checkbox" <?php echo $checked; ?> name="chkRevisedFlag" id="chkRevisedFlag" />
															<span></span>
															&nbsp;&nbsp; Yes
														</label>
													</div>
												</div>
											</div>

											<div class="col-lg-3">
												<div class="form-group" id="dtpDateOfRevisedSection">
													<label>Revised Date (DD-MM-YYYY)
														<!--<span class="text-danger">*</span>--></label>
													<div class="custom-file">
														<?php

														$revisedDate = date("Y-m-d");

														if (isset($articleResult)) {
															$revisedDate = strtotime(date($articleResult[0]['revisedDate']));
															$revisedDate = date("Y-m-d", $revisedDate);
														}
														?>
														<input type="date" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfRevised" placeholder="Select date" name="dtpDateOfRevised" value="<?php echo $revisedDate; ?>"><!--required-->
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOfAcceptedSection">
												<div class="form-group">
													<label>Accepted Date (DD-MM-YYYY)
														<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
														if (isset($loadData)) {

															$acceptedDate = getAccepted($loadData[0]['uniqueCode']);

															if (!empty($acceptedDate)) {
																$acceptedDate = $acceptedDate[0]['created_data'];
															} else {
																$acceptedDate = date("d-m-Y");
															}
														} else {
															$acceptedDate = date("d-m-Y");
														}
														?>
														<input type="date" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfAccepted" placeholder="Select date" name="dtpDateOfAccepted" value="<?php echo date('Y-m-d', strtotime($acceptedDate)) ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOfPublicationSection">
												<div class="form-group">
													<label>Publication Date (DD-MM-YYYY)
														<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php

														$publicationDate = date("Y-m-d");

														if (isset($articleResult)) {
															$publicationDate = strtotime(date($articleResult[0]['createdDate']));
															//$publicationDate = date("Y-m-d", $publicationDate);
															$publicationDate = date('Y-m-d', $publicationDate);
														}
														?>
														<input type="date" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfPublication" placeholder="Select date" name="dtpDateOfPublication" value="<?php echo $publicationDate; ?>" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="txtThumbnailImageSection">
												<div class="form-group">
													<label>Thumbnail Image
														<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="hidden" id="thumbNailImgUrl" name="txtThumbnailImage" value="<?php
																																						if (isset($articleResult)) {
																																							echo base_url() . UPLOAD_ARTICLE . $articleResult[0]['thumbnailImage'];
																																						}
																																						?>">
														<!--<input type="file" class="fileUpload" id="txtThumbnailImage" name="txtThumbnailImage" accept="image/jpeg, image/jpg, image/png" />-->
														<!--<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>-->
														<img src="" id="thumbnailImage" style=" width: 135px;" />
														<!--<div id='PreviousImagesA'>-->
														<?php

														if (isset($articleResult) && $articleResult[0]['thumbnailImage'] != "") {
															echo "<a href='" . base_url() . UPLOAD_ARTICLE . $articleResult[0]['thumbnailImage'] . "' target='_BLANK'>
																		<img alt='image' src='" . base_url() . UPLOAD_ARTICLE . $articleResult[0]['thumbnailImage'] . "' width='100px'>
																	</a><h6>Previous Image</h6>";
														}
														?>
														<!--</div>-->
														<div id="previewA1"></div>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="txtDocumentSection">
												<div class="form-group">
													<label>Document
														<span class="text-danger">*</span></label>
													<div></div>
													<div class="custom-file">
														<input class="form-control" type="hidden" name="txtDocument" value="<?php
																															if (isset($articleResult)) {
																																echo $articleResult[0]['document'];
																															}
																															?>">
														<input type="file" class="fileUpload" id="txtDocument" name="txtDocument" accept="image/jpeg, image/jpg, image/png, application/pdf" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
													</div>
												</div>
											</div>
											<!-- Replace the problematic Author 1 Details section around line 581 with this fixed version -->

											<div class="col-lg-12" id="author1Section">
												<h5 class="text-dark font-weight-bold mb-2">Author 1 Details:</h5>
												<?php
												// Fixed: Check if articleResult exists and has authorInfo before accessing it
												$authorID = '';
												if (isset($articleResult) && isset($articleResult['authorInfo'][0]['articalAuthorID'])) {
													$authorID = $articleResult['authorInfo'][0]['articalAuthorID'];
												}
												?>
												<input type="hidden" name="txt_article_author_id" id="txt_article_author_id" value="<?php echo $authorID; ?>">
												<hr class="my-5">
												<div class="row">
													<div class="col-lg-4" id="txtAuthor1NameSection">
														<div class="form-group">
															<label>Name
																<span class="text-danger">*</span></label>
															<div class="custom-file">
																<div class="input-group">
																	<input type="text" name="txtAuthor1Name" aria-label="Name" class="form-control col-10" value="<?php
																																									if (isset($loadData['info'][0])) {
																																										echo $loadData['info'][0]['authorName'];
																																									} else if (isset($articleResult['authorInfo'][0])) {
																																										echo $articleResult['authorInfo'][0]['name'];
																																									}
																																									?>" required>
																	<input type="text" name="txtAuthor1NameSup" aria-label="Numbers" class="form-control col-2" value="<?php
																																										if (isset($loadData['info'][0])) {
																																											echo $loadData['info'][0]['superscript_number'];
																																										} elseif (isset($articleResult) && isset($articleResult['authorInfo'][0])) {
																																											echo $articleResult['authorInfo'][0]['superscript_number'];
																																										}
																																										?>">
																</div>

																<input class="form-control" type="hidden" name="txtArticalAuthor1ID" value="<?php
																																			if (isset($articleResult['authorInfo'][0])) {
																																				echo $articleResult['authorInfo'][0]['articalAuthorID'];
																																			}
																																			?>">
															</div>
														</div>
													</div>
													<div class="col-lg-4" id="cmbDesignationID1Section">
														<div class="form-group">
															<label>Designation
																<span class="text-danger">*</span></label>
															<div class="custom-file">
																<select name="cmbDesignationID1" id="cmbDesignationID1" class="form-control form-control-round" required>
																	<?php
																	for ($i = 0; $i < count($designationResult); $i++) {
																		if (isset($loadData)) {
																			$id = 1;
																		} else if (isset($articleResult) && isset($articleResult['authorInfo'][0])) {
																			$id = $articleResult['authorInfo'][0]['designationID'];
																		} else {
																			$id = 1; // Default value
																		}

																		if ($designationResult[$i]['designationID'] == $id) {
																			echo "<option value=" . $designationResult[$i]['designationID'] . " selected>" . $designationResult[$i]['designationName'] . "</option>";
																		} else {
																			echo "<option value=" . $designationResult[$i]['designationID'] . ">" . $designationResult[$i]['designationName'] . "</option>";
																		}
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-4" id="cmbAuthor1EmailSection">
														<div class="form-group">
															<label>Email
																<span class="text-danger">*</span></label>
															<div class="custom-file">
																<input class="form-control" type="email" name="txtAuthor1Email" value="<?php
																																		if (isset($loadData['info'][0])) {
																																			echo $loadData['info'][0]['authorEmail'];
																																		} else if (isset($articleResult) && isset($articleResult['authorInfo'][0])) {
																																			echo $articleResult['authorInfo'][0]['email'];
																																		}
																																		?>" required>
															</div>
														</div>
													</div>
													<div class="col-lg-3" id="txtAuthor1PhotoSection">
														<?php
														$photo = '';
														if (isset($loadData['info'][0])) {
															$photo =  base_url('assetsbackoffice/uploads/author/') . $loadData['info'][0]['authorPhoto'];
														} else if (isset($articleResult) && isset($articleResult['authorInfo'][0])) {
															$photo =  base_url('assetsbackoffice/uploads/author/') . $articleResult['authorInfo'][0]['authorPhoto'];
														}
														?>
														<div class="form-group">
															<label>Photo
																<span class="text-danger">*</span></label><br>
															<!-- <div><img id="imagePreview" style="height:102px;" src="<?php echo $photo; ?>" alt=""></div> -->
															<div class="custom-file">
																<input class="form-control" type="hidden" name="txtAuthor1Photo" value="<?php
																																		if (isset($loadData['info'][0])) {
																																			echo $loadData['info'][0]['authorPhoto'];
																																		} else if (isset($articleResult) && isset($articleResult['authorInfo'][0])) {
																																			echo $articleResult['authorInfo'][0]['authorPhoto'];
																																		}
																																		?>">
																<input type="file" class="fileUpload" id="txtAuthor1Photo" name="txtAuthor1Photo" accept="image/jpeg, image/jpg, image/png" onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0])" />
																<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
																<div id='PreviousImages'>
																	<?php
																	if (isset($loadData) && isset($loadData['info'][0])) {
																		echo "<a href='" . base_url() . UPLOAD_AUTHORS . $loadData['info'][0]['authorPhoto'] . "' target='_BLANK'>
                                <img alt='image' src='" . base_url() . UPLOAD_AUTHORS . $loadData['info'][0]['authorPhoto'] . "' width='100px'>
                            </a><h6>Previous Image</h6>";
																	} else if (isset($articleResult) && isset($articleResult['authorInfo'][0])) {
																		echo "<a href='" . base_url() . UPLOAD_AUTHORS . $articleResult['authorInfo'][0]['authorPhoto'] . "' target='_BLANK'>
                                <img alt='image' src='" . base_url() . UPLOAD_AUTHORS . $articleResult['authorInfo'][0]['authorPhoto'] . "' width='100px'>
                            </a><h6>Previous Image</h6>";
																	}
																	?>
																</div>
															</div>
														</div>
													</div>
													<div class="col-lg-9" id="cmbAuthor1AffiliationSection">
														<div class="form-group">
															<label>Affiliation
																<span class="text-danger">*</span></label>
															<div class="custom-file">
																<input class="form-control" type="text" name="txtAuthor1Affiliation" value="<?php
																																			if (isset($loadData['info'][0])) {
																																				echo $loadData['info'][0]['authorAffiliation'];
																																			} else if (isset($articleResult) && isset($articleResult['authorInfo'][0])) {
																																				echo $articleResult['authorInfo'][0]['affiliation'];
																																			}
																																			?>" required>
															</div>
														</div>
													</div>
												</div>
												<hr class="my-8">
											</div>

											<?php
											if (isset($loadData)) {
												$authorData = $loadData['coAuthorInfo'];
											} else if (isset($articleResult)) {
												$authorData = $articleResult['authorInfo'];
												unset($authorData[0]);
												$authorData = array_values($authorData);
												$articleResult['authorInfo'] = $authorData;
											}
											//echo "<pre>"; print_r($authorData);exit;

											echo "<script> var indexval= " . (count($authorData) + 1) . "; </script>";

											for ($k = 0; $k < count($authorData); $k++) {
											?>
												<div class="col-lg-12" id="author2Section">
													<h5 class="text-dark font-weight-bold mb-2">Author <?php echo ($k + 2); ?> Details:</h5>
													<button class="btn btn-danger float-right" id="DeleteRow" onclick="deletedAdded(this)" type="button"><i class="far fa-trash-alt"></i></button>
													<hr class="my-5">
													<div class="row">
														<div class="col-lg-4" id="txtAuthor<?php echo ($k + 2); ?>NameSection">
															<div class="form-group">
																<label>Name
																</label>
																<div class="custom-file">
																	<div class="input-group">

																		<input type="text" name="txtAuthorName[]" aria-label="Name" class="form-control col-10" value="<?php
																																										if (isset($loadData)) {
																																											echo $loadData['coAuthorInfo'][$k]['name'];
																																										} else if (isset($articleResult)) {
																																											echo $articleResult['authorInfo'][$k]['name'];
																																										}
																																										?>" required>
																		<input type="text" name="txtAuthorNameSup[]" aria-label="Numbers" class="form-control col-2" value="<?php
																																											if (isset($articleResult)) {
																																												echo $articleResult['authorInfo'][$k]['superscript_number'];
																																											}
																																											?>">
																	</div>

																	<input class="form-control" type="hidden" name="txtArticalAuthorID[]" value="<?php
																																					if (isset($articleResult)) {
																																						echo $articleResult['authorInfo'][$k]['articalAuthorID'];
																																					}
																																					?>">
																</div>
															</div>
														</div>
														<div class="col-lg-4" id="cmbDesignationID<?php echo ($k + 2); ?>Section">
															<div class="form-group">
																<label>Designation
																</label>
																<div class="custom-file">
																	<select name="cmbDesignationID[]" id="cmbDesignationID[]" class="form-control form-control-round">
																		<?php
																		if (isset($loadData)) {
																			$id = 2;
																		} else if (isset($articleResult)) {
																			$id = $articleResult['authorInfo'][$k]['designationID'];
																		}

																		for ($i = 0; $i < count($designationResult); $i++) {
																			if ($designationResult[$i]['designationID'] == $id) {
																				echo "<option value=" . $designationResult[$i]['designationID'] . " selected>" . $designationResult[$i]['designationName'] . "</option>";
																			} else {
																				echo "<option value=" . $designationResult[$i]['designationID'] . ">" . $designationResult[$i]['designationName'] . "</option>";
																			}
																		}
																		?>
																	</select>
																</div>
															</div>
														</div>
														<div class="col-lg-4" id="cmbAuthor<?php echo ($k + 2); ?>EmailSection">
															<div class="form-group">
																<label>Email
																	<span class="text-danger">*</span></label>
																<div class="custom-file">
																	<input class="form-control" type="email" name="txtAuthoEmail[]" value="<?php
																																			if (isset($loadData)) {
																																				echo $loadData['coAuthorInfo'][$k]['email'];
																																			} else if (isset($articleResult)) {
																																				echo $articleResult['authorInfo'][$k]['email'];
																																			}
																																			?>">
																</div>
															</div>
														</div>
														<div class="col-lg-3" id="txtAuthor<?php echo ($k + 2); ?>PhotoSection">
															<div class="form-group">
																<label>Photo
																</label>
																<div></div>
																<div class="custom-file">
																	<input class="form-control" type="hidden" name="txtAuthorPhoto[]" value="<?php
																																				if (isset($loadData)) {
																																					echo $loadData['coAuthorInfo'][$k]['coAuthorPhoto'];
																																				} else if (isset($articleResult)) {
																																					echo $articleResult['authorInfo'][$k]['authorPhoto'];
																																				}
																																				?>">
																	<input type="file" class="fileUpload" id="txtAuthorPhoto[]" name="txtAuthorPhoto[]" accept="image/jpeg, image/jpg, image/png" />
																	<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
																	<div id='PreviousImages<?php echo $k; ?>'>

																		<?php
																		if (isset($loadData)) {
																			//echo $loadData['coAuthorInfo'][$k]['coAuthorPhoto'];
																			echo "<a href='" . base_url() . UPLOAD_AUTHORS . $loadData['coAuthorInfo'][$k]['coAuthorPhoto'] . "' target='_BLANK'>
                																		<img alt='image' src='" . base_url() . UPLOAD_AUTHORS . $loadData['coAuthorInfo'][$k]['coAuthorPhoto'] . "' width='100px'>
                																	</a><h6>Previous Image</h6>";
																		} else if (isset($articleResult)) {
																			//echo $articleResult['authorInfo'][$k]['authorPhoto'];
																			echo "<a href='" . base_url() . UPLOAD_AUTHORS . $articleResult['authorInfo'][$k]['authorPhoto'] . "' target='_BLANK'>
                																		<img alt='image' src='" . base_url() . UPLOAD_AUTHORS . $articleResult['authorInfo'][$k]['authorPhoto'] . "' width='100px'>
                																	</a><h6>Previous Image</h6>";
																		}
																		?>

																	</div>
																	<div id="preview<?php echo $k; ?>"></div>
																</div>
															</div>
														</div>
														<div class="col-lg-9" id="cmbAuthor<?php echo ($k + 2); ?>AffiliationSection">
															<div class="form-group">
																<label>Affiliation
																</label>
																<div class="custom-file">
																	<input class="form-control" type="text" name="txtAuthorAffiliation[]" value="<?php
																																					if (isset($loadData)) {
																																						echo $loadData['coAuthorInfo'][$k]['affiliation'];
																																					} else if (isset($articleResult)) {
																																						echo $articleResult['authorInfo'][$k]['affiliation'];
																																					}
																																					?>">
																</div>
															</div>
														</div>
													</div>
													<hr class="my-8">
												</div>
											<?php
											}
											?>

											<div id="newinput"></div>
											<button id="rowAdder" type="button" class="btn btn-cust mt-3">
												<i class='fa fa-plus'></i>Add Author
											</button>
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
		$this->load->view(BACKOFFICE . 'layout/footer');
		$this->load->view(BACKOFFICE . 'layout/jsfiles');
		$ajaxUrl = site_url(BACKOFFICE . $url);
		$saveThumbnail = site_url(BACKOFFICE . $saveThumb);
		$ajaxUrlRemove = site_url(BACKOFFICE . 'article/ArticleController/removeSpecial');

		// $redirectUrl = site_url(BACKOFFICE.'certificate/certificatecontroller');
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			$("#rowAdder").click(function() {
				newRowAdd =
					'<div class="col-lg-12" id="author1Section">' +
					'<h5 class="text-dark font-weight-bold mb-2">Author ' + (indexval = indexval + 1) + ' Details:</h5>' +
					'			<button class="btn btn-danger float-right"' +
					'                id="DeleteRow" onclick="deletedAdded(this)"' +
					'                type="button">' +
					'            <i class="far fa-trash-alt"></i>' +
					'       </button>' +
					'<hr class="my-5">' +
					'<div class="row">' +
					'<div class="col-lg-4" id="txtAuthor' + (indexval) + 'NameSection">' +
					'<div class="form-group">' +
					'<label>Name' +
					'<span class="text-danger">*</span></label>' +
					'<div class="custom-file">' +
					'<div class="input-group"><input type="text" name="txtAuthorName[]" aria-label="Name" class="form-control col-10"  value=""><input type="text" name="txtAuthorNameSup[]" aria-label="Numbers" class="form-control col-2" ></div>' +
					'<input class="form-control" type="hidden" name="txtArticalAuthorID[]]" value="">' +
					'</div>' +
					'</div>' +
					'</div>' +
					'<div class="col-lg-4" id="cmbDesignationID' + (indexval) + 'Section">' +
					'<div class="form-group">' +
					'<label>Designation' +
					'<span class="text-danger">*</span></label>' +
					'<div class="custom-file">' +
					'<select name="cmbDesignationID[]" id="cmbDesignationID[]" class="form-control form-control-round">' +
					'<option value="1">Corresponding author</option>' +
					'<option value="2" selected="">Co-author</option>' +
					'</select>' +
					'</div>' +
					'</div>' +
					'</div>' +
					'<div class="col-lg-4" id="cmbAuthor' + (indexval) + 'EmailSection">' +
					'<div class="form-group">' +
					'<label>Email' +
					'<span class="text-danger">*</span></label>' +
					'<div class="custom-file">' +
					'<input class="form-control" type="email" name="txtAuthoEmail[]]" value="">' +
					'</div>' +
					'</div>' +
					'</div>' +
					'<div class="col-lg-3" id="txtAuthor' + (indexval) + 'PhotoSection">' +
					'<div class="form-group">' +
					'<label>Photo' +
					'<span class="text-danger">*</span></label>' +
					'<div><img id="imagePreview' + indexval + '" style="height:102px;" src="" alt=""></div>' +
					'<div class="custom-file">' +
					'<input type="file" class="fileUpload" id="txtAuthor1Photo" name="txtAuthorPhoto[]" accept="image/jpeg, image/jpg, image/png" onchange="document.getElementById(\'imagePreview' + indexval + '\').src = window.URL.createObjectURL(this.files[0])" />' +
					'<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>' +
					'</div>' +
					'</div>' +
					'</div>' +
					'<div class="col-lg-9" id="cmbAuthor' + (indexval) + 'AffiliationSection">' +
					'<div class="form-group">' +
					'<label>Affiliation' +
					'<span class="text-danger">*</span></label>' +
					'<div class="custom-file">' +
					'<input class="form-control" type="text" name="txtAuthorAffiliation[]" value="">' +
					'</div>' +
					'</div>' +
					'</div>' +
					'</div>' +
					'<hr class="my-8">' +
					'</div>';



				/*
                '<div id="repetedsection">' +
                '    <div class="form-group mt-4">' +
				'		<label for="Paper" class="w-100">' +
				'			<strong>Author '+(indexval = indexval+1)+'</strong>' +
				'			<button class="btn btn-danger float-right"' +
                '                id="DeleteRow"' +
                '                type="button">' +
                '            <i class="far fa-trash-alt"></i>' +
                '       </button>' +
				'			<hr class="mb-0">' +
				'		</label>' +
				'	</div>' +
				'	<div class="form-group">' +
				'		<input type="text" required name="txtCoAuthorName[]" id="txtCoAuthorName[]" class="form-control" data-error="Name of the Co-Author" placeholder="Name of the Co-Author '+indexval+ ' ">' +
				'		<div class="help-block with-errors"></div>' +
				'	</div>' +
    			'	<div class="form-group">' +
    			'		<input type="text" required name="txtCoAuthorAffiliation[]" id="txtCoAuthorAffiliation[]" class="form-control" data-error="Co-Author Affiliation" placeholder="Co-Author '+indexval+' Affiliation" >' +
    			'		<div class="help-block with-errors"></div>' +
    			'	</div>' +
				'	<div class="form-group">' +
				'		<input type="text" required name="txtCoAuthorEmail[]" id="txtCoAuthorEmail[]" class="form-control" data-error="Co-Author Email" placeholder="Co-Author '+indexval+' Email" >' +
				'		<div class="help-block with-errors"></div>' +
				'	</div>' +
				'	<div class="form-group mt-2 py-2">' +
				'		<label for="Paper">' +
				'			Upload Passport Size photo of Co-author ' +indexval+
				'			<span style="color:red">(only jpg, jpeg, png file) </span>' +
				'		</label>' +
				'		<input type="file" name="coauthor[]" class="form-control w-50" id="coauthor[]" accept=".png, .jpg, .jpeg">' +
				'		<div class="help-block with-errors"></div>' +
				'	</div>' +
                '</div>';*/
				/*
                '<div id="repetedsection"> <div class="input-group m-3">' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-danger" id="DeleteRow" type="button">' +
                '<i class="bi bi-trash"></i> Delete</button> </div>' +
                '<div class="form-group mt-2">' +
				'	<label for="Paper">' +
				'		<strong>Co-Author 1</strong>' +
				'		<hr class="mb-0">' +
				'	</label>' +
				'</div>' +
				'<div class="form-group">' +
				'	<input type="text" required name="txtCoAuthorName[]" id="txtCoAuthorName[]" class="form-control" data-error="Name of the Co-Author*" placeholder="Name of the Co-Author*">' +
				'	<div class="help-block with-errors"></div>' +
				'</div>' +
				'<div class="form-group">' +
				'	<input type="text" required name="txtCoAuthorEmail[]" id="txtCoAuthorEmail[]" class="form-control" data-error="Co-Author Email*" placeholder="Co-Author Email*">' +
				'	<div class="help-block with-errors"></div>' +
				'</div>' +
				'<div class="form-group mt-2 py-2">' +
				'	<label for="Paper">' +
				'		Upload Passport Size photo of Co-author 1' +
				'		<span style="color:red">(only pdf file) *</span>' +
				'	</label>' +
				'	<input type="file" name="coauthor[]" class="form-control w-50" id="coauthor[]" accept=".pdf" required>' +
				'	<div class="help-block with-errors"></div>' +
				'</div></div> </div>';
                */

				$('#newinput').append(newRowAdd);
			});

			function deletedAdded(index) {
				$(index).parents("#author1Section").remove();
				$(index).parents("#author2Section").remove();
			}


			// $("#removeSpecial").on('click',function(){
			// 		var txtPaperTitleOne = $("#txtPaperTitleOne").val();
			// 		alert('herer');
			// 		var nesStr = txtPaperTitleOne.replace(/[^a-zA-Z ]/g, "");
			// 		$("#txtPaperTitleOne").val(nesStr);

			// 	})

			function removeSpecialCharacters() {
				var text = document.getElementById("text").value;
				$.ajax({
					type: "POST",
					url: "<?php echo $ajaxUrlRemove; ?>",
					data: {
						text: text
					},
					success: function(response) {
						if (response !== '') {
							$("#text").val(response);
						}
					}
				});
			}
		</script>


		<script>
			// Initialize the CKEditor instance
			function initializeEditor(editorId) {
				var editor = CKEDITOR.replace(editorId, {
					cloudServices_tokenUrl: 'https://www.ijpsjournal.com/backoffice/article/CloudServices/get_token',
					cloudServices_uploadUrl: 'https://www.ijpsjournal.com/uploads/upload-handler.php',
				});

				// Apply image styles when the editor is ready (on edit/fetch data)
				editor.on('instanceReady', function() {
					setTimeout(() => {
						const imgElements = editor.document.find('img');
						imgElements.toArray().forEach(img => {
							img.setAttribute('style', 'max-width: 180px; height: auto; display: block; margin: 5px 0;');
						});
					}, 500);
				});

				// Handle pasted content (images and text)
				editor.on('paste', function(evt) {
					const clipboardHtml = evt.data.dataValue; // Get pasted HTML content
					if (clipboardHtml) {
						const imgTagRegex = /<img[^>]+src=["']([^"']+)["']/g;
						let match;

						while ((match = imgTagRegex.exec(clipboardHtml)) !== null) {
							const imgSrc = match[1];
							if (imgSrc.startsWith('data:image/')) {
								uploadBase64Image(imgSrc, editor, function(serverUrl) {
									evt.data.dataValue = evt.data.dataValue.replace(imgSrc, serverUrl); // Replace Base64 with server URL
								});
							}
						}

						// Resize pasted images
						evt.data.dataValue = evt.data.dataValue.replace(
							/<img /g,
							'<img style="max-width: 180px; height: auto; display: block; margin: 5px 0;" '
						);
					}
				});

				editor.on('fileUploadRequest', function(evt) {
					const fileLoader = evt.data.fileLoader; // Retrieve fileLoader from the event data
					const file = fileLoader.file; // Access the uploaded file

					if (file.type.startsWith('image/') && file.size > 0) {
						const reader = new FileReader();
						reader.onload = function(e) {
							const base64Data = e.target.result.split(',')[1]; // Extract Base64 without prefix
							const formData = new FormData();

							// Ensure file.name exists, fallback if undefined
							const fileName = file.name || 'unnamed_image.png';

							formData.append('upload', base64Data); // Base64 encoded image data
							formData.append('editorId', editor.name); // Pass the editorId
							formData.append('fileName', fileName); // Original file name

							const xhr = new XMLHttpRequest();
							xhr.open('POST', 'https://www.ijpsjournal.com/uploads/upload-handler.php', true);
							xhr.responseType = 'json';

							xhr.onload = function() {
								if (xhr.status === 200) {
									const response = xhr.response;
									if (response.uploaded) {
										// Set the response URL for the fileLoader
										fileLoader.responseData = {
											url: response.url
										};

										// Apply image resizing styles after upload
										setTimeout(() => {
											const imgElements = editor.document.find('img');
											imgElements.toArray().forEach(img => {
												img.setAttribute('style', 'max-width: 180px; height: auto; display: block; margin: 5px 0;');
											});
										}, 500);
									} else {
										fileLoader.message = response.error || 'File upload failed!';
										fileLoader.abort();
									}
								} else {
									fileLoader.message = 'Server error: ' + xhr.status;
									fileLoader.abort();
								}
							};

							xhr.onerror = function() {
								fileLoader.message = 'Upload error!';
								fileLoader.abort();
							};

							xhr.send(formData);
						};

						reader.readAsDataURL(file); // Read the file as DataURL (Base64)
						evt.stop();
					}
				});

				// Helper: Upload Base64 images and replace placeholders
				function uploadBase64Image(base64, editorInstance, callback) {
					const formData = new FormData();
					formData.append('upload', base64.split(',')[1]); // Remove Base64 prefix
					formData.append('fileName', 'pasted_image.png'); // Set a default filename
					formData.append('editorId', editorInstance.name);

					const xhr = new XMLHttpRequest();
					xhr.open('POST', 'https://www.ijpsjournal.com/uploads/upload-handler.php', true);
					xhr.responseType = 'json';

					xhr.onload = function() {
						if (xhr.status === 200) {
							const response = xhr.response;
							if (response.uploaded) {
								callback(response.url); // Pass the server URL back to the editor
							} else {
								console.error('Image upload failed:', response.error || 'Unknown error');
							}
						} else {
							console.error('Server error:', xhr.status);
						}
					};

					xhr.onerror = function() {
						console.error('Network error during upload.');
					};

					xhr.send(formData);
				}
			}

			// Initialize multiple CKEditor instances
			initializeEditor('txtAffiliation');
			initializeEditor('txtBody');
			initializeEditor('txtReferance');
		</script>


		// <script>
			// 		// Initialize the CKEditor instance
			// 		function initializeEditor(editorId) {
			// 		// var editor = CKEDITOR.replace('txtAffiliation', {
			// 			var editor = CKEDITOR.replace(editorId, {

			// 			cloudServices_tokenUrl: 'https://ijpsjournal.com/ijps_journal_demo/backoffice/article/CloudServices/get_token',
			// 			cloudServices_uploadUrl: 'https://ijpsjournal.com/ijps_journal_demo/uploads/upload-handler.php', // Your upload URL
			// 			// filebrowserUploadMethod: 'form'
			// 		});

			// 		// Custom file upload handling
			// 		editor.on('fileUploadRequest', function (evt) {
			// 		var xhr = evt.data.fileLoader.xhr; // The XMLHttpRequest instance
			// 		var fileLoader = evt.data.fileLoader; // CKEditor's fileLoader instance
			// 		var file = fileLoader.file; // The file object

			// 		// Create FormData to send the image file
			// 		var formData = new FormData();
			// 		formData.append('upload', file);
			// 		formData.append('editorId', editorId);

			// 		// Open and send the XMLHttpRequest
			// 		xhr.open('POST', 'https://ijpsjournal.com/ijps_journal_demo/uploads/upload-handler.php', true);
			// 		xhr.responseType = 'json'; // Expect a JSON response
			// 		xhr.onload = function () {
			// 			if (xhr.status === 200) {
			// 				var response = xhr.response;
			// 				if (response.uploaded) {
			// 					// Replace the blob URL with the actual server URL
			// 					fileLoader.responseData = {
			// 						url: response.url, // The URL returned from the server
			// 					};
			// 					alert(response.url);
			// 					// Find the <img> tag and replace its src attribute with the uploaded URL
			// 					const imgElement = editor.document.findOne('img[src^="blob:"]');
			// 					if (imgElement) {
			// 						imgElement.setAttribute('src', response.url);
			// 					}
			// 				} else {
			// 					fileLoader.message = response.error || 'File upload failed!';
			// 					fileLoader.abort();
			// 				}
			// 			} else {
			// 				fileLoader.message = 'Server error: ' + xhr.status;
			// 				fileLoader.abort();
			// 			}
			// 		};

			// 		xhr.onerror = function () {
			// 			fileLoader.message = 'Upload error!';
			// 			fileLoader.abort();
			// 		};

			// 		xhr.send(formData);

			// 		// Prevent default upload behavior
			// 		evt.stop();
			// 		});

			// 		}

			// 		// Initialize multiple CKEditor instances
			// 		initializeEditor('txtAffiliation');
			// 		initializeEditor('txtBody');
			// 		initializeEditor('txtReferance');


			// 	
		</script>
		<script>
			// CKEDITOR.replace( 'txtReferance' );
			// CKEDITOR.replace( 'txtAffiliation' );
			// CKEDITOR.replace( 'txtBody' );
		</script>

		<script>
			/*document.getElementById('dtpDateOfRevisedSection').style.display = 'none';*/

			$('#dtpDateOfRevisedSection').hide();

			$(document).ready(function() {
				$('#chkRevisedFlag').change(function() {
					if (this.checked) {
						$('#dtpDateOfRevisedSection').show();
					} else {
						$('#dtpDateOfRevisedSection').hide();
					}
				});
			});
		</script>
		<script>
			const preview = (file) => {
				document.querySelector('#previewA').innerHTML = "";
				document.querySelector('#PreviousImagesA').innerHTML = "";

				const fr = new FileReader();
				fr.onload = () => {
					const img = document.createElement("img");
					img.src = fr.result; // String Base64 
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
			var KTBootstrapDatepicker = function() {

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
			var KTBootstrapDatepicker = function() {

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
			var KTBootstrapDatepicker = function() {

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
		<script>
			<?php
			for ($i = 0; $i < 25; $i++) {
			?>

				const preview<?php echo $i; ?> = (file) => {
					document.querySelector('#preview<?php echo $i; ?>').innerHTML = "";
					document.querySelector('#PreviousImages<?php echo $i; ?>').innerHTML = "";

					const fr = new FileReader();
					fr.onload = () => {
						const img = document.createElement("img");
						img.src = fr.result; // String Base64 
						img.alt = file.name;
						document.querySelector('#preview<?php echo $i; ?>').append(img);
					};
					fr.readAsDataURL(file);
				};

				document.querySelector("#txtAuthorPhoto[<?php echo $i; ?>]").addEventListener("change", (ev) => {
					if (!ev.target.files) return; // Do nothing.
					[...ev.target.files].forEach(preview);
				});

			<?php
			}
			?>
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
		<!--Js for date picker start-->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/crud/forms/widgets/bootstrap-datepicker7a50.js?v=7.2.7'); ?>"></script>
		<!--Js for date picker end-->
		<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


		<script>
			$(document).ready(function() {
				// Submit form with CKEditor data
				$("#editArticalFrm").submit(function(e) {
					e.preventDefault();

					// Retrieve CKEditor data
					var reference = CKEDITOR.instances.txtReferance.getData();
					var affiliation = CKEDITOR.instances.txtAffiliation.getData();
					var introduction = CKEDITOR.instances.txtBody.getData();

					// Confirm submission
					if (confirm('Are you sure you want to update data?')) {
						var bodyFormData = new FormData(this);
						bodyFormData.append('reference', reference);
						bodyFormData.append('affiliation', affiliation);
						bodyFormData.append('introduction', introduction);

						// AJAX request
						$.ajax({
							url: '<?php echo $ajaxUrl; ?>',
							type: 'POST',
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							contentType: false,
							processData: false,
							data: bodyFormData,
							success: function(data) {
								var jsonResponse = JSON.parse(data);
								if (jsonResponse.status === 'success') {
									Swal.fire(jsonResponse.msg, '', 'success').then(() => {
										var redirectUrl = "<?php echo site_url(BACKOFFICE . 'certificate/CertificateController/index/'); ?>" + jsonResponse.inserted_id;
										window.location.href = redirectUrl;
									});
								} else {
									Swal.fire(jsonResponse.msg, '', 'error');
								}
							},
							error: function() {
								Swal.fire('An error occurred while processing the request.', '', 'error');
							}
						});
					}
				});
			});

			function generateThumbnail(pdfData, imageName) {
				pdfjsLib.getDocument({
					data: pdfData
				}).promise.then(function(pdf) {
					pdf.getPage(1).then(function(page) {
						var viewport = page.getViewport({
							scale: 2
						});
						var canvas = document.createElement("canvas");
						var context = canvas.getContext("2d");

						canvas.height = 695;
						canvas.width = 1220;

						var renderContext = {
							canvasContext: context,
							viewport: viewport
						};
						page.render(renderContext).promise.then(function() {
							var imageDataUrl = canvas.toDataURL("image/png");
							var timestamp = new Date().getTime();
							var newImageName = `thumbnailImage-${timestamp}.png`;

							var xhr = new XMLHttpRequest();
							xhr.open("POST", "<?php echo $saveThumbnail; ?>", true);
							xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							xhr.onreadystatechange = function() {
								if (xhr.readyState === 4 && xhr.status === 200) {
									$("#thumbNailImgUrl").val(xhr.responseText);
									$("#thumbnailImage").attr('src', xhr.responseText);
								}
							};
							xhr.send("imageDataUrl=" + encodeURIComponent(imageDataUrl) + "&imageName=" + encodeURIComponent(newImageName));
						});
					});
				});
			}

			function dataURLToBlob(dataURL) {
				var parts = dataURL.split(';base64,');
				var contentType = parts[0].split(':')[1];
				var raw = window.atob(parts[1]);
				var rawLength = raw.length;
				var uInt8Array = new Uint8Array(rawLength);

				for (var i = 0; i < rawLength; ++i) {
					uInt8Array[i] = raw.charCodeAt(i);
				}

				return new Blob([uInt8Array], {
					type: contentType
				});
			}

			$(document).ready(function() {
				$("#txtDocument").on("change", function(event) {
					var file = event.target.files[0];
					if (file) {
						var reader = new FileReader();
						reader.onload = function(e) {
							var pdfData = new Uint8Array(e.target.result);
							generateThumbnail(pdfData, "");
						};
						reader.readAsArrayBuffer(file);
					}
				});
			});
		</script>

		<!-- <script>
$(document).ready(function () {
    // Submit form with CKEditor data
    $("#editArticalFrm").submit(function (e) {
        e.preventDefault();

        // Retrieve CKEditor data
        var reference = CKEDITOR.instances.txtReferance.getData();
        var affiliation = CKEDITOR.instances.txtAffiliation.getData();
        var introduction = CKEDITOR.instances.txtBody.getData();

        // Confirm submission
        if (confirm('Are you sure you want to update data?')) {
            var bodyFormData = new FormData(this);
            bodyFormData.append('reference', reference);
            bodyFormData.append('affiliation', affiliation);
            bodyFormData.append('introduction', introduction);

            // AJAX request
            $.ajax({
                url: '<?php //echo $ajaxUrl; 
						?>',
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                contentType: false,
                processData: false,
                data: bodyFormData,
                success: function (data) {
                    var jsonResponse = JSON.parse(data);
                    if (jsonResponse.status === 'success') {
                        Swal.fire(jsonResponse.msg, '', 'success').then(() => {
                            var redirectUrl = "<?php //echo site_url(BACKOFFICE . 'certificate/certificatecontroller/index/'); 
												?>" + jsonResponse.inserted_id;
                            window.location.href = redirectUrl;
                        });
                    } else {
                        Swal.fire(jsonResponse.msg, '', 'error');
                    }
                },
                error: function () {
                    Swal.fire('An error occurred while processing the request.', '', 'error');
                }
            });
        }
    });

    // Generate thumbnail for PDF
    $("#txtDocument").on("change", function (event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var pdfData = new Uint8Array(e.target.result);
                generateThumbnail(pdfData);
            };
            reader.readAsArrayBuffer(file);
        }
    });
});

// Function to generate thumbnail from PDF
function generateThumbnail(pdfData) {
    pdfjsLib.getDocument({ data: pdfData }).promise.then(function (pdf) {
        pdf.getPage(1).then(function (page) {
            var viewport = page.getViewport({ scale: 2 });
            var canvas = document.createElement("canvas");
            var context = canvas.getContext("2d");

            canvas.height = 695; 
            canvas.width = 1220;

            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };

            page.render(renderContext).promise.then(function () {
                var imageDataUrl = canvas.toDataURL("image/png");
                uploadThumbnail(imageDataUrl);
            });
        });
    });
}

// Function to upload thumbnail
function uploadThumbnail(imageDataUrl) {
    var timestamp = new Date().getTime();
    var newImageName = `thumbnailImage-${timestamp}.png`;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php //echo $saveThumbnail; 
						?>", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            $("#thumbNailImgUrl").val(xhr.responseText);
            $("#thumbnailImage").attr('src', xhr.responseText);
        }
    };

    xhr.send("imageDataUrl=" + encodeURIComponent(imageDataUrl) + "&imageName=" + encodeURIComponent(newImageName));
}

// Convert data URL to Blob (utility function)
function dataURLToBlob(dataURL) {
    var parts = dataURL.split(';base64,');
    var contentType = parts[0].split(':')[1];
    var raw = atob(parts[1]);
    var rawLength = raw.length;
    var uInt8Array = new Uint8Array(rawLength);

    for (var i = 0; i < rawLength; ++i) {
        uInt8Array[i] = raw.charCodeAt(i);
    }

    return new Blob([uInt8Array], { type: contentType });
}

</script> -->
		</body>

		</html>
