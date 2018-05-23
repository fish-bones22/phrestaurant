<?php
session_start();

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Category.php';
include_once 'alert.php';


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


$categories = Category::getCategories();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories</title>
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="vendors/datatables/css/datatables.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>

	<?php include_once 'navbar.php'; ?>

	<div class="container">
		<form action="php/functions/update_categories.php" method="post">
			<div class="row">
				<div class="col-md-4 offset-md-4">
					<div class="h1">Categories</div>

					<?php 
					if (isset($_REQUEST["succ"])) {
						showAlert(1, "Operation successful");
					} else if (isset($_REQUEST["err"])) {
						showAlert(2, "Operation failed");
					} 
					?>

					<table class="table table-sm" id="category-table">
						<thead>
							<tr>
								<th>Name</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php

						$i = 0;
						if ($categories != null)
						foreach($categories as $category) {
						?>
						<tr>
							<td>
								<input type="hidden" name="categoryId[<?php echo $i ?>]" value="<?php echo $category->id ?>">
								<input onkeyup=checkName(this)" class="form-control form-control-sm category-field" type="text" value="<?php echo $category->name ?>"  name="categoryName[<?php echo $i ?>]" />
							</td>
							<td>
								<button type="button" onclick="deleteCategory(<?php echo $category->id ?>)" data-toggle="modal" data-target="#confirm-modal" class="btn close">&times</button>
							</td>
						</tr>

						<?php
							$i++;
						} // end foreach
						?>
						</tbody>
						<tfoot>
							<tr class="new-category" hidden>
								<td><input type="text" onkeyup="checkName(this)" class="form-control form-control-sm" name="new_category"></td>
								<td><button type="button" onclick="hideNewCategory()" class="btn close">&times</button></td>
							</tr>
							<tr>
								<td colspan="2"><button onclick="showNewCategory()" type="button" class="btn btn-block btn-light">+ New Category</button></td>
							</tr>
							<tr>
								<td colspan="2" class="text-danger" id="warning-disp"></td>
							</tr>
						</tfoot>
					</table>

					<div class="btn-group float-right">
						<button type="reset" id="menu-price" name="menu_price" class="btn btn-secondary mr-2">Reset</button>
						<input id="submit-btn" type="submit" value="Save" class="btn btn-primary" />
					</div>

				</div>
			</div>
		</form>
	</div>

	<div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="php/functions/delete_category.php" method="post">
					<input type="hidden" name="id" id="category-id-for-deletion" />
		      		<div class="modal-body">
		        		<p class="lead">Delete Category?</p>
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
	<script src="js/categories.js"></script>

</body>
</html>