-- CORRECTED Database Optimization Script for IJPS
-- This script creates indexes based on actual table structure

-- =====================================================
-- FIRST: CHECK IF COLUMNS EXIST BEFORE CREATING INDEXES
-- =====================================================

-- Create a procedure to safely add indexes
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS SafeAddIndex(
    IN table_name VARCHAR(64),
    IN index_name VARCHAR(64), 
    IN column_list VARCHAR(255)
)
BEGIN
    DECLARE column_exists INT DEFAULT 0;
    DECLARE first_column VARCHAR(64);
    
    -- Extract first column name from column_list
    SET first_column = SUBSTRING_INDEX(column_list, ',', 1);
    SET first_column = TRIM(REPLACE(REPLACE(first_column, '(', ''), ')', ''));
    
    -- Check if column exists
    SELECT COUNT(*) INTO column_exists
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = table_name 
    AND COLUMN_NAME = first_column;
    
    -- Create index only if column exists
    IF column_exists > 0 THEN
        SET @sql = CONCAT('CREATE INDEX IF NOT EXISTS ', index_name, ' ON ', table_name, '(', column_list, ')');
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
        SELECT CONCAT('✓ Created index: ', index_name, ' on ', table_name) as Result;
    ELSE
        SELECT CONCAT('✗ Skipped index: ', index_name, ' - Column ', first_column, ' does not exist in ', table_name) as Result;
    END IF;
END //
DELIMITER ;

-- =====================================================
-- MANUSCRIPT TABLE OPTIMIZATIONS
-- =====================================================

-- Basic indexes for manuscript table
CALL SafeAddIndex('ijps_tblmanuscript', 'idx_manuscript_active', 'isActive');
CALL SafeAddIndex('ijps_tblmanuscript', 'idx_manuscript_status', 'statusID');
CALL SafeAddIndex('ijps_tblmanuscript', 'idx_manuscript_created', 'created_date');
CALL SafeAddIndex('ijps_tblmanuscript', 'idx_manuscript_unique_code', 'uniqueCode');
CALL SafeAddIndex('ijps_tblmanuscript', 'idx_manuscript_email', 'email');
CALL SafeAddIndex('ijps_tblmanuscript', 'idx_manuscript_author', 'authorName');

-- Composite indexes for common queries
CALL SafeAddIndex('ijps_tblmanuscript', 'idx_manuscript_status_active', 'statusID, isActive');
CALL SafeAddIndex('ijps_tblmanuscript', 'idx_manuscript_active_created', 'isActive, created_date');
CALL SafeAddIndex('ijps_tblmanuscript', 'idx_manuscript_pagination', 'isActive, manuscriptID');

-- =====================================================
-- ARTICLE TABLE OPTIMIZATIONS  
-- =====================================================

-- Basic indexes for article table
CALL SafeAddIndex('ijps_tblarticle', 'idx_article_active', 'isActive');
CALL SafeAddIndex('ijps_tblarticle', 'idx_article_featured', 'featuredArticleFlag');
CALL SafeAddIndex('ijps_tblarticle', 'idx_article_created', 'createdDate');
CALL SafeAddIndex('ijps_tblarticle', 'idx_article_unique_code', 'articleIDUniqueCode');
CALL SafeAddIndex('ijps_tblarticle', 'idx_article_type', 'articalTypeID');

-- Composite indexes for article pagination and sorting
CALL SafeAddIndex('ijps_tblarticle', 'idx_article_featured_id', 'featuredArticleFlag, articleID');
CALL SafeAddIndex('ijps_tblarticle', 'idx_article_active_featured', 'isActive, featuredArticleFlag');
CALL SafeAddIndex('ijps_tblarticle', 'idx_article_pagination', 'isActive, featuredArticleFlag, articleID');

-- Try to add manuscript relationship index (may not exist)
CALL SafeAddIndex('ijps_tblarticle', 'idx_article_manuscript', 'manuscriptID');

-- =====================================================
-- MANUSCRIPT INFO TABLE OPTIMIZATIONS
-- =====================================================

