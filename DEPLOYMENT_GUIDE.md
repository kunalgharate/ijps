# 🚀 IJPS PRODUCTION DEPLOYMENT GUIDE
## Complete Security & Performance Implementation

### 📋 **PRE-DEPLOYMENT CHECKLIST**

#### **✅ CRITICAL REQUIREMENTS**
- [ ] **PHP 7.4+** with required extensions (mysqli, openssl, mbstring, curl)
- [ ] **MySQL 5.7+** or **MariaDB 10.3+**
- [ ] **Apache 2.4+** or **Nginx 1.18+** with mod_rewrite
- [ ] **SSL Certificate** installed and configured
- [ ] **Redis/Memcached** for caching (recommended)
- [ ] **Backup system** configured

---

## 🔧 **STEP 1: DATABASE SETUP**

### **1.1 Create Production Database**
```sql
-- Create database
CREATE DATABASE ijps_production CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create dedicated user with limited privileges
CREATE USER 'ijps_user'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD_HERE';
GRANT SELECT, INSERT, UPDATE, DELETE ON ijps_production.* TO 'ijps_user'@'localhost';
FLUSH PRIVILEGES;
```

### **1.2 Import Existing Data**
```bash
# Export from development
mysqldump -u dev_user -p ijps_dev > ijps_backup.sql

# Import to production
mysql -u ijps_user -p ijps_production < ijps_backup.sql
```

### **1.3 Run Database Optimization**
```bash
# Execute the optimization script
mysql -u ijps_user -p ijps_production < database_optimization.sql

# Verify indexes were created
mysql -u ijps_user -p ijps_production -e "SHOW INDEX FROM ijps_tblmanuscript;"
```

---

## 🛡️ **STEP 2: SECURITY CONFIGURATION**

### **2.1 Generate Encryption Key**
```php
// Generate 32-character random key
$encryption_key = bin2hex(random_bytes(16));
echo $encryption_key; // Copy this to config
```

### **2.2 Update Configuration Files**

#### **application/config/config.php**
```php
// Environment
define('ENVIRONMENT', 'production');

// Base URL
$config['base_url'] = 'https://yourdomain.com/';

// Encryption
$config['encryption_key'] = 'YOUR_32_CHAR_KEY_HERE';

// Session
$config['sess_driver'] = 'database';
$config['sess_cookie_name'] = 'ijps_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = 'ci_sessions';
$config['sess_match_ip'] = TRUE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = TRUE;

// Cookie Security
$config['cookie_secure'] = TRUE;
$config['cookie_httponly'] = TRUE;
$config['cookie_samesite'] = 'Strict';

// CSRF Protection
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'ijps_csrf_token';
$config['csrf_cookie_name'] = 'ijps_csrf_cookie';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;

// XSS Filtering
$config['global_xss_filtering'] = TRUE;

// Logging
$config['log_threshold'] = 1; // Errors only
$config['log_path'] = APPPATH.'logs/';
```

#### **application/config/database.php**
```php
$db['default'] = array(
    'dsn'	=> '',
    'hostname' => 'localhost',
    'username' => 'ijps_user',
    'password' => 'YOUR_STRONG_PASSWORD',
    'database' => 'ijps_production',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => FALSE,
    'cache_on' => TRUE,
    'cachedir' => APPPATH.'cache/db/',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_unicode_ci',
    'swap_pre' => '',
    'encrypt' => TRUE,
    'compress' => FALSE,
    'stricton' => TRUE,
    'failover' => array(),
    'save_queries' => FALSE
);
```

#### **application/config/autoload.php**
```php
$autoload['libraries'] = array('database', 'session', 'security_middleware');
$autoload['helper'] = array('url', 'security', 'form');
$autoload['config'] = array('security');
$autoload['model'] = array('SecureCommonModel');
```

### **2.3 Create Session Table**
```sql
CREATE TABLE IF NOT EXISTS ci_sessions (
    id varchar(128) NOT NULL,
    ip_address varchar(45) NOT NULL,
    timestamp int(10) unsigned DEFAULT 0 NOT NULL,
    data blob NOT NULL,
    KEY ci_sessions_timestamp (timestamp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## 🌐 **STEP 3: WEB SERVER CONFIGURATION**

### **3.1 Apache Configuration**

#### **Create .htaccess in root directory:**
```apache
# IJPS Production .htaccess
RewriteEngine On

# Force HTTPS
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Security Headers
<IfModule mod_headers.c>
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options DENY
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
    Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; img-src 'self' data: https:; font-src 'self' https://fonts.gstatic.com; connect-src 'self'; frame-src 'none'; object-src 'none';"
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

