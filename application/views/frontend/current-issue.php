		<?php
			$this->load->view('layout/header');
		
		?>
			
			<title>Current Issue | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="Explore the latest research in pharmaceutical sciences with the current issue of IJPS. Our journal publishes innovative research papers, reviews, and more, keeping you up-to-date with the latest developments in the field."/>
			<meta name="keywords" content="Current Issue, latest research, articles, academic publications, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/current-issue">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Current Issue | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/current-issue">
			<meta property="og:description" content="Explore the latest research in pharmaceutical sciences with the current issue of IJPS. Our journal publishes innovative research papers, reviews, and more, keeping you up-to-date with the latest developments in the field.">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			<meta property="og:type" content="article">
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
			.single-courses-box .courses-image .price {
				display: inline-block;
				background-color: #F0B9B2;
				color: #ffffff;
				width: 65px;
				height: 65px;
				border-radius: 50%;
				position: absolute;
				right: 20px;
				bottom: -32.5px;
				text-align: center;
				line-height: 65px;
				font-size: 25px;
				font-weight: 600;
				overflow:hidden;
			}

			.single-courses-box .courses-content .courses-box-footer li i {
				color: #F0B9B2;
				position: absolute;
				left: 6px;
				top: 0;
				font-size: 20px;
			}

			.single-courses-box .courses-content .courses-box-footer li {
				color: #221d48;
				font-size: 12px;
				font-weight: 700;
				position: relative;
				padding-left: 26px;
				font-weight: 700;
				padding-right: 0px;
			}

			.single-courses-box .courses-content h3 {
				margin-bottom: 15px;
				line-height: 1.5;
				font-size: 18px;
			}

			.single-courses-box .courses-image .price {
				display: inline-block;
				background-color: #F0B9B2;
				color: #ffffff;
				width: 65px;
				height: 65px;
				border-radius: 50%;
				position: absolute;
				right: 20px;
				bottom: -32.5px;
				text-align: center;
				line-height: 65px;
				font-size: 13px;
				font-weight: 600;
			}

			.single-courses-box .courses-content {
				border-radius: 0 0 5px 5px;
				padding: 30px;
				min-height: 370px;
			}

			.single-courses-box .courses-content .courses-box-footer {
				list-style-type: none;
				padding-left: 0;
				margin-bottom: 0;
				margin-left: -7px;
				margin-right: -7px;
				margin-top: 20px;
				position: absolute;
				bottom: 27px;
				left: 21px;
			}

			.courses-content p {
				-webkit-line-clamp: 4;
				display: -webkit-box;
				-webkit-box-orient: vertical;
				overflow: hidden;
			}

			.textup {
				position: absolute;
				top: 84%;
			}
			
			@media only screen and (max-width: 767px)
            {
                .dd-flex
                {
                    display: block !important;
                }
            }
			.page-numbers:hover {
    color: #fff; /* Change text color on hover */
    background-color: #007bff; /* Change background color on hover */
}
		</style>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-12 mb-2 highlightstext">
					<p class="text-left " style="colr:grey;">Highlights of <span style="color:#000"><b>Current Issue <?php echo $headerColData['year']; ?></b></span> | Vol <?php echo $headerColData['volume']; ?> | Issue <?php echo $headerColData['month']; ?></p>
				</div>
				<div class="col-lg-4 col-md-6 col-12 psylo-grid-sorting row">
					<form class="search-form"action="<?php echo site_url('searchdata'); ?>"  method="get">
						<input type="search" name="keywords" class="search-field" placeholder="Search...">
						<input type="hidden" name="flag" class="input-search" value="1">
						<button type="submit" fdprocessedid="hob8qa"><i class="bx bx-search-alt"></i></button>
					</form>
				</div>
			</div>
		</div>
		<section class="courses-area ptb-100">
			<div class="container">
				<div class="row">
				    <?php
						if(!empty($articalesResult))
						{
							for($i=0;$i<count($articalesResult);$i++)
							{
							    $urlLink = urlencode($articalesResult[$i]['titleOfPaperOne']);
							    if($urlLink==''){
							        $urlLink = str_replace(" ", "-", $articalesResult[$i]['titleOfPaper']);
							    }
							    $flag =0;
					?>
								<div class="col-lg-4 col-md-6">
									<div class="single-courses-box shadow">
										<div class="courses-image">
											<a href="<?php echo site_url('article').'/'.$urlLink; ?>">
												<img class="imgu " src="<?php echo base_url(UPLOAD_ARTICLE.$articalesResult[$i]['thumbnailImage']); ?>" alt="<?php echo $articalesResult[$i]['titleOfPaper']; ?>">
											</a>
										</div>
										<div class="courses-content position-relative">
											<div class="course-author d-flex dd-flex align-items-center">
            									<div class="authorPhotoSection1">
            									    <?php
            									        if(isset($articalesResult[$i]['authorImages']))
            									        {
            									            if(isset($articalesResult[$i]['authorImages'][2]))
            									            {
            									                $flag =1;
            									    ?>
            									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.$articalesResult[$i]['authorImages'][2]); ?>'); margin-left: 0px;"  class="authorPhotoCust"></div>
            									   <?php
            									            }
            									            
            									            if(isset($articalesResult[$i]['authorImages'][1]))
            									            {
            									                $flag =1;
            									                $css = "23px";
            									                
            									                if(count($articalesResult[$i]['authorImages'])<3)
            									                {
            									                    $css = "0px";
            									                }
            									   ?>
            									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.$articalesResult[$i]['authorImages'][1]); ?>'); margin-left: <?php echo $css; ?>;" class="authorPhotoCust"></div>
            									   <?php
            									            }
            									            
            									            if(isset($articalesResult[$i]['authorImages'][0]))
            									            {
            									                $flag =1;
            									                $css = "46px";
            									                
            									                if(count($articalesResult[$i]['authorImages'])<3)
            									                {
            									                    $css = "23px";
            									                }
            									                else if(count($articalesResult[$i]['authorImages'])<2)
            									                {
            									                    $css = "0px";
            									                }
            									   ?>
            									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.$articalesResult[$i]['authorImages'][0]); ?>'); margin-left: <?php echo $css; ?>;" class="authorPhotoCust"></div>
            									    <?php
            									            }
            									            
            									            if($flag == 0)
            									            {
            									   ?>
            									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.'default.jpg'); ?>'); margin-left: 0px;" class="authorPhotoCust"></div>
            									   <?php
            									            }
            									        }
            									    ?>
                								</div>
                								<div class="authorPhotoSection2">
            									    <span><?php echo substr($articalesResult[$i]['authorNames'], 0, 55); ?>...</span>
            									  </div>
            								</div>
											<div>
												<h3> 
													<a href="<?php echo site_url('article').'/'.$urlLink; ?>"> 
														<?php echo substr($articalesResult[$i]['titleOfPaper'], 0, 50); ?>...
													</a> 
												</h3>
												<p>
													<p><?php echo substr($articalesResult[$i]['abstract'], 0, 170); ?>...</p>
												</p>
												<div class="row justify-content-between">
                									<div class="col-sm-7 col-10 text-left lign-middle align-self-center" style=" font-size: 13px; font-weight: 700;">
                										<img src="<?php echo base_url('assets/public/Front/assets/images/doi-logo.ico'); ?>" style="width: 24px;margin-right:4px">
                										<?php echo $articalesResult[$i]['doi']; ?>
                									</div>
                									<div class="col-sm-5 col-2 float-right">
                										<a style="font-weight: 700;font-size: 13px;" class="text-right float-right" href="<?php echo base_url(UPLOAD_ARTICLE.$articalesResult[$i]['document']); ?>">
                											<img src="<?php echo base_url('assets/public/Front/assets/images/download-button.ico'); ?>" style="width: 32px;margin-right:4px">
                											<span class="d-mob-none download-now">Download Now</span></a>
                									</div>
                								</div>
											</div>
										</div>
									</div>
								</div>
					<?php
							}
						}
					?>	
					 
		        </div>
            </div>
			
			<?php echo $pagination_links;?>
		</section>
	    
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		
