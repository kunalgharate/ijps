<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class DashboardController extends CI_Controller 
    {
        public function __construct() 
        {
            parent::__construct();
            
			if($this->session->userdata('userFullName') == "" || $this->session->userdata('mailID') == "")
            {
                redirect(BACKOFFICE.'login', 'refresh');
               
            }
            $this->load->model(BACKOFFICE.'Dashboardmodel', 'DashboardModel');
        }
        
    	public function index()
    	{ 
    	    $manuscriptMonthCount = [['count' => 10]];
			$manuscriptYearCount = [['count' => 25]];
			$articleCount = 50; // dummy
			$blogCount = 15; // dummy
    	    
			$this->load->view(BACKOFFICE.'dashboard/Dashboard',['manuscriptMonthCount' => $manuscriptMonthCount[0]['count'], 'manuscriptYearCount' => $manuscriptYearCount[0]['count'], 'articleCount' => $articleCount, 'blogCount' => $blogCount]);
    	}
    }
    