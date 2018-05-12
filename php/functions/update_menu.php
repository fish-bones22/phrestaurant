<?php 

require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/functions/db_connect.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/phrestaurant/php/objects/Product.php';

$isUpdating = false;

if (isset($_REQUEST["menu_id"]) && $_REQUEST["menu_id"] != 0)
	$isUpdating = true;

$menuId = $_REQUEST["menu_id"];
$name = $_REQUEST["menu_name"];
$category = $_REQUEST["menu_category"];
$price = $_REQUEST["menu_price"];
$quantity = $_REQUEST["menu_quantity"];

if ($name == "") {
	header("Location:../../menumaster.php?err");
	exit();
}

if ($category == "" || $category == 0) {
	header("Location:../../menumaster.php?err");
	exit();
}

if ($isUpdating) {

	$product = Product::getMenu($menuId);
	$product->name = $name;
	$product->category = $category;
	$product->price = $price;
	$product->quantity = $quantity;

	$product->updateProduct();
} 
else {

	$product = new Product();
	$product->name = $name;
	$product->category = $category;
	$product->price = $price;
	$product->quantity = $quantity;

	$product->addToDatabase();
	header("Location:../../menulist.php?succ");
	exit();
}

header("Location:../../menumaster.php?id=$menuId&succ");
exit();

 ?>