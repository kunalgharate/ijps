<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class ApiKeyController extends CI_Controller 
    {
		public static $table 				= "ijps_tblapikey";
		public static $pkey 				= "apikeyID";
		public static $messageCommonText 	= "Api Key";
		
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
			$newsletterResult = $this->CommonModel->getData(self::$table); 
			// print_r($newsletterResult); die;
            $this->load->view(BACKOFFICE.'apikey/detailsApikey',['newsletterResult' => $newsletterResult]);
    	}
    	
		public function insertNewsletter()
        {
            if(
				$this->input->post('apiPublicKey')!="" &&
				$this->input->post('apiSecretKey')!=""
			){	
				$prop = array( 
								'PublicKey'				=>  $this->input->post('apiPublicKey', true),
								'SecretKey' 				=>  $this->input->post('apiSecretKey', true),
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
				
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					// Add activity log start
					$prop = array( 
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' added successfully...'));
					// $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					// redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
                  }
                  else
                  {
					echo json_encode(array('status'=>'error','msg'=>'Data was not saved!'));
                    //    $this->session->set_userdata('toastrError', 'Data was not saved!');
					// 	redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
                  }
            }
            else
            {
				echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
				// $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				// redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
            }
        }
         
		public function getNewsletter($prop)
		{	
			$newsletterResult				= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');
			// print_r($newsletterResult); die;
			if(!empty($newsletterResult))
			{
				$this->load->view(BACKOFFICE.'apikey/addApikey',['newsletterResult' => $newsletterResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
			}
		}

		public function addApiKey() {
			$this->load->view(BACKOFFICE.'apikey/addApikey'); // Load the add API key form
		}
        
        public function updateNewsletter()
        {
            if(
				$this->input->post('apiPublicKey')!="" &&
				$this->input->post('apiSecretKey')!=""
            )
            {
				$prop = array( 
								'PublicKey'				=>  $this->input->post('apiPublicKey', true),
								'SecretKey' 				=>  $this->input->post('apiSecretKey', true),
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $newsletterID = filter_var($this->input->post('apikeyID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $newsletterID, self::$pkey);

				if($bool == 1)
				{
					$prop = array( 
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' updated successfully...'));
                //    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					
              }
              else
              {
				echo json_encode(array('status'=>'error','msg'=>'Data was not saved!'));
					// $this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					// redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
              }
        }
        else
            {
				echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
                //  $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				// redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
            }
           
        }
        
		public function setVisibilityNewsletter($newsletterID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $newsletterID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$newsletterID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_APIKEY, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_APIKEY, 'refresh');
            }
        }
        
        public function deleteNewsletter($newsletterID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $newsletterID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$newsletterID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
            }
        }  

    }
    
?>