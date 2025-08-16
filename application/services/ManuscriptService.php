<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'services/BaseService.php';
require_once APPPATH . 'repositories/ManuscriptRepository.php';

/**
 * Manuscript Service
 * 
 * Handles business logic for manuscript operations
 */
class ManuscriptService extends BaseService
{
    protected $repository;
    private $emailService;
    private $fileService;
    
    public function __construct()
    {
        parent::__construct();
        $this->repository = new ManuscriptRepository();
        
        // Load additional services
        $this->CI->load->library('email');
        $this->CI->load->helper('file');
    }
    
    /**
     * Submit new manuscript
     */
    public function submitManuscript(array $data, $files = [])
    {
        try {
            $this->validateSubmissionData($data);
            
            $this->repository->beginTransaction();
            
            // Process file uploads if any
            if (!empty($files)) {
                $data['attachments'] = $this->processFileUploads($files);
            }
            
            // Create manuscript
            $manuscript = $this->repository->create($data);
            
            if ($manuscript) {
                $this->repository->commit();
                
                // Send confirmation email
                $this->sendSubmissionConfirmation($manuscript);
                
                // Log activity
                $this->logActivity('manuscript_submitted', $manuscript->manuscriptID, $data);
                
                return $manuscript;
            } else {
                $this->repository->rollback();
                throw new Exception('Failed to submit manuscript');
            }
        } catch (Exception $e) {
            $this->repository->rollback();
            log_message('error', 'Manuscript submission error: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Update manuscript status
     */
    public function updateStatus($manuscriptId, $statusId, $notes = null, $notifyAuthor = true)
    {
        try {
            $manuscript = $this->repository->findOrFail($manuscriptId);
            
            $this->repository->beginTransaction();
            
            $result = $this->repository->updateStatus($manuscriptId, $statusId, $notes);
            
            if ($result) {
                $this->repository->commit();
                
                // Get updated manuscript
                $updatedManuscript = $this->repository->find($manuscriptId);
                
                // Send notification email if requested
                if ($notifyAuthor) {
                    $this->sendStatusUpdateNotification($updatedManuscript, $notes);
                }
                
                // Log activity
                $this->logActivity('status_updated', $manuscriptId, [
                    'old_status' => $manuscript->statusID,
                    'new_status' => $statusId,
                    'notes' => $notes
                ]);
                
                return $updatedManuscript;
            } else {
                $this->repository->rollback();
                throw new Exception('Failed to update manuscript status');
            }
        } catch (Exception $e) {
            $this->repository->rollback();
            log_message('error', 'Status update error: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Get manuscripts by author
     */
    public function getManuscriptsByAuthor($email, $page = 1, $perPage = 10)
    {
        try {
            $manuscripts = $this->repository->findByAuthorEmail($email);
            
            // Add additional data for each manuscript
            foreach ($manuscripts as &$manuscript) {
                $manuscript = $this->enrichManuscriptData($manuscript);
            }
            
            // Paginate results
            $total = count($manuscripts);
            $offset = ($page - 1) * $perPage;
            $paginatedData = array_slice($manuscripts, $offset, $perPage);
            
            return [
                'data' => $paginatedData,
                'pagination' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'last_page' => ceil($total / $perPage)
                ]
            ];
        } catch (Exception $e) {
            log_message('error', 'Error fetching author manuscripts: ' . $e->getMessage());
            throw new Exception('Failed to retrieve manuscripts');
        }
    }
    
    /**
     * Get author statistics
     */
    public function getAuthorStatistics($email)
    {
        try {
            $stats = $this->repository->getAuthorStatistics($email);
            
            // Calculate additional metrics
            $stats['pending'] = $stats['total_submitted'] - $stats['published'];
            $stats['success_rate'] = $stats['total_submitted'] > 0 
                ? round(($stats['published'] / $stats['total_submitted']) * 100, 2) 
                : 0;
            
            return $stats;
        } catch (Exception $e) {
            log_message('error', 'Error fetching author statistics: ' . $e->getMessage());
            throw new Exception('Failed to retrieve statistics');
        }
    }
    
    /**
     * Search manuscripts
     */
    public function searchManuscripts($query, $filters = [], $page = 1, $perPage = 15)
    {
        try {
            $offset = ($page - 1) * $perPage;
            $manuscripts = $this->repository->search($query, $filters, $perPage, $offset);
            
            // Get total count for pagination
            $totalQuery = $this->repository->search($query, $filters);
            $total = count($totalQuery);
            
            return [
                'data' => $manuscripts,
                'pagination' => [
                    'current_page' => $page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'last_page' => ceil($total / $perPage)
                ]
            ];
        } catch (Exception $e) {
            log_message('error', 'Manuscript search error: ' . $e->getMessage());
            throw new Exception('Search failed');
        }
    }
    
    /**
     * Get published manuscripts for homepage
     */
    public function getPublishedManuscripts($limit = 10)
    {
        try {
            $manuscripts = $this->repository->findPublished($limit);
            
            // Enrich with additional data
            foreach ($manuscripts as &$manuscript) {
                $manuscript = $this->enrichManuscriptData($manuscript);
            }
            
            return $manuscripts;
        } catch (Exception $e) {
            log_message('error', 'Error fetching published manuscripts: ' . $e->getMessage());
            throw new Exception('Failed to retrieve published manuscripts');
        }
    }
    
    /**
     * Validate submission data
     */
    private function validateSubmissionData(array $data)
    {
        $rules = [
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
            ]
        ];
        
        $this->validator->set_data($data);
        $this->validator->set_rules($rules);
        
        if (!$this->validator->run()) {
            throw new InvalidArgumentException($this->validator->error_string());
        }
    }
    
    /**
     * Process file uploads
     */
    private function processFileUploads($files)
    {
        $uploadedFiles = [];
        
        // Configure upload settings
        $config['upload_path'] = './uploads/manuscripts/';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 10240; // 10MB
        $config['encrypt_name'] = TRUE;
        
        $this->CI->load->library('upload', $config);
        
        foreach ($files as $fieldName => $file) {
            if ($this->CI->upload->do_upload($fieldName)) {
                $uploadData = $this->CI->upload->data();
                $uploadedFiles[$fieldName] = $uploadData['file_name'];
            } else {
                throw new Exception('File upload failed: ' . $this->CI->upload->display_errors());
            }
        }
        
        return json_encode($uploadedFiles);
    }
    
    /**
     * Send submission confirmation email
     */
    private function sendSubmissionConfirmation($manuscript)
    {
        try {
            $this->CI->email->clear();
            $this->CI->email->from('noreply@ijps.com', 'IJPS Editorial Team');
            $this->CI->email->to($manuscript->email);
            $this->CI->email->subject('Manuscript Submission Confirmation - ' . $manuscript->uniqueCode);
            
            $message = $this->CI->load->view('emails/submission_confirmation', [
                'manuscript' => $manuscript
            ], TRUE);
            
            $this->CI->email->message($message);
            $this->CI->email->send();
        } catch (Exception $e) {
            log_message('error', 'Failed to send confirmation email: ' . $e->getMessage());
        }
    }
    
    /**
     * Send status update notification
     */
    private function sendStatusUpdateNotification($manuscript, $notes = null)
    {
        try {
            $this->CI->email->clear();
            $this->CI->email->from('noreply@ijps.com', 'IJPS Editorial Team');
            $this->CI->email->to($manuscript->email);
            $this->CI->email->subject('Manuscript Status Update - ' . $manuscript->uniqueCode);
            
            $message = $this->CI->load->view('emails/status_update', [
                'manuscript' => $manuscript,
                'notes' => $notes
            ], TRUE);
            
            $this->CI->email->message($message);
            $this->CI->email->send();
        } catch (Exception $e) {
            log_message('error', 'Failed to send status update email: ' . $e->getMessage());
        }
    }
    
    /**
     * Enrich manuscript data with additional information
     */
    private function enrichManuscriptData($manuscript)
    {
        // Add author information, article details, etc.
        // This would typically involve additional repository calls
        
        return $manuscript;
    }
    
    /**
     * Get create validation rules
     */
    protected function getCreateValidationRules()
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
            ]
        ];
    }
}
