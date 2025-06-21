<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	require_once FCPATH . 'vendor/autoload.php';

	use Ilovepdf\CompressTask;
	
    class ArticleController extends CI_Controller 
    {
		public static $table 				= "ijps_tblarticle";
		public static $pkey 				= "articleID";
		public static $messageCommonText 	= "Article";
		
        public function __construct() 
        {
            parent::__construct();
            
            $this->load->library('Ilovepdf_lib');
            
            if($this->session->userdata('userFullName') == ""|| $this->session->userdata('mailID') == "")
            {	
                redirect(BACKOFFICE.'LoginController', 'refresh');
            } 
			
			$this->load->model(BACKOFFICE.'Articlemodel', 'ArticleModel');
        }
        
    	public function index($prop)
    	{
			$articalTypeResult		= $this->CommonModel->getData('ijps_tblarticaltype','','','','');
			$designationResult		= $this->CommonModel->getData('ijps_tbldesignation','','','','');
			$volumeResult			= $this->CommonModel->getData('ijps_tblvolume','','','','');
			$issueResult			= $this->CommonModel->getData('ijps_tblissue','','','','');
			$manuscriptResult		= $this->CommonModel->getData('ijps_tblmanuscript','','','','');
			$authorResult			= $this->CommonModel->getData('ijps_tblauthor','','','','');
			
			$loadData                   = $this->CommonModel->getDataLimit('ijps_tblmanuscript', array('isActive'=>'1', 'manuscriptID'=>$prop), '', '', '', '', '' ,'manuscriptID','ASC');
			
			$articleResult = null;
			
			if(isset($loadData[0]['uniqueCode']))
			{
			    $loadData['info']           = $this->CommonModel->getDataLimit('ijps_tblmanuscriptinfo', array('isActive'=>'1', 'articleID'=> $loadData[0]['uniqueCode']), '', '', '', '', '' ,'manuscriptInfoID','ASC'); 
			}
			else
			{
			    $loadData['info']           =array();
			}
            $articleId = $this->uri->segment(4);
			$loadData['accepted_date']           = $this->ArticleModel->getAcceptedDate($articleId); 
			if(isset($loadData['info'][0]['manuscriptInfoID']))
			{
			    $loadData['coAuthorInfo']   = $this->CommonModel->getDataLimit('ijps_tblmanuscriptcoauthor', array('isActive'=>'1', 'manuscriptInfoID'=> $loadData['info'][0]['manuscriptInfoID']), '', '', '', '', '' ,'manuscriptCoAuthorID','ASC');
			}
			else
			{
			    $loadData['coAuthorInfo']   =array();
			}
		
		//	echo "<pre>";print_r($loadData['accepted_date']['created_data']);exit;
            $this->load->view(BACKOFFICE.'article/addArticle',['articalTypeResult' => $articalTypeResult, 'volumeResult' => $volumeResult, 'issueResult' => $issueResult, 'manuscriptResult' => $manuscriptResult, 'authorResult' => $authorResult, 'loadData'=> $loadData, 'designationResult'=>$designationResult, 'articleResult' => $articleResult]);
    	}
    	
    	public function removeSpecial(){
    	    
    	    $text = $this->input->post('text');
    	    $cleaned_text = preg_replace('/[^a-zA-Z0-9\s]/', '', $text);
    	    
            echo $cleaned_text;
    	}
    	public function saveThumb(){
            if (isset($_POST['imageDataUrl']) && isset($_POST['imageName'])) {
             
              $imageDataUrl = $_POST['imageDataUrl'];
              $imageName = $_POST['imageName'];
              $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageDataUrl));
              $uploadPath = "uploads/" . $imageName;
              $uploadPath    = UPLOAD_ARTICLE. $imageName;
              file_put_contents($uploadPath, $imageData);
              if (file_exists($uploadPath)) {
               echo base_url().$uploadPath;
              } 
            }
    	}
		
		// public function insertArticle()
        // { 
              
		// 		// if($_FILES['txtThumbnailImage']['name']=="")
		// 		// {
		// 		// 	$thumbnailImage = "";
		// 		// }
		// 		// else
		// 		// {
		// 		// 	$ext = substr( strrchr($_FILES['txtThumbnailImage']['name'], '.'), 1);
		// 		// 	$thumbnailImage = "thumbnailImage-".date('YmdHis').".".$ext;
		// 		// }
		// 			$thumbnailImage = basename(parse_url($this->input->post('txtThumbnailImage'), PHP_URL_PATH));
					
		// 		if($_FILES['txtDocument']['name']=="")
		// 		{
		// 			$document = "";
		// 		}
		// 		else
		// 		{
		// 			$ext = substr( strrchr($_FILES['txtDocument']['name'], '.'), 1);
		// 			$document = urlencode($this->input->post('txtPaperTitleOne')).".".$ext;
		// 			// $document = "document-".date('YmdHis').".".$ext;
		// 		}
				
		// 		if(!empty($this->input->post('dtpDateOfRec')))
        //         {
        //             $dtpDateOfRec   = strtotime(date($this->input->post('dtpDateOfRec')));
		// 		    $dtpDateOfRec   = date("Y-m-d", $dtpDateOfRec);
        //         }
        //         else
        //         {
        //             $dtpDateOfRec   = "0000-00-00";
        //         }
				
		// 		if(!empty($this->input->post('dtpDateOfRevised')))
        //         {
        //             $dtpDateOfRevised   = strtotime(date($this->input->post('dtpDateOfRevised')));
		// 		    $dtpDateOfRevised   = date("Y-m-d", $dtpDateOfRevised);
        //         }
        //         else
        //         {
        //             $dtpDateOfRevised   = "0000-00-00";
        //         }
				
		// 		if(!empty($this->input->post('dtpDateOfAccepted')))
        //         {
        //             $dtpDateOfAccepted   = strtotime(date($this->input->post('dtpDateOfAccepted')));
		// 		    $dtpDateOfAccepted   = date("Y-m-d", $dtpDateOfAccepted);
        //         }
        //         else
        //         {
        //             $dtpDateOfAccepted   = "0000-00-00";
        //         }
                
        //         if(!empty($this->input->post('dtpDateOfPublication')))
        //         {
        //             $dtpDateOfPublication   = strtotime(date($this->input->post('dtpDateOfPublication')));
		// 		    $dtpDateOfPublication   = date("Y-m-d", $dtpDateOfPublication);
        //         }
        //         else
        //         {
        //             $dtpDateOfPublication   = date("Y-m-d");
        //         }
                
        //         if($this->input->post('chkRevisedFlag'))
        //         {
        //             $chkRevisedFlag   = 1;
        //         }
        //         else
        //         {
        //             $chkRevisedFlag   = 0;   
        //         }
				
		// 		$prop = array( 
		// 						'manuscriptID'		=>  $this->input->post('cmbArticalID'),
		// 						'articleIDUniqueCode'=>  $this->input->post('txtUniqueCode'),
		// 						/*'volumeID'			=>  $this->input->post('cmbVolumeID'),
		// 						'issueID'   		=>  $this->input->post('cmbIssueID'),*/
		// 						'articalTypeID'		=>  $this->input->post('cmbArticalTypeID'),
		// 						'thumbnailImage'   	=>  $thumbnailImage,
		// 						'titleOfPaper'   	=>  $this->input->post('txtPaperTitle'),
		// 						'titleOfPaperOne'   	=>  $this->input->post('txtPaperTitleOne'),
		// 						'abstract'   		=>  $this->input->post('txtAbstract'),
		// 						'affiliation'  		=>  $this->input->post('affiliation'),
		// 						'document'   		=>  $document,
		// 						'reference'   		=>  $this->input->post('reference'),
		// 						'doi'   			=>  $this->input->post('txtDOI'),
		// 						'revisedFlag'   	=>  $chkRevisedFlag,
		// 						'receivedDate'   	=>  $dtpDateOfRec,
		// 						'revisedDate'   	=>  $dtpDateOfRevised,
		// 						'acceptedDate'   	=>  $dtpDateOfAccepted,
		// 						'keywords'   		=>  $this->input->post('txtKeywords'),
		// 						'featuredArticleFlag'   		=>  $this->input->post('rbtnFeaturedArticleFlag'),
		// 						'citation'   		=>  $this->input->post('txtCitation'),
		// 						'txtBody'   		=>  $this->input->post('introduction'),
							
		// 						'createdDate'       => $dtpDateOfPublication,
		// 						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
		// 					);
                    
			
        //           $bool = $this->CommonModel->insertRecord(self::$table, $prop);

        //           if($bool == 1)
        //           {
		// 			if($_FILES["txtThumbnailImage"]["name"] != "")
		// 			{
		// 				/******************************** Author Photo Upload *********************************/
		// 				$target_file    = UPLOAD_ARTICLE.$thumbnailImage;

		// 				if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
		// 				{
		// 				}
		// 				else 
		// 				{ 
		// 					$this->session->set_userdata('toastrError', 'Problem uploading image...');
		// 					redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
		// 				}

		// 				/**********  Photo Upload *********************************/
		// 			}
					
		// 			if($_FILES["txtDocument"]["name"] != "")
		// 			{
		// 				/******************************** Author Photo Upload *********************************/
		// 				$target_file    = UPLOAD_ARTICLE.$document;

		// 				if(move_uploaded_file($_FILES['txtDocument']['tmp_name'], $target_file))
		// 				{
		// 				}
		// 				else 
		// 				{ 
		// 					$this->session->set_userdata('toastrError', 'Problem uploading image...');
		// 					redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
		// 				}

		// 				/**********  Photo Upload *********************************/
		// 			}
					
		// 			$lastID = $this->db->insert_id();
					
		// 			if($_FILES['txtAuthor1Photo']['name'] =="")
    	// 			{
    	// 				$authorPhotoName = $this->input->post('txtAuthor1Photo');
    	// 			}
    	// 			else
    	// 			{
    	// 				$ext = substr( strrchr($_FILES['txtAuthor1Photo']['name'], '.'), 1);
    	// 				$authorPhotoName = "AuthorPhoto-".date('YmdHis').".".$ext;
    	// 			}
    				
		// 			$prop = array( 
    	// 							'articleID'         =>  $lastID,
    	// 							'name'          	=>  $this->input->post('txtAuthor1Name'),
    	// 							'email'   	        =>  $this->input->post('txtAuthor1Email'),
    	// 							'affiliation'   	=>  $this->input->post('txtAuthor1Affiliation'),
    	// 							'authorPhoto'		=>  $authorPhotoName,
    	// 							'designationID'     =>  $this->input->post('cmbDesignationID1'),
    	// 							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
		// 							'superscript_number'   		=>  $this->input->post('txtAuthor1NameSup'),
    	// 						);
    	// 			// $this->db->insert('ijps_tblarticalauthor', $prop);

        //             // // Print the last executed query
        //             // echo "Last Insert Query: " . $this->db->last_query();
    				
    	// 			// echo "<pre>";print_r(	$prop);echo "</pre>";die;
        //               $bool = $this->CommonModel->insertRecord('ijps_tblarticalauthor', $prop);
                      
        //               if($_FILES["txtAuthor1Photo"]['name'] != "")
    	// 				{
    	// 					/******************************** Author Photo Upload *********************************/
    	// 					$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
    
    	// 					if(move_uploaded_file($_FILES['txtAuthor1Photo']['tmp_name'], $target_file))
    	// 					{
    	// 					}
    	// 					else 
    	// 					{ 
		// 						echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
    	// 						// $this->session->set_userdata('toastrError', 'Problem uploading image...');
    	// 						// redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
    	// 					}
    
    	// 					/**********  Photo Upload *********************************/
    	// 				}
    					
					
		// 			$authorName         = $this->input->post('txtAuthorName');
		// 			$authorEmail        = $this->input->post('txtAuthoEmail');
		// 			$authorPhoto        = $this->input->post('txtAuthorPhoto');
		// 			$authorAffiliation  = $this->input->post('txtAuthorAffiliation');
		// 			$authorDesignation  = $this->input->post('cmbDesignationID');
		// 			$superscript=  $this->input->post('txtAuthorNameSup');

		// 			if(!empty($this->input->post('txtAuthorName')))
		// 			{
    	// 				for($i=0;$i<count($this->input->post('txtAuthorName'));$i++)
    	// 				{
    	// 				    if($_FILES['txtAuthorPhoto']['name'][$i]=="")
        //     				{
        //     				    if(isset($authorPhoto[$i]))
        //     				    {
        //     				        $authorPhotoName = $authorPhoto[$i];
        //     				    }
        //     					else
        //     					{
        //     					    $authorPhotoName = 'default.jpg';
        //     					}
        //     				}
        //     				else
        //     				{
        //     					$ext = substr( strrchr($_FILES['txtAuthorPhoto']['name'][$i], '.'), 1);
        //     					$authorPhotoName = "AuthorPhoto-".date('YmdHis').$i.".".$ext;
        //     				}
    	// 				    $prop = array( 
    	// 							'articleID'         =>  $lastID,
    	// 							'name'          	=>  $authorName[$i],
    	// 							'email'   	        =>  $authorEmail[$i],
    	// 							'affiliation'   	=>  $authorAffiliation[$i],
    	// 							'authorPhoto'		=>  $authorPhotoName,
    	// 							'designationID'     =>  $authorDesignation[$i],
    	// 							'superscript_number'   		=> 	$superscript[$i],
    	// 							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
    	// 						);
    				
        //                       $bool = $this->CommonModel->insertRecord('ijps_tblarticalauthor', $prop);
                              
        //                       if($_FILES["txtAuthorPhoto"]['name'][$i] != "")
        //     					{
        //     						/******************************** Author Photo Upload *********************************/
        //     						$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
            
        //     						if(move_uploaded_file($_FILES['txtAuthorPhoto']['tmp_name'][$i], $target_file))
        //     						{
        //     						}
        //     						else 
        //     						{ 
		// 								echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
        //     							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
        //     							// redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
        //     						}
            
        //     						/**********  Photo Upload *********************************/
        //     					}
    	// 				}
		// 			}
				
		// 			$prop = array( 
		// 					'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Artical Title : ".$this->input->post('txtArticalURL', true).")",
		// 					'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
		// 				);
		// 			$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
		// 			echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' added successfully...'));
		// 			$this->load->view(BACKOFFICE.'certificate','refresh');
		// 			// redirect(BACKOFFICE.'certificate', 'refresh');
		// 			// redirect(BACKOFFICE.SHOW_DATA_ISSUES);
        //           }
        //           else
        //           {
        //               echo json_encode(array('status'=>'error','msg'=>'Data was not saved!'));
        //           }
    
        // }
		
