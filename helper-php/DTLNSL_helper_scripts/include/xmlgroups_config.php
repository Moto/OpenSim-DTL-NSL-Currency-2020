<?php
//
// Group DB configration by Fumi.Iseki
//

// default
$XMLGRP_DB_HOST   = OPENSIM_DB_HOST;
$XMLGRP_DB_NAME   = OPENSIM_DB_NAME;
$XMLGRP_DB_USER   = OPENSIM_DB_USER;
$XMLGRP_DB_PASS	  = OPENSIM_DB_PASS;
$XMLGRP_DB_MYSQLI = OPENSIM_DB_MYSQLI;

if (XMLGROUP_DB=='HELPER' and defined('HELPER_DB_NAME')) {
	$XMLGRP_DB_HOST   = HELPER_DB_HOST;
	$XMLGRP_DB_NAME   = HELPER_DB_NAME;
	$XMLGRP_DB_USER   = HELPER_DB_USER;
	$XMLGRP_DB_PASS	  = HELPER_DB_PASS;
	$XMLGRP_DB_MYSQLI = HELPER_DB_MYSQLI;
}


// Access Key
if (defined('XMLGROUP_RKEY')) {
	$GroupReadKey  = XMLGROUP_RKEY;
	$GroupWriteKey = XMLGROUP_WKEY;
}
else {
	$GroupReadKey  = '1234';
	$GroupWriteKey = '1234';
}

$GroupRequireAgentAuthForWrite = false;
$GroupEnforceGroupPerms        = false;


//
if (XMLGROUP_DB=='HELPER' or XMLGROUP_DB=='OPENSIM') {
	define('XMLGROUP_ACTIVE_TBL_BASE',      'group_active');
	define('XMLGROUP_INVITE_TBL_BASE',      'group_invite');
	define('XMLGROUP_LIST_TBL_BASE',        'group_list');
	define('XMLGROUP_MEMBERSHIP_TBL_BASE',  'group_membership');
	define('XMLGROUP_NOTICE_TBL_BASE',      'group_notice');
	define('XMLGROUP_ROLE_TBL_BASE',        'group_role');
	define('XMLGROUP_ROLE_MEMBER_TBL_BASE', 'group_rolemembership');
}
else {	// NONE (OpenSim Group V2 Module)
	define('XMLGROUP_ACTIVE_TBL_BASE',      'os_groups_principals');
	define('XMLGROUP_INVITE_TBL_BASE',      'os_groups_invites');
	define('XMLGROUP_LIST_TBL_BASE',        'os_groups_groups');
	define('XMLGROUP_MEMBERSHIP_TBL_BASE',  'os_groups_membership');
	define('XMLGROUP_NOTICE_TBL_BASE',      'os_groups_notices');
	define('XMLGROUP_ROLE_TBL_BASE',        'os_groups_roles');
	define('XMLGROUP_ROLE_MEMBER_TBL_BASE', 'os_groups_rolemembership');
}
