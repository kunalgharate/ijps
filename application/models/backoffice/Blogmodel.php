<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class BlogModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getBlogDetailsByTitle($prop)
        {
            $this->db->select("ijps_tblblogcategory.*, ijps_tblblog.*");	
			$this->db->join('ijps_tblblogcategory', 'ijps_tblblogcategory.blogCategoryID = ijps_tblblog.blogCategoryID');
			
			$this->db->where('ijps_tblblog.title', $prop);
			
            $this->db->order_by('blogID', 'desc');
            $result = $this->db->get('ijps_tblblog');
            return $result->result_array();
        }
        
		function getBlogDetails($prop)
        {
			$this->db->select("ijps_tblblogcategory.*, ijps_tblblog.*");	
			$this->db->join('ijps_tblblogcategory', 'ijps_tblblogcategory.blogCategoryID = ijps_tblblog.blogCategoryID');
			
			$this->db->where('ijps_tblblog.blogID', $prop);
			
            $this->db->order_by('blogID', 'desc');
            $result = $this->db->get('ijps_tblblog');
            return $result->result_array();
        }
		
        function getBlogGridDataAsPerCategory($prop)
        {
			$this->db->select("ijps_tblblogcategory.*, ijps_tblblog.*");	
			$this->db->join('ijps_tblblogcategory', 'ijps_tblblogcategory.blogCategoryID = ijps_tblblog.blogCategoryID');
			
			if($prop != '')
			{
				$this->db->where('ijps_tblblog.blogCategoryID', $prop);
			}
			
            $this->db->order_by('blogID', 'desc');
            $result = $this->db->get('ijps_tblblog');
            return $result->result_array();
        }
		
		function getBlogSearch($prop)
        {
            $title = explode(' ', $prop);
            $shortDescription = explode(' ', $prop);
            $description = explode(' ', $prop);
            
            $where = '';
            foreach ($title as $word) {
                $where .= "title LIKE '%$word%' OR ";
            }
            
            foreach ($shortDescription as $word) {
                $where .= "shortDescription LIKE '%$word%' OR ";
            }
            
            foreach ($description as $word) {
                $where .= "description LIKE '%$word%' OR ";
            }
            
            $where = rtrim($where, 'OR ');
            
            $query = $this->db->query("SELECT * FROM ijps_tblblog WHERE ($where) ");
            
            return $query->result_array();
        }
        
        function getNewsletterSearch($prop)
        {
            $title = explode(' ', $prop);
            $description = explode(' ', $prop);
            
            $where = '';
            foreach ($title as $word) {
                $where .= "title LIKE '%$word%' OR ";
            }
            
            foreach ($description as $word) {
                $where .= "description LIKE '%$word%' OR ";
            }
            
            $where = rtrim($where, 'OR ');
            
            $query = $this->db->query("SELECT * FROM ijps_tblnewsletter WHERE ($where) ");
            
            return $query->result_array();
        }
        
		function getBusRequests($prop)
        {
			$this->db->select("pp_tblbusrequest.*, pp_tblbusclass.busClassName, pp_tblemployee.employeeName, pp_tblcompany.companyName, fromLocation.cityName as fromLocationCityName, toLocationCity.cityName as toLocationCityName, pp_tblstatus.statusName");	
			$this->db->join('pp_tblbusclass', 'pp_tblbusclass.busClassID = pp_tblbusrequest.busClassID');
			$this->db->join('pp_tblemployee', 'pp_tblemployee.employeeID = pp_tblbusrequest.employeeID');
			$this->db->join('pp_tblcompany', 'pp_tblcompany.companyID = pp_tblemployee.companyID');
			$this->db->join('pp_tblcity as fromLocation', 'fromLocation.cityID = pp_tblbusrequest.fromLocationCityID');
			$this->db->join('pp_tblcity as toLocationCity', 'toLocationCity.cityID = pp_tblbusrequest.toLocationCityID');
			$this->db->join('pp_tblstatus', 'pp_tblstatus.statusID = pp_tblbusrequest.statusID');
			
			if($prop != '')
			{
				$this->db->where('pp_tblbusrequest.busRequestID', $prop);
			}
			
            $this->db->order_by('busRequestID', 'desc');
            $result = $this->db->get('pp_tblbusrequest');
            return $result->result_array();
        }
	}