-- Basic indexes for manuscript info table
CALL SafeAddIndex('ijps_tblmanuscriptinfo', 'idx_manuscript_info_active', 'isActive');
CALL SafeAddIndex('ijps_tblmanuscriptinfo', 'idx_manuscript_info_id', 'manuscriptInfoID');
CALL SafeAddIndex('ijps_tblmanuscriptinfo', 'idx_manuscript_info_article', 'articleID');

-- Try common relationship columns
CALL SafeAddIndex('ijps_tblmanuscriptinfo', 'idx_manuscript_info_manuscript', 'manuscriptID');
CALL SafeAddIndex('ijps_tblmanuscriptinfo', 'idx_manuscript_info_author', 'authorEmail');

-- =====================================================
-- CO-AUTHOR TABLE OPTIMIZATIONS
-- =====================================================

-- Basic indexes for co-author table
CALL SafeAddIndex('ijps_tblmanuscriptcoauthor', 'idx_coauthor_active', 'isActive');
CALL SafeAddIndex('ijps_tblmanuscriptcoauthor', 'idx_coauthor_manuscript_info', 'manuscriptInfoID');
CALL SafeAddIndex('ijps_tblmanuscriptcoauthor', 'idx_coauthor_email', 'email');
CALL SafeAddIndex('ijps_tblmanuscriptcoauthor', 'idx_coauthor_name', 'name');

-- Composite index for common queries
CALL SafeAddIndex('ijps_tblmanuscriptcoauthor', 'idx_coauthor_info_active', 'manuscriptInfoID, isActive');

-- =====================================================
-- LOOKUP TABLE OPTIMIZATIONS
-- =====================================================

-- Article type table
CALL SafeAddIndex('ijps_tblarticaltype', 'idx_article_type_active', 'isActive');
CALL SafeAddIndex('ijps_tblarticaltype', 'idx_article_type_id', 'articalTypeID');

-- Country table
CALL SafeAddIndex('ijps_tblcountry', 'idx_country_active', 'isActive');
CALL SafeAddIndex('ijps_tblcountry', 'idx_country_id', 'countryID');

-- Status table
CALL SafeAddIndex('ijps_tblstatus', 'idx_status_active', 'isActive');
CALL SafeAddIndex('ijps_tblstatus', 'idx_status_id', 'statusID');

-- =====================================================
-- ACTIVITY LOG TABLE OPTIMIZATIONS
-- =====================================================

-- Activity log indexes
CALL SafeAddIndex('tblactivitylog', 'idx_activity_active', 'isActive');
CALL SafeAddIndex('tblactivitylog', 'idx_activity_created', 'createdDate');
CALL SafeAddIndex('tblactivitylog', 'idx_activity_user', 'createdByUserID');

-- Composite index for common queries
CALL SafeAddIndex('tblactivitylog', 'idx_activity_active_date', 'isActive, createdDate');

-- =====================================================
-- REVIEW POINT TABLE OPTIMIZATIONS
-- =====================================================

-- Review point indexes (if table exists)
CALL SafeAddIndex('tbl_reviewpoint', 'idx_review_article', 'articleId');
CALL SafeAddIndex('tbl_reviewpoint', 'idx_review_created', 'created_data');

-- =====================================================
-- SECURITY LOG TABLE CREATION AND OPTIMIZATION
-- =====================================================

-- Create security log table if it doesn't exist
CREATE TABLE IF NOT EXISTS security_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event VARCHAR(100) NOT NULL,
    user_id VARCHAR(50),
    ip_address VARCHAR(45),
    user_agent TEXT,
    details TEXT,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_security_event (event),
    INDEX idx_security_date (created_date),
    INDEX idx_security_user (user_id),
    INDEX idx_security_ip (ip_address)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- PERFORMANCE MONITORING TABLE
-- =====================================================

-- Create performance monitoring table
CREATE TABLE IF NOT EXISTS performance_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_uri VARCHAR(255),
    execution_time DECIMAL(10,4),
    memory_usage INT,
    query_count INT,
    slow_queries TEXT,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_perf_date (created_date),
    INDEX idx_perf_time (execution_time),
    INDEX idx_perf_uri (request_uri)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- SESSION TABLE FOR SECURE SESSIONS
-- =====================================================

