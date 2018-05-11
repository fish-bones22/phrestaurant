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
				<form action="php/functions/get_log_status.php" method="post">
					<div class="form-group">
						<div class="display-4">Enter your credentials</div>
						<div class="lead">To Log In or Log Out</div>
					</div>
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" />
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" />
					</div>
					<div class="btn-group float-right">
						<input type="submit" value="Check" class="btn btn-primary" />
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