<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'repositories/BaseRepository.php';
require_once APPPATH . 'entities/ManuscriptEntity.php';

/**
 * Manuscript Repository
 * 
 * Handles data access operations for manuscripts
 */
class ManuscriptRepository extends BaseRepository
{
    protected $table = 'ijps_tblmanuscript';
    protected $primaryKey = 'manuscriptID';
    protected $entityClass = 'ManuscriptEntity';
    
    /**
     * Find manuscripts by author email
     */
    public function findByAuthorEmail($email)
    {
        return $this->findBy(['email' => $email], ['submissionDate' => 'DESC']);
    }
    
    /**
     * Find manuscripts by status
     */
    public function findByStatus($statusId)
    {
        return $this->findBy(['statusID' => $statusId], ['submissionDate' => 'DESC']);
    }
    
    /**
     * Find published manuscripts
     */
    public function findPublished($limit = null, $offset = null)
    {
        return $this->findBy(
            ['statusID' => ManuscriptEntity::STATUS_PUBLISHED],
            ['publicationDate' => 'DESC'],
            $limit,
            $offset
        );
    }
    
    /**
     * Find manuscripts under review
     */
    public function findUnderReview()
    {
        return $this->findBy(
            ['statusID' => ManuscriptEntity::STATUS_UNDER_REVIEW],
            ['submissionDate' => 'ASC']
        );
    }
    
    /**
     * Get manuscript statistics by author
     */
    public function getAuthorStatistics($email)
    {
        $this->CI->db->select('
            COUNT(*) as total_submitted,
            SUM(CASE WHEN statusID = ' . ManuscriptEntity::STATUS_PUBLISHED . ' THEN 1 ELSE 0 END) as published,
            SUM(CASE WHEN statusID = ' . ManuscriptEntity::STATUS_UNDER_REVIEW . ' THEN 1 ELSE 0 END) as under_review,
            SUM(CASE WHEN statusID = ' . ManuscriptEntity::STATUS_REVISION_REQUIRED . ' THEN 1 ELSE 0 END) as needs_revision
        ');
        $this->CI->db->where('email', $email);
        $this->CI->db->where('isActive', '1');
        
        $query = $this->CI->db->get($this->table);
        return $query->row_array();
    }
    
    /**
     * Search manuscripts
     */
    public function search($query, $filters = [], $limit = null, $offset = null)
    {
        $this->CI->db->group_start();
        $this->CI->db->like('title', $query);
        $this->CI->db->or_like('abstract', $query);
        $this->CI->db->or_like('keywords', $query);
        $this->CI->db->group_end();
        
        // Apply additional filters
        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $this->CI->db->where($key, $value);
            }
        }
        
        $this->CI->db->where('isActive', '1');
        $this->CI->db->order_by('submissionDate', 'DESC');
        
        if ($limit !== null) {
            $this->CI->db->limit($limit, $offset);
        }
        
        $query = $this->CI->db->get($this->table);
        $results = $query->result_array();
        
        return array_map(function($data) {
            return new ManuscriptEntity($data);
        }, $results);
    }
    
    /**
     * Get manuscripts by date range
     */
    public function findByDateRange($startDate, $endDate, $dateField = 'submissionDate')
    {
        $this->CI->db->where($dateField . ' >=', $startDate);
        $this->CI->db->where($dateField . ' <=', $endDate);
        $this->CI->db->where('isActive', '1');
        $this->CI->db->order_by($dateField, 'DESC');
        
        $query = $this->CI->db->get($this->table);
        $results = $query->result_array();
        
        return array_map(function($data) {
            return new ManuscriptEntity($data);
        }, $results);
    }
    
    /**
     * Update manuscript status
     */
    public function updateStatus($id, $statusId, $notes = null)
    {
        $data = [
            'statusID' => $statusId,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Add specific date fields based on status
        switch ($statusId) {
            case ManuscriptEntity::STATUS_UNDER_REVIEW:
                $data['reviewDate'] = date('Y-m-d H:i:s');
                break;
            case ManuscriptEntity::STATUS_PUBLISHED:
                $data['publicationDate'] = date('Y-m-d H:i:s');
                break;
        }
        
        if ($notes) {
            $data['notes'] = $notes;
        }
        
        return $this->update($id, $data);
    }
    
    /**
     * Get monthly submission statistics
     */
    public function getMonthlySubmissionStats($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }
        
        $this->CI->db->select('
            MONTH(submissionDate) as month,
            COUNT(*) as total_submissions,
            SUM(CASE WHEN statusID = ' . ManuscriptEntity::STATUS_PUBLISHED . ' THEN 1 ELSE 0 END) as published
        ');
        $this->CI->db->where('YEAR(submissionDate)', $year);
        $this->CI->db->where('isActive', '1');
        $this->CI->db->group_by('MONTH(submissionDate)');
        $this->CI->db->order_by('month', 'ASC');
        
        $query = $this->CI->db->get($this->table);
        return $query->result_array();
    }
    
    /**
     * Validate data before operations
     */
    protected function validateData(array $data, $operation = 'create')
    {
        if ($operation === 'create') {
            // Generate unique code if not provided
            if (empty($data['uniqueCode'])) {
                $data['uniqueCode'] = $this->generateUniqueCode();
            }
            
            // Set submission date if not provided
            if (empty($data['submissionDate'])) {
                $data['submissionDate'] = date('Y-m-d H:i:s');
            }
            
            // Set default status if not provided
            if (empty($data['statusID'])) {
                $data['statusID'] = ManuscriptEntity::STATUS_SUBMITTED;
            }
        }
        
        return parent::validateData($data, $operation);
    }
    
    /**
     * Generate unique manuscript code
     */
    private function generateUniqueCode()
    {
        do {
            $year = date('Y');
            $month = date('m');
            $random = strtoupper(substr(md5(uniqid()), 0, 6));
            $code = "IJPS{$year}{$month}{$random}";
        } while ($this->exists(['uniqueCode' => $code]));
        
        return $code;
    }
}
