
<footer class="footer-area pt-100 pb-70">
    <div class="container"></br></br>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget">
                    <div class="widget-logo">
                        <a href="<?php echo base_url(); ?>">
							<img src="<?php echo base_url(UPLOAD_LOGOS.$settingResult[0]['favicon']); ?>" style="height:120px; text-align:center" alt="image">
						</a>
                    </div>
                    <ul class="footer-contact-info">
                        <li>
                            <i class='flaticon-mail'></i>
                            <span>Email Address:</span>
                            <a href="mailto:<?php echo $settingResult[0]['mailID']; ?>"><?php echo $settingResult[0]['mailID']; ?></a>
                        </li>
                        <li>
                            <i class='flaticon-placeholder'></i>
                            <span>Location:</span>
                            <?php echo $settingResult[0]['officeAddress1']; ?>
                        </li>
                    </ul>
                    
                    <div class="widget-share">
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
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Quick Links</h3>
                    <ul class="quick-links">
                        <li><a href="<?php echo site_url(); ?>">						<i class='bx bxs-right-arrow'></i> Home</a></li>
                        <li><a href="<?php echo site_url('pay-fees'); ?>">				<i class='bx bxs-right-arrow'></i> Pay Fees</a></li>
                        <li><a href="<?php echo site_url('contact-us'); ?>">			<i class='bx bxs-right-arrow'></i> Contact</a></li>
                        <li><a href="<?php echo site_url('check-paper-status'); ?>">	<i class='bx bxs-right-arrow'></i> Check paper Status</a></li>
                        <li><a href="<?php echo site_url('author-guidelines'); ?>">		<i class='bx bxs-right-arrow'></i> Author Guidelines</a></li>
                        <li><a href="<?php echo site_url('peer-review-process'); ?>">	<i class='bx bxs-right-arrow'></i> Peer Review Process</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Policies</h3>
                    <ul class="quick-links">
                        <li><a href="<?php echo site_url('plagiarism-policy'); ?>">				<i class='bx bxs-right-arrow'></i> Plagiarism Policy				</a></li>
                        <li><a href="<?php echo site_url('open-access-policy'); ?>"> 			<i class='bx bxs-right-arrow'></i> Open Access Policy				</a></li>
                        <li><a href="<?php echo site_url('editorial-policy'); ?>"> 				<i class='bx bxs-right-arrow'></i> Editorial Policy					</a></li>
                        <li><a href="<?php echo site_url('terms-and-conditions'); ?>">			<i class='bx bxs-right-arrow'></i> Terms and Conditions				</a></li>
                        <li><a href="<?php echo site_url('cancellation-and-refund-policy'); ?>"><i class='bx bxs-right-arrow'></i> Cancellation and Refund Policy	</a></li>
                        <li><a href="<?php echo site_url('privacy-policy'); ?>">				<i class='bx bxs-right-arrow'></i> Privacy Policy					</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget">
                    <h3>Subscribe Our Newsletter</h3>
                    <form id="subscribeform">
					    <div class="row">
					    	<div class="col-lg-10 col-md-6">
        						<input type="text" class="input-newsletter1" placeholder="Enter your email" name="txtEmailID" id="txtEmailID" required autocomplete="off" style="height:40px;">
        					</div>
							<div class="col-lg-2 col-md-6">
        						<button type="submit"  class="subscribebtn"><i class="flaticon-paper-plane"></i></button>
        					</div>
        				</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="copyright-area">
    <div class="container">
        <div class="copyright-area-content">
            <p>Copyright © 2025 IJPS. All rights reserved<a href="<?php echo site_url(); ?>" target="_blank"></a></p>
        </div>
    </div>
</div>


<div class="go-top">
    <i class='flaticon-up-arrow'></i>
</div>

<script>
$(document).ready(function() {
    
    $("#toastrSuccessCloseBtn1").click(function() {
        $("#toastrSuccess123").html("");
    });
    
     $("#toastrSuccessCloseBtn2").click(function() {
        $("#toastrSuccess123").html("");
    });
    
    $("#toastrWarningCloseBtn1").click(function() {
        $("#toastrWarning123").html("");
    });
    
     $("#toastrWarningCloseBtn2").click(function() {
        $("#toastrWarning123").html("");
    });
    
    $("#toastrErrorCloseBtn1").click(function() {
        $("#toastrError123").html("");
    });
    
     $("#toastrErrorCloseBtn2").click(function() {
        $("#toastrError123").html("");
    });
});
</script>
		<script>
function closePopup() {
    alert('hjajcsd');
    const keyval1 = document.getElementById("toastrSuccess123");

    if (keyval1.classList.contains("swal2-backdrop-show")) {
        keyval1.classList.remove("swal2-backdrop-show");
        keyval1.classList.add("swal2-backdrop-hide");
    }
    
    const keyval2 = document.getElementById("toastrWarning123");
    
    if (keyval2.classList.contains("swal2-backdrop-show")) {
        keyval2.classList.remove("swal2-backdrop-show");
        keyval2.classList.add("swal2-backdrop-hide");
    }
    
    const keyval = document.getElementById("toastrError123");
    
    if (keyval.classList.contains("swal2-backdrop-show")) {
        keyval.classList.remove("swal2-backdrop-show");
        keyval.classList.add("swal2-backdrop-hide");
    }
}
</script>
<script>

$(document).ready(function() {
    // Attach a submit event handler to the form
    $("#menuscriptFormnew").submit(function() {
        // Show the loader when the form submission process starts
        const loader = document.getElementById("loader");
        loader.style.display = "block";
    });
});

<?php

/*
$(document).ready(function() {
    $("#menuscriptFormnew").submit(function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Get references to the form, submit button, and loader element
        const form = $("#menuscriptFormnew");
        const submitButton = $("#submitbtn");
        const loader = $("#loader");

        // Disable the submit button
        submitButton.prop("disabled", true);

        // Show the loader
        loader.css("display", "block");

        // Simulate a time-consuming form submission (e.g., an AJAX request)
        setTimeout(function() {
            // After the submission is completed, hide the loader and re-enable the submit button
            loader.css("display", "none");
            submitButton.prop("disabled", false);

            // Optionally, you can submit the form to a server here
            form.submit();
        }, 30); // Replace with the actual form submission duration
    });
});*/


?>
</script>

<script>
    $("#subscribeform").submit(function (e) {        
        e.preventDefault();
        var bodyFormData = new FormData(this);
        $.ajax({
            url: '<?php echo base_url('submit-subscribe') ?>',
            type: 'POST',						
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            processData: false,
            data: bodyFormData,
            success: function (data) {
                var jsonParse = JSON.parse(data);                            
                if(jsonParse.status=='success'){
                    Swal.fire(
                        'Thanks for subscribed.',
                        '',
                        'success'
                        );
                        $('#txtEmailID').val('');
                }else{
                    Swal.fire(
                    'Thanks for subscribed.',
                    '',
                    'error'
                    );
                }
            }
        });
    });
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>