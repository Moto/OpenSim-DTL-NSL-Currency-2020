<?php
/*********************************************************************************
 * opensim.mysql.php v2.1 for OpenSim     by Fumi.Iseki  2016 6/1
 *
 *             Copyright (c) 2009,2010,2011,2013,2016   http://www.nsl.tuis.ac.jp/
 *
 *            supported versions of OpenSim are 0.7.x - 0.9.x
 *            tools.func.php is needed
 *            mysql.func.php is needed
 *
 *********************************************************************************/


/*********************************************************************************
 * Function List

// for DB
 function  opensim_new_db($timeout=60)
 function  opensim_check_db(&$db=null)
 function  opensim_avatars_update_time(&$db=null)
 function  opensim_is_standalone(&$db=null)

// for Avatar
 function  opensim_get_avatars_num($condition='', &$db=null)
 function  opensim_get_avatar_name($uuid, $hguser=true, &$db=null)
 function  opensim_get_avatar_uuid($name, $hguser=true, &$db=null)
 function  opensim_get_avatar_session($uuid, &$db=null)
 function  opensim_get_avatar_info($uuid, $hguser=true, &$db=null)
 function  opensim_get_avatars_infos($condition='', $order='', $limit='', &$db=null)
 function  opensim_get_hg_avatars_infos($condition='', $order='', $limit='', &$db=null)
 function  opensim_get_avatar_online($uuid, &$db=null)
 function  opensim_get_avatars_online($condition='', $order='', $limit='', $hg_avatar=true, &$db=null)
 function  opensim_get_avatars_online_num($hg_vatar=true, &$db=null)
 function  opensim_get_avatar_flags($uuid, &$db=null)
 function  opensim_set_avatar_flags($uuid, $flags=0, &$db=null)
 function  opensim_set_avatar_offline($uuid, &$db=null)
 function  opensim_create_avatar($UUID, $firstname, $lastname, $passwd, $homeregion, $base_avatar=UUID_ZERO, &$db=null)
 function  opensim_delete_avatar($uuid, &$db=null)

// for Region
 function  opensim_get_regions_num($hg=false, &$db=null)
 function  opensim_get_region_uuid($name, &$db=null)
 function  opensim_get_regions_uuid($hg=false, &$db=null)
 function  opensim_get_region_name($id, &$db=null)
 function  opensim_get_regions_names($hg=false, $condition='', $order='', $limit='', &$db=null)
 function  opensim_get_region_info($region, &$db=null)
 function  opensim_get_regions_infos($hg=false, $condition='', $order='', $limit='', &$db=null)
 function  opensim_set_current_region($uuid, $regionid, &$db=null)
 function  opensim_delete_region($uuid, &$db=null)

// for Home Region
 function  opensim_get_home_region($uuid, &$db=null)
 function  opensim_set_home_region($uuid, $hmregion, $pos_x='128', $pos_y='128', $pos_z='0', &$db=null)

// for Estate
 function  opensim_set_region_estate($region, $estate, $owner, &$db=null)
 function  opensim_create_estate($estate, $owner, &$db=null)
 function  opensim_get_estates_infos(&$db=null)
 function  opensim_get_estate_info($region, &$db=null)
 function  opensim_set_region_estateid($region, $estateid, &$db=null)
 function  opensim_set_estate_owner($region, $owner, &$db=null)
 function  opensim_del_estate($id, &$db=null)
 function  opensim_update_estate($id, $name, $owner, &$db=null)

// for Parcel
 function  opensim_get_parcel_name($parcel, &$db=null)
 function  opensim_get_parcel_info($parcel, &$db=null)

// for Assets
 function  opensim_get_asset_data($uuid, &$db=null)
 function  opensim_display_texture_data($uuid, $prog, $xsize='0', $ysize='0', $cachedir='', $use_tga=false)
 function  opensim_get_object_name($uuid, &$db=null)

// for Inventory
 function  opensim_create_avatar_inventory($uuid, $base_uuid, $db=null)
 function  opensim_create_default_avatar_wear($uuid, $invent, $db=null)
 function  opensim_create_default_inventory_items($uuid, $db=null)
 function  opensim_create_default_inventory_folders($uuid, &$db=null)
 function  opensim_create_avatar_wear_dup($touuid, $fromid, $invent, &$db=null)
 function  opensim_create_inventory_items_dup($touuid, $fromid, $folder, $db=null)
 function  opensim_create_inventory_folders_dup($touuid, $fromid, $db=null)

// for Password
 function  opensim_get_password($uuid, $tbl='', &$db=null)
 function  opensim_set_password($uuid, $passwdhash, $passwdsalt='', $tbl='', &$db=null)

// for Voice (VoIP)
 function  opensim_get_voice_mode($region, &$db=null)
 function  opensim_set_voice_mode($region, $mode, &$db=null)

// for Currency
 function  opensim_get_transaction_type($type)
 function  opensim_set_currency_transaction($srcId, $dstId, $amount, $type, $status, $desc, &$db=null)
 function  opensim_set_currency_balance($uuid, $amount, &$db=null)
 function  opensim_get_currency_balance($uuid, &$db=null)
 function  opensim_del_currency_expired(&$db=null)
 function  opensim_get_currency_transactions($condition='', $order='', $limit='', &$db=null)
 function  opensim_get_currency_amounts_log($uuid, $condition='', $order='', $limit='', &$db=null)
 function  opensim_get_currency_amounts_num($uuid, $condition='', &$db=null)
 function  opensim_set_userinfo($user, $simip, $avatar, $pass, &$db=null)
 function  opensim_get_userinfo($uuid, &$db=null)
 function  opensim_get_userinfos($condition='', $order='', $limit='', &$db=null)
 function  opensim_get_totalsales($condition='', $order='', $limit='', &$db=null)
 function  opensim_regenerate_totalsales($time, &$db=null)

// Tools
 function  opensim_get_servers_ip(&$db=null)
 function  opensim_get_servers_name(&$db=null)
 function  opensim_get_server_info($uuid, &$db=null)
 function  opensim_is_access_from_region_server()
 function  opensim_check_secure_session($uuid, $regionid, $secure, &$db=null)
 function  opensim_check_region_secret($uuid, $secret, &$db=null)

// Management of System
 function  opensim_cleanup_db(&$db=null)
 function  opensim_clear_login_table(&$db=null)
 function  opensim_del_terrainImage($uuid, &$db=null)
 function  opensim_del_terrainImages(&$db=null)
 function  opensim_debug_command(&$db=null)

**********************************************************************************/


if (!defined('ENV_HELPER_PATH')) exit();

require_once(realpath(ENV_HELPER_PATH.'/../include/tools.func.php'));
require_once(realpath(ENV_HELPER_PATH.'/../include/mysql.func.php'));



/////////////////////////////////////////////////////////////////////////////////////
// Default Avatar

define('DEFAULT_ASSET_SHAPE', '66c41e39-38f9-f75a-024e-585989bfab73');
define('DEFAULT_ASSET_SKIN',  '77c41e39-38f9-f75a-024e-585989bbabbb');
define('DEFAULT_ASSET_HAIR',  'd342e6c0-b9d2-11dc-95ff-0800200c9a66');
define('DEFAULT_ASSET_EYES',  '4bb6fa4d-1cd2-498a-a84c-95c1a0e745a7');
define('DEFAULT_ASSET_SHIRT', '00000000-38f9-1111-024e-222222111110');
define('DEFAULT_ASSET_PANTS', '00000000-38f9-1111-024e-222222111120');

define('DEFAULT_AVATAR_HEIGHT', '1.690999');
define('DEFAULT_AVATAR_PARAMS', '33,61,85,23,58,127,63,85,63,42,0,85,63,36,85,95,153,63,34,0,63,109,88,132,63,136,81,85,103,136,127,0,150,150,150,127,0,0,0,0,0,127,0,0,255,127,114,127,99,63,127,140,127,127,0,0,0,191,0,104,0,0,0,0,0,0,0,0,0,145,216,133,0,127,0,127,170,0,0,127,127,109,85,127,127,63,85,42,150,150,150,150,150,150,150,25,150,150,150,0,127,0,0,144,85,127,132,127,85,0,127,127,127,127,127,127,59,127,85,127,127,106,47,79,127,127,204,2,141,66,0,0,127,127,0,0,0,0,127,0,159,0,0,178,127,36,85,131,127,127,127,153,95,0,140,75,27,127,127,0,150,150,198,0,0,63,30,127,165,209,198,127,127,153,204,51,51,255,255,255,204,0,255,150,150,150,150,150,150,150,150,150,150,0,150,150,150,150,150,0,127,127,150,150,150,150,150,150,150,150,0,0,150,51,132,150,150,150');


/////////////////////////////////////////////////////////////////////////////////////
//
define('UUID_ZERO',    '00000000-0000-0000-0000-000000000000');


/////////////////////////////////////////////////////////////////////////////////////
//
// for DB
//

function  opensim_new_db($timeout=60)
{
    $db = new DB(OPENSIM_DB_HOST, OPENSIM_DB_NAME, OPENSIM_DB_USER, OPENSIM_DB_PASS, OPENSIM_DB_MYSQLI, $timeout);

    return $db;
}


//
// UserAccounts テーブルの更新時間
//
// 注）InnoDB の場合は常に 0 を返す
//
function  opensim_avatars_update_time(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    $utime = $db->get_update_time('UserAccounts');
    return $utime;
}


//
// Check and get Basic Data of DB
//
function  opensim_check_db(&$db=null)
{
    $ret['grid_status']      = false;
    $ret['now_online']       = 0;
    $ret['hg_online']        = 0;
    $ret['lastmonth_online'] = 0;
    $ret['user_count']       = 0;
    $ret['region_count']     = 0;

    if (!is_object($db)) $db = opensim_new_db(3);
    if ($db==null) return $ret;

    if ($db->exist_table('regions')) {
        $db->query('SELECT COUNT(*) FROM regions');
        if ($db->Errno==0) {
            list($ret['region_count']) = $db->next_record();
        }
    }

    $db->query('SELECT COUNT(*) FROM UserAccounts');    // Local User
    list($ret['user_count']) = $db->next_record();
    //
    if ($db->exist_table('Presence')) {
        $db->query("SELECT COUNT(DISTINCT Presence.UserID) FROM GridUser,Presence ".
                        //"WHERE GridUser.UserID=Presence.UserID AND Online='True' AND RegionID!='".UUID_ZERO."'");
                        "WHERE GridUser.UserID=Presence.UserID AND RegionID!='".UUID_ZERO."'");
        list($loc_user) = $db->next_record();

        $db->query("SELECT COUNT(*) FROM Presence WHERE RegionID!='".UUID_ZERO."'");
        list($all_user) = $db->next_record();

        $ret['now_online'] = $all_user;
        $ret['hg_online']  = $all_user - $loc_user;
    }
    // Standalone
    else {
        $db->query("SELECT COUNT(*) FROM GridUser WHERE Online='True' AND UserID NOT LIKE '%;%'");
        list($loc_user) = $db->next_record();

        $db->query("SELECT COUNT(*) FROM GridUser WHERE Online='True'");
        list($all_user) = $db->next_record();

        $ret['now_online'] = $all_user;
        $ret['hg_online']  = $all_user - $loc_user;
    }
    //
    $db->query('SELECT COUNT(*) FROM GridUser WHERE Login>unix_timestamp(now())-2592000');    // Local and HG User
    list($ret['lastmonth_online']) = $db->next_record();
    //
    $ret['grid_status'] = true;

    return $ret;
}


function  opensim_is_standalone(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    if ($db->exist_table('Presence')) return false; 
    return true;
}



/////////////////////////////////////////////////////////////////////////////////////
//
// for Avatar
//

//
// ローカルなアバター数
//
function  opensim_get_avatars_num($condition='', &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') $condition = 'WHERE '.$condition; 

    $num = 0;
    $db->query('SELECT COUNT(*) FROM UserAccounts '.$condition);
    list($num) = $db->next_record();

    return $num;
}


