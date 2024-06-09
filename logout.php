<?php
session_start();
require 'vendor/autoload.php';
$accesstoken = $_SESSION['access_token'];
unset($_SESSION["auto"]);
unset($_SESSION['token']);

//Reset OAuth access token
$client = new Google_Client();
$client->revokeToken($accesstoken);

//Destroy entire session data.
session_destroy();
header('Location: logres/login.php');
?>