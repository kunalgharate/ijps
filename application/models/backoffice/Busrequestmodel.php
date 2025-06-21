<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class BusRequestModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
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
