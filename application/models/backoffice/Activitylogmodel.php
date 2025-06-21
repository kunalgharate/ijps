<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class ActivityLogModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getActivityLog($where, $websiteLog)
        {
			if($where != "")
			{
				$this->db->where($where);
			}
			
			if($websiteLog == '1')
			{
				$this->db->select("tblactivitylog.*, concat(tbluser.userFullName, ' (', tbluser.userName, ')') as activityUser"); 
				//, tbljobpost.jobTitle, tblemployee.fullName");
			
				$this->db->join('tbluser', 'tbluser.userID = tblactivitylog.createdByUserID');
				//$this->db->join('tbljobpost', 'tbljobpostresume.jobPostID = tbljobpost.jobPostID');
			}
			else
			{
				$this->db->select("tblactivitylog.*, concat(tblemployee.fullName, ' (', tblemployee.employeeCode, ')') as activityUser"); 
				$this->db->join('tblemployee', 'tblemployee.employeeID = tblactivitylog.createdByUserID');
			}
			
            //$this->db->order_by('jobPostResumeID', 'desc');
            $result = $this->db->get('tblactivitylog'); //print_r($result); echo $where; exit;
            return $result->result_array();
        }
	}
