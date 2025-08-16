<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Security Configuration
|--------------------------------------------------------------------------
| This file contains security settings for the IJPS application
| All settings should be reviewed and configured for production use
*/

/*
|--------------------------------------------------------------------------
| CSRF Protection Settings
|--------------------------------------------------------------------------
*/
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_ijps_token';
$config['csrf_cookie_name'] = 'csrf_ijps_cookie';
$config['csrf_expire'] = 7200; // 2 hours
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array(
    'api/webhook',  // Add any URIs that need to be excluded
);

/*
|--------------------------------------------------------------------------
| XSS Filtering
|--------------------------------------------------------------------------
*/
$config['global_xss_filtering'] = TRUE;

/*
|--------------------------------------------------------------------------
| Session Security Settings
|--------------------------------------------------------------------------
*/
$config['sess_driver'] = 'database';
$config['sess_cookie_name'] = 'ijps_session';
$config['sess_expiration'] = 7200; // 2 hours
$config['sess_save_path'] = 'ci_sessions';
$config['sess_match_ip'] = TRUE;
$config['sess_time_to_update'] = 300; // 5 minutes
$config['sess_regenerate_destroy'] = TRUE;

// Session cookie security
$config['cookie_secure'] = TRUE; // Set to TRUE in production with HTTPS
$config['cookie_httponly'] = TRUE;
$config['cookie_samesite'] = 'Strict';

/*
|--------------------------------------------------------------------------
| Password Security Settings
|--------------------------------------------------------------------------
*/
$config['password_min_length'] = 8;
$config['password_require_uppercase'] = TRUE;
$config['password_require_lowercase'] = TRUE;
$config['password_require_numbers'] = TRUE;
$config['password_require_symbols'] = TRUE;
$config['password_hash_algorithm'] = PASSWORD_ARGON2ID;
$config['password_hash_options'] = [
    'memory_cost' => 65536, // 64 MB
    'time_cost' => 4,       // 4 iterations
    'threads' => 3,         // 3 threads
];

/*
|--------------------------------------------------------------------------
| File Upload Security
|--------------------------------------------------------------------------
*/
$config['allowed_file_types'] = [
    'image' => ['image/jpeg', 'image/png', 'image/gif'],
    'document' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
    'archive' => ['application/zip', 'application/x-rar-compressed']
];

$config['max_file_size'] = [
    'image' => 2097152,     // 2MB
    'document' => 10485760, // 10MB
    'archive' => 52428800   // 50MB
];

$config['upload_path_permissions'] = 0755;
$config['uploaded_file_permissions'] = 0644;

/*
|--------------------------------------------------------------------------
| Rate Limiting Settings
|--------------------------------------------------------------------------
*/
$config['rate_limit_enabled'] = TRUE;
$config['rate_limit_requests'] = 100;      // requests per time window
$config['rate_limit_window'] = 3600;       // 1 hour in seconds
$config['rate_limit_by_ip'] = TRUE;
$config['rate_limit_by_user'] = TRUE;

// Specific rate limits for different actions
$config['rate_limits'] = [
    'login' => ['requests' => 5, 'window' => 900],        // 5 attempts per 15 minutes
    'password_reset' => ['requests' => 3, 'window' => 3600], // 3 attempts per hour
    'file_upload' => ['requests' => 20, 'window' => 3600],   // 20 uploads per hour
    'api_calls' => ['requests' => 1000, 'window' => 3600],   // 1000 API calls per hour
];

/*
|--------------------------------------------------------------------------
| Security Headers
|--------------------------------------------------------------------------
*/
$config['security_headers'] = [
    'X-Content-Type-Options' => 'nosniff',
    'X-Frame-Options' => 'DENY',
    'X-XSS-Protection' => '1; mode=block',
    'Referrer-Policy' => 'strict-origin-when-cross-origin',
    'Permissions-Policy' => 'geolocation=(), microphone=(), camera=()',
    'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload', // HTTPS only
];

// Content Security Policy
$config['csp_enabled'] = TRUE;
$config['csp_policy'] = [
    'default-src' => "'self'",
    'script-src' => "'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net",
    'style-src' => "'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com",
    'img-src' => "'self' data: https:",
    'font-src' => "'self' https://fonts.gstatic.com",
    'connect-src' => "'self'",
    'frame-src' => "'none'",
    'object-src' => "'none'",
    'base-uri' => "'self'",
    'form-action' => "'self'",
];

/*
|--------------------------------------------------------------------------
| Input Validation Rules
|--------------------------------------------------------------------------
*/
$config['validation_rules'] = [
    'email' => 'required|valid_email|max_length[255]',
    'password' => 'required|min_length[8]|max_length[255]',
    'name' => 'required|alpha_numeric_spaces|max_length[100]',
    'phone' => 'required|regex_match[/^[0-9+\-\s()]+$/]|max_length[20]',
    'manuscript_title' => 'required|max_length[500]',
    'article_id' => 'required|alpha_numeric|max_length[20]',
];

