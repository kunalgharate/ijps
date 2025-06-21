		<?php 
		//echo "<pre>"; print_r($photoVideoGalleryCategoryResult);exit;
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu');
			
			$urlArray = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$segments = explode('/', $urlArray);
			$numSegments = count($segments); 
			$currentSegment = $segments[$numSegments - 1];
		?>
		<!--Main Content Start-->
		<style>
		    @media (max-width: 991.98px)
		    {
				.dash {
					max-width: none;
					padding: 80px 15px;
					vertical-align: middle;
				}
		    }
		</style>
		
		<style>* {
  box-sizing: border-box;
}

body {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  min-height: 100vh;
  background-color: #fff;
}

h1 {
  font-weight: 100;
}

.container {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
      flex-wrap: wrap;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  width: 80vw;
  margin: auto;
}
.container h1 {
  -webkit-box-flex: 0;
      -ms-flex: none;
          flex: none;
  width: 100%;
  margin: 0 2% 2em 2%;
}

.cardList {
  position: relative;
  display: block;
  -webkit-box-flex: 1;
      -ms-flex: 1 1 auto;
          flex: 1 1 auto;
  margin: 2%;
  -webkit-filter: none;
          filter: none;
  opacity: 1;
  -webkit-transition: 0.25s ease-in-out opacity, 0.25s ease-in-out filter;
  transition: 0.25s ease-in-out opacity, 0.25s ease-in-out filter;
  cursor: pointer;
}
.cardList__title {
  display: block;
  padding-top: 70%;
  text-align: center;
  /*font-size: 0.8em;*/
  opacity: 0.8;
  z-index: 0;
}
.cardList:hover .card {
  box-shadow: 0 5px 25px 0 rgba(0, 0, 0, 0.5);
  -webkit-transition: 0.35s ease-out transform, 0.35s ease-out shadow;
  transition: 0.35s ease-out transform, 0.35s ease-out shadow;
}
.cardList:nth-child(2n + 1) .card:nth-child(1) {
  -webkit-transform: translate(-2%, -2%);
          transform: translate(-2%, -2%);
}
.cardList:nth-child(2n + 1) .card:nth-child(2) {
  -webkit-transform: translate(-2%, 2%) rotate(2deg);
          transform: translate(-2%, 2%) rotate(2deg);
}
.cardList:nth-child(2n + 1) .card:last-of-type {
  -webkit-transform: rotate(-2deg);
          transform: rotate(-2deg);
}
.cardList:nth-child(2n + 1):hover .card__bg {
  -webkit-filter: none;
          filter: none;
  opacity: 1;
}
.cardList:nth-child(2n + 1):hover .card:nth-child(1) {
  -webkit-transform: translate(30%, 45%) rotate(-2deg);
          transform: translate(30%, 45%) rotate(-2deg);
}
.cardList:nth-child(2n + 1):hover .card:nth-child(2) {
  -webkit-transform: translate(-50%, 35%) rotate(5deg);
          transform: translate(-50%, 35%) rotate(5deg);
}
.cardList:nth-child(2n + 1):hover .card:last-of-type {
  -webkit-transform: rotate(5deg) translate(0%, -40%);
          transform: rotate(5deg) translate(0%, -40%);
}
.cardList:nth-child(2n) .card:nth-child(1) {
  -webkit-transform: translate(2%, 2%);
          transform: translate(2%, 2%);
}
.cardList:nth-child(2n) .card:nth-child(2) {
  -webkit-transform: translate(2%, -2%) rotate(-2deg);
          transform: translate(2%, -2%) rotate(-2deg);
}
.cardList:nth-child(2n) .card:nth-child(3) {
  -webkit-transform: rotate(2deg);
          transform: rotate(2deg);
}
.cardList:nth-child(2n):hover .card:nth-child(1) {
  -webkit-transform: translate(2%, 50%) rotate(5deg);
          transform: translate(2%, 50%) rotate(5deg);
}
.cardList:nth-child(2n):hover .card:nth-child(2) {
  -webkit-transform: translate(50%, -30%) rotate(10deg);
          transform: translate(50%, -30%) rotate(10deg);
}
.cardList:nth-child(2n):hover .card:nth-child(3) {
  -webkit-transform: translate(-25%, -40%) rotate(-5deg);
          transform: translate(-25%, -40%) rotate(-5deg);
}

