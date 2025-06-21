		<?php
			$this->load->view('layout/header');
		?>
		    <title>Plagiarism Policy | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="At IJPS, we take plagiarism seriously. Our policy ensures all submitted manuscripts are thoroughly screened, using advanced software to detect any instances of plagiarism, and rejected if found"/>
			<meta name="keywords" content="Plagiarism policy, academic integrity, research ethics, original content, citation standards, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/plagiarism-policy">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Plagiarism Policy | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/plagiarism-policy">
			<meta property="og:description" content="At IJPS, we take plagiarism seriously. Our policy ensures all submitted manuscripts are thoroughly screened, using advanced software to detect any instances of plagiarism, and rejected if found">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/know%20about%20us.jpg">
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
							<div class="content-image text-center">
								<img src="<?php echo base_url('assets/public/Front/assets/images/pp.png'); ?>" alt="image" style="width:500px;">
							</div>
							<p class="color-text">Taking credit for the ideas and work of others without proper attribution is both unethical and deceitful. It is important to avoid any form of plagiarism, whether it involves copying even a single sentence from another manuscript or reusing your own previously published work without appropriate citation. Instead, always strive to express concepts using your own words.</p>

							<p class="color-text">Authors have a responsibility to ensure the originality of their manuscript content during the drafting process. If any part of the work or the words of others have been used, it must be appropriately cited or quoted. To maintain the integrity of the publication, all articles submitted to IJPS undergo thorough plagiarism screening. If plagiarism is detected at any stage of the review or editorial process, the affected manuscript(s) will be promptly rejected. In cases where plagiarism is discovered after publication, the corresponding manuscript(s) will be retracted from the journal, and an official announcement will be made regarding this action. Depending on the severity of the case, appropriate measures may be taken against the authors, including barring them from future publication opportunities. Instances of plagiarism can also be brought to the attention of the authors' funding agencies, their affiliated institutions, and the original authors whose work has been plagiarized.</p></br>
						</div>
					</div>
					<div class="col-lg-3 col-md-12">
						<div class="services-details-info">
							<ul class="services-list mt-2">
								<li class="nav-item">
									<a href="<?php echo site_url('check-plagarism'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Check Plagiarism</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('about-us'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>About Us</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('plagiarism-policy'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Plagiarism Policy</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('open-access-policy'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Open Access Policy</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('privacy-policy'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Privacy Policy</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('terms-and-conditions'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Terms of Service</a>
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