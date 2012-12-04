<?php
/*

@package fbLogin

First Released: February 20th, 2012
Author: Joe Molloy <hyper-typer.com>
License: GNU GPLv2 (or later at your option)

fbLogin is a MODX extra which extends Shaun McCormack's Login extra 
to enable users to register and login to a site using their Facebook 
account via the Facebook API using Version 3.0 of their PHP SDK.

Script Name: modxFacebook.php

*/
if(!function_exists('parse_signed_request')){
function parse_signed_request($signed_request, $secret) {
  		list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
		// decode the data
  		$sig = base64_url_decode($encoded_sig);
  		$data = json_decode(base64_url_decode($payload), true);
		if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    		error_log('Unknown algorithm. Expected HMAC-SHA256');
    		return null;
  		}
		// check sig
  		$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  		if ($sig !== $expected_sig) {
    		error_log('Bad Signed JSON signature!');
    		return null;
  		}
		return $data;
	}
}

if(!function_exists('base64_url_decode')){
	function base64_url_decode($input) {
  		return base64_decode(strtr($input, '-_', '+/'));
	}
}

require_once 'libs/facebook.php';
$appId= $modx->getOption('facebook_app_id');
$secret= $modx->getOption('facebook_app_secret');
if(empty($appId) || empty($secret)){
$output='No AppID or Secret Provided, please obtain from developer.facebook.com';
return $output;
}
$par = array();
$facebook = new Facebook(array(
  'appId' => $appId,
  'secret' => $secret,
  'cookie' => true,
));
$user = $facebook->getUser();
?>