		<?php
			$this->load->view('layout/header');
		?>
			
		<?php
			if(!empty($singleBlogDetailsResult))
			{
			    $urlLink = str_replace(" ", "-", $singleBlogDetailsResult[0]['title']);
		?>	
			<title><?php echo $singleBlogDetailsResult[0]['title']; ?></title>
			<meta name="description" content="<?php echo $singleBlogDetailsResult[0]['title']; ?>">
			<link rel="canonical" href="<?php echo site_url('blog').'/'.$urlLink; ?>" />
			<meta name="keywords" content="How to, Pharma blog, Pharma News, Medical News, Health News, Health Blog">
			<meta name="citation_publisher" content="IJPS Journal"/>
			<meta name="citation_journal_title" content="International Journal of Pharmaceutical Sciences">
			<meta name="citation_title" content="<?php echo $singleBlogDetailsResult[0]['title']; ?>">
			
			<meta property="og:site_name" content="IJPS Journal Blog">
            <meta property="og:type" content="Blog website">
            <meta property="og:url" content="<?php echo site_url('blog').'/'.$urlLink; ?>" />
            <meta property="og:title" content="<?php echo $singleBlogDetailsResult[0]['title']; ?>" />
            <meta property="og:description" content="<?php echo $singleBlogDetailsResult[0]['title']; ?>" />
            <meta property="article:author" content="IJPS Journal" />
            <meta property="og:image" content="<?php echo base_url(UPLOAD_BLOG.$recentPostResult[0]['thumbnailImage']); ?>">
            
            <meta name="twitter:card" content="<?php echo base_url(UPLOAD_BLOG.$recentPostResult[0]['thumbnailImage']); ?>">
            <meta name="twitter:site" content="@int_j_pharm_sci">
            <meta name="twitter:title" content="<?php echo $singleBlogDetailsResult[0]['title']; ?>" />
            <meta name="twitter:description" content="<?php echo $singleBlogDetailsResult[0]['title']; ?>" />
            <meta name="twitter:image" content="<?php echo base_url(UPLOAD_BLOG.$singleBlogDetailsResult[0]['bannerImage']); ?>">
            
            <meta property="og:title" content="<?php echo $singleBlogDetailsResult[0]['title']; ?>" />
            <meta property="og:description" content="<?php echo $singleBlogDetailsResult[0]['title']; ?>" />
            <meta property="og:image" content="<?php echo base_url(UPLOAD_BLOG.$recentPostResult[0]['thumbnailImage']); ?>">
            <meta property="og:url" content="<?php echo site_url('blog').'/'.$urlLink; ?>">
            <meta name="author" content="IJPS Journal">
            <meta name="copyright" content="Copyright © 2024 International Journal of Pharmaceutical Sciences. All rights reserved.">
		<?php
			}
			else
			{
		?>
		        <title>How to Publish Your Research in a Pharmaceutical Journal</title>
    			<meta name="description" content="If you're a researcher in the pharmaceutical field, publishing your work in a reputable journal can help you gain recognition and advance your career. However, the process of submitting and publishing a paper can be daunting. This guide will walk you through the steps to successfully publish your research in a pharmaceutical journal.">
    			<link rel="canonical" href="https://www.ijpsjournal.com/blog/How-to-Publish-Your-Research-in-a-Pharmaceutical-Journal" />
    			<meta name="keywords" content="Publish research, pharmaceutical journal, academic writing, research publication, scientific writing tips, manuscript submission, scholarly communication">
    			<meta name="citation_publisher" content="IJPS Journal"/>
    			<meta name="citation_journal_title" content="International Journal of Pharmaceutical Sciences">
    			<meta name="citation_title" content="How to Publish Your Research in a Pharmaceutical Journal">
		<?php
			}
		?>
			
		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		
		<div class="blog-details-area ptb-100 mb-5">
			<div class="container">
			<div class="row">
					<div class="col-lg-8 col-md-12 mb-5">
						<div class="blog-details-desc">
							<div class="article-content">
								<?php
									if(!empty($singleBlogDetailsResult))
									{
								?>
										<div class="title-box">

											<h3><?php echo $singleBlogDetailsResult[0]['title']; ?></h3>

											<div class="entry-meta">
												<ul>
													<li><i class="flaticon-calendar"></i> <a href="#">Added on <?php echo date('M Y', strtotime($singleBlogDetailsResult[0]['createdDate'])); ?></a></li>
													
												</ul>
											</div>
										</div>

										<div class="article-image col-lg-6 rounded mb-3">
											<center>
												<img src="<?php echo base_url(UPLOAD_BLOG.$singleBlogDetailsResult[0]['bannerImage']); ?>" class="rounded" alt="image">
											</center>
										</div>
										<?php echo $singleBlogDetailsResult[0]['description']; ?>
										
								<?php
									}
									else
									{
								?>
										<div class="title-box">
											<h3>NO Data Found</h3>
										</div>
								<?php
									}
								?>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12">
						<div class="psylo-grid-sorting row float-end1">
							<form class="search-form"action="<?php echo site_url('searchdata'); ?>"  method="get">
								<input type="search" name="keywords" class="search-field" placeholder="Search...">
								<input type="hidden" name="flag" class="input-search" value="2">
								<button type="submit" fdprocessedid="hob8qa"><i class="bx bx-search-alt"></i></button>
							</form>
						</div>
						<div class="services-details-info blogright">
							<strong>Recent Posts</strong>
							<ul class="services-list mt-2">
								<?php
									if(!empty($recentPostResult))
									{
										for($i=0;$i<count($recentPostResult);$i++)
										{
										    $urlLink = str_replace(" ", "-", $recentPostResult[$i]['title']);
								?>
											<li class="nav-item">
												<a href="<?php echo site_url('blog').'/'.$urlLink; ?>" class="nav-link">
													<div class="row">
														<div class="col-lg-3 col-md-12 p-0 mobw-25">
															<img src="<?php echo base_url(UPLOAD_BLOG.$recentPostResult[$i]['thumbnailImage']); ?>" alt="image">
														</div>
														<div class="col-lg-9 col-md-12 mobw-75">
															<?php echo $recentPostResult[$i]['title']; ?>
														</div>
													</div>
												</a>
											</li>
								<?php
										}
									}
								?>
								
							</ul>
						</div>
						<div class="services-details-info blogright">
							<strong>Categories</strong>
							<ul class="services-list mt-2">
								<?php
									if(!empty($blogCategoriesResult))
									{
										for($i=0;$i<count($blogCategoriesResult);$i++)
										{
								?>
											<li class="nav-item">
												<a href="<?php echo site_url('blogs-categorywise')."/".$blogCategoriesResult[$i]['blogCategoryID']; ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>
													<?php echo $blogCategoriesResult[$i]['blogCategoryName']; ?>
												</a>
											</li>
								<?php
										}
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>