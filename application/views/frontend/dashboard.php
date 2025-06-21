		<?php
			$this->load->view('layout/header');
		?>
			
			<title>Dashboard | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="Authors can easily check the status of their paper submission at IJPS, including the review stage and estimated publication timeline, using our online system."/>
			<meta name="keywords" content="Model Manuscript, research article template, writing example, publication format, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/dashboard">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="DAshboard | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/dashboard">
			<meta property="og:description" content="Authors can easily login and check status of their paper submission at IJPS, including the review stage and estimated publication timeline, using our online system.">
			<meta property="og:image" content="https://ijpsjournal.com/public/Front/assets/images/asa.gif">
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
				    <div class="col-lg-3 col-md-12">
				        <section class="contact-area">
							<div class="container">
        				        <div class="services-details-info pt-4">
        				            
        				            <?php
    	                            ?>
                                        <div class="row">
				                            <div class="col-3">
												
												<img src="<?php echo base_url('assetsbackoffice/uploads/author/').$_SESSION['profilePhoto']; ?>">
                                               
												
                                            </div>
                                            <div class="col-9">
                                    <?php
                                            echo "<h5>".$this->session->userdata('name')."</h5>";
                                            echo $this->session->userdata('authorMailID')."<br>";
                                            echo $this->session->userdata('contactNumber')."<br>";
                                    ?>
                                        </div>
                                    </div>
        				        </div>
        				        <hr>
        						<div class="services-details-info pb-4">
        							<ul class="services-list mt-2">
        								<li class="nav-item">
        								
        									<a href="<?php echo site_url('dashboard'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Dashboard</a>
        								</li>
        								<li class="nav-item">
        									<a href="<?php echo site_url('submit-manuscript'); ?>" class="nav-link" target="_blank"><i class="bx bxs-chevron-right"></i>Submit New Manuscript</a>
        								</li>
        								<li class="nav-item">
        									<a href="<?php echo site_url('manuscript-list'); ?>" class="nav-link" target="_blank"><i class="bx bxs-chevron-right"></i>Submited Manuscripts</a>
        								</li>
        								<li class="nav-item">
        									<a href="<?php echo site_url('login/signOut'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Logout</a>
        								</li>
        							</ul>
        						</div>
        					</div>
        				</section>
        			</div>
					<div class="col-lg-9 col-md-12">
						<div class="services-details-desc">
						    <div class="about-main-content">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="about-information">
                                            <i class="flaticon-medal" style="height: 60px; width: 60px;"></i>
                                            <h6><?php echo $submittedCount; ?> Manuscripts</h6>
                                            <span>Submitted</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="about-information">
                                            <i class="flaticon-trophy" style="height: 60px; width: 60px;"></i>
                                            <h6><?php echo $publishedCount; ?> Manuscripts</h6>
                                            <span>Published</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="about-information">
                                            <i class="flaticon-customer"></i>
                                            <h6><?php echo $pendingCount; ?> Manuscripts</h6>
                                            <span>Pending</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
					
				</div>
			</div>
		</section>
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>