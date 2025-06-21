<?php

ob_start(); 
defined('BASEPATH') or exit('No direct script access allowed');


class HomeController extends CI_Controller
{
    private $per_page;
    private $per_page_reference;
    
	public function __construct()
	{
	    
	    
		parent::__construct();
		$this->load->library('encryption');
		$this->load->model(BACKOFFICE . 'Blogmodel', 'BlogModel');
		$this->load->model(BACKOFFICE . 'Articlemodel', 'ArticleModel');
		$this->load->model(BACKOFFICE . 'loginmodel', 'login');
		$this->load->model(BACKOFFICE . 'Manuscriptmodel', 'ManuscriptModel');
		$this->load->library("pagination"); 
	}

	public function dashboard()
	{
		if ($this->session->userdata('name') == "" || $this->session->userdata('authorMailID') == "") {
			redirect(HOME, 'refresh');
		} else {
			$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
			$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

			$submittedCount = $this->CommonModel->getData('ijps_tblmanuscript', array('isActive' => '1', 'email' => $this->session->userdata('authorMailID')), '', '', 'num_rows');
			$publishedCount = $this->CommonModel->getData('ijps_tblmanuscript', array('isActive' => '1', 'email' => $this->session->userdata('authorMailID'), 'statusID' => '4'), '', '', 'num_rows');
			$pendingCount   = $submittedCount - $publishedCount;

			$headerData = array(
				'firstHeading' 		=> 'Dashboard',
				'secoundHeading' 	=> 'Dashboard'
			);


			$this->load->view('frontend/dashboard', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'submittedCount' => $submittedCount, 'publishedCount' => $publishedCount, 'pendingCount' => $pendingCount]);
		}
	}

	public function manuscriptlist()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		$manuscriptList = $this->ManuscriptModel->getManuscriptDetailsAsPerMailID($this->session->userdata('authorMailID'));

		if (count($manuscriptList) > 0) {
			for ($i = 0; $i < count($manuscriptList); $i++) {
				if ($manuscriptList[$i]['statusID'] == 4) {
					$tempData	= $this->CommonModel->getDataLimit('ijps_tblarticle', array('isActive' => '1', 'articleIDUniqueCode' => $manuscriptList[$i]['uniqueCode']), '', '', '', '', '', 'articleID ', 'DESC');
					$manuscriptList[$i]['link'] = $tempData[0]['articleID'];
					$manuscriptList[$i]['thumbnailImage'] = $tempData[0]['thumbnailImage'];
					$manuscriptList[$i]['abstract'] = $tempData[0]['abstract'];
					$manuscriptList[$i]['document'] = $tempData[0]['document'];
					$manuscriptList[$i]['reference'] = $tempData[0]['reference'];
					$manuscriptList[$i]['doi'] = $tempData[0]['doi'];
					
					// echo "<pre>"; print_r($tempData);
				}
			}
		}
		$headerData = array(
			'firstHeading' 		=> 'Dashboard',
			'secoundHeading' 	=> 'Dashboard'
		);

		$this->load->view('frontend/manuscript-list', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'manuscriptList' => $manuscriptList]);
	}
	public function send() {
		$this->load->config('email');
			$this->load->library('email');
		
			$from = 'no-reply@myapp.com';
			$to = $this->input->post('to');
		
			$this->email->from($from);
			$this->email->to($to);
			$this->email->subject('New email');
		$this->email->message('New email received!');
		
			if ($this->email->send()) {
		echo 'Sent with success!';
			} else {
		show_error($this->email->print_debugger());
		}
		}
	public function index()
	{

		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		//$successStoriesResult	= $this->CommonModel->getDataLimit('tblhappystory', array('isActive'=>'1'), '', '', '', '10', '0' ,'happyStoryID','desc');
		$profilesResult = array();

		/*
			if(($this->session->userdata('userType') == 2 && $this->session->userdata('genderID') == 2) || (empty($this->session->userdata('userType'))))
			{
				$profilesResult[2]	= $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID != 2", "ROUND(DATEDIFF(CURDATE(), dateOf‎Birth) / 365) AS age, CONCAT('AW', LPAD(profileID, 6, '0')) AS profileCode, tblprofile.*", '', '', '10', '0','profileID','desc'); 
			}
			
			if(($this->session->userdata('userType') == 2 && $this->session->userdata('genderID') == 1) || (empty($this->session->userdata('userType'))))
			{
				$profilesResult[1]	= $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID != 1", "ROUND(DATEDIFF(CURDATE(), dateOf‎Birth) / 365) AS age, CONCAT('AW', LPAD(profileID, 6, '0')) AS profileCode, tblprofile.*", '', '', '10', '0','profileID','desc'); 
			}
			*/

		$newsletterResult	= $this->CommonModel->getDataLimit('ijps_tblnewsletter', array('isActive' => '1'), '', '', '', '3', '', 'newsletterID', 'DESC');

		$articalesResult	= $this->ArticleModel->getHomeArticles();
// 		print_r($articalesResult); die;
		$tempAuthor = array();
		$tempAuthorNames = "";

		$headerColData = array(
			"year"  => date('Y'),
			"month" => date('m'),
			"volume" => $volume = sprintf("%02d", ((idate('y') - 23) + 1))
		);

		for ($i = 0; $i < count($articalesResult); $i++) {
			$authorResult	= $this->CommonModel->getDataLimit('ijps_tblarticalauthor', array('isActive' => '1', 'articleID' => $articalesResult[$i]['articleID']), '', '', '', '', '', 'designationID ', 'ASC');


			for ($j = 0; $j < count($authorResult); $j++) {
				$articalesResult[$i]['authorImages'] = '';

				if ($authorResult[$j]['authorPhoto'] != "" && $authorResult[$j]['authorPhoto'] != "default.jpg") {
					if ((count($tempAuthor) < 3)) {
						$tempAuthor[] = $authorResult[$j]['authorPhoto'];
					}
				}

				$tempAuthorNames .= $authorResult[$j]['name'] . ", ";
				rtrim($tempAuthorNames, ", ");
			}
			$articalesResult[$i]['authorImages'] = $tempAuthor;
			$articalesResult[$i]['authorNames'] = $tempAuthorNames;
			$tempAuthor = array();
			$tempAuthorNames = "";
		}
		//echo "<pre>"; print_r($articalesResult);exit;

		//$this->load->view('frontend/home', ['successStoriesResult'=> $successStoriesResult, 'profilesResult'=> $profilesResult, 'newsletterResult'=>$newsletterResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
		//$this->load->view('frontend/home', ['successStoriesResult'=> $successStoriesResult, 'newsletterResult'=>$newsletterResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'articalesResult' => $articalesResult]);

		$this->load->view('frontend/home', ['newsletterResult' => $newsletterResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'articalesResult' => $articalesResult]);
	}


	public function aboutus()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		$headerData = array(
			'firstHeading' 		=> 'About Us',
			'secoundHeading' 	=> 'About Us'
		);

		$this->load->view('frontend/about-us', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function publicationarea()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Publication Area',
			'secoundHeading' 	=> 'Publication Area'
		);

		$this->load->view('frontend/publication-area', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function reviewerguidelines()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Reviewer Guidelines',
			'secoundHeading' 	=> 'Reviewer Guidelines'
		);

		$this->load->view('frontend/reviewer-guidelines', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function plagiarismpolicy()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Plagiarism Policy',
			'secoundHeading' 	=> 'Plagiarism Policy'
		);

		$this->load->view('frontend/plagiarism-policy', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function openaccesspolicy()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Open Access Policy',
			'secoundHeading' 	=> 'Open Access Policy'
		);

		$this->load->view('frontend/open-access-policy', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function editorialpolicy()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Editorial policy',
			'secoundHeading' 	=> 'Editorial policy'
		);

		$this->load->view('frontend/editorial-policy', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}


	public function authorguidelines()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Authors Guidelines',
			'secoundHeading' 	=> 'Authors Guidelines'
		);

		$this->load->view('frontend/author-guidelines', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function copyrightform()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Copyright Form',
			'secoundHeading' 	=> 'Copyright Form'
		);

		$this->load->view('frontend/copyright-form', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function modelmanuscript()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Model Manuscript',
			'secoundHeading' 	=> 'Model Manuscript'
		);

		$this->load->view('frontend/model-manuscript', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function checkpaperstatus()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Check Paper Status',
			'secoundHeading' 	=> 'Check Paper Status'
		);
		$statusResult = "";

		$this->load->view('frontend/check-paper-status', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'statusResult' => $statusResult]);
	}

	public function peerreviewprocess()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Peer Review Process',
			'secoundHeading' 	=> 'Peer Review Process'
		);

		$this->load->view('frontend/peer-review-process', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}
	
	

    public function pageConfig(){  
	  
       	 $config = array();
         $config["base_url"] = base_url() . "HomeController/currentissue";
         $config["total_rows"] = $this->ArticleModel->getCount(date('Y'), date('m'));
         $config["per_page"] = 12;
         $config["uri_segment"] = 3;
         $config['full_tag_open'] = '<div class="pagination-area">';
         $config['full_tag_close'] = '</div>';
         $config['num_tag_open'] = '<span class="page-numbers">';
         $config['num_tag_close'] = '</span>';
         $config['cur_tag_open'] = '<span class="page-numbers current" aria-current="page">';
         $config['cur_tag_close'] = '</span>';
        //  $config['prev_tag_open'] = '<li>';
        //  $config['prev_tag_close'] = '</li>';
        //  $config['first_tag_open'] = '<li>';
        //  $config['first_tag_close'] = '</li>';
        //  $config['last_tag_open'] = '<li>';
        //  $config['last_tag_close'] = '</li>';
         $config['prev_link'] = '<span class="page-numbers" aria-current="page"><i class="bx bx-chevrons-left"></i></span>';
        //  $config['prev_tag_open'] = ' <a href="#" class="prev page-numbers"><i class="bx bx-chevrons-left">';
        //  $config['prev_tag_close'] = '</i></a>';
         $config['next_link'] = '<span class="page-numbers" aria-current="page"><i class="bx bx-chevrons-right"></i></span>';
        //  $config['next_tag_open'] = '<a href="javascript:void(0)" class="next page-numbers"><i class="bx bx-chevrons-right">';
        //  $config['next_tag_close'] = '</i></a>';
         $this->per_page=$config["per_page"]; 
         $this->pagination->initialize($config);        
    }
    
// 	public function currentissue()
// 	{
// 		$this->pageConfig();
// 		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
// 		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
// 		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');     
// 		$offset = $page * $this->per_page;  // Calculate the correct offset
//         // $articalesResult = $this->ArticleModel->getArticalesGridNew(date('Y'), date('m'),$this->per_page, $page);
//         $articalesResult = $this->ArticleModel->getArticalesGridNew(date('Y'), date('m'), $this->per_page, $offset);
//         // print_r($articalesResult); die;
        


//         // $articalesResult = $this->ArticleModel->getArticalesGrid($config["per_page"], $page, date('Y'), date('m'));

       
//         $blogMenuResult = $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
//         $settingResult = $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
       
// 		$tempAuthor = array();
// 		$tempAuthorNames = "";

// 		$headerColData = array(
// 			"year"  => date('Y'),
// 			"month" => date('m'),
// 			"volume" => $volume = sprintf("%02d", ((idate('y') - 23) + 1))
// 		);

// 		for ($i = 0; $i < count($articalesResult); $i++) {
// 			$authorResult	= $this->CommonModel->getDataLimit('ijps_tblarticalauthor', array('isActive' => '1', 'articleID' => $articalesResult[$i]['articleID']), '', '', '', '', '', 'designationID ', 'ASC');

			

// 			if(is_array($authorResult)){
// 			for ($j = 0; $j < count($authorResult); $j++) {
// 				$articalesResult[$i]['authorImages'] = '';

// 				if ($authorResult[$j]['authorPhoto'] != "" && $authorResult[$j]['authorPhoto'] != "default.jpg") {
// 					if ((count($tempAuthor) < 3)) {
// 						$tempAuthor[] = $authorResult[$j]['authorPhoto'];
// 					}
// 				}

// 				$tempAuthorNames .= $authorResult[$j]['name'] . ", ";
// 				rtrim($tempAuthorNames, ", ");
// 			}
// 		}
// 			$articalesResult[$i]['authorImages'] = $tempAuthor;
// 			$articalesResult[$i]['authorNames'] = $tempAuthorNames;
// 			$tempAuthor = array();
// 			$tempAuthorNames = "";
// 		}

// 		$headerData = array(
// 			'firstHeading' 		=> 'Current Issue',
// 			'secoundHeading' 	=> 'Current Issue'
// 		);

// 		$this->load->view('frontend/current-issue', ['headerData' => $headerData, 'articalesResult' => $articalesResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'headerColData' => $headerColData,'pagination_links' => $this->pagination->create_links()]);
		
// 	}



