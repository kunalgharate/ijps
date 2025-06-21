<?php	


			if($this->session->userdata('toastrSuccess') !="")  
			{ 
			    $toastrSuccessflag = 1;
		?>
		       <div id="toastrSuccess123">
                <div class="swal2-container swal2-center swal2-backdrop-show" style="overflow-y: auto;" >
                    <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                        <div class="swal2-header">
                            <ul class="swal2-progress-steps" style="display: none;"></ul>
                            <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                                <div class="swal2-success-ring"></div>
                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                            </div>
                            <img class="swal2-image" style="display: none;">
                            <h2 class="swal2-title" id="swal2-title" style="display: block;">Thanks for submitting.</h2>
                            <button type="button" class="swal2-close" aria-label="Close this dialog" style="display: block;" id="toastrSuccessCloseBtn1">×</button>
                        </div>
                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;"><?php echo $this->session->userdata('toastrSuccess'); ?></div>
                            <input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;">
                            <div class="swal2-range" style="display: none;"><input type="range"><output></output></div>
                            <select class="swal2-select" style="display: none;"></select>
                            <div class="swal2-radio" style="display: none;"></div>
                            <label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label>
                            <textarea class="swal2-textarea" style="display: none;"></textarea>
                            <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
                        </div>
                        <div class="swal2-actions">
                            <div class="swal2-loader"></div>
                            <button type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;" id="toastrSuccessCloseBtn2">OK</button><button type="button" class="swal2-deny swal2-styled" aria-label="" style="display: none;">No</button><button type="button" class="swal2-cancel swal2-styled" aria-label="" style="display: none;">Cancel</button>
                        </div>
                        <div class="swal2-footer" style="display: none;"></div>
                        <div class="swal2-timer-progress-bar-container">
                            <div class="swal2-timer-progress-bar" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
		<?php			
				$this->session->unset_userdata('toastrSuccess');
				$this->session->set_userdata('toastrSuccessflag', '1');
			}
			else if($this->session->userdata('toastrWarning'))
			{
		?>
		    <div id="toastrWarning123">
                <div class="swal2-container swal2-center swal2-backdrop-show" style="overflow-y: auto;" >
                    <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                        <div class="swal2-header">
                            <ul class="swal2-progress-steps" style="display: none;"></ul>
                            <div class="swal2-icon swal2-warning"><div class="swal2-icon-content">!</div></div>
                            <img class="swal2-image" style="display: none;">
                            <h2 class="swal2-title" id="swal2-title" style="display: block;">Warning.</h2>
                            <button type="button" class="swal2-close" aria-label="Close this dialog" style="display: block;" id="toastrWarningCloseBtn1">×</button>
                        </div>
                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;"><?php echo $this->session->userdata('toastrWarning'); ?></div>
                            <input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;">
                            <div class="swal2-range" style="display: none;"><input type="range"><output></output></div>
                            <select class="swal2-select" style="display: none;"></select>
                            <div class="swal2-radio" style="display: none;"></div>
                            <label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label>
                            <textarea class="swal2-textarea" style="display: none;"></textarea>
                            <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
                        </div>
                        <div class="swal2-actions">
                            <div class="swal2-loader"></div>
                            <button type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;" id="toastrWarningCloseBtn2">OK</button><button type="button" class="swal2-deny swal2-styled" aria-label="" style="display: none;">No</button><button type="button" class="swal2-cancel swal2-styled" aria-label="" style="display: none;">Cancel</button>
                        </div>
                        <div class="swal2-footer" style="display: none;"></div>
                        <div class="swal2-timer-progress-bar-container">
                            <div class="swal2-timer-progress-bar" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
		<?php		
				$this->session->unset_userdata('toastrWarning');
			}
			else if($this->session->userdata('toastrError'))
			{
		?>
		    <div id="toastrError123">
                <div class="swal2-container swal2-center swal2-backdrop-show" style="overflow-y: auto;">
                    <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-icon-success swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                        <div class="swal2-header">
                            <ul class="swal2-progress-steps" style="display: none;"></ul>
                            <div class="swal2-icon swal2-error">
                                <span class="swal2-x-mark">
                                <span class="swal2-x-mark-line-left"></span>
                                <span class="swal2-x-mark-line-right"></span></span>
                            </div>
                            <img class="swal2-image" style="display: none;">
                            <h2 class="swal2-title" id="swal2-title" style="display: block;">Error</h2>
                            <button type="button" class="swal2-close" aria-label="Close this dialog" style="display: block;" id="toastrErrorCloseBtn1">×</button>
                        </div>
                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;"><?php echo $this->session->userdata('toastrError'); ?></div>
                            <input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;">
                            <div class="swal2-range" style="display: none;"><input type="range"><output></output></div>
                            <select class="swal2-select" style="display: none;"></select>
                            <div class="swal2-radio" style="display: none;"></div>
                            <label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label>
                            <textarea class="swal2-textarea" style="display: none;"></textarea>
                            <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
                        </div>
                        <div class="swal2-actions">
                            <div class="swal2-loader"></div>
                                <button type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;" id="toastrErrorCloseBtn2">OK</button><button type="button" class="swal2-deny swal2-styled" aria-label="" style="display: none;">No</button><button type="button" class="swal2-cancel swal2-styled" aria-label="" style="display: none;">Cancel</button>
                        </div>
                        <div class="swal2-footer" style="display: none;"></div>
                        <div class="swal2-timer-progress-bar-container">
                            <div class="swal2-timer-progress-bar" style="display: none;"></div>
                        </div>
                    </div>
                </div>
		    </div>
		<?php	
				$this->session->unset_userdata('toastrError');
			}
			
		?>
		
