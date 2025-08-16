<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| PRODUCTION CONFIGURATION FOR IJPS
|--------------------------------------------------------------------------
| This file contains production-ready configuration settings
| Copy these settings to your respective config files for production deployment
*/

/*
|--------------------------------------------------------------------------
| ENVIRONMENT CONFIGURATION (config.php)
|--------------------------------------------------------------------------
*/
// Set to 'production' for live environment
define('ENVIRONMENT', 'production');

/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION (database.php)
|--------------------------------------------------------------------------
*/
$production_db = array(
    'dsn'	=> '',
    'hostname' => 'localhost',
    'username' => 'ijps_user', // Create dedicated database user
    'password' => 'CHANGE_THIS_STRONG_PASSWORD', // Use strong password
    'database' => 'ijps_production',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => FALSE, // Disable in production
    'cache_on' => TRUE,  // Enable query caching
    'cachedir' => APPPATH.'cache/db/',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_unicode_ci',
    'swap_pre' => '',
    'encrypt' => TRUE,   // Enable SSL connection
    'compress' => FALSE,
    'stricton' => TRUE,  // Enable strict mode
    'failover' => array(),
    'save_queries' => FALSE // Disable query logging in production
);

/*
|--------------------------------------------------------------------------
| SECURITY CONFIGURATION
|--------------------------------------------------------------------------
*/
$production_security = array(
    // CSRF Protection
    'csrf_protection' => TRUE,
    'csrf_token_name' => 'ijps_csrf_token',
    'csrf_cookie_name' => 'ijps_csrf_cookie',
    'csrf_expire' => 7200,
    'csrf_regenerate' => TRUE,
    
    // XSS Filtering
    'global_xss_filtering' => TRUE,
    
    // Session Security
    'sess_driver' => 'database',
    'sess_cookie_name' => 'ijps_session',
    'sess_expiration' => 7200,
    'sess_save_path' => 'ci_sessions',
    'sess_match_ip' => TRUE,
    'sess_time_to_update' => 300,
    'sess_regenerate_destroy' => TRUE,
    
    // Cookie Security
    'cookie_secure' => TRUE,    // HTTPS only
    'cookie_httponly' => TRUE,
    'cookie_samesite' => 'Strict',
    
    // Encryption
    'encryption_key' => 'CHANGE_THIS_32_CHAR_RANDOM_KEY_HERE', // Generate random 32-char key
    'encryption_driver' => 'openssl',
    'encryption_cipher' => 'AES-256-CBC',
    
    // Rate Limiting
    'rate_limit_enabled' => TRUE,
    'rate_limit_requests' => 100,
    'rate_limit_window' => 3600,
    
    // Security Headers
    'security_headers' => array(
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'DENY',
        'X-XSS-Protection' => '1; mode=block',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload',
    ),
    
    // Content Security Policy
    'csp_enabled' => TRUE,
    'csp_policy' => array(
        'default-src' => "'self'",
        'script-src' => "'self' 'unsafe-inline' https://cdnjs.cloudflare.com",
        'style-src' => "'self' 'unsafe-inline' https://fonts.googleapis.com",
        'img-src' => "'self' data: https:",
        'font-src' => "'self' https://fonts.gstatic.com",
        'connect-src' => "'self'",
        'frame-src' => "'none'",
        'object-src' => "'none'",
    ),
);

/*
|--------------------------------------------------------------------------
| EMAIL CONFIGURATION (email.php)
|--------------------------------------------------------------------------
*/
$production_email = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.gmail.com', // Change to your SMTP server
    'smtp_user' => 'noreply@ijpsjournal.com', // Change to your email
    'smtp_pass' => 'CHANGE_THIS_EMAIL_PASSWORD', // Use app password
    'smtp_port' => 587,
    'smtp_crypto' => 'tls',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'newline' => "\r\n",
    'crlf' => "\r\n",
    'smtp_timeout' => 30,
    'wordwrap' => TRUE,
    'wrapchars' => 76,
    'validate' => TRUE,
);

/*
|--------------------------------------------------------------------------
| CACHE CONFIGURATION (cache.php)
|--------------------------------------------------------------------------
*/
$production_cache = array(
    'adapter' => 'redis', // Use Redis for production
    'backup' => 'file',
    'key_prefix' => 'ijps_',
    
    // Redis Configuration
    'redis' => array(
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'timeout' => 0,
        'database' => 0,
    ),
    
    // File Cache Configuration
    'file' => array(
        'cache_path' => APPPATH.'cache/',
    ),
);

/*
|--------------------------------------------------------------------------
| LOGGING CONFIGURATION (config.php)
|--------------------------------------------------------------------------
*/
$production_logging = array(
    'log_threshold' => 1, // Only errors in production
    'log_path' => APPPATH.'logs/',
    'log_file_extension' => '',
    'log_file_permissions' => 0644,
    'log_date_format' => 'Y-m-d H:i:s',
);

/*
|--------------------------------------------------------------------------
| AUTOLOAD CONFIGURATION (autoload.php)
|--------------------------------------------------------------------------
*/
$production_autoload = array(
    'packages' => array(),
    'libraries' => array('database', 'session', 'security_middleware'),
    'drivers' => array('cache'),
    'helper' => array('url', 'security', 'form'),
    'config' => array('security'),
    'language' => array(),
    'model' => array('SecureCommonModel'),
);

