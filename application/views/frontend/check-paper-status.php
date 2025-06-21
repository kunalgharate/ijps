		<?php
			$this->load->view('layout/header');
		?>
			
			<title>Check Paper Status | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="Authors can easily check the status of their paper submission at IJPS, including the review stage and estimated publication timeline, using our online system."/>
			<meta name="keywords" content="Model Manuscript, research article template, writing example, publication format, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/model-manuscript">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Check Paper Status | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/model-manuscript">
			<meta property="og:description" content="Authors can easily check the status of their paper submission at IJPS, including the review stage and estimated publication timeline, using our online system.">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/asa.gif">
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
					<div class="col-lg-9 col-md-12">
						<div class="services-details-desc">
							<section class="contact-area">
								<div class="container">
									<div class="row">
										<div class="col-lg-8 pb-2">
											<div class="contact-form pb-5">
												<form class="form-group" action="<?php echo site_url('getstatus'); ?>" method="post">
													<input type="hidden" name="_token" value="JKWaLf3KZoODjRlXeMJuFLVpstJS2A4XQjcfwKDm">                                            
													<div class="form-group">
														<label for="Paper" style="display: block;">
        													Manuscript ID
        													<span style="color:red">(Please enter manuscript ID with 'IJPS/') *</span>
        												</label>
														<input type="text" id="document_code" name="document_code" class="form-control" required  style="display: inline-block; width: 100%;" onchange="staticData()" onkeyup="staticData()">
														<span class="text-danger">
																											</span>
													</div><br>
													<button class="default-btn" style="border: 0px; color:white ;">Get Status<i class="flaticon-pointer"></i></button>
													<div class="clearfix"></div>
												</form>
												<div class="mt-5">
												    <?php
												        if(!empty($statusResult))
												        {
												            $message ="";
												            
												            if($statusResult[0]['statusID'] == 1)
												            {
												                $message ="Your article is in under review";
												            }
												            else if($statusResult[0]['statusID'] == 2)
												            {
												                $message ="Your article has been approved";
												            }
												            else if($statusResult[0]['statusID'] == 3)
												            {
												                $message ="Your article has been approved";
												            }
												            else if($statusResult[0]['statusID'] == 4)
												            {
												                $message ="Your article has been published";
												            }
												            else if($statusResult[0]['statusID'] == 5)
												            {
												                $message ="Your article has been rejected";
												            }
												            else
												            {
												                $message ="Article id is incorrect";
												            }
												    ?>
													        <h5 class="alert alert-dark">
													            <?php echo $message; ?>
													        </h5>
													<?php
												        }
													?>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<img src="<?php echo base_url('assets/public/Front/assets/images/asa.gif'); ?>">
										</div>
									</div>
								</div>
							</section>
							<div class="row">
            				    <?php
            				    
            				        
            						if(!empty($statusResult['data']))
            						{
            						    $articalesResult[0] = $statusResult['data'][0];
            						    
            							for($i=0;$i<count($articalesResult);$i++)
            							{
            							    $urlLink = str_replace(" ", "-", $articalesResult[$i]['titleOfPaper']);
            					?>
            								<div class="col-lg-6 col-md-6">
            									<div class="single-courses-box shadow">
            										<div class="courses-image">
            											<a href="<?php echo site_url('article').'/'.$urlLink; ?>">
            												<img class="imgu " src="<?php echo base_url(UPLOAD_ARTICLE.$articalesResult[$i]['thumbnailImage']); ?>" alt="image">
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
                        									    ?>
                        									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.$articalesResult[$i]['authorImages'][2]); ?>'); margin-left: 0px;"  class="authorPhotoCust"></div>
                        									   <?php
                        									            }
                        									            
                        									            if(isset($articalesResult[$i]['authorImages'][1]))
                        									            {
                        									   ?>
                        									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.$articalesResult[$i]['authorImages'][1]); ?>'); margin-left: 23px;" class="authorPhotoCust"></div>
                        									   <?php
                        									            }
                        									            
                        									            if(isset($articalesResult[$i]['authorImages'][0]))
                        									            {
                        									   ?>
                        									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.$articalesResult[$i]['authorImages'][0]); ?>'); margin-left: 46px;" class="authorPhotoCust"></div>
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
            														<?php echo substr($articalesResult[$i]['titleOfPaper'], 0, 53); ?>...
            													</a> 
            												</h3>
            												<p><?php echo substr($articalesResult[$i]['abstract'], 0, 100); ?>...</p>
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
							</br>
						</div>
					</div>
					<div class="col-lg-3 col-md-12">
						<div class="services-details-info">
							<strong>For Authors</strong>
							<ul class="services-list mt-2">
								<li class="nav-item">
									<a href="<?php echo site_url('check-plagarism'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Check Plagiarism</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('author-guidelines'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Author Guidelines</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo site_url('copyright-form'); ?>" class="nav-link"><i class="bx bxs-chevron-right"></i>Copyright Form</a>
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
var data=$("#document_code");
data.val("IJPS/");
     data.attr("readonly",false);
function staticData(){
  var data=$("#document_code");
  if(data.val().length<5)
    {
     data.val("IJPS/");
     data.attr("readonly",true);
    }
    else
    {
     data.attr("readonly",false);
    }
}
</script>
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>