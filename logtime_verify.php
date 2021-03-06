<?php 
include_once 'alert.php';
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
	<?php include_once 'navbar.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-7 offset-md-3">
				<div class="display-4">Enter your credentials</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<form action="php/functions/get_log_status.php" method="post">
					<div class="form-group">
						<div class="lead">To Log In or Log Out</div>
					</div>
					<?php 
					if (isset($_REQUEST["succ"])) {
						showAlert(1, "Operation successful");
					} else if (isset($_REQUEST["err"])) {
						showAlert(2, "Operation failed");
					} 
					?>
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" required/>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required/>
					</div>
					<div class="btn-group float-right">
						<input type="submit" value="Check" class="btn btn-primary" />
					</div>
					<div class="">
						<a href="loghistory.php">Log history</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/popper.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>