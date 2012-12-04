<?php
/*
@package fbLogin

First Released: February 20th, 2012
Author: Joe Molloy <hyper-typer.com>
License: GNU GPLv2 (or later at your option)

fbLogin is a MODX extra which extends Shaun McCormack's Login extra 
to enable users to register and login to a site using their Facebook 
account via the Facebook API using Version 3.0 of their PHP SDK.

Snippet Name: fbDe-authorised

This snippet has no parameters - it is placed in a hidden resource we have. 
 added with the alias 'fbd'. It simply captures and decodes the Facebook 
 user id sent and deactivates the corresponding MODX account.  We deactivate 
rather than remove the account as the user may chose to reactivate their 
account in the future and we may want therefore to persist associated data.

*/

require_once $modx->getOption('core_path').'components/fbLogin/modxFacebook.php';

if(!empty($_REQUEST['signed_request'])){
    require_once $modx->getOption('core_path').'components/fbLogin/modxFacebook.php';
    $signed_request = $_REQUEST['signed_request'];
	
$data = parse_signed_request($signed_request, $secret);
	$user_id = $data['user_id'];

	$moduser = $modx->getObject('modUser',  array('remote_key:=' => $user_id));
$moduser->set('active',0);
	$moduser->save();


}
else
{
	$modx->sendRedirect($modx->getOption('site_url'));
}