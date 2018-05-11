<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/User.php';


// Get current menu information if it exists
$user = new User();

if (isset($_REQUEST["id"]))
	$user = User::getUser($_REQUEST["id"]);

?>

<!DOCTYPE html>
<html>
<head>
	<title>User</title>
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include_once 'navbar.php'; ?>

	<div class="container">
		<div class="row">

			<div class="col-md-6 offset-md-3">
				<div class="h1">User</div>

				<form action="php/functions/update_user.php" method="post">
					<input type="hidden" name="user_id" value="<?php echo $user->id ?>" />
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" id="username" name="username" value="<?php echo $user->username ?>" class="form-control" required/>
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" id="password" name="password" onkeyup="checkPasswordMatched()" value="<?php echo $user->password ?>" class="form-control" required/>
					</div>

					<div class="form-group">
						<label for="confirm-password">Confirm Password</label>
						<input type="password" id="confirm-password" name="confirm_password" onkeyup="checkPasswordMatched()" value="<?php echo $user->password ?>" class="form-control" required/>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="firstname">First Name</label>
									<input type="text" id="firstname" name="firstname" value="<?php echo $user->firstName ?>" class="form-control" required/>
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="lastname">Last Name</label>
									<input type="text" id="lastname" name="lastname" value="<?php echo $user->lastName ?>" class="form-control" required/>
								</div>
							</div>
						</div>
					</div>

					<div class="form-check">
						<label class="form-check-label">
							<input class="form-check-input" name="isadmin" type="checkbox" <?php echo ($user->isAdmin==1?"checked":"") ?>  /> Admin
					  </label>
					</div>

					<div class="form-group">
						<div class="text-danger" id="warning-message"></div>
					</div>

					<div class="btn-group float-right">
						<button type="reset" class="btn btn-secondary mr-2">Reset</button>
						<input type="submit" value="Save" id="save-button" class="btn btn-primary" />
					</div>

				</form>
			</div>
		</div>
	</div>

	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/popper.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/usermaster.js"></script>
</body>
</html>