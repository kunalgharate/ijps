<?php
			$this->load->view('layout/header');
		?>
			<title>Pay Fees | International Journal of Pharmaceutical Sciences</title>
			<meta name="description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences"/>
			<meta name="keywords" content="International J Pharm Sci, Current issue, Pharmaceutical Sciences, ijps in press, Pharmacology, IJPS journal, Pharmaceutics, Biotechnology"/>
			<meta name="ROBOTS" content="INDEX,FOLLOW">
			<meta name="googlebot" content="INDEX,FOLLOW">
			<link rel="canonical" href="https://www.ijpsjournal.com/terms-and-conditions">
			<meta name="google-site-verification" content="NWPs0gb3v6ZfzcYZFoAVRsLGjIGgsZTQVzCxpXiankM" />
			<meta property="og:title" content="International Journal of Pharmaceutical Sciences">
			<meta property="og:site_name" content="ijpsjournal" >
			<meta property="og:url" content="https://www.ijpsjournal.com/terms-and-conditions">
			<meta property="og:description" content="A bi-monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences">
			<meta property="og:type" content="article">
			<meta property="og:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			<meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@int_j_pharm_sci">
			<meta name="twitter:title" content="International Journal of Pharmaceutical Sciences">
			<meta name="twitter:description" content="A monthly Journal, which publishes original research works that contributes significantly to further the scientific knowledge in Pharmaceutical Sciences.">
			<meta name="twitter:image" content="https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg">
			
		<?php
			$this->load->view('layout/menu');
			$this->load->helper('date');
			$this->load->view('layout/headersection');
		?>
		<style>
		    .form-container {
      margin-top: 50px;
      background-color: #ffffff; /* white background */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Adding shadow */
    }
		</style>
		 <!-- Start Contact Area -->
         <section class="contact-area">
            <div class="container">
                <div class="row">
				<div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="mt-5 mb-5" >
                           
                            
                           
  <h2 class="text-center">Article Processing Charges</h2>
  <div class="row justify-content-center">
    <div class="col-md-12 form-container">
      <form id="chargeFrm" noValidate>
        <div class="form-group">
          <label for="amount">Amount: </label>
          <input type="text" class="form-control" name = "" id="" placeholder="Enter amount" value=" ₹ 1299.00" required readonly>
          <input type="hidden" class="form-control" name = "amount" id="amount"  value="1299" required readonly>
        </div>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name = "name" id="name" placeholder="Enter name" required>
        </div>
         <div class="form-group">
          <label for="email">Article ID: <span style="color:red">(Please enter article ID without 'IJPS/') *</span></label>
          <input type="text" class="form-control" name = "article_id" id="article_id" placeholder="Enter Article ID" required onchange="staticData()" onkeyup="staticData()" onkeypress="return isNumber(event)">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" name = "email" id="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
          <label for="other1">Phone</label>
          <input type="text" class="form-control" name = "phone_number" id="phone_number" placeholder="Enter other Phone Number">
        </div>
       
        
         <button type="button" id="payButton" class="default-btn " style="float: inline-end;">Pay Now <i class="flaticon-pointer"></i></button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
      </form>
    </div>
  </div>


                            
                        </div>
                    </div>
					<div class="col-lg-3"></div>
                </div>
            </div>
        </section>
        <!-- End Contact Area -->
				
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>

	$(document).ready(function() {
	    
	    	

	
	$("#payButton").click(function(e) {
		
		var amount = $("#amount").val();
		var product_id =  $("#productId").val();
		var name =  $("#name").val();
        var article_id = $("#article_id").val();
        var email = $("#email").val();
        var phone_number = $("#phone_number").val();
        var file = $("#file").val();
        var name = $("#name").val();
		
		if(amount=='' || amount==null){
		
            			Swal.fire({
              icon: "error",
              title: "Please enter your amount",
             
              
            });
           
            return false;
        }
		if(name=='' || name==null){
			Swal.fire({
				title: "Error!",
				text: "Please enter name",
				icon: "error"
			});
           
            return false;
        }
		if(article_id=='' || article_id==null){
			Swal.fire({
				title: "Error!",
				text: "Please enter article number",
				icon: "error"
			});
           
            return false;
        }
		if(email=='' || email==null){
			Swal.fire({
				title: "Error!",
				text: "Please select number of pages",
				icon: "error"
			});
           
            return false;
        }
		if(phone_number=='' || phone_number==null){
			Swal.fire({
				title: "Error!",
				text: "Enter Mobile Number",
				icon: "error"
			});
           
            return false;
        }
	
		var formData = new FormData($('#chargeFrm')[0]);

		var options = {
					"key": "rzp_live_RrBi1HZrzuThWM",
					"amount": amount*100,
					"name": "IJPS Journal",
					"description": "Article Processing Charges",
					"image": "https://www.ijpsjournal.com/assetsbackoffice/uploads/logo/websiteLogo-20231230195421.jpg",
					"handler": function (response){

						formData.append('razorpay_payment_id',response.razorpay_payment_id);
						$.ajax({
							url: '<?php echo base_url('HomeController/acceptChargesFees'); ?>',
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

<script>

	
var data=$("#article_id");
data.val("IJPS/");
     data.attr("readonly",false);
function staticData(){
  var data=$("#article_id");
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

           
      