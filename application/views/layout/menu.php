<style>
.display{
                    display:none;
                }
                .desktopVIew{
                    display:block;
                }
    	    @media only screen and (max-width: 991px)
    	    {
                .header-information .option-item .navbar-btn .default-btn {
                    padding: 3px 3px !important;
                    font-size: 10px;
                    border: 1px solid;
                }
                 .display{
                    display:none;
                }
                .desktopVIew{
                    display:block;
                }
    	    }
    	    @media only screen and (max-width: 1280px)
            {
                .download-now
                {
                    display: none;
                }
                 .display{
                    display:none;
                }
                .desktopVIew{
                    display:block;
                }
            }
    	    @media only screen and (max-width: 767px)
    	    {
                .top-header-information li {
                    margin-bottom: 15px;
                    margin-right: 10px;
                    padding-left: 0;
                    font-size: 12px;s
                }
                 .display{
                    display:none;
                }
                .desktopVIew{
                    display:block;
                }
                
                .blog-content .default-btn {
                    display: inline-block;
                    padding: 15px 60px 15px 10px;
                    border-radius: 10px 10px 0 10px;
                    font-size: 10px;
                }
                
                .respomobi
                {
                    width:50%;
                }
                
                .ebs
                {
                    padding-left: 0px !important;
                }
                
                .contact-info-box .icon i {
                        font-size: 36px;
                    }
                    
                /*.contact-form
                {
                    padding-right: 1rem!important;
                    padding-left: 1rem!important;
                }*/
            }
            
            .ebs
            {
                padding-left: 50px;
            }
            @media only screen and (max-width: 767px)
            {
                .page-banner-with-full-image {
                    padding-top: 30px !important;
                }
                
                .display{
                    display:block;
                }
                .desktopVIew{
                    display:none;
                }
                
                .page-banner-content-two h2 {
                    font-size: 25px;
                }
                
                .blog-details-desc .article-content .title-box {
                    text-align: left;
                }
                
                .mobw-25
                {
                    width:25%;
                    padding-left: 10px !important;
                }
                
                .mobw-75
                {
                    width:75%;
                }
                
                .blogright {
                    background-color: #ebebeb00;
                }
                
                input[type=text], select {
                    width: 100% !important;
                    height: 42px !important;
                }
                
                input[type=email], select {
                    width: 100% !important;
                    height: 42px !important;
                }
                
                input[type=number], select {
                    width: 100% !important;
                    height: 42px !important;
                }
                
                .form-control {
                    font-size: 0.7rem;
                }
                
                label {
                    font-size: 0.7rem;
                }
                
                input[type=submit] {
                    width: 100%;
                    font-size: 14px;
                }
                
                .authorPhotoSection1
                {
                    width:100% !important;
                }
                
                .authorPhotoSection2
                {
                    width:100% !important;
                    margin-top:10px;
                }
                
                .page-banner-with-full-image {
                    height: 160px !important;
                }
            }
            @media only screen and (max-width: 1199px)
            {
                .main-responsive-nav .main-responsive-menu.mean-container .navbar-nav {
                    height: 390px !important;
                }
                 .display{
                    display:none;
                }
                .desktopVIew{
                    display:block;
                }
            }
            
            .authorPhotoSection1
            {
                width:30%;
                height: 45px;
            }
            
            .authorPhotoSection2
            {
                width:70%;
            }
            
            .authorPhotoCust
            {
                background-position: center; 
                background-repeat: no-repeat; 
                background-size: cover; 
                width: 45px; 
                height: 45px; 
                border-radius: 100%;
                position: absolute; 
            }
    	</style>
	</head>
	<body>
	    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M7G8296"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
       <!-- <div class="preloader-area ">
            <div class="spinnerv" style="margin-top: 250px;">
                <div><img src="<?php echo base_url('assets/public/Front/assets/images/new%20resize%20image.gif'); ?>" style="position:centre; top:80%; height: 200px; width: 200px !important;"></div>
            </div>
        </div>  -->
        <div class="header-information">
            <ul class="top-header-information d-flex justify-content-between align-items-center">
                <li>
                    <i class="flaticon-mail"></i>
                    <a href="mailto:<?php echo $settingResult[0]['mailID']; ?>"><?php echo $settingResult[0]['mailID']; ?></span></a>
                </li>
                <li>
                    <div class="option-item d-flex justify-content-end d-lg-none">
                        <div class="navbar-btn ">
                            
                            <a href="<?php echo base_url('submit-manuscript'); ?>" class="default-btn" style="color:white ;">Submit Manuscript<i class="flaticon-pointer"></i></a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
        <div class="top-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-md-12">
                        <ul class="top-header-information ">
                            <li>
                                <i class="flaticon-mail"></i>
                                <a href="mailto:<?php echo $settingResult[0]['mailID']; ?>"><?php echo $settingResult[0]['mailID']; ?></span></a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-12">
                         
                        <ul class="top-header-optional">
                             <!--<li class="m-4"><b style="color:white"> ISSN0975-4725</b> </li>-->
                            <li>
                                 <a href="<?php echo $settingResult[0]['facebookLink']; ?>" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                                <a href="<?php echo $settingResult[0]['twitterLink']; ?>" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                                <a href="<?php echo $settingResult[0]['instagramLink']; ?>" target="_blank">
                                    <i class='bx bxl-instagram'></i>
                                </a>
                                <a href="<?php echo $settingResult[0]['linkedInLink']; ?>" target="_blank">
                                    <i class='bx bxl-linkedin'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-area">
            <div class="main-responsive-nav">
                <div class="container">
                    <div class="main-responsive-menu">
                        <div class="logo">
                            <a href="<?php echo site_url(); ?>">
                                
                                <img src="<?php echo base_url(UPLOAD_LOGOS.$settingResult[0]['darkLogo']); ?>" style="height:100px;" alt="International Journal of Pharmaceutical Sciences">
                            </a>
                        </div>
                    </div>
                    <ul class="d-flex responsive-user-icon">
                        <li>
                            <div class="others-options d-flex align-items-center mx-2 ">
                                <div class="option-item ">
                                    <div class="search-box fa-xs">
                                        <i class="flaticon-search "></i>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-navbar">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="<?php echo site_url(); ?>">
                            
                            <img src="<?php echo base_url(UPLOAD_LOGOS.$settingResult[0]['darkLogo']); ?>" style="height:65px !important;max-width:none;" alt="International Journal of Pharmaceutical Sciences">
                            
                        </a>
                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav " style="font-size: x-large; ">
                                <li class="nav-item"><a href="<?php echo site_url(); ?>" class="nav-link">Home</a></li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('about-us'); ?>" class="nav-link">About</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="<?php echo site_url('about-us'); ?>" class="nav-link">About Us</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('publication-area'); ?>" class="nav-link">Publication Area</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('reviewer-guidelines'); ?>" class="nav-link">Reviewer Guidelines</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('plagiarism-policy'); ?>" class="nav-link">Plagiarism Policy</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('open-access-policy'); ?>" class="nav-link">Open Access Policy</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('editorial-policy'); ?>" class="nav-link">Editorial Policy</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">For Authors</a>
                                    <ul class="dropdown-menu">
                                        
                                        <li class="nav-item"><a href="<?php echo site_url('author-guidelines'); ?>" class="nav-link">Author Guidelines</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('copyright-form'); ?>" class="nav-link">Copyright Form</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('model-manuscript'); ?>" class="nav-link">Model Manuscript</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('check-paper-status'); ?>" class="nav-link">Check Paper Status</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('peer-review-process'); ?>" class="nav-link">Peer Review Process</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Issue</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a href="<?php echo site_url('current-issue'); ?>" class="nav-link">Current Issue</a></li>
                                        <li class="nav-item"><a href="<?php echo site_url('archive'); ?>" class="nav-link">Archive</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('editorial-board'); ?>" class="nav-link">Editorial Board</a>
                                </li>
            
                                <li class="nav-item">
                                    <a href="<?php echo site_url('contact-us'); ?>" class="nav-link">Contact Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('toolsForAuthor'); ?>" class="nav-link">Tools For Author</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="<?php echo site_url('blogs'); ?>" class="nav-link">Blogs</a>
                                    <ul class="dropdown-menu">
                                        <?php
                                            for($i=0;$i<count($blogMenuResult);$i++)
                                            {
                                        ?>
                                                <li class="nav-item"><a href="<?php echo site_url('blogs-categorywise')."/".$blogMenuResult[$i]['blogCategoryID']; ?>" class="nav-link"><?php echo $blogMenuResult[$i]['blogCategoryName']; ?></a></li>
                                        <?php
                                            }
                                        ?>
                                        
                                    </ul>
                                </li>
                                <li class="nav-item d-lg-none"><a href="<?php echo site_url('login'); ?>" class="nav-link display">Login</a></li>
                                <li class="nav-item d-lg-none"><a href="<?php echo site_url('register'); ?>" class="nav-link display">Register</a></li>
                                <div class="others-options d-flex align-items-center mx-2 ">
                                    <div class="option-item d-none d-md-block">
                                        <div class="search-box fa-xs">
                                            <i class="flaticon-search "></i>
                                        </div>
                                    </div>
                                </div>
                                 <?php
                                            
                                            // if($this->session->userdata('name') == ""|| $this->session->userdata('username') == "")
                                            // {
                                        ?>
                                                <!--<li class="nav-item"><a href="<?php echo site_url('login'); ?>" class="nav-link display">Login</a></li>-->
                                                <!--<li class="nav-item"><a href="<?php echo site_url('register'); ?>" class="nav-link display">Register</a></li>-->
                                        <?php
                                            //}
                                           // else
                                          //  {
                                        ?>
                                                <!--<li class="nav-item"><a href="<?php echo site_url('dashboard'); ?>" class="nav-link display">Dashboard</a></li>-->
                                                <!--<li class="nav-item"><a href="<?php echo site_url('login/signOut'); ?>" class="nav-link display">Logout</a></li>-->
                                        <?php
                                           // }
                                        ?>
                                <li class="nav-item d-none1 desktopVIew" >
                                    <a href="#" class="nav-link"> <i class="flaticon-user" style="font-size:24px; margin-top:-6px; "></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php
                                            
                                            if($this->session->userdata('name') == ""|| $this->session->userdata('username') == "")
                                            {
                                        ?>
                                                <li class="nav-item"><a href="<?php echo site_url('login'); ?>" class="nav-link display">Login</a></li>
                                                <li class="nav-item"><a href="<?php echo site_url('register'); ?>" class="nav-link display ">Register</a></li>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                                <li class="nav-item"><a href="<?php echo site_url('dashboard'); ?>" class="nav-link display">Dashboard</a></li>
                                                <li class="nav-item"><a href="<?php echo site_url('login/signOut'); ?>" class="nav-link display">Logout</a></li>
                                        <?php
                                            }
                                        ?>
                                        
                                    </ul>
                                </li>
                            </ul>
                            <div class="option-item d-none d-lg-block">
                                <div class="navbar-btn ms-4">
                                    
                                    <a href="<?php echo site_url('submit-manuscript'); ?>" class="default-btn" style="color:white ;">Submit Manuscript<i class="flaticon-pointer"></i></a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="search-overlay">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="search-overlay-layer"></div>
                    <div class="search-overlay-layer"></div>
                    <div class="search-overlay-layer"></div>
                    <div class="search-overlay-close">
                        <span class="search-overlay-close-line"></span>
                        <span class="search-overlay-close-line"></span>
                    </div>
                    <div class="search-overlay-form">
                        <form class="form-group" action="<?php echo site_url('searchdata'); ?>" method="get">
                            <input type="text" name="keywords" class="input-search" placeholder="Search here...">
                            <input type="hidden" name="flag" class="input-search" value="0">
                            <button type="submit"><i class='flaticon-search'></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
		<style>
			.top-fixed {
				background: #fff;
				box-sizing: border-box;
				border-radius: 16px;
				box-shadow: 0 4px 12px #0000001a;
				border: solid 1px #dde4ec;
				position: fixed;
				font-size: 13px;
				color: #fff;
				bottom: 24px;
				left: 24px;
				z-index: 10001;
				width: 100%;
				max-width: 480px;
				padding: 16px 24px 16px 24px;
			}
			.btn-costm-dark{
				background: black;
				color: #fff;
				border: none;
				border-radius: 24px;
				padding: 12px 24px;
				margin-top: 12px;
				font-size: 16px;
				cursor: pointer;
			}
			.slick-track{
				margin-right: 24%;
			}
		</style>
		<?php
		    if(!isset($_COOKIE['cookies_accepted']))
		    {
		 ?>
		<div class="top-fixed" id="cookie-banner"> 
			<div class="p-3 cookie" >
				<div class="row">
					<div class="col-lg-8 col-md-8 col-12 ">
						<span class="text-dark">
							We use cookies to make sure that our website works properly, as well as some ‘optional’ cookies to personalise content and advertising, provide social media features and analyse how people use our site. Further information can be found in our <a href="#" class="text-primary"><b>Cookies policy</b></a>
					</div>
					<div class="col-lg-4 col-md-4 col-12 text-center">
						<img src="<?php echo base_url('assets/public/Front/assets/images/cookies80.webp'); ?>" alt="International journal of research in pharmaceutical sciences">
						<a class="btn btn-costm-dark mt-3" style="" onclick="acceptCookies()">Accept</a>
					</div>
				</div>
			</div>
		</div>
		<?php
		       
		    }
        ?>
		<script>
            function setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + value + expires + "; path=/";
            }
            
            function acceptCookies() {
                setCookie("cookies_accepted", "true", 365);
                document.getElementById("cookie-banner").style.display = "none";
            }
            
            function declineCookies() {
                setCookie("cookies_accepted", "false", 365);
                document.getElementById("cookie-banner").style.display = "none";
            }
            
            
           <?php /*
            window.onload = function () {
                if (getCookie('cookies_accepted')=='false') {
                    document.getElementById("cookie-banner").style.display = "block";
                }
            };*/ ?>
		</script>