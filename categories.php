<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Category.php';

$categories = Category::getCategories();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories</title>
	<link rel="stylesheet" href="fonts/Font-Awesome/css/font-awesome.css">
	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>

	<?php include_once 'navbar.php'; ?>

	<div class="container">
		<form action="php/functions/update_categories.php" method="post">
			<div class="row">
				<div class="col-md-4 offset-md-4">
					<div class="h1">Categories</div>

					<div class="row">
						<div class="col-9"><strong>Name</strong></div>
					</div>

					<?php
					$i = 0;
					if ($categories != null)
					foreach($categories as $category) {
					?>
					<div class="row mb-1">
						<div class="col-9">
							<input type="hidden" name="categoryId[<?php echo $i ?>]" value="<?php echo $category->id ?>">
							<input class="form-control form-control-sm" type="text" value="<?php echo $category->name ?>"  name="categoryName[<?php echo $i ?>]" />
						</div>
						<div class="col-2">
							<button type="button" onclick="deleteCategory(<?php echo $category->id ?>)" data-toggle="modal" data-target="#confirm-modal" class="btn close">&times</button>
						</div>
					</div>

					<?php
						$i++;
					}
					else {
					?>
					<div class="text-muted">No Categories yet.</div>
					<?php
					}// end if-else
					?>

					<div class="row mb-1 new-category" hidden>
						<div class="col-9">
							<input type="text" class="form-control form-control-sm" name="new_category">
						</div>
						<div class="col-2">
							<button type="button" onclick="hideNewCategory()" class="btn close">&times</button>
						</div>
					</div>


					<div class="row align-items-center">
						<button onclick="showNewCategory()" type="button" class="btn btn-link">+ New Category</button>
					</div>

					<div class="btn-group float-right">
						<button type="reset" id="menu-price" name="menu_price" class="btn btn-secondary mr-2">Reset</button>
						<input type="submit" value="Save" class="btn btn-primary" />
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
	<script src="js/main.js"></script>
	<script src="js/categories.js"></script>

</body>
</html>