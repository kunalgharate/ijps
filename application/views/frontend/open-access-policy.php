		<?php
			$this->load->view('layout/header');
		?>
			<title>Open Access Policy | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="At IJPS, we believe in open access to scientific knowledge. Our policy ensures that all published articles are freely available to readers, promoting global collaboration and advancement in the scientific community."/>
			<meta name="keywords" content="Open Access Policy, research articles, publications, academic content, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/open-access-policy">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Open Access Policy | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/open-access-policy">
			<meta property="og:description" content="At IJPS, we believe in open access to scientific knowledge. Our policy ensures that all published articles are freely available to readers, promoting global collaboration and advancement in the scientific community.">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
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
								<img src="<?php echo base_url('assets/public/Front/assets/images/oap.png'); ?>"  alt="image" style="width:500px;">
							</div>
							<p class="color-text">
								IJPS provides immediate free access to its content on the principle that making research freely available to the public supports a greater global exchange of knowledge, meaning:
								<ul>
									<li>Everyone has free and unlimited access to the full-text of articles published in <a href="<?php echo site_url(); ?>">IJPS</a>; manuscripts are freely available without subscription or price barriers.</li>
									<li>Open Access publication is supported by authors' institutes or research funding agency by payment of a comparatively low Article Processing Fee (APF) for accepted articles.</li>
									<li>Open Access publication is more frequently cited due to their high publicity and availability.</li>
									<li>Articles can be shared and adapted, provided the attribution for the work is given and that the work is not used for commercial purposes.</li>
								</ul>
								The open access policy of the IJPS aims at increasing the visibility and accessibility of the published content. Online free access and listing and indexing in a larger number of bibliographic databases add to the high visibility and research impact.
							</p>
							</br>
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