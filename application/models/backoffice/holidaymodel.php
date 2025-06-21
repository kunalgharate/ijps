<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class HolidayModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getHoliday()
        {
			$this->db->select("tblholiday.*"); 
			$this->db->where("YEAR(holidayDate) = YEAR(CURDATE())");
			$this->db->where('tblholiday.isActive', '1');
            $result = $this->db->get('tblholiday'); 
            return $result->result_array();
        }
	}
