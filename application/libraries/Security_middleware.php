<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Security Middleware
 * Automatically applies security protections to all requests
 */
class Security_middleware {
    
    private $CI;
    private $config;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->config('security');
        $this->config = $this->CI->config->item('security');
        
        // Load required helpers and libraries
        $this->CI->load->helper('security');
        $this->CI->load->library('session');
        
        // Initialize security middleware
        $this->init();
    }
    
    /**
     * Initialize security middleware
     */
    private function init() {
        // Apply security headers
        $this->applySecurityHeaders();
        
        // Check maintenance mode
        $this->checkMaintenanceMode();
        
        // Apply IP filtering
        $this->applyIPFiltering();
        
        // Apply rate limiting
        $this->applyRateLimiting();
        
        // Initialize session security
        $this->initSessionSecurity();
    }
    
    /**
     * Apply security headers
     */
    private function applySecurityHeaders() {
        if (!$this->CI->config->item('security_headers')) {
            return;
        }
        
        $headers = $this->CI->config->item('security_headers');
        
        foreach ($headers as $header => $value) {
            if (!headers_sent()) {
                header($header . ': ' . $value);
            }
        }
        
        // Apply Content Security Policy
        if ($this->CI->config->item('csp_enabled')) {
            $this->applyCSP();
        }
        
        // Force HTTPS in production
        if ($this->CI->config->item('force_https') && !$this->isHTTPS()) {
            $this->forceHTTPS();
        }
    }
    
    /**
     * Apply Content Security Policy
     */
    private function applyCSP() {
        $csp_policy = $this->CI->config->item('csp_policy');
        
        if (!$csp_policy) {
            return;
        }
        
        $csp_string = '';
        foreach ($csp_policy as $directive => $value) {
            $csp_string .= $directive . ' ' . $value . '; ';
        }
        
        if (!headers_sent()) {
            header('Content-Security-Policy: ' . trim($csp_string));
        }
    }
    
    /**
     * Check if request is HTTPS
     */
    private function isHTTPS() {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
               $_SERVER['SERVER_PORT'] == 443 ||
               (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    }
    
    /**
     * Force HTTPS redirect
     */
    private function forceHTTPS() {
        $redirect_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('Location: ' . $redirect_url, true, 301);
        exit();
    }
    
    /**
     * Check maintenance mode
     */
    private function checkMaintenanceMode() {
        if (!$this->CI->config->item('maintenance_mode')) {
            return;
        }
        
        $allowed_ips = $this->CI->config->item('maintenance_allowed_ips');
        $client_ip = $this->CI->input->ip_address();
        
        if (!in_array($client_ip, $allowed_ips)) {
            $message = $this->CI->config->item('maintenance_message');
            show_error($message, 503, 'System Maintenance');
        }
    }
    
    /**
     * Apply IP filtering
     */
    private function applyIPFiltering() {
        $client_ip = $this->CI->input->ip_address();
        
        // Check IP blacklist
        if ($this->CI->config->item('ip_blacklist_enabled')) {
            $blacklist = $this->CI->config->item('ip_blacklist');
            if ($this->isIPInList($client_ip, $blacklist)) {
                log_security_event('ip_blocked', ['ip' => $client_ip]);
                show_error('Access denied', 403);
            }
        }
        
        // Check IP whitelist
        if ($this->CI->config->item('ip_whitelist_enabled')) {
            $whitelist = $this->CI->config->item('ip_whitelist');
            if (!$this->isIPInList($client_ip, $whitelist)) {
                log_security_event('ip_not_whitelisted', ['ip' => $client_ip]);
                show_error('Access denied', 403);
            }
        }
        
        // Check admin IP restrictions
        if ($this->isAdminArea() && $this->CI->config->item('admin_ip_restriction')) {
            $admin_ips = $this->CI->config->item('admin_allowed_ips');
            if (!$this->isIPInList($client_ip, $admin_ips)) {
                log_security_event('admin_ip_blocked', ['ip' => $client_ip]);
                show_error('Admin access denied', 403);
            }
        }
    }
    
    /**
     * Check if IP is in list (supports CIDR notation)
     */
    private function isIPInList($ip, $list) {
        foreach ($list as $allowed_ip) {
            if (strpos($allowed_ip, '/') !== false) {
                // CIDR notation
                if ($this->ipInCIDR($ip, $allowed_ip)) {
                    return true;
                }
            } else {
                // Direct IP match
                if ($ip === $allowed_ip) {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * Check if IP is in CIDR range
     */
    private function ipInCIDR($ip, $cidr) {
        list($subnet, $mask) = explode('/', $cidr);
        return (ip2long($ip) & ~((1 << (32 - $mask)) - 1)) == ip2long($subnet);
    }
    
    /**
     * Check if current request is for admin area
     */
    private function isAdminArea() {
        $uri = $this->CI->uri->uri_string();
        return strpos($uri, 'backoffice') !== false || strpos($uri, 'admin') !== false;
    }
    
    /**
     * Apply rate limiting
     */
    private function applyRateLimiting() {
        if (!$this->CI->config->item('rate_limit_enabled')) {
            return;
        }
        
        $client_ip = $this->CI->input->ip_address();
        $user_id = $this->CI->session->userdata('userID') ?? 'anonymous';
        
        // General rate limiting
        $general_limit = $this->CI->config->item('rate_limit_requests');
        $general_window = $this->CI->config->item('rate_limit_window');
        
        if (!$this->checkRateLimit('general_' . $client_ip, $general_limit, $general_window)) {
            log_security_event('rate_limit_exceeded', [
                'ip' => $client_ip,
                'user_id' => $user_id,
                'type' => 'general'
            ]);
            show_error('Rate limit exceeded. Please try again later.', 429);
        }
        
        // Specific action rate limiting
        $this->applySpecificRateLimits($client_ip, $user_id);
    }
    
    /**
     * Apply specific rate limits for different actions
     */
    private function applySpecificRateLimits($client_ip, $user_id) {
        $uri = $this->CI->uri->uri_string();
        $rate_limits = $this->CI->config->item('rate_limits');
        
        foreach ($rate_limits as $action => $limits) {
            if ($this->isActionRequest($uri, $action)) {
                $identifier = $action . '_' . $client_ip . '_' . $user_id;
                
                if (!$this->checkRateLimit($identifier, $limits['requests'], $limits['window'])) {
                    log_security_event('rate_limit_exceeded', [
                        'ip' => $client_ip,
                        'user_id' => $user_id,
                        'type' => $action
                    ]);
                    show_error('Rate limit exceeded for ' . $action . '. Please try again later.', 429);
                }
            }
        }
    }
    
    /**
     * Check if current request matches specific action
     */
    private function isActionRequest($uri, $action) {
        $patterns = [
            'login' => '/login|authenticate/',
            'password_reset' => '/password|reset/',
            'file_upload' => '/upload|file/',
            'api_calls' => '/api/',
        ];
        
        if (isset($patterns[$action])) {
            return preg_match($patterns[$action], $uri);
        }
        
        return false;
    }
    
    /**
     * Check rate limit using cache
     */
    private function checkRateLimit($identifier, $max_requests, $window) {
        $this->CI->load->driver('cache');
        
        $cache_key = 'rate_limit_' . md5($identifier);
        $current_requests = $this->CI->cache->get($cache_key) ?: 0;
        
        if ($current_requests >= $max_requests) {
            return false;
        }
        
        $this->CI->cache->save($cache_key, $current_requests + 1, $window);
        return true;
    }
    
    /**
     * Initialize session security
     */
    private function initSessionSecurity() {
        // Set secure session configuration
        if ($this->CI->config->item('cookie_secure')) {
            ini_set('session.cookie_secure', 1);
        }
        
        if ($this->CI->config->item('cookie_httponly')) {
            ini_set('session.cookie_httponly', 1);
        }
        
        $samesite = $this->CI->config->item('cookie_samesite');
        if ($samesite) {
            ini_set('session.cookie_samesite', $samesite);
        }
        
        // Check session timeout for admin users
        if ($this->isAdminArea()) {
            $this->checkAdminSessionTimeout();
        }
        
        // Regenerate session ID periodically
        $this->regenerateSessionID();
    }
    
    /**
     * Check admin session timeout
     */
    private function checkAdminSessionTimeout() {
        $timeout = $this->CI->config->item('admin_session_timeout');
        $last_activity = $this->CI->session->userdata('last_activity');
        
        if ($last_activity && (time() - $last_activity > $timeout)) {
            $this->CI->session->sess_destroy();
            log_security_event('admin_session_timeout', [
                'user_id' => $this->CI->session->userdata('userID')
            ]);
            redirect('backoffice/LoginController');
        }
        
        $this->CI->session->set_userdata('last_activity', time());
    }
    
    /**
     * Regenerate session ID periodically
     */
    private function regenerateSessionID() {
        $last_regeneration = $this->CI->session->userdata('last_regeneration');
        $regeneration_interval = 300; // 5 minutes
        
        if (!$last_regeneration || (time() - $last_regeneration > $regeneration_interval)) {
            $this->CI->session->sess_regenerate(true);
            $this->CI->session->set_userdata('last_regeneration', time());
        }
    }
    
    /**
     * Validate input data
     */
    public function validateInput($data, $rules) {
        $this->CI->load->library('form_validation');
        
        foreach ($rules as $field => $rule) {
            $this->CI->form_validation->set_rules($field, ucfirst($field), $rule);
        }
        
        if (!$this->CI->form_validation->run($data)) {
            return [
                'valid' => false,
                'errors' => $this->CI->form_validation->error_array()
            ];
        }
        
        return ['valid' => true, 'data' => $data];
    }
    
    /**
     * Detect and prevent SQL injection attempts
     */
    public function detectSQLInjection($input) {
        $sql_patterns = [
            '/(\b(SELECT|INSERT|UPDATE|DELETE|DROP|CREATE|ALTER|EXEC|UNION|SCRIPT)\b)/i',
            '/(\b(OR|AND)\s+\d+\s*=\s*\d+)/i',
            '/(\b(OR|AND)\s+[\'"]?\w+[\'"]?\s*=\s*[\'"]?\w+[\'"]?)/i',
            '/(\-\-|\#|\/\*|\*\/)/i',
            '/([\'"]\s*(OR|AND)\s*[\'"]\s*=\s*[\'"]\s*)/i'
        ];
        
        foreach ($sql_patterns as $pattern) {
            if (preg_match($pattern, $input)) {
                log_security_event('sql_injection_attempt', [
                    'input' => substr($input, 0, 200),
                    'ip' => $this->CI->input->ip_address(),
                    'user_agent' => $this->CI->input->user_agent()
                ]);
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Detect XSS attempts
     */
    public function detectXSS($input) {
        $xss_patterns = [
            '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi',
            '/javascript:/i',
            '/vbscript:/i',
            '/onload\s*=/i',
            '/onerror\s*=/i',
            '/<iframe/i',
            '/<object/i',
            '/<embed/i'
        ];
        
        foreach ($xss_patterns as $pattern) {
            if (preg_match($pattern, $input)) {
                log_security_event('xss_attempt', [
                    'input' => substr($input, 0, 200),
                    'ip' => $this->CI->input->ip_address(),
                    'user_agent' => $this->CI->input->user_agent()
                ]);
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Clean and validate file upload
     */
    public function validateFileUpload($file, $type = 'image') {
        $allowed_types = $this->CI->config->item('allowed_file_types')[$type] ?? [];
        $max_size = $this->CI->config->item('max_file_size')[$type] ?? 2097152;
        
        $validation_errors = validate_file_upload($file, $allowed_types, $max_size);
        
        if (!empty($validation_errors)) {
            log_security_event('file_upload_violation', [
                'errors' => $validation_errors,
                'file_name' => $file['name'] ?? 'unknown',
                'file_size' => $file['size'] ?? 0,
                'ip' => $this->CI->input->ip_address()
            ]);
            return ['valid' => false, 'errors' => $validation_errors];
        }
        
        return ['valid' => true];
    }
    
    /**
     * Log security event
     */
    public function logSecurityEvent($event, $details = []) {
        if (!$this->CI->config->item('security_logging_enabled')) {
            return;
        }
        
        $log_events = $this->CI->config->item('log_security_events');
        
        if (!in_array($event, $log_events)) {
            return;
        }
        
        log_security_event($event, $details);
    }
}
