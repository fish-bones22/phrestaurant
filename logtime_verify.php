<!DOCTYPE html>
<html>
<head>
	<title>Daily Time Record</title> 
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="h1">Daily Time Record</div>
	<div class="h3">Enter your credentials</div>
	<form action="php/functions/get_log_status.php" method="post">
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="Username" />
			<input type="password" name="password" class="form-control" placeholder="Password" />
			<input type="submit" value="Check" class="btn btn-primary" />
		</div>
	</form>

	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>