.card {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  padding-top: 60%;
  background-color: #ccc;
  -webkit-transition: 0.28s ease-out transform, 0.28s ease-out shadow;
  transition: 0.28s ease-out transform, 0.28s ease-out shadow;
  overflow: hidden;
  z-index: 5;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.2);
}
.card__bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-repeat: no-repeat;
  background-size: cover;
  background-color: #ccc;
}
.card:not(:last-of-type) .card__bg {
  background-blend-mode: multiply;
  -webkit-filter: grayscale(100%);
          filter: grayscale(100%);
  opacity: 0.25;
  -webkit-transition: 0.25s ease-in-out filter, 0.25s ease-in-out opacity;
  transition: 0.25s ease-in-out filter, 0.25s ease-in-out opacity;
}
.cardList:hover .card:not(:last-of-type) .card__bg {
  background-blend-mode: normal;
  -webkit-filter: none;
          filter: none;
  opacity: 1;
}

.container:hover .cardList {
  -webkit-filter: grayscale(100%);
          filter: grayscale(100%);
  opacity: 0.25;
  z-index: 1;
}
.container:hover .cardList:hover {
  -webkit-filter: none;
          filter: none;
  opacity: 1;
  z-index: 100;
}
</style>
        <!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Photo Gallery </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Photo Gallery</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="d-flex align-items-center">
					</div>
				</div>
			</div>

			<!-- page heading end-->
			<div class="d-flex flex-column-fluid">
				<div class="container">
					<div class="row">
						<?php							
							for($i=0; $i < count($photoVideoGalleryCategoryResult); $i++)
							{							
						?>
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
									<div class="cardList mb-10">
										<a href ="<?php echo base_url()."photoGallery/".$photoVideoGalleryCategoryResult[$i]['photoVideoGalleryCategoryID']; ?>">
											<?php
												$tempPostResult = $photoVideoGalleryCategoryResult[$i]['photoVideoGallery'];
												$postResult = array();
												
												if(count($tempPostResult)<3)
												{
													$tempCount = 3- count($tempPostResult);
													
													for($j=0; $j < $tempCount; $j++)
													{
														$postResult[]['photoVideoLink'] = 'blankGalleryPhoto.jpg';
													}
													
													for($j=0; $j < count($tempPostResult); $j++)
													{
														$postResult[]['photoVideoLink'] = $tempPostResult[$j]['photoVideoLink'];
													}
												}
												else
												{
													$postResult = $photoVideoGalleryCategoryResult[$i]['photoVideoGallery'];
												}
												
												
												for($j=0; $j < 3; $j++)
												{
											?>
													<div class="card">
														<div class="card__bg" style="background-image: url('<?php echo base_url().UPLOAD_GALLERY_PHOTO_VIDEO.$postResult[$j]['photoVideoLink']; ?>')"></div>
													</div>
											<?php
												}
											?>
											<span class="cardList__title text-dark font-weight-bold text-hover-primary font-size-lg">
												<?php echo $photoVideoGalleryCategoryResult[$i]['name']; ?>
											</span>
										</a>
									</div>
								</div>
						<?php
							}
							
							if(count($photoVideoGalleryCategoryResult) == '0')
							{
								echo "<div class='col-xl-12'>".$noDataAvailable."</div>";
							}
						?>
					</div>
					

					<div class="container" style="display:none;">
						<div class="card card-custom gutter-b card-stretch">
							<div class="card-body text-center p-4">
								<div class="row">
								<?php							
									for($i=0; $i < count($photoVideoGalleryCategoryResult); $i++)
									{
										
								?>
										<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
											<div class="mt-5 mb-5">
												<div class="mt-2">
													<?php
														$postResult = $photoVideoGalleryCategoryResult[$i]['photoVideoGallery'];
														for($j=0; $j < 1; $j++)
														{
													?>
															<img src="<?php echo base_url().UPLOAD_GALLERY_PHOTO_VIDEO.$postResult[$j]['photoVideoLink']; ?>" style="width: 70% !important; height: auto !important;" alt="Fire Fighter Contact 3">
													<?php
														}
													?>
												</div>
												<div class="my-2 mt-5">
													<span class="text-dark font-weight-bold text-hover-primary font-size-lg">
														<a href ="<?php echo base_url()."photoGallery/".$photoVideoGalleryCategoryResult[$i]['photoVideoGalleryCategoryID']; ?>">
															<?php echo $photoVideoGalleryCategoryResult[$i]['name']; ?>
														</a>
													</span>
												</div>
											</div>
										</div>
								<?php
									}
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>

		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>