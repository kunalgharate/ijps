<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class JobPostModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getJobApplications($where)
        {
			if($where != "")
			{
				$this->db->where($where);
			}
			
			$this->db->select("tbljobpostresume.*, tbljobpost.jobTitle, tblemployee.fullName");
			$this->db->join('tblemployee', 'tbljobpostresume.employeeID = tblemployee.employeeID');
			$this->db->join('tbljobpost', 'tbljobpostresume.jobPostID = tbljobpost.jobPostID');
            $this->db->order_by('jobPostResumeID', 'desc');
            $result = $this->db->get('tbljobpostresume'); //print_r($result); echo $where; exit;
            return $result->result_array();
        }
	}
