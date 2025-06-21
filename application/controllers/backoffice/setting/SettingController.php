<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class SettingController extends CI_Controller 
    {
		public static $table 				= "tblsetting";
		public static $pkey 				= "settingID";
		public static $messageCommonText 	= "Settings";
		
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
			$settingResult		= $this->CommonModel->getData('tblsetting','','','','');
            $this->load->view(BACKOFFICE.'setting/addSetting', ['settingResult' => $settingResult]);
    	}
    	
		public function getSetting()
		{	
			$settingResult				= $this->CommonModel->getData(self::$table,array(self::$pkey=>'1'),'','','');

			if(!empty($settingResult))
			{
				$this->load->view(BACKOFFICE.'setting/addSetting',['settingResult' => $settingResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SETTING, 'refresh');
			}
		}
        
        public function updateSetting()
        {
            if(
				$this->input->post('txtMailID')!="" &&
				$this->input->post('txtPhoneNumber')!="" &&
				$this->input->post('txtFacebookLink')!="" &&
				$this->input->post('txtTwitterLink')!="" &&
				$this->input->post('txtInstagramLink')!="" &&
				$this->input->post('txtLinkedinLink')!="" &&
				$this->input->post('txtAddress')!=""
            )
            {
				if($_FILES['txtlightLogo']['name']=="")
				{
					$txtlightLogo = $this->input->post('txtlightLogo');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtlightLogo']['name'], '.'), 1);
					$txtlightLogo = "adminLogo-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtdarkLogo']['name']=="")
				{
					$darkLogo = $this->input->post('txtdarkLogo');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtdarkLogo']['name'], '.'), 1);
					$darkLogo = "websiteLogo-".date('YmdHis').".".$ext;
				}
				
				if($_FILES['txtFavicon']['name']=="")
				{
					$favicon = $this->input->post('txtFavicon');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtFavicon']['name'], '.'), 1);
					$favicon = "favicon-".date('YmdHis').".".$ext;
				}
				
				$prop = array( 
				                'favicon' 	        =>  $favicon,
								'lightLogo' 		=>  $txtlightLogo,
								'darkLogo' 		    =>  $darkLogo,
								'mailID'	        =>  $this->input->post('txtMailID'),
								'phoneNumber'		=>  $this->input->post('txtPhoneNumber'),
								'officeAddress1' 	=>  $this->input->post('txtAddress'),
								'facebookLink' 		=>  $this->input->post('txtFacebookLink'),
								'twitterLink'       =>  $this->input->post('txtTwitterLink'),
								'instagramLink' 	=>  $this->input->post('txtInstagramLink'),
								'linkedInLink' 		=>  $this->input->post('txtLinkedinLink'),
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

                $bool = $this->CommonModel->updateRecord(self::$table, $prop, '1', self::$pkey);

				if($bool == 1)
				{
					if($_FILES["txtlightLogo"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_LOGOS.$txtlightLogo;

						if(move_uploaded_file($_FILES['txtlightLogo']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SETTING, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtdarkLogo"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_LOGOS.$darkLogo;

						if(move_uploaded_file($_FILES['txtdarkLogo']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SETTING, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtFavicon"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_LOGOS.$favicon;

						if(move_uploaded_file($_FILES['txtFavicon']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SETTING, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}

					
					
                   $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
					redirect(BACKOFFICE.SETTING, 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					redirect(BACKOFFICE.SETTING, 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE.SETTING, 'refresh');
            }
           
        }
    }
    
?>