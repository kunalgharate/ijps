		<?php 
		
			$this->load->view(BACKOFFICE.'layout/header');
		?>

			<script> var indexval= 0; </script>
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
				<?php
    	            for($i=0;$i<25;$i++)
    	            {
    	                    echo "#preview".$i." img { max-width: 150px; }";
    	            }
    	        ?>
				#previewA img { max-width: 150px; }
			</style>
			
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');

			$formHeading    = "Add Article";
			$buttonName     = "Publish";
			$url            = 'article/ArticleController/insertArticleDirect';
				$saveThumb = 'article/ArticleController/saveThumb';
				
			$articleID = isset($articleResult[0]['articleID']) ? $articleResult[0]['articleID'] : '';
			$authorName = isset($articleResult['authorInfo'][0]['name']) ? $articleResult['authorInfo'][0]['name'] : '';

			$authorName = isset($loadData['info'][0]['authorName']) ? $loadData['info'][0]['authorName'] : ($authorInfo['name'] ?? '');
			$authorEmail = isset($loadData['info'][0]['authorEmail']) ? $loadData['info'][0]['authorEmail'] : ($authorInfo['email'] ?? '');
			$authorPhoto = isset($loadData['info'][0]['authorPhoto']) ? $loadData['info'][0]['authorPhoto'] : ($authorInfo['authorPhoto'] ?? '');
			$authorAffiliation = isset($loadData['info'][0]['authorAffiliation']) ? $loadData['info'][0]['authorAffiliation'] : ($authorInfo['affiliation'] ?? '');
			$articalAuthorID = $authorInfo['articalAuthorID'] ?? '';
				
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
								<!-- <form method="post" action="<?php echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data" onload ="test();"> -->
								<form method="post" id="publishArticleDirectFrm" enctype="multipart/form-data" onload ="test();">
									<div class="card-body">
										<div class="row">
										    <div class="col-lg-12" style="display:none;">
										        <div class="form-group">
													<div class="custom-file">
													<input class="form-control" type="hidden" name="txtArticleID" value="<?php echo $articleID; ?>">
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
													    <input class="form-control" type="text" name="txtUniqueCode" value="">
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
																	    echo "<option value=".$articalTypeResult[$i]['articalTypeID'].">".$articalTypeResult[$i]['articalTypeName']."</option>";
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
                                                        <label class="radio">
    														<input type="radio" name="rbtnFeaturedArticleFlag" id="rbtnFeaturedArticleFlag-1" value='1'>
    														<span></span>Yes
    													</label>
    													<label class="radio">
    														<input type="radio" checked="checked" name="rbtnFeaturedArticleFlag" id="rbtnFeaturedArticleFlag-0" value='0'>
    														<span></span>No
    													</label>
													</div>
												</div>
											</div>
											
											
														
														
											<div class="col-lg-12">
												<div class="form-group">
													<label>Paper Title
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtPaperTitle" value="" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>URL
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" id="text" name="txtPaperTitleOne" value="" required>
														<input type="button" onclick="removeSpecialCharacters()" value="Remove" class="btn btn-primary btn-sm mt-2">
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtAbstractSection">
												<div class="form-group">
													<label>Abstract
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<textarea class="form-control" name="txtAbstract" rows="6" required></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group">
													<label>Keywords
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtKeywords" value="" required>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtAffiliationSection">
												<div class="form-group">
													<label>Affiliation
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<textarea class="form-control" name="txtAffiliation" rows="6" required></textarea>
													</div>
												</div>
											</div>
												<div class="col-lg-12" id="txtBodySection">
												<div class="form-group">
													<label>Introduction
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<textarea class="form-control" name="txtBody" rows="6" required></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="txtReferanceSection">
												<div class="form-group">
													<label>Reference
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<textarea class="form-control" name="txtReferance" rows="6" required></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>Citation
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtCitation" value="" required>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label>DOI
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<input class="form-control" type="text" name="txtDOI" value="" required>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOfRecSection">
											    <div class="form-group">
													<label>Received Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															$receivedDate = date("Y-m-d");
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
											           ?>
    													<label class="checkbox">
                                                            <input type="checkbox" <?php echo $checked; ?> name="chkRevisedFlag" id="chkRevisedFlag"/> 
                                                            <span></span>
                                                            &nbsp;&nbsp; Yes
                                                        </label>
													</div>
												</div>
											</div>
											
											<div class="col-lg-3">
											    <div class="form-group"  id="dtpDateOfRevisedSection">
													<label>Revised Date (DD-MM-YYYY)
													<!--<span class="text-danger">*</span>--></label>
													<div class="custom-file">
														<?php
															$revisedDate = date("Y-m-d");
														?>
														<input type="date" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfRevised" placeholder="Select date" name="dtpDateOfRevised" value="<?php echo $revisedDate; ?>" ><!--required-->
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpDateOfAcceptedSection">
											    <div class="form-group">
													<label>Accepted Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															$acceptedDate = date("Y-m-d");
														?>
														<input type="date" class="form-control" data-date-format="dd-mm-yyyy" id="dtpDateOfAccepted" placeholder="Select date" name="dtpDateOfAccepted" value="<?php echo $acceptedDate; ?>" required>
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
													    	<input class="form-control" type="hidden" id="thumbNailImgUrl" name="txtThumbnailImage" value="">
														<!--<input type="file" class="fileUpload" id="txtThumbnailImage" name="txtThumbnailImage" accept="image/jpeg, image/jpg, image/png" />-->
														<!--<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>-->
														<img src="" id="thumbnailImage" style=" width: 135px;"/>
														<div id='PreviousImagesA'>
														</div>
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
														<input type="file" class="fileUpload" id="txtDocument" name="txtDocument" accept="image/jpeg, image/jpg, image/png, application/pdf" />
														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="author1Section">
											    <h5 class="text-dark font-weight-bold mb-2">Author 1 Details:</h5>
											    <hr class="my-5">
											    <div class="row">
        											<div class="col-lg-4" id="txtAuthor1NameSection">
        												<div class="form-group">
        													<label>Name
        													<span class="text-danger">*</span></label>
        													<div class="custom-file">
															<div class="input-group">
  
															<input type="text" name="txtAuthor1Name" class="form-control" required value="<?= htmlentities($authorName, ENT_QUOTES, 'UTF-8') ?>">
													<input type="text" name="txtAuthor1NameSup" aria-label="Numbers" class="form-control col-2" required>
													</div>       														
        														
        											<input class="form-control" type="hidden" name="txtArticalAuthor1ID" value="<?= htmlentities($articalAuthorID, ENT_QUOTES, 'UTF-8') ?>">
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
        																	 for($i = 0; $i < count($designationResult); $i++)
        																	{
        																	    if(isset($loadData))
        																		{
        																			$id = 1;
        																		}
        																		else if(isset($articleResult))
        																		{
        																			$id = $articleResult['authorInfo'][$k]['designationID'];
        																		}
        																		else
        																		{
        																		    $id = 1;
        																		}
        																		
        																		if($designationResult[$i]['designationID'] == $id)
        																		{
        																			echo "<option value=".$designationResult[$i]['designationID']." selected>".$designationResult[$i]['designationName']."</option>";
        																		} 
        																		else
        																		{
        																			echo "<option value=".$designationResult[$i]['designationID'].">".$designationResult[$i]['designationName']."</option>";
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
															<input type="text" name="txtAuthor1Email" class="form-control" required value="<?= htmlentities($authorEmail, ENT_QUOTES, 'UTF-8') ?>">
        													</div>
        												</div>
        											</div>
        											<div class="col-lg-3" id="txtAuthor1PhotoSection">											
        												<div class="form-group">
        													<label>Photo
        													<span class="text-danger">*</span></label>
        													<div><img id="imagePreview" style="height:102px;" src="" alt=""></div>
        													<div class="custom-file">
																<input class="form-control" type="hidden" name="txtAuthor1Photo" value="<?= htmlentities($authorPhoto, ENT_QUOTES, 'UTF-8') ?>">
        														<input type="file" class="fileUpload" id="txtAuthor1Photo" name="txtAuthor1Photo" accept="image/jpeg, image/jpg, image/png" onchange="document.getElementById('imagePreview').src = window.URL.createObjectURL(this.files[0])" />
        														<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
        													</div>
        												</div>
        											</div>
        											<div class="col-lg-9" id="cmbAuthor1AffiliationSection">
        												<div class="form-group">
        													<label>Affiliation
        													<span class="text-danger">*</span></label>
        													<div class="custom-file">
															<input type="text" name="txtAuthor1Affiliation" class="form-control" required value="<?= htmlentities($authorAffiliation, ENT_QUOTES, 'UTF-8') ?>">
        													</div>
        												</div>
        											</div>
											    </div>
											    <hr class="my-8">
											</div>
											<div id="newinput"></div>
											<button id="rowAdder" type="button" class="btn btn-cust mt-3">
                                                <i class='fa fa-plus'></i>Add Author
                                            </button>
										</div>
									<div class="card-footer" id="buttonSubmit">
										<button type="submit" class="btn btn-primary mr-2"><?php echo $buttonName; ?></button>
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
			$ajaxUrl = site_url(BACKOFFICE.$url); 
			$saveThumbnail = site_url(BACKOFFICE.$saveThumb);
			$ajaxUrlRemove = site_url(BACKOFFICE.'article/ArticleController/removeSpecial');
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			var indexval=1;
        $("#rowAdder").click(function () {
			
            newRowAdd =
                '<div class="col-lg-12" id="author1Section">' +
				    '<h5 class="text-dark font-weight-bold mb-2">Author '+(indexval = indexval+1)+' Details:</h5>' +
				    '			<button class="btn btn-danger float-right"' +
                '                id="DeleteRow" onclick="deletedAdded(this)"' +
                '                type="button">' +
                '            <i class="far fa-trash-alt"></i>' +
                '       </button>' +
				    '<hr class="my-5">' +
				    '<div class="row">' +
						'<div class="col-lg-4" id="txtAuthor'+(indexval)+'NameSection">' +
							'<div class="form-group">' +
								'<label>Name' +
								'<span class="text-danger">*</span></label>' +
								'<div class="custom-file">' +
									'<div class="input-group"><input type="text" name="txtAuthorName[]" aria-label="Name" class="form-control col-10"  value=""><input type="text" name="txtAuthorNameSup[]" aria-label="Numbers" class="form-control col-2" ></div>' +
									'<input class="form-control" type="hidden" name="txtArticalAuthorID[]" value="">' +
								'</div>' +
							'</div>' +
						'</div>' +
						'<div class="col-lg-4" id="cmbDesignationID'+(indexval)+'Section">' +
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
						'<div class="col-lg-4" id="cmbAuthor'+(indexval)+'EmailSection">' +
							'<div class="form-group">' +
								'<label>Email' +
								'<span class="text-danger">*</span></label>' +
								'<div class="custom-file">' + 
									'<input class="form-control" type="email" name="txtAuthoEmail[]" value="">' +
								'</div>' +
							'</div>' +
						'</div>' +
						'<div class="col-lg-3" id="txtAuthor'+(indexval)+'PhotoSection">' +
							'<div class="form-group">' +
								'<label>Photo' +
								'<span class="text-danger">*</span></label>' +
								'<div><img id="imagePreview'+indexval+'" style="height:102px;" src="" alt=""></div>' +
								'<div class="custom-file">' +
									'<input type="file" class="fileUpload" id="txtAuthor1Photo" name="txtAuthorPhoto[]" accept="image/jpeg, image/jpg, image/png" onchange="document.getElementById(\'imagePreview' + indexval + '\').src = window.URL.createObjectURL(this.files[0])" />' +
									'<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>' +
								'</div>' +
							'</div>' +
						'</div>' +
						'<div class="col-lg-9" id="cmbAuthor'+(indexval)+'AffiliationSection">' +
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
       
		function deletedAdded(index){			
			$(index).parents("#author1Section").remove();
		}

		
		
    </script>
		
		<script>
                CKEDITOR.replace( 'txtReferance' );
                CKEDITOR.replace( 'txtAffiliation' );
                CKEDITOR.replace( 'txtBody' );
                
                
        </script>
        
			<script>
			
				
	function removeSpecialCharacters() {
            var text = document.getElementById("text").value;
            $.ajax({
                type: "POST",
                url: "<?php echo $ajaxUrlRemove; ?>",
                data: { text: text },
                success: function(response) {
                    if(response!==''){
                        $("#text").val(response);
                    }
                }
            });
        }
		
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
	            for($i=0;$i<25;$i++)
	            {
	        ?>
	        
        			const preview<?php echo $i; ?> = (file) => {
        										document.querySelector('#preview<?php echo $i; ?>').innerHTML = "";
        										document.querySelector('#PreviousImages<?php echo $i; ?>').innerHTML = "";
        										
        										const fr = new FileReader();
        										fr.onload = () => {
        																const img = document.createElement("img");
        																img.src = fr.result;  // String Base64 
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
		<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script> -->
<!-- <script  src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
	
<script>
	$("#publishArticleDirectFrm").submit(function (e) {
			e.preventDefault();
			 Swal.fire({
              title: 'Are you sure want to publish data?',
              confirmButtonText: "Ok",
               showConfirmButton: true,
              allowOutsideClick: false,
              allowEscapeKey: false
              
            }).then((result) => {
             
              if (result.isConfirmed) {
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
							jsonParse.msg,
							'',
							'error'
							);
						}
					}
				});
              } 
            });
			
				
		
			
		});
		
		function generateThumbnail(pdfData, imageName) {
  pdfjsLib.getDocument({ data: pdfData }).promise.then(function (pdf) {
    pdf.getPage(1).then(function (page) {
      var viewport = page.getViewport({ scale: 2 }); 
      var canvas = document.createElement("canvas");
      var context = canvas.getContext("2d");

      canvas.height = 695; // Adjusting for desired height
      canvas.width = 1220; // Adjusting for desired width

      var renderContext = {
        canvasContext: context,
        viewport: viewport
      };
      page.render(renderContext).promise.then(function () {
        var imageDataUrl = canvas.toDataURL("image/png"); 
        var timestamp = new Date().getTime(); // Unique timestamp for each upload
        var newImageName = `thumbnailImage-${timestamp}.png`; // Unique image name

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo $saveThumbnail; ?>", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
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

  return new Blob([uInt8Array], { type: contentType });
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
</body>
</html>
