<?php 

session_start();

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cashier Menu</title>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/cashier.js"></script>
</head>
<body>
	<?php 
		session_start();

		require_once 'php/objects/objProduct.php';
	?>

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
				<form method="post">
					<button onclick="orderButtonSelected(this)" class="item_menu" type="button" name="button" data-id="<?php echo $product->id ?>">
						<?php echo $product->name ?>
						<?php echo $product->price ?>
						<?php echo $product->quantity ?>
					</button>
				</form>
			</div>
		</div>

		<?php
		}
	}

	?>
</div>

<div class="orderBox" name="orderBox" id="orderBox">
	
</div>
<div>
	<button onclick="checkOutOrder()">Check Out</button>
</div>


</body>
</html>