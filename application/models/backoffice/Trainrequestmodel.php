<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class TrainRequestModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getTrainRequests($prop)
        {
			$this->db->select("pp_tbltrainrequest.*, pp_tbltrainclass.trainClassName, pp_tblemployee.employeeName, pp_tblcompany.companyName, fromLocation.railwayStationName as fromLocationRailwayStationName, toLocation.railwayStationName as toLocationRailwayStationName, pp_tblstatus.statusName");	
			$this->db->join('pp_tbltrainclass', 'pp_tbltrainclass.trainClassID = pp_tbltrainrequest.trainClassID');
			$this->db->join('pp_tblemployee', 'pp_tblemployee.employeeID = pp_tbltrainrequest.employeeID');
			$this->db->join('pp_tblcompany', 'pp_tblcompany.companyID = pp_tblemployee.companyID');
			$this->db->join('pp_tblrailwaystation as fromLocation', 'fromLocation.railwayStationID = pp_tbltrainrequest.fromLocationRailwayStationID');
			$this->db->join('pp_tblrailwaystation as toLocation', 'toLocation.railwayStationID = pp_tbltrainrequest.toLocationRailwayStationID');
			$this->db->join('pp_tblstatus', 'pp_tblstatus.statusID = pp_tbltrainrequest.statusID');
			
			if($prop != '')
			{
				$this->db->where('pp_tbltrainrequest.trainRequestID', $prop);
			}
			
            $this->db->order_by('trainRequestID', 'desc');
            $result = $this->db->get('pp_tbltrainrequest');
            return $result->result_array();
        }
	}
