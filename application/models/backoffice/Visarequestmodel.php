<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class VisaRequestModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getVisaRequests($prop)
        {
			$this->db->select("pp_tblvisarequest.*, pp_tblcountry.countryName, pp_tblvisatype.visaTypeName, pp_tblemployee.employeeName, pp_tblcompany.companyName, pp_tblstatus.statusName");	
			$this->db->join('pp_tblcountry', 'pp_tblcountry.countryID = pp_tblvisarequest.countryID');
			$this->db->join('pp_tblvisatype', 'pp_tblvisatype.visaTypeID = pp_tblvisarequest.visaTypeID');
			$this->db->join('pp_tblemployee', 'pp_tblemployee.employeeID = pp_tblvisarequest.employeeID');
			$this->db->join('pp_tblcompany', 'pp_tblcompany.companyID = pp_tblemployee.companyID');
			$this->db->join('pp_tblstatus', 'pp_tblstatus.statusID = pp_tblvisarequest.statusID');
			
			if($prop != '')
			{
				$this->db->where('pp_tblvisarequest.visaRequestID', $prop);
			}
			
            $this->db->order_by('visaRequestID', 'desc');
            $result = $this->db->get('pp_tblvisarequest');
            return $result->result_array();
        }
	}
