<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class BlogController extends CI_Controller 
    {
		public static $table 				= "ijps_tblblog";
		public static $pkey 				= "blogID";
		public static $messageCommonText 	= "Blog";
		
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
			$blogCategoryResult		= $this->CommonModel->getData('ijps_tblblogcategory','','','','');
            $this->load->view(BACKOFFICE.'blog/addBlog', ['blogCategoryResult' => $blogCategoryResult]);
    	}
    	
		public function insertBlog()
        {
            if(
				$this->input->post('txtTitle')!="" &&
				$this->input->post('txtShortDescription')!="" &&
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
				
				if($_FILES['txtBannerImage']['name']=="")
				{
					$bannerImage = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtBannerImage']['name'], '.'), 1);
					$bannerImage = "bannerImage-".date('YmdHis').".".$ext;
				}
				
				$prop = array( 
								'blogCategoryID'	=>  $this->input->post('cmbBlogCategoryID'),
								'title'				=>  $this->input->post('txtTitle', true),
								'shortDescription' 	=>  $this->input->post('txtShortDescription'),
								'description' 		=>  $this->input->post('txtDescription', true),
								'thumbnailImage' 	=>  $thumbnailImage,
								'bannerImage' 		=>  $bannerImage,
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
				
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					if($_FILES["txtThumbnailImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_BLOG.$thumbnailImage;

						if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							echo json_encode(array('status'=>'error','msg'=>' Problem uploading image....'));die;
							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
							// redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtBannerImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_BLOG.$bannerImage;

						if(move_uploaded_file($_FILES['txtBannerImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));die;
							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
							// redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Blog Title : ".$this->input->post('txtBlogURL', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' added successfully...'));die;
					// $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					// redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
                  }
                  else
                  {
					echo json_encode(array('status'=>'error','msg'=>'Data was not saved!'));die;
                    //    $this->session->set_userdata('toastrError', 'Data was not saved!');
					// 	redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
                  }
            }
            else
            {
				echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));die;
				// $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				// redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
            }
        }
         
		public function getBlog($prop)
		{	
			$blogResult				= $this->CommonModel->getData(self::$table,array(self::$pkey=>$prop),'','','');

			if(!empty($blogResult))
			{
				$blogCategoryResult		= $this->CommonModel->getData('ijps_tblblogcategory','','','','');
				$this->load->view(BACKOFFICE.'blog/addBlog',['blogResult' => $blogResult, 'blogCategoryResult' => $blogCategoryResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
			}
		}
        
        public function updateBlog()
        {
            if(
				$this->input->post('txtTitle')!="" &&
				$this->input->post('txtDescription')!="" &&
				$this->input->post('txtBlogID')!=""
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
				
				if($_FILES['txtBannerImage']['name']=="")
				{
					$bannerImage = $this->input->post('txtBannerImage');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtBannerImage']['name'], '.'), 1);
					$bannerImage = "bannerImage-".date('YmdHis').".".$ext;
				}
				
				$prop = array( 
								'blogCategoryID'	=>  $this->input->post('cmbBlogCategoryID'),
								'title'				=>  $this->input->post('txtTitle', true),
								'shortDescription' 	=>  $this->input->post('txtShortDescription', true),
								'description' 		=>  $this->input->post('txtDescription', true),
								'thumbnailImage' 	=>  $thumbnailImage,
								'bannerImage' 		=>  $bannerImage,
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $blogID = filter_var($this->input->post('txtBlogID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $blogID, self::$pkey);

				if($bool == 1)
				{
					if($_FILES["txtThumbnailImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_BLOG.$thumbnailImage;

						if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));die;
							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
							// redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtBannerImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_BLOG.$bannerImage;

						if(move_uploaded_file($_FILES['txtBannerImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));die;
							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
							// redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}

					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtBlogID'), FILTER_SANITIZE_NUMBER_INT)." - Blog Title : ".$this->input->post('txtTitle', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' updated successfully...'));die;
                //    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
				// 	redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
              }
              else
              {
					echo json_encode(array('status'=>'error','msg'=>self::$messageCommonText.' update error...'));die;
					// $this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					// redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
              }
        }
        else
            {
				echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));die;
                //  $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				// redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
            }
           
        }
        
		public function setVisibilityBlog($blogID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $blogID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$blogID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
            }
        }
        
        public function deleteBlog($blogID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $blogID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$blogID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_BLOGS, 'refresh');
            }
        }  
    }
    
?>