// 		public function insertArticle()
// {
//     // Extract the thumbnail image name
//     $thumbnailImage = basename(parse_url($this->input->post('txtThumbnailImage'), PHP_URL_PATH));

//     // Handle document upload
//     if ($_FILES['txtDocument']['name'] == "") {
//         $document = "";
//     } else {
//         $ext = substr(strrchr($_FILES['txtDocument']['name'], '.'), 1);
//         $document = urlencode($this->input->post('txtPaperTitleOne')) . "." . $ext;
//     }

//     // Process date fields
//     $dtpDateOfRec = !empty($this->input->post('dtpDateOfRec'))
//         ? date("Y-m-d", strtotime($this->input->post('dtpDateOfRec')))
//         : "0000-00-00";

//     $dtpDateOfRevised = !empty($this->input->post('dtpDateOfRevised'))
//         ? date("Y-m-d", strtotime($this->input->post('dtpDateOfRevised')))
//         : "0000-00-00";

//     $dtpDateOfAccepted = !empty($this->input->post('dtpDateOfAccepted'))
//         ? date("Y-m-d", strtotime($this->input->post('dtpDateOfAccepted')))
//         : "0000-00-00";

//     $dtpDateOfPublication = !empty($this->input->post('dtpDateOfPublication'))
//         ? date("Y-m-d", strtotime($this->input->post('dtpDateOfPublication')))
//         : date("Y-m-d");

