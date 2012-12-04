<?php
/*
@package fbLogin

First Released: February 20th, 2012
Author: Joe Molloy <hyper-typer.com>
License: GNU GPLv2 (or later at your option)

fbLogin is a MODX extra which extends Shaun McCormack's Login extra 
to enable users to register and login to a site using their Facebook 
account via the Facebook API using Version 3.0 of their PHP SDK.

Snippet Name: checkForActive

This snippet should be placed on all protected pages where a registered 
Facebook user has access.  It is needed as a user may de-authorise our app
while logged in and therefore they need to be logged out immediately when 
they attempt to access a protected page - being deactivated only would 
prevent them logging back in after logging out. 


*/

$logoutUrlId = $modx->getOption('fbLogin_login_resource_id',$scriptProperties,'');
if(empty($logoutUrlId)){
die('<b>Message from checkForActive:</b> You must specify the ID of the dedicated resource you have set up for signing users in via the &logoutUrlId parameter');
}
$moduser = $modx->user;
$status = $moduser->get('active');
if($status == 0)
{
$logouturl = $modx->makeURL($logoutUrlId,'','','full');
$modx->sendRedirect($logouturl.'?service=logout');
}
?>