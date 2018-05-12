<?php 
include_once 'alert.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php include_once 'navbar.php'; ?>
	<div class="container">
		<div class="h1">Menu Item</div>

		<?php 

		if (isset($_REQUEST["succ"])) {
			echo showAlert(1, "Success");
		}

		 ?>

		<div class="form-group">
			<label for="menu-item">Menu Name</label>
			<input type="text" id="menu-item" name="menu_item" class="form-control" />
		</div>
		
		<div class="form-group">
			<label for="menu-item">Menu Name</label>
			<input type="text" id="menu-item" name="menu_item" class="form-control" />
		</div>

	</div>



	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/popper.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>