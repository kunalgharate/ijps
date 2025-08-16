<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'services/ManuscriptService.php';
require_once APPPATH . 'dto/ManuscriptDTO.php';

/**
 * Refactored Home Controller
 * 
 * Demonstrates new architecture with proper separation of concerns
 * Uses Services, DTOs, and proper error handling
 */
class HomeControllerRefactored extends CI_Controller
{
    private $manuscriptService;
    private $per_page = 15;
    
    public function __construct()
    {
        parent::__construct();
        
        // Load required libraries and helpers
        $this->load->library(['session', 'form_validation', 'pagination']);
        $this->load->helper(['url', 'form', 'security']);
        
        // Initialize services
        $this->manuscriptService = new ManuscriptService();
        
        // Enable CSRF protection
        $this->_enableCSRFProtection();
        
        // Set security headers
        $this->_setSecurityHeaders();
    }
    
    /**
     * Dashboard - Shows user's manuscript statistics and recent activity
     */
    public function dashboard()
    {
        try {
            // Check authentication
            if (!$this->_isAuthenticated()) {
                redirect('login', 'refresh');
                return;
            }
            
            $userEmail = $this->session->userdata('authorMailID');
            
            // Get user statistics using service
            $statistics = $this->manuscriptService->getAuthorStatistics($userEmail);
            
            // Get recent manuscripts
            $recentManuscripts = $this->manuscriptService->getManuscriptsByAuthor($userEmail, 1, 5);
            
            // Prepare view data
            $data = [
                'page_title' => 'Dashboard',
                'statistics' => $statistics,
                'recent_manuscripts' => $recentManuscripts['data'],
                'csrf_token' => $this->security->get_csrf_hash()
            ];
            
            // Load view with proper data escaping
            $this->_loadView('frontend/dashboard', $data);
            
        } catch (Exception $e) {
            log_message('error', 'Dashboard error: ' . $e->getMessage());
            $this->_showError('Unable to load dashboard. Please try again.');
        }
    }
    
    /**
     * Manuscript List - Shows paginated list of user's manuscripts
     */
    public function manuscriptlist()
    {
        try {
            // Check authentication
            if (!$this->_isAuthenticated()) {
                redirect('login', 'refresh');
                return;
            }
            
            $userEmail = $this->session->userdata('authorMailID');
            $page = (int) $this->input->get('page') ?: 1;
            
            // Get manuscripts with pagination
            $result = $this->manuscriptService->getManuscriptsByAuthor($userEmail, $page, $this->per_page);
            
            // Setup pagination
            $paginationConfig = $this->_getPaginationConfig('manuscriptlist', $result['pagination']['total']);
            $this->pagination->initialize($paginationConfig);
            
            // Prepare view data
            $data = [
                'page_title' => 'My Manuscripts',
                'manuscripts' => $result['data'],
                'pagination' => $this->pagination->create_links(),
                'total_count' => $result['pagination']['total'],
                'csrf_token' => $this->security->get_csrf_hash()
            ];
            
            $this->_loadView('frontend/manuscript-list', $data);
            
        } catch (Exception $e) {
            log_message('error', 'Manuscript list error: ' . $e->getMessage());
            $this->_showError('Unable to load manuscripts. Please try again.');
        }
    }
    
    /**
     * Submit Manuscript - Handle manuscript submission
     */
    public function submit_manuscript()
    {
        try {
            // Check authentication
            if (!$this->_isAuthenticated()) {
                $this->_jsonResponse(['success' => false, 'message' => 'Authentication required'], 401);
                return;
            }
            
            if ($this->input->method() === 'post') {
                // Validate CSRF token
                if (!$this->_validateCSRF()) {
                    $this->_jsonResponse(['success' => false, 'message' => 'Invalid request'], 403);
                    return;
                }
                
                // Get form data
                $formData = $this->input->post();
                $formData['email'] = $this->session->userdata('authorMailID');
                
                // Create DTO for validation
                $manuscriptDTO = ManuscriptDTO::forSubmission($formData);
                
                // Handle file uploads
                $files = $_FILES ?? [];
                
                // Submit manuscript using service
                $manuscript = $this->manuscriptService->submitManuscript($manuscriptDTO->toDbArray(), $files);
                
                if ($manuscript) {
                    $this->_jsonResponse([
                        'success' => true,
                        'message' => 'Manuscript submitted successfully',
                        'manuscript_id' => $manuscript->manuscriptID,
                        'unique_code' => $manuscript->uniqueCode
                    ]);
                } else {
                    $this->_jsonResponse(['success' => false, 'message' => 'Submission failed'], 500);
                }
                
            } else {
                // Show submission form
                $data = [
                    'page_title' => 'Submit Manuscript',
                    'csrf_token' => $this->security->get_csrf_hash()
                ];
                
                $this->_loadView('frontend/submit-manuscript', $data);
            }
            
        } catch (InvalidArgumentException $e) {
            $this->_jsonResponse(['success' => false, 'message' => $e->getMessage()], 400);
        } catch (Exception $e) {
            log_message('error', 'Manuscript submission error: ' . $e->getMessage());
            $this->_jsonResponse(['success' => false, 'message' => 'Submission failed. Please try again.'], 500);
        }
    }
    
