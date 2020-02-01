<!DOCTYPE html>
<head> 
<title>Todomanager</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="http://localhost/todomanager/public/style/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
</head> 
<body>
 <header class="header">
 <div class="brand">       
<a href="#"><img src="http://localhost/todomanager/public/images/logo.png"></a>
</div>
<div class="user-info">
<?php if(isset($_SESSION["access_token"])){?>
<?php echo "<b>Hello ". $_SESSION["givenName"] . "</b>";?>
<!-- User logout-->
<form method="POST" class="logout" action="">
<input type="submit" class="btn btn-dark" name="logout" value="Logout">
</form>
<?php } ?>
</div>
</header>



