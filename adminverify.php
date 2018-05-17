<?php
include_once 'alert.php';
$querystring = $_SERVER['QUERY_STRING'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Verify Admin</title> 
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include_once 'navbar.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-3">
				<div class="display-4">Confirm you are Admin</div>
				<div class="lead">To continue operation</div>
			</div>
			<div class="col-md-6 offset-md-3">
				<?php 
				if (isset($_REQUEST["succ"])) {
					showAlert(1, "Operation successful");
				} else if (isset($_REQUEST["err"])) {
					showAlert(2, "Operation failed");
				} 
				?>
				<form action="php/functions/verify_admin.php" method="post">
					<input type="hidden" name="next_page" value="<?php echo $_REQUEST['page'] ?>" />
					<input type="hidden" name="query_string" value="<?php echo $querystring ?>">
					<div class="form-group">
					</div>
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" required/>
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required/>
					</div>
					<div class="btn-group float-right">
						<input type="submit" value="Check" class="btn btn-primary" />
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