<?php
//
// Environment Interface for non Web Interface
//								by Fumi.Iseki
//
//

if (!defined('ENV_READ_CONFIG')) require_once(realpath(dirname(__FILE__).'/../include/config.php'));
if ( defined('ENV_READ_DEFINE')) return;

$groups_config  = realpath(ENV_HELPER_PATH.'/../include/xmlgroups_config.php');
$profile_config = realpath(ENV_HELPER_PATH.'/../include/profile_config.php');
$search_config  = realpath(ENV_HELPER_PATH.'/../include/search_config.php');
$message_config = realpath(ENV_HELPER_PATH.'/../include/message_config.php');
if ($groups_config!='')  require_once($groups_config);
if ($profile_config!='') require_once($profile_config);
if ($search_config!='')  require_once($search_config);
if ($message_config!='') require_once($message_config);



//////////////////////////////////////////////////////////////////////////////////
// DB Table Name

// Offline Message and MuteList
define ('MUTE_LIST_TBL',         	 MUTE_LIST_TBL_BASE);
define ('OFFLINE_MESSAGE_TBL',   	 OFFLINE_MESSAGE_TBL_BASE);

// XML Group.  see also xmlgroups_config.php 
define('XMLGROUP_ACTIVE_TBL',       XMLGROUP_ACTIVE_TBL_BASE);
define('XMLGROUP_LIST_TBL',         XMLGROUP_LIST_TBL_BASE);
define('XMLGROUP_INVITE_TBL',       XMLGROUP_INVITE_TBL_BASE);
define('XMLGROUP_MEMBERSHIP_TBL',   XMLGROUP_MEMBERSHIP_TBL_BASE);
define('XMLGROUP_NOTICE_TBL',       XMLGROUP_NOTICE_TBL_BASE);
define('XMLGROUP_ROLE_MEMBER_TBL',  XMLGROUP_ROLE_MEMBER_TBL_BASE);
define('XMLGROUP_ROLE_TBL',         XMLGROUP_ROLE_TBL_BASE);

// Avatar Profile. see also profile_config.php 
define('PROFILE_CLASSIFIEDS_TBL',   PROFILE_CLASSIFIEDS_TBL_BASE);
define('PROFILE_USERNOTES_TBL',     PROFILE_USERNOTES_TBL_BASE);
define('PROFILE_USERPICKS_TBL',     PROFILE_USERPICKS_TBL_BASE);
define('PROFILE_USERPROFILE_TBL',   PROFILE_USERPROFILE_TBL_BASE);
define('PROFILE_USERSETTINGS_TBL',  PROFILE_USERSETTINGS_TBL_BASE);

// Search the In World. see also search_config.php 
define('SEARCH_ALLPARCELS_TBL',     SEARCH_ALLPARCELS_TBL_BASE);
define('SEARCH_EVENTS_TBL',         SEARCH_EVENTS_TBL_BASE);
define('SEARCH_HOSTSREGISTER_TBL',  SEARCH_HOSTSREGISTER_TBL_BASE);
define('SEARCH_OBJECTS_TBL',        SEARCH_OBJECTS_TBL_BASE);
define('SEARCH_PARCELS_TBL',        SEARCH_PARCELS_TBL_BASE);
define('SEARCH_PARCELSALES_TBL',    SEARCH_PARCELSALES_TBL_BASE);
define('SEARCH_POPULARPLACES_TBL',  SEARCH_POPULARPLACES_TBL_BASE);
define('SEARCH_REGIONS_TBL',        SEARCH_REGIONS_TBL_BASE);
if (defined('PROFILE_CLASSIFIEDS_TBL')) {
	define('SEARCH_CLASSIFIEDS_TBL', PROFILE_CLASSIFIEDS_TBL);
}


//////////////////////////////////////////////////////////////////////////////////
// Event Categories

$Categories     = array();
$Categories[0]  = 'All Category';
$Categories[18] = 'Discussion';
$Categories[19] = 'Sports';
$Categories[20] = 'Live Music';
$Categories[22] = 'Commercial';
$Categories[23] = 'Entertainment';
$Categories[24] = 'Games/Contests';
$Categories[25] = 'Pageants';
$Categories[26] = 'Education';
$Categories[27] = 'Arts and Culture';
$Categories[28] = 'Charity/Support';
$Categories[29] = 'Miscellaneous';
if (!OPENSIM_PG_ONLY) $Categories[23] = 'Nightlife/'.$Categories[23];

//
if (!defined('ENV_READ_DEFINE')) define('ENV_READ_DEFINE', 'YES');

