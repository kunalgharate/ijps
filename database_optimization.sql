-- Database Optimization Script for IJPS
-- This script creates indexes and optimizes database performance

-- =====================================================
-- MANUSCRIPT TABLE OPTIMIZATIONS
-- =====================================================

-- Index for manuscript status and active filtering (most common query)
CREATE INDEX IF NOT EXISTS idx_manuscript_status_active
ON ijps_tblmanuscript(statusID, isActive);

-- Index for manuscript creation date (for ordering)
CREATE INDEX IF NOT EXISTS idx_manuscript_created_date
ON ijps_tblmanuscript(created_date DESC);

-- Index for unique code searches
CREATE INDEX IF NOT EXISTS idx_manuscript_unique_code
ON ijps_tblmanuscript(uniqueCode);

-- Index for email searches
CREATE INDEX IF NOT EXISTS idx_manuscript_email
ON ijps_tblmanuscript(email);

-- Index for title searches (partial index for performance)
CREATE INDEX IF NOT EXISTS idx_manuscript_title_search
ON ijps_tblmanuscript(titleOfPaper(100));

-- Index for author name searches
CREATE INDEX IF NOT EXISTS idx_manuscript_author_name
ON ijps_tblmanuscript(authorName);

-- Composite index for pagination queries
CREATE INDEX IF NOT EXISTS idx_manuscript_pagination
ON ijps_tblmanuscript(isActive, statusID, manuscriptID DESC);

-- =====================================================
-- ARTICLE TABLE OPTIMIZATIONS
-- =====================================================

-- Index for featured articles and ordering (most common query)
CREATE INDEX IF NOT EXISTS idx_article_featured_id
ON ijps_tblarticle(featuredArticleFlag DESC, articleID DESC);

-- Index for article title searches
CREATE INDEX IF NOT EXISTS idx_article_title_search
ON ijps_tblarticle(titleOfPaper(100));

-- Index for article creation date
CREATE INDEX IF NOT EXISTS idx_article_created_date
ON ijps_tblarticle(createdDate DESC);

-- Index for article unique code
CREATE INDEX IF NOT EXISTS idx_article_unique_code
ON ijps_tblarticle(articleIDUniqueCode);

-- Index for active articles
CREATE INDEX IF NOT EXISTS idx_article_active
ON ijps_tblarticle(isActive);

-- Index for manuscript ID relationship
CREATE INDEX IF NOT EXISTS idx_article_manuscript
ON ijps_tblarticle(manuscriptID);

-- Composite index for article pagination
CREATE INDEX IF NOT EXISTS idx_article_pagination
ON ijps_tblarticle(isActive, featuredArticleFlag DESC, articleID DESC);

-- =====================================================
-- MANUSCRIPT INFO TABLE OPTIMIZATIONS
-- =====================================================

-- Index for active manuscript info
CREATE INDEX IF NOT EXISTS idx_manuscript_info_active
ON ijps_tblmanuscriptinfo(isActive, manuscriptInfoID);

-- Index for article ID relationship
CREATE INDEX IF NOT EXISTS idx_manuscript_info_article
ON ijps_tblmanuscriptinfo(articleID);

-- Index for manuscript relationship
CREATE INDEX IF NOT EXISTS idx_manuscript_info_manuscript ON ijps_tblmanuscriptinfo(manuscriptInfoID);

-- =====================================================
-- CO-AUTHOR TABLE OPTIMIZATIONS
-- =====================================================

-- Index for manuscript info relationship
CREATE INDEX IF NOT EXISTS idx_coauthor_manuscript
ON ijps_tblmanuscriptcoauthor(manuscriptInfoID, isActive);

-- Index for email searches
CREATE INDEX IF NOT EXISTS idx_coauthor_email
ON ijps_tblmanuscriptcoauthor(email);

-- Index for author name searches
CREATE INDEX IF NOT EXISTS idx_coauthor_name
ON ijps_tblmanuscriptcoauthor(name);

-- =====================================================
-- LOOKUP TABLE OPTIMIZATIONS
-- =====================================================

-- Index for article types
CREATE INDEX IF NOT EXISTS idx_article_type_active
ON ijps_tblarticaltype(isActive, articalTypeID);

-- Index for countries
CREATE INDEX IF NOT EXISTS idx_country_active
ON ijps_tblcountry(isActive, countryID);

-- Index for status
CREATE INDEX IF NOT EXISTS idx_status_active
ON ijps_tblstatus(isActive, statusID);

-- =====================================================
-- ACTIVITY LOG TABLE OPTIMIZATIONS
-- =====================================================

-- Index for activity log date and active status
CREATE INDEX IF NOT EXISTS idx_activity_log_date
ON tblactivitylog(createdDate DESC, isActive);

-- Index for user activity
CREATE INDEX IF NOT EXISTS idx_activity_log_user
ON tblactivitylog(createdByUserID, createdDate DESC);

-- =====================================================
-- REVIEW POINT TABLE OPTIMIZATIONS
-- =====================================================

-- Index for article ID in review points
CREATE INDEX IF NOT EXISTS idx_review_point_article
ON tbl_reviewpoint(articleId);