    /**
     * Home Page - Shows published articles and general information
     */
    public function index()
    {
        try {
            // Get published manuscripts for homepage
            $publishedManuscripts = $this->manuscriptService->getPublishedManuscripts(10);
            
            // Get other homepage data (newsletters, etc.)
            $this->load->model('CommonModel');
            $newsletters = $this->CommonModel->getDataLimit('ijps_tblnewsletter', 
                ['isActive' => '1'], '', '', '', '3', '', 'newsletterID', 'DESC');
            
            // Prepare view data
            $data = [
                'page_title' => 'International Journal of Pharmaceutical Sciences',
                'published_articles' => $publishedManuscripts,
                'newsletters' => $newsletters,
                'meta_description' => 'Leading international journal for pharmaceutical sciences research and publications',
                'meta_keywords' => 'pharmaceutical sciences, research, journal, publications'
            ];
            
            $this->_loadView('frontend/home', $data);
            
        } catch (Exception $e) {
            log_message('error', 'Homepage error: ' . $e->getMessage());
            $this->_showError('Unable to load homepage. Please try again.');
        }
    }
    
    /**
     * Search Manuscripts
     */
    public function search()
    {
        try {
            $query = $this->input->get('q');
            $filters = [
                'status' => $this->input->get('status'),
                'year' => $this->input->get('year')
            ];
            $page = (int) $this->input->get('page') ?: 1;
            
            if (empty($query)) {
                $this->_jsonResponse(['success' => false, 'message' => 'Search query required'], 400);
                return;
            }
            
            // Perform search using service
            $result = $this->manuscriptService->searchManuscripts($query, $filters, $page, $this->per_page);
            
            if ($this->input->is_ajax_request()) {
                $this->_jsonResponse([
                    'success' => true,
                    'data' => $result['data'],
                    'pagination' => $result['pagination']
                ]);
            } else {
                // Setup pagination for regular request
                $paginationConfig = $this->_getPaginationConfig('search', $result['pagination']['total']);
                $paginationConfig['suffix'] = '&q=' . urlencode($query);
                $this->pagination->initialize($paginationConfig);
                
                $data = [
                    'page_title' => 'Search Results',
                    'query' => $query,
                    'results' => $result['data'],
                    'pagination' => $this->pagination->create_links(),
                    'total_count' => $result['pagination']['total']
                ];
                
                $this->_loadView('frontend/search-results', $data);
            }
            
        } catch (Exception $e) {
            log_message('error', 'Search error: ' . $e->getMessage());
            
            if ($this->input->is_ajax_request()) {
                $this->_jsonResponse(['success' => false, 'message' => 'Search failed'], 500);
            } else {
                $this->_showError('Search failed. Please try again.');
            }
        }
    }
    
    /**
     * Check if user is authenticated
     */
    private function _isAuthenticated()
    {
        return !empty($this->session->userdata('authorMailID')) && 
               !empty($this->session->userdata('name'));
    }
    
    /**
     * Enable CSRF protection
     */
    private function _enableCSRFProtection()
    {
        $this->config->set_item('csrf_protection', TRUE);
        $this->config->set_item('csrf_token_name', 'csrf_token');
        $this->config->set_item('csrf_cookie_name', 'csrf_cookie');
        $this->config->set_item('csrf_expire', 7200);
    }
    
    /**
     * Validate CSRF token
     */
    private function _validateCSRF()
    {
        $token = $this->input->post('csrf_token') ?: $this->input->get('csrf_token');
        return $this->security->csrf_verify();
    }
    
    /**
     * Set security headers
     */
    private function _setSecurityHeaders()
    {
        $this->output->set_header('X-Content-Type-Options: nosniff');
        $this->output->set_header('X-Frame-Options: DENY');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        $this->output->set_header('Referrer-Policy: strict-origin-when-cross-origin');
    }
    
    /**
     * Load view with common data and security measures
     */
    private function _loadView($view, $data = [])
    {
        // Add common data
        $commonData = [
            'current_user' => $this->session->userdata(),
            'base_url' => base_url(),
            'site_title' => 'IJPS - International Journal of Pharmaceutical Sciences'
        ];
        
        $data = array_merge($commonData, $data);
        
        // Escape output data for XSS protection
        $data = $this->_escapeData($data);
        
        // Load view
        $this->load->view($view, $data);
    }
    
    /**
     * Escape data for XSS protection
     */
    private function _escapeData($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    $data[$key] = html_escape($value);
                } elseif (is_array($value)) {
                    $data[$key] = $this->_escapeData($value);
                }
            }
        }
        
        return $data;
    }
    
    /**
     * Send JSON response
     */
    private function _jsonResponse($data, $statusCode = 200)
    {
        $this->output
            ->set_status_header($statusCode)
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
    
    /**
     * Show error page
     */
    private function _showError($message)
    {
        $data = [
            'page_title' => 'Error',
            'error_message' => $message
        ];
        
        $this->_loadView('frontend/error', $data);
    }
    
    /**
     * Get pagination configuration
     */
    private function _getPaginationConfig($baseUrl, $totalRows)
    {
        return [
            'base_url' => base_url($baseUrl),
            'total_rows' => $totalRows,
            'per_page' => $this->per_page,
            'use_page_numbers' => TRUE,
            'page_query_string' => TRUE,
            'query_string_segment' => 'page',
            'full_tag_open' => '<nav><ul class="pagination">',
            'full_tag_close' => '</ul></nav>',
            'first_link' => 'First',
            'last_link' => 'Last',
            'first_tag_open' => '<li class="page-item">',
            'first_tag_close' => '</li>',
            'prev_link' => '&laquo;',
            'prev_tag_open' => '<li class="page-item">',
            'prev_tag_close' => '</li>',
            'next_link' => '&raquo;',
            'next_tag_open' => '<li class="page-item">',
            'next_tag_close' => '</li>',
            'last_tag_open' => '<li class="page-item">',
            'last_tag_close' => '</li>',
            'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close' => '</span></li>',
            'num_tag_open' => '<li class="page-item">',
            'num_tag_close' => '</li>',
            'attributes' => ['class' => 'page-link']
        ];
    }
}
