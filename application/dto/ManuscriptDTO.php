<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'dto/BaseDTO.php';

/**
 * Manuscript Data Transfer Object
 * 
 * Handles data transfer for manuscript operations
 */
class ManuscriptDTO extends BaseDTO
{
    public $title;
    public $abstract;
    public $keywords;
    public $email;
    public $authorName;
    public $authorAffiliation;
    public $statusID;
    public $uniqueCode;
    public $submissionDate;
    public $reviewDate;
    public $publicationDate;
    public $notes;
    public $attachments;
    public $isActive = 1;
    
    protected $rules = [
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
            'field' => 'authorName',
            'label' => 'Author Name',
            'rules' => 'required|min_length[2]|max_length[100]'
        ]
    ];
    
    protected $messages = [
        'required' => 'The {field} field is required.',
        'min_length' => 'The {field} field must be at least {param} characters long.',
        'max_length' => 'The {field} field cannot exceed {param} characters.',
        'valid_email' => 'The {field} field must contain a valid email address.'
    ];
    
    /**
     * Create DTO for submission
     */
    public static function forSubmission(array $data)
    {
        $dto = new self($data);
        $dto->statusID = 1; // Submitted status
        $dto->submissionDate = date('Y-m-d H:i:s');
        $dto->isActive = 1;
        
        return $dto;
    }
    
    /**
     * Create DTO for status update
     */
    public static function forStatusUpdate($statusID, $notes = null)
    {
        return new self([
            'statusID' => $statusID,
            'notes' => $notes
        ]);
    }
    
    /**
     * Set title with automatic cleaning
     */
    public function setTitle($title)
    {
        $this->title = trim(strip_tags($title));
    }
    
    /**
     * Set abstract with automatic cleaning
     */
    public function setAbstract($abstract)
    {
        $this->abstract = trim(strip_tags($abstract));
    }
    
    /**
     * Set keywords with automatic formatting
     */
    public function setKeywords($keywords)
    {
        if (is_array($keywords)) {
            $this->keywords = implode(', ', array_map('trim', $keywords));
        } else {
            $this->keywords = trim($keywords);
        }
    }
    
    /**
     * Get keywords as array
     */
    public function getKeywordsArray()
    {
        return array_map('trim', explode(',', $this->keywords));
    }
    
    /**
     * Set email with validation
     */
    public function setEmail($email)
    {
        $this->email = strtolower(trim($email));
    }
    
    /**
     * Set author name with proper formatting
     */
    public function setAuthorName($name)
    {
        $this->authorName = ucwords(strtolower(trim($name)));
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
     * Check if manuscript is published
     */
    public function isPublished()
    {
        return $this->statusID == 4;
    }
    
    /**
     * Check if manuscript is under review
     */
    public function isUnderReview()
    {
        return $this->statusID == 2;
    }
    
    /**
     * Get status text
     */
    public function getStatusText()
    {
        $statuses = [
            1 => 'Submitted',
            2 => 'Under Review',
            3 => 'Revision Required',
            4 => 'Published',
            5 => 'Rejected'
        ];
        
        return $statuses[$this->statusID] ?? 'Unknown';
    }
    
    /**
     * Get word count
     */
    public function getWordCount()
    {
        $text = strip_tags($this->abstract . ' ' . $this->title);
        return str_word_count($text);
    }
    
    /**
     * Validate for submission
     */
    public function validateForSubmission()
    {
        // Additional validation specific to submission
        if (empty($this->uniqueCode)) {
            $this->generateUniqueCode();
        }
        
        if (empty($this->submissionDate)) {
            $this->submissionDate = date('Y-m-d H:i:s');
        }
        
        return $this->validate();
    }
    
    /**
     * Convert to array for database insertion
     */
    public function toDbArray()
    {
        $array = $this->toArray();
        
        // Remove null values
        $array = array_filter($array, function($value) {
            return $value !== null;
        });
        
        return $array;
    }
    
    /**
     * Convert to array for API response
     */
    public function toApiArray()
    {
        $array = $this->toArray();
        
        // Add computed fields
        $array['status_text'] = $this->getStatusText();
        $array['word_count'] = $this->getWordCount();
        $array['keywords_array'] = $this->getKeywordsArray();
        
        // Format dates
        if ($this->submissionDate) {
            $array['formatted_submission_date'] = date('M d, Y', strtotime($this->submissionDate));
        }
        
        if ($this->publicationDate) {
            $array['formatted_publication_date'] = date('M d, Y', strtotime($this->publicationDate));
        }
        
        return $array;
    }
}
