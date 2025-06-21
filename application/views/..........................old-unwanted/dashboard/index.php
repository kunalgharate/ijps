<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="author" content="http://www.herbalnectar.in/" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<title>Herbal Nectar</title>
		<link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>" />
		<!-- font -->
		<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,500,500i,600,700,800,900|Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
		<!-- Plugins -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/plugins-css.css"); ?>">
		<!-- Typography -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/typography.css"); ?>" />
		<!-- Shortcodes -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/shortcodes/shortcodes.css"); ?>" />
		<!-- Style -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style.css"); ?>" />
		<!-- shop -->
		<link href="<?php echo base_url("assets/css/shop.css"); ?>" rel="stylesheet" type="text/css" /> 
		<!-- Responsive -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/responsive.css"); ?>" />
		<style type="text/css" id="#jarallax-clip-0">
			#jarallax-container-0 {
			   clip: rect(0 1311px 466px 0);
			   clip: rect(0, 1311px, 466px, 0);
			}
		</style>
		<style>
			.footer .footer-text p{
				color:black !important;
			}
			.footer .footer-text p :hover{
				color:#95bc3f !important;
			}
			.footer .footer-social ul li a {
				color:black !important;
			}

			.footer .footer-social ul li a:hover {
				color:#95bc3f !important;
			}
			
			.header.light .mega-menu .menu-links > li > a:hover {
						color:#95bc3f !important;
			}
			
			.header.light .mega-menu .menu-links > li > a:hover {
						color:#95bc3f !important;
			}
		/*	.product-image .img-responsive.center-block:hover img {
				-webkit-transform: scale(1.20);
				-moz-transform: scale(1.20);
				-ms-transform: scale(1.20);
				-o-transform: scale(1.20);
				transform: scale(1.20);
				
			}*/
		.owl-carousel .owl-item:hover img{
               -webkit-transform: scale(1.20);
				-moz-transform: scale(1.20);
				-ms-transform: scale(1.20);
				-o-transform: scale(1.20);
				transform: scale(1.13);
            }
            /*.testimonial-info:after{
             
                position: absolute;
                top: -55px;
                left: -45px;
                color: #84ba3f;
                content:  "\201C";
                font-family: Georgia, serif;
                font-size: 100px;
            }
            .testimonial.text-white.clean .testimonial-info:after {
                color: #ffffff;
            }*/
            @media (max-width: 992px){
            .mega-menu .menu-logo img {
                width: 50px !important;
                height: 50px !important;
            } 
		}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<!--================================= header -->
			<header id="header" class="header light">
				<!--
				<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="topbar-call text-left">
									<ul>
										<li><i class="fa fa-envelope-o theme-color"></i> contact@herbalnectar.in</li>
										<li><i class="fa fa-phone"></i> <a href="tel:9049860169"> <span>+(91) 9049860169 </span> </a> </li>
									</ul>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="topbar-social text-right">
									<ul>
										<li><a href="#" target="_BLANK"><span class="ti-facebook"></span></a></li>
										<li><a href="#" target="_BLANK"><span class="ti-instagram"></span></a></li>
										<li><a href="#" target="_BLANK"><span class="ti-google"></span></a></li>
										<li><a href="#" target="_BLANK"><span class="ti-twitter"></span></a></li>
										<li><a href="#" target="_BLANK"><span class="ti-linkedin"></span></a></li>
										<li><a href="#" target="_BLANK"><span class="ti-dribbble"></span></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				-->
				<!--================================= mega menu -->
				<div class="menu">  
					<!-- menu start -->
					<nav id="menu" class="mega-menu">
						<!-- menu list items container -->
						<section class="menu-list-items">
							<div class="container"> 
								<div class="row"> 
								
									<div class="col-lg-12 col-md-12"> 
										<!-- menu logo -->
										<ul class="menu-logo" style="padding:0px;">
											<li>
											    <a href="<?php echo base_url(); ?>index.php/HomeController" style="color:green; font-size:30px;"><img id="logo_img" src="<?php echo base_url(); ?>assets/images/logo/<?php echo $companyResult[0]['logo']; ?>" alt="logo" style="width:90px; height:90px;"><!--Herbal Nector--></a>
												<!--<a href="" style="color:green; font-size:30px;"><img id="logo_img" src="<?php echo base_url("assets/images/logo/logo.png"); ?>" alt="logo" style="width:90px; height:90px;"><!--Herbal Nector--</a>-->
												<!--<a href="index.html"><img id="logo_img" src="images/logo/logo.png" alt="logo"> </a>-->
											</li>
										</ul>
										<!-- menu links -->
										<div class="menu-bar">
											<ul class="menu-links">
												<li class="hoverTrigger"><a href="index.html">Home</a></li>
												<li class="hoverTrigger"><a href="#">About Us<i class="fa fa-angle-down fa-indicator"></i></a>
    												<ul class="drop-down-multilevel">
    													<li><a href="aboutUs.html">About Us</a></li>
    													<li><a href="ourStory.html">Our Story</a></li>
    												 </ul>
    											</li>
												<li class="hoverTrigger"><a href="products.html">Products</a></li>
												<li class="hoverTrigger"><a href="contact.html">Contact Us</a></li>
												<li class="hoverTrigger"><a href="login.html">Login</a></li>
											</ul>
											<div class="search-cart">
											  <div class="shpping-cart">
											   <a class="cart-btn" href="#"> <i class="fa fa-shopping-cart icon" style="font-size:30px;"></i> <strong class="item">2</strong></a>
												<div class="cart">
												  <div class="cart-title">
													 <h6 class="uppercase mb-0">Shopping cart</h6>
												  </div>
												  <div class="cart-item">
													<div class="cart-image">
													  <img class="img-responsive" src="<?php echo base_url("assets/images/product/1/01.jpg"); ?>" alt="">
													</div>
													<div class="cart-name clearfix">
													  <a href="product.html">Herbal Nectar Organic Digestive Support Tea, 100 g, Nourish<strong>x2</strong> </a>
													  <div class="cart-price">
														<del>Rs.380.00</del> <ins>Rs.340.00</ins>
													 </div>
													</div>
													<div class="cart-close">
														<a href="#"> <i class="fa fa-times-circle"></i> </a>
													 </div>
												  </div>
												  <div class="cart-item">
													<div class="cart-image">
													  <img class="img-responsive" src="<?php echo base_url("assets/images/product/2/01.jpg"); ?>" alt="">
													</div>
													<div class="cart-name clearfix">
													  <a href="#">Herbal Nectar Organic Anti-stress Tea, 100g, SERENE <strong>x2</strong></a>
													  <div class="cart-price">
														<del>Rs.380.00</del> <ins>Rs.340.00</ins>
													 </div>
													</div>
													 <div class="cart-close">
														<a href="#"> <i class="fa fa-times-circle"></i> </a>
													 </div>
												  </div>
												  <div class="cart-total">
													<h6 class="mb-15"> Total: Rs.680.00</h6>
													<a class="button" href="cart.html">View Cart</a>
													<a class="button black" href="checkout.html">Checkout</a>
												  </div>
												</div>
											  </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</nav>
					<!-- menu end -->
				</div>
			</header>
			<!--================================= header -->

			<!--================================= banner -->
			<section id="home-slider" class="shop-06-banner">
				<div id="main-slider" class="carousel carousel-fade slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#main-slider" data-slide-to="0" class="active"></li>
						<li data-target="#main-slider" data-slide-to="1"></li>
						<li data-target="#main-slider" data-slide-to="2"></li>
						<!--<li data-target="#main-slider" data-slide-to="3"></li>-->
					</ol>
					<!-- Carousel inner -->
					<div class="carousel-inner">
						<!--/ Carousel item end -->
						<div class="item active">
							<img class="img-responsive" src="images/slider/2.gif" alt="slider">
							<!--<div class="slider-content">
								<div class="container">
									<div class="row">
										<div class="col-md-12 text-left">
											<div class="slider">
												<h1 class="animated5">Nurturing with Nature</h1>
												<!--<p class="text-white mt-20 mb-30 animated5">Contains Tulsi, Shunthi, Yashtimadhu, Dalchini, Shankhapushpi, Brahmi and Ashwagandha</p>
												--<a class="button black border animated5" href="#">Shop Now </a>--
												<a class="button black ml-10 animated5" href="product">Shop Now </a>
											</div>
										</div>
									</div>
								</div>
							</div>-->
						</div>	
						<div class="item">
							<img class="img-responsive" src="images/slider/3.gif" alt="slider">
							<!--<div class="slider-content">
								<div class="container">
									<div class="row">
										<div class="col-md-12 text-left">
											<div class="slider">
												<h1 class="animated5">Diabetes Care Tea </h1>
												<p class="text-white mt-20 mb-30 animated5">Contains Jamun, Madhunashini, Tulsi, Yashtimadhu, Haldi, Arjuna, Amla. Stimulates insulin production and regulates blood sugar levels </p>
												<!--<a class="button black border animated5" href="#">Shop Now </a>--
												<a class="button black ml-10 animated5" href="product">Shop Now </a>
											</div>
										</div>
									</div>
								</div>
							</div>-->
						</div>	
						<div class="item">
							<img class="img-responsive" src="images/slider/1.gif" alt="slider">  
							<!--<div class="slider-content">
								<div class="container">
									<div class="row">
										<div class="col-md-12 text-left">
											<div class="slider">
												<h1 class="animated5">Healing with Herbs </h1>
												<!--<p class="text-white mt-20 mb-30 animated5">Contains Digestion improving herbs such as Shunthi, Yashtimadhu, Amla, Triphala, Trikatu, Jerra</p>
												--<a class="button black border animated5" href="#">Shop Now </a>--
												<a class="button black ml-10 animated5" href="productDetails">Shop Now </a>
											</div>
										</div>
									</div>
								</div>
							</div>-->
						</div>
					
						
						<!--<div class="item">
							<img class="img-responsive" src="images/slider/4.jpg" alt="slider">
							<div class="slider-content">
								<div class="container">
									<div class="row">
										<div class="col-md-12 text-left">
											<div class="slider">
												<h1 class="animated5">Organic Lactation Support Tea</h1>
												<p class="text-white mt-20 mb-30 animated5">Contains Shatawari, Methi, Saunf, Jeera, Tejpatra, Amla, Motha and Yashtimadhu</p>
												<!--<a class="button black border animated5" href="#">Shop Now </a>--
												<a class="button black ml-10 animated5" href="product">Shop Now </a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	-->
					
					
					<!--/ Carousel item end -->
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#main-slider" data-slide="prev">
						<span><i class="fa fa-angle-left"></i></span>
					</a>
					<a class="right carousel-control" href="#main-slider" data-slide="next">
						<span><i class="fa fa-angle-right"></i></span>
					</a>
				</div>
			</section>
			<!--================================= banner -->
			<br>
			<!--================================= About company -->
			<section class="split-section black-bg page-section-ptb" style="background:green;">
				<div class="side-background">
					<div class="col-md-6 col-sm-4 img-side img-left">
						<div class="img-holder img-cover" data-jarallax='{"speed": 0.6}' style="background-image: url(images/aboutCompany.jpg);">
						</div>
					</div>
				</div>
				<div class="container">
					<div class="col-sm-12 col-md-5 col-md-offset-7">
						<div class="row">
							<div class="section-title" style="text-align: justify;">
								<h6 class="text-white">About Company</h6>
								<h2 class="text-white title-effect1">Herbal Nector</h2>
								<p class="text-white1" style="color:white; font-size:14px;">
								    The sheer pleasure of putting a hot cup of freshly brewed, aromatic tea to the lips is well-known. Herbal Nectar takes this experience to the next level with its completely new range of organic herbal teas. 
                                </p>
                                <p class="text-white1" style="color:white; font-size:14px;">
                                    Each Herbal Tea variant offers a unique combination of natural herbs to soothe and heal not just your body but also your mind and soul.
                                </p>
                                <p class="text-white1" style="color:white; font-size:14px;">
                                    Each blend is carefully mixed using the right proportion of herbs to nourish, nurture, gently heal, and calm you with its delicate flavours and fragrance. What’s more, our organic tea variants are the best antidote for all kinds of conditions from obesity to anxiety.
                                </p>
                                <p class="text-white1" style="color:white; font-size:14px;">
                                    From Tulsi (Basil) and Lemongrass –to Adrak (Ginger) and Dalchini (Cinnamon)  –condiments found in every Indian kitchen – Herbal Nectar teas are prepared from a range of Ayurvedic herbs, each contributing its unique medicinal properties to the mix – thus giving you an experience of total relaxation, rejuvenation, and nourishment.
                                </p>
                                <p class="text-white1" style="color:white; font-size:14px;">
                                    Check out our entire range and pick the best herbal tea variant for your needs.
                                </p>
                                <p class="text-white1" style="color:white; font-size:14px;">
                                    Please note that Herbal Nectar Tea variants are approved by FSSAI and certified organic by OneCert International Pvt. Ltd.
								</p>
							</div>
							<!--<div class="tab round">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#research-07" data-toggle="tab">Vision</a></li>
									<li><a href="#design-07" data-toggle="tab">Mission</a></li>
									<li><a href="#develop-07" data-toggle="tab">Culture</a></li>  
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade in active" id="research-07">
										<p class="text-white">We'll go over your goals, styles you like, layouts & color you like and your projects need. Enim expedita sed quia nesciunt incidunt accusamus necessitatibus modi adipis official Dolor sit amet consectetur adipisicing elit. </p> 
									</div>
									<div class="tab-pane fade" id="design-07">
										<p class="text-white">Here we will take everything we learned during planning and create the design that all you want. modi adipis official Dolor sit amet, consectetur adipisicing elit. Vero quod conseqt quibusdam Vero quod conseqt enim. </p>
									</div> 
									<div class="tab-pane fade" id="develop-07">
										<p class="text-white">After we have the look for the projects, we will need to code this. all the functionality in place. voluptatem obcaecati impedit iste fugiat eius iusto harum quaerat quisquam ipsum, alias nihil qui error eaque explicabo.</p>
									</div>
								</div> 
							</div>-->
						</div>
					</div>
				</div>
			</section>
			<!--================================= About company -->
			
			<section class="our-team white-bg page-section-ptb" style="padding-bottom:20px;">
              <div class="container">
                    <div class="row">
						<div class="col-lg-2 col-md-2 sm-mb-30">
						</div>
						<div class="col-lg-2 col-md-2 sm-mb-30">
							<img class="img-responsive full-width" src="images/cart/NPOP.jpg" alt="">
						</div>
						<div class="col-lg-1 col-md-1 sm-mb-30">
						</div>
						<div class="col-lg-2 col-md-2 sm-mb-30">
							<img class="img-responsive full-width" src="images/cart/OneCertR.JPG" alt="">
						</div>
						<div class="col-lg-1 col-md-1 sm-mb-30">
						</div>
						<div class="col-lg-2 col-md-2 sm-mb-30">
							<img class="img-responsive full-width" src="images/cart/USDA.jpg" alt="">
						</div>
						<div class="col-lg-2 col-md-2 sm-mb-30">
						</div>
                    </div>
                 </div>
        	</section>
			
			<!--================================= Our Range of products -->
			<section class="shop-06-product page-section-ptb">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="section-title text-center">
								<h2 class="title-effect1">Our Range of Products</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!--<div class="owl-carousel" data-nav-dots="false" data-nav-arrow="true" data-items="4" data-md-items="4" data-sm-items="3" data-xs-items="2" data-xx-items="1" data-space="20">-->
							<div class="owl-carousel" data-nav-dots="false" data-nav-arrow="true" data-items="5" data-md-items="5" data-sm-items="4" data-xs-items="3" data-xx-items="1" data-space="20">
								<div class="item">
									<div class="product">
										<div class="product-image">
											<img class="img-responsive center-block" src="images/product/1/01.jpg" alt="">
											<div class="product-overlay">
												<div class="add-to-cart">
													<a href="productDetails.html">add to cart</a>
												</div>
											</div>
										</div>
									
										<div class="product-des" style="margin-top:31px;">
											<div class="product-title">
												<a class="text-black" href="#">Organic Tulsi <br>Tea</a>
											</div>
											<div class="product-price">
												<!--<del>Rs.280.00</del>--> <ins>Rs.270.00</ins>
											</div>
											<a class="button black ml-10 animated5" href="productDetails.html">SEE MORE </a>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="product">
										<div class="product-image">
											<img class="img-responsive center-block" src="images/product/2/01.jpg" alt="">
											<div class="product-overlay">
												<div class="add-to-cart">
													<a href="productDetails.html">add to cart</a>
												</div>
											</div>
										</div>
									
										<div class="product-des">
											<div class="product-title">
												<a class="text-black" href="productDetails.html">Organic Weight loss Tea</a>
											</div>
											<div class="product-price">
													<!--<del>Rs.280.00</del>--> <ins>Rs.270.00</ins>
											</div>
											<a class="button black ml-10 animated5" href="productDetails.html">SEE MORE </a>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="product">
										<div class="product-image">
											<img class="img-responsive center-block" src="images/product/5/01.jpg" alt="">
											<div class="product-overlay">
												<div class="add-to-cart">
													<a href="productDetails.html">add to cart</a>
												</div>
											</div>
										</div>
										
										<div class="product-des">
											<div class="product-title">
												<a class="text-black" href="productDetails.html">Organic Diabetes Care Tea</a>
											</div>
											<div class="product-price">
													<!--<del>Rs.280.00</del>--> <ins>Rs.270.00</ins>
											</div>
											<a class="button black ml-10 animated5" href="productDetails.html">SEE MORE </a>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="product">
										<div class="product-image">
											<img class="img-responsive center-block" src="images/product/4/01.jpg" alt="">
											<div class="product-overlay">
												<div class="add-to-cart">
													<a href="productDetails.html">add to cart</a>
												</div>
											</div>
										</div>
										
										<div class="product-des" style="margin-top:33px;">
											<div class="product-title">
												<a class="text-black" href="productDetails.html">Organic Anti-stress <br>Tea</a>
											</div>
											<div class="product-price">
													<!--<del>Rs.280.00</del>--> <ins>Rs.270.00</ins>
											</div>
											<a class="button black ml-10 animated5" href="productDetails.html">SEE MORE </a>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="product">
										<div class="product-image">
											<img class="img-responsive center-block" src="images/product/3/01.jpg" alt="">
											<div class="product-overlay">
												<div class="add-to-cart">
													<a href="productDetails.html">add to cart</a>
												</div>
											</div>
										</div>
										
										<div class="product-des" style="margin-top:30px;">
											<div class="product-title">
												<a class="text-black" href="productDetails.html">Organic Digestive Support Tea</a>
											</div>
											<div class="product-price">
													<!--<del>Rs.280.00</del>--> <ins>Rs.270.00</ins>
											</div>
											<a class="button black ml-10 animated5" href="productDetails.html">SEE MORE </a>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="product">
										<div class="product-image">
											<img class="img-responsive center-block" src="images/product/6/01.jpg" alt="">
											<div class="product-overlay">
												<div class="add-to-cart">
													<a href="productDetails.html">add to cart</a>
												</div>
											</div>
										</div>
										<div class="product-des" style="margin-top:-10px;">
											<div class="product-title">
												<a class="text-black" href="productDetails.html">Organic Skin Care<br> Tea</a>
											</div>
											<div class="product-price">
													<!--<del>Rs.280.00</del>--> <ins>Rs.270.00</ins>
											</div>
											<a class="button black ml-10 animated5" href="productDetails.html">SEE MORE </a>
										</div>
									</div>
								</div>
								<!--
								<div class="item">
									<div class="product">
										<div class="product-image">
											<img class="img-responsive center-block" src="images/product/7/01.jpg" alt="">
											<div class="product-overlay">
												<div class="add-to-cart">
													<a href="productDetails.html">add to cart</a>
												</div>
											</div>
										</div>
										<div class="product-des">
											<div class="product-title">
												<a class="text-black" href="productDetails.html">Herbal Nectar Organic Tulsi Tea(Pack of 2)</a>
											</div>
											<div class="product-price">
													<!--<del>Rs.540.00</del>-- <ins>Rs.495.00</ins>
											</div>
											<a class="button black ml-10 animated5" href="productDetails.html">SEE MORE </a>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="product">
										<div class="product-image">
											<img class="img-responsive center-block" src="images/product/8/01.jpg" alt="">
											<div class="product-overlay">
												<div class="add-to-cart">
													<a href="productDetails.html">add to cart</a>
												</div>
											</div>
										</div>
										<div class="product-des">
											<div class="product-title">
												<a class="text-black" href="productDetails.html">Organic Weight loss Tea</a>
											</div>
											<div class="product-price">
													<!--<del>Rs.540.00</del>-- <ins>Rs.495.00</ins>
											</div>
											<a class="button black ml-10 animated5" href="productDetails.html">SEE MORE </a>
										</div>
									</div>
								</div>
								-->
								<div class="item">
									<div class="product">
										<div class="product-image">
											<img class="img-responsive center-block" src="images/product/9/01.jpg" alt="">
											<div class="product-overlay">
												<div class="add-to-cart">
													<a href="productDetails.html">add to cart</a>
												</div>
											</div>
										</div>
										<div class="product-des">
											<div class="product-title">
												<a class="text-black" href="productDetails.html">Organic Lactation Support Tea</a>
											</div>
											<div class="product-price">
													<!--<del>Rs.290.00</del>--> <ins>Rs.270.00</ins>
											</div>
											<a class="button black ml-10 animated5" href="productDetails.html">SEE MORE </a>
										</div>
									</div>
								</div>							
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--================================= Our Range of products -->
			
			<!--================================= Why Us -->
			<section class="page-section-ptb bg-overlay-black-50 parallax" style="background-image:url(images/testimonial.jpg);">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="section-title text-center">
								<h2 class="title-effect1" style="color:white;">Why Us ?</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="owl-carousel" data-nav-dots="true" data-items="1" data-md-items="1" data-sm-items="1">
								<div class="item" style="padding:10px;">
									<div class="testimonial text-white clean">
										<div class="author-info" style="font-size:25px;"> <strong>Organic Herbs</strong> </div>
										<div class="testimonial-info" style="font-size:18px; margin-top:10px;"><i> We use 100% natural organic herbs in all our herbal tea variants. These herbs are grown in their natural habitat without the use of any chemical fertilizers or pesticides. We ensure that you do not end up consuming any harmful chemicals when you savour Herbal Nectar teas.</i></div>
									</div>
								</div>
								<div class="item" style="padding:10px;">
									<div class="testimonial text-white clean">
										<div class="author-info" style="font-size:25px;"> <strong>No Preservatives</strong> </div>
										<div class="testimonial-info" style="font-size:18px; margin-top:10px;"><i> All Herbal Nectar tea variants contain herbs and only natural herbs and nothing else. No preservatives, additives or flavours.</i></div>
									</div>
								</div>
								<div class="item" style="padding:10px;">
									<div class="testimonial text-white clean">
										<div class="author-info" style="font-size:25px;"> <strong>Finest quality ingredients</strong> </div>
										<div class="testimonial-info" style="font-size:18px; margin-top:10px;"><i> Finest quality herbs are procured from their natural habitat all over India. The herbs are then cleaned, crushed, mixed and packed under hygienic conditions.</i></div>
									</div>
								</div>
								<div class="item" style="padding:10px;">
									<div class="testimonial text-white clean">
										<div class="author-info" style="font-size:25px;"> <strong>Effective blends</strong> </div>
										<div class="testimonial-info" style="font-size:18px; margin-top:10px;"><i> All Herbal Nectar tea variants are extremely effective because of their unique combinations. We have put together powerful Ayurvedic herbs in such proportions that the combinations in Herbal Nectar tea variants are more effective than single herbs. Each individual herb complements one another thus enhancing the overall health benefits of the blend in Herbal Nectar tea variants.</i></div>
									</div>
								</div>
								<div class="item" style="padding:10px;">
									<div class="testimonial text-white clean">
										<div class="author-info" style="font-size:25px;"> <strong>Great taste and nice aroma</strong> </div>
										<div class="testimonial-info" style="font-size:18px; margin-top:10px;"><i> While designing effective combinations of the herbs, we have taken utmost care to preserve the natural taste in the blend. All Herbal Nectar tea variants taste and smell so delightful, they will uplift your mood instantly. The pleasing taste will make sure you consume our herbal teas daily and consistently.</i></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--================================= Why Us -->
            
            <!--================================= Testimonial -->
			<section class="page-section-ptb bg-overlay-black-50 parallax" style="background-image:url(images/testimonial.jpg);">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="owl-carousel" data-nav-dots="true" data-items="1" data-md-items="1" data-sm-items="1">
								<div class="item" style="padding:10px;">
									<div class="testimonial text-white clean">
										<div class="testimonial-avatar"> 
											<img alt="" src="images/testimonial/female.png"> 
										</div>
										<!--<div class="testimonial-info"> Healthiest drink i ever had..... Loaded with organic ingredients which is beneficial for our body and health. The taste of the tea also feels fresh whenever I take.😊</div>
										<div class="author-info"> <strong>Sunanda Koyyada - <span>Herbal Nector Customer 1 </span></strong> </div>-->
										<div class="testimonial-info" style="font-size:18px;"><i> I was never a tea addict. But ever since I've tried Herbal Nectar, its become my daily health fix.</i></div>
										<div class="author-info"> <strong>Sonali Singh </strong> </div>
									</div>
								</div>
								<div class="item" style="padding:10px;">
									<div class="testimonial text-white clean">
										<div class="testimonial-avatar"> 
											<img alt="" src="images/testimonial/female.png"> 
										</div>
										<div class="testimonial-info" style="font-size:18px;"><i> There is something magical about Herbal Nectar teas. After a hard day at work, it rejuvenates my tired nerves, builds immunity and elevates my moods, like nothing else can.</i></div>
										<div class="author-info"> <strong>Mamta Kulkarni</strong> </div>
									</div>
								</div>
								<div class="item" style="padding:10px;">
									<div class="testimonial text-white clean">
										<div class="testimonial-avatar"> 
											<img alt="" src="images/testimonial/male.png"> 
										</div>
										<div class="testimonial-info" style="font-size:18px;"><i> I've discovered that Herbal Nectar is a sheer indulgence. Their Organic Tulsi Tea is a pleasure I can't deny myself. It also keeps cold, congestion and acidity at bay.</i></div>
										<div class="author-info"> <strong>Neeraj Malhotra</strong> </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--================================= Testimonial -->

			<!--================================= Video  -->
			<section class="page-section-ptb" style="padding-bottom:10px;">
				<div class="container">
					<div class="row">
						<!--<div class="col-lg-3 col-md-3 col-sm-3 sm-mb-30">
						</div>-->
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="js-video [youtube, widescreen]">
								<iframe width="100%" height="100%" src="https://www.youtube.com/embed/ag0rsyB8bGo" allowfullscreen></iframe>
							</div>
						</div>
							<!-- <div class="col-lg-12 col-md-12 col-sm-12" style="padding-right:0px;padding-left:0px;">
						    <iframe  width="100%" height="100%" src="https://www.youtube.com/embed/nJ29Q5rVadY "></iframe>
						</div>-->
					
						<!--<div class="col-lg-3 col-md-3 col-sm-3 sm-mb-30">
						</div>-->
					</div>
				</div>
			</section>
			<!--================================= Video  -->
			
			<!--================================= Footer -->
			<footer class="footer page-section-pt">
				<div class="copyright">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 col-sm-6">
								<a href="" style="color:green; font-size:30px;"><img class="img-responsive mb-10" id="logo-footer" src="<?php echo base_url("assets/images/logo/logo.png"); ?>" alt="logo" style="height:70px;"><!--Herbal Nector--></a>
								<div class="footer-text">
									<p> ©Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span> <a href="http://www.herbalnectar.in"> Herbal Nector </a> All Rights Reserved </p>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6">
								<div class="footer-social">
									<ul class="list-inline text-right">
										<li><a href="termsAndConditions.html">Terms &amp; conditions</a> &nbsp;&nbsp;&nbsp;|</li>
										<li><a href="privacyPolicy.html">Privacy Policy</a> &nbsp;&nbsp;&nbsp;|</li>
										<li><a href="returnPolicy.html">Return Policy</a> &nbsp;&nbsp;&nbsp;|</li>
										<li><a href="whyUs.html">Why Us</a> &nbsp;&nbsp;&nbsp;|</li>
										<li><a href="FAQ.html">FAQ</a> &nbsp;&nbsp;&nbsp;</li>
									</ul>
								</div>
								<div class="social-icons color-hover pull-right mt-20">
									<ul class="clearfix"> 
										<li class="social-facebook"><a href="#" target="_BLANK"><i class="fa fa-facebook"></i></a></li>
										<li class="social-twitter"><a href="#" target="_BLANK"><i class="fa fa-twitter"></i></a></li>
										<li class="social-dribbble"><a href="#" target="_BLANK"><i class="fa fa-dribbble"></i> </a></li>
										<li class="social-linkedin"><a href="#" target="_BLANK"><i class="fa fa-linkedin"></i> </a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!--================================= Footer -->
		</div>
		<div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>

		<!--================================= jquery -->

		<!-- jquery -->
		<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.12.4.min.js"); ?>"></script>

		<!-- plugins-jquery -->
		<script type="text/javascript" src="<?php echo base_url("assets/js/plugins-jquery.js"); ?>"></script>

		<!-- plugin_path -->
		<script type="text/javascript">var plugin_path = 'js/';</script>
		 
		<!-- custom -->
		<script type="text/javascript" src="<?php echo base_url("assets/js/custom.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/mega-menu/mega_menu.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/owl-carousel/owl-carousel.min.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/nicescroll/jquery.nicescroll.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/isotope/isotope.pkgd.min.js"); ?>"></script>
	</body>
</html>