//
// HGユーザも含めた全アバター数
//
function  opensim_allavatars_count_records(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    $count = 0;
    $db->query('SELECT COUNT(*) FROM GridUser');
    list($count) = $db->next_record();

    return $count;
}


function  opensim_get_avatar_name($uuid, $hguser=true, &$db=null)
{
    $name = array();

    if (!isGUID($uuid)) return $name;

    if ($uuid==UUID_ZERO) {
        $name['firstname'] = 'System';
        $name['lastname']  = '';
        $name['fullname']  = 'System';
        return $name;
    }

    if (!is_object($db)) $db = opensim_new_db();
    
    $firstname = null;
    $lastname  = null;
    $fullname  = null;

    $db->query("SELECT FirstName,LastName FROM UserAccounts WHERE PrincipalID='$uuid'");
    list($firstname, $lastname) = $db->next_record();
    $fullname = $firstname.' '.$lastname;
    if ($fullname==' ') {
        $fullname  = null;
        $firstname = null;
        $lastname  = null;
    }

     // HG
    if ($hguser and $fullname==null) {
        $db->query("SELECT UserID FROM GridUser WHERE UserID LIKE '".$uuid.";%' ORDER BY Login DESC");
        list($hg_uuid) = $db->next_record();
        $uuids = explode(';', $hg_uuid);
        //
        if (array_key_exists(2, $uuids)) {
            $fullname  = $uuids[2];
            $firstname = $uuids[2];
            $lastname  = null;
            $hg_name   = explode(' ', $fullname);
            $firstname = $hg_name[0];
            if (array_key_exists(1, $hg_name)) $lastname = $hg_name[1];
        }
    }

    $name['firstname'] = $firstname;
    $name['lastname']  = $lastname;
    $name['fullname']  = $fullname;

    return $name;
}


function  opensim_get_avatar_uuid($name, $hguser=true, &$db=null)
{
    if (!isAlphabetNumericSpecial($name)) return null;
    if (!is_object($db)) $db = opensim_new_db();
    if (mb_strtolower($name)=='system') return UUID_ZERO;

    $avatar_name = preg_split("/ /", $name, 0, PREG_SPLIT_NO_EMPTY);
    $firstname = $avatar_name[0];
    $lastname  = 'Resident';
    if (array_key_exists(1, $avatar_name)) $lastname = $avatar_name[1];
    if ($firstname=='') return null;
    
    $uuid = null;
    $db->query("SELECT PrincipalID FROM UserAccounts WHERE FirstName='$firstname' AND LastName='$lastname'");
    list($uuid) = $db->next_record();

    // HG
    if ($hguser and $uuid==null) {
        $db->query("SELECT UserID FROM GridUser WHERE UserID LIKE '%;%;".$firstname.' '.$lastname."' ORDER BY Login DESC");
        list($hg_uuid) = $db->next_record();
        $uuids = explode(';', $hg_uuid);
        $uuid  = $uuids[0];
    }

    return $uuid;
}


function  opensim_get_avatar_session($uuid, &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $avssn = array();
    //
    if ($db->exist_table('Presence')) {    
        $sql = "SELECT RegionID,SessionID,SecureSessionID FROM Presence WHERE UserID='".$uuid."'";
        $db->query($sql);
        list($RegionID, $SessionID, $SecureSessionID) = $db->next_record();
        //
        $avssn['regionID']  = $RegionID;
        $avssn['sessionID'] = $SessionID;
        $avssn['secureID']  = $SecureSessionID;
    }
    // Standalone
    else {
        $sql = "SELECT LastRegionID FROM GridUser WHERE UserID='".$uuid."'";
        $db->query($sql);
        list($RegionID) = $db->next_record();
        //
        $avssn['regionID']  = $RegionID;
        $avssn['sessionID'] = UUID_ZERO;
        $avssn['secureID']  = UUID_ZERO;
    }

    return $avssn;
}


/*
 return:
    $avinfo['UUID']
    $avinfo['firstname']
    $avinfo['lastname']
    $avinfo['fullname']
    $avinfo['created']
    $avinfo['lastlogin']
    $avinfo['regionUUID']
    $avinfo['regionName']
    $avinfo['serverIP']
    $avinfo['serverHttpPort']
    $avinfo['serverPort']
    $avinfo['serverURI']
    $avinfo['serverName']
    //
    $avinfo['hgURI']
    $avinfo['hgName']
    //
    $avinfo['profileText']
    $avinfo['profileImage']
    $avinfo['firstText']
    $avinfo['firstImage']
    $avinfo['partner']
*/
function  opensim_get_avatar_info($uuid, $hguser=true, &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $created        = 0;
    $regionName     = null;
    $serverIP       = null;
    $serverHttpPort = null;
    $serverURI      = null;
    $hgURI          = null;

    $profileText    = null;
    $profileImage   = null;
    $firstText      = null;
    $firstImage     = null;
    $partner        = null;

    $db->query('SELECT PrincipalID,FirstName,LastName,HomeRegionID,Created,Login FROM UserAccounts'.
                    " LEFT JOIN GridUser ON PrincipalID=UserID WHERE PrincipalID='$uuid'");
    list($UUID, $firstname, $lastname, $regionUUID, $created, $lastlogin) = $db->next_record();
    $fullname = $firstname.' '.$lastname;
    if ($fullname==' ') {
        $fullname  = null;
        $firstname = null;
        $lastname  = null;
    }

    if ($fullname!=null) {
        $db->query("SELECT regionName,serverIP,serverHttpPort,serverURI FROM regions WHERE uuid='$regionUUID'");
        list($regionName, $serverIP, $serverHttpPort, $serverURI) = $db->next_record();
    }
    // HG
    else if ($hguser) {
        $db->query("SELECT UserID,HomeRegionID,Login FROM GridUser WHERE UserID LIKE '".$uuid.";%' ORDER BY Login DESC");
        list($hg_uuid, $regionUUID, $lastlogin) = $db->next_record();
        $uuids = explode(';', $hg_uuid);
        $UUID  = $uuids[0];
        if (array_key_exists(1, $uuids)) $hgURI = $uuids[1];
        if (array_key_exists(2, $uuids)) {
            $fullname  = $uuids[2];
            $hg_name   = explode(' ', $fullname);
            $firstname = $hg_name[0];
            if (array_key_exists(1, $hg_name)) $lastname = $hg_name[1];
        }
    }

    $avinfo['UUID']           = $UUID;
    $avinfo['firstname']      = $firstname;
    $avinfo['lastname']       = $lastname;
    $avinfo['fullname']       = $fullname;
    $avinfo['created']        = $created;
    $avinfo['lastlogin']      = $lastlogin;
    $avinfo['regionUUID']     = $regionUUID;
    $avinfo['regionName']     = $regionName;
    $avinfo['serverIP']       = $serverIP;
    $avinfo['serverHttpPort'] = $serverHttpPort;
    $avinfo['serverPort']     = $serverHttpPort;
    $avinfo['serverURI']      = $serverURI;
    $avinfo['serverName']     = '';
    $avinfo['hgURI']          = $hgURI;
    $avinfo['hgName']         = '';
    //
    $avinfo['profileText']    = $profileText;
    $avinfo['profileImage']   = $profileImage;
    $avinfo['firstText']      = $firstText;
    $avinfo['firstImage']     = $firstImage;
    $avinfo['partner']        = $partner;

    $uri = preg_split("/[:\/]/", $serverURI);
    if (array_key_exists(3, $uri)) {
        $avinfo['serverName'] = $uri[3];
//        $avinfo['serverIP2']  = gethostbyname($uri[3]);
    }
    //    
    $uri = preg_split("/[:\/]/", $hgURI);
    if (array_key_exists(3, $uri)) {
        $avinfo['hgName'] = $uri[3];
    }

    return $avinfo;
}


/*
 HG avatars are not supported.

 return:
    $avinfos[$UUID]['UUID']      ... UUID
    $avinfos[$UUID]['firstname'] ... first name
    $avinfos[$UUID]['lastname']  ... lasti name
    $avinfos[$UUID]['created']   ... created time
    $avinfos[$UUID]['lastlogin'] ... lastlogin time
    $avinfos[$UUID]['hmregion']  ... uuid of home region
*/
function  opensim_get_avatars_infos($condition='', $order='', $limit='', &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') $condition = 'WHERE '.$condition; 
    if ($order!='')     $order = ' ORDER BY '.$order; 
    if ($limit!='')     $limit = ' LIMIT '.   $limit; 

    $avinfos = array();
    $query_str = 'SELECT PrincipalID,FirstName,LastName,Created,Login,homeRegionID FROM UserAccounts '.
                            'LEFT JOIN GridUser ON PrincipalID=UserID '.$condition.$order.$limit;
    $db->query($query_str);

    if ($db->Errno==0) {
        while (list($UUID,$firstname,$lastname,$created,$lastlogin,$hmregion) = $db->next_record()) {
            $avinfos[$UUID]['UUID']        = $UUID;
            $avinfos[$UUID]['firstname']   = $firstname;
            $avinfos[$UUID]['lastname']    = $lastname;
            $avinfos[$UUID]['created']     = $created;
            $avinfos[$UUID]['lastlogin']   = $lastlogin;
            $avinfos[$UUID]['hmregion_id'] = $hmregion;
        }
    }              

    return $avinfos;
}


/*
 return:
    $avinfos[$UUID]['UUID']      ... UUID
    $avinfos[$UUID]['firstname'] ... first name
    $avinfos[$UUID]['lastname']  ... lasti name
    $avinfos[$UUID]['created']   ... always 0
    $avinfos[$UUID]['lastlogin'] ... lastlogin time
    $avinfos[$UUID]['hgURI']     ... Hyper Grid URI
    $avinfos[$UUID]['hgName']    ... Hyper Grid name
*/
function  opensim_get_hg_avatars_infos($condition='', $order='', $limit='', &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') $condition = '('.$condition.') AND';
    if ($order!='')     $order = ' ORDER BY '.$order; 
    if ($limit!='')     $limit = ' LIMIT '.   $limit; 

    $avinfos = array();
    $query_str = 'SELECT UserID,Login FROM GridUser WHERE '.$condition." UserID LIKE '%;%;%' ".$order.$limit;
    $db->query($query_str);

    if ($db->Errno==0) {
        while (list($hg_uuid, $lastlogin) = $db->next_record()) {
            $hgURI     = '';
            $fullname  = '';
            $firstname = '';
            $lastname  = '';

            $uuids = explode(';', $hg_uuid);
            $UUID  = $uuids[0];
            if (array_key_exists(1, $uuids)) $hgURI = $uuids[1];
            if (array_key_exists(2, $uuids)) {
                $fullname  = $uuids[2];
                $hg_name   = explode(' ', $fullname);
                $firstname = $hg_name[0];
                if (array_key_exists(1, $hg_name)) $lastname = $hg_name[1];
            }
            //
            if (!array_key_exists($UUID, $avinfos)) {
                $avinfos[$UUID]['UUID']      = $UUID;
                $avinfos[$UUID]['firstname'] = $firstname;
                $avinfos[$UUID]['lastname']  = $lastname;
                $avinfos[$UUID]['created']   = 0;
                $avinfos[$UUID]['lastlogin'] = $lastlogin;
                $avinfos[$UUID]['hgURI']     = $hgURI; 
                $avinfos[$UUID]['hgName']    = ''; 
                //
                $uri = preg_split("/[:\/]/", $hgURI);
                if (array_key_exists(3, $uri)) {
                    $avinfos[$UUID]['hgName'] = $uri[3];
                }
            }
        }
    }              

    return $avinfos;
}


