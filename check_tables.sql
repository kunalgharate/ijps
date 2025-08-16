-- Simple Table Structure Checker
-- Run this first to see your exact table structure

-- Show all tables
SHOW TABLES;

-- Check manuscript table structure
SELECT 'MANUSCRIPT TABLE STRUCTURE:' as Info;
DESCRIBE ijps_tblmanuscript;

-- Check manuscript info table structure  
SELECT 'MANUSCRIPT INFO TABLE STRUCTURE:' as Info;
DESCRIBE ijps_tblmanuscriptinfo;

-- Check article table structure
SELECT 'ARTICLE TABLE STRUCTURE:' as Info;
DESCRIBE ijps_tblarticle;

-- Check co-author table structure
SELECT 'CO-AUTHOR TABLE STRUCTURE:' as Info;
DESCRIBE ijps_tblmanuscriptcoauthor;

-- Show existing indexes
SELECT 'EXISTING INDEXES:' as Info;
SELECT 
    TABLE_NAME,
    INDEX_NAME,
    COLUMN_NAME
FROM 
    INFORMATION_SCHEMA.STATISTICS 
WHERE 
    TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME LIKE '%manuscript%'
ORDER BY 
    TABLE_NAME, INDEX_NAME;
