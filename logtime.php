<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/User.php';

if (!isset($_REQUEST["id"]))
	header("Location: logtime_verify.php?err");

$id = $_REQUEST["id"];
$user = User::getUser($id);
$lastLogType = $user->lastLogType;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Daily Time Record</title> 
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="h2">Hi <?php echo $user->firstName ?></div>
	<form action="php/functions/log_time.php" method="post">
		<div class="form-group">
			<input type="hidden" name="log_type" value="<?php echo $lastLogType ?>">
			<input type="hidden" name="user" value="<?php echo $user->userId ?>">

			<?php 
				if ($lastLogType == 0) {
			?>
				<input type="submit" value="Log In" class="btn btn-primary" />
			<?php 
				} else {
			?>
				<div class="h4">You have logged in at <?php echo $user->lastLogTime ?></div>
				<input type="submit" value="Log Out" class="btn btn-primary" />
			<?php 
				}
			?>
		</div>
	</form>

	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>