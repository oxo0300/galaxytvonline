<?php
/*
@package fbLogin

First Released: February 20th, 2012
Author: Joe Molloy <hyper-typer.com>
License: GNU GPLv2 (or later at your option)

fbLogin is a MODX extra which extends Shaun McCormack's Login extra 
to enable users to register and login to a site using their Facebook 
account via the Facebook API using Version 3.0 of their PHP SDK.

Snippet Name: fbRedirect

This snippet does the actual redirect to Facebook for users who are not 
registered yet, logged out or who have changed their Facebook password, 
had their access token expire or who wish to re-authorise your site. 
The installer places it on a publically accessible hidden resource with 
the template set to 'none' with an alias 'fbr'.

*/
require_once $modx->getOption('core_path').'components/fbLogin/modxFacebook.php';
$fbc = $modx->getObject('modResource',array('alias'=>'fbc'));
$returnUrlId = $fbc->get('id');
if(empty($returnUrlId)){
die('<b>Message from fbLogin - fbRedirect Snippet:</b><br/>We can not locate the URL on your site to return to after a user has taken an action on Facebook as the &returnUrlId parameter in the call to the fbRedirect snippet - this will be the ID of the page you have placed the fbRefresh snipppet in');
}
$perms = $modx->getOption('facebook_user_perms',$scriptProperties,'email');

$returnURL = $modx->makeURL($returnUrlId,'','','full');
$par['redirect_uri'] = $returnURL;
$par['scope'] = $perms;
$loginURL = $facebook->getLoginURL($par);

$modx->sendRedirect($loginURL);