<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Category.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';

// Get cateogories
$categories = Category::getCategories();

// Get current menu information if it exists
$menu = new Product();

if (isset($_REQUEST["id"]))
	$menu = Product::getMenu($_REQUEST["id"]);

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
		<div class="row">

			<div class="col-md-6 offset-md-3">
				<div class="h1">Menu Item</div>

				<form action="php/functions/update_menu.php" method="post">
					<input type="hidden" name="menu_id" value="<?php echo $menu->id ?>" />
					<div class="form-group">
						<label for="menu-name">Menu Name</label>
						<input type="text" id="menu-name" name="menu_name" value="<?php echo $menu->name ?>" class="form-control" />
					</div>

					<div class="form-group">
						<label for="menu-category">Menu Category</label>
						<select id="menu-category" name="menu_category" class="form-control" value="<?php echo $menu->category ?>">
							<option value=""></option>
						<?php
						if ($categories != null) {
							foreach ($categories as $category) {
								$selected = "";
								if ($category->id == $menu->category) 
									$selected = "selected";
						?>
							<option value="<?php echo $category->id ?>" <?php echo $selected ?>><?php echo $category->name ?></option>
						<?php		
							} // end foreach
						} else {
						?>
							<option disabled="">No Categories</option>
						<?php
						} // end if-else
						?>

						</select>

					</div>

					<div class="form-group">
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label for="menu-price">Price</label>
									<input type="number" id="menu-price" name="menu_price" value="<?php echo $menu->price ?>" class="form-control" />
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<label for="menu-quantity">Quantity</label>
									<input type="number" id="menu-quantity" name="menu_quantity" value="<?php echo $menu->quantity ?>" class="form-control" />
								</div>
							</div>
						</div>
					</div>

					<div class="btn-group float-right">
						<button type="reset" id="menu-price" name="menu_price" class="btn btn-secondary mr-2">Reset</button>
						<input type="submit" value="Save" class="btn btn-primary" />
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