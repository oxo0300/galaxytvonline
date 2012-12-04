<?php
/**
 * Login
 *
 * Copyright 2010 by Jason Coward <jason@modxcms.com> and Shaun McCormick
 * <shaun@modxcms.com>
 *
 * Login is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * Login is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Login; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package login
 */
/**
 * Handle register form
 *
 * @package login
 * @subpackage processors
 */
/* get rid of spam fields, submitVar field */
unset($fields['nospam'],$fields['blank']);
if (!empty($submitVar)) unset($fields[$submitVar]);

/* create user and profile */
$user = $modx->newObject('modUser');
$profile = $modx->newObject('modUserProfile');

/* set extended data if any */
if ($modx->getOption('useExtended',$scriptProperties,true)) {
    /* first cut out regular and unwanted fields */
    $excludeExtended = $modx->getOption('excludeExtended',$scriptProperties,'');
    $excludeExtended = explode(',',$excludeExtended);
    $profileFields = $profile->toArray();
    $userFields = $user->toArray();
    $extended = array();
    foreach ($fields as $field => $value) {
        if (!isset($profileFields[$field]) && !isset($userFields[$field]) && $field != 'password_confirm' && $field != 'passwordconfirm' && !in_array($field,$excludeExtended)) {
            $extended[$field] = $value;
        }
    }
    /* now set extended data */
    $profile->set('extended',$extended);
}

/* allow overriding of class key */
if (empty($fields['class_key'])) $fields['class_key'] = 'modUser';

/* set user and profile */
$user->fromArray($fields);
$user->set('username',$fields[$usernameField]);
$user->set('active',0);
$user->set('password',md5($fields['password']));
$profile->fromArray($fields);
$profile->set('internalKey',0);
$user->addOne($profile,'Profile');

/* if usergroups set */
$usergroups = $modx->getOption('usergroups',$scriptProperties,'');
if (!empty($usergroups)) {
    $usergroups = explode(',',$usergroups);

    foreach ($usergroups as $usergroupMeta) {
        $usergroupMeta = explode(':',$usergroupMeta);
        if (empty($usergroupMeta[0])) continue;

        /* get usergroup */
        $pk = array();
        $pk[intval($usergroupMeta[0]) > 0 ? 'id' : 'name'] = $usergroupMeta[0];
        $usergroup = $modx->getObject('modUserGroup',$pk);
        if (!$usergroup) continue;

        /* get role */
        $rolePk = !empty($usergroupMeta[1]) ? $usergroupMeta[1] : 'Member';
        $role = $modx->getObject('modUserGroupRole',array('name' => $rolePk));

        /* create membership */
        $member = $modx->newObject('modUserGroupMember');
        $member->set('member',0);
        $member->set('user_group',$usergroup->get('id'));
        if (!empty($role)) {
            $member->set('role',$role->get('id'));
        } else {
            $member->set('role',1);
        }
        $user->addMany($member,'UserGroupMembers');
    }
}

/* save user */
if (!$user->save()) {
    $modx->log(modX::LOG_LEVEL_ERROR,'[Login] Could not save newly registered user: '.$user->get('id').' with username: '.$user->get('username'));
    return $modx->lexicon('register.user_err_save');
}

/* setup persisting parameters */
$persistParams = $modx->getOption('persistParams',$scriptProperties,'');
if (!empty($persistParams)) $persistParams = $modx->fromJSON($persistParams);
if (empty($persistParams) || !is_array($persistParams)) $persistParams = array();

