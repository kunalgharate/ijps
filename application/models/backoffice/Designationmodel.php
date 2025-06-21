<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class DesignationModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getDesignations()
        {
			$this->db->select("tbldesignation.*, tbldepartment.departmentName");	
			$this->db->join('tbldepartment', 'tbldepartment.departmentID = tbldesignation.departmentID');
            $this->db->order_by('designationID', 'desc');
            $result = $this->db->get('tbldesignation');
            return $result->result_array();
        }
		
		function getDesignationsAsPerDepartment($departmentID)
        {
            $query = $this->db->get_where('tbldesignation', array('departmentID' => $departmentID));
            //return $query;
            return $query->result_array();
        }
	}
