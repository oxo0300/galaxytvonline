--------------------
fbLogin 1.0
--------------------

First Released: February 20th, 2012
Author: Joe Molloy <hyper-typer.com>
License: GNU GPLv2 (or later at your option)

fbLogin is a MODX extra which extends Shaun McCormack's Login extra 
to enable users to register and login to a site using their Facebook 
account via the Facebook API using Version 3.0 of their PHP SDK.

VERY IMPORTANT
THIS EXTRA MAKES USE OF THE FACEBOOK PHP SDK (VERSION 3) WHICH IS 
BUNDLED WITH THE EXTRA FOR YOUR CONVENIENCE. I DO NOT CLAIM 
OR TAKE ANY RESPONSABILITY FOR THIS SDK.



Table of Contents:
--------------------
1. Setup
2. Snippets
3. Chunks
4. System Settings
5. Credits
6. Warranty



--------------------
1. Setup
--------------------
Please follow the instructions below CAREFULLY, if you don't 
you may be endangering the privacy of your users and in any 
case, I will not be providing free support for this extra as 
I have gone to great lengths to make this readme 
comprehensive enough as it is - you can opt to be lazy but 
it will cost you.

1. Plan your Facebook integration, at least have a good idea 
of what you can do with the API and the permissions you may 
need to obtain from your users to make what you want to 
use the API for happen. It will make life a lot easier 
for you if you do this in advance.

2. If you have not already done so, install the Login extra 
from Package Manager.  This MUST be installed for this extra 
to function.  You should set up your registration and login 
system and have them working completely before you make a 
start setting up this extra.  In addition, you should have 
a dedicated login page, a dedicated registration page and 
a protected account page where registered & logged in users can 
manage their profile and other account details. Once that 
is all done and working, proceed to step 3.

3. If you haven't already done so you will need to go to the 
Developer App on Facebook and create a new app for your site - 
https://developers.facebook.com/apps.

4. Take note of the App ID and App Secret Facebook have assigned 
to your newly created app.

5. Also, while you are there, click on the advanced tab and 
complete the field allowing you to enter a URL on your site to a 
resource that Facebook can ping to inform you of users who have 
de-authorised your app. This resource is automatically created 
by the installer at http://yoursitedomain/fbd.

6. Install this extra from package manager.

7. Place an uncached call to fbLogin snippet to where you wish the 
'Connect to Facebook' button to appear.

[[!fbLogin]]

Alternatively you can place an uncached call to the fbLinks chunk 
which will output a set of account related links - see the Chunks 
section below.

[[!$fbLinks]]



--------------------
2. Snippets
--------------------
Please Note: Each of these snippets should be called uncached.

fbRedirect
--------------------
This snippet does the actual redirect to Facebook for users who are not 
registered yet, logged out or who have changed their Facebook password, 
had their access token expire or who wish to re-authorise your site. It 
should be placed on a publically accessible page with the template set 
to 'none'.

Parameters:
&returnUrlId - required. 
The ID of the resource for Facebook to redirect 
to when a user has approved a requested action from your site.

&perms - optional
A comma delimited list of permissions you wish to obtain from Facebook for 
this user of your app. A list of available permissions can be found at 
http://developers.facebook.com/docs/reference/api/user/.  Defaults to 
'email' which retrieves the user's basic info and their email address.


fbLogin
--------------------
This is the main snippet in the package.  It has the following roles:

For users who are not logged in:
1. Outputs the link to the resource with the fbRedirect snippet and 
'Login to Facebook' button for unregistered users and those who have 
not yet logged in.
2. Captures the response from Facebook and if necessary adds new users 
which optionally can be added to one or more user groups.
3. Automatically logs in new and returning Facebook users
4. Optionally redirects new users to a resource where they can complete 
their MODX profile.
5. Outputs the following placeholders:
$modx->setPlaceholder('fbLoginTitle',$fbLoginTitle);
[[+fbRedirectUrlId]] - the ID of the reousrce where the fbRedirect snippet 
is placed (by installer) 
[[+fbLoginImg]] - the image used for the 'Connect to Facebook' button
[[+fbLoginUrlId]] - the ID of the dedicated login resource
[[+fbCancelId]] - the ID of a resource to which users who cancel an 
action on facebook are redirected.

