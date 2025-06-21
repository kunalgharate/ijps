<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class CompanyController extends CI_Controller 
    {
		public static $table 				= "pp_tblcompany";
		public static $pkey 				= "companyID";
		public static $messageCommonText 	= "Company";
		
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
            $this->load->view(BACKOFFICE.'company/addCompany');
    	}
    	
		
		public function insertCompany()
        {  
            if(
				$this->input->post('txtCompanyName')!="" &&
				$this->input->post('txtRegisteredOfficeAddress')!="" &&
				$this->input->post('txtOfficeAddress')!="" &&
				$this->input->post('txtGSTIN')!="" &&
				$this->input->post('txtPAN')!="" &&
				$this->input->post('txtTIN')!="" &&
				$this->input->post('txtContactNumber')!="" &&
				$this->input->post('txtAlternateContactNumber')!="" &&
				$this->input->post('txtEmail')!="" &&
				$this->input->post('txtContactPersonName')!="" &&
				$this->input->post('txtContactPersonEmail')!="" &&
				$this->input->post('txtContactPersonContactNumber')!="" &&
				$this->input->post('txtContactPersonAlternateContactNumber')!=""
			)
            {
				$prop = array( 
								'companyName'							=>  $this->input->post('txtCompanyName', true),
								'registeredOfficeAddress' 				=>  $this->input->post('txtRegisteredOfficeAddress', true),
								'officeAddress' 						=>  $this->input->post('txtOfficeAddress', true),
								'GSTIN'    								=>  $this->input->post('txtGSTIN', true),
								'PAN'									=>  $this->input->post('txtPAN', true),
								'TIN'       							=>  $this->input->post('txtTIN', true),
								'contactNumber'							=>  $this->input->post('txtContactNumber', true),
								'alternateContactNumber' 				=>  $this->input->post('txtAlternateContactNumber', true),
								'email' 								=>  $this->input->post('txtEmail', true),
								'contactPersonName'    					=>  $this->input->post('txtContactPersonName', true),
								'contactPersonEmail'					=>  $this->input->post('txtContactPersonEmail', true),
								'contactPersonContactNumber'       		=>  $this->input->post('txtContactPersonContactNumber', true),
								'contactPersonAlternateContactNumber'   =>  $this->input->post('txtContactPersonAlternateContactNumber', true),
								'createdByUserID'   					=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Company Name : ".$this->input->post('txtCompanyName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
            }
        }
         
		public function getCompany($prop)
		{	
			$companyResult					= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');

			if(!empty($companyResult))
			{
				$this->load->view(BACKOFFICE.'company/addCompany',['companyResult' => $companyResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
			}
		}
        
        public function updateCompany()
        {
            if(
                $this->input->post('txtCompanyName')!="" &&
				$this->input->post('txtRegisteredOfficeAddress')!="" &&
				$this->input->post('txtOfficeAddress')!="" &&
				$this->input->post('txtGSTIN')!="" &&
				$this->input->post('txtPAN')!="" &&
				$this->input->post('txtTIN')!="" &&
				$this->input->post('txtContactNumber')!="" &&
				$this->input->post('txtAlternateContactNumber')!="" &&
				$this->input->post('txtEmail')!="" &&
				$this->input->post('txtContactPersonName')!="" &&
				$this->input->post('txtContactPersonEmail')!="" &&
				$this->input->post('txtContactPersonContactNumber')!="" &&
				$this->input->post('txtContactPersonAlternateContactNumber')!="" &&
				$this->input->post('txtCompanyID')!=""
            )
            {
				$prop = array( 
								'companyName'							=>  $this->input->post('txtCompanyName', true),
								'registeredOfficeAddress' 				=>  $this->input->post('txtRegisteredOfficeAddress', true),
								'officeAddress' 						=>  $this->input->post('txtOfficeAddress', true),
								'GSTIN'    								=>  $this->input->post('txtGSTIN', true),
								'PAN'									=>  $this->input->post('txtPAN', true),
								'TIN'       							=>  $this->input->post('txtTIN', true),
								'contactNumber'							=>  $this->input->post('txtContactNumber', true),
								'alternateContactNumber' 				=>  $this->input->post('txtAlternateContactNumber', true),
								'email' 								=>  $this->input->post('txtEmail', true),
								'contactPersonName'    					=>  $this->input->post('txtContactPersonName', true),
								'contactPersonEmail'					=>  $this->input->post('txtContactPersonEmail', true),
								'contactPersonContactNumber'       		=>  $this->input->post('txtContactPersonContactNumber', true),
								'contactPersonAlternateContactNumber'   =>  $this->input->post('txtContactPersonAlternateContactNumber', true),
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $companyID = filter_var($this->input->post('txtCompanyID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $companyID, self::$pkey);

               if($bool == 1)
              {
				  // Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtCompanyID'), FILTER_SANITIZE_NUMBER_INT)." - Company Name : ".$this->input->post('txtCompanyName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
                   $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
            }
           
        }
        
		public function setVisibilityCompany($companyID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $companyID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$companyID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
            }
        }
        
        public function deleteCompany($companyID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $companyID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$companyID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_COMPANIES, 'refresh');
            }
        }  
    }
    
?>