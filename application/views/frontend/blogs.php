		<?php
			$this->load->view('layout/header');
			
		?>
			
			<title>Blogs | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="Explore the latest advancements in pharmaceutical sciences with our international journal. Access cutting-edge research, studies, and insights shaping the future of medicine. Stay updated with the forefront of pharmaceutical innovation. Join us in advancing global healthcare. Browse now!"/>
			<meta name="keywords" content="Blogs, medical innovation, scientific studies, healthcare advancements, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/blogs">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Blogs | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/blogs">
			<meta property="og:description" content="Explore the latest advancements in pharmaceutical sciences with our international journal. Access cutting-edge research, studies, and insights shaping the future of medicine. Stay updated with the forefront of pharmaceutical innovation. Join us in advancing global healthcare. Browse now!.">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@ijps__journal">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="An open access peer-reviewed journal aiming to communicate high quality original research work that contribute scientific knowledge related to the field of Pharmaceutical Sciences.">
			<meta name="twitter:image" content="<?php echo base_url('assets/public/Front/assets/images/logoup.jpg'); ?>">
			
			<style>				
				.single-blog-item .blog-content h6 {
					margin-bottom: 15px;
					line-height: 1.5;
					font-size: 18px;
				}
				
				.single-blog-item .blog-content {
					padding: 30px 30px 30px;
				}
				.text-right{
					text-align: right;
				}
			</style>
		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		<section class="blog-area pt-100 pb-100">
			<?php
				for($i=0;$i<count($blogCategoriesResult);$i++)
				{
			?>
					<div class="container pt-4">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-12">
								<div class="border-top"></div>
							</div>
							<div class="col-lg-6 col-md-12 col-12 ">
								<h4 class="mt-2"><?php echo $blogCategoriesResult[$i]['blogCategoryName']; ?></h4>
							</div>
							<div class="col-lg-6 col-md-12 col-12 text-right d-none d-lg-block">
								<div class="about-main-content">
									<div class="about-btn mt-0">
										<a href="<?php echo site_url('blogs-categorywise')."/".$blogCategoriesResult[$i]['blogCategoryID']; ?>" class="default-btn">See More <i class="flaticon-right-arrow"></i></a>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-12">
								<div class="border-top"></div>
							</div>
						</div>
						<div class="row pt-4">
							<?php
								for($j=0;$j<count($blogCategoriesResult[$i]['blogData']);$j++)
								{
								    $urlLink = str_replace(" ", "-", $blogCategoriesResult[$i]['blogData'][$j]['title']);
							?>
									<div class="col-lg-4 col-md-6">
										<div class="single-blog-item">
											<div class="blog-image">
											    <a href="<?php echo site_url('blog').'/'.$urlLink; ?>">
												<!--<a href="<?php echo site_url('blog').'/'.$blogCategoriesResult[$i]['blogData'][$j]['blogID']; ?>">-->
													<img src="<?php echo base_url(UPLOAD_BLOG.$blogCategoriesResult[$i]['blogData'][$j]['thumbnailImage']); ?>" alt="image">
												</a>
												
											</div>
											<div class="blog-content">
												
												<h6>
													<a href="<?php echo site_url('blog').'/'.$urlLink; ?>"><?php echo $blogCategoriesResult[$i]['blogData'][$j]['title']; ?></a>
												</h6>
												<div class="mb-3 mt-3">
													<p>
														<?php 
														    echo substr($blogCategoriesResult[$i]['blogData'][$j]['shortDescription'],0,200)."..."; 
                                                        ?>
													</p>
												</div>
												<div class="blog-btn">
													<a href="<?php echo site_url('blog').'/'.$urlLink; ?>" class="default-btn">Read More <i class="flaticon-plus"></i></a>
												</div>
											</div>
										</div>
									</div>
							<?php
								}
							?>
						</div>
						<div class="col-lg-6 col-md-12 col-12 text-right d-lg-none">
							<div class="about-main-content mt-0 mb-3">
								<div class="about-btn mt-0 text-center">
									<a href="<?php echo site_url('blogs-categorywise')."/".$blogCategoriesResult[$i]['blogCategoryID']; ?>" class="default-btn">See More <i class="flaticon-right-arrow"></i></a>
								</div>
							</div>
						</div>
					</div>
					
			<?php			
				}
			?>
			
		
		</section>

		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>