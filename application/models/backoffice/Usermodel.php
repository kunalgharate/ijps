<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class UserModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        public function insertUser($prop)
        {
            return $this->db->insert('tbluser',$prop);
        }
        
		function getUser($prop)
        {
            $this->db->where('userID',$prop);
            $result = $this->db->get('tbluser');
            return $result->result_array();
        }
        
        function getUserByMobileNumber($prop)
        {
            $this->db->where('userName',$prop);
            $result = $this->db->get('tbluser');
            return $result->result_array();
        }
        
        function updateUserAdmin($prop, $employeeID)
        {
            $this->db->where('userType','4');
            $this->db->where('userID',$employeeID);
            return $this->db->update('tbluser', $prop);
        }
        
		function updateUser($prop, $employeeID)
        {
            $this->db->where('userType','5');
            $this->db->where('userReferenceID',$employeeID);
            return $this->db->update('tbluser', $prop);
        }
		
		function changePassword($prop, $userID)
        {
            $this->db->where('userID',$userID);
            return $this->db->update('tbluser', $prop);
        }
        
        function getUsers($flag)
        {
            $this->db->order_by('userID', 'desc');
            $this->db->select("*");
            $this->db->from("tbluser");
            $this->db->where('userType', $flag);
            $this->db->where('userReferenceID', '0');
            $query = $this->db->get();
            return $query->result_array();
        }
        
        function setVisibilityUser($isActive, $userID)
        {
            $this->db->set('isActive', $isActive);
            $this->db->where('userID', $userID);
            return $this->db->update('tbluser');
        }
        
        function checkDuplicateUsername($usernameID)
        {
            $this->db->where('userName',$usernameID);
            $resultUser = $this->db->get('tbluser');
            
            $userDataResult = $resultUser->result_array();

			if(count($resultUser->result_array())>0)
			{
				return $userDataResult['0']['userID'];
			}
			else
			{
				return 0;
			}
        }
        
    }