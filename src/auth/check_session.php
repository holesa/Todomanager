<?php
session_start();
if(!isset($_SESSION['access_token'])){
    header("Location: views/login/login.php");
}
?>