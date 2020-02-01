<?php
  require_once "config.php";
  require_once "../../config/db_connect.php";

	if(isset($_SESSION['access_token']))
		$gClient->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {
		header('Location: ../login/login.php');
		exit();
	}

	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo_v2_me->get();

	$_SESSION['id'] = $userData['id'];
	$_SESSION['givenName'] = $userData['givenName'];
	$user_id = $userData['id'];
	$email = $userData['email'];


  // Save to the database a new user OR if user already exist, ignore this.
   require_once "../functions/create_user.php";			
?>