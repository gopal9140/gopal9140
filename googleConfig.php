<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('608630190378-5b3furd9empq54bh4p84r56eufg8shd5.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/DCKAP/index.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

?>