When the user is registered and logged in:
1. It can optionally output the fbLoggedin chunk. Default is to display.
2. For conveniene, it outputs placeholders for some useful Facebook 
related which you can use to customise your pages. These are:
[[+fbUser]] which outputs the user's Facebook user ID.
[[+fbAppId]] which outputs your Facebook app ID
[[+fbFullname]] which outputs the Facebook user's full name
[[+fbFirstname]] which outputs the Facebook user's first name
[[+fbemail]] which outputs the Facebook user's email address
[[+fbProfileImg]] which outputs the Facebook user's profile image retrieved
from their CDN - the source of the image is 50px X 50px so you should not 
resize it to a size beyond for optimal display
[[[+fbCancelId]] - the ID of a resource to which users who cancel an 
action on facebook are redirected - taken from the system setting
fbLogin_cancel_resource_id by default which you set during install.
[[+fbLogoutUrlId]] - the ID of the dedicated login resource you created
 - taken from the system setting fbLogin_login_resource_id which you set 
 during install.
[[+fbAccountUrlId]] - the ID of the resource returning users are redirected
 to after login.
3. It handles OAuth exceptions which can arise when a user's access token 
expires, when they change their Facebook password or when they de-authorise 
your app.

Parameters:
&fbDisplayLoggedinTpl - optional
Toggles whether the snippet displays a chunk or not when the user is 
logged in - default value is 1 which by default causes the fbLoginTpl
chunk to be dipslayed.

&loginResourceId - optional
The ID of the dedicated login resource you have set up.
This is taken from the system setting fbLogin_login_resource_id which 
you set when installing fbLogin by default.

&accountResourceId - optional
The ID of the resource to which you users redirected to after they login.
This is taken from the system setting fbLogin_account_resource_id which 
you set when installing fbLogin by default.

&redirectResourceId - optional
The ID of the resource in which the fbRedirect snippet is placed.
This resource is added by the installer with a alias of 'fbr'. It 
is hidden in the site tree.

&cancelResourceId - optional
The ID of the resource you want to redirect to when a user cancels an 
action on Facebook - it would usually be the ID of your dedicated 
login resource.
This is taken from the system setting fbLogin_cancel_resource_id which 
you set when installing fbLogin by default.

&fbLoginTpl - optional
The name of a chunk which displays the 'Connect with Facebook' image and 
link placeholders.  Defaults to fbLoginTpl.

&firstloginResourceId - optional
The ID of the resource which you would like a user redirected to on their 
first login - for instance, you may want such users to complete their MODX 
profile before proceeding further.
This is taken from the system setting fbLogin_firstlogin_resource_id which 
you set when installing fbLogin by default.

&perms - optional
A comma delimited list of permissions you wish to obtain from Facebook for 
this user of your app. A list of available permissions can be found at 
http://developers.facebook.com/docs/reference/api/user/.  
This is taken from the system setting facebook_user_perms which 
you set when installing fbLogin by default.

&usergroups - optional
A comma delimited list of user group names you wish to have Facebook based 
users added to.  If you also wish to assign the user a specific role you 
should add a colon and the role name after the group name - e.g. Customer:Member.
By default, if you just specify the group, the user is added to the group with a 
role of 'Member'.
This is taken from the system setting fbLogin_usergroups which 
you set when installing fbLogin by default.

&fbLoginImg - optional
The URL for an image to be used as the 'Connect to Facebook' graphic - 
defaults to the standard 'Connect to Facebook' button hosted on the 
Facebook CDN.

&fbLoginTitle - optional
The text for the title attribute of the 'Connect to Facebook' button 
which displays when users hover their mouse over link - defaults to 
'Click here to register/log in with Facebook'.

&fbLoggedinTpl - optional
The template used when a regisred user has logged in using their .
Facebook account - by default uses the fbLoggedin snippet.


fbDe-authorised
--------------------
This snippet has no parameters - it is placed in a hidden resource 
with the alias 'fbr' by the installer which Facebook can ping when a 
user de-authorises your app. It simply captures and decodes the 
Facebook user id sent and deactivates the corresponding MODX account. 
We deactivate rather than remove the account as the user may chose to 
reactivate their account in the future and we may want therefore to 
persist associated data.


checkForActive
--------------------
This snippet should be placed on all protected pages where a registered 
Facebook user has access.  It is needed as a user may de-authorise our app
while logged in and therefore they need to be logged out immediately when 
they attempt to access a protected page - being deactivated only would 
prevent them logging back in after logging out. 

Parameters:
&logoutUrlId - optional
The ID of your dedicated login resource.  By default it is read from the 
system setting fbLogin_login_resource_id which you set during the install 
process.



--------------------
3. Chunks
--------------------
The following chunks are included with this package.  The first should 
be called uncached.  The others are for use by the matching snippets 
above.

fbLinks
--------------------
This chunk outputs a set of links which would be displayed on each page 
of your site, say in the header, related to the logged-in/registered 
state of a user. It enables user registeratrion either via MODX or 
Facebook and should be used to replace a set of links you may 
already display when using the Login extra exclusively.  You could 
replace this with your own chunk to customise things to your liking.

Parameters:
&fbLinksSeparator - required
A separator character to be used between the 'sign in' and 'register' 
links in the logged out state and the 'sign out' and 'account' links 
in the logged in state.

&fbLinksAltSeparator - required
A separator character to be used between the 'register' link and 
the 'Connect with Facebook button' in the logged out state.

&fbLoginLinkText - required
The text to be used for the link to the dedicated login page.

&fbRegisterLinkText - required
The text to be used for the link to the dedicated registration page

&fbLogoutLinkText - required
The text to be used for the link to the dedicated login page.

&fbAccountLinkText - required
The text to be used for the link to the users' account / profile 
management page.

&fbLoginLinkTitle - required
The text to be used for the title attribute of the link to the 
dedicated login page.

&fbRegisterLinkTitle - required
The text to be used for the title attribute of the link to the 
dedicated registration page

&fbLogoutLinkTitle - required
The text to be used for the title attribute of the link to the 
dedicated login page.

&fbAccountLinkTitle - required
The text to be used for the title attribute link to the users' 
account / profile management page.

&fbRegisterLinkId - required
The ID of the resource acting as your dedicated registration 
page.

Sample Call:
[[!$fbLinks? 
&fbLinksSeparator=`|` 
&fbLinksAltSeparator=`/`
&fbLoginLinkText=`Sign In` 
&fbLoginLinkTitle=`Log in to your account` 
&fbLogoutLinkText=`Sign Out` 
&fbLogoutLinkTitle=`Log out from your account` 
&fbRegisterLinkText=`Sign Up` 
&fbRegisterLinkTitle=`Register with us to get listed` 
&fbAccountLinkText=`Your Account` 
&fbAccountLinkTitle=`Manage your properties, listing & account info`
&fbRegisterLinkId=`the ID of your dedicated registration resource`
]]

fbLoginTpl
--------------------
This is the template that is called by the fbLogin snippet by 
default for users who have not logged in.

The placeholders are set by the fbLogin snippet.


fbLoggedinTpl
--------------------
This is the template used by the fbLogin snippet when a user has logged 
in via Facebook

The placeholders are set by the fbLogin snippet by default.



--------------------
4. System Settings
--------------------
The following system settings are required for this extra to 
function. They are created during install via the installer 
and they should not be changed unless you know what you are 
doing.

Name: facebook_app_id
Key: facebook_app_id
Area: site
Value: Your Facebook app id which you got from the Facebook 
Developer App .

Name: facebook_app_secret
Key: facebook_app_secret
Area: site
Value: Your Facebook app secret which you got from the Facebook 
Developer App above. 

Name: facebook_user_perms
Key: facebook_user_perms
Area: site
Value: The permission your site requires from Facebook users for your
app to function

Name: fbLogin_usergroups
Key: fbLogin_usergroups
Value: A comma delimited list of usergroup names you would like 
newly registered Facebook users to be added to automatically on 
registration.

Name: fbLogin_login_resource_id
Key: fbLogin_login_resource_id
Value: The ID of your dedicated login resource.

Name: fbLogin_account_resource_id
Key: fbLogin_account_resource_id
Value: The ID of a resource returning users should be directed to
when they log in.

Name: fbLogin_firstlogin_resource_id
Key: fbLogin_firstlogin_resource_id
Value: The ID of a resource newly registered users are taken to after
registering - it could be used for instance to present a form for them 
to complete their MODX profile.

Name: fbLogin_cancel_resource_id
Key: fbLogin_cancel_resource_id
Value: The ID of a resource to take users to when they cancel an action 
on Facebook - usually it will be the ID of your dedicated login resource.



--------------------
5. Credits
--------------------
Extra authored by: Joe  Molloy (@freelancewebdev) 
http://www.hyper-typer.com/
Thanks to: 
Edward A. Webb and his inspiring article at 
http://edwardawebb.com/web-development/facebook-login-modx-sites
Mark Hamstra (@mark_hamstra) 
http://markhamstra.com for the encouragement to package my code
Shaun McCormack (@spittingred) http://www.spittingred.com 
for his great Login and Packman extras.



--------------------
6. Warranty
--------------------
This extra is released without any warranty attached.
I neither accept any liablity for damages arising from
the installation or use of this extra and you acknowledge
this by installing and/or using it.

Peace.