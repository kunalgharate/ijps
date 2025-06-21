<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class ProfileModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getProfiles()
        {
			$this->db->select("tblprofile.*, CONCAT(firstName, ' ', middleName, ' ', lastName) AS fullName");
            $this->db->order_by('profileID', 'desc');
            $result = $this->db->get('tblprofile');
            return $result->result_array();
        }
		
		function setEmployeeOfTheMonth($employeeID)
        {
			$this->db->set('employeeOfTheMonthFlag', '0');
            $this->db->update('tblprofile');
			
            $this->db->set('employeeOfTheMonthFlag', '1');
            $this->db->where('employeeID', $employeeID);
            return $this->db->update('tblprofile');
        }
		
		function setEmployeeOfTheYear($employeeID)
        {
			$this->db->set('employeeOfTheYearFlag', '0');
            $this->db->update('tblprofile');
			
            $this->db->set('employeeOfTheYearFlag', '1');
            $this->db->where('employeeID', $employeeID);
            return $this->db->update('tblprofile');
        }
		
		function endService($employeeID)
        {
            $this->db->set('serviceEndFlag', '1');
            $this->db->where('employeeID', $employeeID);
            return $this->db->update('tblprofile');
        }
			
		function getSearchEmployeeResult($where)
        {
			if($where != "")
			{
				$this->db->where($where);
			}
			
			$this->db->select("tblprofile.*, tbldepartment.departmentName, tblprofiletype.employeeTypeName, tbldesignation.designationName, tblshoesize.brandSize as shoesize, tblshirtsize.brandSize as shirtsize, tbltshirtsize.brandSize as tshirtsize, tblpantsize.brandSize as pantsize");
			$this->db->join('tbldepartment', 'tblprofile.departmentID = tbldepartment.departmentID');
			$this->db->join('tblprofiletype', 'tblprofile.employeeTypeID = tblprofiletype.employeeTypeID');
			$this->db->join('tbldesignation', 'tblprofile.designationID = tbldesignation.designationID');
			
			$this->db->join('tblshoesize', 'tblprofile.shoeSizeID = tblshoesize.shoeSizeID', 'left');
			$this->db->join('tblshirtsize', 'tblprofile.shirtSizeID = tblshirtsize.shirtSizeID', 'left');
			$this->db->join('tbltshirtsize', 'tblprofile.tShirtSizeID = tbltshirtsize.tShirtSizeID', 'left');
			$this->db->join('tblpantsize', 'tblprofile.pantSizeID = tblpantsize.pantSizeID', 'left');
			
            $this->db->order_by('employeeID', 'desc');
			$this->db->where('tblprofile.isActive', '1');
            $result = $this->db->get('tblprofile');
            return $result->result_array();
        }
	
		function getEmployeeDetailsAsPerParameters($type, $dayFlag)
        {
			// If $type - 1 = 'Birthday', 2 = 'Work Anniversary', 3 = 'Employee Of The Month & Year', 4 = 'New Employee Announcement', 5 = 'marriage Anniversary'
			// If $dayFlag - 0 = 'Today's', 1 = 'Upcoming'
			
			$this->db->select("tblprofile.*, tbldepartment.departmentName, tblprofiletype.employeeTypeName, tbldesignation.designationName");
			$this->db->join('tbldepartment', 'tblprofile.departmentID = tbldepartment.departmentID');
			$this->db->join('tblprofiletype', 'tblprofile.employeeTypeID = tblprofiletype.employeeTypeID');
			$this->db->join('tbldesignation', 'tblprofile.designationID = tbldesignation.designationID');
            //$this->db->order_by('employeeID', 'ASC');
			$this->db->where('serviceEndFlag', '0');
			$this->db->where('tblprofile.isActive', '1');
			
			if($type == '1' && $dayFlag == '0')
			{
				$this->db->where("DATE_FORMAT(dateOf‎Birth,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
			}
			else if($type == '1' && $dayFlag == '1')
			{
				/////$this->db->where("DATE_FORMAT(dateOf‎Birth,'%m-%d') > DATE_FORMAT(NOW(),'%m-%d')");
				//$this->db->limit(4);
				
				if(date('Y-m-d', strtotime('last day of this month', time())) == date('Y-m-d'))
				{
					$this->db->where("MONTH(dateOf‎Birth) = MONTH(CURDATE() + INTERVAL 1 MONTH)");
					$this->db->order_by('DAY(dateOf‎Birth)', 'asc');
					$this->db->where("DATE_FORMAT(dateOf‎Birth,'%m-%d') > DATE_FORMAT(NOW(),'%m-%d')");
				}
				else
				{
					$this->db->where("MONTH(dateOf‎Birth) = MONTH(CURDATE()) ");
					$this->db->order_by('DAY(dateOf‎Birth)', 'asc');
					$this->db->where("DATE_FORMAT(dateOf‎Birth,'%m-%d') > DATE_FORMAT(NOW(),'%m-%d')");
				}
			}
			else if($type == '2' && $dayFlag == '0')
			{
				$this->db->where("DATE_FORMAT(dateOfJoining,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
			}
			else if($type == '2' && $dayFlag == '1')
			{
				////$this->db->where("DATE_FORMAT(dateOfJoining,'%m-%d') > DATE_FORMAT(NOW(),'%m-%d')");
				//$this->db->limit(4);
				
				if(date('Y-m-d', strtotime('last day of this month', time())) == date('Y-m-d'))
				{
					$this->db->where("MONTH(dateOfJoining) = MONTH(CURDATE() + INTERVAL 1 MONTH)");
					$this->db->order_by('DAY(dateOfJoining)', 'asc');
					$this->db->where("DATE_FORMAT(dateOfJoining,'%m-%d') > DATE_FORMAT(NOW(),'%m-%d')");
				}
				else
				{
					$this->db->where("MONTH(dateOfJoining) = MONTH(CURDATE())");
					$this->db->order_by('DAY(dateOfJoining)', 'asc');
					$this->db->where("DATE_FORMAT(dateOfJoining,'%m-%d') > DATE_FORMAT(NOW(),'%m-%d')");
				}
			}
			else if($type == '3' && $dayFlag == '0')
			{
				// If $dayFlag - 0 = 'employeeOfTheMonthFlag', 1 = 'employeeOfTheYearFlag'
				
				$this->db->where('employeeOfTheMonthFlag = 1');
			}
			else if($type == '3' && $dayFlag == '1')
			{
				$this->db->where('employeeOfTheYearFlag = 1');
			}
			else if($type == '4' && $dayFlag == '0')
			{
				$this->db->where("DATE_FORMAT(tblprofile.dateOfJoining,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
			}
			else
			{
					//echo "sdfghjk";exit;
			}
			
            $result = $this->db->get('tblprofile');
            return $result->result_array();
        }
	}
