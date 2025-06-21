<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class EmployeeController extends CI_Controller 
    {
		public static $table 				= "pp_tblemployee";
		public static $pkey 				= "employeeID";
		public static $messageCommonText 	= "Employee";
		
        public function __construct() 
        {
            parent::__construct();
            
            if($this->session->userdata('userFullName') == ""|| $this->session->userdata('mailID') == "")
            {
                redirect(BACKOFFICE.'LoginController', 'refresh');
            } 
        }
        
    	public function index()
    	{
			$departmentResult	= $this->CommonModel->getData('pp_tbldepartment','','','','');
			$companyResult		= $this->CommonModel->getData('pp_tblcompany','','','','');
			
            $this->load->view(BACKOFFICE.'employee/addEmployee', ['departmentResult' => $departmentResult, 'companyResult' => $companyResult]);
    	}
    	
		
		public function insertEmployee()
        {  //print_r($this->input->post());exit;
            if(
				$this->input->post('cmbCompanyID')!="" &&
				$this->input->post('cmbDepartmentID')!="" &&
				$this->input->post('txtEmployeeName')!="" &&
				$this->input->post('txtApprovalAuthority')!="" &&
				$this->input->post('txtContactNumber')!="" &&
				$this->input->post('txtAlternateContactNumber')!="" &&
				$this->input->post('txtEmail')!="" &&
				$this->input->post('txtBudget')!="" &&
				$this->input->post('txtPermanentAddress')!="" &&
				$this->input->post('txtResidentialAddress')!="" 
				/*$_FILES['txtAadharCardImage']['name']!="" &&
				$_FILES['txtPanCardImage']['name']!="" &&
				$_FILES['txtPassportImage']['name']!="" &&
				$_FILES['txtVisaImage']['name']!="" &&
				$_FILES['txtTravelInsuranceImage']['name']!=""*/
			)
            {				
				if($_FILES['txtAadharCardImage']['name']=="")
				{
					$aadharCardImage = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtAadharCardImage']['name'], '.'), 1);
					$aadharCardImage = "aadharCardImage-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtPanCardImage']['name']=="")
				{
					$panCardImage = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtPanCardImage']['name'], '.'), 1);
					$panCardImage = "panCardImage-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtPassportImage']['name']=="")
				{
					$passportImage = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtPassportImage']['name'], '.'), 1);
					$passportImage = "passportImage-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtVisaImage']['name']=="")
				{
					$visaImage = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtVisaImage']['name'], '.'), 1);
					$visaImage = "visaImage-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtTravelInsuranceImage']['name']=="")
				{
					$travelInsuranceImage = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtTravelInsuranceImage']['name'], '.'), 1);
					$travelInsuranceImage = "travelInsuranceImage-".date('YmdHis').".".$ext;
				}
				
				
				$prop = array( 
								'employeeName'				=>  $this->input->post('txtEmployeeName'),
								'companyID' 				=>  $this->input->post('cmbCompanyID', true),
								'departmentID' 				=>  $this->input->post('cmbDepartmentID', true),
								'approvalAuthority' 		=>  $this->input->post('txtApprovalAuthority', true),
								'permanentAddress'    		=>  $this->input->post('txtPermanentAddress', true),
								'residentialAddress'		=>  $this->input->post('txtResidentialAddress', true),
								'contactNumber'       		=>  $this->input->post('txtContactNumber', true),
								'alternateContactNumber' 	=>  $this->input->post('txtAlternateContactNumber', true),
								'email' 					=>  $this->input->post('txtEmail', true),
								'budget' 					=>  $this->input->post('txtBudget', true),
								'aadharCardImage' 			=>  $aadharCardImage,
								'panCardImage' 				=>  $panCardImage,
								'passportImage' 			=>  $passportImage,
								'visaImage' 				=>  $visaImage,
								'travelInsuranceImage' 		=>  $travelInsuranceImage,
								'createdByUserID'   		=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
				
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
                    
					if($_FILES["txtAadharCardImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$aadharCardImage;

						if(move_uploaded_file($_FILES['txtAadharCardImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtPanCardImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$panCardImage;

						if(move_uploaded_file($_FILES['txtPanCardImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtPassportImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$passportImage;

						if(move_uploaded_file($_FILES['txtPassportImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtVisaImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$visaImage;

						if(move_uploaded_file($_FILES['txtVisaImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtTravelInsuranceImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$travelInsuranceImage;

						if(move_uploaded_file($_FILES['txtTravelInsuranceImage']['tmp_name'], $target_file))
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
							'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Employee Name : ".$this->input->post('txtEmployeeName', true).")",
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
			$departmentResult			= $this->CommonModel->getData('pp_tbldepartment','','','','');
			$companyResult				= $this->CommonModel->getData('pp_tblcompany','','','','');
			$employeeResult				= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');

			if(!empty($employeeResult))
			{
				$this->load->view(BACKOFFICE.'employee/addEmployee',['employeeResult' => $employeeResult, 'departmentResult' => $departmentResult, 'companyResult' => $companyResult]);
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
				$this->input->post('cmbCompanyID')!="" &&
                $this->input->post('cmbDepartmentID')!="" &&
				$this->input->post('txtEmployeeName')!="" &&
				$this->input->post('txtApprovalAuthority')!="" &&
				$this->input->post('txtContactNumber')!="" &&
				$this->input->post('txtAlternateContactNumber')!="" &&
				$this->input->post('txtEmail')!="" &&
				$this->input->post('txtBudget')!="" &&
				$this->input->post('txtPermanentAddress')!="" &&
				$this->input->post('txtResidentialAddress')!="" &&
				$this->input->post('txtEmployeeID')!=""
            )
            {
				if($_FILES['txtAadharCardImage']['name']=="")
				{
					$aadharCardImage = $this->input->post('txtAadharCardImage');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtAadharCardImage']['name'], '.'), 1);
					$aadharCardImage = "aadharCardImage-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtPanCardImage']['name']=="")
				{
					$panCardImage = $this->input->post('txtPanCardImage');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtPanCardImage']['name'], '.'), 1);
					$panCardImage = "panCardImage-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtPassportImage']['name']=="")
				{
					$passportImage = $this->input->post('txtPassportImage');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtPassportImage']['name'], '.'), 1);
					$passportImage = "passportImage-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtVisaImage']['name']=="")
				{
					$visaImage = $this->input->post('txtVisaImage');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtVisaImage']['name'], '.'), 1);
					$visaImage = "visaImage-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtTravelInsuranceImage']['name']=="")
				{
					$travelInsuranceImage = $this->input->post('txtTravelInsuranceImage');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtTravelInsuranceImage']['name'], '.'), 1);
					$travelInsuranceImage = "travelInsuranceImage-".date('YmdHis').".".$ext;
				}
				
				
				$prop = array( 
								'employeeName'				=>  $this->input->post('txtEmployeeName'),
								'companyID' 				=>  $this->input->post('cmbCompanyID', true),
								'departmentID' 				=>  $this->input->post('cmbDepartmentID', true),
								'approvalAuthority' 		=>  $this->input->post('txtApprovalAuthority', true),
								'permanentAddress'    		=>  $this->input->post('txtPermanentAddress', true),
								'residentialAddress'		=>  $this->input->post('txtResidentialAddress', true),
								'contactNumber'       		=>  $this->input->post('txtContactNumber', true),
								'alternateContactNumber' 	=>  $this->input->post('txtAlternateContactNumber', true),
								'email' 					=>  $this->input->post('txtEmail', true),
								'budget' 					=>  $this->input->post('txtBudget', true),
								'aadharCardImage' 			=>  $aadharCardImage,
								'panCardImage' 				=>  $panCardImage,
								'passportImage' 			=>  $passportImage,
								'visaImage' 				=>  $visaImage,
								'travelInsuranceImage' 		=>  $travelInsuranceImage,
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $employeeID = filter_var($this->input->post('txtEmployeeID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $employeeID, self::$pkey);

               if($bool == 1)
              {
				  if($_FILES["txtAadharCardImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$aadharCardImage;

						if(move_uploaded_file($_FILES['txtAadharCardImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtPanCardImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$panCardImage;

						if(move_uploaded_file($_FILES['txtPanCardImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtPassportImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$passportImage;

						if(move_uploaded_file($_FILES['txtPassportImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtVisaImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$visaImage;

						if(move_uploaded_file($_FILES['txtVisaImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_EMPLOYEES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtTravelInsuranceImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_EMPLOYEE.$travelInsuranceImage;

						if(move_uploaded_file($_FILES['txtTravelInsuranceImage']['tmp_name'], $target_file))
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
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtEmployeeID'), FILTER_SANITIZE_NUMBER_INT)." - Employee Name : ".$this->input->post('txtEmployeeName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
                   $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
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
    }
    
?>