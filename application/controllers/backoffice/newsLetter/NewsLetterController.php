<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class NewsLetterController extends CI_Controller 
    {
		public static $table 				= "ijps_tblnewsletter";
		public static $pkey 				= "newsletterID";
		public static $messageCommonText 	= "Newsletter";
		
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
            $this->load->view(BACKOFFICE.'newsletter/addNewsletter');
    	}
    	
		public function insertNewsletter()
        {
            if(
				$this->input->post('txtTitle')!="" &&
				$this->input->post('txtNewsletterURL')!="" &&
				$this->input->post('txtDescription')!=""
				/*$_FILES['txtThumbnailImage']['name']!=""*/
			)
            {				
				if($_FILES['txtThumbnailImage']['name']=="")
				{
					$thumbnailImage = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtThumbnailImage']['name'], '.'), 1);
					$thumbnailImage = "thumbnailImage-".date('YmdHis').".".$ext;
				}
				
				$prop = array( 
								'title'				=>  $this->input->post('txtTitle', true),
								'link' 				=>  $this->input->post('txtNewsletterURL', true),
								'description' 		=>  $this->input->post('txtDescription', true),
								'thumbnailImage' 	=>  $thumbnailImage,
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
				
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					if($_FILES["txtThumbnailImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_NEWSLETTER.$thumbnailImage;

						if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));die;
							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
							// redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}else{
						echo json_encode(array('status'=>'error','msg'=>'Select an Thumbnail Image...'));die;
					}
					
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Newsletter Title : ".$this->input->post('txtNewsletterURL', true).")",
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

			if(!empty($newsletterResult))
			{
				$this->load->view(BACKOFFICE.'newsletter/addNewsletter',['newsletterResult' => $newsletterResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
			}
		}
        
        public function updateNewsletter()
        {
            if(
				$this->input->post('txtTitle')!="" &&
				$this->input->post('txtNewsletterURL')!="" &&
				$this->input->post('txtDescription')!="" &&
				$this->input->post('txtNewsletterID')!=""
            )
            {
				if($_FILES['txtThumbnailImage']['name']=="")
				{
					$thumbnailImage = $this->input->post('txtThumbnailImage');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtThumbnailImage']['name'], '.'), 1);
					$thumbnailImage = "thumbnailImage-".date('YmdHis').".".$ext;
				}
				
				$prop = array( 
								'title'				=>  $this->input->post('txtTitle', true),
								'link' 				=>  $this->input->post('txtNewsletterURL', true),
								'description' 		=>  $this->input->post('txtDescription', true),
								'thumbnailImage' 	=>  $thumbnailImage,
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $newsletterID = filter_var($this->input->post('txtNewsletterID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $newsletterID, self::$pkey);

				if($bool == 1)
				{
					if($_FILES["txtThumbnailImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_NEWSLETTER.$thumbnailImage;

						if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
							// redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}

					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtNewsletterID'), FILTER_SANITIZE_NUMBER_INT)." - Newsletter Title : ".$this->input->post('txtTitle', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' updated successfully...'));
                //    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
				// 	redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
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
				redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_NEWSLETTERS, 'refresh');
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