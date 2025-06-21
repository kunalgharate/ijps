		<?php
			$this->load->view('layout/header');
		?>
		<!-- Event snippet for Submit manuscripts conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
<script>
function gtag_report_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-11164792134/1-T5CNzT6IUZEMbq5Msp',
      'event_callback': callback
  });
  return false;
}
</script>


			<title>Publish Research Papers in UGC Approved & Scopus Indexed Journals | IJPS Pharmacy Journal</title>
			<meta name="description" content="Submit your manuscript to IJPS, a leading UGC approved and Scopusindexed pharmacy / medical journal. Fast-track research paper publication in trusted journals."/>
			<meta name="keywords" content="submit manuscript, Research Paper Publication Journal, UGC Approved Journal, Scopus Indexed journal, Web of science indexed journal,  IJPS Journal, Pharmacy Journal, Publish research paper, research submissions, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/submit-manuscript">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Submit Manuscript | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/submit-manuscript">
			<meta property="og:description" content="UGC-CARE (India) recommends publishing papers in either peer reviewed journals (refereed journals), or in the journals approved by UGC-CARE, or journals indexed in Scopus or Web of Science. IJPS is a peer reviewed journal (refereed journals) and therefore fitting within UGC's recommendations.">
			<meta property="og:image" content="https://www.ijpsjournal.com/assets/public/Front/assets/images/logoup.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@int_j_pharm_sci">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="An open access peer-reviewed journal aiming to communicate high quality original research work that contribute scientific knowledge related to the field of Pharmaceutical Sciences.">
			<meta name="twitter:image" content="<?php echo base_url('assets/public/Front/assets/images/logoup.jpg'); ?>">
			
		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		<style>

			.select2-container .select2-selection--single {
				width: 100%;
				height: 62px;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 10px;
				box-sizing: border-box;
			}
			.select2-container--default .select2-selection--single .select2-selection__arrow {
				height: 26px;
				position: absolute;
				top: 23px;
				right: 5px;
				width: 20px;
			}  

			.modal-confirm {
				color: #636363;
				width: 325px;
				font-size: 14px;
			}

			.modal-confirm .modal-content {
				padding: 20px;
				border-radius: 5px;
				border: none;
			}

			.modal-confirm .modal-header {
				border-bottom: none;
				position: relative;
			}

			.modal-confirm h4 {
				text-align: center;
				font-size: 26px;
				margin: 30px 0 -15px;
			}

			.modal-confirm .form-control,
			.modal-confirm .btn {
				min-height: 40px;
				border-radius: 3px;
			}

			.modal-confirm .close {
				position: absolute;
				top: -5px;
				right: -5px;
			}

			.modal-confirm .modal-footer {
				border: none;
				text-align: center;
				border-radius: 5px;
				font-size: 13px;
			}

			.modal-confirm .icon-box {
				color: #fff;
				position: absolute;
				margin: 0 auto;
				left: 0;
				right: 0;
				top: -70px;
				width: 95px;
				height: 95px;
				border-radius: 50%;
				z-index: 9;
				background: #82ce34;
				padding: 15px;
				text-align: center;
				box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
			}

			.modal-confirm .icon-box i {
				font-size: 58px;
				position: relative;
				top: 3px;
			}

			.modal-confirm.modal-dialog {
				margin-top: 80px;
			}

			.modal-confirm .btn {
				color: #fff;
				border-radius: 4px;
				background: #82ce34;
				text-decoration: none;
				transition: all 0.4s;
				line-height: normal;
				border: none;
			}

			.modal-confirm .btn:hover,
			.modal-confirm .btn:focus {
				background: #6fb32b;
				outline: none;
			}

			.trigger-btn {
				display: inline-block;
				margin: 100px auto;
			}

		</style>
	
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11164792134"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11164792134');
</script>

