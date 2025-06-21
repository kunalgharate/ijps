		<style>
			table{
				--bs-table-bg: transparent;
				--bs-table-striped-color: #212529;
				--bs-table-striped-bg: rgba(0, 0, 0, 0.05);
				--bs-table-active-color: #212529;
				--bs-table-active-bg: rgba(0, 0, 0, 0.1);
				--bs-table-hover-color: #212529;
				--bs-table-hover-bg: rgba(0, 0, 0, 0.075);
				/* width: 100%; */
				margin-bottom: 1rem;
				color: #212529;
				vertical-align: top;
				border-color: #dee2e6;
			}
			td{
				border-width: 1px !important;
    			padding: 5px;
			}
			
			span{
				    font-family: montserrat, sans-serif !important;
                	font-size: 15px !important;
                    /*font-weight: 400 !important;*/
                    color: #212529 !important;
				}
		</style>
		<?php
			$this->load->view('layout/header'); 
		

			
			$authorName = $articalResult['authorsNameList'];
			$authorsNames = explode(",", $authorName);
			
			$keywords = $articalResult[0]['keywords'];
			$keywords = explode(",", $keywords);
		
						
            // $urlLink = str_replace(" ", "-", $articalResult[0]['titleOfPaper']);				
		
			
        	$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url_parts = explode("article/", $actual_link);
            if (count($url_parts) > 1) {
                $urlLink = $url_parts[1];
            } 
		?>
			
			
			<title><?php echo $articalResult[0]['titleOfPaper']; ?></title>
			<meta name="description" content="<?php echo $articalResult[0]['abstract']; ?>">
			<link rel="canonical" href="<?php echo site_url('article').'/'.$urlLink; ?>" />
			
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ScholarlyArticle",
  "headline": "<?php echo htmlspecialchars($articalResult[0]['titleOfPaper']); ?>",
  "description": "<?php echo htmlspecialchars(substr(trim($articalResult[0]['abstract']), 0, 160)); ?>",
  "author": [
    <?php foreach($articalResult['authors'] as $index => $author): ?>
    {
      "@type": "Person",
      "name": "<?php echo htmlspecialchars($author['name']); ?>",
      "affiliation": "<?php echo htmlspecialchars($author['affiliation']); ?>"
    }<?php if($index !== count($articalResult['authors'])-1) echo ','; ?>
    <?php endforeach; ?>
  ],
  "publisher": {
    "@type": "Organization",
    "name": "IJPS Journal",
    "logo": "https://www.ijpsjournal.com/assetsbackoffice/uploads/logo/favicon.png"
  },
  "citation": "APA/MLA citation here",
  "identifier": {
    "@type": "PropertyValue",
    "propertyID": "DOI",
    "value": "<?php echo $articalResult[0]['doi']; ?>"
  },
  "datePublished": "<?php echo date('c', strtotime($articalResult[0]['createdDate'])); ?>",
  "image": "<?php echo base_url(UPLOAD_ARTICLE.$articalResult[0]['thumbnailImage']); ?>"
}
</script>	

			<meta name="dc.title" content="<?php echo $articalResult[0]['titleOfPaper']; ?>" />

			<meta name="dc.creator" content="<?php echo $articalResult['authorsNameList']; ?>" />
			<meta name="keywords" content="<?php echo $articalResult[0]['keywords']; ?>" />

            <meta name="dc.subject" content="<?php echo $articalResult[0]['keywords']; ?>" />
            <meta name="dc.description" content="<?php echo $articalResult[0]['abstract']; ?>" />
            <meta name="dc.date" content="<?php echo date('d-m-Y', strtotime($articalResult[0]['createdDate']));?>" />
            <meta name="DC.Source.Issue" content="<?php echo substr($articalResult[0]['uniqueCode'], 4, 2); ?>">
            <meta name="DC.Source.Volume" content="<?php echo substr($articalResult[0]['uniqueCode'], 2, 2); ?>">            
            <meta name="DC.Identifier.URI" content="<?php echo base_url(UPLOAD_ARTICLE.$articalResult[0]['document']); ?>">
            <meta name="DC.Source.URI" content="<?php echo site_url('article').'/'.$urlLink; ?>">
            <meta name="dc.type" content="Text" />
            <meta name="dc.format" content="text/html" />
            <meta name="dc.identifier" content="<?php echo $articalResult[0]['doi']; ?>" />
            <meta name="dc.article_type" content="<?php echo $articalResult[0]['articalTypeName']; ?>" />
            <meta name="dc.language" content="en" />
            <meta name="dc.publisher" content="IJPS Journal" />
            <meta name="dc.relation" content="https://www.ijpsjournal.com/" />
            <meta name="dc.coverage" content="World" />
            <meta name="dc.rights" content="Copyright © 2025 International Journal of Pharmaceutical Sciences. All rights reserved." />

			<meta name="citation_publisher" content="IJPS Journal"/>
			<meta name="citation_journal_title" content="International Journal of Pharmaceutical Sciences">
			<meta name="citation_title" content="<?php echo $articalResult[0]['titleOfPaper']; ?>">
			<meta name="citation_author" content="<?php echo $articalResult['authorsNameList']; ?>"/>
			<meta name="citation_year" content="<?php echo date('Y', strtotime($articalResult[0]['createdDate']));?>">
			<meta name="citation_volume" content="<?php echo substr($articalResult[0]['uniqueCode'], 2, 2); ?>">
			<meta name="citation_issue" content="<?php echo substr($articalResult[0]['uniqueCode'], 4, 2); ?>">
			<meta name="citation_doi" content="<?php echo $articalResult[0]['doi']; ?>">
			<meta name="citation_issn" content="0975-4725"/>
			<meta name="citation_publication_date" content="<?php echo date('d-m-Y', strtotime($articalResult[0]['createdDate']));?>"/>
			<meta name="citation_abstract" content="<?php echo $articalResult[0]['abstract']; ?>">
			<meta name="citation_fulltext_html_url" content="<?php echo site_url('article').'/'.$urlLink; ?>">
			<meta name="citation_pdf_url" content="<?php echo base_url(UPLOAD_ARTICLE.$articalResult[0]['document']); ?>">
			<meta name="citation" content="<?php echo $articalResult[0]['citation']; ?>">
            
            <meta property="og:image:width" content="500">
            <meta property="og:image:height" content="500">
            <meta property="og:site_name" content="IJPS Journal">
            <meta property="og:type" content="website">
            <meta property="og:url" content="<?php echo site_url('article').'/'.$urlLink; ?>" />
            <meta property="og:title" content="<?php echo $articalResult[0]['titleOfPaper']; ?>" />
            <meta property="og:description" content="<?php echo $articalResult[0]['abstract']; ?>" />
            <meta property="article:author" content="<?php echo $articalResult['authorsNameList']; ?>" />
            <meta property="og:image" content="<?php echo base_url(UPLOAD_ARTICLE.$articalResult[0]['thumbnailImage']); ?>">
            
            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:site" content="@int_j_pharm_sci">
            <meta name="twitter:title" content="<?php echo $articalResult[0]['titleOfPaper']; ?>" />
            <meta name="twitter:description" content="<?php echo $articalResult[0]['abstract']; ?>" />
            <meta name="twitter:image" content="<?php echo base_url(UPLOAD_ARTICLE.$articalResult[0]['thumbnailImage']); ?>">
            <meta name="copyright" content="Copyright © 2025 International Journal of Pharmaceutical Sciences. All rights reserved.">
            
            <style>
            p {
                    font-family: montserrat, sans-serif;
                    font-size: 15px;
                    font-weight:400;
                    color: #212529;
                }
                </style>

		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		<section class="courses-details-area ptb-100">
			<style>
				.__dimensions_badge_embed__ .__dimensions_png {
					position: relative !important;
					text-align: center;
					top: 0;
					left: 0;
					bottom: 0;
					right: 0;
					opacity: 0;
					max-width: 100%;
				}

				.instructor-content {
					margin-bottom: 26px;
				}

				.author_img {
					border-radius: 16px;
				}
				
				@media only screen and (max-width: 767px)
                {
    				.author_details_s h5
    				{
    				    font-size: 1.02rem;
    				    margin-bottom: 0px;
    				}
    				
    				.instructor-image img {
                        vertical-align: baseline !important;
                    }
                    
                    #secoundSection
                    {
                        margin-top: -25px !important;
                        padding-top: 0px !important;
                    }
                    
                    .courses-details-info .courses-share .share-info .social-link li a i {
                        display: inline-block;
                        width: 35px;
                        height: 35px;
                        line-height: 35px;
                    }
                    
                    #secoundSectionMob
                    {
                        padding-top: 0px !important;
                        margin-top: -20px !important;   
                    }
                }
			</style>
			
	<style>
		.page-banner-with-full-image::before, .page-banner-with-full-image {
			border-radius: 30px;
		}
	</style>
	<div class="container">
		<div class="page-banner-with-full-image item-bg4">
			<div class="page-banner-content-two">
				<!--<h2><?php echo $headerData['firstHeading']; ?></h2>-->
				<h2>View Article</h2>
				<ul>
					<li>
						<a href="<?php echo site_url(); ?>">Home</a>
					</li>
					<?php
						if(isset($headerData['thirdHeading']))
						{
					?>
							<li><a href="<?php echo site_url('blogs'); ?>"><?php echo $headerData['secoundHeading']; ?></a></li>
							<li><?php echo $headerData['thirdHeading']; ?></li>
					<?php
						}
						else
						{
					?>
							<li><?php echo $headerData['secoundHeading']; ?></li>
					<?php				
						}
					?>
					
				</ul>
			</div>
		</div>
	</div>
	
	<?php //print_r($articalResult); die; ?>
	
			<div class="pb-5">
			    <?php //echo "<pre>";print_r($articalResult);echo "</pre>"; ?>
				<div class="container pb-5">
					<div class="courses-details-image">
						<div class="mb-3">
							<ul class="list-unstyled">
								<li class="mb-1" style="font-weight: 500;"><?php echo $articalResult[0]['articalTypeName']; ?> | Open Access</li>
								
								<li> Volume <?php echo substr($articalResult[0]['uniqueCode'], 2, 2); ?> | Issue <?php echo date("m", strtotime($articalResult[0]['createdDate'])); ?> | <a href="#" style="color:#529bd0;font-weight: 500;">Article Id IJPS/<?php echo $articalResult[0]['uniqueCode']; ?></a></li>
							</ul>
						</div>
						<div class="">
							<ul class="list-unstyled">
								<li class="mb-1">
									<h1 class="text-dark singlearticletitle" itemprop="headline"><?php echo $articalResult[0]['titleOfPaper']; ?></h1>
								</li>
								
								
								<li>
								    <div class="courses-content position-relative my-3">
        								<div class="course-author d-flex1 align-items-center">
        									<?php
        									    for($i=0; $i<count($articalResult['authors']); $i++)
        									    {
        									        $sign = "";
        									        if($articalResult['authors'][$i]['designationID'] == '1')
        									        {
        									            $sign = "*";
        									        }
        									?>

        									        
        									        
        									        <span style="padding-right: 15px;"> 
        									            <a href="#" style="color:#529bd0;font-weight: 500; margin-top:10px;" class="">
        									                <?php if($articalResult['authors'][$i]['authorPhoto']==''){ ?>
        									                <img src="https://www.ijpsjournal.com/assetsbackoffice/uploads/author/default.jpg" class="rounded-circle author-photo" alt="Photo" style="margin-right: 10px;">
        									                
        									               <?php }else{ ?>
        									               <img src="<?php echo base_url(UPLOAD_AUTHORS.$articalResult['authors'][$i]['authorPhoto']); ?>" class="rounded-circle author-photo" alt="Photo" style="margin-right: 10px;">
        									               
        									              <?php } ?>
        									                
        									                
        									                <?php echo $articalResult['authors'][$i]['name'].$sign; ?> <sup><?php echo $articalResult['authors'][$i]['superscript_number']; ?></sup>
        									            </a>
        									       </span>

        									<?php
        									    }
        									?>
        								</div>
        							</div>
								</li>
								<li>
									<small class="ptb-5">
										<?php echo $articalResult[0]['affiliation']; ?>
									</small>
								</li>
							</ul>
						</div>
					</div>
					<div class="row" style="margin-top: -41px;">
						<div class="col-lg-8 col-md-12">
							<div class="courses-details-desc">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item"><a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview">Abstract</a></li>
									<li class="nav-item"><a class="nav-link" id="curriculum-tab" data-bs-toggle="tab" href="#curriculum" role="tab" aria-controls="curriculum">View Article</a></li>
									<li class="nav-item"><a class="nav-link" id="instructor-tab" data-bs-toggle="tab" href="#instructor" role="tab" aria-controls="instructor">References</a></li>
									<li class="nav-item"><a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews">Authors</a></li>
									<li class="nav-item"><a class="nav-link" id="cite-tab" data-bs-toggle="tab" href="#cite" role="tab" aria-controls="cite">Cite</a></li>

								</ul>
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="overview" role="tabpanel">
										<div class="courses-overview">
											<h4>Abstract</h4>
											<p>
												<?php echo $articalResult[0]['abstract']; ?>
											</p>
										    <h4 class="mb-2">Keywords</h4>
											<?php echo $articalResult[0]['keywords']; ?>
											<?php if($articalResult[0]['txtBody']!=''){ ?> 
											<h4 class="mb-2 mt-3">Introduction</h4>
											<?php echo $articalResult[0]['txtBody']; ?>
											<?php } ?>
										</div>
									</div>
									<div class="tab-pane fade" id="curriculum" role="tabpanel">
										<div class="courses-curriculum">
											<embed src="<?php echo base_url(UPLOAD_ARTICLE.$articalResult[0]['document']); ?>" style="height:600px;width:100%" />
										</div>
									</div>
									<div class="tab-pane fade" id="instructor" role="tabpanel">
										<div class="courses-instructor">
											<h4>Reference </h4>
											<p>
												<?php echo $articalResult[0]['reference']; ?>
											</p>
										</div>
									</div>
									<div class="tab-pane fade" id="reviews" role="tabpanel">
										
										<div class="courses-instructor">
										    <?php
											    for($i=0; $i<count($articalResult['authors']); $i++)
        									    {
        									?>
        									        <div class="row align-items-center1 mt-5 mob-t-2">
        												<div class="col-lg-2 col-md-4 col-4">
        													<div class="instructor-image">
        													      <?php if($articalResult['authors'][$i]['authorPhoto']==''){ ?>
        									                <img src="https://www.ijpsjournal.com/assetsbackoffice/uploads/author/default.jpg" class="author_img" alt="Photo" style="margin-right: 10px;">
        									                
        									               <?php }else{ ?>
        									               <img src="<?php echo base_url(UPLOAD_AUTHORS.$articalResult['authors'][$i]['authorPhoto']); ?>" class="author_img" alt="Photo" style="margin-right: 10px;">
        									               
        									              <?php } ?>
        														<!--<img src="<?php echo base_url(UPLOAD_AUTHORS.$articalResult['authors'][$i]['authorPhoto']); ?>" class="author_img" alt="image">-->
        													</div>
        												</div>
        												<div class="col-lg-9 col-md-8 col-8">
        													<div class="author_details_s">
        														<h5><?php echo $articalResult['authors'][$i]['name']; ?></h5>
        														<?php
                            									   
                            									        $designation = "Co-author";
                            									        if($articalResult['authors'][$i]['designationID'] == '1')
                            									        {
                            									            $designation = "Corresponding author";
                            									        }
                            									?>

        														<b class="instructor-content"><?php echo $designation; ?> </b>
        														<p><?php echo $articalResult['authors'][$i]['affiliation']; ?></p>
        														<ul class="social-link list-unstyled">
        															<?php
            															if($articalResult['authors'][$i]['email'] != '')
            															{
        															?>
        															<li>
        																<a href="mailto:<?php echo $articalResult['authors'][$i]['email']; ?>" target="_blank">
        																	<i class="flaticon-mail"></i> <?php echo $articalResult['authors'][$i]['email']; ?>
        																</a>
        															</li>
        															<?php
            															}
        															?>
        														</ul>
        													</div>
        												</div>
        											</div>
        									<?php
        									    }
        									?>
										</div>
									</div>
									<div class="tab-pane fade" id="cite" role="tabpanel">
										<div class="courses-reviews">
											<p>
												<?php echo $articalResult[0]['citation']; ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						<?php
							    if(!empty($relatedResult))
							    {
							?>
							<div class="d-none d-lg-block">
							<div class="row align-items-center mt-5 mob-t-2 courses-details-info p-4">
								<h5 class="mb-3">More related articles</h5>
								<?php
            						if(!empty($relatedResult))
            						{
            						    $first          = 0;
                                        $secound1Start  = 0;
                                        $secound1End    = 0;
                                        $secound2Start  = 0;
                                        $secound2End    = 0;
                						        
            						    if(count($relatedResult) > 4)
            						    {
            						        $first = 5;
            						        
            						        if(count($relatedResult) > 7)
                						    {
                						        $secound1Start = 4;
                						        $secound1End = 7;
                                                
                                                if(count($relatedResult) > 7)
                    						    {
                    						        $secound2Start = 7;
													$secound2End = 10;
                    						    }
                    						    else
                    						    {
                    						      $secound2Start = 7;
                    						      $secound2End = count($relatedResult);
                    						    }
                						    }
                						    else
                						    {
                						        $secound1Start = 4;
                						        $secound1End = count($relatedResult);
                						    }
            						    }
            						    else
            						    {
            						        $first = count($relatedResult);
            						        $secound1 = 0;
                						    $secound2 = 0;
            						    }
                                    }   
            					?>
            					<?php
            						if(!empty($relatedResult))
            						{
            							for($i=$secound1Start;$i<$secound1End;$i++)
            							{
            							     $urlLink = urlencode($relatedResult[$i]['titleOfPaperOne']);
            							    if($urlLink==''){
            							        $urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
            							    }
            							    //$urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
            							    
            					?>
            					            <div class="col-lg-4 col-md-12 mob-t-2">
            									<h6 class="relatedarticlestitle">
            										<a href="<?php echo site_url('article').'/'.$urlLink; ?>"> 
            											<?php echo substr($relatedResult[$i]['titleOfPaper'],0,50)."..."; ?>
            										</a> 
            									</h6>
            									<span>  
            										<?php echo substr($relatedResult[$i]['authorNames'],0,65)."..."; ?>
            									</span>
            								</div>
            					<?php
            							}
            						}
            					?>
								<div class="col-lg-12 col-md-12 text-end" id="firstButton">
									<a class="mt-3"> 
										<h6 onclick="loadMore();">View more <strong class="align-middle"><i class="bx bxs-right-arrow-alt"></i></strong></h6>
									</a>										
								</div>
							</div>
							
            				
                			<div class="row align-items-center courses-details-info mt-0 p-4" id="secoundSection">	
                				<?php
								
            						if(!empty($relatedResult))
            						{
            							for($i=$secound2Start;$i<$secound2End;$i++)
            							{
            							     $urlLink = urlencode($relatedResult[$i]['titleOfPaperOne']);
            							    if($urlLink==''){
            							        $urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
            							    }
            							 //   $urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
            					?>
            					            <div class="col-lg-4 col-md-12 mob-t-2">
            									<h6 class="relatedarticlestitle">
            										<a href="<?php echo site_url('article').'/'.$urlLink; ?>"> 
            											<?php echo substr($relatedResult[$i]['titleOfPaper'],0,80)."..."; ?>
            										</a> 
            									</h6>
            									<span>  
            										<?php echo substr($relatedResult[$i]['authorNames'],0,100)."..."; ?>
            									</span>
            								</div>
            					<?php
            							}
            						}
            					?>
								<div class="col-lg-12 col-md-12 text-end" id="secoundButton">
									<a href="<?php echo site_url('current-issue'); ?>" class="mt-3"> 
										<h6>View more <strong class="align-middle"><i class="bx bxs-right-arrow-alt"></i></strong></h6>
									</a>										
								</div>
							</div>
							
						    </div>
						    <?php
						        }
						    ?>
						    
						</div>
						<div class="col-lg-4 col-md-12">
							<div class="courses-details-info">
								<ul class="info">
									<li>
										<a target="_Blank" "<?php echo $articalResult[0]['doi']; ?>"><img src="<?php echo base_url('assets/public/Front/assets/images/doit.png'); ?>" style="width:30px;margin-right:3px">
											<?php echo $articalResult[0]['doi']; ?>
										</a>
									</li>
									<li>
										<div class="d-flex justify-content-between align-items-center">
											<span>Received</span><?php echo date('d M, Y', strtotime($articalResult[0]['receivedDate']));?>
										</div>
									</li>
									<?php
									    if($articalResult[0]['revisedFlag'] == 1)
									    {
								    ?>
        									<li>
        										<div class="d-flex justify-content-between align-items-center">
        											<span>Revised</span><?php echo date('d M, Y', strtotime($articalResult[0]['revisedDate']));?>
        										</div>
        									</li>
									<?php
									    }
									 ?>
									<li>
										<div class="d-flex justify-content-between align-items-center">
											<span>Accepted</span><?php echo date('d M, Y', strtotime($articalResult[0]['acceptedDate']));?>
										</div>
									</li>
									<li>
										<div class="d-flex justify-content-between align-items-center">
											<span>Published</span><?php echo date('d M, Y', strtotime($articalResult[0]['createdDate']));?>
										</div>
									</li>
									
									<li>
										<div class="d-flex justify-content-between align-items-center">
											<span>Views</span><?php echo $articalResult[0]['viewCount']; ?>
										</div>
									</li>
								</ul>
								<div class="row">
									<div class="col-8">
										<div class="courses-btn-box">
											<a href="<?php echo base_url(UPLOAD_ARTICLE.$articalResult[0]['document']); ?>" download class="default-btn">Download PDF<i class="bx bx-download"></i></a>
										</div>
									</div>
									<div class="col-4">
										<span class="__dimensions_badge_embed__" data-doi="<?php echo $articalResult[0]['doi']; ?>" data-hide-zero-citations="false" data-style="small_circle"></span><script async
										src="https://badge.dimensions.ai/badge.js" charset="utf-8"></script>
									</div>
								</div>
								<?php
								$urlLink = urlencode($articalResult[0]['titleOfPaperOne']);
            							    if($urlLink==''){
            							        $urlLink = str_replace(" ", "-", $articalResult[0]['titleOfPaper']);
            							    }
								   // $urlLink = urlencode(str_replace(" ", "-", $articalResult[0]['titleOfPaper']));
								?>
								<div class="courses-share">
									<div class="share-info">
										<span>Share This Article</span>

										<ul class="social-link">
											<li>
											    
											
												<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo site_url('article').'/'.$urlLink; ?>" class="d-block" target="_blank">
												    <i class="bx bxl-facebook"></i>
												</a>
											</li>
											<li>
												
												<a href="https://twitter.com/intent/tweet?url=<?php echo site_url('article').'/'.$urlLink; ?>&text=<?php echo $articalResult[0]['titleOfPaper']; ?>" class="d-block" target="_blank">
												    <i class="bx bxl-twitter"></i>
												</a>
											</li>
											<li>
												<a href="https://www.instagram.com/?url=<?php echo site_url('article').'/'.$urlLink; ?>" class="d-block" target="_blank">
													<i class="bx bxl-instagram"></i>
												</a>
											</li>
											
											<li>
												<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo site_url('article').'/'.$urlLink; ?>" class="d-block" target="_blank">
													<i class="bx bxl-linkedin"></i>
												</a>
											</li>
											<li>
												<a href="mailto:?subject=<?php echo $articalResult[0]['titleOfPaper']; ?>&body=Authors : <?php echo $articalResult['authorsNameList']; ?> URL : <?php echo site_url('article').'/'.$urlLink; ?>" class="d-block" target="_blank">
													<i class="bx bx-envelope"></i>  
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							
							
						<?php
							    if(!empty($relatedResult))
							    {
							?>
							<div class="row courses-details-info1 mt-3 p-4">
								<h5>Related Articles</h5>
								<?php
            						if(!empty($relatedResult))
            						{
            							for($i=0;$i<$first;$i++)
            							{
            							 //   $urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
            							    $urlLink = urlencode($relatedResult[$i]['titleOfPaperOne']);
            							    if($urlLink==''){
            							        $urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
            							    }
            					?>
            					            <div class="col-lg-12 col-md-12 mt-3">
            									<h6 class="relatedarticlestitle">
            										<a href="<?php echo site_url('article').'/'.$urlLink; ?>"> 
            											<?php echo substr($relatedResult[$i]['titleOfPaper'],0,80)."..."; ?>
            										</a> 
            									</h6>
            									<span>  
            										<?php echo substr($relatedResult[$i]['authorNames'],0,100)."..."; ?>
            									</span>
            								</div>
                			    <?php
            							}
            						}
            					?>
							</div>
							<?php
							    }
							?>
						
						</div>
						<div class="col-lg-12 col-md-12">
						    <div class="d-lg-none">
						        <div class="row align-items-center mt-5 mob-t-2 courses-details-info p-4">
    								<h5 class="mb-3">More related articles</h5>
    								<?php
                						if(!empty($relatedResult))
                						{
                							for($i=$secound1Start;$i<$secound1End;$i++)
                							{
                							    $urlLink = urlencode($relatedResult[$i]['titleOfPaperOne']);
            							    if($urlLink==''){
            							        $urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
            							    }
                							 //   $urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
                					?>
                					            <div class="col-lg-4 col-md-12 mob-t-2">
                									<h6 class="relatedarticlestitle">
                										<a href="<?php echo site_url('article').'/'.$urlLink; ?>"> 
                											<?php echo substr($relatedResult[$i]['titleOfPaper'],0,80)."..."; ?>
                										</a> 
                									</h6>
                									<span>  
                										<?php echo substr($relatedResult[$i]['authorNames'],0,100)."..."; ?>
                									</span>
                								</div>
                					<?php
                							}
                						}
                					?>
    								<div class="col-lg-12 col-md-12 text-end" id="firstButtonMob">
    									<a class="mt-3"> 
    										<h6 onclick="loadMoreMob();">View more <strong class="align-middle"><i class="bx bxs-right-arrow-alt"></i></strong></h6>
    									</a>										
    								</div>
    							</div>
    							<div class="row align-items-center courses-details-info mt-0 p-4" id="secoundSectionMob">	
                    				<?php
                						if(!empty($relatedResult))
                						{
                							for($i=$secound1Start;$i<$secound1End;$i++)
                							{
                							    $urlLink = urlencode($relatedResult[$i]['titleOfPaperOne']);
            							    if($urlLink==''){
            							        $urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
            							    }
                							 //   $urlLink = str_replace(" ", "-", $relatedResult[$i]['titleOfPaper']);
                					?>
                					            <div class="col-lg-4 col-md-12 mob-t-2">
                									<h6 class="relatedarticlestitle">
                										<a href="<?php echo site_url('article').'/'.$urlLink; ?>"> 
                											<?php echo substr($relatedResult[$i]['titleOfPaper'],0,80)."..."; ?>
                										</a> 
                									</h6>
                									<span>  
                										<?php echo substr($relatedResult[$i]['authorNames'],0,100)."..."; ?>
                									</span>
                								</div>
                					<?php
                							}
                						}
                					?>
                					
        							<div class="col-lg-12 col-md-12 text-end" id="secoundButtonMob">
        								<a href="<?php echo site_url('current-issue'); ?>" class="mt-3"> 
        									<h6>View more <strong class="align-middle"><i class="bx bxs-right-arrow-alt"></i></strong></h6>
        								</a>										
        							</div>
        						</div>
						    </div>
						</div>
						<div class="col-lg-4 col-md-12 p-5">
						</div>
					</div>
				</div>
			</div>
		</section>
		<script>
		document.getElementById("secoundSection").style.display = "none";
		  document.getElementById("firstButton").style.display = "";
		  document.getElementById("secoundButton").style.display = "none";
		  
		function loadMore() { 
		  document.getElementById("secoundSection").style.display = "";
		  document.getElementById("firstButton").style.display = "none";
		  document.getElementById("secoundButton").style.display = "";
		  
		}
		
			document.getElementById("secoundSectionMob").style.display = "none";
		  document.getElementById("firstButtonMob").style.display = "";
		  document.getElementById("secoundButtonMob").style.display = "none";
		  
		function loadMoreMob() { 
		  document.getElementById("secoundSectionMob").style.display = "";
		  document.getElementById("firstButtonMob").style.display = "none";
		  document.getElementById("secoundButtonMob").style.display = "";
		  
		}
		
		
		</script>
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>