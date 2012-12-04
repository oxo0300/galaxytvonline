<?php
/*
@package fbLogin

First Released: February 20th, 2012
Author: Joe Molloy <hyper-typer.com>
License: GNU GPLv2 (or later at your option)

fbLogin is a MODX extra which extends Shaun McCormack's Login extra 
to enable users to register and login to a site using their Facebook 
account via the Facebook API using Version 3.0 of their PHP SDK.

Snippet Name: fbLogin

This is the main snippet in the package.  It has the following roles:

For users who have not yet registered or logged in:
1. Outputs the link to your resource with the fbRedirect snippet and 
'Login to Facebook' button for unregistered users and those who have 
not yet logged in.
2. Captures the response from Facebook and if necessary adds new users 
which optionally can be added to one or more user groups.
3. Automatically logs in new and returning Facebook users
4. Optionally redirects new users to a resource where they can complete 
their MODX profile.
 


*/

require_once $modx->getOption('core_path').'components/fbLogin/modxFacebook.php';
$output = '';
$contexts = empty($contexts) ? array($modx->context->get('key')) : explode(',', $contexts);
if ($modx->user->hasSessionContext($modx->context->get('key')) ){
	if($_GET['service'] == 'logout'){
		$facebook->destroySession();
	}
	$modUser = $modx->user;
	$modUserId = $modUser->get('id');
	$loginResourceId = $modx->getOption('fbLogin_login_resource_id',$scriptProperties,'');
	if(empty($loginResourceId)){
		die('<b>Message from fbLogin - fbLogin Snippet:</b><br/>You must specify the ID of the URL you will be using to log MODX users out.');
	}
	$fbDisplayLoggedinTpl = $modx->getOption('fbLogin_display_loggedin_tpl',$scriptProperties,1);
	$fbLoggedinTpl = $modx->getOption('fbLoggedinTpl',$scriptProperties,'fbLoggedinTpl');
	$perms = $modx->getOption('perms',$scriptProperties,'email');
	$par['scope'] = $perms;
	$output.="";
	if($user)
	{
		$me = NULL;
		try{	
			$me = $facebook->api('/me');
		}
		catch(FacebookApiException $e){
			$loginResource = $modx->makeURL($loginResourceId,'','','full');
			$par['next'] = $loginResource.'?service=logout';
			$logoutURL = $facebook->getLogoutUrl($par);
			$modx->sendRedirect($logoutURL);
		}
		if($me)
		{
			if($modUserId != 0){
				$fbUser = $modx->getObject('modUser',  array('remote_key:=' => $me['id'], 'remote_key:!=' => null));
				$fbUserId = $fbUser->get('id');
				if($fbUserId == $modUserId){
					$modx->toPlaceholder('fbUser',$user);
					$modx->toPlaceholder('fbAppId',$appId);
					$modx->toPlaceholder('fbFullname',$me['name']);
					$modx->toPlaceholder('fbEmail',$me['email']);
					$modx->toPlaceholder('fbFirstname',$me['remote_data']['first_name']);
					$modx->toPlaceholder('fbProfileImg','//graph.facebook.com/'.$user.'/picture?type=square');
					$modx->toPlaceholder('fbLogoutUrlId',$loginResourceId);
					$modx->toPlaceholder('fbCancelUrlId',$cancelResourceId);
					$modx->toPlaceholder('fbAccountUrlId',$accoutUrlId);
					
					if($fbDisplayLoggedinTpl != 0){
						$output .= $modx->getChunk($fbLoggedinTpl);
					}
				}
			}
		}
	}
}else{
	$cancelResourceId = $modx->getOption('fbLogin_cancel_resource_id',$scriptProperties,'');
	if(empty($cancelResourceId)){
		die('<b>Message from fbLogin - fbLogin Snippet:</b><br/>You must specify the ID of the URL you wish to have a user redirected to if they click the 	cancel button in a Facebook dialog, usually the login page.');
	}
	if(!empty($_GET['error'])){
		$cancelResource = $modx->makeURL($cancelResourceId,'','','full');
		$modx->sendRedirect($cancelResource);
	}
	else
	{
		$fbr = $modx->getObject('modResource',array('alias'=>'fbr'));
		$redirectResourceId = $fbr->get('id');
		if(empty($redirectResourceId)){
			die('<b>Message from fbLogin - fbLogin snippet:</b><br/>We can not find a URL for the resource that does the redirect 
			to Facebook - this hidden resource should have been added with the alias \'fbr\' by the installer during setup.'
			);
		}
		$accountResourceId = $modx->getOption('fbLogin_account_resource_id',$scriptProperties,'');
		if(empty($accountResourceId)){
			die('<b>Message from fbLogin - fbLogin snippet:</b><br/>We could not find the ID of the page to redirect to when a user has logged in the fbLogin snippet
			- this should have been set via the \'fbLogin_account_resource_id\' system setting during installation'
			);
		}
		$fbLoginTpl = $modx->getOption('fbLoginTpl',$scriptProperties,'fbLoginTpl');
		$perms = $modx->getOption('facebook_user_perms',$scriptProperties,'email');
		$fbLoginImg = $modx->getOption('fbLoginImg',$scriptProperties,'//static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif');
		$fbLoginTitle = $modx->getOption('fbLoginTitle',$scriptProperties,'Click here to register/log in with Facebook');
		$fristloginResourceId = $modx->getOption('fbLogin_firstlogin_resource_id',$scriptProperties,$postLoginUrlId);
		$par['scope'] = $perms;
		$newuser = false;
		if ($user) {
			$uid = $user;
			$me = NULL;
			try{	
				$me = $facebook->api('/me');
			}
			catch(FacebookApiException $e){
				$phs = array();
				$phs['fbLoginTitle'] = $fbLoginTitle;
				$phs['fbRedirectUrl'] = $modx->makeURL($redirectResourceId,'','','full');
				$phs['fbLoginImg'] = $fbLoginImg;
  				$output .= $modx->getChunk($fbLoginTpl,$phs);
				return $output;
			}
		}
		if($me != NULL){
			foreach (array_keys($contexts) as $ctxKey) {
					$contexts[$ctxKey] = trim($contexts[$ctxKey]);
			}
 			$moduser = $modx->getObject('modUser',  array('remote_key:=' => $user, 'remote_key:!=' => null));
 			if(empty($moduser)){
				$newuser = true;
				$homet = '';
				if(!empty($me['location']['name'])){
					$hometownAr = explode(',',$me['location']['name']);
					$homet = $hometownAr[0];
				}
 				$moduser = $modx->newObject('modUser');
				$moduser->fromArray(
                	array('username' => $me['name'],'active' => true
		                			,'remote_key' => $me['id'] ,'remote_data' => $me 
		        ));
 				$profile = $modx->newObject('modUserProfile');
				$profile->fromArray(
					array(
							'email' => isset($me['email']) ? $me['email'] : 'facebook-user@facebook.com'
							,'fullname' => $me['name']
							,'city' => $homet
                					,'photo'=> 'http://graph.facebook.com/'. $me['id'] .'/picture'
				));
				$moduser->addOne($profile, 'Profile');
 				$usergroups = $modx->getOption('fbLogin_usergroups',$scriptProperties,'');
				if (!empty($usergroups)) {
		    		$usergroups = explode(',',$usergroups);
					foreach ($usergroups as $usergroupMeta) {
						$usergroupMeta = trim($usergroupMeta);
						$usergroupMeta = explode(':',$usergroupMeta);
						if (empty($usergroupMeta[0])) continue;
 						$pk = array();
						$pk[intval($usergroupMeta[0]) > 0 ? 'id' : 'name'] = $usergroupMeta[0];
						$usergroup = $modx->getObject('modUserGroup',$pk);
						if (!$usergroup) continue;
 						$rolePk = !empty($usergroupMeta[1]) ? $usergroupMeta[1] : 'Member';
						$role = $modx->getObject('modUserGroupRole',array('name' => $rolePk));
 						$member = $modx->newObject('modUserGroupMember');
						$member->set('member',0);
						$member->set('user_group',$usergroup->get('id'));
						if (!empty($role)) {
			    			$member->set('role',$role->get('id'));
						} else {
			    			$member->set('role',1);
						}
						$moduser->addMany($member,'UserGroupMembers');
		    		}
				}
				$saved = $moduser->save();
			}
   			if($moduser->get('active') == 0 && stristr($_SERVER['REQUEST_URI'],'fbc') != false){
				$moduser->set('active',1);
				$moduser->save();
			}
			if(!$moduser->hasSessionContext('web')){
				if(stristr($_SERVER['REQUEST_URI'],'fbc') != FALSE){
					foreach ($contexts as $context) {
						$moduser->addSessionContext($context);
					}
					if(!$newuser){
						$url = $modx->makeURL($accountResourceId,'','','full');
					}
					else
					{
						$url = $modx->makeURL($firstloginResourceId,'','','full');
					}
				}
			}
			$modx->sendRedirect($url);
		}
		if(stristr($_SERVER['REQUEST_URI'],'fbc') == FALSE){ 
			$modx->setPlaceholder('fbLoginTitle',$fbLoginTitle);
			$modx->setPlaceholder('fbRedirectUrlId',$redirectResourceId);
			$modx->setPlaceholder('fbLoginImg',$fbLoginImg);
  			$modx->setPlaceholder('fbLoginUrlId',$loginResourceId);
			$modx->setPlaceholder('fbCancelUrlId',$cancelResourceId);
  			$output .= $modx->getChunk($fbLoginTpl);
		}
		else {
			$modx->sendRedirect($modx->makeURL($accountResourceId,'','','full'));
		}
	}
}
?>