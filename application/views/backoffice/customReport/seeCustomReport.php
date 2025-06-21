		<?php 
			$this->load->view(BACKOFFICE.'layout/header'); //print_r($knowledgeCentrePostCategoryResult); exit;
		?>
			
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
			$formHeading    = "Generate Report";
			$buttonName     = "Search Data";
			$url            = SHOW_DATA_REQUEST_WITH_FILTER;
		?>
		
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> <?php echo $formHeading; ?></h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url(BACKOFFICE.'dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Profile</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"><?php echo $formHeading; ?></a>
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
						<div class="col-md-12">
							<div class="card card-custom gutter-b example example-compact">
								<div class="card-header">
									<h3 class="card-title"><?php echo $formHeading; ?></h3>
								</div>
								<form method="post" action="<?php echo site_url(BACKOFFICE.$url); ?>" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row" style="backgroud-color:#gggggg;">
											<div class="col-lg-12" id="rbtnRequestTypeFilterFlagSection">
										        <div class="form-group">
													<div class="radio-inline">
													    <label class="radio">
															<input type="radio" checked="checked" name="rbtnRequestTypeFilterFlag" id="rbtnRequestTypeFilterFlag-1" value='1' onclick="requestTypeFlagEvent(this);">
															<span></span>Received Manuscripts
														</label>
														<label class="radio">
															<input type="radio" name="rbtnRequestTypeFilterFlag" id="rbtnRequestTypeFilterFlag-2" value='2' onclick="requestTypeFlagEvent(this);">
															<span></span>Manuscripts Authors info
														</label>
														<label class="radio">
															<input type="radio" name="rbtnRequestTypeFilterFlag" id="rbtnRequestTypeFilterFlag-3" value='3' onclick="requestTypeFlagEvent(this);">
															<span></span>Articles
														</label>
														<label class="radio">
															<input type="radio" name="rbtnRequestTypeFilterFlag" id="rbtnRequestTypeFilterFlag-3" value='4' onclick="requestTypeFlagEvent(this);">
															<span></span>Newsletters
														</label>
														<label class="radio">
															<input type="radio" name="rbtnRequestTypeFilterFlag" id="rbtnRequestTypeFilterFlag-3" value='5' onclick="requestTypeFlagEvent(this);">
															<span></span>Blogs
														</label>
														<label class="radio">
															<input type="radio" name="rbtnRequestTypeFilterFlag" id="rbtnRequestTypeFilterFlag-3" value='6' onclick="requestTypeFlagEvent(this);">
															<span></span>Subscribers
														</label>
														<label class="radio">
															<input type="radio" name="rbtnRequestTypeFilterFlag" id="rbtnRequestTypeFilterFlag-3" value='7' onclick="requestTypeFlagEvent(this);">
															<span></span>Contact Form Data
														</label>
													</div>
												</div>
												<div class="separator separator-solid mb-5"></div>
											</div>
											<div class="col-lg-4" id="dtpFromDateSection">
											    <div class="form-group">
													<label>From Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															
															$fromDate = date("d-m-Y");
														?>
														<input type="date" class="form-control" data-date-format="dd-mm-yyyy" id="dtpFromDate" placeholder="Select date" name="dtpFromDate" value="">
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="dtpToDateSection">
											    <div class="form-group">
													<label>To Date (DD-MM-YYYY)
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<?php
															
															$toDate = date("d-m-Y");
														?>
														<input type="date" class="form-control" data-date-format="dd-mm-yyyy" id="dtpToDate" placeholder="Select date" name="dtpToDate" value="">
													</div>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="separator separator-solid mb-5"></div>
											</div>
											<div class="col-lg-3" id="cmbManuscriptArticleIDSection">
										        <div class="form-group">
													<label>Article ID
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbManuscriptArticleID" id="cmbManuscriptArticleID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($manuscriptResult); $i++)
																{
																	echo "<option value=".$manuscriptResult[$i]['manuscriptID'].">IJPS/".$manuscriptResult[$i]['uniqueCode']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbManuscriptInfoIDSection">
										        <div class="form-group">
													<label>Article ID
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbManuscriptInfoID" id="cmbManuscriptInfoID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($manuscriptInfoResult); $i++)
																{
																	echo "<option value=".$manuscriptInfoResult[$i]['manuscriptInfoID'].">IJPS/".$manuscriptInfoResult[$i]['articleID']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbArticleIDSection">
										        <div class="form-group">
													<label>Article ID
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbArticleID" id="cmbArticleID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($articleResult); $i++)
																{
																	echo "<option value=".$articleResult[$i]['articleID'].">IJPS/".$articleResult[$i]['articleIDUniqueCode']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbArticalTypeIDSection">
										        <div class="form-group">
													<label>Artical Type
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbArticalTypeID" id="cmbArticalTypeID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($articalTypeResult); $i++)
																{
																	echo "<option value=".$articalTypeResult[$i]['articalTypeID'].">".$articalTypeResult[$i]['articalTypeName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
										    <div class="col-lg-3" id="cmbCountryIDSection">
										        <div class="form-group">
													<label>Country
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbCountryID" id="cmbCountryID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($countryResult); $i++)
																{
																	echo "<option value=".$countryResult[$i]['countryID'].">".$countryResult[$i]['countryName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbStatusIDSection">
										        <div class="form-group">
													<label>Status
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbStatusID" id="cmbStatusID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($statusResult); $i++)
																{
																	echo "<option value=".$statusResult[$i]['statusID'].">".$statusResult[$i]['statusName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbBlogCategoryIDSection">
										        <div class="form-group">
													<label>Blog Category
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbBlogCategoryID" id="cmbBlogCategoryID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($blogCategoryResult); $i++)
																{
																	echo "<option value=".$blogCategoryResult[$i]['blogCategoryID'].">".$blogCategoryResult[$i]['blogCategoryName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<?php
											/*
											<div class="col-lg-12">
												<div class="separator separator-solid mb-5"></div>
											</div>
											<div class="col-lg-3" id="cmbCountryIDSection">
										        <div class="form-group">
													<label>Country
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbCountryID" id="cmbCountryID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($countryResult); $i++)
																{
																	echo "<option value=".$countryResult[$i]['countryID'].">".$countryResult[$i]['countryName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbStateIDSection">
										        <div class="form-group">
													<label>State
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbStateID" id="cmbStateID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																for($i = 0; $i < count($stateResult); $i++)
																{
																	echo "<option value=".$stateResult[$i]['stateID'].">".$stateResult[$i]['stateName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbCityIDSection">
										        <div class="form-group">
													<label>City
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbCityID" id="cmbCityID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																for($i = 0; $i < count($cityResult); $i++)
																{
																	echo "<option value=".$cityResult[$i]['cityID'].">".$cityResult[$i]['cityName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbFromLocationCityIDSection">
										        <div class="form-group">
													<label>From City
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbFromLocationCityID" id="cmbFromLocationCityID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																for($i = 0; $i < count($cityResult); $i++)
																{
																	echo "<option value=".$cityResult[$i]['cityID'].">".$cityResult[$i]['cityName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbToLocationCityIDSection">
										        <div class="form-group">
													<label> To City
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbToLocationCityID" id="cmbToLocationCityID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																for($i = 0; $i < count($cityResult); $i++)
																{
																	echo "<option value=".$cityResult[$i]['cityID'].">".$cityResult[$i]['cityName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbBusClassIDSection">
										        <div class="form-group">
													<label>Bus Class
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbBusClassID" id="cmbBusClassID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($busClassResult); $i++)
																{
																	echo "<option value=".$busClassResult[$i]['busClassID'].">".$busClassResult[$i]['busClassName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											
											<div class="col-lg-3" id="cmbFlightClassIDSection">
										        <div class="form-group">
													<label>Flight Class
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbFlightClassID" id="cmbFlightClassID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($flightClassResult); $i++)
																{
																	echo "<option value=".$flightClassResult[$i]['flightClassID'].">".$flightClassResult[$i]['flightClassName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											
											<div class="col-lg-3" id="cmbTrainClassIDSection">
										        <div class="form-group">
													<label>Train Class
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbTrainClassID" id="cmbTrainClassID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($trainClassResult); $i++)
																{
																	echo "<option value=".$trainClassResult[$i]['trainClassID'].">".$trainClassResult[$i]['trainClassName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											
											<div class="col-lg-3" id="cmbFromRailwayStationIDSection">
										        <div class="form-group">
													<label>From Railway Station 
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbFromRailwayStationID" id="cmbFromRailwayStationID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($railwayStationResult); $i++)
																{
																	echo "<option value=".$railwayStationResult[$i]['railwayStationID'].">".$railwayStationResult[$i]['railwayStationCode']."-".$railwayStationResult[$i]['railwayStationName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbToRailwayStationIDSection">
										        <div class="form-group">
													<label>To Railway Station 
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbToRailwayStationID" id="cmbToRailwayStationID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($railwayStationResult); $i++)
																{
																	echo "<option value=".$railwayStationResult[$i]['railwayStationID'].">".$railwayStationResult[$i]['railwayStationCode']."-".$railwayStationResult[$i]['railwayStationName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											
											<div class="col-lg-3" id="cmbCabTypeIDSection">
										        <div class="form-group">
													<label>Cab Type
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbCabTypeID" id="cmbCabTypeID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($cabTypeResult); $i++)
																{
																	echo "<option value=".$cabTypeResult[$i]['cabTypeID'].">".$cabTypeResult[$i]['cabTypeName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbFromLocationAirportIDSection">
										        <div class="form-group">
													<label>From Airport
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbFromLocationAirportID" id="cmbFromLocationAirportID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($airportResult); $i++)
																{
																	echo "<option value=".$airportResult[$i]['airportID'].">".$airportResult[$i]['airportName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbToLocationAirportIDSection">
										        <div class="form-group">
													<label>To Airport
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbToLocationAirportID" id="cmbToLocationAirportID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($airportResult); $i++)
																{
																	echo "<option value=".$airportResult[$i]['airportID'].">".$airportResult[$i]['airportName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbCurrencyIDSection">
										        <div class="form-group">
													<label>Currency
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbCurrencyID" id="cmbCurrencyID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($currencyResult); $i++)
																{
																	echo "<option value=".$currencyResult[$i]['currencyID'].">".$currencyResult[$i]['currencyName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-3" id="cmbVisaTypeIDSection">
										        <div class="form-group">
													<label>Visa Type
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbVisaTypeID" id="cmbVisaTypeID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($visaTypeResult); $i++)
																{
																	echo "<option value=".$visaTypeResult[$i]['visaTypeID'].">".$visaTypeResult[$i]['visaTypeName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
											
											<!--<div class="col-lg-3" id="cmbCabTypeIDSection">
										        <div class="form-group">
													<label>Airport From
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbCabTypeID" id="cmbCabTypeID" class="form-control form-control-round" required>
															<option value="0" selected>--ALL--</option>
															<?php 
																 for($i = 0; $i < count($airportResult); $i++)
																{
																	echo "<option value=".$airportResult[$i]['airportID'].">".$airportResult[$i]['airportName']."</option>";
																}
															?>
														</select>
													</div>
												</div>
											</div>
										<div class="col-lg-4" id="cmbGenderIDSection">
										        <div class="form-group">
													<label>Gender
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbGenderID" id="cmbGenderID" class="form-control form-control-round" required>
																<?php 
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($genderResult); $i++)
																	{
    																		echo "<option value=".$genderResult[$i]['genderID'].">".$genderResult[$i]['name']."</option>";
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="cmbonBehalfOfIDSection">
										        <div class="form-group">
													<label>On Behalf Of
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbOnBehalfOfID" id="cmbOnBehalfOfID" class="form-control form-control-round" required>
															<option value='0' selected> --- ALL ---</option>
															<?php 
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($onBehalfOfResult); $i++)
																	{
																		echo "<option value=".$onBehalfOfResult[$i]['behalfOfID'].">".$onBehalfOfResult[$i]['label']."</option>";
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-4" id="cmbReligionIDSection">
										        <div class="form-group">
													<label>Religion
													<span class="text-danger">*</span></label>
													<div class="custom-file">
														<select name="cmbReligionID" id="cmbReligionID" class="form-control form-control-round" required>
																<?php 
																	echo "<option value='0' selected>-- ALL --</option>";
																	
																	 for($i = 0; $i < count($religionResult); $i++)
																	{
    																	echo "<option value=".$religionResult[$i]['religionID'].">".$religionResult[$i]['name']."</option>";
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-12" id="rbtnEmployeeFilterFlagSection">
										        <div class="form-group">
													<div class="radio-inline">
													    <label class="radio">
															<input type="radio" checked="checked" name="rbtnEmployeeFilterFlag" id="rbtnEmployeeFilterFlag-0" value='0'>
															<span></span>Working + Ex Employees
														</label>
														<label class="radio">
															<input type="radio" name="rbtnEmployeeFilterFlag" id="rbtnEmployeeFilterFlag-1" value='1'>
															<span></span>Working Employees
														</label>
														<label class="radio">
															<input type="radio" name="rbtnEmployeeFilterFlag" id="rbtnEmployeeFilterFlag-2" value='2'>
															<span></span>EX Employees
														</label>
													</div>
												</div>
											</div>-->
											*/
											?>
										</div>
									</div>
									<div class="card-footer" id="buttonSubmit">
										<button type="submit" class="btn btn-primary mr-2"><?php echo $buttonName; ?></button>
										<!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
									</div>
								</form>
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</div>
		
		<!--Main Content End-->
		
		<?php 
			$this->load->view(BACKOFFICE.'layout/footer');
			$this->load->view(BACKOFFICE.'layout/jsfiles');
		?>
		<script>
		    
		    document.getElementById('cmbManuscriptArticleIDSection').style.display = "";
            document.getElementById('cmbArticalTypeIDSection').style.display = "";
			document.getElementById('cmbCountryIDSection').style.display = "";
            document.getElementById('cmbStatusIDSection').style.display = "";
            document.getElementById('cmbBlogCategoryIDSection').style.display = "none";
            document.getElementById('cmbArticleIDSection').style.display = "none";
            document.getElementById('cmbManuscriptInfoIDSection').style.display = "none";
            
            
            
			
		</script>
		
		<script>
			function requestTypeFlagEvent(myRadio) {
                var requestTypeFlag = myRadio.value;
                
                if(requestTypeFlag == 1)
                {
					document.getElementById('cmbManuscriptArticleIDSection').style.display = "";
                    document.getElementById('cmbArticalTypeIDSection').style.display = "";
        			document.getElementById('cmbCountryIDSection').style.display = "";
                    document.getElementById('cmbStatusIDSection').style.display = "";
                    document.getElementById('cmbBlogCategoryIDSection').style.display = "none";
                    document.getElementById('cmbArticleIDSection').style.display = "none";
                    document.getElementById('cmbManuscriptInfoIDSection').style.display = "none";
				}
				else if(requestTypeFlag == 2)
                {
					document.getElementById('cmbManuscriptArticleIDSection').style.display = "none";
                    document.getElementById('cmbArticalTypeIDSection').style.display = "none";
        			document.getElementById('cmbCountryIDSection').style.display = "none";
                    document.getElementById('cmbStatusIDSection').style.display = "none";
                    document.getElementById('cmbBlogCategoryIDSection').style.display = "none";
                    document.getElementById('cmbArticleIDSection').style.display = "none";
                    document.getElementById('cmbManuscriptInfoIDSection').style.display = "";
				}
				else if(requestTypeFlag == 3)
                {
					document.getElementById('cmbManuscriptArticleIDSection').style.display = "none";
                    document.getElementById('cmbArticalTypeIDSection').style.display = "";
        			document.getElementById('cmbCountryIDSection').style.display = "none";
                    document.getElementById('cmbStatusIDSection').style.display = "none";
                    document.getElementById('cmbBlogCategoryIDSection').style.display = "none";
                    document.getElementById('cmbArticleIDSection').style.display = "";
                    document.getElementById('cmbManuscriptInfoIDSection').style.display = "none";
				}
				else if(requestTypeFlag == 4)
                {
					document.getElementById('cmbManuscriptArticleIDSection').style.display = "none";
                    document.getElementById('cmbArticalTypeIDSection').style.display = "none";
        			document.getElementById('cmbCountryIDSection').style.display = "none";
                    document.getElementById('cmbStatusIDSection').style.display = "none";
                    document.getElementById('cmbBlogCategoryIDSection').style.display = "none";
                    document.getElementById('cmbArticleIDSection').style.display = "none";
                    document.getElementById('cmbManuscriptInfoIDSection').style.display = "none";
				}
				else if(requestTypeFlag == 5)
                {
					document.getElementById('cmbManuscriptArticleIDSection').style.display = "none";
                    document.getElementById('cmbArticalTypeIDSection').style.display = "none";
        			document.getElementById('cmbCountryIDSection').style.display = "none";
                    document.getElementById('cmbStatusIDSection').style.display = "none";
                    document.getElementById('cmbBlogCategoryIDSection').style.display = "";
                    document.getElementById('cmbArticleIDSection').style.display = "none";
                    document.getElementById('cmbManuscriptInfoIDSection').style.display = "none";

				}
				else if(requestTypeFlag == 6)
                {
					document.getElementById('cmbManuscriptArticleIDSection').style.display = "none";
                    document.getElementById('cmbArticalTypeIDSection').style.display = "none";
        			document.getElementById('cmbCountryIDSection').style.display = "none";
                    document.getElementById('cmbStatusIDSection').style.display = "none";
                    document.getElementById('cmbBlogCategoryIDSection').style.display = "none";
                    document.getElementById('cmbArticleIDSection').style.display = "none";
                    document.getElementById('cmbManuscriptInfoIDSection').style.display = "none";
				}
				else if(requestTypeFlag == 7)
                {
					document.getElementById('cmbManuscriptArticleIDSection').style.display = "none";
                    document.getElementById('cmbArticalTypeIDSection').style.display = "none";
        			document.getElementById('cmbCountryIDSection').style.display = "none";
                    document.getElementById('cmbStatusIDSection').style.display = "none";
                    document.getElementById('cmbBlogCategoryIDSection').style.display = "none";
                    document.getElementById('cmbArticleIDSection').style.display = "none";
                    document.getElementById('cmbManuscriptInfoIDSection').style.display = "none";
				}
			}
		</script>
		
		<script type="text/javascript">
		$(document).ready(function(){
 
            $('#cmbDepartmentID').change(function(){  
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url(BACKOFFICE.'employee/EmployeeController/getDesignationsAsPerDepartment');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         
                        //var html = '';
                        var html = '<option value="0" selected> --- ALL ---</option>';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].designationID+'>'+data[i].designationName+'</option>';
                        }
                        $('#cmbDesignationID').html(html);
 
                    }
                });
                return false;
            }); 
             
        });
        </script>
        <script>
			var KTBootstrapDatepicker = function () {

				var arrows;
				if (KTUtil.isRTL()) {
					arrows = {
						leftArrow: '<i class="la la-angle-right"></i>',
						rightArrow: '<i class="la la-angle-left"></i>'
					}
				} else {
					arrows = {
					leftArrow: '<i class="la la-angle-left"></i>',
					rightArrow: '<i class="la la-angle-right"></i>'
					}
				}

				// minimum setup for modal demo
				$('#dtpFromDate').datepicker({
					rtl: KTUtil.isRTL(),
					todayHighlight: true,
					orientation: "bottom left",
					templates: arrows,
					autoclose: true
				});

				return {
					// public functions
					init: function() {
						demos();
					}
				};
			}();

			jQuery(document).ready(function() {
				KTBootstrapDatepicker.init();
			});
			
		</script>
		 <script>
			var KTBootstrapDatepicker = function () {

				var arrows;
				if (KTUtil.isRTL()) {
					arrows = {
						leftArrow: '<i class="la la-angle-right"></i>',
						rightArrow: '<i class="la la-angle-left"></i>'
					}
				} else {
					arrows = {
					leftArrow: '<i class="la la-angle-left"></i>',
					rightArrow: '<i class="la la-angle-right"></i>'
					}
				}

				// minimum setup for modal demo
				$('#dtpToDate').datepicker({
					rtl: KTUtil.isRTL(),
					todayHighlight: true,
					orientation: "bottom left",
					templates: arrows,
					autoclose: true
				});

				return {
					// public functions
					init: function() {
						demos();
					}
				};
			}();

			jQuery(document).ready(function() {
				KTBootstrapDatepicker.init();
			});
			
		</script>
	</body>
</html>