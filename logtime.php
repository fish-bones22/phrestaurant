<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/User.php';

if (!isset($_REQUEST["id"])) {
	header("Location: logtime_verify.php?err");
	exit();
}

$token =  hash('ripemd160', date("YmdHis"));

// if ($token != $_REQUEST["token"]) {
// 	header("Location: logtime_verify.php?err");
// 	exit();
// }


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
	<div class="container">
		<div class="row">

			<div class="col-md-6 offset-md-3">
				<div class="display-4 text-center">Hi <?php echo $user->firstName ?></div>

				<form action="php/functions/log_time.php" method="post">
					<div class="form-group">
						<input type="hidden" name="log_type" value="<?php echo $lastLogType ?>">
						<input type="hidden" name="user" value="<?php echo $user->id ?>">

						<?php 
							if ($lastLogType == 0) {
						?>
							<input type="submit" value="Log In" class="btn btn-block btn-primary" />
						<?php 
							} else {
						?>
							<div class="lead">You have logged in at <?php echo $user->lastLogTime ?></div>
							<input type="submit" value="Log Out" class="btn btn-block btn-primary" />
						<?php 
							}
						?>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>