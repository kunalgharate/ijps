		<?php
			$this->load->view('layout/header');
		?>
			<title>Copyright Form | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="At IJPS, we require authors to sign a copyright form before publication. This ensures protection of intellectual property and helps prevent plagiarism."/>
			<meta name="keywords" content="Copyright Form, publication rights, intellectual property, author consent, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/copyright-form">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Copyright Form | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/copyright-form">
			<meta property="og:description" content="At IJPS, we require authors to sign a copyright form before publication. This ensures protection of intellectual property and helps prevent plagiarism.">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/copyright.png">
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

		<section class="services-details-area ptb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-12">
						<div class="services-details-desc">
							<div class="overview-image">
								<img src="<?php echo base_url('assets/public/Front/assets/images/Copyright-Agreement_page-0001.jpg'); ?>" alt="image">
							</div>
							<p class="color-text" style="text-align:left">
							<div class="option-item">
								<div class="navbar-btn">
									<a download href="<?php echo site_url('assets/public/Front/assets/images/Copyright-Agreement.pdf'); ?>" target="black" class="default-btn text-white"><img src="<?php echo base_url('assets/public/Front/assets/images/dwldw.ico'); ?>" style="height: 45px;">&nbsp;&nbsp; Download Copyright-Agreement form </a>
								</div>
							</div>
							</br></br></p>
							</br>
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
				
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>