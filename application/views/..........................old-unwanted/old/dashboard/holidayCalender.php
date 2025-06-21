		<?php 
			$this->load->view('layout/header');
			$this->load->view('layout/sidemenu');
		?>
		<!--<link href="<?php echo base_url('assetsbackoffice/plugins/custom/fullcalendar/fullcalendar.bundle7a50.css?v=7.2.7'); ?>" rel="stylesheet" type="text/css" />-->
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
		<!--Main Content Start-->
		<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
			<!--page heading start-->
			<div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
				<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
					<div class="d-flex align-items-center flex-wrap mr-1">
						<div class="d-flex align-items-baseline flex-wrap mr-5">
							<h5 class="text-dark font-weight-bold my-1 mr-5"> Holiday Calender </h5>
							<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
								<li class="breadcrumb-item text-muted">
									<a href="<?php echo site_url('dashboard'); ?>" class="text-muted">Dashboard</a>
								</li>
								<li class="breadcrumb-item text-muted">
									<a class="text-muted"> Holiday Calender</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="d-flex align-items-center">
					</div>
				</div>
			</div>
			<!-- page heading end-->
			<div class="d-flex flex-column-fluid mt-10">
				<div class="container">
					<div class="row">
						<div class="col-xl-12">
							<div class="card card-custom card-stretch gutter-b shadow-box">
								<div class="card-header border-5 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label font-weight-bolder text-dark">Holiday List</span>
									</h3>
								</div>
								<div class="card-body pt-8">
									<div class="row">
									<?php										
										for($j=0; $j < count($holidayResult); $j++)
										{
									?>
										<div class="col-xl-4 mt-2">
											<div class="d-flex align-items-center mb-1">
												<div class="symbol symbol-40 symbol-light-white mr-5">
													<div class="symbol-label">
														<i class="fas fa-caret-right icon-1x"></i>
													</div>
												</div>
												<div class="d-flex flex-column font-weight-bold">
													<a href="tel:8855225555" class="text-dark text-hover-primary mb-1 font-size-lg">
														<?php
															echo $holidayResult[$j]['holidayTitle'];
														?>
													</a>
													<a href="tel:8855225555">
														<span class="text-muted">
															<?php 
																$YM = date('Y-m-d', strtotime($holidayResult[$j]['holidayDate'])); 
																echo $YM; 
															?>
														</span>
													</a>
												</div>
												<!--
												<div class="d-flex flex-column font-weight-bold">
													<a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">
														<?php 
															$YM = date('Y-m-d', strtotime($holidayResult[$j]['holidayDate'])); 
															echo $holidayResult[$j]['holidayTitle']."".$YM; 
														?> 
													</a>
												</div>-->
											</div>
										</div>
									<?php
										}
										
										if(count($holidayResult) == '0')
										{
											echo "<div class='col-xl-12'>".$noDataAvailable."</div>";
										}
									?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
			<!--<div class="d-flex flex-column-fluid">
				<div class="container">
					<div class="card card-custom shadow-box">
						<div class="card-header">
							<div class="card-title">
								<h3 class="card-label">
									Holiday Calendar
								</h3>
							</div>
							<div class="card-toolbar">
							</div>
						</div>
						<div class="card-body">
							<div id="kt_calendar"></div>
						</div>
					</div>
				</div>
			</div>-->
		</div>

		<?php 
			$this->load->view('layout/footer');
			$this->load->view('layout/jsfiles');
		?>
		<script>
			var KTCalendarBasic = function() {

			return {
						//main function to initiate the module
						init: function() {
						var todayDate = moment().startOf('day');
						var YM = todayDate.format('YYYY-MM');
						var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
						var TODAY = todayDate.format('YYYY-MM-DD');
						var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

						var calendarEl = document.getElementById('kt_calendar');
						var calendar = new FullCalendar.Calendar(calendarEl, {
							plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
							themeSystem: 'bootstrap',

							isRTL: KTUtil.isRTL(),

							header: {
							left: 'prev,next today',
							center: 'title',
							right: 'dayGridMonth' /*,timeGridWeek,timeGridDay'*/
						},

						height: 800,
						contentHeight: 780,
						aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

						nowIndicator: true,
						now: TODAY + 'T09:25:00', // just for demo

						views: {
							dayGridMonth: { buttonText: 'month' },
							timeGridWeek: { buttonText: 'week' },
							timeGridDay: { buttonText: 'day' }
						},

						defaultView: 'dayGridMonth',
						defaultDate: TODAY,

						editable: true,
						eventLimit: true, // allow "more" link when too many events
						navLinks: true,
						
						events: [
						
							<?php
							
								for($i=0; $i < count($holidayResult); $i++)
								{
									$YM = date('Y-m-d', strtotime($holidayResult[$i]['holidayDate'])); 
									if($i==0)
									{
										$className = "fc-event-danger fc-event-solid-warning";
									}
									else if($i==1)
									{
										$className = "fc-event-light fc-event-solid-primary";
									}
									else if($i==3)
									{
										$className = "fc-event-success";
									}
									else
									{
										$className = "fc-event-primary";
									}
	

									
								echo "{
										title: '".$holidayResult[$i]['holidayTitle']."',
										start: '".$YM."',
										description: '".$holidayResult[$i]['holidayTitle']."',
										className: \"".$className."\"
									},";
								}
							
							 
								/*{
								title: 'All Day Event',
								start: YM + '-01',
								description: 'Toto lorem ipsum dolor sit incid idunt ut',
								className: "fc-event-danger fc-event-solid-warning"
							},
							{
								title: 'Reporting',
								start: YM + '-14T13:30:00',
								description: 'Lorem ipsum dolor incid idunt ut labore',
								end: YM + '-14',
								className: "fc-event-success"
							},
							{
								title: 'Company Trip',
								start: YM + '-02',
								description: 'Lorem ipsum dolor sit tempor incid',
								end: YM + '-03',
								className: "fc-event-primary"
							},
							{
								title: 'ICT Expo 2017 - Product Release',
								start: YM + '-03',
								description: 'Lorem ipsum dolor sit tempor inci',
								end: YM + '-05',
								className: "fc-event-light fc-event-solid-primary"
							},
							{
								title: 'Dinner',
								start: YM + '-12',
								description: 'Lorem ipsum dolor sit amet, conse ctetur',
								end: YM + '-10'
							},
							{
								id: 999,
								title: 'Repeating Event',
								start: YM + '-09T16:00:00',
								description: 'Lorem ipsum dolor sit ncididunt ut labore',
								className: "fc-event-danger"
							},
							{
								id: 1000,
								title: 'Repeating Event',
								description: 'Lorem ipsum dolor sit amet, labore',
								start: YM + '-16T16:00:00'
							},
							{
								title: 'Conference',
								start: YESTERDAY,
								end: TOMORROW,
								description: 'Lorem ipsum dolor eius mod tempor labore',
								className: "fc-event-primary"
							},
							{
								title: 'Meeting',
								start: TODAY + 'T10:30:00',
								end: TODAY + 'T12:30:00',
								description: 'Lorem ipsum dolor eiu idunt ut labore'
							},
							{
								title: 'Lunch',
								start: TODAY + 'T12:00:00',
								className: "fc-event-info",
								description: 'Lorem ipsum dolor sit amet, ut labore'
							},
							{
								title: 'Meeting',
								start: TODAY + 'T14:30:00',
								className: "fc-event-warning",
								description: 'Lorem ipsum conse ctetur adipi scing'
							},
							{
								title: 'Happy Hour',
								start: TODAY + 'T17:30:00',
								className: "fc-event-info",
								description: 'Lorem ipsum dolor sit amet, conse ctetur'
							},
							{
								title: 'Dinner',
								start: TOMORROW + 'T05:00:00',
								className: "fc-event-solid-danger fc-event-light",
								description: 'Lorem ipsum dolor sit ctetur adipi scing'
							},
							{
								title: 'Birthday Party',
								start: TOMORROW + 'T07:00:00',
								className: "fc-event-primary",
								description: 'Lorem ipsum dolor sit amet, scing'
							},
							{
								title: 'Click for Google',
								url: 'http://google.com/',
								start: YM + '-28',
								className: "fc-event-solid-info fc-event-light",
								description: 'Lorem ipsum dolor sit amet, labore'
							}
							*/
							?>
							
						],

						eventRender: function(info) {
							var element = $(info.el);

							if (info.event.extendedProps && info.event.extendedProps.description) {
								if (element.hasClass('fc-day-grid-event')) {
									element.data('content', info.event.extendedProps.description);
									element.data('placement', 'top');
									KTApp.initPopover(element);
									} else if (element.hasClass('fc-time-grid-event')) {
										element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
									} else if (element.find('.fc-list-item-title').lenght !== 0) {
										element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
									}
								}
							}
						});

					calendar.render();
				}
			};
		}();

		jQuery(document).ready(function() {
			KTCalendarBasic.init();
		});
	</script>
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>