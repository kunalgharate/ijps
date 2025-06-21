<?php
/**
 * 
 */
class CommonModel extends CI_Model
{
	protected $Product_Column = array(
									'p.id',
									'p.products',
									'p.quantity',
									'p.price',
									''
							);
	protected $Category_Column = array(
									'c.id',
									'c.category',
									'c.path',
									''
							);

	public function getData($table, $where='',$fields='',$group_by='',$return='')
	{
		if ($fields) {
			$this->db->select($fields);
		}
		if ($where) {
			$this->db->where($where);
		}
		if ($group_by) {
			$this->db->group_by($group_by);
		}
		$query = $this->db->get($table);
		
		if($return == 'row'){
			$result = $query->row();
		}else if($return == 'row_array'){
			$result = $query->row_array();
		}else if($return == 'result'){
			$result = $query->result();
		}else if($return == 'num_rows'){
			$result = $query->num_rows();
		}else{
			$result = $query->result_array();
		}
		return $result;
	}

	public function iudAction($table='',$data = array(), $action='', $where =array())
	{
		switch ($action) {
			case 'insert':
				$this->db->insert($table, $data);
				return $this->db->insert_id();
				break;
			case 'update':
				$this->db->where($where);
				$this->db->set($data);
				$this->db->update($table); 
				return ($this->db->affected_rows() > 0)? true : false ;
				break;
			case 'delete':
				$this->db->where($where);
				$this->db->delete($table); 
				return ($this->db->affected_rows() > 0)? true : false ;
				break;

			case 'batch_insert':
				$this->db->insert_batch($table, $data);
				return ($this->db->affected_rows() > 0)? true : false ;
				break;
			case 'batch_update':
				$this->db->update_batch($table, $data);
				return ($this->db->affected_rows() > 0)? true : false ;
				break;

			default:
				return false;
				break;
		}
	}
	    function getDataLimit($table, $where='',$fields='',$group_by='',$return='', $limit = 0 , $offset = 0,$order_by_key='',$order_by_asc='desc' ){
           if ($fields) {
    			$this->db->select($fields);
    		}
    		if ($where) {
    			$this->db->where($where);
    		}
    		if ($group_by) {
    			$this->db->group_by($group_by);
    		}
    		if($order_by_key && $order_by_asc){
    		    $this->db->order_by($order_by_key, $order_by_asc);
    		}
    		 
    		if($limit || $offset){
                $this->db->limit($limit, $offset);
            }
             
    		$query = $this->db->get($table);
		
    		if($return == 'row'){
    			$result = $query->row();
    		}else if($return == 'row_array'){
    			$result = $query->row_array();
    		}else if($return == 'result'){
    			$result = $query->result();
    		}else if($return == 'num_rows'){
    			$result = $query->num_rows();
    		}else{
    			$result = $query->result_array();
    		}
    		if(!empty($result)){
				return $result;
			}else{
				return array();
			}
		
        
    } 
	
	    function getDataLimit_bk($table, $where='',$fields='',$group_by='',$return='', $limit = 0 , $offset = 0,$order_by_key='',$order_by_asc='desc' ){
           if ($fields) {
    			$this->db->select($fields);
    		}
    		if ($where) {
    			$this->db->where($where);
    		}
    		if ($group_by) {
    			$this->db->group_by($group_by);
    		}
    		if($order_by_key && $order_by_asc){
    		    $this->db->order_by($order_by_key, $order_by_asc);
    		}
    		 
    		if($limit || $offset){
                $this->db->limit($limit, $offset);
            }
             
    		$query = $this->db->get($table);

			// echo $this->db->last_query();die;
    		
    		if($return == 'row'){
    			$result = $query->row();
    		}else if($return == 'row_array'){
    			$result = $query->row_array();
    		}else if($return == 'result'){
    			$result = $query->result();
    		}else if($return == 'num_rows'){
    			$result = $query->num_rows();
    		}else{
    			$result = $query->result_array();
    		}
    		if(!empty($result)){
				return $result;
			}else{
				return array();
			}
		
        
    } 
	
	public function insertRecord($table, $dataArray)
	{
		return $this->db->insert($table, $dataArray);
	}
	
	function updateRecord($table, $dataArray, $id, $pkey)
	{
		$this->db->where($pkey,$id);
		return $this->db->update($table, $dataArray);
	}
	
	public function deleteRecord($table, $id, $pkey)
	{
		return $this->db->where($pkey,$id)->delete($table);
	}
	
	function setVisibilityOfRecord($table, $isActive, $id, $pkey)
	{
		$this->db->set('isActive', $isActive);
		$this->db->where($pkey, $id);
		return $this->db->update($table);
		//echo "9999999999999999-".$table."-".$isActive."-".$id."-".$pkey;exit;
	}
	
	
	/*function setRequestCancel($table, $cancelRequestFlag, $id, $pkey)
	{
		$this->db->set('cancelRequestFlag', $cancelRequestFlag);
		$this->db->where($pkey, $id);
		return $this->db->update($table);
		//echo "9999999999999999-".$table."-".$cancelRequestFlag."-".$id."-".$pkey;exit;
	}*/
	
