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

	<?php include_once 'navbar.php'; ?>

	<div class="container">
		<div class="row">

			<div class="col-md-6 offset-md-3">
				<div class="h1">Menu Items</div>

				<?php
				if ($menus != null)
				foreach($menus as $menu) {
				?>

				<div class="row">
					<div class="col-8">
						<a href="menumaster.php?id=<?php echo $menu->id ?>"><?php echo $menu->name ?></a>
					</div>
					<button type="button" onclick="deleteMenu(<?php echo $menu->id ?>)" data-toggle="modal" data-target="#confirm-modal" class="btn close">&times</button>
				</div>

				<?php
				}
				else {
				?>
				<div class="text-muted">No Menus yet.</div>
				<?php
				}// end if-else
				?>

				<div class="row align-items-center">
					<a href="menumaster.php">+ New Menu</a>
				</div>
			</div>
		</div>
	</div>

	<div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="php/functions/delete_menu.php" method="post">
					<input type="hidden" name="id" id="menu-id-for-deletion" />
		      		<div class="modal-body">
		        		<p class="lead">Delete Menu Item?</p>
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
	<script src="js/menulist.js"></script>

</body>
</html>