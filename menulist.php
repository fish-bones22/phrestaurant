<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';

// Get current menu information if it exists
$menus = Product::getAllMenu();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu Items</title>
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div class="container">
		<div class="row">

			<div class="col-md-6 offset-md-3">
				<div class="h1">Menu Items</div>

				<div class="">
					
				</div>
			</div>
		</div>
	</div>

	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>