<?php
# 
#  Copyright (c)Melanie Thielker and Teravus Ovares (http://opensimulator.org/)
# 
#  Redistribution and use in source and binary forms, with or without
#  modification, are permitted provided that the following conditions are met:
#	  * Redistributions of source code must retain the above copyright
#		notice, this list of conditions and the following disclaimer.
#	  * Redistributions in binary form must reproduce the above copyright
#		notice, this list of conditions and the following disclaimer in the
#		documentation and/or other materials provided with the distribution.
#	  * Neither the name of the OpenSim Project nor the
#		names of its contributors may be used to endorse or promote products
#		derived FROM this software without specific prior written permission.
# 
#  THIS SOFTWARE IS PROVIDED BY THE DEVELOPERS ``AS IS'' AND ANY
#  EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
#  WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
#  DISCLAIMED. IN NO EVENT SHALL THE CONTRIBUTORS BE LIABLE FOR ANY
#  DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
#  (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
#  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
#  ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
#  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
#  SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
# 

if (!defined('ENV_READ_CONFIG')) require_once(realpath(dirname(__FILE__).'/../include/config.php'));
if (!defined('ENV_READ_DEFINE')) require_once(realpath(ENV_HELPER_PATH.'/../include/env_define.php'));

#
require_once(realpath(ENV_HELPER_PATH.'/../include/opensim.mysql.php'));
require_once(realpath(ENV_HELPER_PATH.'/../include/env_lib.php'));
require_once(realpath(ENV_HELPER_PATH.'/../jbxl/jbxl_tools.php'));


if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
#$request_xml = $HTTP_RAW_POST_DATA;
#error_log('helper.php: '.$request_xml);



####################################################################

#
# User provided interface routine to interface with payment processor
#

function  process_transaction($avatarID, $cost, $ipAddress)
{
	# Do Credit Card Processing here!  Return False if it fails!
	# Remember, $amount is stored without decimal places, however it's assumed
	# that the transaction amount is in Cents and has two decimal places
	# 5 dollars will be 500
	# 15 dollars will be 1500

	//if ($avatarID==CURRENCY_BANKER) return true;
	//return false;

	return true;
}



###################### No user serviceable parts below #####################

#
# Helper routines
#

function  convert_to_real($amount)
{
	/*
	if($currency == 0) return 0;

	$db = new DB(CURRENCY_DB_HOST, CURRENCY_DB_NAME, CURRENCY_DB_USER, CURRENCY_DB_PASS, CURRENCY_DB_MYSQLI);

	# Get the currency conversion ratio in USD Cents per Money Unit
	# Actually, it's whatever currency your credit card processor uses

	$db->query("SELECT CentsPerMoneyUnit FROM ".CURRENCY_MONEY_TBL." limit 1");
	list($CentsPerMoneyUnit) = $db->next_record();
	$db->close();

	if (!$CentsPerMoneyUnit) $CentsPerMoneyUnit = 0;
		
	# Multiply the cents per unit times the requested amount

	$real = $CentsPerMoneyUnit * $currency;
	
	// Dealing in cents here. The XML requires an integer
	// so we have to ceil out any decimal places and cast as an integer

	$real = (integer)ceil($real);		

	return $real;
	*/

	$cost = $amount;

	return $cost;
}



////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
下記関数は現在のところ，アバターがログインしていないと使用できない

 function  user_alert($agentID, $message, $secureID=null)
 function  update_simulator_balance($agentID, $amount=-1, $secureID=null)
 function  add_money($agentID, $amount, $secureID=null) 
 function  get_balance($agentID, $secureID=null)
 function  move_money($srcID, $dstID, $amount, $type, $desc, $prminvent=0, $nxtowner=0, $ip='')
*/

//
// アバターがログインしていないと使用できない
//
function  user_alert($agentID, $message, $secureID=null)
{
	if (!USE_CURRENCY_SERVER) 	  return false;
	if (!isGUID($agentID)) 		  return false;
	if (!isGUID($secureID, true)) return false;

	// XML RPC to Region Server
	$results = opensim_get_userinfo($agentID);
	$server  = jbxl_make_url($results['simip'], 9000);
	if ($server['host']=='') return false;
	
	$results = opensim_get_avatar_session($agentID);		// use Presence Table
	if (!$results) return false;
	$sessionID = $results['sessionID'];
	if ($secureID==null) $secureID = $results['secureID'];

	$req 	  = array('clientUUID'=>$agentID, 'clientSessionID'=>$sessionID, 'clientSecureSessionID'=>$secureID, 'Description'=>$message); 
	$params   = array($req);
	$request  = xmlrpc_encode_request('UserAlert', $params);
	$response = do_call($server['url'], $server['port'], $request);

	if ($response!=null and array_key_exists('success', $response)) return $response['success'];
	return false;
}