<section class="services-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="services-details-desc">
                    <section class="contact-area" style="background-color: #edf0f2;">
                        <div class="container">
                            <div class="row">
                                <?php	
                        			if($this->session->userdata('toastrSuccessflag') !="1")  
                        			{ 
                        			    $formsectioncss     = "display:block";
                        			    $messagesectioncss  = "display:none";
                        			}
                        			else
                        			{
                        			    $this->session->unset_userdata('toastrSuccessflag');
                        			    
                        			    $formsectioncss     = "display:none";
                        			    $messagesectioncss  = "display:block";
                        			}
                        			    
                        		?>
                                <div class="col-lg-12" id="formsection" style="<?php echo $formsectioncss; ?>">
									<div class="contact-form">
                                        <form method="post" enctype="multipart/form-data" id='menuscriptForm'>
                                        <!-- <form method="post" enctype="multipart/form-data" id='menuscriptFormnew' action="<?php echo site_url('submit-manuscript-save'); ?>"> -->
                                            <input type="hidden" name="_token" value="JKWaLf3KZoODjRlXeMJuFLVpstJS2A4XQjcfwKDm">                                            
											<div class="form-group">
												<input type="text" required name="txtAuthorName" id="txtAuthorName" class="form-control" data-error="Name of the Corresponding Author*" placeholder="Name of the Corresponding Author" value="<?php
												                                                                                                                                                                                                    if($this->session->userdata('name') !="" )
												                                                                                                                                                                                                   {
												                                                                                                                                                                                                       echo $this->session->userdata('name');
												                                                                                                                                                                                                   }
												                                                                                                                                                                                                ?>">
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
												<input type="text" required name="txtPaperTitle" id="txtPaperTitle" class="form-control" data-error="Title of the Paper*" placeholder="Title of the Paper*">
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
												<select type="text" name="cmbArticalTypeID" id="cmbArticalTypeID" class="form-control" data-error="Title of the Paper*" placeholder="Select Paper Type" required>
													<option value="">Select</option>
													<?php 
														 for($i = 0; $i < count($articalTypeResult); $i++)
														{
															echo "<option value=".$articalTypeResult[$i]['articalTypeID']."><p style='padding:top:5px;'>".$articalTypeResult[$i]['articalTypeName']."</br></option>";
														}
													?>
												</select>
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
												<input type="email" required name="txtEmail" id="txtEmail" data-error="Please enter your Email*" class="form-control" placeholder="Email*" value="<?php
                                                                                                                                                                                                if($this->session->userdata('authorMailID') !="" )
                                                                                                                                                                                               {
                                                                                                                                                                                                   echo $this->session->userdata('authorMailID');
                                                                                                                                                                                               }
                                                                                                                                                                                            ?>">
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
												<input type="number" required name="txtContact" id="txtContact" data-error="Please enter your Phone Number*" class="form-control" placeholder="Phone Number*" value="<?php
						                                                                                                                                                                                                    if($this->session->userdata('contactNumber') !="" )
						                                                                                                                                                                                                   {
						                                                                                                                                                                                                       echo $this->session->userdata('contactNumber');
						                                                                                                                                                                                                   }
						                                                                                                                                                                                                ?>">
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
												<select type="text" name="cmbCountryID" id="cmbCountryID" class="form-control" data-error="Country*" placeholder="Country" required>
													<option value="">Select Country</option>
													
													<?php 
														 for($i = 0; $i < count($countryResult); $i++)
														{
														       echo "<option value=".$countryResult[$i]['countryID'].">".$countryResult[$i]['countryName']."</option>";
														}
													?>
												</select>
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group mt-2 py-2">
												<label for="Paper">
													Upload Paper
													<span style="color:red">(only docs/doc file) *</span>
												</label>
												<input type="file" accept=".doc,.docx" name="file" class="form-control w-50" id="sortpicture" accept=".doc,.docx" required>
												<div class="help-block with-errors"></div>
											</div>
<!-- Checkbox with "ⓘ" icon -->
<div class="form-check mt-3">
    <input type="checkbox" required class="form-check-input" id="accept" checked>
    <label class="form-check-label" for="accept">
        I Accept All 
        <a href="#" data-toggle="modal" data-target="#termsModal">Terms & Condition</a>
        <a href="#" data-toggle="modal" data-target="#termsModal" class="info-icon">ⓘ</a>
    </label>
</div>

<!-- Bootstrap Modal for Terms & Conditions -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms & Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe src="https://www.ijpsjournal.com/terms-and-conditions" style="width:100%; height:400px; border:none;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Optional CSS for styling (if needed) -->
<style>
    .info-icon {
        text-decoration: none;
        color: #007bff; /* Bootstrap blue */
        font-weight: bold;
        margin-left: 5px;
    }
    .info-icon:hover {
        color: #0056b3;
        text-decoration: underline;
    }
