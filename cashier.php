<?php 

session_start();

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cashier Menu</title>
</head>
<body>

<div class="container menu col-md-6">
	<?php

	$menu = Product::getAllMenu();

	if(!$menu) {
		echo "No Menu Items Found";
	} else {

		foreach ($menu as $product) {
		?>
		<div class="menu_item">
			<div>
				<button class="item_menu" type="button" onclick="addToOrder(<?php echo $product->id ?>)" name="item">
					<?php echo $product->name ?>
					<?php echo $product->price ?>
					<?php echo $product->quantity ?>
				</button>
			</div>
		</div>

		<?php
		}
	}

	?>
</div>

<div class="container cart col-md-6">
	
</div>

</body>
</html>