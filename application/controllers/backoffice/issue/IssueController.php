<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class IssueController extends CI_Controller 
    {
		public static $table 				= "ijps_tblissue";
		public static $pkey 				= "issueID";
		public static $messageCommonText 	= "Issue";
		
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
            $this->load->view(BACKOFFICE.'issue/addIssue');
    	}
    	
    	public function insertIssue()
        {  
            if(
                $this->input->post('txtIssueName')!=""
            )
            {
				$prop = array( 
								'issueName'			=>  $this->input->post('txtIssueName', true),
								'createdByUserID'   		=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					  // Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Issue Name : ".$this->input->post('txtIssueName', true).")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
                    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
            }
        }
                    
		public function getIssue($prop)
		{	
			$issueResult			= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');

			if(!empty($issueResult))
			{
				$this->load->view(BACKOFFICE.'issue/addIssue',['issueResult' => $issueResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
			}
		}
        
        public function updateIssue()
        {
            if(
                $this->input->post('txtIssueName')!="" &&
				$this->input->post('txtIssueID')!=""
            )
            {	
				$prop = array( 
								'issueName'		=>  $this->input->post('txtIssueName', true),
								'updatedByUserID'   	=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $issueID = filter_var($this->input->post('txtIssueID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $issueID, self::$pkey);

               if($bool == 1)
              {
				  // Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtIssueID'), FILTER_SANITIZE_NUMBER_INT)." - Issue Name : ".$this->input->post('txtIssueName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
            }
           
        }
        
		public function setVisibilityIssue($issueID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $issueID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$issueID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
            }
        }
        
        public function deleteIssue($issueID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $issueID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$issueID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_ISSUES, 'refresh');
            }
        }  
    }
    
?>