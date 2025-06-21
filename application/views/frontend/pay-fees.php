		<?php
			$this->load->view('layout/header');
		?>
			<title>International Journal of Pharmaceutical Sciences | Open Access</title>
			<meta name="description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences"/>
			<meta name="keywords" content="International J Pharm Sci, Current issue, Pharmaceutical Sciences, ijps in press, Pharmacology, IJPS journal, Pharmaceutics, Biotechnology"/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/pay-fees">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="International Journal of Pharmaceutical Sciences">
			<meta property="og:site_name" content="ijpsjournal" >
			<meta property="og:url" content="https://www.ijpsjournal.com/pay-fees">
			<meta property="og:description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences">
			<meta property="og:type" content="article">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@int_j_pharm_sci">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences.">
			<meta name="twitter:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			
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
							<h5>APC – Article Processing Charge includes:</h5>
							<p>****************************************************************************</p>
							<p class="color-text" style="text-align:justify">
								<li>Publication of one entire research paper</li>
								<li>Certificate of publication to authors of paper.</li>
								<li>DOI for Article</li>
								<li>Editorial Fee</li>
								<li>Indexing, maintenance of link revolvers and journal infrastructures.</li>
							</p>
							<h5>Article Processing Charge (including DOI & Certificate)</h5>
							<p>
								<b>For Indian Author : ₹ 1299 <br>
								For International Author : $25 <br></b>
							</p>
							<p>****************************************************************************</p>
							<h4>Online Payment gateway for Indian Author</h4>
							<p>You can pay fees through Razorpay by Net Banking / Credit Card / Debit Card / UPI by following Link</p>
							<div class="option-item mb-3">
								<div class="navbar-btn">
									<a href="<?php echo base_url('pay-fees/indian')?>" class="default-btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pay Fee</a>
								</div>
							</div>
							<h4>Online Payment gateway for International Author (other than India)</h4>
							<p>You can pay fees through Razorpay by Net Banking / Credit Card / Debit Card / VISA / Mastercard by following Link</p>
							<div class="option-item">
								<div class="navbar-btn">
									<a href="<?php echo base_url('pay-fees/international')?>" class="default-btn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pay Fee</a>
								</div>
							</div>
							</br></br>
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
								<li class="nav-item">
									<a href="https://scholar.google.com/citations?user=EFRTG5YAAAAJ&hl=en&authuser=1" class="nav-link" target="_BLANK">
										<img src="<?php echo base_url('assets/public/Front/assets/images/googlescholar.png'); ?>" alt="image" style="width:600px;">
									</a>
								</li>
								<li class="nav-item">
									<a class="twitter-timeline" data-height="250" href="https://twitter.com/int_j_pharm_sci"></a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>