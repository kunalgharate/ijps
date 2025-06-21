<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class FlightClassController extends CI_Controller 
    {
		public static $table 				= "pp_tblflightclass";
		public static $pkey 				= "flightClassID";
		public static $messageCommonText 	= "Flight Class";
		
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
            $this->load->view(BACKOFFICE.'flightClass/addFlightClass');
    	}
    	
    	public function insertFlightClass()
        {  
            if(
                $this->input->post('txtFlightClassName')!=""
            )
            {
				$prop = array( 
								'flightClassName'			=>  $this->input->post('txtFlightClassName', true),
								'createdByUserID'   		=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					  // Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Flight Class Name : ".$this->input->post('txtFlightClassName', true).")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
                    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
            }
        }
                    
		public function getFlightClass($prop)
		{	
			$flightClassResult			= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');

			if(!empty($flightClassResult))
			{
				$this->load->view(BACKOFFICE.'flightClass/addFlightClass',['flightClassResult' => $flightClassResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
			}
		}
        
        public function updateFlightClass()
        {
            if(
                $this->input->post('txtFlightClassName')!="" &&
				$this->input->post('txtFlightClassID')!=""
            )
            {	
				$prop = array( 
								'flightClassName'		=>  $this->input->post('txtFlightClassName', true),
								'updatedByUserID'   	=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $flightClassID = filter_var($this->input->post('txtFlightClassID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $flightClassID, self::$pkey);

               if($bool == 1)
              {
				  // Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtFlightClassID'), FILTER_SANITIZE_NUMBER_INT)." - Flight Class Name : ".$this->input->post('txtFlightClassName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
            }
           
        }
        
		public function setVisibilityFlightClass($flightClassID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $flightClassID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$flightClassID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
            }
        }
        
        public function deleteFlightClass($flightClassID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $flightClassID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$flightClassID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_FLIGHTCLASSES, 'refresh');
            }
        }  
    }
    
?>