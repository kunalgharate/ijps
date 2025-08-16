<?php
/**
 * Secure Common Model with enhanced security features
 * Addresses SQL injection, input validation, and secure query building
 */
class SecureCommonModel extends CI_Model
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

	/**
	 * Secure getData method with input validation
	 */
	public function getData($table, $where='',$fields='',$group_by='',$return='')
	{
		// Input validation
		if (empty($table) || !preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
			log_message('error', 'Invalid table name in getData: ' . $table);
			return array();
		}
		
		if ($fields) {
			// Validate field names to prevent injection
			if (is_string($fields)) {
				$fields = preg_replace('/[^a-zA-Z0-9_,.\s*()]/', '', $fields);
			}
			$this->db->select($fields);
		}
		
		if ($where) {
			// Ensure where is an array for security
			if (is_array($where)) {
				$this->db->where($where);
			} else {
				log_message('error', 'Invalid where clause format in getData');
				return array();
			}
		}
		
		if ($group_by) {
			// Validate group_by field
			$group_by = preg_replace('/[^a-zA-Z0-9_,.\s]/', '', $group_by);
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

	/**
	 * Secure IUD (Insert, Update, Delete) actions with validation
	 */
	public function iudAction($table='',$data = array(), $action='', $where =array())
	{
		// Validate table name
		if (empty($table) || !preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
			log_message('error', 'Invalid table name in iudAction: ' . $table);
			return false;
		}
		
		// Validate action
		$allowedActions = ['insert', 'update', 'delete', 'batch_insert', 'batch_update'];
		if (!in_array($action, $allowedActions)) {
			log_message('error', 'Invalid action in iudAction: ' . $action);
			return false;
		}
		
		switch ($action) {
			case 'insert':
				if (!is_array($data) || empty($data)) {
					log_message('error', 'Invalid data for insert action');
					return false;
				}
				$this->db->insert($table, $data);
				return $this->db->insert_id();
				break;
				
			case 'update':
				if (!is_array($data) || empty($data) || !is_array($where) || empty($where)) {
					log_message('error', 'Invalid data or where clause for update action');
					return false;
				}
				$this->db->where($where);
				$this->db->set($data);
				$this->db->update($table); 
				return ($this->db->affected_rows() > 0)? true : false ;
				break;
				
			case 'delete':
				if (!is_array($where) || empty($where)) {
					log_message('error', 'Invalid where clause for delete action');
					return false;
				}
				$this->db->where($where);
				$this->db->delete($table); 
				return ($this->db->affected_rows() > 0)? true : false ;
				break;

			case 'batch_insert':
				if (!is_array($data) || empty($data)) {
					log_message('error', 'Invalid data for batch_insert action');
					return false;
				}
				$this->db->insert_batch($table, $data);
				return ($this->db->affected_rows() > 0)? true : false ;
				break;
				
			case 'batch_update':
				if (!is_array($data) || empty($data)) {
					log_message('error', 'Invalid data for batch_update action');
					return false;
				}
				$this->db->update_batch($table, $data);
				return ($this->db->affected_rows() > 0)? true : false ;
				break;

			default:
				return false;
				break;
		}
	}
	
	/**
	 * Secure getDataLimit with pagination and input validation
	 */
    function getDataLimit($table, $where='',$fields='',$group_by='',$return='', $limit = 0 , $offset = 0,$order_by_key='',$order_by_asc='desc' ){
		// Input validation
		if (empty($table) || !preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
			log_message('error', 'Invalid table name in getDataLimit: ' . $table);
			return array();
		}
		
		// Validate limit and offset
		$limit = filter_var($limit, FILTER_VALIDATE_INT);
		$offset = filter_var($offset, FILTER_VALIDATE_INT);
		
		if ($limit !== false && $limit < 0) $limit = 0;
		if ($offset !== false && $offset < 0) $offset = 0;
		
		if ($fields) {
			// Validate field names
			if (is_string($fields)) {
				$fields = preg_replace('/[^a-zA-Z0-9_,.\s*()]/', '', $fields);
			}
			$this->db->select($fields);
		}
		
		if ($where) {
			if (is_array($where)) {
				$this->db->where($where);
			} else {
				log_message('error', 'Invalid where clause format in getDataLimit');
				return array();
			}
		}
		
		if ($group_by) {
			$group_by = preg_replace('/[^a-zA-Z0-9_,.\s]/', '', $group_by);
			$this->db->group_by($group_by);
		}
		
		if($order_by_key && $order_by_asc){
			// Validate order by parameters
			$order_by_key = preg_replace('/[^a-zA-Z0-9_.]/', '', $order_by_key);
			$order_by_asc = in_array(strtolower($order_by_asc), ['asc', 'desc']) ? $order_by_asc : 'desc';
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
	
	/**
	 * Secure insert record with validation
	 */
	public function insertRecord($table, $dataArray)
	{
		// Validate inputs
		if (empty($table) || !preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
			log_message('error', 'Invalid table name in insertRecord: ' . $table);
			return false;
		}
		
		if (!is_array($dataArray) || empty($dataArray)) {
			log_message('error', 'Invalid data array in insertRecord');
			return false;
		}
		
		// Add timestamp if not present
		if (!isset($dataArray['createdDate'])) {
			$dataArray['createdDate'] = date('Y-m-d H:i:s');
		}
		
		return $this->db->insert($table, $dataArray);
	}
	
	/**
	 * Secure update record with validation
	 */
	function updateRecord($table, $dataArray, $id, $pkey)
	{
		// Validate inputs
		if (empty($table) || !preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
			log_message('error', 'Invalid table name in updateRecord: ' . $table);
			return false;
		}
		
		if (!is_array($dataArray) || empty($dataArray)) {
			log_message('error', 'Invalid data array in updateRecord');
			return false;
		}
		
		if (empty($pkey) || !preg_match('/^[a-zA-Z0-9_]+$/', $pkey)) {
			log_message('error', 'Invalid primary key in updateRecord: ' . $pkey);
			return false;
		}
		
		$id = filter_var($id, FILTER_VALIDATE_INT);
		if ($id === false || $id <= 0) {
			log_message('error', 'Invalid ID in updateRecord: ' . $id);
			return false;
		}
		
		// Add timestamp
		if (!isset($dataArray['updatedDate'])) {
			$dataArray['updatedDate'] = date('Y-m-d H:i:s');
		}
		
		$this->db->where($pkey, $id);
		return $this->db->update($table, $dataArray);
	}
	
	/**
	 * Secure delete record with validation
	 */
	public function deleteRecord($table, $id, $pkey)
	{
		// Validate inputs
		if (empty($table) || !preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
			log_message('error', 'Invalid table name in deleteRecord: ' . $table);
			return false;
		}
		
		if (empty($pkey) || !preg_match('/^[a-zA-Z0-9_]+$/', $pkey)) {
			log_message('error', 'Invalid primary key in deleteRecord: ' . $pkey);
			return false;
		}
		
		$id = filter_var($id, FILTER_VALIDATE_INT);
		if ($id === false || $id <= 0) {
			log_message('error', 'Invalid ID in deleteRecord: ' . $id);
			return false;
		}
		
		return $this->db->where($pkey, $id)->delete($table);
	}
	
	/**
	 * Secure visibility toggle with validation
	 */
	function setVisibilityOfRecord($table, $isActive, $id, $pkey)
	{
		// Validate inputs
		if (empty($table) || !preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
			log_message('error', 'Invalid table name in setVisibilityOfRecord: ' . $table);
			return false;
		}
		
		if (empty($pkey) || !preg_match('/^[a-zA-Z0-9_]+$/', $pkey)) {
			log_message('error', 'Invalid primary key in setVisibilityOfRecord: ' . $pkey);
			return false;
		}
		
		$id = filter_var($id, FILTER_VALIDATE_INT);
		if ($id === false || $id <= 0) {
			log_message('error', 'Invalid ID in setVisibilityOfRecord: ' . $id);
			return false;
		}
		
		$isActive = filter_var($isActive, FILTER_VALIDATE_INT);
		if ($isActive === false || !in_array($isActive, [0, 1])) {
			log_message('error', 'Invalid isActive value in setVisibilityOfRecord: ' . $isActive);
			return false;
		}
		
		$this->db->set('isActive', $isActive);
		$this->db->set('updatedDate', date('Y-m-d H:i:s'));
		$this->db->where($pkey, $id);
		return $this->db->update($table);
	}
	
	/**
	 * Secure notification data retrieval
	 */
	public function getNotificationData($flag)
    {
		$flag = filter_var($flag, FILTER_VALIDATE_INT);
		if ($flag === false) {
			log_message('error', 'Invalid flag in getNotificationData: ' . $flag);
			return array();
		}
		
		$this->db->select('*');
        $this->db->from('tblactivitylog');
		$this->db->where('isActive', '1');
		
		if($flag == 0)
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
		
        $query = $this->db->get();
        return $query->result_array();
    }
	
	/**
	 * Secure request filter with validation
	 */
	function getRequestWithFilterResult($where, $table, $requestTypeFilterFlag)
	{
		// Validate inputs
		if (empty($table) || !preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
			log_message('error', 'Invalid table name in getRequestWithFilterResult: ' . $table);
			return array();
		}
		
		$requestTypeFilterFlag = filter_var($requestTypeFilterFlag, FILTER_VALIDATE_INT);
		if ($requestTypeFilterFlag === false) {
			log_message('error', 'Invalid filter flag in getRequestWithFilterResult: ' . $requestTypeFilterFlag);
			return array();
		}
		
		if($where != "" && is_array($where))
		{
			$this->db->where($where);
		}
		
		if($requestTypeFilterFlag == 1)
		{
			$this->db->select($table.".*, ijps_tblarticaltype.articalTypeName, ijps_tblcountry.countryName, ijps_tblstatus.statusName");
			
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = '.$table.'.articalTypeID');
			$this->db->join('ijps_tblcountry', 'ijps_tblcountry.countryID = '.$table.'.countryID');
			$this->db->join('ijps_tblstatus', $table.'.statusID = ijps_tblstatus.statusID');
			$this->db->order_by('manuscriptID', 'ASC');
		}
		else if($requestTypeFilterFlag == 2)
		{
			$this->db->select($table.".*");
			$this->db->order_by('manuscriptInfoID', 'ASC');
		}
		else if($requestTypeFilterFlag == 3)
		{
			$this->db->select($table.".*, ijps_tblarticaltype.articalTypeName");
			
			$this->db->join('ijps_tblarticaltype', 'ijps_tblarticaltype.articalTypeID = '.$table.'.articalTypeID');
			$this->db->order_by('articleID ', 'ASC');
		}
		else if($requestTypeFilterFlag == 4)
		{
			$this->db->select($table.".*");
			$this->db->order_by('newsletterID', 'ASC');
		}
		else if($requestTypeFilterFlag == 5)
		{
			$this->db->select($table.".*, ijps_tblblogcategory.blogCategoryName");
			$this->db->join('ijps_tblblogcategory', 'ijps_tblblogcategory.blogCategoryID = '.$table.'.blogCategoryID');
			$this->db->order_by('blogID', 'ASC');
		}
		else if($requestTypeFilterFlag == 6)
		{
			$this->db->select($table.".*");
			$this->db->order_by('subscriberID', 'ASC');
		}
		else if($requestTypeFilterFlag == 7)
		{
			$this->db->select($table.".*");
			$this->db->order_by('contactFormDataID', 'ASC');
		}		
		
		$this->db->where($table.'.isActive', '1');
        $result = $this->db->get($table);
        return $result->result_array();
	}
	
	/**
	 * Secure article ID generation
	 */
	public function generate_articleID($table_name, $volume)
	{
		// Validate inputs
		if (empty($table_name) || !preg_match('/^[a-zA-Z0-9_]+$/', $table_name)) {
			log_message('error', 'Invalid table name in generate_articleID: ' . $table_name);
			return false;
		}
		
		$volume = filter_var($volume, FILTER_VALIDATE_INT);
		if ($volume === false || $volume < 1 || $volume > 99) {
			log_message('error', 'Invalid volume in generate_articleID: ' . $volume);
			return false;
		}
		
		$current_year = date('y');
		$current_date = date('m');
		$articleID = $current_year . sprintf('%02d', $volume) . $current_date . '001';		
		
		// Check if ID already exists and increment if necessary
		$this->db->where('articleIDUniqueCode', $articleID);
		$existing = $this->db->get($table_name)->num_rows();
		
		if ($existing > 0) {
			// Find the next available ID
			$this->db->select('articleIDUniqueCode');
			$this->db->where('articleIDUniqueCode LIKE', $current_year . sprintf('%02d', $volume) . $current_date . '%');
			$this->db->order_by('articleIDUniqueCode', 'DESC');
			$this->db->limit(1);
			$last_record = $this->db->get($table_name)->row();
			
			if ($last_record) {
				$last_number = intval(substr($last_record->articleIDUniqueCode, -3));
				$new_number = $last_number + 1;
				$articleID = $current_year . sprintf('%02d', $volume) . $current_date . sprintf('%03d', $new_number);
			}
		}
		
		return $articleID;
	}
	
	/**
	 * Sanitize output data to prevent XSS
	 */
	public function sanitizeOutput($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$data[$key] = $this->sanitizeOutput($value);
			}
		} elseif (is_string($data)) {
			$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		}
		return $data;
	}
	
	/**
	 * Log security events
	 */
	public function logSecurityEvent($event, $details = []) {
		$logData = [
			'event' => $event,
			'user_id' => $_SESSION['userID'] ?? 'anonymous',
			'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
			'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
			'details' => json_encode($details),
			'created_date' => date('Y-m-d H:i:s')
		];
		
		// Create security log table if it doesn't exist
		$this->createSecurityLogTable();
		
		$this->db->insert('security_log', $logData);
		
		// Log critical events to file as well
		$criticalEvents = ['login_failure', 'sql_injection_attempt', 'file_upload_violation', 'csrf_violation'];
		if (in_array($event, $criticalEvents)) {
			error_log("SECURITY ALERT: " . json_encode($logData));
		}
	}
	
	/**
	 * Create security log table if it doesn't exist
	 */
	private function createSecurityLogTable() {
		$query = "CREATE TABLE IF NOT EXISTS security_log (
			id INT AUTO_INCREMENT PRIMARY KEY,
			event VARCHAR(100) NOT NULL,
			user_id VARCHAR(50),
			ip_address VARCHAR(45),
			user_agent TEXT,
			details TEXT,
			created_date DATETIME NOT NULL,
			INDEX idx_event (event),
			INDEX idx_created_date (created_date)
		) ENGINE=InnoDB";
		
		$this->db->query($query);
	}
}
