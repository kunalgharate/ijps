<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class AirportController extends CI_Controller 
    {
		public static $table 				= "pp_tblairport";
		public static $pkey 				= "airportID";
		public static $messageCommonText 	= "Airport";
		
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
            $this->load->view(BACKOFFICE.'airport/addAirport');
    	}
    	
    	public function insertAirport()
        {  
            if(
                $this->input->post('txtAirportName')!="" &&
				$this->input->post('txtAirportType')!="" &&
				$this->input->post('txtAirportid1')!="" &&
				$this->input->post('txtAirportident')!=""
            )
            {
				$prop = array( 
								'airportid1'				=>  $this->input->post('txtAirportid1', true),
								'airportident'			=>  $this->input->post('txtAirportident', true),
								'airportType'			=>  $this->input->post('txtAirportType', true),
								'airportName'			=>  $this->input->post('txtAirportName', true),
								'createdByUserID'   	=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					  // Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Airport Name : ".$this->input->post('txtAirportName', true).")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
                    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
            }
        }
                    
		public function getAirport($prop)
		{	
			$airportResult			= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');

			if(!empty($airportResult))
			{
				$this->load->view(BACKOFFICE.'airport/addAirport',['airportResult' => $airportResult]);
			}
			else
			{	
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
			}
		}
        
        public function updateAirport()
        {
            if(
                $this->input->post('txtAirportName')!="" &&
				$this->input->post('txtAirportType')!="" &&
				$this->input->post('txtAirportid1')!="" &&
				$this->input->post('txtAirportident')!="" &&
				$this->input->post('txtAirportID')!=""
            )
            {	
				$prop = array( 
								'airportid1'				=>  $this->input->post('txtAirportid1', true),
								'airportident'			=>  $this->input->post('txtAirportident', true),
								'airportType'			=>  $this->input->post('txtAirportType', true),
								'airportName'			=>  $this->input->post('txtAirportName', true),
								'updatedByUserID'   	=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $airportID = filter_var($this->input->post('txtAirportID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $airportID, self::$pkey);

               if($bool == 1)
              {
				  // Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtAirportID'), FILTER_SANITIZE_NUMBER_INT)." - Airport Name : ".$this->input->post('txtAirportName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
            }
           
        }
        
		public function setVisibilityAirport($airportID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $airportID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$airportID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
            }
        }
        
        public function deleteAirport($airportID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $airportID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$airportID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_AIRPORTS, 'refresh');
            }
        }  
    }
    
?>