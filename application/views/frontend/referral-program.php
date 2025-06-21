<?php
    $this->load->view('layout/header');
?>
    <title>Referral Program | International Journal of Pharmaceutical Sciences</title>
    <meta name="description" content="Earn ₹300 for each successful referral through the International Journal of Pharmaceutical Sciences referral program.">
    <meta name="keywords" content="referral program, journal referral, earn money, referral bonus, academic journal, international journal, pharmaceutical sciences">
    <meta name="ROBOTS" content="INDEX,FOLLOW">
    <meta name="googlebot" content="INDEX,FOLLOW">
    <link rel="canonical" href="https://www.ijpsjournal.com/referral-program">
    <meta property="og:image" content="https://www.ijpsjournal.com/assets/public/Front/services/ijps referral program.jpg">
    
    <?php
        $this->load->view('layout/menu');
        $this->load->helper('date');
        $this->load->view('layout/headersection');
    ?>
    
    <!-- Start Referral Program Area -->
    <section class="referral-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="referral-info">
                        <h3>Earn ₹300 for Each Successful Referral!</h3>
                        <p>Refer authors to the International Journal of Pharmaceutical Sciences and earn ₹300 when their article processing charge (APC) is successfully paid. Just fill out the form below, and once their payment is verified, you'll receive ₹300 directly into your account.</p>
                        <div style="text-align: center;">
                        <img src="<?php echo base_url('assets/public/Front/services/ijps referral program.jpg') ?>" style="width:400px; height:auto; border-radius:15px;" alt="Referral Program Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="referral-form">
                        <h3>Submit Your Referral</h3>
                        <form id="referralForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Your Name">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Your Email">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="article_id" id="article_id" class="form-control" required data-error="Please enter the article ID" placeholder="Referred Article ID">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <input type="text" name="title_of_paper" id="title_of_paper" class="form-control" required data-error="Please enter the title of the paper" placeholder="Title of Paper">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group" style="margin-top: 20px;">
                                <label for="payment_receipt">*Upload APC Payment Receipt</label>
                                <input type="file" name="payment_receipt" class="form-control" id="payment_receipt" accept="image/*, .pdf" required>
                            </div>
                            
                            <div class="form-group" style="margin-top: 20px;">
                                <input type="text" name="upi_id" id="upi_id" class="form-control" required data-error="Please enter your UPI ID" placeholder="Your UPI ID">
                                <div class="help-block with-errors"></div>
                            </div>
                            
                            <button type="button" id="submitReferral" class="default-btn" style="color: white; margin-top: 20px;">Submit Referral <i class="flaticon-pointer"></i></button>
                            <div id="msgSubmit" class="h3 text-center hidden"></div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Referral Program Area -->
    <br>
    </br>

<?php 
    $this->load->view('layout/footer');
    $this->load->view('layout/jsfiles');
?>

<script>
$(document).ready(function() {
    $("#submitReferral").click(function(e) {
        var name = $("#name").val();
        var email = $("#email").val();
        var articleId = $("#article_id").val();
        var title = $("#title_of_paper").val(); // Correct variable name
        var paymentReceipt = $("#payment_receipt").val();
        var upiId = $("#upi_id").val();
        
        if(name == '' || email == '' || articleId == '' || title == '' || paymentReceipt == '' || upiId == '') {
            Swal.fire({
                title: "Error!",
                text: "All fields are required",
                icon: "error"
            });
            return false;
        }

        var formData = new FormData($('#referralForm')[0]);
        
        // Debugging: Log form data
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        
        $.ajax({
            url: '<?php echo base_url("backoffice/ReferralController/submitReferral"); ?>',
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                console.log(data); // Debugging: Log server response
                if(data.status == 'success') {
                    Swal.fire({
                        title: "Success!",
                        text: data.msg,
                        icon: "success"
                    }).then(() => location.reload());
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: data.msg,
                        icon: "error"
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error: ' + status + ', ' + error);
                console.log(xhr.responseText);
            }
        });
    });
});
</script>