-- Create session table for CodeIgniter sessions
CREATE TABLE IF NOT EXISTS ci_sessions (
    id varchar(128) NOT NULL,
    ip_address varchar(45) NOT NULL,
    timestamp int(10) unsigned DEFAULT 0 NOT NULL,
    data blob NOT NULL,
    KEY ci_sessions_timestamp (timestamp),
    KEY ci_sessions_id_ip (id, ip_address)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- DATABASE MAINTENANCE PROCEDURES
-- =====================================================

-- Procedure to analyze table performance
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS AnalyzeTablePerformance()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE table_name VARCHAR(64);
    DECLARE cur CURSOR FOR 
        SELECT TABLE_NAME 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_TYPE = 'BASE TABLE';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO table_name;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        SET @sql = CONCAT('ANALYZE TABLE ', table_name);
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END LOOP;
    CLOSE cur;
    
    SELECT 'Table analysis completed' as Result;
END //
DELIMITER ;

-- Procedure to optimize tables
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS OptimizeTables()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE table_name VARCHAR(64);
    DECLARE cur CURSOR FOR 
        SELECT TABLE_NAME 
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_TYPE = 'BASE TABLE';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    OPEN cur;
    read_loop: LOOP
        FETCH cur INTO table_name;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        SET @sql = CONCAT('OPTIMIZE TABLE ', table_name);
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END LOOP;
    CLOSE cur;
    
    SELECT 'Table optimization completed' as Result;
END //
DELIMITER ;

-- =====================================================
-- CLEANUP PROCEDURES
-- =====================================================

-- Procedure to clean old logs
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS CleanOldLogs()
BEGIN
    -- Clean activity logs older than 1 year (if table exists)
    IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'tblactivitylog') THEN
        DELETE FROM tblactivitylog 
        WHERE createdDate < DATE_SUB(NOW(), INTERVAL 1 YEAR);
        SELECT CONCAT('Cleaned ', ROW_COUNT(), ' old activity log records') as Result;
    END IF;
    
    -- Clean security logs older than 6 months
    IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'security_log') THEN
        DELETE FROM security_log 
        WHERE created_date < DATE_SUB(NOW(), INTERVAL 6 MONTH);
        SELECT CONCAT('Cleaned ', ROW_COUNT(), ' old security log records') as Result;
    END IF;
    
    -- Clean performance logs older than 3 months
    IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'performance_log') THEN
        DELETE FROM performance_log 
        WHERE created_date < DATE_SUB(NOW(), INTERVAL 3 MONTH);
        SELECT CONCAT('Cleaned ', ROW_COUNT(), ' old performance log records') as Result;
    END IF;
    
    -- Clean old sessions
    IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'ci_sessions') THEN
        DELETE FROM ci_sessions 
        WHERE timestamp < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 DAY));
        SELECT CONCAT('Cleaned ', ROW_COUNT(), ' old session records') as Result;
    END IF;
END //
DELIMITER ;

-- =====================================================
-- EXECUTE ANALYSIS AND OPTIMIZATION
-- =====================================================

-- Run table analysis
CALL AnalyzeTablePerformance();

-- Show created indexes
SELECT 
    TABLE_NAME,
    INDEX_NAME,
    GROUP_CONCAT(COLUMN_NAME ORDER BY SEQ_IN_INDEX) as COLUMNS,
    CASE WHEN NON_UNIQUE = 0 THEN 'UNIQUE' ELSE 'INDEX' END as INDEX_TYPE
FROM 
    INFORMATION_SCHEMA.STATISTICS 
WHERE 
    TABLE_SCHEMA = DATABASE()
    AND INDEX_NAME != 'PRIMARY'
GROUP BY 
    TABLE_NAME, INDEX_NAME, NON_UNIQUE
ORDER BY 
    TABLE_NAME, INDEX_NAME;

-- Clean up the procedure
DROP PROCEDURE IF EXISTS SafeAddIndex;

-- Final success message
SELECT 'Database optimization completed successfully!' as Status,
       'All indexes created based on existing table structure' as Message,
       'Run CALL OptimizeTables(); for maintenance' as Maintenance,
       'Run CALL CleanOldLogs(); to clean old data' as Cleanup;