</style>
											<div class="h3 text-center hidden">
												<input type="submit" value="Submit" id="buttonClass">
												<div class="clearfix"></div>
												<p class="mt-3"> <span class="text-danger">*</span> If you are facing any issue during online submission you can also email your manuscript on <a href="mailto:editor@ijpsjournal.com">editor@ijpsjournal.com</a></p>
											</div>
										</form>
									</div>
                                </div>
                        
                	            <div class="col-lg-12" id="messagesection" style="<?php echo $messagesectioncss; ?>">
                                    <div class="about-main-content1 mb-5 mt-5">
            							<p><strong>Dear Author/Researcher,</strong></p>
            							<p style="text-align:left">
            								We are inform you that your manuscript has been received and we are started working on it.
            							</p>
            							<p style="text-align:left">
            								Soon you will get a favorable reply from our side. Keep in touch.
            							</p>
            							<p style="text-align:left">
            								For more information, please check your email.
            							</p>
            							<p style="text-align:left">
            								Acknowledgment mail may reach to spam instead of Inbox. Please check your SPAM mail box too.
            							</p>
            							<h5 class="mt-5">Regards,</h5>
            							<h6>Editor-In-Chief</h6>
            							<img src="<?php echo base_url('assets/public/Front/assets/images/ijps.png'); ?>" style="width:100px;">
            							<p style="text-align:left">
                                            International Journal of Pharmaceutical Sciences (IJPS)<br>
                                            E-mail:editor@ijpsjournal.com<br>
                                            Website:www.ijpsjournal.com
            							</p>
            						</div>
            						<div class="option-item d-flex mt-5 mb-5">
                                        <div class="navbar-btn ">
                                            <a href="#" class="default-btn" style="color:white ;" id="submitNewManuscriptBtn">Submit New Manuscript<i class="flaticon-pointer"></i></a>
                                        </div>
                                    </div>
            					</div>
                        	    
                            </div>
                        </div>
                    </section>
                    <br>
                    </br>
		<section class="services-details-area ptb-100">

    <h4>About IJPS Journal:</h4>
    <p>IJPS is a reputable, fast publication journal specializing in pharmaceutical sciences, pharmacology, and related medical research to publish research paper. We offer a streamlined process for researchers, academicians, and practitioners to publish their findings and contribute to advancements in pharmacy and health sciences.</p>
    <p>At IJPS, we specialize in publishing high-quality research papers in the fields of pharmacology, pharmaceutical sciences, and medical research. We are committed to providing <strong>fast publication</strong> options for researchers eager to share their findings with the global scientific community.</p>
    
    <h4>Why Choose IJPS for Your Research Paper Publication?</h4>
    <ul>
        <li><p><strong>Pharmacology Journals</strong>: IJPS is a trusted name among pharmacology journals, catering to innovative research in drug discovery, pharmacokinetics, and clinical pharmacology.</p></li>
        <li><p><strong>Fast Publication</strong>: We understand the urgency of research publication. Our streamlined review and editorial process offers fast publication to help your work reach the community in a timely manner.</p></li>
        <li><p><strong>Low-Cost Pharmacy Journal</strong>: Our journal provides an affordable publishing option without compromising on quality, ensuring your research reaches a broad audience in the pharmacy field while keeping costs low.</p></li>
        <li><p><strong>Free DOI and Author Certificates</strong>: Get a free DOI for your published paper and author certificates at no additional cost, enhancing the credibility of your work and recognition in the scientific community.</p></li>
    </ul>
    
    <h4>Our Range of Journals</h4>
    <p>IJPS publishes a variety of journals to cater to different fields within the pharmaceutical and medical sciences:</p>
    <ul>
        <li><p><strong>Pharmacy Journal</strong>: Covering cutting-edge research in pharmaceutical sciences, drug development, and clinical pharmacy practices.</p></li>
        <li><p><strong>Journal of Pharmaceutical Sciences</strong>: Focused on the latest advancements in pharmaceutical sciences, this journal is ideal for research on drug formulation, pharmacology, and bio-pharmaceutics.</p></li>
        <li><p><strong>Medical Journal</strong>: Our medical journal section features research in health sciences, medical technology, and allied health disciplines.</p></li>
        <li><p><strong>International Journal of Pharmaceutics</strong>: An internationally recognized journal for research papers on pharmaceutics, pharmaceutical technology, clinical Pharmacy and applied pharmacology.</p></li>
        <li><p><strong>Journal Publication Sites</strong>: IJPS stands out among journal publication sites with its user-friendly interface and commitment to quality, making research paper publication a seamless experience.</p></li>
    </ul>

    <div class="faq">
        <h4>Frequently Asked Questions</h4>
        <strong>What are the requirements to publish a research paper with IJPS?</strong>
        <p>We accept research papers that adhere to our journal’s standards and focus areas, including pharmacology, pharmaceutics, and medical sciences. </p>
        <strong>Is IJPS a Scopus indexed journal?</strong>
        <p>Yes, IJPS indexed in Scopus previously, offering increased visibility and a higher citation potential for published papers. We have re-applied and soon will be back in the list.</p>
        <strong>Are IJPS journals follow UGC care guidelines?</strong>
        <p>Yes, IJPS journals are strictly follows UGC care guidelines, which assures high quality and academic credibility. </p>
    </div>
    <p style="color: white;">Scopus Journal: Indexed in Scopus, our journal offers increased visibility and impact for your research, ensuring that your work reaches a wider audience of scientists and practitioners.</p>
    <p style="color: white;">UGC Approved Journals: As a UGC-approved journal, we meet stringent quality standards recognized by academic institutions, making us a trusted platform for publishing pharmacy and medical research.</p>
		</section>
                </div>
            </div>
            
	<div class="col-lg-3 col-md-12 d-none d-lg-block">
						<div class="services-details-info mob-t-2">
							<strong>For Authors</strong>
							<ul class="services-list mt-2">
								<li class="nav-item">
									<a href="<?php echo site_url('check-plagarism'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Check Plagiarism</a>
								</li>								
								<li class="nav-item">
									<a href="<?php echo site_url('author-guidelines'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Author Guidelines</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('copyright-form'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Copyright Form</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('about-us'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Journal Indexing</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('current-issue'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Current Issue</a>
								</li>
							</ul>
							<div class="rightSideSection my-3">
							    <a href="https://www.ijpsjournal.com/check-plagarism" class="nav-link" target="_BLANK">
									<img src="<?php echo base_url('assets/public/Front/assets/images/check plagiarism1.png'); ?>" alt="image" style="width:600px;">
								</a>
							</div>
							<div class="rightSideSection my-3">
							    <a href="https://scholar.google.com/citations?user=EFRTG5YAAAAJ&hl=en&authuser=1" class="btn" style="color:white ;">Google Scholar profile</a>
							    <a href="https://scholar.google.com/citations?user=EFRTG5YAAAAJ&hl=en&authuser=1" class="nav-link" target="_BLANK">
									<img src="<?php echo base_url('assets/public/Front/assets/images/googlescholar.png'); ?>" alt="image" style="width:600px;">
								</a>
							</div>
						    <blockquote class="twitter-tweet"><p lang="en" dir="ltr">📢 Check out the latest research in pharmaceutical sciences! Our new issue is packed with cutting-edge studies and reviews. <br><br>Dive into the world of pharma innovation with us!<br><br>🔗 Explore the latest articles: <a href="https://t.co/W1WB9YkpGi">https://t.co/W1WB9YkpGi</a> <a href="https://twitter.com/hashtag/PharmaceuticalScience?src=hash&amp;ref_src=twsrc%5Etfw">#PharmaceuticalScience</a> <a href="https://twitter.com/hashtag/Research?src=hash&amp;ref_src=twsrc%5Etfw">#Research</a> <a href="https://twitter.com/hashtag/Innovation?src=hash&amp;ref_src=twsrc%5Etfw">#Innovation</a> <a href="https://t.co/U25XaP1ph9">pic.twitter.com/U25XaP1ph9</a></p>&mdash; International Journal of Pharmaceutical Sciences (@int_j_pharm_sci) <a href="https://twitter.com/int_j_pharm_sci/status/1830932978710585516?ref_src=twsrc%5Etfw">September 3, 2024</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
						</div>
					</div>
				
				</div>
			</div>
		</section>

			<?php
				$ajaxUrl = site_url('HomeController/insertManuscript');
			
			?>
