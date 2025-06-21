<?php
			$this->load->view('layout/header');
		?>
			
			<title>Dashboard | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES</title>
			<meta name="description" content="Authors can easily check the status of their paper submission at IJPS, including the review stage and estimated publication timeline, using our online system."/>
			<meta name="keywords" content="Model Manuscript, research article template, writing example, publication format, IJPS Journal, Int. J. Pharm. Sci."/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/dashboard">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="DAshboard | INTERNATIONAL JOURNAL OF PHARMACEUTICAL SCIENCES">
			<meta property="og:site_name" content="International Journal of Pharmaceutical Sciences | Open Access" >
			<meta property="og:url" content="https://www.ijpsjournal.com/dashboard">
			<meta property="og:description" content="Authors can easily login and check status of their paper submission at IJPS, including the review stage and estimated publication timeline, using our online system.">
			<meta property="og:image" content="https://ijpsjournal.com/public/Front/assets/images/asa.gif">
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
		 <!-- Start My Account Area -->
		 <section class="my-account-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="register-form">
                            <h2>Forgot Password</h2>
        
							<form id="forgot_password_frm" >
							<input type="hidden" name="_token" value="JKWaLf3KZoODjRlXeMJuFLVpstJS2A4XQjcfwKDm"> 
                                
							<div class="form-group">
    							<input type="email" name="email"  id="email" class="form-control" required="" data-error="Please enter your email" placeholder="Email">
    							<div class="help-block with-errors"></div>
    						</div>
						
						<div id="msgSubmit" class="h3 text-center hidden"></div>
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-12">
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- End My Account Area -->
		
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		
		<script>


		$("#forgot_password_frm").submit(function (e) {    
		    
				e.preventDefault();
				var email = $("#email").val();
			
				if(email == '' || email==null)
				{					
					Swal.fire(
						'Enter email first?',
						'',
						'error'
						);
					return false;
				}
				var bodyFormData = new FormData(this);
				$.ajax({
					url:  baseUrl + 'forgot_pass',
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
                              showCancelButton: true,
                              confirmButtonText: "Ok",
                              denyButtonText: `Don't save`
                            }).then((result) => {
                              if (result.isConfirmed) {
                               	location.reload();
                              } 
                            });
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