-- Index for creation date
CREATE INDEX IF NOT EXISTS idx_review_point_date
ON tbl_reviewpoint(created_data DESC);

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
    created_date DATETIME NOT NULL,
    INDEX idx_security_event (event),
    INDEX idx_security_date (created_date DESC),
    INDEX idx_security_user (user_id),
    INDEX idx_security_ip (ip_address)
) ENGINE=InnoDB;

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
    created_date DATETIME NOT NULL,
    INDEX idx_perf_date (created_date DESC),
    INDEX idx_perf_time (execution_time DESC),
    INDEX idx_perf_uri (request_uri)
) ENGINE=InnoDB;

-- =====================================================
-- DATABASE MAINTENANCE PROCEDURES
-- =====================================================

-- Procedure to analyze table performance
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS AnalyzeTablePerformance()
BEGIN
    ANALYZE TABLE ijps_tblmanuscript;
    ANALYZE TABLE ijps_tblarticle;
    ANALYZE TABLE ijps_tblmanuscriptinfo;
    ANALYZE TABLE ijps_tblmanuscriptcoauthor;
    ANALYZE TABLE tblactivitylog;
    ANALYZE TABLE tbl_reviewpoint;
END //
DELIMITER ;

-- Procedure to optimize tables
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS OptimizeTables()
BEGIN
    OPTIMIZE TABLE ijps_tblmanuscript;
    OPTIMIZE TABLE ijps_tblarticle;
    OPTIMIZE TABLE ijps_tblmanuscriptinfo;
    OPTIMIZE TABLE ijps_tblmanuscriptcoauthor;
    OPTIMIZE TABLE tblactivitylog;
    OPTIMIZE TABLE tbl_reviewpoint;
END //
DELIMITER ;

-- =====================================================
-- QUERY OPTIMIZATION VIEWS
-- =====================================================

-- View for manuscript list with all related data
CREATE OR REPLACE VIEW vw_manuscript_list AS
SELECT
    m.manuscriptID,
    m.uniqueCode,
    m.authorName,
    m.email,
    m.contactNumber,
    m.titleOfPaper,
    m.created_date,
    m.payment_date,
    m.statusID,
    m.isActive,
    s.statusName,
    at.articalTypeName,
    c.countryName
FROM ijps_tblmanuscript m
INNER JOIN ijps_tblstatus s ON s.statusID = m.statusID
INNER JOIN ijps_tblarticaltype at ON at.articalTypeID = m.articalTypeID
INNER JOIN ijps_tblcountry c ON c.countryID = m.countryID
WHERE m.isActive = 1;

-- View for article list with related data
CREATE OR REPLACE VIEW vw_article_list AS
SELECT
    a.articleID,
    a.articleIDUniqueCode,
    a.titleOfPaper,
    a.createdDate,
    a.doi,
    a.keywords,
    a.citation,
    a.document,
    a.featuredArticleFlag,
    a.isActive,
    at.articalTypeName,
    m.authorName,
    m.email
FROM ijps_tblarticle a
LEFT JOIN ijps_tblarticaltype at ON at.articalTypeID = a.articalTypeID
LEFT JOIN ijps_tblmanuscript m ON m.manuscriptID = a.manuscriptID
WHERE a.isActive = 1;

-- =====================================================
-- PERFORMANCE MONITORING TRIGGERS
-- =====================================================

-- Trigger to log slow queries (if needed)
-- Note: This would need to be implemented at application level

-- =====================================================
-- CLEANUP PROCEDURES
-- =====================================================

-- Procedure to clean old logs
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS CleanOldLogs()
BEGIN
    -- Clean activity logs older than 1 year
    DELETE FROM tblactivitylog
    WHERE createdDate < DATE_SUB(NOW(), INTERVAL 1 YEAR);

    -- Clean security logs older than 6 months
    DELETE FROM security_log
    WHERE created_date < DATE_SUB(NOW(), INTERVAL 6 MONTH);

    -- Clean performance logs older than 3 months
    DELETE FROM performance_log
    WHERE created_date < DATE_SUB(NOW(), INTERVAL 3 MONTH);
END //
DELIMITER ;

-- =====================================================
-- EXECUTION NOTES
-- =====================================================

/*
To execute this optimization script:

1. Backup your database first:
   mysqldump -u username -p database_name > backup.sql

2. Run this script:
   mysql -u username -p database_name < database_optimization.sql

3. Analyze the results:
   CALL AnalyzeTablePerformance();

4. Set up regular maintenance (add to cron):
   - Daily: CALL AnalyzeTablePerformance();
   - Weekly: CALL OptimizeTables();
   - Monthly: CALL CleanOldLogs();

5. Monitor performance improvements using:
   SHOW INDEX FROM table_name;
   EXPLAIN SELECT ... (for your common queries);
*/

-- =====================================================
-- SECURITY ENHANCEMENTS
-- =====================================================

-- Create user with limited privileges for application
-- CREATE USER 'ijps_app'@'localhost' IDENTIFIED BY 'strong_password_here';
-- GRANT SELECT, INSERT, UPDATE, DELETE ON ijps_db.* TO 'ijps_app'@'localhost';
-- FLUSH PRIVILEGES;

-- Enable query logging for security monitoring
-- SET GLOBAL general_log = 'ON';
-- SET GLOBAL log_output = 'TABLE';

SELECT 'Database optimization script completed successfully!' as Status;
