		<?php
			$this->load->view('layout/header');
		?>
			<title>Submited Manuscripts | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
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
				    <div class="col-lg-3 col-md-12">
				        <section class="contact-area">
							<div class="container">
        				        <div class="services-details-info pt-4">
        				            <?php
    								    if($this->session->userdata('name') !="" )
                                        {
                                            echo "<h5>".$this->session->userdata('name')."</h5>";
                                            echo $this->session->userdata('authorMailID')."<br>";
                                            echo $this->session->userdata('contactNumber')."<br><hr>";
                                            
                                        }
                                    ?>
        				        </div>
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
						<div class="membership-levels-table table-responsive mt-5">
                            <h5>Submited Manuscripts</h5>
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Index</th>
                                        <th>Manuscript ID </th>
                                        <th>Title Of Paper</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

									$publishRecords = array();
									foreach ($manuscriptList as $record) {
										if (trim($record['statusID']) ==4) {        
											$publishRecords[] = $record;
										}
									}
									//echo "<pre>";print_r($manuscriptList);echo "</pre>";
                                        if(count($manuscriptList)>0)
                                        {
                                            for($i=0; $i< count($manuscriptList); $i++)
                                            {
                                    ?>
                                                <tr>
                                                    <td><?php echo ($i+1); ?></td>
                                                    <td>
                                                        <?php 
                                                            if($manuscriptList[$i]['statusID'] == '4')
                                                            {
                                                                echo "<a href='".site_url('article')."/".$manuscriptList[$i]['link']."' target='_BLANK'>".$manuscriptList[$i]['uniqueCode']."</a>";
                                                            }
                                                            else
                                                            {
                                                                echo $manuscriptList[$i]['uniqueCode'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <td style="text-align: left;"><?php echo $manuscriptList[$i]['titleOfPaper']; ?></td>
                                                    <td><?php echo $manuscriptList[$i]['statusName']; ?></td>
                                                </tr>
                                    <?php 
                                            }
                                        }
                                        else
                                        {
                                    ?>
                                                <tr>
                                                    <td colspan='4'>No data Found...</td>
                                                </tr>
                                    <?php        
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

						<section class="courses-area ptb-100">
			<div class="container">
				<div class="row">
				    <?php
						if(!empty($publishRecords))
						{
							for($i=0;$i<count($publishRecords);$i++)
							{
							    $urlLink = str_replace(" ", "-", $publishRecords[$i]['titleOfPaper']);
							    $flag =0;
					?>
								<div class="col-lg-4 col-md-6">
									<div class="single-courses-box shadow">
										<div class="courses-image">
											<a href="<?php echo site_url('article').'/'.$urlLink; ?>">
												<img class="imgu " src="<?php echo base_url(UPLOAD_ARTICLE.$publishRecords[$i]['thumbnailImage']); ?>" alt="<?php echo $publishRecords[$i]['titleOfPaper']; ?>">
											</a>
										</div>
										<div class="courses-content position-relative">
											<div class="course-author d-flex dd-flex align-items-center">
            									<div class="authorPhotoSection1">
            									    <?php
            									        if(isset($publishRecords[$i]['authorImages']))
            									        {
            									            if(isset($publishRecords[$i]['authorImages'][2]))
            									            {
            									                $flag =1;
            									    ?>
            									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.$publishRecords[$i]['authorImages'][2]); ?>'); margin-left: 0px;"  class="authorPhotoCust"></div>
            									   <?php
            									            }
            									            
            									            if(isset($publishRecords[$i]['authorImages'][1]))
            									            {
            									                $flag =1;
            									                $css = "23px";
            									                
            									                if(count($publishRecords[$i]['authorImages'])<3)
            									                {
            									                    $css = "0px";
            									                }
            									   ?>
            									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.$publishRecords[$i]['authorImages'][1]); ?>'); margin-left: <?php echo $css; ?>;" class="authorPhotoCust"></div>
            									   <?php
            									            }
            									            
            									            if(isset($publishRecords[$i]['authorImages'][0]))
            									            {
            									                $flag =1;
            									                $css = "46px";
            									                
            									                if(count($publishRecords[$i]['authorImages'])<3)
            									                {
            									                    $css = "23px";
            									                }
            									                else if(count($publishRecords[$i]['authorImages'])<2)
            									                {
            									                    $css = "0px";
            									                }
            									   ?>
            									                <div style="background-image: url('<?php echo base_url(UPLOAD_AUTHORS.$manuscriptList[$i]['authorImages'][0]); ?>'); margin-left: <?php echo $css; ?>;" class="authorPhotoCust"></div>
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
            									    <span><?php echo substr($publishRecords[$i]['authorName'], 0, 55); ?>...</span>
            									  </div>
            								</div>
											<div>
												<h3> 
													<a href="<?php echo site_url('article').'/'.$urlLink; ?>"> 
														<?php echo substr($publishRecords[$i]['titleOfPaper'], 0, 50); ?>...
													</a> 
												</h3>
												<p>
													<p><?php echo substr($publishRecords[$i]['abstract'], 0, 170); ?>...</p>
												</p>
												<div class="row justify-content-between">
                									<div class="col-sm-7 col-10 text-left lign-middle align-self-center" style=" font-size: 13px; font-weight: 700;">
                										<img src="<?php echo base_url('assets/public/Front/assets/images/doi-logo.ico'); ?>" style="width: 24px;margin-right:4px">
                										<?php echo $publishRecords[$i]['doi']; ?>
                									</div>
                									<div class="col-sm-5 col-2 float-right">
                										<a style="font-weight: 700;font-size: 13px;" class="text-right float-right" href="<?php echo base_url(UPLOAD_ARTICLE.$publishRecords[$i]['document']); ?>">
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
		</section>
					</div>
				</div>
			</div>
		</section>
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>