# Enable compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain text/html text/xml text/css application/xml application/xhtml+xml application/rss+xml application/javascript application/x-javascript
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
</IfModule>
```

#### **Create .htaccess in uploads directory:**
```apache
# Prevent script execution in uploads
Options -ExecCGI
AddHandler cgi-script .php .pl .py .jsp .asp .sh .cgi
Options -Indexes
```

### **3.2 Nginx Configuration (Alternative)**
```nginx
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;
    
    root /path/to/ijps;
    index index.php index.html;
    
    # SSL Configuration
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512;
    
    # Security Headers
    add_header X-Content-Type-Options nosniff;
    add_header X-Frame-Options DENY;
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "strict-origin-when-cross-origin";
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload";
    
    # PHP Configuration
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    # CodeIgniter URL Rewriting
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    # Deny access to sensitive files
    location ~ /\.(ht|git|svn) {
        deny all;
    }
    
    location ~ \.(log|sql|md)$ {
        deny all;
    }
}
```

---

## 📁 **STEP 4: FILE PERMISSIONS**

### **4.1 Set Correct Permissions**
```bash
# Set directory permissions
find /path/to/ijps -type d -exec chmod 755 {} \;

# Set file permissions
find /path/to/ijps -type f -exec chmod 644 {} \;

# Set writable directories
chmod -R 777 /path/to/ijps/application/logs/
chmod -R 777 /path/to/ijps/application/cache/
chmod -R 777 /path/to/ijps/uploads/

# Secure sensitive files
chmod 600 /path/to/ijps/application/config/database.php
chmod 600 /path/to/ijps/application/config/security.php
```

### **4.2 Create Required Directories**
```bash
mkdir -p /path/to/ijps/application/logs
mkdir -p /path/to/ijps/application/cache
mkdir -p /path/to/ijps/application/cache/db
mkdir -p /path/to/ijps/uploads/authors
mkdir -p /path/to/ijps/uploads/articles
mkdir -p /path/to/ijps/uploads/manuscripts
```

---

## 🔄 **STEP 5: CACHING SETUP (OPTIONAL BUT RECOMMENDED)**

### **5.1 Redis Installation**
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install redis-server

# Start Redis
sudo systemctl start redis-server
sudo systemctl enable redis-server
```

### **5.2 Cache Configuration**
```php
// application/config/cache.php
$config['adapter'] = 'redis';
$config['backup'] = 'file';
$config['key_prefix'] = 'ijps_';

$config['redis'] = array(
    'host' => '127.0.0.1',
    'password' => NULL,
    'port' => 6379,
    'timeout' => 0,
    'database' => 0,
);
```

---

## 📧 **STEP 6: EMAIL CONFIGURATION**

### **6.1 SMTP Configuration**
```php
// application/config/email.php
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_user'] = 'noreply@ijpsjournal.com';
$config['smtp_pass'] = 'your_app_password';
$config['smtp_port'] = 587;
$config['smtp_crypto'] = 'tls';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";
$config['smtp_timeout'] = 30;
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 76;
$config['validate'] = TRUE;
```

---

## 🧪 **STEP 7: TESTING**

### **7.1 Functionality Testing**
```bash
# Test database connection
php -r "
$pdo = new PDO('mysql:host=localhost;dbname=ijps_production', 'ijps_user', 'password');
echo 'Database connection: OK' . PHP_EOL;
"

# Test file permissions
touch /path/to/ijps/application/logs/test.log
echo "File permissions: OK"
rm /path/to/ijps/application/logs/test.log
```

### **7.2 Security Testing**
- [ ] **HTTPS redirect** working
- [ ] **Security headers** present
- [ ] **CSRF protection** active
- [ ] **XSS filtering** working
- [ ] **File upload** restrictions working
- [ ] **SQL injection** protection active

### **7.3 Performance Testing**
```bash
# Test page load speed
curl -w "@curl-format.txt" -o /dev/null -s "https://yourdomain.com/"

# Test database performance
mysql -u ijps_user -p ijps_production -e "EXPLAIN SELECT * FROM ijps_tblmanuscript WHERE isActive = 1 ORDER BY manuscriptID DESC LIMIT 10;"
```

---

## 📊 **STEP 8: MONITORING SETUP**

### **8.1 Log Monitoring**
```bash
# Create log rotation
sudo nano /etc/logrotate.d/ijps

# Add content:
/path/to/ijps/application/logs/*.log {
    daily
    missingok
    rotate 30
    compress
    delaycompress
    notifempty
    create 644 www-data www-data
}
```

### **8.2 Performance Monitoring**
```bash
# Install monitoring tools
sudo apt install htop iotop nethogs

# Monitor MySQL
sudo apt install mytop
```

---

## 💾 **STEP 9: BACKUP CONFIGURATION**

