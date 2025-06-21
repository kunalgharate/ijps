	<?php
	$this->load->view(BACKOFFICE . 'layout/header');
	?>
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

		#previewA img {
			max-width: 150px;
		}
	</style>
	<?php
	$this->load->view(BACKOFFICE . 'layout/sidemenu');

	if (isset($manuscriptInfoResult)) {
		$formHeading    = "Change Manuscript Authors Info Article ID";
		$buttonName     = "Update";
		$url            = 'manuscript/ManuscriptController/updateManuscriptInfoArticleID';
	} else {
		$this->session->set_userdata('toastrError', 'Something went wrong!');
		redirect(BACKOFFICE . SHOW_DATA_MANUSCRIPT, 'refresh');
	}
	?>

	<!--Main Content Start-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content" onload="myFunction()">
		<!--page heading start-->

		<?php
		
	
	?>
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
							<form method="post" id="editDetailsFrm" enctype="multipart/form-data">
							<!-- <form method="post" action="<?php echo site_url(BACKOFFICE . $url); ?>" enctype="multipart/form-data" onload="test();"> -->
								<div class="card-body">
								    
								    	<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<label>Article ID
													<span class="text-danger">*</span></label>
												<div class="custom-file">
													<input class="form-control" type="text" name="txtArticleID" value="<?php if (isset($manuscriptInfoResult)) { echo "IJPS/" . $manuscriptInfoResult[0]['articleID'];	} ?>">
												</div>
											</div>
										</div>
									</div>
									<?php 
									
								// 	 
								
									    $srno=1;
										foreach ($manuscriptInfoResult as $key => $value) {		
										    
										    	$result = get_coauthor('ijps_tblmanuscriptcoauthor',$value['manuscriptInfoID']);
										    	foreach($result as $key=>$rowValue){
										    	
										    	
										    	?>
										    	    	<h5 class="text-dark font-weight-bold mb-2">Author <?php echo  $srno++; ?> Details:</h5>
									<div class="row">
										<div class="col-lg-12" style="display:none;">
											<div class="form-group">
												<div class="custom-file">
													<input class="form-control" type="hidden" name="txtManuscriptInfoID[]" value="<?php if (isset($value['manuscriptInfoID'])) { echo $rowValue['manuscriptInfoID'];} ?>">
													<input class="form-control" type="hidden" name="hidtxtManuscriptInfoID[]" value="<?php if (isset($rowValue['manuscriptCoAuthorID'])) { echo $rowValue['manuscriptCoAuthorID'];} ?>">
												</div>
											</div>
										</div>
									</div>
								
									<div class="row">
    									<div class="col-lg-4" id="txtAuthor1NameSection">
    										<div class="form-group">
    											<label>Name	<span class="text-danger">*</span></label>
    											<div class="custom-file">
    												<div class="input-group">
    													<input type="text" name="txtAuthor1Name[]" aria-label="Name" class="form-control col-10" value="<?php echo $rowValue['name'];?>">
    													<!--<input type="text" name="txtAuthor1NameSup" aria-label="Numbers" class="form-control col-2" >-->
    												</div>
    												
    											</div>
    										</div>
    									</div>
								
    									<div class="col-lg-4" id="cmbAuthor1EmailSection">
    										<div class="form-group">
    											<label>Email
    												<span class="text-danger">*</span></label>
    											<div class="custom-file">
    											<input class="form-control" type="email" name="txtAuthor1Email[]" value="<?php echo $rowValue['email'];?>" >
    											</div>
    										</div>
    									</div>

									</div>
									
									<div class="row">
    									<div class="col-lg-3" id="txtAuthor1PhotoSection">
    										<div class="form-group">
    											<label>Photo
    												<span class="text-danger">*</span></label>
    											<div><img id="imagePreview<?php echo $rowValue['manuscriptCoAuthorID']; ?>" src="<?php echo base_url('assetsbackoffice/uploads/author/').$rowValue['coAuthorPhoto']; ?>" style="height:102px;" ></div>
    											<div class="custom-file">
    												<input class="form-control" type="hidden" name="hiddentxtAuthor1Photo[]" value="<?php echo  $rowValue['coAuthorPhoto'];?>">
    												<input type="file" class="fileUpload" id="txtAuthor1Photo" name="txtAuthor1Photo[]" accept="image/jpeg, image/jpg, image/png" onchange="document.getElementById('imagePreview<?php echo $rowValue['manuscriptCoAuthorID']; ?>').src = window.URL.createObjectURL(this.files[0])" />
    												<span class="form-text text-muted mb-5">(Dimensions : 600 X 400)</span>
    											</div>
    										</div>
    									</div>
    									<div class="col-lg-9" id="cmbAuthor1AffiliationSection">
    										<div class="form-group">
    											<label>Affiliation
    												<span class="text-danger">*</span></label>
    											<div class="custom-file">
    												<input class="form-control" type="text" name="txtAuthor1Affiliation[]" value="<?php echo $rowValue['affiliation'];?>" >
    											</div>
    										</div>
    									</div>
									</div>
										    <?php 	}
										?>
										
										

									
							
									
									<?php }  ?>
									
									</div>

									<div class="card-footer" id="buttonSubmit">
										<input type="submit" class="btn btn-primary mr-2" value="<?php echo $buttonName; ?>">
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
	$ajaxUrl =  site_url(BACKOFFICE . $url);
	?>


	<script>
		$("#editDetailsFrm").submit(function (e) {   
			    
				e.preventDefault();
			
				     Swal.fire({
              title: "Are you sure want to update data?",
              icon: 'warning',
              showCancelButton: true,
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

		// document.querySelector("#txtThumbnailImage").addEventListener("change", (ev) => {
		// 	if (!ev.target.files) return; // Do nothing.
		// 	[...ev.target.files].forEach(preview);
		// });


		
	</script>

	</body>

	</html>