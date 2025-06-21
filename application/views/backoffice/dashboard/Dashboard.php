		<?php 
			$this->load->view(BACKOFFICE.'layout/header');
			$this->load->view(BACKOFFICE.'layout/sidemenu');
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

        <div class=" container d-flex flex-column flex-column-fluid">
            <div class="row">
                <div class="col-xl-12">
                     <div class="card1 card-custom gutter-b card-stretch" style="background-color: #eef0f8;">
                        <div class="card-body p-0 position-relative overflow-hidden">
                            <div class="card-spacer1 ">
                                <div class="row m-0">
                                    <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                                        <div class="row m-0">
                                            <div class="col-3 px-0 py-0">
                                                <span class="svg-icon svg-icon-3x svg-icon-gray-500 d-block my-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                                        </g> 
                                                    </svg>
                                                </span>
                                            </div> 
                                            <div class="col-9 my-4">
                                                <div class="font-size-sm text-muted font-weight-bold mb-1">Manuscript Received</div>
                                                <div class="font-size-h4 font-weight-bolder mb-1"><?php echo $manuscriptYearCount; ?></div> 
                                                <div class="font-size-sm text-muted font-weight-bold">This Month</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                                        <div class="row m-0">
                                            <div class="col-3 px-0 py-0">
                                                <span class="svg-icon svg-icon-3x svg-icon-gray-500 d-block my-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                                        </g> 
                                                    </svg>
                                                </span>
                                            </div> 
                                            <div class="col-9 my-4">
                                                <div class="font-size-sm text-muted font-weight-bold mb-1">Manuscript Received</div>
                                                <div class="font-size-h4 font-weight-bolder mb-1"><?php echo $manuscriptMonthCount; ?></div>
                                                <div class="font-size-sm text-muted font-weight-bold mb-1">This Year</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                                        <div class="row m-0">
                                            <div class="col-3 px-0 py-0">
                                                <span class="svg-icon svg-icon-3x svg-icon-gray-500 d-block my-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                                        </g> 
                                                    </svg>
                                                </span>
                                            </div> 
                                            <div class="col-9 my-4">
                                                <div class="font-size-sm text-muted font-weight-bold mb-1">Article Published</div>
                                                <div class="font-size-h4 font-weight-bolder mb-1"><?php echo $articleCount; ?></div> 
                                                <div class="font-size-sm text-muted font-weight-bold">Till Date</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col bg-white px-6 py-8 rounded-xl mr-7 mb-7">
                                        <div class="row m-0">
                                            <div class="col-3 px-0 py-0">
                                                <span class="svg-icon svg-icon-3x svg-icon-gray-500 d-block my-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                                        </g> 
                                                    </svg>
                                                </span>
                                            </div> 
                                            <div class="col-9 my-4">
                                                <div class="font-size-sm text-muted font-weight-bold mb-1">Blog Published</div>
                                                <div class="font-size-h4 font-weight-bolder mb-1"><?php echo $blogCount; ?></div> 
                                                <div class="font-size-sm text-muted font-weight-bold">Till Date</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php 
			$this->load->view(BACKOFFICE.'layout/footer');
			$this->load->view(BACKOFFICE.'layout/jsfiles');
		?>
		
		<!-- Dashboard Page Scripts start -->
		<script src="<?php echo base_url('assetsbackoffice/js/pages/widgets7a50.js?v=7.2.7'); ?>"></script>
		<!-- Dashboard Page Scripts End -->
	</body>
</html>