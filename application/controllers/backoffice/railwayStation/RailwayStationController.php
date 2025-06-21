<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class RailwayStationController extends CI_Controller 
    {
		public static $table 				= "pp_tblrailwaystation";
		public static $pkey 				= "railwayStationID";
		public static $messageCommonText 	= "Railway Station";
		
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
            $this->load->view(BACKOFFICE.'railwayStation/addRailwayStation');
    	}
    	
    	public function insertRailwayStation()
        {  
            if(
                $this->input->post('txtRailwayStationName')!="" &&
				$this->input->post('txtRailwayStationCode')!=""
            )
            {
				$prop = array( 
								'railwayStationCode'			=>  $this->input->post('txtRailwayStationCode', true),
								'railwayStationName'			=>  $this->input->post('txtRailwayStationName', true),
								'createdByUserID'   		=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					  // Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Railway Station Name : ".$this->input->post('txtRailwayStationName', true).")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
                    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
            }
        }
                    
		public function getRailwayStation($prop)
		{	
			$railwayStationResult			= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');

			if(!empty($railwayStationResult))
			{
				$this->load->view(BACKOFFICE.'railwayStation/addRailwayStation',['railwayStationResult' => $railwayStationResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
			}
		}
        
        public function updateRailwayStation()
        {
            if(
                $this->input->post('txtRailwayStationName')!="" &&
				$this->input->post('txtRailwayStationCode')!="" &&
				$this->input->post('txtRailwayStationID')!=""
            )
            {	
				$prop = array( 
								'railwayStationCode'			=>  $this->input->post('txtRailwayStationCode', true),
								'railwayStationName'		=>  $this->input->post('txtRailwayStationName', true),
								'updatedByUserID'   	=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $railwayStationID = filter_var($this->input->post('txtRailwayStationID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $railwayStationID, self::$pkey);

               if($bool == 1)
              {
				  // Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtRailwayStationID'), FILTER_SANITIZE_NUMBER_INT)." - Railway Station Name : ".$this->input->post('txtRailwayStationName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
            }
           
        }
        
		public function setVisibilityRailwayStation($railwayStationID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $railwayStationID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$railwayStationID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
            }
        }
        
        public function deleteRailwayStation($railwayStationID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $railwayStationID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$railwayStationID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_RAILWAY_STATIONS, 'refresh');
            }
        }  
    }
    
?>