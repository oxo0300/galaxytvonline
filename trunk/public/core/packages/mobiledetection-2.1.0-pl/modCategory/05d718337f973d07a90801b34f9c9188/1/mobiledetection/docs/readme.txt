Mobile Detection - plugin for MODx Revolution 2.0

Version 2.1-beta1 by Zuriel Andrusyshyn

Code based on plugin originally posted by Peter Hoeflehner
Plugin originally created for Modx EVO by everettg_99 and noahlearner 

Inspiration from this forum thread:
http://modxcms.com/forums/index.php/topic,40357.0.html

DESCRIPTION:
This plugin combines browser detection and a URL-parameter override to 
show/hide portions of any template delineated by <mobile> and <standard> tags. 

REQUIREMENTS and EXAMPLES:

YOU MUST DOWNLOAD MOBILEESP and place it in your website (at the root, or
anywhere you want but it must be modified in the plugin code if its not in the root.)

/* include the mobileESP detection script
The latest copy can always be found at:  "http://mobileesp.googlecode.com/svn/PHP/mdetect.php"

Change this line in the script if you move it out of root - include("mdetect.php");
*/

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