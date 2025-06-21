<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class CityController extends CI_Controller 
    {
		public static $table 				= "pp_tblcity";
		public static $pkey 				= "cityID";
		public static $messageCommonText 	= "City";
		
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
			$stateResult			= $this->CommonModel->getData('pp_tblstate','','','','');
            $this->load->view(BACKOFFICE.'city/addCity', ['stateResult' => $stateResult]);
    	}
    	
    	public function insertCity()
        {  
            if(
                $this->input->post('cmbStateID')!="" &&
                $this->input->post('txtCityName')!=""
            )
            {
				$prop = array( 
								'stateID'		=>  filter_var($this->input->post('cmbStateID'), FILTER_SANITIZE_NUMBER_INT),
								'cityName'   =>  $this->input->post('txtCityName', true),
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					  // Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - City Name : ".$this->input->post('txtCityName', true).")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
                    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
            }
        }
                    
		public function getCity($prop)
		{	
			$cityResult	= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');
			$stateResult	= $this->CommonModel->getData('pp_tblstate','','','','','','','','');

			if(!empty($stateResult))
			{
				$this->load->view(BACKOFFICE.'city/addCity',['stateResult' => $stateResult, 'cityResult' => $cityResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
			}
		}
        
        public function updateCity()
        {
            if(
                $this->input->post('txtCityID')!="" &&
                $this->input->post('cmbStateID')!="" &&
				$this->input->post('txtCityName')!=""
            )
            {
               
				$prop = array( 
								'stateID'			=>  filter_var($this->input->post('cmbStateID'), FILTER_SANITIZE_NUMBER_INT),
								'cityName'   		=>  $this->input->post('txtCityName', true),
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $cityID = filter_var($this->input->post('txtCityID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $cityID, self::$pkey);

               if($bool == 1)
              {
				  // Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtCityID'), FILTER_SANITIZE_NUMBER_INT)." - City Name : ".$this->input->post('txtCityName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
                  $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
            }
           
        }
        
		public function setVisibilityCity($cityID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $cityID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$cityID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
            }
        }
        
        public function deleteCity($cityID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $$cityID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$$cityID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_CITIES, 'refresh');
            }
        }  
    }
    
?>