//
// アバターがログインしていないと使用できない
//
function  update_simulator_balance($agentID, $amount=-1, $secureID=null)
{
	if (!USE_CURRENCY_SERVER) 	  return false;
	if (!isGUID($agentID)) 		  return false;
	if (!isGUID($secureID, true)) return false;

	if ($amount<0) {
		$amount = get_balance($agentID, $secureID);
		if ($amount<0) return false;
	}

	// XML RPC to Region Server
	$results = opensim_get_userinfo($agentID);
	$server  = jbxl_make_url($results['simip'], 9000);
	if ($server['host']=='') return false;

	$results = opensim_get_avatar_session($agentID);
	if (!$results) return false;
	$sessionID = $results['sessionID'];
	if ($secureID==null) $secureID = $results['secureID'];

	$req	  = array('clientUUID'=>$agentID, 'clientSessionID'=>$sessionID, 'clientSecureSessionID'=>$secureID, 'Balance'=>$amount);
	$params   = array($req);
	$request  = xmlrpc_encode_request('UpdateBalance', $params);
	$response = do_call($server['url'], $server['port'], $request);

	if ($response!=null and array_key_exists('success', $response)) return $response['success'];
	return false;
}


//
// アバターがログインしていないと使用できない
//
function  add_money($agentID, $amount, $secureID=null) 
{
	if (!USE_CURRENCY_SERVER) 	  return false;
	if (!isGUID($agentID)) 		  return false;
	if (!isGUID($secureID, true)) return false;

	// XML RPC to Region Server
	$results = opensim_get_userinfo($agentID);
	$server  = jbxl_make_url($results['simip'], 9000);
	if ($server['host']=='') return false;

	$results = opensim_get_avatar_session($agentID);
	$sessionID = $results['sessionID'];
	if ($secureID==null) $secureID = $results['secureID'];
	
	$req	  = array('clientUUID'=>$agentID, 'clientSessionID'=>$sessionID, 'clientSecureSessionID'=>$secureID, 'amount'=>$amount);
	$params   = array($req);
	$request  = xmlrpc_encode_request('AddBankerMoney', $params);
	$response = do_call($server['url'], $server['port'], $request);

	if ($response!=null and array_key_exists('success', $response)) return $response['success'];
	return false;
}


//
// アバターがログインしていないと使用できない
//
function  get_balance($agentID, $secureID=null)
{
	$cash = -1;
	if (!USE_CURRENCY_SERVER) 	  return (integer)$cash;
	if (!isGUID($agentID)) 		  return (integer)$cash;
	if (!isGUID($secureID, true)) return (integer)$cash;

	// XML RPC to Region Server
	$results = opensim_get_userinfo($agentID);
	$server  = jbxl_make_url($results['simip'], 9000);
	if ($server['host']=='') return (integer)$cash;

	$results = opensim_get_avatar_session($agentID);
	if ($sessionID=='')  return (integer)$cash;
	$sessionID = $results['sessionID'];
	if ($secureID==null) $secureID = $results['secureID'];
	
	$req	  = array('clientUUID'=>$agentID, 'clientSessionID'=>$sessionID, 'clientSecureSessionID'=>$secureID);
	$params   = array($req);
	$request  = xmlrpc_encode_request('GetBalance', $params);
	$response = do_call($server['url'], $server['port'], $request);

	if ($response!=null and array_key_exists('balance', $response)) $cash = $response['balance'];
	return (integer)$cash;
}



////////////////////////////////////////////////////////////////////////////////////////////////////////