<!doctype html>
<html lang="en-US">
	<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M7G8296');</script>
<!-- End Google Tag Manager -->

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Periodical",
  "name": "International Journal of Pharmaceutical Sciences (IJPS)",
  "description": "A peer-reviewed, open-access pharmacy journal indexed in Scopus and UGC-CARE.",
  "issn": "0975-4725",
  "sameAs": [
    "https://www.scopus.com/sourceid/21101050125",
    "https://www.ugc.gov.in/journallist/"
  ],
  "publisher": {
    "@type": "Organization",
    "name": "IJPS Journal"
  }
}
</script>
	    
	    
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/animate.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/meanmenu.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/boxicons.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/flaticon.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/odometer.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/slick.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/nice-select.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/owl.carousel.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/owl.theme.default.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/magnific-popup.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/fancybox.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/public/Front/assets/css/responsive.css'); ?>">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<link rel="icon" type="image/png" href="<?php echo base_url(UPLOAD_LOGOS.$settingResult[0]['favicon']); ?>">
		
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		
		<style>
            @media only screen and (max-width: 767px)
            {
                .top-fixed {
                    margin: 0px !important;
                }
            }
		</style>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());

			gtag('config', 'G-0364YZBS44');
        </script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YC5MT3Y30K"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YC5MT3Y30K');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16530106627">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-16530106627');
</script>

        <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "International Journal of Pharmaceutical Sciences",
            "alternateName": "International Journal of Pharmaceutical Sciences",
            "url": "https://www.ijpsjournal.com/",
            "logo": "https://www.ijpsjournal.com/public/Front/assets/images/logoup.jpg",
            "sameAs": [
            "https://www.facebook.com/ijpsjournal",
            "https://www.instagram.com/ijps_journal/"
            ]
            }
        </script>
        <script type="application/ld+json">
            {
            "@context": "https://schema.org/",
            "@type": "WebSite",
            "name": "International Journal of Pharmaceutical Sciences ",
            "url": "https://www.ijpsjournal.com/",
            "potentialAction": {
            "@type": "SearchAction",
            "target": "https://www.ijpsjournal.com/?s={search_term_string}",
            "query-input": "required name=search_term_string"
            }
            }
        </script>
        <meta name="csrf-token" content="JKWaLf3KZoODjRlXeMJuFLVpstJS2A4XQjcfwKDm" />
        
        	<style>
			input[type=text],
			select {
				width: 100%;
				height: 62px;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 10px;
				box-sizing: border-box;
			}

			input[type=email],
			select {
				width: 100%;
				height: 62px;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 10px;
				box-sizing: border-box;
			}

			input[type=number],
			select {
				width: 100%;
				height: 62px;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 10px;
				box-sizing: border-box;
			}

			input[type=submit] {
				width: 40%;
				background-color: #4896ce;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				border-radius: 10px;
				cursor: pointer;
			}

			input[type=submit]:hover {
				background-color: #45a049;
			}
		</style>
		<style>
		    .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right] {
                    right: -63px;
                    transform: rotate(-45deg);
                }
                .swal2-icon .swal2-icon-content {
                display: block;
                text-align: center;
            }
		</style>
		
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4961607473055965"
     crossorigin="anonymous"></script>
     

<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "lbvxhd6uv8");
</script>

<meta name="facebook-domain-verification" content="v396mp0ill0omu2qrrhm1fn25wdlij" />
