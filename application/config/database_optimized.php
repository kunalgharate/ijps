<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| OPTIMIZED DATABASE CONFIGURATION
| This configuration includes performance optimizations for production use
*/

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'srv1826.hstgr.io',
    'username' => 'u106167836_dev_ijps',
	'password' => 'Dev_ijps@123',
	'database' => 'u106167836_dev_ijps',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => TRUE,  // Enable persistent connections for better performance
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => TRUE,  // Enable query caching
	'cachedir' => APPPATH.'cache/db/',  // Cache directory
	'char_set' => 'utf8mb4',  // Better Unicode support
	'dbcollat' => 'utf8mb4_unicode_ci',  // Better collation
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => TRUE,  // Enable MySQL compression
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => (ENVIRONMENT === 'development'),  // Only save queries in development
	
	// Additional optimizations
	'port' => 3306,
	'timeout' => 30,
	'options' => array(
		// Enable prepared statement caching
		MYSQLI_OPT_INT_AND_FLOAT_NATIVE => TRUE,
		// Set connection timeout
		MYSQLI_OPT_CONNECT_TIMEOUT => 10,
		// Enable automatic reconnection
		MYSQLI_OPT_RECONNECT => TRUE,
	)
);

// Read replica configuration (if available)
$db['read'] = array(
	'dsn'	=> '',
	'hostname' => 'srv1826.hstgr.io',  // Use read replica if available
    'username' => 'u106167836_dev_ijps',
	'password' => 'Dev_ijps@123',
	'database' => 'u106167836_dev_ijps',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => TRUE,
	'db_debug' => FALSE,
	'cache_on' => TRUE,
	'cachedir' => APPPATH.'cache/db/',
	'char_set' => 'utf8mb4',
	'dbcollat' => 'utf8mb4_unicode_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => TRUE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => FALSE
);
