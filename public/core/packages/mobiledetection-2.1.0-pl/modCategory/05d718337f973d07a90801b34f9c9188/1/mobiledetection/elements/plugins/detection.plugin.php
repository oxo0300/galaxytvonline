<?php
/*------------------------------------------------------------------------------
 Mobile Detection - plugin for MODx Revolution 2.1.0-pl
--------------------------------------------------------------------------------
Version 2.1.0-pl by Zuriel Andrusyshyn

Code based on plugin originally posted by Peter Hoeflehner
Plugin originally created for Modx EVO by everettg_99 and noahlearner 

Inspiration from this forum thread:
http://modxcms.com/forums/index.php/topic,40357.0.html

DESCRIPTION:
This plugin combines browser detection and a URL-parameter override to 
show/hide portions of any template delineated by <mobile> and <standard> tags. 

REQUIREMENTS and EXAMPLES:
For this to have any effect, you must delineate one or more portions of your 
template(s) with <mobile> and <standard> tags, e.g. 

Template Example A:
<html>
	<head>
		<title>[[*pagetitle]]</title>
		<meta name=description content="[[*description]]" />
		<mobile>
			<link type="text/css" rel="stylesheet" href="mobile.css" />
		</mobile>
		<standard>
			<link type="text/css" rel="stylesheet" href="standard_one.css" />
			<link type="text/css" rel="stylesheet" href="standard_two.css" />
			<script type="text/javascript" src="menu.js"></script>
		</standard>
	</head>
<mobile>
	<body class="narrow">
</mobile>	
<standard>
	<body class="huge">
</standard>

	[[*content]]
	</body>
</html>

OR

Template Example B:
<mobile>[[$my_mobile_template]]</mobile>
<standard>[[$my_standard_template]]</standard>


USAGE:
Without modifications, the user's browser is detected *once* and a cookie is set
to store the value; if a mobile browser is detected, <standard> portions of 
the template will be deleted, leaving only <mobile> portions.
URL parameters can override the results of the browser detection, e.g.:

	http://www.yoursite.com/some/page?browser=mobile

	http://www.yoursite.com/some/page?browser=standard

	http://www.yoursite.com/some/page?browser=detect

"browser=mobile" will cause all portions of the template wrapped with <standard>
tags to be deleted. 

"browser=standard" will cause all <mobile> nodes to be deleted. 

"browser=detect" triggers browser detection and clears the cookie.  Whatever the 
result of browser detection will cause the respective nodes to be preserved.


CONFIGURATION:

Use Cookie:  default is yes. Normal use (i.e. use cookie = yes) is that browser 
detection is run only ONCE per visitor, and the result is stored in the cookie.
If the user chooses to override the template, this can be done via the URLs, e.g.
mydomain.com/?browser=mobile.  If cookies are disabled, then the browser detection is run for each page request
for each user.

force_browser_detect_variable: The name of the parameter that will trigger the overrides, e.g.
if this is set to 'x', then 	http://www.yoursite.com/some/page?x=mobile
will trigger the mobile template to be used.

Mobile node: default mobile.  This affects your template code, e.g. 
<mobile></mobile> but it does NOT affect the browser override, e.g. 
www.yoursite.com?browser=mobi

Standard node: default standard. This affects your template code, e.g. 
<standard></standard> but it does NOT affect the browser override, e.g.  
www.yoursite.com?browser=full

force_browser_detect: default detect.  This string identifies how you can force the 
user's browser to be detected.  E.g. www.yoursite.com?browser=detect

force_browser_standard: default full.  This string identifies how you can force the 
user's browser to be detected.  E.g. www.yoursite.com?browser=full

force_browser_mobile: default mobi.  This string identifies how you can force the 
user's browser to be detected.  E.g. www.yoursite.com?browser=mobi

The following variables are from the script available at 
http://mobileesp.com/
Some of its settings have been exposed for easy configuration within MODx.

The function $uagent_obj detects if your mobile device matches up to any mobile phone on the market and returns true or false if they do.  I have pulled some of the more important ones out and given you access to them.

* iPad - Only targets iPAD.  Good to turn off if you want iPad to be a full browser and not a mobile site.

* iPhone - These are modern touchscreen phones with WebKit browsers. These browsers handle CSS and JavaScript very well, which means that modest AJAX sites with native (iPhone or other) style components typically work great.

* Detect Rich CSS - These devices can handle CSS reasonable well, so that iPhone- or Android-style UIs generally look fine. Unfortunately, JavaScript support is poor. For these reasons, in most cases, it's probably best to serve these devices the generic mobile site rather than the iPhone Tier site. Includes: Symbian S60 Open Source Browser, 'High' BlackBerry Devices, Windows Mobile, other Webkit-based devices.

* Detect Other Phones - Detects for all other mobile devices, with an emphasis on feature phones. For these devices, it’s best to serve only the most basic styling, limited to little more than text color, alignment, and bold/italics. JavaScript support is virtually non-existent for these devices.

------------------------------------------------------------------------------*/
/*------------------ OTHER FUNCTIONS------------------------------------------*/
function store_user_prefs($x, $usecookie) {
	if ($usecookie == 'yes') {
		setcookie('browser',$x,time()+604800, "/", "", 0);
	}
}
//-------------------------------------
function get_user_prefs() {
	return $_COOKIE['browser'];
}
//-------------------------------------
function clear_user_prefs() {
	if ($usecookie == 'yes') {
		setcookie('browser','',time()-3600, "/", "", 0);
	}
}
//-------------------------------------
function delete_template_nodes($delete_node,$preserve_node) {

	global $modx; // Without this, the $modx var is out of scope.
	$delete_node = preg_quote($delete_node);
	$pattern = '/\<'.$delete_node.'\>(.*)\<\/'.$delete_node.'\>/Usi';
	$modx->resource->_output = preg_replace($pattern,'',$modx->resource->_output);
	$preserve_node = preg_quote($preserve_node);
	$pattern = '/\<'.$preserve_node.'\>/Usi';
	$modx->resource->_output = preg_replace($pattern,'',$modx->resource->_output);
	$pattern = '/\<\/'.$preserve_node.'\>/Usi';
	$modx->resource->_output = preg_replace($pattern,'',$modx->resource->_output);
}