/* send activation email (if chosen) */
$email = $user->get('email');
$activation = $modx->getOption('activation',$scriptProperties,true);
$activateResourceId = $modx->getOption('activationResourceId',$scriptProperties,'');
if ($activation && !empty($email) && !empty($activateResourceId) && empty($fields['register.moderate'])) {
    /* generate a password and encode it and the username into the url */
    $pword = $login->generatePassword();
    $confirmParams['lp'] = urlencode(base64_encode($pword));
    $confirmParams['lu'] = urlencode(base64_encode($user->get('username')));
    $confirmParams = array_merge($persistParams,$confirmParams);

    /* if using redirectBack param, set here to allow dynamic redirection
     * handling from other forms.
     */
    $redirectBack = $modx->getOption('redirectBack',$_REQUEST,$modx->getOption('redirectBack',$scriptProperties,''));
    if (!empty($redirectBack)) {
        $confirmParams['redirectBack'] = $redirectBack;
    }
    $redirectBackParams = $modx->getOption('redirectBackParams',$_REQUEST,$modx->getOption('redirectBackParams',$scriptProperties,''));
    if (!empty($redirectBackParams)) {
        $confirmParams['redirectBackParams'] = $redirectBackParams;
    }

    /* generate confirmation url */
    $confirmUrl = $modx->makeUrl($activateResourceId,'',$confirmParams,'full');

    /* set confirmation email properties */
    $emailTpl = $modx->getOption('activationEmailTpl',$scriptProperties,'lgnActivateEmail');
    $emailTplType = $modx->getOption('activationEmailTplType',$scriptProperties,'modChunk');
    $emailProperties = $user->toArray();
    $emailProperties['confirmUrl'] = $confirmUrl;
    $emailProperties['tpl'] = $emailTpl;
    $emailProperties['tplType'] = $emailTplType;
    $emailProperties['password'] = $fields['password'];

    /* now set new password to registry to prevent middleman attacks.
     * Will read from the registry on the confirmation page. */

    $modx->getService('registry', 'registry.modRegistry');
    $modx->registry->addRegister('login','registry.modFileRegister');
    $modx->registry->login->connect();
    $modx->registry->login->subscribe('/useractivation/');
    $modx->registry->login->send('/useractivation/',array($user->get('username') => $pword),array(
        'ttl' => ($modx->getOption('activationttl',$scriptProperties,180)*60),
    ));
    /* set cachepwd here to prevent re-registration of inactive users */
    $user->set('cachepwd',md5($pword));
    if (!$user->save()) {
        $modx->log(modX::LOG_LEVEL_ERROR,'[Login] Could not update cachepwd for activation for User: '.$user->get('username'));
    }

    /* send either to user's email or a specified activation email */
    $activationEmail = !empty($scriptProperties['activationEmail']) ? $scriptProperties['activationEmail'] : $user->get('email');
    $subject = $modx->getOption('activationEmailSubject',$scriptProperties,$modx->lexicon('register.activation_email_subject'));
    $login->sendEmail($activationEmail,$user->get('username'),$subject,$emailProperties);

} else if (empty($fields['register.moderate'])) {
    $user->set('active',1);
    $user->save();
}


/* do post-register hooks */
$postHooks = $modx->getOption('postHooks',$scriptProperties,'');
$login->loadHooks('posthooks');
$fields['register.user'] = &$user;
$fields['register.profile'] =& $profile;
$fields['register.usergroups'] = $usergroups;
$login->posthooks->loadMultiple($postHooks,$fields);

/* process hooks */
if (!empty($login->posthooks->errors)) {
    $errors = array();
    foreach ($login->posthooks->errors as $key => $error) {
        $errors[$key] = str_replace('[[+error]]',$error,$errTpl);
    }
    $modx->toPlaceholders($errors,'error');

    $errorMsg = $login->posthooks->getErrorMessage();
    $modx->toPlaceholder('message',$errorMsg,'error');
}

/* if a prehook set the user as moderated, if set, send to an optional other
 * moderation resource id
 */
if (!empty($fields['register.moderate'])) {
    $moderatedResourceId = $modx->getOption('moderatedResourceId',$scriptProperties,'');
    if (!empty($moderatedResourceId)) {
        $persistParams = array_merge($persistParams,array(
            'username' => $user->get('username'),
            'email' => $profile->get('email'),
        ));
        $url = $modx->makeUrl($moderatedResourceId,'',$persistParams,'full');
        $modx->sendRedirect($url);
        return true;
    }
}

/* if provided a redirect id, will redirect to that resource, with the
 * GET params `username` and `email` for you to use */
$submittedResourceId = $modx->getOption('submittedResourceId',$scriptProperties,'');
if (!empty($submittedResourceId)) {
    $persistParams = array_merge($persistParams,array(
        'username' => $user->get('username'),
        'email' => $profile->get('email'),
    ));
    $url = $modx->makeUrl($submittedResourceId,'',$persistParams,'full');
    $modx->sendRedirect($url);
} else {
    $successMsg = $modx->getOption('successMsg',$scriptProperties,'');
    $modx->toPlaceholder('error.message',$successMsg);
}

return true;
