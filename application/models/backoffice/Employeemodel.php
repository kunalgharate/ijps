<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class EmployeeModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getEmployees()
        {
			$this->db->select("pp_tblemployee.*, pp_tbldepartment.departmentName");	
			$this->db->join('pp_tbldepartment', 'pp_tbldepartment.departmentID = pp_tblemployee.departmentID');
            $this->db->order_by('employeeID', 'desc');
            $result = $this->db->get('pp_tblemployee');
            return $result->result_array();
        }
	}
