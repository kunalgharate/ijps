		<?php
			$this->load->view('layout/header');
		?>
			
			<title>Authors Login | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="IJPS authors guidelines provide detailed instructions for preparing and submitting manuscripts. Adhering to these guidelines ensures a smooth submission and peer-review process, leading to successful publication of high-quality research papers."/>
			<meta name="keywords" content="Authors Guidelines, manuscript submission, research publication, writing instructions, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/author-guidelines">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="Authors Guidelines | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/author-guidelines">
			<meta property="og:description" content="IJPS authors guidelines provide detailed instructions for preparing and submitting manuscripts. Adhering to these guidelines ensures a smooth submission and peer-review process, leading to successful publication of high-quality research papers.">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@ijps__journal">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="An open access peer-reviewed journal aiming to communicate high quality original research work that contribute scientific knowledge related to the field of Pharmaceutical Sciences.">
			<meta name="twitter:image" content="<?php echo base_url('assets/public/Front/assets/images/logoup.jpg'); ?>">
			
		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </script> 
		<section class="login-area ptb-100">
			<div class="container">
				<div class="login-form">
					<h2 class="">Login</h2>
					<!-- <form method="post" enctype="multipart/form-data" id='loginForm' action="<?php echo site_url('login/authenticateUser'); ?>"> -->
					<form method="post" id="authorLoginFrm">
					
						<input type="hidden" name="_token" value="JKWaLf3KZoODjRlXeMJuFLVpstJS2A4XQjcfwKDm">                
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="username" class="form-control" placeholder="Email" fdprocessedid="ypyog">
							<span class="text-danger"></span>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password" fdprocessedid="mz0pg">
							<span class="text-danger"></span>
						</div>
						<div class="clearfix"></div>
						<div class="g-recaptcha mt-3" data-sitekey="6LenUIspAAAAALN-PhdYlCF92Z9RJpNTHXCeriEm"> 
						<!--<div class="g-recaptcha mt-3" data-sitekey="6LdxJWYpAAAAALPzwaq2yE4kycwiS_A5K8k_Ca21"> -->
						</div>
						<div class="clearfix"></div>
						<div class="row align-items-center mt-3">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="checkme">
									<label class="form-check-label" for="checkme">Remember me</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 lost-your-password">
								<a href="<?php echo base_url('forgetpassword') ?>" class="lost-your-password">Forgot your password?</a>
							</div>
						</div>
						<button type="submit" fdprocessedid="i8jw7n">Login</button>
					</form>
				</div>
			</div>
		</section>

		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
			$ajaxUrl = site_url('login/authenticateUser');
			$redirectUrl = site_url('/home');
		?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script>
			
			$("#authorLoginFrm").submit(function (e) {
				
					e.preventDefault();
					
						var bodyFormData = new FormData(this);
						$.ajax({
							url:  '<?php echo $ajaxUrl; ?>',
							type: 'POST',						
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							contentType: false,
							processData: false,
							data: bodyFormData,
							success: function (data) {
								var jsonParse = JSON.parse(data);                            
								if(jsonParse.status=='success'){									
									Swal.fire({
										title: jsonParse.msg,											
										icon: "success",											
										allowOutsideClick: false,
										allowEscapeKey: false										
										})
										.then((willDelete) => {
										if (willDelete) {												
											window.location.href = '<?php echo $redirectUrl; ?>';
										} 
										});								
										
									
								}else{
								    swal({
                                      title: "Error",
                                      text: jsonParse.msg,
                                      icon: "error"
                                    });
								}
							}
						});					
					
				});
		</script>