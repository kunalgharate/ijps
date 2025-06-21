		<?php
			$this->load->view('layout/header');
		?>
			
			<title>International Journal of Pharmaceutical Sciences | Open Access</title>
			<meta name="description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences"/>
			<meta name="keywords" content="International J Pharm Sci, Current issue, Pharmaceutical Sciences, ijps in press, Pharmacology, IJPS journal, Pharmaceutics, Biotechnology"/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="International Journal of Pharmaceutical Sciences">
			<meta property="og:site_name" content="ijpsjournal" >
			<meta property="og:url" content="https://www.ijpsjournal.com/">
			<meta property="og:description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences">
			<meta property="og:type" content="article">
			<meta property="og:image" content="https://www.ijpsjournal.com/assets/public/Front/assets/images/logoup.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@int_j_pharm_sci">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences.">
			<meta name="twitter:image" content="https://www.ijpsjournal.com/assets/public/Front/assets/images/logoup.jpg">
			
		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		
		<section class="services-details-area ptb-100">
			<div class="container ">
				<div class="row">
					<div class="col-lg-9 col-md-12">
						<div class="services-details-desc">
							<div class="content-image text-center">
								<img src="<?php echo base_url('assets/public/Front/assets/images/RCPB.webp'); ?>" alt="image" style="width:500px;">
							</div>
							<p>Terms and Conditions of our journals have to be accepted by the Author during Initial Submission and Final Submission. The author is already given ample time to consider publishing with us or not before making Payment or Final Submission. Journal performs all the process promptly and on time for which it has to pay the cost too and bear the expenses. An author may withdraw the paper if having proper reasons and our journals will have no objection if said withdrawn article is published somewhere else.

								No Refund will be issued if the Author wishes to cancel the publication with us after completing Payment and Final Submission / After the Publication process is completed.
							</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-12">
						<div class="services-details-info">
							<ul class="services-list mt-2">
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