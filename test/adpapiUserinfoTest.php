<?php

$adp_logging = 1;
$adp_logmode = 0;
$adp_logfile = "/tmp/adpapi.log";


$libroot = realpath("../../") . "/";
$webroot = realpath("../client") . "/";

require_once("$libroot/connection/adpapiConnection.class.php");
require_once("../adpapiUserinfo.class.php");

class adpapiUserinfoTest extends \PHPUnit_Framework_Testcase
{


	public Function testClass() {

		// GetConnection

		include("../../connection/test/testconfig.php");

		$config = array();

		$configuration = array (
        	'grantType' 			=> 'ClientCredentials',
        	'clientID'				=> $ADP_CC_CLIENTID,
        	'clientSecret'			=> $ADP_CC_CLSECRET,
        	'sslCertPath'			=> $ADP_CERTFILE,
        	'sslKeyPath'			=> $ADP_KEYFILE,
        	'tokenServerURL'		=> $ADP_APIROOT
    	);

		// Use this way, since using the factory statically does not
		// provide code coverage.

		$adpFactory = new adpapiConnectionFactory();
		$adpconn = $adpFactory->create($configuration);

		$status = $adpconn->connect();

		$userInfo = new adpapiUserinfoHelper($adpconn);

		$this->assertTrue(TRUE);

	}


	//----------------------------------------------
	// Test creation of class
	//----------------------------------------------
	public function testUserinfo() {

		// GetConnection

		include("../../connection/test/testconfig.php");

		$config = array();

		$configuration = array (
        	'grantType' 			=> 'ClientCredentials',
        	'clientID'				=> $ADP_CC_CLIENTID,
        	'clientSecret'			=> $ADP_CC_CLSECRET,
        	'sslCertPath'			=> $ADP_CERTFILE,
        	'sslKeyPath'			=> $ADP_KEYFILE,
        	'tokenServerURL'		=> $ADP_APIROOT
    	);



		// Use this way, since using the factory statically does not
		// provide code coverage.

		$adpFactory = new adpapiConnectionFactory();
		$adpconn = $adpFactory->create($configuration);

		$status = $adpconn->connect();

		$userInfo = new adpapiUserinfoHelper($adpconn);




		$this->setExpectedException('adpException');
		$result = $userInfo->getUserInfo();


	}





}