public function currentissue()
{
    $this->pageConfig();
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; // This already holds the offset
    $blogMenuResult = $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
    $settingResult = $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

    $articalesResult = $this->ArticleModel->getArticalesGridNew(date('Y'), date('m'), $this->per_page, $page);

    $tempAuthor = array();
    $tempAuthorNames = "";

    $headerColData = array(
        "year"  => date('Y'),
        "month" => date('m'),
        "volume" => sprintf("%02d", ((idate('y') - 23) + 1))
    );

    for ($i = 0; $i < count($articalesResult); $i++) {
        $authorResult = $this->CommonModel->getDataLimit('ijps_tblarticalauthor', array('isActive' => '1', 'articleID' => $articalesResult[$i]['articleID']), '', '', '', '', '', 'designationID ', 'ASC');

        if (is_array($authorResult)) {
            for ($j = 0; $j < count($authorResult); $j++) {
                $articalesResult[$i]['authorImages'] = '';

                if ($authorResult[$j]['authorPhoto'] != "" && $authorResult[$j]['authorPhoto'] != "default.jpg") {
                    if ((count($tempAuthor) < 3)) {
                        $tempAuthor[] = $authorResult[$j]['authorPhoto'];
                    }
                }

                $tempAuthorNames .= $authorResult[$j]['name'] . ", ";
                rtrim($tempAuthorNames, ", ");
            }
        }
        $articalesResult[$i]['authorImages'] = $tempAuthor;
        $articalesResult[$i]['authorNames'] = $tempAuthorNames;
        $tempAuthor = array();
        $tempAuthorNames = "";
    }

    $headerData = array(
        'firstHeading' 		=> 'Current Issue',
        'secoundHeading' 	=> 'Current Issue'
    );

    $this->load->view('frontend/current-issue', [
        'headerData' => $headerData,
        'articalesResult' => $articalesResult,
        'blogMenuResult' => $blogMenuResult,
        'settingResult' => $settingResult,
        'headerColData' => $headerColData,
        'pagination_links' => $this->pagination->create_links()
    ]);
}


	public function archive()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$volumeResult	= $this->ArticleModel->getVolumeDetails();

		if (!empty($volumeResult)) {
			for ($i = 0; $i < count($volumeResult); $i++) {
				$issueResult	= $this->ArticleModel->getIssueDetails($volumeResult[$i]['year']);
				$volumeResult[$i]['issue'] = $issueResult;
			}
		}

		$headerData = array(
			'firstHeading' 		=> 'Archive',
			'secoundHeading' 	=> 'Archive'
		);

		$this->load->view('frontend/archive', ['headerData' => $headerData, 'volumeResult' => $volumeResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function editorialboard()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Editorial Members',
			'secoundHeading' 	=> 'Editorial Members'
		);

		$this->load->view('frontend/editorial-board', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function payfees()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Pay Fees',
			'secoundHeading' 	=> 'Pay Fees'
		);

		$this->load->view('frontend/pay-fees', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function blogs()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$blogCategoriesResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryID', 'ASC');

		for ($i = 0; $i < count($blogCategoriesResult); $i++) {
			$blogResult	= $this->CommonModel->getDataLimit('ijps_tblblog', array('isActive' => '1', 'blogCategoryID' => $blogCategoriesResult[$i]['blogCategoryID']), '', '', '', '', '', 'blogCategoryID', 'desc');
			//$blogResult	= $this->BlogModel->getBlogGridDataAsPerCategory($blogCategoriesResult[$i]['blogCategoryID']); 
			$blogCategoriesResult[$i]['blogData'] = $blogResult;
		}

		$headerData = array(
			'firstHeading' 		=> 'Blogs',
			'secoundHeading' 	=> 'Blogs'
		);

		$this->load->view('frontend/blogs', ['headerData' => $headerData, 'blogCategoriesResult' => $blogCategoriesResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function blogscategorywise($prop)
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$blogCategoriesResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1', 'blogCategoryID' => $prop), '', '', '', '', '', 'blogCategoryID', 'ASC');

		$thirdHeading 	= "";
		$blogResult		= "";

		if (!empty($blogCategoriesResult)) {
			$thirdHeading = $blogCategoriesResult[0]['blogCategoryName'];
			$blogResult	= $this->CommonModel->getDataLimit('ijps_tblblog', array('isActive' => '1', 'blogCategoryID' => $blogCategoriesResult[0]['blogCategoryID']), '', '', '', '', '', 'blogCategoryID', 'desc');
		}

		$headerData = array(
			'firstHeading' 		=> 'Blogs',
			'secoundHeading' 	=> 'Blogs',
			'thirdHeading' 		=> $thirdHeading
		);

		$this->load->view('frontend/blogs-categorywise', ['headerData' => $headerData, 'blogResult' => $blogResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function blogdetails($prop)
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		//$singleBlogDetailsResult	= $this->BlogModel->getBlogDetails($prop); 
		$singleBlogDetailsResult	= $this->BlogModel->getBlogDetailsByTitle(urldecode(str_replace("-", " ", $prop)));

		$blogCategoriesResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName', 'ASC');
		$recentPostResult		= $this->CommonModel->getDataLimit('ijps_tblblog', array('isActive' => '1'), '', '', '', '5', '0', 'blogID', 'desc');

		$thirdHeading = "";

		if (!empty($singleBlogDetailsResult)) {
			$thirdHeading = $singleBlogDetailsResult[0]['blogCategoryName'];
		}

		$headerData = array(
			'firstHeading' 		=> 'Blogs',
			'secoundHeading' 	=> 'Blogs',
			'thirdHeading' 		=> $thirdHeading
		);

		$this->load->view('frontend/blog-details', ['headerData' => $headerData, 'singleBlogDetailsResult' => $singleBlogDetailsResult, 'blogCategoriesResult' => $blogCategoriesResult, 'recentPostResult' => $recentPostResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function termsofservice()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Terms and Conditions',
			'secoundHeading' 	=> 'Terms and Conditions'
		);

		$this->load->view('frontend/terms-of-service', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function cancellation()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Cancellation and Refund Policy',
			'secoundHeading' 	=> 'Cancellation and Refund Policy'
		);

		$this->load->view('frontend/cancellation', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function privacy()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Privacy Policy',
			'secoundHeading' 	=> 'Privacy Policy'
		);

		$this->load->view('frontend/privacy', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}
	public function toolsForAuthor()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Tools For Authors',
			'secoundHeading' 	=> 'Tools For Authors'
		);

		$this->load->view('frontend/tools-for-author', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function article($prop)
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		//$articalResult	= $this->ArticleModel->getArticle($prop); 
		$articalResult	= $this->ArticleModel->getArticleByTitle(urldecode(str_replace("-", " ", $prop)));
        // print_r($articalResult); die;
        
        // $decodedProp = urldecode(str_replace("-", " ", $prop));
        //     $articalResult = $this->ArticleModel->getArticleByTitle($decodedProp);
            // print_r($articalResult); die;
		
// 		print_r($articalResult); die;

		$authorResult	= $this->CommonModel->getDataLimit('ijps_tblarticalauthor', array('isActive' => '1', 'articleID' => $articalResult[0]['articleID']), '', '', '', '', '', 'designationID ', 'ASC');
		$countResult	= $this->CommonModel->getDataLimit('ijps_tblarticle', array('isActive' => '1', 'articleID' => $articalResult[0]['articleID']), 'viewCount', '', '', '', '', 'articleID ', 'ASC');
		
// 		echo $articalResult[0]['viewCount'];
// 		echo 'jjjjjjjjjjjj';
		$this->CommonModel->updateRecord('ijps_tblarticle', array('viewCount' => ($countResult[0]['viewCount'] + 1)), $articalResult[0]['articleID'], 'articleID');
		$articalResult[0]['viewCount'] = ($countResult[0]['viewCount'] + 1);
// 		echo $articalResult[0]['viewCount'];
// 		die;
		
		// $articalResult['authors'] = $articalResult[0]['superscript_number'];
		$articalResult['authors'] = $authorResult;
		// echo "<pre>authoes::";print_r($articalResult);

		$tempAuthorNames = "";
		$tempAuthorNamesSup = "";
		if(is_array($authorResult)){
		for ($j = 0; $j < count($authorResult); $j++) {
			$tempAuthorNames .= $authorResult[$j]['name'] . ", ";
			rtrim($tempAuthorNames, ", ");
		}
		}
		$articalResult['authorsNameList'] = $tempAuthorNames;
		
// 		print_r($articalResult);
// 		echo $articalResult[0]['keywords'];
// 	die;
		$relatedResult = $this->ArticleModel->getRelatedArticles($articalResult[0]['titleOfPaper'], $articalResult[0]['keywords'], $articalResult[0]['articleID'],$articalResult['authorsNameList']);
// print_r($relatedResult);
// die;
		$tempAuthorNames = "";
// 		echo 'aa';
		if(is_array($relatedResult)){
		  //  echo 'bb';
		for ($i = 0; $i < count($relatedResult); $i++) {
		  //  echo 'cc';
		  //  echo count($relatedResult);
		  //  die;
			$authorResult	= $this->CommonModel->getDataLimit('ijps_tblarticalauthor', array('isActive' => '1', 'articleID' => $relatedResult[$i]['articleID']), '', '', '', '', '', 'designationID ', 'ASC');


			for ($j = 0; $j < count($authorResult); $j++) {
				$tempAuthorNames .= $authorResult[$j]['name'] . ", ";
				rtrim($tempAuthorNames, ", ");
			}
			$relatedResult[$i]['authorNames'] = $tempAuthorNames;
			$tempAuthorNames = "";
		}
		}

		$headerData = array(
			'firstHeading' 		=> 'Archive',
			'secoundHeading' 	=> 'Archive'
		);

		$this->load->view('frontend/article', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'articalResult' => $articalResult, 'relatedResult' => $relatedResult]);
	}
	
	public function pageConfigIssueDetails($prop1, $prop2, $prop3){
	   // $this->load->library('pagination');
       	 $config2 = array();
         $config2["base_url"] = base_url() . "HomeController/issuesdetails/".$prop1."/".$prop2."/".$prop3;
         $config2["total_rows"] = $this->ArticleModel->issueCount($prop1, $prop2);
         $config2["per_page"] = 300;
         $config2["uri_segment"] = 6;
         $config2['full_tag_open'] = '<div class="pagination-area">';
         $config2['full_tag_close'] = '</div>';
         $config2['num_tag_open'] = '<span class="page-numbers">';
         $config2['num_tag_close'] = '</span>';
         $config2['cur_tag_open'] = '<span class="page-numbers current" aria-current="page">';
         $config2['cur_tag_close'] = '</span>';
         $config2['prev_link'] = '<span class="page-numbers" aria-current="page"><i class="bx bx-chevrons-left"></i></span>';
         $config2['next_link'] = '<span class="page-numbers" aria-current="page"><i class="bx bx-chevrons-right"></i></span>';
         $this->per_page_issue=$config2["per_page"]; 
         $this->pagination->initialize($config2);
    }

	public function issuesdetails($prop1, $prop2, $prop3)
	{
	    $this->pageConfigIssueDetails($prop1, $prop2, $prop3);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;		
	   
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$articalesResult	= $this->ArticleModel->getArticalesGridIssueF($prop1, $prop2,$this->per_page_issue, $page);
// 		 $articalesResult = $this->ArticleModel->getArticalesGridNew(date('Y'), date('m'),$this->per_page, $page);
		$tempAuthor = array();
		$tempAuthorNames = "";

		for ($i = 0; $i < count($articalesResult); $i++) {
			$authorResult	= $this->CommonModel->getDataLimit('ijps_tblarticalauthor', array('isActive' => '1', 'articleID' => $articalesResult[$i]['articleID']), '', '', '', '', '', 'designationID ', 'ASC');


			for ($j = 0; $j < count($authorResult); $j++) {
				$articalesResult[$i]['authorImages'] = '';

				if ($authorResult[$j]['authorPhoto'] != "" && $authorResult[$j]['authorPhoto'] != "default.jpg") {
					if ((count($tempAuthor) < 3)) {
						$tempAuthor[] = $authorResult[$j]['authorPhoto'];
					}
				}

				$tempAuthorNames .= $authorResult[$j]['name'] . ", ";
				rtrim($tempAuthorNames, ", ");
			}
			$articalesResult[$i]['authorImages'] = $tempAuthor;
			$articalesResult[$i]['authorNames'] = $tempAuthorNames;
			$tempAuthor = array();
			$tempAuthorNames = "";
		}

		$headerColData = array(
			"year"  => $prop1,
			"month" => $prop2,
			"volume" => $prop3
		);

		$headerData = array(
			'firstHeading' 		=> "Vol ".$prop3.' - Issue '.$prop2,
			'secoundHeading' 	=> 'Issues'
		);

		$this->load->view('frontend/issues-details', ['headerData' => $headerData, 'articalesResult' => $articalesResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'headerColData' => $headerColData,'pagination_links' => $this->pagination->create_links()]);
	}

	public function submitmanuscript()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$articalTypeResult	= $this->CommonModel->getDataLimit('ijps_tblarticaltype', array('isActive' => '1'), '', '', '', '', '', 'articalTypeID ', 'ASC');
		$countryResult	= $this->CommonModel->getDataLimit('ijps_tblcountry', array('isActive' => '1'), '', '', '', '', '', 'countryID ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Submit Manuscript',
			'secoundHeading' 	=> 'Submit Manuscript'
		);

		$this->load->view('frontend/submit-manuscript', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'articalTypeResult' => $articalTypeResult, 'countryResult' => $countryResult]);
	}

	public function authorlogin()
	{
		//print_r($this->session->set_userdata);exit;
		if ($this->session->userdata('name') != "" || $this->session->userdata('authorMailID') != "") {
			redirect(HOME, 'refresh');
		} else {
			$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
			$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
			$headerData = array(
				'firstHeading' 		=> 'Login',
				'secoundHeading' 	=> 'Login'
			);

			$this->load->view('frontend/author-login', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
		}
	}

	function signOut()
	{
		if ($this->session->userdata('name') != "") {
			// Add activity log start
			$prop = array(
				'description'		=>  "Signout Author (authorID : " . $this->session->userdata('authorID') . " - Username : " . $this->session->userdata('username') . ")",
				'createdByUserID'   =>  $this->session->userdata['authorID']
			);
			$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
			// Add activity log end

			$this->session->sess_destroy();
		}

		redirect('login', 'refresh');
	}

	public function register()
	{
		if ($this->session->userdata('name') != "" || $this->session->userdata('authorMailID') != "") {
			redirect(HOME, 'refresh');
		} else {
			$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
			$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
			$headerData = array(
				'firstHeading' 		=> 'Register',
				'secoundHeading' 	=> 'Register'
			);

			$this->load->view('frontend/register', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
		}
	}

	public function contactus()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
		$headerData = array(
			'firstHeading' 		=> 'Contact Us',
			'secoundHeading' 	=> 'Contact Us'
		);

		$this->load->view('frontend/contact-us', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}



	public function getstatus()
	{
		if (
			$this->input->post('document_code') != ""
		) {
			$statusResult	= $this->ArticleModel->getArticleStatus(str_replace("IJPS/", '', $this->input->post('document_code')));

			if (!empty($statusResult)) {
				if ($statusResult[0]['statusID'] == 4) {
					$articleIDResult	= $this->CommonModel->getDataLimit('ijps_tblarticle', array('isActive' => '1', 'articleIDUniqueCode' => str_replace("IJPS/", '', $this->input->post('document_code'))), '', '', '', '', '', 'articleID ', 'ASC');

					if (!empty($articleIDResult)) {
						$articalResult	    = $this->ArticleModel->getArticle($articleIDResult[0]['articleID']);

						if (!empty($articalResult)) {
							$authorResult	= $this->CommonModel->getDataLimit('ijps_tblarticalauthor', array('isActive' => '1', 'articleID' => $articalResult[0]['articleID']), '', '', '', '', '', 'designationID ', 'ASC');

							if (!empty($authorResult)) {
								$tempAuthor = array();
								$tempAuthorNames = "";


								for ($j = 0; $j < count($authorResult); $j++) {
									if ($authorResult[$j]['authorPhoto'] != "" && $authorResult[$j]['authorPhoto'] != "default.jpg") {
										if ((count($tempAuthor) < 3)) {
											$tempAuthor[] = $authorResult[$j]['authorPhoto'];
										}
									}

									$tempAuthorNames .= $authorResult[$j]['name'] . ", ";
									rtrim($tempAuthorNames, ", ");
								}

								$articalResult[0]['authorImages'] = $tempAuthor;
								$articalResult[0]['authorNames'] = $tempAuthorNames;
								$tempAuthor = array();
								$tempAuthorNames = "";

								$statusResult['data'] = $articalResult;
							}
						}
					}
				}
			} else {
				$statusResult[0]['statusID'] = "";
			}


			//echo "<pre>"; print_r($statusResult); exit;
			$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
			$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
			$headerData = array(
				'firstHeading' 		=> 'Check Paper Status',
				'secoundHeading' 	=> 'Check Paper Status'
			);

			$this->load->view('frontend/check-paper-status', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'statusResult' => $statusResult]);
		} else {
			$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
			redirect(GO_CHECK_STATUS, 'refresh');
		}
	}

	public function searchdata()
	{
		//echo $this->input->post('document_code')."----"; exit;

		/*if(
				$this->input->post('document_code')!=""
			)*/

		if (
			$this->input->get('flag') != ""
		) {
			$data['flag'] = $this->input->get('flag');
			$searchArticleResult	= $this->ArticleModel->getArticleSearch($this->input->get('keywords'));

			$tempAuthor = array();
			$tempAuthorNames = "";

			for ($i = 0; $i < count($searchArticleResult); $i++) {
				$authorResult	= $this->CommonModel->getDataLimit('ijps_tblarticalauthor', array('isActive' => '1', 'articleID' => $searchArticleResult[$i]['articleID']), '', '', '', '', '', 'designationID ', 'ASC');


				for ($j = 0; $j < count($authorResult); $j++) {
					$searchArticleResult[$i]['authorImages'] = '';

					if ($authorResult[$j]['authorPhoto'] != "" && $authorResult[$j]['authorPhoto'] != "default.jpg") {
						if ((count($tempAuthor) < 3)) {
							$tempAuthor[] = $authorResult[$j]['authorPhoto'];
						}
					}

					$tempAuthorNames .= $authorResult[$j]['name'] . ", ";
					rtrim($tempAuthorNames, ", ");
				}
				$searchArticleResult[$i]['authorImages'] = $tempAuthor;
				$searchArticleResult[$i]['authorNames'] = $tempAuthorNames;
				$tempAuthor = array();
				$tempAuthorNames = "";
			}

			$data['article'] = $searchArticleResult;

			$searchBlogResult	= $this->BlogModel->getBlogSearch($this->input->get('keywords'));

			$data['blog'] = $searchBlogResult;

			$searchNewsletterResult	= $this->BlogModel->getNewsletterSearch($this->input->get('keywords'));

			$data['newsletter'] = $searchNewsletterResult;


			$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
			$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
			$headerData = array(
				'firstHeading' 		=> 'Search result',
				'secoundHeading' 	=> 'Search result'
			);
			//print_r($searchArticleResult);exit;
			$this->load->view('frontend/search', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult, 'data' => $data]);
		} else {
			$this->session->set_userdata('toastrError', 'Something will be wrong...');
			redirect(site_url(), 'refresh');
		}
	}

	public function submitsubscribe()
	{
		if (
			$this->input->post('txtEmailID') != ""
		) {

			$prop = array(
				'email'   		=>  $this->input->post('txtEmailID'),
				/*'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
			);

			$bool = $this->CommonModel->insertRecord('ijps_tblsubscriber', $prop);

			if ($bool == 1) {
				// Add activity log start
				$prop = array(
					'description'		=>  "subscriber : Added (subscriberID : " . $this->db->insert_id() . " - Email : " . $this->input->post('txtEmailID', true) . ")"
					/*'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				echo json_encode(array('status'=>'success','msg'=>'Thank you for Subscribed our newsletter!'));
				// $this->session->set_userdata('toastrSuccess', 'subscriber added successfully...');
				// redirect(GO_SUBMIT_MANUSCRIPT_INFO, 'refresh');
			} else {
				echo json_encode(array('status'=>'error','msg'=>'Please try again'));
				// $this->session->set_userdata('toastrError', 'Data was not saved!');
				// redirect(GO_SUBMIT_MANUSCRIPT_INFO, 'refresh');
			}
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Email required'));
			// $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
			// redirect(GO_SUBMIT_MANUSCRIPT_INFO, 'refresh');
		}
	}


	public function insertAuthor()
	{
	    
	    	$recaptcha = $_POST['g-recaptcha-response'];  
    	$secret_key = '6LenUIspAAAAAPSl2s-SwAvBzh4MGIo0cN7MurPC';   
    	$url = 'https://www.google.com/recaptcha/api/siteverify?secret='
          . $secret_key . '&response=' . $recaptcha;   
    	$response = file_get_contents($url);
    	$response = json_decode($response); 
		
		if ($this->input->post('txtName') != "" &&	$this->input->post('txtEmail') != "" &&	$this->input->post('txtPhone') != "" && $response->success == true) {
			$password = rand(99999, 999999);
			$username = "IJPS" . date('YmdHis');
			$email = $this->input->post('txtEmail');

			$prop = array(
				'name'   		    =>  $this->input->post('txtName'),
				'email'   	    =>  $this->input->post('txtEmail'),
				'contactNumber'		=>  $this->input->post('txtPhone'),
				'userName'   		=>  $username,
				'password'   		=>  $password
				/*'createdByUserID' =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
			);

			$bool = $this->CommonModel->insertRecord('ijps_tblauthor', $prop);

			if ($bool == 1) {
				$message = "Dear " . $this->input->post('txtName', true) . ",
								<br>Thanks for signing up!
								<br> Your <b>Username</b> is <b>" . $email . "</b>
								<br> Your <b>Password</b> is <b>" . $password . "</b>
								<br>Please Update your password.
								<br><br><b>Thanks & Regards</b>
								<br>IJPS Journal";

				//sendMail('Welcome to IJPS Journal', 'Welcome to IJPS Journal  Author Account.<br>' . $message, $this->input->post('txtEmail', true), '0', '', '');
				
				    $this->load->library('emaillib');
                    $mail = $this->emaillib->load();
                    $mail->addAddress('editor@ijpsjournal.com');
                    $mail->addAddress($this->input->post('txtEmail'));
                    $mail->Subject = 'Welcome to IJPS Journal';
                    $mail->Body ='Welcome to IJPS Journal  Author Account.<br>' . $message;
                    $mail->send();

				$this->session->set_userdata('toastrSuccess', 'Contact details send successfully...');

				// Add activity log start
				$prop = array(
					'description'		=>  "Author details : Added (authorID   : " . $this->db->insert_id() . " - Name : " . $this->input->post('name', true) . ")",
					/*'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end

				redirect('login', 'refresh');
			} else {
				$this->session->set_userdata('toastrError', 'Data was not saved!');
				redirect('login', 'refresh');
			}
		} else {
			$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
			redirect('login', 'refresh');
		}
	}

	public function insertsubmitcontactform()
	{
		if (
			$this->input->post('name') != "" &&
			$this->input->post('email') != "" &&
			$this->input->post('phone_number') != "" &&
			$this->input->post('msg_subject') != "" &&
			$this->input->post('message') != ""
		) {
			$prop = array(
				'name'   		    =>  $this->input->post('name'),
				'emailID'   	    =>  $this->input->post('email'),
				'contactNumber'		=>  $this->input->post('phone_number'),
				'subject'   		=>  $this->input->post('msg_subject'),
				'message'   		=>  $this->input->post('message'),
				/*'createdByUserID' =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
			);

			$bool = $this->CommonModel->insertRecord('ijps_tblcontactformdata', $prop);

			if ($bool == 1) {
				// $this->session->set_userdata('toastrSuccess', 'Contact details send successfully...');

				// Add activity log start
				$prop = array(
					'description'		=>  "Contact details : Added (contactFormDataID  : " . $this->db->insert_id() . " - Name : " . $this->input->post('name', true) . ")",
					/*'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				echo json_encode(array('status'=>'success','msg'=>'Thank you for contacting us!'));
				// redirect(GO_SUBMIT_CONTACT_FORM_DATA, 'refresh');
			} else {
				echo json_encode(array('status'=>'error','msg'=>'Data was not saved!'));
				// $this->session->set_userdata('toastrError', 'Data was not saved!');
				// redirect(GO_SUBMIT_CONTACT_FORM_DATA, 'refresh');
			}
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
			// $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
			// redirect(GO_SUBMIT_CONTACT_FORM_DATA, 'refresh');
		}
	}

	public function insertsubmitauthorsinfo_bk()
	{
	
		if (
			$this->input->post('txtArticleID') != "" &&
			$this->input->post('txtCorrespondingAuthorName') != "" &&
			$this->input->post('txtCorrespondingAuthorEmail') != ""
		) {
		    
		   
		    $ext = substr(strrchr($_FILES['correspondingauthor']['name'], '.'), 1);
			$allowedExtensions = array('jpg', 'jpeg', 'png');
			if (!in_array($ext, $allowedExtensions)) {
				echo json_encode(array('status' => 'error', 'msg' => 'Only image files (jpg, jpeg, png) are allowed.'));
				return;
			}
			if ($_FILES['copyrightform']['name'] == "") {
				$copyrightform = "";
			} else {
				$ext = substr(strrchr($_FILES['copyrightform']['name'], '.'), 1);
				$copyrightform = "copyrightform-" . date('YmdHis') . "." . $ext;
			}

			if ($_FILES['paymentreceipt']['name'] == "") {
				$paymentreceipt = "";
			} else {
				$ext = substr(strrchr($_FILES['paymentreceipt']['name'], '.'), 1);
				$paymentreceipt = "paymentreceipt-" . date('YmdHis') . "." . $ext;
			}

			if ($_FILES['correspondingauthor']['name'] == "") {
				$correspondingauthor = "default.jpg";
			} else {
				$ext = substr(strrchr($_FILES['correspondingauthor']['name'], '.'), 1);
				$correspondingauthor = "author-" . date('YmdHis') . "." . $ext;
			}

			$prop = array(
				'articleID'   		=>  str_replace("IJPS/", '', $this->input->post('txtArticleID')),
				'copyrightform'   	=>  $copyrightform,
				'paymentreceipt'   	=>  $paymentreceipt,
				'authorName'       	=>  $this->input->post('txtCorrespondingAuthorName'),
				'authorEmail'   	=>  $this->input->post('txtCorrespondingAuthorEmail'),
				'authorAffiliation'   	=>  $this->input->post('txtCorrespondingAffiliation'),
				'authorPhoto'  		=>  $correspondingauthor
				/*'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
			);
       
			$bool = $this->CommonModel->insertRecord('ijps_tblmanuscriptinfo', $prop);

			if ($bool == 1) {

				$lastID = $this->db->insert_id();
				if ($_FILES["copyrightform"]['name'] != "") {
					/******************************** Author Photo Upload *********************************/
					$target_file    = UPLOAD_ARTICLE . $copyrightform;

					if (move_uploaded_file($_FILES['copyrightform']['tmp_name'], $target_file)) {
					} else {
						echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
					}

					/**********  Photo Upload *********************************/
				}

				if ($_FILES["paymentreceipt"]['name'] != "") {
					/******************************** Author Photo Upload *********************************/
					$target_file    = UPLOAD_ARTICLE . $paymentreceipt;

					if (move_uploaded_file($_FILES['paymentreceipt']['tmp_name'], $target_file)) {
					} else {
						echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
					
					}

					/**********  Photo Upload *********************************/
				}

				if ($_FILES["correspondingauthor"]['name'] != "") {
					/******************************** Author Photo Upload *********************************/
							$target_file    = UPLOAD_AUTHORS . $correspondingauthor;

							$config['upload_path'] = UPLOAD_AUTHORS;
							$config['allowed_types'] = 'gif|jpg|png';
							$config['file_name'] = $correspondingauthor;
							$this->load->library('upload', $config);
							if ( ! $this->upload->do_upload('correspondingauthor'))
							{
								$dd = $this->upload->display_errors();
								print_r($dd);
							}
							else
							{
								  $image_data =   $this->upload->data();
					  
								  $configer =  array(
									'image_library'   => 'gd2',
									'source_image'    =>  $image_data['full_path'],
									'maintain_ratio'  =>  TRUE,
									'width'           =>  250,
									'height'          =>  250,
								  );
								  $this->load->library('image_lib');
								  $this->image_lib->clear();
								  $this->image_lib->initialize($configer);
								  $this->image_lib->resize();
							}
					/**********  Photo Upload *********************************/
				}

				// CoAuthors

				$coAuthorName   = $this->input->post('txtCoAuthorName');
				$coAuthorEmail  = $this->input->post('txtCoAuthorEmail');
				$coAuthorPhoto  = $this->input->post('coauthor');
				$coAuthorAffiliation = $this->input->post('txtCoAuthorAffiliation');

				if (!empty($this->input->post('txtCoAuthorName'))) {
					
					for ($i = 0; $i < count($this->input->post('txtCoAuthorName')); $i++) {
						if ($_FILES['coauthor']['name'][$i] == "") {
							$coAuthorPhotoName = "default.jpg";
						} else {
							$ext = substr(strrchr($_FILES['coauthor']['name'][$i], '.'), 1);
							$coAuthorPhotoName = "coauthor-" . date('YmdHis') . $i . "." . $ext;
						}
							$fileData = array(
								'name'     => $_FILES['coauthor']['name'][$i], 
								'type'     => $_FILES['coauthor']['type'][$i], 
								'tmp_name' => $_FILES['coauthor']['tmp_name'][$i], 
								'error'    => $_FILES['coauthor']['error'][$i], 
								'size'     => $_FILES['coauthor']['size'][$i]
							);
							
							$_FILES['coauthor_tmp'] = $fileData;
							 
							$config['upload_path']   = UPLOAD_AUTHORS; 
							$config['allowed_types'] = 'jpg|jpeg|png'; 
							$config['file_name']     = $coAuthorPhotoName;

							
							$this->load->library('upload', $config); 
							$this->upload->initialize($config); 

							
							if ($this->upload->do_upload('coauthor_tmp')) { 
								
								$uploadedFileData = $this->upload->data(); 
								$configer = array(
									'image_library'   => 'gd2',
									'source_image'    => $uploadedFileData['full_path'],
									'maintain_ratio'  => TRUE,
									'width'           => 250,
									'height'          => 250,
								);
								$this->load->library('image_lib');
								$this->image_lib->clear();
								$this->image_lib->initialize($configer);
								$this->image_lib->resize();
							} else { 
								
								$error = $this->upload->display_errors(); 
								print_r($error); 
							} 				

						
						$prop = array(
							'manuscriptInfoID'  =>  $lastID,
							'name'          	=>  $coAuthorName[$i],
							'email'   	        =>  $coAuthorEmail[$i],
							'affiliation'   	=>  $coAuthorAffiliation[$i],
							'coAuthorPhoto'		=>  	$uploadedFileData['file_name'],
							
							/*'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
						);

						$bool = $this->CommonModel->insertRecord('ijps_tblmanuscriptcoauthor', $prop);
					}
				}
				// Add activity log start
				$prop = array(
					'description'		=>  "Manuscript : Added (manuscriptID : " . $this->db->insert_id() . " - Paper Title : " . $this->input->post('txtPaperTitle', true) . ")"
					/*'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				echo json_encode(array('status'=>'success','msg'=>'Your manuscript has been submitted'));
			} else {
				echo json_encode(array('status'=>'error','msg'=>'Data was not saved!'));
			}
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
		}
	}
	
	public function insertsubmitauthorsinfo()
    {
    if (
        $this->input->post('txtArticleID') != "" &&
        $this->input->post('txtCorrespondingAuthorName') != "" &&
        $this->input->post('txtCorrespondingAuthorEmail') != ""
    ) {
        // Process main author's files
        // $correspondingauthor = $this->uploadFile('correspondingauthor', 'author-', UPLOAD_AUTHORS);
        $correspondingauthor = $this->uploadFilImge('correspondingauthor', 'author-', UPLOAD_AUTHORS);
        $paymentreceipt = $this->uploadFile('paymentreceipt', 'paymentreceipt-', UPLOAD_ARTICLE);
        $copyrightform = $this->uploadFile('copyrightform', 'copyrightform-', UPLOAD_ARTICLE);

        $prop = array(
            'articleID' => str_replace("IJPS/", '', $this->input->post('txtArticleID')),
            'copyrightform' => $copyrightform,
            'paymentreceipt' => $paymentreceipt,
            'authorName' => $this->input->post('txtCorrespondingAuthorName'),
            'authorEmail' => $this->input->post('txtCorrespondingAuthorEmail'),
            'authorAffiliation' => $this->input->post('txtCorrespondingAffiliation'),
            'authorPhoto' => $correspondingauthor
        );

        $bool = $this->CommonModel->insertRecord('ijps_tblmanuscriptinfo', $prop);

        if ($bool == 1) {
            $lastID = $this->db->insert_id();

            // Process co-authors
            $coAuthorName = $this->input->post('txtCoAuthorName');
            $coAuthorEmail = $this->input->post('txtCoAuthorEmail');
            $coAuthorAffiliation = $this->input->post('txtCoAuthorAffiliation');
            $coAuthorPhotos = $_FILES['coauthor'];

            foreach ($coAuthorName as $index => $name) {
                $coAuthorPhotoName = !empty($coAuthorPhotos['name'][$index]) ?
                    $this->uploadFile('coauthor', 'coauthor-' . date('YmdHis') . $index . '.', UPLOAD_AUTHORS, $index) :
                    'default.jpg';

                $prop = array(
                    'manuscriptInfoID' => $lastID,
                    'name' => $name,
                    'email' => $coAuthorEmail[$index],
                    'affiliation' => $coAuthorAffiliation[$index],
                    'coAuthorPhoto' => $coAuthorPhotoName
                );

                $bool = $this->CommonModel->insertRecord('ijps_tblmanuscriptcoauthor', $prop);

                if (!$bool) {
                    echo json_encode(array('status'=>'error','msg'=>'Please try again...'));
                }
            }

            // Add activity log
            $prop = array(
                'description' => "Manuscript : Added (manuscriptID : " . $lastID . " - Paper Title : " . $this->input->post('txtPaperTitle', true) . ")"
            );
            $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);

			echo json_encode(array('status'=>'success','msg'=>'Your manuscript has been submitted'));
        } else {
            echo json_encode(array('status'=>'error','msg'=>'Data was not saved!'));
        }
    } else {
		echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
    }
}

  private function uploadFilImge($fieldName, $prefix, $uploadPath, $index = null)
    {
        if (!isset($_FILES[$fieldName])) return "default.jpg";
    
        $file = isset($index) ? $_FILES[$fieldName]['name'][$index] : $_FILES[$fieldName]['name'];
        if (empty($file)) return "default.jpg";
    
        $allowedTypes = array('image/jpg', 'image/jpeg','image/png', 'image/gif');
    
        // Check if the file type is allowed
        $fileType = isset($index) ? $_FILES[$fieldName]['type'][$index] : $_FILES[$fieldName]['type'];
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode(array('status'=>'error','msg'=>'Only png/jpg/jpeg files are allowed in Passport Photo fields')); die;
            // return "default.jpg";
        }
    
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $fileName = $prefix . date('YmdHis') . (isset($index) ? $index : "") . "." . $ext;
        $target_file = $uploadPath . $fileName;
    
        if (move_uploaded_file(isset($index) ? $_FILES[$fieldName]['tmp_name'][$index] : $_FILES[$fieldName]['tmp_name'], $target_file)) {
            return $fileName;
        } else {
            echo json_encode(array('status'=>'error','msg'=>'Image could not be uploaded.'));die;
            
        }
    }

    private function uploadFile($fieldName, $prefix, $uploadPath, $index = null)
    {
        if (!isset($_FILES[$fieldName])) return "default.jpg";
    
        $file = isset($index) ? $_FILES[$fieldName]['name'][$index] : $_FILES[$fieldName]['name'];
        if (empty($file)) return "default.jpg";
    
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $fileName = $prefix . date('YmdHis') . (isset($index) ? $index : "") . "." . $ext;
        $target_file = $uploadPath . $fileName;
    
        if (move_uploaded_file(isset($index) ? $_FILES[$fieldName]['tmp_name'][$index] : $_FILES[$fieldName]['tmp_name'], $target_file)) {
            return $fileName;
        } else {
            echo json_encode(array('status'=>'error','msg'=>'image not loading...'));
        }
    }
	public function resizeImage($filename)
	{
	   $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename;
	   $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
				// Load the library
			$this->load->library('image_lib');

			// Configuration for image manipulation
			$config['image_library'] = 'imagemagick'; // Use ImageMagick library
			$config['source_image'] = './uploads/'.$filename; // Path to your source image
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100; // New width
			$config['height'] = 100; // New height

			// Initialize the image manipulation
			$this->image_lib->initialize($config);

			// Resize the image
			if (!$this->image_lib->resize()) {
				echo $this->image_lib->display_errors();
			}

			// Clear any previous configurations
			$this->image_lib->clear();

	}
	public function insertManuscript()
	{
	
		if (
			$this->input->post('txtAuthorName') != "" &&
			$this->input->post('txtPaperTitle') != "" &&
			$this->input->post('cmbArticalTypeID') != "" &&
			$this->input->post('txtEmail') != "" &&
			$this->input->post('txtContact') != "" &&
			$this->input->post('cmbCountryID') != ""
		) {
		    
		    $ext = substr(strrchr($_FILES['file']['name'], '.'), 1);
    		$allowedExtensions = array('doc', 'docx');
    		if (!in_array(strtolower($ext), $allowedExtensions)) {
    			echo json_encode(array('status' => 'error', 'msg' => 'Only Word documents (.doc, .docx) are allowed.'));
    			return;
    		}
			if ($_FILES['file']['name'] == "") {
				$manuscriptImage = "";
			} else {
				$ext = substr(strrchr($_FILES['file']['name'], '.'), 1);
				$manuscriptImage = "manuscript-" . date('YmdHis') . "." . $ext;
			}
			$condition = "isActive = 1 AND MONTH(createdDate) = MONTH(CURRENT_DATE()) AND YEAR(createdDate) = YEAR(CURRENT_DATE())";
			$manuscriptCount	= $this->CommonModel->getDataLimit('ijps_tblmanuscript', $condition, 'count(manuscriptID) as countR', '', '', '', '', '', '');
            

			$volume = sprintf("%02d", ((idate('y') - 23) + 1));


// 			$uniqueCode = date('y') . "" . $volume . "" . date('m') . "" . ($manuscriptCount[0]['countR'] + 1);
            $uniqueCode =  $this->CommonModel->generate_articleID('ijps_tblmanuscript',$volume);

			
			$prop = array(
				'authorName'   		=>  $this->input->post('txtAuthorName'),
				'email'   		    =>  $this->input->post('txtEmail'),
				'contactNumber'   	=>  $this->input->post('txtContact'),
				'titleOfPaper'   	=>  $this->input->post('txtPaperTitle'),
				'document'   		=>  $manuscriptImage,
				'articalTypeID'		=>  $this->input->post('cmbArticalTypeID'),
				'countryID'   		=>  $this->input->post('cmbCountryID'),
				'statusID'			=>  '1',
				'uniqueCode'		=>  $uniqueCode,
				'created_date' => date('d-m-Y H:i:s'),
				/*'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
			);

			$bool = $this->CommonModel->insertRecord('ijps_tblmanuscript', $prop);

			if ($bool == 1) {
				$ext = substr(strrchr($_FILES['file']['name'], '.'), 1);
				$allowedExtensions = array('doc', 'docx');
				if (!in_array(strtolower($ext), $allowedExtensions)) {
					echo json_encode(array('status' => 'error', 'msg' => 'Only Word documents (.doc, .docx) are allowed.'));
					return;
				}
				$subject = "Acknowledgement of receiving of Manuscript"; //(Paper_id : IJPS/".$this->input->post('txtArticleID').")";
				$message = "<div id='m_-811177307910776471ydp41863206yiv7747682938'>
                                        <div>
                                            <b style='font-size: 11pt;'>
                                                <span style='color: rgb(32, 56, 100);'><font face='times new roman, serif' style='background-color: inherit;'>Dear&nbsp;Author/Researcher,</font></span>
                                            </b>
                                            <br /><br />
                                        </div>
                                        <div>
                                            <div>
                                                <div dir='ltr'>
                                                    <div>
                                                        <div dir='ltr'>
                                                            <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                                <font face='times new roman, serif'>
                                                                    <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                        We are informing you that your manuscript,
                                                                </font>
                                                                &nbsp;<b><font face='times new roman, serif' color='#073763'>'</font></b>
                                                                <font face='times new roman, serif'>
                                                                    <font color='#073763'>
                                                                        <b><span lang='EN-US'>" . strtoupper($this->input->post('txtPaperTitle')) . "</span></b>
                                                                        <b><span style='line-height: 15.6933px;'>'</span><span style='line-height: 15.6933px;'>&nbsp;</span></b>
                                                                    </font>
                                                                   
                                                                </font>
                                                                <span style='font-family: Arial, sans-serif; font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>.</span>
                                                                has been received and we have started working on it. Soon you will get a favourable reply from our side. Keep in touch.
                                                            </p>
                                                            
                                                            <p style='margin-bottom: 12pt;'>
                                                                <font size='4'>
                                                                    <span style='font-family: Garamond, serif;'>Manuscript ID :</span>
                                                                    <font color='#073763'>
                                                                        <b style='font-family: Calibri, sans-serif;'><span style='font-family: Garamond, serif;'>&nbsp;</span></b>
                                                                        <b style='font-family: Calibri, sans-serif;'><span style='font-family: Garamond, serif;'>IJPS/" . $uniqueCode . "</span></b>
                                                                    </font>
                                                                </font>
                                                                <b style='font-size: large; font-family: Calibri, sans-serif;'>
                                                                    <span style='font-family: Garamond, serif;'><font color='#073763' style='background-color: inherit;'></font></span>
                                                                </b>
                                                            </p>
                                                            <p style='margin: 0cm 0cm 6pt; line-height: normal;'>
                                                                            <font face='arial, sans-serif' color='#073763'>
                                                                                We value your support to our journal and Thank you for considering this journal as a venue for your work. If you have any questions, please do not hesitate to contact us.
                                                                            </font>
                                                                        </p>
                                                                        <div>
                                                                            <p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <span style='font-family: Tahoma, sans-serif; color: rgb(49, 132, 155);'>
                                                                                    ------------------------------<wbr />------------------------------<wbr />------------------------------<wbr />------------------------
                                                                                </span>
                                                                            </p>
                                                                            <p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <font color='#666666'>
                                                                                    <span lang='EN-SG'>If you would like to receive&nbsp;<b>IJPS updates</b>, you may follow us on&nbsp;<b>Facebook</b>&nbsp;</span>
                                                                                    <a
                                                                                        href='https://www.facebook.com/International-Journal-in-Pharmaceutical-Sciences-106918958461959'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=https://www.facebook.com/International-Journal-in-Pharmaceutical-Sciences-106918958461959&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw0P9y2uY6lFKNSTIuAD6bZM'
                                                                                    >
                                                                                        <span lang='EN-SG'></span>
                                                                                    </a>
                                                                                    <a
                                                                                        href='http://www.facebook.com/IJPS'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://www.facebook.com/IJPS&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2IctN0SzM8Huv5guEENFwR'
                                                                                    >
                                                                                        http://www.<wbr />facebook.com/IJPS
                                                                                    </a>
                                                                                    <span lang='EN-SG'>,&nbsp;<b>Twitter&nbsp;</b></span>
                                                                                    <a
                                                                                        href='https://twitter.com/ijps_journal'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=https://twitter.com/ijps_journal&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2DFdTWxJJLvhHdGg9xQaIW'
                                                                                    >
                                                                                        <span lang='EN-SG'></span>
                                                                                    </a>
                                                                                    <a
                                                                                        href='http://twitter.com/IJPS'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://twitter.com/IJPS&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2BFX6y8rI2QHALezinWjKj'
                                                                                    >
                                                                                        htt<wbr />p://twitter.com/IJPS
                                                                                    </a>
                                                                                    <b><span lang='EN-SG'>&nbsp;</span></b>
                                                                                    <span lang='EN-SG'>
                                                                                        and&nbsp;<b>Linke<wbr />d in&nbsp;</b>
                                                                                    </span>
                                                                                    <a
                                                                                        href='http://linkedin.com/in/ijps-journal-036840221'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://linkedin.com/in/ijps-journal-036840221&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw3q3JCR5FyvtM9KKylhQ9jC'
                                                                                    >
                                                                                        <span lang='EN-SG'></span>
                                                                                    </a>
                                                                                    <a
                                                                                        href='http://linkedin.com/in/ijps-journal-036840221'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://linkedin.com/in/ijps-journal-036840221&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw3q3JCR5FyvtM9KKylhQ9jC'
                                                                                    >
                                                                                        linkedin.com/in/ijps-<wbr />journal-036840221
                                                                                    </a>
                                                                                </font>
                                                                            </p>
                                                            <div dir='ltr'>
                                                                <div dir='ltr'>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                        <p style='margin:0px;'>
                                                                            <b><span lang='EN-SG' style='color: rgb(31, 73, 125);'>Regards,</span></b>
                                                                        </p>
                                                                        <p  style='margin:0px;'><span style='color: rgb(31, 73, 125);'>Editor-In-Chief</span></p>
                                                                        <img src='" . site_url('assetsbackoffice/images/favicon.png') . "' style='width:70px;'>
                                                                    </div>
                                                                    <div style='color: rgb(34, 34, 34);'><span style='color: rgb(31, 73, 125);'>International Journal of Pharmaceutical Sciences (IJPS)</span></div>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                        <p  style='margin:0px;'>
                                                                            <span style='color: rgb(31, 73, 125);'>
                                                                                E-mail:&nbsp;
                                                                                <a href='mailto:editor@ijpsjournal.com' style='color: rgb(17, 85, 204);' rel='noreferrer noopener' target='_blank'><span style='color: rgb(5, 99, 193);'>editor@ijpsjournal.com</span></a>
                                                                            </span>
                                                                        </p>
                                                                        <p  style='margin:0px;'>
                                                                            <span style='color: rgb(31, 73, 125);'>Website:&nbsp;&nbsp;</span>
                                                                            <a
                                                                                href='http://www.ijpsjournal.com/'
                                                                                style='color: rgb(17, 85, 204);'
                                                                                rel='noreferrer noopener'
                                                                                target='_blank'
                                                                                data-saferedirecturl='https://www.google.com/url?q=http://www.ijpsjournal.com/&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw1CHQkkeVsJQ9ZBdvlfwfLN'
                                                                            >
                                                                                <span style='color: rgb(5, 99, 193);'>www.ijpsjournal.com</span>
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br />
                                                        </div>
                                                    </div>
                                                    <br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
			//sendMail($subject, $message, $this->input->post('txtEmail'), '0', '', '');
				
				    $this->load->library('emaillib');
                    $mail = $this->emaillib->load();
                    $mail->addAddress('editor@ijpsjournal.com');
                    $mail->addAddress($this->input->post('txtEmail'));
                    $mail->Subject = $subject;
                    $mail->Body =$message;
                    $mail->send();

				echo json_encode(array('status'=>'success','msg'=>'Details submitted successfully'));
				// $this->session->set_userdata('toastrSuccess', 'Your manuscript has been submitted');
				if ($_FILES["file"]["name"] != "") {
					/******************************** Author Photo Upload *********************************/
					$target_file    = UPLOAD_MANUSCRIPT . $manuscriptImage;

					if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
					} else {

						echo json_encode(array('status'=>'error','msg'=>'Problem uploading image...'));
						// $this->session->set_userdata('toastrError', 'Problem uploading image...');
						// redirect(GO_SUBMIT_MANUSCRIPT, 'refresh');
					}

					/**********  Photo Upload *********************************/
				}

				// Add activity log start
				$prop = array(
					'description'		=>  "Manuscript : Added (manuscriptID : " . $this->db->insert_id() . " - Paper Title : " . $this->input->post('txtPaperTitle', true) . ")",
					/*'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)*/
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end


				redirect(GO_SUBMIT_MANUSCRIPT, 'refresh');
			} else {
				echo json_encode(array('status'=>'error','msg'=>'Data was not saved!'));
				// $this->session->set_userdata('toastrError', 'Data was not saved!');
				// redirect(GO_SUBMIT_MANUSCRIPT, 'refresh');
			}
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
			// $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
			// redirect(GO_SUBMIT_MANUSCRIPT, 'refresh');
		}
	}



	public function newsletters()
	{
		$newsletterResult	= $this->CommonModel->getDataLimit('ijps_tblnewsletter', array('isActive' => '1'), '', '', '', '', '', 'newsletterID', 'DESC');
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		$headerData = array(
			'firstHeading' 		=> 'Newsletters',
			'secoundHeading' 	=> 'Newsletters',
		);

		$this->load->view('frontend/newsletter', ['headerData' => $headerData, 'newsletterResult' => $newsletterResult, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}


	public function submitauthorsinfo()
	{
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		$headerData = array(
			'firstHeading' 		=> 'Authors info',
			'secoundHeading' 	=> 'Authors info'
		);

		$this->load->view('frontend/submit-authors-info', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}


	public function index2()
	{
		$this->load->view('frontend/index2');
	}


	public function successstories()
	{
		$successStoriesResult	= $this->CommonModel->getDataLimit('tblhappystory', array('isActive' => '1'), '', '', '', '', '', 'happyStoryID', 'desc');
		$this->load->view('frontend/successstories', ['successStoriesResult' => $successStoriesResult]);
	}

	public function successstorydetails($happyStoryID)
	{
		$successStoryResult	= $this->CommonModel->getData('tblhappystory', array('isActive' => '1', 'happyStoryID' => $happyStoryID), '',	'', '');
		//print_r($successStoryResult);exit;
		if (!empty($successStoryResult)) {
			$this->load->view('frontend/successstorydetails', ['successStoryResult' => $successStoryResult]);
		} else {
			$this->session->set_userdata('toastrError', 'Something went wrong');
			redirect(HOME, 'refresh');
		}
	}

	public function faq()
	{
		$this->load->view('frontend/faq');
	}

	public function termsandconditions()
	{
		$this->load->view('frontend/termsandconditions');
	}

	public function privacypolicy()
	{
		$this->load->view('frontend/privacypolicy');
	}

	public function horoscope()
	{
		$this->load->view('frontend/horoscope');
	}

	public function listing()
	{
		/*if(empty($_SESSION['total_rows']) || empty($_SESSION['per_page']) || empty($_SESSION['total_pages']))
			{*/
		$_SESSION['total_rows'] = $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID != " . $this->session->userdata('genderID'), '', '', 'num_rows', '', '', 'profileID', 'desc');
		$_SESSION['per_page'] = 10;
		$_SESSION['total_pages'] = ceil($_SESSION['total_rows'] / $_SESSION['per_page']) - 1;
		//}

		$page = $this->uri->segment(2) ? $this->uri->segment(2) : 0;
		$offset = $page * 10;

		$profilesResult	= $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID != " . $this->session->userdata('genderID'), "ROUND(DATEDIFF(CURDATE(), dateOf‎Birth) / 365) AS age, CONCAT('AW', LPAD(profileID, 6, '0')) AS profileCode, tblprofile.*", '', '', $_SESSION['per_page'], $offset, 'profileID', 'desc');

		$URLResult = "listing";
		//echo $this->session->userdata('genderID')."-"; print_r($profilesResult);exit;
		//$profilesResult['pagination'] = $this->pagination->create_links();
		$this->load->view('frontend/listing', ['profilesResult' => $profilesResult, 'URLResult' => $URLResult]);
	}

	public function bridelisting()
	{
		$_SESSION['total_rows'] = $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID ='2' AND maritalStatusID ='1'", '', '', 'num_rows', '', '', 'profileID', 'desc');
		$_SESSION['per_page'] = 10;
		$_SESSION['total_pages'] = ceil($_SESSION['total_rows'] / $_SESSION['per_page']) - 1;

		$page = $this->uri->segment(2) ? $this->uri->segment(2) : 0;
		$offset = $page * 10;

		$profilesResult	= $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID = 2 AND maritalStatusID ='1'", "ROUND(DATEDIFF(CURDATE(), dateOf‎Birth) / 365) AS age, CONCAT('AW', LPAD(profileID, 6, '0')) AS profileCode, tblprofile.*", '', '', $_SESSION['per_page'], $offset, 'profileID', 'desc');

		$URLResult = "bride";

		$this->load->view('frontend/listing', ['profilesResult' => $profilesResult, 'URLResult' => $URLResult]);
	}

	public function groomlisting()
	{
		$_SESSION['total_rows'] = $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID ='1' AND maritalStatusID ='1'", '', '', 'num_rows', '', '', 'profileID', 'desc');
		$_SESSION['per_page'] = 10;
		$_SESSION['total_pages'] = ceil($_SESSION['total_rows'] / $_SESSION['per_page']) - 1;

		$page = $this->uri->segment(2) ? $this->uri->segment(2) : 0;
		$offset = $page * 10;

		$profilesResult	= $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID = 1 AND maritalStatusID ='1'", "ROUND(DATEDIFF(CURDATE(), dateOf‎Birth) / 365) AS age, CONCAT('AW', LPAD(profileID, 6, '0')) AS profileCode, tblprofile.*", '', '', $_SESSION['per_page'], $offset, 'profileID', 'desc');

		$URLResult = "groom";

		$this->load->view('frontend/listing', ['profilesResult' => $profilesResult, 'URLResult' => $URLResult]);
	}

	public function divorcedwidowedbridelisting()
	{
		$_SESSION['total_rows'] = $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID ='2' AND (maritalStatusID ='2' || maritalStatusID ='3')", '', '', 'num_rows', '', '', 'profileID', 'desc');
		$_SESSION['per_page'] = 10;
		$_SESSION['total_pages'] = ceil($_SESSION['total_rows'] / $_SESSION['per_page']) - 1;

		$page = $this->uri->segment(2) ? $this->uri->segment(2) : 0;
		$offset = $page * 10;

		$profilesResult	= $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID = 2  AND (maritalStatusID ='2' || maritalStatusID ='3')", "ROUND(DATEDIFF(CURDATE(), dateOf‎Birth) / 365) AS age, CONCAT('AW', LPAD(profileID, 6, '0')) AS profileCode, tblprofile.*", '', '', $_SESSION['per_page'], $offset, 'profileID', 'desc');

		$URLResult = "bride";

		$this->load->view('frontend/listing', ['profilesResult' => $profilesResult, 'URLResult' => $URLResult]);
	}

	public function divorcedwidowgroomlisting()
	{
		$_SESSION['total_rows'] = $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID ='1' AND (maritalStatusID ='2' || maritalStatusID ='3')", '', '', 'num_rows', '', '', 'profileID', 'desc');
		$_SESSION['per_page'] = 10;
		$_SESSION['total_pages'] = ceil($_SESSION['total_rows'] / $_SESSION['per_page']) - 1;

		$page = $this->uri->segment(2) ? $this->uri->segment(2) : 0;
		$offset = $page * 10;

		$profilesResult	= $this->CommonModel->getDataLimit('tblprofile', "isActive ='1' AND genderID = 1 AND (maritalStatusID ='2' || maritalStatusID ='3')", "ROUND(DATEDIFF(CURDATE(), dateOf‎Birth) / 365) AS age, CONCAT('AW', LPAD(profileID, 6, '0')) AS profileCode, tblprofile.*", '', '', $_SESSION['per_page'], $offset, 'profileID', 'desc');

		$URLResult = "groom";

		$this->load->view('frontend/listing', ['profilesResult' => $profilesResult, 'URLResult' => $URLResult]);
	}


	public function fullprofile($profileID)
	{
		if ($this->session->userdata('profileFullName') != "" && $this->session->userdata('profileMailID') != "") {
			$profileResult	= $this->CommonModel->getData('tblprofile', array('isActive' => '1', 'profileID' => $profileID), "ROUND(DATEDIFF(CURDATE(), dateOf‎Birth) / 365) AS age, CONCAT('AW', LPAD(profileID, 6, '0')) AS profileCode, tblprofile.*", '', '');

			if (!empty($profileResult)) {
				$this->load->view('frontend/fullprofile', ['profileResult' => $profileResult]);
			} else {
				$this->session->set_userdata('toastrError', 'Something went wrong');
				redirect(HOME, 'refresh');
			}
		} else {
			redirect(login, 'refresh');
		}
	}




	public function changepassword()
	{

		if ($this->session->userdata('profileFullName') != "" && $this->session->userdata('profileMailID') != "") {
			$this->load->view('frontend/changepassword');
		} else {
			redirect(HOME, 'refresh');
		}
	}

	public function forgetpassword()
	{
		if ($this->session->userdata('profileFullName') == "" && $this->session->userdata('profileMailID') == "") {
			$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		$headerData = array(
			'firstHeading' 		=> 'Forgot Password',
			'secoundHeading' 	=> 'Forgot Password'
		);

		$this->load->view('frontend/forgot_password', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
		
		
		} else {
			redirect(HOME, 'refresh');
		}
		//  if ($this->session->userdata('profileFullName') == "" && $this->session->userdata('profileMailID') == "") {
		// 	$this->load->view('frontend/forgot_password');
		// } else {
		//  	redirect(HOME, 'refresh');
		//  }
	}
	public function forgot_pass()
	{
	if($this->input->post('email'))
		{
			$email=$this->input->post('email');
			$que=$this->db->query("select password,email from ijps_tblauthor where email='".$email."' order by authorID desc limit 1" );
			$row=$que->row();
			if(!empty($row)){
				$user_email=$row->email;
				if((!strcmp($email, $user_email))){
					$pass=$row->password;
					$subject = "New Password";
					$msg = "Your password is $pass .";
					//sendMail($subject, $msg, $email, '0','','');
					
					$this->load->library('emaillib');
                    $mail = $this->emaillib->load();
                    $mail->addAddress('editor@ijpsjournal.com');
                    $mail->addAddress($email);
                    $mail->Subject = $subject;
                    $mail->Body =$msg;
                    $mail->send();
					echo json_encode(array('status'=>'success','msg'=>'Please check your email.'));
					}
				else{
					echo json_encode(array('status'=>'error','msg'=>'Enter correct  email.'));
				}
			}else{
				echo json_encode(array('status'=>'error','msg'=>'Email not found in database.'));
			}
		}
   }

	public function notification()
	{
		if ($this->session->userdata('profileFullName') != "" && $this->session->userdata('profileMailID') != "") {
			$this->load->view('frontend/notification');
		} else {
			redirect(HOME, 'refresh');
		}
	}

	public function registration()
	{
		if ($this->session->userdata('profileFullName') == "" && $this->session->userdata('profileMailID') == "") {
			$behalfOfResult	= $this->CommonModel->getData('tblbehalfof', array('isActive' => '1'), '', '', '');
			$genderResult	= $this->CommonModel->getData('tblgender', array('isActive' => '1'), '', '', '');

			$this->load->view('frontend/registration', ['behalfOfResult' => $behalfOfResult, 'genderResult' => $genderResult]);
		} else {
			redirect(HOME, 'refresh');
		}
	}

	public function profileregistration()
	{
		if ($this->session->userdata('profileFullName') == "" && $this->session->userdata('profileMailID') == "") {
			if (
				$this->input->post('txtFirstName') &&
				$this->input->post('txtLastName') &&
				$this->input->post('cmbGender') &&
				$this->input->post('txtEmail') &&
				$this->input->post('dtpDateOfBirth') &&
				$this->input->post('txtMobile') &&
				$this->input->post('cmbOnBehalf') &&
				$this->input->post('txtPassword') &&
				$this->input->post('txtConfirmPassword') &&
				$this->input->post('rbtnAccept') != ""
			) {
				if (!empty($this->input->post('dtpDateOfBirth'))) {
					$dtpDateOfBirth   = strtotime(date($this->input->post('dtpDateOfBirth')));
					$dtpDateOfBirth   = date("Y-m-d", $dtpDateOfBirth);
				} else {
					$dtpDateOfBirth   = "0000-00-00";
				}

				$prop = array(
					'firstName'         =>  $this->input->post('txtFirstName'),
					'lastName'     	=>  $this->input->post('txtLastName'),
					'genderID'       =>  $this->input->post('cmbGender'),
					'emailAddress'		=>  $this->input->post('txtEmail'),
					'dateOfBirth'  		=>  $dtpDateOfBirth,
					'contactNumber'     =>  $this->input->post('txtMobile'),
					'onBehalfID'        =>  $this->input->post('cmbOnBehalf'),
					'userName'			=>  $this->input->post('txtEmail'),
					'password'			=>  $this->input->post('txtPassword'),
					'acceptFlag'			=>  $this->input->post('rbtnAccept'),
					'createdByUserID'   =>  '1'
				);

				$bool = $this->CommonModel->insertRecord('tblprofile', $prop);

				if ($bool == 1) {
					// Add activity log start
					$prop = array(
						'description'		=>  "Profile : Uploaded (profileID : " . $this->session->userdata('profileID') . " - activityLogID : " . $this->db->insert_id() . ")",
						'createdByUserID'   =>  '1', //$this->session->userdata['profileID'],
						'applicationFlag'   =>  '1'
					);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end

					$this->session->set_userdata('toastrSuccess', ' Profile created successfully...');
					redirect(HOME, 'refresh');
				} else {
					$this->session->set_userdata('toastrError', 'Data was not saved!');
					redirect("registration", 'refresh');
				}
			} else {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect("registration", 'refresh');
			}
		} else {
			redirect(HOME, 'refresh');
		}
	}


	public function updateprofile()
	{
		$profileResult		= $this->CommonModel->getData('tblprofile', array('isActive' => '1', 'profileID' => $this->session->userdata('profileID')), '', '', '');
		$behalfOfResult		= $this->CommonModel->getData('tblbehalfof', array('isActive' => '1'), '', '', '');
		$genderResult		= $this->CommonModel->getData('tblgender', array('isActive' => '1'), '', '', '');

		$religionResult		= $this->CommonModel->getData('tblreligion', array('isActive' => '1'), '', '', '');
		$motherTongueResult	= $this->CommonModel->getData('tblmothertongue', array('isActive' => '1'), '', '', '');
		$maritalStatusResult	= $this->CommonModel->getData('tblmaritalstatus', array('isActive' => '1'), '', '', '');

		if (!empty($profileResult)) {
			$this->load->view('frontend/updateprofile', [
				'profileResult' => $profileResult,
				'behalfOfResult' => $behalfOfResult,
				'genderResult' => $genderResult,
				'religionResult' => $religionResult,
				'motherTongueResult' => $motherTongueResult,
				'maritalStatusResult' => $maritalStatusResult
			]);
		} else {
			$this->session->set_userdata('toastrError', 'Something went wrong');
			redirect(HOME, 'refresh');
		}
	}

	public function updateprofilesubmit()
	{
		if (
			$this->input->post('txtFirstName') &&
			$this->input->post('txtMiddleName') &&
			$this->input->post('txtLastName') &&
			$this->input->post('cmbGender') &&
			$this->input->post('txtEmail') &&
			$this->input->post('dtpDateOfBirth') &&
			$this->input->post('txtMobile') &&
			$this->input->post('txtIntroduction') &&
			$this->input->post('cmbOnBehalf') &&
			$this->input->post('cmbReligionID') &&
			$this->input->post('cmbMotherTongue') &&
			$this->input->post('cmbMaritalStatus')
		) {
			if (!empty($this->input->post('dtpDateOfBirth'))) {
				$dtpDateOfBirth   = strtotime(date($this->input->post('dtpDateOfBirth')));
				$dtpDateOfBirth   = date("Y-m-d", $dtpDateOfBirth);
			} else {
				$dtpDateOfBirth   = "0000-00-00";
			}

			$prop = array(
				'firstName'         =>  $this->input->post('txtFirstName'),
				'middleName'     	=>  $this->input->post('txtMiddleName'),
				'lastName'     		=>  $this->input->post('txtLastName'),
				'genderID'       	=>  $this->input->post('cmbGender'),
				'emailAddress'		=>  $this->input->post('txtEmail'),
				'dateOf‎Birth'  		=>  $dtpDateOfBirth,
				'contactNumber'     =>  $this->input->post('txtMobile'),
				'introduction'     	=>  $this->input->post('txtIntroduction'),
				'onBehalfID'        =>  $this->input->post('cmbOnBehalf'),
				'religionID'		=>  $this->input->post('cmbReligionID'),
				'motherTongueID'	=>  $this->input->post('cmbMotherTongue'),
				'maritalStatusID'	=>  $this->input->post('cmbMaritalStatus'),
				'updatedByUserID'   =>  $this->session->userdata('profileID')
			);

			$bool = $this->CommonModel->updateRecord('tblprofile', $prop, $this->session->userdata('profileID'), 'profileID');

			if ($bool == 1) {
				// Add activity log start
				$prop = array(
					'description'		=>  "Profile : Uploaded (profileID : " . $this->session->userdata('profileID') . " - activityLogID : " . $this->db->insert_id() . ")",
					'createdByUserID'   =>  '1', //$this->session->userdata['profileID'],
					'applicationFlag'   =>  '1'
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end

				$this->session->set_userdata('toastrSuccess', ' Profile created successfully...');
				redirect(HOME, 'refresh');
			} else {
				$this->session->set_userdata('toastrError', 'Data was not saved!');
				redirect("updateprofile", 'refresh');
			}
		} else {
			$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
			redirect("updateprofile", 'refresh');
		}
	}
















	public function index1111()
	{

		$emergencyContactCategoryCount	= $this->CommonModel->getData('tblemergencycontactcategory', array('isActive' => '1'), '', '', 'num_rows');
		$emergencyContactCategoryResult	= $this->CommonModel->getDataLimit('tblemergencycontactcategory', array('isActive' => '1'), '', '', '', '2', '0', 'emergencycontactcategoryID', 'asc');

		//$this->CommonModel->getData('tblemergencycontactcategory',array('isActive'=>'1'),'','','');
		$emergencyContactResult	= array();

		for ($i = 0; $i < count($emergencyContactCategoryResult); $i++) {
			$emergencyContactResult[$emergencyContactCategoryResult[$i]['emergencyContactCategoryID']]	= $this->CommonModel->getData('tblemergencycontact', array('isActive' => '1', 'emergencyContactCategoryID' => $emergencyContactCategoryResult[$i]['emergencyContactCategoryID']), '', '', '');
		}

		$todaysBirthdayResult					= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('1', '0');
		$todaysBirthdayHeading					= "Today's Birthday";

		$upcomingBirthdayResult					= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('1', '1');
		$upcomingBirthdayHeading				= "Upcoming Birthday";

		$todaysWorkAnniversariesResult			= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('2', '0');
		$todaysWorkAnniversariesHeading			= "Today's Work Anniversaries";

		$upcomingWorkAnniversariesResult		= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('2', '1');
		$upcomingWorkAnniversariesHeading		= "Upcoming Work Anniversaries";

		$employeeOfTheMonthResult				= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('3', '0');
		$employeeOfTheYearResult				= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('3', '1');
		$employeeOfTheMonthYearResult			= array_merge($employeeOfTheMonthResult, $employeeOfTheYearResult);
		$employeeOfTheMonthYearHeading			= "Employee Of The Month & Year";

		$newEmployeeAnnouncementResult			= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('4', '0');
		$newEmployeeAnnouncementHeading			= "New Employee Announcement";

		$importantLinkHeading					= "Important Links";

		$importantLinksExternalResult			= $this->CommonModel->getData('tblimportantlink', array('isActive' => '1', 'linkType' => '1'), '', '', '');
		$importantLinkExternalHeading			= "External Important Links";

		$importantLinksInternalResult			= $this->CommonModel->getData('tblimportantlink', array('isActive' => '1', 'linkType' => '0'), '', '', '');
		$importantLinkInternalHeading			= "Internal Important Links";

		if ($_SESSION['userType'] != '2') {

			$safetyInstructionPostsCount		= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '1', 'visibleForFlag' => '0'), '', '', 'num_rows');
			$safetyInstructionPostsResult		= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '1', 'visibleForFlag' => '0'), '', '', '', '3', '0', 'postID', 'desc');

			$eventPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '2', 'visibleForFlag' => '0'), '',	'', 'num_rows');
			$eventPostsResult					= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '2', 'visibleForFlag' => '0'), '', '', '', '3', '0', 'postID', 'desc');

			$newsPostsCount						= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '3', 'visibleForFlag' => '0'), '',	'', 'num_rows');
			$newsPostsResult					= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '3', 'visibleForFlag' => '0'), '', '', '', '3', '0', 'postID', 'desc');

			$alertPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '4', 'visibleForFlag' => '0'), '',	'', 'num_rows');
			$alertPostsResult					= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '4', 'visibleForFlag' => '0'), '', '', '', '3', '0', 'postID', 'desc');

			$upcomingTrainingPostsCount			= $this->PostModel->getUpcomingTrainings('0', '0');
			$upcomingTrainingPostsResult		= $this->PostModel->getUpcomingTrainings('1', '0');

			$trainingPostsCount					= $this->PostModel->getCompletedTrainings('0', '0');
			$trainingPostsResult				= $this->PostModel->getCompletedTrainings('1', '0');

			$HRCommunicationsAndUpdatePostsCount = $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '6', 'visibleForFlag' => '0'), '',	'', 'num_rows');
			$HRCommunicationsAndUpdatePostsResult = $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '6', 'visibleForFlag' => '0'), '', '', '', '3', '0', 'postID', 'desc');

			$CSRPostsCount						= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '7', 'visibleForFlag' => '0'), '',	'', 'num_rows');
			$CSRPostsResult						= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '7', 'visibleForFlag' => '0'), '', '', '', '3', '0', 'postID', 'desc');

			$circularPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '8', 'visibleForFlag' => '0'), '',	'', 'num_rows');
			$circularPostsResult				= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '8', 'visibleForFlag' => '0'), '', '', '', '3', '0', 'postID', 'desc');

			$policiesPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '9', 'visibleForFlag' => '0'), '',	'', 'num_rows');
			$policiesPostsResult				= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '9', 'visibleForFlag' => '0'), '', '', '', '3', '0', 'postID', 'desc');

			$handbookPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '10', 'visibleForFlag' => '0'), '',	'', 'num_rows');
			$handbookPostsResult				= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '10', 'visibleForFlag' => '0'), '', '', '', '3', '0', 'postID', 'desc');
		} else {

			$safetyInstructionPostsCount		= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '1'), '', '', 'num_rows');
			$safetyInstructionPostsResult		= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '1'), '', '', '', '3', '0', 'postID', 'desc');

			$eventPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '2'), '',	'', 'num_rows');
			$eventPostsResult					= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '2'), '', '', '', '3', '0', 'postID', 'desc');

			$newsPostsCount						= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '3'), '',	'', 'num_rows');
			$newsPostsResult					= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '3'), '', '', '', '3', '0', 'postID', 'desc');

			$alertPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '4'), '',	'', 'num_rows');
			$alertPostsResult					= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '4'), '', '', '', '3', '0', 'postID', 'desc');

			$upcomingTrainingPostsCount			= $this->PostModel->getUpcomingTrainings('0', '1');
			$upcomingTrainingPostsResult		= $this->PostModel->getUpcomingTrainings('1', '1');

			$trainingPostsCount					= $this->PostModel->getCompletedTrainings('0', '1');
			$trainingPostsResult				= $this->PostModel->getCompletedTrainings('1', '1');

			$HRCommunicationsAndUpdatePostsCount = $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '6'), '',	'', 'num_rows');
			$HRCommunicationsAndUpdatePostsResult = $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '6'), '', '', '', '3', '0', 'postID', 'desc');

			$CSRPostsCount						= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '7'), '',	'', 'num_rows');
			$CSRPostsResult						= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '7'), '', '', '', '3', '0', 'postID', 'desc');

			$circularPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '8'), '',	'', 'num_rows');
			$circularPostsResult				= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '8'), '', '', '', '3', '0', 'postID', 'desc');

			$policiesPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '9'), '',	'', 'num_rows');
			$policiesPostsResult				= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '9'), '', '', '', '3', '0', 'postID', 'desc');

			$handbookPostsCount					= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => '10'), '',	'', 'num_rows');
			$handbookPostsResult				= $this->CommonModel->getDataLimit('tblpost', array('isActive' => '1', 'postCategoryID' => '10'), '', '', '', '3', '0', 'postID', 'desc');
		}


		$safetyInstructionHeadingResult		= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '1'), '', '', '');
		$safetyInstructionHeading			= $safetyInstructionHeadingResult[0]['name'];

		$eventHeadingResult					= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '2'), '', '', '');
		$eventHeading						= $eventHeadingResult[0]['name'];

		$newsHeadingResult					= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '3'), '', '', '');
		$newsHeading						= $newsHeadingResult[0]['name'];

		$alertHeadingResult					= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '4'), '', '', '');
		$alertHeading						= $alertHeadingResult[0]['name'];

		$trainingHeadingResult				= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '5'), '', '', '');
		$trainingHeading					= 'Completed ' . $trainingHeadingResult[0]['name'];

		$upcomingTrainingHeading			= 'Upcoming ' . $trainingHeadingResult[0]['name'];

		$HRCommunicationsAndUpdateHeadingResult	= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '6'), '', '', '');
		$HRCommunicationsAndUpdateHeading		= $HRCommunicationsAndUpdateHeadingResult[0]['name'];

		$CSRHeadingResult					= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '7'), '', '', '');
		$CSRHeading							= $CSRHeadingResult[0]['name'];

		$circularPageHeadingResult			= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '8'), '', '', '');
		$circularHeading					= $circularPageHeadingResult[0]['name'];

		$policiesPageHeadingResult			= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '9'), '', '', '');
		$policiesHeading					= $policiesPageHeadingResult[0]['name'];

		$handbookHeadingResult				= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => '10'), '', '', '');
		$handbookHeading					= $handbookHeadingResult[0]['name'];

		/*$trainingPostsCount					= $this->CommonModel->getData('tblpost',array('isActive'=>'1', 'postCategoryID'=> '5'),'',	'','num_rows');
			$trainingPostsResult				= $this->CommonModel->getDataLimit('tblpost', array('isActive'=>'1', 'postCategoryID'=> '5'), '', '', '', '3', '0' ,'postID','desc');
			$trainingHeadingResult					= $this->CommonModel->getData('tblpostcategory',array('postCategoryID'=> '5'),'','','');
			$trainingHeading						= $trainingHeadingResult[0]['name'];
			
			$upcomingTrainingPostsCount					= $this->CommonModel->getData('tblpost',array('isActive'=>'1', 'postCategoryID'=> '5'),'',	'','num_rows');
			$upcomingTrainingPostsResult		= $this->CommonModel->getDataLimit('tblpost', array('isActive'=>'1', 'postCategoryID'=> '5'), '', '', '', '3', '0' ,'postID','desc');
			$upcomingTrainingHeadingResult					= $this->CommonModel->getData('tblpostcategory',array('postCategoryID'=> '5'),'','','');
			$upcomingTrainingHeading						= 'Upcoming Trainings';*/

		$guestQuery						= "visitDate >= CURDATE() AND visitDate <= DATE_ADD(CURDATE(),INTERVAL 5 DAY) AND isActive = 1";
		$guestResult					= $this->CommonModel->getDataLimit('tblguest', $guestQuery, '', '', '', '3', '0', 'visitDate', 'desc');
		$guestHeading					= "Upcoming Guest Visit";
		$guestCount						= $this->CommonModel->getDataLimit('tblguest', $guestQuery, '', '', '', '', '0', 'visitDate', 'desc');
		$guestCount						= count($guestCount);


		$notificationListHeading			= "Website Updates";
		//$notificationListResult				= $this->login->getNotificationData('1');

		$notificationListResult				= getNotifications('1');
		/*
			for($p=0;$p<count($notificationListResult);$p++)
			{ 
				$notificationListResult[$p]['url'] 			= "";
				
				if(strpos($notificationListResult[$p]['description'], 'Emergency contact')!== false)
				{
					$notificationListResult[$p]['url'] 			= "emergencyContacts";	
					$notificationListResult[$p]['description'] = "New Emergency contact Added";
				}
				else if(strpos($notificationListResult[$p]['description'], 'Company Video')!== false)
				{
					$notificationListResult[$p]['url'] 			= "loadCompanyVideos";	
					$notificationListResult[$p]['description'] = "New Company Video Added";
				}
				else if(strpos($notificationListResult[$p]['description'], 'Company Presentation Template')!== false)
				{
					$notificationListResult[$p]['url'] 			= "companyPresentationTemplates";	
					$notificationListResult[$p]['description'] = "New Company Presentation Template Added";
				}
				else if(strpos($notificationListResult[$p]['description'], 'Employee')!== false)
				{
					$notificationListResult[$p]['url'] 			= "frontend/#NewEmployeeAnnouncement";	
					$notificationListResult[$p]['description'] = "New Employee Joined Our Company";
				}
				else if(strpos($notificationListResult[$p]['description'], 'Guest')!== false)
				{
					$notificationListResult[$p]['url'] 			= "frontend/#Guest";	
					$notificationListResult[$p]['description'] = "Upcomming New Guest Added";
				}
				else if(strpos($notificationListResult[$p]['description'], 'Important link')!== false)
				{
					$notificationListResult[$p]['url'] 			= "frontend/#ImportantLinks";	
					$notificationListResult[$p]['description'] = "New Important link Added";
				}
				else if(strpos($notificationListResult[$p]['description'], 'Bank Data')!== false)
				{
					$notificationListResult[$p]['url'] 			= "loadCoOperativeSocietyAccBal";
					$notificationListResult[$p]['description'] = "Co-Operative Society Data Updated";
				}
				else if(strpos($notificationListResult[$p]['description'], 'Job post')!== false)
				{
					$postArray 									= explode(" ", $notificationListResult[$p]['description']);
					$postID 									= $postArray['6'];
					$notificationListResult[$p]['url'] 			= "job/".$postID;
					$notificationListResult[$p]['description'] 	= "New Job post Added";
				}
				else if(strpos($notificationListResult[$p]['description'], 'Post')!== false)
				{
					$postArray 								= explode(" ", $notificationListResult[$p]['description']);
					$postID 								= $postArray['5'];
					$postResult								= $this->PostModel->getPost($postID); //print_r($postResult);exit;
					
					if(!empty($postResult))
					{
						$notificationListResult[$p]['description'] 	= "New ".$postResult[0]['name']." Added";
						$k = $postResult[0]['postCategoryID'];
						
						if($k==1)
						{
							$viewAllURL		= "safetyInstructions";
						}
						else if($k==2)
						{
							$viewAllURL		= "events";
						}
						else if($k==3)
						{
							$viewAllURL		= "news";
						}
						else if($k==4)
						{
							$viewAllURL		= "alerts";
						}
						else if($k==5)
						{
							$viewAllURL		= "trainings";
						}
						else if($k==6)
						{
							$viewAllURL		= "HRcommunicationsAndUpdates";
						}
						else if($k==7)
						{
							$viewAllURL		= "CSR";
						}
						else if($k==8)
						{
							$viewAllURL		= "circulars";
						}
						else if($k==9)
						{
							$viewAllURL		= "policies";
						}
						else if($k==10)
						{
							$viewAllURL		= "handbook";
						}
						
						$notificationListResult[$p]['url'] 			= $viewAllURL."/".$postID;
					}
					/*else
					{
						unset($notificationListResult[$p]);
					}*
				}
			}
			
			*/
		//$notificationResultNew = array_values($notificationListResult);
		//$notificationListResult = $notificationResultNew;

		$this->load->view('frontend/home', [
			'emergencyContactCategoryResult' 					=> $emergencyContactCategoryResult,
			'emergencyContactResult' 				=> $emergencyContactResult,
			'emergencyContactCategoryCount'			=> $emergencyContactCategoryCount,
			'guestResult' 							=> $guestResult,
			'guestHeading' 							=> $guestHeading,
			'guestCount'							=> $guestCount,
			'todaysBirthdayResult' 					=> $todaysBirthdayResult,
			'todaysBirthdayHeading' 				=> $todaysBirthdayHeading,
			'upcomingBirthdayResult' 				=> $upcomingBirthdayResult,
			'upcomingBirthdayHeading' 				=> $upcomingBirthdayHeading,
			'todaysWorkAnniversariesResult' 		=> $todaysWorkAnniversariesResult,
			'todaysWorkAnniversariesHeading'		=> $todaysWorkAnniversariesHeading,
			'upcomingWorkAnniversariesResult' 		=> $upcomingWorkAnniversariesResult,
			'upcomingWorkAnniversariesHeading'		=> $upcomingWorkAnniversariesHeading,
			'employeeOfTheMonthYearResult' 			=> $employeeOfTheMonthYearResult,
			'employeeOfTheMonthYearHeading'			=> $employeeOfTheMonthYearHeading,
			'newEmployeeAnnouncementResult' 		=> $newEmployeeAnnouncementResult,
			'newEmployeeAnnouncementHeading'		=> $newEmployeeAnnouncementHeading,
			'importantLinksInternalResult' 			=> $importantLinksInternalResult,
			'importantLinkInternalHeading'			=> $importantLinkInternalHeading,
			'importantLinksExternalResult' 			=> $importantLinksExternalResult,
			'importantLinkExternalHeading'			=> $importantLinkExternalHeading,
			'importantLinkHeading'					=> $importantLinkHeading,
			'safetyInstructionPostsCount'			=> $safetyInstructionPostsCount,
			'safetyInstructionPostsResult'			=> $safetyInstructionPostsResult,
			'safetyInstructionHeading'              => $safetyInstructionHeading,
			'eventPostsCount'						=> $eventPostsCount,
			'eventPostsResult'                      => $eventPostsResult,
			'eventHeading'                          => $eventHeading,
			'newsPostsCount'						=> $newsPostsCount,
			'newsPostsResult'                       => $newsPostsResult,
			'newsHeading'                           => $newsHeading,
			'alertPostsCount'						=> $alertPostsCount,
			'alertPostsResult'                      => $alertPostsResult,
			'alertHeading'                          => $alertHeading,
			'trainingPostsCount'					=> $trainingPostsCount,
			'trainingPostsResult'                   => $trainingPostsResult,
			'trainingHeading'                       => $trainingHeading,
			'upcomingTrainingPostsCount'					=> $upcomingTrainingPostsCount,
			'upcomingTrainingPostsResult'                   => $upcomingTrainingPostsResult,
			'upcomingTrainingHeading'                       => $upcomingTrainingHeading,
			'HRCommunicationsAndUpdatePostsCount'	=> $HRCommunicationsAndUpdatePostsCount,
			'HRCommunicationsAndUpdatePostsResult'  => $HRCommunicationsAndUpdatePostsResult,
			'HRCommunicationsAndUpdateHeading'      => $HRCommunicationsAndUpdateHeading,
			'CSRPostsCount'							=> $CSRPostsCount,
			'CSRPostsResult'                        => $CSRPostsResult,
			'CSRHeading'                            => $CSRHeading,
			'circularPostsCount'					=> $circularPostsCount,
			'circularPostsResult'                   => $circularPostsResult,
			'circularHeading'                       => $circularHeading,
			'policiesPostsCount'					=> $policiesPostsCount,
			'policiesPostsResult'                   => $policiesPostsResult,
			'policiesHeading'                       => $policiesHeading,
			'handbookPostsCount'					=> $handbookPostsCount,
			'handbookPostsResult'                   => $handbookPostsResult,
			'handbookHeading'                       => $handbookHeading,
			'notificationListResult'				=> $notificationListResult,
			'notificationListHeading'				=> $notificationListHeading,
			'noDataAvailable'                       => $this->load->view('frontend/noDataAvailable', '', TRUE)
		]);
	}


	public function emergencyContacts()
	{
		$emergencyContactCategoryResult	= $this->CommonModel->getData('tblemergencycontactcategory', array('isActive' => '1'), '', '', '');
		$emergencyContactResult			= array();

		for ($i = 0; $i < count($emergencyContactCategoryResult); $i++) {
			$emergencyContactResult[$emergencyContactCategoryResult[$i]['emergencyContactCategoryID']]	= $this->CommonModel->getData('tblemergencycontact', array('isActive' => '1', 'emergencyContactCategoryID' => $emergencyContactCategoryResult[$i]['emergencyContactCategoryID']), '', '', '');
		}

		$this->load->view('frontend/emergencyContacts', [
			'emergencyContactCategoryResult' 	=> $emergencyContactCategoryResult,
			'emergencyContactResult' 		=> $emergencyContactResult,
			'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)
		]);
	}

	public function todaysBirthday()
	{
		$todaysBirthdayResult	= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('1', '0');
		$pageHeading			= "Today's Birthday";

		$this->load->view('frontend/todaysBirthday', ['todaysBirthdayResult' => $todaysBirthdayResult, 'pageHeading' => $pageHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function upcomingBirthday()
	{
		$todaysBirthdayResult	= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('1', '1');
		$pageHeading			= "Upcoming Birthday";

		$this->load->view('frontend/todaysBirthday', ['todaysBirthdayResult' => $todaysBirthdayResult, 'pageHeading' => $pageHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function todaysWorkAnniversaries()
	{
		$todaysBirthdayResult	= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('2', '0');
		$pageHeading			= "Today's Work Anniversaries";

		$this->load->view('frontend/todaysBirthday', ['todaysBirthdayResult' => $todaysBirthdayResult, 'pageHeading' => $pageHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function upcomingWorkAnniversaries()
	{
		$todaysBirthdayResult	= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('2', '1');
		$pageHeading			= "Upcoming Work Anniversaries";

		$this->load->view('frontend/todaysBirthday', ['todaysBirthdayResult' => $todaysBirthdayResult, 'pageHeading' => $pageHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function employeeOfTheMonthYear()
	{
		$employeeOfTheMonthResult	= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('3', '0');
		$employeeOfTheYearResult	= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('3', '1');
		$todaysBirthdayResult		= array_merge($employeeOfTheMonthResult, $employeeOfTheYearResult);
		$pageHeading				= "Employee Of The Month & Year";

		$this->load->view('frontend/todaysBirthday', ['todaysBirthdayResult' => $todaysBirthdayResult, 'pageHeading' => $pageHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function newEmployeeAnnouncement()
	{
		$todaysBirthdayResult	= $this->EmployeeModel->getEmployeeDetailsAsPerParameters('4', '0');
		$pageHeading			= "New Employee Announcement";

		$this->load->view('frontend/todaysBirthday', ['todaysBirthdayResult' => $todaysBirthdayResult, 'pageHeading' => $pageHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function importantLinks()
	{
		$importantLinksResult	= $this->CommonModel->getData('tblimportantlink', array('isActive' => '1'), '', '', '');
		$pageHeading			= "Important Links";

		$this->load->view('frontend/importantLinks', ['importantLinksResult' => $importantLinksResult, 'pageHeading' => $pageHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function loadPosts($flag)
	{
		if ($_SESSION['userType'] != '2') {
			$postsResult		= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => $flag, 'visibleForFlag' => '0'), '',	'', '');
		} else {
			$postsResult		= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postCategoryID' => $flag), '',	'', '');
		}
		//$postsResult		= $this->CommonModel->getData('tblpost',array('isActive'=>'1', 'postCategoryID'=>$flag),'',	'','');
		$pageHeadingReslt	= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => $flag), '', '', '');
		$pageHeading		= $pageHeadingReslt[0]['name'];

		if ($flag >= 8) {
			$this->load->view('frontend/loadPostList', ['postsResult' => $postsResult, 'pageHeading' => $pageHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
		} else if ($flag < 8) {
			$this->load->view('frontend/loadPosts', ['postsResult' => $postsResult, 'pageHeading' => $pageHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
		}
	}

	public function loadPostDetails($postID)
	{
		$postDetailsResult	= $this->CommonModel->getData('tblpost', array('isActive' => '1', 'postID' => $postID), '',	'', '');

		if (!empty($postDetailsResult)) {
			$pageHeadingReslt	= $this->CommonModel->getData('tblpostcategory', array('postCategoryID' => $postDetailsResult['0']['postCategoryID']), '', '', '');
			$pageHeading		= $pageHeadingReslt[0]['name'];

			$userReslt			= $this->CommonModel->getData('tbluser', array('userID' => $postDetailsResult[0]['createdByUserID']), '', '', '');
			$postDetailsResult[0]['createdByUserName'] = $userReslt[0]['userFullName'];

			$this->load->view('frontend/loadPostDetails', ['postDetailsResult' => $postDetailsResult, 'pageHeading' => $pageHeading]);
		} else {
			$this->session->set_userdata('toastrError', 'Something went wrong');
			redirect(DASHBOARD, 'refresh');
		}
	}

	public function loadCompanyVideos()
	{
		$companyVideosResult	= $this->CommonModel->getData('tblcompanyvideo', array('isActive' => '1'), '',	'', '');

		$this->load->view('frontend/loadCompanyVideos', ['companyVideosResult' => $companyVideosResult, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function loadCoOperativeSocietyAccBal()
	{
		$CoOperativeSocietyAccBalResult	= $this->CommonModel->getData('tblimportbankdata', array('isActive' => '1', 'employeeCode' => $_SESSION['employeeCode']), '',	'', '');
		$this->load->view('frontend/loadCoOperativeSocietyAccBal', ['CoOperativeSocietyAccBalResult' => $CoOperativeSocietyAccBalResult]);
	}

	public function jobs()
	{
		$jobsResult		= $this->CommonModel->getData('tbljobpost', array('isActive' => '1'), '', '', '');
		$this->load->view('frontend/jobs', ['jobsResult' => $jobsResult, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function jobDetails($jobPostID)
	{
		$jobDetailsResult	= $this->CommonModel->getData('tbljobpost', array('isActive' => '1', 'jobPostID' => $jobPostID), '',	'', '');

		if (!empty($jobDetailsResult)) {
			$userResult			= $this->CommonModel->getData('tbluser', array('userID' => $jobDetailsResult[0]['createdByUserID']), '', '', '');
			$jobDetailsResult[0]['createdByUserName'] = $userResult[0]['userFullName'];
			//print_r($userResult);exit;
			$this->load->view('frontend/jobDetails', ['jobDetailsResult' => $jobDetailsResult]);
		} else {
			$this->session->set_userdata('toastrError', 'Something went wrong');
			redirect(DASHBOARD, 'refresh');
		}
	}

	public function uploadResume()
	{
		if (
			$_FILES['txtPDF']['name'] != "" &&
			$this->input->post('txtMessage') != ""
		) {
			$ext = substr(strrchr($_FILES['txtPDF']['name'], '.'), 1);
			$resume = "resume-" . date('YmdHis') . "." . $ext;

			$prop = array(
				'jobPostID'         =>  $this->input->post('txtJobPostID'),
				'employeeID'     	=>  $this->session->userdata['employeeID'],
				'resumeLink'        =>  $resume,
				'message'			=>  $this->input->post('txtMessage'),
				'createdByUserID'   =>  $this->session->userdata['employeeID']
			);

			$bool = $this->CommonModel->insertRecord('tbljobpostresume', $prop);

			if ($bool == 1) {
				if ($_FILES["txtPDF"]["name"] != "") {
					/******************************** Author Photo Upload *********************************/
					$target_file    = UPLOAD_POST_JOB_APPLICATIONS . "/" . $resume;

					if (move_uploaded_file($_FILES['txtPDF']['tmp_name'], $target_file)) {
					} else {
						$this->session->set_userdata('toastrError', 'Problem uploading image...');
						redirect(SHOW_JOB_POSTS_FRONT . "/" . $this->input->post('txtJobPostID'), 'refresh');
					}

					/**********  Photo Upload *********************************/
				}

				// Add activity log start
				$prop = array(
					'description'		=>  "Job Application : Uploaded (employeeID : " . $this->session->userdata('employeeID') . " - activityLogID : " . $this->db->insert_id() . ")",
					'createdByUserID'   =>  $this->session->userdata['employeeID'],
					'applicationFlag'   =>  '1'
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end

				$this->session->set_userdata('toastrSuccess', ' Resume sended successfully...');
				redirect(SHOW_JOB_POSTS_FRONT . "/" . $this->input->post('txtJobPostID'), 'refresh');
			} else {
				$this->session->set_userdata('toastrError', 'Data was not saved!');
				redirect(SHOW_JOB_POSTS_FRONT . "/" . $this->input->post('txtJobPostID'), 'refresh');
			}
		} else {
			$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
			redirect(SHOW_JOB_POSTS_FRONT . "/" . $this->input->post('txtJobPostID'), 'refresh');
		}
	}

	public function holidayCalender()
	{
		//$holidayResult		= $this->CommonModel->getData('tblholiday',array('isActive'=>'1'),'','','');
		$holidayResult		= $this->HolidayModel->getHoliday();

		$this->load->view('frontend/holidayCalender', ['holidayResult' => $holidayResult, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function employeesContactList()
	{
		$employeeResult     		= $this->EmployeeModel->getEmployees();
		$departmentResult			= $this->CommonModel->getData('tbldepartment', '', '', '', '');
		$designationResult			= $this->CommonModel->getData('tbldesignation', '', '', '', '');
		$employeeTypeResult			= $this->CommonModel->getData('tblemployeetype', '', '', '', '');

		$this->load->view('frontend/employeesContactList', ['employeeResult' => $employeeResult, 'departmentResult' => $departmentResult, 'designationResult' => $designationResult, 'employeeTypeResult' => $employeeTypeResult, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function filterEmployees()
	{
		//$deptID					=	$this->input->post('chkDepartment');
		$deptID					=	$this->input->post('cmbDepartmentID');
		//$employeeTypeID			=	$this->input->post('rbtnEmployeeType');
		$employeeTypeID			=	$this->input->post('cmbEmployeeTypeID');

		$filter = "";

		if ($deptID != 0) {
			/*$deptIDs				= "(";

				foreach($deptID as $result1)
				{
					$deptIDs.=$result1.",";
				}

				$departmentIDs			=	substr($deptIDs, 0, -1);

				$filter = "tbldepartment.departmentID IN".$departmentIDs.")";*/
			$filter .= "tbldepartment.departmentID = '" . $deptID . "'";
		}

		if ($employeeTypeID != 0) {
			if ($filter != "") {
				$filter .= " AND tblemployeetype.employeeTypeID = '" . $employeeTypeID . "'";
			} else {
				$filter .= "tblemployeetype.employeeTypeID = '" . $employeeTypeID . "'";
			}
		}

		$employeeResult       = $this->EmployeeModel->getSearchEmployeeResult($filter); //echo $filter;exit;

		$departmentResult			= $this->CommonModel->getData('tbldepartment', '', '', '', '');
		$designationResult			= $this->CommonModel->getData('tbldesignation', '', '', '', '');
		$employeeTypeResult			= $this->CommonModel->getData('tblemployeetype', '', '', '', '');

		$this->load->view('frontend/employeesContactList', ['employeeResult' => $employeeResult, 'departmentResult' => $departmentResult, 'designationResult' => $designationResult, 'employeeTypeResult' => 	$employeeTypeResult, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function searchEmployees()
	{
		$searchText			=	$this->input->post('txtSearch');

		$filter = "";

		if ($searchText != "") {
			$filter = "(tblemployee.fullName LIKE '%$searchText%' OR 
							tblemployee.address LIKE '%$searchText%' OR 
							tblemployee.contactNumber LIKE '%$searchText%' OR
							tblemployee.landlineNumber LIKE '%$searchText%' OR
							tblemployee.emailAddress LIKE '%$searchText%' OR
							tbldepartment.departmentName LIKE '%$searchText%' OR
							tblemployeetype.employeeTypeName LIKE '%$searchText%' OR
							tbldesignation.designationName LIKE '%$searchText%')";
		}

		$employeeResult       = $this->EmployeeModel->getSearchEmployeeResult($filter); //echo $filter;exit;

		$departmentResult			= $this->CommonModel->getData('tbldepartment', '', '', '', '');
		$designationResult			= $this->CommonModel->getData('tbldesignation', '', '', '', '');
		$employeeTypeResult			= $this->CommonModel->getData('tblemployeetype', '', '', '', '');

		$this->load->view('frontend/employeesContactList', ['employeeResult' => $employeeResult, 'departmentResult' => $departmentResult, 'designationResult' => $designationResult, 'employeeTypeResult' => 	$employeeTypeResult, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function contactUS1()
	{
		$this->load->view('frontend/contactUS');
	}

	public function contactUSSubmit()
	{

		$to_email = "softwingshr@gmail.com";
		$subject = "Test email to send from XAMPP";
		$body = "Hi, This is test mail to check how to send mail from Localhost Using Gmail ";
		$headers = "From: sender email";

		if (mail($to_email, $subject, $body, $headers)) {
			echo "Email successfully sent to $to_email...";
		} else {
			echo "Email sending failed!";
		}
		exit;

		if (
			$this->input->post('txtFirstName') != "" &&
			$this->input->post('txtLastName') != "" &&
			$this->input->post('txtEmail') != "" &&
			$this->input->post('txtContactNumber') != "" &&
			$this->input->post('txtSubject') != "" &&
			$this->input->post('txtMessage') != ""
		) {
			$prop = array(
				'firstName '		=> $this->input->post('txtFirstName', true),
				'lastName'			=> $this->input->post('txtLastName', true),
				'email'				=> filter_var($this->input->post('txtEmail'), FILTER_SANITIZE_EMAIL),
				'contactNumber'		=> $this->input->post('txtContactNumber', true),
				'subject'			=> $this->input->post('txtSubject', true),
				'message'			=> $this->input->post('txtMessage', true),
				'createdByUserID'	=> filter_var($this->session->userdata['employeeID'], FILTER_SANITIZE_NUMBER_INT)
			);

			$bool = $this->CommonModel->insertRecord('tblcontactform', $prop);

			if ($bool == 1) {
				// Add activity log start
				$prop = array(
					'description'		=>  "Contact us : Added (employeeID : " . filter_var($this->session->userdata('employeeID'), FILTER_SANITIZE_NUMBER_INT) . " - contactUsID : " . $this->db->insert_id() . ")",
					'createdByUserID'   =>  filter_var($this->session->userdata['employeeID'], FILTER_SANITIZE_NUMBER_INT),
					'applicationFlag'   =>  '1'
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end

				$this->session->set_userdata('toastrSuccess', 'Details sended successfully...');
				redirect('contactUS', 'refresh');
			} else {
				$this->session->set_userdata('toastrError', 'Data was not sended!');
				redirect('contactUS', 'refresh');
			}
		} else {
			$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
			redirect('contactUS', 'refresh');
		}
	}

	public function aboutUS1()
	{
		$this->load->view('frontend/aboutUS');
	}

	public function historyOfCompany()
	{
		$this->load->view('frontend/historyOfCompany');
	}

	public function departmentalInformation()
	{
		$departmentalInformationResult		= $this->CommonModel->getData('tbldepartment', array('isActive' => '1'), '', '', '');
		$this->load->view('frontend/departmentalInformation', ['departmentalInformationResult' => $departmentalInformationResult, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}


	public function companyPresentationTemplates()
	{
		$companyPresentationTemplatesResult		= $this->CommonModel->getData('tblcompanypresentationtemplate', array('isActive' => '1'), '', '', '');
		$this->load->view('frontend/companyPresentationTemplates', ['companyPresentationTemplatesResult' => $companyPresentationTemplatesResult, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function organizationChart()
	{
		$departmentResult 	= $this->CommonModel->getData('tbldepartment', array('isActive' => '1'), '', '', '');
		$actualData 		= $departmentResult;

		for ($i = 0; $i < count($departmentResult); $i++) {
			//$designationData  = $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>$departmentResult[$i]['departmentID']),'','','');
			$designationData	= $this->CommonModel->getDataLimit('tbldesignation', array('isActive' => '1', 'departmentID' => $departmentResult[$i]['departmentID']), '', '', '', '', '0', 'sequence', 'asc');

			//echo "<pre>"; print_r($designationData);exit;
			/*for($j=0; $j<count($designationData); $j++)
				{
					$employeeResult[$designationData[$j]['designationID']] = $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>$designationData[$j]['designationID']),'','','');
					
					$designationData[$designationData[$j]['designationID']] = 
				}*/

			$actualData[$departmentResult[$i]['departmentID']] = $designationData;
		}
		//echo "<pre>"; print_r($actualData);exit;

		$JMDCEOResult 				= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => '77'), '', '', '');
		$WTDCFOResult				= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => '7'), '', '', '');
		$SecretaryResult			= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => '31'), '', '', '');
		//$GMPlantResult				= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'44'),'','','');
		//$MRQMSResult 				= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'50'),'','','');
		//$MREMSOHSASResult			= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'67'),'','','');

		$query						= "tblemployee.designationID =44 AND tblemployee.isActive = 1";
		$GMPlantResult 				= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =50 AND tblemployee.isActive = 1";
		$MRQMSResult 				= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =67 AND tblemployee.isActive = 1";
		$MREMSOHSASResult 				= $this->EmployeeModel->getSearchEmployeeResult($query);




		$query						= "tblemployee.designationID =59 AND tblemployee.isActive = 1";
		$DGMPurchaseResult			= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =80 AND tblemployee.isActive = 1";
		$AGMSalesResult				= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =67 AND tblemployee.isActive = 1";
		$ManagerOHSEResult			= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =11 AND tblemployee.isActive = 1";
		$AGMFinAccountsResult		= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =15 AND tblemployee.isActive = 1";
		$AGMHRAdminResult			= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =21 AND tblemployee.isActive = 1";
		$ManagerITResult			= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =22 AND tblemployee.isActive = 1";
		$ManagerLegalCSResult		= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =40 AND tblemployee.isActive = 1";
		$DGMProductionResult		= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =27 AND tblemployee.isActive = 1";
		$AGMMaintenanceResult		= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =50 AND tblemployee.isActive = 1";
		$SrManagerQAResult			= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =41 AND tblemployee.isActive = 1";
		$SrManagerPlanningResult	= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =4 AND tblemployee.isActive = 1";
		$SrManagerEngineeringResult	= $this->EmployeeModel->getSearchEmployeeResult($query);

		$query						= "tblemployee.designationID =42 AND tblemployee.isActive = 1";
		$DyManagerCivilResult		= $this->EmployeeModel->getSearchEmployeeResult($query);

		/*$DGMPurchaseResult			= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'59'),'','','');
			$AGMSalesResult				= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'80'),'','','');
			$ManagerOHSEResult			= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'67'),'','','');
			$AGMFinAccountsResult		= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'11'),'','','');
			$AGMHRAdminResult			= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'15'),'','','');
			$ManagerITResult			= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'21'),'','','');
			$ManagerLegalCSResult		= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'22'),'','','');
			$DGMProductionResult		= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'40'),'','','');
			$AGMMaintenanceResult		= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'27'),'','','');
			$SrManagerQAResult			= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'50'),'','','');
			$SrManagerPlanningResult	= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'41'),'','','');
			$SrManagerEngineeringResult	= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'4'),'','','');
			$DyManagerCivilResult		= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>'42'),'','','');*/

		/*
			$cdata	= array();
			//exit;
			for($k=0; $k<3; $k++)	
			{
				$tempData	= array();
				
				if($k=0)
				{
					$tempData	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'15'),'','','');
				}
				else if($k=1)
				{
					$tempData	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'18'),'','','');
				}
				else if($k=2)
				{
					$tempData	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'17'),'','','');
					echo "<pre>"; print_r($tempData);exit;
				}
				
				for($i=0; $i<count($tempData); $i++)
				{
					$employeeResult				= $this->CommonModel->getData('tblemployee',array('isActive'=>'1', 'designationID'=>$tempData[$i]['designationID']),'','','');
					$tempData[$i]['employees'] 	= $employeeResult;
				}
				
				$cdata[$k] = $tempData;
			}
			//echo "<pre>"; print_r($cdata);
			
			*/

		//$DGMPurchaseMoreResult  	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'15'),'','','');
		$DGMPurchaseMoreResult	= $this->CommonModel->getDataLimit('tbldesignation', array('isActive' => '1', 'departmentID' => '15'), '', '', '', '', '0', 'sequence', 'asc');

		for ($i = 0; $i < count($DGMPurchaseMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $DGMPurchaseMoreResult[$i]['designationID']), '', '', '');
			$DGMPurchaseMoreResult[$i]['employees'] = $employeeResult;
		}

		//$AGMSalesMoreMoreResult  	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'18'),'','','');
		$AGMSalesMoreMoreResult	= $this->CommonModel->getDataLimit('tbldesignation', array('isActive' => '1', 'departmentID' => '18'), '', '', '', '', '0', 'sequence', 'asc');

		for ($i = 0; $i < count($AGMSalesMoreMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $AGMSalesMoreMoreResult[$i]['designationID']), '', '', '');
			$AGMSalesMoreMoreResult[$i]['employees'] = $employeeResult;
		}

		$ManagerOHSEMoreMoreResult  	= $this->CommonModel->getData('tbldesignation', array('isActive' => '1', 'departmentID' => '17'), '', '', '');

		for ($i = 0; $i < count($ManagerOHSEMoreMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $ManagerOHSEMoreMoreResult[$i]['designationID']), '', '', '');
			$ManagerOHSEMoreMoreResult[$i]['employees'] = $employeeResult;
		}

		//$DGMProductionMoreResult  	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'14'),'','','');
		$DGMProductionMoreResult	= $this->CommonModel->getDataLimit('tbldesignation', array('isActive' => '1', 'departmentID' => '14'), '', '', '', '', '0', 'sequence', 'asc');

		for ($i = 0; $i < count($DGMProductionMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $DGMProductionMoreResult[$i]['designationID']), '', '', '');
			$DGMProductionMoreResult[$i]['employees'] = $employeeResult;
		}

		$guestQuery						= "designationID IN(1,30,47,51,69) AND isActive = 1";
		$DGMProductionMoreOperatorsResult  	= $this->CommonModel->getDataLimit('tbldesignation', $guestQuery, '', '', '', '', '0', 'designationID', 'ASC');
		//$DGMProductionMoreOperatorsResult  	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'designationID'=>' IN((1,30,47,51,69))'),'','','');//51
		$DGMProductionMoreOperatorsResultCount = 0;
		for ($i = 0; $i < count($DGMProductionMoreOperatorsResult); $i++) {
			$employeeResult = $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $DGMProductionMoreOperatorsResult[$i]['designationID']), '', '', '');
			$DGMProductionMoreOperatorsResult[$i]['employees'] = $employeeResult;
			$DGMProductionMoreOperatorsResultCount += count($employeeResult);
		}

		//$AGMMaintenanceMoreResult  	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'8'),'','','');
		$AGMMaintenanceMoreResult	= $this->CommonModel->getDataLimit('tbldesignation', array('isActive' => '1', 'departmentID' => '8'), '', '', '', '', '0', 'sequence', 'asc');

		for ($i = 0; $i < count($AGMMaintenanceMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $AGMMaintenanceMoreResult[$i]['designationID']), '', '', '');
			$AGMMaintenanceMoreResult[$i]['employees'] = $employeeResult;
		}

		$guestQuery						= "departmentID IN(13,16) AND isActive = 1";
		$SrManagerQAMoreResult  	= $this->CommonModel->getDataLimit('tbldesignation', $guestQuery, '', '', '', '', '0', 'sequence', 'ASC');
		//$SrManagerQAMoreResult  	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'13'),'','','');

		for ($i = 0; $i < count($SrManagerQAMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $SrManagerQAMoreResult[$i]['designationID']), '', '', '');
			$SrManagerQAMoreResult[$i]['employees'] = $employeeResult;
		}

		$guestQuery						= "departmentID IN(19,11) AND isActive = 1";
		$SrManagerPlanningMoreResult  	= $this->CommonModel->getDataLimit('tbldesignation', $guestQuery, '', '', '', '', '0', 'sequence', 'ASC');
		//$SrManagerPlanningMoreResult  	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'11'),'','','');

		for ($i = 0; $i < count($SrManagerPlanningMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $SrManagerPlanningMoreResult[$i]['designationID']), '', '', '');
			$SrManagerPlanningMoreResult[$i]['employees'] = $employeeResult;
		}

		$SrManagerEngineeringMoreResult  	= $this->CommonModel->getData('tbldesignation', array('isActive' => '1', 'departmentID' => '4'), '', '', '');

		for ($i = 0; $i < count($SrManagerEngineeringMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $SrManagerEngineeringMoreResult[$i]['designationID']), '', '', '');
			$SrManagerEngineeringMoreResult[$i]['employees'] = $employeeResult;
		}

		//$AGMFinAccountsMoreResult  	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'5'),'','','');
		$AGMFinAccountsMoreResult	= $this->CommonModel->getDataLimit('tbldesignation', array('isActive' => '1', 'departmentID' => '5'), '', '', '', '', '0', 'sequence', 'asc');

		for ($i = 0; $i < count($AGMFinAccountsMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $AGMFinAccountsMoreResult[$i]['designationID']), '', '', '');
			$AGMFinAccountsMoreResult[$i]['employees'] = $employeeResult;
		}

		//$AGMHRAdminMoreResult  	= $this->CommonModel->getData('tbldesignation',array('isActive'=>'1', 'departmentID'=>'1'),'','','');
		$AGMHRAdminMoreResult	= $this->CommonModel->getDataLimit('tbldesignation', array('isActive' => '1', 'departmentID' => '1'), '', '', '', '', '0', 'sequence', 'asc');

		for ($i = 0; $i < count($AGMHRAdminMoreResult); $i++) {
			$employeeResult		= $this->CommonModel->getData('tblemployee', array('isActive' => '1', 'designationID' => $AGMHRAdminMoreResult[$i]['designationID']), '', '', '');
			$AGMHRAdminMoreResult[$i]['employees'] = $employeeResult;
		}


		//echo "<pre>"; print_r($DGMPurchaseMoreResult);exit;
		//$this->load->view('frontend/organizationChart', ['actualData' => $actualData]);
		$this->load->view('frontend/organizationChartNew', [
			'actualData' => $actualData,
			'JMDCEOResult' => $JMDCEOResult,
			'WTDCFOResult' => $WTDCFOResult,
			'SecretaryResult' => $SecretaryResult,
			'GMPlantResult' => $GMPlantResult,
			'MRQMSResult' => $MRQMSResult,
			'MREMSOHSASResult' => $MREMSOHSASResult,
			'DGMPurchaseResult' => $DGMPurchaseResult,
			'AGMSalesResult' => $AGMSalesResult,
			'ManagerOHSEResult' => $ManagerOHSEResult,
			'AGMFinAccountsResult' => $AGMFinAccountsResult,
			'AGMHRAdminResult' => $AGMHRAdminResult,
			'ManagerITResult' => $ManagerITResult,
			'ManagerLegalCSResult' => $ManagerLegalCSResult,
			'DGMProductionResult' => $DGMProductionResult,
			'AGMMaintenanceResult' => $AGMMaintenanceResult,
			'SrManagerQAResult' => $SrManagerQAResult,
			'SrManagerPlanningResult' => $SrManagerPlanningResult,
			'SrManagerEngineeringResult' => $SrManagerEngineeringResult,
			'DyManagerCivilResult' => $DyManagerCivilResult,
			'DGMPurchaseMoreResult' => $DGMPurchaseMoreResult,
			'AGMSalesMoreMoreResult' => $AGMSalesMoreMoreResult,
			'ManagerOHSEMoreMoreResult' => $ManagerOHSEMoreMoreResult,
			'DGMProductionMoreResult' => $DGMProductionMoreResult,
			'DGMProductionMoreOperatorsResult' => $DGMProductionMoreOperatorsResult,
			'AGMMaintenanceMoreResult' => $AGMMaintenanceMoreResult,
			'SrManagerQAMoreResult' => $SrManagerQAMoreResult,
			'SrManagerPlanningMoreResult' => $SrManagerPlanningMoreResult,
			'SrManagerEngineeringMoreResult' => $SrManagerEngineeringMoreResult,
			'AGMFinAccountsMoreResult' => $AGMFinAccountsMoreResult,
			'AGMHRAdminMoreResult' => $AGMHRAdminMoreResult,
			'DGMProductionMoreOperatorsResultCount' => $DGMProductionMoreOperatorsResultCount
		]);
		//'cdata' => $cdata
	}

	public function photoVideoGalleryCategory()
	{
		if ($_SESSION['userType'] != '2') {
			//$photoGalleryCategoryResult	= $this->CommonModel->getData('tblphotogallerycategory',array('isActive'=>'1', 'visibleForFlag'=> '0'),'','','');
			$photoVideoGalleryCategoryResult		= $this->CommonModel->getDataLimit('tblphotovideogallerycategory', array('isActive' => '1', 'visibleForFlag' => '0'), '', '', '', '', '0', 'pin', 'desc');
		} else {
			//$photoGalleryCategoryResult	= $this->CommonModel->getData('tblphotogallerycategory',array('isActive'=>'1'),'','','');
			$photoVideoGalleryCategoryResult		= $this->CommonModel->getDataLimit('tblphotovideogallerycategory', array('isActive' => '1'), '', '', '', '', '0', 'pin', 'desc');
		}

		for ($i = 0; $i < count($photoVideoGalleryCategoryResult); $i++) {
			$photoVideoGalleryCategoryResult[$i]['photoVideoGallery'] = $this->CommonModel->getDataLimit('tblphotovideogallery', array('isActive' => '1', 'photoVideoGalleryCategoryID' => $photoVideoGalleryCategoryResult[$i]['photoVideoGalleryCategoryID'], 'photoVideoTypeFlag' => '2'), '', '', '', '3', '0', 'photoVideoGalleryID', 'desc');
		}

		$this->load->view('frontend/photoVideoGalleryCategory', ['photoVideoGalleryCategoryResult' 	=> $photoVideoGalleryCategoryResult, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
	}

	public function photoVideoGallery($photoVideoGalleryCategoryID)
	{
		$photoVideoGalleryResult	= $this->CommonModel->getData('tblphotovideogallery', array('isActive' => '1', 'photoVideoGalleryCategoryID' => $photoVideoGalleryCategoryID), '', '', '');
		$photoVideoGalleryCategoryName	= $this->CommonModel->getData('tblphotovideogallerycategory', array('photoVideoGalleryCategoryID' => $photoVideoGalleryCategoryID), '', '', '');
		$postHeading = $photoVideoGalleryCategoryName[0]['name'];

		if (!empty($photoVideoGalleryResult)) {
			$this->load->view('frontend/photoVideoGallery', ['photoVideoGalleryResult' => $photoVideoGalleryResult, 'postHeading' => $postHeading, 'noDataAvailable' => $this->load->view('frontend/noDataAvailable', '', TRUE)]);
		} else {
			//$this->session->set_userdata('toastrError', 'Something went wrong');
			//redirect(DASHBOARD, 'refresh');
		}
	}

	public function sendFeedback()
	{
		if (
			$this->input->post('txtPostDescription') != "" &&
			$this->input->post('txtPostID') != ""
		) {

			$prop = array(
				'postID'     			   =>  filter_var($this->input->post('txtPostID'), FILTER_SANITIZE_NUMBER_INT),
				'trainingContentFlag1'     =>  filter_var($this->input->post('rbtnTrainingContentFlag1'), FILTER_SANITIZE_NUMBER_INT),
				'trainingContentFlag2'     =>  filter_var($this->input->post('rbtnTrainingContentFlag2'), FILTER_SANITIZE_NUMBER_INT),
				'trainingContentFlag3'     =>  filter_var($this->input->post('rbtnTrainingContentFlag3'), FILTER_SANITIZE_NUMBER_INT),
				'trainingContentFlag4'     =>  filter_var($this->input->post('rbtnTrainingContentFlag4'), FILTER_SANITIZE_NUMBER_INT),
				'trainingContentFlag5'     =>  filter_var($this->input->post('rbtnTrainingContentFlag5'), FILTER_SANITIZE_NUMBER_INT),
				'trainingContentFlag6'     =>  filter_var($this->input->post('rbtnTrainingContentFlag6'), FILTER_SANITIZE_NUMBER_INT),
				'facultyFlag1'         	   =>  filter_var($this->input->post('rbtnFacultyFlag1'), FILTER_SANITIZE_NUMBER_INT),
				'facultyFlag2'             =>  filter_var($this->input->post('rbtnFacultyFlag2'), FILTER_SANITIZE_NUMBER_INT),
				'facultyFlag3'             =>  filter_var($this->input->post('rbtnFacultyFlag3'), FILTER_SANITIZE_NUMBER_INT),
				'facultyFlag4'             =>  filter_var($this->input->post('rbtnFacultyFlag4'), FILTER_SANITIZE_NUMBER_INT),
				'facultyFlag5'             =>  filter_var($this->input->post('rbtnFacultyFlag5'), FILTER_SANITIZE_NUMBER_INT),
				'usefulAspect'          	=> $this->input->post('txtPostDescription', true),
				'employeeID'     		   =>  filter_var($this->session->userdata['employeeID'], FILTER_SANITIZE_NUMBER_INT),
				'createdByUserID'          =>  filter_var($this->session->userdata['employeeID'], FILTER_SANITIZE_NUMBER_INT)
			);

			$bool = $this->CommonModel->insertRecord('tbltrainingfeedback', $prop);

			if ($bool == 1) {
				// Add activity log start
				$prop = array(
					'description'		=>  "Training Feedback : Added (employeeID : " . filter_var($this->session->userdata['employeeID'], FILTER_SANITIZE_NUMBER_INT) . " - trainingFeedbackID : " . $this->db->insert_id() . ")",
					'createdByUserID'   =>  filter_var($this->session->userdata['employeeID'], FILTER_SANITIZE_NUMBER_INT),
					'applicationFlag'   =>  '1'
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end

				$this->session->set_userdata('toastrSuccess', ' Training feedback sended successfully...');
				redirect(SHOW_TRAINING_POSTS_FRONT . "/" . $this->input->post('txtJobPostID'), 'refresh');
			} else {
				$this->session->set_userdata('toastrError', 'Data was not saved!');
				redirect(SHOW_TRAINING_POSTS_FRONT . "/" . $this->input->post('txtJobPostID'), 'refresh');
			}
		} else {
			$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
			redirect(SHOW_TRAINING_POSTS_FRONT . "/" . $this->input->post('txtJobPostID'), 'refresh');
		}
	}
	
	public function demo(){
	    	$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		$headerData = array(
			'firstHeading' 		=> 'About Us',
			'secoundHeading' 	=> 'About Us'
		);

		$this->load->view('frontend/demo', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	function authenticateUser()
	{
		$recaptcha = $_POST['g-recaptcha-response'];  
    	$secret_key = '6LenUIspAAAAAPSl2s-SwAvBzh4MGIo0cN7MurPC';   
    // 	$secret_key = '6LdxJWYpAAAAAGmLur-GmiAfWEzPnZfSm8UIuu1f';   
    	$url = 'https://www.google.com/recaptcha/api/siteverify?secret='
          . $secret_key . '&response=' . $recaptcha;   
    	$response = file_get_contents($url);
    	$response = json_decode($response); 
		if ($this->input->post('username') != "" && $this->input->post('password') != "" && $response->success == true) {
			$result = $this->login->checkAuthorLogin($this->input->post('username'), $this->input->post('password'));			

			if (!empty($result)) {
				
				$this->session->set_userdata('username', $this->input->post('username'));
				$this->session->set_userdata('authorMailID', $result[0]['email']);
				$this->session->set_userdata('profilePhoto', $result[0]['authorPhoto']);
				$this->session->set_userdata('name', $result[0]['name']);
				$this->session->set_userdata('contactNumber', $result[0]['contactNumber']);
				$this->session->set_userdata('authorID', $result[0]['authorID']);
				
				// Add activity log start
				$prop = array(
					'description'		=>  "Login Author (authorID : " . $result[0]['authorID'] . " - Username : " . $this->input->post('txtUserName') . ")",
					'createdByUserID'   =>  $this->session->userdata['authorID']
				);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				echo json_encode(array('status'=>'success','msg'=>'Login Successfully'));

				// redirect(HOME, 'refresh');
			} else {
				echo json_encode(array('status'=>'error','msg'=>'Username/ Password wrong..'));
				// $this->session->set_userdata('toastrError', 'Username/ Password wrong..');
				// redirect('login', 'refresh');
			}
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Please fill all details...'));
		}
	}
	public function sendMail()
	{

		$msg = "First line of text\nSecond line of text";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg, 70);

		// send email
		mail("deshmukhr.2021@gmail.com", "My subject", $msg);



		// Load the email library
		$this->load->library('email');

		// Set up the email configuration
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_port'] = 587;
		$config['smtp_user'] = 'deshmukhr.2021@gmail.com';
		$config['smtp_pass'] = 'xcd120@123';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';

		// Initialize the email library with the configuration
		$this->email->initialize($config);

		// Set the email content
		$this->email->from('deshmukhr.2021@gmail.com', 'thyssenkrupp');
		$this->email->to('deshmukhr.2021@gmail.com');
		$this->email->subject('Subject of your email');
		$this->email->message('Body of your email');

		// Send the email
		if ($this->email->send()) {
			echo 'Email sent successfully.';
		} else {
			show_error($this->email->print_debugger());
		}
	}
	public function checkPlagarismForm(){
	    
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		$headerData = array(
			'firstHeading' 		=> 'Check Plagiarism',
			'secoundHeading' 	=> 'Check Plagiarism'
		);
		$this->load->view('frontend/check-plagarism', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}

	public function createOrder(){
		$ext = substr(strrchr($_FILES['file']['name'], '.'), 1);
		$allowedExtensions = array('doc', 'docx');
		if (!in_array(strtolower($ext), $allowedExtensions)) {
			echo json_encode(array('status' => 'error', 'msg' => 'Only Word documents (.doc, .docx) are allowed.'));
			return;
		}
		$checkFileName = "plagarism-check-" . date('YmdHis') . "." . $ext;
		$target_file    = UPLOAD_CHECKPLAGA . $checkFileName;

		if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
		} else {
			echo json_encode(array('status'=>'error','msg'=>'Problem uploading file...'));	die;				
		}
		
			
		$razorPayId = $_POST['razorpay_payment_id'];
		
		$ch = curl_init('https://api.razorpay.com/v1/payments/' . $razorPayId);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: Basic ' . base64_encode("rzp_live_RrBi1HZrzuThWM" . ":" . "jS23RvFmG9E2zPG37X33rcTo")
		));	
		
		$response = curl_exec($ch);
		if ($response === false) {
			$error = curl_error($ch);			
			echo "cURL Error: " . $error;
		} else {		
			$responseData = json_decode($response, true);	
			
			if ($responseData === null) {				
				echo "Error decoding JSON response";
			} else {
				// 
			}
		}		
		
// 		echo "<pre>";print_r($responseData);echo "</pre>";die;
		curl_close($ch);
		$insertData = array('name'=>$this->input->post('name'),'email'=>$this->input->post('email'),'product_id' =>$this->input->post('product_id'), 'payment_id' => $_POST['razorpay_payment_id'], 'contact' => $_POST['phone_number'],'no_of_pages'=>$_POST['no_of_pages'],'file'=>$checkFileName,'status'=>'success','payment_response'=>$response,'completed_status'=>'Pending');
		if($responseData['status'] == 'authorized')
		{
   
            $insertResult	= $this->CommonModel->insertRecord('tbl_check_plagarism',$insertData);
			if($insertResult){
			    $email = $this->input->post('email');
				if(!empty($email)){
				//	sendMail('Your Plagiarism Report is on the Way!','Dear '.trim($_POST['name']).' <br><br> Thank you for submitting your file for plagiarism checking. We have received your payment, and your report is being generated. You will receive the completed report shortly.<br><br>If you have any questions in the meantime, please feel free to contact us.<br><br>Regards,<br>Co-ordinator<br> IJPS Journal<br>editor@ijpsjournal.com',$email,0,'','');
					
					$this->load->library('emaillib');
                    $mail = $this->emaillib->load();
                    $mail->addAddress('editor@ijpsjournal.com');
                    $mail->addAddress($email);
                    $mail->Subject = 'Your Plagiarism Report is on the Way!';
                    $mail->Body ='Dear '.trim($_POST['name']).' <br><br> Thank you for submitting your file for plagiarism checking. We have received your payment, and your report is being generated. You will receive the completed report shortly.<br><br>If you have any questions in the meantime, please feel free to contact us.<br><br>Regards,<br>Co-ordinator<br> IJPS Journal<br>editor@ijpsjournal.com';
                    $mail->send();
				}
				echo json_encode(array('status'=>'success','msg'=>'Payment successfully completed.'));
			}
		}else{	
		    	$insertData = array('name'=>$this->input->post('name'),'email'=>$this->input->post('email'),'product_id' =>$this->input->post('product_id'), 'payment_id' => $_POST['razorpay_payment_id'], 'contact' => $_POST['phone_number'],'no_of_pages'=>$_POST['no_of_pages'],'file'=>$checkFileName,'status'=>'failed','payment_response'=>$response);
		    	$insertResult	= $this->CommonModel->insertRecord('tbl_check_plagarism',$insertData);
			echo json_encode(array('status'=>'error','msg'=>'Payment failed...'));			
		}
	}

	public function referenceBooks(){
	    
	    
		$blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		$headerData = array(
			'firstHeading' 		=> 'Reference Books',
			'secoundHeading' 	=> 'Reference Books'
		);
		$this->load->view('frontend/reference-books', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
	}
	
	
	
    public function pageConfigReference( $search_query){  
	  
       	 $config3 = array();
         $config3["base_url"] = base_url() . "HomeController/referenceBook";
         $config3["total_rows"] = $this->ArticleModel->getCountReferece( $search_query);
         $config3["per_page"] = 12;
         $config3["uri_segment"] = 3;
         $config3['full_tag_open'] = '<div class="pagination-area">';
         $config3['full_tag_close'] = '</div>';
         $config3['num_tag_open'] = '<span class="page-numbers">';
         $config3['num_tag_close'] = '</span>';
         $config3['cur_tag_open'] = '<span class="page-numbers current" aria-current="page">';
         $config3['cur_tag_close'] = '</span>';
        //  $config['prev_tag_open'] = '<li>';
        //  $config['prev_tag_close'] = '</li>';
        //  $config['first_tag_open'] = '<li>';
        //  $config['first_tag_close'] = '</li>';
        //  $config['last_tag_open'] = '<li>';
        //  $config3['last_tag_close'] = '</li>';
         $config3['prev_link'] = '<span class="page-numbers" aria-current="page"><i class="bx bx-chevrons-left"></i></span>';
        //  $config3['prev_tag_open'] = ' <a href="#" class="prev page-numbers"><i class="bx bx-chevrons-left">';
        //  $config3['prev_tag_close'] = '</i></a>';
         $config3['next_link'] = '<span class="page-numbers" aria-current="page"><i class="bx bx-chevrons-right"></i></span>';
        //  $config3['next_tag_open'] = '<a href="javascript:void(0)" class="next page-numbers"><i class="bx bx-chevrons-right">';
        //  $config3['next_tag_close'] = '</i></a>';
         $this->per_page_reference=$config3["per_page"]; 
         $this->pagination->initialize($config3);        
    }
	
	public function referenceBook(){
	     $search_query = $this->input->post('search_queyr');
	    $this->pageConfigReference( $search_query);
	    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	    $blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
// 		$referenceList	= $this->CommonModel->getDataLimit('tbl_reference_books', array('is_deleted' => '0'), '', '', '', '', '', 'id ', 'DESC');
	
	
		   
	
		  $referenceList = $this->ArticleModel->referencelist($this->per_page_reference, $page, $search_query);
		

		$headerData = array(
			'firstHeading' 		=> 'Reference Books',
			'secoundHeading' 	=> 'Reference Books'
		);
		$this->load->view('frontend/reference-book',  ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult,'referenceList'=>$referenceList,'pagination_links' => $this->pagination->create_links()]);
	}
	
	    public function viewBooks($id) {
	      
	       
	        $blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
    		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
    		$tbl_reference_books	= $this->CommonModel->getDataLimit('tbl_reference_books', array('is_deleted' => '0','id'=>$id), '', '', '', '', '', 'id  ', 'DESC');

    		$headerData = array(
    			'firstHeading' 		=> 'View Book',
    			'secoundHeading' 	=> 'View Book'
    		);

            $this->db->where('id !=', $id); 
            $this->db->order_by('id', 'RANDOM'); 
            $query = $this->db->get('tbl_reference_books'); 
            $result = $query->result_array(); 
           
           
           
  $this->load->view('frontend/reference-books',  ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult,'bookList'=>$tbl_reference_books,'randomBooks'=> $result]);
            
        }
        
        public function pay_indian(){
            $blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
    		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
    	

    		$headerData = array(
    			'firstHeading' 		=> 'Article Processing Charges',
    			'secoundHeading' 	=> 'Pay Fees'
    		);
           
           
           
            $this->load->view('pay-fees/indian/index',  ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
        }
        
        public function pay_international_view(){
            
           
            
            $blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
    		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');
    // 		$tbl_reference_books	= $this->CommonModel->getDataLimit('tbl_reference_books', array('is_deleted' => '0','id'=>$id), '', '', '', '', '', 'id  ', 'DESC');

    		$headerData = array(
    			'firstHeading' 		=> 'Article Processing Charges',
    			'secoundHeading' 	=> 'Pay Fees'
    		);

          
           
           
           
  $this->load->view('pay-fees/international/index',  ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
        }
        
        public function acceptChargesFees(){
	
		$articleID = $this->input->post('article_id');
		$articleID = str_replace("IJPS/","",$this->input->post('article_id'));
		$razorPayId = $this->input->post('razorpay_payment_id');
		$ch = curl_init('https://api.razorpay.com/v1/payments/' . $razorPayId);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authorization: Basic ' . base64_encode("rzp_live_RrBi1HZrzuThWM" . ":" . "jS23RvFmG9E2zPG37X33rcTo")
		));	
		
		$response = curl_exec($ch);
		if ($response === false) {
			$error = curl_error($ch);			
			echo "cURL Error: " . $error;
		} else {		
			$responseData = json_decode($response, true);	
			
			if ($responseData === null) {				
				echo "Error decoding JSON response";
			} else {
			
			}
		}		
		curl_close($ch);
	
		$insertData = array('article_id' => $articleID ,'json_details'=>json_encode($responseData),'user_details'=>json_encode($this->input->post()));
		if($responseData['status'] == 'authorized')
		{
		   
			 $insertResult = $this->CommonModel->insertRecord('tbl_payment_details',$insertData);
		
			    if($insertResult){
			       $data = array(
                    'statusID' => '3',
                    'payment_date'=>date('Y-m-d H:i:s')
                );
                $this->db->where('uniqueCode', $articleID); 
                $this->db->update('ijps_tblmanuscript', $data);
			
				echo json_encode(array('status'=>'success','msg'=>'Payment successfully completed.'));
			}
		}else{			
			echo json_encode(array('status'=>'error','msg'=>'Payment failed...'));			
		}
	}
	
	public function pay_international(){
	   
	    require APPPATH.'views/razor/Razorpay.php';
	    require APPPATH.'views/razor/src/Api.php';
	    $api_key = 'rzp_live_RrBi1HZrzuThWM'; 
        $api_secret = 'jS23RvFmG9E2zPG37X33rcTo'; 
        $api = new Razorpay\Api\Api($api_key, $api_secret);
        $amount = $this->input->post('amount'); 
        $name = $this->input->post('name');
        $email = $this->input->post('email');
    	$articleID = $this->input->post('article_id');
    	$phone_number = $this->input->post('phone_number');
	   
        $currency = 'USD';
        $description = 'Article Processing Charges';
        $image = 'https://www.ijpsjournal.com/assetsbackoffice/uploads/logo/websiteLogo-20231230195421.jpg';
        
        $receipt_id = uniqid();
        
        $order = $api->order->create([
            'receipt' => $receipt_id,
            'amount' => $amount * 100, 
            'currency' => $currency,
        ]);
        
        // $order_id = $order->id;
        $response = [
            'key' => $api_key,
            'amount' => $amount * 100,
            'currency' => $currency,
            'name' => 'IJPS Journal',
            'description' => $description,
            'image' => $image,
            'article_id'=>$articleID,
            'prefill' => [
                'name' => $name,
                'email' => $email,
                'phone_number' => $phone_number,
            ]
        ];
        
        
        header('Content-Type: application/json');
        
        echo json_encode($response);
	}
	
	public function saveInternationalPayment(){
	    
    	$response = $this->input->post('response');
    	$articleID = $response['article_id'];
	    $articleID = str_replace("IJPS/","",$articleID);
	    
	    $storeArray = array('amount'=>$response['amount'],'name'=>$response['prefill']['name'],'article_id'=>$articleID,'email'=>$response['prefill']['email'],'phone_number'=>$response['prefill']['phone_number']);
    	$insertData = array('article_id' => $articleID ,'json_details'=>json_encode($response),'type'=>'International','user_details'=>json_encode($storeArray));
		$insertResult = $this->CommonModel->insertRecord('tbl_payment_details',$insertData);
		
		if($insertResult){
	       $data = array(
                    'statusID' => '3',
                    'payment_date'=>date('Y-m-d H:i:s')
                );
            $this->db->where('uniqueCode', $articleID); 
            $this->db->update('ijps_tblmanuscript', $data);
           
		}
	}
	
	public function referralprogram() {
	    
	    $blogMenuResult	= $this->CommonModel->getDataLimit('ijps_tblblogcategory', array('isActive' => '1'), '', '', '', '', '', 'blogCategoryName ', 'ASC');
		$settingResult	= $this->CommonModel->getDataLimit('tblsetting', array('isActive' => '1'), '', '', '', '', '', 'settingID  ', 'ASC');

		$headerData = array(
			'firstHeading' 		=> 'Referral Program',
			'secoundHeading' 	=> 'Referral Program'
		);

        $this->load->view('frontend/referral-program', ['headerData' => $headerData, 'blogMenuResult' => $blogMenuResult, 'settingResult' => $settingResult]);
    }
        
    
}

?>

