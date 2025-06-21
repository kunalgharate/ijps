<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class AuthorModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getAuthors()
        {
			$this->db->select("ijps_tblauthor.*, ijps_tbldesignation.designationName");	
			$this->db->join('ijps_tbldesignation', 'ijps_tbldesignation.designationID = ijps_tblauthor.designationID');
            $this->db->order_by('authorID', 'desc');
            $result = $this->db->get('ijps_tblauthor');
            return $result->result_array();
        }
		
		function getAuthor($prop)
        {
			$this->db->select("ijps_tblauthor.*, ijps_tbldesignation.designationName");	
			$this->db->join('ijps_tbldesignation', 'ijps_tbldesignation.designationID = ijps_tblauthor.designationID');
            $this->db->order_by('authorID', 'desc');
			$this->db->where('authorID', $prop);
            $result = $this->db->get('ijps_tblauthor');
            return $result->result_array();
        }
	}
