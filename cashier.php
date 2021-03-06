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

	<?php
		include_once 'navbar.php';
	?>

	<div class="container">

		<div class="h2">Take Orders</div>
		<div class="row">
			<div class="col-sm">

				<table class="table table-sm" id="menu-box">
					<thead>
						<th>Ctg</th>
						<th>Menu</th>
						<th>Pr</th>
						<th>Qty</th>
					</thead>
					<tbody>
						
					<?php
					if ($menu) {
						foreach ($menu as $product) {
							// Shorten names
							$cat = strlen($product->categoryName) > 4 ? substr($product->categoryName, 0, 4) : $product->categoryName;
							$menuName = strlen($product->name) > 25 ? substr($product->name, 0, 22)."..." : $product->name;
					?>
					<tr class="menu_item">
						<td><?php echo $cat ?></td>
						<td>
							<button 
							  onclick="buttonSelected(this)" 
							  class="btn btn-light btn-block item_menu"
							  id="item-menu-<?php echo $product->id ?>"
							  type="button" 
							  name="button" 
							  data-id="<?php echo $product->id ?>"
							  data-quantity="<?php echo $product->quantity ?>"
							  <?php echo ($product->quantity<=0 ? "disabled":"") ?> >
								<?php echo $menuName ?>
							</button>
						</td>
						<td><?php echo $product->price ?></td>
						<td class="qty-disp" id="qty-disp-<?php echo $product->id ?>" data-original="<?php echo $product->quantity ?>"><?php echo $product->quantity ?></td>
					</tr>
					<?php
						} // end foreach
					} // end if
					?>
						<tfoot>
							<tr>
								<td colspan="4"><a href="transaction.php">Transaction history</a></td>
							</tr>
						</tfoot>
					</tbody>
				</table>
			</div>
			<div class="col-sm">
				<div class="orderBox" name="orderBox" id="orderBox">
					<table class="table table-sm">
						<thead>
							<tr>
								<th>Menu</th>
								<th>Qty</th>
								<th>Pr</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="order-list">
							<tr><td class="text-muted">Select Menu from the left side</td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<div class="btn-group float-right">
					<button class="btn btn-primary" id="check-out-btn" data-toggle="modal" data-target="#verify-account-modal">Check Out</button>
				</div>
			</div>
		</div>

	</div>

	<div id="verify-account-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="lead">Please verify your account</div>
					<button class="close" data-dismiss="modal">&times</button>
				</div>
				<div class="modal-body">
					<div id="verify-failed" class="alert alert-danger" hidden>Username or password does not exist<button class="close" onclick="$('#verify-failed').attr('hidden', '')">&times;</button></div>
					<div class="form-group">
						<input class="form-control form-control-sm" type="text" name="username" id="checkUsername" placeholder="Username">
					</div>
					<div class="form-group">
						<input class="form-control form-control-sm" type="password" name="password" id="checkPassword" placeholder="Password">
					</div>
					<div class="btn-group float-right">
						<button class="btn btn-primary" onclick="checkOutLog()">Confirm</button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="vendors/jquery/jquery.min.js"></script>
	<script src="vendors/bootstrap/js/popper.min.js"></script>
	<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendors/datatables/js/datatables.min.js"></script>
	<script src="vendors/jspdf/jspdf.min.js"></script>
	<script src="js/cashier.js"></script>

</body>
</html>