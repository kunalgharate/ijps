<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class CabRequestModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getCabRequests($prop)
        {
			$this->db->select("pp_tblcabrequest.*, pp_tblstate.stateName, pp_tblcity.cityName, pp_tblcabtype.cabTypeName, pp_tblemployee.employeeName, pp_tblcompany.companyName, pp_tblstatus.statusName");	
			$this->db->join('pp_tblstate', 'pp_tblstate.stateID = pp_tblcabrequest.stateID');
			$this->db->join('pp_tblcity', 'pp_tblcity.cityID = pp_tblcabrequest.cityID');
			$this->db->join('pp_tblcabtype', 'pp_tblcabtype.cabTypeID = pp_tblcabrequest.cabTypeID');
			$this->db->join('pp_tblemployee', 'pp_tblemployee.employeeID = pp_tblcabrequest.employeeID');
			$this->db->join('pp_tblcompany', 'pp_tblcompany.companyID = pp_tblemployee.companyID');
			$this->db->join('pp_tblstatus', 'pp_tblstatus.statusID = pp_tblcabrequest.statusID');
			
			if($prop != '')
			{
				$this->db->where('pp_tblcabrequest.cabRequestID', $prop);
			}
			
            $this->db->order_by('cabRequestID', 'desc');
            $result = $this->db->get('pp_tblcabrequest');
            return $result->result_array();
        }
	}