/*---------------------- ERROR CHECKING --------------------------------------*/
// http://wiki.modxcms.com/index.php/API:logEvent
if ($modx->event->name != 'OnWebPagePrerender') { 
	$msg = 'Mobile Template Switcher: Plugin must be triggered by the OnWebPagePrerender event.  Instead it was triggered by '.$modx->event->name;
	$modx->logEvent(3, 3, $msg, 'Mobile Detection');
	return; 
};

$msg = '';
// warn if any of those are unset
if ( !isset($mobile_node) || $mobile_node == '') {
	$msg .= 'Configuration error: Mobile node name not defined. Default value used. ';
	$mobile_node = 'mobile';
}
if ( !isset($standard_node) || $standard_node == '' ) {
	$msg .= 'Configuration error: Standard node name not defined. Default value used. ';
	$standard_node = 'standard';
}
if ( !isset($force_browser_detect) || $force_browser_detect == '') {
	$msg .= 'Configuration error: Force browser detect URL parameter not defined. Default value used. ';
	$force_browser_detect = 'detect';
}
if ($msg != '') {
	$modx->logEvent(3, 2, $msg,'Mobile Detection'); 
}

// $mobile_node, $standard_node, $force_browser_detect MUST be distinct
// this is a cheap trick... using PHP hash to "count" distinct values.
$hash[$mobile_node] = 1;
$hash[$standard_node] = 1;
$hash[$force_browser_detect] = 1;
if (count($hash) < 3) {
	$msg = 'Configuration error: $mobile_node, $standard_node, $force_browser_detect MUST be distinct values.';
	$modx->logEvent(3, 3, $msg,'Mobile Detection'); 
	return;
}


/*----------- Here begins the logical block ----------------------------------*/


/* include the mobileESP detection script
The latest copy can always be found at:  "http://mobileesp.googlecode.com/svn/PHP/mdetect.php"
*/
include("assets/components/mobiledetection/mdetect.php");

//Instantiate the object to do our testing with.
$uagent_obj = new uagent_info();
$var = $_GET[$force_browser_variable];
if($var == $force_browser_mobile){
	delete_template_nodes($standard_node, $mobile_node);
	store_user_prefs($mobile_node, $usecookie); 
}else if ($var == $force_browser_standard){
	store_user_prefs($standard_node, $usecookie);
	delete_template_nodes($mobile_node, $standard_node);
}else if ($var == $force_browser_detect){
		clear_user_prefs();
		//Detect iPhone
		if (($uagent_obj->DetectTierIphone() == $uagent_obj->true) && ($iphone == 1)){
		delete_template_nodes($standard_node, $mobile_node);
		store_user_prefs($mobile_node, $usecookie);
		//Detect iPad
		} else if (($uagent_obj->DetectIpad() == $uagent_obj->true) && ($ipad == 1)){
		delete_template_nodes($standard_node, $mobile_node);
		store_user_prefs($mobile_node, $usecookie);
		//Detect Tier Rich Css
		} else if (($uagent_obj->DetectTierRichCss() == $uagent_obj->true) && ($rich_css == 1)){
		delete_template_nodes($standard_node, $mobile_node);
		store_user_prefs($mobile_node, $usecookie);
		//Detect All Other Mobile Devices
		} else if (($uagent_obj->DetectTierOtherPhones() == $uagent_obj->true) && ($all_other_mobile == 1)){
		delete_template_nodes($standard_node, $mobile_node);
		store_user_prefs($mobile_node, $usecookie);
		//Else it's a regular PC browser -- send to regular desktop site
		} else { store_user_prefs($standard_node, $usecookie);
		delete_template_nodes($mobile_node, $standard_node);
		}
}else if ( get_user_prefs() == $standard_node ) { 
delete_template_nodes($mobile_node, $standard_node);
store_user_prefs($standard_node, $usecookie); 
}else if ( get_user_prefs() == $mobile_node ) { 
delete_template_nodes($standard_node, $mobile_node);
store_user_prefs($mobile_node, $usecookie); 
//Detect iPhone
} else if (($uagent_obj->DetectTierIphone() == $uagent_obj->true) && ($iphone == 1)){
delete_template_nodes($standard_node, $mobile_node);
store_user_prefs($mobile_node, $usecookie);
//Detect iPad
} else if (($uagent_obj->DetectIpad() == $uagent_obj->true) && ($ipad == 1)){
delete_template_nodes($standard_node, $mobile_node);
store_user_prefs($mobile_node, $usecookie);
//Detect Tier Rich Css
} else if (($uagent_obj->DetectTierRichCss() == $uagent_obj->true) && ($rich_css == 1)){
delete_template_nodes($standard_node, $mobile_node);
store_user_prefs($mobile_node, $usecookie);
//Detect All Other Mobile Devices
} else if (($uagent_obj->DetectTierOtherPhones() == $uagent_obj->true) && ($all_other_mobile == 1)){
delete_template_nodes($standard_node, $mobile_node);
store_user_prefs($mobile_node, $usecookie);
//Else it's a regular PC browser -- send to regular desktop site
} else
{ store_user_prefs($standard_node, $usecookie);
delete_template_nodes($mobile_node, $standard_node);
}