<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class DashboardModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }

		function getManuscriptCount($flag)
        {
			$this->db->select("count(ijps_tblmanuscript.manuscriptID) as count");	
			
			if($flag == 1)
			{
			    $this->db->where("EXTRACT(year from ijps_tblmanuscript.createdDate)=", date('Y'));
			}
			else if($flag == 2)
			{
			    $this->db->where("EXTRACT(year from ijps_tblmanuscript.createdDate)=", date('Y'));
			    $this->db->where("EXTRACT(month from ijps_tblmanuscript.createdDate)=", date('m'));
			}
            
            $this->db->where('isActive', '1');
            
            $result = $this->db->get('ijps_tblmanuscript');
            return $result->result_array();
        }
        
	}
