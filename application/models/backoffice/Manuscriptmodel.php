<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class ManuscriptModel extends CI_Model 
    {
    	public function __construct()
        {
        	parent::__construct();
        }
        
        function getManuscriptDetailsAsPerMailID($prop)
        {
			//$this->db->select("ijps_tblmanuscript.*, ijps_tblauthor.name, ijps_tblauthor.email, ijps_tblauthor.contactNumber, ijps_tblarticaltype.articalTypeName, ijps_tblcountry.countryName, ijps_tblstatus.statusName");
			$this->db->select("ijps_tblmanuscript.*, ijps_tblarticaltype.articalTypeName, ijps_tblcountry.countryName, ijps_tblstatus.statusName");
			//$this->db->select("*");
		//	$this->db->join('ijps_tblauthor', 'ijps_tblauthor.authorID = ijps_tblmanuscript.authorID');
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblmanuscript.articalTypeID');
			$this->db->join('ijps_tblcountry', 'ijps_tblcountry.countryID = ijps_tblmanuscript.countryID');
			$this->db->join('ijps_tblstatus', 'ijps_tblstatus.statusID = ijps_tblmanuscript.statusID');
            $this->db->order_by('manuscriptID', 'desc');
			$this->db->where('ijps_tblmanuscript.email', $prop);
            $result = $this->db->get('ijps_tblmanuscript');
            
            return $result->result_array();
        }
        
        function getManuscripts()
        {
			$this->db->select("ijps_tblmanuscript.*, ijps_tblarticaltype.articalTypeName, ijps_tblcountry.countryName, ijps_tblstatus.statusName");	 /*ijps_tblauthor.name, ijps_tblauthor.email, ijps_tblauthor.contactNumber, */
			//$this->db->select("ijps_tblmanuscript.authorName, ijps_tblmanuscript.isActive");
			/*$this->db->join('ijps_tblauthor', 'ijps_tblauthor.authorID = ijps_tblmanuscript.authorID');*/
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblmanuscript.articalTypeID');
			$this->db->join('ijps_tblcountry', 'ijps_tblcountry.countryID = ijps_tblmanuscript.countryID');
			$this->db->join('ijps_tblstatus', 'ijps_tblstatus.statusID = ijps_tblmanuscript.statusID');
            $this->db->order_by('manuscriptID', 'desc');
            $result = $this->db->get('ijps_tblmanuscript');
            
            return $result->result_array();
        }
          function getManuscriptsN()
        {

			$this->db->select("ijps_tblmanuscript.*, ijps_tblarticaltype.articalTypeName, ijps_tblcountry.countryName, ijps_tblstatus.statusName");	
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblmanuscript.articalTypeID');
			$this->db->join('ijps_tblcountry', 'ijps_tblcountry.countryID = ijps_tblmanuscript.countryID');
			$this->db->join('ijps_tblstatus', 'ijps_tblstatus.statusID = ijps_tblmanuscript.statusID');
			$this->db->where('ijps_tblmanuscript.isActive', '1');
            $this->db->order_by('manuscriptID', 'desc');
            $result = $this->db->get('ijps_tblmanuscript');
            return $result->result_array();
        }
		
		function getManuscript($prop)
        {
			$this->db->select("ijps_tblmanuscript.*, ijps_tblauthor.name, ijps_tblauthor.email, ijps_tblauthor.contactNumber, ijps_tblarticaltype.articalTypeName, ijps_tblcountry.countryName, ijps_tblstatus.statusName");	
			$this->db->join('ijps_tblauthor', 'ijps_tblauthor.authorID = ijps_tblmanuscript.authorID');
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = ijps_tblmanuscript.articalTypeID');
			$this->db->join('ijps_tblcountry', 'ijps_tblcountry.countryID = ijps_tblmanuscript.countryID');
			$this->db->join('ijps_tblstatus', 'ijps_tblstatus.statusID = ijps_tblmanuscript.statusID');
            $this->db->order_by('manuscriptID', 'desc');
			$this->db->where('manuscriptID', $prop);
            $result = $this->db->get('ijps_tblmanuscript');
            return $result->result_array();
        }
		
		function setApprovalManuscript($approvedFlag, $manuscriptID)
		{
			$this->db->set('approvedFlag', $approvedFlag);
			$this->db->where('manuscriptID', $manuscriptID);
			return $this->db->update('ijps_tblmanuscript');
		}
		
		function getManuscriptsinfo()
        {
            $this->db->select("ijps_tblmanuscriptinfo.*");//, ijps_tblmanuscriptcoauthor.*");	
            //$this->db->join('ijps_tblmanuscriptcoauthor', 'ijps_tblmanuscriptcoauthor.manuscriptInfoID = ijps_tblmanuscriptinfo.manuscriptInfoID');
            $this->db->order_by('ijps_tblmanuscriptinfo.manuscriptInfoID', 'desc');
            $result = $this->db->get('ijps_tblmanuscriptinfo');
            return $result->result_array();
        }

		
		public function insertReviewPoint($tbl_name,$data) {
			
			$this->db->insert($tbl_name, $data);			
			if ($this->db->affected_rows() > 0) {
				return true; 
			} else {
				return false;
			}
		}

		public function is_record_exist($conditions) {		
			
			$query = $this->db->get_where('tbl_reviewpoint', $conditions);	
			if ($query->num_rows() > 0) {
				return true; 
			} else {
				return false; 
			}
		}
		public function getDocument($conditions) {		
            $this->db->select('*');
            $this->db->from('ijps_tblarticle');
            $this->db->where($conditions);
            // $this->db->group_by('articleIDUniqueCode');
            $this->db->order_by("articleID ", "desc");
            $this->db->limit(1);
            $query = $this->db->get();
// 			echo $this->db->last_query();die;
			return $query->result_array(); 
			
		}

// 		public function getDocument($conditions) {		
			
// 			$query = $this->db->get_where('ijps_tblarticle', $conditions);	
			
// 			if ($query->num_rows() > 0) {
// 				return $query->result_array(); 
// 			} else {
// 				return false; 
// 			}
// 		}
		public function getCountry($conditions) {		
			
			$query = $this->db->get_where('ijps_tblmanuscript', $conditions);	
		
			if ($query->num_rows() > 0) {
				return $query->result_array(); 
			} else {
				return false; 
			}
		}
		public function getCoauthorEmail($manuscriptID) {		
			
		    $this->db->select('*');
            $this->db->from('ijps_tblmanuscriptcoauthor');
            $this->db->where('manuscriptInfoID',$manuscriptID);
            $this->db->order_by("manuscriptCoAuthorID ", "asc");
            $query = $this->db->get();
// 			echo $this->db->last_query();die;
			return $query->result_array(); 
		}

		public function update_record($id, $data) {
			
			$this->db->where('articleId', $id);
			$this->db->update('tbl_reviewpoint', $data);
			
			if ($this->db->affected_rows() > 0) {
				return true; 
			} else {
				return false; 
			}
		}
		
		function getEmail_bkkk($articleId){
		    
		    $this->db->select("GROUP_CONCAT(A.email SEPARATOR ', ') AS emails, GROUP_CONCAT(C.email SEPARATOR ', ') AS co_author_emails");
            $this->db->from("ijps_tblarticle AS AT");
            $this->db->join("ijps_tblmanuscript AS MT", "AT.manuscriptID = MT.manuscriptID", "LEFT");
            $this->db->join("ijps_tblarticalauthor AS A", "AT.articleID = A.articleID", "LEFT");
            $this->db->join("(SELECT manuscriptInfoID, email FROM ijps_tblmanuscriptcoauthor) AS C", "MT.manuscriptID = C.manuscriptInfoID", "LEFT");
            $this->db->where("AT.articleIDUniqueCode", $articleId);
            $this->db->group_by("A.email");
            $query = $this->db->get();
           	// echo $this->db->last_query();die;
            return $query->result_array(); 

		}
		
		function getEmail($articleId){
		    $this->db->select("GROUP_CONCAT(DISTINCT NULLIF(A.email, '') SEPARATOR ', ') AS emails, 
                               GROUP_CONCAT(DISTINCT NULLIF(C.email, '') SEPARATOR ', ') AS co_author_emails");
            $this->db->from('ijps_tblarticle AT');
            $this->db->join('ijps_tblmanuscript MT', 'AT.manuscriptID = MT.manuscriptID', 'left');
            $this->db->join('ijps_tblarticalauthor A', 'AT.articleID = A.articleID', 'left');
            $this->db->join('(SELECT manuscriptInfoID, email FROM ijps_tblmanuscriptcoauthor) AS C', 'MT.manuscriptID = C.manuscriptInfoID', 'left');
            $this->db->where('AT.articleIDUniqueCode', $articleId);
            $this->db->group_by('AT.articleID');
            
            $query = $this->db->get();
            return $query->result_array();

		}
		
		public function getOtherDetails($conditions) {		
            $query = $this->db->get_where('ijps_tblmanuscript', $conditions);	
		
			if ($query->num_rows() > 0) {
				return $query->row(); 
			} else {
				return false; 
			} 
			
		}

		
	}
