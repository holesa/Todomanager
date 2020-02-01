<?php
  $query = "INSERT IGNORE INTO users (user_id, email) VALUES ('$user_id', '$email')";
  function query($query){
	global $connection;
	if(mysqli_query($connection, $query)){
		header("Location:../../index.php");
	}
		else{
			echo "query error: " . mysqli_error($connection);
		}
}
	query($query);
	exit();

?>