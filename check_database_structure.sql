-- Database Structure Analysis Script
-- Run this first to check actual table structures

-- Check manuscript table structure
DESCRIBE ijps_tblmanuscript;

-- Check manuscript info table structure  
DESCRIBE ijps_tblmanuscriptinfo;

-- Check manuscript co-author table structure
DESCRIBE ijps_tblmanuscriptcoauthor;

-- Check article table structure
DESCRIBE ijps_tblarticle;

-- Check article type table structure
DESCRIBE ijps_tblarticaltype;

-- Check country table structure
DESCRIBE ijps_tblcountry;

-- Check status table structure
DESCRIBE ijps_tblstatus;

-- Check activity log table structure
DESCRIBE tblactivitylog;

-- Check review point table structure (if exists)
DESCRIBE tbl_reviewpoint;

-- Show all tables in database
SHOW TABLES;

-- Check existing indexes
SELECT 
    TABLE_NAME,
    INDEX_NAME,
    COLUMN_NAME,
    NON_UNIQUE
FROM 
    INFORMATION_SCHEMA.STATISTICS 
WHERE 
    TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME LIKE '%manuscript%'
ORDER BY 
    TABLE_NAME, INDEX_NAME, SEQ_IN_INDEX;
