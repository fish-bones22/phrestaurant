<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/User.php';
include_once 'alert.php';

// Get current menu information if it exists
$users = User::getAllUsers();

$token =  hash('ripemd160', date("YmdHi"));
if (!isset($_REQUEST["token"]) || $token != $_REQUEST["token"]) {
	header("Location:adminverify.php?page=".basename(__FILE__, '.php'));
	exit();
}

$_SESSION["user"] = 1;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>

	<?php include_once 'navbar.php'; ?>

	<div class="container">
		<div class="row">

			<div class="col-md-6 offset-md-3">
				<div class="h1">Users</div>

				<?php 
				if (isset($_REQUEST["succ"])) {
					showAlert(1, "Operation successful");
				} else if (isset($_REQUEST["err"])) {
					showAlert(2, "Operation failed");
				} 
				 ?>

				<?php
				if ($users != null)
				foreach($users as $user) {
				?>

				<div class="row">
					<div class="col-8">
						<a href="usermaster.php?id=<?php echo $user->id ?>"><?php echo $user->firstName." ".$user->lastName ?></a>
					</div>
					<button type="button" onclick="deleteUser(<?php echo $user->id ?>)" data-toggle="modal" data-target="#confirm-modal" class="btn close">&times</button>
				</div>

				<?php
				}
				else {
				?>
				<div class="text-muted">No Users yet.</div>
				<?php
				}// end if-else
				?>

				<div class="row align-items-center">
					<a href="usermaster.php">+ New User</a>
				</div>
			</div>
		</div>
	</div>

	<div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="php/functions/delete_user.php" method="post">
					<input type="hidden" name="id" id="user-id-for-deletion" />
		      		<div class="modal-body">
		        		<p class="lead">Delete User?</p>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="submit" class="btn btn-primary">Yes</button>
		        		<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		      		</div>
		      	</form>
	   	 	</div>
	  	</div>
	</div>

	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/popper.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/users.js"></script>

</body>
</html>