<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class CabTypeController extends CI_Controller 
    {
		public static $table 				= "pp_tblcabtype";
		public static $pkey 				= "cabTypeID";
		public static $messageCommonText 	= "Cab Type";
		
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
            $this->load->view(BACKOFFICE.'cabType/addCabType');
    	}
    	
    	public function insertCabType()
        {  
            if(
                $this->input->post('txtCabTypeName')!=""
            )
            {
				$prop = array( 
								'cabTypeName'			=>  $this->input->post('txtCabTypeName', true),
								'createdByUserID'   		=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					  // Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Country Name : ".$this->input->post('txtCountryName', true).")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
                    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
            }
        }
                    
		public function getCabType($prop)
		{	
			$cabTypeResult			= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');

			if(!empty($cabTypeResult))
			{
				$this->load->view(BACKOFFICE.'cabType/addCabType',['cabTypeResult' => $cabTypeResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
			}
		}
        
        public function updateCabType()
        {
            if(
                $this->input->post('txtCabTypeName')!="" &&
				$this->input->post('txtCabTypeID')!=""
            )
            {	
				$prop = array( 
								'cabTypeName'		=>  $this->input->post('txtCabTypeName', true),
								'updatedByUserID'   	=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $cabTypeID = filter_var($this->input->post('txtCabTypeID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $cabTypeID, self::$pkey);

               if($bool == 1)
              {
				  // Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtCountryID'), FILTER_SANITIZE_NUMBER_INT)." - Country Name : ".$this->input->post('txtCabTypeName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
            }
           
        }
        
		public function setVisibilityCabType($cabTypeID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $cabTypeID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$cabTypeID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
            }
        }
        
        public function deleteCabType($cabTypeID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $cabTypeID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$cabTypeID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_CABTYPES, 'refresh');
            }
        }  
    }
    
?>