/*
 return:
    $ret['online']
    $ret['regionUUID']
    $ret['regionName']
    $ret['timeStamp']
*/
function  opensim_get_avatar_online($uuid, &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $online    = false;
    $timestamp = 0;
    $region    = UUID_ZERO;
    $rgn_name  = '';

    if ($db->exist_table('Presence')) {    
        $query_str = "SELECT RegionID,unix_timestamp(LastSeen) FROM Presence,GridUser WHERE Presence.UserID='$uuid'".
                            " AND RegionID!='".UUID_ZERO."' AND GridUser.UserID LIKE '".$uuid."%'";
        $db->query($query_str);
        if ($db->Errno==0) {
            list($region, $timestamp) = $db->next_record();
            if ($region!='') {
                $rgn_name = opensim_get_region_name($region);
                if ($rgn_name!='') $online = true;
                else opensim_set_avatar_offline($uuid);
            }
        }
    }
    // Standalone
    else {
        $query_str = "SELECT LastRegionID,unix_timestamp(Login) FROM GridUser WHERE UserID LIKE '".$uuid."%' AND Online='True'";
        $db->query($query_str);
        if ($db->Errno==0) {
            list($region, $timestamp) = $db->next_record();
            if ($region!='') {
                $rgn_name = opensim_get_region_name($region);
                if ($rgn_name!='') $online = true;
                else opensim_set_avatar_offline($uuid);
            }
        }
    }

    $ret['online']     = $online;
    $ret['regionUUID'] = $region;
    $ret['regionName'] = $rgn_name;
    $ret['timeStamp']  = $timestamp;

    return $ret;
}


/*
 return:
    $ret[$UUID]['UUID']
    $ret[$UUID]['online']
    $ret[$UUID]['regionUUID']
    $ret[$UUID]['regionName']
    $ret[$UUID]['timeStamp']
*/
function  opensim_get_avatars_online($condition='', $order='', $limit='', $hg_avatar=true, &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') $condition = 'AND ('.$condition.')';
    if ($order!='') $order = ' ORDER BY '.$order;
    if ($limit!='') $limit = ' LIMIT '.   $limit;

    $ret = array();

    $condition .= $order.$limit;
    if ($db->exist_table('Presence')) {    
        if ($hg_avatar) {
            $query_str = 'SELECT UserID,RegionID,unix_timestamp(LastSeen) FROM Presence '.
                        " WHERE RegionID!='".UUID_ZERO."'".$condition;
        }
        else {
            $query_str = 'SELECT Presence.UserID,RegionID,unix_timestamp(LastSeen) FROM Presence,GridUser '.
                        " WHERE Presence.UserID=GridUser.UserID AND GridUser.UserID NOT LIKE '%;%' AND RegionID!='".UUID_ZERO."'".$condition;
        }

        $db->query($query_str);

        if ($db->Errno==0) {
            while (list($UUID, $region, $lastlogin) = $db->next_record()) {
                $ret[$UUID]['UUID']       = $UUID;
                $ret[$UUID]['online']     = true;
                $ret[$UUID]['regionUUID'] = $region;
                $ret[$UUID]['timeStamp']  = $lastlogin;
                //
                $rgn_name = opensim_get_region_name($region);
                if ($rgn_name!='') $ret[$UUID]['regionName'] = $rgn_name;
                else opensim_set_avatar_offline($UUID);
            }
        }
    }
    // Standalone
    else {
        if (!$hg_avatar) $condition = " AND UserID NOT LIKE '%;%'".$condition;
        $query_str = 'SELECT UserID,LastRegionID,Login FROM GridUser '.
                        " WHERE Online='True' AND LastRegionID!='".UUID_ZERO."'".$condition;
        $db->query($query_str);

        if ($db->Errno==0) {
            while (list($UUID, $region, $lastlogin) = $db->next_record()) {
                $uuids = explode(';', $UUID);
                $ret[$UUID]['UUID']       = $uuids[0];
                $ret[$UUID]['online']     = true;
                $ret[$UUID]['regionUUID'] = $region;
                $ret[$UUID]['timeStamp']  = $lastlogin;
                //
                $rgn_name = opensim_get_region_name($region);
                if ($rgn_name!='') $ret[$UUID]['regionName'] = $rgn_name;
                else opensim_set_avatar_offline($uuids[0]);
            }
        }
    }

    return $ret;
}


function  opensim_get_avatars_online_num($hg_avatar=true, &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    if ($db->exist_table('Presence')) {    
        if ($hg_avatar) {
            $query_str = "SELECT COUNT(*) FROM Presence WHERE RegionID!='".UUID_ZERO."'";
        }
        else {
            $query_str = "SELECT COUNT(*) FROM Presence,GridUser WHERE Presence.UserID=GridUser.UserID ".
                            "AND GridUser.UserID NOT LIKE '%;%' AND RegionID!='".UUID_ZERO."'";
        }
    }
    // Standalone
    else {
        $query_str = "SELECT COUNT(*) FROM GridUser WHERE Online='True' AND LastRegionID!='".UUID_ZERO."'";
        if (!$hg_avatar) $query_str .= " AND UserID NOT LIKE '%;%'";
    }

    $num = 0;
    $db->query($query_str);
    list($num) = $db->next_record();

    return $num;
}


function  opensim_get_avatar_flags($uuid, &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("SELECT UserFlags FROM UserAccounts WHERE PrincipalID='$uuid'");
    if ($db->Errno==0) {
        list($flags) = $db->next_record();
        return $flags;
    }

    return 0;
}


