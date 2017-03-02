# ADP Client Userinfo Library for PHP

The ADP Client Userinfo Library is intended to simplify and aid the process of retrieving Userinfo from the ADP Marketplace API Gateway. The Library includes a sample application that can be run out-of-the-box to connect to the ADP Marketplace API **test** gateway.

The installation and use of this library makes the following assumptions:

  - You must be running php5.3 or higher with CURL support.  If you are using OSX, this means you will need to rebuild PHP with CURL support.
  - Composer is installed and configured, as the library utilizes Composer for installation.

### Version
1.0.2

### Installation

**Composer**

Use Composer from the location you wish to use as the root folder for your project.

```sh
$ composer require adpmarketplace/api-userinfo
```

This will install the Userinfo module to your project.  If you have not already installed the Connection module, it will automatically be downloaded and installed as well.

If you wish to build the sample client, do the following:

```sh
$ cd adplib/connection/tools
$ php makeclient.php
```

If you want to test immediately, copy and paste the proper commands that are generated by the makeclient.php script.  In case you missed them, you can do it this way as well:

```sh
(from the project root)
$ cd client
$ php -S 127.0.0.1:8889
```
This starts an HTTP server on port 8889 (this port must be unused to run the sample application).


**Run the sample app**

Note, to test the sample app you must first run the makeclient.php script, and then start the PHP server as outlined above.

Once this is done, open your web browser and go to:

```sh
http://localhost:8889
```

 The sample app allows you to connect to the ADP test API Gateway for testing the Userinfo call.  Please note that only "Authorization Code" is valid for calling the Userinfo api.

## Examples
### Call userinfo (this assumes you already have a valid connection)

```php

require("config.php");
require($libroot . "connection/adpapiConnection.class.php");
require($libroot . "userinfo/adpapiUserinfo.class.php");

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
// Success.  We have a userinfo value object.
//-------------------------------------------

echo "<h1>User Info</h1>\n";
echo "<pre>";

print_r($userInfo);

echo "</pre>";


```

## API Documentation ##

Documentation on the individual API calls provided by the library are documented in the 'doc' folder.  Open the index.html file in your browser to view the documentation.


## Dependencies ##

This library has the following dependencies.

* adpmarketplace/api-connection - Automatically installed via composer.
* php >= v5.3 with CURL support.  If you are using OSX, this means you will need to rebuild PHP with CURL support.
* composer

## Tests ##

Our testing and code coverage is handled through PHPUNIT, which you must install to run the tests.  For code coverage to work, you must also have Xdebug installed.  The test units are located in the "test" folder, and the configurations are already loaded into the phpunit.xml.  In order to run the tests and view code coverage:

```
phpunit
```
## Linter ##

You must use PHP's built-in linter to validate the structure of your code:

```php
php -l <sourcefile>
```

## Contributing ##

To contribute to the library, please generate a pull request. Before generating the pull request, please insure the following:

1. Appropriate unit tests have been updated or created.
2. Code coverage on the unit tests must be no less than 95%.
3. Your code updates have been fully tested and linted with no errors.
4. Update README.md and API documentation as appropriate.
 
## License ##

This library is available under the Apache 2 license (http://www.apache.org/licenses/LICENSE-2.0).
