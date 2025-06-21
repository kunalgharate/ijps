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
          <label for="amount">Amount(USD): </label>
          <input type="text" class="form-control" name = "" id="" placeholder="Enter amount" value="$ 25"  readonly>
          <input type="hidden" class="form-control" name = "amount" id="amount" placeholder="Enter amount" value="25" required readonly>
        </div>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name = "name" id="name" placeholder="Enter name" required>
        </div>
         <div class="form-group">
          <label for="email">Article ID:<span style="color:red">(Please enter article ID without 'IJPS/') *</span></label>
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
	    
	     $('#payButton').on('click', function() {
	        
            var amount = $('#amount').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var article_id = $("#article_id").val();
            var phone_number = $("#phone_number").val();
          

    $.ajax({
      url: '<?php echo base_url('HomeController/pay_international'); ?>',
      method: 'POST',
      data: {
        amount: amount,
        name: name,
        email: email,
        article_id:article_id,
        phone_number:phone_number
      },
      success: function(response) {
        var options = {
          "key": response.key,
          "amount": response.amount,
          "currency": response.currency,
          "name": response.name,
          "handler": function(data) {
         
				 Swal.fire({
                  title: 'Payment successfully completed',
                  confirmButtonText: "Ok",
                   showConfirmButton: true,
                  allowOutsideClick: false,
                  allowEscapeKey: false
                  
                }).then((result) => {
                 
                  if (result.isConfirmed) {
                      
                      	$.ajax({
							url: '<?php echo base_url('HomeController/saveInternationalPayment'); ?>',
							type: 'post',
							data: {response:response},
							success: function (data) 
							{							
							
							}
					     });
                      
                    location.reload();
                  } 
                });
            
          },
          "prefill": {
            "name": response.prefill.name,
            "email": response.prefill.email
          },
          "theme": {
            "color": "#F37254"
          }
        };
        
        var rzp = new Razorpay(options);
        rzp.open();
      },
      error: function(xhr, status, error) {
        console.error('AJAX request failed:', error);
      }
    });
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


           
      