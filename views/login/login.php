<?php
    require_once  __DIR__ . "/../../src/auth/config.php";
	if (isset($_SESSION['access_token'])) {
		header('Location: ../../index.php');
		exit();
	}
	$loginURL = $gClient->createAuthUrl();
?>

<!-- Header -->
<?php require_once("../templates/header.php");?>
    <div class="login-section">
                <h1 class="header-text">Start organizing your tasks right now!</h1>
                <input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Continue with Google" class="btn btn-danger btn-lg">
    </div>
<!-- Footer -->
<?php require_once("../templates/footer.php");?>
