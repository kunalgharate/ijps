<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class ArticleModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
		
		function getAuthorsWithDesignations($articleID)
        {
			$this->db->select("*");	
            $this->db->order_by('designationID', 'ASC');
            $result = $this->db->get('ijps_tblarticalauthor');
            $this->db->where("articleID", $articleID);
            $this->db->where("isActive", '1');
            return $result->result_array();
        }
        
		function getVolumeDetails()
        {
			$this->db->select("EXTRACT(year from `createdDate`) as year");	
            $this->db->group_by('year');
            $this->db->order_by('articleID', 'ASC');
            $result = $this->db->get('ijps_tblarticle');
            return $result->result_array();
        }
		
		function getIssueDetails($prop)
        {
			$this->db->select("EXTRACT(month from `createdDate`) as month");	
            $this->db->group_by('month');
			$this->db->where("EXTRACT(year from createdDate)=", $prop);
            $result = $this->db->get('ijps_tblarticle');
            return $result->result_array();
        }
        
        function getAcceptedDate($prop)
        {
			$this->db->select("created_data");	
            
			$this->db->where("is_deleted", '0');
			$this->db->where("articleId", $prop);
            $result = $this->db->get('tbl_reviewpoint');
             $resultData = $result->result_array();
             if(is_array($resultData )){
                 return $resultData[0];
             }else{
                 
            return array(); 
             }
           
            
        }
        
		function getArticalesGridNew($prop1, $prop2,$per_page,$page)
        {
			$this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName");	
			///////////////$this->db->join('ijps_tblmanuscript', 'ijps_tblmanuscript.manuscriptID = ijps_tblarticle.manuscriptID');
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			$this->db->where("EXTRACT(year from ijps_tblarticle.createdDate)=", $prop1);
			$this->db->where("EXTRACT(month from ijps_tblarticle.createdDate)=", $prop2);
			$this->db->where("ijps_tblarticle.isActive",'1');

            $this->db->limit($per_page, $page);
            $this->db->order_by('articleID', 'desc');

           
            $result = $this->db->get('ijps_tblarticle');
            return $result->result_array();

        }
        
        function getCount($prop1, $prop2)
        {
			$this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName");	
			///////////////$this->db->join('ijps_tblmanuscript', 'ijps_tblmanuscript.manuscriptID = ijps_tblarticle.manuscriptID');
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			$this->db->where("EXTRACT(year from ijps_tblarticle.createdDate)=", $prop1);
			$this->db->where("EXTRACT(month from ijps_tblarticle.createdDate)=", $prop2);
            $this->db->order_by('articleID', 'desc');           
            $result = $this->db->get('ijps_tblarticle');
            return count($result->result_array());

        }
		function getArticalesGrid($prop1, $prop2)
        {
			$this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName");	
		
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			$this->db->where("EXTRACT(year from ijps_tblarticle.createdDate)=", $prop1);
			$this->db->where("EXTRACT(month from ijps_tblarticle.createdDate)=", $prop2);
            $this->db->order_by('articleID', 'desc');
           
            $result = $this->db->get('ijps_tblarticle');
            return $result->result_array();
        }
		function getArticalesGridIssueF($prop1, $prop2,$per_page, $page)
        {
			$this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName");	
		
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			$this->db->where("EXTRACT(year from ijps_tblarticle.createdDate)=", $prop1);
			$this->db->where("EXTRACT(month from ijps_tblarticle.createdDate)=", $prop2);
            $this->db->order_by('articleID', 'desc');
            $this->db->limit($per_page, $page);
            $result = $this->db->get('ijps_tblarticle');
            // echo $this->db->last_query();
            return $result->result_array();
        }
		function issueCount($prop1, $prop2)
        {
			$this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName");	
		
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			$this->db->where("EXTRACT(year from ijps_tblarticle.createdDate)=", $prop1);
			$this->db->where("EXTRACT(month from ijps_tblarticle.createdDate)=", $prop2);
            $this->db->order_by('articleID', 'desc');
            echo $this->db->last_query();
            $result = $this->db->get('ijps_tblarticle');
            return count($result->result_array());
        }
		function getCountReferece($search_query='')
        {
			$this->db->select("*");	
            $this->db->order_by('id', 'desc');
            $this->db->where('is_deleted','0');
            if($search_query!=''){
			    $this->db->like('title', $search_query);
                $this->db->or_like('description', $search_query);
			}
            $result = $this->db->get('tbl_reference_books');
            return count($result->result_array());
        }
		function referencelist($per_page, $page, $search_query='')
        {
			$this->db->select("*");	
			$this->db->where('is_deleted',0);
			if($search_query!=''){
			    $this->db->like('title', $search_query);
                $this->db->or_like('description', $search_query);
			}
            $this->db->order_by('id', 'desc');
            $this->db->limit($per_page, $page);
            $result = $this->db->get('tbl_reference_books');
            return $result->result_array();
        }
		function getArticalesGridIssue($prop1, $prop2,$per_page, $page)
        {
			$this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName");	
		
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			$this->db->where("EXTRACT(year from ijps_tblarticle.createdDate)=", $prop1);
			$this->db->where("EXTRACT(month from ijps_tblarticle.createdDate)=", $prop2);
            $this->db->order_by('articleID', 'desc');
            $this->db->limit($per_page, $page);
            $result = $this->db->get('ijps_tblarticle');
            return $result->result_array();
        }
		function getArticalesGridN($limit, $start,$prop1, $prop2)
        {
			$this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName");	
			///////////////$this->db->join('ijps_tblmanuscript', 'ijps_tblmanuscript.manuscriptID = ijps_tblarticle.manuscriptID');
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			$this->db->where("EXTRACT(year from ijps_tblarticle.createdDate)=", $prop1);
			$this->db->where("EXTRACT(month from ijps_tblarticle.createdDate)=", $prop2);
            $this->db->order_by('articleID', 'desc');
            $this->db->limit($limit, $start);
            
            $result = $this->db->get('ijps_tblarticle');
            return $result->result_array();
        }
        public function get_count( $prop1, $prop2) {
            $this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName");   
            $this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
            $this->db->where("EXTRACT(year from ijps_tblarticle.createdDate)=", $prop1);
            $this->db->where("EXTRACT(month from ijps_tblarticle.createdDate)=", $prop2);
            $this->db->order_by('articleID', 'desc'); 
            $query = $this->db->get("ijps_tblarticle");
        
            if ($query->num_rows() > 0) {
                return $query->num_rows();
            }
            return false;
        }
       
    
       
        
        function getArticleSearchold($prop)
        {
            $titleOfPaper = explode(' ', $prop);
            $keywords = explode(' ', $prop);
            
            $where = '';
            foreach ($titleOfPaper as $word) {
                $where .= "titleOfPaper LIKE '%$word%' OR ";
            }
            foreach ($keywords as $word) {
                $where .= "keywords LIKE '%$word%' OR ";
            }
            $where = rtrim($where, 'OR ');
            
            $query = $this->db->query("SELECT * FROM ijps_tblarticle WHERE ($where)");
            
            return $query->result_array();
        }
        
        function getArticleSearch($prop)
        {
            $titleOfPaper = explode(' ', $prop);
            $keywords = explode(' ', $prop);
            
            $where = '';
            foreach ($titleOfPaper as $word) {
                $where .= "titleOfPaper LIKE '%$word%' OR ";
            }
            
            foreach ($keywords as $word) {
                $where .= "keywords LIKE '%$word%' OR ";
            }
            
            foreach ($keywords as $word) {
                $where .= "ijps_tblarticalauthor.name LIKE '%$word%' OR ";
            }
            
            
            $where = rtrim($where, 'OR ');
            
            $query = $this->db->query("SELECT ijps_tblarticle.* FROM ijps_tblarticle inner join ijps_tblarticalauthor on ijps_tblarticle.articleID=ijps_tblarticalauthor.articleID WHERE ($where) group by ijps_tblarticalauthor.articleID");
            
            return $query->result_array();
        }
		
		
        function getRelatedArticles06112023($prop1, $prop2, $prop3)
        {
            // Split the title and description into individual words.
            $titleOfPaper = explode(' ', $prop1);
            $keywords = explode(' ', $prop2);
            
            // Build a WHERE clause to search for articles containing any of the title or description words.
            $where = '';
            foreach ($titleOfPaper as $word) {
                $where .= "titleOfPaper LIKE '%".str_ireplace( array( '\'', '"',',' , ';', '<', '>' ), ' ', $word)."%' OR ";
            }
            foreach ($keywords as $word) {
                $where .= "keywords LIKE '%".str_ireplace( array( '\'', '"',',' , ';', '<', '>' ), ' ', $word)."%' OR ";
            }
            $where = rtrim($where, 'OR ');
            
            // Perform the database query to retrieve related articles.
            $query = $this->db->query("SELECT * FROM ijps_tblarticle WHERE ($where) AND articleID  != '".$prop3."' LIMIT 10");
            
            // Return the result as an array of objects.
            return $query->result_array();

           /* $sql="SELECT *, ROUND(0 + (MATCH(titleOfPaper) AGAINST('$prop1') * titleOfPaper) + (MATCH(keywords) AGAINST('$prop2') * keywords)) AS score FROM  ijps_tblarticle HAVING score > 0 ORDER BY score DESC LIMIT 10";    
            $query = $this->db->query($sql);
            return $query->result_array();*/
        }
		
		function getRelatedArticles($prop1, $prop2, $prop3,$prop4)
        {
            $where = '';
            $dd = substr(trim($prop4), 0, -1);
            $authors = explode(',', $dd); 
           
            $titleOfPaper = substr(trim($prop1), 0, -1);
            $keywords = substr(trim($prop2), 0, -1);
            // Split the title and description into individual words.
            $titleOfPaper = explode(' ', $titleOfPaper);
            $keywords = explode(' ', $keywords);

            // Build a WHERE clause to search for articles containing any of the title or description words.
           $where.='(';
            foreach ($keywords as $word) {

                $where .= "a.keywords LIKE '%" . str_ireplace(array('\'', '"', ',', ';', '<', '>'), ' ', $word) . "%' OR ";
            }

            foreach ($titleOfPaper as $word) {
                $where .= "a.titleOfPaper LIKE '%" . str_ireplace(array('\'', '"', ',', ';', '<', '>'), ' ', $word) . "%' OR  ";
            }
            // $where .= ")";
            // Remove the last "OR"
           // $where = rtrim($where, 'OR ');
            //$where .= ")";
            // Check if there are authors to include in the WHERE clause
            if (!empty($authors)) {
                //$where .= "";
                foreach ($authors as $key =>$rowValue) {
                    if (!empty($authors[$key])) {                       
                        $where .= "aa.name LIKE '%" . str_ireplace(array('\'', '"', ',', ';', '<', '>'), ' ', trim($rowValue)) . "%' OR ";
                    }
                }

                // Remove the last "OR" if present
                $where = rtrim($where, 'OR ');

                // Close the author group
                $where .= ")";
            }

            // Remove unnecessary "AND" if there are no authors
            $where = str_replace("AND ()", "", $where);

            // Add "AND" before the author condition if $where is not empty
            if (!empty($where)) {
                $where = " " . $where;
            }
            // echo "SELECT * FROM ijps_tblarticle a JOIN ijps_tblarticalauthor aa ON a.articleID = aa.articleID  WHERE $where AND a.articleID  != '".$prop3."' LIMIT 10";die;
            // Perform the database query to retrieve related articles.
            $query = $this->db->query("SELECT * FROM ijps_tblarticle a JOIN ijps_tblarticalauthor aa ON a.articleID = aa.articleID  WHERE $where AND a.articleID  != '".$prop3."' ORDER BY RAND() desc LIMIT 10");
            return $query->result_array();

           /* $sql="SELECT *, ROUND(0 + (MATCH(titleOfPaper) AGAINST('$prop1') * titleOfPaper) + (MATCH(keywords) AGAINST('$prop2') * keywords)) AS score FROM  ijps_tblarticle HAVING score > 0 ORDER BY score DESC LIMIT 10";    
            $query = $this->db->query($sql);
            return $query->result_array();*/
        }
        
        function getArticles()
        {
            $this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName"); /*, ijps_tblvolume.volumeName, ijps_tblissue.issueName");	*/
			////////$this->db->select("ijps_tblarticle.*, ijps_tblmanuscript.uniqueCode, ijps_tblarticaltype.articalTypeName"); /*, ijps_tblvolume.volumeName, ijps_tblissue.issueName");	*/
			////////$this->db->join('ijps_tblmanuscript', 'ijps_tblmanuscript.manuscriptID = ijps_tblarticle.manuscriptID');
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			/*$this->db->join('ijps_tblvolume', 'ijps_tblvolume.volumeID = ijps_tblarticle.volumeID');
			$this->db->join('ijps_tblissue', 'ijps_tblissue.issueID = ijps_tblarticle.issueID');*/
            //$this->db->order_by('articleID', 'desc');
            //$this->db->order_by('featuredArticleFlag', 'desc');
            $this->db->order_by('featuredArticleFlag desc, articleID desc');
            // $this->db->limit(10);
            $result = $this->db->get('ijps_tblarticle');
            return $result->result_array();
        }
        
        function getHomeArticles()
        {
            $this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName"); /*, ijps_tblvolume.volumeName, ijps_tblissue.issueName");	*/
			////////$this->db->select("ijps_tblarticle.*, ijps_tblmanuscript.uniqueCode, ijps_tblarticaltype.articalTypeName"); /*, ijps_tblvolume.volumeName, ijps_tblissue.issueName");	*/
			////////$this->db->join('ijps_tblmanuscript', 'ijps_tblmanuscript.manuscriptID = ijps_tblarticle.manuscriptID');
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			/*$this->db->join('ijps_tblvolume', 'ijps_tblvolume.volumeID = ijps_tblarticle.volumeID');
			$this->db->join('ijps_tblissue', 'ijps_tblissue.issueID = ijps_tblarticle.issueID');*/
            //$this->db->order_by('articleID', 'desc');
            //$this->db->order_by('featuredArticleFlag', 'desc');
            $this->db->order_by('featuredArticleFlag desc, articleID desc');
            $this->db->limit(10);
            $result = $this->db->get('ijps_tblarticle');
            return $result->result_array();
        }
		
		function getArticle($prop)
        {
			$this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName"); /*, ijps_tblvolume.volumeName, ijps_tblissue.issueName");	*/
			//////////////////////$this->db->join('ijps_tblmanuscript', 'ijps_tblmanuscript.manuscriptID = ijps_tblarticle.manuscriptID');
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			/*$this->db->join('ijps_tblvolume', 'ijps_tblvolume.volumeID = ijps_tblarticle.volumeID');
			$this->db->join('ijps_tblissue', 'ijps_tblissue.issueID = ijps_tblarticle.issueID');*/
            $this->db->order_by('articleID', 'desc');
			$this->db->where('articleID', $prop);
            $result = $this->db->get('ijps_tblarticle');
            return $result->result_array();
        }
        
        function getArticleByTitle($prop)
        {
            
//           $this->db->select('ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName');
// $this->db->from('ijps_tblarticle');
// $this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');


// $this->db->group_start();
// $this->db->where('ijps_tblarticle.titleOfPaperOne', $prop);
// $this->db->or_where('ijps_tblarticle.titleOfPaperOne', '');
// $this->db->group_end();

// $this->db->order_by('articleID', 'DESC');
// $result = $this->db->get();
//  return $result->result_array();

        
			$this->db->select("ijps_tblarticle.*, ijps_tblarticle.articleIDUniqueCode as uniqueCode, ijps_tblarticaltype.articalTypeName"); /*, ijps_tblvolume.volumeName, ijps_tblissue.issueName");	*/
			///////$this->db->join('ijps_tblmanuscript', 'ijps_tblmanuscript.manuscriptID = ijps_tblarticle.manuscriptID');
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblarticle.articalTypeID');
			/*$this->db->join('ijps_tblvolume', 'ijps_tblvolume.volumeID = ijps_tblarticle.volumeID');
			$this->db->join('ijps_tblissue', 'ijps_tblissue.issueID = ijps_tblarticle.issueID');*/
            $this->db->order_by('articleID', 'desc');
			$this->db->where('ijps_tblarticle.titleOfPaper', $prop);
			$this->db->or_where('ijps_tblarticle.titleOfPaperOne', $prop);
            $result = $this->db->get('ijps_tblarticle');
            // echo $this->db->last_query(); die;
            return $result->result_array();
        }
        
        function getArticleStatus($prop)
        {
			$this->db->select("ijps_tblstatus.statusName, ijps_tblmanuscript.statusID");
			$this->db->join('ijps_tblstatus', 'ijps_tblstatus.statusID = ijps_tblmanuscript.statusID');
			$this->db->where('uniqueCode', $prop);
            $result = $this->db->get('ijps_tblmanuscript');
            return $result->result_array();
        }
        
        function getArticleAuthor($prop)
        {
            // Ensure `$prop` is sanitized before use
            $this->db->select("ijps_tblarticle.manuscriptID,ijps_tblarticle.titleOfPaper,ijps_tblarticle.createdDate,ijps_tblarticle.articleIDUniqueCode, ijps_tblarticalauthor.name, ijps_tblarticalauthor.affiliation, ijps_tblarticalauthor.email,ijps_tblarticle.articleIDUniqueCode");
            $this->db->from('ijps_tblarticle');
            $this->db->join('ijps_tblarticalauthor', 'ijps_tblarticle.articleID = ijps_tblarticalauthor.articleID');
            $this->db->where('ijps_tblarticalauthor.articleID', $prop);
            $query = $this->db->get();
            // print_r($query); die;
    //         print_r($query->result_array());
    // die;
            return $query->result_array();
        }
        
        function getArticleUniqueId($prop)
        {
            // Ensure `$prop` is sanitized before use
            $this->db->select("ijps_tblarticle.titleOfPaper,ijps_tblarticle.document,ijps_tblarticle.createdDate,ijps_tblarticle.articleIDUniqueCode, ijps_tblarticalauthor.name, ijps_tblarticalauthor.affiliation, ijps_tblarticalauthor.email,ijps_tblarticle.articleIDUniqueCode");
            $this->db->from('ijps_tblarticle');
            $this->db->join('ijps_tblarticalauthor', 'ijps_tblarticle.articleID = ijps_tblarticalauthor.articleID');
            $this->db->where('ijps_tblarticle.articleIDUniqueCode', $prop);
            $query = $this->db->get();
            // print_r($query); die;
    //         print_r($query->result_array());
    // die;
            return $query->result_array();
        }
	}
