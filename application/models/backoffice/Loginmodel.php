<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model 
{
	function gettestdata()
    {
        $this->db->select('*');
        $this->db->from('test');
        return $this->db->get();
	
    }
	
    function checkLogin($userName, $password)
    {
        /*
        $this->db->where('userName', $userName);
        //$this->db->where('password', $password);
        $this->db->select('*');
        $this->db->from('tbluser');
        //return $this->db->get();
		
		$loginResult = $this->db->get(); 
		$result = $loginResult->row(); 
		if($result) {
			$encrypted_password = $result->password;
			if(password_verify($password, $encrypted_password)) {
				return $loginResult;
			}
		}
		return false;*/
		
		$this->db->where('userName', $userName);
        $this->db->where('password', $password);
        $this->db->select('*');
        $this->db->from('tbluser');
        $loginResult = $this->db->get();
        
        $result = $loginResult->row(); 
		if($result) {
			return $loginResult;
		}
		return false;
    }
    
    /*public function checkLogin($userName, $password)
    {
        $this->db->select('tbluserMaster.*, tblClientMaster.*');
        $this->db->from('tbluserMaster');
        $this->db->join('tblClientMaster', 'tblClientMaster.clientID = tbluserMaster.clientID');
        $this->db->where('userName', $userName);
        $this->db->where('password', $password);
        return $this->db->get();
    }*/
    
    public function checkEmail($emailID)
    {
        $this->db->select('*');
        $this->db->from('tbluser');
        $this->db->where('userName', $emailID);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getUSers()
    {
        $this->db->select('*');
        $this->db->from('tbluser');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function checkAuthorLogin($userName, $password)
    {
       $this->db->where('email', $userName);
        $this->db->where('password', $password);
        $this->db->select('*');
        $this->db->from('ijps_tblauthor');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result_array();
    }   
    
    function setVisibilityUser($isActive, $userID)
        {
            $this->db->set('isActive', $isActive);
            $this->db->where('userID', $userID);
            return $this->db->update('tbluser');
        }
		
	
	public function getNotificationData($flag)
    {
		$this->db->select('*');
        $this->db->from('tblactivitylog');
		$this->db->where('isActive', '1');
		
		if($flag =='0')
		{	
			$this->db->where("createdDate BETWEEN DATE_SUB(NOW(), INTERVAL 10 DAY) AND NOW()");
		}
		else
		{
			$this->db->limit(5);
			$this->db->order_by("activityLogID", "desc");
		}
		
		$this->db->group_start();
		$this->db->like('description', 'Post : Added');
		$this->db->or_like('description', 'Job post : Added');
		$this->db->or_like('description', 'Bank Data : Added');
		$this->db->or_like('description', 'Important link : Added');
		$this->db->or_like('description', 'Guest : Added');
		$this->db->or_like('description', 'Employee : Added');
		$this->db->or_like('description', 'Emergency contact : Added');
		$this->db->or_like('description', 'Company Video : Added');
		$this->db->or_like('description', 'Company Presentation Template : Added');
		$this->db->group_end();
		$this->db->order_by('activityLogID', 'desc');
		//$this->db->like('description', 'Added');
		//$this->db->where("DATE_FORMAT(createdDate,'%m-%d-%Y') < DATE_FORMAT(NOW(),'%m-%d-%Y')");
        $query = $this->db->get();
        return $query->result_array();
    }
        
}
