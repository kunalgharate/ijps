		<?php
			$this->load->view('layout/header');
		?>
			<title>Search Article | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="Explore the latest research in pharmaceutical sciences with the current issue of IJPS. Our journal publishes innovative research papers, reviews, and more, keeping you up-to-date with the latest developments in the field."/>
			<meta name="keywords" content="Search Article, latest research, articles, Research paper, Review Articles, academic publications, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/current-issue">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Search Article | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
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
		</style>
        <div class="container">
    <div class="row">
        <div class="col-md-8 col-12 mb-2 highlightstext">
        </div>
        <div class="col-lg-4 col-md-6 col-12 psylo-grid-sorting row">
            <form class="search-form" action="<?php echo site_url('searchdata'); ?>" method="get">
                <input type="search" name="keywords" class="search-field" placeholder="Search...">
                <input type="hidden" name="flag" class="input-search" value="0">
                <button type="submit" fdprocessedid="hob8qa"><i class="bx bx-search-alt"></i></button>
            </form>
        </div>
    </div>
</div>

<section class="courses-area ptb-100111">
    <div class="container">
        <?php
        if($data['flag'] != 2 && $data['flag'] != 3) {
        ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="border-top"></div>
                <h5 class="mt-2">Articles</h5>
                <div class="border-top"></div>
            </div>
        </div>

        <div class="row mt-4">
            <?php
            $articalesResult = $data['article'];

            if (!empty($articalesResult)) {
                for ($i=0; $i < count($articalesResult); $i++) {
                    // Use urlencode to replace spaces with "+"
                    $urlLink = urlencode($articalesResult[$i]['titleOfPaper']);
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="single-courses-box shadow">
                    <div class="courses-image">
                        <a href="<?php echo site_url('article') . '/' . $urlLink; ?>">
                            <img class="imgu" src="<?php echo base_url(UPLOAD_ARTICLE . $articalesResult[$i]['thumbnailImage']); ?>" alt="image">
                        </a>
                    </div>
                    <div class="courses-content position-relative">
                        <div class="course-author d-flex dd-flex align-items-center">
                            <div class="authorPhotoSection1">
                                <?php
                                if (isset($articalesResult[$i]['authorImages'])) {
                                    if (isset($articalesResult[$i]['authorImages'][2])) {
                                ?>
                                    <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS . $articalesResult[$i]['authorImages'][2]); ?>'); margin-left: 0px;" class="authorPhotoCust"></div>
                                <?php
                                    }

                                    if (isset($articalesResult[$i]['authorImages'][1])) {
                                ?>
                                    <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS . $articalesResult[$i]['authorImages'][1]); ?>'); margin-left: 23px;" class="authorPhotoCust"></div>
                                <?php
                                    }

                                    if (isset($articalesResult[$i]['authorImages'][0])) {
                                ?>
                                    <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS . $articalesResult[$i]['authorImages'][0]); ?>'); margin-left: 46px;" class="authorPhotoCust"></div>
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
                                <a href="<?php echo site_url('article') . '/' . $urlLink; ?>">
                                    <?php echo $articalesResult[$i]['titleOfPaper']; ?>
                                </a>
                            </h3>
                            <p><?php echo $articalesResult[$i]['abstract']; ?></p>
                            <div class="row justify-content-between">
                                <div class="col-sm-7 col-10 text-left lign-middle align-self-center" style=" font-size: 13px; font-weight: 700;">
                                    <img src="<?php echo base_url('assets/public/Front/assets/images/doi-logo.ico'); ?>" style="width: 24px;margin-right:4px">
                                    <?php echo $articalesResult[$i]['doi']; ?>
                                </div>
                                <div class="col-sm-5 col-2 float-right">
                                    <a style="font-weight: 700;font-size: 13px;" class="text-right float-right" href="<?php echo base_url(UPLOAD_ARTICLE . $articalesResult[$i]['document']); ?>">
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
            } else {
            ?>
            <div class="title-box text-center">
                <h6>No Data Found</h6>
            </div>
            <?php
            }
            ?>
        </div>
        <?php
        }
        
        if ($data['flag'] != 1 && $data['flag'] != 3) {
        ?>

			    <div class="row mt-4">
					<div class="col-lg-12 col-md-12 col-12">
						<div class="border-top"></div> 
						<h5 class="mt-2">Blogs</h5>
						<div class="border-top"></div>
					</div>
				</div>
		        <div class="row mt-4">
					<?php
					    
					    $blogResult = $data['blog'];
					    
						if(!empty($blogResult))
						{
							for($i=0;$i<count($blogResult);$i++)
							{
					?>
							<div class="col-lg-4 col-md-6">
								<div class="single-blog-item">
									<div class="blog-image">
										<a href="<?php echo site_url('blog-details').'/'.$blogResult[$i]['blogID']; ?>">
											<img src="<?php echo base_url(UPLOAD_BLOG.$blogResult[$i]['thumbnailImage']); ?>" alt="image">
										</a>
										
									</div>
									<div class="blog-content">
										<h6>
											<a href="<?php echo site_url('blog-details'); ?>"><?php echo $blogResult[$i]['title']; ?></a>
										</h6>
										<div class="mb-3 mt-3">
											<p>
												<?php echo $blogResult[$i]['shortDescription']; ?>
											</p>
										</div>
										<div class="blog-btn">
											<a href="<?php echo site_url('blog-details').'/'.$blogResult[$i]['blogID']; ?>" class="default-btn">Read More <i class="flaticon-plus"></i></a>
										</div>
									</div>
								</div>
							</div>
					<?php
							}
						}
						else
						{
					?>
							<div class="title-box text-center">
								<h6>No Data Found</h6>
							</div>
					<?php
						}
					?>
				</div>
				<?php
			        }
			        
			        if($data['flag'] != 1 && $data['flag'] != 2)
			        {
			    ?>
			    <div class="row mt-4">
					<div class="col-lg-12 col-md-12 col-12">
						<div class="border-top"></div> 
						<h5 class="mt-2">Newsletters</h5>
						<div class="border-top"></div>
					</div>
				</div>
				<div class="row mt-4">
					<?php
					    
					    $newsletterResult = $data['newsletter'];
					    
						if(!empty($newsletterResult))
						{
							for($i=0;$i<count($newsletterResult);$i++)
							{
					?>
								<div class="col-lg-4 col-md-6">
									<div class="single-blog-item">
										<div class="blog-image">
											<a href="<?php echo $newsletterResult[$i]['link']; ?>" target="_blank">
												<img src="<?php echo base_url(UPLOAD_NEWSLETTER.$newsletterResult[$i]['thumbnailImage']); ?>" alt="IJPS Journal">
											</a>
											<div class="tag" style="width: 80px;height:77px;"> <?php echo date('d M', strtotime($newsletterResult[$i]['createdDate'])); ?></div>
										</div>
										<div class="blog-content">
											<div class="meta">
												<p>
													<small>
													</small>
												</p>
											</div>
											<h6 class="newslettertitle">
												<a href="<?php echo $newsletterResult[$i]['link']; ?>">
													<?php echo $newsletterResult[$i]['title']; ?>
												</a>
											</h6>
											<div class="mb-3 mt-3">
												<p><?php echo $newsletterResult[$i]['description']; ?></p>
											</div>
											<div class="blog-btn">
												<a href="<?php echo $newsletterResult[$i]['link']; ?>" target="_blank" class="default-btn">Read More <i class="flaticon-plus"></i></a>
											</div>
										</div>
									</div>
								</div>
								
					<?php
							}
						}
						else
						{
					?>
							<div class="title-box text-center">
								<h6>No Data Found</h6>
							</div>
					<?php
						}
					?>
				</div>
				<?php
			        }
			    ?>
            </div>
		</section>
        <hr class="m-10">
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>