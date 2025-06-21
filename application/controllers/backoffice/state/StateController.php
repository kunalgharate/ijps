<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class StateController extends CI_Controller 
    {
		public static $table 				= "pp_tblstate";
		public static $pkey 				= "stateID";
		public static $messageCommonText 	= "State";
		
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
			$countryResult			= $this->CommonModel->getData('pp_tblcountry','','','','');
            $this->load->view(BACKOFFICE.'state/addState', ['countryResult' => $countryResult]);
    	}
    	
    	public function insertState()
        {  
            if(
                $this->input->post('cmbCountryID')!="" &&
                $this->input->post('txtStateName')!=""
            )
            {
				$prop = array( 
								'countryID'		=>  filter_var($this->input->post('cmbCountryID'), FILTER_SANITIZE_NUMBER_INT),
								'stateName'   =>  $this->input->post('txtStateName', true),
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					  // Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - State Name : ".$this->input->post('txtStateName', true).")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
                    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
            }
        }
                    
		public function getState($prop)
		{	
			$stateResult	= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');
			$countryResult	= $this->CommonModel->getData('pp_tblcountry','','','','','','','','');

			if(!empty($stateResult))
			{
				$this->load->view(BACKOFFICE.'state/addState',['countryResult' => $countryResult, 'stateResult' => $stateResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
			}
		}
        
        public function updateState()
        {
            if(
                $this->input->post('txtStateID')!="" &&
                $this->input->post('cmbCountryID')!="" &&
				$this->input->post('txtStateName')!=""
            )
            {
               
				$prop = array( 
								'countryID'			=>  filter_var($this->input->post('cmbCountryID'), FILTER_SANITIZE_NUMBER_INT),
								'stateName'   		=>  $this->input->post('txtStateName', true),
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $stateID = filter_var($this->input->post('txtStateID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $stateID, self::$pkey);

               if($bool == 1)
              {
				  // Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtStateID'), FILTER_SANITIZE_NUMBER_INT)." - State Name : ".$this->input->post('txtStateName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
                  $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
            }
           
        }
        
		public function setVisibilityState($stateID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $stateID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$stateID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
            }
        }
        
        public function deleteState($stateID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $stateID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$stateID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_STATES, 'refresh');
            }
        }  
    }
    
?>