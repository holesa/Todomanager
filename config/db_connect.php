<?php
$connection = mysqli_connect("localhost", "andrej", "test", "todo_app");
if(!$connection){
    echo "Connection error: " . mysqli_connect_error(); 
}
?>