//     $chkRevisedFlag = $this->input->post('chkRevisedFlag') ? 1 : 0;

//     // Prepare the article data
//     $prop = [
//         'manuscriptID' => $this->input->post('cmbArticalID'),
//         'articleIDUniqueCode' => $this->input->post('txtUniqueCode'),
//         'articalTypeID' => $this->input->post('cmbArticalTypeID'),
//         'thumbnailImage' => $thumbnailImage,
//         'titleOfPaper' => $this->input->post('txtPaperTitle'),
//         'titleOfPaperOne' => $this->input->post('txtPaperTitleOne'),
//         'abstract' => $this->input->post('txtAbstract'),
//         'affiliation' => $this->input->post('affiliation'),
//         'document' => $document,
//         'reference' => $this->input->post('reference'),
//         'doi' => $this->input->post('txtDOI'),
//         'revisedFlag' => $chkRevisedFlag,
//         'receivedDate' => $dtpDateOfRec,
//         'revisedDate' => $dtpDateOfRevised,
//         'acceptedDate' => $dtpDateOfAccepted,
//         'keywords' => $this->input->post('txtKeywords'),
//         'featuredArticleFlag' => $this->input->post('rbtnFeaturedArticleFlag'),
//         'citation' => $this->input->post('txtCitation'),
//         'txtBody' => $this->input->post('introduction'),
//         'createdDate' => $dtpDateOfPublication,
//         'createdByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
//     ];

//     // Insert the article data into the database
//     $bool = $this->CommonModel->insertRecord(self::$table, $prop);

//     // Get the inserted ID
//     $inserted_id = $this->db->insert_id();

//     if ($bool == 1) {
//         // Handle thumbnail image upload
//         if ($_FILES["txtThumbnailImage"]["name"] != "") {
//             $target_file = UPLOAD_ARTICLE . $thumbnailImage;
//             if (!move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file)) {
//                 $this->session->set_userdata('toastrError', 'Problem uploading image...');
//                 redirect(BACKOFFICE . SHOW_DATA_ARTICLES, 'refresh');
//             }
//         }

//         // Handle document upload
//         if ($_FILES["txtDocument"]["name"] != "") {
//             $target_file = UPLOAD_ARTICLE . $document;
//             if (!move_uploaded_file($_FILES['txtDocument']['tmp_name'], $target_file)) {
//                 $this->session->set_userdata('toastrError', 'Problem uploading document...');
//                 redirect(BACKOFFICE . SHOW_DATA_ARTICLES, 'refresh');
//             }
//         }

//         // Missing $prop for the first author
//         $prop = [
//             'articleID' => $inserted_id,
//             'name' => $this->input->post('txtAuthor1Name'),
//             'email' => $this->input->post('txtAuthor1Email'),
//             'affiliation' => $this->input->post('txtAuthor1Affiliation'),
//             'authorPhoto' => $this->input->post('txtAuthor1Photo') ?? 'default.jpg',
//             'designationID' => $this->input->post('cmbDesignationID1'),
//             'superscript_number' => $this->input->post('txtAuthor1NameSup'),
//             'createdByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
//         ];
//         $this->CommonModel->insertRecord('ijps_tblarticalauthor', $prop);

//         // Handle additional authors
//         $authorName = $this->input->post('txtAuthorName');
//         $authorEmail = $this->input->post('txtAuthoEmail');
//         $authorPhoto = $this->input->post('txtAuthorPhoto');
//         $authorAffiliation = $this->input->post('txtAuthorAffiliation');
//         $authorDesignation = $this->input->post('cmbDesignationID');
//         $superscript = $this->input->post('txtAuthorNameSup');

//         if (!empty($authorName)) {
//             for ($i = 0; $i < count($authorName); $i++) {
//                 $authorPhotoName = (!empty($_FILES['txtAuthorPhoto']['name'][$i]))
//                     ? "AuthorPhoto-" . date('YmdHis') . $i . "." . pathinfo($_FILES['txtAuthorPhoto']['name'][$i], PATHINFO_EXTENSION)
//                     : ($authorPhoto[$i] ?? 'default.jpg');

//                 $authorData = [
//                     'articleID' => $inserted_id,
//                     'name' => $authorName[$i],
//                     'email' => $authorEmail[$i],
//                     'affiliation' => $authorAffiliation[$i],
//                     'authorPhoto' => $authorPhotoName,
//                     'designationID' => $authorDesignation[$i],
//                     'superscript_number' => $superscript[$i],
//                     'createdByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
//                 ];

//                 $this->CommonModel->insertRecord('ijps_tblarticalauthor', $authorData);

//                 if (!empty($_FILES["txtAuthorPhoto"]["name"][$i])) {
//                     $target_file = UPLOAD_AUTHORS . $authorPhotoName;
//                     if (!move_uploaded_file($_FILES['txtAuthorPhoto']['tmp_name'][$i], $target_file)) {
//                         echo json_encode(['status' => 'error', 'msg' => 'Problem uploading author photo...']);
//                         exit;
//                     }
//                 }
//             }
//         }

//         echo json_encode([
//             'status' => 'success',
//             'msg' => 'Article added successfully...',
//             'inserted_id' => $inserted_id
//         ]);
//         exit;
//     } else {
//         echo json_encode(['status' => 'error', 'msg' => 'Data was not saved!']);
//     }
// }