//
// Send the money to avatar for bonus   by Milo
//
// XMLRPC による正式な手順による送金
// アバターが一度もログインしていない場合は，送金できない．
//
// $type: トランザクションのタイプ．デフォルトは 5003:ReferBonus
// $serverURI:  処理を行うリージョンサーバの URI （オフライン時対応）
// $secretCode: MoneyServer.ini に書かれた MoneyScriptAccessKey の値．
//
function  send_money($agentID, $amount, $type=5003, $serverURI=null, $secretCode=null)
{
	if (!USE_CURRENCY_SERVER) return false;
	if (!isGUID($agentID)) 	  return false;

	// XML RPC to Region Server
	$server['url'] = null;
	if ($serverURI!=null) $server = jbxl_make_url($serverURI, 9000);

	if ($server['url']==null) {
		$results = opensim_get_userinfo($agentID);
		$server  = jbxl_make_url($results['simip'], 9000);
	}
	if ($server['url']==null) return false;

	if ($secretCode!=null) {
		$secretCode = md5($secretCode.'_'.$server['host']);
	}
	else {
		$secretCode = get_confirm_value($server['host']);
	}

	$req 	  = array('agentUUID'=>$agentID, 'secretAccessCode'=>$secretCode, 'amount'=>$amount, 'type'=>$type);
	$params   = array($req);
	$request  = xmlrpc_encode_request('SendMoney', $params);
	$response = do_call($server['url'], $server['port'], $request);

	if ($response!=null and array_key_exists('success', $response)) return $response['success'];
	return false;
}


//
// Send the money to avatar for bonus   by Milo
//
// XMLRPC による正式な手順による送金
// アバターが一度もログインしていない場合は，送金できない．
//
// $serverURI:  処理を行うリージョンサーバの URI （オフライン時対応）
// $secretCode: MoneyServer.ini に書かれた MoneyScriptAccessKey の値．
//
function  move_money($fromID, $toID, $amount, $serverURI=null, $secretCode=null)
{
	if (!USE_CURRENCY_SERVER) return false;
	if (!isGUID($fromID)) 	  return false;
	if (!isGUID($toID))       return false;

	// XML RPC to Region Server
	$server['url'] = null;
	if ($serverURI!=null) $server = jbxl_make_url($serverURI, 9000);

	if ($server['url']==null) {
		$results = opensim_get_userinfo($fromID);
		$server  = jbxl_make_url($results['simip'], 9000);
	}
	if ($server['url']==null) return false;

	if ($secretCode!=null) {
		$secretCode = md5($secretCode.'_'.$server['host']);
	}
	else {
		$secretCode = get_confirm_value($server['host']);
	}

	$req 	  = array('fromUUID'=>$fromID, 'toUUID'=>$toID, 'secretAccessCode'=>$secretCode, 'amount'=>$amount);
	$params   = array($req);
	$request  = xmlrpc_encode_request('MoveMoney', $params);
	$response = do_call($server['url'], $server['port'], $request);

	if ($response!=null and array_key_exists('success', $response)) return $response['success'];
	return false;
}


/*
function  move_money($srcID, $dstID, $amount, $type, $desc, $prminvent=0, $nxtowner=0, $ip='')
{
	if (!USE_CURRENCY_SERVER) return false;

 	$ret = opensim_set_currency_transaction($srcID, $dstID, $amount, $type, 0, $desc);
	if ($ret) {
		if (isGUID($srcID) and $srcID!='00000000-0000-0000-0000-0000000000000') {
			opensim_set_currency_balance($srcID, -$amount);
		}

		if (isGUID($dstID) and $dstID !='00000000-0000-0000-0000-0000000000000') {
			opensim_set_currency_balance($dstID, $amount);
		}
	}

	return $ret;
}
*/



////////////////////////////////////////////////////////////////////////////////////////////////////////

// XML RPC
function  do_call($uri, $port, $request)
{
	$server = jbxl_make_url($uri, $port);

	$header[] = 'Content-type: text/xml';
	$header[] = 'Content-length: '.strlen($request);
	
	$ch = curl_init();   
	curl_setopt($ch, CURLOPT_URL, $server['url']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 3);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

	$data = curl_exec($ch);	   
	if (!curl_errno($ch)) curl_close($ch);

	$ret = false;
	if ($data) $ret = xmlrpc_decode($data);

	// for Debug
	/*
	ob_start();
	print_r($ret);
	$rt = ob_get_contents();
	ob_end_clean();
	error_log('[do_call] responce = '.$rt);
	*/

	return $ret;
}


function  get_confirm_value($ipAddress)
{
	$key = env_get_config('currency_script_key');
	if ($key=='') $key = '123456789';
	$confirmvalue = md5($key.'_'.$ipAddress);

	return $confirmvalue;
}