### **9.1 Database Backup Script**
```bash
#!/bin/bash
# /usr/local/bin/ijps-backup.sh

BACKUP_DIR="/backups/ijps"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="ijps_production"
DB_USER="ijps_user"
DB_PASS="your_password"

# Create backup directory
mkdir -p $BACKUP_DIR

# Database backup
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_backup_$DATE.sql

# Files backup
tar -czf $BACKUP_DIR/files_backup_$DATE.tar.gz /path/to/ijps/uploads/

# Remove old backups (keep 30 days)
find $BACKUP_DIR -name "*.sql" -mtime +30 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +30 -delete

echo "Backup completed: $DATE"
```

### **9.2 Cron Job Setup**
```bash
# Edit crontab
crontab -e

# Add daily backup at 2 AM
0 2 * * * /usr/local/bin/ijps-backup.sh >> /var/log/ijps-backup.log 2>&1
```

---

## 🚨 **STEP 10: SECURITY HARDENING**

### **10.1 PHP Security**
```ini
; php.ini security settings
expose_php = Off
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log
allow_url_fopen = Off
allow_url_include = Off
session.cookie_httponly = 1
session.cookie_secure = 1
session.use_strict_mode = 1
```

### **10.2 MySQL Security**
```sql
-- Remove test database
DROP DATABASE IF EXISTS test;

-- Remove anonymous users
DELETE FROM mysql.user WHERE User='';

-- Remove remote root access
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');

-- Reload privileges
FLUSH PRIVILEGES;
```

### **10.3 Firewall Configuration**
```bash
# UFW (Ubuntu)
sudo ufw enable
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw deny 3306/tcp  # MySQL only from localhost
```

---

## ✅ **STEP 11: FINAL VERIFICATION**

### **11.1 Security Checklist**
- [ ] HTTPS enforced
- [ ] Security headers present
- [ ] CSRF protection active
- [ ] XSS filtering enabled
- [ ] File upload restrictions working
- [ ] Database user has minimal privileges
- [ ] Sensitive files protected
- [ ] Error reporting disabled

### **11.2 Performance Checklist**
- [ ] Database indexes created
- [ ] Caching enabled
- [ ] Static file compression enabled
- [ ] Image optimization done
- [ ] CDN configured (if applicable)

### **11.3 Monitoring Checklist**
- [ ] Error logging active
- [ ] Security event logging enabled
- [ ] Performance monitoring setup
- [ ] Backup system working
- [ ] Alerting configured

---

## 🔧 **MAINTENANCE PROCEDURES**

### **Daily Tasks**
```bash
# Check error logs
tail -f /path/to/ijps/application/logs/log-$(date +%Y-%m-%d).php

# Monitor disk space
df -h

# Check backup completion
ls -la /backups/ijps/
```

### **Weekly Tasks**
```bash
# Run database optimization
mysql -u ijps_user -p ijps_production -e "CALL OptimizeTables();"

# Update security configurations
# Review access logs
# Test backup restoration
```

### **Monthly Tasks**
```bash
# Security audit
# Performance analysis
# Update dependencies
# Review user access
```

---

## 🆘 **TROUBLESHOOTING**

### **Common Issues**

#### **Database Connection Error**
```bash
# Check MySQL status
sudo systemctl status mysql

# Check user privileges
mysql -u root -p -e "SHOW GRANTS FOR 'ijps_user'@'localhost';"
```

#### **Permission Errors**
```bash
# Fix file permissions
sudo chown -R www-data:www-data /path/to/ijps/
sudo chmod -R 755 /path/to/ijps/
```

#### **HTTPS Issues**
```bash
# Check SSL certificate
openssl x509 -in /path/to/certificate.crt -text -noout

# Test SSL configuration
curl -I https://yourdomain.com/
```

#### **Performance Issues**
```bash
# Check slow queries
mysql -u ijps_user -p ijps_production -e "SHOW PROCESSLIST;"

# Monitor system resources
htop
```

---

## 📞 **SUPPORT CONTACTS**

- **Technical Issues**: tech-support@ijpsjournal.com
- **Security Issues**: security@ijpsjournal.com
- **Emergency**: +1-XXX-XXX-XXXX

---

## 📚 **ADDITIONAL RESOURCES**

- [CodeIgniter Security Guide](https://codeigniter.com/user_guide/general/security.html)
- [OWASP Security Guidelines](https://owasp.org/www-project-top-ten/)
- [MySQL Performance Tuning](https://dev.mysql.com/doc/refman/8.0/en/optimization.html)
- [Apache Security Tips](https://httpd.apache.org/docs/2.4/misc/security_tips.html)

---

**🎯 DEPLOYMENT STATUS: PRODUCTION READY**

This deployment guide ensures your IJPS system is secure, optimized, and ready for production use with enterprise-grade security measures and performance optimizations.