function  opensim_set_avatar_flags($uuid, $flags=0, &$db=null)
{
    if (!isGUID($uuid))     return false;
    if (!isNumeric($flags)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $query_str = "UPDATE UserAccounts SET UserFlags='$flags' WHERE PrincipalID='$uuid'";
    $db->query($query_str);
    if ($db->Errno==0) return true;

    return false;
}


function  opensim_set_avatar_offline($uuid, &$db=null)
{
    if (!isGUID($uuid))    return;
    if (!is_object($db)) $db = opensim_new_db();

    if ($db->exist_table('Presence')) {    
        $db->query("DELETE FROM Presence WHERE UserID='".$uuid."'");
    }
    $db->query("UPDATE GridUser SET Online='False' WHERE UserID LIKE '". $uuid."%'");

    return;
}
 

function  opensim_create_avatar($UUID, $firstname, $lastname, $passwd, $homeregion, $base_avatar=UUID_ZERO, &$db=null)
{
    if (!isGUID($UUID)) return false;
    if (!isAlphabetNumericSpecial($firstname))  return false;
    if (!isAlphabetNumericSpecial($lastname))   return false;
    if (!isAlphabetNumericSpecial($passwd))     return false;
    if (!isAlphabetNumericSpecial($homeregion)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $nulluuid   = UUID_ZERO;
    $passwdsalt = make_random_hash();
    $passwdhash = md5(md5($passwd).":".$passwdsalt);

    $db->query("SELECT uuid,regionHandle FROM regions WHERE regionName='$homeregion'");
    $errno = $db->Errno;
    if ($errno==0) {
        list($regionID,$regionHandle) = $db->next_record();

        $serviceURLs = 'HomeURI= GatekeeperURI= InventoryServerURI= AssetServerURI=';
        $db->query('INSERT INTO UserAccounts (PrincipalID,ScopeID,FirstName,LastName,Email,ServiceURLs,Created,UserLevel,UserFlags,UserTitle) '.
                         "VALUES ('$UUID','$nulluuid','$firstname','$lastname','','$serviceURLs','".time()."','0','0','')");
        $errno = $db->Errno;
        if ($errno==0) {
            $db->query('INSERT INTO GridUser (UserID,HomeRegionID,HomePosition,HomeLookAt,LastRegionID,LastPosition,LastLookAt,Online,Login,Logout) '.
                            "VALUES ('$UUID','$regionID','<128,128,0>','<0,0,0>','$regionID','<128,128,0>','<0,0,0>','false','0','0')");
            $errno = $db->Errno;
        }
        if ($errno==0) {
            $db->query('INSERT INTO auth (UUID,passwordHash,passwordSalt,webLoginKey,accountType) '.
                            "VALUES ('$UUID','$passwdhash','$passwdsalt','$nulluuid','UserAccount')");
            $errno = $db->Errno;
        }
        //
        if ($errno==0) {
            opensim_create_avatar_inventory($UUID, $base_avatar, $db);
        }
        else {
            $db->query("DELETE FROM UserAccounts WHERE PrincipalID='$UUID'");
            $db->query("DELETE FROM auth         WHERE UUID='$UUID'");
            $db->query("DELETE FROM inventoryfolders WHERE agentID='$UUID'");
            $db->query("DELETE FROM GridUser WHERE UserID='$UUID'");
        }
    }

    if ($errno!=0) return false;
    return true;
}


//
// データベースからアバタ情報を削除する．
//
function  opensim_delete_avatar($uuid, &$db=null)
{
    if (!isGUID($uuid)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("DELETE FROM UserAccounts WHERE PrincipalID='$uuid'");
    $db->query("DELETE FROM auth         WHERE UUID='$uuid'");
    $db->query("DELETE FROM Avatars      WHERE PrincipalID='$uuid'");
    $db->query("DELETE FROM Friends      WHERE PrincipalID='$uuid'");
    $db->query("DELETE FROM tokens       WHERE UUID='$uuid'");
    $db->query("DELETE FROM GridUser     WHERE UserID='$uuid'");
    if ($db->exist_table('Presence')) $db->query("DELETE FROM Presence WHERE UserID='$uuid'");
    if ($db->exist_table('Avatars'))  $db->query("DELETE FROM Avatars  WHERE PrincipalID='$uuid'");

    $db->query("DELETE FROM estate_managers  WHERE uuid='$uuid'");
    $db->query("DELETE FROM estate_users     WHERE uuid='$uuid'");
    $db->query("DELETE FROM estateban        WHERE bannedUUID='$uuid'");
    $db->query("DELETE FROM inventoryfolders WHERE agentID='$uuid'");
    $db->query("DELETE FROM inventoryitems   WHERE avatarID='$uuid'");
    $db->query("DELETE FROM landaccesslist   WHERE AccessUUID='$uuid'");
    $db->query("DELETE FROM regionban        WHERE bannedUUID='$uuid'");

    // for DTL Money Server
    if ($db->exist_table('balances')) {
        $db->query("DELETE FROM balances WHERE user='$uuid'");
        $db->query("DELETE FROM userinfo WHERE user='$uuid'");
    }

    return true;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Region
//

function  opensim_get_regions_num($hg=false, $condition='', &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') {
        $condition = 'WHERE '.$condition;
        if (!$hg) $condition .=  " AND (regionName NOT LIKE 'http://%' and regionName NOT LIKE 'https://%') ";
    }
    else {
        if (!$hg) $condition = " WHERE (regionName NOT LIKE 'http://%' and regionName NOT LIKE 'https://%') ";
    }

    $num = 0;
    $db->query('SELECT COUNT(*) FROM regions '.$condition);
    list($num) = $db->next_record();

    return $num;
}


function  opensim_get_region_uuid($name, &$db=null)
{
//    $name = addslashes($name);
//    if (!isAlphabetNumericSpecial($name)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $uuid = '';
    if ($name!='') {
        $query = "SELECT uuid FROM regions WHERE regionName='$name'";
        $db->query($query);
        list($uuid) = $db->next_record();
    }
  
    return $uuid;
}


function  opensim_get_regions_uuid($hg=false, &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    $uuids = array();
    $query = "SELECT uuid FROM regions";
    if (!$hg) $query .= " WHERE (regionName NOT LIKE 'http://%' and regionName NOT LIKE 'https://%') ";    // for Standalone

    $db->query($query);
    if ($db->Errno==0) {
        while (list($UUID) = $db->next_record()) $uuids[$UUID] = $UUID;
    }

    return $uuids;
}


function  opensim_get_region_name($id, &$db=null)
{
    if (!isGUID($id) and !isNumeric($id)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    if (isGUID($id)) {
        $db->query("SELECT regionName FROM regions WHERE uuid='$id'");
        list($regionName) = $db->next_record();
    }
    else {
        $db->query("SELECT regionName FROM regions WHERE regionHandle='$id'");
        list($regionName) = $db->next_record();
    }

    return $regionName;
}


//
function  opensim_get_regions_names($hg=false, $condition='', $order='', $limit='', &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') {
        $condition = 'WHERE '.$condition;
        if (!$hg) $condition .=  " AND (regionName NOT LIKE 'http://%' and regionName NOT LIKE 'https://%') ";
    }
    else {
        if (!$hg) $condition = " WHERE (regionName NOT LIKE 'http://%' and regionName NOT LIKE 'https://%') ";
    }
    if ($order!='') $order = ' ORDER BY '.$order; 
    if ($limit!='') $limit = ' LIMIT '.   $limit;

    $regions = array();
    $db->query('SELECT regionName FROM regions '.$condition.$order.$limit);
    while ($db->Errno==0 and list($region)=$db->next_record()) {
        $regions[] = $region;
    }

    return $regions;
}


/* 
 return:
    $rginfo[firstname]
    $rginfo[lastname]
    $rginfo[fullname]
    $rginfo[owner_uuid]
    $rginfo[estate_id]
    $rginfo[estate_owner]
    $rginfo[estate_name]
    $rginfo[regionHandle]
    $rginfo[regionName]
    $rginfo[regionSecret]
    $rginfo[serverIP]
    $rginfo[serverHttpPort]
    $rginfo[serverPort]
    $rginfo[serverURI]
    $rginfo[locX]
    $rginfo[locY] 
    $rginfo[sizeX] 
    $rginfo[sizeY] 
    $rginfo[serverName]
*/
function  opensim_get_region_info($region, &$db=null)
{
    if (!isGUID($region)) return null;
    if ($region==UUID_ZERO) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $sql = "SELECT regionHandle,regionName,regionSecret,serverIP,serverHttpPort,serverURI,owner_uuid,locX,locY,sizeX,sizeY FROM regions WHERE uuid='$region'";
    $db->query($sql);
    list($regionHandle, $regionName, $regionSecret, $serverIP, $serverHttpPort, $serverURI, $owner_uuid, $locX, $locY, $sizeX, $sizeY) = $db->next_record();

    $rginfo = opensim_get_estate_info($region, $db);
    $rginfo['regionHandle']   = $regionHandle;
    $rginfo['regionName']     = $regionName;
    $rginfo['regionSecret']   = $regionSecret;
    $rginfo['serverIP']       = $serverIP;
    $rginfo['serverHttpPort'] = $serverHttpPort;
    $rginfo['serverPort']     = $serverHttpPort;
    $rginfo['serverURI']      = $serverURI;
    $rginfo['locX']           = $locX;
    $rginfo['locY']           = $locY;
    $rginfo['sizeX']          = $sizeX;
    $rginfo['sizeY']          = $sizeY;
    //
    $uri = preg_split("/[:\/]/", $serverURI);
    if (array_key_exists(3, $uri)) {
        $rginfo['serverName'] = $uri[3];
        //$rginfo['serverIP2']  = gethostbyname($uri[3]);
    }
    else {
        $rginfo['serverName'] = '';
        //$rginfo['serverIP2']  = '';
    }

    if ($rginfo['owner_uuid']=='') $rginfo['owner_uuid'] = $owner_uuid;

    return $rginfo;
}


/*
 return:
    $rginfos[$UUID]['UUID']          ... UUID
    $rginfos[$UUID]['regionName']    ... name of region
    $rginfos[$UUID]['locX']          ... location X
    $rginfos[$UUID]['locY']          ... location Y
    $rginfos[$UUID]['sizeX']         ... size X
    $rginfos[$UUID]['sizeY']         ... size Y
    $rginfos[$UUID]['serverIP']      ... IP address of server
    $rginfos[$UUID]['serverIP2']     ... IP address of server
    $rginfos[$UUID]['serveName']     ... Name of server
    $rginfos[$UUID]['serverPort']    ... port num of server
    $rginfos[$UUID]['serverURI']     ... URI of server
    $rginfos[$UUID]['owner_uuid']    ... UUID of region owner
    $rginfos[$UUID]['estate_id']     ... ID of estate
    $rginfos[$UUID]['estate_owner']  ... UUID of estate owner
    $rginfos[$UUID]['estate_name']   ... estate name
    $rginfos[$UUID]['est_firstname'] ... first name
    $rginfos[$UUID]['est_lastname']  ... last name
    $rginfos[$UUID]['est_fullname']  ... full name
*/
function  opensim_get_regions_infos($hg=false, $condition='', $order='', $limit='', &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') {
        $condition = 'WHERE '.$condition; 
        if (!$hg) $condition .=  " AND (regionName NOT LIKE 'http://%' and regionName NOT LIKE 'https://%') ";
    }
    else {
        if (!$hg) $condition = " WHERE (regionName NOT LIKE 'http://%' and regionName NOT LIKE 'https://%') ";
    }
    if ($order!='') $order = ' ORDER BY '.$order; 
    if ($limit!='') $limit = ' LIMIT '.   $limit; 

    $rginfos = array();

    $items = ' regions.uuid,regionName,locX,locY,sizeX,sizeY,serverIP,serverURI,serverHttpPort,owner_uuid,estate_map.EstateID,EstateOwner,EstateName,';
    $uname = ' FirstName,LastName ';
     $from  = ' FROM regions';
     $join1 = ' LEFT JOIN estate_map ON RegionID=regions.uuid ';
     $join2 = ' LEFT JOIN estate_settings ON estate_map.EstateID=estate_settings.EstateID ';
    $join3 = ' LEFT JOIN UserAccounts ON owner_uuid=UserAccounts.PrincipalID ';
    $frmwh = ' FROM UserAccounts WHERE UserAccounts.PrincipalID=';

    $query_str = 'SELECT '.$items.$uname.$from.$join1.$join2.$join3.$condition.$order.$limit;
    $db->query($query_str);
    if ($db->Errno==0) {
        while (list($UUID,$regionName,$locX,$locY,$sizeX,$sizeY,$serverIP,$serverURI,$serverPort,
                        $owneruuid,$estateid,$estateowner,$estatename,$firstname,$lastname) = $db->next_record()) {
            $rginfos[$UUID]['UUID']         = $UUID;
            $rginfos[$UUID]['regionName']   = $regionName;
            $rginfos[$UUID]['locX']         = $locX;
            $rginfos[$UUID]['locY']         = $locY;
            $rginfos[$UUID]['sizeX']        = $sizeX;
            $rginfos[$UUID]['sizeY']        = $sizeY;
            $rginfos[$UUID]['serverIP']     = $serverIP;
            $rginfos[$UUID]['serverPort']   = $serverPort;
            $rginfos[$UUID]['serverURI']    = $serverURI;
            $rginfos[$UUID]['owner_uuid']   = $owneruuid;
            $rginfos[$UUID]['estate_id']    = $estateid;
            $rginfos[$UUID]['estate_owner'] = $estateowner;
            $rginfos[$UUID]['estate_name']  = $estatename;
            $rginfos[$UUID]['est_firstname']= $firstname;
            $rginfos[$UUID]['est_lastname'] = $lastname;
            $rginfos[$UUID]['est_fullname'] = null;
            //
            if ($rginfos[$UUID]['estate_owner']==null) $rginfos[$UUID]['estate_owner'] = $owneruuid;

            $uri = preg_split("/[:\/]/", $serverURI);
            if (array_key_exists(3, $uri)) {
                $rginfos[$UUID]['serverName']  = $uri[3];
                //$rginfos[$UUID]['serverIP2'] = gethostbyname($uri[3]);
            }
            else {
                $rginfo['serverName'] = '';
                //$rginfo['serverIP2']  = '';
            }
            //
            $fullname = $firstname.' '.$lastname;
            if ($fullname!=' ') $rginfos[$UUID]['est_fullname'] = $fullname;
        }
    }

    // Region Owner
    foreach($rginfos as $region) {
        $rginfos[$region['UUID']]['rgn_firstname'] = null;
        $rginfos[$region['UUID']]['rgn_lastname']  = null;
        $rginfos[$region['UUID']]['rgn_fullname']  = null;

        if ($region['owner_uuid']!=null) {
            $db->query('SELECT '.$uname.$frmwh."'".$region['owner_uuid']."'");
            list($firstname,$lastname) = $db->next_record();
            $rginfos[$region['UUID']]['rgn_firstname'] = $firstname;
            $rginfos[$region['UUID']]['rgn_lastname']  = $lastname;
            $fullname = $firstname.' '.$lastname;
            if ($fullname!=' ') $rginfos[$region['UUID']]['rgn_fullname'] = $fullname;
        }
    }

    return $rginfos;
}


function  opensim_set_current_region($uuid, $regionid, &$db=null)
{
    if (!isGUID($uuid) or !isGUID($regionid)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    if ($db->exist_table('Presence')) {    
        $sql = "UPDATE Presence SET RegionID='".$regionid."' WHERE UserID='". $uuid."'";
    }
    // Standalone
    else {
        $sql = "UPDATE GridUser SET LastRegionID='".$regionid."' WHERE UserID='". $uuid."'";
    }

    $db->query($sql);
    if ($db->Errno!=0) return false;
    $db->next_record();

    return true;
}


function  opensim_delete_region($uuid, &$db=null)
{
    if (!isGUID($uuid)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("DELETE FROM regions WHERE uuid='$uuid'");
    if ($db->Errno!=0) return false;

    return true;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Home Region
//

function  opensim_get_home_region($uuid, &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $region_name = '';
    $db->query("SELECT regionName FROM GridUser,regions WHERE HomeRegionID=uuid AND UserID='$uuid'");
    list($region_name) = $db->next_record();

    return $region_name;
}


function  opensim_set_home_region($uuid, $hmregion, $pos_x='128', $pos_y='128', $pos_z='0', &$db=null)
{
    if (!isGUID($uuid)) return false;
    if (!isNumeric($pos_x) or !isNumeric($pos_y) or !isNumeric($pos_z)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("SELECT uuid,regionHandle FROM regions WHERE regionName='$hmregion'");
    $errno = $db->Errno;
    if ($errno==0) {
        list($regionID, $regionHandle) = $db->next_record();

        $homePosition = "<$pos_x,$pos_y,$pos_z>";
        $db->query("UPDATE GridUser SET HomeRegionID='$regionID',HomePosition='$homePosition' WHERE UserID='$uuid'");
        $errno = $db->Errno;
    }

    if ($errno!=0) return false;
    return true;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Estate
//

//
// リージョンID $region のエステート名を $estate にし，オーナーを $owner(UUID) にする．
// エステート名と オーナー(UUID) の組み合わせが存在しない場合は，新しくエステートを作成する．
//
function  opensim_set_region_estate($region, $estate, $owner, &$db=null)
{
    if (!isGUID($region) or $estate=='' or !isGUID($owner)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $estate_id = opensim_create_estate($estate, $owner, $db);
    if ($estate_id==0) return false;

    $db->query("UPDATE estate_map SET EstateID='$estate_id' WHERE RegionID='$region'");

    if ($db->Errno!=0) return false;
    return true;
}


//
// Estate名 $estate, オーナーUUID $owner のエステートを作成して ID を返す．
// 既に有る場合も,そのエステートのIDを返す．
// エラーの場合は 0を返す．
//
function  opensim_create_estate($estate, $owner, &$db=null)
{    
    if ($estate=='' or !isGUID($owner)) return 0;
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("SELECT EstateID FROM estate_settings WHERE EstateName='$estate' AND EstateOwner='$owner'");
    if ($db->Errno==0) {
        list($eid) = $db->next_record();
        if (intval($eid)>0) return $eid;
    }

    $insert_columns = 'EstateName,AbuseEmailToEstateOwner,DenyAnonymous,ResetHomeOnTeleport,FixedSun,DenyTransacted,BlockDwell,'.
                      'DenyIdentified,AllowVoice,UseGlobalTime,PricePerMeter,TaxFree,AllowDirectTeleport,RedirectGridX,RedirectGridY,'.
                      'ParentEstateID,SunPosition,EstateSkipScripts,BillableFactor,PublicAccess,AbuseEmail,EstateOwner,DenyMinors,'.
                      'AllowLandmark,AllowParcelChanges,AllowSetHome';
    $insert_values = "'$estate','0','0','0','0','0','0','0','1','1','1','0','1','0','0','1','0','0','0','1','','$owner','0','1','1','1'";

    $db->query("INSERT INTO estate_settings ($insert_columns) VALUES ($insert_values)");
    $db->query("SELECT EstateID FROM estate_settings WHERE EstateName='$estate' AND EstateOwner='$owner'");

    if ($db->Errno==0) {
        list($eid) = $db->next_record();
        return $eid;
    }

    return 0;
}



function  opensim_get_estates_infos(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    
    $estates = array();
    $db->query('SELECT EstateID,EstateOwner,EstateName FROM estate_settings ORDER BY EstateID');
    if ($db->Errno==0) {
        while (list($estateid, $estateown, $estatename) = $db->next_record()) {
            $estates[$estateid]['estate_id']     = $estateid;
            $estates[$estateid]['estate_owner']  = $estateown;
            $estates[$estateid]['estate_name']   = $estatename;
            $estates[$estateid]['firstname']     = '';
            $estates[$estateid]['lastname']      = '';
            $estates[$estateid]['fullname']      = '';
        }
    }      

    foreach($estates as $estate) {
        $avatar = opensim_get_avatar_name($estate['estate_owner'], false);
        if ($avatar!=null) {
            $estateid = $estate['estate_id'];
            $estates[$estateid]['firstname'] = $avatar['firstname'];
            $estates[$estateid]['lastname']  = $avatar['lastname'];
            $estates[$estateid]['fullname']  = $avatar['fullname'];
        }
    }

    return $estates;
}


//
// SIMのリージョンIDからエステートの情報を返す．
// 
function  opensim_get_estate_info($region, &$db=null)
{
    if (!isGUID($region)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $firstname = null;
    $lastname  = null;
    $fullname  = null;
    $owneruuid = null;
    
    $rqdt = 'PrincipalID,FirstName,LastName,estate_settings.EstateID,EstateOwner,EstateName';
    $tbls = 'UserAccounts,estate_map,estate_settings';
    $cndn = "RegionID='$region' AND estate_map.EstateID=estate_settings.EstateID AND EstateOwner=PrincipalID";

    $db->query('SELECT '.$rqdt.' FROM '.$tbls.' WHERE '.$cndn);
    list($owneruuid, $firstname, $lastname, $estateid, $estateowner, $estatename) = $db->next_record();

    $fullname = $firstname.' '.$lastname;
    if ($fullname==' ') $fullname = null;

    // owner name
    $name['firstname']   = $firstname;
    $name['lastname']    = $lastname;
    $name['fullname']    = $fullname;
    //
    $name['owner_uuid']  = $owneruuid;
    $name['estate_id']   = $estateid;
    $name['estate_owner']= $estateowner;
    $name['estate_name'] = $estatename;

    return $name;
}


//
// リージョンのエステートを変更する．
//
function  opensim_set_region_estateid($region, $estateid, &$db=null)
{
    if (!isGUID($region) or !isNumeric($estateid)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("SELECT EstateID FROM estate_settings WHERE EstateID='$estateid'");
    list($esid) = $db->next_record();
    if (intval($esid)==0) return false;

    $db->query("SELECT EstateID FROM estate_map WHERE RegionID='$region'");
    list($esid) = $db->next_record();

    if (intval($esid)!=$estateid) {
        $db->query("UPDATE estate_map SET EstateID='$estateid' WHERE RegionID='$region'");
    }
    else if (intval($esid)==0) {
        $db->query("INSERT INTO estate_map (RegionID,EstateID) VALUES ('$region','$estateid')");
    }

    return true;
}


//
// リージョンのエステートを変更せずに，オーナーのみ変更する．
// 従って，同じエステートを持つ他のリージョンのオーナーも変更される．
//
function  opensim_set_estate_owner($region, $owner, &$db=null)
{
    if (!isGUID($region) or !isGUID($owner)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("UPDATE estate_settings,estate_map SET EstateOwner='$owner' WHERE estate_settings.EstateID=estate_map.EstateID AND RegionID='$region'");
    $errno = $db->Errno;

    if ($errno==0) $db->query("UPDATE regions SET owner_uuid='$owner' WHERE uuid='$region'");
    if ($errno!=0) return false;

    return true;
}


function  opensim_del_estate($id, &$db=null)
{
    if (!isNumeric($id)) return;
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("DELETE from estate_settings WHERE EstateID=$id");

    return;
}


function  opensim_update_estate($id, $name, $owner, &$db=null)
{
    if (!isNumeric($id))    return false;
    if (!$name and !$owner) return false;
    if (!is_object($db)) $db = opensim_new_db();
    
    if ($name) {
        $db->query("UPDATE estate_settings SET EstateName='$name' WHERE EstateID=$id");
    }
        
    $uuid = opensim_get_avatar_uuid($owner, false);
    if ($uuid) {
        $db->query("UPDATE estate_settings SET EstateOwner='$uuid' WHERE EstateID=$id");
    }

    return true;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Parcel
//

function  opensim_get_parcel_name($parcel, &$db=null)
{
    if (!isGUID($parcel)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $name = null;
    $db->query("SELECT name FROM land WHERE UUID='$parcel'");

    if ($db->Errno==0) list($name) = $db->next_record();

    return $name;
}


function  opensim_get_parcel_info($parcel, &$db=null)
{
    if (!isGUID($parcel)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $info = array();

    $items = "RegionUUID,Name,Description,OwnerUUID,Category,SalePrice,LandStatus,LandFlags,LandingType,Dwell";
    $query_str = "SELECT ".$items." FROM land WHERE UUID='".$parcel."'";

    $db->query($query_str);
    if ($db->Errno==0) $info = $db->next_record();

    return $info;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// for Assets
//

function  opensim_get_asset_data($uuid, &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $asset = array();

    $db->query("SELECT name,description,assetType,data,asset_flags,CreatorID FROM assets WHERE id='$uuid'");
    list($name, $desc, $type, $data, $flag, $creator) = $db->next_record();

    $asset['UUID']    = $uuid;
    $asset['name']    = $name;
    $asset['desc']    = $desc;
    $asset['type']    = $type;
    $asset['data']    = $data;
    $asset['flag']    = $flag;
    $asset['creator'] = $creator;

    return $asset;
}


function  opensim_display_texture_data($uuid, $prog, $xsize='0', $ysize='0', $cachedir='', $use_tga=false)
{
    if (!isGuid($uuid)) return false;
    if ($prog==null or $prog=='') return false;

    if ($cachedir=='') $cachedir = '/tmp';
    $cachefile = $cachedir.'/'.$uuid;
    $win_com = '';
    
    // PHP module
    $imagick = null;
    if ($prog=='imagick') {
        if (class_exists('Imagick')) {
            $imagick = new Imagick();
        }
        else {
            echo '<h4>PHP module Imagick is not installed!!</h4>';
            return false;
        }
    }

    // Linux Command
    else if ($prog=='convert' or $prog=='jasper') {
        if      (file_exists('/usr/bin/'.$prog))        $path = '/usr/bin/';
        else if (file_exists('/usr/X11R6/bin/'.$prog)) $path = '/usr/X11R6/bin/';
        else if (file_exists('/usr/local/bin/'.$prog)) $path = '/usr/local/bin/';
        else {
            echo '<h4>program '.$prog.' is not found!!</h4>';
            return false;
        }
        if ($prog=='jasper') {        // JasPer does not support Targa image format.
            $use_tga = false;
        }
    }

    // Windows Command
    else if ($prog=='opj_decompress') {
        $use_tga = false;
        $win_com = CMS_MODULE_PATH."\\win\\".$prog.".exe";
        if (!file_exists($win_com)) {
             echo '<h4>program '.$prog.' is not found!!</h4>';
            return false;
       }
    }

    // Check j2k to TGA command
    if ($use_tga) {
        $tga_com = get_j2k_to_tga_command();
        if ($tga_com=='') $use_tga = false;
    }

    // get and save image
    if (! ((!$use_tga and file_exists($cachefile)) or ($use_tga and file_exists($cachefile.'.tga')))) {
        $imgdata = '';

        // from MySQL Server
        $asset = opensim_get_asset_data($uuid);
        if ($asset) {
            if ($asset['type']==0) {
                $imgdata = $asset['data'];
            }
        }
        else {
            echo '<h4>asset uuid is not found!! ('.htmlspecialchars($uuid).')</h4>';
            return false;
        }

/*        // from Asset Server
        //$asset_url = $ASSET_SERVER_URL.'/assets/'.$uuid;
        $asset_url = 'http://202.26.159.200:8003/assets/'.$uuid;
        $fp = fopen($asset_url, "rb");
        stream_set_timeout($fp, 5);
        $content = stream_get_contents($fp);
        fclose($fp);
        if (!$content) {
            echo '<h4>asset uuid is not found!! ('.htmlspecialchars($uuid).')</h4>';
            return false;
        }

        $xml = new SimpleXMLElement($content);
        $imgdata = base64_decode($xml->Data);
*/
        // Save Image Data
        $fp = fopen($cachefile, 'wb');
        fwrite($fp, $imgdata);
        fclose($fp);

        if ($use_tga) {
            if (!j2k_to_tga($cachefile)) $use_tga = false;
        }
    }

    if ($use_tga && file_exists($cachefile.'.tga')) $cachefile .= '.tga';

    //
    // program for image processing of jpeg2000
    //

    // Imagick of PHP
    if ($prog=='imagick' and $imagick!=null) {
        $ret = $imagick->readImage($cachefile);
        if (!$ret) {
            echo '<h4>Imagick could not read '.$cachefile.'!!</h4>';
            return false;
        }
        $imagick->setImageFormat('JPEG'); 
        if ($xsize>0 and $ysize>0) {
            $imagick->scaleImage($xsize, $ysize);
        }

        header("Content-Type: image/jpeg"); 
        echo $imagick;
    }

    // ImageMagic (convert)
    else if ($prog=='convert') {
        $imgsize = '';
        if ($xsize>0 and $ysize>0) $imgsize = ' -resize '.$xsize.'x'.$ysize.'!';
        $prog = $path.'convert '. $cachefile.$imgsize.' jpeg:-';

        header("Content-Type: image/jpeg"); 
        passthru($prog);
    }

    // Jasper
    else if ($prog=='jasper') {
        $conv = '';
        if ($xsize>0 and $ysize>0) {
            $conv = get_image_size_convert_command($xsize, $ysize);
            if ($conv!='') $conv = ' | '.$conv;
        }
        $prog = $path.'jasper -f '.$cachefile.' -T jpg '.$conv;

        header("Content-Type: image/jpeg"); 
        passthru($prog);
    }

    // opj_decompress on Windows
    else if ($prog=='opj_decompress') {
        if (!file_exists($cachefile.'.bmp')) {
            $prog = $win_com.' -i '.$cachefile.' -o '.$cachefile.'.bmp';
            exec($prog);
        }
        header("Content-Type: image/bmp"); 
        readfile($cachefile.'.bmp');
    }

    return true;
}


function  opensim_get_object_name($uuid, &$db=null)
{
    $objName = '';
    if (!isGuid($uuid)) return null;
    if ($uuid==UUID_ZERO) return $objName;
    if (!is_object($db)) $db = opensim_new_db();

    $query_str = "SELECT Name FROM prims WHERE UUID='$uuid'";

    $db->query($query_str);
    if ($db->Errno==0) list($objName) = $db->next_record();

    return $objName;
}



/////////////////////////////////////////////////////////////////////////////////////
//
// for Inventory
//

function  opensim_create_avatar_inventory($uuid, $base_uuid, &$db=null)
{
    if (!isGuid($uuid) or !isGuid($base_uuid)) return;
    if (!is_object($db)) $db = opensim_new_db();

    $name = array();
    if ($base_uuid!=UUID_ZERO) $name = opensim_get_avatar_name($base_uuid, false, $db);

    if (isset($name['fullname'])) {
        $folder = opensim_create_inventory_folders_dup($uuid, $base_uuid, $db);
        $invent = opensim_create_inventory_items_dup($uuid, $base_uuid, $folder, $db);
        opensim_create_avatar_wear_dup($uuid, $base_uuid, $invent, $db);
    }
    else {
        opensim_create_default_inventory_folders($uuid, $db);
        $invent = opensim_create_default_inventory_items($uuid, $db);
        opensim_create_default_avatar_wear($uuid, $invent, $db);
    }

    return;
}


function  opensim_create_avatar_wear_dup($touuid, $fromid, $invent, &$db=null)
{
    if (!$invent or !is_array($invent)) return false;
    if (!is_object($db)) $db = opensim_new_db();
    if (!$db->exist_table('Avatars')) return false;

    $db->query("SELECT * FROM Avatars WHERE PrincipalID='$fromid'");
    $errno = $db->Errno;

    if ($errno==0) {
        $db2 = opensim_new_db();
        while (list($PrincipalID,$Name,$Value) = $db->next_record()) {
            if (!strncasecmp($Name, 'Wearable ', 9)) {
                $id = explode(':', $Value);
                if (array_key_exists(1, $id)) {
                    if (isGUID($id[0]) and isGUID($id[1])) {
                        if (isset($invent[$id[0]])) $Value = $invent[$id[0]].':'.$id[1];
                    }
                }
            }
            else if (!strncasecmp($Name, '_ap_', 4)) {
                if (isGUID($Value)) {
                    if (isset($invent[$Value])) $Value = $invent[$Value];
                }
            }

            $Name  = addslashes($Name);
            $Value = addslashes($Value);
            //
            $db2->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$touuid','$Name','$Value')");
        }
    }

    if ($errno!=0) return false;
    return true;
}


//
// コピーしたアイテムのIDのコピー元とコピー先の対応を格納した配列を返す．
//
function  opensim_create_inventory_items_dup($touuid, $fromid, $folder, &$db=null)
{
    if (!$folder or !is_array($folder)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $invent = array();
    $db->query("SELECT * FROM inventoryitems WHERE avatarID='$fromid'");
    $errno = $db->Errno;

    if ($errno==0) {
        $db2 = opensim_new_db();
        while (list($assetID,$assetType,$inventoryName,$inventoryDescription,$inventoryNextPermissions,$inventoryCurrentPermissions,
                     $invType,$creatorID,$inventoryBasePermissions,$inventoryEveryOnePermissions,$salePrice,$saleType,$creationDate,
                     $groupID,$groupOwned,$flags,$inventoryID,$avatarID,$parentFolderID,$inventoryGroupPermissions) = $db->next_record()) {

            if (isset($folder[$parentFolderID]) and $folder[$parentFolderID]->type=='46') continue;        // Current Outfit

            $inventoryName = addslashes($inventoryName);
            $inventoryDescription = addslashes($inventoryDescription);

            $avatarID = $touuid;
            $inventID = make_random_guid();
            if (isset($folder[$parentFolderID])) $parent = $folder[$parentFolderID]->folderID;
            else                                  $parent = UUID_ZERO;
            $invent[$inventoryID] = $inventID;
            //
            $db2->query('INSERT INTO inventoryitems (assetID,assetType,inventoryName,inventoryDescription,inventoryNextPermissions,'.
                                    'inventoryCurrentPermissions,invType,creatorID,inventoryBasePermissions,inventoryEveryOnePermissions,salePrice,'.
                                    'saleType,creationDate,groupID,groupOwned,flags,inventoryID,avatarID,parentFolderID,inventoryGroupPermissions) '.
                            "VALUES ('$assetID','$assetType','$inventoryName','$inventoryDescription','$inventoryNextPermissions','$inventoryCurrentPermissions',".
                                    "'$invType','$creatorID','$inventoryBasePermissions','$inventoryEveryOnePermissions','$salePrice','$saleType','$creationDate',".
                                    "'$groupID','$groupOwned','$flags','$inventID','$avatarID','$parent','$inventoryGroupPermissions')");
        }
    }

    return $invent;
}


//
// 作成したフォルダーの情報を返す．キーはコピー元フォルダーのフォルダーID
//
function  opensim_create_inventory_folders_dup($touuid, $fromid, &$db=null)
{
    if (!isGUID($fromid)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $folder = array();

    $db->query("SELECT * FROM inventoryfolders WHERE agentID='$fromid'");
    $errno = $db->Errno;

    if ($errno==0) {
        while(list($folderName,$type,$version,$folderID,$agentID,$parentFolderID) = $db->next_record()) {
            $folder[$folderID] = new stdClass();
            $folder[$folderID]->folderName = $folderName;
            $folder[$folderID]->type = $type;
            $folder[$folderID]->version    = $version;
            $folder[$folderID]->folderID = make_random_guid();
            $folder[$folderID]->agentID = $touuid;
            $folder[$folderID]->parentFolderID = $parentFolderID;
        }

        foreach($folder as $fid=>$fld) {
            $parent = UUID_ZERO;
            if ($fld->parentFolderID) {
                if (isset($folder[$fld->parentFolderID])) $parent = $folder[$fld->parentFolderID]->folderID;
            }
            $folder[$fid]->parentFolderID = $parent;

            $folderName = addslashes($fld->folderName);
            $folderType = $fld->type;
            $version    = $fld->version;
            $folderID   = $fld->folderID;
            //
            $db->query("INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) ".
                               "VALUES ('$folderName','$folderType','$version','$folderID','$touuid','$parent')");
        }
    }

    return $folder;
}


function  opensim_create_default_avatar_wear($uuid, $invent, &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if (!$db->exist_table('Avatars')) return false;

    $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','AvatarHeight','".DEFAULT_AVATAR_HEIGHT."')");
    $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','AvatarType','1')");
    $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','Serial','0')");
    $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','VisualParams','".DEFAULT_AVATAR_PARAMS."')");

    if (is_array($invent)) {
        if (isset($invent['Shape'])) 
            $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','Wearable 0:0','".$invent['Shape'].':'.DEFAULT_ASSET_SHAPE."')");
        if (isset($invent['Skin']))
            $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','Wearable 1:0','".$invent['Skin']. ':'.DEFAULT_ASSET_SKIN."')");
        if (isset($invent['Hair'])) 
            $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','Wearable 2:0','".$invent['Hair']. ':'.DEFAULT_ASSET_HAIR."')");
        if (isset($invent['Eyes'])) 
            $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','Wearable 3:0','".$invent['Eyes']. ':'.DEFAULT_ASSET_EYES."')");
        if (isset($invent['Shirt'])) 
            $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','Wearable 4:0','".$invent['Shirt'].':'.DEFAULT_ASSET_SHIRT."')");
        if (isset($invent['Pants'])) 
            $db->query("INSERT INTO Avatars (PrincipalID,Name,Value) VALUES ('$uuid','Wearable 5:0','".$invent['Pants'].':'.DEFAULT_ASSET_PANTS."')");
    }

    return true;
}


function  opensim_create_default_inventory_items($uuid, &$db=null)
{
    if (!isGUID($uuid)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("SELECT folderID FROM inventoryfolders WHERE agentID='$uuid' AND type='13'");    // Body Parts Folder
    list($body_folder) = $db->next_record();
    $db->query("SELECT folderID FROM inventoryfolders WHERE agentID='$uuid' AND type='5'");        // Clothing Folder
    list($cloth_folder) = $db->next_record();
    if (!$body_folder or !$cloth_folder) return false;

    $default_inv = array();

    $create_time = time();
    $insert_columns = 'assetID,assetType,inventoryName,inventoryDescription,inventoryNextPermissions,inventoryCurrentPermissions,invType,'.
                      'creatorID,inventoryBasePermissions,inventoryEveryOnePermissions,creationDate,flags,inventoryID,avatarID,parentFolderID,'.
                      'inventoryGroupPermissions';
    $insert_common  = "'','581632','581632','18','$uuid','581632','581632','$create_time'";

    $invID = make_random_guid();
    $db->query("INSERT INTO inventoryitems ($insert_columns) ".
                    "VALUES ('".DEFAULT_ASSET_SHAPE."','13','Default Shape',$insert_common,'0','$invID','$uuid','$body_folder', '581632')");
    $errno = $db->Errno;

    if ($errno==0) {
        $default_inv['Shape'] = $invID;
        $invID = make_random_guid();
        $db->query("INSERT INTO inventoryitems ($insert_columns) ".
                    "VALUES ('".DEFAULT_ASSET_SKIN. "','13','Default Skin', $insert_common,'1','$invID','$uuid','$body_folder', '581632')");
        $errno = $db->Errno;
    }
    if ($errno==0) {
        $default_inv['Skin'] = $invID;
        $invID = make_random_guid();
        $db->query("INSERT INTO inventoryitems ($insert_columns) ".
                    "VALUES ('".DEFAULT_ASSET_HAIR. "','13','Default Hair', $insert_common,'2','$invID','$uuid','$body_folder', '581632')");
        $errno = $db->Errno;
    }
    if ($errno==0) {
        $default_inv['Hair'] = $invID;
        $invID = make_random_guid();
        $db->query("INSERT INTO inventoryitems ($insert_columns) ".
                    "VALUES ('".DEFAULT_ASSET_EYES. "','13','Default Eyes', $insert_common,'3','$invID','$uuid','$body_folder', '581632')");
        $errno = $db->Errno;
    }
    if ($errno==0) {
        $default_inv['Eyes'] = $invID;
        $invID = make_random_guid();
        $db->query("INSERT INTO inventoryitems ($insert_columns) ".
                    "VALUES ('".DEFAULT_ASSET_SHIRT. "','5','Default Shirt',$insert_common,'4','$invID','$uuid','$cloth_folder','581632')");
        $errno = $db->Errno;
    }
    if ($errno==0) {
        $default_inv['Shirt'] = $invID;
        $invID = make_random_guid();
        $db->query("INSERT INTO inventoryitems ($insert_columns) ".
                    "VALUES ('".DEFAULT_ASSET_PANTS. "','5','Default Pants',$insert_common,'5','$invID','$uuid','$cloth_folder','581632')");
        $errno = $db->Errno;
    }
    if ($errno==0) {
        $default_inv['Pants'] = $invID;
    }
        
    return $default_inv;
}


function  opensim_create_default_inventory_folders($uuid, &$db=null)
{
    if (!isGUID($uuid)) return false;
    if (!is_object($db)) $db = opensim_new_db();
    
    $my_inventory = make_random_guid();
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('My Inventory','8','1','$my_inventory','$uuid','".UUID_ZERO."')");
    //
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Textures','0','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Sounds','1','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Calling Cards','2','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Landmarks','3','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Clothing','5','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Objects','6','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Notecards','7','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Scripts','10','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Body Parts','13','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Trash','14','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Photo Album','15','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Lost And Found','16','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Animations','20','1','".make_random_guid()."','$uuid','$my_inventory')");
    $db->query('INSERT INTO inventoryfolders (folderName,type,version,folderID,agentID,parentFolderID) '.
                      "VALUES ('Gestures','21','1','".make_random_guid()."','$uuid','$my_inventory')");
    return true;
}


 

/////////////////////////////////////////////////////////////////////////////////////
//
// for Password
//

function  opensim_get_password($uuid, $tbl='', &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!isAlphabetNumeric($tbl, true)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $passwdhash = null;
    $passwdsalt = null;

    if ($tbl=='' or $tbl=='auth') {
        if ($db->exist_table('auth')) {
            $db->query("SELECT passwordHash,passwordSalt FROM auth WHERE UUID='$uuid'");
            list($passwdhash, $passwdsalt) = $db->next_record();
        }
    }

    if ($passwdhash==null and $passwdsalt==null) {
        if ($tbl=='' or $tbl=='users') {
            if ($db->exist_table('users')) {
                $db->query("SELECT passwordHash,passwordSalt FROM users WHERE UUID='$uuid'");
                list($passwdhash, $passwdsalt) = $db->next_record();
            }
        }
    }

    $ret['passwordHash'] = $passwdhash;
    $ret['passwordSalt'] = $passwdsalt;
    return $ret;
}


function  opensim_set_password($uuid, $passwdhash, $passwdsalt='', $tbl='', &$db=null)
{
    if (!isGUID($uuid)) return false;
    if (!isAlphabetNumeric($passwdhash)) return false;
    if (!isAlphabetNumeric($passwdsalt, true)) return false;
    if (!isAlphabetNumeric($tbl, true)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $setpasswd = "passwordHash='$passwdhash'";
    if ($passwdsalt!='') {
        $setpasswd .= ",passwordSalt='$passwdsalt'";
    }

    $errno = 0;
    if ($tbl=='' or $tbl=='auth') {
        if ($db->exist_table('auth')) {
            $db->query("UPDATE auth SET ".$setpasswd." WHERE UUID='$uuid'");
            $errno = $db->Errno;
        }
    }

    if (($tbl=='' or $tbl=='users') and $errno==0) {
        if ($db->exist_table('users')) {
            $db->query("UPDATE users SET ".$setpasswd." WHERE UUID='$uuid'");
            if ($db->Errno!=0) {
                if (!$db->exist_table('auth')) $errno = 99;
            }
        }
    }

    if ($errno!=0) return false;
    return true;
}



/////////////////////////////////////////////////////////////////////////////////////
//
// for Voice (VoIP)
//

function  opensim_get_voice_mode($region, &$db=null)
{
    if (!isGUID($region)) return -1;
    if (!is_object($db)) $db = opensim_new_db();

    $voiceflag = 0x60000000;

    $count = 0;
    $db->query("SELECT LandFlags FROM land WHERE RegionUUID='$region'");
    while (list($flag) = $db->next_record()) {
        $voiceflag &= $flag;
        $count++;
    }

    if ($count>0) {
        if        ($voiceflag==0x20000000) return 1;    // プライベート
        else if ($voiceflag==0x40000000) return 2;    // パーセル
        else                             return 0;    // 無効
    }

    return 9;    // 不明
}    


function  opensim_set_voice_mode($region, $mode, &$db=null)
{
    if (!isGUID($region)) return false;
    if (!preg_match('/^[0-2]$/', $mode)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $colum  = 0;
    $vflags = array();

    $db->query("SELECT UUID,LandFlags FROM land WHERE RegionUUID='$region'");
    while (list($UUID, $flag) = $db->next_record()) {
        $flag &= 0x9fffffff;
        if ($mode==1)       $flag |= 0x20000000;
        else if ($mode==2) $flag |= 0x40000000;

        $vflags[$colum]['UUID'] = $UUID;
        $vflags[$colum]['flag'] = $flag;
        $colum++;
    }

    foreach($vflags as $vflag) {
        $UUID = $vflag['UUID'];
        $flag = $vflag['flag'];
        $db->query("UPDATE land SET LandFlags='$flag' WHERE UUID='$UUID'");
    }

    return true;
}    



/////////////////////////////////////////////////////////////////////////////////////
//
// for Currency

// Transaction Type
$TransactionType['900']   = 'BirthGift';
$TransactionType['901']   = 'AwardPoints';
$TransactionType['1002']  = 'GroupCreate';
$TransactionType['1004']  = 'GroupJoin';
$TransactionType['1101']  = 'UploadCharge';
$TransactionType['1102']  = 'LandAuction';
$TransactionType['1103']  = 'ClassifiedCharge';
$TransactionType['2003']  = 'ParcelDirFee';
$TransactionType['2005']  = 'ClassifiedRenew';
$TransactionType['2900']  = 'ScheduledFee';
$TransactionType['3000']  = 'GiveInventory';
$TransactionType['5000']  = 'ObjectSale';
$TransactionType['5001']  = 'Gift';
$TransactionType['5002']  = 'LandSale';
$TransactionType['5003']  = 'ReferBonus';
$TransactionType['5004']  = 'InvntorySale';
$TransactionType['5005']  = 'RefundPurchase';
$TransactionType['5006']  = 'LandPassSale';
$TransactionType['5007']  = 'DwellBonus';
$TransactionType['5008']  = 'PayObject';
$TransactionType['5009']  = 'ObjectPays';
$TransactionType['5010']  = 'BuyMoney';
$TransactionType['5011']  = 'MoveMoney';
$TransactionType['5012']  = 'SendMoney';
$TransactionType['6003']  = 'GroupLiability';
$TransactionType['6004']  = 'GroupDividend';
$TransactionType['10000'] = 'StipendBasic';


//
function  opensim_get_transaction_type($type)
{
    global $TransactionType;

    if (!array_key_exists($type, $TransactionType)) return null;

    return $TransactionType[$type];
}


//
// status: 0-SUCCESS, 1-PENDING, 2-FAILED(EXPIRED), 9-ERROR
//
function  opensim_set_currency_transaction($srcId, $dstId, $amount, $type, $status, $desc, &$db=null)
{
    if (!isNumeric($amount)) return false;
    if (!isGUID($srcId)) $srcId = UUID_ZERO;
    if (!isGUID($dstId)) $dstId = UUID_ZERO;
    if (!is_object($db)) $db = opensim_new_db();

    $handle = 0;
    $secure = UUID_ZERO;
    $client    = $srcId;
    $UUID    = make_random_guid();
    $srcID  = $srcId;
    $dstID  = $dstId;
    if ($client==UUID_ZERO) $client = $dstId;

    $avt = opensim_get_avatar_session($client);
    if ($avt!=null) {
        $region = $avt['regionID'];
        $secure = $avt['secureID'];

        $rgn = opensim_get_region_info($region);
        if ($rgn!=null) $handle = $rgn['regionHandle'];
    }

    $senderBalance   = opensim_get_currency_balance($srcID) - $amount;
    $receiverBalance = opensim_get_currency_balance($dstID) + $amount;

    $sql = 'INSERT INTO transactions (UUID,sender,receiver,amount,senderBalance,receiverBalance,objectUUID,objectName'.
                                       'regionHandle,type,time,secure,status,description,commonName) '.
            "VALUES ('".$UUID."','".
                        $srcID."','".
                        $dstID."','".
                        $amount."','".
                        $senderBalance."','".
                        $receiverBalance."','".
                        UUID_ZERO."','".
                        "','".
                        $handle."','".
                        $db->escape($type)."','".
                        time()."','".
                        $secure."','".
                        $db->escape($status)."','".  
                        $db->escape($desc)."','".  
            "')";
    $db->query($sql);

    if ($db->Errno==0) return true;
    return false;
}


function  opensim_set_currency_balance($uuid, $amount, &$db=null)
{
    if (!isGUID($uuid) or !isNumeric($amount)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $userid = $db->escape($uuid);

    $db->lock_table('balances');

    $db->query("SELECT balance FROM balances WHERE user='$userid'");
    if ($db->Errno==0) {
        list($cash) = $db->next_record();
        $balance = (integer)$cash + (integer)$amount;

        $db->query("UPDATE balances SET balance='$balance' WHERE user='$userid'");
        if ($db->Errno==0) $db->next_record();
    }

    $db->unlock_table();

    return true;
}


function  opensim_get_currency_balance($uuid, &$db=null)
{
    if (!isGUID($uuid)) return 0;
    if (!is_object($db)) $db = opensim_new_db();

    $userid = $db->escape($uuid);
    $db->query("SELECT balance FROM balances WHERE user='$userid'");

    $cash = 0;
    if ($db->Errno==0) list($cash) = $db->next_record();

    return (integer)$cash;
}


function  opensim_del_currency_expired(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    $db->query("DELETE FROM transactions WHERE status='2'");

    return;
}


function  opensim_get_currency_transactions($condition='', $order='', $limit='', &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') $condition = 'WHERE '.$condition; 
    if ($order!='') $order = ' ORDER BY '.$order; 
    if ($limit!='') $limit = ' LIMIT '.   $limit;

    $query_str = 'SELECT UUID,sender,receiver,amount,senderBalance,receiverBalance,'.
                         'objectUUID,objectName,type,time,status,commonName,description FROM transactions '.
                         $condition.$order.$limit;
    $db->query($query_str);

    $trans = array();
    if ($db->Errno==0) {
        while (list($UUID,$sender,$receiver,$amount,$sndBalance,$rcvBalance,
                        $objUUID,$objName,$type,$time,$status,$comName,$desc)=$db->next_record()) {
            $trans[$UUID]['UUID']            = $UUID;
            $trans[$UUID]['sender']          = $sender;
            $trans[$UUID]['receiver']        = $receiver;
            $trans[$UUID]['amount']          = $amount;
            $trans[$UUID]['senderBalance']   = $sndBalance;
            $trans[$UUID]['receiverBalance'] = $rcvBalance;
            $trans[$UUID]['objectUUID']      = $objUUID;
            $trans[$UUID]['objectName']      = $objName;
            $trans[$UUID]['type']            = $type;
            $trans[$UUID]['time']            = $time;
            $trans[$UUID]['status']          = $status;
            $trans[$UUID]['commonName']      = $comName;
            $trans[$UUID]['description']     = $desc;
        }
    } 
    return $trans;
}


function  opensim_get_currency_amounts_log($uuid, $condition='', $order='', $limit='', &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') $condition = ' AND ('.$condition.')';
    if ($order!='') $order = ' ORDER BY '.$order; 
    if ($limit!='') $limit = ' LIMIT '.   $limit; 

    $condition = " WHERE (sender='$uuid' OR receiver='$uuid') AND sender!=receiver AND (status='0' OR status='9') ".
                          $condition.$order.$limit;
    $query_str = 'SELECT UUID,sender,receiver,amount,senderBalance,receiverBalance,objectUUID,objectName,'.
                          'regionHandle,regionUUID,type,time,status,commonName,description FROM transactions '.$condition;
    $db->query($query_str);

    $trans = array();
    if ($db->Errno==0) {
        while (list($UUID,$sender,$receiver,$amount,$sndBalance,$rcvBalance,$objUUID,$objName,
                            $regionHandle,$regionUUID,$type,$time,$status,$comName,$desc)=$db->next_record()) {
            $trans[$UUID]['UUID']            = $UUID;
            $trans[$UUID]['sender']          = $sender;
            $trans[$UUID]['receiver']        = $receiver;
            $trans[$UUID]['amount']          = $amount;
            $trans[$UUID]['senderBalance']   = $sndBalance;
            $trans[$UUID]['receiverBalance'] = $rcvBalance;
            $trans[$UUID]['objectUUID']      = $objUUID;
            $trans[$UUID]['objectName']      = $objName;
            $trans[$UUID]['regionHandle']    = $regionHandle;
            $trans[$UUID]['regionUUID']      = $regionUUID;
            $trans[$UUID]['type']            = $type;
            $trans[$UUID]['time']            = $time;
            $trans[$UUID]['status']          = $status;
            $trans[$UUID]['commonName']      = $comName;
            $trans[$UUID]['description']     = $desc;
        }
    } 
    return $trans;

}


function  opensim_get_currency_amounts_num($uuid, $condition='', &$db=null)
{
    if (!isGUID($uuid)) return 0;
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') $condition = 'AND ('.$condition.')';

    $count = 0;

    $condition = "WHERE (sender='$uuid' OR receiver='$uuid') AND sender!=receiver AND (status='0' OR status='9') ".$condition;
    $query_str = 'SELECT COUNT(*) FROM transactions '.$condition;
    $db->query($query_str);
    list($count) = $db->next_record();

    return (integer)$count;

}


function  opensim_set_userinfo($user, $simip, $avatar, $pass, &$db=null)
{
    if (!isGUID($user)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    $db_user = null;
    $db->query("SELECT user,simip,avatar,pass FROM userinfo WHERE user='$user'");
    if ($db->Errno==0) {
        list($db_user, $db_simip, $db_avatar, $db_pass) = $db->next_record();
    }

    if ($db_user) {
        if ($simip !=null) $db_simip  = $simip;
        if ($avatar!=null) $db_avatar = $avatar;
        if ($pass  !=null) $db_pass   = $pass;
        $query_str = "UPDATE userinfo SET simip='$db_simip', avatar='$db_avatar', pass='$db_pass' WHERE user='$uuid'";
    }
    else {
        $query_str = "INSERT INTO userinfo (user, simip, avatar, pass) VALUES ('$user','$simip','$avatar','$pass')";
    }    

    $db->query($query_str);

    if ($db->Errno==0) return true;
    return false;
}


function  opensim_get_userinfo($uuid, &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $query_str = "SELECT user,simip,avatar,pass FROM userinfo WHERE user='$uuid'";
    $db->query($query_str);

    list($user, $simip, $avatar, $pass) = $db->next_record();

    $info['UUID']   = $user;
    $info['user']   = $user;
    $info['simip']  = $simip;
    $info['avatar'] = $avatar;
    $info['pass']   = $pass;

    return $info;
}


function  opensim_get_userinfos($condition='', $order='', $limit='', &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if ($condition!='') $condition = 'WHERE '.$condition;
    if ($order!='') $order = ' ORDER BY '.$order; 
    if ($limit!='') $limit = ' LIMIT '.   $limit; 

    $infos = array();
    $query_str = 'SELECT user,simip,avatar,pass,type,class FROM userinfo '.$condition.$order.$limit;

    $db->query($query_str);
    if ($db->Errno==0) {
        while (list($UUID, $simip, $avatar, $pass, $type, $class) = $db->next_record()) {
            $infos[$UUID]['UUID']   = $UUID;
            $infos[$UUID]['user']   = $UUID;
            $infos[$UUID]['simip']  = $simip;
            $infos[$UUID]['avatar'] = $avatar;
            $infos[$UUID]['pass']   = $pass;
            $infos[$UUID]['type']   = $type;
            $infos[$UUID]['class']  = $class;
        }
    }

    return $infos;
}


function  opensim_get_totalsales($condition='', $order='', $limit='', &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    $db->query('SELECT MIN(time) FROM totalsales');
    list($mintime) = $db->next_record(); 

    //
    $sales = array();

    if ($condition!='') $condition = 'WHERE '.$condition;
    if ($order!='') $order = ' ORDER BY '.$order;
    if ($limit!='') $limit = ' LIMIT '.   $limit; 

    $query_str = 'SELECT user,objectUUID,type,TotalCount,TotalAmount FROM totalsales '.$condition.$order.$limit;

    $db->query($query_str);
    if ($db->Errno==0) {
        $num = 0;
        while (list($user, $objUUID, $type, $count, $amount) = $db->next_record()) {
            $sales[$num]['user']   = $user;
            $sales[$num]['object'] = opensim_get_object_name($objUUID);
            $sales[$num]['type']   = $type;
            $sales[$num]['count']  = $count;
            $sales[$num]['amount'] = $amount;
            $sales[$num]['time']   = $mintime;
            $name = opensim_get_avatar_name($user);
            $sales[$num]['name']   = $name['fullname'];
            if ($sales[$num]['name']  =='') $sales[$num]['name']   = $user;
            if ($sales[$num]['object']=='') $sales[$num]['object'] = $objUUID;
            //
            $num++;
        }
    }

    return $sales;    
}


function  opensim_regenerate_totalsales(&$since=0, &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    $time = $since;
    if ($time==null) $time = 0;

    $trans = array();

    $query_str = 'SELECT receiver,objectUUID,type,COUNT(*),SUM(amount),MIN(time) FROM transactions '.
                        " WHERE sender != receiver AND status = '0' AND time>='$time' AND sender != '".UUID_ZERO."' ".
                        " GROUP BY receiver,objectUUID,type";

    $db->query($query_str);
    if ($db->Errno==0) {
        $num = 0;
        while (list($user, $objID, $type, $count, $amount, $time) = $db->next_record()) {
            $trans[$num]['user']   = $user;
            $trans[$num]['object'] = $objID;
            $trans[$num]['type']   = $type;
            $trans[$num]['count']  = $count;
            $trans[$num]['amount'] = $amount;
            $trans[$num]['time']   = $time;
            $num++;
        }
    }
    else return false;

    //
    $db->lock_table('totalsales');
    $db->query('DELETE FROM totalsales');
    if ($db->Errno!=0) return false;

    $mintime = time();
    for ($i=0; $i<$num; $i++) {
        $UUID   = make_random_guid();
        $user   = $trans[$i]['user'];
        $objID  = $trans[$i]['object'];
        $type   = $trans[$i]['type'];
        $count  = $trans[$i]['count'];
        $amount = $trans[$i]['amount'];
        $time   = $trans[$i]['time'];

        $query_str = 'INSERT INTO totalsales (UUID, user, objectUUID, type, TotalCount, TotalAmount, time) '.
                                         "VALUES ('$UUID','$user','$objID','$type','$count','$amount','$time')";
        $db->query($query_str);
        if ($db->Errno!=0) break;

        if ($time<$mintime) $mintime = $time; 
    }

    $db->unlock_table();

    if ($i!=$num) return false;
    
    $since = $mintime;
    return true;
}



/////////////////////////////////////////////////////////////////////////////////////
//
// Tools
//

function  opensim_get_servers_ip(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    $ips = array();

    $db->query("SELECT DISTINCT serverURI FROM regions");
    if ($db->Errno==0) {
        $count = 0;
        while (list($url) = $db->next_record()) {
            $item = preg_split("/[:\/]/", $url);
            if (array_key_exists(3, $item)) {
                $ips[$count] = gethostbyname($item[3]);
                $count++;
            }
        }
    }

/*
    $db->query("SELECT DISTINCT serverIP FROM regions");
    if ($db->Errno==0) {
        $count = 0;
        while (list($server) = $db->next_record()) {
            $ips[$count] = gethostbyname($server);
            $count++;
        }
    }
*/

/*
    $db->query("SELECT DISTINCT serverURI FROM regions");
    if ($db->Errno==0) {
        $count = 0;
        while (list($server) = $db->next_record()) {
            $uri = preg_split("/[:\/]/", $server);
            if (array_key_exists(3, $uri)) {
                $ips[$count] = gethostbyname($uri[3]);
                $count++;
            }
        }        
    }
*/
    return $ips;
}


function  opensim_get_servers_name(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    $nms = array();

    $db->query("SELECT DISTINCT serverURI FROM regions");
    if ($db->Errno==0) {
        $count = 0;
        while (list($server) = $db->next_record()) {
            $uri = preg_split("/[:\/]/", $server);
            if (array_key_exists(3, $uri)) {
                $nms[$count] = $uri[3];
                $count++;
            }
        }        
    }

    return $nms;
}


function  opensim_get_server_info($uuid, &$db=null)
{
    if (!isGUID($uuid)) return null;
    if (!is_object($db)) $db = opensim_new_db();

    $ret = array();

    $sql = "SELECT serverIP,serverHttpPort,serverURI,regionSecret FROM GridUser ";
    $sql.= "INNER JOIN regions ON regions.uuid=GridUser.LastRegionID WHERE GridUser.UserID='".$uuid."'";
    $db->query($sql);
    if ($db->Errno==0) list($serverip, $httpport, $serveruri, $secret) = $db->next_record();

    if ($db->Errno==0) {
        $ret["serverIP"]       = $serverip;
        $ret["serverHttpPort"] = $httpport;
        $ret["serverURI"]      = $serveruri;
        $ret["regionSecret"]   = $secret;
        //
        $uri = preg_split("/[:\/]/", $serveruri);
        if (array_key_exists(3, $uri)) {
            $ret['serverName'] = $uri[3];
//            $ret["serverIP2"]  = gethostbyname($uri[3]);
        }
    }
    return $ret;
}


//
// DNSが引けないと長時間待たされる
//
function  opensim_is_access_from_region_server()
{
    /////////////////////////
    return true;
    /////////////////////////

    $ip_match = false;
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    $server_addr = $_SERVER['SERVER_ADDR'];

    if ($remote_addr==$server_addr or $remote_addr=="127.0.0.1") return true;

    $ips = opensim_get_servers_ip();

    foreach($ips as $ip) {
        if ($ip==$remote_addr) {
            $ip_match = true;
            break;
        }
    }

    return $ip_match;
}


//
function  opensim_check_secure_session($uuid, $regionid, $secure, &$db=null)
{
    if (!isGUID($uuid) or !isGUID($secure)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    if ($db->exist_table('Presence')) {    
        $sql = "SELECT UserID FROM Presence WHERE UserID='".$uuid."' AND SecureSessionID='".$secure."'";
        if (isGUID($regionid)) $sql = $sql." AND RegionID='".$regionid."'";
    }
    // Standalone
    else {
        $sql = "SELECT UserID FROM GridUser WHERE UserID='".$uuid."' AND Online='True'";
        if (isGUID($regionid)) $sql = $sql." AND LastRegionID='".$regionid."'";
    }

    $db->query($sql);
    if ($db->Errno!=0) return false;

    list($UUID) = $db->next_record();
    if ($UUID!=$uuid) return false;
    return true;
}


//
function  opensim_check_region_secret($uuid, $secret, &$db=null)
{
    if (!isGUID($uuid)) return false;
    if (!is_object($db)) $db = opensim_new_db();

    //
    $sql = "SELECT UUID FROM regions WHERE UUID='".$uuid."' AND regionSecret='".$db->escape($secret)."'";
    $db->query($sql);
    if ($db->Errno==0) {
        list($UUID) = $db->next_record();
        if ($UUID==$uuid) return true;
    }

    return false;
}




/////////////////////////////////////////////////////////////////////////////////////
//
// Management of System
//

function  opensim_clear_login_table(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    if ($db->exist_table('Presence')) {    
        $db->query('DELETE FROM Presence');
    }

    // Standalone    
    else {
        $userids = array();
        $db->query("SELECT UserID FROM GridUser WHERE Online='True'"); 
        while (list($uid) = $db->next_record()) {
            $userids[] = $uid;
        }
        //
        foreach($userids as $userid) {
            $db->query("UPDATE GridUser SET Online='False' WHERE UserID='". $userid."'");
        }
    }        

    return true;
}


function  opensim_cleanup_db(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();

    opensim_del_currency_expired($db);
    opensim_del_terrainImages($db);

    return;
}


function  opensim_del_terrainImage($uuid, &$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    if (!isGuid($uuid)) return false;

    $ret = false;

    $query = "SELECT id,name FROM assets WHERE CreatorID='".$uuid."'";
    $db->query($query);
    if ($db->Errno==0) {
        $db2 = opensim_new_db();
        while (list($tex_id, $name) = $db->next_record()) {
            if (isGuid($tex_id) and ($name=="terrainImage_".$uuid or $name=="parcelImage_".$uuid)) {
                $del_query = "DELETE FROM assets WHERE id='".$tex_id."'";
                $db2->query($del_query);
                echo $del_query."<br />";    
                $ret = true;
            }
           }
    }

    return $ret;
}


function  opensim_del_terrainImages(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();
    $uuids = opensim_get_regions_uuid(false, $db);

    foreach($uuids as $uuid) {
        echo "checking.... ".$uuid."<br />";
        if (isGuid($uuid)) {
            $ret = opensim_del_terrainImage($uuid, $db);
           }
    }
}


//
// for TEST
//
function  opensim_debug_command(&$db=null)
{
    if (!is_object($db)) $db = opensim_new_db();


    //echo "Set your Debug Command at opensim_debug_command() in opensim.mysql.php <br />";

/*
    $db->query('SELECT name,assetType,id,asset_flags FROM assets');
    
    while (list($name,$type,$id,$flags) = $db->next_record()) {
        echo $name." ".$type." ".$id." ".$flags."<br />";
    }
*/
}

