		<script>
			// When the user scrolls the page, execute myFunction
			window.onscroll = function() {myFunction()};

			// Get the header
			var header = document.getElementById("myHeader");

			// Get the offset position of the navbar
			var sticky = header.offsetTop;

			// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
			function myFunction() {
			  if (window.pageYOffset > sticky) {
				header.classList.add("sticky");
			  } else {
				header.classList.remove("sticky");
			  }
			}
		</script>
		<!-- Core -->
		<script src="<?php echo base_url('assets/template/front/vendor/popper/popper.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/js/vendor/jquery.easing.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/js/ie10-viewport-bug-workaround.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/js/slidebar/slidebar.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/js/classie.js'); ?>"></script>
		<!-- Bootstrap Extensions -->
		<script src="<?php echo base_url('assets/template/front/vendor/bootstrap-dropdown-hover/js/bootstrap-dropdown-hover.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/bootstrap-notify/bootstrap-growl.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/scrollpos-styler/scrollpos-styler.js'); ?>"></script>
		<!-- Plugins -->
		<script src="<?php echo base_url('assets/template/front/vendor/flatpickr/flatpickr.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/easy-pie-chart/jquery.easypiechart.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/footer-reveal/footer-reveal.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/sticky-kit/sticky-kit.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/swiper/js/swiper.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/paraxify/paraxify.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/viewport-checker/viewportchecker.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/milestone-counter/jquery.countTo.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/countdown/js/jquery.countdown.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/typed/typed.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/instafeed/instafeed.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/gradientify/jquery.gradientify.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/nouislider/js/nouislider.min.js'); ?>"></script>
		<!-- Isotope -->
		<script src="<?php echo base_url('assets/template/front/vendor/isotope/isotope.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/imagesloaded/imagesloaded.pkgd.min.js'); ?>"></script>
		<!-- Light Gallery -->
		<script src="<?php echo base_url('assets/template/front/vendor/lightgallery/js/lightgallery.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/lightgallery/js/lg-thumbnail.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/front/vendor/lightgallery/js/lg-video.js'); ?>"></script>
		<!-- App JS -->
		<script src="<?php echo base_url('assets/template/front/js/wpx.app.js'); ?>"></script>
	</body>
</html>