<?php
  require_once __DIR__ . "/../../vendor/autoload.php" ;

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
  $dotenv->load();
  $oauth_client_id=getenv('OAUTH_CLIENT_ID');
  $oauth_client_secret=getenv('OAUTH_CLIENT_SECRET');
  $oauth_app_name=getenv('OAUTH_APP_NAME');
  $oauth_redirect_uri=getenv('OAUTH_REDIRECT_URI');
  $oauth_scope1=getenv('OAUTH_SCOPE1');
  $oauth_scope2=getenv('OAUTH_SCOPE2');




	session_start();
	$gClient = new Google_Client();
	$gClient->setClientId($oauth_client_id);
	$gClient->setClientSecret($oauth_client_secret);
	$gClient->setApplicationName($oauth_app_name);
	$gClient->setRedirectUri($oauth_redirect_uri);
	$gClient->addScope($oauth_scope1);
	$gClient->addScope($oauth_scope2);

?>
