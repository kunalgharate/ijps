<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class HappyStoriesController extends CI_Controller 
    {
		public static $table 				= "tblhappystory";
		public static $pkey 				= "happyStoryID";
		public static $messageCommonText 	= "Happy Story";
		
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
            $this->load->view(BACKOFFICE.'happyStory/addHappyStory');
    	}
    	
		
		public function insertHappyStory()
        {  
            if(
				$this->input->post('txtStoryHeading')!="" &&
				$this->input->post('txtStoryDescription')!="" &&
				$this->input->post('txtStoryShortDescription')!="" &&
				$_FILES['txtThumbnailImage']['name']!=""
			)
            {
				$video = "";
				
				if($this->input->post('rbtnVideoTypeFlag') == '1')
				{
					if($_FILES['txtVideoURLUpload']['name']=="")
					{
						$video = "";
					}
					else
					{
						$ext = substr( strrchr($_FILES['txtVideoURLUpload']['name'], '.'), 1);
						$video = "happyStoryVideo-".date('YmdHis').".".$ext;
					}
				}
				else
				{
					$video = $this->input->post('txtVideoURL');
				}
				
				if($_FILES['txtThumbnailImage']['name']=="")
				{
					$thumbnailImage = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtThumbnailImage']['name'], '.'), 1);
					$thumbnailImage = "happyStoryThumbnailImage-".date('YmdHis').".".$ext;
				}
				
				$prop = array( 
								'happyStoryHeading'				=>  $this->input->post('txtStoryHeading', true),
								'happyStoryShortDescription' 	=>  $this->input->post('txtStoryShortDescription', true),
								'happyStoryDescription' 		=>  $this->input->post('txtStoryDescription', true),
								'thumbnailImage'    			=>  $thumbnailImage,
								'videoTypeFlag'					=>  filter_var($this->input->post('rbtnVideoTypeFlag'), FILTER_SANITIZE_NUMBER_INT),
								'videoURL'       				=>  $video,
								'createdByUserID'   			=>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
						if($this->input->post('rbtnVideoTypeFlag') == '1')
						{
							if($_FILES["txtVideoURLUpload"]["name"] != "")
							{
								/******************************** Video Upload *********************************/
								$target_file    = UPLOAD_HAPPY_STORY.$video;

								if(move_uploaded_file($_FILES['txtVideoURLUpload']['tmp_name'], $target_file))
								{
								}
								else 
								{
									$this->session->set_userdata('toastrError', 'Problem uploading video...');
									redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
								}

								/********** Video Upload *********************************/
							}
						}
						
                        if($_FILES["txtThumbnailImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_HAPPY_STORY.$thumbnailImage;

						if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Happy Story Heading : ".$this->input->post('txtPostHeading', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
            }
        }
         
		public function getHappyStory($prop)
		{	
			$happyStoryResult					= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');

			if(!empty($happyStoryResult))
			{
				$this->load->view(BACKOFFICE.'happyStory/addHappyStory',['happyStoryResult' => $happyStoryResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
			}
		}
        
        public function updateHappyStory()
        {
            if(
                $this->input->post('txtStoryHeading')!="" &&
				$this->input->post('txtStoryShortDescription')!="" &&
                $this->input->post('txtStoryDescription')!="" &&
				$this->input->post('txtHappyStoryID')!=""
            )
            {
                if($_FILES['txtThumbnailImage']['name']=="")
				{
					$thumbnailImage = $this->input->post('txtThumbnailImage');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtThumbnailImage']['name'], '.'), 1);
					$thumbnailImage = "happyStoryThumbnailImage-".date('YmdHis').".".$ext;
				}
				
				$video = "";
				
				if($this->input->post('rbtnVideoTypeFlag') == '1')
				{
					if($_FILES['txtVideoURLUpload']['name']=="")
					{
						$video = "";
					}
					else
					{
						$ext = substr( strrchr($_FILES['txtVideoURLUpload']['name'], '.'), 1);
						$video = "happyStoryVideo-".date('YmdHis').".".$ext;
					}
				}
				else
				{
					$video = $this->input->post('txtVideoURL');
				}
				
				
				$prop = array( 
								'happyStoryHeading'		=>  $this->input->post('txtStoryHeading', true),
								'happyStoryShortDescription' 	=>  $this->input->post('txtStoryShortDescription', true),
								'happyStoryDescription' =>  $this->input->post('txtStoryDescription', true),
								'thumbnailImage'    	=>  $thumbnailImage,
								'videoTypeFlag'			=>  filter_var($this->input->post('rbtnVideoTypeFlag'), FILTER_SANITIZE_NUMBER_INT),
								'videoURL'       		=>  $video,
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $happyStoryID = filter_var($this->input->post('txtHappyStoryID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $happyStoryID, self::$pkey);

               if($bool == 1)
              {
				  if($this->input->post('rbtnVideoTypeFlag') == '1')
					{
						if($_FILES["txtVideoURLUpload"]["name"] != "")
						{
							/******************************** Video Upload *********************************/
							$target_file    = UPLOAD_HAPPY_STORY.$video;

							if(move_uploaded_file($_FILES['txtVideoURLUpload']['tmp_name'], $target_file))
							{
							}
							else 
							{
								$this->session->set_userdata('toastrError', 'Problem uploading video...');
								redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
							}

							/********** Video Upload *********************************/
						}
					}
							
						
                  if($_FILES["txtThumbnailImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_HAPPY_STORY.$thumbnailImage;

						if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
						{
						}
						else 
						{
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtPostID'), FILTER_SANITIZE_NUMBER_INT)." - Post Heading : ".$this->input->post('txtPostHeading', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
                   $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
            }
           
        }
        
		public function setVisibilityHappyStory($happyStoryID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $happyStoryID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$happyStoryID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
            }
        }
        
        public function deleteHappyStory($happyStoryID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $happyStoryID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$happyStoryID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_HAPPY_STORIES, 'refresh');
            }
        }  
    }
    
?>