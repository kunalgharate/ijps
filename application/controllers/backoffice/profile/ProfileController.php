<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class ProfileController extends CI_Controller 
    {
		public static $table 				= "tblprofile";
		public static $pkey 				= "profileID";
		public static $messageCommonText 	= "Profile";
		
        public function __construct() 
        {
            parent::__construct();
            
            if($this->session->userdata('userFullName') == ""|| $this->session->userdata('mailID') == "")
            {
                redirect(BACKOFFICE.'LoginController', 'refresh');
            } 
			
			$this->load->model(BACKOFFICE.'Profilemodel', 'ProfileModel');
			$this->load->model(BACKOFFICE.'Designationmodel', 'DesignationModel');
        }
        
    	public function index()
    	{
			$departmentResult			= $this->CommonModel->getData('tbldepartment','','','','');
			$designationResult			= $this->CommonModel->getData('tbldesignation','','','','');
			$employeeTypeResult			= $this->CommonModel->getData('tblemployeetype','','','','');
			
            $this->load->view(BACKOFFICE.'employee/addEmployee', ['departmentResult' 		=> $departmentResult, 
																	'designationResult' 	=> $designationResult, 
																	'employeeTypeResult' 	=> $employeeTypeResult
																]);
    	}
    	
    	public function insertProfile()
        {  
            if(
                $this->input->post('cmbDepartmentID')!="" &&
                $this->input->post('cmbDesignationID')!="" &&
				$this->input->post('cmbEmployeeTypeID')!="" &&
				$this->input->post('txtFullName')!="" &&
                $this->input->post('txtContactNumber')!="" &&
				$this->input->post('txtLandlineNumber')!="" &&
				$this->input->post('dtpDateOf‎Birth')!="" &&
                $this->input->post('dtpDateOf‎Joining')!="" &&
				$this->input->post('txtEmail')!="" &&
				$this->input->post('txtAddress')!="" &&
                $_FILES['txtPhoto']['name']!=""
            )
            {
				if(!empty($this->input->post('dtpDateOf‎Birth')))
                {
                    $dtpDateOf‎Birth   = strtotime(date($this->input->post('dtpDateOf‎Birth')));
				    $dtpDateOf‎Birth   = date("Y-m-d", $dtpDateOf‎Birth);
                }
                else
                {
                    $dtpDateOf‎Birth   = "0000-00-00";
                }
				
				if(!empty($this->input->post('dtpDateOf‎Joining')))
                {
                    $dtpDateOf‎Joining   = strtotime(date($this->input->post('dtpDateOf‎Joining')));
				    $dtpDateOf‎Joining   = date("Y-m-d", $dtpDateOf‎Joining);
                }
                else
                {
                    $dtpDateOf‎Joining   = "0000-00-00";
                }
				
				if($_FILES['txtPhoto']['name']=="")
				{
					$photo = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtPhoto']['name'], '.'), 1);
					$photo = "employeePhoto-".date('YmdHis').".".$ext;
				}
				
				$prop = array( 
								'departmentID '		=> filter_var($this->input->post('cmbDepartmentID'), FILTER_SANITIZE_NUMBER_INT),
								'designationID'		=> filter_var($this->input->post('cmbDesignationID'), FILTER_SANITIZE_NUMBER_INT),
								'employeeTypeID'	=> filter_var($this->input->post('cmbEmployeeTypeID'), FILTER_SANITIZE_NUMBER_INT),
								'fullName'			=> $this->input->post('txtFullName', true),
								'contactNumber'		=> $this->input->post('txtContactNumber', true),
								'landlineNumber'	=> $this->input->post('txtLandlineNumber', true),
								'dateOf‎Birth'		=> $dtpDateOf‎Birth,
								'dateOfJoining'		=> $dtpDateOf‎Joining,
								'emailAddress'		=> filter_var($this->input->post('txtEmail'), FILTER_VALIDATE_EMAIL),
								'address'			=> $this->input->post('txtAddress', true),
								'photo'				=> $photo,
								'createdByUserID'	=> filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
                    if($_FILES["txtPhoto"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE_PHOTO.$photo;

						if(move_uploaded_file($_FILES['txtPhoto']['tmp_name'], $target_file))
						{
						}
						else 
						{
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					// Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Employee Name : ".$this->input->post('txtFullName', true).")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
					$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
        }
                    
		public function getEmployee($prop)
		{	
			$departmentResult			= $this->CommonModel->getData('tbldepartment','','','','');
			$designationResult			= $this->CommonModel->getData('tbldesignation','','','','');
			$employeeTypeResult			= $this->CommonModel->getData('tblemployeetype','','','','');
			$employeeResult				= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');
			
			if(!empty($employeeResult))
			{
				$this->load->view(BACKOFFICE.'employee/addEmployee',[
																		'departmentResult' 		=> $departmentResult, 
																		'designationResult' 	=> $designationResult, 
																		'employeeTypeResult' 	=> $employeeTypeResult, 
																		'employeeResult' 		=> $employeeResult
																	]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
			}
		}
        
        public function updateEmployee()
        {
            if(
                $this->input->post('cmbDepartmentID')!="" &&
                $this->input->post('cmbDesignationID')!="" &&
				$this->input->post('cmbEmployeeTypeID')!="" &&
				$this->input->post('txtFullName')!="" &&
                $this->input->post('txtContactNumber')!="" &&
				$this->input->post('txtLandlineNumber')!="" &&
				$this->input->post('dtpDateOf‎Birth')!="" &&
                $this->input->post('dtpDateOf‎Joining')!="" &&
				$this->input->post('txtEmail')!="" &&
				$this->input->post('txtAddress')!="" &&
				$this->input->post('txtEmployeeID')!=""
            )
            {
				if(!empty($this->input->post('dtpDateOf‎Birth')))
                {
                    $dtpDateOf‎Birth   = strtotime(date($this->input->post('dtpDateOf‎Birth')));
				    $dtpDateOf‎Birth   = date("Y-m-d", $dtpDateOf‎Birth);
                }
                else
                {
                    $dtpDateOf‎Birth   = "0000-00-00";
                }
				
				if(!empty($this->input->post('dtpDateOf‎Joining')))
                {
                    $dtpDateOf‎Joining   = strtotime(date($this->input->post('dtpDateOf‎Joining')));
				    $dtpDateOf‎Joining   = date("Y-m-d", $dtpDateOf‎Joining);
                }
                else
                {
                    $dtpDateOf‎Joining   = "0000-00-00";
                }
				
				if($_FILES['txtPhoto']['name']=="")
				{
					$photo = $this->input->post('txtPhoto');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtPhoto']['name'], '.'), 1);
					$photo = "employeePhoto-".date('YmdHis').".".$ext;
				}
				
				$prop = array( 
								'departmentID '		=> filter_var($this->input->post('cmbDepartmentID'), FILTER_SANITIZE_NUMBER_INT),
								'designationID'		=> filter_var($this->input->post('cmbDesignationID'), FILTER_SANITIZE_NUMBER_INT),
								'employeeTypeID'	=> filter_var($this->input->post('cmbEmployeeTypeID'), FILTER_SANITIZE_NUMBER_INT),
								'fullName'			=> $this->input->post('txtFullName', true),
								'contactNumber'		=> $this->input->post('txtContactNumber', true),
								'landlineNumber'	=> $this->input->post('txtLandlineNumber', true),
								'dateOf‎Birth'		=> $dtpDateOf‎Birth,
								'dateOfJoining'		=> $dtpDateOf‎Joining,
								'emailAddress'		=> filter_var($this->input->post('txtEmail'), FILTER_VALIDATE_EMAIL),
								'address'			=> $this->input->post('txtAddress', true),
								'photo'				=> $photo,
								'createdByUserID'	=> filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $employeeID = filter_var($this->input->post('txtEmployeeID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $employeeID, self::$pkey);

               if($bool == 1)
                  {
                    if($_FILES["txtPhoto"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE_PHOTO.$photo;

						if(move_uploaded_file($_FILES['txtPhoto']['tmp_name'], $target_file))
						{
						}
						else 
						{
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".$employeeID." - Employee Name : ".$this->input->post('txtFullName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
                  }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
           
        }
        
		public function setVisibilityEmployee($employeeID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $employeeID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$employeeID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
        }
        
        public function deleteEmployee($employeeID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $employeeID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$employeeID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
        }  
    
		public function employeeOfTheMonth($employeeID)
        {
            $bool = $this->EmployeeModel->setEmployeeOfTheMonth($employeeID);
            
            if ($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : set as employee of the month (".self::$pkey." : ".$employeeID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' successfully added as employee of the month...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
            else
            {
				$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
        }
		
		public function employeeOfTheYear($employeeID)
        {
            $bool = $this->EmployeeModel->setEmployeeOfTheYear($employeeID);
            
            if ($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : set as employee of the year (".self::$pkey." : ".$employeeID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' successfully added as employee of the year...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
        }
		
		public function searchProfiles()
    	{
			$genderResult			= $this->CommonModel->getData('tblgender','','','','');
			$onBehalfOfResult			= $this->CommonModel->getData('tblbehalfof','','','','');
			$religionResult			= $this->CommonModel->getData('tblreligion','','','','');
			
            $this->load->view(BACKOFFICE.'profile/searchProfiles', ['genderResult' => $genderResult, 'onBehalfOfResult' => $onBehalfOfResult, 'religionResult' => $religionResult]);
    	}
		
		public function endService($employeeID)
        {
            $bool = $this->EmployeeModel->endService($employeeID);
            
            if ($bool == 1)
            {
				// Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Sevice Ended (".self::$pkey." : ".$this->db->insert_id().")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
				$this->session->set_userdata('toastrSuccess', 'Service end successfully...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', 'Service end error...');
				redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
            }
        }
		
		public function mySizes()
    	{
			$shoeSizeMaleResult				= $this->CommonModel->getData('tblshoesize',array('genderFlag'=>'0'),'','','');
			$tShirtSizeMaleResult			= $this->CommonModel->getData('tbltshirtsize',array('genderFlag'=>'0'),'','','');
			$shirtSizeMaleResult			= $this->CommonModel->getData('tblshirtsize',array('genderFlag'=>'0'),'','','');
			$pantSizeMaleResult				= $this->CommonModel->getData('tblpantsize',array('genderFlag'=>'0'),'','','');
			
			$shoeSizeFemaleResult			= $this->CommonModel->getData('tblshoesize',array('genderFlag'=>'1'),'','','');
			$tShirtSizeFemaleResult			= $this->CommonModel->getData('tbltshirtsize',array('genderFlag'=>'1'),'','','');
			$shirtSizeFemaleResult			= $this->CommonModel->getData('tblshirtsize',array('genderFlag'=>'1'),'','','');
			$pantSizeFemaleResult			= $this->CommonModel->getData('tblpantsize',array('genderFlag'=>'1'),'','','');
			
			
            $this->load->view(BACKOFFICE.'employee/mySizes', [
														'shoeSizeMaleResult' 		=> $shoeSizeMaleResult,
														'tShirtSizeMaleResult' 		=> $tShirtSizeMaleResult,
														'shirtSizeMaleResult' 		=> $shirtSizeMaleResult,
														'pantSizeMaleResult' 		=> $pantSizeMaleResult,
														'shoeSizeFemaleResult' 		=> $shoeSizeFemaleResult,
														'tShirtSizeFemaleResult' 	=> $tShirtSizeFemaleResult,
														'shirtSizeFemaleResult' 	=> $shirtSizeFemaleResult,
														'pantSizeFemaleResult' 		=> $pantSizeFemaleResult
													]);
    	}
		
		
		public function getDesignationsAsPerDepartment(){
            $departmentID = $this->input->post('id',TRUE);
            $data = $this->DesignationModel->getDesignationsAsPerDepartment($departmentID); //->result();
            echo json_encode($data);
        }
		
		public function searchMeasurements()
    	{
			$departmentResult			= $this->CommonModel->getData('tbldepartment','','','','');
			$designationResult			= $this->CommonModel->getData('tbldesignation','','','','');
			$employeeTypeResult			= $this->CommonModel->getData('tblemployeetype','','','','');
			
            $this->load->view(BACKOFFICE.'employee/searchMeasurements', ['departmentResult' => $departmentResult, 'designationResult' => $designationResult, 'employeeTypeResult' => $employeeTypeResult]);
    	}
	}
    
?>