/*
|--------------------------------------------------------------------------
| ROUTES CONFIGURATION (routes.php)
|--------------------------------------------------------------------------
*/
$production_routes = array(
    'default_controller' => 'welcome',
    '404_override' => 'errors/page_missing',
    'translate_uri_dashes' => FALSE,
    
    // Security routes
    'admin' => 'backoffice/LoginController',
    'backoffice' => 'backoffice/LoginController',
    
    // API routes with rate limiting
    'api/(:any)' => 'api/$1',
);

/*
|--------------------------------------------------------------------------
| HTACCESS CONFIGURATION
|--------------------------------------------------------------------------
*/
$htaccess_content = '
# IJPS Production .htaccess Configuration
RewriteEngine On

# Security Headers
<IfModule mod_headers.c>
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options DENY
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
    Header always set Content-Security-Policy "default-src \'self\'; script-src \'self\' \'unsafe-inline\' https://cdnjs.cloudflare.com; style-src \'self\' \'unsafe-inline\' https://fonts.googleapis.com; img-src \'self\' data: https:; font-src \'self\' https://fonts.gstatic.com; connect-src \'self\'; frame-src \'none\'; object-src \'none\';"
</IfModule>

# Force HTTPS
<IfModule mod_rewrite.c>
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>

# Hide sensitive files
<Files "*.log">
    Order allow,deny
    Deny from all
</Files>

<Files "*.sql">
    Order allow,deny
    Deny from all
</Files>

<Files "*.md">
    Order allow,deny
    Deny from all
</Files>

# Prevent access to system folders
RedirectMatch 403 ^/system.*
RedirectMatch 403 ^/application.*

# Remove index.php from URLs
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

# Compress files
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>

# Cache static files
<IfModule mod_expires.c>
    ExpiresActive on
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/ico "access plus 1 year"
    ExpiresByType image/icon "access plus 1 year"
    ExpiresByType text/plain "access plus 1 month"
    ExpiresByType application/pdf "access plus 1 month"
</IfModule>
';

/*
|--------------------------------------------------------------------------
| DEPLOYMENT CHECKLIST
|--------------------------------------------------------------------------
*/
$deployment_checklist = array(
    'database' => array(
        '✓ Create production database',
        '✓ Create dedicated database user with limited privileges',
        '✓ Run database optimization script',
        '✓ Set up database backups',
        '✓ Enable SSL connection',
    ),
    
    'security' => array(
        '✓ Generate strong encryption key',
        '✓ Configure CSRF protection',
        '✓ Enable HTTPS and SSL certificates',
        '✓ Set up security headers',
        '✓ Configure rate limiting',
        '✓ Set secure session configuration',
    ),
    
    'performance' => array(
        '✓ Enable caching (Redis/Memcached)',
        '✓ Configure CDN for static assets',
        '✓ Enable gzip compression',
        '✓ Optimize images and assets',
        '✓ Set up monitoring tools',
    ),
    
    'monitoring' => array(
        '✓ Set up error logging',
        '✓ Configure security event logging',
        '✓ Set up performance monitoring',
        '✓ Configure automated backups',
        '✓ Set up alerting system',
    ),
    
    'testing' => array(
        '✓ Run security tests',
        '✓ Perform load testing',
        '✓ Test backup restoration',
        '✓ Verify all functionality',
        '✓ Test error handling',
    ),
);

/*
|--------------------------------------------------------------------------
| MAINTENANCE PROCEDURES
|--------------------------------------------------------------------------
*/
$maintenance_procedures = array(
    'daily' => array(
        'Check error logs',
        'Monitor security events',
        'Verify backup completion',
        'Check system performance',
    ),
    
    'weekly' => array(
        'Run database optimization',
        'Update security configurations',
        'Review access logs',
        'Test backup restoration',
    ),
    
    'monthly' => array(
        'Security audit review',
        'Performance analysis',
        'Update dependencies',
        'Review user access',
    ),
);

/*
|--------------------------------------------------------------------------
| QUICK DEPLOYMENT SCRIPT
|--------------------------------------------------------------------------
*/
$deployment_script = '#!/bin/bash
# IJPS Production Deployment Script

echo "Starting IJPS production deployment..."

# 1. Backup current system
echo "Creating backup..."
mysqldump -u username -p ijps_production > backup_$(date +%Y%m%d_%H%M%S).sql
tar -czf files_backup_$(date +%Y%m%d_%H%M%S).tar.gz /path/to/ijps/

# 2. Update application files
echo "Updating application files..."
# Copy your updated files here

# 3. Run database optimizations
echo "Running database optimizations..."
mysql -u username -p ijps_production < database_optimization.sql

# 4. Set file permissions
echo "Setting file permissions..."
chmod -R 755 /path/to/ijps/
chmod -R 644 /path/to/ijps/application/logs/
chmod -R 644 /path/to/ijps/uploads/

# 5. Clear cache
echo "Clearing cache..."
rm -rf /path/to/ijps/application/cache/*

# 6. Restart services
echo "Restarting services..."
sudo systemctl restart apache2
sudo systemctl restart mysql

echo "Deployment completed successfully!"
';

// End of production configuration
echo "<!-- Production configuration loaded successfully -->";
?>
