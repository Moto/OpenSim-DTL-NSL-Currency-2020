<?php
//
// Configration file for non Web Interface
//                                            v1.2  2016100500
//

// Please set this hepler script directory
if (!defined('ENV_HELPER_URL'))  define('ENV_HELPER_URL',  'http://opensim.tuis.ac.jp/helper_scripts/helper');
if (!defined('ENV_HELPER_PATH')) define('ENV_HELPER_PATH', '/var/www/html/helper_scripts/helper');


//////////////////////////////////////////////////////////////////////////////////i
// Valiables for OpenSim

// Please set MySQL DB access information for OpenSim
define('OPENSIM_DB_HOST',  'localhost');
define('OPENSIM_DB_NAME',  'opensim_db');
define('OPENSIM_DB_USER',  'opensim_user');
define('OPENSIM_DB_PASS',  'opensim_pass');
define('OPENSIM_DB_MYSQLI', 1);


// Please set MySQL DB access information for Helper Scripts
// If it is the same as the DB of OpenSim, you may not set these
define('HELPER_DB_HOST',   'localhost');
define('HELPER_DB_NAME',   '');
define('HELPER_DB_USER',   '');
define('HELPER_DB_PASS',   '');
define('HELPER_DB_MYSQLI',  1);


// DB for External Modules
// Please set 'HELPER' or 'OPENSIM' or 'NONE'
// 'NONE' measns that to use OpenSim standard modules
define('OSPROFILE_DB', 'OPENSIM');  
define('OSSEARCH_DB',  'OPENSIM'); 
define('MESSAGE_DB',   'OPENSIM');
define('XMLGROUP_DB',  'OPENSIM');	// XMLGROUP means Flotsam XmlRpc Group function


// Flotsam XMLRPC Group Module Access Keys
// If you use Flotsam XMLRPC Group Module, please set same keys with at [Groups] section in OpenSim.ini
define('XMLGROUP_RKEY',  '1234');	// Read Key
define('XMLGROUP_WKEY',  '1234');	// Write key


// for DTL/NSL Money Module
define('USE_CURRENCY_SERVER', 1);

// DTL/NSL Money Server Access Key
// Please set same key with MoneyScriptAccessKey in MoneyServer.ini
define('CURRENCY_SCRIPT_KEY', '123456789');


//
define('OPENSIM_PG_ONLY', 0);

define('USE_UTC_TIME',  0);
define('DATE_FORMAT',  'd.m.Y - H:i');


// Select script. Set 1 or 2  (1: 4 images, 2: 8 images). 
// See helper/loginscreen/imageswitch1.js or imageswitch2.js
define('LOGINPAGE_SCRIPT', 1);


//////////////////////////////////////////////////////////////////////////////////
// System
 
define('SYSURL', ENV_HELPER_URL);
$GLOBALS['xmlrpc_internalencoding'] = 'UTF-8';

if (USE_UTC_TIME) date_default_timezone_set('UTC');


//
if (!defined('ENV_READ_CONFIG')) define('ENV_READ_CONFIG', 'YES');

