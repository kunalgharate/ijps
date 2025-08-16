<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'entities/BaseEntity.php';

/**
 * Manuscript Entity
 * 
 * Represents a manuscript in the system
 */
class ManuscriptEntity extends BaseEntity
{
    protected $table = 'ijps_tblmanuscript';
    protected $primaryKey = 'manuscriptID';
    
    protected $fillable = [
        'title',
        'abstract',
        'keywords',
        'email',
        'statusID',
        'uniqueCode',
        'submissionDate',
        'reviewDate',
        'publicationDate',
        'isActive'
    ];
    
    protected $guarded = [
        'manuscriptID',
        'created_at',
        'updated_at'
    ];
    
    protected $hidden = [
        'deleted_at'
    ];
    
    protected $casts = [
        'manuscriptID' => 'int',
        'statusID' => 'int',
        'isActive' => 'bool',
        'submissionDate' => 'datetime',
        'reviewDate' => 'datetime',
        'publicationDate' => 'datetime'
    ];
    
    // Status constants
    const STATUS_SUBMITTED = 1;
    const STATUS_UNDER_REVIEW = 2;
    const STATUS_REVISION_REQUIRED = 3;
    const STATUS_PUBLISHED = 4;
    const STATUS_REJECTED = 5;
    
    /**
     * Get validation rules
     */
    protected function getValidationRules()
    {
        return [
            [
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required|min_length[10]|max_length[500]'
            ],
            [
                'field' => 'abstract',
                'label' => 'Abstract',
                'rules' => 'required|min_length[100]|max_length[2000]'
            ],
            [
                'field' => 'keywords',
                'label' => 'Keywords',
                'rules' => 'required|min_length[5]|max_length[200]'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ],
            [
                'field' => 'statusID',
                'label' => 'Status',
                'rules' => 'required|integer|in_list[1,2,3,4,5]'
            ]
        ];
    }
    
    /**
     * Validate entity data
     */
    public function validate()
    {
        $CI =& get_instance();
        $CI->load->library('form_validation');
        
        $rules = $this->getValidationRules();
        $CI->form_validation->set_data($this->toArray());
        $CI->form_validation->set_rules($rules);
        
        if (!$CI->form_validation->run()) {
            throw new InvalidArgumentException($CI->form_validation->error_string());
        }
        
        return true;
    }
    
    /**
     * Check if manuscript is published
     */
    public function isPublished()
    {
        return $this->statusID === self::STATUS_PUBLISHED;
    }
    
    /**
     * Check if manuscript is under review
     */
    public function isUnderReview()
    {
        return $this->statusID === self::STATUS_UNDER_REVIEW;
    }
    
    /**
     * Check if manuscript needs revision
     */
    public function needsRevision()
    {
        return $this->statusID === self::STATUS_REVISION_REQUIRED;
    }
    
    /**
     * Get status text
     */
    public function getStatusText()
    {
        $statuses = [
            self::STATUS_SUBMITTED => 'Submitted',
            self::STATUS_UNDER_REVIEW => 'Under Review',
            self::STATUS_REVISION_REQUIRED => 'Revision Required',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_REJECTED => 'Rejected'
        ];
        
        return $statuses[$this->statusID] ?? 'Unknown';
    }
    
    /**
     * Generate unique code
     */
    public function generateUniqueCode()
    {
        $year = date('Y');
        $month = date('m');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        
        $this->uniqueCode = "IJPS{$year}{$month}{$random}";
        return $this->uniqueCode;
    }
    
    /**
     * Get formatted submission date
     */
    public function getFormattedSubmissionDate($format = 'Y-m-d H:i:s')
    {
        if ($this->submissionDate instanceof DateTime) {
            return $this->submissionDate->format($format);
        }
        
        return $this->submissionDate ? date($format, strtotime($this->submissionDate)) : null;
    }
    
    /**
     * Get word count estimate
     */
    public function getWordCount()
    {
        $text = strip_tags($this->abstract . ' ' . $this->title);
        return str_word_count($text);
    }
    
    /**
     * Get keywords as array
     */
    public function getKeywordsArray()
    {
        return array_map('trim', explode(',', $this->keywords));
    }
}
