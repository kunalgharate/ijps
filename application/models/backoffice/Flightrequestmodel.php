<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class FlightRequestModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getFlightRequests($prop)
        {
			$this->db->select("pp_tblflightrequest.*, pp_tblflightclass.flightClassName, pp_tblemployee.employeeName, pp_tblcompany.companyName, fromLocation.airportName as fromLocationAirportName, toLocation.airportName as toLocationAirportName, pp_tblstatus.statusName");	
			$this->db->join('pp_tblflightclass', 'pp_tblflightclass.flightClassID = pp_tblflightrequest.flightClassID');
			$this->db->join('pp_tblemployee', 'pp_tblemployee.employeeID = pp_tblflightrequest.employeeID');
			$this->db->join('pp_tblcompany', 'pp_tblcompany.companyID = pp_tblemployee.companyID');
			$this->db->join('pp_tblairport as fromLocation', 'fromLocation.airportID = pp_tblflightrequest.fromLocationAirportID');
			$this->db->join('pp_tblairport as toLocation', 'toLocation.airportID = pp_tblflightrequest.toLocationAirportID');
			$this->db->join('pp_tblstatus', 'pp_tblstatus.statusID = pp_tblflightrequest.statusID');
			
			if($prop != '')
			{
				$this->db->where('pp_tblflightrequest.flightRequestID', $prop);
			}
			
            $this->db->order_by('flightRequestID', 'desc');
            $result = $this->db->get('pp_tblflightrequest');
            return $result->result_array();
        }
	}
