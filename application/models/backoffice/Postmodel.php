<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class PostModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getPosts()
        {
			$this->db->select("tblpost.*, tblpostcategory.name");	
			$this->db->join('tblpostcategory', 'tblpost.postCategoryID = tblpostcategory.postCategoryID');
            $this->db->order_by('postID', 'desc');
            $result = $this->db->get('tblpost');
            return $result->result_array();
        }
		
		function getPost($postID)
        {
			$this->db->select("tblpost.*, tblpostcategory.name");
			$this->db->join('tblpostcategory', 'tblpost.postCategoryID = tblpostcategory.postCategoryID');
			$this->db->where('tblpost.isActive', '1');
			$this->db->where('postID', $postID);
            $result = $this->db->get('tblpost');
            return $result->result_array();
        }
		
		function getUpcomingTrainings($flag, $visibleForFlag)
        {	
			if($visibleForFlag == '0')
			{
				$this->db->where('tblpost.visibleForFlag', '0');
			}
			
			$this->db->select("tblpost.*, tblpostcategory.name");	
			$this->db->join('tblpostcategory', 'tblpost.postCategoryID = tblpostcategory.postCategoryID');
            $this->db->order_by('postID', 'desc');
			$this->db->where('tblpost.isActive', '1');
			$this->db->where('tblpost.postCategoryID', '5');
			$this->db->where("DATE(dateOf‎Training) BETWEEN CURDATE() AND DATE_ADD(CURDATE(),INTERVAL 1 YEAR)");
            $result = $this->db->get('tblpost');
			
			if($flag == '0')
			{
				return $result->num_rows();
			}
			else
			{
				return $result->result_array();
			}
        }
		
		function getCompletedTrainings($flag, $visibleForFlag)
        {
			if($visibleForFlag == '0')
			{
				$this->db->where('tblpost.visibleForFlag', '0');
			}
			
			$this->db->select("tblpost.*, tblpostcategory.name");	
			$this->db->join('tblpostcategory', 'tblpost.postCategoryID = tblpostcategory.postCategoryID');
            $this->db->order_by('postID', 'desc');
			$this->db->where("DATE(dateOf‎Training) BETWEEN DATE_SUB(CURDATE(),INTERVAL 5 YEAR) AND DATE_SUB(CURDATE(),INTERVAL 1 DAY)");
			$this->db->where('tblpost.isActive', '1');
            $result = $this->db->get('tblpost');
			
			if($flag == '0')
			{
				return 	$result->num_rows();
			}
			else
			{
				return $result->result_array();
			}
        }
		
		function getTrainingFeedbacks()
        {
			$this->db->select("tbltrainingfeedback.*, tblpost.postHeading, tblemployee.fullName");	
			$this->db->join('tblpost', 'tblpost.postID = tbltrainingfeedback.postID');
			$this->db->join('tblemployee', 'tblemployee.employeeID = tbltrainingfeedback.employeeID');
            $this->db->order_by('trainingFeedbackID', 'desc');
			$this->db->where('tbltrainingfeedback.isActive', '1');
            $result = $this->db->get('tbltrainingfeedback');
			
			return $result->result_array();
        }
		
	}
