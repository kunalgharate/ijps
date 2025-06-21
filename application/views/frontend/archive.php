        <?php
			$this->load->view('layout/header'); 
		?>
			
			
			<title>Archive | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="Access past issues of IJPS through our online archive. Our journal publishes high-quality research papers, reviews, and more in the field of pharmaceutical sciences, providing a valuable resource for researchers and practitioners alike."/>
			<meta name="keywords" content="Pharmaceutical Sciences Journal Archive: Research, Articles, Publications, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/archive">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Archive | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/archive">
			<meta property="og:description" content="Access past issues of IJPS through our online archive. Our journal publishes high-quality research papers, reviews, and more in the field of pharmaceutical sciences, providing a valuable resource for researchers and practitioners alike.">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@ijps__journal">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="An open access peer-reviewed journal aiming to communicate high quality original research work that contribute scientific knowledge related to the field of Pharmaceutical Sciences.">
			<meta name="twitter:image" content="<?php echo base_url('assets/public/Front/assets/images/logoup.jpg'); ?>">

		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		<style>
			.box {
				width: 150px;
				height: 50px;
				background-color: #529bd0;
				border-radius: 15px;
				border-bottom-right-radius: 0%;
				margin-bottom:15px;
			}
		</style>

		<section class="services-details-area ptb-100">
			<div class="container">
				<div class="row">
					<div class="container  ">
						<div class=" row">
							<div class=" col-lg-12 col-md-12">
								<div class="col-lg-4 col-md-6 col-12 psylo-grid-sorting row float-end ">
									<form class="search-form"action="<?php echo site_url('searchdata'); ?>"  method="get">
										<input type="search" name="keywords" class="search-field" placeholder="Search...">
										<input type="hidden" name="flag" class="input-search" value="1">
										<button type="submit" fdprocessedid="hob8qa"><i class="bx bx-search-alt"></i></button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php
						if(!empty($volumeResult))
						{
							for($i=0;$i<count($volumeResult);$i++)
							{
					?>
								<div class="col-lg-9 col-md-12">
									<div class="container mb-3">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-12">
												<div class="border-top"></div>
												<h4 class="mt-2">VOLUME <?php echo ($i+1)." - ".$volumeResult[$i]['year']; ?></h4>
												<div class="border-top"></div>
											</div>
										</div>
										<div class="row mt-3">
											<?php
												if(!empty($volumeResult[$i]['issue']))
												{
													for($j=0;$j<count($volumeResult[$i]['issue']);$j++)
													{
											?>
														<div class="col-lg-3 col-md-3 col-12">
															<div class="box position-relative">
																<a href="<?php echo site_url('issues-details')."/".$volumeResult[$i]['year']."/".$volumeResult[$i]['issue'][$j]['month']."/".($i+1); ?>" class="font-weight-bold position-absolute top-50 start-50 translate-middle text-light">Issue <?php echo $volumeResult[$i]['issue'][$j]['month']; ?></a>
															</div>
														</div>
											<?php
													}
												}
											?>
										</div>
									</div>
								</div>
					<?php
							}
						}
					?>
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