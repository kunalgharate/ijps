<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Receviedmanuscript extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
         
        if($this->session->userdata('userFullName') == ""|| $this->session->userdata('mailID') == "")
        {
            redirect(BACKOFFICE.'LoginController', 'refresh');
        } 	
        $this->load->model(BACKOFFICE.'Manuscriptmodel', 'ManuscriptModel');
        	$this->load->model(BACKOFFICE.'Articlemodel', 'ArticleModel');
        
	}

    public function index(){
        $result['data']       = $this->ManuscriptModel->getManuscripts();
     //   print_r($result['data'][0]);
    //    die;
       // $result['id'] = 0;
        $this->load->view('backoffice/rececived_manuscript',$result);        
    }

    
    	public function getManuscript()
	{
	   
	   $draw = intval($this->input->get("draw"));
	   $start = intval($this->input->get("start"));
	   $length = intval($this->input->get("length"));
 
 
	   $query = $this->ManuscriptModel->getManuscriptsN();
 
 
	   $data = [];
 
	   
	   foreach($query as $v) {
		$statusName='';
		$addArticle='';
		$payment_date ='';
			if($v['payment_date']!='' && $v['payment_date']!='0000-00-00 00:00:00' && $v['statusID'] == "3"){
				$payment_date =$v['payment_date'];
			}
		
						if($v['statusID']=='4')
			{
				$statusName = '<div class="badge badge-success text-white" onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')" style="cursor:pointer">'.$v['statusName'].'</div>';


			}elseif($v['statusID']=='3'){
				$statusName = '<div class="badge  text-white"  onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')" style="cursor:pointer;background-color: #3E97FF;">'.$v['statusName'].'</div>';
				$addArticle = '  <a href="'.site_url(BACKOFFICE."article/".$v['manuscriptID']).'" class="btn btn-sm btn-clean btn-icon mr-2" title="Add Article">
				<i class="fa fa-plus"></i>
			</a>';
					
			}else if($v['statusID']=='2'){
				$statusName = '<div class="badge badge-danger text-white"  onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')" style="cursor:pointer">'.$v['statusName'].'</div>';
			
			}elseif($v['statusID']=='1'){
				$statusName = '<div class="badge badge-warning text-white"  onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')" style="cursor:pointer">'.$v['statusName'].'</div>';
			
			}elseif($v['statusID']=='5'){
				$statusName = '<div class="badge badge-dark text-white" style="cursor:pointer;" onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')">'.$v['statusName'].'</div>';
			}
			$downloadUrl = base_url("assetsbackoffice/uploads/manuscript/" . $v['document']);  // Construct download URL
			$deleteUrl =  base_url("backoffice/manuscript/deleteData/" . $v['manuscriptID']); // Construct delete URL with ID (assuming ID is in $v['id'])

	            $data[] = array(
					$v['manuscriptID'],
					'IJPS/'.$v['uniqueCode'],
					$v['authorName']."<br>".$v['email']."<br>".$v['contactNumber'],
					$v['titleOfPaper'],
					$v['articalTypeName'],
					$v['countryName'],
					$v['created_date'],
					$statusName ."<br>".$payment_date,
					'<a href="'. $downloadUrl.'" download=""><i class="fa fa-cloud-download-alt" style="color: #009ef7 !important;"></i></a> <a href="javascript:void(0);" onclick="deleteRecord('.$v['manuscriptID'].');" class="btn btn-sm btn-clean btn-icon mr-2" title="Delete Record permanently">
					<i class="far fa-trash-alt"></i> '.$addArticle.'
				</a>'
				);
		}
 
	 
	   $result = array(
				"draw" => $draw,
				  "recordsTotal" => count($query),
				  "recordsFiltered" => count($query),
				  "data" => $data
			 );
 
 
	   echo json_encode($result);
	   exit();
	}
	public function getManuscript_bkk()
	{

	   $draw = intval($this->input->get("draw"));
	   $start = intval($this->input->get("start"));
	   $length = intval($this->input->get("length"));
 
 
	   $query = $this->ManuscriptModel->getManuscriptsN();
 
 
	   $data = [];
 
	   
	   foreach($query as $v) {
		$statusName='';
		$addArticle='';
		$payment_date ='';
			if($v['payment_date']!='' && $v['payment_date']!='0000-00-00 00:00:00' && $v['statusID'] == "3"){
				$payment_date =$v['payment_date'];
			}
		
						if($v['statusID']=='4')
			{
				$statusName = '<div class="badge badge-success text-white" onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')" style="cursor:pointer">'.$v['statusName'].'</div>';


			}elseif($v['statusID']=='3'){
				$statusName = '<div class="badge  text-white"  onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')" style="cursor:pointer;background-color: #3E97FF;">'.$v['statusName'].'</div>';
				$addArticle = '  <a href="'.site_url(BACKOFFICE."article/".$v['manuscriptID']).'" class="btn btn-sm btn-clean btn-icon mr-2" title="Add Article">
				<i class="fa fa-plus"></i>
			</a>';
					
			}else if($v['statusID']=='2'){
				$statusName = '<div class="badge badge-danger text-white"  onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')" style="cursor:pointer">'.$v['statusName'].'</div>';
			
			}elseif($v['statusID']=='1'){
				$statusName = '<div class="badge badge-warning text-white"  onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')" style="cursor:pointer">'.$v['statusName'].'</div>';
			
			}elseif($v['statusID']=='5'){
				$statusName = '<div class="badge badge-dark text-white" style="cursor:pointer;" onclick="openModal('.$v['statusID'].','.$v['manuscriptID'].','.$v['uniqueCode'].',\''.$v['created_date'].'\',\''.$v['email'].'\')">'.$v['statusName'].'</div>';
			}
			$downloadUrl = base_url("assetsbackoffice/uploads/manuscript/" . $v['document']);  // Construct download URL
			$deleteUrl =  base_url("backoffice/manuscript/deleteData/" . $v['manuscriptID']); // Construct delete URL with ID (assuming ID is in $v['id'])

	$data[] = array(
					$v['manuscriptID'],
					'IJPS/'.$v['uniqueCode'],
					$v['authorName']."<br>".$v['email']."<br>".$v['contactNumber'],
					$v['titleOfPaper'],
					$v['articalTypeName'],
					$v['countryName'],
					$v['created_date'],
					$statusName ."<br>".$payment_date,
					'<a href="'. $downloadUrl.'" download=""><i class="fa fa-cloud-download-alt" style="color: #009ef7 !important;"></i></a> <a href="javascript:void(0);" onclick="deleteRecord('.$v['manuscriptID'].');" class="btn btn-sm btn-clean btn-icon mr-2" title="Delete Record permanently">
					<i class="far fa-trash-alt"></i> '.$addArticle.'
				</a>'
				);
		}
 
	 
	   $result = array(
				"draw" => $draw,
				  "recordsTotal" => count($query),
				  "recordsFiltered" => count($query),
				  "data" => $data
			 );
 
 
	   echo json_encode($result);
	   exit();
	}
	
	
		public function authorsInfoList(){
	
		      
        $this->load->view('backoffice/manuscriptInfoList'); 
		
					
	}
	public function manuscriptauthorsInfoList()
	{

	   $draw = intval($this->input->get("draw"));
	   $start = intval($this->input->get("start"));
	   $length = intval($this->input->get("length"));
 
 
	   $query = $this->ManuscriptModel->getManuscriptsinfo();
 
 
	   $data = [];
 
	   
	   foreach($query as $v) {

		$data[] = array(
					'<i class="fa fa-eye"  onclick="showCoAuthor('.$v['manuscriptInfoID'].');" style="color: #3E97FF;!important;cursor:pointer"></i>
                     '.$v['manuscriptInfoID'],
					'IJPS/'.$v['articleID'],
					"<a href='".base_url().UPLOAD_ARTICLE."/".$v['copyrightform']."' title='Copyright Form' target='_blank'>
					<div class='badge badge-primary text-white' style='background-color: #3E97FF;!important'>VIEW</div>
				</a>",
					"<a href='".base_url().UPLOAD_ARTICLE."/".$v['paymentreceipt']."' title='Payment Receipt' target='_blank'>
					<div class='badge badge-primary text-white' style='background-color: #3E97FF;!important'>VIEW</div>
				</a>",
					$v['authorName'],
					$v['authorEmail'],
					$v['authorAffiliation'],				

					" <img alt='image' src='".base_url().'assetsbackoffice/uploads/author/'.$v['authorPhoto']."' width='100px' class='mr-3'>",
					"<a href= '".base_url().'assetsbackoffice/uploads/author/'.$v['authorPhoto']."' download><i class='fa fa-cloud-download-alt text-primary1 mt-3' style='color: #3E97FF;!important'></i></a> <a href='".site_url(BACKOFFICE.'manuscript/changeManuscriptArticleID/'.$v['manuscriptInfoID'])."'  class='btn btn-sm' title='Edit'><i class='fa fa-edit text-primary1' style='color: #3E97FF;!important'></i></a>"
				);
		}
 
	 
	   $result = array(
				"draw" => $draw,
				  "recordsTotal" => count($query),
				  "recordsFiltered" => count($query),
				  "data" => $data
			 );
 
 
	   echo json_encode($result);
	   exit();
	}
    
    public function manageArticleListRM()
	{
	    ini_set('memory_limit', '0');

	   $draw = intval($this->input->get("draw"));
	   $start = intval($this->input->get("start"));
	   $length = intval($this->input->get("length"));
 
 
	   $query = $this->ArticleModel->getArticles();
 
 
	   $data = [];
 
	   
	   foreach($query as $v) {
		if($v['featuredArticleFlag'] == "0")
		{
			$isFetureId =  "No";
		}
		else
		{
			$isFetureId = "Yes";
		}
		if($v['isActive'] == '0')
		{
			$icon = "far fa-eye-slash";
			$tooltiptext = "Activate";
		}
		else
		{
			$icon = "far fa-eye";
			$tooltiptext = "Deactivate";
		}

			$data[] = array(

				"IJPS/" . $v['articleID'],
				"IJPS/" . $v['uniqueCode'],
				$isFetureId,
				"<a href='" . base_url() . UPLOAD_ARTICLE . $v['document'] . "' download><i class='fa fa-cloud-download-alt text-primary1 mt-3' style='color: #3E97FF;!important;cursor:pointer'></i>
				</a>",
				$v['articalTypeID'],
				$v['titleOfPaper'],
				$v['createdDate'],
				$v['doi'],
				$v['keywords'],
				$v['citation'],

				" <a href='" . site_url(BACKOFFICE . 'updatearticle/' . $v['articleID']) . "' class='btn btn-sm btn-clean btn-icon mr-2' title='Edit Details'>
					<i class='far fa-edit'></i>
								</a> <a href='" . site_url(BACKOFFICE . 'article/setVisibility/' . $v['articleID'] . "/" . $v['isActive']) . "' title='".$tooltiptext."' class='btn btn-sm btn-clean btn-icon mr-2' >
								<i class='".$icon."'></i>
					</a>  <a href='" . site_url(BACKOFFICE . 'article/deleteData/' . $v['articleID']) . "' onclick='return confirm(\"Are you sure you want to delete this item?\")' class='btn btn-sm btn-clean btn-icon mr-2' title='Delete Record permanently'>
					<i class='far fa-trash-alt'></i>
				</a>"
			);
		}
 
	 
	   $result = array(
				"draw" => $draw,
				  "recordsTotal" => count($query),
				  "recordsFiltered" => count($query),
				  "data" => $data
			 );
 
 
	   echo json_encode($result);
	   exit();
	}

	public function manageArticleList()
	{
		ini_set('memory_limit', '0');

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->get("length"));

		// Get paginated records
		$articles = $this->ArticleModel->getArticles($start, $length);
		// Get total records for pagination
		$totalRecords = $this->ArticleModel->countAllArticles();

		$data = [];

		foreach ($articles as $v) {
			$isFetureId = ($v['featuredArticleFlag'] == "0") ? "No" : "Yes";
			$icon = ($v['isActive'] == '0') ? "far fa-eye-slash" : "far fa-eye";
			$tooltiptext = ($v['isActive'] == '0') ? "Activate" : "Deactivate";

			$data[] = array(
				"IJPS/" . $v['articleID'],
				"IJPS/" . $v['uniqueCode'],
				$isFetureId,
				"<a href='" . base_url() . UPLOAD_ARTICLE . $v['document'] . "' download><i class='fa fa-cloud-download-alt text-primary1 mt-3' style='color: #3E97FF;!important;cursor:pointer'></i></a>",
				$v['articalTypeID'],
				$v['titleOfPaper'],
				$v['createdDate'],
				$v['doi'],
				$v['keywords'],
				$v['citation'],
				"<a href='" . site_url(BACKOFFICE . 'updatearticle/' . $v['articleID']) . "' class='btn btn-sm btn-clean btn-icon mr-2' title='Edit Details'><i class='far fa-edit'></i></a>
				<a href='" . site_url(BACKOFFICE . 'article/setVisibility/' . $v['articleID'] . "/" . $v['isActive']) . "' title='" . $tooltiptext . "' class='btn btn-sm btn-clean btn-icon mr-2'><i class='" . $icon . "'></i></a>
				<a href='" . site_url(BACKOFFICE . 'article/deleteData/' . $v['articleID']) . "' onclick='return confirm(\"Are you sure you want to delete this item?\")' class='btn btn-sm btn-clean btn-icon mr-2' title='Delete Record permanently'><i class='far fa-trash-alt'></i></a>"
			);
		}

		$result = array(
			"draw" => $draw,
			"recordsTotal" => $totalRecords,
			"recordsFiltered" => $totalRecords,
			"data" => $data
		);

		header('Content-Type: application/json');
		echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		exit();
	}
	
	public function customArticleList()
    {
		// CSRF Protection
		if (!$this->security->csrf_verify()) {
			log_message('error', 'CSRF token mismatch in customArticleList');
			echo json_encode(['error' => 'Security token mismatch']);
			return;
		}
		
		// Input validation and sanitization
        $page = filter_var($this->input->post('page'), FILTER_VALIDATE_INT);
        $search = trim($this->input->post('search', true));
		$statusFilter = $this->input->post('status_filter', true);
		$featuredFilter = $this->input->post('featured_filter', true);
        
		// Validate page number
		if ($page === false || $page < 1) {
			$page = 1;
		}
		
		// Validate and sanitize search term
		if (!empty($search)) {
			$search = preg_replace('/[<>\"\'&]/', '', $search);
			if (strlen($search) > 100) {
				$search = substr($search, 0, 100);
			}
		}
		
        $limit = 10;
        $offset = ($page - 1) * $limit;
		
		// Build filters array
		$filters = [];
		if (!empty($statusFilter) && in_array($statusFilter, ['0', '1'])) {
			$filters['isActive'] = $statusFilter;
		}
		if (!empty($featuredFilter) && in_array($featuredFilter, ['0', '1'])) {
			$filters['featuredArticleFlag'] = $featuredFilter;
		}
    
        try {
			$articles = $this->ArticleModel->getCustomArticlesPaginated($limit, $offset, $search, $filters);
			$total = $this->ArticleModel->countCustomArticles($search, $filters);
			$totalPages = ceil($total / $limit);
		
			$data = [];
			foreach ($articles as $index => $v) {
				// Sanitize all output data
				$articleData = [
					'articleID' => 'IJPS/' . htmlspecialchars($v['articleID'], ENT_QUOTES, 'UTF-8'),
					'isFeatured' => ($v['featuredArticleFlag'] == "0") ? "No" : "Yes",
					'document' => $this->generateSecureDownloadLink($v['document']),
					'articleType' => htmlspecialchars($v['articalTypeName'] ?? 'N/A', ENT_QUOTES, 'UTF-8'),
					'title' => htmlspecialchars($v['titleOfPaper'], ENT_QUOTES, 'UTF-8'),
					'publishedDate' => htmlspecialchars($v['createdDate'], ENT_QUOTES, 'UTF-8'),
					'doi' => htmlspecialchars($v['doi'] ?? '', ENT_QUOTES, 'UTF-8'),
					'keywords' => htmlspecialchars($v['keywords'] ?? '', ENT_QUOTES, 'UTF-8'),
					'citation' => htmlspecialchars($v['citation'] ?? '', ENT_QUOTES, 'UTF-8'),
					'actions' => $this->generateSecureActionButtons($v)
				];
				
				$data[] = $articleData;
			}
		
			$response = [
				'articles' => $data,
				'start' => $offset,
				'totalPages' => $totalPages,
				'totalRecords' => $total,
				'currentPage' => $page,
				'csrf_token' => $this->security->get_csrf_hash()
			];
			
			echo json_encode($response);
			
		} catch (Exception $e) {
			log_message('error', 'Error in customArticleList: ' . $e->getMessage());
			echo json_encode(['error' => 'An error occurred while fetching articles']);
		}
    }
	
	/**
	 * Generate secure download link for documents
	 */
	private function generateSecureDownloadLink($document) {
		if (empty($document)) {
			return '<span class="text-muted">No document</span>';
		}
		
		// Validate file exists and is safe
		$filePath = UPLOAD_ARTICLE . $document;
		if (!file_exists($filePath)) {
			return '<span class="text-danger">File not found</span>';
		}
		
		// Generate secure download URL
		$downloadUrl = base_url("backoffice/article/secureDownload/" . urlencode($document));
		return "<a href='" . $downloadUrl . "' class='btn btn-sm btn-outline-primary' title='Download Document'><i class='fa fa-cloud-download-alt'></i></a>";
	}
	
	/**
	 * Generate secure action buttons with proper validation
	 */
	private function generateSecureActionButtons($article) {
		$articleID = filter_var($article['articleID'], FILTER_VALIDATE_INT);
		if (!$articleID) {
			return '<span class="text-danger">Invalid ID</span>';
		}
		
		$isActive = $article['isActive'];
		$visibilityIcon = ($isActive == '0') ? 'far fa-eye-slash' : 'far fa-eye';
		$visibilityTitle = ($isActive == '0') ? 'Activate' : 'Deactivate';
		
		$actions = '';
		
		// Edit button
		$editUrl = site_url(BACKOFFICE . 'updatearticle/' . $articleID);
		$actions .= "<a href='" . $editUrl . "' class='btn btn-sm btn-outline-primary btn-action' title='Edit Details'>";
		$actions .= "<i class='far fa-edit'></i></a> ";
		
		// Visibility toggle button
		$visibilityUrl = site_url(BACKOFFICE . 'article/setVisibility/' . $articleID . "/" . $isActive);
		$actions .= "<a href='" . $visibilityUrl . "' title='" . $visibilityTitle . "' class='btn btn-sm btn-outline-warning btn-action'>";
		$actions .= "<i class='" . $visibilityIcon . "'></i></a> ";
		
		// Delete button with confirmation
		$deleteUrl = site_url(BACKOFFICE . 'article/deleteData/' . $articleID);
		$actions .= "<a href='" . $deleteUrl . "' onclick='return confirmDelete(\"" . htmlspecialchars($article['titleOfPaper'], ENT_QUOTES) . "\")' ";
		$actions .= "class='btn btn-sm btn-outline-danger btn-action' title='Delete Record'>";
		$actions .= "<i class='far fa-trash-alt'></i></a>";
		
		return $actions;
	}



	public function manageArticleView(){
	
	       
        $this->load->view('backoffice/manageArticleList'); 
		
					
	}
 
   

   
}