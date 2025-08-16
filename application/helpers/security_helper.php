<?php
/**
 * Security Helper
 * Provides security functions for CSRF protection, input validation, and XSS prevention
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Generate CSRF token field for forms
 */
if (!function_exists('csrf_field')) {
    function csrf_field() {
        $CI =& get_instance();
        $csrf_name = $CI->security->get_csrf_token_name();
        $csrf_hash = $CI->security->get_csrf_hash();
        
        return '<input type="hidden" name="' . $csrf_name . '" value="' . $csrf_hash . '" />';
    }
}

/**
 * Generate CSRF meta tags for AJAX requests
 */
if (!function_exists('csrf_meta')) {
    function csrf_meta() {
        $CI =& get_instance();
        $csrf_name = $CI->security->get_csrf_token_name();
        $csrf_hash = $CI->security->get_csrf_hash();
        
        return '<meta name="csrf-token-name" content="' . $csrf_name . '">' . 
               '<meta name="csrf-token" content="' . $csrf_hash . '">';
    }
}

/**
 * Validate and sanitize input data
 */
if (!function_exists('secure_input')) {
    function secure_input($input, $type = 'string', $max_length = null) {
        if (empty($input)) {
            return '';
        }
        
        switch ($type) {
            case 'int':
                $result = filter_var($input, FILTER_VALIDATE_INT);
                return ($result !== false) ? $result : 0;
                
            case 'float':
                $result = filter_var($input, FILTER_VALIDATE_FLOAT);
                return ($result !== false) ? $result : 0.0;
                
            case 'email':
                return filter_var($input, FILTER_VALIDATE_EMAIL) ?: '';
                
            case 'url':
                return filter_var($input, FILTER_VALIDATE_URL) ?: '';
                
            case 'alphanumeric':
                $result = preg_replace('/[^a-zA-Z0-9]/', '', $input);
                break;
                
            case 'filename':
                $result = preg_replace('/[^a-zA-Z0-9._-]/', '', $input);
                break;
                
            case 'string':
            default:
                $result = htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
                break;
        }
        
        if ($max_length && strlen($result) > $max_length) {
            $result = substr($result, 0, $max_length);
        }
        
        return $result;
    }
}

/**
 * Secure output for preventing XSS
 */
if (!function_exists('secure_output')) {
    function secure_output($data, $allow_html = false) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = secure_output($value, $allow_html);
            }
            return $data;
        }
        
        if (!is_string($data)) {
            return $data;
        }
        
        if ($allow_html) {
            // Allow only safe HTML tags
            $allowed_tags = '<p><br><strong><em><u><ol><ul><li><a><h1><h2><h3><h4><h5><h6>';
            return strip_tags($data, $allowed_tags);
        }
        
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Validate file upload security
 */
if (!function_exists('validate_file_upload')) {
    function validate_file_upload($file, $allowed_types = [], $max_size = 2097152) {
        $errors = [];
        
        // Check if file was uploaded
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            $errors[] = 'No file uploaded';
            return $errors;
        }
        
        // Check file size
        if ($file['size'] > $max_size) {
            $errors[] = 'File size exceeds limit (' . ($max_size / 1024 / 1024) . 'MB)';
        }
        
        // Check MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!empty($allowed_types) && !in_array($mime_type, $allowed_types)) {
            $errors[] = 'Invalid file type: ' . $mime_type;
        }
        
        // Check for malicious content
        $file_content = file_get_contents($file['tmp_name'], false, null, 0, 1024);
        $dangerous_patterns = [
            '/<\?php/i',
            '/<script/i',
            '/javascript:/i',
            '/vbscript:/i',
            '/onload=/i',
            '/onerror=/i'
        ];
        
        foreach ($dangerous_patterns as $pattern) {
            if (preg_match($pattern, $file_content)) {
                $errors[] = 'File contains potentially malicious content';
                break;
            }
        }
        
        return $errors;
    }
}

/**
 * Generate secure random filename
 */
if (!function_exists('generate_secure_filename')) {
    function generate_secure_filename($original_name, $prefix = '') {
        $extension = pathinfo($original_name, PATHINFO_EXTENSION);
        $extension = preg_replace('/[^a-zA-Z0-9]/', '', $extension);
        
        if (empty($extension)) {
            $extension = 'txt';
        }
        
        $random_name = bin2hex(random_bytes(16));
        $timestamp = date('YmdHis');
        
        return $prefix . $timestamp . '_' . $random_name . '.' . $extension;
    }
}

/**
 * Log security events
 */
if (!function_exists('log_security_event')) {
    function log_security_event($event, $details = []) {
        $CI =& get_instance();
        
        $log_data = [
            'event' => $event,
            'user_id' => $CI->session->userdata('userID') ?? 'anonymous',
            'ip_address' => $CI->input->ip_address(),
            'user_agent' => $CI->input->user_agent(),
            'details' => json_encode($details),
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        // Log to CodeIgniter log
        log_message('info', 'SECURITY EVENT: ' . json_encode($log_data));
        
        // Log critical events to separate file
        $critical_events = ['login_failure', 'sql_injection_attempt', 'file_upload_violation', 'csrf_violation'];
        if (in_array($event, $critical_events)) {
            error_log('SECURITY ALERT: ' . json_encode($log_data), 3, APPPATH . 'logs/security.log');
        }
    }
}

/**
 * Rate limiting helper
 */
if (!function_exists('check_rate_limit')) {
    function check_rate_limit($identifier, $max_attempts = 5, $time_window = 300) {
        $CI =& get_instance();
        
        $cache_key = 'rate_limit_' . md5($identifier);
        $attempts = $CI->cache->get($cache_key) ?: 0;
        
        if ($attempts >= $max_attempts) {
            return false;
        }
        
        $CI->cache->save($cache_key, $attempts + 1, $time_window);
        return true;
    }
}

/**
 * Validate database table name
 */
if (!function_exists('validate_table_name')) {
    function validate_table_name($table_name) {
        return preg_match('/^[a-zA-Z0-9_]+$/', $table_name);
    }
}

/**
 * Validate database column name
 */
if (!function_exists('validate_column_name')) {
    function validate_column_name($column_name) {
        return preg_match('/^[a-zA-Z0-9_\.]+$/', $column_name);
    }
}

/**
 * Secure redirect helper
 */
if (!function_exists('secure_redirect')) {
    function secure_redirect($uri, $method = 'auto', $code = null) {
        // Validate the URI to prevent open redirects
        if (filter_var($uri, FILTER_VALIDATE_URL)) {
            // External URL - validate against whitelist
            $allowed_domains = ['ijpsjournal.com', 'www.ijpsjournal.com'];
            $parsed_url = parse_url($uri);
            
            if (!in_array($parsed_url['host'], $allowed_domains)) {
                show_error('Invalid redirect URL', 400);
                return;
            }
        }
        
        redirect($uri, $method, $code);
    }
}

/**
 * Password strength validator
 */
if (!function_exists('validate_password_strength')) {
    function validate_password_strength($password, $min_length = 8) {
        $errors = [];
        
        if (strlen($password) < $min_length) {
            $errors[] = "Password must be at least {$min_length} characters long";
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Password must contain at least one uppercase letter";
        }
        
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Password must contain at least one lowercase letter";
        }
        
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Password must contain at least one number";
        }
        
        if (!preg_match('/[^A-Za-z0-9]/', $password)) {
            $errors[] = "Password must contain at least one special character";
        }
        
        return $errors;
    }
}
