<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class HotelRequestModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getHotelRequests($prop)
        {
			$this->db->select("pp_tblhotelrequest.*, pp_tblstate.stateName, pp_tblcity.cityName, pp_tblemployee.employeeName, pp_tblcompany.companyName, pp_tblstatus.statusName");	
			$this->db->join('pp_tblstate', 'pp_tblstate.stateID = pp_tblhotelrequest.stateID');
			$this->db->join('pp_tblcity', 'pp_tblcity.cityID = pp_tblhotelrequest.cityID');
			$this->db->join('pp_tblemployee', 'pp_tblemployee.employeeID = pp_tblhotelrequest.employeeID');
			$this->db->join('pp_tblcompany', 'pp_tblcompany.companyID = pp_tblemployee.companyID');
			$this->db->join('pp_tblstatus', 'pp_tblstatus.statusID = pp_tblhotelrequest.statusID');
			
			if($prop != '')
			{
				$this->db->where('pp_tblhotelrequest.hotelRequestID', $prop);
			}
			
			$this->db->order_by('hotelRequestID', 'desc');
            $result = $this->db->get('pp_tblhotelrequest');
            return $result->result_array();
        }
	}
