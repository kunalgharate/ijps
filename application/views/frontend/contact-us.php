		<?php
			$this->load->view('layout/header');
		?>
			
			<title>Contact US | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="Need to get in touch with IJPS? Contact our team for any queries related to manuscript submission, publication process, or subscription inquiries. We are dedicated to providing exceptional support to our authors and readers."/>
			<meta name="keywords" content="Contact Us, International Journal, Inquiries, Feedback, Collaboration, Queries, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/contact-us">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Contact US | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/contact-us">
			<meta property="og:description" content="Need to get in touch with IJPS? Contact our team for any queries related to manuscript submission, publication process, or subscription inquiries. We are dedicated to providing exceptional support to our authors and readers.">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/contact_us.png">
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
			.contact-image {
				background-image: url("<?php echo base_url('assets/public/Front/assets/images/contact_us.png'); ?>");
			}
			
			.contact-info-box .icon {
				background-color: #fff0; 
				padding: 0px;
			}
			
			.contact-info-box {
				text-align:left !important;
				
			}
			.contact-info-box p a {
			color:white !important;
			}
		</style>
		<script src= 
        "https://www.google.com/recaptcha/api.js" async defer> 
    </script> 
		<section class="contact-info-area pt-100 pb-70">
			<div class="container pt-4">
				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="contact-info-box">
							<div class="icon text-white">
								<i class='flaticon-phone-call'></i>
								<h3 class='text-white'>Phone Number</h3>
							</div>
							<p><i class="flaticon-check"></i> <a href="tel:<?php echo $settingResult[0]['phoneNumber']; ?>"><?php echo $settingResult[0]['phoneNumber']; ?></a></p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="contact-info-box">
							<div class="icon text-white">
								<i class='flaticon-mail'></i>
								<h3 class='text-white'>Email Address</h3>
							</div>
							<p><i class="flaticon-check"></i> <a href="mailto:<?php echo $settingResult[0]['mailID']; ?>"><?php echo $settingResult[0]['mailID']; ?></span></a></p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="contact-info-box">
							<div class="icon text-white">
								<i class='flaticon-placeholder'></i>
								<h3 class='text-white'>Publisher Address</h3>
							</div>
						<!--	<p><i class="flaticon-check"></i> <a href="#"><?php echo $settingResult[0]['officeAddress1']; ?></a></p> -->
							<p><i class="flaticon-check"></i> <a href="#">India</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="contact-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="contact-form">
							<h3>Get In <span>Touch</span></h3>
							<!-- <form action="<?php echo site_url('submit-contact-form-save'); ?>" method="post"> -->
							<form id="contact_us_frm" method="post">
							<input type="hidden" name="_token" value="JKWaLf3KZoODjRlXeMJuFLVpstJS2A4XQjcfwKDm">                        
								<div class="form-group">
									<input type="text" name="name" id="name" class="form-control" required="" data-error="Please enter your name" placeholder="Name">
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<input type="email" name="email" id="email" class="form-control" required="" data-error="Please enter your email" placeholder="Email">
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<input type="text" name="phone_number" id="phone_number" required="" data-error="Please enter your number" class="form-control" placeholder="Phone">
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<input type="text" name="msg_subject" id="msg_subject" class="form-control" required="" data-error="Please enter your subject" placeholder="Subject">
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<textarea name="message" class="form-control" id="message" cols="30" rows="5" required="" data-error="Write your message" placeholder="Your Message"></textarea>
									<div class="help-block with-errors"></div>
								</div>
								<div class="clearfix"></div>
								<div class="g-recaptcha mt-3" data-sitekey="6LenUIspAAAAALN-PhdYlCF92Z9RJpNTHXCeriEm"> 
								<!--<div class="g-recaptcha mt-3" data-sitekey="6LdxJWYpAAAAALPzwaq2yE4kycwiS_A5K8k_Ca21"> -->
								</div>
								<div id="captcha" class="text-danger"></div>
								<button type="submit" class="default-btn mt-3 border-0">Send Message <i class="flaticon-pointer"></i></button>
								<div id="msgSubmit" class="h3 text-center hidden"></div>
								<div class="clearfix"></div>
								
							</form>
						</div>
					</div>
					<div class="col-lg-6">
						<div style="background-size: contain;" class="contact-image"></div>

					</div>
				</div>
			</div>
		</section>
		
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script>
			$("#contact_us_frm").submit(function (e) {        
				e.preventDefault();
				var v = grecaptcha.getResponse();
				if(v.length == 0)
				{					
					Swal.fire(
						'Select Captcha?',
						'',
						'error'
						);
					return false;
				}
				var bodyFormData = new FormData(this);
				$.ajax({
					url:  baseUrl + 'submit-contact-form-save',
					type: 'POST',						
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					contentType: false,
					processData: false,
					data: bodyFormData,
					success: function (data) {
						var jsonParse = JSON.parse(data);                            
						if(jsonParse.status=='success'){
							Swal.fire(
								jsonParse.msg,
								'',
								'success'
								);
							$('#contact_us_frm').trigger("reset");
							grecaptcha.reset();
						}else{
							Swal.fire(
							jsonParse.status,
							'',
							'error'
							);
						}
					}
				});
			});
		</script>