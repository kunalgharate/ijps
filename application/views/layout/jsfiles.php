		<script>
			const baseUrl = '<?php echo site_url(); ?>';
		</script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/jquery.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/bootstrap.bundle.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/jquery.meanmenu.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/owl.carousel.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/jquery.appear.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/odometer.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/slick.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/nice-select.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/jquery.magnific-popup.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/fancybox.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/jquery.ajaxchimp.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/form-validator.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/contact-form-script.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/wow.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/public/Front/assets/js/main.js'); ?>"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		
		<script>			
			function clearSearch() {
				window.location.href = "index.html";
			}

			function setAmount(amount) {
				var amount = $(amount).val();				
				$("#setAmount").html(amount);
				$("#setAmountValue").val(amount);
			}

			$('#submit_popup').on('click', function () {
				// Close the modal by removing the "show" class and hiding it
				$('#myModal').removeClass('show');
				$('#myModal').hide();
			});

			$(document).ready(function () {
				$("#country").select2();
				$("#article_type").select2();

				// $("#menuscriptForm").submit(function (e) {
				// 	e.preventDefault();

				// 	var bodyFormData = new FormData(this);


				// 	$.ajax({
				// 		url: 'https://ijpsjournal.com/submit-manuscript-data',
				// 		type: 'POST',
				// 		dataType: "json",
				// 		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				// 		contentType: false,
				// 		processData: false,
				// 		data: bodyFormData,
				// 		success: function (data) {
				// 			Swal.fire(
				// 					'Thanks for submitting.',
				// 					'Your manuscript has been submitted',
				// 					'success'
				// 					);
				// 			var file_data = $('#sortpicture').prop('files')[0];
				// 			$('#Name').val('');
				// 			$('#papertitle').val('');
				// 			$('#article_type').val('');
				// 			$('#email').val('');
				// 			$('#contact').val('');
				// 			$("#country").select2({
				// 				placeholder: "Select a country"
				// 			});
				// 			$("#country").val('').trigger('change')
				// 			$("#article_type").select2({
				// 				placeholder: "Select a artical type"
				// 			});
				// 			$('#sortpicture').val('');

				// 		}
				// 	});
				// });
				// $("#contactForm").submit(function (e) {
				// 	e.preventDefault();

				// 	var bodyFormData = new FormData(this);


				// 	$.ajax({
				// 		url: 'https://ijpsjournal.com/contact-us-data',
				// 		type: 'POST',
				// 		dataType: "json",
				// 		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				// 		contentType: false,
				// 		processData: false,
				// 		data: bodyFormData,
				// 		success: function (data) {
				// 			Swal.fire(
				// 					'Thanks for submitting.',
				// 					'Your manuscript has been submitted',
				// 					'success'
				// 					);
							
				// 			$('#name').val('');
				// 			$('#email').val('');
				// 			$('#phone_number').val('');
				// 			$('#msg_subject').val('');
				// 			$('#message').val('');
							

				// 		}
				// 	});
				// });
			});
		</script>
	</body>
</html>