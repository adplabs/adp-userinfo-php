<?php

/*
Copyright © 2015-2016 ADP, LLC.

Licensed under the Apache License, Version 2.0 (the “License”);
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an “AS IS” BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
express or implied.  See the License for the specific language
governing permissions and limitations under the License.
*/

session_start();


if (!isset($_SESSION['adpConn'])) {

	//include("connect.php");
	die("No session found.");

}
else {

	require("config.php");
	require($libroot . "connection/adpapiConnection.class.php");

	$adpConn = unserialize($_SESSION['adpConn']);

}

require ($libroot . "userinfo/adpapiUserinfo.class.php");

include("inc/header.php");

//--------------------------
// Create the helper class
//--------------------------

try {

	$userInfoHelper = new adpapiUserinfoHelper($adpConn);

}
catch (adpException $e) {

	showADPException($e);
	exit();

}

//-------------------------------------------
// Get the info back from the userinfo call
//-------------------------------------------

try {

	$userInfo = $userInfoHelper->getUserinfo();
}
catch (adpException $e) {

	showADPException($e);
	exit();

}

//-------------------------------------------
// Success!  We SHOULD have user info!
//-------------------------------------------

echo "<h1>User Info</h1>\n";
echo "<pre>";

print_r($userInfo);

echo "</pre>";

?>

<a class="api" href="/">Main Menu</a>

<?php

include("inc/footer.php");
