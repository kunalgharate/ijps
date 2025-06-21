<?php
			$this->load->view('layout/header');
		?>
			<title>Check Plagiarism | International Journal of Pharmaceutical Sciences</title>
			<meta name="description" content="Detect copied content with our precise plagiarism checker. Ensure your writing is authentic and original."/>
			<meta name="keywords" content="plagiarism checker, plagiarism detector, plagiarism software, plagiarism checking services, online plagiarism checker, check for plagiarism, duplicate content checker, content originality"/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/check-plagarism">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="International Journal of Pharmaceutical Sciences">
			<meta property="og:site_name" content="ijpsjournal" >
			<meta property="og:url" content="https://www.ijpsjournal.com/check-plagarism">
			<meta property="og:description" content="Avoid accidental plagiarism and protect your integrity. Get your detailed plagiarism report">
			<meta property="og:type" content="article">
			<meta property="og:image" content="https://www.ijpsjournal.com/assets/public/Front/services/circle-shape.png">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@int_j_pharm_sci">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="Detect copied content with our precise plagiarism checker. Ensure your writing is authentic and original.">
			<meta name="twitter:image" content="https://www.ijpsjournal.com/assets/public/Front/services/circle-shape.png">
			
		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		 <!-- Start Contact Area -->
         <section class="contact-area">
            <div class="container">
                <div class="row">
				<div class="col-lg-6">
				     <div class="contact-form">
				    <img src="<?php echo base_url('assets/public/Front/services/circle-shape2.png')?>" >
				    </div>
				</div>
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <h3>Pay <span>Now</span></h3>

                            <form id="checkPlagarishFrm" enctype="multipart/form-data">
                                <input type="hidden" name="setAmountValue" id="setAmountValue">
                                <input type="hidden" name="product_id" id="product_id"  value="1201">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Name">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Email">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="Phone">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <select name="no_of_pages" onchange="setAmount(this)">   
                                <option value="">Select Pages</option>                                 
                                    <option value="100">0-10 Pages (INR 100)</option>
                                    <option value="150">11-15 Pages (INR 150)</option>
                                    <option value="200 ">16-20 Pages (INR 200)</option>
                                    <option value="250">21-30 Pages (INR 250)</option>
                                    <option value="300">31-40 Pages (INR 300)</option>
                                    <option value="400">41-50 Pages (INR 400)</option>
                                    <option value="450">51-100 Pages (INR 450)</option>
                                    <option value="500">101-180 Pages (INR 500)</option>
                                    <option value="600">181-280 Pages (INR 600)</option>
                                    <option value="700">281-400 Pages (INR 700)</option>
                                </select>
								<div class="form-group">
									<label for="">Select file</label>
									<input type="file" accept=".doc,.docx" name="file" id="file" class="form-control">
								</div>                              

                                <div class="col-lg-12 col-12 mb-3">
                                <div style="font-weight: bold; font-size: large; padding: 10px; padding-right: 20px; margin-top: 30px; text-align: right; background-color: #f2eded; border: 1px dashed #e5e5e5; border-radius: 6px">
                                    
                                    TOTAL AMOUNT:&nbsp;&nbsp;&nbsp;<span id="Level1_ContentPlaceHolder_Total_Price_lbl" style="color:Blue;">₹<span id="setAmount"></span></span>
                                </div>
                            </div>
                           

                                <button type="button" id="payButton" class="default-btn">Pay Now <i class="flaticon-pointer"></i></button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
				
                </div>
            </div>
        </section>
        <!-- End Contact Area -->
				
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>

        
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>

	$(document).ready(function() {
	
	$("#payButton").click(function(e) {
		
		var getAmount = $("#setAmountValue").val();
		var product_id =  $("#productId").val();
		var useremail =  $("#email").val();
        var contactNumber = $("#phone_number").val();
        var file = $("#file").val();
        var name = $("#name").val();
		
		if(name=='' || name==null){
			Swal.fire({
				title: "Error!",
				text: "Please enter your name",
				icon: "error"
			});
           
            return false;
        }
		if(useremail=='' || useremail==null){
			Swal.fire({
				title: "Error!",
				text: "Please enter email",
				icon: "error"
			});
           
            return false;
        }
		if(contactNumber=='' || contactNumber==null){
			Swal.fire({
				title: "Error!",
				text: "Please enter contact number",
				icon: "error"
			});
           
            return false;
        }
		if(getAmount=='' || getAmount==null){
			Swal.fire({
				title: "Error!",
				text: "Please select number of pages",
				icon: "error"
			});
           
            return false;
        }
		if(file=='' || file==null){
			Swal.fire({
				title: "Error!",
				text: "Please select file",
				icon: "error"
			});
           
            return false;
        }
		var totalAmount = getAmount * 100;
		var formData = new FormData($('#checkPlagarishFrm')[0]);

		var options = {
					"key": "rzp_live_RrBi1HZrzuThWM",
					"amount": totalAmount,
					"name": "IJPS Journal",
					"description": "Plagiarism Check",
					"image": "https://www.ijpsjournal.com/assetsbackoffice/uploads/logo/websiteLogo-20231230195421.jpg",
					"handler": function (response){

						formData.append('razorpay_payment_id',response.razorpay_payment_id);
						$.ajax({
							url: '<?php echo base_url('HomeController/createOrder'); ?>',
							type: 'post',
							dataType: 'json',
							processData: false,
							contentType: false,
							data: formData,							
						
							success: function (data) 
							{
								if(data.status=='success'){
								    Swal.fire({
                                      title: data.msg,
                                      confirmButtonText: "Ok",
                                       showConfirmButton: true,
                                      allowOutsideClick: false,
                                      allowEscapeKey: false
                                      
                                    }).then((result) => {
                                     
                                      if (result.isConfirmed) {
                                        	location.reload();
                                      } 
                                    });
								
								}else{
								    Swal.fire({
                                      title: data.msg,
                                      confirmButtonText: "Ok",
                                      showConfirmButton: true,
                                      allowOutsideClick: false,
                                      allowEscapeKey: false
                                      
                                    }).then((result) => {
                                     
                                      if (result.isConfirmed) {
                                        
                                      } 
                                    });
								}
							}
					     });
					},
					"theme": {
					"color": "#528FF0"
							}
					};

		var rzp1 = new Razorpay(options);
		rzp1.open();
		e.preventDefault();
});

});
</script>

           
      