/*
|--------------------------------------------------------------------------
| Encryption Settings
|--------------------------------------------------------------------------
*/
$config['encryption_key'] = ''; // Set this to a random 32-character string in production
$config['encryption_driver'] = 'openssl';
$config['encryption_cipher'] = 'AES-256-CBC';

/*
|--------------------------------------------------------------------------
| Database Security
|--------------------------------------------------------------------------
*/
$config['db_escape_queries'] = TRUE;
$config['db_allow_empty_where'] = FALSE;
$config['db_log_slow_queries'] = TRUE;
$config['db_slow_query_threshold'] = 2.0; // seconds

/*
|--------------------------------------------------------------------------
| Logging and Monitoring
|--------------------------------------------------------------------------
*/
$config['security_logging_enabled'] = TRUE;
$config['log_security_events'] = [
    'login_attempt',
    'login_failure',
    'password_change',
    'file_upload',
    'data_export',
    'admin_action',
    'sql_injection_attempt',
    'xss_attempt',
    'csrf_violation',
    'rate_limit_exceeded',
];

$config['log_retention_days'] = 90;
$config['log_file_max_size'] = 10485760; // 10MB

/*
|--------------------------------------------------------------------------
| IP Whitelist/Blacklist
|--------------------------------------------------------------------------
*/
$config['ip_whitelist_enabled'] = FALSE;
$config['ip_whitelist'] = [
    // '192.168.1.100',
    // '10.0.0.0/8',
];

$config['ip_blacklist_enabled'] = TRUE;
$config['ip_blacklist'] = [
    // Add known malicious IPs here
];

/*
|--------------------------------------------------------------------------
| Admin Security Settings
|--------------------------------------------------------------------------
*/
$config['admin_ip_restriction'] = FALSE;
$config['admin_allowed_ips'] = [
    // '192.168.1.100',
];

$config['admin_session_timeout'] = 1800; // 30 minutes
$config['admin_require_2fa'] = FALSE; // Set to TRUE when 2FA is implemented

/*
|--------------------------------------------------------------------------
| API Security Settings
|--------------------------------------------------------------------------
*/
$config['api_enabled'] = TRUE;
$config['api_require_auth'] = TRUE;
$config['api_rate_limit'] = 1000; // requests per hour
$config['api_allowed_origins'] = [
    'https://ijpsjournal.com',
    'https://www.ijpsjournal.com',
];

/*
|--------------------------------------------------------------------------
| Backup and Recovery Settings
|--------------------------------------------------------------------------
*/
$config['backup_enabled'] = TRUE;
$config['backup_frequency'] = 'daily'; // daily, weekly, monthly
$config['backup_retention_days'] = 30;
$config['backup_encryption'] = TRUE;

/*
|--------------------------------------------------------------------------
| Security Notifications
|--------------------------------------------------------------------------
*/
$config['security_notifications_enabled'] = TRUE;
$config['security_notification_email'] = 'security@ijpsjournal.com';
$config['notify_on_events'] = [
    'multiple_login_failures',
    'admin_login',
    'data_breach_attempt',
    'system_error',
];

/*
|--------------------------------------------------------------------------
| Development/Production Settings
|--------------------------------------------------------------------------
*/
$config['environment'] = ENVIRONMENT; // 'development', 'testing', 'production'

if ($config['environment'] === 'production') {
    // Production-specific security settings
    $config['display_errors'] = FALSE;
    $config['log_errors'] = TRUE;
    $config['cookie_secure'] = TRUE;
    $config['force_https'] = TRUE;
    $config['debug_mode'] = FALSE;
} else {
    // Development-specific settings
    $config['display_errors'] = TRUE;
    $config['cookie_secure'] = FALSE;
    $config['force_https'] = FALSE;
    $config['debug_mode'] = TRUE;
}

/*
|--------------------------------------------------------------------------
| Security Middleware Configuration
|--------------------------------------------------------------------------
*/
$config['security_middleware'] = [
    'csrf_protection' => TRUE,
    'xss_filtering' => TRUE,
    'sql_injection_detection' => TRUE,
    'rate_limiting' => TRUE,
    'ip_filtering' => TRUE,
    'security_headers' => TRUE,
    'input_validation' => TRUE,
    'output_encoding' => TRUE,
];

/*
|--------------------------------------------------------------------------
| Maintenance Mode
|--------------------------------------------------------------------------
*/
$config['maintenance_mode'] = FALSE;
$config['maintenance_allowed_ips'] = [
    '127.0.0.1',
    '::1',
];
$config['maintenance_message'] = 'System is under maintenance. Please try again later.';

/*
|--------------------------------------------------------------------------
| Security Testing Configuration
|--------------------------------------------------------------------------
*/
$config['security_testing'] = [
    'penetration_testing_enabled' => FALSE,
    'vulnerability_scanning_enabled' => FALSE,
    'security_audit_logging' => TRUE,
];

// End of security configuration