<script>
    $("#submitNewManuscriptBtn").click(function() {
        $("#formsection").css("display", "block");
        $("#messagesection").css("display", "none");
    });
    
</script>
		<script>
			function handleClick(checkbox) {
    if(checkbox.checked){
		//alert('hh');
		document.getElementById('accept').checked = true;
        //console.log(checkbox.value+"True")
    }
    else{
		//alert('hh--');
		document.getElementById('accept').checked = false;
        //console.log(checkbox.value+"False")
    }
}

			var myfile="";


			$('#sortpicture').on( 'change', function() {
			   myfile= $( this ).val();
			   var ext = myfile.split('.').pop();
			   if(ext=="pdf" || ext=="docx" || ext=="doc"){
				   //alert(ext);
			   } else{
				   //alert(ext);
			   }
			});
	</script>
		<script>
		
function myFunction() { 
	document.getElementById("myModal").classList.add('show');

/*document.getElementById("MyElement").classList.remove('MyClass');*/
	$("#myModal").addClass("show");
  document.getElementById("demo").innerHTML = "Hello World";
}
</script>
		<script>
		// executeExample('sweetAlert');
		// 	Swal.fire(
		// 							'Thanks for submitting.',
		// 							'Your manuscript has been submitted',
		// 							'success'
		// 							);
		</script>
		
		
		<?php	
		    /*print_r($this->session->userdata());		
			if($this->session->userdata('toastrSuccess') !="")  
			{
			    echo "<script>alert('test');</script>";
			    //echo "hello";exit;
		?>
		
		<div id="myModal" class="modal fade show" >
				<div class="modal-dialog modal-confirm">
					<div class="modal-content">
						<div class="modal-header">
							<div class="icon-box">
								<i class="material-icons">&#xE876;</i>
							</div>
							<h4 class="modal-title w-100">Submitted</h4>
						</div>
						<div class="modal-body">
							<p class="text-center" id="modelmessage">Your manuscript has been submitted-----------</p>
						</div>
						<div class="modal-footer">
							<button class="btn btn-success btn-block" id="submit_popup" data-dismiss="modal">OK</button>
						</div>
					</div>
				</div>
			</div>
				<script> 
				alert("yes");
				function (data) {
							Swal.fire(
									'Thanks for submitting.',
									'Your manuscript has been submitted',
									'success'
									);
				
					//alert('dgvddsvbf');
					$("#myModal").addClass("show");
					$("#modelmessage").text(<?php echo $this->session->userdata('toastrSuccess'); ?>)
				</script>
				<div id="toast-container" class="toast-top-right">
					<div class="toast toast-success" aria-live="polite" style="">
						<div class="toast-message"><?php echo $this->session->userdata('toastrSuccess'); ?></div>
					</div>
				</div>
		<?php			
				$this->session->unset_userdata('toastrSuccess');
			}
			else if($this->session->userdata('toastrWarning'))
			{
		?>
				<div id="toast-container" class="toast-top-right">
					<div class="toast toast-warning" aria-live="polite" style="">
						<div class="toast-message"><?php echo $this->session->userdata('toastrWarning'); ?></div>
					</div>
				</div>
		<?php		
				$this->session->unset_userdata('toastrWarning');
			}
			else if($this->session->userdata('toastrError'))
			{
		?>
				<div id="toast-container" class="toast-top-right">
					<div class="toast toast-error" aria-live="assertive" style="">
						<div class="toast-message"><?php echo $this->session->userdata('toastrError'); ?></div>
					</div>
				</div>
		<?php	
				$this->session->unset_userdata('toastrError');
			}
			*/
		?>

	<script>
			$('#submit_popup').on('click', function () {
				// Close the modal by removing the "show" class and hiding it
				$('#myModal').removeClass('show');
				$('#myModal').hide();
			});

			$(document).ready(function () {
				$("#cmbCountryID").select2();
				$("#cmbArticalTypeID").select2();
				
				
				
				
			});
		</script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>

		<script>
			$("#menuscriptForm").submit(function (e) {
				
				
				e.preventDefault();
				
					var bodyFormData = new FormData(this);
					$.ajax({
						url:  '<?php echo $ajaxUrl; ?>',
						type: 'POST',						
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						contentType: false,
						processData: false,
						data: bodyFormData,
						beforeSend:function(){
						$("#buttonClass").prop("disabled", true);
							$("#buttonClass").val('Processing.....');
						},
						success: function (data) {
							var jsonParse = JSON.parse(data);                            
							if(jsonParse.status=='success'){									
								Swal.fire({
									title: jsonParse.msg,											
									icon: "success",											
									allowOutsideClick: false,
									allowEscapeKey: false										
									})
									.then((willDelete) => {
									if (willDelete) {	
									    $("#messagesection").show();											
										$("#formsection").hide();	
										 $('#menuscriptForm')[0].reset();
										 	$("#buttonClass").removeAttr('disabled');
								            $("#buttonClass").val('Submit')	
										//location.reload();
									} 
									});								
									
								
							}else{
								$("#buttonClass").removeAttr('dsiabled');
								$("#buttonClass").val('Submit')	
								Swal.fire(
								jsonParse.msg,
								'',
								'error'
								);
								$("#messagesection").hide();											
								$("#formsection").show();	
							}
						}
					});					
				
			});
			</script>