public function insertArticle()
{

    // Extract the thumbnail image name
    $thumbnailImage = basename(parse_url($this->input->post('txtThumbnailImage'), PHP_URL_PATH));

    // Handle document upload
    if ($_FILES['txtDocument']['name'] == "") {
        $document = "";
    } else {
        $ext = substr(strrchr($_FILES['txtDocument']['name'], '.'), 1);
        $document = urlencode($this->input->post('txtPaperTitleOne')) . "." . $ext;
    }

    // Process date fields
    $dtpDateOfRec = !empty($this->input->post('dtpDateOfRec'))
        ? date("Y-m-d", strtotime($this->input->post('dtpDateOfRec')))
        : "0000-00-00";

    $dtpDateOfRevised = !empty($this->input->post('dtpDateOfRevised'))
        ? date("Y-m-d", strtotime($this->input->post('dtpDateOfRevised')))
        : "0000-00-00";

    $dtpDateOfAccepted = !empty($this->input->post('dtpDateOfAccepted'))
        ? date("Y-m-d", strtotime($this->input->post('dtpDateOfAccepted')))
        : "0000-00-00";

    $dtpDateOfPublication = !empty($this->input->post('dtpDateOfPublication'))
        ? date("Y-m-d", strtotime($this->input->post('dtpDateOfPublication')))
        : date("Y-m-d");

    $chkRevisedFlag = $this->input->post('chkRevisedFlag') ? 1 : 0;

    // Prepare the article data

	// $uploadPath = './uploads/article_images/';
    //     if (!is_dir($uploadPath)) {
    //         mkdir($uploadPath, 0777, true);
    //     }

    //     // Handle CKEditor data
    //     $reference = $this->processCkeditorContent($this->input->post('reference'), $uploadPath);
    //     $affiliation = $this->processCkeditorContent($this->input->post('affiliation'), $uploadPath);
    //     $introduction = $this->processCkeditorContent($this->input->post('introduction'), $uploadPath);
	$affiliation = $this->input->post('affiliation', false);
	$reference = $this->input->post('reference', false);
	$introduction = $this->input->post('introduction', false);
	
    $prop = [
        'manuscriptID' => $this->input->post('cmbArticalID'),
        'articleIDUniqueCode' => $this->input->post('txtUniqueCode'),
        'articalTypeID' => $this->input->post('cmbArticalTypeID'),
        'thumbnailImage' => $thumbnailImage,
        'titleOfPaper' => $this->input->post('txtPaperTitle'),
        'titleOfPaperOne' => $this->input->post('txtPaperTitleOne'),
        'abstract' => $this->input->post('txtAbstract'),
        'affiliation' => $affiliation,
        'document' => $document,
        'reference' => $reference,
        'doi' => $this->input->post('txtDOI'),
        'revisedFlag' => $chkRevisedFlag,
        'receivedDate' => $dtpDateOfRec,
        'revisedDate' => $dtpDateOfRevised,
        'acceptedDate' => $dtpDateOfAccepted,
        'keywords' => $this->input->post('txtKeywords'),
        'featuredArticleFlag' => $this->input->post('rbtnFeaturedArticleFlag'),
        'citation' => $this->input->post('txtCitation'),
        // 'txtBody' => $this->input->post('introduction'),
		'txtBody' => $introduction,
        'createdDate' => $dtpDateOfPublication,
        'createdByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
    ];
	
	// log_message('error', 'Affiliation Data: ' . $affiliation);
	// print_r($prop); die;
    // Insert the article data into the database
	
    $bool = $this->CommonModel->insertRecord(self::$table, $prop);

    // Get the inserted ID
    $inserted_id = $this->db->insert_id();

    if ($bool == 1) {
		// echo $bool; die;
        // Handle thumbnail image upload
        if ($_FILES["txtThumbnailImage"]["name"] != "") {
            $target_file = UPLOAD_ARTICLE . $thumbnailImage;
            if (!move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file)) {
                $this->session->set_userdata('toastrError', 'Problem uploading image...');
                redirect(BACKOFFICE . SHOW_DATA_ARTICLES, 'refresh');
            }
        }

        // Handle document upload
        if ($_FILES["txtDocument"]["name"] != "") {
			$uploadPath = FCPATH . 'assetsbackoffice/uploads/article/' . $document;

			// $uploadPath = rtrim(UPLOAD_ARTICLE, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $document;
			$target_file = $uploadPath;

		
			// Check if the directory exists and is writable
			if (!file_exists(dirname($target_file))) {
				die('Upload directory does not exist.');
			}
			
			if (!is_writable(dirname($target_file))) {
				die('Upload directory is not writable.');
			}
			
			if (!is_uploaded_file($_FILES['txtDocument']['tmp_name'])) {
				die('File is not uploaded properly.');
			}
		
			// Move uploaded file to target location
			if (!move_uploaded_file($_FILES['txtDocument']['tmp_name'], $target_file)) {
				die('Failed to move uploaded file.');
			}
			// echo "hhhhhhhhhhhhhhhhhhhhhhhh";
			// Compress the PDF file using ilovepdf_lib
			$compressed_file = $this->ilovepdf_lib->compressPDF($target_file);
			
			if (in_array($compressed_file['status_value'], ['100', '300', '400', '500', '600', '700'])) {
				// Do nothing, original file is already saved
			} elseif ($compressed_file['status_value'] == '200') {
				$compressed_file = $this->ilovepdf_lib->compressPDF($target_file);
			}
			// echo 'lllllllllllllllllllllllll';
			// die;
			// if ($compressed_file) {
			// 	// Overwrite the original file with the compressed file
			// 	rename($compressed_file, $target_file);
			// } else {
			// 	die('PDF compression failed.');
			// }
		}
        
        // if ($_FILES["txtDocument"]["name"] != "") {
        //     $target_file = UPLOAD_ARTICLE . $document;
        //     if (!move_uploaded_file($_FILES['txtDocument']['tmp_name'], $target_file)) {
        //         $this->session->set_userdata('toastrError', 'Problem uploading document...');
        //         redirect(BACKOFFICE . SHOW_DATA_ARTICLES, 'refresh');
        //     }
        // }

        // Handle single author insertion
        $lastID = $this->db->insert_id();
					
					if($_FILES['txtAuthor1Photo']['name'] =="")
    				{
    					$authorPhotoName = $this->input->post('txtAuthor1Photo');
    				}
    				else
    				{
    					$ext = substr( strrchr($_FILES['txtAuthor1Photo']['name'], '.'), 1);
    					$authorPhotoName = "AuthorPhoto-".date('YmdHis').".".$ext;
    				}
    				
					$prop = array( 
    								'articleID'         =>  $lastID,
    								'name'          	=>  $this->input->post('txtAuthor1Name'),
    								'email'   	        =>  $this->input->post('txtAuthor1Email'),
    								'affiliation'   	=>  $this->input->post('txtAuthor1Affiliation'),
    								'authorPhoto'		=>  $authorPhotoName,
    								'designationID'     =>  $this->input->post('cmbDesignationID1'),
    								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
									'superscript_number'   		=>  $this->input->post('txtAuthor1NameSup'),
    							);
    				// $this->db->insert('ijps_tblarticalauthor', $prop);

                    // // Print the last executed query
                    // echo "Last Insert Query: " . $this->db->last_query();
    				
    				// echo "<pre>";print_r(	$prop);echo "</pre>";die;
                      $bool = $this->CommonModel->insertRecord('ijps_tblarticalauthor', $prop);
                      
                      if($_FILES["txtAuthor1Photo"]['name'] != "")
    					{
    						/******************************** Author Photo Upload *********************************/
    						$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
    
    						if(move_uploaded_file($_FILES['txtAuthor1Photo']['tmp_name'], $target_file))
    						{
    						}
    						else 
    						{ 
								echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
    							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
    							// redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
    						}
    
    						/**********  Photo Upload *********************************/
    					}
    					
					
					$authorName         = $this->input->post('txtAuthorName');
					$authorEmail        = $this->input->post('txtAuthoEmail');
					$authorPhoto        = $this->input->post('txtAuthorPhoto');
					$authorAffiliation  = $this->input->post('txtAuthorAffiliation');
					$authorDesignation  = $this->input->post('cmbDesignationID');
					$superscript=  $this->input->post('txtAuthorNameSup');

					if(!empty($this->input->post('txtAuthorName')))
					{
    					for($i=0;$i<count($this->input->post('txtAuthorName'));$i++)
    					{
    					    if($_FILES['txtAuthorPhoto']['name'][$i]=="")
            				{
            				    if(isset($authorPhoto[$i]))
            				    {
            				        $authorPhotoName = $authorPhoto[$i];
            				    }
            					else
            					{
            					    $authorPhotoName = 'default.jpg';
            					}
            				}
            				else
            				{
            					$ext = substr( strrchr($_FILES['txtAuthorPhoto']['name'][$i], '.'), 1);
            					$authorPhotoName = "AuthorPhoto-".date('YmdHis').$i.".".$ext;
            				}
    					    $prop = array( 
    								'articleID'         =>  $lastID,
    								'name'          	=>  $authorName[$i],
    								'email'   	        =>  $authorEmail[$i],
    								'affiliation'   	=>  $authorAffiliation[$i],
    								'authorPhoto'		=>  $authorPhotoName,
    								'designationID'     =>  $authorDesignation[$i],
    								'superscript_number'   		=> 	$superscript[$i],
    								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
    							);
    				
                              $bool = $this->CommonModel->insertRecord('ijps_tblarticalauthor', $prop);
                              
                              if($_FILES["txtAuthorPhoto"]['name'][$i] != "")
            					{
            						/******************************** Author Photo Upload *********************************/
            						$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
            
            						if(move_uploaded_file($_FILES['txtAuthorPhoto']['tmp_name'][$i], $target_file))
            						{
            						}
            						else 
            						{ 
										echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
            							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
            							// redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
            						}
            
            						/**********  Photo Upload *********************************/
            					}
    					}
					}
		// header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'msg' => 'Article added successfully...',
            'inserted_id' => $inserted_id
        ]);
        exit;
    } else {
		// echo $bool; die;
        echo json_encode(['status' => 'error', 'msg' => 'Data was not saved!']);
    }
}

         
        public function articleDirect()
    	{
			$articalTypeResult		= $this->CommonModel->getData('ijps_tblarticaltype','','','','');
			$designationResult		= $this->CommonModel->getData('ijps_tbldesignation','','','','');

            $this->load->view(BACKOFFICE.'article/addArticleDirect',['articalTypeResult' => $articalTypeResult, 'designationResult'=>$designationResult]);
    	}
    	
    		public function insertArticleDirect()
        { 
				// if($_FILES['txtThumbnailImage']['name']=="")
				// {
				// 	$thumbnailImage = "";
				// }
				// else
				// {
				// 	$ext = substr( strrchr($_FILES['txtThumbnailImage']['name'], '.'), 1);
				// 	$thumbnailImage = "thumbnailImage-".date('YmdHis').".".$ext;
				// }
				
				$thumbnailImage = basename(parse_url($this->input->post('txtThumbnailImage'), PHP_URL_PATH));
				
				if($_FILES['txtDocument']['name']=="")
				{
					$document = "";
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtDocument']['name'], '.'), 1);
					$document = urlencode($this->input->post('txtPaperTitle')).".".$ext;
					// $document = "document-".date('YmdHis').".".$ext;
				}
				
				if(!empty($this->input->post('dtpDateOfRec')))
                {
                    $dtpDateOfRec   = strtotime(date($this->input->post('dtpDateOfRec')));
				    $dtpDateOfRec   = date("Y-m-d", $dtpDateOfRec);
                }
                else
                {
                    $dtpDateOfRec   = "0000-00-00";
                }
				
				if(!empty($this->input->post('dtpDateOfRevised')))
                {
                    $dtpDateOfRevised   = strtotime(date($this->input->post('dtpDateOfRevised')));
				    $dtpDateOfRevised   = date("Y-m-d", $dtpDateOfRevised);
                }
                else
                {
                    $dtpDateOfRevised   = "0000-00-00";
                }
				
				if(!empty($this->input->post('dtpDateOfAccepted')))
                {
                    $dtpDateOfAccepted   = strtotime(date($this->input->post('dtpDateOfAccepted')));
				    $dtpDateOfAccepted   = date("Y-m-d", $dtpDateOfAccepted);
                }
                else
                {
                    $dtpDateOfAccepted   = "0000-00-00";
                }
                
                if(!empty($this->input->post('dtpDateOfPublication')))
                {
                    $dtpDateOfPublication   = strtotime(date($this->input->post('dtpDateOfPublication')));
				    $dtpDateOfPublication   = date("Y-m-d", $dtpDateOfPublication);
                }
                else
                {
                    $dtpDateOfPublication   = date("Y-m-d");
                }
                
                if($this->input->post('chkRevisedFlag'))
                {
                    $chkRevisedFlag   = 1;
                }
                else
                {
                    $chkRevisedFlag   = 0;   
                }
				
				//echo $dtpDateOfRec." - ".$dtpDateOfAccepted; exit;
				$prop = array( 
								'manuscriptID'		=>  '0',
								'articleIDUniqueCode'=>  $this->input->post('txtUniqueCode'),
								/*'volumeID'			=>  $this->input->post('cmbVolumeID'),
								'issueID'   		=>  $this->input->post('cmbIssueID'),*/
								'articalTypeID'		=>  $this->input->post('cmbArticalTypeID'),
								'thumbnailImage'   	=>  $thumbnailImage,
								'titleOfPaper'   	=>  $this->input->post('txtPaperTitle'),
								'titleOfPaperOne'   	=>  $this->input->post('txtPaperTitleOne'),
								'abstract'   		=>  $this->input->post('txtAbstract'),
								'affiliation'  		=>  $this->input->post('txtAffiliation'),
								'document'   		=>  $document,
								'reference'   		=>  $this->input->post('txtReferance'),
								'doi'   			=>  $this->input->post('txtDOI'),
								'revisedFlag'   	=>  $chkRevisedFlag,
								'receivedDate'   	=>  $dtpDateOfRec,
								'revisedDate'   	=>  $dtpDateOfRevised,
								'acceptedDate'   	=>  $dtpDateOfAccepted,
								'keywords'   		=>  $this->input->post('txtKeywords'),
								'featuredArticleFlag'   		=>  $this->input->post('rbtnFeaturedArticleFlag'),
								'citation'   		=>  $this->input->post('txtCitation'),
								'txtBody'   		=>  $this->input->post('txtBody'),
							
								'createdDate'       => $dtpDateOfPublication,
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
				
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					if($_FILES["txtThumbnailImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_ARTICLE.$thumbnailImage;

						if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
							// redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtDocument"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_ARTICLE.$document;

						if(move_uploaded_file($_FILES['txtDocument']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
							// redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					$lastID = $this->db->insert_id();
					
					if($_FILES['txtAuthor1Photo']['name'] =="")
    				{
    					$authorPhotoName = "default.jpg";
    				}
    				else
    				{
    					$ext = substr(strrchr($_FILES['txtAuthor1Photo']['name'], '.'), 1);
    					$authorPhotoName = "AuthorPhoto-".date('YmdHis').".".$ext;


    				}

					
    				
					$prop = array( 
    								'articleID'         =>  $lastID,
    								'name'          	=>  $this->input->post('txtAuthor1Name'),
    								'email'   	        =>  $this->input->post('txtAuthor1Email'),
    								'affiliation'   	=>  $this->input->post('txtAuthor1Affiliation'),
    								'authorPhoto'		=>  $authorPhotoName,
    								'designationID'     =>  $this->input->post('cmbDesignationID1'),
    								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
									'superscript_number'   		=>  $this->input->post('txtAuthor1NameSup'),
    							);
    				
                      $bool = $this->CommonModel->insertRecord('ijps_tblarticalauthor', $prop);
                      
                       if($_FILES["txtAuthor1Photo"]['name'] != "")
    					{
    						/******************************** Author Photo Upload *********************************/
    						$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
    
    						if(move_uploaded_file($_FILES['txtAuthor1Photo']['tmp_name'], $target_file))
    						{
    						}
    						else 
    						{ 
    							$this->session->set_userdata('toastrError', 'Problem uploading image...');
    							redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
    						}
    
    						/**********  Photo Upload *********************************/
    					}
                      
                    
    					
					
					$authorName         = $this->input->post('txtAuthorName');
					$authorEmail        = $this->input->post('txtAuthoEmail');
					$authorPhoto        = $this->input->post('txtAuthorPhoto');
					$authorAffiliation  = $this->input->post('txtAuthorAffiliation');
					$authorDesignation  = $this->input->post('cmbDesignationID');
					$authorNameSup  = $this->input->post('txtAuthorNameSup');
                    
                    $CAAuthorName   = "";
    				$CAEmail        = "";
    				$CAContact      = "";
    				
					if(!empty($this->input->post('txtAuthorName')))
					{
    					for($i=0;$i<count($this->input->post('txtAuthorName'));$i++)
    					{
    					    if($authorDesignation[$i] == '1')
    					    {
    					        $CAAuthorName   = $authorName[$i];
                				$CAEmail        = $authorEmail[$i];
                				$CAContact      = "";
    					    }
    					    
    					    if($_FILES['txtAuthorPhoto']['name'][$i]=="")
            				{
            					$authorPhotoName = "default.jpg";
            				}
            				else
            				{
            					$ext = substr( strrchr($_FILES['txtAuthorPhoto']['name'][$i], '.'), 1);
            					$authorPhotoName = "AuthorPhoto-".date('YmdHis').$i.".".$ext;
            				}
    					    $prop = array( 
    								'articleID'         =>  $lastID,
    								'name'          	=>  $authorName[$i],
    								'email'   	        =>  $authorEmail[$i],
    								'affiliation'   	=>  $authorAffiliation[$i],
    								'authorPhoto'		=>  $authorPhotoName,
    								'designationID'     =>  $authorDesignation[$i],
    								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
									'superscript_number' =>$authorNameSup[$i]
    							);
                            
                              $bool = $this->CommonModel->insertRecord('ijps_tblarticalauthor', $prop);
                              
                               if($_FILES["txtAuthorPhoto"]['name'][$i] != "")
            					{
            						/******************************** Author Photo Upload *********************************/
            						$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
            
            						if(move_uploaded_file($_FILES['txtAuthorPhoto']['tmp_name'][$i], $target_file))
            						{
            						}
            						else 
            						{ 
										echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
            							// $this->session->set_userdata('toastrError', 'Problem uploading image...');
            							// redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
            						}
            
            						/**********  Photo Upload *********************************/
            					}
                              
      
								}
							}
					
					 
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Artical Title : ".$this->input->post('txtArticalURL', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' added successfully...'));
				
                  }
                  else
                  {
					echo json_encode(array('status'=>'error','msg'=>'Data was not saved!'));
                   
                  }
   
        }
		public function getArticle($prop)
		{	
		    
			$articleResult				= $this->ArticleModel->getArticle($prop);
			$designationResult		= $this->CommonModel->getData('ijps_tbldesignation','','','','');
			$articleResult['authorInfo']   = $this->CommonModel->getDataLimit('ijps_tblarticalauthor', array('isActive'=>'1', 'articleID'=> $articleResult[0]['articleID']), '', '', '', '', '' ,'articalAuthorID','ASC'); 
			
			if(!empty($articleResult))
			{
				$articalTypeResult		= $this->CommonModel->getData('ijps_tblarticaltype','','','','');
				$volumeResult			= $this->CommonModel->getData('ijps_tblvolume','','','','');
				$issueResult			= $this->CommonModel->getData('ijps_tblissue','','','','');
				$manuscriptResult		= $this->CommonModel->getData('ijps_tblmanuscript','','','','');
				$authorResult			= $this->CommonModel->getData('ijps_tblauthor','','','','');
				
				

				$this->load->view(BACKOFFICE.'article/addArticle',['articalTypeResult' => $articalTypeResult, 'volumeResult' => $volumeResult, 'issueResult' => $issueResult, 'manuscriptResult' => $manuscriptResult, 'articleResult' => $articleResult, 'authorResult' => $authorResult, 'designationResult' => $designationResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPT, 'refresh');
			}
		}
		
		public function updateArticle_bk()
        {
               
				// if($_FILES['txtThumbnailImage']['name']=="")
				// {
				// 	$thumbnailImage = $this->input->post('txtThumbnailImage');
				// }
				// else
				// {
				// 	$ext = substr( strrchr($_FILES['txtThumbnailImage']['name'], '.'), 1);
				// 	$thumbnailImage = "thumbnailImage-".date('YmdHis').".".$ext;
				// }
					$thumbnailImage = basename(parse_url($this->input->post('txtThumbnailImage'), PHP_URL_PATH));
				if($_FILES['txtDocument']['name']=="")
				{
					$document = $this->input->post('txtDocument');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtDocument']['name'], '.'), 1);
						$document = urlencode($this->input->post('txtPaperTitleOne')).".".$ext;
				// 	$document = "document-".date('YmdHis').".".$ext;
				}
				
				if(!empty($this->input->post('dtpDateOfRec')))
                {
                    $dtpDateOfRec   = strtotime(date($this->input->post('dtpDateOfRec')));
				    $dtpDateOfRec   = date("Y-m-d", $dtpDateOfRec);
                }
                else
                {
                    $dtpDateOfRec   = "0000-00-00";
                }
				
				if(!empty($this->input->post('dtpDateOfRevised')))
                {
                    $dtpDateOfRevised   = strtotime(date($this->input->post('dtpDateOfRevised')));
				    $dtpDateOfRevised   = date("Y-m-d", $dtpDateOfRevised);
                }
                else
                {
                    $dtpDateOfRevised   = "0000-00-00";
                }
				
				if(!empty($this->input->post('dtpDateOfAccepted')))
                {
                    $dtpDateOfAccepted   = strtotime(date($this->input->post('dtpDateOfAccepted')));
				    $dtpDateOfAccepted   = date("Y-m-d", $dtpDateOfAccepted);
                }
                else
                {
                    $dtpDateOfAccepted   = "0000-00-00";
                }
                
                if(!empty($this->input->post('dtpDateOfPublication')))
                {
                    $dtpDateOfPublication   = strtotime(date($this->input->post('dtpDateOfPublication')));
				    $dtpDateOfPublication   = date("Y-m-d", $dtpDateOfPublication);
                }
                else
                {
                    $dtpDateOfPublication   = date("Y-m-d");
                }
                
                if($this->input->post('chkRevisedFlag'))
                {
                    $chkRevisedFlag   = 1;
                }
                else
                {
                    $chkRevisedFlag   = 0;   
                }
				$prop = array( 
								'manuscriptID'		=>  $this->input->post('cmbArticalID'),
								'articalTypeID'		=>  $this->input->post('cmbArticalTypeID'),
								'thumbnailImage'   	=>  $thumbnailImage,
								'titleOfPaper'   	=>  $this->input->post('txtPaperTitle'),
								'titleOfPaperOne'   	=>  $this->input->post('txtPaperTitleOne'),
								'abstract'   		=>  $this->input->post('txtAbstract'),
								'affiliation'  		=>  $this->input->post('affiliation'),
								'document'   		=>  $document,
								'reference'   		=>  $this->input->post('reference'),
								'doi'   			=>  $this->input->post('txtDOI'),
								'revisedFlag'   	=>  $chkRevisedFlag,
								'receivedDate'   	=>  $dtpDateOfRec,
								'revisedDate'   	=>  $dtpDateOfRevised,
								'acceptedDate'   	=>  $dtpDateOfAccepted,
								'txtBody'   		=>  $this->input->post('introduction'),
								'keywords'   		=>  $this->input->post('txtKeywords'),
								'featuredArticleFlag'   		=>  $this->input->post('rbtnFeaturedArticleFlag'),
								'citation'   		=>  $this->input->post('txtCitation'),
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $articleID = filter_var($this->input->post('txtArticleID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $articleID, self::$pkey);

				if($bool == 1)
				{
					if($_FILES["txtThumbnailImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_ARTICLE.$thumbnailImage;

						if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES["txtDocument"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_ARTICLE.$document;

						if(move_uploaded_file($_FILES['txtDocument']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					if($_FILES['txtAuthor1Photo']['name'] =="")
    				{
    					$authorPhotoName = $this->input->post('txtAuthor1Photo');
    				}
    				else
    				{
    					$ext = substr( strrchr($_FILES['txtAuthor1Photo']['name'], '.'), 1);
    					$authorPhotoName = "AuthorPhoto-".date('YmdHis').".".$ext;
    				}
    				
					$prop = array( 
    								'articleID'         =>  $this->input->post('txtArticleID'),
    								'name'          	=>  $this->input->post('txtAuthor1Name'),
    								'email'   	        =>  $this->input->post('txtAuthor1Email'),
    								'affiliation'   	=>  $this->input->post('txtAuthor1Affiliation'),
    								'authorPhoto'		=>  $authorPhotoName,
    								'designationID'     =>  $this->input->post('cmbDesignationID1'),
    								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
    								'superscript_number'   		=>  $this->input->post('txtAuthor1NameSup')
    							);
    				
    				$articalAuthorID = filter_var($this->input->post('txtArticalAuthorID'), FILTER_SANITIZE_NUMBER_INT);
                    $bool = $this->CommonModel->updateRecord('ijps_tblarticalauthor', $prop, $articalAuthorID, 'articalAuthorID');
                      
                      if($_FILES["txtAuthor1Photo"]['name'] != "")
    					{
    						/******************************** Author Photo Upload *********************************/
    						$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
    
    						if(move_uploaded_file($_FILES['txtAuthor1Photo']['tmp_name'], $target_file))
    						{
    						}
    						else 
    						{ 
    							$this->session->set_userdata('toastrError', 'Problem uploading image...');
    							redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
    						}
    
    						/**********  Photo Upload *********************************/
    					}
    					
					
					$authorName         = $this->input->post('txtAuthorName');
					$authorEmail        = $this->input->post('txtAuthoEmail');
					$authorPhoto        = $this->input->post('txtAuthorPhoto');
					$authorAffiliation  = $this->input->post('txtAuthorAffiliation');
					$authorDesignation  = $this->input->post('cmbDesignationID');
					$articalAuthor  = $this->input->post('txtArticalAuthorID');
					$superscript=  $this->input->post('txtAuthorNameSup');
					//print_r($this->input->post('txtAuthorName'));exit;
                    //  echo "<pre>";print_r($this->input->post());exit;
					if(!empty($this->input->post('txtAuthorName')))
					{
    					for($i=0;$i<count($this->input->post('txtAuthorName'));$i++)
    					{
    					    if($_FILES['txtAuthorPhoto']['name'][$i]=="")
            				{
            					$authorPhotoName = $authorPhoto[$i];
            				}
            				else
            				{
            					$ext = substr( strrchr($_FILES['txtAuthorPhoto']['name'][$i], '.'), 1);
            					$authorPhotoName = "AuthorPhoto-".date('YmdHis').$i.".".$ext;
            				}
    					    $prop = array( 
    								'articleID'         =>  $this->input->post('txtArticleID'),
    								'name'          	=>  $authorName[$i],
    								'email'   	        =>  $authorEmail[$i],
    								'affiliation'   	=>  $authorAffiliation[$i],
    								'authorPhoto'		=>  $authorPhotoName,
    								'designationID'     =>  $authorDesignation[$i],
    									'superscript_number'   		=> 	$superscript[$i],
    								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
    							);
    				
                            $articalAuthorID = filter_var($articalAuthor[$i], FILTER_SANITIZE_NUMBER_INT);
                            if($articalAuthor[$i] == "")
                            {
                                $bool = $this->CommonModel->insertRecord('ijps_tblarticalauthor', $prop);
                            }
                            else
                            {
                                $bool = $this->CommonModel->updateRecord('ijps_tblarticalauthor', $prop, $articalAuthorID, 'articalAuthorID');
                            }
                            
                            
                              //echo $bool."-".$articalAuthor[$i];exit;
                              if($_FILES["txtAuthorPhoto"]['name'][$i] != "")
            					{
            						/******************************** Author Photo Upload *********************************/
            						$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
            
            						if(move_uploaded_file($_FILES['txtAuthorPhoto']['tmp_name'][$i], $target_file))
            						{
            						}
            						else 
            						{ exit;
            							$this->session->set_userdata('toastrError', 'Problem uploading image...');
            							redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
            						}
            
            						/**********  Photo Upload *********************************/
            					}
    					}
					}
					
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtArticleID'), FILTER_SANITIZE_NUMBER_INT)." - Article Title : ".$this->input->post('txtTitle', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
						echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.'  updated successfully....'));
        }
        else
            {
                	echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
            }
           
        }
                public function updateArticle()
        {
               
				// if($_FILES['txtThumbnailImage']['name']=="")
				// {
				// 	$thumbnailImage = $this->input->post('txtThumbnailImage');
				// }
				// else
				// {
				// 	$ext = substr( strrchr($_FILES['txtThumbnailImage']['name'], '.'), 1);
				// 	$thumbnailImage = "thumbnailImage-".date('YmdHis').".".$ext;
				// }
		    	$thumbnailImage = basename(parse_url($this->input->post('txtThumbnailImage'), PHP_URL_PATH)); 
				if($_FILES['txtDocument']['name']=="")
				{
					$document = $this->input->post('txtDocument');
				}
				else
				{
					$ext = substr( strrchr($_FILES['txtDocument']['name'], '.'), 1);
						$document = urlencode($this->input->post('txtPaperTitleOne')).".".$ext;
				// 	$document = "document-".date('YmdHis').".".$ext;
				}
				
				if(!empty($this->input->post('dtpDateOfRec')))
                {
                    $dtpDateOfRec   = strtotime(date($this->input->post('dtpDateOfRec')));
				    $dtpDateOfRec   = date("Y-m-d", $dtpDateOfRec);
                }
                else
                {
                    $dtpDateOfRec   = "0000-00-00";
                }
				
				if(!empty($this->input->post('dtpDateOfRevised')))
                {
                    $dtpDateOfRevised   = strtotime(date($this->input->post('dtpDateOfRevised')));
				    $dtpDateOfRevised   = date("Y-m-d", $dtpDateOfRevised);
                }
                else
                {
                    $dtpDateOfRevised   = "0000-00-00";
                }
				
				if(!empty($this->input->post('dtpDateOfAccepted')))
                {
                    $dtpDateOfAccepted   = strtotime(date($this->input->post('dtpDateOfAccepted')));
				    $dtpDateOfAccepted   = date("Y-m-d", $dtpDateOfAccepted);
                }
                else
                {
                    $dtpDateOfAccepted   = "0000-00-00";
                }
                
                if(!empty($this->input->post('dtpDateOfPublication')))
                {
                    $dtpDateOfPublication   = strtotime(date($this->input->post('dtpDateOfPublication')));
				    $dtpDateOfPublication   = date("Y-m-d", $dtpDateOfPublication);
                }
                else
                {
                    $dtpDateOfPublication   = date("Y-m-d");
                }
                
                if($this->input->post('chkRevisedFlag'))
                {
                    $chkRevisedFlag   = 1;
                }
                else
                {
                    $chkRevisedFlag   = 0;   
                }
                
                $affiliation = $this->input->post('affiliation', false);
            	$reference = $this->input->post('reference', false);
            	$introduction = $this->input->post('introduction', false);
            	
				$prop = array( 
								'manuscriptID'		=>  $this->input->post('cmbArticalID'),
								'articalTypeID'		=>  $this->input->post('cmbArticalTypeID'),
								'thumbnailImage'   	=>  $thumbnailImage,
								'titleOfPaper'   	=>  $this->input->post('txtPaperTitle'),
								'titleOfPaperOne'   	=>  $this->input->post('txtPaperTitleOne'),
								'abstract'   		=>  $this->input->post('txtAbstract'),
								// 'affiliation'  		=>  $this->input->post('affiliation'),
								'affiliation' => $affiliation,
								'document'   		=>  $document,
								// 'reference'   		=>  $this->input->post('reference'),
								'reference' => $reference,
								'doi'   			=>  $this->input->post('txtDOI'),
								'revisedFlag'   	=>  $chkRevisedFlag,
								'receivedDate'   	=>  $dtpDateOfRec,
								'revisedDate'   	=>  $dtpDateOfRevised,
								'acceptedDate'   	=>  $dtpDateOfAccepted,
								// 'txtBody'   		=>  $this->input->post('introduction'),
								'txtBody' => $introduction,
								'keywords'   		=>  $this->input->post('txtKeywords'),
								'featuredArticleFlag'   		=>  $this->input->post('rbtnFeaturedArticleFlag'),
								'citation'   		=>  $this->input->post('txtCitation'),
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
              
			    $articleID = filter_var($this->input->post('txtArticleID'), FILTER_SANITIZE_NUMBER_INT);
			    $inserted_id = $articleID;
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $articleID, self::$pkey);

				if($bool == 1)
				{
					if($_FILES["txtThumbnailImage"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_ARTICLE.$thumbnailImage;

						if(move_uploaded_file($_FILES['txtThumbnailImage']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
					
					
				// 	========================================================
				
				if ($_FILES["txtDocument"]["name"] != "") {
        			$uploadPath = FCPATH . 'assetsbackoffice/uploads/article/' . $document;
        
        			// $uploadPath = rtrim(UPLOAD_ARTICLE, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $document;
        			$target_file = $uploadPath;
        
        		
        			// Check if the directory exists and is writable
        			if (!file_exists(dirname($target_file))) {
        				die('Upload directory does not exist.');
        			}
        			
        			if (!is_writable(dirname($target_file))) {
        				die('Upload directory is not writable.');
        			}
        			
        			if (!is_uploaded_file($_FILES['txtDocument']['tmp_name'])) {
        				die('File is not uploaded properly.');
        			}
        		
        			// Move uploaded file to target location
        			if (!move_uploaded_file($_FILES['txtDocument']['tmp_name'], $target_file)) {
        				die('Failed to move uploaded file.');
        			}
        			// echo "hhhhhhhhhhhhhhhhhhhhhhhh";
        			// Compress the PDF file using ilovepdf_lib
        			$compressed_file = $this->ilovepdf_lib->compressPDF($target_file);
        			
        			if (in_array($compressed_file['status_value'], ['100', '300', '400', '500', '600', '700'])) {
        				// Do nothing, original file is already saved
        			} elseif ($compressed_file['status_value'] == '200') {
        				$compressed_file = $this->ilovepdf_lib->compressPDF($target_file);
        			}
        			// echo 'lllllllllllllllllllllllll';
        			// die;
        			// if ($compressed_file) {
        			// 	// Overwrite the original file with the compressed file
        			// 	rename($compressed_file, $target_file);
        			// } else {
        			// 	die('PDF compression failed.');
        			// }
        		}
        		
        		
				// 	if($_FILES["txtDocument"]["name"] != "")
				// 	{
				// 		/******************************** Author Photo Upload *********************************/
				// 		$target_file    = UPLOAD_ARTICLE.$document;

				// 		if(move_uploaded_file($_FILES['txtDocument']['tmp_name'], $target_file))
				// 		{
				// 		}
				// 		else 
				// 		{ 
				// 			$this->session->set_userdata('toastrError', 'Problem uploading image...');
				// 			redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
				// 		}

				// 		/**********  Photo Upload *********************************/
				// 	}
					
					if($_FILES['txtAuthor1Photo']['name'] =="")
    				{
    					$authorPhotoName = $this->input->post('txtAuthor1Photo');
    				}
    				else
    				{
    					$ext = substr( strrchr($_FILES['txtAuthor1Photo']['name'], '.'), 1);
    					$authorPhotoName = "AuthorPhoto-".date('YmdHis').".".$ext;
    				}
    				
					$prop = array( 
    								'articleID'         =>  $this->input->post('txtArticleID'),
    								'name'          	=>  $this->input->post('txtAuthor1Name'),
    								'email'   	        =>  $this->input->post('txtAuthor1Email'),
    								'affiliation'   	=>  $this->input->post('txtAuthor1Affiliation'),
    								'authorPhoto'		=>  $authorPhotoName,
    								'designationID'     =>  $this->input->post('cmbDesignationID1'),
    								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
    								'superscript_number'   		=>  $this->input->post('txtAuthor1NameSup')
    							);

								
					$articalAuthorID = filter_var($this->input->post('txtArticalAuthorID'), FILTER_SANITIZE_NUMBER_INT);
					$txt_article_author_id = filter_var($this->input->post('txt_article_author_id'), FILTER_SANITIZE_NUMBER_INT);
					
    				
                    $bool = $this->CommonModel->updateRecord('ijps_tblarticalauthor', $prop, $txt_article_author_id, 'articalAuthorID');
                      
                      if($_FILES["txtAuthor1Photo"]['name'] != "")
    					{
    						/******************************** Author Photo Upload *********************************/
    						$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
    
    						if(move_uploaded_file($_FILES['txtAuthor1Photo']['tmp_name'], $target_file))
    						{
    						}
    						else 
    						{ 
    							$this->session->set_userdata('toastrError', 'Problem uploading image...');
    							redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
    						}
    
    						/**********  Photo Upload *********************************/
    					}

						
    					
					
					$authorName         = $this->input->post('txtAuthorName');
					$authorEmail        = $this->input->post('txtAuthoEmail');
					$authorPhoto        = $this->input->post('txtAuthorPhoto');
					$authorAffiliation  = $this->input->post('txtAuthorAffiliation');
					$authorDesignation  = $this->input->post('cmbDesignationID');
					$articalAuthor  = $this->input->post('txtArticalAuthorID');
					$superscript=  $this->input->post('txtAuthorNameSup');
					
					if(!empty($this->input->post('txtAuthorName')))
					{
    					for($i=0;$i<count($this->input->post('txtAuthorName'));$i++)
    					{
    					    if($_FILES['txtAuthorPhoto']['name'][$i]=="")
            				{
            					$authorPhotoName = $authorPhoto[$i];
            				}
            				else
            				{
            					$ext = substr( strrchr($_FILES['txtAuthorPhoto']['name'][$i], '.'), 1);
            					$authorPhotoName = "AuthorPhoto-".date('YmdHis').$i.".".$ext;
            				}
    					    $prop = array( 
    								'articleID'         =>  $this->input->post('txtArticleID'),
    								'name'          	=>  $authorName[$i],
    								'email'   	        =>  $authorEmail[$i],
    								'affiliation'   	=>  $authorAffiliation[$i],
    								'authorPhoto'		=>  $authorPhotoName,
    								'designationID'     =>  $authorDesignation[$i],
    									'superscript_number'   		=> 	$superscript[$i],
    								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
    							);
    				
                            $articalAuthorID = filter_var($articalAuthor[$i], FILTER_SANITIZE_NUMBER_INT);
                            if($articalAuthor[$i] == "")
                            {
                                $bool = $this->CommonModel->insertRecord('ijps_tblarticalauthor', $prop);
                            }
                            else
                            {
                                $bool = $this->CommonModel->updateRecord('ijps_tblarticalauthor', $prop, $articalAuthorID, 'articalAuthorID');
                            }
                            
                            
                              //echo $bool."-".$articalAuthor[$i];exit;
                              if($_FILES["txtAuthorPhoto"]['name'][$i] != "")
            					{
            						/******************************** Author Photo Upload *********************************/
            						$target_file    = UPLOAD_AUTHORS.$authorPhotoName;
            
            						if(move_uploaded_file($_FILES['txtAuthorPhoto']['tmp_name'][$i], $target_file))
            						{
            						}
            						else 
            						{ exit;
            							$this->session->set_userdata('toastrError', 'Problem uploading image...');
            							redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
            						}
            
            						/**********  Photo Upload *********************************/
            					}
    					}
					}
					
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtArticleID'), FILTER_SANITIZE_NUMBER_INT)." - Article Title : ".$this->input->post('txtTitle', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
						// echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.'  updated successfully....'));
						echo json_encode([
							'status' => 'success',
							'msg' => 'Article updated successfully...',
							'inserted_id' => $inserted_id
						]);
						exit;
				}
				else
					{
							echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
					}
           
        }
        
		public function setVisibilityArticle($articleID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $articleID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$articleID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
            }
        }
        
        public function deleteArticle($articleID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $articleID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$articleID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_ARTICLES, 'refresh');
            }
        }  
    
	}
    
?>
