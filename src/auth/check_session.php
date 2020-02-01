<?php
session_start();
if(!isset($_SESSION['access_token'])){
    header("Location: src/login/login.php");
}
?>