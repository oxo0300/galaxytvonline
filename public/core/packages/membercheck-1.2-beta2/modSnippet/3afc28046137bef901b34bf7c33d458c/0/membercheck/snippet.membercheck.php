<?php
#::::::::::::::::::::::::::::::::::::::::
# Snippet name: MemberCheck
# Short Desc: checks logged in groups and displays a chunk
# Version: 1.1
# Created By Ryan Thrash (vertexworks.com)
# Sanitized By Jason Coward (opengeek.com)
# Addition Of &default Param By Jason W. Falk (jason@falkicon.com)
#
# Date: April 03, 2007
#
# Changelog:
# Nov 29, 05 -- initial release
# Jul 13, 06 -- adjusted Singleton to work under PHP4, added placeholder code (by: garryn)
# Apr 02, 07 -- added &default peram code (by: Jason W. Falk (Whitefen))
#
#::::::::::::::::::::::::::::::::::::::::
# Description:
#   Checks to see if users belong to a certain group and
#   displays the specified chunk if they do. Performs several
#   sanity checks and allows to be used multiple times on a page.
#
# Params:
#   &groups [array] (REQUIRED)
#       array of webuser group-names to check against
#
#   &chunk [string] (REQUIRED)
#       name of the chunk to use if passes the check
#
#   &default [string] (optional)
#       name of the chunk to use if no webuser group-names match
#
#   &ph [string] (optional)
#       name of the placeholder to set instead of directly retuning chunk
#
#   &debug [boolean] (optional | false)
#       turn on debug mode for extra troubleshooting
#
# Example Usage:
#
#   [[MemberCheck? &groups=`siteadmin, registered users` &chunk=`privateSiteNav` &default=`publicSiteNav` &ph=`MemberMenu` &debug=`true`]]
#
#   This would place the 'members-only' navigation store in the chunk 'privateSiteNav'
#   into a placeholder (called 'MemberMenu'). It will only do this as long as the user
#   is logged in as a webuser and is a member of the 'siteadmin' or the 'registered users'
#   groups. Otherwise, it will place the default chunk 'publicSiteNav' into the 'MemberMenu'
#   placeholder. The optional debug parameter can be used to display informative error messages
#   when configuring this snippet for your site. For example, if the developer had
#   mistakenly typed 'siteowners' for the first group, and none existed with debug mode on,
#   it would have returned the error message: The group siteowners could not be found....
#
#::::::::::::::::::::::::::::::::::::::::

/* check if inside manager */
if (!is_object($modx->context) || ($modx->context->get('key') === 'mgr')) {
    return ''; /* don't go any further when inside manager */
}

if (empty($groups)) {
    return $debug ? '<p>Error: No Group Specified</p>' : '';
}

if (empty($chunk)) {
    return $debug ? '<p>Error: No Chunk Specified</p>' : '';
}

/* turn comma-delimited list of groups into an array */
$groups = explode(',', $groups);

if (!class_exists('MemberCheck')) {
    $path = $modx->getOption('core_path').'components/membercheck/';
    $modx->loadClass('membercheck',$path,true,true);
}
$memberCheck = new MemberCheck($modx,$scriptProperties);

if (empty($ph)) {
    return $memberCheck->getMemberChunk($groups, $chunk);
} else {
    $modx->setPlaceholder($ph, $memberCheck->getMemberChunk($groups, $chunk));
    return '';
}