		<?php
		
			$this->load->view('layout/header');
		?>
			<title>Submit Authors Info | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="Submit your innovative research papers, reviews, and more in pharmaceutical sciences to IJPS. Our rigorous peer-review process ensures the highest quality content, and our online submission system makes it easy to submit your manuscript"/>
			<meta name="keywords" content="submit manuscript, research submissions, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/submit-authors-info">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Submit Author info | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/submit-authors-info">
			<meta property="og:description" content="Submit your innovative research papers, reviews, and more in pharmaceutical sciences to IJPS. Our rigorous peer-review process ensures the highest quality content, and our online submission system makes it easy to submit your manuscript.">
			<meta property="og:image" content="https://ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@int_j_pharm_sci">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="An open access peer-reviewed journal aiming to communicate high quality original research work that contribute scientific knowledge related to the field of Pharmaceutical Sciences.">
			<meta name="twitter:image" content="<?php echo base_url('assets/public/Front/assets/images/logoup.jpg'); ?>">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
			<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			<script> var indexval= 0; </script>
		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		<style>
		    @media only screen and (max-width: 767px)
		    {
                .submitbtn {
                        width: 100% !important;
                    font-size: 14px !important;
                }
            }
            #rowAdder {
                            margin-left: 17px;
                        }
                        
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
		<style>
			input[type=text],
			select {
				width: 100%;
				height: 62px;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 10px;
				box-sizing: border-box;
			}

			input[type=email],
			select {
				width: 100%;
				height: 62px;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 10px;
				box-sizing: border-box;
			}

			input[type=number],
			select {
				width: 100%;
				height: 62px;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 10px;
				box-sizing: border-box;
			}

			input[type=submit] {
				width: 40%;
				background-color: #4896ce;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				border-radius: 10px;
				cursor: pointer;
			}

			input[type=submit]:hover {
				background-color: #45a049;
			}

			.blinking-button{
    padding: 8px 35px;
    border-radius: 48px 0px; 
border: 0px solid #6C8003;
}
@keyframes blink {
  0%, 100% {background-color:#3F06FF;}
  50% {background-color: #8EDDBE;}
}
.blinking-button {
  background-color: #8EDDBE;
  color: white;
  animation: blink 1s linear infinite;
}
		</style>
<style>		
		/* Add CSS styles to hide the loader initially */
.hidden {
    display: none;
}

/* Add styles to show the loader on the full screen */
#loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    text-align: center;
    padding: 20px;
    font-size: 24px;
    z-index: 9999;
}
</style>
<section class="services-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="services-details-desc">
                    <section class="contact-area" style="background-color: #edf0f2;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
									<div class="contact-form">
                                        <form method="post" enctype="multipart/form-data" id='menuscriptForm' >
                                        <!-- <form method="post" enctype="multipart/form-data" id='menuscriptFormnew' action="<?php echo site_url('submit-authors-info-save'); ?>"> -->
                                            <input type="hidden" name="_token" value="JKWaLf3KZoODjRlXeMJuFLVpstJS2A4XQjcfwKDm">                                            
                                            <input type="hidden" name="addMoreAuthors" id="addMoreAuthors" value="0">                                            
											<div class="form-group">
												<label for="Paper" style="display: block;">
													Article ID
													<span style="color:red">(Please enter article ID without 'IJPS/') *</span>
												</label>
												<input type="text" required name="txtArticleID" id="txtArticleID" class="form-control" data-error="Article ID*"  required style="display: inline-block; width: 100%;" onchange="staticData()" onkeyup="staticData()" onkeypress="return isNumber(event)">
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group mt-2 py-2">
												<label for="Paper">
													Upload filled copyright form
												</label>
												<input type="file" name="copyrightform" class="form-control w-50" id="copyrightform"  required>
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group mt-2 py-2">
												<label for="Paper">
													Upload Payment receipt/Screenshot
												</label>
												<input type="file" name="paymentreceipt" class="form-control w-50" id="paymentreceipt" required>
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group mt-4">
												<label for="Paper" class="w-100">
													<strong>Corresponding Author</strong>
													<hr class="mb-0">
												</label>
											</div>
											<div class="form-group">
												<input type="text" required name="txtCorrespondingAuthorName" id="txtCorrespondingAuthorName" class="form-control" data-error="Name of the Corresponding Author*" placeholder="Name of the Corresponding Author*" required value="<?php
												                                                                                                                                                                                                    if($this->session->userdata('name') !="" )
												                                                                                                                                                                                                   {
												                                                                                                                                                                                                       echo $this->session->userdata('name');
												                                                                                                                                                                                                   }
												                                                                                                                                                                                                ?>">
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
												<input type="text" required name="txtCorrespondingAffiliation" id="txtCorrespondingAffiliation" class="form-control" data-error="Name of the Corresponding Affiliation*" placeholder="Name of the Corresponding Affiliation*" required>
												<div class="help-block with-errors"></div>
											</div>
											<div class="form-group">
												<input type="text" required name="txtCorrespondingAuthorEmail" id="txtCorrespondingAuthorEmail" class="form-control" data-error="Corresponding Author Email*" placeholder="Corresponding Author Email*" required value="<?php
												                                                                                                                                                                                                   if($this->session->userdata('authorMailID') !="" )
                                                                                                                                                                                               {
                                                                                                                                                                                                   echo $this->session->userdata('authorMailID');
                                                                                                                                                                                               }
												                                                                                                                                                                                                ?>">
												<div class="help-block with-errors"></div>
												<small>*Affiliation is the Department, Institute from where the author is belonging</small>
											</div>
											<div class="form-group mt-2 py-2">
												<label for="Paper">
													Upload Passport Size photo of Corresponding author
													<span style="color:red">(only jpg, jpeg, png file)</span>
												</label>
												<input type="file" name="correspondingauthor" class="form-control w-50" id="correspondingauthor" accept=".png, .jpg, .jpeg">
												<div class="help-block with-errors"></div>
											</div>
                                                    <div id="repetedsection">
                                                    </div>
                                 
                                                    <div id="newinput"></div>
                                                    <button id="rowAdder" type="button"  class="btn btn-cust mt-3 m-0" style="
    background-color: black;
    color: white;
">
                                                        <span class="bi bi-plus-square-dotted">
                                                        </span> Add Co-Author
                                                    </button>
											<div class="h3 text-center hidden1">
												<div style=" margin-left: auto; margin-right: auto; padding-top: 10px;width: 20em">
													<br>
												</div>
												<button type="submit" class="submitbtn btn btn-primary btn-lg" id="submitbtn">Submit</button>
											</div>
										</form>
									</div>
                                </div>
                                <div id="loader" class="hidden">
                                    <h1 class="text-white" style="margin-top:250px;">Please Wait...</h1>
                                </div>
                                <?php	
                        			if($this->session->userdata('toastrSuccess'))
                        			{
                        		?>
                        		
            					<?php
            					        $this->session->unset_userdata('toastrSuccess');
                        			}
                        		?>
                            </div>
                        </div>
                    </section>
                    
                </div>
            </div>
	<div class="col-lg-3 col-md-12">
						<div class="services-details-info">
							<strong>For Authors</strong>
							<ul class="services-list mt-2">
								<li class="nav-item">
									<a href="<?php echo site_url('author-guidelines'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Author Guidelines</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('copyright-form'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Copyright Form</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('check-paper-status'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Check Paper Status</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('current-issue'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Current Issue</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('submit-manuscript'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Submit Manuscript</a>
								</li>
							</ul>
							<div class="rightSideSection my-3">
							    <a href="https://scholar.google.com/citations?user=EFRTG5YAAAAJ&hl=en&authuser=1" class="btn" style="color:white ;">Google Scholar profile</a>
							    <a href="https://scholar.google.com/citations?user=EFRTG5YAAAAJ&hl=en&authuser=1" class="nav-link" target="_BLANK">
									<img src="<?php echo base_url('assets/public/Front/assets/images/googlescholar.png'); ?>" alt="image" style="width:600px;">
								</a>
							</div>
							<a class="twitter-timeline" data-height="250" href="https://twitter.com/int_j_pharm_sci"></a> 
							<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
						</div>
					</div>
				
				</div>
			</div>
		</section>

		<div class="modal fade  bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body p-0">
						<div class="content-image text-center">
							<img src="<?php echo base_url('assets/public/Front/assets/images/tc.jpeg'); ?>" alt="image">
						</div>
						<div class="services-details-desc p-5">
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'>
								<span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>
									These terms and conditions govern your use of this website; by using it, you accept these terms and conditions in full. If you disagree with them or any part of the conditions, you must not use it.
								</span>
							</p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>License to use this website</span></strong></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Unless otherwise stated, the Publisher of this website and/or its licensors own the intellectual property rights in this website and materials on the website unless otherwise specified on any page. &nbsp;Subject to the license below, all these intellectual property rights are reserved.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Users may view, download for caching purposes only, and print published articles and other pages from this website for their own personal use, subject to the restrictions set out below and elsewhere in the terms and conditions for each material published on this website. &nbsp;</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>You must not:</span></p>
							<ul style="list-style-type: disc;margin-left:56px;">
								<li><span style='font-family:"montserrat",sans-serif;font-size:16px;color:#212529;'>republish material from this website (including republication on another website);</span></li>
								<li><span style='font-family:"montserrat",sans-serif;font-size:16px;color:#212529;'>sell, rent or sub-license material from the website;</span></li>
								<li><span style='font-family:"montserrat",sans-serif;font-size:16px;color:#212529;'>reproduce, duplicate, copy or otherwise exploit material on this website for a commercial purpose;</span></li>
								<li><span style='font-family:"montserrat",sans-serif;font-size:16px;color:#212529;'>edit or otherwise modify any material on the website; or</span></li>
								<li><span style='font-family:"montserrat",sans-serif;font-size:16px;color:#212529;'>redistribute material from this website except for content specifically and expressly made available for redistribution.</span></li>
							</ul>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>We publish Open Access articles that use a funding model which does not charge readers or their institutions for access. You may reproduce, duplicate, copy, edit, modify and redistribute content that is specifically made available under the terms of the&nbsp;</span><span style="color:black;"><a href="http://creativecommons.org/licenses/by/4.0"><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#D9230F;'>Creative Commons Attribution License</span></a></span><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>&nbsp;and the&nbsp;</span><span style="color:black;"><a href="http://www.budapestopenaccessinitiative.org/read"><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#D9230F;'>Budapest Open Access Initiative</span></a></span><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>. However, you may not claim ownership or pretend to be the content owner by republishing without adequate citation and credit with links to the original source of the content.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>We do not guarantee that our sites will be secure or free from bugs or viruses.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>You are responsible for configuring your information technology, computer programmes and platform in order to access our sites. You should use your own virus protection software.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>You must not misuse our sites by knowingly introducing viruses, trojans, worms, logic bombs or other material which is malicious or technologically harmful. You must not attempt to gain unauthorised access to our sites, the server on which our sites is stored or any server, computer or database connected to our site. You must not attack our sites via a denial-of-service attack or a distributed denial-of-service attack. By breaching this provision, you would commit a criminal offence under the Computer Misuse Act 1990. We will report any such breach to the relevant law enforcement authorities and we will co-operate with those authorities by disclosing your identity to them. In the event of such a breach, your right to use our sites will cease immediately.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Linking policy</span></strong></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>This website contains links that may take you outside our website. All links are provided for your convenience, and an inclusion of any link does not imply endorsement or approval by us of the linked website, its operator or content. We have no control over the contents or functionality of those sites and accept no responsibility for any loss or damages that may arise from your use of them. We are not responsible for any website outside our website, and such websites use will be subject to relevant terms and conditions and privacy policies.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>You may not link to the content of our website without our permission.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Access to this website</span></strong></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>We try to ensure that website availability is uninterrupted and that transmissions will be error-free. However, we cannot guarantee that your access will not be suspended or restricted from time to time, including to allow for repairs, maintenance or the introduction of new facilities or services. We do everything to limit the frequency and duration of any suspension or restriction. We shall not be liable if for any reason the website is unavailable at any time or for any period.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Third-Party software</span></strong></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Certain functionality on our websites may be using third-party components or software and may operate with plug-ins and APIs created by third parties. Your use of Third-Party Software that has been incorporated into our sites will be subject to the terms and conditions of the authors and owners of such Third Party Software.&nbsp;</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Limitation of Liability</span></strong></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>To the fullest extent permitted by law, we expressly exclude:</span></p>
							<ol start="1" style="margin-bottom:0cm;margin-top:0cm;" type="1">
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-family:"montserrat",sans-serif;'>All conditions, warranties and other terms which might otherwise be implied by statute, common law or the law of equity;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-family:"montserrat",sans-serif;'>Any liability caused by a force majeure event;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-family:"montserrat",sans-serif;'>Any obligation of effectiveness or accuracy; and</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-family:"montserrat",sans-serif;'>Other than as set out elsewhere in this website, any liability for any direct, indirect or consequential loss or damage incurred by you in connection with this agreement, including your use or inability to use any information on our website or within any publication subscribed to, via any website linked to our website and any material posted on it, including without limitation any liability for loss of income or revenue, loss of business, loss of profits or contracts anticipated savings, loss of data, loss of goodwill, wasted time and for any other loss or damage of any kind, howsoever and whether caused by tort including negligence, by breach of contract or otherwise, even if foreseeable.</span></li>
							</ol>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Nothing in this provision affects our liability for death or personal injury arising from our negligence or for liability for fraudulent misrepresentation or misrepresentation as to a fundamental matter nor any other liability which cannot be excluded or limited under the applicable law. These provisions do not affect any applicable statutory rights.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Conditions for submission of articles for peer-reviewed publication</span></strong></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><u><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Submission of the article</span></u></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>If published, your article <strong>will in principle remain published permanently</strong>, with your personal details and those of your co-authors, as well as those of the reviewers and handling editors, on the Journal&rsquo;s Website, and will be stored and made public in archives, in repositories and potentially in other places. By submitting, reviewing or accepting editorial responsibilities for an article you consent to a limited amount of your personal data being thus published.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>When you submit an article to any Journal, you promise that</span></p>
							<ul style="margin-bottom:0cm;margin-top:0cm;" type="disc">
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>The article is not under consideration by any other journal; if it has been submitted for consideration elsewhere, it has been definitively rejected and is no longer being considered for publication;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>The article will not be submitted for publication elsewhere unless either published or rejected by IJPS;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>You have the explicit consent of all co-authors to submit the article and to accept these conditions, including the granting of the CC-BY or other applicable licence, on behalf of all co-authors.</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>You have the authorisation of all copyright owners (which may include your employer or funder, and any owners of third-party graphics) to submit the article and to grant the CC-BY or other applicable licence over the article;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>an article submitted to report original research is an original contribution, meaning it contains content that has not been previously published in its current form (except for manuscripts deposited as pre-prints in established community-validated pre-print services).</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>the article does not contain any non-attributed content from any existing source, including the authors&rsquo; own existing material;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>all contributors have been adequately acknowledged;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>the article and all authors meet the authorship criteria as outlined in the&nbsp;</span><span style="color:black;"><a href="<?php echo site_url('author-guidelines'); ?>" target="_blank"><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;'>author guidelines</span></strong></a></span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>the article complies with all the rules on content set out below;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>all findings have been verified in accordance with the highest scientific standards in the relevant field;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>all research involving regulated animals (i.e. all live vertebrates and higher invertebrates) has been conducted in accordance with relevant institutional and national guidelines, all applicable legislation and guidelines and accepted best practices, and the approval body has been identified in the article;</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>the article clearly declares any financial, commercial or other relationships which may be considered to represent a potential conflict of interest; and</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>you have disclosed all relevant facts to IJPS concerning the author(s), the article, the underlying research, any relevant third-party rights and any actual or potential conflicts of interest.</span></li>
							</ul>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><u><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Acceptance and Rejection</span></u></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Acceptance is at IJPS&rsquo; (or the Hosted Journal owner&rsquo;s) discretion in accordance with its rules and processes. Once accepted, an article will in principle be published; on rare occasions an issue causing rejection may arise or be discovered, in which case the article may be rejected prior to publication despite having been previously accepted.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><u><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Publication</span></u></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>There is no prior right to publication. Articles submitted will be subjected to ethical and technical checks and then to our rigorous and interactive peer-review process, which will require your cooperation.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>If the article is published, you will become liable to pay the applicable article publication charge (APC), or to ensure that it is paid. Current APCs can be seen&nbsp;</span><span style="color:black;"><a href="<?php echo site_url('pay-fees'); ?>" target="_blank"><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;'>here</span></strong></a></span><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>&nbsp;for IJPS Journal.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Peer-review processes are designed to ensure scientific rigour. They do not include checks for the satisfaction of the other requirements (such as copyright permissions on images and graphics, for example).</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><u><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Time for publication</span></u></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>If IJPS unjustifiably, for reasons caused entirely by its own negligence, fails to publish an article in a Journal within a reasonable period of its final acceptance and payment by the author, IJPS shall refund the publication fee, <strong>to the exclusion of any other liability of IJPS for such failure</strong>.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><u><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>The Published Article</span></u></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Once published, an article can not be removed except by decision of the Owner of the Journal, in accordance with accepted retraction processes. The article is likely to be archived and referenced in a number of archives and repositories.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Articles published in IJPS Journals will be published with the name(s) and affiliation(s) of the author(s) and the names of the reviewers who endorsed publication during the peer review, as well as that of the handling editor.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>IJPS Journal reserve the right to remove any content, and to retract peer-reviewed articles, which in its view breach any applicable conditions and/or which they or we consider to be inappropriate in any way. Such removal does not entitle the author to reimbursement of APCs.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>IJPS and owners of Hosted Journal are not liable for the acts or statements of others.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><u><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Disputes</span></u></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>We have mediation processes for settling disputes related to articles, and we mutually promise to exhaust those possibilities prior to commencing any judicial dispute resolution mechanisms.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Rules on Content</span></strong></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>All content submitted to any Website, whether or not peer-reviewed, must comply with these rules. This is your responsibility when you submit any article or content.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>All content must:</span></p>
							<ul style="margin-bottom:0cm;margin-top:0cm;" type="disc">
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>be accurate or be genuinely believed to be accurate after duly rigorous investigation</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>only state opinions which are genuinely held</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>comply with all generally accepted scientific and academic norms and with all accepted citation rules and norms, and must give appropriate credit for contributions</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>comply with all accepted ethical rules and norms, including any ethical guidelines of IJPS journal.</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>not infringe any intellectual property rights (including copyright, moral rights and database rights) of any person</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>be the subject of any necessary consents and authorisations</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>not breach any conditions of any website or other forum from which that content was copied or derived, or to which you provide a link, or from which you have provided a link to our website</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>not be defamatory</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>not be malicious, offensive, discriminatory, threatening, racist, extremist; not promote hatred or violence or denigrate any person, group of people or set of beliefs, or provide any link to any such material</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>only be for the purpose of furthering scientific and academic discourse in good faith, and in particular not be for the purpose, or have the effect, of promoting any commercial offering, service, product or interest, without the prior explicit agreement of IJPS journal.</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>not be pornographic or indecent</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>remain polite and respectful, especially when disagreeing</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>not ascribe any negative psychological or other labels or descriptions to any named or identifiable person or group of people, without the specific, informed consent of the person or people concerned to such label or description being ascribed to him/her/them</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>not be for the purpose, or have the primary effect, of promoting any political, societal, religious or anti-religious views</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>not disclose confidential information, including personal data of others, without the consent of the owner of that information or data</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>comply with all applicable laws</span></li>
								<li style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:     normal;font-size:16px;font-family:"montserrat",sans-serif;color:#212529'><span style='font-size:16px;font-family:"montserrat",sans-serif;'>not advocate, refer to or provide a link to any website or content which would itself infringe any of these principles.</span></li>
							</ul>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>IJPS may remove any content, or retract peer-reviewed articles, at their respective discretion. You may also request deletion of content, such requests will be considered in their context. A place-holder may be inserted to indicate that a comment has been deleted. Deleted comments may be retained for the record.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>IJPS not responsible for content posted by their users, including the content of peer-reviewed articles.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Content you post will by default be visible to others. You may alter your settings to reduce access to your content (but not to peer-reviewed articles) by editing the default settings for each post you make.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Any content posted by you may be commented on, copied, quoted and linked to by others.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>If you believe any content on a IJPS Website breaches any of these requirements, please contact us at&nbsp;</span><span style="color:black;"><a href="mailto:editor@ijpsjournal.com"><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;'>editor@ijpsjournal.com</span></strong></a></span><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>. Where the suspected breach occurs on a Hosted Journal Website, please refer to that Journal&rsquo;s Website for the relevant contact address.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>&nbsp;</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><strong><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>Disclaimer</span></strong><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'><br>&nbsp;<br>&nbsp;</span><span style='font-family:"montserrat",sans-serif;color:#212529;'>All expressions of opinions, data and statements appearing in articles or advertisements in this journal are published under the authority of the writer concerned. They are not to be regarded as necessarily expressing the views of the Publisher or product endorsement by the Publisher. Nonetheless, the Editorial Board will do its utmost to ensure that incorrect data, misleading data, opinions or statements do not appear in this journal.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-family:"montserrat",sans-serif;color:#212529;'>However, we cannot be held responsible for inadvertent errors or omissions, and have no liability to any person or institution regarding claims, loss, or damage, caused or alleged to be caused, directly or indirectly by the use of information or data contained in the Journal.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.75pt;margin-left:0cm;line-height:1.8;font-size:16px;font-family:"montserrat",sans-serif'><span style='font-size:16px;font-family:"montserrat",sans-serif;color:#212529;'>To the fullest extent permitted by law, the material and information displayed on this website are provided &quot;as is&quot; without any guarantees, conditions or warranties as to accuracy.</span></p>
							<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:16px;font-family:"montserrat",sans-serif;'>&nbsp;</p>
							<div class="form-check mt-3">
								<input type="checkbox" required class="form-check-input" id="acceptPopup" onclick="handleClick(this);" checked>
								<label class="form-check-label" for="accept">I Accept All Terms & Condition</label>
							</div>
						</div>					
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
				  </div>
				</div>
			  </div>
			</div>
			<?php 	$ajaxUrl = site_url('submit-authors-info-save');  ?>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<script>

	
var data=$("#txtArticleID");
data.val("IJPS/");
     data.attr("readonly",false);
function staticData(){
  var data=$("#txtArticleID");
  if(data.val().length<5)
    {
     data.val("IJPS/");
     data.attr("readonly",true);
    }
    else
    {
     data.attr("readonly",false);
    }
}
</script>
        <script type="text/javascript">
        $("#rowAdder").click(function () {
            $("#addMoreAuthors").val(1);
            newRowAdd =
                '<div id="repetedsection">' +
                '    <div class="form-group mt-4">' +
				'		<label for="Paper" class="w-100">' +
				'			<strong>Co-Author '+(indexval = indexval+1)+'</strong>' +
				'			<button class="btn btn-danger float-right"' +
                '                id="DeleteRow"' +
                '                type="button">' +
                '            <i class="bi bi-trash"></i>' +
                '       </button>' +
				'			<hr class="mb-0">' +
				'		</label>' +
				'	</div>' +
				'	<div class="form-group">' +
				'		<input type="text" name="txtCoAuthorName[]" id="txtCoAuthorName[]" class="form-control" data-error="Name of the Co-Author" placeholder="Name of the Co-Author '+indexval+ ' ">' +
				'		<div class="help-block with-errors"></div>' +
				'	</div>' +
    			'	<div class="form-group">' +
    			'		<input type="text"  name="txtCoAuthorAffiliation[]" id="txtCoAuthorAffiliation[]" class="form-control" data-error="Co-Author Affiliation" placeholder="Co-Author '+indexval+' Affiliation" >' +
    			'		<div class="help-block with-errors"></div>' +
    			'	</div>' +
				'	<div class="form-group">' +
				'		<input type="text" name="txtCoAuthorEmail[]" id="txtCoAuthorEmail[]" class="form-control" data-error="Co-Author Email" placeholder="Co-Author '+indexval+' Email" >' +
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
                '</div>';
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
        $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#repetedsection").remove();
        })
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
				   alert(ext);
			   } else{
				   alert(ext);
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

            $("#menuscriptForm").submit(function (e) {
              $(this).find(':input[type=submit]').prop('disabled', true);
              e.preventDefault();
            
              var addMoreShow = $("#addMoreAuthors").val();
             
              var bodyFormData = new FormData(this);
              if (addMoreShow == 0) {
                Swal.fire({
                  title: "Did you fill the info of Co-Authors (if any)?",
                  showCancelButton: true,
                  confirmButtonText: "Yes",
                  cancelButtonText: "No",
                }).then((result) => {
            
                  if (result.isConfirmed) {
                  
                    $.ajax({
                      url: '<?php echo $ajaxUrl; ?>',
                      type: 'POST',
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                      contentType: false,
                      processData: false,
                      data: bodyFormData,
                      success: function (data) {
                        var jsonParse = JSON.parse(data);
                        if (jsonParse.status == 'success') {
                          Swal.fire({
                            title: jsonParse.msg,
                            confirmButtonText: "Ok",
            
                          }).then((result) => {
            
                            if (result.isConfirmed) {
                              location.reload();
                            }
                          });
                        } else {
                          Swal.fire(
                            jsonParse.msg,
                            '',
                            'error'
                          );
                        }
                      },
                      complete: function () {
                        $(this).find(':input[type=submit]').prop('disabled', false);
                      }
                    });
                  } else {
                    Swal.fire("Fill the info of co-authors (if any)", "", "info");
                     $(this).find(':input[type=submit]').prop('disabled', false);
                  }
            
                });
            
                }else{
                    
                   
                    $.ajax({
                      url: '<?php echo $ajaxUrl; ?>',
                      type: 'POST',
                      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                      contentType: false,
                      processData: false,
                      data: bodyFormData,
                      success: function (data) {
                          console.log(data);
                        var jsonParse = JSON.parse(data);
                        if (jsonParse.status == 'success') {
                          Swal.fire({
                            title: jsonParse.msg,
                            confirmButtonText: "Ok",
            
                          }).then((result) => {
            
                            if (result.isConfirmed) {
                              location.reload();
                            }
                          });
                        } else {
                          Swal.fire(
                            jsonParse.msg,
                            '',
                            'error'
                          );
                        }
                      },
                      complete: function () {
                        $(this).find(':input[type=submit]').prop('disabled', false);
                      }
                    });
                }
            	
            });				   
        
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
//print_r($this->session->userdata());exit;		
			if($this->session->userdata('toastrSuccess'))
			{
		?>
				<script> 
				
				// function (data) {
				// 			Swal.fire(
				// 					'Thanks for submitting.',
				// 					'Your manuscript has been submitted',
				// 					'success'
				// 					);}
				
					//alert('dgvddsvbf');
					// $("#myModal").addClass("show");
					// $("#modelmessage").text(<?php echo $this->session->userdata('toastrSuccess'); ?>)
				</script>
				<!-- <div id="toast-container" class="toast-top-right">
					<div class="toast toast-success" aria-live="polite" style="">
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
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>