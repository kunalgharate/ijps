<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'interfaces/RepositoryInterface.php';

/**
 * Base Repository Class
 * 
 * Implements common repository functionality
 * Provides secure database operations with proper validation
 */
abstract class BaseRepository implements RepositoryInterface
{
    protected $CI;
    protected $table;
    protected $primaryKey = 'id';
    protected $entityClass;
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }
    
    /**
     * Find record by ID
     */
    public function find($id)
    {
        $this->CI->db->where($this->primaryKey, $id);
        $query = $this->CI->db->get($this->table);
        
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            return $this->entityClass ? new $this->entityClass($data) : $data;
        }
        
        return null;
    }
    
    /**
     * Find record by ID or throw exception
     */
    public function findOrFail($id)
    {
        $result = $this->find($id);
        
        if (!$result) {
            throw new Exception("Record not found with ID: {$id}");
        }
        
        return $result;
    }
    
    /**
     * Find records by criteria
     */
    public function findBy(array $criteria = [], array $orderBy = [], $limit = null, $offset = null)
    {
        $this->applyCriteria($criteria);
        $this->applyOrderBy($orderBy);
        
        if ($limit !== null) {
            $this->CI->db->limit($limit, $offset);
        }
        
        $query = $this->CI->db->get($this->table);
        $results = $query->result_array();
        
        if ($this->entityClass) {
            return array_map(function($data) {
                return new $this->entityClass($data);
            }, $results);
        }
        
        return $results;
    }
    
    /**
     * Find first record by criteria
     */
    public function findOneBy(array $criteria = [], array $orderBy = [])
    {
        $results = $this->findBy($criteria, $orderBy, 1);
        return !empty($results) ? $results[0] : null;
    }
    
    /**
     * Get all records
     */
    public function findAll(array $orderBy = [], $limit = null, $offset = null)
    {
        return $this->findBy([], $orderBy, $limit, $offset);
    }
    
    /**
     * Create new record
     */
    public function create(array $data)
    {
        // Add timestamps
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        // Validate data
        $this->validateData($data, 'create');
        
        // Sanitize data
        $data = $this->sanitizeData($data);
        
        $this->CI->db->insert($this->table, $data);
        $insertId = $this->CI->db->insert_id();
        
        if ($insertId) {
            return $this->find($insertId);
        }
        
        return false;
    }
    
    /**
     * Update record by ID
     */
    public function update($id, array $data)
    {
        // Add timestamp
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        // Validate data
        $this->validateData($data, 'update');
        
        // Sanitize data
        $data = $this->sanitizeData($data);
        
        $this->CI->db->where($this->primaryKey, $id);
        $this->CI->db->update($this->table, $data);
        
        return $this->CI->db->affected_rows() > 0;
    }
    
    /**
     * Delete record by ID
     */
    public function delete($id)
    {
        $this->CI->db->where($this->primaryKey, $id);
        $this->CI->db->delete($this->table);
        
        return $this->CI->db->affected_rows() > 0;
    }
    
    /**
     * Count records by criteria
     */
    public function count(array $criteria = [])
    {
        $this->applyCriteria($criteria);
        return $this->CI->db->count_all_results($this->table);
    }
    
    /**
     * Check if record exists
     */
    public function exists(array $criteria)
    {
        return $this->count($criteria) > 0;
    }
    
    /**
     * Paginate records
     */
    public function paginate($page = 1, $perPage = 15, array $criteria = [], array $orderBy = [])
    {
        $offset = ($page - 1) * $perPage;
        $total = $this->count($criteria);
        $data = $this->findBy($criteria, $orderBy, $perPage, $offset);
        
        return [
            'data' => $data,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => ceil($total / $perPage),
                'from' => $offset + 1,
                'to' => min($offset + $perPage, $total)
            ]
        ];
    }
    
    /**
     * Apply criteria to query
     */
    protected function applyCriteria(array $criteria)
    {
        foreach ($criteria as $key => $value) {
            if (is_array($value)) {
                $this->CI->db->where_in($key, $value);
            } else {
                $this->CI->db->where($key, $value);
            }
        }
    }
    
    /**
     * Apply order by to query
     */
    protected function applyOrderBy(array $orderBy)
    {
        foreach ($orderBy as $column => $direction) {
            $this->CI->db->order_by($column, $direction);
        }
    }
    
    /**
     * Validate data before database operations
     */
    protected function validateData(array $data, $operation = 'create')
    {
        // Override in child classes for specific validation
        return true;
    }
    
    /**
     * Sanitize data before database operations
     */
    protected function sanitizeData(array $data)
    {
        $sanitized = [];
        
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                // Basic XSS protection
                $sanitized[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            } else {
                $sanitized[$key] = $value;
            }
        }
        
        return $sanitized;
    }
    
    /**
     * Begin transaction
     */
    public function beginTransaction()
    {
        $this->CI->db->trans_begin();
    }
    
    /**
     * Commit transaction
     */
    public function commit()
    {
        $this->CI->db->trans_commit();
    }
    
    /**
     * Rollback transaction
     */
    public function rollback()
    {
        $this->CI->db->trans_rollback();
    }
    
    /**
     * Get last query
     */
    public function getLastQuery()
    {
        return $this->CI->db->last_query();
    }
}
