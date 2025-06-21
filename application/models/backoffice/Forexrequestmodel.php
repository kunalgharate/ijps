<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class ForexRequestModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getForexRequests($prop)
        {
			$this->db->select("pp_tblforexrequest.*, pp_tblcountry.countryName, pp_tblcurrency.currencyName, pp_tblemployee.employeeName, pp_tblcompany.companyName, pp_tblstatus.statusName");	
			$this->db->join('pp_tblcountry', 'pp_tblcountry.countryID = pp_tblforexrequest.countryID');
			$this->db->join('pp_tblcurrency', 'pp_tblcurrency.currencyID = pp_tblforexrequest.currencyID');
			$this->db->join('pp_tblemployee', 'pp_tblemployee.employeeID = pp_tblforexrequest.employeeID');
			$this->db->join('pp_tblcompany', 'pp_tblcompany.companyID = pp_tblemployee.companyID');
			$this->db->join('pp_tblstatus', 'pp_tblstatus.statusID = pp_tblforexrequest.statusID');
			
			if($prop != '')
			{
				$this->db->where('pp_tblforexrequest.forexRequestID', $prop);
			}
			
            $this->db->order_by('forexRequestID', 'desc');
            $result = $this->db->get('pp_tblforexrequest');
            return $result->result_array();
        }
	}
