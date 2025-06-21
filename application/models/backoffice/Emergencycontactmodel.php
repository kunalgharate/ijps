<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class EmergencyContactModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getEmergencyContacts()
        {
			$this->db->select("tblemergencycontact.*, tblemergencycontactcategory.name");
			$this->db->join('tblemergencycontactcategory', 'tblemergencycontact.emergencyContactCategoryID = tblemergencycontactcategory.emergencyContactCategoryID');
            $this->db->order_by('emergencyContactID', 'desc');
            $result = $this->db->get('tblemergencycontact');
            return $result->result_array();
        }
	}
