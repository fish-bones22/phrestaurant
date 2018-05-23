<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';
include_once 'alert.php';

// Get current menu information if it exists
$menus = Product::getAllMenu();

$token =  hash('ripemd160', date("YmdHi"));
if ( (!isset($_REQUEST["token"]) || $token != $_REQUEST["token"]) 
	&& !isset($_REQUEST["succ"]) && !isset($_REQUEST["err"])) {
	header("Location:adminverify.php?id=$id&page=".basename(__FILE__, '.php'));
	exit();
}

if (isset($_SESSION["hasalert"])) {
	$querystring = $_SERVER['QUERY_STRING'];
	$querystring = str_replace("&succ","",$querystring);
	$querystring = str_replace("&err","",$querystring);
	$querystring = str_replace("succ","",$querystring);
	$querystring = str_replace("err","",$querystring);
	header("Location:".basename(__FILE__)."?".$querystring);
	session_unset($_SESSION["hasalert"]);
}

if (isset($_REQUEST["succ"]) || isset($_REQUEST["err"])) {
	$_SESSION["hasalert"] = 1;
}

$_SESSION["menu"] = 1;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu Items</title>
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="vendors/datatables/css/datatables.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>

	<?php include_once 'navbar.php'; ?>

	<div class="container">
		<div class="row">

			<div class="col-md-6 offset-md-3">
				<div class="h1">Menu Items</div>

				<?php 
				if (isset($_REQUEST["succ"])) {
					showAlert(1, "Operation successful");
				} else if (isset($_REQUEST["err"])) {
					showAlert(2, "Operation failed");
				} 
				?>


				<table class="table table-sm" id="menu-table">
					<thead>
						<th>Cat</th>
						<th>Menu</th>
						<th></th>
					</thead>
					<tbody>						
					<?php
					if ($menus != null)
					foreach($menus as $menu) {
						// Shorten names
						$cat = strlen($menu->categoryName) > 4 ? substr($menu->categoryName, 0, 4) : $menu->categoryName;
						$menuName = strlen($menu->name) > 35 ? substr($menu->name, 0, 32)."..." : $menu->name;
					?>

					<tr>
						<td><?php echo $cat ?></td>
						<td>
							<a href="menumaster.php?id=<?php echo $menu->id ?>&token=<?php echo $token ?>"><?php echo $menuName ?></a>
						</td>
						<td>
							<button type="button" onclick="deleteMenu(<?php echo $menu->id ?>)" data-toggle="modal" data-target="#confirm-modal" class="close">&times</button>
						</td>
					</tr>

					<?php
					}
					else {
					?>
					<tr><td colspan='2' class="text-muted">No Menus yet.</td></tr>
					<?php
					}// end if-else
					?>

					</tbody>
					<tfoot>
						<tr>
							<td colspan="2"><a href="menumaster.php?token=<?php echo $token ?>" class="btn btn-block btn-light">+ New Menu</a></td>
						</tr>
					</tfoot>
				</table>
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
	<script src="vendors/datatables/js/datatables.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/menulist.js"></script>

</body>
</html>