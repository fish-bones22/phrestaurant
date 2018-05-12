<?php 

session_start();
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';

$menu = Product::getAllMenu();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Take Order</title>
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="vendors/datatables/css/datatables.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
<body>

	<div class="container">
		<div class="row">
			<div class="col">
			<?php
			if(!$menu) {
				echo "No Menu Items Found";
			} else {

				foreach ($menu as $product) {
				?>
				<div class="menu_item">
					<button onclick="orderButtonSelected(this)" class="btn btn-light item_menu" type="button" name="button" data-id="<?php echo $product->id ?>">
						<?php echo $product->name ?>
						<?php echo $product->price ?>
						<?php echo $product->quantity ?>
					</button>
				</div>

				<?php
				}
			}

			?>
			</div>
			<div class="col">
				<div class="orderBox" name="orderBox" id="orderBox">
					<table class="table table-sm">
						<thead>
							<tr>
								<th>Menu</th>
								<th>Quantity</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="order-list">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div>
		<!--
		eto yung modal
		-->
		<form>
			<div>
				<label>UserName:</label>
				<input type="text" name="username" id="checkUsername">
			</div>
			<div>
				<label>Password:</label>
				<input type="password" name="password" id="checkPassword">
			</div>
			<div>
				<button onclick="checkOutLogin()">Confirm</button>
			</div>
		</form>
	</div>

	<div>
		<button onclick="alert('Eto dapat lalabas modal ')">Check Out</button>
	</div>


	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/popper.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/cashier.js"></script>

</body>
</html>