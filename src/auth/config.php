<?php
  require_once __DIR__ . "/../../vendor/autoload.php" ;
	session_start();
	$gClient = new Google_Client();
	$gClient->setClientId("149099730940-esm46lk2e8gbt2325nejhe8vouurtl5d.apps.googleusercontent.com");
	$gClient->setClientSecret("X8nOl1kPxiXl0ewugCJKVl1g");
	$gClient->setApplicationName("Todomanager");
	$gClient->setRedirectUri("http://localhost/todomanager/src/auth/oauth2callback.php");
	$gClient->addScope("profile");
?>
