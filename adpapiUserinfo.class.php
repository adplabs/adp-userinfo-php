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


/**
 *
 *
 * Helper class allows logic for the userinfo api call.
 *
 */

class adpapiUserinfoHelper extends adpapiProduct {

	/**
	 * Status - HTTP status from gateway
	 * @var integer
	 */
	public  $status;

	/**
	 * Decoded - The returned JSON decoded as an object
	 * @var object
	 */
	private $decoded;

	/**
	 * The authentication token used to communicate securely
	 * @var string
	 */
	private $token;

	/**
	 * The JSON data returned from the gateway
	 * @var string
	 */
	public $jsondata;

    /**
     * Retrieve Userinfo for current connected entity.
     *
     * @return object
     */
	public function getUserinfo() {

		$conn = $this->connection;

		if (strlen($conn->apiRoot) < 10) {
			// @codeCoverageIgnoreStart
			throw new adpException("Missing token server url.", 0 , null, "");
			return;
			// @codeCoverageIgnoreEnd
		}

		$endpoint = $conn->apiRoot . 'core/v1/userinfo';

		$headerarray = array();
		$headerarray[] .= "Accept: aplication/json";
		$headerarray[] .= "Authorization: Bearer " . $this->connection->getAccessToken();


		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL,				$endpoint);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 	true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, 		$headerarray);
		curl_setopt($curl, CURLOPT_USERAGENT, 		"adp-userinfo-php/1.0.1");


		$this->jsondata = curl_exec($curl);
		$this->status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$this->decoded = json_decode($this->jsondata);

		$curlerror = curl_errno($curl);
		curl_close($curl);


		// evaluate for success response
		if ($this->status != 200) {

			// @codeCoverageIgnoreStart
			if ($curlerror <> 0) {
				$except = new adpException("Communication Error", curl_errno($curl) , null, curl_error($curl));
			}
			if ($curlerror == 0) {
				$except = new adpException($this->decoded->error_code, $this->status, null, $this->jsondata);
			}
			// @codeCoverageIgnoreEnd

		}

		if (!isset($except)) {
			// @codeCoverageIgnoreStart
			return $this->decoded;
			// @codeCoverageIgnoreEnd
		}

		throw $except;

	}

}


