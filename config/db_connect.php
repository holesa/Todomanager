<?php
require_once __DIR__."/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();
$db_host=getenv('DB_HOST');
$db_user=getenv('DB_USER');
$db_pass=getenv('DB_PASS');
$db_name=getenv('DB_NAME');

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(!$connection){
    echo "Connection error: " . mysqli_connect_error(); 
}
?>


