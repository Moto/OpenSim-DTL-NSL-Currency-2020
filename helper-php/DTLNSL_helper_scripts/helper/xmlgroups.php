<?php
//
// by Fumi.Iseki '09 5/31
//

if (!defined('ENV_READ_CONFIG')) require_once(realpath(dirname(__FILE__).'/../include/config.php'));
if (!defined('ENV_READ_DEFINE')) require_once(realpath(ENV_HELPER_PATH.'/../include/env_define.php'));


if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');

//$debugXMLRPC = 1;
//$debugXMLRPCFile = 'xmlgroup.log';
//$request_xml = $HTTP_RAW_POST_DATA;
//error_log('xmlgroups.php: '.$request_xml);	// see /var/log/php/... or /var/log/httpd/error_log


if ($XMLGRP_DB_MYSQLI) {
	include(ENV_HELPER_PATH.'/xmlrpci.php');
}
else {
	include(ENV_HELPER_PATH.'/xmlrpc.php');
}