	public function getNotificationData($flag)
    {
		$this->db->select('*');
        $this->db->from('tblactivitylog');
		$this->db->where('isActive', '1');
		
		if($flag =='0')
		{	
			$this->db->where("createdDate BETWEEN DATE_SUB(NOW(), INTERVAL 10 DAY) AND NOW()");
		}
		else
		{
			$this->db->limit(5);
			$this->db->order_by("activityLogID", "desc");
		}
		
		$this->db->group_start();
		$this->db->like('description', 'Post : Added');
		$this->db->or_like('description', 'Job post : Added');
		$this->db->or_like('description', 'Bank Data : Added');
		$this->db->or_like('description', 'Important link : Added');
		$this->db->or_like('description', 'Guest : Added');
		$this->db->or_like('description', 'Employee : Added');
		$this->db->or_like('description', 'Emergency contact : Added');
		$this->db->or_like('description', 'Company Video : Added');
		$this->db->or_like('description', 'Company Presentation Template : Added');
		$this->db->group_end();
		$this->db->order_by('activityLogID', 'desc');
		//$this->db->like('description', 'Added');
		//$this->db->where("DATE_FORMAT(createdDate,'%m-%d-%Y') < DATE_FORMAT(NOW(),'%m-%d-%Y')");
        $query = $this->db->get();
        return $query->result_array();
    }
	
	function getRequestWithFilterResult($where, $table, $requestTypeFilterFlag)
	{
		if($where != "")
		{
			$this->db->where($where);
		}
		
		/*$this->db->join('pp_tblemployee', $table.'.employeeID = pp_tblemployee.employeeID');
		$this->db->join('pp_tbldepartment', 'pp_tblemployee.departmentID = pp_tbldepartment.departmentID');
		$this->db->join('pp_tblcompany', 'pp_tblemployee.companyID = pp_tblcompany.companyID');
		$this->db->join('pp_tblstatus', $table.'.statusID = pp_tblstatus.statusID');*/
		
		if($requestTypeFilterFlag == '1')
		{
			$this->db->select($table.".*, ijps_tblarticaltype.articalTypeName, ijps_tblcountry.countryName,  ijps_tblstatus.statusName");
			
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = '.$table.'.articalTypeID');
			$this->db->join('ijps_tblcountry', 'ijps_tblcountry.countryID = '.$table.'.countryID');
			$this->db->join('ijps_tblstatus', $table.'.statusID = ijps_tblstatus.statusID');
			$this->db->order_by('manuscriptID', 'ASC');
		}
		else if($requestTypeFilterFlag == '2')
		{
			$this->db->select($table.".*");
			$this->db->order_by('manuscriptInfoID', 'ASC');
		}
		else if($requestTypeFilterFlag == '3')
		{
			$this->db->select($table.".*, ijps_tblarticaltype.articalTypeName");
			
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = '.$table.'.articalTypeID');
			$this->db->order_by('articleID ', 'ASC');
		}
		else if($requestTypeFilterFlag == '4')
		{
			$this->db->select($table.".*");
			$this->db->order_by('newsletterID', 'ASC');
		}
		else if($requestTypeFilterFlag == '5')
		{
			$this->db->select($table.".*, ijps_tblblogcategory.blogCategoryName");
			$this->db->join('ijps_tblblogcategory', 'ijps_tblblogcategory.blogCategoryID = '.$table.'.blogCategoryID');
			$this->db->order_by('blogID', 'ASC');
		}
		else if($requestTypeFilterFlag == '6')
		{
			$this->db->select($table.".*");
			$this->db->order_by('subscriberID', 'ASC');
		}
		else if($requestTypeFilterFlag == '7')
		{
			$this->db->select($table.".*");
			$this->db->order_by('contactFormDataID', 'ASC');
		}		
		$this->db->where($table.'.isActive', '1');
        $result = $this->db->get($table);
        return $result->result_array();
	}
	

    
    
public function generate_articleID($table_name, $volume)
	{
		
		$current_year = date('y');
		$current_date = date('m');
		$articleID = $current_year .$volume. $current_date . '001';		
		$start_year = substr($articleID, 0, 2);
		$start_volume = substr($articleID, 2, 2);
		$start_date = substr($articleID, 4, 2);
		
		$attempt_limit = 1000; 

	
		$attempt_count = 1;

		do {
			
			$articleID = $start_year . $start_volume . $start_date . str_pad($attempt_count, 3, '0', STR_PAD_LEFT);

			
			$article_exists = $this->db->where('uniqueCode', $articleID)
				->get($table_name)
				->row();

			
			if ($article_exists) {
				$attempt_count++;
				continue;
			}

			
			if ($attempt_count > $attempt_limit) {
				//throw new Exception("Failed to generate unique article ID after $attempt_limit attempts.");
			}

			
			break;
		} while ($attempt_count <= $attempt_limit);

		return $articleID;
	}
	
    
}
?>